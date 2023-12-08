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
use yii\web\Response;
use api\modules\mst\models\CountryMasterQuery;
use app\models\OpalcountrymstTblQuery;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\CountryMaster;
use api\common\services\CacheBGI;


class CountryController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\CountryMaster';

    public function __construct($id='', $module='', $config = [])
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


        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        
        $query = CountryMaster::find();
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
        $query->select(['countrymst_tbl.*',
            'if(countrymst_tbl.CyM_Status = "A", "primary","warn") as `color`']);
        $query->where('cym_globalportalmst_fk = :cym_globalportalmst_fk',[':cym_globalportalmst_fk' => Yii::$app->params['globalportalmst_pk']]);
        $query->asArray();
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        //echo $page;die;
        $provider = new ActiveDataProvider([
            'query' =>$query,
            'pagination' => ['pageSize' =>$page]]);


        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){

        $country = CountryMaster::find()->where([
            'CountryMst_Pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    public function actionNewcountry(){
        $model = new CountryMaster();
        $params=[];
        $result=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['countrymaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['countrymaster']['Status'] ==true)?"A":"I";
                $params['CyM_'.$key.'']=$status;
            }
            else {
                $params['CyM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        $status=($data['countrymaster']['country_status'] ==true)?"A":"I";
        $model->CyM_Status=$status;
        $model->cym_globalportalmst_fk = Yii::$app->params['globalportalmst_pk'];
        $model->CyM_CreatedOn = date('Y-m-d H:i:s');
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->CyM_CreatedBy = $userpk;
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Created Successfully',
                'returndata' => $model->CountryMst_Pk
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
        $model = CountryMaster::find()->where([
            'CountryMst_Pk'    =>  $id
        ])->one();
        if($data['countrymaster'])
        {
            foreach ($data['countrymaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['countrymaster']['Status'] ==true)?"A":"I";
                    $params['CyM_'.$key.'']=$status;
                }
                else {
                    $params['CyM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus']){
            $status=($model->CyM_Status=="A")?"I":"A";
            $params['CyM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Updated Successfully',
                'returndata' => $model->CountryMst_Pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Something went wrong',

            );
        }
        return json_encode($result);
    }


    public function actionDelete($id) {
        $model = CountryMaster::find()->where([
            'CountryMst_Pk'    =>  $id
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

    public function actionCountrylist()
    { 
        $deployCountry = Yii::$app->params['countrypk'];
        try{
            $cache = new CacheBGI();
            
            $cacheKey = 'country_list';
            $query = OpalcountrymstTblQuery::getCountryListwithDialCodeCache();
            if(empty($cache->retreive($cacheKey))){
               
                   $data = OpalcountrymstTblQuery::getCountryListwithDialCode( $deployCountry );
                
                $cache->store($cacheKey, $data, $duration = 0 , $query);
            } else {
                $data = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            
                   $data = OpalcountrymstTblQuery::getCountryListwithDialCode( $deployCountry );
                
        } 
        
       return  $data; 
    }
    
    public function actionGlobalcountrylist()
    {
       $data = \api\modules\mst\models\GlobalportalmstTbl::getCountryList();
       return  $data; 
    }
    
    public function actionGetdialcodebycountry(){
        $pk = $_GET['country_pk'];
        $getCode = CountryMasterQuery::getDialCodeByCountry($pk);
        return $getCode;
    }
    public function actionFlushvalue(){
        $memcacheObj        =   \common\components\BGIMemcache::getMemcacheInstance();
        if(!empty($memcacheObj)){
            if($memcacheObj->flushCache()){
                echo "Successfully flush";
            }else{
                echo "Cache Not flush";
            }
        }
        exit;
    }
}