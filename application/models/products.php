<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelProducts extends Models {
	public $database = 'application';
	
	function getData($pid) {
		$data = $this->fetch ( "SELECT uid, name, information, image, image_tumb, tag, price 
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
					image_tumb = :image_tumb,
					timecreate = :timecreate	
					WHERE pid = :pid", $data );
		}
		
		if (empty ( $data ['image'] ) && empty ( $data ['image_tumb'] )) {
			var_dump ( $data );
			$update = $this->query ( "UPDATE products SET 
					name = :name,
					information = :information,
					tag = :tag,
					price = :price,
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
		$list = $this->fetchAll ( "SELECT uid, pid, name, information, image, image_tumb, tag, price 
		FROM products WHERE uid = :uid ORDER BY pid DESC LIMIT $offset, $limit", array ('uid' => $uid ) );
		return $list;
	}
	
	function listProductsByTag($tag, $offset = 0, $limit = 40) {
		$list = $this->fetchAll ( "SELECT uid, pid, name, information, image, image_tumb, tag, price 
		FROM products WHERE tag = :tag ORDER BY pid DESC LIMIT $offset, $limit", array ('tag' => $tag ) );
		return $list;
	}
	
	function getTags($limit = 100) {
		$tags = $this->fetchall ( "SELECT tag, COUNT(tag) AS counter
		FROM products GROUP BY tag ORDER BY counter DESC LIMIT $limit" );
		return $tags;
	}
	
	function listProducts($offset = 0, $limit = 40) {
		$list = $this->fetchall ( "SELECT pid, uid, name, information, image_tumb, price 
		FROM products ORDER BY pid DESC LIMIT $offset, $limit" );
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
		$data = $this->fetchAll ( "SELECT products.name AS product, users.name, products.pid, products.timecreate
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
}

?>