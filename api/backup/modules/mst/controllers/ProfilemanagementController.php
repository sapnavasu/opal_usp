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
use api\modules\mst\models\MemcompprofachvdtlsTbl;

class ProfilemanagementController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\MemcompprofachvdtlsTbl';
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

        $query = MemcompprofachvdtlsTbl::find();
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
            //print_r($query);die;
        }
        $query->select(['memcompprofachvdtls_tbl.*']);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' =>$page,
            ],
        ]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $industry = MemcompprofachvdtlsTbl::find()->where([
            'SpecificationMst_Pk'    =>  $id
        ])->one();
        if($industry){
            return $industry;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function actionAcheivement()
    {
        $model = new MemcompprofachvdtlsTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        print_r($data);die;
        foreach ($data['memcompprofachvdtls_tbl'] as $key=>$value) {
            $params['SpM_'.$key.'']=$value;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Acheivement created successfully',
                'returndata' => $model->MemCompProfAchvDtls_Pk
            );
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
    public function actionSearch($id){
        $industry = MemcompprofachvdtlsTbl::find()->active()->where([
            'SpecificationMst_Pk'    =>  $id
        ])->one();
        if($industry){
            return $industry;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }



    public function actionNewspec(){
        $model = new MemcompprofachvdtlsTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['sepcmaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['sepcmaster']['Status'] ==true)?"A":"I";
                $params['SpM_'.$key.'']=$status;
            }
            else {
                $params['SpM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Soecification created successfully',
                'returndata' => $model->SpecificationMst_Pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Something went wrong',

            );
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = MemcompprofachvdtlsTbl::find()->where([
            'SpecificationMst_Pk'    =>  $id
        ])->one();
        if($data['sepcmaster'])
        {
            foreach ($data['sepcmaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['sepcmaster']['Status'] ==true)?"A":"I";
                    $params['SpM_'.$key.'']=$status;
                }
                else {
                    $params['SpM_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'Soecification updated successfully',
                    'returndata' => $model->SpecificationMst_Pk
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning','flag'=>'E',
                    'msg'=>'Something went wrong',

                );
            }
        }
        else if($data['updatestatus'])
        {
            $model = MemcompprofachvdtlsTbl::find()->where([
                'SpecificationMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->SpM_Status=="A")?"I":"A";
            $model->SpM_Status=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'updated successfully',
                    'returndata' => $model->SpecificationMst_Pk
                );
            }
        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->SpM_status=="A")?"I":"A";
        $model->SpM_status=$status;
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
    public function actioMemcompprofachvdtlsTbl($id) {
        $model = MemcompprofachvdtlsTbl::find()->where([
            'SpecificationMst_Pk'    =>  $id
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
            'query' => MemcompprofachvdtlsTbl::find()
                ->select(['StateMst_Pk','SpM_StateName'])
                ->where(['SpM_CountryMst_Fk'=>$_GET['countryid']])
                ->active()
        ]);
    }
}
