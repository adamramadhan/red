<?php  

class Router
{
	# url utamanya
	protected $url;
	# rute regex di routes.php
	private $routes;
	# class dan methodnya
	private $controller;
	# segments url ke parameter
	private $params;
	
	function __construct()
	{
		$this->url = str_replace(config('folder'), NULL, $_SERVER['REQUEST_URI']);

		# fix untuk (?) jadi bisa terima get
		$this->url = parse_url($this->url, PHP_URL_PATH);
		$segments = explode('/',$this->url);

		# membuat array pertama [0] hilang
		array_shift($segments);
		
		# FAQS ROUTEING 1
		require 'routes.php';

		# jika tidak ada controller dan method
		# @todo pake if empty juga bisa coba di riset(line 23)
		if ($segments[0] == '') {
			$this->controller = $routes['default'];
		}
		
		// get the clean url eg: /url1/url2 from www.link.com/url1/url2
		$uri = implode('/', $segments);
		//var_dump($uri);
		#execute and search regex routeing from routes.php
		foreach ($routes as $regex => $request) {

			if (preg_match('#^'.$regex.'$#', $uri)){
				
				# kalo ada url untuk diproses dan regex sama dengan segment (url)
				if (isset($this->url)) {
					$this->controller = $request;
				}
				
				#cari tanda $ dan mengubahnya jadi backref dari regex ($back)
				if (strpos($request, '$') !== FALSE AND strpos($regex, '(') !== FALSE)
				{
					$this->controller = preg_replace('#^'.$regex.'$#', $request, $this->url);
				}
			}
		}
		
		#jika tidak ada di route maka 404
		if (!isset($this->controller)) {
			$this->controller = $routes['404'];
		}
		
		#dispatch the routes
		$hello = explode(':',$this->controller);
		$path = "application/".$hello['0'].".php";

		#var_dump($path);
		#cek ada tidak filenya dan dapat dibaca ( permision )
		if (file_exists($path) && is_readable($path)) {
			
			#seharusnya periksa error kalo classnya bermasalah yang diload
			require_once $path;
			
			#get the class and the method of the controller
			$controller = explode(':',$this->controller);
			$class = ucfirst($controller[0]);
			$method = strtolower($controller[1]);
			
			#below is the calling class part 
			$controller = new $class;
			#$controller->parameters = $this->params;

			# masukan semua segments kedalam params
			//var_dump($segments);
			$this->params = $segments;
			
			#the magic happens, php 5.3.0 + need optimize see php docs
			if (is_callable(array($controller,$method))) {
				call_user_func_array(array($controller, $method), $this->params);
			}
			#diatas ini adalah proses pemanggilan kelas
		}
	}
	
	function setRoutes(){
		
	}
}
?>