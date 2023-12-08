<?php

namespace api\modules\lgn\controllers;

use app\filters\auth\HttpBearerAuth;
use common\models\UsermstTbl;
use Yii;


use yii\filters\auth\QueryParamAuth;
use yii\helpers\Json;
use yii\rbac\Permission;
use \common\components\Configuration;
use yii\web\HttpException;
use sizeg\jwt\Jwt;
use yii\rest\Controller;
use \common\models\UsermstTblQuery;
use common\components\Drive;
use common\components\Common;
use \common\components\Security;


class LoginController extends Controller
{
    public $modelClass = '\common\models\DepartmentmstTbl';

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
        /**/
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                // 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Access-Control-Request-Headers' => ['*'],
                // 'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Allow' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Access-Control-Allow-Credentials' => null,
                // 'Access-Control-Max-Age' => 86400,
                // 'Access-Control-Expose-Headers' => []
            ],
        ];

        return $behaviors;
    }

    /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionLogin()
    {
        $request_body = file_get_contents('php://input');
        // print_r($_REQUEST);exit;
        $data = json_decode($request_body, true);
        $data = $data['AdminLoginForm'];
          $token = $attemptCount = '';
          if(in_array($_REQUEST['apiFor'],['and','ios']) && ($_REQUEST['password']!='') ){
         $password =  base64_decode(htmlspecialchars_decode($_REQUEST['password']));
         $data['username']= $_REQUEST['username'];
         $data['userpk']= $_REQUEST['userpk'];
        
         $data['apiFor'] = trim($_REQUEST['apiFor']);
           }
        else{  
           $password = \common\components\Security::aesdecrypt($data['password']);

          }
          
//        if(\common\components\Common::checRecaptchaV3($data['reCaptchaToken'],$data['action'])){
            $model = \common\models\UsermstTblQuery::login($data, $password);
            
            if($password != \common\components\Security::aesdecrypt(trim($model['UM_Password'])))
            { 
                $msg = 'Incorrect Password';
            }
              
            if($model['flag'] == 'S') {
                
                $userEnkey = \common\components\Security::aesencrypt($model['userEny']);
                
                unset($model['userEny']);
                $JSRS_v2_baseURL = Yii::$app->params['JSRS_v2_baseURL'];
                $j2link['j2UserEncryptLink'] = $JSRS_v2_baseURL.'index.php?r=webservice/validateJ2&key='.$userEnkey;

                    //self::isLoggedInWithNewIPorDevice($model);
                self::isLogInWithNewIPorDevice($model);
                

            if ($data['countrycode'] && $model['MCM_Source_CountryMst_Fk'] != $data['countrycode']) {
                $logindata = ['time' => date("h:i:sa"), 'date' => date("d-m-Y"), 'countrycode' => $data['countrycode']];
                $location = Security::encrypt(json_encode($logindata));
                self::sendDiffCountryMail($model['UserMst_Pk'], $location);
                if($model['UM_Type'] != 'A')
                self::sendDiffCountryLoginMailToAdmin($model['UserMst_Pk'], $location);
            }


                
                $data = Configuration::getjson('Setting');
                $data = json_decode($data, true);
                
                $cdata = Configuration::getjson('Company');
                $cdata = json_decode($cdata, true);
                $prjData['projectname'] = Yii::$app->params['thisProjectName'];
               //print_r(count($model));exit;
                if (count($model) > 0) {
                    $tokenValues = array_merge($model, $data, $cdata, $prjData,$j2link);
                    $msg = "Logged In Successfully";
                    $status = 1;
                    $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
                    /** @var Jwt $jwt */
                    $jwt = Yii::$app->jwt;
                    $token = $jwt->getBuilder()
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
                } 
                
                if($model['isPaymentEnabled'] && empty($model['paymentInfo'])){
                    $model['flag'] = 'AL'; // After Login 
                } else if($model['isPaymentEnabled'] && $model['paymentInfo']->mcpd_pymtstatus == 2 &&  $model['paymentInfo']->mcpd_pymtapprovalstatus == 2){
                    $model['flag'] = 'S';
                } else if($model['isPaymentEnabled'] && $model['paymentInfo']->mcpd_pymtstatus == 2 &&  $model['paymentInfo']->mcpd_pymtapprovalstatus == 1) {
                    $model['flag'] = 'AL'; //Validation Pending redirect to After Login thank you page
                } else if($model['isPaymentEnabled'] && $model['paymentInfo']->mcpd_pymtstatus == 2 &&  $model['paymentInfo']->mcpd_pymtapprovalstatus == 3) {
                    $model['flag'] = 'AL'; //Declined - AfterLogin
                } else {
                    if($model['reg_type'] == '8'){
                        $model['flag'] = 'GCS'; 
                    }else{                        
                        $model['flag'] = 'S'; 
                    }
                }


            }else if($model['flag'] == 'PO') {
                $usermodel = UsermstTbl::findOne($model['userpk']);
                $usermodel = UsermstTbl::genereateSetPasswordLink($usermodel);
                $date = $usermodel->um_pwdchangedon;
                $status = 90;
                 
           }else if($model['flag'] == 'AO' || $model['flag'] == 'SL'){
                $msg = 'Attempts limit reached. Try again later';
             }  
           else if($model['flag'] == 'NR'){
                $msg = 'Email not registered with us';
            }else if($model['flag'] == 'SP' && in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'Your JSRS account has been deactivated by your company admin. Kindly contact your company admin to proceed further.';
            }else if($model['flag'] == 'IVC' && in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'Invalid Credential.';
            }else if($model['flag'] == 'SP'){
                $msg = 'Set password and try login';
             }else if($model['flag'] == 'SD'){
                $msg = 'Supplier Deactivated';
            }else if($model['flag'] == 'CU'){ 
                $msg = 'Change user is in progress, kindly authorize using the link sent via mail';
            }
            //Mobile Service//
            if(in_array($_REQUEST['apiFor'] ,['and','ios']) && $password != \common\components\Security::aesdecrypt(trim($model['UM_Password'])) ){
             if($model['um_loginattempt']==(Yii::$app->params['loginattemptcount']-3) && in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'You have '.(Yii::$app->params['loginattemptcount']-3).' out of '.Yii::$app->params['loginattemptcount'].' login attempts left, after which you will be locked out of the portal. You can try to login after 1 day';
            }else if($model['um_loginattempt']==(Yii::$app->params['loginattemptcount']-2) && in_array($_REQUEST['apiFor'] ,['and','ios']))
            {
                $msg ='You have '.(Yii::$app->params['loginattemptcount']-2).' out of '.Yii::$app->params['loginattemptcount'].' login attempts left, after which you will be locked out of the portal. You can try to login after 1 day';
                
            } else if($model['flag'] == 'AO' && $model['um_loginattempt']>=(Yii::$app->params['loginattemptcount']-2)&& in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'You have been locked out of JSRS since you have used all your attempts to log in. Please try again later';
              }  
            }
            //Mobile Dashboard Data starts here//
            $baseUrl = \Yii::$app->params['APP_URL'];
            $cmpPk = $model['comp_pk'];
            $userPk = $model['user_pk'];
            $dash_banner_img  = stripslashes($baseUrl."frontend/web/assets/mobile-ban-image.png");
            $readmore_link = $baseUrl;
            $flag = stripslashes($baseUrl."app/assets/images/flags/".$model['company_country'].".png") ;
            if($model['MRM_ValSubStatus']=='A')  
            {
            $jsrs = 'JSRS Supplier code:';
            $code = $model['suppliercode'];
            }
            else 
            {
            $jsrs = 'JSRS Registration No:';
            $code = $model['mcm_RegistrationNo'];
            }
        
         //SCF Verified or not
         if(in_array($_REQUEST['apiFor'] ,['and','ios']) && !empty($userPk) && !empty($cmpPk))
         {
         $scfchk = Yii::$app->db->createCommand("SELECT * FROM `suppcertformmembtmp_tbl` as SCF 
         LEFT JOIN `membercompanymst_tbl` as MCM ON SCF.`scfmt_membercompmst_fk` =MCM.MemberCompMst_Pk  WHERE SCF.`scfmt_membercompmst_fk`=$cmpPk AND SCF.`scfmt_submittedby`= $userPk AND SCF.`scfmt_scfstatus`='I' ")->queryAll();  

          $dserdp = stripslashes(Drive::generateUrl($model['user_logo'],$cmpPk,$userPk)); 
         }
         //AND MCM.MCM_Origin = 'N'
         if(empty($scfchk))
         {
         $dbdata["svdisable"] = TRUE;
         $dbdata["svmessage"] = 'SVF not verified';
         }else{
        $dbdata["svdisable"] = FALSE;
        $dbdata["svmessage"] = 'SVF Verified';
         }
          if(!empty($model) && in_array($_REQUEST['apiFor'] ,['and','ios']))
             {   
                $dbdata['dash_ban_img'] = $dash_banner_img;
                $dbdata['read_link'] = $readmore_link;
                $dbdata['user_name'] = $model['user_name'];
                $dbdata['designation'] = $model['designation'];
                $dbdata['company_name'] = $model['company_name'];
                $dbdata['company_country'] = $flag;
                $dbdata['jsrs_code'] = $jsrs.$code;
                $dbdata['expiry_date'] = $model['mcm_accexpirydate'];
                $dbdata['profile_pic'] = preg_replace('/\\\\/', '', $dserdp);
                $dbdata['useremail'] =$model['UM_EmailID'];
             }
             //End Mobile Dashboard Data starts here//
            //End Mobile Service//
            
            $model['otpid'] =($model['otpfor']==1)? Common::maskemail($model['UM_EmailID']) : Common::maskmobilenum($model['um_primobno']) ;
            if(!empty($model['um_2freminder'])&& $model['um_2freminder'] === date('Y-m-d'))
            {
               $ifremind = 1;
            }
            else
            {
               $ifremind = 0; 
            }
            
            
    return $this->asJson([
                'msg' => $msg ?? "failure",
                'status' => $status ?? 0,
                'regstatus' => $model['reg_status'],
                'expiry' => $model['expiry'],
                'flag' => $model['flag'],
                'showRenewalPopup' => $model['showRenewalPopup'],
                'expdays' => $model['expdays'],
                'sub_period_end' => $model['sub_period_end'],
                'deactivation_period' => $model['deactivation_period'],
                'beforeexpdays' => $model['beforeexpdays'],
                'graceperiod' => $model['graceperiod'],
                'graceperiodend' => $model['graceperiodend'],
                'inactivationperiod' => $model['inactivationperiod'],
                'nearingexpiry' => $model['nearingexpiry'],
                'MRM_RenewalStatus' => $model['MRM_RenewalStatus'],
                'regType' => $model['reg_type'],
                'pk' => Security::encrypt($model['userpk']) ?? '',
                'enuserpk'=> Security::encrypt($model['UserMst_Pk']) ?? '',
                't' => explode('&t=',$usermodel->um_pwdresetlink)[1] ?? '',
                'expdatemb' =>  $date,
                'f'=> '',
                'loginattempt'=> $model['um_loginattempt'],
                'attemptCount'=> $model['um_fgtpasswordattempt'], 
                'token' => (string)$token,
                'refreshToken' => (string)$refreshToken,
               'j2link'=>$j2link,
               'dashbrd_data'=>$dbdata,
               'isotpenable'=>$model['um_2fkey'],
               'otpfor'=>$model['otpfor'],
               'otpid'=>$model['otpid'],
               'otpverified'=>$model['otpforverified'],
               'otp'=>$model['otp'],
               'otpexpiry'=>$model['otpexpiry'],
               'remider'=>$ifremind,
            ]);
//        }else{
//            return [ 'title' => 'Warning!', 'msg' => 'There was a problem with your login. Please try again.', 'status' => 0, 'flag' => 'C' ];
//        }
        
    }


    /**
     * Return list of available permissions for the staff.  The function will be called when staff form is loaded in backend.
     *
     * Request: GET /v1/staff/get-permissions
     *
     * Sample Response:
     * {
     *        "success": true,
     *        "status": 200,
     *        "data": {
     *            "manageSettings": {
     *                "name": "manageSettings",
     *                "description": "Manage settings",
     *                "checked": false
     *            },
     *            "manageStaffs": {
     *                "name": "manageStaffs",
     *                "description": "Manage staffs",
     *                "checked": false
     *            }
     *        }
     *    }
     */
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

    public function actionList()
    {

        return "osdfsdf fdfk";
    }
    
    public function actionGetusers()
    {   
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $data = $requestdata['formdata'];
        $loginid = $data['username'];
        $type = $data['type'];
        $model = UsermstTbl::getuserlistbyloginid($loginid,$type);
        if(!$model)
        {
            $msg = 'this login id or email id is not registered with our system';
            $data = null;
            $flag = "NR";
        }
        else
        { 
            if(count($model)>1)
            {
                $i = 0;
                $msg = null;
                foreach ($model as $record)
                  {
                        $model[$i]['maskedemail'] = Common::maskemail($record['email']);
                        $model[$i]['maskedmobile_no'] = Common::maskmobilenum($record['mobile_no']);
                        $i++;
                  }
        
                $data = $model;
                $flag = "MR";
            }
            else
            { 
                if(!$model[0]['password'])
                {
                   $usermodel = UsermstTbl::findOne($model[0]['userpk']);
                   $usermodel = UsermstTbl::genereateSetPasswordLink($usermodel);
                   $data['t'] = explode('&t=',$usermodel->um_pwdresetlink)[1];
                   $data['en'] = true;
                   $data['f'] = '';
                   $data['maskedemail'] = Common::maskemail($model[0]['email']);
                   $data['email'] = $model[0]['email'];
                   $data['pk'] = $model[0]['userpk'];
                   $msg = "Set Password";
                   $flag = "SP";
                }
                else
                {
                $msg = null;
                $data = $model[0];
                $data['mobileorigin'] = ($model[0]['um_primobnocc']==31) ? 'N':'I';
                $data['maskedemail'] = Common::maskemail($model[0]['email']);
                $data['maskedmobile_no'] = Common::maskmobilenum($model[0]['mobile_no']);
                $flag = "SR";
                }
                
            }
            
        }
   
        
        return $this->asJson([ 
             'msg'=>$msg,
             'data'=>$data,
             'flag'=>$flag
                 ]);
    }

    public function actionForgotpassword()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
         
        $email = $data['forgotmail']['email'];
        if (empty($email)) {
            return [
                "msg" => "Provide Email ID",
                "status" => 0
            ];
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                "msg" => "Invalid Email ID",
                "status" => 0
            ];
        }
        if (!empty($email)) {
            $userDtls = UsermstTblQuery::getUserByEmail($email);
            //print_r($userDtls);die;
            if (!isset($userDtls['flag'])) {
                return [
                    "msg" => "success",
                    "status" => 1,
                    "userlist" => $userDtls
                ];
            } else {
                return [
                    "msg" => "success",
                    "status" => $userDtls['msg'],
                    'flag' => $userDtls['flag'],
                ];
            }


        }
    }

//    public function actionSendforgotpwdmail()
//    {
//        $request_body = file_get_contents('php://input');
//        $data = json_decode($request_body, true);
//
//        $email = $data['forgotmail']['email'];
//        $userPk = $data['forgotmail']['userid'];
//        if (!empty($email) && !empty($userPk)) {
//            $sendMail = \common\components\User::confirmEmail($email, $userPk);
//
//            return json_encode($sendMail);
//        }
//    }

//    public function actionResetpassword()
//    {
//
//        $request_body = file_get_contents('php://input');
//        $data = json_decode($request_body, true);
//        $password = $data['setpassword']['password'];
//        $confirmpassword = $data['setpassword']['confirmpassword'];
//        $userPk = $data['setpassword']['userpk'];
//        $tokendecrypt = $data['setpassword']['token'];
//        $encodeoutputdecrypt = \common\components\Common::decrypt($tokendecrypt);
//        $primarypkdecrypt = \common\components\Common::decrypt($userPk);
//        if (!empty($primarypkdecrypt) && !empty($password) && $password == $confirmpassword) {
//            $resetPassword = UsermstTblQuery::confirmAndSavePassword($primarypkdecrypt, $password);
//            return json_encode([
//                "msg" => !empty($resetPassword) ? $resetPassword : "Password Successfully Changed",
//                "status" => !empty($resetPassword) ? 1 : 0
//            ]);
//        } else {
//            return json_encode([
//                "msg" => "Provide Password",
//                "status" => 0
//            ]);
//        }
//    }

    public function actionMailtest()
    {
        $campaign = new \app\modules\mailer\components\Campaign;
        $res = $campaign->mailtest();
    }

    public function actionGetuserdata()
    {

        if (isset($_GET['token']) && is_string($_GET['token'])) {
            $decryptuserpk = \common\components\Common::decrypt($_GET['token']);
          $usermodel = UsermstTbl::find()
                ->select(['UserMst_Pk', 'UM_EmailID'])
                ->where(['UserMst_Pk' => $decryptuserpk])
                ->andWhere(['not', ['UM_fgtpwdkey' => null]])
                ->asArray()->one();
            if ($usermodel) {
                $data = $usermodel;
            } else {
                $data = [];
            }
            return json_encode($data);
        }
    }
    
    public function actionGetusersbyemail(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
          if (isset($_REQUEST['email'])){ 
            $type = $_REQUEST['type'];
            $pk = $_REQUEST['pk'];
             $dtl = UsermstTbl::getUserDtlbyEmailandPk($email,$pk,$type);   
         
         }
        else
        {  
            $email = $data['email'];
            $type = $data['type'];
            $pk = $data['pk'];
          
            $dtl = UsermstTbl::getUserDtlbyEmailandPk($email,$pk,$type);   
        }
        if(!empty($dtl))
        {
            if(count($dtl) <= 1)
            {
                $model = UsermstTbl::findOne( $dtl[0]['UserMst_Pk']);
                $model->um_fgtpasswordattempt = null;
                $model->um_fgtpasswordattempton = date('Y-m-d H:i:s');
                $model->um_pwdresetlink = null;
                if($model->save())
                {
                   $msg['msg'] = "SR";
                $msg['email'] = $dtl[0]['email'];
                $msg['origin'] = $dtl[0]['origin'];
                $msg['status'] = 1; 
                $msg['id'] = $dtl[0]['UserMst_Pk']; 
                }
                else
                {
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                }
                       
                
            }
            else
            {
                $msg['msg'] = "MR";
                $msg['status'] = 1; 
                foreach ($dtl as $detail)
                {
                    $msg['userlist'][]=$detail;
                }
            }
            
        }
        else if(empty($dtl) && ($_REQUEST['apiFor'] == "and" || $_REQUEST['apiFor'] == "ios")){
            $msg['msg'] = 'This email id/username/mobile is not registered with us.';
            $msg['status'] = 0; 
          }
        else{
            $msg['msg'] = 'Incorrect Email ID';
            $msg['status'] = 0;
            }
           
             return $this->asJson($msg);
    }
    
    public function actionSendforgotpwdmail(){  
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        
          if (isset($_REQUEST['email'])&& isset($_REQUEST['userpk'])){ 
            $email = trim($_REQUEST['email']);
            $userpk = trim($_REQUEST['userpk']);
           $dtl = UsermstTbl::find()
                  ->where('(UM_LoginId =:UM_LoginId or UM_EmailID=:UM_LoginId or um_primobno=:UM_LoginId)and UserMst_Pk=:UserMst_Pk  and UM_Status=:UM_Status',
                    [':UM_LoginId' => trim($email),':UserMst_Pk' => trim($userpk),':UM_Status'=>'A'])
                ->asArray()->one();
        
         }
        else
        {
             
            $email = $data['email'];
            $type = $data['type'];
            if($data['userpk'])
            {
                $dtl = UsermstTbl::find()->where('UserMst_Pk ='.$data['userpk'])->one();
//                 $dtl = UsermstTbl::getUserDtlbyEmailandPk($email,$data['userpk']);
            }
            else
            {
                 $dtl = UsermstTbl::getUserDtlbyEmail($email);
            }
          
       
        }
       if(!empty($dtl)){
            $attemptLog = UsermstTbl::logForgotPasswordAttempt($dtl['UserMst_Pk'],$type); 
            
            if($attemptLog){
                \common\components\User::sendForgotMail($attemptLog);
            }
           /*  echo '<br>';
           print_r($dtl['um_fgtpasswordattempt']);
            echo '</br>'; exit; */
            $msg['msg'] = ($attemptLog !== 0) ? 'Forgot Mail Sent Successfully' : 'Limit Reached';
            $msg['status'] = ($attemptLog !== 0) ? 1 : 2; //2 - Limit Reached
            if($type == 'mobile')
                $msg['emailID'] = $attemptLog->um_primobno;
            else
                $msg['emailID'] = $attemptLog->UM_EmailID;
            $msg['id'] = Security::encrypt($attemptLog->UserMst_Pk);
            $msg['attemptCount'] = $attemptLog->um_fgtpasswordattempt;
            $msg['time'] = \Yii::$app->params['OTP']['setpassword']['expiryduration'];
            /* if(isset($dtl['um_fgtpasswordattempt']) && ($_REQUEST['apiFor'] == "and" || $_REQUEST['apiFor'] == "ios")){
             $fgtattemptcount = $dtl['um_fgtpasswordattempt'];
            if($fgtattemptcount == 3)
            {
            $msg['attemptCount'] = 3; 
            }
            elseif($fgtattemptcount == 2) 
            {
            $msg['attemptCount'] = 2;
            }
            else 
            {
             $msg['attemptCount'] = 1;
            }
         }  */
            //if($attemptLog)
          }
          else if(empty($dtl) && ($_REQUEST['apiFor'] == "and" || $_REQUEST['apiFor'] == "ios")){
            $msg['msg'] = 'This email id/username/mobile is not registered with us.';
            $msg['status'] = 0; 
          }
        else{
            $msg['msg'] = 'Incorrect Email ID';
            $msg['status'] = 0;
            }
        
         return $this->asJson($msg);
       
    }
    
    public function actionResetpassword(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
       // echo '<br>';
       // print_r("going in".$request_body);
       // echo '</br>';
      // exit;
      if( !empty($_REQUEST['password']) && !empty($_REQUEST['otp']) && !empty($_REQUEST['userpk']))
      {
        $password = trim($_REQUEST['password']);
        $otp = trim($_REQUEST['otp']);
        $uuserpk = trim($_REQUEST['userpk']);
      }
      else{
        $password = $data['password'];
        $otp = $data['otp'];
        $uuserpk = $data['userpk'];
        $type = $data['type'];
      }
        $userPk = \common\components\Security::decrypt($uuserpk);
        $resetPassword = UsermstTbl::resetPassword($password,$userPk,$otp,$type);
        if ($resetPassword === true){
            $msg['msg'] = 'Password reset successfully';
            $msg['status'] = 1;
        } else if ($resetPassword === "UN") {
            $msg['msg'] = 'Username cannot be a password';
            $msg['status'] = 2;
        } else if ($resetPassword === "LTP") {
            $msg['msg'] = 'Last 3 passwords cannot be reused';
            $msg['status'] = 3;
        } else if ($resetPassword === "OTP-INVALID") {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 5;
        } else if ($resetPassword === "OTP-EXPIRED") {
            $msg['msg'] = 'OTP Expired';
            $msg['status'] = 6;
        } else {
            $msg['msg'] = 'Something went wrong';
            $msg['status'] = 0;
        }
        return $this->asJson($msg);
    }
    
    public function actionSendotp(){
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        //echo '<pre>';print_r($data);exit;
        if(isset($_REQUEST['newpassword']) && isset($_REQUEST['currentpassword']))
        {
        $currentpassword = ltrim($_REQUEST['currentpassword']);
        $newpassword = ltrim($_REQUEST['newpassword']);
        $userpk = ltrim($_REQUEST['userid']);
        }
        else{
            $currentpassword = $data['currentpassword'];
            $newpassword = $data['newpassword'];
            $userpk = \common\components\Security::decrypt($data['userpk']);
        }
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        $checkAndSendOTP = \common\components\User::sendOtpToChangePassword($userpk,$currentpassword,$newpassword,$data);
        
        if($checkAndSendOTP && $checkAndSendOTP === true){
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $model = UsermstTbl::findOne($userpk);
            if($data['otptype'] == 'email')
            {
              $msg['expiry'] =   $model->um_otpexpireson;
            }
            else
            {
               $msg['expiry'] =   $model->um_mobotpexpiry;
            }
            
        } else if ($checkAndSendOTP === "CNP") {
            $msg['msg'] = 'Current Password is wrong';
            $msg['status'] = 4;
        } else if ($checkAndSendOTP === "UN") {
            $msg['msg'] = 'Username cannot be a password';
            $msg['status'] = 2;
        } else if ($checkAndSendOTP === "LTP") {
            $msg['msg'] = 'Last 3 passwords cannot be reused';
            $msg['status'] = 3;
        }
        return $this->asJson($msg);
    }
    
    public function actionResendotp() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $userpk = \common\components\Security::decrypt($data['userpk']);
        $model = UsermstTbl::findOne($userpk);
        
        if(isset($_REQUEST['newpassword']) && isset($_REQUEST['currentpassword']))
        {
        $currentpassword = ltrim($_REQUEST['currentpassword']);
        $newpassword = ltrim($_REQUEST['newpassword']);
        $userpk = ltrim($_REQUEST['userid']);
        }
        else{
            $currentpassword = $data['currentpassword'];
            $newpassword = $data['newpassword'];
            $userpk = \common\components\Security::decrypt($data['userpk']);
        }
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        $mailSend = \common\components\User::sendOtpToChangePassword($userpk,$currentpassword,$newpassword,$data);
        if($mailSend  && $mailSend === true) {
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $model = UsermstTbl::findOne($userpk);
            if($data['otptype'] == 'email')
            {
              $msg['expiry'] =   $model->um_otpexpireson;
            }
            else
            {
               $msg['expiry'] =   $model->um_mobotpexpiry;
            }
            return $msg;
        }
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        return $msg;
    }
    
    public function actionIsvalidlink(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if(!empty($_REQUEST['userpk']) && !empty($_REQUEST['dt']) )
        {
           $userpk = trim($_REQUEST['userpk']);
           $dt = trim($_REQUEST['dt']);
            $userpk = \common\components\Security::decrypt($userpk);
            $linkdate = \common\components\Security::decrypt($dt);
        }else{
        $userpk = \common\components\Security::decrypt($data['userpk']);
        $linkdate = \common\components\Security::decrypt(urldecode($data['dt']));
        }
        $isValid = \common\components\User::checkValidForgotPwdLink($userpk,$linkdate);
        if($isValid !== 2 && $isValid !== 3 && $isValid !== 5 && $isValid !== 4 ){
            $msg['msg'] = 'Active';
            $msg['pwdchangedon'] = $isValid->um_pwdchangedon;
        }else if($isValid === 2){
            $msg['msg'] = 'Expired';
        }else if ($isValid === 3){
            $msg['msg'] = 'Already reset';
        }
        else if ($isValid === 5){
            $msg['msg'] = 'Deactivated';
        }
        else if ($isValid === 4){
            $msg['msg'] = 'Deleted';
        }
       
        $msg['status'] = $isValid;
        return $this->asJson($msg);
    }
    
    public function actionFgtotpverify(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        
        if(!empty($_REQUEST['userid']) && !empty($_REQUEST['otp']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['userid']);
        $otp = trim($_REQUEST['otp']); 
        } 
        else{ 
        $userpk = \common\components\Security::decrypt($data['userpk']);
        $otp = $data['otp'];
        $type = $data['type'];
        }
        $isValid = \common\components\User::checkValidOTP($userpk,$otp,$type);
        $datamodel = UsermstTbl::findOne($userpk);
        if($isValid !== 2 && $isValid !== 3){
            $t = explode('&t=',$isValid)[1];
            $t = explode('&en=',$t)[0];
            $msg['msg'] = 'Active';
            $msg['userpk'] = $userpk  ;
            $msg['t'] = $t;
            $msg['f'] = '';
            $msg['en'] =  explode('&en=',$t)[1];
            $msg['status'] = 1;
            $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }else if ($isValid == 2) {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 2;
             $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }else if ($isValid == 3) {
            $msg['msg'] = 'Expired OTP';
            $msg['status'] = 3;
        }
        if($_REQUEST['otp']=='' && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') ){
            $msg['msg'] = 'Please Enter OTP';
            $msg['status'] = 0;
             $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }
    return $this->asJson($msg);
    }
    
    public function actionValidateloginotp(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        if(!empty($_REQUEST['userid']) && !empty($_REQUEST['otp']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['userid']);
        $otp = trim($_REQUEST['otp']); 
        } 
        else{ 
        $userpk = \common\components\Security::decrypt($data['userpk']);
        $otp = $data['otp'];
        }
        $isValid = \common\components\User::checkLoginOtp($userpk,$otp);
        $datamodel = UsermstTbl::findOne($userpk);
       
        if($isValid !== 2 && $isValid !== 3){
            $t = explode('&t=',$isValid)[1];
            $t = explode('&en=',$t)[0];
            $msg['msg'] = 'Active';
            $msg['userpk'] = $userpk  ;
            $msg['t'] = $t;
            $msg['f'] = '';
            $msg['en'] =  explode('&en=',$t)[1];
            $msg['status'] = 1;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }else if ($isValid == 2) {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 2;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }else if ($isValid == 3) {
            $msg['msg'] = 'Expired OTP';
            $msg['status'] = 3;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }
        if($_REQUEST['otp']=='' && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') ){
            $msg['msg'] = 'Please Enter OTP';
            $msg['status'] = 0;
        }
    return $this->asJson($msg);
    }
    
    public function actionSendloginotp(){
        
         $request_body = file_get_contents('php://input');
         $data = json_decode($request_body, true);
         
         if(!empty($_REQUEST['pk']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['pk']);
        } 
        else{ 
        $userpk = \common\components\Security::decrypt($data['pk']);
        }
        
        $model = UsermstTbl::findOne($userpk);
        $mailSend = \common\components\User::sendLoginOtp($userpk);
        
        if($mailSend && $mailSend['isSent'] === true){
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $msg['attempt'] = (int)$mailSend['attempt'];
            $msg['time'] = (int)$mailSend['duration'];
        }
        
        return $this->asJson($msg);  
    }
    
    public function isLoggedInWithNewIPorDevice($model) {
        $currentUserIpAddress = Common::getIpAddress();
        $trackDtls = \common\models\UserlogintrackTbl::getLoginTrackdtls($model['user_pk']);
        $ipAddressArr = array_column($trackDtls,'ult_devipaddr');
        
//        if(!in_array($currentUserIpAddress, $ipAddressArr)){
//            self::sendSuspisiousLoginMail($model);
//        }
        \common\models\UserlogintrackTbl::addUpdateLoginTrack($model, $currentUserIpAddress);
    }

    public function isLogInWithNewIPorDevice($model) {
        $currentUserIpAddress = Common::getIpAddress();
        $trackDtls = \common\models\UserlogintrackTbl::getLoginTrackdtls($model['user_pk']);
        $ipAddressArr = array_column($trackDtls,'ult_devipaddr');
        
//        if(!in_array($currentUserIpAddress, $ipAddressArr)){
//            self::sendSuspisiousLoginMail($model);
//        }
        \common\models\UserlogintrackTbl::addUpdateLgnTrack($model, $currentUserIpAddress);
        
    }
    
    public function sendSuspisiousLoginMail($model) {
        $content = "Hi {$model['user_name']}, You have recently logged in with new device or ip.<br> If it was not done by you. Kindly contact the support team.<br> Thanks";
        return \Yii::$app->mailer->compose()
                ->setFrom('noreply@businessgateways.com')
                ->setTo(\Yii::$app->params['testMailIDs'])
                ->setSubject('Security Warning - Sign in with new IP')
                ->setHTMLBody($content)
                ->send();
    }
    
    public function sendDiffCountryMail($userPk,$countrycode) {
       $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=> 'logindiffcountrymailcontent',
            'userpk'=>$userPk,
            'location'=>$countrycode,
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
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
     public function sendDiffCountryLoginMailToAdmin($userpk,$location) {
       $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=> 'loginadminusermailcontent',
            'userpk'=>$userpk,
            'location'=>$location,
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
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    
    public function actionAcceptreg(){
        ini_set('max_execution_time', 0);
        $reg_pk = \common\components\Security::decrypt($_REQUEST['reg_pk']);
        $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $reg_pk,'um_primarycontact' => 1])->one();
        $emailid = $user_info->UM_EmailID;
        $userPk = $user_info->UserMst_Pk;
        $reg_info = \common\models\MemberregistrationmstTbl::findOne($reg_pk);
        $isLinkNotExpired = self::checkLinkExpiry($reg_info->MRM_CreatedOn);
        if($reg_info->MRM_OrderConfrmStat == 'N' && $isLinkNotExpired) {
            $reg_info->MRM_MemberStatus = 'V';
            $reg_info->MRM_OrderConfrmStat = 'A';
            $reg_info->MRM_OrderConfrmOn = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            $reg_info->save();
            $user_info->UM_Status = 'A';      
            $user_info->um_emailconfirmstatus = 1;
            $user_info->um_emailconfirmedon = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            if($user_info->save()){
                    $user_info =  \common\models\UsermstTbl::genereateSetPasswordLink($user_info);
            }
            //for dynamic mail trigger
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>157,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Accept mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>158,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Accept Invoice copy mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>159,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'A',
                'status' => 1,
                'setpassword' => $user_info->um_pwdresetlink
            ];
        }
        if(!$isLinkNotExpired) {
            $sts = 'EP';
        }else if($reg_info->MRM_OrderConfrmStat == 'C' && $isLinkNotExpired) {
            $sts = 'AC';
        }else if($reg_info->MRM_OrderConfrmStat == 'A' && $isLinkNotExpired) {
            $sts = 'AA';
        }else if($reg_info->MRM_OrderConfrmStat == 'I' && $isLinkNotExpired) {
            $emailid = 'nivediny@businessgateways.com';
            //Backend Mail Accept Invoice copy mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>329,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'AI',
                'status' => 1,
            ];
        }
        return [
            'msg' => $sts,
            'status' => 1
        ];
        
    }
    public function actionCancelreg(){
        $reg_pk = \common\components\Security::decrypt($_REQUEST['reg_pk']);
        $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $reg_pk,'um_primarycontact' => 1])->one();
        $emailid = $user_info->UM_EmailID;
        $userPk = $user_info->UserMst_Pk;
        $reg_info = \common\models\MemberregistrationmstTbl::findOne($reg_pk);
        $isLinkNotExpired = self::checkLinkExpiry($reg_info->MRM_CreatedOn);
        if($reg_info->MRM_OrderConfrmStat == 'N' && $isLinkNotExpired && !empty($_REQUEST['cancelcomment'])) {
            if($_REQUEST['willingon']){
                $reg_info->mrm_ocwillingon = date('Y-m-d');
            }
            $reg_info->MRM_OrderConfrmStat = 'C';
            $reg_info->mrm_occomments = $_REQUEST['cancelcomment'];
            $reg_info->MRM_OrderConfrmOn = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            $reg_info->save();
            //for dynamic mail trigger
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>160,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Cancel mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>161,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
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
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'CC',
                'status' => 1
            ];
        }
        $sts = 'C';
        if(!$isLinkNotExpired) {
            $sts = 'EP';
        }else if($reg_info->MRM_OrderConfrmStat == 'C' && $isLinkNotExpired) {
            $sts = 'AC';
        }else if($reg_info->MRM_OrderConfrmStat == 'A' && $isLinkNotExpired) {
            $sts = 'AA';
        }
        return [
            'msg' => $sts,
            'status' => 1
        ];
    }

    public static function checkLinkExpiry($linkCreatedDate) {
        $activeDays = \Yii::$app->params['regConfirmDays'];
        $linkCreatedDate = date('Y-m-d', strtotime($linkCreatedDate));
        $linkActiveTillDate = date('Y-m-d', strtotime("$linkCreatedDate + $activeDays days"));
        return (strtotime($linkActiveTillDate) >= strtotime(date('Y-m-d'))) ? true : false;
    }
    public function actionGetpdmodify(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = \common\components\Security::decrypt($data['userpk']);
        $Usrdata = UsermstTbl::findOne($userpk);
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        if(!empty($Usrdata)){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
            $msg['modydate'] = !empty($Usrdata->um_pwdchangedon) ? date('d-m-Y',strtotime($Usrdata->um_pwdchangedon)) : '';
            $msg['mobileorigin'] = ($Usrdata->um_primobnocc == 31) ? 'N' : 'I';
        }
        return $this->asJson($msg);
    }
    public function actionAutoscfsubmitrenew() {
        $dayofautosubmit = \Yii::$app->params['scfautosubmit'];
        $result = Yii::$app->db->createCommand("select * from membercompanymst_tbl a "
                . "left join memberregistrationmst_tbl b on a.MCM_MemberRegMst_Fk =b.MemberRegMst_Pk "
                . "left join suppcertformmembtmp_tbl c on a.MemberCompMst_Pk=c.scfmt_membercompmst_fk "
                . "where (c.scfmt_scfstatus IN ('I','A','D','DI','OSD') OR  c.scfmt_scfstatus IS NULL) and b.MRM_MemberStatus='A' and "
                . "b.MRM_ValSubStatus='A' and (b.MRM_RenewalStatus='RW' OR b.MRM_RenewalStatus='A') and scfmt_renewalstatus!='1'")->queryAll();
        if(count($result) > 0){
           foreach ($result as $value){
                $paymentdtls = \common\models\MemcomppymtinfodtlsTbl::find()
                ->where("mcpid_membercompmst_fk=:compk",[':compk'=>$value['MemberCompMst_Pk']])->orderBy("memcomppymtinfodtls_pk desc")->asArray()->one();
                if($paymentdtls['mcpid_pymtstatus']== 3){
                    $lastpayment=Yii::$app->db->createCommand("select case when DATEDIFF(NOW(), mcpah_appdeclon) >= $dayofautosubmit  then 1 else 0 end as days "
                            . "from memcomppymtapphstry_tbl where mcpah_memcomppymtinfodtls_fk=:compk order by memcomppymtapphstry_pk desc limit 1")
                        ->bindValues([':compk'=>$paymentdtls['memcomppymtinfodtls_pk']])
                        ->queryOne();
                    if ($lastpayment['days']==1) {
                        $result=Yii::$app->db->createCommand("update suppcertformmembtmp_tbl SET scfmt_scfstatus = 'U',scfmt_renewalstatus='1' where "
                                . "scfmt_membercompmst_fk=:compk")->bindValues([':compk'=>$value['MemberCompMst_Pk']]) ->execute(); 
                        $content = $value['MCM_CompanyName'] . ' - Auto Updated SCF for Approval  <br> Thanks';
                        $subject =  $value['MCM_SupplierCode'] . ' - Auto Updated SCF for Approval';
                         \Yii::$app->mailer->compose()
                         ->setFrom('noreply@businessgateways.com')
//                         ->setTo('prithi@businessgateways.com')
                         ->setTo(\Yii::$app->params['testMailIDs'])
                         ->setSubject($subject)
                         ->setHTMLBody($content)
                         ->send();
                    }
                }
           }
       }
    }
    public function actionAutosezadsubmitrenew() {
        $dayofautosubmit = \Yii::$app->params['sezardautosubmit'];
        $result = Yii::$app->db->createCommand("select * from membercompanymst_tbl a "
                . "left join memberregistrationmst_tbl b on a.MCM_MemberRegMst_Fk =b.MemberRegMst_Pk "
                . "left join sezadregtmp_tbl c on a.MemberCompMst_Pk=c.srt_memcompmst_fk "
                . "JOIN  sezadregdtls_tbl sm ON sm.srd_sezadregtmp_fk = c.sezadregtmp_pk "
                . " where (c.srt_applstatus IN (3,4,5,6,8) and b.MRM_MemberStatus='A') and (b.MRM_RenewalStatus='RW' OR b.MRM_RenewalStatus='A') "
                . "and srt_renewalstatus='1'")->queryAll();
        if(count($result) > 0){
           foreach ($result as $value){
                $paymentdtls = \common\models\MemcomppymtinfodtlsTbl::find()
                ->where("mcpid_membercompmst_fk=:compk",[':compk'=>$value['MemberCompMst_Pk']])->orderBy("memcomppymtinfodtls_pk desc")->asArray()->one();
                if($paymentdtls['mcpid_pymtstatus']== 3){
                    $lastpayment=Yii::$app->db->createCommand("select case when DATEDIFF(NOW(), mcpah_appdeclon) >= $dayofautosubmit  then 1 else 0 end as days "
                            . "from memcomppymtapphstry_tbl where mcpah_memcomppymtinfodtls_fk=:compk order by memcomppymtapphstry_pk desc limit 1")
                        ->bindValues([':compk'=>$paymentdtls['memcomppymtinfodtls_pk']])
                        ->queryOne();
                    if ($lastpayment['days']==1) {
                        $result=Yii::$app->db->createCommand("update sezadregtmp_tbl SET srt_applstatus = '7',srt_isrenewal=1,srt_renewalstatus=0 where srt_memcompmst_fk=:compk")->bindValues([':compk'=>$value['MemberCompMst_Pk']]) ->execute(); 
                        $sezadMain=\common\models\SezadregdtlsTbl::find()->where("srd_memcompmst_fk=:tempmsfk",[":tempmsfk"=>$value['MemberCompMst_Pk']])->asArray()->one();
                        $content = $value['MCM_CompanyName'] . ' - Auto Updated SEZAD Form  <br> Thanks';
                        $subject =   'SEZAD Certified Supplier: Posted the Form for Renewal (SEZAD Reg. No. ' . $sezadMain->srd_regno . ')';
                         \Yii::$app->mailer->compose()
                         ->setFrom('noreply@businessgateways.com')
//                                 ->setTo('prithi@businessgateways.com')
                         ->setTo(\Yii::$app->params['testMailIDs'])
                         ->setSubject($subject)
                         ->setHTMLBody($content)
                         ->send();
                    }
                }
           }
       }
    }
    public function actionUserpermission(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = base64_decode($data['userpk']);
        if(!empty($userpk) && is_numeric($userpk)){
            $retdata['data'] = \common\models\UserpermtrnTblQuery::getuseraccess($userpk);
            $retdata['status'] = 1;
        }else{
            $retdata['status'] = 0;
        }
        return $this->asJson($retdata);
    }
    public function actionGetotturesponsedata()
    {
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= \common\components\Security::decrypt($dataval);
        $dataval=(array)json_decode($dataval);
        $ref_no = $dataval['ref_no'];
        $cls = $dataval['cls'];
        $country = $dataval['country'];
        $serv_module = $dataval['serv_module'];
        $userpk = \common\components\Security::base64_decrypt_str($dataval['userpk'],'BGIINDIA');
        $comppk = \common\components\Security::base64_decrypt_str($dataval['comppk'],'BGIINDIA');
        $response_data = \common\models\UsermstTblQuery::getPymtResponseData($ref_no, $serv_module, $comppk, $userpk);
        return ($response_data)?$this->asJson($response_data):[];
    }
 }
