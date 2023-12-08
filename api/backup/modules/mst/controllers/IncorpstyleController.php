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
use api\modules\mst\models\IncorpstyleMasterQuery;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\IncorpstyleMaster;
use api\modules\mst\models\CountryMaster;


class IncorpstyleController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\IncorpstyleMaster';

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
        
        $query = IncorpstyleMaster::find();
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
        
        $query->select(['*']);
        $query->leftJoin('countrymst_tbl','CountryMst_Pk=MCISM_CountryMst_Fk');
        $query->asArray();
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        //echo $page;die;
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

        $incorpstyle = IncorpstyleMaster::find()->where([
            'MemCompIncorpStyleMst_Pk'    =>  $id
        ])->one();
        if($incorpstyle){
            return $incorpstyle;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    public function actionIncorpstyle(){
        $model = new IncorpstyleMaster();
        $params=[];
        $result=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        
        $model->MCISM_CountryMst_Fk=$data['incorpstylemaster']['IncorpstyleCode'];
        $model->MCISM_IncorpStyleEntity=$data['incorpstylemaster']['IncorpstyleEntity'];
        $model->MCISM_IncorpStyleBrief=$data['incorpstylemaster']['IncorpstyleBrief'];
        
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Created successfully',
                'returndata' => $model->MemCompIncorpStyleMst_Pk
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



    public function actionUpdate($id) {
        
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = IncorpstyleMaster::find()->where([
            'MemCompIncorpStyleMst_Pk'    =>  $id
        ])->one();
        
        $model->MCISM_CountryMst_Fk=$data['incorpstylemaster']['IncorpstyleCode'];
        $model->MCISM_IncorpStyleEntity=$data['incorpstylemaster']['IncorpstyleEntity'];
        $model->MCISM_IncorpStyleBrief=$data['incorpstylemaster']['IncorpstyleBrief'];
       if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'country updated successfully',
                'returndata' => $model->MemCompIncorpStyleMst_Pk
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
        $model = IncorpstyleMaster::find()->where([
            'MemCompIncorpStyleMst_Pk'    =>  $id
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

    public function actionIncorpstylelist()
    {
        return new ActiveDataProvider([
            'query' => CountryMaster::find()
                ->select(['CountryMst_Pk','CyM_CountryName_en','CyM_CountryCode_en','CyM_CountryDialCode'])
                ->where(['CyM_Status' => 'A'])
                ->active(),
            'sort'=> ['defaultOrder' => ['CyM_CountryName_en'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }
    

}