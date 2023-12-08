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
use api\modules\mst\models\BgiinduscodeprodmstTbl;
use api\modules\mst\models\BgiindcodesubcategTbl;

class BgiinduscodeprodController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\BgiinduscodeprodmstTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }
    public function beforeAction($action)
    {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        //header("Access-Control-Allow-Headers: Content-Type");

        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
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

    public function actionIndex(){
       
    
        
        $query = BgiinduscodeprodmstTbl::find();
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
        $query->select(["*","if(bgiinduscodeprodmst_tbl.bicpm_prodstatus = 1, 'A','I') as `bicc_status`"]);
        $query->leftJoin('bgiindcodecateg_tbl','bgiinduscodeprodmst_tbl.bicpm_bgiindcodecateg_fk=bgiindcodecateg_tbl.bgiindcodecateg_pk');
        $query->leftJoin('bgiindcodesubcateg_tbl','bgiinduscodeprodmst_tbl.bicpm_bgiindcodesubcateg_fk=bgiindcodesubcateg_tbl.bgiindcodesubcateg_pk');
        $query->asArray();
        $provider = new ActiveDataProvider(['query' => $query]);
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        $provider->pagination->pageSize=$page;
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public function actionView($id){
        $country = BgiinduscodeprodmstTbl::find()->where([
            'bgiinduscodeprodmst_pk'    =>  $id
        ])->one();
       
              if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $country = BgiinduscodeprodmstTbl::find()->active()->where([
            'bicpm_prodstatus'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewuser(){
        $model = new BgiinduscodeprodmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $model['bicpm_prodstatus']=($data['usermaster']['status'] ==1)?1:0;
        $model['bicpm_bgiindcodecateg_fk']=$data['usermaster']['cat'];
        $model['bicpm_bgiindcodesubcateg_fk']=$data['usermaster']['subcat'];
        $model['bicpm_productcode']=$data['usermaster']['code'];
        $model['bicpm_productname']=$data['usermaster']['name'];
        $model['bicpm_createdby']=19;
        // $model->load($params, '');
        // $model['auth_key']="sample";
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'user created successfully',
                'returndata' => $model->bicpm_prodstatus
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>"E",
                'msg'=>'something went wrong',
               

            );
            //throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = BgiinduscodeprodmstTbl::find()->where([
            'bicpm_prodstatus'    =>  $id
        ])->one();
        if($data['usermaster'])
        {
           
            $model['bicpm_prodstatus']=($data['usermaster']['status'] ==1)?1:0;
        $model['bicpm_bgiindcodecateg_fk']=$data['usermaster']['cat'];
        $model['bicpm_bgiindcodesubcateg_fk']=$data['usermaster']['subcat'];
        $model['bicpm_productcode']=$data['usermaster']['code'];
        $model['bicpm_productname']=$data['usermaster']['name'];
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'user updated successfully',
                    'returndata' => $model->bicpm_prodstatus
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>"E",
                    'msg'=>'something went wrong',

                );
            }
        }
        else if($data['updatestatus'])
        {
            $model = BgiinduscodeprodmstTbl::find()->where([
                'bgiinduscodeprodmst_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->bicpm_prodstatus==1)?0:1;
            $model->bicpm_prodstatus=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'updated successfully',
                    'returndata' => $model->bicpm_prodstatus
                );
            }

        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->bicpm_prodstatus=="A")?"I":"A";
        $model->bicpm_prodstatus=$status;
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
        $model = BgiinduscodeprodmstTbl::find()->where([
            'bicpm_prodstatus'    =>  $id
        ])->one();
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            return "ok";
        }

    }

    /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return array
     * @throws HttpException
     */
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
    public function actionSubcategorylistbycategory(){
        return new ActiveDataProvider([
            'query' => BgiindcodesubcategTbl::find()
                ->select(['bgiindcodesubcateg_pk','bicsc_subcategoryname'])
                ->where(['bicsc_bgiindcodecateg_fk'=>$_GET['categoryid']])
                ->active(),
            'pagination'=>['pageSize' => false],
        ]); 

    }




}