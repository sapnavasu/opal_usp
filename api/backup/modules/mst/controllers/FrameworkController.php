<?php

namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use \api\modules\mst\models\GlobalportalmstTbl;
use \common\components\Security;

class FrameworkController extends MasterController
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
     *     path="/mst/framework/frameworklist",
     *     tags={"Framework Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of framework.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionFrameworklist(){
        $data = GlobalportalmstTbl::getFrameworkData($_REQUEST);
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'items' => !empty($data['data']) ? $data['data'] : [],
            'total_count' => ($data['totalcount'] > 0) ? $data['totalcount'] : 0,
            'limit' => $data['size'],
        ]);
    }


    /**
     * @SWG\Post(
     *     path="/mst/framework/saveframework",
     *     tags={"Framework Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to create a new framework.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="framework", type="object",
     *                  @SWG\Property(property="framework_pk", type="integer", example=""),
     *                  @SWG\Property(property="framework_name", type="string", example=""),
     *                  @SWG\Property(property="framework_countries", type="string", example=""),
     *                  @SWG\Property(property="framework_refno", type="string", example=""),
     *                  @SWG\Property(property="framework_status", type="string", example="")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveframework(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = $data['framework'];
        $savedPk = GlobalportalmstTbl::saveNewFramework($data);

        if($savedPk === 2){
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Ref No already exists',
                'returndata' => 0
            );
        }else if($savedPk === 3){
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Portal name already exists',
                'returndata' => 0
            );
        }else if($savedPk){
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=> ($data['framework_pk']) ? 'Updated Successfully' : 'Created Successfully',
                'returndata' => 1
            );
        }
        else{
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
                'returndata' => 0
            );
        }
        return $this->asJson($result);
    }

    /**
     * @SWG\Get(
     *     path="/mst/framework/deleteframework",
     *     tags={"Framework Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to delete a stakeholders access.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteframework() { 
        $id = Security::decrypt($_GET['id']);
        if(strpos($id,",")){
            $id = Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = Security::sanitizeInput($id,'number');
        }
        $model = GlobalportalmstTbl::deleteAll(['IN','globalportalmst_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Framework deleted successfully',
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
     *     path="/mst/framework/getframeworkbypk",
     *     tags={"Framework Master"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get a framework details by the primary key.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "query", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetframeworkbypk(){
        $pk = \common\components\Security::decrypt(\common\components\Security::sanitizeInput($_REQUEST['id'], "string_spl_char"));
        $frameworkdata = GlobalportalmstTbl::getframeworkbypk($pk);
        return $this->asJson($frameworkdata);
    }
    /**
     * @SWG\Get(
     *     path="/mst/framework/changestatus",
     *     tags={"Framework Master"},
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
        $statusChange = GlobalportalmstTbl::changeStatus($pk);
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