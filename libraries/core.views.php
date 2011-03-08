<?php  
/**
* views tempatnya function2 views 
*/
class Views
{
	function __construct()
	{
		
	}

	public function ActiveCSS(){
          $url = $_SERVER["REQUEST_URI"];
          $class = str_replace('/','-',$url);
 		  $class = substr($class, 1);
          echo $class;
	}

	public function getIMG( $img )
	{
		if ( ! file_exists( "www-static". DS ."assets". DS ."images". DS . $img ) ) {
			throw new Exception( "No such img as $img" );
		}
		
		// epic fix / kalo dihapus jadinya ya cacat
		$img = "/www-static". DS ."assets". DS ."images". DS . $img;
		echo '<img src="' . $img . '" />';
	}
	
	public function getStorage( $uid, $img )
	{
		
		#var_dump("www-static". DS ."storage". DS . $uid . DS . $img);
		if ( ! file_exists( "www-static". DS ."storage". DS . $uid . DS . $img ) ) {
			throw new Exception( "No such img as $img" );
		}
		// epic fix / kalo dihapus jadinya ya cacat
		$img = "/www-static". DS ."storage". DS . $uid . DS . $img;
		echo '<img src="' . $img . '" />';		
	}

	public function CSS(){
		
		if ( config('compress') ) {
			// See @ref #1
			ob_start(array($this,'compressorCSS'));
		}

		$file = func_get_args();
		echo "<style type='text/css'>";
		foreach ( $file as $css ) {
			
			if ( config('development') ) {
				
				if ( ! file_exists( "www-static". DS ."assets". DS ."css". DS . $css .".css" ) ) {
					throw new Exception( "No such file as $css.css" );
				}
			}
			
			require_once  "www-static". DS ."assets". DS ."css". DS . $css .".css";
		}
		echo "</style>";
		
		if ( config('compress') ) {
			ob_end_flush();
		}		
	}

	public function JS()
	{
		
		if ( config('compress') ) {
			// See @ref #1
			ob_start(array($this,'compressorJS'));
		}

		$file = func_get_args();
		echo "<script type='text/javascript'>";
		foreach ( $file as $js ) {

		if ( config('development') ) {
			
			if ( ! file_exists( "www-static". DS ."assets". DS ."js". DS . $js .".js" ) ) {
				throw new Exception( "No such file as $js.js" );
			}
		}	
		
		require_once  "www-static". DS ."assets". DS ."js". DS . $js .".js";
		}
		
		echo "</script>";
		
		if ( config('compress') ) {
			    ob_end_flush();
		}
	}
	
	#compressor CSS
	public function compressorCSS( $buffer )
	{
  		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
  		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  		return $buffer;
	}
	
	#compressorJS
	public function compressorJS( $buffer )
	{
  		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  		return $buffer;
	}	

	public function href($link,$language)
	{
		echo "<a href='$link'>$language</a>";
	}
}


?>