<?php

namespace api\modules\stat\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \api\modules\stat\components\Supplierstat;
use \common\models\DownloadtracktrnsTbl;

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
class SupplierstatisticsController extends MasterController
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
        Description : Fetch Supplier Statistics 
        Path : api/stat/supplierstatistics/fetch-stat-data
        Params :    {
                        postParams:{
                            filterFileds
                        }
                    }
    */
    public function actionFetchStatData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);

        $downloadStatus = DownloadtracktrnsTbl::find()
                                ->where([
                                    'dtt_usermst_fk' => $userPk,
                                    'dtt_downloadtype' => 1
                                ])
                                ->andWhere(['<>','dtt_downloadstatus','3'])
                                ->asArray()
                                ->one();

        if(empty($downloadStatus)){

            $filterHeadings = $resParam->filterFileds->supplier[0];  
            //echo'<pre>';print_r($resParam->filterFileds->supplier[0]);exit;

            $fromReportDate = $resParam->fromReportDate;
            $toReportDate = $resParam->toReportDate;

            $data = Supplierstat::supplierStatResult($filterHeadings, $fromReportDate, $toReportDate);
            $status = 100;
            $message = 'success';
        }else{
            $status = 101;
            $message = 'Your previous dowload is inprogress';
        }


        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Supplier Audit Log 
        Path : api/stat/supplierstatistics/supplier-audit-log
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionSupplierAuditLog(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $data['supAuditLog'] = DownloadtracktrnsTbl::fetchSupplierAuditLog();

        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => 100,
        ]);
    }

    /*
        Description : Supplier Audit Log 
        Path : api/stat/supplierstatistics/download-supplier-stat
        Params :    {
                        postParams:{
                            downloadPk
                        }
                    }
    */
    public function actionDownloadSupplierStat(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $downloadPk = $resParam->downloadPk;
        $downloadPk = Security::decrypt($downloadPk);
        $supplierReport = DownloadtracktrnsTbl::downloadAuditLog($downloadPk);
        $userPK = \yii\db\ActiveRecord::getTokenData('user_pk',true);

        $fileName = Yii::$app->params['supplierStatExportSavePath'].'reports/'.$supplierReport['downLoadfileName'];
        
        // echo'<pre>';print_r($supplierReport['userPk']);
        //echo'<pre>';print_r($userPK);exit;

        if(empty($supplierReport)){
            $status = 101; //no report available
            $message = 'File not available.'; // Error Message
        }elseif($supplierReport['userPk'] != $userPK){
            $status = 102; // Access Restricted
            $message = 'You do not have access for this page.';
        }elseif(!file_exists($fileName)){
            $status = 103; // File Not available
            $message = 'File not available.';
        }else{
            $status = 100; // Success
            $message = 'Success'; // Error Message
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Description : Export Supplier Stat 
        Path : api/stat/supplierstatistics/export-supplier-stat
        Params :    {
                        postParams:{
                            downloadPk,
                            userPk
                        }
                    }
    */
    public function actionExportSupplierStat(){
        $resParam = Yii::$app->request->get();
        $data = [];

        $downloadPk = Security::decrypt($resParam['downloadPk']);
        $userPk = Security::decrypt($resParam['userPk']);

        $supplierReport = DownloadtracktrnsTbl::downloadAuditLog($downloadPk);


        $updateSupplierReport = DownloadtracktrnsTbl::updateSupplierReport($downloadPk);

        $fileName = Yii::$app->params['supplierStatExportSavePath'].'reports/'.$supplierReport['downLoadfileName'];

        if (file_exists($fileName)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fileName));
            readfile($fileName);exit;
        }
        echo'<pre>';print_r('condition');exit;
        return $fileName;
    }

    /*
        Description : Cron Supplier Statistics 
        Path : api/stat/supplierstatistics/cron-stat-data
        Params :    {
                        postParams:{
                        }
                    }
    */
    public function actionCronStatData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data = Supplierstat::cronSupplierStatResult();
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
}
