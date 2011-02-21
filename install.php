<?php  
echo '<h1>Install NETCOID</h1>';
echo '<pre></pre>';

	if ( !class_exists('Memcache')) {
		echo "netcoid alert: level 1, server problem please contact rama@networks.co.id";
		die();
	}
?>
