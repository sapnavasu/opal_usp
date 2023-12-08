<?php
namespace api\modules\mst\controllers;

use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use api\common\services\CacheBGI;



class TimezoneController extends MasterController
{
    public $modelClass = 'api\modules\mst\models\Time';

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
    
    public function actionTimezonelist(){
        
        try{
            $cache = new CacheBGI();
            $cacheKey = 'timezone_list';
            $query = \api\modules\mst\models\TimezoneTbl::getTimeZonesListCache();
            if(empty($cache->retreive($cacheKey))){
                $data = \api\modules\mst\models\TimezoneTbl::getTimeZonesList();
                $cache->store($cacheKey, $data, $duration = 0 , $query);
            } else {
                $data = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $data = \api\modules\mst\models\TimezoneTbl::getTimeZonesList();
        } 
      
        return $data;
    }

   
}