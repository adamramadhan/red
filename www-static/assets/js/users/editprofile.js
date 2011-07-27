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

$("#form-useredit").validate({onkeyup: false});

$("#textarea-address").rules("add", { required : true });
$("#input-phone").rules("add", { regex: /^[0]([0-9]{2}|[0-9]{3})[-][0-9]{6,8}|[0][8]([0-9]{8,12})$/, required : true });
$("#input-email").rules("add", { regex: /^[a-zA-Z0-9-_.]+@([a-zA-Z0-9-_]{1,67}\.){1,5}[a-zA-Z]{2,4}$/, required : true });
/* validator ends */
});