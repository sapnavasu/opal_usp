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
use yii\web\Response;
use api\modules\mst\models\IncorpMasterQuery;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\IncorpMaster;
use api\modules\mst\models\Country;
use \common\models\MemcompgendtlsTbl;


class IncorpController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\IncorpMaster';

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


        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        
     
        $query = IncorpMaster::find();
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
                    if(is_numeric($val)){
                        $query->andFilterWhere(['=',Common::getTableWithPrefix($key, true), $val]);
                    }else{
                        $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                    }
                }
            }
           
        }
        $query->select(['incorpstylemst_tbl.*','countrymst_tbl.CyM_CountryName_en']);
        $query->leftJoin('countrymst_tbl','incorpstylemst_tbl.ISM_CountryMst_Fk=countrymst_tbl.CountryMst_Pk');
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        
        $provider = new ActiveDataProvider([
            'query' =>$query,
            'pagination' => ['pageSize' =>$page]]);

        $data = $provider->getModels();
        foreach ($data as $key => $val){
            $data[$key]['mapped'] = MemcompgendtlsTbl::isIncorpStyleMapped($val['IncorpStyleMst_Pk']);
        }

        return [
            'items' => $data,
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){

        $incorp = IncorpMaster::find()->where([
            'IncorpStyleMst_Pk'    =>  $id
        ])->one();
        if($incorp){
            return $incorp;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    public function actionNewincorp(){
        $check_model = new IncorpMaster();
        $params=[];
        $result=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $inc_entity=$data['incorpmaster']['StyleEntity'];
        {
            $model = new IncorpMaster();
            $model->ISM_CountryMst_Fk=$data['incorpmaster']['CountryMst'];
            $model->ISM_IncorpStyleEntity=$data['incorpmaster']['StyleEntity'];
            $model->ISM_IncorpStyleBrief=$data['incorpmaster']['StyleBrief'];
            $model->ISM_Status=($data['incorpmaster']['Status'] ==true)?"A":"I";
        /* $status=($data['socialmediamaster']['socialmedia_status'] ==true)?1:0;
        $model->sm_status=$status; */
            if(IncorpMaster::isAlreadyAvailable('ISM_IncorpStyleEntity', $data['incorpmaster']['StyleEntity'])){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'Style Entity is already avaialble',
                    'flag' => 'M'
                );
            }else if(IncorpMaster::isAlreadyAvailable('ISM_IncorpStyleBrief', $data['incorpmaster']['StyleBrief'])){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'Style Brief is already avaialble',
                    'flag' => 'M'
                );
            }else if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'Incorp created successfully',
                    'returndata' => $model->IncorpStyleMst_Pk
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning','flag'=>'E',
                    'msg'=> $model->getErrors()

                );
            }
            return json_encode($result);
        }
    }
    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['incorpmaster'])
        {
            $model = IncorpMaster::find()->where([
                'IncorpStyleMst_Pk'    =>  $id
            ])->one();
            $model->ISM_CountryMst_Fk=$data['incorpmaster']['CountryMst'];
            $model->ISM_IncorpStyleEntity=$data['incorpmaster']['StyleEntity'];
            $model->ISM_IncorpStyleBrief=$data['incorpmaster']['StyleBrief'];
            $model->ISM_Status=($data['incorpmaster']['Status'] ==true)?"A":"I";
            $model->load($params, '');
            if(IncorpMaster::isAlreadyAvailable('ISM_IncorpStyleEntity', $data['incorpmaster']['StyleEntity'],$id)){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'Style Entity is already avaialble',
                    'flag' => 'M'
                );
            }else if(IncorpMaster::isAlreadyAvailable('ISM_IncorpStyleBrief', $data['incorpmaster']['StyleBrief'],$id)){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'msg'=>'Style Brief is already avaialble',
                    'flag' => 'M'
                );
            }else if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Incorp updated successfully',
                    'returndata' => $model->IncorpStyleMst_Pk);
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
            $model = IncorpMaster::find()->where([
                'IncorpStyleMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->ISM_Status=="A")?"I":"A";
            $model->ISM_Status=$status;
            if($status == 'I' && MemcompgendtlsTbl::isIncorpStyleMapped($data['updatestatus'])){
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'M',
                    'msg'=>'This incorporation style already mapped to a company');
            }else if ($model->save(false)) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Incorp updated successfully',
                    'returndata' => $model->IncorpStyleMst_Pk);
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
        
    public function actionDelete($id) {
        $model = IncorpMaster::find()->where([
            'IncorpStyleMst_Pk'    =>  $id
        ])->one();
        if(MemcompgendtlsTbl::isIncorpStyleMapped($id)){
            return array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'M',
                'msg'=>'This incorporation style already mapped to a company');
        }else if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
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
        $model = IncorpMaster::deleteAll(['IN','incorpstylemst_pk',$id]);
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


    public function actionIncorplist()
    {
        return new ActiveDataProvider([
            'query' => IncorpMaster::find()
                ->select(['IncorpStyleMst_Pk','ISM_IncorpStyleEntity'])
                ->active(),
            'sort'=> ['defaultOrder' => ['ISM_IncorpStyleEntity'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }


}