<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Mobile extends Application {
	# put global things here
	function __construct() {
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}
	
	function index() {
		$this->view ( 'admin/header' );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->helper ( 'forms' );
		$this->view ( 'admin/index' );
		$this->view ( 'site/footer' );
	}
}

?>