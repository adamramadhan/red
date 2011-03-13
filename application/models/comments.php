<?php  

class ModelComments extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function add($data){
		$data = $this->insert('comments',$data);
		return $data;
	}
	
	function del( $cid ){
		$status = $this->query( "DELETE FROM comments WHERE cid = :cid", array('cid' => $cid ));
		return $status;
	}

	function lastId(){
		$id = $this->start->lastInsertId();
		return $id;
	}

	function getUID($cid){
		$data = $this->fetch("SELECT uid FROM comments WHERE cid = :cid", 
		array( 'cid' => $cid));
		return $data;
	}
		
	function listCommentsByPid($pid){
		$data = $this->fetchAll("SELECT users.name, users.username, 
		comments.uid, comments.comment, comments.cid, comments.timecreate
		FROM comments, users WHERE comments.uid = users.uid AND comments.pid = :pid ORDER BY cid DESC LIMIT 20", array ( 'pid' => $pid ));
		return $data;
	}

	function countByPid($pid){
		$count = $this->fetch("SELECT COUNT(cid) FROM comments WHERE pid = :pid", 
		array( 'pid' => $pid));
		return $count;		
	}

	function countByNID($nid){
		$count = $this->fetch("SELECT COUNT(cid) FROM comments WHERE nid = :nid", 
		array( 'nid' => $nid));
		return $count;		
	}

	function listCommentsByNID($nid){
		$data = $this->fetchAll("SELECT users.name, users.username,
		comments.uid, comments.comment, comments.cid, comments.timecreate
		FROM comments, users WHERE comments.uid = users.uid AND comments.nid = :nid ORDER BY cid DESC LIMIT 20", array ( 'nid' => $nid ));
		return $data;		
	}
}

?>