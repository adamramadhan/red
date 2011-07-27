<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="copyright" content="netcoid 2011" />
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
<?php $this->validation->getErrors(); ?>
<?php $this->messenger->getMessage(); ?>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div class="l clearfix" id="ajax-users-v1">
		<!-- AJAX CONTENT START -->