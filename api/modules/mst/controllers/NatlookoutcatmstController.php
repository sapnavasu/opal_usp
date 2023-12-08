<?php
namespace api\modules\mst\controllers;
use app\filters\auth\HttpBearerAuth;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\NatlookoutcatmstTbl;
use yii\filters\auth\CompositeAuth;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class NatlookoutcatmstController extends MasterController
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
        $query = NatlookoutcatmstTbl::find();
        if($_REQUEST['type']=='filter')
        {

            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach($_REQUEST as $key =>$val)
            {

                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key,true), $val]);
                }
            }

            //echo "<pre>";print_r($query);die;
        }
        $query->select([
            "*",
            "if(NLKCM_Status = 'A', 'primary','warn') as `color`",
        ]);
        $query->asArray();
        $page=(isset($_REQUEST['size']))?$_REQUEST['size']:10;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $nlcData = NatlookoutcatmstTbl::find()->where([
            'NatLookOutCatMst_Pk'    =>  $id
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
            $model = NatlookoutcatmstTbl::find()->where([
                'NatLookOutCatMst_Pk'    =>  $id
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
            $model = NatlookoutcatmstTbl::find()->where([
                'NatLookOutCatMst_Pk'    =>  $data['updatestatus']
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

    public function actionNewnlcmcategory(){
        $model              =   new NatlookoutcatmstTbl();
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
        $params['NLKCM_CreatedOn'] = date("Y-m-d h:i:s");
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Category created successfully',
                'returndata' => $model->NatLookOutCatMst_Pk);
        } else {
            $result=array('status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong');;
        }
        return json_encode($result);
    }

    public function actionCategorylist(){
        return new ActiveDataProvider([
            'query' => NatlookoutcatmstTbl::find()
                ->select(['NatLookOutCatMst_Pk','NLKCM_Category'])->asArray()
        ]);
    }
}

