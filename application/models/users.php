<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelUsers extends Models {
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	// @todo seharusnya model = 1 table kalo user ya user aja
	// jangan di campur ini ada product lah follower lah, nanti dibenerin
	public $database = 'application';
	
	function register($data) {
		$data = $this->insert ( 'users', $data );
		return $data;
	}
	
	function userexist($username) {
		$data = $this->fetch ( 'SELECT username FROM users WHERE username = :username LIMIT 1', array ('username' => $username ) );
		return $data;
	}
	
	function uidexist($uid) {
		$data = $this->fetch ( "SELECT uid FROM users WHERE uid = :uid LIMIT 1", array ('uid' => $uid ) );
		return $data;
	}
	
	function companyexist($company) {
		$data = $this->fetch ( 'SELECT name FROM users WHERE name = :name LIMIT 1', array ('name' => $company ) );
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
	function getData($data) {
		
		# the data is uid
		if (is_numeric ( $data )) {
			$data = $this->fetch ( 'SELECT uid, username, name, address, phone, email, logo, seal_image, seal_date, information, role, twitter, yahoo, facebook,
			password FROM users WHERE uid = :uid LIMIT 1', array ('uid' => $data ) );
		}
		
		# the data is username
		if (is_string ( $data )) {
			$data = $this->fetch ( 'SELECT uid, username, name, address, phone, email, logo, seal_image, seal_date, information, role, twitter, yahoo, facebook,
			password FROM users WHERE username = :username LIMIT 1', array ('username' => $data ) );
		}
		
		return $data;
	}
	function getRole($role = 0, $limit = 10) {
		$data = $this->fetchAll ( "SELECT uid, username, name, phone, role 
		password FROM users WHERE role = $role LIMIT $limit" );
		return $data;
	}
	
	function getDataComments($username) {
		$data = $this->fetch ( 'SELECT uid, username, role, name FROM users WHERE username = :username LIMIT 1', array ('username' => $username ) );
		return $data;
	}
	
	function updateData($data) {
		if (isset ( $data ['logo'] )) {
			$update = $this->query ( "UPDATE users SET 
					address = :address,
					email = :email,
					phone = :phone,
					logo = :logo
					WHERE uid = :uid", $data );
		}
		
		if (! isset ( $data ['logo'] )) {
			$update = $this->query ( "UPDATE users SET 
					address = :address,
					email = :email,
					phone = :phone
					WHERE uid = :uid", $data );
		}
		return $update;
	}
	
	function updateFrontPage($data) {
		$edit = $this->query ( "UPDATE users SET 
				information = :information
				WHERE uid = :uid", $data );
		return $edit;
	}
	
	function getDataConnection($uid) {
		$connection = $this->fetch ( 'SELECT twitter, yahoo, facebook FROM users WHERE uid = :uid LIMIT 1', array ('uid' => $uid ) );
		return $connection;
	}
	
	function updateConnections($data) {
		$update = $this->query ( "UPDATE users SET 
	    yahoo = :yahoo,
	    twitter = :twitter,
	    facebook = :facebook
	    WHERE uid = :uid", $data );
		return $update;
	}
	
	function addProduct($data) {
		$status = $this->insert ( 'products', $data );
		return $status;
	}
	
	function listProducts($uid, $limit = 40) {
		$list = $this->fetchAll ( "SELECT pid, name, information, image, image_tumb, tag, price 
		FROM products WHERE uid = :uid ORDER BY pid DESC LIMIT $limit", array ('uid' => $uid ) );
		return $list;
	}
	
	function getProductIMG($pid) {
		$images = $this->fetch ( 'SELECT image_tumb, image FROM products WHERE pid = :pid LIMIT 1', array ('pid' => $pid ) );
		return $images;
	}
	
	function delProduct($pid) {
		$status = $this->query ( "DELETE FROM products WHERE pid = :pid", array ('pid' => $pid ) );
		return $status;
	}
	
	function verifiedUid($data) {
		$update = $this->query ( "UPDATE users SET
		seal_image = :seal_image,
		seal_date = :seal_date, 
	    role = 1
	    WHERE uid = :uid", $data );
		return $update;
	}
	
	function unverifyUid($data) {
		$update = $this->query ( "UPDATE users SET
		seal_image = NULL,
		seal_date = NULL,
	    role = 0
	    WHERE uid = :uid", $data );
		return $update;
	}

	function addReset($data){
		$update = $this->query ( "UPDATE users SET
		reset = :reset
	    WHERE username = :username", $data );
		return $update;	
	}

	function delReset($data){
		$update = $this->query ( "UPDATE users SET
		reset = NULL
	    WHERE username = :username", $data );
		return $update;	
	}

	function getReset($reset) {
		$data = $this->fetch ( 'SELECT username, name, uid FROM users 
		WHERE reset = :reset LIMIT 1', $reset );
		return $data;
	}

	function resetPassword($data){
		$update = $this->query ( "UPDATE users SET
		password = :password,
		reset = NULL
	    WHERE uid = :uid", $data );
		return $update;			
	}
	function listReset(){
		$data = $this->fetchAll ( "SELECT uid, username, reset FROM users WHERE reset IS NOT NULL" );
		return $data;		
	}

}

?>