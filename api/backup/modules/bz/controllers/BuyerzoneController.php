<?php

namespace api\modules\bz\controllers;
use Yii;
use yii\web\Controller;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use api\modules\mst\models\SectormstTbl;
use api\modules\mst\models\SectormstTblQuery;
use api\modules\mst\models\MembercompanymstTblQuery;
use api\modules\inv\models\InvestortypeprefmstTblQuery;

/**
 * Default controller for the `inv` module
 */
class BuyerzoneController extends Controller
{
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
    /**
     * @SWG\Get(
     *     path="/inv/investorhub/index",
     *     tags={"Investor Hub"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of Investor Profile.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "onsortpk", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "mrm_invidentity", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sectorMst_Pk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "CountryMst_Pk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "MCM_CompanyName", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIndex()
    {
        return \common\models\MemberregistrationmstTbl::getBuyerzoneList($_REQUEST);
    }
   
    /**
     * @SWG\Get(
     *     path="/inv/investorhub/getcounterlist",
     *     tags={"Investor Hub"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Get Country List.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionBuyerzonelist() {
    
        return \common\models\MemberregistrationmstTbl::getBuyerzoneList($_REQUEST);
    }
    public function actionStakeholderstatus() {
        return MembercompanymstTblQuery::stakeholderstatus();
    }
    
   
    public function actionGetBuyerzone(){
        return \api\modules\lic\models\LicinvappliedTblQuery::projectlist();
    }
    public function actionLicencelist(){
        return \api\modules\lic\models\LicinvappliedTblQuery::licencelist1();
    }
    public function actionLilist(){
      $request_body = file_get_contents('php://input');
      $data =   json_decode($request_body, true);
        return \api\modules\lic\models\LicinvappliedTblQuery::lilist();
    }
    
    public function actionLicencelistcount(){
        return \api\modules\lic\models\LicinvappliedTblQuery::licencelistcount();
    }

    public function actionIndividualinfo(){
        return MembercompanymstTblQuery::addindividualinfo();
    }

    public function actionPreferencelist(){
        return InvestortypeprefmstTblQuery::preferencelist();
    }

}
