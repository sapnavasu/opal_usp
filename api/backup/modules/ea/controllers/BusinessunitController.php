<?php

namespace api\modules\ea\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \common\models\MemcompsectordtlsTbl;
use \api\modules\mst\models\SectormstTbl;

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
class BusinessunitController extends MasterController
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
        Description : List Business unit
        Path : api/ea/businessunit/list-bunit
        Params :    {
                        postParams:{
                            mcpPk,
                            page, 
                            size,
                            keyworsSrh,
                            column, 
                            direction
                        }
                    }
    */
    public function actionListBunit(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;

        $bunitParams['page'] = isset($resParam->page)?$resParam->page:0;
        $bunitParams['size'] = isset($resParam->size)?$resParam->size:10;

        $bunitParams['keyworsSrh'] = isset($resParam->searchKey)?$resParam->searchKey:'';
        $bunitParams['sectorPks'] = isset($resParam->sector)?$resParam->sector:'';
        $bunitParams['divisionPks'] = isset($resParam->division)?$resParam->division:'';

        $bunitParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $bunitParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;
        $mcpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $bUnitListData = MemcompsectordtlsTbl::getBunitList($bunitParams, $mcpPk);
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $bUnitListData['data'],
            'totalcount' => $bUnitListData['totalcount'],
            'overAllCount' => $bUnitListData['overAllCount'],
            'size' => $bUnitListData['size'],
            'page' => $bUnitListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Add/Update Business unit Department
        Path : api/ea/businessunit/save-bunit
        Params :    {
                        postParams:{
                            bunitPk,
                            bunitSector,
                            bunitName,
                            bunitDesc
                        }
                    }
    */
    public function actionSaveBunit(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bunitSector) && !empty($resParam->bunitSector) && isset($resParam->bunitName) && !empty($resParam->bunitName) && isset($resParam->bunitDesc) && !empty($resParam->bunitDesc)){

            $bunitPk = Security::decrypt($resParam->bunitPk);
            $bunitPk = Security::sanitizeInput($bunitPk,'number');
            $save['bunitSector'] = implode(',', $resParam->bunitSector);
            $save['bunitName'] = Security::sanitizeInput($resParam->bunitName,'string');
            $save['bunitDesc'] = Security::sanitizeInput($resParam->bunitDesc,'string');
            $save['cmpPK'] = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
            $afterSave = MemcompsectordtlsTbl::saveBusinessUnitDetails($save, $bunitPk);

            $alreadySectorName = '';
            if(!empty($afterSave['alreadyBunittArr'])){
                $alreadySectorName = implode(', ', $afterSave['alreadyBunittArr']);
            }
            if($afterSave['ret'] == 1){
                $data['bunitPk'] = $afterSave['bunitPk'];
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }elseif($afterSave['ret'] == 2){
                $message = $this->baseErrorMessage('notAvailable');
                $status = 104;
            }elseif($afterSave['ret'] == 3){
                $message = $this->baseErrorMessage('dbError');
                $status = 103;
            }elseif($afterSave['ret'] == 4){
                $message = '"'.$alreadySectorName.'" '.$this->baseErrorMessage('smAlreadyAvailable');
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
        Description : Fetch Business unit for businessunit detail
        Path : api/ea/businessunit/fetch-bunit-detail
        Params :    {
                        postParams:{
                            bunitPk
                        }
                    }
    */
    public function actionFetchBunitDetail(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bunitPk) && !empty($resParam->bunitPk)){
            $bunitPk = Security::decrypt($resParam->bunitPk);
            $bunitPk = Security::sanitizeInput($bunitPk,'number');
            if(!empty($bunitPk) && $bunitPk > 0){
                $data['bunitData'] = MemcompsectordtlsTbl::fetchBunitDetail($bunitPk);
                $data['bunitData']['bunitSectorFk'] = explode(',', $data['bunitData']['bunitSectorFk']);

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
        Description : Delete Business Unit
        Path : api/ea/businessunit/delete-bunit
        Params :    {
                        postParams:{
                            bunitPk
                        }
                    }
    */
    public function actionDeleteBunit(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bunitPk) && !empty($resParam->bunitPk)){
            $bunitPk = Security::decrypt($resParam->bunitPk);
            $bunitPk = Security::sanitizeInput($bunitPk,'number');
            if(!empty($bunitPk) && $bunitPk > 0){
                $afterDelete = MemcompsectordtlsTbl::deleteBunit($bunitPk);

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
        Description : Filter for Enterprise admin user and activity initial data
        Path : api/ea/businessunit/bunit-filter-initial-data
        Params :    {
                        postParams:{
                            
                        }
                    }
    */
    public function actionBunitFilterInitialData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $mcpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['sectorData'] = SectormstTbl::getSectorDtl();
        $data['bunitData'] = MemcompsectordtlsTbl::fetchBunitData($mcpPk);

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : User 
        Path : api/ea/businessunit/fetch-bunit-data
        Params :    {
                        postParams:{
                            
                        }
                    }
    */
    public function actionFetchBunitData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->compPk) && !empty($resParam->compPk) && $resParam->compPk != 'undefined'){
            $mcpPk =  Security::decrypt($resParam->compPk);
        }else{
             $mcpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        }       
        $data['bunitData'] = MemcompsectordtlsTbl::fetchBunitData($mcpPk);

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : View division data
        Path : api/ea/businessunit/view-bunit-data
        Params :    {
                        postParams:{
                            bunitPk
                        }
                    }
    */
    public function actionViewBunitData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $bunitPk =  Security::decrypt($resParam->bunitPk);
        $busunitdata = MemcompsectordtlsTbl::fetchViewBunitData($bunitPk);
        $data['viewBunitData'] = $busunitdata;
        if($busunitdata['deptName'] != null){
            $data['viewBunitData']['deptDetails'] = explode(',', $busunitdata['deptName']);
            $data['viewBunitData']['deptCount'] = count($data['viewBunitData']['deptDetails']);
        }else{
            $data['viewBunitData']['deptDetails'] = [];
            $data['viewBunitData']['deptCount'] = 0;
        }
        

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
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
                $resMessage = 'Sector already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
        }
        return $resMessage;
    }
    public function actionFetchDivisonBySector(){
        $response = [];
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->sectorPk) && !empty($resParam->sectorPk)){
            $businessunitList = \common\models\MemcompsectordtlsTbl::getdivisionbysector($resParam->sectorPk);
        }else{
            $businessunitList = [];
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'divsions' => $businessunitList,
            'msg' => 'success',
            'status' => 100,
        ]);
    }
    public function actionFetchSectorByDivision(){
        $response = [];
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->divisionid) && !empty($resParam->divisionid)){
            $sectorData = \api\modules\mst\models\SectormstTbl::getsectorbydivsion($resParam->divisionid);
        }else{
            $sectorData = [];
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'sectorData' => $sectorData,
            'msg' => 'success',
            'status' => 100,
        ]);
    }
}
