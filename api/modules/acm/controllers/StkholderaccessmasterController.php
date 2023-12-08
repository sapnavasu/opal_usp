<?php

namespace api\modules\acm\controllers;

use common\models\BasemodulemstTbl;
use common\models\StkholdertypmstTbl;
use Yii;
use api\modules\mst\controllers\MasterController;
use common\models\StkholderaccessmstTbl;


class StkholderaccessmasterController extends MasterController
{
    public $modelClass = 'common\models\StkholderaccessmstTbl';

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
     *     path="/acm/stkholderaccessmaster/getstkholderaccessdata",
     *     tags={"Stakholder Access Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of stakeholders access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetstkholderaccessdata(){
        $data =  StkholderaccessmstTbl::getStkholderAccessData($_REQUEST);
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => !empty($data['data']) ? $data['data'] : [],
            'total_count' => ($data['totalcount'] > 0) ? $data['totalcount'] : 0,
            'limit' => $data['size'],
        ];
    }


    /**
     * @SWG\Post(
     *     path="/acm/stkholderaccessmaster/createstkholderaccess",
     *     tags={"Stakholder Access Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new stakeholders access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="stkholderaccess", type="object",
     *                  @SWG\Property(property="stkholderaccessid", type="integer", example=""),
     *                  @SWG\Property(property="basemoduleid", type="integer", example=2),
     *                  @SWG\Property(property="stkholdertypeid", type="integer", example=3),
     *                  @SWG\Property(property="order", type="integer", example=3)
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCreatestkholderaccess(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['stkholderaccess'];
        $savedPk = StkholderaccessmstTbl::saveNewStkholderAccess($data);

        if($savedPk['flag'] == "MAA"){
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Module has already been assigned to another Stakeholder',
                'returndata' => 0
            );
        }
        else if($savedPk['flag'] == "OAT"){
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Order has already been taken by this Stakeholder',
                'returndata' => 0
            );
        }
        else if ($savedPk['flag'] == "S") {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>"Stakeholder Access {$savedPk['type']} Successfully",
                'returndata' => $savedPk['stkholdaccesspk']
            );
        } else {
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something Went Wrong',
                'returndata' => []
            );
        }
        return json_encode($result);
    }

    /**
     * @SWG\Get(
     *     path="/acm/stkholderaccessmaster/deletestkholderaccess",
     *     tags={"Stakholder Access Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete a stakeholders access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletestkholderaccess() { 
        if(strpos($_GET['id'],",")){
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
            $id = explode(",",$id);
        }else{
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        }
        $model = StkholderaccessmstTbl::deleteAll(['IN','stkholderaccessmst_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Stakeholder access deleted successfully',
            ];
        }else{
            $result = [
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            ];
        }
        return $result;
    }

    /**
 * @SWG\Get(
 *     path="/acm/stkholderaccessmaster/getstkholdertypes",
 *     tags={"Stakholder Access Master"},
 *     consumes={"application/json"},
 *     produces={"application/json"},
 *     summary="It is used to get a list of stakeholder types.",
 *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
 *     @SWG\Response(response = 200, description = "Response"),
 * )
 */
    public function actionGetstkholdertypes(){
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'stkholdertype';
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \app\models\OpalstkholdertypmstTbl::getStkholderCacheQuery();
                $stkholdtype = \app\models\OpalstkholdertypmstTbl::getStkholderTypes();
                $cache->store($cacheKey, $stkholdtype, $duration = 0 , $cacheQuery);
            } else {
                $stkholdtype = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $stkholdtype = \app\models\OpalstkholdertypmstTbl::getStkholderTypes();
        }

        return !empty($stkholdtype) ? $stkholdtype : [];
    }

    /**
     * @SWG\Get(
     *     path="/acm/stkholderaccessmaster/getstkholderaccessbypk",
     *     tags={"Stakholder Access Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get a stakeholders access by the primary key.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "query", name = "id", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetstkholderaccessbypk(){
        $pk = \common\components\Security::sanitizeInput($_REQUEST['id'], "number");
        $stkholderdata =  StkholderaccessmstTbl::getstkholderaccessbypk($pk);
        return !empty($stkholderdata) ? $stkholderdata : [];
    }

    /**
     * @SWG\Get(
     *     path="/acm/stkholderaccessmaster/getbasemodules",
     *     tags={"Stakholder Access Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get a stakeholders access by the primary key.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetbasemodules(){
        return BasemodulemstTbl::getBaseModules();
    }
}