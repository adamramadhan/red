/*!
 * NETCOID JAVASCRIPT
 * team
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
 
jQuery(document).ready(function(){

$(".red-ajax-select").chosen();

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

$("#form-productadd").validate({onkeyup: false});

$("input#input-name").rules("add", { regex: /^[a-zA-Z0-9_\s#]{4,20}$/, required : true });
$("#textarea-informationbox").rules("add", { required : true });
$("#input-image").rules("add", { required : true });
$("#input-price").rules("add", { regex: /^[0-9]{1,11}$/, required : true });
/* validator ends */
});