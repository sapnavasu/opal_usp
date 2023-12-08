<?php
namespace api\modules\shp\controllers;

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

use common\models\WebinardtlsTbl;
use app\modules\nbf\components\Profile;

class WebinarmstController extends MasterController
{
    public $modelClass = 'common\models\WebinardtlsTbl';
    
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

        $query = WebinardtlsTbl::find();
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
        
        $query->andWhere(['wd_isdeleted'=>0]);
        $query->select(['*']);
        $query->asArray();
        
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        
    }
    
    public function actionDeletewebinar() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $webinarPk = $data['webinarid'];
        $model = WebinardtlsTbl::find()->where([
            'webinardtls_pk'    =>  $webinarPk
        ])->one();
        $model->wd_isdeleted=1;
        $model->wd_deletedon=date('Y-m-d H:i:s');
        $model->wd_deletedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wd_deletedbyipaddr='192.168.1.52';
        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    
    }
    public function actionUpdatewebinar() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $webinarPk = $data['webinarid'];
        $model = WebinardtlsTbl::find()->where([
            'webinardtls_pk'    =>  $webinarPk
        ])->one();
        if($model->wd_status == 3){            
            $model->wd_status=2;
        }elseif ($model->wd_status == 2) {
            $model->wd_status=3;            
        }
        $model->wd_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wd_updatedon=date('Y-m-d H:i:s');
        $model->wd_updatedbyipaddr='192.168.1.52';
        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
}

        public function actionTimezonelist()
            {
                return new ActiveDataProvider([
                    'query' => \api\modules\mst\models\TimezoneTbl::find()
                        ->select(['timezone_pk','tz_countryname'])
                        ->where(['=','tz_status','1'])
                ]);
            }

    public function actionAddwebinar() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $formArray = $data['webinarForm'];
        if(empty($formArray['projwebinar_pk'])){
        $model = new WebinardtlsTbl();
        $model->wd_title = $formArray['pw_topic'];
        $model->wd_description = $formArray['pw_description'];
        $model->wd_webinardate = date('Y-m-d',  strtotime($formArray['pw_webinardate']));
        $model->wd_webinartime = date('H:i:s',  strtotime($formArray['pw_webinartime']));
        $model->wd_webinarurl= $formArray['pw_webinarurl'];
        $model->wd_webinarduration= $formArray['pw_webinarduration'];
        $model->wd_webinarbanner= 'noimage.png';
        $model->wd_timezone= $formArray['pw_timezone'];
        $model->wd_status = 1;
        $model->wd_isdeleted = 0;
        $model->wd_createdon = date('Y-m-d H:i:s');
        $model->wd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wd_createdbyipaddr = '192.168.1.37';
        }else{
        $model = WebinardtlsTbl::find()->where(['webinardtls_pk'=> $formArray['projwebinar_pk']])->one();
        $model->wd_title = $formArray['pw_topic'];
        $model->wd_description = $formArray['pw_description'];
        $model->wd_webinardate = date('Y-m-d',  strtotime($formArray['pw_webinardate']));
        $model->wd_webinartime = date('H:i:s',  strtotime($formArray['pw_webinartime']));
        $model->wd_webinarurl= $formArray['pw_webinarurl'];
        $model->wd_timezone= $formArray['pw_timezone'];
        $model->wd_webinarbanner= 'noimage.png';
        $model->wd_webinarduration= $formArray['pw_webinarduration'];
        $model->wd_updatedby= \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wd_updatedon=date('Y-m-d H:i:s');
        $model->wd_updatedbyipaddr='192.168.1.52';
        }
        if ($model->save() === false) {
            $model->getErrors();
        }else{                                                                       
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }
    
        public function actionEditwebinar() { 
        $webinarPk = $_REQUEST['webinarid'];
        $model = WebinardtlsTbl::find()->where([
            'webinardtls_pk'    =>  $webinarPk
        ])->one();
        if (empty($model)) {
            $model->getErrors();
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }

    }
    
}