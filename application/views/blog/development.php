	<!-- CONTENT START -->
	<div class="development clearfix" id="red-content">
		<div id="red-blog-left">
			<div class="clearfix" id="development-status">
				<div id="box" class="l"><h3>Open Issues</h3><p><?php echo $repo['open_issues']; ?></p></div>
				<div id="box" class="l"><h3>last Updated</h3><p>
				<?php echo '<abbr class="ajax-time" title="'.$repo['pushed_at'].'" id="time">'.$this->time->formatDateDiff($repo['pushed_at']); ?></abbr></p></div>
				<div id="box" class="l"><h3>Size</h3><p><?php echo $repo['size']; ?></p></div>
			</div>
			<div class="blog-post" id="development-introduction">
				<h3>Mengapa?</h3>
				<code>/development</code> adalah salah satu bentuk penerapan <a target="_blank" href="https://www.networks.co.id/blog?id=9">Keterbukaan, Feedback dan Transparansi</a>, Disini Rekan Netcoid dapat melihat Progress Perkembangan secara langsung. Tentu nantinya akan kami lengkapi dengan Laporan BUG, Feedback dan tentunya Feature Request. Untuk Development anda dapat mengikuti <a target="_blank" href="http://www.github.com/netcoid">Netcoid</a> di @github, untuk Design dan Ilustrasi Netcoid anda dapat mengikuti <a target="_blank" href="http://www.twitter.com/liulusiliu">Momoru</a> di @twitter.
			</div>

			<div class="blog-post" id="development-changes">
				<h3>Perubahan <?php echo $commit['id']; ?></h3>

				<div class="clearfix" id="committer-information">
				<img class="l" src="https://secure.gravatar.com/avatar/<?php echo $user['gravatar_id']; ?>?s=50&d=mm">
					<div class="l" id="committer-says"><?php echo $commit['message']; ?></div>
				</div>


				<?php 
								
				# MODIFIED
				if (isset($commit['modified'])) {
					echo "<h4>Modified</h4>";
					foreach ($commit['modified'] as $modified) {
						$new_modified[] = basename($modified['filename']);
					}	
					echo implode(', ',$new_modified);
				}

				# ADDED
				if (isset($commit['added'])) {
					echo "<h4>Added</h4>";
					foreach ($commit['added'] as $added) {
						$new_added[] = basename($added);
					}
					echo implode(', ',$new_added);
				}

				# DELETED
				if (isset($commit['removed'])) {
					echo "<h4>Removed</h4>";
					foreach ($commit['removed'] as $removed) {
						$new_removed[] = basename($removed);
					}
					echo implode(', ',$new_removed);
				}
								
				?>
			</div>
		</div>				
		<div class="c" id="red-blog-right">
			<ul>
			<?php foreach ($updates as $post) {
				echo '<li class="post-list" id="post-list-'.$post['id'].'">
				<div id="post-list-title"><a href="/development?id='.$post['id'].'">'.$post['id'].'</a></div>
				<div id="post-list-meta">updated <abbr class="ajax-time" title="'.$post['committed_date'].'" id="time">'.$this->time->formatDateDiff($post['committed_date']).'</abbr> by '.$post['committer']['name'].'</div>
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