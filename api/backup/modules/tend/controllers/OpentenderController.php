<?php
namespace api\modules\tend\controllers;

use app\filters\auth\HttpBearerAuth;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\tend\models\OpentendersTbl;
use api\modules\tend\models\OpentendersaddrTbl;

class OpentenderController extends MasterController {
    public $modelClass = 'api\modules\tend\models\TenderstestTbl';
    public $default_table_row_size;
    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        $this->default_table_row_size = 10;

    }

    public function actions() {
        return [];
    }
	
    public function beforeAction($action) {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        //header("Access-Control-Allow-Headers: Content-Type");

        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
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


        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
     /**
     * @SWG\Post(
     *     path="/tend/bgiindopentender/index",
     *     tags={"Tender List & Filter"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to list the tenders.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="tenderdetails", type="object",
     *                  @SWG\Property(property="page", type="integer", example=1),
     *                  @SWG\Property(property="size", type="integer", example=10),
     *                  @SWG\Property(property="type", type="string", example="filter"),
     *                  @SWG\Property(property="FileName", type="string", example=""),
     *                  @SWG\Property(property="BidderName", type="string", example="Tendertest"),
     *                  @SWG\Property(property="TenderName", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionIndex(){
        $index = OpentendersTbl::listtenders();
        return  $index;
	}

	
	
    public function actionView($id) { 
        $view = OpentendersTbl::View($id);
        return  $view;
    }

}