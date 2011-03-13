<?php  

class Mentions Extends Application
{
	function __construct()
	{
		$this->library('sessions');
		$this->helper('active');
	}

	function index(){
		$this->view('users/header');
		$this->model('comments');
		$data['mentions'] = $this->model->comments->listCommentsByMentions($this->sessions->get('uid'));
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->view('users/mentions-list',$data);
		$this->view('site/footer');
	}
}
?>