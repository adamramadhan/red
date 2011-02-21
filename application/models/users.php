<?php  

class ModelUsers extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	// @todo seharusnya model = 1 table kalo user ya user aja
	// jangan di campur ini ada product lah follower lah, nanti dibenerin
	public $database = 'application';
	
	function register( $data ){
		$data = $this->insert('users',$data);
		return $data;
	}
	
	function userexist( $username ){
		$data = $this->fetch('SELECT username FROM users WHERE username = :username LIMIT 1', array( 'username' => $username));
		return $data;
	}
	
	function uidexist( $uid ){
		$data = $this->fetch("SELECT uid FROM users WHERE uid = :uid LIMIT 1", array ( 'uid' => $uid));
		return $data;
	}
	
	function companyexist( $company ){
		$data = $this->fetch('SELECT name FROM users WHERE name = :name LIMIT 1', array( 'name' => $company));
		return $data;
	}

	/**
	 * GET USER DATA
	 * gets the user data from the
	 * database. still doing some research
	 * @param string $data
	 * @param string $type 
	 * @return uid, username, name, and password.
	 * @author Adam Ramadhan
	 * @example $this->model->users->getData($uid);
	 */	
	function getData($data){
		
		# the data is uid
		if (is_numeric($data)) 
		{
			$data = $this->fetch('SELECT uid, username, name, address, phone, email, logo, image_seal, information, role, twitter, yahoo, facebook,
			password FROM users WHERE uid = :uid LIMIT 1', array( 'uid' => $data));
		}
		
		# the data is username
		if (is_string($data)) 
		{
			$data = $this->fetch('SELECT uid, username, name, address, phone, email, logo, image_seal, information, role, twitter, yahoo, facebook,
			password FROM users WHERE username = :username LIMIT 1', array( 'username' => $data));			
		}

		return $data;
	}
	function getRole($role = 0, $limit = 10){
		$data = $this->fetchAll("SELECT uid, username, name, phone, role 
		password FROM users WHERE role = $role LIMIT $limit");	
		return $data;	
	}
	
	function updateData($data){
		if (isset($data['logo'])) {
			$update = $this->query("UPDATE users SET 
					address = :address,
					email = :email,
					phone = :phone,
					logo = :logo
					WHERE uid = :uid", $data);		
		}
		
		if (!isset($data['logo'])) {
			$update = $this->query("UPDATE users SET 
					address = :address,
					email = :email,
					phone = :phone
					WHERE uid = :uid", $data);		
		}
		return $update;		
	}

	function updateFrontPage($data){
		$edit = $this->query("UPDATE users SET 
				information = :information
				WHERE uid = :uid", $data);
		return $edit;
	}
	
	function getDataConnection($uid){
		$connection = $this->fetch('SELECT twitter, yahoo, facebook FROM users WHERE uid = :uid LIMIT 1', array( 'uid' => $uid));
		return $connection;
	}
	
	function updateConnections($data){
		$update = $this->query("UPDATE users SET 
	    yahoo = :yahoo,
	    twitter = :twitter,
	    facebook = :facebook
	    WHERE uid = :uid", $data);
	    return $update;
	}
	
	function addProduct($data){
		$status = $this->insert( 'products', $data );
		return $status;
	}
	
	function listProducts($uid,$limit = 40){
		$list = $this->fetchAll("SELECT pid, name, information, image, image_tumb, tag, price 
		FROM products WHERE uid = :uid ORDER BY pid DESC LIMIT $limit", array( 'uid' => $uid));
		return $list;
	}
	
	function getProductUID( $pid ){
		$userproduct = $this->fetch('SELECT uid FROM products WHERE pid = :pid LIMIT 1', array('pid' => $pid));
		return $userproduct;
	}
	
	function getProductIMG( $pid ){
		$images = $this->fetch( 'SELECT image_tumb, image FROM products WHERE pid = :pid LIMIT 1', 
		array('pid' => $pid));
		return $images;
	}
	
	function delProduct( $pid ){
		$status = $this->query( "DELETE FROM products WHERE pid = :pid", array('pid' => $pid ));
		return $status;
	}
	
	function verifiedUid( $data ){
		$update = $this->query("UPDATE users SET
		image_seal = :image_seal, 
	    role = 1
	    WHERE uid = :uid", $data);
	    return $update;		
	}
}



?>