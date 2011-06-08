	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-blog-left">
		<?php if (!empty($highlight)): ?>
		<div class="c" id="highlight">
		<h4><?php echo $highlight['title']; ?></h4>
		<?php echo $highlight['content_html']; ?>
		</div>
		<?php endif ?>
			<?php 
				echo '<div class="blog-post" id="post-'.$post['nid'].'">';
				echo '<h1>'.$post['title'].'</h1>';
				echo "<ul id='post-meta' class='clearfix'>";
				echo '<li id="meta-author">By <a style="font-weight: bold;" href="/'.$post['username'].'" class="u">'.$post['name'].'</a></li>';
				echo '<li>at '.$post['timecreate'].'</li>';
				echo '<li>tag '.ucfirst($post['tag']).'</li>';
				echo "</ul>";
				echo '<p>'.$post['content'].'</p>';
				echo "</div>";
			 ?>

		<!-- COMMENT START -->
		<?php if (config('features/comments/core')): ?>
		<div id="comments">

			<?php if ($count['COUNT(cid)'] == 0): ?>
			<div id="meta-comments">
				<h4><?php echo l('nocomments'); ?></h4>
			</div>
			<?php endif ?>

			<?php if ($count['COUNT(cid)'] != 0): ?>			
			<div id="meta-comments">
				<h4>(<?php echo $count['COUNT(cid)']; ?>) <?php echo l('comments') ?></h4>
			</div>
			<?php endif ?>
						
			<!-- COMMENT POST -->			
			<?php if ($this->sessions->get('uid')): ?>
				<div id="post-comment">
					<form accept-charset="utf-8" method="post" >
						<ul>
							<li><?php $this->forms->textarea('comment',l('addcomment'), array( 
									  'cols' => '90',
									  'rows' => '3')); ?></li>
						</ul>
						<p><input type="submit" value="Kirim" name="insert" id="button"></p>
					</form>						
				</div>
			<?php endif ?>
			<!-- COMMENT POST -->			
			
			<ul>
				<?php foreach ($comments as $comment) {
					echo "<li class='comments' id='comment-".$comment['cid']."'>";
					echo "<span id='name'><a href='/".$comment['username']."'>@".$comment['name']."</a></span>";
					echo "<span id='comment'>".$comment['comment']."</span>";
					echo "<abbr class='ajax-time' title='".$comment['timecreate']."' id='time'>".$this->time->formatDateDiff($comment['timecreate'])."</abbr>";
					if ($this->sessions->get('uid') == $comment['uid']) {
						echo "<span id='d'><a href='/comments?d=".$comment['cid']."'>x</a></span>";
					}
					echo "</li>";
				} ?>
			</ul>

			<?php if (!$this->sessions->get('uid')): ?>
				<div class"c" id="notice">Hallo, <a href="/login">login</a> untuk meninggalkan pesan. </div>
			<?php endif ?>

		</div>
		<?php endif ?>
		<!-- COMMENT END -->

		</div>				
		<div class="c" id="red-blog-right">
			<ul>
			<?php foreach ($posts as $post) {
				echo '<li class="post-list" id="post-list-'.$post['nid'].'">
				<div id="post-list-title"><a href="/blog?id='.$post['nid'].'">'.$post['title'].'</a></div>
				<div id="post-list-meta">updated <abbr class="ajax-time" title="'.$post['timecreate'].'" id="time">'.$this->time->formatDateDiff($post['timecreate']).'</abbr></div>
				</li>';	
			} ?>
			</ul>

			<div id="hello-blog">
				Hallo, ikuti perkembangan kami dengan "like" akun facebook kami atau "follow" akun twitter kami. 	
				<ul id="blog-social">
					<li id="blog-icon-twitter"><?php $views->href('http://www.twitter.com/netcoid','@twitter'); ?></li>
					<li id="blog-icon-facebook"><?php $views->href('http://www.facebook.com/pages/Netcoid-Indonesia/165598776812971','@facebook'); ?></li>
					<li id="blog-icon-github"><?php $views->href('http://www.github.com/netcoid','@github'); ?></li>
					<li id="blog-icon-deviantart"><?php $views->href('http://netcoid.deviantart.com','@deviantart'); ?></li>
				</ul>	
			</div>
		</div>
	</div>
	<!-- CONTENT END -->