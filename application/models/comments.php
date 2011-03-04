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
	
	function listCommentsByPid($pid){
		$data = $this->fetchAll("SELECT users.name, users.username, comments.comment, comments.cid, comments.timecreate
		FROM comments, users WHERE comments.uid = users.uid AND comments.pid = :pid ORDER BY cid DESC LIMIT 20", array ( 'pid' => $pid ));
		return $data;
	}

	function countByPid($pid){
		$count = $this->fetch("SELECT COUNT(cid) FROM comments WHERE pid = :pid", 
		array( 'pid' => $pid));
		return $count;		
	}
}

?>