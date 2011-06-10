<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelProducts extends Models {
	public $database = 'application';
	
	function getData($pid) {
		$data = $this->fetch ( "SELECT uid, name, information, `group`, image, image_tumb, tag, price 
		FROM products WHERE pid = :pid LIMIT 1", array ('pid' => $pid ) );
		return $data;
	}
	
	function updateData($data) {
		if (! empty ( $data ['image'] ) && ! empty ( $data ['image_tumb'] )) {
			$update = $this->query ( "UPDATE products SET 
					name = :name,
					information = :information,
					tag = :tag,
					price = :price,
					image = :image,
					`group` = :group,
					image_tumb = :image_tumb,
					timecreate = :timecreate	
					WHERE pid = :pid", $data );
		}
		
		if (empty ( $data ['image'] ) && empty ( $data ['image_tumb'] )) {
			$update = $this->query ( "UPDATE products SET 
					name = :name,
					information = :information,
					tag = :tag,
					price = :price,
					`group` = :group,
					timecreate = :timecreate
					WHERE pid = :pid", $data );
		}
		return $update;
	}
	
	function addProduct($data) {
		$status = $this->insert ( 'products', $data );
		return $status;
	}
	
	function listProductsByUID($uid, $offset = 0, $limit = 40) {
		$list = $this->fetchAll ( "SELECT uid, pid, name, information, image, image_tumb, `group`, tag, price 
		FROM products WHERE uid = :uid ORDER BY pid DESC LIMIT $offset, $limit", array ('uid' => $uid ) );
		return $list;
	}
	
	function listProductsByTag($tag, $offset = 0, $limit = 40) {
		$list = $this->fetchAll ( "SELECT products.pid, products.uid, products.name, products.information, products.image_tumb, price, users.name AS cname, users.username AS cusername, role
		FROM products,users WHERE tag = :tag AND products.uid = users.uid ORDER BY pid DESC LIMIT $offset, $limit", array ('tag' => $tag ) );
		return $list;
	}

	function listProductsByGroup($group, $offset = 0, $limit = 40) {
		$list = $this->fetchAll ( "SELECT products.pid, products.uid, products.name, products.information, products.image_tumb, price, users.name AS cname, users.username AS cusername, role
		FROM products,users WHERE `group` = :group AND products.uid = users.uid ORDER BY pid DESC LIMIT $offset, $limit", array ('group' => $group ) );
		return $list;
	}
	
	function getTags($limit = 100) {
		$tags = $this->fetchall ( "SELECT tag, COUNT(tag) AS counter
		FROM products GROUP BY tag ORDER BY counter DESC LIMIT $limit" );
		return $tags;
	}

	# @todo WARNING HEAVY LOAD!!! bayangin aja kalo ada 1000 orang buka product, kita fetch semua product! tampa limit
	function getAllGroups() {
		$tags = $this->fetchall ( "SELECT `group`, GROUP_CONCAT(DISTINCT tag ORDER BY tag) AS tags
		FROM products GROUP BY `group`");
		return $tags;
	}

	#function getAllTag($group) {
	#	$tags = $this->fetchall ( "SELECT DISTINCT(tag) FROM products WHERE `group` = $group");
	#	return $tags;
	#}
	
	function listProducts($offset = 0, $limit = 40) {
		$list = $this->fetchall ( "SELECT products.pid, products.uid, products.name, products.information, products.image_tumb, price, users.name AS cname, users.username AS cusername, role
		FROM products,users WHERE products.uid = users.uid ORDER BY pid DESC LIMIT $offset, $limit" );
		return $list;
	}
	
	function getProductPID($pid) {
		$userproduct = $this->fetch ( 'SELECT uid FROM products WHERE pid = :pid LIMIT 1', array ('pid' => $pid ) );
		return $userproduct;
	}
	
	function getProductIMG($pid) {
		$images = $this->fetch ( 'SELECT image_tumb, image FROM products WHERE pid = :pid LIMIT 1', array ('pid' => $pid ) );
		return $images;
	}
	
	function delProduct($pid) {
		$status = $this->query ( "DELETE FROM products WHERE pid = :pid", array ('pid' => $pid ) );
		return $status;
	}
	
	function listFromFollower($uid, $limit = 5) {
		#here
		$data = $this->fetchAll ( "SELECT users.uid, products.image_tumb, products.name AS product, users.name, products.pid, products.timecreate
		FROM products
		INNER JOIN users ON users.uid = products.uid 
		INNER JOIN social ON products.uid = social.buid
		WHERE social.auid = :uid ORDER BY pid DESC LIMIT " . $limit, array ('uid' => $uid ) );
		return $data;
	}
	
	# follower atau following? maximal 20 comment ( not done )
	function listFromFollowerWithComments($uid) {
		#here
		$data = $this->fetchAll ( "SELECT products.name AS product, comments.comment, users.name, products.pid, products.timecreate
		FROM products
		INNER JOIN users ON users.uid = products.uid 
		INNER JOIN social ON products.uid = social.buid
		WHERE social.auid = :uid", array ('uid' => $uid ) );
		return $data;
	}
	# follower atau following? maximal 20 comment ( not done )
	function listProductsCommentsFromFollower($uid) {
		$data = $this->fetchAll ( "SELECT comments.pid, users.name, users.username, comment
		FROM comments
		INNER JOIN users ON comments.uid = users.uid
		INNER JOIN products ON products.pid = comments.pid
		INNER JOIN social ON social.buid = products.uid
		WHERE social.auid = :uid ORDER BY comments.cid DESC LIMIT 20", array ('uid' => $uid ) );
		return $data;
	}
	
	function listCommentsByPID($pid, $limit) {
		$data = $this->fetchAll ( "SELECT comments.pid, users.name, users.username, comment
		FROM comments
		INNER JOIN users ON users.uid = comments.uid
		WHERE comments.pid = :pid ORDER BY cid DESC LIMIT " . $limit, array ('pid' => $pid ) );
		return $data;
	}

	# RESEARCH
	function getLastListFromFollower($uid){
		$data = $this->fetchAll ( "SELECT users.uid, products.image_tumb, products.name AS product, users.name, products.pid, products.timecreate
		FROM products
		INNER JOIN users ON users.uid = products.uid 
		INNER JOIN social ON products.uid = social.buid
		WHERE social.auid = :uid ORDER BY pid DESC LIMIT 1", array ('uid' => $uid ) );
		return $data;		
	}
	function getDiff($uid,$pid){
		$data = $this->fetch ( "SELECT COUNT(products.pid) AS updates
		FROM products
		INNER JOIN users ON users.uid = products.uid 
		INNER JOIN social ON products.uid = social.buid
		WHERE social.auid = :uid 
		AND products.pid > :pid
		ORDER BY pid DESC LIMIT 1", array ('uid' => $uid, 'pid' => $pid ) );
		return $data;		
	}
}

?>