<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class ModelSocial extends Models {
	public $database = 'application';
	
	function follow($data) {
		$status = $this->insert ( 'social', $data );
		return $status;
	}
	
	function unfollow($buid) {
		$status = $this->query ( "DELETE FROM social WHERE buid = :buid", array ('buid' => $buid ) );
		return $status;
	}
	
	function is_following($person, $follow) {
		$status = $this->fetch ( 'SELECT BUID FROM social WHERE AUID = :uid AND BUID = :buid LIMIT 1', array ('uid' => $person, 'buid' => $follow ) );
		return $status;
	}
	
	function CountFollowers($uid) {
		$count = $this->fetch ( "SELECT COUNT(BUID) as followers FROM social WHERE BUID = :uid", array ('uid' => $uid ) );
		return $count;
	}
	
	function CountFollowing($uid) {
		$count = $this->fetch ( "SELECT COUNT(AUID) as following FROM social WHERE AUID = :uid", array ('uid' => $uid ) );
		return $count;
	}
	
	function CountParters($uid) {
		$count = $this->fetch ( "SELECT COUNT(me.AUID) as partners
			FROM social AS me 
			INNER JOIN social AS friend 
			ON me.BUID = friend.AUID 
			WHERE me.AUID = friend.BUID 
			AND me.AUID = :uid", array ('uid' => $uid ) );
		return $count;
	}
	
	function is_parters($uid, $uidpartner) {
		$status = $this->fetch ( "SELECT me.FID as partners
			FROM social AS me 
			INNER JOIN social AS friend 
			ON me.BUID = friend.AUID 
			WHERE me.AUID = friend.BUID 
			AND me.AUID = :uid 
			AND friend.AUID = :uidpartner", array ('uid' => $uid, 'uidpartner' => $uidpartner ) );
		return $status;
	}
	
	# messages.suid = users.uid need some optimizin
	function CountSocial($uid) {
		$count = $this->fetch ( "SELECT 
		(SELECT COUNT(BUID) FROM social WHERE BUID = :uid) as followers
  		, (SELECT COUNT(AUID) FROM social WHERE AUID = :uid) as following
		", array ('uid' => $uid ) );
		return $count;
	}
}

?>