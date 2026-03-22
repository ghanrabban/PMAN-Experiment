
<script src='<?= base_url("assets") ?>/js/autoNumeric.js'></script>

<script>
    numeric();
    function numeric(){
        $('.numeric').autoNumeric('init',{aPad: false}); 
        $(".numeric").change(function(){
            var a =   $(this).autoNumeric('get');
            $(this).parent().find(".numeric2").val(a);
        });
    }
    
  

    
</script>