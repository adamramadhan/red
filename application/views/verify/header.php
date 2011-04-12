<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="copyright" content="netcoid 2010" />
		<meta name="description" content="netcoid, jejaring bisnis indonesia, temukan partner baru di sekitar anda." />
		<meta name="keywords" content="jejaring bisnis, social business, partner usaha, usaha indonesia" />
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
		<title>netcoid &mdash; jejaring bisnis indonesia</title>
		<?php $views->css('framework','netcoid.v1','verified'); ?>
		<link rel="icon" type="image/png" href="/www-static/assets/images/f48x48.png" />
	</head>
<body class="<?php $views->activeCSS(); ?>">


  <!-- [if IE] -->
    <script type="text/javascript" 
     src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>

    <style>
     .chromeFrameInstallDefaultStyle {
       width: 100%; /* default is 800px */
       border: 5px solid blue;
     }
    </style>

    <div id="prompt">
     <!-- if IE without GCF, prompt goes here -->
    </div>
 
    <script>
     // The conditional ensures that this code will only execute in IE,
     // Therefore we can use the IE-specific attachEvent without worry
     window.attachEvent("onload", function() {
       CFInstall.check({
         mode: "inline", // the default
         node: "prompt"
       });
     });
    </script>
  <!-- [endif] -->