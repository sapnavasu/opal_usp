<?php

namespace api\modules\cm\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\BasemodulemstTbl;
use common\models\ActionmstTbl;
use common\models\StkholdertypmstTbl;
use common\models\StkholderaccessmstTbl;
use common\models\ContentmstTbl;

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
 * Content controller for the `Module` module
 */
class ContentController extends MasterController
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
        Path : api/cm/content/initiate-content
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            contentPk,
                            type: default - '' || subModule || action || fetchData
                        }
                    }
    */

    /**
     * @SWG\Post(
     *     path="/cm/content/initiate-content",
     *     tags={"Notification Content"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Initial Content for notification.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="postParams", type="object",
     *                  @SWG\Property(property="contentPk", type="integer", example=""),
     *                  @SWG\Property(property="type", type="string", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

	public function actionInitiateContent(){
		$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $reqData = 1;        

        if(isset($resParam->contentPk) && !empty($resParam->contentPk)){
            $postType = (isset($resParam->type) && !empty($resParam->type))?$resParam->type:'';
            switch ($postType) {
                case 'subModule':
                    /*Sub Module*/
                    $submodParams = ['bmm_status'=>1, 'bmm_basemodulemst_fk' => $resParam->contentPk];
                    $subreqFields = 'basemodulemst_pk, bmm_name';
                    $data['subModule'] = BasemodulemstTbl::getAllbaseModule($submodParams,$subreqFields);
                    break;
                case 'action':
                    /*Action*/
                    $actParams = ['acm_status'=>1,'acm_submodulemst_fk'=>$resParam->contentPk];
                    $actFields = ['actionmst_pk','acm_actionname','acm_module_fk','acm_submodulemst_fk'];
                    $data['action'] = $action = ActionmstTbl::getActionDatas($actParams,$actFields);
                    break;
                case 'fetchData':
                    $data = self::fetchViewData($resParam->contentPk);
                    $reqData = 0;
                    break;
                case 'fetchEditData':
                    $data = self::defaultInitiateData($resParam->contentPk);
                    break;
                default:
                	/*Content Data*/
                    $data = self::defaultInitiateData();
                    break;
            }
        }

        if($reqData == 1){
            /*Module*/
            $modParams = ['bmm_status'=>1, 'bmm_basemodulemst_fk' => null];
            $reqFields = 'basemodulemst_pk, bmm_name';
            $data['module'] = BasemodulemstTbl::getAllbaseModule($modParams,$reqFields);

            /*Stakeholder Type for Trigger From*/
            $stkParams = ['shm_status'=>1];
            $stkFields = ['stkholdertypmst_pk', 'shm_stakeholdertype'];
            $data['triggerTo'] = $data['triggerFrom'] = StkholdertypmstTbl::getStakeholerDatas($stkParams,$stkFields);
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $this->baseErrorMessage('success'),
            'status' => 100,
        ]);
	}

    public function defaultInitiateData($contentPk=''){
        if($contentPk == ''){
            $cntParams = [];
        }else{
            /*Stakeholder Type for Trigger From*/
            $stkParams = ['shm_status'=>1];
            $stkFields = ['stkholdertypmst_pk', 'shm_stakeholdertype'];
            $triggerFrom = StkholdertypmstTbl::getStakeholerDatas($stkParams,$stkFields);
            $cntParams = ['contentmst_pk'=>$contentPk];
        }
        $cntFields = 'contentmst_pk as contentPk, cnm_actionmst_fk as actionFk, cnm_actionfromtitle as fromTitle, cnm_actionfromcontent as fromContent, cnm_actiontotitle as toTitle, cnm_actiontocontent as toContent, cnm_internalrefno as internalRefNo, cnm_actionfrom as actionFrom, cnm_actionto as actionTo, cnm_status as status';
        $data['contentData'] = $getContent = ContentmstTbl::getAllContent($cntParams,$cntFields,'one');
        if(!empty($getContent)){
            /*Action Datas*/
            $actParams = ['acm_status'=>1,'actionmst_pk'=>$getContent['actionFk']];
            $actFields = ['actionmst_pk','acm_actionname','acm_module_fk','acm_submodulemst_fk'];
            $action = ActionmstTbl::getActionDatas($actParams,$actFields);
            $actCmnParams = ['acm_status'=>1,'acm_submodulemst_fk' => $action[0]['acm_submodulemst_fk']];
            $data['action'] = ActionmstTbl::getActionDatas($actCmnParams,$actFields);
            $data['contentData']['modulePk'] = $action[0]['acm_module_fk'];
            $data['contentData']['subModulePk'] = $action[0]['acm_submodulemst_fk'];
            if(!empty($action)){
                /*Sub Module*/
                $submodParams = ['bmm_status'=>1, 'bmm_basemodulemst_fk' => $action[0]['acm_module_fk']];
                $subreqFields = 'basemodulemst_pk, bmm_name';
                $data['subModule'] = BasemodulemstTbl::getAllbaseModule($submodParams,$subreqFields);
            }
            $actionFrom = json_decode(json_decode($getContent['actionFrom']),true);
            $actionTo = json_decode(json_decode($getContent['actionTo']),true);
            $data['actFrm'] = $data['actTo'] = $data['actStkTo'] = $data['actStkFrm'] = [];
            foreach ($triggerFrom as $key => $tf) {
                if(isset($actionFrom[$tf['stkholdertypmst_pk']])){
                    $data['actTo'][] = ['radioStkBox'=>true,'radStkBoxUsr'=>$actionFrom[$tf['stkholdertypmst_pk']]];
                    $data['actStkTo'][] = ['stkPk'=>$tf['stkholdertypmst_pk']];
                }else{
                    $data['actTo'][] = ['radioStkBox'=>false,'radStkBoxUsr'=>false];
                }

                if(isset($actionTo[$tf['stkholdertypmst_pk']])){
                    $data['actFrm'][] = ['checkStkBox'=>true,'radStkBox'=>$actionTo[$tf['stkholdertypmst_pk']]];
                    $data['actStkFrm'][] = ['stkPk'=>$tf['stkholdertypmst_pk']];
                }else{
                    $data['actFrm'][] = ['checkStkBox'=>false,'radStkBox'=>false];
                }
            }
        }
        return $data;
    }

	/*
        Path : api/cm/content/common-content-data
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            contentPk
                            contentType - 'Submodule || Act-Trig-To'
                        }
                    }
    */
    /**
     * @SWG\Post(
     *     path="/cm/content/common-content-data",
     *     tags={"Notification Content"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Fetching common content for notification.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="postParams", type="object",
     *                  @SWG\Property(property="contentPk", type="integer", example=""),
     *                  @SWG\Property(property="actionFk", type="integer", example=""),
     *                  @SWG\Property(property="type", type="string", example=""),
     *                  @SWG\Property(property="status", type="integer", example=""),
     *                  @SWG\Property(property="ttTitle", type="string", example=""),
     *                  @SWG\Property(property="ttDescription", type="string", example=""),
     *                  @SWG\Property(property="ttStakeholder", type="string", example=""),
     *                  @SWG\Property(property="tfTitle", type="string", example=""),
     *                  @SWG\Property(property="tfDescription", type="string", example=""),
     *                  @SWG\Property(property="tfStakeholder", type="string", example=""),
     *                  @SWG\Property(property="refNumber", type="string", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
	public function actionCommonContentData(){
		$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->contentPk) && !empty($resParam->contentPk) && isset($resParam->contentType) && !empty($resParam->contentType)){

        	switch ($resParam->contentType) {
        		case 'Submodule':	/*Fetching Sub Module Values*/
        			$modParams = ['bmm_status'=>1, 'bmm_basemodulemst_fk' => $resParam->contentPk];
			        $reqFields = 'basemodulemst_pk, bmm_name';
			        $data['module'] = BasemodulemstTbl::getAllbaseModule($modParams,$reqFields);
        			break;
        		case 'Act-Trig-To': // Action and Trigger To values
        			/*Action Data*/
        			$actParams = ['acm_status'=>1,'acm_submodulemst_fk'=>$resParam->contentPk];
				    $actFields = ['actionmst_pk','acm_actionname'];
				    $data['action'] = ActionmstTbl::getActionDatas($actParams,$actFields);
				    
				    /*Trigger To Data*/
				    $data['triggerToContent'] = StkholderaccessmstTbl::getStkData();
				    break;
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
        Path : api/cm/content/content-save
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            contentPk
                            actionFk
                            type
                            status
                            ttTitle
                            ttDescription
                            ttStakeholder - [{1:A},{2:U},{3:B}] --> just sample
                            tfTitle
                            tfDescription
                            tfStakeholder - [{1:A} || {2:U} || {3:B}] --> just sample
                            refNumber
                        }
                    }
    */
    /**
     * @SWG\Post(
     *     path="/cm/content/content-save",
     *     tags={"Notification Content"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add / Update content for notification.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="postParams", type="object",
     *                  @SWG\Property(property="contentPk", type="integer", example=""),
     *                  @SWG\Property(property="actionFk", type="integer", example=""),
     *                  @SWG\Property(property="type", type="string", example=""),
     *                  @SWG\Property(property="status", type="integer", example=""),
     *                  @SWG\Property(property="ttTitle", type="string", example=""),
     *                  @SWG\Property(property="ttDescription", type="string", example=""),
     *                  @SWG\Property(property="ttStakeholder", type="string", example=""),
     *                  @SWG\Property(property="tfTitle", type="string", example=""),
     *                  @SWG\Property(property="tfDescription", type="string", example=""),
     *                  @SWG\Property(property="tfStakeholder", type="string", example=""),
     *                  @SWG\Property(property="refNumber", type="string", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionContentSave(){
    	$postVar = Yii::$app->request->getRawBody();
	    $params = json_decode($postVar);
	    $resParam = $params->postParams;
	    $data = [];
	    if(isset($resParam->formValue->actionFk) && !empty($resParam->formValue->actionFk) && 
	    	isset($resParam->formValue->status) && !empty($resParam->formValue->status) && 
	    	isset($resParam->formValue->ttTitle) && !empty($resParam->formValue->ttTitle) && 
	    	isset($resParam->formValue->ttDescription) && !empty($resParam->formValue->ttDescription) && 
	    	isset($resParam->formValue->tfTitle) && !empty($resParam->formValue->tfTitle) && 
	    	isset($resParam->formValue->tfDescription) && !empty($resParam->formValue->tfDescription) && 
            isset($resParam->type) && !empty($resParam->type) && 
            isset($resParam->ttStakeholder) && !empty($resParam->ttStakeholder) && 
	    	isset($resParam->tfStakeholder) && !empty($resParam->tfStakeholder) && 
	    	isset($resParam->refNumber) && !empty($resParam->refNumber)
		){
			$contentPk = (isset($resParam->formValue->contentPk) && !empty($resParam->formValue->contentPk))?$resParam->formValue->contentPk:'';
	    	$save['actionFk'] = $resParam->formValue->actionFk;
	    	$save['status'] = $resParam->formValue->status;
	    	$save['ttTitle'] = $resParam->formValue->ttTitle;
	    	$save['ttDescription'] = $resParam->formValue->ttDescription;

            $ttsArr = [];
            foreach ($resParam->ttStakeholder as $tts){
                $ttsArr[$tts->pk] = $tts->val;
            }
	    	$save['ttStakeholder'] = json_encode($ttsArr);
	    	$save['tfTitle'] = $resParam->formValue->tfTitle;
	    	$save['tfDescription'] = $resParam->formValue->tfDescription;

            $tfsArr = [];
            foreach ($resParam->tfStakeholder as $tfs){
                $tfsArr[$tfs->pk] = $tfs->val;
            }
	    	$save['tfStakeholder'] = json_encode($tfsArr);
            $save['refNumber'] = $resParam->refNumber;
	    	$save['type'] = $resParam->type;
	    	$afterSave = ContentmstTbl::contentSave($save,$contentPk);
    		if($afterSave == 1){
                $message = $this->baseErrorMessage('success');
		        $status = 100;
		    }elseif($afterSave == 2 || $afterSave == 3){
		    	$message = $this->baseErrorMessage('smAlreadyAvailable');
		        $status = 104;
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

    /*
        Path : api/cm/content/content-update
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            contentPk
                            type - 'delete','statusUpdate','multipleDelete'
                            status - 1 - Inactive, 0 - Active
                        }
                    }
    */
    /**
     * @SWG\Post(
     *     path="/cm/content/content-update",
     *     tags={"Notification Content"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Updating Delete/Status for notification content.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="postParams", type="object",
     *                  @SWG\Property(property="contentPk", type="integer", example=""),
     *                  @SWG\Property(property="type", type="string", example=""),
     *                  @SWG\Property(property="status", type="integer", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionContentUpdate(){
    	$postVar = Yii::$app->request->getRawBody();
	    $params = json_decode($postVar);
	    $resParam = $params->postParams;
	    $data = [];
	    if(isset($resParam->contentPk) && !empty($resParam->contentPk) && 
	    	isset($resParam->type) && !empty($resParam->type)
		){
			$update = [];
			if($resParam->type == 'statusUpdate'){
				$update['status'] = ($resParam->status == 0)?1:0;
			}
            if($resParam->type == 'multipleDelete'){
                $multipleUpdateRes = ContentmstTbl::updateMultipleContent($resParam->contentPk,$resParam->type,$update);
                $afterUpdate = 1;
            }else{
	    	  $afterUpdate = ContentmstTbl::updateContent($resParam->contentPk,$resParam->type,$update);
            }
	    	if($afterUpdate == true){
	    		$message = $this->baseErrorMessage('success');
		        $status = 100;
	    	}elseif($afterUpdate == 2){
	    		$message = $this->baseErrorMessage('notAvailable');
		        $status = 104;
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

    /*
        Path : api/cm/content/content-list
        Description : Fetching the details for grid view
        Params :    {
                        postParams:{
                            page - default 0
                            size - default 10
                            contentTitle
                            moduleName
                            subModuleName
                            actionMade
                            status
                            column {moduleName || submoduleName || actionName || status}
							direction
                        }
                    }
    */
    /**
     * @SWG\Post(
     *     path="/cm/content/content-list",
     *     tags={"Notification Content"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Fetching list of notification content.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="postParams", type="object",
     *                  @SWG\Property(property="page", type="integer", example=""),
     *                  @SWG\Property(property="size", type="integer", example=""),
     *                  @SWG\Property(property="contentTitle", type="string", example=""),
     *                  @SWG\Property(property="moduleName", type="string", example=""),
     *                  @SWG\Property(property="subModuleName", type="string", example=""),
     *                  @SWG\Property(property="actionMade", type="integer", example=""),
     *                  @SWG\Property(property="status", type="integer", example=""),
     *                  @SWG\Property(property="column", type="string", example=""),
     *                  @SWG\Property(property="direction", type="string", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

	public function actionContentList(){
		$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = $modParams = [];
        $modParams['page'] = isset($resParam->page)?$resParam->page:0;
        $modParams['size'] = isset($resParam->size)?$resParam->size:10;
        $modParams['contentTitle'] = isset($resParam->contentTitle)?$resParam->contentTitle:'';
        $modParams['moduleName'] = isset($resParam->moduleName)?$resParam->moduleName:'';
        $modParams['subModuleName'] = isset($resParam->subModuleName)?$resParam->subModuleName:'';
        $modParams['actionMade'] = isset($resParam->actionMade)?$resParam->actionMade:'';
        $modParams['status'] = isset($resParam->status)?$resParam->status:'';
        $modParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $modParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;
        
        $baseModuleList = ContentmstTbl::contentList($modParams);
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

    function fetchViewData($contentPk){
        $data['viewData'] = $viewData = ContentmstTbl::fetchViewData($contentPk);
        $actionFrom = json_decode(json_decode($viewData['cnm_actionfrom']));
        $actionTo = json_decode(json_decode($viewData['cnm_actionto']));
        $data['cnm_status'] = ($viewData['cnm_status'] == 1)?'Active':'Inactive';
        
        $stkParams = ['shm_status'=>1];
        $stkFields = ['stkholdertypmst_pk', 'shm_stakeholdertype'];
        $stakeholderType = StkholdertypmstTbl::getStakeholerDatas($stkParams,$stkFields);
        $stkArr = [];
        foreach ($stakeholderType as $key => $stkType) {
            $stkArr[$stkType['stkholdertypmst_pk']] = $stkType['shm_stakeholdertype'];
        }
        $usrType = ['A'=>'Admin', 'U'=>'User', 'B'=>'Both'];
        foreach ($actionFrom as $key => $actFrom) {
            $data['actionFrom'][] = ['type'=>$stkArr[$key], 'value'=>$usrType[$actFrom]];
        }
        foreach ($actionTo as $key => $actTo) {
            $data['actionTo'][] = ['type'=>$stkArr[$key], 'value'=>$usrType[$actTo]];
        }
        return $data;
    }

	/*Error message creation*/
    function baseErrorMessage($type){
        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
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
                $resMessage = 'This data is already available';
                break;
        }
        return $resMessage;
    }
}
