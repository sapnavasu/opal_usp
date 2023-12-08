<?php
namespace api\modules\mda\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \common\models\OprsuppbroadcastTbl;

class BroadcastController extends MasterController{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

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
        Path : api/mda/broadcast/bcast-list-data
        Description : Bcast List Data 
        Params :    {
                        postParams:{
                            page, 
                            size,
                            column,
                            direction,

                        }
                    }
    */
    public function actionBcastListData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $bcastParams['page'] = isset($resParam->page)?$resParam->page:0;
        $bcastParams['size'] = isset($resParam->size)?$resParam->size:5;
        $bcastParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $bcastParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $bcastParams['bcastTitle'] = isset($resParam->messagetitle)?$resParam->messagetitle:'';
        $bcastParams['closingDate'] = (isset($resParam->closingdate) && !empty($resParam->closingdate))?Security::isDateValid($resParam->closingdate,'Y-m-d'):'';
        $bcastParams['bcastDtls'] = isset($resParam->bcastDtls)?$resParam->bcastDtls:'';

        $bcastListData = OprsuppbroadcastTbl::getBcastListData($bcastParams);

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $bcastListData['data'],
            'totalcount' => $bcastListData['totalcount'],
            'size' => $bcastListData['size'],
            'page' => $bcastListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/broadcast/fetch-bcast-details
        Description : Add / Fetch bcast details
        Params :    {
                        postParams:{
                            bcastPk
                        }
                    }
    */

    public function actionFetchBcastDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bcastPk) && !empty($resParam->bcastPk)){
            $bcastPk =  Security::decrypt($resParam->bcastPk);
            $bcastPk =  Security::sanitizeInput($bcastPk,'number');

            if($bcastPk > 0){
                $data['bcastDetails'] = OprsuppbroadcastTbl::getBcastDetails($bcastPk);
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
        Path : api/mda/broadcast/save-bcast
        Description : Add / Update bcast details
        Params :    {
                        postParams:{
                            bcastPk
                            bcastTitle
                            bcastDtls
                            closingDate
                            bcastFileUpload
                        }
                    }
    */
    public function actionSaveBcast(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->bcastTitle) && !empty($resParam->bcastTitle) && isset($resParam->closingDate) && !empty($resParam->closingDate)){
            $bcastPk =  Security::decrypt($resParam->bcastPk);
            $bcastPk =  Security::sanitizeInput($bcastPk,'number');

            $save['bcastTitle'] =  Security::sanitizeInput($resParam->bcastTitle,'string_spl_char');
            $save['bcastDtls'] =  Security::sanitizeInput($resParam->bcastDtls,'string_spl_char');
            $save['bcastFileUpload'] = implode(',', $resParam->bcastFileUpload);
            $save['closingDate'] =  Security::isDateValid($resParam->closingDate,'Y-m-d');

            if(!empty($resParam->searchTag)){
                $save['searchTag'] = implode(',', $resParam->searchTag);
            }

            if(!empty($save['bcastTitle']) && !empty($save['closingDate'])){
                $afterSave = OprsuppbroadcastTbl::saveBcastDetails($save, $bcastPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
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
        Path : api/mda/broadcast/update-bcast-status
        Description : Update News Status
        Params :    {
                        postParams:{
                            bcastPk,
                            bcastStatus
                        }
                    }
    */
    public function actionUpdateBcastStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bcastPk) && !empty($resParam->bcastPk) && isset($resParam->bcastStatus) && !empty($resParam->bcastStatus)){
            $bcastPk =  Security::decrypt($resParam->bcastPk);
            $bcastPk =  Security::sanitizeInput($bcastPk,'number');
            $bcastStatus =  Security::decrypt($resParam->bcastStatus);
            $bcastStatus =  Security::sanitizeInput($bcastStatus,'number');

            if($bcastPk > 0 && $bcastStatus > 0){
                $afterDelete = OprsuppbroadcastTbl::updateBcastDetails($bcastPk, $bcastStatus);

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
        Path : api/mda/broadcast/delete-bcast
        Description : Delete Bcast
        Params :    {
                        postParams:{
                            bcastPk
                        }
                    }
    */
    public function actionDeleteBcast(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->bcastPk) && !empty($resParam->bcastPk)){
            $bcastPk =  Security::decrypt($resParam->bcastPk);
            $bcastPk =  Security::sanitizeInput($bcastPk,'number');

            if($bcastPk > 0){
                $afterDelete = OprsuppbroadcastTbl::deleteBcastDetails($bcastPk);

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
        }
        return $resMessage;
    }
}
