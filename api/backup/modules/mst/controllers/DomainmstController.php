<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use Yii;


use yii\filters\AccessControl;

use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Response;

use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\DomainmstTbl;
use yii\filters\auth\CompositeAuth;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DomainmstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\DomainmstTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }
    // public function beforeAction($action)
    // {
    //     header("access-control-allow-origin: *");
    //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    //     header("Access-Control-Allow-Headers: Content-Type");

    //     if (!parent::beforeAction($action)) {
    //         return false;
    //     }
    //     return true;
    // }
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

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
       
    }

    public function actionIndex()
    {
        try {
            //$requestArray   =   array();
            $query = DomainmstTbl::find();
            //print_r(array_filter($_REQUEST));die;
            if($_REQUEST['type']=='filter')
            {
                unset($_REQUEST['type']);
                unset($_REQUEST['sort']);
                unset($_REQUEST['order']);
                unset($_REQUEST['page']);
                unset($_REQUEST['size']);
                foreach(array_filter($_REQUEST) as $key =>$val)
                {
                    if(!is_null($val))
                    {
                        $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                    }
                }
            }
            $query->asArray();
            $provider = new ActiveDataProvider(['query' => $query]);
            $page=(!empty($_GET['size']))?$_GET['size']:10;
            $provider->pagination->pageSize=$page;
            $res['items'] = $provider->getModels();
            $res['total_count'] = $provider->getTotalCount();
            $res['limit'] = 10;
            $res['stat'] = 100;
            $res['msg'] = 'Success';
        } catch (exception $e) {
            $res['msg'] = 'Something goes wrong, So please try again later.';
            $res['stat'] = 102;
        }
        return $res;
    }
    public function actionView($id){
        $viewdata = DomainmstTbl::find()->where([
            'DomainMst_Pk'    =>  $id
        ])->one();
        if($viewdata){
            return $viewdata;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewregister(){
        try {
            
            $params=[];
            $request_body   =   file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $updateid = '';
            foreach ($data['postval'] as $key=>$value) {
                if($key == 'DoM_Status'){
                    if($value){
                        $value = 'A';
                    }else{
                        $value = 'I';
                    }
                }
                if($key != 'updateid'){
                    $params[$key]=$value;
                }else{
                    $updateid = $value;
                }
            }
            if($updateid == ''){
                $params['DoM_CreatedOn'] = date('Y-m-d H:i:s');
                $params['DoM_CreatedBy'] = '2';
                $model = new DomainmstTbl();
            }else{
                $model = DomainmstTbl::find()->where(['DomainMst_Pk'=>$updateid])->one();
                $params['DoM_UpdatedOn'] = date('Y-m-d H:i:s');
                $params['DoM_UpdatedBy'] = '2';
            }
            
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Created successfully',
                    'returndata' => $model->DomainMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        } catch (exception $e) {
            $result['msg'] = 'Something goes wrong, So please try again later.';
            $result['status'] = 200;
        }
        return json_encode($result);
    }
    public function actionDelete($id){
        $model = DomainmstTbl::find()->where([
            'DomainMst_Pk'    =>  $id
        ])->one();
        
        
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    }
    public function actionUpdate($id='') {

        $params=[];
        $request_body   =  file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if($data['updateformfield'])
        {
            
            $model = DomainmstTbl::find()->where([
                'DomainMst_Pk'    =>  $id
            ])->one();
            foreach ($data['updateformfield'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['updateformfield']['Status'] ==true)?"A":"I";
                    $params[$key]=$status;
                }
                else {
                    $params[$key]=$value;
                }
            }
            $params['DoM_UpdatedOn'] = date('Y-m-d H:i:s');
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Updated successfully',
                    'returndata' => $model->FamilyMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }
        elseif ($data['Status']) {
            $id = \Yii::$app->request->getQueryParam('id');
            $model = DomainmstTbl::find()->where(['DomainMst_Pk'=>$id])->one();
            $params['DoM_Status'] = ($data['Status'] =='I')?"A":"I";
            $params['DoM_UpdatedOn'] = date('Y-m-d H:i:s');
            $model->load($params, '');

            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Updated successfully',
                    'returndata' => $model->DomainMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }
        return json_encode($result);
    }
    public function actionListdomain()
    {
        if(!empty($_GET))
        {
            $domainid=$_GET['domainid'];
            $viewdata = DomainmstTbl::find()->where([
                'DomainMst_Pk'    =>  $_GET['domainid']
            ])->one();
            if($viewdata){
                return $viewdata;
            } else {
                throw new NotFoundHttpException("Object not found: $domainid");
            }
        }
    }


}




