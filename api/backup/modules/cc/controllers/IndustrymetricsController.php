<?php

namespace api\modules\cc\controllers;

use \api\modules\mst\controllers\MasterController;
use \common\models\CountryindgdpdtlsTbl;
use \common\models\CountryindgdphstyTbl;
use \common\components\Security;

/**
 * Default controller for the `cc` module
 */
class IndustrymetricsController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\CountryMaster';

    public function __construct($id='', $module='', $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
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

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
    
    public function actionSaveindustrymetrics(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $requestdata = $requestdata['industrymetrics'];
        $save = \common\models\CountryindgdpdtlsTbl::saveIndustryMetric($requestdata);
        
        if(is_numeric($save) && $save == 2) {
            return $this->asJson([
                'msg' => 'You can add gdp only for last three years',
                'status' => 0,
                'statusmsg' => 'warning',
            ]);
        }
        else {
            return $this->asJson([
                'msg' => ($save) ? 'Created successfully' : 'something went wrong',
                'status' => ($save) ? 1 : 0,
                'statusmsg' =>  ($save) ? 'success' : 'warning',
            ]);
        }
    }
    
    public function actionUpdateindustrymetrics(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $requestdata = $requestdata['industrymetrics'];
        $save = \common\models\CountryindgdpdtlsTbl::updateIndustryMetric($requestdata);
        return $this->asJson([
            'msg' => ($save) ? 'Updated successfully' : 'something went wrong',
            'status' => ($save) ? 1 : 0,
            'statusmsg' =>  ($save) ? 'success' : 'warning',
        ]);
    }
    
    public function actionGetindustrymetrics(){
        $save = \common\models\CountryindgdpdtlsTbl::getIndustryMetrics();
        return $this->asJson($save);
    }
    
    public function actionDeleteindustrymetrics() { 
        $id = Security::decrypt($_GET['id']);
        if(strpos($id,",")){
            $id = Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = (array) Security::sanitizeInput($id,'number');
        }
        $model = CountryindgdpdtlsTbl::updateDeleteStatus($id);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Industry Metric deleted successfully',
            ];
        }else{
            $result = [
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            ];
        }
        return $this->asJson($result);
    }
}
