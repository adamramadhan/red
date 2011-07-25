<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Mobile extends Application {
	
	/**
	 * WWW.NETWORKS.CO.ID/EDIT
	 * where global things happens
	 * inside this domain.
	 */
	 
	function __construct() {

		# BOOTSTRAP
		$this->library ( 'sessions' );
		$this->helper ( 'active' );

		# ASSETS
		# hook ini berfungsi di semua function
		# tadinya mau kaya $this->preCSShooks[] = 'jquery'
		# jadi tiap halaman bisa beda2, masalahnya contstuct cuma
		# di jalakan sekali saja. jadi harus mencari cara lain.

		$this->preCSShooks = array(
			'framework',
			'netcoid.v1',
			'mobile'
		);

		$this->preJShooks = array(
			'jquery',
			'jquery-ui-1.8.14.custom.min'
		);

		$this->postJShooks = array(
			'middleware/jquery/jquery.pjax'
		);
	}

	# sebuah contoh control terbaru
	function blog(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas

		# START LOGIC

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		$data = array('' => null );
		if (!is_ajax()) {
			$this->view ( 'mobile/header', $data );
			$this->view ( 'mobile/blog', $data );
			$this->view ( 'mobile/footer', $data );
		}
		if (is_ajax()) {}		
	}
}

?>