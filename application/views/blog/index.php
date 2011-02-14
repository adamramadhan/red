
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-blog-left">
			<?php 
				echo '<div class="blog-post" id="post-'.$post['nid'].'">';
				echo '<h3>'.$post['title'].'</h3>';
				echo "<ul id='post-meta' class='clearfix'>";
				echo '<li id="meta-author">By '.$post['name'].'</li>';
				echo '<li>'.$post['timecreate'].'</li>';
				echo '<li>'.ucfirst($post['tag']).'</li>';
				echo "</ul>";
				echo '<p>'.$post['content'].'</p>';
				echo "</div>";
			 ?>
		</div>				
		<div id="red-blog-right">
			<ul>
			<?php foreach ($posts as $post) {
				echo '<li class="post-list" id="post-list-'.$post['nid'].'"><a href="/blog?id='.$post['nid'].'">'.$post['title'].'</a></li>';
			} ?>
			</ul>
		</div>
	</div>
	<!-- CONTENT END -->