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
		
		# tambahan masih @ujicoba
		$options = getimagesize("www-static" . DS . "storage" . DS . $uid . DS . $img);

		// epic fix / kalo dihapus jadinya ya cacat
		$img = "/www-static" . DS . "storage" . DS . $uid . DS . $img;
		
		echo '<img '.$options[3].' src="' . $img . '" />';
	}
	
	/**
	 * echos a inline css style
	 * @param args $views->css('css1','css2','etc');
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function CSS( $files, $type = NULL ) {

		#sementara
		if (!is_array($files)) {
			$files = func_get_args ();
		}

		# Is it External or Inline ?
		switch ($type) {
			case 'external':
				foreach ($files as $css) {
					if (config ( 'development' )) {
						if (! file_exists ( "www-static" . DS . "assets" . DS . "css" . DS . $css . ".css" )) {
							throw new Exception ( "No such file as $css.css" );
						}
					}
					
					$fullpath =  "/www-static" . DS . "assets" . DS . "css" . DS . $css . ".css";
					echo '<link type="text/css" rel="stylesheet" href="'.$fullpath.'"/>'."\n\t\t";
				}
				break;
			
			default:
				if (config ( 'features/compress/css' )) {
					// See @ref #1
					ob_start ( array ($this, 'compressorCSS' ) );
				}
				
				echo "<style type='text/css'>";
				foreach ( $files as $css ) {
					
					if (config ( 'development' )) {
						if (! file_exists ( "www-static" . DS . "assets" . DS . "css" . DS . $css . ".css" )) {
							throw new Exception ( "No such file as $css.css" );
						}
					}
					
					require_once "www-static" . DS . "assets" . DS . "css" . DS . $css . ".css";
				}
				echo "</style>";
				
				if (config ( 'features/compress/css' )) {
					ob_end_flush ();
				}
			break;
		}
	}
	
	/**
	 * echos a inline css style
	 * @param args $views->css('css1,css2,etc','external or empty');
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function JS( $files, $type = NULL ) {
	
	if (!is_array($files)) {
		# Get the files from the string
		$files = explode(",", $files);
	}
	
	# Is it External or Inline ?
	switch ($type) {
				
		# External = CACHE
		case 'external':
			foreach ($files as $js) {
				if (config ( 'development' )) {
					if (! file_exists ( "www-static" . DS . "assets" . DS . "js" . DS . $js . ".js" )) {
						throw new Exception ( "No such file as $js.js" );
					}
				}
				$fullpath =  "/www-static" . DS . "assets" . DS . "js" . DS . $js . ".js";
				echo '<script type="text/javascript" src="'.$fullpath.'"></script>';
			}
		break;
		
		# Inline = COMPRESS
		default:
			if (config ( 'features/compress/js' )) {
				// See @ref #1
				ob_start ( array ($this, 'compressorJS' ) );
			}
			echo "<script type='text/javascript'>";
			foreach ( $files as $js ) {
				if (config ( 'development' )) {
					if (! file_exists ( "www-static" . DS . "assets" . DS . "js" . DS . $js . ".js" )) {
						throw new Exception ( "No such file as $js.js" );
					}
				}
				require_once "www-static" . DS . "assets" . DS . "js" . DS . $js . ".js";
			}
			echo "</script>";
			
			if (config ( 'features/compress/js' )) {
				ob_end_flush ();
			}
		break;
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
		echo "<a title='$language' href='$link'>$language</a>";
	}
}

?>