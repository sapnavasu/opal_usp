<?php
namespace api\modules\shp\controllers;

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

use common\models\EventsdtlTbl;
use common\models\DepartmentmstTbl;
use app\modules\nbf\components\Profile;
use common\models\SponsordtlsTbl;

class EventmstController extends MasterController
{
    public $modelClass = 'common\models\EventsdtlTbl';
    
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

       $query = EventsdtlTbl::find();
//        $deptmst = \common\models\DepartmentmstTbl::findAll(array("DM_Status"=>"A","DM_MembCompMst_Fk"=>549));
//        $deptmst->select(['*']);
//        $deptmst->asArray();
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
        
        $query->andWhere(['ed_isdeleted'=>0]);
        $query->leftJoin('countrymst_tbl','CountryMst_Pk=ed_countrymst_fk');
        $query->leftJoin('statemst_tbl','StateMst_Pk=ed_statemst_fk');
        $query->leftJoin('citymst_tbl','CityMst_Pk=ed_citymst_fk');
        $query->select(['*']);
        $query->asArray();
        
       
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        
    }
    
    public function actionDeleteevent() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $eventPk = $data['eventid'];
        $model = EventsdtlTbl::find()->where([
            'eventsdtl_pk'    =>  $eventPk
        ])->one();
        $model->ed_isdeleted=1;
        $model->ed_deletedbyipaddr= '192.168.1.37';
        $model->ed_deletedon= date('Y-m-d H:i:s');
        $model->ed_deletedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        
        if ($model->save() === false) {
            $model->getErrors();
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    
    }
    
    public function actionUpdateevent() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $eventPk = $data['eventid'];
        $model = EventsdtlTbl::find()->where([
            'eventsdtl_pk'    =>  $eventPk
        ])->one();
        if($model->ed_status == 3){            
            $model->ed_status=2;
        }elseif ($model->ed_status == 2) {
            $model->ed_status=3;            
        }
        $model->ed_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->ed_updatedbyipaddr = '192.168.1.37';
        $model->ed_updatedon = date('Y-m-d H:i:s');
                
        if ($model->save() === false) {
            $model->getErrors();
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
}


    public function actionAddevent() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $formArray = $data['eventForm'];   
        $eventstartdate = date('Y-m-d',  strtotime($formArray['ed_eventstrtdt']));
        $eventstarttime = date('H:i:s',  strtotime($formArray['ed_eventstrttime']));
        $eventstartdatetime = date('Y-m-d H:i:s',  strtotime($eventstartdate.$eventstarttime));
        
        $eventenddate = date('Y-m-d',  strtotime($formArray['ed_eventenddate']));
        $eventendtime = date('H:i:s',  strtotime($formArray['ed_eventendtime']));
        $eventenddatetime = date('Y-m-d H:i:s',  strtotime($eventenddate.$eventendtime));
        
        if(empty($formArray['eventsdtl_pk'])){
        $model = new EventsdtlTbl();
        
        $model->ed_title = $formArray['ed_title'];
        $model->ed_eventcategory = $formArray['ed_eventcategory'];
        $model->ed_eventdesc = $formArray['ed_eventdesc'];
        $model->ed_cntpername = $formArray['ed_cntpername'];
        $model->ed_cntperemail = $formArray['ed_cntperemail'];
        $model->ed_eventstrtdt = $eventstartdatetime;
        $model->ed_locationname = $formArray['ed_locationname'];
        $model->ed_addrline1 = $formArray['ed_addrline1'];
        $model->ed_citymst_fk = $formArray['ed_citymst_fk'];
        $model->ed_cntperdept = $formArray['ed_cntperdept'];
        $model->ed_cntperdesg = $formArray['ed_cntperdesg'];
        $model->ed_cntperlandlinecc = (string)$formArray['CodeVal'];
        $model->ed_cntperlandlineno = $formArray['phoneNumber'];
        $model->ed_cntperlandlineext = $formArray['phoneNumberExt'];
        $model->ed_cntpermobno = $formArray['mobileNumber'];
        $model->ed_eventenddt = $eventenddatetime;
        $model->ed_cntpermobcc = $formArray['mobileCode'];
        
        $model->ed_status = 1;
        $model->ed_isdeleted = 0;
        $model->ed_createdon = date('Y-m-d H:i:s');
        $model->ed_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->ed_countrymst_fk = '23';
        $model->ed_mapcoordinates = '23.2321 , 21.4353';
        $model->ed_orgname = 'ganesh';
        $model->ed_orgaddr = 'india';
        $model->ed_ispropagation = '1';
        $model->ed_createdbyipaddr = '192.168.1.37';
        
        }else{
        $model = EventsdtlTbl::find()->where([
        'eventsdtl_pk'    =>  $formArray['eventsdtl_pk']
        ])->one();
        $model->ed_title = $formArray['ed_title'];
        $model->ed_eventcategory = $formArray['ed_eventcategory'];
        $model->ed_eventdesc = $formArray['ed_eventdesc'];
        $model->ed_cntpername = $formArray['ed_cntpername'];
        $model->ed_cntperemail = $formArray['ed_cntperemail'];
        $model->ed_eventstrtdt = $eventstartdatetime;
        $model->ed_locationname = $formArray['ed_locationname'];
        $model->ed_addrline1 = $formArray['ed_addrline1'];
        $model->ed_citymst_fk = $formArray['ed_citymst_fk'];
        $model->ed_cntperdept = $formArray['ed_cntperdept'];
        $model->ed_cntperdesg = $formArray['ed_cntperdesg'];
        $model->ed_cntperlandlinecc = (string)$formArray['CodeVal'];
        $model->ed_cntperlandlineno = $formArray['phoneNumber'];
        $model->ed_cntperlandlineext = $formArray['phoneNumberExt'];
        $model->ed_cntpermobno = $formArray['mobileNumber'];
        $model->ed_eventenddt = $eventenddatetime;
        $model->ed_cntpermobcc = $formArray['mobileCode'];
        
        $model->ed_status = 1;
        $model->ed_isdeleted = 0;
        $model->ed_countrymst_fk = '23';
        $model->ed_orgname = 'ganesh';
        $model->ed_orgaddr = 'india';
        $model->ed_ispropagation = '1';
        $model->ed_mapcoordinates = '23.2321 , 21.4353';
        
        $model->ed_updatedon = date('Y-m-d H:i:s');
        $model->ed_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->ed_updatedbyipaddr = '192.168.1.37';
        }
        if ($model->save() === false) {
            echo '<pre>';
            print_r($model->getErrors());exit;
        }else{
            if($formArray['sponserDtl']){            
                foreach ($formArray['sponserDtl'] as $sponserVal){
                    if(!empty($sponserVal['sponserName'])){
                        if($sponserVal['sponserFile'] != ''){
                            $fileVal = explode("\\", $sponserVal['sponserFile']);
                            $filename = end($fileVal);
                        }  else {
                            $filename = $sponserVal['sponserFileVal'];                       
                        }
                        if(empty($sponserVal['sponserPk'])){
                            $modelSponser = new SponsordtlsTbl();
                            $modelSponser->sd_eventsdtl_fk = $model->eventsdtl_pk;
                            $modelSponser->sd_sponsorname = $sponserVal['sponserName'];
                            $modelSponser->sd_sponsorlogo = $filename;
                            $modelSponser->sd_createdon  = date('Y-m-d H:i:s');
                            $modelSponser->sd_createdby  = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                            $modelSponser->sd_createdbyipaddr  ='192.168.1.52';
                            if ($modelSponser->save() === false) {
                                echo '<pre>';
                                print_r($modelSponser->getErrors());exit;
                            }
                        }  else {
                            $modelSponser = SponsordtlsTbl::find()->where(['sponsordtls_pk'=> $sponserVal['sponserPk']])->one();                        
                            $modelSponser->sd_sponsorname = $sponserVal['sponserName'];
                            $modelSponser->sd_sponsorlogo = $filename;
                            $modelSponser->sd_updatedon  = date('Y-m-d H:i:s');
                            $modelSponser->sd_updatedby  = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                            $modelSponser->sd_updatedbyipaddr  ='192.168.1.52';
                            if ($modelSponser->save() === false) {
                                echo '<pre>';
                                print_r($modelSponser->getErrors());exit;
                            }
                        }
                    }
                }                
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
                return "ok";
            }
        }

    }
    
    public function actionEditevent() { 
        $webinarPk = $_REQUEST['eventid'];
        $model = EventsdtlTbl::find()
                ->select(['*'])
                ->where(['eventsdtl_pk'=> $webinarPk])->one();
        if (empty($model)) {
            $model->getErrors();
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }

    }    
    public function actionDeletesponser() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $sponserPk = $data['sponserpk'];    
        $model = SponsordtlsTbl::find()
                ->where(['sponsordtls_pk'=> $sponserPk])->one();
        if ($model->delete() === false) {
            $model->getErrors();
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }

    }    
        public function actionGetsponser() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $eventPk = $data['eventPk'];
        $model = SponsordtlsTbl::find()
                ->select(['*'])
                ->where(['sd_eventsdtl_fk'=> $eventPk])->all();
        if (empty($model)) {
            $model->getErrors();
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }

    }    
    public function actionUploadsponser() { 
        $fileData = $_FILES;
        if($fileData['file']['type'] == 'image/png' || $fileData['file']['type'] == 'image/jpeg' || $fileData['file']['type'] == 'image/jpg'){
            if($fileData['file']['size'] < 4500000){
                $upload_dir = getcwd() . '/../backend/assets/images/sponser/';
                $file = $upload_dir.basename($fileData['file']['name']); 
                if (move_uploaded_file($fileData['file']["tmp_name"], $file)) {
                    return [
                    'msg' => "success",
                    'fileName' => $fileData['file']['name'],
                    'status' => 1,
                    ];
                }
            }else {                
                return [
                    'msg' => "Error",
                    'status' => 1,
                ];
            }
        }  else {
            return [
                'msg' => "File Format",
                'status' => 1,
            ];
        }
        }  
        
        
        
    public function actionNocindex(){

       $query = \api\modules\mst\models\LicensinginfoTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
            $arr = explode(',',$_REQUEST['license']);
                if(!is_null($val))
                {
                        if($_REQUEST['searchvalue']){
                        $query->andOnCondition(['or',['LIKE','li_lictitleen', ':value',array(':value' =>  $_REQUEST['searchvalue'])],['LIKE','li_referenceno', ':value',array(':value' =>  $_REQUEST['searchvalue'])]]);
                        }
                        if($_REQUEST['license']){
                        $licarr = explode(',',$_REQUEST['license']);
                        $query->andFilterWhere(['in','licensinginfo_pk',$licarr]);
                        }
                        if($_REQUEST['licenseauth']){
                        $arr = explode(',',$_REQUEST['licenseauth']);
                        $query->andFilterWhere(['in','SectorMst_Pk',$arr]);
                        }
                }
            }
        }
        
        $query->select(["li_referenceno,li_lictitleen,SecM_SectorName,CASE WHEN count(licinvapplied_pk) = 0 THEN 'Nil'
            WHEN count(licinvapplied_pk) > 0 THEN count(licinvapplied_pk)
            END AS apprvlcount,CASE WHEN count(licescalation_pk) = 0 THEN 'Nil'
            WHEN count(licescalation_pk) > 0 THEN count(licescalation_pk)
            END AS essclcount"]);
        $query->andWhere(['li_status'=>1]);
        $query->leftJoin('licproceduremst_tbl','licproceduremst_pk=li_licproceduremst_fk');
        $query->leftJoin('sectormst_tbl','SectorMst_Pk=li_sectormst_fk');
        $query->leftJoin('licinvapplied_tbl','licensinginfo_pk=lia_licensinginfo_fk');
        $query->leftJoin('licescalation_tbl','lesc_licinvapplied_fk=licinvapplied_pk');
        $query->groupBy(['licensinginfo_pk']);
        $query->asArray();
        
       
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        
    }
    }
