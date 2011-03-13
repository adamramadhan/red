<?php if (config('features/comments/core')): ?>
	<?php $this->validation->geterrors(); ?>
<?php endif ?>

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
		
		<div class="clearfix" id="red-product">
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
						<a href="/messages?id=<?php echo $user['uid'] ?>"> Kirim Pesan</a>
					<?php endif ?>	
					<?php if ( !$this->sessions->get('uid')): ?>
					 <u>*Masuk untuk berkomentar atau mengirim pesan*</u>
					<?php endif ?> .
					 atau hubungi langsung @<a href="/<?php echo $user['username'] ?>">
					<?php echo $user['name'] ?></a> via phone di <span class="secure"><?php echo strrev($user['phone']); ?></span>
				</div>
				<?php endif ?>	
	
				<h3>Information</h3>
				<p><?php echo $product['information'] ?></p>
				<h3>Harga</h3>
				<p><?php echo $product['price'] ?></p>
			</div>			
		</div>

		
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
					<form accept-charset="utf-8" method="post" action="/product?id=<?php echo $_GET['id']; ?>" >
						<ul>
							<li><?php $this->forms->textarea('comment',l('addcomment'), array( 
									  'cols' => '137',
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
					echo "<span id='time'>".$this->time->formatDateDiff($comment['timecreate'])."</span>";
					if ($this->sessions->get('uid') == $comment['uid']) {
						echo "<span id='d'><a href='/comments?d=".$comment['cid']."'>x</a></span>";
					}
					echo "</li>";
				} ?>
			</ul>
		</div>
		<?php endif ?>
		<!-- COMMENT END -->
		
	</div>
	<!-- CONTENT END -->