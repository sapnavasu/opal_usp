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

use api\modules\mst\models\AdminsubmodulemstTbl;
use yii\web\Response;
use yii\db\Query;

class AdminsubmodulemasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\AdminsubmodulemstTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }
    /* public function behaviors()
     {
         $behaviors = parent::behaviors();
         $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_HTML;
         return $behaviors;
     }*/
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
    public function actionView($id){
        $module = AdminsubmodulemstTbl::find()->where([
            'AdminSubModuleMst_Pk'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }
    public function actionIndex(){ 
        $query = AdminsubmodulemstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(["adminsubmodulemst_tbl.*, adminmodulemst_tbl.AMM_ModName",
            "if(adminsubmodulemst_tbl.ASMM_Status = 'A', 'primary','warn') as `color`"]);
        $query->leftJoin('adminmodulemst_tbl', 'adminmodulemst_tbl.AdminModuleMst_Pk = adminsubmodulemst_tbl.ASMM_ModuleMst_Fk');
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        /*
        $provider = new ActiveDataProvider([
            'query' =>  ModulemstTbl::find()
                ->select(["modulemst_tbl.*",
                    "if(modulemst_tbl.MM_Status = 'A', 'primary','warn') as `color`"])
                ->asArray(),
            'pagination' => [
                'pageSize' =>$_GET['size'],
            ],
        ]);*/
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionNewmodule(){

        $model = new AdminsubmodulemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['modulemaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['modulemaster']['Status'] ==true)?"A":"I";
                $params[$key]=$status;
            }
            else {
                $params[$key]=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Module created successfully',
                'returndata' => $model->ModuleMst_Pk);
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }
        return json_encode($result);
    }

    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['modulemaster'])
        {
            $model = AdminsubmodulemstTbl::find()->where([
                'AdminSubModuleMst_Pk'    =>  $id
            ])->one();
            foreach ($data['modulemaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['modulemaster']['Status'] ==true)?"A":"I";
                    $params[$key]=$status;
                }
                else {
                    $params[$key]=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = AdminsubmodulemstTbl::find()->where([
                'AdminSubModuleMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->AMM_Status=="A")?"I":"A";
            $params['AMM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Module updated successfully',
                'returndata' => $model->ModuleMst_Pk);
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->AMM_Status=="A")?"I":"A";
        
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }

    public function actionDelete($id) {
        $module = AdminsubmodulemstTbl::find()->where([
            'AdminSubModuleMst_Pk'    =>  $id
        ])->one();

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }

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


    public function actionModulelist()
    {
        return new ActiveDataProvider([
            'query' => ModulemstTbl::find()->active()
        ]);

    }
    
    public function actionGetuserrole(){
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT UserRoleMst_Pk,URM_Role FROM userrolemst_tbl WHERE 	URM_Status="A"');
        $users = $model->queryAll();
        return $users;
    }
    
    public function actionGetadminmodule(){
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT AdminSubModuleMst_Pk,AMM_ModName FROM adminmodulemst_tb WHERE 	AMM_Status="A"');
        $users = $model->queryAll();
        return $users;
    }

}
