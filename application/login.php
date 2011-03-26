<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Login extends Application {
	# default page
	# todo kalo ud login redirect
	function index() {

		
		$this->library ( 'validation' );
		$this->library ( 'sessions' );
		$this->library ( 'security' );
		$this->model ( 'users' );
		
		if (is_post ( 'login' )) {
			# get data from users model
			$l ['username'] = $_POST ['username'];
			$l ['password'] = $this->security->redhash512 ( $_POST ['password'], $l ['username'] );
			$data = $this->model->users->getData ( $l ['username'] );
			
			# doing some validation
			$this->validation->regex ( $l ['username'], '/^[a-zA-Z0-9_]{6,20}$/', l ( 'register_username_error' ) );
			$this->validation->required ( $l ['password'], l ( 'register_password_empty' ) );
			$this->validation->f ( ! $this->security->hashpass ( $l ['password'], $data ['password'] ), l ( 'login_error' ) );
			# set some sessions
			if (! sizeof ( $this->validation->errors )) {
				$this->sessions->set ( 'uid', $data ['uid'] );
				$this->sessions->set ( 'name', $data ['name'] );
				$this->sessions->set ( 'username', $data ['username'] );
				redirect ( '/' );
			}
		}
		
		$this->view ( 'site/header' );
		$this->view ( 'site/menu' );
		$this->view ( 'site/login' );
		$this->view ( 'site/footer' );
	}
}

?>