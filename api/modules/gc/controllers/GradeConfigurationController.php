<?php

namespace api\modules\gc\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use DateTime;
use yii\db\ActiveRecord;
use app\models\OpalusermstTbl;
use Exception;
use app\models\GrademstTbl;
use app\models\GrademsthstyTbl;


class GradeConfigurationController extends MasterController
{

    public $modelClass = 'app\models\BatchmgmtdtlsTbl';

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

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }


    public function actionGetgrades()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $sort = isset($request['sort'])? $request['sort'] : null;
        $grades = GrademstTbl::getGrades($sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $grades ];
    }

    public function actionGetgrade($id)
    {
        $grades = GrademstTbl::getGrade($id);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $grades ];
    }

    public function actionEditgrade()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = GrademstTbl::editGrade($request);

        if ($data) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Grade Updated Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error editing course'
            ];
        }
    }

    public function actionGetgradeslog()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = $request['id'];
        $sort = isset($request['sort'])? $request['sort'] : null;
        $grades = GrademsthstyTbl::getGradelog($id, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $grades ];
    }

}
