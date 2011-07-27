    // Judul
    // todo hal ini masih dipake di edit dan di add, seharusnya dipisah

    setup_wmd({
        input: "js-middleware-wmd-core",
        button_bar: "js-middleware-wmd-menu",
        preview: "js-middleware-wmd-preview",
        output: "js-middleware-wmd-output"
    });
            
    jQuery(document).ready(function(){
        $("#input-title").keyup(function() {
            var value = $(this).val();
             $("#title-suffix").text(value);
        });


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

        $("#form-blogadd").validate({
            onkeyup: false
        });

        $("#input-title").rules("add", { regex: /^[a-zA-Z0-9_\s#?,]{4,70}$/, required : true });
        $("#js-middleware-wmd-core").rules("add", { required : true });
        $("#input-tag").rules("add", { regex: /^[a-zA-Z0-9]{3,15}$/, required : true });
        /* validator ends */
    });
    </script>