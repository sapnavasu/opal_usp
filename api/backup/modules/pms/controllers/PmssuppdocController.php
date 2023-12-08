<?php

namespace api\modules\pms\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use \common\components\Security;
use api\modules\pms\controllers\PmsMasterController;
use api\modules\pms\components\Pms;
use api\modules\pms\components\pmsSuppDoc;

class PmssuppdocController extends PmsMasterController {

    public $modelClass = '\common\models\CmsrqsupdocumentTbl';

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
    }

    public function beforeAction($action) {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();

        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            
        }
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        return $behaviors;
    }
 
    /**
     * @SWG\Post(
     *     path="/pms/pmssuppdoc/Save_PMS_REQ_SUPP_DOC",
     *     tags={"Add Support document"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To save permit details to permit table",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="doc", type="object",
     *                  @SWG\Property(property="requisitionPK", type="string", example="Mzl="),
     *                  @SWG\Property(property="cmsrqsupdocumentPk", type="string", example="Mzl="),
     *                  @SWG\Property(property="uploadPK", type="string", example="Mzl="),          
     *                  @SWG\Property(property="cmssd_type", type="number", example="1"),         
     *                  @SWG\Property(property="cmssd_docname", type="string", example="Name_of_Document"),         
     *              )
     *            ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSave_pms_req_supp_doc()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);

        // Decrypt fields
        $Ddata['cmssd_shared_fk'] = Security::decrypt($data['doc']['sharedfk']);
        $Ddata['cmsrqsupdocument_pk'] = Security::decrypt($data['doc']['cmsrqsupdocumentpk']);
        
        //Sanitize the input
        $Ddata['cmssd_type'] = Security::sanitizeInput($data['doc']['type'],'number');    
        $Ddata['cmssd_docname'] = Security::sanitizeInput($data['doc']['docname'],'string_spl_char');    
        $Ddata['cmssd_upload'] = Security::sanitizeArr($data['doc']['upload'],'number');    
        
        // Calling class file for validation and get the response 
        $suppDoc_obj = new pmsSuppDoc();
        return $suppDoc_obj->save_PMS_REQ_SUPP_DOC($Ddata);
    }

    /**
     * @SWG\Post(
     *     path="/pms/pmssuppdoc/save_pms_req_supp_doctemp",
     *     tags={"Add Support document"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To save permit details to permit table",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="doc", type="object",
     *                  @SWG\Property(property="requisitionPK", type="string", example="Mzl="),
     *                  @SWG\Property(property="cmsrqsupdocumentPk", type="string", example="Mzl="),
     *                  @SWG\Property(property="uploadPK", type="string", example="Mzl="),
     *                  @SWG\Property(property="cmssd_type", type="number", example="1"),
     *                  @SWG\Property(property="cmssd_docname", type="string", example="Name_of_Document"),
     *              )
     *            ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSave_pms_req_supp_doctemp()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);

        // Decrypt fields
        $Ddata['cmssdt_shared_fk'] = Security::decrypt($data['doc']['sharedfk']);
        $Ddata['cmssupdocumenttemp_pk'] = Security::decrypt($data['doc']['cmsrqsupdocumentpk']);

        //Sanitize the input
        $Ddata['cmssdt_type'] = Security::sanitizeInput($data['doc']['type'],'number');
        $Ddata['cmssdt_docname'] = Security::sanitizeInput($data['doc']['docname'],'string_spl_char');
        $Ddata['cmssdt_upload'] = Security::sanitizeArr($data['doc']['upload'],'number');

        // Calling class file for validation and get the response
        $suppDoc_obj = new pmsSuppDoc();
        return $suppDoc_obj->save_PMS_REQ_SUPP_DOC_TEMP($Ddata);
    }

        /**
     * @SWG\Post(
     *     path="/pms/pmssuppdoc/save_pms_req_additional_doctemp",
     *     tags={"Add Additional document"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To save additional doc details to supporting document table",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="doc", type="object",
     *                  @SWG\Property(property="requisitionPK", type="string", example="Mzl="),
     *                  @SWG\Property(property="cmsrqsupdocumenttempPk", type="string", example="Mzl="),
     *                  @SWG\Property(property="uploadPK", type="string", example="Mzl="),
     *                  @SWG\Property(property="cmssdt_type", type="number", example="1"),
     *                  @SWG\Property(property="cmssdt_docname", type="string", example="Name_of_Document"),
     *              )
     *            ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSave_pms_req_additional_doctemp()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);

        foreach($data['doc']['upload'] as $key => $value) {
            // Decrypt fields
            $Ddata['cmssdt_shared_fk'] = Security::decrypt($data['doc']['sharedfk']);
            $Ddata['cmssupdocumenttemp_pk'] = Security::decrypt($data['doc']['cmsrqsupdocumentpk']);
    
            //Sanitize the input
            $Ddata['cmssdt_type'] = Security::sanitizeInput($data['doc']['type'],'number');
            $Ddata['cmssdt_docname'] = Security::sanitizeInput($data['doc']['docname'],'string_spl_char');
            $Ddata['cmssdt_upload'] = Security::sanitizeInput($value,'number');
    
            // Calling class file for validation and get the response
            $suppDoc_obj = new pmsSuppDoc();
            $return_data = $suppDoc_obj->save_PMS_REQ_ADD_DOC_TEMP($Ddata);
        }

        return $return_data;

    }
    
          /**
     * @SWG\Get(
     *     path="/pms/pmssuppdoc/get_pms_req_supp_doc",
     *     tags={"Support Document List"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get list of Support Document added",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", type = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGet_pms_req_supp_doc(){
        
        $type = Security::sanitizeInput($_REQUEST['type'],'number');    
        $pk = Security::sanitizeInput(Security::decrypt($_REQUEST['pk']),'number');    
        $suppDoc_obj = new pmsSuppDoc();
        $rdata = $suppDoc_obj->get_PMS_REQ_SUPP_DOC($pk, $type);
        return json_encode($rdata);
        
    }

    /**
     * @SWG\Get(
     *     path="/pms/pmssuppdoc/get_pms_req_supp_doc_temp",
     *     tags={"Support Document List"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get list of Support Document added",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", type = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGet_pms_req_supp_doc_temp(){

        $type = Security::sanitizeInput($_REQUEST['type'],'number');
        $pk = Security::sanitizeInput(Security::decrypt($_REQUEST['pk']),'number');
        $suppDoc_obj = new pmsSuppDoc();
        $rdata = $suppDoc_obj->get_PMS_REQ_SUPP_DOC_TEMP($pk, $type);
        return json_encode($rdata);

    }

    
    /**
     * @SWG\Get(
     *     path="/pms/pmssuppdoc/get_pms_req_supp_doc",
     *     tags={"Support Document List"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get list of Support Document added",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", type = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDel_pms_req_supp_doc(){
        
        $supDocId = Security::decrypt($_REQUEST['id']);
        $supDocId = Security::sanitizeInput($supDocId,'number');    
        $suppDoc_obj = new pmsSuppDoc();
        $rdata = $suppDoc_obj->del_PMS_REQ_SUPP_DOC($supDocId);
        return json_encode($rdata);
        
    }

    /**
     * @SWG\Get(
     *     path="/pms/pmssuppdoc/get_pms_req_supp_doctemp",
     *     tags={"Support Document List"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get list of Support Document added",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", type = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDel_pms_req_supp_doctemp(){
        
        $supDocId = Security::decrypt($_REQUEST['id']);
        $supDocId = Security::sanitizeInput($supDocId,'number');    
        $suppDoc_obj = new pmsSuppDoc();
        $rdata = $suppDoc_obj->del_PMS_REQ_SUPP_DOCTEMP($supDocId);
        return json_encode($rdata);
        
    }
    
}
