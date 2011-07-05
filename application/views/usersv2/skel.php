<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="copyright" content="netcoid 2010" />
		<meta name="description" content="netcoid, jejaring bisnis indonesia, temukan partner baru di sekitar anda." />
		<meta name="keywords" content="jejaring bisnis, social business, partner usaha, usaha indonesia" />
		<title>netcoid &mdash; jejaring bisnis indonesia</title>
		<meta content="noodp,noydir" name="robots">
		<link rel="icon" type="image/png" href="/www-static/assets/images/f48x48.png" />
		<noscript><meta http-equiv="X-Frame-Options" content="deny" /></noscript>
		<noscript><meta http-equiv=refresh content="0; URL=/nojs" /></noscript>
		<?php 	
			$views->CSS( $this->preCSShooks, 'external');
			$views->JS( $this->preJShooks, 'external'); 
		?>
	</head>
<body>
<?php $this->active->menu ( $this->sessions->get ( 'uid' ), $this ); ?>
<?php $this->validation->geterrors(); ?>
	
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div class="l clearfix" id="ajax-users-box">
		<!-- AJAX CONTENT START -->

		

		<!-- AJAX CONTENT END -->
		</div>
	<?php $this->View('users/menu-right'); ?>
	</div> <!-- CONTENT END -->

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
	<?php $views->JS( $this->postJShooks, 'external'); ?>
</body>
</html>