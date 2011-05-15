	jQuery(document).ready(function(){

		/* INFORMATION & PRODUCT AJAX */
		$("#red-products, #red-information").hide();
		$("#red-" + (window.location.hash.replace("#", "") || "information")).show();
	 
		$("#content-info").click(function(event){
	   		$("#red-products").hide();  
	   		$("#red-information").show(); 
	   	});

		$("#content-product").click(function(event){
			$("#red-products img").hide();
	   		$("#red-information").hide();
	   		$("#red-products").show(); 
			$("#red-products img").fadeIn();
		});

		/* START analytics BETA */

	    /* var pathname = window.location.pathname; */
	    /* REFERRER */
	    var referrer = document.referrer.toLowerCase();
	 	
	 	/* GET DATA */
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

		/* START THE NETCOID analytics DATA */
		var analytics = 
		{ 
			guest_UID: '<?php echo $this->sessions->get('uid'); ?>',
			host_UID: '<?php echo $user['uid']; ?>',
			IP: '<?php echo $_SERVER['REMOTE_ADDR']; ?>',
			referrer: referrer,
			// URL: pathname,
			timecreate:  datetime,
		};  

	    // Create the AJAX request  
	    $.ajax({  
	        type: "POST",                     // Using the POST method  
	        url: "/ajax/analytics/push",      // The file to call  
	        data: analytics					  // SENDS DATA
	    });  

	    // SOCIAL PLUGIN
	    var points = 
	    {
	    	uid: 		'<?php echo $user['uid']; ?>',
	    	facebook: 	'<?php echo $user['facebook']; ?>',
	    	twitter: 	'<?php echo $user['twitter']; ?>',
	    	yahoo: 		'<?php echo $user['yahoo']; ?>',
	    };

	    /* ########### SOCIAL POINTS ########### */
	    $.ajax({  
	        type: "POST",                    	// Using the POST method  
	        url: "/ajax/social/pull/points",	// The file to call  
	        data: points,						// Our data to pass  
	        beforeSend: function(){
	        	$('#ajax-socialpoint').html('<img src="/www-static/assets/images/ajax-loader.gif" style="position: relative; top: 4px;">');
	        },
	        success: function(data) {           
	        	$('#ajax-socialpoint').hide().fadeIn(3000).html(data);
	        },
	        error: function(){
	        	$('#ajax-socialpoint').html('0');	
	        }
	    });  

	    /* ########### TWITTER ########### */
		<?php if (!empty($user['twitter'])): ?>
	    var twitter = 
	    {
	    	uid: '<?php echo $user['uid']; ?>',
	    	twitter: '<?php echo $user['twitter']; ?>'
	    };

	    $.ajax({  
	        type: "POST",                    	// Using the POST method  
	        url: "/ajax/social/pull/twitter",	// The file to call  
	        data: twitter,                		// Our data to pass  
	        beforeSend: function(){
	        	$('#ajax-pull-twitter').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');
	        },
	        success: function(data) {           
	        	$('#ajax-pull-twitter').hide().fadeIn(3000).html(data);
	        }
	    });  
		<?php endif ?>	
		// END TWITTER	   
		 
	    /* ########### YAHOO ########### */
		<?php if (!empty($user['yahoo'])): ?>
	    var yahoo = 
	    {
	    	uid: '<?php echo $user['uid']; ?>',
	    	yahoo: '<?php echo $user['yahoo']; ?>'
	    };

	    $.ajax({  
	        type: "POST",                    	// Using the POST method  
	        url: "/ajax/social/pull/yahoo",		// The file to call  
	        data: yahoo,                 		// Our data to pass  
	        beforeSend: function(){
	        	$('#ajax-pull-yahoo').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');
	        },
	        success: function(data) {           
	        	$('#ajax-pull-yahoo').hide().fadeIn(3000).html(data);
	        }
	    });  
		<?php endif ?>	
		// END YAHOO

	    /* ########### FACEBOOK ########### */
	    <?php if (!empty($user['facebook'])): ?>
	    var facebook = 
	    {
	    	uid: '<?php echo $user['uid']; ?>',
	    	facebook: '<?php echo $user['facebook']; ?>'
	    };

	    $.ajax({  
	        type: "POST",                    // Using the POST method  
	        url: "/ajax/social/pull/facebook",      // The file to call  
	        data: facebook,                  // Our data to pass  
	        beforeSend: function(){
	        	$('#ajax-pull-facebook').html('<a rel="nofollow" target="_blank" href="#"><img style="position: relative; top: 4px; left: 50%;" src="/www-static/assets/images/ajax-loader.gif"></a>');	        	
	        },
	        success: function(data) {           
	        	$('#ajax-pull-facebook').hide().fadeIn(3000).html(data);
	        }
	    });  
		<?php endif ?>	
		// END FACEBOOK

	});  