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
		
		// start beta plugin \[img\]((?:[^*_\[]+|\[(?!img\]))*)\[img\]
		#$data['user']['information'] = $validate->safe($data['user']['information']);
		$data ['user'] ['information'] = nl2br ( $data ['user'] ['information'] );
		#$data['user']['information'] = str_replace( "\n" , "<br />" , $data['user']['information']);
		$data ['user'] ['information'] = preg_replace ( '/\[i\]((?:[^\[]+|\[(?!i\]))*)\[i\]/', '<em>\1</em>', $data ['user'] ['information'] );
		$data ['user'] ['information'] = preg_replace ( '/\[b\]((?:[^\[]+|\[(?!b\]))*)\[b\]/', '<strong>\1</strong>', $data ['user'] ['information'] );
		$data ['user'] ['information'] = preg_replace ( '/\[img\]((?:[^\[]+|\[(?!img\]))*)\[img\]/', '<img src="\1" />', $data ['user'] ['information'] );
		// end beta plugin
		

		# kalo tidak ada username yang ada kasih 404
		if (! $data ['user'] ['username']) {
			redirect ( '/404' );
		}
		
		# kalo ada username yang punya
		if ($data ['user'] ['username']) {
			# bayangin kalo seandainya ada 10000 request profile. bisa
			# kena ddos, coba cari cara biar usernamenya bisa usah connect database untuk
			# cari databasenya.
			

			$this->library ( 'social' );
			$this->library ( 'sessions' );
			$this->helper ( 'active' );
			$this->model ( 'products' );
			$this->model ( 'social' );
			
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


			# social addon
			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;		

				# FOLLOWERS
				$data ['followers'] = $this->model->social->CountFollowers ( $username );

				if ($this->cache->get ( "social:points:$username" )) {
					$data ['socialpoint'] = $this->cache->get ( "social:points:$username");
				}
				
				if (! $this->cache->get ( "social:points:$username" )) {

					if (! empty ( $data ['user'] ['facebook'] )) {
						$social['facebook'] = $this->social->getFacebookPageData($data ['user'] ['facebook']);
					}
					if (! empty ( $data ['user'] ['twitter'] )) {
						$social['twitter'] = $this->social->getTwitterData($data ['user'] ['twitter']);
					}

					$socialpt = $social['twitter']['followers_count'] + $social['facebook']['likes'] + $data ['followers'];
					$this->cache->add ( "social:points:$username", $socialpt , FALSE, 60 );
					$data ['socialpoint'] = $socialpt;
				}
			}

			if (!config('features/memcached')) {
				$this->library ( 'social' );
				$social['facebook'] = $this->social->getFacebookPageData($data ['user'] ['facebook']);
				$social['twitter'] = $this->social->getTwitterData($data ['user'] ['twitter']);
				$data ['socialpoint'] = $social['twitter']['followers_count'] + $social['facebook']['likes'] + $data ['followers'];
			}
			echo $social['twitter']['followers_count'];
			echo "<br/>";
			echo $social['facebook']['likes'];			echo "<br/>";
			 echo $data ['followers'];
			# end social addon
			

			// start social
			if (config ( 'features/memcached' )) {		

				# YAHOO
				if (! empty ( $data ['user'] ['yahoo'] )) {
					if ($this->cache->get ( "social:yahoo:$username" )) {
						$data ['yahoo'] = $this->cache->get ( "social:yahoo:$username" );
					}
					
					if (! $this->cache->get ( "social:yahoo:$username" )) {
						$status = $this->social->getYahooProfile ( $data ['user'] ['yahoo'] );
						$this->cache->add ( "social:yahoo:$username", $status, FALSE, 120 );
						$data ['yahoo'] = $status;
					}
				}

				# TWITTER
				if (! empty ( $data ['user'] ['twitter'] )) {					
					if ($this->cache->get ( "social:twitter:$username" )) {
						$data ['twitter'] = $this->cache->get ( "social:twitter:$username" );
					}
					
					if (! $this->cache->get ( "social:twitter:$username" )) {
						$status = $this->social->getTwitterProfile ( $data ['user'] ['twitter'] );
						$this->cache->add ( "social:twitter:$username", $status, FALSE, 120 );
						$data ['twitter'] = $status;
					}
				}

				# FACEBOOK
				if (! empty ( $data ['user'] ['facebook'] )) {
					if ($this->cache->get ( "social:facebook:$username" )) {
						$data ['facebook'] = $this->cache->get ( "social:facebook:$username" );
					}
					
					if (! $this->cache->get ( "social:facebook:$username" )) {
						$status = $this->social->getFacebookPageStatus ( $data ['user'] ['facebook'] );
						$this->cache->add ( "social:facebook:$username", $status, FALSE, 120 );
						$data ['facebook'] = $status;
					}
					
					if (! empty ( $data ['user'] ['facebook'] )) {
						$data ['facebookdata'] = $this->social->getFacebookPageData ( $data ['user'] ['facebook'] );
					}
				}
			}

			if (!config ( 'features/memcached' )) {	
				
				if (! empty ( $data ['user'] ['twitter'] )) {	
					$data ['twitter'] = $this->social->getTwitterProfile ( $data ['user'] ['twitter'] );
				}

				if (! empty ( $data ['user'] ['yahoo'] )) {
					$data ['yahoo'] = $this->social->getYahooProfile ( $data ['user'] ['yahoo'] );
				}

				if (! empty ( $data ['user'] ['facebook'] )) {
					$data ['facebook'] = $this->social->getFacebookPageStatus ( $data ['user'] ['facebook'] );
					$data ['facebookdata'] = $this->social->getFacebookPageData ( $data ['user'] ['facebook'] );
				}
			}	
			// end social
			

			$data ['products'] = $this->model->products->listProductsByUID ( $data ['user'] ['uid'],$data['offset'] );
			$data ['readmore'] = count ( $data ['products'] );
			$data ['follow'] = $this->model->social->is_following ( $this->sessions->get ( 'uid' ), $data ['user'] ['uid'] );
			
			# START SEO
			$header ['title'] = $data['user']['name'];
			# END SEO

			$this->view ( 'profile/header', $header );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'profile/index', $data );
			$this->view ( 'site/footer' );
		}
	}
}

?>