<?php
namespace api\modules\mst\controllers;

use app\filters\auth\HttpBearerAuth;
use Yii;

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\AdminuserrolemstTbl;

class AdminuserroleController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\AdminuserrolemstTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }

    public function actionIndex(){

        $query = AdminuserrolemstTbl::find();
        $query->asArray();
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' => $page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        /*return new ActiveDataProvider([
             'query' => AdminuserrolemstTbl::find()->active()
         ]);*/
    }
    public function actionFetchalldata(){
        $model          =   new AdminuserrolemstTbl();
        $request_body   =   file_get_contents('php://input');
        $filterdata     =   json_decode($request_body, true);
        $filterdata = $_REQUEST;
        if(!empty($filterdata)){
            $sort_field         =   $filterdata['sort'];
            $sort_field_order   =   $filterdata['order'];
            $sort_page          =   $filterdata['page'];
            $command            =   (new \yii\db\Query())
                -> select([
                    "*",
                    "if(ms.aurm_status = 'A', 'primary','warn') as `color`",
                    "(select count(*) from ".$model->tableName().") as overallcount"
                ])
                -> from ($model->tableName().' as ms')
                //-> where (['aurm_status' => "A"])
                -> orderBy ([
                    'ms.'.$sort_field => ($sort_field_order == 'desc') ? SORT_DESC : SORT_ASC
                ])
                -> limit(10)
                -> offset($sort_page)
                -> CreateCommand();

            $rows = $command->queryAll();

            if(!empty($rows)){
                $data['items']          =   $rows;
                $data['total_count']    =   $rows[0]['overallcount'];
                $result['statuscode']   =   '200';
                $result['statusmsg']    =   "success";
                $result['msg']          =   "Success";
                $result['data']         =   $data;
            }
        }else{
            $response = \Yii::$app->getResponse();
            $result['status']=$response->setStatusCode(201);
            $result['statuscode'] = '201';
            $result['statusmsg']="failed";
            $result['msg']="Invalid Request";
        }
        echo json_encode($result);
        exit;
    }
    public function actionView($id){
        $adminuserrole = AdminuserrolemstTbl::find()->where([
            'adminuserrolemst_pk'    =>  $id
        ])->one();
        $command = (new \yii\db\Query())
            -> select(['*'])
            -> from ([AdminuserrolemstTbl::tableName()])
            -> where (['adminuserrolemst_pk' => $id])
            -> CreateCommand();
        $result = $command->queryOne();
        if(!empty($result)){
            $result['statuscode'] = '200';
            $result['statusmsg']="success";
            $result['msg']="Success";
            $result['data'] = $result;
            echo json_encode($result);
            exit;
        }
        if($adminuserrole){
            return $adminuserrole;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionUpdate(){
        $model          =   new AdminuserrolemstTbl();
        $tableprefix    =   $model->tablePrefix();
        $request_body   =   file_get_contents('php://input');
        $filterdata     =   json_decode($request_body, true);
        $tablecolumns  = $model->getTableSchema()->getColumnNames();
        if(!empty($filterdata)){
            if($filterdata['userrolemaster']['type'] == 'statuschange'){
                $statusupdate = AdminuserrolemstTbl::findOne($filterdata['userrolemaster']['status']);
                if($filterdata['userrolemaster']['currentstatus'] == 'I'){
                    $updatestatus = 'A';
                }else if($filterdata['userrolemaster']['currentstatus'] == 'A'){
                    $updatestatus = 'I';
                }
                $statusupdate->aurm_status = $updatestatus;
                $statusupdate->save();
                $result['statuscode'] = '200';
                $result['statusmsg']="success";
                $result['msg']="Successfully Update";
                echo json_encode($result);
                exit;
            }else{
                $update = AdminuserrolemstTbl::findOne($filterdata['userrolemaster']['roleid']);
                $tempdata = $filterdata['userrolemaster'];
                foreach($filterdata['userrolemaster'] as $key => $value){
                    if($key == 'status'){
                        $value = ($value == 1) ? 'A' : 'I';
                    }
                    if(in_array($tableprefix.$key, $tablecolumns)){
                        $update->aurm_userrole = $filterdata['userrolemaster']['userrole'];
                        $update->aurm_status = $value;
                    }
                }
                $update->save();
                $result['statuscode'] = '200';
                $result['statusmsg']="success";
                $result['msg']="Successfully Update";
                echo json_encode($result);
                exit;
            }
        }
    }
    public function actionCreate(){
        $model          =   new AdminuserrolemstTbl();
        $tableprefix    =   $model->tablePrefix();

        $params =   [];
        $result =   [];
        $request_body   =   file_get_contents('php://input');
        $data           =   json_decode($request_body, true);

        //$data           =   $_REQUEST;

        foreach ($data['userrolemaster'] as $key=>$value) {
            if($key=="status"){
                $status=($data['userrolemaster']['status'] == 1)?"A":"I";
                $params[$tableprefix.$key]=$status;
            } else {
                $params[$tableprefix.$key]=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {

            $response = \Yii::$app->getResponse();
            $result['status']=$response->setStatusCode(201);
            $result['statuscode'] = '200';
            $result['statusmsg']="success";
            $result['msg']="Successfully Created";
            $result['returndata']=$model->adminuserrolemst_pk;
            //$response->statusmsg("success");;
            //$response->msg("Country created successfully");
            $response->setStatusCode(201);
            //$id = implode(',', array_values($model->getPrimaryKey(true)));
            //$response->getHeaders()->set('Location', Url::toRoute([$id], true));
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
        echo json_encode($result);
        exit;
        return $result;
    }
    public function actionDelete($id){
        if($id != ''){
            $delete = AdminuserrolemstTbl::findOne($id);
            $delete->delete();
            $result['statuscode'] = '200';
            $result['statusmsg']="success";
            $result['msg']="Successfully Deleted";
            echo json_encode($result); exit;
        }
    }

}

