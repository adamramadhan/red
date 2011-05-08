<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );

/**
 * DONOTEDIT, temporary cacheing system
 * @version 100.20/3/2011
 * @package ENGINE/CORE
 * @author rama@networks.co.id
 * @tutorial wiki/missing.txt
 * @todo cacheing should be in models ?
 */
class Cache {
	private $connect;
	
	/**
	 * Dependency injectors and Class init
	 */
	function __construct() {
		$memcached = new Memcache ();
		$memcached->connect ( config ( 'memcached/master/host' ), config ( 'memcached/master/port' ) );
		$this->connect = $memcached;
	}
	
	/**
	 * basic add function
	 * @param string $key
	 * @param array $value
	 * @param int $ttl
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function add($key, $value, $ttl = 60) {
		$this->connect->add ( $key, $value, $ttl );
		return true;
	}
	
	/**
	 * basic get function
	 * @param string $key
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function get($key) {
		return $this->connect->get ( $key );
	}

	/**
	 * basic flush function
	 * @author rama@networks.co.id
	 * @tutorial wiki/missing.txt
	 */
	public function flush(){
		return $this->connect->flush();
	}
}

?>