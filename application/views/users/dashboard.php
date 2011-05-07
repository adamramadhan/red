<div style="height: 30px; background: none repeat scroll 0pt 0pt rgb(255, 255, 255); border-bottom: 1px solid rgb(231, 231, 231); color: rgb(68, 68, 68);"><p style="margin: 0pt auto; width: 960px; text-align: center; line-height: 29px;"><span style="position: relative;right: 5px;top: 2px;"><?php $views->getIMG('i/megaphonebybigfunkychiken.gif'); ?> </span>Hallo, Kami sedang voting <a href="/blog?id=6"><u>permintaan fitur #2</u></a> . Jangan lupa untuk <i>Ctrl + D</i> untuk Bookmark!</p></div>

<!-- UJI COBA -->
<?php $views->js('jquery,users/dashboard'); ?>

	<div class="clearfix" id="red-content">
		<!-- FORM START -->
		<div id="red-edit-full">
			<!-- AJAX INFORMATION BOX -->
			<div id="ajax-information" style="display:none;padding: 5px;margin-bottom:5px; border: 1px solid rgb(204, 204, 204); text-align: center;"></div>
			<!-- INFORMATION BOX -->
			<div id="red-dashboard">
				<ul class="clearfix">
					<li class="c">Followers : <?php echo $social['followers']; ?></li>
					<li class="c">Following : <?php echo $social['following']; ?></li>
					<li class="c">Partners : <?php echo $partners['partners']; ?></li>
					<li class="c trustpoint">Trust Points : 0</li>
				</ul>
			</div>
			
			<?php
			if (empty($user['logo']) || empty($products) || empty($feed)) {
				echo '<div class="clearfix bootcamp">';
				if (empty($user['logo'])) {
					echo '<a href="/edit/profile"><div class="c bootstraps">
						<div class="image">Set Up Profile</div>	
						<div class="desc">Lengkapilah data Usaha atau Organisasi Anda.</div>
					</div></a>';
				}
				if (empty($userproduct)) {
					echo '<a href="/edit/product"><div class="c bootstraps">
						<div class="image">Create a Product</div>	
						<div class="desc">Tambah produk Usaha atau Organisasi Anda sehingga anda langsung dapat berbagi.</div>
					</div></a>';
				}
				if (empty($feeds)) {
					echo '<a href="/products"><div id="last-child" class="c bootstraps">
						<div class="image">Be Social</div>	
						<div class="desc">Mulailah dengan memfollow usaha lain, anda akan mendapat update dalam dashboard ini</div>
					</div></a>';
				}
				echo '</div>';
			}
			?>
						
			<?php
			if ( !empty($feeds) ) {
				echo "<div class='feeds'>";
				foreach ( $feeds as $key) {
				echo '<div id="feed-'.$key['pid'].'" class="feed">';
				echo 	'<div class="clearfix" id="subfeed-meta">
						<div id="subname">@'.$key['name'].'</div>
						<div id="subname">'.$key['product'].'</div>
						<div id="subtime"><abbr class="ajax-time" title="'.$key['timecreate'].'" id="time">
						'.$this->time->formatDateDiff($key['timecreate']).'</a></div>
						<div class="c" id="suboptions"><a href="product?id='.$key['pid'].'">Lihat</a></div>
						</div>';
				// END SUBINFORMATION

				# START CONTAINER
				echo '<div id="subfeed-more" class="clearfix">';
				echo '<a href="product?id='.$key['pid'].'"><div id="subimage">';
				echo $views->getStorage($key['uid'],$key['image_tumb']);
				echo '</div></a>';
				// START COMMENT
					if (config('features/comments/core')){		
						if (empty($key['comments'])) {
							echo '<div id="subcomments">';
							echo '<ul id="comments">';
							echo '<li class="comment">No comment available.</li>';
							echo "</ul>";
							echo "</div>";							
						}
						if (!empty($key['comments'])) {
							echo '<div id="subcomments">';
							echo '<ul id="comments">';
							foreach ($key['comments'] as $comment) {
								echo '<li class="comment" id="comment-'.$comment['pid'].'">'
								.$comment['comment'].' <span id="says">says</span> <a href="/'.$comment['username'].'">
								'.$comment['name'].'</a></li>';
							}

							if (count($key['comments']) == 3) {
								echo '<li class="cb morecomments">more then 3</li>';
							}
							echo "</ul>";
							echo "</div>";
						}
					}
				// END COMMET
				echo "</div>";
				echo '</div>';
				}	
				echo "</div>";
			}
			
			?>
		</div>
		<!-- INFORMATION ENDS -->		


		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->