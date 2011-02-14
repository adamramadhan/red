<?php  

class Blog Extends Application
{
	// set status
	//public $status = 'off';
	
	function index()
	{
		# get the blog model
		$this->model('blog');
		$this->library('sessions');
		$data['posts'] = $this->model->blog->getPosts();
		
		$this->view('blog/header');
		
		if (!$this->sessions->get('uid')) {
			$this->view('site/menu');
		}
		
		if ($this->sessions->get('uid')) {
			$this->view('users/menu-active');
		}	
		
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