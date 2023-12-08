<?php

namespace api\modules\ea\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \common\models\UsermstTbl;
use \common\models\DepartmentmstTbl;
use \common\models\BasemodulemstTbl;
use \common\models\StkholderaccessmstTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\AccessmasterTbl;
use \common\models\UserpermtrnTbl;
use \common\models\MembercompanymstTbl;
use \common\components\EnterpriseFilter;
use common\components\Drive;

use api\modules\apr;
/*
    Response Status Code Error
    100    -   Success
    101    -   Param's Missing
    102    -   Failure Or Warning Error
    103    -   Db Error
    104    -   Data Not Available || Data Already Available
    105    -   Data value mismatch
    106    -   Sanitize error
*/
class UserController extends MasterController
{
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
        Description : Add/Update User
        Path : api/ea/user/save-user
        Params :    {
                        postParams:{
                            empId,
                            userPk,
                            userName,
                            fName,
                            lName,
                            mName,
                            emailId,
                            phCntryCode,
                            phoneNumber,
                            department,
                            designation,
                            division,
                            designationLevel,
                            userAccess,
                            contactType
                        }
                    }
    */
    public function actionSaveUser(){
        
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->empId) && !empty($resParam->empId) && isset($resParam->userName) && !empty($resParam->userName) && isset($resParam->fName) && !empty($resParam->fName) && !empty($resParam->phCntryCode) && isset($resParam->emailId) && !empty($resParam->emailId) && isset($resParam->phoneNumber) && !empty($resParam->phoneNumber) && isset($resParam->department) && !empty($resParam->department) && isset($resParam->designation) && !empty($resParam->designation)){
            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $save['empId'] = trim(Security::sanitizeInput($resParam->empId,'string_spl_char'));
            $save['userName'] = trim(Security::sanitizeInput($resParam->userName,'string_spl_char'));
            $save['fName'] = trim(Security::sanitizeInput($resParam->fName,'string_spl_char'));
            $save['emailId'] = $resParam->emailId;
            $save['phCntryCode'] = (string)$resParam->phCntryCode;
            $save['phoneNumber'] = trim(Security::sanitizeInput($resParam->phoneNumber,'number'));

            $save['lnCntryCode'] = (string)$resParam->lnPhoneCode;
            $save['lnPhoneNum'] = (string)trim(Security::sanitizeInput($resParam->lnPhoneNumber,'number'));
            $save['lnPhoneExt'] = (string)Security::sanitizeInput($resParam->lnPhoneExt,'number');
            
            $save['department'] = Security::sanitizeInput(implode(",",$resParam->department),'string_spl_char');

            $save['designation'] = Security::sanitizeInput($resParam->designation,'string_spl_char');
            //print_r($save['designation']);die();
            if(!empty($resParam->businessUnit))
            {
                $save['businessUnit'] = Security::sanitizeInput(implode(",",$resParam->businessUnit),'string_spl_char');
            }
            //$save['businessUnit'] = Security::sanitizeInput($resParam->businessUnit,'number');
            //$save['branchName'] = Security::sanitizeInput($resParam->branchName,'string_spl_char');
            $save['timezone'] = Security::sanitizeInput($resParam->timezone,'number');
            $save['forContact'] = $resParam->forContact;
            $save['nameofvalidation'] = $resParam->nameofvalidation;
            if($save['forContact'] == 1){
                $save['businessUnit'] = Security::sanitizeInput($resParam->businessUnit,'number');
            }
            $userAccess = $resParam->userAccess;
            
            $descText = self::getUserInsertionText('save',$resParam->contactType,$resParam->userPk);
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(1,$descText,$url,133);

            $usrPk = '';
            if(isset($resParam->userPk)){
                $usrPk = Security::sanitizeInput($resParam->userPk,'number');
            }
            if(isset($resParam->fromstake)){
                  $save['fromstake'] = Security::sanitizeInput($resParam->fromstake,'number');
            }

            if(isset($resParam->lName)){
                $save['lName'] = trim(Security::sanitizeInput($resParam->lName,'string_spl_char'));
            }
                
            if(isset($resParam->mName)){
                $save['mName'] = trim(Security::sanitizeInput($resParam->mName,'string_spl_char'));
            }else{
                $save['mName'] = '';
            }
                
            if(isset($resParam->division)){
                $save['division'] = Security::sanitizeInput($resParam->division,'string_spl_char');
            }else{
                $save['division'] = '';
            }
                
            if(isset($resParam->designationLevel) && $resParam->designationLevel > 0){
                $save['designationLevel'] = Security::sanitizeInput($resParam->designationLevel,'number');
            }

            //echo'<pre>';print_r($save);exit;

            if(!empty($save['empId']) && !empty($save['userName']) && !empty($save['fName']) && !empty($save['emailId']) && !empty($save['designation']) && (!isset($save['lName']) || (isset($save['lName']) && !empty($save['lName']))) && (empty($usrPk) || $usrPk > 0)) {
                if( $save['fromstake'] !=1){
                    /*Access Creation Formation*/
                    $userAccessArr = [];

                    foreach ($userAccess as $key => $ua) {
                        if(($ua->submodule > 0) && ($ua->type > 0)){
                            $userAccessArr[$ua->submodule] = (isset($userAccessArr[$ua->submodule]) && !empty($userAccessArr[$ua->submodule]))?$userAccessArr[$ua->submodule].','.$ua->type:$ua->type;
                        }
                    }
                    
                    $save['userAccess'] = $userAccessArr;
                    //print_r($save['userAccess']);die();
                }        
                    
                $save['addUserFromType'] = $resParam->addUserFromType;

                $afterSave = UsermstTbl::saveEnterpriseUserDetails($save, $usrPk);

                if(is_array($afterSave)){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                    $data = $afterSave;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }elseif($afterSave == 4 || $afterSave == 5 || $afterSave == 6 || $afterSave == 7 || $afterSave == 8 || $afterSave == 9 || $afterSave == 10){
                    switch($afterSave){
                        case 4:
                            $message = 'Username already exists."';
                            break;
                        case 5:
                            $message = 'Email ID already exists.';
                            break;
                        case 6:
                            $message = 'Employee ID already exists.';
                            break;
                        case 7:
                            $message = 'Employee ID, Email ID and Username already exists.';
                            break;
                        case 8:
                            $message = 'Username and Email ID  already exists.';
                            break;
                        case 9:
                            $message = 'Username and Employee ID already exists.';
                            break;
                        case 10:
                            $message = 'Email ID and Employee ID already exists.';
                            break;
                    }
                    $status = 104;
                }elseif($afterSave == 11){
                    $message = 'User is already deleted cannot approve user';
                    $status = 107;
                }elseif($afterSave == 12){
                    $message = 'mapped department is inactive';
                    $status = 108;
                }elseif($afterSave == 13){
                    $message = 'mapped department is deleted';
                    $status = 108;
                }elseif($afterSave == 14){
                    $message = 'mapped division is deleted';
                    $status = 109;
                }

            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }
        
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }



    public function actionCheckEmailExist() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
        $companypk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
    
        $emailexistdata = false;
         if(isset($data['stktype']) && !empty($data['stktype']) && $data['stktype'] != "undefined"){
             $stktype = $data['stktype'];
         }else{
             $stktype = \yii\db\ActiveRecord::getTokenData('reg_type',true);
         }       
        if(!empty($data)) {
            if(isset($data['email'])) {
                if(isset($companypk) && $companypk != '' && $companypk != null) {
                    $userExistValues = UsermstTbl::find()
                    ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk
                    = UM_MemberRegMst_Fk')
                     ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')                        
                    ->where('UM_EmailID = :UM_EmailID', [':UM_EmailID' => $data['email']])
                    ->andFilterWhere(['=','MemberCompMst_Pk',$companypk])
                    ->andFilterWhere(['=', 'mrm_stkholdertypmst_fk', $stktype])
                    ->andFilterWhere(['<>', 'UM_Status', 'D'])->exists();
                        if($userExistValues) {
                            $emailexistdata = true;
                        }
                } else {
                        $userexit = UsermstTbl::find()
                        ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                        ->where('lower(UM_EmailID) = :UM_EmailID', [':UM_EmailID' => $data['email']])
                        ->andFilterWhere(['<>', 'UserMst_Pk', $usrpk])
                        ->andFilterWhere(['=', 'mrm_stkholdertypmst_fk', $stktype])
                        ->andFilterWhere(['<>', 'UM_Status', 'D'])
                        ->exists();
                        if($userexit) {
                            $emailexistdata = true;
                        }
    
                    }

           
                return $this->asJson(['data' => $emailexistdata]);
            }
        }
    }
    public function actionAleadyverifiedmob(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
        $alerexits = UsermstTbl::find()->where('um_primobno = :mobno and um_mobileverified = 1',[':mobno'=>$data['mobilenum']])
        ->exists();
        if($alerexits){
            return $this->asJson(['data' => true]);
        } else {
            return $this->asJson(['data' => false]);
        }
       
    }
    public function actionChecksamemaild(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
        $alerexits = UsermstTbl::find()->where('lower(UM_EmailID) = :email and um_emailverified = 1',[':email'=>$data['email']])
        ->exists();
        if($alerexits){
            return $this->asJson(['data' => true]);
        } else {
            return $this->asJson(['data' => false]);
        }
       
    }
    public function actionCheckEmpIdExist() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
         if(isset($data['stktype']) && !empty($data['stktype']) && $data['stktype'] != "undefined"){
             $stktype = $data['stktype'];
         }else{
             $stktype = \yii\db\ActiveRecord::getTokenData('reg_type',true);
         }   
         $regpk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        if(!empty($data)) {
            if(isset($data['employeeid'])) {
                $userexit = UsermstTbl::find()
                    ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                    ->where('lower(UM_EmpId) = :UM_EmpId', [':UM_EmpId' => $data['employeeid']])
                    ->andFilterWhere(['<>', 'UserMst_Pk', $usrpk])
                    // ->andFilterWhere(['<>', 'UM_MemberRegMst_Fk', $regpk])
                    ->andFilterWhere(['=', 'UM_MemberRegMst_Fk', $regpk])
                    ->andFilterWhere(['=', 'mrm_stkholdertypmst_fk', $stktype])
                    ->andFilterWhere(['<>', 'UM_Status', 'D'])
                    ->exists();
                if($userexit){
                    return $this->asJson(['data' => true]);
                } else {
                    return $this->asJson(['data' => false]);
                }
            }
        }
    }
    
    public function actionCheckUsernameExist() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
        if(isset($data['stktype']) && !empty($data['stktype']) && $data['stktype'] != "undefined"){
            $stktype = $data['stktype'];
        }else{
            $stktype = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        }    
        if(!empty($data)) {
            if(isset($data['username'])) {
                $userexit = UsermstTbl::find()
                    ->where('lower(UM_LoginId) = :UM_LoginId', [':UM_LoginId' => $data['username']])
                    ->andFilterWhere(['<>', 'UserMst_Pk', $usrpk])
                    ->andFilterWhere(['<>', 'UM_Status', 'D'])
                    ->exists();
                if($userexit){
                    return $this->asJson(['data' => true]);
                } else {
                    return $this->asJson(['data' => false]);
                }
            }
        }
    }
    /*
        Description : get company department
        Path : api/ea/user/get-stakholder-department
        Params :    {
                        postParams:{
                            
                        }
                    }
    */

    public function actionGetStakholderDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(!empty($resParam->compPk)) {
            $mcpPk = Security::decrypt($resParam->compPk);
        } else {
            $mcpPk =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        }
        $mcpPk =  Security::sanitizeInput($mcpPk,'number');

        if($mcpPk > 0){
            $departmentDetails = DepartmentmstTbl::getAllCompanyDepartment($mcpPk);
            if(!empty($departmentDetails)){
                $data['departmentDetails'] = $departmentDetails;
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }
        }else{
            $message = $this->baseErrorMessage('sanitizeError');
            $status = 106;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    
    public function actionGetmaxusercount()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $stkRegPk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        $stkRegPk = Security::sanitizeInput($stkRegPk,'number');
        $maxuser = 1;
        
        $userListData = UsermstTbl::getStakeholdetUserList($userParams,$stkRegPk,'user');
        
        
        $premiumpack = Yii::$app->db->createCommand("SELECT gcpd_currpackagetype from gcpremiumdtls_tbl where gcpd_memberregmst_fk =".$resParam)->queryOne();
        
        if($premiumpack)
        {
            if($premiumpack['gcpd_currpackagetype'] == 2)
                $maxuser = 3;
            elseif($premiumpack['gcpd_currpackagetype'] == 3)
                $maxuser = 5;
        }
        $message = $this->baseErrorMessage('success');
        $status = 100;
        
        $data['totalcount'] = $userListData['totalcount'];   
        $data['maxuser'] = $maxuser ;
        
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
        
    }

    /*
        Description : List user details
        Path : api/ea/user/list-stakholder-users
        Params :    {
                        postParams:{
                            mcpPk,
                            page, 
                            size, 
                            deptName, 
                            deptStatus, 
                            column, 
                            direction
                        }
                    }
    */
    public function actionListStakholderUsers(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $stkRegPk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        $stkRegPk = Security::sanitizeInput($stkRegPk,'number');

        if($stkRegPk > 0){
            $userParams['page'] = isset($resParam->page)?$resParam->page:0;
            $userParams['size'] = isset($resParam->size)?$resParam->size: 15;
            $userParams['deptName'] = isset($resParam->deptName)?$resParam->deptName:'';
            $userParams['deptStatus'] = isset($resParam->deptStatus)?$resParam->deptStatus:'';
            $userParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
            $direction = isset($resParam->direction)?$resParam->direction:'';
            $userParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;
            $userParams['fetchFor'] = isset($resParam->fetchFor)?$resParam->fetchFor:'';

            $userListData = UsermstTbl::getStakeholdetUserList($userParams,$stkRegPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;

        }else{
            $message = $this->baseErrorMessage('sanitizeError');
            $status = 106;
        }

        return $this->asJson([
            'data' => $userListData['data'],
            'totalcount' => $userListData['totalcount'],
            'size' => $userListData['size'],
            'page' => $userListData['page'],
            'logo_url' => MembercompanymstTbl::getCompanyLogo(),
            'msg' => $message,
            'status' => $status,
        ]);
    }
    /*
        Description : List user details
        Path : api/ea/user/list-invited-user
        Params :    {
                        postParams:{
                            mcpPk,
                            page, 
                            size, 
                            deptName, 
                            deptStatus, 
                            column, 
                            direction
                        }
                    }
    */
    public function actionListInvitedUser(){
        $formdata = $_REQUEST;
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $userPk = Security::sanitizeInput($userPk,'number');

        if($userPk > 0){
            $userListData = \common\models\UserinvitedtlsTbl::getInvitedUserList($formdata,$userPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }else{
            $message = $this->baseErrorMessage('sanitizeError');
            $status = 106;
        }

        return $this->asJson([
            'data' => $userListData['data'],
            'totalcount' => $userListData['totalcount'],
            'size' => $userListData['size'],
            'page' => $userListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Updating / Deleting stakeholders of users
        Path : api/ea/user/update-stakholder-users
        Params :    {
                        postParams:{
                            userPk,
                            status
                        }
                    }
    */
    public function actionUpdateStakholderUsers(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            
            if($resParam->status == 'D'){
                $status = 'D';
                $descText = self::getUserInsertionText('delete',$resParam->businessUnit);
                $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
                \common\components\UserActivityLog::logUserActivity(3,$descText,$url,133);
            }elseif($resParam->status == 'I'){
                $status = 'A';
            }else{
                $status = 'I';
            }

            if($userPk > 0){
                $comments = '';
                if($resParam->status == 'D'){
                    $comments = $resParam->comments;
                }
                    $afterDelete = UsermstTbl::updateStatus($userPk, $status, $comments);
                if($afterDelete == 1){
                    $message = ($resParam->status == 'D') ? 'Deleted successfully' : $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }elseif($afterDelete == 4){
                    $message = $this->baseErrorMessage('activeInAnotherCompany');
                    $status = 104;
                }elseif($afterDelete == 5){
                    $message = $this->baseErrorMessage('invitedInAnotherCompany');
                    $status = 104;
                }elseif($afterDelete == 6){
                    $message = $this->baseErrorMessage('activeInSameCompany');
                    $status = 104;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetching details for updating users
        Path : api/ea/user/stk-update-user-details
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionStkUpdateUserDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');

            if($userPk > 0){
                $data = $stkUpdateUserDetails = UsermstTbl::stkUpdateUserDetails($userPk);
                $data['cntryCode'] = $stkUpdateUserDetails['mobilecc'];
                $data['mobileNo'] = $stkUpdateUserDetails['mobileNo'];
                $data['emailVerfied'] = $stkUpdateUserDetails['emailVerified'];
                $data['mobileVerified'] = $stkUpdateUserDetails['mobileVerified'];

                $userAccess = UserpermtrnTbl::getUserPermission($userPk,'2');

                $userAccessFormatin = [];
                foreach ($userAccess as $key => $ua) {
                    $modPk = $ua['bmm_basemodulemst_fk'].'_'.$ua['upt_basemodulemst_fk'];
                    $userAccessFormatin[$modPk] = json_decode($ua['upt_access']);
                }

                $stkPk = \yii\db\ActiveRecord::getTokenData('reg_type',true);
                $baseModules = StkholderaccessmstTbl::getModuleItsSubmodulebyStakholder($stkPk);

                $tmpMpk = '';
                $baseModulesArr = $moduleIdArr = $chekedAcess = [];
                $aC = $aR = $aU = $aD = $aA = $aDwn = $prevTempPk = '';
                $init = $prevInit = 0;
                foreach ($baseModules as $key => $bm) {
                    if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                        $tmpMpk = $bm['mPk'];
                        $baseModule['modules'] = $bm['mName'];
                        $baseModule['modulesinfocontent'] = $bm['minfo'];
                        $baseModule['module_id'] = $bm['mPk'];
                        $mAccess = explode(',',$bm['mAccess']);

                        $baseModule['create'] = in_array(1, $mAccess)?'N':'NIL';
                        $baseModule['read'] = in_array(2, $mAccess)?'N':'NIL';
                        $baseModule['update'] = in_array(3, $mAccess)?'N':'NIL';
                        $baseModule['delete'] = in_array(4, $mAccess)?'N':'NIL';
                        $baseModule['approval'] = in_array(5, $mAccess)?'N':'NIL';
                        $baseModule['download'] = in_array(6, $mAccess)?'N':'NIL';

                        $baseModule['extend'] = true;
                        $baseModule['parentEnable'] = true;
                        $baseModule['childEnable'] = false;
                        $baseModule['child'] = 1;
                        $baseModulesArr[] = $baseModule;
                        
                        $baseModulesArr[$prevInit]['aC'] = ($aC == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aR'] = ($aR == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aU'] = ($aU == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aD'] = ($aD == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aA'] = ($aA == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aDwn'] = ($aDwn == 'Y')?true:false;
                        
                        if(($aC == 'Y' || $aC=='') && ($aR == 'Y' || $aR=='') && ($aU == 'Y' || $aU=='') &&
                            ($aD == 'Y' || $aD=='') && ($aA == 'Y' || $aA=='') && ($aDwn == 'Y'|| $aDwn=='')) 
                        {
                            $baseModulesArr[$prevInit]['aAll'] = true;
                        } else {
                            $baseModulesArr[$prevInit]['aAll'] = false;
                        }
                        
                        // Above condition is for edit permission
                        
                        $aC = $aR = $aU = $aD = $aA = $aDwn = '';
                        $prevInit = $init;
                        $init +=1;
                    }

                    $baseSubModule['modules'] = $bm['smName'];
                    $baseSubModule['module_id'] = $modId = $bm['mPk'].'_'.$bm['smPk'];
                    $smAccess = explode(',',$bm['smAccess']);

                    $create = in_array(1, $smAccess)?'N':'NIL';
                    if($create != 'NIL'){
                        $baseSubModule['create'] = in_array(1, json_decode($userAccessFormatin[$modId]))?'Y':$create;
                        if($baseSubModule['create'] == 'Y' && ($aC == '' || $aC == 'Y')){
                            $aC = 'Y';
                        }else{
                            $aC = 'N';
                        }

                        if($baseSubModule['create'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_1',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>1
                            ];
                        }
                    }else{
                        $baseSubModule['create'] = 'NIL';
                    }

                    $read = in_array(2, $smAccess)?'N':'NIL';
                    if($read != 'NIL'){
                        $baseSubModule['read'] = in_array(2, json_decode($userAccessFormatin[$modId]))?'Y':$read;
                        if($baseSubModule['read'] == 'Y' && ($aR == '' || $aR == 'Y')){
                            $aR = 'Y';
                        }else{
                            $aR = 'N';
                        }
                        if($baseSubModule['read'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_2',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>2
                            ];
                        }
                    }else{
                        $baseSubModule['read'] = 'NIL';
                    }

                    $update = in_array(3, $smAccess)?'N':'NIL';
                    if($update != 'NIL'){
                        $baseSubModule['update'] = in_array(3, json_decode($userAccessFormatin[$modId]))?'Y':$update;
                        if($baseSubModule['update'] == 'Y' && ($aU == '' || $aU == 'Y')){
                            $aU = 'Y';
                        }else{
                            $aU = 'N';
                        }
                        if($baseSubModule['update'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_3',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>3
                            ];
                        }
                    }else{
                        $baseSubModule['update'] = 'NIL';
                    }

                    $delete = in_array(4, $smAccess)?'N':'NIL';
                    if($delete != 'NIL'){
                        $baseSubModule['delete'] = in_array(4, json_decode($userAccessFormatin[$modId]))?'Y':$delete;
                        if($baseSubModule['delete'] == 'Y' && ($aD == '' || $aD == 'Y')){
                            $aD = 'Y';
                        }else{
                            $aD = 'N';
                        }
                        if($baseSubModule['delete'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_4',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>4
                            ];
                        }
                    }else{
                        $baseSubModule['delete'] = 'NIL';
                    }

                    $approval = in_array(5, $smAccess)?'N':'NIL';
                    if($approval != 'NIL'){
                        $baseSubModule['approval'] = in_array(5, json_decode($userAccessFormatin[$modId]))?'Y':$approval;
                        if($baseSubModule['approval'] == 'Y' && ($aA == '' || $aA == 'Y')){
                            $aA = 'Y';
                        }else{
                            $aA = 'N';
                        }
                        if($baseSubModule['approval'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_5',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>5
                            ];
                        }
                    }else{
                        $baseSubModule['approval'] = 'NIL';
                    }

                    $download = in_array(6, $smAccess)?'N':'NIL';
                    if($download != 'NIL'){
                        $baseSubModule['download'] = in_array(6, json_decode($userAccessFormatin[$modId]))?'Y':$download;
                        if($baseSubModule['download'] == 'Y' && ($aDwn == '' || $aDwn == 'Y')){
                            $aDwn = 'Y';
                        }else{
                            $aDwn = 'N';
                        }
                        if($baseSubModule['download'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_6',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>6
                            ];
                        }
                    }else{
                        $baseSubModule['download'] = 'NIL';
                    }

                    $baseSubModule['parentEnable'] = false;
                    $baseSubModule['childEnable'] = true;
                    $baseSubModule['aC'] = false;
                    $baseSubModule['aR'] = false;
                    $baseSubModule['aU'] = false;
                    $baseSubModule['aD'] = false;
                    $baseSubModule['aA'] = false;
                    $baseSubModule['aDwn'] = false;
                    $baseSubModule['aAll'] = false;
                    $baseModulesArr[] = $baseSubModule;
                    $moduleIdArr[$bm['mPk']][] = $bm['mPk'].'_'.$bm['smPk'];

                    $init +=1;

                }
                
                if(!empty($baseModulesArr)){
                    $baseModulesArr[$prevInit]['aC'] = ($aC == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aR'] = ($aR == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aU'] = ($aU == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aD'] = ($aD == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aA'] = ($aA == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aDwn'] = ($aDwn == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aAll'] =  (($aC == 'Y' || !in_array(1, $mAccess)) && ($aR == 'Y' || !in_array(2, $mAccess)) && ($aU == 'Y' || !in_array(3, $mAccess)) && ($aD == 'Y' || !in_array(4, $mAccess)) && ($aA == 'Y' || !in_array(5, $mAccess)) && ($aDwn == 'Y' || !in_array(6, $mAccess)) )?true:false;
                }

                $data['baseModulesAccess'] = $baseModulesArr;
                $data['modSubModIds'] = $moduleIdArr;
                $data['checkedAccess'] = $chekedAcess;

                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionViewuserdetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data =  UsermstTbl::ViewUserDetails($userPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch User Details / Module / SubModule / Access Master / User Access
        Path : api/ea/user/fetch-user-details
        Params :    {
                        postParams:{
                            userPk // empty(userPk)? New : Update
                        }
                    }
    */
    public function actionFetchUserDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $userPk = '';
        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::sanitizeInput($resParam->userPk,'number');
        }
        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $stkPk = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        $cache = new \api\common\services\CacheBGI();
        
        if((!empty($mcpPk) && !empty($stkPk)) || $stkPk==1){
            if(!empty($userPk)){
                $userPk = Security::sanitizeInput($resParam->userPk,'number');
            }
            $mcpPk = Security::sanitizeInput($mcpPk,'number');

            if($mcpPk > 0 && (empty($userPk) || $userPk > 0)){
                if($userPk > 10){
                    $deptDet = DepartmentmstTbl::departmentDetails($userPk);
                    $data['deptDet'] = $deptDet;
                }
                $reqFields = ['accessmaster_pk','acm_accessname'];
                $accessMst = AccessmasterTbl::fetchAccessMaster('all',$reqFields);
                
                $accessArr = [];
                foreach ($accessMst as $key => $acm) {
                    $accessArr[$acm['accessmaster_pk']] = $acm['acm_accessname'];
                }
                $baseModules = StkholderaccessmstTbl::getModuleItsSubmodulebyStakholder($stkPk);
                $tmpMpk = '';
                $baseModulesArr = $moduleIdArr = [];
                foreach ($baseModules as $key => $bm) {
                    if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                        $tmpMpk = $bm['mPk'];
                        $baseModule['modules'] = $bm['mName'];
                        $baseModule['modulesinfocontent'] = $bm['minfo'];
                        $baseModule['module_id'] = $bm['mPk'];
                        $mAccess = explode(',',$bm['mAccess']);
                        $baseModule['create'] = in_array(1, $mAccess)?'N':'NIL';
                        $baseModule['read'] = in_array(2, $mAccess)?'N':'NIL';
                        $baseModule['update'] = in_array(3, $mAccess)?'N':'NIL';
                        $baseModule['delete'] = in_array(4, $mAccess)?'N':'NIL';
                        $baseModule['approval'] = in_array(5, $mAccess)?'N':'NIL';
                        $baseModule['download'] = in_array(6, $mAccess)?'N':'NIL';
                        $baseModule['extend'] = true;
                        $baseModule['parentEnable'] = true;
                        $baseModule['childEnable'] = false;
                        $baseModule['aC'] = false;
                        $baseModule['aR'] = false;
                        $baseModule['aU'] = false;
                        $baseModule['aD'] = false;
                        $baseModule['aA'] = false;
                        $baseModule['aDwn'] = false;
                        $baseModule['child'] = 1;
                        $baseModulesArr[] = $baseModule;
                    }

                    $baseSubModule['modules'] = $bm['smName'];
                    $baseSubModule['module_id'] = $bm['mPk'].'_'.$bm['smPk'];
                    $smAccess = explode(',',$bm['smAccess']);
                    $baseSubModule['create'] = in_array(1, $smAccess)?'N':'NIL';
                    $baseSubModule['read'] = in_array(2, $smAccess)?'N':'NIL';
                    $baseSubModule['update'] = in_array(3, $smAccess)?'N':'NIL';
                    $baseSubModule['delete'] = in_array(4, $smAccess)?'N':'NIL';
                    $baseSubModule['approval'] = in_array(5, $smAccess)?'N':'NIL';
                    $baseSubModule['download'] = in_array(6, $smAccess)?'N':'NIL';
                    $baseSubModule['parentEnable'] = false;
                    $baseSubModule['childEnable'] = true;
                    $baseSubModule['aC'] = false;
                    $baseSubModule['aR'] = false;
                    $baseSubModule['aU'] = false;
                    $baseSubModule['aD'] = false;
                    $baseSubModule['aA'] = false;
                    $baseSubModule['aDwn'] = false;
                    $baseModulesArr[] = $baseSubModule;
                    $moduleIdArr[$bm['mPk']][] = $bm['mPk'].'_'.$bm['smPk'];

                }

                $data['baseModules'] = $baseModulesArr;
                $data['modSubModIds'] = $moduleIdArr;
                $message = $this->baseErrorMessage('success');
                $status = 100;

            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch Company details / User Details
        Path : api/ea/user/fetch-user-company-details
        Params :    {
                        postParams:{
                            userPk // empty(userPk)? New : Update
                        }
                    }
    */
    public function actionFetchUserCompanyDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $stkCondition = ['UserMst_Pk'=>$resParam->userPk];
            $stkFields = ['UserMst_Pk', 'um_firstname', 'um_lastname', 'UM_Designation'];
            $userCompanyDetails = UsermstTbl::fetchCc($stkCondition, $stkFields,'one');
            $data['userCompanyDetails']['usrPk'] = $userCompanyDetails->UserMst_Pk;
            $data['userCompanyDetails']['fName'] = $userCompanyDetails->um_firstname;
            $data['userCompanyDetails']['lName'] = $userCompanyDetails->um_lastname;
            $data['userCompanyDetails']['designation'] = $userCompanyDetails->UM_Designation;
        }else{
            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $stkCondition = ['MemberCompMst_Pk'=>$mcpPk];
            $stkFields = ['MCM_CompanyName', 'MCM_crnumber'];
            $userCompanyDetails = MembercompanymstTbl::fetchCc($stkCondition, $stkFields,'one');
            $data['userCompanyDetails']['cmpName'] = $userCompanyDetails->MCM_CompanyName;
            $data['userCompanyDetails']['cmpRegNo'] = $userCompanyDetails->MCM_crnumber;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : Filter for Enterprise admin user and activity initial data
        Path : api/ea/user/enterprise-filter-initial-data
        Params :    {
                        postParams:{
                            
                        }
                    }
    */
    public function actionEnterpriseFilterInitialData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $from = isset($resParam->from)?$resParam->from:1;

        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $data['departmentDetails'] = DepartmentmstTbl::getAllCompanyDepartment($mcpPk,$from);
        $data['bunitData'] = MemcompsectordtlsTbl::fetchBunitData($mcpPk);
        $stkPk = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        $baseModules = StkholderaccessmstTbl::getModuleItsSubmodulebyStakholder($stkPk);

        $tmpMpk = '';
        $module = $subModule = [];
        $tmpMpkInitial = 0;
        foreach ($baseModules as $key => $bm) {

            if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                $tmpMpk = $bm['mPk'];
                $data['module'][] = [
                    'modulePk' => $bm['mPk'],
                    'moduleName' => $bm['mName']
                ];
                $tmpMpkInitial += 1;
            }

            if($tmpMpkInitial == 1){
                $data['subModule'][] = [
                    'subModulePk' => $bm['smPk'],
                    'subModuleName' => $bm['smName']
                ];
            }
            
        }

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : Enterprise Filter Submodule
        Path : api/ea/user/filter-submodule
        Params :    {
                        postParams:{
                            modulePk
                        }
                    }
    */
    public function actionFilterSubmodule(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->modulePk) && !empty($resParam->modulePk)){
            $modulePks = implode(',', $resParam->modulePk);
            $data['subModule'] = BasemodulemstTbl::getSubModulesOfMultipleModule($resParam->modulePk);
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }
    public function actionFilterDivisionbaseddept(){
        $response = [];
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->department) && !empty($resParam->department)){
            $businessunitList = \common\models\MemcompsectordtlsTbl::getBusinessUnitsdeptpk($resParam->department);
            foreach($businessunitList as $key => $businessUnit){
                $response[$key]['SectorMst_Pk'] = $businessUnit['MemCompSecDtls_Pk'];
                $response[$key]['SecM_SectorName'] = $businessUnit['mcsd_businessunitrefname'];
            }
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'divsions' => $response,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : Common Enterprise Filter
        Path : api/ea/user/enterprise-filter
        Params :    {
                        postParams:{
                            deptPks
                            modulePks
                            subModulePks
                            status
                            page
                            size
                            filterType
                            sortby
                        }
                    }
    */
    public function actionEnterpriseFilter(){
        //print_r("rf");die();
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        $filterType = isset($resParam->filterType)?$resParam->filterType:1;
        $filterParams['page'] = isset($resParam->page)?$resParam->page:0;
        $filterParams['size'] = isset($resParam->size)?$resParam->size: 15;

        $stkRegPk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        if($filterType == 2){
            $filterData = EnterpriseFilter::commonFilterEnterprise($resParam, $filterParams, $stkRegPk);
            return $this->asJson([
                'data' => $filterData['data'],
                'totalcount' => $filterData['totalcount'],
                'size' => $filterData['size'],
                'page' => $filterData['page'],
                'msg' => 'success',
                'status' => 100,
            ]);
        }else{
            $filterData = EnterpriseFilter::commonFilterMonitorLog($resParam, $stkRegPk);
            return $this->asJson([
                'data' => $filterData,
                'msg' => 'success',
                'status' => 100,
            ]);
        }

    }

    /*Error message creation*/
    function baseErrorMessage($type){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
            case 'activeInSameCompany':
                $resMessage = 'User already registered in same company';
                break;
            case 'activeInAnotherCompany':
                $resMessage = 'This user has already been registered in another company';
                break;
            case 'invitedInAnotherCompany':
                $resMessage = 'This user has already been invited by another company';
                break;
            case 'activewhiledelete':
                $resMessage = 'This user is in active state';
                break;
            case 'alreadydeleted':
                $resMessage = 'This user is already deleted';
                break;
        }
        return $resMessage;
    }
    
    /*
        Description : Common Enterprise Filter
        Path : api/ea/user/users-by-dept
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionUsersByDept(){ 
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        if(!empty($resParam->compid) && $resParam->compid != '' && $resParam->compid != 'undefined'){
            $mcpPk = Security::decrypt($resParam->compid);
            $getdata = \common\models\MembercompanymstTbl::findOne($mcpPk);
            $regpk =  $getdata->MCM_MemberRegMst_Fk;
        }else{
            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        }        

        $cache = new \api\common\services\CacheBGI();
        try{
            $cacheKey = 'departmentuser'.$mcpPk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \common\models\DepartmentmstTblQuery::departmenttblQueryCache();
                $departmentDetails = DepartmentmstTbl::getAllCompanyDepartment($mcpPk);
                $cache->store($cacheKey, $departmentDetails, $duration = 0 , $cacheQuery);
            } else {
                $departmentDetails = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $departmentDetails = DepartmentmstTbl::getAllCompanyDepartment($mcpPk);
        }
        
        
        foreach($departmentDetails as $key => $val){
            $userList = UsermstTbl::getAllUsersByDept($val['deptPk'],$regpk,$mcpPk,$resParam);
            if($userList){
                $res = [];
                $res['deptPk'] = $val['deptPk'];
                $res['deptName'] = $val['deptName'];
                $res['userList'] = $userList;
                array_push($data, $res);
            }
        }
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }
    
    /*
        Description : Common Enterprise Filter
        Path : api/ea/user/map-user-as-contact
        Params :    {
                        postParams:{
                        }
                    }
    */
    
    public function actionUsersByDeptbackend(){ 
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        $mcpPk =$resParam[0]->compk;
        $departmentDetails = DepartmentmstTbl::getAllCompanyDepartment($mcpPk);
        foreach($departmentDetails as $key => $val){
            $userList = UsermstTbl::getAllUsersByDeptbackend($val['deptPk'],$mcpPk);
            if($userList){
                $res = [];
                $res['deptPk'] = $val['deptPk'];
                $res['deptName'] = $val['deptName'];
                $res['userList'] = $userList;
                array_push($data, $res);
            }
        }
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }
    
    public function actionMapUserAsContact(){ 
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $userPk = $resParam->userPk ? $resParam->userPk : "";
        $businessUnitPk = $resParam->businessUnitPk ? $resParam->businessUnitPk : null;
        $descText = self::getUserInsertionText('map',$resParam->$businessUnitPk);
        $url = Yii::$app->request->baseUrl . "/" . Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(2, $descText, $url, 133);
        $data = [];
        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $mcpPk = Security::sanitizeInput($mcpPk,'number');
        
        $mapUser = UsermstTbl::mapUserAsContact($userPk,$businessUnitPk);
        if($mapUser && $mapUser !== 2){
            return $this->asJson([
                'data' => ' mapped successfully',
                'msg' => 'success',
                'status' => 100,
                'icon' => 'success'
            ]);
        }else{
            return $this->asJson([
                'data' => ($mapUser === 2) ? 'This User Already Mapped with the Business Unit' : $data,
                'msg' => 'failure',
                'status' => ($mapUser === 2) ? 102 : 101,
                'icon' => 'warning'
            ]);
        }
    }
    
    public function getUserInsertionText($insertionFor,$type = '',$pk = ''){
        switch($type){
            case 1:
                if($insertionFor == 'delete'){
                    return "Deleted company's Payment Contact  details.";
                }else if($insertionFor == 'map'){
                    return "User mapped as Payment Contact";
                }
                return !empty($pk) ? "Edited company's Payment Contact  details" : "Added company's Payment Contact details"; 
            case 2:
                if($insertionFor == 'delete'){
                    return 'Deleted company\'s Marketing  details.';
                }else if($insertionFor == 'map'){
                    return "User mapped as Marketing Contact";
                }
                return !empty($pk) ? "Edited company's Marketing details" : "Added company's Marketing details"; 
            case 3:
                if($insertionFor == 'delete'){
                    return 'Deleted company\'s Business Head  details.';
                }else if($insertionFor == 'map'){
                    return "User mapped as Business Head Contact";
                }
                return !empty($pk) ? "Edited company's Business Head details" : "Added company's Business Head details"; 
            case 4:
                if($insertionFor == 'delete'){
                    return 'Deleted company\'s Business Administration details.';
                }else if($insertionFor == 'map'){
                    return "User mapped as Business Administration Contact";
                }
                return !empty($pk) ? "Edited company's Business Administration details" : "Added company's Business Administration details"; 
            case 5:
                if($insertionFor == 'delete'){
                    return 'Deleted company\'s Finance details.';
                }else if($insertionFor == 'map'){
                    return "User mapped as Finance Contact";
                }
                return !empty($pk) ? "Edited company's Finance details" : "Added company's Finance details"; 
        }
    }
    
    /**
     * @SWG\Post(
     *     path="/ea/user/save-invited-user-dtls",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to store invited user details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="userdtls", type="object",
     *                  @SWG\Property(property="userpk", type="integer", example=""),
     *                  @SWG\Property(property="userinvite_pk", type="integer", example=""),
     *                  @SWG\Property(property="companypk", type="integer", example=""),
     *                  @SWG\Property(property="emp_id", type="string", example=2),
     *                  @SWG\Property(property="username", type="string", example=3),
     *                  @SWG\Property(property="firstname", type="string", example=3),
     *                  @SWG\Property(property="middlename", type="string", example=3),
     *                  @SWG\Property(property="lastname", type="string", example=3),
     *                  @SWG\Property(property="dob", type="string", example=3),
     *                  @SWG\Property(property="email", type="string", example=3),
     *                  @SWG\Property(property="mobilecode", type="string", example=3),
     *                  @SWG\Property(property="mobileno", type="string", example=3)
     *                  @SWG\Property(property="termsandconditions", type="string", example=3)
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveInvitedUserDtls(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $data = $request['userdtls'];
        $data['emailId'] = $request['emailId'];
        /*if(\common\components\Common::checRecaptchaV3($data['reCaptchaToken'],$data['action'])){*/
            $saved = UsermstTbl::saveInvitedUser($data);
            if($saved){
                // trigger dummy mail to user to set password
//                UsermstTbl::sendUserCreatedMail($saved,'registered');
                $msg['flag'] = 'S';
                $msg['msg'] = 'User registered successfully';
//                $msg['setPasswordLink'] = $saved->um_pwdresetlink;
            }else{
                $msg['flag'] = 'E';
                $msg['msg'] = 'Something went wrong';
            }
        /*}else {
            $msg['flag'] = 'C';
            $msg['msg'] = 'You are spammer ! Get the out';
        }*/
        return $this->asJson($msg);
    }
    
    /**
     * @SWG\Post(
     *     path="/ea/user/invitedtls",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to store invited user details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="userdtls", type="object",
     *                  @SWG\Property(property="userinvite_pk", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionInvitedtls(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $pk = Security::sanitizeInput($request['invitepk'], 'number',true);                                                                             
        if(!empty($pk) && is_numeric($pk) && $pk != 0) {
            $isValidUrlAndData = \common\components\User::checkValidInviteUrlOrNot($pk);
            if($pk && $isValidUrlAndData['urlStatus'] == "VALID"){
                $msg['flag'] = 'S';
                $msg['msg'] = 'success';
                $msg['items'] =  $isValidUrlAndData;
            }else if($isValidUrlAndData['urlStatus'] == "REGISTERED"){
                $msg['flag'] = 'AR'; //AR - Already Registered
                $msg['items'] =  $isValidUrlAndData;
                $msg['msg'] = 'Already Registered';     
            }else if($isValidUrlAndData['urlStatus'] == "EXPIRED"){
                $msg['flag'] = 'EP'; //EP - Expired
                $msg['msg'] = 'The link has been expired';
            }else if($isValidUrlAndData['urlStatus'] == "DELETED"){
                $msg['flag'] = 'DE'; //DE - Deleted
                $msg['msg'] = 'The link was deleted';
            }else{
                $msg['flag'] = 'E';
                $msg['msg'] = 'Something went wrong';
            }
        }else{
            $msg['flag'] = 'IU'; //IU - Invalid URL
            $msg['msg'] = 'Invalid URL';
        }
        return $this->asJson($msg);
    }
    
    /**
     * @SWG\Post(
     *     path="/ea/user/Inviteuser",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to store invite details and send invite mail.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="invite", type="object",
     *                  @SWG\Property(property="userinvite_pk", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionInviteuser(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $response = \common\components\User::checkInviteSecnarios($request['invite'],'');
        return $this->asJson($response);
    }
    
    /**
     * @SWG\Post(
     *     path="/ea/user/Deleteinvite",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to store invite details and send invite mail.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="invite", type="object",
     *                  @SWG\Property(property="userinvite_pk", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteinvite(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $response = \common\models\UserinvitedtlsTbl::deleteInvite($request['userinvite_pk']);
        return $this->asJson([
            'msg' => ($response) ? 'Deleted successfully' : 'Something went wrong',
            'status' => ($response) ? 1 : 0
        ]);
    }
    
    /**
     * @SWG\Post(
     *     path="/ea/user/resendinvitemail",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to store invite details and send invite mail.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="invite", type="object",
     *                  @SWG\Property(property="userinvite_pk", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionResendinvitemail(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $inviteDtl = \common\models\UserinvitedtlsTbl::resendInviteMail(Security::sanitizeInput($request['userinvite_pk'],'number',true));
//        echo "<pre>";
//        print_r($inviteDtl);
//        die;
        if($inviteDtl === 1 || $inviteDtl === 2){
            return $this->asJson([
                'msg' => ($inviteDtl == 1) ? $this->baseErrorMessage('activeInAnotherCompany') : $this->baseErrorMessage('invitedInAnotherCompany'),
                'status' => 2,
            ]); 
        }
        $response = \common\components\User::sendInviteMail($inviteDtl,true);
        return $this->asJson([
            'msg' => 'success',
            'status' => ($response) ? 1 : 0,
        ]);
    }
    
    
    /**
     * @SWG\Post(
     *     path="/ea/user/branchnamelist",
     *     tags={"Master Company Profile"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to list of branch names towards a company.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBranchnamelist(){
        $response = UsermstTbl::getBranchNamesByCompany();
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => ($response) ? $response : [],
        ]);
    }
    
    public function actionGetinsight(){
        $response = UsermstTbl::getUserInsight();
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => ($response) ? $response : [],
        ]);
    }
    public function actionDesignationlist(){
        $response = \api\modules\mst\models\DesignationmstTbl::designationList();
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => ($response) ? $response : [],
        ]);
    }
    public function actionRecentsearch(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $model = BasemodulemstTbl::find()
                ->select(['basemodulemst_pk'])
                ->where("bmm_name =:stringTxt", [':stringTxt' => $request['baseModule']])
                ->asArray()
                ->one();
        if($model){
            $recentDataArray= \common\models\RecentsearchdtlsTblQuery::getRecentData($model['basemodulemst_pk'],$request['searchType']);
            if($recentDataArray){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Get Data Successfully!',
                    'returndata' => $recentDataArray
                );
            }  else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'No Data Found',
                    'returndata' => null
                );
            }
        }  else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Not There Base Module in our Server',
                'returndata' => null
            );
        }
        return $result;
    }
    public function actionAddrecentsearch(){
        $rawBody = Yii::$app->request->getRawBody();
        $request = json_decode($rawBody, true);
        $model = BasemodulemstTbl::find()
                ->select(['basemodulemst_pk'])
                ->where("bmm_name =:stringTxt", [':stringTxt' => $request['baseModule']])
                ->asArray()
                ->one();
        if($model){
            $recentDataArray= \common\models\RecentsearchdtlsTblQuery::addRecentSearchData($model['basemodulemst_pk'],$request['searchType'],$request['searchTxt']);
            if($recentDataArray){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Data Added Successfully!',
                    'returndata' => null
                );
            }  else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'No Data Found',
                    'returndata' => null
                );
            }
        }  else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Not There Base Module in our Server',
                'returndata' => null
            );
        }
        return $result;
    }


    /*
        Description : List Module User Details
        Path : api/ea/user/fetch-module-user-details
        Params :    {
                        postParams:{
                            moduleId
                        }
                    }
    */
    public function actionFetchModuleUserDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->moduleId) && !empty($resParam->moduleId)){
            $moduleId = Security::sanitizeInput($resParam->moduleId,'number');
            $searchData = $resParam->searchData;
            $userDetails = UsermstTbl::moduleUserDetails($moduleId, $searchData);

            $formationArr = [];
            $prevDepartmentName = '';
            $keyVal = $userKeyVal = 0;

            foreach ($userDetails as $key => $userDetail) {
                if($prevDepartmentName == '' || $prevDepartmentName != $userDetail['departmentName']){
                    if(!empty($prevDepartmentName)){
                        $keyVal +=1;
                    }
                    $userKeyVal = 0;
                    $formationArr[$keyVal]['departmentName'] = $prevDepartmentName = $userDetail['departmentName'];
                }

                $formationArr[$keyVal]['UserDetails'][$userKeyVal] = [
                                                                        'userName' => $userDetail['fullName'],
                                                                        'designationName' => $userDetail['designation'],
                                                                        'userPk' => $userDetail['userPk']
                                                                    ];
                $userKeyVal +=1;
            }

            $data['userDetail'] = $formationArr;
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);        
    }

    /*
        Description : Update User Module Access
        Path : api/ea/user/save-user-module
        Params :    {
                        postParams:{
                            userPk,
                            userAccess
                        }
                    }
    */
    public function actionSaveUserModule(){
        
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk) && isset($resParam->userAccess) && !empty($resParam->userAccess)){
            
            $userAccess = $resParam->userAccess;
            $userPk = Security::decrypt($resParam->userPk);
            /*Access Creation Formation*/
            $userAccessArr = [];
            foreach ($userAccess as $key => $ua) {
                if(($ua->submodule > 0) && ($ua->type > 0)){
                    $userAccessArr[$ua->submodule] = (isset($userAccessArr[$ua->submodule]) && !empty($userAccessArr[$ua->submodule]))?$userAccessArr[$ua->submodule].','.$ua->type:$ua->type;
                }
            }
            $save['userAccess'] = $userAccessArr;
            $afterSave = UsermstTbl::saveEnterpriseModuleUserDetails($save, $userPk);
            

            if($afterSave){
                $message = $this->baseErrorMessage('success');
                $status = 100;
                $data = $afterSave;
            }else{
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    
    public function actionEnterpriseadmindashbord() {
        $rawBody = Yii::$app->request->getRawBody();
        $resParam = json_decode($rawBody, true);
        if(isset($resParam['dataVal']) && !empty($resParam['dataVal'])){
            $statusChanged = \common\models\UsermstTbl::EnterpriseAdminDashboard($resParam['dataVal']);
        }
        
        return $this->asJson([
            'msg' => ($statusChanged) ? 'success' : 'failure',
            'status' => ($statusChanged) ? 1 : 0,
        ]);
    }

    public function actionDontshowstatus() {
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $model = UsermstTbl::findOne($userpk);
        
        return $this->asJson([
            'msg' => ($model) ? 'success' : 'failure',
            'status' => $model->um_isdontshowagain,
        ]);
    }

    /*
        Description : Enterprise COunt
        Path : api/ea/user/fetch-enterprise-count
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionFetchEnterpriseCount(){
        
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $data = UsermstTbl::getEnterpriseCount();
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch User Details / Module / SubModule / Access Master / User Access
        Path : api/ea/user/fetch-user-data
        Params :    {
                        postParams:{
                            userPk // empty(userPk)? New : Update
                        }
                    }
    */
    public function actionFetchUserData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];        

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data['data'] = UsermstTbl::fetchUserData($userPk);
                $mcpPk =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $data['uploadUrl'] = Drive::generateUrl($data['data']['um_userdp'],$mcpPk,$userPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    /**
     * @SWG\Post(
     *     path="/ea/user/getuserdata",
     *     tags={"User"},
     *     produces={"application/json"},
     *     summary="Get User Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="userPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetuserdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userPk = Security::decrypt($formdata['userPk']);
        $userPk = Security::sanitizeInput($userPk, "number");
        if ($userPk) {
            $data = \common\models\UsermstTblQuery::getUserData($userPk);
            return $data ? $data : ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'E', 'status' => false];
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'flag' => 'E', 'status' => false];
        }
    }
    public function actionGetuserpermissiondet(){
        $request_body = file_get_contents('php://input');
        $resParam = json_decode($request_body,true);
        $userPk =  Security::decrypt($resParam['idsno']);
        $userPk = Security::sanitizeInput($userPk, "number");
        $stkPk = $resParam['stktype'];
        $userpermissiondet = \common\models\BasemodulemstTbl::getuserpermissionview($stkPk,$userPk);
       return $this->asJson([
            'data' => $userpermissiondet,
            'msg' => "success",
            'status' => 100
        ]);
    }
    public function actionCheckuserismapped(){
        $request_body = file_get_contents('php://input');
        $resParam = json_decode($request_body,true);
        $userid =  Security::decrypt($resParam['userId']);
        if($userid == ''){
            return $this->asJson([
                'data' => false,
                'msg' => 'Invalid params',
                'status' => 101,
            ]);
        }
        $userData = \common\models\UsermstTblQuery::getMappedUserInfo($userid);
        return $this->asJson([
            'data' => $userData,
            'msg' => 'Success',
            'status' => 100,
        ]);
        
    }
}
