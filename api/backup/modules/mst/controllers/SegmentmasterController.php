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

use api\modules\mst\models\SegmentmstTbl;
use yii\web\Response;

class SegmentmasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\SegmentmstTbl';

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
        $segmentcode    =   $_REQUEST['segmentcode'];
        $segmentname    =   $_REQUEST['segmentname'];
        $category       =   $_REQUEST['category'];

        $query = SegmentmstTbl::find();
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
        $query->select(["*", "if(SegM_Status = 'A', 'primary','warn') as `color`", "(select count(*) from segmentmst_tbl) as overallcount"]);
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' => $page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
           // 'limit' =>10,
        ];
    }

    public function actionView($id){
        $module = SegmentmstTbl::find()->where([
            'SegmentMst_Pk'    =>  $id
        ])->one();
        if($module){
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }

    }

    public function actionNewsegment(){
        $model = new SegmentmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['segmentmaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['segmentmaster']['Status'] ==true)?"A":"I";
                $params['SegM_'.$key.'']=$status;
            }
            else {
                $params['SegM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array('status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Segment created successfully',
                'returndata' => $model->SegmentMst_Pk);
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

                if($data['segmentmaster'])
                {
                    $model = SegmentmstTbl::find()->where([
                        'SegmentMst_Pk'    =>  $id
                    ])->one();
                    foreach ($data['segmentmaster'] as $key=>$value) {
                        if($key=="Status")
                        {
                            $status=($data['segmentmaster']['Status'] ==true)?"A":"I";
                            $params['SegM_'.$key.'']=$status;
                        }
                        else {
                            $params['SegM_'.$key.'']=$value;
                        }
                    }
                    $model->load($params, '');
                    if ($model->validate() && $model->save()) {
                        $result=array('status' => 200,
                            'statusmsg' => 'success',
                            'flag'=>'S',
                            'msg'=>'Segment updated successfully',
                            'returndata' => $model->SegmentMst_Pk);
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
                    if($this->checkSegmentMapWithOtherTable($id)){
                    $model = SegmentmstTbl::find()->where([
                        'SegmentMst_Pk'    =>  $data['updatestatus']
                    ])->one();
                    $status=($model->SegM_Status=="A")?"I":"A";
                    $model->SegM_Status=$status;
                    if($model->save(false))
                    {
                        $result=array('status' => 200,
                            'statusmsg' => 'success',
                            'flag'=>'S',
                            'msg'=>'Segment updated successfully',
                            'returndata' => $model->SegmentMst_Pk);
                    }
                    }else{
                    $result=array('status' => 101,
                                'statusmsg' => 'fail',
                                'flag'=>'F',
                                'msg'=>'Segment is mapped to a family , so can\'t delete');
                    }
                }
        
        //echo "<pre>"; print_r($result); exit;
        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
            $model = $this->actionView($id);
            $status=($model->SegM_Status=="A")?"I":"A";
            $model->SegM_Status=$status;
            if ($model->save(false)) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
            } else {
                // Validation error
                throw new HttpException(422, json_encode($model->errors));
            }

            return $model;
    }

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
    
    public function checkSegmentMapWithOtherTable($segMentId){
        $productMap =   \api\modules\mst\models\ProductmstTbl::find()->where(["PrdM_SegmentMst_Fk"=>$segMentId])->count(); 
        $serviceMap =   \api\modules\mst\models\ServicemstTbl::find()->where(["SrvM_SegmentMst_Fk"=>$segMentId])->count(); 
        $classMap   =   \api\modules\mst\models\ClassmstTbl::find()->where(['ClsM_SegmentMst_Fk'=>$segMentId])->count();
        $familyMap  =   \api\modules\mst\models\FamilymstTbl::find()->where(['FamM_SegmentMst_Fk'=>$segMentId])->count();
        if($productMap >0 || $serviceMap >0 || $classMap >0 || $familyMap >0){
            return false;
        }else{
            return true;
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

    public function actionModulelist()
    {
        $model=new SegmentmstTbl();
        $command =(new \yii\db\Query())
            -> select([
                "SegmentMst_Pk","SegM_CurrencyName"
            ])
            -> from ($model->tableName())
            ->CreateCommand();
        $result = $command->queryAll();
        return json_encode($result);
    }

    public function actionProdouctandservice()
    { 
        return new ActiveDataProvider([
            'query' => SegmentmstTbl::find()
                ->select(["SegmentMst_Pk","SegM_SegName"])
                ->where(['SegM_SegCategory'=>$_GET['category']])
                ->andWhere(['SegM_Status' => 'A'])
                ->orderBy(['SegM_SegName' => SORT_ASC]),
                'pagination'=>false

        ]);
    }
    public function actionSegmentlist()
    {
        return new ActiveDataProvider([
            'query' => SegmentmstTbl::find()
                ->select(['SegmentMst_Pk','SegM_SegName'])
                ->active(),
            'pagination'=>false
        ]);
    }
}
