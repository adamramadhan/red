<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelBlog extends Models {
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function getPosts($limit = 10) {
		$data = $this->fetchAll ( 'SELECT blog.title, blog.content, blog.tag, users.name, users.uid, blog.timecreate, blog.nid
		FROM blog, users WHERE users.uid = blog.uid ORDER BY nid DESC LIMIT ' . $limit );
		return $data;
	}
	
	function getPost($id) {
		$data = $this->fetch ( 'SELECT blog.title, blog.content, users.name, blog.tag, blog.timecreate, blog.nid
		FROM blog, users WHERE users.uid = blog.uid AND blog.nid = :nid ORDER BY nid DESC LIMIT 1', array ('nid' => $id ) );
		return $data;
	}
	
	function getLastPost() {
		$data = $this->fetch ( 'SELECT blog.nid, blog.title, blog.content, users.name, blog.tag, blog.timecreate, blog.nid
		FROM blog, users WHERE users.uid = blog.uid ORDER BY nid DESC LIMIT 1' );
		return $data;
	}
	
	function listNewsTitle() {
		$data = $this->fetchAll ( 'SELECT blog.nid, blog.title
		FROM blog, users WHERE users.uid = blog.uid ORDER BY nid DESC LIMIT 10' );
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
		$status = $this->query ( "UPDATE blog SET blog.title = :title, blog.content = :content, blog.timecreate = :timecreate,
		blog.uid = :uid, blog.tag = :tag WHERE blog.nid = :nid", $data );
		return $status;
	}
}

?>