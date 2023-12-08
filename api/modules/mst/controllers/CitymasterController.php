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

use api\modules\mst\models\CitymstTbl;
use app\models\OpalcitymstTbl;
use app\modules\nbf\components\Profile;

class CitymasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\CitymstTbl';

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

    /**
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){

        $query = CitymstTbl::find();
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
        $query->select(['citymst_tbl.*',
            'if(citymst_tbl.CM_Status = "A", "primary","warn") as `color`']);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){

        $city = CitymstTbl::find()
            ->select(['citymst_tbl.*'
                ,"countrymst_tbl.CyM_CountryName_en","countrymst_tbl.CountryMst_Pk",
                "if(citymst_tbl.CM_Status = 'A', 'primary','warn') as `color`"])
            ->leftJoin('statemst_tbl','citymst_tbl.CM_StateMst_FK=statemst_tbl.StateMst_Pk ')
            ->innerJoin('countrymst_tbl','statemst_tbl.SM_CountryMst_Fk=countrymst_tbl.CountryMst_Pk')
            ->where(['CityMst_Pk'=>$id])
            ->asArray()
            ->all();
        if($city){
            return $city;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function actionNewcity(){
        $model = new CitymstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['citymaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['citymaster']['Status'] ==true)?"A":"I";
                $params['CM_'.$key.'']=$status;
            }
            else {
                $params['CM_'.$key.'']=$value;
            }
        }
        $model->CM_CreatedOn=date('Y:m:d H:i:s');
        $model->CM_CreatedBy=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Created Successfully',
                'returndata' => $model->CityMst_Pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'something went wrong',

            );
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }


    public function actionUpdate($id) {
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = CitymstTbl::find()->where([
            'CityMst_Pk'    =>  $id
        ])->one();
        $params=[];
        if($data['citymaster'])
        {
            foreach ($data['citymaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['CitymstTbl']['Status'] ==true)?"A":"I";
                    $params['CM_'.$key.'']=$status;
                }
                else {
                    $params['CM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = CitymstTbl::find()->where([
                'CityMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->CM_Status=="A")?"I":"A";
            $params['CM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Updated successfully',
                'returndata' => $model->CityMst_Pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'something went wrong',

            );
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }


    public function actionDelete($id) {
        $model = CitymstTbl::find()->where([
            'CityMst_Pk'    =>  $id
        ])->one();
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }


    public function actionGetPermissions(){
        $authManager = Yii::$app->authManager;

        /** @var Permission[] $permissions */
        $permissions = $authManager->getPermissions();

        /** @var array $tmpPermissions to store list of available permissions */
        $tmpPermissions = [];

        /**
         * @var string $permissionKey
         * @var Permission $permission
         */
        foreach($permissions as $permissionKey => $permission) {
            $tmpPermissions[] = [
                'name'          =>  $permission->name,
                'description'   =>  $permission->description,
                'checked'       =>  false,
            ];
        }

        return $tmpPermissions;
    }

    public function actionOptions($id = null) {
        return "ok";
    }
    public function actionGetcitybystateid()
    {
        
        if(isset($_GET['stateid']))
        {
            
            if ($_GET['custom'] == 1) { 
                $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                return new ActiveDataProvider([
                    'query' => OpalcitymstTbl::find()
                    ->select(['opalcitymst_pk','ocim_cityname_en','ocim_cityname_ar'])
                    ->where(['=','ocim_opalstatemst_fk',$_GET['stateid']])
                    ->andWhere(['=','ocim_status',1])
//                    ->active()
                    ->andWhere('CM_CreatedBy=:CM_CreatedBy', [':CM_CreatedBy' => $userpk]),
                    'sort' => ['defaultOrder' => ['ocim_cityname_en' => SORT_ASC]],
                    'pagination' => false
                ]);
            }
                $cityDataByCountry = new ActiveDataProvider([
                    'query' => OpalcitymstTbl::find()
                        ->select(['opalcitymst_pk','ocim_cityname_en','ocim_cityname_ar'])
                        ->where(['ocim_opalstatemst_fk'=>$_GET['stateid']])
                        ->andWhere(['=','ocim_status',1]),
    //                    ->active(),
                    'pagination'=>false
                ]);
            return $cityDataByCountry;
        }
    }
    public function actionCitylist()
    {

        return new ActiveDataProvider([
            'query' => CitymstTbl::find()
                ->select(['CityMst_Pk','CM_CityName_en'])
                ->where(['=','CM_Status','A'])
        ]);

    }

    public function actionTest(){ 
        $profile = new Profile();
        $profile_data = $profile->homeprofile();
        echo json_encode($profile_data);
        exit;
    }

}