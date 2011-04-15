<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Site extends Application {
	function __construct() {
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}
	
	function index() {
		# no session = show front page
		if (! $this->sessions->get ( 'uid' )) {
			# init
			$this->library ( 'validation' );
			
			# social addon
			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;		
				$this->library ( 'social' );
				if ($this->cache->get ( "netcoid:social:point" )) {
					$data ['socialpoint'] = $this->cache->get ( "netcoid:social:point" );
				}
				
				if (! $this->cache->get ( "netcoid:social:point" )) {
					$social['facebook'] = $this->social->getFacebookPageData('netcoid');
					$social['twitter'] = $this->social->getTwitterData('netcoid');
					$socialpt = $social['twitter']['followers_count'] + $social['facebook']['likes'];
					$this->cache->add ( "netcoid:social:point", $socialpt , FALSE, 60 );
					$data ['socialpoint'] = $socialpt;
				}
			}

			if (!config('features/memcached')) {
				$this->library ( 'social' );
				$social['facebook'] = $this->social->getFacebookPageData('netcoid');
				$social['twitter'] = $this->social->getTwitterData('netcoid');
				$data ['socialpoint'] = $social['twitter']['followers_count'] + $social['facebook']['likes'];
			}
			# end social addon

			$this->middleware ( 'recaptcha', 'recaptcha' );
			
			$this->view ( 'site/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			
			# register, secureing the data
			if (is_post ( 'register' )) {
				$this->preregister ();
			}
			
			# if have sessions register & secure
			if ($this->sessions->get ( 'secure.data' ) && $this->sessions->get ( 'secure.response' )) {
				$this->postregister ();
			}
			
			if (! is_get( 'faktanyaadalah' ) && ! is_get( 'binus' ) && ! is_get( 'uniqpost' )) {
				$this->view ( 'site/index',$data );
			}
			
			if (is_get ('faktanyaadalah' )) {
				$this->view ( 'site/index-closed-invitation' );
			}
			if (is_get ('binus' )) {
				$this->view ( 'site/index-closed-invitation' );
			}
			if (is_get ('uniqpost' )) {
				$this->view ( 'site/index-closed-invitation' );
			}
									
			#$this->view('site/index');
			$this->view ( 'site/footer' );
		}
		
		# if session = show dashboad
		if ($this->sessions->get ( 'uid' )) {
			
			$this->model ( 'users' );
			$this->model ( 'products' );
			$this->model ( 'social' );
			$this->helper ( 'time' );
			$data ['followingproduct'] = $this->model->products->listFromFollower ( $this->sessions->get ( 'uid' ), 5 );

			
			foreach ( $data ['followingproduct'] as $key => $value ) {
				$data ['feeds'] [$value ['pid']] = $value;
				if (config ( 'features/comments/core' )) {
					$data ['feeds'] [$value ['pid']] ['comments'] = $this->model->products->listCommentsByPID ( $value ['pid'], 5 );
				}
			}
			
			# var_dump($data['feeds']);
			# need optimize

			$data ['userproduct'] = $this->model->products->listProductsByUID ( $this->sessions->get ( 'uid' ), 0, 1 );
			$data ['user'] = $this->model->users->getData ( $this->sessions->get ( 'uid' ) );
			$data ['social'] = $this->model->social->CountSocial ( $this->sessions->get ( 'uid' ) );
			$data ['partners'] = $this->model->social->CountParters ( $this->sessions->get ( 'uid' ) );
			$this->view ( 'users/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'users/dashboard', $data );
			$this->view ( 'site/footer' );
		}
	}
	
	# secureing the data
	function preregister() {
		$this->library ( 'security' );
		$this->model ( 'users' );
		$r ['username'] = $_POST ['username'];
		$r ['password'] = $this->security->redhash512 ( $_POST ['password'], $r ['username'] );
		$r ['name'] = $_POST ['company'];
		$r ['phone'] = $_POST ['phone'];
		$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
		$r ['timelogin'] = $time->format ( 'Y-m-d H:i:s' );
		$r ['role'] = '0';
		
		$this->validation->regex ( $r ['username'], '/^[a-zA-Z0-9_]{6,20}$/', l ( 'register_username_error' ) );
		$this->validation->required ( $r ['password'], l ( 'register_password_empty' ) );
		$this->validation->regex ( $r ['name'], '/^[a-zA-Z0-9_\s]{6,30}$/', l ( 'register_companyname_error' ) );
		$this->validation->regex ( $r ['phone'], '/^([0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12}))$/', l ( 'register_phone_error' ) );
		
		# check username
		# @todo ajaxnya blm
		$userexist = $this->model->users->userexist ( $r ['username'] );
		$this->validation->f ( ! empty ( $userexist ), l ( 'register_username_used' ) );
		$companyexist = $this->model->users->companyexist ( $r ['name'] );
		$this->validation->f ( ! empty ( $companyexist ), l ( 'register_name_used' ) );
		
		# check kalo udah dipake di route belum
		$this->validation->f ( is_routes ( $r ['username'] ), l ( 'register_username_used' ) );
		
		if (! sizeof ( $this->validation->errors )) {
			$this->sessions->set ( 'secure.get', '/' );
			$this->sessions->set ( 'secure.data', $r );
			redirect ( '/secure' );
		}
	}
	
	function postregister() {
		$this->model ( 'users' );
		$this->model->users->register ( $this->sessions->get ( 'secure.data' ) );
		$this->sessions->del ( 'secure.data' );
		$this->sessions->del ( 'secure.response' );
		redirect ( '/welcome' );
	}
	
	function terms() {
		$this->view ( 'site/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/terms' );
		$this->view ( 'site/footer' );
	}
	
	function welcome() {
		$this->view ( 'site/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/welcome' );
		$this->view ( 'site/footer' );
	}
	
	function why() {
		$this->view ( 'site/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/why' );
		$this->view ( 'site/footer' );
	}
	
	function allstars() {
		$this->view ( 'site/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/allstars' );
		$this->view ( 'site/footer' );
	}
	
	function logout() {
		$this->sessions->flush ();
		$this->sessions->refresh ();
		redirect ( '/' );
	}

	function reset(){
		if (is_get('id')) {
			$this->view ( 'site/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->model ( 'users' );
			$this->library ( 'forms' );
			$g['reset'] = $_GET['id'];
			$data['user'] = $this->model->users->getReset($g);
			if (empty($data['user'])) {
				redirect ( '/404' );
			}

			if (is_post('reset')) {
				$this->library ( 'security' );
				$r ['uid'] = $data['user']['uid'];
				$r ['password'] = $this->security->redhash512 ( $_POST ['password'], $data['user']['username'] );
				$this->model->users->resetPassword($r);
				redirect ( '/login' );
			}
			$this->view ( 'site/reset',$data );
			$this->view ( 'site/footer' );		
		}

		if (!is_get('id')) {
			redirect ( '/404' );
		}
	}
}
?>