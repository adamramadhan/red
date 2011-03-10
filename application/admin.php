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
		$this->helper('forms');
		$this->view('admin/index');
		$this->view('site/footer');
	}

	function listdateunverified(){
		
	}

	function listverified(){
		$this->view('admin/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->helper('forms');
		
		if (is_get('id')) {
			$data['users'] = $this->model->users->getData($_GET['id']);
			$v['uid'] = $_GET['id'];;
			$savepath = STORAGE . DS . $_GET['id'];
			if (unlink($savepath.'/'.$data['users']['seal_image'])) {
				$this->model->users->unverifyUid($v);
				redirect('/admin/unverify');
			}
		}

		$data['users'] = $this->model->users->getRole('1',10);
		$this->view('admin/listverified',$data);
		
		
		$this->view('site/footer');
	}

	function listunverified(){
		$this->view('admin/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->helper('forms');

		if (is_get('id')) {
			
			if (is_post('verified')) {
				
				$this->middleware('verotimage','upload');
				if (!empty($_FILES['image']['size'])) {
				
				# SETUP IMAGE	
				$savepath = STORAGE . DS . $_GET['id'];
				$randomid = md5($_GET['id'].'sealoftrust');
				$this->upload->vupload($_FILES['image']);
				
					if ($this->upload->uploaded) 
					{
				        $this->upload->file_auto_rename   = false;
				        #$this->upload->image_resize       = true;
				        $this->upload->file_overwrite     = true;
				        #pasang max
				        #$this->upload->image_x            = 960; 
				        #$this->upload->image_ratio_y      = true;
				        $this->upload->file_new_name_body = 'information' . $randomid;
				        $this->upload->allowed            = array(
				            'image/*'
				        );	
				        
				        $this->upload->Process($savepath);
				        if ($this->upload->processed) 
				        {
				        	# IMAGE SEAL AND VERIFIED
				        	$v['seal_image'] = $this->upload->file_dst_name;
				        	chmod($savepath.'/'.$v['seal_image'],0644);
				        	$v['uid'] = $_GET['id'];
							$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
							$v['seal_date'] = $time->format('Y-m-d H:i:s');
							$this->model->users->verifiedUid($v);
							redirect('/admin/verify');
				        }		        
		        		$this->upload->clean();
					}
				}			
			}
			
			$this->view('admin/verified');
		}

		if (!is_get('id')) {
			$data['users'] = $this->model->users->getRole('0',10);
			$this->view('admin/listunverified',$data);
		}		
		
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