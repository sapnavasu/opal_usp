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
use yii\db\ActiveRecord;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\CurrencymstTbl;
use yii\web\Response;


class CurrencymasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\CurrencymstTbl';

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
        $symbol   =   $_REQUEST['symbol'];
        $code     =   $_REQUEST['code'];
        $name     =   $_REQUEST['name'];
        $requestdata = $_REQUEST;
        $query = CurrencymstTbl::find();
        if($requestdata['type']=='filter')
        {
            unset($requestdata['type']);
            unset($requestdata['sort']);
            unset($requestdata['order']);
            unset($requestdata['page']);
            unset($requestdata['size']);
            foreach(array_filter($requestdata) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['currencymst_tbl.*',
            'if(currencymst_tbl.CurM_Status = "A", "primary","warn") as `color`']);
        $sort_column = (strpos($_REQUEST['sort'],"-") !== false) ? explode("-",$_REQUEST['sort'])[1] : $_REQUEST['sort'];
        $query->orderBy("$sort_column {$_REQUEST['order']}");
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            //'limit' =>10,
        ];
    }
    public function actionView($id){
        $module = CurrencymstTbl::find()->where([
            'CurrencyMst_Pk'    =>  $id
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
    public function actionNewcurrency(){

        $model = new CurrencymstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $sm_name=$data['currencymaster']['CurrSymbol'];
        $check_model = CurrencymstTbl::find()->where(['CurM_CurrSymbol'=> $sm_name])->one();
        if($check_model){
            /* echo "duplicate";exit; */
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Currency Symbol is already available',

            );
            return json_encode($result);
        }
        foreach ($data['currencymaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['currencymaster']['Status'] ==true)?"A":"I";
                $params['CurM_'.$key.'']=$status;
            }
            else {
                $params['CurM_'.$key.'']=$value;
            }
        }
        $userpk = ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->CurM_CreatedOn = date('Y-m-d H:i:s');
        $model->CurM_CreatedBy = $userpk;
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Currency created successfully',
                'returndata' => $model->CurrencyMst_Pk);
        } else {
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');
                
        }
        return json_encode($result);
    }


    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['currencymaster'])
        { 
          $sm_name=$data['currencymaster']['CurrSymbol'];
        $check_model = CurrencymstTbl::find()
                        ->where(['CurM_CurrSymbol'=> $sm_name])
                        ->andWhere(['<>','CurrencyMst_Pk', $id])
                        ->one();
        if($check_model){
            /* echo "duplicate";exit; */
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Currency Symbol is already available',

            );
            return json_encode($result);
        }  
          
          
          $model = CurrencymstTbl::find()->where([
                'CurrencyMst_Pk'    =>  $id
            ])->one();

            
            foreach ($data['currencymaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['currencymaster']['Status'] ==true)?"A":"I";
                    $params['CurM_'.$key.'']=$status;
                }
                else {
                    $params['CurM_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Currency updated successfully',
                    'returndata' => $model->CurrencyMst_Pk);
            } else {
              $result=array(
                  'status' => 422,
                  'statusmsg' => 'warning',
                  'flag'=>'E',
                  'msg'=>'Something went wrong !',

              );
            }
        }
        else if($data['updatestatus'])
        {
            $model = CurrencymstTbl::find()->where([
                'CurrencyMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->CurM_Status=="A")?"I":"A";
            $model->CurM_Status=$status;
            if($model->save(false))
            {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>' updated successfully',
                    'returndata' => $model->CurrencyMst_Pk);
            }
        }


        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->CurM_Status=="A")?"I":"A";
        $model->CurM_Status=$status;
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
    
    public function actionCurrencylist(){
        return CurrencymstTbl::activecurrency();
    }
}
