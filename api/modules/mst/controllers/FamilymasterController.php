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

use api\modules\mst\models\FamilymstTbl;
use yii\web\Response;

class FamilymasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\FamilymstTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }
    /* public function behaviors()
     {
         $behaviors = parent::behaviors();
         $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_HTML;
         return $behaviors;
     }*/
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

    /**
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $code       =   $_REQUEST['code'];
        $name       =   $_REQUEST['name'];
        $segname    =   $_REQUEST['segname'];
        $requestdata = $_REQUEST;

        $query = FamilymstTbl::find();
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
        $query->select([
                "familymst_tbl.*",
                "segmentmst_tbl.SegM_SegName","segmentmst_tbl.SegM_SegCategory",
                "if(familymst_tbl.FamM_Status = 'A', 'primary','warn') as `color`",
                "(select count(*) from familymst_tbl) as overallcount"
        ]);
        $query->leftJoin('segmentmst_tbl', 'segmentmst_tbl.SegmentMst_Pk = familymst_tbl.FamM_SegmentMst_Fk');
        $sort_column = (strpos($_REQUEST['sort'],"-") !== false) ? explode("-",$_REQUEST['sort'])[1] : $_REQUEST['sort'];
        $query->orderBy("$sort_column {$_REQUEST['order']}");
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider =   new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        $data = $provider->getModels();
        foreach($data as $key => $val){
            $data[$key]['mapped'] = FamilymstTbl::isFamilyMapped($val['FamilyMst_Pk']);
        }
        return [
            'items' => $data,
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id,$returnArray=NULL){
        if($returnArray == NULL){
        $family = FamilymstTbl::find()
            ->select(['familymst_tbl.*','segmentmst_tbl.SegmentMst_Pk','segmentmst_tbl.SegM_SegName','segmentmst_tbl.SegM_SegCategory'])
            ->innerJoin('segmentmst_tbl', '`familymst_tbl`.`FamM_SegmentMst_Fk`=`segmentmst_tbl`.`SegmentMst_Pk`')
            ->where(['FamilyMst_Pk'    =>  $id])
            ->asArray()
            ->all();
        }  elseif($returnArray == 'Yes') {
            $family = FamilymstTbl::find()
            ->select(['familymst_tbl.*','segmentmst_tbl.SegmentMst_Pk','segmentmst_tbl.SegM_SegName','segmentmst_tbl.SegM_SegCategory'])
            ->innerJoin('segmentmst_tbl', '`familymst_tbl`.`FamM_SegmentMst_Fk`=`segmentmst_tbl`.`SegmentMst_Pk`')
            ->where(['FamilyMst_Pk'    =>  $id])
            ->all();
        }
        /*foreach($customers as $val)
        {
            print_r($val);
        }
        die;*/
        if($family){
            return $family;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }

    }
    /**
     * Create new staff member from backend dashboar
     */
    public function actionNewfamily(){

        $model = new FamilymstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['familymaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['familymaster']['Status'] ==true)?"A":"I";
                $params['FamM_'.$key.'']=$status;
            }
            else {
                $params['FamM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if(FamilymstTbl::isFamilyNameAlreadyAvailable($params['FamM_FamilyName'])){
            $result=array('status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'M',
                'msg'=>'Family name is already available',
            );
        }elseif(FamilymstTbl::isFamilyCodeAlreadyAvailable($params['FamM_FamilyCode'])){
            $result=array('status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'M',
                'msg'=>'Family code is already available',
            );
        }elseif ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Family created successfully',
                'returndata' => $model->FamilyMst_Pk);
        } else {
            $result=array('status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }
        return json_encode($result);
    }
    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['familymaster'])
        {
            $model = FamilymstTbl::find()->where([
                'FamilyMst_Pk'    =>  $id
            ])->one();
            foreach ($data['familymaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['familymaster']['Status'] ==true)?"A":"I";
                    $params['FamM_'.$key.'']=$status;
                }
                else {
                    $params['FamM_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if(FamilymstTbl::isFamilyNameAlreadyAvailable($params['FamM_FamilyName'],$data['familymaster']['familyid'])){
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'M',
                    'msg'=>'Family name is already available',
                );
            }elseif(FamilymstTbl::isFamilyCodeAlreadyAvailable($params['FamM_FamilyCode'],$data['familymaster']['familyid'])){
                $result=array('status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'M',
                    'msg'=>'Family code is already available',
                );
            }elseif ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'family updated successfully',
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
            $model = FamilymstTbl::find()->where([
                'FamilyMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->FamM_Status=="A")?"I":"A";
            if ($status == 'I' && FamilymstTbl::isFamilyMapped($id)) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
                return $this->asJson([
                    'status' =>  200,
                    'flag' => 'M',
                    'msg' => 'This family is already mapped to a class / product / service',
                    'statusmsg' => 'warning'
                ]);
            }
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
        }
        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->FamM_Status=="A")?"I":"A";
        $model->FamM_Status=$status;
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
        $model = $this->actionView($id,'Yes');

        if (FamilymstTbl::isFamilyMapped($id)) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return $this->asJson([
                'status' => 200,
                'flag' => 'M',
                'msg' => 'This family is already mapped to a class / product / service',
                'statusmsg' => 'warning'
            ]);
        } elseif ($model[0]->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        } else {
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
        $model = FamilymstTbl::deleteAll(['IN','familymst_pk',$id]);
        if ($model) {
            $result = [
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Family deleted successfully',
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

    public function actionFamilylist()
    {
        $segmentid = $_GET['segment'];
        return new ActiveDataProvider([
            'query' =>FamilymstTbl::find()
                ->select(['FamilyMst_Pk','FamM_FamilyName'])
                ->where(['FamM_SegmentMst_Fk' =>$segmentid])
                ->active(),
            'sort'=> ['defaultOrder' => ['FamM_FamilyName'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }

}
