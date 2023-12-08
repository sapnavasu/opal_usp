<?php

namespace api\modules\int\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use \common\components\Security;
use \api\modules\webs\components\Webservice;
use Yii;

class CommonController extends IntegrationMasterController {
    public $modelClass = '\common\models\MemcompprofcertfdtlsTbl';

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

    /**
     * @SWG\Post(
     *     path="/webservice/common/index",
     *     tags={"Webservice"},
     *     produces={"application/json"},
     *     summary="Sample",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default=""
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="requistitionData", type="object",
     *                      @SWG\Property(property="data_pk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionIndex() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Webservice::SampleFuncation($formdata);
        return $data;
    }
}