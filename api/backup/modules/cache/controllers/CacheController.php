<?php

namespace api\modules\cache\controllers;

use Yii;
use api\modules\cache\controllers\MasterController;
use yii\web\Response;
use api\common\services\CacheBGI;
use Exception;

/**
 * Cache controller for the cache
 */
class CacheController extends MasterController
{
    public $modelClass = '';
    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
    }
    
     /** 
     * flush 
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionFlush($key=null){
        $msg = 'Unable to clear cache';
        $cache = new CacheBGI();
        try{
            if($key) {
                $res = $cache->delete($key);
                 
            } else {
                $res = $cache->flush();
            }
            if($res){
                $msg = 'Cache cleared successfully.';
            }
           
        } catch(Exception $e){
            throw $e;
        }
        echo $msg;
        exit;
    }

}