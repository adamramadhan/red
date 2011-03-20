<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );

	# dah dimatiin di routes
class Comments extends Application {
	function __construct() {
		$this->library ( 'sessions' );
		if (! $this->sessions->get ( 'uid' )) {
			redirect ( '/404' );
			die ();
		}
		;
	}
	
	function index() {
		if (is_get ( 'd' )) {
			$this->model ( 'comments' );
			$data = $this->model->comments->getUID ( $_GET ['d'] );
			if (isset ( $_SERVER ['HTTP_REFERER'] ) && $this->sessions->get ( 'uid' ) == $data ['uid']) {
				$this->model->comments->del ( $_GET ['d'] );
				redirect ( $_SERVER ['HTTP_REFERER'] );
			
		# security warning
			} else {
				redirect ( '/' );
			}
		}
		
		if (is_get ( 'o' )) {
			$this->model ( 'mentions' );
			$data = $this->model->mentions->getDatafromCIDandUID ( $_GET ['o'], $this->sessions->get ( 'uid' ) );
			if ($this->sessions->get ( 'uid' ) == $data ['uid']) {
				$this->model->mentions->open ( $data ['mid'], $this->sessions->get ( 'uid' ) );
				redirect ( '/mentions' );
			
		# security warning
			} else {
				redirect ( '/' );
			}
		}
	}
}

?>