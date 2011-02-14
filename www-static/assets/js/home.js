/*!
 * NETCOID JAVASCRIPT
 * team
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
 
jQuery(document).ready(function(){
$('input#input-company').example('PT, CV atau Usaha');
$('input#input-phone').example('021-1234567 / HP');

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

$("#form-register").validate({
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

$("#input-username").rules("add", { regex: /^[a-zA-Z0-9_]{6,20}$/, required : true });
$("#input-password").rules("add", { required : true });
$("#input-company").rules("add", { regex: /^[a-zA-Z0-9_\s]{6,30}$/, required : true });
$("#input-phone").rules("add", { regex: /^([0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12}))$/, required : true });
/* validator ends */

var $urlSuffix = $("#url-suffix");
$("#input-username").keyup(function() {
    var value = $(this).val();
    $urlSuffix.text(value);
});

});