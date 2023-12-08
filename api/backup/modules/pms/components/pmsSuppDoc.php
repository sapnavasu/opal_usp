<?php

namespace api\modules\pms\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;
use common\components\Security;
//use common\components\Common;
use api\modules\pms\models\CmssupdocumentTblQuery;
use api\modules\pms\models\CmssupdocumenttempTblQuery;

class pmsSuppDoc extends Pms {

    public $lang = 'en';
    
    
    /**
    * save_PMS_REQ_SUPP_DOC function  is used to save the Support Document information information
    * @param array $data permit attributes 
    * @return success array / failure array if data not saved  
    */
    Public function save_PMS_REQ_SUPP_DOC($data)
    {
       //Backend Validation
       if(empty($data['cmssd_shared_fk']) || !is_numeric($data['cmssd_shared_fk']))
           return ['status'=>false,'code'=>'E002','msg'=>'Requisition Primary key is missing'];
       if(empty($data['cmssd_type']) || !is_numeric($data['cmssd_type']))
           return ['status'=>false,'code'=>'E003','msg'=>'Requisition document type is missing'];
       if(empty($data['cmssd_docname']) && $data['cmssd_type'] != 6)
           return ['status'=>false,'code'=>'E004','msg'=>'Requisition document name is missing'];
       if(empty($data['cmssd_upload']) || !is_array($data['cmssd_upload']))
           return ['status'=>false,'code'=>'E005','msg'=>'Requisition document file primary key is missing'];
       else
           $data['cmssd_upload'] = $data['cmssd_upload'][0];
       // funciton call to save data
       return CmssupdocumentTblQuery::saveData($data);
    }

    /**
    * save_PMS_REQ_SUPP_DOC function  is used to save the Support Document information information
    * @param array $data permit attributes
    * @return success array / failure array if data not saved
    */
    Public function save_PMS_REQ_SUPP_DOC_TEMP($data)
    {
       //Backend Validation
       if(empty($data['cmssdt_shared_fk']) || !is_numeric($data['cmssdt_shared_fk']))
           return ['status'=>false,'code'=>'E002','msg'=>'Requisition Primary key is missing'];
       if(empty($data['cmssdt_type']) || !is_numeric($data['cmssdt_type']))
           return ['status'=>false,'code'=>'E003','msg'=>'Requisition document type is missing'];
       if(empty($data['cmssdt_docname']) && $data['cmssdt_type'] != 6)
           return ['status'=>false,'code'=>'E004','msg'=>'Requisition document name is missing'];
       if(empty($data['cmssdt_upload']) || !is_array($data['cmssdt_upload']))
           return ['status'=>false,'code'=>'E005','msg'=>'Requisition document file primary key is missing'];
       else
           $data['cmssdt_upload'] = $data['cmssdt_upload'][0];
       // funciton call to save data
       return CmssupdocumenttempTblQuery::saveData($data);
    }
    
/**
    * save_PMS_REQ_SUPP_DOC function  is used to save the Support Document information information
    * @param array $data permit attributes
    * @return success array / failure array if data not saved
    */
    Public function save_PMS_REQ_ADD_DOC_TEMP($data)
    {
       //Backend Validation
       if(empty($data['cmssdt_shared_fk']) || !is_numeric($data['cmssdt_shared_fk']))
           return ['status'=>false,'code'=>'E002','msg'=>'Requisition Primary key is missing'];
       if(empty($data['cmssdt_type']) || !is_numeric($data['cmssdt_type']))
           return ['status'=>false,'code'=>'E003','msg'=>'Requisition document type is missing'];
       if(empty($data['cmssdt_docname']) && $data['cmssdt_type'] != 6)
           return ['status'=>false,'code'=>'E004','msg'=>'Requisition document name is missing'];
       if(empty($data['cmssdt_upload']))
           return ['status'=>false,'code'=>'E005','msg'=>'Requisition document file primary key is missing'];
       else
           $data['cmssdt_upload'] = $data['cmssdt_upload'];
       // funciton call to save data
       return CmssupdocumenttempTblQuery::saveData($data);
    }
    
    public function Get_PMS_REQ_SUPP_DOC($pk,$type){
        if(isset($pk) && !empty($pk) && isset($type) && !empty($type))
            return CmssupdocumentTblQuery::getData($pk,$type);
        else
            return ['status'=>false,'code'=>'E002','msg'=>'Supporting Document type required'];
    }

    public function Get_PMS_REQ_SUPP_DOC_TEMP($pk,$type){
        if(isset($pk) && !empty($pk) && isset($type) && !empty($type))
            return CmssupdocumenttempTblQuery::getDatatemp($pk,$type);
        else
            return ['status'=>false,'code'=>'E002','msg'=>'Supporting Document type required'];
    }
    
    public function del_PMS_REQ_SUPP_DOC($supDocId){
        if(isset($supDocId) && !empty($supDocId))
            return CmssupdocumentTblQuery::delData($supDocId);
        else
            return ['status'=>false,'code'=>'E003','msg'=>'Supporting Document primary key is missing'];
    }

    public function del_PMS_REQ_SUPP_DOCTEMP($supDocId){
        if(isset($supDocId) && !empty($supDocId))
            return CmssupdocumenttempTblQuery::delDatatemp($supDocId);
        else
            return ['status'=>false,'code'=>'E003','msg'=>'Supporting Document primary key is missing'];
    }

}
