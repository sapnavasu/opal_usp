<?php

namespace api\modules\mst\controllers;

use api\modules\mst\models\FormcategorymstTbl;
use app\filters\auth\HttpBearerAuth;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\DomCrawler\Form;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\FormmstTbl;
use app\modules\nbf\components\Profile;
use common\models\BasemodulemstTbl;
use \common\components\Security;



class FormmasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\FormmstTbl';

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
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $_REQUEST['sort'] = Security::sanitizeInput($_REQUEST['sort'],"string");
        $_REQUEST['order'] = Security::sanitizeInput($_REQUEST['order'],"string");
        $_REQUEST['page'] = Security::sanitizeInput($_REQUEST['page'],"number");
        $_REQUEST['size'] = Security::sanitizeInput($_REQUEST['size'],"number");
        $_REQUEST['filter'] = Security::sanitizeInput($_REQUEST['filter'],"string");
        $_REQUEST['frm_basemodulemst_fk'] = Security::sanitizeInput($_REQUEST['frm_basemodulemst_fk'],"number");
        $_REQUEST['frm_formname'] = Security::sanitizeInput($_REQUEST['frm_formname'],"string");
        $_REQUEST['frm_formdesc'] = Security::sanitizeInput($_REQUEST['frm_formdesc'],"string");
        $_REQUEST['frm_status'] = Security::sanitizeInput($_REQUEST['frm_status'],"string");
        $data = FormmstTbl::getformData($_REQUEST);        
        return $data;
    }

    public function actionGetformbyid($pk){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        if(isset($_REQUEST['type']))
        {
          $data=FormcategorymstTbl::findOne($pk);
        }else{
            $data = FormmstTbl::getformbyid($pk);
        }
        return $data;
    }

    public function actionNewform(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['formmaster']['FormName'] = Security::sanitizeInput($data['formmaster']['FormName'],'string');
        $data['formmaster']['FormDescription'] = Security::sanitizeInput($data['formmaster']['FormDescription'],'string');
        $data['formmaster']['Module'] = Security::sanitizeInput($data['formmaster']['Module'],'number');
        $data['formmaster']['Status'] = Security::sanitizeInput($data['formmaster']['Status'],'string');
        $data = FormmstTbl::addformdata($data);        
        return $data;
    }

    public function actionUpdateform() {
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['formmaster']['FormName'] = Security::sanitizeInput($data['formmaster']['FormName'],'string');
        $data['formmaster']['FormDescription'] = Security::sanitizeInput($data['formmaster']['FormDescription'],'string');
        $data['formmaster']['Module'] = Security::sanitizeInput($data['formmaster']['Module'],'number');
        $data['formmaster']['Status'] = Security::sanitizeInput($data['formmaster']['Status'],'string');
        $data['formmaster']['update_formid'] = Security::decrypt($data['formmaster']['update_formid']);
        $data['formmaster']['update_formid'] = Security::sanitizeInput($data['formmaster']['update_formid'],'number');
        $updatedata = FormmstTbl::updateformdata($data);
        return $updatedata;
    }

    public function actionDeleteform() {
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $type=isset($_REQUEST['type'])?1:0;
        $data = FormmstTbl::deleteformData($pk,$type);
        return $data; 
    }

    public function actionUpdatestatus(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['updatestatus'] = Security::decrypt($data['updatestatus']);
        $data['updatestatus'] = Security::sanitizeInput($data['updatestatus'],'number');
        $updatestatusdata = FormmstTbl::statuschange($data);
        return $updatestatusdata;
    }

    public function actionGetPermissions(){
        $authManager = Yii::$app->authManager;

        /** @var Permission[] $permissions */
        $permissions = $authManager->getPermissions();

        /** @var array $tmpPermissions to store list of available permissions */
        $tmpPermissions = [];

        /**
         * @var string $permissionKey
         * @var Permission $permission
         */
        foreach($permissions as $permissionKey => $permission) {
            $tmpPermissions[] = [
                'name'          =>  $permission->name,
                'description'   =>  $permission->description,
                'checked'       =>  false,
            ];
        }

        return $tmpPermissions;
    }

    public function actionOptions($id = null) {
        return "ok";
    }
    
    public function actionGetmodulelist(){
        $data=BasemodulemstTbl::getmodulelist();
        return $data;
    }
    public function actionGetmodulelistfilter(){
        $data=BasemodulemstTbl::getmodulelistfilter();
        return $data;
    }
	public function actionFormiojson()
	{
	  $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $dec_formpk=Security::decrypt($_REQUEST['formmaster']);
        $error=[];
        if($dec_formpk)
        {
            $model=FormcategorymstTbl::findOne($dec_formpk);
            $model->fcm_catformtemplate=json_encode($data['formmaster']);
            if(!$model->save(false)){
                $error[]=$model->getErrors();
            }
            return $this->asJson([
                'data' => $model->formcategorymst_pk,
                'msg' => 'Successfully updated',
                'status' => 'S',
            ]);
        }
    }
    public function actionGetjson()
    {
        $dec_form_pk=Security::decrypt($_REQUEST['formmaster']);
        if($dec_form_pk)
        {
            $from_model=FormcategorymstTbl::findOne($dec_form_pk);
            if($from_model)
            {
                return $this->asJson([
                    'json'=>json_decode($from_model->fcm_catformtemplate),
                    'msg'=>'Json file was there',
                    'status'=>'S'
                ]);
            }
        }
    }
/*
 * output array
 * desc get all the formmaster list
 */
    public function actionFormlist(){
        $data=FormmstTbl::find()->select(['frm_formname','formmst_pk'])->orderBy('formmst_pk desc')->asArray()->all();
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/mst/formmaster/categoryform",
     *     tags={"Save Category Form"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Save Category Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="formmaster", type="object",
     *                  @SWG\Property(property="CatName", type="string", example=""),
     *                  @SWG\Property(property="CatDescription", type="string", example=""),
     *                  @SWG\Property(property="update_formid", type="integer", example=""),
     *                  @SWG\Property(property="Status", type="string", example=""),
     *                  @SWG\Property(property="Form_pk", type="integer", example="")
     *          ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCategoryform()
    {
        $data=\api\modules\mst\models\FormcategorymstTbl::addcategory();
        return $data;
    }

    /*
     * Formcategory index list
     * @input type of listing
     * @ooutput json_encoded array based on request
     */
    public function actionCategoryformindex()
    {
        $data_list_cform=FormcategorymstTbl::getcatformlist();
        return $data_list_cform;
    }
    /**
     * @SWG\Post(
     *     path="/mst/formmaster/categoryform",
     *     tags={"Category Form Reorder"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Category Form Reorder",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="datasource_ids", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionReorderform()
    {
        $reorder_data_list=FormcategorymstTbl::reorderform();
        return $reorder_data_list;
    }
}