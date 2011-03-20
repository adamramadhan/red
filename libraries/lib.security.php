<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Security {
	// dalam perkembangan berat
	function redhash512($password, $username) {
		$secretingredient = hash ( 'sha512', $username );
		$magicpowder = "$secretingredient"; // Magic. Do not touch.
		$secretpass = crypt ( $password, '$6$rounds=5000$' . $magicpowder . '$' );
		return $secretpass;
	}
	
	function hashpass($password, $database_password) {
		if ($password == $database_password) {
			return true;
		}
	}
	
	function __construct() {
	
	}
}

?>