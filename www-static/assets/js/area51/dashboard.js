jQuery(document).ready(function(){

setInterval(function() {
	// GET A AJAX REQUEST EACH 5 SECONDS NANTI KALO UDAH BISA NODE JS BIAR DI PUSH AJA
	$.ajax({
		type: 'GET',
		url: '/area51/ajax',
		context: $("#ajax-information"),
		data: { f: 20 },
		success: function(data) {
			$(this).fadeIn().html(data);
		}
	});
}, 7000);


});