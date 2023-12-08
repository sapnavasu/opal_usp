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

use api\modules\mst\models\LanguagekeywordmstTbl;
use api\modules\mst\models\LanguagetranslateTbl;
use yii\web\Response;
class KeymstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\LanguagekeywordmstTbl';

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
    public function actionView($id){
        $module = LanguagekeywordmstTbl::find()->where([
            'LAK_id'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }
    public function actionIndex(){

        $query = LanguagekeywordmstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }

        }
        $query->select(["languagekeywordmst_tbl.*"]);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionNewkeyword(){

        $model = new LanguagekeywordmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['keywordmaster'] as $key=>$value) {

            $params['LAK_'.$key]=$value;

        }
        $params['LAK_Createdon']=date('Y-m-d H:i:s');
        $params['LAK_Updatedon']=date('Y-m-d H:i:s');
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'keyword created successfully',
                'returndata' => $model->LAK_id);
        } else {
            $result=array(
                'status' => 200,
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

        if($data['keywordmaster'])
        {
            $model = LanguagekeywordmstTbl::find()->where([
                'LAK_id'    =>  $id
            ])->one();
            foreach ($data['keywordmaster'] as $key=>$value) {
                $params['LAK_id'.$key.'']=$value;
            }
            $params['LAK_Updatedon']=date('Y-m-d H:i:s');
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'keyword updated successfully',
                'returndata' => $model->LAK_id);
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }

        return json_encode($result);
    }
    public function actionDelete($id) {
        $module = LanguagekeywordmstTbl::find()->where([
            'LAK_id'    =>  $id
        ])->one();

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }

    public function actionLogin(){
        $model = new LoginForm();

        $model->roles = [
            User::ROLE_ADMIN,
            User::ROLE_STAFF
        ];
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = $model->getUser();
            $user->generateAccessTokenAfterUpdatingClientInfo(true);

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            $id = implode(',', array_values($user->getPrimaryKey(true)));

            $responseData = [
                'id'    =>  $id,
                'access_token' => $user->access_token,
            ];

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
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
    public function actionKeywordlist()
    {
        $subQuery = LanguagetranslateTbl::find()->select('LAT_keyfk')->asArray()->where(['LAT_lanfk'=>$_GET['id']]);
//        echo
        return new ActiveDataProvider([
            'query' => LanguagekeywordmstTbl::find()
                ->select(['LAK_id','LAK_keyword'])
                ->where(['not in', 'LAK_id', $subQuery])
        ]);
    }
}

