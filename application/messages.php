<?php  

class Messages Extends Application
{
	function __construct()
	{
		$this->library('sessions');
		$this->helper('active');
		if (!$this->sessions->get('uid')) {
			redirect('/404');
			die();
		};
	}
	
	function all(){
		$this->model('messages');
		
		$this->view('users/header');
		$this->active->menu($this->sessions->get('uid'),$this);
		
		if (!is_get('id') && !is_get('mid')) {
			$this->helper('time');
			$data['messages'] = $this->model->messages->getListMessages($this->sessions->get('uid'));
			$data['archives'] = $this->model->messages->getListArchives($this->sessions->get('uid'));
			$this->view('users/messages-list',$data);

		}
		
		# IF DELETE REQUEST
		if (is_get('d')) {
			$messageuid = $this->model->messages->getMessageUid($_GET['d']);
			
		    # IF RECEVER UID = SAME AS SESSION UID = HIS MESSAGE THEN
			if ( $messageuid['ruid'] == $this->sessions->get('uid')) {
		    	$this->model->messages->delMessage($_GET['d']);
		    	redirect( '/messages' );
			}
		}
		
		# IF SEE MESSAGE REQUEST
		if (is_get('mid') && !is_get('id')) {
			$messageuid = $this->model->messages->getMessageUid($_GET['mid']);

		    # IF RECEVER UID = SAME AS SESSION UID = HIS MESSAGE THEN
			if ( $messageuid['ruid'] == $this->sessions->get('uid')) {
				$data['message'] = $this->model->messages->getMessage($_GET['mid']);
				$data['time'] = new DateTime($data['message']['timecreate']);
			
				# IS OPENED = MAKE IT ARCHIVE = TYPE 0 TO 1
				if ( $messageuid['type'] == 0 ) {
					# to type mid, type id(numeric)
					$this->model->messages->to_type($_GET['mid'],1);
				}
			
			$this->view('users/messages-single',$data);
			}
			
			# IF RECEVER UID = SAME AS SESSION UID = HIS MESSAGE THEN
			if ( $messageuid['ruid'] !== $this->sessions->get('uid')) {
				redirect('/');
			}
		}
		
	
		if (is_get('id') && !is_get('mid')) {
			$this->model('users');
			$this->library('validation');
			$this->helper('forms');			
			
			# CHECK IF THE RECEVER IS THERE IF NOT REDIRECT
			$user = $this->model->users->uidexist($_GET['id']);
			if (empty($user)) {
				redirect( '/' );
			}
			
			# IF THERE IS A USER THEN SEND DATA
			if (is_post('send') && !empty($user)) {
				
				# GET DATA FROM POST
				$m['RUID'] = $_GET['id'];		
				$m['SUID'] = $this->sessions->get('uid');
				$m['subject'] = $this->validation->safe($_POST['subject']);
				$m['message'] = $this->validation->safe($_POST['message']);
				$m['type'] = '0'; #notopen		
				
				# get the time from jakarta
				$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
				$m['timecreate'] = $time->format('Y-m-d H:i:s');
				
				if (empty($m['subject'])) {
					$m['subject'] = l('nosubject');
				}
				
				$this->validation->required($m['message'],l('message_empty'));
				
				if (!sizeof($this->validation->errors)) {
					$this->model->messages->sendMessage($m);
					redirect('/');
				}
			}	
			
			$this->view('users/messages-send');			
		}
		
	$this->view('site/footer');
	}
}


?>