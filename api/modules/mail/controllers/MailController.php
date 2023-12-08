<?php

namespace api\modules\mail\controllers;

use app\filters\auth\HttpBearerAuth;
use common\models\UsermstTbl;
use Yii;
use yii\helpers\Json;
use yii\rbac\Permission;
use \common\components\Configuration;
use yii\web\HttpException;
use sizeg\jwt\Jwt;
use yii\rest\Controller;
use \common\models\UsermstTblQuery;
use common\components\Common;
use \api\components\Security;
use backend\models\MaildevTemplates;
use backend\models\Modules;
use backend\models\MaildevSystemfields;
use backend\models\MaillistingTbl;
use backend\models\MaildevTemplatesHsty;
use ZipArchive;
use Exception;

/**
* Mail controller for the `mail` module
*/

class MailController extends Controller {

    public $modelClass = '\common\models\DepartmentmstTbl';
    private $format = 'json';

    public function __construct( $id, $module, $config = [] ) {
        parent::__construct( $id, $module, $config );
    }

    public function actions() {
        return [];
    }

    public function behaviors() {
        $behaviors = parent::behaviors();

        /**/
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors[ 'corsFilter' ] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => [ '*' ],
                'Access-Control-Request-Method' => [ 'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS' ],
                'Access-Control-Request-Headers' => [ '*' ],
            ],
        ];

        return $behaviors;
    }

    /**
    * Handle the login process for staff members for backend dashboard
    *
    * Request: POST /v1/mail/mail/send
    *
    *
    * @return \yii\web\Response
    * @throws HttpException
    */
 public function actionSendmailtest() {
     ini_set('display_errors', 1);
         echo 'working';

        \Yii::$app->mailer->compose()
                         ->setFrom('noreply@usp.opaloman.om')
                         ->setTo('sapna@yopmail.com')
                         ->setSubject('Test Mail OPAL')
                         ->setHTMLBody('testmail demo')
                         ->send();
                         exit;
 }
 
    public function actionSendmail() {
      
        if ( isset( $_REQUEST[ 'type' ] ) ) {
            $data[ 'type' ] = $_REQUEST[ 'type' ];
            $data[ 'userpk' ] = $_REQUEST[ 'userpk' ];
            $data[ 'apptmpPk' ] = $_REQUEST[ 'apptmpPk' ];
            $data[ 'regPk' ] = $_REQUEST[ 'regPk' ];
            $data[ 'usercrPk' ] = $_REQUEST[ 'usercrPk' ];
            $data[ 'batchpk' ] = $_REQUEST[ 'batchpk' ];
            $data[ 'theorypk' ] = $_REQUEST[ 'theorypk' ];
            $data[ 'learnerId' ] = $_REQUEST[ 'learnerId' ];
            $data[ 'learnerName' ] = $_REQUEST[ 'learnerName' ];
            $data[ 'oldaccesspk' ] = $_REQUEST[ 'oldaccesspk' ];
            $data[ 'newaccesspk' ] = $_REQUEST[ 'newaccesspk' ];
            $data[ 'newivpk' ] = $_REQUEST[ 'newivpk' ];
            $data[ 'oldivpk' ] = $_REQUEST[ 'oldivpk' ];
            $data[ 'name' ] = $_REQUEST[ 'name' ];
            $data[ 'id' ] = $_REQUEST[ 'id' ];
            $data[ 'staffpk' ] = $_REQUEST[ 'staffpk' ];
            $data[ 'learnerpk' ] = $_REQUEST[ 'learnerpk' ];
            $data[ 'tutormail' ] = $_REQUEST[ 'tutormail' ];
            $data[ 'tutorname' ] = $_REQUEST[ 'tutorname' ];
      
            $view = $_REQUEST[ 'view' ];
            $data[ 'attrbts' ] = $_REQUEST['attrbts'];
        } else {
            $request_body = file_get_contents( 'php://input' );
            $data = json_decode( $request_body, true );
            $view = null;
        }
        

// $data = [
//    'type' => 'resubmitted',
//    'userpk'=> '',
//    'batchpk'=>'33844',
//    'apptmpPk' =>'355',
//    'regPk' => 92,
//    'usercrPk' => ''
//];



        if ( $data ) {
            $type = $data[ 'type' ];
            $userpk = $data[ 'userpk' ];
            $apptmpPk  = $data[ 'apptmpPk' ];
            $batchpk = $data[ 'batchpk' ];
            $learnerId =  $data[ 'learnerId' ];
            $learnerName =  $data[ 'learnerName' ];
            $theorypk = $data[ 'theorypk' ];
            $regPk  = $data[ 'regPk' ];
            $usercrPk  = $data[ 'usercrPk' ];
            $oldaccesspk = $data['oldaccesspk'];
            $newaccesspk = $data['newaccesspk'];
            $newivpk = $data['newivpk'];
            $oldivpk = $data['oldivpk'];
            $learnerpk =  $data['learnerpk'];
            $id = $data['id'];
            $tutormail = $data['tutormail'];
            $tutorname = $data['tutorname'];
            $staffpk = $data['staffpk'];
            $name = $data['name'];              
            $link = $data[ 'link' ];
            $jsondtl = $data[ 'jsondtl' ];
            $mailcc = $data['mailcc'];
            $fdata = $data['data'];
            $applicationpk =  $data['applictionpk'];
            $attrbts = $data[ 'attrbts' ];
    
            $queryparams = '?';
            foreach ( $data as $key => $value ) {
                $queryparams .= $key . '=' . urlencode( $value ) . '&';

            }
            
            $baseUrl = \Yii::$app->params['baseUrl'];
            Yii::$app->response->statusCode = 200;
          
            switch( $type )
 {
  
                    case 'suppreg' : 
                    $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'to' ] = $model[ 'emailid' ];
                    $mail['heading'] = 'OPAL USP:'.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $mail['companyname_en'] = $model['companyname_en'];
                    $mail['companyname_ar'] = $model['companyname_ar'];
                    $mail[ 'subject' ] = 'OPAL USP: '.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation - Your Action Required';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Your Confirmation is required to progress further on the Registration Process';
                    $preheadertext_ar = 'يرجى تأكيد البريد الإلكتروني لمتابعة عملية التسجيل ';
                    $content = $this->renderPartial( '..\supplierregmail', [ 'model' => $model,'preheadertext' => $preheadertext , 'link' => $link] );
                    $content_ar = $this->renderPartial( '..\supplierregmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ,'link' => $link ] );
                    break;
                
                    case 'differntfocalpoint_1' : 
                    $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                    $diffuser = $data['diffuser'];
                    $sameuser = $data['sameuser'];
                    $mail[ 'to' ] = $model[ 'emailid' ];
                    $mail['heading'] = 'OPAL USP:'.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $mail['companyname_en'] = $sameuser['oum_firstname'];
                    $mail['companyname_ar'] = $sameuser['oum_firstname'];
                    $mail[ 'subject' ] = 'OPAL USP: '.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation - Your Action Required';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Your Confirmation is required to progress further on the Registration Process';
                    $preheadertext_ar = 'يرجى تأكيد البريد الإلكتروني لمتابعة عملية التسجيل ';
                    $content = $this->renderPartial( '..\differntfocalpoint_1', [ 'model' => $model,'preheadertext' => $preheadertext , 'link' => $link,'diffuser'=>$diffuser,'sameuser'=>$sameuser] );
                    break;
                    case 'differntfocalpoint_2' : 
                    $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'to' ] = $model[ 'emailid' ];
                    $diffuser = $data[ 'diffuser'];
                    $sameuser = $data[ 'sameuser'];

                    $mail['heading'] = 'OPAL USP:'.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $mail['companyname_en'] = $diffuser['oum_firstname'];
                    $mail['companyname_ar'] = $diffuser['oum_firstname'];
                    $mail[ 'subject' ] = 'OPAL USP: '.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation - Your Action Required';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Your Confirmation is required to progress further on the Registration Process';
                    $preheadertext_ar = 'يرجى تأكيد البريد الإلكتروني لمتابعة عملية التسجيل ';
                    $content = $this->renderPartial( '..\differntfocalpoint_2', [ 'model' => $model,'preheadertext' => $preheadertext , 'link' => $link,'diffuser'=>$diffuser,'sameuser'=>$sameuser] );
                    break;
                    case 'differntfocalpoint_3' : 
                    $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'to' ] = $model[ 'emailid' ];
                    $diffuser = $data[ 'diffuser'];
                    $sameuser = $data[ 'sameuser'];

                    $mail['heading'] = 'OPAL USP:'.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $mail['companyname_en'] = $model['fullName'];
                    $mail['companyname_ar'] = $model['fullName'];
                    $mail[ 'subject' ] = 'OPAL USP: '.$model['traineeOrTech'] .' Evaluation Centre Registration Confirmation - Your Action Required';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Your Confirmation is required to progress further on the Registration Process';
                    $preheadertext_ar = 'يرجى تأكيد البريد الإلكتروني لمتابعة عملية التسجيل ';
                    $content = $this->renderPartial( '..\differntfocalpoint_3', [ 'model' => $model,'preheadertext' => $preheadertext , 'link' => $link] );
                    break;
                    

                //7. When the User verifies the email ID
                // 7.1.Mail to the respective User with OTP for verification ( regform )
                case 'emailverifyjson' :
                    $jsondtl =  json_decode(Security::decrypt($jsondtl),true);
                    $mail[ 'subject' ] = 'OPAL: OTP for Verification of Email ID';
                    $mail_ar[ 'subject' ] = 'OPAL: OTP for Verification of Email ID';
                    $mail[ 'to' ] = $model[ 'email' ];
                    $preheadertext = 'OTP is valid only for ' . $jsondtl[ 'duration' ] . ' minutes';
                    $preheadertext_ar = 'كلمة المرور المؤقتة صالحة لمدة ' . $jsondtl[ 'duration' ] . ' دقايق';
                    $content = $this->renderPartial( '..\otpverify', [ 'model' => $jsondtl, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\otpverify_ar', [ 'model' => $jsondtl, 'preheadertext' => $preheadertext_ar ] );
                    break;

                    // 2	When Centre set password
                    // 2.1	Mail to the registered training evaluation centre focal point with the credentials
                    case 'aftersetpasswordCrd' :
                    $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                        $mail[ 'to' ] = $model[ 'emailid' ];
                        $mail['heading'] = 'OPAL USP: Portal Login Credentials';
                        $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: بيانات تسجيل الدخول في المنصة ';
                        $mail['companyname_en'] = $model['companyname_en'];
                        $mail['companyname_ar'] = $model['companyname_ar'];
                        $mail[ 'subject' ] = 'OPAL USP: Portal Login Credentials';
                        $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                        $preheadertext = 'Login to apply for Centre Certification';//need to check for 2.2
                        $preheadertext_ar = 'يرجى تأكيد البريد الإلكتروني لمتابعة عملية التسجيل ';
                        $content = $this->renderPartial( '..\supplierafterregmail', [ 'model' => $model,'preheadertext' => $preheadertext,'link' => $link  ] );
                        $content_ar = $this->renderPartial( '..\supplierafterregmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ,'link' => $link ] );
                        break;
                    
                //Registration Mail Ends Here
                
                //Account Settings starts

                // 1	When Admin/User request to change password (Forgot Password)
                // 1.1	Mail to the admin/user (whoever have requested for forgot password) with the link or OTP to reset the password
                case 'reqtochangepswcontent' : 
                    $mailtype = 'setpassword';
                    $model = \api\components\Mail::getForgotPassMailDtls($userpk,$mailtype);
                    $mail['to'] = $model['email'];
                    $mail['heading'] = 'OPAL USP: OTP to reset your Password';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: بيانات تسجيل الدخول في المنصة ';
                    $mail['companyname_en'] = $model['user_name'];
                    $mail['companyname_ar'] = $model['user_name'];
                    $mail['subject'] = 'OPAL USP: OTP to reset your Password';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Use the OTP or click the link to reset your password';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة أو انقر على الرابط لإعادة تعيين كلمة المرور';
                    $content = $this->renderPartial('..\reqtochangepsw', ['model' => $model,'preheadertext' => $preheadertext,'link'=>$link]);
                    $content_ar = $this->renderPartial('..\reqtochangepsw_ar', ['model' => $model,'preheadertext' => $preheadertext_ar,'link'=>$link]);
                    break;
                    // 2	When Admin/User tries to Change Password / Email ID (Account Settings)
                    // 2.1	Mail to admin/user with the OTP to change password                
                case 'otptochangepswcontent' :
                    $mailtype='setpassword';
                    $model = \api\components\Mail::getForgotPassMailDtls($userpk,$mailtype);
                    $mail['to'] = $model['email'];
                    $mail['heading'] = 'OPAL USP: OTP to Change your Password';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: بيانات تسجيل الدخول في المنصة ';
                    $mail['companyname_en'] = $model['user_name'];
                    $mail['companyname_ar'] = $model['user_name'];
                    $mail['subject'] = 'OPAL USP: OTP to Change your Password';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Use the OTP to confirm the update';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة للتأكيد التغيير';
                    $content = $this->renderPartial('..\otptochangepsw', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\otptochangepsw_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;
                    
                    // 2.2	Mail to admin/user with the OTP to change Email ID
                case 'otptochangeemlcontent' : 
                    $mailtype = 'emailverify';
                    $model = \api\components\Mail::getForgotPassMailDtls($userpk,$mailtype);
                    $mail['to'] = $data['email'];
                    
                    $mail['heading'] = 'OPAL USP: OTP to Change your Email ID ';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: بيانات تسجيل الدخول في المنصة ';
                    $mail['companyname_en'] = $model['user_name'];
                    $mail['companyname_ar'] = $model['user_name'];
                    $mail['subject'] = 'OPAL USP: OTP to Change your Email ID ';
                    $mail[ 'subject_ar' ] = 'منصة أوبال للخدمات الموحدة: تأكيد تسجيل مركز التقييم الفني';
                    $preheadertext = 'Use the OTP to confirm the update';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة للتأكيد التغيير';
                    $content = $this->renderPartial('..\otptochangeemail', ['model' => $model ,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\otptochangeemail_ar', ['model' => $model ,'preheadertext' => $preheadertext_ar]);
                    break;

                case 'sucessafterresetpw' :
                    $model = \api\components\Mail::getForgotPassMailDtls($userpk);
                    $mail['to'] = $model['email'];
                    $mail['heading'] = 'OPAL USP: Account Password updated Successfully';
                    $mail['heading_ar'] = 'منصة أوبال للخدمات الموحدة: بيانات تسجيل الدخول في المنصة ';
                    $mail['companyname_en'] = $model['user_name'];
                    $mail['companyname_ar'] = $model['user_name'];
                    $mail['subject'] = 'OPAL USP: Account Password updated Successfully';
                    $mail['subject_ar'] = 'OPAL USP: Account Password updated Successfully';
                    $preheadertext = 'Your password has been updated';
                    $preheadertext_ar = 'كلمة مرور الحساب/البريد الإلكتروني/ الهاتف النقال';
                    $content = $this->renderPartial('..\mailtoadminoruser', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\mailtoadminoruser_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;

                case 'contactus' : 
                $model =  \app\models\OpalcontactusdtlsTbl::findOne($userpk);
                if($model['ocud_conttype']==2){
                    $model_1 = \api\components\Mail::getsupplierregmaildtls($model['ocud_opalusermst_fk']);
                }
                //mail To:- OPAL Admin's Email ID
                $mail['to'] = 'usp@opaloman.org';
                $mail['subject'] = 'OPAL USP: '.$model['ocud_subject'];
                $mail['subject_ar'] = 'منصة أوبال للخدمات الموحدة: '.$model['ocud_subject'];
                $mail['heading'] = 'OPAL USP: '.$model['ocud_subject'];
                $mail['heading_ar'] =  'منصة أوبال للخدمات الموحدة: '.$model['ocud_subject'];
                $preheadertext = 'Kindly do the needful ';
                $preheadertext_ar = 'الرجاء المساعدة';
                $attach_link = $this->getAttachmentsContact($model['ocud_opalmemcompfiledtls_fk']);
                $querymst = \app\models\OpalcontactquerymstTbl::findOne($model['ocud_opalcontactquerymst_fk']);
                $content = $this->renderPartial( '..\contactmail', [ 'model' => $model, 'model_1'=> $model_1, 'preheadertext' => $preheadertext , 'attach_link' => $attach_link , 'query' =>$querymst['ocqm_contactquery']] );
                $content_ar = $this->renderPartial( '..\contactmail_ar', [ 'model' => $model,'model_1'=> $model_1, 'preheadertext' => $preheadertext_ar ,'attach_link' => $attach_link , 'query' =>$querymst['ocqm_contactquery'] ] );             
                break;

          
                case 'passedlearnerFeedback' :
                    $status ='A';
                    $model = \api\components\Mail::learnersFeedback($userpk,$status,$batchpk);
                    $mail['to']=$model['emailId'];
                    $mail['companyname_en'] = $model['name_en'];
                    $mail['companyname_ar'] = $model['name_ar'];
                    $mail['heading'] = 'OPAL USP: Submit your Feedback for the Course ('.$model['subtitle'].')';
                    $mail['subject'] = 'OPAL USP: Submit your Feedback for the Course ('.$model['subtitle'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\feedbackPassedLearner', [ 'model' => $model, 'preheadertext' => $preheadertext,'status'=>$status] );
                    break;
                
                case 'faillearnerFeedback' :
                    $status='F';
                    $model = \api\components\Mail::learnersFeedback($userpk,$status,$batchpk);
                    $mail['to']=$model['emailId'];
                    $mail['companyname_en'] = $model['name_en'];
                    $mail['companyname_ar'] = $model['name_ar'];
                    $mail['heading'] = 'OPAL USP: Submit your Feedback for the Course ('.$model['subtitle'].')';
                    $mail['subject'] = 'OPAL USP: Submit your Feedback for the Course ('.$model['subtitle'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\feedbackPassedLearner', [ 'model' => $model, 'preheadertext' => $preheadertext,'status'=>$status,] );
                    break;

                case 'enterpriseadmintoactive' :
                    $model = \api\components\Mail::geteadminuserdata($userpk);
                    $mail['to']=$model['emailid'];
                    $mail['companyname_en'] = $model['UserName_en'];
                    $mail['companyname_ar'] = $model['UserName_en'];
                    $mail['heading'] = 'OPAL USP: User Account Created - Verify email ID to activate';
                    $mail['subject'] = 'OPAL USP: User Account Created - Verify email ID to activate';
                    $preheadertext = 'Join as a User on OPAL USP';
                    $content = $this->renderPartial( '..\enterpriseadmintoactive', [ 'model' => $model, 'preheadertext' => $preheadertext,'link'=>$link] );
                    break;

                case 'enterpriseadmintologin' :
                    $model = \api\components\Mail::geteadminuserdata($userpk);
                    $mail['to']=$model['emailid'];
                    $mail['companyname_en'] = $model['UserName_en'];
                    $mail['companyname_ar'] = $model['UserName_en'];
                    $mail['heading'] = 'OPAL USP: Password Updated Successfully';
                    $mail['subject'] = 'OPAL USP: Password Updated Successfully';
                    $preheadertext = 'Your password has been set, you can now login to OPAL USP';
                    $content = $this->renderPartial( '..\enterpriseadmintologin', [ 'model' => $model, 'preheadertext' => $preheadertext] );
                    break;

//                Release Date 15.09.2023
                
                    case 'befcersubmit':
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;   
                    $pk = Security::encrypt($certiData['pk']);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'centrecertification/desktopreview/' . $pk . '/desktopreview/MQ%3D%3D';
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Desktop Review (' . $certiData['appRefNo'] . ')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Desktop Review (' . $certiData['appRefNo'] . ')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial('..\befcersubmitfordesvw', ['certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext, 'navlink' => $navlink]);    
                    break;

                    case 'cerDeclined' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Application Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Application Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\certifdecline', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext ,'navlink' => $navlink] );
                    break;
                
                    case 'resubmit' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/desktopreview/' . $pk . '/desktopreview/MQ%3D%3D';                  
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Resubmitted for Desktop Review ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Resubmitted for Desktop Review ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\resubmit', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'approvedCr' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);  
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc'; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Application Approved ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Application Approved ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\approvedCrt', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'getPayment' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;   
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoice/details?id='.$pk.                  
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Received ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Received ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\getPaymentsts', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;

                    case 'payDecline' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc'; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\paymtDecline', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'revergetPayment' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                     $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoice/details?id='.$pk;                 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Received ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate - Payment Received ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\revergetPayment', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;

                    case 'paymentrecd' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc';                    
                    $mail['heading'] = 'OPAL USP: Confirm Site Audit Date for Centre Certification ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Confirm Site Audit Date for Centre Certification ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Confirm the date';
                    $content = $this->renderPartial( '..\paymentrecd', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'tpconfrimdt' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$certiData['siteAuditmail'];  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk. 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre - Site Audit Date Confirmed ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre - Site Audit Date Confirmed ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\tpconfrimdt', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'opalAudApp' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\opalAudApp', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'qualityAppro' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=NA%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\qualityAppro', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'declineAuditor' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.                  
                    $mail['heading'] = 'OPAL USP: Site Audit Report Status - Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report Status - Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\declineAuditor', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'requalityAppro' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Re-validate';
                    $content = $this->renderPartial( '..\requalityAppro', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'authorityApproforceo' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Re-validate';
                    $content = $this->renderPartial( '..\authorityApproforceo', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;

                    case 'approvedCer' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                   $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre'; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre eCertificate ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre eCertificate ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Re-validate';
                    $content = $this->renderPartial( '..\approvedCer', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;   
                
//                Training Centre (Before Certification) Ends
                
                
//                Renewal => Training Centre
                         
                    case 'rebefcersubmit' :                       
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;     
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/desktopreview/' . $pk . '/desktopreview/MQ%3D%3D';
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Desktop Review ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Desktop Review ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\rebefcersubmitfordesvw', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext , 'navlink' => $navlink] );
                    break;
                
                    case 'recerDeclined' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData[focalemail];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $navlink = $backendBaseUrl .'trainingcentremanagement/maincentre?renew';
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Application Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Application Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\recertifdecline', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext ,'navlink'=> $navlink] );
                    break;
                
                    case 'reresubmit' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/desktopreview/' . $pk . '/desktopreview/MQ%3D%3D';        
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Resubmitted for Desktop Review ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Resubmitted for Desktop Review ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\reresubmit', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'reapprovedCr' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);                
                    $mail['to']=$certiData[focalemail];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc';    
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Application Approved ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Application Approved ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\reapprovedCrt', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'regetPayment' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoice/details?id='.$pk;
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Received ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Received ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\regetPaymentsts', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'repayDecline' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData[focalemail];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc'; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\repaymtDecline', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'renrevergetPayment' :
                    $certiData =\api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;  
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoice/details?id='.$pk;  
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Received ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Payment Received ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\renrevergetPayment', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'recnfmSiteAudit' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData[focalemail];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $typ = Security::encrypt($certiData['apptyp']);
                    $sts = Security::encrypt($certiData['status']);
                    $projpk = Security::encrypt($certiData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=paycnt&f=mc';     
                    $mail['heading'] = 'OPAL USP: Confirm Site Audit Date for Centre Certification Renewal ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Confirm Site Audit Date for Centre Certification Renewal ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Confirm the date';
                    $content = $this->renderPartial( '..\reConfrmsit', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'retpconfrimdt' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$certiData['siteAuditmail']; 
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Site Audit Date Confirmed ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre Certificate Renewal - Site Audit Date Confirmed ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\retpconfrimdt', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'reopalAudApp' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$id;  
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\reopalAudApp', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'renewqualityAppro' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$id;  
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=NA%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\renewqualityAppro', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'redeclineAuditor' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$id;  
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk;
                    $mail['heading'] = 'OPAL USP: Site Audit Report Status - Declined ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report Status - Declined ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\redeclineAuditor', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'renrequalityAppro' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$id;  
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D';  
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Re-validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to Re-validate';
                    $content = $this->renderPartial( '..\renrequalityAppro', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'reauthorityApproforceo' :
                    $certiData = \api\components\Mail::sprCertifcateDtls($apptmpPk,$regPk,$id,$name);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$id;  
                    $pk = Security::encrypt($certiData['pk']);
                    $navlink = $baseUrl . 'centrecertification/siteaudit?id='.$pk.'&view=Mw%3D%3D'; 
                    $mail['heading'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Site Audit Report received for Validation ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\reauthorityApproforceo', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'reapprovedCer' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre'; 
                    $mail['heading'] = 'OPAL USP: Training Evaluation Centre eCertificate - Renewed ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Training Evaluation Centre eCertificate - Renewed ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Congratulations! You have successfully renewed you Certificate';
                    $content = $this->renderPartial( '..\reapprovedCer', [ 'certiData' => $certiData,'name' => $name, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'remindermail' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = 'Your Training Evaluation Centre Certificate is expiring soon ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'Your Training Evaluation Centre Certificate is expiring soon ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Congratulations! You have successfully renewed you Certificate';
                    $content = $this->renderPartial( '..\remindermail', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'expiredmail' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = 'OPAL USP: Your Training Evaluation Centre Certificate has Expired ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Your Training Evaluation Centre Certificate has Expired ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to renew if you wish to use our Services on OPAL USP';
                    $content = $this->renderPartial( '..\expiredmail', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'crexpiredmail' :
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = 'Your '.$courseData['projectname'].'  Certificate has Expired  ('.$courseData['appno'].')';
                    $mail['subject'] = 'Your '.$courseData['projectname'].'  Certificate has Expired  ('.$courseData['appno'].')';
                    $preheadertext = 'Login to renew if you wish to use our Services on OPAL USP';
                    $content = $this->renderPartial( '..\crexpiredmail', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'resuspendmail' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = 'OPAL USP: Your Training Evaluation Centre Certificate - Suspended  ('.$certiData['appRefNo'].')';
                    $mail['subject'] = 'OPAL USP: Your Training Evaluation Centre Certificate - Suspended  ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to renew if you wish to use our Services on OPAL USP';
                    $content = $this->renderPartial( '..\resuspendmail', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'reactivamail' :
                    $certiData = \api\components\Mail::getCertifcateDtls($apptmpPk,$regPk);
                    $mail['to']=$certiData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: Your Training Evaluation Centre Certificate - Re-activated ('.$certiData['appRefNo'].')';
                    $mail['subject'] = ' OPAL USP: Your Training Evaluation Centre Certificate - Re-activated ('.$certiData['appRefNo'].')';
                    $preheadertext = 'Login to renew if you wish to use our Services on OPAL USP';
                    $content = $this->renderPartial( '..\reactivamail', [ 'certiData' => $certiData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
//                Before Certification Course
                    case 'courdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\courdesk', [ 'courseData' => $courseData,'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'crdecldesk' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home?rt=no';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\crdecldesk', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                     case 'recourdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\recourdesk', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'crapproved' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                   $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc'; 
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Application Approved ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Application Approved ('.$courseData['appno'].')';
                    $preheadertext = 'Complete payment for Site Audit';
                    $content = $this->renderPartial( '..\crapproved', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
   
                    case 'crgetPayment' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\crgetPayment', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;    
                
                    case 'crpayDecline' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc'; 
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Kindly try alternate payment method';
                    $content = $this->renderPartial( '..\crpayDecline', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'crregetPay' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\crregetPay', [ 'courseData' => $courseData, 'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'crpaymentrecd' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc'; 
                    $mail['heading'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectname'].' ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectname'].' ('.$courseData['appno'].')';
                    $preheadertext = 'Login to Confirm the date';
                    $content = $this->renderPartial( '..\crpaymentrecd', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'crconfrimdt' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\crconfrimdt', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'cropalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\cropalAup', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'cropalqualma' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\cropalqualma', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
  
                    case 'crdecline' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\crdecline', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
          
                    case 'crreopalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\crreopalAup', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'courapproved' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre';
                    $mail['heading'] = ' '.$courseData['projectname'].'  eCertificate ('.$courseData['appno'].')';
                    $mail['subject'] =  ' '.$courseData['projectname'].'  eCertificate ('.$courseData['appno'].')';
                    $preheadertext = 'Congratulations! You now have a certified  '.$courseData['projectname'].' on OPAL USP';
                    $content = $this->renderPartial( '..\courapproved', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
 
//                After Certification - Course
                
                    case 'rencourdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal  - Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal  - Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\rencourdesk', [ 'courseData' => $courseData,'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    
                    
                    case 'updcourdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Update  - Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Update  - Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\updcourdesk', [ 'courseData' => $courseData,'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
					
                    case 'rencrdecldesk' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home?rt=no';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\rencrdecldesk', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'updcrdecldesk' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $apptype = Security::encrypt('update');
                    $navlink = $baseUrl . 'standardcourse/home?renew=MQ==&ap=' . $pk . '&pr='.$projpk.'$ty='. $apptype .'&as='. $sts .'&at='.$typ; 
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Application Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Application Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\updcrdecldesk', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
				
                
                
                    case 'renrecourdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\renrecourdesk', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'reupdcourdesk' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id='.$pk.'&app_ref_id='.$courseData['appno'].'';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].'  - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].'  - Resubmitted for Desktop Review ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\reupdcourdesk', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
					
                    case 'rencrapproved' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'trainingcentremanagement/maincentre?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc'; 
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Application Approved ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Application Approved ('.$courseData['appno'].')';
                    $preheadertext = 'Complete payment for Site Audit';
                    $content = $this->renderPartial( '..\rencrapproved', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
			
//                Added 
                    case 'updnewadded' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'standardcourse/home?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' - Application Approved ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Application Approved ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updnewadded', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                 
                
//                No new staff Added
                    case 'updnonew' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']= $id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id=' . $pk . '&app_ref_id='. $courseData['appno'] .'&view=viewcourse&type=2'; 
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Form - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Form - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Complete payment for Site Audit';
                    $content = $this->renderPartial( '..\updnonew', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink,'id' =>$id,'name' =>$name] );
                    break;
                
                
                  case 'updcropalqualma' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/desktopreview?id=' . $pk . '&app_ref_id='. $courseData['appno'] .'&view=viewcourse&type=2'; 
                    $mail['heading'] =' OPAL USP: '.$courseData['projectname'].' Form - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $mail['subject'] =' OPAL USP: '.$courseData['projectname'].' Form - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updcropalqualma', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'rencrgetPayment' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                     $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\rencrgetPayment', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
					
                    case 'updcrgetPayment' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required ';
                    $content = $this->renderPartial( '..\updcrgetPayment', [ 'courseData' => $courseData,'name'=>$name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
					
                    case 'rencrpayDecline' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'standardcourse/home?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Kindly try alternate payment method';
                    $content = $this->renderPartial( '..\rencrpayDecline', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
			
                    
                    case 'updcrpayDecline' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                      $navlink = $baseUrl . 'standardcourse/home?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc';
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Kindly try alternate payment method';
                    $content = $this->renderPartial( '..\updcrpayDecline', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
               
                    case 'rencrregetPay' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                     $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' Renewal - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\rencrregetPay', [ 'courseData' => $courseData, 'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                
                    case 'updcrregetPay' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'paymentinvoiceindex/invoiceconfirm?id=' . $pk;
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Received ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].'  - Payment Received ('.$courseData['appno'].')';
                    $preheadertext = 'Your action is required';
                    $content = $this->renderPartial( '..\updcrregetPay', [ 'courseData' => $courseData, 'name'=>$name ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
					
                    case 'rencrpaymentrecd' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                     $navlink = $baseUrl . 'standardcourse/home?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc';
                    $mail['heading'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectname'].' Renewal ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectname'].' Renewal ('.$courseData['appno'].')';
                    $preheadertext = 'Login to Confirm the date';
                    $content = $this->renderPartial( '..\rencrpaymentrecd', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
				
               
                    case 'updcrpaymentrecd' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $typ = Security::encrypt($courseData['apptyp']);
                    $sts = Security::encrypt($courseData['status']);
                    $projpk = Security::encrypt($courseData['projectpk']);
                    $navlink = $baseUrl . 'standardcourse/home?p=' . $projpk . '&t='. $typ .'&s='. $sts .'&at='.$pk.'&bc=spym&f=sc'; 
                    $mail['heading'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectnameion'].'  ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Confirm Site Audit Date for '.$courseData['projectnameion'].'  ('.$courseData['appno'].')';
                    $preheadertext = 'Login to Confirm the date';
                    $content = $this->renderPartial( '..\updcrpaymentrecd', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'rencrconfrimdt' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname']. 'Renewal - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].'Renewal - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\rencrconfrimdt', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                    case 'updcrconfrimdt' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname']. ' - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname'].' - Site Audit Date Confirmed ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\updcrconfrimdt', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
					
                    case 'rencropalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\rencropalAup', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
				
                
                
                    case 'updcropalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname']. ' - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname']. ' - Desktop Review Completed and received for your Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\updcropalAup', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                    
                    case 'updcropalAupadd' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\updcropalAupadd', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'rencropalqualma' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\rencropalqualma', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
					
                    case 'updaddcropalqualma' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk.
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updaddcropalqualma', [ 'courseData' => $courseData,'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'rencrdecline' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;
                    $mail['heading'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\rencrdecline', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                    case 'updcrdecline' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;
                    $mail['heading'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report Status - Declined ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updcrdecline', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'updvaldec' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;
                    $mail['heading'] =  ' OPAL USP: '.$courseData['projectname']. ' Form - Declined by '.$courseData['declinerole'].' ('.$courseData['appno'].')';
                    $mail['subject'] =  ' OPAL USP: '.$courseData['projectname']. ' Form - Declined by '.$courseData['declinerole'].' ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updvaldec', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
			
                
                
                    case 'reupdaddnew' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;     
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname']. ' Form - Desktop Reviewer Re-submitted for your validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname']. ' Form - Desktop Reviewer Re-submitted for your validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\reupdaddnew', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'reupdnonew' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;    
                    $mail['heading'] = ' OPAL USP: '.$courseData['projectname']. ' Form - Desktop Reviewer Re-submitted for your validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: '.$courseData['projectname']. ' Form - Desktop Reviewer Re-submitted for your validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\reupdnonew', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'rencrreopalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;    
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\rencrreopalAup', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                    case 'updcrreopalAup' :                        
                    $courseData = \api\components\Mail::sprcourseData($apptmpPk,$regPk,$id,$name);
                    $mail['to']=$id;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $pk = Security::encrypt($courseData['pk']);
                    $navlink = $baseUrl . 'standardcourseapproval/siteaudit?id='.$pk;
                    $mail['heading'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $mail['subject'] = ' OPAL USP: Site Audit Report received for Re-validation ('.$courseData['appno'].')';
                    $preheadertext = 'Login to validate';
                    $content = $this->renderPartial( '..\updcrreopalAup', [ 'courseData' => $courseData, 'name'=> $name , 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
					
                    case 'rencourapproved' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home';
                    $mail['heading'] = ' '.$courseData['projectname'].'  eCertificate ('.$courseData['appno'].')';
                    $mail['subject'] =  ' '.$courseData['projectname'].'  eCertificate ('.$courseData['appno'].')';
                    $preheadertext = 'Congratulations! You now have a certified  '.$courseData['projectname'].' on OPAL USP';
                    $content = $this->renderPartial( '..\rencourapproved', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'updcourapprovedno' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home';               
                    $mail['heading'] = ' '.$courseData['projectname'].'  Form - Approved ('.$courseData['appno'].')';
                    $mail['subject'] =  ' '.$courseData['projectname'].' Form - Approved ('.$courseData['appno'].')';
                    $preheadertext = 'Congratulations! Your '.$courseData['projectname'].' form has been approved ';
                    $content = $this->renderPartial( '..\updcourapprovedno', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'crremindermail' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home';           
                    $mail['heading'] = 'Your '.$courseData['projectname'].'  Certificate is expiring soon ('.$courseData['appno'].')';
                    $mail['subject'] =  'Your '.$courseData['projectname'].'  Certificate is expiring soon ('.$courseData['appno'].')';
                    $preheadertext = 'Begin the renewal process now to continue using OPAL USP';
                    $content = $this->renderPartial( '..\crremindermail', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'suspensioncour' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home';
                    $mail['heading'] = 'Your '.$courseData['projectname'].'  Certificate is expiring soon ('.$courseData['appno'].')';
                    $mail['subject'] =  'Your '.$courseData['projectname'].'  Certificate is expiring soon ('.$courseData['appno'].')';
                    $preheadertext = 'Begin the renewal process now to continue using OPAL USP';
                    $content = $this->renderPartial( '..\suspensioncour', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'activationmail' :                        
                    $courseData = \api\components\Mail::courseData($apptmpPk,$regPk);
                    $mail['to']=$courseData['focalemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'standardcourse/home';
                    $mail['heading'] = 'Your '.$courseData['projectname'].' - Re-activated  ('.$courseData['appno'].')';
                    $mail['subject'] =  'Your '.$courseData['projectname'].' - Re-activated  ('.$courseData['appno'].')';
                    $preheadertext = 'Begin the renewal process now to continue using OPAL USP';
                    $content = $this->renderPartial( '..\activationmail', [ 'courseData' => $courseData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
//                Update added

//                Batch Creation 
                
                    case 'batchcreated' :                            
                    $batchData = \api\components\Mail::batchData($batchpk,$theorypk);
                    $mail['to']=$batchData['theoryemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];        
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$batchData['batchNo'];
                    $mail['heading'] = ' OPAL USP: You have been assigned to conduct Theory Class ('.$batchData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: You have been assigned to conduct Theory Class ('.$batchData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\batchcreated', [ 'batchData' => $batchData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
     
                    case 'batchcreatedpt' :                            
                    $tutbatchData = \api\components\Mail::tutbatchData($batchpk,$theorypk,$tutormail,$tutorname);
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $mail['to']=$tutormail;
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$tutbatchData['batchNo'];
                    $mail['heading'] = ' OPAL USP: You have been assigned to conduct Practical Training ('.$tutbatchData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: You have been assigned to conduct Practical Training ('.$tutbatchData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\batchcreatedpt', [ 'tutbatchData' => $tutbatchData,'tutorname'=>$tutorname ,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                    case 'diffassessment' :                            
                    $batchData = \api\components\Mail::batchData($batchpk,$theorypk);
                    $mail['to']=$batchData['focalmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'batchindex/batchgridlisting?rt=no';
                    $mail['heading'] = ' OPAL USP: Your Centre\'s Staff is assigned to do Assessment for the Batch ('.$batchData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: Your Centre\'s Staff is assigned to do Assessment for the Batch ('.$batchData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\diffassessment', [ 'batchData' => $batchData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                
                    case 'sameassessar' :                            
                    $batchData = \api\components\Mail::batchData($batchpk,$theorypk);
                    $mail['to']=$batchData['accessormail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$batchData['batchNo'];
                    $mail['heading'] = ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$batchData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$batchData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\sameassessar', [ 'batchData' => $batchData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'sameassessqc' :                            
                    $batchData = \api\components\Mail::batchData($batchpk,$theorypk);
                    $mail['to']=$batchData['ivqamail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$batchData['batchNo'];
                    $mail['heading'] = ' OPAL USP:  You have been assigned as a Program Manager for the Batch ('.$batchData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP:  You have been assigned as a Program Manager for the Batch ('.$batchData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\sameassessqc', [ 'batchData' => $batchData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
//                Learner Creation 
                
                    case 'learnreg' :                            
                    $learnerData = \api\components\Mail::learnerData($batchpk,$staffpk);               
                    $mail['to']=$learnerData['learnermail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP:  Successfully Registered as Learner for the Course - ('.$learnerData['subcategory'].')';    
                    $mail['subject'] = ' OPAL USP:  Successfully Registered as Learner for the Course - ('.$learnerData['subcategory'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\learnreg', [ 'learnerData' => $learnerData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    
                    case 'movetoprac' :                            
                    $learnerBulkData = \api\components\Mail::learnerBulkData($batchpk,$learnerId,$learnerName);
                    $mail['to']=$learnerBulkData['learnerId'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP:  You can attend Practical Training for the Course - ('.$learnerBulkData['subcategory'].')';    
                    $mail['subject'] = ' OPAL USP:  You can attend Practical Training for the Course - ('.$learnerBulkData['subcategory'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\movetoprac', [ 'learnerBulkData' => $learnerBulkData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'movetoaccess' :                            
                    $learnerBulkData = \api\components\Mail::learnerBulkData($batchpk,$learnerId,$learnerName);
                     $mail['to']=$learnerBulkData['learnerId'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP:  You are moved for Assessment for the Course - ('.$learnerBulkData['subcategory'].')';    
                    $mail['subject'] = ' OPAL USP:  You are moved for Assessment for the Course - ('.$learnerBulkData['subcategory'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\movetoaccess', [ 'learnerBulkData' => $learnerBulkData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'movetoqc' :                            
                    $learnerAccData = \api\components\Mail::learnerAccData($batchpk,$learnerpk);
                    $mail['to']=$learnerAccData['qamail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'assessmentreport/viewandapprove/'.$learnerAccData['learnerpk'].'/V';
                    $mail['heading'] = ' OPAL USP: Validate the received Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].')';    
                    $mail['subject'] = ' OPAL USP: Validate the received Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\movetoqc', [ 'learnerAccData' => $learnerAccData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
  
                    case 'cancelreg' :                            
                    $learnerBulkData = \api\components\Mail::learnerBulkData($batchpk,$learnerId,$learnerName);
                    $mail['to']=$learnerBulkData['learnerId'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP:  Training Evaluation Centre cancelled the Batch   ('.$learnerBulkData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP:  Training Evaluation Centre cancelled the Batch  ('.$learnerBulkData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\cancelreg', [ 'learnerBulkData' => $learnerBulkData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'theorycancel' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['theoryemail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: Assigned Theory Class has been cancelled ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Assigned Theory Class has been cancelled  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\theorycancel', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'practicancel' :                            
//                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $tutbatchData = \api\components\Mail::tutbatchData($batchpk,$theorypk,$tutormail,$tutorname);    
                    $mail['to']=$tutormail;
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: Assigned Practical Training has been cancelled  ('.$tutbatchData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Assigned Practical Training has been cancelled  ('.$tutbatchData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\practicancel', [ 'tutbatchData' => $tutbatchData,'tutorname'=>$tutorname,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'accesscentcancel' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['focalmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: An Assigned Batch to your Centre for Assessment has been cancelled  ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: An Assigned Batch to your Centre for Assessment has been cancelled  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\accesscentcancel', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'accesscancel' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['accessormail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: An Assigned Batch to conduct Assessment has been cancelled  ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: An Assigned Batch to conduct Assessment has been cancelled  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\accesscancel', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'ivqacancel' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['qamail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: An assigned Batch for you as a Program Manager has been cancelled  ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: An assigned Batch for you as a Program Manager has been cancelled  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\ivqacancel', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
         
        
                
                    case 'qcdeclined' :                            
                    $learnerAccData = \api\components\Mail::learnerAccData($batchpk,$learnerpk);
                    $mail['to']=$learnerAccData['accessormail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'assessmentreport/viewandapprove/'.$learnerAccData['learnerpk'].'/V';
                    $mail['heading'] = ' OPAL USP: Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].') - Declined';    
                    $mail['subject'] = ' OPAL USP: Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].') - Declined'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\qcdeclined', [ 'learnerAccData' => $learnerAccData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'resubmitted' :                            
                    $learnerAccData = \api\components\Mail::learnerAccData($batchpk,$learnerpk);
                    $mail['to']=$learnerAccData['qamail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'assessmentreport/viewandapprove/'.$learnerAccData['learnerpk'].'/V';
                    $mail['heading'] = ' OPAL USP: Validate the updated Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].')';    
                    $mail['subject'] = ' OPAL USP: Validate the updated Assessment Report of the Learner  ('.$learnerAccData['lnCivilno'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\resubmitted', [ 'learnerAccData' => $learnerAccData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                
                    case 'backtrackreq' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['adminmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'batchindex/batchgridlisting?rt=no';
                    $mail['heading'] = ' OPAL USP: Back Track request received for the Batch  ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Back Track request received for the Batch  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\backtrackreq', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'backtrackaccept' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['centfocalmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: Status updated for the Batch  ('.$learnerQcData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Status updated for the Batch  ('.$learnerQcData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\backtrackaccept', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'backtrackcancel' :                            
                    $learnerQcData = \api\components\Mail::learnerQcData($batchpk);
                    $mail['to']=$learnerQcData['centfocalmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'batchindex/batchgridlisting?rt=no';
                    $mail['heading'] = ' OPAL USP: Back Track Request of the Batch ('.$learnerQcData['batchNo'].')- Rejected';    
                    $mail['subject'] = ' OPAL USP: Back Track Request of the Batch ('.$learnerQcData['batchNo'].')- Rejected'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\backtrackcancel', [ 'learnerQcData' => $learnerQcData,'learnerName'=>$learnerName,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'changeaccess' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['oldaccessmail'];
                    $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . '..trainingcentremanagement/maincentre';
                    $mail['heading'] = ' OPAL USP: Assessor Replaced for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Assessor Replaced for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\changeaccess', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'newaccessor' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['newaccessmail'];
                  $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\newaccessor', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'accesschgreq' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['adminmail'];
                     $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP: Request for an Assessor change for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Request for an Assessor change for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\accesschgreq', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'oldaccesscentre' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['oldaccfocalmail'];
                     $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'batchindex/batchgridlisting?rt=no';
                    $mail['heading'] = ' OPAL USP: Assessor Replaced for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Assessor Replaced for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\oldaccesscentre', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
     
                
                    case 'oldaccessor' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['oldaccessmail'];
                      $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP: Replaced Assessor for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Replaced Assessor for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\oldaccessor', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'oldivsatff' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['oldivqmail'];
                      $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP: Replaced Program Manager for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] = ' OPAL USP: Replaced Program Manager for the Batch ('.$accessorData['batchNo'].')'; 
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\oldivsatff', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break;
                
                    case 'newaccesscentre' :                            
                     $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['newaccfocalmail'];
                     $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'batchindex/batchgridlisting?rt=no';
                    $mail['heading'] = ' OPAL USP: Your Centre\'s Staff is assigned to do Assessment for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: Your Centre\'s Staff is assigned to do Assessment for the Batch ('.$accessorData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\newaccesscentre', [ 'accessorData' => $accessorData,'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                                
                    case 'newaccessorch' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['newaccessmail'];
                   $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP: You have been assigned as an Assessor for the Batch ('.$accessorData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\newaccessorch', [ 'accessorData' => $accessorData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                    case 'newivsatffch' :                            
                    $accessorData = \api\components\Mail::accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk);
                    $mail['to']=$accessorData['newivqmail'];
                      $baseUrl =\Yii::$app->params['baseUrl'];
                    $navlink = $baseUrl . 'candidatemanagement/viewlearner/'.$accessorData['batchNo'];
                    $mail['heading'] = ' OPAL USP:  You have been assigned as a Program Manager for the Batch ('.$accessorData['batchNo'].')';    
                    $mail['subject'] =  ' OPAL USP:  You have been assigned as a Program Manager for the Batch ('.$accessorData['batchNo'].')';    
                    $preheadertext = 'Open mail to learn more';
                    $content = $this->renderPartial( '..\newivsatffch', [ 'accessorData' => $accessorData, 'preheadertext' => $preheadertext,'navlink' => $navlink] );
                    break; 
                
                case 'ivmsvehiclereginst' :         //1.1.1 IVMS                    
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'emailid' ];
                    $mail['companyname_en'] = $ivmsData['installer_name'];
                    $mail['companyname_ar'] = $ivmsData['installer_name'];
                
                    
                    $mail['heading'] = ' OPAL USP: A vehicle has been assigned for IVMS Device Installation ';    
                    $mail['subject'] =  ' OPAL USP: A vehicle has been assigned for IVMS Device Installation';    
                    $preheadertext = 'Login to upload the installation report';
                    
                    $content = $this->renderPartial( '..\ivmsvehiclereginst', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                case 'ivmsvehicleregowner' :     //1.1.2 IVMS                         
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'owneremail' ];
                     $mail['companyname_en'] = $ivmsData['owner_name'];
                    $mail['companyname_ar'] = $ivmsData['owner_name_ar'];
                    
                    $mail['heading'] = ' OPAL USP: Your vehicle has been assigned for IVMS Device Installation';    
                    $mail['subject'] =  ' OPAL USP: Your vehicle has been assigned for IVMS Device Installation';    
                    $preheadertext = 'You will soon be notified on the status';
                    $content = $this->renderPartial( '..\ivmsvehicleregowner', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                
                case 'ivmsvehicleregsrtech' :       //1.2.1 IVMS                       
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'emailid' ];
                     $mail['companyname_en'] = $ivmsData['UserName_en'];
                    $mail['companyname_ar'] = $ivmsData['UserName_en'];
                    
                    $mail['heading'] = ' OPAL USP: IVMS Device Installation completed and awaiting Approval';    
                    $mail['subject'] =  ' OPAL USP: IVMS Device Installation completed and awaiting Approval';    
                    $preheadertext = 'Kindly do the needful';
                    $content = $this->renderPartial( '..\ivmsvehicleregsrtech', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                case 'ivmsvehicleregcltcert' :       //1.3.1 IVMS                     
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'owneremail' ];
                   $mail['companyname_en'] = $ivmsData['owner_name'];
                    $mail['companyname_ar'] = $ivmsData['owner_name_ar'];
                    
                    $mail['heading'] = ' IVMS Device Installation Status – Approved';    
                    $mail['subject'] =  ' IVMS Device Installation Status – Approved';    
                    $preheadertext = 'Kindly collect the IVMS Certificate at the assigned Centre ';
                    $content = $this->renderPartial( '..\ivmsvehicleregcltcert', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                case 'ivmsvehicleregcancelnocert' :       //1.4.1 IVMS                     
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'owneremail' ];
                     $mail['companyname_en'] = $ivmsData['owner_name'];
                    $mail['companyname_ar'] = $ivmsData['owner_name_ar'];
                    $mail['heading'] = ' OPAL USP: Registered Vehicle for IVMS Device Installation has been Cancelled';    
                    $mail['subject'] =  ' OPAL USP: Registered Vehicle for IVMS Device Installation has been Cancelled';    
                    $preheadertext = 'Read the Email to View More ';
                    $content = $this->renderPartial( '..\ivmsvehicleregcancelnocert', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                case 'ivmsvehicleregcancelremove' :       //1.5.1 IVMS                     
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'owneremail' ];
                    $mail['companyname_en'] = $ivmsData['owner_name'];
                    $mail['companyname_ar'] = $ivmsData['owner_name_ar'];
                   
                    $mail['heading'] = ' OPAL USP: IVMS Device Installation Certificate has been cancelled';    
                    $mail['subject'] =  ' OPAL USP: IVMS Device Installation Certificate has been cancelled';    
                    $preheadertext = 'Read the Email to View More  ';
                    $content = $this->renderPartial( '..\ivmsvehicleregcancelremove', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                
                case 'ivmsvehicleregremaindernearing' :       //2.1.1 IVMS                     
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'emailid' ];
                    $mail['companyname_en'] = $ivmsData['UserName_en'];
                    $mail['companyname_ar'] = $ivmsData['UserName_en'];
                   
                    $mail['heading'] = ' OPAL USP: IVMS Device Installation Certificate is nearing Expiry ';    
                    $mail['subject'] =  ' OPAL USP: IVMS Device Installation Certificate is nearing Expiry ';    
                    $preheadertext = 'Get a health check done and receive the updated certificate ';
                    $content = $this->renderPartial( '..\ivmsvehicleregremaindernearing', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                case 'ivmsvehicleregremainderexpired' :       //2.2.1 IVMS                     
                    $ivmsData = \api\components\Mail::ivmsvehiclereg($userpk,$attrbts);
                    $mail[ 'to' ] = $ivmsData[ 'emailid' ];
                    $mail['companyname_en'] = $ivmsData['UserName_en'];
                    $mail['companyname_ar'] = $ivmsData['UserName_en'];
                   
                    $mail['heading'] = ' OPAL USP: IVMS Device Certificate has Expired';    
                    $mail['subject'] =  ' OPAL USP: IVMS Device Certificate has Expired';    
                    $preheadertext = 'Get a health check done and receive the updated certificate';
                    $content = $this->renderPartial( '..\ivmsvehicleregremainderexpired', [ 'ivmsData' => $ivmsData, 'preheadertext' => $preheadertext] );
                    break;
                
                
}
 $mail['body'] = $this->renderPartial('..\template', ['mail'=> $mail,'content'=> $content, 'preheadertext' => $preheadertext,'view'=> $view,'queryparams'=> $queryparams]);
         
            if($view)
            {
                if($view == 'ar')
                {
                    $mail['body'] = $this->renderPartial('..\template_ar', [ 'mail'=> $mail,'content'=> $content_ar, 'preheadertext' => $preheadertext_ar,'view'=> $view,'type'=>$type,'userpk'=>$userpk,'queryparams'=> $queryparams]);
                    echo $mail['body'];
                    exit;
                }
                echo $mail['body'];
                exit;
            }
            else
            {
                    $mail_msg = Yii::$app->mailer->compose()
                   
                     ->setFrom(['noreply@usp.opaloman.om'])
 //                       ->setTo(\Yii::$app->params['testMailIDs']);   
                     ->setTo($mail['to']);  
//                    ->setTo(['vaishali@businessgateways.com','prabhu@businessgateways.com','jeeva@businessgateways.com','vaishali@yopmail.com']);
//                ->setTo(['vaishali@businessgateways.com']); 
                   
                                
//                    if(!empty($mailcc)){
//                   $mailcc = explode(',',$mailcc);
//                      $mail_msg->setCc('jeeva@businessgateways.com');
//                  }  
//                    
//                     if(!empty($cc_emails)){
//                        $mail_msg->setCc('jeeva@businessgateways.com');
//                    }  
//                    
//                    if(!empty($bcc_emails)){          
//                        $mail_msg->setBcc('siddharthan@businessgateways.com');
//                    }
//                   
                    $mail_msg->setSubject($mail['subject'])
                    ->setHtmlBody($mail['body']);
                    if(!empty($mail['attachment'])){
                        //$mail_msg->attach($html['attachment']);
                        foreach($mail['attachment'] as $key=>$value){
                            $mail_msg->attach($value);
                        }
                    }
                $mail_msg->send();
                Yii::$app->response->statusCode = 200;
                return $this->asJson(['message' => 'mail sent']);
                
            }
              
        } else {
            Yii::$app->response->statusCode = 200;
            return $this->asJson([ 'message' => 'Bad Request']);
        }
    }

    public function getAttachmentsContact($data){
        $path='';
        if(!empty($data)){
            $d_arr = explode(',', $data);
            $appUrl = \Yii::$app->params['APP_URL'];
            $srcDirectory = \Yii::$app->params['srcDirectory'];
            $uploadPath = \Yii::$app->params['uploadPath'];
            $zip = new ZipArchive();
            $folder = $uploadPath. "/contactzip/";
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            $zipFile = $folder.'Images'.date(('YmdHis')).'.zip';
    
            foreach($d_arr as $key=>$value){
               
                $file_info = \app\models\OpalmemcompfiledtlsTbl::find()
                    ->select(['omcfd_opalmemberregmst_fk','omcfd_uploadedby','omcfd_sysgenerfilename','omcfd_origfilename'])
                    ->where(['omcfd_opalmemcompfiledtls_pk'=>$value])->asArray()->one();

                $companyPk = $file_info['omcfd_opalmemberregmst_fk'];
                $userPk = $file_info['omcfd_uploadedby'];
                $img_name = $file_info['omcfd_sysgenerfilename'];
                $org_name = $file_info['omcfd_origfilename'];
                $phy_filepath = 'Contact Us';
         
                $userDirectory = "comp_" . $companyPk . "/user_" . $userPk;
                $target_path = $uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/';
                //zip process
                $baseUrl = \Yii::$app->params['baseMailPath'];  
   
                if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE)
                {
          
                    if(file_exists($target_path.$img_name))
                    {
                    $zip->addFile($target_path.$img_name,$org_name);  
                   
                    }
                }


            }
            $zip->close(); 
            $path = $appUrl."api/".$zipFile;
        }
        return $path;
        
    }


}