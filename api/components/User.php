<?php
namespace api\components;

use common\models\UsermstTbl;
use common\models\UsermstTblQuery;
use common\models\UserprofileTblQuery;
use common\models\UsrprofcontactdtlsTblQuery;
use \common\models\UserinvitedtlsTbl;

use api\components\Security;

class User
{

    public function createUser($data, $session)
    {

        if (!empty($data['usermst'])) {
            $user_create = UsermstTblQuery::createUser($data['usermst'], $session);
            if (!empty($user_create['pk'])) {
                if($user_create['status'] == 1)
                    $userprofcontact_create = UsrprofcontactdtlsTblQuery::createUserProf($data['usermst'], $session, $user_create['pk']);
                if($userprofcontact_create['status'] == 1)
                    $userprofile_create = UserprofileTblQuery::createUserProfile($data['usermst'], $session, $user_create['pk']);
                if (!empty($data['permission'])) {
                    $save = \common\components\User::saveModulesPermission($data['permission'],$user_create['pk'],$data['usermst']['department']);
                    return $save;
                }
            }
        }
        if ($user_create['status'] == 1 && $userprofcontact_create['status'] == 1 && $userprofile_create['status'] == 1) {
            return $response = [
                "msg" => "success",
                "status" => 1
            ];
        } else {
            return $response = [
                "msg" => "failure",
                "status" => 0
            ];
        }
        return $response;
    }
    public function getUser($memregpk){
        $userlist = UsermstTbl::getUserlist($memregpk);
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($userlist->getModels())?$userlist->getModels():[],
            'total_count' => $userlist->getTotalCount(),
            'limit' => 5,
        ];
    }

    public function confirmEmail($email,$userPk)
    {
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $model = UsermstTbl::findOne($userPk);
            $date = date_create();
            $timestamp=date_format($date, 'U');
            $token=time().$timestamp;
            $model->UM_fgtpwdkey=$token;
            if($model->save(false))
            {
                $returndata=UsermstTblQuery::forgotpasswordsend($model);
                return $returndata;
            }
        }
    }

    public function getUserDetails($reg_id,$session){
        $reg_id = empty($reg_id)?$session->MemberRegMst_Pk:$reg_id;
        if(is_numeric($reg_id) && !empty($reg_id)){
            $userDetails = UsermstTblQuery::getUserDetails($reg_id);
            return [
                "msg" => "success",
                "status" => 1,
                "items" => !empty($userDetails->getModels())?$userDetails->getModels():[],
                "totalcount" => ($userDetails->getTotalCount() > 0)?$userDetails->getTotalCount():0
            ];
        }else{
            return [
                "msg" => "Invalid Parameters",
                "status" => 0
            ];
        }
    }

    public function saveModulesPermission($arr,$userpk,$deptpk) {
        foreach ($arr as $key => $val) {
            $mod_sub = $val['module'].'_'.$val['submodule'];
            if(empty($initArr)){
                $initArr[$mod_sub]['module'] = $val['module'];
                $initArr[$mod_sub]['submodule'] = $val['submodule'];
                $initArr[$mod_sub]['type'] = ($val['type'] == 'All')?'':$val['type'];
            }else{
                if(($val['module'] == $initArr[$mod_sub]['module']) && ($val['submodule'] == $initArr[$mod_sub]['submodule'])){
                    $initArr[$mod_sub]['module'] = $val['module'];
                    $initArr[$mod_sub]['submodule'] = $val['submodule'];
                    if($val['type'] == 'All' || $initArr[$mod_sub]['type'] == '1,2,3,4'){
                        $initArr[$mod_sub]['type'] = $initArr[$mod_sub]['type'];
                    }else{
                        if($initArr[$mod_sub]['type'] !='')
                            $initArr[$mod_sub]['type'] .= ','.$val['type'];
                        else
                            $initArr[$mod_sub]['type'] = $val['type'];
                    }
                }else{
                    $initArr[$mod_sub]['module'] = $val['module'];
                    $initArr[$mod_sub]['submodule'] = $val['submodule'];
                    if($val['type'] == 'All' || $initArr[$mod_sub]['type'] == '1,2,3,4'){
                        $initArr[$mod_sub]['type'] = $initArr[$mod_sub]['type'];
                    }else{
                        if(isset($initArr[$mod_sub]['type']))
                            $initArr[$mod_sub]['type'] = ','.$val['type'];
                        else
                            $initArr[$mod_sub]['type'] = $val['type'];
                    }
                }
            }
        }
        foreach ($initArr as $value)
        {
            $save = \common\models\UserpermtrnTblQuery::saveModulesPermission($value,$userpk,$deptpk);
        }
        return $save;
    }
    public function getUserModulesSubModulesPermission($userpk)
    {
        $userModulePermission = \common\models\UserpermtrnTblQuery::getUserModulesPermission($userpk);
        return $userModulePermission;
    }

    public function formData($modules,$submodules,$modules_pk)
    {
        $userpk = filter_input(INPUT_GET, 'userpk',FILTER_SANITIZE_NUMBER_INT);
        $i = 0;
        if(!empty($userpk))
        {
            $userpk = filter_input(INPUT_GET, 'userpk', FILTER_SANITIZE_NUMBER_INT);
            $insertedModulesPk = \common\models\UserpermtrnTblQuery::getModulesPkByUser($userpk);
            $insertedSubModulesPk = \common\models\UserpermtrnTblQuery::getSubModulesPkByUser($insertedModulesPk,$userpk);
            // echo "<pre>";print_r(array_column($submodules,'module_id'));die;
            $perchildarray=array_column($submodules,'module_id');

            foreach ($modules as $key => $value) {
                $response[$i]['modules'] = $value['modules'];
                $response[$i]['module_id'] = $value['module_id'];
                $response[$i]['child'] = $value['child'];
                $response[$i]['mainparent'] = 'main';
                $response[$i]['create'] = $value['create'];
                $response[$i]['read'] = $value['read'];
                $response[$i]['update'] = $value['update'];
                $response[$i]['delete'] = $value['delete'];
                $response[$i]['extend'] = "true";
                $response[$i]['select'] = false;

                $i++;
                foreach ($submodules as $value2) {
                    if(in_array($value2['module_id'],$insertedSubModulesPk))
                    {
                        $submodule = explode("_", $value2['module_id']);
                        if($submodule[0] == $value['module_id']){
                            $insertedSubModules = \common\models\UserpermtrnTblQuery::getUserSubModulesPermission($userpk,$submodule[1]);
                            $response[$i]['modules'] = $insertedSubModules[0]['modules'];
                            $response[$i]['module_id'] = $insertedSubModules[0]['module_id'];
                            $response[$i]['create'] = $insertedSubModules[0]['create'];
                            $response[$i]['read'] = $insertedSubModules[0]['read'];
                            $response[$i]['mainparent'] ='';
                            $response[$i]['update'] = $insertedSubModules[0]['update'];
                            $response[$i]['delete'] = $insertedSubModules[0]['delete'];
                            $response[$i]['orderid'] = $insertedSubModules[0]['module_id'];
                            $response[$i]['select'] = "true";

                            $i++;
                        }else
                        {
                            continue;
                        }
                    }
                    else if ($modules_pk[$key] == $value2['module_fk']) {
                        $response[$i]['modules'] = $value2['modules'];
                        $response[$i]['module_id'] = $value2['module_id'];
                        $response[$i]['create'] = $value2['create'];
                        $response[$i]['read'] = $value2['read'];
                        $response[$i]['mainparent'] ='';
                        $response[$i]['update'] = $value2['update'];
                        $response[$i]['delete'] = $value2['delete'];
                        $response[$i]['orderid'] = $value2['module_id'];
                        $response[$i]['select'] = "false";
                        $i++;
                    } else {
                        continue;
                    }

                }
            }
        }
        else
        {
            foreach ($modules as $key => $value) {
                $response[$i]['modules'] = $value['modules'];
                $response[$i]['module_id'] = $value['module_id'];
                $response[$i]['child'] = $value['child'];
                $response[$i]['mainparent'] ='main';
                $response[$i]['create'] = $value['create'];
                $response[$i]['read'] = $value['read'];
                $response[$i]['update'] = $value['update'];
                $response[$i]['delete'] = $value['delete'];
                $response[$i]['extend'] = "true";
                $response[$i]['select'] = "false";
                $i++;
                foreach ($submodules as $value2) {
                    if ($value['module_id'] == $value2['module_fk']) {
                        $response[$i]['modules'] = $value2['modules'];
                        $response[$i]['module_id'] = $value2['module_id'];
                        $response[$i]['create'] = $value2['create'];
                        $response[$i]['read'] = $value2['read'];
                        $response[$i]['mainparent'] ='';
                        $response[$i]['update'] = $value2['update'];
                        $response[$i]['delete'] = $value2['delete'];
                        $response[$i]['orderid'] = $value2['module_id'];
                        $response[$i]['select'] = "false";
                        $i++;
                    } else {
                        continue;
                    }
                }
            }
        }
        return self::Checkparentpermission($response,$perchildarray);
    }

    public function Checkparentpermission($response,$submodule='')
    {
        if ($response) {

            $perchildarray=array_column($submodule,'module_id');
            $parentkeys = array_keys(array_combine(array_keys($response), array_column($response, "mainparent")), "main");
            // print_r($parentkeys);die;
            foreach ($parentkeys as $pakey => $val) {
                $indexarray = $response[$val];
                $currentinput = preg_quote($indexarray['module_id'] . '_', '~');
                $result = preg_grep('~' . $currentinput . '~', $perchildarray);
                //print_r($result);
                if (!empty($result)) {
                    $checkboolean = 'false';
                    foreach ($result as $reskey => $resval) {
                        $childarraycheck = array_search($resval, array_column($response, 'module_id'));
                        if ($response[$childarraycheck]['select'] == 'true') {
                            $checkboolean = 'true';
                        } else {
                            $checkboolean = 'false';
                            break;
                        }
                    }
                    $response[$val]['select'] = $checkboolean;
                } else {
                    $response[$val]['select'] = 'false';
                }
            }
        }
        return $response;
    }
    
    public function inviteUsers($data) {
        $usersPkArr = array();
        $contact_person_dtls = $data['inviteuser']['contactperson']; // Get Email and Full Name from Request
        $message = $data['inviteuser']['message']; // Get Message from Request
        if (!empty($contact_person_dtls)) {
            foreach ($contact_person_dtls as $value) {
                // save User Details in UserMst_tbl
                $save_user_dtls = \common\models\UsermstTblQuery::save_invited_users($value);
                array_push($usersPkArr, $save_user_dtls);
                if (!$save_user_dtls) {
                    return json_encode([
                        "msg" => "failure",
                        "status" => 0
                    ]);
                }
            }
            $usersPk = implode(",", $usersPkArr);
            //Insert UserPks in inviteuserhstry_tbl and get that pks to send mail
            $userList = \common\models\InviteuserhstryTblQuery::saveInvitedUsersList($usersPk);
            if ($userList) {
                $campaign = new \app\modules\mailer\components\Campaign();
                $send = $campaign->inviteusers($userList);
            } else {
                $send = false;
            }
            if ($send == "success") {
                return json_encode([
                    "msg" => "success",
                    "status" => 1
                ]);
            } else {
                return json_encode([
                    "msg" => "failure",
                    "status" => 0
                ]);
            }
        }
    }

    public static function formModulesSubModulesArr($wholePermArr,$userPermArr){
        $finalArr = array();
        foreach ($wholePermArr as $key => $value){
            
        }
        return $finalArr;
    }
    
    public static function checkInviteSecnarios($inviteEmailArr,$invitContent=""){
        //convert to lowercase all mails
        $inviteEmailArr = array_map('strtolower',$inviteEmailArr);
        
        //Check for invalid emails
        $totalEmailsCount = count($inviteEmailArr);
        $emails  = self::separateValidInvalidEmails($inviteEmailArr);
        $duplicateEmails = $emails['duplicate'];
        $invalidEmails = $emails['invalid'];
        $inviteEmailArr = $emails['valid'];
        
        //is Email Already Active
        $activeEmailArrInSameCompany = UsermstTbl::isActiveUserEmailInSameCompany($inviteEmailArr);
        $activeEmailArrInAnotherCompany = UsermstTbl::isActiveUserEmailInAnotherCompany($inviteEmailArr);
        
        //is Email Already Invited and not expired
        $alreadyInvitedAndActiveEmailArrInSameCompany = UserinvitedtlsTbl::isEmailAlreadyInvitedAndActiveInSameCompany($inviteEmailArr);
        $alreadyInvitedAndActiveEmailArrInAnotherCompany = UserinvitedtlsTbl::isEmailAlreadyInvitedAndActiveInAnotherCompany($inviteEmailArr);
        
        //is Email Already Invited and expired
        $alreadyInvitedAndExpiredEmailArr = UserinvitedtlsTbl::isEmailAlreadyInvitedAndExpired($inviteEmailArr);
        
        //Inactive user with the same company
        $inactiveSameCompanyEmailArr = UsermstTbl::isInActiveSameCompanyUserEmail($inviteEmailArr);
        
        //check if already invited or registered in another company, if yes remove it from expiry list
        foreach(array_merge($activeEmailArrInAnotherCompany,$alreadyInvitedAndActiveEmailArrInAnotherCompany) as $email){
            if(in_array($email,$alreadyInvitedAndExpiredEmailArr)){
                array_splice($alreadyInvitedAndExpiredEmailArr,array_search($email,$alreadyInvitedAndExpiredEmailArr),1);
            }
            if(in_array($email,$inactiveSameCompanyEmailArr)){
                array_splice($inactiveSameCompanyEmailArr,array_search($email,$inactiveSameCompanyEmailArr),1);
            }
        }
        
        foreach(array_merge($activeEmailArrInSameCompany,$alreadyInvitedAndActiveEmailArrInSameCompany,$activeEmailArrInAnotherCompany,$alreadyInvitedAndActiveEmailArrInAnotherCompany,
                $alreadyInvitedAndExpiredEmailArr,$inactiveSameCompanyEmailArr) as $email){
            if(in_array($email,$inviteEmailArr)){
                array_splice($inviteEmailArr,array_search($email,$inviteEmailArr),1);
            }
        }
        return self::saveInviteDtlAndsendInviteMail($totalEmailsCount,$inviteEmailArr,$activeEmailArrInSameCompany,$activeEmailArrInAnotherCompany,$alreadyInvitedAndActiveEmailArrInSameCompany,$alreadyInvitedAndActiveEmailArrInAnotherCompany,
                $alreadyInvitedAndExpiredEmailArr,$inactiveSameCompanyEmailArr,$invalidEmails,$duplicateEmails,$invitContent);
    }
    
    public static function saveInviteDtlAndsendInviteMail($totalEmailsCount,$inviteEmailArr,$activeEmailArrInSameCompany,$activeEmailArrInAnotherCompany,$alreadyInvitedAndActiveEmailArrInSameCompany,$alreadyInvitedAndActiveEmailArrInAnotherCompany,
            $alreadyInvitedAndExpiredEmailArr,$inactiveSameCompanyEmailArr, $invalidEmails, $duplicateEmails,$invitContent){
        foreach($inviteEmailArr as $email){
            $addInviteRecord = UserinvitedtlsTbl::saveInviteDtl($email);
            $mailSent = self::sendInviteMail($addInviteRecord,$invitContent);
        }
        if($mailSent){
            return [
                'msg' => 'success',
                'status' => 1,
                'totalEmails' => $totalEmailsCount,
                'sentEmails' => $inviteEmailArr,
                'activeEmailArrInSameCompany' => $activeEmailArrInSameCompany,
                'activeEmailArrInAnotherCompany' => $activeEmailArrInAnotherCompany,
                'alreadyInvitedAndActiveEmailArrInSameCompany' => $alreadyInvitedAndActiveEmailArrInSameCompany,
                'alreadyInvitedAndActiveEmailArrInAnotherCompany' => $alreadyInvitedAndActiveEmailArrInAnotherCompany,
                'alreadyInvitedAndExpiredEmailArr' => $alreadyInvitedAndExpiredEmailArr,
                'inactiveSameCompanyEmails' => $inactiveSameCompanyEmailArr,
                'invalidEmails' => $invalidEmails,
                'duplicateEmails' => $duplicateEmails
            ];
        }else{
            return [
                'msg' => 'failure',
                'status' => 0,
                'totalEmails' => $totalEmailsCount,
                'sentEmails' => $inviteEmailArr,
                'activeEmailArrInSameCompany' => $activeEmailArrInSameCompany,
                'activeEmailArrInAnotherCompany' => $activeEmailArrInAnotherCompany,
                'alreadyInvitedAndActiveEmailArrInSameCompany' => $alreadyInvitedAndActiveEmailArrInSameCompany,
                'alreadyInvitedAndActiveEmailArrInAnotherCompany' => $alreadyInvitedAndActiveEmailArrInAnotherCompany,
                'alreadyInvitedAndExpiredEmailArr' => $alreadyInvitedAndExpiredEmailArr,
                'inactiveSameCompanyEmails' => $inactiveSameCompanyEmailArr,
                'invalidEmails' => $invalidEmails,
                'duplicateEmails' => $duplicateEmails
            ];
        }
    }
    
    public static function sendInviteMail($inviteDtl,$invitContent){
//        $encryptedPk = Security::encrypt($inviteDtl->userinvitedtls_pk);
//        $companyName = \common\models\MembercompanymstTbl::getCompanyNameByUserPk($inviteDtl->uid_invitedby);
//        $baseUrl = \Yii::$app->params['baseUrl'];
//        $url = $baseUrl."registration/user?pk=$encryptedPk&type=Mw==";
//        $name = explode("@",$inviteDtl->uid_emailid)[0];
//        $content = "Hi $name, <br> You have been invited by $companyName. <br>$invitContent<br> Kindly use the below link to get registered with us <br><a href='$url' target='_blank'>Click Here </a> to Register <br>  Thanks,";
//        return \Yii::$app->mailer->compose()
//                ->setFrom('noreply@businessgateways.com')
//                ->setTo(\Yii::$app->params['testMailIDs'])
//                ->setSubject('Invite to register as a user')
//                ->setHTMLBody($content)
//                ->send();
        $emailid = $inviteDtl->uid_emailid;
        $invitedadminpk = $inviteDtl->uid_invitedby;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'userpk'=>$invitedadminpk,
            'type' => 'inviteusermailsuccess',
            'user_invite_pk'=>$inviteDtl->userinvitedtls_pk
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
    
    public static function checkValidInviteUrlOrNot($pk){ 
        $data = \common\models\UserinvitedtlsTbl::getInviteDtl($pk);
        if(empty($data['data'])){
            $data['urlStatus'] = 'DELETED';
        }else if($data['data']['status'] == "NR" && $data['data']['statustext'] == "I"){
            $data['urlStatus'] = 'VALID';
        }else if($data['data']['status'] == "AR"){
            $data['urlStatus'] = 'REGISTERED';
        }else{
            $data['urlStatus'] = 'EXPIRED';
        }
        return $data;
    }
    
    public static function separateValidInvalidEmails($inviteEmailArr){
        $returnArr = $validmails = $invalidmails = $duplicatemails = [];
        foreach($inviteEmailArr as $email){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){ 
                if(in_array($email, $validmails)){
                    array_push($duplicatemails,$email);
                }else{
                    array_push($validmails,$email);
                }
            }else{
                if(in_array($email, $invalidmails)){
                    array_push($duplicatemails,$email);
                }else{
                    array_push($invalidmails,$email);
                }
            }
        }
        $returnArr['valid'] = $validmails;
        $returnArr['invalid'] = $invalidmails;
        $returnArr['duplicate'] = $duplicatemails;
        return $returnArr;
    }
    
    public function sendForgotMail($dtl){
//        $content = "Hi {$dtl->um_firstname} {$dtl->um_lastname}, <br>OTP is {$dtl->um_otpmail}.<br> Kindly use the below link to reset the password <br><a href='$dtl->um_pwdresetlink' target='_blank'>Click Here </a> to Register <br>  Thanks,";

        
        $userPk = $dtl->UserMst_Pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type' => 'reqtochangepswcontent',
            'userpk'=>$userPk,
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
    
    public function generateForgotMailLink($dtl,$addFlag = true,$type=''){
        
        $encryptedPk = urlencode(Security::encrypt($dtl->opalusermst_pk));
        $encryptedDate = urlencode(Security::encrypt($dtl->oum_fgtpasswordattempton));
        $baseUrl = \Yii::$app->params['baseUrl'];
        $flag = ($addFlag) ? '&f=' : '';
        $ifSet = ($type == 'set') ? '&type=set' : '';
      
        $data =  $baseUrl."admin/setpassword?pk=$encryptedPk$flag&t=$encryptedDate$ifSet";
        
      
      return $data;
    }
    
    public function checkValidForgotPwdLink($userpk,$dateTime){
        $model = \app\models\OpalusermstTbl::findOne($userpk);
        \app\models\OpalusermstTbl::confirmEmailStatus($model);
        $dateTime = strtotime($dateTime);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
        $linkDateTime = $model->oum_fgtpasswordattempton;
        $linkDateTime = strtotime($linkDateTime);
         if($model->oum_status == 'i'){
            return 5;//DEACTIVATE
        }
        else if($model->oum_status == 'd'){
            return 4;//DELETE
        }
        if(($linkDateTime === $dateTime) >= $currentDateTime){
            $model = \app\models\OpalusermstTbl::confirmEmailStatus($model);
            return $model;//VALID   //since no expiry
        }
        else if(($linkDateTime === $dateTime) && $currentDateTime){
            return 2;//EXPIRED
        }
        else if($linkDateTime !== $dateTime){
             return 3;//ALREADY RESET
        }
        die;
    }
    
    public function checkValidOTP($userpk,$otp,$type='email'){
        $model = \app\models\OpalusermstTbl::findOne($userpk);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
         $otpExpiresOn = strtotime(date('Y-m-d H:i:s', strtotime($model->oum_otpexpiredon)));
        
            if ($model->oum_otpmail !== $otp) {
                return 2; //INVALID
            } else if (!empty($model) && ($otpExpiresOn > $currentDateTime) && $model->oum_otpmail === $otp) {
                $model->oum_otpmail = NULL;
                $model->oum_otpexpiredon = NULL;
                if($model->save())
                {
                  return $model ;
                }
                if(!$model->save())
                {
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                }
                $model->save();
            } else {
                return 3; //EXPIRED
//            return $model->um_pwdresetlink;
            }
            die;
        
    }
    public function checkLoginOtp($userpk,$otp){
        $model = UsermstTbl::findOne($userpk);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
       
            if($model->um_2fkey == 1 && $model->um_2ffor == 2 )
            {
                $otpExpiresOn = strtotime(date('Y-m-d H:i:s', strtotime($model->um_mobotpexpiry))); 
                if ($model->um_mobileotp !== $otp) {
                    $model->um_loginattempt =  $model->um_loginattempt == null ? 1 : $model->um_loginattempt+1;
                    $model->save();
                return 2;
                } else if (!empty($model) && ($otpExpiresOn > $currentDateTime) && $model->um_mobileotp === $otp) {

                      $model->um_mobileotp = NULL;
                      $model->um_mobotpexpiry = NULL;
                    if($model->save())
                       return $model; 
                } else {
                    return 3;
                }
                die;
            }
            else if($model->um_2fkey == 1 && $model->um_2ffor == 1 )
            {
                $otpExpiresOn = strtotime(date('Y-m-d H:i:s', strtotime($model->um_otpexpireson)));
                if ($model->um_otpmail !== $otp) {
                    $model->um_loginattempt =  $model->um_loginattempt == null ? 1 : $model->um_loginattempt+1;
                    $model->save();
                    return 2; //INVALID
                } else if (!empty($model) && ($otpExpiresOn > $currentDateTime) && $model->um_otpmail === $otp) {
                    $model->um_otpmail = NULL;
                    $model->um_otpexpireson = NULL;
                     if($model->save())
                       return $model; 
                } else {
                    return 3; //EXPIRED
//            return $model->um_pwdresetlink;
                }
                die;
            }
        
        
    }

    public static function sendOtpToChangePassword($userpk,$currentpassword,$data) {
        
        $model = \app\models\OpalusermstTbl::findOne($userpk);
        
        if(Security::aesdecrypt($currentpassword) !== Security::aesdecrypt($model->oum_password)){
            return 'CNP'; //CNP - Current Password not valid
        }
        $OTPExpiryDuration = \Yii::$app->params['OTP']['setpassword']['expiryduration'];
        if ($data['otptype'] == 'email') {
            $model->oum_otpmail = (string) rand(1000, 5000);
//            $model->oum_otpmail = '1234';
            $model->oum_otpexpiredon = \api\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
        } 
        if($model->save()){
            if($data['otptype'] == 'email'){
                return self::sendChangePasswordOtpMail($model);
            } 
        }
        return false;
    }
    
    public static function verifyOtpToChangePassword($userpk,$otp,$data) {
        if (!empty($otp)) {
                        $validOTP = \api\components\User::checkValidOTP($userpk, $otp,$data['otptype']);
                      
                        if ($validOTP == 2) {
                            return 'OTP-INVALID';
                        } else if ($validOTP == 3) {
                            return 'OTP-EXPIRED';
                        }
                    }
        return true;
    }
    
        public static function sendLoginOtp($userpk) {
        $model = UsermstTbl::findOne($userpk);
        $OTPExpiryDuration = \Yii::$app->params['OTP']['login']['expiryduration'];
        $otpgenerated = (string) rand(100000,500000);
        $otpgenerated = '123456';
        $otpexpiry = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s', strtotime("+$OTPExpiryDuration minutes")));
        
        if($model['um_2ffor']==1 && $model['um_emailverified'])
        {
            $model->um_otpmail = $otpgenerated;
            $model->um_otpexpireson = $otpexpiry;
            
        if($model->save()){
            $data['duration']=$OTPExpiryDuration;
            $data['isSent']=self::sendLoginOtpMail($model);
             $data['attempt']=$model->um_lastloginattempt;
            return $data;
        }
        }
        else if($model['um_2ffor']==2 && $model['um_mobileverified'])
        {
            $model->um_mobileotp = $otpgenerated;
            $model->um_mobotpexpiry = $otpexpiry;
            
        if($model->save()){
            $data['duration']=$OTPExpiryDuration;
            $data['attempt']=$model->um_lastloginattempt;
            $data['isSent']=self::sendLoginOtpSms($model);
            return $data;
        }
        }
        
        return false;
    }
    
    public function sendLoginOtpSms($dtl)
    {
        return true;
    }
    
    
    public function sendLoginOtpMail($dtl){
       
       $userPk = $dtl->UserMst_Pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type' => 'loginotpmailcontent',
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
        return true;
    }
    
    public function sendChangePasswordOtpMail($dtl){
//        $content = "Hi {$dtl->oum_firstname} <br>OTP is {$dtl->oum_otpmail} to change the password. <br>  Thanks,";
//        return \Yii::$app->mailer->compose()
//                ->setFrom('noreply@businessgateways.com')
////                ->setTo('m.sureshkumar@businessgateways.com')
//                ->setTo(\Yii::$app->params['testMailIDs'])
//                ->setSubject('Change Password OTP')
//                ->setHTMLBody($content)
//                ->send();
     
        $userPk = $dtl->opalusermst_pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type' => 'otptochangepswcontent',
            'userpk'=>$userPk,
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
    
    public static function getUserInviteLink($invitePk){
        $encryptedPk = Security::encrypt($invitePk);
        $baseUrl = \Yii::$app->params['baseUrl'];
        $url = $baseUrl."registration/user?pk=$encryptedPk&type=Mw==";
        return $url;
    }
    public function userDeleteMail($emailid, $userPk){
        $baseUrl = \Yii::$app->params['APP_URL'];
        $userdtls = UsermstTbl::find()->where(['UserMst_Pk' =>$userPk ])->asArray()
        ->one();
    
        $admin = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' =>$userdtls['UM_MemberRegMst_Fk'],'UM_Type'=>'A'])
        ->asArray()
        ->one(); 

        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'email'=>$emailid,
            'template_id'=>237,
            'table_ref_key'=>'UserMst_Pk',
            'table_ref_value'=>$admin['UserMst_Pk'],
            'type'=>'inviteuserregistereddeletemail',
            'userpk'=>$userPk,
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
    public function checkValidreg($email){
        $data = 0;
        $model = UsermstTbl::find()->where(['UM_EmailID' => $email])->one();
         if($model->UM_Status == 'D'){
            $data = 1;//DELETED REGISTRATION
        }
        return $data;
    }
}
