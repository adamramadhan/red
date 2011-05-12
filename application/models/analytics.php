<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelAnalytics extends Models {
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function set($data) {
		$data = $this->insert ( 'analytics', $data );
		return $data;
	}	
}

?>