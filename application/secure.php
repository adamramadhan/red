<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Secure extends Application {
	#default page
	function index() {
		$this->library ( 'validation' );
		$this->library ( 'sessions' );
		$this->middleware ( 'recaptcha', 'recaptcha' );
		
		# jika ada post secure dan session secure tertentu bersama datanya
		if (is_post ( 'secure' ) && $this->sessions->get ( 'secure.get' ) && $this->sessions->get ( 'secure.data' )) {
			
			# kalo lagi error matiin aja
			$respond = $this->recaptcha->check_answer();
			$this->validation->f(!$respond->is_valid,l('recaptcha_error'));
			

			# check recaptcha
			if (! sizeof ( $this->validation->errors )) {
				# check apakah ada session respond tidak ada
				if (! $this->sessions->get ( 'secure.response' )) {
					# set response dan secure get dari mana
					$application = $this->sessions->get ( 'secure.get' );
					# del response agar bisa memproses applikasi lain yang butuh
					$this->sessions->del ( 'secure.get' );
					$this->sessions->set ( 'secure.response', $application );
					redirect ( $application );
				}
			}
		}
		
		$this->view ( 'site/header' );
		$this->view ( 'site/menu' );
		$this->view ( 'site/secure' );
		$this->view ( 'site/footer' );
	}
}

?>