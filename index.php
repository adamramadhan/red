<?php
# CORE CONFIGURATION 
define ( 'SECURE', TRUE );
define ( 'DS', '/' );
define ( 'STORAGE', realpath ( dirname ( __FILE__ ) . '/www-static/storage' ) );

require_once 'libraries/core.bootstrap.php';

if (config ( 'development' )) {
	ini_set('display_errors', TRUE);
	if (config('features/profileing')) {
		$start = microtime ( true );
		$startmemory = xdebug_memory_usage () / 1024 / 1024;
	}
}

# NAIKIN RAM DIKIT 0.2 MBAN / PAGE
if (config ( 'features/gzip' )) {
	ob_start ( "ob_gzhandler" );
}

require_once 'libraries/core.router.php';
require_once 'libraries/core.models.php';
require_once 'libraries/core.application.php';
if (config ( 'features/memcached' )) {
	require_once 'libraries/core.cache.php';
}

try {
	new Router ();
} catch ( Exception $e ) {
	echo $e;
}

if (config ( 'features/gzip' )) {
	ob_flush ();
}

if (config ( 'development' )) {
	if (config('features/profileing')) {
		$endmemory = xdebug_memory_usage () / 1024 / 1024;
		var_dump ( $endmemory - $startmemory . ' MB' );
		$end = microtime ( true );
		var_dump ( $end - $start . ' S' );
	}
}
?>