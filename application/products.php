<?php

class Products Extends Application
{
	function single()
	{
		if ($_GET['id']) {
			$this->model('products');
			$this->model('users');
			$this->library('sessions');
			$data['product'] = $this->model->products->getData($_GET['id']);
			$data['user'] = $this->model->users->getData($data['product']['uid']);
		}

		if (empty($data['product'])) {
			redirect( '/' );
		}

		// start beta plugin
		#$db['profile']['information'] = $validate->safe($db['profile']['information']);
		$data['product']['information'] = str_replace( "\n" , "<br/>" , $data['product']['information']);
		$data['product']['information'] = preg_replace('/\[i\]((?:[^\[]+|\[(?!i\]))*)\[i\]/', '<em>\1</em>', $data['product']['information']);
	    $data['product']['information'] = preg_replace('/\[b\]((?:[^\[]+|\[(?!b\]))*)\[b\]/', '<strong>\1</strong>', $data['product']['information']);
	    $data['product']['information'] = preg_replace('/\[img\]((?:[^\[]+|\[(?!img\]))*)\[img\]/', '<img src="\1" />', $data['product']['information']);

		$this->view('products/header');
		if (!$this->sessions->get('uid')) {
			$this->view('site/menu');
		}
		
		if ($this->sessions->get('uid')) {
			$this->view('users/menu-active');
		}
		$this->view('products/single',$data);
		$this->view('site/footer');	
	}
	
	function all(){
		$this->library('sessions');
		$this->model('products');
		
		// start pagenation
		if (!isset($_GET['offset'])) {
			$offset = '0';
			$page = 1;
		}
	
		if (is_get('offset')) {
			$page = '0';
			if (is_numeric($_GET['offset'])) {
				$offset = $_GET['offset']*20;
				$page = 1 + $_GET['offset'];
			}
		}
		// end pagenation

		if (!is_get('tag')) {
			$data['products'] = $this->model->products->listProducts($offset);
		}
	
		if (is_get('tag')) {
			# @todo harus di safe dulu
			$tag = $_GET['tag'];
			$data['products'] = $this->model->products->listProductsByTag($tag,$offset);
		}
		
		$data['count'] = count($data['products']);
		$data['tags'] = $this->model->products->getTags();
		
		$this->view('products/header');
		if (!$this->sessions->get('uid')) {
			$this->view('site/menu');
		}
		
		if ($this->sessions->get('uid')) {
			$this->view('users/menu-active');
		}
		$this->view('products/all',$data);
		$this->view('site/footer');			
	}
}


?>