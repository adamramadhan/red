<?php  
/**
 * function config
 * gets the config so we can inject it on anywhere who need it.
 * @param string $string 
 * @return void, configuration ( array or string )
 * @author DAMS
 * config()
 * @todo kalo dijadiin global aja gimana?
 */
function config( $string ){
    require 'configuration.php';
    $keys = explode('/',$string);
    foreach($keys as $key){
        $config = $config[$key];
    }
    return $config;
}


/**
 * IS_POST()
 * ---------
 * this function is geting the if post exist true : false
 * @param	string	name of the post
 * @access global
 * @return boolean
 */ 
function is_post( $name )
{
	return (isset($_POST[$name])) ? true : false;
}

/**
 * IS_GET()
 * --------
 * this function is geting the if get exist true : false
 * @param	string	name of the get
 * @param	string	value of the get
 * @access global
 * @return boolean
 * @useage if ( is_get( 'at', NULL ) ) { echo "there is no $_GET['at'] here"; }
 */ 
function is_get( $name, $value = NULL )
{
	if (!is_null($value)) {
		if (isset($_GET[$name])) {
			return ($_GET[$name] == $value) ? true : false;
		} else {
			return false;
		}
	}
	if (is_null($value)) {
		$value = NULL;
		return (isset($_GET[$name])) ? true : false;
	}
}

function is_routes($string){
	require 'routes.php';
	if (in_array($string,array_keys($routes))) {
		return true;
	} else {
		return false;
	}
}

function l($language){
	require 'libraries/language/'. config('language') .'.php';
	return $l[$language];
}

function redirect($link) 
{ 
    header('Location: ' . $link);
    exit($link);
}
?>