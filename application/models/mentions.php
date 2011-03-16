<?php  

class ModelMentions extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function add($data){
		$data = $this->query('INSERT INTO mentions ( uid, cid, open ) VALUES ' . implode(',', $data));
		return $data;
	}

	function open($mid,$uid){
		$status = $this->query("UPDATE mentions SET 
		open = 1 WHERE mid = :mid and uid = :uid", array ( 'mid' => $mid, 'uid' => $uid ));
		return $status;
	}

	function del( $mid ){
		$status = $this->query( "DELETE FROM mentions WHERE mid = :mid", array('mid' => $mid ));
		return $status;
	}

	function getDatafromCIDandUID($cid,$uid){
		$data = $this->fetch("SELECT uid, mid FROM mentions WHERE cid = :cid and uid = :uid", 
		array( 'cid' => $cid, 'uid' => $uid));
		return $data;
	}
}

?>