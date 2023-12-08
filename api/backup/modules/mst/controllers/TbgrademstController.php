<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\TbgrademstTbl;
use yii\filters\auth\CompositeAuth;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\NotFoundHttpException;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TbgrademstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\TbgrademstTbl';

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
    
    public function actionIndex()
    {
        //$requestArray   =   array();
        $query = TbgrademstTbl::find();
        $requestArray   =   $_GET;
        if($requestArray['type']=='filter')
        {
            unset($requestArray['type']);
            unset($requestArray['sort']);
            unset($requestArray['order']);
            unset($requestArray['page']);
            unset($requestArray['size']);
            
            if($requestArray['TBGM_TBSecMst_Fk'])
            {
               $query->andFilterWhere(['LIKE','TBGM_TBSecMst_Fk', $requestArray['TBGM_TBSecMst_Fk']]);
            }
            if($requestArray['TBGM_GradeDtls'])
            { 
               $query->andFilterWhere(['LIKE','TBGM_GradeDtls',$requestArray['TBGM_GradeDtls']]);
            }
        }
         $query->select([
            "tbgrademst_tbl.*",
             "tbsecmst_tbl.TBSM_SecDtls",
            "(select count(*) from tbgrademst_tbl) as overallcount"
        ]);
         $query->leftJoin('tbsecmst_tbl', 'tbsecmst_tbl.TBSecMst_Pk = tbgrademst_tbl.TBGM_TBSecMst_Fk');
        $query->asArray();
        
        $page=(isset($requestArray['size']))?$requestArray['size']:10;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){
        $nlcData = TbgrademstTbl::find()->where([
            'TBGradeMst_Pk'    =>  $id
        ])->one();
        if($nlcData){
            return $nlcData;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewregister(){

        $model = new TbgrademstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['postval'] as $key=>$value) {
            $params[$key]=$value;
        }
        $model->load($params, '');
        $model->TBGM_CreatedBy=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Created successfully',
                'returndata' => $model->TBGradeMst_Pk);
        } else {
            $result=array('status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }
        return json_encode($result);
    }
    public function actionDelete(){
        $model = $this->actionView($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    }
    public function actionUpdate($id) {

        $params=[];
        $request_body	=  file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['updateformfield'])
        {
            $model = TbgrademstTbl::find()->where([
                'TBGradeMst_Pk'    =>  $id
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
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Updated successfully',
                    'returndata' => $model->TBGradeMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }
       /* else if($data['updatestatus'])
        {
            $model = FamilymstTbl::find()->where([
                'FamilyMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->FamM_Status=="A")?"I":"A";
            $model->FamM_Status=$status;
            if ($model->save(false)) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'family updated successfully',
                    'returndata' => $model->FamilyMst_Pk);
            } else {
                //print_r($model->getErrors());die;
                $result=array('status' => 422,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }*/
        return json_encode($result);
    }
    
 
}




