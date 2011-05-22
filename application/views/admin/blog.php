	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
		<?php  
		# make a list of non verified user
		foreach ($posts as $post) {
			echo '<div class="clearfix" id="subinformation">';
			echo '<div id="subname">'.$post['status'].'</div>';
			echo '<div id="subname">'.$post['title'].'</div>';
			echo '<div id="subname">'.$post['name'].'</div>';
			echo '<div class="c" id="suboptions"><a href="/admin/blog?d='.$post['nid'].'">x</a></div>';
			echo '<div class="c" id="suboptions"><a href="/admin/blog?e='.$post['nid'].'">Edit</a></div>';
			echo '<div class="c" id="suboptions"><a href="/admin/blog?n='.$post['nid'].'">Status</a></div>';
			echo "</div>";
		}
		?>			
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->