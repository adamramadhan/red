<?php if (!empty($group)): ?>
	<?php $views->JS('jquery'); ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		var search = 
		{ 
			tag: '<?php echo $group['tag']; ?>',
		};  
	    // Create the AJAX request  
	    $.ajax({  
	        type: "POST",                    // Using the POST method  
	        url: "/ajax/social/pull/search",      // The file to call  
	        data: search,                  // Our data to pass  
	        beforeSend: function(){
	        	$('#ajax-talkperhour').html('<img src="/www-static/assets/images/ajax-loader.gif" style="position: relative; top: 4px;">');
	        },
	        success: function(data) {            // What to do on success  
	        	console.log(data);
	            $('#ajax-talkperhour').hide().fadeIn(3000).html(data);
	        }  
	    });  
	});  
	</script>
<?php endif ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<div class="clearfix" id="red-product-list">

			<?php if (!empty($group)): ?>
				<div id="product-group">
					<div id="product-group-meta">
						<div class="clearfix">
							<h3 class="l"><?php echo $group['group']; ?></h3>
							<span id="ajax-talkperhour" class="l">( 1233 People talking / Hour )</span>
						</div>
						<p><?php echo $group['information']; ?></p>
					</div>
				</div>
			<?php endif ?>
			<?php
				$i = 1;	
				foreach ($products as $product) {
					if ( $i <= 20 ) { 
					echo "<div id='product'>";
					echo "<a class='product-image' href='/product?id=" . $product['pid'] . "'>";
					echo $views->getStorage($product['uid'],$product['image_tumb']); 
					echo "</a><span class='product-meta'><p>".$product['name']."</p>";
					if ($product['role'] == 1) {
						echo "<p style='font-weight: normal;'>by 
						<a class='u' href='/".$product['cusername']."'>".$product['cname']." ✔</a></p></span>";
						echo "</div>";
					}

					if ($product['role'] != 1) {
						echo "<p style='font-weight: normal;'>by 
						<a class='u' href='/".$product['cusername']."'>".$product['cname']."</a></p></span>";
						echo "</div>";
					}

			        if ($i % 5 == 0)
			              echo '<div id="productline" class="clear"><hr/></div>';
			        $i++;
		        	}
				}
				
				/* ok tdnya kan 20 cuma kalo pas 20 pas klick morenya
				ga ada produknya alangkah lebih baiknya kalo seandainya
				diklick minimal ada satu product */
				if ($count > 20) {
					echo '
					<a id="more" href="/products?offset='. $page .'" >More</a>';
				}
	
				if ($count < 20 && isset($_GET['offset'])) {
					$page = $page-2;
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="/products?offset='. $page .'" >Back</a>';
				}
			?>
		</div>	
		
		<div id="red-product-tags">
			<h3>Groups</h3>
			<li><a href="/products" style="font-size: 9px;">Tampilkan Semua</a></li>
			<ul>
			<?php
			if (!is_get('groups','none')) {
				foreach ($groups as $group) {
					$group['tags'] = explode(',',$group['tags']); 
					if (!empty($group['tags']) && !empty($group['group']) && $group['group'] != 'others') {
						echo '<li class="headers">'.ucfirst($group['group']).'</li>';
						echo '<ul>';
						foreach ($group['tags'] as $tag) {
							echo '<li><a href="/products?tag='.$tag.'">'.$tag.'</a></li>';
						}
						echo '</ul>';
					}
				}
			}
			?>
			<li style="font-size: 9px;"><a href="/products?groups=none">Belum Terdaftar</a></li>
			<?php
			if (is_get('groups','none')) {
				foreach ($groups as $group) {
					$group['tags'] = explode(',',$group['tags']); 
					if (!empty($group['tags']) && $group['group'] == 'others' ) {
						echo '<ul>';
						foreach ($group['tags'] as $tag) {
							echo '<li><a href="/products?tag='.$tag.'">'.$tag.'</a></li>';
						}	
						echo '</ul>';				
					}
				}
			}
			?>
			</ul>
		</div>
	</div>
<!-- CONTENT END -->
