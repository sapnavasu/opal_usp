<?php
namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\WebiexhconfmstTbl;
use yii\web\Response;



class WebexhController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\WebiexhconfmstTbl';

    public function __construct($id, $module, $config = [])
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


        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actionWebexhlist()
    {
        $type = \common\components\Security::sanitizeInput($_REQUEST['type'], 'number');
        $data = WebiexhconfmstTbl::find()
                ->select(['webiexhconfmst_pk as pk','wec_sharedname as name', 'wec_sharedname'])
                ->where(['wec_type' => $type, 'wec_status' => 1])
                ->orderBy(['wec_sharedname' => SORT_ASC])
                ->asArray()->all();
        return $data ? $this->asJson($data) : [];
    }


}