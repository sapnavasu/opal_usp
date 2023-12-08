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
use \common\components\Security;
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

    public function actionSend() {
        $request_body = file_get_contents( 'php://input' );
        $data = json_decode( $request_body, true );
        if ( $data ) {
            $email = $data[ 'email' ];
            $template_id = $data[ 'template_id' ];
            $table_ref_key = $data[ 'table_ref_key' ];
            $table_ref_value = $data[ 'table_ref_value' ];
            $addi_params = ( !empty( $data[ 'addi_params' ] ) )? $data[ 'addi_params' ]: '';
            Yii::$app->response->statusCode = 200;
            // echo '<pre>';
            print_r( $html );
            exit;
            try {
                $html = $this->merge_fields( $template_id, $table_ref_key, $table_ref_value, $addi_params );
                if ( $html == 404 ) {
                    Yii::$app->response->statusCode = 404;
                    return $this->asJson( [ 'message' => 'Record not found' ] );
                }
                if ( !$html ) {
                    Yii::$app->response->statusCode = 400;
                    return $this->asJson( [ 'message' => 'Please check mail template settings' ] );
                }
                $emails = explode( ',', $html[ 'emails' ] );
                if ( empty( $emails ) ) {
                    if ( !$data[ 'email' ] ) {
                        Yii::$app->response->statusCode = 400;
                        return $this->asJson( [ 'message' => 'Please Provide email address' ] );
                    }
                    $emails = explode( ',', $email );
                    if ( empty( $emails ) ) {
                        Yii::$app->response->statusCode = 400;
                        return $this->asJson( [ 'message' => 'Please Provide email address' ] );
                    }
                }
                $cc_emails = explode( ',', $html[ 'cc_emails' ] );
                if ( !empty( $addi_params[ 'cc_email' ] ) ) {
                    $cc_emails = explode( ',', $addi_params[ 'cc_email' ] );
                    $cc_emails = \Yii::$app->params[ 'ccmailIDs' ];
                }
                $bcc_emails = explode( ',', $html[ 'bcc_emails' ] );
                //$this->insertmaildata( $table_ref_value, $template_id, $html );
                $file_name = $this->getbrowserlink( $template_id, $table_ref_value );
                $appUrl = \Yii::$app->params[ 'APP_URL' ];
                $browser_link = $appUrl.'api/web/mails/'.$file_name;
                $curr_date = date( 'Y' );
                $html[ 'body' ] = str_replace( '{VIEW_BROWSER}', $browser_link, $html[ 'body' ] );
                $html[ 'body' ] = str_replace( '{CURR_DATE}', $curr_date, $html[ 'body' ] );
                $this->insertmaildata( $table_ref_value, $template_id, $html );
                $mail_msg = Yii::$app->mailer->compose()
                ->setFrom( [ 'noreply@businessgateways.com'=>'Business Gateways International' ] )
                ->setTo( \Yii::$app->params[ 'testMailIDs' ] );

                if ( !empty( $cc_emails ) ) {
                    $mail_msg->setCc( 'jeeva@businessgateways.com' );
                }

                if ( !empty( $bcc_emails ) ) {

                    $mail_msg->setBcc( 'siddharthan@businessgateways.com' );
                }
                //->setTo( $emails )
                //->setCc( $cc_emails )
                //->setBcc( $bcc_emails )
                $mail_msg->setSubject( $html[ 'subject' ] )
                //->setTextBody( 'Plain text content' )
                ->setHtmlBody( $html[ 'body' ] );
                if ( !empty( $html[ 'attachment' ] ) ) {
                    //$mail_msg->attach( $html[ 'attachment' ] );
                    foreach ( $html[ 'attachment' ] as $key=>$value ) {
                        $mail_msg->attach( $value );
                    }
                }
                $mail_msg->send();
                Yii::$app->response->statusCode = 200;
                return $this->asJson( [ 'message' => 'mail sent' ] );
            } catch ( Exception $exc ) {
                Yii::$app->response->statusCode = 500;
                return $this->asJson( [ 'message' => 'Bad Request' ] );
            } catch ( \yii\base\Exception $exc ) {
                Yii::$app->response->statusCode = 500;
                return $this->asJson( [ 'message' => 'Bad Request' ] );
            }
        } else {
            Yii::$app->response->statusCode = 200;
            return $this->asJson( [ 'message' => 'Bad Request' ] );
        }
    }

    public function actionSendmail() {

        if ( isset( $_REQUEST[ 'type' ] ) ) {
            $data[ 'type' ] = $_REQUEST[ 'type' ];
            $data[ 'jsondtl' ] = $_REQUEST[ 'jsondtl' ];
            $data[ 'userpk' ] = $_REQUEST[ 'userpk' ];
            $data[ 'newuserpk' ] = $_REQUEST[ 'newuserpk' ];
            $data[ 'table_ref_value' ] = $_REQUEST[ 'table_ref_value' ];
            $data[ 'user_invite_pk' ] = $_REQUEST[ 'user_invite_pk' ];
            $data[ 'location' ] = $_REQUEST[ 'location' ];
            $view = $_REQUEST[ 'view' ];
        } else {
            $request_body = file_get_contents( 'php://input' );
            $data = json_decode( $request_body, true );
            $view = null;
        }
        
     $userinvitepk =$data['user_invite_pk'];
         
    // $data = [ 'type'=>'loginotpmailcontent', 'userpk' => 36578];
        //  $data = [
        //      'jsondtl' => [ 'type' => 'email',
        //         'id' => 'sapna@ymail.com',
        //         'name' => 'Sapna',
        //         'expiry' => '2022-10-28 19:23:58',
        //        'otp' => 123456,
        //        'duration' => 15 ],   
        //    'type' => 'emailverifyjson' ];

        // var_dump($queryparams);
        // exit;

        if ( $data ) {
            $type = $data[ 'type' ];
            $userpk = $data[ 'userpk' ];
            $jsondtl = $data[ 'jsondtl' ];
            $adminpk = $data[ 'table_ref_value' ];
            $location = $data[ 'location' ];
            $newuserpk = $data[ 'newuserpk' ];
            $links  = $data[ 'links' ];
            $queryparams = '?';
            foreach ( $data as $key => $value ) {
                $queryparams .= $key . '=' . urlencode( $value ) . '&';
            }
           
            $baseUrl = \Yii::$app->params['baseUrl'];
            Yii::$app->response->statusCode = 200;
            switch( $type )
 {
                // 1.1Mail to the respective company with the payment link and proforma invoice copy attached.
                case 'suppreg' : $model = \api\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'to' ] = $model[ 'emailid' ];
                    $stakeholder = $model[ 'stktype' ] == 6 ? 'Supply Chain': 'Industrial Organisation';
                    $mail[ 'subject' ] = 'RABT '.$stakeholder.' Certificate – Proforma Invoice';
                    $preheadertext = 'Complete Registration and proceed with the Certification Process';
                    $preheadertext_ar = 'إكمال التسجيل ومتابعة عملية إصدار الشهادة';
                    $content = $this->renderPartial( '..\supplierregmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\supplierregmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    $mail[ 'attachment' ] = [ 1 => $model[ 'invoicepath' ] ];
                    break;

                //1.2Mail to Back-end team that a New Industrial Organisation has Registered and is yet to make payment.
                case 'suppregtoadmin' : $model = \common\components\Mail::getsupprefmailtoadmindtls( $userpk );
                    $mail[ 'to' ] = 'accounts@rabt.om,admin@rabt.om';
                    $stakeholder = $model[ 'stktype' ] == 6 ? 'Supplier': 'Industrial Organisation';
                    $mail[ 'subject' ] = $model[ 'regno' ].': New '.$stakeholder.' Registration';
                    $preheadertext = 'An '.$stakeholder.' has registered on RABT';
                    $preheadertext_ar = 'إكمال التسجيل ومتابعة عملية إصدار الشهادة';
                    $content = $this->renderPartial( '..\regmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\regmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //3. When Payment is received from Industrial Organisation
                //3.1. When Industrial Organisation makes payment
                //3.1.1. Mail to Back-end Finance team that payment is received from Registered Industrial Organisation ( attach TAX Invoice and Receipt ).
                case 'paymentsuccestoadmin' :
                    $model = \common\components\Mail::getpaymentsuppadmin( $userpk );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'bcc' ] = 'rabt@rabt.om';
                    $stakeholder = $model[ 'stktype' ] == 6 ? 'Supplier': 'Industrial Organisation';
                    $mail[ 'subject' ] = $model[ 'regno' ].':  An '.$stakeholder.' has paid';
                    $preheadertext = 'Attached is the TAX Invoice and Receipt';
                    $preheadertext_ar = 'مرفق لكم الفاتورة الضريبية والإيصال';
                    $content = $this->renderPartial( '..\financialpay', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\financialpay_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //3.1.2. Mail to respective company indicating that their registration process has completed and they now set password, login and access to Complete Certification
                case 'paymentsucess' :
                    $model = \common\components\Mail::getpaymentsupp( $userpk );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'subject' ] = 'RABT: Payment Successfully Completed  '.$model[ 'regno' ];
                    $preheadertext = 'Login to Complete RABT Certification ';
                    $preheadertext_ar = 'سجل الدخول لإصدار شهادة ربط';
                    $content = $this->renderPartial( '..\supregpayment', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\supregpayment_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //4. When Industrial Organisation has set the password for the account on RABT
                //4.1. Mail to Industrial Organisation that they have successfully set the password and can login on RABT
                case 'setpassword' : $model = \common\components\Mail::getsupprefmailtoadmindtls( $userpk );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'subject' ] = 'RABT: Password Created';
                    $preheadertext = 'Your password has been set, you can now login to RABT';
                    $preheadertext_ar = 'تم تعيين كلمة المرور، يمكنك الآن تسجيل الدخول إلى ربط';
                    $content = $this->renderPartial( '..\pwdsucessmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\pwdsucessmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //reset password
                case 'resetpassword' : $model = \common\components\Mail::getsupprefmailtoadmindtls( $userpk );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'subject' ] = 'RABT: Password Changed';
                    $preheadertext = 'Your password has been reset, you can now login to RABT';
                    $preheadertext_ar = 'Your password has been reset, you can now login to RABT';
                    $content = $this->renderPartial( '..\pwdchangedmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\pwdchangedmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //5.	Payment Reminder Mails
                //5.1.	Reminder mail to Industrial Organisation to make payment before the due date, else their registration will be deactivated.
                case 'payremindermailscontent' :
                    $model = \common\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'subject' ] = 'RABT: Payment Pending ' . $model[ 'regno' ] . '';
                    $preheadertext = 'Complete the payment to proceed with the RABT Certification Process';
                    $preheadertext_ar = 'أكمل عملية الدفع لمتابعة إصدار شهادة ربط';
                    $content = $this->renderPartial( '..\payremindermails', [ 'model' => $model, 'data'=>$data, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\payremindermails_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //6.	When the registration has been deactivated
                //6.1.	Mail to the respective organisation, that due to non-payment their registration is deactivated and they can re-register.
                case 'regexpiredmailscontent' :
                    $model = \common\components\Mail::getsupplierregmaildtls( $userpk );
                    $mail[ 'subject' ] = 'RABT Registration Expired ' . $model[ 'regno' ] . '';
                    $preheadertext = 'Kindly re-register on RABT if you wish to use our services';
                    $preheadertext_ar = 'يرجى إعادة التسجيل إذا كنت ترغب في استخدام خدماتنا.';
                    $content = $this->renderPartial( '..\regexpiredmails', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\regexpiredmails_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //7. When the User verifies the email ID
                // 7.1.Mail to the respective User with OTP for verification ( regform )
                case 'emailverifyjson' :
                    $jsondtl =  json_decode(Security::decrypt($jsondtl),true);
                    $mail[ 'subject' ] = 'RABT: OTP for Verification of Email ID';
                    $mail_ar[ 'subject' ] = 'RABT: OTP for Verification of Email ID';
                    $mail[ 'to' ] = $model[ 'email' ];
                    $preheadertext = 'OTP is valid only for ' . $jsondtl[ 'duration' ] . ' minutes';
                    $preheadertext_ar = 'كلمة المرور المؤقتة صالحة لمدة ' . $jsondtl[ 'duration' ] . ' دقايق';
                    $content = $this->renderPartial( '..\otpverify', [ 'model' => $jsondtl, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\otpverify_ar', [ 'model' => $jsondtl, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //Registration Mail Ends Here

                //Login  mail starts

                //1.	When User confirms and logs in from a different Country than the Registered Country
                //1.1	Mail to User that their account is accessed from a different country, asking them to change password if they have not logged in or to ignore if they have logged in.
                case 'logindiffcountrymailcontent' :
                    $model = \common\components\Mail::getDiffCountryLoginMailDtls( $userpk, $location );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'subject' ] = 'RABT: New Login to RABT from a different country';
                    $preheadertext = 'Kindly confirm if this was you';
                    $preheadertext_ar = ' يرجى تأكيد إالمستخدم';
                    $content = $this->renderPartial( '..\logindiffcountrymail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\logindiffcountrymail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //1.2	Mail to Admin User that a User has logged in from a different country
                case 'loginadminusermailcontent' :
                    $model = \common\components\Mail::getDiffCountryLoginMailAdminDtls( $userpk, $location );
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'subject' ] = 'RABT: New Login to RABT by '.$model[ 'user_name' ].' from a different country';
                    $preheadertext = 'A User has logged in from a difference country';
                    $preheadertext_ar = 'ربط: تسجيل دخول جديد إلى ربط من دولة مختلفة بواسطة';
                    $content = $this->renderPartial( '..\loginadminusermail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\loginadminusermail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //2.1	Mail to the User with the OPT to access the Account.
                case 'loginotpmailcontent' :
                    $model = \common\components\Mail::getLoginOtpMailDtls( $userpk );
                    $mail[ 'subject' ] = 'RABT: OTP for your Login';
                    $mail[ 'to' ] = $model[ 'email' ];
                    $mail[ 'bcc' ] = [ 'accounts@rabt.om', 'admin@rabt.om' ];
                    $preheadertext = 'Your Login OTP is only valid for '.$model[ 'duration' ];
                    $preheadertext_ar = 'ستكون كلمة المرور  المؤقتة صالحة لمدة '.$model[ 'duration' ];
                    $content = $this->renderPartial( '..\loginotpmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\loginotpmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //3.	When User has not logged into RABT for the past 7 days
                //3.1	Mail to User
                case 'loginmailtousercontent' :
                    $model = UsermstTbl::findOne( $userpk );
                    $mail[ 'to' ] = $model[ 'UM_EmailID' ];
                    $mail[ 'subject' ] = 'RABT: Account Inactive for 7 days';
                    $preheadertext = 'Login to RABT today';
                    $preheadertext_ar = 'أنضم إلى ربط اليوم';
                    $content = $this->renderPartial( '..\loginmailtouser', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\loginmailtouser_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //4.	When User has not logged into RABT for the past 30 days, send a notification on the 31st day
                //4.1	Mail to the User stating that their account is temporarily de-activated, to activate the account, they would have to reset the password.
                case 'loginresetpswcontent' :
                    $model = UsermstTbl::findOne( $userpk );
                    $mail[ 'to' ] = $model[ 'UM_EmailID' ];
                    $mail[ 'subject' ] = 'RABT: Your RABT User Access  has been deactivated';
                    $preheadertext = 'Reset your password to activate your account.';
                    $preheadertext_ar = 'أعد تعيين كلمة المرور لتنشيط حسابك.';
                    $content = $this->renderPartial( '..\loginresetpsw', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\loginresetpsw_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                //Login  mail ends

                //Account Settings starts

                //1.	When stakeholder's user set password
                //1.1.	Mail to the user who has set password, to login and access the modules provided
                case 'useraccactivatedcontent' : 
                    $model = \common\components\Mail::geteadminuserdata($userpk,$adminpk);
                    $mail['subject'] = 'RABT: User Account Activated';
                    $preheadertext = 'Login to RABT to explore the various modules';
                    $preheadertext_ar = 'سجل الدخول إلى ربط لاستكشاف الوحدات المختلفة';
                    $content = $this->renderPartial('..\useraccactivated', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\useraccactivated_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;

                //2.	When Admin/User request to change password (Forgot Password)
                //2.1.	Mail to the admin/user (whoever has requested for forgot password) with the link or OTP to reset the password                    
                case 'reqtochangepswcontent' : 
                    $model = \common\components\Mail::getForgotPassMailDtls($userpk,$adminpk);
                    $mail['subject'] = 'RABT: OTP to reset your Password';
                    $preheadertext = 'Use the OTP or click the link to reset your password';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة أو انقر على الرابط لإعادة تعيين كلمة المرور';
                    $content = $this->renderPartial('..\reqtochangepsw', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\reqtochangepsw_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;

                //3.	When Admin/User tries to change password / (Account Settings)
                //3.1.	Mail to the admin/user with the OTP to change password on the Email ID                    
                case 'otptochangepswcontent' : 
                    $model = UsermstTbl::findOne($userpk);
                    $mail['subject'] = 'RABT: OTP to Change your Password';
                    $preheadertext = 'Use the OTP to confirm the update';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة للتأكيد التغيير';
                    $content = $this->renderPartial('..\otptochangepsw', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\otptochangepsw_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;

                //4.	When Admin/User successfully changes password / (Account Settings)
                //4.1.	Mail to the admin/user  //success after reset
                case 'sucessafterreset' : 
                    $model = UsermstTbl::findOne($userpk);
                    $mail['to'] = $data['email'];
                    $mail['subject'] = 'RABT: Account Password updated Successfully';
                    $preheadertext = 'Your password has been updated';
                    $preheadertext_ar = 'كلمة مرور الحساب/البريد الإلكتروني/ الهاتف النقال';
                    $content = $this->renderPartial('..\mailtoadminoruser', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\mailtoadminoruser_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break;

                //3.	When Admin/User tries to change  / Email ID (Account Settings)
                //3.1.	Mail to the admin/user with the OTP to change  on the Email ID                    
                case 'otptochangeemlcontent' : 
                    $model = UsermstTbl::findOne($userpk);
                    $mail['to'] = $data['email'];
                    $mail['subject'] = 'RABT: OTP to Change your Email ID';
                    $preheadertext = 'Use the OTP to confirm the update';
                    $preheadertext_ar = 'استخدم كلمة المرور المؤقتة للتأكيد التغيير';
                    $content = $this->renderPartial('..\otptochangeemail', ['model' => $jsondtl ,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\otptochangeemail_ar', ['model' => $jsondtl ,'preheadertext' => $preheadertext_ar]);
                    break;

                //4.	When Admin/User successfully changes email id / Email ID (Account Settings)
                //4.1.	Mail to the admin/user  //success after reset
                case 'sucessafterreseteml' : 
                    $model = UsermstTbl::findOne($userpk);
                    $mail['to'] = $data['email'];
                    $mail['subject'] = 'RABT: Account Email ID updated Successfully';
                    $preheadertext = 'Your Email ID has been updated';
                    $preheadertext_ar = 'تم تحديث معرف البريد الإلكتروني الخاص بك';
                    $content = $this->renderPartial('..\mailtoadminconfotp', ['model' => $jsondtl,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\mailtoadminconfotp_ar', ['model' => $jsondtl,'preheadertext' => $preheadertext_ar]);
                    break; 

                //5.	When Admin/User change primary user via Account Settings
                //5.1.	Mail to existing primary user for confirmation
                case 'changeprimaryusercontent' : 
                    $model['admin'] = UsermstTbl::findOne($userpk)['UM_LoginId'];
                    $model['user'] = UsermstTbl::findOne($newuserpk)['UM_LoginId'];
                    $model['links'] = $links;
                    $mail['to'] = UsermstTbl::findOne($userpk)['UM_EmailID'];
                    $mail['subject'] = 'RABT: Confirmation to change Primary User';
                    $preheadertext = 'Confirm to proceed with the User update';
                    $preheadertext_ar = 'الرجاء التأكيد لمتابعة تحديث المستخدم';
                    $content = $this->renderPartial('..\changeprimaryuser', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\changeprimaryuser_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break; 
                    
                //5.2.	Mail to changed Primary user after the existing user confirmed the user change         
                case 'updateprimaryusercontent' : 
                    $model['admin'] = UsermstTbl::findOne($userpk)['UM_LoginId'];
                    $model['user'] = UsermstTbl::findOne($newuserpk)['UM_LoginId'];
                    $mail['to'] = UsermstTbl::findOne($newuserpk)['UM_EmailID'];
                    $mail['subject'] = 'RABT: Primary User Update';
                    $preheadertext = 'You are now the Primary User';
                    $preheadertext_ar = 'أنت المستخدم الأساسي الآن';
                    $content = $this->renderPartial('..\updateprimaryuser', ['model' => $model,'preheadertext' => $preheadertext]);
                    $content_ar = $this->renderPartial('..\updateprimaryuser_ar', ['model' => $model,'preheadertext' => $preheadertext_ar]);
                    break; 

                //Account Settings ends

                // SCF mail

                //2.1.Mail to Back-end team that RABT Supply Chain Certification Form is received from a Supplier for Validation.
                case 'suppTobackendapproval':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = $model[ 'suppRegNo' ].': RABT '.$model[ 'suppOrOrg' ].' Certification Form Received for Validation';
                    $preheadertext = 'View and validate the RABT '.$model[ 'suppOrOrg' ].' Certification Form';
                    $preheadertext_ar = 'أعرض استمارة ربط لسلسلة التوريد للتدقيق';
                    $content = $this->renderPartial( '..\backendapprovalfirstmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\backendapprovalfirstmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //4.1.Mail to Back-end team that the Supplier re-submitted the RABT Supply Chain Certification Form for Validation
                case 'suppTobackendRSapproval':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = $model[ 'suppRegNo' ].': RABT '.$model[ 'suppOrOrg' ].' Certification Form Re-submitted for Validation';
                    $preheadertext = 'View and validate the RABT '.$model[ 'suppOrOrg' ].' Certification Form';
                    $preheadertext_ar = 'عرض وتدقيق استمارة  الاعتماد لسلسلة ربط للتوريد';
                    $content = $this->renderPartial( '..\backendapprovalRSmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\backendapprovalRSmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //5.1.Mail to Back-end team that the Supplier updated the RABT Supply Chain Certification Form and posted for Validation
                case 'suppTobackendUpdateApproval':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = $model[ 'suppCode' ].': Updated RABT '.$model[ 'suppOrOrg' ].' Certification Form Received for Validation ';
                    $preheadertext = 'View and validate the RABT '.$model[ 'suppOrOrg' ].' Certification Form';
                    $preheadertext_ar = 'تحديث وتدقيق استمارة الاعتماد في سلسلة ربط للتوريد';
                    $content = $this->renderPartial( '..\backendapprovalupdatemail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\backendapprovalupdatemail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //8.1.Mail to Back-end team that the Supplier updated the RABT Supply Chain Certification Form ( after decline ) and posted for Validation.
                case 'suppTobackendCertAfterDecline':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = $model[ 'suppCode' ].': RABT '.$model[ 'suppOrOrg' ].' Certification Form Re-submitted  for Validation';
                    $preheadertext = 'View and validate the RABT '.$model[ 'suppOrOrg' ].' Certification Form';
                    $preheadertext_ar = 'حدث الاستمارة و قدمهاوقدمها للتدقيق';
                    $content = $this->renderPartial( '..\backendapprovalaftrdeclineemail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\backendapprovalaftrdeclineemail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //3.2.When Back-end team declines the Supplier's RABT Supply Chain Certification Form, mail to supplier with the remarks provided.
                case 'backendToSuppDecline':
                $model = \common\components\Mail::getsuppforbackendapproval( $userpk );

                $mail[ 'subject' ] = 'RABT '.$model[ 'suppOrOrg' ].' Certification: Form Status – Declined ('.$model[ 'suppRegNo' ].')';
                $preheadertext = 'Update and submit for validation';
                $preheadertext_ar = 'حدث الاستمارة وقدمها للتدقيق';
                $content = $this->renderPartial( '..\suppdecliemail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                $content_ar = $this->renderPartial( '..\suppdecliemail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                break;

                //6.1. When Back-end team approves the RABT Certified Supplier's RABT Supply Chain Certification Form who have updated content and posted for validation, mail to supplier on the status
                case 'backendToSuppApproval':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = 'RABT '.$model[ 'suppOrOrg' ].' Certification: Updated Form Status - Approved ('.$model[ 'suppCode' ].')';
                    $preheadertext = 'We have approved your RABT '.$model[ 'suppOrOrg' ].' Certification Form ';
                    $preheadertext_ar = 'قد تم قبول استمارة اعتماد';
                    $content = $this->renderPartial( '..\suppapprovalmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\suppapprovalmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //7.1.When Back-end team declines the RABT Certified Supplier's RABT Supply Chain Certification Form, mail to supplier with the remarks provided.
                case 'backendToSuppCertDecline':
                $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                $mail[ 'subject' ] = 'RABT '.$model[ 'suppOrOrg' ].' Certification: Updated Form Status – Declined ('.$model[ 'suppCode' ].')';
                $preheadertext = 'Update and submit for validation';
                $preheadertext_ar = 'حدث الاستمارة و قدمهاوقدمها للتدقيق';
                $content = $this->renderPartial( '..\suppdeclinecertmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                $content_ar = $this->renderPartial( '..\suppdeclinecertmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                break;

                //1.1.Reminder Mail to Supplier to submit their RABT Supply Chain Certification Form .
                case 'remindertosubmitcertform':
                $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                $mail[ 'subject' ] = 'RABT: '.$model[ 'suppRegNo' ].' Certification is Pending; Submit Certification Form to initiate Validation';
                $preheadertext = 'Submit your RABT '.$model[ 'suppOrOrg' ].' Certification Form to initiate Validation Process';
                $preheadertext_ar = 'أرسل استمارة الاعتماد لبدء عملية التدقيق';
                $content = $this->renderPartial( '..\remindertosubmitcertformmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                $content_ar = $this->renderPartial( '..\remindertosubmitcertformmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                break;

                //3.1.When Back-end team approves the Supplier's RABT Supply Chain Certification Form, mail to Supplier with an option to view RABT Supply Chain Certificate.
                case 'backendapprovalwithview':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = 'RABT '.$model[ 'suppOrOrg' ].' Certification: Form Status - Approved ('.$model[ 'suppCode' ].')';
                    $preheadertext = 'View your RABT Certificate';
                    $preheadertext_ar = 'أعرض شهادة ربط';
                    $content = $this->renderPartial( '..\backendapprovalwithviewmail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\backendapprovalwithviewmail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //3.3.Reminder mail to an Industrial Organisations who has missed to update the RABT Certification Form after it has been declined.
                case 'remindertosuppmissedtoupdate':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = 'Reminder: RABT '.$model[ 'suppOrOrg' ].' Certification: Form Status – Declined ('.$model[ 'suppRegNo' ].')';
                    $preheadertext = 'Update and submit for validation ';
                    $preheadertext_ar = 'حدث الاستمارة و قدمهاوقدمها للتدقيق';
                    $content = $this->renderPartial( '..\remindertosuppmissedtoupdatemail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\remindertosuppmissedtoupdatemail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                // 7.2.Reminder mail to Suppliers who have missed to update the RABT Supply Chain Certification Form after it has been declined. // RABT Certified //
                case 'remindertocertsuppmissedtoupdate':
                    $model = \common\components\Mail::getsuppforbackendapproval( $userpk );
                    $mail[ 'subject' ] = 'Reminder: RABT '.$model[ 'suppOrOrg' ].' Certification: Updated Form Status – Declined ('.$model[ 'suppCode' ].')';
                    $preheadertext = 'Update and submit for validation  ';
                    $preheadertext_ar = 'حدث الاستمارة و قدمهاوقدمها للتدقيق';
                    $content = $this->renderPartial( '..\remtocertsmissedtoupdatemail', [ 'model' => $model, 'preheadertext'=>$preheadertext ] );
                    $content_ar = $this->renderPartial( '..\remtocertsmissedtoupdatemail_ar', [ 'model' => $model, 'preheadertext'=>$preheadertext_ar ] );
                    break;

                //SCF mails END//

                //Enterprise admin mail START

                case 'usermailsuccess' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail[ 'subject' ] = 'RABT: User Account Created - Verify email ID to activate';
                    $preheadertext = 'Join as a User on RABT';
                    $preheadertext_ar = 'انضم كمستخدم في منصة ربط';
                    $content = $this->renderPartial( '..\userconfirmmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\userconfirmmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                case 'usersetpasswordsuccess' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail[ 'subject' ] = 'RABT: Password Updated Successfully';
                    $preheadertext = 'Your password has been set, you can now login to RABT ';
                    $preheadertext_ar = 'لقد تم تعيين كلمة المرور بإمكانك الآن تسجيل الدخول إلى ربط';
                    $content = $this->renderPartial( '..\usersetpassword', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\usersetpassword_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    
                    break;

                case 'inviteusermailsuccess' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $encryptedPk = Security::encrypt($userinvitepk);
                    $baseUrl = \Yii::$app->params['baseUrl'];
                    $userregloglink = $baseUrl."registration/user?pk=$encryptedPk&type=Mw==";
                    $mail[ 'subject' ] = 'RABT: Invitation to Register as a User on RABT';
                    $preheadertext = 'Join with your team on RABT';
                    $preheadertext_ar = 'انضم إلى فريقك في منصة ربط';
                    $content = $this->renderPartial( '..\inviteusermail', ['invitelink'=>$userregloglink, 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\inviteusermail_ar', ['invitelink'=>$userregloglink, 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                case 'inviteduserregsuccess' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail[ 'subject' ] = 'RABT: Approve new User - '.$model[ 'firstname' ].' '.$model[ 'lastname' ];
                    $preheadertext = 'Approve the User as part of your Team / Company';
                    $preheadertext_ar = 'الموافقة على انضمام المستخدم كجزء من فريقك / شركتك';
                    $content = $this->renderPartial( '..\inviteduserregmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\inviteduserregmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                case 'inviteuserregapprovedmail' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail[ 'subject' ] = 'RABT: Your User Account has been Activated';
                    $preheadertext = 'Set your RABT account password';
                    $preheadertext_ar = 'تعيين كلمة المرور لحسابك على منصة ربط';
                    $content = $this->renderPartial( '..\inviteuserregapproved', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\inviteuserregapproved_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                case 'inviteuserregistereddeletemail' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail[ 'subject' ] = 'RABT: Your User account has been deleted by your Company Admin';
                    $preheadertext = 'We regret to inform that your account has been deleted';
                    $preheadertext_ar = 'نأسف لإبلاغك بإنه تم حذف حسابك';
                    $content = $this->renderPartial( '..\inviteuserregistereddelete', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\inviteuserdeleted_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;
                case 'userconfirmmailid' :
                    $model = \common\components\Mail::geteadminuserdata( $userpk, $adminpk );
                    $mail['to']= $model['adminemail'];
                    $mail[ 'subject' ] = 'RABT: '.$model[ 'firstname' ].' '.$model[ 'lastname' ].' User has confirmed their email';
                    $preheadertext = 'The User is now part of your Team/Company';
                    $preheadertext_ar = 'أصبحت جزءا من فريقنا';
                    $content = $this->renderPartial( '..\userconfirmmailidmail', [ 'model' => $model, 'preheadertext' => $preheadertext ] );
                    $content_ar = $this->renderPartial( '..\userconfirmmailidmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar ] );
                    break;

                // Enterprise admin mail END    
                //Portal Admin mail start
                // 1.1 Mail to the Industrial Organisation / Supply Chain / International with the updated RABT Industrial Organisation Certification (Validity Period remains the same)
                case 'pacertchangemail' :
                    $model = \common\components\Mail::getcertificationinfo($userpk);
                    $mail['to']= $model['adminemail'];
                    $mail['subject'] = '(RABT Code) Re-issued RABT '.$model['suppOrOrg'].' Certificate - Name Change';
                    $preheadertext = 'We have updated your RABT '.$model['suppOrOrg'].' Certificate';
                    $preheadertext_ar = 'We have updated your RABT '.$model['suppOrOrg_ar'].' Certificate';
                    $content = $this->renderPartial( '..\companynamechangecertmail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\companynamechangecertmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                // 2.1 Back-end team change the Primary user as another user from the Organisation
                case 'paprimaryuserchangemail' :              
                    $userinfo = UsermstTbl::findOne($userpk);
                    $newadminuserinfo = UsermstTbl::findOne($newuserpk);
                    $model['admin'] = $userinfo;
                    $model['user'] = $newadminuserinfo;
                    $model['stktype'] = $userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk;
                    $model['compnayname'] = $userinfo->membercompany->MCM_CompanyName;
                    $model['compnayname_ar'] = $userinfo->membercompany->MCM_CompanyName_ar;
                    $model['suppOrOrg'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'Supplier' : 'Industrial Organisation';
                    $model['suppOrSupOrgen'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'Supply Chain' : 'Industrial Organisation';
                    $model['suppOrSup_ar'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'للمورد' : 'نشطة المستخدم';
                    $model['suppOrOrg_ar'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'لسلسلة التوريد' : 'نشطة المستخدم';
                    $model['login_link'] = $baseUrl.'admin/login';
                    $model['baseUrl'] = $baseUrl;
                    $mail['to']= $newadminuserinfo->UM_EmailID;
                    $mail['subject'] = 'RABT: Primary User Updated';
                    $preheadertext = 'You are now the primary user';
                    $preheadertext_ar = 'أنت المستخدم الأساسي الآن';
                    $content = $this->renderPartial( '..\paprimaryuserchangemail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\paprimaryuserchangemail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                // 2.2 Mail to the existing Primary user on the change
                case 'paexistprimaryusermail' :
                    $userinfo = UsermstTbl::findOne($userpk);
                    $model['admin'] = $userinfo;
                    $model['compnayname'] = $userinfo->membercompany->MCM_CompanyName;
                    $model['compnayname_ar'] = $userinfo->membercompany->MCM_CompanyName_ar;
                    $model['login_link'] = $baseUrl.'admin/login';
                    $model['baseUrl'] = $baseUrl;
                    $mail['to']= $userinfo->UM_EmailID;
                    $mail['subject'] = 'RABT: Primary User Updated';
                    $preheadertext = 'You are now a User';
                    $preheadertext_ar = 'أنت المستخدم الآن!';
                    $content = $this->renderPartial( '..\paexistprimaryusermail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\paexistprimaryusermail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                // 3.1 Mail to the respective Industrial Organisation to make payment for the updated classification with the Proforma Invoice copy attached
                case 'paclschangetousermail' :
                    $model = \common\components\Mail::getsupplierregmaildtls($userpk);
                    $model['login_link'] = $baseUrl.'admin/login';
                    $model['baseUrl'] = $baseUrl;
                    $mail['to']= $model['emailid'];
                    $mail['bcc']= 'rabtfeedback@rabt.om';
                    $model['suppOrOrg'] = ($model['stktype'] == 6)? 'Supply Chain' : 'Industrial Organisation';
                    $model['supplieorOrg_ar'] = ($model['stktype'] == 6)? 'لسلسلة التوريد' : 'للمنشأة';
                    $mail['subject'] = $model['regno'].': Classification Update - Complete Payment';
                    $preheadertext = 'Attached is the Proforma Invoice copy';
                    $preheadertext_ar = 'مرفق نسخة الفاتورة الأولية';
                    $mail[ 'attachment' ] = [ 1 => $model[ 'invoicepath' ] ];
                    $content = $this->renderPartial( '..\paclschangetousermail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\paclschangetousermail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                // 3.2 Mail to back-end finance team with invoice copy attached
                case 'paclschangetoadminmail' :
                    $model = \common\components\Mail::getsupprefmailtoadmindtls($userpk);
                    $cls_data = \common\components\Mail::getOldNewClsInfo($model['regpk']);
                    $model['classification_old'] = $cls_data['classification_old'];
                    $model['classification_oldar'] = $cls_data['classification_oldar'];
                    $model['classification_new'] = $cls_data['classification_new'];
                    $model['classification_newar'] = $cls_data['classification_newar'];
                    $model['login_link'] = $baseUrl.'admin/login';
                    $model['baseUrl'] = $baseUrl;
                    $mail['to']= 'accounts@rabt.om';
                    $model['suppOrOrg'] = ($model['stktype'] == 6)? 'Supply Chain' : 'Industrial Organisation';
                    $model['suppliercode'] = ($model['ValSubStatus'] == 'A')? 'RABT Code' : 'RABT Registration Number';
                    $model['suppliercode_ar'] = ($model['ValSubStatus'] == 'A')? 'رقم تسجي' : 'ل ربط / رمز ربط';
                    $mail['subject'] = $model['regno'].': '.$model['suppOrOrg'].' - Classification Update';
                    $preheadertext = 'An Industrial Organisation has registered on RABT';
                    $preheadertext_ar = 'لقد سجلت منشأة صناعية في ربط';
                    $mail[ 'attachment' ] = [ 1 => $model[ 'invoicepath' ] ];
                    $content = $this->renderPartial( '..\paclschangetoadminmail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\paclschangetoadminmail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                // 5.1 Mail to the respective company that their subscription/account on RABT is de-activates
                case 'pastkdeactivatemail' :
                    $userinfo = UsermstTbl::findOne($userpk);
                    $model['compnayname'] = $userinfo->membercompany->MCM_CompanyName;
                    $model['compnayname_ar'] = $userinfo->membercompany->MCM_CompanyName_ar;
                    $model['deactivate_comments'] = $userinfo->uMMemberRegMstFk->mrm_occomments;
                    $model['suppOrOrg'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'Supply Chain' : 'Industrial Organisation';
                    $model['supplieorOrg_ar'] = ($userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk == 6)? 'لسلسلة التوريد' : 'للمنشأة';
                    $model['baseUrl'] = $baseUrl;
                    $mail['to']= $userinfo->UM_EmailID;
                    $model['stktype'] = $userinfo->uMMemberRegMstFk->mrm_stkholdertypmst_fk;
                    $mail['bcc'] = 'rabtfeedback@rabt.om';
                    $mail['subject'] = 'RABT: Your Subscription has been deactivated';
                    $preheadertext = 'Re-register on RABT if you wish to use the platform';
                    $preheadertext_ar = 'يرجى إعادة التسجيل في منصة ربط إذا كنت ترغب في استخدام المنصة';
                    $content = $this->renderPartial( '..\pastkdeactivatemail', [ 'model' => $model, 'preheadertext' => $preheadertext, 'subject' => $mail['subject'] ] );
                    $content_ar = $this->renderPartial( '..\pastkdeactivatemail_ar', [ 'model' => $model, 'preheadertext' => $preheadertext_ar, 'subject' => $mail['subject'] ] );
                    break;
                //Portal Admin mail end 
                }
           
            $mail['body'] = $this->renderPartial('..\template', ['content'=> $content, 'preheadertext' => $preheadertext,'view'=> $view,'queryparams'=> $queryparams]);
         
            if($view)
            {
                if($view == 'ar')
                {
                    $mail['body'] = $this->renderPartial('..\template_ar', ['content'=> $content_ar, 'preheadertext' => $preheadertext_ar,'view'=> $view,'type'=>$type,'userpk'=>$userpk,'queryparams'=> $queryparams]);
                    echo $mail['body'];
                    exit;
                }
                echo $mail['body'];
                exit;
            }
            else
            {
                    $mail_msg = Yii::$app->mailer->compose()
                    ->setFrom(['noreply@rabt.om'=>'RABT'])
                //   ->setTo('sangavi@businessgateways.com');
                     ->setTo(\Yii::$app->params['testMailIDs']);   
//                    ->setTo($mail['to']);
//                    if(!empty($mail['cc'])){
//                        $mail_msg->setCc($mail['cc']);
//                    }  
//                    if(!empty($mail['bcc'])){          
//                        $mail_msg->setBcc($mail['bcc']);
//                    }
                    
                     if(!empty($cc_emails)){
                        $mail_msg->setCc('jeeva@businessgateways.com');
                    }  
                    
                    if(!empty($bcc_emails)){          
                        $mail_msg->setBcc('siddharthan@businessgateways.com');
                    }
                   
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

    private function merge_fields($template_id, $primary_key, $ref_id, $addi_params) {
        try {
            $template = MaildevTemplatesHsty::find()->where(['maildev_templates_id' => $template_id])->orderBy(['id' => SORT_DESC])->limit(1)->one();
           
            if ($template) {
                $html = $template->content;
                $subject = $template->name;
                $preheader_text = $template->preheader_text;
                $recipients = $template->recipients;
                $cc_recipients = $template->cc_recipients;
                $bcc_recipients = $template->bcc_recipients;
                $system_fields = MaildevSystemfields::find()->all();
                $emails = [];
                $cc_emails = [];
                $bcc_emails = [];
                foreach ($system_fields as $system_field):
                    if ($recipients && strpos($recipients, $system_field->field) !== false) {
                        if ($system_field->value) {
                            $emails = str_replace($system_field->field, $system_field->value, $recipients);
                        }
                    }
                    if ($cc_recipients) {
                        if ($system_field->value) {
                            $cc_emails = str_replace($system_field->field, $system_field->value, $cc_recipients);
                        }
                    }
                    if ($bcc_recipients) {
                        if ($system_field->value) {
                            $bcc_emails = str_replace($system_field->field, $system_field->value, $bcc_recipients);
                        }
                    }
                    $html = str_replace($system_field->field, html_entity_decode(strip_tags($system_field->value)), $html);
                    $subject = str_replace($system_field->field, $system_field->value, $subject);
                endforeach;
                /* BOF Modules Fields */
                $main_table = Modules::find()
                        ->select('ref_table')
                        ->where([
                            'module' => $template->module,
                            'sub_module' => $template->sub_module, 'relation_column' => NULL])
                        ->one();
                $relation_tables = Modules::find()
                        ->select('ref_table, relation_column, table_alias')
                        ->where([
                            'module' => $template->module,
                            'sub_module' => $template->sub_module])
                        ->andWhere(['IS NOT', 'relation_column', null])
                        ->groupBy('ref_table')
                        ->all();
                $table_fields = Modules::find()
                        ->select('field_name, ref_table, field_ref_table, relation_column, table_alias')
                        ->where([
                            'module' => $template->module,
                            'sub_module' => $template->sub_module])
                        ->all();
                        //echo '<pre>'; print_r($table_fields); exit;
                
                foreach ($table_fields as $table_field):
                    $tbl = explode('.', $table_field->ref_table);
                    if (count($tbl) > 4) {
                        $field_alias = (!is_null($table_field->table_alias)) ? $table_field->table_alias : $tbl[4];
                    }elseif (count($tbl) > 3) {
                        $field_alias = (!is_null($table_field->table_alias)) ? $table_field->table_alias : $tbl[3];
                    }elseif (count($tbl) > 2) {
                        $field_alias = (!is_null($table_field->table_alias)) ? $table_field->table_alias : $tbl[2];
                    }elseif (count($tbl) > 1) {
                        $field_alias = (!is_null($table_field->table_alias)) ? $table_field->table_alias : $tbl[1];
                    } else {
                        $field_alias = $table_field->ref_table;
                    }
                    if($table_field->field_ref_table=='mcid_invoicepath'){
                        $table_column = '`' . $tbl[2] . '`.`' . $table_field->field_ref_table . '`';
                    }else{
                        // $fields[] = (!is_null($table_field->table_alias)) ? $table_field->table_alias . '.' . $table_field->field_ref_table . ' as ' . $table_field->table_alias . $table_field->field_ref_table : $field_alias . '.' . $table_field->field_ref_table;
                        $table_column = (!is_null($table_field->table_alias)) ? $table_field->table_alias : '`' . $field_alias . '`.`' . $table_field->field_ref_table . '`';
                    }
                    if($template->module == 'CMS' && $template->sub_module == 'Purchase/Contract order' && $field_alias == 'usermst_tbl') {
                        $table_column = "CASE WHEN `usermst_tbl`.`UM_Type` = 'A' THEN $table_column ELSE '' END AS $table_field->field_ref_table";
                    }
                    $fields[] = $table_column;
                endforeach;
                // var_dump($fields);exit;
                $fields = implode(', ', $fields);
        
                if ($table_fields && $main_table) {
                    try {
                        $query = (new \yii\db\Query())
                                ->select("$fields")
                                ->from($main_table->ref_table);
                        if ($relation_tables) {
                            $order_by = FALSE;
                            $sameTable[] = $main_table->ref_table;
                            $branch = 1;
                            foreach ($relation_tables as $relation_table):
                                $superFlag = false;
                                $ref_tables = explode('.', $relation_table->ref_table);
                                $relation_cols = explode('.', $relation_table->relation_column);
                                $alias = (!is_null($relation_table->table_alias)) ? $relation_table->table_alias : $ref_tables[1];
                                $extra_condition = $tail = '';

                                $ref_tablesArray = ['contactusdtls_tbl', 'memberregistrationmst_tbl', 'countrymst_tbl', 'membercompanymst_tbl', 'cmsawarddtls_tbl', 'usermst_tbl'];
                            
                                if (strpos($relation_cols[1], "#") !== false) { // for additional column using # symbol
                                    $relation_cols[1] = explode('#', $relation_cols[1]);
                                    $extra_condition = ' AND ' . $relation_cols[1][1];
                                    $relation_cols[1] = $relation_cols[1][0];
                                } elseif(strpos($relation_cols[1], "*") !== false) { // for Third table relation
                                    if(!empty($ref_tables[4])){
                                        $multi_relation = explode('*', $relation_cols[1]);
                                        $multi_relation_cols = explode('@', $multi_relation[1]);
                                        
                                        if(($ref_tables[2]!='membercompanymst_tbl') && !in_array($ref_tables[2], $sameTable)){
                                            $query->leftJoin($ref_tables[2], $ref_tables[1] . '.' . $multi_relation_cols[0] . ' = ' . $ref_tables[2] . '.' . $multi_relation_cols[1]);
                                            $sameTable[] = $ref_tables[2];
                                        }
                                        if(!in_array($ref_tables[3], $sameTable)){
                                            $query->leftJoin($ref_tables[3], $ref_tables[2] . '.' . $multi_relation_cols[1] . ' = ' . $ref_tables[3] . '.' . $multi_relation_cols[2]);
                                            $sameTable[] = $ref_tables[3];
                                        }
                                        if(!in_array($ref_tables[4], $sameTable)){
                                            $query->leftJoin($ref_tables[4], $ref_tables[3] . '.' . $multi_relation_cols[2] . ' = ' . $ref_tables[4] . '.' . $multi_relation_cols[3]);
                                            $sameTable[] = $ref_tables[4];
                                        }
                                        $relation_cols[1] = $multi_relation[0];  
                                    }elseif(!empty($ref_tables[3])){
                                        $multi_relation = explode('*', $relation_cols[1]);
                                        $multi_relation_cols = explode('@', $multi_relation[1]);                                        
                                        if($branch == 1 || $ref_tables[2]!='memcompbranchdtlsmain_tbl'){
                                            if(($ref_tables[2]!='membercompanymst_tbl' || $ref_tables[2]!='memcompinvoicedtls_tbl') && !in_array($ref_tables[4], $sameTable)){
                                                $query->leftJoin($ref_tables[2], $ref_tables[1] . '.' . $multi_relation_cols[0] . ' = ' . $ref_tables[2] . '.' . $multi_relation_cols[1]);
                                                $sameTable[] = $ref_tables[2];
                                            }
                                        }   
                                        if($branch==2){
                                            $branch = 1;   
                                        }                                                                             
                                        if($ref_tables[2]=='memcompbranchdtlsmain_tbl'){
                                            $branch = ++$branch;                                            
                                        }
                                        if(!in_array($ref_tables[3], $sameTable)){
                                            $query->leftJoin($ref_tables[3], $ref_tables[2] . '.' . $multi_relation_cols[2] . ' = ' . $ref_tables[3] . '.' . $multi_relation_cols[3]);
                                            $relation_cols[1] = $multi_relation[0];  
                                            $sameTable[] = $ref_tables[3];
                                        }
                                       
                                    }else{
                                        $multi_relation = explode('*', $relation_cols[1]);
                                        $multi_relation_cols = explode('@', $multi_relation[1]);
                                        if(!in_array($ref_tables[1], $sameTable) && $ref_tables[1]=='memberregistrationmst_tbl'){
                                            $query->leftJoin($ref_tables[1], $ref_tables[0] . '.' . $relation_cols[0] . ' = ' . $multi_relation[0]);
                                            $same_table1 = FALSE;
                                            $sameTable[] = $ref_tables[1];
                                        }
                                        $superFlag = true;
                                        $relation_cols[1] = $multi_relation[0];  
                                    }
                                }elseif(strpos($relation_cols[1], "~") !== false){ // order by column using ~ symbol 
                                    $order_columns = explode('~', $relation_cols[1]);
                                    $order_id = $alias . '.' . $order_columns[1];
                                    $relation_cols[1] = $order_columns[0];
                                    $order_by = TRUE;
                                }
                                if(!in_array($ref_tables[1], $sameTable)){
                                    $query->leftJoin($ref_tables[1], $ref_tables[0] . '.' . $relation_cols[0] . ' = ' . $relation_cols[1] . $extra_condition);
                                    $sameTable[] = $ref_tables[1];
                                }
                                
                                if($superFlag) {
                                    if(!in_array($ref_tables[2], $sameTable)){
                                        $query->leftJoin($ref_tables[2], $ref_tables[1] . '.' . $multi_relation_cols[0] . ' = ' . $ref_tables[2] . '.' . $multi_relation_cols[1]);
                                        $sameTable[] = $ref_tables[2];
                                    }
                                }
                            endforeach;
                        }
                        if($template_id==233){
                            $query->where([$primary_key => $ref_id]);
                        }else{
                            $query->where([$main_table->ref_table . '.' . $primary_key => $ref_id]);
                        }

                        if($template->module == 'CMS' && $template->sub_module == 'Purchase/Contract order'){
                            $query->andwhere(['cmsawarddtls_tbl.cmsad_isprimarycontractor' => 1]);
                        }
                        if(in_array($template_id,[298])){
                            $query->orderBy(['memcompinvoicedtls_tbl.memcompinvoicedtls_pk'=>SORT_DESC]);
                            $query->limit(1);
                        }elseif(in_array($template_id,[299,300,342])){
                            $query->orderBy(['memcomppymtinfodtls_tbl.memcomppymtinfodtls_pk'=>SORT_DESC]);
                            $query->limit(1);
                        }elseif($order_by){
                            $query->orderBy([$order_id => SORT_DESC]);
                            $query->limit(1);
                        }
                        //  $row = $query->createCommand()->sql;
                        //  echo $row; exit;
                        $row = $query->one();
                    } catch (Exception $exc) {
                        $row = [];
                    }
                    $attachment=[];
                    if ($row) {
                        $word = ' {
                ' . $primary_key . '}
                ';
                        if (strpos($html, $word) !== false) {
                            $html = str_replace($word, Yii::$app->security->maskToken($primary_key), $html);
                        }                        
                        foreach ($table_fields as $field):
                            $field_ref_table = trim($row[($field->field_ref_table)]);
                           
                            if($field->table_alias){
                                $table_alias = explode('as', $field->table_alias);
                                $field_ref_table = $row[trim($table_alias[1])];  
                            }
                        
                            $field_name = (isset($field->field_name) && !is_null($field->field_name)) ? trim($field->field_name) : '';
                            
                            if ($recipients && strpos($recipients, $field_name) !== false) {
                                if ($field_ref_table) {
                                    $emails = str_replace($field_name, $field_ref_table, $recipients);
                                }
                            }
                            if ($cc_recipients) {
                                if ($field_ref_table) {
                                    $cc_emails = str_replace($field_name, $field_ref_table, $cc_recipients);
                                }
                            }
                            if ($bcc_recipients) {
                                if ($field_ref_table) {
                                    $bcc_emails = str_replace($field_name, $field_ref_table, $bcc_recipients);
                                }
                            }        
                          
                            if($field_name==' {
                    CLASSIFICATION}
                    '){
                                if(!empty($field_ref_table)){
                                    $classification = $field_ref_table;
                                }else{
                                    $classification = 'International';
                                }
                                $html = str_replace($field_name, $classification, $html);
                            }elseif($field_name==' {
                        COMP_PK_ENC}
                        ' || $field_name==' {
                            REG_PK_ENC}
                            '){                                
                                $encrypt_pk = \common\components\Security::encrypt($field_ref_table);
                                $html = str_replace($field_name, $encrypt_pk, $html);
                            }elseif($field_name==' {
                                COMP_PK_BS64ENC}
                                '){                                
                                $comp_encrypt_pk = base64_encode($field_ref_table);
                                $html = str_replace($field_name, $comp_encrypt_pk, $html);
                            }elseif($field_name==' {
                                    PROD_SERV_COMPPK}
                                    '){         
                                $did_value = base64_encode('prodserv'.$field_ref_table.date('dmy'));
                                $html = str_replace($field_name, $did_value, $html);
                            }elseif($field_name==' {
                                        SUPPLIER_INVOICE}
                                        ' && in_array($template_id, [157,159,298])){
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $reg_pk = $user_info->UM_MemberRegMst_Fk;
                                    $appUrl = \Yii::$app->params['APP_URL'];
                                    $performainvoice_path = $field_ref_table;
                                    if(!empty($performainvoice_path)){
                                        $html = str_replace(' {
                                            SUPPLIER_INVOICE}
                                            ', '', $html);
                                        $attachment[] = $appUrl."backend/invoice/".$reg_pk."/".$performainvoice_path;
                                    }
                                }
                            }elseif($field_name==' {
                                                SUPPLIER_TAXINVOICE}
                                                ' && $template_id==299){
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $reg_pk = $user_info->UM_MemberRegMst_Fk;
                                    $appUrl = \Yii::$app->params['APP_URL'];
                                    $taxinvoice_path = $field_ref_table;
                                    if(!empty($taxinvoice_path)){
                                        $html = str_replace(' {
                                                    SUPPLIER_TAXINVOICE}
                                                    ', '', $html);
                                        $attachment[] = $appUrl."backend/invoice/".$reg_pk."/".$taxinvoice_path;
                                    }
                                }
                            }elseif($field_name==' {
                                                        RECEIPT}
                                                        ' && $template_id==299){
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $reg_pk = $user_info->UM_MemberRegMst_Fk;
                                    $appUrl = \Yii::$app->params['APP_URL'];
                                    $receipt_path = $field_ref_table;
                                    if(!empty($receipt_path)){
                                        $html = str_replace(' {
                                                            RECEIPT}
                                                            ', '', $html);
                                        $attachment[] = $appUrl."backend/receipt/".$reg_pk."/".$receipt_path;
                                    }
                                }                            
                            }elseif($field_name==' {
                                                                USER_INVITE_PK}
                                                                '){    
                                $invite_userpk = $addi_params['USER_INVITE_PK'];
                                $invite_link = \common\components\User::getUserInviteLink($invite_userpk);
                                $html = str_replace($field_name, $invite_link, $html);
                            }elseif($field_name==' {
                                                                    CONTACT_ATTACHMENT}
                                                                    '){ 
                                if(!empty($field_ref_table)){
                                    $attach_link = $this->getAttachments($field_ref_table);
                                    $html = str_replace($field_name, $attach_link, $html);
                                }else{
                                    $html = str_replace(' {
                                                                        CONTACT_ATTACHMENT}
                                                                        ', '', $html);
                                    $html = str_replace('View Attachment', '', $html);
                                }
                            }elseif($field_name==' {
                                                                            SUBSCRIPTION_DURATION}
                                                                            '){ 
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $duration = $user_info->uMMemberRegMstFk->subscription->msm_duration;
                                    $years_remaining = intval($duration / 365);
                                    $duration_year = '';
                                    if($years_remaining==1){
                                        $duration_year = '1 Year';
                                    }elseif($years_remaining==3){
                                        $duration_year = '3 Years';
                                    }
                                    $html = str_replace(' {
                                                                                SUBSCRIPTION_DURATION}
                                                                                ', $duration_year, $html);
                                }
                            }else{
                                $field_data = (!empty($field_ref_table))? $field_ref_table: 'Nil';
                                $html = str_replace($field_name, strip_tags($field_data), $html);
                            }
                            if(strpos($html, ' {
                                                                                    CURRENCY}
                                                                                    ')){
                                $currency='';
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $origin = $user_info->uMMemberRegMstFk->company->MCM_Origin;
                                    if($origin=='N'){
                                        $currency = 'OMR';
                                    }elseif($origin=='I'){
                                        $currency = 'USD';
                                    }
                                }
                                $html = str_replace(' {
                                                                                        CURRENCY}
                                                                                        ', $currency, $html);
                            }elseif(strpos($html, ' {
                                                                                            CUTOFF_EXPIRY}
                                                                                            ')){
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $orderConfirmedOn = $user_info->uMMemberRegMstFk->MRM_OrderConfrmOn;
                                    $added_date = date('d-m-Y', strtotime($orderConfirmedOn. ' + 120 days'));
                                    $html = str_replace(' {
                                                                                                CUTOFF_EXPIRY}
                                                                                                ', $added_date, $html);
                                }
                            }elseif(strpos($html, ' {
                                                                                                    EXPIRY_DATE}
                                                                                                    ')){ //Expiry date
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $expiry_date = $user_info->uMMemberRegMstFk->company->mcm_accexpirydate;
                                    $added_date = date('d-m-Y', strtotime($expiry_date));
                                    $html = str_replace(' {
                                                                                                        EXPIRY_DATE}
                                                                                                        ', $added_date, $html);
                                }
                            }elseif(strpos($html, ' {
                                                                                                            GRACEEXPIRY_DATE}
                                                                                                            ')){ //Expiry date with 10 days grace period
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $expiry_date = $user_info->uMMemberRegMstFk->company->mcm_accexpirydate;
                                    $added_date = date('d-m-Y', strtotime($expiry_date. ' + 10 days'));
                                    $html = str_replace(' {
                                                                                                                GRACEEXPIRY_DATE}
                                                                                                                ', $added_date, $html);
                                }
                            }elseif(strpos($html, ' {
                                                                                                                    GRACEEND_DATE}
                                                                                                                    ')){ //Expiry date with 30 days grace period
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $expiry_date = $user_info->uMMemberRegMstFk->company->mcm_accexpirydate;
                                    $added_date = date('d-m-Y', strtotime($expiry_date. ' + 30 days'));
                                    $html = str_replace(' {
                                                                                                                        GRACEEND_DATE}
                                                                                                                        ', $added_date, $html);
                                }
                            }elseif(strpos($html, ' {
                                                                                                                            GRACETIME_DATE}
                                                                                                                            ')){ //Expiry date with 180 days grace period
                                $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                if(!empty($user_info)){
                                    $expiry_date = $user_info->uMMemberRegMstFk->company->mcm_accexpirydate;
                                    $added_date = date('d-m-Y', strtotime($expiry_date. ' + 180 days'));
                                    $html = str_replace(' {
                                                                                                                                GRACETIME_DATE}
                                                                                                                                ', $added_date, $html);
                                }
                            }elseif(strpos($html, ' {
                                                                                                                                    PYMT_CONTRACTNAME}
                                                                                                                                    ')){
                                $user_info1 = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                $rsreg_pk = $user_info1->UM_MemberRegMst_Fk;
                                $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $rsreg_pk,'um_pymtcontact'=>1])->one();
                                if(!empty($user_info)){
                                    $pymt_contact_name = $user_info->um_firstname.' '.$user_info->um_lastname;
                                    $pymt_email= $user_info->UM_EmailID;
                                    $pymt_phone = $user_info->primobnocc->CyM_CountryDialCode.' '.$user_info->um_primobno;
                                    $designation = $user_info->designation->dsg_designationname;
                                    $html = str_replace(' {
                                                                                                                                        PYMT_CONTRACTNAME}
                                                                                                                                        ', $pymt_contact_name, $html);
                                    $html = str_replace(' {
                                                                                                                                            PYMT_EMAIL}
                                                                                                                                            ', $pymt_email, $html);
                                    $html = str_replace(' {
                                                                                                                                                PYMT_PHONE}
                                                                                                                                                ', $pymt_phone, $html);
                                    $html = str_replace(' {
                                                                                                                                                    PYMT_DESIGNATION}
                                                                                                                                                    ', $designation, $html);
                                }
                            }
                            if(!empty($preheader_text)){
                                $html = str_replace(' {
                                                                                                                                                        PREHEADER_TEXT}
                                                                                                                                                        ', $preheader_text, $html);
                            }
                           
                            if(!empty($addi_params)){    
                                if(isset($addi_params['NOTIFY_USERPK'])){
                                    $addi_userpk = $addi_params['NOTIFY_USERPK'];
                                    $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $addi_userpk])->one();
                                    $html = str_replace('NOTIFY_USERPK', $user_info->UM_LoginId, $html);
                                }
                                if(isset($addi_params['NOTIFY_COMPANY'])){
                                    $addi_userpk = $addi_params['NOTIFY_COMPANY'];
                                    $comp_name = $this->getCompanyName($addi_userpk);
                                    $html = str_replace('NOTIFY_COMPANY', $comp_name, $html);
                                }
                                if(isset($addi_params['NOTIFY_EXUSERNAME'])){
                                    $addi_userpk = $addi_params['NOTIFY_EXUSERNAME'];
                                    $user_info = UsermstTbl::find()->where(['UserMst_Pk' => $addi_userpk])->one();
                                    $username = $user_info->um_firstname . " " . $user_info->um_middlename . " ". $user_info->um_lastname;
                                    $html = str_replace('NOTIFY_EXUSERNAME', $username, $html);
                                }
                                if($template_id==230){  
                                    $addi_userpk = $addi_params['NOTIFY_USERPK'];
                                    $current_user = UsermstTbl::find()->where(['UserMst_Pk' => $ref_id])->one();
                                    $current_userpk = \common\components\Security::encrypt($ref_id);
                                    $new_userpk = \common\components\Security::encrypt($addi_userpk);
                                    $generatetime = \common\components\Security::encrypt($current_user->um_changeuseron);
                                    $html = str_replace('CURRENT_USERPK_ENC', $current_userpk, $html);
                                    $html = str_replace('NEW_USERPK_ENC', $new_userpk, $html);
                                    $html = str_replace('GENERATE_TIME', $generatetime, $html);
                                }

                                if(isset($addi_params['RFX_TYPE'])){
                                   $rfx_type = $addi_params['RFX_TYPE'];
                                   $rfx_title = [
                                       'RFQ' => 'Request for Quotation',
                                       'RFI' => 'Request for Information ',
                                       'EOI' => 'Expression of Interest',
                                       'RFT' => 'Request for Tender',
                                       'PQ' => 'Pre-qualification'
                                   ];
                                  
                                    $html = str_replace(' {
                                                                                                                                                            RFx_type}
                                                                                                                                                            ',$rfx_type, $html);
                                    if(isset($rfx_title[$rfx_type])){
                                        $html = str_replace(' {
                                                                                                                                                                RFx_label}
                                                                                                                                                                ',$rfx_title[$rfx_type], $html);
                                    }   
                                    
                                    if($row['cmsth_skdclosedate']){
                                        $now = strtotime(date('Y-m-d h:i:s'));
                                        $date = strtotime($row['cmsth_skdclosedate']);
                                        $diff = $date - $now; 
                                        $days_left =  round($diff / (60*60*24));
                                        $html = str_replace(' {
                                                                                                                                                                    RFx_days_left}
                                                                                                                                                                    ', $days_left, $html);
                                    }

                                    $subject = str_replace(' {
                                                                                                                                                                        RFx_type}
                                                                                                                                                                        ', $rfx_type, $subject);
                                }

                                if(isset($addi_params['CONTRACT_TYPE'])){
                                    $obligation_type = [
                                        '1' => 'MSME', '2'=> 'LCC', '3' => 'MSME & LCC', '4' => 'Others', '5' => 'Not Applicable'];
                                    
                                    $html = str_replace(' {
                                                                                                                                                                            contract_type}
                                                                                                                                                                            ', $addi_params['CONTRACT_TYPE'], $html);
                                    
                                    $html = str_replace(' {
                                                                                                                                                                                contract_obligation_type}
                                                                                                                                                                                ', $obligation_type[$row['cmsch_obligation']], $html);
                                }

                                if(isset($addi_params['rfx_view_url'])){
                                    $html = str_replace(' {
                                                                                                                                                                                    RFx_view_url}
                                                                                                                                                                                    ', $addi_params['rfx_view_url'], $html);
                                }
                                if(isset($addi_params['rfx_supplier_company'])){
                                    $html = str_replace(' {
                                                                                                                                                                                        RFx_supplier_company}
                                                                                                                                                                                        ', $addi_params['rfx_supplier_company'], $html);
                                }
                                if(isset($addi_params['respond_btn'])){
                                    $html = str_replace(' {
                                                                                                                                                                                            RFx_respond_btn}
                                                                                                                                                                                            ', $addi_params['respond_btn'], $html);
                                }
                                if(isset($addi_params['rfx_status_comment'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                RFx_status_comment}
                                                                                                                                                                                                ', $addi_params['rfx_status_comment'], $html);
                                }
                                if(isset($addi_params['view_btn'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                    contract_view_btn}
                                                                                                                                                                                                    ', $addi_params['view_btn'], $html);
                                }

                                if(isset($addi_params['attachment'])){
                                    $attachment[] = $addi_params['attachment'];
                                } 
                                if(isset($addi_params['receiver_name'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                        receiver_name}
                                                                                                                                                                                                        ', $addi_params['receiver_name'], $html);
                                }
                                if(isset($addi_params['PREV_INCORP_STYLE'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                            PREV_INCORP_STYLE}
                                                                                                                                                                                                            ', $addi_params['PREV_INCORP_STYLE'], $html);
                                }
                                if(isset($addi_params['USER_SUBMITTEDON'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                                USER_SUBMITTEDON}
                                                                                                                                                                                                                ', $addi_params['USER_SUBMITTEDON'], $html);
                                }
                                if(isset($addi_params['CUT_OFF_DATE'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                                    CUT_OFF_DATE}
                                                                                                                                                                                                                    ', $addi_params['CUT_OFF_DATE'], $html);
                                }
                                if(isset($addi_params['RW_CERT_TYPE'])){
                                    $html = str_replace(' {
                                                                                                                                                                                                                        RW_CERT_TYPE}
                                                                                                                                                                                                                        ', $addi_params['RW_CERT_TYPE'], $html);
	                            }
                            }
                            
                            $jsrs_connect = \Yii::$app->params['jsrs_connect_url'];
                            if(strpos($html, ' {
                                                                                                                                                                                                                            jsrs_connect_btn}
                                                                                                                                                                                                                            ')){
                                $jsrs_connect_btn = '<a href = "'.$jsrs_connect.'"><b>JSRS Connect</b></a>';
                                $html = str_replace(' {
                                                                                                                                                                                                                                jsrs_connect_btn}
                                                                                                                                                                                                                                ', $jsrs_connect_btn, $html);
                            }
                            $baseUrl = \Yii::$app->params['baseUrl'];
                            $html = str_replace(' {
                                                                                                                                                                                                                                    BASE_URL}
                                                                                                                                                                                                                                    ', $baseUrl, $html);
                            $appUrl = \Yii::$app->params['APP_URL'];
                            $html = str_replace(' {
                                                                                                                                                                                                                                        APP_URL}
                                                                                                                                                                                                                                        ', $appUrl, $html);
                            $subject = str_replace($field_name, $field_ref_table, $subject);
                        endforeach;
                    }
                    // echo  $html; die;
                    /* EOF Modules Fields */
                    $html = str_replace('[ BASEURL ]', \yii\helpers\Url::home(true), $html);
                    return ['emails' => $emails, 'cc_emails' => $cc_emails, 'bcc_emails' => $bcc_emails, 'subject' => $subject, 'body' => html_entity_decode($html), 'attachment' => $attachment];
                }
            } else {
                return FALSE;
            }
        } catch (Exception $exc) {
            return FALSE;
        } catch (\yii\base\Exception $exc) {
            return FALSE;
        }
    }
    public function insertmaildata($user_pk, $template_id, $html){
        $file_name = time().rand(4,1000).".html";
        if (!file_exists('./web/mails')) {
            mkdir('./web/mails', 0777, true);
        }
        $newFileName = './web/mails/'.$file_name;
        $appUrl = \Yii::$app->params['APP_URL'];
        $browser_link = $appUrl.'api/web/mails/'.$file_name;
        $html['body'] = str_replace(' {
                                                                                                                                                                                                                                            VIEW_BROWSER}
                                                                                                                                                                                                                                            ', $browser_link, $html['body']);
        // -------- remove the utf-8 BOM ----
        $html['body'] = str_replace("\xEF\xBB\xBF",'',$html['body']); 
        file_put_contents($newFileName, $html['body']);     
        $this->mailhistory($user_pk, $template_id, $file_name, $html['subject']);
    }
    public function mailhistory($user_pk, $template_id, $file_name, $subject){
        $query = (new \yii\db\Query())
            ->select("comp.MemberCompMst_Pk as comp_pk")
            ->from('usermst_tbl um')
            ->leftJoin('membercompanymst_tbl comp', 'comp.MCM_MemberRegMst_Fk = um.UM_MemberRegMst_Fk')
            ->where(['um.UserMst_Pk' => $user_pk])
            ->one();
        if(!empty($query)){
            $mem_comppk = $query['comp_pk'];
            $model = new MaillistingTbl();
            $model->ml_membercompmst_fk = $mem_comppk;
            $model->ml_usermst_fk = $user_pk;
            $model->ml_id = $template_id;
            $model->ml_senton = date('Y-m-d H:i:s');
            $model->ml_sentby = $user_pk;
            $model->ml_filename = $file_name;
            $model->save();
        }
    }
    public function getbrowserlink($template_id, $user_id){
        $filename='';
        $listing = MaillistingTbl::find()->where(['ml_id' => $template_id,'ml_usermst_fk' => $user_id])->orderBy(['maillisting_pk' => SORT_DESC])->limit(1)->one();
        if(!empty($listing)){
            $filename = $listing->ml_filename;
        }
        return $filename;
    }
    public function getCompanyName($user_pk){
        $company_name='';
        $query = (new \yii\db\Query())
            ->select("comp.MCM_CompanyName as comp_name")
            ->from('usermst_tbl um')
            ->leftJoin('membercompanymst_tbl comp', 'comp.MCM_MemberRegMst_Fk = um.UM_MemberRegMst_Fk')
            ->where(['um.UserMst_Pk' => $user_pk])
            ->one();
        if(!empty($query)){
            $company_name = $query['comp_name'];
        }
        return $company_name;
    }
    public function getAttachments($data){
        $path='';
        if(!empty($data)){
            $d_arr = explode(', ', $data);
            $appUrl = \Yii::$app->params['APP_URL'];
            $srcDirectory = \Yii::$app->params['srcDirectory'];
            $uploadPath = \Yii::$app->params['uploadPath'];
            $zip = new ZipArchive();
            $folder = $uploadPath. "/contactzip/";
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            $zipFile = $folder .'Images'.date(('YmdHis')).'.zip';
            foreach($d_arr as $key=>$value){
                $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                    ->select(['mcfd_memcompmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                    ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                    ->where(['memcompfiledtls_pk'=>$value])->asArray()->one();
                $companyPk = $file_info['mcfd_memcompmst_fk'];
                $userPk = $file_info['mcfd_uploadedby'];
                $img_name = $file_info['mcfd_sysgenerfilename'];
                $org_name = $file_info['mcfd_origfilename'];
                $phy_filepath = $file_info['fm_phyfilepath'];
                $userDirectory = "comp_" . $companyPk . "/user_" . $userPk;
                $target_path = $uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/';
                //zip process
                if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE)
                {
                    $zip->addFile($target_path.$img_name, $org_name);
                    $zip->close();  
                }
            }
            $path = $appUrl."api/".$zipFile;
        }
        return $path;
    }

    public function actionTestemail(){
        /* email send to test email ids in cofig file */
        $emailid = 'gurpreet@businessgateways.com';
        $app_url = \Yii::$app->params['APP_URL'];
        $baseUrl = \Yii::$app->params['baseUrl'];
        $url = $app_url."api/ma/mail/send";
        $primary_key = 24;
        $encrypted_pk = Security::encrypt($primary_key);
        $btn_url = $baseUrl.'pms/rfxlist?view = '.$encrypted_pk;
        $btn = '<a href = "'.$btn_url.'">Be JSRS Certified to Access the Contract Details</a>';
        $_data = [
            'email'=> $emailid,
            'template_id'=> 156,
            'table_ref_key'=>'UserMst_Pk',
            'table_ref_value'=> $primary_key,
            // 'addi_params' => ['RFX_TYPE'=>'RFQ','respond_btn' => $respond_btn, 'attachment' => '']
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
        echo '<pre>';
        print_r($response);
        die('okk' );
                                                                                                                                                                                                                                            curl_error( $curl );
                                                                                                                                                                                                                                            curl_close( $curl );
                                                                                                                                                                                                                                            exit;
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                    }
