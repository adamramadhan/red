<?php  

class Social Extends Application
{
	function __construct()
	{
		$this->library('sessions');
	}	
	
	#default page
	function follow(){
		if (is_numeric($_GET['id']) && is_get('ref')) {
			$this->model('social');
			$data = $this->model->social->is_following($this->sessions->get('uid'),$_GET['id']);

			# SETTING UP FOR FOLLOW
			$f['BUID'] = $_GET['id'];
			$f['AUID'] = $this->sessions->get('uid');
			
			if (empty($data)) {
				$this->model->social->follow($f);
				redirect('/'.$_GET['ref']);
			}
		}
	}

	function unfollow(){
		if (is_numeric($_GET['id']) && is_get('ref')) {
			$this->model('social');
			$data = $this->model->social->is_following($this->sessions->get('uid'),$_GET['id']);
			
			if (!empty($data)) {
				$this->model->social->unfollow($_GET['id']);
				redirect('/'.$_GET['ref']);
			}
		}
	}
}


?>