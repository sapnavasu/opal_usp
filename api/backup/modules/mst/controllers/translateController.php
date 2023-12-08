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

use api\modules\mst\models\LanguagetranslateTbl;
use api\modules\mst\models\LanguagemstTbl;

use yii\web\Response;
class TranslateController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\LanguagetranslateTbl';

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

    public function actionView($id)
    {
        $module = LanguagetranslateTbl::find()->where([
            'LAT_id' => $id
        ])->one();
        if ($module) {
            return $module;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
        // echo json_encode(current($module)); exit;
    }
    public function actionUpdateword()
    {   $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $orval=$data['updateword'];
        //echo $orval;die;
        $ex=explode(">>",$orval);
        //print_r($ex);die;
        $model = LanguagetranslateTbl::find()->where([
            'LAT_id'    => $ex[0]
        ])->one();
        $model->LAT_value=$ex[1];
        if($model->save(false))
        {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag' => 'S',
                'msg' => 'Word updated successfully',
                'returndata' => $model->LAT_id);
        }

    }
    public function actionIndexspl()
    {
        $query = LanguagetranslateTbl::find();
        if ($_REQUEST['type'] == 'swfilter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if ($val != null) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        //echo "<pre>";print_r($query);die;
            $var='languagetranslate_tbl.LAT_value='.$_REQUEST['LAT_value'];
        }
        $query->select(["languagetranslate_tbl.*",
            'languagekeywordmst_tbl.LAK_keyword','languagemst_tbl.LA_Name','languagekeywordmst_tbl.LAK_Createdon']);
        $query->leftjoin('languagekeywordmst_tbl','languagekeywordmst_tbl.LAK_id=languagetranslate_tbl.LAT_keyfk');
        $query->leftjoin('languagemst_tbl','languagemst_tbl.LA_id=languagetranslate_tbl.LAT_lanfk');
        if(!empty($_REQUEST['LAT_value']))
        {
            $query->where(['languagetranslate_tbl.LAT_lanfk'=>$_GET['languageid'],'languagetranslate_tbl.LAT_value'=>$_REQUEST['LAT_value']]);
        }
        else{
            $query->where(['languagetranslate_tbl.LAT_lanfk'=>$_GET['languageid']]);
        }
        $query->asArray();
       // print_r($query);die;
        $page = (isset($_GET['size'])) ? $_GET['size'] : 10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => 10,
        ];
    }
    public function actionIndex()
    {

        $query = LanguagetranslateTbl::find();
        if ($_REQUEST['type'] == 'filter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if ($val != null) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }

        }
        $query->select(["languagekeywordmst_tbl.*"]);
        $query->asArray();
        $page = (isset($_GET['size'])) ? $_GET['size'] : 10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => 10,
        ];
    }

    public function actionTranslatenew()
    {

        $model = new LanguagetranslateTbl();
        $params = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        foreach ($data['translatemaster'] as $key => $value) {

            $params['LAT_' . $key] = $value;

        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag' => 'S',
                'msg' => 'Word created successfully',
                'returndata' => $model->LAT_id);
        } else {
            //print_r($model->getErrors());die;
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Something went wrong',
            );
        }
        return json_encode($result);
    }

    public function actionUpdate($id)
    {

        $params = [];
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if ($data['translatemaster']) {
            $model = LanguagetranslateTbl::find()->where([
                'LAT_id' => $id
            ])->one();
            foreach ($data['translatemaster'] as $key => $value) {
                $params['LAT_id' . $key . ''] = $value;
            }
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag' => 'S',
                'msg' => 'word updated successfully',
                'returndata' => $model->LAT_id);
        } else {
            $result = array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Something went wrong',
            );
        }

        return json_encode($result);
    }

    public function actionDelete($id)
    {
        $module = LanguagetranslateTbl::find()->where([
            'LAT_id' => $id
        ])->one();

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        } else {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }

    public function actionLogin()
    {
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
                'id' => $id,
                'access_token' => $user->access_token,
            ];

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }


    public function actionGetPermissions()
    {
        $authManager = Yii::$app->authManager;

        /** @var Permission[] $permissions */
        $permissions = $authManager->getPermissions();

        /** @var array $tmpPermissions to store list of available permissions */
        $tmpPermissions = [];

        /**
         * @var string $permissionKey
         * @var Permission $permission
         */
        foreach ($permissions as $permissionKey => $permission) {
            $tmpPermissions[] = [
                'name' => $permission->name,
                'description' => $permission->description,
                'checked' => false,
            ];
        }

        return $tmpPermissions;
    }

    public function actionOptions($id = null)
    {
        return "ok";
    }

    public function actionJsondata()
    {
        /* $query = LanguagetranslateTbl::find();
         $query->select(['languagetranslate_tbl.*','languagekeywordmst_tbl.LAK_keyword']);
         $query->leftJoin('languagekeywordmst_tbl','languagekeywordmst_tbl.LAK_id=languagetranslate_tbl.LAT_keyfk');
         $query->leftJoin('languagemst_tbl','languagemst_tbl.LA_id=languagetranslate_tbl.LAT_lanfk');
         $query->asArray();
         $query->where(['languagetranslate_tbl.LAT_lanfk'=>  2]);
         return new ActiveDataProvider([
             'query' => $query
         ]);*/
        $language=$_GET['language'];
        $connection = Yii::$app->getDb();
        $sql = "SELECT  A.*,B.LAK_keyword,C.LA_Name FROM `languagetranslate_tbl` as A  left join languagekeywordmst_tbl as B on B.`LAK_id`=A.`LAT_keyfk` left join languagemst_tbl as C on C.`LA_id`=A.`LAT_lanfk` WHERE A.`LAT_lanfk` = $language ORDER BY `LAT_value` ASC";
        $command = $connection->createCommand($sql)->queryAll();
        $testarray = array();
        for ($i = 0; $i < count($command); $i++) {
            $testarray[$command[$i]['LAK_keyword']] = $command[$i]['LAT_value'];
        }
        $json=json_encode($testarray,JSON_UNESCAPED_UNICODE);

        if($language==1)
        {
            $file="en.json";
        }
        else
        {
            $file="ln.json";
        }
        $fp = fopen($file, 'w+');
        fwrite($fp, $json);
        fclose($fp);

        //file_put_contents('bgiv3/json/file.json', $json);
        /* $fp = fopen('bgiv3/json/file.json', 'w');
         $filename = 'file.json';

         $handle = fopen("bgiv3/json".$filename,'w+');

         fwrite($handle,$json);

         fclose($handle);*/
        /*header('Content-disposition: attachment; filename=file.json');
        header('Content-type: application/json');
        echo $json;*/
    }
}



