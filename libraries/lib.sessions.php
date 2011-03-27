<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
/**
 * SESSIONS library
 * @author DAMS
 * SET
 * GET
 * DEL
 * FLUSH
 */

class Sessions {
	private $config;
	public function set($key, $value) {
		if (isset ( $_SESSION [$key] )) {
			return false;
		}
		
		if (! isset ( $_SESSION [$key] )) {
			$_SESSION [$key] = $value;
			return true;
		}
	}
	
	public function get($key) {
		if (! isset ( $_SESSION [$key] )) {
			return false;
		}
		
		if (isset ( $_SESSION [$key] )) {
			return $_SESSION [$key];
		}
	}
	
	public function del($key) {
		if (! isset ( $_SESSION [$key] )) {
			return false;
		}
		if (isset ( $_SESSION [$key] )) {
			unset ( $_SESSION [$key] );
			return true;
		}
	}
	
	public function flush() {
		// do we still need this?
		$_SESSION = array ();
		session_destroy ();
		$this->refresh ();
	}
	
	public function refresh() {
		session_regenerate_id ( true );
	}
	
	function __construct() {
		$this->config = config ( 'sessions' );
		
		# doing some importing things
		# session_name("NETCOID");
		ini_set ( 'session.name', $this->config ['session_name'] );
		ini_set ( 'session.cookie_domain', $this->config ['cookie_domain'] );
		ini_set ( 'session.cookie_secure', $this->config ['cookie_secure'] );
		ini_set ( 'session.cookie_httponly', $this->config ['cookie_httponly'] );
		ini_set ( 'session.gc_probability', $this->config ['gc_probability'] );
		ini_set ( 'session.gc_divisor', $this->config ['gc_divisor'] );
		ini_set ( 'session.hash_function', $this->config ['hash_function'] );
		ini_set ( 'session.gc_maxlifetime', $this->config ['gc_maxlifetime'] );
		# start the engine
		session_start ();
	}
}
?>