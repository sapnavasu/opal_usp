<?php

namespace api\modules\quot\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;
use common\components\Security;
use common\components\Common;

class Quot {
    public $lang = 'en';

    /**
     * Get quotation detail
     */
    public function getFormData($dataPk,$currentPK) {
        if (!empty($dataPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getFormData($dataPk,$currentPK);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Get Quotation View detail
     */
    public function getFormViewData($currentPK) {
        if (!empty($currentPK)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getFormViewData($currentPK);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Save quotation detail
     */
    public function saveDetail($data) {
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::saveDetail($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Chk quotation Ref detail
     */
    public function chkValidRefNumber($data) {
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::chkValidRefNumber($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save quotation scope
     */
    public function getScopeData($dataPk, $currentPK, $dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getScopeData($dataPk, $currentPK, $dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Save quotation scope
     */
    public function saveScope($data) {
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::saveScope($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Get Added Product / Service
     */
    public function GetAddedProductService($currentPk){
        if (!empty($currentPk)) {
            return \api\modules\pms\models\CmstenderpsmapTblQuery::GetAddedProductService($currentPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Get Added Product / Service
     */
    public function getScopeProductServiceList($formdata){
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getScopeProductServiceList($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Save quotation specification
     */
    public function saveSpecification($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::saveSpecification($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save quotation Questionnaire
     */
    public function saveQuestionnaire($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::saveQuestionnaire($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save deviation Questionnaire
     */
    public function saveDeviation($data){
        if (!empty($data)) {
            return \api\modules\pms\models\CmsdeviationhdrTblQuery::saveDeviation($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Data Final Save
     */
    public function dataFinalSave($currentPk){
        if (!empty($currentPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::dataFinalSave($currentPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save save supporting document
     */
    public function saveSupportingDocument($data){
        if (!empty($data)) {
            return \api\modules\pms\models\CmssupdocumentTblQuery::saveQouteSupportDoc($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save save terms & conditions
     */
    public function saveTermsCondition($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::saveTermsCondition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Save save communication contact
     */
    public function saveCommDetail($data,$userPk){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::saveCommDetail($data,$userPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save get quotation detail
     */
    public function getDetail($data){
        if(!empty($data)){
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getDetail($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getQuotation($data){
        if(!empty($data)){
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getQuotation($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save get quotation specification
     */
    public function getSpecification($dataPk, $dataType){
        if(!empty($dataPk)){
            return \api\modules\pms\models\CmstenderagreehdrTblQuery::findBySharedFk($dataPk, $dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save get quotation Audit Log
     */
    public function getAuditList($data){
        if(!empty($data)){
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getAuditList($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

      /**
     * Save get quotation specification
     */
    public function getScope($data){
        if(!empty($data)){
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getScope($data['quotationpk']);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Save get quotation specification
     */
    public function getQuestionnaire($data){
        if(!empty($data)){
            return \api\modules\pms\models\CmsquestionnaireformtrnxTblQuery::findBySharedFk($data['quotationpk']);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

       /**
     * Save get quotation specification
     */
    public function getDeviation($dataPk,$dataType){
        if(!empty($dataPk)){
            return \api\modules\pms\models\CmsdeviationhdrTblQuery::findBySharedFk($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getSupdocument($data){
        if(!empty($data)){
            return \api\modules\pms\models\CmssupdocumentTblQuery::findBySharedFk($data['quotationpk']);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
      /**
     * Save get terms and conditions
     */
    public function getTermscondition($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getTermscondition($data['quotationpk']);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Save get communication
     */
    public function getCommunication($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getCommunication($data['quotationpk']);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Update detail
     */
    public function updateDetail($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::updateDetail($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /** 
     * Update scope
     */
    public function updateScope($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::updateScope($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }   

    /** 
     * Update specification
     */
    public function updateSpecification($data){
        if (!empty($data)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::updateSpecification($data);
        } else{
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /** 
     * Update scope
     */
    public function updateQuestionnaire($data){
        if (!empty($data)) {
            return \api\modules\pms\models\CmsquestionnaireformtrnxTblQuery::updateQuestionnaire($data);
        } else{
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * update deviation Questionnaire
     */
    public function updateDeviation($data){
        if (!empty($data)) {
            return \api\modules\pms\models\CmsdeviationhdrTblQuery::updateDeviation($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * delete deviation Questionnaire
     */
    public function deleteDeviation($id){
        if (!empty($id)) {
            return \api\modules\pms\models\CmsdeviationhdrTblQuery::deleteDeviation($id);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * update save supporting document
     */
    public function updateSupportingDocument($data){
        if (!empty($data)) {
            return \api\modules\pms\models\CmssupdocumentTblQuery::updateQouteSupportDoc($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * update terms & conditions
     */
    public function updateTermsCondition($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::updateTermsCondition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * delete termsCondition
     */
    public function deleteTermsCondition($id){
        if (!empty($id)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::deleteTermsCondition($id);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Save Questionnaire Form
     */
    public function saveQuestionnaireForm($quot_pk,$data,$dataType){
        if (!empty($quot_pk)) {
            return \api\modules\pms\models\CmsquestionnaireformtrnxTblQuery::saveQuestionnaireForm($quot_pk,$data,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
     /**
     * Get Quot Questionnaire Form Function Answer
     */
    public function getQuestionnaireFormAnswer($qpk, $dataPk, $type) {
        if (!empty($qpk)) {
            return \api\modules\pms\models\CmsquestionnaireformtrnxTblQuery::getQuestionnaireFormAnswer($qpk, $dataPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
}