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

	function getPageViews($uid,$date_start = '0000-00-00' ,$date_end = '9999-99-99'){
		$data = $this->fetchAll ( "SELECT COUNT(AID) AS views, LEFT(timecreate, 10) AS date, COUNT(DISTINCT(IP)) AS uniqueviews FROM analytics WHERE host_UID = :uid AND 
		LEFT(timecreate, 10) BETWEEN $date_start and $date_end GROUP BY(LEFT(timecreate, 10))", array ('uid' => $uid ) );
		return $data;
	}

	function getProductsViews($uid,$date_start = '0000-00-00' ,$date_end = '9999-99-99'){
		$data = $this->fetchAll ( "SELECT name, host_PID, count(host_PID) AS views, COUNT(DISTINCT(IP)) AS uniqueviews FROM analytics, products WHERE analytics.host_PID = products.pid AND host_UID = :uid AND 
		DATE_FORMAT(analytics.timecreate,'%Y-%m-%d') BETWEEN $date_start and $date_end AND host_PID IS NOT NULL 
		GROUP BY(host_PID)", array ('uid' => $uid ) );
		return $data;		
	}
}

?>