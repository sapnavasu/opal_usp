<?php

namespace api\modules\trade\controllers;

use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\ActiveController;
use \common\models\UsermstTblQuery;



class TradeMasterController extends ActiveController
{
    public $SESSION = '';

    public function getTokenData($param = NULL,$bool = false){

        $session = \Yii::$app->session;
        $session->open();
        $headers = Yii::$app->request->getHeaders()->get('Authorization');
        $data = explode(' ',  $headers);
        $token = Yii::$app->jwt->getParser()->parse((string)$data[1]);
        $token->getHeaders(); // Retrieves the token header
        $token->getClaims(); // Retrieves the token claims
        $this->SESSION=$token->getClaim('uid'); // will print "1"
        $this->SESSION = ($bool)?$this->SESSION->$param:$this->SESSION;
        $currentUrl = $_SERVER['HTTP_CURRENTURL'];
        $currentUrl = explode("/",trim($_SERVER['HTTP_CURRENTURL']));
        $currentUrl = json_encode([
            "module" => $currentUrl[1],
            "component" => $currentUrl[2]
        ]);

        $session['v3session']= $this->SESSION;
        @session_start();
        if(Yii::$app->controller->id =='trade')
        {
           // echo "<pre>";print_r($token->getClaim('uid'));die;
            $usermodel=UsermstTblQuery::trackingUser($this->SESSION->UserMst_Pk,$currentUrl);
        }
        return $this->SESSION;

    }
}
