<?php
define('SAE_MEMCACHE_ENABLE', 0);
// MYSQL config
if ( SAE_MEMCACHE_ENABLE ){ // For SAE platform.
    //define('MYSQL_HOST', '127.0.0.1');
    define('MYSQL_HOST', SAE_MYSQL_HOST_M);
    define('MYSQL_HOST_S', SAE_MYSQL_HOST_S);
    define('MYSQL_USER', SAE_MYSQL_USER);
    define('MYSQL_PASSWORD', SAE_MYSQL_PASS);
    define('MYSQL_DBNAME', SAE_MYSQL_DB);
    define('MYSQL_PORT',  SAE_MYSQL_PORT);
} else { // Develope env.
//    define('MYSQL_HOST', '192.168.1.190');
    define('MYSQL_HOST', '127.0.0.1');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', 'root');
    define('MYSQL_DBNAME', 'youxi');
    define('MYSQL_PORT',  3306);
    define('LOG_PATH', 'C:/nglogs/');
}
define('LOG_PATH', 'C:/nglogs/');

// define PHP params in $REQUEST map.
$params = array_merge($_GET, $_POST);
foreach ($params as $key=>$value){
    $$key = $value;
}
