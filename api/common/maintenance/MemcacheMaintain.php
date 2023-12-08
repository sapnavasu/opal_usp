<?php

namespace api\common\maintenance;
use Yii;
use yii\caching\MemCache;

class MemcacheMaintain extends MemCache {
    
    public $_cache;
   
    /** 
     * override setvalue function of memcache
     */
    public function setValue($key, $value, $duration)
    {
        $this->_cache = parent::getMemcache();
        $expire = $duration;
        if($this->useMemcached){
            $expire = $duration > 0 ? $duration + time() : 0;
        } 
        return $this->useMemcached ? $this->_cache->set($key, $value, $expire) : $this->_cache->set($key, $value, 0, $expire);
    }

}