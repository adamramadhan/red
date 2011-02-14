	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-full">
			<?php
			
				foreach ($user as $key => $value) {
					if (empty($value)) {
						$uempty[] = $value;
					}
				}

				if (!empty($uempty)) {
					echo '
					<div id="red-whattodo">
						<h4>1. Lengkapilah informasi usaha</h4>
						<p>Pertama, Anda harus melengkapi data usaha anda, upload logo, dan alamat anda, Dengan memilih "Data Usaha" di menu
						sebelah kanan.</p>
					</div>
					';
				}
				if (empty($db['product'])) {
					echo '
					<div id="red-whattodo">
						<h4>2. Tambah produk usaha</h4>
						<p>Jangan lupa untuk menambah produk anda, dengan memilih "tambah produk" di menu sebelah kanan.</p>
					</div>
					';
				}
			
			
			if ( !empty($db['products']) ) {
				foreach ( $db['products'] as $key => $value) {
				echo 	'<div class="clearfix" id="subinformation">
						<div id="subname">'.$value['name'].'</div>
						<div id="subname">'.$value['product'].'</div>
						<div id="subtime">'.$time->formatDateDiff($value['timecreate']).'</div>
						<div class="c" id="suboptions"><a href="product.php?id='.$value['pid'].'">Lihat</a></div>
						</div>';
				}	
			}
			
			else {
						
				echo 	'<div class="c" id="red-whattodo">
						<h4>3. Ikuti perkembangan usaha lain</h4>
						<p>Dapatkan <strong>update terkini</strong> dari usaha lain, dengan memilih "ikuti" pada profil usaha lain, berita
						tersebut nantinya akan dimuat di halaman ini.</p>
						</div>';
							
			}			
			?>
		</div>
		<!-- INFORMATION ENDS -->		


		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->