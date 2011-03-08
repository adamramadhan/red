<?php  

class Core Extends Application
{
	#default page
	function index(){
		$this->view('core/index');
	}
	
	#404 error
	function missing(){
		#fast cgi header("Status: 404 Not Found");
		header("HTTP/1.0 404 Not Found");
		$this->library('sessions');
		$this->helper('active');
		$this->view('site/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->view('site/404');
		$this->view('site/footer');
	}
	
	#503 on development
	function off(){
		$this->view('core/503');
	}
}


?>