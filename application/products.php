<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Products extends Application {
	function __construct() {
		$this->library ( 'sessions' );
		$this->model ( 'products' );
		$this->model ( 'users' );
		$this->helper ( 'active' );
	}
	
	function single() {
		if ($_GET ['id']) {
			$data ['product'] = $this->model->products->getData ( $_GET ['id'] );
			$data ['user'] = $this->model->users->getData ( $data ['product'] ['uid'] );
		}
		
		if (empty ( $data ['product'] )) {
			redirect ( '/' );
		}
		
		if (config ( 'features/comments/core' )) {
			$this->helper ( 'forms' );
			$this->helper ( 'time' );
			$this->helper ( 'comments' );
			$this->library ( 'validation' );
			$this->model ( 'comments' );
			
			$data ['comments'] = $this->model->comments->listCommentsByPid ( $_GET ['id'] );
			$data ['count'] = $this->model->comments->countByPid ( $_GET ['id'] );
			
			if (is_post ( 'insert' )) {
				$c ['comment'] = $this->validation->safe ( $_POST ['comment'] );
				$m ['comment'] = $c ['comment'];
				$c ['uid'] = $this->sessions->get ( 'uid' );
				$c ['pid'] = $_GET ['id'];
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
					
					redirect ( '/product?id=' . $_GET ['id'] );
				}
			}
		}
		
		// start beta plugin
		#$db['profile']['information'] = $validate->safe($db['profile']['information']);
		$data ['product'] ['information'] = str_replace ( "\n", "<br/>", $data ['product'] ['information'] );
		$data ['product'] ['information'] = preg_replace ( '/\[i\]((?:[^\[]+|\[(?!i\]))*)\[i\]/', '<em>\1</em>', $data ['product'] ['information'] );
		$data ['product'] ['information'] = preg_replace ( '/\[b\]((?:[^\[]+|\[(?!b\]))*)\[b\]/', '<strong>\1</strong>', $data ['product'] ['information'] );
		$data ['product'] ['information'] = preg_replace ( '/\[img\]((?:[^\[]+|\[(?!img\]))*)\[img\]/', '<img src="\1" />', $data ['product'] ['information'] );

		# START SEO
		# @topo awas xss
		$header ['title'] = $data['product']['name'] .' by '.$data['user']['name'];
		# END SEO
	
		$this->view ( 'products/header-single', $header );
		$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
		$this->view ( 'products/single', $data );
		$this->view ( 'site/footer' );
	}
	
	function all() {
		// start pagenation
		if (! isset ( $_GET ['offset'] )) {
			$data['offset'] = '0';
			$data['page'] = 1;
		}
		
		if (is_get ( 'offset' )) {
			$page = '0';
			if (is_numeric ( $_GET ['offset'] )) {
				$data['offset'] = $_GET ['offset'] * 16;
				$data['page'] = 1 + $_GET ['offset'];
			}
		}
		// end pagenation
		$this->model('groups');

		# PAGEINATION TEST
		# GET products/groups
		$current_group = func_get_args();
		if (!empty($current_group[0])) {

			$data['current_group'] = $current_group[0];
			$data['tags'] = $this->model->groups->listTagbyGroup($data['current_group']);

			if (empty($current_group[1])) {
				$data ['products'] = $this->model->products->listProductsByGroup ( $data['current_group'], $data['offset'] );
			}
			
			if (!empty($current_group[1])) {
				# @todo harus di safe dulu
				$data ['products'] = $this->model->products->listProductsByTag ( $current_group[1], $data['offset'] );

				# added groups
				$data ['group'] = $this->model->groups->getGroupByTag( $current_group[1]);
			}
		}
		# END BETA

		# SET search product by group
		if (empty($current_group)) {
			$data ['products'] = $this->model->products->listProducts ( $data['offset'] );
		}

		$data ['count'] = count ( $data ['products'] );
		# yang ini berdasarkan yang ada di group
		#$data ['groups'] = $this->model->groups->getAllGroups ();
		# yang ini berdasarkan yang ada di product
		$data ['groups'] = $this->model->products->getAllGroups();
		#var_dump($data['groups'],$data['allgroups']);
		
		if(is_ajax()) {
			$this->view ( 'products/ajax-productlist', $data );	
		} 

		if (!is_ajax()) {
			$this->view ( 'products/header' );
			$this->active->menu ( $this->sessions->get ( 'uid' ), $this );
			$this->view ( 'products/all', $data );	
			$this->view ( 'site/footer' );	
		}	
	}
}

?>