<?php

namespace api\modules\pms\controllers;

use Yii;
use yii\rest\ActiveController;
use api\components\Security;

class AssessmentFeeController extends ActiveController {

    public function behaviors() {
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

    public function actionGetassesmentfeelist() {
        die('fff');
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $regpk = isset($request['regpk'])? $request['regpk'] : null;
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $decryptedId = Security::decrypt($regpk);
        
        
       
        return $batches;

    }


}