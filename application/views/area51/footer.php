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
<?php $views->js('jquery',"external"); ?>
<script type='text/javascript'>  
jQuery(document).ready(function(){
    // PATH NAME 
    // var pathname = window.location.pathname;
    
    // REFERRER
    var referrer = document.referrer.toLowerCase();
 	
 	// GET DATA
	function ISODateString(d){
	function pad(n){return n<10 ? '0'+n : n}
	 return d.getFullYear()+'-'
	      + pad(d.getMonth()+1)+'-'
	      + pad(d.getDate())+' '
	      + pad(d.getHours())+':'
	      + pad(d.getMinutes())+':'
	      + pad(d.getSeconds())
	}

	var d = new Date();
	var datetime = ISODateString(d);

	// ANOTHER DATA

	// START THE NETCOID ANALITICS DATA
	var analytics = 
	{ 
		guest_UID: '<?php echo $this->sessions->get('uid'); ?>',
		host_UID: '<?php echo $ ?>'
	    IP: '<?php echo $_SERVER['REMOTE_ADDR']; ?>',
	    referrer: referrer,
	    // URL: pathname,
	    timecreate:  datetime,
	};  

    // Create the AJAX request  
    $.ajax({  
        type: "POST",                    // Using the POST method  
        url: "/ajax/analytics/push",      // The file to call  
        data: analytics,                  // Our data to pass  
        success: function() {            // What to do on success  
            //alert(analytics);
        }  
    });  
});  
</script>   

</html>