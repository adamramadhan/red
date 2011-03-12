<?php  

class Comments Extends Application
{
	function __construct()
	{
		$this->library('sessions');
		$this->model('comments');
	}

	function index(){
		if (is_get('d')) {
			$data = $this->model->comments->getUID($_GET['d']);
			if (isset($_SERVER['HTTP_REFERER']) && $this->sessions->get('uid') == $data['uid']) {
				$this->model->comments->del($_GET['d']);
				redirect($_SERVER['HTTP_REFERER']);
			# security warning
			} else { redirect('/'); }
		}
	}
}


?>