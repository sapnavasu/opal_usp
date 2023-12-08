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
use api\modules\mst\models\OffermstTbl;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class OffermstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\OffermstTbl';

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

    public function actionIndex()
    {
        $query = OffermstTbl::find();
        $requestArray   =   $_GET;
        if($requestArray['type']=='filter')
        {
            unset($requestArray['type']);
            unset($requestArray['sort']);
            unset($requestArray['order']);
            unset($requestArray['page']);
            unset($requestArray['size']);
            foreach($requestArray as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key), $val]);
                }
            }
        }
        $query->select(["offermst_tbl.*"]);
        $query->asArray();

        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $nlcData = OffermstTbl::find()->where([
            'OfferMst_Pk'    =>  $id
        ])->one();
        if($nlcData){
            return $nlcData;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function actionUpdate($id)
    {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        if($data['offermaster'])
        {
            $model = OffermstTbl::find()->where([
                'OfferMst_Pk'    =>  $id
            ])->one();
            foreach ($data['offermaster'] as $key=>$value) {
                $params['OM_'.$key]=$value;
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Offer updated successfully',
                    'returndata' => $model->OfferMst_Pk);
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

    public function actionDelete($id)
    {
        $model = $this->actionView($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    }

    public function actionNewoffer(){
        $model              =   new OffermstTbl();
        $inputContent       =   file_get_contents('php://input');
        $inputContentDecode =   json_decode($inputContent, true);
        foreach ($inputContentDecode['offermaster'] as $key=>$value) {
            foreach ($inputContentDecode['offermaster'] as $key=>$value) {

                $params['OM_'.$key]=$value;
            }
        }
        //$params['OM_CreatedOn'] = date("Y-m-d h:i:s");
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'offer created successfully',
                'returndata' => $model->OfferMst_Pk);
        } else {
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');;
        }
        return json_encode($result);
    }

    public function actionOfferlist(){
        return new ActiveDataProvider([
            'query' => OffermstTbl::find()
                ->select(['OfferMst_Pk','OM_OfferName'])
                ->active()
        ]);
    }
}

