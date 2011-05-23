	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->textinput('group','group', array( 'value' => $group['group'])); ?></li>
				<li><?php $this->forms->textinput('tag','tag', array( 'value' => $group['tag'])); ?></li>
				<li><?php $this->forms->textarea('information','information', array( 'value' => $group['information'])); ?></li>
			</ul>
			</ul>
			<p><input type="submit" value="edit" name="edit" id="button"></p>
			</form>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->