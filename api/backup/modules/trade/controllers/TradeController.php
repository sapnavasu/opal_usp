<?php

namespace api\modules\trade\controllers;
use \common\components\Security;
use \api\modules\trade\components\Trade;

/**
 * Default controller for the `trade` module
 */
class TradeController extends TradeMasterController
{
    public $modelClass = '\common\models\MemcompbussrcdtlsTbl';
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

    public function beforeAction($action)
    {
        header('Content-type: application/json; charset=utf-8');
        \common\components\Configsession::setConfigsession();
        \common\components\Sessionn::setSession();
        try {
            return parent::beforeAction($action);
        }
        catch (BadRequestHttpException $e){}
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

        $behaviors['contentNegotiator']['formats']['application/json'] = \yii\web\Response::FORMAT_JSON;
		
        return $behaviors;
    }
    
     /**
     * @SWG\Post(
     *     path="/trade/trade/save",
     *     tags={"Add Trade Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a trade details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *                  @SWG\Property(property="memcompmplocationdtls_fk", type="integer", example="1"),
        *                  @SWG\Property(property="mctd_accdeliveryitems", type="integer", example="1"),
        *                  @SWG\Property(property="mctd_accpymtcurrency", type="integer", example="1"),          
     *                     @SWG\Property(property="mctd_accpymttype", type="integer", example="1"),         
     *                     @SWG\Property(property="mctd_exportperc", type="integer", example="1"),         
     *                     @SWG\Property(property="mctd_expinityr", type="integer", example="1"),          
     *                     @SWG\Property(property="mctd_avgleadtime", type="integer", example="1"),          
     *                     @SWG\Property(property="mctd_annimpvalue", type="integer", example="1"),          
     *                     @SWG\Property(property="mctd_minstoragecap", type="string", example="test"),          
     *                     @SWG\Property(property="mctd_maxstoragecap", type="string", example="test"),          
     *     ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    
    public function actionSave() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
       // is time zone required?
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);
        
        $data['tInfo']['memcompmplocationdtls_fk'] = Security::sanitizeInput($data['last_added_mp_pk'],'number');
        //sanitize the input
        $tdata['mctd_memcompmplocationdtls_fk'] = Security::sanitizeInput($data['tInfo']['memcompmplocationdtls_fk'],'number')  ;    
        $tdata['mctd_accdeliveryitems'] = Security::sanitizeInput($data['tInfo']['ckterms'],'string')  ;    
        $tdata['mctd_accpymtcurrency'] = Security::sanitizeInput($data['tInfo']['currencytype'],'number')  ;    
        $tdata['mctd_accpymttype'] = Security::sanitizeInput(implode(",",$data['tInfo']['paymenttype']),'string_spl_char');    
        $tdata['mctd_exportperc'] = Security::sanitizeInput($data['tInfo']['exportpercent'],'number')  ;    
        $tdata['mctd_expinityr'] = Security::isDateValid($data['tInfo']['datepicker'],'Y');    
        $tdata['mctd_currencymst_fk'] = Security::sanitizeInput($data['tInfo']['exportcurrency'],'number');
        $tdata['mctd_annexpvalue'] = Security::sanitizeInput($data['tInfo']['exportvalue'],'number');
        $tdata['mctd_avgleadtime'] = Security::sanitizeInput($data['tInfo']['leadtime'],'number');
        $tdata['mctd_annimpvalue'] = Security::sanitizeInput($data['tInfo']['importvolume'],'number'); 
        $tdata['mctd_minstoragecap'] = Security::sanitizeInput($data['tInfo']['mincapacity'],'number');
        $tdata['mctd_maxstoragecap'] = Security::sanitizeInput($data['tInfo']['maxcapacity'],'number');
        $tdata['mctd_accotherpymt'] = $data['tInfo']['currency_other'];
        
        $tdata['memcomptradingdtls_pk'] = $data['tInfo']['memcomptradingdtls_pk'];
        
        if($tdata['mctd_accpymtcurrency'] == 0) {
            $tdata['mctd_accpymtcurrency'] = NULL;
        }
        
        if($tdata['mctd_currencymst_fk'] == 0) {
            $tdata['mctd_currencymst_fk'] = NULL;
        }
//        $tdata['measurement'] = $data['tInfo']['measurement'];
        
        $add_trade_details = Trade::save($tdata);     
        return $add_trade_details;
    }
    
    /**
     * @SWG\Post(
     *     path="/trade/trade/mapwithbs",
     *     tags={"Map business with trade"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To save selected business source with trade",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="tradePK", type="string", example="MQ==="),
     *                  @SWG\Property(property="bspks", type="string", example="1,2,3,4"),
     *            ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionMapwithbs()
    {
        $request_body = file_get_contents('php://input');
        $data_bs = json_decode($request_body, true);
        //$data['tradePK'] = Security::decrypt($_REQUEST['tradePK']);
        $data=[];
        $dec_trd=Security::decrypt($data_bs['mapwithbs']['tradePK']);
        //echo $dec_trd;die;
        $data['tradePK'] = Security::sanitizeInput($dec_trd,'number');
        $data['bspks'] = Security::sanitizeInput($data_bs['mapwithbs']['bspks'],'string_spl_char');
        $tradeObj =  new Trade();
        return $tradeObj->mapwithbs($data);
    }
    
    /**
     * @SWG\Get(
     *     path="/trade/trade/getmappedbs",
     *     tags={"get mapped business"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To get mapped business for given Trade",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "tradePK", type = "string", example="MQ==" ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetmappedbs()
    {
//        $request_body = file_get_contents('php://input');
//        $data = json_decode($request_body, true);
        $tradePK= Security::decrypt($_REQUEST['tradePK']);
        $tradePK = Security::sanitizeInput($tradePK ,'number');
        $tradeObj =  new Trade();
        return $tradeObj->getmappedbs($tradePK);
    }
        
    public function actionFinalsubmit() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $trade_pk = $data['trade_pk'];
        $final_create_trade = Trade::finalcreatetrade($trade_pk);
        return $final_create_trade;
    }
    public function actionFinalupdate() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $trade_pk = $data['trade_pk'];
        $final_create_trade = Trade::finalupdatetrade($trade_pk);
        return $final_create_trade;
    }

    public function actionGettradedetail() {
        $trade_pk = Security::decrypt($_REQUEST['tradeid']);
        $trade_pk = Security::sanitizeInput($trade_pk ,'number');
        $tradeObj =  new Trade();
        return $tradeObj->gettradedetail($trade_pk);
    }

    public function actionGetlocations() {
        // $loc_ids = Security::decrypt($_REQUEST['loc_ids']);
        $loc_ids = $_REQUEST['loc_ids'];
        $tradeObj =  new Trade();
        return $tradeObj->getlocationdetail($loc_ids);
    }

             /**
     * @SWG\Post(
     *     path="/trade/gettradelist",
     *     tags={"Trade listing"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Its used to get the list of service added by supplier",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "filterform", type = "object",default="1"),
    *      @SWG\Property(property="paymenttype", type="array", example=""),
    *      @SWG\Property(property="currencytype", type="array", example=""),
    *      @SWG\Property(property="businesssource", type="array", example=""),
    *      @SWG\Property(property="exportyear", type="string", example=""),
    *      @SWG\Property(property="size", type="integer", example=""),
    *      @SWG\Property(property="page", type="integer", example=""),
    *      @SWG\Property(property="search", type="string", example=""),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionGettradelist(){
        Security::sanitizeInput($_REQUEST['size'] ,'number');
        Security::sanitizeInput($_REQUEST['page'] ,'number');
        Security::sanitizeInput($_REQUEST['search'] ,'string');
        Security::sanitizeInput($_REQUEST['sort'] ,'string');
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Trade::gettradelist($data);
        return $data;
    }

             /**
     * @SWG\Get(
     *     path="/trade/deletetrade",
     *     tags={"Delete Trade"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete a trade",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", pk = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionDeletetrade() {
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = Trade::Deletetrade($pk);
        return $data; 
    }
}
