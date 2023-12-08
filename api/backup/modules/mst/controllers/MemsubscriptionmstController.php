<?php

namespace api\modules\mst\controllers;

use app\filters\auth\HttpBearerAuth;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\MemsubscriptionmstTbl;
use yii\web\Response;

class MemsubscriptionmstController extends MasterController
{
     public $modelClass = 'api\modules\mst\models\MemsubscriptionmstTbl';

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
        /*
        $query = MemsubscriptionmstTbl::find();
        $query->select([
            "MemSubscriptionMst_Pk",
            "MSM_ModuleMst_Fk",
            "MSM_SubModuleMst_Fk"
        ]);
        $query->asArray();
        $provider =   new ActiveDataProvider(['query'=>$query]);
        $result = $provider->getModels();
        
        if(!empty($result)){
            $module_ids = array();
            foreach($result as $key => $value){
                $module = $value['MSM_ModuleMst_Fk'];
                $pk = $value['MemSubscriptionMst_Pk'];
                $module_val = explode(',',$module);
                
                $submodule = $value['MSM_SubModuleMst_Fk'];
                $submodule_1 = explode(',', $submodule);
                foreach($submodule_1 as $k => $v){
                  $submodule_2 = explode('~',$v);
                  if(in_array($submodule_2[0], $module_val)){
                      $module_ids[$pk][$submodule_2[0]] .= $submodule_2[1].',';
                  }
                }
            }
        }
        foreach($module_ids as $value ){
            foreach($value as $mid => $subid){
                
            }
        }
        //echo "<pre>"; print_r($module_ids); exit;
        //$requestArray   =   $_GET;
         * */
         
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
        //$query->select()
         $query->select([
            "memsubscriptionmst_tbl.*",
            "(select count(*) from memsubscriptionmst_tbl) as overallcount"
        ]);
         //$query->leftJoin('tbsecmst_tbl', 'tbsecmst_tbl.TBSecMst_Pk = tbgrademst_tbl.TBGM_TBSecMst_Fk');
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
        $nlcData = MemsubscriptionmstTbl::find()->where([
            'MemSubscriptionMst_Pk'    =>  $id
        ])->one();
        if($nlcData){
            return $nlcData;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewregister(){
        $model = new MemsubscriptionmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['postval'] as $key=>$value) {
            if($key == 'MSM_ModuleMst_Fk' || $key == 'MSM_SubModuleMst_Fk'){
                $valueWithComma = '';
                if(!empty($value)){
                   $valueWithComma = implode(',',$value);
                }
                $value = $valueWithComma;
            }
            $params[$key]=$value;
        }
        $model->load($params, '');
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
            $model = MemsubscriptionmstTbl::find()->where([
                'MemSubscriptionMst_Pk'    =>  $id
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
    
 
}
