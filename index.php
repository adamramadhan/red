<?php 
# CORE CONFIGURATION 
define('DS', '/');
define('STORAGE', realpath(dirname(__FILE__).'/www-static/storage'));

require_once 'libraries/core.bootstrap.php';

if (config('development')) {
	$start = microtime(true);
	$startmemory = xdebug_memory_usage()/1024/1024;
}


require_once 'libraries/core.router.php';
require_once 'libraries/core.models.php';
require_once 'libraries/core.application.php';
$test = new Router;

if (config('development')) {
	$endmemory = xdebug_memory_usage()/1024/1024;
	$end = microtime(true);
	var_dump($end-$start.' S');
	var_dump($endmemory - $startmemory.' MB');
}
?>