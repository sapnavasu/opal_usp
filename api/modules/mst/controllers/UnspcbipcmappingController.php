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
use api\modules\mst\models\UnspcbipcmappingTbl;
use api\modules\mst\models\BgiindcodesubcategTbl;
use api\modules\mst\models\ProductmstTbl;
use api\modules\mst\models\SegmentmstTbl;
use api\modules\mst\models\FamilymstTbl;
use api\modules\mst\models\ClassmstTbl;
use api\modules\mst\models\BgiinduscodeprodmstTbl;
use yii\base\Model;

class UnspcbipcmappingController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\UnspcbipcmappingTbl';

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

        

        $query = UnspcbipcmappingTbl::find();
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
        // $query->select(['*']);
        // $query->leftJoin('bgiinduscodeprodmst_tbl','bgiinduscodeprodmst_tbl.bgiinduscodeprodmst_pk=unspcbipcmapping_tbl.ubpm_bgiinduscodeprodmst_fk');
        // $query->leftJoin('productmst_tbl','productmst_tbl.ProductMst_Pk=unspcbipcmapping_tbl.ubpm_productmst_fk');
        $query->select(['*','group_concat(ubpm_productmst_fk)','group_concat(PrdM_ProductName) AS product']);
        $query->leftJoin('bgiinduscodeprodmst_tbl','bgiinduscodeprodmst_tbl.bgiinduscodeprodmst_pk=unspcbipcmapping_tbl.ubpm_bgiinduscodeprodmst_fk');
        $query->leftJoin('productmst_tbl','productmst_tbl.ProductMst_Pk=unspcbipcmapping_tbl.ubpm_productmst_fk');
        $query->groupBy('ubpm_bgiinduscodeprodmst_fk');
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
        $country = UnspcbipcmappingTbl::find()->where([
            'unspcbipcmapping_pk'    =>  $id
        ])->one();
       
        //echo "<pre>";print_r($UnspcbipcmappingTbl);die;
        // print_r($country);exit;
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $country = UnspcbipcmappingTbl::find()->active()->where([
            'unspcbipcmapping_pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionNewuser(){
        $model = new UnspcbipcmappingTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        print_r($data['usermaster']);exit;
        // print_r($data['usermaster']);exit;
        // foreach ($data['usermaster'] as $key=>$value) {
        //     if($key=="status")
        //     {
        //         $status=($data['usermaster']['status'] ==true)?"A":"I";
        //         $params['aum_'.$key.'']=$status;
        //     }
        //     else {
        //         $params['aum_'.$key.'']=$value;
        //     }
        // } 
        $model->ubpm_bgiinduscodeprodmst_fk=$data['usermaster']['product'];
        $model->ubpm_productmst_fk=$data['usermaster']['map'];
        // $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'user created successfully',
                'returndata' => $model->unspcbipcmapping_pk
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
        $model = UnspcbipcmappingTbl::find()->where([
            'unspcbipcmapping_pk'    =>  $id
        ])->one();
        if($data['usermaster'])
        {
            foreach ($data['usermaster'] as $key=>$value) {
                if($key=="status")
                {
                    $status=($data['usermaster']['status'] ==true)?"A":"I";
                    $params['aum_'.$key.'']=$status;
                }
                else {
                    $params['aum_'.$key.'']=$value;
                }
            }
            $model->load($params, '');
            if ($model->validate() && $model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'user updated successfully',
                    'returndata' => $model->unspcbipcmapping_pk
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
            $model = UnspcbipcmappingTbl::find()->where([
                'unspcbipcmapping_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->aum_status=="A")?"I":"A";
            //$params['aum_status']=$status;
            $model->aum_status=$status;
            if($model->save(false))
            {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>"S",
                    'msg'=>'updated successfully',
                    'returndata' => $model->unspcbipcmapping_pk
                );
            }

        }

        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->aum_status=="A")?"I":"A";
        $model->aum_status=$status;
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
        $a=1;
        $models = UnspcbipcmappingTbl::find()->where([
            'ubpm_bgiinduscodeprodmst_fk'    =>  $id
        ])->all(); 
        foreach ($models as $model) {
            if ($model->delete() === false) {
                $a=0;
            }
        }
        if ($a==0) {
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

    public function actionGetproduct(){
        return new ActiveDataProvider([
            'query' => BgiinduscodeprodmstTbl::find()
                ->select(['bgiinduscodeprodmst_pk','bicpm_productname'])
                ->where(['bicpm_prodstatus'=>1]),
            'pagination'=>['pageSize' => false],
        ]); 

    }

    public function actionGetmaplist(){
        // ini_set('memory_limit', '256M');
        return new ActiveDataProvider([
            'query' => ProductmstTbl::find()
                      ->where(['PrdM_Status'=>'A','PrdM_ClassMst_Fk'=>$_GET['id']])
                      ->select(['ProductMst_Pk','PrdM_ProductName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }
    public function actionGetsegmentlist(){
        // ini_set('memory_limit', '256M');
        
        return new ActiveDataProvider([
            'query' => SegmentmstTbl::find()
                      ->where(['SegM_Status'=>'A','SegM_SegCategory'=>'P'])
                      ->select(['SegmentMst_Pk','SegM_SegName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionGetfamilylist(){
        // ini_set('memory_limit', '256M');
        
        return new ActiveDataProvider([
            'query' => FamilymstTbl::find()
                      ->where(['FamM_Status'=>'A','FamM_FamilyCategory'=>'P','FamM_SegmentMst_Fk'=>$_GET['id']])
                      ->select(['FamilyMst_Pk','FamM_FamilyName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionGetclasslist(){
         return new ActiveDataProvider([
            'query' => ClassmstTbl::find()
                      ->where(['ClsM_Status'=>'A','ClsM_FamilyCategory'=>'P','ClsM_FamilyMst_Fk'=>$_GET['id']])
                      ->select(['ClassMst_Pk','ClsM_ClassName']),
                    'pagination'=>['pageSize' => false],
        ]); 
       
    }

    
    public function actionGetchipslist(){
               
        return new ActiveDataProvider([
            'query' => UnspcbipcmappingTbl::find()
                ->select(['ubpm_bgiinduscodeprodmst_fk','ubpm_productmst_fk','productmst_tbl.PrdM_ProductName'])
                ->where(['ubpm_bgiinduscodeprodmst_fk'=>$_GET['id']])
                ->leftJoin('productmst_tbl','productmst_tbl.ProductMst_Pk=unspcbipcmapping_tbl.ubpm_productmst_fk')
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionFiltersegment(){
               
        return new ActiveDataProvider([
            'query' => SegmentmstTbl::find()
                ->where(['SegM_Status'=>'A','SegM_SegCategory'=>'P'])
                ->select(['SegmentMst_Pk','SegM_SegName'])
                ->andWhere(['like', 'SegM_SegName', $_GET['val']])
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionFilterfamily(){
               
        return new ActiveDataProvider([
            'query' => FamilymstTbl::find()
                ->where(['FamM_Status'=>'A','FamM_FamilyCategory'=>'P'])
                ->select(['FamilyMst_Pk','FamM_FamilyName','FamM_SegmentMst_Fk'])
                ->andWhere(['like', 'FamM_FamilyName', $_GET['val']])
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }
    public function actionFilterclass(){
               
        return new ActiveDataProvider([
            'query' => ClassmstTbl::find()
                ->where(['ClsM_Status'=>'A','ClsM_FamilyCategory'=>'P'])
                ->select(['ClassMst_Pk','ClsM_ClassName','ClsM_SegmentMst_Fk','ClsM_FamilyMst_Fk'])
                ->andWhere(['like', 'ClsM_ClassName', $_GET['val']])
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionFilterproduct(){
               
        return new ActiveDataProvider([
            'query' => ProductmstTbl::find()
                ->where(['PrdM_Status'=>'A'])
                ->select(['ProductMst_Pk','PrdM_ProductName','PrdM_SegmentMst_Fk','PrdM_FamilyMst_Fk','PrdM_ClassMst_Fk'])
                ->andWhere(['like', 'PrdM_ProductName', $_GET['val']])
                ->asArray(),
            'pagination'=>['pageSize' => false],
        ]); 
       
    }

    public function actionInsertmap(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        // print_r($data);
        // print_r($data['add'][0]['ubpm_bgiinduscodeprodmst_fk']);
        // print_r($data['add'][0]['ubpm_productmst_fk']);
        // print_r(($data['del'][0]));
        // exit;
        $x = 0;
        $flag=1;
        $delflag=1;
        for ($x = 0; $x < count($data['add']); $x++) {
            $model = new UnspcbipcmappingTbl();
            $model->ubpm_bgiinduscodeprodmst_fk=$data['add'][$x]['ubpm_bgiinduscodeprodmst_fk'];
            $model->ubpm_productmst_fk=$data['add'][$x]['ubpm_productmst_fk'];
            // print_r($data['add'][$x]);
            if ($model->validate() && $model->save()) {
                $flag=1;
            }
            else{
                $flag=0;
            }
        }
        $x = 0;
        for ($x = 0; $x < count($data['del']); $x++) {
            $model = UnspcbipcmappingTbl::find()
            ->where(['ubpm_bgiinduscodeprodmst_fk'=>$data['del'][$x]['ubpm_bgiinduscodeprodmst_fk'],
            'ubpm_productmst_fk'=>$data['del'][$x]['ubpm_productmst_fk']])
            ->one();
            if ($model->delete()) {
                $delflag=1;
            }
            else{
                $delflag=0;
            }
                       
        }
        
        
        if ($flag == 1 and $delflag == 1) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Mapped Successfully',
                // 'returndata' => $model->unspcbipcmapping_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>"E",
                'msg'=>'something went wrong',

            );
    }
    return json_encode($result);
}
}
// ,'productmst_tbl.PrdM_ProductName'
// ->leftJoin('productmst_tbl','productmst_tbl.ProductMst_Pk=unspcbipcmapping_tbl.ubpm_productmst_fk')