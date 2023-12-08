<?php

namespace api\components;

use \common\models\MemberregistrationmstTbl;
use \api\modules\mst\models\CountryMasterQuery;
use app\models\MemcompbranchdtlsmainTbl;
use \yii\data\ActiveDataProvider;
class Accountsettings {
    
    public static function getAccountSettingsData($regpk, $userPk, $evp,$comppk= null) {
        
        $data = \app\models\OpalmemberregmstTbl::findOne($regpk);
        $comppk = !empty($comppk)? $comppk : \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userdet = \app\models\OpalusermstTbl::findOne($userPk);
        $userType = ($userdet->oum_isfocalpoint == 1) ? 'A' : 'U';
      
        //company pk based on that we can fech city details

//        $companyPk = $data->company->MemberCompMst_Pk;

        $response['companyName'] = $data->omrm_companyname_en;
         $response['companyNameAr'] = $data->omrm_companyname_ar;
        $response['memberstatus'] = $data->omrm_memberStatus;
        $response['countryName'] = $data->omrmOpalcountrymstFk->ocym_countryname_en;
        $response['countryNameAr'] = $data->omrmOpalcountrymstFk->ocym_countryname_ar;
        $response['countryPk'] = $data->omrm_opalcountrymst_fk; 
        $response['stakeholderType'] = $data->omrm_stkholdertypmst_fk;
        $response['crregno'] = $data->omrm_crnumber;
        $response['registeredOn'] = date('d-m-Y',strtotime($data->omrm_createdon)) ?? null;
        $response['primaryContact'] = [];
        
       
        foreach($data->opalusermstTbls as $key => $val){
            if($val->oum_isfocalpoint == 1){
                $primaryUser = $val;
                break;
            }
        }
        
        $response['logo'] = (array)$data->omrm_cmplogo ?? null;
        if($response['logo'])
        {
            $response['logopath'] = Drive::generateUrl($response['logo'], $regpk, $regpk);
        }
        $response['userdp'] = (array)$userdet->oum_userdp ?? null;
        if($response['userdp'])
        {
            $response['userdppath'] = Drive::generateUrl($response['logo'], $regpk, $regpk);
        }
        $desig =  $userdet->oum_opaldesignationmst_fk;
        if($desig)
        {
            $primaydesig = \app\models\OpaldesignationmstTbl::find()->where("opaldesignationmst_pk in ($desig)")->one();
        }
        
        
        $response['primaryContact']['pk'] = $userdet->opalusermst_pk;
        $response['primaryContact']['civilnumber'] = $userdet->oum_idnumber ? $userdet->oum_idnumber : '-';
        $response['primaryContact']['firstname'] = $userdet->oum_firstname;
        $response['primaryContact']['emailid'] = $userdet->oum_emailid;
        $response['primaryContact']['usertype'] = ($userdet->oum_isfocalpoint == 1) ? 'A' : 'U';;
        $response['primaryContact']['confirmstatus'] = $userdet->oum_emailconfirmstatus;
        $response['primaryContact']['emailpassseton'] = date('d-m-Y', strtotime($userdet->oum_emailconfirmedon));
        $response['primaryContact']['lastchangepass'] = $userdet->oum_passwordchangedon ? (date('d-m-Y', strtotime($userdet->oum_passwordchangedon))): null;
        $response['primaryContact']['desigpk'] = $desig;
        $response['primaryContact']['designation'] = !empty($primaydesig) ? $primaydesig->odsg_opaldesignationname : null;
        $response['primaryContact']['isPrimaryContact'] = $userdet->oum_isfocalpoint == 1 ? true : false;
        $response['primaryContact']['mobileno'] = $userdet->oum_mobno;
        $response['primaryContact']['mobilecc'] = \app\models\OpalcountrymstTblQuery::getCountryDialCodeByPk($userdet->oum_mobnocc)['ocym_countrydialcode'];
        $response['primaryContact']['mobileDialCode'] = $userdet->oum_mobnocc;
        $response['primaryContact']['createdon'] =  date('d-m-Y', strtotime( $userdet->oum_createdon));
        $response['primaryContact']['userdp'] = (array)$userdet->oum_userdp ?? null;
        
        if($response['primaryContact']['userdp'])
        {
            $response['primaryContact']['dppath'] = Drive::generateUrl($response['primaryContact']['userdp'], $regpk, $regpk);
            
        }
        
        
        
        
        return $response;
    }

    public static function changeCompanyOrProfileLogo($filePk, $userType) {
        if($userType == 1){
         
            $comppk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
            
            $model = \app\models\OpalmemberregmstTbl::findOne($comppk);
            $model->omrm_cmplogo = (count($filePk) > 0) ? end($filePk) : null;
            if($model->save())
            {
                return true;
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
            
//            $comppk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
//            $model = \app\models\OpalusermstTbl::findOne($comppk);
//            $model->oum_userdp = (count($filePk) > 0) ? end($filePk) : null;
//            return $model->save();
        } else if($userType == 2){
            $comppk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $model = \app\models\OpalusermstTbl::findOne($comppk);
            $model->oum_userdp = (count($filePk) > 0) ? end($filePk) : null;
             if($model->save())
            {
                return true;
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
    }
    public static function ValidateEditDtlsInputs($data, $userPk) {
       
        if($data['useremailid'])
        {
            $pattern = '/[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+/i';
           
           
            $email = preg_match($pattern,$data['useremailid']);
        }
        if($data['usercontact'])
        {
           
            $number = Security::sanitizeInput($data['usercontact'], "number");
            $numberlen = strlen($number)==8 ? true : false;
        }
        
        if($numberlen && $email)
        {
            return true;
        }
      return false; 
        
    }
    
    public static function SaveUserDtls($data, $userPk) {
       
        $model = \app\models\OpalusermstTbl::findOne($userPk);
        $stktyp = \yii\db\ActiveRecord::getTokenData('omrm_stkholdertypmst_fk', true);
        
        if($data['useremailid'] !== $model->oum_emailid)
        {
            $email = \app\models\OpalusermstTbl::checkIsEmailAlreadyExists($data['useremailid'],$userPk,$stktyp);
            
            if(!$email && (date('Y-m-d H:i:s', (string)$data['useremailcnfmon']/1000 )!== $model->oum_emailconfirmedon))
            {
                $model->oum_emailid = $data['useremailid'];
                $model->oum_emailconfirmedon = date('Y-m-d H:i:s', (string)$data['useremailcnfmon']/1000 );
            }  
        }
        $model->oum_firstname = $data['name'];
        $model->oum_mobno = $data['usercontact'];
        
        $designation = (string) \app\models\OpaldesignationmstTbl::createNewDesig($data['userdesig'],$model->opalusermst_pk);
            if($designation)
            {
                $model->oum_opaldesignationmst_fk = $designation ;
            }
        if($model->save())
        {
            return $model;  
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
       
        
    }

    public static function generateChangeUserAuthorizeMail(int $currentAdminUserPk, int $newAdminUserPk): bool {
        $currentAdmin = \common\models\UsermstTbl::findOne($currentAdminUserPk);
        $currentAdmin->um_ischangeuser = 1;
        $currentAdmin->um_changeuseron = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        $currentAdmin->save();
        $newAdmin = \common\models\UsermstTbl::findOne($newAdminUserPk);
        $encryptedCurrentAdminPk = Security::encrypt($currentAdminUserPk);
        $encryptedNewAdminPk = Security::encrypt($newAdminUserPk);
        $generatedTime = Security::encrypt($currentAdmin->um_changeuseron);
        $linkaccept = \Yii::$app->params['baseUrl']."/thankyou/approvechange?catype=accept&c=$encryptedCurrentAdminPk&n=$encryptedNewAdminPk&t=$generatedTime";
        $linkcancel = \Yii::$app->params['baseUrl']."/thankyou/approvechange?catype=cancel&c=$encryptedCurrentAdminPk&n=$encryptedNewAdminPk&t=$generatedTime";
        
        $links = ['accept'=>$linkaccept,'cancel'=>$linkcancel,];
//        $content = "Dear {$currentAdmin->um_firstname}, You have made {$newAdmin->um_firstname} as an Admin and Primary Contact User.<br> Please <a href='$link' target='_blank'>Click Here </a> to authorize it.  <br> Thanks";
//        return \Yii::$app->mailer->compose()
//                ->setFrom('noreply@businessgateways.com')
//                ->setTo(\Yii::$app->params['testMailIDs'])
//                ->setSubject('Authorize - Change User')
//                ->setHTMLBody($content)
//                ->send();
        $emailid = $currentAdmin->UM_EmailID;
        $userPk = $currentAdmin->UserMst_Pk;
        $new_userpk = $newAdmin->UserMst_Pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
             'type'=>'changeprimaryusercontent',
            'userpk'=>$userPk,
            'newuserpk'=>$new_userpk,
            'links'=> $links
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

    public static function changeUserAuthorize(int $currentAdminUserPk, int $newAdminUserPk, $type = 'accept',$time='null') {
       
        $validDays = \Yii::$app->params['changeUserValidDays'];
        $currentAdmin = \common\models\UsermstTbl::findOne($currentAdminUserPk);
        $newAdmin = \common\models\UsermstTbl::findOne($newAdminUserPk);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
        $decrypTime = strtotime(Security::decrypt($time));
        $linkDateTime = strtotime($currentAdmin->um_changeuseron);
        if($decrypTime != $linkDateTime)
        {
            return '2';
        }
        $validDateTime = strtotime(date('Y-m-d H:i:s', strtotime("+$validDays days", $linkDateTime)));
        if ($validDateTime < $currentDateTime) {
            $currentAdmin->um_changeuseron = null;
            $currentAdmin->um_ischangeuser = null;
            $currentAdmin->save();
            return '2'; //EXPIRED
        }
        // Change current Admin to User and remove him as primary contact

        if ($type == 'accept') {
            $currentAdmin->UM_Type = 'U';
            $currentAdmin->um_primarycontact = null;
            $currentAdmin->um_ischangeuser = null;
            $currentAdmin->um_changeuseron = null;
            $changedtoUser = $currentAdmin->save();

            // Change new admin to admin and primary contact
            $newAdmin->UM_Type = 'A';
            $newAdmin->um_primarycontact = 1;
            \common\models\UserpermtrnTbl::deleteAll(['IN', 'UPT_UserMst_Fk', $newAdminUserPk]);
            $changedToAdmin = $newAdmin->save();
            $emailid = $newAdmin->UM_EmailID;
            $userPk = $newAdmin->UserMst_Pk;
            $change_admin = $currentAdmin->UserMst_Pk;
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl . "api/ma/mail/sendmail";
            $_data = [
                'type' => 'updateprimaryusercontent',
                'userpk' => $change_admin,
                'newuserpk' => $userPk,
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

            return ($changedToAdmin && $changedtoUser) ? $newAdmin : false;
        }
        else
        {
            $currentAdmin->um_ischangeuser = null;
            $currentAdmin->um_changeuseron = null;
            $currentAdmin->save();
            // Change new admin to admin and primary contact
            \common\models\UserpermtrnTbl::deleteAll(['IN', 'UPT_UserMst_Fk', $newAdminUserPk]);
            $changedToAdmin = $currentAdmin->save();
            
            return ($changedToAdmin)? $currentAdmin : false;
        }
    }

}
