	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-left-wide">
			<h3>Tambah Product</h3>
			<form enctype="multipart/form-data" accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->input('name','text',l('productname')); ?>
				<li><?php $this->forms->input('informationbox','textarea',l('productdescription')); ?></li>
				<li><?php $this->forms->input('tag','text',l('producttag')); ?></li>
				<li><?php $this->forms->input('price','text',l('productprice')); ?></li>	
				<li><?php $this->forms->input('image','file',l('productimage')); ?></li>
			</ul>
			<p><input type="submit" value="Tambah" name="edit" id="button"></p>
			</form>
		</div>
		<!-- FORM ENDS -->
		
		<div id="red-edit-right">	
		<ul class="c" id="red-profile-guides">
			<h3>Howto &amp; Guide</h3>
			<li>contoh : Nama Produk #111</li>
			<li><p>Anda bisa menggunakan format :</p>
				<p>[b]<strong>tulisan bold</strong>[b]</p>
				<p>[i]<em>tulisan miring</em>[i]</p>
				<p>[img]{url}[img]</p>
			</li>
			<li>Resolusi gambar akan disesuaikan lebar 460( px ) pada halaman produk dan 150 x 150 ( px ) pada halaman depan</li>
		</ul>	
		</div>
		
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->	