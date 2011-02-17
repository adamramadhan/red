	$('#pic-1 img').load(function() {	

	if (!$.browser.msie){
		$('#pic-1').css('opacity',0);
		$('#pic-3').css('opacity',0);
		$('#pic-2').css('opacity',0);
	}
	
		$('body').mousemove(function() {	
			$('#pic-1').delay(0).animate({opacity: 1}, 500 );	
			$('#pic-3').delay(600).animate({opacity: 1}, 500 );
			$('#pic-2').delay(1200).animate({opacity: 1}, 500 );
		});
	});