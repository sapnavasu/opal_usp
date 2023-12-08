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
use api\modules\mst\models\IndustrymstTbl;
class IndustrymstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\IndustrymstTbl';

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
        $sectorname		=	$_REQUEST['sectorname'];
        $industryname	=	$_REQUEST['industryname'];
        
        $query = IndustrymstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if($val !=null && $key != 'year' && $key != 'gdp')
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['industrymst_tbl.*','if(industrymst_tbl.IndM_Status = "A", "primary","warn") as `color`','SecM_SectorName']);
        $query->leftJoin('sectormst_tbl','industrymst_tbl.IndM_SectorMst_Fk=sectormst_tbl.sectorMst_Pk');
        if(!empty($_REQUEST['year'])){
            $query->andWhere("json_contains(indm_gdp,json_object('year','{$_REQUEST['year']}'))");
        }
        if(!empty($_REQUEST['gdp'])){
            $query->andWhere("json_contains(indm_gdp,json_object('gdp','{$_REQUEST['gdp']}'))");
        }
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $industry = IndustrymstTbl::find()->where([
            'IndustryMst_Pk'    =>  $id
        ])->one();
        if($industry){
            return $industry;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $industry = IndustrymstTbl::find()->active()->where([
            'IndustryMst_Pk'    =>  $id
        ])->one();
        if($industry){
            return $industry;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }



    public function actionNewindustry(){
        $model = new IndustrymstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['industrymaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['industrymaster']['Status'] ==true)?"A":"I";
                $params['IndM_'.$key.'']=$status;
            }
            else {
                $params['IndM_'.$key.'']=$value;
            }
        }
        $model->indm_gdp = $data['industrymaster']['gdp'];
        $params['IndM_CreatedOn'] = date("Y-m-d h:i:s");
        $params['IndM_CreatedBy'] = ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Industry created successfully',
                'returndata' => $model->IndustryMst_Pk
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
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = IndustrymstTbl::find()->where([
            'IndustryMst_Pk'    =>  $id
        ])->one();
        if($data['industrymaster'])
        {
            foreach ($data['industrymaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['industrymaster']['Status'] ==true)?"A":"I";
                    $params['IndM_'.$key.'']=$status;
                }
                else {
                    $params['IndM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            // echo "fdgjdgnb";die;
            $model = IndustrymstTbl::find()->where([
                'IndustryMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->IndM_Status=="A")?"I":"A";
            $params['IndM_Status']=$status;
        }
        $model->indm_gdp = $data['industrymaster']['gdp'];
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Industry updated successfully',
                'returndata' => $model->IndustryMst_Pk
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
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->IndM_status=="A")?"I":"A";
        $model->IndM_status=$status;
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
        $model = IndustrymstTbl::find()->where([
            'IndustryMst_Pk'    =>  $id
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

    public function actionIndustrylistbysector()
    {
        return new ActiveDataProvider([
            'query' => IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->where(['IndM_SectorMst_Fk'=>$_GET['sector']]),
                'pagination'=>false
        ]);
    }
    public function actionIndustrylist()
    {
        return new ActiveDataProvider([
            'query' => IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->active()
        ]);
    }
}