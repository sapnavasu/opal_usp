<?php

namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\MenumstTbl;
use common\models\StkholderaccessmstTbl;
use common\models\StkholdertypmstTbl;
use common\models\DepartmentmstTbl;
use common\models\UsermstTbl;

/*
    Response Status Code Error
    100    -   Success
    101    -   Param's Missing
    102    -   Failure Or Warning Error
    103    -   Db Error
    104    -   Data Not Available || Data Already Available
    105    -   Data value mismatch
*/
class MenumasterController extends MasterController
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
        Path : api/mst/menumaster/save-menu
        Description : Add/Update menu master
        Params :    {
                        postParams:{
                            menuPk,
                            stakeholderType,
                            menuName,
                            rootMenu,
                            modSubModFk,
                            menuIcon,
                            menuUrl,
                            menuOrder,
                            menuType,
                            menuToolTip,
                            menuStatus                           
                        }
                    }
    */

    public function actionSaveMenu(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        if(isset($resParam->stakeholderType) && !empty($resParam->stakeholderType) && isset($resParam->menuName) && !empty($resParam->menuName) && isset($resParam->rootMenu) && isset($resParam->modSubModFk) && !empty($resParam->modSubModFk) && isset($resParam->menuOrder) && !empty($resParam->menuOrder) && isset($resParam->menuType) && !empty($resParam->menuType)){
            $menuPk = Security::decrypt($resParam->menuPk);
            $menuPk = Security::sanitizeInput($menuPk,'number');
            $save['stakeholderType'] = Security::sanitizeInput($resParam->stakeholderType,'number');
            $save['menuName'] = Security::sanitizeInput($resParam->menuName,'string');
            $save['rootMenu'] = Security::sanitizeInput($resParam->rootMenu,'number');
            $save['modSubModFk'] = Security::sanitizeInput($resParam->modSubModFk,'number');
            $save['menuIcon'] = '';
            if(isset($resParam->menuIcon)){
                $save['menuIcon'] = implode(',', $resParam->menuIcon);
            }
            if(isset($resParam->menuUrl) && !empty($resParam->menuUrl)){
                $save['menuUrl'] = Security::sanitizeInput($resParam->menuUrl,'string_spl_char');
            }
            $save['menuOrder'] = Security::sanitizeInput($resParam->menuOrder,'number');
            $save['menuType'] = '';
            if(is_array($resParam->menuType)){
                $save['menuType'] = implode(',', $resParam->menuType);
            }
            if(isset($resParam->menuToolTip) && !empty($resParam->menuToolTip)){
                $save['menuToolTip'] = Security::sanitizeInput($resParam->menuToolTip,'string');
            }
        	$save['menuStatus'] = ($resParam->menuStatus == true)?1:2;
            $afterSave = MenumstTbl::saveMenu($save,$menuPk);

            if($afterSave == 1){
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }elseif($afterSave == 2){
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }elseif($afterSave == 3){
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }elseif($afterSave == 4){
                $message = $this->baseErrorMessage('menuNameAvailable');
                $status = 104;
            }elseif($afterSave == 5){
                $message = $this->baseErrorMessage('maxLevelReached');
                $status = 104;
            }elseif($afterSave == 6){
                $message = $this->baseErrorMessage('menuOrderAvailable');
                $status = 104;
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
        Path : api/mst/menumaster/get-menu-modules
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            stkholderType                        
                        }
                    }
    */
    public function actionGetMenuModules(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->stkholderType) && !empty($resParam->stkholderType)){
            $stkholderType = Security::decrypt($resParam->stkholderType);
            $stkholderTypePk = Security::sanitizeInput($stkholderType,'number');
            if($stkholderTypePk > 0){
                $data['menuDetails'] = MenumstTbl::getMstMenuList($stkholderTypePk);
                $data['modSmodDetails'] = StkholderaccessmstTbl::getModSubmodList($stkholderTypePk);
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
        Path : api/mst/menumaster/get-menu-list
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            page,
                            size,
                            stkholderType,
                            menuName,
                            moduleName,
                            status,
                            menuType                    
                        }
                    }
    */
    public function actionGetMenuList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $menuParams['page'] = isset($resParam->page)?$resParam->page:0;
        $menuParams['size'] = isset($resParam->size)?$resParam->size:10;
        $menuParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $menuParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $menuParams['stkholderType'] = (isset($resParam->stkholderType) && !empty($resParam->stkholderType))?$resParam->stkholderType:'';
        $menuParams['menuName'] = (isset($resParam->menuName) && !empty($resParam->menuName))?$resParam->menuName:'';
        $menuParams['moduleName'] = (isset($resParam->moduleName) && !empty($resParam->moduleName))?$resParam->moduleName:'';
        $menuParams['status'] = (isset($resParam->status) && !empty($resParam->status))?$resParam->status:'';
        $menuParams['menuType'] = (isset($resParam->menuType) && !empty($resParam->menuType))?$resParam->menuType:'';

        $meunListData = MenumstTbl::getMenuListData($menuParams);

        $menuArr = [];
        $menuTypeArr = [
            'L'=>'Left',
            'R'=>'Right',
            'T'=>'Top',
            'B'=>'Bottom'
        ];
        foreach ($meunListData['data'] as $key => $meunListDt) {
            $menuArr[$key] = $meunListDt;
            $menuType = explode(',', $meunListDt['menuType']);
            $menuArr[$key]['menuType'] = [];
            foreach ($menuType as $key1 => $mt) {
                $menuArr[$key]['menuType'][] = $menuTypeArr[$mt];
            }
            
        }

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $menuArr,
            'totalcount' => $meunListData['totalcount'],
            'size' => $meunListData['size'],
            'page' => $meunListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mst/menumaster/fetch-menu-detail
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            menuPk                   
                        }
                    }
    */
    public function actionFetchMenuDetail(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->menuPk) && !empty($resParam->menuPk)){
            $menuPk = Security::decrypt($resParam->menuPk);
            $menuPk = Security::sanitizeInput($menuPk,'number');
            if($menuPk > 0){
                $menuRes = MenumstTbl::getMenuDetail($menuPk);
                if($menuRes[0] == 1){
                    $data['menuDetail'] = $menuDetail = $menuRes[1];
                    $data['menuDetail']['menuType'] = explode(',', $menuDetail['menuType']);
                    if(!empty($menuDetail['menuIcon'])){
                        $data['menuDetail']['menuIcon'] = explode(',', $menuDetail['menuIcon']);
                    }else{
                        $data['menuDetail']['menuIcon'] = [];
                    }

                    $data['stkholderTypeDetails'] =  StkholdertypmstTbl::getStkholderTypes();

                    $data['menuDetails'] = MenumstTbl::getMstMenuList($menuDetail['stkholderType']);
                    $data['modSmodDetails'] = StkholderaccessmstTbl::getModSubmodList($menuDetail['stkholderType']);

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
        Path : api/mst/menumaster/change-menu-status
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            menuPk,
                            status                   
                        }
                    }
    */
    public function actionChangeMenuStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->menuPk) && !empty($resParam->menuPk) && isset($resParam->status) && !empty($resParam->status)){
            $menuPk = Security::decrypt($resParam->menuPk);
            $menuPk = Security::sanitizeInput($menuPk,'number');
            $status = Security::sanitizeInput($resParam->status,'number');
            if($menuPk > 0 && $status > 0){
                $afterUpdate = MenumstTbl::changeStatus($menuPk, $status);

                if($afterUpdate == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterUpdate == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterUpdate == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
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
        Path : api/mst/menumaster/multiple-delete
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            menuPks                   
                        }
                    }
    */
    public function actionMultipleDelete(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->menuPks) && !empty($resParam->menuPks)){
            $menuPks = Security::decrypt($resParam->menuPks);
            $menuPks = explode(',', $menuPks);
            
            foreach ($menuPks as $key => $menuPk) {
                $afterDelete = MenumstTbl::changeStatus($menuPk, 3);
            }
            $message = $this->baseErrorMessage('success');
            $status = 100;
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
        Path : api/mst/menumaster/by-user
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            sortDept            
                        }
                    }
    */
    public function actionByUser(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $companyPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $deptSorting = (isset($resParam->sortDept) && ($resParam->sortDept == true))?SORT_ASC:SORT_DESC;
        
        
        $data['departmentDetails'] = $departmentDetails = DepartmentmstTbl::getAllCompanyDepartmentAndUser($companyPk, $deptSorting);
        $data['deptPk'] = $deptPk = $departmentDetails[0]['deptPk'];

        $userCount = 0;
        foreach ($departmentDetails as $key => $departmentDetail) {
            $userCount += $departmentDetail['userCount'];
        }
        $userSorting = SORT_ASC;
        $data['userDetails'] = $userDetails = UsermstTbl::getAllUsersByDepts($deptPk, $userSorting);
        $usrPk = $userDetails[0]['usrPk'];
        $data['userDetail'] = UsermstTbl::getUserData($usrPk);
        $data['userDetail']['createdOn'] = date('d-m-Y', strtotime($data['userDetail']['createdOn']));
        $data['userCount'] = $userCount;

        $message = 'success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mst/menumaster/get-user-details
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            deptPk,
                            sortUser                   
                        }
                    }
    */
    public function actionGetUserDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::decrypt($resParam->deptPk);
            $deptPk = Security::sanitizeInput($deptPk,'number');
            if($deptPk > 0){
                $searchData = (isset($resParam->searchData) && !empty($resParam->searchData))?$resParam->searchData:'';

                $userSorting = (isset($resParam->sortUser) && ($resParam->sortUser == false))?SORT_DESC:SORT_ASC;
                $data['userDetails'] = $userDetails = UsermstTbl::getAllUsersByDepts($deptPk, $userSorting, $searchData);
                $usrPk = $userDetails[0]['usrPk'];
                $data['userDetail'] = UsermstTbl::getUserData($usrPk);
                $data['userDetail']['createdOn'] = date('d-m-Y', strtotime($data['userDetail']['createdOn']));
                $message = 'success';
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
        Path : api/mst/menumaster/get-user-detail
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            userPk                   
                        }
                    }
    */
    public function actionGetUserDetail(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            if($userPk > 0){
                $data['userDetail'] = UsermstTbl::getUserData($userPk);
                $data['userDetail']['createdOn'] = date('d-m-Y', strtotime($data['userDetail']['createdOn']));
                $message = 'success';
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
        Path : api/mst/menumaster/by-module
        Description : Fetch menu details
        Params :    {
                        postParams:{
                                               
                        }
                    }
    */
    public function actionByModule(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $data['stkholderTypeDetails'] = $stkholderType =  StkholdertypmstTbl::getSesStkholderTypes();
        $data['stkholdertypePk'] = $stkholdertypePk = $stkholderType[0]['stkholdertypmst_pk'];

        if($stkholdertypePk == 1){
            $data['type'] = '1';
            $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,1);
        }elseif($stkholdertypePk == 9 || $stkholdertypePk == 11){
            $data['type'] = '2';
            $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,2);
        }elseif($stkholdertypePk == 6 || $stkholdertypePk == 7){
            $data['type'] = '3';
            $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,3);
        }else{
            $data['type'] = '';
            $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesList($stkholdertypePk);
        }

        $moduleCount = 0;
        foreach ($stkholderType as $key => $stkholderTyp) {
            $moduleCount += $stkholderTyp['moduleCount'];
        }

        $data['overAllModuleCount'] = $moduleCount;
        $message = 'success';
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mst/menumaster/by-stk-module
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            stkholdertypePk,
                            searchData
                            sortMod               
                        }
                    }
    */
    public function actionByStkModule(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->stkholdertypePk) && !empty($resParam->stkholdertypePk)){
            $stkholdertypePk = Security::decrypt($resParam->stkholdertypePk);
            $stkholdertypePk = Security::sanitizeInput($stkholdertypePk,'number');
            if($stkholdertypePk > 0){
                $searchData = (isset($resParam->searchData) && !empty($resParam->searchData))?$resParam->searchData:'';

                $sortMod = (isset($resParam->sortMod) && ($resParam->sortMod == false))?SORT_DESC:SORT_ASC;


                if($stkholdertypePk == 1){
                    $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,1, $searchData, $sortMod);
                }elseif($stkholdertypePk == 9 || $stkholdertypePk == 11){
                    $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,2, $searchData, $sortMod);
                }elseif($stkholdertypePk == 6 || $stkholdertypePk == 7){
                    $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesTypeList($stkholdertypePk,3, $searchData, $sortMod);
                }else{
                    $data['moduleDetails'] = StkholderaccessmstTbl::getStkModulesList($stkholdertypePk, $searchData, $sortMod);
                }

                $message = 'success';
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
        Path : api/mst/menumaster/domain-stakeholders
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            domainType          
                        }
                    }
    */
    public function actionDomainStakeholders(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->domainType) && !empty($resParam->domainType)){
            $domainType = Security::decrypt($resParam->domainType);
            $domainType = Security::sanitizeInput($domainType,'number');
            if($domainType > 0){
                $data['domainStkDetails'] = $domainStkDetails = StkholdertypmstTbl::getDomainStakholder($domainType);
                $data['stkholdertypePk'] = $stkholdertypePk = $domainStkDetails[0]['stkholdertypmst_pk'];
                $data['domainType'] = $domainType;
                $data['configurationDetail'] = StkholderaccessmstTbl::getGeneralModuleList($stkholdertypePk, $domainType);
                $message = 'success';
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
        Path : api/mst/menumaster/other-configuration
        Description : Fetch menu details
        Params :    {
                        postParams:{
                            domainType,
                            stkType
                        }
                    }
    */
    public function actionOtherConfiguration(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->domainType) && !empty($resParam->domainType)){
            $domainType = Security::decrypt($resParam->domainType);
            $domainType = Security::sanitizeInput($domainType,'number');
            if($domainType > 0){
                $stkPk = Security::decrypt($resParam->stkType);
                $stkPk = Security::sanitizeInput($stkPk,'number');
                if($stkPk > 0){
                    $stkholdertypePk = $stkPk;
                }else{
                    $stkholdertypePk = \yii\db\ActiveRecord::getTokenData('reg_type',true);
                }

                $data['configurationDetail'] = StkholderaccessmstTbl::getGeneralModuleList($stkholdertypePk, $domainType);
                $message = 'success';
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


    /*Error message creation*/
    function baseErrorMessage($type){
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
            case 'menuNameAvailable':
                $resMessage = 'Menu name is already available';
                break;
            case 'menuOrderAvailable':
                $resMessage = 'Menu order is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
            case 'greaterCount':
                $resMessage = 'Maximum upload count is reached';
                break;
            case 'maxLevelReached':
                $resMessage = 'Menu max level is reached';
                break;
        }
        return $resMessage;
    }
}
