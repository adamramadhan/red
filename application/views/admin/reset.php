	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->textinput('username','Username'); ?></li>
			</ul>
			<p><input type="submit" value="Reset" name="reset" id="button"></p>
			</form>

			<?php if (!empty($active)): ?>
			<?php 
				foreach ($active as $user) {
					echo '<div class="clearfix" id="subinformation">';
					echo '<div id="subname">'.$user['username'].'</div>';
					echo '<div class="c" id="suboptions"><a href="/admin/reset?d='.$user['username'].'">Delete</a></div>';
					echo '<div class="c" id="suboptions"><a target="_blank" href="/reset?id='.$user['reset'].'">Link</a></div>';
					echo "</div>";
				}
			 ?>
			<?php endif ?>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->