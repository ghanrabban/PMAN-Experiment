<link href="<?= base_url("assets") ?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"/>

<script src="<?= base_url("assets") ?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    $('.tanggal').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    
    $('.tanggal2').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    
    $('.input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        
        format: "dd/mm/yyyy"
    });
    
</script>