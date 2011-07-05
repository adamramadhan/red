<div id="red-edit-full">
<span style="line-height: 1.4em; padding: 5px; font-size: 140%;"><a id="ajax-red-link" href="/edit/products">tags</a> / <?php echo $_GET['t'] ?></span>
<div id="ajax-red-treeslider">
	<ul>
		<?php
			if ( !empty($products) ) {
				foreach ( $products as $key => $value) {
				echo 	'<li  class="iconproduct" id="subinformation"><div class="clearfix">
						<div id="subname">'.$value['name'].'</div>
						<div id="subname">'.$value['price'].'</div>
						<div id="suboptions"><a href="/edit/products?t='.$_GET['t'].'&d='.$value['pid'].'">Hapus</a></div>
						<div id="suboptions"><a href="/edit/product?e='.$value['pid'].'">Edit</a></div>
						<div id="suboptions"><a href="/product?id='.$value['pid'].'">Lihat</a></div>
						</div></li>';
			}
		?>
	</ul>	
</div>		

				<?php
			}
			
	else {
				
		echo 	'<div class="c" id="red-box-red">
				<p>Products ( Produk ) adalah salah satu fitur utama kami, anda dapat menambah, memanagemen dan 
				menghapus produk perusahaan. list data product nanti akan kami tampilkan pada halaman profil perusahaan anda,
				dan setiap produknya akan kami tampilkan pada halaman produk dengan nama perusahaan anda.</p>
				</div>';
	}			
	?>
</div>