<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Help extends Application {
	function __construct() {
		$this->library ( 'sessions' );
	}
	
	function index() {
		if (! $this->sessions->get ( 'uid' )) {
			$this->view ( 'site/header' );
			$this->view ( 'site/menu' );
			$this->view ( 'site/help' );
			$this->view ( 'site/footer' );
		}
		
		if ($this->sessions->get ( 'uid' )) {
			$this->library ( 'validation' );
			$this->model ( 'users' );
			$this->model ( 'messages' );
			$this->helper ( 'forms' );
			$this->helper ( 'active' );
			
			if (is_post ( 'send' )) {
				# untuk sementara first admin
				$m ['RUID'] = $this->model->users->getRole ( 5, 1 );
				$m ['SUID'] = $this->sessions->get ( 'uid' );
				$m ['subject'] = $this->validation->safe ( $_POST ['subject'] );
				$m ['message'] = $this->validation->safe ( $_POST ['message'] );
				$m ['type'] = '0'; #notopen
				

				$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
				$m ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
				
				if (empty ( $m ['subject'] )) {
					$m ['subject'] = l ( 'nosubject' );
				}
				
				$this->validation->required ( $m ['message'], l ( 'message_empty' ) );
				
				if (! sizeof ( $this->validation->errors )) {
					$this->model->messages->sendMessage ( $m );
					redirect ( '/messages' );
				}
			}
			
			$this->view ( 'users/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'users/helpcenter' );
			$this->view ( 'site/footer' );
		}
	}
}

?>