<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\OfferrulemstTbl;
use yii\filters\auth\CompositeAuth;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class OfferrulemstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\OfferrulemstTbl';

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
        $query = OfferrulemstTbl::find();
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
         $query->select([
            "offerrulemst_tbl.*",
            "OfferMst_Tbl.OM_OfferName",
            "(select count(*) from offerrulemst_tbl) as overallcount"
        ]);
         $query->leftJoin(['OfferMst_Tbl', 'OfferMst_Tbl.OfferRuleMst_Pk = offerrulemst_tbl.ORM_OfferMst_Fk']);
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
        $nlcData = OfferrulemstTbl::find()->where([
            'OfferRuleMst_Pk'    =>  $id
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
        if($data['nlcmaster'])
        {
            $model = OfferrulemstTbl::find()->where([
                'OfferRuleMst_Pk'    =>  $id
            ])->one();
            foreach ($data['nlcmaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['nlcmaster']['Status'] ==true)?"A":"I";
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
                    'msg'=>'Nlc updated successfully',
                    'returndata' => $model->FamilyMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }
        else if($data['updatestatus'])
        {
            $model = OfferrulemstTbl::find()->where([
                'OfferRuleMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->NLKCM_Status=="A")?"I":"A";
            $model->NLKCM_Status=$status;
            if ($model->save(false)) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Nlc status updated successfully',
                    'returndata' => $model->FamilyMst_Pk);
            } else {
                //print_r($model->getErrors());die;
                $result=array('status' => 422,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }
        return json_encode($result);
    }
    
    public function actionDelete()
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
    
    public function actionNewForm(){
        $model              =   new OfferrulemstTbl();
        $inputContent       =   file_get_contents('php://input');
        $inputContentDecode =   json_decode($inputContent, true);
        foreach ($inputContentDecode['nlcm_category'] as $key=>$value) {
            if($key == "NLKCM_Status")
            {
                $status=($inputContentDecode['nlcm_category']['NLKCM_Status'] ==true)?"A":"I";
                $params[$key]=$status;
            }
            else {
                $params[$key]=$value;
            }
        }
        //$params['OM_CreatedOn'] = date("Y-m-d h:i:s");
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Category created successfully',
                'returndata' => $model->OfferRuleMst_Pk);
        } else {
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');;
        }
        return json_encode($result);
    }

}

