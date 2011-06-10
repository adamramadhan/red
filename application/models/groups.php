<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelGroups extends Models {
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function register($data) {
		$data = $this->insert ( 'groups', $data );
		return $data;
	}

	function getGroups($limit = 10) {
		$data = $this->fetchAll ( 'SELECT gid, `group`, information, tag FROM groups 
		GROUP BY `tag` ORDER BY `group`, tag LIMIT ' . $limit );
		return $data;
	}

	function getAllGroups(){
		$tags = $this->fetchall ( "SELECT groups.`group`,  GROUP_CONCAT(DISTINCT groups.tag ORDER BY groups.tag) AS tags
		FROM groups  GROUP BY `group`");
		return $tags;		
	}

	function listGroups() {
		$data = $this->fetchAll ( 'SELECT `group` FROM groups GROUP BY `group`');
		return $data;
	}

	function listTagbyGroup($group) {
		$data = $this->fetchAll ( "SELECT `tag` FROM groups WHERE `group` = '$group'");
		return $data;
	}

	function getGroup($gid) {
		$data = $this->fetch ( "SELECT `group`, information, tag FROM groups WHERE gid = :gid", array ('gid' => $gid ) );
		return $data;
	}

	function getGroupByTag($tag) {
		$data = $this->fetch ( "SELECT `group`, information, tag, gid FROM groups WHERE tag = :tag", array ('tag' => $tag ) );
		return $data;
	}

	function del($gid) {
		$status = $this->query ( "DELETE FROM groups WHERE gid = :gid", array ('gid' => $gid ) );
		return $status;
	}	

	function updateGroup($data){
		$update = $this->query ( "UPDATE groups SET 
		`group` = :group,
		information = :information,
		tag = :tag
		WHERE gid = :gid", $data );
		return $update;
	}

}
?>