	<!-- START FOOTER  -->
	<div id="footer">
		<div class="clearfix" id="footer-warp">
			<ul class="clearfix" id="footer-menu">
					<!-- WHY -->
					<li id="hint"><?php $this->href('why',l('why')); ?></li>
					<li><?php $this->href('terms',l('terms')); ?></li>
					<li><?php $this->href('netcoid',l('contactus')); ?></li>
					<li><?php $this->href('help',l('helpcenter')); ?></li>
			</ul>
			
			<ul class="clearfix" id="copyright">
				<li><p><?php echo l('copyright'); ?></p></li>
			</ul>
		</div>
	</div>
	<!-- END FOOTER  -->
	
	</body>
	<?php $this->js('jquery,home'); ?>
</html>