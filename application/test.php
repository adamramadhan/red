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

	function home(){
		$this->model('products');
		$data ['followingproduct'] = $this->model->products->listFromFollower ( $this->sessions->get ( 'uid' ), 5 );
		$this->view ( 'area51/header');
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'area51/ajax');
		$this->view ( 'area51/footer');
		echo "string";
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

	function analytics(){
		$region = geoip_region_by_name('www.example.com');
		if ($region) {
		    print_r($region);
		}
	}

}

?>