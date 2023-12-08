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
// use api\modules\mst\models\NatlookoutsubcatTblQuery;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\NatlookoutsubcatTbl;
use api\modules\mst\models\NatlookoutcatmstTbl;
use api\modules\mst\models\CountryMaster;
class   NatlookoutsubcatController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\NatlookoutsubcatTbl';

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
        
        $query = NatlookoutsubcatTbl::find();
        if($_REQUEST['type']=='filter')
        {   
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            //  print_r($_REQUEST);
            //  exit;
            // foreach(array_filter($_REQUEST) as $key =>$val)
            // {   
            //     if(!is_null($val))
            //     {   
            //         $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
            //     } 
            // } 
            if($_REQUEST['NLkCM_Category'])
            {   
                $query->andFilterWhere(['LIKE','NLkCM_Category', $_REQUEST['NLkCM_Category']]);
            }
            if($_REQUEST['NLkSCM_SubCategory'])
            {   
                $query->andFilterWhere(['LIKE','NLkSCM_SubCategory', $_REQUEST['NLkSCM_SubCategory']]);
            }
            if($_REQUEST['NLkSCM_Status'])
            {   
                $query->andFilterWhere(['LIKE','NLkSCM_Status', $_REQUEST['NLkSCM_Status']]);
            }


        }
        // $query->select(['natlookoutsubcatmst_tbl.*',
        // 'if(natlookoutsubcatmst_tbl.CyM_Status = "A", "primary","warn") as `color`']);
        $query->select(['*']);
        $query->leftJoin('natlookoutcatmst_tbl','NatLookOutCatMst_Pk=NLkSCM_NatLookOutCatMst_Fk');
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

        $country = NatlookoutsubcatTbl::find()->where([
            'NatLookOutSubCatMst_Pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    public function actionNewcountry(){
        $model = new NatlookoutsubcatTbl();
        $params=[];
        $result=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model->load($params, '');
        $status=($data['nlcmsubmaster']['status'] ==true)?"A":"I";
        $model->NLkSCM_NatLookOutCatMst_Fk=$data['nlcmsubmaster']['category'];
        $model->NLkSCM_SubCategory=$data['nlcmsubmaster']['subcategory'];
        $model->NLkSCM_Status=$status;
        $model->NLkSCM_CreatedOn = date('Y-m-d H:i:s');
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->NLkSCM_CreatedBy = $userpk;
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'country created successfully',
                'returndata' => $model->NatLookOutSubCatMst_Pk
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
        $model = NatlookoutsubcatTbl::find()->where([
            'NatLookOutSubCatMst_Pk'    =>  $id
        ])->one();
        if($data['nlcmsubmaster'])
        { 
            // foreach ($data['countrymaster'] as $key=>$value) {
            //     if($key=="Status")
            //     {
            //         $status=($data['countrymaster']['Status'] ==true)?"A":"I";
            //         $params['NLkSCM_'.$key.'']=$status;
            //     }
            //     else {
            //         $params['NLkSCM_'.$key.'']=$value;
            //     }
            // }
            
            // $model->load($params, '');
        $status=($data['nlcmsubmaster']['status'] ==true)?"A":"I";
        $model->NLkSCM_NatLookOutCatMst_Fk=$data['nlcmsubmaster']['category'];
        $model->NLkSCM_SubCategory=$data['nlcmsubmaster']['subcategory'];
        $model->NLkSCM_Status=$status;
        }
        else if($data['updatestatus']){
            $status=($model->NLkSCM_Status=="A")?"I":"A";
            $model->NLkSCM_Status=$status;
            $params['NLkSCM_Status']=$status;
           
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Updated successfully',
                'returndata' => $model->NatLookOutSubCatMst_Pk
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
        $model = NatlookoutsubcatTbl::find()->where([
            'NatLookOutSubCatMst_Pk'    =>  $id
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

    public function actionList()
    {   
        // return new ActiveDataProvider([
        //     'query' => NatlookoutcatmstTbl::find()
        //         ->select(['*'])
        //         ->active(),
        //     'sort'=> ['defaultOrder' => ['NLkCM_Category'=>SORT_ASC]],
        //     'pagination' =>false
        // ]);
        return new ActiveDataProvider([
            'query' => NatlookoutcatmstTbl::find()
                ->select(['*']),
                // ->active(),
            // 'sort'=> ['defaultOrder' => ['CyM_CountryName_en'=>SORT_ASC]],
            'pagination' =>false
        ]);
    }

    public function actionDetaillist()
    {
       return new ActiveDataProvider([
        'query' => NatlookoutcatmstTbl::find()
            ->select(['NatLookOutCatMst_Pk','NLkCM_Category'])->asArray()
       ]);
    }
  
}