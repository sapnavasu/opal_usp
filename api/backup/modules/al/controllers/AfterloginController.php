<?php

namespace api\modules\al\controllers;

use api\modules\mst\controllers\MasterController;
use \common\components\AfterLogin;
use Yii;
use \common\components\Security;

/**
 * After login controller for the `al` module
 */
class AfterloginController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\CountryMaster';

    public function __construct($id='', $module='', $config = [])
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
    
    public static function actionStakeholderdtls() {
        $regPk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $compPk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $dtls = AfterLogin::stakeholderDetails($regPk,$compPk);
        return $dtls ? $dtls : [];
    }
   
    
    public static function actionOfflinepymtdtl(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['offlinepymt'];
        $save = \common\models\MemcomppymtinfodtlsTbl::saveOfflinePymtDtls($data,'off');
        $proof = '';
        if($save) {
            $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $proof = \common\components\Drive::generateUrl(end($data['proofdoc']),$save->mcpid_membercompmst_fk,$userPk);
        }
        $msg['msg'] = ($save) ? 'success' : 'failure';
        $msg['status'] = ($save) ? 1 : 0;
        $msg['proofdoc'] = $proof;
        return $msg;
    }
    public static function actionOfflinecontractpymtdtl(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['offlinepymt'];
        $save = \common\models\MemcomppymtinfodtlsTbl::saveOfflineContractPymtDtls($data,'off');
        $proof = '';
        if($save) {
            $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $proof = \common\components\Drive::generateUrl(end($data['proofdoc']),$save->mcpid_membercompmst_fk,$userPk);
        }
        $msg['msg'] = ($save) ? 'success' : 'failure';
        $msg['status'] = ($save) ? 1 : 0;
        $msg['proofdoc'] = $proof;
        return $msg;
    }
    
    public function actionSavepaycontact() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['pymtcontact'];
        $data['reg_pk'] = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $data['comp_pk'] = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $enCompPk = \common\components\Security::encrypt($data['comp_pk']);
        $enRegPk = \common\components\Security::encrypt($data['reg_pk']);
        $save = \common\models\UsermstTbl::addOrMapPaymentContact($data);
        $savePackDtls = \common\models\MemberregistrationmstTbl::saveSubPackageDtls($data, $data['reg_pk']);
        $saveClassificationDtls = \common\models\MembercompanymstTbl::saveClassificationDtls($data, $data['comp_pk']);
        $invoice = '';
        if($save) {
            $invoice = AfterLogin::generateInvoice();
            self::generateInvoice($invoice, $data);
            $viewlink = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/viewinvoice?cpk='.$enCompPk.'&rpk='.$enRegPk]);
            $downloadlink = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadinvoice?cpk='.$enCompPk.'&rpk='.$enRegPk]);
            AfterLogin::sendInvoiceMail($data,$viewlink);
        }
        $msg['msg'] = ($save) ? 'success' : 'failure';
        $msg['status'] = ($save) ? 1 : 0;
        $msg['invoice'] = $invoice->memcompinvoicedtls_pk;
        $msg['invoiceLink'] = $downloadlink;
        return $msg ;
    }
    
    public function actionGetpackage() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['classification'];
        $compPk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $dtl = AfterLogin::getClassificationPackage($data, $compPk);
        return $dtl ? $this->asJson($dtl) : [];
    }
    
    public function actionApplypromo() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $requestdata = $data['promocodedtls'];
        $dtl = AfterLogin::checkValidAndApplyPromoCode($requestdata);
        return $this->asJson($dtl);
    }
    
    public function actionSubstatus() {
        $regType = \yii\db\ActiveRecord::getTokenData('reg_type', true);
        $compPk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $data = AfterLogin::isSubscriptionAvailable($regType,$compPk);
        return $data;
    }
   
    public function generateInvoice($invoiceDtls,$paymentDtls) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => '5', 'margin_right' => '5', 'margin_top' => '10', 
            'margin_bottom' => '10', 'margin_header' => '0', 'margin_footer' => '0', 'default_font_size' => '', 'orientation' => 'P','default_font' => 'cairoregular']);
        $mpdf->shrink_tables_to_fit = 1;		
        $mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('../../views/invoice', ['invoiceDtls' => $invoiceDtls, 'paymentDtls' => $paymentDtls]));
        $mpdf->Output("../backend/invoice/$invoiceDtls->mcid_invoiceno.pdf",'F');
    }
    
    public function actionViewinvoice() {
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', true);
        $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', true);
        $fileName = "invoice-$regPk-$compPk.pdf";
        $path = dirname(__FILE__)."/../../../../backend/invoice/";
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename = $fileName");
        @readfile($path.$fileName);
        exit;
    }
    
    public function actionDownloadreceipt() {
    
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', false);
        $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', false);
        $invoicePk = \common\components\Security::sanitizeInput($_REQUEST['invpk'], 'number', false);
        if(!empty($invoicePk)){
            $receiptDetails = \common\models\MemcomppymtrcptdtlsTbl::find()
                ->select(['mcpr_receiptpath'])
                ->where(['mcpr_memcompinvoicedtls_fk'=>$invoicePk])
                ->orderBy(['memcomppymtrcptdtls_pk' => SORT_DESC])
                ->asArray()->one();
            $fileName = (!empty($receiptDetails['mcpr_receiptpath']))? $receiptDetails['mcpr_receiptpath']: "receipt-$regPk-$compPk.pdf";
        }else{
            $fileName = "receipt-$regPk-$compPk.pdf";
        }
        $path = dirname(__FILE__)."/../../../../backend/receipt/".$regPk."/";
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Length:". filesize($path.$fileName));
        @readfile($path.$fileName);
        exit;
    }
    public function actionDownloadtaxinvoice() {
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', true);
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $invoiceid = \common\components\Security::sanitizeInput($_REQUEST['id'], 'number', true);
            $invoiceModel = \common\models\MemcompinvoicedtlsTbl::findOne($invoiceid);
            $fileName = $invoiceModel->mcid_invoicepath;
        } else {
            $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', true);
            $invoiceModel = \common\models\MemcompinvoicedtlsTbl::find()->where("mcid_membercompmst_fk=$compPk")->orderBy('memcompinvoicedtls_pk desc')->one();
            $fileName = $invoiceModel->mcid_invoicepath;
        }
        $path = dirname(__FILE__)."/../../../../backend/invoice/".$regPk."/";
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Length:". filesize($path.$fileName));
        @readfile($path.$fileName);
        exit;
    }
    
    public function actionDownloadinvoice() {
        
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', true);
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $invoiceid = \common\components\Security::sanitizeInput($_REQUEST['id'], 'number', true);
            $invoiceModel = \common\models\MemcompinvoicedtlsTbl::findOne($invoiceid);
            $fileName = $invoiceModel->mcid_performainvoicepath;
        } else {
            $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', true);
             $invoiceModel = \common\models\MemcompinvoicedtlsTbl::find()->where("mcid_membercompmst_fk=$compPk")->orderBy('memcompinvoicedtls_pk desc')->one();
            $fileName = $invoiceModel->mcid_performainvoicepath;
        }
        $path = dirname(__FILE__)."/../../../../backend/invoice/$regPk/";
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Length:". filesize($path.$fileName));
        @readfile($path.$fileName);
        exit;
    }
    public function actionDownloadprotaxinvoice() {
        $invoicePk = \common\components\Security::base64_decrypt_str($_REQUEST['invpk'], 'bgiindia');
        $regPk = \common\components\Security::base64_decrypt_str($_REQUEST['rpk'], 'bgiindia');
        $type = (!empty($_REQUEST['type']))? $_REQUEST['type']: 'pro';
        $fileName = '';
        if(!empty($invoicePk)){
            $invoiceModel = \common\models\MemcompinvoicedtlsTbl::findOne($invoicePk);
            if($type=='tx') {
                $fileName = $invoiceModel->mcid_invoicepath;
            } else {
                $fileName = $invoiceModel->mcid_performainvoicepath;
            }
        }
        $path = dirname(__FILE__)."/../../../../backend/invoice/$regPk/";
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Length:". filesize($path.$fileName));
        @readfile($path.$fileName);
        exit;
    }
    
    public function actionGenerateinvoice() {
        $regPk = null;
        if(isset($_REQUEST['r']) && !empty($_REQUEST['r'])) {
            $regPk = $_REQUEST['r'];
        }
        $invoiceDtls= AfterLogin::getInvoiceDtls($regPk);
        $isRenewal = ($invoiceDtls['memberstatus']=='A') ? true : false;
        $invoice_path = $invoiceDtls['invoicePath'];
        $regpk = $invoiceDtls['regNo'];
        $path = "../backend/invoice/$regpk/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }             
        $amtintowords = "-";
        $baseprice = "-";
        $vatprice = "-";
        $totalprice = "-";
        $format = 2;
        if(!empty($invoiceDtls['address'])){
            if(!empty($invoiceDtls['city']) && !empty($invoiceDtls['state']) && !empty($invoiceDtls['country'] )){
                $address = $invoiceDtls['address'] .', ' . $invoiceDtls['city'] .', ' . $invoiceDtls['state']  .', ' . $invoiceDtls['country'];
            }elseif(!empty($invoiceDtls['state']) && !empty($invoiceDtls['country'] )){
                 $address = $invoiceDtls['address'] .', ' . $invoiceDtls['state']  .', ' . $invoiceDtls['country'];
            }elseif(!empty($invoiceDtls['city']) && !empty($invoiceDtls['country'] )){
                 $address = $invoiceDtls['address'] .', ' . $invoiceDtls['city']  .', ' . $invoiceDtls['country'];
            }else{
                 $address = $invoiceDtls['address'] .', ' .  $invoiceDtls['country'];
            }            
        }else{
            $address = "-";
        }
        $vatper=$vatpercent=0;
        if($invoiceDtls['subscription']['packageBaseCurrencySymbol'] == "OMR"){
            $format = 3;
            $vatper= Yii::$app->params['vatpercentage'];
            $vatpercent = ($vatper / 100);
        }
        if(!empty($invoiceDtls['subscription']['packageBasePrice'])){
            
            if($invoiceDtls['promocodefk'])
            {
                $promodtls = \common\models\PromocodemstTbl::find()->where('promocodemst_pk ='.$invoiceDtls['promocodefk'])->one();
            } 
            $baseprice = number_format($invoiceDtls['subscription']['packageBasePrice'], $format, '.', '');
            $totalamount = $baseprice;
            if($invoiceDtls['subscription']['discountval'] && \Yii::$app->params['discoutapplicable'])
            {
                $totalamount = $baseprice - $invoiceDtls['subscription']['discountval'];
            }
            
            if($promodtls && \Yii::$app->params['promoapplicable'])
            {
               $prmodiscamount = number_format(($totalamount/100)*$promodtls['pcm_discpercent'],3); 
               $prmodiscamount = ($prmodiscamount > $promodtls['pcm_maxdisprice'])? $promodtls['pcm_maxdisprice']:$prmodiscamount;
               $totalamount = $totalamount  - $prmodiscamount;  
            }
            $vatamount = number_format(($totalamount/100)*$vatper,3);
            $totalamount = $totalamount  + $vatamount;
            $amtintowords = \common\components\Common::AmountInWords($totalamount, $invoiceDtls['origin_type']);
        }   
        $baseUrl = \Yii::$app->params['baseUrl'];     
        $backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 5,
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_bottom' => 5,
        'autoPageBreak' => true,
        'default_font' => 'cairoregular',
        //'format' => 'A3'
        'format' => [250, 330]]);
        $mpdf->shrink_tables_to_fit = 1;		
        //$mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
        $mpdf->SetWatermarkImage($backendBaseUrl.'/dev/src/assets/images/rabt-bg-logo.svg');
        //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .1;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('invoice',['invoiceDtls'=>$invoiceDtls,'amtintowords'=>$amtintowords,'vatper'=>$vatper,'baseprice'=>$baseprice,'vatprice'=>$vatamount,'totalprice'=>$totalamount,'prmodiscamount'=>$prmodiscamount,'address'=>$address,'isRenewal' => $isRenewal, 'taxinvoice' => 0,'promodtls'=>$promodtls, 'baseurl'=>$baseUrl]));
        $mpdf->Output("../backend/invoice/$regpk/$invoice_path",'F');
    }
    public function actionGenerateinvoicecls() {
        $regPk = null;
        if(isset($_REQUEST['r']) && !empty($_REQUEST['r'])) {
            $regPk = $_REQUEST['r'];
        }
        $invoiceDtls= AfterLogin::getInvoiceDtls($regPk);
        $isRenewal = ($invoiceDtls['memberstatus']=='A') ? true : false;
        $invoice_path = $invoiceDtls['invoicePath'];
        $regpk = $invoiceDtls['regNo'];
        $path = "../backend/invoice/$regpk/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }             
        $amtintowords = "-";
        $baseprice = "-";
        $vatprice = "-";
        $totalprice = "-";
        $format = 2;
        if(!empty($invoiceDtls['address'])){
            if(!empty($invoiceDtls['city']) && !empty($invoiceDtls['state']) && !empty($invoiceDtls['country'] )){
                $address = $invoiceDtls['address'] .', ' . $invoiceDtls['city'] .', ' . $invoiceDtls['state']  .', ' . $invoiceDtls['country'];
            }elseif(!empty($invoiceDtls['state']) && !empty($invoiceDtls['country'] )){
                 $address = $invoiceDtls['address'] .', ' . $invoiceDtls['state']  .', ' . $invoiceDtls['country'];
            }elseif(!empty($invoiceDtls['city']) && !empty($invoiceDtls['country'] )){
                 $address = $invoiceDtls['address'] .', ' . $invoiceDtls['city']  .', ' . $invoiceDtls['country'];
            }else{
                 $address = $invoiceDtls['address'] .', ' .  $invoiceDtls['country'];
            }            
        }else{
            $address = "-";
        }
        $vatper=$vatpercent=0;
        if($invoiceDtls['subscription']['packageBaseCurrencySymbol'] == "OMR"){
            $format = 3;
            $vatper= Yii::$app->params['vatpercentage'];
            $vatpercent = ($vatper / 100);
        }
        if(!empty($invoiceDtls['invoiceAmount'])){
            
            if($invoiceDtls['promocodefk'])
            {
                $promodtls = \common\models\PromocodemstTbl::find()->where('promocodemst_pk ='.$invoiceDtls['promocodefk'])->one();
            } 
            $baseprice = number_format($invoiceDtls['invoiceAmount'], $format, '.', '');
            $totalamount = $baseprice;            
            $vatamount = number_format(($totalamount/100)*$vatper,3);
            $totalamount = $totalamount  + $vatamount;
            $amtintowords = \common\components\Common::AmountInWords($totalamount, $invoiceDtls['origin_type']);
        }   
        $baseUrl = \Yii::$app->params['baseUrl'];     
        $backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 5,
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_bottom' => 5,
        'autoPageBreak' => true,
        'default_font' => 'cairoregular',
        //'format' => 'A3'
        'format' => [250, 330]]);
        $mpdf->shrink_tables_to_fit = 1;		
        //$mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
        $mpdf->SetWatermarkImage($backendBaseUrl.'/dev/src/assets/images/rabt-bg-logo.svg');
        //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .1;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('invoice',['invoiceDtls'=>$invoiceDtls,'amtintowords'=>$amtintowords,'vatper'=>$vatper,'baseprice'=>$baseprice,'vatprice'=>$vatamount,'totalprice'=>$totalamount,'prmodiscamount'=>$prmodiscamount,'address'=>$address,'isRenewal' => $isRenewal, 'taxinvoice' => 0,'promodtls'=>$promodtls, 'baseurl'=>$baseUrl]));
        $mpdf->Output("../backend/invoice/$regpk/$invoice_path",'F');
    }
    
        
    public function actionPaymentdetail() {
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $response = AfterLogin::getPaymentDetail($regpk);
        return $this->asJson($response);
    }
    
    public function actionOnlinepayment()
    {
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= \common\components\Security::decrypt($dataval);
        $dataval=(array)json_decode($dataval);
        
        $compk = $dataval['companyPk']? $dataval['companyPk']: \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $regpk = $dataval['regPk']? $dataval['regPk']:\yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userpk = $dataval['userPk']? $dataval['userPk']:\yii\db\ActiveRecord::getTokenData('user_pk', true);
        $UMType = \common\models\UsermstTbl::findOne($compk)['UM_Type'];
        
        $pytmRefNoAndDate = time().'T'.rand(4,1000);
        $_payURL = isset($dataval['payurl']) && !empty($dataval['payurl']) ? $dataval['payurl'] : NULL;
        $save = \common\models\MemcomppymtinfodtlsTbl::saveOnlinePymtDtls($dataval,$compk,$pytmRefNoAndDate,$userpk,$regpk);
        $payType = \app\common\models\MemcomprewtempTbl::find()->where("mcrt_membercompmst_fk=$compk")->orderBy('memcomprewtemp_pk desc')->one();
        
        //$invoiceModel = \common\models\MemcompinvoicedtlsTbl::find()->where("mcrt_membercompmst_fk=$compPk")->orderBy('memcomprewtemp_pk desc')->one();
        if(!empty($payType)){
            $merchant_defined_data1 = "RENEW";
        }else{
            $merchant_defined_data1 = "REG";
        }
        $paydetails= \common\models\MemcomppymtdtlsTbl::getPaymentdetails($compk,$regpk,$userpk,$UMType,$merchant_defined_data1);
        
        $data=$dataval['cardType'].'|'.$paydetails['amount'].'|'.$pytmRefNoAndDate.'|'.$merchant_defined_data1.'|'.$paydetails['bill_to_forename'].'|'.$paydetails['bill_to_surname'].'|'.$compk.'|'.$paydetails['bill_to_email'].'|'.$paydetails['bill_to_phone'].'|'.$paydetails['bill_to_address_city'].'|'.$paydetails['bill_to_address_country'].'|'.$paydetails['bill_to_address_line1'].'|'.$paydetails['bill_to_address_postal_code'].'|'.$paydetails['consumer_code'].'|'.$userpk.'|'.$paydetails['paymenttoken'].'|'.$_payURL.'|'.$paydetails['subscription_name'];
        
        $paymentdetials= AfterLogin::paymentprocess($data);
        
        return ($paymentdetials)?$this->asJson($paymentdetials):[];
        
    }
    
    public function actionPaymentstatus()
    {
        $compk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= \common\components\Security::decrypt($dataval);
        $paydetails=\common\components\Paymentingeration::gettablespay($compk);
        $_REQUEST = (array)json_decode($dataval);
        if(!empty($_REQUEST))
        {
            if(isset($_REQUEST["trandata"])){
                $bank_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $current= Yii::app()->params['PG']['omannet']['current'];
                $pay_config = Yii::app()->params['PG']['omannet'][Yii::app()->params['PG']['omannet']['current']];
                require_once($pay_config['javabridge_file_path']);
                $myObj = new Java("com.fss.plugin.iPayPipe");
                $aliasName = Yii::app()->params['PG']['omannet'][$current]['aliasName'];
                $resourcePath = Yii::app()->params['PG']['omannet'][$current]['gateway_resource_path'];
                $keystorePath = Yii::app()->params['PG']['omannet'][$current]['gateway_resource_path'];
                $myObj->setResourcePath(trim($resourcePath));
                $myObj->setKeystorePath(trim($keystorePath));
                $myObj->setAlias(trim($aliasName)); 
                $result = $myObj->parseEncryptedRequest(trim($_REQUEST["trandata"]));

                if($myObj->getUdf1() != '' && $myObj->getUdf1() != NULL) {
                        $card_type = trim($myObj->getUdf1());
                } else {
                        $card_type = $_REQUEST['cardType'];
                } 

                if($myObj->getUdf3() != '' && $myObj->getUdf3() != NULL) {
                        $trans_type = trim($myObj->getUdf3());
                } else {
                        $trans_type = $_REQUEST['req_merchant_defined_data1'];
                } 

                if($myObj->getAmt() != '' && $myObj->getAmt() != NULL) {
                        $trans_amt = trim($myObj->getAmt());
                } else {
                        $trans_amt = $_REQUEST['req_amount'];
                }
            if($myObj->getUdf2() != '' && $myObj->getUdf2() != NULL) {
                        $referenceno = trim($myObj->getUdf2());
                } else {
                        $referenceno = $_REQUEST['req_reference_number'];
                }
                }
            if (isset($_REQUEST['req_transaction_uuid'])) {
                $referenceno = $_REQUEST['req_reference_number'];
                if (($_REQUEST['decision'] == 'ACCEPT' || $_REQUEST['decision'] == 'REVIEW' ) && $_REQUEST['transaction_id'] != 0) {
                    $_REQUEST['statusCode'] = 'E001';
                    $_REQUEST['transaction'] = $_REQUEST['transaction_id'];
                    $_REQUEST['decision'] = ($_REQUEST['decision'])?$_REQUEST['decision']:'ACCEPT';// testing local
                    $_REQUEST['reason_code'] = $_REQUEST['reason_code'];
                    $_REQUEST['msg'] = $_REQUEST['message'];
                    $_REQUEST['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
                    $_REQUEST['req_ref_no'] = $_SERVER['req_reference_number'];
                    $_REQUEST['cardType'] = $_SERVER['cardType'];
                    $_REQUEST['req_merchant_defined_data1'] = $_REQUEST['req_merchant_defined_data1'];
                    $_REQUEST['type'] = $_REQUEST['req_merchant_defined_data1'];
                } else {
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['transaction_id'];
                    $_REQUEST['decision'] = ($_REQUEST['decision'])?$_REQUEST['decision']:'FAILED';// testing local
                    $_REQUEST['reason_code'] = $_REQUEST['reason_code'];
                    $_REQUEST['msg'] = $_REQUEST['message'];
                    $_REQUEST['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
                    $_REQUEST['req_ref_no'] = $_SERVER['req_reference_number'];
                    $_REQUEST['cardType'] = $_SERVER['cardType'];
                    $_REQUEST['req_merchant_defined_data1'] = $_REQUEST['req_merchant_defined_data1'];
                    $_REQUEST['type'] = $_REQUEST['req_merchant_defined_data1'];
                }

            } elseif ($card_type == 'ODC') {
                if($myObj->getResult() == 'CAPTURED' || $myObj->getResult() == 'REGISTERED') {
                    $_REQUEST['statusCode'] = 'E001';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'ACCEPT';
                    $_REQUEST['msg'] = 'SUCCESS';
                    $_REQUEST['reason_code'] = '';
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC'; 
                    $_REQUEST['status']=2;
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;
                    $_REQUEST['req_reference_number']=$referenceno;

                } elseif($myObj->getResult() == 'NOT CAPTURED') {
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = 'Failed';
                    $_REQUEST['reason_code'] = $_REQUEST['tccode'];
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC';
                    $_REQUEST['status']=4;	
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;		
                    $_REQUEST['req_reference_number']=$referenceno;						
                } elseif($myObj->getResult() == 'Invalid card number.') {
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = 'Invalid card number.';
                    $_REQUEST['reason_code'] = $_REQUEST['tccode'];
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC';
                    $_REQUEST['status']=4;
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;
                    $_REQUEST['req_reference_number']=$referenceno;

                } elseif($myObj->getResult() == 'IPAY0100048 - Cancelled'){
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = 'IPAY0100048 - Cancelled';
                    $_REQUEST['reason_code'] = $_REQUEST['tccode'];
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC';
                    $_REQUEST['status']=4;
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;
                    $_REQUEST['req_reference_number']=$referenceno;
                } elseif($myObj->getResult() == 'IPAY0100045+-+DENIED+BY+RISK'){
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = 'IPAY0100045 - Denied By Risk, Please Contact Your Bank';
                    $_REQUEST['reason_code'] = $_REQUEST['tccode'];
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC';
                    $_REQUEST['status']=4;
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;
                    $_REQUEST['req_reference_number']=$referenceno;
                } else {
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $_REQUEST['paymentid'];
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = "Unknown Reson";
                    $_REQUEST['reason_code'] = $_REQUEST['tccode'];
                    $_REQUEST['req_ref_no'] = $_REQUEST['trackid'];
                    $_REQUEST['cardType'] = 'ODC';
                    $_REQUEST['status']=4;
                    $_REQUEST['req_merchant_defined_data1'] = $trans_type;
                    $_REQUEST['type'] = $trans_type;
                    $_REQUEST['REQUEST_URI'] = $bank_link;
                    $_REQUEST['req_reference_number']=$referenceno;
                }
                $referenceno = $myObj->getUdf2();
	

                } elseif($_REQUEST['card_type'] == 'T') {
                    $comp_pk=$_SESSION['company_primary_id'];
                    $sessionID=$ref_no='';
                    if($_REQUEST['req_merchant_defined_data1']=='REG'){

                    }
                    $response_data=[];
                if($_REQUEST['rt']=='sc'){
                    $env = \Yii::$app->params['baseurl']['env'];
                    $thawaniPay=new \common\components\Paymentingeration($env);
                    $response_data = $thawaniPay->sessionStatus($paydetails->mcpid_transuniqueid);      
                }
                if($response_data['success']==1 && $response_data['code']==2000){
                    $_REQUEST['statusCode'] = 'E001';
                    $_REQUEST['transaction'] = $response_data['data']['client_reference_id'];
                    $_REQUEST['decision'] = 'ACCEPT';
                    $_REQUEST['msg'] = 'SUCCESS';
                    $_REQUEST['reason_code'] = '';
                    $_REQUEST['req_reference_number'] = $response_data['data']['session_id'];
                    $_REQUEST['cardType'] = 'T'; 
                    $_REQUEST['status']=2;
                    $_REQUEST['type']=$_REQUEST['req_merchant_defined_data1'];
                    $_REQUEST['req_merchant_defined_data1']=$_REQUEST['req_merchant_defined_data1'];
                    $referenceno = $response_data['data']['client_reference_id'];
                    $currency = $response_data['data']['currency'];
                    $payment_status = $response_data['data']['payment_status'];
                    $created_at = $response_data['data']['created_at'];
                }else{
                    $_REQUEST['statusCode'] = 'E004';
                    $_REQUEST['transaction'] = $ref_no;
                    $_REQUEST['decision'] = 'REJECT';
                    $_REQUEST['msg'] = 'REJECT';
                    $_REQUEST['reason_code'] = '';
                    $_REQUEST['req_reference_number'] = $sessionID;
                    $_REQUEST['cardType'] = 'T'; 
                    $_REQUEST['status']=4;
                    $_REQUEST['type']=$_REQUEST['req_merchant_defined_data1'];
                    $_REQUEST['req_merchant_defined_data1']=$_REQUEST['req_merchant_defined_data1'];
                    $referenceno = $ref_no;
                }
            
            } elseif(isset($_REQUEST['merchant_param1']) && ($_REQUEST['merchant_param2'] == "SP")) {
                
                if($_REQUEST['merchant_param1'] == "REG" || $_REQUEST['merchant_param1'] == "RENEW"){

                    if($_REQUEST['order_status']== "Success"){
                        $_REQUEST['statusCode'] = 'E001';
                        $_REQUEST['transaction'] = $_REQUEST['order_id'];
                        $_REQUEST['decision'] = 'ACCEPT';
                        $_REQUEST['msg'] = 'SUCCESS';
                        $_REQUEST['reason_code'] = '';
                        $_REQUEST['req_reference_number'] = $_REQUEST['order_id'];
                        $_REQUEST['cardType'] = 'SP'; 
                        $_REQUEST['status']=2;
                        $_REQUEST['type']=$_REQUEST['merchant_param1'];
                        $referenceno = $_REQUEST['order_id'];
                        $currency = $_REQUEST['currency'];
                        $payment_status = $_REQUEST['order_status'];
                        $created_at = $_REQUEST['trans_date'];
                    }else{
                        $_REQUEST['statusCode'] = 'E004';
                        $_REQUEST['transaction'] = $_REQUEST['order_id'];
                        $_REQUEST['decision'] = 'REJECT';
                        $_REQUEST['msg'] = 'REJECT';
                        $_REQUEST['reason_code'] = '';
                        $_REQUEST['req_reference_number'] = $_REQUEST['order_id'];
                        $_REQUEST['cardType'] = 'SP'; 
                        $_REQUEST['status']=4;
                        $_REQUEST['type']=$_REQUEST['merchant_param1'];
                        $referenceno = $_REQUEST['order_id'];
                    }
                   
                }
            }

        
        $paydetails= \common\components\Paymentingeration::saveregpayment($_REQUEST,$compk);
        return $this->asJson($_REQUEST);
        }
    }
    
    
    public function actionChangeclassification() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $regpk=\yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $isRenewal = (!empty($data['change']['isRenewal']))? $data['change']['isRenewal']: ''; 
        $dtl = AfterLogin::changeClassification($data['change']);        
        if($dtl['status'] == 1) {
            $_REQUEST['isRenewal'] = $isRenewal;            
            $invoice = AfterLogin::generateInvoice();
            $this->actionGenerateinvoice();
            if($isRenewal==''){
                AfterLogin::changeclassificationmailtobackend($userPk);
            }
        }
        return $dtl ? $this->asJson($dtl) : [];
    }
    
    public function actionClassificationdtl() {
        $dtl = AfterLogin::getClassificationDtls();
        return $dtl ? $this->asJson($dtl) : [];
    }

    public function actionGetintlsubcription()
    {
        if (!empty($_REQUEST['origin']) && $_REQUEST['origin'] == 'I') {
            try {
                $cache = new \api\common\services\CacheBGI();
                $cacheKey = 'intlclassification';
                if(empty($cache->retreive($cacheKey))){
                    $cacheQuery = \api\modules\mst\models\ClassificationmstTblQuery::classificationQueryCache();
                    $classificationDtl = \api\modules\mst\models\ClassificationmstTbl::getInternationalClassification();
                    $cache->store($cacheKey, $classificationDtl, $duration = 0 , $cacheQuery);
                } else {
                    $classificationDtl = $cache->retreive($cacheKey);
                }
            
            } catch(\Exception $e){
                $classificationDtl = \api\modules\mst\models\ClassificationmstTbl::getInternationalClassification();
            }
            
            $classificationPkArr = array_column((array) $classificationDtl, 'ClassificationMst_Pk');
           
                
            try{
                $cacheKeysubs = 'subsbyclassification';
                if(empty($cache->retreive($cacheKeysubs))){
                    $cacheQuery = \common\models\MemsubsbyclassifTbl::subsbyclassiQueryCache();
                    $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classificationPkArr, true);
                    $cache->store($cacheKeysubs, $subscriptionDtl, $duration = 0 , $cacheQuery);
                } else {
                    $subscriptionDtl = $cache->retreive($cacheKeysubs);
                }

            } catch(\Exception $e){
                $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classificationPkArr, true);
            }

            $response = [];
            foreach($subscriptionDtl as $key => $val) {
                $response[$key]['duration'] = \common\components\Common::getDurationByDays($val->subscription->msm_duration)['Years'];
                $response[$key]['subscribepk'] = $val->msbc_memsubscriptionmst_fk;
                $response[$key]['classificationpk'] = $val->mcbc_classificationmst_fk;
                $response[$key]['amount'] = (int) $val->subscription->msm_baseprice;
                $response[$key]['currency'] = $val->subscription->currency->CurM_CurrSymbol;
                $response[$key]['memsubsbyclassifpk'] = $val->memsubsbyclassif_pk;
            }
            return $response;
        }
    }
    
    public function actionInvoicedtls() {
        $dtl = AfterLogin::getInvoiceDtls();
        return $dtl ? $this->asJson($dtl) : [];
    }
    
    public function actionChangepaycontact() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $changePay = $data['changepaycontact'];
        $changed = AfterLogin::changePaymentContact($changePay['newPayContactPk'], $changePay['exisitingPayContactPk']);
        return $changed ? $this->asJson($changed) : [];
    }
    
    public function actionUpdatesubscription() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        AfterLogin::backchangesubscription($data);
    }
    
    public function actionGetuserdtls() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userdtls= AfterLogin::getuserdtls($data['userpk']);
        return $userdtls ? $this->asJson($userdtls) : [];
    }
    public function actionGetrenewtemp() {
        if (!empty($_REQUEST['comppk']) && isset($_REQUEST['comppk'])) {
            $dtl = AfterLogin::checkRenewTemp($_REQUEST['comppk']);
        }
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetoprdetails()
    {
        $dtl = AfterLogin::getoprdetails();
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetsampletempfinlink(){
        if(isset($_REQUEST['id']) && $_REQUEST['id'] == 1){
             $fileName = 'Bankdetails.docx';
            $path = dirname(__FILE__)."/../../../../backend/sampletemplate/";
            header("Content-type: application/msword");
            header("Content-Description: File Transfer");
            header("Content-type: application/force-download");
            header("Content-Transfer-Encoding: binary");
            header("Content-Disposition: attachment; filename = $fileName");
            header("Content-Length:". filesize($path.$fileName));
            @readfile($path.$fileName);
            exit;
        }elseif(isset($_REQUEST['id']) && $_REQUEST['id'] == 2) {
             $fileName = 'Turnoverconfirmation.docx';
            $path = dirname(__FILE__)."/../../../../backend/sampletemplate/";
            header("Content-type: application/msword");
            header("Content-Description: File Transfer");
            header("Content-type: application/force-download");
            header("Content-Transfer-Encoding: binary");
            header("Content-Disposition: attachment; filename = $fileName");
            header("Content-Length:". filesize($path.$fileName));
            @readfile($path.$fileName);
            exit;
        }elseif(isset($_REQUEST['id']) && in_array ($_REQUEST['id'], [3,4,5,6])) {
            $filearrayname = [3=>'cmlccocomtemplate.xlsx',4=>'duqumtemplate.xlsx',5=>'cmlccocomtemplate.xlsx',6=>'pdotemplate.xlsx'];
            $fileName  = $filearrayname[$_REQUEST['id']];
//            $fileName = 'Turnoverconfirmation.docx';
            $path = dirname(__FILE__)."/../../../../backend/sampletemplate/";
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
             header('Cache-Control: max-age=0');
             header('Cache-Control: max-age=1');
            header("Content-type: application/force-download");
            header('Cache-Control: cache, must-revalidate'); 
            header('Pragma: public'); 
            header("Content-Disposition: attachment; filename = $fileName");
            header("Content-Length:". filesize($path.$fileName));
            @readfile($path.$fileName);
            exit;
        }        
        
    }
    public function actionRevertpayment() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['revert'];
        $dtl = AfterLogin::revertpayment($data);
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionUpdatepaymentstatus() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['paystatus'];
        $dtl = AfterLogin::updatepaymentstatus($data);
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionSendpymtinprogressmail() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['paymail'];
        $dtl = AfterLogin::sendmailadminpymtinprogress($data);
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionCheckforeignclassification() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['comp'];
        $dtl = AfterLogin::checkforeignclassification($data);
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetottulink()
    {        
        $compk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $UMType = \yii\db\ActiveRecord::getTokenData('UM_Type', true);
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= \common\components\Security::decrypt($dataval);
        $dataval=(array)json_decode($dataval);
        $paydetails= \common\models\MemcomppymtdtlsTbl::getPaymentdetails($compk,$regpk,$userpk,$UMType);
        $_data = [
            "amt" => $paydetails['amount'],
            'fname' => $paydetails['bill_to_surname'],
            'lname' => ' ',
            'email' => $paydetails['bill_to_email'],
            'phoneno' => $paydetails['bill_to_phone'],
            'memcomppk' => $compk,
            'userpk' => $userpk,
            'card_type' => $dataval['card_type'],
            'company_name' => $dataval['companyName'],
            'classification' => $dataval['classificationType'],
            'nbf_no' => $dataval['regno'],
            'country' => $dataval['countryName'],
            'module_type' => $dataval['module_type'],
            'add_charge' => $dataval['additionalPrice'],
            're_generate' => $dataval['regenerate']
        ];
        $_pg =new \common\components\PaymentGateway('ottu');
        $paymentdetials = $_pg->getottulink($_data);
        return ($paymentdetials)?$this->asJson($paymentdetials):[];
    }
    public function actionCheckottuvalidlink()
    {
        $compk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= \common\components\Security::decrypt($dataval);
        $dataval=(array)json_decode($dataval);
        $_data = [
            'module_type' => $dataval['module_type'],
            'payment_platform' => $dataval['payment_platform'],
            'user_pk' => $userpk,
            'comp_pk' => $compk
        ];
        $_pg =new \common\components\PaymentGateway('ottu');
        $paymentdetials = $_pg->checkOttuValidLink($_data);
        return ($paymentdetials)?$this->asJson($paymentdetials):[];
    }
    public function actionContractpaymentdetails() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userdtls= AfterLogin::getCMSPaymentDetail($data['contpk']);
        return $userdtls ? $this->asJson($userdtls) : [];
    }
    public function actionOnlinepaymentcontract()
    {
        $compk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
          
        $UMType = \yii\db\ActiveRecord::getTokenData('UM_Type', true);
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval = \common\components\Security::decrypt($dataval);
        $dataval = (array)json_decode($dataval);
        $pytmRefNoAndDate = time().'T'.rand(4,1000);
        if($dataval['origintype']=='I'){
            $total_amt = \common\components\Common::getomrbyusd($dataval['totalamount']);
        }else{
            $total_amt = $dataval['totalamount'];
        }
        $save = \common\models\MemcomppymtinfodtlsTbl::saveOnlineContractPymtDtls($dataval,$compk,$pytmRefNoAndDate,$userpk);
        $merchant_defined_data1 = "CMS";
        $paydetails= \common\models\MemcomppymtdtlsTbl::getPaymentdetails($compk,$regpk,$userpk,$UMType,$merchant_defined_data1);
        $_payURL = NULL;
        $data=$dataval['cardType'].'|'.$total_amt.'|'.$pytmRefNoAndDate.'|'.$merchant_defined_data1.'|'.$paydetails['bill_to_forename'].'|'.$paydetails['bill_to_surname'].'|'.$compk.'|'.$paydetails['bill_to_email'].'|'.$paydetails['bill_to_phone'].'|'.$paydetails['bill_to_address_city'].'|'.$paydetails['bill_to_address_country'].'|'.$paydetails['bill_to_address_line1'].'|'.$paydetails['bill_to_address_postal_code'].'|'.$paydetails['consumer_code'].'|'.$userpk.'|'.$paydetails['paymenttoken'].'|'.$_payURL.'|'.$paydetails['subscription_name'];
        $paymentdetials= AfterLogin::paymentprocess($data);
        return ($paymentdetials)?$this->asJson($paymentdetials):[];
    }
    public function actionContractpaymentinfo() {
        $comp_pk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $payment_info = \common\models\MemcomppymtinfodtlsTbl::getPaymentStatus($comp_pk);
        $userdtls='';
        if(!empty($payment_info)){
            $invoice_info = \common\models\MemcompinvoicedtlsTbl::findOne($payment_info['mcpid_memcompinvoicedtls_fk']);
            if(!empty($invoice_info)){
                $cont_pk = $invoice_info->mcid_shared_fk;
                $userdtls= AfterLogin::getCMSPaymentDetail($cont_pk);
            }
        }
        return $userdtls ? $this->asJson($userdtls) : [];
    }
    public function actionContractpaymenthistorydetails() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userdtls= \common\models\MemcomppymtinfodtlsTbl::getCMSPaymentHistory($data['comppk']);
        return $userdtls ? $this->asJson($userdtls) : [];
    }
    public function actionGetjsrscertificate(){
        $companypk = base64_decode($_REQUEST['id']);
        $certificatepath =  \common\components\Suppcertform::getsuppliercertificatepdf($companypk);
        if(!empty($certificatepath['imagepath']) && !empty($certificatepath['filename'])){
            $fileName = $certificatepath['filename'].'.pdf';
            $path = $certificatepath['imagepath'];
            $urlencode = $path.$fileName;
            header("Content-type: application/pdf");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename = $fileName");
            header("Content-Length:". filesize($urlencode));
            @readfile($urlencode);
            exit;
        }else{
            echo "File not found";exit;
        }            
    }
    public function actionGetviewjsrscertificate(){
        $companypk = base64_decode($_REQUEST['id']);
        $certificatepath =  \common\components\Suppcertform::getsuppliercertificatepdf($companypk);
        if(!empty($certificatepath['imagepath']) && !empty($certificatepath['filename'])){
            $fileName = $certificatepath['filename'].'.pdf';
            $path = $certificatepath['imagepath'];
            $urlencode = $path.$fileName;
//            header("Content-type: application/pdf");
//            header("Content-Description: File Transfer");
//            header("Content-type: application/octet-stream");
//            header("Content-type: application/force-download");
//            header("Content-Disposition: attachment; filename = $fileName");
//            header("Content-Length:". filesize($urlencode));
//            @readfile($urlencode);
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename = "'.$fileName.'"');
            header('Content-Transfer-Encoding: binary');
            readfile($urlencode);
            exit;
        }else{
            echo "File not found";exit;
        }            
    }
    public function actionGetjsrsebadge(){
        $regpk = base64_decode($_REQUEST['id']);
        if(!empty($regpk)){
            \common\models\MemcompebadgeTblQuery::trackinsertion(2,$regpk);
            $file_path = dirname(__FILE__)."/../../../../j3new/src/assets/images/JSRS-eBadge_V2.jpg";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
            header('Expires: 0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            // Clear output buffer
            flush();
            readfile($file_path);
            exit();
        }else{
            echo "File not found";exit;
        }        
    }
    public function actionGetjsrsproductsservices(){
        $companypk = base64_decode($_REQUEST['id']);
        $filename = base64_decode($_REQUEST['did']);
        if(!empty($companypk) && !empty($filename)){   
            $filename = $filename.'.zip';        
            $path = dirname(__FILE__).'/../../../../backend/documents/approvedprodserv/';
            if (file_exists($path .$filename)){                                 
                header("Content-Length:". filesize($path.$filename));
                header('Content-Type: application/zip'); 
                header('Content-Type: application/octet-stream');
                header("Content-Disposition: attachment; filename = $filename");
                header('Content-Transfer-Encoding: binary');
                @readfile($path.$filename);
                exit;
            }else{
                echo "File does' t exit";exit;
            }
        }else{
            echo "File does' t exit";exit;
        }
    }
    public function actionCheckcompanynameandemailvalid(){
        $returndata['status'] = 2;
        $returndata['message'] = "not exits";
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $id = base64_decode($data['idno']);
        $stktype = $data['sttype'];
        if($type!=3){
            $dataToCheck = strtolower(trim(Security::sanitizeInput($data['valuedata'], "string_spl_char")));
        }else{
            $dataToCheck = trim(Security::sanitizeInput($data['valuedata'], "string_spl_char"));
        }
        $type = $data['type'];
        if($type == 1){
            $isAvailable = \common\models\MembercompanymstTbl::checkIsCompanyNameAlreadyExists($dataToCheck,$id,$stktype);
        }elseif($type == 2){
            $isAvailable = \api\modules\pd\models\MemcompmplocationdtlsTblQuery::checkIsCompanyEmailAlreadyExists($dataToCheck,$id,$stktype);
        }elseif($type == 3){
            $isAvailable = \common\models\MembercompanymstTbl::checkIsCompanyNameArAlreadyExists($dataToCheck,$id,$stktype);
        }        
        if($isAvailable){
            $returndata['status'] = 1;
            $returndata['message'] = "already exits";
        }
         return $this->asJson($returndata);
    }

    

    

}


