<?php

namespace api\modules\ea\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use common\components\UserActivityLog;
use \common\models\UserlogintrackTbl;
use \common\models\UsermonitorlogTbl;
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
class MonitorController extends MasterController
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

    public function actionGetactivitylist(){
//        $postVar = Yii::$app->request->post();
//        $params = json_decode($postVar,true);
//        $resParam = $params->postParams;
        $paramRequest = file_get_contents("php://input");
        $requestPost = json_decode($paramRequest,true);
        $requestParams = Yii::$app->request;
        $userid = $requestPost['userId'];
        if($userid == ''){
            return $this->asJson([
                'data' => '',
                'msg' => 'Invalid params',
                'status' => 101,
            ]);
        }
        $userData = UserActivityLog::getUserLogByUserId($userid,$requestPost);
        return $this->asJson([
                'data' => $userData,
                'msg' => 'Success',
                'status' => 100,
            ]);

    }
    /*
        Description : Get User Monitoring data
        Path : api/ea/monitor/get-monitor-user
        Params :    {
                        postParams:{
                            page
                            size
                            column
                            direction
                        }
                    }
    */

    public function actionGetMonitorUser(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        //GET PARAM
        $getRequestParams = Yii::$app->request;
        $sortBy = $getRequestParams->get('sortby');
        //$offset  = $getRequestParams->get('limit');
        
        $monitorParams['page'] = isset($resParam->page)?$resParam->page:0;
        $monitorParams['size'] = isset($resParam->size)?$resParam->size:10;
        $monitorParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $monitorParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;
        $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $stkRegPk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        $data = UserActivityLog::fetchAllUserActivityLog($stkRegPk, $sortBy);
       
        //$data['monitoringUser'] = UserActivityLog::monitoringUsers($mcpPk, $monitorParams);

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Feching activities of usr
        Path : api/ea/monitor/fetch-user-activities
        Params :    {
                        postParams:{
                            userPk
                            page
                            size
                            column
                            direction
                            filterDate
                        }
                    }
    */

    public function actionFetchUserActivities(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = $resParam->userPk;
            $userPk = Security::sanitizeInput($userPk,'number');
            $filterDate = '';
            if(isset($resParam->filterDate) && !empty($resParam->filterDate)){
                $filterDate = Security::isDateValid($resParam->filterDate,'Y-m-d');
            }
            if($userPk > 0){
                $monitorParams['page'] = isset($resParam->page)?$resParam->page:0;
                $monitorParams['size'] = isset($resParam->size)?$resParam->size:8;
                $monitorParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
                $direction = isset($resParam->direction)?$resParam->direction:'';
                $monitorParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

                $data['userActivities'] = UserActivityLog::fetchingUserActivity($userPk, $monitorParams, $filterDate);
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
        Description : Fetch User login details
        Path : api/ea/monitor/fetch-user-login-details
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionFetchUserLoginDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            $filterStDate = '';
            if(isset($resParam->filterStDate) && !empty($resParam->filterStDate)){
                $filterStDate = date('Y-m-d',strtotime($resParam->filterStDate));
            }
            $filterEdDate = '';
            if(isset($resParam->filterEdDate) && !empty($resParam->filterEdDate)){
                $filterEdDate = date('Y-m-d',strtotime($resParam->filterEdDate));
            }

            if($filterStDate == '' && $filterEdDate == ''){
                $filterEdDate = date('Y-m-d');
                $filterStDate = date('Y-m-d', strtotime('-7 days'));
            }

            if(!empty($userPk) && $userPk > 0){
                $page = (isset($resParam->page) && $resParam->page > 0)?$resParam->page:0;
                //print_r($userPk);die();
                $loginData = UserlogintrackTbl::fetchUserLoginReport($userPk, $page, $filterStDate, $filterEdDate);
                $data['loginData'] = $loginData['data'];
                $data['loginDataCount'] = $loginData['totalcount'];
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
        Description : Fetch User Activity details
        Path : api/ea/monitor/get-activity-log
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionGetActivityLog(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            $filterStDate = '';
            if(isset($resParam->filterStDate) && !empty($resParam->filterStDate)){
                $filterStDate = date('Y-m-d',strtotime($resParam->filterStDate));
            }
            $filterEdDate = '';
            if(isset($resParam->filterEdDate) && !empty($resParam->filterEdDate)){
                $filterEdDate = date('Y-m-d',strtotime($resParam->filterEdDate));
            }

            if($filterStDate == '' && $filterEdDate == ''){
                $filterEdDate = date('Y-m-d');
                $filterStDate = date('Y-m-d', strtotime('-7 days'));
            }
            if(!empty($userPk) && $userPk > 0){
                $page = (isset($resParam->page) && $resParam->page > 0)?$resParam->page:0;
                $data['activityData'] = $activityData = UserActivityLog::getUserLogByUserId($userPk, $page, $filterStDate, $filterEdDate);
                $data['activityDataCount'] = $activityData['activityCount'];
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
        Description : Export Login details
        Path : api/ea/monitor/export-login-data
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionExportLoginData(){
        $resParam = Yii::$app->request->get();
        $data = [];
        if(isset($resParam['userPk']) && !empty($resParam['userPk'])){
            $userPk = Security::decrypt($resParam['userPk']);
            $userPk = Security::sanitizeInput($userPk,'number');
            if(!empty($userPk) && $userPk > 0){
                $filterStDate = '';
                if(isset($resParam['filterStDate']) && !empty($resParam['filterStDate'])){
                    $filterStDate = date('Y-m-d',strtotime($resParam['filterStDate']));
                }
                $filterEdDate = '';
                if(isset($resParam['filterEdDate']) && !empty($resParam['filterEdDate'])){
                    $filterEdDate = date('Y-m-d',strtotime($resParam['filterEdDate']));
                }

                if($filterStDate == '' && $filterEdDate == ''){
                    $filterEdDate = date('Y-m-d');
                    $filterStDate = date('Y-m-d', strtotime('-7 days'));
                }

                $exportPath = UserlogintrackTbl::exportLoginData($userPk, $filterStDate, $filterEdDate);die;
                //return $exportPath;
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

        /*return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);*/
    }

    /*
        Description : Export Activity details
        Path : api/ea/monitor/export-activity-data
        Params :    {
                        postParams:{
                            userPk
                        }
                    }
    */
    public function actionExportActivityData(){
        $resParam = Yii::$app->request->get();
        $data = [];
        if(isset($resParam['userPk']) && !empty($resParam['userPk'])){
            $userPk = Security::decrypt($resParam['userPk']);
            $userPk = Security::sanitizeInput($userPk,'number');
            if(!empty($userPk) && $userPk > 0){
                $filterStDate = '';
                if(isset($resParam['filterStDate']) && !empty($resParam['filterStDate'])){
                    $filterStDate = date('Y-m-d',strtotime($resParam['filterStDate']));
                }
                $filterEdDate = '';
                if(isset($resParam['filterEdDate']) && !empty($resParam['filterEdDate'])){
                    $filterEdDate = date('Y-m-d',strtotime($resParam['filterEdDate']));
                }

                if($filterStDate == '' && $filterEdDate == ''){
                    $filterEdDate = date('Y-m-d');
                    $filterStDate = date('Y-m-d', strtotime('-7 days'));
                }
                $exportPath = UsermonitorlogTbl::exportActivityData($userPk, $filterStDate, $filterEdDate);die;
                //return $exportPath;
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

        /*return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);*/
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
