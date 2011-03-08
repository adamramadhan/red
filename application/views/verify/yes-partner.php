	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="verified-partners">
			<ul>
				<li class="clearfix" id="seal">
					<?php $views->getSTORAGE($user['uid'],$user['seal_image']); ?>
				</li>
			</ul>
			<ul id="meta-information" class="clearfix">
				<li class="l"><i>Bila data ini tidak sesuai segera hubungi security@networks.co.id</i></li>
				<li class="r"><i>Valid hingga <?php echo $user['seal_date'] ?></i></li>
			</ul>
		</div>
	</div>
	<!-- CONTENT END -->