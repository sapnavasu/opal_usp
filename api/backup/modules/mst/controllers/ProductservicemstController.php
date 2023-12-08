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

use api\modules\mst\models\MinistrypscodemstTbl;
use yii\web\Response;

class ProductservicemstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\MinistrypscodemstTbl';

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
        $query = MinistrypscodemstTbl::find();
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
            // echo "<pre>";print_r($query);die;
        }
        $query->select(['ministrypscodemst_tbl.*']);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        //echo "<pre>";print_r($query);die;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
        ];
    }
    public function actionView($id){
        $module = MinistrypscodemstTbl::find()->where([
            'MinistryPSCodeMst_Pk'    =>  $id
        ])->one();
        if($module){
            return $module;
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
    public function actionNewmps(){

        $model = new MinistrypscodemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['Productservicemaster'] as $key=>$value) {
            $params['BSM_'.$key.'']=$value;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Product/Service created successfully',
                'returndata' => $model->MinistryPSCodeMst_Pk);
        } else {
            //rint_r($model->getErrors());die;
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');;
        }
        return json_encode($result);
    }


    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['Productservicemaster'])
        {
            $model = MinistrypscodemstTbl::find()->where([
                'MinistryPSCodeMst_Pk'    =>  $id
            ])->one();
            foreach ($data['Productservicemaster'] as $key=>$value) {
                $params['BSM_'.$key.'']=$value;
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Source updated successfully',
                    'returndata' => $model->MinistryPSCodeMst_Pk);
            } else {
                $result=array('status' => 422,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong');;
            }
        }
        else if($data['updatestatus'])
        {
            $model = MinistrypscodemstTbl::find()->where([
                'MinistryPSCodeMst_Pk'    =>  $data['updatestatus']
            ])->one();
            if($model->save(false))
            {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>' updated successfully',
                    'returndata' => $model->MinistryPSCodeMst_Pk);
            }
        }


        return json_encode($result);
    }
   /* public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->BSM_Status=="A")?"I":"A";
        $model->BSM_Status=$status;
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }*/
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
        $model = $this->actionView($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
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


    /**
     * Return list of available permissions for the staff.  The function will be called when staff form is loaded in backend.
     *
     * Request: GET /v1/staff/get-permissions
     *
     * Sample Response:
     * {
     *		"success": true,
     *		"status": 200,
     *		"data": {
     *			"manageSettings": {
     *				"name": "manageSettings",
     *				"description": "Manage settings",
     *				"checked": false
     *			},
     *			"manageStaffs": {
     *				"name": "manageStaffs",
     *				"description": "Manage staffs",
     *				"checked": false
     *			}
     *		}
     *	}
     */
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
}
