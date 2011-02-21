/*!
 * NETCOID JAVASCRIPT
 * team
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
 
jQuery(document).ready(function(){

/* validator start */
$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
);

$("#form-productadd").validate({
	onkeyup: false,
	success: function(label) {
		label.addClass("none")
	},
	showErrors: function(errorMap, errorList) {
    $("#form-register").find("input").each(function() {
        $(this).removeClass("error");
    });
    $("#red-error-box").html("");
        if(errorList.length) {
            $("#red-error-box").html(
            	'<ul>
            		<li class="error-list clearfix">
            		<span id="num">-' + this.numberOfInvalids() +'</span><span id="description">' + errorList[0]['message'] + '</span>
            		</li>
            	</ul>'
            	);
        $(errorList[0]['element']).addClass("error");
    	}
	}
});

$("#input-name").rules("add", { regex: /^[a-zA-Z0-9_\s#]{4,20}$/, required : true });
$("#textarea-informationbox").rules("add", { required : true });
$("#input-tag").rules("add", { regex: /^[a-zA-Z0-9]{3,15}$/, required : true });
$("#input-price").rules("add", { regex: /^[0-9]{1,11}$/, required : true });
/* validator ends */
});