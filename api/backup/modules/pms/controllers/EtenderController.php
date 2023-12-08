<?php

namespace api\modules\pms\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use api\modules\pms\controllers\PmsMasterController;
use \api\modules\pms\components\etender;

class EtenderController extends PmsMasterController
{
    
    public $modelClass = '\common\models\UsermaphdrTbl';
    
    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
    }

    
    public function beforeAction($action) {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();

        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            
        }
    }
    
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
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest(){
        // echo '<pre>';print_r(\Yii::$app->params);exit;
        // echo \yii\db\ActiveRecord::getTokenData('reg_type', true); exit;
        // etender::insertCompanyInfoTo_eT_Intermediate(6);
        $etender = new etender();
        $etender->insertUserInfo(6,10,6,3);
        return 'karthick';
    }


    public function actionGetlink() {
        $etender = new etender();
        echo '<pre>';print_r($etender->createUrl());exit;
    }

    public function actionUserAuth() {
        $etender = new etender();
        $etender->userAuth();
    }
    
     
}
