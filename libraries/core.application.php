<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );

/**
 * DONOTEDIT, extend olny at /application
 * @version 100.20/3/2011
 * @package ENGINE/CORE
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
class Application {
	
	/**
	 * Dependency injectors and Class init
	 * + its a place where we could include
	 * global application properties or etc
	 */
	function __construct() {
		if (config ( 'features/memcached' )) {
			$this->cache = new Cache ();
		}
	}
	
	/**
	 * loads a model in application
	 * @param string $model
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	protected function model($model) {
		$path = "application" . DS . "models" . DS . $model . ".php";
		require $path;
		
		$class = 'Model' . ucfirst ( $model );
		
		#fix so we can place it at $this-{model}->modelname
		if (! isset ( $this->model ) || ! is_object ( $this->model )) {
			$this->model = new StdClass ();
		}
		
		$this->model->$model = new $class ();
	}
	
	/**
	 * loads a view in application
	 * @param string $model
	 * @param array $data
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	protected function view($view, $data = NULL) {
		require_once 'libraries/core.views.php';
		$views = new Views ();
		if (config ( 'features/compress/core' )) {
			
			/* See @ref #1 
			we are useing compressor just becouse ob_gzhandler dont support UTF-8 at the
			header, see http://php.net/manual/en/function.ob-start.php#91963
			*/
			ob_start ( array ($this, 'compressor' ) );
		
		#ob_start("ob_gzhandler");
		}
		
		#renders the data into view vars
		if (isset ( $data )) {
			foreach ( $data as $name => $val ) {
				$$name = $val;
			}
		}
		
		$path = "application" . DS . "views" . DS . $view . ".php";
		require $path;
		return TRUE;
		
		if (config ( 'features/compress/core' )) {
			ob_end_flush ();
		}
	}
	
	/**
	 * loads a library in application
	 * @param string $lib
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	protected function library($lib) {
		
		if (file_exists ( 'libraries/lib.' . $lib . '.php' )) {
			
			#kemunkinan disini kalo ada dua class sama akan error
			require 'libraries/lib.' . $lib . '.php';
			$class = ucfirst ( $lib );
			
			#memastikan jika tidak ada property yang sama
			if (class_exists ( $class ) && ! property_exists ( $this, $lib )) {
				$this->$lib = new $class ();
				return TRUE;
			}
		}
	}
	
	/**
	 * loads a helper in application
	 * @param string $help
	 * @todo kalo ada 2 helper gimana? satu di header satu di footer, coba riset.
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	protected function helper($help, $setup = array()) {

		if (file_exists ( 'libraries/helpers/help.' . $help . '.php' )) {
			#kemunkinan disini kalo ada dua class sama akan error
			require 'libraries/helpers/help.' . $help . '.php';
			$class = ucfirst ( $help );
			#memastikan jika tidak ada property yang sama
			if (class_exists ( $class ) && ! property_exists ( $this, $help )) {
				$this->$help = new $class ( );
				return TRUE;
			}
		}
	}
	
	/**
	 * main compressor for application buffer
	 * @param string $buffer
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 * @todo we need to strip lines without effecting /n ( example when editing happens )
	 */
	public function compressor($buffer) {
		$search = array ('/<!--(.|\s)*?-->/' ); //strip html comments
		# another search
		

		$replace = array ('' );
		# another replace
		

		$buffer = preg_replace ( $search, $replace, $buffer );
		$buffer = trim ( $buffer );
		# https://github.com/tylerhall/html-compressor/blob/master/html-compressor.php#L138
		$buffer = str_replace ( ">\n<", '><', $buffer );
		# gak bisa dipake karena blm full to p
		#$buffer = preg_replace('/\s\s+/', ' ', $buffer);
		return $buffer;
	}
		
	/**
	 * loads a middleware in application
	 * @param string $vendor
	 * @param string $package
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 * @todo check the singleton checker line #160
	 */
	protected function middleware($vendor, $package) {
		if (file_exists ( 'middleware' . DS . $vendor . DS . $package . '.php' )) {
			
			#kemunkinan disini kalo ada dua class sama akan error
			require 'middleware' . DS . $vendor . DS . $package . '.php';
			$class = ucfirst ( $package );
			
			#memastikan tidak ada property yang sama
			if (class_exists ( $package ) && ! property_exists ( $this, $package )) {
				$this->$package = new $package ();
				return TRUE;
			}
		}
	}
}
?>