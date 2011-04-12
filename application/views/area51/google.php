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

    <div id="prompt"><!-- if IE without GCF, prompt goes here --></div>
 
   <div id="oninstall">
     not install
    </div>

   <div id="missing">
     not install
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


</body>
</html>

</div>