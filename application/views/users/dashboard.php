	<div class="clearfix" id="red-content">
		<!-- FORM START -->
		<div id="red-edit-full">
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
					echo '<div class="c bootstraps">
						<div class="image">Set Up Profile</div>	
						<div class="desc">Lengkapilah data Usaha atau Organisasi Anda.</div>
					</div>';
				}
				if (empty($userproduct)) {
					echo '<div class="c bootstraps">
						<div class="image">Create a Product</div>	
						<div class="desc">Tambah produk Usaha atau Organisasi Anda sehingga anda langsung dapat berbagi.</div>
					</div>';
				}
				if (empty($feeds)) {
					echo '<div class="c bootstraps">
						<div class="image">Be Social</div>	
						<div class="desc">Mulailah dengan memfollow usaha lain, anda akan mendapat update dalam dashboard ini</div>
					</div>';
				}
				echo '</div>';
			}
			?>
						
			<?php
			if ( !empty($feeds) ) {
				echo "<div class='feeds'>";
				foreach ( $feeds as $key) {
				echo '<div class="feed">';
				echo 	'<div class="clearfix" id="subinformation">
						<div id="subname">@'.$key['name'].'</div>
						<div id="subname">'.$key['product'].'</div>
						<div id="subtime">'.$this->time->formatDateDiff($key['timecreate']).'</div>
						<div class="c" id="suboptions"><a href="product?id='.$key['pid'].'">Lihat</a></div>
						</div>';
					if (config('features/comments/core')){		
						if (!empty($key['comments'])) {
							echo '<ul id="comments">';
							foreach ($key['comments'] as $comment) {
								echo '<li class="comment" id="comment-'.$comment['pid'].'">
								<a href="/'.$comment['username'].'">@'.$comment['name'].'</a> '
								.$comment['comment'].'</li>';
							}
							echo "</ul>";
						}
						if (count($key['comments']) == 5) {
							echo '<div class="cb morecomments">more then 5</div>';
						}
					}
				echo "</div>";
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