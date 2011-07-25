<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
/**
 * gets the config so we can inject it on anywhere who need it.
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $string
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
function config($string) {
	require 'configuration.php';
	$keys = explode ( '/', $string );
	foreach ( $keys as $key ) {
		$config = $config [$key];
	}
	return $config;
}

/**
 * return bool if there is any post
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $string
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
function is_post($name) {
	return (isset ( $_POST [$name] )) ? true : false;
}

/**
 * return bool if there is any post
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $name
 * @param string $value
 * @author rama@networks.co.id
 * @tutorial wiki/docs/functions/global/is_get.txt
 */
function is_get($name, $value = NULL) {
	if (! is_null ( $value )) {
		if (isset ( $_GET [$name] )) {
			return ($_GET [$name] == $value) ? true : false;
		} else {
			return false;
		}
	}
	if (is_null ( $value )) {
		$value = NULL;
		return (isset ( $_GET [$name] )) ? true : false;
	}
}

function is_ajax( $request = 'xmlhttprequest' ){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == $request ) {
		return TRUE;
	} else {
		return FALSE;
	}
}

/**
 * return bool if a string exists in routes.php
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $string
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
function is_routes($string) {
	require 'routes.php';
	if (in_array ( $string, array_keys ( $routes ) )) {
		return true;
	} else {
		return false;
	}
}

/**
 * return translate
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $language
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
function l($language) {
	require 'libraries/language/' . config ( 'language' ) . '.php';
	return $l [$language];
}

/**
 * return redirect to a location useing header, then exit
 * @version 100.20/3/2011
 * @package ENGINE/BOOTSTRAP
 * @param string $link
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 * @todo status codes
 */
function redirect($link, $replace = TRUE, $status = 302) {
	header ( 'Location: ' . $link, $replace, $status );
	exit ( $link );
}

?>