<?php

namespace api\modules\userlgn\controllers;

use app\filters\auth\HttpBearerAuth;
use common\models\UsermstTbl;
use Yii;


use yii\helpers\Json;
use yii\rbac\Permission;
use \common\components\Configuration;
use yii\web\HttpException;
use yii\rest\Controller;
use \common\models\UsermstTblQuery;
use common\components\Common;
use \common\components\Security;

class UserlgnController extends Controller
{
    public $modelClass = '\common\models\DepartmentmstTbl';

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
        /**/
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

        return $behaviors;
    }

 
		public function actionUserlgn()
		{
		$request_body = file_get_contents('php://input');
		$data = json_decode($request_body, true);
		$data = $data['AdminLoginForm'];

		$token = $attemptCount = '';
		$username = $_REQUEST['username'];
		 
		$model = \common\models\UsermstTblQuery::chkusernameexist($username);
		 
		if (count($model) > 0) {
		$msg = "success";
		$status = 1;
		}else
		{
		$msg = "failure";
		$status = 0;
		}
		if($model['flag'] == 'NR')
		{
          $msg = 'Email not registered with us';
        }

		return $this->asJson([
		'msg' => $msg ?? "failure",
		'status' => $status ?? 0,
		 'username' => $model['UM_LoginId'],
		]);

		}
}
