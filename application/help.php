<?php  

class Help Extends Application
{
	function __construct()
	{
		$this->library('sessions');
	}	
	
	function index(){
		if (!$this->sessions->get('uid')) {
			$this->view('site/header');
			$this->view('site/menu');
			$this->view('site/help');
			$this->view('site/footer');					
		}

		if ($this->sessions->get('uid')) {
			$this->library('validation');
			$this->helper('forms');
			$this->view('users/header');
			$this->view('users/menu-active');
			$this->view('users/helpcenter');
			$this->view('site/footer');					
		}
	}
}


?>