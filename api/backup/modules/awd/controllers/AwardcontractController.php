<?php

namespace api\modules\awd\controllers;

use Yii;
use yii\web\Controller;
use common\components\Common;
use yii\data\ActiveDataProvider;
//use yii\rbac\Permission;
//use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
//use api\modules\mst\models\SectormstTbl;
//use api\modules\mst\models\SectormstTblQuery;
//use api\modules\mst\models\MembercompanymstTblQuery;
//use api\modules\inv\models\InvestortypeprefmstTblQuery;
use \app\models\CmstenderpsmapTbl;

/**
 * Default controller for the `inv` module
 */
class AwardcontractController extends Controller {

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
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

    public function actionIndex() {
        return \api\modules\pms\models\CmscontracthdrTbl::getAwardcontractList($_REQUEST);
    }

    public function actionAwardcontractlist() {
        $formdata = $_REQUEST;
        $data = \api\modules\pms\models\CmscontracthdrTblQuery::getAwardedcontractList($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getawardedbycomparray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetawardedbycomparray() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getAwardedbyCompArray();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getcurrencyaward",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcurrencyaward() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getCurrencyAward();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getawardsreceived",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetawardsreceived() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getAwardsReceived();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getissuedrfx",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetissuedrfx() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getIssuedRfx();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getopportunitiessummary",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetopportunitiessummary() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getOpportunitiesSummary();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getcmsengagements",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcmsengagements() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getCmsEngagements();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getnews",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetnews() {
        $data = \common\models\NewsdtlTblQuery::getNews();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getopportunitiesenquiries",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetopportunitiesenquiries() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getOpportunitiesEnquiries();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getengagementenquiries",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetengagementenquiries() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getEngagementEnquiries();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getcontractstatus",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcontractstatus() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getContractStatus();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getgeneralopportunity",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetgeneralopportunity() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getGeneralOpportunity();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getengagedopportunity",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetengagedopportunity() {
        $data = \api\modules\pms\models\CmstenderhdrTblQuery::getEngagedOpportunity();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getissuedaward",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetissuedaward() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getIssuedAward();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getObligatedAwardsIssued",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetobligatedawardsissued() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getObligatedAwardsIssued();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getsupplychainlevel",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetsupplychainlevel() {
        $data = \api\modules\pms\models\CmscontracthdrTblQuery::getSupplyChainLevel();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getobligatedenquiriesissued",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetobligatedenquiriesissued() {
        $data = \api\modules\pms\models\CmsawarddtlsTblQuery::getObligatedEnquiriesIssued();
        return $data;
    }

}
