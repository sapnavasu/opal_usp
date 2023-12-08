<?php

namespace api\components;
use Yii;
use \common\models\MemberregistrationmstTbl;
use \api\modules\mst\models\CountryMasterQuery;
use \common\components\Common;
define("mstcardType", ['ODC', 'OC', 'OTO', 'OTC', 'T', 'SP']); 
define("mstrequestType", ['REG', 'RENEW', 'CMS', 'MDN', 'ET', 'GCC']); 
define("mstpaymenttoken", ['Y','N']); 

class AfterLogin {
    
      
    public static function stakeholderDetails($regPk, $compPk) {
        $response = [];
        $response['invoiceGenerated'] = \common\models\MemcompinvoicedtlsTbl::isInvoiceGenerated($compPk);
        $data = MemberregistrationmstTbl::findOne($regPk);
        $response['companyName'] = $data->company->MCM_CompanyName;
        $response['countryName'] = $data->company->country->CyM_CountryName_en;
        $response['countryPk'] = $data->company->country->CountryMst_Pk;
        $response['origin'] = ($data->company->MCM_Origin == 'I') ? 'INTERNATIONAL' : 'NATIONAL';   
        $response['stakeholderType'] = $data->mrm_stkholdertypmst_fk;
        $response['crregno'] = $data->company->MCM_crnumber;
        $response['website'] = $data->company->MCM_website ?? 'NIL';
        $response['classicationPk'] = $data->company->mcm_classificationmst_fk ?? null;
        $response['subscriptionPk'] = $data->mrm_memsubscriptionmst_fk ?? null;
        $response['selectedAddnlPackage'] = !empty($data->mrm_additionalpackage) ? array_map("intval", explode(",",$data->mrm_additionalpackage)) : [];
        $response['promoCode'] = $data->mrm_promocodemst_fk ?? null;
        $response['packageDtl'] = [];
        
        if($response['origin'] == 'INTERNATIONAL') {
            $response['packageDtl'] = $response['subscription'] = $response['additionalpackage'] = [];
            $response['packageDtl'] = self::getSubscriptionDtlByOrigin($response['countryPk']);
            $response['promoDtl'] = self::checkValidAndApplyPromoCode([
                    'promoCode' => $data->promocode->pcm_promocode,
                    'classification' => $response['classicationPk'],
                    'subTotal' => (int)$data->subscription->msm_baseprice,
                    'country' => $response['countryPk']
                ]);
        }
        
        if(!empty($response['classicationPk']) && !empty($response['subscriptionPk'])){
            $req['headCount'] = $data->company->classification->ClM_HeadCount ?? null;
            $req['annualSales'] = $data->company->classification->ClM_AnnualSales ?? null;
            $req['stktype'] = $response['stakeholderType'];
            $response['packageDtl'] = self::getClassificationPackage($req,$compPk);
            if(!empty($response['packageDtl'])){
                $response['promoDtl'] = self::checkValidAndApplyPromoCode([
                    'promoCode' => $data->promocode->pcm_promocode,
                    'classification' => $response['classicationPk'],
                    'subTotal' => (int)$data->subscription->msm_baseprice,
                    'country' => $response['countryPk']
                ]);
            }
        }
        
        $enCompPk = Security::encrypt($compPk);
        $enRegPk = Security::encrypt($regPk);
        $response['invoice'] =  $data->company->invoice->memcompinvoicedtls_pk ?? 'NIL';
        $response['invoiceLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadinvoice?cpk='.$enCompPk.'&rpk='.$enRegPk]);
        
        $response['primaryContact'] = [];
        $primaryUser = array_filter($data->user, function($var){
            return ($var->UM_Type == 'C');
        });
        $response['primaryContact']['pk'] = $primaryUser[0]->UserMst_Pk;
        $response['primaryContact']['firstname'] = $primaryUser[0]->um_firstname;
        $response['primaryContact']['lastname'] = $primaryUser[0]->um_lastname;
        $response['primaryContact']['emailid'] = $primaryUser[0]->UM_EmailID;
        $response['primaryContact']['renteremailid'] = $primaryUser[0]->UM_EmailID;
        $response['primaryContact']['department'] = (string) $primaryUser[0]->um_departmentmst_fk;
        $response['primaryContact']['designation'] = $primaryUser[0]->designation->dsg_designationname;
        $response['primaryContact']['mobileno'] = $primaryUser[0]->um_primobno;
        $response['primaryContact']['landlineno'] = $primaryUser[0]->um_landlineno;
        $response['primaryContact']['mobilecc'] = (int) CountryMasterQuery::getCountryPkByDialCode($primaryUser[0]->um_primobnocc)['CountryMst_Pk'];
        $response['primaryContact']['landlinecc'] = (int) CountryMasterQuery::getCountryPkByDialCode($primaryUser[0]->um_landlinecc)['CountryMst_Pk'];
        $response['primaryContact']['mobileDialCode'] = $primaryUser[0]->um_primobnocc;
        $response['primaryContact']['landlineDialCode'] = $primaryUser[0]->um_landlinecc;
        $response['primaryContact']['landlineext'] = $primaryUser[0]->um_landlineext;
        
        if($response['invoiceGenerated']){
            $paymentDtl = \common\models\MemcomppymtdtlsTbl::getPaymentInfoByCompany($data->company->MemberCompMst_Pk);
            $response['showDeclinedTag'] = false;
            $response['decComments'] = '';
            $response['paymentDtl'] = [];
            if($paymentDtl->mcpd_pymtapprovalstatus == 1){
                $response['paymentDtl']['bankName'] = $paymentDtl->mcpd_bankname;
                $response['paymentDtl']['refno'] = $paymentDtl->mcpd_transrefno;
                $response['paymentDtl']['transcdate'] = \common\components\Common::convertDateTimeToServerTimezone($paymentDtl->mcpd_transdate);
                $response['paymentDtl']['selectedpaymentType'] = $paymentDtl->paymentgateway->pgwm_gateways;
                $response['paymentDtl']['paymentMode'] = ($paymentDtl->paymentgateway->pgwm_paymenttype == 1) ? 'Online' : 'Offline';
            }else{
                $response['showDeclinedTag'] = $paymentDtl->mcpd_pymtapprovalstatus == 3 ? true : false;
                $response['decComments'] = ($response['showDeclinedTag']) ? $paymentDtl->mcpd_appdeclcomments : '';
            }
        }
        return $response;
    }
    public static function getPromocodeAmount($amount, $promo_percent=0, $promo_maxprice=0){
        $promocode_sts = \Yii::$app->params['Promocode_enable'];   
        if($promocode_sts){
            $promo_amt = (($amount * $promo_percent) / 100);
            if($promo_amt <=$promo_maxprice){
                $promo_disc_amt = $amount - $promo_amt;
                $response['promocode_amount'] = number_format($promo_amt, 3, '.', '');
            }else{
                $promo_disc_amt = $amount - $promocode_maxprice;
                $response['promocode_amount'] = number_format($promocode_maxprice, 3, '.', '');
            }
            $discounted_amount = $promo_disc_amt;
            $response['discounted_amount'] = $discounted_amount;
            $response['promocode_percent'] = $promo_percent;   
            return $response;         
        }else{
            $response['discounted_amount'] = $amount;
            $response['promocode_percent'] = '0.00';
            $response['promocode_amount'] = '0.000';
            return $response;
        }
    }
    public static function getPaymentData($discounted_amount){
        $var_percent = \Yii::$app->params['vatpercentage'];
        $addi_process_fee = \Yii::$app->params['additional_processing_charge'];
        $addi_process_fee_inter = \Yii::$app->params['additional_processing_charge_international'];
        $response['additionalPrice'] = ($discounted_amount / 100) * $addi_process_fee;
        $response['additionalPrice'] = number_format(floor($response['additionalPrice'] * 100) / 100, 3, '.', '');
        $response['vatprice'] = number_format(($discounted_amount/100)*$var_percent, 3, '.', '');
        $response['totalPrice'] =   number_format($discounted_amount + $response['additionalPrice'] +$response['vatprice'], 3, '.', '');
        $response['offlinetotalPrice'] =   number_format($discounted_amount +$response['vatprice'], 3, '.', '');        
        return $response;
    }
    public static function getClassificationPackage($requestdata, $compPk) {
        $response = [];     
        $discount_sts = \Yii::$app->params['Discount'];           
        $classficationDtl =  \api\modules\mst\models\ClassificationmstTblQuery::getClassification($requestdata);                
        if(!empty($classficationDtl)){
        $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classficationDtl);        
        
        $pymtInfo = \common\models\MemcomppymtdtlsTbl::find()->where(['MCPD_MemberCompMst_Fk' => $compPk])->orderBy(['MemCompPymtDtls_Pk' => SORT_DESC])->one();        
        $discount_percent = $discount_amount = $promocode_percent = $promocode_maxprice = 0.00;
        if(!empty($pymtInfo)){
            $promocodemst_pk = $pymtInfo->mcpd_promocodemst_fk;
            $discount_percent = $pymtInfo->mcpd_discpercent;
            $discount_amount = $pymtInfo->mcpd_discountval;
            if($promocodemst_pk){                
                $promocode = \common\models\PromocodemstTbl::findOne($promocodemst_pk);
                if(!empty($promocode)){
                    $promocode_percent = $promocode->pcm_discpercent;
                    $promocode_maxprice = $promocode->pcm_maxdisprice;
                }
            }
        }
        $classarrayclass = ['SME-Micro'=>'micro','SME-Small'=>'small','SME-Medium'=>'medium','Non-SME'=>'large'];
        $response['classificationName'] = $classficationDtl->ClM_ClassificationType;
        $response['classificationName_ar'] = $classficationDtl->ClM_ClassificationType_ar;
        $response['classificationclass'] = $classarrayclass[$classficationDtl->ClM_ClassificationType];
        $response['classicationPk'] = $classficationDtl->ClassificationMst_Pk;
        $response['memsubsbyclassifPk'] = $subscriptionDtl->memsubsbyclassif_pk;
        $response['subscription'] = $response['additionalpackage'] = [];
       
            $response['subscription']['subscriptionPk'] = $subscriptionDtl->subscription->memsubscriptionmst_pk;
            $response['subscription']['packageName'] = $subscriptionDtl->subscription->msm_packagename;
            $response['subscription']['packageDesc'] = $subscriptionDtl->subscription->msm_packagedesc;
            $response['subscription']['duration'] = Common::getDurationByDays($subscriptionDtl->subscription->msm_duration);
            $response['subscription']['packageBasePrice'] = (int)$subscriptionDtl->subscription->msm_baseprice;
            $response['subscription']['packageBasePrice'] = number_format((int) $subscriptionDtl->subscription->msm_baseprice, 3, '.', '');           
            $response['subscription']['vatrate']=\Yii::$app->params['vatpercentage'];
            $response['subscription']['discount_percent'] = $discount_percent;
            $response['subscription']['discount_amount'] = number_format((float)$discount_amount, 3, '.', '');
            if($discount_sts){
                $discounted_amount = $response['subscription']['packageBasePrice'] - $discount_amount;                
                $promodata = self::getPromocodeAmount($discounted_amount, $promocode_percent, $promocode_maxprice);
                $response['subscription']['promocode_percent'] = $promodata['promocode_percent'];
                $response['subscription']['promocode_amount'] = $promodata['promocode_amount'];
                $paymentdata = self::getPaymentData($promodata['discounted_amount']);
                $response['subscription']['additionalPrice'] = $paymentdata['additionalPrice'];
                $response['subscription']['vatprice'] = $paymentdata['vatprice'];
                $response['subscription']['totalPrice'] =   $paymentdata['totalPrice'];
                $response['subscription']['offlinetotalPrice'] = $paymentdata['offlinetotalPrice'];
            }else{
                $promodata = self::getPromocodeAmount($response['subscription']['packageBasePrice'], $promocode_percent, $promocode_maxprice);
                $response['subscription']['promocode_percent'] = $promodata['promocode_percent'];
                $response['subscription']['promocode_amount'] = $promodata['promocode_amount'];
                $paymentdata = self::getPaymentData($promodata['discounted_amount']);                
                $response['subscription']['additionalPrice'] = $paymentdata['additionalPrice'];
                $response['subscription']['vatprice'] = $paymentdata['vatprice'];
                $response['subscription']['totalPrice'] =   $paymentdata['totalPrice'];
                $response['subscription']['offlinetotalPrice'] = $paymentdata['offlinetotalPrice'];
            }            
            $response['subscription']['packageBaseCurrencyPk'] = $subscriptionDtl->subscription->msm_basecurrency;
            $response['subscription']['packageBaseCurrencyName'] = $subscriptionDtl->subscription->currency->CurM_CurrencyName_en;
            $response['subscription']['packageBaseCurrencySymbol'] = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
            foreach ($subscriptionDtl->additionalpackage as $key => $additionalPackage){
                $response['additionalpackage'][$key]['subscriptionPk'] = $additionalPackage->memsubscriptionmst_pk;
                $response['additionalpackage'][$key]['packageName'] = $additionalPackage->msm_packagename;
                $response['additionalpackage'][$key]['packageDesc'] = $additionalPackage->msm_packagedesc;
                $response['additionalpackage'][$key]['duration'] = Common::getDurationByDays($additionalPackage->msm_duration);
                $response['additionalpackage'][$key]['packageBasePrice'] = (int)$additionalPackage->msm_baseprice;
                $response['additionalpackage'][$key]['packageBaseCurrencyPk'] = $additionalPackage->msm_basecurrency;
                $response['additionalpackage'][$key]['packageBaseCurrencyName'] = $additionalPackage->currency->CurM_CurrencyName_en;
                $response['additionalpackage'][$key]['packageBaseCurrencySymbol'] = $additionalPackage->currency->CurM_CurrSymbol;
            }
        }else{
            
            $compdtls = \common\models\MembercompanymstTbl::findOne($compPk);
            $regPk = $compdtls->MCM_MemberRegMst_Fk ; 
            $data = MemberregistrationmstTbl::findOne($regPk);
            $pymtInfo = \common\models\MemcomppymtdtlsTbl::find()->where(['MCPD_MemberCompMst_Fk' => $compPk])->orderBy(['MemCompPymtDtls_Pk' => SORT_DESC])->one();
            $discount_sts = Yii::$app->params['Discount'];
            $discount_percent = $discount_amount = $promocode_percent = $promocode_maxprice = 0.00;
            if(!empty($pymtInfo)){
                $promocodemst_pk = $pymtInfo->mcpd_promocodemst_fk;
                $discount_percent = $pymtInfo->mcpd_discpercent;
                $discount_amount = $pymtInfo->mcpd_discountval;
                if($promocodemst_pk){                
                    $promocode = \common\models\PromocodemstTbl::findOne($promocodemst_pk);
                    if(!empty($promocode)){
                        $promocode_percent = $promocode->pcm_discpercent;
                        $promocode_maxprice = $promocode->pcm_maxdisprice;
                    }
                }
            }
            $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($data->company->classification);
            $response['classificationName'] = $data->company->classification->ClM_ClassificationType;
            $response['classificationName_ar'] = $data->company->classification->ClM_ClassificationType_ar;
            $response['classicationPk'] = $data->company->classification->ClassificationMst_Pk;
            $response['memsubsbyclassifPk'] = $subscriptionDtl->memsubsbyclassif_pk;
            $response['subscription'] = $response['additionalpackage'] = [];       
            $response['subscription']['subscriptionPk'] = $subscriptionDtl->subscription->memsubscriptionmst_pk;
            $response['subscription']['packageName'] = $subscriptionDtl->subscription->msm_packagename;
            $response['subscription']['packageDesc'] = $subscriptionDtl->subscription->msm_packagedesc;
            $response['subscription']['duration'] = Common::getDurationByDays($subscriptionDtl->subscription->msm_duration);
            $response['subscription']['packageBasePrice'] = (int)$subscriptionDtl->subscription->msm_baseprice;
            $response['subscription']['packageBasePrice'] = (int) $subscriptionDtl->subscription->msm_baseprice;            
            $response['subscription']['vatprice'] = ($response['subscription']['packageBasePrice']/100)*\Yii::$app->params['vatpercentage'];
            $response['subscription']['vatrate']=\Yii::$app->params['vatpercentage'];
            $response['subscription']['discount_percent'] = $discount_percent;
            $response['subscription']['discount_amount'] = number_format((float)$discount_amount, 3);
            if($discount_sts){
                $discounted_amount = $response['subscription']['packageBasePrice'] - $discount_amount;                
                $promodata = self::getPromocodeAmount($discounted_amount, $promocode_percent, $promocode_maxprice);
                $response['subscription']['promocode_percent'] = $promodata['promocode_percent'];
                $response['subscription']['promocode_amount'] = $promodata['promocode_amount'];
                $paymentdata = self::getPaymentData($promodata['discounted_amount']);
                $response['subscription']['additionalPrice'] = $paymentdata['additionalPrice'];
                $response['subscription']['vatprice'] = $paymentdata['vatprice'];
                $response['subscription']['totalPrice'] =   $paymentdata['totalPrice'];
                $response['subscription']['offlinetotalPrice'] = $paymentdata['offlinetotalPrice'];
            }else{
                $promodata = self::getPromocodeAmount($response['subscription']['packageBasePrice'], $promocode_percent, $promocode_maxprice);
                $response['subscription']['promocode_percent'] = $promodata['promocode_percent'];
                $response['subscription']['promocode_amount'] = $promodata['promocode_amount'];
                $paymentdata = self::getPaymentData($promodata['discounted_amount']);                
                $response['subscription']['additionalPrice'] = $paymentdata['additionalPrice'];
                $response['subscription']['vatprice'] = $paymentdata['vatprice'];
                $response['subscription']['totalPrice'] =   $paymentdata['totalPrice'];
                $response['subscription']['offlinetotalPrice'] = $paymentdata['offlinetotalPrice'];
            }        
            $response['subscription']['packageBaseCurrencyPk'] = $subscriptionDtl->subscription->msm_basecurrency;
            $response['subscription']['packageBaseCurrencyName'] = $subscriptionDtl->subscription->currency->CurM_CurrencyName_en;
            $response['subscription']['packageBaseCurrencySymbol'] = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
        }
        
        return $response;
    }
    
    public function checkValidAndApplyPromoCode($requestdata) {
        $subTotal = 0;
        $discountPercentage = 0;
        $promoCodeDtl = \common\models\PromocodemstTbl::getPromoCodeDtls($requestdata);
        if(!empty($promoCodeDtl) && Common::isNotExpired($promoCodeDtl->pcm_promovalidfrom, $promoCodeDtl->pcm_promovalidto)){
            $discountPrice = ($requestdata['subTotal'] * $promoCodeDtl->pcm_discpercent) / 100;
            if($promoCodeDtl->pcm_maxdisprice > $discountPrice) {
                $subTotal = $requestdata['subTotal'] - $discountPrice;
            } else {
                $subTotal = $requestdata['subTotal'] - $promoCodeDtl->pcm_maxdisprice;
            }
        }
        $discountPercentage = intval($promoCodeDtl->pcm_discpercent);
        return !empty($promoCodeDtl) ? [
            'promoCode' => $promoCodeDtl->promocodemst_pk,
            'promoCodeText' => $promoCodeDtl->pcm_promocode,
            'total' => $subTotal,
            'discount' => "$discountPercentage%",
            'discountAmount' => $requestdata['subTotal'] - $subTotal
        ] : [];
    }

    public function sendInvoiceMail($data,$link) {
        $name =  $data['companyName'];
        $content = "Hi $name, <br> Please find your invoice attachemnt. <br> Kindly use the below link to view the invoice <br><a href='$link' target='_blank'>Click Here </a> <br>  Thanks,";
        return \Yii::$app->mailer->compose()
                ->setFrom('noreply@businessgateways.com')
                ->setTo(\Yii::$app->params['testMailIDs'])
                ->setSubject('Invoice Generated')
                ->setHTMLBody($content)
                ->send();
    }
    public function isSubscriptionAvailable($regType, $compPk) {
        //check Is Payment Enabled and Paid or Not
        $paymentInfo = null;
        $isPaymentEnabled = \api\modules\mst\models\MemsubscriptionmstTbl::isPaymentEnabledForTheUser($regType);
        if ($isPaymentEnabled) {
            $paymentInfo = \common\models\MemcomppymtdtlsTbl::getPaymentInfoByCompany($compPk);
        }
        if($isPaymentEnabled && empty($paymentInfo)){
            $flag = 'AL'; // After Login 
        } else if($isPaymentEnabled && $paymentInfo->mcpd_pymtstatus == 2 &&  $paymentInfo->mcpd_pymtapprovalstatus == 2){
            $flag = 'S';
        } else if($isPaymentEnabled && $paymentInfo->mcpd_pymtstatus == 2 &&  $paymentInfo->mcpd_pymtapprovalstatus == 1) {
            $flag = 'AL'; //Validation Pending redirect to After Login thank you page
        } else if($isPaymentEnabled && $paymentInfo->mcpd_pymtstatus == 2 &&  $paymentInfo->mcpd_pymtapprovalstatus == 3) {
            $flag = 'AL'; //Declined so redirecting to AfterLogin
        } else {
            $flag = 'S'; 
        }
        return $flag;
    }

    public static function getSubscriptionDtlByOrigin($countrypk) {
        $response = [];
        $subscriptionByOrigin = \common\models\MemsubsbyoriginTbl::getSubDtlsByOrigin($countrypk);
            $response['subscription']['subscriptionPk'] = $subscriptionByOrigin->subscription->memsubscriptionmst_pk;
            $response['subscription']['packageName'] = $subscriptionByOrigin->subscription->msm_packagename;
            $response['subscription']['packageDesc'] = $subscriptionByOrigin->subscription->msm_packagedesc;
            $response['subscription']['duration'] = Common::getDurationByDays($subscriptionByOrigin->subscription->msm_duration);
            $response['subscription']['packageBasePrice'] = (int)$subscriptionByOrigin->subscription->msm_baseprice;
            $response['subscription']['packageBaseCurrencyPk'] = $subscriptionByOrigin->subscription->msm_basecurrency;
            $response['subscription']['packageBaseCurrencyName'] = $subscriptionByOrigin->subscription->currency->CurM_CurrencyName_en;
            $response['subscription']['packageBaseCurrencySymbol'] = $subscriptionByOrigin->subscription->currency->CurM_CurrSymbol;
            foreach ($subscriptionByOrigin->additionalpackage as $key => $additionalPackage){
                $response['additionalpackage'][$key]['subscriptionPk'] = $additionalPackage->memsubscriptionmst_pk;
                $response['additionalpackage'][$key]['packageName'] = $additionalPackage->msm_packagename;
                $response['additionalpackage'][$key]['packageDesc'] = $additionalPackage->msm_packagedesc;
                $response['additionalpackage'][$key]['duration'] = Common::getDurationByDays($additionalPackage->msm_duration);
                $response['additionalpackage'][$key]['packageBasePrice'] = (int)$additionalPackage->msm_baseprice;
                $response['additionalpackage'][$key]['packageBaseCurrencyPk'] = $additionalPackage->msm_basecurrency;
                $response['additionalpackage'][$key]['packageBaseCurrencyName'] = $additionalPackage->currency->CurM_CurrencyName_en;
                $response['additionalpackage'][$key]['packageBaseCurrencySymbol'] = $additionalPackage->currency->CurM_CurrSymbol;
            }
        return $response;
    }
    public static function getCMSPaymentDetail($contPk) {        
        $compk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userType = \yii\db\ActiveRecord::getTokenData('user_type', true);
        $data = MemberregistrationmstTbl::findOne($regpk);
        $cmshdr = \api\modules\pms\models\CmscontracthdrTbl::findOne($contPk);
        $invoice= \common\models\MemcompinvoicedtlsTbl::find()->where("mcid_shared_fk=:compk",[':compk'=>$cmshdr->cmscontracthdr_pk])->orderBy(['memcompinvoicedtls_pk' => SORT_DESC])->one();
        $origin = $data->company->MCM_Origin;
        $response['companyPk'] = $compk;
        $response['crregno'] = $data->company->MCM_crnumber;
        $response['companyName'] = $data->company->MCM_CompanyName;
        $response['origin'] = ($origin == 'I') ? 'INTERNATIONAL' : 'NATIONAL';
        $response['origintype'] = $origin;
        $response['paymentModule'] = (!empty($invoice->mcid_module))? \common\components\Common::getModuleName($invoice->mcid_module): 'CMS';
        $response['countryPk'] = $data->company->country->CountryMst_Pk;
        $response['countryName'] = $data->company->country->CyM_CountryName_en;
        $response['contractPk'] = $contPk;
        $response['contracttitle'] = $cmshdr->cmsch_contracttitle;
        $response['contractrefno'] = $cmshdr->cmsch_contractrefno;        
        $response['contractType'] = $cmshdr->cmsch_contracttype;        
        //$response['currsymbol'] = $cmshdr->cmschCurrencymstFk->CurM_CurrSymbol;
        $response['currsymbol'] = ($origin == 'I') ? 'USD' : 'OMR';
        $response['currencyPk'] = $cmshdr->cmschCurrencymstFk->CurrencyMst_Pk;
        $response['awardedby'] = $cmshdr->cmschMemcompmstFk->MCM_CompanyName;
        if (!empty($cmshdr->cmschMemcompmstFk->mcm_complogo_memcompfiledtlsfk)) {
            $response['awdcompanylogo'] = \common\components\Drive::generateUrl($cmshdr->cmschMemcompmstFk->mcm_complogo_memcompfiledtlsfk, $cmshdr->cmschMemcompmstFk->MemberCompMst_Pk, $cmshdr->cmsch_createdby);
        } else {
            $response['awdcompanylogo'] = null;
        }
        $dataName = \common\components\Security::encrypt($invoice->mcid_invoicepath);
        $compPK = \common\components\Security::encrypt($invoice->mcid_membercompmst_fk);
        $downloadLink = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
        $response['invoiceLink'] = $downloadLink;
        $payment_details = Common::getPaymentAmounts($invoice->mcid_invoiceamount, $invoice->mcid_vatpercent, $invoice->mcid_vatamount, $origin);
        $targetAmount = Common::getTargetAmount($cmshdr->cmsch_contractvalue, $origin);
        $response['contractvalue'] = $targetAmount;
        $response['omramount'] = $payment_details['omramount'];
        $response['vat_percent'] = $payment_details['vat_percent'];
        $response['vat_amount'] = $payment_details['vat_amount'];
        $response['processing_fee'] = $payment_details['processing_fee'];
        $response['processing_fee_amt'] = $payment_details['processing_fee_amt'];
        $response['processing_fee_international'] = $payment_details['processing_fee_international'];
        $response['totalamount_international'] = $payment_details['totalamount_international'];
        $response['totalamount_wo_processingfee'] = $payment_details['totalamount_wo_processingfee'];
        $response['totalamount'] = $payment_details['totalamount'];
        $payInfo = \common\models\MemcomppymtinfodtlsTbl::getPaymentinvStatus($invoice->memcompinvoicedtls_pk);
        $response['payStatus'] = !empty($payInfo) ? $payInfo->mcpid_pymtstatus : '';
        $response['payConfirm'] = !empty($payInfo) ? $payInfo->mcpid_pymtconfirmation : '';
        $response['payType'] = !empty($payInfo) ? (($payInfo->mcpid_paymenttype == 1) ? 'offline' : 'online') : '';
		$response['cardType'] = !empty($payInfo->mcpid_cardtype) ? $payInfo->mcpid_cardtype : '';
		$response['transID'] = !empty($payInfo->mcpid_transuniqueid) ? $payInfo->mcpid_transuniqueid : '';
		$response['payTranscDate'] = !empty($payInfo->mcpid_transdate) ? date('d-m-Y', strtotime($payInfo->mcpid_transdate)) : '';
		$response['payTranscRefNo'] = $payInfo->mcpid_transrefno;
                $response['proofdoc'] = \common\components\Drive::generateUrl($payInfo->mcpid_pymtproof,$response['companyPk'],$regpk);
                $response['filetype'] = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($payInfo->mcpid_pymtproof);
        if($payInfo->mcpid_paymenttype == 1) {
            $response['payMode'] = $payInfo->mcpid_pymtmode;
            $response['payBankName'] = $payInfo->mcpid_bankname;
            $response['payCurrency'] = $payInfo->mcpid_currency;
            $response['payAmount'] = $payInfo->mcpid_amount;
        }
        $response['payTransNo'] = !empty($payInfo) ? $payInfo->mcpid_transrefno : '';
        $response['payComments'] = !empty($payInfo) ? $payInfo->mcpid_apprcomments : '';
        foreach($data->user as $key => $val){
            if($val->um_pymtcontact == 1){
                $paymentUser = $val;
                break;
            }
        }        
        foreach($data->user as $key => $val){
            if($userType == 'A' && $val->um_primarycontact == 1){
                $primaryUser = $val;
                break;
            }
            if($userType == 'U' && $val->UserMst_Pk == $userPk){
                $primaryUser = $val;
                break;
            }
        }
        $response['paymentContact']['pk'] = $paymentUser->UserMst_Pk;
        $response['paymentContact']['firstname'] = $paymentUser->um_firstname;
        $response['paymentContact']['lastname'] = $paymentUser->um_lastname;
        $response['paymentContact']['empID'] = $paymentUser->UM_EmpId;
        $response['paymentContact']['emailid'] = $paymentUser->UM_EmailID;
        $response['paymentContact']['department'] = $paymentUser->department->DM_Name;
        $response['paymentContact']['designation'] = $paymentUser->designation->dsg_designationname;
        $response['paymentContact']['mobileno'] = $paymentUser->um_primobno;
        $response['paymentContact']['landlineno'] = $paymentUser->um_landlineno;
        $response['paymentContact']['mobileDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_primobnocc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_landlinecc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineext'] = $paymentUser->um_landlineext;
        $response['primaryContact']['pk'] = $primaryUser->UserMst_Pk;
        $response['primaryContact']['firstname'] = $primaryUser->um_firstname;
        $response['primaryContact']['lastname'] = $primaryUser->um_lastname;
        $response['primaryContact']['empID'] = $primaryUser->UM_EmpId;
        $response['primaryContact']['emailid'] = $primaryUser->UM_EmailID;
        $response['primaryContact']['usertype'] = $primaryUser->UM_Type;
        if($userType == 'A'){
            $response['logo'] = !empty($data->company->mcm_complogo_memcompfiledtlsfk)? \common\components\Drive::generateUrl($data->company->mcm_complogo_memcompfiledtlsfk, $data->company->MemberCompMst_Pk, $primaryUser->UserMst_Pk): null;
        } else {
            $response['logo'] = !empty($primaryUser->um_userdp)? \common\components\Drive::generateUrl($primaryUser->um_userdp, $data->company->MemberCompMst_Pk, $primaryUser->UserMst_Pk): null;
        }
        return $response;
    }

    public static function getPaymentDetail($regpk) {
        
        $userType = \yii\db\ActiveRecord::getTokenData('user_type', true);
        $data = MemberregistrationmstTbl::findOne($regpk);
        
        
        $renewaltemp= \app\common\models\MemcomprewtempTbl::find()->where("mcrt_membercompmst_fk=:compk",[':compk'=>$data->company->MemberCompMst_Pk])->one();
        $response['companyPk'] = $data->company->MemberCompMst_Pk;
        $response['companyName'] = $data->company->MCM_CompanyName;
        $response['countryName'] = $data->company->country->CyM_CountryName_en;
        if(!empty($renewaltemp)){
        $response['renewalstatus'] = $data->MRM_RenewalStatus;
        }else{
        $response['renewalstatus'] = $data->MRM_RenewalStatus;    
        }
        $response['countryPk'] = $data->company->country->CountryMst_Pk; 
        $response['origin'] = ($data->company->MCM_Origin == 'I') ? 'INTERNATIONAL' : 'NATIONAL';
        $response['stakeholderType'] = $data->mrm_stkholdertypmst_fk;
        $response['crregno'] = $data->company->MCM_crnumber;
        $response['regno'] = $data->company->mcm_RegistrationNo;
        $response['graceexp'] = self::isRenewalDateNearing($regpk);
        $response['dateofreg'] = !empty($data->company->MCM_RegistrationYear) ? date('d-m-Y',strtotime($data->company->MCM_RegistrationYear)) : 'NIL';
        $response['renewdon'] = !empty($data->MRM_LastRenewedOn) ? date('d-m-Y',strtotime($data->MRM_LastRenewedOn)) : 'NIL';
        $response['expirydate'] = !empty($data->company->mcm_accexpirydate)?date('d-m-Y',strtotime($data->company->mcm_accexpirydate)) : 'NIL';
        $response['exdays'] = self::getRenewaldaysDiff($data->company->mcm_accexpirydate);
        $response['isexpired'] = self::getexpiry($regpk);
        $response['scfformstatus'] = $data->company->suppcertformmembtmpTbls[0]->scfmt_scfstatus;
        $response['website'] = $data->company->MCM_website ?? 'NIL';
        $response['supplierid'] = $data->mrm_supplierid ?? 'NIL';
        $response['classicationPk'] = $data->company->mcm_classificationmst_fk ?? null;
        $response['subscriptionPk'] = $data->mrm_memsubscriptionmst_fk ?? null;
        $response['memberStatus'] = $data->MRM_MemberStatus ?? null;
        $response['registeredOn'] = date('d-m-Y',strtotime($data->MRM_CreatedOn)) ?? null;
        $response['selectedAddnlPackage'] = !empty($data->mrm_additionalpackage) ? array_map("intval", explode(",",$data->mrm_additionalpackage)) : [];
        $response['promoCode'] = $data->mrm_promocodemst_fk ?? null;
        if(!empty($renewaltemp))
        {
        $response['classificationType'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_ClassificationType;
        }else{
         $response['classificationType'] = $data->company->classification->ClM_ClassificationType;   
        }
        $response['paymentModule'] = \common\components\Common::getModuleName($data->company->invoice->mcid_module);
        $response['invoice'] = $data->company->invoice->memcompinvoicedtls_pk;
        $response['invoiceLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadinvoice?&rpk='.Security::encrypt($data->MemberRegMst_Pk).'&cpk='.Security::encrypt($data->company->MemberCompMst_Pk)]);
        $payInfo = \common\models\MemcomppymtinfodtlsTbl::getPaymentinvStatus($data->company->invoice->memcompinvoicedtls_pk);
        $response['payStatus'] = !empty($payInfo) ? $payInfo->mcpid_pymtstatus : '';
        $response['payConfirm'] = !empty($payInfo) ? $payInfo->mcpid_pymtconfirmation : '';
        $response['payType'] = !empty($payInfo) ? (($payInfo->mcpid_paymenttype == 1) ? 'offline' : 'online') : '';
		$response['cardType'] = !empty($payInfo->mcpid_cardtype) ? $payInfo->mcpid_cardtype : '';
		$response['transID'] = !empty($payInfo->mcpid_transuniqueid) ? $payInfo->mcpid_transuniqueid : '';
		$response['payTranscDate'] = !empty($payInfo->mcpid_transdate) ? date('d-m-Y', strtotime($payInfo->mcpid_transdate)) : '';
		$response['payTranscRefNo'] = $payInfo->mcpid_transrefno;
                $response['proofdoc'] = \common\components\Drive::generateUrl($payInfo->mcpid_pymtproof,$response['companyPk'],$regpk);
                $response['filetype'] = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($payInfo->mcpid_pymtproof);
        if($payInfo->mcpid_paymenttype == 1) {
            $response['payMode'] = $payInfo->mcpid_pymtmode;
            $response['payBankName'] = $payInfo->mcpid_bankname;
            $response['payCurrency'] = $payInfo->mcpid_currency;
            $response['payAmount'] = $payInfo->mcpid_amount;
        }
        $response['payTransNo'] = !empty($payInfo) ? $payInfo->mcpid_transrefno : '';
        if($data->MRM_RenewalStatus=='D' && $payInfo->mcpid_pymtstatus!=4){
            $paymentdcinfo= \common\models\MemcomppymtinfodtlsTbl::find()->where("mcpid_membercompmst_fk=:compk and mcpid_pymtstatus=:pymt_status",[':compk'=>$data->company->MemberCompMst_Pk, ':pymt_status'=>4])->orderBy('memcomppymtinfodtls_pk desc')->one();
            $response['payComments'] = $paymentdcinfo->mcpid_apprcomments;
        }else{
            $response['payComments'] = !empty($payInfo) ? $payInfo->mcpid_apprcomments : '';
        }
        $response['primaryContact'] = [];
        
        foreach($data->user as $key => $val){
            if($val->um_pymtcontact == 1){
                $paymentUser = $val;
                break;
            }
        }
        foreach($data->user as $key => $val){
            if($userType == 'A' && $val->um_primarycontact == 1){
                $primaryUser = $val;
                break;
            }
            if($userType == 'U' && $val->UserMst_Pk == $userPk){
                $primaryUser = $val;
                break;
            }
        }
        
        if($userType == 'A'){
            $response['logo'] = !empty($data->company->mcm_complogo_memcompfiledtlsfk)? \common\components\Drive::generateUrl($data->company->mcm_complogo_memcompfiledtlsfk, $data->company->MemberCompMst_Pk, $primaryUser->UserMst_Pk): null;
        } else {
            $response['logo'] = !empty($primaryUser->um_userdp)? \common\components\Drive::generateUrl($primaryUser->um_userdp, $data->company->MemberCompMst_Pk, $primaryUser->UserMst_Pk): null;
        }
        $response['emailPref'] = \common\models\UsermstTbl::getEmailPref($primaryUser->UserMst_Pk) ?? [];
        $response['securityQuestions'] = \common\models\SecurityquestmstTbl::getSecurityQuestions() ?? [];
        $response['alreadySelectedQA'] = \common\models\UsersecurityqstdtlsTbl::getSecurityQandA($primaryUser->UserMst_Pk) ?? [];
        
        if($response['origin'] == 'INTERNATIONAL') {
            $response['packageDtl'] = $response['subscription'] = $response['additionalpackage'] = [];
        if(!empty($renewaltemp))
        {
            $response['packageDtl'] = AfterLogin::getInternationalPackageDtl($renewaltemp->mcrtMemsubsbyclassifFk->classification, $data->company->MemberCompMst_Pk);
        }else{
            $response['packageDtl'] = AfterLogin::getInternationalPackageDtl($data->company->classification, $data->company->MemberCompMst_Pk);
        }
        }
        
        if(!empty($response['classicationPk']) && !empty($response['subscriptionPk']) && $response['origin'] != 'INTERNATIONAL'){
        if(!empty($renewaltemp))
        {
            $req['headCount'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_HeadCount ?? null;
            $req['annualSales'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_AnnualSales ?? null;
            $req['stktype'] = $response['stakeholderType'];
            $response['packageDtl'] = AfterLogin::getClassificationPackage($req, $data->company->MemberCompMst_Pk);
            $response['headCount'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_HeadCount ?? 'N/A';
            $response['annualSales'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_AnnualSales ?? 'N/A';
        }else{
            $req['headCount'] = $data->company->classification->ClM_HeadCount ?? null;
            $req['annualSales'] = $data->company->classification->ClM_AnnualSales ?? null;
            $req['stktype'] = $response['stakeholderType'];
            $response['packageDtl'] = AfterLogin::getClassificationPackage($req, $data->company->MemberCompMst_Pk);
            $response['headCount'] = $data->company->classification->ClM_HeadCount ?? 'N/A';
            $response['annualSales'] = $data->company->classification->ClM_AnnualSales ?? 'N/A';
        }
        }
        
        $response['paymentContact']['pk'] = $paymentUser->UserMst_Pk;
        $response['paymentContact']['firstname'] = $paymentUser->um_firstname;
        $response['paymentContact']['lastname'] = $paymentUser->um_lastname;
        $response['paymentContact']['empID'] = $paymentUser->UM_EmpId;
        $response['paymentContact']['emailid'] = $paymentUser->UM_EmailID;
        $response['paymentContact']['department'] = $paymentUser->department->DM_Name;
        $response['paymentContact']['designation'] = $paymentUser->designation->dsg_designationname;
        $response['paymentContact']['mobileno'] = $paymentUser->um_primobno;
        $response['paymentContact']['landlineno'] = $paymentUser->um_landlineno;
        $response['paymentContact']['mobileDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_primobnocc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_landlinecc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineext'] = $paymentUser->um_landlineext;
        $response['primaryContact']['pk'] = $primaryUser->UserMst_Pk;
        $response['primaryContact']['firstname'] = $primaryUser->um_firstname;
        $response['primaryContact']['lastname'] = $primaryUser->um_lastname;
        $response['primaryContact']['empID'] = $primaryUser->UM_EmpId;
        $response['primaryContact']['emailid'] = $primaryUser->UM_EmailID;
        $response['primaryContact']['usertype'] = $primaryUser->UM_Type;
        return $response;
    }
    public static function getonlinepayment($amount,$origin = null)
    {
        $totalamount=$amount;
        $amt=$amount;
        $amt *= 1000;
        $sub_amount = $amt;
        
        $origin = !empty($origin) ? $origin : \yii\db\ActiveRecord::getTokenData('MCM_Origin', true);
        if ( $origin == 'I') {
            $amt = $amt / 1000;
            $OMR = 2.60080;
            $amt /= $OMR;
            $percent = ($amt / 100) * 2.31;
            $percent = $percent * $OMR;
            $sub_amount = $sub_amount;
            $total = ($totalamount + $percent);
            $total = $total / 2.60080;
            $total = round($total, 2, PHP_ROUND_HALF_UP);
            $total = $total * 1000; 
            return  number_format($total/1000,2);
        } else {
            $vat = ($amt/100)*\Yii::$app->params['vatpercentage'];
            $percent = ($amt / 100) * 2.31;
            $percent = self::round_up($percent, -1);
            $sub_amount = $sub_amount;
            $total = $sub_amount + $percent + $vat;
            $total = round((float)$total);
            return  number_format($total/1000,3);
        }
    }
    
    
    
    public static function round_up ($value, $precision)
    {
        $pow = pow (10, $precision );
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
    }
    
    public function externalLimit($string,$size)
    {
        if(strlen($string) > $size)
        {
            $string=substr($string,0,$size);
        }
        return $string;
    }
    
    public static function getomrbyusd($usd) {
        //0.38449707782221 in acounts details controller $total = $total(1) / 2.60080 omr value
        return $omr = number_format($usd*1/2.60080,3);//both are work as same (round up)
    }
    
    public function paymentprocess($data) {
        
        
        $paydata = explode('|', $data);
        $cardType = $paydata[0];
        $amount = $paydata[1];
        $referenceno = $paydata[2];
        $merchant_defined_data1 = $paydata[3];
        $companyName = $paydata[4];
        $bill_to_surname = $paydata[5];
        $consumer_id = $paydata[6];
        $bill_to_email = $paydata[7];
        $bill_to_phone = $paydata[8];
        $bill_to_address_city = $paydata[9];
        $bill_to_address_country=$paydata[10];
        $address = $paydata[11];
        $bill_to_address_postal_code = $paydata[12];
        $suppliercode = $paydata[13];
        $userid = $paydata[14];
        $paymenttoken = $paydata[15];
        $payurl = $paydata[16];
        $bill_to_name = $paydata[17];
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $MandateValid = TRUE;
        $Labale = '';
        if (empty($cardType)) {
            $Labale.=" Error: $cardType Card Type should not be null value, [Cardtype] \r\n";
            $MandateValid = FALSE;
        }
        if (!in_array($cardType, mstcardType)) {
            $Labale.=" Error: $cardType In Valid Cardtype \r\n";
            $MandateValid = FALSE;
        }
        if (empty($amount)) {
            $Labale.=" Error: $amount Amount should not be empty \r\n";
            $MandateValid = FALSE;
        }
        
        if (empty($referenceno)) {
            $Labale.=" Error: $referenceno referenceno should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($merchant_defined_data1)) {
            $Labale.=" Error: $merchant_defined_data1 requesttype should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (!in_array($merchant_defined_data1, mstrequestType)) {
            $Labale.=" Error: $merchant_defined_data1 In valid requesttype \r\n";
            $MandateValid = FALSE;
        }
        if (empty($companyName)) {
            $Labale.=" Error: $companyName companyname should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($consumer_id)) {
            $Labale.=" Error: $consumer_id companyid PK should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($bill_to_email)) {
            $Labale.=" Error: $bill_to_email commpanyemail should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($bill_to_name)) {
            $Labale.=" Error: $bill_to_name name should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($bill_to_phone)) {
            $Labale.=" Error: $bill_to_phone companyphone should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($bill_to_address_city)) {
            $Labale.=" Error: $bill_to_address_city companycity should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($address)) {
            $Labale.=" Error: $address address should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($bill_to_address_postal_code)) {
            $Labale.=" Error: $bill_to_address_postal_code postalcode should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($suppliercode)) {
            $Labale.=" Error: $suppliercode suppliercode should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($userid)) {
            $Labale.=" Error: $userid userid should not be empty \r\n";
            $MandateValid = FALSE;
        }
        if (empty($paymenttoken)) {
            $Labale.=" Error: $paymenttoken payment token should not be empty. Default value is N \r\n";
            $MandateValid = FALSE;
        }
        if (!in_array($paymenttoken, mstpaymenttoken)) {
            $Labale.=" Error: $paymenttoken In Valid payment token \r\n";
            $MandateValid = FALSE;
        }
        if (in_array($cardType, ['OTO', 'OTC']) && empty($payurl)) {
            $Labale.=" Error: Payment URL in invalid\r\n";
            $MandateValid = FALSE;
        }
        if ($MandateValid) {
            $cardno = '';
            $cardexpiry = '';
            $cardcvv = '';
            $transaction_type = "sale";
            $access_key = \Yii::$app->params['PG']['cybersource']['access_key'];
            $profile_id = \Yii::$app->params['PG']['cybersource']['profile_id'];
            $signed_field_names = \Yii::$app->params['PG']['cybersource']['signed_field_names'];
            $unsigned_field_names = "";
            $signed_date_time = gmdate("Y-m-d\TH:i:s\Z");
            $locale = "en";
            $currency = "OMR";
            
            $bill_to_forename =  $companyName;
            $bill_to_address_line1 = $address;
            $customer_ip_address = \common\components\Common::getIpAddress();
			$bill_to_address_country="OM";
            $payment_method = "card";
            $params = Array("access_key" => $access_key, "profile_id" => $profile_id,"transaction_uuid" => $referenceno, "signed_field_names" => $signed_field_names, "unsigned_field_names" => $unsigned_field_names, "signed_date_time" => $signed_date_time, "locale" => $locale, "transaction_type" => $transaction_type, "reference_number" => $referenceno, "amount" => $amount, "currency" => $currency, "payment_method" => $payment_method, "bill_to_forename" => $bill_to_forename, "bill_to_surname" => $bill_to_surname,"bill_to_email" => $bill_to_email, "bill_to_phone" => $bill_to_phone, "bill_to_address_line1" => $bill_to_address_line1, "bill_to_address_city" => $bill_to_address_city,"bill_to_address_country" => $bill_to_address_country, "bill_to_address_postal_code" => $bill_to_address_postal_code, 'merchant_defined_data1' => $merchant_defined_data1, "consumer_id" => $consumer_id, "customer_ip_address" => $customer_ip_address);
            if($cardType== 'OC') {
                define ('SECRET_KEY', \Yii::$app->params['PG']['cybersource']['SECRET_KEY']);
                //$paymentdetails['onlineorder']='https://secureacceptance.cybersource.com/pay';
                $paymentdetails['onlineorder']='https://testsecureacceptance.cybersource.com/pay';
                $paymentdetails['access_key']=$access_key;
                $paymentdetails['profile_id']=$profile_id;
                $paymentdetails['transaction_uuid']=$referenceno;
                $paymentdetails['signed_field_names']=$signed_field_names;
                $paymentdetails['unsigned_field_names']=$unsigned_field_names;
                $paymentdetails['signed_date_time']=$signed_date_time;
                $paymentdetails['locale']=$locale;
                $paymentdetails['transaction_type']=$transaction_type;
                $paymentdetails['reference_number']=$referenceno;
                $paymentdetails['amount']=$amount;
                $paymentdetails['currency']=$currency;
                $paymentdetails['payment_method']=$payment_method;
                $paymentdetails['bill_to_company_name']=$bill_to_forename;
                $paymentdetails['bill_to_forename']=$bill_to_forename;
                $paymentdetails['bill_to_surname']=$bill_to_surname;
                $paymentdetails['bill_to_email']=$bill_to_email;
                $paymentdetails['bill_to_phone']=$bill_to_phone;
                $paymentdetails['bill_to_address_line1']=$bill_to_address_line1;
                $paymentdetails['bill_to_address_city']=$bill_to_address_city;
                $paymentdetails['bill_to_address_postal_code']=$bill_to_address_postal_code;
                $paymentdetails['merchant_defined_data1']=$merchant_defined_data1;
                $paymentdetails['consumer_id']=$consumer_id;
                $paymentdetails['customer_ip_address']=$customer_ip_address;
                $paymentdetails['signature']= self::sign($params);
                $paymentdetails['cardreference']='OC';
                return $paymentdetails;
                
            } elseif($cardType== 'ODC') {
                try 
                {
                $current = \Yii::$app->params['PG']['omannet']['current']; //current environment
                $resourcePath = \Yii::$app->params['PG']['omannet'][$current]['gateway_resource_path'];
                $aliasName = \Yii::$app->params['PG']['omannet'][$current]['aliasName'];
                $currency = \Yii::$app->params['PG']['omannet'][$current]['tran_currency'];
                $language = \Yii::$app->params['PG']['omannet'][$current]['consumer_language'];
                $action = ($paymenttoken == 'Y') ? \Yii::$app->params['PG']['omannet'][$current]['tran_action'] : \Yii::$app->params['PG']['omannet'][$current]['token_action'];
                $receiptURL = \Yii::$app->params['PG']['omannet'][$current]['merchant_receiptURL'];
                $errorURL = \Yii::$app->params['PG']['omannet'][$current]['merchant_errorURL'];
                $tokenFlag = \Yii::$app->params['PG']['omannet'][$current]['tokenFlag'];
                $pay_config = \Yii::$app->params['PG']['omannet'][\Yii::$app->params['PG']['omannet']['current']];

                require_once($pay_config['javabridge_file_path']);
                $myObj = new Java("com.fss.plugin.iPayPipe");

                $rnd = substr(number_format(time() * rand(),0,'',''),0,10);

                $trackid = $rnd;
                $myObj->setResourcePath(trim($resourcePath));
                $myObj->setKeystorePath(trim($resourcePath));
                $myObj->setAlias(trim($aliasName));
                $myObj->setAction(trim($action));
                $myObj->setCurrency($currency);
                $myObj->setLanguage(trim($language));
                $myObj->setResponseURL(trim($receiptURL));
                $myObj->setErrorURL(trim($errorURL));
                $myObj->setAmt($amount);
                $myObj->setTrackId($trackid);
                if($paymenttoken == 'Y') {
                    $myObj->setTokenFlag($tokenFlag);
                }
                $myObj->setUdf1($cardType);
                $myObj->setUdf2($referenceno);
                $myObj->setUdf3($merchant_defined_data1);
                $myObj->setUdf4($consumer_id);
                $myObj->setUdf5($customer_ip_address);
                if(trim($myObj->performPaymentInitializationHTTP())!=0) 
                {
                  echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
                  return -1;
                }
                else
                {
                  $myObj->getPaymentId().'<br>';
                  $myObj->getPaymentPage().'<br>';
                  $url=$myObj->getWebAddress();
                  $paymentdetails['payurl']=$url;
                  $paymentdetails['cardreference']='ODC';
                  return $paymentdetails;
                }
                }
                catch(Exception $e)
                {	 
                echo 'Exception->' .$e;
                echo 'Message: ' .$e->getFile();
                echo 'Message1 : ' .$e->getCode();
                }
            } elseif($cardType== 'T') {               
                //$comp_pk = \common\components\Security::base64_encrypt_str($consumer_id); // it was not worked
                $comp_pk = \common\components\Security::encrypt($consumer_id);
                $env = \Yii::$app->params['baseurl']['env'];
                if($merchant_defined_data1=='REG' || $merchant_defined_data1=='RENEW'){
                    $success_url = \Yii::$app->params['baseurl'][$env]."afterlogin/paymentsuccesslistview?card_type=T&rt=sc&req_merchant_defined_data1=".$merchant_defined_data1."&id=".$comp_pk;
                    $cancel_url = \Yii::$app->params['baseurl'][$env]."afterlogin/paymentsuccesslistview?card_type=T&rt=cn&req_merchant_defined_data1=".$merchant_defined_data1."&id=".$comp_pk;
                }elseif($merchant_defined_data1=='CMS'){
                    $success_url = \Yii::$app->params['baseurl'][$env]."contract/paymentsubmittedpage?card_type=T&rt=sc&req_merchant_defined_data1=".$merchant_defined_data1."&id=".$comp_pk;
                    $cancel_url = \Yii::$app->params['baseurl'][$env]."contract/paymentsubmittedpage?card_type=T&rt=cn&req_merchant_defined_data1=".$merchant_defined_data1."&id=".$comp_pk;
                }
                $unit_amount = $amount;
                $prod_data[0]['name']=$bill_to_name;
                $prod_data[0]['unit_amount']=$unit_amount*1000;
                $prod_data[0]['quantity']=1;
                $metadata['customer']=$bill_to_forename;
                $metadata['order_id']='10';
                $sess_data['client_reference_id']=$referenceno;
                $sess_data['customer_id']='';
                $sess_data['products']=$prod_data;
                $sess_data['success_url']= $success_url;
                $sess_data['cancel_url']=$cancel_url;
                $sess_data['metadata']=$metadata;
                $s_data = stripslashes(json_encode($sess_data));
                $thawaniPay=new \common\components\Paymentingeration($env);
                $paymenturl= $thawaniPay->createSession($s_data,$merchant_defined_data1);
                $paymentdetails['payurl']=$paymenturl;
                $paymentdetails['cardreference']='T';
                return $paymentdetails;
            } elseif(in_array($cardType, ['OTO', 'OTC'])) {
                $paymentdetails['cardType']=$cardType;
                $paymentdetails['payurl']=$payurl;
                return $paymentdetails;
            } elseif($cardType == 'SP') {
                $current = \Yii::$app->params['PG']['smartpay']['current']; //current environment
                $merchant_id = \Yii::$app->params['PG']['smartpay'][$current]['merchant_id'];
                $redirect_url = \Yii::$app->params['PG']['smartpay'][$current]['redirect_url'];
                $access_code = \Yii::$app->params['PG']['smartpay'][$current]['access_code'];
                $working_key = \Yii::$app->params['PG']['smartpay'][$current]['working_key'];
                $formurl = \Yii::$app->params['PG']['smartpay'][$current]['payment_url'];
                $transaction_uuid = $referenceno;
                
                $sp_arr = [
                            //'tid' => $transaction_uuid,
                            'company_pk' =>$consumer_id,
                            'company_name' =>$companyName,
                            'supplier_code' =>$suppliercode,
                            'user_pk' => $userid,
                            'merchant_id' => $merchant_id,
                            'order_id' => $referenceno,
                            'merchant_id' => $merchant_id,
                            'order_id' => $referenceno,
                            'amount' => $amount,
                            'currency' => $currency, // OMR or USD
                            'redirect_url' => $redirect_url,
                            'cancel_url' => $redirect_url,
                            //'redirect_url' => \Yii::$app->params['baseurl'][$env]."afterlogin/paymentsuccesslistview";
                            //'cancel_url' => \Yii::$app->params['baseurl'][$env]."afterlogin/paymentsuccesslistview;
                            'language' => strtoupper($locale),
                            'billing_name' => $bill_to_forename,
                            'billing_address' => $bill_to_address_line1,
                            'billing_city' => $bill_to_address_city,
                            //'billing_state' => $bill_to_address_state,
                            'billing_zip' => $bill_to_address_postal_code,
                            'billing_country' => $bill_to_address_country,
                            'billing_tel' => $bill_to_phone,
                            'billing_email' => $bill_to_email,
                            'merchant_param1' => $merchant_defined_data1,
                            'merchant_param2' => $cardType,
                            'additional_charges' => "",
                        ];
                
                $merchant_data = \common\components\Paymentingeration::convertDataforSP($sp_arr);
                
                $encrypted_data = self::sp_encrypt($merchant_data,$working_key);
                $response_data['access_code'] = $access_code;
                $response_data['encRequest'] = $encrypted_data;
                $response_data['formurl'] = $formurl;
                $response_data['cardType'] = $cardType;
                
                return $response_data;
            }
        } else {
            $Labale= \common\components\Security::base64_encrypt_str($Labale);
        }
    }

    function sp_encrypt($plainText, $key) {
        $method = "aes-256-gcm";
        $initVector = openssl_random_pseudo_bytes(16);
        $openMode = openssl_encrypt( $plainText, $method, $key, OPENSSL_RAW_DATA, $initVector, $tag);
        return bin2hex( $initVector ).bin2hex( $openMode . $tag );
    }

    function sp_decrypt($encryptedText, $key) {
        $method = 'AES-256-GCM';
        $encryptedText = hex2bin( $encryptedText );
        $iv_len = $tag_length = 16;
        $iv = substr( $encryptedText, 0, $iv_len );
        $tag = substr( $encryptedText, -$tag_length, $iv_len );
        $ciphertext = substr( $encryptedText, $iv_len, -$tag_length );
        
        return openssl_decrypt( $ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv, $tag );
    }


    function hextobin($hexString) 
     { 
            $length = strlen($hexString); 
            $binString="";   
            $count=0; 
            while($count<$length) 
            {       
                $subString =substr($hexString,$count,2);           
                $packedString = pack("H*",$subString); 
                if ($count==0)
                {
                            $binString=$packedString;
                } 

                else 
                {
                            $binString.=$packedString;
                } 

                $count+=2; 
            } 
            return $binString; 
      }
    
    function sign ($params) {
      return self::signData(self::buildDataToSign($params), SECRET_KEY);
    }

    function signData($data, $secretKey) {
        return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
    }

    function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return self::commaSeparate($dataToSign);
    }

    function commaSeparate ($dataToSign) {
        return implode(",",$dataToSign);
    }

    public static function changeClassification($data) {
        $response = [];
        if($data){
            $regPk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
            $compPk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
            $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $regModel = MemberregistrationmstTbl::findOne($regPk);
            //$regModel->mrm_memsubscriptionmst_fk = $data['subscriptionPk'];
            $regModel->MRM_ipaddr = \common\components\Common::getIpAddress();
            $regModel->MRM_browser = "Chrome";

            $compModel = \common\models\MembercompanymstTbl::findOne($compPk);
            if($regModel->MRM_MemberStatus!='A'){
                $compModel->mcm_classificationmst_fk = $data['classificationPk'];
            }            
            //OTTU link status changed to Unused, because of subscription changes
            \Yii::$app->db->createCommand("update pymtplatformdtls_tbl SET ppfd_linkstatus = '3' where ppfd_membercompmst_fk = '{$compPk}' and ppfd_linkstatus = '1'")->execute();
            $data['origin'] = ($data['origin'] === 'NATIONAL') ? 'N' : 'I';
            $subbyclassifmst = \common\models\MemsubsbyclassifTbl::findOne($data['memsubsbyclassifPk']);
            $updatePaymentDtls = \common\models\MemcomppymtdtlsTbl::saveRegPaymentDtls($data, $subbyclassifmst, $data['origin'], $compPk);
            if(!empty($updatePaymentDtls)){
               if($data['isRenewal'] || $regModel->MRM_MemberStatus=='A')
               { 
                $prev_expdate = $compModel->mcm_accexpirydate;
                $currentdate=date('Y-m-d');
                $companydtls= MemberregistrationmstTbl::fetchCompanyaddressInfo($regPk);
                $paymentdetails= \common\models\UsermstTbl::getpaymentdtls($regPk);
                $primarydetails= \common\models\UsermstTbl::getprimaydtls($regPk);
                $memcomtemp= \app\common\models\MemcomprewtempTbl::find()->where(["mcrt_membercompmst_fk"=>$compPk])->one();
                if(empty($memcomtemp)){
                $memcomtemp=new \app\common\models\MemcomprewtempTbl();
                $memcomtemp->mcrt_status=3;
                }else{
                    if($memcomtemp->mcrt_status==2)
                    {
                       $memcomtemp->mcrt_status=4; 
                    }else{
                        $memcomtemp->mcrt_status=3;
                    }
                }
                $memcomtemp->mcrt_membercompmst_fk=$compPk;
                $memcomtemp->mcrt_memsubsbyclassif_fk=$data['memsubsbyclassifPk'];
                $memcomtemp->mcrt_yrsofsubs=$updatePaymentDtls->MCPD_YrsOfSubs;
                $memcomtemp->mcrt_totalmembershipamt=$updatePaymentDtls->MCPD_TotalMembershipAmt;
                $memcomtemp->mcrt_currencymst_fk=$updatePaymentDtls->MCPD_CurrencyMst_Fk;
                $memcomtemp->mcrt_officialadd=$companydtls['mcmpld_address'];
                $memcomtemp->mcrt_priphonecc=$companydtls['mcmpld_landlinenocc'];
                $memcomtemp->mcrt_phoneno=$companydtls['mcmpld_landlineno'];
                $memcomtemp->mcrt_priphoneext1=$companydtls['mcmpld_landlineext'];
                $memcomtemp->mcrt_website=$companydtls['MCM_Website'];
                $memcomtemp->mcrt_compemail=$companydtls['mcmpld_emailid'];
                $memcomtemp->mcrt_postaladdstatus=$companydtls['mcmpld_ispostaladdr'];
                $memcomtemp->mcrt_name=$primarydetails['um_firstname']." ".$primarydetails['um_lastname'];
                $memcomtemp->mcrt_department=$primarydetails['DM_Name'];
                $memcomtemp->mcrt_designation=$primarydetails['dsg_designationname'];
                $memcomtemp->mcrt_mobcc=$primarydetails['um_primobnocc'];
                $memcomtemp->mcrt_mobile=$primarydetails['um_primobno'];
                $memcomtemp->mcrt_phonecc=$primarydetails['um_landlinecc'];
                $memcomtemp->mcrt_phone=$primarydetails['um_landlineno'];
                $memcomtemp->mcrt_phoneext=$primarydetails['um_landlineext'];
                $memcomtemp->mcrt_email=$primarydetails['UM_EmailID'];
                $memcomtemp->mcrt_pymtusermst_fk=$paymentdetails['UserMst_Pk'];
                $memcomtemp->mcrt_pymtname=$paymentdetails['um_firstname']." ".$paymentdetails['um_lastname'];
                $memcomtemp->mcrt_pymtdepartment=$paymentdetails['DM_Name'];
                $memcomtemp->mcrt_pymtdesignation=$paymentdetails['dsg_designationname'];
                $memcomtemp->mcrt_pymtmobcc=$paymentdetails['um_primobnocc'];
                $memcomtemp->mcrt_pymtmobile=$paymentdetails['um_primobno'];
                $memcomtemp->mcrt_pymtphonecc=$paymentdetails['um_landlinecc'];
                $memcomtemp->mcrt_pymtphone=$paymentdetails['um_landlineno'];
                $memcomtemp->mcrt_pymtphoneext=$paymentdetails['um_landlineext'];
                $memcomtemp->mcrt_pymtemail=$paymentdetails['UM_EmailID'];
                $memcomtemp->mcrt_paymentstatus='N';
                $memcomtemp->mcrt_subfromdate=date("Y-m-d");
                if(\yii\db\ActiveRecord::getTokenData('user_pk', true)=="N")
                {
                $memcomtemp->mcrt_vatpercent=$updatePaymentDtls->mcpd_vatpercent;
                $memcomtemp->mcrt_vatamount=$updatePaymentDtls->mcpd_vatamount;
                }
                $memcomtemp->mcrt_submittedon=date("Y-m-d");
                $memcomtemp->mcrt_submittedby=$userPk;
                if(!$memcomtemp->save()){
                    echo "<pre>";print_r($memcomtemp->getErrors());exit;
                }
                $response['msg'] = 'successs';
                $response['status'] = 1;
                $regModel->save(); 
                $compModel->save();
            } else {
                $regModel->save(); 
                $compModel->save();
                $response['msg'] = 'successs';
                $response['status'] = 1;
            }
            }else{
                $regModel->save(); 
                $compModel->save();
                $response['msg'] = 'successs';
                $response['status'] = 1;
            }
        }else{
                $response['msg'] = 'failure';
                $response['status'] = 0;
        }
        return $response;
    }

    public static function getClassificationDtls() {
        $headCount = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg();
        $annualSales = \api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_AnnualSales');
        $classificationdtl = [];
        $amountdtl = [];
        for($i = 0; $i < count($headCount); $i++) {
            $classificationdtl[$i]['classify'] =  $headCount[$i]['ClM_ClassificationType'];
            $classificationdtl[$i]['headcount'] = (strpos($headCount[$i]['ClM_HeadCount'], 'Employees')) ? $headCount[$i]['ClM_HeadCount']  : $headCount[$i]['ClM_HeadCount'];
            $classificationdtl[$i]['annualsales'] = $annualSales[$i]['ClM_AnnualSales'];
            $classificationdtl[$i]['classify_ar'] =  $headCount[$i]['ClM_ClassificationType_ar'];
            $classificationdtl[$i]['headcount_ar'] = (strpos($headCount[$i]['ClM_HeadCount_ar'], 'Employees')) ? $headCount[$i]['ClM_HeadCount_ar']  : $headCount[$i]['ClM_HeadCount_ar'];
            $classificationdtl[$i]['annualsales_ar'] = $annualSales[$i]['ClM_AnnualSales_ar'];
            $amount = \common\components\Common::getDurationByDays($headCount[$i]['msm_duration'])['Years'];
            $amount = ($amount > 1) ? $amount.' Years' : $amount.' Year';
            $amountdtl[$i]['classify'] = $headCount[$i]['ClM_ClassificationType'];
            $amountdtl[$i]['classify_ar'] = $headCount[$i]['ClM_ClassificationType_ar'];
            $amountdtl[$i]['validity'] = $amount;
            $amountdtl[$i]['amount'] = "OMR ". number_format($headCount[$i]['msm_baseprice'], 3, '.', '');            
            if($headCount[$i]['msm_valtospecify']==1){
                $discount_perc = $headCount[$i]['msm_discountper'];
                $discount_val = $headCount[$i]['msm_discountval'];
                $discounted_price = ($headCount[$i]['msm_baseprice'] - $discount_val);
                $amountdtl[$i]['discounted_amount'] = "OMR ". number_format($discounted_price, 3, '.', '');
                $vat_percent = (($discounted_price * 5) / 100);
                $tot_payamt = $discounted_price + $vat_percent;
                $amountdtl[$i]['total_payable'] = "OMR ". number_format($tot_payamt, 3, '.', '');
            }else{
                $vat_percent = (($headCount[$i]['msm_baseprice'] * 5) / 100);
                $tot_payamt = $headCount[$i]['msm_baseprice'] + $vat_percent;
                $amountdtl[$i]['discounted_amount'] = 'OMR 0.000';
                $amountdtl[$i]['total_payable'] = "OMR ". number_format($tot_payamt, 3, '.', '');
            }            
        }
        $currentenv = Yii::$app->params['baseurl']['env'];
        $url = Yii::$app->params['registerpackurl'][$currentenv];
        $termscond = $url."register/TermsAndConditions";
        return [
            'classification' => $classificationdtl,
            'amount' => $amountdtl,
            'termsandcndurl' => $termscond
        ];
    }
    
    public static function generateInvoice($regPk = null, $compPk = null, $stkholderType = null, $paymentmodule=1) {
        $compPk = $compPk ?? \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $regPk = $regPk ?? \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $stkholderType = $stkholderType ?? \yii\db\ActiveRecord::getTokenData('reg_type', true);
        $data = MemberregistrationmstTbl::findOne($regPk);
        $renewaltemp= \app\common\models\MemcomprewtempTbl::find()->where("mcrt_membercompmst_fk=:compk",[':compk'=>$data->company->MemberCompMst_Pk])->one();
        if(!empty($renewaltemp) && $data->MRM_MemberStatus=='A'){
            $packageBasePrice = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_baseprice;
            $packageBaseCurrencySymbol = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->currency->CurM_CurrSymbol;
        }else{
            $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($data->company->classification);
            
            
            if(strpos($subscriptionDtl->classification->CIM_stkholdertypmst_fk, $stkholderType) !== false ||$subscriptionDtl->classification->ClassificationMst_Pk == 58 ){
                
                
                $packageBasePrice = (int)$subscriptionDtl->subscription->msm_baseprice;
                $packageBaseCurrencySymbol = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
            }
        }
        $format = 2;
        $vatpercent=$vatper=$baseprice=$vatpricefor=0;
        if($packageBaseCurrencySymbol == "OMR"){
            $format = 3;
            $vatper= Yii::$app->params['vatpercentage'];
            $vatpercent = ($vatper / 100);
        }
        if(!empty($packageBasePrice)){
            $baseprice = number_format((float)$packageBasePrice, $format, '.', '');
            $vatprice =  $vatpercent * $packageBasePrice;
            $vatpricefor =  number_format($vatprice, $format);
        }   
        if($data->MRM_MemberStatus=='A'){
            $paymentModule = (!empty($paymentmodule))? $paymentmodule: 2;
        }else{
            $paymentModule = 1;
        }
        $model = new \common\models\MemcompinvoicedtlsTbl();
        $model->mcid_membercompmst_fk = $compPk;
        $model->mcid_invoicestatus = 'G';
        $model->mcid_basemodulemst_fk = 1;
        $model->mcid_module = $paymentModule;
        $model->mcid_performainvoiceno = '';
        $model->mcid_vatpercent = $vatper;
        $model->mcid_vatamount = (string)$vatpricefor;
        $model->mcid_invoiceamount = $baseprice;
        $model->mcid_generatedon = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        if($model->save()){
            $invoice_pk = $model->memcompinvoicedtls_pk;
            $performa_invoice_no = \common\components\common::generateInvoiceNo('INV','PER',$invoice_pk);
            $invoice_name = \common\components\common::getInvoiceName($performa_invoice_no,$model->mcid_generatedon);
            $model->mcid_performainvoiceno = $performa_invoice_no;
            $model->mcid_performainvoicepath = $invoice_name;
            $model->save();
            return $model;
        }else{
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
            return '';
        }
    }
    public static function generateInvoiceCls($regPk = null, $compPk = null, $stkholderType = null, $paymentmodule=1, $cls_amount = 0) {
        $compPk = $compPk ?? \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $regPk = $regPk ?? \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $stkholderType = $stkholderType ?? \yii\db\ActiveRecord::getTokenData('reg_type', true);
        $data = MemberregistrationmstTbl::findOne($regPk);
        $renewaltemp= \app\common\models\MemcomprewtempTbl::find()->where("mcrt_membercompmst_fk=:compk",[':compk'=>$data->company->MemberCompMst_Pk])->one();
        if(!empty($renewaltemp) && $data->MRM_MemberStatus=='A'){
            $packageBasePrice = $cls_amount;
            $packageBaseCurrencySymbol = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->currency->CurM_CurrSymbol;
        }else{
            $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($data->company->classification);
            
            
            if(strpos($subscriptionDtl->classification->CIM_stkholdertypmst_fk, $stkholderType) !== false ||$subscriptionDtl->classification->ClassificationMst_Pk == 58 ){
                
                
                $packageBasePrice = $cls_amount;
                $packageBaseCurrencySymbol = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
            }
        }
        $format = 2;
        $vatpercent=$vatper=$baseprice=$vatpricefor=0;
        if($packageBaseCurrencySymbol == "OMR"){
            $format = 3;
            $vatper= Yii::$app->params['vatpercentage'];
            $vatpercent = ($vatper / 100);
        }
        if(!empty($packageBasePrice)){
            $baseprice = number_format((float)$packageBasePrice, $format, '.', '');
            $vatprice =  $vatpercent * $packageBasePrice;
            $vatpricefor =  number_format($vatprice, $format);
        }   
        if($data->MRM_MemberStatus=='A'){
            $paymentModule = (!empty($paymentmodule))? $paymentmodule: 2;
        }else{
            $paymentModule = 1;
        }
        $model = new \common\models\MemcompinvoicedtlsTbl();
        $model->mcid_membercompmst_fk = $compPk;
        $model->mcid_invoicestatus = 'G';
        $model->mcid_basemodulemst_fk = 1;
        $model->mcid_module = $paymentModule;
        $model->mcid_performainvoiceno = '';
        $model->mcid_vatpercent = $vatper;
        $model->mcid_vatamount = (string)$vatpricefor;
        $model->mcid_invoiceamount = $baseprice;
        $model->mcid_generatedon = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        if($model->save()){
            $invoice_pk = $model->memcompinvoicedtls_pk;
            $performa_invoice_no = \common\components\common::generateInvoiceNo('INV','PER',$invoice_pk);
            $invoice_name = \common\components\common::getInvoiceName($performa_invoice_no,$model->mcid_generatedon);
            $model->mcid_performainvoiceno = $performa_invoice_no;
            $model->mcid_performainvoicepath = $invoice_name;
            $model->save();
            return $model;
        }else{
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
            return '';
        }
    }


    public static function getInvoiceDtls($regPk = null) {
        $regPk = !empty($regPk) ? $regPk : \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $response = [];
        $data = MemberregistrationmstTbl::findOne($regPk);
        $stkholderType = $data->mrm_stkholdertypmst_fk;
        $response['companyName'] = $data->company->MCM_CompanyName;      
        $response['companyNameAr'] = $data->company->MCM_CompanyName_ar;
        $response['countryName'] = $data->company->country->CyM_CountryName_en;
        $response['countryNameAr'] = $data->company->country->CyM_CountryName_ar;
        $response['officenumber'] = $data->company->branchdetails->mcbdt_officenumber;
        $response['floor'] =  $data->company->branchdetails->mcbdt_floor;
        $response['building_name'] =  $data->company->branchdetails->mcbdt_buildingname;
        $response['way_number'] =  $data->company->branchdetails->mcbdt_waynumber;
        $response['street_name'] =  $data->company->branchdetails->mcbdt_streetname;
        $response['town'] =  $data->company->branchdetails->mcbdt_town;
        $response['address'] = $response['officenumber'].", ".$response['floor'].", ".$response['building_name'].", ".$response['way_number'].", ".$response['street_name'].', '.$response['town'];
        $response['state_en'] = $data->company->branchdetails->state->SM_StateName_en;
        $response['state_ar'] = $data->company->branchdetails->state->SM_StateName_ar;
        $response['city'] = $data->company->branchdetails->city->CM_CityName_en;
        $response['countryPk'] = $data->company->country->CountryMst_Pk;
        $response['origin'] = ($data->company->MCM_Origin == 'I') ? 'INTERNATIONAL' : 'NATIONAL';   
        $response['origin_type'] = $data->company->MCM_Origin;   
        $response['regNo'] = $data->MemberRegMst_Pk;
        $response['stakeholderType'] = $data->mrm_stkholdertypmst_fk;
        $response['jsrsvalsubstatus'] = $data->MRM_ValSubStatus;
        $response['memberstatus'] = $data->MRM_MemberStatus;
        $response['crregno'] = $data->company->MCM_crnumber;
        $response['rabtregno'] = $data->company->mcm_RegistrationNo;
        $response['rabtcode'] = $data->company->MCM_SupplierCode;
        $response['vatinno'] = $data->company->additionalinfovat->mcai_certnumber;
        $response['website'] = $data->company->MCM_website ?? 'NIL';
        $response['classicationPk'] = $data->company->mcm_classificationmst_fk ?? null;
        $renewaltemp= \app\common\models\MemcomprewtempTbl::find()->where("mcrt_membercompmst_fk=:compk",[':compk'=>$data->company->MemberCompMst_Pk])->one();
        if(!($renewaltemp))
        {
            $promofk = \common\models\MemcomppymtdtlsTbl::find()->select('mcpd_promocodemst_fk')->where("mcpd_membercompmst_fk=:compk",[':compk'=>$data->company->MemberCompMst_Pk])->one();
            $response['promocodefk'] = $promofk->mcpd_promocodemst_fk;
        }
        
        if(!empty($renewaltemp))
        {
            $response['classicationType'] = $renewaltemp->mcrtMemsubsbyclassifFk->classification->ClM_ClassificationType;
        }else{
            $response['classicationType'] = $data->company->classification->ClM_ClassificationType;   
        }
        $response['subscriptionPk'] = $data->mrm_memsubscriptionmst_fk ?? null;
        $response['invoice'] = $data->company->invoice->memcompinvoicedtls_pk;
        $response['invoiceRefNo'] = $data->company->invoice->mcid_performainvoiceno;
        $response['invoicePath'] = $data->company->invoice->mcid_performainvoicepath;
        $response['taxInvoicePath'] = $data->company->invoice->mcid_invoicepath;
        $response['taxInvoiceRefNo'] = $data->company->invoice->mcid_invoiceno;
        $response['invoiceDate'] = date('d-m-Y',strtotime($data->company->invoice->mcid_generatedon));
        $response['generatedOnDate'] = $data->company->invoice->mcid_generatedon;
        $response['vatPercent'] = $data->company->invoice->mcid_vatpercent;
        $response['vatAmount'] = $data->company->invoice->mcid_vatamount;
        $response['invoiceAmount'] = $data->company->invoice->mcid_invoiceamount;
        $response['invoiceLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/downloadinvoice?id='.Security::encrypt($data->company->invoice->memcompinvoicedtls_pk).'&rpk='.Security::encrypt($data->MemberRegMst_Pk)]);
        
         foreach($data->user as $key => $val){
            if($val->um_pymtcontact == 1){
                $paymentUser = $val;
                break;
            }
        }
        
        if(!empty($data->company->mcm_complogo_memcompfiledtlsfk)){
        $response['companylogo'] =  \common\components\Drive::generateUrl($data->company->mcm_complogo_memcompfiledtlsfk,$data->company->MemberCompMst_Pk,$paymentUser->UserMst_Pk);
        }else{
             $response['companylogo'] = "";
        }
        
        $response['paymentContact']['pk'] = $paymentUser->UserMst_Pk;
        $response['paymentContact']['firstname'] = $paymentUser->um_firstname;
        $response['paymentContact']['middlename'] = $paymentUser->um_middlename;
        $response['paymentContact']['lastname'] = $paymentUser->um_lastname;
        $response['paymentContact']['empID'] = $paymentUser->UM_EmpId;
        $response['paymentContact']['emailid'] = $paymentUser->UM_EmailID;
        $response['paymentContact']['department'] = ($paymentUser->department->DM_Name)?$paymentUser->department->DM_Name:"";
        $response['paymentContact']['designation'] = ($paymentUser->designation->dsg_designationname)?$paymentUser->designation->dsg_designationname:"";
        $response['paymentContact']['mobileno'] = $paymentUser->um_primobno;
        $response['paymentContact']['landlineno'] = $paymentUser->um_landlineno;
        
        $response['paymentContact']['mobileDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_primobnocc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineDialCode'] = CountryMasterQuery::getCountryDtlByPk($paymentUser->um_landlinecc)['CyM_CountryDialCode'];
        $response['paymentContact']['landlineext'] = $paymentUser->um_landlineext;
        
        
        $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($data->company->classification);
        $response['memsubsbyclassifPk'] = $subscriptionDtl->memsubsbyclassif_pk;
        $response['subscription'] = $response['additionalpackage'] = [];
        if(strpos((string)$subscriptionDtl->classification->CIM_stkholdertypmst_fk, (string)$stkholderType) !== false ||$subscriptionDtl->classification->ClassificationMst_Pk == 58 ){
            if(!empty($renewaltemp))
            {
                $response['subscription']['subscriptionPk'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->memsubscriptionmst_pk;
                $response['subscription']['packageDesc'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_packagedesc;
                $response['subscription']['packageName'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_packagename;
                $response['subscription']['duration'] = Common::getDurationByDays($renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_duration);
                $response['subscription']['packageBasePrice'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_baseprice;
                $response['subscription']['packageBaseCurrencyPk'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->msm_basecurrency;
                $response['subscription']['packageBaseCurrencyName'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->currency->CurM_CurrencyName_en;
                $response['subscription']['packageBaseCurrencySymbol'] = $renewaltemp->mcrtMemsubsbyclassifFk->subscription->currency->CurM_CurrSymbol;
            }else{
                $response['subscription']['subscriptionPk'] = $subscriptionDtl->subscription->memsubscriptionmst_pk;
                $response['subscription']['packageDesc'] = $subscriptionDtl->subscription->msm_packagedesc;
                $response['subscription']['packageName'] = $subscriptionDtl->subscription->msm_packagename;
                $response['subscription']['duration'] = Common::getDurationByDays($subscriptionDtl->subscription->msm_duration);
                $response['subscription']['packageBasePrice'] = (int)$subscriptionDtl->subscription->msm_baseprice;
                if($subscriptionDtl->subscription->msm_valtospecify == 1 && strtotime($subscriptionDtl->subscription->msm_valto) > time())
                {
                   $response['subscription']['discountval']= number_format($subscriptionDtl->subscription->msm_discountval , 3);
                   $response['subscription']['discountper']=(int)$subscriptionDtl->subscription->msm_discountper; 
                }
                $response['subscription']['packageBaseCurrencyPk'] = $subscriptionDtl->subscription->msm_basecurrency;
                $response['subscription']['packageBaseCurrencyName'] = $subscriptionDtl->subscription->currency->CurM_CurrencyName_en;
                $response['subscription']['packageBaseCurrencySymbol'] = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
            }            
            foreach ($subscriptionDtl->additionalpackage as $key => $additionalPackage){
                $response['additionalpackage'][$key]['subscriptionPk'] = $additionalPackage->memsubscriptionmst_pk;
                $response['additionalpackage'][$key]['packageName'] = $additionalPackage->msm_packagename;
                $response['additionalpackage'][$key]['packageDesc'] = $additionalPackage->msm_packagedesc;
                $response['additionalpackage'][$key]['duration'] = Common::getDurationByDays($additionalPackage->msm_duration);
                $response['additionalpackage'][$key]['packageBasePrice'] = (int)$additionalPackage->msm_baseprice;
                $response['additionalpackage'][$key]['packageBaseCurrencyPk'] = $additionalPackage->msm_basecurrency;
                $response['additionalpackage'][$key]['packageBaseCurrencyName'] = $additionalPackage->currency->CurM_CurrencyName_en;
                $response['additionalpackage'][$key]['packageBaseCurrencySymbol'] = $additionalPackage->currency->CurM_CurrSymbol;
            }
        }
        return $response;
    }
    
    public static function getInternationalPackageDtl($classification, $compPk) {
        $subscriptionDtl = \common\models\MemsubsbyclassifTbl::getSubscriptionByClassification($classification);
        $response['classificationName'] = $classification->ClM_ClassificationType;
        $response['classicationPk'] = $classification->ClassificationMst_Pk;
        $response['memsubsbyclassifPk'] = $subscriptionDtl->memsubsbyclassif_pk;
        $discount_sts = Yii::$app->params['Discount'];   
        $pymtInfo = \common\models\MemcomppymtdtlsTbl::find()->where(['MCPD_MemberCompMst_Fk' => $compPk])->orderBy(['MemCompPymtDtls_Pk' => SORT_DESC])->one();        
        $discount_percent = $discount_amount = 0.00;
        if(!empty($pymtInfo)){
            $discount_percent = $pymtInfo->mcpd_discpercent;
            $discount_amount = $pymtInfo->mcpd_discountval;
        }
        $response['subscription'] = $response['additionalpackage'] = [];
        $compdtl = \common\models\MembercompanymstTbl::findOne($compPk);
        $stkholderType = $compdtl->register->mrm_stkholdertypmst_fk;
        if(strpos($subscriptionDtl->classification->CIM_stkholdertypmst_fk, $stkholderType) !== false){
            $response['subscription']['subscriptionPk'] = $subscriptionDtl->subscription->memsubscriptionmst_pk;
            $response['subscription']['packageName'] = $subscriptionDtl->subscription->msm_packagename;
            $response['subscription']['packageDesc'] = $subscriptionDtl->subscription->msm_packagedesc;
            $response['subscription']['duration'] = Common::getDurationByDays($subscriptionDtl->subscription->msm_duration);
            $response['subscription']['packageBasePrice'] = number_format((int) $subscriptionDtl->subscription->msm_baseprice, 2, '.', '');
            $response['subscription']['additionalPrice'] = ($response['subscription']['packageBasePrice'] / 100) * 2.31;
            $response['subscription']['additionalPrice'] = number_format(floor($response['subscription']['additionalPrice'] * 100) / 100, 2);
            $response['subscription']['vatprice']='0.00';   
            $response['subscription']['vatrate']=0;  
            $response['subscription']['discount_percent'] = $discount_percent;
		    $response['subscription']['discount_amount'] = number_format((float)$discount_amount, 2);
            if($discount_sts){
                $response['subscription']['totalPrice'] =  number_format(($response['subscription']['packageBasePrice'] + $response['subscription']['additionalPrice']+$response['subscription']['vatprice']) - $discount_amount, 2, '.', '');
                $response['subscription']['offlinetotalPrice'] =  number_format(($response['subscription']['packageBasePrice'] + 25 +$response['subscription']['vatprice']) - $discount_amount, 2, '.', '');
            }else{
                $response['subscription']['totalPrice'] =  number_format($response['subscription']['packageBasePrice'] + $response['subscription']['additionalPrice']+$response['subscription']['vatprice'], 2, '.', '');
                $response['subscription']['offlinetotalPrice'] =  number_format($response['subscription']['packageBasePrice'] + 25 +$response['subscription']['vatprice'], 2, '.', '');
            }            
            $response['subscription']['packageBaseCurrencyPk'] = $subscriptionDtl->subscription->msm_basecurrency;
            $response['subscription']['packageBaseCurrencyName'] = $subscriptionDtl->subscription->currency->CurM_CurrencyName_en;
            $response['subscription']['packageBaseCurrencySymbol'] = $subscriptionDtl->subscription->currency->CurM_CurrSymbol;
        }
        return $response;
    }

    public function invoicepdf()
    {
      

    }

    public static function changePaymentContact($newPk, $existingPk) {
        $existingModel = \common\models\UsermstTbl::findOne($existingPk);
        $existingModel->um_pymtcontact = null;
        $replacedOldPayContact = $existingModel->save();
        
        $newModel = \common\models\UsermstTbl::findOne($newPk);
        $newModel->um_pymtcontact = 1;
        $changedNewPayContact = $newModel->save();
        
        $response['msg'] = 'failure';
        $response['status'] = 0;
        if($replacedOldPayContact && $changedNewPayContact) {
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['dtl'] = self::getPaymentDetail($newModel->UM_MemberRegMst_Fk);
        }
        return $response;
    }
    
    public function isRenewalDateNearing($regPk) {
        $Nearing_expiry = Yii::$app->params['Nearing_expiry'];
        $data = \common\models\MembercompanymstTbl::find()
            ->select(['mcm_accexpirydate'])
            ->where(['MCM_MemberRegMst_Fk' => $regPk])
            ->one();
        if(!empty($data)) {
            $date1 = date_create($data->mcm_accexpirydate);
            $date2 = date_create(date('Y-m-d'));
            $diff = date_diff($date2, $date1);
            $dayDiff = $diff->format("%a");
            if($dayDiff <= $Nearing_expiry) {
                return $data;
            }
            return [];
        }
    }
    public function updatestatusforrenewal($regPk,$memregdet) {
        $Payment_grace_period = Yii::$app->params['Payment_grace_period'];
        $Payment_grace_period_end = Yii::$app->params['Payment_grace_period_end'];
        $Account_deactivation_period = Yii::$app->params['Account_deactivation_period'];
        $Account_inactivation_period = Yii::$app->params['Account_inactivation_period'];
        $Account_inactivation_period_end = Yii::$app->params['Account_inactivation_period_end'];
        $Account_deactivate_from = Yii::$app->params['Account_deactivate_from'];
        $Nearing_expiry = Yii::$app->params['Nearing_expiry'];
         $LastExpiry = \common\models\MembercompanymstTbl::find()
            ->select(['mcm_accexpirydate'])
            ->where(['MCM_MemberRegMst_Fk' => $regPk])
            ->one();
         if(!empty($LastExpiry['mcm_accexpirydate']) && $memregdet['MRM_RenewalStatus']!='ER'){
             /* changing status to 'NE'  Nearing Expiry  => before 1 to 60 days  from  expiry date */
             \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN memcompaccactvnhstry_tbl b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk set a.MRM_RenewalStatus='NE' where a.MemberRegMst_Pk='$regPk' AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','NE') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF('".$LastExpiry['mcm_accexpirydate']."',DATE_ADD(NOW(), INTERVAL -1 DAY)) between 1 and $Nearing_expiry")->execute();
                      /* changing status to 'E'   Expired  */
             \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  memcompaccactvnhstry_tbl b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk set a.MRM_RenewalStatus='E' where a. MemberRegMst_Pk='$regPk' AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','E') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF('".$LastExpiry['mcm_accexpirydate']."',DATE_ADD(NOW(), INTERVAL -1 DAY))<=0")->execute();
               /* changing status to 'I'   In-activated => after  10 to  30 days from expiry date */
            \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  memcompaccactvnhstry_tbl b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='I' where a.MRM_MemberStatus='A' AND c.UM_Status='A' AND a.MemberRegMst_Pk='$regPk' AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','I') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF(NOW(),'".$LastExpiry['mcm_accexpirydate']."') between $Payment_grace_period_end and $Account_inactivation_period ")->execute();
              /* changing status to 'GE'  => after  30 to 180 days  from expiry date */
            \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  memcompaccactvnhstry_tbl b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='GE' where a.MRM_MemberStatus='A' AND c.UM_Status='A' AND a.MemberRegMst_Pk='$regPk' AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','GE') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF(NOW(),'".$LastExpiry['mcm_accexpirydate']."') between $Account_inactivation_period_end and $Account_deactivation_period ")->execute();
               /* changing status to 'GE' and membersatus to 'I' - Deactivating account => after  180 th day from expiry date */
            \Yii::$app->db->createCommand("update memberregistrationmst_tbl a INNER JOIN  memcompaccactvnhstry_tbl b on a.MemberRegMst_Pk=b.mcaah_memberregmst_fk INNER JOIN usermst_tbl c on a.MemberRegMst_Pk=c.UM_MemberRegMst_Fk set a.MRM_RenewalStatus='GE', a.MRM_MemberStatus='I' where a.MRM_MemberStatus='A' AND c.UM_Status='A' AND a.MemberRegMst_Pk='$regPk' AND (a.MRM_RenewalStatus NOT IN('RW','C','D','A','RS','GE') or a.MRM_RenewalStatus is NULL)  AND DATEDIFF(NOW(),'".$LastExpiry['mcm_accexpirydate']."') >=  $Account_deactivate_from ")->execute();
                  /* New supplier who has registered but payment not done till 180 th days then those supplier will be deactivated */
              \Yii::$app->db->createCommand("update memberregistrationmst_tbl a join usermst_tbl b on a.MemberRegMst_Pk = b.UM_MemberRegMst_Fk SET MRM_MemberStatus = 'I', UM_Status = 'I', MRM_OrderConfrmStat = NULL where MRM_MemberStatus = 'V' AND MRM_AFVPStatus not in ('P','RC','RF','D')  AND  DATEDIFF(NOW(), MRM_OrderConfrmOn) >= $Account_deactivation_period")->execute();
         }
    }
    public function isRenewalDatedeactivate($regPk) {
        $data = \common\models\MembercompanymstTbl::find()
            ->select(['mcm_accexpirydate'])
            ->where(['MCM_MemberRegMst_Fk' => $regPk])
            ->one();
        if(!empty($data)) {
            $date1 = date_create($data->mcm_accexpirydate);
            $date2 = date_create(date('Y-m-d'));
            $diff = date_diff($date2, $date1);
            $dayDiff = $diff->format("%a");
            if($dayDiff <= 180) {
                return $data;
            }
            return [];
        }
    }
    
    public function getRenewalMonthsDiff($expiryDate) {
        $date1 = new \DateTime($expiryDate);
        $date2 = new \DateTime(date('Y-m-d'));
        $diff = $date1->diff($date2);
        return (($diff->format('%y') * 12) + $diff->format('%m'));
    }
    public function getRenewaldaysDiff($expiryDate) {  
        $date1 = new \DateTime($expiryDate);
        $date2 = new \DateTime(date('Y-m-d'));
        $diff = $date1->diff($date2);
        return $diff->days;
    }
    public function getRenewalMonthDaysDiff($expiryDate) {  
        $date1 = new \DateTime($expiryDate);
        $date2 = new \DateTime(date('Y-m-d'));
        $diff = $date1->diff($date2);
        return $diff->d;
    }
    
    public function getExpiry($regPk) {
        $expiryDetails = \common\models\MembercompanymstTbl::find()
        ->select(["DATEDIFF(mcm_accexpirydate,NOW()) as daysleft"])
        ->andWhere('MCM_MemberRegMst_Fk=:regpk',array(':regpk' =>  $regPk))
        ->asArray()->one();
        if ($expiryDetails['daysleft']<=0) {
            $result = '1';
        } else {
            $result = '0';
        }


//            }else{
//                $result = 0;
//            }
        //  }else
        //  $result = 0;
        return $result;
    }
    
    public function backchangesubscription($data) {
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $vat_percent = \Yii::$app->params['vatpercentage'];
        $classification_change = $company_change = FALSE;
        $data=$data['subscription'];
        $current_date=date("Y-m-d");
        $compModel = \common\models\MembercompanymstTbl::findOne($data['compk']);
        $companydtls= \common\models\MemberregistrationmstTbl::fetchCompanyaddressInfo($compModel->MCM_MemberRegMst_Fk);
        $sezaddetails =  \common\models\SezadregdtlsTbl::find()
        ->andWhere('srd_memcompmst_fk=:comppk',array(':comppk' =>  $compModel->MemberCompMst_Pk ))
        ->asArray()->one();
        $comppaymentModel = \common\models\MemcomppymtdtlsTbl::find()->where("MCPD_MemberCompMst_Fk=:compk",[':compk'=>$data['compk']])->orderBy('MemCompPymtDtls_Pk desc')->one();
        $complocationModel = \common\models\MemcompmplocationdtlsTbl::find()->where("mcmpld_membercompmst_fk=:compk and mcmpld_locationtype=1",[':compk'=>$data['compk']])->one();
        $usermst = \common\models\UsermstTbl::find()->where("UM_MemberRegMst_Fk={$compModel->MCM_MemberRegMst_Fk} and UM_Type='A'")->one();
        $classification= \api\modules\mst\models\ClassificationmstTbl::findOne($compModel->mcm_classificationmst_fk);
        $supchangehrd= \api\models\SuppchangereqhdrTblQuery::insertable($data,$compModel);
        $compregModel = \common\models\MemberregistrationmstTbl::findone($compModel->MCM_MemberRegMst_Fk);
        if((!empty($data['subcriptionpk']) && $compregModel->mrm_memsubscriptionmst_fk!=$data['subcriptionpk']) || (!empty($data['classificationpk']) && $compModel->mcm_classificationmst_fk!=$data['classificationpk']) && ($comppaymentModel->MCPD_TotalMembershipAmt!=$data['subscriptionfee']))
        {         
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,4,$data,$compregModel,$compModel,$usermst,$classification);
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,3,$data,$compregModel,$compModel,$usermst,$classification);    
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,5,$data,$compregModel,$compModel,$usermst,$classification);    
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,6,$data,$compregModel,$compModel,$usermst,$classification,$comppaymentModel);  
            $memcomtemp = \app\common\models\MemcomprewtempTbl::find()->where(["mcrt_membercompmst_fk"=>$data['compk']])->one();            
            if(!empty($memcomtemp)){
                if($data['subscriptionfee']>0 && $data['subscriptionfee']!=''){
                    $vat_amount = number_format((($data['subscriptionfee'] * $vat_percent) / 100), 2);  
                    //renewal update
                    $memcomtemp->mcrt_memsubsbyclassif_fk = $data['classificationpk'];
                    $memcomtemp->mcrt_totalmembershipamt =$data['subscriptionfee'];
                    $memcomtemp->mcrt_vatamount=$vat_amount;
                    if($memcomtemp->save()){
                        $model_invoice = AfterLogin::generateInvoiceCls($compModel->MCM_MemberRegMst_Fk, $compModel->MemberCompMst_Pk,$compregModel->mrm_stkholdertypmst_fk,5,$data['subscriptionfee']);
                        if($model_invoice)
                        {
                            $requestdata['discountval'] = '';
                            $requestdata['discountper'] = '';
                            $requestdata['prmocodeval'] = '';
                            $subscribePk = Security::base64_encrypt_str($memcomtemp->mcrt_memsubsbyclassif_fk, 'bgiindia');
                            $requestdata['subsbyclassifpk'] = $subscribePk;
                            $requestdata['subscriptionamt'] = $data['amount'];
                            $requestdata['changeinclfncharge'] = $data['subscriptionfee'];
                            $requestdata['totalamount'] = $data['subscriptionfee'] + $vat_amount;
                            $paymenttracker = \common\models\MemcomppymttrackerTbl::saveRegPayTrackDtls($requestdata,$model_invoice,$userPk, $module=2);
                        }
                        //invoice generation
                        $_REQUEST['r'] = $compModel->MCM_MemberRegMst_Fk;
                        \Yii::$app->runAction('al/afterlogin/generateinvoicecls');
                        $pymtusermst = \common\models\UsermstTbl::find()->where("UM_MemberRegMst_Fk={$compModel->MCM_MemberRegMst_Fk} and um_pymtcontact=1")->one();
                        $_data = [
                            'type' => 'paclschangetousermail',
                            'userpk' => $usermst->UserMst_Pk
                        ];
                        $_data1 = [
                            'type' => 'paclschangetoadminmail',
                            'userpk' => $pymtusermst->UserMst_Pk
                        ];
                        self::sendmailtemp($_data);
                        self::sendmailtemp($_data1);
                    }
                }
            }else{
                if($data['subscriptionfee']>0 && $data['subscriptionfee']!=''){
                    $vat_amount = number_format((($data['subscriptionfee'] * $vat_percent) / 100), 2);

                    $companydtls= \common\models\MemberregistrationmstTbl::fetchCompanyaddressInfo($compModel->MCM_MemberRegMst_Fk);
                    $paymentdetails= \common\models\UsermstTbl::getpaymentdtls($compModel->MCM_MemberRegMst_Fk);
                    $primarydetails= \common\models\UsermstTbl::getprimaydtls($compModel->MCM_MemberRegMst_Fk);
                    $memcomtemp=new \app\common\models\MemcomprewtempTbl();
                    $memcomtemp->mcrt_status=3;                
                    $memcomtemp->mcrt_membercompmst_fk=$compModel->MemberCompMst_Pk;
                    $memcomtemp->mcrt_memsubsbyclassif_fk=$data['classificationpk'];
                    $memcomtemp->mcrt_yrsofsubs=$comppaymentModel->MCPD_YrsOfSubs;
                    $memcomtemp->mcrt_totalmembershipamt=$data['subscriptionfee'];
                    $memcomtemp->mcrt_currencymst_fk=$comppaymentModel->MCPD_CurrencyMst_Fk;
                    $memcomtemp->mcrt_officialadd=$companydtls['address'];
                    $memcomtemp->mcrt_priphonecc=$companydtls['um_landlinecc'];
                    $memcomtemp->mcrt_phoneno=$companydtls['um_landlineno'];
                    $memcomtemp->mcrt_priphoneext1=$companydtls['um_landlineext'];
                    $memcomtemp->mcrt_website=$companydtls['MCM_Website'];
                    $memcomtemp->mcrt_compemail=$companydtls['UM_EmailID'];
                    $memcomtemp->mcrt_postaladdstatus='N';
                    $memcomtemp->mcrt_name=$primarydetails['um_firstname']." ".$primarydetails['um_lastname'];
                    $memcomtemp->mcrt_department=$primarydetails['DM_Name'];
                    $memcomtemp->mcrt_designation=$primarydetails['dsg_designationname'];
                    $memcomtemp->mcrt_mobcc=$primarydetails['um_primobnocc'];
                    $memcomtemp->mcrt_mobile=$primarydetails['um_primobno'];
                    $memcomtemp->mcrt_phonecc=$primarydetails['um_landlinecc'];
                    $memcomtemp->mcrt_phone=$primarydetails['um_landlineno'];
                    $memcomtemp->mcrt_phoneext=$primarydetails['um_landlineext'];
                    $memcomtemp->mcrt_email=$primarydetails['UM_EmailID'];
                    $memcomtemp->mcrt_pymtusermst_fk=$paymentdetails['UserMst_Pk'];
                    $memcomtemp->mcrt_pymtname=$paymentdetails['um_firstname']." ".$paymentdetails['um_lastname'];
                    $memcomtemp->mcrt_pymtdepartment=$paymentdetails['DM_Name'];
                    $memcomtemp->mcrt_pymtdesignation=$paymentdetails['dsg_designationname'];
                    $memcomtemp->mcrt_pymtmobcc=$paymentdetails['um_primobnocc'];
                    $memcomtemp->mcrt_pymtmobile=$paymentdetails['um_primobno'];
                    $memcomtemp->mcrt_pymtphonecc=$paymentdetails['um_landlinecc'];
                    $memcomtemp->mcrt_pymtphone=$paymentdetails['um_landlineno'];
                    $memcomtemp->mcrt_pymtphoneext=$paymentdetails['um_landlineext'];
                    $memcomtemp->mcrt_pymtemail=$paymentdetails['UM_EmailID'];
                    $memcomtemp->mcrt_paymentstatus='N';
                    $memcomtemp->mcrt_subfromdate=date("Y-m-d");
                    $memcomtemp->mcrt_vatpercent=$vat_percent;
                    $memcomtemp->mcrt_vatamount=$vat_amount;
                    $memcomtemp->mcrt_submittedon=date("Y-m-d");
                    $memcomtemp->mcrt_submittedby=$userPk;
                    if($memcomtemp->save()){
                        $model_invoice = AfterLogin::generateInvoiceCls($compModel->MCM_MemberRegMst_Fk, $compModel->MemberCompMst_Pk,$compregModel->mrm_stkholdertypmst_fk,5,$data['subscriptionfee']);
                        if($model_invoice)
                        {
                            $requestdata['discountval'] = '';
                            $requestdata['discountper'] = '';
                            $requestdata['prmocodeval'] = '';
                            $subscribePk = Security::base64_encrypt_str($memcomtemp->mcrt_memsubsbyclassif_fk, 'bgiindia');
                            $requestdata['subsbyclassifpk'] = $subscribePk;
                            $requestdata['subscriptionamt'] = $data['amount'];
                            $requestdata['changeinclfncharge'] = $data['subscriptionfee'];
                            $requestdata['totalamount'] = $data['subscriptionfee'] + $vat_amount;
                            $paymenttracker = \common\models\MemcomppymttrackerTbl::saveRegPayTrackDtls($requestdata,$model_invoice,$userPk, $module=2);
                        }
                        //invoice generation
                        $_REQUEST['r'] = $compModel->MCM_MemberRegMst_Fk;
                        \Yii::$app->runAction('al/afterlogin/generateinvoicecls');
                        $_data = [
                            'type' => 'paclschangetousermail',
                            'userpk' => $primarydetails['UserMst_Pk']
                        ];
                        $_data1 = [
                            'type' => 'paclschangetoadminmail',
                            'userpk' => $paymentdetails['UserMst_Pk']
                        ];
                        self::sendmailtemp($_data);
                        self::sendmailtemp($_data1);
                    }else{
                        echo "<pre>";print_r($memcomtemp->getErrors());exit;
                    }
                }else{
                    $compModel->mcm_classificationmst_fk = $data['classificationpk'];
                    $compModel->save();
                }                
            }
        }
        if($compModel->MCM_CompanyName!=$data['companyname'])
        {
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,1,$data,$compregModel,$compModel,$usermst);
            $compModel->MCM_CompanyName=$data['companyname'];
            $compModel->save();
            $form_id = 2;
            if($compregModel->mrm_stkholdertypmst_fk == 6){
                $form_id = 2;
            }elseif($compregModel->mrm_stkholdertypmst_fk == 15){
                $form_id = 1;
            }
            //RABT Certification generation process
            if($compregModel->MRM_MemberStatus  == 'A' && $compregModel->MRM_ValSubStatus == 'A'  && $compModel->mcm_accexpirydate >= $current_date){
                \common\components\Suppcertform::generatecertificate($data['compk'],$form_id);
                self::sendcompanynamechangecertmail($usermst->UserMst_Pk);
            }
        }  
        if($compModel->MCM_Origin=='N' && $compModel->MCM_CompanyName_ar!=$data['companyname_ar'])
        {
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,9,$data,$compregModel,$compModel,$usermst);
            $compModel->MCM_CompanyName_ar=$data['companyname_ar'];
            $compModel->save();
        }
        if(!empty($data['userpk']) && $data['userpk'] != $data['exuserpk'])
        {   
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,7,$data,$compregModel,$compModel,$usermst);
            ApprovalComponents::changeUserAuthorize($data['exuserpk'], $data['userpk']);     
            \common\components\AfterLogin::generatenewprimaryusermail($data['exuserpk'], $data['userpk'], 'paprimaryuserchangemail');//New primary user
            \common\components\AfterLogin::generatenewprimaryusermail($data['exuserpk'], $data['userpk'], 'paexistprimaryusermail');//existing primary user
            $userAccessArr = [];
            foreach ($data['permission'] as $key => $ua) {
                $ua = (object) $ua;
                if(($ua->submodule > 0) && ($ua->type > 0)){
                    $userAccessArr[$ua->submodule] = (isset($userAccessArr[$ua->submodule]) && !empty($userAccessArr[$ua->submodule]))?$userAccessArr[$ua->submodule].','.$ua->type:$ua->type;
                }
            }
            $save['userAccess'] = $userAccessArr;
            \common\models\UserpermtrnTbl::saveUserPerm($save['userAccess'], $data['depart'], $data['exuserpk']);            
        }
        if($usermst->UM_EmailID!=$data['companyemail'] && empty($data['userpk']))
        {
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,2,$data,$compregModel,$compModel,$usermst);
            $usermst->UM_EmailID=$data['companyemail'];
            $usermst->save();         
        }
        if($compregModel->mrm_incorpstylemst_fk!=$data['incorpstyle'] && !empty($data['incorpstyle']))
        {
            \api\models\SuppchangereqdtlsTblQuery::inserttable($supchangehrd,8,$data,$compregModel,$compModel,$usermst);
            $compregModel->mrm_incorpstylemst_fk=$data['incorpstyle'];
            $compregModel->save();         
        }
    }
    public function generatenewprimaryusermail(int $currentAdminUserPk, int $newAdminUserPk, $mailtype='') {
        $_data=[
            'type'=>$mailtype,
            'userpk'=>$currentAdminUserPk,
            'newuserpk'=>$newAdminUserPk
        ];
        self::sendmailtemp($_data);
    }
    public function getuserdtls($userpk)
    {
        $primaryContact = \common\models\UsermstTbl::find()
                    ->select(['UserMst_Pk','UM_MemberRegMst_Fk','um_firstname','um_lastname',
                'UM_Designation','dsg_designationname','um_departmentmst_fk','DM_Name','UM_EmailID',
                'um_primobnocc','um_primobno','um_landlinecc','um_landlineno','um_landlineext','um_userdp'])
                    ->leftJoin('designationmst_tbl','designationmst_pk=UM_Designation')
                    ->leftJoin('departmentmst_tbl','um_departmentmst_fk=DepartmentMst_Pk')
                    ->where(['UserMst_Pk'=>$userpk])
                    ->asArray()->one();
               if($primaryContact['um_primobnocc'] != ''){
                    $primaryMobileCC = ltrim($primaryContact['um_primobnocc'],'0');
                    $primaryContact['um_primobno'] = $primaryMobileCC.' '.$primaryContact['um_primobno'];
                }
                if($primaryContact['um_landlinecc'] != '' && $primaryContact['um_landlineno']!=''){
                    $primaryLandlineCC = ltrim($primaryContact['um_landlinecc'],'0');
                    $landLineExt = ($primaryContact['um_landlineext']) ? '/'.$primaryContact['um_landlineext'] : '';
                    $primaryContact['um_landlineno'] = $primaryLandlineCC.' '.$primaryContact['um_landlineno'].$landLineExt;
                }else{
                    $primaryContact['um_landlineno'] = 'Nil';
                }
                $comdet =  \common\models\MembercompanymstTbl::find()
                    ->select(['MemberCompMst_Pk'])
                    ->where("MCM_MemberRegMst_Fk=:regPk",[':regPk'=>$primaryContact['UM_MemberRegMst_Fk']])->asArray()->one();
                    $compk = $comdet['MemberCompMst_Pk'];
                $primaryUserDp = !empty($primaryContact['um_userdp']) ? \common\components\Drive::generateUrl($primaryContact['um_userdp'], $compk, $primaryContact['UserMst_Pk']) : "assets/images/NoimageJPG.jpg";
                $primaryContactData['userpk']      =   $primaryContact['UserMst_Pk'];
                $primaryContactData['firstName']      =   $primaryContact['um_firstname'];
                $primaryContactData['lastName']       =   $primaryContact['um_lastname'];
                $primaryContactData['emailId']        =   $primaryContact['UM_EmailID'];
                $primaryContactData['mobile']         =   $primaryContact['um_primobno'];
                $primaryContactData['landline']       =   $primaryContact['um_landlineno'];
                $primaryContactData['department']     =   $primaryContact['DM_Name'];
                $primaryContactData['designation']    =   $primaryContact['dsg_designationname'];
                $primaryContactData['um_landlineext'] =   $primaryContact['um_landlineext'];
                $primaryContactData['userdp'] =   $primaryUserDp;
                
                return $primaryContactData;
    }
    public function getexpirydate($regPk)
    {
        $data = \common\models\MembercompanymstTbl::find()
            ->select(['mcm_accexpirydate'])
            ->where(['MCM_MemberRegMst_Fk' => $regPk])
            ->one();
        if(!empty($data))
        {
            return $data['mcm_accexpirydate'];
        }else{
            return false;
        }
    }
    
    public function getoprdetails()
    {
        $data = \common\models\MembercompanymstTbl::find()
            ->select('MemberCompMst_Pk,MemberRegMst_Pk,mcm_complogo_memcompfiledtlsfk')
            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=MCM_MemberRegMst_Fk')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk=mcm_complogo_memcompfiledtlsfk')
            ->where(['mrm_industrytype' => 1,'mrm_stkholdertypmst_fk'=>7])
//            ->where(['mrm_stkholdertypmst_fk'=>7])
            ->asArray()->all();
        foreach ($data as $key => $value) {
            $keayval=$key+1;
          $datval['image'.$keayval]= \common\components\Drive::generateUrl($value['mcm_complogo_memcompfiledtlsfk'],$value['MemberCompMst_Pk'],$value['MemberRegMst_Pk']);
        }
     return $datval;        
    }
    public function revertpayment($data){
        $response = [];
        $result = \common\models\MemcomppymtinfodtlsTbl::find()
            ->where(['mcpid_membercompmst_fk' => $data['compPk']])
            ->orderBy(['memcomppymtinfodtls_pk' => SORT_DESC])
            ->one();
        if(count($result)>0 && !empty($result)){
            $result->mcpid_pymtstatus = 6;
            $result->mcpid_comment = "Payment not received";
            $result->mcpid_submittedon = date('Y-m-d');
            if(!$result->save()){
                echo '<pre>';
                print_r($result->getErrors());
                exit;
            }
            self::sendmailadminpymtinprogress($data);
        }
        $response['msg'] = 'success';
        $response['status'] = 1;
        return $response;
    }
    public function updatepaymentstatus($data){
        $response = [];
        $result = \common\models\MemcomppymtinfodtlsTbl::find()
            ->where(['mcpid_membercompmst_fk' => $data['compPk']])
            ->orderBy(['memcomppymtinfodtls_pk' => SORT_DESC])
            ->one();
        if(count($result)>0 && !empty($result)){
            $result->mcpid_pymtconfirmation = 1;
            if(!$result->save()){
                echo '<pre>';
                print_r($result->getErrors());
                exit;
            }
            self::alreadypaidredirection($data);
        }
        $response['msg'] = 'success';
        $response['status'] = 1;
        return $response;
    }
    public function sendmailadminpymtinprogress($data) {
        //If payment is not debited
        $userPk = $data['userPk'];
        $compPk = $data['compPk'];
        $payModule = $data['payModule'];
        $emailid = 'accounts@businessgateways.com';
        $template_id = 344;
        if($payModule=='1'){ // Registration
            $emailid = 'accounts@businessgateways.com';
            $template_id = 344;
        }elseif($payModule=='2'){ // Renewal
            $emailid = 'jsrsrenewal@businessgateways.com';
            $template_id = 344;
        }elseif($payModule=='3'){ // CMS
            $emailid = 'accounts@businessgateways.com';
            $template_id = 344;
        } 
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $_data=[
            'email'=>$emailid,
            'template_id'=>344,
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
        return true;
    }
    public function alreadypaidredirection($data) {
        //If payment is debited
        $userPk = $data['userPk'];
        $compPk = $data['compPk'];
        $payModule = $data['payModule'];
        $emailid = 'accounts@businessgateways.com';
        $template_id = 305;
        if($payModule=='1'){ // Registration
            $emailid = 'accounts@businessgateways.com';
            $template_id = 305;
        }elseif($payModule=='2'){ // Renewal
            $emailid = 'jsrsrenewal@businessgateways.com';
            $template_id = 305;
        }elseif($payModule=='3'){ // CMS
            $emailid = 'accounts@businessgateways.com';
            $template_id = 305;
        }        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $_data=[
            'email'=>$emailid,
            'template_id'=>$template_id,
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
        return true;
    }
    public function paymentsuccessmail($data) {
        $userPk = $data['userPk'];
        $compPk = $data['compPk'];
        $emailid = 'accounts@businessgateways.com';
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        
        $_data=[
            'email'=>$emailid,
            'template_id'=>297,
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
        return true;
    }
    public function paymentsuccessafterdeclinedmail($data) {
        $userPk = $data['userPk'];
        $compPk = $data['compPk'];
        $emailid = 'accounts@businessgateways.com';
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $_data=[
            'email'=>$emailid,
            'template_id'=>302,
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
        return true;
    }
    public function changeclassificationmailtobackend($userPk) {
        $emailid = 'accounts@businessgateways.com';
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $_data=[
            'email'=>$emailid,
            'template_id'=>298,
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
        return true;
    }
    public function checkforeignclassification($data){
        $compPk = $data['compPk'];
        $response['status'] = 0;
        $classpk = \Yii::$app->params['Register']['classificationPk'];
        $result = \common\models\MembercompanymstTbl::find()
            ->where(['MemberCompMst_Pk' => $compPk])
            ->one();
        if(count($result)>0 && !empty($result)){
            $classfication = $result->mcm_classificationmst_fk;
            if($classpk == $classfication){
                $response['status'] = 1;
            }
        }
        return $response;
    }
    public function checkRenewTemp($comppk){
        $response['status'] = 0;
        $result = \app\common\models\MemcomprewtempTbl::find()
            ->where(['mcrt_membercompmst_fk' => $comppk])
            ->orderBy(['memcomprewtemp_pk' => SORT_DESC])
            ->one();
        if(count($result)>0 && !empty($result)){
            $response['status'] = 1;
        } 
        return $response;  
    }
    public function paymentsuccessafterdeclinedmailrenew($data) {
        //payment success after declined mail for renewal to backend team
        $userPk = $data['userPk'];
        $compPk = $data['compPk'];
        $regPk = $data['regPk'];
        $regInfo = \common\models\MemberregistrationmstTbl::findOne($regPk);
        if($regInfo->MRM_ValSubStatus=='A'){
            $template_id = 396;
            $cert_type = 'Certification';
        }else{
            $template_id = 395;
            $cert_type = 'Subscription';
        }
        $emailid = 'jsrsrenewal@businessgateways.com';
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/send";
        $_data=[
            'email'=>$emailid,
            'template_id'=>$template_id,
            'table_ref_key'=>'UserMst_Pk',
            'table_ref_value'=>$userPk,
            'addi_params'=>['RW_CERT_TYPE'=>$cert_type]
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
        return true;
    }
    public function sendcompanynamechangecertmail(int $currentAdminUserPk){
        $_data = [
            'type' => 'pacertchangemail',
            'userpk' => $currentAdminUserPk
        ];
        self::sendmailtemp($_data);
    }
    public function sendmailtemp($_data){
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
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
        return true;
    }
    public function sendDeactivateMail($userPk) {
        $_data=[
            'type'=>'pastkdeactivatemail',
            'userpk'=>$userPk
        ];
        self::sendmailtemp($_data);
    }
 public static function getclassificationchangepopupdtls(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $regpk = $data['regpk'];
    $compk = $data['compk'];
  $data =[];


  $cominfo =  \api\modules\mst\models\MembercompanymstTbl::find()->where('MemberCompMst_Pk=:memcomppk',[':memcomppk'=>$compk])
                    ->asArray()->one();

        $origin =$cominfo['MCM_Origin'];

                    
     $companyrecond = \api\models\SuppchangereqdtlsTbl::find()->select(['suppchangereqdtls_pk' ,'scrh_memberregmst_fk' ,'scrd_flag' , 'scrd_oldvalue', 'scrd_newvalue', 'c.ClM_ClassificationType as old_name','d.ClM_ClassificationType as new_name', 'e.msm_baseprice', 'e.msm_basecurrency'])
     ->leftJoin('suppchangereqhdr_tbl  b','suppchangereqdtls_tbl.scrd_suppchangereqhdr_fk = b.suppchangereqhdr_pk')
     ->leftJoin('classificationmst_tbl c' , 'suppchangereqdtls_tbl.scrd_oldvalue = c.ClassificationMst_Pk')
     ->leftJoin('classificationmst_tbl d' ,'suppchangereqdtls_tbl.scrd_newvalue = d.ClassificationMst_Pk')
     ->leftJoin('memsubscriptionmst_tbl e' ,' suppchangereqdtls_tbl.scrd_newvalue = e.msm_classificationmst_fk')
    ->where("scrh_memberregmst_fk=:regpk and scrd_flag=:sts",[':regpk'=>$regpk,':sts'=>3])
    ->orderBy(['suppchangereqdtls_tbl.suppchangereqdtls_pk' => SORT_DESC])
    ->asArray()
    ->one();
   
    $payment = \common\models\MemcomppymttrackerTbl::find()
    ->where(['mcpt_membercompmst_fk'=> $compk,'mcpt_module'=>2])
    ->orderBy(['memcomppymttracker_tbl.memcomppymttracker_pk' => SORT_DESC])
    ->asArray()
    ->one();
    $vatpercntage = $payment['mcpt_vatpercent'];
    $charge_amt= $payment['mcpt_changeinclfncharge'];
    $vat_amt =  $charge_amt/100 * $vatpercntage;
    $vat = \Yii::$app->params['vatpercentage'];
   
    
    if($origin == 'N'){
    $addi_process_fee = \Yii::$app->params['additional_processing_charge'];
    $proessingfee_amount = number_format($charge_amt/100 *  $addi_process_fee, 3, '.', '');
    $amtflag = "OMR";
    }else{
        $addi_process_fee = \Yii::$app->params['additional_processing_charge_international'];
        $proessingfee_amount = number_format($charge_amt/100 *  $addi_process_fee, 3, '.', '');  
        $amtflag = "USD";
    }

    $invoicedtls =  AfterLogin::getInvoiceDtls($regpk);
     
  
    $totalamout = $charge_amt +  $vat_amt + $proessingfee_amount;
    $data['chargeamt'] = $charge_amt;
    $data['vatpercentage'] = $vatpercntage;
    $data['vatamount']= $vat_amt;
    $data['additinalrocessfee']=$addi_process_fee;
    $data['addchargeamt']= $proessingfee_amount;
    $data['totalamt']=$totalamout;
    $data['oldname'] = $companyrecond['old_name'];
    $data['newname']= $companyrecond['new_name'];
    $data['invoicelink'] = $invoicedtls['invoiceLink'];
    $data['amtflag'] = $amtflag; 

    return           
         $data;
    
 }
    
}
