<?php  

class Blog Extends Application
{
	// set status
	//public $status = 'off';
	
	function __construct()
	{
		$this->model('blog');
		$this->library('sessions');
		$this->helper('active');
	}
	
	function index()
	{

		$data['posts'] = $this->model->blog->getPosts();
		
		$this->view('blog/header');
		
		$this->active->menu($this->sessions->get('uid'),$this);
		
		$this->view('blog/blog-menu');		
		if (!is_get('id')) {	
			
			$data['post'] = $this->model->blog->getLastPost();
			$data['post']['content'] = str_replace( "\n" , "<br/>" , $data['post']['content']);
			$this->view('blog/index',$data);

		}
		
		if (is_get('id')) {
			
			$data['post'] = $this->model->blog->getPost($_GET['id']);
			$data['post']['content'] = str_replace( "\n" , "<br/>" , $data['post']['content']);

			$this->view('blog/index',$data);
		}
		$this->view('blog/footer');
	}
	
	function tag(){
		
	}
}

?>