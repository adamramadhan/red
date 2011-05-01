<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Ajax extends Application {
	function __construct(){
		$this->library ( 'sessions' );
		if (!$this->sessions->get('uid')) {
			exit ( 'Hello, api@networks.co.id' );			
		}
	}
	function index(){
		exit ( 'Hello, api@networks.co.id' );
	}

	function getProductDiff(){
		if (is_get('f')) {
			$this->model('products');
			if (is_numeric($_GET['f'])) {
				# FETCH UNTIL PID = 23. COUNT THE DIFFRENCE = X FETCH AS X OR LATEST 5 IF MORE THEN 5
				$data['ajax'] = $this->model->products->getDiff($this->sessions->get('uid'),$_GET['f']);
				$this->view ( 'ajax/ajax-data',$data);
			}
		}		
	}

	function getInformation(){
		
	}
}

?>