<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- MENU START -->
		<div class="clearfix" id="red-product-menu">
			<ul class="clearfix">
				
				<li><?php echo $product['name'] ?></li>
				<li id="red-product-name"> @
				<a href="/<?php echo $user['username'] ?>">
				<?php echo $user['name'] ?></a></li>				

			</ul>
		</div>
		<!-- END START -->		
		
		<div id="red-product-left">
		<?php  
			$views->getStorage($user['uid'],$product['image']);
		?>			
		</div>
		
		<div id="red-product-right">
			<?php if ( $user['uid'] != $this->sessions->get('uid')): ?>
			<div class="c" id="pesan">
				Pesan produk ini sekarang juga,
				<?php if ( $this->sessions->get('uid')): ?>
					<a href="messages.php?id=<?php echo $user['uid'] ?>"> Kirim Pesan</a>
				<?php endif ?>	
				<?php if ( !$this->sessions->get('uid')): ?>
				 <u>*Masuk untuk kirim pesan*</u>
				<?php endif ?> .
				 atau hubungi langsung @<a href="profile.php?id=<?php echo $user['uid'] ?>">
				<?php echo $user['name'] ?></a> via phone di <?php echo $user['phone'] ?>
			</div>
			<?php endif ?>	

			<h3>Information</h3>
			<p><?php echo $product['information'] ?></p>
			<h3>Harga</h3>
			<p><?php echo $product['price'] ?></p>

		</div>
	</div>
	<!-- CONTENT END -->
