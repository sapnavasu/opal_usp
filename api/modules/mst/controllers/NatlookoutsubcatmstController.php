<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\NatlookoutsubcatmstTbl;
use yii\filters\auth\CompositeAuth;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class NatlookoutsubcatmstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\NatlookoutcatmstTbl';

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
        $query = NatlookoutsubcatmstTbl::find();
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
            "*",
            "if(NLKSCM_Status = 'A', 'primary','warn') as `color`",
            "(select count(*) from natlookoutsubcatmst_tbl) as overallcount"
        ]);
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
        $nlcData = NatlookoutsubcatmstTbl::find()->where([
            'NatLookOutSubCatMst_Pk'    =>  $id
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
            $model = NatlookoutsubcatmstTbl::find()->where([
                'NatLookOutSubCatMst_Pk'    =>  $id
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
            $model = NatlookoutsubcatmstTbl::find()->where([
                'NatLookOutSubCatMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->NLKSCM_Status=="A")?"I":"A";
            $model->NLKSCM_Status=$status;
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
        
    }
    
    public function actionNewnlscmcategory(){
        $model              =   new NatlookoutsubcatmstTbl();
        $inputContent       =   file_get_contents('php://input');
        $inputContentDecode =   json_decode($inputContent, true);
        foreach ($inputContentDecode['nlcm_category'] as $key=>$value) {
            if($key == "NLKSCM_Status")
            {
                $status=($inputContentDecode['nlcm_category']['NLKCM_Status'] ==true)?"A":"I";
                $params[$key]=$status;
            }
            else {
                $params[$key]=$value;
            }
        }
        $params['NLKSCM_CreatedOn'] = date("Y-m-d h:i:s");
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Sub Category created successfully',
                'returndata' => $model->NatLookOutCatMst_Pk);
        } else {
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');;
        }
        return json_encode($result);
    }
}

