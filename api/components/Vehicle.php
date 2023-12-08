<?php

namespace api\components;

use api\models\MemcompfiledtlsTbl;
use app\models\AppinstinfomainTbl;
use app\models\ApprasvehinspcatmainTbl;
use app\models\AuditanswerdtlsTbl;
use app\models\AuditchklstmstTbl;
use app\models\AuditquestionmstTbl;
use app\models\OpalusermstTbl;
use app\models\RasvehicleownerdtlsTbl;
use app\models\RasvehicleregdtlshstyTbl;
use app\models\RasvehicleregdtlsTbl;
use app\models\RasvehinsponansdtlshstyTbl;
use app\models\RasvehinsponansdtlsTbl;
use app\models\RasvehinsponquesdtlshstyTbl;
use app\models\RasvehinsponquesdtlsTbl;
use app\models\ReferencemstTbl;
use app\models\RoyaltyandasmtfeehstyTbl;
use app\models\RoyaltyandasmtfeeTbl;
use app\models\VehicleinspandapprovalhstyTbl;
use app\models\VehicleinspandapprovalTbl;
use DOMDocument;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use ZipArchive;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class Vehicle extends BaseObject {

    public static function saveVehicleDtls($requestdata) {


        $vehicleownerpk = RasvehicleownerdtlsTbl::saveVehicleOwner($requestdata);

        $vehiclepk = RasvehicleregdtlsTbl::saveVehicleDtls($vehicleownerpk, $requestdata);

        $data = [
            'vehicleownerpk' => $vehicleownerpk,
            'vehiclepk' => $vehiclepk,
        ];

        return $data;
    }

    public static function printorviewrassticker($pk, $type) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = RasvehicleregdtlsTbl::findOne($pk);

        if ($type == 1 && $model->rvrd_iscardviewed == 1) {
            return true;
        }

        if ($model) {
            $transaction = Yii::$app->db->beginTransaction();

            if ($type == 2) {
                $historymodel = RasvehicleregdtlshstyTbl::movetohistory($model);
                $model->rvrd_isstickerprinted = 1;
                $model->rvrd_printedby = $userpk;
                $model->rvrd_printedon = date('Y-m-d H:i:s');
            } else {
                $model->rvrd_iscardviewed = 1;
            }

            if ($model->save()) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollback();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }



        return false;
    }

    public static function getGridData($data, $export = false) {
        $regPk = ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $loginuserdtls = OpalusermstTbl::findOne($userpk);

        $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $pageSize = empty($data['limit']) ? 10 : $data['limit'];
        $page = empty($data['page']) ? 0 : $data['page'];

        $datalist = RasvehicleregdtlsTbl::find()
                ->select(['rasvehicleregdtls_pk', 'appiim_officetype', 'rvrd_applicationrefno', 'appiim_branchname_en', 'appiim_branchname_ar', 'rvod_ownername_en as owner_en', 'rvod_ownername_ar as owner_ar', 'rvrd_vechicleregno', 'rvrd_chassisno', 'rcm_coursesubcatname_en as vehtype_en', 'rcm_coursesubcatname_ar as vehtype_ar', 'rvrd_viewstickerpath', 'rvrd_printstickerpath', 'rvrd_opalmemberregmst_fk', 'omrm_branch_ar as compname_ar', 'omrm_branch_en as compname_en','rascategorymst_pk as category',
                    'rm_name_en as roadtype_en', 'rm_name_ar  as roadtype_ar', 'DATE_FORMAT(rvrd_dateofinsp,"%d-%m-%Y") AS dateofinspetcion', 'DATE_FORMAT(rvrd_inspstarttime,"%h:%i %p") AS startTime', 'DATE_FORMAT(rvrd_inspendtime,"%h:%i %p") AS endTime',
                    
                    'rvrd_applicationtype', 'rvrd_inspectorname', 'rvrd_inspectionstatus', 'rvrd_permitstatus', 'DATE_FORMAT(rvrd_dateofexpiry,"%d-%m-%Y") AS dateofexp','rvrd_odometerreading',
                    'rvod_crnumber', 'rvrd_ivmsserialno', 'rvrd_speedlimitno', 'rvrd_vechiclefleetno', 'oum_firstname as inspectorname', 'IF((now() > DATE_ADD(rvrd_dateofexpiry,INTERVAL - 2 MONTH) &&  rvrd_dateofexpiry > now()) , 1, 2)  AS ifNearingExpiry', 'if(rvrd_dateofexpiry < now() , 1, 2) as ifExpired '])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = rvrd_rasvehicleownerdtls_fk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = rvrd_vechiclecat')
                ->leftJoin('referencemst_tbl', 'referencemst_pk = rvrd_roadtype')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = rvrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = rvrd_inspectorname')
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = rvrd_opalmemberregmst_fk')
                ->where('rasvehicleregdtls_pk is not null');

        
       
        if ($stktype == 2) {
            $datalist->andWhere('rvrd_opalmemberregmst_fk = ' . $regPk);
        } else if (($stktype == 1)) {
            $datalist->andWhere(1);
        } else {
            $datalist->andWhere(0);
        }

        if (!empty($data['searchkey'])) {
            if (!empty($data['searchkey']['centrename'])) {

                
                $datalist->having("omrm_branch_en  like '%" . trim($data['searchkey']['centrename']) . "%'");
            }
            if (!empty($data['searchkey']['rasicnum'])) {

                
                $datalist->andwhere("rvrd_applicationrefno  like '%" . trim($data['searchkey']['rasicnum']) . "%'");
            }
            if (!empty($data['searchkey']['appl_form_filter'])) {
                
                $datalist->andwhere("rvod_ownername_en  like '%" . trim($data['searchkey']['appl_form_filter']) . "%'");
            }
            if (!empty($data['searchkey']['officetype_filter'])) {
                
                $datalist->andwhere("rvrd_vechicleregno  like '%" . trim($data['searchkey']['officetype_filter']) . "%'");
            }
            if (!empty($data['searchkey']['trainingprovide_filter'])) {
               
                $datalist->andwhere("rvrd_chassisno  like '%" . trim($data['searchkey']['trainingprovide_filter']) . "%'");
            }
            if (!empty($data['searchkey']['cour_type_filter'])) {
               
                $datalist->having("rcm_coursesubcatname_en  like '%" . trim($data['searchkey']['cour_type_filter']) . "%' OR rcm_coursesubcatname_ar  like '%" . trim($data['searchkey']['cour_type_filter']) . "%'");
            }
            if (!empty($data['searchkey']['course_cat_filter'])) {
                
                $datalist->andwhere("oum_firstname  like '%" . trim($data['searchkey']['course_cat_filter']) . "%'");
            }
            if (!empty($data['searchkey']['course_titles_filter'])) {

                
                $datalist->andwhere("rvrd_roadtype in (" . implode(",", $data['searchkey']['course_titles_filter']) . ")");
            }
            if (!empty($data['searchkey']['cour_subcate_filter'])) {
                
                $datalist->andwhere("rvrd_dateofinsp  between '" . date("Y-m-d", strtotime($data['searchkey']['cour_subcate_filter']['startDate'])) . "' and '" . date("Y-m-d", strtotime(trim($data['searchkey']['cour_subcate_filter']['endDate']))) . "'");
            }
            if (!empty($data['searchkey']['appl_type_filter'])) {

                
                $datalist->andwhere("rvrd_applicationtype in (" . implode(",",$data['searchkey']['appl_type_filter']) . ")");
            }
            if (!empty($data['searchkey']['appl_status_filter'])) {

                
                $datalist->andwhere("rvrd_inspectionstatus in (" . implode(",", $data['searchkey']['appl_status_filter']) . ")");
            }
            if (!empty($data['searchkey']['cert_status_filter'])) {

                
                $datalist->andwhere("rvrd_permitstatus in (" . implode(",", $data['searchkey']['cert_status_filter']) . ")");
            }
            if (!empty($data['searchkey']['lastUpdated_branch_filter'])) {

               
                $datalist->andwhere("rvrd_dateofexpiry  between '" . date("Y-m-d", strtotime(trim($data['searchkey']['lastUpdated_branch_filter']['startDate']))) . "' and '" . date("Y-m-d", strtotime(trim($data['searchkey']['lastUpdated_branch_filter']['endDate']))) . "'");
            }
            if (!empty($data['searchkey']['officetype'])) {

               
                $datalist->andwhere("appiim_officetype in (" . implode(",", $data['searchkey']['officetype']) . ")");
            }
            if (!empty($data['searchkey']['branch_name'])) {

                
                $datalist->andwhere("appiim_branchname_en  like '%" . trim($data['searchkey']['branch_name']) . "%'");
            }
            if (!empty($data['searchkey']['odometerfilter'])) {

                $datalist->andwhere("rvrd_odometerreading  like '%" . trim($data['searchkey']['odometerfilter']) . "%'");
        }
        }
        $datalist->orderBy(['ifnull(rvrd_updatedon,rvrd_createdon)' => SORT_DESC]);
        $datalist->asArray();

        if($export)
        {
            $pageSize = 0;
            $page = 0;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $datalist,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page
            ]
        ]);
        $allrecords = $dataProvider->getModels();

        $roadtype = ReferencemstTbl::find()
                        ->select(['referencemst_pk', 'rm_name_en', 'rm_name_ar'])
                        ->where(['rm_mastertype' => 16])
                        ->asArray()->All();

        $recodsset = [];
        $recodsset['griddata'] = $allrecords;
        $recodsset['roadtype'] = $roadtype;
        $recodsset['pagesize'] = $pageSize;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();

        return ['dataset' => $recodsset];
    }

    public static function getVehicleDtlsByPk($vehiclePk) {

        $vehicleregpk = Security::decrypt($vehiclePk);

        $data = RasvehicleregdtlsTbl::find()
                ->select(['rasvehicleregdtls_pk', 'appiim_officetype', 'rvrd_applicationrefno', 'appiim_branchname_en', 'appiim_branchname_ar', 'rvod_ownername_en as owner_en', 'rvod_ownername_ar as owner_ar', 'rvrd_vechicleregno', 'rvrd_chassisno', 'rcm_coursesubcatname_en as vehtype_en', 'rcm_coursesubcatname_ar as vehtype_ar', 'rvrd_viewstickerpath', 'rvrd_printstickerpath',
                    'rm_name_en as roadtype_en', 'rm_name_ar  as roadtype_ar', 'DATE_FORMAT(rvrd_dateofinsp,"%d-%m-%Y") AS dateofinspetcion', 'rvrd_ivmsdevicemodel', 'rvrd_ivmsvendorname', 'DATE_FORMAT(rvrd_inspstarttime,"%h:%i %p") AS startTime', 'DATE_FORMAT(rvrd_inspendtime,"%h:%i %p") AS endTime',
                    'rvrd_applicationtype', 'rvrd_inspectionstatus', 'rvrd_permitstatus', 'DATE_FORMAT(rvrd_dateofexpiry,"%d-%m-%Y") AS dateofexp', 'rvrd_verificationno',
                    'rvod_crnumber', 'oum_firstname as inspectorname'])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = rvrd_rasvehicleownerdtls_fk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = rvrd_vechiclecat')
                ->leftJoin('referencemst_tbl', 'referencemst_pk = rvrd_roadtype')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = rvrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = rvrd_inspectorname')
                ->where('rasvehicleregdtls_pk = ' . $vehicleregpk)
                ->asArray()
                ->one();

        return $data;
    }

    public static function moveToVerifier($data) {

        $record = null;

        if ($data['inspctiontype'] == 2) {

            $record = self::moveToVerifierOffline($data);
        } else if ($data['inspctiontype'] == 1) {
            $transaction = Yii::$app->db->beginTransaction();
            $vehicle = RasvehicleregdtlsTbl::findOne($data['vehicleregpk']);
            $onlineapprv = self::moveToVerifierOnline($data);

            $result = self::insertChecklistData($data, $onlineapprv, $vehicle->rvrd_inspectionstatus);

            $record['vehicleapproval'] = $onlineapprv;
            $record['chklist'] = $result;
            $transaction->commit();
        }

        return $record;
    }

    public static function insertChecklistData($data, $approvalpk, $existinginspStatus) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = null;
        $checklist = $data['onlinechecklist'];
        $mstchecklist = self::getChecklistByVeclCat($data['vehicleregpk']);

       
        $oldrecord = RasvehinsponquesdtlsTbl::find()->where(['=', 'rviqd_vehicleinspandapproval_fk', $approvalpk])->exists();

        if (!$oldrecord) {
            foreach ($mstchecklist as $list) {
                $modelques = new RasvehinsponquesdtlsTbl;
                $modelques->rviqd_auditquestionmst_fk = $list['auditquestionmst_pk'];
                $modelques->rviqd_vehicleinspandapproval_fk = $approvalpk;
                $modelques->rviqd_question_en = $list['aqm_question_en'];
                $modelques->rviqd_question_ar = $list['aqm_question_ar'];
                $modelques->rviqd_order = $list['aqm_order'];
                $modelques->rviqd_createdon = date('Y-m-d H:i:s');
                $modelques->rviqd_createdby = $userpk;

                if ($modelques->save()) {
                    $quesvalue = $modelques->rasvehinsponquesdtls_pk;
                    $anslist[$quesvalue] = self::insertAnsValues($checklist, $quesvalue, $list['ansoptions']);

                    $chklistresult['ques'] = $quesvalue;
                    $chklistresult['ans'] = $anslist;
                } else {
                    echo "<pre>";
                    var_dump($modelques->getErrors());
                    exit;
                }
            }
        } else {
        if($existinginspStatus == 1)
        {
                self::UpdateOnlineChecklistRenewal($data, $approvalpk);
                foreach ($mstchecklist as $list) {
                    $modelques = new RasvehinsponquesdtlsTbl;
                    $modelques->rviqd_auditquestionmst_fk = $list['auditquestionmst_pk'];
                    $modelques->rviqd_vehicleinspandapproval_fk = $approvalpk;
                    $modelques->rviqd_question_en = $list['aqm_question_en'];
                    $modelques->rviqd_question_ar = $list['aqm_question_ar'];
                    $modelques->rviqd_order = $list['aqm_order'];
                    $modelques->rviqd_createdon = date('Y-m-d H:i:s');
                    $modelques->rviqd_createdby = $userpk;

                    if ($modelques->save()) {
                        $quesvalue = $modelques->rasvehinsponquesdtls_pk;
                        $anslist[$quesvalue] = self::insertAnsValues($checklist, $quesvalue, $list['ansoptions']);

                        $chklistresult['ques'] = $quesvalue;
                        $chklistresult['ans'] = $anslist;
                    } else {
                        echo "<pre>";
                        var_dump($modelques->getErrors());
                        exit;
                    }
                }
        }
        else
        {
                self::updateOnlineChecklist($data, $approvalpk);
            }
            
        }

        return $chklistresult;
    }

    public static function updateOnlineChecklist($data, $approvalpk) {

        $questions = RasvehinsponquesdtlsTbl::find()->where(['=', 'rviqd_vehicleinspandapproval_fk', $approvalpk])->all();

        foreach ($questions as $ques) {
            $histquest[] = RasvehinsponquesdtlshstyTbl::movetohistory($ques);
            foreach ($data['onlinechecklist'] as $formdata) {
                if ($formdata['question'] == $ques->rviqd_auditquestionmst_fk) {
                    $answers = RasvehinsponansdtlsTbl::find()->where(['rviad_rasvehinsponquesdtls_fk' => $ques->rasvehinsponquesdtls_pk])->all();
                    foreach ($answers as $ans) {
                        $histans[] = RasvehinsponansdtlshstyTbl::movetohistory($ans);
                        if ($formdata['answer'] == $ans['rviad_auditanswerdtls_fk']) {
                            $ans->rviad_isselected = 1;
//                            $ans->rviad_comments = $formdata['chklistcomments'];
                            $ans->rviad_comments = !empty($formdata['chklistcomments']) ? $formdata['chklistcomments'] : null;
                            $ans->rviad_fileupload = !empty($formdata['chklistcomments']) ? implode(',', $formdata['chcklistdoc']) : null;
                        } else {
                            $ans->rviad_isselected = 2;
                            $ans->rviad_comments = null;
                            $ans->rviad_fileupload = null;
                        }

                        if ($ans && $ans->save()) {
                            $answers[] = $ans->rasvehinsponansdtls_pk;
                        } else {
                            echo "<pre>";
                            var_dump($ans->getErrors());
                            exit;
                        }
                    }
                }
            }
        }
        return $answers;
    }

    public static function UpdateOnlineChecklistRenewal($data,$approvalpk)
    {

        $questions = RasvehinsponquesdtlsTbl::find()->where(['=', 'rviqd_vehicleinspandapproval_fk', $approvalpk])->all();

        foreach ($questions as $ques) {
            $histquest[] = RasvehinsponquesdtlshstyTbl::movetohistory($ques);
            $answers = RasvehinsponansdtlsTbl::find()->where(['rviad_rasvehinsponquesdtls_fk' => $ques->rasvehinsponquesdtls_pk])->all();
            foreach ($answers as $ans) {
                $histans[] = RasvehinsponansdtlshstyTbl::movetohistory($ans);
                \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                $ans->delete();
                \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            }
            \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $ques->delete();
            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        }
    }

    public static function insertAnsValues($fomdata, $rasvehiclquepk, $datalist) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);

        foreach ($datalist as $ans) {

            foreach ($fomdata as $data) {

                if ($ans['aad_auditquestionmst_fk'] == $data['question'] && $ans['auditanswerdtls_pk'] == $data['answer']) {
                    $rasansmodel = new RasvehinsponansdtlsTbl();
                    $rasansmodel->rviad_rasvehinsponquesdtls_fk = $rasvehiclquepk;
                    $rasansmodel->rviad_auditanswerdtls_fk = (int) $ans['auditanswerdtls_pk'];
                    $rasansmodel->rviad_answer_en = $ans['aad_answer_en'];
                    $rasansmodel->rviad_answer_ar = $ans['aad_answer_ar'];
                    $rasansmodel->rviad_order = $ans['aad_order'];
                    $rasansmodel->rviad_isselected = 1;
                    $rasansmodel->rviad_comments = $data['chklistcomments'] ? $data['chklistcomments'] : null;
                    $rasansmodel->rviad_fileupload = $data['chcklistdoc'] ? implode(',', $data['chcklistdoc']) : null;
                    $rasansmodel->rviad_createdon = date('Y-m-d H:i:s');
                    $rasansmodel->rviad_createdby = $userpk;

                    if ($rasansmodel->save()) {

                        $rasanws[] = $rasansmodel->rasvehinsponansdtls_pk;
                    } else {
                        echo "<pre>";
                        var_dump($rasansmodel->getErrors());
                        exit;
                    }
                } else if ($ans['aad_auditquestionmst_fk'] == $data['question']) {
                    $rasansmodel = new RasvehinsponansdtlsTbl();
                    $rasansmodel->rviad_rasvehinsponquesdtls_fk = $rasvehiclquepk;
                    $rasansmodel->rviad_auditanswerdtls_fk = (int) $ans['auditanswerdtls_pk'];
                    $rasansmodel->rviad_answer_en = $ans['aad_answer_en'];
                    $rasansmodel->rviad_answer_ar = $ans['aad_answer_ar'];
                    $rasansmodel->rviad_order = $ans['aad_order'];
                    $rasansmodel->rviad_isselected = 2;
                    $rasansmodel->rviad_comments = null;
                    $rasansmodel->rviad_fileupload = null;
                    $rasansmodel->rviad_createdon = date('Y-m-d H:i:s');
                    $rasansmodel->rviad_createdby = $userpk;

                    if ($rasansmodel->save()) {

                        $rasanws[] = $rasansmodel->rasvehinsponansdtls_pk;
                    } else {
                        echo "<pre>";
                        var_dump($rasansmodel->getErrors());
                        exit;
                    }
                }
            }
        }

        return $rasanws;
    }

    public static function moveToSupervisor($data) {
        $record = null;
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);
        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        $verifierstatus = ($data['verifierStatus'] == 1) ? 4 : 5;

        
        if($vehicle->rvrd_inspectionstatus == 2 ||$vehicle->rvrd_inspectionstatus == 7 )
        {
            $inspection = VehicleinspandapprovalTbl::find()->where(['=', 'via_rasvehicleregdtls_fk', $vehicle->rasvehicleregdtls_pk])->one();
            $transaction = Yii::$app->db->beginTransaction();
            if ($inspection) {

                $modelhsty = VehicleinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($vehicleregpk, $verifierstatus);

                $inspection->via_appdecon = date('Y-m-d H:i:s');
                $inspection->via_appdecby = $userpk;
                $inspection->via_appdecComments = $data['verifierComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {
                    $transaction->commit();
                    $record = $inspection->vehicleinspandapproval_pk;
                } else {
                    echo "<pre>";
                    var_dump($inspection->getErrors());
                    exit;
                }
            }
            $transaction->rollback();
        }




        return $record;
    }

    public static function moveToInspectorValidating($data) {

        $record = null;
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);
        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        if($vehicle->rvrd_inspectionstatus == 2 || $vehicle->rvrd_inspectionstatus == 4)
        {
            $validationstatus = ($data['status'] == 2) ? 5 : 6;

            $inspection = VehicleinspandapprovalTbl::find()->where(['=', 'via_rasvehicleregdtls_fk', $vehicle->rasvehicleregdtls_pk])->one();

            if ($inspection) {
                $transaction = Yii::$app->db->beginTransaction();
                $modelhsty = VehicleinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($vehicleregpk, $validationstatus);

                $inspection->via_appdecon = date('Y-m-d H:i:s');
                $inspection->via_appdecby = $userpk;
                $inspection->via_appdecComments = $data['validationComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {
                    $transaction->commit();
                    $record = $inspection->vehicleinspandapproval_pk;
                } else {
                    echo "<pre>";
                    var_dump($inspection->getErrors());
                    exit;
                }
            }

            $transaction->rollback();
        }
        return $record;
    }

    public static function getvhclregstatus($pk) {
        $vehicle = RasvehicleregdtlsTbl::findOne($pk);

        return $vehicle->rvrd_inspectionstatus;
    }

    public static function moveToVerifierOffline($data) {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = RasvehicleregdtlsTbl::findOne($data['vehicleregpk']);

        if ($vehicle) {
            if ($vehicle->vehicleinspandapprovalTbl) {
                $approval = $vehicle->vehicleinspandapprovalTbl;
            }

            $transaction = Yii::$app->db->beginTransaction();

            if ($vehicle) {

                if ($approval) {



                    $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($data['vehicleregpk'], $data['status']);
                    $historyapproval = VehicleinspandapprovalhstyTbl::movetohistory($approval);
                    self::UpdateOnlineChecklistRenewal($data, $approval->vehicleinspandapproval_pk);
                    $model = $approval;
                    $model->via_updatedon = date('Y-m-d H:i:s');
                    $model->via_updatedby = $userpk;
                } else {
                    $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($data['vehicleregpk'], $data['status']);
                    $model = new VehicleinspandapprovalTbl();
                    $model->via_createdon = date('Y-m-d H:i:s');
                    $model->via_createdby = $userpk;
                }
                $model->via_rasvehicleregdtls_fk = $data['vehicleregpk'];
                $model->via_insptype = $data['inspctiontype'];
                $model->via_report = implode(',', $data['reportdocument']);
                $model->via_comments = $data['comments'];

                if ($model->save() && $vehiclereg) {
                    $transaction->commit();
                    return $model->vehicleinspandapproval_pk;
                } else {
                    $transaction->rollback();
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                }
            }
        }
    }

    public static function getInspectionDtls($vhclRegPk) {



        $data = VehicleinspandapprovalTbl::find()
                ->select(['rvrd_inspectorname', 'via_insptype as inspType', 'via_report as document', 'via_comments as inspComments', 'DATE_FORMAT(via_createdon,"%d-%m-%Y")  as submittedOn', 'via_createdby', 'a.oum_firstname as submittedBy', 'rvrd_inspectionstatus', 'via_updatedby', 'b.oum_firstname as lastupdatedBy', 'DATE_FORMAT(via_updatedon,"%d-%m-%Y")  as lastupdatedOn', ' DATE_FORMAT(via_appdecon,"%d-%m-%Y") as apprvdOn', 'via_appdecby', 'c.oum_firstname as approvedBy', 'via_appdecComments as apprvdComments', 'a.oum_opalmemberregmst_fk as memberRegPk', 'vehicleinspandapproval_pk as approvalpk'])
                ->leftJoin('rasvehicleregdtls_tbl', 'via_rasvehicleregdtls_fk = rasvehicleregdtls_pk')
                ->leftJoin('opalusermst_tbl a', 'via_createdby = a.opalusermst_pk')
                ->leftJoin('opalusermst_tbl b', 'via_updatedby = b.opalusermst_pk')
                ->leftJoin('opalusermst_tbl c', 'via_appdecby = c.opalusermst_pk')
                ->where(['=', 'rasvehicleregdtls_pk', $vhclRegPk])
                ->asArray()
                ->one();

        if ($data['document']) {
            $records = explode(',', $data['document']);
            $i = 0;
            foreach ($records as $record) {
                $data['prooflink'][$i]['link'] = Drive::generateUrl($record, $data['memberRegPk'], $data['via_createdby']);
                $data['prooflink'][$i]['filetype'] = MemcompfiledtlsTbl::getFileTypeByPk($record);
                $i++;
            }
        }
        if ($data['inspType'] == 1) {
            $data['checklist'] = self::getRasvehicleQuesAndResponse($data['approvalpk']);
        }


        return $data;
    }

    public static function getRasvehicleQuesAndResponse($approvalPk) {
        $checklist = [];
        $questions = RasvehinsponquesdtlsTbl::find()
                        ->select(['rasvehinsponquesdtls_pk', 'rviqd_question_en', 'rviqd_question_ar'])
                        ->where(['=', 'rviqd_vehicleinspandapproval_fk', $approvalPk])->asArray()->all();

        $vehicle = VehicleinspandapprovalTbl::findOne($approvalPk);

        $memregpk = $vehicle->viaRasvehicleregdtlsFk->rvrd_opalmemberregmst_fk;

        foreach ($questions as $key => $list) {
            $checklist[$key] = $list;

            $ansOptions = RasvehinsponansdtlsTbl::find()
                    ->select(['rviad_answer_en', 'rviad_answer_ar', 'if(rviad_answer_en = "Pass",1,if(rviad_answer_en = "Fail",2,3)) as colourcode', 'rviad_fileupload as upload', 'rviad_comments as comments', 'rviad_createdby'])
                    ->where(['=', 'rviad_rasvehinsponquesdtls_fk', $list['rasvehinsponquesdtls_pk']])
                    ->andWhere(['=', 'rviad_isselected', 1])
                    ->asArray()
                    ->one();
            if ($ansOptions['upload']) {
                $records = explode(',', $ansOptions['upload']);
                $i = 0;

                foreach ($records as $record) {
                    $ansOptions['prooflink'][$i]['link'] = Drive::generateUrl($record, $memregpk, $ansOptions['rviad_createdby']);
                    $ansOptions['prooflink'][$i]['filetype'] = MemcompfiledtlsTbl::getFileTypeByPk($record);
                }
            }

            $checklist[$key] = array_merge($checklist[$key], $ansOptions);
        }
        return $checklist;
    }

    public static function issueSticker($data) {
        $record = null;
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);
        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        if($vehicle->rvrd_inspectionstatus == 2 || $vehicle->rvrd_inspectionstatus == 4)
        {
            $supervisorstatus = ($data['supervisorStatus'] == 1) ? 3 : 6;
            $inspection = VehicleinspandapprovalTbl::find()->where(['=', 'via_rasvehicleregdtls_fk', $vehicle->rasvehicleregdtls_pk])->one();

            if ($inspection) {
                $modelhsty = VehicleinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($vehicleregpk, $supervisorstatus);

                $inspection->via_appdecon = date('Y-m-d H:i:s');
                $inspection->via_appdecby = $userpk;
                $inspection->via_appdecComments = $data['supervisorComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {

                    $record = $inspection->vehicleinspandapproval_pk;
                } else {
                    echo "<pre>";
                    var_dump($inspection->getErrors());
                    exit;
                }
            }
        }


        return $record;
    }

    public static function getInspectorListByVhclregpk($requestdata) {
        $list = [];
        $status = 'F';
        $result = [];

        $data = json_decode($requestdata, true);

        
        $vehicle = RasvehicleregdtlsTbl::findOne(Security::decrypt($data['pk']));

//        vehiclecat: this.vehicleForm.controls['vehiclecat'].value,
//    registrationpk :  this.security.encrypt(this.vehicleForm.controls['registrationpk'].value),
//    applicatiomainpk:this.security.encrypt(this.vehicleForm.controls['applicatiomainpk'].value),
//    categoryPk:this.security.encrypt(this.vehicleForm.controls['vehiclecat'].value),

        if($vehicle->rvrd_inspectionstatus == 3)
        {
            $appPk = AppinstinfomainTbl::findOne($vehicle['rvrd_appinstinfomain_fk'])['appiim_applicationdtlsmain_fk'];
            $params = [
                'vehiclecat' => $vehicle['rvrd_vechiclecat'],
                'categoryPk' => Security::encrypt($vehicle['rvrd_vechiclecat']),
                'registrationpk' => Security::encrypt($vehicle['rvrd_opalmemberregmst_fk']),
                'applicatiomainpk' => Security::encrypt($appPk),
            'date' => Security::encrypt($data['date']),
            'startTime' => Security::encrypt($data['startTime']),
            'endTime' => Security::encrypt($data['endTime']),
            ];

            $parasjson = json_encode($params, true);

            $list = ApprasvehinspcatmainTbl::getinspectoname($parasjson);
            $status = 'P';
        }

        $result = ['list' => $list, 'status' => $status];

        return $result;
    }

    public static function renewVehicleRegistration($data) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregPk']);
        $vehicleinfo = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        
        if ($vehicleinfo) {
            $history = RasvehicleregdtlshstyTbl::movetohistory($vehicleinfo);

            $vehicleinfo->rvrd_dateofinsp = $data['dateOfInsp'];
            $vehicleinfo->rvrd_inspstarttime = $data['startTime'];
            $vehicleinfo->rvrd_inspendtime = $data['endTime'];
            $vehicleinfo->rvrd_inspectorname = $data['inspector'];
            $vehicleinfo->rvrd_odometerreading = $data['odometer'];
            $vehicleinfo->rvrd_applicationtype = 2;
            $vehicleinfo->rvrd_inspectionstatus = 1;

            $vehicleinfo->rvrd_updatedon = date('Y-m-d H:i:s');
            $vehicleinfo->rvrd_updatedby = $userpk;
            if($vehicleinfo->rvrd_permitstatus == null)
            {
                $vehicleinfo->rvrd_permitstatus = 1;
            }

            if ($vehicleinfo->save() && $history) {
                return $vehicleinfo->rasvehicleregdtls_pk;
            }
        }
        return false;
    }

    public static function getChecklistByVeclCat($vehicleregpk) {
        $checklist = [];

        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        $auditpk = AuditchklstmstTbl::find()
                        ->select(['auditchklstmst_pk'])
                        ->where(['=', 'aclm_rascategorymst_fk', $vehicle->rvrd_vechiclecat])
                        ->one()['auditchklstmst_pk'];

        $questions = AuditquestionmstTbl::find()
                ->select(['aqm_question_en', 'aqm_question_ar', 'auditquestionmst_pk', 'aqm_auditchklstmst_fk', 'aqm_order'])
                ->where(['=', 'aqm_auditchklstmst_fk', $auditpk])
                ->andWhere(['=', 'aqm_status', 1])
                ->orderBy('aqm_order')
                ->asArray()
                ->all();

        foreach ($questions as $key => $ques) {
            $checklist[$key] = $ques;

            $ansOptions = AuditanswerdtlsTbl::find()
                    ->select(['auditanswerdtls_pk', 'aad_auditquestionmst_fk', 'aad_answer_en', 'aad_answer_ar', 'aad_order'])
                    ->where(['=', 'aad_auditquestionmst_fk', $ques['auditquestionmst_pk']])
                    ->andWhere(['=', 'aad_status', 1])
                    ->orderBy('aad_order')
                    ->asArray()
                    ->all();
            $checklist[$key]['ansoptions'] = $ansOptions;
        }

        return $checklist;
    }

    public static function moveToVerifierOnline($data) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = RasvehicleregdtlsTbl::findOne($data['vehicleregpk']);
        if ($vehicle->vehicleinspandapprovalTbl) {
            $approval = $vehicle->vehicleinspandapprovalTbl;
        }

        if ($vehicle) {

            if ($approval) {
                $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($data['vehicleregpk'], $data['status']);
                $historyapproval = VehicleinspandapprovalhstyTbl::movetohistory($approval);
                $model = $approval;

                $model->via_updatedon = date('Y-m-d H:i:s');
                $model->via_updatedby = $userpk;
            } else {
                $vehiclereg = RasvehicleregdtlsTbl::moveToVerifierOfflineVehicle($data['vehicleregpk'], $data['status']);
                $model = new VehicleinspandapprovalTbl();
                $model->via_createdon = date('Y-m-d H:i:s');
                $model->via_createdby = $userpk;
            }
            $model->via_rasvehicleregdtls_fk = $data['vehicleregpk'];
            $model->via_insptype = $data['inspctiontype'];
            $model->via_comments = $data['comments'];
            $model->via_report = null;

            if ($model->save() && $vehiclereg) {

                return $model->vehicleinspandapproval_pk;
            } else {
                $transaction->rollback();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
    }

    public static function getInspectionDetailsForEdit($vehiclPk) {
//        $vehicle = RasvehicleregdtlsTbl::findOne($vehiclPk);
//        $approval = $vehicle->vehicleinspandapprovalTbl;

        $result = VehicleinspandapprovalTbl::find()
                ->select(['vehicleinspandapproval_pk as pk', 'rvrd_inspectionstatus as status', 'via_insptype as inspType', 'via_report as inspReport', 'via_comments as inspComment', ' DATE_FORMAT(via_appdecon,"%d-%m-%Y") as declinedOn', 'via_appdecComments as declineComments', 'via_appdecby', 'oum_firstname as declinedBy'])
                ->leftJoin('rasvehicleregdtls_tbl', 'via_rasvehicleregdtls_fk = rasvehicleregdtls_pk')
                ->leftJoin('opalusermst_tbl', 'via_appdecby = opalusermst_pk')
                ->where(['=', 'via_rasvehicleregdtls_fk', $vehiclPk])
                ->asArray()
                ->one();

        $cheklist = self::getOnlinechecklistforEdit($result['pk']);

        $result['checklist'] = $cheklist;
//        $result['inspReport'] = explode(',',$result['inspReport']);


        return $result;
    }

    public static function getOnlinechecklistforEdit($approvalpk) {
        $questions = RasvehinsponquesdtlsTbl::find()
                ->select(['rviqd_auditquestionmst_fk as mstPk', 'rasvehinsponquesdtls_pk as rasquesPk'])
                ->where(['=', 'rviqd_vehicleinspandapproval_fk', $approvalpk])
                ->orderBy('rviqd_order')
                ->asArray()
                ->all();

        foreach ($questions as $key => $ques) {
            $ansOptions = RasvehinsponansdtlsTbl::find()
                    ->select(['rviad_auditanswerdtls_fk as mstPk', 'rasvehinsponansdtls_pk as rasansPk', 'rviad_isselected as ifselected', 'rviad_comments as ansComments', 'rviad_fileupload as ansDoc', 'IF((rviad_comments is not  NULL || rviad_fileupload is not NULL),  1, 0) AS toggleOpen'])
                    ->where(['=', 'rviad_rasvehinsponquesdtls_fk', $ques['rasquesPk']])
                    ->andWhere(['=', 'rviad_isselected', 1])
                    ->orderBy('rviad_order')
                    ->asArray()
                    ->all();

            $questions[$key]['ansoptions'] = $ansOptions;
            $questions[$key]['toggleOpen'] = $ansOptions[0]['toggleOpen'];
        }
        return $questions;
    }

    public static function getVehicleDtlsByRefNo($dataToCheck) {

        $data = trim(Security::sanitizeInput($dataToCheck, 'string'));
        $model = RasvehicleregdtlsTbl::find()
                ->select(['rvrd_inspectionstatus as status', 'rasvehicleregdtls_pk as vehiclepk', 'omrm_companyname_en as centre', 'rvrd_chassisno as chasis', 'If(rvrd_dateofexpiry is not null and IF((now() > DATE_ADD(rvrd_dateofexpiry,INTERVAL - 2 MONTH) &&  rvrd_dateofexpiry > now()) , 1, 0),1,2) as nearing', ' If(rvrd_dateofexpiry is not null and IF(( rvrd_dateofexpiry < now()) , 1, 0),1,2) as expired'])
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = rvrd_opalmemberregmst_fk')
                ->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $data])
                ->andWhere(['NOT IN', 'rvrd_inspectionstatus', [9, 10]])
                ->orderBy('rasvehicleregdtls_pk desc');

        return $model->asArray()->one();
    }

    public static function getvehiclregdlsbyvhclpk($vehiclePk) {
        $model = RasvehicleregdtlsTbl::find()
                        
                        ->select(['rasvehicleregdtls_pk', 'rvrd_opalmemberregmst_fk', 'rvrd_appinstinfomain_fk', 'rvrd_opalmemberregmst_fk', 'rvrd_rasvehicleownerdtls_fk', 'rvrd_vechicleregno', 'rvrd_chassisno', 'rvrd_ivmsserialno', 'rvrd_ivmsvendorname', 'rvrd_ivmsdevicemodel', 'rvrd_speedlimitno', 'rvrd_vechiclecat', 'rvrd_vechiclefleetno', 'rvrd_roadtype', 'rvrd_firstropregdate', 'rvrd_modelyear', 'rvrd_inspstarttime', 'rvrd_inspendtime', 'rvrd_inspectorname', 'rvod_ownername_ar', 'rvod_ownername_en','rvrd_odometerreading', 'rvod_crnumber', 'rvrd_dateofinsp', 'appiim_applicationdtlsmain_fk', 'appiim_branchname_en', 'appiim_branchname_ar', 'appiim_officetype', 'rvrd_applicationrefno'])
                        ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = rvrd_rasvehicleownerdtls_fk')
                        ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = rvrd_appinstinfomain_fk')
                        ->where(['=', 'rasvehicleregdtls_pk', $vehiclePk])
                        ->asArray()->one();


        return $model;
    }

    public function ChangePermitstatusOnnewsticker($model) {
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $oldrecord = RasvehicleregdtlsTbl::find()
                ->where(['=', 'rvrd_vechicleregno', $model->rvrd_vechicleregno])
                ->andWhere(['<>', 'rasvehicleregdtls_pk', $model->rasvehicleregdtls_pk])
                ->all();
        if ($oldrecord) {
            foreach ($oldrecord as $record) {
                $record->rvrd_permitstatus = 4;
                $record->rvrd_inspectionstatus = 10;
                $record->rvrd_updatedon = date("Y-m-d H:i:s");
                $record->rvrd_updatedby = $userPk;
                if ($record->save()) {
                    $oldpks[] = $record->rasvehicleregdtls_pk;
                } else {
                    echo "<pre>";
                    var_dump($record->getErrors());
                    exit;
                }
            }
            return $oldpks;
        }
        return true;
    }

    public static function getAllPassAnswersForChklist($vehicleregpk) {
        $checklist = [];

        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        $auditpk = AuditchklstmstTbl::find()
                        ->select(['auditchklstmst_pk'])
                        ->where(['=', 'aclm_rascategorymst_fk', $vehicle->rvrd_vechiclecat])
                        ->one()['auditchklstmst_pk'];

        $questions = AuditquestionmstTbl::find()
                ->select(['auditquestionmst_pk as question'])
                ->where(['=', 'aqm_auditchklstmst_fk', $auditpk])
                ->andWhere(['=', 'aqm_status', 1])
                ->orderBy('aqm_order')
                ->asArray()
                ->all();

        foreach ($questions as $key => $ques) {
            $checklist[$key] = $ques;

            $ansOptions = AuditanswerdtlsTbl::find()
                            ->select(['auditanswerdtls_pk'])
                            ->where(['=', 'aad_auditquestionmst_fk', $ques['question']])
                            ->andWhere(['=', 'aad_answer_en', 'Pass'])
                            ->andWhere(['=', 'aad_status', 1])
                            ->orderBy('aad_order')
                            ->asArray()
                            ->one()['auditanswerdtls_pk'];

            $checklist[$key]['answer'] = $ansOptions;
        }



        return $checklist;
    }

    public static function exportGridData($data)
    {

        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = Vehicle::getGridData($data, true);
        $exportdata = $result['dataset']['griddata'];
         $gridcolumns = $data['columns'];

        
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl . 'web/exports/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName = 'RAS_Vehicle_Report_' . $time;
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat = 'dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip = new ZipArchive();
            if ($zip->open($folder . $exeFileName . ".zip", ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }
            // style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr ><td colspan="10" rowspan="5" align="center"><img style="height:130px" alt="rabt_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/excelheader.png"></td></tr></table>';   
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
        $value .= '<table border="1">';
        $value .= '<tr>';
        $value .= '<td valing="top" colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> ' . $dateString . ' </td>';
        $value .= '</tr>';
        $value .= '</table>';
        $value .= '<style>.text{mso-number-format:\"\@\";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
        $value .= '<tr style="background-color:#E7E7E7;height:40px">';
        $value .= '<td>Sl. No.</td>';
        if (in_array('centre_name', $gridcolumns)) {
            $value .= '<td>RAS Inspection Centre Name</td>';
        }
        if (in_array('rvrd_applicationrefno', $gridcolumns)) {
            $value .= '<td>RASIC Number</td>';
        }
        if (in_array('appiim_officetype', $gridcolumns)) {
            $value .= '<td>Office Type</td>';
        }
        if (in_array('appiim_branchname_en', $gridcolumns)) {
            $value .= '<td>Branch Name</td>';
        }
        if (in_array('owner_en', $gridcolumns)) {
            $value .= '<td>Owner Name</td>';
        }
        if (in_array('rvrd_vechicleregno', $gridcolumns)) {
            $value .= '<td>Vehicle Reg. Number</td>';
        }
        if (in_array('rvrd_chassisno', $gridcolumns)) {
            $value .= '<td>Chassis Number</td>';
        }
        if (in_array('rvrd_odometerreading', $gridcolumns)) {
            $value .= '<td>Odometer Reading (in KM)</td>';
        }
        if (in_array('vehtype_en', $gridcolumns)) {
            $value .= '<td>Vehicle Category</td>';
        }
        if (in_array('roadtype_en', $gridcolumns)) {
            $value .= '<td>Road Type</td>';
        }
        if (in_array('inspectorname', $gridcolumns)) {
            $value .= '<td>Inspector Name</td>';
        }
        if (in_array('dateofinspetcion', $gridcolumns)) {
            $value .= '<td>Inspection Date and Time</td>';
        }
        if (in_array('rvrd_applicationtype', $gridcolumns)) {
            $value .= '<td>Applicant Type</td>';
        }
        if (in_array('rvrd_inspectionstatus', $gridcolumns)) {
            $value .= '<td>Inspection Status</td>';
        }
        if (in_array('rvrd_permitstatus', $gridcolumns)) {
            $value .= '<td>Permit Status</td>';
        }
        if (in_array('dateofexp', $gridcolumns)) {
            $value .= '<td>Date of Expiry</td>';
        }
        $value .= '</tr>';
        $i = 1;
        foreach ($exportdata as $attend) {


            $value .= '<tr>';
            $value .= '<td valing="top">' . $i++ . '</td>';

            if (in_array('centre_name', $gridcolumns)) {
                if (empty($attend["compname_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["compname_en"] . '</td>';
                }
            }
            if (in_array('rvrd_applicationrefno', $gridcolumns)) {
                if (empty($attend["owner_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_applicationrefno"] . '</td>';
                }
            }
            if (in_array('appiim_officetype', $gridcolumns)) {
                if (empty($attend["appiim_officetype"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["appiim_officetype"] == 1) {
                        $value .= '<td valing="top">Main Office</td>';
                    } elseif ($attend["appiim_officetype"] == 2) {
                        $value .= '<td valing="top">Branch Office</td>';
                    }
                }
            }
            if (in_array('appiim_branchname_en', $gridcolumns)) {
                if (empty($attend["appiim_branchname_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["appiim_branchname_en"] . '</td>';
                }
            }
            if (in_array('owner_en', $gridcolumns)) {
                if (empty($attend["owner_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["owner_en"] . '</td>';
                }
            }
            if (in_array('rvrd_vechicleregno', $gridcolumns)) {
                if (empty($attend["rvrd_vechicleregno"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_vechicleregno"] . '</td>';
                }
            }
            if (in_array('rvrd_chassisno', $gridcolumns)) {
                if (empty($attend["rvrd_chassisno"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_chassisno"] . '</td>';
                }
            }
            if (in_array('rvrd_odometerreading', $gridcolumns)) {
                if (empty($attend["rvrd_odometerreading"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_odometerreading"] . '</td>';
                }
            }
            if (in_array('vehtype_en', $gridcolumns)) {
                if (empty($attend["vehtype_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["vehtype_en"] . '</td>';
                }
            }
            if (in_array('roadtype_en', $gridcolumns)) {
                if (empty($attend["roadtype_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["roadtype_en"] . '</td>';
                }
            }
            if (in_array('inspectorname', $gridcolumns)) {
                if (empty($attend["inspectorname"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["inspectorname"] . '</td>';
                }
            }
            if (in_array('dateofinspetcion', $gridcolumns)) {
                if (empty($attend["dateofinspetcion"])) {
                    $value .= '<td valing="top"> - </td>';
                } else if (empty($attend["startTime"]) && empty($attend["endTime"])) {
                    $value .= '<td valing="top">' . (string) $attend["dateofinspetcion"] . '</td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["dateofinspetcion"] . ' (' . (string) $attend["startTime"] . '-' . (string) $attend["endTime"] . ')</td>';
                }
            }
            if (in_array('rvrd_applicationtype', $gridcolumns)) {
                if (empty($attend["rvrd_applicationtype"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["rvrd_applicationtype"] == 1) {
                        $value .= '<td valing="top">Initial</td>';
                    } elseif ($attend["rvrd_applicationtype"] == 2) {
                        $value .= '<td valing="top">Renewal</td>';
                    }
                }
            }
            if (in_array('rvrd_inspectionstatus', $gridcolumns)) {
                if (empty($attend["rvrd_inspectionstatus"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getinspectionSts($attend["rvrd_inspectionstatus"]) . '</td>';
                }
            }
            if (in_array('rvrd_permitstatus', $gridcolumns)) {
                if (empty($attend["rvrd_permitstatus"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getpermitSts($attend["rvrd_permitstatus"]) . '</td>';
                }
            }
            if (in_array('dateofexp', $gridcolumns)) {
                if (empty($attend["dateofexp"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["dateofexp"] . '</td>';
                }
            }

            $value .= '</tr>';
        }
        $value .= '</table>';
            $data1 = trim($value) . "\n";
            if (!empty($data1) && !empty($exeFileName)) {
                $filename = $exeFileName . '.xls';
                $zip->addFromString($filename, $data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__) . '/../web/exports/' . $exeFileName . '.zip';

            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/ras/ras/downloadgridata?filename=' . Security::encrypt($exeFileName)]);
            return $return;
        } else {
            $return['status'] = 2;
            return $return;
        }
    }

    public static function exportGridDatanew($data) {
        
     

        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $gridcolumns = $data['columns'];
      

        $result = Vehicle::getGridData($data, true);
        $exportdata = $result['dataset']['griddata'];
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl . 'web/exports/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName = 'RAS_Vehicle_Report_' . $time;
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat = 'dd\-mm\-yyyy';

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

//        $worksheet->getRowDimension(1)->setRowHeight(75);
//
//        $objDrawing = new Drawing();
//        $objDrawing->setName('Logo');
//        $objDrawing->setDescription('Logo');
//        $objDrawing->setPath('../dev/src/assets/images/excelheader.png');
//        $objDrawing->setCoordinates('A1'); // Cell coordinate where image will be placed
//        $objDrawing->setHeight(100);
//
//        $objDrawing->setWorksheet($worksheet);

        $value = '';
        $value .= '<table border="1">';
        $value .= '<tr>';
        $value .= '<td valing="top" colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> ' . $dateString . ' </td>';
        $value .= '</tr>';
        $value .= '</table>';
        $value .= '<style>.text{mso-number-format:\"\@\";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
        $value .= '<tr style="background-color:#E7E7E7;height:40px">';
        $value .= '<td>Sl. No.</td>';
        if (in_array('centre_name', $gridcolumns)) {
            $value .= '<td>RAS Inspection Centre Name</td>';
        }
        if (in_array('rvrd_applicationrefno', $gridcolumns)) {
            $value .= '<td>RASIC Number</td>';
        }
        if (in_array('appiim_officetype', $gridcolumns)) {
            $value .= '<td>Office Type</td>';
        }
        if (in_array('appiim_branchname_en', $gridcolumns)) {
            $value .= '<td>Branch Name</td>';
        }
        if (in_array('owner_en', $gridcolumns)) {
            $value .= '<td>Owner Name</td>';
        }
        if (in_array('rvrd_vechicleregno', $gridcolumns)) {
            $value .= '<td>Vehicle Reg. Number</td>';
        }
        if (in_array('rvrd_chassisno', $gridcolumns)) {
            $value .= '<td>Chassis Number</td>';
        }
        if (in_array('vehtype_en', $gridcolumns)) {
            $value .= '<td>Vehicle Category</td>';
        }
        if (in_array('roadtype_en', $gridcolumns)) {
            $value .= '<td>Road Type</td>';
        }
        if (in_array('inspectorname', $gridcolumns)) {
            $value .= '<td>Inspector Name</td>';
        }
        if (in_array('dateofinspetcion', $gridcolumns)) {
            $value .= '<td>Inspection Date and Time</td>';
        }
        if (in_array('rvrd_applicationtype', $gridcolumns)) {
            $value .= '<td>Applicant Type</td>';
        }
        if (in_array('rvrd_inspectionstatus', $gridcolumns)) {
            $value .= '<td>Inspection Status</td>';
        }
        if (in_array('rvrd_permitstatus', $gridcolumns)) {
            $value .= '<td>Permit Status</td>';
        }
        if (in_array('dateofexp', $gridcolumns)) {
            $value .= '<td>Date of Expiry</td>';
        }
        $value .= '</tr>';
        $i = 1;
        foreach ($exportdata as $attend) {
  
            $value .= '<tr>';
            $value .= '<td valing="top">' . $i++ . '</td>';

            if (in_array('centre_name', $gridcolumns)) {
                if (empty($attend["compname_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["compname_en"] . '</td>';
                }
            }
            if (in_array('rvrd_applicationrefno', $gridcolumns)) {
                if (empty($attend["owner_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_applicationrefno"] . '</td>';
                }
            }
            if (in_array('appiim_officetype', $gridcolumns)) {
                if (empty($attend["appiim_officetype"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["appiim_officetype"] == 1) {
                        $value .= '<td valing="top">Main Office</td>';
                    } elseif ($attend["appiim_officetype"] == 2) {
                        $value .= '<td valing="top">Branch Office</td>';
                    }
                }
            }
            if (in_array('appiim_branchname_en', $gridcolumns)) {
                if (empty($attend["appiim_branchname_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["appiim_branchname_en"] . '</td>';
                }
            }
            if (in_array('owner_en', $gridcolumns)) {
                if (empty($attend["owner_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["owner_en"] . '</td>';
                }
            }
            if (in_array('rvrd_vechicleregno', $gridcolumns)) {
                if (empty($attend["rvrd_vechicleregno"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_vechicleregno"] . '</td>';
                }
            }
            if (in_array('rvrd_chassisno', $gridcolumns)) {
                if (empty($attend["rvrd_chassisno"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["rvrd_chassisno"] . '</td>';
                }
            }
            if (in_array('vehtype_en', $gridcolumns)) {
                if (empty($attend["vehtype_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["vehtype_en"] . '</td>';
                }
            }
            if (in_array('roadtype_en', $gridcolumns)) {
                if (empty($attend["roadtype_en"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["roadtype_en"] . '</td>';
                }
            }
            if (in_array('inspectorname', $gridcolumns)) {
                if (empty($attend["inspectorname"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["inspectorname"] . '</td>';
                }
            }
            if (in_array('dateofinspetcion', $gridcolumns)) {
                if (empty($attend["dateofinspetcion"])) {
                    $value .= '<td valing="top"> - </td>';
                } else if (empty($attend["startTime"]) && empty($attend["endTime"]) ) {
                    $value .= '<td valing="top">' . (string) $attend["dateofinspetcion"] .'</td>';
                }
                else
                {
                  $value .= '<td valing="top">' . (string) $attend["dateofinspetcion"] .' ('.(string) $attend["startTime"].'-'.(string) $attend["endTime"].')</td>';  
                }
            }
            if (in_array('rvrd_applicationtype', $gridcolumns)) {
                if (empty($attend["rvrd_applicationtype"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["rvrd_applicationtype"] == 1) {
                        $value .= '<td valing="top">Initial</td>';
                    } elseif ($attend["rvrd_applicationtype"] == 2) {
                        $value .= '<td valing="top">Renewal</td>';
                    }
                }
                
                 
            }
            if (in_array('rvrd_inspectionstatus', $gridcolumns)) {
                if (empty($attend["rvrd_inspectionstatus"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getinspectionSts($attend["rvrd_inspectionstatus"]) . '</td>';
                }
            }
            if (in_array('rvrd_permitstatus', $gridcolumns)) {
                if (empty($attend["rvrd_permitstatus"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getpermitSts($attend["rvrd_permitstatus"]) . '</td>';
                }
            }
            if (in_array('dateofexp', $gridcolumns)) {
                if (empty($attend["dateofexp"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["dateofexp"] . '</td>';
                }
            }

            $value .= '</tr>';
        }
        $value .= '</table>';

        $dom = new DOMDocument();
        $dom->loadHTML($value);
        $tableRows = $dom->getElementsByTagName('tr');

        $firstRowCells = $tableRows->item(1)->getElementsByTagName('td');

        $columnIndex = 1;
        foreach ($firstRowCells as $firstRowCell) {
            $cellValue = $firstRowCell->nodeValue;

            // Set cell value and formatting
            $cell = $worksheet->getCellByColumnAndRow($columnIndex, 3);
            $cell->setValue($cellValue);

            $style = $cell->getStyle();
            $style->getAlignment()->setWrapText(false);
            $style->getFont()->setSize(12);

            // Set cell borders
            $borderStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
            $style->applyFromArray($borderStyle);

            // Calculate column width based on the length of cell value
            $cellWidth = strlen($cellValue) + 10; // Add extra width for padding
            $worksheet->getColumnDimensionByColumn($columnIndex)->setWidth($cellWidth);

            $columnIndex++;
        }

        $rowIndex = 2; // Start appending after the first two rows
        foreach ($tableRows as $tableRow) {
            $tableCells = $tableRow->getElementsByTagName('td');

            $columnIndex = 1;
            foreach ($tableCells as $tableCell) {
                $cellValue = $tableCell->nodeValue;

                // Set cell value and formatting
                $cell = $worksheet->getCellByColumnAndRow($columnIndex, $rowIndex);
                $cell->setValue($cellValue);

                $style = $cell->getStyle();
                $style->getAlignment()->setWrapText(true);
                $style->getFont()->setSize(12);
                
                if ($rowIndex === 3) {

                    $style->getFont()->setBold(true);
                     
                    $style->getFill()->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('ffe7e7e7');
                }
                
                if ($rowIndex === 2 && $columnIndex === 1) {

                    $style->getFont()->setBold(true);
                    $style->getAlignment()->setWrapText(false);
                    $style->getFill()->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('ffe7e7e7');
                }

                // Set cell borders
                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ];
                $style->applyFromArray($borderStyle);

                $columnIndex++;
            }

            $rowIndex++;
        }
        
        //$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
//        $spreadsheetx  = new Spreadsheet();
        
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="'.$exeFileName.'"');
        header("Cache-Control: max-age=0");
        
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");        $writer->save($folder . $exeFileName . '.xlsx');

        $return['status'] = 1;
        $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/ras/ras/downloadgridata?filename=' . Security::encrypt($exeFileName)]);
        return $return;
    }

    public static function getinspectionSts($sts) {
        switch ($sts) {
            case 1 : return 'Inspection Pending';

            case 2 : return 'Verification Pending';

            case 3 : return 'Completed';

            case 4 : return 'Supervisor Approval Pending';

            case 5 : return 'Declined by Verifier';

            case 6 : return 'Declined by Supervisor';

            case 7 : return 'Re-Inspection Required';

            case 8 : return 'Rejected';

            case 9 : return 'Rejected and Cancelled';

            case 10 : return 'Cancelled(Renewal)';

            default : return '-';
        }
    }

    public static function getpermitSts($sts) {
        switch ($sts) {
            case 1 : return 'New';

            case 2 : return 'Valid';

            case 3 : return 'Expired';

            case 4 : return 'Cancelled';

            default : return '-';
        }
    }
    


public static function CheckInvoiceDueRAS($instPk)
    {
        $model = RoyaltyandasmtfeeTbl::find()
                ->where(['=','rasf_paidby',$instPk])
                ->andWhere(['=','rasf_projectmst_fk',4])
                ->andWhere(['=','rasf_feetype',1])
                ->andWhere(['IN','rasf_pymtstatus',[3]])
                ->andWhere(['=','rasf_invoicestatus',1])
                ->exists();
     
     
        if(!$model)
        {
            $model = RoyaltyandasmtfeehstyTbl::find()
                    ->where(['=','rasfh_paidby',$instPk])
                    ->andWhere(['=','rasfh_projectmst_fk',4])
                    ->andWhere(['=','rasfh_feetype',1])
                    ->andWhere(['IN','rasfh_pymtstatus',[3]])
                    ->andWhere(['=','rasfh_invoicestatus',1])
                    ->exists();
        }
        
        return $model;
               
    }   

}


?>