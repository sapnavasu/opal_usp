<?php

namespace api\modules\mst\controllers;

use app\filters\auth\HttpBearerAuth;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\LicensinginfoTbl;
use app\modules\nbf\components\Profile;
use api\modules\mst\models\SectormstTbl;
use api\modules\mst\models\SubsectormstTbl;
use api\modules\mst\models\LicauthdtlsTbl;
use api\modules\mst\models\LicproceduremstTbl;
use api\modules\mst\models\LicauthusersTbl;
use api\modules\mst\models\LicensauthoritiesmstTbl;
use api\modules\mst\controllers\MasterController;
use \common\components\Security;
use common\models\DepartmentmstTbl;

class LicensemstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\LicensinginfoTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }

    public function behaviors()
    {
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

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    /**
     * @SWG\Get(
     *     path="/mst/licensemst/index",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of License access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIndex(){
        $data = LicensinginfoTbl::getLicensData($_REQUEST);        
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => !empty($data['data']) ? $data['data'] : [],
            'total_count' => ($data['totalcount'] > 0) ? $data['totalcount'] : 0,
            'limit' =>$data['size'],
            'total_entry' =>$data['total_entry'],
        ];
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/addlicense",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new License.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="licenseForm", type="object",
     *                  @SWG\Property(property="licensinginfo_pk", type="string", example=""),
     *                  @SWG\Property(property="li_sectormst_fk", type="integer", example=""),
     *                  @SWG\Property(property="li_subsectormst_fk", type="integer", example=""),
     *                  @SWG\Property(property="li_licproceduremst_fk", type="integer", example=""),
     *                  @SWG\Property(property="li_stkholdregistration_fk", type="integer", example=""),
     *                  @SWG\Property(property="li_referenceno", type="string", example=""),
     *                  @SWG\Property(property="li_status", type="integer", example=""),
     *                  @SWG\Property(property="li_intrefno", type="string", example=""),
     *                  @SWG\Property(property="li_lictitleen", type="string", example=""),
     *                  @SWG\Property(property="li_licdescen", type="string", example=""),
     *                  @SWG\Property(property="li_needoflicenseen", type="string", example=""),
     *                  @SWG\Property(property="li_applicableen", type="string", example=""),
     *                  @SWG\Property(property="li_processen", type="string", example=""),
     *                  @SWG\Property(property="li_targetdurationtype", type="integer", example=""),
     *                  @SWG\Property(property="li_targetduration", type="integer", example=""),
     *                  @SWG\Property(property="li_licensefeeen", type="string", example=""),
     *                  @SWG\Property(property="li_docneedprocessen", type="string", example=""),
     *                  @SWG\Property(property="li_guaranteesen", type="string", example=""),
     *                  @SWG\Property(property="li_advisoriesen", type="string", example=""),
     *                  @SWG\Property(property="li_servreqchanen", type="string", example=""),
     *                  @SWG\Property(property="li_servvalidityen", type="string", example=""),
     *                  @SWG\Property(property="li_createdon", type="string", example=""),
     *                  @SWG\Property(property="li_createdby", type="integer", example=""),
     *                  @SWG\Property(property="li_createdbyipaddr", type="integer", example=""),
     *                  @SWG\Property(property="li_updatedon", type="string", example=""),
     *                  @SWG\Property(property="li_updatedby", type="integer", example=""),
     *                  @SWG\Property(property="li_updatedbyipaddr", type="integer", example=""),
     *                  @SWG\Property(property="li_deletedby", type="integer", example=""),
     *                  @SWG\Property(property="li_deletedon", type="string", example=""),
     *                  @SWG\Property(property="li_deletedbyipaddr", type="integer", example=""),
     *                  @SWG\Property(property="licAuthorities", type="array", example="",@SWG\Items(type="integer")),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddlicense() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = LicensinginfoTbl::addlicenseData($data);        
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/update",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Update License.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="updatestatus", type="string", example=""),
     *              ),
     *          ),
     *     @SWG\Response(response = 200, description = "Response"),
     *     ),
     * 
     */
    public function actionUpdate() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = LicensinginfoTbl::updatelicenseData($data);      
        return $data;   
    }
    
    /**
     * @SWG\Get(
     *     path="/mst/licensemst/editlicense",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Edit License access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "licenseId", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionEditlicense() {         
        $data = LicensinginfoTbl::editlicenseData($_REQUEST['licenseId']);  
        return $data;   
    }
    /**
     * @SWG\Get(
     *     path="/mst/licensemst/viewlicense",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to View License access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "licenseId", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionViewlicense() { 
        $data = LicensinginfoTbl::viewlicenseData($_REQUEST['licenseId']);  
        return $data; 
    }
    /**
     * @SWG\Get(
     *     path="/mst/licensemst/licenseauthdtls",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to License Authority Details access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "licenseId", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionLicenseauthdtls() { 
        $data = LicauthdtlsTbl::licenseAuthDtls($_REQUEST['licenseId']);  
        return $data; 

    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/sectorlist",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Sector List access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSectorlist(){
        $data = SectormstTbl::getSectorlist();  
        return $data; 
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/getsubsector",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Sub Sector list",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="sectorPk", type="string", example=""),
     *              ),
     *          ),
     *     @SWG\Response(response = 200, description = "Response"),
     *     ),
     * )
     */
    public function actionGetsubsector(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $sectorPk = Security::decrypt($data['sectorPk']);
        $sectorPk = Security::sanitizeInput($sectorPk, "number");        
        $data = SubsectormstTbl::getSubSectorlist($sectorPk);  
        return $data; 
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/getselectedauthoritlist",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Get Selected Authority List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="licensePk", type="string", example=""),
     *              ),
     *          ),
     *     @SWG\Response(response = 200, description = "Response"),
     *     ),
     * )
     */
    public function actionGetselectedauthoritlist(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::decrypt($data['licensePk']);
        $id = Security::sanitizeInput($id, "number");        
             
        $data = LicauthdtlsTbl::getSelectedAuthlist($id);  
        return $data; 
    }
    /**
     * @SWG\Get(
     *     path="/mst/licensemst/editlicauthoritlist",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Edit License Authorit List.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "licensePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionEditlicauthoritlist(){
        $id = Security::decrypt($_GET['id']);
        $id = Security::sanitizeInput($id, "number");   
        $data = LicensauthoritiesmstTbl::editLicAuthlist($id);  
        return $data; 
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/licauthoritlist",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to License Authorit List.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionLicauthoritlist(){
        
        $data = LicensauthoritiesmstTbl::licAuthoritList();  
        return $data; 
    }
    /**
     * @SWG\Post(
     *     path="/mst/licensemst/procedurelist",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Procedure list.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionProcedurelist(){
        $data = LicproceduremstTbl::getProcedureList();  
        return $data; 
    }
    /**
     * @SWG\Get(
     *     path="/mst/licensemst/delete",
     *     tags={"License Master Data"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Delete License.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "licenseId", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDelete() {        
        $data = LicensinginfoTbl::deleteLicenseData($_REQUEST['licenseId']);  
        return $data; 
        
    }
}