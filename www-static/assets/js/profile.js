jQuery(document).ready(function(){
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
});