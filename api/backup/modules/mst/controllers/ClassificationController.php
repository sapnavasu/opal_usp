<?php

namespace api\modules\mst\controllers;

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

use api\modules\mst\models\ClassificationmstTbl;
use yii\web\Response;
class ClassificationController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\ClassificationmstTbl';

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
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        //header("Access-Control-Allow-Headers: Content-Type");

        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
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
    public function actionView($id){
        $module = ClassificationmstTbl::find()->where([
            'ClassificationMst_Pk'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }
    public function actionIndex(){

        $query = ClassificationmstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(["classificationmst_tbl.*",
            "if(classificationmst_tbl.ClM_Status = 'A', 'primary','warn') as `color`"]);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $data = $provider->getModels();
        foreach($data as $key => $val){
            $data[$key]['mapped'] = ClassificationmstTbl::isClassificationMapped($val['ClassificationMst_Pk']);
        }
        return [
            'items' => $data,
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionNewclassification(){

        $model = new ClassificationmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['classificationmaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['classificationmaster']['Status'] ==true)?"A":"I";
                $params['ClM_'.$key]=$status;
            }
            else {
                $params['ClM_'.$key]=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Classification created successfully',
                'returndata' => $model->ClassificationMst_Pk);
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }
        return json_encode($result);
    }

    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['classificationmaster'])
        {
            $model = ClassificationmstTbl::find()->where([
                'ClassificationMst_Pk'    =>  $id
            ])->one();
            foreach ($data['classificationmaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['classificationmaster']['Status'] ==true)?"A":"I";
                    $params['ClM_'.$key.'']=$status;
                }
                else {
                    $params['ClM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = ClassificationmstTbl::find()->where([
                'ClassificationMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->ClM_Status=="A")?"I":"A";
            if ($status == 'I' && ClassificationmstTbl::isClassificationMapped($id)) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
                return $this->asJson([
                    'status' =>  200,
                    'flag' => 'M',
                    'msg' => 'This classification is already mapped to a company',
                    'statusmsg' => 'warning'
                ]);
            }
            $params['ClM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Classification updated successfully',
                'returndata' => $model->ClassificationMst_Pk);
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->CIM_Status=="A")?"I":"A";
        $model->CIM_Status=$status;
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }

    public function actionDelete($id) {
        $model = ClassificationmstTbl::find()->where([
            'ClassificationMst_Pk'    =>  $id
        ])->one();

        if(ClassificationmstTbl::isClassificationMapped($id)){
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return $this->asJson([
                'flag' => 'M',
                'msg' => 'Classification is already mapped to a company',
                'icon' => 'warning'
            ]);
        }elseif ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return $this->asJson([
                'flag' => 'S',
                'msg' => 'Deleted Successfully',
                'icon' => 'success'
            ]);
        }

    }
    
    public function actionDeletemultiple() { 
        $id = $_GET['id'];
        if(strpos($id,",")){
            $id = \common\components\Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = \common\components\Security::sanitizeInput($id,'number');
        }
        $model = ClassificationmstTbl::deleteAll(['IN','classificationmst_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Classification deleted successfully',
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

    public function actionClassificationlist()
    {
        return new ActiveDataProvider([
            'query' => ClassificationmstTbl::find()->active()
        ]);

    }


}

