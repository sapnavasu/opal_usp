<?php

namespace api\modules\mcp\controllers;

use common\models\BasemodulemstTbl;
use common\models\MemcompbankerdetailsTbl;
use common\models\StkholdertypmstTbl;
use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\DesignationmstTbl;
use \common\models\MembercompanymstTbl;
use \common\components\Security;
use sizeg\jwt\JwtHttpBearerAuth;
use common\components\Drive;
use \common\models\TendbrdsecmstTbl;
use \common\models\TendbrdgrademstTbl;
use \common\models\MemcomptendbrdsecgrddtlsTbl;
use \app\models\MemcompboardmemdtlsTbl;
use \app\models\IndustrialestatemstTbl;
use \app\models\IndustrialzonemstTbl;
use \app\models\BusinesslicensemstTbl;
use \app\models\OfficetypemstTbl;
use \app\models\MemcompbranchdtlstempTbl;
use \common\models\IsicactivitymstTbl;
use \common\models\MemcompfiledtlsTbl;
use \yii\data\ActiveDataProvider;
use common\models\MemcompbussrcdtlsTbl;
use common\models\MemcompfctydtlsTbl;
use common\models\FactorytypemstTbl;
use common\models\MemcompmplocationdtlsTbl;


class MastercompanyprofileController extends MasterController
{
    public $modelClass = 'common\models\MemberCompanyMstTbl';

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
    
     public function actionRefresh(){
        $response = [];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['refreshToken'];
        $obj = new JwtHttpBearerAuth();
        $token = $obj->loadToken($data);
        if(!empty($token)) {
        $tokenValues = $token->getClaim('uid');
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
                    /** @var Jwt $jwt */
                    $jwt = \Yii::$app->jwt;
                    $accessToken = $jwt->getBuilder()
                        ->setIssuer($_SERVER['SERVER_NAME'])// Configures the issuer (iss claim)
                        ->setAudience($_SERVER['SERVER_NAME'])// Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
                        ->set('uid', $tokenValues)// Configures a new claim, called "uid"
                        ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
                        ->getToken(); // Retrieves the generated token
                    
                    $refreshToken = $jwt->getBuilder()
                        ->setIssuer($_SERVER['SERVER_NAME'])// Configures the issuer (iss claim)
                        ->setAudience($_SERVER['SERVER_NAME'])// Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
                        ->set('uid', $tokenValues)// Configures a new claim, called "uid"
                        ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
                        ->getToken(); // Retrieves the generated token
        }else {
            $accessToken = $refreshToken = "";
        }
        return $this->asJson([
            'token' => (string) $accessToken,
            'refreshToken' => (string) $refreshToken,
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/companyinformation",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get company information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCompanyinformation(){
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char")); 
        if(!empty($id)){
            $response = MembercompanymstTbl::getCompanyInformation($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/crinfo",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get CR information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCrinfo(){
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char")); 
        if(!empty($id)){
            $response = MembercompanymstTbl::getCRInformation($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }


    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savecpbasicinfo",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save company information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="basicinfo", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="established_on", type="string", example=2),
     *                  @SWG\Property(property="paidupcapital", type="integer", example=3),
     *                  @SWG\Property(property="paidcaptial_currency", type="integer", example=3),
     *                  @SWG\Property(property="incorpstyle", type="integer", example=3),
     *                  @SWG\Property(property="origin", type="integer", example=3)
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavecpbasicinfo(){
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(2,'Edited the basic information of the company',$url,109);
        $response = [];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['basicinfo'];
        //Error Response
        $response['msg'] = 'failure';
        $response['status'] = 0;
        $response['data'] = 'Something went wrong';
        
        if(MembercompanymstTbl::saveCompanyInformationBasicInfo($data)){
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = 'Successfully saved';
        }
        return json_encode($response);
    }

    public function actionContactusmasterdata(){
       $returnData = [];
            
        $cache = new \api\common\services\CacheBGI();
        try{
            $cacheKey = 'contactusdata';
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \common\models\ContactquerymstTbl::contactQueryCache();
                $masterData = \common\models\ContactquerymstTbl::find()->where(['cqm_status'=>1])->asArray()->all();
                $cache->store($cacheKey, $masterData, $duration = 0 , $cacheQuery);
            } else {
                $masterData = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $masterData = \common\models\ContactquerymstTbl::find()->where(['cqm_status'=>1])->asArray()->all();
        }
      
       if($masterData != ''){
           foreach($masterData as $index => $value){ 
               $returnData[$index]['value'] = $value['contactquerymst_pk'];
               $returnData[$index]['viewValue'] = $value['cqm_contactquery'];
           }
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = $returnData;
            return json_encode($response);
       }
   }
   public function actionContactusccdata(){  
       $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
       $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
       $edata = [];
       if(in_array($_REQUEST['apiFor'],['and','ios']) && !empty($_REQUEST['emailstart']))
       {
        $likeemail = trim($_REQUEST['emailstart']);
        $addlikeemail = "and UM_EmailID LIKE '$likeemail%'";
       }else{
        $addlikeemail = '';
       }
            
        $cache = new \api\common\services\CacheBGI();
        try{
            $cacheKey = 'contactccdata'.$userPk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery =  \common\models\UsermstTbl::getUserMstCacheQuery();
                $masterData = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:fk and UM_Status =:sts and um_emailconfirmstatus =:stsemail and UserMst_Pk !=:usrfk '.$addlikeemail.'',['sts'=>'A','stsemail'=>1,':fk'=> $regpk,':usrfk'=> $userPk])->all();
                $cache->store($cacheKey, $masterData, $duration = 0 , $cacheQuery);
            } else {
                $masterData = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $masterData = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:fk and UM_Status =:sts and um_emailconfirmstatus =:stsemail and UserMst_Pk !=:usrfk',['sts'=>'A','stsemail'=>1,':fk'=> $regpk,':usrfk'=> $userPk])->all();
        }
      
       if(count($masterData) > 0){
           $edata = array_column($masterData,'UM_EmailID' );
        }
        $response['msg'] = 'success';
        $response['status'] = 1;
        $response['data'] = $edata;
        
       return json_encode($response);
        
   }
   public function actionInsertcontactus(){
       $request_body	=	file_get_contents('php://input');
       $data =	json_decode($request_body, true);     
       $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
       $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
      
    if(!empty($cmpPK)){
       if(in_array($_REQUEST['apiFor'],['and','ios']))
       { 
            for($_i=0;$_i<count($_REQUEST['ccemail']);$_i++){ 
                if(!empty($_REQUEST['ccemail'][$_i])){
                $ccemailstr1  .= trim($_REQUEST['ccemail'][$_i].',');
                $ccemailstr= rtrim($ccemailstr1,',');
                }
                $_i<count($_REQUEST['ccemail']);
            }  
            $contactusObj = new \common\models\ContactusdtlsTbl;
            $contactusObj->cud_conttype =1;
            $contactusObj->cud_companyname=$_REQUEST['companyName'];
            $contactusObj->cud_username=$_REQUEST['personName'];
            $contactusObj->cud_emailid=$_REQUEST['emailId'];
            $contactusObj->cud_emailcc= 'karan@businessgateways.com'; //$ccemailstr;
            $contactusObj->cud_contactquerymst_fk=$_REQUEST['typeofQuery'];
            $contactusObj->cud_message=$_REQUEST['about'];
            $contactusObj->cud_subject=$_REQUEST['subJect'];

            $fileDetails=\common\models\MemcompfiledtlsTbl::findOne($cmpPK);
            $filedtlpk=Yii::$app->db->createCommand("select `memcompfiledtls_pk` FROM `memcompfiledtls_tbl` WHERE `mcfd_memcompmst_fk`= $cmpPK and `mcfd_uploadedby`=$userPk and `mcfd_filemst_fk`=93 and `mcfd_isdeleted` = 0 and cast(`mcfd_uploadedon` as Date) = cast(Date(Now()) as Date)")->queryAll();
            foreach($filedtlpk as $val)
            { 
                $memfiledtlpk  .= trim($val['memcompfiledtls_pk'].',');
                $resfiledtlpk = rtrim($memfiledtlpk,',');
            }  
            $contactusObj->cud_memcompfiledtls_fk=$resfiledtlpk;
            $contactusObj->cud_membercompmst_fk = $cmpPK;
            $contactusObj->cud_usermst_fk = $userPk;
            $contactusObj->cud_createdon=date('Y-m-d H:i:s');
            $contactusObj->cud_mailtemplatepath = "test";
       }
       if($data != ''){
            if(!empty($data['contdata']['ccemail'])){
                $ccemailstr = implode(",",$data['contdata']['ccemail']);
           }
           $contactusObj = new \common\models\ContactusdtlsTbl;
           $contactusObj->cud_conttype =1;
           $contactusObj->cud_companyname=$data['contdata']['contactUs']['companyName'];
           $contactusObj->cud_username=$data['contdata']['contactUs']['personName'];
           $contactusObj->cud_emailid=$data['contdata']['contactUs']['emailId'];
           $contactusObj->cud_emailcc= $ccemailstr;
           $contactusObj->cud_contactquerymst_fk=$data['contdata']['contactUs']['typeofQuery'];
           $contactusObj->cud_message=$data['contdata']['contactUs']['about'];
           $contactusObj->cud_subject=$data['contdata']['contactUs']['subJect'];
           $contactusObj->cud_memcompfiledtls_fk=implode(",",$data['contdata']['contactUs']['contactusdoc']);
           $contactusObj->cud_membercompmst_fk = $cmpPK;
           $contactusObj->cud_usermst_fk = $userPk;
           $contactusObj->cud_createdon=date('Y-m-d H:i:s');
           $contactusObj->cud_mailtemplatepath = "test";
          }
         
            if($contactusObj->save()){
               //$email_to ='oman@businessgateways.com';
              //$changethis =badmashree@businessgateways.com;
               $email_to ='praveen@businessgateways.com';
               if(!empty($contactusObj->cud_emailcc)){
                    //with CC mail
                    $baseUrl = \Yii::$app->params['APP_URL'];
                    $url = $baseUrl."api/ma/mail/send";
                    $_data=[
                        'email'=>$email_to,
                        'template_id'=>233,
                        'table_ref_key'=>'MemberCompMst_Pk',
                        'table_ref_value'=>$cmpPK,
                        'addi_params'=>['cc_email'=>$contactusObj->cud_emailcc]
                    ];
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_POSTFIELDS => json_encode($_data),
                            CURLOPT_HTTPHEADER => array(
                                    "cache-control: no-cache",
                                    "content-type: application/json",
                            ),
                    ));
                    if(in_array($_REQUEST['apiFor'],['and','ios']))
                    {
                    $response['mail'] = json_decode(curl_exec($curl));
                    }else{
                        $response = curl_exec($curl);  
                    }
                    $err = curl_error($curl);
                    curl_close($curl);
               }else{  
                    $baseUrl = \Yii::$app->params['APP_URL'];
                    $url = $baseUrl."api/ma/mail/send";
                    $_data1=[
                        'email'=>$email_to,
                        'template_id'=>233,
                        'table_ref_key'=>'MemberCompMst_Pk',
                        'table_ref_value'=>$cmpPK
                    ];
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_POSTFIELDS => json_encode($_data1),
                            CURLOPT_HTTPHEADER => array(
                                    "cache-control: no-cache",
                                    "content-type: application/json",
                            ),
                    ));
                    if(in_array($_REQUEST['apiFor'],['and','ios']))
                    {
                    $response['mail'] = json_decode(curl_exec($curl));
                    }else{
                        $response = curl_exec($curl);  
                    }
                    $err = curl_error($curl);
                    curl_close($curl);
               }
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = 'Successfully saved';
             }else{
            $response['msg'] = 'error';
            $response['status'] = 2;
            $response['data'] = $contactusObj->getErrors();
           }
        }
        else{
           $response['msg'] = 'error';
            $response['status'] = 3;
            $response['data'] = 'empty params';
       }
           return json_encode($response);
   }
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savecrdetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save company information commercial Registration details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="cr", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="cr_regno", type="string", example=""),
     *                  @SWG\Property(property="issueddt", type="string", example=""),
     *                  @SWG\Property(property="expirydt", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavecrdetails(){
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(2,'Edited the commercial registration details of the company',$url,109);
        $response = [];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['cr'];
        if(MembercompanymstTbl::saveCompanyInformationCRDetails($data)){
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = 'Successfully saved';
        }
        return json_encode($response);
    }
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savebusinessunit",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save company information Sector and Activity details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="sectordtls", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="sector", type="string", example=""),
     *                  @SWG\Property(property="industry", type="string", example=""),
     *                  @SWG\Property(property="activity", type="string", example=""),
     *                  @SWG\Property(property="activities_count", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavebusinessunit() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['sectordtls'];
        $msg = 'Added Division.';
        $logType = 1;
        if(!empty($data['sector_pk'])){
            $msg = 'Edited Division.';
            $logType = 2;
        }
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity($logType,$msg,$url,109);
        $mcpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $bunitCount = \common\models\MemcompsectordtlsTbl::currentBunitCount($mcpPk);
        if($bunitCount >= 10 && empty($data['sector_pk'])){
        	$response['msg'] = "You can create/Add a total of 10 divisions towards your company";
            $response['status'] = 1;
            $response['flag'] = 'warning';
            $response['businessunitpk'] = '';
        }else{

	        $saved = \common\models\MemcompsectordtlsTbl::saveCompanyInformationBusinessUnitDetails($data);
	        if($saved === 0){
	            $response['msg'] = "{$data['unit_name']} already exists.";
	            $response['status'] = 1;	
	            $response['flag'] = 'warning';
	            $response['businessunitpk'] = '';
	        }else if ($saved) {
	            $response['msg'] = (empty($data['sector_pk'])) ? 'Division added successfully.' : 'Division updated successfully';
	            $response['status'] = 1;
	            $response['flag'] = 'success';
	            $response['businessunitpk'] = $saved;
	        }
        }
        return json_encode($response);
    }

    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/deletesectordetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete company information Sector and Activity details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletesectordetails() {
        $response = [];
        $id = Security::sanitizeInput(Security::decrypt($_REQUEST['id']), "string_spl_char"); 
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(3,'Deleted Business Units.',$url,109);
        if (\common\models\MemcompsectordtlsTbl::deleteCompanyInformationSectorDetails($id)) {
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['title'] = 'Success';
            $response['data'] = 'Division deleted successfully.';
            return json_encode($response);
        }
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/viewsectordetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to view company information Sector and Activity details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionViewsectordetails() {
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $response = [];
        $id = Security::decrypt($_GET['id']);
        $response = \common\models\MemcompsectordtlsTbl::ViewCompanyInformationSectorDetails($id);
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }


    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savebankdetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save company information bank details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="bankinfo", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="bank_pk", type="integer", example=""),
     *                  @SWG\Property(property="bankname", type="string", example=""),
     *                  @SWG\Property(property="bankaddress", type="string", example=""),
     *                  @SWG\Property(property="beneficiaryname", type="string", example=""),
     *                  @SWG\Property(property="beneficiarycurrency", type="string", example=""),
     *                  @SWG\Property(property="beneficiarydtls", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavebankdetails(){
        
        $response = [];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['bankinfo'];
        $msg = 'Added Bank Details.';
        $logType = 1;
        if(!empty($data['bank_pk'])){
            $msg = 'Edited Bank Details.';
            $logType = 2;
        }
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity($logType,$msg,$url,109);
        $bankData=MemcompbankerdetailsTbl::saveCompanyProfileBankerInformation($data);
        if($bankData){
            $response['msg'] = (!empty($data['bank_pk'])) ?  'Bank Details updated successfully.' : 'Bank Details added successfully.';
            $response['status'] = 1;
            $response['flag'] = 'S';
            $response['model']=$bankData;
        }
        return json_encode($response);
    }
    
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/saveauditordetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save company information auditor details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="auditorinfo", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="auditor_pk", type="integer", example=""),
     *                  @SWG\Property(property="auditor_name", type="string", example=""),
     *                  @SWG\Property(property="auditor_firmname", type="string", example=""),
     *                  @SWG\Property(property="auditor_address", type="string", example=""),
     *                  @SWG\Property(property="turnover", type="object",
     *                      @SWG\Property(property="year", type="string", example=""),
     *                      @SWG\Property(property="currency", type="string", example=""),
     *                      @SWG\Property(property="turnover", type="string", example=""),
     *                  ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveauditordetails(){
        $response = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['auditorinfo'];
        $msg = 'Added Annual Turnover.';
        $logType = 1;
        if(!empty($data['auditor_pk'])){
            $msg = 'Edited Annual Turnover.';
            $logType = 2;
        }
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity($logType,$msg,$url,109);
        $saveMdl=\common\models\MembcompauditordtlsTbl::saveCompanyProfileAuditorDetails($data);
        if($saveMdl){
            $response['msg'] = (!empty($data['auditor_pk'])) ?  'Financial Reports updated successfully.' : 'Financial Reports added successfully.';
            $response['status'] = 1;
            $response['flag'] = 'success';
            $response['model']=$saveMdl;
        }
        return json_encode($response);
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/sectordetails",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get company information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBusinessunit(){
        if(isset($_REQUEST['companypk']) && !empty($_REQUEST['companypk'])){
            $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char"));             
        }else{
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);
            $resParam = $params->postParams;
            $id =  Security::decrypt($resParam->compPk);
        }
        $response = [];
        if(!empty($id)){
            $response = \common\models\MemcompsectordtlsTbl::getMcpSectorDtlInformation($id,$resParam);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/auditorinformation",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get company information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAuditorinformation(){
        $response = [];
        if($_REQUEST['is-initial'] == 'true'){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(4,'Visited the company information.',$url,109);
        }
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char")); 
        if(!empty($id)){
            $response = \common\models\MembcompauditordtlsTbl::getAuditorInformation($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/deleteauditor",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete auditor information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteauditor(){
        $response = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(3,'Deleted Annaul Turnover',$url,109);
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char")); 
        if(!empty($id)){
            $id = explode(",", $id);
            $response = \common\models\MembcompauditordtlsTbl::deleteAuditor($id);
        }
        if($response){
            return [
                'msg' => 'success',
                'status' => 1,
                'data' => "Annual Turnover deleted successfully."
            ];
        }else{
            return [
                'msg' => 'failure',
                'status' => 0,
                'data' => "Something went wrong"
            ];
        }
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/auditorinfo",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get single auditor information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAuditorinfo(){
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        if(!empty($id)){
            $response = \common\models\MembcompauditordtlsTbl::getAuditorInfo($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/webpresence",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get single web presence information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionWebpresence(){
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        if($_REQUEST['is-intial'] == "true"){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(4,'Visited Web Presence Page.',$url,109);
        }
        if(!empty($id)){
            $response = \common\models\MembercompanymstTbl::getWebPresenceDetails($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savewebpresenceinfo",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save web presence information",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="webpresence", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="auditor_pk", type="integer", example=""),
     *                  @SWG\Property(property="auditor_name", type="string", example=""),
     *                  @SWG\Property(property="auditor_firmname", type="string", example=""),
     *                  @SWG\Property(property="auditor_address", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavewebpresenceinfo() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['webpresence'];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $descText = 'Saved the  company\'s Profile Links and Website details.';
        if(!isset($data['external_profile']) && !isset($data['website'])){
            $descText = 'Saved the  company\'s Social Media details.';
        }
        \common\components\UserActivityLog::logUserActivity(1,$descText,$url,109);
        if (\common\models\MembercompanymstTbl::saveWebPresenceDetails($data)) {
            $response['msg'] = 'Updated Successfully';
            $response['status'] = 1;
            $response['flag'] = 'success';
        }
        return json_encode($response);
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/board-of-directors",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get board of directors towards a company.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBoardOfDirectors(){
        if($_REQUEST['is-initial'] == 'true'){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(4,'Visited Board Members Page',$url,109);
        }
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        if(!empty($id)){
            $response = MemcompboardmemdtlsTbl::getBoardOfDirectors($id);
        }
        return $response;
    }
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/save-board-of-director",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save board of director information",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="boardofdirector", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="bod_pk", type="integer", example=""),
     *                  @SWG\Property(property="name", type="string", example=""),
     *                  @SWG\Property(property="designation", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveBoardOfDirector() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['boardofdirector'];
        $descText = "Added company's Board Member's details";
        $logType = 1;
        if(!empty($data['bod_pk'])){
            $descText = "Edited company's Board Members details";
            $logType = 2;
        }
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity($logType,$descText,$url,109);
        $savedData = \common\models\BoardmemberdtlsTbl::saveBoardOfDirector($data);
        if ($savedData) {
            $prefix = ($savedData->bmd_memberrtype == 2) ? 'Management' : 'Board Member';
            $response['msg'] = ($data['bod_pk']) ? $prefix.' updated successfully.' : $prefix.' added successfully.';
            $response['status'] = 1;
            $response['flag'] = 'success';
        }
        return json_encode($response);
    }
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/update-sort",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save board of director information",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="sort", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="bod_pk", type="integer", example=""),
     *                  @SWG\Property(property="name", type="string", example=""),
     *                  @SWG\Property(property="designation", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateSort() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['sort'];
        if (\common\models\BoardmemberdtlsTbl::updateSortOrder($data)) {
            $response['msg'] = 'Sorted Successfully';
            $response['status'] = 1;
            $response['flag'] = 'success';
        }
        return json_encode($response);
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/delete-board-of-director",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get board of directors towards a company.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteBoardOfDirector(){
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(3,'Deleted company\'s Board Members details',$url,109);
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        if(!empty($id)){
            $response = \common\models\BoardmemberdtlsTbl::deleteBoardOfDirector($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/get-board-of-directors",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get board of directors towards a company.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetBoardOfDirector(){
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        if(!empty($id)){
            $response = \common\models\BoardmemberdtlsTbl::getSingleBoardofDirector($id);
            $response->bmd_designation = DesignationmstTbl::getDesignationName($response['bmd_designation']);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    public function actionCheckalreadyexists(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $dataToCheck = strtolower(trim(Security::sanitizeInput($data['data'], "string_spl_char")));
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $isAvailable =  \common\models\MembercompanymstTbl::checkIsExternalProfileAlreadyExists($dataToCheck,$regpk);

        
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $isAvailable
        ]);
    }
    public function actionIsvalidlink(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $profileurl = trim(Security::sanitizeInput($data['data'], "string_spl_char")); // don t change into lower case; the response we get as wrong 
        $fp = curl_init($profileurl);
        
        curl_setopt($fp, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($fp, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($fp);
        $response_code = curl_getinfo($fp, CURLINFO_HTTP_CODE);
        if ($response_code == 301 || $response_code == 302) {
            preg_match('/(Location:|URI:)(.*?)\n/', $response, $matches);
            if (isset($matches[2])) {
                $redirect_url = trim($matches[2]);
                if ($redirect_url !== '') {
                    curl_setopt($ch, CURLOPT_URL, $redirect_url);
                     curl_follow_exec($ch);
                     $response_code = curl_getinfo($fp, CURLINFO_HTTP_CODE);
                }
            }
        }
        $validprofile = true;
        if($response_code == 404 || $response_code == 0 || $response_code == ''){
            $validprofile = false;
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $validprofile
        ]);
    }   
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/bankinfolist",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get company information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBankinfolist(){
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char")); 
        if(!empty($id)){
            $response = \common\models\MemcompbankerdetailsTbl::getBankerInformationByCompany($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/deletebankerinfo",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete banker information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "companypk", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletebankerinfo(){
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char")); 
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(3,'Deleted Bank Details.',$url,109);
        if(!empty($id)){
            $response = \common\models\MemcompbankerdetailsTbl::deleteBankerInfo($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'data' => 'Deleted successfully'
        ];
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/marketpresencelist",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of market presence information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionMarketpresencelist(){
        $response = []; 
        if($_REQUEST['type'] == 0){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(4,'Visited the Market Presence page.',$url,109);
        }
        if(!empty($_REQUEST)){
            $response = \common\models\MemcompmplocationdtlsTbl::getMarketpresenceList($_REQUEST);    
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/marketpresencelistbycms",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of market presence information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionMarketpresencelistbycms(){
        $response = []; 
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $type = $_REQUEST['type'];

        if(!empty($_REQUEST)){
            $response = \common\models\MemcompmplocationdtlsTbl::getlocationlistbytype($company_id, $type);
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/getlocation",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of market presence information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetlocation(){
        $response = []; 
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $id = $_REQUEST['id'];

        if(!empty($_REQUEST)){
            $response = \common\models\MemcompmplocationdtlsTbl::getlocationdetail($id);
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ]);
    }
    
    /**
     * @SWG\Post(
     *     path="/mcp/mastercompanyprofile/savemarketpresence",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save market presence information.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="marketpresence", type="object",
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="name", type="stirng", example=""),
     *                  @SWG\Property(property="type", type="integer", example=""),
     *                  @SWG\Property(property="otherloc", type="string", example=""),
     *                  @SWG\Property(property="nationality", type="integer", example=""),
     *                  @SWG\Property(property="crn", type="string", example=""),
     *                  @SWG\Property(property="description", type="string", example=""),
     *                  @SWG\Property(property="business_scope", type="integer", example=""),
     *                  @SWG\Property(property="branchid", type="string", example=""),
     *                  @SWG\Property(property="address", type="string", example=""),
     *                  @SWG\Property(property="latitude", type="string", example=""),
     *                  @SWG\Property(property="longitude", type="string", example=""),
     *                  @SWG\Property(property="country", type="integer", example=""),
     *                  @SWG\Property(property="state", type="integer", example=""),
     *                  @SWG\Property(property="city", type="integer", example=""),
     *                  @SWG\Property(property="landline_cc", type="string", example=""),
     *                  @SWG\Property(property="landline_no", type="integer", example=""),
     *                  @SWG\Property(property="landline_ext", type="integer", example=""),
     *                  @SWG\Property(property="faxnocc", type="string", example=""),
     *                  @SWG\Property(property="faxno", type="integer", example=""),
     *                  @SWG\Property(property="emailid", type="string", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavemarketpresence(){
        $response = [];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $data = $data['marketpresence'];
        //Error Response
        $response['msg'] = 'failure';
        $response['status'] = 0;
        $response['data'] = 'Something went wrong';
        $descText = self::getMarketPresenceInsertionText('save',$data['type'],$data['location_pk']);
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        if ($descText != '') {
            $logType = !empty($data['location_pk']) ? 2 : 1;
            \common\components\UserActivityLog::logUserActivity($logType, $descText, $url, 109);
        }       
        //print_r($data);die();
        if($data['type']==2){

            $save_branchtempdata=MemcompbranchdtlstempTbl::saveBranchTemp_dtls($data);

            if($save_branchtempdata){
            
                if($save_branchtempdata->memcompbranchdtlstemp_pk != '' && $save_branchtempdata->memcompbranchdtlstemp_pk != NULL ) {
                   $response['added_marketpresence_pk'] = $save_branchtempdata->memcompbranchdtlstemp_pk; 
                }
                
                $response['msg'] = 'success';
                $response['status'] = 1;
                $response['data'] = ($data['branchtempdtlspk']) ? ' updated successfully' : ' added successfully';
            }
        }

        
        return $this->asJson($response);
    }
    
    /**
     * @SWG\Get(
     *     path="/mcp/mastercompanyprofile/getmarketpresence",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get single market presence.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetmarketpresence(){
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(4,'Visited the Market Presence page.',$url,109);
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['id'], "string_spl_char")); 
        if(!empty($id)){
            $response = \common\models\MemcompmplocationdtlsTbl::getMarketPresenceByPk($id);
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ]);
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/deletemarketpresence",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete Market Presence.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletemarketpresence() {
        
        $response = [];

        $id = Security::sanitizeInput($_REQUEST['id'], "string_spl_char",true);
        $type = Security::sanitizeInput($_REQUEST['type'], "number",true);

        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $descText = self::getMarketPresenceInsertionText('delete',$type);
        \common\components\UserActivityLog::logUserActivity(3,$descText,$url,109);

        if (MemcompbranchdtlstempTbl::deleteMarketPresence($id)) {
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = 'deleted successfully';
        }
        return $this->asJson($response);
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/isregionexist",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete Market Presence.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIsregionexist(){
        $country = Security::sanitizeInput($_GET['country'], "string");
        $state = Security::sanitizeInput($_GET['state'],"string");
        $city = Security::sanitizeInput($_GET['city'],"string");
        if(!empty($country)){
            $countrypk = \api\modules\mst\models\CountryMasterQuery::chkCountry($country);
            if(!empty($countrypk) && !empty($state) && $state != "undefined"){
                $statepk = \api\modules\mst\models\StatemstTblQuery::checkStateExist($state,$countrypk);
            }
            if(!empty($statepk) && !empty($city) && $city != "undefined"){
                    $citypk = \api\modules\mst\models\CitymstTblQuery::checkCityExist($city,$statepk,$countrypk);
            }
        }
        return $this->asJson([
            'country' => $countrypk,
            'state' => $statepk,
            'city' => $citypk
        ]);
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/contactinfolist",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get the list of contact info.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionContactinfolist(){
        if($_REQUEST['type'] == 0){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(4,'Visited Contact Information page.',$url,109);
        }
        $response = []; 
        if(!empty($_REQUEST)){
            $response = \common\models\UsermstTbl::getContactInfoList($_REQUEST);
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ]);
    }
    
    public function getMarketPresenceInsertionText($insertionFor,$type,$pk = ''){
        switch($type){
            case 1:
                return !empty($pk) ? "Updated the company's Primary Office details." : "Saved the company's Primary Office details."; 
            case 2:
                if($insertionFor == 'delete'){
                    return 'Deleted a Branch Office details.';
                }
                return !empty($pk) ? "Edited a Branch Office details." : "Added a Branch Office details."; 
            case 3:
                if($insertionFor == 'delete'){
                    return 'Deleted a Representative Office details.';
                }
                return !empty($pk) ? "Edited a Representative Office details." : "Added a Representative Office details."; 
            case 4:
                if($insertionFor == 'delete'){
                    return 'Deleted a Manufacturing Plant details.';
                }
                return !empty($pk) ? "Edited a Manufacturing Plant details." : "Added a Manufacturing Plant details."; 
            case 5:
                if($insertionFor == 'delete'){
                    return 'Deleted a Wholesale Distributor details.';
                }
                return !empty($pk) ? "Edited a Wholesale Distributor details." : "Added a Wholesale Distributor details."; 
            case 6:
                if($insertionFor == 'delete'){
                    return 'Deleted a Retail Distributor details.';
                }
                return !empty($pk) ? "Edited a Retail Distributor details." : "Added a Retail Distributor details."; 
            case 7:
                if($insertionFor == 'delete'){
                    return 'Deleted an Agent details.';
                }
                return !empty($pk) ? "Edited an Agent details." : "Added an Agent details."; 
            case 8:
                if($insertionFor == 'delete'){
                    return 'Deleted a Trade House details.';
                }
                return !empty($pk) ? "Edited a Trade House details." : "Added a Trade House details."; 
            case 9:
                if($insertionFor == 'delete'){
                    return 'Deleted an Other Market Presence details.';
                }
                return !empty($pk) ? "Edited an Other Market Presence details." : "Added an Other Market Presence details."; 
            case 10:
                return !empty($pk) ? "" : ""; 
            case 11:
                return !empty($pk) ? "" : ""; 
            case 12:
                return !empty($pk) ? "" : ""; 
            case 13:
                return !empty($pk) ? "" : ""; 
            case 14:
                return !empty($pk) ? "" : ""; 
        }
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/grpcmpnamesugg",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get auto suggestions for the group name.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGrpcmpnamesugg(){
        $groupcmpnameArr = MembercompanymstTbl::getCompanyGroupNameSuggestions();
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $groupcmpnameArr ? $groupcmpnameArr : []
        ]);
    }
    
    /**
     * @SWG\GET(
     *     path="/mcp/mastercompanyprofile/grpcmpcodesugg",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get auto suggestions for the group code.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGrpcmpcodesugg(){
        $companyCode = Security::sanitizeInput($_GET['filterVal'], 'string');
        $groupcmpcodeIncCount = MembercompanymstTbl::getCompanyGroupCodeSuggestions($companyCode);
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => $groupcmpcodeIncCount ? $groupcmpcodeIncCount : ""
        ]);
    }
    
    public function actionBasicdetails(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \common\models\UsermstTblQuery::addbasicinfo($data);
    }
    public function actionAddsubsidiaries() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::addSubs($data);
    }
    public function actionAddinvinfo() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::addinvinfo($data);
    }
    public function actionDeletesubsidiaries() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::deletesubsidiaries($data);
    }
    public function actionGetsubsedit() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::getsubsedit($data);
    }
    public function actionGetcompinfo() {
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::getcompinfo();
    }
    public function actionGetprofiledata(){
       return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::getprofiledata();
    }
    public function actionGetsubsindex(){
        return \api\modules\mcp\models\MemcompsubsidiarydtlsTblQuery::getsubsindex($_REQUEST);
    }
    public function actionInvestorinfo(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \common\models\UsermstTblQuery::addinvestorinfo($data);

    }
    public function actionGetreportedto(){
        $cache = new \api\common\services\CacheBGI();
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        //$response['data'] = [];
        $response['dept'] = [];
        $response['degnlevel']  = [];
        $response['bussor']  = [];
        $response['mstdata']  = [];
        $response['certificatedata'] = [];
        $response['addressists'] = [];
       $masterdata =  \common\models\UsermstTbl::find()->where('UserMst_Pk =:usrfk',[':usrfk'=> $userPk])->one();
       if(!empty($masterdata)){
           $supervi = [];
           if(!empty($masterdata->um_supervisor)){
               $sdata = $masterdata->um_supervisor;
               $supervi = array_map('intval', explode(',', $sdata));
           }
           $depat = [];
           if(!empty($masterdata->um_departmentmst_fk)){
                $dept = $masterdata->um_departmentmst_fk;
                $depat = array_map('intval', explode(', ', $dept));               
           }           
           $mobilecode = '';
           if(!empty($masterdata->um_primobnocc)){
               $countrymst = \api\modules\mst\models\CountryMaster::find()->where('CountryMst_Pk =:cntfk',[':cntfk'=> $masterdata->um_primobnocc])->one();
               $mobilecode = $countrymst->CyM_CountryDialCode;
           }
           $landlinecode = '';
           if(!empty($masterdata->um_landlinecc)){
               $countrymst = \api\modules\mst\models\CountryMaster::find()->where('CountryMst_Pk =:cntfk',[':cntfk'=> $masterdata->um_landlinecc])->one();
               $landlinecode = $countrymst->CyM_CountryDialCode;
           }
            $response['mstdata']['mobilecode']  = $mobilecode;
            $response['mstdata']['landlinecode']  = $landlinecode;
            $response['mstdata']['mobilecntypcode']  = $masterdata->um_primobnocc;
            $response['mstdata']['landlinecntypcode']  = $masterdata->um_landlinecc;            
            $response['mstdata']['name']  = $masterdata->um_firstname;
            $response['mstdata']['midlename']  = $masterdata->um_middlename;
            $response['mstdata']['lastname']  = $masterdata->um_lastname;
            $response['mstdata']['doj']  = $masterdata->up_dateofjoin; 
            $response['mstdata']['userdp']  = (array)$masterdata->um_userdp;
            $response['mstdata']['employeid']  = $masterdata->UM_EmpId;
            $response['mstdata']['breifprof']  = $masterdata->um_profbrief;
            $response['mstdata']['division']  =$masterdata->um_busunit;
            $response['mstdata']['deptpk']  = $depat;
            $response['mstdata']['designat']  = $masterdata->designation->dsg_designationname;
            $response['mstdata']['designatlevl']  = $masterdata->um_desiglevel;
            $response['mstdata']['yearofexp']  = $masterdata->up_yrsofexperience;
            $response['mstdata']['reportto']  = $masterdata->up_reportingto;
            $response['mstdata']['superv']  = $supervi;
            $response['mstdata']['rolesresp']  = $masterdata->up_rolesnresp;
            $response['mstdata']['primaryno']  = $masterdata->um_primobno;
            $response['mstdata']['primarynocc']  = (int)$masterdata->um_primobnocc;
            $response['mstdata']['priemailid']  = $masterdata->UM_EmailID;
            $response['mstdata']['landlineno']  = $masterdata->um_landlineno;
            $response['mstdata']['landlinenocc']  = (int)$masterdata->um_landlinecc;
            $response['mstdata']['landlinenoext']  = $masterdata->um_landlineext;
            $response['mstdata']['address']  = (int)$masterdata->um_address;
            $response['mstdata']['city']  = $masterdata->um_citymst_fk;
            $response['mstdata']['state']  = $masterdata->um_statemst_fk;
            $response['mstdata']['country']  = $masterdata->um_countrymst_fk;
            $response['mstdata']['pincode']  = $masterdata->um_postalcode;
            $response['mstdata']['verifiedemail']  = $masterdata->um_emailverified;
            $response['mstdata']['verifiedmobile']  = $masterdata->um_mobileverified;
            if(!empty($masterdata->um_webpresence)){
                $webpre= json_decode($masterdata->um_webpresence,TRUE);
                $response['mstdata']['Skype']  = $webpre['skype'];
                $response['mstdata']['Zoom']  = $webpre['zoom'];
                $response['mstdata']['GoogleMeet']  = $webpre['googlemeet'] ;
            }else{
                $response['mstdata']['Skype']  = '';
                $response['mstdata']['Zoom']  = '';
                $response['mstdata']['GoogleMeet']  = '' ;
            }
            if(!empty($masterdata->um_socialmedia)){
                $socialmed= json_decode($masterdata->um_socialmedia,TRUE);
                $response['mstdata']['facebook']  = $socialmed['facebook'];
                $response['mstdata']['instragram']  = $socialmed['instagram'];
                $response['mstdata']['twitter']  = $socialmed['twitter'] ;
                $response['mstdata']['linkedin']  = $socialmed['linkedin'];
            }else{
                    $response['mstdata']['facebook']  = '';
                    $response['mstdata']['instragram']  = '';
                    $response['mstdata']['twitter']  = '' ;
                    $response['mstdata']['linkedin']  ='';
            }

            try{
                $cacheKeycert = 'certificate'.$cmpPK;
                if(empty($cache->retreive($cacheKeycert))){
                    $certcacheQuery = \common\models\UsermstTblQuery::usrcertQueryCache();
                    $returncerData = \common\models\UsermstTblQuery::usrcertificatedetwithpag($userPk,$cmpPK,3,'');
                    $cache->store($cacheKeycert, $returncerData, $duration = 0 , $certcacheQuery);
                } else {
                    $returncerData = $cache->retreive($cacheKeycert);
                }

            } catch(\Exception $e){
                $returncerData = \common\models\UsermstTblQuery::usrcertificatedetwithpag($userPk,$cmpPK,3,'');
            }
          
            $countcertif  = \common\models\UsrcertifidtlsTbl::find()->where('ucd_usermst_fk =:usrfk',[':usrfk'=>$userPk])->count();
            $response['certificatedata'] = $returncerData['res'];             
            $response['certificatecnt'] = $countcertif;             
            $response['overallcertificatecnt'] = $countcertif;             
            if(!empty($masterdata->um_address)){
                $returnDataadd =  \common\models\UsermstTblQuery::communiaddlist($cmpPK,(int)$masterdata->um_address);
                $response['addressists'] = $returnDataadd; 
            }
       }              
       
       $reprtData = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:fk and UM_Status =:sts and um_emailconfirmstatus =:stsemail and UserMst_Pk !=:usrfk',[':sts'=>'A',':fk'=> $regpk,':usrfk'=> $userPk,'stsemail'=>1])->orderBy('um_firstname ASC')->all();
       if($reprtData){
           foreach($reprtData as $index => $value){
               $returnData[$index]['value'] = $value['UserMst_Pk'];
               $returnData[$index]['viewValue'] = $value['um_firstname'].' '.$value['um_lastname'];
           }     
           $response['data'] = $returnData; 
       }
       $departmentdata = [];
     
       if(!empty($masterdata->um_departmentmst_fk)){
       $deptData = \common\models\DepartmentmstTbl::find()
       ->where("DM_MembCompMst_Fk=:cmpfk and DepartmentMst_Pk in ($masterdata->um_departmentmst_fk)",[':cmpfk'=> $cmpPK])->orderBy('DM_Name ASC')->all();
       $deptlit = \common\models\DepartmentmstTbl::find()
          ->select(['GROUP_CONCAT(DepartmentMst_Pk) as deptlist'])
          ->where("DM_MembCompMst_Fk=:cmpfk and DepartmentMst_Pk in ($masterdata->um_departmentmst_fk)",[':cmpfk'=> $cmpPK])->orderBy('DM_Name ASC')->asArray()->one();
    
       if($deptData != ''){
           foreach($deptData as $index => $value){
               $DreturnData[$index]['deptPk'] = $value['DepartmentMst_Pk'];
               $DreturnData[$index]['deptName'] = $value['DM_Name'];
               array_push($deptlist,$value['DepartmentMst_Pk']);
           }               
           $departmentdata = $DreturnData;
            
       }
    }
       $response['dept'] = $departmentdata; 
       $response['deptlist']= $deptlit['deptlist'];
      $deignlevelData = \api\modules\mst\models\DesignationlevelmstTbl::find()->where('dlm_status = 1')->all();
       if($deignlevelData != ''){
           foreach($deignlevelData as $index => $value){
               $DLreturnData[$index]['value'] = $value['designationlevelmst_pk'];
               $DLreturnData[$index]['viewValue'] = $value['dlm_desglevelname'];
           }                    
           $response['degnlevel'] = $DLreturnData; 
       }
       $bussodata = [];
       if(!empty($masterdata->um_busunit)){
       $businsorceData = \common\models\MemcompsectordtlsTbl::find()->where("MCSD_MemberCompMst_Fk=:cmpfk and MemCompSecDtls_Pk in ($masterdata->um_busunit)",[':cmpfk'=> $cmpPK])->orderBy('mcsd_businessunitrefname ASC')->all();
       if(count($businsorceData) > 0){
           foreach($businsorceData as $index => $value){
               $returnbData1[$index]['value'] = $value['MemCompSecDtls_Pk'];
               $returnbData1[$index]['viewValue'] = $value['mcsd_businessunitrefname'];
           }                    
           $bussodata = $returnbData1; 
       }
       }
       $response['bussor'] = $bussodata;
       $response['msg'] = 'success';
       $response['status'] = 1;   
       return json_encode($response);
    }
    public function actionGetprofiledet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        if(!empty($data['id'])){
            $userPk = $data['id'];
        }else{
            $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        }
        $response['mstdata']  = [];
        $response['certificatedata'] = [];
         $response['addressists'] = [];
         $webpres = [];
       $masterdata =  \common\models\UsermstTbl::find()->where('UserMst_Pk =:usrfk',[':usrfk'=> $userPk])->one();
       if(!empty($masterdata)){
           $cmpPK = $masterdata->membercompany->MemberCompMst_Pk;
           $reportto  ="NIL";
           if(!empty($masterdata->up_reportingto)){
               $reprtData = \common\models\UsermstTbl::find()->where('UserMst_Pk =:usrfk',[':usrfk'=> $masterdata->up_reportingto])->one();
               $reportto = $reprtData->um_firstname;
           }
           $supp  =array(0=>'NIL');
           if(!empty($masterdata->um_supervisor)){
               $suparr = explode(',', $masterdata->um_supervisor);
               $superviarra = array_filter($suparr);
               $impodesup = implode(',', $superviarra);
               $reprtData = \common\models\UsermstTbl::find()->where("UserMst_Pk in ($impodesup)")->all();
               $supp = array_column($reprtData,'um_firstname');
           }
           $busunit  ="NIL";
           if(!empty($masterdata->um_busunit)){
               $businsorceData = \common\models\MemcompsectordtlsTbl::find()->where("MemCompSecDtls_Pk in ($masterdata->um_busunit)")->all();
               $dept = array_column($businsorceData, 'mcsd_businessunitrefname');
                $busunit = implode(',', $dept);  
           }           
           $mobilecode = '';
           if(!empty($masterdata->um_primobnocc)){
               $countrymst = \api\modules\mst\models\CountryMaster::find()->where('CountryMst_Pk =:cntfk',[':cntfk'=> $masterdata->um_primobnocc])->one();
               $mobilecode = $countrymst->CyM_CountryDialCode;
           }
           $landlinecode = '';
           if(!empty($masterdata->um_landlinecc)){
               $countrymst = \api\modules\mst\models\CountryMaster::find()->where('CountryMst_Pk =:cntfk',[':cntfk'=> $masterdata->um_landlinecc])->one();
               $landlinecode = $countrymst->CyM_CountryDialCode;
           }
           $doj = 'NIL';
           if(!empty($masterdata->up_dateofjoin)){
            $doj = date('d-m-Y', strtotime($masterdata->up_dateofjoin)); 
           }
           $designat ='';
           if(!empty($masterdata->UM_Designation)){
            $desimst = \api\modules\mst\models\DesignationmstTbl::find()->where('designationmst_pk =:cntfk',[':cntfk'=> $masterdata->UM_Designation])->one();
            $designat = $desimst->dsg_designationname;
            }
            $deptName ='';
            if(!empty($masterdata->um_departmentmst_fk)){
            $departmentlist = \common\models\departmentmsttbl::find()->where("DepartmentMst_Pk in ($masterdata->um_departmentmst_fk)")->all();
            $dept = array_column($departmentlist, 'DM_Name');
            $deptName = implode(',', $dept);  
          
             }
           $response['mstdata']['doj']  = $doj;
            $response['mstdata']['employeid']  = (!empty($masterdata->UM_EmpId)? $masterdata->UM_EmpId : 'NIL');  
            $response['mstdata']['reportto']  = $reportto;
            $response['mstdata']['superv']  = $supp;
            $response['mstdata']['bussunit']  = $busunit;
            $response['mstdata']['rolesresp']  =(!empty( $masterdata->up_rolesnresp)?  $masterdata->up_rolesnresp : 'NIL');
            $response['mstdata']['breifprof']  = (!empty($masterdata->um_profbrief)? $masterdata->um_profbrief : 'NIL');
            $response['mstdata']['designat']  = (!empty($designat)? $designat : 'NIL');
            $response['mstdata']['deptName']  = (!empty($deptName)? $deptName : 'NIL');
            if(!empty($masterdata->um_primobno)){
                $response['mstdata']['primaryno']  = $mobilecode. '  '.$masterdata->um_primobno ;
            }else{
                $response['mstdata']['primaryno']  = 'NIL';
            }
            $response['mstdata']['priemailid']  = (!empty($masterdata->UM_EmailID)? $masterdata->UM_EmailID : 'NIL');
            if(!empty($masterdata->um_landlineno)){
                $response['mstdata']['landlineno']  = $landlinecode . '  '.$masterdata->um_landlineno . '  '.  $masterdata->um_landlineext;
            }else{
                $response['mstdata']['landlineno']  = 'NIL';
            }
            $webps = null;
            if(!empty($masterdata->um_webpresence)){
                 $webpresenceimage = ['skype'=>'skypeimage','zoom'=>'zoom','googlemeet'=>'gmeet'];
                $socialmed= json_decode($masterdata->um_webpresence,TRUE);          
                $webpres = array_filter($socialmed,'strlen');         
                foreach ($webpres as $key => $value) {
                    $weddata[$key]['webprsedata'] = $value;
                    $weddata[$key]['imageicon'] = $webpresenceimage[$key];
                }
                $webps =  array_values($weddata);     
            }
            $response['mstdata']['webpresence']  = $webps;    
           $response['certificatedata'] =  \common\models\UsermstTblQuery::usrcertificatedet($userPk,$cmpPK);
           if(!empty($masterdata->um_address)){
                $returnDataadd =  \common\models\UsermstTblQuery::communiaddlist($cmpPK,(int)$masterdata->um_address);
                $response['addressists'] = $returnDataadd; 
            }
       }       
       $response['msg'] = 'success';
       $response['status'] = 1;   
       return json_encode($response);
    }
    public function actionGetbasicprofiledet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        if(!empty($data['id'])){
            $userPk = $data['id'];
        }else{
            $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        }
        $response['mstdata']  = [];
       $masterdata =  \common\models\UsermstTbl::find()->where('UserMst_Pk =:usrfk',[':usrfk'=> $userPk])->one();
       if(!empty($masterdata)){
           $depat = "NIL";
           if(!empty($masterdata->um_departmentmst_fk)){
           $deptData = \common\models\DepartmentmstTbl::find()->where("DepartmentMst_Pk in ($masterdata->um_departmentmst_fk)")->all();
                $dept = array_column($deptData, 'DM_Name');
                $depat = implode(', ', $dept);  
           }
           $cmpPK = $masterdata->membercompany->MemberCompMst_Pk;
           $designatlevl   ="NIL";
           if(!empty($masterdata->um_desiglevel)){
               $deignlevelData = \api\modules\mst\models\DesignationlevelmstTbl::find()->where('dlm_status = 1 and designationlevelmst_pk =:pk',['pk'=>$masterdata->um_desiglevel])->one();
               $designatlevl = $deignlevelData->dlm_desglevelname;
           }
           $countryname  ="";
           $countryid  ="";
           if(!empty($masterdata->membercompany->MCM_CountryMst_Fk)){
                $countrymst = \api\modules\mst\models\CountryMaster::find()->where('CountryMst_Pk =:cntfk',[':cntfk'=> $masterdata->membercompany->MCM_Source_CountryMst_Fk])->one();
                $countryname  = $countrymst->CyM_CountryName_en;
                $countryid  = $countrymst->CountryMst_Pk;
           }
            $socialmed= json_decode($masterdata->um_socialmedia,TRUE);
            $response['mstdata']['name']  = $masterdata->um_firstname . ' '. $masterdata->um_middlename .' ' . $masterdata->um_lastname ;
            $response['mstdata']['compname']  = $masterdata->membercompany->MCM_CompanyName;
            $response['mstdata']['cntyid']  = $countryid;
            $response['mstdata']['userdp'] = './assets/images/NoimageJPG.jpg';
            if(!empty($masterdata->um_userdp)){
                $response['mstdata']['userdp']  = Drive::generateUrl($masterdata->um_userdp, $cmpPK, $userPk);
            }
            $response['mstdata']['deptName']  = $depat;
            $response['mstdata']['designat']  =(!empty($masterdata->designation->dsg_designationname) ? $masterdata->designation->dsg_designationname : "NIL" );   
            $response['mstdata']['designatlevl'] = $designatlevl;
            $response['mstdata']['country']  = $countryname;          
            $response['mstdata']['facebook']  = $socialmed['facebook'];
            $response['mstdata']['instragram']  = $socialmed['instagram'];
            $response['mstdata']['twitter']  = $socialmed['twitter'] ;
            $response['mstdata']['linkedin']  = $socialmed['linkedin'];
       }       
       $response['msg'] = 'success';
       $response['status'] = 1;   
       return json_encode($response);
    }
    public function actionSavbsicdet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        return \common\models\UsermstTblQuery::savebasicdata($data);      
    }
    public function actionDeletecertif(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        $certid = Security::sanitizeInput(Security::decrypt($data['certid']), "string_spl_char"); 
        return \common\models\UsermstTblQuery::deletecertif($certid);      
    }
    public function actionDeletesocialmed(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        $type = $data['type']; 
        return \common\models\UsermstTblQuery::deletesocialmedtype($type);      
    }
    public function actionDeletewebpre(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        $type = $data['type']; 
        return \common\models\UsermstTblQuery::deletewebpretype($type);      
    }
    public function actionSavcomunidet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        return \common\models\UsermstTblQuery::savecomundata($data);      
    }
    public function actionSavecomunadddet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        return \common\models\UsermstTblQuery::savecomunadddata($data);      
    }
    public function actionSavcertdet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);  
        return \common\models\UsermstTblQuery::savecertidata($data);      
    }
    public function actionSavcsocialmediadett(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);  
        $sodata = '';
        if(!empty($data['bdata']['facebook']) || !empty($data['bdata']['instagram']) || !empty($data['bdata']['twitter']) || !empty($data['bdata']['linkedin'])){
            $socialdata = array('facebook'=>$data['bdata']['facebook'],'instagram'=>$data['bdata']['instagram'],'twitter'=>$data['bdata']['twitter'],'linkedin'=>$data['bdata']['linkedin']);
            $sodata = json_encode($socialdata);
        }
        $wdata = '';
         if(!empty($data['bdata']['Skype']) || !empty($data['bdata']['Zoom']) || !empty($data['bdata']['GoogleMeet'])){
            $webpresdata = array('skype'=>$data['bdata']['Skype'],'zoom'=>$data['bdata']['Zoom'],'googlemeet'=>$data['bdata']['GoogleMeet']);
            $wdata =   json_encode($webpresdata); 
         }
        $sdata['socialmed'] = $sodata;
        $sdata['webpresense'] =$wdata;
        return \common\models\UsermstTblQuery::savesocialmediadata($sdata);      
    }

    public function actionGetcommunicationadd(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $response['headquoff'] = [];
        $cache = new \api\common\services\CacheBGI();
        try{
            $cacheKey = 'getcommunication'.$cmpPK;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \common\models\MemcompmplocationdtlsTbl::memcomplocationQueryCache();
                $allOffices =  \common\models\MemcompmplocationdtlsTbl::find()->where('mcmpld_membercompmst_fk=:fk',[':fk'=> $cmpPK])->all();
                $cache->store($cacheKey, $allOffices, $duration = 0 , $cacheQuery);
            } else {
                $allOffices = $cache->retreive($cacheKey);
            }
            
        } catch(\Exception $e){
            $allOffices =  \common\models\MemcompmplocationdtlsTbl::find()->where('mcmpld_membercompmst_fk=:fk',[':fk'=> $cmpPK])->all();
        }
        
        $response['headquoff'] = [];
        $response['branchoff'] = [];
        $response['represetiveoff'] = [];
        $response['registedoff'] = [];
        if(!empty($allOffices)){
           foreach($allOffices as $index => $value){
                 if($value['mcmpld_locationtype'] == 17){
                    $HreturnData[] = [
                        'value' => $value['memcompmplocationdtls_pk'],
                        'officename' => $value['mcmpld_officename'],
                        'branchid' => (!empty($value['mcmpld_branchid']) ? $value['mcmpld_branchid'] : 'NIL'),
                        'officeaddress' => $value['mcmpld_address']
                    ];

                    
                 }  else if($value['mcmpld_locationtype'] == 2){
                    $BreturnData[] = [
                        'value' => $value['memcompmplocationdtls_pk'],
                        'officename' => $value['mcmpld_officename'],
                        'branchid' => (!empty($value['mcmpld_branchid']) ? $value['mcmpld_branchid'] : 'NIL'),
                        'officeaddress' => $value['mcmpld_address'],

                    ];
                    
                 } else if($value['mcmpld_locationtype'] == 3) {
                    $respoffData[] = [
                        'value' => $value['memcompmplocationdtls_pk'],
                        'officename' => $value['mcmpld_officename'],
                        'branchid' => (!empty($value['mcmpld_branchid']) ? $value['mcmpld_branchid'] : 'NIL'),
                        'officeaddress' => $value['mcmpld_address'],

                    ];
                    
                 } else if($value['mcmpld_locationtype'] == 1){
                    $RreturnData[] = [
                        'value' => $value['memcompmplocationdtls_pk'],
                        'officename' => $value['mcmpld_officename'],
                        'branchid' => (!empty($value['mcmpld_branchid']) ? $value['mcmpld_branchid'] : 'NIL'),
                        'officeaddress' => $value['mcmpld_address'],

                    ];
                 }
           }
        
           $response['headquoff'] = $HreturnData;
           $response['branchoff'] = $BreturnData;
           $response['represetiveoff'] = $respoffData;
           $response['registedoff'] = $RreturnData;
        }
        
        
        $response['msg'] = 'success';
        $response['status'] = 1;   
        return json_encode($response);
    }
   
    public function actionDeletelogo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usedp = \common\models\UsermstTblQuery::deleteuserdp($data['filePk']);
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        if($usedp){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }
    public function actionDeletecmplogo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $accSettingsDtl = \common\components\Accountsettings::changeCompanyOrProfileLogo($data['filePk'], 'A');
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        if($accSettingsDtl){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }
    public function actionGetcertificatedatapag(){
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $response['certificatedata'] = [];
        $response['certificatecnt'] = 0;
        $countcertif =  \common\models\UsrcertifidtlsTbl::find()->where('ucd_usermst_fk =:usrfk',[':usrfk'=>$userPk])->count();
        if(!empty($_REQUEST)){
            $cetresponse = \common\models\UsermstTblQuery::usrcertificatedetwithpag($userPk,$cmpPK,$_REQUEST['size'],$_REQUEST['search']);
            $response['overallcertificatecnt'] = $countcertif;
            $response['certificatedata'] = $cetresponse['res'];             
            if(!empty($_REQUEST['search'])){
                $response['certificatecnt'] = $cetresponse['count'];  
            }else{                 
                 $response['certificatecnt'] = $countcertif;  
            }
        }
        $response['msg'] = 'success';
       $response['status'] = 1;   
       return json_encode($response);
    }


    /*
        Description : Initiliaze  tender data
        Path : api/mcp/mastercompanyprofile/tender-initiliaze-data
        Params :    {
                        postParams:{
                            
                        }
                    }
    */
    public function actionTenderInitiliazeData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $sectionDetails = TendbrdsecmstTbl::getSectionDetails();
        $data['sectionDetails'] = $sectionDetails;
        $message = $this->baseErrorMessage('success');
        $status = 100;
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }



    /*
        Description : Fetch Grade by Section
        Path : api/mcp/mastercompanyprofile/section-grade-data
        Params :    {
                        postParams:{
                            gradePk
                        }
                    }
    */
    public function actionSectionGradeData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->gradePk) && !empty($resParam->gradePk)){
            $gradePk = Security::decrypt($resParam->gradePk);
            $gradePk = Security::sanitizeInput($gradePk,'number');

            if($gradePk > 0){
                $data['gradeDetails'] = TendbrdgrademstTbl::getGradeDetails($gradePk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }
        

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Tender List
        Path : api/mcp/mastercompanyprofile/tender-list
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionTenderList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $tenderParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $tenderParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        //$data['tenderList'] = MemcomptendbrdsecgrddtlsTbl::getTenderList($tenderParams);
        $data['tenderList'] = \common\models\MemcomptendbrdtempTbl::getTenderList($tenderParams);

        $tenderAdditionalData = \app\models\MemcompadditonalinfoTbl::find()
            ->select(['memcompadditonalinfo_pk','mcai_certtype','mcai_yesno','mcai_certnumber'])
            ->where(['mcai_membercompanymst_fk'=>$cmpPK,'mcai_certtype'=>1])
            //->andWhere(['IS NOT', 'mcai_certnumber', null])
            ->asArray()->all();

        if(!empty($tenderAdditionalData)) {
            $data['oman_regnumber'] = $tenderAdditionalData[0]['mcai_certnumber'];
            $data['oman_tender'] = $tenderAdditionalData[0]['mcai_yesno'];
        } else {
            $data['oman_regnumber'] = '';
            $data['oman_tender'] = '';
        }
        


            // if(!empty($tenderAdditionalData)) {
            //     foreach ($tenderAdditionalData as $key => $value) {
            //         if($value['mcai_certnumber']) {
            //             $tmpArray = [
            //                     'tenderPk' => NULL, 
            //                     'gradeFk' => NULL,
            //                     'tenderRegNo' => $value['mcai_certnumber'],
            //                     'expDate' => NULL,
            //                     'sectionName' => NULL,
            //                     'gradeName' => NULL
            //             ];
            //             array_push($data['tenderList'],$tmpArray);
            //         }
            //     }
            // }

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Add update Tender details
        Path : api/mcp/mastercompanyprofile/tender-add-update
        Params :    {
                        postParams:{
                            tenderPk
                            tenderRegNo
                            tenderSection
                            tenderGrade
                            tenderExp
                        }
                    }
    */
    public function actionTenderAddUpdate(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->tenderRegNo) && !empty($resParam->tenderRegNo) && isset($resParam->tenderSection) && !empty($resParam->tenderSection) && isset($resParam->tenderGrade) && !empty($resParam->tenderGrade) && isset($resParam->tenderExp) && !empty($resParam->tenderExp)){

            $tenderPk = Security::decrypt($resParam->tenderPk);
            $tenderPk = Security::sanitizeInput($tenderPk,'number');
            //print_r( $tenderPk);die();
            $save['tenderRegNo'] = Security::sanitizeInput($resParam->tenderRegNo,'string');
            $save['tenderSection'] = Security::sanitizeInput($resParam->tenderSection,'number');
            $save['tenderGrade'] = Security::sanitizeInput($resParam->tenderGrade,'number');
            $save['tenderExp'] = Security::isDateValid($resParam->tenderExp,'Y-m-d');

            if(!empty($save['tenderRegNo']) && $save['tenderSection'] > 0 && $save['tenderGrade'] > 0 && !empty($save['tenderExp'])){
                //$afterSave = MemcomptendbrdsecgrddtlsTbl::addUpdateTender($save, $tenderPk);
                $afterSave = \common\models\MemcomptendbrdtempTbl::addUpdateTender($save, $tenderPk);
                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }elseif($afterSave == 4){
                    $message = $this->baseErrorMessage('smAlreadyAvailable');
                    $status = 104;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }
        

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch Tender Detail
        Path : api/mcp/mastercompanyprofile/tender-detail
        Params :    {
                        postParams:{
                            tenderPk
                        }
                    }
    */
    public function actionTenderDetail(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->tenderPk) && !empty($resParam->tenderPk)){
            $tenderPk = Security::decrypt($resParam->tenderPk);
            $tenderPk = Security::sanitizeInput($tenderPk,'number');

            if($tenderPk > 0){
                $data['tenderList'] = MemcomptendbrdsecgrddtlsTbl::getTenderDetail($tenderPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Delete Tender Detail
        Path : api/mcp/mastercompanyprofile/delete-tender
        Params :    {
                        postParams:{
                            tenderPk
                        }
                    }
    */
    public function actionDeleteTender(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->tenderPk) && !empty($resParam->tenderPk)){
            $tenderPk = Security::decrypt($resParam->tenderPk);
            $tenderPk = Security::sanitizeInput($tenderPk,'number');

            if($tenderPk > 0){
                //$afterDelete = MemcomptendbrdsecgrddtlsTbl::deleteTender($tenderPk);
                $afterDelete = \common\models\MemcomptendbrdtempTbl::deleteTender($tenderPk);
                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }else{
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*Error message creation*/
    function baseErrorMessage($type){
        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'This Section is already available.';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
        }
        return $resMessage;
    }
    public function actionGetprofileperctage(){
        $response = 0;
        $hasCompletedincorpstyle = 0;
        $hasCompletedestablisment = 0;
        $hasCompleteddivision = 0;
        $hasCompletedboard= 0;
        $hasCompletedexternalprof= 0;
        $hasCompletedmanagement = 0;
        $hasCompletedregisterdoffice = 0;
        $maximumPoints  = 100;
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char")); 
        $id= 10;
        // if(!empty($id)){

        //     $cache = new \api\common\services\CacheBGI();
        //     try{
        //         $cacheKey = 'membercompanymst'.$id;
        //         if(empty($cache->retreive($cacheKey))){
        //             $cacheQuery = \common\models\MembercompanymstTblQuery::memCompCacheQuery();
        //             $data = \common\models\MembercompanymstTbl::findOne($id);
        //             $cache->store($cacheKey, $data, $duration = 0 , $cacheQuery);
        //         } else {
        //             $data = $cache->retreive($cacheKey);
        //         }

        //     } catch(\Exception $e){
        //         $data = \common\models\MembercompanymstTbl::findOne($id);
        //     }
            
        //     if(!empty($data)){
        //         try{
        //             $cacheKey = 'divisioncont'.$id;
        //             if(empty($cache->retreive($cacheKey))){
        //                 $cacheQuery = \common\models\MemcompsectordtlsTbl::memcompQueryCache();
        //                 $divisioncont = \common\models\MemcompsectordtlsTbl::find()
        //                 ->where('MCSD_MemberCompMst_Fk = :MCSD_MemberCompMst_Fk', [':MCSD_MemberCompMst_Fk' => $id])->count();
                     
        //                 $cache->store($cacheKey, $divisioncont, $duration = 0 , $cacheQuery);
        //             } else {
        //                 $divisioncont = $cache->retreive($cacheKey);
        //             }
    
        //         } catch(\Exception $e){
        //             $divisioncont = \common\models\MemcompsectordtlsTbl::find()
        //                ->where('MCSD_MemberCompMst_Fk = :MCSD_MemberCompMst_Fk', [':MCSD_MemberCompMst_Fk' => $id])->count();
        //         }
                
        //         $boardcacheQuery = \app\models\MemcompboardmemdtlsTbl::boardmemberCacheQuery();

        //         try{
        //             $cacheKey = 'boardmemebersfilled'.$id;
        //             if(empty($cache->retreive($cacheKey))){
        //                 $boardmemebersfilled =  \app\models\MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 1',
        //                 [':mcbmd_membercompmst_fk' => $id])->count();
        //                 $cache->store($cacheKey, $boardmemebersfilled, $duration = 0 , $boardcacheQuery);
        //             } else {
        //                 $boardmemebersfilled = $cache->retreive($cacheKey);
        //             }
    
        //         } catch(\Exception $e){
        //             $boardmemebersfilled =  \app\models\MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 1',
        //             [':mcbmd_membercompmst_fk' => $id])->count();
        //         }
                
        //         try{
        //             $cacheKey = 'managmentfilled'.$id;
        //             if(empty($cache->retreive($cacheKey))){
        //                 $managmentfilled =  \app\models\MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 2',
        //             [':mcbmd_membercompmst_fk' => $id])->count();
        //                 $cache->store($cacheKey, $managmentfilled, $duration = 0 , $boardcacheQuery);
        //             } else {
        //                 $managmentfilled = $cache->retreive($cacheKey);
        //             }
    
        //         } catch(\Exception $e){
        //             $managmentfilled =  \app\models\MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 2',
        //             [':mcbmd_membercompmst_fk' => $id])->count();
        //         }
              
        //         try{
        //             $cacheKey = 'registeredoffice'.$id;
        //             if(empty($cache->retreive($cacheKey))){
        //                 $cacheQuery = \common\models\MemcompmplocationdtlsTbl::memcomplocationQueryCache();
        //                 $registeredoffice =  \common\models\MemcompmplocationdtlsTbl::find()->where('mcmpld_membercompmst_fk = :mcmpld_membercompmst_fk and mcmpld_locationtype = 1', [':mcmpld_membercompmst_fk' => $id])->count();
        //                 $cache->store($cacheKey, $registeredoffice, $duration = 0 , $cacheQuery);
        //             } else {
        //                 $registeredoffice = $cache->retreive($cacheKey);
        //             }
    
        //         } catch(\Exception $e){
        //             $registeredoffice =  \common\models\MemcompmplocationdtlsTbl::find()->where('mcmpld_membercompmst_fk = :mcmpld_membercompmst_fk and mcmpld_locationtype = 1', [':mcmpld_membercompmst_fk' => $id])->count();
        //         }

              
        //         if(!empty($data->mCMMemberRegMstFk['mrm_incorpstylemst_fk'])){
        //             $hasCompletedincorpstyle =  \Yii::$app->params['MCPpoints']['incorporatestyle'];
        //         }
        //         if(!empty($data['mcm_externalproflink'])){
        //             $hasCompletedexternalprof = \Yii::$app->params['MCPpoints']['externalprof'];
        //         }
        //         if(!empty($data['MCM_RegistrationYear'])){
        //             $hasCompletedestablisment = \Yii::$app->params['MCPpoints']['Establishmentyr'];
        //         }
        //         if($divisioncont > 0){
        //             $hasCompleteddivision =  \Yii::$app->params['MCPpoints']['division'];
        //         }
        //         if($boardmemebersfilled > 0){
        //             $hasCompletedboard =  \Yii::$app->params['MCPpoints']['boardmember'];
        //         }
        //         if($managmentfilled > 0){
        //             $hasCompletedmanagement =  \Yii::$app->params['MCPpoints']['managementmember'];
        //         }
        //         if($registeredoffice > 0){
        //             $hasCompletedregisterdoffice =  \Yii::$app->params['MCPpoints']['registeredoffice'];
        //         }
        //         $response = ($hasCompletedincorpstyle+$hasCompletedestablisment+$hasCompleteddivision+$hasCompletedboard+$hasCompletedmanagement+$hasCompletedexternalprof+$hasCompletedregisterdoffice)*$maximumPoints/100;
        //     }
        // }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }
    public function actionGetstockmarketlistdet(){
        $stocklist = \common\models\StockmarketmstTblQuery::getstockmarketlist();
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $stocklist
        ];
    }
    public function actionGetprofilecommentstemplate(){
        $dtl = \common\components\ApprovalComponents::getmcpComments();
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetchkdontshowstatusmcp() {
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $model = \common\models\UsermstTbl::findOne($userpk);
        
        return $this->asJson([
            'msg' => ($model) ? 'success' : 'failure',
            'status' => $model->um_mcpisdontshowagain,
        ]);
    }
    public function  actionGetmastercompanylandingpagedata(){
        $rawBody = Yii::$app->request->getRawBody();
        $resParam = json_decode($rawBody, true);
        if(isset($resParam['dataVal']) && !empty($resParam['dataVal'])){
            $statusChanged = \common\models\UsermstTbl::MastercompanyprofileDashboard($resParam['dataVal']);
        }
        
        return $this->asJson([
            'msg' => ($statusChanged) ? 'success' : 'failure',
            'status' => ($statusChanged) ? 1 : 0,
        ]);
    }

    public function actionIndustryZoneList(){

        $industryZonedata=IndustrialzonemstTbl::find()->where(['izm_status'=>'A'])->asArray()->all();
        return  $industryZonedata; 

    }

    public function actionIndustryEstateList(){

        $industryEstatedata=IndustrialestatemstTbl::find()->where(['iem_status'=>'A'])->asArray()->all();
        return  $industryEstatedata; 

    }

    public function actionBussLicenseList(){

        $businessLicenseData=BusinesslicensemstTbl::find()->where(['blm_status'=>1])->asArray()->all();
        return $businessLicenseData;
    }

    public function actionOfficeTypeList(){

        $officeTypeListData=OfficetypemstTbl::find()->where(['ofm_status'=>1])->asArray()->all();
        return $officeTypeListData;
    }
  
    public function actionIsicActivityList(){

        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $sectorDtlsQuery = \common\models\MemcompsectordtlsTbl::find()
            ->select(['MemCompSecDtls_Pk','MCSD_MemberCompMst_Fk','MCSD_SectorMst_Fk','mcsd_businessunitrefname','mcsd_bunitdesc','mcsd_referenceno'])
            ->where(['MCSD_MemberCompMst_Fk' =>$compPK])
            ->asArray();


        $provider = new \yii\data\ActiveDataProvider(['query' => $sectorDtlsQuery ]);

        $sectorDtlsData = $provider->getModels();
       
        if(!empty($sectorDtlsData)) {
            $tempStr;
            foreach ($sectorDtlsData as $key => $value) {               
                $tempStr .= $value['MCSD_SectorMst_Fk'];  
                if($key != count($sectorDtlsData) - 1) {
                    $tempStr .= ',';
                }    
            }
            if(isset($tempStr)) {
                $sectorMstKeys = array_keys(array_flip(explode(',',  $tempStr)));
            }
            $finalDataArray = array();
            if(isset($sectorMstKeys)) {
                foreach($sectorMstKeys as $key=>$sectors){
                    $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActM_SectorMst_Fk', $sectors ])
                        ->andWhere(['ActM_Status'=>'A']);
                            
                    $data = $activityListQuery->asArray()->all();
                    if(!empty($data)) {
                        $keyArray = array();                        
                        $divArray = array();
                        foreach ($data as $key => $value) {  
                            $divArray['SecM_SectorName'] = $value['SecM_SectorName'];                  
                            $divArray['SecM_SectorName_ar'] = $value['SecM_SectorName_ar'];                  
                            $tempArray = [
                                'ActivitiesMst_Pk' => $value['ActivitiesMst_Pk'],
                                'ActM_SectorMst_Fk' => $value['ActM_SectorMst_Fk'],
                                'ActM_ActivityName' =>$value['ActM_ActivityName'],
                                'ActM_ActivityName_ar' =>$value['ActM_ActivityName_ar'],
                                'SecM_SectorName_ar' => $value['SecM_SectorName_ar'],
                                'SecM_SectorName' => $value['SecM_SectorName']
                            
                            ];
                            $divArray['data'][] = $tempArray;                          
                        }                        
                    }
                    $finalDataArray[] = $divArray;
                }
            }
        }
        return $finalDataArray;        
    }

    public function actionBranchList(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true); 
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        if(!empty($requestdata['comp_pk'])){
           $compPK =  \common\components\Security::decrypt($requestdata['comp_pk']);
        }
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        //echo '<pre>';print_r($requestdata);exit;
        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select(['mcbdt_scfstatus as scfstatus','memcompbranchdtlstemp_pk as brtemp_pk','mcbdt_branchname as br_name','mcbdt_branchnumber as br_number','mcbdt_indzoneregno as indszone_regno','mcbdt_isicactivitymst_fk as isicactvpks','mcbdt_upload as actvlicensepk','izm_zonename_en','izm_zonename_ar','iem_estatename_en','iem_estatename_ar','mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
            'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename',
            'blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar','businesslicensemst_pk as busslicense_pk','MCM_Origin','mcm_memcompbranchdtlstemp_fk',
            'mcbdt_scfstatus as scfstatus','MemCompProdDtls_Pk as prodmap','MemCompServDtls_Pk as servmap', 'memcompbussrcdtls_pk as bussrcmap'])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
        ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
        ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
        ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = mcbdt_memcompmst_fk')
        ->leftJoin('memcompbussrcdtls_tbl','find_in_set(memcompbranchdtlstemp_pk, mcbsd_memcompbranchdtlstemp_fk)')
        ->leftJoin('memcompproddtls_tbl','find_in_set(memcompbranchdtlstemp_pk, mcprd_memcompbranchdtlstemp_fk)')
        ->leftJoin('memcompservicedtls_tbl','find_in_set(memcompbranchdtlstemp_pk, mcsvd_memcompbranchdtlstemp_fk)')
        
        ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->andWhere(['mcbdt_isdeleted'=>2])
        ->groupBy('memcompbranchdtlstemp_pk')
        ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC]);
        $branchlistData->andFilterWhere(['LIKE', 'mcbdt_branchname', $requestdata['search']]);
        $branchlistData->asArray();
        // $provider=new ActiveDataProvider([ 'query' => $branchlistData]);

        
        $size = Security::sanitizeInput($requestdata['size'], 'number') ? Security::sanitizeInput($requestdata['size'], 'number') : \Yii::$app->params['accordionPerpage'];
        $pages =  Security::sanitizeInput($requestdata['page'], 'number') ? Security::sanitizeInput($requestdata['page'], 'number') : 1;
        // echo $size;
        // echo $pages;exit;
        $pages = $pages - 1;
        $pagesize = ($size) ? $size :10;  
            $page = (!empty($pages)) && ($pages > 0)?$pages:0;
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $branchlistData,
                'pagination' => [
                      'page' => $page,
                      'pageSize' => $pagesize
                ]
            ]);
        foreach($provider->getModels() as $proVal) {
            
            $files = [];
            if($proVal['actvlicensepk'] ) {
                $branch_pk = $proVal['brtemp_pk'];
                foreach(explode(',', $proVal['actvlicensepk']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'branchPk'=>$branch_pk,
                        'filepk'=>$filePk,
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
                $proVal['license_files'] = $files;
            }

            $activities = [];
            if($proVal['isicactvpks']) {
                // foreach(explode(',', $proVal['isicactvpks']) as $Pk) {

                //     $activityObj = IsicactivitymstTbl::findOne($Pk);

                //     $activities[] = [
                //         'desc_en' => $activityObj->iam_desc_en,
                //         'desc_ar' => $activityObj->iam_desc_ar,
                //         'pk' => $activityObj->isicactivitymst_pk,
                //         'activity_code' => $activityObj->iam_activitycode,
                //     ];
                // }
                // $proVal['activities_category'] = $activities;

                $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $proVal['isicactvpks']) ])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->groupBy('ActM_SectorMst_Fk')->asArray();

                $activityProvider = new \yii\data\ActiveDataProvider(['query' => $activityListQuery]);  
                $proVal['activities_category'] = $activityProvider->getModels();
                
            }

            $branchfinal_data[]=$proVal;

        }

        // $branchfinal_data['size']=3;
        // $branchfinal_data['page']=1;
        $branchfinal_data['data'] = $branchfinal_data;
        $branchfinal_data['totalcount'] = $provider->getTotalCount();
        $branchfinal_data['size'] = $pagesize;
        $branchfinal_data['page'] = $page;
        //print_r($filterRes);die();
        //return $filterRes;
        return $branchfinal_data;


    }


    public function actionBranchListBus(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true); 

        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        //echo '<pre>';print_r($requestdata);exit;
        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select(['mcbdt_scfstatus as scfstatus','memcompbranchdtlstemp_pk as brtemp_pk','mcbdt_branchname as br_name','mcbdt_branchnumber as br_number','mcbdt_indzoneregno as indszone_regno','mcbdt_isicactivitymst_fk as isicactvpks','mcbdt_upload as actvlicensepk','izm_zonename_en','izm_zonename_ar','iem_estatename_en','iem_estatename_ar','mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
            'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename',
            'blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar','businesslicensemst_pk as busslicense_pk','MCM_Origin','mcm_memcompbranchdtlstemp_fk'])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
        ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
        ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
        ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = mcbdt_memcompmst_fk')
        
        ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC]);
        $branchlistData->andFilterWhere(['LIKE', 'mcbdt_branchname', $requestdata['search']]);
        $branchlistData->asArray();
        // $provider=new ActiveDataProvider([ 'query' => $branchlistData]);

        
        $size = Security::sanitizeInput($requestdata['size'], 'number') ? Security::sanitizeInput($requestdata['size'], 'number') : \Yii::$app->params['accordionPerpage'];
        $pages =  Security::sanitizeInput($requestdata['page'], 'number') ? Security::sanitizeInput($requestdata['page'], 'number') : 1;
        // echo $size;
        // echo $pages;exit;
        $pages = $pages - 1;
        $pagesize = ($size) ? $size :10;  
            $page = (!empty($pages)) && ($pages > 0)?$pages:0;
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $branchlistData,
                // 'pagination' => [
                //     'page' => $page,
                //     'pageSize' => $pagesize
                // ]
                    
                
            ]);

        foreach($provider->getModels() as $proVal) {
            
            $files = [];
            if($proVal['actvlicensepk'] ) {
                $branch_pk = $proVal['brtemp_pk'];
                foreach(explode(',', $proVal['actvlicensepk']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'branchPk'=>$branch_pk,
                        'filepk'=>$filePk,
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
                $proVal['license_files'] = $files;
            }

            $activities = [];
            if($proVal['isicactvpks']) {
                $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $proVal['isicactvpks']) ])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->groupBy('ActM_SectorMst_Fk')->asArray();

                $activityProvider = new \yii\data\ActiveDataProvider(['query' => $activityListQuery]);  
                $proVal['activities_category'] = $activityProvider->getModels();
                
            }

            $branchfinal_data[]=$proVal;

        }

        
        $branchfinal_data['data'] = $branchfinal_data;
        $branchfinal_data['totalcount'] = $provider->getTotalCount();
        $branchfinal_data['size'] = $pagesize;
        $branchfinal_data['page'] = $page;
        return $branchfinal_data;


    }



    public function actionBranchListforexternal(){

        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);

        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select(['mcbdt_scfstatus as scfstatus','memcompbranchdtlstemp_pk as brtemp_pk','mcbdt_branchname as br_name','mcbdt_branchnumber as br_number','mcbdt_indzoneregno as indszone_regno','mcbdt_isicactivitymst_fk as isicactvpks','mcbdt_upload as actvlicensepk','izm_zonename_en','izm_zonename_ar','iem_estatename_en','iem_estatename_ar','mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
            'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename',
            'blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar','businesslicensemst_pk as busslicense_pk','MCM_Origin'])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
        ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
        ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
        ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = mcbdt_memcompmst_fk')
        
        ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->andWhere(['mcbdt_isdeleted'=>2])
        ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC])->asArray();
        $provider=new ActiveDataProvider([ 'query' => $branchlistData]);

        foreach($provider->getModels() as $proVal) {
            
            $files = [];
            if($proVal['actvlicensepk'] ) {
                foreach(explode(',', $proVal['actvlicensepk']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'filepk'=>$filePk,
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
                $proVal['license_files'] = $files;
            }

            $activities = [];
            if($proVal['isicactvpks']) {

                $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $proVal['isicactvpks']) ])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->groupBy('ActM_SectorMst_Fk')->asArray()->all();  

                foreach($activityListQuery as $key=>$activity) {
                    $listactivity = \api\modules\mst\models\ActivitiesmstTbl::find() 
                        ->select(['ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $proVal['isicactvpks'])])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->andWhere(['ActM_SectorMst_Fk'=>$activity['ActM_SectorMst_Fk']])
                        ->asArray()->all();
                        $acti_en = $acti_ar = '';
                        if(!empty($listactivity)){
                            $count_acti = count($listactivity) - 1;
                            foreach($listactivity as $list){
                                $acti_en .=$list['ActM_ActivityName'].', ';
                                $acti_ar .=$list['ActM_ActivityName_ar'].', ';
                            }
                            $acti_en = rtrim($acti_en, ', ');
                            $acti_ar = rtrim($acti_ar, ', ');
                        } 
                        $isicactivity[$key]['ActivitiesMst_Pk'] = $activity['ActivitiesMst_Pk'];
                        $isicactivity[$key]['ActM_SectorMst_Fk'] = $activity['ActM_SectorMst_Fk'];
                        $isicactivity[$key]['ActM_ActivityCode'] = $activity['ActM_ActivityCode'];
                        $isicactivity[$key]['ActM_ActivityCode_ar'] = $activity['ActM_ActivityCode_ar'];
                        $isicactivity[$key]['ActM_ActivityName'] = $activity['ActM_ActivityName'];
                        $isicactivity[$key]['ActM_ActivityName_ar'] = $activity['ActM_ActivityName_ar'];
                        $isicactivity[$key]['SecM_SectorName'] = $activity['SecM_SectorName'];
                        $isicactivity[$key]['SecM_SectorName_ar'] = $activity['SecM_SectorName_ar'];
                        $isicactivity[$key]['SecM_SectorCode'] = $activity['SecM_SectorCode'];
                        $isicactivity[$key]['activitydata_count'] = $count_acti;
                        $isicactivity[$key]['activitydata_en'] = $acti_en;
                        $isicactivity[$key]['activitydata_ar'] = $acti_ar;
                        $isicactivity[$key]['boolean'] = true;
                }
                $proVal['activities_category'] = $isicactivity;
            }
            $branchfinal_data[]=$proVal;

        }
        return $branchfinal_data;
    }
    public function actionDeletebranchlicense(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data1 = '';
        if(isset($resParam->brPk) && !empty($resParam->brPk) && !empty($resParam->filePk)){
            $brPk = Security::decrypt($resParam->brPk);
            $brPk = Security::sanitizeInput($brPk,'number');
            $filePk = Security::decrypt($resParam->filePk);
            $filePk = Security::sanitizeInput($filePk,'number');
           if($brPk > 0 && $filePk > 0){
                $branchinfo = MemcompbranchdtlstempTbl::findOne($brPk);
                if(!empty($branchinfo)){
                    $license_uploads = explode(',', $branchinfo->mcbdt_upload);
                    if (($key = array_search($filePk, $license_uploads)) !== false) {
                        unset($license_uploads[$key]);
                    }
                    $branchinfo->mcbdt_upload = implode(',',$license_uploads);
                    $branchinfo->save();
                    if($branchinfo->mcbdt_upload) {
                        foreach(explode(',', $branchinfo->mcbdt_upload) as $filePk) {
                            $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                            $files[] = [
                                'filepk'=>$filePk,
                                'name' => $fileObj->mcfd_origfilename,
                                'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                                'size' => $fileObj->mcfd_actualfilesize,
                                'type' => $fileObj->mcfd_filetype
                            ];
                        }
                        $data = $files;
                        $data1 = $branchinfo->mcbdt_upload;
                    }
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }else{
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'filepks' => $data1,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionBranchListSelected(){

        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);

        $br_id = Security::decrypt($_GET['brpk']);
        
        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select(['mcbdt_scfstatus as scfstatus','memcompbranchdtlstemp_pk as brtemp_pk','mcbdt_branchname as br_name','mcbdt_branchnumber as br_number','mcbdt_indzoneregno as indszone_regno','mcbdt_isicactivitymst_fk as isicactvpks','mcbdt_upload as actvlicensepk','izm_zonename_en','izm_zonename_ar','iem_estatename_en','iem_estatename_ar','mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
            'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity',
            'otm_officename_en as officetypename','blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar','businesslicensemst_pk as busslicense_pk'])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
        ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
        ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
        ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        
        ->where(['memcompbranchdtlstemp_pk'=>$br_id])
        ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC])->asArray()->one();
       
            $files = [];
            if($branchlistData['actvlicensepk'] ) {
                foreach(explode(',', $branchlistData['actvlicensepk']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
                $branchlistData['license_files'] = $files;
            }

            $activities = [];
            if($branchlistData['isicactvpks']) {
               
                $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $branchlistData['isicactvpks']) ])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->groupBy('ActM_SectorMst_Fk')->asArray();

                $activityProvider = new \yii\data\ActiveDataProvider(['query' => $activityListQuery]);  
                $branchlistData['activities_category'] = $activityProvider->getModels();
                
            }

            // $branchfinal_data[]=$branchlistData;

        

        return $branchlistData;


    }


    public function actionProdBsourceBranchfactory(){

        $selected_bspks=$_GET['selbs_pkarr'];

        $branch_idss=[];
        // $fact_arr=[];
        $selectedbranchfinal_data=[];

        $bussourceModel = MemcompbussrcdtlsTbl::find()->select(['*'])
        ->where(['in','memcompbussrcdtls_pk',explode(',',$selected_bspks)])
        ->andWhere(['!=','mcbsd_isdeleted', 1])
        ->asArray()
        ->all();

        $finalData=[];

        if(!empty($bussourceModel)){

            foreach($bussourceModel as $bsdata){

                if($bsdata['mcbsd_memcompbranchdtlstemp_fk']!='' && $bsdata['mcbsd_memcompbranchdtlstemp_fk']!=null){
                    $banch_idexp=explode(',',$bsdata['mcbsd_memcompbranchdtlstemp_fk']);
                    foreach($banch_idexp as $brpk){
                        if(!in_array($brpk,$branch_idss)){
                            $branch_idss[]=$brpk;
                        }
                    }

            }
            }

            $fctinfo=MemcompfctydtlsTbl::find()
                    ->select(['mcfd_facname','mcfd_facid','factm_factytypename','mcmpld_address','memcompfctydtls_pk','mcfd_memcompbussrcdtls_fk'])
                    ->leftJoin(FactorytypemstTbl::tableName(),'mcfd_factorytypemst_fk=factorytypemst_pk')
                    ->leftJoin(MemcompmplocationdtlsTbl::tableName(),'mcfd_memcompmplocationdtls_fk=memcompmplocationdtls_pk')
                    ->leftJoin('memcompbussrcdtls_tbl','memcompbussrcdtls_pk=mcfd_memcompbussrcdtls_fk')
                    ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk=mcbsd_businesssourcemst_fk')
                    ->where(['in','mcfd_memcompbussrcdtls_fk',explode(',',$selected_bspks)])
                    ->andwhere(['businesssourcemst_pk'=>1])
                    ->asArray()->all();

            
            if(!empty($fctinfo)){

                foreach($fctinfo as $factval){
                    $fact_arr[]=$factval;
                }
                
            }
            
            if(!empty($branch_idss)){
                $selectedbranchlistData=MemcompbranchdtlstempTbl::find()->select([
                    'mcbdt_scfstatus as scfstatus',
                    'memcompbranchdtlstemp_pk as brtemp_pk',
                    'mcbdt_branchname as br_name',
                    'mcbdt_branchnumber as br_number',
                    "COALESCE(mcbdt_indzoneregno, 'N/A') as indszone_regno",
                    'mcbdt_isicactivitymst_fk as isicactvpks',
                    'mcbdt_upload as actvlicensepk',
                    "COALESCE(izm_zonename_en,'N/A') as izm_zonename_en",
                    "COALESCE(izm_zonename_ar,'N/A') as izm_zonename_ar",
                    "COALESCE(iem_estatename_en,'N/A') as iem_estatename_en",
                    "COALESCE(iem_estatename_ar,'N/A') as iem_estatename_ar",
                    'mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
                    'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename'
                    
                    ])
                ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
                ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
                ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
                ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
                ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
                ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
                ->where(['in','memcompbranchdtlstemp_pk',$branch_idss])
                ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC])->asArray();
                $selectBranch=new ActiveDataProvider([ 'query' => $selectedbranchlistData]);
        
        
                $br_isicact_idss = [];
                $sectidss=[];
                $finactdata=[];
                $activitieslist=[];
                foreach($selectBranch->getModels() as $brval) {
        
                    if($brval['isicactvpks']!='' && $brval['isicactvpks']!=null){
                        $brval['isicact_cnt']=count(explode(',',$brval['isicactvpks']));
                    }else{
                        $brval['isicact_cnt']=0;
                    }
    
                    $activitieslist= \api\modules\mst\models\ActivitiesmstTbl::find()
                    ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                    ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                    ->where(['in','ActivitiesMst_Pk', explode(',',$brval['isicactvpks']) ])
                    ->andWhere(['ActM_Status'=>'A'])
                    ->asArray()->all();
    
                    foreach ($activitieslist as $key => $value) {
                        $actarr = [];
                        foreach ($activitieslist as $key => $actval) {
            
                            
                            if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                                $actarr[] = $actval;
                            }
                        }
                        if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                            $isic_activitiesdata[] = ['SecM_SectorName' => $value['SecM_SectorName'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr];
                            $sectidss[] = $value['ActM_SectorMst_Fk'];
                        }
                    }
    
                    $files = [];
                    if($brval['actvlicensepk'] ) {
                        foreach(explode(',', $brval['actvlicensepk']) as $filePk) {
                            $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                            $files[] = [
                                'name' => $fileObj->mcfd_origfilename,
                                'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                                'size' => $fileObj->mcfd_actualfilesize,
                                'type' => $fileObj->mcfd_filetype
                            ];
                        }
                        // $brval['license_files'] = $files;
                    }
    
                    $brval['license_files'] = $files;
                    $brval['tot_isicCnt']=count($activitieslist);
                    $brval['isicactivities']=$isic_activitiesdata;
                    
    
        
                    $selectedbranchfinal_data[]=$brval;
       
                }
            }
            
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'bsbranch'=>$selectedbranchfinal_data,
            'factory'=>$fact_arr
        );

        return $result;


    }

    public function actionSerBsourceBranchfactory(){

        $selected_bspks=$_GET['selbs_pkarr'];
        
        $branch_idss=[];
        // $fact_arr=[];
        $selectedbranchfinal_data=[];
        $bussourceModel = MemcompbussrcdtlsTbl::find()->select(['*'])
        ->where(['in','memcompbussrcdtls_pk',explode(',',$selected_bspks)])
        ->andWhere(['!=','mcbsd_isdeleted', 1])
        ->asArray()
        ->all();
        //echo '<pre>';print_r($bussourceModel);exit;
        $finalData=[];
        if(!empty($bussourceModel)){
            foreach($bussourceModel as $bsdata){
                if($bsdata['mcbsd_memcompbranchdtlstemp_fk']!='' && $bsdata['mcbsd_memcompbranchdtlstemp_fk']!=null){
                    $banch_idexp=explode(',',$bsdata['mcbsd_memcompbranchdtlstemp_fk']);
                    foreach($banch_idexp as $brpk){
                        if(!in_array($brpk,$branch_idss)){
                            $branch_idss[]=$brpk;
                        }
                    }
            }
            }
            
            $fctinfo=MemcompfctydtlsTbl::find()
                    ->select(['mcfd_facname','mcfd_facid','factm_factytypename','mcmpld_address','memcompfctydtls_pk','mcfd_memcompbussrcdtls_fk'])
                    ->leftJoin(FactorytypemstTbl::tableName(),'mcfd_factorytypemst_fk=factorytypemst_pk')
                    ->leftJoin(MemcompmplocationdtlsTbl::tableName(),'mcfd_memcompmplocationdtls_fk=memcompmplocationdtls_pk')
                    ->leftJoin('memcompbussrcdtls_tbl','memcompbussrcdtls_pk=mcfd_memcompbussrcdtls_fk')
                    ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk=mcbsd_businesssourcemst_fk')
                    ->where(['in','mcfd_memcompbussrcdtls_fk',explode(',',$selected_bspks)])
                    ->andwhere(['businesssourcemst_pk'=>1])
                    ->asArray()->all();

            if(!empty($fctinfo)){

                foreach($fctinfo as $factval){
                    $fact_arr[]=$factval;
                }
            }
            
            if(!empty($branch_idss)){
                $selectedbranchlistData=MemcompbranchdtlstempTbl::find()->select([
                    'mcbdt_scfstatus as scfstatus',
                    'memcompbranchdtlstemp_pk as brtemp_pk',
                    'mcbdt_branchname as br_name',
                    'mcbdt_branchnumber as br_number',
                    "COALESCE(mcbdt_indzoneregno, 'N/A') as indszone_regno",
                    'mcbdt_isicactivitymst_fk as isicactvpks',
                    'mcbdt_upload as actvlicensepk',
                    "COALESCE(izm_zonename_en,'N/A') as izm_zonename_en",
                    "COALESCE(izm_zonename_ar,'N/A') as izm_zonename_ar",
                    "COALESCE(iem_estatename_en,'N/A') as iem_estatename_en",
                    "COALESCE(iem_estatename_ar,'N/A') as iem_estatename_ar",
                    'mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
                    'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename'
                    
                    ])
                ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
                ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
                ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
                ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
                ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
                ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
                ->where(['in','memcompbranchdtlstemp_pk',$branch_idss])
                ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC])->asArray();
                $selectBranch=new ActiveDataProvider([ 'query' => $selectedbranchlistData]);
        
                $br_isicact_idss = [];
                $sectidss=[];
                $finactdata=[];
                $activitieslist=[];
                foreach($selectBranch->getModels() as $brval) {
                    if($brval['isicactvpks']!='' && $brval['isicactvpks']!=null){
                        $brval['isicact_cnt']=count(explode(',',$brval['isicactvpks']));
                    }else{
                        $brval['isicact_cnt']=0;
                    }
    
                    $activitieslist= \api\modules\mst\models\ActivitiesmstTbl::find()
                    ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                    ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                    ->where(['in','ActivitiesMst_Pk', explode(',',$brval['isicactvpks']) ])
                    ->andWhere(['ActM_Status'=>'A'])
                    ->asArray()->all();
    
                    foreach ($activitieslist as $key => $value) {
                        $actarr = [];
                        foreach ($activitieslist as $key => $actval) {
                            if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                                $actarr[] = $actval;
                            }
                        }
                        if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                            $isic_activitiesdata[] = ['SecM_SectorName' => $value['SecM_SectorName'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr];
                            $sectidss[] = $value['ActM_SectorMst_Fk'];
                        }
                    }
    
                    $files = [];
                    if($brval['actvlicensepk'] ) {
                        foreach(explode(',', $brval['actvlicensepk']) as $filePk) {
                            $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                            $files[] = [
                                'name' => $fileObj->mcfd_origfilename,
                                'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                                'size' => $fileObj->mcfd_actualfilesize,
                                'type' => $fileObj->mcfd_filetype
                            ];
                        }
                        // $brval['license_files'] = $files;
                    }
    
                    $brval['license_files'] = $files;
                    $brval['tot_isicCnt']=count($activitieslist);
                    $brval['isicactivities']=$isic_activitiesdata;
                    $selectedbranchfinal_data[]=$brval;
                }
            } 
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'bsbranch'=>$selectedbranchfinal_data,
            //'factory'=>$fact_arr
        );
        return $result;
    }
    
    public function actionGetbranchvalidationdtls(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compk = \common\components\Security::decrypt($data['comp_pk']);
        $branchdtlspk = \common\components\Security::decrypt($data['branchdtlspk']);
        $formid = ($data['formid']);
        $data = \api\modules\mst\models\MemcompbranchapprovaldtlsTblQuery::getbranchdtls($compk,$branchdtlspk,$formid,$userpk);
        return $data;
    }
}