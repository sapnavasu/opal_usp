<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\TbsecmstTbl;
use yii\filters\auth\CompositeAuth;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TbsecmstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\TbsecmstTbl';

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
        $query = TbsecmstTbl::find();
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
                   $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
         $query->select([
            "tbsecmst_tbl.*",
             "countrymst_tbl.CyM_CountryName_en",
            "(select count(*) from tbsecmst_tbl) as overallcount"
        ]);
         $query->leftJoin('countrymst_tbl', 'countrymst_tbl.CountryMst_Pk = tbsecmst_tbl.TBSM_CountryMst_Fk');
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
        $nlcData = TbsecmstTbl::find()->where([
            'tbsecmst_tbl'    =>  $id
        ])->one();
        if($nlcData){
            return $nlcData;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewregister(){

        $model = new TbsecmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['postval'] as $key=>$value) {
            $params[$key]=$value;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Created successfully',
                'returndata' => $model->TBSecMst_Pk);
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
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['updateformfield'])
        {
            $model = TbsecmstTbl::find()->where([
                'TBSecMst_Pk'    =>  $id
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
                    'returndata' => $model->FamilyMst_Pk);
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
    public function actionDetaillist()
    {
       return new ActiveDataProvider([
        'query' => TbsecmstTbl::find()
            ->select(['TBSecMst_Pk','TBSM_SecDtls'])->asArray()
       ]);
    }
 
}


