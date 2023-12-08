<?php
namespace api\modules\bs\controllers;

use api\modules\bs\components\B2bsearch;
use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\pm\controllers\NbfMasterController;
use \api\modules\bs\components\Bizsearch;
use \api\modules\bs\components\Bizsearchdetails;
use \api\modules\bs\components\Userfilter;
use \api\modules\bs\components\Monitorlogfilter;
use \api\modules\bs\components\Productfilter;
use \api\modules\bs\components\Servicefilter;
use \api\modules\bs\components\Businessunitfilter;
use \api\modules\bs\components\Marketpresencefilter;
use \api\modules\bs\components\Companyprofilefilter;
use \api\modules\bs\components\Domainsearch;
use \api\modules\bs\components\Smartfilter;
use \common\models\MembercompanymstTbl;
use \common\models\MemcompprdserfollowdtlsTbl;
use \common\models\MemprodservrecmhdrTbl;
use yii\web\Response;
use \common\models\SectormstTbl;
use \common\components\Security;
use common\components\Drive;
use \common\components\Common;
use \yii\data\ActiveDataProvider;
use \api\modules\skyc\models\MemcompskycardhdrTbl;
use \api\modules\skyc\models\MemcompskycarddtlsTbl;
use \api\modules\skyc\models\MemcompskycardmapTbl;


class BizsearchController extends MasterController{

    public $modelClass = '\common\models\MembercompanymstTbl.php';
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
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
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
     * @SWG\Post(
     *     path="/bs/bizsearch/bsearchlist",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get the search list for bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="search", type="object",
     *                  @SWG\Property(property="searchby", type="integer", description="1 - Company, 2 - Products, 3 - Services, 4 - Supplier Certification"),
     *                  @SWG\Property(property="keyword", type="array",
     *                      @SWG\Items(type="string")
     *                  )
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBsearchlist(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $search_list = Bizsearch::getBsearchList($data['search']);
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'items' => !empty($search_list)?$search_list:[]
        ]); 
    } 

    /**
     * @SWG\Get(
     *     path="/bs/bizsearch/companydetail",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to company details data for the right panel in bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(name="id", in="header",type="string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCompanydetail(){
        $id = Security::sanitizeInput(Security::decrypt($_GET['id']), "string");
        $detail = [];
        if(!empty($id)){
            $detail = \common\models\MembercompanymstTbl::getCompanyDetailsBizsearch($id);
        }
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'items' => !empty($detail)?$detail:[]
        ]); 
    }
    
    /**
     * @SWG\Get(
     *     path="/bs/bizsearch/follow",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to follow or unfollow the company in bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(name="id", in="header",type="string", description="Primary key of the company"),
     *     @SWG\Parameter(name="followtype", in="header",type="string", description="Primary key of the company"),
     *     @SWG\Parameter(name="type", in="header",type="string", description="Primary key of the company"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionFollow(){
        $id = Security::sanitizeInput($_GET['id'], "string", true);
        $followType = Security::sanitizeInput($_GET['followtype'], "string", true);
        $type = Security::sanitizeInput($_GET['type'], "string", true);
        $companyPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        if(!empty($id)){
            $detail = \common\models\MemcompprdserfollowdtlsTbl::insertByType($followType,$id,$type,$companyPk,$userPk);
        }
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'data' => $detail
        ]); 
    }
    
    /**
     * @SWG\Get(
     *     path="/bs/bizsearch/productdetail",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to product details data for the right panel in bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(name="productpk", in="header",type="string"),
     *     @SWG\Parameter(name="companypk", in="header",type="string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionProductdetail(){
        $productpk = Security::sanitizeInput($_GET['productpk'], "string", true);
        $companypk = Security::sanitizeInput($_GET['companypk'], "string", true);
        $detail = [];
        if(!empty($productpk) && !empty($companypk)){
            $detail['detail'] = \common\models\MemcompproddtlsTbl::getBsearchProductDetail($productpk,$companypk);
            $detail['company_profile'] = MembercompanymstTbl::getCompanyDetailsBizsearch($companypk,true);
        }
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'items' => !empty($detail)?$detail:[]
        ]); 
    }
    
    /**
     * @SWG\Get(
     *     path="/bs/bizsearch/servicedetail",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to service details data for the right panel in bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(name="id", in="header",type="string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionServicedetail(){
        $servicepk = Security::sanitizeInput(Security::decrypt($_GET['servicepk']), "string");
        $companypk = Security::sanitizeInput(Security::decrypt($_GET['companypk']), "string");
        $detail = [];
        if(!empty($servicepk) && !empty($companypk)){
            $detail['detail'] = \common\models\MemcompservicedtlsTbl::getBsearchServiceDetail($servicepk,$companypk);
            $detail['company_profile'] = MembercompanymstTbl::getCompanyDetailsBizsearch($companypk, true);
        }
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'items' => !empty($detail)?$detail:[]
        ]); 
    }
    
    
    /**
     * @SWG\Post(
     *     path="/bs/bizsearch/filterdata",
     *     tags={"Bizsearch"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to service details data for the right panel in bizsearch.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(name="companypks", in="header",type="string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionFilterdata(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $advancefilterdata = Bizsearch::getAdvancedFilterData($data);
        return $this->asJson($advancefilterdata);
    }
    public function actionSaveresult(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $filterData = json_decode($request_body);

        $response = Bizsearch::saveResult($data, $filterData);
        return $this->asJson($response);
    }
    public function actionUpdatename(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $updateName = Bizsearch::updateSavedName($data);
        return $this->asJson($updateName);
    }
    public function actionDeleteresult(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $deletresult = Bizsearch::deleteSavedResult($data);
        return $this->asJson($deletresult);
    }
    public function actionGetsavedresult(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['fetchData'];
        
        $response = Bizsearch::getSavedResult($data);
        return $this->asJson($response);
    }

    /*
        Path : api/bs/bizsearch/get-search-criteria
        Description : Getting criteria details
        Params :    {
                        postParams:{
                            criteriaType
                            isDemo
                        }
                    }
    */
    public function actionGetSearchCriteria(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
          $resParam = $params->postParams;
          $data = [];
          $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
          $userModel = \common\models\UsermstTbl::findOne($userPk);
       // echo '<pre>';
       // print_r($_REQUEST['criteriaType']);
       // echo '</pre>'; exit;
         if(isset($resParam->criteriaType) && !empty($resParam->criteriaType) || isset($_REQUEST['criteriaType']) && !empty($_REQUEST['criteriaType'])){
            
           
            if(($_REQUEST['apiFor'] == "and"||$_REQUEST['apiFor'] == "ios") && isset($_REQUEST['criteriaType']) && !empty($_REQUEST['criteriaType'])){
            $criteriaType = Security::decrypt($_REQUEST['criteriaType']);
            $criteriaType = Security::sanitizeInput($criteriaType,'number');
            }else {
            $criteriaType = Security::decrypt($resParam->criteriaType);
            $criteriaType = Security::sanitizeInput($criteriaType,'number');
            }
            
            if($criteriaType > 0){
                $isDemo = $resParam->isDemo;
                $data['criteraData'] = Bizsearch::getSearchCriteria($criteriaType, $isDemo);

                $touripaddress = explode(',', $userModel->um_touripaddress);

                if(empty($userModel->um_touripaddress) || !(in_array(Common::getIpAddress(), $touripaddress))){
                    $data['showTour'] = false;
                }else{
                    $data['showTour'] = true;
                }
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    
    /*
        Path : api/bs/bizsearch/get-bsearch-result
        Description : Fetch search result
        Params :    {
                        postParams:{
                            searchType, // 1 - Internal, 2 - Domain, 3 - B2B, 4 - Universal
                            criteriaType, 
                            // 1 - All, 2 - Users, 3 - Business Units, 4 - Monitor Logs, 5 - Products, 6 - Services, 7 - Market Presence
                            searchKey,
                            searchFrom, // 1 - Home page, 2 - Search Page
                            triggerFrom, // 1 - ALL, 2 - Others
                            searchPage,
                            filterSrh
                        }
                    }
    */
    public function actionChangeTourStatus() {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $statusChanged = false;
        if(isset($resParam->tourShown) && !empty($resParam->tourShown)){
            $statusChanged = \common\models\UsermstTbl::bizSearchTakeTourViewed();
        }
        
        return $this->asJson([
            'data' => [],
            'msg' => ($statusChanged) ? 'success' : 'failure',
            'status' => ($statusChanged) ? 1 : 0,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-bsearch-result
        Description : Fetch search result
        Params :    {
                        postParams:{
                            searchType, // 1 - Internal, 2 - Domain, 3 - B2B, 4 - Universal
                            criteriaType, 
                            // 1 - All, 2 - Users, 3 - Business Units, 4 - Monitor Logs, 5 - Products, 6 - Services, 7 - Market Presence
                            searchKey,
                            searchFrom, // 1 - Home page, 2 - Search Page
                            triggerFrom, // 1 - ALL, 2 - Others
                            searchPage,
                            filterSrh
                        }
                    }
    */
    public function actionUpdatetaketour(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        //echo'<pre>';print_r($userPk);exit;
        $userData = \common\models\UsermstTbl::find()
                        ->where(['UserMst_Pk'=>$userPk])
                        ->one();

        $touripaddress = explode(',', $userData->um_touripaddress);

        if(in_array(Common::getIpAddress(), $touripaddress)){
            $userData->um_touripaddress = $userData->um_touripaddress;            
        } else {
            if(empty($userData->um_touripaddress)){
                $userData->um_touripaddress = Common::getIpAddress();
            }else{
                $userData->um_touripaddress .= ','.Common::getIpAddress();    
            }
        }

        if($userData->save()){
             $message = 'Success';
                $status = 100;
             return $this->asJson([
            'msg' => $message,
            'status' => $status,
        ]);
        }else{
             $message = 'Error';
                $status = 101;
             return $this->asJson([
            'msg' => $message,
            'status' => $status,
        ]);
        }
    }
     public function actionGetBsearchResult() {
      //print_r($_REQUEST);die();
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $data = [];


        if((isset($resParam->criteriaType) && !empty($resParam->criteriaType)) || (isset($_REQUEST['criteriaType']) && !empty($_REQUEST['criteriaType']))  ){
            //API Web Service

          if($_REQUEST['apiFor']=='and' || $_REQUEST['apiFor']=='ios'){
            $criteriaType = Security::decrypt($_REQUEST['criteriaType']);
            $criteriaType = Security::sanitizeInput($criteriaType,'number');

            $searchType = Security::decrypt($_REQUEST['searchType']);
            $searchType = Security::sanitizeInput($searchType,'number');

            $searchFrom = Security::decrypt($_REQUEST['searchFrom']);
            $searchFrom = Security::sanitizeInput($searchFrom,'number');

            $triggerFrom = Security::decrypt($_REQUEST['triggerFrom']);
            $triggerFrom = Security::sanitizeInput($triggerFrom,'number');

            $searchPage = Security::sanitizeInput($_REQUEST['searchPage'],'number');

           }else{
            $criteriaType = Security::decrypt($resParam->criteriaType);
            $criteriaType = Security::sanitizeInput($criteriaType,'number');

            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');

            $searchFrom = Security::decrypt($resParam->searchFrom);
            $searchFrom = Security::sanitizeInput($searchFrom,'number');

            $triggerFrom = Security::decrypt($resParam->triggerFrom);
            $triggerFrom = Security::sanitizeInput($triggerFrom,'number');

            $searchPage = Security::sanitizeInput($resParam->searchPage,'number');
           }
           

            if((isset($resParam->searchSort) && $resParam->searchSort == 'Desc')|| (isset($_REQUEST['searchSort']) && $_REQUEST['searchSort']== 'Desc')){
                $searchSort = 'Desc';
            }else{
                $searchSort = 'ASC';
            }
            
            if($_REQUEST['apiFor']=='and' || $_REQUEST['apiFor']=='ios'){
                $searchKey =$_REQUEST['searchKey'];
                $filterSrh =$_REQUEST['filterSrh'];
                $smartSrh = $_REQUEST['smartFilterSrh'];

            }
             else{
                $searchKey = $resParam->searchKey;
                $filterSrh = $resParam->filterSrh;
                $smartSrh = $resParam->smartFilterSrh;
           
            }
            $userData = \common\models\UsermstTbl::find()->where(['UserMst_Pk'=>$userPk])->one();
            $data['showtourdata'] = $userData;
            
            $touripaddress = explode(',', $userData->um_touripaddress);

            if(empty($userData->um_touripaddress) || !(in_array(Common::getIpAddress(), $touripaddress))){
                $data['showTour'] = 1;
            }else{
                $data['showTour'] = 2;
            }
            
            if($criteriaType > 0 && $searchType > 0 && $searchFrom > 0 && $triggerFrom > 0 && $searchPage >= 0) {
                
                $data['searchResult'] = Bizsearch::getBizSearchData($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh, $smartSrh);
                 
                if(isset($resParam->saveHsty) && !empty($resParam->saveHsty) && $resParam->saveHsty != 'no'){
                    Bizsearch::saveHistory($criteriaType, $searchType, $searchKey, $searchFrom, $searchSort, $filterSrh, $resParam->saveHsty);
                }
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            } else {
                $data['resStr'] = [$criteriaType, $searchType, $searchFrom, $triggerFrom,$searchPage];
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        } else {
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        //print_r($data);die();
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
	
	
	 public function actionGetBsearchResultTargetSuppliers() {
        // print_r("expression");die();
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        //echo "<pre>";
       // print_r( $resParam);
       // exit;
		
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $data = [];
        if(isset($resParam->criteriaType) && !empty($resParam->criteriaType)){
            $criteriaType = Security::decrypt($resParam->criteriaType);
            $criteriaType = Security::sanitizeInput($criteriaType,'number');

            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');

            $searchFrom = Security::decrypt($resParam->searchFrom);
            $searchFrom = Security::sanitizeInput($searchFrom,'number');

            $triggerFrom = Security::decrypt($resParam->triggerFrom);
            $triggerFrom = Security::sanitizeInput($triggerFrom,'number');

            $searchPage = Security::sanitizeInput($resParam->searchPage,'number');

            if(isset($resParam->searchSort) && $resParam->searchSort == 'Desc'){
                $searchSort = 'Desc';
            }else{
                $searchSort = 'ASC';
            }

                       
            $searchKey = $resParam->searchKey;
            $filterSrh = $resParam->filterSrh;
            $smartSrh = $resParam->smartFilterSrh;
			$favsrchmst_edit_pk = $resParam->favsrchmst_edit_pk;
            $userData = \common\models\UsermstTbl::find()->where(['UserMst_Pk'=>$userPk])->one();
            $data['showtourdata'] = $userData;
            
            $touripaddress = explode(',', $userData->um_touripaddress);

            if(empty($userData->um_touripaddress) || !(in_array(Common::getIpAddress(), $touripaddress))){
                $data['showTour'] = 1;
            }else{
                $data['showTour'] = 2;
            }
		
            if($criteriaType > 0 && $searchType > 0 && $searchFrom > 0 && $triggerFrom > 0 && $searchPage >= 0) {
				               
                //$data['searchResult'] = Bizsearch::getBizSearchData($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh, $smartSrh);
				
				$data['searchResult'] = Bizsearch::saveTargetResults($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh, $smartSrh, $favsrchmst_edit_pk);
								                
                if(isset($resParam->saveHsty) && !empty($resParam->saveHsty) && $resParam->saveHsty != 'no'){

                    Bizsearch::saveHistory($criteriaType, $searchType, $searchKey, $searchFrom, $searchSort, $filterSrh, $resParam->saveHsty);
                }
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            } else {
                $data['resStr'] = [$criteriaType, $searchType, $searchFrom, $triggerFrom,$searchPage];
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        } else {
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-user-details
        Description : Fetch user details
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionGetUserDetails() {
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data['userDetails'] = Bizsearchdetails::getUserDetails($userPk);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    /*
        Path : api/bs/bizsearch/get-people-details
        Description : Fetch user details
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionGetPeopleDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data['userDetails'] = B2bsearch::getPeopleDetails($userPk);
                $data['companyProfile'] = Bizsearchdetails::getCompanyDetails($data['userDetails']['companyPk']);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-business-unit-details
        Description : Fetch user details
        Params :    {
                        postParams:{
                            businessUnitId
                        }
                    }
    */
    public function actionGetBusinessUnitDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->businessUnitId)){
            $businessUnitId = Security::decrypt($resParam->businessUnitId);
            $businessUnitId = Security::sanitizeInput($businessUnitId,'number');
            if($businessUnitId > 0){
                $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                // $data['mappedUsers'] = Bizsearchdetails::getBunitMappedUsers($businessUnitId, $cmpPK);
                // $data['mappedProducts'] = Bizsearchdetails::getBunitMappedProducts($businessUnitId, $cmpPK);
                $data['companyProfile'] = Bizsearchdetails::getCompanyDetails($cmpPK);
                $data['businessUnitDetail'] = Bizsearchdetails::getBusinessDetails($businessUnitId);
                $data['businessSourceDetail'] = Bizsearchdetails::getBunitBsourceDetails($businessUnitId);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-market-presence-details
        Description : Fetch Market Presence details
        Params :    {
                        postParams:{
                            mpId
                        }
                    }
    */
    public function actionGetMarketPresenceDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->mpId)){
            $mpId = Security::decrypt($resParam->mpId);
            $mpId = Security::sanitizeInput($mpId,'number');
            if($mpId > 0){
                $data['businessUnitDetails'] = Bizsearchdetails::getMarketPresenceDetails($mpId);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-product-details
        Description : Fetch Product details
        Params :    {
                        postParams:{
                            productpk
                        }
                    }
    */
    public function actionGetProductDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->productpk)){
            $productpk = Security::decrypt($resParam->productpk);
            $comppk = Security::decrypt($resParam->comppk);
            $from = Security::decrypt($resParam->from);
            $productpk = Security::sanitizeInput($productpk,'number');
            if($productpk > 0){
                if(isset($comppk) && !empty($comppk) && !empty($from)){
                    $cmpPK= $comppk;
                }else{
                    $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                    $from = "T";
                }
                
                $skycard_prod=0;
                $produser_pk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $check_prodStatus = MemcompskycardhdrTbl::find()
                ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk')
                ->where([
                    'mcosc_name_usremst_fk' => $produser_pk
                    ])
                ->andwhere(['mcosd_shared_fk'=>$productpk])    
                ->asArray()->one();
                if(!empty($check_prodStatus))
                {
                   $skycard_prod=1;
                }

                
                $data['productDetail'] = Bizsearchdetails::getProductDetail($productpk,$cmpPK,$from);
                // $driveImg = Drive::generateUrl($data['productDetail']['imagePK'],1,1);
                // $data['productDetail']['coverImg'] = $driveImg;
                $data['companyProfile'] = Bizsearchdetails::getCompanyDetails($cmpPK);
                $data['skycard_prod']=$skycard_prod;
                

                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            } else {
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-service-details
        Description : Fetch Product details
        Params :    {
                        postParams:{
                            servicepk
                        }
                    }
    */
    public function actionGetServiceDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->servicepk)){
            $servicepk = Security::decrypt($resParam->servicepk);
            $servicepk = Security::sanitizeInput($servicepk,'number');
            $comppk = Security::decrypt($resParam->comppk);
            $from = Security::decrypt($resParam->from);
            if($servicepk > 0){
                if(isset($comppk) && !empty($comppk) && !empty($from)){
                    $cmpPK = $comppk;
                }else{
                    $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                    $from = "T";
                }
                $data['serviceDetail'] = Bizsearchdetails::getServiceDetail($servicepk,$cmpPK,$from);
                $data['companyProfile'] = Bizsearchdetails::getCompanyDetails($cmpPK);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-monitorlog-details
        Description : Fetch Product details
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionGetMonitorlogDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data['monitorLog'] = Bizsearchdetails::getMonitorLogDetail($userPk);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionCronFunction(){
        // {"Company":"29","Products":"1","Services":"1","Activities":"28","Country":"2"}
        $json_path = dirname(__DIR__).'/../../../lypis/src/assets/bizsearchhomecount.json';
        $countResult = \Yii::$app->db->createCommand("SELECT (SELECT COUNT(UserMst_Pk) as userCount FROM `usermst_tbl` WHERE (`UM_MemberRegMst_Fk`='1') AND (`UM_Status`='A') AND (`UM_Type`='U')) AS `userCount`, (SELECT COUNT(MemCompSecDtls_Pk) as businessUnitCount FROM `memcompsectordtls_tbl` WHERE `MCSD_MemberCompMst_Fk`='1') AS `businessUnitCount`, (SELECT COUNT(UserMst_Pk) as logCount FROM `usermst_tbl` INNER JOIN `usermonitorlog_tbl` ON uml_usermst_fk = UserMst_Pk WHERE (`UM_MemberRegMst_Fk` IS NULL) AND (`UM_Status`='A') AND (`UM_Type`='U')) AS `logCount`, (SELECT COUNT(MemCompProdDtls_Pk) as productCount FROM `memcompproddtls_tbl` WHERE `MCPrD_MemberCompMst_Fk`='1') AS `productCount`, (SELECT COUNT(MemCompServDtls_Pk) as serviceCount FROM `memcompservicedtls_tbl` WHERE `MCSvD_MemberCompMst_Fk`='1') AS `serviceCount`, (SELECT COUNT(memcompmplocationdtls_pk) as marketPresenceCount FROM `memcompmplocationdtls_tbl` WHERE (`mcmpld_membercompmst_fk`='1') AND (`mcmpld_locationtype` IN (1, 2, 3, 4, 6, 7, 8, 11, 12))) AS `marketPresenceCount` FROM `membercompanymst_tbl` WHERE `MemberCompMst_Pk`='1'")->queryOne();
        if($countResult!=''){
            $jsonFormat = json_encode($countResult);
            if(file_put_contents($json_path, $jsonFormat)){
                
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /*
        Path : api/bs/bizsearch/user-combination-data
        Description : Fetch User combination details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionUserCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            // print_r($searchType);print_r($filterType);die();
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Userfilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Userfilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/monitorlog-combination-data
        Description : Fetch Monitor Log Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionMonitorlogCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Monitorlogfilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Monitorlogfilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionFetchDivisionByBunit() {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        //print_r($resParam);die();
        if(isset($resParam->bUnitPk) && !empty($resParam->bUnitPk)){
            
            $bUnitPk = $resParam->bUnitPk;
            $from = (isset($resParam->from) && $resParam->from > 0)?$resParam->from:1;
            $data['bunitDivData'] = SectormstTbl::fetchBunitDivision($bUnitPk,$from);
            $message = 'success';
            $status = 100;
                
            /*}else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }*/
        }else{
            $message = 'missingFields';
            $status = 101;   
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/product-combination-data
        Description : Fetch Product Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionProductCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Productfilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Productfilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/service-combination-data
        Description : Fetch Service Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionServiceCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Servicefilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Servicefilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/businessunit-combination-data
        Description : Fetch Product Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionBusinessunitCombinationData(){
        //ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        //print_r($resParam);die();
        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Businessunitfilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Businessunitfilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/marketpresence-combination-data
        Description : Fetch Product Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionMarketpresenceCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Marketpresencefilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Marketpresencefilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/company-profile-combination-data
        Description : Fetch Product Details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionCompanyProfileCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'number');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if($searchType > 0 && $filterType > 0){
                $data['combinationData'] = Companyprofilefilter::organizeFilter($filterType, $searchType);
                $data['filterResultData'] = Companyprofilefilter::organizeFilterData($filterType, $searchType);
                $data['mpPk'] = $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/get-company-profile-details
        Description : Fetch Company Profile details
        Params :    {
                        postParams:{
                            companyPk
                        }
                    }
    */
    public function actionGetCompanyProfileDetails(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyPk)){
            $companyPk = Security::decrypt($resParam->companyPk);
            $companyPk = Security::sanitizeInput($companyPk,'number');
            if($companyPk > 0){
                $data['companyProfileDetails'] = Domainsearch::getCompanyProfileDetails($companyPk);
                // $message = $this->baseErrorMessage('success');
                $message = 'Success';
                $status = 100;
            }else{
                // $message = $this->baseErrorMessage('sanitizeError');
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            // $message = $this->baseErrorMessage('missingFields');
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    
    public function actionSavesearchhsty($request){
        $response = Bizsearch::saveHistory($request);
        return $this->asJson($response);
    }
    
    public function actionGetsearchhsty(){
        $response = Bizsearch::getSavedHistory();
        return $this->asJson($response);
    }
    
    public function actionDeletehistory() { 
        $id = Security::decrypt($_GET['id']);
        if(strpos($id,",")){
            $id = Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = Security::sanitizeInput($id,'number');
        }
        $model = \common\models\BizsearchhstyTbl::updateAll(['bsh_status' => 2,'bsh_deletedon'=>date('Y-m-d H:i:s'),'bsh_deletedby'=>\yii\db\ActiveRecord::getTokenData('user_pk', true)], ['IN','bizsearchhsty_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'History deleted successfully',
            ];
        }else{
            $result = [
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            ];
        }
        return $this->asJson($result);
    }

    /*
        Path : api/bs/bizsearch/initialize-smartfilter-data
        Description : Fetch Smart filter initialize data
        Params :    {
                        postParams:{
                            searchType - 1: Internal
                            criteriaType - 2: User, 5: Product
                        }
                    }
    */
    public function actionInitializeSmartfilterData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
         $data = [];
       if(isset($_REQUEST['searchType']) && isset($_REQUEST['criteriaType']) && ($_REQUEST['apiFor']== 'and' || $_REQUEST['apiFor']=='ios')){
        
        $searchType = Security::decrypt($_REQUEST['searchType']);
        $searchType = Security::sanitizeInput($searchType,'number');
        
        $criteriaType = Security::decrypt($_REQUEST['criteriaType']);
        $criteriaType = Security::sanitizeInput($criteriaType,'number');
        // echo '<pre>';
        // print_r("going".$criteriaType);
        //print_r("going".$searchType);
        //echo '</pre>';

        $data = Smartfilter::fetchSmarFilterInitiliazeData($searchType, $criteriaType);
       }else{
        //print_r('expression');die();
        $resParam = $params->postParams;
        $data = Smartfilter::fetchSmarFilterInitiliazeData($resParam->searchType, $resParam->criteriaType);
       }
        // $message = $this->baseErrorMessage('success');
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/map-user-favourite
        Description : 
        Params :    {
                        postParams:{
                            followPk,
                            followType,
                            type
                        }
                    }
    */
    public function actionMapUserFavourite(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $followPk = Security::decrypt($resParam->followPk);
        $followType = $resParam->followType;
        $type = $resParam->type;
        $data = MemcompprdserfollowdtlsTbl::mapUserFavourite($followPk, $followType, $type);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/getpscontacinfo
        Description : 
        Params :    {
                        postParams:{
                            continfo
                        }
                    }
    */
    public function actionGetpscontacinfo(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->continfo)){
            $continfo = Security::decrypt($resParam->continfo);
            
            if($continfo > 0){
                $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $data['psContactDetail'] = Bizsearchdetails::getpscontact($continfo);
                $message = 'Success';
                $status = 100;
            }else{
                $data['psContactDetail'] =[];
                $message = 'Success';
                $status = 100;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    /*
        Path : api/bs/bizsearch/getpsrelatedcat
        Description : Get the related category tab details for Product or Service
        Params :    {
                        postParams:{
                            type  1-Product,2-Service
                            pk  Current selected product / service Pk
                            compk Selected Product / Service Company Pk
                        }
                    }
    */
    public function actionGetpsrelatedcat(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->type) && isset($resParam->pk) && isset($resParam->compk)){
            $type = Security::decrypt($resParam->type);
            $data['pk'] = Security::decrypt($resParam->prodpk);
            $data['compk'] = Security::decrypt($resParam->compk);
            if(in_array($type,[1,2])){
                if($type==1)
                $finalQuery = B2bsearch::productSearch('','','','',$data);
                elseif($type==2)
                $finalQuery = B2bsearch::serviceSearch('','','','',$data);

                $searchProvider = new ActiveDataProvider([
                    'query' => $finalQuery
                ]);
                $data['psRCDetail'] =$searchProvider->getModels();
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/getsuppdtl
        Description : Get the related category tab details for Product or Service
        Params :    {
                        postParams:{
                            comppk Selected Product / Service Company Pk
                        }
                    }
    */
    public function actionGetsuppdtl(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->comppk)){
            $comppk = Security::decrypt($resParam->comppk);
            if(!empty($comppk)){              
                $data['compdtl'] = Bizsearchdetails::getCompanyDetails($comppk);
                $data['compdtl']['smcnt']=0;
                if(!empty($data['compdtl']['sm'])){
                    $data['compdtl']['sm']=array_filter(json_decode(json_decode($data['compdtl']['sm'],true),true));
                    $data['compdtl']['smcnt']=count($data['compdtl']['sm']);
                }
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/fetch-favourite-result
        Description : 
        Params :    {
                        postParams:{
                            followtype
                            type
                            pageSize
                            page
                        }
                    }
    */
    public function actionFetchFavouriteResult(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $followtype = Security::decrypt($resParam->followtype);
        $type = Security::decrypt($resParam->type);

        $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
        $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;
        $keyword = (isset($resParam->keyword) && !empty($resParam->keyword))?$resParam->keyword:'';

        $data['favResult'] = MemcompprdserfollowdtlsTbl::fetchFavResult($followtype, $type, $pageSize , $page, $keyword);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/fetch-prdser-favourite-result
        Description : 
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionFetchPrdserFavouriteResult(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
        $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;
        $keyword = (isset($resParam->keyword) && !empty($resParam->keyword))?$resParam->keyword:'';

        $data['favResult'] = MemcompprdserfollowdtlsTbl::fetchPrdserFavResult($pageSize , $page, $keyword);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/fetch-follow-result
        Description : 
        Params :    {
                        postParams:{
                            fetchType: 1 - Following, 2 - Follower
                        }
                    }
    */
    public function actionFetchFollowResult(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $fetchType = Security::decrypt($resParam->fetchType);

        $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
        $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;
        $keyword = (isset($resParam->keyword) && !empty($resParam->keyword))?$resParam->keyword:'';

        $data['followResult'] = MemcompprdserfollowdtlsTbl::fetchFollowResult($fetchType, $pageSize , $page, $keyword);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/unfollow
        Description : 
        Params :    {
                        postParams:{
                            followPk
                        }
                    }
    */
    public function actionUnfollow(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $followPk = Security::decrypt($resParam->followPk);

        $data['response'] = MemcompprdserfollowdtlsTbl::unfollow($followPk);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/fetch-recomended-details
        Description : 
        Params :    {
                        postParams:{
                            followPk
                        }
                    }
    */
    public function actionFetchRecomendedDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
        $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;
        $keyword = (isset($resParam->keyword) && !empty($resParam->keyword))?$resParam->keyword:'';

        $data['response'] = MemprodservrecmhdrTbl::getRecommendedDetails($pageSize , $page, $keyword);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/remove-recommended
        Description : 
        Params :    {
                        postParams:{
                            recPk
                        }
                    }
    */
    public function actionRemoveRecommended(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $pdtSerPk = Security::decrypt($resParam->pdtSerPk);

        $data['response'] = MemprodservrecmhdrTbl::removeRecommended($pdtSerPk);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/fetch-recommended-comments
        Description : 
        Params :    {
                        postParams:{
                            recType,
                            pdtSerPk
                        }
                    }
    */
    public function actionFetchRecommendedComments(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $recType = Security::decrypt($resParam->recType);
        $pdtSerPk = Security::decrypt($resParam->pdtSerPk);

        $data['commentsData'] = MemprodservrecmhdrTbl::fetchRecComment($recType, $pdtSerPk);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/bs/bizsearch/view-recommended-members
        Description : 
        Params :    {
                        postParams:{
                            recPk
                        }
                    }
    */
    public function actionViewRecommendedMembers(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $recPk = Security::decrypt($resParam->recPk);

        $data['recInternalMembers'] = MemprodservrecmhdrTbl::viewInternalRecommendedMembers($recPk);
        $data['recExternalMembers'] = MemprodservrecmhdrTbl::viewExternalRecommendedMembers($recPk);
        $data['recNonMembers'] = MemprodservrecmhdrTbl::viewNonRecommendedMembers($recPk);
        $message = 'Success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

 /*
        Path : api/bs/bizsearch/b2b-combination-data
        Description : Fetch User combination details
        Params :    {
                        postParams:{
                            searchType
                            filterType
                        }
                    }
    */
    public function actionB2bCombinationData(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->searchType) && isset($resParam->filterType)){
            $searchType = Security::decrypt($resParam->searchType);
            $searchType = Security::sanitizeInput($searchType,'string');
            $filterType = Security::decrypt($resParam->filterType);
            $filterType = Security::sanitizeInput($filterType,'number');
            if(!empty($searchType) && $filterType > 0 ){
                $data['filterResultData'] = B2bsearch::organizeFilterData($filterType, $searchType);
                $data['mpPk']  = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'sanitize error';
                $status = 106;
            }
        }else{
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionGetsuppcnt(){
       $cntdtl= Yii::$app->db->createCommand("SELECT 
        count( distinct mcm.MemberCompMst_Pk) as 'totaljsrscnt',
        count( distinct if( MCM_Origin='I',mcm.MemberCompMst_Pk,null)) as 'intersuppcnt',
        count( distinct if( MCM_Origin='N',mcm.MemberCompMst_Pk,null)) as 'nationsuppcnt',
  
        count( distinct mp.MemCompProdDtls_Pk) as 'totalprod',
        count( distinct mpm.mcprdm_memcompproddtls_fk) as 'totjsrsprodcnt',
        count( distinct ms.MemCompServDtls_Pk) as 'totalserv',
        count( distinct msm.mcsvdm_memcompservdtls_fk) as 'totjsrsservcnt'
    FROM
        `membercompanymst_tbl` mcm
    INNER JOIN `memberregistrationmst_tbl` ON MCM_MemberRegMst_Fk = MemberRegMst_Pk 
    
    left join memcompproddtls_tbl mp on MCPrD_MemberCompMst_Fk= MemberCompMst_Pk and mcprd_isdeleted=2 and MCPrD_CreatedOn is not null
    left join memcompproddtlsmain_tbl mpm on mpm.mcprdm_memcompproddtls_fk=MemCompProdDtls_Pk
	left join memcompservicedtls_tbl ms on MCSvD_MemberCompMst_Fk= MemberCompMst_Pk and mcsvd_isdeleted=2 and MCSvD_CreatedOn is not null
    left join memcompservicedtlsmain_tbl msm on msm.mcsvdm_memcompservdtls_fk= ms.MemCompServDtls_Pk
    WHERE
        (`mrm_stkholdertypmst_fk` = '6')
            AND (`MRM_MemberStatus` = 'A')
            AND (`MRM_ValSubStatus` = 'A')
            ;")->queryOne();
$jsrsts=Yii::$app->db->createCommand("select sum(jsrsactcnt) as 'jsrsactcnt', sum(jsrsexpcnt) as 'jsrsexpcnt' from (SELECT 
distinct MemberCompMst_Pk,
if(max(mcaah_expirydate) >= current_date(),1,0) as 'jsrsactcnt',
if(max(mcaah_expirydate) >= current_date(),0,1) as 'jsrsexpcnt'
from
`membercompanymst_tbl` mcm
INNER JOIN `memberregistrationmst_tbl` ON MCM_MemberRegMst_Fk = MemberRegMst_Pk 
inner join memcompaccactvnhstry_tbl on mcaah_memberregmst_fk=MemberRegMst_Pk

WHERE
(`mrm_stkholdertypmst_fk` = '6')
    AND (`MRM_MemberStatus` = 'A')
    AND (`MRM_ValSubStatus` = 'A')
    group by MemberCompMst_Pk
    ) as c")->queryOne();    
    $allcnt=array_merge($cntdtl,$jsrsts);        
           $message = 'Success';
           $status = 100;
            return $this->asJson([
                'data' => $allcnt,
                'msg' => $message,
                'status' => $status,
            ]);
    }    
    public function generateFile(){
        $value = '<table border="1">';
        $value .= '<tr>';
        $value .= '<td colspan="2" style="font-weight:bold;"> Downloaded On </td><td colspan="3"> ' . date('jS F, Y - h:i A') . '</td>';
        $value .= '</tr>';
        $value .= '<tr>';
        $value .= '<td colspan="2" style="font-weight:bold;"> Category </td><td colspan="3">  J Search - Supplier Network</td>';
        $value .= '</tr>';
        $value .= '</table>';
        return $value;
    }
    public function actionGetdownloadfile(){
        $id = base64_decode($_REQUEST['id']);
        $userexpt = $_REQUEST['linkaccess'];
        if(!empty($id) && is_numeric($id)){   
            $filename = $id.'.zip';        
            $path = dirname(__FILE__).'/../../../../backend/documents/bizsearch/';
            if (file_exists($path .$filename)){
                 if($userexpt == 'user'){
                    $biztb = \common\models\OsbizsrchdwnldtrackTbl::findOne($id);
                    $biztb->osbsdt_mailstatus = '1';
                    $biztb->osbsdt_dwnlddate=date('Y-m-d H:i:s');
                    $biztb->osbsdt_filepath=$filename;
                    $biztb->save();
                }                
                header("Content-Length:". filesize($path.$filename));
                header('Content-Type: application/zip'); 
                header('Content-Type: application/octet-stream');
                header("Content-Disposition: attachment; filename = export_company.zip");
                header('Content-Transfer-Encoding: binary');
                @readfile($path.$filename);
                exit;
            }else{
                echo "File does' t exit";exit;
            }
        }else{
            echo "Invalid link";exit;
        }          
    }
    public function actionViewdownloadpage(){
        $retdata = [];
        $islogin = $_REQUEST['id'];
        if($islogin == 1){
            $sessionregpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
            $sessionuserpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $pklink = base64_decode($_REQUEST['pid']);
            if(!empty($pklink) && is_numeric($pklink)){     
                $biztb = \common\models\OsbizsrchdwnldtrackTbl::findOne($pklink);
                $userpk = $biztb->osbsdt_expton;  
                $regpk = $biztb->osbsdt_memregmst_fk;  
                $expirydate= $biztb->osbsdt_expirydate;   
                if(date('Y-m-d')<= $expirydate){
                    if(($sessionuserpk == $userpk &&  $sessionregpk == $regpk) || $sessionregpk == $regpk){
                        $enpk = base64_encode($biztb->osbizsrchdwnldtrack_pk);
                        $retdata['obtrackid'] = $enpk;
                        $retdata['lkpth'] = \Yii::$app->urlManager->createAbsoluteUrl(['/bs/bizsearch/getdownloadfile?id='.$enpk.'&linkaccess=user']);
                        $msg = "valid";
                        $status = 100;  
                    }else{
                        $msg = "The link is invalid";
                        $status = 102;
                    }
                }else{
                    $msg = "The link is expired";
                    $status = 103;
                }
            }else{
                $msg = "The link is invalid";
                $status = 102;
            }
        }else{
            $retdata['obtrackid'] = base64_encode($pklink);
            $msg = "not login";
            $status = 101;
        }        
        return $this->asJson([
            'data' => $retdata,
            'msg' => $msg,
            'status' => $status,
        ]);
    }
    public function actionJsearchexportdata(){
        if($_REQUEST['mergeoption'] == 'Merge'){
            $exportquery = \api\modules\bs\components\Bizsearch::Jsearchexportqueryform($_REQUEST);
            $row = \api\modules\bs\components\Bizsearch::Jsearchexportqueryexce($exportquery);  
        }else{
            $exportquery = \api\modules\bs\components\Bizsearch::Jsearchexportunmergequeryform($_REQUEST);
//            $row = \api\modules\bs\components\Bizsearch::Jsearchexportqueryexce($exportquery);
        }
        $headerval = self::generateFile();
        $validityday =  \Yii::$app->params['Jsearch']['biz_export_validity']; 
        $expdate =  date('Y-m-d', strtotime("+$validityday days"));
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $getemailid = \common\models\UsermstTblQuery::getemailid($userpk);
        $exportobj = new \common\models\OsbizsrchdwnldtrackTbl();
        $exportobj->osbsdt_memregmst_fk=$regpk;
        $exportobj->osbsdt_searchtype=1;
        $exportobj->osbsdt_category=1;
        $exportobj->osbsdt_expton = date('Y-m-d H:i:s');
        $exportobj->osbsdt_exptby = $userpk;
        $exportobj->osbsdt_filetype = 1;
        $exportobj->osbsdt_inputfields = base64_encode($headerval);
        $exportobj->osbsdt_exptquery = trim(preg_replace('/\s+/', ' ', $exportquery));           
        $exportobj->osbsdt_exptlist = json_encode($_REQUEST); 
        $exportobj->osbsdt_exptstatus = 1;        
        $exportobj->osbsdt_exptbyipaddr = Common::getIpAddress();
        $exportobj->osbsdt_expirydate = $expdate;
        $exportobj->osbsdt_emailid = $getemailid;   
        $exportobj->osbsdt_mailstatus = '2';
        if($exportobj->save()){
            $pkid = $exportobj->osbizsrchdwnldtrack_pk; 
            try{
                $consolePath = Yii::$app->params['consolePath'];
                $consoleCalling = Yii::$app->params['consoleCalling'];
                $link =  \Yii::$app->params['baseUrl']."bizsearchnew/jexportdwnld?pid=";
                $exportLimit =  \Yii::$app->params['Jsearch']['exportLimit']; 
//                echo "{$consoleCalling} {$consolePath}yii export/bizmail $pkid  $link $exportLimit";exit;
                pclose(popen("start {$consoleCalling} {$consolePath}yii export/bizmail $pkid  $link $exportLimit", "r")); 
            }
            catch(Exception $e){                            
                $errormsg = $e->getMessage();                            
                self::getErrormsg($errormsg,$pkid);                             
            }
            $retexp = date("d-m-Y", strtotime($expdate)); 
            $message  = "The specific supplier list (download link) has been sent to your registered email ID ($getemailid) and the link will be valid only until end of the day " . $retexp;
            return $this->asJson([
                'msg' => $message,
                'status' => 100,
            ]);
        }       
    }
    public function getErrormsg($errormsg,$pkid){      
        $link = \Yii::$app->urlManager->createAbsoluteUrl(["bs/bizsearch/resendExptmail?pkid=".$pkid]);
        $content = $errormsg .'<br> <a href="'.$link.'">click</a>';
        $subject =  'Jsearch Export Link Mail Error Message';
        \Yii::$app->mailer->compose()
        ->setFrom('noreply@businessgateways.com')
        ->setTo('prithi@businessgateways.com')
//        ->setTo(\Yii::$app->params['testMailIDs'])
        ->setSubject($subject)
        ->setHTMLBody($content)
        ->send();
    }
    public function actionresendExptmail(){
        $pkid = $_REQUEST['pkid'];
        $consolePath = Yii::$app->params['consolePath'];
        $consoleCalling = Yii::$app->params['consoleCalling'];
        $link =  \Yii::$app->params['baseUrl']."bizsearchnew/jexportdwnld?pid="; 
        pclose(popen("start {$consoleCalling} {$consolePath}yii export/bizmail $pkid  $link", "r")); 
    }

        /*
        Path : api/bs/bizsearch/get-ps-category
        Description : Getting Product/Service Category groups
    Params :    {
                    postParams:{
                        type // P-Product S-Service
                    }
                }
    */
    public function actionGetPsCategory(){

        $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stk_type = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;   
         
        //For webservice
        if(($_REQUEST['apiFor'] == "and"||$_REQUEST['apiFor'] == "ios") && isset($_REQUEST['type']) && !empty($_REQUEST['type']))
        {
            $type=trim($_REQUEST['type']);
        }else{
            $type=$resParam->type;
        }      
        //end

        //print_r($type);die();
        
        if($type == 'P') {
            $catColumn = 'MCPrD_MemberCompMst_Fk';
        } else {
            $catColumn = 'MCSvD_MemberCompMst_Fk';
        }
        if($stk_type==6){
            $categoryList=Yii::$app->db->createCommand("select 'bgi-newfeaturesicon' as icon, SegmentMst_Pk as gcid,SegM_SegName as gcname,FamilyMst_Pk as mcid,FamM_FamilyName as mcname,ClassMst_Pk as scid,ClsM_ClassName as scname
        from segmentmst_tbl s join familymst_tbl f on s.SegmentMst_Pk=f.FamM_SegmentMst_Fk left join memcompproddtls_tbl on memcompproddtls_tbl.MCPrD_ProdSegmentMst_Fk = s.SegmentMst_Pk left join memcompservicedtls_tbl on memcompservicedtls_tbl.MCSvD_ServSegmentMst_Fk = s.SegmentMst_Pk and FamM_FamilyCategory='$type' and FamM_Status='A'
        join classmst_tbl c on f.FamilyMst_Pk=c.ClsM_FamilyMst_Fk and ClsM_FamilyCategory='$type' and ClsM_Status='A'
        where SegM_Status='A' and SegM_SegCategory='$type' and `$catColumn` = $cmpPk 
        group by ClsM_SegmentMst_Fk,ClsM_FamilyMst_Fk order by SegM_SegName,FamM_FamilyName,ClsM_ClassName")->queryAll();
        }else{
            $categoryList=Yii::$app->db->createCommand("select 'bgi-newfeaturesicon' as icon, SegmentMst_Pk as gcid,SegM_SegName as gcname,FamilyMst_Pk as mcid,FamM_FamilyName as mcname,ClassMst_Pk as scid,ClsM_ClassName as scname
        from segmentmst_tbl s join familymst_tbl f on s.SegmentMst_Pk=f.FamM_SegmentMst_Fk left join memcompproddtls_tbl on memcompproddtls_tbl.MCPrD_ProdSegmentMst_Fk = s.SegmentMst_Pk left join memcompservicedtls_tbl on memcompservicedtls_tbl.MCSvD_ServSegmentMst_Fk = s.SegmentMst_Pk and FamM_FamilyCategory='$type' and FamM_Status='A'
        join classmst_tbl c on f.FamilyMst_Pk=c.ClsM_FamilyMst_Fk and ClsM_FamilyCategory='$type' and ClsM_Status='A'
        where  SegM_Status='A' and SegM_SegCategory='$type' 
        group by ClsM_SegmentMst_Fk,ClsM_FamilyMst_Fk order by SegM_SegName,FamM_FamilyName,ClsM_ClassName")->queryAll();
        }
        
        if(!empty($categoryList)){
            $gcpoint=0;
            $mcpoint=0;
            
            foreach($categoryList as $key=>$data) {
                $catArr[$data['gcid']]['id']=$data['gcid'];
                $catArr[$data['gcid']]['title']=$data['gcname'];                 
                $catArr[$data['gcid']]['icon']=$data['icon'];                 
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['id']=$data['mcid'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['title']=$data['mcname'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['subCategory'][$data['scid']]['id']=$data['scid'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['subCategory'][$data['scid']]['title']=$data['scname'];
                if($data['mcid']!=$mcpoint && $mcpoint!=0){
                    $catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']);
                }
                if($data['gcid']!=$gcpoint && $gcpoint!=0){
                    $catArr[$gcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory']);
                }
                $gcpoint=$data['gcid'];
                $mcpoint=$data['mcid'];
                //  $catArr[$data['gcid']][$data['mcid']][$data['scid']][]=['id'=>$data['scid'],'title'=>$data['scname']];
            }
            $catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']);
            $catArr[$gcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory']);
        }

        if(($_REQUEST['apiFor'] == "and"||$_REQUEST['apiFor'] == "ios" && !empty($_REQUEST['apiFor'])))
        {
         $status = 1;
        }else{
        $status = 100;
        }

        //($catArr);die();
         return $this->asJson([
            'data' => array_values($catArr),
            'msg' => 'Success',
            'status' => $status,
        ]);
    }
    //Mobile Service Product Category Search//

    public function actionGetPsCategorysearch(){

        $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stk_type = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;   
         
        //For webservice
        if(($_REQUEST['apiFor'] == "and"||$_REQUEST['apiFor'] == "ios") && isset($_REQUEST['type']) && !empty($_REQUEST['type']))
        {
            $type=trim($_REQUEST['type']);
        }else{
            $type=$resParam->type;
        }      
        //end

        //print_r($type);die();
        if(isset($_REQUEST['prodsearch']) && $_REQUEST['prodsearch']!=''){
        $prodserch = $_REQUEST['prodsearch'];
        }
        if($type == 'P') {
            $catColumn = 'MCPrD_MemberCompMst_Fk';
        } else {
            $catColumn = 'MCSvD_MemberCompMst_Fk';
        }
        if($stk_type==6){
            $categoryList=Yii::$app->db->createCommand("select 'bgi-newfeaturesicon' as icon, SegmentMst_Pk as gcid,SegM_SegName as gcname,FamilyMst_Pk as mcid,FamM_FamilyName as mcname,ClassMst_Pk as scid,ClsM_ClassName as scname
        from segmentmst_tbl s join familymst_tbl f on s.SegmentMst_Pk=f.FamM_SegmentMst_Fk left join memcompproddtls_tbl on memcompproddtls_tbl.MCPrD_ProdSegmentMst_Fk = s.SegmentMst_Pk left join memcompservicedtls_tbl on memcompservicedtls_tbl.MCSvD_ServSegmentMst_Fk = s.SegmentMst_Pk and FamM_FamilyCategory='$type' and FamM_Status='A'
        join classmst_tbl c on f.FamilyMst_Pk=c.ClsM_FamilyMst_Fk and ClsM_FamilyCategory='$type' and ClsM_Status='A'
        where SegM_SegName LIKE '%$prodserch%' and SegM_Status='A' and SegM_SegCategory='$type' and `$catColumn` = $cmpPk 
        group by ClsM_SegmentMst_Fk,ClsM_FamilyMst_Fk order by SegM_SegName,FamM_FamilyName,ClsM_ClassName")->queryAll();
        }else{
            $categoryList=Yii::$app->db->createCommand("select 'bgi-newfeaturesicon' as icon, SegmentMst_Pk as gcid,SegM_SegName as gcname,FamilyMst_Pk as mcid,FamM_FamilyName as mcname,ClassMst_Pk as scid,ClsM_ClassName as scname
        from segmentmst_tbl s join familymst_tbl f on s.SegmentMst_Pk=f.FamM_SegmentMst_Fk left join memcompproddtls_tbl on memcompproddtls_tbl.MCPrD_ProdSegmentMst_Fk = s.SegmentMst_Pk left join memcompservicedtls_tbl on memcompservicedtls_tbl.MCSvD_ServSegmentMst_Fk = s.SegmentMst_Pk and FamM_FamilyCategory='$type' and FamM_Status='A'
        join classmst_tbl c on f.FamilyMst_Pk=c.ClsM_FamilyMst_Fk and ClsM_FamilyCategory='$type' and ClsM_Status='A'
        where  SegM_SegName LIKE '%$prodserch%' and SegM_Status='A' and SegM_SegCategory='$type' 
        group by ClsM_SegmentMst_Fk,ClsM_FamilyMst_Fk order by SegM_SegName,FamM_FamilyName,ClsM_ClassName")->queryAll();
        }
        

  
        if(!empty($categoryList)){
            $gcpoint=0;
            $mcpoint=0;
           // print_r($categoryList);exit;
            foreach($categoryList as $key=>$data) {
                $catArr[$data['gcid']]['id']=$data['gcid'];
                $catArr[$data['gcid']]['title']=$data['gcname'];                 
                $catArr[$data['gcid']]['icon']=$data['icon'];                 
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['id']=$data['mcid'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['title']=$data['mcname'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['subCategory'][$data['scid']]['id']=$data['scid'];
                $catArr[$data['gcid']]['subCategory'][$data['mcid']]['subCategory'][$data['scid']]['title']=$data['scname'];
                if($data['mcid']!=$mcpoint && $mcpoint!=0){
                    $catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']);
                }
                if($data['gcid']!=$gcpoint && $gcpoint!=0){
                    $catArr[$gcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory']);
                }
                $gcpoint=$data['gcid'];
                $mcpoint=$data['mcid'];
                //  $catArr[$data['gcid']][$data['mcid']][$data['scid']][]=['id'=>$data['scid'],'title'=>$data['scname']];
            }
            $catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory'][$mcpoint]['subCategory']);
            $catArr[$gcpoint]['subCategory']=array_values($catArr[$gcpoint]['subCategory']);
        }

        if(($_REQUEST['apiFor'] == "and"||$_REQUEST['apiFor'] == "ios" && !empty($_REQUEST['apiFor'])))
        {
         $status = 1;
        }else{
        $status = 100;
        }

        //($catArr);die();
         return $this->asJson([
            'data' => array_values($catArr),
            'msg' => 'Success',
            'status' => $status,
        ]);
    }
    public function actionGetsavedsearchinfo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $search_list = Bizsearch::getSavedSearchInfo($data['comppk']);
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
            'items' => !empty($search_list)?$search_list:[]
        ]); 
    } 
}
