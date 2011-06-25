	<!-- START FOOTER  -->
	<div id="footer">
		<div class="clearfix" id="footer-warp">
			<ul class="clearfix" id="footer-menu">
					<!-- WHY -->
					<li id="hint"><?php $views->href('/why',l('why')); ?></li>
					<li><?php $views->href('/terms',l('terms')); ?></li>
					<li><?php $views->href('/privacy',l('privacy')); ?></li>
					<li><?php $views->href('/netcoid',l('contactus')); ?></li>
					<li><?php $views->href('/help',l('helpcenter')); ?></li>
			</ul>
			
			<ul class="clearfix" id="copyright">
				<li><p><a href="/allstars"><?php echo l('copyright'); ?></a></p></li>
				<li id="verified-business"><a href="/verify"><?php $views->getIMG('verified.png'); ?></a></li>
			</ul>
		</div>
	</div>
	<!-- END FOOTER  -->
	
	</body>

<?php 
if (!config('development')) {
	$views->js('middleware/google/google-analytics');
}
?>

</html>