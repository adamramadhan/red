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
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->