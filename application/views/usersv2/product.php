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
					<label for="tag">Tag Produk</label>
					
					<div style="margin-left: 5px;">
					<select style="width:350px;" class="red-ajax-select" name="tag" >
					<?php foreach ($groups as $group): ?>
					<?php 
						$tags = explode(",", $group['tags']);
						echo '<optgroup label="'.$group['group'].'">';
						foreach ($tags as $tag) {
							if ($tag != 'lainnya') {
								echo '<option value="'.$tag.'">'.$tag.'</option>';
							}
							if ($tag == 'lainnya') {
								echo '<option selected value="'.$tag.'">'.$tag.'</option>';
							}
						}
					?>
					<?php endforeach ?>
					</select>
					</div>
					
					</li>
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

		
		<?php $views->js('middleware/jquery/jquery.form,middleware/jquery/jquery.validation','external'); ?>
		<script type="text/javascript" src="/www-static/assets/js/middleware/chosen/chosen.jquery.js"></script>
		<link href="/www-static/assets/js/middleware/chosen/chosen.css" rel="stylesheet"></link>
		<?php $views->js('users/product'); ?>