<?php  

class Verify Extends Application
{
	function __construct()
	{
		$this->library('sessions');
		$this->helper('active');
	}

	function index(){
		$this->view('verify/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		$this->view('verify/index');
		$this->view('site/footer');
	}

	function profile($username){
		$this->model('users');
		$data['user'] = $this->model->users->getData($username);
		# kalo tidak ada username yang ada kasih 404
		if (!$data['user']['username']) {
			redirect('/404');
		}
		
		$this->view('verify/header');
		$this->active->menu($this->sessions->get('uid'),$this);

		if ($data['user']['role'] == 0) {
			$this->view('verify/no',$data);
		}
		if ($data['user']['role'] == 1) {
			
			# if partner = show image if not then show status
			$this->model('social');
			# c = iso 8601 datetime
			$data['user']['seal_date'] = strftime("%d %B %Y",strtotime($data['user']['seal_date'] . ' +1 year'));
			$partner = $this->model->social->is_parters($this->sessions->get('uid'),$data['user']['uid']);
			#var_dump($partner);
			
			#fid partner & @todo need fix on 41
			if (!empty($partner)) {
				$this->view('verify/yes-partner',$data);
			}
			if ($this->sessions->get('uid') == $data['user']['uid']) {
				$this->view('verify/yes-me',$data);
			} 
			if (empty($partner)) {
			 	$this->view('verify/yes',$data);
			}
		}
		if ($data['user']['role'] == 5) {
			$this->view('verify/team',$data);
		}

		$this->view('site/footer');
	}
}
?>