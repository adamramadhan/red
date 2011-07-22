	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->textinput('username','Username'); ?></li>
				<li><?php $this->forms->textinput('role','Role'); ?></li>
			</ul>
			<p><input type="submit" value="Update" name="edit" id="button"></p>
			</form>
			<hr style="border-color: rgb(255, 0, 101); border-style: dashed;">
			<p>Status</p>
			<p>
			0 = Not Verified ( warning gambar verify masih tersimpan )<br/>
			1 = Verivied ( warning gambar verify tidak tersimpan )<br/>
			3 = Media Partner<br/>
			</p>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->