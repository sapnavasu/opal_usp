<?php

namespace api\modules\mst\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\rbac\Permission;


use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\EventTable;
use common\models\MenumstTbl;
use common\models\BasemodulemstTbl;
use common\components\Drive;
use api\common\services\CacheBGI;
use \common\models\UsermstTbl;

class MenuController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\EventTable';

    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config);

    }

    /**
     * @return array
     */
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
                'Origin' => ['*', 'http://localhost:4200'],
                //'Access-Control-Allow-Origin'=>['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true
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

    public function actionView($id)
    {

        $module = EventTable::find()->where([
            'event_id' => $id
        ])->one();
        if ($module) {
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }

    public function actionGetmenulist()
    {

        if(isset($_REQUEST['from']) && $_REQUEST['from']=='J2'){
            $regType = $_REQUEST['regType'];
            
            $compPk = $_REQUEST['comPk'];
            $origin = $_REQUEST['origin'];
            $usertyp = $_REQUEST['usertype'];
            // return $regType;
            $JSRS_v2_baseURL = Yii::$app->params['JSRS_v2_baseURL'];
        }else{
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);
            $resParam = $params->postParams;
            if($resParam->stkPk >= 1){
                $regType = $resParam->stkPk;
            }else{
                $regType = \yii\db\ActiveRecord::getTokenData('reg_type',true);
            }
            $usertyp = \yii\db\ActiveRecord::getTokenData('UM_Type',true);
            $origin = \yii\db\ActiveRecord::getTokenData('MCM_Origin',true);
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $JSRS_v2_baseURL = \yii\db\ActiveRecord::getTokenData('j2UserEncryptLink',true);
        }
        return self::getmenulist($regType,$usertyp,$compPk,$JSRS_v2_baseURL,$origin);
    }

    function getmenulist($regType,$usertyp,$compPk,$JSRS_v2_baseURL,$origin){
        //echo $app->params[$paramName];exit;
        if(isset($regType) && $regType > 0){
            $paramName = "menu_stk$regType";
        }else{
            $paramName = "menu_stk1";
        }
        //echo $paramName;exit;
        if($regType != 16){
            $menuArr = Yii::$app->params[$paramName];
            $menuJson = self::menutree($menuArr,$regType,$usertyp,$compPk,$JSRS_v2_baseURL,1,$origin);
            if (!empty($menuJson)) {
                return json_encode($menuJson,JSON_UNESCAPED_SLASHES);
            }
        }else{

            try{
                $cache = new CacheBGI();
                $cacheKey = $paramName;
                
                if(empty($cache->retreive($cacheKey))){
                    $cacheQuery = MenumstTbl::getStkMenuCacheQuery();
                    $menuArr = MenumstTbl::getStkMenu($regType);
                    $cache->store($cacheKey, $menuArr, $duration = 0 , $cacheQuery);
                } else {
                    $menuArr = $cache->retreive($cacheKey);
                }

            } catch(\Exception $e){
                $menuArr = MenumstTbl::getStkMenu($regType);
            }
        
            $menuJson = self::menutree($menuArr,$regType,$usertyp,$compPk,$JSRS_v2_baseURL,1,$origin);
            if (!empty($menuJson)) {
                return json_encode($menuJson,JSON_UNESCAPED_SLASHES);
            }
        }
        exit;
    }

    public function actionGetmenulistnew()
    {
        $menuJson = file_get_contents('menus/menu.json');
        
        echo '<pre>';
        print_r($menuJson);
        exit;
    }

    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => \api\modules\mst\models\EventTable::find()
                ->select(["event_table.*",
                    "if(event_table.event_Status = 'A', 'primary','warn') as `color`",
                    "countrymst_tbl.CyM_CountryName_en", "citymst_tbl.CM_CityName_en",
                    "countrymst_tbl.CountryMst_Pk", "citymst_tbl.CityMst_Pk",
                    "Statemst_tbl.StateMst_Pk", "Statemst_tbl.SM_StateName_en",
                    "Statemst_tbl.StateMst_Pk", "Statemst_tbl.SM_StateName_en",
                ])
                ->leftJoin('countrymst_tbl', 'event_table.event_country=countrymst_tbl.CountryMst_Pk')
                ->leftJoin('citymst_tbl', 'event_table.event_city=citymst_tbl.CityMst_Pk')
                ->leftJoin('Statemst_tbl', 'event_table.event_state=Statemst_tbl.StateMst_Pk')
                ->asArray(),
            'pagination' => [
                'pageSize' => (isset($_GET['size'])) ? $_GET['size'] : 10,
            ],
        ]);

        return $this->asJson([
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => 10,
        ]);
    }

    public function actionRemove()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        print_r($data);
        die;
    }

    public function actionUploadfiles()
    {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/bgiv3/uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $filename = time() . "." . $ext;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $result = array('name' => $_FILES["file"]["name"]);
        } else {
            $uploadOk = 1;
            echo "Sorry, there was an error uploading your file.";
        }
        return $this->asJson($result);
    }

    public function actionNewevent()
    {

        $model = new EventTable();
        $params = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if ($data['eventmaster']) {
            $imp = (!empty($data['eventmaster']['event_upload'])) ? implode(",", $data['eventmaster']['event_upload']) : '';
            foreach ($data['eventmaster'] as $key => $value) {
                if ($key == "status") {
                    $status = ($data['eventmaster']['status'] == true) ? "A" : "I";
                    $params['event_' . $key . ''] = $status;
                } else {
                    $params['event_' . $key . ''] = $value;
                    if ($key == 'event_upload') {
                        $params['event_upload_path'] = $imp;
                    }
                }
            }
            $model->load($params, '');
            $model->event_upload_path = $imp;
            if ($model->validate() && $model->save()) {
                $result = array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg' => 'Event created successfully',
                    'returndata' => $model->event_id);
            } else {
                // Validation error
                throw new HttpException(422, json_encode($model->errors));
            }
        } else if ($data['imagename']) {
            $file = $data['imagename'];
            $filepath = $_SERVER['DOCUMENT_ROOT'] . "/bgiv3/uploads/" . $file;
            if (is_numeric($_GET['removeid'])) {
                $evntmodel = EventTable::find()->where([
                    'event_id' => $_GET['removeid']
                ])->one();
                if ($evntmodel->event_upload_path) {
                    $removeitem = array($data['imagename']);
                    $expstr = explode(",", $evntmodel->event_upload_path);
                    $val = array_diff($expstr, $removeitem);
                    $imp = implode(",", $val);
                    $evntmodel->event_upload_path = $imp;
                    $evntmodel->update('event_upload_path');
                }
            }
            if (!unlink($filepath)) {

                $result = array(
                    'status' => 201,
                    'statusmsg' => 'warning',
                    'msg' => 'deleted not succefully',
                );
            } else {

                $result = array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg' => 'deleted succefully',
                );
            }
        }
        return $this->asJson($result);
    }

    public function actionUpdate($id)
    {

        $params = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if ($data['eventmaster']) {
            $imp = (!empty($data['eventmaster']['event_upload'])) ? implode(",", $data['eventmaster']['event_upload']) : '';
            $model = EventTable::find()->where([
                'event_id' => $id
            ])->one();
            foreach ($data as $key => $value) {
                if ($key == "Status") {
                    $status = ($data['status'] == true) ? "A" : "I";
                    $params['event_' . $key . ''] = $status;
                } else {
                    $params['event_' . $key . ''] = $value;
                }
            }
            $model->event_upload_path = $imp;
        } else if ($data['updatestatus']) {
            $model = EventTable::find()->where([
                'event_id' => $data['updatestatus']
            ])->one();
            $status = ($model->event_status == "A") ? "I" : "A";
            //print_r($status);die;
            $params['event_status'] = $status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg' => 'Event updated successfully',
                'returndata' => $model->event_id
            );
        } else {
            $result = array('status' => 200, 'statusmsg' => 'danger',
                'msg' => $model->getErrors(),
                'returndata' => $model->event_id);
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $this->asJson($result);
    }

    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status = ($model->event_Status == "A") ? "I" : "A";
        $model->SM_Status = $status;
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $this->asJson($model);
    }

    public function actionDelete($id)
    {
        $module = EventTable::find()->where([
            'event_id' => $id
        ])->one();

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        } else {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }

    public function actionLogin()
    {
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
                'id' => $id,
                'access_token' => $user->access_token,
            ];

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }


    public function actionGetPermissions()
    {
        $authManager = Yii::$app->authManager;

        /** @var Permission[] $permissions */
        $permissions = $authManager->getPermissions();

        /** @var array $tmpPermissions to store list of available permissions */
        $tmpPermissions = [];

        /**
         * @var string $permissionKey
         * @var Permission $permission
         */
        foreach ($permissions as $permissionKey => $permission) {
            $tmpPermissions[] = [
                'name' => $permission->name,
                'description' => $permission->description,
                'checked' => false,
            ];
        }

        return $tmpPermissions;
    }

    public function actionOptions($id = null)
    {
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

    public function actionGenerateworkspacemenu()
    {

    }

     function menutree(array $menuArr,$regType,$usertyp,$compPk,$JSRS_v2_baseURL,$level=1,$origin,$mainMenu = 0) {
      
     
        $menu = array();
        
        $tempLevel = $level;
//        $usertyp = \yii\db\ActiveRecord::getTokenData('UM_Type', true);
        // $regType = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        // $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        // $JSRS_v2_baseURL = \yii\db\ActiveRecord::getTokenData('j2UserEncryptLink',true);
        // echo '<pre>';print_r($JSRS_v2_baseURL);exit;
        // $JSRS_v2_baseURL = Yii::$app->params['JSRS_v2_baseURL'];

        foreach ($menuArr as $menuVal) {
            if(isset($menuVal['external_link']) && $menuVal['external_link']==TRUE && $regType==7  && $menuVal['menu_url']=='PREQUAL'){
                // $omanlngPk = \common\components\Configuration::getfilekeyvalue('module/PreQual/config','omanlng_Comppk');
                $omanlngPk = [1,2]['omanlng']['compPk'];
                if($compPk != $omanlngPk){
                    continue;
                } 
            }
            if(in_array($menuVal['menu_pk'], [Yii::$app->params['additionalCertificationMenuPk']]) && $origin!='N'){
                continue;
            }
            if ($menuVal['menu_to'] == $mainMenu) {
                    $submenu = self::menutree($menuArr,$regType,$usertyp,$compPk,$JSRS_v2_baseURL,($level+1), $origin, $menuVal['menu_pk']);
                    if ($submenu) {
                        $menuVal['submenu'] = $submenu;
                    }

                    $isAccessAvailable = BasemodulemstTbl::checkUserModuleAccess($menuVal['submodule_id']);

                    $prevLevel = $tempLevel - 1;
                    if(isset($menuVal[$prevLevel])){
                        $menuVal[$prevLevel]['menu_url'] = '';
                    }else{
                        
                        if($isAccessAvailable['useracess'] == 'yes' ||1 ){
                            $menuVal['useracess'] = 'yes';
                            $menuVal['currentUrl'] = $menuVal['menu_url'];
                            
                            if(!empty($menuVal['menu_url']) && (!isset($menuVal['external_link']) || $menuVal['external_link']== FALSE)){
                                if($regType==6  && $menuVal['menu_url']=='enterpriseadmin/viewskycarddetail' && $usertyp=='A'){
                                    
                                        $menuVal['menu_url']='enterpriseadmin/skycardlandingpage';
                                }
                                $menuExplode = explode('/', $menuVal['menu_url']);
                                $menuVal['menu_url'] = array_merge(['/'],$menuExplode);
                            }elseif(isset($menuVal['external_link']) || $menuVal['external_link']== TRUE){
                                if($menuVal['menu_url']=='PREQUAL'){
                                    // $params= \common\components\Configuration::getEncryptedUserKey('**j2**');
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=PREQUAL';
                                }elseif($menuVal['menu_url']=='JSRSCONNECT'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=JSRSCONNECT';  
                                    }elseif($menuVal['menu_url']=='emailshortlist'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=emailshortlist';
                                }elseif($menuVal['menu_url']=='JSRSEVENTADMIN'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=JSRSEVENTADMIN'; 

                                }elseif($menuVal['menu_url']=='MEETINGREQUESTADMIN'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=MEETINGREQUESTADMIN';
                                }elseif($menuVal['menu_url']=='gcctenderpymt'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=gcctenderpymt';
                                }elseif($menuVal['menu_url']=='SEZD'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=SEZD';
                                }elseif($menuVal['menu_url']=='GLOBECONNECT'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=GLOBECONNECT';
                                }elseif($menuVal['menu_url']=='NEWSANDEVENTS'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=NEWSANDEVENTS';
                                }elseif($menuVal['menu_url']=='sezdmodule'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=sezdmodule';
                                    }elseif($menuVal['menu_url']=='newsfeed'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=newsfeed';
                                }elseif($menuVal['menu_url']=='newsfeedgc'){
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=newsfeedgc';
                                }
                                elseif($menuVal['menu_url']=='newsandevents'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=newsandevents'; 

                                }
                                elseif($menuVal['menu_url']=='gcctenderreport'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=gcctenderreport'; 

                                }
                                 elseif($menuVal['menu_url']=='CMSREPORT'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=CMSREPORT'; 

                                }
                                elseif($menuVal['menu_url']=='nbfsupplierstatistics'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=nbfsupplierstatistics'; 

                                }
                                
                                elseif($menuVal['menu_url']=='blgcmt'){

                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=blogcmt'; 

                                }
                                elseif($menuVal['menu_url']=='Strtdisc'){

                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=Strtdisc'; 

                                }
                                 elseif($menuVal['menu_url']=='globeconnectpartners'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=globeconnectpartners'; 

                                }
        
                                  elseif($menuVal['menu_url']=='connectedcompanies'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=connectedcompanies'; 

                                }
                                elseif($menuVal['menu_url']=='speakatstage'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=speakatstage'; 

                                }
                                 elseif($menuVal['menu_url']=='jsrsevent'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=jsrsevent'; 

                                }
                                elseif($menuVal['menu_url']=='contactj2'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=contactj2'; 

                                }elseif($menuVal['menu_url']=='globeapproval'){
                                    
                                    $menuVal['menu_url'] = $JSRS_v2_baseURL.'&afterlogin=globeapproval';

                                }
                            }
                        }else{
                            $menuVal['useracess'] = 'no';
                            $menuVal['menu_url'] = '';
                        }

                        if($tempLevel > 1){
                            $menuVal['menu_icon'] = '';
                        }
                    }
                    $menuIcon = Drive::generateUrl($menuVal['menuIcon'],1,1,1);
                    $menu[] = array_merge($menuVal,['class'=>'menulevel-'.$tempLevel,'menuIcon'=>$menuIcon,'regType'=>$regType]);
                }
            }
        usort($menu, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        return $menu;
    }

    public function actionUserAccessCheck(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->accessmodule) && !empty($resParam->accessmodule)){
            $userType = \yii\db\ActiveRecord::getTokenData('UM_Type',true);

            if($userType == 'U'){
                $moduleIds = $resParam->accessmodule;
                $isAccessAvailable = BasemodulemstTbl::checkUserClientModuleAccess($moduleIds);
                if($isAccessAvailable['useracess'] == 'no'){
                    $message = 'You don\'t have permission to access this!';
                    $status = 102;
                }else{
                    $message = 'Success';
                    $status = 100;
                }
            }else{
                $message = 'Success';
                $status = 100;
            }
        }else{
            $message = 'module id is missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionGetj3links(){
        $regType = $_REQUEST['regType'];

        if($regType == 6){ // Supplier
            $links = [
                'HMenu'=>[
                        'masterCompanyProfile'=>'profilemanagement/companyinformation',
                        'myProfile'=>'profilecreation/profilecreationlist',
                        'accountSettings'=>'accountsettings',
                        'help'=>'#',
                        'logout'=>'admin/login',


                ],
            ];
        }elseif($regType == 7){ //Buyers
            $links = [
                'HMenu'=>[
                        'masterCompanyProfile'=>'profilemanagement/companyinformation',
                        'myProfile'=>'profilecreation/profilecreationlist',
                        'accountSettings'=>'accountsettings',
                        'help'=>'#',
                        'logout'=>'admin/login',


                ],
            ];
        }
        return json_encode($links);
    } 
}
