	<?php $views->js('jquery,middleware/jquery/jquery.form,middleware/jquery/jquery.validation,users/product'); ?>
	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div class="l clearfix" id="ajax-users-dashboard">
			<!-- FORM START -->
			<div id="red-edit-left-wide">
				<h3>Tambah Product</h3>
				<form id="form-productadd" enctype="multipart/form-data" accept-charset="utf-8" method="post" >
				<ul>
					<li><?php $this->forms->textinput('name',l('productname'), array( 'title' => l('product_name_error') )); ?></li>
					<li><?php $this->forms->textarea('informationbox',l('productdescription'), 
							  array( 'title' => l('product_description_error'),
							  		 'cols' => '17',
							  		 'rows' => '5')
							  ); ?></li>
					<li>
					<label for="tag">Group Produk</label>
					<select name="group" >
					<?php foreach ($groups as $group): ?>
						<?php echo '<option value="'.strtolower($group['group']).'">'.$group['group'].'</option>'; ?>
					<?php endforeach ?>
					</select>
					</li>
					<li><?php $this->forms->textinput('tag',l('producttag'), array( 'title' => l('product_tag_error') )); ?></li>
					<li><?php $this->forms->textinput('price',l('productprice'), array( 'title' => l('product_price_error') )); ?></li>
					<li><?php $this->forms->fileinput('image',l('productimage'), array( 'title' => l('product_image_error'),'size' => '11' )); ?></li>
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
					<p>[img]url.com/img.png[img]</p>
				</li>
				<li>Resolusi gambar akan disesuaikan lebar 460( px ) pada halaman produk dan 150 x 150 ( px ) pada halaman depan</li>
			</ul>	
			</div>
		</div>
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->	