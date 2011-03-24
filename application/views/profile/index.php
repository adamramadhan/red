<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		
		<!-- MENU START -->
		<div class="clearfix" id="red-profile-menu">
			<ul class="clearfix">
				
				<!-- FOLLOW OR NOT FOLLOW START -->
				<li><?php
				if ( $user['uid'] == $this->sessions->get('uid')) {
					echo l('yourprofile');
				}
				if ( $this->sessions->get('uid') && $user['uid'] != $this->sessions->get('uid') && empty($follow)) {
					echo '<a href="/social/follow?id='.$user['uid'] .'&ref='.$thisprofile.'" >'.l('follow').'</a>';
				}
				if ( $this->sessions->get('uid') && $user['uid'] != $this->sessions->get('uid') && !empty($follow)) {
					echo '<a href="/social/unfollow?id='.$user['uid'] .'&ref='.$thisprofile.'" >'.l('unfollow').'</a>';
				}
				if ( ! $this->sessions->get('uid')) {
					echo l('logintofollow');
				}
				?></li>
				<!-- FOLLOW OR NOT FOLLOW ENDS -->
				
				
				<!-- SEND MESSAGE START -->
				<?php
				if ($this->sessions->get('uid') && $user['uid'] != $this->sessions->get('uid')) {
					echo '<li><a id="content-message" href="/messages?id='.$user['uid'] .'">Kirim Pesan</a></li>';
				}
				?></li>
				<!-- SEND MESSAGE END -->
				
				<li><a id="content-info" href="#information"><?php echo l('information'); ?></a></li>
				<li><a id="content-product" href="#products"><?php echo l('products'); ?></a></li>
				
				<!-- VERIFIED OR NOT START -->
				<li><?php
					if ($user['role'] == 0) {
						echo '<span class="c" id="status-unverified">'.l('unverified').'</span>'; 
					}
					if ($user['role'] == 1) {
						echo '<span class="c" id="status-verified"><a target="_blank" href="/verify/'.$user['username'].'">'.l('verified').'</a></span>'; 
					}
					if ($user['role'] == 3) {
						echo '<span class="c" id="status-mediapartner"><a target="_blank" href="/verify/'.$user['username'].'">'.l('mediapartner').'</a></span>'; 
					}
					if ($user['role'] == 5) {
						echo '<span class="c" id="status-founder">'.l('founder').'</span>'; 
					}
					// @todo add moderator police etc
				?></li>
				<!-- VERIFIED OR NOT ENDS -->
				
				<?php if ($user['role'] == 5): ?>
					<li id="badges"><?php $views->getIMG('power.gif'); ?></li>	
				<?php endif ?>
				
				<li id="red-profile-name"><?php echo $user['name']; ?> 
				(<?php echo $followers['followers'] ?>)</li>
			</ul>
		</div>
		<!-- END START -->		
		
		<!-- PROFILE START -->
		<div id="red-profile-left">
			<?php if (!empty($user['logo'])): ?>
				<?php $views->getStorage($user['uid'],$user['logo']); ?>
			<?php endif ?>
			<?php if (!empty($user['twitter'])): ?>
				<div class="c" id="twitter" rel="nofollow" target="_blank" href="http://www.twitter.com/<?php echo $user['twitter']?>">
					<?php echo $twitter; ?>
				</div>
			<?php endif ?>
			<?php if (!empty($user['yahoo'])): ?>
				<div class="c" id="yahoo" href="ymsgr:sendIM?<?php echo $user['yahoo']; ?>">
					<?php echo $yahoo; ?>
				</div>
			<?php endif ?>	
			<?php if (!empty($user['facebook'])): ?>
				<div class="c" id="facebook" href="<?php echo $facebookdata['link']; ?>">
					<?php echo $facebook; ?>
				</div>
			<?php endif ?>	
			<?php if (!empty($user['address'])): ?>
				<h3>Alamat</h3>
				<?php $this->googlemaps->display( $user['uid'] ); ?>
				<p><?php echo $user['address'] ?></p>
			<?php endif ?>	
			<?php if (!empty($user['email'])): ?>
				<h3>Email</h3>
				<p class="secure"><?php echo strrev($user['email']); ?></p>
			<?php endif ?>	
			
			<?php if (!empty($user['phone'])): ?>
				<h3>Kontak</h3>
				<p class="secure"><?php echo strrev($user['phone']); ?></p>
			<?php endif ?>				
		</div>
		<!-- END PROFILE -->	
		
		<div id="red-profile-right">
			<!-- INFORMATION START -->
			<div id="red-information">
				<?php echo $user['information']; ?>
			</div>
			<!-- END INFORMATION -->
			
			<!-- PRODUCT START -->
			<div class="clearfix" id="red-products">
			<?php
				$i = 1;			
				foreach ($products as $product) {
					
				echo "<div id='product'><a href='/product?id=" . $product['pid'] . "'>";
				echo $views->getStorage($user['uid'],$product['image_tumb']); 
				echo "</a></div>";
	
		        if ($i % 4 == 0)
		              echo '<div id="productline" class="clear"><hr/></div>';
		        $i++;
				}
				
				// suatu saat diganti post
				if ($readmore == 16) {
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="/profile?id='. $user['uid'] .'&offset='. $page .'#products" >More</a>';
				}

				if ($readmore < 16 && isset($_GET['offset'])) {
					$page = $page-2;
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="/profile?id='. $user['uid'] .'&offset='. $page .'#products" >Back</a>';
				}
			?>
			</div>
			<!-- END PRODUCT -->
		</div>
	</div>
	<!-- CONTENT END -->