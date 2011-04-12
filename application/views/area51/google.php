<div id="content">

<html>
<body>

	    <script type="text/javascript" 
	     src="https://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>

	    <style>
	     .chromeFrameInstallDefaultStyle {
	       width: 100%; /* default is 800px */
	       border: 5px solid blue;
	     }
	    </style>

	    <div id="google-frame-noinstall">
	     hello install google iframe untuk tampilan lebih cepat!.
	    </div>

	    <div id="google-frame-installed">
	     terimakasih
	    </div>
	 
	    <script>
	     // The conditional ensures that this code will only execute in IE,
	     // Therefore we can use the IE-specific attachEvent without worry
	     window.attachEvent("onload", function() {
	       CFInstall.check({
	         mode: "overlay", // the default
	         url: "https://www.google.com/chromeframe"
	         oninstall: "google-iframe-installed",
	         onmissing: "google-frame-noinstall"
	       });
	     });
	    </script>

</body>
</html>

</div>