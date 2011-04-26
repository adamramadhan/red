<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Test extends Application {
	# put global things here
	function __construct() {
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}

	function google(){
		$this->view ( 'area51/header', $data );
		$this->view ( 'area51/google', $data );
		$this->view ( 'area51/footer', $data );
	}	

	function ajax(){
		$this->model('products');
		
		$data['followingproduct'] = array(
			0 => array('pid' => '27' ),
			1 => array('pid' => '25' ),
			2 => array('pid' => '23' ),
			3 => array('pid' => '20' ),
			4 => array('pid' => '18' ),
			5 => array('pid' => '17' )
		);

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
}

?>