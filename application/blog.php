<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Blog extends Application {
	// set status
	//public $status = 'off';
	
	function __construct() {
		$this->model ( 'blog' );
		if (config ( 'features/comments/core' )) {

			# UJI COBA
			$this->helper('mobile');

			$this->model ( 'comments' );
			$this->model ( 'users' );
			$this->helper ( 'comments' );
			$this->library ( 'validation' );
			$this->helper ( 'forms' );
			$this->helper ( 'time' );
		}
		$this->library ( 'sessions' );
		$this->helper ( 'active' );
	}
	
	function index() {
		$data ['posts'] = $this->model->blog->listNewsTitle ();

		if (! is_get ( 'id' )) {

			# GET LATEST POST DATA WHERE STATUS 1
			$data ['post'] = $this->model->blog->getLastPost ('2');

			# 2 = Published Official Blog maka tunjukan 3 = Published Official Blog Highlight
			if ($data['post']['status'] == 2) {
				$data ['highlight'] = $this->model->blog->getHighlight('3');
			}

			# jika 4 = Netcoid HQ maka tunjukan 5 = Netcoid HQ highlight
			if ($data['post']['status'] == 4) {
				$data ['highlight'] = $this->model->blog->getHighlight('5');
			}
			
			#var_dump($data );var_dump($data ['highlight']);
			if (config('middleware/wmd')) {	
				$data ['post'] ['content'] = $data ['post'] ['content_html'];
			}

			# SEO START
			# @todo karena dihalaman depan ada konten yang sama gimana?
			# @todo coba dikasih concorual url atau apa gitu..
			
			$header ['title'] = "netcoid official blog &mdash; media peluang bisnis online";
			$header ['keywords'] = $data['post']['tag'];

			$this->view ( 'blog/header',$header );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'blog/blog-menu' );
			# SEO END
			
			# start comment
			if (config ( 'features/comments/core' )) {
				$data ['comments'] = $this->model->comments->listCommentsByNID ( $data ['post'] ['nid'] );
				$data ['count'] = $this->model->comments->countByNID ( $data ['post'] ['nid'] );
				if (is_post ( 'insert' )) {
					$c ['comment'] = $this->validation->safe ( $_POST ['comment'] );
					$c ['uid'] = $this->sessions->get ( 'uid' );
					$c ['nid'] = $data ['post'] ['nid'];
					# get the time from jakarta
					$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
					$c ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
					
					$this->validation->required ( $c ['comment'], l ( 'comment_empty' ) );
					
					if (! sizeof ( $this->validation->errors )) {
						$usernames = array ();
						$c ['comment'] = $this->comments->Render ( $c ['comment'], $this->model->users, $usernames );
						$this->model->comments->add ( $c );
						
						if (config ( 'features/comments/mentions' )) {
							$this->model ( 'mentions' );
							$cLastId = $this->model->comments->lastId ();
							$mentions = $this->comments->InsertMentions ( $cLastId, $usernames, $this->model->mentions );
						}
						redirect ( '/blog' );
					}
				}
			}
			# end comment
			

			#$data ['post'] ['content'] = str_replace ( "\n", "<br/>", $data ['post'] ['content'] );
			#$data ['post'] ['content'] = nl2br ( $data ['post'] ['content'] );
			$this->view ( 'blog/index', $data );
		
		}
		
		if (is_get ( 'id' )) {
			
			$data ['post'] = $this->model->blog->getPost ( $_GET ['id'] );

			# 2 = Published Official Blog maka tunjukan 3 = Published Official Blog Highlight
			if ($data['post']['status'] == 2) {
				$data ['highlight'] = $this->model->blog->getHighlight('3');
			}

			# jika 4 = Netcoid HQ maka tunjukan 5 = Netcoid HQ highlight
			if ($data['post']['status'] == 4) {
				$data ['highlight'] = $this->model->blog->getHighlight('5');
			}
		
			# IF STATUS 0 OR NOT PUBLISHED
			if ($data['post']['status'] == '0') {
				redirect('404');
			}
			
			if (config('middleware/wmd')) {	
				$data ['post'] ['content'] = $data ['post'] ['content_html'];
			}
						
			# SEO START
			$header ['title'] = $data['post']['title'];
			$header ['keywords'] = $data['post']['tag'];
			# CONTENT			
			#$text = strip_tags($data['post']['content']);
			#var_dump(strstr( $text, ".", true ));
			$this->view ( 'blog/header',$header );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'blog/blog-menu' );
			# SEO END
									
			# start comment
			if (config ( 'features/comments/core' )) {
				$data ['comments'] = $this->model->comments->listCommentsByNID ( $_GET ['id'] );
				$data ['count'] = $this->model->comments->countByNID ( $_GET ['id'] );
				if (is_post ( 'insert' )) {
					$c ['comment'] = $this->validation->safe ( $_POST ['comment'] );
					$c ['uid'] = $this->sessions->get ( 'uid' );
					$c ['nid'] = $_GET ['id'];
					# get the time from jakarta
					$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
					$c ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
					
					$this->validation->required ( $c ['comment'], l ( 'comment_empty' ) );
					
					if (! sizeof ( $this->validation->errors )) {
						$usernames = array ();
						$c ['comment'] = $this->comments->Render ( $c ['comment'], $this->model->users, $usernames );
						$this->model->comments->add ( $c );
						
						if (config ( 'features/comments/mentions' )) {
							$this->model ( 'mentions' );
							$cLastId = $this->model->comments->lastId ();
							$mentions = $this->comments->InsertMentions ( $cLastId, $usernames, $this->model->mentions );
						}
						redirect ( '/blog?id=' . $_GET ['id'] );
					}
				}
			}
			# end comment
			#$data ['post'] ['content'] = str_replace ( "\n", "<br/>", $data ['post'] ['content'] );
			#$data ['post'] ['content'] = nl2br ( $data ['post'] ['content'] );
			$this->view ( 'blog/index', $data );
		}
	$this->view ( 'blog/footer' );
	}
}

?>