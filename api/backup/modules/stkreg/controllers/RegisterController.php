<?php

namespace api\modules\stkreg\controllers;

use common\models\BasemodulemstTbl;
use common\models\StkholdertypmstTbl;
use Yii;
use api\modules\mst\controllers\MasterController;
use common\models\StkholderaccessmstTbl;
use \common\components\Security;
use \common\components\Register;
use \common\models\MemberregistrationmstTbl;
use common\models\MembercompanymstTbl;
use common\models\UsermstTbl;
use \api\modules\mst\models\CountryMasterQuery;
use common\models\MemcomprewapphstryTbl;
use yii\data\ActiveDataProvider;
use common\components\Common;

class RegisterController extends MasterController
{
    public $modelClass = 'common\models\MemberregistrationmstTbl';

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
     *     path="/stkreg/register/add-stakeholder",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new stakeholder.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="stkholderdetails", type="object",
     *                  @SWG\Property(property="stkholdregid", type="integer", example=""),
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="company_name", type="string", example=""),
     *                  @SWG\Property(property="country", type="integer", example=""),
     *                  @SWG\Property(property="state", type="integer", example=""),
     *                  @SWG\Property(property="city", type="integer", example=""),
     *                  @SWG\Property(property="postal_code", type="integer", example=""),
     *                  @SWG\Property(property="firstname", type="string", example=""),
     *                  @SWG\Property(property="lastname", type="string", example=""),
     *                  @SWG\Property(property="username", type="string", example=""),
     *                  @SWG\Property(property="password", type="string", example=""),
     *                  @SWG\Property(property="timezone", type="integer", example=""),
     *                  @SWG\Property(property="mobile_cc", type="integer", example=""),
     *                  @SWG\Property(property="mobile_no", type="integer", example=""),
     *                  @SWG\Property(property="landline_cc", type="integer", example=""),
     *                  @SWG\Property(property="landline_no", type="integer", example=""),
     *                  @SWG\Property(property="landline_ext", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddStakeholder(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['stkholderdetails'];
        $transaction = Yii::$app->db->beginTransaction();
        $isEmailAlreadyExists = \common\models\MembercompanymstTbl::isEmailAreadyExists($data['email']);
        if($isEmailAreadyExists){
            return [
                'msg' => 'email already exists',
                'status' => 0
            ];
        }
        
        if(!empty($data)){
            try{
                $msg = (!empty($data['stkholdregid'])) ? 'successfully updated' : 'successfully created';
                $saveStakeholderDetails = \common\models\MemberregistrationmstTbl::saveStakeHolderDetails($data);
                $saveCompanyDetails = \common\models\MembercompanymstTbl::saveCompanyDetails($data,$saveStakeholderDetails);
                $saveCompanyContactDetails = \common\models\MemcompcontactdtlsTbl::saveCompanyContactDetails($data,$saveCompanyDetails);
                $saveUserDetails = \common\models\UsermstTbl::saveUserRegDetails($data,$saveStakeholderDetails);
                $transaction->commit(); 
                return [
                    'msg' => $msg,
                    'status' => 1,
                ];
            } catch (Exception $ex) {
                $transaction->rollBack();
            }
        }
        
        return [
            'msg' => 'something went wrong',
            'status' => 0
        ];
    }


    /**
     * @SWG\Get(
     *     path="/stkreg/register/delete-stakeholder",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete a stakeholder(s).",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteStakeholder() { 
        $decryptedId = Security::decrypt($_GET['id']);
        if(strpos($decryptedId,",")){
            $id = explode(",",$decryptedId);
        }else{
            $id = Security::sanitizeInput($decryptedId, "number");
        }
        try{
            \common\models\UsermstTbl::deleteUserDetails($id);
            \common\models\MemcompcontactdtlsTbl::deleteCompanyContactDetails($id);
            \common\models\MembercompanymstTbl::deleteCompanyDetails($id);
            \common\models\MemberregistrationmstTbl::deleteStakeholderRegDetails($id);
            return [
                'msg'=>'Stakeholder deleted successfully',
                'status' => 1,
                'flag'=>'S',
            ];
        } catch (Exception $ex) {
            
        }
        return [
            'msg'=>'Something went wrong',
            'status' => 0,
            'flag'=>'E',
        ];
    }

/**
 * @SWG\Get(
 *     path="/stkreg/register/getstkholderdetails",
 *     tags={"Stakholder Registration"},
 *     consumes={"application/json"},
 *     produces={"application/json"},
 *     summary="It is used to get a list of stakeholder types.",
 *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
 *     @SWG\Parameter(in = "formData", name = "pk", type = "integer",description = "If pk entered it returns particular record, otherwise all"),
 *     @SWG\Response(response = 200, description = "Response"),
 * )
 */
    public function actionGetstkholderdetails(){
        $decryptedId = Security::decrypt($_GET['id']);
        $response = [];
        $response['msg'] = 'success';
        $response['status'] = 1;
        $pk = Security::sanitizeInput($decryptedId, "number");
        $response = \common\models\MemberregistrationmstTbl::getStkholderDetails($pk);
        return !empty($response) ? $response : [];
    }
    
    /**
    * @SWG\Get(
    *     path="/stkreg/register/changestakeholderstatus",
    *     tags={"Stakholder Registration"},
    *     consumes={"application/json"},
    *     produces={"application/json"},
    *     summary="It is used to change the status of the stakeholder.",
    *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
    *     @SWG\Parameter(in = "formData", name = "pk", type = "integer",description = "If pk entered it returns particular record, otherwise all"),
    *     @SWG\Response(response = 200, description = "Response"),
    * )
    */
    public function actionChangestakeholderstatus(){
        $decryptedId = Security::decrypt($_GET['id']);
        $response = [];
        $response['msg'] = 'success';
        $response['status'] = 1;
        $pk = Security::sanitizeInput($decryptedId, "number");
        if(!empty($pk)){
            $statusChanged = \common\models\MemberregistrationmstTbl::changeRegStatus($pk);
            if($statusChanged){
                return [
                    'msg' => 'Status Changed Successfully',
                    'status' => 1
                ];
            }
        }else{
            return [
                'msg' => 'Invalid Parameters',
                'status' => 1
            ];
        }
    }
    
    public function actionGetsuperadminpwd(){
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $model = \common\models\UsermstTbl::findOne($userpk);
        return [
            "msg" => "success",
            "status" => 1,
            "data" => $model['UM_Password'],//Test@123
        ];
    }
    
    public function actionGetIndustrialZoneList(){
        
        $industrialzones = new ActiveDataProvider([
                'query' => \app\models\IndustrialzonemstTbl::find()
                    ->select(['industrialzonemst_pk','izm_zonename_ar','izm_zonename_en'])
                    ->where(['izm_status'=>'A']),
                'pagination'=>['pageSize' => false],
            ]);

        return $industrialzones;
        
    }
    public function actionGetuserdtlsreg(){
        
        $value = Security::decrypt($_GET['pk']);
        $data=[];
        if($value)
        {
           $model = UsermstTbl::find()->where('UserMst_Pk = '.$value)->one(); 
           $model->uMMemberRegMstFk->mrm_stkholdertypmst_fk;
           
           if($model)
           {
               $data['origin']=$model['um_primobnocc']==31 ? 'N':'I';
               $data['twofactorenable']=$model['um_2fkey'];
               $data['twofactorfor']=$model['um_2ffor'];
               $data['emailid']=Security::encrypt($model->UM_EmailID);
               $data['mobileno']=Security::encrypt($model->um_primobno);
               $data['maskemailid']= Common::maskemail($model->UM_EmailID) ;
               $data['maskmobileno']= Common::maskmobilenum($model->um_primobno);
           }
           
        }
       
        return $data;
        
    }
    
    public function actionSetauthentication(){
        
        $value = $_GET['value'];
        $pk = Security::decrypt($_GET['pk']);
        $data =[];
        $model = UsermstTbl::find()->where('UserMst_Pk ='.$pk)->one();
        if($value && $model)
        { 
            if($value == 1 )
            {
                
                if($model->um_emailverified == 1)
                {
                    $model->um_2fkey = 1;
                    $model->um_2ffor = $value;
                    $model->um_2freminder = null;
                    if($model->save())
                    {
                         $data['msg']="Sucess";
                         $data['flag']="S";
                    }
                }
                else
                {
                   $data['msg']="Email not verified";
                   $data['flag']="ENV";
                }
            }
            if($value == 2)
            {
                if($model->um_mobileverified == 1)
                {
                    $model->um_2fkey = 1;
                    $model->um_2ffor = $value;
                     $model->um_2freminder = null;
                    if($model->save())
                    {
                         $data['msg']="Sucess";
                         $data['flag']="S";
                    }
                }
                else
                {
                   $data['msg']="Mobile not verified";
                   $data['flag']="MNV";
                }
            }
        
        }
        return $data;
    }
    
    public function actionGetIndustrialEstateListById(){
        
        if(isset($_GET['zoneid'])){
        $industrialestates = \app\models\IndustrialestatemstTbl::find()
                    ->select(['industrialestatemst_pk','iem_industrialzonemst_fk','iem_estatename_ar','iem_estatename_en'])
                    ->where(['=','iem_industrialzonemst_fk',$_GET['zoneid']])
                    ->andWhere(['iem_status'=>1])->asArray()->all();
        
        $businesslicence = \app\models\BusinesslicensemstTbl::find()
                    ->select(['businesslicensemst_pk','blm_industrialzonemst_fk','blm_licensename_ar','blm_licesename_en'])
                    ->where(['=','blm_industrialzonemst_fk',$_GET['zoneid']])
                    ->andWhere(['blm_status'=>1])->asArray()->all();
    
        
         $data['est'] = $industrialestates;
         $data['buslicence'] = $businesslicence;
         return $data;
        }
 
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
                case 'email':
                    $isAvailable =  \common\models\UsermstTbl::checkIsEmailAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    if(!$isAvailable){
                       $alreadyInvited =  \common\models\UserinvitedtlsTbl::isEmailAlreadyInvitedAndActive($dataToCheck);
                    }
                    break;
                case 'username':
                    $isAvailable = \common\models\UsermstTbl::checkIsUserNameAlreadyExists($dataToCheck,$regpk);
                    break;
                case 'companyname':
                    $isAvailable = \common\models\MembercompanymstTbl::checkIsCompanyNameAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    break;
                case 'companynamear':
                    $isAvailable = \common\models\MembercompanymstTbl::checkIsCompanyNameArAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    break;
                case 'mobileno':
                    $isAvailable = \common\models\UsermstTbl::checkIsMobileNoAlreadyExists($dataToCheck,$regpk,$stkholderType);
                    break;
                case 'empid':
                    $isAvailable = \common\models\UsermstTbl::checkIsEmpIDAlreadyExists($dataToCheck,$regpk);
                    break;
                case 'crregno':
                    $isAvailable = \common\models\MembercompanymstTbl::checkIsCRNumberAlreadyExists($dataToCheck,$countryPk,$regpk,$stkholderType);
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
                case 'mail':
                    $isAvailable =  \common\models\UsermstTbl::checkIsEmailAlreadyExists($dataToCheck,'',$stkholderType);
                    if($isAvailable) {
//                        $isAvailable = 'true';
                        $alreadyInvited = \common\models\UsermstTbl::checkEmailIsActiveorInactive($dataToCheck,'',$stkholderType);
                    } else {
//                        $alreadyInvited = 'false';
                        $isAvailable = 'false';
                    }
                    break;
                case 'username':
                    $isAvailable = \common\models\UsermstTbl::checkIsUserNameAlreadyExists($dataToCheck);
                    break;
                case 'cmpname':
                    $isAvailable = \common\models\MembercompanymstTbl::checkIsCompanyNameAlreadyExists($dataToCheck);
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
    
    public function actionGetuserdtls() {
        if (!empty($_POST['ComregNo'])) {
            $checkComRegNoDtls = MembercompanymstTbl::find()
                ->select("MCM_crnumber,MCM_CompanyName,MRM_MemberStatus")
                ->leftJoin('memberregistrationmst_tbl','mcm_memberregmst_fk = memberregmst_pk')
                ->where('lower(MCM_crnumber) = :MCM_crnumber',[':MCM_crnumber' => $_POST['ComregNo']])
                ->asArray()->all();
           
            $tempArray = array();  
        $filename = dirname(__FILE__) . '/../../../../backend/json/registerform/Commericalregister.json';  
        if(file_exists($filename)){
            $inp = file_get_contents($filename);
            $myfile = fopen($filename, "w") or die("Unable to open file!");  
            $tempArray = (array)json_decode($inp,true);	            
        } else {         
            $myfile = fopen($filename, "w") or die("Unable to open file!"); 
            
        }
            foreach ($checkComRegNoDtls as $comRegVal => $keyValue) {
                 $result =array(
                 'NBFNo'=>$keyValue['mcm_RegistrationNo'],
                'CompName'=>$keyValue['MCM_CompanyName'],
                'Email'=>$keyValue['MCM_EmailID'],
                'Phone'=>$keyValue['MCM_PriMobCC'].'-'.$keyValue['MCM_MobileNo'],
                'RegNo'=>$keyValue['MCM_crnumber'],
                'date'=>date('d-m-Y h:m:s'),
                     );
                 array_push($tempArray, $result);
             }              
           
             $jsonData = json_encode($tempArray);
             fwrite($myfile, $jsonData);
              fclose($myfile);
        

        }
    }
    
     public function actionGetinactiveuserlist()
     {

        $CommList = dirname(__FILE__) . '/../../../../backend/json/registerform/Commericalregister.json';
        
        
//        $downloadtxt = '<br><div style="width:100%">Inactive Supplier List(<a href="#" >Click here</a> to download excel report) </div><br>';
        $excel = '<table border="1"><thead><tr><th>NBF No</th><th>Company Name</th><th>Email </th><th>Phone</th><th>Commercial Reg. No.</th><th>Re-Registered</th></tr></thead><tbody>';
        
      if (!file_exists($CommList)) {
            echo 'No file found';
        } else {
            if (file_exists($CommList)) {
               
                $CommListjson = file_get_contents($CommList);
                $splitJson = (array) json_decode($CommListjson);
                if (count($splitJson) > 0) {
                    $CommListCount = count($splitJson);
                    foreach ($splitJson as $i => $ListValue) {
                        if (!empty($ListValue) && !empty((array) $ListValue)) {
                            $excel .= '<tr><td>' . $ListValue->NBFNo . '</td><td>' . $ListValue->CompName . '</td><td>' . $ListValue->Email . '</td><td>' . $ListValue->Phone . '</td><td>' . $ListValue->RegNo . '</td><td>' . $ListValue->date . '</td></tr>';
                          
                        }
                    }
                }
            }
            
            if ($CommListCount == 0) {
                echo 'No Results found';
            } else {
                if (!isset($_REQUEST['excel'])) {
                    echo $excel;
                    exit;
                } else {
                    $data .= "$excel\n";
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=Inactive SUpplier List.xls");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                    print "$header\n$data";
                    exit;
                }
            }
        }
//        return true;
//     }
//     else {
//            header('WWW-Authenticate: Basic');
//            header('HTTP/1.0 401 Unauthorized');
//            echo "You're not allowed to access this page";
//            exit;
//        }
        
 }
    
    public static function actionGetrightcardcounts(){
        $counts = Register::getRightSideCardCounts();
        return $counts;
    }
    
    /**
     * @SWG\Post(
     *     path="/stkreg/register/saveinvestor",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new investor (corporate or individual).",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="investordtls", type="object",
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="inv_identity", type="integer", example=2),
     *                  @SWG\Property(property="company_name", type="string", example=""),
     *                  @SWG\Property(property="est_country", type="integer", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *                  @SWG\Property(property="firstname", type="string", example=""),
     *                  @SWG\Property(property="lastname", type="string", example=""),
     *                  @SWG\Property(property="email", type="string", example=""),
     *                  @SWG\Property(property="username", type="string", example=""),
     *                  @SWG\Property(property="password", type="string", example=""),
     *                  @SWG\Property(property="designation", type="integer", example=""),
     *                  @SWG\Property(property="timezone", type="integer", example=""),
     *                  @SWG\Property(property="mobilecc", type="integer", example=""),
     *                  @SWG\Property(property="mobileno", type="integer", example=""),
     *                  @SWG\Property(property="landlinecc", type="integer", example=""),
     *                  @SWG\Property(property="landlineno", type="integer", example=""),
     *                  @SWG\Property(property="howdoyouknowaboutus", type="integer", example=""),
     *                  @SWG\Property(property="others", type="integer", example=""),
     *                  @SWG\Property(property="comments", type="string", example=""),
     *                  @SWG\Property(property="captcha", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveinvestor(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['investordtls'];
        $transaction = \Yii::$app->db->beginTransaction();
        if(\common\components\Common::checRecaptchaV3($requestdata['reCaptchaToken'],$requestdata['action'])){
            try{
                $register = Register::registerInvestor($requestdata, $transaction);
                if($register){
                    return [ 'msg' => 'Registered Successfully', 'status' => 1, 'flag' => 'S', 'refno' => $register ];
                }
            } catch (Exception $ex) {
                echo "<pre>"; print_r($ex); die;
                $transaction->rollBack();
            }
        }else{
            return [ 'title' => 'Warning!', 'msg' => 'There was a problem with your registration. Please try again.', 'status' => 0, 'flag' => 'C' ];
        }
        return ['title' => '', 'msg' => 'something went wrong', 'status' => 0, 'flag' => 'E' ];
    }
    
    
    public function actionAutosugghowdoyouknow(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $returnArr = MembercompanymstTbl::getAutoSuggestionForHowDoYouKnowAbout($data['input']);
        return $this->asJson([
           'msg'  => 'success',
            'status' => 1,
            'items' => ($returnArr) ? $returnArr : []
        ]);
    }
    
    /**
     * @SWG\Post(
     *     path="/stkreg/register/saveprojowner",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new investor (corporate or individual).",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="projownerdtls", type="object",
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="projowntype", type="integer", example=2),
     *                  @SWG\Property(property="company_name", type="string", example=""),
     *                  @SWG\Property(property="est_country", type="integer", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *                  @SWG\Property(property="firstname", type="string", example=""),
     *                  @SWG\Property(property="lastname", type="string", example=""),
     *                  @SWG\Property(property="email", type="string", example=""),
     *                  @SWG\Property(property="username", type="string", example=""),
     *                  @SWG\Property(property="password", type="string", example=""),
     *                  @SWG\Property(property="timezone", type="integer", example=""),
     *                  @SWG\Property(property="mobilecc", type="integer", example=""),
     *                  @SWG\Property(property="mobileno", type="integer", example=""),
     *                  @SWG\Property(property="landlinecc", type="integer", example=""),
     *                  @SWG\Property(property="landlineno", type="integer", example=""),
     *                  @SWG\Property(property="howdoyouknowaboutus", type="integer", example=""),
     *                  @SWG\Property(property="others", type="integer", example=""),
     *                  @SWG\Property(property="comments", type="string", example=""),
     *                  @SWG\Property(property="captcha", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveprojowner(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['projownerdtls'];
        $transaction = \Yii::$app->db->beginTransaction();
        if(\common\components\Common::checRecaptchaV3($requestdata['reCaptchaToken'],$requestdata['action'])){
            try{
                $register = Register::registerProjOwner($requestdata, $transaction);
                if($register){
                    return [ 'msg' => 'Registered Successfully', 'status' => 1, 'flag' => 'S', 'refno' => $register ];
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
    
    /**
     * @SWG\Post(
     *     path="/stkreg/register/savesupplier",
     *     tags={"Stakholder Registration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new supplier.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="supplierdtls", type="object",
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="projowntype", type="integer", example=2),
     *                  @SWG\Property(property="company_name", type="string", example=""),
     *                  @SWG\Property(property="est_country", type="integer", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *                  @SWG\Property(property="firstname", type="string", example=""),
     *                  @SWG\Property(property="lastname", type="string", example=""),
     *                  @SWG\Property(property="email", type="string", example=""),
     *                  @SWG\Property(property="username", type="string", example=""),
     *                  @SWG\Property(property="password", type="string", example=""),
     *                  @SWG\Property(property="bussrc", type="integer", example=""),
     *                  @SWG\Property(property="timezone", type="integer", example=""),
     *                  @SWG\Property(property="mobilecc", type="integer", example=""),
     *                  @SWG\Property(property="mobileno", type="integer", example=""),
     *                  @SWG\Property(property="landlinecc", type="integer", example=""),
     *                  @SWG\Property(property="landlineno", type="integer", example=""),
     *                  @SWG\Property(property="howdoyouknowaboutus", type="integer", example=""),
     *                  @SWG\Property(property="others", type="integer", example=""),
     *                  @SWG\Property(property="comments", type="string", example=""),
     *                  @SWG\Property(property="captcha", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavesupplier(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['supplierdtls'];
        if(isset($request['certidtls']))
        {
          $requestdata =  array_merge($requestdata,$request['certidtls']);
        }
        $transaction = \Yii::$app->db->beginTransaction();
        if(\common\components\Common::checRecaptchaV3($requestdata['reCaptchaToken'],$requestdata['action'])){
            try{
                $register = Register::registerSupplier($requestdata, $transaction);
                if($register){
                    return [ 'msg' => 'Registered Successfully', 'status' => 1, 'flag' => 'S', 'refno' => $register ];
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
    
    /**
     * @SWG\Post(
     *     path="/stkreg/register/savebuyer,
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new buyer.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="buyerdtls", type="object",
     *                  @SWG\Property(property="stkholder_type", type="integer", example=2),
     *                  @SWG\Property(property="projowntype", type="integer", example=2),
     *                  @SWG\Property(property="company_name", type="string", example=""),
     *                  @SWG\Property(property="est_country", type="integer", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *                  @SWG\Property(property="firstname", type="string", example=""),
     *                  @SWG\Property(property="lastname", type="string", example=""),
     *                  @SWG\Property(property="email", type="string", example=""),
     *                  @SWG\Property(property="username", type="string", example=""),
     *                  @SWG\Property(property="password", type="string", example=""),
     *                  @SWG\Property(property="bussrc", type="integer", example=""),
     *                  @SWG\Property(property="timezone", type="integer", example=""),
     *                  @SWG\Property(property="mobilecc", type="integer", example=""),
     *                  @SWG\Property(property="mobileno", type="integer", example=""),
     *                  @SWG\Property(property="landlinecc", type="integer", example=""),
     *                  @SWG\Property(property="landlineno", type="integer", example=""),
     *                  @SWG\Property(property="howdoyouknowaboutus", type="integer", example=""),
     *                  @SWG\Property(property="others", type="integer", example=""),
     *                  @SWG\Property(property="comments", type="string", example=""),
     *                  @SWG\Property(property="captcha", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavebuyer(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['buyerdtls'];
        $transaction = \Yii::$app->db->beginTransaction();
        if(\common\components\Common::checRecaptchaV3($requestdata['reCaptchaToken'],$requestdata['action'])){
            try{
                $register = Register::registerBuyer($requestdata, $transaction);
                if($register){
                    return [ 'msg' => 'Registered Successfully', 'status' => 1, 'flag' => 'S', 'refno' => $register ];
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
    public function actionGetpaymnetinfo(){
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $classificationdlts = $request['value'];
       
        
        
        $classificationdlts['processfeeper'] = \Yii::$app->params['additional_processing_charge'];
        $classificationdlts['processfee'] = number_format(((float)str_replace(',','',$classificationdlts['totalamount']) * $classificationdlts['processfeeper']) / 100 ,3) ;
        $classificationdlts['totalamount'] = (float)str_replace(',','',$classificationdlts['totalamount']) + number_format($classificationdlts['processfee'],3);
       
        
        return $classificationdlts;
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
    public function actionRemindtwofactor()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $pk = Security::decrypt($request['pk']);
        $model = UsermstTbl::find()->where('UserMst_Pk =' . $pk)->one();
        if ($model) {
            $nextremiderduration = \Yii::$app->params['twofactorremainderduration']*24; //days to hours
            $model->um_2fkey = 2;
            $model->um_2ffor = null;
            $model->um_2freminder = date('Y-m-d', strtotime("+$nextremiderduration hours",time()));
            if ($model->save()) {
                $update = true;
            }
        }
        
         $response = ($update) ? ['msg' => 'success', 'status' => 1] : ['msg' => 'failure', 'status' => 0];
         return $this->asJson($response);
         
    }
    public function actionSendverifyotpdb() {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $type = $request['type'];
        $value = $request['value'];
        $pk = Security::decrypt($request['pk']);
        
    
        $OTPExpiryDuration = \Yii::$app->params['OTP']['emailverify']['expiryduration'];
        $otpgenerated = (string) rand(100000,999999);
        $otpgenerated = '123456';
        $otpexpiry = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
        $fromwhere = !empty($request['from']) ? $request['from'] :'accountsetting';
       
       $model = UsermstTbl::find()->where('UserMst_Pk ='.$pk)->one();
       
       $arr = [
        'type'=>$type,
        'id'=>$value,
        'expiry'=>$otpexpiry,
        'otp'=>$otpgenerated ,
        'duration' => $OTPExpiryDuration,
        'name' => $model->um_firstname. ' '.$model->um_lastname,
        'from' => $fromwhere,

       ];
        if($type == 'email')
        {
            $model->um_otpmail = $otpgenerated;
            $model->um_otpexpireson = $otpexpiry;
            if($model->save())
             $update = Register::sendEmailverifyOtpMail($arr); 
        }
        else
        {
            $model->um_mobileotp = $otpgenerated;
            $model->um_mobotpexpiry = $otpexpiry;
            $msg =  "The Otp to verify Your Mobile is <b>".$arr['otp']."</b>";
            if($model->save())
            $update = Common::sendMobileVerifyOtp($msg,$arr['id'],64);
        }
        $response = ($update) ? ['type'=>$type,'duration'=>$OTPExpiryDuration, 'msg' => 'success', 'status' => 1] : [ 'type'=>$type,'msg' => 'failure', 'status' => 0];
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
        $otpexpiry = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
       
        $model = UsermstTbl::find()->where('UserMst_Pk ='.$pk)->one(); 
        $arr = [
            'type'=>$type,
            'id'=>$value,
            'expiry'=>$otpexpiry,
            'otp'=>$otpgenerated ,
            'duration' => $OTPExpiryDuration,
            'name' => $model->um_firstname. ' '.$model->um_lastname
    
           ];
        if($type==1 &&(time() > strtotime($model->um_otpexpireson)))
        {
            $data['flag'] = 3;//expired
        }


        else if($type==1 && $model->um_otpmail == $otp && (time() <= strtotime($model->um_otpexpireson)))
       {
           $model->um_emailverified = 1;
           if($request['from'] == 'twofactor')
           {
              $update = true; 
           }
           else
           {
             $update = Register::EmailverifyOtpMail($arr);   
           }
           $data['flag'] =  $model->save()?  1 :2;

       }
       elseif($type==2 &&(time() >strtotime($model->um_mobotpexpiry)))
        {
            $data['flag'] = 3;//expired
        }
       else if($type==2 && $model->um_mobileotp == $otp && (time() <= strtotime($model->um_mobotpexpiry)))
       {
          $model->um_mobileverified = 1;
         $data['flag'] =  $model->save()?  1 :2;
       }
       else
       {
           $data['flag'] = 2;
       }

       
        return $data;
    }
    
    public function actionWriteregjsonfile() {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = json_decode(Security::decrypt($request['formValue']), true);
        $update = Register::updateOfflineRegJsonFile($requestdata);
        $response = ($update) ? [ 'msg' => 'success', 'status' => 1] : [ 'msg' => 'failure', 'status' => 0];
        return $this->asJson($response);
    }
//    public function actionUpdatepayment() {
//        $request_body	= file_get_contents('php://input');
//        $request = json_decode($request_body, true);
//        
//        
//        
//    }
    
    public function actionGetClassificationDtlsbyuserpk()
    {
        $request_body	= file_get_contents('php://input');
//        $request = json_decode($request_body, true);
        $request = Security::decrypt($request_body);
        
        $model = UsermstTbl::find()
                ->select('MCM_CompanyName,MCM_RegistrationNo,CyM_CountryName_en as country,CyM_CountryName_ar as countryar,MemberCompMst_Pk,MemberRegMst_Pk, mcid_performainvoicepath, CountryMst_Pk as countrypk , mrm_memsubscriptionmst_fk,mcm_classificationmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = UM_MemberRegMst_Fk')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('countrymst_tbl','MCM_Source_CountryMst_Fk = CountryMst_Pk' )
                ->leftJoin('memcompinvoicedtls_tbl','mcid_membercompmst_fk = MemberCompMst_Pk')
                ->where('UserMst_Pk ='.(int)$request)
                ->asArray()->one();
        
        $link = \Yii::$app->params['backendBaseUrl']."/backend/invoice/$model[MemberRegMst_Pk]/$model[mcid_performainvoicepath]";

        
        $classificationPk = $model['mcm_classificationmst_fk'];
        
         $classficationDtl =  \api\modules\mst\models\ClassificationmstTblQuery::getClassificationByPk(['classificationPk' => $classificationPk]);
         
        $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classficationDtl);
        
        $submst = $subscriptionDtl->subscription;
        
        if (!empty($submst)) {
            $data['amountinwords'] = \common\components\Common::AmountInWords($subscriptionDtl->subscription->msm_baseprice,$origin);
            $data['amountinwordsar'] = \common\components\Common::AmountInWordsArabic($subscriptionDtl->subscription->msm_baseprice,$origin);
            
            
            $data['submst'] = $submst;
            if($classficationDtl->ClM_ClassificationType == 'International')
            {
                $data['vatamount'] = 0.000;
            }
            else
            {
                $data['vatamount'] = number_format(($subscriptionDtl->subscription->msm_baseprice/100)*\Yii::$app->params['vatpercentage'],3);
            }

            $data['vatpercentage'] = ($classficationDtl->ClM_ClassificationType == 'International')?0:\Yii::$app->params['vatpercentage'];
            $data['baseamount'] = number_format($subscriptionDtl->subscription->msm_baseprice,3);
            $data['yearsOfSub'] = \common\components\Common::getDurationByDays($subscriptionDtl->subscription->msm_duration)['Years'];
            $data['classificationmst'] = $classficationDtl;
            $data['subscribepk'] = Security::base64_encrypt_str($subscriptionDtl->subscription->memsubscriptionmst_pk, 'bgiindia');
            $data['subsbyclassifpk'] = Security::base64_encrypt_str($subscriptionDtl->memsubsbyclassif_pk, 'bgiindia');
            $data['totalamount'] = number_format($subscriptionDtl->subscription->msm_baseprice+$data['vatamount'],3);
            
            if (\Yii::$app->params['discoutapplicable']) {
                $discount = \common\components\Common::getsubscriptionDiscount($submst);

                if ($discount) {
                    $data = array_merge($data, $discount);
                }
            }
        }

        $classificationdlts = $data;
       
        
        $classificationdlts['processfeeper'] = \Yii::$app->params['additional_processing_charge'];
        $classificationdlts['processfee'] = number_format(((float)str_replace(',','',$classificationdlts['totalamount']) * $classificationdlts['processfeeper']) / 100 ,3) ;
        $classificationdlts['totalamount'] = number_format(str_replace(',','',$classificationdlts['totalamount']) + number_format($classificationdlts['processfee'],3),3);
        $classificationdlts['company_name'] = $model['MCM_CompanyName'];
        $classificationdlts['Country'] = $model['country'];
        $classificationdlts['CountryAr'] = $model['countryar'];
        $classificationdlts['CountryPk'] = $model['countrypk'];
        $classificationdlts['CompPk'] = $model['MemberCompMst_Pk'];
        $classificationdlts['regPk'] = $model['MemberRegMst_Pk'];
        $classificationdlts['regno'] = $model['MCM_RegistrationNo'];
        $classificationdlts['userPk'] = $request;
        $classificationdlts['invoicepk'] = $link;
       
        
        
        return $classificationdlts;
        
    }
    
    public function actionValidatepaymentlink()
    {
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);

        if(!empty($_REQUEST['userpk']) )
        {
           $userpk = trim($_REQUEST['userpk']);
           $userpk = \common\components\Security::decrypt($userpk);
            
        }else{
        $userpk = \common\components\Security::decrypt($requestdata['userpk']);
        
        }
        
       
        $userdetails = \common\models\UsermstTbl::find() ->where('UserMst_Pk = :userid', [':userid' => $userpk])->one();
        
        
        $gentime =$userdetails->membercompany->invoice->mcid_generatedon;
        
        $dateTime = strtotime($gentime);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
        $linkValidHrs = \Yii::$app->params['fgtPwdMailValidHrs'];
        $validDateTime = strtotime(date('Y-m-d H:i:s', strtotime("+$linkValidHrs hours",$dateTime)));
       
        if( $validDateTime >= $currentDateTime){
           $data['flag'] = "S";
        }else if( $validDateTime < $currentDateTime){
            $data['flag'] = "F";
        }
        
        return $this->asJson($data);
    }


    public function actionRemoveregjsonfile() {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = json_decode(Security::decrypt($request['formValue']), true);
        $requestdata['ipaddress'] = \common\components\Common::getIpAddress();
        $remove = Register::removeOfflineRegJsonFile($requestdata);
        return  ['msg' => ($remove) ? 'success' : 'failure', 'status' => ($remove) ? 1 : 0];
    }
    
    public static function actionViewofflineregdata() {
       $htmlTable = Register::viewOfflineRegJsonFile(true);
       $response = [ 'msg' => 'success', 'status' => 1 , 'table' => $htmlTable];
       return$response;
    }
    
    public static function actionExportofflineregdata() {
        $table = Register::viewOfflineRegJsonFile(FALSE);
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=offlineRegData.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$table";
        die;
    }
    
    public function actionV2regdata() {
        session_start();
        $response = Register::getV2regdata();
        return $response;
    }
    
    public function actionRegstatsbycountry() {
        $returnVal = [];
        if (isset($_POST['country']) && !empty($_POST['country'])) {
            $country = Security::sanitizeInput($_POST['country'], 'number');
            $countryname = Security::sanitizeInput($_POST['countryName'], 'string');
            $returnVal['countstr'] = Register::getRegStatsByCountry($country, $countryname);
            $returnVal['statelist'] = \api\modules\mst\models\StatemstTbl::getStatesForRegAsOptions($_POST['country']);
        }
        return $returnVal;
    }
    
    public function actionV2regsave() {
        $response = Register::saveV2regDetails();
        return $response;
    }
    
    public function actionGetcitybystate() {
        $response = \api\modules\mst\models\CitymstTbl::getCitiesForRegAsOptions($_REQUEST['statepk']);
        return $response;
    }
    
    public function actionSetsubcription()
    {
        if (!empty($_POST['origin']) && $_POST['origin'] == 'I') {
            $yearsofSub = (isset($_POST['yearofSub']) && is_numeric($_POST['yearofSub'])) ? $_POST['yearofSub'] : null;
            $classificationDtl = \api\modules\mst\models\ClassificationmstTbl::getInternationalClassification();
            $classificationPkArr = array_column((array) $classificationDtl, 'ClassificationMst_Pk');
            $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classificationPkArr, true);
            $subcrippk = Security::base64_encrypt_str($subscriptionDtl[0]->msbc_memsubscriptionmst_fk, 'bgiindia');
            $yearval = (isset($_POST['yearofSub']) && !empty($_POST['yearofSub']) ? $_POST['yearofSub'] : 3);
            $subsbyclassifpk = ($yearval == 3 ? Security::base64_encrypt_str($subscriptionDtl[1]->memsubsbyclassif_pk, 'bgiindia'): Security::base64_encrypt_str($subscriptionDtl[0]->memsubsbyclassif_pk, 'bgiindia'));
            $classificationPk = ($yearval == 3 ? $subscriptionDtl[1]->mcbc_classificationmst_fk : $subscriptionDtl[0]->mcbc_classificationmst_fk);
            foreach($subscriptionDtl as $key => $val) {
                $packageDuration = \common\components\Common::getDurationByDays($val->subscription->msm_duration)['Years'];
                if(!empty($yearsofSub) && $yearsofSub == $packageDuration) {
                    $subcrippk = Security::base64_encrypt_str($val->msbc_memsubscriptionmst_fk, 'bgiindia');
                    $subsbyclassifpk = Security::base64_encrypt_str($val->memsubsbyclassif_pk, 'bgiindia');
                    $classificationPk = $val->mcbc_classificationmst_fk;
                }
                $res['submst'][$key + 1] = $val->subscription->currency->CurM_CurrSymbol ." ". $val->subscription->msm_baseprice;
                $res['subscptionid'][$key + 1] = Security::base64_encrypt_str($val->msbc_memsubscriptionmst_fk, 'bgiindia');
            }
            $res['subscribepk'] = $subcrippk;
            $res['subbyclassif'] = $subsbyclassifpk;
            $res['classificationPk'] = $classificationPk;
            $res['year'] = $yearval;
            return $res;
        }
    }
    
    public function actionGetdialcode() {
        $CountryPk = Security::sanitizeInput($_POST['countryPk'], 'number');
        $DialCode = CountryMasterQuery::getCountryDtlByPk($CountryPk);
        $response['dialCode'] = $DialCode->CyM_CountryDialCode ?? null;
        return $response;
    }
    
    public function actionGetnewstate() {
        $request = Security::sanitizeInput($_GET['searchby'], 'string');
        $cnt_fk = Security::sanitizeInput($_GET['cntFk'], 'number');
        $data = \api\modules\mst\models\StatemstTblQuery::getStateAutoCompleteListForInternationCountries($request, $cnt_fk);
        return $data;
    }
    
    public function actionGetnewcity() {
        $request = Security::sanitizeInput($_GET['searchby'], 'string');
        $cnt_fk = Security::sanitizeInput($_GET['cntFk'], 'number');
        $data = \api\modules\mst\models\CitymstTblQuery::getCityAutoCompleteListForInternationCountries($request, $cnt_fk);
        return $data;
    }
    
    public function actionTestemail(){
        $content = "Hi this is a test mail";
        return \Yii::$app->mailer->compose()
                ->setFrom('noreply@rabt.om')
                //->setTo('m.sureshkumar@businessgateways.com')
                ->setTo(\Yii::$app->params['testMailIDs'])
                ->setSubject('TestMail')
                ->setHTMLBody($content)
                ->send();
    }
    
    public function actionRegformdata() {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $formFullData = $request['supplierdtls'];
        if(isset($request['certidtls']))
        {
          $formFullData =  array_merge($formFullData,$request['certidtls']);
        }
        $formFullData['Date']=date("Y-m-d");
        $formFullData = json_encode($formFullData);
        $path = dirname(__FILE__) . '/../../../../backend/json/registerform/';
        if(isset($request['ip']))
        {
             $ipaddress = $request['ip'];
        }
//        else
//        {
//            $ipdtls = json_decode(file_get_contents('https://api.ipdata.co/?api-key=0c2da7407889a3791f64747ca59ee1b2af9ee83aaaadf4b0ea2915a8'));
//        $ipaddress = $ipdtls->ip;
//        }
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $fp = fopen($path . Security::encrypt($ipaddress) . '.json', 'w');
        fwrite($fp, $formFullData);
        fclose($fp);
    }
    
    public function actionGetheadcountlist(){
        
        $stkpk = $_GET['stkpk'];
        $headcoundata = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_HeadCount',$stkpk);
        $anualsalesdata = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_AnnualSales',$stkpk); 
        $deptdata =  \common\models\DepartmentmstTbl::getDefaultDepartments();
        $officedata = \app\models\OfficetypemstTbl::getDefaultOfficeTypes();
        
        
        $GetHeadCount = array_column($headcoundata, 'ClM_HeadCount', 'ClM_HeadCount');
        $GetHeadCountAr = array_column($headcoundata, 'ClM_HeadCount_ar', 'ClM_HeadCount');
        $GetAnnualsales = array_column($anualsalesdata,'ClM_AnnualSales','ClM_AnnualSales');
        $GetAnnualsalesAr = array_column($anualsalesdata,'ClM_AnnualSales_ar','ClM_AnnualSales');
        $data['headcountlist'] = ['en'=>$GetHeadCount,'ar'=>$GetHeadCountAr];
        $data['annualsaleslist']= ['en'=>$GetAnnualsales,'ar'=>$GetAnnualsalesAr];
        
        $data['deptlist'] = $deptdata;
        $data['officelist'] = $officedata;
        return $data;
    }
    
    public function actionGetipdetails()
    {
        
        $request_body = file_get_contents('php://input');
        $response['dialCode'] = \api\modules\mst\models\CountryMasterQuery::getCountryByCountryCode($request_body);
        return $response;
    }
    
    public function actionGetpackagedtl() {

        $pageurlClient=$_SERVER['HTTP_CURRENTURL'];
        $pagelinkname = "";
        $data = [];
        $classificationPk = false;
        if(!empty($pageurlClient)){
            $linkdet = explode("/", $pageurlClient);
            $pagelinkname = $linkdet[1];
        }
        if(!empty($pageurlClient) && $pagelinkname =='scf'){
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $headcount = ($data['scfformdata']['headcount'] != '') ? $data['scfformdata']['headcount'] : 0;
            $annualsales = ($data['scfformdata']['annualsales'] != '') ? $data['scfformdata']['annualsales'] : 0;
            if(isset($data['scfformdata']['classificationPk']) && !empty($data['scfformdata']['classificationPk']))
                $classificationPk = $data['scfformdata']['classificationPk'];
        }else{
            $headcount = ($_REQUEST['headcount'] != '') ? $_REQUEST['headcount'] : 0;
            $stktype = ($_REQUEST['stktype'] != '') ? $_REQUEST['stktype']:0;
            $annualsales = ($_REQUEST['annualsales'] != '') ? $_REQUEST['annualsales'] : 0;
            $origin = $_REQUEST['origin'];
            $year =  isset($_REQUEST['years']) ? $_REQUEST['years'] : 1;
            if(isset($_REQUEST['classificationPk']) && !empty($_REQUEST['classificationPk']) && $_REQUEST['classificationPk']!= 'null' )
                $classificationPk = $_REQUEST['classificationPk'];
            else
                $classificationPk = false;
        }
        if($classificationPk==false || $classificationPk=="undefined"){
            $classficationDtl =  \api\modules\mst\models\ClassificationmstTblQuery::getClassification(['headCount' => $headcount, 'annualSales' => $annualsales,'stktype' => $stktype]);
        }else{
            if($classificationPk == "FCB" )
            {
               $classificationPk = ($stktype == 6) ? 17:35;
            }
            $classficationDtl =  \api\modules\mst\models\ClassificationmstTblQuery::getClassificationByPk(['classificationPk' => $classificationPk]);
            
            
        }
        if($origin  && $classificationPk==false)
        {
            if( $origin == 'I')
            {
                $classificationDtl = \api\modules\mst\models\ClassificationmstTbl::getInternationalClassification(['stktype' => $stktype]);
             
            $classificationPkArr = array_column((array) $classificationDtl, 'ClassificationMst_Pk');
                $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classificationPkArr, true);
            }
            else
            {
                 $classficationDtl =  \api\modules\mst\models\ClassificationmstTblQuery::getClassification(['headCount' => $headcount, 'annualSales' => $annualsales,'stktype' => $stktype]);
                $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassificationMultiple($classficationDtl);
            }
            
           
            $i = 0;
            foreach ($subscriptionDtl as $subs)
            {
               $submst = $subs->subscription;
                if (!empty($submst)) {
                    $data[$i]['headcount'] = $classficationDtl->ClM_HeadCount;
                    $data[$i]['annualsales'] =  $classficationDtl->ClM_AnnualSales;
                     $data[$i]['headcountar'] = $classficationDtl->ClM_HeadCount_ar;
                    $data[$i]['annualsalesar'] =  $classficationDtl->ClM_AnnualSales_ar;
                    $data[$i]['package_name'] = $subs->subscription->msm_packagename;
                    $data[$i]['classificationmst_pk'] =  $subs->mcbc_classificationmst_fk;
                    $data[$i]['currency'] = $subs->subscription->msm_basecurrency;
                    $data[$i]['baseamount'] = number_format($subs->subscription->msm_baseprice,3);
                    $data[$i]['yearsOfSub'] = \common\components\Common::getDurationByDays($subs->subscription->msm_duration)['Years'];
                }
                $i++;
          }
          
             return $data;
        
        }
        else{
             $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassificationMultiple($classficationDtl);
        }
        
        
        $submst = $subscriptionDtl[0]->subscription;
        
        
        if (!empty($submst)) {
            
            $data['amountinwords'] = \common\components\Common::AmountInWords($subscriptionDtl[0]->subscription->msm_baseprice,$origin);
            $data['amountinwordsar'] = \common\components\Common::AmountInWordsArabic($subscriptionDtl[0]->subscription->msm_baseprice,$origin);
           
            $data['submst'] = $submst;
            if($classficationDtl->ClM_ClassificationType == 'International')
            {
                $data['vatamount'] = 0.000;

            }
            else
            {
                $data['vatamount'] = number_format(($subscriptionDtl[0]->subscription->msm_baseprice/100)*\Yii::$app->params['vatpercentage'],3);

            }

            $data['vatpercentage'] = ($classficationDtl->ClM_ClassificationType == 'International')?0:\Yii::$app->params['vatpercentage'];
            $data['baseamount'] = number_format($subscriptionDtl[0]->subscription->msm_baseprice,3);
            $data['yearsOfSub'] = \common\components\Common::getDurationByDays($subscriptionDtl[0]->subscription->msm_duration)['Years'];
            $data['classificationmst'] = $classficationDtl;
            $data['subscribepk'] = Security::base64_encrypt_str($subscriptionDtl[0]->subscription->memsubscriptionmst_pk, 'bgiindia');
            $data['subsbyclassifpk'] = Security::base64_encrypt_str($subscriptionDtl[0]->memsubsbyclassif_pk, 'bgiindia');
            
            $data['totalamount'] = number_format($subscriptionDtl[0]->subscription->msm_baseprice+$data['vatamount'],3);
            
            if (\Yii::$app->params['discoutapplicable']) {
                $discount = \common\components\Common::getsubscriptionDiscount($submst);

                if ($discount) {
                    $data = array_merge($data, $discount);
                }
            }
        }
        return $data;
        
    }
    
    public function actionGetsubscribepacklookup() {
        $pack1 = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg();
        $annualSales = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_AnnualSales');
        $lookupTableClassi = '<table class="mociclassificationstable">  <thead> <tr> <th width="30%">Classification</th>  <th width="30%">Head Count</th> <th width="40%">Annual sales (OMR)</th> </tr> </thead>  <tbody>';
        $lookupTableAmt = '<table class="jsrsclassificationstable"> <thead> <tr> <th width="25%">Classification</th>  <th width="20%">Validity</th> <th width="25%">Certification Fee </th><th width="15%">VAT Charges(%)</th><th width="15%"><div class="form-group totooltip m-b-0">Total Payable Amount <a  href="#" title="" class="info-icon" tabindex="-1">
        <i class="fa font-20 fa-info-circle">
            <span class="popoverright bottom">
            Total Payable Amount = (Certification Fee+(Certification Fee*VAT Charges(%)/100))
            </span>
        </i>
    </a></div></th> </tr> </thead> <tbody>';
        foreach ($pack1 as $key => $lookup1) {
           $vatpercentage =  \Yii::$app->params['vatpercentage'];
            $vatamt = number_format(($lookup1['msm_baseprice']/100)*$vatpercentage,3);
            $cerfee = number_format($lookup1['msm_baseprice']+$vatamt,3);
            $amount = \common\components\Common::getDurationByDays($lookup1['msm_duration'])['Years'];
            $amount = ($amount > 1) ? $amount.' Years' : $amount.' Year';
            $lookupTableClassi .= '<tr> <td>' . $lookup1['ClM_ClassificationType'] . '</td> <td>' . $lookup1['ClM_HeadCount'] . '</td> <td>' . $annualSales[$key]['ClM_AnnualSales'] . '</td> </tr>';
            $lookupTableAmt .=' <td>' . $lookup1['ClM_ClassificationType'] . '</td> <td>' . $amount . '</td> <td> OMR ' . $lookup1['msm_baseprice'] . '</td><td>'.$vatpercentage.'%</td><td>  OMR '.$cerfee.'</td></tr>';
        }
        $lookupTableClassi .='</tbody>  </table>';
        $lookupTableAmt .='</tbody>  </table>';
        $response = $lookupTableClassi . '***' . $lookupTableAmt;
        return $response;
    }
    public function actionExpiry(){
        $curDate = date('Y-m-d'); 
        $Payment_grace_period = Yii::$app->params['Payment_grace_period'];
        $Payment_grace_period_end = Yii::$app->params['Payment_grace_period_end'];
        $Payment_grace_period_enquires = Yii::$app->params['Account_inactivation_period'];
        $Account_deactivation_period = Yii::$app->params['Account_deactivation_period'];
        $Account_deactivate_from = Yii::$app->params['Account_deactivate_from'];
                  /* changing status to 'NE'  Nearing Expiry  => before 1 to 30 days  from  expiry date */
        $NearingExpiry = \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN v_acchst b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk  set a.MRM_RenewalStatus='NE' where  (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','NE') or a.MRM_RenewalStatus is NULL)  AND c.UM_Status='A'  AND a.MRM_OrderConfrmStat = 'A' AND a.mrm_stkholdertypmst_fk= 6 AND a.MRM_Memberstatus='A' AND c.UM_Type = 'A'  AND DATEDIFF(b.mcaah_expirydate,DATE_ADD(NOW(), INTERVAL -1 DAY)) between 1 and 30")->execute();
                  /* changing status to 'E'   Expired  */
       $Expired =  \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  v_acchst b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='E' where  (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','E') or a.MRM_RenewalStatus is NULL) AND c.UM_Status='A' AND a.MRM_OrderConfrmStat = 'A' AND  a.mrm_stkholdertypmst_fk= 6 AND a.MRM_Memberstatus='A' AND c.UM_Type = 'A'   AND DATEDIFF(b.mcaah_expirydate,DATE_ADD(NOW(), INTERVAL -1 DAY))<=0")->execute();
               /* changing status to 'I'   In-activated => after  10 to  30 days from expiry date */
       $GracePrdExpired = \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  v_acchst b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='I' where  (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','I') or a.MRM_RenewalStatus is NULL) AND  a.MRM_MemberStatus='A' AND a.MRM_OrderConfrmStat = 'A' AND c.UM_Status='A' AND a.mrm_stkholdertypmst_fk= 6  AND c.UM_Type = 'A'  AND DATEDIFF(b.mcaah_expirydate,DATE_ADD(NOW(), INTERVAL -1 DAY))<=0 and DATEDIFF(NOW(),b.mcaah_expirydate) > $Payment_grace_period  and DATEDIFF(NOW(),b.mcaah_expirydate) <= $Payment_grace_period_enquires")->execute();
              /* changing status to 'GE'  => after  30 to 180 days  from expiry date */
      $aftergraceperd = \Yii::$app->db->createCommand("update  memberregistrationmst_tbl as mrm  join usermst_tbl as um on mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk join v_acchst as v on mrm.MemberRegMst_Pk = v.mcaah_memberregmst_fk set mrm.MRM_RenewalStatus = 'GE' where UM_Status = 'A' and UM_Type = 'A' AND mrm.MRM_Memberstatus='A' and (mrm.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','GE') or mrm.MRM_RenewalStatus is NULL) and DATEDIFF(current_date(),v.mcaah_expirydate) > 30")->execute(); 
        /* changing status to 'GE' and membersatus to 'I' - Deactivating account => after  180 th day from expiry date */
      $deactiavatemembers =   \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  v_acchst b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='GE', a.MRM_MemberStatus='I' where a.MRM_MemberStatus='A' AND c.UM_Status='A' AND a.mrm_stkholdertypmst_fk= 6  AND c.UM_Type = 'A'  AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','GE') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF(current_date(),b.mcaah_expirydate) >=  $Account_deactivate_from ")->execute();
//      Mail need to work
    }
    public function actionOrderconfirmationsts(){
        $curDate = date('Y-m-d'); 
        $activeDays = \Yii::$app->params['regConfirmDays'];
        $Account_deactivation_period = Yii::$app->params['Account_deactivation_period'];
                    /* New supplier who has registered but not accepted or cancelled registration after 45 th days  then those supplier will be deactivated  */
        \Yii::$app->db->createCommand("update memberregistrationmst_tbl a  set a.MRM_OrderConfrmStat='I' where a.MRM_OrderConfrmStat='N' AND  a.mrm_stkholdertypmst_fk= 6 AND a.MRM_MemberStatus = 'I'  AND DATEDIFF(NOW(),a.MRM_OCMLastSentOn) >=  $activeDays ")->execute();
                 /* New supplier who has registered but payment not done till 180 th days then those supplier will be deactivated */
        \Yii::$app->db->createCommand("update memberregistrationmst_tbl a join usermst_tbl b on a.MemberRegMst_Pk = b.UM_MemberRegMst_Fk SET MRM_MemberStatus = 'I', UM_Status = 'I', MRM_OrderConfrmStat = NULL where MRM_MemberStatus = 'V' AND  a.mrm_stkholdertypmst_fk= 6 AND MRM_AFVPStatus not in ('P','RC','RF','D')  AND  DATEDIFF(CURDATE(), MRM_OrderConfrmOn) >= $Account_deactivation_period")->execute();
                /*  changing status for New supplier who has registered but payment not done till 180 th days then those supplier will be deactivated */
        $Changestat = \Yii::$app->db->createCommand("SELECT MemberRegMst_Pk from memberregistrationmst_tbl a where a.MRM_MemberStatus ='V' AND a.MRM_OrderConfrmStat = 'A' AND a.mrm_stkholdertypmst_fk = 6  AND  a.MRM_AFVPStatus NOT IN('P','RC','RF','D') AND DATEDIFF('".$curDate."', DATE_ADD(a.MRM_OrderConfrmOn, INTERVAL -1 DAY)) > $Account_deactivation_period")->queryAll();
        if(!empty($Changestat)&& count($Changestat)>0){
            foreach ($Changestat as $value) {
                $Memreg=  MemberregistrationmstTbl::findOne($value['MemberRegMst_Pk']);
                $Memreg->MRM_MemberStatus='I';
                $Memreg->save(); 
                $comment= new MemcomprewapphstryTbl();
                $comment->mcrah_memberregistrationmst_fk  = $value['MemberRegMst_Pk'];
                $comment->mcrah_appstatus  ='C';
                $comment->mcrah_comment  ='Cancelled due to pending payment ('.$Account_deactivation_period.' days)';
                $comment->mcrah_approvedon  = $curDate;
                $comment->mcrah_approvedby  = '1';
                $comment->save();                
            }
        }        
//        remaninder payment mail need to work
    }
    
    public function actionApplypromocode() {
        
     $promocode = \common\components\Security::sanitizeInput($_REQUEST['promocode'], 'string');
     $classification = isset($_REQUEST['classfication'])? (array)json_decode($_REQUEST['classfication']) : null;
     $subsciptionpk = isset($_REQUEST['subsciptionpk'])? $_REQUEST['subsciptionpk'] : null;
     $countrypk = isset($_REQUEST['countrypk'])? $_REQUEST['countrypk'] : null;
     $subscribePk = Security::base64_decrypt_str($subsciptionpk, 'bgiindia');
     
     $subbyclass = \common\models\MemsubsbyclassifTbl::findOne($subscribePk);
     $submst = $subbyclass->subscription;
     
     $data['country'] = $countrypk;
     $data['promoCode'] = $promocode;
     $data['classification'] = $submst->memsubscriptionmst_pk;
     
     
     $promocodedata = \common\models\PromocodemstTbl::getPromoCodeDtls($data);
     if($promocodedata && \Yii::$app->params['promoapplicable'])
     { 
         if($promocodedata['pcm_isapplicable']==1 && (strtotime($promocodedata['pcm_promovalidto']) > time()))
         {
              $discount = \common\components\Common::getsubscriptionDiscount($submst,$promocodedata); 
              if($discount)
              {
                  $classification = array_merge($classification,$discount);
              }
             
         }
      }
     return $classification;       
    }
    
    public function actionGetfeedetails() {
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
      
                
         
      return $data;       
    }
    public function actionSupmeetreg() {
        if (isset($_POST)) {
            $comppk = base64_decode($_POST['id']);
            $userpk = base64_decode($_POST['uid']);
            $phone1=trim($_REQUEST['lanext'].' - '.$_POST['phone']);
            $phone=trim($phone1,'- ');
            $mobile1=trim($_REQUEST['mobext'].' - '.$_POST['Mobile']);
            $mobile=trim($mobile1,'- ');
            $supportmetting = new \common\models\BgismrpdtlsTbl();
            $supportmetting->bsmrpd_membercompanymst_fk = $comppk;
            $supportmetting->bsmrpd_bgimpurposemst_fk =$_POST['meetingPurpose'];
            $supportmetting->bsmrpd_emailid = $_POST['emailid'];
            $supportmetting->bsmrpd_cpname = $_POST['ContactPerson'];
            $supportmetting->bsmrpd_mobile = $mobile;
            $supportmetting->bsmrpd_phone = $phone;
            $supportmetting->bsmrpd_comments = $_POST['comments'];
            $supportmetting->bsmrpd_reqdate = date("Y-m-d", strtotime($_POST['ReqDate']));
            $supportmetting->bsmrpd_reqtime = $_POST['ReqTime'];
            $supportmetting->bsmrpd_reqloc = $_POST['location'];
            $supportmetting->bsmrpd_createdon = date('Y-m-d H:i:s');
            $supportmetting->bsmrpd_createdby = $userpk;
            if($supportmetting->save()){
                $supportset = new \common\models\BgismsuppattdtlsTbl();
                $supportset->bsmsuad_bgismrpdtls_fk = $supportmetting->bgismrpdtls_pk;
                $supportset->bsmsuad_attname = $_POST['Atend_Name_0'];          
                $supportset->bsmsuad_designation = $_POST['Atend_Desig_0'];
                $supportset->bsmsuad_email = $_POST['Atend_Mail_0'];
                $supportset->bsmsuad_attstatus = 'N';
                $supportset->save();
                $i = 0;
                $attend_desig = $_POST['Atend_Desig'];
                $attend_mail = $_POST['Atend_Mail'];
                if(isset($_POST['Atend_Name']) && !empty($_POST['Atend_Name'])){
                    foreach($_POST['Atend_Name'] as $attend_name){                               
                        $BGISMSuppAttDtls = new \common\models\BgismsuppattdtlsTbl();
                        $BGISMSuppAttDtls->bsmsuad_bgismrpdtls_fk= $supportmetting->bgismrpdtls_pk;
                        $BGISMSuppAttDtls->bsmsuad_attname = $attend_name;                                    
                        $BGISMSuppAttDtls->bsmsuad_designation = $attend_desig[$i];
                        $BGISMSuppAttDtls->bsmsuad_email = $attend_mail[$i];
                        $BGISMSuppAttDtls->bsmsuad_attstatus = 'N';
                        $BGISMSuppAttDtls->save();
                        $i++;
                    }
                }
                $fromMail = $supportmetting->bsmrpd_emailid;
                $_REQUEST['meetpurpose']=$supportmetting->bsmrpdBgimpurposemstFk->bgimpm_purpose;
                extract($_REQUEST);       
                $mailSubject = $jsrsno." - Meeting request on ".date('jS F Y',strtotime($ReqDate) );
                $renderArguments = compact('jsrsno','time','ReqTime','ReqDate','companyname','country','link','meetpurpose');
            $messageContent =  self::genMailContent('SUPPREG',$renderArguments);
            $mailContent =  self::mailContent($messageContent,$mailSubject);    
            \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo('jeeva@businessgateways.com')
//                        ->setTo(\Yii::$app->params['testMailIDs'])
                        ->setSubject($mailSubject)
                        ->setHTMLBody($mailContent)
                        ->send();
                return 'success***';
            }
        }
    }
    public function actionSuppinfo() {
        if (isset($_POST)) {
            $comppk = base64_decode($_POST['id']);
            $userpk = base64_decode($_POST['uid']);
            $membercompanyDtls = \common\models\MembercompanymstTbl::find() ->where('MemberCompMst_Pk = :comapnypk', [':comapnypk' => $comppk])->one();
            $userdetails = \common\models\UsermstTbl::find() ->where('UserMst_Pk = :userid', [':userid' => $userpk])->one();
            $data['memCompPk']=$membercompanyDtls->MemberCompMst_Pk;
            $data['compRegPk']=$membercompanyDtls->MCM_MemberRegMst_Fk;
            $data['regNo']=$membercompanyDtls->mcm_RegistrationNo;
            $data['companyName']=$membercompanyDtls->MCM_CompanyName;            
            $data['compEmail']=$membercompanyDtls->memcompmplocationdtlsprimary[0]->mcmpld_emailid;   
            $data['ConName']=$userdetails->um_firstname;        
            $data['contemail']=$userdetails->UM_EmailID;           
            $data['Phone']=$userdetails->um_landlineno;            
            $data['PhoneExt']=$userdetails->um_landlineext;            
            $data['MobileCC']=$userdetails->primobnocc->CyM_CountryDialCode;            
            $data['PhoneCC']=$userdetails->landlinecc->CyM_CountryDialCode;            
            $data['Mobile']=$userdetails->um_primobno;       
           $data['country'] = $membercompanyDtls->country->CyM_CountryName_en;
            return $data;
        }
    }

    public function actionCheckregisterdata(){
        $request_body = file_get_contents('php://input');
        $resParam = json_decode($request_body,true);
        $isValidreg = \common\components\User::checkValidreg($resParam['emailID']);
        if($isValidreg === 1){
            $msg['msg'] = 'deletedreg';
        }
       
        $msg['status'] = $isValidreg;
        return $this->asJson($msg);
        // if($model-> UM_Status == 'D'){
        //       return 1;
        // }

        // return $this->asJson([
        //     'data' => $model,
        //     'msg' => 'regDeleted',
        //     'status' => 100,
        // ]);
    }
    public function genMailContent($mtype,$renderArguments){
        if($mtype=='SUPPREG'){
            $messageContent = '
                    <tr style="width:100%;" valign="top"> 
                        <td colspan="2" style="color: #006db8;font-family: calibri;font-size: 16px;font-weight: 600;margin: 0;padding:20px 0 10px 0;text-align: left;" >  
                          Dear Team,
                        </td>
                    </tr>
                    <tr style="width:100%;" valign="top">  
                        <td colspan="2" width="100%" align="center" style="line-height:23px; text-align:left;font-family:calibri; margin:0px; font-size:15px; font-weight:500; color:#666666;padding-bottom: 10px;">
                            Got a meeting request from the below supplier
                        </td> 
                    </tr>
                    <tr style="width:100%;" valign="top">  
                    <td colspan="2" width="100%" align="center" style="line-height:23px; text-align:left;font-family:calibri; margin:0px; font-size:15px; font-weight:500; color:#666666;padding-bottom: 10px;">
                        <table cellpadding="0" style="font-size:12px; font-family:calibri;padding-left:30px" cellspacing="5" border="0">
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>NBF Number</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . $renderArguments['jsrsno'] . '</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>Company Name</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . $renderArguments['companyname'] . '</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>Country</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . $renderArguments['country'] . '</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>Purpose of Meeting</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . $renderArguments['meetpurpose'] . '</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>Meeting Request on</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . date('d-m-Y',strtotime($renderArguments['ReqDate'])) . '</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight6 black"><b>Timing</b></td>
                               <td class="font-13 f-weight6 black">&nbsp;:&nbsp;</td>
                               <td class="font-13 f-weight5 black">' . date('h:i A',strtotime($renderArguments['ReqTime'])) .' OST'.'</td>
                            </tr>
                            <tr valign="top">
                               <td class="font-13 f-weight5 black"><b><a href='.$renderArguments['link'].'>Click here</a> to view more</b></td>
                            </tr>
                           
                        </table>';
        }
        return $messageContent;
    }
    public function mailContent($messageContent,$mailSubject){        
        $content = '<table id="recommendReset" cellpadding="0" cellspacing="0" border="0" style="width:650px;background: #f4f4f4" align="center">
    <tbody>
        <tr> 
            <td>
                <div class="main-container">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr style="width:100%;">
                                <td width="50%" align="left" style="padding:10px;" >
                                    <img src="https://businessgateways.com/images/recom_mail/bgi_recom_logo.png" style="float:left; margin:10px;">
                                </td>
                                <td width="50%" align="right" style="padding:10px;" > 
                                    <img src="https://businessgateways.com/images/recom_mail/jsrs_recom_logo.png" style="float:right; margin:3px;">
                                </td>
                            </tr>                                                                    
                            <tr style="width:100%;">
                                <td width="100%" colspan="2" >
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tr style="width:100%;">                                           
                                            <td width="70%" align="left" style="background: #006db7 none repeat scroll 0 0;color: #fff;font-family: calibri;font-size: 20px;font-weight: 600;margin: 0;padding: 15px 15px 15px 16px;" >
                                                '.$mailSubject.'
                                            </td>
                                            <td width="30%" align="right" style="background:#e7e7e7; padding:15px 10px;" > 
                                                <img src="https://businessgateways.com/images/recom_mail/nbf_recom_logo.png" style="float:left;" >
                                            </td>
                                        </tr>                                           
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2" style="padding:0px 16px;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>                                            
                                            '.$messageContent.'
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="height:50px; width:100%; background:#f4f4f4;" valign="top"> 
                                <td colspan="2" style="text-align:center; font-family:calibri; padding:11px 0; font-size:12px; color:#666666; font-weight:600;" align="center">
                                    <table width="160" style="width:160px;margin: auto;float: none" align="center">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 11px;padding-bottom:10px; font-weight:600; font-family:calibri,sans-serif;  color:#666666; width: 100%;text-align:center;">
                                                    CONNECT WITH US
                                                </td> 
                                            </tr>  
                                            <tr>
                                                <td style="text-align: center">
                                                    <img src="https://businessgateways.com/images/email/social-network.png?ver=1" style="width:auto;text-decoration: none;border: none;max-width: none;" alt="Social Media Icon" usemap="#planetmapIcon">
                                                    <map name="planetmapIcon" style="text-decoration: none">
                                                                    <area style="text-decoration: none" shape="rect" alt="Bgi" title="Bgi" coords="1,2,23,25" href="https://businessgateways.com/BGI" target="_blank" />
                                                                    <area style="text-decoration: none" shape="circle" alt="Facebook" title="Facebook" coords="52,15,14" href="https://www.facebook.com/BGIInsights/" target="_blank" />
                                                                    <area style="text-decoration: none" shape="circle" alt="Youtube" title="Youtube" coords="92,13,14" href="https://www.youtube.com/channel/UC7soraE_QQBjqiMX8t8rWPA" target="_blank" />
                                                                    <area style="text-decoration: none" shape="circle" alt="Linkedin" title="Linkedin" coords="134,14,13" href=" https://www.linkedin.com/company/business-gateways-international-llc" target="_blank" />
                                                                    <area style="text-decoration: none" shape="circle" alt="Twitter" title="Twitter" coords="175,14,13" href=" https://twitter.com/BGIInsights/" target="_blank" />                                                               
                                                            </map>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="width:100%;background:#f0efed;"><td style="height:20px;"><td style="height:20px;"></td></tr>
                            <tr style="height:50px; width:100%; background:#f0efed;" valign="top">
                                <td colspan="2" align="center" style=" color:#404040; font-size:25px; font-family:calibri; font-weight:500; text-align:center;">                                    
                                    <a width="100%" href="www.businessgateways.com" style="text-decoration:none;color:#333333;" target="_blank">www.<span style="color:#f38120">business</span><span style="color:#0c6db6">gateways</span>.com</a>
                                </td>
                            </tr>
                            <tr style="width:100%; background:#f27e19;">
                                <td colspan="2" style="text-align:center; padding:5px 0 0px 0;font-family:calibri ; font-size:12px; font-weight:600;">
                                    <table style="width:100%; border:none;background:#f27e19;" align="center">
                                        <tbody>                                            
                                            <tr valign="top">
                                                <td style="text-align:center; font-family:calibri;padding:0; font-size:13px; color:#fff; font-weight:500;">
                                                    <label style="font-size: 16px">Business Gateways International LLC</label><br>
                                                    Office 14, Building 4, Knowledge Oasis Muscat(KOM), Rusayl, Sultanate of Oman<br>
                                                    Tel : +968 24166123 Fax: +968 24170045 <br>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr valign="top" style="background:#f27e19;">
                                <td colspan="2" style="text-align:center; font-family:calibri;padding:10px 0 10px 0; font-size:12px; color:#fff;">
                                    Copyright @ '.Date('Y').' Business Gateways International LLC. All Rights Reserved.                                    
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>';
        return $content;
    }
}