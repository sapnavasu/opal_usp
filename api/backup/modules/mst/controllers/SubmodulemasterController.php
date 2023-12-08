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
use yii\web\HttpException;
// use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\SubmodulemstTbl;


class SubmodulemasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\SubmodulemstTbl';

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
    /**
     * Return list of staff members
     *
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $submodule  =   $_REQUEST['submodule'];
        $module  =   $_REQUEST['module'];

        $query = SubmodulemstTbl::find();
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
            if($_REQUEST['SMM_Status']==0){
                $query->andFilterWhere(['LIKE',Common::getTableWithPrefix('SMM_Status', true), 0]);
               }
        }
        $query->select(["submodulemst_tbl.*",
            "if(submodulemst_tbl.SMM_Status = 'A', 'primary','warn') as `color`","MM_Name","if(submodulemst_tbl.SMM_Status = 1, 'A','I') as `SMM_Status`"]);
        $query->leftJoin('modulemst_tbl','modulemst_tbl.ModuleMst_Pk=submodulemst_tbl.SMM_ModuleMst_Fk');
        if(isset($_GET['ModuleMst_Fk'])){
            $query->andWhere(['SMM_ModuleMst_Fk'=>$_GET['ModuleMst_Fk']]);
            $query->andWhere(['SMM_Status'=>1]);
        }
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider   = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' =>$page]
        ]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }


    public function actionView($id){
        $module = SubmodulemstTbl::find()->where([
            'SubModuleMst_Pk'    =>  $id
        ])->one();
 //$dataReader = Yii::$app->db->createCommand( 'SELECT * FROM submodulemst_tbl where SubModuleMst_Pk="'.$id.'"' )->queryAll();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function actionNewsubmodule(){
        $model = new SubmodulemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['submodulemaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['submodulemaster']['Status'] ==true)?"A":"I";
                $params['SMM_'.$key.'']=$status;
            }
            else {
                $params['SMM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Submodule created successfully',
                'returndata' => $model->SubModuleMst_Pk
            );
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

        if($data['submodulemaster'])
        {
            $model = SubmodulemstTbl::find()->where([
                'SubModuleMst_Pk'    =>  $id
            ])->one();
            foreach ($data['submodulemaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['submodulemaster']['Status'] ==true)?"A":"I";
                    $params['SMM_'.$key.'']=$status;
                }
                else {
                    $params['SMM_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'Sub Module updated successfully',
                    'returndata' => $model->SubModuleMst_Pk);
            } else {
                $result=array('status' => 200, 'statusmsg' => 'warning','flag'=>"E",
                    'msg'=>'Something went wrong',
                );


            }
        }
        else if($data['updatestatus'])
        {
            $model = SubmodulemstTbl::find()->where([
                'SubModuleMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->SMM_Status=="A")?"I":"A";
            $model->SMM_Status=$status;
            if ($model->save(false)) {
                $result=array('status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'Sub Module updated successfully',
                    'returndata' => $model->SubModuleMst_Pk);
            } else {
                $result=array('status' => 200, 'statusmsg' => 'warning','flag'=>"E",
                    'msg'=>'Something went wrong',
                );


            }
        }


        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->SMM_Status=="A")?"I":"A";
        $model->SMM_Status=$status;
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
        $model = $this->actionView($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
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


    /**
     * Return list of available permissions for the staff.  The function will be called when staff form is loaded in backend.
     *
     * Request: GET /v1/staff/get-permissions
     *
     * Sample Response:
     * {
     *		"success": true,
     *		"status": 200,
     *		"data": {
     *			"manageSettings": {
     *				"name": "manageSettings",
     *				"description": "Manage settings",
     *				"checked": false
     *			},
     *			"manageStaffs": {
     *				"name": "manageStaffs",
     *				"description": "Manage staffs",
     *				"checked": false
     *			}
     *		}
     *	}
     */
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
    
    public function actionGetsubmodulelist(){
        $moduleIds  =   $_REQUEST['mids'];
        $subModulelist =  new ActiveDataProvider([
        'query' => SubmodulemstTbl::find()
           ->select(['SubModuleMst_Pk','SMM_SubModName','SMM_ModuleMst_Fk'])
           ->andWhere('SMM_ModuleMst_Fk IN ('.$moduleIds.')')
           ->asArray()
        ]);
        $result = $subModulelist->getModels();
        if(!empty($result)){
            $resultData = array();
            foreach($result as $key => $value){
                $resultData[$key]['key'] = $value['SMM_ModuleMst_Fk'].'~'.$value['SubModuleMst_Pk'];
                $resultData[$key]['value'] = $value['SMM_SubModName'];
            }
        }
        return $resultData;
    }


}
