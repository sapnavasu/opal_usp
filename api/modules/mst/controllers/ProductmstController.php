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
use api\modules\mst\models\ProductmstTbl;

class ProductmstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\ProductmstTbl';

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

    public function actionIndex(){

        $query = ProductmstTbl::find();
        $requestdata = $_REQUEST;
        if($requestdata['type']=='filter')
        {
            unset($requestdata['type']);
            unset($requestdata['sort']);
            unset($requestdata['order']);
            unset($requestdata['page']);
            unset($requestdata['size']);
            foreach(array_filter($requestdata) as $key => $val)
            {
                if(!is_null($val))
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['productmst_tbl.*',
            'if(productmst_tbl.PrdM_Status = "A", "primary","warn") as `color`','classmst_tbl.ClsM_ClassName','segmentmst_tbl.SegM_SegName',
            'familymst_tbl.FamM_FamilyName']);
        $query->leftJoin('classmst_tbl','productmst_tbl.PrdM_ClassMst_Fk=classmst_tbl.ClassMst_Pk');
        $query->leftJoin('familymst_tbl','classmst_tbl.ClsM_FamilyMst_Fk=familymst_tbl.FamilyMst_Pk');
        $query->leftJoin('segmentmst_tbl','familymst_tbl.FamM_SegmentMst_Fk=segmentmst_tbl.SegmentMst_Pk');
        $sort_column = (strpos($_REQUEST['sort'],"-") !== false) ? explode("-",$_REQUEST['sort'])[1] : $_REQUEST['sort'];
        $query->orderBy("$sort_column {$_REQUEST['order']}");
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        $data = $provider->getModels();
        foreach($data as $key => $val){
            $data[$key]['mapped'] = \common\models\MemcompproddtlsTbl::isProdutMapped($val['ProductMst_Pk']);
        }
        return [
            'items' => $data,
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $product=ProductmstTbl::find()
            ->select(['productmst_tbl.*',
                'if(productmst_tbl.PrdM_Status = "A", "primary","warn") as `color`','ClsM_ClassName','segmentmst_tbl.SegM_SegName',
                'familymst_tbl.FamM_FamilyName'])
            ->leftJoin('classmst_tbl','productmst_tbl.PrdM_ClassMst_Fk=classmst_tbl.ClassMst_Pk')
            ->leftJoin('familymst_tbl','classmst_tbl.ClsM_FamilyMst_Fk=familymst_tbl.FamilyMst_Pk')
            ->leftJoin('segmentmst_tbl','familymst_tbl.FamM_SegmentMst_Fk=segmentmst_tbl.SegmentMst_Pk')
            ->where([
                'ProductMst_Pk'    =>  $id
            ])->one();
        if($product){
            return $product;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewproduct(){
        $model = new ProductmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model->PrdM_SegmentMst_Fk=$data['productmaster']['segmentid'];
        $model->PrdM_FamilyMst_Fk=$data['productmaster']['familyid'];
        $model->PrdM_ClassMst_Fk=$data['productmaster']['ClassMst_Fk'];
        $model->PrdM_ProductCode=$data['productmaster']['ProductCode'];
        $model->PrdM_ProductName=$data['productmaster']['ProductName'];
        $model->PrdM_Status=($data['productmaster']['Status']==true)?"A":"I";
        $model->PrdM_CreatedOn = date('Y-m-d H:i:s');
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->PrdM_CreatedBy = $userpk;
        $model->load($params, '');
        if(ProductmstTbl::isAlreadyAvailable('PrdM_ProductName', $model->PrdM_ProductName)){
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product name is already avaialble',
                'flag' => 'M'
            );
        }else if(ProductmstTbl::isAlreadyAvailable('PrdM_ProductCode', $model->PrdM_ProductCode)){
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product code is already avaialble',
                'flag' => 'M'
            );
        }else if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product created successfully',
                'returndata' => $model->ProductMst_Pk
            );
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->getErrors()));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = ProductmstTbl::find()->where([
            'ProductMst_Pk'    =>  $id
        ])->one();
        if($data['productmaster'])
        {
            foreach ($data['productmaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['productmaster']['Status'] ==true)?"A":"I";
                    $params['PrdM_'.$key.'']=$status;
                }
                else {
                    $params['PrdM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = ProductmstTbl::find()->where([
                'ProductMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->PrdM_Status=="A")?"I":"A";
            $params['PrdM_Status']=$status;
            if($status =='I' && \common\models\MemcompproddtlsTbl::isProdutMapped($id)){
            return [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'M',
                'msg'=>'This product is already mapped to a comapany\'s product.',
            ];
        }
        }
        $model->load($params, '');
        if(ProductmstTbl::isAlreadyAvailable('PrdM_ProductName', $params['PrdM_ProductName'],$data['productmaster']['update_productid'])){
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product name is already avaialble',
                'flag' => 'M'
            );
        }else if(ProductmstTbl::isAlreadyAvailable('PrdM_ProductCode', $params['PrdM_ProductCode'],$data['productmaster']['update_productid'])){
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product code is already avaialble',
                'flag' => 'M'
            );
        }else if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'msg'=>'Product updated successfully',
                'returndata' => $model->ProductMst_Pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'msg'=>'something went wrong',
                'returndata' => $model->ProductMst_Pk
            );
            throw new HttpException(422, json_encode($model->errors));
        }
        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->PrdM_status=="A")?"I":"A";
        $model->PrdM_status=$status;
        if ($model->save(false)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }
    /**
     * Delete requested staff member from backend dashboard
     *
     * Request: DELETE /v1/staff/1
     *
     * @param $id
     *
     * @return string
     * @throws ServerErrorHttpException
     */
    public function actionDelete($id) {
        $model = ProductmstTbl::find()->where([
            'ProductMst_Pk'    =>  $id
        ])->one();
        if(\common\models\MemcompproddtlsTbl::isProdutMapped($id)){
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'M',
                'msg'=>'This product is already mapped to a comapany\'s product.',
            ];
        }else if ($model->delete() === false) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Something went wrong',
            ];
        }else{
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Product deleted successfully',
            ];
        }
        return $result;
    }

    public function actionDeletemultiple() { 
        $id = $_GET['id'];
        if(strpos($id,",")){
            $id = \common\components\Security::sanitizeInput($id,'string_spl_char');
            $id = explode(",",$id);
        }else{
            $id = \common\components\Security::sanitizeInput($id,'number');
        }
        $model = ProductmstTbl::deleteAll(['IN','productmst_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Product deleted successfully',
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