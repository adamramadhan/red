jQuery(document).ready(function(){
    // PATH NAME
    var pathname = window.location.pathname;
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
		UID: '<?php echo $this->sessions->get('uid'); ?>',
	    IP: '<?php echo $_SERVER['REMOTE_ADDR']; ?>',
	    referrer: referrer,
	    URL: pathname,
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