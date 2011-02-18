<?php  
class Site extends Application
{
	function __construct()
	{
		$this->library('sessions');
		$this->helper('active');
	}
		
	function index()
	{
		# no session = show front page
		if ( !$this->sessions->get('uid')) {
			# init
			$this->library('validation');
			$this->middleware('recaptcha','recaptcha');

			$this->view('site/header');
			$this->active->menu($this->sessions->get('uid'),$this);

			# register, secureing the data
			if (is_post('register')) {
				$this->preregister();
			}
			
			# if have sessions register & secure
			if ( $this->sessions->get('secure.data') && $this->sessions->get('secure.response')) {
				$this->postregister();
			}

			$this->view('site/index-closed');		
			#$this->view('site/index');
			$this->view('site/footer');
		}
		
		# if session = show dashboad
		if ( $this->sessions->get('uid')) {
			
			$this->model('users');
			$data['user'] = $this->model->users->getData($this->sessions->get('uid'));
			$this->view('users/header');
			$this->active->menu($this->sessions->get('uid'),$this);
			$this->view('users/dashboard',$data);
			$this->view('site/footer');
		}
	}
	
	# secureing the data
	function preregister()
	{
		$this->library('security');
		$this->model('users');
		$r['username'] = $_POST['username'];
		$r['password'] = $this->security->redhash512($_POST['password'],$r['username']);
		$r['name'] = $_POST['company'];
		$r['phone'] = $_POST['phone'];
		$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
		$r['timelogin'] = $time->format('Y-m-d H:i:s');
		$r['role'] = '0';

		$this->validation->regex($r['username'],'/^[a-zA-Z0-9_]{6,20}$/',l('register_username_error'));
		$this->validation->required($r['password'],l('register_password_empty'));
		$this->validation->regex($r['name'],'/^[a-zA-Z0-9_\s]{6,30}$/',l('register_companyname_error'));
		$this->validation->regex($r['phone'],'/^([0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12}))$/',l('register_phone_error'));
		
		# check username
		# @todo ajaxnya blm
		$userexist = $this->model->users->userexist($r['username']);
		$this->validation->f(!empty($userexist),l('register_username_used'));
		$companyexist = $this->model->users->companyexist($r['name']);
		$this->validation->f(!empty($companyexist),l('register_name_used'));
		
		if (!sizeof($this->validation->errors)) {
			# make a / secure get
			$this->sessions->set('secure.get','/');  
			$this->sessions->set('secure.data',$r);
			redirect('/secure');
		}
	}
	
	function postregister()
	{
		$this->model('users');
		$this->model->users->register($this->sessions->get('secure.data'));
		$this->sessions->del('secure.data');
		$this->sessions->del('secure.response');
		redirect('/welcome');
	}

	function terms(){
		$this->view('site/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->view('site/terms');
		$this->view('site/footer');		
	}
	
	function welcome(){
		$this->view('site/header');
		$this->active->menu($this->sessions->get('uid'),$this);		
		$this->view('site/welcome');
		$this->view('site/footer');			
	}
	
	function why(){
		$this->view('site/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->view('site/why');
		$this->view('site/footer');					
	}
	
	function logout(){
		$this->sessions->flush();
		$this->sessions->refresh();
		redirect('/');
	}
	
}
?>