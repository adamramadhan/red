<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="newpost clearfix" id="red-content">
		<div id="red-admin-left">
			<form accept-charset="utf-8" method="post">
			<ul>
				<li><label for="input-title">Judul</label><input type="text"
					value="<?php echo $post['title']; ?>" id="input-title" class="textinput" name="title"></li>
				<li><div id="js-middleware-wmd-menu"></div></li>
				<li><label for="content">Berita</label><textarea id="js-middleware-wmd-core" name="content" cols="100" rows="50"><?php echo $post['content']; ?></textarea></li>
				<li><label for="preview">Preview</label><div id="js-middleware-wmd-preview"></div></li>
				<li><label for="input-title">Tag</label><input type="text"
					value="<?php echo $post['tag']; ?>" id="input-tag" class="textinput" name="tag"></li>
			</ul>
			<input type="hidden" name="js-middleware-wmd-output" value="" id="js-middleware-wmd-output">
			<p><input type="submit" value="Post" name="newpost" id="button"></p>
			</form>
		</div>
		<?php require 'menu.php'; ?>
	</div>
	<!-- CONTENT END -->