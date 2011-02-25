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
			
			if (empty($user['logo'])) {
				echo '<div id="red-profile-status">1. Lengkapilah data Usaha atau Organisasi Anda.</div>';
			}
			if (empty($products)) {
				echo '<div id="red-profile-guides">2. Tambah produk Usaha atau Organisasi Anda.</div>';
			}
			if (empty($feed)) {
				echo '<div id="red-whattodo">3. Get Social.</div>';
			}
			?>
						
			<?php
			if ( !empty($feed) ) {
				foreach ( $feed as $key) {
				echo 	'<div class="clearfix" id="subinformation">
						<div id="subname">'.$key['name'].'</div>
						<div id="subname">'.$key['product'].'</div>
						<div id="subtime">'.$this->time->formatDateDiff($key['timecreate']).'</div>
						<div class="c" id="suboptions"><a href="product?id='.$key['pid'].'">Lihat</a></div>
						</div>';
				}	
			}
			
			?>
		</div>
		<!-- INFORMATION ENDS -->		


		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->