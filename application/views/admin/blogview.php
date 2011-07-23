<?php $views->css('blog') ?>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div class="blog-post" id="red-admin-left">
		<h1><?php echo $post['title']; ?></h1>
			<?php
				echo $post['content_html'];
			?>
			<hr style="border-color: rgb(255, 0, 101); border-style: dashed;">
			<p>Status</p>
			<p>
			0 = User Content ( not approved )<br/>
			1 = User Content ( approved )<br/>
			2 = Published Official Blog</br>
			3 = Published Official Blog Highlight </br>
			4 = Netcoid HQ<br/>
			5 = Netcoid HQ highlight<br/>
			</p>
			<?php 
				echo $post['tag'];
				echo '<a href="/admin/blog">back</a>';
			?>

			<form accept-charset="utf-8" method="post">
			<p><?php $this->forms->textinput('status','status', array( 'value' => $status['status'])); ?></p>
			<p><input type="submit" value="Update Status" name="editstatus" id="button"></p>
			</form>			
		
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->