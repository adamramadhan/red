<?php  

class ModelSocial extends Models
{
	public $database = 'application';
	
	function follow($data){
		$status = $this->insert( 'social', $data );	
		return $status;
	}
	
	function unfollow($buid){
		$status = $this->query( "DELETE FROM social WHERE buid = :buid", array('buid' => $buid) );
		return $status;
	}
	
	function is_following($person, $follow){
		$status = $this->fetch('SELECT BUID FROM social WHERE AUID = :uid AND BUID = :buid LIMIT 1', 
		array( 
			'uid' => $person,
			'buid' => $follow
		));
		return $status;
	}
	
	function CountFollowers($uid){
		$count = $this->fetch("SELECT COUNT(buid) as count FROM social WHERE buid = :uid", 
		array( 'uid' => $uid));
		return $count;
	}
}



?>