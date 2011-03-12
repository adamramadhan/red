	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- INFORMATION START -->
		<div id="red-edit-full">
			<?php
			if ( !empty($products) ) {
				foreach ( $products as $key => $value) {
				echo 	'<div class="clearfix" id="subinformation">
						<div id="subname">'.$value['tag'].'</div>
						<div id="subname">'.$value['name'].'</div>
						<div id="subname">'.$value['price'].'</div>
						<div class="c" id="suboptions"><a href="/edit/products?d='.$value['pid'].'">Hapus</a></div>
						<div class="c" id="suboptions"><a href="/edit/product?e='.$value['pid'].'">Edit</a></div>
						<div class="c" id="suboptions"><a href="/product?id='.$value['pid'].'">Lihat</a></div>
						</div>';
				}	
			}
			
			else {
						
				echo 	'<div class="c" id="red-products-status">
						<p>Products ( Produk ) adalah salah satu fitur utama kami, anda dapat menambah, memanagemen dan 
						menghapus produk perusahaan. list data product nanti akan kami tampilkan pada halaman profil perusahaan anda,
						dan setiap produknya akan kami tampilkan pada halaman produk dengan nama perusahaan anda.</p>
						</div>';
							
			}			
			?>
		</div>
		<!-- INFORMATION ENDS -->	
	

		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->	
