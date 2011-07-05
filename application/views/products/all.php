		<div class="clearfix" id="groups">
		<ul>
			<?php
			# JIKA GAK ADA TAG
			if (empty($tags)) {
				echo '<li><a class="redpjax-group" href="/products">Tampilkan Semua</a></li>';
				foreach ($groups as $value) {
					$value['tags'] = explode(',',$value['tags']);
					if (!empty($value['tags'])){
						echo '<li><a class="redpjax-group" href="/products/'.$value['group'].'">#'.$value['group'].'</a></li>';
					}				
				}
			}

			# JIKA ADA TAG
			if (!empty($tags)) {
				echo '<li><a class="redpjax-group" href="/products">Kembali</a></li>';
				foreach ($tags as $tag) {
					if (!empty($tag['tag'])) {
						echo '<li><a  class="redpjax-group" href="/products/'.$current_group.'/'.$tag['tag'].'">#'.$tag['tag'].'</a></li>';
					}				
				}
			}
			?>
		</ul>
		</div>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<?php if (config('features/search/core')): ?>
			<div id="search">
				<form action="#" name="f">
					<input autocomplete="off" maxlength="2048" name="query" title="Google Search" value="" spellcheck="false">					
				</form>
			</div>
		<?php endif ?>

		<?php if (!empty($group)): ?>
			<div id="product-group">
				<div id="product-group-meta">
					<div class="clearfix">
					<h3 class="l"><?php echo ucfirst($group['tag']); ?></h3>
						<span id="ajax-talkperhour" class="l"></span>
					</div>
					<p><?php echo $group['information']; ?></p>
				</div>
			</div>
		<div id="ajax-netcoidtrends"></div>
		<?php endif ?>

		<div class="clearfix" id="red-product-list">

		<?php 
			# BACK BUTTON
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

		<?php if (!empty($group)): ?>
				<div id="productline" class="clear"><hr/></div>
		<?php endif ?>

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

	</div>
<!-- CONTENT END -->


<?php $views->js('jquery,middleware/jquery/jquery.pjax','external'); ?>
  <script type="text/javascript">
    $(function(){
      $('#arrow-link,.redpjax-group').pjax({
	    container: '#red-product-list',
	  });

  $('#red-product-list')
    .bind('start.pjax', function() { $('#red-product-list').html('<img style="position: relative; top: 200px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif">') })
	    .bind('end.pjax', function() { 
	    	// @todo add loading to image
		})
	});
</script>
<?php if (!empty($group)): ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		// SEARCH START
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
	        	//console.log(data);
	            $('#ajax-talkperhour').hide().fadeIn(3000).html(data);
	        }  
	    });

		var trends = 
		{ 
			tag: '<?php echo $group['tag']; ?>',
		};  
	    // Create the AJAX request  
	    $.ajax({  
	        type: "POST",                    // Using the POST method  
	        url: "/ajax/social/pull/trends",      // The file to call  
	        data: trends, 
	        dataType: 'html',   
	        beforeSend: function(){
	        	$('#ajax-netcoidtrends').html('<img style="position: relative; margin: 0pt auto; display: block;" src="/www-static/assets/images/ajax-loader.gif">');
	        },
	        success: function(data) {
  				$('#ajax-netcoidtrends').hide().fadeIn(3000).html(data);
	        }  
	    });

	});  
	</script>

<?php endif ?>