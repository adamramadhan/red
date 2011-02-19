<?php  
/**
 * MEMCACHE CACHE
 * untuk sementara simple gini dulu
 * @author DAMS
 */

class Cache
{
	private $connect;
	function __construct()
	{
		$memcached = new Memcache;
		$memcached->connect(config('memcached/master/host'), config('memcached/master/port'));
		$this->connect = $memcached;
	}
	
	public function add($key, $value, $ttl = 60){
		$this->connect->add($key,$value,$ttl);
		return true;
	}
	
	public function get($key){
		return $this->connect->get($key);
	}
}

?>