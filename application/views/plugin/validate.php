
<script src='<?= base_url("assets/js/plugins/validate") ?>/jquery.validate.min.js'></script>
<script src='<?= base_url("assets/js/plugins/validate") ?>/localization/messages_id.js'></script>
<script>
    $(document).ready(function(){
        $.validator.addMethod("validpassword", function(value, element) {
            return this.optional(element) ||
                /^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W]).*$/i.test(value);
        }, "Password harus memiliki kombinasi huruf kecil," +
            " huruf besar, angka dan spesial karakter"); 
    });
</script>


