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

use api\modules\mst\models\ClassmstTbl;
use yii\web\Response;

class ClassmasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\ClassmstTbl';

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
        $requestdata = $_REQUEST;
        $query = ClassmstTbl::find();
        if($requestdata['type']=='filter')
        {
            unset($requestdata['type']);
            unset($requestdata['sort']);
            unset($requestdata['order']);
            unset($requestdata['page']);
            unset($requestdata['size']);
            foreach(array_filter($requestdata) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(["*", "if(ClsM_Status = 'A', 'primary','warn') as `color`", "(select count(*) from classmst_tbl) as overallcount", 
        "familymst_tbl.FamM_FamilyName", "segmentmst_tbl.SegM_SegName","DATE_FORMAT(ClsM_CreatedOn,'%d-%m-%Y') as ClsM_CreatedOn"]);
        $query->leftJoin('familymst_tbl', 'familymst_tbl.FamilyMst_Pk = classmst_tbl.ClsM_FamilyMst_Fk');
        $query->leftJoin('segmentmst_tbl', 'segmentmst_tbl.SegmentMst_Pk=familymst_tbl.FamM_SegmentMst_Fk');
        $sort_column = (strpos($_REQUEST['sort'],"-") !== false) ? explode("-",$_REQUEST['sort'])[1] : $_REQUEST['sort'];
        $query->orderBy("$sort_column {$_REQUEST['order']}");
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        /*
         if(isset($_GET['page']) && isset($_GET['sort']) && isset($_GET['order']) )
         {
            $model=new  ClassmstTbl();
            $start=($_GET['page']-1) * 10;
            $offset=10;
            $condition='limit '.$start.','.$offset;
            $order='ORDER BY '.$_GET['sort'].' '. $_GET['order'];
            //echo $order;die;
            $sort=($_GET['order'] =='asc')?SORT_ASC:SORT_DESC;
           $command =(new \yii\db\Query())
                                     -> select([
                                                "*",
                                                "if(A.ClsM_Status = 'A', 'primary','warn') as `color`",
                                                "(select count(*) from ".$model->tableName().") as overallcount"
                                               ])
                                     -> from ($model->tableName().' as A')
                                     -> orderBy ([$_GET['sort'] => ($_GET['order'] =='asc')?SORT_ASC:SORT_DESC])
                                     -> limit($offset)
                                     -> offset($start)
                                     -> CreateCommand();
            $rows = $command->queryAll();
            if(!empty($rows)){
                $result['items']          =   $rows;
                $result['total_count']    =   $rows[0]['overallcount'];
            }
      }

      return json_encode($result);
         *
         */
    }

    public function actionView($id){

        $class = ClassmstTbl::find()
            ->select(['classmst_tbl.*',
                'familymst_tbl.FamM_SegmentMst_Fk' ,'segmentmst_tbl.SegmentMst_Pk','segmentmst_tbl.SegM_SegCategory',
                "if(classmst_tbl.ClsM_Status = 'A', 'primary','warn') as `color`",'familymst_tbl.FamM_FamilyName'])
            ->innerJoin('familymst_tbl', '`classmst_tbl`.`Clsm_FamilyMst_Fk`=`familymst_tbl`.`FamilyMst_Pk`')
            ->innerJoin('segmentmst_tbl', '`familymst_tbl`.`FamM_SegmentMst_Fk`=`segmentmst_tbl`.`SegmentMst_Pk`')
            ->where(['ClassMst_Pk'    =>  $id])
            ->asArray()
            ->all();

        if($class){
            return $class;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }

    }
    public function actionNewclass(){

        $model = new ClassmstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['classmaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['classmaster']['Status'] ==true)?"A":"I";
                $params['ClsM_'.$key.'']=$status;
            }
            else {
                $params['ClsM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        $checkCodeCount = ClassmstTbl::checkCodeCount($data['classmaster']['ClassCode']);
        $checkNameCount = ClassmstTbl::checkNameCount($data['classmaster']['ClassName']);
        if(empty($checkCodeCount) && empty($checkNameCount)){
            if ($model->validate() && $model->save()) {
                $result=array('status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'Class created successfully',
                    'returndata' => $model->ClassMst_Pk);
            } else {
                $result=array('status' => 200,
                    'statusmsg' => 'warning','flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
        }else{
            if(!empty($checkCodeCount) && !empty($checkNameCount)){
                $errMessage = 'Class Code and Class Name is already available';
            }elseif(!empty($checkCodeCount) ){
                $errMessage = 'Class Code is already available';
            }elseif(!empty($checkNameCount)){
                $errMessage = 'Class Name is already available';
            }

            $result=array('status' => 200,
                    'statusmsg' => 'warning','flag'=>'E',
                    'msg'=>$errMessage,
                );
        }
        return json_encode($result);
    }
    public function actionUpdate($id) {

        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        if($data['classmaster'])
        {
            $model = ClassmstTbl::find()->where([
                'ClassMst_Pk'    =>  $id
            ])->one();
            foreach ($data['classmaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['classmaster']['Status'] ==true)?"A":"I";
                    $params['ClsM_'.$key.'']=$status;
                }
                else {
                    $params['ClsM_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            $checkCodeCount = ClassmstTbl::checkCodeCount($data['classmaster']['ClassCode'], $id);
            $checkNameCount = ClassmstTbl::checkNameCount($data['classmaster']['ClassName'], $id);
            if(empty($checkCodeCount) && empty($checkNameCount)){
                if ($model->validate() && $model->save()) {
                    $result=array('status' => 200,
                        'statusmsg' => 'success','flag'=>'S',
                        'msg'=>'Class updated successfully',
                        'returndata' => $model->ClassMst_Pk);
                } else {
                    $result=array('status' => 200,
                        'statusmsg' => 'warning','flag'=>'E',
                        'msg'=>'Something went wrong',
                    );
                }
            }else{
                if(!empty($checkCodeCount) && !empty($checkNameCount)){
                    $errMessage = 'Class Code and Class Name is already available';
                }elseif(!empty($checkCodeCount) ){
                    $errMessage = 'Class Code is already available';
                }elseif(!empty($checkNameCount)){
                    $errMessage = 'Class Name is already available';
                }

                $result=array('status' => 200,
                        'statusmsg' => 'warning','flag'=>'E',
                        'msg'=>$errMessage,
                    );
            }
        }
        else if($data['updatestatus'])
        {
            $model = ClassmstTbl::find()->where([
                'ClassMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->ClsM_Status=="A")?"I":"A";
            $model->ClsM_Status=$status;
            if($model->save(false))
            {
                $result=array('status' => 200,
                    'statusmsg' => 'success','flag'=>'S',
                    'msg'=>'updated successfully',
                    'returndata' => $model->ClassMst_Pk);
            }
        }


        return json_encode($result);
    }
    public function actionDelete($id) {
        $model = ClassmstTbl::find()
                    ->where(['ClassMst_Pk'=>$id])
                    ->one();
        if(!empty($model)){
            try{
                if ($model->delete() === false) {
                    $result=array('status' => 200,
                        'statusmsg' => 'success','flag'=>'S',
                        'msg'=>'Class is mapped with Product or Service, So can\'t able to delete',
                        'returndata' => $model->ClassMst_Pk);
                }else{
                    $result=array('status' => 200,
                        'statusmsg' => 'success','flag'=>'S',
                        'msg'=>'Class deleted successfully',
                        'returndata' => $model->ClassMst_Pk);
                }
            }catch(\yii\db\Exception $e){
                throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
            }
            
        }else{
            $result=array('status' => 200,
                    'statusmsg' => 'success','flag'=>'E',
                    'msg'=>'Class is not available',
                    'returndata' => $model->ClassMst_Pk);
        }
        return json_encode($result);

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
    public function actionClasslistbyfamilyid()
    {
        $familyid = $_GET['familyid'];
        return new ActiveDataProvider([
            'query' => ClassmstTbl::find()
                ->select(['ClassMst_Pk','ClsM_ClassName'])
                ->where(['ClsM_FamilyMst_Fk'=> $familyid])
                ->active()
        ]);
    }
    public function actionClasslist()
    {
        return new ActiveDataProvider([
            'query' => ClassmstTbl::find()
                ->select(['ClassMst_Pk','ClsM_ClassName'])
                ->active(),
            'sort'=> ['defaultOrder' => ['ClsM_ClassName'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }
}
