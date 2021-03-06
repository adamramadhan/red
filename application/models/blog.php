<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelBlog extends Models {
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function getPosts($limit = 30) {
		$data = $this->fetchAll ( 'SELECT blog.title, blog.content, blog.content_html, blog.tag, users.name, users.uid, blog.timecreate, blog.nid, blog.status
		FROM blog, users WHERE users.uid = blog.uid ORDER BY nid DESC LIMIT ' . $limit );
		return $data;
	}

	function getPostsbyUID($uid, $status = 1, $limit = 30) {
		$data = $this->fetchAll ( 'SELECT blog.nid, blog.timecreate, blog.status, blog.title, blog.tag FROM blog, users  WHERE users.uid = blog.uid AND users.uid = '.$uid.' AND status = '.$status.' ORDER BY nid DESC LIMIT ' . $limit );
		return $data;
	}
	
	function getPost($id) {
		$data = $this->fetch ( 'SELECT blog.title, blog.content, blog.content_html, users.name, users.username,  blog.tag, blog.timecreate, blog.nid, blog.status
		FROM blog, users WHERE users.uid = blog.uid AND blog.nid = :nid ORDER BY nid DESC LIMIT 1', array ('nid' => $id ) );
		return $data;
	}
	
	function getLastPost($status = '0') {
		$data = $this->fetch ( 'SELECT blog.nid, blog.title, blog.content, blog.content_html, users.name, users.username, blog.tag, blog.timecreate, blog.nid, blog.status
		FROM blog, users WHERE users.uid = blog.uid AND status = '.$status.' ORDER BY nid DESC LIMIT 1' );
		return $data;
	}

	function listUnapprovedByUID($uid){
		$data = $this->fetch ( 'SELECT blog.nid, blog.status, blog.content, blog.content_html, blog.title, blog.tag
		FROM blog, users 
		WHERE users.uid = blog.uid
		AND blog.uid = :uid
		AND blog.status = 0
		ORDER BY nid DESC LIMIT 1', array ('uid' => $uid ) );
		return $data;		
	}
	
	function listNewsTitle() {
		$data = $this->fetchAll ( 'SELECT blog.nid, blog.title, blog.timecreate, blog.status
		FROM blog, users WHERE users.uid = blog.uid AND (status = 2 OR status = 4) ORDER BY nid DESC LIMIT 10' );
		return $data;
	}
	
	function setPosts($data) {
		// nanti diambil dari class ModelBlog blognya.
		$data = $this->insert ( 'blog', $data );
		return $data;
	}
	function delPost($nid) {
		$data = $this->query ( "DELETE FROM blog WHERE nid = :nid", array ('nid' => $nid ) );
		return $data;
	}
	
	function editPost($data) {
		$status = $this->query ( "UPDATE blog SET blog.title = :title, blog.content = :content, blog.content_html = :content_html, blog.timecreate = :timecreate,
		blog.uid = :uid, blog.tag = :tag WHERE blog.nid = :nid", $data );
		return $status;
	}
	function getHighlight($status){
		$data = $this->fetch ( 'SELECT blog.nid, blog.title, blog.content, blog.content_html, users.name, blog.tag, blog.timecreate, blog.status
		FROM blog, users WHERE users.uid = blog.uid AND status = :status ORDER BY nid DESC LIMIT 1', array ('status' => $status ) );
		return $data;		
	}
	function checkStatus($nid){
		$data = $this->fetch ( 'SELECT status FROM blog WHERE nid = :nid', array ('nid' => $nid ) );	
		return $data;	
	}

	function editStatus($data) {
		$update = $this->query ( "UPDATE blog SET
	    status = :status
	    WHERE nid = :nid", $data );
		return $update;
	}
}

?>