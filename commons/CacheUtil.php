<?php
/**
 * CacheUtil <br/>
 * You can choose the specific implementation such as Memcached or Redis
 *
 * @author Nomandia
 */
include_once __DIR__.'/../include/constants.php';

class CacheUtil{
    
    const THRESHOLD = 30000;
    const SAVING = 0.2;

    static $HOSTS = array(
        hosts=> array(
            host=> "127.0.0.1", port=> 11211, weight=> 100)
    );

    private static $intance = null;
    public $cache = null;
    
    function __construct() {
        if ( SAE_MEMCACHE_ENABLE ){ // init memcached with SAE platform
            $this->cache = memcache_init();
        } else {
            $this->cache = new Memcache();
            foreach(self::$HOSTS as $server){
                $this->cache->addserver($server['host'], $server['port'], 1, $server['weight']);
            }
            $this->cache->setcompressthreshold(self::THRESHOLD, self::SAVING);
        }
    }
    
    public static function init(){
        if ( !self::$intance ){
            self::$intance = new CacheUtil();
        }
        return self::$intance;
    }
    
    /**
     * Get object with key
     * @param type $key
     */
    public function get($key){
        return $this->cache->get($key);
    }
     
    /**
     * Set object to table
     * @param string $key
     * @param string $value
     */
    public function set($key, $value, $flag=0, $expired=3600){
        return $this->cache->set($key, $value, $flag, $expired);
    }

    /**
     * delete with key
     * @param string $key
     * @param int $delay delete after seconds
     */
    public function delete($key, $delay=0){
        return $this->cache->delete($key, $delay);
    }

    /**
     * update with key
     * @param string $key
     * @param mixed $value
     * @param int $flag
     * @param int $expired
     */
    public function replace($key, $value, $flag=0, $expired=0){
        return $this->cache->replace($key, $value, $flag, $expired);
    }
    
    /**
     * Flush all
     * @param bool $force Force flush.
     */
    public function flush($force=false){
        return $force && $this->cache->flush();
    }
}
?>
