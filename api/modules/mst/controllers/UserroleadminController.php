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

use api\modules\mst\models\AdminuserrolemstTbl;

class UserroleadminController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\AdminuserrolemstTbl';

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

    public function actionIndex(){

        $rolename = $_REQUEST['rolename'];
        $rolestatus=$_REQUEST['rolestatus'];
        $query = AdminuserrolemstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                $query->andFilterWhere(['LIKE','adminuserrolemst_tbl.'.$key, $val]);
            }
        }
        //print_r($query);die;
        $query->select(['adminuserrolemst_tbl.*',
            'if(adminuserrolemst_tbl.aurm_status = "A", "primary","warn") as `color`']);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query,
            'pagination' => [ 'pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $country = AdminuserrolemstTbl::find()->where([
            'adminuserrolemst_pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $country = AdminuserrolemstTbl::find()->active()->where([
            'adminuserrolemst_pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    /**
     * Create new staff member from backend dashboard
     *
     * Request: POST /v1/staff/1
     *
     * @return User
     * @throws HttpException
     */
    public function actionNewrole(){

        $model = new AdminuserrolemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['userrolemaster'] as $key=>$value) {
            if($key=="status")
            {
                $status=($data['statemaster']['status'] ==true)?"A":"I";
                $params['aurm_'.$key.'']=$status;
            }
            else {
                $params['aurm_'.$key.'']=trim($value);
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'flag'=>"S",
                'statusmsg' => 'success',
                'msg'=>'Role created successfully',
                'returndata' => $model->adminuserrolemst_pk
            );
        } else {
            // $result=print_r($model->getErrors()['aurm_userrole'][0]);
            $result=array(
                'status' => 201,
                'flag'=>"E",
                'statusmsg' => 'warning',
                'msg'=>'Role already exists',
            );
            //throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = AdminuserrolemstTbl::find()->where([
            'adminuserrolemst_pk'    =>  $id
        ])->one();
        if($data['userrolemaster'])
        {
            foreach ($data['userrolemaster'] as $key=>$value) {
                if($key=="status")
                {
                    $status=($data['userrolemaster']['status'] ==true)?"A":"I";
                    $params['aurm_'.$key.'']=$status;
                }
                else {
                    $params['aurm_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = AdminuserrolemstTbl::find()->where([
                'adminuserrolemst_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->aurm_status=="A")?"I":"A";
            $params['aurm_status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Role updated successfully',
                'returndata' => $model->adminuserrolemst_pk
            );
        } else {
            $result=array(
                'status' => 200,
                'flag'=>"E",
                'statusmsg' => 'warning',
                'msg'=>'Role already exists',
            );
            //throw new HttpException(422, json_encode($model->errors));
        }
        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->aurm_status=="A")?"I":"A";
        $model->aurm_status=$status;
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
        $model = AdminuserrolemstTbl::find()->where([
            'adminuserrolemst_pk'    =>  $id
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

    public function actionStatelistbycountry()
    {
        return new ActiveDataProvider([
            'query' => AdminuserrolemstTbl::find()
                ->select(['StateMst_Pk','aurm_StateName'])
                ->where(['aurm_CountryMst_Fk'=>$_GET['countryid']])
                ->active()
        ]);
    }

    public function actionGetuserrole()
    {
        return new ActiveDataProvider([
            'query' => AdminuserrolemstTbl::find()
                ->select(['adminuserrolemst_pk','aurm_userrole'])
        ]);
    }

}