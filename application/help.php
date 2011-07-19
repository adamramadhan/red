<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Help extends Application {

	function __construct() {

		# BOOTSTRAP
		$this->library ( 'sessions' );

		# ASSETS
		# hook ini berfungsi di semua function
		# tadinya mau kaya $this->preCSShooks[] = 'jquery'
		# jadi tiap halaman bisa beda2, masalahnya contstuct cuma
		# di jalakan sekali saja. jadi harus mencari cara lain.
		if ($this->sessions->get ( 'uid' )) {
			$this->preCSShooks = array(
				'framework',
				'netcoid.v1',
				'users'
			);

			$this->preJShooks = array(
				'jquery',
				'jquery-ui-1.8.14.custom.min'
			);

			$this->postJShooks = array(
				'middleware/jquery/jquery.pjax',
				'users.v1'
			);
		}
	}

	function skel(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas

		# START LOGIC

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {}
		if (is_ajax()) {}		
	}
	
	function index() {

		if (! $this->sessions->get ( 'uid' )) {
			$this->view ( 'site/header' );
			$this->view ( 'site/menu' );
			$this->view ( 'site/help' );
			$this->view ( 'site/footer' );
		}
		
		if ($this->sessions->get ( 'uid' )) {

			# START BOOTSTRAP
			$this->library ( 'validation' );
			$this->model ( 'users' );
			$this->model ( 'messages' );
			$this->helper ( 'forms' );
			$this->helper ( 'active' );
			
			# START LOGIC
			if (is_post ( 'send' )) {
				# untuk sementara first admin
				$dataadmin = $this->model->users->getRole ( 5, 1 );
				$m ['RUID'] = $dataadmin['0']['uid'];
				$m ['SUID'] = $this->sessions->get ( 'uid' );
				$m ['subject'] = $this->validation->safe ( $_POST ['subject'] );
				$m ['message'] = $this->validation->safe ( $_POST ['message'] );
				$m ['type'] = '0'; #notopen
				
				$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
				$m ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
				
				if (empty ( $m ['subject'] )) {
					$m ['subject'] = l ( 'nosubject' );
				}
				
				$m ['subject'] = 'Bertanya ' . $m ['subject'] ;
				$this->validation->required ( $m ['message'], l ( 'message_empty' ) );
				
				if (! sizeof ( $this->validation->errors )) {
					$this->model->messages->sendMessage ( $m );
					redirect ( '/messages' );
				}
			}

			if (!is_ajax()) {
				$this->view ( 'usersv2/header' );
				$this->view ( 'usersv2/helpcenter' );
				$this->view ( 'usersv2/footer' );
			}

			if (is_ajax()) {
				$this->view ( 'usersv2/helpcenter' );
			}					
		}
	}
}

?>