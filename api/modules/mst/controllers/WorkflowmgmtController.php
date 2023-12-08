<?php

namespace api\modules\mst\controllers;

use Yii;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use common\components\Security;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\WorkflowmgmtTbl;
use api\modules\mst\models\WorkflowmgmtTblQuery;
use api\modules\mst\models\MembercompanymstTblQuery;
use common\models\BasemodulemstTbl;
use common\models\StkholdertypmstTbl;


class WorkflowmgmtController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\WorkflowmgmtTbl';
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
     *     path="/mst/workflowmgmt/index",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get workflow list.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIndex(){
        $query = WorkflowmgmtTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {   
                if($val !=null && $key!="search")
                {
                    $query->andWhere([$key => $val]);
                    
                }
            }

        }
        $query->select(['workflowmgmt_pk','wfm_allocatedon','MCM_CompanyName','shm_stakeholdertype','super.basemodulemst_pk as superpk','super.bmm_name as supername','sub.basemodulemst_pk as subpk','sub.bmm_name as subname']);
        $query->leftJoin('basemodulemst_tbl super','super.basemodulemst_pk=wfm_basemoduleulemst_fk');
        $query->leftJoin('basemodulemst_tbl sub','sub.basemodulemst_pk=wfm_basesubmodule');
        $query->leftJoin('stkholdertypmst_tbl','stkholdertypmst_pk=wfm_stkholdtype');
        $query->leftJoin('membercompanymst_tbl','MemberCompMst_Pk=wfm_memcompmst_fk');
        $query->leftJoin('usermst_tbl','UserMst_Pk=wfm_allocatedby');
        if($_GET['search']){
            $query->andFilterWhere(['or',
           ['like','shm_stakeholdertype',$_GET['search']],
           ['like','MCM_CompanyName',$_GET['search']],
           ['like','super.bmm_name',$_GET['search']],
           ['like','sub.bmm_name',$_GET['search']]]);
        }
        $query->asArray();
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 
            'query' => $query,
            'sort' => [
                'attributes'=>[
                    'supername'=>[
                        'asc'=>['super.bmm_name'=>SORT_ASC],
                        'desc'=>['super.bmm_name'=>SORT_DESC],
//                        'default' => SORT_DE
                    ],
                    'subname'=>[
                        'asc'=>['sub.bmm_name'=>SORT_ASC],
                        'desc'=>['sub.bmm_name'=>SORT_DESC],
//                        'default' => SORT_DESC
                    ],
                    'shm_stakeholdertype'=>[
                        'asc'=>['shm_stakeholdertype'=>SORT_ASC],
                        'desc'=>['shm_stakeholdertype'=>SORT_DESC],
//                        'default' => SORT_DESC
                    ],
                    'MCM_CompanyName'=>[
                        'asc'=>['MCM_CompanyName'=>SORT_ASC],
                        'desc'=>['MCM_CompanyName'=>SORT_DESC],
//                        'default' => SORT_DESC
                    ],
                    'wfm_allocatedon'=>[
                        'asc'=>['wfm_allocatedon'=>SORT_ASC],
                        'desc'=>['wfm_allocatedon'=>SORT_DESC],
//                        'default' => SORT_DESC
                    ],
                    'UM_EmpName'=>[
                        'asc'=>['UM_EmpName'=>SORT_ASC],
                        'desc'=>['UM_EmpName'=>SORT_DESC],
//                        'default' => SORT_DESC
                    ],

                ]
            ],
            
            'pagination' => ['pageSize' =>$page]]);
        $model = WorkflowmgmtTbl::find()
        ->select(['workflowmgmt_pk'])
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => 10,
            'total_entry' => count($model)
        ];
    }
  /**
     * @SWG\Get(
     *     path="/mst/workflowmgmt/view",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to View workflow.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionView(){
        $id = Security::decrypt($_GET['id']);
       return WorkflowmgmtTblQuery::view($id);
    }
     /**
     * @SWG\Get(
     *     path="/mst/workflowmgmt/history",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to View workflow history.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "module", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "submodule", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGethistory(){
        $module = Security::decrypt($_GET['module']);
        $submodule = Security::decrypt($_GET['submodule']);
        return WorkflowmgmtTblQuery::history($module,$submodule);
        
    }
/**
      * @SWG\Post(
     *     path="/pd/workflowmgmt/addworkflow",
     *     tags={"Workflow"},
     *     produces={"application/json"},
     *     summary="Add Workflow",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="workflow", type="object",
     *                  @SWG\Property(property="wfm_basemoduleulemst_fk", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_basesubmodule", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_stkholdtype", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_memcompmst_fk", type="integer", example="sample")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddworkflow(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return WorkflowmgmtTblQuery::add($data);
    }
/**
      * @SWG\Post(
     *     path="/pd/workflowmgmt/updateworkflow",
     *     tags={"Workflow"},
     *     produces={"application/json"},
     *     summary="Update Workflow",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="workflow", type="object",
     *                  @SWG\Property(property="wfm_basemoduleulemst_fk", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_basesubmodule", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_stkholdtype", type="integer", example="sample"),
     *                  @SWG\Property(property="wfm_memcompmst_fk", type="integer", example="sample")
     *              ),
     *                 @SWG\Property(property="pk", type="object", type="string", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionUpdateworkflow() {
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::decrypt($data['pk']);
        return WorkflowmgmtTblQuery::update($data,$id);
    }
    /**
     * @SWG\Get(
     *     path="/pd/workflowmgmt/getbasemodule",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Workflow Get basemodule",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetbasemodule(){
        return BasemodulemstTbl::getBaseModulesList();
    }

    public function actionGetsubmodule(){
        return BasemodulemstTbl::getSubModulesList();
    }
 /**
     * @SWG\Get(
     *     path="/mst/workflowmgmt/getbasesubmodule",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get basesubmodule.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "id", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetbasesubmodule(){
        $fk = Security::decrypt($_GET['id']);
        return BasemodulemstTbl::getBaseSubModulesList($fk);
    }
/**
     * @SWG\Get(
     *     path="/pd/workflowmgmt/getcompany",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Workflow Get Company",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcompany(){
        $com = WorkflowmgmtTblQuery::companyarr();
        $fk = Security::decrypt($_GET['id']);
        $arr = MembercompanymstTblQuery::getcompany($fk);
        $comarr = array();
        if(sizeof($arr)==0){
            $result=array(
                'status' => 200,
                'statusmsg' => 'null',
                'flag'=>'NULL',
            );
        return json_encode($result);

        }
        foreach( $com as $index) {
            array_push($comarr,$index['wfm_memcompmst_fk']);
        }
        $a = sizeof($arr);
        for ($i=0; $i < sizeof($arr); $i++) { 
            if(in_array($arr[$i]['MemberCompMst_Pk'],$comarr)){
                array_splice($arr,$i,1);
                $i--;
            }
        }
        $b = sizeof($arr);
        if($a!=0 && $b==0){
            $result=array(
                'status' => 200,
                'statusmsg' => 'empty',
                'flag'=>'EMPTY',
            );
        return json_encode($result);
        }   
        if($arr[0]['MemberCompMst_Pk']==''){
            $result=array(
                'status' => 200,
                'statusmsg' => 'empty',
                'flag'=>'EMPTY',
            );
        return json_encode($result);
        }
        return($arr);
    }
/**
     * @SWG\Get(
     *     path="/pd/workflowmgmt/getstakeholder",
     *     tags={"Workflow"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Workflow Get Stakeholder",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetstakeholder(){
        return StkholdertypmstTbl::getStkholderTypes();
    }
}
