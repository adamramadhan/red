<?php  

class Admin Extends Application
{
	# put global things here
	function __construct(){
		$this->library('sessions');
		$this->model('users');
		$this->helper('active');
		
		$data = $this->model->users->getData($this->sessions->get('uid'));
		
		if ( $data['role'] != 5) {
			redirect('/404');
			die();
		};
	}
	
	function index(){
		$this->view('admin/header');
		
		$this->active->menu($this->sessions->get('uid'),$this);
		
		$data['users'] = $this->model->users->getRole('0',10);
		$this->view('admin/index',$data);
		$this->view('site/footer');
	}
	
	function blog(){
		$this->model('blog');
		
		$this->view('admin/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		# get blog posts
		$data['posts'] = $this->model->blog->getPosts();
		
		# if request delete
		if (is_get('d')) {
			$this->model->blog->delPost($_GET['d']);
			redirect('/admin/blog');
		}
		
		# if request view
		if (is_get('n')) {
			$data['post'] = $this->model->blog->getPost($_GET['n']);
			$data['post']['content'] = str_replace( "\n" , "<br />" , $data['post']['content']);
			$this->view('admin/blogview',$data);
		}

		# if request edit
		if (is_get('e')) {
			$this->library('validation');
			
			$data['post'] = $this->model->blog->getPost($_GET['e']);
			$this->view('admin/blogedit',$data);
			
			if (is_post('editpost')) {
				
				# @todo strip all code for security
				$n['title'] = $_POST['title'];
				$n['content'] = $_POST['content'];
				$n['tag'] = $_POST['tag'];
				$n['nid'] = $_GET['e'];
				$n['uid'] = $this->sessions->get('uid');
				
				# get the time from jakarta
				$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
				$n['timecreate'] = $time->format('Y-m-d H:i:s');	
				
				# validateing
				$this->validation->required($n['title'],'Title jangan lupa diisi.');
				$this->validation->required($n['content'],'Berita utama jangan lupa diisi.');
				$this->validation->required($n['tag'],'Tag jangan lupa diisi.');
				
				if (!sizeof($this->validation->errors)) {
					$this->model->blog->editPost($n);
					redirect('/admin/blog');	
				}
			}
		}
			
			# at / with no actions
			if (!is_get('n') && !is_get('d') && !is_get('e')) {
				$this->view('admin/blog',$data);
			}
			
			$this->view('site/footer');		
		}
		
		function newpost(){
		$this->library('validation');
		# unvefieid users
		$this->view('admin/header');
		$this->active->menu($this->sessions->get('uid'),$this);

			if (is_post('newpost')){
				$this->model('blog');
							
				# strip all code for security
				$n['title'] = $_POST['title'];
				$n['content'] = $_POST['content'];
				$n['tag'] = $_POST['tag'];
				$n['uid'] = $this->sessions->get('uid');
				
				# get the time from jakarta
				$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
				$n['timecreate'] = $time->format('Y-m-d H:i:s');				
				
			# validateing
			$this->validation->required($n['title'],'Title jangan lupa diisi.');
			$this->validation->required($n['content'],'Berita utama jangan lupa diisi.');
			$this->validation->required($n['tag'],'Taq jangan lupa diisi.');
			
			if (!sizeof($this->validation->errors)) {
				$this->model->blog->setPosts($n);
				redirect('/admin/blog');	
			}
		}
	$this->view('admin/blogadd');
	$this->view('site/footer');	
	}
}

?>