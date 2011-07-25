<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );

/**
 * DONOTEDIT, Router Class
 * @version 100.20/3/2011
 * @package ENGINE/CORE
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 */
class Router {
	# url utamanya
	protected $url;
	# rute regex di routes.php
	private $routes;
	# class dan methodnya
	private $controller;
	# segments url ke parameter
	private $params;
	
	/**
	 * @todo split from construct
	 */
	function __construct() {
		# fix untuk (?) jadi bisa terima get
		$this->url = parse_url ( str_replace ( config ( 'folder' ), NULL, $_SERVER ['REQUEST_URI'] ), PHP_URL_PATH );
		$segments = explode ( '/', $this->url );
		
		# membuat array pertama [0] hilang
		array_shift ( $segments );
		
		# FAQS ROUTEING 1
		require 'routes.php';
		
		# jika tidak ada controller dan method
		# @todo pake if empty juga bisa coba di riset(line 23)
		if ($segments [0] == '') {
			$this->controller = $routes ['default'];
		}
		
		// get the clean url eg: /url1/url2 from www.link.com/url1/url2
		$uri = implode ( '/', $segments );
		#var_dump($uri);die();
		#execute and search regex routeing from routes.php
		foreach ( $routes as $regex => $request ) {
			if (preg_match ( '#^' . $regex . '$#', $uri )) {
				
				# kalo ada url untuk diproses dan regex sama dengan segment (url)
				if (isset ( $this->url )) {
					$this->controller = $request;
				}
				
				#cari tanda $ dan mengubahnya jadi backref dari regex ($back)
				if (strpos ( $request, '$' ) !== FALSE and strpos ( $regex, '(' ) !== FALSE) {
					$controller = preg_replace ( '#^' . $regex . '$#', $request, $this->url );
					$this->controller = $controller;
				}
			}
		}
		
		#jika tidak ada di route maka 404
		if (! isset ( $this->controller )) {
			$this->controller = $routes['404'];
			//redirect ( '/404' );
		}

		#dispatch the routes
		$hello = explode ( ':', $this->controller );
		$path = "application/" . $hello ['0'] . ".php";
		
		#var_dump($path);
		#cek ada tidak filenya dan dapat dibaca ( permision )
		if (file_exists ( $path ) && is_readable ( $path )) {
			
			#seharusnya periksa error kalo classnya bermasalah yang diload
			require_once $path;
			
			#get the class and the method of the controller
			$controller = explode ( ':', $this->controller );
			
			$this->params = $segments;
			// get the class of the params, so we can get the real param wiothout the class.
			$this->params = array_diff ( $this->params, array ($controller [0] ) );
			
			$class = ucfirst ( $controller [0] );
			$method = strtolower ( $controller [1] );
			
			#below is the calling class part 
			$controller = new $class ();
			#$controller->parameters = $this->params;
			

			# masukan semua segments kedalam params
			//var_dump($segments);
			#the magic happens, php 5.3.0 + need optimize see php docs
			if (is_callable ( array ($controller, $method ) )) {
				# http://stackoverflow.com/questions/5369099/call-user-func-array-vs-controller-methodparams/5369108#5369108
				call_user_func_array ( array ($controller, $method ), $this->params );
			}
		
		#$controller->$method($this->params);
		#diatas ini adalah proses pemanggilan kelas
		}
	}
}
?>