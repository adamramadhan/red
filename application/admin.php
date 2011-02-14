<?php  

class Admin Extends Application
{
	# put global things here
	function __construct(){
		$this->library('sessions');
		$this->model('users');
		$data = $this->model->users->getData($this->sessions->get('uid'));
		
		# checs uid 2
		if ( $data['role'] != 5) {
			redirect('/404');
			die();
		};
	}
	
	#default page
	function index(){
		# unvefieid users
		$this->view('admin/header');
			if (!$this->sessions->get('uid')) {
				$this->view('site/menu');
			}
			
			if ($this->sessions->get('uid')) {
				$this->view('users/menu-active');
			}
		
		# args2
		if (!isset($args2)) {
			$data['users'] = $this->model->users->getRole('0',10);
			$this->view('admin/index',$data);
		}
		
		$this->view('site/footer');
	}
	
	function blog(){
		$this->model('blog');
		
		# unvefieid users
		$this->view('admin/header');
			if (!$this->sessions->get('uid')) {
				$this->view('site/menu');
			}
			
			if ($this->sessions->get('uid')) {
				$this->view('users/menu-active');
			}
		
		$data['posts'] = $this->model->blog->getPosts();
		
			# delete the post
			if (is_get('d')) {
				$this->model->blog->delPost($_GET['d']);
				redirect('/admin/blog');
			}
			
			# see the post
			if (is_get('n')) {
				$data['post'] = $this->model->blog->getPost($_GET['n']);
				$data['post']['content'] = str_replace( "\n" , "<br/>" , $data['post']['content']);
				$this->view('admin/blogview',$data);
			}

			# see the post
			if (is_get('e')) {
				$this->library('validation');
				$data['post'] = $this->model->blog->getPost($_GET['e']);
				$this->view('admin/blogedit',$data);
				
				if (is_post('editpost')) {
					# strip all code for security
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
					$this->validation->required($n['tag'],'Taq jangan lupa diisi.');
					
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
			if (!$this->sessions->get('uid')) {
				$this->view('site/menu');
			}
			
			if ($this->sessions->get('uid')) {
				$this->view('users/menu-active');
			}
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