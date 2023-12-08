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
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\BgiindcodesubcategTbl;
use api\modules\mst\models\BgiindcodecategTbl;


class SubcategoryController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\BgiindcodesubcategTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }
    public function beforeAction($action)
    {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        //header("Access-Control-Allow-Headers: Content-Type");

        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
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

    public function actionIndex(){

        $subcatcode	=	$_REQUEST['subcatcode'];
        $subcatname	=	$_REQUEST['subcatname'];
        $subcattype	=	$_REQUEST['subcattype'];
        $subcatstatus =	$_REQUEST['subcatstatus'];

        $query = BgiindcodesubcategTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if(!is_null($val))
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(["*","if(bgiindcodesubcateg_tbl.bicsc_categorystatus = 1, 'A','I') as `bicsc_status`"]);
        $query->leftJoin('bgiindcodecateg_tbl','bgiindcodecateg_tbl.bgiindcodecateg_pk=bgiindcodesubcateg_tbl.bicsc_bgiindcodecateg_fk');
        $query->asArray();
        $provider = new ActiveDataProvider(['query' => $query]);
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        $provider->pagination->pageSize=$page;
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){
        $subcategory = BgiindcodesubcategTbl::find()->where([
            'bgiindcodesubcateg_pk'    =>  $id
        ])->one();
       
        //echo "<pre>";print_r($BgiindcodesubcategTbl);die;
        // print_r($country);exit;
        if($subcategory){
            return $subcategory;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $subcategory= BgiindcodesubcategTbl::find()->active()->where([
            'bgiindcodesubcateg_pk'    =>  $id
        ])->one();
        if($subcategory){
            return $subcategory;
        } else{
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    
    public function actionNewsubcategory(){
        //echo "hello";exit;
        $model = new BgiindcodesubcategTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        // foreach ($data['subcategorymaster'] as $key=>$value) {
        //     if($key=="status")
        //     {
        //         $status=($data['subcategorymaster']['status'] ==true)?1:2;
        //         $params['bicsc_'.$key.'']=$status;
        //     }
        //     else {
        //         $params['bicsc_'.$key.'']=$value;
        //     }
        // } 
        $model['bicsc_categorystatus']=($data['subcategorymaster']['Status'])?1:2;
        $model['bicsc_subcategorycode']=$data['subcategorymaster']['SubCategoryCode'];
        $model['bicsc_subcategoryname']=$data['subcategorymaster']['SubCategoryName'];
        $model['bicsc_subcategorytype']=$data['subcategorymaster']['SubCategorytype'];
        $model['bicsc_createdby']=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model['bicsc_bgiindcodecateg_fk']=$data['subcategorymaster']['Codecateg_Fk'];
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'user created successfully',
                'returndata' => $model->bgiindcodesubcateg_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>"E",
                'msg'=>$model->getErrors(),

            );
            //throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model =BgiindcodesubcategTbl::find()->where([
            'bgiindcodesubcateg_pk'    =>  $id
        ])->one();
        if($data['subcategorymaster'])
        {
            foreach ($data['subcategorymaster'] as $key=>$value) {
                if($key=="status")
                {
                    $status=($data['subcategorymaster']['status'] ==true)?"A":"I";
                    $params['bicsc_'.$key.'']=$status;
                }
                else {
                    $params['bicsc_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'user updated successfully',
                    'returndata' => $model->bgiindcodesubcateg_pk
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>"E",
                    'msg'=>'something went wrong',

                );
            }
        }
        else if($data['updatestatus'])
        {
            $model = BgiindcodesubcategTbl::find()->where([
                'bgiindcodesubcateg_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->bicsc_categorystatus=="A")?"I":"A";
            //$params['bicsc_status']=$status;
            $model->bicsc_categorystatus=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'updated successfully',
                    'returndata' => $model->bgiindcodesubcateg_pk
                );
            }

        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->bicsc_categorystatus=="A")?"I":"A";
        $model->bicsc_categorystatus=$status;
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }
    /**
     * Delete requested staff member from backend dashboard
     *
     * Request: DELETE /v1/staff/1
     *
     * @param $id
     *
     * @return string
     * @throws ServerErrorHttpException
     */
    public function actionDelete($id) {
      
        $model = BgiindcodesubcategTbl::find()->where([
            'bgiindcodesubcateg_pk'    =>  $id
        ])->one();
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            return "ok";
        }

    }

    /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return array
     * @throws HttpException
     */
    public function actionLogin(){
        $model = new LoginForm();

        $model->roles = [
            User::ROLE_ADMIN,
            User::ROLE_STAFF
        ];
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = $model->getUser();
            $user->generateAccessTokenAfterUpdatingClientInfo(true);

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            $id = implode(',', array_values($user->getPrimaryKey(true)));

            $responseData = [
                'id'    =>  $id,
                'access_token' => $user->access_token,
            ];

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
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
    public function actionCategorylist()
    {
        return new ActiveDataProvider([
            'query' => BgiindcodecategTbl::find()
                ->select(['bgiindcodecateg_pk','bicc_categoryname'])
                ->active(),
            'sort'=> ['defaultOrder' => ['bicc_categoryname'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }
    public function actionSubcategorylist()
    {
        return new ActiveDataProvider([
            'query' => BgiindcodesubcategTbl::find()
                ->select(['bgiindcodesubcateg_pk','bicsc_subcategoryname'])
                ->active(),
            'sort'=> ['defaultOrder' => ['bicsc_subcategoryname'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }
    
}