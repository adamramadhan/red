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
		$_SESSION['aw'] = 'test';
		echo session_id().'<br/>';
		echo $_SERVER["SSL_SESSION_ID"].'<br/>';
		echo $_SESSION["aw"].'<br/>';
		echo $this->sessions->get('login');
	}
	function test2(){
		if (is_get('d')) {
			$this->sessions->del('login');
			$this->sessions->del('aw');
		}
		echo session_id().'<br/>';

		echo $_SERVER["SSL_SESSION_ID"].'<br/>';
		echo $_SESSION["aw"].'<br/>';
		echo $this->sessions->get('login');
	}
	function info(){
		echo ini_get('suhosin.session.encrypt');
		echo ini_get('display_errors');
		phpinfo();
	}
}

?>