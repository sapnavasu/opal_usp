<?php

namespace api\components;

use api\models\MemcompfiledtlsTbl;
use api\modules\ivmsdev\controllers\DeviceController;
use app\models\AppdeviceinfomainTbl;
use app\models\AppinstinfomainTbl;
use app\models\AppstaffinfomainTbl;
use app\models\AuditanswerdtlsTbl;
use app\models\AuditchklstmstTbl;
use app\models\AuditquestionmstTbl;
use app\models\IvmsinspandapprovalhstyTbl;
use app\models\IvmsinspandapprovalTbl;
use app\models\IvmsinspansdtlshstyTbl;
use app\models\IvmsinspansdtlsTbl;
use app\models\IvmsinspquesdtlshstyTbl;
use app\models\IvmsinspquesdtlsTbl;
use app\models\IvmsvehicleregdtlshstyTbl;
use app\models\IvmsvehicleregdtlsTbl;
use app\models\OpalmemberregmstTbl;
use app\models\OpalusermstTbl;
use app\models\RascategorymstTbl;
use app\models\RasvehicleownerdtlshstyTbl;
use app\models\RasvehicleownerdtlsTbl;
use app\models\RasvehicleregdtlshstyTbl;
use app\models\RasvehicleregdtlsTbl;
use app\models\RasvehinsponquesdtlsTbl;
use app\models\ReferencemstTbl;
use Da\QrCode\QrCode;
use DOMDocument;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use ZipArchive;
use ZipStream\Exception;


class Ivmsdevice extends BaseObject {

    public static function saveIvmsVehicleDtls($requestdata) {

        $vehicleownerpk = RasvehicleownerdtlsTbl::saveVehicleOwner($requestdata);

        $ivmsvehiclepk = IvmsvehicleregdtlsTbl::saveVehicleDtls($vehicleownerpk, $requestdata);

        $data = [
            'vehicleownerpk' => $vehicleownerpk,
            'ivmsvehiclepk' => $ivmsvehiclepk,
        ];

        return $data;
    }

    public static function getivmsvehiclregdlsbyvhclpk($vehiclePk) {
        $model = IvmsvehicleregdtlsTbl::find()
                        ->select(['ivmsvehicleregdtls_pk', 'ivrd_opalmemberregmst_fk', 'ivrd_appinstinfomain_fk', 'ivrd_opalmemberregmst_fk', 'ivrd_rasvehicleownerdtls_fk', 'ivrd_vechicleregno', 'ivrd_chassisno', 'ivrd_appdeviceinfomain_fk', 'ivrd_softwareversion', 'ivrd_contpermailid', 'ivrd_contpermobno', 'ivrd_odometerreading', 'ivrd_ivmsserialno', 'ivrd_deviceimeino', 'ivrd_spdlimtseriealno', 'ivrd_vehiclemanufname', 'ivrd_speedlimitno', 'ivrd_vehiclemanufname', 'ivrd_vechiclecat', 'ivrd_vehiclesubcat', 'ivrd_vehiclefleetno', 'ivrd_driverfatiguemgmtsysmodel', 'ivrd_driverfatiguemgmtsysserialno', 'ivrd_simcardno', 'ivrd_simserviceprvdr', 'ivrd_simserviceprvdrothr', 'ivrd_primyspeedsource', 'ivrd_secndryspeedsource', 'ivrd_firstropregdate', 'ivrd_modelyear', 'ivrd_inststarttime', 'ivrd_instendtime', 'ivrd_Installername', 'rvod_ownername_ar', 'rvod_ownername_en', 'rvod_crnumber', 'ivrd_installationdate', 'appiim_applicationdtlsmain_fk', 'appiim_branchname_en', 'appiim_branchname_ar', 'appiim_officetype'])
                        ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = ivrd_rasvehicleownerdtls_fk')
                        ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = ivrd_appinstinfomain_fk')
                        ->where(['=', 'ivmsvehicleregdtls_pk', $vehiclePk])
                        ->asArray()->one();

        return $model;
    }

    public static function getIVMSDeviceGridData($data, $export = false) {
        $regPk = ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $loginuserdtls = OpalusermstTbl::findOne($userpk);

        $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $pageSize = empty($data['limit']) ? 10 : $data['limit'];
        $page = empty($data['page']) ? 0 : $data['page'];
        
        $sort = $data['sorting'];

        $datalist = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk as devicePk', 'IF(appiim_officetype = 1, "Main Office", IF(appiim_officetype = 2, "Branch Office", "-")) as office_type', 'appiim_branchname_en as branch_name', 'appiim_branchname_ar as branch_name_ar', 'rvod_ownername_en as owner_name', 'rvod_ownername_ar as owner_name_ar', 'ivrd_contpermailid as contact_person', 'ivrd_vechicleregno as vehichle_reg', 'ivrd_chassisno as chasis_number', 'appdim_modelno as ivms_device', 'ivrd_ivmsserialno as device_number', 'ivrd_deviceimeino as device_IMEI', 'rcm_coursesubcatname_en as vechile_cate', 'rcm_coursesubcatname_ar as vechile_cate_ar', 'irvrd_viewcertificatepath', 'ivrd_printcertificatepath', 'ivrd_opalmemberregmst_fk', 'omrm_branch_ar as compname_ar', 'omrm_branch_en as compname_en', 'rascategorymst_pk as category',
                    'vscm_vehiclename_en as vechile_Subcate', 'vscm_vehiclename_ar  as vechile_Subcate_ar', 'DATE_FORMAT(ivrd_installationdate,"%d-%m-%Y") AS installationdate_time', 'DATE_FORMAT(ivrd_inststarttime,"%h:%i %p") AS startTime', 'DATE_FORMAT(ivrd_instendtime,"%h:%i %p") AS endTime',
                    'ivrd_applicationtype as applicant_type', 'ivrd_Installername', 'oum_firstname as installer_name', 'ivrd_installationstatus as installation_status', 'ivrd_certificatestatus as certi_status', 'DATE_FORMAT(ivrd_dateofexpiry,"%d-%m-%Y") AS dateofexp', 'ivrd_odometerreading', 'ivrd_createdby',
                    'rvod_crnumber as crnumber', 'IF((now() > DATE_ADD(ivrd_dateofexpiry,INTERVAL - 2 MONTH) &&  ivrd_dateofexpiry > now()) , 1, 2)  AS ifNearingExpiry', 'if(ivrd_dateofexpiry < now() , 1, 2) as ifExpired '])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = ivrd_rasvehicleownerdtls_fk')
                ->leftJoin('appdeviceinfomain_tbl', 'ivrd_appdeviceinfomain_fk = appdeviceinfomain_pk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = ivrd_vechiclecat')
                ->leftJoin('vehiclesubcatmst_tbl', 'vehiclesubcatmst_pk = ivrd_vehiclesubcat')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = ivrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = ivrd_Installername')
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = ivrd_opalmemberregmst_fk')
                ->where('ivmsvehicleregdtls_pk is not null');

        if ($stktype == 2) {
            $datalist->andWhere('ivrd_opalmemberregmst_fk = ' . $regPk);
        } else if (($stktype == 1)) {
            $datalist->andWhere(1);
        } else {
            $datalist->andWhere(0);
        }

        if (!empty($data['searchkey'])) {

            if (!empty($data['searchkey']['centreName'])) {

                $datalist->having("omrm_branch_en  like '%" . trim($data['searchkey']['centreName']) . "%'");
            }
            if (!empty($data['searchkey']['officeType'])) {

                $datalist->andwhere("appiim_officetype in (" . implode(",", $data['searchkey']['officeType']) . ")");
            }
            if (!empty($data['searchkey']['ownerName'])) {
                $datalist->andwhere("rvod_ownername_en  like '%" . trim($data['searchkey']['ownerName']) . "%'");
            }
            if (!empty($data['searchkey']['vehichleReg'])) {
                $datalist->andwhere("ivrd_vechicleregno  like '%" . trim($data['searchkey']['vehichleReg']) . "%'");
            }
            if (!empty($data['searchkey']['chasisNumber'])) {
                $datalist->andwhere("ivrd_chassisno  like '%" . trim($data['searchkey']['chasisNumber']) . "%'");
            }
            if (!empty($data['searchkey']['ivmsDevice'])) {
                $datalist->andwhere("appdim_modelno  like '%" . trim($data['searchkey']['ivmsDevice']) . "%'");
            }
            if (!empty($data['searchkey']['deviceNumber'])) {
                $datalist->andwhere("ivrd_ivmsserialno  like '%" . trim($data['searchkey']['deviceNumber']) . "%'");
            }
            if (!empty($data['searchkey']['installerName'])) {
                $datalist->andwhere("oum_firstname  like '%" . trim($data['searchkey']['installerName']) . "%'");
            }
            if (!empty($data['searchkey']['installationDate'])) {
                $datalist->andwhere("ivrd_installationdate  between '" . date("Y-m-d", strtotime($data['searchkey']['installationDate']['startDate'])) . "' and '" . date("Y-m-d", strtotime(trim($data['searchkey']['installationDate']['endDate']))) . "'");
            }
            if (!empty($data['searchkey']['applicantType'])) {

                $datalist->andwhere("ivrd_applicationtype in (" . implode(",", $data['searchkey']['applicantType']) . ")");
            }
            if (!empty($data['searchkey']['installationStatus'])) {

                $datalist->andwhere("ivrd_installationstatus in (" . implode(",", $data['searchkey']['installationStatus']) . ")");
            }
            if (!empty($data['searchkey']['installCertiStatus'])) {

                $datalist->andwhere("ivrd_certificatestatus in (" . implode(",", $data['searchkey']['installCertiStatus']) . ")");
            }
            if (!empty($data['searchkey']['expiryDate'])) {

                $datalist->andwhere("ivrd_dateofexpiry  between '" . date("Y-m-d", strtotime(trim($data['searchkey']['expiryDate']['startDate']))) . "' and '" . date("Y-m-d", strtotime(trim($data['searchkey']['expiryDate']['endDate']))) . "'");
            }

            if (!empty($data['searchkey']['contactPerson'])) {
                $datalist->andwhere("ivrd_contpermailid  like '%" . trim($data['searchkey']['contactPerson']) . "%'");
            }
            if (!empty($data['searchkey']['deviceIMEI'])) {
                $datalist->andwhere("ivrd_deviceimeino  like '%" . trim($data['searchkey']['deviceIMEI']) . "%'");
            }

            if (!empty($data['searchkey']['vechileCate'])) {
                $datalist->having("rcm_coursesubcatname_en  like '%" . trim($data['searchkey']['vechileCate']) . "%' OR rcm_coursesubcatname_ar  like '%" . trim($data['searchkey']['vechileCate']) . "%'");
            }
            if (!empty($data['searchkey']['vechileSubCate'])) {
                $datalist->having("vscm_vehiclename_en  like '%" . trim($data['searchkey']['vechileSubCate']) . "%' OR vscm_vehiclename_ar  like '%" . trim($data['searchkey']['vechileSubCate']) . "%'");
            }

            if (!empty($data['searchkey']['branchName'])) {

                $datalist->andwhere("appiim_branchname_en  like '%" . trim($data['searchkey']['branchName']) . "%'");
            }
            if (!empty($data['searchkey']['crnumber'])) {

                $datalist->andwhere("rvod_crnumber  like '%" . trim($data['searchkey']['crnumber']) . "%'");
            }
        }
       
        if(!empty($sort))
        {
            
            if($sort['key'] == 'centre_name'){
              
                 $datalist->orderBy('omrm_branch_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'office_type'){
              
                 $datalist->orderBy('office_type '.$sort['dir']);
                
            }
            if($sort['key'] == 'branch_name'){
              
                 $datalist->orderBy('appiim_branchname_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'owner_name'){
              
                 $datalist->orderBy('rvod_ownername_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'contact_person'){
              
                 $datalist->orderBy('ivrd_contpermailid '.$sort['dir']);
                
            }
            if($sort['key'] == 'vehichle_reg'){
              
                 $datalist->orderBy('ivrd_vechicleregno '.$sort['dir']);
                
            }
            if($sort['key'] == 'chasis_number'){
              
                 $datalist->orderBy('ivrd_chassisno '.$sort['dir']);
                
            }
            if($sort['key'] == 'ivms_device'){
              
                 $datalist->orderBy('appdim_modelno '.$sort['dir']);
                
            }
            if($sort['key'] == 'device_number'){
              
                 $datalist->orderBy('ivrd_ivmsserialno '.$sort['dir']);
                
            }
            if($sort['key'] == 'device_IMEI'){
              
                 $datalist->orderBy('ivrd_deviceimeino '.$sort['dir']);
                
            }
            if($sort['key'] == 'vechile_cate'){
              
                 $datalist->orderBy('rcm_coursesubcatname_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'vechile_Subcate'){
              
                 $datalist->orderBy('vscm_vehiclename_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'installer_name'){
              
                 $datalist->orderBy('oum_firstname '.$sort['dir']);
                
            }
            if($sort['key'] == 'installationdate_time'){
              
                 $datalist->orderBy('ivrd_installationdate '.$sort['dir']);
                
            }
            
            if($sort['key'] == 'dateofexp'){
              
                 $datalist->orderBy('ivrd_dateofexpiry '.$sort['dir']);
                
            }
            if($sort['key'] == 'cr_number'){
              
                 $datalist->orderBy('rvod_crnumber '.$sort['dir']);
                
            }
            
        }
        else
        {
             $datalist->orderBy(['ifnull(ivrd_updatedon,ivrd_createdon)' => SORT_DESC]);
        }
        
     
        $datalist->asArray();

        if ($export) {
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
//        $recodsset['roadtype'] = $roadtype;
        $recodsset['pagesize'] = $pageSize;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();

        return ['dataset' => $recodsset];
    }

    public static function getIVMSVehicleDtlsByPk($ivmsvehiclePk) {

        $vehicleregpk = Security::decrypt($ivmsvehiclePk);

        $data = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk as devicePk', 'appiim_officetype as office_type', 'appiim_branchname_en as branch_name', 'appiim_branchname_ar as branch_name_ar', 'rvod_ownername_en as owner_name', 'rvod_ownername_ar as owner_name_ar', 'ivrd_contpermailid as contact_person', 'ivrd_vechicleregno as vehichle_reg', 'ivrd_chassisno as chasis_number', 'appdim_modelno as ivms_device', 'ivrd_ivmsserialno as device_number', 'ivrd_deviceimeino as device_IMEI', 'ivrd_softwareversion as softVersion', 'rcm_coursesubcatname_en as vechile_cate', 'rcm_coursesubcatname_ar as vechile_cate_ar', 'irvrd_viewcertificatepath', 'ivrd_printcertificatepath', 'ivrd_opalmemberregmst_fk', 'omrm_branch_ar as compname_ar', 'omrm_branch_en as compname_en', 'rascategorymst_pk as category', 'a.rm_name_en as manufac_name_en', 'a.rm_name_ar as manufac_name_ar', 'ivrd_simcardno as simnum', 'IF(ivrd_simserviceprvdr is not null,b.rm_name_en,ivrd_simserviceprvdrothr) as simprovider_en', 'IF(ivrd_simserviceprvdr is not null,b.rm_name_en,ivrd_simserviceprvdrothr) as simprovider_ar', 'ivrd_secndryspeedsource as secondary_spd', 'ivrd_primyspeedsource as primary_spd', 'ivrd_spdlimtseriealno as spdlmtslnum', 'ivrd_vehiclefleetno as fleetnum', 'DATE_FORMAT(ivrd_firstropregdate,"%d-%m-%Y") AS frstropdt', 'DATE_FORMAT(ivrd_firstropregdate,"%Y") AS frstropyr', 'ivrd_modelyear as modelyr','DATE_FORMAT(ivrd_dateoffiiting,"%d-%m-%Y") AS dateoffittin','DATE_FORMAT(ivrd_dateofreplacement,"%d-%m-%Y") AS dateofrepla',
                    'vscm_vehiclename_en as vechile_Subcate', 'vscm_vehiclename_ar  as vechile_Subcate_ar', 'DATE_FORMAT(ivrd_installationdate,"%d-%m-%Y") AS installationdate_time', 'DATE_FORMAT(ivrd_inststarttime,"%h:%i %p") AS startTime', 'DATE_FORMAT(ivrd_instendtime,"%h:%i %p") AS endTime',
                    'ivrd_applicationtype as applicant_type', 'ivrd_Installername', 'oum_firstname as installer_name', 'ivrd_installationstatus as installation_status', 'ivrd_certificatestatus as certi_status', 'DATE_FORMAT(ivrd_dateofexpiry,"%d-%m-%Y") AS dateofexp', 'ivrd_odometerreading as odometer', 'ivrd_createdby',
                    'rvod_crnumber as crnumber', 'IF((now() > DATE_ADD(ivrd_dateofexpiry,INTERVAL - 2 MONTH) &&  ivrd_dateofexpiry > now()) , 1, 2)  AS ifNearingExpiry', 'if(ivrd_dateofexpiry < now() , 1, 2) as ifExpired '])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = ivrd_rasvehicleownerdtls_fk')
                ->leftJoin('referencemst_tbl a', 'ivrd_vehiclemanufname = a.referencemst_pk')
                ->leftJoin('referencemst_tbl b', 'ivrd_simserviceprvdr = b.referencemst_pk')
                ->leftJoin('appdeviceinfomain_tbl', 'ivrd_appdeviceinfomain_fk = appdeviceinfomain_pk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = ivrd_vechiclecat')
                ->leftJoin('vehiclesubcatmst_tbl', 'vehiclesubcatmst_pk = ivrd_vehiclesubcat')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = ivrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = ivrd_Installername')
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = ivrd_opalmemberregmst_fk')
                ->where(['=', 'ivmsvehicleregdtls_pk', $vehicleregpk])
                ->asArray()
                ->one();

        return $data;
    }

    public static function getivmsvhclregstatus($pk) {
        $device = IvmsvehicleregdtlsTbl::findOne($pk);

        return $device->ivrd_installationstatus;
    }

    public static function getInspectionDetailsForEdit($vehiclPk) {

        $result = IvmsinspandapprovalTbl::find()
                ->select(['ivmsinspandapproval_pk as pk', 'ivrd_installationstatus as status', 'iia_insptype as inspType', 'iia_report as inspReport', 'iia_comments as inspComment', ' DATE_FORMAT(iia_appdecon,"%d-%m-%Y") as declinedOn', 'iia_appdecComments as declineComments', 'iia_appdecby', 'oum_firstname as declinedBy'])
                ->leftJoin('ivmsvehicleregdtls_tbl', 'iia_ivmsvehicleregdtls_fk = ivmsvehicleregdtls_pk')
                ->leftJoin('opalusermst_tbl', 'iia_appdecby = opalusermst_pk')
                ->where(['=', 'iia_ivmsvehicleregdtls_fk', $vehiclPk])
                ->asArray()
                ->one();

        $cheklist = self::getOnlinechecklistforEdit($result['pk']);

        $result['checklist'] = $cheklist;

        return $result;
    }

    public static function getOnlinechecklistforEdit($approvalpk) {



        $checklist = [];

//        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        $auditpks = AuditchklstmstTbl::find()
                ->select(['auditchklstmst_pk as chklst'])
                ->where(['=', 'aclm_projectmst_fk', 5])
                ->andWhere(['=', 'aclm_status', 1])
                ->orderBy('aclm_order')
                ->asArray()
                ->all();

        foreach ($auditpks as $keys => $pk) {
            $checklist[$keys] = $pk;
            $questions = IvmsinspquesdtlsTbl::find()
                    ->select(['iiqd_auditquestionmst_fk as mstPk', 'ivmsinspquesdtls_pk as ivmsquesPk', 'aqm_questiontype as type'])
                    ->leftJoin('auditquestionmst_tbl', 'auditquestionmst_pk = iiqd_auditquestionmst_fk')
                    ->where(['=', 'aqm_auditchklstmst_fk', $pk['chklst']])
                    ->andWhere(['=', 'iiqd_ivmsinspandapproval_fk', $approvalpk])
                    ->andWhere(['=', 'aqm_status', 1])
                    ->orderBy('aqm_order')
                    ->asArray()
                    ->all();

            foreach ($questions as $key => $ques) {
                $checklist[$keys]['ques'][$key] = $ques;

                if ($ques['type'] == 1) {
                    $ansOptions = IvmsinspansdtlsTbl::find()
                            ->select(['iiad_auditanswerdtls_fk as mstPk', 'ivmsinspansdtls_pk as ivmsansPk', 'iiad_isselected as ifselected', 'iiad_comments as ansComments', 'iiad_fileupload as ansDoc', 'IF((iiad_comments is not  NULL || iiad_fileupload is not NULL),  1, 0) AS toggleOpen'])
                            ->where(['=', 'iiad_ivmsinspquesdtls_fk', $ques['ivmsquesPk']])
                            ->andWhere(['=', 'iiad_isselected', 1])
                            ->orderBy('iiad_order')
                            ->asArray()
                            ->one();
                    $checklist[$keys]['ques'][$key]['ansoptions'] = $ansOptions;
                    $checklist[$keys]['ques'][$key]['toggleOpen'] = $ansOptions['toggleOpen'];
                } else if ($ques['type'] == 3) {
                    $ansOptions = IvmsinspansdtlsTbl::find()
                            ->select(['iiad_auditanswerdtls_fk as mstPk', 'ivmsinspansdtls_pk as ivmsansPk', 'iiad_details as details', 'iiad_comments as ansComments', 'iiad_fileupload as ansDoc', 'IF((iiad_comments is not  NULL || iiad_fileupload is not NULL),  1, 0) AS toggleOpen'])
                            ->where(['=', 'iiad_ivmsinspquesdtls_fk', $ques['ivmsquesPk']])
                            ->orderBy('iiad_order')
                            ->asArray()
                            ->all();

                    $checklist[$keys]['ques'][$key]['ansoptions'] = $ansOptions;
                    $checklist[$keys]['ques'][$key]['toggleOpen'] = $ansOptions[0]['toggleOpen'];
                }
            }
        }


        return $checklist;
    }

    public static function submitForApproval($data) {

        $record = null;

        if ($data['inspctiontype'] == 2) {

            $record = self::submitForApprovalOffline($data);
        } else if ($data['inspctiontype'] == 1) {
            $transaction = Yii::$app->db->beginTransaction();
            $vehicle = IvmsvehicleregdtlsTbl::findOne($data['vehicleregpk']);
            $onlineapprv = self::submitForApprovalOnline($data);

            $result = self::insertChecklistData($data, $onlineapprv, $vehicle->ivrd_installationstatus);

            $record['vehicleapproval'] = $onlineapprv;
            $record['chklist'] = $result;
            $transaction->commit();
            self::sendMailtoSrTechinicians($data['vehicleregpk']);
        }

        return $record;
    }

    public static function submitForApprovalOffline($data) {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = IvmsvehicleregdtlsTbl::findOne($data['vehicleregpk']);
        
        if ($vehicle) {
            if ($vehicle->ivmsinspandapprovalTbl) {
                $approval = $vehicle->ivmsinspandapprovalTbl;
            }

            $transaction = Yii::$app->db->beginTransaction();

            if ($vehicle) {

                if ($approval) {
                    $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($data['vehicleregpk'], $data['status']);
                    $historyapproval = IvmsinspandapprovalhstyTbl::movetohistory($approval);
                    self::UpdateOnlineChecklistRenewal($data, $approval->ivmsinspandapproval_pk);
                    $model = $approval;
                    $model->iia_updatedon = date('Y-m-d H:i:s');
                    $model->iia_updatedby = $userpk;
                } else {
                    $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($data['vehicleregpk'], $data['status']);
                    $model = new IvmsinspandapprovalTbl();
                    $model->iia_createdon = date('Y-m-d H:i:s');
                    $model->iia_createdby = $userpk;
                }
                $model->iia_ivmsvehicleregdtls_fk = $data['vehicleregpk'];
                $model->iia_insptype = $data['inspctiontype'];
                $model->iia_report = implode(',', $data['reportdocument']);
                $model->iia_comments = $data['comments'];

                if ($model->validate() && $model->save() && $vehiclereg) {
                    $transaction->commit();
                    return $model->ivmsinspandapproval_pk;
                } else {
                    $transaction->rollback();
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                }
            }
        }
    }

    public static function submitForApprovalOnline($data) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = IvmsvehicleregdtlsTbl::findOne($data['vehicleregpk']);
        if ($vehicle->ivmsinspandapprovalTbl) {
            $approval = $vehicle->ivmsinspandapprovalTbl;
        }

        if ($vehicle) {
            if ($approval) {
                $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($data['vehicleregpk'], $data['status']);
                $historyapproval = IvmsinspandapprovalhstyTbl::movetohistory($approval);
                $model = $approval;

                $model->iia_updatedon = date('Y-m-d H:i:s');
                $model->iia_updatedby = $userpk;
            } else {
                $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($data['vehicleregpk'], $data['status']);
                $model = new IvmsinspandapprovalTbl();
                $model->iia_createdon = date('Y-m-d H:i:s');
                $model->iia_createdby = $userpk;
            }
            $model->iia_ivmsvehicleregdtls_fk = $data['vehicleregpk'];
            $model->iia_insptype = $data['inspctiontype'];
            $model->iia_comments = $data['comments'];
            $model->iia_report = null;

            if ($model->save() && $vehiclereg) {

                return $model->ivmsinspandapproval_pk;
            } else {
                $transaction->rollback();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
    }

    public static function insertChecklistData($data, $approvalpk, $existinginspStatus) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = null;
        $checklist = $data['onlinechecklist'];

        $oldrecord = IvmsinspquesdtlsTbl::find()->where(['=', 'iiqd_ivmsinspandapproval_fk', $approvalpk])->exists();
        foreach ($checklist as $category) {
            $mstchecklist = self::getChecklistByMstPk($category['categorypk']);

            if (!$oldrecord) {
                foreach ($mstchecklist as $list) {
                    $modelques = new IvmsinspquesdtlsTbl();
                    $modelques->iiqd_auditquestionmst_fk = $list['auditquestionmst_pk'];
                    $modelques->iiqd_ivmsinspandapproval_fk = $approvalpk;
                    $modelques->iiqd_question_en = $list['aqm_question_en'];
                    $modelques->iiqd_question_ar = $list['aqm_question_ar'];
                    $modelques->iiqd_order = $list['aqm_order'];
                    $modelques->iiqd_createdon = date('Y-m-d H:i:s');
                    $modelques->iiqd_createdby = $userpk;

                    if ($modelques->save()) {

                        $quesvalue = $modelques->ivmsinspquesdtls_pk;
                       
                        $anslist[$quesvalue] = self::insertAnsValues($category['categorylist'], $quesvalue, $list['ansoptions']);

                        $chklistresult['ques'] = $quesvalue;
                        $chklistresult['ans'] = $anslist;
                    } else {
                        echo "<pre>";
                        var_dump($modelques->getErrors());
                        exit;
                    }
                }
            } else {
                if ($existinginspStatus == 1) {
                    self::UpdateOnlineChecklistRenewal($data, $approvalpk);
                    foreach ($mstchecklist as $list) {
                        $modelques = new IvmsinspquesdtlsTbl();
                    $modelques->iiqd_auditquestionmst_fk = $list['auditquestionmst_pk'];
                    $modelques->iiqd_ivmsinspandapproval_fk = $approvalpk;
                    $modelques->iiqd_question_en = $list['aqm_question_en'];
                    $modelques->iiqd_question_ar = $list['aqm_question_ar'];
                    $modelques->iiqd_order = $list['aqm_order'];
                    $modelques->iiqd_createdon = date('Y-m-d H:i:s');
                    $modelques->iiqd_createdby = $userpk;

                        if ($modelques->save()) {
                            $quesvalue = $modelques->ivmsinspquesdtls_pk;

                            $anslist[$quesvalue] = self::insertAnsValues($category['categorylist'], $quesvalue, $list['ansoptions']);

                            $chklistresult['ques'] = $quesvalue;
                            $chklistresult['ans'] = $anslist;
                        } else {
                            echo "<pre>";
                            var_dump($modelques->getErrors());
                            exit;
                        }
                    }
                } else {

                    $result = self::updateOnlineChecklist($data, $approvalpk);
                }
            }

            $resultlist[] = $chklistresult;
        }

        return $resultlist;
    }

    public static function insertAnsValues($fomdata, $rasvehiclquepk, $datalist) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);

        foreach ($fomdata as $data) {

            foreach ($datalist as $ans) {


                if ($data['questiontyp'] == 1) {
                   
                    if ($ans['aad_auditquestionmst_fk'] == $data['question'] && $ans['auditanswerdtls_pk'] == $data['answer']) {
                        $rasansmodel = new IvmsinspansdtlsTbl();
                        $rasansmodel->iiad_ivmsinspquesdtls_fk = $rasvehiclquepk;
                        $rasansmodel->iiad_auditanswerdtls_fk = (int) $ans['auditanswerdtls_pk'];
                        $rasansmodel->iiad_answer_en = $ans['aad_answer_en'];
                        $rasansmodel->iiad_answer_ar = $ans['aad_answer_ar'];
                        $rasansmodel->iiad_order = $ans['aad_order'];
                        $rasansmodel->iiad_isselected = 1;
                        $rasansmodel->iiad_comments = $data['chklistcomments'] ? $data['chklistcomments'] : null;
                        $rasansmodel->iiad_fileupload = $data['chcklistdoc'] ? implode(',', $data['chcklistdoc']) : null;
                        $rasansmodel->iiad_createdon = date('Y-m-d H:i:s');
                        $rasansmodel->iiad_createdby = $userpk;

                        if ($rasansmodel->save()) {

                            $rasanws[] = $rasansmodel->ivmsinspansdtls_pk;
                        } else {
                             

                            echo "<pre>";
                            var_dump($rasansmodel->getErrors());
                            exit;
                        }
                    } else if ($ans['aad_auditquestionmst_fk'] == $data['question']) {
                        $rasansmodel = new IvmsinspansdtlsTbl();
                        $rasansmodel->iiad_ivmsinspquesdtls_fk = $rasvehiclquepk;
                        $rasansmodel->iiad_auditanswerdtls_fk = (int) $ans['auditanswerdtls_pk'];
                        $rasansmodel->iiad_answer_en = $ans['aad_answer_en'];
                        $rasansmodel->iiad_answer_ar = $ans['aad_answer_ar'];
                        $rasansmodel->iiad_order = $ans['aad_order'];
                        $rasansmodel->iiad_isselected = 2;
                        $rasansmodel->iiad_comments = null;
                        $rasansmodel->iiad_fileupload = null;
                        $rasansmodel->iiad_createdon = date('Y-m-d H:i:s');
                        $rasansmodel->iiad_createdby = $userpk;

                        if ($rasansmodel->save()) {

                            $rasanws[] = $rasansmodel->ivmsinspansdtls_pk;
                        } else {
                         
                             echo "<pre>";
                            var_dump($rasansmodel->getErrors());
                            exit;
                        }
                    }
                } else {

                    if ($ans['aad_auditquestionmst_fk'] == $data['question']) {
                        foreach ($data['answerlist'] as $records) {

                            if ($ans['auditanswerdtls_pk'] == $records['anspk']) {
                                $rasansmodel = new IvmsinspansdtlsTbl();
                                $rasansmodel->iiad_ivmsinspquesdtls_fk = $rasvehiclquepk;
                                $rasansmodel->iiad_auditanswerdtls_fk = (int) $records['anspk'];
                                $rasansmodel->iiad_answer_en = $ans['aad_answer_en'];
                                $rasansmodel->iiad_answer_ar = $ans['aad_answer_ar'];
                                $rasansmodel->iiad_order = $ans['aad_order'];
                                $rasansmodel->iiad_details = $records['trigger'];
                                $rasansmodel->iiad_comments = $data['chklistcomments'] ? $data['chklistcomments'] : null;
                                $rasansmodel->iiad_fileupload = $data['chcklistdoc'] ? implode(',', $data['chcklistdoc']) : null;
                                $rasansmodel->iiad_createdon = date('Y-m-d H:i:s');
                                $rasansmodel->iiad_createdby = $userpk;

                                if ($rasansmodel->save()) {

                                    $rasanws[] = $rasansmodel->ivmsinspansdtls_pk;
                                } else {
                                
                                    
                                     echo "<pre>";
                                    var_dump($rasansmodel->getErrors());
                                    exit;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $rasanws;
    }

    public static function getChecklistByMstPk($auditpk) {
        $checklist = [];

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
                    ->select(['auditanswerdtls_pk', 'aad_auditquestionmst_fk', 'aad_answer_en', 'aad_answer_ar', 'aad_order', 'aad_ismandatory'])
                    ->where(['=', 'aad_auditquestionmst_fk', $ques['auditquestionmst_pk']])
                    ->andWhere(['=', 'aad_status', 1])
                    ->orderBy('aad_order')
                    ->asArray()
                    ->all();
            $checklist[$key]['ansoptions'] = $ansOptions;
        }

        return $checklist;
    }

    public static function getInstallationDtls($vhclRegPk) {



        $data = IvmsinspandapprovalTbl::find()
                ->select(['ivrd_Installername', 'iia_insptype as inspType', 'iia_report as document', 'iia_comments as inspComments', 'DATE_FORMAT(iia_createdon,"%d-%m-%Y")  as submittedOn', 'iia_createdby', 'a.oum_firstname as submittedBy', 'ivrd_installationstatus', 'iia_updatedby', 'b.oum_firstname as lastupdatedBy', 'DATE_FORMAT(iia_updatedon,"%d-%m-%Y")  as lastupdatedOn', ' DATE_FORMAT(iia_appdecon,"%d-%m-%Y") as apprvdOn', 'iia_appdecby', 'c.oum_firstname as approvedBy', 'iia_appdecComments as apprvdComments', 'a.oum_opalmemberregmst_fk as memberRegPk', 'ivmsinspandapproval_pk as approvalpk'])
                ->leftJoin('ivmsvehicleregdtls_tbl', 'iia_ivmsvehicleregdtls_fk = ivmsvehicleregdtls_pk')
                ->leftJoin('opalusermst_tbl a', 'iia_createdby = a.opalusermst_pk')
                ->leftJoin('opalusermst_tbl b', 'iia_updatedby = b.opalusermst_pk')
                ->leftJoin('opalusermst_tbl c', 'iia_appdecby = c.opalusermst_pk')
                ->where(['=', 'ivmsvehicleregdtls_pk', $vhclRegPk])
                ->asArray()
                ->one();

        if ($data['document']) {
            $records = explode(',', $data['document']);
            $i = 0;
            foreach ($records as $record) {
                $data['prooflink'][$i]['link'] = Drive::generateUrl($record, $data['memberRegPk'], $data['iia_createdby']);
                $data['prooflink'][$i]['filetype'] = MemcompfiledtlsTbl::getFileTypeByPk($record);
                $i++;
            }
        }
        if ($data['inspType'] == 1) {
            $data['checklist'] = self::getIvmsvehicleQuesAndResponse($data['approvalpk']);
        }
       

        return $data;
    }

    public static function getColourCodetext($maskalltext) {
        switch ($maskalltext) {
            case 'Approve All' : return ['pass' => 'Approve', 'fail' => 'Not Approve'];

            case 'Mark all as Checked' : return ['pass' => 'Checked', 'fail' => 'Not Checked'];

            case 'Mark all as Comply' : return ['pass' => 'Comply', 'fail' => 'Not Complied'];

            default : return ['pass' => 'Pass', 'fail' => 'Fail'];
        }
    }

    public static function getIvmsvehicleQuesAndResponse($approvalPk) {
        $checklist = [];

        $auditpks = AuditchklstmstTbl::find()
                ->select(['auditchklstmst_pk', 'aclm_categorytitle_en as categoryname_en', 'aclm_categorytitle_ar as categoryname_ar', 'aclm_order', 'aclm_markalltext_en'])
                ->where(['=', 'aclm_projectmst_fk', 5])
                ->andWhere(['=', 'aclm_status', 1])
                ->orderBy('aclm_order')
                ->asArray()
                ->all();

        foreach ($auditpks as $keys => $audit) {
            $checklist[$keys] = $audit;

            $validators = self::getColourCodetext($audit['aclm_markalltext_en']);

            $questions = IvmsinspquesdtlsTbl::find()
                            ->select(['ivmsinspquesdtls_pk', 'iiqd_question_en', 'iiqd_question_ar', 'aqm_questiontype'])
                            ->leftJoin('auditquestionmst_tbl', 'auditquestionmst_pk = iiqd_auditquestionmst_fk')
                            ->where(['=', 'iiqd_ivmsinspandapproval_fk', $approvalPk])
                            ->andWhere(['=', 'aqm_auditchklstmst_fk', $audit['auditchklstmst_pk']])->asArray()->all();

            $vehicle = IvmsinspandapprovalTbl::findOne($approvalPk);

            $memregpk = $vehicle->iiaIvmsvehicleregdtlsFk->ivrd_opalmemberregmst_fk;

            foreach ($questions as $key => $list) {
                $checklist[$keys]['ques'][$key] = $list;

                if ($list['aqm_questiontype'] == 1) {
                    $ansOptions = IvmsinspansdtlsTbl::find()
                            ->select(['iiad_answer_en', 'iiad_answer_ar', 'iiad_fileupload as upload', 'iiad_comments as comments', 'iiad_createdby', 'iiad_details', 'if(iiad_answer_en = "' . $validators['pass'] . '",1,if(iiad_answer_en = "' . $validators['fail'] . '",2,3)) as colourcode'])
                            ->where(['=', 'iiad_ivmsinspquesdtls_fk', $list['ivmsinspquesdtls_pk']])
                            ->andWhere(['=', 'iiad_isselected', 1])
                            ->asArray()
                            ->one();
                    if ($ansOptions['upload']) {
                        $records = explode(',', $ansOptions['upload']);
                        $i = 0;

                        foreach ($records as $record) {
                            $ansOptions['prooflink'][$i]['link'] = Drive::generateUrl($record, $memregpk, $ansOptions['iiad_createdby']);
                            $ansOptions['prooflink'][$i]['filetype'] = MemcompfiledtlsTbl::getFileTypeByPk($record);
                            $i++;
                        }
                    }

                    $checklist[$keys]['ques'][$key] = array_merge($checklist[$keys]['ques'][$key], $ansOptions);
                } else {
                    $ans = [];
                    $ansOptions = IvmsinspansdtlsTbl::find()
                                    ->select(['iiad_answer_en', 'iiad_answer_ar', 'iiad_fileupload as upload', 'iiad_comments as comments', 'iiad_createdby', 'iiad_details'])
                                    ->where(['=', 'iiad_ivmsinspquesdtls_fk', $list['ivmsinspquesdtls_pk']])
                                    ->asArray()->all();

                    if ($ansOptions[0]['upload']) {
                        $records = explode(',', $ansOptions[0]['upload']);
                        $i = 0;

                        foreach ($records as $record) {
                            $ans['prooflink'][$i]['link'] = Drive::generateUrl($record, $memregpk, $ansOptions[0]['iiad_createdby']);
                            $ans['prooflink'][$i]['filetype'] = MemcompfiledtlsTbl::getFileTypeByPk($record);
                            $ans['comments'] = $ansOptions[0]['comments'];
                        }
                    }
                    $ans['data'] = $ansOptions;

                    $checklist[$keys]['ques'][$key]['answerlist'] = $ans;
                }
            }
        }



        return $checklist;
    }

    public static function approvalSubmit($data) {
        $record = null;

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);
        $verifierstatus = ($data['verifierStatus'] == 1) ? 3 : 7;

        if ($vehicle->ivrd_installationstatus == 2) {
            $inspection = IvmsinspandapprovalTbl::find()->where(['=', 'iia_ivmsvehicleregdtls_fk', $vehicle->ivmsvehicleregdtls_pk])->one();
            $transaction = Yii::$app->db->beginTransaction();
            if ($inspection) {

                $modelhsty = IvmsinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($vehicleregpk, $verifierstatus);

                $inspection->iia_appdecon = date('Y-m-d H:i:s');
                $inspection->iia_appdecby = $userpk;
                $inspection->iia_appdecComments = $data['verifierComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {
                    $transaction->commit();
                    $record = $inspection->ivmsinspandapproval_pk;
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

    public static function ChkiflogoExists($vehiclepk) {
        $vehicleregpk = Security::decrypt($vehiclepk);
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);

        $complogo = OpalmemberregmstTbl::findOne($vehicle->ivrd_opalmemberregmst_fk);

        if ($complogo->omrm_cmplogo) {
            return true;
        }

        return false;
    }

    public static function updateDevicereplacement($vehicleregpk) {
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);

        $vehiclenumber = trim(\api\components\Security::sanitizeInput(trim($vehicle->ivrd_vechicleregno), 'string'));

        $oldcompanyrecord = IvmsvehicleregdtlsTbl::find()->where(["REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" => trim($vehiclenumber)])->andWhere(['=', 'ivrd_opalmemberregmst_fk', $vehicle->ivrd_opalmemberregmst_fk])->andWhere(['<>', 'ivmsvehicleregdtls_pk', $vehicleregpk])->orderBy('ivmsvehicleregdtls_pk DESC')->one();

        $oldcompanyrecord->ivrd_installationstatus = 6;
        $oldcompanyrecord->ivrd_certificatestatus = 4;

        $oldcompanyrecord->ivrd_updatedby = $userpk;
        $oldcompanyrecord->ivrd_updatedon = date('Y-m-d H:i:s');

        if (!$oldcompanyrecord->validate() || !$oldcompanyrecord->save()) {
            echo "<pre>";
            var_dump($oldcompanyrecord->getErrors());
            exit;
        } else {
            $vehicle->ivrd_dateoffiiting = $oldcompanyrecord->ivrd_dateoffiiting;
            if (!$vehicle->validate() || !$vehicle->save()) {
                echo "<pre>";
                var_dump($vehicle->getErrors());
                exit;
            } else {
                return true;
            }
        }
    }

    public static function issueCertificate($data) {
        $record = null;
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);

        if ($vehicle->ivrd_applicationtype == 2) {
            $deviceReplacement = self::updateDevicereplacement($vehicleregpk);
        }

        if ($vehicle->ivrd_installationstatus == 2) {
            $supervisorstatus = ($data['supervisorStatus'] == 1) ? 3 : 7;
            $inspection = IvmsinspandapprovalTbl::find()->where(['=', 'iia_ivmsvehicleregdtls_fk', $vehicle->ivmsvehicleregdtls_pk])->one();

            if ($inspection) {
                $modelhsty = IvmsinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($vehicleregpk, $supervisorstatus);

                $inspection->iia_appdecon = date('Y-m-d H:i:s');
                $inspection->iia_appdecby = $userpk;
                $inspection->iia_appdecComments = $data['supervisorComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {

                    $record = $inspection->ivmsinspandapproval_pk;
                } else {
                    echo "<pre>";
                    var_dump($inspection->getErrors());
                    exit;
                }
            }
        }


        return $record;
    }

    public static function ivmsCertificate($encpk, $isregen) {

        $requestdata = $encpk;
        $isregenerate = $isregen;

        $pk = Security::decrypt($requestdata);
        $regPk = ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userdata = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk', 'ivrd_opalmemberregmst_fk', 'appiim_officetype', 'appiim_branchname_en', 'appiim_branchname_ar', 'rvod_ownername_en as owner_en', 'rvod_ownername_ar as owner_ar', 'ivrd_vechicleregno', 'ivrd_chassisno', 'rcm_coursesubcatname_en as vehtype_en', 'rcm_coursesubcatname_ar as vehtype_ar', 'ivrd_ivmsserialno',
                    'DATE_FORMAT(ivrd_installationdate,"%d-%m-%Y") AS dateofinspetcion',
                    'ivrd_applicationtype', 'ivrd_installationstatus', 'ivrd_certificatestatus', 'DATE_FORMAT(ivrd_dateofexpiry,"%d-%m-%Y") AS dateofexp', 'ivrd_softwareversion', 'ivrd_primyspeedsource', 'ivrd_deviceimeino',
                    'rvod_crnumber', 'ivrd_ivmsserialno', 'ivrd_speedlimitno', 'ivrd_vehiclefleetno', 'DATE_FORMAT(ivrd_firstropregdate,"%d-%m-%Y") AS firstropregdate', 'ivrd_modelyear', 'appdim_modelno', 'ivrd_applicationtype',
                    'ivrd_verficationcode', 'opalusermst_pk', 'oum_firstname'])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = ivrd_rasvehicleownerdtls_fk')
                ->leftJoin('appdeviceinfomain_tbl', 'appdeviceinfomain_pk = ivrd_appdeviceinfomain_fk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = ivrd_vechiclecat')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = ivrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = ivrd_Installername')
                ->where('ivmsvehicleregdtls_pk = ' . $pk)
                ->asArray()
                ->one();

        if (!empty($userdata['ivrd_verficationcode'])) {
            $varificationnumber = $userdata['ivrd_verficationcode'];
        } else {
            $varificationnumber = self::generateCertificateNumber();
        }


        if ($isregenerate == 1) {

            $nextinspeciondate = date('d-m-Y', strtotime($userdata['dateofexp']));
        } else {

            $increasedate = '+' . '1' . ' years';
            $nextinspeciondate = date('d-m-Y', strtotime($increasedate, strtotime(date('Y-m-d'))));
        }



        $name = OpalusermstTbl::find()->select(['oum_firstname', 'omrm_cmplogo', 'omrm_companyname_en', 'memcompfiledtls_pk', 'mcfd_opalmemberregmst_fk', 'mcfd_uploadedby', 'acdm_custsuppno1', 'acdm_custsuppno2'])
                ->leftJoin('opalmemberregmst_tbl', 'oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->leftJoin('appcompanydtlsmain_tbl', 'acdm_opalmemberregmst_fk = opalmemberregmst_pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk = omrm_cmplogo')
                ->Where('oum_opalmemberregmst_fk = "' . $userdata['ivrd_opalmemberregmst_fk'] . '"  and oum_isfocalpoint = 1')
                ->asArray()
                ->one();
        $proof = Drive::generateUrl($name['memcompfiledtls_pk'], $name['mcfd_opalmemberregmst_fk'], $name['mcfd_uploadedby']);

        if ($userdata["ivrd_applicationtype"] == 1) {
            $installtype = 'Initial';
        } else if ($userdata["ivrd_applicationtype"] == 2) {
            $installtype = 'Device Replacement';
        } else {
            $installtype = 'Renewal';
        }




        $userdata['name'] = $userdata['oum_firstname'];
        $userdata['companyname'] = $name['omrm_companyname_en'];
        $userdata['varificationnumber'] = $varificationnumber;
        $userdata['nextinspeciondate'] = $nextinspeciondate;
        $userdata["ivrd_ivmsserialno"]  = $userdata["ivrd_ivmsserialno"] ? $userdata["ivrd_ivmsserialno"] : '-';
        $userdata["ivrd_primyspeedsource"]  = $userdata["ivrd_primyspeedsource"] ? $userdata["ivrd_primyspeedsource"] : '-';
        $userdata["acdm_custsuppno1"]  = $userdata["acdm_custsuppno1"] ? $userdata["acdm_custsuppno1"] : '-';
        $userdata["acdm_custsuppno2"]  = $userdata["acdm_custsuppno2"] ? $userdata["acdm_custsuppno2"] : '-';

        $path = "../api/web/ivmscertificate/" . $userdata['ivrd_opalmemberregmst_fk'] . "/";
        $path1 = "/web/ivmscertificate/" . $userdata['ivrd_opalmemberregmst_fk'] . "/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $mPDF1 = new Mpdf([
            'mode' => '',
            'format' => 'A4-L',
            'margin_left' => '5',
            'margin_right' => '0',
            'margin_top' => '45',
            'margin_bottom' => '0',
            'margin_header' => '0',
            'margin_footer' => '0',
            // 'default_font_size' => '0', 
            // 'orientation' => 'L',
            'default_font' => 'futurastdmedium']);
        $websiteurl = Yii::$app->params['website_url'];
        $qrCode = (new QrCode(''))
                ->setText($websiteurl . "/verify-product/?verifyras=" . $varificationnumber . "&value=vehform2#rasvehicle");
        $qrCode->writeFile(__DIR__ . '/../../../web' . '/code.png');
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '"style="width: 85px; height:85px;">';
        
        $backendBaseUrl = Yii::$app->params['backendBaseUrl'];
        $cerpath = dirname(__FILE__) . '../../../certicate/ivms_certificate.pdf';
        // $qrcode = '<img src="' . dirname(__FILE__) . '../../views/pdf/qr.jpg" style="width: 65px; height:65px;float:right">';
          if ($name['omrm_cmplogo']) {
            $comlogo = '<img src="' . $proof . '" style="float:left;width:160px;width: 65px; height:65px">';
        } else {
            $comlogo = '';
        }

        $pagecount = $mPDF1->SetSourceFile($cerpath);
        $tplId = $mPDF1->ImportPage($pagecount);
        $mPDF1->UseTemplate($tplId);
        $mPDF1->SetDefaultBodyCSS('background', "url('$cerpath')");

//        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">' . $comlogo . '</div>', 245, 40, 200, 20);
       
        $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;font-weight:bold; color:#0557A5">Vehicle Registration Number: ' . $userdata["ivrd_vechicleregno"]  . '</div>', 50, 87, 200, 20);
        // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#0557A5">' . $name["omrm_companyname_en"] . '</div>', 50, 95, 200, 20);

        $mPDF1->WriteFixedPosHTML('<div style="font-size: 14pt;text-align: center;color:#231F20 ">Is certified that has been installed with OPAL approved IVMS device as per the provisions of OPAL Road Safety Standard.</div>', 50, 100, 200, 20);

        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Certificate Number: <span style="color:#0557A5">' . $varificationnumber . '</span></div>', 25, 118, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Vendor Name: <span style="color:#0557A5">' . $name["omrm_companyname_en"] . '</span></div>', 25, 125, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Vehicle Owner Name: <span style="color:#0557A5">' . $userdata["owner_en"] . '</span></div>', 25, 132, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Vehicle Chassis Number: <span style="color:#0557A5">' . $userdata["ivrd_chassisno"] . '</span></div>', 25, 139, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Expiry Date: <span style="color:#0557A5">' . $nextinspeciondate . '</span></div>', 25, 146, 200, 20);

        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Hardware Model: <span style="color:#0557A5">' . $userdata["appdim_modelno"] . '</span></div>', 185, 118, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Software Model: <span style="color:#0557A5">' . $userdata["ivrd_softwareversion"] . '</span></div>', 185, 125, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Device Serial No: <span style="color:#0557A5">' . $userdata["ivrd_ivmsserialno"] . '</span></div>', 185, 132, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Installer Name: <span style="color:#0557A5">' . $userdata["oum_firstname"] . '</span></div>', 185, 139, 200, 20);
      
        // $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IMEI No: <span style="color:#0557A5">' . $userdata["ivrd_deviceimeino"] . '</span></div>', 185, 132, 200, 20);
        // $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Installation Type: <span style="color:#0557A5">' . $installtype . '</span></div>', 185, 146, 200, 20);
        // $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Source: <span style="color:#0557A5">' . $userdata["ivrd_primyspeedsource"]. '</span></div>', 185, 153, 200, 20);
        // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 11.15pt;color:#231F20">For further verification about this certificate, please contact the Vendor Technical Support Center at <br> +968 ' . $name["acdm_custsuppno1"]  . '  or  +968 ' . $name["acdm_custsuppno2"]  . '</div>', 50, 160, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">' . $qrcode . '</div>', 250, 165, 200, 20);

        $mPDF1->Output($path . $userdata['ivmsvehicleregdtls_pk'] . 'certificate' . '.pdf', 'F');

        $mPDF2 = new Mpdf([
            'mode' => '',
            'format' => 'A4-L',
            'margin_left' => '5',
            'margin_right' => '0',
            'margin_top' => '45',
            'margin_bottom' => '0',
            'margin_header' => '0',
            'margin_footer' => '0',
            // 'default_font_size' => '0', 
            // 'orientation' => 'L',
            'default_font' => 'futurastdmedium']);
        $websiteurl = Yii::$app->params['website_url'];
        $qrCode = (new QrCode(''))
                ->setText($websiteurl . "/verify-product/?verifyras=" . $varificationnumber . "&value=vehform2#rasvehicle");
        $qrCode->writeFile(__DIR__ . '/../../../web' . '/code.png');
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '"style="width: 85px; height:85px;">';

        $backendBaseUrl = Yii::$app->params['backendBaseUrl'];
        $cerpath = dirname(__FILE__) . '../../../certicate/ivms_certificate.pdf';

        // $qrcode = '<img src="' . dirname(__FILE__) . '../../views/pdf/qr.jpg" style="width: 65px; height:65px;float:right">';
       

        $pagecount = $mPDF2->SetSourceFile($cerpath);
        $tplId = $mPDF2->ImportPage($pagecount);
        $mPDF2->UseTemplate($tplId);
        $mPDF2->SetDefaultBodyCSS('background', "url('$cerpath')");
        $mPDF2->SetProtection(array('copy'), '', 'OPALUSP');
//        $mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">' . $comlogo . '</div>', 245, 40, 200, 20);

$mPDF2->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;font-weight: bold; color:#0557A5">Vehicle Registration Number: ' . $userdata["ivrd_vechicleregno"]  . '</div>', 50, 87, 200, 20);
// $mPDF2->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#0557A5">' . $name["omrm_companyname_en"] . '</div>', 50, 95, 200, 20);

$mPDF2->WriteFixedPosHTML('<div style="font-size: 14pt;text-align: center;color:#231F20 ">Is certified that has been installed with OPAL approved IVMS device as per the provisions of OPAL Road Safety Standard.</div>', 50, 100, 200, 20);

$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Certificate Number: <span style="color:#0557A5">' . $varificationnumber . '</span></div>', 25, 118, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Vendor Name: <span style="color:#0557A5">' . $name["omrm_companyname_en"] . '</span></div>', 25, 125, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Vehicle Owner Name: <span style="color:#0557A5">' . $userdata["owner_en"] . '</span></div>', 25, 132, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Vehicle Chassis Number: <span style="color:#0557A5">' . $userdata["ivrd_chassisno"] . '</span></div>', 25, 139, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Expiry Date: <span style="color:#0557A5">' . $nextinspeciondate . '</span></div>', 25, 146, 200, 20);

$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Hardware Model: <span style="color:#0557A5">' . $userdata["appdim_modelno"] . '</span></div>', 185, 118, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Software Model: <span style="color:#0557A5">' . $userdata["ivrd_softwareversion"] . '</span></div>', 185, 125, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Device Serial No: <span style="color:#0557A5">' . $userdata["ivrd_ivmsserialno"] . '</span></div>', 185, 132, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Installer Name: <span style="color:#0557A5">' . $userdata["oum_firstname"] . '</span></div>', 185, 139, 200, 20);

// $mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IMEI No: <span style="color:#0557A5">' . $userdata["ivrd_deviceimeino"] . '</span></div>', 185, 132, 200, 20);
// $mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">Installation Type: <span style="color:#0557A5">' . $installtype . '</span></div>', 185, 146, 200, 20);
// $mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">IVMS Source: <span style="color:#0557A5">' . $userdata["ivrd_primyspeedsource"]. '</span></div>', 185, 153, 200, 20);
// $mPDF2->WriteFixedPosHTML('<div style="text-align: center;font-size: 11.15pt;color:#231F20">For further verification about this certificate, please contact the Vendor Technical Support Center at <br> +968 ' . $name["acdm_custsuppno1"]  . '  or  +968 ' . $name["acdm_custsuppno2"]  . '</div>', 50, 160, 200, 20);
$mPDF2->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#231F20 ">' . $qrcode . '</div>', 250, 165, 200, 20);
        $mPDF2->Output($path . $userdata['ivmsvehicleregdtls_pk'] . 'certificateview' . '.pdf', 'F');
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = IvmsvehicleregdtlsTbl::find()->where('ivmsvehicleregdtls_pk = ' . $pk)->one();
        if ($isregen == 2) {
            $oldrecord = self::ChangeCertificatestatusOnnewsticker($model);
        }


        $model->ivrd_printcertificatepath = $path1 . $userdata['ivmsvehicleregdtls_pk'] . 'certificate' . '.pdf';

        $model->irvrd_viewcertificatepath = $path1 . $userdata['ivmsvehicleregdtls_pk'] . 'certificateview' . '.pdf';
        $model->ivrd_installationstatus = 3;
        $model->ivrd_verficationcode = $varificationnumber;
        if ($isregen == 2) {

            $model->ivrd_certificatestatus = 2;
            $model->ivrd_firstissuedate = date("Y-m-d H:i:s");
            $model->ivrd_dateofexpiry = date("Y-m-d", strtotime($nextinspeciondate));
        }

        if ($isregen == 3) {

            $model->ivrd_firstissuedate = $model->ivrd_dateoffiiting;
        }

        $model->ivrd_lastissuedon = date("Y-m-d H:i:s");
        $model->ivrd_updatedon = date("Y-m-d H:i:s");
        $model->ivrd_updatedby = $userPk;
        if (!$model->save()) {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        } else {
            $data = $model;
        }

        if ($data) {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => ''];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    function generateCertificateNumber($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function ChangeCertificatestatusOnnewsticker($model) {
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $oldrecord = IvmsvehicleregdtlsTbl::find()
                ->where(['=', 'ivrd_vechicleregno', $model->ivrd_vechicleregno])
                ->andWhere(['<>', 'ivmsvehicleregdtls_pk', $model->ivmsvehicleregdtls_pk])
                ->all();
        if ($oldrecord) {
            foreach ($oldrecord as $record) {
                $record->ivrd_certificatestatus = 4;
                $record->ivrd_installationstatus = 6;
                $record->ivrd_updatedon = date("Y-m-d H:i:s");
                $record->ivrd_updatedby = $userPk;
                if ($record->save()) {
                    $oldpks[] = $record->ivmsvehicleregdtls_pk;
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

    public static function printorviewcertificate($pk, $type) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = IvmsvehicleregdtlsTbl::findOne($pk);

        if ($type == 1 && $model->ivrd_iscertifiacteviewed == 1) {
            return true;
        }

        if ($model) {
            $transaction = Yii::$app->db->beginTransaction();

            if ($type == 2) {
                $historymodel = IvmsvehicleregdtlshstyTbl::movetohistory($model);
                $model->ivrd_iscertificateprinted = 1;
                $model->ivrd_printedby = $userpk;
                $model->ivrd_printedon = date('Y-m-d H:i:s');
            } else {
                $model->ivrd_iscertifiacteviewed = 1;
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

    public static function removedevice($pk, $sts) {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = IvmsvehicleregdtlsTbl::findOne($pk);

        if ($model) {
            $transaction = Yii::$app->db->beginTransaction();

            $historymodel = IvmsvehicleregdtlshstyTbl::movetohistory($model);
            $model->ivrd_installationstatus = $sts;
            $model->ivrd_certificatestatus = 4;
            $model->ivrd_updatedon = date("Y-m-d H:i:s");
            $model->ivrd_updatedby = $userPk;

            if ($model->validate() && $model->save()) {
                $transaction->commit();
                $datamail = [
                    'vehiclePk' => $pk,
                ];
                if ($sts == 6) {
                    self::sendIvmsDeviceMail($userpk, 'ivmsvehicleregcancelremove', $datamail);
                }
                if ($sts == 4) {
                    self::sendIvmsDeviceMail($userpk, 'ivmsvehicleregcancelnocert', $datamail);
                }

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

    public static function getIVMSChecklistByVeclPk($vehicleregpk) {
        $checklist = [];

//        $vehicle = RasvehicleregdtlsTbl::findOne($vehicleregpk);
        $auditpks = AuditchklstmstTbl::find()
                ->select(['auditchklstmst_pk', 'aclm_categorytitle_en as categoryname_en', 'aclm_categorytitle_ar as categoryname_ar', 'aclm_order', 'aclm_markalltext_en', 'aclm_markalltext_ar'])
                ->where(['=', 'aclm_projectmst_fk', 5])
                ->andWhere(['=', 'aclm_status', 1])
                ->orderBy('aclm_order')
                ->asArray()
                ->all();

        foreach ($auditpks as $keys => $pk) {
            $checklist[$keys] = $pk;
            $questions = AuditquestionmstTbl::find()
                    ->select(['aqm_question_en', 'aqm_question_ar', 'auditquestionmst_pk', 'aqm_auditchklstmst_fk', 'aqm_order', 'aqm_questiontype'])
                    ->where(['=', 'aqm_auditchklstmst_fk', $pk['auditchklstmst_pk']])
                    ->andWhere(['=', 'aqm_status', 1])
                    ->orderBy('aqm_order')
                    ->asArray()
                    ->all();

            foreach ($questions as $key => $ques) {
                $checklist[$keys]['ques'][$key] = $ques;

                $ansOptions = AuditanswerdtlsTbl::find()
                        ->select(['auditanswerdtls_pk', 'aad_auditquestionmst_fk', 'aad_answer_en', 'aad_answer_ar', 'aad_order', 'aad_ismandatory'])
                        ->where(['=', 'aad_auditquestionmst_fk', $ques['auditquestionmst_pk']])
                        ->andWhere(['=', 'aad_status', 1])
                        ->orderBy('aad_order')
                        ->asArray()
                        ->all();
                $checklist[$keys]['ques'][$key]['ansoptions'] = $ansOptions;
            }
        }




        return $checklist;
    }

    public static function RenewIvmsVehicleRegistration($data) {
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregPk']);
        $vehicleinfo = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);

        if ($vehicleinfo) {
            $history = IvmsvehicleregdtlshstyTbl::movetohistory($vehicleinfo);

            $vehicleinfo->ivrd_installationdate = $data['dateOfInsp'];
            $vehicleinfo->ivrd_inststarttime = $data['startTime'];
            $vehicleinfo->ivrd_instendtime = $data['endTime'];
            $vehicleinfo->ivrd_Installername = $data['inspector'];
            $vehicleinfo->ivrd_odometerreading = $data['odometer'];
            $vehicleinfo->ivrd_applicationtype = 3;
            $vehicleinfo->ivrd_installationstatus = 1;

            $vehicleinfo->ivrd_updatedon = date('Y-m-d H:i:s');
            $vehicleinfo->ivrd_updatedby = $userpk;
            if ($vehicleinfo->ivrd_certificatestatus == null) {
                $vehicleinfo->ivrd_certificatestatus = 1;
            }

            if ($vehicleinfo->save() && $history) {
                return $vehicleinfo->ivmsvehicleregdtls_pk;
            }
        }
        return false;
    }

    public static function getInstallerListByVhclregpk($requestdata) {
        $list = [];
        $status = 'F';
        $result = [];

        $data = json_decode($requestdata, true);

        $vehicle = IvmsvehicleregdtlsTbl::findOne(Security::decrypt($data['pk']));

        if ($vehicle->ivrd_installationstatus == 3) {
            $appPk = AppinstinfomainTbl::findOne($vehicle['ivrd_appinstinfomain_fk'])['appiim_applicationdtlsmain_fk'];
            $params = [
                'ivmsdevicemodel' => Security::encrypt($vehicle['ivrd_appdeviceinfomain_fk']),
                'registrationpk' => Security::encrypt($vehicle['ivrd_opalmemberregmst_fk']),
                'applicatiomainpk' => Security::encrypt($appPk),
                'date' => $data['date'],
                'startTime' => $data['startTime'],
                'endTime' => $data['endTime'],
            ];

            $parasjson = json_encode($params, true);

            $list = AppdeviceinfomainTbl::getInstationTechnician($parasjson);
            $status = 'P';
        }

        $result = ['list' => $list, 'status' => $status];

        return $result;
    }

    public static function updateOnlineChecklist($data, $approvalpk) {

        $questions = IvmsinspquesdtlsTbl::find()->where(['=', 'iiqd_ivmsinspandapproval_fk', $approvalpk])->all();

        foreach ($questions as $ques) {
            $histquest[] = IvmsinspquesdtlshstyTbl::movetohistory($ques);
            foreach ($data['onlinechecklist'] as $formdatacat) {
                if ($ques->iiqdAuditquestionmstFk->aqm_auditchklstmst_fk == $formdatacat['categorypk']) {
                    foreach ($formdatacat['categorylist'] as $formdata) {

                        if ($formdata['question'] == $ques->iiqd_auditquestionmst_fk && $formdata['questiontyp'] == 1) {
                            $answers = IvmsinspansdtlsTbl::find()->where(['iiad_ivmsinspquesdtls_fk' => $ques->ivmsinspquesdtls_pk])->all();
                            foreach ($answers as $ans) {
                                $histans[] = IvmsinspansdtlshstyTbl::movetohistory($ans);

                                if ($formdata['answer'] == $ans['iiad_auditanswerdtls_fk']) {
                                    $ans->iiad_isselected = 1;
//                            $ans->rviad_comments = $formdata['chklistcomments'];
                                    $ans->iiad_comments = !empty($formdata['chklistcomments']) ? $formdata['chklistcomments'] : null;
                                    $ans->iiad_fileupload = !empty($formdata['chklistcomments']) ? implode(',', $formdata['chcklistdoc']) : null;
                                } else {
                                    $ans->iiad_isselected = 2;
                                    $ans->iiad_comments = null;
                                    $ans->iiad_fileupload = null;
                                }

                                if ($ans && $ans->save()) {
                                    $answerspks[] = $ans->ivmsinspansdtls_pk;
                                } else {
                                    echo "<pre>";
                                    var_dump($ans->getErrors());
                                    exit;
                                }
                            }
                        } else if ($formdata['question'] == $ques->iiqd_auditquestionmst_fk && $formdata['questiontyp'] == 3) {
                            $answers = IvmsinspansdtlsTbl::find()->where(['iiad_ivmsinspquesdtls_fk' => $ques->ivmsinspquesdtls_pk])->all();

                            foreach ($answers as $ans) {
                                $histans[] = IvmsinspansdtlshstyTbl::movetohistory($ans);

                                foreach ($formdata['answerlist'] as $formanswers) {
                                    if ($formanswers['anspk'] == $ans['iiad_auditanswerdtls_fk']) {

                                        $ans->iiad_isselected = 1;
                                        $ans->iiad_details = $formanswers['trigger'];
                                        $ans->iiad_comments = !empty($formdata['chklistcomments']) ? $formdata['chklistcomments'] : null;
                                        $ans->iiad_fileupload = !empty($formdata['chklistcomments']) ? implode(',', $formdata['chcklistdoc']) : null;
                                    }

                                    if ($ans && $ans->save()) {
                                        $answerspks[] = $ans->ivmsinspansdtls_pk;
                                    } else {
                                        echo "<pre>";
                                        var_dump($ans->getErrors());
                                        exit;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $answerspks;
    }

    public static function UpdateOnlineChecklistRenewal($data, $approvalpk) {

        $questions = IvmsinspquesdtlsTbl::find()->where(['=', 'iiqd_ivmsinspandapproval_fk', $approvalpk])->all();

        foreach ($questions as $ques) {
            $histquest[] = IvmsinspquesdtlshstyTbl::movetohistory($ques);
            $answers = IvmsinspansdtlsTbl::find()->where(['iiad_ivmsinspquesdtls_fk' => $ques->ivmsinspquesdtls_pk])->all();
            foreach ($answers as $ans) {
                $histans[] = IvmsinspansdtlshstyTbl::movetohistory($ans);
                \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                $ans->delete();
                \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            }
            \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $ques->delete();
            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        }
    }

    public static function getAllPassAnswersForChklist($vehicleregpk) {
        $checklist = [];

        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);

        $auditpks = AuditchklstmstTbl::find()
                ->select(['auditchklstmst_pk', 'aclm_markalltext_en'])
                ->where(['=', 'aclm_projectmst_fk', 5])
                ->andWhere(['=', 'aclm_status', 1])
                ->orderBy('aclm_order')
                ->asArray()
                ->all();

        foreach ($auditpks as $keys => $pk) {

            $validators = self::getColourCodetext($pk['aclm_markalltext_en']);

            $questions = AuditquestionmstTbl::find()
                    ->select(['auditquestionmst_pk as question'])
                    ->where(['=', 'aqm_auditchklstmst_fk', $pk['auditchklstmst_pk']])
                    ->andWhere(['=', 'aqm_status', 1])
                    ->orderBy('aqm_order')
                    ->asArray()
                    ->all();

            foreach ($questions as $key => $ques) {
                $checklist[$pk['auditchklstmst_pk']][$key] = $ques;

                $ansOptions = AuditanswerdtlsTbl::find()
                                ->select(['auditanswerdtls_pk'])
                                ->where(['=', 'aad_auditquestionmst_fk', $ques['question']])
                                ->andWhere(['=', 'aad_answer_en', $validators['pass']])
                                ->andWhere(['=', 'aad_status', 1])
                                ->orderBy('aad_order')
                                ->asArray()
                                ->one()['auditanswerdtls_pk'];

                $checklist[$pk['auditchklstmst_pk']][$key]['answer'] = $ansOptions;
            }
        }



        return $checklist;
    }

    public static function declineSubmit($data) {

        $record = null;
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicleregpk = Security::decrypt($data['vehicleregpk']);

        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehicleregpk);

        if ($vehicle->ivrd_installationstatus == 2) {
            $validationstatus = 7;

            $inspection = IvmsinspandapprovalTbl::find()->where(['=', 'iia_ivmsvehicleregdtls_fk', $vehicle->ivmsvehicleregdtls_pk])->one();

            if ($inspection) {
                $transaction = Yii::$app->db->beginTransaction();
                $modelhsty = IvmsinspandapprovalhstyTbl::movetohistory($inspection);
                $vehiclereg = IvmsvehicleregdtlsTbl::submitForApprovalOffline($vehicleregpk, $validationstatus);

                $inspection->iia_appdecon = date('Y-m-d H:i:s');
                $inspection->iia_appdecby = $userpk;
                $inspection->iia_appdecComments = $data['validationComments'];

                if ($inspection->save() && $vehiclereg && $modelhsty) {
                    $transaction->commit();
                    $record = $inspection->ivmsinspandapproval_pk;
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

    public static function exportGridDatanew($data) {

        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $gridcolumns = $data['columns'];

        $result = Ivmsdevice::getIVMSDeviceGridData($data, true);
        $exportdata = $result['dataset']['griddata'];
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl . 'web/exports/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName = 'IVMS_Vehicle_Report_' . $time;
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat = 'dd\-mm\-yyyy';

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getRowDimension(1)->setRowHeight(75);

        $objDrawing = new Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('../dev/src/assets/images/excelheader.png');
        $objDrawing->setCoordinates('A1'); // Cell coordinate where image will be placed
        $objDrawing->setHeight(100);

        $objDrawing->setWorksheet($worksheet);

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
            $value .= '<td>Centre Name</td>';
        }
        if (in_array('office_type', $gridcolumns)) {
            $value .= '<td>Office Type</td>';
        }
        if (in_array('branch_name', $gridcolumns)) {
            $value .= '<td>Branch Name</td>';
        }
        if (in_array('owner_name', $gridcolumns)) {
            $value .= '<td>Owner Name</td>';
        }
        if (in_array('contact_person', $gridcolumns)) {
            $value .= '<td>Contact Person Email ID</td>';
        }
        if (in_array('vehichle_reg', $gridcolumns)) {
            $value .= '<td>Vehicle Reg. Number</td>';
        }
        if (in_array('chasis_number', $gridcolumns)) {
            $value .= '<td>Chassis Number</td>';
        }
        if (in_array('ivms_device', $gridcolumns)) {
            $value .= '<td>IVMS Device Model Number</td>';
        }
        if (in_array('device_number', $gridcolumns)) {
            $value .= '<td>Device Serial Number</td>';
        }
        if (in_array('device_IMEI', $gridcolumns)) {
            $value .= '<td>Device IMEI Number</td>';
        }
        if (in_array('vechile_cate', $gridcolumns)) {
            $value .= '<td>Vechile Category</td>';
        }
        if (in_array('vechile_Subcate', $gridcolumns)) {
            $value .= '<td>Vechile Sub Category</td>';
        }
        if (in_array('installer_name', $gridcolumns)) {
            $value .= '<td>Installer Name</td>';
        }
        if (in_array('installationdate_time', $gridcolumns)) {
            $value .= '<td>Installation Date & Time</td>';
        }
        if (in_array('applicant_type', $gridcolumns)) {
            $value .= '<td>Applicant Type</td>';
        }
        if (in_array('installation_status', $gridcolumns)) {
            $value .= '<td>Installation Status</td>';
        }
        if (in_array('certi_status', $gridcolumns)) {
            $value .= '<td>Installation Certificate Status</td>';
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
            if (in_array('office_type', $gridcolumns)) {
                if (empty($attend["office_type"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["office_type"] == 1) {
                        $value .= '<td valing="top">Main Office</td>';
                    } elseif ($attend["office_type"] == 2) {
                        $value .= '<td valing="top">Branch Office</td>';
                    }
                }
            }
            if (in_array('branch_name', $gridcolumns)) {
                if (empty($attend["branch_name"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["branch_name"] . '</td>';
                }
            }

            if (in_array('owner_name', $gridcolumns)) {
                if (empty($attend["owner_name"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["owner_name"] . '</td>';
                }
            }
            if (in_array('contact_person', $gridcolumns)) {
                if (empty($attend["contact_person"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["contact_person"] . '</td>';
                }
            }
            if (in_array('vehichle_reg', $gridcolumns)) {
                if (empty($attend["vehichle_reg"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["vehichle_reg"] . '</td>';
                }
            }
            if (in_array('chasis_number', $gridcolumns)) {
                if (empty($attend["chasis_number"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["chasis_number"] . '</td>';
                }
            }
            if (in_array('ivms_device', $gridcolumns)) {
                if (empty($attend["ivms_device"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["ivms_device"] . '</td>';
                }
            }
            if (in_array('device_number', $gridcolumns)) {
                if (empty($attend["device_number"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["device_number"] . '</td>';
                }
            }
            if (in_array('device_IMEI', $gridcolumns)) {
                if (empty($attend["device_IMEI"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["device_IMEI"] . '</td>';
                }
            }
            if (in_array('vechile_cate', $gridcolumns)) {
                if (empty($attend["vechile_cate"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["vechile_cate"] . '</td>';
                }
            }
            if (in_array('vechile_Subcate', $gridcolumns)) {
                if (empty($attend["vechile_Subcate"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["vechile_Subcate"] . '</td>';
                }
            }
            if (in_array('installer_name', $gridcolumns)) {
                if (empty($attend["installer_name"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . (string) $attend["installer_name"] . '</td>';
                }
            }
            if (in_array('installationdate_time', $gridcolumns)) {
                if (empty($attend["installationdate_time"])) {
                    $value .= '<td valing="top"> - </td>';
                } else if (empty($attend["startTime"]) || empty($attend["endTime"])) {
                    $value .= '<td valing="top" class="date">' . (string) $attend["installationdate_time"] . '</td>';
                } else {
                    $value .= '<td valing="top" class="date" >' . (string) $attend["installationdate_time"] . ' (' . (string) $attend["startTime"] . '-' . (string) $attend["endTime"] . ')</td>';
                }
            }
            if (in_array('applicant_type', $gridcolumns)) {
                if (empty($attend["applicant_type"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    if ($attend["applicant_type"] == 1) {
                        $value .= '<td valing="top">Initial</td>';
                    } elseif ($attend["applicant_type"] == 2) {
                        $value .= '<td valing="top">Device Replacementt</td>';
                    } elseif ($attend["applicant_type"] == 3) {
                        $value .= '<td valing="top">Renewal</td>';
                    }
                }
            }
            if (in_array('installation_status', $gridcolumns)) {
                if (empty($attend["installation_status"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getinstallationSts($attend["installation_status"]) . '</td>';
                }
            }
            if (in_array('certi_status', $gridcolumns)) {
                if (empty($attend["certi_status"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top">' . self::getcertificateSts($attend["certi_status"]) . '</td>';
                }
            }
            if (in_array('dateofexp', $gridcolumns)) {
                if (empty($attend["dateofexp"])) {
                    $value .= '<td valing="top"> - </td>';
                } else {
                    $value .= '<td valing="top" class="date">' . (string) $attend["dateofexp"] . '</td>';
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



        $writer = new Xlsx($spreadsheet);

        $writer->save($folder . $exeFileName . '.xlsx');

        $return['status'] = 1;
        $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/ivmsdev/device/downloadgridata?filename=' . Security::encrypt($exeFileName)]);
        return $return;
    }

    public static function getinstallationSts($sts) {


        switch ($sts) {
            case 1 : return 'Installation Pending';

            case 2 : return 'Approval Pending';

            case 3 : return 'Completed';

            case 4 : return 'Registration cancelled';

            case 5 : return 'Cancelled (Device Replacement Requested)';

            case 6 : return 'Device Removed and Cancelled';

            case 7 : return 'Declined by Senior Technician';

//            case 8 : return 'Rejected';
//
//            case 9 : return 'Rejected and Cancelled';
//
//            case 10 : return 'Cancelled(Renewal)';

            default : return '-';
        }
    }

    public static function getcertificateSts($sts) {
        switch ($sts) {
            case 1 : return 'New';

            case 2 : return 'Valid';

            case 3 : return 'Expired';

            case 4 : return 'Cancelled';

            default : return '-';
        }
    }

    public static function exportGridData($data) {

        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = Ivmsdevice::getIVMSDeviceGridData($data, true);
        $exportdata = $result['dataset']['griddata'];
        $gridcolumns = $data['columns'];

        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl . 'web/exports/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName = 'IVMS_Vehicle_Report_' . $time;
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
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td valing="top" colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> ' . $dateString . ' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<style>.date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
            $value .= '<tr style="background-color:#E7E7E7;height:40px">';
            $value .= '<td>Sl. No.</td>';

            if (in_array('centre_name', $gridcolumns)) {
                $value .= '<td>Centre Name</td>';
            }
            if (in_array('office_type', $gridcolumns)) {
                $value .= '<td>Office Type</td>';
            }
            if (in_array('branch_name', $gridcolumns)) {
                $value .= '<td>Branch Name</td>';
            }
            if (in_array('cr_number', $gridcolumns)) {
                $value .= '<td>CR Number</td>';
            }
            if (in_array('owner_name', $gridcolumns)) {
                $value .= '<td>Owner Name</td>';
            }
            if (in_array('contact_person', $gridcolumns)) {
                $value .= '<td>Contact Person Email ID</td>';
            }
            if (in_array('vehichle_reg', $gridcolumns)) {
                $value .= '<td>Vehicle Reg. Number</td>';
            }
            if (in_array('chasis_number', $gridcolumns)) {
                $value .= '<td>Chassis Number</td>';
            }
            if (in_array('ivms_device', $gridcolumns)) {
                $value .= '<td>IVMS Device Model Number</td>';
            }
            if (in_array('device_number', $gridcolumns)) {
                $value .= '<td>Device Serial Number</td>';
            }
            if (in_array('device_IMEI', $gridcolumns)) {
                $value .= '<td>Device IMEI Number</td>';
            }
            if (in_array('vechile_cate', $gridcolumns)) {
                $value .= '<td>Vehicle Category</td>';
            }
            if (in_array('vechile_Subcate', $gridcolumns)) {
                $value .= '<td>Vehicle Sub Category</td>';
            }
            if (in_array('installer_name', $gridcolumns)) {
                $value .= '<td>Installer Name</td>';
            }
            if (in_array('installationdate_time', $gridcolumns)) {
                $value .= '<td>Installation Date & Time</td>';
            }
            if (in_array('applicant_type', $gridcolumns)) {
                $value .= '<td>Applicant Type</td>';
            }
            if (in_array('installation_status', $gridcolumns)) {
                $value .= '<td>Installation Status</td>';
            }
            if (in_array('certi_status', $gridcolumns)) {
                $value .= '<td>Installation Certificate Status</td>';
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
                if (in_array('office_type', $gridcolumns)) {
                    if (empty($attend["office_type"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                         $value .= '<td valing="top">' . (string) $attend["office_type"] . '</td>';
                    }
                }
                if (in_array('branch_name', $gridcolumns)) {
                    if (empty($attend["branch_name"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["branch_name"] . '</td>';
                    }
                }
                if (in_array('cr_number', $gridcolumns)) {
                    if (empty($attend["crnumber"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["crnumber"] . '</td>';
                    }
                }

                if (in_array('owner_name', $gridcolumns)) {
                    if (empty($attend["owner_name"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["owner_name"] . '</td>';
                    }
                }
                if (in_array('contact_person', $gridcolumns)) {
                    if (empty($attend["contact_person"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["contact_person"] . '</td>';
                    }
                }
                if (in_array('vehichle_reg', $gridcolumns)) {
                    if (empty($attend["vehichle_reg"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["vehichle_reg"] . '</td>';
                    }
                }
                if (in_array('chasis_number', $gridcolumns)) {
                    if (empty($attend["chasis_number"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["chasis_number"] . '</td>';
                    }
                }
                if (in_array('ivms_device', $gridcolumns)) {
                    if (empty($attend["ivms_device"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["ivms_device"] . '</td>';
                    }
                }
                if (in_array('device_number', $gridcolumns)) {
                    if (empty($attend["device_number"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["device_number"] . '</td>';
                    }
                }
                if (in_array('device_IMEI', $gridcolumns)) {
                    if (empty($attend["device_IMEI"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["device_IMEI"] . '</td>';
                    }
                }
                if (in_array('vechile_cate', $gridcolumns)) {
                    if (empty($attend["vechile_cate"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["vechile_cate"] . '</td>';
                    }
                }
                if (in_array('vechile_Subcate', $gridcolumns)) {
                    if (empty($attend["vechile_Subcate"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["vechile_Subcate"] . '</td>';
                    }
                }
                if (in_array('installer_name', $gridcolumns)) {
                    if (empty($attend["installer_name"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . (string) $attend["installer_name"] . '</td>';
                    }
                }
                if (in_array('installationdate_time', $gridcolumns)) {
                    if (empty($attend["installationdate_time"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else if (empty($attend["startTime"]) || empty($attend["endTime"])) {
                        $value .= '<td valing="top" class="date">' . (string) $attend["installationdate_time"] . '</td>';
                    } else {
                        $value .= '<td valing="top" class="date">' . (string) $attend["installationdate_time"] . ' (' . (string) $attend["startTime"] . '-' . (string) $attend["endTime"] . ')</td>';
                    }
                }
                if (in_array('applicant_type', $gridcolumns)) {
                    if (empty($attend["applicant_type"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        if ($attend["applicant_type"] == 1) {
                            $value .= '<td valing="top">Initial</td>';
                        } elseif ($attend["applicant_type"] == 2) {
                            $value .= '<td valing="top">Device Replacementt</td>';
                        } elseif ($attend["applicant_type"] == 3) {
                            $value .= '<td valing="top">Renewal</td>';
                        }
                    }
                }
                if (in_array('installation_status', $gridcolumns)) {
                    if (empty($attend["installation_status"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . self::getinstallationSts($attend["installation_status"]) . '</td>';
                    }
                }
                if (in_array('certi_status', $gridcolumns)) {
                    if (empty($attend["certi_status"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top">' . self::getcertificateSts($attend["certi_status"]) . '</td>';
                    }
                }
                if (in_array('dateofexp', $gridcolumns)) {
                    if (empty($attend["dateofexp"])) {
                        $value .= '<td valing="top"> - </td>';
                    } else {
                        $value .= '<td valing="top" class="date">' . (string) $attend["dateofexp"] . '</td>';
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/ivmsdev/device/downloadgridata?filename=' . Security::encrypt($exeFileName)]);
            return $return;
        } else {
            $return['status'] = 2;
            return $return;
        }
    }

    public static function importivmsexceldata($requestdata) {

        $path = explode('api/', Drive::getAbsFilePath($requestdata['file']));

        try {
            $getexceldata = IOFactory::load($path[1]);
            $sheet_array = $getexceldata->getActiveSheet()->toArray(null, null, null, null, 1, 2);
            $dataToSaveArray = array_filter($sheet_array);
        } catch (PHPExcel_Exception $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        } catch (Exception $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        } catch (InvalidArgumentException $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        }

        $masterArray = array();
        $successarray = array();
        $headArray = array();

        foreach ($dataToSaveArray as $innerarray) {
            $dataToSaveArrayNew[] = array_filter($innerarray);
        }
        $dataToSaveArray = array_filter($dataToSaveArrayNew);

        $headerArray = array_filter($dataToSaveArray[0]);

        foreach ($headerArray as $key => $head) {

            $keyvalue2 = $headerArray[$key];

            if ($keyvalue2) {
                $requiredarray[$key] = $head;
            }

            $keyvalue = str_replace("*", "", $head);

            $headArray[] = trim($keyvalue);
        }

        $dataToSaveArray[0] = array_filter($dataToSaveArray[0]);

        $headcount = count($headArray);
        unset($dataToSaveArray[0]);

        $i = 0;
        $success = 0;
        $templdatestatus = TRUE;

        $LableArray = array("CR No.", "Centre Name", "Office Type", "Branch Name", "Device IMEI number", "Device Model", "Software", "Customer name (Client)", "Vehicle Manufacturer", "Vehicle Category", "Vehicle Reg. No.", "Chassis No.", "Date of fitting", "Date of replacement, if any");

        if ($headcount != count($LableArray)) {
            $templdatestatus = FALSE;
        }

        if ($headArray != $LableArray) {
            $templdatestatus = FALSE;
        }

        foreach ($dataToSaveArray as $key => $value) {


            $validdata = TRUE;
            $Requiredcomments = "";
            $overallcomments = "";
            $opalmemberreg = null;
            $invalidcomments = "";
            $officetype = null;
            $requiredcomm = false;
            $Requiredlabe = 0;
            $invalidlable = 0;

            if (empty($value['0']) && empty($value['1']) && empty($value['2']) && empty($value['3']) && empty($value['4']) && empty($value['5']) && empty($value['6']) && empty($value['7']) && empty($value['8']) && empty($value['9']) && empty($value['10']) && empty($value['11']) && empty($value['12']) && empty($value['13']) && empty($value['14']) && empty($value['15'])) {

                $value = array_filter($value);
                $i--;
            }


            foreach ($value as $key1 => $value1) {

                $newarray = $value;
                end($newarray);         // move the internal pointer to the end of the array
                $last = key($newarray);
                $lastkeyvalue = str_replace("*", "", $headerArray[$last]);

                $lastkeyvalue = trim($lastkeyvalue);

                $value1 = trim($value1);
                $keyvalue = str_replace("*", "", $headerArray[$key1]);

                if (!empty($keyvalue) && $keyvalue != NULL) {
                    $masterArray[$i][trim($keyvalue)] = $value1;
                }


                if (!$requiredcomm) {
                    foreach ($requiredarray as $reqkey => $reqvalue) {
                        if (empty($value[array_search($reqvalue, $headArray)])) {

                            $masterArray[$i]['pq_cellattr'][$reqvalue][style] = 'background:#f44250;font-weight:bold;';
                            $validdata = False;
                            $Requiredcomments .= $reqvalue . ", ";
                        }
                    }
                    $requiredcomm = true;
                }



                if (trim($keyvalue) == 'Centre Name' && !empty($value1)) {
                    $opalmemberreg = OpalmemberregmstTbl::find()->select(['opalmemberregmst_pk as Pk'])->where(['=', 'omrm_branch_en', $value1])->asArray()->one()['Pk'];

                    if (!$opalmemberreg) {
                        $masterArray[$i]['pq_cellattr']['Company Name'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = False;
                        $invalidcomments .= "No company found with this centre name '" . $value1 . "', ";
                    }
                }

                if (trim($keyvalue) == 'Office Type' && !empty($value1)) {
                    if ($value1 != 'Main Office' && $value1 != 'Branch Office') {
                        $masterArray[$i]['pq_cellattr']['Office Type'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = False;
                        $invalidcomments .= "Office Type, ";
                    } else if ($value1 == 'Main Office') {
                        $officetype = 1;
                    } else if ($value1 == 'Branch Office') {
                        $officetype = 2;
                    }
                }
                if (trim($keyvalue) == 'Branch Name' && ( empty($value1) || $value1 == "NULL") && $officetype == 2) {
                    $masterArray[$i]['pq_cellattr']['Branch Name'][style] = 'background:#f44250;font-weight:bold;';
                    $validdata = False;
                    $Requiredcomments = "Branch Name, ";
                }


                if (trim($keyvalue) == 'Date of fitting' && !empty($value1)) {

                    $timestampinsp = ($value1 - 25569) * 86400;

                    $masterArray[$i]['Date of fitting'] = date("d-m-Y", $timestampinsp);
                    if (!strtotime(date("d-m-Y", $timestampinsp))) {
                        $masterArray[$i]['pq_cellattr']['Date of Inspection'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = False;
                        $invalidcomments .= "Date of fitting, ";
                    }
                }
                if (trim($keyvalue) == 'Date of replacement, if any' && !empty($value1) && $value1 != 'NULL') {

                    $timestampinsp = ($value1 - 25569) * 86400;

                    $masterArray[$i]['Date of replacement, if any'] = date("d-m-Y", $timestampinsp);
                    if (!strtotime(date("d-m-Y", $timestampinsp))) {
                        $masterArray[$i]['pq_cellattr']['Date of replacement, if any'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = False;
                        $invalidcomments .= "Date of replacement, if any, ";
                    }
                }






//                if (trim($keyvalue) == 'Date of Expiry' && !empty($value1)) {
//
//                    $timestampexpiry = ($value1 - 25569) * 86400;
//                    $masterArray[$i]['Date of Expiry'] = date("d-m-Y", $timestampexpiry);
//
//                    if (!strtotime(date("d-m-Y", $timestampexpiry))) {
//                        $masterArray[$i]['pq_cellattr']['Date of Expiry'][style] = 'background:#f44250;font-weight:bold;';
//                        $validdata = 'FALSE';
//                        $invalidcomments .= "Date of Expiry, ";
//                    }
//                }
//                if (trim($keyvalue) == 'Created on' && !empty($value1)) {
//
//                    $timestampcrete = ($value1 - 25569) * 86400;
//                    $masterArray[$i]['Created on'] = date("d/m/Y", $timestampcrete);
//
//                    if (!strtotime(date("d-m-Y", $timestampcrete))) {
//                        $masterArray[$i]['pq_cellattr']['Date of Expiry'][style] = 'background:#f44250;font-weight:bold;';
//                        $validdata = 'FALSE';
//                        $invalidcomments .= "Created on, ";
//                    }
//                }



                if (trim($keyvalue) == $lastkeyvalue && $validdata == TRUE) {

                    $recordsave = self::saveivmsvehicleimport($masterArray[$i]);
//                    echo "<pre>";
//                        var_dump($recordsave);
//                        exit;

                    if ($recordsave === true) {
                        $successarray[] = $masterArray[$i];
                        unset($masterArray[$i]);
                        $i--;
                        $success++;
                    } else {

                        foreach ($recordsave as $key => $record) {

                            $masterArray[$i]['pq_cellattr'][$key][style] = 'background:#f44250;font-weight:bold;';
                            $validdata = FALSE;
                            $invalidcomments .= $key . "', ";
                        }
                    }
                }

                if ($validdata == FALSE) {


                    if (!empty($Requiredcomments)) {
                        if (empty($Requiredlabe)) {
                            $overallcomments .= 'E' . ++$j . ". Required Fields: " . $Requiredcomments;
                            $Requiredlabe = 1;
                        } else {
                            $overallcomments .= $Requiredcomments;
                        }
                    }


                    if (!empty($invalidcomments)) {
                        if (empty($invalidlable)) {
                            $overallcomments .= 'E' . ++$j . ". Invalid data: " . $invalidcomments;
                            $invalidlable = 1;
                        } else {
                            $overallcomments .= $invalidcomments . "";
                        }
                    }


                    $masterArray[$i]['Over_all_Comments'] = $overallcomments;

                    $Requiredcomments = "";
                    $invalidcomments = "";
                }
            }

            $i++;
        }
        if ($masterArray["-1"]) {
            unset($masterArray["-1"]);
        }


        $jsonData['errorarray'] = $masterArray;
        $jsonData['successarray'] = $successarray;
        $jsonData['failed'] = $i;
        $jsonData['success'] = $success;
        $jsonData['total'] = $success + $i;
        $jsonData['templdatestatus'] = $templdatestatus;

        return json_encode($jsonData);
    }

    public static function saveivmsvehicleimport($data) {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $opalmemberreg = OpalmemberregmstTbl::find()->select(['opalmemberregmst_pk as Pk'])->where(['=', 'omrm_branch_en', $data['Centre Name']])->asArray()->one()['Pk'];

        if (strtolower($data['Office Type']) == 'main office') {
            $officetype = 1;
        } else if (strtolower($data['Office Type']) == 'branch office') {
            $officetype = 2;
        }

        $model = AppinstinfomainTbl::find()->select(['appinstinfomain_pk as Pk'])
                ->leftJoin('applicationdtlsmain_tbl', 'applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
                ->where(['=', 'appiim_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=', 'appiim_officetype', $officetype])
                ->andWhere(['=', 'appdm_projectmst_fk', 5]);

        if ($officetype == 2) {
            $model->andWhere(['=', 'appiim_branchname_en', $data['Branch Name']]);
        }

        $instinfoPk = $model->asArray()->one()['Pk'];

        if (!$instinfoPk && $officetype == 1) {
            $returndata['Office Type'] = 2;
        } else if (!$instinfoPk && $officetype == 2) {
            $returndata['Branch Name'] = 2;
        }

        $category = \app\models\VehiclesubcatmstTbl::find()
                        ->select(['vscm_rascategorymst_fk as catPk', 'vehiclesubcatmst_pk as subCatPk'])
                        ->where(['OR', ['=', 'vscm_vehiclename_en', $data['Vehicle Category']], ['=', 'vscm_vehiclename_ar', $data['Vehicle Category']]])
                        ->asArray()->one();

        if (!$category) {
            $returndata['Vehicle Category'] = 2;
        }

        $devicepk = AppdeviceinfomainTbl::find()
                        ->select(['appdeviceinfomain_pk as Pk'])
                        ->where(['=', 'appdim_modelno', $data['Device Model']])
                        ->andWhere(['=', 'appdim_appinstinfomain_fk', $instinfoPk])
                        ->asArray()
                        ->one()['Pk'];

        if (!$devicepk) {
            $returndata['Device Model'] = 2;
        }
        
        $manufacturer = ReferencemstTbl::find()
                        ->select(['referencemst_pk as Pk'])
                        ->where(['OR',['=', 'rm_name_en', $data['Vehicle Manufacturer']],['=', 'rm_name_ar', $data['Vehicle Manufacturer']]])
                        ->andWhere(['=', 'rm_mastertype', 17])
                        ->asArray()
                        ->one()['Pk'];

        if (!$manufacturer) {
            $returndata['Vehicle Manufacturer'] = 2;
        }


        $rasvehicleOwner = RasvehicleownerdtlsTbl::find()
                        ->select(['rasvehicleownerdtls_pk as Pk'])
                        ->where(['=', 'rvod_crnumber', $data['CR No.']])
                        ->andWhere(['=', 'rvod_ownername_en', $data['Customer name (Client)']])
                        ->asArray()
                        ->one()['Pk'];

        if (!$rasvehicleOwner) {

            $rasvehicleOwnercivil = RasvehicleownerdtlsTbl::find()
                            ->select(['rasvehicleownerdtls_pk as Pk'])
                            ->where(['=', 'rvod_crnumber', $data['CR No.']])
                            ->asArray()
                            ->one()['Pk'];

            if ($rasvehicleOwnercivil) {

                $rasownerhsty = RasvehicleownerdtlshstyTbl::find()
                                ->select(['rvodh_rasvehicleownerdtls_fk as Pk'])
                                ->where(['=', 'rvodh_crnumber', $data['CR No.']])
                                ->andWhere(['=', 'rvodh_ownername_en', $data['Customer name (Client)']])
                                ->asArray()
                                ->one()['Pk'];

                if (!$rasownerhsty) {

                    $model = new RasvehicleownerdtlshstyTbl();
                    $model->rvodh_rasvehicleownerdtls_fk = $rasvehicleOwnercivil;
                    $model->rvodh_ownername_en = $data['Customer name (Client)'];
                    $model->rvodh_ownername_ar = $data['Customer name (Client)'];
                    $model->rvodh_crnumber = $data['CR No.'];
                    $model->rvodh_status = 1;
                    $model->rvodh_createdon = date('Y-m-d H:i:s');
                    $model->rvodh_createdby = $userpk;

                    if (!$model->save()) {
                        echo "<pre>";
                        var_dump($model->getErrors());
                        exit;
                    } else {
                        $rasvehicleOwner = $rasvehicleOwnercivil;
                    }
                }
                $rasvehicleOwner = $rasvehicleOwnercivil;
            } else {
                $model = new RasvehicleownerdtlsTbl();
                $model->rvod_ownername_en = $data['Customer name (Client)'];
                $model->rvod_ownername_ar = $data['Customer name (Client)'];
                $model->rvod_crnumber = $data['CR No.'];
                $model->rvod_status = 1;
                $model->rvod_createdon = date('Y-m-d H:i:s');
                $model->rvod_createdby = $userpk;

                if (!$model->save()) {
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                } else {
                    $rasvehicleOwner = $model->rasvehicleownerdtls_pk;
                }
            }
        }


        $datavehicle = trim(Security::sanitizeInput($data['Vehicle Reg. No.'], 'string'));
        $datavehicle = str_replace(' ', '', $datavehicle);
        $datavehicle = str_replace('-', '', $datavehicle);

        $vehiclerecord = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk as Pk'])
                ->where(["REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" => $datavehicle])
                ->andwhere(['=', 'ivrd_chassisno', $data['Chassis No.']])
                ->andwhere(['=', 'ivrd_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=', 'ivrd_appinstinfomain_fk', $instinfoPk])
                ->andWhere(['<>', 'ivrd_certificatestatus', 4])
                ->asArray()
                ->one();
        
        if(!$vehiclerecord)
        {
            $vehiclerecordch = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk as Pk'])
                 ->where(['<>',"REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" , $datavehicle])
                ->andwhere(['=', 'ivrd_chassisno', $data['Chassis No.']])
                ->andwhere(['=', 'ivrd_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=', 'ivrd_appinstinfomain_fk', $instinfoPk])
                ->andWhere(['<>', 'ivrd_certificatestatus', 4])
                ->asArray()
                ->one();
            
            if($vehiclerecordch)
            {
                 $returndata['Vehicle Reg. No.'] = 2;
            }
            
            $vehiclerecordreg = IvmsvehicleregdtlsTbl::find()
                ->select(['ivmsvehicleregdtls_pk as Pk'])
                ->where(['=',"REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" , $datavehicle])
                ->andwhere(['<>', 'ivrd_chassisno', $data['Chassis No.']])
                ->andwhere(['=', 'ivrd_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=', 'ivrd_appinstinfomain_fk', $instinfoPk])
                ->andWhere(['<>', 'ivrd_certificatestatus', 4])
                ->asArray()
                ->one();
            
            if($vehiclerecordreg)
            {
                 $returndata['Chassis No.'] = 2;
            }
        }


        $installer = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

        if ($vehiclerecord && $instinfoPk && $devicepk && $category && $opalmemberreg && $manufacturer) {

            $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=', 'rvodh_rasvehicleownerdtls_fk', $rasvehicleOwner])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];

            if (!$ownerhistory) {
                $ownermodel = RasvehicleownerdtlsTbl::findOne($rasvehicleOwner);
                $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);
            }

            $increasedate = '+' . '1' . ' years';
            $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));

            $vehicle = IvmsvehicleregdtlsTbl::findOne($vehiclerecord['Pk']);

            if (!$vehicle->ivrd_firstissuedate) {

                if ($vehicle->ivrd_dateofexpiry) {
//
//                    echo "<pre>";
//                    var_dump($vehicle->ivrd_dateofexpiry , $nextinspeciondate);
//                    exit;
                    if (strtotime($vehicle->ivrd_dateofexpiry) >= strtotime($nextinspeciondate)) {
                        //point 5.1
                        
                        $vehiclehsty = new IvmsvehicleregdtlshstyTbl();
                        $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk = $vehiclerecord['Pk'];
                        $vehiclehsty->ivrdh_appinstinfomain_fk = $instinfoPk;
                        $vehiclehsty->ivrdh_opalmemberregmst_fk = $opalmemberreg;
                        $vehiclehsty->ivrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
                        $vehiclehsty->ivrdh_appdeviceinfomain_fk = $devicepk;
                        $vehiclehsty->ivrdh_deviceimeino = $data['Device IMEI number'];
                        $vehiclehsty->ivrdh_softwareversion = $data['Software'];
                        $vehiclehsty->ivrdh_vehiclemanufname = $manufacturer;
                        $vehiclehsty->ivrdh_vechicleregno = $data['Vehicle Reg. No.'];
                        $vehiclehsty->ivrdh_chassisno = $data['Chassis No.'];
                        $vehiclehsty->ivrdh_vechiclecat = (int) $category['catPk'];
                        $vehiclehsty->ivrdh_vehiclesubcat = (int) $category['subCatPk'];
                        $vehiclehsty->ivrdh_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehiclehsty->ivrdh_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehiclehsty->ivrdh_Installername = (int) $installer;
                        $vehiclehsty->ivrdh_dateofexpiry = $nextinspeciondate;
                        if ($data['Date of replacement, if any'] != 'NULL') {
                            $vehiclehsty->ivrdh_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                        }
                        if (strtotime(date('Y-m-d')) > strtotime($vehiclehsty->ivrdh_dateofexpiry)) {
                            $vehiclehsty->ivrdh_certificatestatus = 3;
                        } else {
                            $vehiclehsty->ivrdh_certificatestatus = 2;
                        }
                        $vehiclehsty->ivrdh_applicationtype = 1;
                        $vehiclehsty->ivrdh_installationstatus = 3;
                        $vehiclehsty->ivrdh_verficationcode = $vehicle->ivrd_verficationcode;
                        $vehiclehsty->ivrdh_createdon = date('Y-m-d H:i:s');
                        $vehiclehsty->ivrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                        if ($vehiclehsty->validate() && $vehiclehsty->save()) {
                            $vehiclenumber = $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk;
                        } else {
                            $returndata['Vehicle History Record'] = 2;
                        }
                        
                    } else if (strtotime($vehicle->ivrd_dateofexpiry) < strtotime($nextinspeciondate)) {

                        //point 5.2
                        
                        $vehicle->ivrd_dateofexpiry = $nextinspeciondate;
                        if ($data['Date of replacement, if any'] != 'NULL') {
                            $vehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                        }
                        if ($vehicle->save()) {
                            $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;
                            if ($vehicle->ivrd_certificatestatus == 2) {
                                $pk = Security::encrypt($vehiclenumber);
                                if ($vehicle->ivrd_certificatestatus == 2) {
                                    self::ivmsCertificate($pk, 3);
                                }
                            }
                        } else {
                            
                            $returndata['Vehicle Record'] = 2;
                        }

                        $vehiclehsty = new IvmsvehicleregdtlshstyTbl();
                        $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk = $vehiclerecord['Pk'];
                        $vehiclehsty->ivrdh_appinstinfomain_fk = $instinfoPk;
                        $vehiclehsty->ivrdh_opalmemberregmst_fk = $opalmemberreg;
                        $vehiclehsty->ivrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
                        $vehiclehsty->ivrdh_appdeviceinfomain_fk = $devicepk;
                        $vehiclehsty->ivrdh_deviceimeino = $data['Device IMEI number'];
                        $vehiclehsty->ivrdh_softwareversion = $data['Software'];
                        $vehiclehsty->ivrdh_vehiclemanufname = $manufacturer;
                        $vehiclehsty->ivrdh_vechicleregno = $data['Vehicle Reg. No.'];
                        $vehiclehsty->ivrdh_chassisno = $data['Chassis No.'];
                        $vehiclehsty->ivrdh_vechiclecat = (int) $category['catPk'];
                        $vehiclehsty->ivrdh_vehiclesubcat = (int) $category['subCatPk'];
                        $vehiclehsty->ivrdh_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehiclehsty->ivrdh_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehiclehsty->ivrdh_Installername = (int) $installer;
                        $vehiclehsty->ivrdh_dateofexpiry = $nextinspeciondate;
                        if ($data['Date of replacement, if any'] != 'NULL') {
                            $vehiclehsty->ivrdh_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                        }
                        if (strtotime(date('Y-m-d')) > strtotime($vehiclehsty->ivrdh_dateofexpiry)) {
                            $vehiclehsty->ivrdh_certificatestatus = 3;
                        } else {
                            $vehiclehsty->ivrdh_certificatestatus = 2;
                        }
                        $vehiclehsty->ivrdh_applicationtype = 1;
                        $vehiclehsty->ivrdh_installationstatus = 3;
                        $vehiclehsty->ivrdh_verficationcode = $vehicle->ivrd_verficationcode;
                        $vehiclehsty->ivrdh_createdon = date('Y-m-d H:i:s');
                        $vehiclehsty->ivrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                        if ($vehiclehsty->save()) {
                            $vehiclenumber = $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk;
                        } else {
                            $returndata['Vehicle History Record'] = 2;
                        }
                    }
                } else {

                    //point 4.1
                    
                   
                    $vehicle->ivrd_dateofexpiry = $nextinspeciondate;
                    if ($data['Date of replacement, if any'] != 'NULL') {
                        $vehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                    }
                    if ($vehicle->save()) {
                        $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;

                        if ($vehicle->ivrd_certificatestatus == 2) {
                            $pk = Security::encrypt($vehiclenumber);
                            if ($vehicle->ivrd_certificatestatus == 2) {
                                self::ivmsCertificate($pk, 3);
                            }
                        }
                    } else {
                        
                        $returndata['Vehicle Record'] = 2;
                    }

                    $vehiclehsty = new IvmsvehicleregdtlshstyTbl();
                    $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk = $vehicle->ivmsvehicleregdtls_pk;
                    $vehiclehsty->ivrdh_appinstinfomain_fk = $instinfoPk;
                    $vehiclehsty->ivrdh_opalmemberregmst_fk = $opalmemberreg;
                    $vehiclehsty->ivrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
                    $vehiclehsty->ivrdh_appdeviceinfomain_fk = $devicepk;
                    $vehiclehsty->ivrdh_deviceimeino = $data['Device IMEI number'];
                    $vehiclehsty->ivrdh_softwareversion = $data['Software'];
                    $vehiclehsty->ivrdh_vehiclemanufname = $manufacturer;
                    $vehiclehsty->ivrdh_vechicleregno = $data['Vehicle Reg. No.'];
                    $vehiclehsty->ivrdh_chassisno = $data['Chassis No.'];
                    $vehiclehsty->ivrdh_vechiclecat = (int) $category['catPk'];
                    $vehiclehsty->ivrdh_vehiclesubcat = (int) $category['subCatPk'];
                    $vehiclehsty->ivrdh_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehiclehsty->ivrdh_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehiclehsty->ivrdh_Installername = (int) $installer;
                    $vehiclehsty->ivrdh_dateofexpiry = $nextinspeciondate;
                    if ($data['Date of replacement, if any'] != 'NULL') {
                        $vehiclehsty->ivrdh_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                    }
                    if (strtotime(date('Y-m-d')) < strtotime($vehiclehsty->ivrdh_dateofexpiry)) {
                        $vehiclehsty->ivrdh_certificatestatus = 2;
                    } else {
                        $vehiclehsty->ivrdh_certificatestatus = 3;
                    }
                    $vehiclehsty->ivrdh_applicationtype = 1;
                    $vehiclehsty->ivrdh_installationstatus = 3;
                    $vehiclehsty->ivrdh_verficationcode = $vehicle->ivrd_verficationcode;
                    $vehiclehsty->ivrdh_createdon = date('Y-m-d H:i:s');
                    $vehiclehsty->ivrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                    if ($vehiclehsty->save()) {
                        $vehiclenumber = $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk;
                    } else {
                        $returndata['Vehicle History Record'] = 2;
                    }
                }
            } else {

                if (strtotime($vehicle->ivrd_dateofexpiry) >= strtotime($nextinspeciondate)) {
//point 2.1
                    $vehiclehsty = new IvmsvehicleregdtlshstyTbl();
                    $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk = $vehiclerecord['Pk'];
                    $vehiclehsty->ivrdh_appinstinfomain_fk = $instinfoPk;
                    $vehiclehsty->ivrdh_opalmemberregmst_fk = $opalmemberreg;
                    $vehiclehsty->ivrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
                    $vehiclehsty->ivrdh_appdeviceinfomain_fk = $devicepk;
                    $vehiclehsty->ivrdh_deviceimeino = $data['Device IMEI number'];
                    $vehiclehsty->ivrdh_softwareversion = $data['Software'];
                    $vehiclehsty->ivrdh_vehiclemanufname = $manufacturer;
                    $vehiclehsty->ivrdh_vechicleregno = $data['Vehicle Reg. No.'];
                    $vehiclehsty->ivrdh_chassisno = $data['Chassis No.'];
                    $vehiclehsty->ivrdh_vechiclecat = (int) $category['catPk'];
                    $vehiclehsty->ivrdh_vehiclesubcat = (int) $category['subCatPk'];
                    $vehiclehsty->ivrdh_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehiclehsty->ivrdh_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehiclehsty->ivrdh_Installername = (int) $installer;
                    $vehiclehsty->ivrdh_dateofexpiry = $nextinspeciondate;
                    if ($data['Date of replacement, if any'] != 'NULL') {
                        $vehiclehsty->ivrdh_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                    }
                    if (strtotime(date('Y-m-d')) < strtotime($vehiclehsty->ivrdh_dateofexpiry)) {
                        $vehiclehsty->ivrdh_certificatestatus = 2;
                    } else {
                        $vehiclehsty->ivrdh_certificatestatus = 3;
                    }
                    $vehiclehsty->ivrdh_applicationtype = 1;
                    $vehiclehsty->ivrdh_installationstatus = 3;
                    $vehiclehsty->ivrdh_verficationcode = $vehicle->ivrd_verficationcode;
                    $vehiclehsty->ivrdh_createdon = date('Y-m-d H:i:s');
                    $vehiclehsty->ivrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                    if ($vehiclehsty->save()) {
                        $vehiclenumber = $vehiclehsty->ivrdh_ivmsvehicleregdtls_fk;
                    } else {
                        $returndata['Vehicle History Record'] = 2;
                    }
                } else {
                    //point 2.2
                    $vehiclehsty = IvmsvehicleregdtlshstyTbl::movetohistory($vehicle);
                    $vehicle->ivrd_appinstinfomain_fk = $instinfoPk;
                    $vehicle->ivrd_opalmemberregmst_fk = $opalmemberreg;
                    $vehicle->ivrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
                    $vehicle->ivrd_appdeviceinfomain_fk = $devicepk;
                    $vehicle->ivrd_deviceimeino = $data['Device IMEI number'];
                    $vehicle->ivrd_vehiclemanufname = $manufacturer;
                    $vehicle->ivrd_softwareversion = $data['Software'];
                    $vehicle->ivrd_vechicleregno = $data['Vehicle Reg. No.'];
                    $vehicle->ivrd_chassisno = $data['Chassis No.'];
                    $vehicle->ivrd_vechiclecat = (int) $category['catPk'];
                    $vehicle->ivrd_vehiclesubcat = (int) $category['subCatPk'];
                    $vehicle->ivrd_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehicle->ivrd_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                    $vehicle->ivrd_Installername = (int) $installer;
                    $increasedate = '+' . '1' . ' years';
                    $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));
                    $vehicle->ivrd_dateofexpiry = $nextinspeciondate;
                    if ($data['Date of replacement, if any'] != 'NULL') {
                        $vehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                    }
                    if (strtotime(date('Y-m-d')) < strtotime($vehicle->ivrd_dateofexpiry)) {
                        $vehicle->ivrd_certificatestatus = 2;
                    } else {
                        $vehicle->ivrd_certificatestatus = 3;
                    }
                    $vehicle->ivrd_applicationtype = 1;
                    $vehicle->ivrd_installationstatus = 3;
                    $vehicle->ivrd_verficationcode = self::generateCertificateNumber();
                    $vehicle->ivrd_createdon = date('Y-m-d H:i:s');
                    $vehicle->ivrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                    if ($vehicle->save()) {
                        $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;
                        if ($vehicle->ivrd_certificatestatus == 2) {
                            $pk = Security::encrypt($vehiclenumber);
                            if ($vehicle->ivrd_certificatestatus == 2) {
                                self::ivmsCertificate($pk, 3);
                            }
                        }
                    } else {
                        
                        $returndata['Vehicle Record'] = 2;
                    }
                }
            }
        } else if (!$vehiclerecordreg && !$vehiclerecordch && $instinfoPk && $devicepk && $category && $opalmemberreg && $manufacturer) {


            $companyrec = IvmsvehicleregdtlsTbl::find()
                    ->select(['ivmsvehicleregdtls_pk as Pk'])
                    ->where(["REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" => $datavehicle])
                    ->andwhere(['=', 'ivrd_chassisno', $data['Chassis No.']])
                    ->andWhere(['<>', 'ivrd_certificatestatus', 4])
                    ->asArray()
                    ->one();

            if ($companyrec && $instinfoPk && $devicepk && $category && $opalmemberreg) {


                $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=', 'rvodh_rasvehicleownerdtls_fk', $rasvehicleOwner])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];

                if (!$ownerhistory) {
                    $ownermodel = RasvehicleownerdtlsTbl::findOne($rasvehicleOwner);
                    $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);
                }

                $increasedate = '+' . '1' . ' years';
                $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));

                $vehicle = IvmsvehicleregdtlsTbl::findOne($companyrec['Pk']);

                if (!$vehicle->ivrd_firstissuedate) {
                    
                } else {


                    if (strtotime($vehicle->ivrd_dateofexpiry) < strtotime($nextinspeciondate)) {
                        //point 3.2
                      

                        $vehicle->ivrd_certificatestatus = 4;
                        $vehicle->ivrd_installationstatus = 6;
                        if ($vehicle->save()) {
                            $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;
                            if ($vehicle->ivrd_certificatestatus == 2) {
                                $pk = Security::encrypt($vehiclenumber);
                                if ($vehicle->ivrd_certificatestatus == 2) {
                                    self::ivmsCertificate($pk, 3);
                                }
                            }
                        } else {
                            
                            $returndata['Vehicle Record'] = 2;
                        }

                        $newvehicle = new IvmsvehicleregdtlsTbl();
                        $newvehicle->ivrd_appinstinfomain_fk = $instinfoPk;
                        $newvehicle->ivrd_opalmemberregmst_fk = $opalmemberreg;
                        $newvehicle->ivrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
                        $newvehicle->ivrd_appdeviceinfomain_fk = $devicepk;
                        $newvehicle->ivrd_deviceimeino = $data['Device IMEI number'];
                        $newvehicle->ivrd_vehiclemanufname = $manufacturer;
                        $newvehicle->ivrd_softwareversion = $data['Software'];
                        $newvehicle->ivrd_vechicleregno = $data['Vehicle Reg. No.'];
                        $newvehicle->ivrd_chassisno = $data['Chassis No.'];
                        $newvehicle->ivrd_vechiclecat = (int) $category['catPk'];
                        $newvehicle->ivrd_vehiclesubcat = (int) $category['subCatPk'];
                        $newvehicle->ivrd_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                        $newvehicle->ivrd_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                        $newvehicle->ivrd_Installername = (int) $installer;
                        $increasedate = '+' . '1' . ' years';
                        $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));
                        $newvehicle->ivrd_dateofexpiry = $nextinspeciondate;
                        if ($data['Date of replacement, if any'] != 'NULL') {
                            $newvehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                        }
                        if (strtotime(date('Y-m-d')) < strtotime($newvehicle->ivrd_dateofexpiry)) {
                            $newvehicle->ivrd_certificatestatus = 2;
                        } else {
                            $newvehicle->ivrd_certificatestatus = 3;
                        }
                        $newvehicle->ivrd_applicationtype = 1;
                        $newvehicle->ivrd_installationstatus = 3;
                        $newvehicle->ivrd_verficationcode = self::generateCertificateNumber();
                        $newvehicle->ivrd_createdon = date('Y-m-d H:i:s');
                        $newvehicle->ivrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);
                        if ($newvehicle->save()) {
                            $vehiclenumber = $newvehicle->ivmsvehicleregdtls_pk;
                            if ($newvehicle->ivrd_certificatestatus == 2) {
                                $pk = Security::encrypt($vehiclenumber);
                                if ($newvehicle->ivrd_certificatestatus == 2) {
                                    self::ivmsCertificate($pk, 3);
                                }
                            }
                        } else {
                           
                            $returndata['Vehicle Record'] = 2;
                        }
                    } else {

                        //point 3.1
                        $vehicle = new IvmsvehicleregdtlsTbl();
                        $vehicle->ivrd_appinstinfomain_fk = $instinfoPk;
                        $vehicle->ivrd_opalmemberregmst_fk = $opalmemberreg;
                        $vehicle->ivrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
                        $vehicle->ivrd_appdeviceinfomain_fk = $devicepk;
                        $vehicle->ivrd_deviceimeino = $data['Device IMEI number'];
                        $vehicle->ivrd_vehiclemanufname = $manufacturer;
                        $vehicle->ivrd_softwareversion = $data['Software'];
                        $vehicle->ivrd_vechicleregno = $data['Vehicle Reg. No.'];
                        $vehicle->ivrd_chassisno = $data['Chassis No.'];
                        $vehicle->ivrd_vechiclecat = (int) $category['catPk'];
                        $vehicle->ivrd_vehiclesubcat = (int) $category['subCatPk'];
                        $vehicle->ivrd_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehicle->ivrd_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                        $vehicle->ivrd_Installername = (int) $installer;
                        $increasedate = '+' . '1' . ' years';
                        $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));
                        $vehicle->ivrd_dateofexpiry = $nextinspeciondate;
                        if ($data['Date of replacement, if any'] != 'NULL') {
                            $vehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                        }
//                        if (strtotime(date('Y-m-d')) >= strtotime($vehicle->ivrd_dateofexpiry)) {
//                            $vehicle->ivrd_certificatestatus = 2;
//                        } else {
                        $vehicle->ivrd_certificatestatus = 4;
//                        }
                        $vehicle->ivrd_applicationtype = 1;
                        $vehicle->ivrd_installationstatus = 6;
                        $vehicle->ivrd_verficationcode = self::generateCertificateNumber();
                        $vehicle->ivrd_createdon = date('Y-m-d H:i:s');
                        $vehicle->ivrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);
                        if ($vehicle->save()) {
                            $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;
                            $pk = Security::encrypt($vehiclenumber);
                            if ($vehicle->ivrd_certificatestatus == 2) {
                                self::ivmsCertificate($pk, 3);
                            }
                        } else {
                            
                            $returndata['Vehicle Record'] = 2;
                        }
                    }
                }
            } else if ($instinfoPk && $devicepk && $category && $opalmemberreg) {
//point 1
                $vehicle = new IvmsvehicleregdtlsTbl();
                $vehicle->ivrd_appinstinfomain_fk = $instinfoPk;
                $vehicle->ivrd_opalmemberregmst_fk = $opalmemberreg;
                $vehicle->ivrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
                $vehicle->ivrd_appdeviceinfomain_fk = $devicepk;
                $vehicle->ivrd_deviceimeino = $data['Device IMEI number'];
                $vehicle->ivrd_vehiclemanufname = $manufacturer;
                $vehicle->ivrd_softwareversion = $data['Software'];
                $vehicle->ivrd_vechicleregno = $data['Vehicle Reg. No.'];
                $vehicle->ivrd_chassisno = $data['Chassis No.'];
                $vehicle->ivrd_vechiclecat = (int) $category['catPk'];
                $vehicle->ivrd_vehiclesubcat = (int) $category['subCatPk'];
                $vehicle->ivrd_installationdate = date('Y-m-d', strtotime($data['Date of fitting']));
                $vehicle->ivrd_dateoffiiting = date('Y-m-d', strtotime($data['Date of fitting']));
                $vehicle->ivrd_Installername = (int) $installer;
                $increasedate = '+' . '1' . ' years';
                $nextinspeciondate = date('Y-m-d', strtotime($increasedate, strtotime(date('Y-m-d', strtotime($data['Date of fitting'])))));
                $vehicle->ivrd_dateofexpiry = $nextinspeciondate;
                if ($data['Date of replacement, if any'] != 'NULL') {
                    $vehicle->ivrd_dateofreplacement = date('Y-m-d', strtotime($data['Date of replacement, if any']));
                }
                if (strtotime(date('Y-m-d')) < strtotime($vehicle->ivrd_dateofexpiry)) {
                    $vehicle->ivrd_certificatestatus = 2;
                } else {
                    $vehicle->ivrd_certificatestatus = 3;
                }
                $vehicle->ivrd_applicationtype = 1;
                $vehicle->ivrd_installationstatus = 3;
                $vehicle->ivrd_verficationcode = self::generateCertificateNumber();
                $vehicle->ivrd_createdon = date('Y-m-d H:i:s');
                $vehicle->ivrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 5) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                if ($vehicle->save()) {
                    $vehiclenumber = $vehicle->ivmsvehicleregdtls_pk;
                    $pk = Security::encrypt($vehiclenumber);
                    if ($vehicle->ivrd_certificatestatus == 2) {
                        self::ivmsCertificate($pk, 3);
                    }
                } else {
                    
                    $returndata['Vehicle Record'] = 2;
                }
            }
        }


        if ($vehiclenumber) {
            return true;
        } else {

            if (empty($returndata)) {
                $returndata['Overall'] = 2;
            }

            return $returndata;
        }
    }

    public static function getVehicleDtlsByRefNo($dataToCheck) {

        $data = trim(Security::sanitizeInput($dataToCheck, 'string'));
        $model = IvmsvehicleregdtlsTbl::find()
                ->select(['ivrd_installationstatus as status', 'ivmsvehicleregdtls_pk as vehiclepk', 'omrm_companyname_en as centre', 'ivrd_chassisno as chasis', 'If(ivrd_dateofexpiry is not null and IF((now() > DATE_ADD(ivrd_dateofexpiry,INTERVAL - 2 MONTH) &&  ivrd_dateofexpiry > now()) , 1, 0),1,2) as nearing', ' If(ivrd_dateofexpiry is not null and IF(( ivrd_dateofexpiry < now()) , 1, 0),1,2) as expired'])
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = ivrd_opalmemberregmst_fk')
                ->where(["REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" => $data])
                ->andWhere(['NOT IN', 'ivrd_installationstatus', [4, 5, 6]])
                ->orderBy('ivmsvehicleregdtls_pk desc');

        return $model->asArray()->one();
    }

    public static function getnumberofinstallations($devpk) {
        $model = IvmsvehicleregdtlsTbl::findOne($devpk);

        if ($model->ivrd_applicationtype == 1) {
            $numofins = IvmsvehicleregdtlsTbl::find()
                            ->where(['OR', ['IN', 'ivrd_installationstatus', [1, 2, 3, 7, 5]], ['AND', ['IN', 'ivrd_installationstatus', [6]], ['=', 'ivrd_certificatestatus', 2]]])
                            ->andWhere(['=', 'ivrd_appinstinfomain_fk', $model['ivrd_appinstinfomain_fk']])->count();

            $numoftech = OpalusermstTbl::find()
                            ->leftJoin('appstaffinfomain_tbl', 'appsim_StaffInfoRepo_FK = oum_staffinforepo_fk')
                            ->where("FIND_IN_SET('20', oum_rolemst_fk) or oum_rolemst_fk = 20")->andWhere(['=', 'appsim_AppInstInfoMain_FK', $model['ivrd_appinstinfomain_fk']])->count('distinct opalusermst_pk');
            

            $rule = \app\models\IvmsdeviceinstallconfigmstTbl::find()
                    ->select(['idicm_nooftechnician', 'idicm_maxnoofinstallation'])
                    ->where(['=', 'idicm_nooftechnician', $numoftech])
                    ->andWhere(['=', 'sccm_status', 1])
                    ->one();
            $maxinconfig = \app\models\IvmsdeviceinstallconfigmstTbl::find()->select(['max(idicm_nooftechnician) as maxnum'])->asArray()->one()['maxnum'];

            if ($rule) {

                if ($rule['idicm_maxnoofinstallation'] > $numofins) {
                    $result = true;
                } else {
                    $result = false;
                }
            } else if ($maxinconfig < $numoftech) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            $result = true;
        }

        return ['result' => $result, 'installation' => $numofins, 'technician' => $numoftech];
    }

    public static function sendIvmsDeviceMail($userPk, $type, $attrbts = null) {
        

        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        
        $_data = [
            'type' => $type,
            'userpk' => $userPk,
            'attrbts' => $attrbts
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($_data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);


        $err = curl_error($curl);
        curl_close($curl);
    }

    public static function sendVehicleRegistrationMail($vehiclePk) {
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehiclePk);

        $data = [
            'vehiclePk' => $vehiclePk,
        ];

        $result = Ivmsdevice::sendIvmsDeviceMail($vehicle->ivrd_Installername, 'ivmsvehiclereginst', $data);

        if ($vehicle->ivrd_contpermailid) {
            $result2 = Ivmsdevice::sendIvmsDeviceMail($vehicle->ivrd_Installername, 'ivmsvehicleregowner', $data);
        }
    }

    public static function sendMailtoSrTechinicians($vehiclePk) {
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehiclePk);
        $data = [
            'vehiclePk' => $vehiclePk,
        ];

        $srTechs = OpalusermstTbl::find()
                ->select('opalusermst_pk')
                ->leftJoin('appstaffinfomain_tbl', 'appsim_StaffInfoRepo_FK = oum_staffinforepo_fk')
                ->where("FIND_IN_SET('19', oum_rolemst_fk) or oum_rolemst_fk = 19")
                ->andWhere("FIND_IN_SET('" . $vehicle->ivrd_appdeviceinfomain_fk . "', appsim_appdeviceinfomain_fk) or appsim_appdeviceinfomain_fk = " . $vehicle->ivrd_appdeviceinfomain_fk)
                ->andWhere(['<>', 'opalusermst_pk', $vehicle->ivrd_Installername])
                ->asArray()
                ->all();

        foreach ($srTechs as $srTechnician) {
            self::sendIvmsDeviceMail($srTechnician['opalusermst_pk'], 'ivmsvehicleregsrtech', $data);
        }
    }

    public static function sendApprovedMail($vehiclePk) {
        $vehicle = IvmsvehicleregdtlsTbl::findOne($vehiclePk);

        $data = [
            'vehiclePk' => $vehiclePk,
        ];

        if ($vehicle->ivrd_contpermailid) {
            $result2 = Ivmsdevice::sendIvmsDeviceMail($vehicle->ivrd_Installername, 'ivmsvehicleregcltcert', $data);
        }
    }

}

?>