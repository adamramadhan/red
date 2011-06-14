	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
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
		
		
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->	

	<link rel="stylesheet" type="text/css" href="/www-static/assets/js/middleware/wmd/wmd.css"/>
	<?php $views->css('blog'); ?>
	<script type="text/javascript" src="/www-static/assets/js/middleware/wmd/showdown.js"></script>
	<script type="text/javascript" src="/www-static/assets/js/middleware/wmd/wmd.js"></script> 
	<?php $views->JS('jquery,middleware/jquery/jquery.validation,users/addarticle'); ?>
    <style>
	#js-middleware-wmd-preview {
	    padding: 5px;
	}
    </style>