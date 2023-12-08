<?php

namespace api\components;


use api\components\Security;

class Register{
    
    
    
    public static function sendMailRegister($userPk,$type){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=>$type,
            'userpk'=>$userPk,
//            'email'=>$emailid
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
    
    public static function sendSetPassLink($userPk,$link,$type){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
      
        $_data=[
            'userpk'=>$userPk,
            'link'=>$link,  
            'type'=>'suppreg',
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
    public static function sendSetPassLinkdifffocal($userPk,$link,$type,$diffuser,$sameuser){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
      
        $_data=[
            'userpk'=>$userPk,
            'link'=>$link,  
            'type'=>'differntfocalpoint_1',
            'diffuser'=>$diffuser,
            'sameuser'=>$sameuser
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

        $_data=[
            'userpk'=>$userPk,
            'link'=>$link,  
            'type'=>'differntfocalpoint_2',
            'diffuser'=>$diffuser,
            'sameuser'=>$sameuser
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
       
        
        return true;
    }
    
   
    public static function registerCentre($requestdata, $transaction) {
        if (!empty($requestdata)) {

            $uniquedata = self::checkUniqueRegData($requestdata);

            if (!$uniquedata) {
                $saveRegDtls = \app\models\OpalmemberregmstTbl::saveCentreDtls($requestdata);
                $User = \app\models\OpalusermstTbl::saveFocalpointDtls($requestdata, $saveRegDtls);

                $saveUserDtls = $User['model'];
                $setpasslink = $User['resetlink'];
                $saveUploads = \api\models\MemcompfiledtlsTbl::saveRegUploads($requestdata, $saveUserDtls->opalusermst_pk);

                if ($saveRegDtls && $saveUserDtls && $saveUploads) {
                    $transaction->commit();
                    $uniquedatarecheck = self::checkUniqueRegData($requestdata, $saveRegDtls, $saveUserDtls->opalusermst_pk);
                    if(empty($uniquedatarecheck)) {
                        self::sendSetPassLink($saveUserDtls->opalusermst_pk, $setpasslink, 'suppreg');

                        $result['compRegPk'] = Security::encrypt($saveRegDtls);
                        $result['userpk'] = Security::encrypt($saveUserDtls->opalusermst_pk);

                        $result['status'] = 1;

                        return $result;
                    } else {
                        $result['status'] = 2;
                        $result['errorformcontrol'] = $uniquedatarecheck;

                        return $result;
                    }
                }
            } else {
                $result['status'] = 2;
                $result['errorformcontrol'] = $uniquedata;

                return $result;
            }
        }
        return false;
    }
    
    public static function checkUniqueRegData($requestdata , $regpk = '', $userpk = '') {
        if(!empty($requestdata)){
            
            $formcontrol =[];
            
             $opalnumber = \app\models\OpalmemberregmstTbl::checkIsOpalMemNumAlreadyExists($requestdata['opal_memb_no'],$regpk,$userpk);
             $crnumber = \app\models\OpalmemberregmstTbl::checkIsCRNumberAlreadyExists($requestdata['comp_cr_no'],$regpk,$userpk);
             $contemailid = \app\models\OpalusermstTbl::checkIsEmailAlreadyExists($requestdata['focalpoint_emailid'],$userpk,$requestdata['stkholder_type']);
             
             if($opalnumber)
             {
                 $formcontrol[] = 'opal_memb_no';
             }
             if($crnumber){
                 $formcontrol[] = 'comp_cr_no';
             }
             if($contemailid){
                 $formcontrol[] = 'focalpoint_emailid';
             }
             if(!empty($formcontrol))
             {
                 return $formcontrol;
             }
             else
             {
                 return false;
             }
                    
            
        }
        return true;
    }
    
    
    public static function sendEmailverifyOtpMail($dtl){
        
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";

        $jsondtl = Security::encrypt(json_encode($dtl));
        
        if($dtl['from'] == 'registration' || $dtl['from'] == 'twofactor'){
        $_data=[
            'email'=>$dtl['id'],
            'jsondtl'=>$jsondtl,
            'type'=>'emailverifyjson',       
        ];
       }
       
      if($dtl['from'] == 'accountsetting'){
        $_data=[
            'userpk'=>$dtl['userpk'],
            'email'=>$dtl['id'],
            'jsondtl'=>$jsondtl,  
            'type'=>'otptochangeemlcontent',
        ];
       }
      
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


    public static function EmailverifyOtpMail($dtl){
    
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/sendmail";
            $_data=[
                'email'=>$dtl['id'],
                'jsondtl'=>$dtl,
                'type'=>'sucessafterreseteml', 
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





}