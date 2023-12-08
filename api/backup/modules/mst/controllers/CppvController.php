<?php

namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \api\modules\mst\models\GcccategorymstTbl;
use \api\modules\mst\models\GcccpvmstTbl;

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
class CppvController extends MasterController
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
        Description : Add / Update Category and Subcategory of CPPV 
        Path : api/mst/cppv/add-update-cppv
        Params :    {
                        postParams:{
                            cppvPk,
                            cppvName,
                            cppvCode
                            cppvType,
                            cppvStatus
                        }
                    }
    */
    public function actionAddUpdateCppv(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->cppvName) && !empty($resParam->cppvName) && isset($resParam->cppvCode) && !empty($resParam->cppvCode) && isset($resParam->cppvType) && !empty($resParam->cppvType)){

            if(!empty($resParam->cppvPk)){
                $cppvPk = Security::decrypt($resParam->cppvPk);
            }
            $cppvPk = (isset($cppvPk) && ($cppvPk > 0))?$cppvPk:'';
            $save['cppvName'] = Security::sanitizeInput($resParam->cppvName,'string');
            $save['cppvCode'] = Security::sanitizeInput($resParam->cppvCode,'string');
            $save['cppvType'] = $cppvType = $resParam->cppvType;
            $save['cppvStatus'] = (isset($resParam->cppvStatus) && $resParam->cppvStatus == true)?1:2;

            if(!empty($save['cppvName']) && !empty($save['cppvCode'])){
                if($cppvType > 0){
                    $save['cppvFk'] = $cppvType;
                    $afterSave = GcccpvmstTbl::saveSubcategory($save, $cppvPk);
                }else{
                    $afterSave = GcccategorymstTbl::saveCategory($save, $cppvPk);
                }

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
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
                $message = $this->baseErrorMessage('missingFields');
                $status = 101;
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
        Description : Get Main Category 
        Path : api/mst/cppv/get-main-category
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionGetMainCategory(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $data['category'] = GcccategorymstTbl::getAllActiveCategory();
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : ListData 
        Path : api/mst/cppv/cppv-list-data
        Params :    {
                        postParams:{
                            page, 
                            size,
                        }
                    }
    */
    public function actionCppvListData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $cppvParams['page'] = isset($resParam->page)?$resParam->page:0;
        $cppvParams['size'] = isset($resParam->size)?$resParam->size:10;
        $cppvParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $cppvParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $cppvParams['CPVCategory'] = isset($resParam->CPVCategory)?$resParam->CPVCategory:'';
        $cppvParams['Category'] = isset($resParam->Category)?$resParam->Category:'';
        $cppvParams['status'] = isset($resParam->status)?$resParam->status:'';
        $cppvParams['SelectRootCategory'] = isset($resParam->SelectRootCategory)?$resParam->SelectRootCategory:'';
        
        $cppvListData = GcccategorymstTbl::getCppvListData($cppvParams);

        $cppvLstData = [];
        foreach ($cppvListData['data'] as $key => $cppvData) {
            if($cppvData['refName'] == 'Root'){
                $cppvLstData[$key] = $cppvData;
                $subCatCount = GcccpvmstTbl::checkSubcatgoryCount($cppvData['pk']);
                $subCatActiveCount = GcccpvmstTbl::checkSubcatgoryActiveCount($cppvData['pk']);
                $cppvLstData[$key]['subCatCount'] = count($subCatCount);
                $cppvLstData[$key]['subCatActiveCount'] = count($subCatActiveCount);
            }else{
                $cppvLstData[$key] = $cppvData;
                $cppvLstData[$key]['subCatCount'] = 0;
                $cppvLstData[$key]['subCatActiveCount'] = 0;
            }
        }
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $cppvLstData,
            'totalcount' => $cppvListData['totalcount'],
            'size' => $cppvListData['size'],
            'page' => $cppvListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Update Status 
        Path : api/mst/cppv/update-cppv-status
        Params :    {
                        postParams:{
                            cppvPk,
                            cppvStatus,
                            cppvRefType,
                            categoryPk
                        }
                    }
    */
    public function actionUpdateCppvStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->cppvPk) && isset($resParam->cppvStatus) && isset($resParam->cppvRefType) && isset($resParam->categoryPk)){
            $cppvPk = Security::decrypt($resParam->cppvPk);
            $cppvStatus = ($resParam->cppvStatus == 2)?1:2;
            $cppvRefType = ($resParam->cppvRefType == 'Root')?1:2;

            if($cppvRefType == 1){
                $afterUpdate = GcccategorymstTbl::updateStatus($cppvStatus, $cppvPk, $resParam->categoryPk);
                if($cppvStatus == 2){
                    GcccpvmstTbl::updateStatusByCatId($cppvStatus, $cppvPk);
                }
            }else{
                $afterUpdate = GcccpvmstTbl::updateStatus($cppvStatus, $cppvPk, $resParam->categoryPk);
            }

            if($afterUpdate == 1){
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }elseif($afterUpdate == 2){
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }elseif($afterUpdate == 3){
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }elseif($afterUpdate == 4){
                $message = 'Subcategory is active';
                $status = 104;
            }elseif($afterUpdate == 5){
                $message = 'Category is inactive';
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
        Description : Update Status 
        Path : api/mst/cppv/delete-cppv
        Params :    {
                        postParams:{
                            cppvPk,
                            cppvRefType
                        }
                    }
    */
    public function actionDeleteCppv(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->cppvPk) && isset($resParam->cppvRefType)){
            $cppvPk = Security::decrypt($resParam->cppvPk);
            $cppvRefType = ($resParam->cppvRefType == 'Root')?1:2;

            if($cppvRefType == 1){
                $afterDelete = GcccategorymstTbl::deleteCategory($cppvPk);
                GcccpvmstTbl::deleteSubCategoryByCatid($cppvPk);
            }else{
                $afterDelete = GcccpvmstTbl::deleteSubCategory($cppvPk);
            }

            if($afterDelete == 1){
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }elseif($afterDelete == 2){
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }elseif($afterDelete == 3){
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }elseif($afterDelete == 4){
                $message = 'Some Subcategory is available';
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
        Description : Fetch Edit details
        Path : api/mst/cppv/fetch-categories
        Params :    {
                        postParams:{
                            cppvPk,
                            cppvRefType
                        }
                    }
    */
    public function actionFetchCategories(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->cppvPk) && isset($resParam->cppvRefType)){
            $cppvPk = Security::decrypt($resParam->cppvPk);
            $cppvRefType = ($resParam->cppvRefType == 'Root')?1:2;

            if($cppvRefType == 1){
                $data['categoryDetails'] = GcccategorymstTbl::fetchCategory($cppvPk);
            }else{
                $data['categoryDetails'] = GcccpvmstTbl::fetchSubCategory($cppvPk);
            }

            $data['category'] = GcccategorymstTbl::getAllActiveCategory();
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
            
            foreach ($servicePks as $key => $serviceData) {
                $serviceArr = explode('---',$serviceData);
                if($serviceArr[1] == 'Root'){
                    $afterDelete = GcccategorymstTbl::deleteCategory($serviceArr[0]);
                }else{
                    $afterDelete = GcccpvmstTbl::deleteSubCategory($serviceArr[0]);
                }
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
                $resMessage = 'Category / Subcategory code and Category / Subcategory name is already available';
                break;
            case 'codeAvailable':
                $resMessage = 'Category / Subcategory code is already available';
                break;
            case 'nameAvailable':
                $resMessage = 'Category / Subcategory name is already available';
                break;
        }
        return $resMessage;
    }
}
