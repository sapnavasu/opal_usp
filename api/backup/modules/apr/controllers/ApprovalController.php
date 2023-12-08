<?php

namespace api\modules\apr\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use common\components\Drive;
use common\components\ApprovalComponents;
use common\models\MemberregistrationmstTbl;
use common\components\AfterLogin;
use common\models\UsermstTbl;

class ApprovalController extends MasterController
{
    

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
    public function actionGetprojectdetails(){
        $requestId = $_GET['memberRegPk'];
        if($requestId == ''){
            return $this->asJson([
            'data' => '',
            'msg' => 'Error',
            'status' => 101,
            ]);
        }else{
            $projectDetails = ApprovalComponents::getProjectDetails($requestId);
            return $this->asJson([
            'data' => $projectDetails,
            'msg' => 'Sucess',
            'status' => 100,
            ]);
        }
    }
    public function actionViewapproval(){
        $requestId = $_GET['reqId'];
        if($requestId == ''){
            return $this->asJson([
            'data' => '',
            'msg' => 'Error',
            'status' => 101,
            ]);
        }else{
            $security = new \common\components\Security;
            $requestPk = $security->decrypt($requestId);
            //$requestPk = Common\components\Security::decrypt($requestId);
            $viewData = ApprovalComponents::fetchViewData($requestPk);
            
            return $this->asJson([
            'data' => $viewData,
            'msg' => 'Success',
            'status' => 100,
            ]);
        }
    }
    public function actionPaymentstatuschange(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $resdata = ApprovalComponents::statusChange($data);
        $approvedCmds = $data['approvalCmds'];
        $approvedOn = $data['approvedOn'];
        $ip = \common\components\Common::getIpAddress();
        if($resdata){
            
            $regPk = $resdata['RegPk'];
            $compPk = $resdata['companyPk'];
            $stkId = $resdata['stkId'];
            $invoicepk = $resdata['invoicepk'];
            $payinfopk = $resdata['payinfopk'];
            $currentregdet =  MemberregistrationmstTbl::find()
                        ->where('MemberRegMst_Pk=:fk',[':fk'=> $regPk])
                        ->one();
            $isRenewal = ($currentregdet['MRM_RenewalStatus']==Null)? 0: 1;
            if($resdata['aprStatus']=='approve')
            {
                
            $receiptModel = new \common\models\MemcomppymtrcptdtlsTbl();
            $receipt_no = \common\components\common::generateInvoiceNo('REC','REC');
            $receiptModel->mcpr_memcomppymtinfodtls_fk = $payinfopk;
            $receiptModel->mcpr_memcompinvoicedtls_fk = $invoicepk;
            $receiptModel->mcpr_receiptno = $receipt_no;
            $receiptModel->mcpr_createdon = date('Y-m-d H:i:s');
            $receiptModel->mcpr_createdby = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $paymentDetails['supplierId'] = $stkId;
            $paymentDetails['registerPk'] = $regPk;
            $paymentDetails['companyPk'] = $compPk;
            $downloadlink = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadreceipt?cpk='.$compPk.'&rpk='.$regPk]);
            $resdata['downloadlink'] =  $downloadlink;
            if($receiptModel->save()){
                $receipt_path = \common\components\common::getInvoiceName($receipt_no, $receiptModel->mcpr_createdon);
                $receiptModel->mcpr_receiptpath = $receipt_path;
                $receiptModel->save();
                \common\components\common::updateInvoiceNo('REC');                
                if(empty($currentregdet['MRM_RenewalStatus'])){
                    //\common\models\UsermstTbl::saveReguserasbackendtem($regPk,$compPk); // BGI User Creation
                }            
            self::generateReceipt($regPk,$receiptModel,$isRenewal);
            $MemregDtls=\api\modules\mst\models\MemberregistrationmstTbl::findOne($regPk);
            if(!empty($invoicepk)){ 
                $invoice_no = \common\components\common::generateInvoiceNo('INV','INV');
                $invoice_dtls =  \common\models\MemcompinvoicedtlsTbl::findOne($invoicepk);
                
                $inv_name = \common\components\common::getInvoiceName($invoice_no, $invoice_dtls->mcid_generatedon);
                $invoice_dtls->mcid_invoiceno = $invoice_no;
                $invoice_dtls->mcid_invoicepath = $inv_name;
                if($MemregDtls->MRM_ValSubStatus!='A'){
                    $invoice_dtls->mcid_invoicestatus = 'I';
                }
                $invoice_dtls->save();
                \common\components\common::updateInvoiceNo('INV');
                self::generateTaxInvoice($regPk, $isRenewal);
            }
             //for operation contact
             $admininfo = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:regpk and um_primarycontact=1',[':regpk' => $regPk])->one();
            $adminPk = $admininfo['UserMst_Pk'];
            $opr_user_info = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:regpk and um_oprcontact=1 and um_primarycontact IS NULL and um_pymtcontact IS NULL',[':regpk' => $regPk])->one();
            if(!empty($opr_user_info)){
                $emailid = $opr_user_info['UM_EmailID'];
                $opruserPk = $opr_user_info['UserMst_Pk'];   
                $opr_user_infoinvi = \common\models\UserinvitedtlsTbl::find()->where('uid_invitedby=:invpk and uid_emailid like :emailid',[':invpk' => $adminPk,':emailid'=>$emailid])->one();
                $USER_INVITE_PK = $opr_user_infoinvi['userinvitedtls_pk'];
                $baseUrl = \Yii::$app->params['APP_URL'];
                $url = $baseUrl."api/ma/mail/send";
                $_data=[
                    'email'=>$emailid,
                    'template_id'=>162,
                    'table_ref_key'=>'UserMst_Pk',
                    'table_ref_value'=>$adminPk,
                    'addi_params'=>['USER_INVITE_PK'=>$USER_INVITE_PK]
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
            //for payment contact
            $pymt_user_info = \common\models\UsermstTbl::find()->where('UM_MemberRegMst_Fk=:regpk and um_pymtcontact=1 and um_primarycontact IS NULL and um_oprcontact IS NULL',[':regpk' => $regPk])->one();
            if(!empty($pymt_user_info)){
                $pyemailid = $pymt_user_info['UM_EmailID'];
                $pyuserPk = $pymt_user_info['UserMst_Pk'];          
                $pymt_user_infoinv = \common\models\UserinvitedtlsTbl::find()->where('uid_invitedby=:invpk and uid_emailid like :emailid',[':invpk' => $adminPk,':emailid'=>$pyemailid])->one();
                $pyUSER_INVITE_PK = $pymt_user_infoinv['userinvitedtls_pk'];
                $baseUrl = \Yii::$app->params['APP_URL'];
                $url = $baseUrl."api/ma/mail/send";
                $_data1=[
                    'email'=>$pyemailid,
                    'template_id'=>162,
                    'table_ref_key'=>'UserMst_Pk',
                    'table_ref_value'=>$adminPk,
                    'addi_params'=>['USER_INVITE_PK'=>$pyUSER_INVITE_PK]
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
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
            }            
            $memcomtemp= \app\common\models\MemcomprewtempTbl::find()->where(["mcrt_membercompmst_fk"=>$compPk])->one();
            $subscription_pk = $classification_pk = '';
            $memcompaydtsl= \common\models\MemcomppymtdtlsTbl::find("MCPD_MemberCompMst_Fk=$compPk")->select('MCPD_YrsOfSubs')->orderBy('MemCompPymtDtls_Pk desc')->limit('1')->one();
            $currentdate=date('Y-m-d');
            if ($memcompaydtsl->MCPD_YrsOfSubs == 1) {
                $yearsub = 365;
            } elseif ($memcompaydtsl->MCPD_YrsOfSubs==3) {
                $yearsub = 365 * 3;
            }
            $expiry_date = date('Y-m-d', strtotime($currentdate . "+$yearsub days -1 day"));
            if(!empty($memcomtemp)){
                $subbyclassifmst = \common\models\MemsubsbyclassifTbl::findOne($memcomtemp->mcrt_memsubsbyclassif_fk);
                $subscription_pk = $subbyclassifmst->msbc_memsubscriptionmst_fk;
                $classification_pk = $subbyclassifmst->mcbc_classificationmst_fk;
                $memcomtemp->mcrt_status = 1;
                $memcomtemp->mcrt_extexpirydate = $expiry_date;
                $memcomtemp->mcrt_appdeclon=date('Y-m-d H:i:s', strtotime($approvedOn));
                $memcomtemp->mcrt_appdeclby=\yii\db\ActiveRecord::getTokenData('user_pk', true);
                $memcomtemp->mcrt_appdeclcomments=$approvedCmds;
                $memcomtemp->save();
            }
            if(!$isRenewal){
                $Memcomacthstry=new \common\models\MemcompaccactvnhstryTbl;
                $Memcomacthstry->mcaah_memberregmst_fk=$regPk;
                $Memcomacthstry->mcaah_accountactivatedon=date('Y-m-d');
                $Memcomacthstry->mcaah_expirydate=$expiry_date;
                $Memcomacthstry->mcaah_activationhierarchy=1;
                $Memcomacthstry->save();
                ApprovalComponents::updateRegToRenewHistory($regPk, $compPk, $payinfopk, $approvedCmds, $approvedOn);//Update reg info to renew history with status is Regitration Approved
            }            
            $MemcompDtls=\common\models\MembercompanymstTbl::findOne($compPk);
            if($subscription_pk){
                $MemregDtls->mrm_memsubscriptionmst_fk = $subscription_pk;
            }
            $MemregDtls->MRM_MemberStatus='A';
            if($isRenewal){
                $MemregDtls->MRM_RenewalStatus='A';   
                if($MemregDtls->MRM_ValSubStatus!='A'){
                    $MemregDtls->MRM_RenewalStatus='R';                
                    ApprovalComponents::updateRenewTempToHistory($compPk, $approvedCmds, $approvedOn);
                    $MemregDtls->MRM_LastRenewedOn = date('Y-m-d H:i:s');
                    $MemregDtls->MRM_LastRenewedBy = \yii\db\ActiveRecord::getTokenData('user_pk', true);
                }
            }else{
                $MemcompDtls->mcm_accexpirydate=$expiry_date;
                $MemregDtls->MRM_AFVPStatus='RC';
                $MemregDtls->MRM_ValAccOn=date('Y-m-d H:i:s');
                $MemregDtls->mrm_approvedon=date('Y-m-d H:i:s');
                $MemregDtls->mrm_approvedby=\yii\db\ActiveRecord::getTokenData('user_pk', true);
                $MemregDtls->mrm_approvedbyipaddr=$ip;
                ApprovalComponents::sendpaymentapprovedmail($regPk);
            }
            $MemregDtls->save();    
            if($classification_pk){
                $MemcompDtls->mcm_classificationmst_fk=$classification_pk;
            }            
            if(!$MemcompDtls->save()){
                echo "<pre>";
                print_r($MemcompDtls->getErrors());
                exit;
            }
            $enCompPk = \common\components\Security::encrypt($compPk);
            $enRegPk = \common\components\Security::encrypt($regPk);
             return $this->asJson([
               'data' => $resdata,
               'msg' => 'Success',
               'status' => 100,
           ]);
            }else{
                echo "<pre>"; print_r($receiptModel->getErrors()); exit;
            }
         }elseif($resdata['aprStatus']=='declined'){
            $MemregDtls=\api\modules\mst\models\MemberregistrationmstTbl::findOne($regPk);
            if($isRenewal){
                $memcomtemp = \app\common\models\MemcomprewtempTbl::find()->where(["mcrt_membercompmst_fk"=>$compPk])->one();
                if(!empty($memcomtemp)){
                    $memcomtemp->mcrt_status=2;
                    $memcomtemp->mcrt_appdeclon=date('Y-m-d H:i:s');
                    $memcomtemp->mcrt_appdeclby=\yii\db\ActiveRecord::getTokenData('user_pk', true);
                    $memcomtemp->mcrt_appdeclcomments=$approvedCmds;
                    $memcomtemp->save();
                }
                $MemregDtls->MRM_RenewalStatus='D';
            }else{
                $MemregDtls->MRM_AFVPStatus='D';
                ApprovalComponents::sendpaymentdeclinedmail($regPk);
            }
            $MemregDtls->save(); 
            $invoice_dtls =  \common\models\MemcompinvoicedtlsTbl::findOne($invoicepk);
            $invoice_dtls->mcid_invoicestatus='G';
            $invoice_dtls->save();
             return $this->asJson([
               'data' => $resdata,
               'msg' => 'Success',
               'status' => 100,
           ]);
         }else{
            return $this->asJson([
               'data' => $resdata,
               'msg' => 'Success',
               'status' => 100,
           ]); 
         }
        }else{
        return $this->asJson([
               'data' => $resdata,
               'msg' => 'Success',
               'status' => 100,
           ]);
        }
    }
     public function generateReceipt($regPk,$receiptModel,$isRenewal) {
        $receiptDtls= \common\components\AfterLogin::getInvoiceDtls($regPk);
        $receiptno = $receiptModel->mcpr_receiptno;
        $receiptpath = $receiptModel->mcpr_receiptpath;
        $receiptDtls['receiptdate']=date('d-m-Y',strtotime($receiptModel->mcpr_createdon));
        $receiptDtls['mcpr_receiptno']=$receiptModel->mcpr_receiptno;
        $path = "../backend/receipt/$regPk";
       
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }             
        $amtintowords = "-";
        $baseprice = "-";
        $vatprice = "-";
        $totalprice = "-";
        $format = 2;
        if(!empty($receiptDtls['address'])){
            if(!empty($receiptDtls['city']) && !empty($receiptDtls['state']) && !empty($receiptDtls['country'] )){
                $address = $receiptDtls['address'] .', ' . $receiptDtls['city'] .', ' . $receiptDtls['state']  .', ' . $receiptDtls['country'];
            }elseif(!empty($receiptDtls['state']) && !empty($receiptDtls['country'] )){
                 $address = $receiptDtls['address'] .', ' . $receiptDtls['state']  .', ' . $receiptDtls['country'];
            }elseif(!empty($receiptDtls['city']) && !empty($receiptDtls['country'] )){
                 $address = $receiptDtls['address'] .', ' . $receiptDtls['city']  .', ' . $receiptDtls['country'];
            }else{
                 $address = $receiptDtls['address'] .', ' .  $receiptDtls['country'];
            }            
        }else{
            $address = "-";
        }
        if($receiptDtls['subscription']['packageBaseCurrencySymbol'] == "OMR"){
            $format = 3;
             $vatper= \Yii::$app->params['vatpercentage'];
             $vatpercent = ($receiptDtls['subscription']['packageBasePrice'] / 100)*$vatper;
        }else{
             $vatper= 0;
             $vatpercent =0;
        }
        if(!empty($receiptDtls['subscription']['packageBasePrice'])){
            $baseprice = number_format($receiptDtls['subscription']['packageBasePrice'], $format);
            $vatpercent= number_format($vatpercent, $format, '.', '');
            $totprice = $receiptDtls['subscription']['packageBasePrice'] + $vatpercent;  
            $totalprice =  number_format($totprice, $format, '.', '');
            $amtintowords = \common\components\Common::AmountInWords($totalprice,$receiptDtls['origin_type']);
        }
        $baseUrl = \Yii::$app->params['baseUrl'];
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
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/jsrs-logo-icon.png');
        //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .5;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('receipt',['receiptDtls'=>$receiptDtls,'amtintowords'=>$amtintowords,'vatper'=>$vatper,'baseprice'=>$baseprice,'vatprice'=>$vatpercent,'totalprice'=>$totalprice,'address'=>$address, 'isRenewal'=>$isRenewal]));
        $mpdf->Output("../backend/receipt/$regPk/$receiptpath",'F'); 
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => '5', 'margin_right' => '5', 'margin_top' => '10', 
//            'margin_bottom' => '10', 'margin_header' => '0', 'margin_footer' => '0', 'default_font_size' => '', 'orientation' => 'P']);
//        $mpdf->WriteHTML($this->renderPartial('../../views/receipt', ['receiptDtls' => $receiptModel, 'paymentDtls' => $paymentDtls]));
//        $mpdf->Output("../backend/receipt/$receiptModel->mcpr_receiptno.pdf",'F');
    }
    public function generateTaxInvoice($regPk, $isRenewal) {  
        $invoiceDtls= AfterLogin::getInvoiceDtls($regPk);
        $invoice_path = $invoiceDtls['taxInvoicePath'];
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
            $baseprice = number_format($invoiceDtls['subscription']['packageBasePrice'], $format, '.', '');
            $vatprice =  $vatpercent * $invoiceDtls['subscription']['packageBasePrice'] ;
            $totprice = $invoiceDtls['subscription']['packageBasePrice'] + $vatprice;  
            $totalprice =  number_format($totprice, $format, '.', '');
            $vatpricefor =  number_format($vatprice, $format, '.', '');
            $amtintowords = \common\components\Common::AmountInWords($totalprice, $invoiceDtls['origin_type']);
        }        
        $baseUrl = \Yii::$app->params['baseUrl'];
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
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/jsrs-logo-icon.png');
        //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .5;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('../../../al/views/afterlogin/invoice',['invoiceDtls'=>$invoiceDtls,'amtintowords'=>$amtintowords,'vatper'=>$vatper,'baseprice'=>$baseprice,'vatprice'=>$vatpricefor,'totalprice'=>$totalprice,'address'=>$address,'isRenewal' => $isRenewal, 'taxinvoice' => 1]));
        $mpdf->Output("../backend/invoice/$regpk/$invoice_path",'F');
    }    
    public function actionViewreceipt() {
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', true);
        $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', true);
        $fileName = "receipt-$regPk-$compPk.pdf";
        $path = dirname(__FILE__)."/../../../../backend/receipt/";
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename = $fileName");
        @readfile($path.$fileName);
        exit;
    }
    
    public function actionDownloadreceipt() {
        $regPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', true);
        $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', true);
        $fileName = "receipt-$regPk-$compPk.pdf";
        $path = dirname(__FILE__)."/../../../../backend/receipt/";
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Length:". filesize($path.$fileName));
        @readfile($path.$fileName);
        exit;
    }
    public function actionResendreceipt(){
        $getResponse = $_GET;
        $companyPk = $getResponse['companypk'];
        $regPk = $getResponse['regPk'];
        if($companyPk != ''){
         $enCompPk = \common\components\Security::encrypt($companyPk);
        $enRegPk = \common\components\Security::encrypt($regPk);
        $companyDAta = \api\modules\mst\models\MembercompanymstTbl::findOne($companyPk);
        $viewlink = \Yii::$app->urlManager->createAbsoluteUrl(['/apr/approval/viewreceipt?cpk='.$enCompPk.'&rpk='.$enRegPk]);
        $downloadlink = \Yii::$app->urlManager->createAbsoluteUrl(['/apr/approval/downloadreceipt?cpk='.$enCompPk.'&rpk='.$enRegPk]);
        $data['companyName'] = $companyDAta->MCM_CompanyName;
        \common\components\ApprovalComponents::sendReceiptMail($data,$viewlink);
        }
         return $this->asJson([
            'data' => '',
            'msg' => 'Success',
            'status' => 100,
            ]);
    }
    public function actionResendinvoice(){
        $getResponse = $_GET;
        $companyPk = $getResponse['companypk'];
        $regPk = $getResponse['regPk'];
        if($companyPk != ''){
         $enCompPk = \common\components\Security::encrypt($companyPk);
        $enRegPk = \common\components\Security::encrypt($regPk);
        $companyDAta = \api\modules\mst\models\MembercompanymstTbl::findOne($companyPk);
        $viewlink = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/viewinvoice?cpk='.$enCompPk.'&rpk='.$enRegPk]);
        $downloadlink = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadinvoice?cpk='.$enCompPk.'&rpk='.$enRegPk]);
        $data['companyName'] = $companyDAta->MCM_CompanyName;
        \common\components\AfterLogin::sendInvoiceMail($data,$viewlink);
        }
         return $this->asJson([
            'data' => '',
            'msg' => 'Success',
            'status' => 100,
            ]);
    }
    public function actionPaymentlog(){
        $paymentLogData = \common\models\MemcomppymtapphstryTbl::getPaymentLog();
        echo "<pre>"; print_r($paymentLogData); exit;
    }
    public function actionSupplierdata(){
        $supplierData = MemberregistrationmstTbl::getSupplierRegdata();
        $formatedData = array();
        if($supplierData != ''){
            $formatedData = ApprovalComponents::formatData($supplierData);
        }
         return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionInvestorregdata(){
        echo \common\components\Common::generateLyPISID('617','104');
        exit;
        $supplierData = MemberregistrationmstTbl::getInvestorRegdata();
        $formatedData = array();
        if($supplierData != ''){
            $formatedData = ApprovalComponents::invformatData($supplierData);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionProjectregdata(){
        $projOwnData = MemberregistrationmstTbl::getProjOwnRegdata();
        $formatedData = array();
        if($projOwnData != ''){
            $formatedData = ApprovalComponents::ProjOwnformatData($projOwnData);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionBuyerregdata(){
        $buyerData = MemberregistrationmstTbl::getBuyerRegdata();
        $formatedData = array();
        if($buyerData != ''){
            $formatedData = ApprovalComponents::buyerformatData($buyerData);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionUpdtepaymentstatuschange(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if(!empty($data['id'])){
            $pymtModel = \common\models\MemcomppymtinfodtlsTbl::findOne($data['id']);
            $regPk = $pymtModel->mcpidMembercompmstFk->MCM_MemberRegMst_Fk;
            $compPk = $pymtModel->mcpidMembercompmstFk->MemberCompMst_Pk;
            $pymtModel->mcpid_pymtstatus = $data['fdata']['selectpaymentstatus'];
            $pymtModel->mcpid_apprcomments = $data['fdata']['comments'];
            if($data['fdata']['selectpaymentstatus']==1){
                $pymtModel->mcpid_transrefno = $data['fdata']['paymentnumber'];
            }
            if($pymtModel->save()){
                if(!empty($regPk)){
                    $regModel = \common\models\MemberregistrationmstTbl::findOne($regPk);
                    $memberStatus = $regModel->MRM_MemberStatus;
                    if($regModel->MRM_RenewalStatus==NULL){
                        if($pymtModel->mcpid_pymtstatus==1){
                            $regModel->MRM_AFVPStatus = 'P';
                            $regModel->save();
                            \Yii::$app->db->createCommand("update memcompinvoicedtls_tbl SET mcid_invoicestatus = 'CP' WHERE memcompinvoicedtls_pk=".$pymtModel->mcpid_memcompinvoicedtls_fk)->execute();
                            if($memberStatus=='A'){
                                $regModel->MRM_RenewalStatus = 'RW';
                                $regModel->save();
                                \Yii::$app->db->createCommand("update memcomprewtemp_tbl SET mcrt_paymentstatus = 'Y', mcrt_submittedon = '".Date('Y-m-d H:i:s')."', mcrt_submittedby = ".$pymtModel->mcpid_submittedby.", mcrt_memcomppymtinfodtls_fk = '$pymtModel->memcomppymtinfodtls_pk' WHERE mcrt_membercompmst_fk=".$compPk)->execute();
                            }
                            ApprovalComponents::paymentreceivedmail($regPk);
                        }else{
                            $regModel->MRM_AFVPStatus = 'N';
                            $regModel->save();
                            $pymtData = \common\models\MemcomppymtinfodtlsTbl::findOne($pymtModel->memcomppymtinfodtls_pk);
                            $pymtData->delete();
                            if($memberStatus=='A'){
                                \Yii::$app->db->createCommand("update memcomprewtemp_tbl SET mcrt_paymentstatus = 'N' WHERE mcrt_membercompmst_fk=".$compPk)->execute();
                            }
                            ApprovalComponents::paymentnotreceivedmail($regPk);
                        }
                    }else{
                        if($memberStatus=='A' && $pymtModel->mcpid_pymtstatus==1){
                            if($regModel->MRM_RenewalStatus=='D'){
                                $regModel->MRM_RenewalStatus = 'RS';
                            }else{
                                $regModel->MRM_RenewalStatus = 'RW';
                            }
                            $regModel->save();
                            \Yii::$app->db->createCommand("update memcompinvoicedtls_tbl SET mcid_invoicestatus = 'CP' WHERE memcompinvoicedtls_pk=".$pymtModel->mcpid_memcompinvoicedtls_fk)->execute();
                            \Yii::$app->db->createCommand("update memcomprewtemp_tbl SET mcrt_paymentstatus = 'Y', mcrt_submittedon = '".Date('Y-m-d H:i:s')."', mcrt_submittedby = ".$pymtModel->mcpid_submittedby.", mcrt_memcomppymtinfodtls_fk = '$pymtModel->memcomppymtinfodtls_pk' WHERE mcrt_membercompmst_fk=".$compPk)->execute();
                            ApprovalComponents::paymentreceivedmail($regPk);
                        }else{
                            \Yii::$app->db->createCommand("update memcomprewtemp_tbl SET mcrt_paymentstatus = 'N' WHERE mcrt_membercompmst_fk=".$compPk)->execute();
                            $pymtData = \common\models\MemcomppymtinfodtlsTbl::findOne($pymtModel->memcomppymtinfodtls_pk);
                            $pymtData->delete();
                            ApprovalComponents::paymentnotreceivedmail($regPk);
                        }
                    }
                    
                }
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Updated successfully!',
                );
            }else{
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$pymtModel->getErrors(),
                );
            }            
        }else{
            $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>"Id is empty",
                );
        }
        return $result;
    }    
    
    public function actionGetrenewaldtls()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if($data != ''){
            $formatedData = ApprovalComponents::getrenewaldtls($data['regpk']);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    
    public function actionGetcompdetails()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if($data != ''){
            
            $formatedData = ApprovalComponents::getcompdetails($data['regpk']);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionGetpaymenttrackerinfo()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if($data != ''){            
            $formatedData = ApprovalComponents::getcomppaymentdetails($data['regpk']);
        }
        return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionGetpaymentdetails()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if($data != ''){            
            $formatedData = ApprovalComponents::getpaymentsubdetails($data['invpk']);
        }
        return $this->asJson([
            'data' => $formatedData,
            'msg' => 'Success',
            'status' => 100,
        ]);
    }
    public function actionSurveylistonregnew() {        
        $dataModel =\common\components\ApprovalComponents::surveylistnew();  
        $filename = "registrationsurveyrep". date('Ymdhis').".csv";
        ob_clean();
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);      
        header('Pragma: no-cache');
        header("Expires: 0");
        $fp = fopen('php://output', 'w');
        fputcsv($fp, ['NBF Number', 'Company Name', 'Country', 'Registered On', 'Payment Status','Member Status',
             'Confirmed On', 'Classification', 'LCC', 'Riyada','Business Sector','Business Source','JSRS Objective',
            'Objective - Others','How do you know JSRS','Sub data','Comments']); //  'Member Status',
        if (count($dataModel) > 0) {
            foreach ($dataModel as $result) {
                fputcsv($fp, $result);
            }
        }
        exit;
    }
    public function actionSurveylistonregold() {
         $fileName = 'oldsurveyreport.xls';
         $path = dirname(__FILE__)."/../../../../backend/surveyreportold/";
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
    public function actionCheckforeignclassification() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['comp'];
        $dtl = AfterLogin::checkforeignclassification($data);
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetapprovaltemplate() {
        $dtl = ApprovalComponents::getApprovalComments();
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetstkdeletetemplate() {
        $dtl = ApprovalComponents::getStkDeleteComments();
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionGetstkdeactivatetemplate() {
        $dtl = ApprovalComponents::getStkDeactivateComments();
        return $dtl ? $this->asJson($dtl) : [];
    }
    public function actionSupplierregisterdata(){
        $supplierData = MemberregistrationmstTbl::getRegistrationapprovaldata();
        $formatedData = array();
        if($supplierData != ''){
            $formatedData = ApprovalComponents::supplierregapprovalformatData($supplierData);
        }
         return $this->asJson([
                'data' => $formatedData,
                'msg' => 'Success',
                'status' => 100,
            ]);
    }
    public function actionDeletedeactivatesupp(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        $formatedData = ApprovalComponents::deletedeactivatesupplier($data['data']);
        return $this->asJson([
            'msg' => $formatedData['msg'],
            'statuscode' => $formatedData['status'],
        ]);
    }
    public function actionDeletesupplier(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);    
        $formatedData = ApprovalComponents::deletesupplier($data['data']);
        return $this->asJson([
            'msg' => $formatedData['msg'],
            'statuscode' => $formatedData['status'],
        ]);
    }
    public function actionResendregistrationconfirma(){
        $getResponse = $_GET;   
        $regPk = base64_decode($getResponse['registrationid']);
        $registrationdet = MemberregistrationmstTbl::find()
            ->where('MemberRegMst_Pk=:fk',[':fk'=> $regPk])
            ->one();
        if(!empty($registrationdet) && $registrationdet->MRM_OrderConfrmStat== 'N'){
            $registrationdet->MRM_OCMLastSentOn = date('Y-m-d');
            $registrationdet->MRM_OCMSentCount =  (!empty($registrationdet->MRM_OCMSentCount))? $registrationdet->MRM_OCMSentCount + 1: 1;
            $registrationdet->save();
        }
        $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $regPk,'um_primarycontact' => 1])->one();
        $userPk = $user_info->UserMst_Pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=>'suppreg',
            'userpk'=>$userPk
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
        $retresp = json_decode($response);
        if($retresp->status == 200){
            $status = 100;
            $message = "Mail sent Successfully";
        }else{
            $status = 101;
            $message = "Something went wrong, please try again later ";
        }        
        return $this->asJson([
            'msg' => $message,
            'statuscode' => $status,
        ]);
    }
    public function actionChangeuser(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $regpk = $data['regpk'];
        $ischangeuser= \common\models\UsermstTbl::find()->where("UM_MemberRegMst_Fk =:regpk and um_ischangeuser is not null ",[':regpk'=>$regpk])->count();
        if($ischangeuser == 0){
            $msg['msg'] = 'success';
            $msg['status'] = 1;            
            ApprovalComponents::changeUserAuthorize($data['userPk'], $data['newAdminUserPk']);           
        }else{
            $msg['msg'] = 'success';
            $msg['status'] = 2;
        }        
        return $this->asJson($msg);
    }
    public function actionGettrakerdetails(){
        $trackerdet = [];
        $regpk = base64_decode($_REQUEST['id']);
        $comppk = base64_decode($_REQUEST['sid']);
        $trackerdet = Yii::$app->db->createCommand("with recent_record as(
select scrh.*, row_number() over (partition by scrh_memberregmst_fk order by suppchangereqhdr_pk desc) as rn from suppchangereqhdr_tbl as scrh where scrh_memberregmst_fk = :regpk)
select 
	DATE_FORMAT(scrh_createdon,'%d-%m-%Y  %h:%i:%s %p') as 'updatedon',
	scrh_createdby as 'updatedbyval',
                   concat_ws(' ', um.um_firstname, um.um_middlename, um.um_lastname) as 'updatedby',
    
	if(scrd_c.scrd_flag = 1, 1, 2) as 'iscompanynamechange',
	if(scrd_c.scrd_flag = 1, scrd_c.scrd_newvalue, null) as 'companyname_new',
	if(scrd_c.scrd_flag = 1, scrd_c.scrd_oldvalue, null) as 'companyname_old',

    if(scrd_cr.scrd_flag = 9, 1, 2) as 'iscompanynamearchange',
	if(scrd_cr.scrd_flag = 9, scrd_cr.scrd_newvalue, null) as 'companynamear_new',
	if(scrd_cr.scrd_flag = 9, scrd_cr.scrd_oldvalue, null) as 'companynamear_old',
    
	if(scrd_e.scrd_flag = 2, 1, 2) as 'isemailchange',
	if(scrd_e.scrd_flag = 2, scrd_e.scrd_newvalue, null) as 'email_new',
	if(scrd_e.scrd_flag = 2, scrd_e.scrd_oldvalue, null) as 'email_old',
    
	if(scrd_pc.scrd_flag = 7, 1, 2) as 'isprimarycontactchange',
    um_pcn.um_userdp as 'primarycont_userdp_new',
    um_pco.um_userdp as 'primarycont_userdp_old',
    um_pcn.UserMst_Pk as 'primarycont_userpk_new',
    um_pco.UserMst_Pk as 'primarycont_userpk_old',
    concat_ws(' ', um_pcn.um_firstname, um_pcn.um_middlename, um_pcn.um_lastname) as 'primarycont_name_new',
    concat_ws(' ', um_pco.um_firstname, um_pco.um_middlename, um_pco.um_lastname) as 'primarycont_name_old',
    dsg_n.dsg_designationname as 'primarycont_designation_new',
    dsg_o.dsg_designationname as 'primarycont_designation_old',
    concat_ws(' ', cym_n.CyM_CountryDialCode, um_pcn.um_primobno)  as 'primarycont_mobile_new',
    concat_ws(' ', cym_o.CyM_CountryDialCode, um_pco.um_primobno)  as 'primarycont_mobile_old',
    um_pcn.UM_EmailID as 'primarycont_email_new',
    um_pco.UM_EmailID as 'primarycont_email_old',
    (case when scrd_cls.scrd_classupdin=1 then 'Profile' when scrd_cls.scrd_classupdin=2 then 'Renewal' when scrd_cls.scrd_classupdin=3 then 'Profile & Renewal' when scrd_cls.scrd_classupdin IS NULL then '' end) as updatein,
    if(scrd_cls.scrd_flag = 3, 1, 2) as 'issubscptionchnage',
    if(scrd_hc.scrd_flag = 5, scrd_hc.scrd_newvalue, null) as 'headcount_new',
    if(scrd_hc.scrd_flag = 5, scrd_hc.scrd_oldvalue, null) as 'headcount_old',
	clm_n.ClM_AnnualSales as 'annualslaes_new',
	clm_o.ClM_AnnualSales as 'annualslaes_old',
    clm_n.ClM_ClassificationType as 'classification_new',
    clm_o.ClM_ClassificationType as 'classification_old',
    if(scrd_a.scrd_flag = 6, scrd_a.scrd_newvalue, null) as 'certificationfee_new',
    if(scrd_a.scrd_flag = 6, scrd_a.scrd_oldvalue, null) as 'certificationfee_old',
    if(scrd_inc.scrd_flag = 8, 1, 2) as 'isincorpstylechnage',
    incorp_o.ISM_IncorpStyleEntity_en as 'incorpstyle_old',
    incorp_n.ISM_IncorpStyleEntity_en as 'incorpstyle_new',
    rr.scrh_upload as 'uploaddoc',
    rr.scrh_comments as 'comments'
from 
	recent_record as rr
    join usermst_tbl as um on rr.scrh_createdby = um.usermst_pk
    left join suppchangereqdtls_tbl as scrd_c on rr.suppchangereqhdr_pk = scrd_c.scrd_suppchangereqhdr_fk and scrd_c.scrd_flag = 1
    left join suppchangereqdtls_tbl as scrd_e on rr.suppchangereqhdr_pk = scrd_e.scrd_suppchangereqhdr_fk and scrd_e.scrd_flag = 2
    left join suppchangereqdtls_tbl as scrd_cls on rr.suppchangereqhdr_pk = scrd_cls.scrd_suppchangereqhdr_fk and scrd_cls.scrd_flag = 3
    left join suppchangereqdtls_tbl as scrd_hc on rr.suppchangereqhdr_pk = scrd_hc.scrd_suppchangereqhdr_fk and scrd_hc.scrd_flag = 5
    left join suppchangereqdtls_tbl as scrd_a on rr.suppchangereqhdr_pk = scrd_a.scrd_suppchangereqhdr_fk and scrd_a.scrd_flag = 6
    left join suppchangereqdtls_tbl as scrd_pc on rr.suppchangereqhdr_pk = scrd_pc.scrd_suppchangereqhdr_fk and scrd_pc.scrd_flag = 7
    left join suppchangereqdtls_tbl as scrd_inc on rr.suppchangereqhdr_pk = scrd_inc.scrd_suppchangereqhdr_fk and scrd_inc.scrd_flag = 8
    left join suppchangereqdtls_tbl as scrd_cr on rr.suppchangereqhdr_pk = scrd_cr.scrd_suppchangereqhdr_fk and scrd_cr.scrd_flag = 9
    left join usermst_tbl as um_pcn on scrd_pc.scrd_newvalue = um_pcn.usermst_pk
    left join usermst_tbl as um_pco on scrd_pc.scrd_oldvalue = um_pco.usermst_pk
    left join designationmst_tbl as dsg_n on um_pcn.UM_Designation = dsg_n.designationmst_pk
    left join designationmst_tbl as dsg_o on um_pco.UM_Designation = dsg_o.designationmst_pk
    left join countrymst_tbl as cym_n on um_pcn.um_primobnocc = cym_n.CountryMst_Pk
    left join countrymst_tbl as cym_o on um_pco.um_primobnocc = cym_o.CountryMst_Pk
    left join classificationmst_tbl as clm_n on scrd_cls.scrd_newvalue = clm_n.ClassificationMst_Pk
    left join classificationmst_tbl as clm_o on scrd_cls.scrd_oldvalue = clm_o.ClassificationMst_Pk
    left join incorpstylemst_tbl as incorp_n on scrd_inc.scrd_newvalue = incorp_n.IncorpStyleMst_Pk
    left join incorpstylemst_tbl as incorp_o on scrd_inc.scrd_oldvalue = incorp_o.IncorpStyleMst_Pk
where 
	rn = 1;")->bindValues([':regpk'=>$regpk])->queryOne();
        if(!empty($trackerdet)){
            $trackerdet['userdp_old'] = Drive::generateUrl($trackerdet['primarycont_userdp_old'], $comppk, $trackerdet['primarycont_userpk_old']);
            $trackerdet['userdp_new'] = Drive::generateUrl($trackerdet['primarycont_userdp_new'], $comppk, $trackerdet['primarycont_userpk_new']);
            if(!empty($trackerdet['uploaddoc'])){
                $trackerdet['isshowsupplierprofdoc'] = 1;
                $trackerdet['supplieruploadlink'] = Drive::generateUrl($trackerdet['uploaddoc'], $comppk, $trackerdet['updatedbyval']);
                $trackerdet['supplieruploadname'] = Drive::getFileName(\common\components\Security::encrypt($trackerdet['uploaddoc']));
                $trackerdet['supplieruploadext'] = pathinfo($trackerdet['supplieruploadname'],PATHINFO_EXTENSION);
            }else{
                $trackerdet['isshowsupplierprofdoc'] = 2;
                $trackerdet['supplieruploadlink'] = "";
                $trackerdet['supplieruploadname'] = "";
                $trackerdet['supplieruploadext'] = "";
            }
        }
        return $this->asJson($trackerdet);
    }
}
