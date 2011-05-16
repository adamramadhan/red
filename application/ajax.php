<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Ajax extends Application {

	public $cacheTime = 180; // 3 menit

	function __construct(){
		$this->library ( 'sessions' );
		if (!$this->sessions->get('uid')) {
			
			# AVOID ERRORS
			if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
				$_SERVER['HTTP_X_REQUESTED_WITH'] = NULL;
			}

			# IF ITS NOT A AJAX REQUEST = EXIT
			if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
				exit ( 'Hello, api@networks.co.id' );	
			}
		}
	}
	
	function index(){
		exit ( 'Hello, api@networks.co.id' );
	}

	function getProductDiff(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if (is_get('f')) {
				$this->model('products');
				if (is_numeric($_GET['f'])) {
					# FETCH UNTIL PID = 23. COUNT THE DIFFRENCE = X FETCH AS X OR LATEST 5 IF MORE THEN 5
					$data['ajax'] = $this->model->products->getDiff($this->sessions->get('uid'),$_GET['f']);
					$this->view ( 'ajax/ajax-data',$data);
				}
			}
		}		
	}

	function setAnalytics(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->model('analytics');
				
			  $a['guest_UID'] = $_POST['guest_UID'];
			  $a['host_UID'] = $_POST['host_UID'];
			  $a['host_PID'] = $_POST['host_PID'];
			  $a['IP'] = $_POST['IP'];
			  $a['referrer'] = $_POST['referrer'];
			  //$a['URL'] = $_POST['URL'];
			  $a['timecreate'] = $_POST['timecreate'];

			  $this->model->analytics->set($a);
		}
	}

	function getSocialPoints(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
		# DEPENDENCY
		$this->library('social');
		$this->model('social');

		# CACHEING + SOCIAL
		if (config ( 'features/memcached' )) {
			$this->cache = new Cache;
			# GET USERNAME POINTS FROM CACHE
			# var_dump($this->cache->get('SOCIAL:POINTS:'.$_POST['uid']));
			if ($this->cache->get('SOCIAL:POINTS:'.$_POST['uid'])) {
				$data ['socialpoint'] = $this->cache->get ( 'SOCIAL:POINTS:'.$_POST['uid']);
			}

			# SET CACHE
			if (!$this->cache->get('SOCIAL:POINTS:'.$_POST['uid'])){

				# GET FACEBOOK DATA
				if (! empty ($_POST['facebook'])) {
					$social['facebook'] = $this->social->getFacebookPageData($_POST['facebook']);
				} else {
					$social['facebook'] = 0;
				}

				# GET TWITTER DATA
				if (! empty ($_POST['twitter'])) {
					$social['twitter'] = $this->social->getTwitterData($_POST['twitter']);
				} else {
					$social['twitter'] = 0;
				}

				# GET NETCOID FOLLOWERS
				$data ['followers'] = $this->model->social->CountFollowers ( $_POST['uid'] );

				# COUNT DATA
				$socialpt = $social['twitter']['followers_count'] + $social['facebook']['likes'] + $data ['followers']['followers'];
				
				$this->cache->add ( 'SOCIAL:POINTS:'.$_POST['uid'], $socialpt , $this->cacheTime );
				$data ['socialpoint'] = $socialpt;
			}
		}
		# END CACHEING + SOCIAL

		# START SOCIAL NO CACHE
		if (!config('features/memcached')) {
			$this->library ( 'social' );

			# GET NETCOID FOLLOWERS
			$data ['followers'] = $this->model->social->CountFollowers ( $_POST['uid'] );

			# FACEBOOK
			$social['facebook'] = $this->social->getFacebookPageData($_POST  ['facebook']);
			
			# TWITTER
			$social['twitter'] = $this->social->getTwitterData($_POST ['twitter']);
			
			# COUNT DATA
			$data ['socialpoint'] = $social['twitter']['followers_count'] + $social['facebook']['likes'] + $data ['followers']['followers'];
		}		
		# END SOCIAL NO CACHE
		
		# RETURNS DATA
		echo number_format($data['socialpoint']);
		#file_put_contents('CACHE', var_export($data, true));
		#die();
		}
	}

	function getSocialTwitter(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			# DEPENDENCY
			$this->library('social');
			$this->model('social');		

			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;
				if (! empty ( $_POST['twitter'] )) {					
					if ($this->cache->get ( 'SOCIAL:TWITTER:'.$_POST['uid'] )) {
						$data ['twitter'] = $this->cache->get ( 'SOCIAL:TWITTER:'.$_POST['uid'] );
					}
					
					if (! $this->cache->get ( 'SOCIAL:TWITTER:'.$_POST['uid'] )) {
						$status = $this->social->getTwitterProfile ( $_POST['twitter'] );
						$this->cache->add ( 'SOCIAL:TWITTER:'.$_POST['uid'], $status, $this->cacheTime );
						$data ['twitter'] = $status;
					}
				}			
			}

			if (!config ( 'features/memcached' )) {
				if (! empty ( $_POST['twitter'] )) {	
					$data ['twitter'] = $this->social->getTwitterProfile ( $_POST['twitter'] );
				}			
			}
			
			echo '
			<a rel="nofollow" target="_blank" href="http://www.twitter.com/'.$_POST['twitter'].'">
				<div class="cu" id="twitter">'.$data['twitter'].'</div>
				<div id="twitter-meta" class="cb">@'.$_POST['twitter'].'</div>
			</a>';			
		}		
	}

	function getSocialYahoo(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			# DEPENDENCY
			$this->library('social');
			$this->model('social');		

			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;
				if (! empty ( $_POST['yahoo'] )) {
					if ($this->cache->get ( 'SOCIAL:YAHOO:'.$_POST['uid'] )) {
						$data ['yahoo'] = $this->cache->get ('SOCIAL:YAHOO:'.$_POST['uid']);
					}
					
					if (! $this->cache->get ( 'SOCIAL:YAHOO:'.$_POST['uid'] )) {
						$status = $this->social->getYahooProfile ($_POST['yahoo']);
						$this->cache->add ( 'SOCIAL:YAHOO:'.$_POST['uid'], $status, $this->cacheTime );
						$data ['yahoo'] = $status;
					}
				}	
			}

			if (!config ( 'features/memcached' )) {
				if (! empty ( $_POST['yahoo'] )) {	
					$data ['yahoo'] = $this->social->getYahooProfile ($_POST['yahoo']);
				}			
			}
			
			# GET YAHOO REAL USERNAME
			$y = explode('@',$_POST['yahoo']);
			echo '
			<a class="c" href="ymsgr:sendIM?'.$_POST['yahoo'].'">
				<div class="cu" id="yahoo">'.$data ['yahoo'].'</div>
				<div id="yahoo-meta" class="cb">@'.$y[0].'</div>	
			</a>';			
		}		
	}

	function getSocialFacebook(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			# DEPENDENCY
			$this->library('social');
			$this->model('social');		

			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;
				if (! empty ( $_POST['facebook'] )) {

					if ( $this->cache->get ( 'SOCIAL:FACEBOOK:'.$_POST['uid'] )) {
						$data ['facebook'] = $this->cache->get ( 'SOCIAL:FACEBOOK:'.$_POST['uid']  );

					}
					
					if (! $this->cache->get ( 'SOCIAL:FACEBOOK:'.$_POST['uid'] )) {
						$status['status'] = $this->social->getFacebookPageStatus ( $_POST ['facebook'] );
						$status['data'] = $this->social->getFacebookPageData ( $_POST ['facebook'] );
						$this->cache->add ( 'SOCIAL:FACEBOOK:'.$_POST['uid'], $status, $this->cacheTime );
						$data ['facebook'] = $status;
					}
				}
			}

			if (!config ( 'features/memcached' )) {
				if (! empty ( $_POST['facebook'] )) {	
					$data ['facebook'] = $this->social->getFacebookPageStatus ( $_POST['facebook'] );
					$data ['facebookdata'] = $this->social->getFacebookPageData ( $_POST['facebook'] );
				}			
			}

			# FACEBOOK
			echo '
			<a rel="nofollow" target="_blank" href="'.$data ['facebook']['data']['link'].'">
				<div class="cu" id="facebook">'.$data ['facebook']['status'].'</div>
				<div id="facebook-meta" class="cb">@'.$_POST['facebook'].'</div>					
			</a>';
		}			
	}
}

?>