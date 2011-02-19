	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
		<?php  
		# make a list of non verified user
		foreach ($users as $user) {
			echo '<div class="clearfix" id="subinformation">';
			echo '<div id="subname">'.$user['name'].'</div>';
			echo '<div id="subname">'.$user['phone'].'</div>';
			echo '<div class="c" id="suboptions"><a href="/admin?verified='.$user['uid'].'">Aktifkan</a></div>';
			echo "</div>";
		}
		?>			
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->