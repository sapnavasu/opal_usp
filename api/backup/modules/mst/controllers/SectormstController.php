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
use api\modules\mst\models\SectormstTbl;

class SectormstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\SectormstTbl';

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

        $query = SectormstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
           
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if($val !='null' && $key != 'year' && $key != 'gdp')
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query ->select(['sectormst_tbl.*','if(sectormst_tbl.SecM_Status = "A", "primary","warn") as `color`']);
        if(!empty($_REQUEST['year'])){
            $query->andWhere("json_contains(secm_gdp,json_object('year','{$_REQUEST['year']}'))");
        }
        if(!empty($_REQUEST['gdp'])){
            $query->andWhere("json_contains(secm_gdp,json_object('gdp','{$_REQUEST['gdp']}'))");
        }
        $query ->asArray();
        $provider = new ActiveDataProvider(['query' => $query]);
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider->pagination->pageSize=$page;

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $sector = SectormstTbl::find()->where([
            'SectorMst_Pk'    =>  $id
        ])->one();
        if($sector){
            return $sector;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $sector = SectormstTbl::find()->active()->where([
            'SectorMst_Pk'    =>  $id
        ])->one();
        if($sector){
            return $sector;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }



    public function actionNewsector(){
        $model = new SectormstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['sectormaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['sectormaster']['Status'] ==true)?"A":"I";
                $params['SecM_'.$key.'']=$status;
            }
            else {
                $params['SecM_'.$key.'']=$value;
            }
        }
        $model->secm_gdp = $data['sectormaster']['gdp'];
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Sector created successfully',
                'returndata' => $model->SectorMst_Pk
            );
        } else {
            $result=array(
                'status' => 422,
                'flag'=>'E',
                'statusmsg' => 'warning',
                'msg'=>'Something went wrong',

            );
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        if($data['sectormaster'])
        {
            $model = SectormstTbl::find()->where([
                'SectorMst_Pk'    =>  $id
            ])->one();
            foreach ($data['sectormaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['sectormaster']['Status'] ==true)?"A":"I";
                    $params['SecM_'.$key.'']=$status;
                }
                else {
                    $params['SecM_'.$key.'']=$value;
                }
            }
            $model->secm_gdp = $data['sectormaster']['gdp'];
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Sector updated successfully !',
                    'returndata' => $model->SectorMst_Pk
                );
            } else {
                $result=array(
                    'status' => 422,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'something went wrong !',

                );
                // throw new HttpException(422, json_encode($model->errors));
            }
        }
        else if($data['updatestatus'])
        {
            $model = SectormstTbl::find()->where([
                'SectorMst_Pk'    =>  $data['updatestatus']
            ])->one();
            //print_r($model);die;
            $status=($model->SecM_Status=="A")?"I":"A";
            $model->SecM_Status=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'sector updated successfully',
                    'returndata' => $model->SectorMst_Pk
                );
            }
        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->SecM_status=="A")?"I":"A";
        $model->SecM_status=$status;
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
        $model = SectormstTbl::find()->where([
            'SectorMst_Pk'    =>  $id
        ])->one();
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
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

    public function actionSectorlist()
    {
        return new ActiveDataProvider([
            'query' => SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->asArray()
                ->active()
        ]);
    }
    
    public function actionBusinessunitlist(){
        $response = [];
        $businessunitList = \common\models\MemcompsectordtlsTbl::getBusinessUnitsArr();
        foreach($businessunitList as $key => $businessUnit){
            $response[$key]['SectorMst_Pk'] = $businessUnit['MemCompSecDtls_Pk'];
            $response[$key]['SecM_SectorName'] = $businessUnit['mcsd_referenceno']." - ".$businessUnit['mcsd_businessunitrefname'];
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => ($response) ? ($response) : []
        ]);
    }
    public function actionFilterbusinessunitlist(){
        $response = [];
        $businessunitList = \common\models\MemcompsectordtlsTbl::getBusinessUnitsArr();
        foreach($businessunitList as $key => $businessUnit){
            $response[$key]['SectorMst_Pk'] = $businessUnit['MemCompSecDtls_Pk'];
            $response[$key]['SecM_SectorName'] = $businessUnit['mcsd_businessunitrefname'];
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => ($response) ? ($response) : []
        ]);
    }
}