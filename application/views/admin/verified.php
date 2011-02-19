	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<form enctype="multipart/form-data" accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->fileinput('image','Gambar Data'); ?></li>
			</ul>
			<p><input type="submit" value="verified" name="verified" id="button"></p>
			</form>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->