<?php

namespace api\modules\mcp\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\MembercompanymstTbl;
use common\components\Drive;

/*
    Response Status Code Error
    100    -   Success
    101    -   Param's Missing
    102    -   Failure Or Warning Error
    103    -   Db Error
    104    -   Data Not Available || Data Already Available
    105    -   Data value mismatch
*/
class CompliancecertificationController extends MasterController
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
        Path : api/mcp/compliacecertification/save-coc
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                            cocNo,
                            cocIssuedOn,
                            cocExpiresOn                            
                        }
                    }
    */

    public function actionSaveCoc(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        // COC AND COMER SAVE
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(1,'Saved Company\'s COC Certificates.',$url,110);
        if(isset($resParam->cocNo) && !empty($resParam->cocIssuedOn) && isset($resParam->cocExpiresOn)){
        	$mcpPk = Security::decrypt($resParam->mcpPk);
        	$save['cocNo'] = Security::sanitizeInput($resParam->cocNo,'string_spl_char');

        	$stkCondition = ['MCM_CoC_CtftNo' => $save['cocNo']];
        	$checkCocNoAlreadyAvailable = MembercompanymstTbl::mcmFieldValueAvailable($stkCondition, $mcpPk);
        	if(empty($checkCocNoAlreadyAvailable)){
	        	$save['cocIssuedOn'] = Security::isDateValid($resParam->cocIssuedOn,'Y-m-d H:i:s');
	        	$save['cocExpiresOn'] = Security::isDateValid($resParam->cocExpiresOn,'Y-m-d H:i:s');
                $save['cocUpload'] = implode(',', $resParam->cocUpload);
	        	$afterSave = MembercompanymstTbl::saveCoc($save,$mcpPk);

	        	if($afterSave == 1){
	                $message = $this->baseErrorMessage('success');
			        $status = 100;
			    }elseif($afterSave == 2){
			    	$message = $this->baseErrorMessage('notAvailable');
			        $status = 104;
			    }else{
			    	$message = $this->baseErrorMessage('dbError');
			        $status = 103;
			    }
        	}else{
        		$message = $this->baseErrorMessage('smAlreadyAvailable');
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
        Path : api/mcp/compliacecertification/save-municipality-license
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                            mLicNo,
                            mLicIssuedOn,
                            mLicExpiresOn                            
                        }
                    }
    */

    public function actionSaveMunicipalityLicense(){
        // SAVE MUNICIAPLITY
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(1,'Saved Company\'s Municipality Licence.',$url,110);
        if(isset($resParam->mLicNo) && !empty($resParam->mLicIssuedOn) && isset($resParam->mLicExpiresOn)){
        	$mcpPk = Security::decrypt($resParam->mcpPk);
        	$save['mLicNo'] = Security::sanitizeInput($resParam->mLicNo,'string_spl_char');

        	$stkCondition = ['mcm_municiplicnumber' => $save['mLicNo']];
        	$checkMLicenceNoAlreadyAvailable = MembercompanymstTbl::mcmFieldValueAvailable($stkCondition, $mcpPk);
        	if(empty($checkMLicenceNoAlreadyAvailable)){
	        	$save['mLicIssuedOn'] = Security::isDateValid($resParam->mLicIssuedOn,'Y-m-d H:i:s');
	        	$save['mLicExpiresOn'] = Security::isDateValid($resParam->mLicExpiresOn,'Y-m-d H:i:s');
                $save['mLicUpload'] = implode(',', $resParam->mLicUpload);
	        	$afterSave = MembercompanymstTbl::saveMunicipalLicense($save,$mcpPk);

	        	if($afterSave == 1){
	                $message = $this->baseErrorMessage('success');
			        $status = 100;
			    }elseif($afterSave == 2){
			    	$message = $this->baseErrorMessage('notAvailable');
			        $status = 104;
			    }else{
			    	$message = $this->baseErrorMessage('dbError');
			        $status = 103;
			    }
        	}else{
        		$message = $this->baseErrorMessage('smAlreadyAvailable');
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
        Path : api/mcp/compliacecertification/fetch-cc
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                        }
                    }
    */
    public function actionFetchCc(){
        // ALL COMPLAINCE CERTICATE
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(5,'Visited the Compliance Certification page.',$url,110);
        if(isset($resParam->mcpPk)){
        	$mcpPk = Security::decrypt($resParam->mcpPk);
        	$stkFields = ['MCM_CoC_CtftNo', 'mcm_cocissuedt', 'MCM_CoC_CtftExpiry', 'mcm_municiplicnumber', 'mcm_municipcertissuedt', 'mcm_municipcertexpdt','mcm_cocctftfiledtls_fk','mcm_municipfiledtls_fk'];
        	$stkCondition = ['MemberCompMst_Pk' => $mcpPk];
        	$fetchData = MembercompanymstTbl::fetchCc($stkCondition, $stkFields, 'one');
        	if(!empty($fetchData)){
                $cocUpload = $munUpload = [];
                if(!empty($fetchData->mcm_cocctftfiledtls_fk)){
                    $cocUpload = explode(',', $fetchData->mcm_cocctftfiledtls_fk);
                }
                if(!empty($fetchData->mcm_municipfiledtls_fk)){
                    $munUpload = explode(',', $fetchData->mcm_municipfiledtls_fk);
                }
        		$data['cocData'] = ['cocNo' =>$fetchData->MCM_CoC_CtftNo, 'cocIssuedOn' =>$fetchData->mcm_cocissuedt, 'cocExpiresOn' =>$fetchData->MCM_CoC_CtftExpiry,'cocUpload'=>$cocUpload];

        		$data['municipalData'] = ['mLicNo' =>$fetchData->mcm_municiplicnumber, 'mLicIssuedOn' =>$fetchData->mcm_municipcertissuedt, 'mLicExpiresOn' =>$fetchData->mcm_municipcertexpdt,'mLicUpload'=>$munUpload];
        		
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

    	return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mcp/compliacecertification/save-other-document
        Description : Add other document
        Params :    {
                        postParams:{
                            docTitle,
                            issuedBy,
                            issuedOn,
                            expiresOn,
                            odUpload
                        }
                    }
    */
     public function actionSaveOtherDocument(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->docTitle) && !empty($resParam->issuedBy) && isset($resParam->issuedOn) && isset($resParam->odUpload)){
            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $save['docTitle'] = Security::sanitizeInput($resParam->docTitle,'string');
            $save['issuedBy'] = Security::sanitizeInput($resParam->issuedBy,'string');
            $save['issuedOn'] = Security::isDateValid($resParam->issuedOn,'Y-m-d');
            if(isset($resParam->expiresOn) && !empty($resParam->expiresOn)){
                $save['expiresOn'] = Security::isDateValid($resParam->expiresOn,'Y-m-d');
            }else{
                $save['expiresOn'] = '-';
            }
            $save['odUpload'] = implode(',', $resParam->odUpload);
            if($mcpPk > 0 && !empty($save['docTitle']) && !empty($save['issuedBy']) && !empty($save['issuedOn']) && !empty($save['expiresOn'])){
                $otherDoc[] = $save;
                $afterSave = MembercompanymstTbl::saveOtherDocument($otherDoc, $mcpPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 4){
                    $message = $this->baseErrorMessage('greaterCount');
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
        Path : api/mcp/compliacecertification/delete-other-document
        Description : Delete document
        Params :    {
                        postParams:{
                            docPk
                        }
                    }
    */
    public function actionDeleteOtherDocument(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->docPk)){
            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $docPk = Security::decrypt($resParam->docPk);
            $docPk = Security::sanitizeInput($docPk,'number');
            if($mcpPk > 0 && $docPk > 0){
                $docPk = $docPk - 1;
                $afterDelete = MembercompanymstTbl::deleteOtherDocument($docPk, $mcpPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2 || $afterDelete == 3){
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
            $message = $resParam->docPk.'///'.$this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mcp/compliacecertification/fetch-other-document
        Description : Delete document
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionFetchOtherDocument(){

        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        if($mcpPk > 0){
            $fetchOtherDocument = MembercompanymstTbl::fetchOtherDocument($mcpPk);
            if(isset($fetchOtherDocument['mcm_otherdocs']) && !empty($fetchOtherDocument['mcm_otherdocs'])){
                $otherDoc = json_decode(json_decode($fetchOtherDocument['mcm_otherdocs']));
                $otherDocument = [];
                foreach ($otherDoc as $dKey => $otherDocVal) {
                    $docUpArr = [];
                    if(isset($otherDocVal->odUpload) && !empty($otherDocVal->odUpload)){
                        $docUpload = explode(',', $otherDocVal->odUpload); 

                        foreach ($docUpload as $key => $docUp) {
                            $docUpPk = Security::encrypt($docUp);
                           $docUpArr[] = [
                                'url'=>Drive::generateUrl($docUp,$mcpPk,$userPk,1),
                                'name'=>Drive::getFileName($docUpPk)
                            ];
                        }
                    }else{
                        $docUpload = $docUpArr = []; 
                    }


                    $otherDocument[] = [
                        'docKey'=>$dKey+1,
                        'docTitle'=>$otherDocVal->docTitle,
                        'issuedBy'=>$otherDocVal->issuedBy,
                        'issuedOn'=>date('d-m-Y',strtotime($otherDocVal->issuedOn)),
                        'expiresOn'=>($otherDocVal->expiresOn == '-')?'-':date('d-m-Y',strtotime($otherDocVal->expiresOn)),
                        'odUpload'=> $docUpload,
                        'docUrl'=>$docUpArr
                    ];
                }
                $data['otherDoument'] = $otherDocument;
                $otherDoumentLimit = Yii::$app->params['otherDocumentMaxUpload'];
                $otherDoumentCount = count($otherDocument);
                $data['otherDoumentlimit'] = $otherDoumentLimit - $otherDoumentCount;
                $message = $this->baseErrorMessage('sanitizeError');
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
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
            case 'greaterCount':
                $resMessage = 'Maximum upload count is reached';
                break;
        }
        return $resMessage;
    }
}
