<?php

namespace api\modules\pms\models;

use api\modules\pms\models\CmsaddinfodtlsTbl;
use api\modules\pms\models\CmstenderhdrTbl;
use api\modules\quot\models\CmsquotationhdrTbl;
use api\modules\quot\models\CmsquotationevalhstyTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use api\modules\rfx\components\Rfx;
use common\components\Common;
use common\components\Security;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use Yii;
use common\components\Drive;
use common\models\UsermstTbl;
use common\models\MembercompanymstTbl;
use api\modules\pms\models\CmstenderhdrhstyTbl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\db\Expression;
use common\components\Notification;
use api\modules\pms\models\CmstenderhdrtempTblQuery;
use api\modules\pms\models\CmstendertargethdrTbl;

/**
 * This is the ActiveQuery class for [[CmstenderhdrTbl]].
 *
 * @see CmstenderhdrTbl
 */
class CmstenderhdrTblQuery extends \yii\db\ActiveQuery {
    const ENQURY_TYPE_CAN_CREATE_VAR =  array(
        0 => 'rfx_create', 
        1 => 'rfi_create', 
        2 => 'eoi_create', 
        3 => 'pq_create', 
        4 => 'rfp_create', 
        5 => 'rfq_create', 
        6 => 'rft_create', 
        7 => 'eTender', 
        8 => 'eAuction'
    );

    const ENQURY_TYPES =  array(
        1 => 'rfi', 
        2 => 'eoi', 
        3 => 'pq', 
        4 => 'rfp', 
        5 => 'rfq', 
        6 => 'rft', 
        7 => 'eTender', 
        8 => 'eAuction'
    );

    const ENQURY_TYPE_TO_CHECK_FOR_CREATE =  array(
        1 => array('2', '3', '4', '5', '6'), 
        2 => array('3', '4', '5', '6'), 
        3 => array('4', '5', '6'), 
        4 => array('5', '6'), 
        5 => array('6'), 
        6 => [],
    );

    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstenderhdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function GetViewRFIdata($tenderHeaderPk) {
        $RFIDataArray = CmstenderhdrTbl::find()
                        ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'mcfd_memcompmst_fk as proComPK', 'memcompfiledtls_pk as proFilePk', 'mcfd_uploadedby as proUserPK', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqtitle', 'crfd_rqpriority', 'crfd_rqdate', 'cmsth_refno', 'cmsth_title', 'cmsth_shortdesc', 'cmsth_statement', 'cmsth_instruction', 'cmsth_uid', 'MCM_CompanyName', 'cmsth_remarks', 'um_firstname', 'UM_EmpId', 'cmsth_skdclosedate', 'cmsth_skdstartdate', 'UM_EmpId'])
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projbanner')
                        ->where('cmstenderhdr_pk=:pk', array(':pk' => $tenderHeaderPk))
                        ->andWhere('cmsth_type=:type', array(':type' => 1))
                        ->asArray()->one();
        $AddInfoDtlsArray = CmsaddinfodtlsTblQuery::GetAddInfoData($tenderHeaderPk);
        $supportDocArray = CmssupdocumentTblQuery::getData($tenderHeaderPk, 3);
        $module = [
            'RFIDataArray' => $RFIDataArray,
            'AddInfoDtlsArray' => $AddInfoDtlsArray,
            'SupportDocArray' => $supportDocArray,
        ];
        return $module;
    }

    public function GetViewEOIdata($tenderHeaderPk) {
        $EOIDataArray = CmstenderhdrTbl::find()
                        ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'mcfd_memcompmst_fk as proComPK', 'memcompfiledtls_pk as proFilePk', 'mcfd_uploadedby as proUserPK', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqtitle', 'crfd_rqpriority', 'crfd_rqdate', 'cmsth_refno', 'cmsth_title', 'cmsth_shortdesc', 'cmsth_statement', 'cmsth_instruction', 'cmsth_mineligibility', 'cmsth_uid', 'MCM_CompanyName', 'cmsth_remarks', 'um_firstname', 'UM_EmpId', 'cmsth_skdclosedate', 'cmsth_skdstartdate', 'UM_EmpId'])
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projbanner')
                        ->where('cmstenderhdr_pk=:pk', array(':pk' => $tenderHeaderPk))
                        ->andWhere('cmsth_type=:type', array(':type' => 2))
                        ->asArray()->one();
        $AddInfoDtlsArray = CmsaddinfodtlsTblQuery::GetAddInfoData($tenderHeaderPk);
        $supportDocArray = CmssupdocumentTblQuery::getData($tenderHeaderPk, 4);
        $module = [
            'EOIDataArray' => $EOIDataArray,
            'AddInfoDtlsArray' => $AddInfoDtlsArray,
            'SupportDocArray' => $supportDocArray,
        ];
        return $module;
    }

    public function GetViewPQdata($tenderHeaderPk) {
        $PQDataArray = CmstenderhdrTbl::find()
                        ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'mcfd_memcompmst_fk as proComPK', 'memcompfiledtls_pk as proFilePk', 'mcfd_uploadedby as proUserPK', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqtitle', 'crfd_rqpriority', 'crfd_rqdate', 'cmsth_refno', 'cmsth_title', 'cmsth_shortdesc', 'cmsth_statement', 'cmsth_instruction', 'cmsth_mineligibility', 'cmsth_uid', 'MCM_CompanyName', 'cmsth_remarks', 'um_firstname', 'UM_EmpId', 'cmsth_skdclosedate', 'cmsth_skdstartdate', 'UM_EmpId'])
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projbanner')
                        ->where('cmstenderhdr_pk=:pk', array(':pk' => $tenderHeaderPk))
                        ->andWhere('cmsth_type=:type', array(':type' => 5))
                        ->asArray()->one();
        $AddInfoDtlsArray = CmsaddinfodtlsTblQuery::GetAddInfoData($tenderHeaderPk);
        $supportDocArray = CmssupdocumentTblQuery::getData($tenderHeaderPk, 5);
        $module = [
            'pqDataArray' => $PQDataArray ? $PQDataArray : [],
            'AddInfoDtlsArray' => $AddInfoDtlsArray ? $AddInfoDtlsArray : [],
            'SupportDocArray' => $supportDocArray ? $supportDocArray : [],
        ];
        return $module;
    }

    public function GetViewRFPdata($tenderHeaderPk) {
        $RFPDataArray = CmstenderhdrTbl::find()
                        ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'mcfd_memcompmst_fk as proComPK', 'memcompfiledtls_pk as proFilePk', 'mcfd_uploadedby as proUserPK', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqtitle', 'crfd_rqpriority', 'crfd_rqdate', 'cmsth_refno', 'cmsth_title', 'cmsth_shortdesc', 'cmsth_statement', 'cmsth_instruction', 'cmsth_uid', 'MCM_CompanyName', 'cmsth_remarks', 'um_firstname', 'UM_EmpId', 'cmsth_skdclosedate', 'cmsth_skdstartdate'])
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projbanner')
                        ->where('cmstenderhdr_pk=:pk', array(':pk' => $tenderHeaderPk))
                        ->andWhere('cmsth_type=:type', array(':type' => 7))
                        ->asArray()->one();
        $AddInfoDtlsArray = CmsaddinfodtlsTblQuery::GetAddInfoData($tenderHeaderPk);
        $supportDocArray = CmssupdocumentTblQuery::getData($tenderHeaderPk, 6);
        $module = [
            'RFPDataArray' => $RFPDataArray,
            'AddInfoDtlsArray' => $AddInfoDtlsArray,
            'SupportDocArray' => $supportDocArray,
        ];
        return $module;
    }

    public function addRequisition($data) {
        if (!empty($data)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $rfiData = $data['rfiData'];

            if ($rfiData['ten_id']) {
                $model = CmstenderhdrTbl::find()
                        ->where("cmstenderhdr_pk =:pk", [':pk' => Security::decrypt($rfiData['ten_id'])])
                        ->andWhere("cmsth_type =:type", [':type' => $rfiData['request_for']])
                        ->one();
                if (!empty($model->cmsth_createdon)) {
                    $model->cmsth_updatedon = $date;
                    $model->cmsth_updatedby = $userPK;
                }
            } else {
                $model = new CmstenderhdrTbl();
                $model->cmsth_uid = Common::getUniqueId('cmsRFI');
                $model->cmsth_createdon = $date;
            }

            if ($rfiData['request'] == 'titleCard') {
                $model->cmsth_cmsrequisitionformdtls_fk = $rfiData['req_id'];
                $model->cmsth_title = $rfiData['rficardtit'] ? $rfiData['rficardtit'] : $rfiData['eoicardtit'];
                $model->cmsth_refno = $rfiData['rficardrefno'] ? $rfiData['rficardrefno'] : $rfiData['eoicardrefno'];
                $model->cmsth_initiatedby = $rfiData['rfi_initiateby'] ? $rfiData['rfi_initiateby'] : $rfiData['eoi_initiateby'];
                $model->cmsth_initiateddate = $rfiData['initiate_Date'];
                $model->cmsth_type = $rfiData['request_for'];
            } else if ($rfiData['request'] == 'info') {
                $model->cmsth_cmsrequisitionformdtls_fk = $rfiData['req_id'];
                $model->cmsth_shortdesc = $rfiData['rfi_shortdesc'] ? $rfiData['rfi_shortdesc'] : $rfiData['eoi_shortdesc'];
                $model->cmsth_statement = $rfiData['requisi_state'] ? $rfiData['requisi_state'] : $rfiData['eoi_state'];
                $model->cmsth_instruction = $rfiData['rfi_instruct'] ? $rfiData['rfi_instruct'] : $rfiData['eoi_instruct'];
                $model->cmsth_mineligibility = $rfiData['eoi_minimum'];
            } else if ($rfiData['request'] == 'rfiaddinfo') {
                foreach ($rfiData['permitlicenses'] as $key => $value) {
                    if ($value['addinfopk']) {
                        $model = CmsaddinfodtlsTbl::find()->where("cmsaddinfodtls_pk =:pk", [':pk' => $value['addinfopk']])->one();
                        if (!empty($model->caid_createdon)) {
                            $model->caid_updatedon = $date;
                            $model->caid_updatedby = $userPK;
                            $model->caid_updatedbyipaddr = Common::getIpAddress();
                        }
                    } else {
                        $model = new CmsaddinfodtlsTbl();
                        $model->caid_createdon = $date;
                        $model->caid_createdby = $userPK;
                        $model->caid_createdbyipaddr = Common::getIpAddress();
                    }
                    $model->caid_cmstenderhdr_fk = Security::decrypt($rfiData['ten_id']);
                    $model->caid_title = $value['question'];
                    $model->caid_description = $value['answer'];
                    $model->caid_index = $key + 1;
                    $model->caid_status = 1;
                }
            } else if ($rfiData['request'] == 'rfischedule') {
                $model->cmsth_skdtype = $rfiData['schedule_type'];
                $model->cmsth_skd_timezone_fk = $rfiData['timezone'];
                $model->cmsth_skdstartdate = date('Y-m-d', strtotime($rfiData['req_date']));
                $model->cmsth_skdclosedate = date('Y-m-d', strtotime($rfiData['close_date']));
            } else if ($rfiData['request'] == 'questionnarie') {
                $model->cmsth_cmsquestionnaireform_fk = $rfiData['pk'];
            } else if ($rfiData['request'] == 'config') {
                $model->cmsth_setreminder = $rfiData['isreminder'] == true ? 1 : 0;
                $model->cmsth_closeintvltype = $rfiData['aft_intervalcnt'];
                $model->cmsth_closeintvl = $rfiData['aft_interval'];
                $model->cmsth_openintvl = $rfiData['req_intervalcnt'];
                $model->cmsth_openintvltype = $rfiData['req_interval'];
                // $model->cmsth_tgtsup_mcm_fk = $rfiData['supplier_pks'];
            }
            if ($rfiData['request'] != 'rfiaddinfo') {
                $getuser = \common\models\UsermstTbl::getUserData($model->cmsth_initiatedby);
            }

            if ($model->save() === TRUE) {
                if ($rfiData['request'] == 'rfiaddinfo') {
                    $all_addinfo_tender = CmsaddinfodtlsTbl::find()
                            ->select(['cmsaddinfodtls_pk as addinfopk', 'caid_title as question', 'caid_description as answer'])
                            ->where("caid_cmstenderhdr_fk =:ten_fk", [':ten_fk' => Security::decrypt($rfiData['ten_id'])])
                            ->asArray()
                            ->All();
                    $model = $all_addinfo_tender;
                }
                if ($rfiData['ten_id']) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'CMSTender Update Successfully!',
                        'moduleData' => $model,
                        'username' => $getuser['empname']
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => 'CMSTender Created Successfully!',
                        'moduleData' => $model,
                        'username' => $getuser['empname']
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }

    public function getrfidatafortender($tenPk, $type) {
        $model = CmstenderhdrTbl::find()->
                        select(['*', 'date_format(cmsth_initiateddate,"%d-%m-%Y") as cmsth_initiateddate_formatted', 'um_firstname'])
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->where('cmsth_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
                        ->andWhere('cmsth_type=:type', [':type' => $type])
                        ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                        ->asArray()->All();
        // $addinfo_model = CmsaddinfodtlsTbl::find()->select(['cmsaddinfodtls_pk as addinfopk', 'caid_title as question', 'caid_description as answer'])->where('caid_cmstenderhdr_fk=:pk', [':pk' => $tenPk])->asArray()->All();
        // $return['tenderhdr'] = $model;
        // $return['addinfo'] = $addinfo_model;
        return $model;
    }

    public static function getActiverfxCount($reqPk, $type) {
        if ($reqPk) {
            $pk = $reqPk;
            $countquery = CmstenderhdrTbl::find()
                ->select(['cmsth_type as type','count(*) as count'])
                ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $pk))
                ->andWhere('cmsth_type=:type', array(':type' => $type))
                ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                ->andWhere(['IN', 'cmsth_tenderstatus' , [2,3]]) 
                // Need to enable this line after status related development done 
                ->groupBy(['cmsth_type'])
                ->asArray()->all(); 
            return $countquery;
        }
    }

    public function getrfxdatafortender($tenPk, $type, $page, $perpage, $sortorder=null) {
        $model = CmstenderhdrTbl::find()->select(['*', 'cmsth_tenderstatus as derived_status', 'date_format(cmsth_initiateddate,"%d-%m-%Y") as cmsth_initiateddate_formatted', 'um_firstname'])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                    ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmstenderhdr_fk = cmstenderhdr_pk and cmsch_isdeleted = 2')
                    ->where('cmsth_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
                    ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                    ->andWhere('cmsth_type=:type', [':type' => $type])
                    ->asArray();
            if ($sortorder == 1) {
                $model->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")]);
            } else {
                $model->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) ASC")]);
            }

            $provider = new ActiveDataProvider([
                'query' => $model,
                'pagination' => ['pageSize' => $perpage, 'page' => $page]
            ]);

            foreach ($provider->getModels() as $value) {
                $data['rfx_pk'] = $value['cmstenderhdr_pk'];
                $can_terminate_arr =  self::canterminate($data); 
                $value['can_terminate'] = $can_terminate_arr;   
                $cancreatecheckarray = array('rfx_pk' => $value['cmstenderhdr_pk'], 'type' => $value['cmsth_type']);
                $can_create_enquiry = self::cancreaterfx($cancreatecheckarray);
                $value['can_create_enquiry'] = $can_create_enquiry;
                $deriverd_status = self::getrfxstatusvalue($value);
                $value['derived_status'] = $deriverd_status; 
                $finalData[] = $value;
            }

            return [
                'items' => $finalData,
                'total_count' => $provider->getTotalCount(),
                'limit' => $page,
            ]; 
    }

    public function getrfxdatafortendercount($tenPk) {
        $model = CmstenderhdrTbl::find()->select(['cmsth_type','count(*) as count'])
                    ->where('cmsth_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
                    ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                    ->groupBy(['cmsth_type'])
                    ->asArray()
                    ->All(); 
        return $model;
    }

    public function getrfidata($tenPk, $type) {
        $model = CmstenderhdrTbl::find()->
                        select(['*', 'date_format(cmsth_initiateddate,"%Y-%m-%d") as cmsth_initiateddate_formatted', 'um_firstname'])
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->where('cmstenderhdr_pk=:pk', [':pk' => $tenPk])
                        ->andWhere('cmsth_type=:type', [':type' => $type])
                        ->asArray()->All();
        $addinfo_model = CmsaddinfodtlsTbl::find()->select(['cmsaddinfodtls_pk as addinfopk', 'caid_title as question', 'caid_description as answer'])->where('caid_cmstenderhdr_fk=:pk', [':pk' => $tenPk])->asArray()->All();
        $return['tenderhdr'] = $model;
        $return['addinfo'] = $addinfo_model;
        return $return;
    }

    public function mapreqproduct($data, $tenPk) {
        if ($data) {

            $prodspecdtls = CmstenderhdrTbl::deleteAll(['=', 'ctpsm_cmstenderhdr_fk', $tenPk]);
            foreach ($data['mapProduct'] as $key => $value) {
                $model = new CmstenderhdrTbl();

                $model->ctpsm_cmstenderhdr_fk = $tenPk;
                $model->ctpsm_cmsrqprodservdtls_fk = $value['prodserdtl_fk'];
                $model->ctpsm_quantity = $value['quantity'];

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Requistion Mapping Successful!',
                        'moduleData' => $model,
                    );
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
        return $result;
    }

    public static function getRFIListData($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $reqPk = $data['reqPk'];
        $query = CmstenderhdrTbl::find()
                ->select(['cmsth_title', 'cmsth_cmsrequisitionformdtls_fk', 'cmstenderhdr_pk', 'cmsth_uid', 'cmsth_refno', 'um_firstname', 'UM_EmpId', 'cmsth_skdstartdate', 'cmsth_skdclosedate', 'cmsth_contact_usermst_fk'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                 ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $reqPk))
                ->andWhere('cmsth_type=:type', array(':type' => 1))
                ->andFilterWhere(['like', 'cmsth_title', $searchTxt])
                ->orFilterWhere(['like', 'cmsth_uid', $searchTxt])
                ->orFilterWhere(['like', 'cmsth_refno', $searchTxt])
                ->asArray();

            $countquery = CmstenderhdrTbl::find()
                ->select(['cmsth_type as type','count(*) as count'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $reqPk))
                ->andWhere(['IN', 'cmsth_tenderstatus' , [2,3]])
                ->groupBy(['cmsth_type'])
                ->asArray()->all();                 
        if ($sortpk == 1) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) ASC")]);
        } else {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")]);
        }
        $page = (!empty($size)) ? $size : 2;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);

        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['contactUserlist'] = '';
            if ($listData['cmsth_contact_usermst_fk'] != NULL && !empty($listData['cmsth_contact_usermst_fk'])) {
                $listData['contactUserlist'] = \common\models\UsermstTblQuery::getUserlistData($listData['cmsth_contact_usermst_fk']);
            } else {
                $listData['contactUserlist'] = null;
            }
            $finalData[] = $listData;
        }
        return [
            'items' => $finalData,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'active_count' => $countquery
        ];
    }

    public static function getEOIListData($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $reqPk = $data['reqPk'];
        $query = CmstenderhdrTbl::find()
                ->select(['cmsth_title', 'cmsth_cmsrequisitionformdtls_fk', 'cmstenderhdr_pk', 'cmsth_uid', 'cmsth_refno', 'um_firstname', 'UM_EmpId', 'cmsth_skdstartdate', 'cmsth_skdclosedate', 'cmsth_scopeofwork', 'cmsth_contact_usermst_fk'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $reqPk))
                ->andWhere('cmsth_type=:type', array(':type' => 2))
                ->andFilterWhere(['like', 'cmsth_title', $searchTxt])
                ->orFilterWhere(['like', 'cmsth_uid', $searchTxt])
                ->orFilterWhere(['like', 'cmsth_refno', $searchTxt])
                ->asArray();
            $countquery = CmstenderhdrTbl::find()
                ->select(['cmsth_title', 'cmsth_cmsrequisitionformdtls_fk', 'cmstenderhdr_pk', 'cmsth_uid', 'cmsth_refno', 'um_firstname', 'UM_EmpId', 'cmsth_skdstartdate', 'cmsth_skdclosedate', 'cmsth_contact_usermst_fk'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                 ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $reqPk))
                ->andWhere('cmsth_type=:type', array(':type' => 2))
                ->andWhere(['IN', 'cmsth_tenderstatus' , [2,3]])
                ->count();  
        if ($sortpk == 1) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) ASC")]);
        } else {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")]);
        }
        $page = (!empty($size)) ? $size : 2;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['contactUserlist'] = '';
            if ($listData['cmsth_contact_usermst_fk'] != NULL && !empty($listData['cmsth_contact_usermst_fk'])) {
                $listData['contactUserlist'] = \common\models\UsermstTblQuery::getUserlistData($listData['cmsth_contact_usermst_fk']);
            } else {
                $listData['contactUserlist'] = null;
            }
            $finalData[] = $listData;
        }
        return [
            'items' => $finalData,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'active_count' => $countquery
        ];
    }

    public function getbuyerrfx($regpk, $size, $search, $status, $subcont, $noticetype, $startdate, $enddate, $sort) {
        $query = CmstenderhdrTbl::find()
                ->select(['cmsth_refno as refno', 'cmsth_title as title', 'DATE_FORMAT(cmsth_skdclosedate, "%d-%m-%Y %h:%i %p") as closingdate',
                    'CASE 
            WHEN `cmsth_tenderstatus`= 1 THEN "Yet to Submit"  
              WHEN `cmsth_tenderstatus` = 2 THEN "Submitted" 
            WHEN `cmsth_tenderstatus`=  3  THEN "Shortlisted" 
            WHEN `cmsth_tenderstatus`= 4   THEN "Rejected" 
            WHEN `cmsth_tenderstatus`= 5   THEN "Awarded" 
            WHEN `cmsth_tenderstatus`= 6   THEN "Terminated" 
            WHEN `cmsth_tenderstatus`= 7   THEN "Closed" END as  rfxsts',
                    'CASE 
            WHEN `cmsth_type`= 1 THEN "RFI"  
              WHEN `cmsth_type` = 2 THEN "EOI" 
            WHEN `cmsth_type`=  3  THEN "RFP" 
            WHEN `cmsth_type`= 4   THEN "RFQ" END as  noticetype',
                    "if(cmsth_isicv = 1,'Y','N') as icvstst",
                    "if(cmsth_issubcontrqmt = 1,'Y','N') as subcont"
                ])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('MCM_MemberRegMst_Fk =:regpk', [':regpk' => $regpk])
                ->andWhere(['OR',
            ['LIKE', 'lower(cmsth_refno)', $search],
            ['LIKE', 'lower(cmsth_title)', $search]]);
        if ($sort == 1) {
            $query->orderBy(['cmstenderhdr_pk' => SORT_DESC]);
        } else {
            $query->orderBy(['cmstenderhdr_pk' => SORT_ASC]);
        }
        if (!empty($status)) {
            $query->andWhere("cmsth_tenderstatus in ($status)");
        }
        if (!empty($subcont)) {
            $query->andWhere("cmsth_issubcontrqmt in ($subcont)");
        }
        if (!empty($noticetype)) {
            $query->andWhere("cmsth_type in ($noticetype)");
        }
        if (!empty($startdate) && !empty($enddate)) {
            if ($startdate == $enddate) {
                $query->andWhere("date_format(cmsth_skdclosedate,'%Y%m%d') = :startdate", [':startdate' => $startdate]);
            } else {
                $query->andWhere("date_format(cmsth_skdclosedate,'%Y%m%d')  between :startdate and :enddate", [':startdate' => $startdate, ':enddate' => $enddate]);
            }
        } elseif (!empty($startdate)) {
            $query->andWhere("date_format(cmsth_skdclosedate,'%Y%m%d') >= :startdate", [':startdate' => $startdate]);
        } elseif (!empty($enddate)) {
            $query->andWhere("date_format(cmsth_skdclosedate,'%Y%m%d')  <=  :enddate", [':enddate' => $enddate]);
        }
        $query->asArray();
        $page = (!empty($size)) ? $size : 10;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $page]
        ]);
        $result = $provider->getModels();
        $data['predata'] = $result;
        $data['cnt'] = count($result);
        $overallcont = CmstenderhdrTbl::find()
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->where('MCM_MemberRegMst_Fk =:regpk', [':regpk' => $regpk])->count();
        $data['overall'] = $overallcont;
        return $data;
    }

    public function getRFTData($reqPk,$dataType) {
        $model = CmstenderhdrTbl::find()
                ->select(['cmstenderhdr_pk', 'cmsth_title', 'cmsth_uid', 'cmsth_refno','cmsth_createdon','cmsth_initiateddate','um_firstname','UM_EmpId'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                ->where('cmsth_cmsrequisitionformdtls_fk=:reqPk', array(':reqPk' => $reqPk))
                ->andFilterWhere(['IN', 'cmsth_type', explode(',', $dataType)])
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function getRFTDataArray($reqPk) {
        $model = CmstenderhdrTbl::find()
                ->select(['cmstenderhdr_pk', 'cmsth_title', 'cmsth_uid', 'cmsth_refno'])
                ->where('cmsth_cmsrequisitionformdtls_fk=:reqPk and cmsth_type = 4', array(':reqPk' => $reqPk))
                ->asArray()
                ->one();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function addrfxdetails($data) {
        if (!empty($data)) { 
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $rfxdata = $data['rfxval'];  
            $republish = false; 
            
            $rfxtender_pk = Security::decrypt($rfxdata['rfxtender_pk']);
            $rfxtender_type = $rfxdata['rfxtender_type'];
            $cancreatecheckarray = array('rfx_pk' => $rfxtender_pk, 'type' => $rfxtender_type);
            $can_create_enquiry = self::cancreaterfx($cancreatecheckarray);
            $checkvariable = self::ENQURY_TYPE_CAN_CREATE_VAR[$rfxtender_type];

            if ($rfxdata['rfx_pk'] != null) {
                $model = CmstenderhdrTbl::find()->where("cmstenderhdr_pk =:pk", [':pk' => $rfxdata['rfx_pk']])->one();
                if($model->cmsth_tenderstatus != 6 && $model->cmsth_contracthdr_fk == null) {
                    $model->cmsth_updatedon = $date;
                    $model->cmsth_updatedby = $userPK;
                    $model->cmsth_updatedbyipaddr = $ip_address;
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => "You can't edit this etender",
                        'returndata' => null
                    ); 
                }
            } else {
                if($can_create_enquiry[$checkvariable]) {
                    $model = new CmstenderhdrTbl();               
                    $model->cmsth_uid = Common::getUniqueId($rfxdata['rfxtender_type_val']);
                    $model->cmsth_tenderstatus = 1;
                    $model->cmsth_cmstenderhdr_fk = $rfxdata['reference_enquriy'];   
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => "You can't create etender while another etender is active",
                        'returndata' => null
                    );
                }
            }

            $remainderval = $rfxdata['isreminder'] ? 1 : 0;

            if ($rfxdata['card_type'] == 'info') {
                $model->cmsth_memcompmst_fk = $company_id;
                $model->cmsth_title = $rfxdata['rfxcardtitle'];
                $model->cmsth_refno = $rfxdata['rfxcardrefno'];
                $model->cmsth_initiateddate = Common::convertDateTimeToServerTimezone($rfxdata['rfxinitiate_Date']);
                $model->cmsth_initiatedby = $rfxdata['rfx_initiateby'];
                $model->cmsth_type = $rfxdata['rfxtender_type'];
                $model->cmsth_cmsrequisitionformdtls_fk = Security::decrypt($rfxdata['rfxtender_pk']);

                if($rfxdata['rfxdisciplinepk'] == '' || $rfxdata['rfxdisciplinepk'] == null) {
                   $disciplinepk = \app\models\CmsdisciplinedtlsTblQuery::adddisciplinedtls($rfxdata['rfxdiscipline']);
                    if($disciplinepk['code'] == '202') {
                        return $result = array(
                            'status' => 202,
                            'msg' => 'failure',
                            'flag' => 'U',
                            'comments' => 'Discipline name duplicate error occurred',
                            'moduleData' => $model,
                        );
                    } else {
                        $model->cmsth_cmsdisciplinedtls_fk = $disciplinepk;
                    }
                } else {
                    $model->cmsth_cmsdisciplinedtls_fk = $rfxdata['rfxdisciplinepk'];
                }

            } else if($rfxdata['card_type'] == 'remainder') {
                $model->cmsth_setreminder = $remainderval;
                $model->cmsth_closeintvl = $rfxdata['aft_intervalcnt'];
                $model->cmsth_closeintvltype = $rfxdata['aft_interval'];
                $model->cmsth_openintvl = $rfxdata['req_intervalcnt'];
                $model->cmsth_openintvltype = $rfxdata['req_interval'];
            } else if ($rfxdata['card_type'] == 'scope') {
                $model->cmsth_shortdesc = $rfxdata['rfx_shortdesc'];
                $model->cmsth_statement = $rfxdata['requisi_state'];
                $model->cmsth_instruction = $rfxdata['rfx_instruct'];
                $model->cmsth_mineligibility = $rfxdata['rfx_mineligibility'];
                $model->cmsth_reqdate = Common::convertDateTimeToServerTimezone($rfxdata['required_Date']);
                $model->cmsth_reqincoterms = $rfxdata['incoterms'];
                $model->cmsth_portname = $rfxdata['portname'];

                if($rfxdata['rfxtender_type_val'] == 'RFT') {
                    $model->cmsth_csstartdate = Common::convertDateTimeToServerTimezone($rfxdata['startdate']);
                    $model->cmsth_csenddate = Common::convertDateTimeToServerTimezone($rfxdata['enddate']);
                }
                
            } else if ($rfxdata['card_type'] == 'communication') {
                $model->cmsth_contact_usermst_fk = $rfxdata['rfxcommunication'];
            } else if ($rfxdata['card_type'] == 'notify') {
                $model->cmsth_config_usermst_fk = $rfxdata['rfxnotify'];
            } else if ($rfxdata['card_type'] == 'subcontractrule') {
                $model->cmsth_issubcontrqmt = $rfxdata['subcontract'] ? 1 : 0;
                $model->cmsth_obligation = $rfxdata['rfp_classic'];
                $model->cmsth_msmepercent = $rfxdata['rfp_obligation'];
                $model->cmsth_lccpercent = $rfxdata['rfp_lccobligation'];
                $model->cmsth_obligationscope = $rfxdata['rfx_obligationscope'];
                $model->cmsth_isetendmandate = $rfxdata['etender'] ? 1 : 0;
            } elseif ($rfxdata['card_type'] == 'questionarie') {
                $model->cmsth_cmsquestionnaireform_fk = $rfxdata['questionairepk'];
            } elseif ($rfxdata['card_type'] == 'req_support_doc') {
                $model->crfd_remarks = $rfxdata['remark_disc'];
            } elseif ($rfxdata['card_type'] == 'icv') {
                if($rfxdata['icvsubmission']) {
                    $model->cmsth_icv_startyear = $rfxdata['startyearsicv'];
                    $model->cmsth_icv_startquarter = $rfxdata['startquarter'];
                    $model->cmsth_icv_endyear = $rfxdata['endyearsicv'];
                    $model->cmsth_icv_endquarter = $rfxdata['endquarter'];
                    $model->cmsth_isicv = $rfxdata['endquarter'] ? 1 : 2;
                }
            } elseif ($rfxdata['card_type'] == 'schedule') { 
                $model->cmsth_skdtype = $rfxdata['optonSelection'];
                $model->cmsth_skd_timezone_fk = $rfxdata['timeZone'];
                if($model->cmsth_skdclosedate){
                    $republish = true;
                } 
                $model->cmsth_skdstartdate = Common::convertDateTimeToServerTimezone($rfxdata['closingdate']);
                $model->cmsth_skdclosedate = Common::convertDateTimeToServerTimezone($rfxdata['submittedOn']);
                $model->cmsth_createdon = $date;
                $model->cmsth_createdbyipaddr = $ip_address;
            } elseif ($rfxdata['card_type'] == 'savedrft') {
                // $model->cmsth_tenderstatus = 1;      
            } elseif($rfxdata['card_type'] == 'additonaldoc') {
                $model->cmsth_attachlink = $rfxdata['attach_link'];
                $model->cmsth_attachclosedate = Common::convertDateTimeToServerTimezone($rfxdata['close_date']);
            } elseif($rfxdata['card_type'] == 'rfxaddinfo') {
                $transaction = Yii::$app->db->beginTransaction();
                foreach ($rfxdata['rfxadditionalinfo'] as $key => $value) {
                    if ($value['addinfopk']) {
                        $modeladdinfo = CmsaddinfodtlsTbl::find()->where("cmsaddinfodtls_pk =:pk", [':pk' => $value['addinfopk']])->one();
                        if (!empty($modeladdinfo->caid_createdon)) {
                            $modeladdinfo->caid_updatedon = $date;
                            $modeladdinfo->caid_updatedby = $userPK;
                            $modeladdinfo->caid_updatedbyipaddr = Common::getIpAddress();
                        }
                    } else {
                        $modeladdinfo = new CmsaddinfodtlsTbl();
                        $modeladdinfo->caid_createdon = $date;
                        $modeladdinfo->caid_createdby = $userPK;
                        $modeladdinfo->caid_createdbyipaddr = Common::getIpAddress();
                    }
                    $modeladdinfo->caid_cmstenderhdr_fk = $rfxdata['rfx_pk'];
                    $modeladdinfo->caid_title = $value['question'];
                    $modeladdinfo->caid_description = $value['answer'];
                    $modeladdinfo->caid_index = $key + 1;
                    $modeladdinfo->caid_status = 1;

                    if(!$modeladdinfo->save()) {
                        $result = array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $modeladdinfo->getErrors()
                        );
                        break;
                    } else {
                        $result = array(
                            'status' => true
                        ); 
                    }
                }

                if ($result['status']) {
                    $transaction->commit();
                    $all_addinfo_rfx = CmsaddinfodtlsTbl::find()
                        ->select(['cmsaddinfodtls_pk as addinfopk', 'caid_title as question', 'caid_description as answer'])
                        ->where("caid_cmstenderhdr_fk =:ten_fk", [':ten_fk' => $rfxdata['rfx_pk']])
                        ->asArray()
                        ->All();

                    return $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $rfxdata['rfxtender_type_val'] . ' Additional Info Created/Updated Successfully',
                        'moduleData' => $all_addinfo_rfx,
                    );
                } else {
                    $transaction->rollBack();
                    
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $modeladdinfo->getErrors()
                    );
                }
            } else if($rfxdata['card_type'] == 'configcontact') {
                $model->cmsth_contact_usermst_fk = $rfxdata['rfxcontact'];
            }
            
            if ($model->save() === TRUE) { 
                if($rfxdata['card_type'] == 'schedule'){
                    if(!empty($model->cmstendertargethdrTbls)){
                        foreach($model->cmstendertargethdrTbls as $target){
                            if(!empty($target->cmstthMemberregmstFk->user->UM_EmailID)){
                                $this->sendRfxPublishEmail($model, $target, $republish);
                            }
                        }
                    }
                }                
                if ($rfxdata['card_type'] == 'schedule') {
                    Rfx::saveTargettedSupplier($model->cmstenderhdr_pk,2);
                }
                if ($rfxdata['card_type'] == 'notify') {
                    $msg = "Notify user Updated Successfully";
                } else if ($rfxdata['card_type'] == 'communication') { 
                    $msg = "Communication Updated Successfully";
                } elseif($rfxdata['card_type'] == 'additonaldoc') {
                    $msg = "Additional Documents Updated Successfully";
                } elseif($rfxdata['card_type'] == 'configcontact') {
                    $msg = "Contact Updated Successfully";
                } else {
                    $msg = $rfxdata['rfxtender_type_val'] . ' Updated Successfully';
                }

                if ($rfxdata['rfx_pk']) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => $msg,
                        'moduleData' => $model,
                    );
                } else {
                    if ($rfxdata['card_type'] == 'notify') {
                        $msg = "Notify user Created Successfully";
                    } else if ($rfxdata['card_type'] == 'communication') { 
                        $msg = "Communication Created Successfully";
                    } elseif($rfxdata['card_type'] == 'additonaldoc') {
                        $msg = "Additional Documents Created Successfully";
                    } elseif($rfxdata['card_type'] == 'configcontact') {
                        $msg = "Contact Created Successfully";
                    } else {
                        $msg = $rfxdata['rfxtender_type_val'] . ' Created Successfully';
                    }

                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $msg,
                        'moduleData' => $model,
                    );
                    if ($rfxdata['rfx_pk']) {

                        if ($rfxdata['card_type'] == 'notify') {
                            $msg = "Notify user Updated Successfully";
                        } else if ($rfxdata['card_type'] == 'communication') { 
                            $msg = "Communication Updated Successfully";
                        } elseif($rfxdata['card_type'] == 'additonaldoc') {
                            $msg = "Additional Documents Updated Successfully";
                        } elseif($rfxdata['card_type'] == 'configcontact') {
                            $msg = "Contact Updated Successfully";
                        } else {
                            $msg = $rfxdata['rfxtender_type_val'] . ' Updated Successfully';
                        }

                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'U',
                            'comments' => $msg,
                            'moduleData' => $model,
                        );
                    } else {
                        if ($rfxdata['card_type'] == 'notify') {
                            $msg = "Notify user Created Successfully";
                        } else if ($rfxdata['card_type'] == 'communication') { 
                            $msg = "Communication Created Successfully";
                        } elseif($rfxdata['card_type'] == 'additonaldoc') {
                            $msg = "Additional Documents Created Successfully";
                        } elseif($rfxdata['card_type'] == 'configcontact') {
                            $msg = "Contact Created Successfully";
                        } else {
                            $msg = $rfxdata['rfxtender_type_val'] . ' Created Successfully';
                        }
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'S',
                            'comments' => $msg,
                            'moduleData' => $model,
                        );
                    } 
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }
	
    public static function getRfxList($data) {

        $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $size = Security::sanitizeInput($_REQUEST['size'], "number");
        $page = Security::sanitizeInput($_REQUEST['page'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $reqPk = $data['reqPk'];
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $reg_type = \yii\db\ActiveRecord::getTokenData('reg_type', true);

        //print_r($size);die();

        $query = CmstenderhdrTbl::find()
                ->select([
                    'cmsth_title', 
                    'cmsth_cmsrequisitionformdtls_fk', 
                    'cmstenderhdr_pk',
                    'cmsth_initiateddate',
                    'um_firstname',
                    'UM_EmpId',
                    'MCM_crnumber',
                    'MCM_SupplierCode',
                    'mrm_stkholdertypmst_fk',
                    'cmsth_skdstartdate',
                    'cmsth_skdclosedate',
                    'tz_utcoffset',
                    'cmsth_type',
                    'cmsth_uid',
                    'cmsth_refno',
                    'cmsth_isicv',
                    'cmsth_issubcontrqmt',
                    'cmsth_obligation',
                    'cmsth_msmepercent',
                    'cmsth_lccpercent',
                    'cmsth_isetendmandate',
                    'cmsth_tenderstatus',
                    'MCM_CompanyName',
                    'mcm_complogo_memcompfiledtlsfk',
                    'MemberCompMst_Pk'
                    ])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsth_initiatedby')
                ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_cmstenderhdr_fk = cmstenderhdr_pk and cmsqh_memcompmst_fk = '.$cmpPk)
                ->leftJoin('timezone_tbl', 'cmsth_skd_timezone_fk = timezone_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]]) // 1 - Yet to Publish, 6 - Terminated, 11 - Scheduled to Publish Later
                // ->rightJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk AND ctr_memcompmst_fk='.$cmpPk)
                ->andWhere("cmstenderhdr_pk is not null")
                ->andWhere("cmstth_targettype = 2") // Targetted from: 1 - Shortlisted/ Pre-qualified from previous enquiry, 2 - JSRS, 3 - Non-JSRS
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk)); // targetted supplier
        
                $refno = trim($data['refno']);
        if(empty($data['filter']['rfxtype']) && empty($data['filter']['obligation']) && empty($data['filter']['condition']) && empty($data['filter']['postedByForm']) && empty($data['filter']['publishStartDate']) && empty($data['filter']['publishEndDate']) && empty($data['filter']['closingStartDate']) && empty($data['filter']['closingEndDate']) && empty($data['filter']['submitstatus']) && empty($data['filter']['searchkey'])) {

            // $query->andWhere("cmsth_tenderstatus=2");
        
        } else {
            foreach($data['filter'] as $key=>$filterCriteria) {
            
                if($key=='rfxtype' && !empty($filterCriteria)){
                    $crit=implode($filterCriteria,",");
                    if(!empty($crit)){
                        $query->andWhere("cmsth_type in ($crit)");    
                    }
                }
                if($key=='obligation' && !empty($filterCriteria)){
                    $crit=implode($filterCriteria,",");
                    if(!empty($crit)){
                        $query->andWhere("cmsth_obligation in ($crit)");    
                    }
                }
                if($key=='condition' && !empty($filterCriteria)){
                    foreach($filterCriteria as $k=>$val){
                        if($val==1){//Subcontract Enabled
                            $query->andWhere("cmsth_issubcontrqmt=1");
                        }
                        if($val==2){//ICV Enabled
                            $query->andWhere("cmsth_isicv=1");
                        }
                        if($val==3){//e-Tendering Mandate 
                            $query->andWhere("cmsth_isetendmandate=1");
                        }
                    }
                }
                if($key=='postedByForm' && !empty($filterCriteria)){
                    $crit=implode($filterCriteria,",");
                    if(!empty($crit)){
                        $query->andWhere("cmsth_memcompmst_fk in ($crit)");    
                    }
                }
                if($key=='publishStartDate' && !empty($filterCriteria)){
                    $startDate = $filterCriteria; 
                }
                if($key=='publishEndDate' && !empty($filterCriteria)){
                    $endDate = $filterCriteria;
                }
                
                if($key=='closingStartDate' && !empty($filterCriteria)){
                    $closingStartDate = $filterCriteria;
                }
                if($key=='closingEndDate' && !empty($filterCriteria)){
                    $closingEndDate = $filterCriteria;
                }
    

                if($key=='submitstatus' && !empty($filterCriteria)){
                    //print_r($key);die();
                    $str = '';
                    if(in_array(9,$filterCriteria)) {
                        $str="(cmsquotationhdr_pk is not null and cmsqh_status = 1)";
                    }
                    $crit=implode($filterCriteria,",");
                    if(!empty($crit)){
                        if($str) {
                            $str = "(cmsth_tenderstatus in ($crit) or ".$str.")";
                        } else {
                            $str = "cmsth_tenderstatus in ($crit)";
                        }
                        $query->andWhere($str);    
                    }
                }
                
                if($key=='searchkey' && !empty($filterCriteria)){
                    $query->andFilterWhere([
                        'or',
                        ['like', 'cmsth_title', $filterCriteria],
                        ['like', 'cmsth_shortdesc', $filterCriteria]
                    ]); 
                }
            }
        }
        if($refno!='') {

            $query->andWhere("cmsth_refno='$refno'");
        }
        
        if(!empty($startDate) && !empty($endDate)) {

            $stDate = date("Y-m-d",strtotime($startDate))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($endDate))." 23:59:59";

            $query->andFilterWhere(['between', 'cmsth_initiateddate', $stDate, $edDate]);  
        }

        if(!empty($closingStartDate) && !empty($closingEndDate)) {

            $clStartDate = date("Y-m-d",strtotime($closingStartDate))." 00:00:00";
            $clEndDate = date("Y-m-d",strtotime($closingEndDate))." 23:59:59";;

            $query->andFilterWhere(['between', 'cmsth_skdclosedate', $clStartDate, $clEndDate]); 
        }

        if(!empty($data['search'])) {
            $query->andFilterWhere([
                'or',
                ['like', 'cmsth_title', $data['search']],
                ['like', 'cmsth_shortdesc', strip_tags($data['search'])]
            ]);  
        }
        $query=$query->asArray();

        $sort = ['cmstenderhdr_pk' => SORT_DESC];  
        if($sortpk == 1) {
            $sort = ['cmstenderhdr_pk' => SORT_DESC];  
        } elseif ($sortpk == 2) {
            $sort = ['cmstenderhdr_pk' => SORT_ASC];        
        } elseif ($sortpk == 3) {
            $sort = ['cmsth_title' => SORT_ASC];            
        } elseif ($sortpk == 4) {
            $sort = ['cmsth_title' => SORT_DESC];            
        }
                
        $size = (!empty($size)) ? $size : 10;
        $page = (!empty($page)) ? $page : 1;

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $sort
            ],
            'pagination' => ['pageSize' => $size]
        ]);

        // echo $query->createCommand()->getRawSql();die();
        // print_r($provider->getModels());die();

        $finalData = [];
        $tenderList=[];

        foreach ($provider->getModels() as $listData) {
            $listData['contactUserlist'] = '';
            $tenderList[]= $listData['cmstenderhdr_pk'];
            $finalData[] = $listData;
        }

        $rfxBas=[];
        $rfxBasic = CmstenderresponseTbl::find()
                    ->select('ctr_status as status, ctr_cmstenderhdr_fk as id')
                    ->where(['ctr_memcompmst_fk' => $cmpPk])
                    ->andWhere(['in','ctr_cmstenderhdr_fk',$tenderList])
                    ->asArray()
                    ->all();
        $rfxBas=ArrayHelper::index($rfxBasic, 'id');
        
        $rfxAdv=[];
        $rfxAdvanced=CmsquotationhdrTbl::find()
                    ->select('cmsquotationhdr_pk, cmsqh_status as status, cmsqh_cmstenderhdr_fk as id')
                    ->where([
                            'cmsqh_memcompmst_fk' => $cmpPk,
                            'cmsqh_isdeleted' => 2
                            ])
                    ->andWhere(['in','cmsqh_cmstenderhdr_fk',$tenderList])
                    ->asArray()
                    ->all();
        $rfxAdv=ArrayHelper::index($rfxAdvanced, 'id');
        
        $date = new \DateTime();
        $timeZone = $date->getTimezone();
        $timeZone->getName();
        foreach ($finalData as $key => $value){            
        $finalData[$key]['timeZoneTime'] = $value['cmsth_skdclosedate'] && $value['tz_utcoffset'] ? Common::convertTimezone($value['cmsth_skdclosedate'], $value['tz_utcoffset'], $timeZone->getName()) : $value['cmsth_skdclosedate'];
            $tenderPk=$value['cmstenderhdr_pk'];
            if($finalData[$key]['cmsth_tenderstatus'] == 6) {
                $finalData[$key]['cmsth_tenderstatus'] = 7;
            } elseif (date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($finalData[$key]['cmsth_skdclosedate'].$finalData[$key]['tz_utcoffset']))) {
                $finalData[$key]['cmsth_tenderstatus'] = 8;
            } elseif($rfxBas[$tenderPk]){
                $finalData[$key]['cmsth_tenderstatus']=$rfxBas[$tenderPk]['status'];
            }
            elseif($rfxAdv[$tenderPk] && $rfxAdv[$tenderPk]['cmsquotationhdr_pk']){
                $finalData[$key]['cmsth_tenderstatus'] = 9;
            }
            else{
                $finalData[$key]['cmsth_tenderstatus']="1";
            }   
        }

        $filterOpts = [];
        // $filterOpts['rfx'] = $provider->query->select('GROUP_CONCAT(DISTINCT cmsth_type) AS type')->one()['type'];
        // $filterOpts['obligation'] = $provider->query->select('GROUP_CONCAT(DISTINCT cmsth_obligation) AS obligation')->one()['obligation'];
        $filterOpts['comppk'] = $provider->query->select('GROUP_CONCAT(DISTINCT MemberCompMst_Pk) AS comppk')->one()['comppk'];
        $filterOpts['max_closedate'] = $provider->query->select('max(cmsth_skdclosedate) max_closedate')->one()['max_closedate'];
        $filterOpts['max_closedate'] = date('Y-m-d', strtotime($filterOpts['max_closedate']));

        return [
            'msg' => "success",
            'status' => 1,
            'items' => $finalData,
            'filterOpts' => $filterOpts,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public function getFilterDynamicData($data) {
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
		$buyerQuery = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [7]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
                ->asArray()
                ->all();
				
		$buyerQueryCount = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk',
					'count(cmstenderhdr_pk) total'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [7]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
                ->asArray()
                ->one();
		$moduleData=[];
		$moduleData['Buyers']=$buyerQuery;
		$moduleData['Buyerstotal']=$buyerQueryCount['total'];
		
		$ogSupplierQuery = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [6]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
				->andWhere("mrm_industrytype=1")
                ->asArray()
                ->all();
		
		$ogSupplierQueryCount = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk',
					'count(cmstenderhdr_pk) total'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [6]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
				->andWhere("mrm_industrytype=1")
                ->asArray()
                ->one();
				
		$moduleData['OGSuppliers']=$ogSupplierQuery;
		$moduleData['OGSupplierstotal']=$ogSupplierQueryCount['total'];
		
		$ogSupplierQuery = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [6]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
				->andWhere("mrm_industrytype=2 OR mrm_industrytype is null")
                ->asArray()
                ->all();
		
		$ogSupplierQueryCount = CmstenderhdrTbl::find()
                ->select([
                    'shm_stakeholdertype type',
					'MCM_CompanyName company',
					'MemberCompMst_Pk pk',
					'count(cmstenderhdr_pk) total'
                    ])->distinct()
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                ->where(['stkholdertypmst_pk'=> [6]])
                ->andWhere(["IS NOT", "cmsth_tenderstatus", null])
                ->andWhere(["NOT IN", "cmsth_tenderstatus", [1, 11]])
                ->andWhere("cmstth_targettype = 2")
                ->andWhere("cmstth_memberregmst_fk = :regpk",  array('regpk' => $regPk))
				->andWhere("mrm_industrytype=2 OR mrm_industrytype is null")
                ->asArray()
                ->one();
				
		$moduleData['OtherSuppliers']=$ogSupplierQuery;
		$moduleData['OtherSupplierstotal']=$ogSupplierQueryCount['total'];
		
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $query,
			'countData'=>$moduleData
        );
        return $result;
    }

    public function getOveralldataStatus($rfx_pk) {
        $tender = CmstenderhdrTbl::findOne($rfx_pk);
        $overall_status = [];
        $rfxterms_values_count = 0;
        if($tender) {

            if(!empty($tender->cmstnctrnxs)) {
                foreach($tender->cmstnctrnxs as $term) {                
                    $files = [];
                    if(!$term->ctnct_content &&  !$term->ctnctUploads) {
                        $rfxterms_values_count++;
                    }
                }
            }
            $overall_status['additional_info'] = count($tender->cmsaddinfodtlsTbls);
            $overall_status['supporting_count'] = count($tender->supportingDocuments);
            $overall_status['questionariedetails'] = $tender->cmsth_cmsquestionnaireform_fk;
            $overall_status['rfxterms_values'] = $tender->cmstnctrnxs;
            $overall_status['rfxconfiguration_values'] = array(
                'reminder' => $tender->cmsth_setreminder,
                'reminder_openintvl' => $tender->cmsth_openintvl,
                'notifyUsers' => $tender->configUsers,
                'contactUsers' => count(array_filter(explode(',',$tender->cmsth_contact_usermst_fk))),
                'cmissubcontrqmt' => $tender->cmsth_issubcontrqmt,
                'subcontract_obligation' => $tender->cmsth_obligation,
                'isicv' => $tender->cmsth_isicv,
                'icv_startyear' => $tender->cmsth_icv_startyear,
                'targeted_supplier' => $tender->cmstendertargethdrTbls ? [
                    'shortlisted' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 1])->count(),
                    'jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 2])->count(),
                    'non_jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 3])->count()
                ] : null
            );
            $overall_status['rfxcommunication_values'] = $tender->cmsth_contact_usermst_fk;
            $overall_status['rfxadditional_documents'] = count($tender->additionalDocuments);
            return $overall_status;
        } 
    }
    
    /**
     * Get RFX Details and Scope
     */
    public function getRFXDetails($rfx_pk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $data = $products = $files = $doc_list = $inspection_list = $sdterm = [];
        $quotationstatus = 1;
        $date = new \DateTime();
        $timeZone = $date->getTimezone();
        $data = CmstenderhdrTbl::find()
                ->select([
                    'cmsth_contact_usermst_fk contactuser_pks',
                    'cmsth_cmstenderhdr_fk reference_enquriy',
                    'cmsth_type type',
                    'cmsth_uid uid',
                    'cmsth_refno ref',
                    'cmsth_remarks document_remarks',
                    'cmsth_attachlink attachlink',
                    'cmsth_attachclosedate attachclosedate',
                    'cmsth_initiateddate initiated_on',
                    'cmsth_title name',
                    'cmsth_cmsrequisitionformdtls_fk requisition_fk',
                    'cmsth_cmsquestionnaireform_fk questionnaire_id',
                    'cmsth_skdstartdate start_date',
                    'cmsth_cmsdisciplinedtls_fk discipline_pk',
                    'cmsth_shortdesc description',
                    'cmsth_statement statement',
                    'cmsth_obligation obligation',
                    'cmsth_msmepercent msmepercent',
                    'cmsth_lccpercent lccpercent',
                    'cmsth_isetendmandate eTendering',
                    'cmsth_issubcontrqmt sub_contracting',
                    'cmsth_isicv is_icv',
                    'prjd_projimg_fk projimg_fk',
                    'cmsth_icv_startyear icv_start_year',
                    'cmsth_icv_startquarter icv_startquarter',
                    'cmsth_icv_endyear icv_end_year',
                    'cmsth_icv_endquarter icv_endendquarter',
                    'cmsth_instruction instruction',
                    'cmsth_mineligibility min_eligibility',
                    'cmsth_specdrawing spec_drawing',
                    'cmsth_reqdate reqdate',
                    'cmsth_reqincoterms reqincoterms',
                    'cmsth_portname portname',
                    'cmsth_csstartdate csstartdate',
                    'cmsth_csenddate csenddate',
                    'cmsth_tenderstatus tender_status',
                    'cmsth_createdon createdon',
                    'cmsth_initiatedby initiated_by',
                    'CONCAT(cmsth_skdclosedate, tz_utcoffset) close_date',
                    'cmsdd_name discipline_name',
                    'CurM_CurrencyName_en required_currency',
                    'JSON_OBJECT("id",crfd_rqid,"ref",crfd_rqrefno,"title",crfd_rqtitle,"process_type",crfd_rqprocesstype,"type",crfd_rqtype,"date",crfd_rqdate,"priority",crfd_rqpriority,"status",crfd_rqstatus,"isblanketrq",crfd_isblanketrq) tender_notice',
                    'JSON_OBJECT("id",prjd_projectid,"ref",prjd_referenceno,"title",prjd_projname,"status",prjd_projstatus) project',
                    'cmsth_contracthdr_fk',
                    'JSON_OBJECT("id",cmsch_uid,"ref",cmsch_contractrefno,"title",cmsch_contracttitle) contract',
                    'cmsth_skdclosedate',
                    'tz_utcoffset',
                    'JSON_OBJECT("company",MCM_CompanyName,"logo_id",memcompfiledtls_pk,"company_id",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) publish_by',
                    'cmsth_cmstenderhdr_fk',
                    'cmsqf_formname',
                    'cmsqf_buildertemplate',
                    'cmsqft_answer'
                ]) 
                ->where(['cmstenderhdr_pk' => $rfx_pk])
                ->leftJoin('timezone_tbl', 'cmsth_skd_timezone_fk = timezone_pk')                
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk = mcm_complogo_memcompfiledtlsfk')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsth_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk')
                ->leftJoin('projectdtls_tbl', 'crfd_projectdtls_fk = projectdtls_pk')
                ->leftJoin('cmscontracthdr_tbl', 'cmsth_contracthdr_fk = cmscontracthdr_pk')
                ->leftJoin('cmsdisciplinedtls_tbl', 'cmsth_cmsdisciplinedtls_fk = cmsdisciplinedtls_pk')
                ->leftJoin('currencymst_tbl', 'cmsth_currencymst_fk = CurrencyMst_Pk')
                ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsth_cmsquestionnaireform_fk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_cmsquestionnaireform_fk = cmsth_cmsquestionnaireform_fk')
                ->asArray()
                ->one();      
        $data['currenttimezone_close_date'] = date('d-m-Y h:m A',strtotime(Common::convertTimezone($data['cmsth_skdclosedate'],$data['tz_utcoffset'], $timeZone->getName())));
        $initiated_by = UsermstTbl::find()
                ->select([
                    'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                    'UM_EmpId empID',
                    'UserMst_Pk userpk',
                    'CONCAT(um_firstname, " - ", UM_EmpId) dropdownName',
                    'dsg_designationname dropdownDesignation'
                ])
                ->leftJoin('designationmst_tbl', 'UM_Designation = designationmst_pk')
                ->where(['UserMst_Pk' => $data['initiated_by']])
                ->asArray()
                ->one();
        $data['initiated_by'] = $initiated_by;
        
        $data['publish_by'] = json_decode($data['publish_by'], true);
        $data['publish_by']['img'] = Drive::generateUrl($data['publish_by']['logo_id'], $data['publish_by']['company_id'], $data['publish_by']['uploadedby']);

        $previous_enquiry = CmstenderhdrTbl::find()
                ->select([
                    'cmsth_uid uid',
                    'cmsth_refno ref',
                    'cmsth_title title',
                    'cmsth_type type',
                    'cmsth_tenderstatus status',
                ])
                ->where(['cmstenderhdr_pk' => $data['cmsth_cmstenderhdr_fk']])
                ->asArray()
                ->one();
        $data['previous_enquiry'] = $previous_enquiry['uid'] ? $previous_enquiry : null;

        $sdtermQ = CmstnctrnxTbl::find()
                ->select([
                    'cmstnctrnx_pk',
                    'ctnct_title',
                    'ctnct_content',
                    'ctnct_content',
                    'memcompfiledtls_pk',
                    'mcfd_origfilename',
                    'mcfd_memcompmst_fk',
                    'mcfd_uploadedby',
                    'mcfd_filetype',
                    'DATE(mcfd_uploadedon) date',
                    'mcfd_actualfilesize'
                ])
                ->leftJoin('memcompfiledtls_tbl', 'ctnct_upload = memcompfiledtls_pk')
                ->where(['ctnct_shared_fk' => $rfx_pk, 'ctnct_type' => 2, 'ctnct_cmstnchdr_fk' => 8])
                ->asArray()
                ->all();
        foreach($sdtermQ as $key => $val) {
            if(empty($sdterm[$val['cmstnctrnx_pk']]['files'])) {
                $sdterm[$val['cmstnctrnx_pk']]['files'] = [];
            }
            $sdterm[$val['cmstnctrnx_pk']]['title'] = $val['ctnct_title'];
            $sdterm[$val['cmstnctrnx_pk']]['content'] = $val['ctnct_content'];
            if($val['memcompfiledtls_pk']) {
                $sdterm[$val['cmstnctrnx_pk']]['files'][] = [
                    'name' => $val['mcfd_origfilename'],
                    'src' => Drive::generateUrl($val['memcompfiledtls_pk'], $val['mcfd_memcompmst_fk'], $val['mcfd_uploadedby']),
                    'type' => $val['mcfd_filetype'],
                    'upload_on' => $val['date'],
                    'size' => $val['mcfd_actualfilesize']
                ];
            }
        }
        $data['sdterm'] = $sdterm ? array_values($sdterm) : null;
        $data['tender_notice'] = json_decode($data['tender_notice'], true);
        $data['project'] = json_decode($data['project'], true);
        $data['contract'] = $data['cmsth_contracthdr_fk'] ? json_decode($data['contract'], true) : null;

        $supp_doc_req = CmssuppdocreqlisthdrTbl::find()
                ->select([
                    'csdrlh_sdrlrefno ref_no',
                    'csdrlh_sdrldate date',
                    'um_firstname issued_by',
                    'cmssuppdocreqlisthdr_pk list'
                ])
                ->leftJoin('usermst_tbl', 'csdrlh_createdby = UserMst_Pk')
                ->where(['csdrlh_shared_fk' => $rfx_pk, 'csdrlh_shared_type' => 2])
                ->asArray()
                ->one();
        $data['supp_doc_req'] = $supp_doc_req;

        if($data['supp_doc_req']['list']) {
            $supp_doc_req_list = CmssuppdocreqlistdtlsTbl::find()
                    ->select([
                        'csdrld_reviewclass review_class',
                        'csdrld_createdon date',
                        'csdrldc_doccode doc_code',
                        'csdrldc_docdesc doc_description'
                    ])
                    ->leftJoin('cmssdrldoccat_tbl', 'csdrld_cmssdrldoccat_fk = cmssdrldoccat_pk')
                    ->where(['csdrld_cmssuppdocreqlisthdr_fk' => $data['supp_doc_req']['list']])
                    ->asArray()
                    ->all();
            $data['supp_doc_req']['list'] = $supp_doc_req_list;
        }

        $inspection_doc = CmsinspreqdochdrTbl::find()
                ->select([
                    'cirdh_itprefno ref_no',
                    'cirdh_itpdate date',
                    'cirdh_technote tech_note',
                    'cirdh_generalnote general_note',
                    'cirdh_applspec applicable_spec',
                    'um_firstname issued_by',
                    'cmsinspreqdochdr_pk list'
                ])
                ->leftJoin('usermst_tbl', 'cirdh_createdby = UserMst_Pk')
                ->where(['cirdh_shared_fk' => $rfx_pk, 'cirdh_shared_type' => 2])
                ->asArray()
                ->one();
        $data['inspection_doc'] = $inspection_doc;

        if($data['inspection_doc']['list']) {
            $inspection_doc_list = CmsinspreqdocdtlsTbl::find()
                    ->select([
                        'cirdd_activitytitle title',
                        'cirdd_activityno activity_no',
                        'cirdd_refdoc ref_doc',
                        'cirdd_remarks remarks',
                        'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("name",IFNULL(MCM_CompanyName, cirdam_quancheckname),"action",cirdam_actions)),"]") entity'
                    ])
                    ->leftJoin('cmsinspreqdocactionmap_tbl', 'cmsinspreqdocdtls_pk = cirdam_cmsinspreqdocdtls_fk')
                    ->leftJoin('membercompanymst_tbl', 'cirdam_quancheck_mcm_fk = MemberCompMst_Pk')
                    ->where(['cirdam_cmsinspreqdocdtls_fk' => $data['inspection_doc']['list']])
                    ->groupBy('cmsinspreqdocdtls_pk')
                    ->asArray()
                    ->all();
            $data['inspection_doc']['list'] = array_map(function($v) { 
                $v['entity'] = json_decode($v['entity'], true);
                return $v;
            }, $inspection_doc_list);
        }

        $submitted_by = $submitted_on = $tenderResponsePK = null;
        $tenderResponse = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $rfx_pk, 'ctr_memcompmst_fk' => $compPK])->one();
        $quotationstatus = $tenderResponse ? $tenderResponse->ctr_status : $quotationstatus;
        if($tenderResponse) {
            $submitted_by = $tenderResponse->cmsqftCreatedby->um_firstname;
            $submitted_on = $tenderResponse->ctr_createdon;
            $tenderResponsePK = $tenderResponse->cmstenderresponse_pk;
        }
        if(in_array($data['type'], [4, 5, 6])) {
            $quotation = CmsquotationhdrTbl::find()->where(['cmsqh_cmstenderhdr_fk' => $rfx_pk,'cmsqh_isdeleted' =>2,'cmsqh_memcompmst_fk'=>$compPK])->one();
            $submitted_by = $quotation->cmsqhCreatedby->um_firstname ? $quotation->cmsqhCreatedby->um_firstname : null;
            $submitted_on = $quotation->cmsqh_createdon ? $quotation->cmsqh_createdon : null;
            $quotationPK = $quotation->cmsquotationhdr_pk ? $quotation->cmsquotationhdr_pk : null;
        }
            
        $additonal_info_data = \api\modules\pms\models\CmsaddinfodtlsTblQuery::GetAddInfoData($rfx_pk);

        $data['is_time_over'] = $data['cmsth_skdclosedate'] ? date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) . ' ' . $data['tz_utcoffset']) > $data['cmsth_skdclosedate'] : false;
        if($data['projimg_fk'] != null){
            $file = MemcompfiledtlsTbl::findOne($data['projimg_fk']);
            $projectimage = $file ? Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby) : 'assets/images/lypis_noimg.svg';
            $data['projectImage'] = $projectimage;
        }  else {            
            $data['projectImage'] = 'assets/images/lypis_noimg.svg';
        }
        $date = new \DateTime();
        $timeZone = $date->getTimezone();
        $timeZone->getName();
        $data['timeZoneTime'] = $data['cmsth_skdclosedate'] && $data['tz_utcoffset'] ? Common::convertTimezone($data['cmsth_skdclosedate'], $data['tz_utcoffset'], $timeZone->getName()) : $data['cmsth_skdclosedate'];
        $data['quotationstatus'] = $quotationstatus;
        $data['submitted_by'] = $submitted_by;
        $data['submitted_on'] = $submitted_on;
        $data['quotationPK'] = $quotationPK;
        $data['tenderResponsePK'] = $tenderResponsePK;
        $data['additonalinfo'] = $additonal_info_data;
        $data['msmepercent'] = (float)$data['msmepercent'];
        $data['lccpercent'] = (float)$data['lccpercent'];
                    
        return $data;
    }
    
    /**
     * Get RFX Supporting Document
     */
    public function getRFXSupportingDoc($rfx_pk) {
        $data = $docs = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);
        if(!empty($tender->supportingDocuments)) {
            foreach($tender->supportingDocuments as $doc) { 
                $docs[] = [
                    'name' => $doc->cmssd_docname,
                    'file' => $doc->cmssdUpload ? [
                        'name' => Drive::getFileName(Security::encrypt($doc->cmssdUpload->memcompfiledtls_pk)),
                        'src' => Drive::generateUrl($doc->cmssdUpload->memcompfiledtls_pk, $doc->cmssdUpload->mcfd_memcompmst_fk, $doc->cmssdUpload->mcfd_uploadedby),
                        'type' => $doc->cmssdUpload->mcfd_filetype,
                        'upload_on' => $doc->cmssdUpload->mcfd_uploadedon,
                        'size' => $doc->cmssdUpload->mcfd_actualfilesize
                    ] : null
                ];
            }
        }

        $data = [
            'remarks' => $tender->cmsth_remarks,
            'supporting_docs' => $docs
        ];

        return $data;
    }
    
    /**
     * Get RFX Questionnaire Form
     */
    public function getRFXQuestionnaireForm($pk) {
        $questionnaire = CmsquestionnaireformTbl::findOne($pk);
        
        $data = [
            'name' => $questionnaire->cmsqf_formname,
            // 'nameheader' => $questionnaire->cmsqf_formnameheight,
            'description' => $questionnaire->cmsqf_formdesc,
            // 'descriptionheader' =>  $questionnaire->cmsqf_formdescheight,
            'created_on' => $questionnaire->cmsqf_createdon,
            'builder_template' => $questionnaire->cmsqf_buildertemplate,
            'builder_template_count' => count($questionnaire->cmsqf_buildertemplate)
        ];

        return $data;
    }

    /**
     * Get RFX Questionnaire Form answer
     */
    public function getRFXQuestionnaireFormAnswer($qpk, $rfxid, $type) {
        $questionnaire = CmsquestionnaireformtrnxTbl::find()
            ->select(['cmsqft_answer'])
            ->where(['cmsqft_cmsquestionnaireform_fk' => $qpk])
            ->andWhere(['cmsqft_shared_fk' => $rfxid])
            ->andWhere(['cmsqft_shared_type' => $type])
            ->all();
        
        $data = [
            'ques_answer' => $questionnaire[0]['cmsqft_answer'],
        ];

        return $data;
    }
    
    /**
     * Save RFX Questionnaire Form
     */
    public function saveRFXQuestionnaireForm($rfx_pk, $data) {
        $tender = CmstenderhdrTbl::findOne($rfx_pk);

        if($tender->cmsth_skdclosedate ? date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) . ' ' . $tender->cmsthSkdTimezoneFk->tz_utcoffset) > $tender->cmsth_skdclosedate : false) {
            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => 'Time is Over',
                'is_time_over' => true
            );
        }

        if($tender->cmsthCmsquestionnaireformFk && $data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            $model = CmsquestionnaireformtrnxTbl::find()
                ->where(['=', 'cmsqft_shared_fk', $rfx_pk])
                ->andWhere(['=', 'cmsqft_shared_type', 2])
                ->one();

            if(!$model) {
                $model = new CmsquestionnaireformtrnxTbl();
            }
            
            $model->cmsqft_cmsquestionnaireform_fk = $tender->cmsth_cmsquestionnaireform_fk;
            $model->cmsqft_memcompmst_fk = $company_id;
            $model->cmsqft_shared_fk = $rfx_pk;
            $model->cmsqft_shared_type = 2;
            $model->cmsqft_answer = $data;
            $model->cmsqft_createdon = $date;
            $model->cmsqft_createdby = $userPK;
            $model->cmsqft_createdbyipaddr = $ip_address;
            $saveResponse = $model->save();
            $response = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $data['rfx_pk'], 'ctr_createdby' => $userPK])->one();
            if($saveResponse && in_array($tender->cmsth_type , [1,3])) {
                if(!$response) {
                    $response = new CmstenderresponseTbl();
                    $response->ctr_createdon = $date;
                    $response->ctr_createdby = $userPK;
                    $response->ctr_createdbyipaddr = $ip_address;
                } else {
                    $response->ctr_updatedon = $date;
                    $response->ctr_updatedby = $userPK;
                    $response->ctr_updatedbyipaddr = $ip_address;
                }
                $response->ctr_memcompmst_fk = $company_id;
                $response->ctr_cmstenderhdr_fk = $tender->cmstenderhdr_pk;  
                $response->ctr_status = 2;
                $response->ctr_cmsquestionnaireformtrnx_fk = $model->cmsquestionnaireformtrnx_pk;
                $saveResponse = $response->save();                   
                if(in_array($tender->cmsth_tenderstatus, [2,4,8])) {
                    $tender->cmsth_tenderstatus = $tender->cmsth_tenderstatus == 2 ? 9 : 10;
                    $tender->save();
                        
                    $tendertemp = CmstenderhdrtempTbl::findOne($tender->cmsth_cmstenderhdrtemp_fk); 
                    if($tendertemp) {
                        $tendertemp->cmstht_tenderstatus = $tender->cmsth_tenderstatus;
                        $tendertemp->save();
                    }
                }
            } elseif ($response) {
                $response->ctr_cmsquestionnaireformtrnx_fk = $model->cmsquestionnaireformtrnx_pk;
                $saveResponse = $response->save();
            }

            if($saveResponse) { 
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'RFX Questionnaire save Successfully!',
                    'questionnaire_trnx_pk' => $model->cmsquestionnaireformtrnx_pk
                );
            } else {                    
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $response->getErrors(),
                );
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }
    
    /**
     * Get RFX Questionnaire
     */
    public function getRFXQuestionnaire($rfx_pk) {
        $data = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);
        if($tender->cmsthCmsquestionnaireformFk) {
            $data = [
                'name' => $tender->cmsthCmsquestionnaireformFk->cmsqf_formname,
                'created_on' => $tender->cmsthCmsquestionnaireformFk->cmsqf_createdon,
                'description' => $tender->cmsthCmsquestionnaireformFk->cmsqf_formdesc,
                'builder_template' => $tender->cmsthCmsquestionnaireformFk->cmsqf_buildertemplate,
                'builder_template_count' => count($tender->cmsthCmsquestionnaireformFk->cmsqf_buildertemplate)
            ];
        }

        return $data;
    }
    
    /**
     * Get RFX Terms
     */
    public function getRFXTerms($rfx_pk) {
        $data = $terms = $payments = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);
        
        if(!empty($tender->cmstnctrnxs)) {
            foreach($tender->cmstnctrnxs as $term) {                
                $files = [];
                foreach($term->ctnctUploads as $file) {
                    $files[] = [
                        'name' => Drive::getFileName(Security::encrypt($file->memcompfiledtls_pk)),
                        'src' => Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby),
                        'type' => $file->mcfd_filetype,
                        'upload_on' => $file->mcfd_uploadedon,
                        'size' => $file->mcfd_actualfilesize,
                    ];
                }

                $terms[$term->ctnct_cmstnchdr_fk][] = [
                    'name' => $term->ctnctCmstnchdrFk->ctnch_name,
                    'title' => $term->ctnct_title,
                    'content' => $term->ctnct_content,
                    'files' => $files
                ];
            }
        }
       
        if(!empty($tender->cmspaymentterms)) {
            foreach($tender->cmspaymentterms as $payment) {
                $payments[] = [
                    'name' => $payment->cmspt_name,
                    'value' => $payment->cmspt_value,
                    'pk' => $payment->cmspaymentterms_pk
                ];
            }
        }

        $data = [
            'invoice_interval' => $tender->cmsth_invoiceinterval,
            'invoice_interval_type' => $tender->cmsth_invoiceintervaltype,
            'payment_terms' => $payments,
            'terms' => array_values($terms)
        ];

        return $data;
    }
    
    /**
     * Get RFX Contacts Detail
     */
    public function getRFXContacts($formData) {
        $data = $users = [];
        $tender = CmstenderhdrTbl::findOne($formData['rfx_pk']);
        
        if(!empty($tender->contactUsers)) {
            foreach($tender->contactUsers as $user) {
                // $mob_no = !empty($formData['open_view']) ? $user->um_primobno : str_pad(substr($user->um_primobno, 0, 1), strlen($user->um_primobno), 'x');
                $mob_no = $user->um_primobno;
                $users[] = [
                    'name' => $user->um_firstname . ' ' . ($user->um_middlename ? $user->um_middlename . ' ' : '') . $user->um_lastname,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null,
                    'country_code' => $user->um_primobnocc,
                    'mobile' => $mob_no,
                    'email' => $user->UM_EmailID,
                    'dp' => Drive::generateUrl($user->um_userdp, $user->uMMemberRegMstFk->company->MemberCompMst_Pk, $user->UserMst_Pk)
                ];
            }
        }

        $data = [
            'users' => $users
        ];

        return $data;
    } 

    /**
     * Get RFX Configuration
     */
    public function getRFXConfiguration($rfx_pk) {
        $data = $users = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);
        
        if(!empty($tender->configUsers)) {
            foreach($tender->configUsers as $user) {
                $file = $user->userdp;  
                $users[] = [
                    'name' => $user->um_firstname . ' ' . ($user->um_middlename ? $user->um_middlename . ' ' : '') . $user->um_lastname,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null,
                    'country_code' => $user->um_primobnocc,
                    'mobile' => $user->um_primobno,
                    'email' => $user->UM_EmailID,
                    'dp' => $user->um_userdp ? Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby): null 
                ];
            }
        }

        $data = [
            'notifyuser_pks' => $tender->cmsth_config_usermst_fk,
            'contactuser_pks' => $tender->cmsth_contact_usermst_fk,
            'rfxtype' => $tender->cmsth_type, 
            'reminder' => $tender->cmsth_setreminder == 1 ? [
                'close_intvl' => $tender->cmsth_closeintvl,
                'close_intvl_type' => $tender->cmsth_closeintvltype,
                'open_intvl' => $tender->cmsth_openintvl,
                'open_intvl_type' => $tender->cmsth_openintvltype
            ] : null,
            'notify_users' => $users,
            'subcontract_status' => $tender->cmsth_issubcontrqmt,
            'obligation' => $tender->cmsth_obligation,
            'msmepercent' => $tender->cmsth_msmepercent,
            'lccpercent' => $tender->cmsth_lccpercent,
            'obligation_scope' => $tender->cmsth_obligationscope,
            'eTendering' => $tender->cmsth_isetendmandate,
            'is_icv' => $tender->cmsth_isicv,
            'icv_startyear' => $tender->cmsth_icv_startyear,
            'icv_startquarter' => $tender->cmsth_icv_startquarter,
            'icv_endyear' => $tender->cmsth_icv_endyear,
            'icv_endquarter' => $tender->cmsth_icv_endquarter,
            'targeted_supplier' => $tender->cmstendertargethdrTbls ? [
                'shortlisted' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 1])->count(),
                'jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 2])->count(),
                'non_jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmstth_targettype' => 3])->count()
            ] : null
        ];

        return $data;
    }
    
    /**
     * Get RFX Additional Document
     */
    public function getRFXAdditionalDoc($rfx_pk) {
        $data = $docs = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);

        if(!empty($tender->additionalDocuments)) {
            foreach($tender->additionalDocuments as $doc) { 
                $docs[] = [
                    'file' => $doc->cmssdUpload ? [
                        'name' => Drive::getFileName(Security::encrypt($doc->cmssdUpload->memcompfiledtls_pk)),
                        'src' => Drive::generateUrl($doc->cmssdUpload->memcompfiledtls_pk, $doc->cmssdUpload->mcfd_memcompmst_fk, $doc->cmssdUpload->mcfd_uploadedby),
                        'type' => $doc->cmssdUpload->mcfd_filetype,
                        'upload_on' => $doc->cmssdUpload->mcfd_uploadedon,
                        'size' => $doc->cmssdUpload->mcfd_actualfilesize                        
                    ] : null
                ];
            }
        }

        $data = [
            'link' => $tender->cmsth_attachlink,
            'close_date' => $tender->cmsth_attachclosedate,
            'additional_docs' => $docs
        ];

        return $data;
    }
    
    /**
     * Get RFX Product List
     */ 
    public function getRFXProductList($rfx_pk) {
        $data = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);

        if(!empty($tender->productNServiceList)) {
            foreach($tender->productNServiceList as $item) {
                $data[] = [
                    'key' => $item->cmsrqprodservdtls_pk,
                    'name' => $item->crpsd_displayname
                ];
            }
        }

        return $data;
    }
    
    /**
     * Get RFX Additional Information
     */
    public function getRFXAdditionalInfo($rfx_pk) {
        $data = $info = [];
        $tender = CmstenderhdrTbl::findOne($rfx_pk);

        if(!empty($tender->cmsaddinfodtlsTbls)) {
            foreach($tender->cmsaddinfodtlsTbls as $addInfo) {
                $info[] = [
                    'question' => $addInfo->caid_title,
                    'answer' => $addInfo->caid_description
                ];
            }
        }

        $data = [
            'additional_info' => $info
        ];

        return $data;
    }

    /**
     * Get RFX Additional Information
     */
    public function getRFXAdditionalInfotemp($rfx_pk) {
        $data = $info = [];
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        
        if(!empty($tender->cmsaddinfodtlstempTbls)) {
            foreach($tender->cmsaddinfodtlstempTbls as $addInfo) {
                $info[] = [
                    'question' => $addInfo->caidt_title,
                    'answer' => $addInfo->caidt_description
                ];
            }
        }

        $data = [
            'additional_info' => $info
        ];

        return $data;
    }

    
    /**
     * Get RFX Suppliers List
     */
    public function getRFXSuppliers($data) {
        $jsrsQ = "(CASE WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate >= DATE(NOW())) THEN 'Active' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate < DATE(NOW())) THEN 'Expired' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'V' AND MRM_ValSubStatus <> 'A' AND MRM_OrderConfrmStat = 'A') THEN 'Yet to Certify' WHEN (mrm_stkholdertypmst_fk = 14 OR (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'I' AND MRM_OrderConfrmStat <> 'A')) THEN 'Yet to Register' ELSE 'In-active' END)";

        if($data['isTemp']) {
            $query = CmstendertargethdrtempTbl::find();
        } else {
            $query = CmstendertargethdrTbl::find();
        }

        $subQuery = 'SELECT group_concat(m2.mclch_lcctype) FROM memcomplcccerthdr_tbl m2 WHERE m2.mclch_membercompmst_fk = MemberCompMst_Pk and m2.mclch_status = 1';

        $query->select(['MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk', 'MemberCompMst_Pk', 'MCM_SupplierCode', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'ISM_IncorpStyleEntity', '('.$subQuery.') as mclch_lcctype', 'cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_contperson', 'cnjsm_designation', 'cnjsm_contactemail', 'cnjsm_contactmobilecc', 'cnjsm_contactmobile', 'cnjsm_specialstatus', $jsrsQ.' AS jsrs'])
            ->leftJoin('memberregistrationmst_tbl', $data['isTemp'] ? 'cmsttht_memberregmst_fk' : 'cmstth_memberregmst_fk' . ' = MemberRegMst_Pk')
            ->leftJoin('membercompanymst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
            ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
            ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
            ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
            ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
            ->leftJoin('cmsnonjsrssupdtls_tbl', 'MemberRegMst_Pk = cmsnjsd_memberregmst_fk')
            ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupdtls_pk = cnjsm_cmsnonjsrssupdtls_fk')
            ->where([$data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk' => $data['reqpk']]);                

        if($data['search']['company']) {
            $query = $query->andFilterWhere(['like', 'MCM_CompanyName', $data['search']['company']]);
        }
        
        $filter = $data['filter'];
        if($filter['suppcode']) {
            $query = $query->andFilterWhere(['like', 'MCM_SupplierCode', $filter['suppcode']]);
        }
        if($filter['country']) {
            $query = $query->andWhere(['in', 'CyM_CountryName_en', $filter['country']]);
        }
        if($filter['classify']) {
            $query = $query->andWhere(['in', 'ClM_ClassificationType', $filter['classify']]);
        }
        if($filter['icstyle']) {
            $query = $query->andWhere(['in', 'ISM_IncorpStyleEntity', $filter['icstyle']]);
        }
        if($filter['specialStatus']) {
            $query = $query->andWhere(['in', 'mclch_lcctype', $filter['specialStatus']]);
        }
        if($filter['isjsrs']) {
            $query = $query->andWhere(['in', $jsrsQ, $filter['isjsrs']]);
        }
        
        $sort = [$data['isTemp'] ? 'cmstendertargethdrtemp_pk' : 'cmstendertargethdr_pk' => SORT_ASC];  
        if($data['sort'] == 'asc') {
            $sort = 'MCM_CompanyName asc';
        } elseif ($data['sort'] == 'desc') {
            $sort = 'MCM_CompanyName desc';        
        } elseif ($data['sort'] == 'recent') {
            $sort = [$data['isTemp'] ? 'cmstendertargethdrtemp_pk' : 'cmstendertargethdr_pk' => SORT_DESC];            
        }

        $query = $query->orderBy($sort)->groupBy($data['isTemp'] ? 'cmstendertargethdrtemp_pk' : 'cmstendertargethdr_pk');  
        if($query->count() <= 5) {
            $data['page'] = 0;
        } 
        $query = $query->asArray(); 

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $sort
            ],
            'pagination' => [
                'page' => $data['page'], 
                'pageSize' => $data['size']
            ]
        ]);
        
        $tenderTargetData = [];
        foreach ($provider->getModels() as $kay => $proVal) {
            $specialStatus = $proVal['mclch_lcctype'] ? array_map('intval', explode(',', $proVal['mclch_lcctype'])) : [];
            // if($proVal['mclch_lcctype'] && $filter['specialStatus']) {
            //     $specialStatus = array_filter($specialStatus, function($v) use ($filter) {
            //         return in_array($v, $filter['specialStatus']);
            //     });
            // }
            $tenderTargetData[] = [
                'name' => $proVal['MCM_CompanyName'],
                'logo_id' => $proVal['mcm_complogo_memcompfiledtlsfk'],
                'company_id' => $proVal['MemberCompMst_Pk'],
                'suppcode' => $proVal['MCM_SupplierCode'],
                'country' => $proVal['CyM_CountryName_en'],
                'flag' => $proVal['CountryMst_Pk'],
                'classify' => $proVal['ClM_ClassificationType'],
                'icstyle' => $proVal['ISM_IncorpStyleEntity'],
                'special_status' => $specialStatus,
                'isjsrs' => $proVal['jsrs'],
                'nonjsrs' => $proVal['cnjsm_cmsnonjsrssupdtls_fk'] ? [
                    'name' => $proVal['cnjsm_contperson'],
                    'designation' => $proVal['cnjsm_designation'],
                    'email' => $proVal['cnjsm_contactemail'],
                    'mobilecc' => $proVal['cnjsm_contactmobilecc'],
                    'mobile' => $proVal['cnjsm_contactmobile'],
                    'status' => $proVal['cnjsm_specialstatus']
                ] : null
            ];
        }

        $respData = [
            'suppliers' => $tenderTargetData,
            'total_count' => $provider->getTotalCount()
        ];
        if($data['isFirst']) {
            $respData['jsrsstatuslist'] = ['Active', 'Expired'];
            $respData['icstylelist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ISM_IncorpStyleEntity) AS icstyle')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['icstyle'];
            $respData['countrylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT CountryMst_Pk) AS country')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['country'];
            $respData['classifylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ClM_ClassificationType) AS classify')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['classify'];
        }

        return $respData;
    }
    
    /**
     * Get RFX Tender Response
     */
    public function getTenderResponse($dataPk) {
        $result = CmstenderresponseTbl::find()
            ->select([
                'cmstenderresponse_pk responsePk',
                'ctr_createdon submitted_on',
                'ctreh_createdon validated_on',
                'ctreh_comment comment',
                'JSON_OBJECT(
                    "form_name", cmsqf_formname,
                    "question", cmsqf_buildertemplate,
                    "answer", cmsqft_answer
                ) questionnarie_data',
            ])
            ->leftJoin('cmstenderresponseevalhsty_tbl', 'cmstenderresponse_pk = ctreh_cmstenderresponse_fk and ctr_status = ctreh_status')
            ->leftJoin('cmsquestionnaireformtrnx_tbl', 'ctr_cmsquestionnaireformtrnx_fk = cmsquestionnaireformtrnx_pk')
            ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsqft_cmsquestionnaireform_fk')
            ->where(['cmstenderresponse_pk' => $dataPk])
            ->asArray()->one();

        $result['questionnarie_data'] = json_decode($result['questionnarie_data'], true);
        return $result;
    }
    
    /**
     * Get RFX Acknowledge Response
     */
    public function getAcknowledgeResponse($dataPk) {
        $filesQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby,"type",mcfd_filetype,"size",mcfd_actualfilesize)),"]") as files';
        $result = CmstenderresponseTbl::find()
            ->select([
                'cmstenderresponse_pk',
                'ctr_createdon',
                'ctreh_createdon',
                'ctreh_comment',
                'ctr_comment',
                $filesQ
            ])
            ->leftJoin('cmstenderresponseevalhsty_tbl', 'cmstenderresponse_pk = ctreh_cmstenderresponse_fk and ctr_status = ctreh_status')
            ->leftJoin('memcompfiledtls_tbl', 'FIND_IN_SET(memcompfiledtls_pk, ctr_supdoc_filepath)')
            ->where(['cmstenderresponse_pk' => $dataPk])
            ->asArray()->one();

        $result['questionnarie_data'] = json_decode($result['questionnarie_data'], true);
        $files = [];
        foreach(json_decode($result['files']) as $response) {
            if($response->pk) {     
                $files[$response->pk] = [
                    'filePk' => $response->pk,
                    'name' => Drive::getFileName(Security::encrypt($response->pk)),
                    'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                    'size' => $response->size,
                    'type' => $response->type
                ];
            }
        }
        return $result ? [
            'submitted_on' => $result['ctr_createdon'],
            'validated_on' => $result['ctreh_createdon'],
            'comment' => $result['ctreh_comment'],
            'doc_comment' => $result['ctr_comment'],
            'files' => array_values($files)
        ] : null;
    }
    
    /**
     * Get RFX Quotations
     */
    public function getRFXQuotations($data) {
        $awardQ = $data['type'] == 7 ? 'cmsnjsd_memberregmst_fk = 0' : 'mrm_stkholdertypmst_fk = 14';
        $jsrsQ = "(CASE WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate >= DATE(NOW())) THEN 'Active' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate < DATE(NOW())) THEN 'Expired' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'V' AND MRM_ValSubStatus <> 'A' AND MRM_OrderConfrmStat = 'A') THEN 'Yet to Certify' WHEN ($awardQ OR (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'I' AND MRM_OrderConfrmStat <> 'A')) THEN 'Yet to Register' ELSE 'In-active' END)";

        if($data['isTemp']) {
            $tender = CmstenderhdrTbl::find()->where(['cmsth_cmstenderhdrtemp_fk' => $data['reqpk']])->one();
        } else {
            $tender = CmstenderhdrTbl::findOne($data['reqpk']);
        }
        
        $subQuery = 'SELECT group_concat(m2.mclch_lcctype) FROM memcomplcccerthdr_tbl m2 WHERE m2.mclch_membercompmst_fk = MemberCompMst_Pk and m2.mclch_status = 1';

        if($isQuot = in_array($tender->cmsth_type, [4, 5, 6])) {
            $query = CmsquotationhdrTbl::find()
                ->select(['cmsqf_formname', 'cmsqf_buildertemplate', 'cmsqft_answer', 'cmsquotationhdr_pk', 'cmstenderresponse_pk', 'cmsqh_quotationtitle', 'cmsqh_quotationrefno', 'cmsqh_createdon', 'cmsqh_grandtotalamount', 'CurM_CurrSymbol', 'ctr_status res_status', 'ctr_comment', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk', 'MemberCompMst_Pk', 'MCM_SupplierCode', 'mcm_accexpirydate', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'ISM_IncorpStyleEntity', '('.$subQuery.') as mclch_lcctype', 'icvplanbasehdr_pk', 'cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_contperson', 'cnjsm_designation', 'cnjsm_contactemail', 'cnjsm_contactmobilecc', 'cnjsm_contactmobile', 'cnjsm_specialstatus', $jsrsQ.' AS jsrs']);
            if($data['type'] == 7) {
                $query->innerJoin('cmscontracthdr_tbl', 'cmsch_cmsquotationhdr_fk = cmsquotationhdr_pk and cmsch_contractstatus = 1 and cmsch_isdeleted = 2');
            }
            $query->innerJoin('cmstenderresponse_tbl', 'ctr_memcompmst_fk = cmsqh_memcompmst_fk and ctr_cmstenderhdr_fk = cmsqh_cmstenderhdr_fk')
                ->leftJoin('membercompanymst_tbl', 'cmsqh_memcompmst_fk = MemberCompMst_Pk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
                ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
                ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'MemberRegMst_Pk = cmsnjsd_memberregmst_fk')
                ->leftJoin('icvplanbasehdr_tbl', 'cmsquotationhdr_pk = ipbh_cmsquotationhdr_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupdtls_pk = cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('currencymst_tbl', 'cmsqh_scope_currencymst_fk = CurrencyMst_Pk')
                ->leftJoin('cmsquotationevalhsty_tbl', 'cmsquotationhdr_pk = cmsqeh_cmsquotationhdr_fk and cmsqh_status = cmsqeh_status')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_shared_fk = cmsqh_cmstenderhdr_fk and MemberCompMst_Pk = cmsqft_memcompmst_fk')
                ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsqft_cmsquestionnaireform_fk')
                ->where(['cmsqh_cmstenderhdr_fk' => $tender->cmstenderhdr_pk])
                ->andWhere(['>', 'ctr_status', 1]);
        } else {
            $filesQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby,"type",mcfd_filetype)),"]")';
            $query = CmstenderresponseTbl::find()
                    ->select(['cmsqf_formname', 'cmsqf_buildertemplate', 'cmsqft_answer', 'cmstenderresponse_pk', 'ctr_status res_status', 'ctreh_comment', 'ctr_createdon', 'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) createdby', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk', 'MemberCompMst_Pk', 'MCM_SupplierCode', 'mcm_accexpirydate', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'ISM_IncorpStyleEntity', '('.$subQuery.') as mclch_lcctype', 'cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_contperson', 'cnjsm_designation', 'cnjsm_contactemail', 'cnjsm_contactmobilecc', 'cnjsm_contactmobile', 'cnjsm_specialstatus', $jsrsQ.' AS jsrs', $filesQ.' AS files'])
                    ->leftJoin('membercompanymst_tbl', 'ctr_memcompmst_fk = MemberCompMst_Pk')
                    ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                    ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
                    ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                    ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
                    ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
                    ->leftJoin('cmsnonjsrssupdtls_tbl', 'MemberRegMst_Pk = cmsnjsd_memberregmst_fk')
                    ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupdtls_pk = cnjsm_cmsnonjsrssupdtls_fk')
                    ->leftJoin('usermst_tbl', 'ctr_createdby = UserMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'FIND_IN_SET(memcompfiledtls_pk, ctr_supdoc_filepath)')
                    ->leftJoin('cmstenderresponseevalhsty_tbl', 'cmstenderresponse_pk = ctreh_cmstenderresponse_fk and ctr_status = ctreh_status')
                    ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = ctr_cmstenderhdr_fk')
                    ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_cmsquestionnaireform_fk = ctr_cmstenderhdr_fk and MemberCompMst_Pk = cmsqft_memcompmst_fk')
                    ->where(['ctr_cmstenderhdr_fk' => $tender->cmstenderhdr_pk])
                    ->andWhere(['>', 'ctr_status', 1]);
        }
        
        if($data['type'] && $data['type'] != 7) {
            $query = $query->andWhere(['ctr_status' => $data['type']]);
        }

        if($data['search']['company']) {
            $query = $query->andFilterWhere(['like', 'MCM_CompanyName', $data['search']['company']]);
        }
        
        $filter = $data['filter'];
        if($filter['suppcode']) {
            $query = $query->andFilterWhere(['like', 'MCM_SupplierCode', $filter['suppcode']]);
        }
        if($filter['country']) {
            $query = $query->andWhere(['in', 'CyM_CountryName_en', $filter['country']]);
        }
        if($filter['classify']) {
            $query = $query->andWhere(['in', 'ClM_ClassificationType', $filter['classify']]);
        }
        if($filter['icstyle']) {
            $query = $query->andWhere(['in', 'ISM_IncorpStyleEntity', $filter['icstyle']]);
        }
        if($filter['status']) {
            if(in_array('0', $filter['status'])) {
                $query = $query->andWhere(['not in', 'ctr_status', array_values(array_diff([5,6,7], array_map('intval', $filter['status'])))]);                
            } else {
                $query = $query->andWhere(['in', 'ctr_status', $filter['status']]);
            }
        }
        if($filter['specialStatus']) {
            $query = $query->andWhere(['in', 'mclch_lcctype', $filter['specialStatus']]);
        }
        if($filter['isjsrs']) {
            $query = $query->andWhere(['in', $jsrsQ, $filter['isjsrs']]);
        }
        
        $sort = [$isQuot ? 'cmsquotationhdr_pk' : 'cmstenderresponse_pk' => SORT_ASC];  
        if($data['sort'] == 'asc') {
            $sort = ['MCM_CompanyName' => SORT_ASC];
        } elseif ($data['sort'] == 'desc') {
            $sort = ['MCM_CompanyName' => SORT_DESC];      
        } elseif ($data['sort'] == 'recent') {
            $sort = [$isQuot ? 'cmsquotationhdr_pk' : 'cmstenderresponse_pk' => SORT_DESC];            
        }

        $query = $query->orderBy($sort)->groupBy($isQuot ? 'cmsquotationhdr_pk' : 'cmstenderresponse_pk');
        if($query->count() <= 5) {
            $data['page'] = 0;
        } 
        $query = $query->asArray(); 
        
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['page' => $data['page'], 'pageSize' => $data['size']]]);

        $responses = [];
        foreach ($provider->getModels() as $kay => $proVal) {
            if($proVal['res_status'] == 5) {
                $status = 'Shortlisted';
            } elseif($proVal['res_status'] == 6) {
                $status = 'Rejected';
            } elseif($proVal['res_status'] == 7) {
                $status = 'Awarded';
            } else {
                $status = 'Yet to Shortlisted';
            }

            $supdoc = [];
            foreach(json_decode($proVal['files']) as $response) {            
                $supdoc[$response->pk] = [
                    'name' => Drive::getFileName(Security::encrypt($response->pk)),
                    'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                    'type' => $response->type
                ];
            }

            $questionnarie_data = [
                'form_name' => $proVal['cmsqf_formname'],
                'question' => json_decode($proVal['cmsqf_buildertemplate']),
                'answer' => json_decode($proVal['cmsqft_answer'])
            ];

            $specialStatus = $proVal['mclch_lcctype'] ? array_map('intval', explode(',', $proVal['mclch_lcctype'])) : [];
            // if($proVal['mclch_lcctype'] && $filter['specialStatus']) {
            //     $specialStatus = array_filter($specialStatus, function($v) use ($filter) {
            //         return in_array($v, $filter['specialStatus']);
            //     });
            // }
            if(count($specialStatus)) {
                $specialStatus = array_values(array_unique($specialStatus));
            }

            $responses[] = [
                'questionnarie_data' => $questionnarie_data,
                'key' => $proVal['cmstenderresponse_pk'],
                'quotkey' => $isQuot ? $proVal['cmsquotationhdr_pk'] : null,
                'name' => $proVal['MCM_CompanyName'],
                'logo_id' => $proVal['mcm_complogo_memcompfiledtlsfk'],
                'compkey' => $proVal['MemberCompMst_Pk'],
                'suppcode' => $proVal['MCM_SupplierCode'],
                'exp' => $proVal['mcm_accexpirydate'],
                'country' => $proVal['CyM_CountryName_en'],
                'flag' => $proVal['CountryMst_Pk'],
                'classify' => $proVal['ClM_ClassificationType'],
                'icstyle' => $proVal['ISM_IncorpStyleEntity'],
                'special_status' => $specialStatus,
                'isjsrs' => $proVal['jsrs'],
                'status' => $status,
                'nonjsrs' => $proVal['cnjsm_cmsnonjsrssupdtls_fk'] ? [
                    'name' => $proVal['cnjsm_contperson'],
                    'designation' => $proVal['cnjsm_designation'],
                    'email' => $proVal['cnjsm_contactemail'],
                    'mobilecc' => $proVal['cnjsm_contactmobilecc'],
                    'mobile' => $proVal['cnjsm_contactmobile'],
                    'status' => $proVal['cnjsm_specialstatus']
                ] : null,
                'quotation' => $isQuot ? [
                    'title' => $proVal['cmsqh_quotationtitle'],
                    'ref' => $proVal['cmsqh_quotationrefno'],
                    'recievedon' => $proVal['cmsqh_createdon'],
                    'status' => $status,
                    'value' => $proVal['cmsqh_grandtotalamount'],
                    'comment' => $proVal['ctr_comment'],
                    'icvplan' => $proVal['icvplanbasehdr_pk'],
                    'currency' => $proVal['CurM_CurrSymbol']
                ] : null,
                'response' => !$isQuot ? [
                    'createdon' => $proVal['ctr_createdon'],
                    'createdby' => $proVal['createdby'],
                    'comment' => $proVal['ctr_comment'],
                    'supdoc' => array_values($supdoc),
                ] : null
            ];
        }

        // $projectPDO = $tender->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk->prjdMemberregmstFk->company->memcomplcccerthdrTblsPDO;
             
        $shorlisted_count = (int)CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $tender->cmstenderhdr_pk, 'ctr_status' => 5])->count();
        $rejected_count = (int)CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $tender->cmstenderhdr_pk, 'ctr_status' => 6])->count();

        $respData = [
            'suppliers' => $responses,
            'total_count' => $provider->getTotalCount(),
            'isQuot' => $isQuot,
            'shorlisted_count' => $shorlisted_count,
            'rejected_count' => $rejected_count,
        ];
        
        if($data['isFirst']) {     
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $loginUserPDO = MembercompanymstTbl::findOne($compPK)->memcomplcccerthdrTblsPDO;   
            $respData['isPDO'] = (boolean)$loginUserPDO;
            if($data['type'] == 5) {            
                $trCount = $tender->getCmstendertargethdrTbls()->count();
                $quotCount = $tender->getCmstenderresponseTbls()->where(['in', 'ctr_status', [2,5,6]])->count();
                $respData['isRecvAllQuot'] = $trCount == $quotCount;
            }
            $respData['jsrsstatuslist'] = ['Active', 'Expired'];
            $respData['icstylelist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ISM_IncorpStyleEntity) AS icstyle')->groupBy($isQuot ? 'cmsquotationhdr_pk' : 'cmstenderresponse_pk')->one()['icstyle'];
            $respData['countrylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT CountryMst_Pk) AS country')->groupBy($isQuot ? 'cmsqh_cmstenderhdr_fk' : 'ctr_cmstenderhdr_fk')->one()['country'];            
            $respData['classifylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ClM_ClassificationType) AS classify')->groupBy($isQuot ? 'cmsqh_cmstenderhdr_fk' : 'ctr_cmstenderhdr_fk')->one()['classify'];
        }

        return $respData;
    }
    
    /**
     * Get RFX Quotations
     */
    public function getRFXCompareListData($formData) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($formData['isQuot']) {
            $result = (new \yii\db\query())
                    ->select(['cmsquotationhdr_pk', 'cmstenderresponse_pk', 'cmsqh_createdon', 'CurM_CurrSymbol', 'cmsqh_status', 'MCM_CompanyName', 'MemberCompMst_Pk', 'MCM_SupplierCode', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'mclch_lcctype', 'cmsqft_answer', 'cmsqh_delivterm', 'cmsqh_portname', 'cmsqh_delivdate', 'cmsqh_deviationcomment', 'icvplanbasehdr_pk', 'cmsdeviationhdr_pk as cmsdeviationhdr_pk_count', 'cmspaymentterms_pk', 'cmspt_name', 'cmspt_value', 'ctpsm_delivdate', 'cmssupdocument_pk', 'cmssd_docname', 'doc.memcompfiledtls_pk doc_pk', 'doc.mcfd_memcompmst_fk doc_compfk', 'doc.mcfd_uploadedby doc_uploadedby', 'logo.memcompfiledtls_pk logo_pk', 'logo.mcfd_memcompmst_fk logo_compfk', 'logo.mcfd_uploadedby logo_uploadedby', 'doc.mcfd_filetype doc_filetype', 'cmstenderpsmap_pk', 'ctpsm_cmsrqprodservdtls_fk', 'ctpsm_amount', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_deviationcomment', 'ctpsm_unitcurrency_fk', 'memcomplcccerthdr_pk', 'cmstenderpscharges_pk', 'ctpsc_type', 'ctpsc_name', 'ctpsc_amount', 'cmstenderagreehdr_pk', 'ctah_type', 'ctah_category', 'ctah_comments', 'ctah_remarks', 'cmstnctrnx_pk', 'ctnct_title', 'ctnct_content', 'cmsdeviationhdr_pk', 'ctr_evaluationscore', 'ctr_evaluationremark'])
                    ->from('cmsquotationhdr_tbl')
                    ->innerJoin('cmstenderresponse_tbl', 'ctr_memcompmst_fk = cmsqh_memcompmst_fk and ctr_cmstenderhdr_fk = cmsqh_cmstenderhdr_fk')
                    ->leftJoin('membercompanymst_tbl', 'cmsqh_memcompmst_fk = MemberCompMst_Pk')
                    ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                    ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
                    ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                    ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
                    ->leftJoin('currencymst_tbl', 'cmsqh_scope_currencymst_fk = CurrencyMst_Pk')
                    ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsquotationhdr_pk = cmsqft_shared_fk and cmsqft_shared_type = 1')
                    ->leftJoin('icvplanbasehdr_tbl', 'cmsquotationhdr_pk = ipbh_cmsquotationhdr_fk')
                    ->leftJoin('cmsdeviationhdr_tbl', 'cmsquotationhdr_pk = cmsdh_shared_fk and cmsdh_shared_type = 1')
                    ->leftJoin('cmspaymentterms_tbl', 'cmsquotationhdr_pk = cmspt_shared_fk and cmspt_type = 3')
                    ->leftJoin('cmssupdocument_tbl', 'cmsquotationhdr_pk = cmssd_shared_fk and cmssd_type = 14')
                    ->leftJoin('memcompfiledtls_tbl doc', 'doc.memcompfiledtls_pk = cmssd_upload')
                    ->leftJoin('memcompfiledtls_tbl logo', 'logo.memcompfiledtls_pk = mcm_complogo_memcompfiledtlsfk')
                    ->leftJoin('cmstenderpsmap_tbl', 'cmsquotationhdr_pk = ctpsm_shared_fk and ctpsm_shared_type = 3')
                    ->leftJoin('cmstenderpscharges_tbl', 'cmsquotationhdr_pk = ctpsc_shared_fk and ctpsc_shared_type = 1')
                    ->leftJoin('cmstenderagreehdr_tbl', 'cmsquotationhdr_pk = ctah_cmsquotationhdr_fk')
                    ->leftJoin('cmstnctrnx_tbl', 'cmsquotationhdr_pk = ctnct_shared_fk and ctnct_type = 4')
                    ->where(['in', 'cmsquotationhdr_pk', $formData['reqpks']])->all();
            
            $responses = $payments = $docs = $products = $charges = $terms = $bidderterm = $deviations = $special_status = [];
            foreach(json_decode(json_encode($result)) as $response) {
                if($response->cmspaymentterms_pk) {
                    $payments[$response->cmsquotationhdr_pk][$response->cmspaymentterms_pk] = [
                        'name' => $response->cmspt_name,
                        'value' => $response->cmspt_value
                    ];
                }
                if($response->cmssupdocument_pk) {
                    $docs[$response->cmsquotationhdr_pk][$response->cmssupdocument_pk] = [
                        'name' => $response->cmssd_docname,
                        'file' => [
                            'name' => Drive::getFileName(Security::encrypt($response->doc_pk)),
                            'url' => Drive::generateUrl($response->doc_pk, $response->doc_compfk, $response->doc_uploadedby),
                            'type' => $response->doc_filetype,
                        ]
                    ];
                }
                if($response->cmstenderpsmap_pk) {
                    $products[$response->cmsquotationhdr_pk][$response->cmstenderpsmap_pk] = [
                        'mappk' => $response->cmstenderpsmap_pk,
                        'key' => $response->ctpsm_cmsrqprodservdtls_fk,
                        'amount' => $response->ctpsm_amount,
                        'tax' => $response->ctpsm_tax,
                        'discount' => $response->ctpsm_discount,
                        'deviation' => $response->ctpsm_deviationcomment,
                        'currency_symbol' => $response->ctpsm_unitcurrency_fk
                    ];
                }
                if($response->cmstenderpscharges_pk) {
                    $charges[$response->cmsquotationhdr_pk][$response->cmstenderpscharges_pk] = [
                        'type' => $response->ctpsc_type,
                        'name' => $response->ctpsc_name,
                        'amount' => $response->ctpsc_amount
                    ];
                }
                if($response->cmstenderagreehdr_pk) {
                    $terms[$response->cmsquotationhdr_pk][$response->cmstenderagreehdr_pk] = [
                        'type' => $response->ctah_type,
                        'category' => $response->ctah_category,
                        'comments' => $response->ctah_comments,
                        'remarks' => $response->ctah_remarks
                    ];
                }
                if($response->cmstnctrnx_pk) {
                    $bidderterm[$response->cmsquotationhdr_pk][$response->cmstnctrnx_pk] = [
                        'title' => $response->ctnct_title,
                        'content' => $response->ctnct_content
                    ];
                }
                if($response->cmsdeviationhdr_pk) {
                    $deviations[$response->cmsquotationhdr_pk][$response->cmsdeviationhdr_pk] = [
                        'key' => $response->cmsdeviationhdr_pk
                    ];
                }
                if($response->mclch_lcctype) {
                    $special_status[$response->cmsquotationhdr_pk][$response->memcomplcccerthdr_pk] = $response->mclch_lcctype;
                }
                
                $contracts = (boolean)CmscontracthdrTbl::find()
                    ->innerJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                    ->where([
                        'cmsad_memcompmst_fk' => $response->MemberCompMst_Pk,
                        'cmsad_isprimarycontractor' => 1,
                        'cmsad_createdby' => $userPK
                    ])->count();
                $responses[$response->cmsquotationhdr_pk] = [
                    'key' => $response->cmsquotationhdr_pk,
                    'logo' => Drive::generateUrl($response->logo_pk, $response->logo_compfk, $response->logo_uploadedby),
                    'reskey' => $response->cmstenderresponse_pk,
                    'name' => $response->MCM_CompanyName,
                    'compkey' => $response->MemberCompMst_Pk,
                    'suppcode' => $response->MCM_SupplierCode,
                    'country' => $response->CyM_CountryName_en,
                    'flag' => $response->CountryMst_Pk,
                    'classify' => $response->ClM_ClassificationType,
                    'special_status' => $special_status[$response->cmsquotationhdr_pk] ?: [],
                    'date' => $response->cmsqh_createdon,
                    'score' => $response->ctr_evaluationscore,
                    'remark' => $response->ctr_evaluationremark,
                    'isContract' => (boolean)$contracts,
                    'quotation' => [
                        'currency' => $response->CurM_CurrSymbol,
                        'questionnaire' => json_decode($response->cmsqft_answer, true),
                        'delivterm' => $response->cmsqh_delivterm,
                        'portname' => $response->cmsqh_portname,
                        'delivdate' => $response->ctpsm_delivdate ?: $response->cmsqh_delivdate,
                        'deviationcomment' => $response->cmsqh_deviationcomment,
                        'icvplan' => $response->icvplanbasehdr_pk,
                        'deviationrequests' => $deviations[$response->cmsquotationhdr_pk] ?: [],
                        'payment_terms' => $payments[$response->cmsquotationhdr_pk] ?: [],
                        'supportingdocs' => $docs[$response->cmsquotationhdr_pk] ?: [],
                        'products' => $products[$response->cmsquotationhdr_pk] ?: [],
                        'charges' => $charges[$response->cmsquotationhdr_pk] ?: [],
                        'terms' => $terms[$response->cmsquotationhdr_pk] ?: [],
                        'bidderterm' => $bidderterm[$response->cmsquotationhdr_pk] ?: []
                    ]
                ];
            }
    
            $data = [];
            foreach($responses as $val) {
                $val['special_status'] = array_values($val['special_status']);
                $val['special_status'] = array_map('intval', $val['special_status']);
                $val['quotation']['payment_terms'] = array_values($val['quotation']['payment_terms']);
                $val['quotation']['supportingdocs'] = array_values($val['quotation']['supportingdocs']);
                $val['quotation']['products'] = array_values($val['quotation']['products']);
                $val['quotation']['charges'] = array_values($val['quotation']['charges']);
                $val['quotation']['terms'] = array_values($val['quotation']['terms']);
                $val['quotation']['bidderterm'] = array_values($val['quotation']['bidderterm']);
                $val['quotation']['deviationrequests'] = count(array_values($val['quotation']['deviationrequests']));
                $data[] = $val;
            }
        } else {
            $filesQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby,"type",mcfd_filetype)),"]")';
            $result = (new \yii\db\query())
                    ->select(['cmstenderresponse_pk', 'ctr_comment', 'cmsqft_answer', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk', 'MemberCompMst_Pk', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'group_concat(mclch_lcctype) as mclch_lcctype', $filesQ.' AS files'])
                    ->from('cmstenderresponse_tbl')
                    ->leftJoin('membercompanymst_tbl', 'ctr_memcompmst_fk = MemberCompMst_Pk')
                    ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                    ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
                    ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                    ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
                    ->leftJoin('cmsquestionnaireformtrnx_tbl', 'ctr_cmsquestionnaireformtrnx_fk = cmsquestionnaireformtrnx_pk')
                    ->leftJoin('memcompfiledtls_tbl', 'FIND_IN_SET(memcompfiledtls_pk, ctr_supdoc_filepath)')
                    ->where(['in', 'cmstenderresponse_pk', $formData['reqpks']])
                    ->groupBy('cmstenderresponse_pk')->all();

            $data = [];
            foreach ($result as $kay => $proVal) {    
                $supdoc = [];
                foreach(json_decode($proVal['files']) as $response) {
                    $supdoc[$response->pk] = [
                        'name' => Drive::getFileName(Security::encrypt($response->pk)),
                        'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                        'type' => $response->type
                    ];
                }
                $contracts = (boolean)CmscontracthdrTbl::find()
                    ->innerJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                    ->where([
                        'cmsad_memcompmst_fk' => $proVal['MemberCompMst_Pk'],
                        'cmsad_isprimarycontractor' => 1,
                        'cmsad_createdby' => $userPK
                    ])->count();
                $data[] = [
                    'key' => (int)$proVal['cmstenderresponse_pk'],
                    'name' => $proVal['MCM_CompanyName'],
                    'compkey' => $proVal['MemberCompMst_Pk'],
                    'country' => $proVal['CyM_CountryName_en'],
                    'flag' => $proVal['CountryMst_Pk'],
                    'classify' => $proVal['ClM_ClassificationType'],
                    'isContract' => (boolean)$contracts,
                    'special_status' => $proVal['mclch_lcctype'] ? array_map('intval', explode(',', $proVal['mclch_lcctype'])) : [],
                    'response' => !$isQuot ? [
                        'questionnaire' => json_decode($proVal['cmsqft_answer'], true),
                        'supdoc' => array_values($supdoc),
                        'comment' => $proVal['ctr_comment']
                    ] : null
                ];
            }
        }

        $ranks = CmstenderresponseTbl::find()
            ->select(['GROUP_CONCAT(COALESCE(ctr_evaluationscore)) ranks'])
            ->where(['ctr_cmstenderhdr_fk' => $formData['tenpk']])
            ->andWhere(['>', 'ctr_status', 1])
            ->asArray()->one()['ranks'];

        return ['suppliers' => $data, 'ranks' => $ranks ? explode(',', $ranks) : []];
    }
    
    /**
     * Get RFX Contract History
     */
    public function getRFXContractHistory($comp_pk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $result = CmscontracthdrTbl::find()
            ->select([
                'cmsch_uid id',
                'cmsch_contractrefno ref',
                'cmsch_contracttitle title',
            ])
            ->innerJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
            ->where([
                'cmsad_memcompmst_fk' => $comp_pk,
                'cmsad_isprimarycontractor' => 1,
                'cmsad_createdby' => $userPK
            ])->asArray()->all();

        return $result;
    }
    
    /**
     * Get RFX Contract History
     */
    public function getRFXViewPdoLcc($comp_pk) {
        $data = [];
        $expQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",t1.memcompfiledtls_pk,"comp_pk",t1.mcfd_memcompmst_fk,"uploadedby",t1.mcfd_uploadedby,"type",t1.mcfd_filetype)),"]")';
        $evdQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",t2.memcompfiledtls_pk,"comp_pk",t2.mcfd_memcompmst_fk,"uploadedby",t2.mcfd_uploadedby,"type",t2.mcfd_filetype)),"]")';
        $result = (new \yii\db\query())
                ->select(['pcm_categoryname', 'scfpcdm_yrofexp', 'scfpcdm_totcontvalue', $expQ.' AS exp', $evdQ.' AS evd'])
                ->from('scfpdocatdtlsmain_tbl')
                ->leftJoin('pdocategorymst_tbl', 'scfpcdm_pdocategorymst_fk = pdocategorymst_pk')
                ->leftJoin('memcompfiledtls_tbl t1', 'FIND_IN_SET(t1.memcompfiledtls_pk, scfpcdm_pasthstexp)')
                ->leftJoin('memcompfiledtls_tbl t2', 'FIND_IN_SET(t2.memcompfiledtls_pk, scfpcdm_otherevid)')
                ->where(['scfpcdm_memcompmst_fk' => $comp_pk])
                ->groupBy('scfpdocatdtlsmain_pk')->all();

        foreach($result as $key => $val) {
            $exp = $evd = [];
            foreach(json_decode($val['exp']) as $response) {
                if($response->pk) {
                    $exp[$response->pk] = [
                        'name' => Drive::getFileName(Security::encrypt($response->pk)),
                        'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                        'type' => $response->type
                    ];
                }
            }
            foreach(json_decode($val['evd']) as $response) {
                if($response->pk) {
                    $evd[$response->pk] = [
                        'name' => Drive::getFileName(Security::encrypt($response->pk)),
                        'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                        'type' => $response->type
                    ];
                }
            }
            $data[] = [
                'sno' => $key+1,
                'lcccat' => $val['pcm_categoryname'],
                'expyr' => $val['scfpcdm_yrofexp'],
                'tcontrctval' => $val['scfpcdm_totcontvalue'],
                'pasthisexp' => array_values($exp),
                'otherevidence' => array_values($evd)
            ];
        }

        return ['list' => $data];
    }
    
    /**
     * Save RFX Other Expenses
     */
    public function saveRFXOtherExpenses($data) {
        $quotation = CmsquotationhdrTbl::findOne($data['quot_pk']);

        if($quotation) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

            $model = CmstenderpschargesTbl::find()->where(['ctpsc_shared_fk' => $data['quot_pk'], 'ctpsc_shared_type' => 1, 'ctpsc_type' => 3])->one();

            if(!$model) {
                $model = new CmstenderpschargesTbl();
            }

            if ($model->cmstenderpscharges_pk) {
                $model->ctpsc_updatedon = $date;
                $model->ctpsc_updatedby = $userPK;
                $model->ctpsc_updatedbyipaddr = $ip_address;
            } else {            
                $model->ctpsc_shared_fk = $data['quot_pk'];
                $model->ctpsc_shared_type = 1;
                $model->ctpsc_type = 3;
                $model->ctpsc_name = 'Other Expenses';
                $model->ctpsc_createdon = $date;
                $model->ctpsc_createdby = $userPK;
                $model->ctpsc_createdbyipaddr = $ip_address;
            }
            $model->ctpsc_amount = $data['amt'];

            if($model->save()) {
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Other Expenses saved Successfully!'
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!'
                );
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }
    
    /**
     * Save RFX Overall Score
     */
    public function saveRFXOverallScore($data) {
        $model = CmsquotationhdrTbl::findOne($data['quot_pk']);
        $resModel = CmstenderresponseTbl::findOne($data['res_pk']);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        if($model && $resModel) {
            $model->cmsqh_evaluationscore = $data['score'];
            $model->cmsqh_evaluationremark = $data['remark'] ?: null;
            $resModel->ctr_evaluationscore = $data['score'];
            $resModel->ctr_evaluationremark = $data['remark'] ?: null;

            if($model->save() && $resModel->save()) {
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Overall Score saved Successfully!'
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!'
                );
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }    

    /**
     * Update RFX Quotation Status
     */
    public function updateRFXQuotStatus($rfx_pk, $data) {
        $tender = CmstenderhdrTbl::find()->where(['cmsth_cmstenderhdrtemp_fk' => $rfx_pk])->one();
        if($data['isTemp']) {
            $tender = CmstenderhdrTbl::find()->where(['cmsth_cmstenderhdrtemp_fk' => $rfx_pk])->one();
        } else {
            $tender = CmstenderhdrTbl::findOne($rfx_pk);
        }
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();

        if($data['notify']) {
            if($data['quot_ids'] == 'SHORTLIST_ALL') {
                $tenResponses = CmstenderresponseTbl::find()
                    ->where(['ctr_cmstenderhdr_fk' => $tender->cmstenderhdr_pk])
                    ->andWhere(['not in', 'ctr_status', [5,6]])
                    ->all();
            } else {
                $tenResponses = CmstenderresponseTbl::find()
                    ->where(['in', 'cmstenderresponse_pk', $data['quot_ids']])
                    ->all();
            }

            foreach($tenResponses as $tenResponse) {
                self::sendEvlautionNotifyMail($tender, $tenResponse->ctr_memcompmst_fk, $data['status'] == 5 ? 246 : 247, $tenResponse->ctr_comment);
            }

            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => 'Mail Sent Successfully!'
            );
        } else {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if($tender && $data) {                    
                    if($data['quot_ids'] == 'SHORTLIST_ALL') {
                        $ids = CmstenderresponseTbl::find()
                            ->select(['group_concat(cmstenderresponse_pk) ids'])
                            ->where(['ctr_cmstenderhdr_fk' => $tender->cmstenderhdr_pk])
                            ->andWhere(['not in', 'ctr_status', [5,6]])
                            ->asArray()
                            ->one()['ids'];
                        $ids = explode(',', $ids);
                    } else {
                        $ids = $data['quot_ids'];
                    }
                    $quot_ids = CmstenderresponseTbl::find()
                        ->select(['group_concat(cmsquotationhdr_pk) ids'])
                        ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_memcompmst_fk = ctr_memcompmst_fk and cmsqh_cmstenderhdr_fk = ctr_cmstenderhdr_fk')
                        ->where(['in', 'cmstenderresponse_pk', $ids])
                        ->asArray()
                        ->one()['ids'];

                    if($quot_ids) {
                        $quot_ids = explode(',', $quot_ids);
                        $status = CmsquotationhdrTbl::updateAll([
                            'cmsqh_status' => $data['status']
                        ], ['and', ['in', 'cmsquotationhdr_pk', $quot_ids], ['=', 'cmsqh_cmstenderhdr_fk', $tender->cmstenderhdr_pk]]);
                    }

                    $status = CmstenderresponseTbl::updateAll([
                        'ctr_status' => $data['status'],
                        'ctr_comment' => $data['comment'],
                    ], ['and', ['in', 'cmstenderresponse_pk', $ids], ['=', 'ctr_cmstenderhdr_fk', $tender->cmstenderhdr_pk]]);
                    if($status) {
                        foreach($ids as $key) {
                            $model = new CmstenderresponseevalhstyTbl();
                            $model->ctreh_cmstenderresponse_fk = $key;
                            $model->ctreh_status = $data['status'];
                            $model->ctreh_comment = $data['comment'];
                            $model->ctreh_createdon = date('Y-m-d H:i:s');
                            $model->ctreh_createdby = $userPK;
                            $model->ctreh_createdbyipaddr = $ip_address;
                            $model->save();
                        }
                    }
    
                    if($status) {
                        $trCount = $tender->getCmstenderresponseTbls()->where(['in', 'ctr_status', [2,5,6]])->count();
                        $shortlistedCount = $tender->getCmstenderresponseTbls()->where(['ctr_status' => 5])->count();
                        $rejectedCount = $tender->getCmstenderresponseTbls()->where(['ctr_status' => 6])->count();
                        $tenderStatus = $tender->cmsth_tenderstatus;

                        if(($shortlistedCount + $rejectedCount) > 0) {
                            $tenderStatus = 10;
                        }
                        if($trCount == ($shortlistedCount + $rejectedCount)) {
                            $tenderStatus = 8;
                        }
                        if($trCount == $rejectedCount) {
                            $tenderStatus = 4;
                        }

                        if($tender->cmsth_tenderstatus != $tenderStatus) {
                            $tender->cmsth_tenderstatus = $tenderStatus;
                            $tender->save();
                                
                            $tendertemp = CmstenderhdrtempTbl::findOne($tender->cmsth_cmstenderhdrtemp_fk); 
                            if($tendertemp) {
                                $tendertemp->cmstht_tenderstatus = $tenderStatus;
                                $tendertemp->save();
                            }
                        }
    
                        $transaction->commit();
                        return array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'U',
                            'comments' => 'Status updated Successfully!'
                        );
                    } else {
                        return array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!'
                        );
                    }
                }
    
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'No Data'
                );
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    public function sendEvlautionNotifyMail($model, $comp_pk, $template_id, $comment) {
        $compObj = MembercompanymstTbl::findOne($comp_pk);        
        $types = [
            '1' => 'Request for Information (RFI)',
            '2' => 'Expression of Interest (EOI)',
            '3' => 'Pre-qualification (PQ)',
            '4' => 'Request for Proposal (RFP)',
            '5' => 'Request for Quotation (RFQ)',
            '6' => 'Request for Tender (RFT)',
            '7' => 'eTender',
            '8' => 'eAuction'
        ];
        $emailid = $compObj->mCMMemberRegMstFk->user->UM_EmailID;
        $appUrl = \Yii::$app->params['APP_URL'];
        $baseUrl = \Yii::$app->params['baseUrl'];
        $url = $appUrl."api/ma/mail/send";        
        $encrypted_pk = Security::encrypt($model->cmstenderhdr_pk);
        $btn_url = $baseUrl . 'pms/rfxlist?afterloginpage=RFXEVALDETL&rfxid=' . $encrypted_pk . '&rfxtype=' . $model->cmsth_type;
       
        $_data = [
            'email' => $emailid ? $emailid : \Yii::$app->params['testMailIDs'][0],
            'template_id'=> $template_id,
            'table_ref_key'=>'cmstenderhdr_pk',
            'table_ref_value'=> $model->cmstenderhdr_pk,
            'addi_params' => [
                'RFX_TYPE' => $types[$model->cmsth_type],
                'rfx_supplier_company' => $compObj->MCM_CompanyName,
                'rfx_view_url' => $btn_url
            ]
        ];
        if($template_id == 247) {
            $_data['addi_params']['rfx_status_comment'] = $comment;
        }
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
        $response = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        return true;
    }
    
    /**
     * Save RFX Tender Response
     */
    public function saveRFXTenderResponse($data) {
        $tender = CmstenderhdrTbl::findOne($data['rfx_pk']);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $user = UsermstTbl::findOne($userPK);

        if($tender && $user) {
            $model = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $data['rfx_pk'], 'ctr_createdby' => $userPK])->one();
            if(!$model) {
                $model = new CmstenderresponseTbl();
                $model->ctr_createdon = $date;
                $model->ctr_createdby = $userPK;
                $model->ctr_createdbyipaddr = $ip_address;
            } else {                
                $model->ctr_updatedon = $date;
                $model->ctr_updatedby = $userPK;
                $model->ctr_updatedbyipaddr = $ip_address;
            }
            $model->ctr_memcompmst_fk = $user->uMMemberRegMstFk->company->MemberCompMst_Pk;
            $model->ctr_cmstenderhdr_fk = $tender->cmstenderhdr_pk;  
            $model->ctr_status = $data['status'];

            if(!empty($data['questionnaire_trnx_pk'])) {
                $model->ctr_cmsquestionnaireformtrnx_fk = $data['questionnaire_trnx_pk'];
            }
            if(!empty($data['doctitle'])) {                
                $model->ctr_doctitle = $data['doctitle'];
            }
            if(!empty($data['comment'])) {                
                $model->ctr_comment = $data['comment'];
            }
            if(!empty($data['file_pks'])) {                
                $model->ctr_supdoc_filepath = implode(',', $data['file_pks']);
            }

            if($model->save() === true) {                    
                if(in_array($tender->cmsth_tenderstatus, [2,4,8]) && $data['status'] == 2) {
                    $tender->cmsth_tenderstatus = $tender->cmsth_tenderstatus == 2 ? 9 : 10;
                    $tender->save();
                        
                    $tendertemp = CmstenderhdrtempTbl::findOne($tender->cmsth_cmstenderhdrtemp_fk); 
                    if($tendertemp) {
                        $tendertemp->cmstht_tenderstatus = $tender->cmsth_tenderstatus;
                        $tendertemp->save();
                    }
                }
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Tender Response Save Successfully!'
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }

    public static function deletetenquiry($enquirypk) {
        $result = array(
            'status' => 200,
            'msg' => 'failure',
            'flag' => 'U',
            'comments' => 'Something Went Wrong!',
        );

        if($enquirypk) {
            $tender = CmstenderhdrTbl::findOne($enquirypk);
            if($tender) {
                $tender->cmsth_isdeleted = 1;

                if ($tender->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Enquiry Deleated Successfully!',
                    );
                }

            } 
        }
        return $result;
    }
    public static function getIssuedEnquiries($dataPk,$dataType) {
        if($dataType == 1){            
            $totalAwards = CmstenderhdrtempTbl::find()
                    ->select(["count(if(cmstht_type = 1, 1,null)) as 'rfiCount'","count(if(cmstht_type = 2, 1,null)) as 'eoiCount'","count(if(cmstht_type = 3, 1,null)) as 'PqCount'","count(if(cmstht_type = 4, 1,null)) as 'rfpCount'","count(if(cmstht_type = 5, 1,null)) as 'rfqCount'","count(if(cmstht_type = 6, 1,null)) as 'rftCount'","count(if(cmstht_type = 7, 1,null)) as 'eTenderCount'","count(if(cmstht_type = 8, 1,null)) as 'eAuctionCount'"])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmstht_cmsrequisitionformdtls_fk')
                    ->where('crfd_projectdtls_fk=:pk and crfd_isdeleted = 2 and cmstht_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->groupBy('crfd_projectdtls_fk')
                    ->one();
        }elseif ($dataType == 2) {
            $totalAwards = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if(cmstht_type = 1, 1,null)) as 'rfiCount'","count(if(cmstht_type = 2, 1,null)) as 'eoiCount'","count(if(cmstht_type = 3, 1,null)) as 'PqCount'","count(if(cmstht_type = 4, 1,null)) as 'rfpCount'","count(if(cmstht_type = 5, 1,null)) as 'rfqCount'","count(if(cmstht_type = 6, 1,null)) as 'rftCount'","count(if(cmstht_type = 7, 1,null)) as 'eTenderCount'","count(if(cmstht_type = 8, 1,null)) as 'eAuctionCount'"])
                    ->leftJoin('cmstenderhdrtemp_tbl', 'cmstht_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmstht_isdeleted = 2')
                    ->where('crfd_cmscontracthdr_fk=:pk and crfd_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        }elseif ($dataType == 3) {
            $totalAwards = CmstenderhdrtempTbl::find()
                    ->select(["count(if(cmstht_type = 1, 1,null)) as 'rfiCount'","count(if(cmstht_type = 2, 1,null)) as 'eoiCount'","count(if(cmstht_type = 3, 1,null)) as 'PqCount'","count(if(cmstht_type = 4, 1,null)) as 'rfpCount'","count(if(cmstht_type = 5, 1,null)) as 'rfqCount'","count(if(cmstht_type = 6, 1,null)) as 'rftCount'","count(if(cmstht_type = 7, 1,null)) as 'eTenderCount'","count(if(cmstht_type = 8, 1,null)) as 'eAuctionCount'"])
                    ->where('cmstht_memcompmst_fk=:pk and cmstht_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'totalEnquires' => $totalAwards ? $totalAwards : [],
        );
        return $result;
    }
    public static function getPendingEvaluation($dataPk,$dataType) {
        if($dataType == 1){            
            $pendingEvaluation = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if(cmsth_type = 1, 1,null)) as 'rfiCount'","count(if(cmsth_type = 2, 1,null)) as 'eoiCount'","count(if(cmsth_type = 3, 1,null)) as 'PqCount'","count(if(cmsth_type = 4, 1,null)) as 'rfpCount'","count(if(cmsth_type = 5, 1,null)) as 'rfqCount'","count(if(cmsth_type = 6, 1,null)) as 'rftCount'"])
                    ->leftJoin('cmstenderhdr_tbl', 'cmsth_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmsth_isdeleted = 2 and cmsth_tenderstatus IN (8,9,10)')
                    ->where('crfd_projectdtls_fk=:pk and crfd_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        }elseif ($dataType == 2) {
            $pendingEvaluation = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if(cmsth_type = 1, 1,null)) as 'rfiCount'","count(if(cmsth_type = 2, 1,null)) as 'eoiCount'","count(if(cmsth_type = 3, 1,null)) as 'PqCount'","count(if(cmsth_type = 4, 1,null)) as 'rfpCount'","count(if(cmsth_type = 5, 1,null)) as 'rfqCount'","count(if(cmsth_type = 6, 1,null)) as 'rftCount'"])
                    ->leftJoin('cmstenderhdr_tbl', 'cmsth_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmsth_isdeleted = 2 and cmsth_tenderstatus IN (8,9,10)')
                    ->where('crfd_cmscontracthdr_fk=:pk and crfd_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'pedndingCount' => $pendingEvaluation,
        );
        return $result;
    }

    public function sendRfxPublishEmail($model, $target, $republish)
    {
        $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
        $emailid  = $target->cmstthMemberregmstFk->user->UM_EmailID;
        $tenderhdrfk = $target->cmstendertargethdr_pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $template_id = 243;

        if($republish){
            $template_id = 244;
        }
        $_data = [
            'email' => $emailid,
            'template_id'=> $template_id,
            'table_ref_key'=>'cmstenderhdr_pk',
            'table_ref_value'=> $model->cmstenderhdr_pk,
            'addi_params' => ['RFX_TYPE'=> $types[$model->cmsth_type]]
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
        $response = json_decode($response);
        if(!empty($response->success) && $tenderhdrfk){
            $tendertargetdtl = new \api\modules\pms\models\CmstendertargetdtlsTbl();
            $tendertargetdtl->cmsttd_cmstendertargethdr_fk = $tenderhdrfk;
            $tendertargetdtl->cmsttd_emailid = $emailid;
            $tendertargetdtl->cmsttd_emailstatus = 1;
            if($tendertargetdtl->save() == TRUE){
                
            }
        }
        $err = curl_error($curl);
        curl_close($curl);
        return true;
    }

    public function sendRfxEmail($model, $target, $template_id)
    {
        $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
        $emailid  = $target->cmstthMemberregmstFk->user->UM_EmailID;
        $tenderhdrfk = $target->cmstendertargethdr_pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
       
        $_data = [
            'email' => $emailid,
            'template_id'=> $template_id,
            'table_ref_key'=>'cmstenderhdr_pk',
            'table_ref_value'=> $model->cmstenderhdr_pk,
            'addi_params' => ['RFX_TYPE'=> $types[$model->cmsth_type]]
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
        $response = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        return true;
    }

    public function checkduplicaterfxrefid($data) {
        $refid = $data['refid'];
        $type = $data['type'];

        if($refid) {
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            $dataArray = CmstenderhdrTbl::find()
                ->select(["count(cmstenderhdr_pk) as totalcount"])
                ->where('cmsth_refno=:refid and cmsth_type=:type and cmsth_isdeleted != 1', array(':refid' => $refid, ':type' => $type))
                ->andWhere('cmsth_memcompmst_fk=:compk', array(':compk' => $company_id))
                ->asArray()
                ->one();  

            if($dataArray) {
                return $dataArray;
            } else {
                return false;
            }
        }

    }
    public static function getIssuedRfx() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $awardsReceived = CmstenderhdrTbl::find()
                ->select(["count(if(cmsth_type = 1, 1,null)) as 'rfiCount'","count(if(cmsth_type = 1 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'rfiPending'",
                    "count(if(cmsth_type = 2, 1,null)) as 'eoiCount'","count(if(cmsth_type = 2 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'eoiPending'",
                    "count(if(cmsth_type = 3, 1,null)) as 'pqCount'","count(if(cmsth_type = 3 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'pqPending'",
                    "count(if(cmsth_type = 4, 1,null)) as 'rfpCount'","count(if(cmsth_type = 4 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'rfpPending'",
                    "count(if(cmsth_type = 5, 1,null)) as 'rfqCount'","count(if(cmsth_type = 5 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'rfqPending'",
                    "count(if(cmsth_type = 6, 1,null)) as 'rftCount'","count(if(cmsth_type = 6 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'rftPending'",
                    "count(if(cmsth_type = 7, 1,null)) as 'sealedBidCount'","count(if(cmsth_type = 7 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'sealedBidPending'",
                    "count(if(cmsth_type = 8, 1,null)) as 'eAuctionCount'","count(if(cmsth_type = 8 and (cmsth_tenderstatus = 10 or cmsth_tenderstatus = 9), 1,null)) as 'eAuctionPending'",])
                ->where('cmsth_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsth_isdeleted = :data', array(':data' => 2))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $awardsReceived ? $awardsReceived : [],
        );
        return $result;
    }
    public static function getOpportunitiesSummary() {
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
                $open = (new \yii\db\Query())
                ->select(["count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedEOIOperCount'",
                    "count(if(cmsth_type = 2,1,null)) as 'receivedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 2,1,null)) as 'submittedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 5,1,null)) as 'shortlistedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 6,1,null)) as 'rejectedEOITotalCount'",
                    
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFIOperCount'",
                    "count(if(cmsth_type = 1,1,null)) as 'receivedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 2,1,null)) as 'submittedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 5,1,null)) as 'shortlistedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 6,1,null)) as 'rejectedRFITotalCount'",
                    
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFPOperCount'",
                    "count(if(cmsth_type = 4,1,null)) as 'receivedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 2,1,null)) as 'submittedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 5,1,null)) as 'shortlistedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 6,1,null)) as 'rejectedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPOperCount'",
                    "count(if(cmsth_type = 4 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPTotalCount'",
                    
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedPQOperCount'",
                    "count(if(cmsth_type = 3,1,null)) as 'receivedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 2,1,null)) as 'submittedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 5,1,null)) as 'shortlistedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 6,1,null)) as 'rejectedPQTotalCount'",
                    
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFQOperCount'",
                    "count(if(cmsth_type = 5,1,null)) as 'receivedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 2,1,null)) as 'submittedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 5,1,null)) as 'shortlistedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 6,1,null)) as 'rejectedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQOperCount'",
                    "count(if(cmsth_type = 5 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQTotalCount'",
                    
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFTOperCount'",
                    "count(if(cmsth_type = 6,1,null)) as 'receivedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 2,1,null)) as 'submittedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 5,1,null)) as 'shortlistedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 6,1,null)) as 'rejectedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTOperCount'",
                    "count(if(cmsth_type = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTTotalCount'",
                    ])
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->where('cmsth_isdeleted = :data and cmsth_tendertype = 1', array(':data' => 2));
        $target = (new \yii\db\Query())
                ->select(["count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedEOIOperCount'",
                    "count(if(cmsth_type = 2,1,null)) as 'receivedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 2,1,null)) as 'submittedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 5,1,null)) as 'shortlistedEOITotalCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedEOISuppCount'",
                    "count(if(cmsth_type = 2 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedEOIOperCount'",
                    "count(if(cmsth_type = 2 and ctr_status = 6,1,null)) as 'rejectedEOITotalCount'",
                    
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFIOperCount'",
                    "count(if(cmsth_type = 1,1,null)) as 'receivedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 2,1,null)) as 'submittedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 5,1,null)) as 'shortlistedRFITotalCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFISuppCount'",
                    "count(if(cmsth_type = 1 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFIOperCount'",
                    "count(if(cmsth_type = 1 and ctr_status = 6,1,null)) as 'rejectedRFITotalCount'",
                    
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFPOperCount'",
                    "count(if(cmsth_type = 4,1,null)) as 'receivedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 2,1,null)) as 'submittedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 5,1,null)) as 'shortlistedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFPOperCount'",
                    "count(if(cmsth_type = 4 and ctr_status = 6,1,null)) as 'rejectedRFPTotalCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPSuppCount'",
                    "count(if(cmsth_type = 4 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPOperCount'",
                    "count(if(cmsth_type = 4 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFPTotalCount'",
                    
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedPQOperCount'",
                    "count(if(cmsth_type = 3,1,null)) as 'receivedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 2,1,null)) as 'submittedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 5,1,null)) as 'shortlistedPQTotalCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedPQSuppCount'",
                    "count(if(cmsth_type = 3 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedPQOperCount'",
                    "count(if(cmsth_type = 3 and ctr_status = 6,1,null)) as 'rejectedPQTotalCount'",
                    
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFQOperCount'",
                    "count(if(cmsth_type = 5,1,null)) as 'receivedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 2,1,null)) as 'submittedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 5,1,null)) as 'shortlistedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFQOperCount'",
                    "count(if(cmsth_type = 5 and ctr_status = 6,1,null)) as 'rejectedRFQTotalCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQSuppCount'",
                    "count(if(cmsth_type = 5 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQOperCount'",
                    "count(if(cmsth_type = 5 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFQTotalCount'",
                    
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6,1,null)) as 'receivedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6,1,null)) as 'receivedRFTOperCount'",
                    "count(if(cmsth_type = 6,1,null)) as 'receivedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 2,1,null)) as 'submittedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 2,1,null)) as 'submittedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 2,1,null)) as 'submittedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 5,1,null)) as 'shortlistedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 5,1,null)) as 'shortlistedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 5,1,null)) as 'shortlistedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and ctr_status = 6,1,null)) as 'rejectedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and ctr_status = 6,1,null)) as 'rejectedRFTOperCount'",
                    "count(if(cmsth_type = 6 and ctr_status = 6,1,null)) as 'rejectedRFTTotalCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTSuppCount'",
                    "count(if(cmsth_type = 6 and mrm_stkholdertypmst_fk != 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTOperCount'",
                    "count(if(cmsth_type = 6 and cmsth_tenderstatus = 5,1,null)) as 'awardedRFTTotalCount'",
                    ])
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->where('cmsth_isdeleted = :data and cmsth_tendertype = 2 and cmstth_memberregmst_fk = :regPK', array(':data' => 2, ':regPK' => $regPK));
        
        $unionQuery = (new \yii\db\Query())
                ->select([
            'sum(receivedEOISuppCount) as receivedEOISuppCount', 'sum(receivedEOIOperCount) as receivedEOIOperCount', 'sum(receivedEOITotalCount) as receivedEOITotalCount',
            'sum(submittedEOISuppCount) as submittedEOISuppCount', 'sum(submittedEOIOperCount) as submittedEOIOperCount', 'sum(submittedEOITotalCount) as submittedEOITotalCount',
            'sum(shortlistedEOISuppCount) as shortlistedEOISuppCount', 'sum(shortlistedEOIOperCount) as shortlistedEOIOperCount', 'sum(shortlistedEOITotalCount) as shortlistedEOITotalCount',
            'sum(rejectedEOISuppCount) as rejectedEOISuppCount', 'sum(rejectedEOIOperCount) as rejectedEOIOperCount', 'sum(rejectedEOITotalCount) as rejectedEOITotalCount',
            
            'sum(receivedRFISuppCount) as receivedRFISuppCount', 'sum(receivedRFIOperCount) as receivedRFIOperCount', 'sum(receivedRFITotalCount) as receivedRFITotalCount',
            'sum(submittedRFISuppCount) as submittedRFISuppCount', 'sum(submittedRFIOperCount) as submittedRFIOperCount', 'sum(submittedRFITotalCount) as submittedRFITotalCount',
            'sum(shortlistedRFISuppCount) as shortlistedRFISuppCount', 'sum(shortlistedRFIOperCount) as shortlistedRFIOperCount', 'sum(shortlistedRFITotalCount) as shortlistedRFITotalCount',
            'sum(rejectedRFISuppCount) as rejectedRFISuppCount', 'sum(rejectedRFIOperCount) as rejectedRFIOperCount', 'sum(rejectedRFITotalCount) as rejectedRFITotalCount',
            
            'sum(receivedRFPSuppCount) as receivedRFPSuppCount', 'sum(receivedRFPOperCount) as receivedRFPOperCount', 'sum(receivedRFPTotalCount) as receivedRFPTotalCount',
            'sum(submittedRFPSuppCount) as submittedRFPSuppCount', 'sum(submittedRFPOperCount) as submittedRFPOperCount', 'sum(submittedRFPTotalCount) as submittedRFPTotalCount',
            'sum(shortlistedRFPSuppCount) as shortlistedRFPSuppCount', 'sum(shortlistedRFPOperCount) as shortlistedRFPOperCount', 'sum(shortlistedRFPTotalCount) as shortlistedRFPTotalCount',
            'sum(rejectedRFPSuppCount) as rejectedRFPSuppCount', 'sum(rejectedRFPOperCount) as rejectedRFPOperCount', 'sum(rejectedRFPTotalCount) as rejectedRFPTotalCount',
            
            'sum(receivedPQSuppCount) as receivedPQSuppCount', 'sum(receivedPQOperCount) as receivedPQOperCount', 'sum(receivedPQTotalCount) as receivedPQTotalCount',
            'sum(submittedPQSuppCount) as submittedPQSuppCount', 'sum(submittedPQOperCount) as submittedPQOperCount', 'sum(submittedPQTotalCount) as submittedPQTotalCount',
            'sum(shortlistedPQSuppCount) as shortlistedPQSuppCount', 'sum(shortlistedPQOperCount) as shortlistedPQOperCount', 'sum(shortlistedPQTotalCount) as shortlistedPQTotalCount',
            'sum(rejectedPQSuppCount) as rejectedPQSuppCount', 'sum(rejectedPQOperCount) as rejectedPQOperCount', 'sum(rejectedPQTotalCount) as rejectedPQTotalCount',
            
            'sum(receivedRFQSuppCount) as receivedRFQSuppCount', 'sum(receivedRFQOperCount) as receivedRFQOperCount', 'sum(receivedRFQTotalCount) as receivedRFQTotalCount',
            'sum(submittedRFQSuppCount) as submittedRFQSuppCount', 'sum(submittedRFQOperCount) as submittedRFQOperCount', 'sum(submittedRFQTotalCount) as submittedRFQTotalCount',
            'sum(shortlistedRFQSuppCount) as shortlistedRFQSuppCount', 'sum(shortlistedRFQOperCount) as shortlistedRFQOperCount', 'sum(shortlistedRFQTotalCount) as shortlistedRFQTotalCount',
            'sum(awardedRFQSuppCount) as awardedRFQSuppCount', 'sum(awardedRFQOperCount) as awardedRFQOperCount', 'sum(awardedRFQTotalCount) as awardedRFQTotalCount',
            
            'sum(receivedRFTSuppCount) as receivedRFTSuppCount', 'sum(receivedRFTOperCount) as receivedRFTOperCount', 'sum(receivedRFTTotalCount) as receivedRFTTotalCount',
            'sum(submittedRFTSuppCount) as submittedRFTSuppCount', 'sum(submittedRFTOperCount) as submittedRFTOperCount', 'sum(submittedRFTTotalCount) as submittedRFTTotalCount',
            'sum(shortlistedRFTSuppCount) as shortlistedRFTSuppCount', 'sum(shortlistedRFTOperCount) as shortlistedRFTOperCount', 'sum(shortlistedRFTTotalCount) as shortlistedRFTTotalCount',
            'sum(awardedRFTSuppCount) as awardedRFTSuppCount', 'sum(awardedRFTOperCount) as awardedRFTOperCount', 'sum(awardedRFTTotalCount) as awardedRFTTotalCount',
            ])
                ->from(['DataTable' => $open->union($target)]);

        $provider = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);

        $rows = $provider->getModels();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $rows[0] ? $rows[0] : [],
        );
        return $result;
    }
    public static function getCmsEngagements() {
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $open = (new \yii\db\Query())
                ->select(["count(cmstenderhdr_pk) as 'receivedCount'","count(if(ctr_status = 2,1,null)) as 'submittedCount'"])
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->where('cmsth_isdeleted = :data and cmsth_tendertype = 1', array(':data' => 2));
        $target = (new \yii\db\Query())
                ->select(["count(cmstenderhdr_pk) as 'receivedCount'","count(if(ctr_status = 2,1,null)) as 'submittedCount'"])               
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->where('cmsth_isdeleted = :data and cmsth_tendertype = 2 and cmstth_memberregmst_fk = :regPK', array(':data' => 2, ':regPK' => $regPK));
        
        $unionQuery = (new \yii\db\Query())
                ->select(['sum(receivedCount) as receivedCount', 'sum(submittedCount) as submittedCount'])
                ->from(['DataTable' => $open->union($target)]);
        $provider = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);

        $rows = $provider->getModels();
        $moduleData = CmstenderhdrTbl::find()
                ->select([
                    "count(if((cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) and cmscontracthdr_pk != null , 1,null)) as 'totalAwarded'",
                ])
                ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_shared_fk = cmstenderhdr_pk and cmsqft_shared_type = 2')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmsquotationhdr_fk = cmsquotationhdr_pk and cmsch_isdeleted = 2 and cmsch_createdon != null')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus in (1,2,3,4,6,5) and (cmsqh_memcompmst_fk = :compPK or cmsqft_memcompmst_fk = :compPK or ctr_memcompmst_fk = :compPK)', array(':delete' => 2,':compPK'=>$compPK))                
                ->asArray()
                ->one();
        $finalData =  array_merge($moduleData,$rows[0]);
        $finalData['bidsSubmitted'] =  0;
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $finalData ? $finalData: [],
        );
        return $result;
    }

    public function changestatus($ten_id, $status) { 

        if($ten_id) {

            $model = CmstenderhdrTbl::find()
                ->where("cmstenderhdr_pk =:pk", [':pk' =>  $ten_id])
                ->one();
            //developer note
            //before change status need to check respective conditions given in the document

            if($model) {
                if($status ==  6) {
                    $data['rfx_pk'] = $ten_id;
                    $can_terminate_arr =  self::canterminate($data);
                    if($can_terminate_arr['can_terminate']) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

                        $model->cmsth_tenderstatus = $status;
                        $model->cmsth_terminatedon = $date;
                        $model->cmsth_terminatedby = $userPK;
                        $model->cmsth_terminatedbyipaddr = $ip_address;

                    } else {
                        return array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $can_terminate_arr
                        ); 
                    }
                } else { 
                    $model->cmsth_tenderstatus = $status;
                }
             
                if($model->save() === true) {
                    if($status == 6 && !empty($model->cmstendertargethdrTbls)){
                        foreach($model->cmstendertargethdrTbls as $target){
                            if(!empty($target->cmstthMemberregmstFk->user->UM_EmailID)){
                                $this->sendRfxEmail($model, $target, $template_id = 248);
                            }
                        }
                    }
                    return array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Enquiry Status Updated Successfully!'
                    );
                } else {
                    return array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    ); 
                }
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }  
        }

    }

    public function publishscheduledrfx($rfx_id) { 
        $currentdate = date("Y-m-d H:i:s");
        $model = CmstenderhdrTbl::find()
            ->leftjoin('timezone_tbl', 'timezone_pk = cmsth_skd_timezone_fk')
            ->where("cmsth_skdtype = :type", [':type' =>  2])
            ->andWhere("cmsth_tenderstatus = :status", [':status' => 1])
            ->all();
            
        $error_count = 0;
        $date = new DateTime();
        $timeZone = $date->getTimezone();
        $timeZone->getName();

        if($model) {
            foreach($model as $key => $val) {
                $etender_time_zone = api\modules\mst\models\TimezoneTbl::find()->select(['timezone_pk','tz_countryname','tz_utcoffset'])
                    ->where('tz_status =:tz_status',[':tz_status' => 1])
                    ->where('timezone_pk =:tz_pk',[':tz_pk' => $model->cmsth_skd_timezone_fk])
                    ->one();
                    $timezone_converted_datetime = Common::convertTimezone($model->cmsth_skdstartdate, $etender_time_zone->tz_utcoffset, $timeZone->getName());
                    if($timezone_converted_datetime <= $currentdate) {
                        $val->cmsth_tenderstatus = 2;
                        if($val->save() === true) {
                            $data = $val->cmstenderhdr_pk . " / " . $val->cmsth_memcompmst_fk . " / " . $val->cmsth_skdstartdate . " / " . "success";
                            $logPath = __DIR__. "/../logs/logs.txt";
                            $mode = (!file_exists($logPath)) ? 'w':'a';
                            $logfile = fopen($logPath, $mode);
                            fwrite($logfile, "\r\n". $data);
                            fclose($logfile);
                        } else {
                            $data = $val->cmstenderhdr_pk . " / " . $val->cmsth_memcompmst_fk . " / " . $val->cmsth_skdstartdate . " / " . "failed";
                            $data .= $val->getErrors();
                            
                            $logPath = __DIR__. "/../logs/logs.txt";
                            $mode = (!file_exists($logPath)) ? 'w':'a';
                            $logfile = fopen($logPath, $mode);
                            fwrite($logfile, "\r\n". $data);
                            fclose($logfile); 
                            $error_count++;
                        }
                    }
                if($error_count > 0) {
                    return array(
                        'status' => 200,
                        'msg' => 'Failure',
                        'flag' => 'U',
                        'comments' => $val->getErrors()
                    );
                } else {
                    return array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Enquiry Status Updated Successfully!'
                    );
                }
            } 
        }
    } 

    public static function cancreaterfx($data) {
        if ($data) {
            $pk = $data['rfx_pk']; 
            $rfx_create = true;
            $rfi_create = true;
            $eoi_create = true;
            $pq_create = true;
            $rfp_create = true;
            $rfq_create = true;
            $rft_create = true;
            $refernce_enquiry_id = '';

            $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $pk])->one();

            if($model->crfd_rqprocesstype ==  3) { //if online tender
                $countquery = CmstenderhdrTbl::find()
                    ->select(['crfd_rqprocesstype as tender_process_type', 'crfd_rqtype as tender_type','cmstenderhdr_pk as ten_pk', 'cmsth_memcompmst_fk as comp_pk', 'cmsth_contracthdr_fk as contract_pk', 'cmsth_type as type', 'cmsth_tenderstatus as status'])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                    ->where('cmsth_cmsrequisitionformdtls_fk=:pk', array(':pk' => $pk))
                    ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                    // ->andWhere(['IN', 'cmsth_tenderstatus' , [3, 6]]) // shortlisted
                    ->orderBy(['cmstenderhdr_pk' => SORT_ASC])
                    ->asArray()
                    ->all(); 
                
                foreach($countquery as $key => $value) {
                    if($value['tender_process_type'] == '3') {
                        if($value['status'] != 2 && $value['status'] != 6) {
                            $rfx_create = false;
                            return $rfx_validation = array(
                                'rfx_create' => $rfx_create, 
                                'active_enquiry' => $value['type'], 
                            );
                        } else {
                            $rfx_create = true;
                            $refernce_enquiry_id = $value['cmstenderhdr_pk'] ? $value['cmstenderhdr_pk'] : $value['cmsth_cmstenderhdr_fk'];
                            if($value['type'] == 1) { //rfi
                                if($value['status'] == 6) {
                                    $rfi_create = true;
                                } else {
                                    $rfi_create = false;
                                }
                                $eoi_create = true;
                                $pq_create = true;
                                // $rfp_create = true;
                                $rfq_create = true;
                                if($value['tender_type'] == 2) { // 1 - Product, 2 - Service
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                }
                            } else if($value['type'] == 2) { //eoi
                                $rfi_create = false;
                                if($value['status'] == 6) {
                                    $eoi_create = true;
                                } else {
                                    $eoi_create = false;
                                }
                                $pq_create = true;
                                // $rfp_create = true;
                                $rfq_create = true;
                                if($value['tender_type'] == 2) {
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                }
                            } else if($value['type'] == 3) { //pq
                                $rfi_create = false;
                                $eoi_create = false;
                                if($value['status'] == 6) {
                                    $pq_create = true;
                                } else {
                                    $pq_create = false;
                                }
                                // $rfp_create = true;
                                $rfq_create = true;
                                if($value['tender_type'] == 2) {
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                }
                            } else if($value['type'] == 4) { //rfp
                                $rfi_create = false;
                                $eoi_create = false;
                                $pq_create = false;
                                if($value['status'] == 6) {
                                    $rfp_create = true;
                                } else {
                                    $rfp_create = false;
                                }
                                $rfq_create = true;
                                if($value['tender_type'] == 2) {
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                } 
                            } else if($value['type'] == 5) { // rfq
                                $rfi_create = false;
                                $eoi_create = false;
                                $pq_create = false;
                                // $rfp_create = true;
                                if($value['status'] == 6) {
                                    $rfq_create = true;
                                } else {
                                    $rfq_create = false;
                                }
                                if($value['tender_type'] == 2) {
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                } 
                            } else if($value['type'] == 6) { //rft
                                $rfi_create = false;
                                $eoi_create = false;
                                $pq_create = false;
                                // $rfp_create = false;
                                $rfq_create = false;
                                if($value['status'] == 6 && $value['tender_type'] == 2) {
                                    $rft_create = true;
                                } else {
                                    $rft_create = false;
                                }
                            }   
                        }
                    } else {
                        $rfx_create = false;
                        return $rfx_validation = array(
                            'rfx_create' => $rfx_create, 
                            'error' => "You can't create etender for tender which are not online tenders", 
                        );
                    }
                }
            } else {
                $rfx_create = false;
                $rfi_create = false;
                $eoi_create = false;
                $pq_create = false;
                $rfp_create = false;
                $rfq_create = false;
                $rft_create = false;
                $rft_create = false;
            }
            
            $rfx_validation = array(
                'rfx_create' => $rfx_create, 
                'rfi_create' => $rfi_create,
                'eoi_create' => $eoi_create,
                'pq_create' => $pq_create, 
                'rfp_create' => $rft_create, 
                'rfq_create' => $rfq_create, 
                'rft_create' => $rft_create, 
                'refernce_enquiry_id' => $refernce_enquiry_id
            );

            return $rfx_validation; 
        }
    } 
    public static function getOpportunitiesEnquiries() {
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $recentTargetedEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmstenderhdr_pk','cmsth_type','cmsth_isicv'])
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and cmstth_memberregmst_fk = :regPK and cmsth_tendertype = 2', array(':delete' => 2,':regPK'=>$regPK))
                ->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")])
                ->limit(2)
                ->asArray()
                ->all();
        $recentOpenEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmstenderhdr_pk','cmsth_type','cmsth_isicv'])
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and cmsth_tendertype = 1', array(':delete' => 2))
                ->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")])
                ->limit(2)
                ->asArray()
                ->all();
        $nearestTargetedEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmstenderhdr_pk','cmsth_type','cmsth_isicv'])
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and cmstth_memberregmst_fk = :regPK and cmsth_tendertype = 2 and cmsth_skdclosedate is not null', array(':delete' => 2,':regPK'=>$regPK))
                ->orderBy('cmsth_skdclosedate DESC')
                ->limit(2)
                ->asArray()
                ->all();
        $nearestOpenEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmstenderhdr_pk','cmsth_type','cmsth_isicv'])
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and cmsth_tendertype = 1 and cmsth_skdclosedate is not null', array(':delete' => 2))
                ->orderBy('cmsth_skdclosedate DESC')
                ->limit(2)
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'recentTargetedEnquiries' => $recentTargetedEnquiries ? $recentTargetedEnquiries : [],
            'recentOpenEnquiries' => $recentOpenEnquiries ? $recentOpenEnquiries : [],
            'nearestTargetedEnquiries' => $recentTargetedEnquiries ? $recentTargetedEnquiries : [],
            'nearestOpenEnquiries' => $recentOpenEnquiries ? $recentOpenEnquiries : [],
        );
        return $result;
    }
    public static function getGeneralOpportunity() {
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $open = (new \yii\db\Query())
                ->select(['count(cmstenderhdr_pk) as totalEnquiries',
                    "count(if(cmsth_obligation = 5 , 1,null)) as 'generalEnquiries'",
                    "count(if(cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3  , 1,null)) as 'obligatedEnquiries'"
                ])
                ->from('cmstenderhdr_tbl')
                ->where('cmsth_isdeleted=:delete and cmsth_tendertype = 1 and cmsth_obligation != 4 and cmsth_obligation is not null', array(':delete' => 2));

        $target = (new \yii\db\Query())
                ->select(['count(cmstenderhdr_pk) as totalEnquiries',
                    "count(if(cmsth_obligation = 5 , 1,null)) as 'generalEnquiries'",
                    "count(if(cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3  , 1,null)) as 'obligatedEnquiries'"
                ])
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->where('cmsth_isdeleted=:delete and cmsth_tendertype = 2 and cmstth_memberregmst_fk = :regPK and cmsth_obligation != 4 and cmsth_obligation is not null', array(':delete' => 2, ':regPK' => $regPK));
        $unionQuery = (new \yii\db\Query())->select(['sum(totalEnquiries) as totalEnquiries', 'sum(generalEnquiries) as generalEnquiries', 'sum(obligatedEnquiries) as obligatedEnquiries',])
                ->from(['DataTable' => $open->union($target)]);

        $provider = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);

        $rows = $provider->getModels();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $rows[0] ? $rows[0] : [],
        );
        return $result;
    }

    public static function getEngagedOpportunity() {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $open = (new \yii\db\Query())
                ->select(['count(cmstenderhdr_pk) as totalEnquiries',
                    "count(if(cmsth_obligation = 5 , 1,null)) as 'generalEnquiries'",
                    "count(if(cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3  , 1,null)) as 'obligatedEnquiries'"
                ])
                ->from('cmstenderhdr_tbl')
                ->where('cmsth_isdeleted=:delete and cmsth_tendertype = 1 and cmsth_obligation != 4 and cmsth_obligation is not null', array(':delete' => 2));

        $target = (new \yii\db\Query())
                ->select(['count(cmstenderhdr_pk) as totalEnquiries',
                    "count(if(cmsth_obligation = 5 , 1,null)) as 'generalEnquiries'",
                    "count(if(cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3  , 1,null)) as 'obligatedEnquiries'"
                ])
                ->from('cmstenderhdr_tbl')
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->where('cmsth_isdeleted=:delete and cmsth_tendertype = 2 and cmstth_memberregmst_fk = :regPK and cmsth_obligation != 4 and cmsth_obligation is not null', array(':delete' => 2, ':regPK' => $regPK));
        $unionQuery = (new \yii\db\Query())->select(['sum(totalEnquiries) as totalEnquiries', 'sum(generalEnquiries) as generalEnquiries', 'sum(obligatedEnquiries) as obligatedEnquiries',])
                ->from(['DataTable' => $open->union($target)]);

        $provider = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);

        $rows = $provider->getModels();
        $moduleData = CmstenderhdrTbl::find()
                ->select([
                    "count(if((cmsth_type = 1 and cmstenderresponse_pk != null) or (cmsth_type = 2 and cmstenderresponse_pk != null) or (cmsth_type = 3 and cmsquestionnaireformtrnx_pk != null) or (cmsth_type = 4 and cmsquotationhdr_pk != null) , 1,null)) as 'totalRfiEoiPqRFP'",
                    "count(if(cmsth_obligation = 5 and (cmsth_type = 1 and cmstenderresponse_pk != null) or (cmsth_type = 2 and cmstenderresponse_pk != null) or (cmsth_type = 3 and cmsquestionnaireformtrnx_pk != null) or (cmsth_type = 4 and cmsquotationhdr_pk != null) , 1,null)) as 'generalRfiEoiPqRFP'",
                    "count(if((cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3 ) and (cmsth_type = 1 and cmstenderresponse_pk != null) or (cmsth_type = 2 and cmstenderresponse_pk != null) or (cmsth_type = 3 and cmsquestionnaireformtrnx_pk != null) or (cmsth_type = 4 and cmsquotationhdr_pk != null) , 1,null)) as 'obligatedRfiEoiPqRFP'",
                    
                    "count(if((cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) , 1,null)) as 'totalRfqRft'",
                    "count(if(cmsth_obligation = 5 and (cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) , 1,null)) as 'generalRfqRft'",
                    "count(if((cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3 ) and (cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) , 1,null)) as 'obligatedRfqRft'",
                    "count(if((cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) and cmscontracthdr_pk != null , 1,null)) as 'totalAwarded'",
                    "count(if((cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) and cmsth_obligation = 5 and  cmscontracthdr_pk != null , 1,null)) as 'generalAwarded'",
                    "count(if((cmsth_type = 5 and cmsquotationhdr_pk != null) or (cmsth_type = 6 and cmsquotationhdr_pk != null) and (cmsth_obligation = 1 or cmsth_obligation = 2 or cmsth_obligation = 3 ) and  cmscontracthdr_pk != null , 1,null)) as 'obligatedAwarded'",
                ])
                ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_shared_fk = cmstenderhdr_pk and cmsqft_shared_type = 2')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmsquotationhdr_fk = cmsquotationhdr_pk and cmsch_isdeleted = 2 and cmsch_createdon != null')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus in (1,2,3,4,6,5) and (cmsqh_memcompmst_fk = :compPK or cmsqft_memcompmst_fk = :compPK or ctr_memcompmst_fk = :compPK)', array(':delete' => 2,':compPK'=>$compPK))                
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $moduleData ? array_merge($moduleData,$rows[0]) : [],
        );
        return $result;
    }
    
    public static function getEngagementEnquiries() {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $respondedTargetedEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmsth_type','cmsqh_uid','cmsqh_quotationtitle',
                    "ROUND(IF(cmsqh_scope_currencymst_fk = 3, cmsqh_grandtotalamount * 2.60080, cmsqh_grandtotalamount),2) as 'grandtotalamountUSD'",
                    "ROUND(IF(cmsqh_scope_currencymst_fk = 21, cmsqh_grandtotalamount / 2.60080, cmsqh_grandtotalamount),3) as 'grandtotalamountOMR'",
                    'cmsqh_status','cmsquotationhdr_pk','DATE_FORMAT(cmsqh_createdon,"%d-%m-%Y") as QuotationData','DATE_FORMAT(ctr_createdon,"%d-%m-%Y") as RfiEoiData','DATE_FORMAT(cmsqft_createdon,"%d-%m-%Y") as PqData','cmstenderhdr_pk','cmsquotationhdr_pk','cmsth_isicv','cmstenderhdr_pk','cmsth_tendertype'])
                ->leftJoin('cmstendertargethdr_tbl', 'cmstth_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_shared_fk = cmstenderhdr_pk and cmsqft_shared_type = 2')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and cmsth_tendertype = 2 and (cmsqh_memcompmst_fk = :compPK or cmsqft_memcompmst_fk = :compPK or ctr_memcompmst_fk = :compPK)', array(':delete' => 2,':compPK'=>$compPK))
                ->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon,cmsqh_updatedon,cmsqh_createdon,cmsqft_createdon,cmsqft_updatedon,ctr_createdon,ctr_updatedon) DESC")])
                ->limit(2)
                ->asArray()
                ->all();
        $respondedOpenEnquiries = CmstenderhdrTbl::find()
                ->select(['cmsth_uid', 'cmsth_title', 'DATE_FORMAT(cmsth_skdclosedate,"%d-%m-%Y") as closingDate', 'cmsth_tenderstatus as status', 'DATE_FORMAT(cmsth_createdon,"%d-%m-%Y") as createdOn', 'MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','cmsth_obligation','cmsth_msmepercent','cmsth_lccpercent','cmsth_isetendmandate','cmsth_type','cmsqh_uid','cmsqh_quotationtitle',
                    "ROUND(IF(cmsqh_scope_currencymst_fk = 3, cmsqh_grandtotalamount * 2.60080, cmsqh_grandtotalamount),2) as 'grandtotalamountUSD'",
                    "ROUND(IF(cmsqh_scope_currencymst_fk = 21, cmsqh_grandtotalamount / 2.60080, cmsqh_grandtotalamount),3) as 'grandtotalamountOMR'",
                    'cmsqh_status','cmsquotationhdr_pk','DATE_FORMAT(cmsqh_createdon,"%d-%m-%Y") as QuotationData','DATE_FORMAT(ctr_createdon,"%d-%m-%Y") as RfiEoiData','DATE_FORMAT(cmsqft_createdon,"%d-%m-%Y") as PqData','cmstenderhdr_pk','cmsquotationhdr_pk','cmsth_isicv','cmstenderhdr_pk','cmsth_tendertype'])
                ->leftJoin('cmsquotationhdr_tbl', 'cmsqh_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsqft_shared_fk = cmstenderhdr_pk and cmsqft_shared_type = 2')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_cmstenderhdr_fk = cmstenderhdr_pk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                ->where('cmsth_isdeleted=:delete and cmsth_tenderstatus not in (4,6,7) and  cmsth_tendertype = 1 and (cmsqh_memcompmst_fk = :compPK or cmsqft_memcompmst_fk = :compPK or ctr_memcompmst_fk = :compPK)', array(':delete' => 2,':compPK'=>$compPK))
                ->orderBy([new \yii\db\Expression("coalesce(cmsth_updatedon,cmsth_createdon) DESC")])
                ->limit(2)
                ->asArray()
                ->all();        
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'respondedTargetedEnquiries' => $respondedTargetedEnquiries ? $respondedTargetedEnquiries : [],
            'respondedOpenEnquiries' => $respondedOpenEnquiries ? $respondedOpenEnquiries : [],
        );
        return $result;
    }

    /**
     * Audit Log List
     */
    public function auditLoglist($rfxpk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $resdata = [];
        $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
        if($rfxpk){
            $tender = CmstenderhdrTbl::findOne($rfxpk);
            $historyArr = [];
            if(!empty($tender)){
                $resdata = self::getTenderBasicInfo($tender);
                $resdata['type'] = $types[$tender->cmsth_type];
                if(!empty($tender->cmstenderhdrhstyTbls)){
                    foreach($tender->cmstenderhdrhstyTbls as $history){
                        $info = self::getTenderHistoryBasicInfo($history);
                        $info['key'] = $history->cmstenderhdrhsty_pk;
                        $info['view'] = '';
                        $info['download'] = '';
                        $historyArr[] = $info;
                    }
                }
                if(!empty($tender->membercompanymsttbl)){
                    $resdata['company'] = $tender->membercompanymsttbl->MCM_CompanyName;
                    $resdata['logo_id'] = $tender->membercompanymsttbl->mcm_complogo_memcompfiledtlsfk;
                    $resdata['company_id'] = $tender->membercompanymsttbl->MemberCompMst_Pk;
                }
                $resdata['history'] = $historyArr;
            }
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'returndata' => $resdata
        );
        return $result;
    }

   /**
     * Audit Log Show
     */
   public function auditLogshow($data){  
         Yii::$app->db->createCommand('SET SESSION wait_timeout = 2880000;')->execute();
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $resdata = [];
        $rfxpk = $data['rfx_pk'];
        $download = $data['download'];
       
        if($rfxpk){
            $tender = CmstenderhdrTbl::findOne($rfxpk);
            $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
            if(!empty($tender)){
                $targetedCount = 0;
                $targetedSuppliers = [];
                $company = '';
                $resdata = self::getTenderBasicInfo($tender); 
                if(!empty($tender->membercompanymsttbl)){
                    $company = $tender->membercompanymsttbl->MCM_CompanyName;
                }
                $resdata['company'] = $company;
                $resdata['report_generatedon'] = date('d-m-Y'). ' | '. date('H:i A');
                $resdata['type'] = $types[$tender->cmsth_type];
             
                if(!empty($tender->cmstendertargethdrTbls)){
                   $targetedCount = $tender->getCmstendertargethdrTbls()->count();
                   foreach($tender->cmstendertargethdrTbls as $target){
                       $jsrsStatus = '-';
                       $companyName = '-';
                       $bidder_opened = '-';
                       $bidder_interested = '-';
                       $bidder_notinterested = '-';
                       $bidder_shortlisted = '-';
                       $bidder_rejected = '-';
                       $bidder_opened_count = 0;
                       $bidder_interested_count = 0;
                       $bidder_notinterested_count = 0;
                       $bidder_shortlisted_count = 0;
                       $bidder_rejected_count = 0;

                        if(!empty($target->cmstthMemberregmstFk->company)){
                            $jsrsStatus = $target->cmstthMemberregmstFk->company->getJsrsstatus();
                            $companyName = $target->cmstthMemberregmstFk->company->MCM_CompanyName;
                        }
                        if($target->cmsTender) {
                            $tender = $target->cmsTender;
                            $tenderResponse = $tender->getCmstenderresponseTbls()->where(['ctr_memcompmst_fk' => $tender->cmsth_memcompmst_fk])->one();
                            if(!empty($tenderResponse)){
                                if($tenderResponse->ctr_status == 2){
                                    $bidder_interested = 'Yes';
                                    $bidder_interested_count++;
                                } else if($tenderResponse->ctr_status == 8){
                                    $bidder_notinterested = 'Yes';
                                    $bidder_notinterested_count++;
                                } 
                                else if($tenderResponse->ctr_status == 5){
                                    $bidder_shortlisted = 'Yes';
                                    $bidder_shortlisted_count++;
                                } 
                                else if($tenderResponse->ctr_status == 6){
                                    $bidder_rejected = 'Yes';
                                    $bidder_rejected_count++;
                                } 
                            }
                        }
                        $mail_status = '';
                
                        if(!empty($target->cmstendertargetdtlsTbl)){
                            if($target->cmstendertargetdtlsTbl->cmsttd_emailstatus == 1){
                                $mail_status = 'Sent';
                            } else if($target->cmstendertargetdtlsTbl->cmsttd_emailstatus == 2){
                                $mail_status = 'Bounced';
                            } else if($target->cmstendertargetdtlsTbl->cmsttd_emailstatus == 3){
                                $mail_status = 'Opened';
                            } else if($target->cmstendertargetdtlsTbl->cmsttd_emailstatus == 4){
                                $mail_status = 'Clicked';
                            }
                        }
                        
                        $targetedSuppliers[] = [
                            'jsrs_status' => $jsrsStatus,
                            'company_name' => $companyName,
                            'mail_status' => $mail_status,
                            'opened' => '',
                            'interested' => $bidder_interested,
                            'not_interested' => $bidder_notinterested,
                            'shortlisted' => $bidder_shortlisted,
                            'rejected' => $bidder_rejected,
                        ];
                   }
                }
           
                $resdata['statistics'] = [
                    'targeted' => $targetedCount,
                    'opened' => $bidder_opened_count,
                    'interested' => $bidder_interested_count,
                    'not_interested' => $bidder_notinterested_count,
                    'shortlisted' => $bidder_shortlisted_count,
                    'rejected' => $bidder_rejected_count,
                ];
                $resdata['targeted_suppliers'] = $targetedSuppliers;
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $resdata
            );
           
            if($download){
                $baseUrl = \Yii::$app->params['baseUrl'];
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 5,
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_bottom' => 5,
                'autoPageBreak' => true,
                'default_font' => 'cairoregular',
                'format' => [250, 330]]);
                $mpdf->shrink_tables_to_fit = 1;		
                $mpdf->SetWatermarkImage($baseUrl.'assets/images/jsrs-logo-icon.png');
                $mpdf->watermarkImageAlpha = .5;
                $mpdf->showWatermarkImage = true;
                $mpdf->WriteHTML(Yii::$app->controller->renderPartial('//../../api/modules/rfx/views/rfx/rfxauditlog',['data'=>$data['returndata']]));
                $downloadpath = \Yii::$app->params['api_download_path']['rfxauditLog'];
                $path = $downloadpath.'/'.$rfxpk;
                if(!is_dir($path)){
                    mkdir($path, 0777, true);
                } 
                $filepath = $path.'/'.time().'.pdf';
                $mpdf->Output($filepath,'F'); 
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'url' => \Yii::$app->params['backendBaseUrl'].'api/'.$filepath
                );
            }
        }
        return $result;
    }

    public static function getTenderBasicInfo($tender){
        $createdBy = '';
        if(!empty($tender->cmsthCreatedby)){
            $createdBy = $tender->cmsthCreatedby->um_firstname;
            if($tender->cmsthCreatedby->um_middlename){
                $createdBy .= ' '.$tender->cmsthCreatedby->um_middlename;
            }
            if($tender->cmsthCreatedby->um_lastname){
                $createdBy .= ' '.$tender->cmsthCreatedby->um_lastname;
            }
        }

        $info = [
            'title' =>  $tender->cmsth_title,
            'refno' => $tender->cmsth_refno,
            'status' => self::getrfxstatusvalue($tender),
            'closing_date' => $tender->cmsth_skdclosedate,
            'created_on' => $tender->cmsth_createdon,
            'created_on' => $tender->cmsth_createdon,
            'created_by' => $createdBy,
            'targeted_suppliers_count' => !empty($tender->cmstendertargethdrTbls) ?  $tender->getCmstendertargethdrTbls()->count() : 0
        ];
        return  $info;
    }

    public static function getTenderHistoryBasicInfo($tender){
        $createdBy = '';
        if(!empty($tender->cmsthhCreatedby)){
            $createdBy = $tender->cmsthhCreatedby->um_firstname;
            if($tender->cmsthhCreatedby->um_middlename){
                $createdBy .= ' '.$tender->cmsthhCreatedby->um_middlename;
            }
            if($tender->cmsthhCreatedby->um_lastname){
                $createdBy .= ' '.$tender->cmsthhCreatedby->um_lastname;
            }
        }

        $info = [
            'title' =>  $tender->cmsthh_title,
            'refno' => $tender->cmsthh_refno,
            'status' => self::getrfxhisstatusvalue($tender),
            'closing_date' => $tender->cmsthh_skdclosedate,
            'created_on' => $tender->cmsthh_createdon,
            'created_on' => $tender->cmsthh_createdon,
            'created_by' => $createdBy,
            'targeted_suppliers_count' => !empty($tender->cmstendertargethdrhstyTbls) ?  $tender->cmstendertargethdrhstyTbls()->count() : 0
        ];
        return  $info;
    }
    
    public static function canterminate($data) {
        if ($data) {
            $pk = $data['rfx_pk']; 
            $can_terminate = true;

            $rfx_data = CmstenderhdrTbl::findOne($pk);
            $rfxstatus = $rfx_data->cmsth_tenderstatus;
            
            if($rfxstatus == 2) {
                $is_subsequence_etender_available = self::get_subsequence_etender($pk , $rfx_data->cmsth_type);
                if(in_array(true, array_values($is_subsequence_etender_available))) {
                    $can_terminate = false;
                    $can_terminate_array = array(
                        'status' => 200,
                        'msg' => 'Error', 
                        'flag' => 'E', 
                        'comments' => "You can't terminate active etender sequence",
                        'can_terminate' => $can_terminate,
                        'etenders_status' => $is_subsequence_etender_available
                    );
                } else {
                    $contracts = CmscontracthdrTbl::find()->where(['cmsth_cmstenderhdr_fk' => $pk])->all();
                    if(count($contracts) > 0) {
                        $can_terminate = false;
                    } else {
                        $can_terminate = true;
                    }
                    $can_terminate_array = array(
                        'status' => 200,
                        'msg' => 'success', 
                        'comments' => "You can't terminate as etender having contract",
                        'can_terminate' => $can_terminate,
                        'etenders_status' => $is_subsequence_etender_available,
                        'contract_status' => $contracts,
                    );
                }
            } else { 
                return $can_terminate_array = array(
                    'status' => 200,
                    'msg' => 'Error',
                    'flag' => 'E',
                    'comments' => "You can't terminate active etender",
                    'can_terminate' => false
                );
            }
            
            return $can_terminate_array;  
        }  
    }

    public static function gettenderstatus($pk) {
        if($pk) {
            $statusquery = CmstenderhdrTbl::find()
                ->select(['cmsth_tenderstatus as status'])
                ->where('cmstenderhdr_pk=:pk', array(':pk' => $pk))
                ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                ->asArray()
                ->all(); 
            if($statusquery) {
                return $statusquery[0]['status'];
            }
        }
    }

    public static function get_subsequence_etender($pk, $type) {
        $rfi_available = false;
        $eoi_available = false;
        $pq_available = false;
        $rfp_available = false;
        $rfq_available = false;
        $rft_available = false;

        if($pk) {
            foreach(self::ENQURY_TYPE_TO_CHECK_FOR_CREATE[$type] as $key => $val) {
                $subsequence_etender = CmstenderhdrTbl::find()
                    ->select(['count(*) as count'])
                    ->where('cmsth_cmstenderhdr_fk=:fk', array(':fk' => $pk))
                    ->andWhere('cmsth_tenderstatus !=:status', array(':status' => 6))
                    ->andWhere('cmsth_isdeleted=:isdel', [':isdel' => 2])
                    ->andWhere('cmsth_type=:type', array(':type' => $val))
                    ->asArray()
                    ->all(); 
                    if($subsequence_etender[0]['count'] > 0) {
                        ${self::ENQURY_TYPES[$val] . '_available'} = false;
                    } else {
                        ${self::ENQURY_TYPES[$val] . '_available'} = true;
                    }
            }
            $rfx_creation = array(
                'rfi_available' => $rfi_available,
                'eoi_available' => $eoi_available,
                'pq_available' => $pq_available, 
                'rfp_available' => $rfp_available, 
                'rfq_available' => $rfq_available, 
                'rft_available' => $rft_available, 
            );
            return $rfx_creation; 
        }
    }

    public static function getrfxstatusvalue($model) {
        // db values
        // 1 - Yet to Submit, 2 - Submitted, 
        // 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 
        // 6 - Terminated, 7 - Closed, 8 - Yet to Award, 
        // 9 - Yet to Shortlist, 10 - Shortlisting in Progress
        if($model) {
            $status = '';
            if($model['cmsth_tenderstatus'] != '2' && $model['cmsth_skdtype'] != '2') {
                $status = 'Yet to Publish';
            } else if($model['cmsth_skdtype'] == 2){
                $status = 'Scheduled to Publish Later';
            } else if($model['cmsth_tenderstatus'] == 2 && count($model['cmstenderresponseTbls']) == 0){
                $status = 'Published';
            } else if($model['cmsth_tenderstatus'] == 6){
                $status = 'Terminated';
            } else if($model['cmsth_tenderstatus'] == 4){
                $status = 'Rejected';
            } else if($model['cmsth_tenderstatus'] == 5){
                $status = 'Awarded'; // not required here
            }  

            if($model['cmstenderresponseTbls']) {
                $overall_response = count($model['cmstenderresponseTbls']);

                $all_response_alone_array = array_map(function($val) {
                    return $val['ctr_status'];
                }, $model['cmstenderresponseTbls']);

                $counts_of_status = array_count_values($all_response_alone_array);
                if($counts_of_status[5] == $overall_response) {
                    $status = 'Yet to Award'; // Evaluation completed
                } else if($counts_of_status[2] == $overall_response) {
                    $status = 'Yet to Evaluate';
                } else if($counts_of_status[5] != $overall_response) {
                    $status = 'Evaluation In-progress';
                } else if($counts_of_status[6] != $overall_response) {
                    $status = 'Rejected';
                }  
            } 
            
            if($status) {
                return array('status_name' => $status, 'icon' => "", "class" => ""); 
            }
        }
    } 

    public static function getrfxhisstatusvalue($model) {
        // db values
        // 1 - Yet to Submit, 2 - Submitted, 
        // 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 
        // 6 - Terminated, 7 - Closed, 8 - Yet to Award, 
        // 9 - Yet to Shortlist, 10 - Shortlisting in Progress
        if($model) {
            $status = '';
            if($model['cmsthh_tenderstatus'] != '2' && $model['cmsthh_skdtype'] != '2') {
                $status = 'Yet to Publish';
            } else if($model['cmsthh_skdtype'] == 2){
                $status = 'Scheduled to Publish Later';
            } else if($model['cmsthh_tenderstatus'] == 2){
                $status = 'Published';
            } else if($model['cmsthh_tenderstatus'] == 6){
                $status = 'Terminated';
            } else if($model['cmsthh_tenderstatus'] == 4){
                $status = 'Rejected';
            } else if($model['cmsthh_tenderstatus'] == 5){
                $status = 'Awarded'; // not required here
            } 
            
            if($status) {
                return array('status_name' => $status, 'icon' => "", "class" => ""); 
            }
        }
    } 

    public static function compareSupplierExcelExport($dataArray = [], $headArray = []) {
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        $inputFileName = Yii::$app->params['evaluationCompareListPath'];
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
        
        $row = 9;
        foreach($headArray as $key => $value) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$row++, $value);
        }
        
        $col = 'B';
        foreach($dataArray as $key => $value) {
            $row = 9;
            foreach($value as $subKey => $subVal) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row++, $subVal);
            }    
            $col++;
        }

        $user_name = \yii\db\ActiveRecord::getTokenData('user_name', true);
        $compnay_name = \yii\db\ActiveRecord::getTokenData('MCM_CompanyName', true);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C7', date('d-M-Y'));
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F7', $user_name);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H7', $compnay_name);

        // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Simple');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $save_path = Yii::$app->basePath.'/web/generated/exported/evaluation/' . $compnay_name .date('d-M-Y-His') . '.xlsx';
        $save_link = Yii::$app->urlManager->createAbsoluteUrl(['web/generated/exported/evaluation']) . '/' . $compnay_name .date('d-M-Y-His') . '.xlsx';
        
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $save_path . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        
        $writer = new Xlsx($spreadsheet);
        fopen($save_path, "w");
        $writer->save($save_path);
        // $writer->save("php://output");
        return $save_link;
    }

    public function rfxrepublish($rfx_id) {        
        //  api\modules\pms\models
        /*$targetmodel = new CmstendertargethdrhstyTbl(); 
        $targetmodel->cmstthh_cmstendertargethdr_fk = 2338;
        // $targetmodel->cmstthh_cmstendertargethdr_fk = 2309;
        $targetmodel->cmstthh_cmstenderhdrhsty_fk  = 637;179
        $targetmodel->cmstthh_memberregmst_fk  = 6;
        $targetmodel->cmstthh_targettype  = 2;
        if(!$targetmodel->save()){
            print_r($targetmodel->getErrors());
            cmstth_cmstenderhdr_fk
        }
        exit;*/
        if($rfx_id) {
            $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
            $model = CmstenderhdrtempTbl::find()
            ->where("cmstenderhdrtemp_pk =:pk", [':pk' =>  $rfx_id])
            ->one();
            // $isrfxhavingchanges = self::isrfxhavingchanges($rfx_id,$model);
           
            $tender = CmstenderhdrTbl::find()->where(['cmsth_cmstenderhdrtemp_fk' => $rfx_id])->one();

            $auditlogdata['rfx_pk'] = $tender['cmstenderhdr_pk'];
            $auditlogdata['download'] = true;
            $isrfxhavingchanges = self::isrfxhavingchanges($rfx_id,$model,$tender['cmstenderhdr_pk']);
           
           
            $audit_log = CmstenderhdrTblQuery::auditLogshow($auditlogdata);
           
            
            $moving_maintohistory = \api\modules\pms\models\CmstenderhdrtempTblQuery::copyingrfxdata($tender, 'maintohistory','web'); 
            $moving_temptomain = \api\modules\pms\models\CmstenderhdrtempTblQuery::copyingrfxdata($model, 'temptomain','web');
            CmstenderhdrtempTblQuery::insertnoticerecord($model,$regPk);
            if($isrfxhavingchanges) {
                // Mail has to send accordingly
            } 

        } else {
            $result = array(
                'status' => 200,
                'msg' => 'Error',
                'flag' => 'E',
                'returndata' => 'Something went wrong!!'
            ); 
        }

        return $result;
    }

    public function isrfxhavingchanges($rfx_id,$model=NULL,$tender_pk) {
        if($rfx_id) {
            // echo 86;exit;
            $main_tables_data = [];
            $temp_tables_data = [];

            $main_data = self::getRFXDetails($rfx_id);
            $temp_data = CmstenderhdrtempTblQuery::getRFXDetails($rfx_id);

            $main_tables_data['details'] = $main_data;
            $temp_tables_data['details'] = $temp_data;

            $rfx_type = $main_data['cmsth_type'];

            $temp_product = \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::getProductListtemp($rfx_id, 3);
            $main_product = \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getProductList($rfx_id, 3);

            $main_tables_data['productservice'] = $main_product;
            $temp_tables_data['productservice'] = $temp_product;

            if($rfx_type == 5) {
                $scope_headers = \api\modules\pms\models\CmstnchdrTblQuery::GetSupplierUserData(4); // 4 - RFQ Scope type in cmstnchdrtbl
                if($scope_headers) {
                    foreach($scope_headers as $shkey => $shvalue) {
                        $temp_scope[] = \api\modules\pms\models\CmstnctrnxtempTblQuery::getDynamicViewListtemp($rfx_id, 2, $shvalue['cmstnchdr_pk']);
                        $main_scope[] = \api\modules\pms\models\CmstnctrnxTblQuery::getDynamicViewList($rfx_id, 2, $shvalue['cmstnchdr_pk']);
                    }
                }
            }

            $main_tables_data['scope'] = $main_scope;
            $temp_tables_data['scope'] = $temp_scope;
            
            $temp_support_doc = \api\modules\pms\models\CmssupdocumenttempTblQuery::getDatatemp($rfx_id,3);
            $main_support_doc = \api\modules\pms\models\CmssupdocumentTblQuery::getData($rfx_id,3);
            
            $temp_termsandcondition = CmstenderhdrtempTblQuery::getRFXTermstemp($rfx_id);
            $main_termsandcondition = self::getRFXTerms($rfx_id);

            $main_tables_data['termsandcondition'] = $main_termsandcondition;
            $temp_tables_data['termsandcondition'] = $temp_termsandcondition;

            //1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ, 5 - PQ, 6 - RFT - questionarrie type
            //1 - RFI, 2 - EOI, 3 - PQ, 4 - RFP, 5 - RFQ, 6 - RFT, 7 - eTender, 8 - eAuction - rfx type
            $mqdata['pk'] = $main_data['questionnaire_id'];
            $tqdata['pk'] = $temp_data['questionnaire_id'];
            if($rfx_type == 1) {
                $mqdata['type'] = $tqdata['type'] = 1;
            }
            if($rfx_type == 2) {
                $mqdata['type'] = $tqdata['type'] = 2;
            }
            if($rfx_type == 3) {
                $mqdata['type'] = $tqdata['type'] = 5;
            }
            if($rfx_type == 4) {
                $mqdata['type'] = $tqdata['type'] = 3;
            }
            if($rfx_type == 5) {
                $mqdata['type'] = $tqdata['type'] = 4;
            }
            if($rfx_type == 6) {
                $mqdata['type'] = $tqdata['type'] = 6;
            }

            $temp_questionnarie = \api\modules\pms\models\CmsquestionnaireformtempTblQuery::getexistingquestiontemp($tqdata);
            $main_questionnarie = \api\modules\pms\models\CmsquestionnaireformTblQuery::getexistingquestion($mqdata);

            $main_tables_data['questionnarie'] = $main_questionnarie;
            $temp_tables_data['questionnarie'] = $temp_questionnarie;

            $temp_configuration = CmstenderhdrtempTblQuery::getRFXConfigurationtemp($rfx_id);
            $main_configuration = CmstenderhdrTblQuery::getRFXConfiguration($rfx_id);

            $main_tables_data['configuration'] = $main_configuration;
            $temp_tables_data['configuration'] = $temp_configuration;
            if($temp_data['contactuser_pks']) {
                $temp_communication = \common\models\UsermstTblQuery::getNotifyUserArray($temp_data['contactuser_pks']);
            }
            if($main_data['contactuser_pks']) {
                $main_communication = \common\models\UsermstTblQuery::getNotifyUserArray($main_data['contactuser_pks']);
            }

            $main_tables_data['communication'] = $main_communication;
            $temp_tables_data['communication'] = $temp_communication;

            $temp_additional_doc = \api\modules\pms\models\CmssupdocumenttempTblQuery::getDatatemp($rfx_id,6); // 6 - additional document type in supporting document table
            $main_additional_doc = \api\modules\pms\models\CmssupdocumentTblQuery::getData($rfx_id,6);

            $main_tables_data['additional_doc'] = $main_additional_doc;
            $temp_tables_data['additional_doc'] = $temp_additional_doc;

            if(json_encode($main_tables_data) == json_encode($temp_tables_data)) {
                // echo'<pre>if';print_r( $model);exit;
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
                    'rfx_changed' => 0,
                    'returndata' => $temp_tables_data
                ); 
                $status=3;
            } else {
                $difference_values =  array_map('unserialize',array_diff(array_map('serialize', $temp_tables_data), array_map('serialize', $main_tables_data)));
                // echo'<pre>else';print_r( $model);exit;
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
                    'rfx_changed' => 1,
                    'returndata' => $difference_values // it will only different value of $temp_data comparing with $main_data
                );   
                $status=2;
            }
           /* if($model!=NUll&&$tender_pk!=''&&$tender_pk!=NULL){
                
                $newsupplier_regpk_record = Yii::$app->db->createCommand("select GROUP_CONCAT(cmsttht_memberregmst_fk) as newsupplier, (select GROUP_CONCAT(cmsttht_memberregmst_fk) from cmstendertargethdrtemp_tbl where cmsttht_cmstenderhdrtemp_fk = ".$rfx_id." and cmsttht_memberregmst_fk in (select cmstth_memberregmst_fk from cmstendertargethdr_tbl where cmstth_cmstenderhdr_fk = ".$tender_pk.")) as oldsupplier from cmstendertargethdrtemp_tbl where cmsttht_cmstenderhdrtemp_fk = ".$rfx_id." and cmsttht_memberregmst_fk not in (select cmstth_memberregmst_fk from cmstendertargethdr_tbl where cmstth_cmstenderhdr_fk = ".$tender_pk.")")->queryAll();
                CmstenderhdrtempTblQuery::insertnoticerecord($model,$regPk,$status,$newsupplier_regpk_record);
            }*/
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'Error',
                'flag' => 'E',
                'returndata' => 'Something went wrong!!'
            ); 
        }

        return $result;
    }
    public static function getICVEnable($dataPk) {
        $icvData = CmstenderhdrTbl::find()
                ->select(["cmstenderhdr_pk as tenderPk", 'cmsth_cmsrequisitionformdtls_fk as reqPk', 'cmsth_title as dateTitle', 'cmsth_uid as unicId'])
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk and crfd_isdeleted = 2')
                ->where('crfd_projectdtls_fk=:pk and cmsth_isdeleted = 2 and cmsth_isicv = 1', array(':pk' => $dataPk))
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $icvData ? $icvData : [],
        );
        return $result;
    }
}
