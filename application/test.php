<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Test extends Application {
	# put global things here
	function __construct() {
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}

	function flush(){
		$this->cache = new Cache;	
		$this->cache->flush();
		#$this->view ( 'area51/header', $data );
		#$this->view ( 'area51/google', $data );
		#$this->view ( 'area51/footer', $data );
	}	

	function ajax(){
		$this->model('products');
		
		# F = FROM
		if (is_get('f')) {

			if (is_numeric($_GET['f'])) {
				#$data['new'] = $this->model->products->getLastListFromFollower($this->sessions->get ( 'uid' ),23);
				$data['ajax'] = $this->model->products->getDiff($this->sessions->get('uid'),$_GET['f']);
				#$data['x'] = $this->model->products->getDiff($this->sessions->get('uid'),10);
				$this->view ( 'area51/ajax-data',$data);
			}

			# FETCH UNTIL PID = 23. COUNT THE DIFFRENCE = X FETCH AS X OR LATEST 5 IF MORE THEN 5
		}
	}

	function hello(){
		echo "hello";
		var_dump($_SERVER['HTTP_X_REQUESTED_WITH']);
	}

	function home(){
		$this->library('social');
		$json['twitter'] = $this->social->twitterSearch('@faktanyaadalah&lang=id');
		$json['facebook'] = $this->social->facebookSearch('@faktanyaadalah&type=post');
		$hello = $json['twitter']['tweetperhour'] + $json['facebook']['postperhour'];
		var_dump($hello);

		#$facebook = $this->social->getFacebookPageStatus('netcoid');
		#var_dump($facebook);
		#$this->model('products');
		#$data ['followingproduct'] = $this->model->products->listFromFollower ( $this->sessions->get ( 'uid' ), 5 );
		#$this->view ( 'area51/header');
		#$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		#$this->view ( 'area51/ajax');
		#$this->view ( 'area51/footer');
	}

	function github(){
		$this->helper('time');
		require_once 'middleware/github/Autoloader.php';
		Github_Autoloader::register();

		$github = new Github_Client();
		$github->authenticate('adamramadhan', '8935c02b15ad21009647ad21a21ea2b7');
		$data['updates'] = $github->getCommitApi()->getBranchCommits('adamramadhan', 'red', 'master');
		$data['updates'] = array_slice($data['updates'],0,10);
		$data['repo'] = $github->getRepoApi()->show('adamramadhan', 'red');

		if (!is_get('id')) {
			$data['commit'] = $github->getCommitApi()->getCommit('adamramadhan', 'red', $data['updates']['0']['id']);
		}

		if (is_get('id')) {
			# @todo di cek keamanannya urlencode cukup?
			$data['commit'] = $github->getCommitApi()->getCommit('adamramadhan', 'red', urlencode($_GET['id']));
		}

		$data['user'] = $github->getUserApi()->show($data['commit']['committer']['login']);
		$header ['title'] = 'Netcoid Development';
		$header ['keywords'] = 'development,github';
		$this->view ( 'blog/header',$header );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'blog/blog-menu' );
		$this->view ( 'blog/development',$data );
		$this->view ( 'blog/footer' );
	}

	function getAnalytics(){
		
		if (! $this->sessions->get ( 'uid' )) {
			redirect ( '/404' );
			die ();
		}

		# date
		$weekago = date('Y-m-d', strtotime('today - 1 week'));
		$weektoday = date('Y-m-d', strtotime('today'));

		$this->model('analytics');
		$data['analytics']['page'] = $this->model->analytics->getPageViews(
		$this->sessions->get('uid'),
		$weekago,
		$weektoday);

		# data.addRow(["A", 23, 32]);
		foreach ($data['analytics']['page'] as $page) {
			$pages[] = '["'.$page['date'].'",'.$page['views'].','.$page['guestview'].','.$page['netcoidview'].','.$page['uniqueviews'].']';
		}
		
		# var_dump($temp);
		# render the data
		# var_dump(count($temp));

		#if (count($temp) === 1 ) {
		#	$data['analytics'] = $temp['0'];
		#	var_dump($temp['0']);
		#}

		if (!empty($pages)) {
			$data['insights']['page'] = implode(',', $pages);
		}


		$data['analytics']['product'] = $this->model->analytics->getProductsViews(
		$this->sessions->get('uid'),
		$weekago,
		$weektoday);

		# data.addRow(["A", 23, 32]);

		foreach ($data['analytics']['product'] as $product) {
			$products[] = '["'.$product['name'].'(#'.$product['host_PID'].')",'.$product['views'].',
			'.$product['guestview'].','.$product['netcoidview'].','.$product['uniqueviews'].']';
		}
		if (!empty($products)) {
			$data['insights']['product'] = implode(',', $products);
		}

		if (count($data['insights']) == 1) {
			$data['insights']['null'] = TRUE;
			#$data['insights']['page'] = '["'.$weekago.'",1,1,1,1],["'.$weektoday.'",1,1,1,1]';
			#$data['insights']['product'] = '["#1 Product",1,1,1,1],["#2 Product",1,1,1,1]';
		}
		
		$this->view ( 'users/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view('area51/analytics',$data['insights']);
		$this->view ( 'users/footer' );		
	}
}

?>