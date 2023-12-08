<?php
namespace api\components;
use yii\base\Component;
use api\components\Configuration;
use function GuzzleHttp\json_decode;

class Configsession extends Component{

    public function setConfigSession(){
        
    $session = \Yii::$app->session;

    // $session->close();

    // $session->removeAll();

    // $session->destroy();

    session_id("session1");
    
    $session->open();

    $data = Configuration::getjson('Setting');
    $data = json_decode($data,true); 
    
    $cdata = Configuration::getjson('Company');
    $cdata = json_decode($cdata,true) ;

    $session['setting'] = $data;
    $session['company'] = $cdata;


    }
}