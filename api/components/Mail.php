<?php

namespace api\components;

use Yii;
use \common\models\MemberregistrationmstTbl;
use \common\models\MembercompanymstTbl;
use \common\models\UsermstTbl;
use \common\models\MemcompofflineregmstTbl;
use \common\components\Supplier;
use api\components\Security;

class Mail{
    
    public static function getsupplierregmaildtls($userPk) {
        $baseUrl =\Yii::$app->params['baseUrl'];
        $model = \app\models\OpalusermstTbl::find()
                ->select(['oum_firstname as fullName','omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar','oum_emailid as emailid', 'oum_loginId as username',
                'odsg_opaldesignationname as opaldesignationname','omrm_tpname_en as trainingProviderName_en','omrm_tpname_ar as trainingProviderName_ar','omrm_branch_en as centerName','omrm_branch_ar as centerName_ae',
                'omrm_opalmembershipregnumber as opalMembershipRegNumber','oum_mobnocc as oum_mobnocc','oum_mobno as mobileNo','omrm_intendforregistration as intendforregistration','oum_projectmst_fk'])
                ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
                ->leftJoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
                ->where('opalusermst_pk ='.$userPk)
                ->asArray()
                ->one();
        $model['loginLink']= $baseUrl.'admin/login';
        $model['traineeOrTech'] = ($model['intendforregistration'] == 1 ) ? 'Training' : 'Technical';
        $enregpk = Security::encrypt($model['oum_opalmemberregmst_fk']);
        $model['cancellink']  = \Yii::$app->params['baseUrl'].'admin/setpassword?regpk='.$enregpk.'&cancel=true';

        return $model;
        
       
    }
    public static function geteadminuserdata($userPk){
        $baseUrl =\Yii::$app->params['baseUrl'];
        $model = \app\models\OpalusermstTbl::find()
                ->select(['oum_firstname as UserName_en','oum_emailid as emailid'])
                ->where('opalusermst_pk ='.$userPk)
                ->asArray()
                ->one();
        $model['loginLink']= $baseUrl.'admin/login';
        return $model;
    }

    function getpaymentinfo($apppk){

      
            $total=0;
            $data = ApppymtdtlstmpTbl::find()
             ->select(['apppymtdtlstmp_tbl.*','apppytminvoicedtls_tbl.*','applicationdtlstmp_tbl.*',
             'omrm_companyname_en','omrm_companyname_ar','omrm_tpname_en','omrm_tpname_ar',
             'appiit_officetype','omrm_cmplogo','appiit_branchname_en','appiit_branchname_ar'])
             ->leftJoin('apppytminvoicedtls_tbl','apppytminvoicedtls_pk = apppdt_apppytminvoicedtls_fk')
             ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = apppdt_applicationdtlstmp_fk')
             ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
             ->leftJoin('appinstinfotmp_tbl','applicationdtlstmp_pk = appiit_applicationdtlstmp_fk')
             ->where('apppdt_applicationdtlstmp_fk = '.$apppk)
             ->orderBy(['apppymtdtlstmp_pk' => SORT_DESC])
             ->asArray()->one();
            if($data['appdt_projectmst_fk']==1){
                $total =$data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs'];        
            }else{
                $total =$data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs']+$data['apppdt_staffevafee'];    
            }
             if($data['apppdt_currency']==1){
                $total = number_format($total,3, '.', '');
                $data['apppdt_amount'] = number_format($data['apppdt_amount'],3, '.', '');
                $data['apid_staffevalfee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],3, '.', ''): '0';
                $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],3, '.', '');
             }else{
                $total = number_format($total,2, '.', '');
                $data['apppdt_amount'] = number_format($data['apppdt_amount'],2, '.', '');
                $data['apid_staffevalfee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],2, '.', ''): '0';
                $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],2, '.', '');
             }
             $data['total_amount'] = $total;   
            
            return $data;
        
    }

    public static function learnersFeedback($learnerPK,$status,$batchpk){
        $baseUrl =\Yii::$app->params['baseUrl'];
        $link =  $baseUrl."learnerfeedback/LearnerfeedbackComponent/".$learnerPK;
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' =>$learnerPK])->one();
        $staffinfo = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk'=>$learner_update->lrhd_staffinforepo_fk])->one();
        $learnermaster  = \app\models\LearnerasmthdrTbl::find()
        ->where(['lasmth_LearnerRegHrdDtls_FK'=>$learner_update->learnerreghrddtls_pk])->asArray()->all();
        $Kpass='';
        $ppass='';
        if($status=='F'){
            if(count($learnermaster)==2){
                $kassessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnermaster[0]['lasmth_Status']])->one();
                $passessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnermaster[1]['lasmth_Status']])->one();
          
               $Kpass = $kassessmentstatus->rm_name_en;
               $ppass = $passessmentstatus->rm_name_en;
            }
        } 
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
        $batchType = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' =>$batch['bmd_batchtype']])->one();
        $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
        $course = \app\models\CoursecategorymstTbl::find()->where(['coursecategorymst_pk' => $standardcourse->scd_subcoursecategorymst_fk])->one();
       
        $subtitle = $course->ccm_catname_en;
        //assesssment center name

        $assessor = \app\models\BatchmgmtasmtdtlsTbl::find() 
        ->select(['omrm_companyname_en','omrm_companyname_ar'])
        ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
        ->leftJoin('opalusermst_tbl','bmah_assessor = opalusermst_pk')
        ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->where(['bmad_learnerreghrddtls_fk'=>$learnerPK])
        ->asArray()->all();
       //Training Evaluation Centre
       $trainer = \app\models\ OpalmemberregmstTbl::find()
       ->select(['omrm_tpname_en','omrm_tpname_ar'])
       ->where(['opalmemberregmst_pk' =>$staffinfo->sir_opalmemberregmst_fk])
       ->asArray()->one();
       
       
       
         $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en','asmtm_InternalAsmt',
                  
               
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalcitymst_tbl', 'batchmgmtdtls_tbl.bmd_citymst_fk = opalcitymst_tbl.opalcitymst_pk') 
                ->leftJoin('opalstatemst_tbl', 'batchmgmtdtls_tbl.bmd_statemst_fk = opalstatemst_tbl.opalstatemst_pk')     
                ->leftJoin('assessmentmst_tbl','standardcoursemst_tbl.standardcoursemst_pk = assessmentmst_tbl.asmtm_StandardCourseMst_FK')
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
         
       
        $maildatas =['name_en'=>$staffinfo->sir_name_en,'name_ar'=>$staffinfo->sir_name_ar,'emailId'=>$staffinfo->sir_emailid,
            'batchNo'=>$batch['bmd_Batchno'],'batchType'=>$batchType['rm_name_en'],'link'=>$link,
            'traningEV_en'=>$trainer['omrm_tpname_en'],'traningEV_ar'=>$trainer['omrm_tpname_ar'],
            'assessCentr_en'=>$assessor[0]['omrm_companyname_en'],'assessCentr_ar'=>$assessor[0]['omrm_companyname_ar'],
            'subtitle'=>$subtitle,'kassessmentstatus'=>$Kpass,'passessmentstatus'=> $ppass,'tpname'=>$diffaccessor['omrm_companyname_en'],'assemtyp'=>$diffaccessor['asmtm_InternalAsmt'],'city'=>$diffaccessor['ocim_cityname_en'],'state'=>$diffaccessor['osm_statename_en']];

           
        return $maildatas;
    }
    
    public static function getForgotPassMailDtls($userPk,$mailtype='')
    {
        $otpDurationLogin = \Yii::$app->params['OTP']['login']['expiryduration'];
        $otpDurationSetpw = \Yii::$app->params['OTP']['setpassword']['expiryduration'];
        $otpDurationEmail = \Yii::$app->params['OTP']['emailverify']['expiryduration'];
        $model = \app\models\OpalusermstTbl::find()->select(["oum_firstname as user_name","oum_otpmail as otp","oum_emailid as email",
         ])
               ->Where('opalusermst_pk =:userPk', array(':userPk' => $userPk))
                ->asArray()
                ->one();
        
         if($mailtype == 'login' ){
            $model['duration']=$otpDurationLogin ;
         }elseif($mailtype == 'setpassword'){
            $model['duration']=$otpDurationSetpw;
         }elseif($mailtype == 'emailverify'){
            $model['duration']=$otpDurationEmail;
         }
        $model['loginlink']=\Yii::$app->params['baseUrl']."admin/login";
        return $model;
    }
    public function sendLearnerFeedback($pk,$batchpk,$caseData){
                $baseUrl = \Yii::$app->params['APP_URL'];
                $url = $baseUrl."api/ma/mail/sendmail";
                $_data=[
                    'type' =>$caseData,
                    'userpk'=>$pk,
                    'batchpk'=>$batchpk,
                    // 'data'=>$id,
         
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
      
 public function certificationDtls($apptmpPk,$usercrPk,$regPk,$caseData){
       
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk' => $regPk,
            'usercrPk' => $usercrPk,
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
       
  public function superadmincer($apptmpPk,$regPk,$id,$name,$caseData){
    
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk' => $regPk,
            'id'=>$id,
            'name'=>$name,
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
        
 public function courseDtls($apptmpPk,$regPk,$caseData){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk' => $regPk,
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
        
     public function sprcourseDtls($apptmpPk,$regPk,$id,$name,$caseData){
            
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk' => $regPk,
            'id' => $id,
            'name' => $name,
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
       
     public function learnDtls($batchpk,$staffpk,$caseData){
    
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'staffpk' => $staffpk,
            'batchpk'=> $batchpk,
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
      
        public function accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,$caseData){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'batchpk'=> $batchpk,
            'oldaccesspk'=>$oldaccesspk,
            'newaccesspk'=>$newaccesspk,
            'newivpk'=>$newivpk,
            'oldivpk'=>$oldivpk,
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
    
   public function learnBulk($batchpk,$learnerId,$learnerName,$caseData){
       
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'learnerId' => $learnerId,
            'learnerName' => $learnerName,
            'batchpk' => $batchpk,
            'sirid'=> $sirid,
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
    
    
    public function learnqc($batchpk,$caseData){
       
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'batchpk' => $batchpk,
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
       public function learnaccess($batchpk,$learnerpk,$caseData){
       
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'batchpk' => $batchpk,
            'learnerpk' => $learnerpk,
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

 public static function sprCertifcateDtls($apptmpPk,$regPk,$id,$name){

  
    
    $CertificationDtls = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['*'])
                ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
                ->leftJoin('opalmemberregmst_tbl', 'applicationdtlstmp_tbl.appdt_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->where("FIND_IN_SET(applicationdtlstmp_tbl.applicationdtlstmp_pk, :apptmpPk)")
                ->addParams([':apptmpPk' => $apptmpPk])
                ->asArray()
                ->one();

    $focalpoint = \app\models\OpalusermstTbl::find()
                ->select(['*'])
                ->leftJoin('opaldesignationmst_tbl','opalusermst_tbl.oum_opaldesignationmst_fk = opaldesignationmst_tbl.opaldesignationmst_pk')
                ->where(['oum_isfocalpoint' => 1, 'oum_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->one();
    
    $invoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount','apid_staffevalfee'])
                ->where(['apid_opalmemberregmst_fk' => $regPk , 'apid_feesubscriptionmst_fk' => 1 ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
  
    
     $reinvoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount'])
                ->where(['apid_opalmemberregmst_fk' => $regPk , 'apid_feesubscriptionmst_fk' => 2 ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
   
    $auditinfo = \app\models\AppauditschedtmpTbl::find() 
                ->select(['DATE_FORMAT(asd_date,\'%d-%m-%Y\') as auditdate','asd_date','auditscheddtls_pk','oum_firstname','oum_emailid'])
                ->leftJoin('auditscheddtls_tbl','asd_appauditschedtmp_fk = appauditschedtmp_pk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = asd_opalusermst_fk')
                ->where('appasdt_applicationdtlstmp_fk = :temppk',[ ':temppk' => $apptmpPk])
                ->orderBy(['appauditschedtmp_pk' => SORT_DESC])
                ->asArray()->one();
    
    $declinedBy = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['appdt_appdecby'])
                ->where(['appdt_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->all();
    
    $declineName = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['oum_firstname'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();
    
 
    
     $declinerole = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['rm_rolename_en'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->leftJoin ('rolemst_tbl' , 'opalusermst_tbl.oum_rolemst_fk = rolemst_tbl.rolemst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();

    $invAmount = $invoiceDet[apid_coursecertfee];
    $taxCharge = $invoiceDet[apid_vatamount];
    $totalAmount = $invAmount + $taxCharge ;
    
    $reinvAmount = $reinvoiceDet[apid_coursecertfee];
    $retaxCharge = $reinvoiceDet[apid_vatamount];
    $retotalAmount = $reinvAmount + $retaxCharge;

    
  
    $certiData = [
       'desrwmail'=>$desrwmail['oum_emailid'], 
       'appRefNo'=>$CertificationDtls['appdt_appreferno'],
       'expiryDt'=>$CertificationDtls['appdt_certificateexpiry'],
       'userName'=>$desrwmail['oum_firstname'],
       'companyName'=>$CertificationDtls['omrm_companyname_en'] , 
       'tpname'=>$CertificationDtls['omrm_tpname_en'] ,
       'officetype'=>$CertificationDtls['appiit_officetype'] , 
       'branchName'=>$CertificationDtls['appiit_branchname_en'] ,
       'grade'=>$CertificationDtls['appdt_grademst_fk'] ,
       'focalname'=>$focalpoint['oum_firstname'] , 
       'focaldesign'=>$focalpoint['odsg_opaldesignationname'] ,
       'focalemail'=>$focalpoint['oum_emailid'] , 
       'focalmob'=>$focalpoint['oum_mobno'],
       'comments'=>$CertificationDtls['appdt_appdeccomment'],
       'courAmount'=>$invoiceDet['apid_coursecertfee'],
       'taxAmount'=>$invoiceDet['apid_vatamount'],
       'totalAmount'=>$totalAmount,
       'invoiceNumber'=>$invoiceDet['apid_invoiceno'],
       'recourAmount'=>$reinvoiceDet['apid_coursecertfee'],
       'retaxAmount'=>$reinvoiceDet['apid_vatamount'],
       'retotalAmount'=>$retotalAmount,
       'reinvoiceNumber'=>$reinvoiceDet['apid_invoiceno'],
       'finaName'=>$finance['oum_firstname'],
       'finaEmail'=>$finance['oum_emailid'],
       'siteAuditmail'=>$auditinfo['oum_emailid'],
       'siteAuditName'=>$auditinfo['oum_firstname'],
       'siteAuditDt'=>$auditinfo['auditdate'],
       'declinName' =>$declineName['oum_firstname'],
        'declinerole' => $declinerole['rm_rolename_en'],
       'certificationpath'=>$CertificationDtls['appdt_certificatepath'],
       'pk'=>$CertificationDtls['applicationdtlstmp_pk'],
       'status'=>$CertificationDtls['appdt_status'],
       'apptyp'=>$CertificationDtls['appdt_apptype'],
       'projectpk'=>$CertificationDtls['appdt_projectmst_fk'],
   
     
       ];

    return $certiData;
    

         }

  public static function getCertifcateDtls($apptmpPk,$regPk){

    $CertificationDtls = \app\models\ApplicationdtlstmpTbl::find()
    ->select(['*', 'DATE_FORMAT(DATE_ADD(appdt_certificateexpiry, INTERVAL 1 DAY), "%d-%m-%y") AS nextdayexp'])
    ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
    ->leftJoin('opalmemberregmst_tbl', 'applicationdtlstmp_tbl.appdt_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
    ->where("FIND_IN_SET(applicationdtlstmp_tbl.applicationdtlstmp_pk, :apptmpPk)")
    ->addParams([':apptmpPk' => $apptmpPk])
    ->asArray()
    ->one();

    
  
                    
    $focalpoint = \app\models\OpalusermstTbl::find()
                ->select(['*'])
                ->leftJoin('opaldesignationmst_tbl','opalusermst_tbl.oum_opaldesignationmst_fk = opaldesignationmst_tbl.opaldesignationmst_pk')
                ->where(['oum_isfocalpoint' => 1, 'oum_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->one();
    
    $invoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount','apid_staffevalfee'])
                ->where(['apid_opalmemberregmst_fk' => $regPk , 'apid_feesubscriptionmst_fk' => 1 ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
    
     $reinvoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount'])
                ->where(['apid_opalmemberregmst_fk' => $regPk , 'apid_feesubscriptionmst_fk' => 2 ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
   
    $auditinfo = \app\models\AppauditschedtmpTbl::find()
                ->select(['asd_date','auditscheddtls_pk','oum_firstname','oum_emailid'])
                ->leftJoin('auditscheddtls_tbl','asd_appauditschedtmp_fk = appauditschedtmp_pk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = asd_opalusermst_fk')
                ->where('appasdt_applicationdtlstmp_fk = :temppk',[ ':temppk' => $apptmpPk])
                ->orderBy(['appauditschedtmp_pk' => SORT_DESC])
                ->asArray()->one();
    
    $declinedBy = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['appdt_appdecby'])
                ->where(['appdt_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->all();
    
    $declineName = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['oum_firstname'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();
    
    $declinerole = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['rm_rolename_en'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->leftJoin ('rolemst_tbl' , 'opalusermst_tbl.oum_rolemst_fk = rolemst_tbl.rolemst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();

    $invAmount = $invoiceDet['apid_coursecertfee'];
    $taxCharge = $invoiceDet['apid_vatamount'];
    $totalAmount = $invAmount + $taxCharge ;
    
    $reinvAmount = $reinvoiceDet['apid_coursecertfee'];
    $retaxCharge = $reinvoiceDet['apid_vatamount'];
    $retotalAmount = $reinvAmount + $retaxCharge;

    $certiData = [
       'desrwmail'=>$desrwmail['oum_emailid'], 
       'appRefNo'=>$CertificationDtls['appdt_appreferno'],
       'nextdayexp'=>$CertificationDtls['nextdayexp'],
       'expiryDt'=>$CertificationDtls['appdt_certificateexpiry'],
       'userName'=>$desrwmail['oum_firstname'],
       'companyName'=>$CertificationDtls['omrm_companyname_en'] , 
       'tpname'=>$CertificationDtls['omrm_tpname_en'] ,
       'officetype'=>$CertificationDtls['appiit_officetype'] , 
       'branchName'=>$CertificationDtls['appiit_branchname_en'] ,
       'grade'=>$CertificationDtls['appdt_grademst_fk'] ,
       'focalname'=>$focalpoint['oum_firstname'] , 
       'focaldesign'=>$focalpoint['odsg_opaldesignationname'] ,
       'focalemail'=>$focalpoint['oum_emailid'] , 
       'focalmob'=>$focalpoint['oum_mobno'],
       'comments'=>$CertificationDtls['appdt_appdeccomment'],
       'courAmount'=>$invoiceDet['apid_coursecertfee'],
       'taxAmount'=>$invoiceDet['apid_vatamount'],
       'totalAmount'=>$totalAmount,
       'invoiceNumber'=>$invoiceDet['apid_invoiceno'],
       'recourAmount'=>$reinvoiceDet['apid_coursecertfee'],
       'retaxAmount'=>$reinvoiceDet['apid_vatamount'],
       'retotalAmount'=>$retotalAmount,
       'reinvoiceNumber'=>$reinvoiceDet['apid_invoiceno'],
       'finaName'=>$finance['oum_firstname'],
       'finaEmail'=>$finance['oum_emailid'],
       'siteAuditmail'=>$auditinfo['oum_emailid'],
       'siteAuditName'=>$auditinfo['oum_firstname'],
       'siteAuditDt'=>$auditinfo['asd_date'],
       'declinName' =>$declineName['oum_firstname'],
        'declinerole' => $declinerole['rm_rolename_en'],
       'certificationpath'=>$CertificationDtls['appdt_certificatepath'],
       'pk'=>$CertificationDtls['applicationdtlstmp_pk'],
       'status'=>$CertificationDtls['appdt_status'],
       'apptyp'=>$CertificationDtls['appdt_apptype'],
       'projectpk'=>$CertificationDtls['appdt_projectmst_fk'],
       ];
 
    return $certiData;
    }
    
        
  public static function courseData($apptmpPk,$regPk){
       
    $data = \app\models\ApplicationdtlstmpTbl::find()  
        ->select(['DATE_FORMAT(DATE_ADD(appdt_certificateexpiry, INTERVAL 1 DAY), "%d-%m-%y") AS nextdayexp','appdt_appdeccomment','applicationdtlstmp_pk','appdt_projectmst_fk','appdt_appreferno as applictionno','pm_projectname_en','pm_projectname_ar','projectmst_pk',
        'appiim_officetype','appiim_branchname_en','appiim_branchname_ar','appdt_status','appdt_apptype',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_en end)  as coursename_en',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_ar end)  as coursename_ar',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN cus.ccm_catname_en  END) AS courscat_en',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN  cus.ccm_catname_ar  END) AS courscat_ar',
        'reqfor.rm_name_en as reqfor_en','reqfor.rm_name_ar as  reqfor_ar','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','appdt_status as  applicationstatus',
        '(case when appdt_certificateexpiry is null then "1"    when appdt_certificateexpiry is not null and  appdt_certificateexpiry >= CURDATE() then "2"
        when appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()  then "3"  end) as certification',
        'DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") as  addedon',
        'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") as  lastUpdated','delto.rm_name_en as delto_en','delto.rm_name_ar as delto_ar',
        "ABS(DATEDIFF(CURDATE(), DATE_FORMAT(appdt_certificateexpiry, '%Y-%m-%d'))) as days",'appdt_certificatepath','oum_firstname','omrm_companyname_en','omrm_companyname_ar',
        'omrm_tpname_ar','omrm_tpname_en','odsg_opaldesignationname','oum_emailid','oum_mobnocc','oum_mobno','ocym_countrydialcode','appdt_appdeccomment'])
        ->leftjoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk =  applicationdtlstmp_pk')
        ->leftjoin('projectmst_tbl','projectmst_pk = appdt_projectmst_fk')
        ->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
        ->leftjoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
        ->leftjoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
        ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
        ->leftJoin('referencemst_tbl delto','delto.referencemst_pk = appcdt_deliverto')
        ->leftjoin('coursecategorymst_tbl std','std.coursecategorymst_pk = scm_coursecategorymst_fk')
        ->leftjoin('coursecategorymst_tbl cus','cus.coursecategorymst_pk = appocm_coursecategorymst_fk')
        ->leftjoin('opalusermst_tbl','opalusermst_pk = appdt_submittedby')
        ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
        ->leftjoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
        ->leftjoin('opalcountrymst_tbl','opalcountrymst_pk = oum_mobnocc')
        ->where("applicationdtlstmp_pk =".$apptmpPk ."  and appdt_projectmst_fk in (2,3) and appcdt_appinstinfomain_fk is not null")
        ->orderBy(['appdt_updatedon' => SORT_DESC,'appdt_submittedon' => SORT_DESC])->asArray()->one();
              
    $focalpoint = \app\models\OpalusermstTbl::find()
                ->select(['*'])
                ->leftJoin('opaldesignationmst_tbl','opalusermst_tbl.oum_opaldesignationmst_fk = opaldesignationmst_tbl.opaldesignationmst_pk')
                ->where(['oum_isfocalpoint' => 1, 'oum_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->one();
        
    $invoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount','apid_staffevalfee'])
                ->where(['apid_applicationdtlstmp_fk' => $apptmpPk ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
    
   $reinvoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount'])
                ->where(['apid_applicationdtlstmp_fk' => $apptmpPk ])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
         
    $auditinfo = \app\models\AppauditschedtmpTbl::find()
                ->select(['asd_date','auditscheddtls_pk','oum_firstname','oum_emailid'])
                ->leftJoin('auditscheddtls_tbl','asd_appauditschedtmp_fk = appauditschedtmp_pk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = asd_opalusermst_fk')
                ->where('appasdt_applicationdtlstmp_fk = :temppk',[ ':temppk' => $apptmpPk])
                ->orderBy(['appauditschedtmp_pk' => SORT_DESC])
                ->asArray()->one();
        
    $declinedBy = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['appdt_appdecby'])
                ->where(['appdt_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->all();
       
    $declineName = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['oum_firstname'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();
              
     $declinerole = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['rm_rolename_en'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->leftJoin ('rolemst_tbl' , 'opalusermst_tbl.oum_rolemst_fk = rolemst_tbl.rolemst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();
        
    $invAmount = $invoiceDet[apid_coursecertfee];
    $taxCharge = $invoiceDet[apid_vatamount];
    $stafffee  = $invoiceDet[apid_staffevalfee];
    $crtotalAmount = $invAmount + $stafffee + $taxCharge;
    
    
    $reinvAmount = $reinvoiceDet[apid_coursecertfee];
    $retaxCharge = $reinvoiceDet[apid_vatamount];
    $retotalAmount = $reinvAmount + $retaxCharge;
    
    
    if( $data['projectmst_pk']==2){
        $projectname =  "Standard Course Certificate";
    }elseif($data['projectmst_pk']==3){
         $projectname = "Customised Course Certificate";
    }
    
      if( $data['projectmst_pk']==2){
        $projectnameion =  "Standard Course Certification";
    }elseif($data['projectmst_pk']==3){
         $projectnameion = "Customised Course Certification";
    }

    $courseData = [
        
        'nextdatexp'=> $data['nextdatexp'],
        'companyName'=> $data['omrm_companyname_en'],
        'tpname'=> $data['omrm_tpname_en'],
        'branchname'=> $data['appiim_branchname_en'],
        'coursetitle'=> $data['coursename_en'],
        'coursecategory'=> $data['courscat_en'],
        'requestedfor'=> $data['reqfor_en'],
        'projectpk' => $data['appdt_projectmst_fk'],
        'appno'=>$data['applictionno'],
  
        'projectnameion'=> $projectnameion,
        'officeType'=> $data['appiim_officetype'], 
        'comments'=>$data['appdt_appdeccomment'],
        'focalname'=>$focalpoint['oum_firstname'] , 
       'focaldesign'=>$focalpoint['odsg_opaldesignationname'] ,
       'focalemail'=>$focalpoint['oum_emailid'] , 
       'focalmob'=>$focalpoint['oum_mobno'],   
        'courAmount'=>$invoiceDet['apid_coursecertfee'],
       'taxAmount'=>$invoiceDet['apid_vatamount'],
        'stafffee'=>$invoiceDet['apid_staffevalfee'],
       'crtotalAmount'=>$crtotalAmount,
       'invoiceNumber'=>$invoiceDet['apid_invoiceno'],
       'siteAuditName'=>$auditinfo['oum_firstname'],
       'siteAuditDt'=>$auditinfo['asd_date'],
         'declinName' =>$declineName['oum_firstname'],
        'declinerole' => $declinerole['rm_rolename_en'],
        'id' => $id,
        'name' => $name,
        'pk'=>$data['applicationdtlstmp_pk'],
       'status'=>$data['appdt_status'],
       'apptyp'=>$data['appdt_apptype'],
       'certificationpath'=>$data['appdt_certificatepath'],
       ];




    return $courseData;
    

 }
 
   public static function sprcourseData($apptmpPk,$regPk,$id,$name){

    $data = \app\models\ApplicationdtlstmpTbl::find()  
        ->select(['applicationdtlstmp_pk','appdt_projectmst_fk','appdt_appreferno as applictionno','pm_projectname_en','pm_projectname_ar',
        'appiim_officetype','appiim_branchname_en','appiim_branchname_ar','appdt_status','appdt_apptype','projectmst_pk',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_en end)  as coursename_en',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_ar end)  as coursename_ar',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN cus.ccm_catname_en  END) AS courscat_en',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN  cus.ccm_catname_ar  END) AS courscat_ar',
        'reqfor.rm_name_en as reqfor_en','reqfor.rm_name_ar as  reqfor_ar','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','appdt_status as  applicationstatus',
        '(case when appdt_certificateexpiry is null then "1"    when appdt_certificateexpiry is not null and  appdt_certificateexpiry >= CURDATE() then "2"
        when appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()  then "3"  end) as certification',
        'DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") as  addedon',
        'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") as  lastUpdated','delto.rm_name_en as delto_en','delto.rm_name_ar as delto_ar',
        "ABS(DATEDIFF(CURDATE(), DATE_FORMAT(appdt_certificateexpiry, '%Y-%m-%d'))) as days",'appdt_certificatepath','oum_firstname','omrm_companyname_en','omrm_companyname_ar',
        'omrm_tpname_ar','omrm_tpname_en','odsg_opaldesignationname','oum_emailid','oum_mobnocc','oum_mobno','ocym_countrydialcode','appdt_appdeccomment'])
        ->leftjoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk =  applicationdtlstmp_pk')
        ->leftjoin('projectmst_tbl','projectmst_pk = appdt_projectmst_fk')
        ->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
        ->leftjoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
        ->leftjoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
        ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
        ->leftJoin('referencemst_tbl delto','delto.referencemst_pk = appcdt_deliverto')
        ->leftjoin('coursecategorymst_tbl std','std.coursecategorymst_pk = scm_coursecategorymst_fk')
        ->leftjoin('coursecategorymst_tbl cus','cus.coursecategorymst_pk = appocm_coursecategorymst_fk')
        ->leftjoin('opalusermst_tbl','opalusermst_pk = appdt_submittedby')
        ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
        ->leftjoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
        ->leftjoin('opalcountrymst_tbl','opalcountrymst_pk = oum_mobnocc')
        ->where("applicationdtlstmp_pk =".$apptmpPk ."  and appdt_projectmst_fk in (2,3) and appcdt_appinstinfomain_fk is not null")
        ->orderBy(['appdt_updatedon' => SORT_DESC,'appdt_submittedon' => SORT_DESC])->asArray()->one();
               
    $focalpoint = \app\models\OpalusermstTbl::find()
                ->select(['*'])
                ->leftJoin('opaldesignationmst_tbl','opalusermst_tbl.oum_opaldesignationmst_fk = opaldesignationmst_tbl.opaldesignationmst_pk')
                ->where(['oum_isfocalpoint' => 1, 'oum_opalmemberregmst_fk' => $regPk])
                ->asArray()
                ->one();
    
    $invoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount','apid_staffevalfee'])
                
                ->where(['apid_applicationdtlstmp_fk' => $apptmpPk])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
    
   $reinvoiceDet = \app\models\ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apid_coursecertfee','apid_vatamount'])
                ->where(['apid_applicationdtlstmp_fk' => $apptmpPk])
                ->orderBy(['apid_raisedon' => SORT_DESC])
                ->asArray()
                ->one();
   
    $auditinfo = \app\models\AppauditschedtmpTbl::find()
                ->select(['DATE_FORMAT(asd_date,"%d-%m-%Y")AS siteadtdt','auditscheddtls_pk','oum_firstname','oum_emailid'])
                ->leftJoin('auditscheddtls_tbl','auditscheddtls_pk = appasdt_auditscheddtls_fk')
                ->leftJoin('opalusermst_tbl','asd_opalusermst_fk = opalusermst_pk')
                ->where('appasdt_applicationdtlstmp_fk = :temppk',[ ':temppk' => $apptmpPk])
                ->orderBy(['appauditschedtmp_pk' => SORT_DESC])
                ->asArray()->one();
    
    $declinedBy = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['appdt_appdecby'])
                ->where(['applicationdtlstmp_pk' => $apptmpPk])
                ->asArray()
                ->all();
    
    $declineName = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['oum_firstname'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();
    
     $declinerole = \app\models\ApplicationdtlstmpTbl::find()
                ->select(['rm_rolename_en'])
                ->leftJoin('opalusermst_tbl','applicationdtlstmp_tbl.appdt_appdecby = opalusermst_tbl.opalusermst_pk')
                ->leftJoin ('rolemst_tbl' , 'opalusermst_tbl.oum_rolemst_fk = rolemst_tbl.rolemst_pk')
                ->where(['appdt_appdecby' => $declinedBy])
                ->asArray()
                ->one();

    $invAmount = $invoiceDet[apid_coursecertfee];
    $taxCharge = $invoiceDet[apid_vatamount];
    $stafffee  = $invoiceDet[apid_staffevalfee];
    $crtotalAmount = $invAmount + $stafffee + $taxCharge;
   
    
    $reinvAmount = $reinvoiceDet[apid_coursecertfee];
    $retaxCharge = $reinvoiceDet[apid_vatamount];
    $retotalAmount = $reinvAmount + $retaxCharge;
    
     if( $data['projectmst_pk']==2){
        $projectname =  "Standard Course Certificate";
    }elseif($data['projectmst_pk']==3){
         $projectname = "Customised Course Certificate";
    }

    $courseData = [
        'companyName'=> $data['omrm_companyname_en'],
        'tpname'=> $data['omrm_tpname_en'],
        'branchname'=> $data['appiim_branchname_en'],
        'coursetitle'=> $data['coursename_en'],
        'coursecategory'=> $data['courscat_en'],
        'requestedfor'=> $data['reqfor_en'],
        'projectpk' => $data['appdt_projectmst_fk'],
        'appno'=>$data['applictionno'],
        'projectname'=> $projectname,
        'officeType'=> $data['appiim_officetype'], 
        'comments'=>$data['appdt_appdeccomment'],
        'focalname'=>$focalpoint['oum_firstname'] , 
        'focaldesign'=>$focalpoint['odsg_opaldesignationname'] ,
        'focalemail'=>$focalpoint['oum_emailid'] , 
        'focalmob'=>$focalpoint['oum_mobno'],   
        'courAmount'=>$invoiceDet['apid_coursecertfee'],
        'taxAmount'=>$invoiceDet['apid_vatamount'],
        'stafffee'=>$invoiceDet['apid_staffevalfee'],
        'crtotalAmount'=>$crtotalAmount,
        'invoiceNumber'=>$invoiceDet['apid_invoiceno'],
        'siteAuditName'=>$auditinfo['oum_firstname'],
        'siteAuditDt'=>$auditinfo['siteadtdt'],
        'declinName' =>$declineName['oum_firstname'],
        'declinerole' => $declinerole['rm_rolename_en'],
        'pk'=>$data['applicationdtlstmp_pk'],
        'id' => $id,
        'name' => $name,
       ];
    
   


    return $courseData;
    

 }
 
  public function getCertificatests($apptmpPk,$regPk,$caseData){
     
                $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk'=> $regPk,
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
   public function getPaymentSts($apptmpPk,$regPk,$caseData){
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk'=> $regPk,
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
               
   public function sprPaymentSts($apptmpPk,$regPk,$financeId,$financeName,$caseData){
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'apptmpPk' => $apptmpPk,
            'regPk'=> $regPk,
            'financeId' =>$financeId,
            'financeName'=>$financeName
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

  public function batchDtls($batchpk,$theorypk,$caseData){
  
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'batchpk' => $batchpk,
            'theorypk'=> $theorypk,
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

  public function tutbatchDtls($batchpk,$theorypk,$tutormail,$tutorname,$caseData){
  
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => $caseData,
            'batchpk' => $batchpk,
            'theorypk'=> $theorypk,
            'tutormail'=> $tutormail,
            'tutorname'=>$tutorname
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
public function batchData($batchpk,$theorypk){

    $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                    'bmd_Batchno', 
                    'DATE_FORMAT(bmph_startdate,\'%d-%m-%Y\') as pracstdt', 
                    'DATE_FORMAT(bmph_enddate,\'%d-%m-%Y\') as pracenddt', 
                    'DATE_FORMAT(bmth_startdate,\'%d-%m-%Y\') as theostdt ', 
                    'DATE_FORMAT(bmth_enddate,\'%d-%m-%Y\') as theoenddt',
                    'theory.oum_firstname as theorytutor',
                    'practical.oum_firstname as practicaltutor',
                    'theory.oum_emailid as theoryemail',
                    'practical.oum_emailid as practicalmail',
                    'accessor.oum_firstname as accessorname',
                    'accessor.oum_emailid as accessormail',
                    'qastaff.oum_firstname as qastaffname',
                    'qastaff.oum_emailid as qamail',
                    'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                    'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
                ])
                ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as theory', 'batchmgmtthyhdr_tbl.bmth_tutor = theory.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as practical', 'batchmgmtpracthdr_tbl.bmph_tutor = practical.opalusermst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')   
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    
    $tutor = \app\models\BatchmgmtdtlsTbl::find()
            ->select (['oum_firstname','oum_emailid'])
            ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
            ->leftJoin('opalusermst_tbl', 'batchmgmtpracthdr_tbl.bmph_tutor = opalusermst_tbl.opalusermst_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
           ->asArray()
            ->all();
    
      $tutormail = [];
      $tutorname = [];
        foreach ($tutor as $tutordet) {
            $tutormail[] = $tutordet['oum_emailid'];
            $tutorname[] = $tutordet['oum_firstname'];
        }
    
    
    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                       'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
                    'accesscentre.oum_emailid  as accessfoclmail'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')       
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
    
   

    $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();

    $batchData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['pracstdt'],
        'practicalEnddt'=> $batchDet['pracenddt'],
        'theoryStdt'=> $batchDet['theostdt'],
        'theoryEnddt'=> $batchDet['theoenddt'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'practicalmail' => $batchDet['practicalmail'],
        'accessormail' => $batchDet['accessormail'],
        'ivqamail' => $batchDet['qamail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'batchtpname' => $diffaccessor['omrm_companyname_en'],
        'subcategory' => $diffaccessor['ccm_catname_en'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'focaldiffcentmail'=>$diffaccessor['accessfoclmail'],
        'tutormail'=>$tutormail,
      'tutorname'=>$tutorname,
       ];
    
 

    return $batchData;
    
}

public function tutbatchData($batchpk,$theorypk,$tutormail,$tutorname){

    $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                    'bmd_Batchno', 'bmd_comment',
                    'DATE_FORMAT(bmph_startdate,\'%d-%m-%Y\') as pracstdt', 
                    'DATE_FORMAT(bmph_enddate,\'%d-%m-%Y\') as pracenddt', 
                    'DATE_FORMAT(bmth_startdate,\'%d-%m-%Y\') as theostdt ', 
                    'DATE_FORMAT(bmth_enddate,\'%d-%m-%Y\') as theoenddt',
                    'theory.oum_firstname as theorytutor',
                    'practical.oum_firstname as practicaltutor',
                    'theory.oum_emailid as theoryemail',
                    'practical.oum_emailid as practicalmail',
                    'accessor.oum_firstname as accessorname',
                    'accessor.oum_emailid as accessormail',
                    'qastaff.oum_firstname as qastaffname',
                    'qastaff.oum_emailid as qamail',
                    'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                    'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
                ])
                ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as theory', 'batchmgmtthyhdr_tbl.bmth_tutor = theory.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as practical', 'batchmgmtpracthdr_tbl.bmph_tutor = practical.opalusermst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')   
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    

    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                       'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
                    'accesscentre.oum_emailid  as accessfoclmail'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')       
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
    
   

    $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();

    $tutbatchData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['pracstdt'],
        'practicalEnddt'=> $batchDet['pracenddt'],
        'theoryStdt'=> $batchDet['theostdt'],
        'theoryEnddt'=> $batchDet['theoenddt'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'practicalmail' => $batchDet['practicalmail'],
        'accessormail' => $batchDet['accessormail'],
        'ivqamail' => $batchDet['qamail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'batchtpname' => $diffaccessor['omrm_companyname_en'],
        'subcategory' => $diffaccessor['ccm_catname_en'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'focaldiffcentmail'=>$diffaccessor['accessfoclmail'],
        'batcomment' => $batchDet['bmd_comment'],
       ];
    
 

    return $tutbatchData;
    
}

public function learnerData($batchpk,$staffpk){

                 $learnerDtls = \app\models\StaffinforepoTbl::find()
                 ->select(['Irhd_emailid', 'sir_name_en', 'osm_statename_en', 'ocim_cityname_en'])
                 ->leftJoin('learnerreghrddtls_tbl','staffinforepo_tbl.staffinforepo_pk =learnerreghrddtls_tbl.lrhd_staffinforepo_fk')
                 ->leftJoin('opalcitymst_tbl', 'staffinforepo_tbl.sir_opalcitymst_fk = opalcitymst_tbl.opalcitymst_pk')
                 ->leftJoin('opalstatemst_tbl', 'staffinforepo_tbl.sir_opalstatemst_fk = opalstatemst_tbl.opalstatemst_pk')
                 ->where(['staffinforepo_pk' => $staffpk])
                 ->asArray()
                 ->one();
            
   
    $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                    'bmd_Batchno', 
                    'DATE_FORMAT(bmph_startdate,\'%d-%m-%Y\') as pracstdt', 
                    'DATE_FORMAT(bmph_enddate,\'%d-%m-%Y\') as pracenddt', 
                    'DATE_FORMAT(bmth_startdate,\'%d-%m-%Y\') as theostdt ', 
                    'DATE_FORMAT(bmth_enddate,\'%d-%m-%Y\') as theoenddt',
                    'scd_ispratclass','bmd_batchtype',
                    'theory.oum_firstname as theorytutor',
                    'practical.oum_firstname as practicaltutor',
                    'theory.oum_emailid as theoryemail',
                    'practical.oum_emailid as practicalmail',
                    'accessor.oum_firstname as accessorname',
                    'qastaff.oum_firstname as qastaffname',
                    'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                 'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime' 
                ])
                ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as theory', 'batchmgmtthyhdr_tbl.bmth_tutor = theory.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as practical', 'batchmgmtpracthdr_tbl.bmph_tutor = practical.opalusermst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')   
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    
    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                  'osm_statename_en','ocim_cityname_en',
                   'omrm_companyname_en',
                   'ccm_catname_en','scm_assessmentin',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                             'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')  
                ->leftJoin('opalcitymst_tbl', 'batchmgmtdtls_tbl.bmd_citymst_fk = opalcitymst_tbl.opalcitymst_pk') 
                ->leftJoin('opalstatemst_tbl', 'batchmgmtdtls_tbl.bmd_statemst_fk = opalstatemst_tbl.opalstatemst_pk') 
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    
    

    $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();
  
        
        if($batchDet['bmd_batchtype']==24){
            $type = "Initial";
        }elseif($batchDet['bmd_batchtype']==25){
            $type = "Refresher";
        }

        
        
        
    $learnerData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['pracstdt'],
        'practicalEnddt'=> $batchDet['pracenddt'],
        'theoryStdt'=> $batchDet['theostdt'],
        'theoryEnddt'=> $batchDet['theoenddt'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'practicalmail' => $batchDet['practicalmail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'ispractical'=>$batchDet['scd_ispratclass'],
        'batchtype'=>$type,
        'prabatchtype'=>$batchDet['bmd_batchtype'],
        'batchtpname' => $diffaccessor['omrm_companyname_en'],
        'subcategory' => $diffaccessor['ccm_catname_en'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'city'=> $diffaccessor['ocim_cityname_en'],
        'state'=> $diffaccessor['osm_statename_en'],
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'learnermail'=> $learnerDtls['Irhd_emailid'],
        'learnername'=> $learnerDtls['sir_name_en'],
        'learnercity'=>$learnerDtls['ocim_cityname_en'],
        'learnerstate'=>$learnerDtls['osm_statename_en'],
          'diffcen'=>$diffaccessor['scm_assessmentin'],
        
       ];
    
    
  
  
    return $learnerData;  
}

public function learnerBulkData($batchpk,$learnerId,$learnerName){
    $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                    'bmd_Batchno', 
                    'DATE_FORMAT(bmph_startdate,\'%d-%m-%Y\') as pracstdate',
                    'DATE_FORMAT(bmph_enddate,\'%d-%m-%Y\') as pracenddate',
                    'DATE_FORMAT(bmth_startdate,\'%d-%m-%Y\') as theorystdate',
                    'DATE_FORMAT(bmth_enddate,\'%d-%m-%Y\') as theoryenddate',
                    'bmd_batchtype',
                    'theory.oum_firstname as theorytutor',
                    'practical.oum_firstname as practicaltutor',
                    'theory.oum_emailid as theoryemail',
                    'practical.oum_emailid as practicalmail',
                    'accessor.oum_firstname as accessorname',
                    'qastaff.oum_firstname as qastaffname',
                    'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                    'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
                ])
                ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as theory', 'batchmgmtthyhdr_tbl.bmth_tutor = theory.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as practical', 'batchmgmtpracthdr_tbl.bmph_tutor = practical.opalusermst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')   
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    
    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                  'osm_statename_en','ocim_cityname_en',
                   'omrm_companyname_en',
                   'ccm_catname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                         'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime', 
                    'scm_assessmentin'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')  
                ->leftJoin('opalcitymst_tbl', 'batchmgmtdtls_tbl.bmd_citymst_fk = opalcitymst_tbl.opalcitymst_pk') 
                ->leftJoin('opalstatemst_tbl', 'batchmgmtdtls_tbl.bmd_statemst_fk = opalstatemst_tbl.opalstatemst_pk') 
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    

    $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();
        
             if($batchDet['bmd_batchtype']==24){
            $type = "Initial";
        }elseif($batchDet['bmd_batchtype']==25){
            $type = "Refresher";
        }

        if($batchDet['bmd_status']==1){
            $batchstatus = "New";
        }elseif($batchDet['bmd_status']==2){
            $batchstatus = "Teaching Theory";
        }elseif($batchDet['bmd_status']==3){
            $batchstatus = "Teaching Practical";
        }elseif($batchDet['bmd_status']==4){
            $batchstatus = "Assessment";
        }elseif($batchDet['bmd_status']==5){
            $batchstatus = "Requested for Back Track";
        }elseif($batchDet['bmd_status']==6){
            $batchstatus = "Quality Check";
        }elseif($batchDet['bmd_status']==7){
            $batchstatus = "Cancelled";
        }elseif($batchDet['bmd_status']==8){
            $batchstatus = "Print";
        }
  


    $learnerBulkData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['pracstdate'],
        'practicalEnddt'=> $batchDet['pracenddate'],
        'theoryStdt'=> $batchDet['theorystdate'],
        'theoryEnddt'=> $batchDet['theoryenddate'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'practicalmail' => $batchDet['practicalmail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'batchtpname' => $diffaccessor['omrm_companyname_en'],
        'subcategory' => $diffaccessor['ccm_catname_en'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'city'=> $diffaccessor['ocim_cityname_en'],
        'state'=> $diffaccessor['osm_statename_en'],
        'diffcen'=>$diffaccessor['scm_assessmentin'],
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'learnerId'=>$learnerId,
        'learnerName'=> $learnerName,
          'batchtype'=>$type,
        'batchsts'=>$batchstatus,
       ];
    


    return $learnerBulkData;  
}

public function learnerQcData($batchpk){
    
            $batchDet = \app\models\BatchmgmtdtlsTbl::find()
          ->select([
              'bmd_Batchno', 
              'bmph_startdate', 
              'bmph_enddate', 
              'bmth_startdate', 
              'bmth_enddate',
              'bmd_comment',
              'bmd_batchtype',
              'bmd_updatedby','bmd_status',
              'theory.oum_firstname as theorytutor',
              'practical.oum_firstname as practicaltutor',
              'theory.oum_emailid as theoryemail',
              'practical.oum_emailid as practicalmail',
              'accessor.oum_firstname as accessorname',
              'qastaff.oum_firstname as qastaffname',
              'accessor.oum_emailid as accessmail',
              'qastaff.oum_emailid as qamail',
              'requestedfor.oum_firstname as requestedfor',
              'focalpoint.oum_firstname as focalpoint',
              'focalpoint.oum_emailid as focalmail',
              'DATE_FORMAT(bmah_assessmentdate, \'%d-%m-%Y\') as accessmentdate',
              'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
              'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
          ])
          ->leftJoin('batchmgmtthyhdr_tbl AS theoryhdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = theoryhdr.bmth_batchmgmtdtls_fk')
          ->leftJoin('batchmgmtpracthdr_tbl AS practicalhdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = practicalhdr.bmph_batchmgmtdtls_fk')
          ->leftJoin('opalusermst_tbl AS theory', 'theoryhdr.bmth_tutor = theory.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS practical', 'practicalhdr.bmph_tutor = practical.opalusermst_pk')
          ->leftJoin('batchmgmtasmthdr_tbl AS asmthdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = asmthdr.bmah_batchmgmtdtls_fk')
          ->leftJoin('opalusermst_tbl AS accessor', 'asmthdr.bmah_assessor = accessor.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS qastaff', 'asmthdr.bmah_ivqastaff = qastaff.opalusermst_pk') 
          ->leftJoin('opalusermst_tbl AS requestedfor', 'batchmgmtdtls_tbl.bmd_updatedby = requestedfor.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS focalpoint', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = focalpoint.oum_opalmemberregmst_fk AND focalpoint.oum_isfocalpoint = 1 AND focalpoint.oum_status = "A"')
          ->where(['batchmgmtdtls_tbl.batchmgmtdtls_pk' => $batchpk])
          ->asArray()
          ->one();
        
            
        $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();

         $learnerDtls = \app\models\BatchmgmtdtlsTbl::find()
            -> select(['sir_name_en','sir_idnumber','learnerreghrddtls_pk','Irhd_emailid','lrhd_appdeccomments'])
            ->leftJoin('learnerreghrddtls_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
            ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
            ->asArray()
            ->one();
        
        $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                               'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
                    'accesscentre.oum_emailid  as accessfoclmail',
                    'scm_assessmentin'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')       
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
 
          $opalAdmin = \app\models\OpalusermstTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->where(['oum_opalmemberregmst_fk' => 1])
            ->asArray()
            ->all();

        $opalmailid = [];
        foreach ($opalAdmin as $user) {
            $opalmailid[] = $user['oum_emailid'];
        }

                         $batchlearnercommand = \Yii::$app->db->createCommand("select omm_name_en,osmm_name_en,omm_crudaccess,rad_Access,oum_firstname,RoleAllocationDtls_pk,opalusermst_pk,oum_emailid 
                             from opalmodulemst_tbl 
JOIN opalsubmodulemst_tbl ON opalmodulemst_tbl.opalmodulemst_pk = opalsubmodulemst_tbl.osmm_opalmodulemst_fk
LEFT JOIN roleallocationdtls_tbl ON opalsubmodulemst_tbl.opalsubmodulemst_pk = roleallocationdtls_tbl.rad_OpalSubModuleMst_FK
JOIN opalusermst_tbl on find_in_set(rad_RoleMst_FK,oum_rolemst_fk)
WHERE omm_opalstkholdertypmst_fk = 1 and oum_opalmemberregmst_fk=1 and  rad_Access like '%5%' and opalsubmodulemst_pk='4' group by opalusermst_pk");  
 
        $learnaccess = $batchlearnercommand ->queryAll(); 
        
    
     
                           $learnaccessid = [];
                           $learnaccessnm = [];
        foreach ($learnaccess as $lnaccessuser) {
             echo $lnaccessuser;
            $learnaccessid[] = $lnaccessuser['oum_emailid'];
            $learnaccessnm[] = $lnaccessuser['oum_firstname'];
        }

        if($batchDet['bmd_batchtype']==24){
            $type = "Initial";
        }elseif($batchDet['bmd_batchtype']==25){
            $type = "Refresher";
        }

        if($batchDet['bmd_status']==1){
            $batchstatus = "New";
        }elseif($batchDet['bmd_status']==2){
            $batchstatus = "Teaching Theory";
        }elseif($batchDet['bmd_status']==3){
            $batchstatus = "Teaching Practical";
        }elseif($batchDet['bmd_status']==4){
            $batchstatus = "Assessment";
        }elseif($batchDet['bmd_status']==5){
            $batchstatus = "Requested for Back Track";
        }elseif($batchDet['bmd_status']==6){
            $batchstatus = "Quality Check";
        }elseif($batchDet['bmd_status']==7){
            $batchstatus = "Cancelled";
        }elseif($batchDet['bmd_status']==8){
            $batchstatus = "Print";
        }
        

          $learnerQcData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['bmph_startdate'],
        'practicalEnddt'=> $batchDet['bmph_enddate'],
        'theoryStdt'=> $batchDet['bmth_startdate'],
        'theoryEnddt'=> $batchDet['bmth_enddate'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'accessormail' => $batchDet['accessmail'],
        'qamail' => $batchDet['qamail'],
        'centfocalmail' => $batchDet['focalmail'],
        'batchtype'=>$type,
        'batchsts'=>$batchstatus,
        'practicalmail' => $batchDet['practicalmail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'learnerName' => $learnerDtls['sir_name_en'],
        'lnCivilno' => $learnerDtls['sir_idnumber'],
        'learnermail' =>  $learnerDtls['Irhd_emailid'],
        'companyname' => $diffaccessor['omrm_companyname_en'],
        'course' => $diffaccessor['ccm_catname_en'],
        'comment' => $learnerDtls['lrhd_appdeccomments'],
         'batcomment' =>     $batchDet['bmd_comment'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'diffcentaccmail'=> $diffaccessor['accessfoclmail'],   
        'diffecntre'=>$diffaccessor['ascm_assessmentin'],
        'requestedfor'=> $batchDet['requestedfor'],
        'focalpoint'=>$batchDet['focalpoint'],
        'learnerpk' => $learnerDtls['learnerreghrddtls_pk'],        
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'adminmail' => $opalmailid,
        'learneradmail' => $learnaccessid,
       ];
   

         
    return $learnerQcData;  
}

public function learnerAccData($batchpk,$learnerpk){
 
            $batchDet = \app\models\BatchmgmtdtlsTbl::find()
          ->select([
              'bmd_Batchno', 
              'bmph_startdate', 
              'bmph_enddate', 
              'bmth_startdate', 
              'bmth_enddate',
              'bmd_comment',
              'bmd_batchtype',
              'bmd_updatedby','bmd_status',
              'theory.oum_firstname as theorytutor',
              'practical.oum_firstname as practicaltutor',
              'theory.oum_emailid as theoryemail',
              'practical.oum_emailid as practicalmail',
              'accessor.oum_firstname as accessorname',
              'qastaff.oum_firstname as qastaffname',
              'accessor.oum_emailid as accessmail',
              'qastaff.oum_emailid as qamail',
              'requestedfor.oum_firstname as requestedfor',
              'focalpoint.oum_firstname as focalpoint',
              'focalpoint.oum_emailid as focalmail',
              'DATE_FORMAT(bmah_assessmentdate, \'%d-%m-%Y\') as accessmentdate',
                  'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
          ])
          ->leftJoin('batchmgmtthyhdr_tbl AS theoryhdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = theoryhdr.bmth_batchmgmtdtls_fk')
          ->leftJoin('batchmgmtpracthdr_tbl AS practicalhdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = practicalhdr.bmph_batchmgmtdtls_fk')
          ->leftJoin('opalusermst_tbl AS theory', 'theoryhdr.bmth_tutor = theory.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS practical', 'practicalhdr.bmph_tutor = practical.opalusermst_pk')
          ->leftJoin('batchmgmtasmthdr_tbl AS asmthdr', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = asmthdr.bmah_batchmgmtdtls_fk')
          ->leftJoin('opalusermst_tbl AS accessor', 'asmthdr.bmah_assessor = accessor.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS qastaff', 'asmthdr.bmah_ivqastaff = qastaff.opalusermst_pk') 
          ->leftJoin('opalusermst_tbl AS requestedfor', 'batchmgmtdtls_tbl.bmd_updatedby = requestedfor.opalusermst_pk')
          ->leftJoin('opalusermst_tbl AS focalpoint', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = focalpoint.oum_opalmemberregmst_fk AND focalpoint.oum_isfocalpoint = 1 AND focalpoint.oum_status = "A"')
          ->where(['batchmgmtdtls_tbl.batchmgmtdtls_pk' => $batchpk])
          ->asArray()
          ->one();
        
            
        $focalsubquery = \app\models\BatchmgmtdtlsTbl::find()
        ->select('oum_opalmemberregmst_fk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
        ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
        ->where(['batchmgmtdtls_pk' => $batchpk]);

        $focalquery = \app\models\OpalusermstTbl::find()
        ->select(['oum_firstname', 'oum_emailid'])
        ->where([
            'oum_opalmemberregmst_fk' => $focalsubquery,
            'oum_isfocalpoint' => 1,
            'oum_status' => 'A',
        ]);

        $focalpoint = $focalquery->one();

         $learnerDtls = \app\models\BatchmgmtdtlsTbl::find()
            -> select(['learnerreghrddtls_pk','Irhd_emailid','lrhd_appdeccomments'])
            ->leftJoin('learnerreghrddtls_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
            ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
            ->asArray()
            ->one();
        
         $learnerCom = \app\models\LearnerreghrddtlsTbl::find()
                -> select(['lrhd_appdeccomments','sir_name_en','sir_idnumber','Irhd_emailid'])
                ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
                ->where(['learnerreghrddtls_pk' => $learnerpk])
                ->orderBy(['lrhd_appdecon' => SORT_DESC])->asArray()->one();
         
   
         
    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                    'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
                    'accesscentre.oum_emailid  as accessfoclmail',
                    'scm_assessmentin'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')       
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
 
          $opalAdmin = \app\models\OpalusermstTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->where(['oum_opalmemberregmst_fk' => 1])
            ->asArray()
            ->all();

        $opalmailid = [];
        foreach ($opalAdmin as $user) {
            $opalmailid[] = $user['oum_emailid'];
        }

        
                $batchlearnercommand = \Yii::$app->db->createCommand("select omm_name_en,osmm_name_en,omm_crudaccess,rad_Access,oum_firstname,RoleAllocationDtls_pk,oum_emailid from opalmodulemst_tbl 
JOIN opalsubmodulemst_tbl ON opalmodulemst_tbl.opalmodulemst_pk = opalsubmodulemst_tbl.osmm_opalmodulemst_fk
LEFT JOIN roleallocationdtls_tbl ON opalsubmodulemst_tbl.opalsubmodulemst_pk = roleallocationdtls_tbl.rad_OpalSubModuleMst_FK
JOIN opalusermst_tbl on find_in_set(rad_RoleMst_FK,oum_rolemst_fk)
WHERE omm_opalstkholdertypmst_fk = 1 and oum_opalmemberregmst_fk=1 and  rad_Access like '%1%' and opalsubmodulemst_pk='7'");  
 
        $learnaccess = $batchlearnercommand ->queryAll(); 
     
                           $learnaccessid = [];
                           $learnaccessnm = [];
        foreach ($learnaccess as $lnaccessuser) {
            $learnaccessid[] = $lnaccessuser['oum_emailid'];
            $learnaccessnm[] = $lnaccessuser['oum_firstname'];
        }
        
        
        
   
        if($batchDet['bmd_batchtype']==24){
            $type = "Initial";
        }elseif($batchDet['bmd_batchtype']==25){
            $type = "Refresher";
        }

        if($batchDet['bmd_status']==1){
            $batchstatus = "New";
        }elseif($batchDet['bmd_status']==2){
            $batchstatus = "Teaching Theory";
        }elseif($batchDet['bmd_status']==3){
            $batchstatus = "Teaching Practical";
        }elseif($batchDet['bmd_status']==4){
            $batchstatus = "Assessment";
        }elseif($batchDet['bmd_status']==5){
            $batchstatus = "Requested for Back Track";
        }elseif($batchDet['bmd_status']==6){
            $batchstatus = "Quality Check";
        }elseif($batchDet['bmd_status']==7){
            $batchstatus = "Cancelled";
        }elseif($batchDet['bmd_status']==8){
            $batchstatus = "Print";
        }
        

          $learnerAccData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['bmph_startdate'],
        'practicalEnddt'=> $batchDet['bmph_enddate'],
        'theoryStdt'=> $batchDet['bmth_startdate'],
        'theoryEnddt'=> $batchDet['bmth_enddate'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'accessormail' => $batchDet['accessmail'],
        'qamail' => $batchDet['qamail'],
        'lncomments' => $learnerCom['lrhd_appdeccomments'],
        'batchtype'=>$type,
        'batchsts'=>$batchstatus,
        'practicalmail' => $batchDet['practicalmail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'learnerName' => $learnerCom['sir_name_en'],
        'lnCivilno' => $learnerCom['sir_idnumber'],
        'learnermail' =>  $learnerCom['Irhd_emailid'],
        'companyname' => $diffaccessor['omrm_companyname_en'],
        'course' => $diffaccessor['ccm_catname_en'],
        'comment' => $learnerDtls['lrhd_appdeccomments'],
         'batcomment' =>     $batchDet['bmd_comment'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'diffcentaccmail'=> $diffaccessor['accessfoclmail'],   
        'diffecntre'=>$diffaccessor['ascm_assessmentin'],
        'requestedfor'=> $batchDet['requestedfor'],
        'focalpoint'=>$batchDet['focalpoint'],
        'learnerpk' => $learnerDtls['learnerreghrddtls_pk'],        
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'adminmail' => $opalmailid,
        'learneradmail' => $learnaccessid,
       ];
   
       
       
    return $learnerAccData;  
}

public function accessorData($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk){
   
    
    $oldaccess = \app\models\OpalusermstTbl::find()
               ->select([
                    'oum_firstname', 
                    'oum_emailid'        
                ])
                ->where(['opalusermst_pk' => $oldaccesspk])
                ->asArray()
                ->one();

    $newaccess = \app\models\OpalusermstTbl::find()
               ->select([
                    'oum_firstname', 
                    'oum_emailid'        
                ])
                ->where(['opalusermst_pk' => $newaccesspk])
                ->asArray()
                ->one();
    
   $oldivq = \app\models\OpalusermstTbl::find()
               ->select([
                    'oum_firstname', 
                    'oum_emailid'        
                ])
                ->where(['opalusermst_pk' => $oldivpk])
                ->asArray()
                ->one();
    
    $newivq = \app\models\OpalusermstTbl::find()
               ->select([
                    'oum_firstname', 
                    'oum_emailid'        
                ])
                ->where(['opalusermst_pk' => $newivpk])
                ->asArray()
                ->one();
    
     $opalAdmin = \app\models\OpalusermstTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('rolemst_tbl', 'Opalusermst_Tbl.oum_rolemst_fk = rolemst_tbl.rolemst_pk')
            ->where(['oum_opalmemberregmst_fk' => 1 ,'rolemst_pk'=>1])
                ->asArray()
                ->one();
     
     
         $batchaccesscommand = \Yii::$app->db->createCommand("select omm_name_en,osmm_name_en,omm_crudaccess,rad_Access,oum_firstname,RoleAllocationDtls_pk,oum_emailid from opalmodulemst_tbl 
JOIN opalsubmodulemst_tbl ON opalmodulemst_tbl.opalmodulemst_pk = opalsubmodulemst_tbl.osmm_opalmodulemst_fk
LEFT JOIN roleallocationdtls_tbl ON opalsubmodulemst_tbl.opalsubmodulemst_pk = roleallocationdtls_tbl.rad_OpalSubModuleMst_FK
JOIN opalusermst_tbl on find_in_set(rad_RoleMst_FK,oum_rolemst_fk)
WHERE omm_opalstkholdertypmst_fk = 1 and oum_opalmemberregmst_fk=1 and  rad_Access like '%1%' and opalsubmodulemst_pk='7'");  
 
        $batchaccess = $batchaccesscommand ->queryAll(); 
     
                           $batchmailid = [];
                           $batchusernm = [];
        foreach ($batchaccess as $accessuser) {
            $batchmailid[] = $accessuser['oum_emailid'];
            $batchusernm[] = $accessuser['oum_firstname'];
        }

   $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                    'bmd_Batchno', 
                    'bmph_startdate', 
                    'bmph_enddate', 
                    'bmth_startdate', 
                    'bmth_enddate',
                    'bmd_comment',
                    'bmd_batchtype',
                    'bmd_status',
                    'theory.oum_firstname as theorytutor',
                    'practical.oum_firstname as practicaltutor',
                    'theory.oum_emailid as theoryemail',
                    'practical.oum_emailid as practicalmail',
                    'accessor.oum_firstname as accessorname',
                    'qastaff.oum_firstname as qastaffname',
                    'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                        'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime'
                ])
                ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as theory', 'batchmgmtthyhdr_tbl.bmth_tutor = theory.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as practical', 'batchmgmtpracthdr_tbl.bmph_tutor = practical.opalusermst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')   
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
    
    $diffaccessor = \app\models\BatchmgmtdtlsTbl::find()
                ->select([
                   'omrm_companyname_en',
                   'ccm_catname_en',
                    'osm_statename_en','ocim_cityname_en',
                   'accessor.oum_firstname as accessor',
                   'qastaff.oum_firstname as qastaff',
                   'DATE_FORMAT(bmah_assessmentdate,\'%d-%m-%Y\') as accessmentdate',
                    'TIME_FORMAT(bmah_assessstarttime, \'%h:%i %p\') AS accesssttime',
                    'TIME_FORMAT(bmah_assessendtime, \'%h:%i %p\')  AS accessendtime',
                    'accesscentre.oum_emailid  as accessfoclmail'
               ])
                ->leftJoin('opalmemberregmst_tbl', 'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk')
                ->leftJoin('opalusermst_tbl as accesscentre', 'opalmemberregmst_tbl.opalmemberregmst_pk =  accesscentre.oum_opalmemberregmst_fk')
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('coursecategorymst_tbl', 'standardcoursedtls_tbl.scd_subcoursecategorymst_fk = coursecategorymst_tbl.coursecategorymst_pk ')
                ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->leftJoin('opalusermst_tbl as accessor', 'batchmgmtasmthdr_tbl.bmah_assessor = accessor.opalusermst_pk')
                ->leftJoin('opalusermst_tbl as qastaff', 'batchmgmtasmthdr_tbl.bmah_ivqastaff = qastaff.opalusermst_pk')      
                ->leftJoin('opalcitymst_tbl', 'batchmgmtdtls_tbl.bmd_citymst_fk = opalcitymst_tbl.opalcitymst_pk') 
                ->leftJoin('opalstatemst_tbl', 'batchmgmtdtls_tbl.bmd_statemst_fk = opalstatemst_tbl.opalstatemst_pk') 
                ->where(['batchmgmtdtls_pk' => $batchpk , 'accesscentre.oum_isfocalpoint' => 1])
                ->asArray()
                ->one();
    
    
            if($batchDet['bmd_batchtype']==24){
            $type = "Initial";
            }elseif($batchDet['bmd_batchtype']==25){
                $type = "Refresher";
            }

        if($batchDet['bmd_status']==1){
            $batchstatus = "New";
        }elseif($batchDet['bmd_status']==2){
            $batchstatus = "Teaching Theory";
        }elseif($batchDet['bmd_status']==3){
            $batchstatus = "Teaching Practical";
        }elseif($batchDet['bmd_status']==4){
            $batchstatus = "Assessment";
        }elseif($batchDet['bmd_status']==5){
            $batchstatus = "Requested for Back Track";
        }elseif($batchDet['bmd_status']==6){
            $batchstatus = "Quality Check";
        }elseif($batchDet['bmd_status']==7){
            $batchstatus = "Cancelled";
        }elseif($batchDet['bmd_status']==8){
            $batchstatus = "Print";
        }

$subquery = \app\models\OpalusermstTbl::find()
    ->select('oum_opalmemberregmst_fk')
    ->where(['opalusermst_pk' => $oldaccesspk]);

$oldassessor = \app\models\OpalusermstTbl::find()
    ->select(['oum_firstname', 'oum_emailid'])
    ->where([
        'oum_opalmemberregmst_fk' => $subquery,
        'oum_isfocalpoint' => 1,
        'oum_status' => 'A',
    ])
    ->one();

$newsubquery = \app\models\OpalusermstTbl::find()
    ->select('oum_opalmemberregmst_fk')
    ->where(['opalusermst_pk' => $newaccesspk]);

$newassessor = \app\models\OpalusermstTbl::find()
    ->select(['oum_firstname', 'oum_emailid'])
    ->where([
        'oum_opalmemberregmst_fk' => $newsubquery,
        'oum_isfocalpoint' => 1,
        'oum_status' => 'A',
    ])
    ->one();

       
       
    
    $accessorData = [
        'batchNo'=> $batchDet['bmd_Batchno'],
        'practicalStdt'=> $batchDet['bmph_startdate'],
        'practicalEnddt'=> $batchDet['bmph_enddate'],
        'theoryStdt'=> $batchDet['bmth_startdate'],
        'theoryEnddt'=> $batchDet['bmth_enddate'],
        'theoTutor'=> $batchDet['theorytutor'],
        'practTutor' => $batchDet['practicaltutor'],
        'theoryemail' => $batchDet['theoryemail'],
        'practicalmail' => $batchDet['practicalmail'],
        'accessorsame' =>$batchDet['accessorname'],
        'qastaffcentre' =>$batchDet['qastaffname'],
        'comments' =>$batchDet['bmd_comment'],
         'batchtype'=>$type,
        'batchsts'=>$batchstatus,
        'state' =>$diffaccessor['osm_statename_en'],
        'city' =>$diffaccessor['ocim_cityname_en'],
        'batchtpname' => $diffaccessor['omrm_companyname_en'],
        'subcategory' => $diffaccessor['ccm_catname_en'],
        'accessorname'=> $diffaccessor['accessor'],
        'qastaffname'=> $diffaccessor['qastaff'],
        'accessmentdate'=> $diffaccessor['accessmentdate'],
        'accesstarttime'=> $diffaccessor['accesssttime'],
        'accesendtime'=> $diffaccessor['accessendtime'],
        'difffocalmail'=> $diffaccessor['accessfoclmail'], 
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'batchTyp'=>$batchDet['bmd_batchtype'],
        'batchSts'=>$batchDet['bmd_status'],
        'oldaccessorname' => $oldaccess['oum_firstname'],
        'oldaccessmail' => $oldaccess['oum_emailid'],
        'newaccessname'=>$newaccess['oum_firstname'],
        'newaccessmail'=>$newaccess['oum_emailid'],
        'newivqmail'=>$newivq['oum_emailid'],
        'newivqname'=>$newivq['oum_firstname'],
        'oldivqmail'=>$oldivq['oum_emailid'],
        'oldivqname'=>$oldivq['oum_firstname'], 
        'adminmail'=>$opalAdmin['oum_emailid'],
        'focalname'=> $focalpoint['oum_firstname'],
        'focalmail'=> $focalpoint['oum_emailid'],
        'oldaccfocalname'=>$oldassessor['oum_firstname'],
        'oldaccfocalmail'=>$oldassessor['oum_emailid'],
         'newaccfocalname'=>$newassessor['oum_firstname'],
        'newaccfocalmail'=>$newassessor['oum_emailid'],
         'batchadmmail' => $batchmailid,
        
       ];
    
    print_r($accessorData);

    return $accessorData;
}

        public static function ivmsvehiclereg($userpk , $data)
        {
           $model = \app\models\IvmsvehicleregdtlsTbl::find()
                   ->select(['ivrd_appdeviceinfomain_fk','ivrd_vechicleregno','ivrd_chassisno','rcm_coursesubcatname_en as vechile_cate', 'rcm_coursesubcatname_ar as vechile_cate_ar','DATE_FORMAT(ivrd_installationdate,"%d-%m-%Y") AS installationdate_time', 'DATE_FORMAT(ivrd_inststarttime,"%h:%i %p") AS startTime', 'DATE_FORMAT(ivrd_instendtime,"%h:%i %p") AS endTime','ivrd_Installername','ivrd_applicationtype','ivrd_softwareversion','ivrd_appinstinfomain_fk','ivrd_opalmemberregmst_fk','appiim_branchname_en as branch_name', 'appiim_branchname_ar as branch_name_ar','rvod_ownername_en as owner_name', 'rvod_ownername_ar as owner_name_ar','appdim_modelno as ivms_device','rvod_crnumber as crnumber', 'oum_firstname as installer_name','appiim_officetype as office_type','omrm_branch_ar as compname_ar', 'omrm_branch_en as compname_en','acdm_custsuppno1', 'acdm_custsuppno2', 'b.ocim_cityname_en','b.ocim_cityname_ar','d.ocim_cityname_en','d.ocim_cityname_ar','a.osm_statename_ar','c.osm_statename_ar','a.osm_statename_en','c.osm_statename_en','DATE_FORMAT(ivrd_dateofexpiry,"%d-%m-%Y") AS dateofexp','ivrd_contpermailid as owneremail'])
                ->leftJoin('rasvehicleownerdtls_tbl', 'rasvehicleownerdtls_pk = ivrd_rasvehicleownerdtls_fk')
                ->leftJoin('appdeviceinfomain_tbl', 'ivrd_appdeviceinfomain_fk = appdeviceinfomain_pk')
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = ivrd_vechiclecat')
                ->leftJoin('vehiclesubcatmst_tbl', 'vehiclesubcatmst_pk = ivrd_vehiclesubcat')
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = ivrd_appinstinfomain_fk')
                ->leftJoin('opalusermst_tbl', 'opalusermst_pk = ivrd_Installername')
                ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = ivrd_opalmemberregmst_fk')
                ->leftJoin('appcompanydtlsmain_tbl', 'acdm_opalmemberregmst_fk = opalmemberregmst_pk')
                ->leftJoin('opalstatemst_tbl a', 'a.opalstatemst_pk = appiim_statemst_fk')
                ->leftJoin('opalcitymst_tbl b', 'b.opalcitymst_pk = appiim_citymst_fk')
                ->leftJoin('opalstatemst_tbl c', 'c.opalstatemst_pk = acdm_statemst_fk')
                ->leftJoin('opalcitymst_tbl d', 'd.opalcitymst_pk = acdm_citymst_fk')
                ->where(['=','ivmsvehicleregdtls_pk',$data['vehiclePk']])
                ->asArray()
                ->one(); 
           
           if($model['ivrd_applicationtype'] == 1)
           {
               $model['Apllication'] = 'Initial';
           }
           else if($model['ivrd_applicationtype'] == 2)
           {
               $model['Apllication'] = 'Device Replacement';
           }
           else
           {
               $model['Apllication'] = 'Health Check';
           }
           
           if($model['office_type'] == 2)
           {
               $model['centreNameEn'] = $model['branch_name'];
               $model['centreNameAr'] = $model['branch_name_ar'];
               $model['stateEN'] = $model['osm_statename_en'];
               $model['stateAR'] = $model['osm_statename_ar'];
               $model['cityEN'] = $model['ocim_cityname_en'];
               $model['cityAR'] = $model['ocim_cityname_ar'];
           }
           else
           {
               $model['centreNameEn'] = $model['compname_en'];
               $model['centreNameAr'] = $model['compname_ar'];
               $model['stateEN'] = $model['osm_statename_en'];
               $model['stateAR'] = $model['osm_statename_ar'];
               $model['cityEN'] = $model['ocim_cityname_en'];
               $model['cityAR'] = $model['ocim_cityname_ar'];
           }
           
           $userdata = self::geteadminuserdata($userpk);
        
           
           $model = array_merge($model,$userdata);
             
           
       return $model;
      }

}