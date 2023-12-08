<?php

namespace api\modules\mst\controllers;

use Yii;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\SubsectormstTbl;
use api\modules\mst\models\SectormstTbl;

class SubsectormstController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\SubsectormstTbl';
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

    public function actionIndex(){
        $sector	=	$_REQUEST['sector'];
        $industry	=	$_REQUEST['industry'];
        $activity	=	$_REQUEST['activity'];
        $query = SubsectormstTbl::find();
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
        $query->select(['*']);
        $query ->leftJoin('sectormst_tbl','subsectormst_tbl.ssm_sectormst_fk=sectormst_tbl.sectorMst_Pk');
        $query->asArray();
        $page=(!empty($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){

        $model=SubsectormstTbl::find()
            ->select(['subsectormst_tbl.*'])
            ->leftJoin('sectormst_tbl','subsectormst_tbl.ssm_sectormst_fk=sectormst_tbl.sectorMst_Pk')
            ->where([
                'subsectormst_pk'    =>  $id
            ])->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $model = SubsectormstTbl::find()->active()->where([
            'subsectormst_pk'    =>  $id
        ])->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }



    public function actionNewuser(){
        $model = new SubsectormstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
      
        $model->ssm_sectormst_fk = $data['usermaster']['cat'];
        $model->ssm_subsectorname = $data['usermaster']['name'];
        $model->ssm_status = ($data['usermaster']['status'] ==true)?"1":"2";
        $model->ssm_createdon = date('Y-m-d H:i:s');
        $model->ssm_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Subsector created successfully',
                'returndata' => $model->subsectormst_pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                // 'msg'=>'Something went wrong'
                'msg'=>$model->getErrors()
            );
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = SubsectormstTbl::find()->where([
            'subsectormst_pk'    =>  $id
        ])->one();
        if($data['activitymaster'])
        {
        $model->ssm_sectormst_fk = $data['usermaster']['cat'];
        $model->ssm_subsectorname = $data['usermaster']['name'];
        $model->ssm_status = ($data['usermaster']['status'] ==true)?"1":"2";
        $model->ssm_updatedon = date('Y-m-d H:i:s');
        $model->ssm_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Sub Sector updated successfully',
                    'returndata' => $model->subsectormst_pk
                );
            } else {

                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong'
                );
            }
        }
        else if($data['updatestatus'])
        {
            $model = SubsectormstTbl::find()->where([
                'subsectormst_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->ssm_status=="1")?"2":"1";
            $model->ssm_status=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Activity updated successfully',
                    'returndata' => $model->subsectormst_pk
                );
            }
        }

        return json_encode($result);
    }
    public function actionUpdatestatus($id)
    {
        $model = $this->actionView($id);
        $status=($model->ActM_status=="A")?"I":"A";
        $model->ActM_status=$status;
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
        $model = SubsectormstTbl::find()->where([
            'subsectormst_pk'    =>  $id
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

    public function actionSectorlist(){
        return new ActiveDataProvider([
            'query' => SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->active(),
            'pagination'=>['pageSize' => false],
        ]); 

    }
}
