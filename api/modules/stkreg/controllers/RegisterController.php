<?php

namespace api\modules\stkreg\controllers;

use Yii;
use \api\components\Register;
use api\modules\mst\controllers\MasterController;
use \api\components\Security;
use yii\data\ActiveDataProvider;
use app\models\OpalmemberregmstTbl;
use \app\models\OpalusermstTbl;
use api\components\Common;


class RegisterController extends MasterController
{
    public $modelClass = 'app\models\OpalmemberregmstTbl';

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
     * @SWG\Post(
     *     path="/stkreg/register/savecentre",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new centre.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="centerdtls", type="object",
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="registeras", type="integer", example=2),
     *                  @SWG\Property(property="opal_memb_no", type="string", example=""),
     *                  @SWG\Property(property="opal_memb_expiry", type="integer", example=""),
     *                  @SWG\Property(property="comp_cr_no", type="string", example=""),
     *                  @SWG\Property(property="comp_cr_expiry", type="string", example=""),
     *                  @SWG\Property(property="company_name_en", type="string", example=""),
     *                  @SWG\Property(property="company_name_ar", type="string", example=""),
     *                  @SWG\Property(property="tp_name_en", type="string", example=""),
     *                  @SWG\Property(property="tp_name_ar", type="string", example=""),
     *                  @SWG\Property(property="branch_name_en", type="integer", example=""),
     *                  @SWG\Property(property="branch_name_ar", type="integer", example=""),
     *                  @SWG\Property(property="Course_offered", type="integer", example=""),
     *                  @SWG\Property(property="governorate", type="integer", example=""),
     *                  @SWG\Property(property="wilayat", type="integer", example=""),
     *                  @SWG\Property(property="address1", type="string", example=""),
     *                  @SWG\Property(property="address2", type="string", example=""),
     *                  @SWG\Property(property="gm_name", type="string", example=""),
     *                  @SWG\Property(property="gm_emailid", type="string", example=""),
     *                  @SWG\Property(property="gm_mobnum", type="integer", example=""),
     *                  @SWG\Property(property="moheri_grade", type="integer", example=""),
     *                  @SWG\Property(property="focalpoint_name", type="integer", example=""),
     *                  @SWG\Property(property="focalpoint_desig", type="integer", example=""),
     *                  @SWG\Property(property="focalpoint_emailid", type="integer", example=""),
     *                  @SWG\Property(property="focalpoint_mobno", type="integer", example=""),
     *                  @SWG\Property(property="multiplefile", type="integer", example=""),
     *                  @SWG\Property(property="display", type="integer", example=""),
     *                  @SWG\Property(property="userCheck", type="string", example=""),
     *                  @SWG\Property(property="reCaptchaToken", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavecentre(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['centerdtls'];
     
        $transaction = \Yii::$app->db->beginTransaction();
        
        if(\api\components\Common::checRecaptchaV3($requestdata['reCaptchaToken'],$requestdata['action'])){
         
            try{
                $register = Register::registerCentre($requestdata, $transaction);
                if($register['status'] == 1){
                    return [ 'msg' => 'Registered Successfully', 'status' => 1, 'flag' => 'S', 'refno' => $register ];
                }
                else if($register['status'] == 2){
                    $transaction->rollBack();
                    return [ 'msg' => 'There was a problem with your registration. Please try again.', 'status' => 2, 'flag' => 'UN', 'controls' => $register['errorformcontrol'] ];
                }
            } catch (Exception $ex) {
                echo "<pre>"; print_r($ex); die;
                $transaction->rollBack();
            }
        }else{
            return [ 'title' => 'Captcha Expired!', 'msg' => 'There was a problem with your registration. Please try again.', 'status' => 0, 'flag' => 'C' ];
        }
        return ['title' => '', 'msg' => 'something went wrong', 'status' => 0, 'flag' => 'E' ];
    }

    
    public function actionCheckalreadyexists(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $country = $data['country']?$data['country']:31;
        $type = Security::sanitizeInput($data['type'], "string");
        $stkholderType = Security::sanitizeInput($data['stkholderType'], "string");
        $dataToCheck = strtolower(trim(Security::sanitizeInput($data['data'], "string_spl_char")));
        if($type == 'companynamear')
        {
            $dataToCheck = $data['data'];
        }
        $countryPk = strtolower(trim(Security::sanitizeInput($country, "number")));
        $regpk =$data['regpk'];
        $alreadyInvited = false;
        $isAvailable = false;
        if(!empty($dataToCheck)){
            switch ($type) {
                case 'focalpointemailid':
                    $isAvailable = OpalusermstTbl::checkIsEmailAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    break;
               case 'mobileno':
                    $isAvailable = OpalusermstTbl::checkIsMobileNoAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    break;
                
                case 'companynameen':
                  
                    $isAvailable = OpalmemberregmstTbl::checkIsCompanyNameAlreadyExists($dataToCheck);
                    break;
                case 'companynamear':
                    $isAvailable = OpalmemberregmstTbl::checkIsCompanyNameArAlreadyExists($dataToCheck);
                    break;
                case 'opalmembno':
                    $isAvailable = OpalmemberregmstTbl::checkIsOpalMemNumAlreadyExists($dataToCheck,$regpk);
                    break;
                case 'compcrno':
                    $isAvailable = OpalmemberregmstTbl::checkIsCRNumberAlreadyExists($dataToCheck,$countryPk,$regpk,$stkholderType);
                    break;
                case 'vehiclenum':
                    $isAvailable = \app\models\RasvehicleregdtlsTbl::checkIsVehicleNumAlreadyExists($dataToCheck);
                    break;
                case 'ivmsvehiclenum':
                    $isAvailable = \app\models\IvmsvehicleregdtlsTbl::checkIsVehicleNumAlreadyExists($dataToCheck);
                    break;
//                
                case 'chassnum':
                    $isAvailable = \app\models\RasvehicleregdtlsTbl::checkIsChassNumAlreadyExists($dataToCheck,$countryPk,$regpk,$stkholderType);
                    break;
                case 'ivmschassnum':
                    $isAvailable = \app\models\IvmsvehicleregdtlsTbl::checkIsChassNumAlreadyExists($dataToCheck,$countryPk,$regpk,$stkholderType);
                    break;
                case 'ivmsserialnum':
                    $isAvailable = \app\models\RasvehicleregdtlsTbl::checkIsIVMSNumAlreadyExists($dataToCheck,$countryPk,$regpk,$stkholderType);
                    break;
                default :
                    return false;
            }
        }

        
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $isAvailable,
            'alreadyInvited' => $alreadyInvited
        ]);
    }
    public function actionChkregdataalreadyexists(){
        $alreadyInvited="false";
        $type = $_POST['type'];
        $field = $_POST['field'];
        $dataToCheck = strtolower(trim(Security::sanitizeInput($_POST['dataToCheck'], "string_spl_char")));
        $stkholderType = strtolower(trim(Security::sanitizeInput($_POST['stkholderType'], "string_spl_char")));
        $country = strtolower(trim(Security::sanitizeInput($_POST['country'], "number")));
        if(!empty($type)){
            switch ($type) {
              
                case 'company_name_en':
                    $isAvailable = \app\models\OpalmemberregmstTbl::checkIsCompanyNameAlreadyExists($dataToCheck);
                    break;
                case 'mobileno':
                    $isAvailable = \common\models\UsermstTbl::checkIsMobileNoAlreadyExists($dataToCheck);
                    break;
                case 'empid':
                    $isAvailable = \common\models\UsermstTbl::checkIsEmpIDAlreadyExists($dataToCheck);
                    break;
                case 'regno':
                    $isAvailable = \common\models\MembercompanymstTbl::checkIsCRNumberAlreadyExists($dataToCheck,$country,'',$stkholderType);
                    if($isAvailable) {
//                        $isAvailable = 'true';
                        $alreadyInvited = \common\models\MembercompanymstTbl::checkIsCRNumberActiveorInactive($dataToCheck, $country,'',$stkholderType);
                    } 
                    break;
                default :
                    return false;
            }
        }

        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $isAvailable,
            'alreadyInvited' => $alreadyInvited,
            'field'=>$field
        ]);
    }
    
    public function actionSendverifyotp() {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $type = $request['type'];
        $value = $request['value'];
        $companyname = $request['companyname'];
        if($type == 'email')
        {
         $OTPExpiryDurationmin = \Yii::$app->params['OTP']['emailverify']['expiryduration'];   
        }
        else
        {
         $OTPExpiryDurationmin = \Yii::$app->params['OTP']['mobileverify']['expiryduration'];    
        }
        
        $otpgenerated = (string) rand(100000,999999);
        $otpgenerated = 123456;
        $fromwhere = 'registration';
        $otpexpiry = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDurationmin minutes")));
        $arr = [
            'type'=>$type,
            'id'=>$value,
            'expiry'=>$otpexpiry,
            'otp'=>$otpgenerated,
            'duration' => $OTPExpiryDurationmin,
            'name' => $companyname,
            'from' =>  $fromwhere,
            'stkpk' => $request['stkpk'],
        ];
        $arrayjson = file_get_contents('otp.json'); //get existing records
        $array = json_decode($arrayjson);
        $array[] = $arr;
        $f = fopen('otp.json','w'); // write new records
        $json = json_encode($array);
        fwrite($f,$json);
        fclose($f);
        if($type == 'email')
        {
           $update = Register::sendEmailverifyOtpMail($arr); 
        }
        else
        {
            $msg =  "The Otp to verify Your Mobile is <b>".$arr['otp']."</b>";
            $update = Common::sendMobileVerifyOtp($msg,$arr['id'],64); 
        }
        $response = ($update) ? ['type'=>$type, 'duration' => $OTPExpiryDurationmin,'msg' => 'success', 'status' => 1] : [ 'msg' => 'failure', 'status' => 0];
        return $this->asJson($response);
    }
    
    public function actionValidateverifyotp()
    {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $type = $request['type'];
        $value = $request['value'];
        $otp = $request['otp'];
       
        $arrayjson = file_get_contents('otp.json');
        $array = json_decode($arrayjson);
       
        $arrayreverse = array_reverse($array);
        
       $key = array_search($value, array_column($arrayreverse, 'id'));
       
       $data = $arrayreverse[$key];
       if($data->type == $type && $data->otp == $otp && (time() <= strtotime($data->expiry)))
       {
         return true;
       }
       else
       {
           return false;
       }
        
    }
    
    public function actionSendverifyotpdb() {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $type = $request['type'];
        $value = $request['value'];
        $pk = Security::decrypt($request['pk']);
    
        $OTPExpiryDuration = \Yii::$app->params['OTP']['emailverify']['expiryduration'];
        $otpgenerated = (string) rand(1000,9999);
       
        $otpexpiry = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
        $fromwhere = !empty($request['from']) ? $request['from'] :'accountsetting';
       
       $model = OpalusermstTbl::find()->where('opalusermst_pk ='.$pk)->one();
       
       $arr = [
        'userpk'=>$pk,
        'type'=>$type,
        'id'=>$value,
        'expiry'=>$otpexpiry,
        'otp'=>$otpgenerated,
        'duration' => $OTPExpiryDuration,
        'name' => $model->oum_firstname,
        'from' => $fromwhere,
       ];
      
        if($type == 'email')
        {
            $model->oum_otpmail = $otpgenerated;
            $model->oum_otpexpiredon = $otpexpiry;
            if($model->save())
             $update = Register::sendEmailverifyOtpMail($arr); 
        }
        $response = ($update) ? ['type'=>$type,'duration'=>$OTPExpiryDuration, 'expiry'=>$otpexpiry, 'msg' => 'success', 'status' => 1] : [ 'type'=>$type,'msg' => 'failure', 'status' => 0];
        return $this->asJson($response);
    }
    
    public function actionValidateverifyotpdb()
    {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $type = $request['type'] == 'email'? 1 :2;
        
        $pk = Security::decrypt($request['pk']);

        $value = $request['value'];
        $otp = $request['otp'];

        $OTPExpiryDuration = \Yii::$app->params['OTP']['emailverify']['expiryduration'];
        $otpgenerated = (string) rand(100000,999999);
        $otpgenerated = '123456';
        $otpexpiry = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
        $model = OpalusermstTbl::findOne($pk); 
        $arr = [
            'type'=>$type,
            'id'=>$value,
            'expiry'=>$otpexpiry,
            'otp'=>$otpgenerated ,
            'duration' => $OTPExpiryDuration,
            'name' => $model->oum_firstname
           ];
        if($type==1 &&(time() > strtotime($model->oum_otpexpiredon)))
        {
            $data['flag'] = 3;//expired
        }
        else if($type==1 && $model->oum_otpmail == $otp && (time() <= strtotime($model->oum_otpexpiredon)))
       {
           $model->oum_emailconfirmstatus = 1;
           if($request['from'] == 'twofactor')
           {
              $update = true; 
           }
           else
           {
             $update = Register::EmailverifyOtpMail($arr);   
           }
           $data['flag'] =  $model->save()?  1 : 2;
       }
       else
       {
           $data['flag'] = 2;
       }

        return $data;
    }
 
    public function actionTestemail(){
        $content = "Hi this is a test mail";
        return \Yii::$app->mailer->compose()
                ->setFrom('noreply@rabt.om')
                //->setTo('sapna@businessgateways.com')
                ->setTo(\Yii::$app->params['testMailIDs'])
                ->setSubject('TestMail')
                ->setHTMLBody($content)
                ->send();
    }
    
    public function actionGetConfigurations()
    {
        $data = \app\models\OpalintegconfigmstTblQuery::getRegistrationConfig();
        
        return $data;
    }
    
    public function actionGetmoherigradinglist()
    { 
         $list = new ActiveDataProvider([
                'query' => \app\models\OpalmoherigrademstTbl::find()
                    ->select(['opalmoherigradingmst_pk','omgm_gradename_en','omgm_gradename_ar'])
                    ->where(['omgm_status'=>1]),
                'pagination'=>['pageSize' => false],
            ]);

        return $list;  
    }
    
    public function actionCancelRegistration()
    { 
        
         $request_body	= file_get_contents('php://input');
         $request = json_decode($request_body, true);
         
        if(isset($request))
        {
           $regpk = Security::decrypt($request);
           $model = OpalmemberregmstTbl::findOne($regpk);
           
           $model->omrm_regcancelon = date('Y-m-d H:i:s');
           if($model->save())
           {
               $status = 1;
           }
           else
           {
               echo "<pre>";
               var_dump($model->getErrors());
               exit;
           }
        }
        
        return $this->asJson([
            'data' => $model,
            'status' => $status,
        ]);
        
    }
}