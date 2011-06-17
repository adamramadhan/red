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
					$this->cache->add ( "netcoid:social:point", $socialpt , 360 ); # from 60 
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
			
			# open invite
			#$this->view ( 'site/index-openinvite3',$data );	
			
			if (!is_get('team')) {
				$this->view ( 'site/index-prepare',$data );		
			}
			
			
			if (is_get('team')) {
					$this->view('site/register-openinvite2',$data);			
			}				
			
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
					$data ['feeds'] [$value ['pid']] ['comments'] = $this->model->products->listCommentsByPID ( $value ['pid'], 3 );
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
		$lastid = $this->model->users->registerReturnId ( $this->sessions->get ( 'secure.data' ) );
		# ADDONS
		$this->model('messages');

		# GET DATA FROM POST
		$m ['RUID'] = $lastid;
		$admin = $this->model->users->getRole(5,1);
		$m ['SUID'] = $admin[0]['uid'];
		$m ['subject'] = 'Hallo, Rekan Netcoid!.';
		$m ['message'] = '<div id="event-hello-netcoid" style="background: none repeat scroll 0% 0% rgb(255, 241, 187); padding: 10px;"><p>Sebelumnya, kami team Netcoid mengucapakan;</p><br><div style="padding: 10px; color: rgb(68, 68, 68); background: none repeat scroll 0pt 0pt rgb(222, 222, 101); text-shadow: 0pt 0pt 1px rgb(236, 255, 230);" class="c"><h3>Adam Ramadhan ( Developer )</h3><p>Thanks sudah bergabung Netcoid, kami tidak munkin bisa sejauh ini tampa ada bantuan dari Rekan Netcoid. Selamat bergabung!</p></div><br><div style="padding: 10px; color: rgb(68, 68, 68); background: none repeat scroll 0pt 0pt rgb(222, 222, 101); text-shadow: 0pt 0pt 1px rgb(236, 255, 230);" class="c"><h3>Lusi aka Momoru ( illustrator)</h3><p>Hallo!, terimakasih ya udah daftar di netcoid, disini sebagai illustrator netcoid. jangan lupa mampir di <a style="color: rgb(66, 119, 11);" href="/momoru" class="u">*gotcini</a> ya!. follow juga twitter saya di @liulusiliu.</p></div><br><div style="padding: 10px; color: rgb(68, 68, 68); background: none repeat scroll 0pt 0pt rgb(222, 222, 101); text-shadow: 0pt 0pt 1px rgb(236, 255, 230);" class="c"><h3>Oudi ( Server )</h3><p>Saya membantu Netcoid dibagian teknis server, saya juga ingin mengucapkan selamat datang di keluarga besar Netcoid.</p></div><br><h3>Tips</h3><p>Ada pepatah yang mengatakan "The only kind of marketing you need is an amazing product. If it’s good, people will spread the word for you."</p><br><h3>What next?</h3>Anda dapat membalas surat ini dengan Pertanyaan, fitur yang diinginkan atau Saran. <br><br>Thanks!<br><a href="/allstars">Team Netcoid.</a></div>';
		$m ['type'] = '0'; #notopen	
		# get the time from jakarta
		$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
		$m ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
		$status = $this->model->messages->sendMessage($m);
		# ADDONS
		$this->sessions->del ( 'secure.data' );
		$this->sessions->del ( 'secure.response' );
		redirect ( '/welcome' );
	}
	
	function terms() {
		#SEO START
		$header['title'] = 'Terms of Service';
		$header['title_more'] = 'Rights and Responsibilities';
		$this->view ( 'site/header-data',$header );
		#SEO END

		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/terms' );
		$this->view ( 'site/footer' );
	}

	function privacy() {
		#SEO START
		$header['title'] = 'Privacy';
		$header['title_more'] = 'Trust and Openess';
		$this->view ( 'site/header-data',$header );
		#SEO END

		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/privacy' );
		$this->view ( 'site/footer' );
	}
		
	function welcome() {
		#SEO START
		$header['title'] = 'Hello!';
		$header['title_more'] = 'before you get started';
		$this->view ( 'site/header-data',$header );
		#SEO END

		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/welcome' );
		$this->view ( 'site/footer' );
	}
	
	function why() {
		#SEO START
		$header['title'] = 'Why, How and What';
		$header['title_more'] = 'Creating a better business!';
		$this->view ( 'site/header-data',$header );
		#SEO END

		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'site/why' );
		$this->view ( 'site/footer' );
	}
	
	function allstars() {
		#SEO START
		$header['title'] = 'The Team';
		$header['title_more'] = 'Our Ideas, Passion and Hardwork';
		$this->view ( 'site/header-data',$header );
		#SEO END
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