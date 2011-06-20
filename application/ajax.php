<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Ajax extends Application {

	public $cacheTime = 180; // 3 menit

	function __construct(){
		$this->library ( 'sessions' );

		# AVOID ERRORS
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			$_SERVER['HTTP_X_REQUESTED_WITH'] = NULL;
		}

		if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
			exit ( 'Hello, api@networks.co.id' );	
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
			
			echo '<div class="cu" id="twitter">'.$data['twitter'].'</div>
			<a rel="nofollow" target="_blank" href="http://www.twitter.com/'.$_POST['twitter'].'"><div id="twitter-meta" class="cb">@'.$_POST['twitter'].'</div>
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
					$status ['status'] = $this->social->getFacebookPageStatus ( $_POST['facebook'] );
					$status ['data'] = $this->social->getFacebookPageData ( $_POST['facebook'] );
					$data ['facebook'] = $status;
				}			
			}

			# FACEBOOK
			echo '
			<div class="cu" id="facebook">'.$data ['facebook']['status'].'</div>
				<a rel="nofollow" target="_blank" href="'.$data ['facebook']['data']['link'].'"><div id="facebook-meta" class="cb">@'.$_POST['facebook'].'</div>					
			</a>';
		}			
	}

	function getSocialSearch(){

		if (! empty ( $_POST['tag'] )) {	
			$this->library('social');
			# @todo do we need urlencode ?

			# IF CACHE
			if (config ( 'features/memcached' )) {
				$this->cache = new Cache;

				if ( $this->cache->get ( 'SOCIAL:SEARCH:'.$_POST['tag'] )) {
					$talkperhour = $this->cache->get ( 'SOCIAL:SEARCH:'.$_POST['tag']  );
				}

				if ( !$this->cache->get ( 'SOCIAL:SEARCH:'.$_POST['tag'] )) {
					$json['twitter'] = $this->social->twitterSearch(urlencode($_POST['tag']).'&lang=id');
					$json['facebook'] = $this->social->facebookSearch(urlencode($_POST['tag']).'&type=post');
					$talkperhour = $json['twitter']['tweetperhour'] + $json['facebook']['postperhour'];
					$this->cache->add ( 'SOCIAL:SEARCH:'.$_POST['tag'], $talkperhour, 216000 ); # 1 jam
				}
			}

			# IF NOT CACHE
			if (!config ( 'features/memcached' )) {
				$json['twitter'] = $this->social->twitterSearch(urlencode($_POST['tag']).'&lang=id');
				$json['facebook'] = $this->social->facebookSearch(urlencode($_POST['tag']).'&type=post');
				$talkperhour = $json['twitter']['tweetperhour'] + $json['facebook']['postperhour'];
			}

			# DISPLAY DATA
			echo $talkperhour.' Pembicaraan / Jam via Twitter & Facebook';
		}		
	}

	function getGoogleTrend(){
		# REQIIRE THE TRENDS MIDDLEWARE
		require 'middleware/trends/class.xhttp.php';
		$data['search'] = $_POST['tag'];
		$data['post'] = array(
		  'accountType' => 'HOSTED_OR_GOOGLE',
		  'Email'       => 'api@networks.co.id',
		  'Passwd'      => 'helloworld',
		  'service'     => 'trendspro', 
		  'source'      => 'Netcoid Google Insights'
		);

		# CACHE ENABLED
		if (config ( 'features/memcached' )) {
			$this->cache = new Cache;
			# JIKA ADA CACHE
			if ( $this->cache->get ( 'INSIGHTS:TRENDS:'.$_POST['tag'] )) {
				$data = $this->cache->get ( 'INSIGHTS:TRENDS:'.$_POST['tag'] );
				$this->view('ajax/ajax-trends',$data);
			}

			# JIKA TIDAK ADA CAHE
			if ( !$this->cache->get ( 'INSIGHTS:TRENDS:'.$_POST['tag'] )) {
				$response = xhttp::fetch('https://www.google.com/accounts/ClientLogin', $data);
				if(!$response['successful']) {
				    echo 'response: '; print_r($response);
				    die();
				}
				preg_match('/SID=(.+)/', $response['body'], $matches);
				$sid = $matches[1];
				$xdata = array();
				$xdata['cookies'] = array(
				    'SID' => $sid
				);
				$response = xhttp::fetch('http://www.google.com/insights/search/overviewReport?q='.$data['search'].'&geo=ID&cmpt=q&content=1&export=1', $xdata);
				$f = explode("\n\n", $response['body']);
				
				# AMBIL 5 KOTA TERATAS
				preg_match_all("/[a-zA-Z]{1,255},[0-9]{1,3}/",$f[3],$kotateratas,PREG_PATTERN_ORDER);
				$data['netcoidinsights_topcity'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $kotateratas[0]);

				# AMBIL SUBKAWASAN TERTINGGI
				preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[2],$regional,PREG_PATTERN_ORDER);
				$data['netcoidinsights_topregion'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $regional[0]);

				# AMBIL TAG PALING BANYAK DIGUNAKAN
				preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[5],$regional,PREG_PATTERN_ORDER);
				$data['netcoidinsights_toptag'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1', $regional[0]);

				#echo $response['body'];
				preg_match_all("/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/",$f[1],$chart,PREG_PATTERN_ORDER);
				$chart2 = preg_replace('/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/', '["$1",$2]', $chart[0]);
				$data['netcoidtrends'] = array_slice($chart2, -50);	
				$this->cache->add ( 'INSIGHTS:TRENDS:'.$_POST['tag'], $data, 5184000 ); # 1 hari
				$this->view('ajax/ajax-trends',$data);
			}
		}

		# CACHE NOT ENABLED
		if (!config ( 'features/memcached' )) {	
			if (! empty ( $_POST['tag'] )) {

				$response = xhttp::fetch('https://www.google.com/accounts/ClientLogin', $data);
				if(!$response['successful']) {
				    echo 'response: '; print_r($response);
				    die();
				}
				preg_match('/SID=(.+)/', $response['body'], $matches);
				$sid = $matches[1];
				$xdata = array();
				$xdata['cookies'] = array(
				    'SID' => $sid
				);
				$response = xhttp::fetch('http://www.google.com/insights/search/overviewReport?q='.$data['search'].'&geo=ID&cmpt=q&content=1&export=1', $xdata);
				$f = explode("\n\n", $response['body']);
				
				# AMBIL 5 KOTA TERATAS
				preg_match_all("/[a-zA-Z]{1,255},[0-9]{1,3}/",$f[3],$kotateratas,PREG_PATTERN_ORDER);
				$data['netcoidinsights_topcity'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $kotateratas[0]);

				# AMBIL SUBKAWASAN TERTINGGI
				preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[2],$regional,PREG_PATTERN_ORDER);
				$data['netcoidinsights_topregion'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $regional[0]);

				# AMBIL TAG PALING BANYAK DIGUNAKAN
				preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[5],$regional,PREG_PATTERN_ORDER);
				$data['netcoidinsights_toptag'] = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1', $regional[0]);

				#echo $response['body'];
				preg_match_all("/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/",$f[1],$chart,PREG_PATTERN_ORDER);
				$chart2 = preg_replace('/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/', '["$1",$2]', $chart[0]);
				$data['netcoidtrends'] = array_slice($chart2, -50);	
				$this->view('ajax/ajax-trends',$data);
			}
		}
	}
}

?>