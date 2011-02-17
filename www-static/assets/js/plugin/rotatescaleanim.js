var rmatrix = /matrix\(\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)\)/;

jQuery.support.scaleTransformProp = (function() {
    var div = document.createElement('div');
    return div.style.MozTransform === '' ? 'MozTransform' : 
           div.style.WebkitTransform === '' ? 'WebkitTransform' :
           div.style.OTransform === '' ? 'OTransform' :
           div.style.MsTransform === '' ? 'MsTransform' :
           false;
})();

if (jQuery.support.scaleTransformProp) {
                
	jQuery.cssHooks['scale'] = {
	    get: function(elem, computed, extra) {
	        var transform = jQuery.curCSS(elem, jQuery.support.scaleTransformProp),
	            m = transform.match(rmatrix);
	        return m && parseFloat(m[1]) || 1.0;
	    },
	    set: function(elem, val) {
	        var transform = jQuery.curCSS(elem, jQuery.support.scaleTransformProp);
	        if (transform.match(rmatrix)) {
	            elem.style[jQuery.support.scaleTransformProp]= transform.replace(rmatrix, function(m, $1, $2, $3, $4, $5, $6) {
	                return 'matrix(' + [val, $2, $3, val, $5, $6].join(',') + ')';
	            });
	        } else {            
	        elem.style[jQuery.support.scaleTransformProp]= 'scale(' + val + ')';
	        }
	    }
	};
	
	jQuery.fx.step.scale = function(fx) {
	    jQuery.cssHooks['scale'].set(fx.elem, fx.now)
	};

}

/*SEMENTARA*/
$('#why-red a').hover(function() {
	$(this).animate({ 
		'scale' : 1.1
		}, 200);	
	}, function() {
	$(this).animate({ 
		'scale': 1
		}, 200);
});