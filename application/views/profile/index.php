	<?php $views->js('jquery'); ?>

	<script type='text/javascript'>  
	jQuery(document).ready(function(){
		$("#red-products, #red-information").hide();
		$("#red-" + (window.location.hash.replace("#", "") || "information")).show();
	 
		$("#content-info").click(function(event){
	   		$("#red-products").hide();  
	   		$("#red-information").show(); 
	   	});

		$("#content-product").click(function(event){
			$("#red-products img").hide();
	   		$("#red-information").hide();
	   		$("#red-products").show(); 
			$("#red-products img").fadeIn();
		});

		// START analytics BETA
	    // PATH NAME 
	    // var pathname = window.location.pathname;
	    
	    // REFERRER
	    var referrer = document.referrer.toLowerCase();
	 	
	 	// GET DATA
		function ISODateString(d){
		function pad(n){return n<10 ? '0'+n : n}
		 return d.getFullYear()+'-'
		      + pad(d.getMonth()+1)+'-'
		      + pad(d.getDate())+' '
		      + pad(d.getHours())+':'
		      + pad(d.getMinutes())+':'
		      + pad(d.getSeconds())
		}

		var d = new Date();
		var datetime = ISODateString(d);

		// START THE NETCOID analytics DATA
		var analytics = 
		{ 
			guest_UID: '<?php echo $this->sessions->get('uid'); ?>',
			host_UID: '<?php echo $user['uid']; ?>',
			IP: '<?php echo $_SERVER['REMOTE_ADDR']; ?>',
			referrer: referrer,
			// URL: pathname,
			timecreate:  datetime,
		};  

	    // Create the AJAX request  
	    $.ajax({  
	        type: "POST",                    // Using the POST method  
	        url: "/ajax/analytics/push",      // The file to call  
	        data: analytics,                  // Our data to pass  
	        success: function() {            // What to do on success  
	            //alert(analytics);
	        }  
	    });  
	});  
	</script> 
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		
		<!-- MENU START -->
		<div class="clearfix" id="red-profile-menu">
			<ul class="clearfix">
				
				<!-- FOLLOW OR NOT FOLLOW START -->
				<li><?php
				if ( $user['uid'] == $this->sessions->get('uid')) {
					echo '<a href="/edit/profile">'.l('editprofile').'</a>';
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
					if ($user['role'] == 1) {
						echo '<span class="c" id="status-verified"><a target="_blank" href="/verify/'.$user['username'].'">'.l('verified').' &#x2714;</a></span>'; 
					}
					if ($user['role'] == 3) {
						echo '<span class="c" id="status-mediapartner"><a target="_blank" href="/verify/'.$user['username'].'">'.l('mediapartner').' &#x2714;</a></span>'; 
					}
					if ($user['role'] == 5) {
						echo '<span class="c" id="status-founder">'.l('founder').' &#x2714;</span>'; 
					}
					// @todo add moderator police etc
				?></li>
				<!-- VERIFIED OR NOT ENDS -->
				
				<?php if ($user['role'] == 5): ?>
					<li id="badges"><?php $views->getIMG('power.gif'); ?></li>	
				<?php endif ?>
				
				<!-- SOCIAL POINTS START -->
				<?php if (!empty($socialpoint)): ?>
					<li id="red-profile-name"><?php echo $user['name']; ?> 
					(<?php echo number_format($socialpoint); ?>)</li>					
				<?php endif ?>
				<!-- SOCIAL POINTS END -->
			</ul>
		</div>
		<!-- END START -->		
		
		<!-- PROFILE START -->
		<div id="red-profile-left">
		<?php if (!empty($user['logo'])): ?>
		<div id="profile-logo"><?php $views->getStorage($user['uid'],$user['logo']); ?></div>
		<?php endif ?>

		<?php if (!empty($user['twitter'])): ?>
			<a rel="nofollow" target="_blank" href="http://www.twitter.com/<?php echo $user['twitter']; ?>">
				<div class="cu" id="twitter"><?php echo $twitter; ?></div>
				<div id="twitter-meta" class="cb">@<?php echo $user['twitter']; ?></div>
			</a>
		<?php endif ?>
		<?php if (!empty($user['yahoo'])): ?>
			<a class="c" href="ymsgr:sendIM?<?php echo $user['yahoo']; ?>">
				<div class="cu" id="yahoo"><?php echo $yahoo; ?></div>
				<div id="yahoo-meta" class="cb">@<?php $y = explode('@',$user['yahoo']);echo $y[0]; ?></div>	
			</a>
		<?php endif ?>	
		<?php if (!empty($user['facebook'])): ?>
			<a rel="nofollow" target="_blank" href="<?php echo $facebookdata['link']; ?>">
				<div class="cu" id="facebook"><?php echo $facebook; ?></div>
				<div id="facebook-meta" class="cb">@<?php echo $user['facebook']; ?></div>					
			</a>
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
	
		        if ($i % 4 == 0 && $i != 16)
		              echo '<div id="productline" class="clear"><hr/></div>';
		        $i++;
				}
				// suatu saat diganti post
				if ($readmore == 16) {
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="/'. $user['username'] .'?offset='. $page .'#products" >More</a>';
				}

				if ($readmore < 16 && isset($_GET['offset'])) {
					$page = $page-2;
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="/'. $user['username'] .'?offset='. $page .'#products" >Back</a>';
				}
			?>
			</div>
			<!-- END PRODUCT -->
		</div>
	</div>
	<!-- CONTENT END -->
