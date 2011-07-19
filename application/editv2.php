<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class editv2 extends Application {
	
	/**
	 * WWW.NETWORKS.CO.ID/EDIT
	 * where global things happens
	 * inside this domain.
	 */
	 
	function __construct() {

		# BOOTSTRAP
		$this->library ( 'sessions' );
		$this->library ( 'validation' );
		$this->helper ( 'forms' );
		$this->helper ( 'active' );
		
		if (! $this->sessions->get ( 'uid' )) {
			redirect ( '/404' );
			die ();
		}

		# ASSETS
		# hook ini berfungsi di semua function
		# tadinya mau kaya $this->preCSShooks[] = 'jquery'
		# jadi tiap halaman bisa beda2, masalahnya contstuct cuma
		# di jalakan sekali saja. jadi harus mencari cara lain.

		$this->preCSShooks = array(
			'framework',
			'netcoid.v1',
			'users'
		);

		$this->preJShooks = array(
			'jquery',
			'jquery-ui-1.8.14.custom.min'
		);

		$this->postJShooks = array(
			'middleware/jquery/jquery.pjax',
			'users.v1'
		);
	}

	# sebuah contoh control terbaru
	function skel(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas

		# START LOGIC

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {}
		if (is_ajax()) {}		
	}

	function EditProfile(){

		# START BOOTSTRAP
		$this->middleware ( 'googlemaps', 'googlemaps' );
		$this->middleware ( 'verotimage', 'upload' );
		$this->model ( 'users' );
		$data ['user'] = $this->model->users->getData ( $this->sessions->get ( 'uid' ) );

		# START LOGIC
		if (! empty ( $data ['user'] ['address'] )) {
			$this->googlemaps->init ( array ('size' => '220x220', 'address' => $data ['user'] ['address'], 'language' => 'Disini', 'path' => STORAGE ) );
		}
		
		if (is_post ( 'edit' )) {
			
			# GET DATA
			$e ['address'] = $this->validation->safe ( $_POST ['address'] );
			$e ['phone'] = $_POST ['phone'];
			$e ['email'] = $_POST ['email'];
			$e ['uid'] = $this->sessions->get ( 'uid' );
			
			# VALIDATION
			$this->validation->required ( $e ['address'], l ( 'edit_address_error' ) );
			$this->validation->regex ( $e ['phone'], '/^[0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12})$/', l ( 'register_phone_error' ) );
			$this->validation->regex ( $e ['email'], '/^[a-zA-Z0-9-_.]+@([a-zA-Z0-9-_]{1,67}\.){1,5}[a-zA-Z]{2,4}$/', l ( 'edit_email_error' ) );
			
			if (! sizeof ( $this->validation->errors )) {
				
				# DEL IMAGE ( SHOULD BE WHEN CHANGE ADDRESS )
				if ($e ['address'] !== $data ['user'] ['address']) {
					$image = STORAGE . DS . $this->sessions->get ( 'uid' ) . DS . 'staticmap.png';
					if (file_exists ( $image )) {
						unlink ( $image );
					}
				}
				
				# IF IMAGE EXIST
				if (! empty ( $_FILES ['logo'] ['size'] )) {
					$this->validation->image ( $_FILES ['logo'], l ( 'edit_logo_error' ) );
					
					# START PLUGIN
					$savepath = STORAGE . DS . $e ['uid'];
					$randomid = md5 ( $e ['uid'] . 'redlogo' );
					$this->upload->vupload ( $_FILES ['logo'] );
					
					if ($this->upload->uploaded) {
						$this->upload->file_auto_rename = false;
						$this->upload->image_resize = true;
						$this->upload->file_overwrite = true;
						$this->upload->image_x = 220;
						$this->upload->image_ratio_y = true;
						$this->upload->file_new_name_body = 'logo' . $randomid;
						$this->upload->allowed = array ('image/*' );
						
						$this->upload->Process ( $savepath );
						if ($this->upload->processed) {
							/* give another edit variable for update */
							$e ['logo'] = $this->upload->file_dst_name;
							chmod ( $savepath . '/' . $e ['logo'], 0644 );
						}
						$this->upload->clean ();
					}
					
					$this->model->users->updateData ( $e );
					redirect ( '/edit/profile' );
				}
				
				/* IMAGE TIDAK */
				if (empty ( $_FILES ['logo'] ['size'] )) {
					$this->model->users->updateData ( $e );
					redirect ( '/edit/profile' );
				}
			}
		}

		# START VIEWS
		if (!is_ajax()) {
			$this->view ( 'usersv2/header', $data );
			$this->view ( 'usersv2/profile', $data );
			$this->view ( 'usersv2/footer', $data );
		}
		if (is_ajax()) {
			$this->view ( 'usersv2/profile', $data );
		}			
	}

	function ListProducts(){

		# START BOOTSTRAP
		$this->model ( 'users' );
		$this->model ( 'products' );

		# START LOGIC
		if (!is_get('t')) {
			$data['products'] = $this->model->products->listGroupByTag($this->sessions->get('uid'));
		}

		if (is_get('t')) {
			$data['products'] = $this->model->products->listByTag($this->sessions->get('uid'),$_GET['t']);

			# IF DEL REQUEST
			if (is_get ( 'd' )) {
				
				# GET PRODUCT UID
				$productuid = $this->model->products->getProductPID ( $_GET ['d'] );
				
				# IF PRODUCT UID = USER UID
				if ($productuid ['uid'] == $this->sessions->get ( 'uid' )) {
					
					# GET PRODUCT IMAGE INFORMATION FROM DB
					$image = $this->model->users->getProductIMG ( $_GET ['d'] );
					$imagepath = STORAGE . DS . $this->sessions->get ( 'uid' ) . DS;
					
					# DEL IMAGE
					if (unlink ( $imagepath . $image ['image_tumb'] ) && unlink ( $imagepath . $image ['image'] )) {
						$this->model->users->delProduct ( $_GET ['d'] );
						redirect ( '/edit/products?t='.$_GET['t'] );
					}
				}
			}
			# END DEL REQUEST

			if (empty($data['products'])) {
				redirect ( '/edit/products' );
				die ();
			}
		}

		# START VIEWS
		if (!is_get('t')) {
			if (!is_ajax()) {
				$this->view ( 'usersv2/header', $data );
				$this->view ( 'usersv2/productgroups', $data );
				$this->view ( 'usersv2/footer', $data );
			}
			if (is_ajax()) {
				$this->view ( 'usersv2/productgroups', $data );
			}
		}

		if (is_get('t')) {
			if (!is_ajax()) {
				$this->view ( 'usersv2/header', $data );
				$this->view ( 'usersv2/productlists', $data );
				$this->view ( 'usersv2/footer', $data );
			}
			if (is_ajax()) {
				$this->view ( 'usersv2/productlists', $data );
			}			
		}
	} 
}

?>