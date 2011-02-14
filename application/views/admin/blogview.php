	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-admin-left">
			<?php
				echo $post['title'];
				echo "<br/>";
				echo $post['content'];
				echo "<br/>";
				echo $post['tag'];
				echo '<a href="/admin/blog">back</a>';
			?>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->