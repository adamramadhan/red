		<div class="clearfix" id="red-product-list">

		<?php 
		#<div id="productline" class="clear"><hr/></div>
			if (isset($_GET['offset'])) {
				if ($_GET['offset'] > 0) {
					$back = $page-2;
					if ($back != 0) {
						echo '<a id="arrow-link" href="?offset='. $back .'" ><div id="product-to-back"><span class="arrow"><</span></div></a>';
					}
					if ($back == 0) {
						echo '<a id="arrow-link" href="?offset=0" ><div id="product-to-back"><span class="arrow"><</span></div></a>';						
					}
				}
			}
		?>
		
		<?php 
			# NEXT BUTTON
			if ($count > 20) {
				echo '<a id="arrow-link" href="?offset='. $page .'" ><div id="product-to-next"><span class="arrow">></span></div></a>';
			}
		?>

			<?php
				$i = 1;	
				foreach ($products as $product) {
					if ( $i <= 20 ) { 
					echo "<div id='product'>";
					echo "<a class='product-image' href='/product?id=" . $product['pid'] . "'>";
					echo $views->getStorage($product['uid'],$product['image_tumb']); 
					echo "</a><span class='product-meta'><p id='product-name'>".$product['name']."</p>";
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
			?>
		</div>	