	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post" >
			<ul>
				<li><?php $this->forms->textinput('group','group'); ?></li>
				<li><?php $this->forms->textinput('tag','tag'); ?></li>
				<li><?php $this->forms->textarea('information','information',array('cols' => '40',
						  		 'rows' => '5')); ?></li>
			</ul>
			</ul>
			<p><input type="submit" value="add" name="add" id="button"></p>
			</form>

			<?php if (!empty($groups)): ?>
			<?php 
				foreach ($groups as $group) {
					echo '<div class="clearfix" id="subinformation">';
					echo '<div id="subname">'.$group['name'].'</div>';
					echo '<div id="subname">'.$group['tag'].'</div>';
					echo '<div class="c" id="suboptions"><a href="/admin/groups?d='.$group['gid'].'">Delete</a></div>';
					echo '<div class="c" id="suboptions"><a href="/admin/groups?e='.$group['gid'].'">Edit</a></div>';
					echo "</div>";
				}
			 ?>
			<?php endif ?>

		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->