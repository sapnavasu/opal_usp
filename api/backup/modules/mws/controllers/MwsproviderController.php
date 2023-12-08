<?php

namespace api\modules\mws\controllers;

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
use yii\web\Request;
 

class MwsproviderController extends Controller
{
    
   
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

 /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionMwsprovider()
    {  
        $request = Yii::$app->request;
        $username = $request->get('username');
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
