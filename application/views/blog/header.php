<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="copyright" content="netcoid 2011" />
		<meta name="description" content="netcoid, jejaring bisnis indonesia, temukan partner baru di sekitar anda." />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<title><?php echo $title; ?></title>
		<?php $views->css('framework','netcoid.v1','blog'); ?>
		<meta content="noodp,noydir" name="robots">
		<link rel="icon" type="image/png" href="/www-static/assets/images/f48x48.png" />
		<noscript><meta http-equiv="X-Frame-Options" content="deny" /></noscript>
		<noscript><meta http-equiv=refresh content="0; URL=/nojs" /></noscript>
		
 		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<?php $is_mobile = $this->mobile->mobile_device_detect(); ?>
		<?php if ($is_mobile[0]): ?>
			<link rel="stylesheet" href="/www-static/assets/css/mobile.css" />
		<?php endif ?>
		
	</head>
<body>