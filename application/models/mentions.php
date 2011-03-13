<?php  

class ModelMentions extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function add($data){
		$data = $this->insert('mentions',$data);
		return $data;
	}

	function open($mid){
		$status = $this->query("UPDATE mentions SET 
		open = 1 WHERE mid = :mid", array ( 'mid' => $mid ));
		return $status;
	}

	function del( $mid ){
		$status = $this->query( "DELETE FROM mentions WHERE mid = :mid", array('mid' => $mid ));
		return $status;
	}

	function getDatafromCID($cid){
		$data = $this->fetch("SELECT uid, mid FROM mentions WHERE cid = :cid", 
		array( 'cid' => $cid));
		return $data;
	}
}

?>