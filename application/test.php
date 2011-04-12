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
		$this->view ( 'area51/chrome', $data );
		$this->view ( 'area51/footer', $data );
	}	

	function test() {
		$this->sessions->set('login',1);
		$_SESSION['aw'] = 'test';
		echo session_id().'<br/>';
		var_dump($_SESSION).'<br/>';
		echo $this->sessions->get('login');
	}
	function test2(){
		if (is_get('d')) {
			$this->sessions->del('login');
			$this->sessions->del('aw');
			$this->sessions->flush();
		}
		echo session_id().'<br/>';

		var_dump($_SESSION).'<br/>';
		echo $this->sessions->get('login');
	}
	function info(){
		ini_set('suhosin.session.encrypt','off');
		echo ini_get('suhosin.session.encrypt'). "<br/>";
		echo 'post_max_size = ' . ini_get('post_max_size') . "<br/>";
		echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) . "<br/>";
		phpinfo();
	}
}

?>