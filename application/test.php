<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Test extends Application {
	# put global things here
	function __construct() {
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}
	
	function test() {
		$this->sessions->set('login',1);
		echo $this->sessions->get('login');
	}
	function test2(){
		if (is_get('d')) {
			$this->sessions->del('login');
		}
		echo $this->sessions->get('login');
	}
}

?>