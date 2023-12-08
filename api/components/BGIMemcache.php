<?php
namespace api\components;

use Yii;

final class BGIMemcache{
    const MEMCACHE_CLASS_NAME = 'Memcache';
    
    protected $memcache;
    protected $cacheExpiry;
    protected static $instance = '';
    
    protected function __construct() {
        if(class_exists(BGIMemcache::MEMCACHE_CLASS_NAME)){
            $this->memcache = new \Memcache();
            $host = Yii::$app->params['memcache_config']['MEMCACHE_HOST'];
            $port = Yii::$app->params['memcache_config']['MEMCACHE_PORT'];
            $this->cacheExpiry = Yii::$app->params['memcache_config']['MEMCACHE_KEY_EXPIRY'];
            $this->memcache->addserver($host, $port);
        }else{
            return '';
        }
    }
    protected function __destruct() {
        
    }
    public static function getMemcacheInstance(){
       if(class_exists(BGIMemcache::MEMCACHE_CLASS_NAME)){
        if(!(self::$instance instanceof self)){
            self::$instance = new self();
        }
       }
       return self::$instance;
       
    }
    public function storeValueInCache($key,$value,$deleteFlag=false){
        $dataAvailInCache = '';
        if(!$deleteFlag){
            $dataAvailInCache = $this->fetchValueFromCache($key);
        }
        if($dataAvailInCache=='' || empty($dataAvailInCache)){
            $this->deleteKeyInCache($key);
            if($this->memcache->set($key,$value,0,$this->cacheExpiry)){
                $dataAvailInCache = $this->fetchValueFromCache($key);
            }
        }
        return $dataAvailInCache;
    }
    public function fetchValueFromCache($key){
        if($key != ''){
            $fetchdata = $this->memcache->get($key);
            if(!empty($fetchdata)){
                 return json_decode($fetchdata,true);
            }
        }
    }
    public function flushCache(){
       return $this->memcache->flush();
    }
    public function deleteKeyInCache($key){
        $this->memcache->delete($key);
    }
    public function showStats(){
        $memcacheStats = $this->memcache->getstats();
        return json_encode($memcacheStats);
    }
}


