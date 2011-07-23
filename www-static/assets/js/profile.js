jQuery(document).ready(function(){
	$("#red-products, #red-information, #red-blog").hide();
	$("#red-" + (window.location.hash.replace("#", "") || "information")).show();
 
	$("#content-info").click(function(event){
   		$("#red-products").hide();  
   		$("#red-blog").hide();  
   		$("#red-information").show(); 
   	});

	$("#content-product").click(function(event){
		$("#red-blog").hide();  
		$("#red-information").hide();

		$("#red-products img").hide();
   		$("#red-products").show(); 
		$("#red-products img").fadeIn();
	});

	$("#content-blog").click(function(event){
   		$("#red-products").hide();  
   		$("#red-information").hide();  
   		$("#red-blog").show(); 
	});
});