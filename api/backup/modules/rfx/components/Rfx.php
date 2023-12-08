<?php

namespace api\modules\rfx\components;

use Yii;
use yii\data\ActiveDataProvider;
use api\modules\pms\models\CmstenderhdrTblQuery;
use api\modules\pms\models\CmstenderhdrtempTblQuery;
use api\modules\pms\models\CmstendertargethdrTbl;
use api\modules\pms\models\CmstendertargethdrtempTbl;
use api\modules\pms\models\CmstendertargethdrtempTblQuery;
use common\models\MemberregistrationmstTbl;

class Rfx {

    public $lang = 'en';

    public function addrfxdetails($data) {
        if (!empty($data)) {
            return CmstenderhdrtempTblQuery::addrfxdetails($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Details and Scope Function
     */
    public function getDetails($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXDetails($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX LCC Category List
     */
    public function lcccategorylist($comp_pk) {
        if (!empty($comp_pk)) {
            return CmstenderhdrTblQuery::getRFXViewPdoLcc($comp_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Details from temp table Function
     */
    public function getDetailstemp($rfx_pk, $rfx_type = null) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getRFXDetails($rfx_pk, $rfx_type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * chk success fee status
     */
    public function chkSuccessFee($compPk) {
        if (!empty($compPk)) {
            $successStatus = \common\models\MemcompinvoicedtlsTblQuery::chkSuccessFeeStatus($compPk);
            $result = array(    
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'status' => 1,
            );
            if($successStatus == 1){      
                $model= \api\modules\mst\models\MembercompanymstTbl::find()->where("MemberCompMst_Pk =:pk", [':pk' => $compPk])->one();
                $result = array(    
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'SF',
                    'status' => 1,
                    'regPk' => $model->MCM_MemberRegMst_Fk,
                );
            }  else {
                $regStatus = MemberregistrationmstTbl::supplierStatusChk($compPk);
                if($regStatus == 1){
                    $result = array(    
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'EX',
                        'status' => 1,
                    );  
                }
            }
            return $result;
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Delete Details Quotation
     */
    public function deleteData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::deleteData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Details and Scope Function
     */
    public function getOveralldataStatus($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getOveralldataStatus($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Details and Scope Function
     */
    public function getOveralldataStatustemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getOveralldataStatustemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Supporting Document Function
     */
    public function getSupportingDoc($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXSupportingDoc($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Supporting Document Function
     */
    public function getSupportingDoctemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getRFXSupportingDoctemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Questionnaire Form Function
     */
    public function getQuestionnaireForm($pk) {
        if (!empty($pk)) {
            return CmstenderhdrTblQuery::getRFXQuestionnaireForm($pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Questionnaire Form Function
     */
    public function getQuestionnaireFormtemp($pk) {
        if (!empty($pk)) {
            return CmstenderhdrtempTblQuery::getRFXQuestionnaireFormtemp($pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Get RFX Questionnaire Form Function Answer
     */
    public function getQuestionnaireFormAnswer($qpk, $rfxpk, $type) {
        if (!empty($qpk)) {
            return CmstenderhdrTblQuery::getRFXQuestionnaireFormAnswer($qpk, $rfxpk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
     /**
     * Get RFX Questionnaire Form Function Answer
     */
    public function getQuestionnaireFormAnswertemp($qpk, $rfxpk, $type) {
        if (!empty($qpk)) {
            return CmstenderhdrtempTblQuery::getRFXQuestionnaireFormAnswertemp($qpk, $rfxpk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Save RFX Questionnaire Form Function
     */
    public function saveQuestionnaireForm($rfx_pk, $data) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::saveRFXQuestionnaireForm($rfx_pk, $data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Questionnaire Function
     */
    public function getQuestionnaire($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXQuestionnaire($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Terms Function
     */
    public function getTerms($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXTerms($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Terms Function
     */
    public function getTermstemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getRFXTermstemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Contacts Detail Function
     */
    public function getContacts($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::getRFXContacts($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Contacts Detail Function
     */
    public function getContactstemp($data) {
        if (!empty($data)) {
            return CmstenderhdrtempTblQuery::getRFXContactstemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Configuration Function
     */
    public function getConfiguration($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXConfiguration($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Configuration Function
     */
    public function getConfigurationtemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getRFXConfigurationtemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    } 
    
    /**
     * Get RFX Additional Document Function
     */
    public function getAdditionalDoc($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXAdditionalDoc($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Additional Document Function
     */
    public function getAdditionalDoctemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrtempTblQuery::getRFXAdditionalDoctemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Product List Function
     */
    public function getProductList($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXProductList($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Additional Information Function
     */
    public function getAdditionalInfo($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXAdditionalInfo($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get RFX Additional Information Function
     */
    public function getAdditionalInfotemp($rfx_pk) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::getRFXAdditionalInfotemp($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Suppliers List Function
     */
    public function getSuppliers($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::getRFXSuppliers($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Tender Response Function
     */
    public function getTenderResponse($dataPk) {
        if (!empty($dataPk)) {
            return CmstenderhdrTblQuery::getTenderResponse($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Acknowledge Response Function
     */
    public function getAcknowledgeResponse($dataPk) {
        if (!empty($dataPk)) {
            return CmstenderhdrTblQuery::getAcknowledgeResponse($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Quotations Function
     */
    public function getQuotations($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::getRFXQuotations($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Compare List Data Function
     */
    public function getCompareListData($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::getRFXCompareListData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Quotation Details Function
     */
    public function getQuotationDetails($quot_pks) {
        if (!empty($quot_pks)) {
            return CmstenderhdrTblQuery::getRFXQuotationDetails($quot_pks);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Get RFX Contract History Function
     */
    public function getContractHistory($comp_pk) {
        if (!empty($comp_pk)) {
            return CmstenderhdrTblQuery::getRFXContractHistory($comp_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Update Quotation Status Function
     */
    public function updateQuotStatus($rfx_pk, $data) {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::updateRFXQuotStatus($rfx_pk, $data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Save Other Expenses Function
     */
    public function saveOtherExpenses($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::saveRFXOtherExpenses($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Save Overall Score Function
     */
    public function saveOverallScore($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::saveRFXOverallScore($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * Save Tender Response Function
     */
    public function saveTenderResponse($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::saveRFXTenderResponse($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

      /**
     * Save Targetted Supplier Function
     */
    public static function saveTargettedSupplier($rfxPk, $targetType) {
        $reg_pk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk', true);
        if ($targetType==2) { // JSRS Supplier
            CmstendertargethdrTbl::deleteAll('cmstth_cmstenderhdr_fk=:tendHrd AND cmstth_targettype=:type',[':tendHrd'=>$rfxPk,':type'=>$targetType]);
            $JSRSSuppliers = MemberregistrationmstTbl::find()
                ->select(['MemberRegMst_Pk'])
                ->where('mrm_stkholdertypmst_fk=:stk AND MRM_MemberStatus=:ms AND MRM_ValSubStatus=:T2',array(':stk' =>6,':ms'=>'A',':T2'=>'A'))
                ->andWhere(['!=', 'MemberRegMst_Pk', $reg_pk])
                ->asArray()->all();
            foreach($JSRSSuppliers as $Supplier){
                $tendTarget['cmstth_cmstenderhdr_fk'] = $rfxPk;
                $tendTarget['cmstth_memberregmst_fk'] = $Supplier['MemberRegMst_Pk'];
                $tendTarget['cmstth_targettype'] = $targetType;
                CmstendertargethdrTbl::saveData($tendTarget);
            }
        }  
    }

      /**
     * Save Targetted Supplier Function
     */
    public static function saveTargettedSuppliertemp($rfxPk, $cms_tender_type, $cms_tender_status) {
       
        $reg_pk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk', true);
        if ($targetType==2) { // JSRS Supplier

        $model_tar_temp =  Yii::$app->db->createCommand("select group_concat(cmstendertargethdrtemp_pk) as cmstendertargethdrtemp_pk  from cmstendertargethdrtemp_tbl where cmsttht_cmstenderhdrtemp_fk = '$rfxPk'  ")->queryone();
        $cmstendertargethdrtemp_pk_ids = $model_tar_temp['cmstendertargethdrtemp_pk'];       
        
        CmstendertargethdrtempTbl::deleteAll('cmsttht_cmstenderhdrtemp_fk=:tendHrd AND cmsttht_targettype=:type',[':tendHrd'=>$rfxPk,':type'=>$targetType]);
            $JSRSSuppliers = MemberregistrationmstTbl::find()
                ->select(['MemberRegMst_Pk'])
                ->where('mrm_stkholdertypmst_fk=:stk AND MRM_MemberStatus=:ms AND MRM_ValSubStatus=:T2',array(':stk' =>6,':ms'=>'A',':T2'=>'A'))
                ->andWhere(['!=', 'MemberRegMst_Pk', $reg_pk])
                ->asArray()->all();
            foreach($JSRSSuppliers as $Supplier){
                $tendTarget['cmsttht_cmstenderhdrtemp_fk'] = $rfxPk;
                $tendTarget['cmsttht_memberregmst_fk'] = $Supplier['MemberRegMst_Pk'];
                $tendTarget['cmsttht_targettype'] = $targetType;
                $target_save_model = CmstendertargethdrtempTblQuery::saveData($tendTarget);
            }
        }  
    }

     /**
     * get Audit Log
     */
    public function auditLoglist($rfxPk){
        if (!empty($rfxPk)) {
            return CmstenderhdrTblQuery::auditLoglist($rfxPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * get Audit show
     */
    public function auditLogshow($data){
        if (!empty($data)) {
            return CmstenderhdrTblQuery::auditLogshow($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Update RFx Publish Function
     */
    public static function publishscheduledrfx() {
        if (!empty($rfx_pk)) {
            return CmstenderhdrTblQuery::publishscheduledrfx($rfx_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        } 
    }

    public static function publishscheduledcron() {
        $res =  CmstenderhdrtempTblQuery::publishscheduledcron();        
        return $res;
    }

        
    /**
     * Can create RFx
     */
    public function cancreaterfx($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::cancreaterfx($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Can create RFx
     */
    public function cancreaterfxtemp($data) {
        if (!empty($data)) {
            return CmstenderhdrtempTblQuery::cancreaterfxtemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    
}