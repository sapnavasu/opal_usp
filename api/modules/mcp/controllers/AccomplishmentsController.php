<?php

namespace api\modules\mcp\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\MemcompacomplishdtlsTbl;
use common\models\MembercompanymstTbl;
use common\models\UsermstTbl;
use common\components\Drive;
use DateTime;
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
class AccomplishmentsController extends MasterController
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
        Description : Add/Update Accomplishment
        Path : api/mcp/accomplishments/save-accomplishment
        Params :    {
                        postParams:{
                            acmpPk,
                            mcpPk,
                            acmpType,   1 - Certificate, 2 - Award, 3 - Achivement
                            acmpTitle,  1 - Certificate Title, 2 - Award Title, 3 - Achivement Title
                            acmpIssuedOn, 1 - Issued On, 2 - Awarded On, 3 - Year
                            acmpBy, 1 - Issued By, 2 - Awarded By, 3 - Not required
                            acmpDescription, 1 - Description, 2 - Description, 3 - Description
                            acmpUpload
                        }
                    }
    */

    public function actionSaveAccomplishment(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        
        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk) && isset($resParam->acmpType) && !empty($resParam->acmpType)){
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);
            
            $afterSave = $this->actionSaveCertificate($resParam);

            $data = $afterSave['data'];
            $message = $afterSave['message'];
            $status = $afterSave['status'];
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

    /* Check parameters for this () in  actionSaveAccomplishment ()*/
    public function actionSaveCertificate($resParam){
        $res['data'] = [];
        if(isset($resParam->acmpTitle) && !empty($resParam->acmpTitle) && isset($resParam->acmpIssuedOn) && !empty($resParam->acmpIssuedOn) && ($resParam->acmpType == 3 || ($resParam->acmpType != 3 && isset($resParam->acmpBy) && !empty($resParam->acmpBy))) && isset($resParam->acmpUpload) && !empty($resParam->acmpUpload)){

            $acmpPk = Security::sanitizeInput($resParam->acmpPk,'number');
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            if ($resParam->acmpType == 1) {
                $descTxt = 'Saved the company\'s Certificate details.';
                if(!empty($resParam->acmpPk)){
                    $descTxt = 'Updated the company\'s Certificate details. ';
                }
            } else if ($resParam->acmpType == 2) {
                $descTxt = 'Saved the company\'s Awards .';
                if(!empty($resParam->acmpPk)){
                    $descTxt = 'Updated the company\'s Award details.';
                }
            } else if ($resParam->acmpType == 3) {
                $descTxt = 'Saved the company\'s Achievements.';
                if(!empty($resParam->acmpPk)){
                    $descTxt = 'Updated the company\'s Achievements.';
                }
            }
            \common\components\UserActivityLog::logUserActivity(1,$descTxt,$url,112);
            $save['mcpPk'] = Security::sanitizeInput($resParam->mcpPk,'number');
            $save['acmpType'] = Security::sanitizeInput($resParam->acmpType,'number');
            $save['acmpTitle'] = Security::sanitizeInput($resParam->acmpTitle,'string_spl_char');
            $save['newsUrl'] = Security::sanitizeInput($resParam->newsURL,'string_spl_char');
            $save['newsUpload'] = $resParam->newsUpload;
            $save['country'] = $resParam->country;
            $acmpIssuedOn = Security::isDateValid($resParam->acmpIssuedOn,'Y-m-d');
            $date = new DateTime($acmpIssuedOn);
            $currentdate =  $date->format('Y-m-d');
            $save['acmpIssuedOn'] = $currentdate;
            if($save['acmpType'] != 3){
                $save['acmpBy'] = Security::sanitizeInput($resParam->acmpBy,'string_spl_char');
            }
            $save['acmpDescription'] = Security::sanitizeInput($resParam->acmpDescription,'string_spl_char');
            $save['acmpUpload'] = $resParam->acmpUpload;
            if($save['acmpType'] > 0 && !empty($save['acmpTitle']) && !empty($save['acmpIssuedOn']) && ($save['acmpType'] == 3 || ($save['acmpType'] != 3 && isset($save['acmpBy']) && !empty($save['acmpBy'])))){
                $afterSave = MemcompacomplishdtlsTbl::saveAccomplishment($save,$acmpPk);
                if($afterSave == 1){
                    $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAllAccomplisment($resParam->mcpPk, $resParam->acmpType, $resParam->size);
                    $res['data'] = $this->arrayFormation($accomplishmentDetails);
                    $res['message'] = $this->baseErrorMessage('success');
                    $res['status'] = 100;
                }elseif($afterSave == 2){
                    $res['message'] = $this->baseErrorMessage('notAvailable');
                    $res['status'] = 104;
                }else{
                    $res['message'] = $this->baseErrorMessage('dbError');
                    $res['status'] = 103;
                }
            }else{
                $res['message'] = $this->baseErrorMessage('sanitizeError');
                $res['status'] = 106;
            }
        }else{
            $res['message'] = $this->baseErrorMessage('missingFields');
            $res['status'] = 101;
        }

        return $res;
    }

    /*
        Description : Delete Accomplishment
        Path : api/mcp/compliacecertification/delete-accomplishment
        Params :    {
                        postParams:{
                            acmpPk,
                            acmpType,
                            mcpPk
                        }
                    }
    */

    public function actionDeleteAccomplishment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $desc = '';
        if($resParam->acmpType == 1){
            $desc = 'Deleted Certificate.';
        }else if($resParam->acmpType == 2){
            $desc = 'Deleted Award.';
        }else if($resParam->acmpType == 3){
            $desc = 'Deleted Achievements.';
        }
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(3,$desc,$url,112);
        if(isset($resParam->acmpPk) && !empty($resParam->acmpPk) && isset($resParam->acmpType) && !empty($resParam->acmpType) && isset($resParam->mcpPk) && !empty($resParam->mcpPk)){

            $resParam->acmpPk = Security::decrypt($resParam->acmpPk);
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);

            $acmpPk = Security::sanitizeInput($resParam->acmpPk,'number');
            $acmpType = Security::sanitizeInput($resParam->acmpType,'number');
            $mcpPk = Security::sanitizeInput($resParam->mcpPk,'number');

            if($acmpPk > 0 && $acmpType > 0 && $mcpPk > 0){
                $checkprojacc = MemcompacomplishdtlsTbl::deleteprojectAccomplishment($acmpPk);
                if($checkprojacc == 1){
                        $afterDelete =MemcompacomplishdtlsTbl::deleteAccomplishment($acmpPk);
                        if($afterDelete == 1){
                       $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAllAccomplisment($mcpPk, $acmpType);
                       if(!empty($accomplishmentDetails)){
                           $data = $this->arrayFormation($accomplishmentDetails);
                       }else{
                           if($acmpType == 1){
                               $data['certificateArr'] = [];
                           }elseif($acmpType == 2){
                               $data['awardArr'] = [];
                           }elseif($acmpType == 3){
                               $data['achivementArr'] = [];
                           }
                       }
                       $message = $this->baseErrorMessage('success');
                       $status = 100;
                   }elseif($afterDelete == 2){
                       $message = $this->baseErrorMessage('notAvailable');
                       $status = 104;
                   }else{
                       $message = $this->baseErrorMessage('dbError');
                       $status = 103;
                   }
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
        Description : Fetching Data for Accomplishment
        Path : api/mcp/compliacecertification/fetch-accomplishment
        Params :    {
                        postParams:{
                            mcpPk
                        }
                    }
    */
    public function actionFetchAccomplishment(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = []; 
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        if(isset($resParam->mcpPk) && $resParam->is-inInitial == 'true'){
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            \common\components\UserActivityLog::logUserActivity(5,'Visited the Accomplishments page.',$url,112);
        }
        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk)){
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);
            $mcpPk = Security::sanitizeInput($resParam->mcpPk,'number');
            if($mcpPk > 0){
                if(!empty($resParam->type)) {
                    $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAccomplismentByType($mcpPk,$resParam->type,$resParam->size, $resParam->page);
                    $data = $this->arrayFormation($accomplishmentDetails);
                } else {
                    $d;
                    $arr = ['1' => 'certificate', '2' => 'award', '3' => 'achievement'];
                    foreach ($arr as $key => $val) {
                        $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAllAccomplisment($mcpPk, $key);
                        $d = $this->arrayFormation($accomplishmentDetails);
                        $data[$val."Arr"] = $d[$val."Arr"];
                        $data[$val."Count"] = $d[$val."Count"];
                    }
                }
                $stkCondition = ['MemberCompMst_Pk'=>$mcpPk];
                $stkFields = ['MemberCompMst_Pk','MCM_CompanyName','MCM_crnumber','mcm_complogo_memcompfiledtlsfk'];
                $companyDetails = MembercompanymstTbl::fetchCc($stkCondition, $stkFields,'one');
                $logoUrl = \common\components\Drive::generateUrl($companyDetails->mcm_complogo_memcompfiledtlsfk,$companyDetails->MemberCompMst_Pk,$userpk);
                $data['companyDetails'] = ['companyName'=>$companyDetails->MCM_CompanyName,'companyNo'=>$companyDetails->MCM_crnumber, 'logo_url' => $logoUrl];
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
    
    function arrayFormation($accomplishmentDetails){
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        foreach ($accomplishmentDetails['data'] as $key => $accomplishmentDtl) {
            $filetype = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($accomplishmentDtl->mcad_uploadpath);
            $uploadUrl = Drive::generateUrl($accomplishmentDtl->mcad_uploadpath,$accomplishmentDtl->mcad_membercompmst_fk,$userPk);
            if($accomplishmentDtl->mcad_type == 1){
                $data['certificateCount'] = $accomplishmentDetails['count'];
                $data['certificateArr'][] = [
                    'acmpPk'=>$accomplishmentDtl->memcompacomplishdtls_pk,
                    'title'=> (!empty($accomplishmentDtl->mcad_title) ?html_entity_decode($accomplishmentDtl->mcad_title, ENT_QUOTES) : '-' ),
                    'country'=>$accomplishmentDtl->mcad_countrymst_fk,
                    'countryName'=>$accomplishmentDtl->country->CyM_CountryName_en,
                    'uploadPath'=>$accomplishmentDtl->mcad_uploadpath,
                    'issuedOn'=>$accomplishmentDtl->mcad_issuedon,
                    'issuedBy'=>html_entity_decode($accomplishmentDtl->mcad_issuedby, ENT_QUOTES),
                    'type'=>$accomplishmentDtl->mcad_type,
                    'privacy'=>$accomplishmentDtl->mcad_view,
                    'uploadUrl'=>$uploadUrl,
                    'filetype'=>$filetype,
                    'newsUrl'=>$accomplishmentDtl->mcad_newsurl,
                    'newsImageUrl'=> $accomplishmentDtl->mcad_newsupload,
                ];
            }
            if($accomplishmentDtl->mcad_type == 2){
                $filetype = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($accomplishmentDtl->mcad_uploadpath);
                $uploadUrl = Drive::generateUrl($accomplishmentDtl->mcad_uploadpath,$accomplishmentDtl->mcad_membercompmst_fk,$userPk);
                $data['awardCount'] = $accomplishmentDetails['count'];
                $data['awardArr'][] = [
                    'acmpPk'=>$accomplishmentDtl->memcompacomplishdtls_pk,
                    'title'=> (!empty($accomplishmentDtl->mcad_title) ?html_entity_decode($accomplishmentDtl->mcad_title, ENT_QUOTES) : '-' ),
                    'uploadPath'=>$accomplishmentDtl->mcad_uploadpath,
                    'issuedOn'=>$accomplishmentDtl->mcad_issuedon,
                    'issuedBy'=>html_entity_decode($accomplishmentDtl->mcad_issuedby, ENT_QUOTES),
                    'type'=>$accomplishmentDtl->mcad_type,
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl->mcad_newsurl,
                    'filetype'=>$filetype,
                    'newsImageUrl'=> $accomplishmentDtl->mcad_newsupload,
                ];
            }
            if($accomplishmentDtl->mcad_type == 3){
                $filetype = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($accomplishmentDtl->mcad_uploadpath);
                $uploadUrl = Drive::generateUrl($accomplishmentDtl->mcad_uploadpath,$accomplishmentDtl->mcad_membercompmst_fk,$userPk);
                $data['achievementCount'] = $accomplishmentDetails['count'];
                $data['achievementArr'][] = [
                    'acmpPk'=>$accomplishmentDtl->memcompacomplishdtls_pk,
                    'title'=> (!empty($accomplishmentDtl->mcad_title) ?html_entity_decode($accomplishmentDtl->mcad_title, ENT_QUOTES) : '-' ),
                    'uploadPath'=>$accomplishmentDtl->mcad_uploadpath,
                    'issuedOn'=>$accomplishmentDtl->mcad_issuedon,
                    'desc'=>$accomplishmentDtl->mcad_desc,
                    'type'=>$accomplishmentDtl->mcad_type,
                    'uploadUrl'=>$uploadUrl,
                    'filetype'=>$filetype,
                ];
            }
        }

        return $data;
    }

    /*
        Description : Fetching Data for Accomplishment Edit
        Path : api/mcp/compliacecertification/fetch-acmp
        Params :    {
                        postParams:{
                            acmpPk,
                            acmpType
                        }
                    }
    */
    public function actionFetchAcmp(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->acmpPk) && !empty($resParam->acmpPk) && isset($resParam->acmpType) && !empty($resParam->acmpType)){

            $resParam->acmpPk = Security::decrypt($resParam->acmpPk);
            $resParam->mcpPk = Security::decrypt($resParam->mcpPk);

            $acmpPk = Security::sanitizeInput($resParam->acmpPk,'number');
            $acmpType = Security::sanitizeInput($resParam->acmpType,'number');

            if($acmpPk > 0 && $acmpType > 0){
                $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAcmp($acmpPk);
                if(!empty($accomplishmentDetails)){
                    $data['acmpPk'] = $accomplishmentDetails->memcompacomplishdtls_pk;
                    $data['mcpPk'] = $accomplishmentDetails->mcad_membercompmst_fk;
                    $data['title'] =  (!empty($accomplishmentDetails->mcad_title) ?html_entity_decode($accomplishmentDetails->mcad_title, ENT_QUOTES) : '-' );
                    $data['acmpType'] = $accomplishmentDetails->mcad_type;
                    $data['uploadPath'] = $accomplishmentDetails->mcad_uploadpath;
                    $data['desc'] = $accomplishmentDetails->mcad_desc;
                    $data['issuedOn'] = $accomplishmentDetails->mcad_issuedon;
                    $data['newsUrl'] = $accomplishmentDetails->mcad_newsurl;
                    $data['newsImageUrl'] = $accomplishmentDetails->mcad_newsupload;
                    $data['country_pk'] = $accomplishmentDetails->mcad_countrymst_fk;
                    if($acmpType != 3){
                        $data['issuedBy'] = html_entity_decode($accomplishmentDetails->mcad_issuedby, ENT_QUOTES);
                    }
                    
                    if($acmpType == 1){
                        $data['privacy'] = $accomplishmentDetails->mcad_view;
                    }
                    $data['acmpUploadArr'] = $data['acmpUpload'] = [];
                    if(!empty($accomplishmentDetails->mcad_uploadpath)){
                        $data['acmpUpload'][] = (string)$accomplishmentDetails->mcad_uploadpath;
                        $data['acmpUploadArr'][] = (int)$accomplishmentDetails->mcad_uploadpath;
                    }
                }
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
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
        }
        return $resMessage;
    }
}
