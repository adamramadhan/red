
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div class="clearfix" id="red-product-list">
			<?php
				$i = 1;	
				foreach ($products as $product) {
					if ( $i <= 20 ) { 
					echo "<div id='product'><a href='/product?id=" . $product['pid'] . "'>";
					echo $views->getStorage($product['uid'],$product['image_tumb']); 
					echo "</a></div>";
			        if ($i % 5 == 0)
			              echo '<div id="productline" class="clear"><hr/></div>';
			        $i++;
		        	}
				}
				
				/* ok tdnya kan 20 cuma kalo pas 20 pas klick morenya
				ga ada produknya alangkah lebih baiknya kalo seandainya
				diklick minimal ada satu product */
				
				if ($count == 21) {
					echo '
					<a id="more" href="product.php?offset='. $page .'" >More</a>';
				}
	
				if ($count < 21 && isset($_GET['offset'])) {
					$page = $page-2;
					echo '<div id="productline" class="clear"><hr/></div>
					<a id="more" href="product.php?offset='. $page .'" >Back</a>';
				}
			?>
		</div>	
		
		<div id="red-product-tags">
			<h3>Tags</h3>
			<ul><?php
				foreach ($tags as $tag) {
					echo '<li><a href="?tag='.$tag['tag'].'">' . $tag['tag'] . '(' . $tag['counter'] . ')</a></li>';
				}
			?></ul>		
		</div>
	</div>
<!-- CONTENT END -->
