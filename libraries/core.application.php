<?php  
class Application
{
	function __construct()
	{
		$this->cache = new Cache;
	}
	
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
			
			/* See @ref #1 
			we are useing compressor just becouse ob_gzhandler dont support UTF-8 at the
			header, see http://php.net/manual/en/function.ob-start.php#91963
			*/
			 ob_start(array($this,'compressor'));
			#ob_start("ob_gzhandler");
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
			ob_end_flush();
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
	    	'/(\s)+/s', // shorten multiple whitespace sequences
	        '/<!--(.|\s)*?-->/', //strip html comments
	        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
	        '/[^\S ]+\</s', //strip whitespaces before tags, except space
	    );
	    $replace = array(
	    	'\\1',
	        '',
	        '>',
	        '<'
	    );
	    
	    $buffer = preg_replace($search, $replace, $buffer);	
	    return $buffer;
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