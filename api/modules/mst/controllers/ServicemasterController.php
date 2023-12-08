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

use api\modules\mst\models\ServicemstTbl;
use yii\web\Response;

class ServicemasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\ServicemstTbl';

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
        $familyname     =   $_REQUEST['familyname'];
        $segmentname    =   $_REQUEST['segmentname'];
        $classname      =   $_REQUEST['classname'];
        $servicecode    =   $_REQUEST['servicecode'];
        $servicename    =   $_REQUEST['servicename'];
        $query = ServicemstTbl::find();
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
        $query -> select([
            "*",
            "if(servicemst_tbl.SrvM_Status = 'A', 'primary','warn') as `color`",
            "(select count(*) from servicemst_tbl) as overallcount",
            "classmst_tbl.ClsM_ClassName",
            "familymst_tbl.FamM_FamilyName",
            "segmentmst_tbl.SegM_SegName",
        ]);
        $query->leftJoin('classmst_tbl','classmst_tbl.ClassMst_Pk = servicemst_tbl.SrvM_ClassMst_Fk');
        $query->leftJoin('familymst_tbl','familymst_tbl.FamilyMst_Pk = classmst_tbl.ClsM_FamilyMst_Fk');
        $query->leftJoin('segmentmst_tbl','segmentmst_tbl.SegmentMst_Pk = familymst_tbl.FamM_SegmentMst_Fk');

        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items'         =>  $provider->getModels(),
            'total_count'   =>  $provider->getTotalCount(),
            'limit'         =>  10,
        ];

    }

    public function actionView($id){

        $class = ServicemstTbl::find()
            ->select(['servicemst_tbl.*'
                ,"segmentmst_tbl.SegM_SegName",
                "familymst_tbl.FamM_FamilyName",
                "classmst_tbl.ClsM_ClassName",
                "segmentmst_tbl.SegmentMst_Pk",
                "familymst_tbl.FamilyMst_Pk",
                "classmst_tbl.ClassMst_Pk",
                "if(servicemst_tbl.SrvM_Status = 'A', 'primary','warn') as `color`"])
            ->leftJoin('classmst_tbl','servicemst_tbl.SrvM_ClassMst_Fk=classmst_tbl.ClassMst_Pk')
            ->leftJoin('familymst_tbl','classmst_tbl.ClsM_FamilyMst_Fk=familymst_tbl.FamilyMst_Pk')
            ->leftJoin('segmentmst_tbl','familymst_tbl.FamM_SegmentMst_Fk=segmentmst_tbl.SegmentMst_Pk')
            ->where(['ServiceMst_Pk'=>$id])
            ->asArray()
            ->all();

        if($class){
            return $class;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }

    }
    public function actionNewservice(){

        $model = new ServicemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['servicemaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['servicemaster']['Status'] ==true)?"A":"I";
                $params['SrvM_'.$key.'']=$status;
            }
            else {
                $params['SrvM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200, 'statusmsg' => 'success',
                'msg'=>'Service created successfully',
                'returndata' => $model->ServiceMst_Pk);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
        return json_encode($result);
    }
    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['servicemaster'])
        {
            $model = ServicemstTbl::find()->where([
                'ServiceMst_Pk'    =>  $id
            ])->one();
            foreach ($data['servicemaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['servicemaster']['Status'] ==true)?"A":"I";
                    $params['SrvM_'.$key.'']=$status;
                }
                else {
                    $params['SrvM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = ServicemstTbl::find()->where([
                'ServiceMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->SrvM_Status=="A")?"I":"A";
            $params['SrvM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Service updated successfully',
                'returndata' => $model->ServiceMst_Pk
            );
        } else {
            $result=array('status' => 200, 'statusmsg' => 'danger',
                'msg'=>$model->getErrors(),
                'returndata' => $model->ClassMst_Pk);
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionDelete($id) {
        $model = ServicemstTbl::find()->where([
            'ServiceMst_Pk'    =>  $id
        ])->one();
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
