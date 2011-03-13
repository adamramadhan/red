
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-full">
		<ul>
			<?php foreach ($mentions as $mention): ?>
				<li class="mentions">
				<span>@<?php echo $mention['name']; ?></span> 
				<?php echo $mention['comment'] ?>

				<?php if (!empty($mention['pid'])): ?>
					<?php echo "<span id='l'><a href='/product?id=".$mention['pid']."#comment-".$mention['cid']."'>see</a></span>"; ?>
				<?php endif ?>

				<?php if (!empty($mention['nid'])): ?>
					<?php echo "<span id='l'><a href='/blog?id=".$mention['nid']."#comment-".$mention['cid']."'>see</a></span>"; ?>
				<?php endif ?>
				
				
				<?php echo "<span id='d'><a href='/comments?o=".$mention['cid']."'>x</a></span>"; ?>
				</li>
			<?php endforeach ?>
		</ul>

		<?php 
		if ( empty($mentions) ) {	
			echo 	'<div class="c" id="red-box-red">
					<p>Mentions adalah Fitur dimana anda dapat menandai atau mentag organisasi atau bisnis lainnya, fitur ini berlaku pada sistim komentar, anda dapat <i>menandai</i> dengan menggunakan tanda "=", atau lengkapnya
					=username untuk mencoba anda dapat menulis komentar "hallo =netcoid uji coba mention ya" di blog atau di produk mana saja. tanda ~username <i>diperuntukan</i> user tidak terverifikasi dan tanda *username = anggota team netcoid.</p>
					</div>';
							
		}	
		?>
		</div>
		<!-- INFORMATION ENDS -->		

		
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->
