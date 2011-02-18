<?php  

class ModelMessages extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function getListMessages($ruid)
	{	
		$data = $this->fetchAll("SELECT users.name, messages.mid, messages.suid, messages.subject, messages.timecreate
		FROM messages, users WHERE suid = users.uid AND ruid = :ruid AND type = 0 ORDER BY mid DESC LIMIT 20", array ( 'ruid' => $ruid ));
		return $data;
	}

	function getListArchives($ruid)
	{	
		$data = $this->fetchAll("SELECT users.name, messages.mid, messages.suid, messages.subject, messages.timecreate
		FROM messages, users WHERE suid = users.uid AND ruid = :ruid AND type = 1 ORDER BY mid DESC LIMIT 20", array ( 'ruid' => $ruid ));
		return $data;
	}
	
	function getMessageUid($mid){
		$uid = $this->fetch('SELECT ruid, type FROM messages WHERE mid = :mid LIMIT 1',  array('mid' => $mid));	
		return $uid;
	}
	
	function delMessage($mid){
		$status = $this->query( "DELETE FROM messages WHERE mid = :mid", array('mid' => $mid) );
		return $status;
	}
	
	function getMessage($mid){
		$data = $this->fetch('SELECT messages.suid, messages.message, messages.subject, messages.timecreate, users.name, users.phone
		FROM messages JOIN users ON messages.suid = users.uid WHERE mid = :mid LIMIT 1',  array('mid' => $mid));	
		return $data;
	}
	
	function to_type($mid,$type){
		$status = $this->query("UPDATE messages SET 
		type = :type WHERE mid = :mid", array ( 'mid' => $mid, 'type' => $type ));
		return $status;
	}
	
	function sendMessage($data){
		$status = $this->insert( 'messages', $data );
		return $status;
	}
	
	function countMessage($uid){
		$count = $this->fetch('SELECT count(MID) as countmessage 
		FROM messages WHERE ruid = :uid AND type = 0 LIMIT 1', array( 'uid' => $uid)); 
		return $count;
	}
}

?>