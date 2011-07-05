//var direction = "left";
jQuery(document).ready(function(){

	// /global
	$('#red-side-menu a').pjax({
    	container: '#ajax-users-v1',
  	});

  	// /products
	$('.red-pjax a,#ajax-red-link').pjax({
    	container: '#ajax-users-v1',
  	});  	

	$('body')
	.bind('start.pjax', function() {  
		$('#ajax-users-v1').html('<img src="/www-static/assets/images/ajax-loader.gif" style="margin-top: 10px;">')
	})
	   /* .bind('end.pjax',   function() { 
		    direction = (direction == "right" ? "left" : "right") 
		    $('#ajax-red-treeslider').show("slide", { direction: direction }, 400)
		})
*/

});