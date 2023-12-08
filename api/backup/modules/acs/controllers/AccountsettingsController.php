<?php

namespace api\modules\acs\controllers;

use Yii;
use api\modules\pm\controllers\NbfMasterController;
use yii\web\Response;
use common\models\UsermstTbl;

/*
    Response Status Code Error
    100    -   Success
    101    -   Param's Missing
    102    -   Failure Or Warning Error
    103    -   Db Error
    104    -   Data Not Available
    105    -   Data value mismatch
*/

class AccountsettingsController extends NbfMasterController
{
    public $modelClass = '\common\models\MemcompprofcertfdtlsTbl';
    public function beforeAction($action)
    {
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
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

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /*
        Path : api/acs/accountsettings/fetch-security-service
        Description : To fetch the Account security service data of user
    */
    public function actionFetchSecurityService()
    {
        return $this->asJson([
            'msg' => "success",
            'status' => 1,
        ]);
    }

    /*
        Path : api/acs/accountsettings/change-password
        Description : To change the password of user
        Params :    {
                        postParams:{
                            currentPassword
                            newPassword
                            confirmPassword
                            userPk
                        }
                    }
    */
    public function actionChangePassword(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;

        if(!empty($resParam->userPk) && !empty($resParam->currentPassword) && !empty($resParam->newPassword) && !empty($resParam->confirmPassword)){
            $reqFields = ['UserMst_Pk'];
            $validByFields['userPk'] = $resParam->userPk;
            $userCheck = UsermstTbl::checkUserAvailable($validByFields,$reqFields,'byPk');
            if(!empty($userCheck)){
                $checkUsrCurPassword = UsermstTbl::checkUserPassword([$resParam->userPk,$resParam->currentPassword],$reqFields);
                if(!empty($checkUsrCurPassword)){
                    if($resParam->newPassword == $resParam->confirmPassword){
                        $saveParams = ['newPassword'=>$resParam->newPassword];
                        $changePassword = UsermstTbl::saveUserDetails($resParam->userPk, $saveParams,'password');
                        if($changePassword == true){
                            $message = 'success';
                            $status = 100;
                        }else{
                            $message = 'some database error occurs';
                            $status = 103;
                        }
                    }else{
                        $message = $this->passwordManParasCheck($resParam,'valueMissMatch');
                        $status = 105;
                    }
                }else{
                    $message = $this->passwordManParasCheck($resParam,'usrPassCheck');
                    $status = 104;
                }
            }else{
                $message = $this->passwordManParasCheck($resParam,'userCheck');
                $status = 104;    
            }
        }else{
            $message = $this->passwordManParasCheck($resParam,'common');
            $status = 101;
        }

        return $this->asJson([
            'msg' => $message,
            'status' => $status,
        ]);
    }

    function passwordManParasCheck($resParam,$type){
        $resMessage = '';
        switch ($type) {
            case 'common':
                if(empty($resParam->userPk)){
                    $resMessage = 'userPk is missing';
                }
                if(empty($resParam->currentPassword)){
                    $resMessage = (empty($resMessage))?'Current Password is missing':$resMessage.', Current Password is missing';
                }
                if(empty($resParam->newPassword)){
                    $resMessage = (empty($resMessage))?'New Password is missing':$resMessage.', New Password is missing';
                }
                if(empty($resParam->confirmPassword)){
                    $resMessage = (empty($resMessage))?'Confirm Password is missing':$resMessage.', Confirm Password is missing';
                }
                break;
            case 'userCheck':
                $resMessage = 'You are trying to change the password for invalid user';
                break;
            case 'usrPassCheck':
                $resMessage = 'Your old password is not valid';
                break;
            case 'valueMissMatch':
                $resMessage = 'Your confirm password is not matched with your new password';
                break;
        }
        return $resMessage;
    }

    /*
        Path : api/acs/accountsettings/change-email
        Description : To change the email of user
        Params :    {
                        postParams:{
                            email
                            oldMail
                            userPk
                            userType
                            mailType : {'Primary','Secondary'}
                        }
                    }
    */
    public function actionChangeEmail(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;

        if(!empty($resParam->email) && !empty($resParam->oldMail) && !empty($resParam->userPk) && !empty($resParam->userType) && !empty($resParam->mailType)){

            $validByFields = [
                    'email'=>$resParam->oldMail,
                    'userPk'=>$resParam->userPk,
                    'userType'=>$resParam->userType
                ];
            if($resParam->mailType == 'Primary'){
                $reqFields = ['UserMst_Pk'];
                $userAvailability = UsermstTbl::checkUserAvailable($validByFields,$reqFields,'byEUTP');
            }elseif ($resParam->mailType == 'Secondary') {
                $userAvailability = UsermstTbl::checkUserAvailable($validByFields,$reqFields,'byEUTS');
            }

            if(!empty($userAvailability)){
                $email = test_input($resParam->email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = $this->emailChangeMandParamsCheck($resParam,'invalidEmail');
                    $status = 104;  
                }else{
                    $validByFields = [
                        'email'=>$resParam->email,
                        'userPk'=>$resParam->userPk,
                        'userType'=>$resParam->userType
                    ];
                    if($resParam->mailType == 'Primary'){
                        $reqFields = ['UserMst_Pk'];
                        $emailAvailability = UsermstTbl::checkUserAvailable($validByFields, $reqFields, 'byEAP');
                    }elseif($resParam->mailType == 'Secondary'){
                        // Secondary Code
                    }

                    if(empty($emailAvailability)){
                        $saveParams = ['email'=>$resParam->email];
                        if($resParam->mailType == 'Primary'){
                            $changeEmail = UsermstTbl::saveUserDetails($resParam->userPk, $saveParams,'email');
                        }elseif($resParam->mailType == 'Secondary'){
                            // Secondary Code
                        }
                        if($changeEmail == true){
                            $message = 'success';
                            $status = 100;
                        }else{
                            $message = 'some database error occurs';
                            $status = 103;
                        }
                    }else{
                        $message = $this->emailChangeMandParamsCheck($resParam,'emailAlreadyRegistered');
                        $status = 102;
                    }
                }
            }else{
                $message = $this->emailChangeMandParamsCheck($resParam,'userCheck');
                $status = 104;  
            }
        }else{
            $message = $this->emailChangeMandParamsCheck($resParam,'paramsCheck');
            $status = 101;
        }

        return $this->asJson([
            'msg' => $message,
            'status' => $status,
        ]);
    }

    function emailChangeMandParamsCheck($resParam,$type){
        $resMessage = '';
        switch ($type) {
            case 'paramsCheck':
                if(empty($resParam->email)){
                    $resMessage = 'Email Address is missing';
                }
                if(empty($resParam->oldMail)){
                    $resMessage = (empty($resMessage))?'Old Email Address is missing':$resMessage.', Old Email Address is missing';
                }
                if(empty($resParam->userPk)){
                    $resMessage = (empty($resMessage))?'userPk is missing':$resMessage.', userPk is missing';
                }
                if(empty($resParam->userType)){
                    $resMessage = (empty($resMessage))?'User type is missing':$resMessage.', User type is missing';
                }
                if(empty($resParam->mailType)){
                    $resMessage = (empty($resMessage))?'Mail type is missing':$resMessage.', Mail type is missing';
                }
                break;
            case 'userCheck':
                $resMessage = 'You are trying to change the email for invalid user';
                break;
            case 'invalidEmail':
                $resMessage = 'You have entered invalid email address';
                break;
            case 'emailAlreadyRegistered':
                $resMessage = 'The Email you have given is  already registered by someone else';
                break;
        }
        return $resMessage;
    }

    /*
        Path : api/acs/accountsettings/change-email-type
        Description : To change the email type of user
        Params :    {
                        postParams:{
                            email
                            oldMail
                            userPk
                            userType
                        }
                    }
    */
    public function actionChangeEmailType(){
    }

    /*
        Path : api/acs/accountsettings/change-mobile-number
        Description : To change the mobile number of user
        Params :    {
                        postParams:{
                            mobileNumber
                            userPk
                        }
                    }
    */
    public function actionChangeMobileNumber(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        if(!empty($resParam->mobileNumber) && !empty($resParam->userPk)){
            if(is_numeric($resParam->mobileNumber)){
                $saveParams = ['mobile'=>$resParam->mobileNumber];
                $changeMobileNumber = UsermstTbl::saveUserDetails($resParam->userPk, $saveParams,'mobile');
                if($changeMobileNumber == true){
                    $message = 'success';
                    $status = 100;
                }else{
                    $message = 'some database error occurs';
                    $status = 103;
                }
            }else{
                $message = $this->mobileMandParamsCheck($resParam,'isNumeric');
                $status = 102;
            }
        }else{
            $message = $this->mobileMandParamsCheck($resParam,'paramsCheck');
            $status = 101;
        }

        return $this->asJson([
            'msg' => $message,
            'status' => $status,
        ]);
    }

    function mobileMandParamsCheck($resParam,$type){
        $resMessage = '';
        switch ($type) {
            case 'paramsCheck':
                if(empty($resParam->mobileNumber)){
                    $resMessage = 'Mobile number is missing';
                }
                if(empty($resParam->userPk)){
                    $resMessage = (empty($resMessage))?'userPk is missing':$resMessage.', userPk is missing';
                }
                break;
            case 'isNumeric':
                $resMessage = 'Enter valid mobile number';
                break;
        }

        return $resMessage;
    }
    
    public function actionAccsettingsdata() {
        $paramRequest = file_get_contents("php://input");
        $requestPost = json_decode($paramRequest,true);
        $requestParams = Yii::$app->request;
        $evp = $requestParams->get('editdata');
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $userType = \yii\db\ActiveRecord::getTokenData('user_type', true);
        $accSettingsDtl = \common\components\Accountsettings::getAccountSettingsData($regpk, $userPk, $evp);
        return $accSettingsDtl;
    }
    
    public function actionUpdateemailpref() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $emailPref = $data['emailpref'];
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $msg['msg'] = 'failure';    
        $msg['status'] = 0;
        $update = UsermstTbl::updateEmailPref($userpk,$emailPref);
        if($update && $update === true){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }
    
    public function actionSavesecurityquestion(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['qa'];
        $saveAnswers = \common\models\UsersecurityqstdtlsTbl::saveSecurityQandA($data);
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        if($saveAnswers){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }
    
    public function actionSavelogo() {
        $userType = \yii\db\ActiveRecord::getTokenData('user_type', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $accSettingsDtl = \common\components\Accountsettings::changeCompanyOrProfileLogo($data['filePk'], $userType);
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        if($accSettingsDtl){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }
    
    public function actionChangeuser(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
       $ischangeuser= \common\models\UsermstTbl::find()->where("UM_MemberRegMst_Fk =:regpk and um_ischangeuser is not null ",[':regpk'=>$regpk])->count();
       if($ischangeuser == 0){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
            /*Access Creation Formation*/
            $userAccessArr = [];
            foreach ($data['userPermission'] as $key => $ua) {
                $ua = (object) $ua;
                if(($ua->submodule > 0) && ($ua->type > 0)){
                    $userAccessArr[$ua->submodule] = (isset($userAccessArr[$ua->submodule]) && !empty($userAccessArr[$ua->submodule]))?$userAccessArr[$ua->submodule].','.$ua->type:$ua->type;
                }
            }
            $save['userAccess'] = $userAccessArr;
            \common\models\UserpermtrnTbl::saveUserPerm($save['userAccess'], $data['department'], $data['userPk']);
            \common\components\Accountsettings::generateChangeUserAuthorizeMail($data['userPk'], $data['newAdminUserPk']);           
       }else{
           $msg['msg'] = 'success';
           $msg['status'] = 2;
       }        
        return $this->asJson($msg);
    }
    
    public function actionChangeuserauthorize(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        $encryptedCurrentAdminPk = (int) \common\components\Security::decrypt($data['currentAdminPk']);
        $encryptedNewAdminPk = (int) \common\components\Security::decrypt($data['newAdminPk']);
        $modelolduser = UsermstTbl::findOne($encryptedCurrentAdminPk);
        $modelnewuser = UsermstTbl::findOne($encryptedNewAdminPk);
        $type = $data['catype'];
        $time = $data['t'];
        $authorized = \common\components\Accountsettings::changeUserAuthorize($encryptedCurrentAdminPk,$encryptedNewAdminPk,$type,$time);
        
        $olduser = $modelolduser->um_firstname." ".$modelolduser->um_middlename." ".$modelolduser->um_lastname;
        $newuser = $modelnewuser->um_firstname." ".$modelnewuser->um_middlename." ".$modelnewuser->um_lastname;
        
        if(!empty($authorized) && is_object($authorized)){
            $msg['msg'] = 'success';
            $msg['type'] = $type;
            $msg['status'] = 1;
            $msg['newUser'] = $authorized->um_firstname." ".$authorized->um_middlename." ".$authorized->um_lastname;
            $msg['oldUser'] = ($type == 'accept')? $olduser : $newuser;
        } else if(is_numeric($authorized) && $authorized == 2) {
            $msg['msg'] = 'expired';
            $msg['status'] = 2;
        }
        return $this->asJson($msg);
    }
}
