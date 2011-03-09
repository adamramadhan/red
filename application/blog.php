<?php  

class Blog Extends Application
{
	// set status
	//public $status = 'off';
	
	function __construct()
	{
		$this->model('blog');
		if (config('features/comments')){
			$this->model('comments');
			$this->library('validation');
			$this->helper('forms');
			$this->helper('time');
		}
		$this->library('sessions');
		$this->helper('active');
	}
	
	function index()
	{
		# sampe sini
		$data['posts'] = $this->model->blog->listNewsTitle();
		$this->view('blog/header');	
		$this->active->menu($this->sessions->get('uid'),$this);
		
		$this->view('blog/blog-menu');		
		if (!is_get('id')) {	
			$data['post'] = $this->model->blog->getLastPost();
			
			# start comment
			if (config('features/comments')){
				$data['comments'] = $this->model->comments->listCommentsByNID($data['post']['nid']);
				$data['count'] = $this->model->comments->countByNID($data['post']['nid']);
				if (is_post('insert')) {
					$c['comment'] = $this->validation->safe($_POST['comment']);
					$c['uid'] = $this->sessions->get('uid');
					$c['nid'] = $data['post']['nid'];
					# get the time from jakarta
					$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
					$c['timecreate'] = $time->format('Y-m-d H:i:s');	
					
					$this->validation->required($c['comment'],l('comment_empty'));
					
					if (!sizeof($this->validation->errors)) {
						$this->model->comments->add($c);
						redirect('/blog');
					}
				}
			}
			# end comment
					
			$data['post']['content'] = str_replace( "\n" , "<br/>" , $data['post']['content']);
			$this->view('blog/index',$data);



		}
		
		if (is_get('id')) {
			
			$data['post'] = $this->model->blog->getPost($_GET['id']);

			# start comment
			if (config('features/comments')){
				$data['comments'] = $this->model->comments->listCommentsByNID($_GET['id']);
				$data['count'] = $this->model->comments->countByNID($_GET['id']);
				if (is_post('insert')) {
					$c['comment'] = $this->validation->safe($_POST['comment']);
					$c['uid'] = $this->sessions->get('uid');
					$c['nid'] = $_GET['id'];
					# get the time from jakarta
					$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
					$c['timecreate'] = $time->format('Y-m-d H:i:s');	
					
					$this->validation->required($c['comment'],l('comment_empty'));
					
					if (!sizeof($this->validation->errors)) {
						$this->model->comments->add($c);
						redirect('/blog?id='. $_GET['id']);
					}
				}
			}
			# end comment

			$data['post']['content'] = str_replace( "\n" , "<br/>" , $data['post']['content']);

			$this->view('blog/index',$data);
		}
		$this->view('blog/footer');
	}
	
	function tag(){
		
	}
}

?>