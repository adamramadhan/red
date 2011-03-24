<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );

/**
 * DONOTEDIT, extend olny at /application/views
 * @version 100.20/3/2011
 * @package ENGINE/CORE
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
class Views {
	final function __construct() {
		# cant change construct
	}
	
	/**
	 * place a string for class css in views
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function ActiveCSS() {
		$url = $_SERVER ["REQUEST_URI"];
		$url = htmlspecialchars ( $url );
		$class = str_replace ( '/', '-', $url );
		$class = substr ( $class, 1 );
		
		$vowels = array ("@", "?" );
		$pieces['request'] = str_replace ( $vowels, "", $class );
		if (empty($pieces['request'])) {
			$pieces['request'] = 'home';
		}
		
		$pieces['version'] = 'v1';
		$activecss = implode (' ', $pieces );
		echo $activecss;
	}
	
	/**
	 * echos a <img> from www-static/assets/images
	 * @param string $img
	 * @param array $options
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function getIMG($img, $options = NULL) {
		if (! file_exists ( "www-static" . DS . "assets" . DS . "images" . DS . $img )) {
			throw new Exception ( "No such img as $img" );
		}
		
		// epic fix / kalo dihapus jadinya ya cacat
		$img = "/www-static" . DS . "assets" . DS . "images" . DS . $img;
		echo '<img ' . $options . ' src="' . $img . '" />';
	}
	
	/**
	 * echos a <img> from www-static/storage/$uid/$img
	 * @param int $uid
	 * @param string $img
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function getStorage($uid, $img) {
		
		#var_dump("www-static". DS ."storage". DS . $uid . DS . $img);
		if (! file_exists ( "www-static" . DS . "storage" . DS . $uid . DS . $img )) {
			throw new Exception ( "No such img as $img" );
		}
		// epic fix / kalo dihapus jadinya ya cacat
		$img = "/www-static" . DS . "storage" . DS . $uid . DS . $img;
		echo '<img src="' . $img . '" />';
	}
	
	/**
	 * echos a inline css style
	 * @param args $views->css('css1','css2','etc');
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function CSS() {
		if (config ( 'compress' )) {
			// See @ref #1
			ob_start ( array ($this, 'compressorCSS' ) );
		}
		
		$file = func_get_args ();
		echo "<style type='text/css'>";
		foreach ( $file as $css ) {
			
			if (config ( 'development' )) {
				
				if (! file_exists ( "www-static" . DS . "assets" . DS . "css" . DS . $css . ".css" )) {
					throw new Exception ( "No such file as $css.css" );
				}
			}
			
			require_once "www-static" . DS . "assets" . DS . "css" . DS . $css . ".css";
		}
		echo "</style>";
		
		if (config ( 'compress' )) {
			ob_end_flush ();
		}
	}
	
	/**
	 * echos a inline css style
	 * @param args $views->css('css1','css2','etc');
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function JS() {
		
		if (config ( 'compress' )) {
			// See @ref #1
			ob_start ( array ($this, 'compressorJS' ) );
		}
		
		$file = func_get_args ();
		echo "<script type='text/javascript'>";
		foreach ( $file as $js ) {
			
			if (config ( 'development' )) {
				
				if (! file_exists ( "www-static" . DS . "assets" . DS . "js" . DS . $js . ".js" )) {
					throw new Exception ( "No such file as $js.js" );
				}
			}
			
			require_once "www-static" . DS . "assets" . DS . "js" . DS . $js . ".js";
		}
		
		echo "</script>";
		
		if (config ( 'compress' )) {
			ob_end_flush ();
		}
	}
	
	/**
	 * main compressor for CSS buffer
	 * @param string $buffer
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function compressorCSS($buffer) {
		$buffer = preg_replace ( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
		$buffer = str_replace ( array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );
		return $buffer;
	}
	
	/**
	 * main compressor for JS buffer
	 * @param string $buffer
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function compressorJS($buffer) {
		$buffer = str_replace ( array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );
		return $buffer;
	}
	
	/**
	 * echos a <a> for href or linking
	 * @param string $link
	 * @param string $language
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function href($link, $language) {
		echo "<a href='$link'>$language</a>";
	}
}

?>