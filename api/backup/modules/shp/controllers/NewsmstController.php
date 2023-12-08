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
use common\models\NewsdtlTbl;
use app\modules\nbf\components\Profile;

/**
 * News Master controller for the `Module` module
 */
class NewsmstController extends MasterController
{
    public $modelClass = 'common/models/ProjnewsmstTbl';
    
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
        $query = NewsdtlTbl::find();
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
        $query->andWhere(['ndt_isdeleted'=>0]);
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
    
    public function actionDeletenews() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $newsPk = $data['newsid'];
        $model = NewsdtlTbl::find()->where([
            'newsdtl_pk'    =>  $newsPk
        ])->one();
        $model->ndt_isdeleted=1;
        $model->ndt_deletedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);            
        $model->ndt_deletedon=date('Y-m-d H:i:s');            
        $model->ndt_deletedbyipaddr='192.168.1.52';
        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }
    public function actionUpdatenews() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $newsPk = $data['newsid'];
        $model = NewsdtlTbl::find()->where([
            'newsdtl_pk'    =>  $newsPk
        ])->one();
        if($model->ndt_status == 3){            
            $model->ndt_status=2;
        }elseif ($model->ndt_status == 2) {
            $model->ndt_status=3;            
        }
            $model->ndt_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);            
            $model->ndt_updatedon=date('Y-m-d H:i:s');            
            $model->ndt_updatedbyipaddr='192.168.1.52';            
        if ($model->save() === false) {
            throw new ServerErrorHttpException('Failed to Update object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }
    public function actionAddnews() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $newsHighlight = '';
        if(!empty($data['newsForm']['newsHighlight'])){
            foreach ($data['newsForm']['newsHighlight'] as $key =>$newsH ){
                if($key != 0){
                    $newsHighlight .='***'.$newsH['newsH'];
                }else {
                    $newsHighlight .=$newsH['newsH'];
                }
            }
        }
        $formArray = $data['newsForm'];
        if(empty($formArray['newsdtl_pk'])){
            $model = new NewsdtlTbl();
            $model->ndt_newstitle = $formArray['ndt_newstitle'];
            $model->ndt_newsdesc = $formArray['ndt_newsdesc'];
            $model->ndt_newstype  = $formArray['ndt_newstype'];
            $model->ndt_bannerpath  = 'noimage.png';
            $model->ndt_newsexpirydate = date('Y-m-d',  strtotime($formArray['ndt_newsexpirydate']));
            $model->ndt_newsdate = date('Y-m-d',  strtotime($formArray['ndt_newsdate']));
            $model->ndt_newsextlink = $formArray['ndt_newsextlink'];
            $model->ndt_keyhighlights = $newsHighlight;
            $model->ndt_status = 1;
            $model->ndt_isdeleted = 0;
            $model->ndt_createdon = date('Y-m-d H:i:s');
            $model->ndt_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ndt_createdbyipaddr = '192.168.1.52';
        }  else {
            $model = NewsdtlTbl::find()->where([
            'newsdtl_pk'    =>  $formArray['newsdtl_pk']
            ])->one();
            $model->ndt_newstitle = $formArray['ndt_newstitle'];
            $model->ndt_newsdesc = $formArray['ndt_newsdesc'];
            $model->ndt_newstype  = $formArray['ndt_newstype'];
            $model->ndt_newsexpirydate = date('Y-m-d',  strtotime($formArray['ndt_newsexpirydate']));
            $model->ndt_newsdate = date('Y-m-d',  strtotime($formArray['ndt_newsdate']));
            $model->ndt_newsextlink = $formArray['ndt_newsextlink'];
            $model->ndt_keyhighlights = $newsHighlight;
            $model->ndt_updatedon = date('Y-m-d H:i:s');
            $model->ndt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ndt_updatedbyipaddr = '192.168.1.52';
        }
        if ($model->save() === false) {
             echo "<pre>";print_r($model->getErrors());die;
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }
    public function actionEditnews() { 
        $newsPk = $_REQUEST['newsid'];
        $model = NewsdtlTbl::find()->where([
            'newsdtl_pk'    =>  $newsPk
        ])->one();
        if (empty($model)) {
            throw new ServerErrorHttpException('Failed to Edit the object for unknown reason.');
        }else{
            $newsHFull=explode('***', $model->ndt_keyhighlights);
            $model->ndt_keyhighlights = $newsHFull;
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }

    }
}
