<?php

namespace api\modules\cc\controllers;

use \api\modules\mst\controllers\MasterController;
use \api\modules\mst\models\CountryMaster;
use \common\components\Security;
use \common\components\CountryConfig;
use \common\models\CountrymetricsmstTbl;

/**
 * Default controller for the `cc` module
 */
class CountryconfigController extends MasterController
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
    
    /**
     * @SWG\Post(
     *     path="/cc/countryconfig/getcountrydtl",
     *     tags={"Country Level Configuration},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get information towards a country.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="countrypk", type="integer", example="")
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcountrydtl(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $countryPk = Security::decrypt($data['countrypk']);
        $isEdit = $data['isEdit'];
        $countrydtl = CountryConfig::getCountryDtl($countryPk, $isEdit);
        if(is_numeric($countrydtl) && $countrydtl == 2) {
            return $this->asJson([
                'msg' => 'Country Configuration already exists.',
                'status' => 0,
                'statusmsg' => 'warning',
            ]);
        }
        return ($countrydtl) ? $countrydtl : [];
    }
    
    public function actionGetcountrymetrics(){
        $countryPk = Security::decrypt($data['countrypk']);
        $countrydtl = CountrymetricsmstTbl::getCountryMetrics($_REQUEST);
        return ($countrydtl) ? $countrydtl : [];
    }
    
    
    public function actionSavecountrymetrics() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['countrymetrics'];
        $save = CountrymetricsmstTbl::saveCountryMetrics($data);
        \common\models\CountrywbdtlsTbl::saveAncillaryCurrency($save->cmm_countrymst_fk, $data);
        return $this->asJson([
            'msg' => ($save) ? 'Created successfully' : 'something went wrong',
            'status' => ($save) ? 1 : 0,
            'statusmsg' =>  ($save) ? 'success' : 'warning',
        ]);
    }
    
    public function actionAuthoritylist() {
        $authorityList = \common\models\SuppauthoritymstTbl::getAuthorityList();
        return ($authorityList) ? $authorityList : [];   
    }
    
    
    public function actionAddsuppauthority() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data =$data['supportingauthority'];
        $save = CountryConfig::saveSupportingAuthority($data);
        $msg['msg'] = ($save) ? 'success' : 'failure';
        $msg['status'] = ($save) ? 1 : 0;
        return $msg;
    }
    
    public function actionGetsuppauthoritylist() {
        $countrypk = $_REQUEST['countrypk'];
        $suppAuthorityList = \common\models\MemberregistrationmstTbl::getSupportingAuthorityList($countrypk);
        return ($suppAuthorityList) ? $suppAuthorityList : [];   
    }
    
    
    /**
     * @SWG\Get(
     *     path="/cc/countryconfig/deletecountrymetrics",
     *     tags={"Country Level Configuration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete a Country Metrics.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletecountrymetrics() { 
        $id = Security::decrypt($_GET['id']);
        if(strpos($id,",")){
            $id = Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = (array) Security::sanitizeInput($id,'number');
        }
        $model = CountrymetricsmstTbl::updateDeleteStatus($id);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Country Configuration deleted successfully',
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

    /**
     * @SWG\Get(
     *     path="/cc/countryconfig/changestatus",
     *     tags={"Country Level Configuration"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to change the status.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "query", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionChangestatus(){
        $pk = \common\components\Security::decrypt(\common\components\Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        $statusChange = CountrymetricsmstTbl::changeStatus($pk);
        if ($statusChange) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'status changed successfully',
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
