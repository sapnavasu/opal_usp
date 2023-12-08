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
use api\modules\mst\models\UnsscbiscmappingTbl;
use api\modules\mst\models\BgiinduscodeservmstTbl;
use api\modules\mst\models\ServicemstTbl;
use api\modules\mst\models\SegmentmstTbl;
use api\modules\mst\models\FamilymstTbl;
use api\modules\mst\models\ClassmstTbl;

class UnsscbiscmappingController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\UnsscbiscmappingTbl';

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


        $query = UnsscbiscmappingTbl::find();
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
        $query->select(['*','group_concat(ubsm_servicemst_fk)','group_concat(SrvM_ServiceName) AS service']);
        $query->leftJoin('bgiinduscodeservmst_tbl','bgiinduscodeservmst_tbl.bgiinduscodeservmst_pk=unsscbiscmapping_tbl.ubsm_bgiinduscodeservmst_fk');
        $query->leftJoin('servicemst_tbl','servicemst_tbl.ServiceMst_Pk=unsscbiscmapping_tbl.ubsm_servicemst_fk');
        $query->groupBy('ubsm_bgiinduscodeservmst_fk');
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
        $service = UnsscbiscmappingTbl::find()->where([
            'unsscbiscmapping_pk'    =>  $id
        ])->one();
       
        //echo "<pre>";print_r($UnsscbiscmappingTbl);die;
        // print_r($service);exit;
        if($service){
            return $service;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $service = UnsscbiscmappingTbl::find()->active()->where([
            'unsscbiscmapping_pk'    =>  $id
        ])->one();
        if($service){
            return $service;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewuser(){
        $model = new UnsscbiscmappingTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        // foreach ($data['usermaster'] as $key=>$value) {
        //     if($key=="status")
        //     {
        //         $status=($data['usermaster']['status'] ==true)?"A":"I";
        //         $params['aum_'.$key.'']=$status;
        //     }
        //     else {
        //         $params['aum_'.$key.'']=$value;
        //     }
        // } 
        $model->ubsm_bgiinduscodeservmst_fk=$data['usermaster']['service'];
        $model->ubsm_servicemst_fk=$data['usermaster']['map'];
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'user created successfully',
                'returndata' => $model->unsscbiscmapping_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>"E",
                'msg'=>'something went wrong',

            );
            //throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = UnsscbiscmappingTbl::find()->where([
            'unsscbiscmapping_pk'    =>  $id
        ])->one();
        if($data['usermaster'])
        {
            foreach ($data['usermaster'] as $key=>$value) {
                if($key=="status")
                {
                    $status=($data['usermaster']['status'] ==true)?"A":"I";
                    $params['aum_'.$key.'']=$status;
                }
                else {
                    $params['aum_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'user updated successfully',
                    'returndata' => $model->unsscbiscmapping_pk
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
            $model = UnsscbiscmappingTbl::find()->where([
                'unsscbiscmapping_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->aum_status=="A")?"I":"A";
            //$params['aum_status']=$status;
            $model->aum_status=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'updated successfully',
                    'returndata' => $model->unsscbiscmapping_pk
                );
            }

        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->aum_status=="A")?"I":"A";  
        $model->aum_status=$status;
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
        
        $a=1;
        $models = UnsscbiscmappingTbl::find()->where([
            'ubsm_bgiinduscodeservmst_fk'    =>  $id
        ])->all();
        foreach ($models as $model) {
            if ($model->delete() === false) {
                $a=0;
            }
        }
        if ($a==0) {
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
    public function actionGetproduct(){
        return new ActiveDataProvider([
            'query' => BgiinduscodeservmstTbl::find()
                ->select(['bgiinduscodeservmst_pk','bicsm_servicename'])
                ->where(['bicsm_servstatus'=>1]),
            'pagination'=>['pageSize' => false],
        ]); 

    }

    public function actionGetmaplist(){
        // ini_set('memory_limit', '256M');
        return new ActiveDataProvider([
            'query' => ServicemstTbl::find()
                      ->where(['SrvM_Status'=>'A','SrvM_ClassMst_Fk'=>$_GET['id']])
                      ->select(['ServiceMst_Pk','SrvM_ServiceName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }
    public function actionGetsegmentlist(){
        // ini_set('memory_limit', '256M');
        
        return new ActiveDataProvider([
            'query' => SegmentmstTbl::find()
                      ->where(['SegM_Status'=>'A','SegM_SegCategory'=>'S'])
                      ->select(['SegmentMst_Pk','SegM_SegName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionGetfamilylist(){
        // ini_set('memory_limit', '256M');
        
        return new ActiveDataProvider([
            'query' => FamilymstTbl::find()
                      ->where(['FamM_Status'=>'A','FamM_FamilyCategory'=>'S','FamM_SegmentMst_Fk'=>$_GET['id']])
                      ->select(['FamilyMst_Pk','FamM_FamilyName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionGetclasslist(){
        // ini_set('memory_limit', '256M');
        
        return new ActiveDataProvider([
            'query' => ClassmstTbl::find()
                      ->where(['ClsM_Status'=>'A','ClsM_FamilyCategory'=>'S','ClsM_FamilyMst_Fk'=>$_GET['id']])
                      ->select(['ClassMst_Pk','ClsM_ClassName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }
    public function actionGetchipslist(){
               
        return new ActiveDataProvider([
            'query' => UnsscbiscmappingTbl::find()
                ->select(['ubsm_bgiinduscodeservmst_fk','ubsm_servicemst_fk','servicemst_tbl.SrvM_ServiceName'])
                ->where(['ubsm_bgiinduscodeservmst_fk'=>$_GET['id']])
                ->leftJoin('servicemst_tbl','servicemst_tbl.ServiceMst_Pk=unsscbiscmapping_tbl.ubsm_servicemst_fk')
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }
    public function actionInsertmap(){
        
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
      
        $x = 0;
        $flag=1;
        $delflag=1;
        for ($x = 0; $x < count($data['add']); $x++) {
            $model = new UnsscbiscmappingTbl();
            $model->ubsm_bgiinduscodeservmst_fk=$data['add'][$x]['ubsm_bgiinduscodeservmst_fk'];
            $model->ubsm_servicemst_fk=$data['add'][$x]['ubsm_servicemst_fk'];
            // print_r($data['add'][$x]);
            if ($model->validate() && $model->save()) {
                $flag=1;
            }
            else{
                $flag=0;
            }
        }
        $x = 0;
        for ($x = 0; $x < count($data['del']); $x++) {
            $model = UnsscbiscmappingTbl::find()
            ->where(['ubsm_bgiinduscodeservmst_fk'=>$data['del'][$x]['ubsm_bgiinduscodeservmst_fk'],
            'ubsm_servicemst_fk'=>$data['del'][$x]['ubsm_servicemst_fk']])
            ->one();
            if ($model->delete()) {
                $delflag=1;
            }
            else{
                $delflag=0;
            }
                       
        }
        
        
        if ($flag == 1 and $delflag == 1) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Mapped Successfully',
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>"E",
                'msg'=>'something went wrong',

            );
    }
    return json_encode($result);
}
public function actionFiltersegment(){
               
    return new ActiveDataProvider([
        'query' => SegmentmstTbl::find()
            ->where(['SegM_Status'=>'A','SegM_SegCategory'=>'S'])
            ->select(['SegmentMst_Pk','SegM_SegName'])
            ->andWhere(['like', 'SegM_SegName', $_GET['val']])
            ->asArray(),
        'pagination'=>false,
    ]); 
   
}

public function actionFilterfamily(){
           
    return new ActiveDataProvider([
        'query' => FamilymstTbl::find()
            ->where(['FamM_Status'=>'A','FamM_FamilyCategory'=>'S'])
            ->select(['FamilyMst_Pk','FamM_FamilyName','FamM_SegmentMst_Fk'])
            ->andWhere(['like', 'FamM_FamilyName', $_GET['val']])
            ->asArray(),
        'pagination'=>['pageSize' => false],
    ]); 
   
}
public function actionFilterclass(){
           
    return new ActiveDataProvider([
        'query' => ClassmstTbl::find()
            ->where(['ClsM_Status'=>'A','ClsM_FamilyCategory'=>'S'])
            ->select(['ClassMst_Pk','ClsM_ClassName','ClsM_SegmentMst_Fk','ClsM_FamilyMst_Fk'])
            ->andWhere(['like', 'ClsM_ClassName', $_GET['val']])
            ->asArray(),
        'pagination'=>['pageSize' => false],
    ]); 
   
}

public function actionFilterproduct(){
           
    return new ActiveDataProvider([
        'query' => ServicemstTbl::find()
            ->where(['SrvM_Status'=>'A'])
            ->select(['ServiceMst_Pk','SrvM_ServiceName','SrvM_SegmentMst_Fk','SrvM_FamilyMst_Fk','SrvM_ClassMst_Fk'])
            ->andWhere(['like', 'SrvM_ServiceName', $_GET['val']])
            ->asArray(),
        'pagination'=>['pageSize' => false],
    ]); 
   
}
}