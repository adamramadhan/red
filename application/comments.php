<?php  
# dah dimatiin di routes
class Comments Extends Application
{
	function __construct()
	{
		$this->library('sessions');
	}

	function index(){
		if (is_get('d')) {
			$this->model('comments');
			$data = $this->model->comments->getUID($_GET['d']);
			if (isset($_SERVER['HTTP_REFERER']) && $this->sessions->get('uid') == $data['uid']) {
				$this->model->comments->del($_GET['d']);
				redirect($_SERVER['HTTP_REFERER']);
			# security warning
			} else { redirect('/'); }
		}

		if (is_get('o')) {
			$this->model('mentions');
			$data = $this->model->mentions->getDatafromCID($_GET['o']);
			if ($this->sessions->get('uid') == $data['uid']) {
				$this->model->mentions->open($data['mid']);
				redirect('/mentions');
			# security warning
			} else { redirect('/'); }
		}
	}
}


?>