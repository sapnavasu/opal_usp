<?php

namespace api\modules\mcp\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\models\MembercompanymstTbl;

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
class AboutusController extends MasterController
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
        Path : api/mcp/aboutus/save-aboutus
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                            aboutus
                        }
                    }
    */

    public function actionSaveAboutus(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(1,'Saved the company\'s About us details.',$url,111);
        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk) && isset($resParam->aboutus) && !empty($resParam->aboutus)){
            $mcpPk = Security::decrypt($resParam->mcpPk);
            $save['aboutus'] = Security::sanitizeInput($resParam->aboutus,'html');
            if($mcpPk > 0 && !empty($save['aboutus'])){
                $afterSave = MembercompanymstTbl::saveAboutCompany($save,$mcpPk,1);

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
        Path : api/mcp/aboutus/save-vission-mission
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                            vision,
                            mission
                        }
                    }
    */

    public function actionSaveVissionMission(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(1,'Saved the company\'s Vision & Mision details.',$url,111);
        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk) && (!empty($resParam->vision) ||  !empty($resParam->mission))){
            $mcpPk = Security::decrypt($resParam->mcpPk);
            if(!empty($resParam->vision)){
                $save['vision'] = Security::sanitizeInput($resParam->vision,'html');
            }
            if(!empty($resParam->mission)){
                $save['mission'] = Security::sanitizeInput($resParam->mission,'html');
            }
            if($mcpPk > 0 && (!empty($save['vision']) || !empty($save['mission']))){
                $afterSave = MembercompanymstTbl::saveAboutCompany($save,$mcpPk,2);

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
        Path : api/mcp/aboutus/fetch-about-company
        Description : Add/Update Component Loading Contents
        Params :    {
                        postParams:{
                            mcpPk,
                            vision,
                            mission
                        }
                    }
    */

    public function actionFetchAboutCompany(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        \common\components\UserActivityLog::logUserActivity(5,'Visited the About Company page.',$url,111);
        if(isset($resParam->mcpPk) && !empty($resParam->mcpPk)){
            $mcpPk = Security::decrypt($resParam->mcpPk);
            $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $stkFields = ['MemberCompMst_Pk','mcm_aboutus','mcm_vision','mcm_mission','MCM_CompanyName','MCM_crnumber','mcm_complogo_memcompfiledtlsfk'];
            $stkCondition = ['MemberCompMst_Pk'=>$mcpPk];
            $fetchData = MembercompanymstTbl::fetchCc($stkCondition, $stkFields, 'one');
            if(!empty($fetchData)){
                $data = [
                    'aboutus'=>htmlspecialchars_decode($fetchData->mcm_aboutus),
                    'vision'=>htmlspecialchars_decode($fetchData->mcm_vision),
                    'mission'=>htmlspecialchars_decode($fetchData->mcm_mission),
                    'companyName'=>$fetchData->MCM_CompanyName,
                    'regNo'=>$fetchData->MCM_crnumber,
                    'mcpPk'=>$mcpPk,
                    'logo_url' => \common\components\Drive::generateUrl($fetchData->mcm_complogo_memcompfiledtlsfk,$fetchData->MemberCompMst_Pk,$userpk)
                ];
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
