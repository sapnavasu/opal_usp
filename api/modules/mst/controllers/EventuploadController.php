<?php

namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use Yii;

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
//use app\commonfunction\Common;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\EventTable;
//namespace app\commonfunction\api;
use app\commonfunction\api\gapi;

class EventuploadController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\EventTable';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }
    /* public function behaviors()
     {
         $behaviors = parent::behaviors();
         $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_HTML;
         return $behaviors;
     }*/
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*','http://localhost:4200'],
                //'Access-Control-Allow-Origin'=>['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials'=>true
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
    public function beforeAction($action)
    {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        // header('Access-Control-Allow-Credentials',true);
        //header("Access-Control-Allow-Headers: Content-Type");
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
    public function actionView($id){
        //echo "dfdfdsf";die;
        $module = EventTable::find()->where([
            'event_id'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }

    public function actionGetmenulist()
    {
        if($_GET) {
            $rest = array(
                0=>[state=> 'profilemanagement', name=> 'Profile Management', type=> 'sub', icon=> 'bgi-settings', 
				subicon=>'bgi-profile_management', firstReg=>'firstReg', title=>'Configuration',
                children=> [
                    0=> [state => 'profile-description test', name => 'Profile Description', sub_root => '', ga => 'Notice Board',title=>'CORPORATE PROFILE'],
                    1=> [state => 'message-form', name => 'Message From', sub_root => '', ga => 'Profile Description',title=>''],
                    2=> [state => 'visionandmision', name => 'Vision & Mission', sub_root => '', ga => 'Mission & Vision',title=>''],
                    3=> [state => 'accomplishment', name => 'Accomplishment ', sub_root => '', ga => 'Accomplishment', title=>''],
                    4=>[state=>'organizationdetail',name=>'Organisation Details',sub_root=>'',ga=>'Organisation Details',title=>''],
                    5=> [state => 'tenderboard', name => 'Oman Tender Board Registration', sub_root => '', ga => 'Tender Board',title=>''],
                    6=> [state => 'product-catalog', name => 'Product-Catalog', sub_root => '', ga => 'Product-catalog',title=>'Product-Catalog'],
                    7=> [state => 'management', name => 'Management', sub_root => '', ga => 'Management', title=>'Management'],
                    8=> [state => 'Achievements', name => 'Achievements', sub_root => '', ga => 'Achievements', title=>'Achievements'],
                    9=> [state => 'Market Presence', name => 'Market Presence', sub_root => '', ga => 'Market Presence', title=>'Market Presence'],
                ]
            ],
                1=>[state=>'home',name=>'Home',type=>'sub', icon=>'bgi-home'],
                2=>[state=> 'mastermaintance',
                    name=> 'Master Maintance',
                    type=> 'sub',
                    icon=> 'bgi-biz_search',
                    children=>
                        [
                            /* 0=> [state=> 'userrole', name=> 'User Role',
                                 sub_root=> 'manageuserrole',ga=>'Role List'],*/
                            0=> [state => 'dym', name => 'Dynamic', sub_root => 'dym', ga => 'Dynamic Form'],
                            1=>[state=> 'user', name=> 'User',
                                sub_root=> 'manageuser',ga=>'User List'],
                            2=>[state=> 'sector', name=> 'Sector',
                                sub_root=> 'managesector',ga=>'Sector List'],
                            3=>[state=> 'industry', name=> 'Industry',
                                sub_root=> 'manageindustry',ga=>'Industry List'],
                            4=>[state=> 'activities', name=> 'Activities',
                                sub_root=> 'manageactivities',ga=>'Activity List'],
                            5=>[state=> 'segment', name=> 'Segment Master',
                                sub_root=> 'managesegment',ga=>'Segment List'],
                            6=>[state=> 'currency', name=> 'Currency',
                                sub_root=> 'managecurrency',ga=>'Currency List'],
                            7=>[state=> 'family', name=> 'Family',
                                sub_root=> 'managefamily',ga=>'Family List'],
                            8=>[state=> 'class', name=> 'Class',
                                sub_root=> 'manageclass',ga=>'Class List'],
                            9=>[state=> 'service', name=> 'Service',
                                sub_root=> 'manageservice',ga=>'Service List'],
                            10=>[state=> 'authentication', name=> 'Authentication',
                                sub_root=> '',ga=>'Authentication List'],
                            11=>[state=> 'eventcategory', name=> 'Event Category',
                                sub_root=> 'manageeventcategory',ga=>'Category List'],
                            //{state=> 'meeting_purpose', name=> 'Meeting Purpose',sub_root=> ''},
                            12=>[state=> 'classification', name=> 'Classification',
                                sub_root=> 'Manageclassification',ga=>'Classification List'],
                            13=>[state=> 'newcountry', name=> 'Country',
                                sub_root=> 'managecountry',ga=>'Country List'],
                            14=>[state=> 'state', name=> 'State',
                                sub_root=> 'managestate',ga=>'State List'],
                            15=>[state=> 'city', name=> 'City',
                                sub_root=> 'managecity',ga=>'City List'],
                            16=>[state=> 'products', name=> 'Products',
                                sub_root=> 'manageproducts',ga=>'Products List'],
                            17=>[state=> 'specification', name=> 'Specifications',
                                sub_root=> 'managespecification',ga=>'Specification List'],
                            18=>[state=>'module',name=>'Module',
                                sub_root=>'managemodule',ga=>'Module List'],
                            19=>[state=>'submodule',name=>'Sub Module',
                                sub_root=>'managesubmodule',ga=>'Submodule List'],
                            20=>[state=> 'co_category', name=> 'Co Category',
                                sub_root=> 'createcocategory',ga=>'Cocategory List'],
                            21=>[state=> 'meetingpurpose', name=> 'Meeting',
                                sub_root=> 'managempurpose',ga=>'Meeting Purpose List'],
                            22=>[state=> 'area', name=> 'Area',
                                sub_root=> 'area',ga=>'Area List'],
                            23 =>[state => 'nlcm', name => 'National Lookout Category',
                                sub_root => 'manage', ga => 'National Lookout category'],
                            24 => [state=> 'nlcmsubcategory', name=> 'NLSCM',
                                sub_root=> 'nlcmsubcatmanage',ga=>'NLSCM'
                            ],
                            25 => [state=> 'omantbr', name=> 'Oman Tender Board Registration',
                                sub_root=> 'omantbrmanage',ga=>'OMANTBR'
                            ],
                            26 => [state => 'omantbgm', name => 'Oman Tender Board Grade Master',
                                sub_root => 'omantbgmmanage', ga => 'OMANTBGM'],
                            27 => [state => 'domainmaster', name => 'Domain master',
                                sub_root => 'managedomainmaster', ga=>'ManageDomain'],
                            28=> [state => 'subscriptionPackageMaster', name => 'Subscription Package master', sub_root => 'manage', ga => 'Manage Package Master'],
                            29 => [state => 'adminmodule', name => 'Admin Module master', sub_root => 'manage', ga => 'Manage Admin Module Master'],
                            30=> [state => 'adminsubmodule', name => 'Admin Sub Module master', sub_root => 'manage', ga => 'Manage Admin Sub Module Master'],
                            31=> [state => 'usermaster', name => 'User Master', sub_root => 'manageusermaster', ga => 'Manage user master'],
                            32=> [state => 'offermaster', name => 'Offer Master', sub_root => 'manageoffermst', ga => 'Manage offer master'],
                            33=> [state => 'offerrulemaster', name => 'Offer Rule Master', sub_root => 'manageofferrulemst', ga => 'Manage offer Rule master'],


                        ]
                ],
                3=>[
                    state=> 'contentmanagement', name=> 'Content Management', type=> 'sub', icon=> 'bgi-tender',
                    children=> [
                        0=>[state=> 'webcast', name=> 'Webcast',sub_root=>''],
                        1=>[state=> 'news', name=> 'News',sub_root=>''],
                        2=>[state=> 'events', name=> 'Events', sub_root=>'manageevent'],
                        3=>[state=> 'bgi_events', name=> 'Bgi Events',sub_root=>''],
                        4=>[state=> 'news_events', name=> 'News and Events',sub_root=>''],
                        5=>[state=> 'webinar', name=> 'Webinar',sub_root=>''],
                        6=>[state=> 'faq', name=> 'FAQ',sub_root=>''],

                    ]
                ],
                4=>[
                    state=> 'etender', name=> 'E Tender', type=> 'sub', icon=> 'bgi-collbrate',
                    children=> [
                        0=>[state=> 'etender', name=> 'E -Tender',sub_root=>''],
                    ]
                ],
                5=>[
                    state=> 'languagebgi', name=> 'Language', type=> 'sub', icon=> 'bgi-jsrs_connect',
                    children=> [
                        0=> [state => 'language', name => 'Language Master', sub_root => 'managelanguage', ga => 'Manage language'],
                        1=> [state => 'keywordmaster', name => 'Keyword master', sub_root => 'managekeyword', ga => 'Manage Keyword '],
                        2=> [state => 'translator', name => 'Translator', sub_root => 'translate', ga => 'Translate'],
                    ]
                ],
                6=>[state=>'contact',name=>'Contact',type=>'sub', icon=>'bgi-contact-book']     
            );
            return json_encode($rest);die;
        }
    }
    public function actionIndex(){
        $provider = new ActiveDataProvider([
            'query' =>  \api\modules\mst\models\EventTable::find()
                ->select(["event_table.*",
                    "if(event_table.event_Status = 'A', 'primary','warn') as `color`",
                    "countrymst_tbl.CyM_CountryName_en","citymst_tbl.CM_CityName_en",
                    "countrymst_tbl.CountryMst_Pk","citymst_tbl.CityMst_Pk",
                    "Statemst_tbl.StateMst_Pk","Statemst_tbl.SM_StateName_en",
                    "Statemst_tbl.StateMst_Pk","Statemst_tbl.SM_StateName_en",
                ])
                ->leftJoin('countrymst_tbl','event_table.event_country=countrymst_tbl.CountryMst_Pk')
                ->leftJoin('citymst_tbl','event_table.event_city=citymst_tbl.CityMst_Pk')
                ->leftJoin('Statemst_tbl','event_table.event_state=Statemst_tbl.StateMst_Pk')
                ->asArray(),
            'pagination' => [
                'pageSize' => (isset($_GET['size']))?$_GET['size']:10,
            ],
        ]);

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionRemove()
    {
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        print_r($data);die;
    }
    public function actionUploadfiles()
    {
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/bgiv3/uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $filename=time().".".$ext;
        if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
            $result=array('name'=>$_FILES["file"]["name"]);
        } else {
            $uploadOk = 1;
            echo "Sorry, there was an error uploading your file.";
        }
        return json_encode($result);
    }
    public function actionNewevent(){

        $model = new EventTable();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['eventmaster'])
        {
            $imp=(!empty($data['eventmaster']['event_upload']))?implode(",",$data['eventmaster']['event_upload']):'';
            foreach ($data['eventmaster'] as $key=>$value) {
                if($key=="status")
                {
                    $status=($data['eventmaster']['status'] ==true)?"A":"I";
                    $params['event_'.$key.'']=$status;
                }
                else {
                    $params['event_'.$key.'']=$value;
                    if($key=='event_upload')
                    {
                        $params['event_upload_path']=$imp;
                    }
                }
            }
            $model->load($params, '');
            $model->event_upload_path=$imp;
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'Event created successfully',
                    'returndata' => $model->event_id);
            } else {
                // Validation error
                throw new HttpException(422, json_encode($model->errors));
            }
        }
        else if($data['imagename'])
        {
            $file=$data['imagename'];
            $filepath=$_SERVER['DOCUMENT_ROOT']."/bgiv3/uploads/".$file;
            if(is_numeric($_GET['removeid']))
            {
                $evntmodel=EventTable::find()->where([
                    'event_id'    =>  $_GET['removeid']
                ])->one();
                if($evntmodel->event_upload_path)
                {
                    $removeitem=array($data['imagename']);
                    $expstr=explode(",",$evntmodel->event_upload_path);
                    $val=array_diff($expstr,$removeitem);
                    $imp=implode(",",$val);
                    $evntmodel->event_upload_path=$imp;
                    $evntmodel->update('event_upload_path');
                }
            }
            if (!unlink($filepath))
            {

                $result=array(
                    'status' => 201,
                    'statusmsg' => 'warning',
                    'msg'=>'deleted not succefully',
                );
            }
            else
            {

                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'deleted succefully',
                );
            }
        }
        return json_encode($result);
    }

    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['eventmaster'])
        {
            $imp=(!empty($data['eventmaster']['event_upload']))?implode(",",$data['eventmaster']['event_upload']):'';
            $model = EventTable::find()->where([
                'event_id'    =>  $id
            ])->one();
            foreach ($data as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['status'] ==true)?"A":"I";
                    $params['event_'.$key.'']=$status;
                }
                else {
                    $params['event_'.$key.'']=$value;
                }
            }
            $model->event_upload_path=$imp;
        }
        else if($data['updatestatus'])
        {
            $model = EventTable::find()->where([
                'event_id'    =>  $data['updatestatus']
            ])->one();
            $status=($model->event_status=="A")?"I":"A";
            //print_r($status);die;
            $params['event_status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Event updated successfully',
                'returndata' => $model->event_id
            );
        } else {
            $result=array('status' => 200, 'statusmsg' => 'danger',
                'msg'=>$model->getErrors(),
                'returndata' => $model->event_id);
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->event_Status=="A")?"I":"A";
        $model->SM_Status=$status;
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
        $module = EventTable::find()->where([
            'event_id'    =>  $id
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


    public function actionModulelist()
    {
        return new ActiveDataProvider([
            'query' => EventTable::find()->active()
        ]);

    }
    public function actionGoogle()
    {
        define('ga_profile_id', '176257386');
        //$ga = new app\commonfunction\api\gapi("jsrsv3@bgiv3-1529304901892.iam.gserviceaccount.com", "Bgiv3-5100b900479c.p12");
        $ga = new gapi("jsrsv3@bgiv3-1529304901892.iam.gserviceaccount.com", "Bgiv3-5100b900479c.p12");
        $ga->requestReportData(ga_profile_id, array('eventCategory', 'eventAction'), array('totalEvents', 'uniqueEvents'));

    }

}
