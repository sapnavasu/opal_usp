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
use api\modules\mst\models\SocialmediaMasterQuery;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\SocialmediaMaster;


class SocialmediaController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\SocialmediaMaster';

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

        
        $query = SocialmediaMaster::find();
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
        $query->select(['socialmediamst_tbl.*',
            'if(socialmediamst_tbl.sm_status = 1, "primary","warn") as `color`']);

        $query->asArray();
        if(!isset($_REQUEST['order']))
        {
            $page=false;
        }
        else
        {
            $page=(isset($_GET['size']))?$_GET['size']:10;
        }
        $provider = new ActiveDataProvider([
            'query' =>$query,
            'pagination' => ['pageSize' =>$page]]);


        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){

        $socialmedia = SocialmediaMaster::find()->where([
            'socialmediamst_pk'    =>  $id
        ])->one();
        if($socialmedia){
            return $socialmedia;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    public function actionNewsocialmedia(){
        
        $check_model = new SocialmediaMaster();
        $params=[];
        $result=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $sm_name=$data['socialmediamaster']['SocialmediaName'];
        $check_model = SocialmediaMaster::find()->where(['like', 'sm_name', $sm_name])->one();
        if($check_model){
            /* echo "duplicate";exit; */
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Duplicate entry !',

            );
            return json_encode($result);
        }
        else{
            $model = new SocialmediaMaster();
            $status=($data['socialmediamaster']['Status'] ==true)?1:0;
            $model->sm_status=$status;
            $model->sm_order=$data['socialmediamaster']['SocialmediaOrder'];
            $model->sm_name=$data['socialmediamaster']['SocialmediaName'];
            $model->sm_icons=$data['socialmediamaster']['SocialmediaIcon'];
        /* $status=($data['socialmediamaster']['socialmedia_status'] ==true)?1:0;
        $model->sm_status=$status; */
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'created successfully',
                    'returndata' => $model->socialmediamst_pk
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning','flag'=>'E',
                    'msg'=>'Something went wrong',

                );
            }
            return json_encode($result);
        }
    }



    public function actionUpdate($id) {
       
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = SocialmediaMaster::find()->where([
            'socialmediamst_pk'    =>  $id
        ])->one();
       
        if($data['socialmediamaster'])
        {  
           


            $status=($data['socialmediamaster']['Status'] ==true)?1:0;
            $model->sm_status=$status;
            $model->sm_order=$data['socialmediamaster']['SocialmediaOrder'];
            $model->sm_name=$data['socialmediamaster']['SocialmediaName'];
            $model->sm_icons=$data['socialmediamaster']['SocialmediaIcon'];


        }
        else if($data['updatestatus']){ 
            
            $status=($model->sm_status==1)?0:1;
            $model->sm_status=$status;
            /* $params['sm_status']=$status; */
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'updated successfully',
                'returndata' => $model->socialmediamst_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Something went wrong',

            );
        }
        return json_encode($result);
    }


    public function actionDelete($id) {
        $model = SocialmediaMaster::find()->where([
            'socialmediamst_pk'    =>  $id
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

    public function actionSocialmedialist()
    {
        return new ActiveDataProvider([
            'query' => SocialmediaMaster::find()
                ->select(['socialmediamst_pk','sm_name'])
                ->active(),
            'sort'=> ['defaultOrder' => ['sm_name'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }
    
    public function actionSocialmedia()
    {
        $data = SocialmediaMaster::find()
                ->select(['socialmediamst_pk as pk','sm_name as name'])
                ->where(['sm_status' => 1])
                ->asArray()->all();
        
        return $data ? $this->asJson($data) : [];
    }


}