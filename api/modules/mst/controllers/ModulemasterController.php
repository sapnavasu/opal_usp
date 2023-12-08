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

use api\modules\mst\models\ModulemstTbl;
use yii\web\Response;

class ModulemasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\ModulemstTbl';

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
    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     // add CORS filter
    //     $behaviors['corsFilter'] = [
    //         'class' => \yii\filters\Cors::className(),
    //         'cors' => [
    //             'Origin' => ['*'],
    //             'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    //             'Access-Control-Request-Headers' => ['*'],
    //         ],
    //     ];


    //     $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
    //     return $behaviors;
    // }
    public function actionView($id){
        $module = ModulemstTbl::find()->where([
            'ModuleMst_Pk'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }
    public function actionIndex(){
        $modulename = $_REQUEST['modulename'];
        $query = ModulemstTbl::find();
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
           if($val['MM_Status']==0){
            $query->andFilterWhere(['LIKE',Common::getTableWithPrefix('MM_Status', true), 0]);
           }
        }
        // $query->select(["*",
        //     "if(MM_Status = 'A', 'primary','warn') as `color`",  "if(MM_Status = 'A', 'A','I') as `MM_Status`"]);
        $query->select(["*",
            "if(MM_Status = 'A', 'primary','warn') as `color`",  "if(MM_Status = 1, 'A','I') as `MM_Status`"]);
        if($_GET['MM_Status']=='A'){
            $query->andWhere(['MM_Status'=>1]);
        }
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

        $model = new ModulemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
       
        $model->MM_Name=$data['modulemaster']['Name'];
        $model->MM_Status=($data['modulemaster']['Status'] ==true)?"A":"I";
        $model->MM_ModuleBase=$data['modulemaster']['base'];
        // foreach ($data['modulemaster'] as $key=>$value) {
        //     if($key=="Status")
        //     {
        //         $status=($data['modulemaster']['Status'] ==true)?"A":"I";
        //         $params['MM_'.$key.'']=$status;
        //     }
        //     else {
        //         $params['MM_'.$key.'']=$value;
        //     }
        // }
        // $model->load($params, '');
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
            $model = ModulemstTbl::find()->where([
                'ModuleMst_Pk'    =>  $id
            ])->one();
            $model->MM_Name=$data['modulemaster']['Name'];
            $model->MM_Status=($data['modulemaster']['Status'] ==true)?"A":"I";
            $model->MM_ModuleBase=$data['modulemaster']['base'];
            // foreach ($data['modulemaster'] as $key=>$value) {
            //     if($key=="Status")
            //     {
            //         $status=($data['modulemaster']['Status'] ==true)?"A":"I";
            //         $params['MM_'.$key.'']=$status;
            //     }
            //     else {
            //         $params['MM_'.$key.'']=$value;
            //     }
            // }
        }
        else if($data['updatestatus'])
        {
            $model = ModulemstTbl::find()->where([
                'ModuleMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->MM_Status=="A")?"I":"A";
            $params['MM_Status']=$status;
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
        $status=($model->MM_Status=="A")?"I":"A";
        $model->SM_Status=$status;
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
        $model = ModulemstTbl::find()->where([
            'ModuleMst_Pk'    =>  $id
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


}
