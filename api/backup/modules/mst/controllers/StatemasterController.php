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

use api\modules\mst\models\StatemstTbl;

class StatemasterController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\StatemstTbl';

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

        $query = StatemstTbl::find();
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
        $query->select(['statemst_tbl.*',
            'if(statemst_tbl.SM_Status = "A", "primary","warn") as `color`','countrymst_tbl.CyM_CountryName_en']);
        $query->leftJoin('countrymst_tbl','statemst_tbl.SM_CountryMst_Fk=countrymst_tbl.CountryMst_Pk');
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }

    public function actionView($id){
        $country = StatemstTbl::find()->where([
            'StateMst_Pk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function actionSearch($id){
        $country = StatemstTbl::find()->active()->where([
            'SM_CountryMst_Fk'    =>  $id
        ])->one();
        if($country){
            return $country;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }


    /**
     * Create new staff member from backend dashboard
     *
     * Request: POST /v1/staff/1
     *
     * @return User
     * @throws HttpException
     */
    public function actionNewstate(){
        $model = new StatemstTbl();
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        foreach ($data['statemaster'] as $key=>$value) {
            if($key=="Status")
            {
                $status=($data['statemaster']['Status'] ==true)?"A":"I";
                $params['SM_'.$key.'']=$status;
            }
            else {
                $params['SM_'.$key.'']=$value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Created Successfully',
                'returndata' => $model->StateMst_Pk
            );
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }
    public function actionUpdate($id) {
        $params=[];
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $model = StatemstTbl::find()->where([
            'StateMst_Pk'    =>  $id
        ])->one();
        if($data['statemaster'])
        {
            foreach ($data['statemaster'] as $key=>$value) {
                if($key=="Status")
                {
                    $status=($data['statemaster']['Status'] ==true)?"A":"I";
                    $params['SM_'.$key.'']=$status;
                }
                else {
                    $params['SM_'.$key.'']=$value;
                }
            }
        }
        else if($data['updatestatus'])
        {
            $model = StatemstTbl::find()->where([
                'StateMst_Pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->SM_Status=="A")?"I":"A";
            $params['SM_Status']=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Updated Successfully',
                'returndata' => $model->StateMst_Pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'something went wrong',
                'returndata' => $model->StateMst_Pk
            );
            throw new HttpException(422, json_encode($model->errors));
        }
        return json_encode($result);
    }
    public function actionUpdatestatus()
    {
        $model = $this->actionView($id);
        $status=($model->SM_Status=="A")?"I":"A";
        $model->SM_Status=$status;
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
        $model = StatemstTbl::find()->where([
            'StateMst_Pk'    =>  $id
        ])->one();
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

    public function actionStatelistbycountry()
    {
           
        if (isset($_GET['custom'])) {
            $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                return new ActiveDataProvider([
                    'query' => StatemstTbl::find()
                        ->select(['StateMst_Pk', 'SM_StateName_en','SM_StateName_ar'])
                        ->where(['SM_CountryMst_Fk' => $_GET['countryid']])
                        ->active()
                        ->where('SM_CreatedBy=:SM_CreatedBy', [':SM_CreatedBy' => $userpk]),
                    'sort' => ['defaultOrder' => ['SM_StateName_en' => SORT_ASC]],
                    'pagination' => ['pageSize' => false]
                ]);

            }

            $stateDataByCountry = new ActiveDataProvider([
                'query' => StatemstTbl::find()
                    ->select(['StateMst_Pk','SM_StateName_en','SM_StateName_ar'])
                    ->where(['SM_CountryMst_Fk'=>$_GET['countryid']])
                    ->active(),
                'pagination'=>['pageSize' => false],
            ]);

        return $stateDataByCountry;
    }

    public function actionGetjson()
    {
        /*$result=array(
               'status' => 200,
               'statusmsg' => 'warning',
               'msg'=>'something went wrong',
               'returndata' => $model->StateMst_Pk
           );*/
        $test=array(
            0=>[
                'type'=>"input",
                'label'=>"Username",
                'inputType'=>"text",
                'name'=>"name",
                'validations'=>[
                    0=>
                        ['name'=>"required",
                            'validator'=> 'required',
                            'message'=> "Name Required"],
                    1=>['name'=>"pattern",
                        'validator'=> 'onlyText',
                        'message'=>"Accept only text"]
                ]
            ],
            1=>
                [
                    'type'=> "input",
                    'label'=> "Email Address",
                    'inputType'=> "email",
                    'name'=> "email",
                    'validations'=>[
                        0=>
                            [ 'name'=> "required",
                                'validator'=> 'required',
                                'message'=> "Email Required"
                            ],
                        1=>[
                            'name'=> "pattern",
                            'validator'=> 'emailpattern',
                            'message'=> "Invalid email"
                          ]
                    ]
                ],
            2=>
                [
                    'type'=> "input",
                    'label'=> "Password",
                    'inputType'=> "password",
                    'name'=> "password",
                    'validations'=>[
                        0=>
                            [ 'name'=> "required",
                                'validator'=> 'required',
                                'message'=> "Password Required"
                            ],
                        1=>[
                            'name'=> "pattern",
                            'validator'=> 'passwordpattern',
                            'message'=> "Invalid email"
                        ]
                    ]
                ],
            3=>
                [
                    'type'=> "radiobutton",
                    'label'=> "Gender",
                    'name'=> "gender",
                    'options'=> ["Male", "Female"],
                    'value'=> "Male"
                ],
            4=>
                [
                    'type'=> "date",
                    'label'=> "DOB",
                   'name'=> "dob",
                    'validations'=>[
                        0=>
                            [
                                'name'=> "required",
                                'validator'=> 'required',
                                'message'=> "Date of Birth Required"
                            ],

                    ]
                ]

        );
       // echo json_encode($test);die;
        $result=array(
            'status' => 200,
            'statusmsg' => 'warning',
            'data'=>json_encode($test),
            'returndata' => 1
        );

        return $result;die;
    }
   public function  actionUploaddata()
   {

       $request_body	=	file_get_contents('php://input');
       $data =	json_decode($request_body, true);
        print_r($data);die;
        if($data)
        {
            echo $data['profiledata']['description'];die;
        }
   }
}