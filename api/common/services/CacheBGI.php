<?php

namespace api\common\services;
use Yii;

class CacheBGI{
    

    public function __construct()
    {
        
    }

    /** 
     * store data in cache
     */
    public function store($key, $value, $duration=0, $query=null, $file=null){
        $cache = Yii::$app->cache;
        if($key && $value){
            if($query){
                $dependency = new \yii\caching\DbDependency(['sql' => $query]);
            } else if($file){
                $dependency = new \yii\caching\FileDependency(['fileName' => $file]);
            }

            if($dependency){
                $cache->set($key, $value, $duration, $dependency);
            } else {
                $cache->set($key, $value, $duration);
            }
           
        }
    }

    /** 
     * retrive data from cache
     */
    public function retreive($key){
        
        
        $cache = Yii::$app->cache;
        $res = '';
        if($key){
            $res = $cache->get($key);
        }
        return $res;
    }

    /** 
     * delete key
     */
    public function delete($key=null){
        $cache = Yii::$app->cache;
        if($key){
            return $cache->delete($key);
        } 
    }

     /** 
     * Flush key
     */
    public function flush(){
        $cache = Yii::$app->cache;
        return $cache->flush();
    }
}