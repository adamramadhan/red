<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
/**
 * UTILITY LIBS
 * Class where we putin the unsort library of functions
 * if the function is done to be put somewhere then 
 * move it from here, but before that, must put here.
 *
 * @package default
 * @author DAMS
 */
class Utility {
	public function UrltoString($string, $max_length = NULL) {
		$string = html_entity_decode ( $string, ENT_QUOTES, 'UTF-8' );
		$string = strtolower ( trim ( $string ) );
		$string = str_replace ( "'", '', $string );
		$string = preg_replace ( '#[^a-z0-9\-]+#', '_', $string );
		$string = preg_replace ( '#_{2,}#', '_', $string );
		$string = preg_replace ( '#_-_#', '-', $string );
		$string = preg_replace ( '#(^_+|_+$)#D', '', $string );
		
		$length = strlen ( $string );
		if ($max_length && $length > $max_length) {
			$last_pos = strrpos ( $string, '_', ($length - $max_length - 1) * - 1 );
			if ($last_pos < ceil ( $max_length / 2 )) {
				$last_pos = $max_length;
			}
			$string = substr ( $string, 0, $last_pos );
		}
		
		return $string;
	}
}

?>