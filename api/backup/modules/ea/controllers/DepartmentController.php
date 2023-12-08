<?php

namespace api\modules\ea\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \common\models\DepartmentmstTbl;
use \common\models\MemcompservicedtlsTbl;
use \common\models\BasemodulemstTbl;
use \common\models\StkholderaccessmstTbl;
use \common\models\AccessmasterTbl;
use \common\models\UserpermtrnTbl;
use \common\models\MemcompsectordtlsTbl;

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
class DepartmentController extends MasterController
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
        Description : Add/Update Department
        Path : api/ea/department/save-department
        Params :    {
                        postParams:{
                            deptPk,
                            mcpPk,
                            deptName,
                            deptStatus,
                            deptAccess,
                        }
                    }
    */

    public function actionSaveDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk) && isset($resParam->deptName) && !empty($resParam->deptName) && isset($resParam->deptStatus) && !empty($resParam->deptStatus)){
            $deptPk = '';
            if(!empty($resParam->deptPk)){
                $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
            }
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);
            $save['mcpPk'] = Security::sanitizeInput($resParam->mcpPk,'number');
            $save['deptName'] = Security::sanitizeInput($resParam->deptName,'string_spl_char');
            $save['deptStatus'] = Security::sanitizeInput($resParam->deptStatus,'number');
            $deptAccess = $resParam->deptAccess;

            if((empty($deptPk) || $deptPk > 0) && $save['mcpPk'] > 0 && !empty($save['deptName']) && $save['deptStatus'] > 0){

                /*Access Creation Formation*/
                $deptAccessArr = [];
                foreach ($deptAccess as $key => $da) {
                    if(($da->submodule > 0) && ($da->type > 0)){
                        $deptAccessArr[$da->submodule] = (isset($deptAccessArr[$da->submodule]) && !empty($deptAccessArr[$da->submodule]))?$deptAccessArr[$da->submodule].','.$da->type:$da->type;
                    }
                }
                $save['deptAccess'] = $deptAccessArr;

                $afterSave = DepartmentmstTbl::saveDepartment($save,$deptPk);
                $data['deptPk'] = $afterSave['deptPk'];

                if($afterSave['ret'] == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave['ret'] == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave['ret'] == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }elseif($afterSave['ret'] == 4){
                    $message = $this->baseErrorMessage('smAlreadyAvailable');
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
        Description : Delete Department
        Path : api/ea/department/delete-department
        Params :    {
                        postParams:{
                            deptPk
                        }
                    }
    */
    public function actionDeleteDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
            if(!empty($deptPk) && $deptPk > 0){
                $afterDelete = DepartmentmstTbl::deleteDepartment($deptPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }else{
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
        Description : List Department
        Path : api/ea/department/list-department
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
    public function actionListDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = $deptParams = [];

        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk)){
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);
            $mcpPk = Security::sanitizeInput($resParam->mcpPk,'number');
            if($mcpPk > 0){
                $deptParams['page'] = isset($resParam->page)?$resParam->page:0;
                $deptParams['size'] = isset($resParam->size)?$resParam->size:10;
                $deptParams['deptName'] = isset($resParam->deptName)?$resParam->deptName:'';
                $deptParams['deptStatus'] = isset($resParam->deptStatus)?$resParam->deptStatus:'';
                $deptParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
                $direction = isset($resParam->direction)?$resParam->direction:'';
                $deptParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

                $deptListData = DepartmentmstTbl::getDepartmentList($deptParams,$mcpPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('missingFields');
                $status = 101;
            }
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $deptListData['data'],
            'totalcount' => $deptListData['totalcount'],
            'size' => $deptListData['size'],
            'page' => $deptListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch Department Details / Module / SubModule / Access Master / Department Access
        Path : api/ea/department/fetch-department-details
        Params :    {
                        postParams:{
                            deptPk // empty(deptPk)? New : Update
                        }
                    }
    */
    public function actionFetchDepartmentDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $deptPk = '';
        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
        }
        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $stkPk = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        if(isset($mcpPk) && !empty($mcpPk) && isset($stkPk) && !empty($stkPk)){
            if(!empty($deptPk)){
                $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
            }
            $mcpPk = Security::sanitizeInput($mcpPk,'number');

            if($mcpPk > 0 && (empty($deptPk) || $deptPk > 0)){
                if($deptPk > 10){
                    $data['deptDet'] = DepartmentmstTbl::departmentDetails($deptPk);
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
                    $baseSubModule['create'] = in_array(1, $smAccess)?'N':'N';
                    $baseSubModule['read'] = in_array(2, $smAccess)?'N':'N';
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
        Description : Change the status of the department and deletd status also changes here
        Path : api/ea/department/change-status
        Params :    {
                        postParams:{
                            deptPk,
                            deptStatus
                        }
                    }
    */
    public function actionChangeStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
            $deptStatus = Security::sanitizeInput($resParam->deptStatus,'number');
            if(!empty($deptPk) && $deptPk > 0 && !empty($deptStatus) && $deptStatus > 0){
                $deptStatus = ($deptStatus == 1)?2:(($deptStatus == 2)?1:3);
                $afterChange = DepartmentmstTbl::changeStatusDepartment($deptPk, $deptStatus);

                if($afterChange == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterChange == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }else{
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
        Description : Fetch Department Details / Module / SubModule / Access Master / Department Access
        Path : api/ea/department/update-department-details
        Params :    {
                        postParams:{
                            deptPk // empty(deptPk)? New : Update
                        }
                    }
    */
    public function actionUpdateDepartmentDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $stkPk = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        if(isset($mcpPk) && !empty($mcpPk) && isset($stkPk) && !empty($stkPk) && isset($deptPk) && !empty($deptPk)){
            $deptPk = Security::sanitizeInput($resParam->deptPk,'number');
            $mcpPk = Security::sanitizeInput($mcpPk,'number');

            if($mcpPk > 0 && $deptPk > 0){
                $data['deptDet'] = DepartmentmstTbl::departmentDetails($deptPk);

                $userAccess = UserpermtrnTbl::getUserPermission($deptPk);
                
                $userAccessFormatin = [];
                foreach ($userAccess as $key => $ua) {
                    $modPk = $ua['bmm_basemodulemst_fk'].'_'.$ua['upt_basemodulemst_fk'];
                    $userAccessFormatin[$modPk] = json_decode($ua['upt_access']);
                }

                $baseModules = StkholderaccessmstTbl::getModuleItsSubmodulebyStakholder($stkPk);
                $tmpMpk = '';
                $baseModulesArr = $moduleIdArr = $chekedAcess = [];
                $aC = $aR = $aU = $aD = $aA = $aDwn = $prevTempPk = '';
                $init = $prevInit = 0;

                foreach ($baseModules as $key => $bm) {
                    if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                        $tmpMpk = $bm['mPk'];
                        $baseModule['modules'] = $bm['mName'];
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

                        $aC = $aR = $aU = $aD = $aA = $aDwn = '';
                        $prevInit = $init;
                        $init +=1;
                    }

                    $baseSubModule['modules'] = $bm['smName'];
                    $baseSubModule['module_id'] = $modId = $bm['mPk'].'_'.$bm['smPk'];
                    $smAccess = explode(',',$bm['smAccess']);

                   $create = in_array(1, $smAccess)?'N':'NIL';
                    if($create != 'NIL' && !empty($userAccessFormatin[$modId])){
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
                    if($read != 'NIL' && !empty($userAccessFormatin[$modId])){
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
                    if($update != 'NIL' && !empty($userAccessFormatin[$modId])){
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
                    if($delete != 'NIL' && !empty($userAccessFormatin[$modId])){
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
                    if($approval != 'NIL' && !empty($userAccessFormatin[$modId])){
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
                    if($download != 'NIL' && !empty($userAccessFormatin[$modId])){
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
    
    public function actionGetactivedept(){
        $data = DepartmentmstTbl::getAllActiveDepartments();
        return $this->asJson([
            'items' => ($data) ? $data : [],
            'msg' => 'success',
            'status' => 1,
        ]);
    }
    
    public function actionGetdefaultdept(){
        $data = DepartmentmstTbl::getDefaultDepartments();
        return $this->asJson([
            'items' => ($data) ? $data : [],
            'msg' => 'success',
            'status' => 1,
        ]);
    }

    /* Business unit department */

    /*
        Description : Add/Update Business unit Department
        Path : api/ea/department/save-bunit-department
        Params :    {
                        postParams:{
                            deptPk,
                            deptName,
                            deptBunit
                        }
                    }
    */
    public function actionSaveBunitDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->deptName) && !empty($resParam->deptName) && isset($resParam->deptBunit) && !empty($resParam->deptBunit)){
            $deptPk = Security::decrypt($resParam->deptPk);
            $deptPk = Security::sanitizeInput($deptPk,'number');
            $save['cmpPK'] = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
            $save['deptName'] = Security::sanitizeInput($resParam->deptName,'string_spl_char');
            $deptBunit = implode(',', $resParam->deptBunit);
            $save['deptBunit'] = $deptBunit;
            $save['bUnit'] = $resParam->deptBunit;

            $afterSave = DepartmentmstTbl::saveBunitDepartment($save, $deptPk);
            $alreadyDeptName = '';
            if(!empty($afterSave['alreadyDeptArr'])){
                $alreadyDeptName = implode(', ', $afterSave['alreadyDeptArr']);
            }
            if($afterSave['ret'] == 1){
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }elseif($afterSave['ret'] == 2){
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }elseif($afterSave['ret'] == 3){
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }elseif($afterSave['ret'] == 4){
                $message = '"'.$alreadyDeptName.'" '.$this->baseErrorMessage('smAlreadyAvailable');
                $message = 'You have already created a Department with the same  Department Name and Division(s)';
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
        Description : List Business unit Department
        Path : api/ea/department/list-bunit-department
        Params :    {
                        postParams:{
                            mcpPk,
                            page, 
                            size,
                            keyworsSrh,
                            deptPks,
                            deptStatus,
                            bunitPks, 
                            column, 
                            direction,
                            deptName
                        }
                    }
    */
    public function actionListBunitDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $deptParams['page'] = isset($resParam->page)?$resParam->page:0;
        $deptParams['size'] = isset($resParam->size)?$resParam->size:15;
        $deptParams['keyworsSrh'] = isset($resParam->keyworsSrh)?$resParam->keyworsSrh:'';
        $deptParams['deptPks'] = isset($resParam->deptPks)?$resParam->deptPks:'';
        $deptParams['bunitPks'] = isset($resParam->bunitPks)?$resParam->bunitPks:'';
        $deptParams['deptStatus'] = isset($resParam->deptStatus)?$resParam->deptStatus:'';
        $deptParams['deptName'] = isset($resParam->deptName)?$resParam->deptName:'';
        $deptParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $deptParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;
        
        $deptListData = DepartmentmstTbl::getBunitDepartmentList($deptParams);
        
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $deptListData['data'],
            'totalcount' => $deptListData['totalcount'],
            'size' => $deptListData['size'],
            'page' => $deptListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Fetch Business unit for department
        Path : api/ea/department/fetch-business-unit
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionFetchBusinessUnit(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'unitdata'.$mcpPk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery  = MemcompsectordtlsTbl::memcompQueryCache();
                $bunitData = MemcompsectordtlsTbl::fetchBunitData($mcpPk);
                $cache->store($cacheKey, $bunitData, $duration = 0 , $cacheQuery);
            } else {
                $bunitData = $cache->retreive($cacheKey);
            }
        
        } catch(\Exception $e){
            $bunitData = MemcompsectordtlsTbl::fetchBunitData($mcpPk);
        }
        $data['bunitData'] = $bunitData;
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Change the status of the department and deletd status also changes here
        Path : api/ea/department/change-bunit-dept-status
        Params :    {
                        postParams:{
                            deptPk,
                            deptStatus
                        }
                    }
    */
    public function actionChangeBunitDeptStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::decrypt($resParam->deptPk);
            $deptPk = Security::sanitizeInput($deptPk,'number');
            $deptStatus = Security::sanitizeInput($resParam->deptStatus,'number');
            if(!empty($deptPk) && $deptPk > 0 && !empty($deptStatus) && $deptStatus > 0){
                
                $afterChange = DepartmentmstTbl::changeStatusDepartment($deptPk, $deptStatus);

                if($afterChange == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterChange == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterChange == 3){
                    $statMsg = ($deptStatus == 2)?'Deactivate':'Delete';
                    $message = 'You cannot '.$statMsg.' this department since it is mapped to a user.';
                    $status = 105;
                }else{
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
        Description : Fetch Business unit for department
        Path : api/ea/department/fetch-bunit-department
        Params :    {
                        postParams:{
                            deptPk
                        }
                    }
    */
    public function actionFetchBunitDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::decrypt($resParam->deptPk);
            $deptPk = Security::sanitizeInput($deptPk,'number');
            if(!empty($deptPk) && $deptPk > 0){
                $data['bunitDeptData'] = DepartmentmstTbl::fetchBunitDepartment($deptPk);
                $data['bunitDeptData']['bunitFks'] = explode(',', $data['bunitDeptData']['bunitFks']);

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
        Description : Fetch Department by bunit
        Path : api/ea/department/fetch-department-by-bunit
        Params :    {
                        postParams:{
                            bUnitPk
                            from
                        }
                    }
    */
    public function actionFetchDepartmentByBunit(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bUnitPk) && !empty($resParam->bUnitPk)){
            /*$bUnitPk = Security::decrypt($resParam->bUnitPk);
            $bUnitPk = Security::sanitizeInput($bUnitPk,'number');
            if(!empty($bUnitPk) && $bUnitPk > 0){*/

            $bUnitPk = $resParam->bUnitPk;
            $from = (isset($resParam->from) && $resParam->from > 0)?$resParam->from:1;
            $data['bunitDeptData'] = DepartmentmstTbl::fetchDepartmentByBunit($bUnitPk,$from);
            $message = $this->baseErrorMessage('success');
            $status = 100;
                
            /*}else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }*/
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
    public function actionFetchBunitByDepartment(){
        $response = [];
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->departmentPk) && !empty($resParam->departmentPk)){
            $businessunitList = \common\models\MemcompsectordtlsTbl::getBusinessUnitsdeptpk($resParam->departmentPk);
            foreach($businessunitList as $key => $businessUnit){
                $response[$key]['bunitPk'] = $businessUnit['MemCompSecDtls_Pk'];
                $response[$key]['bunitName'] = $businessUnit['mcsd_businessunitrefname'];
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
        Description : Fetch Department by deptPk
        Path : api/ea/department/get-register-department
        Params :    {
                        postParams:{
                            deptPk
                        }
                    }
    */
    public function actionGetRegisterDepartment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->deptPk) && !empty($resParam->deptPk)){
            $deptPk = Security::decrypt($resParam->deptPk);
            $deptPk = Security::sanitizeInput($deptPk,'number');
            if(!empty($deptPk) && $deptPk > 0){
                $data['deptData'] = DepartmentmstTbl::fetchDepartmentByDeptPk($deptPk);
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
            case 'smAlreadyAvailable':
                $resMessage = 'Department already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
        }
        return $resMessage;
    }
}
