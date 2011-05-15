	<?php $views->js('jquery'); ?>

	<script type='text/javascript'>  
jQuery(document).ready(function(){$("#red-products, #red-information").hide();$("#red-"+(window.location.hash.replace("#","")||"information")).show();$("#content-info").click(function(event){$("#red-products").hide();$("#red-information").show();});$("#content-product").click(function(event){$("#red-products img").hide();$("#red-information").hide();$("#red-products").show();$("#red-products img").fadeIn();});var referrer=document.referrer.toLowerCase();function ISODateString(d){function pad(n){return n<10?'0'+n:n}return d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate())+' '+pad(d.getHours())+':'+pad(d.getMinutes())+':'+pad(d.getSeconds())}var d=new Date();var datetime=ISODateString(d);var analytics={guest_UID:'<?php echo $this->sessions->get('uid'); ?>',host_UID:'<?php echo $user['uid']; ?>',IP:'<?php echo $_SERVER['REMOTE_ADDR']; ?>',referrer:referrer,timecreate:datetime,};$.ajax({type:"POST",url:"/ajax/analytics/push",data:analytics});var points={uid:'<?php echo $user['uid']; ?>',facebook:'<?php echo $user['facebook']; ?>',twitter:'<?php echo $user['twitter']; ?>',yahoo:'<?php echo $user['yahoo']; ?>',};$.ajax({type:"POST",url:"/ajax/social/pull/points",data:points,beforeSend:function(){$('#ajax-socialpoint').html('<img src="/www-static/assets/images/ajax-loader.gif" style="position: relative; top: 4px;">');},success:function(data){$('#ajax-socialpoint').hide().fadeIn(3000).html(data);},error:function(){$('#ajax-socialpoint').html('0');}});<?php if(!empty($user['twitter'])):?>var twitter={uid:'<?php echo $user['uid']; ?>',twitter:'<?php echo $user['twitter']; ?>'};$.ajax({type:"POST",url:"/ajax/social/pull/twitter",data:twitter,beforeSend:function(){$('#ajax-pull-twitter').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');},success:function(data){$('#ajax-pull-twitter').hide().fadeIn(3000).html(data);}});<?php endif?><?php if(!empty($user['yahoo'])):?>var yahoo={uid:'<?php echo $user['uid']; ?>',yahoo:'<?php echo $user['yahoo']; ?>'};$.ajax({type:"POST",url:"/ajax/social/pull/yahoo",data:yahoo,beforeSend:function(){$('#ajax-pull-yahoo').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');},success:function(data){$('#ajax-pull-yahoo').hide().fadeIn(3000).html(data);}});<?php endif?><?php if(!empty($user['facebook'])):?>var facebook={uid:'<?php echo $user['uid']; ?>',facebook:'<?php echo $user['facebook']; ?>'};$.ajax({type:"POST",url:"/ajax/social/pull/facebook",data:facebook,beforeSend:function(){$('#ajax-pull-facebook').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');},success:function(data){$('#ajax-pull-facebook').hide().fadeIn(3000).html(data);}});<?php endif?>});
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
					<li id="red-profile-name"><?php echo $user['name']; ?> 
					(<span id="ajax-socialpoint"></span>)</li>
				<!-- SOCIAL POINTS END -->
			</ul>
		</div>
		<!-- END START -->		
		
		<!-- PROFILE START -->
		<div id="red-profile-left">
			<?php if (!empty($user['logo'])): ?>
				<div id="profile-logo"><?php $views->getStorage($user['uid'],$user['logo']); ?></div>
			<?php endif ?>

		<div id="ajax-pull-twitter"></div>
		<div id="ajax-pull-yahoo"></div>
		<div id="ajax-pull-facebook"></div>


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
