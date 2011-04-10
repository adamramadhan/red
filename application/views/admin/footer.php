	<!-- START FOOTER  -->
	<div id="footer">
		<div class="clearfix" id="footer-warp">
			<ul class="clearfix" id="footer-menu">
					<!-- WHY -->
					<li id="hint"><?php $views->href('/why',l('why')); ?></li>
					<li><?php $views->href('/terms',l('terms')); ?></li>
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
	<link rel="stylesheet" type="text/css" href="/www-static/assets/js/middleware/wmd/wmd.css"/>
	<?php $views->js('middleware/wmd/wmd','middleware/google/google-analytics'); ?>
	<script type="text/javascript">
            setup_wmd({
                input: "js-middleware-wmd-core",
                button_bar: "js-middleware-wmd-menu",
                preview: "js-middleware-wmd-preview",
				output: "js-middleware-wmd-output"
            });
    </script>
</html>