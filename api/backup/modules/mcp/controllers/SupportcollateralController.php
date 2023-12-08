<?php

namespace api\modules\mcp\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\SupportcollateraldtlsTbl;
use common\components\Drive;

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
class SupportcollateralController extends MasterController
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
        Path : api/mcp/supportcollateral/save-sc
        Description : Add support collateral
        Params :    {
                        postParams:{
                            docType
                            uploadDoc
                            uploadVideo
                        }
                    }
    */

    public function actionSaveSc(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $ret = 1;
        if(isset($resParam->docType) && !empty($resParam->docType) && ((isset($resParam->uploadDoc) && !empty($resParam->uploadDoc)) 
                || (isset($resParam->uploadVideo) && !empty($resParam->uploadVideo)) || (isset($resParam->uploadUrl) && !empty($resParam->uploadUrl)) )){

            $save['docType'] = Security::sanitizeInput($resParam->docType,'number');
            $uploadDoc = $resParam->uploadDoc;
            if($save['docType'] > 0){
                if($save['docType'] == 5){
                    $videoType = SupportcollateraldtlsTbl::Videotype($resParam->uploadVideo);

                    if(isset($resParam->fact_fk) && !empty($resParam->fact_fk)){
                        $save['fact_fk'] = Security::decrypt($resParam->fact_fk);
                    }

                    if(isset($resParam->product_fk) && !empty($resParam->product_fk)) {
                        $save['product_fk'] = Security::decrypt($resParam->product_fk);
                    }

                    if(isset($resParam->shared_fk_type) && !empty($resParam->shared_fk_type)) {
                        $save['shared_fk_type'] = $resParam->shared_fk_type;
                    }

                    if($videoType != 'unknown'){
                        $save['uploadVideo'] = $resParam->uploadVideo;
                        $save['uploadDoc'] = '';
                        $save['from_page'] = $resParam->from_page;
                        if($save['shared_fk_type'] != 3 && $save['shared_fk_type'] != 4) {
                            $afterSave = SupportcollateraldtlsTbl::saveSupportCollateral($save);
                        } else {
                           $afterSave = SupportcollateraldtlsTbl::savePackageVideo($save);
                        }
                        
                    }else{
                        $ret = 0;
                    }
                }else{
                    if(count($uploadDoc) > 0) {
                        foreach ($uploadDoc as $key => $upDoc) {
                            $save['uploadDoc'] = $upDoc;
                            $save['uploadVideo'] = '';
                            $save['documentTitle'] = $resParam->documentTitle;
                            if($save['docType'] == 10 && !empty($resParam->uploadUrl)){
                                $save['uploadUrl'] = $resParam->uploadUrl;                        
                            }
                            if(isset($resParam->fact_fk) && !empty($resParam->fact_fk)){
                                $save['fact_fk'] = Security::decrypt($resParam->fact_fk);
                                $save['shared_fk_type'] = $resParam->shared_fk_type;
                            }
                            $afterSave = SupportcollateraldtlsTbl::saveSupportCollateral($save);
                        }
                    } else if($save['docType'] == 10 && !empty($resParam->uploadUrl)) {
                        $save['documentTitle'] = $resParam->documentTitle;
                        $save['uploadUrl'] = $resParam->uploadUrl;  
                        $afterSave = SupportcollateraldtlsTbl::saveSupportCollateral($save);
                    }
                }

                if($ret == 1){
                    if($afterSave == 1){
                        $message = $this->baseErrorMessage('success');
                        $status = 100;
                    }elseif($afterSave == 2){
                        $message = $this->baseErrorMessage('vaAvailable');
                        $status = 104;
                    }elseif($afterSave == 3){
                        $message = ($save['docType'] == 5) ? 'You can add maximum 3 Video URLs.' : $this->baseErrorMessage('greaterCount');
                        $status = 107;
                    }elseif($afterSave == 4){
                        $message = $this->baseErrorMessage('alreadyExists');
                        $status = 104;
                    }else{
                        $message = $this->baseErrorMessage('dbError');
                        $status = 103;
                    }
                }else{
                    $message = $this->baseErrorMessage('notMatch');
                    $status = 105;
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
        Path : api/mcp/supportcollateral/delete-support-collateral
        Description : Delete Support Collateral
        Params :    {
                        postParams:{
                            scPk
                        }
                    }
    */
    public function actionDeleteSupportCollateral(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->scPk) && !empty($resParam->scPk)){
            $scPk = Security::decrypt($resParam->scPk);
            $scPk = Security::sanitizeInput($scPk,'number');
           if($scPk > 0){
                $afterDelete = SupportcollateraldtlsTbl::deleteSc($scPk);

                if($afterDelete == 1){
                    $log_msg = 'Deleted factory Video.';
                    if($resParam->from_page == 'service') {
                        $log_msg = 'Deleted service Video.';
                    } else if($resParam->from_page == 'product') {
                        $log_msg = 'Deleted product Video.';
                    }
                    \common\components\UserActivityLog::logUserActivity(3, $log_msg, 'j3/api/mcp/supportcollateral/delete-support-collateral',22);

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
        Path : api/mcp/supportcollateral/fetch-support-collateral
        Description : fetch Support Collateral
        Params :    {
                        postParams:{
                        }
                    }
    */

    public function actionFetchSupportCollateral(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $data = SupportcollateraldtlsTbl::getSupportCollateralDetails($companyPk, $userPk);
        
        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
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
            case 'notMatch':
                $resMessage = 'Trying to add invalid URL';
                break;
            case 'vaAvailable':
                $resMessage = 'This Video url is already available';
                break;
            case 'greaterCount':
                $resMessage = 'Maximum upload count is reached';
                break;
            case 'alreadyExists':
                $resMessage = 'This Presentation url is already available';
                break;
        }
        return $resMessage;
    }

    public function actionFetchSupportCollateralData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $memberCompany = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $resParam = $params->postParams;
        $data = [];
        $scDetails = SupportcollateraldtlsTbl::fetchScproduct(Security::decrypt($resParam->product_fk), $resParam->shared_fk_type, $memberCompany);

        foreach ($scDetails as $key => $scDetail) {
            if($scDetail['scDocType'] == 5){
                $videoType = SupportcollateraldtlsTbl::Videotype($scDetail['scVideo']);
                if($videoType == 'youtube'){
                    $link = explode('/', $scDetail['scVideo']);
                    $link = end($link);
                    $link = explode('?', $link);

                    $link2 = explode('/', $scDetail['scVideo']);
                    $link2 = end($link2);
                    $link2 = explode('v=', $link2);

                    if(isset($link2[1]) && !empty($link2[1])){
                        $linkKey = $link2[1];
                    }else{
                        $linkKey = $link[0];
                    }
                    

                    $youtubeDetail = SupportcollateraldtlsTbl::Youtubedetail($scDetail['scVideo']);
                    $youtubeDetails = SupportcollateraldtlsTbl::Youtubedetails($linkKey);
                    $ytVmDet = SupportcollateraldtlsTbl::Ytformation($youtubeDetails, $youtubeDetail);
                }elseif($videoType == 'vimeo'){
                    $vimeoDetails = SupportcollateraldtlsTbl::Vimeodetails($scDetail['scVideo']);
                    $ytVmDet = SupportcollateraldtlsTbl::Vmformation($vimeoDetails);
                }else{
                    $ytVmDet['title'] = $ytVmDet['description'] = $ytVmDet['from'] = $ytVmDet['thumbnail'] = '';
                }

                $url = $ytVmDet['thumbnail'];
                $headers = get_headers($url);
                $img_check =  stripos($headers[0],"200 OK") ? $url : 'assets/images/noimagenew.png';

                $ytVmDet['thumbnail'] = $img_check;

                $data['videos'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scVideo'=>$scDetail['scVideo'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'scType' => $scDetail['scType'],
                    'scSharedfk' => $scDetail['scSharedfk'],
                    'title' => $ytVmDet['title'], 
                    'description' => $ytVmDet['description'], 
                    'from' => $ytVmDet['from'], 
                    'thumbnail' => $ytVmDet['thumbnail'], 
                ];

            }
        }

        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
        ]);
    }

    public function actionFetchSupportCollateralfact(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $resParam = $params->postParams;
        $data = [];
        $scDetails = SupportcollateraldtlsTbl::fetchScfact(Security::decrypt($resParam->fact_fk));
        $data['photos'] = $data['broucher'] = $data['advertisement'] = $data['videos'] = $data['presentation'] = [];

        foreach ($scDetails as $key => $scDetail) {
            //echo'<pre>';print_r($scDetail);exit;
            if($scDetail['scDocType'] == 6){
                $data['broucher'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 7){
                $data['photos'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 9){
                $data['advertisement'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 10){
                /*$data['presentation'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scVideo'=>$scDetail['scVideo'],
                    'scCreatedBy'=>$scDetail['scCreatedBy']
                ];*/

                $data['presentation'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 5){
                $videoType = SupportcollateraldtlsTbl::Videotype($scDetail['scVideo']);
                if($videoType == 'youtube'){
                    $link = explode('/', $scDetail['scVideo']);
                    $link = end($link);
                    $link = explode('?', $link);

                    $link2 = explode('/', $scDetail['scVideo']);
                    $link2 = end($link2);
                    $link2 = explode('v=', $link2);

                    if(isset($link2[1]) && !empty($link2[1])){
                        $linkKey = $link2[1];
                    }else{
                        $linkKey = $link[0];
                    }
                    

                    $youtubeDetail = SupportcollateraldtlsTbl::Youtubedetail($scDetail['scVideo']);
                    $youtubeDetails = SupportcollateraldtlsTbl::Youtubedetails($linkKey);
                    $ytVmDet = SupportcollateraldtlsTbl::Ytformation($youtubeDetails, $youtubeDetail);
                }elseif($videoType == 'vimeo'){
                    $vimeoDetails = SupportcollateraldtlsTbl::Vimeodetails($scDetail['scVideo']);
                    $ytVmDet = SupportcollateraldtlsTbl::Vmformation($vimeoDetails);
                }else{
                    $ytVmDet['title'] = $ytVmDet['description'] = $ytVmDet['from'] = $ytVmDet['thumbnail'] = '';
                }

                
                $url = $ytVmDet['thumbnail'];
                $headers = get_headers($url);
                $img_check =  stripos($headers[0],"200 OK") ? $url : 'assets/images/noimagenew.png';
                $ytVmDet['thumbnail'] = $img_check;

                $data['videos'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scVideo'=>$scDetail['scVideo'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'scType' => $scDetail['scType'],
                    'scSharedfk' => $scDetail['scSharedfk'],
                    'title' => $ytVmDet['title'], 
                    'description' => $ytVmDet['description'], 
                    'from' => $ytVmDet['from'], 
                    'thumbnail' => $ytVmDet['thumbnail'], 
                ];
            }
        }
        
        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
        ]);
    }


}
