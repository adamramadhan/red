	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="newpost clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post">
			<ul>
				<li><label for="input-title">Judul</label><input type="text"
					 value="<?php echo $post['title']; ?>" id="input-title" class="textinput" name="title"></li>
				<li><label for="username">Berita</label><textarea name="content" cols="100" rows="50"><?php echo $post['content']; ?></textarea></li>
				<li><label for="input-title">Tag</label><input type="text"
					value="<?php echo $post['tag']; ?>" id="input-tag" class="textinput" name="tag"></li>
			</ul>
			<p><input type="submit" value="Edit" name="editpost" id="button"></p>
			</form>
			<?php echo nl2br($post['content']);  ?>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->