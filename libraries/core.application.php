<?php  

class Application
{
	protected function model($model)
	{
		$path = "application". DS ."models". DS . $model .".php";
		require $path;
		
		$class = 'Model'. ucfirst($model);

		#fix so we can place it at $this-{model}->modelname
		if( !isset($this->model) || !is_object($this->model) ) {
		    $this->model = new StdClass;
		}
		
		$this->model->$model = new $class;
	}
	
	protected function view($view, $data = NULL)
	{
		require_once 'libraries/core.views.php';
		$views = new Views;
		if ( config('compress') ) {
			// See @ref #1
			ob_start(array($this,'compressor'));
			/*ob_start("ob_gzhandler");*/
		}
		
		#renders the data into view vars
		if (isset($data)) {
	        foreach ( $data as $name => $val ) {
	            $$name = $val;
	        }
		}
		
		#require 'libraries/language/'. config('language') .'.php';
		
		$path = "application". DS ."views". DS . $view .".php";
		require $path;
		return TRUE;
		
		if ( config('compress') ) {
			while (ob_get_level() > 0) {
			    ob_end_flush();
			}
		}	
	}
	
	protected function library( $lib ){
		
		if (file_exists('libraries/lib.'. $lib .'.php')) {
			
			#kemunkinan disini kalo ada dua class sama akan error
			require 'libraries/lib.'. $lib .'.php';
			$class = ucfirst($lib);
			
			#memastikan jika tidak ada property yang sama
			if (class_exists($class) && !property_exists($this,$lib)) {
				$this->$lib = new $class;
				return TRUE;
			}
		}
	}

	protected function helper( $help ){
		
		if (file_exists('libraries/helpers/help.'. $help .'.php')) {
			#kemunkinan disini kalo ada dua class sama akan error
			require 'libraries/helpers/help.'. $help .'.php';
			$class = ucfirst($help);

			#memastikan jika tidak ada property yang sama
			if (class_exists($class) && !property_exists($this,$help)) {
				$this->$help = new $class;
				return TRUE;
			}
		}
	}

	public function compressor( $buffer )
	{
	    $search = array(
	        '/<!--(.|\s)*?-->/',
	        '/\>[^\S ]+/s',
	        '/[^\S ]+\</s'
	    );
	    $replace = array(
	        '',
	        '>',
	        '<'
	    );
	    
	    $buffer = preg_replace($search, $replace, $buffer);
	    return $buffer;
	}
	
	protected function CSS(){
		
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
	
	public function compressorCSS( $buffer )
	{
  		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
  		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  		return $buffer;
	}


	protected function JS()
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
	
	public function compressorJS( $buffer )
	{
  		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  		return $buffer;
	}	
			
	protected function href($link,$language)
	{
		echo "<a href='$link'>$language</a>";
	}
	
	#singleton check yes
	protected function middleware($vendor,$package)
	{
		if (file_exists('middleware'. DS . $vendor . DS . $package .'.php')) {
			
			#kemunkinan disini kalo ada dua class sama akan error
			require 'middleware'. DS . $vendor . DS . $package .'.php';
			$class = ucfirst($package);
			
			#memastikan tidak ada property yang sama
			if (class_exists($package) && !property_exists($this,$package)) {
				$this->$package = new $package;
				return TRUE;
			}
		}
	}
}


?>