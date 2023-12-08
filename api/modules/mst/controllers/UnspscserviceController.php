<?php

namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \common\models\ServicemstTbl;
use \api\modules\mst\models\SegmentmstTbl;
use \api\modules\mst\models\FamilymstTbl;
use \api\modules\mst\models\ClassmstTbl;

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
class UnspscserviceController extends MasterController
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
        Description : Add/Update Initializing Data
        Path : api/mst/unspscservice/initialize-add-update-data
        Params :    {
                        postParams:{
                            servicePk // if edit
                        }
                    }
    */
    public function actionInitializeAddUpdateData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->servicePk) && !empty($resParam->servicePk)){
            $servicePk = Security::decrypt($resParam->servicePk);
            $data['serviceDetails'] = $serviceDetails = ServicemstTbl::getServiceDetails($servicePk);
            if(!empty($serviceDetails)){
                $data['segmentData'] = $segmentData = SegmentmstTbl::getSegmentData();
                $data['familyData'] = $familyData = FamilymstTbl::getFamilyData($serviceDetails['segmentPK']);
                $data['classData'] = ClassmstTbl::getClassData($serviceDetails['segmentPK'], $serviceDetails['familyPk']);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }
        }else{
            $data['segmentData'] = $segmentData = SegmentmstTbl::getSegmentData();
            $data['familyData'] = $familyData = FamilymstTbl::getFamilyData($segmentData[0]['segmentPk']);
            $data['classData'] = ClassmstTbl::getClassData($segmentData[0]['segmentPk'], $familyData[0]['familyPk']);
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
        Description : Fetching Family data based on segment
        Path : api/mst/unspscservice/fetch-family-data
        Params :    {
                        postParams:{
                            segmentPk
                        }
                    }
    */
    public function actionFetchFamilyData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->segmentPk) && !empty($resParam->segmentPk)){
            $segmentPk = Security::decrypt($resParam->segmentPk);
            $segmentPk = Security::sanitizeInput($segmentPk,'number');
            if($segmentPk > 0) {
                $data['familyData'] = $familyData = FamilymstTbl::getFamilyData($segmentPk);
                $data['classData'] = ClassmstTbl::getClassData($segmentPk, $familyData[0]['familyPk']);
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
        Description : Fetching Class data based on segment & family
        Path : api/mst/unspscservice/fetch-class-data
        Params :    {
                        postParams:{
                            segmentPk,
                            familyPk
                        }
                    }
    */
    public function actionFetchClassData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->segmentPk) && !empty($resParam->segmentPk) && isset($resParam->familyPk) && !empty($resParam->familyPk)){
            $segmentPk = Security::decrypt($resParam->segmentPk);
            $familyPk = Security::decrypt($resParam->familyPk);

            $segmentPk = Security::sanitizeInput($segmentPk,'number');
            $familyPk = Security::sanitizeInput($familyPk,'number');

            if($segmentPk > 0 && $familyPk > 0) {
                $data['classData'] = ClassmstTbl::getClassData($segmentPk, $familyPk);
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
        Description : Fetching Class data based on segment & family
        Path : api/mst/unspscservice/add-update-unspsc
        Params :    {
                        postParams:{
                            segmentPk,
                            familyPk,
                            classPk,
                            serviceCode,
                            serviceName,
                            Status,
                            unspscId
                        }
                    }
    */
    public function actionAddUpdateUnspsc(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->segmentPk) && !empty($resParam->segmentPk) && isset($resParam->familyPk) && !empty($resParam->familyPk)){
            $segmentPk = Security::decrypt($resParam->segmentPk);
            $familyPk = Security::decrypt($resParam->familyPk);
            $classPk = Security::decrypt($resParam->classPk);

            $save['segmentPk'] = Security::sanitizeInput($segmentPk,'number');
            $save['familyPk'] = Security::sanitizeInput($familyPk,'number');
            $save['classPk'] = Security::sanitizeInput($classPk,'number');
            $save['serviceCode'] = Security::sanitizeInput($resParam->serviceCode,'number');
            $save['serviceName'] = Security::sanitizeInput($resParam->serviceName,'string');
            $unspscId = Security::sanitizeInput($resParam->unspscId,'number');
            $save['Status'] = (isset($resParam->Status) && ($resParam->Status == true))?'A':'I';


            if($save['segmentPk'] > 0 && $save['familyPk'] > 0 && $save['classPk'] > 0 && $save['serviceCode'] > 0 && !empty($save['serviceName']) && !empty($save['Status'])){
                $afterSave = ServicemstTbl::addUpdateUnspscService($save,$unspscId);
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
                    $message = $this->baseErrorMessage('bothAvailable');
                    $status = 104;
                }elseif($afterSave == 5){
                    $message = $this->baseErrorMessage('codeAvailable');
                    $status = 104;
                }elseif($afterSave == 6){
                    $message = $this->baseErrorMessage('nameAvailable');
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
        Description : Fetching Class data based on segment & family
        Path : api/mst/unspscservice/list-service-data
        Params :    {
                        postParams:{
                            page, 
                            size,
                            segmentName,
                            familyName,
                            className,
                            serviceCode,
                            serviceName,
                            status, 
                            column, 
                            direction
                        }
                    }
    */
    public function actionListServiceData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $serviceParams['page'] = isset($resParam->page)?$resParam->page:0;
        $serviceParams['size'] = isset($resParam->size)?$resParam->size:8;
        $serviceParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $serviceParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $serviceParams['segmentName'] = (isset($resParam->segmentName) && !empty($resParam->segmentName))?$resParam->segmentName:'';
        $serviceParams['familyName'] = (isset($resParam->familyName) && !empty($resParam->familyName))?$resParam->familyName:'';
        $serviceParams['className'] = (isset($resParam->className) && !empty($resParam->className))?$resParam->className:'';
        $serviceParams['serviceCode'] = (isset($resParam->serviceCode) && !empty($resParam->serviceCode))?$resParam->serviceCode:'';
        $serviceParams['serviceName'] = (isset($resParam->serviceName) && !empty($resParam->serviceName))?$resParam->serviceName:'';
        $serviceParams['status'] = (isset($resParam->status) && !empty($resParam->status))?$resParam->status:'';

        $serviceListData = ServicemstTbl::getServiceListData($serviceParams);

        return $this->asJson([
            'data' => $serviceListData['data'],
            'totalcount' => $serviceListData['totalcount'],
            'size' => $serviceListData['size'],
            'page' => $serviceListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Update status
        Path : api/mst/unspscservice/update-service-status
        Params :    {
                        postParams:{
                            servicePk,
                            status
                        }
                    }
    */
    public function actionUpdateServiceStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->servicePk) && !empty($resParam->servicePk) && isset($resParam->status) && !empty($resParam->status)){
            $servicePk = Security::decrypt($resParam->servicePk);
            $status = ($resParam->status == 'A')?'I':'A';
            $servicePk = Security::sanitizeInput($servicePk,'number');

            if($servicePk > 0) {
                $afterUpdate = ServicemstTbl::updateServiceStatus($servicePk, $status);

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
        Description : Update service
        Path : api/mst/unspscservice/delete-service
        Params :    {
                        postParams:{
                            servicePk
                        }
                    }
    */
    public function actionDeleteService(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->servicePk) && !empty($resParam->servicePk)){
            $servicePk = Security::decrypt($resParam->servicePk);
            $servicePk = Security::sanitizeInput($servicePk,'number');

            if($servicePk > 0) {
                $afterDelete = ServicemstTbl::deleteService($servicePk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
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
        Description : Update service
        Path : api/mst/unspscservice/multiple-delete
        Params :    {
                        postParams:{
                            servicePks
                        }
                    }
    */
    public function actionMultipleDelete(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->servicePks) && !empty($resParam->servicePks)){
            $servicePks = Security::decrypt($resParam->servicePks);
            $servicePks = explode(',', $servicePks);

            foreach ($servicePks as $key => $servicePk) {
                $afterDelete = ServicemstTbl::deleteService($servicePk);
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
            case 'bothAvailable':
                $resMessage = 'Service code and Service name is already available';
                break;
            case 'codeAvailable':
                $resMessage = 'Service code is already available';
                break;
            case 'nameAvailable':
                $resMessage = 'Service name is already available';
                break;
        }
        return $resMessage;
    }
}
