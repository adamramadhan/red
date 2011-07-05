<script type="text/javascript">
jQuery(document).ready(function(){
	$('#red-side-menu a').pjax({
    	container: '#ajax-users-v1',
  	});

	//$('#red-side-menu a').pjax('#ajax-users-v1').live('click', function(){
	//  $(this).showLoader()
	//})
	var whereslide;
	if (typeof obj.whereslide != 'undefined') {
		whereslide = true;
	}
	if (whereslide) {
		$('body')
		.bind('start.pjax', function() { $('#ajax-users-v1').show("slide", { direction: "right" });  })
		.bind('end.pjax',   function() {  })
		whereslide = false;
	};

	if (!whereslide) {
	$('body')
	  .bind('start.pjax', function() { $('#ajax-users-v1').show("slide", { direction: "left" });  })
	  .bind('end.pjax',   function() {  })
	  whereslide = true;
	}

	$('#red-edit-full a').pjax({
		container: '#ajax-users-v1',
	});  	
});
</script>