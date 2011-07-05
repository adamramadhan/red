<div id="red-edit-full">
<a id="ajax-red-link" href="/edit/products"><span style="line-height: 1.4em; padding: 5px; font-size: 140%;">tags</span></a>
<div id="ajax-red-treeslider">
	<ul>
		<?php
		if ( !empty($products) ) {
			foreach ( $products as $key => $value) {
			echo 	'<li class="iconproducts red-pjax" id="subinformation"><a href="?t='.$value['tag'].'"><div class="clearfix">
					<div id="subname">'.$value['tag'].'</div>
					<div id="suboptions">Lihat</div>
					</div></a></li>';
			}	
		}
	?> 
	</ul>
</div>
<?php	
	if ( empty($products) ) {
				
		echo 	'<div class="c" id="red-box-red">
				<p>Products ( Produk ) adalah salah satu fitur utama kami, anda dapat menambah, memanagemen dan 
				menghapus produk perusahaan. list data product nanti akan kami tampilkan pada halaman profil perusahaan anda,
				dan setiap produknya akan kami tampilkan pada halaman produk dengan nama perusahaan anda.</p>
				</div>';
	}			
	?>
</div>