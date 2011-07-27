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
		$this->library ( 'messenger' );
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
					$this->messenger->setMessage('Updated');
					redirect ( '/edit/profile' );
				}
				
				/* IMAGE TIDAK */
				if (empty ( $_FILES ['logo'] ['size'] )) {
					$this->model->users->updateData ( $e );
					$this->messenger->setMessage('Updated');
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
						$this->messenger->setMessage('Updated');
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

	function Products(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas
		$this->middleware ( 'verotimage', 'upload' );
		$this->model ( 'products' );
		$this->model('groups');

		# START LOGIC
		$data['groups'] = $this->model->groups->getAllGroups();

		# EDIT PAGE
		if (is_get ( 'e' )) {
			$data['product'] = $this->model->products->getData ( $_GET ['e'] );
			if (! empty ( $data ['product']['price'] )) {
				$data ['product']['price'] = sprintf ( "%d", $data ['product']['price'] );
			}
			
			#validate get data
			if ($data ['product']['uid'] !== $this->sessions->get ( 'uid' )) {
				redirect ( '/' );
			}
		}

		# ADD PRODUCT
		if (is_post ( 'edit' )) {

			# GET A NEW PRODUCT
			$p ['name'] = $_POST ['name'];
			$p ['information'] = $this->validation->safe ( $_POST ['informationbox'] );
			$p ['tag'] = $_POST ['tag'];
			$p ['price'] = $_POST ['price'];

			# GET GROUP FROM TAG 
			$pgroup = $this->model->groups->getGroupByTag($_POST['tag']);
			$p ['group'] = strtolower($pgroup['group']);

			# get the time from jakarta
			$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
			$p ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
			
			$this->validation->regex ( $p ['name'], '/^[a-zA-Z0-9_\s#]{4,20}$/', l ( 'product_name_error' ) );
			$this->validation->required ( $p ['information'], l ( 'product_description_error' ) );
			$this->validation->regex ( $p ['tag'], '/^[a-zA-Z0-9]{3,15}+$/', l ( 'product_tag_error' ) );
			$this->validation->regex ( $p ['price'], '/^[0-9]{1,11}+$/', l ( 'product_price_error' ) );
			$this->validation->required ( $p ['group'], l ( 'product_group_error' ) );


			if (!is_get ( 'e' )) {
				$this->validation->required ( $_FILES ['image'] ['size'], l ( 'product_image_error' ) );
			}
			
			if (! is_get ( 'e' )) {
				$this->validation->required ( $_FILES ['image'] ['size'], l ( 'product_image_error' ) );
				$p ['uid'] = $this->sessions->get ( 'uid' );
			}
			if (is_get ( 'e' )) {
				$p ['pid'] = $_GET ['e'];
			}

			$this->validation->image ( $_FILES ['image'], l ( 'product_image_error' ) );
			
			if (! sizeof ( $this->validation->errors )) {
				
				# JIKA IMAGE ADA
				if (! empty ( $_FILES ['image'] ['size'] )) {
					
					# START PLUGIN
					$this->upload->vupload ( $_FILES ['image'] );
					$savepath = STORAGE . DS . $this->sessions->get ( 'uid' );
					$randomid = md5 ( $this->sessions->get ( 'uid' ) . 'product' );
					
					if ($this->upload->uploaded) {
						// RAW IMAGE START
						# @todo fixed auto rename
						$this->upload->file_auto_rename = true;
						// @todo important! 460 kan maksimalnya cuma gambarnya	
						if ($this->upload->image_src_x > 460) {
							$this->upload->image_resize = true;
							$this->upload->image_ratio_y = true;
							$this->upload->image_x = 460;
						}
						
						$this->upload->file_name_body_pre = $this->sessions->get ( 'uid' ) . 'raw' . $randomid;
						$this->upload->allowed = array ('image/*' );
						$this->upload->Process ( $savepath );
						
						if ($this->upload->processed) {
							/* give another edit variable for update */
							$p ['image'] = $this->upload->file_dst_name;
							chmod ( $savepath . '/' . $p ['image'], 0644 );
						}
						// RAW IMAGE ENDS
						

						// TUMB IMAGE START	@todo sampe disini        
						$this->upload->file_auto_rename = true;
						$this->upload->image_resize = true;
						$this->upload->image_x = 150; // width
						$this->upload->image_y = 150; // height
						$this->upload->image_ratio = true;
						$this->upload->file_name_body_pre = $this->sessions->get ( 'uid' ) . 'tumb' . $randomid;
						$this->upload->allowed = array ('image/*' );
						
						$this->upload->Process ( $savepath );
						if ($this->upload->processed) {
							/* give another edit variable for update */
							$p ['image_tumb'] = $this->upload->file_dst_name;
							chmod ( $savepath . '/' . $p ['image_tumb'], 0644 );
						}
						// TUMB IMAGE ENDS
						$this->upload->clean ();
					}
				}
				
				# IF THERE IS NO EDIT
				if (! is_get ( 'e' )) {
					$this->model->products->addProduct ( $p );
					$this->messenger->setMessage('Updated');
					redirect ( '/edit/products' );
				}
				
				#IF THERE IS EDIT 
				if (is_get ( 'e' )) {
					if (! empty ( $p ['image'] ) && ! empty ( $p ['image_tumb'] )) {
						# GET PRODUCT IMAGE INFORMATION FROM DB
						$imagepath = STORAGE . DS . $this->sessions->get ( 'uid' ) . DS;
						unlink ( $imagepath . $data ['image'] );
						unlink ( $imagepath . $data ['image_tumb'] );
					}
					$this->model->products->updateData ( $p );
					$this->messenger->setMessage('Updated');
					redirect ( '/edit/products' );
				}
			} # ERROR ENDS
		} # IF POST EDIT


		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {
				$this->view ( 'usersv2/header', $data );
			if (! is_get ( 'e' )) {
				$this->view ( 'usersv2/product', $data );
			}
			if ( is_get ( 'e' )) {
				$this->view ( 'usersv2/editproduct', $data );
			}
			$this->view ( 'usersv2/footer', $data );
		}
		if (is_ajax()) {
			if (! is_get ( 'e' )) {
				$this->view ( 'usersv2/product', $data );
			}
			if ( is_get ( 'e' )) {
				$this->view ( 'usersv2/editproduct', $data );
			}
		}		
	}

	function EditFrontBox(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas
		$this->model ( 'users' );

		# START LOGIC
		$data ['user'] = $this->model->users->getData ( $this->sessions->get ( 'uid' ) );

		if (is_post ( 'edit' )) {
			$p ['information'] = $this->validation->safe ( $_POST ['informationbox'] );
			$p ['information_html'] = $_POST['js-middleware-wmd-output'];
			$p ['uid'] = $this->sessions->get ( 'uid' );

			if (! sizeof ( $this->validation->errors )) {
				$this->model->users->updateFrontPage ( $p );
				$this->messenger->setMessage('Updated');
				redirect ( '/edit/frontbox' );
			}
		}

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {
			$this->view ( 'usersv2/header', $data );
			$this->view ( 'usersv2/frontpage', $data );
			$this->view ( 'usersv2/footer', $data );
		}
		if (is_ajax()) {
			$this->view ( 'usersv2/frontpage', $data );
		}		
	}

	function EditConnections(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas
		$this->library ( 'social' );
		$this->model ( 'users' );

		# START LOGIC
		$data ['user'] = $this->model->users->getDataConnection ( $this->sessions->get ( 'uid' ) );
		
		if (is_post ( 'edit' )) {
			$c ['yahoo'] = $_POST ['yahoo'];
			$c ['twitter'] = $_POST ['twitter'];
			#validation
			$c ['facebook'] = $_POST ['facebook'];
			$c ['uid'] = $this->sessions->get ( 'uid' );
			
			# check if yahoo exist in post
			if (! empty ( $c ['yahoo'] )) {
				$this->validation->regex ( $c ['yahoo'], '/^([a-zA-Z0-9_.\s]{6,40})(@yahoo.com|@ymail.com|@rocketmail.com)$/', l ( 'connection_yahoo_error' ) );
			}
			
			# check if twitter exist in post			
			if (! empty ( $c ['twitter'] )) {
				$this->validation->regex ( $c ['twitter'], '/^[a-zA-Z0-9_]{1,20}+$/', l ( 'connection_twitter_error' ) );
			}
			
			if (! empty ( $c ['facebook'] )) {
				$this->validation->regex ( $c ['facebook'], '/^[a-zA-Z0-9_.]+$/', l ( 'connection_facebook_error' ) );
			}
			
			if (! sizeof ( $this->validation->errors )) {
				$this->messenger->setMessage('Updated');
				$this->model->users->updateConnections ( $c );
				redirect ( '/edit/connections' );
			}
		}

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {
			$this->view ( 'usersv2/header', $data );
			$this->view ( 'usersv2/connections', $data );
			$this->view ( 'usersv2/footer', $data );
		}
		if (is_ajax()) {
			$this->view ( 'usersv2/connections', $data );
		}		
	}

	function article(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas
		$this->model ( 'blog' );

		# START LOGIC
		$unnapproved_article = $this->model->blog->listUnapprovedByUID($this->sessions->get('uid'));

		# JIKA TIDAK ADA ARTIKEL YANG BELUM DIAPRROVE
		if (!empty($unnapproved_article)) {
			
			# DELETE
			// @todo tmabahin uid lah
			if (is_get('d')) {
				$this->model->blog->delPost ( $unnapproved_article['nid']);
				$this->messenger->setMessage('Updated');
				redirect ( '/beta/article' );				
			}

			# EDIT
			if (is_get('e')) {
				
				if (is_post('editpost')) {
					# @todo strip all code for security kayanya sih udah safe coba dicek ulang
					$n ['title'] = $_POST ['title'];
					
					if (config('middleware/wmd')) {	
						$n ['content'] = $_POST ['content'];
						$n ['content_html'] = $_POST ['js-middleware-wmd-output'];
					}
					if (!config('middleware/wmd')) {	
						$n ['content'] = $_POST ['content'];
						$n ['content_html'] = $_POST ['content'];
					}

					$n ['tag'] = $_POST ['tag'];
					$n ['uid'] = $this->sessions->get ( 'uid' );
					$n ['nid'] = $unnapproved_article['nid'];

					# get the time from jakarta
					$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
					$n ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
					
					# validateing
					$this->validation->required ( $n ['title'], l('blog_title_error') );
					$this->validation->required ( $n ['content'], l('blog_content_empty') );
					$this->validation->required ( $n ['tag'], l('blog_tag_empty') );
					
					if (! sizeof ( $this->validation->errors )) {
						$this->model->blog->editPost ( $n );
						$this->messenger->setMessage('Updated');
						redirect ( '/beta/article' );
					}
				}
			}
		}

		# JIKA ADA ARTIKEL YANG BELUM DIAPPROVE
		if (empty($unnapproved_article)) {
			if (is_post ( 'newpost' )) {
				
				# @todo strip all code for security
				$n ['title'] = $_POST ['title'];
				
				if (config('middleware/wmd')) {	
					$n ['content'] = $_POST ['content'];
					$n ['content_html'] = $_POST ['js-middleware-wmd-output'];
				}
				if (!config('middleware/wmd')) {	
					$n ['content'] = $_POST ['content'];
					$n ['content_html'] = $_POST ['content'];
				}

				$n ['tag'] = $_POST ['tag'];
				$n ['uid'] = $this->sessions->get ( 'uid' );
				
				# get the time from jakarta
				$time = new DateTime ( NULL, new DateTimeZone ( 'Asia/Jakarta' ) );
				$n ['timecreate'] = $time->format ( 'Y-m-d H:i:s' );
				
				# validateing
				$this->validation->required ( $n ['title'], l('blog_title_error') );
				$this->validation->required ( $n ['content'], l('blog_content_empty') );
				$this->validation->required ( $n ['tag'], l('blog_tag_empty') );
				
				if (! sizeof ( $this->validation->errors )) {
					$this->model->blog->setPosts ( $n );
					redirect ( '/beta/article' );
				}
			}
		}

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {
			$this->view ( 'usersv2/header');

			# EDIT
			if (is_get('e')) {
				$this->view ( 'usersv2/blogedit', $unnapproved_article );
			}

			# NO EDIT & DEL
			if (!is_get('d') && !is_get('e')) {
				if (empty($unnapproved_article)) {
					$this->view ( 'usersv2/blogadd' );
				}
				if (!empty($unnapproved_article)) {
					$this->view ( 'usersv2/blogverify', $unnapproved_article );
				}
			}

			$this->view ( 'usersv2/footer' );
		}
		if (is_ajax()) {
			# EDIT
			if (is_get('e')) {
				$this->view ( 'usersv2/blogedit', $unnapproved_article );
			}

			# NO EDIT & DEL
			if (!is_get('d') && !is_get('e')) {
				if (empty($unnapproved_article)) {
					$this->view ( 'usersv2/blogadd' );
				}
				if (!empty($unnapproved_article)) {
					$this->view ( 'usersv2/blogverify', $unnapproved_article );
				}
			}
		}		
	}

	function dashboard(){
		# START BOOTSTRAP
		# bootstraping diperuntukan untuk loading semua midleware dan kebutuhan
		# controllernya, jadinya gak btuh2 lagi, taro dipaling atas
		$this->model ( 'users' );
		$this->model ( 'products' );
		$this->model ( 'social' );
		$this->helper ( 'time' );

		# START LOGIC
		$data ['followingproduct'] = $this->model->products->listFromFollower ( $this->sessions->get ( 'uid' ), 5 );
		
		foreach ( $data ['followingproduct'] as $key => $value ) {
			$data ['feeds'] [$value ['pid']] = $value;
			if (config ( 'features/comments/core' )) {
				$data ['feeds'] [$value ['pid']] ['comments'] = $this->model->products->listCommentsByPID ( $value ['pid'], 3 );
			}
		}
		# var_dump($data['feeds']);
		# need optimize

		$data ['userproduct'] = $this->model->products->listProductsByUID ( $this->sessions->get ( 'uid' ), 0, 1 );
		$data ['user'] = $this->model->users->getData ( $this->sessions->get ( 'uid' ) );
		$data ['social'] = $this->model->social->CountSocial ( $this->sessions->get ( 'uid' ) );
		$data ['partners'] = $this->model->social->CountParters ( $this->sessions->get ( 'uid' ) );

		# START VIEWS
		# viewsnya dipisah antara ajax, sama non ajax. bedanya sama versi pertama
		# sehingga bisa di load secara parsial. tidak harus semuanya.
		if (!is_ajax()) {
			$this->view ( 'usersv2/header');
			$this->view ( 'usersv2/dashboard', $data );
			$this->view ( 'usersv2/footer' );
		}

		if (is_ajax()) {
			$this->view ( 'usersv2/dashboard', $data );
		}		
	}
}

?>