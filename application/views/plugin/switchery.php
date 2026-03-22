
<link href="<?= base_url("assets") ?>/css/plugins/switchery/switchery.css" rel="stylesheet">
<script src='<?= base_url("assets") ?>/js/plugins/switchery/switchery.js'></script>
<script>
    $(function()	{
        
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch'));

        elems.forEach(function(html) {
            var color = $(html).attr("color");
            var switchery = new Switchery(html, { color:color,size:'small' });
        });
        
        
     
       
    });
</script>