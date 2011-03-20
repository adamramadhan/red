<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
/**
 * ACTIVE 
 * @dependency sessions
 * @dependency application
 * @package default
 * @author DAMS
 */

class Active extends Application {
	function Menu($uid, $application) {
		if (! $uid) {
			$application->view ( 'site/menu' );
		}
		
		if ($uid) {
			$this->model ( 'all' );
			#message
			$data ['message'] = $this->model->all->fetch ( 'SELECT count(MID) as countmessage 
			FROM messages WHERE ruid = :uid AND type = 0 LIMIT 1', array ('uid' => $uid ) );
			
			#mentions
			if (config ( 'features/comments/mentions' )) {
				$data ['mentions'] = $this->model->all->fetch ( 'SELECT count(MID) as countmentions
				FROM mentions WHERE uid = :uid AND open = 0 LIMIT 1', array ('uid' => $uid ) );
			}
			
			$application->view ( 'users/menu-active-with-helper', $data );
		}
	}
}

?>