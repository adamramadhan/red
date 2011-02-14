<?php  

class Edit Extends Application
{
	/**
	 * WWW.NETWORKS.CO.ID/EDIT
	 * where global things happens
	 * inside this domain.
	 */
	function __construct()
	{
		$this->library('sessions');
		$this->library('validation');
		$this->helper('forms');

		if (!$this->sessions->get('uid')) {
			redirect('/404');
			die();
		};
	}
	
	/**
	 * WWW.NETWORKS.CO.ID/EDIT/PROFILE
	 * where users edit their basic profile
	 * information.
	 */
	function profile(){
		# INIT
		$this->middleware('googlemaps','googlemaps');
		$this->middleware('verotimage','upload');
		$this->model('users');
		$data['user'] = $this->model->users->getData($this->sessions->get('uid'));
		
		if (!empty($data['user']['address'])) {
			$this->googlemaps->init(array(
				'size' => '220x220',
				'address' => $data['user']['address'],
				'language' => 'Disini',
				'path' => STORAGE,
			));
		}	

		if (is_post('edit')) {
			
			#GET DATA
			$e['address'] = $this->validation->safe($_POST['address']);
			$e['phone'] = $_POST['phone'];
			$e['email'] = $_POST['email'];
			$e['uid'] = $this->sessions->get('uid');
			
			# VALIDATION
			$this->validation->required($e['address'],l('edit_address_error'));
			$this->validation->regex($e['phone'],'/^[0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12})$/',l('register_phone_error'));
			$this->validation->regex($e['email'],'/^[a-zA-Z0-9-_.]+@([a-zA-Z0-9-_]{1,67}\.){1,5}[a-zA-Z]{2,4}$/',l('edit_email_error'));
			
			if (!sizeof($this->validation->errors)) {

				# DEL IMAGE ( SHOULD BE WHEN CHANGE ADDRESS )
				if ($e['address'] !== $data['user']['address']) {
					$image = STORAGE . DS . $this->sessions->get('uid') . DS .'staticmap.png';
					if (file_exists($image)) {
						unlink($image);
					}
				}
				
				# IF IMAGE EXIST
				if (!empty($_FILES['logo']['size'])) {
					$this->validation->image($_FILES['logo'],l('edit_logo_error'));
					
					# START PLUGIN
					$savepath = STORAGE . DS . $e['uid'];
					$randomid = md5($e['uid'].'redlogo');
					$this->upload->vupload($_FILES['logo']);

					if ($this->upload->uploaded) 
					{
				        $this->upload->file_auto_rename   = false;
				        $this->upload->image_resize       = true;
				        $this->upload->file_overwrite     = true;
				        $this->upload->image_x            = 220; 
				        $this->upload->image_ratio_y      = true;
				        $this->upload->file_new_name_body = 'logo' . $randomid;
				        $this->upload->allowed            = array(
				            'image/*'
				        );	
				        
				        $this->upload->Process($savepath);
				        if ($this->upload->processed) 
				        {
				    		/* give another edit variable for update */
				        	$e['logo'] = $this->upload->file_dst_name;
				        }		        
		        		$this->upload->clean();
					}
			
					$this->model->users->updateData($e);
					redirect('/edit/profile');	
				}
				
				/* IMAGE TIDAK */
				if (empty($_FILES['logo']['size'])) {
					$this->model->users->updateData($e);
					redirect('/edit/profile');
				}	
			}		
		}
		
		$this->view('users/header');
		$this->view('users/menu-active',$data);
		$this->view('users/profile',$data);
		$this->view('site/footer');	
	}
	
	function frontbox(){
		$this->model('users');
		$data['user'] = $this->model->users->getData($this->sessions->get('uid'));
		
		if (is_post('edit')) {
			$p['information'] = $this->validation->safe($_POST['informationbox']);
		    $p['uid'] = $this->sessions->get('uid');
		    
			if (!sizeof($this->validation->errors)) {
				$this->model->users->updateFrontPage($p);
				redirect('/edit/frontbox');				
			}		
		}
		
		$this->view('users/header');
		$this->view('users/menu-active',$data);
		$this->view('users/frontpage',$data);
		$this->view('site/footer');	
	}
	
	function connections(){
		$this->library('social');
		$this->model('users');
		$data['user'] = $this->model->users->getDataConnection($this->sessions->get('uid'));
		
		if (is_post('edit')) {
			$c['yahoo'] = $_POST['yahoo'];
			$c['twitter'] = $_POST['twitter'];
			$c['uid'] = $this->sessions->get('uid');
			
			# check if yahoo exist in post
			if (!empty($c['yahoo'])) {
				$this->validation->regex($c['yahoo'],'/^([a-zA-Z0-9_.\s]{6,40})(@yahoo.com|@ymail.com|@rocketmail.com)$/',l('connection_yahoo_error'));
			}

			# check if twitter exist in post			
			if (!empty($c['twitter'])) {	
				$this->validation->regex($c['twitter'],'/^[a-zA-Z0-9_]{1,20}+$/',l('connection_twitter_error'));
			}
			
			if (!sizeof($this->validation->errors)) {
				$this->model->users->updateConnections($c);
				redirect('/edit/connections');		
			}
		}
		$this->view('users/header');
		$this->view('users/menu-active');
		$this->view('users/connections',$data);
		$this->view('site/footer');	
	}
	
	function product(){

		$this->middleware('verotimage','upload');
		$this->model('users');
		
		# JIKA TAMBAH PRODUCT
		if (is_post('edit')) {
			
			# GET A NEW PRODUCT
			$p['name'] = $_POST['name'];
			$p['information'] = $this->validation->safe($_POST['informationbox']);
			$p['tag'] = $_POST['tag'];
			$p['price'] = $_POST['price'];
			$p['uid'] = $this->sessions->get('uid');
		
			# get the time from jakarta
			$time = new DateTime( NULL, new DateTimeZone('Asia/Jakarta'));
			$p['timecreate'] = $time->format('Y-m-d H:i:s');
			
			$this->validation->regex($p['name'],'/^[a-zA-Z0-9_\s#]{4,20}$/',l('product_name_error'));
			$this->validation->required($p['information'],l('product_description_error'));
			$this->validation->regex($p['tag'],'/^[a-zA-Z0-9]{3,15}+$/',l('product_tag_error'));
			$this->validation->regex($p['price'],'/^[0-9]{1,11}+$/',l('product_price_error'));
			$this->validation->required($_FILES['image']['size'],l('product_image_error'));
		
			if (!sizeof($this->validation->errors)) {
				
				# JIKA IMAGE ADA
				if (!empty($_FILES['image']['size'])) {
					$this->validation->image($_FILES['image'],l('product_image_error'));
					
					# START PLUGIN
					$this->upload->vupload($_FILES['image']);
					$savepath = STORAGE . DS . $p['uid'];
					$randomid = md5($p['uid'].'product');
					
					if ($this->upload->uploaded) 
					{
						// RAW IMAGE START
					    $this->upload->file_auto_rename = true;
					    // @todo important! 460 kan maksimalnya cuma gambarnya
		
						if ($this->upload->image_src_x > 460) {
							$this->upload->image_resize = true;
							$this->upload->image_ratio_y = true;
							$this->upload->image_x = 460;
						}
					   
					    $this->upload->file_name_body_pre = $this->sessions->get('uid') . 'raw' . $randomid;
					    $this->upload->allowed = array(
					    	'image/*'
					    );
				        $this->upload->Process($savepath);
				        
				        if ($this->upload->processed) 
				        {
				    		/* give another edit variable for update */
				        	$p['image'] = $this->upload->file_dst_name;
				        }		        
						// RAW IMAGE ENDS
						
						// TUMB IMAGE START	@todo sampe disini        
		                $this->upload->file_auto_rename = true;
		                $this->upload->image_resize = true;
		                $this->upload->image_x = 150; // width
		                $this->upload->image_y = 150; // height
					    $this->upload->image_ratio = true;	
		                $this->upload->file_name_body_pre = $this->sessions->get('uid') . 'tumb' . $randomid;
		                $this->upload->allowed = array(
		                    'image/*'
		                );	
		                			    
					    $this->upload->Process($savepath);
		
				        if ($this->upload->processed) 
				        {
				    		/* give another edit variable for update */
				        	$p['image_tumb'] = $this->upload->file_dst_name;
				        }	
					    // TUMB IMAGE ENDS
					    	        
				        $this->upload->clean();
					}
					
					$this->model->users->addProduct($p);
					redirect('/edit/products');
				}
			}
		}
	
		
		$this->view('users/header');
		$this->view('users/menu-active');
		$this->view('users/product');
		$this->view('site/footer');	
	}
	
	function products(){
		$this->model('users');
		$this->model('products');
		$data['products'] = $this->model->products->listProductsByUID($this->sessions->get('uid'));

		# IF DEL REQUEST
		if ( is_get('d') ) {
			
			# GET PRODUCT UID
		    $productuid = $this->model->users->getProductUID($_GET['d']);			
		   
		     # IF PRODUCT UID = USER UID
		    if ( $productuid['uid'] == $this->sessions->get('uid')) {
		    	
		    	# GET PRODUCT IMAGE INFORMATION FROM DB
		    	$image = $this->model->users->getProductIMG($_GET['d']);
		        $imagepath = STORAGE . DS .  $this->sessions->get('uid') . DS;
		        
		        # DEL IMAGE
		        if ( unlink( $imagepath.$image['image_tumb'] ) && unlink( $imagepath.$image['image'] ) ) {
		        	 $this->model->users->delProduct($_GET['d']);
		        	 redirect( '/edit/products' );
		    	}
			}
		}
		# END DEL REQUEST
		
		$this->view('users/header');
		$this->view('users/menu-active');
		$this->view('users/products',$data);
		$this->view('site/footer');	
	}
}


?>