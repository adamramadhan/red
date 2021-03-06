<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Profiles extends Application {
	function index($username) {
		/*
		$this->library('validation');
		$username = $this->validation->safe($username);
		*/
		$this->model ( 'users' );
		$data ['user'] = $this->model->users->getData ( $username );

		# kalo tidak ada username yang ada kasih 404
		if (!isset($data ['user'] ['username'])) {
			header ( "HTTP/1.0 404 Not Found" );
			$this->library ( 'sessions' );
			$this->helper ( 'active' );
			$this->view ( 'site/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'site/404' );
			$this->view ( 'site/footer' );
		}
		
		# kalo ada username yang punya
		if ($data ['user'] ['username']) {
			# bayangin kalo seandainya ada 10000 request profile. bisa
			# kena ddos, coba cari cara biar usernamenya bisa usah connect database untuk
			# cari databasenya.
			
			$this->library ( 'sessions' );
			$this->helper ( 'active' );
			$this->model ( 'products' );
			$this->model ( 'social' );

			# ADDED BLOG POSTS
			$this->model ( 'blog' );
			# 1 = User Content ( approved )
			$data['blog']['approved'] = $this->model->blog->getPostsbyUID($data ['user']['uid'],1);
			# 2 = Published Official Blog
			$data['blog']['official'] = $this->model->blog->getPostsbyUID($data ['user']['uid'],2);
			# 4 = Netcoid HQ for admins
			$data['blog']['bloghq'] = $this->model->blog->getPostsbyUID($data ['user']['uid'],4);
			# END BLOG POSTS

			$data ['thisprofile'] = $username;
			
			$this->middleware ( 'googlemaps', 'googlemaps' );
			if (! empty ( $data ['user'] ['address'] )) {
				$this->googlemaps->init ( array ('size' => '220x220', 'address' => $data ['user'] ['address'], 'language' => 'Disini', 'path' => STORAGE ) );
			}
			
			// start pagenation
			if (! isset ( $_GET ['offset'] )) {
				$data['offset'] = '0';
				$data['page'] = 1;
			}
			
			if (is_get ( 'offset' )) {
				$page = '0';
				if (is_numeric ( $_GET ['offset'] )) {
					$data['offset'] = $_GET ['offset'] * 16;
					$data['page'] = 1 + $_GET ['offset'];
				}
			}
			// end pagenation
			
			# SOCIAL PINDAH KE AJAX
			
			$data ['products'] = $this->model->products->listProductsByUID ( $data ['user'] ['uid'],$data['offset'] );
			$data ['readmore'] = count ( $data ['products'] );
			$data ['follow'] = $this->model->social->is_following ( $this->sessions->get ( 'uid' ), $data ['user'] ['uid'] );
			
			# START SEO
			$header ['title'] = $data['user']['name'];
			# END SEO

			$this->view ( 'profile/header', $header );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'profile/index', $data );
			$this->view ( 'profile/footer' );
		}
	}
}

?>