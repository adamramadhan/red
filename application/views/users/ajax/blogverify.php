	<div class="l clearfix" id="ajax-users-dashboard">
		<!-- FORM START -->
		<div id="red-edit-full">
			<?php $views->css('blog'); ?>
			<div id="waiting-approval">Artikel anda sedang kami Review. kami akan memberitahukan via message jika telah diapprove.</div>
			<div id="blog-title"><h1><?php echo $data['title']; ?></h1></div>
			<div class="blog-post"><?php echo $data['content_html']; ?></div>
			<div class="clearfix">
				<a href="?e" id="blog-edit">Edit</a>
				<a href="?d" id="blog-del">Delete</a>
			</div>
		</div>
		<!-- FORM ENDS -->
	</div>