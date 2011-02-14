	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-left-wide">
			<h3>Kotak Informasi</h3>
			<form accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->input('informationbox','textarea',l('informationbox'),$user['information']); ?></li>
			</ul>
			<p><input type="submit" value="Ubah" name="edit" id="button"></p>
			</form>
		</div>
		<!-- FORM ENDS -->			
		
		<div id="red-edit-right">
		<ul class id="red-profile-guides">
			<h3>Howto &amp; Guide</h3>
			<li><p>Anda bisa menggunakan format :</p>
				<p>[b]<strong>tulisan bold</strong>[b]</p>
				<p>[i]<em>tulisan miring</em>[i]</p>
				<p>[img]{url}[img]</p>
			</li>
		</ul>
		</div>
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->
