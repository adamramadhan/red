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
				<li><p><?php echo l('copyright'); ?></p></li>
				<li id="verified-business"><a href="/verify/netcoid"><?php $views->getIMG('verified.png'); ?></a></li>
			</ul>
		</div>
	</div>
	<!-- END FOOTER  -->
	
	</body>

<?php $views->js('jquery,middleware/jquery/jquery.validation,middleware/jquery/jquery.pjax','external'); ?>
 <script type="text/javascript">
	jQuery(document).ready(function(){
		$('#arrow-link').pjax({
	    	container: '#ajax-users-dashboard',
	  	});
	});
</script>
<?php 

if (!config('development')) {
	$views->js('middleware/google/google-analytics');
}
?>
</html>
