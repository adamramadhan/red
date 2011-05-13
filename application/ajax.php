<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Ajax extends Application {
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
			file_put_contents('CACHE', var_export($_POST, true));
		}
	}
}

?>