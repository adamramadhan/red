<?php  

class ModelSocial extends Models
{
	public $database = 'application';
	
	function follow($data){
		$status = $this->insert( 'follow', $data );	
		return $status;
	}
	
	function unfollow($buid){
		$status = $this->query( "DELETE FROM follow WHERE buid = :buid", array('buid' => $buid) );
		return $status;
	}
	
	function is_following($person, $follow){
		$status = $this->fetch('SELECT BUID FROM follow WHERE AUID = :uid AND BUID = :buid LIMIT 1', 
		array( 
			'uid' => $person,
			'buid' => $follow
		));
		return $status;
	}
}



?>