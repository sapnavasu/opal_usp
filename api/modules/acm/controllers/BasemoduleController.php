<?php

namespace api\modules\acm\controllers;

use Yii;
use yii\web\Controller;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use common\models\BasemodulemstTbl;
use common\models\AccessmasterTbl;
use \common\components\Security;

/*
    Response Status Code Error
    100    -   Success
    101    -   Param's Missing
    102    -   Failure Or Warning Error
    103    -   Db Error
    104    -   Data Not Available
    105    -   Data value mismatch
*/

/**
 * Basemodule controller for the `Base Module` module
 */
class BasemoduleController extends MasterController
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
        Path : api/acm/basemodule/fetches-base-module
        Description : Fetching details for while clicking update 
        Params :    {
                        postParams:{
                            modulePk
                        }
                    }
    */
    public function actionFetchesBaseModule()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $resParam->modulePk = \common\components\Security::sanitizeInput($resParam->modulePk, "number");
        
        $data = [];
        if(!empty($resParam->modulePk)){
        	/*Fetching Module Details*/
        	$reqFields = ['basemodulemst_pk','bmm_name','bmm_basemodulemst_fk','bmm_accessmaster_fk','bmm_status','bmm_domaintype'];
        	$fetchBaseModule = BasemodulemstTbl::fetchBaseModule($resParam->modulePk,$reqFields);
        	if(!empty($fetchBaseModule)){
        		$moduleAccess = explode(',', $fetchBaseModule->bmm_accessmaster_fk);
                        $parentModule = BasemodulemstTbl::fetchBaseModule($fetchBaseModule->bmm_basemodulemst_fk,$reqFields);	
        		$parentModuleAccess = explode(',', $parentModule->bmm_accessmaster_fk);
                        /*Fetching Access Details*/
        		$reqFields = ['accessmaster_pk','acm_accessname'];
        		$accessMaster = AccessmasterTbl::fetchAccessMaster('all',$reqFields);
				$accessFormation = [];
                        
				if(empty($fetchBaseModule->bmm_basemodulemst_fk)){
					foreach ($accessMaster as $key => $acMst) {
						$accessFormation[$key]['accessmaster_pk'] = $acMst['accessmaster_pk'];
						$accessFormation[$key]['acm_accessname'] = $acMst['acm_accessname'];
						$accessFormation[$key]['checked'] = (in_array($acMst['accessmaster_pk'], $moduleAccess))?'true':'';
					}
				}else{
					foreach ($accessMaster as $key => $val){
						$accessFormation[$key]['accessmaster_pk'] = $val['accessmaster_pk'];
						$accessFormation[$key]['acm_accessname'] = $val['acm_accessname'];
						if(in_array($val['accessmaster_pk'], $parentModuleAccess) && in_array($val['accessmaster_pk'], $moduleAccess)){
							$accessFormation[$key]['checked'] = 'true';
						}else if(in_array($val['accessmaster_pk'], $parentModuleAccess)){
							$accessFormation[$key]['checked'] = 'enabled';
						}else{
							$accessFormation[$key]['checked'] = 'false';
						}
					}   
				}
                    
        		/*Data Formation*/
        		$data = [
        			'moduleData' => [
        				'modulePk' => $fetchBaseModule->basemodulemst_pk,
        				'moduleName' => $fetchBaseModule->bmm_name,
        				'parentModulePk' => $fetchBaseModule->bmm_basemodulemst_fk,
        				'moduleAccess' => $moduleAccess,
        				'domainType' => $fetchBaseModule->bmm_domaintype,
        				'status' => $fetchBaseModule->bmm_status,
        			],
        			'accessMaster' => $accessFormation
        		];
                $message = $this->baseErrorMessage('success');
            	$status = 100;
        	}else{
                    $message = $this->baseErrorMessage('notAvailable');
            	$status = 104;
        	}

        }else{
            $message = $this->baseErrorMessage('missing');
            $status = 101;
        }
       
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/acm/basemodule/base-module-save
        Description : Create / Update the Base module
        Params :    {
                        postParams:{
                            modulePk
                            moduleName
                            parentModulePk	- for parent empty param
                            moduleAccess - comma seperated only "1,2,3,4"
                            status - 1=>Active, 2=>Inactive
                        }
                    }
    */
    public function actionBaseModuleSave(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams->formValues;
        //$resAccessParam = $params->postParams->accessArr;
        $data = [];
    	if(!empty($resParam)){
    		$modulePk = isset($resParam->modulePk)?$resParam->modulePk:'';
    		$parentModulePk = (isset($resParam->parentModulePk) && !empty($resParam->parentModulePk))?$resParam->parentModulePk:NULL;
    		$save['moduleName'] = $resParam->moduleName;
    		$save['parentModulePk'] = $parentModulePk;
    		$save['moduleAccess'] = $resParam->moduleAccess;
    		$save['domainType'] = $resParam->domainType;
    		$save['status'] = $resParam->status;
    		$save['ipAddress'] = $_SERVER['REMOTE_ADDR'];
    		$afterSave = BasemodulemstTbl::baseModuleSave($save,$modulePk);
    		if($afterSave == 1){
                $message = $this->baseErrorMessage('success');
		        $status = 100;
                        $flag = 'S';
		    }elseif($afterSave == 2){
		    	$message = $this->baseErrorMessage('smAlreadyAvailable');
		        $status = 104;
                        $flag = 'E';
		    }elseif($afterSave == 3){
		    	$message = $this->baseErrorMessage('update');
		        $status = 104;
                        $flag = 'S';
		    }else{
		    	$message = $this->baseErrorMessage('dbError');
		        $status = 103;
                        $flag = 'E';
		    }
    	}else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
            $flag = 'E';
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
            'flag' => $flag
        ]);
    }

    /*
        Path : api/acm/basemodule/base-modules-list
        Description : Fetching the details for grid view
        Params :    {
                        postParams:{
                            size - default 10
                            page - default 1
                            moduleName
                            subModuleName
                            status
                            column
                            direction
                        }
                    }
    */
    public function actionBaseModulesList(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = $modParams = [];
        $modParams['page'] = isset($resParam->page)?$resParam->page:0;
        $modParams['size'] = isset($resParam->size)?$resParam->size:10;
        $modParams['moduleName'] = isset($resParam->moduleName)?$resParam->moduleName:'';
        $modParams['subModuleName'] = isset($resParam->subModuleName)?$resParam->subModuleName:'';
        $modParams['status'] = isset($resParam->status)?$resParam->status:'';
        $modParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $modParams['sort_type'] = isset($resParam->direction)?$resParam->direction:'';
        $modParams['sort_type'] = ($modParams['sort_type'] == "asc") ? SORT_ASC : SORT_DESC;
        if($resParam->stype == "0"){
            $modParams['type'] = "IS NULL";
        }elseif($resParam->stype == "1"){
            $modParams['type'] = "IS NOT NULL";
        }else{
            $modParams['type'] = "";
        }
        $baseModuleList = BasemodulemstTbl::baseModuleList($modParams);
        $message = $this->baseErrorMessage('success');
		$status = 100;

    	return $this->asJson([
        	'data' => $baseModuleList['data'],
        	'totalcount' => $baseModuleList['totalcount'],
        	'size' => $baseModuleList['size'],
        	'page' => $baseModuleList['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/acm/basemodule/base-root-module
        Description : Get the root module data's
        Params :    {
                        postParams:{
                            status - default 1
                        }
                    }
    */
    public function actionBaseRootModule(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $status = (isset($resParam->status) && ($resParam->status >= 0))?$resParam->status:1;

        $modParams = ['bmm_status'=>$status];
        $reqFields = 'basemodulemst_pk, bmm_name';
        $res = BasemodulemstTbl::getAllbaseModule($modParams,$reqFields);
        return $this->asJson([
        	'data'=> $res,
            'msg' => 'Success',
            'status' => 100,
        ]);
    }

    /*
        Path : api/acm/basemodule/initial-base-root-module
        Description : fetching the values for modules
        Params :    {
                        postParams:{
                            status - default 1
                        }
                    }
    */
    public function actionInitialBaseRootModule(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        /*Get Module Data*/
        $status = (isset($resParam->status) && ($resParam->status >= 0))?$resParam->status:1;
        $modParams = ['bmm_status'=>$status, 'bmm_basemodulemst_fk' => null];
        $reqFields = 'basemodulemst_pk, bmm_name';
        $data['module'] = BasemodulemstTbl::getAllbaseModule($modParams,$reqFields);
        
        /*Get Access Data*/
        $reqFields = ['accessmaster_pk','acm_accessname','if(accessmaster_pk is null,"true","false") as checked'];
        $data['accessMaster'] = AccessmasterTbl::fetchAccessMaster('all',$reqFields);
        
        /*Response*/
        return $this->asJson([
        	'data'=> $data,
            'msg' => 'Success',
            'status' => 100,
        ]);
    }

    /*
        Path : api/acm/basemodule/get-module-based-access
        Description : Fetching access based on the module
        Params :    {
                        postParams:{
                            modulePk
                        }
                    }
    */
    public function actionGetModuleBasedAccess(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $resParam->modulePk = \common\components\Security::sanitizeInput($resParam->modulePk, "number");
            
        if(!empty($resParam->modulePk)){
	        /*Get Access Data*/
	        $reqFields = ['bmm_accessmaster_fk'];
	        $moduleAccess = BasemodulemstTbl::fetchBaseModule($resParam->modulePk,$reqFields);

	        $reqFields = ['accessmaster_pk','acm_accessname'];
	        $accessMaster = AccessmasterTbl::fetchAccessMaster('all',$reqFields);

	        $currentAccess = explode(',', $moduleAccess->bmm_accessmaster_fk);

	        $accessFormation = [];
	        foreach ($accessMaster as $key => $acMst) {
	        	$accessFormation[$key]['accessmaster_pk'] = $acMst['accessmaster_pk'];
	        	$accessFormation[$key]['acm_accessname'] = $acMst['acm_accessname'];
	        	$accessFormation[$key]['checked'] = (in_array($acMst['accessmaster_pk'], $currentAccess))?'true':'false';
	        }

	        if(!empty($moduleAccess)){
	        	$data['moduleAccess'] = $accessFormation;
	        	$message = $this->baseErrorMessage('success');
        		$status = 100;
	        }else{
	        	$message = $this->baseErrorMessage('notAvailable');
		        $status = 104;
	        }
        }else{
        	$message = $this->baseErrorMessage('missingFields');
        	$status = 101;
        }

        /*Response*/
        return $this->asJson([
        	'data'=> $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    
    /*
        Path : api/acm/basemodule/delete-base-module
        Description : Delete the module and submodule details
        Params :    {
                        postParams:{
                            modulePk
                        }
                    }
    */
    public function actionDeleteBaseModule(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $resParam->isConfirmed = isset($resParam->isConfirmed) ? true : false;
        
        // Default Error Variables
        $message = "Something went wrong";
        $flag = "E";
        $status = 0;
        
        if(!empty($resParam->modulePk)){
            $moduleAccess = BasemodulemstTbl::changestatusBaseModule($resParam->modulePk,$resParam->isConfirmed,$resParam->changeStatus);
             if(is_array($moduleAccess) && $moduleAccess['modulecount']){
                $message = $moduleAccess['message'];
                $flag = 'C';
            }
            else if($moduleAccess == 1){
                $message = "Deleted Successfully";
                $flag = "S";
                $status = 1;
            }else if($moduleAccess == 2){
                $message = "Module is mapped with Stakeholder";
            }else if($moduleAccess == 3){
                $message = "Module is mapped with submodule";
            }else if($moduleAccess == 4){
                $message = "Module is mapped with Stakeholder";
            }
        }
        
        /*Response*/
        return $this->asJson([
            'msg' => $message,
            'status' => $status,
            'flag' => $flag
        ]);
    }
    
    /*
        Path : api/acm/basemodule/change-status-base-module
        Description : Change the status of the module and submodule
        Params :    {
                        postParams:{
                            modulePk,
                            isConfirmed,
                            changeStatus
                        }
                    }
    */
    public function actionChangeStatusBaseModule(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $resParam->modulePk = $resParam->modulePk;
        $resParam->isConfirmed = isset($resParam->isConfirmed) ? true : false;
        
        //Default Error Variables
        $message = "Something went wrong";
        $flag = "E";
        $status = 0;
        
        if(!empty($resParam->modulePk)){
            $moduleAccess = BasemodulemstTbl::changeStatusBaseModule($resParam->modulePk,$resParam->isConfirmed,$resParam->changeStatus);
            if(is_array($moduleAccess) && $moduleAccess['modulecount']){
                $message = $moduleAccess['message'];
                $flag = 'C';
            }
            elseif($moduleAccess == 1){
                $message = "Status Changed Successfully";
                $flag = "S";
                $status = 1;
            }else if($moduleAccess == 2){
                $message = "Module is mapped with Stakeholder";
            }else if($moduleAccess == 3){
                $message = "Module is mapped with submodule";
            }else if($moduleAccess == 4){
                $message = "Module is mapped with Stakeholder";
            }else if($moduleAccess == 5){
                $message = "The Module is associated with this submodule is inactive";
            }
        }
        
        /*Response*/
        return $this->asJson([
            'msg' => $message,
            'status' => $status,
            'flag' => $flag
        ]);
    }

    /*Error message creation*/
    function baseErrorMessage($type){
        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Created Successfully';
                break;
            case 'update':
                $resMessage = 'Updated Successfully';
                break;
            case 'missing':
                $resMessage = 'Module Pk is missing';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this module pk';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'Submodule Name already exits';
                break;
        }
        return $resMessage;
    }
}
