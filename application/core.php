<?php  

class Core Extends Application
{
	#default page
	function index(){
		$this->view('core/index');
	}
	
	#404 error
	function missing(){
		$this->view('site/header');
		$this->view('site/menu');
		$this->view('site/404');
		$this->view('site/footer');
	}
	
	#503 on development
	function off(){
		$this->view('core/503');
	}
}


?>