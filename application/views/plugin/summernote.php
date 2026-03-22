
<link href="<?= base_url("assets") ?>/css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url("assets") ?>/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<script src="<?= base_url("assets") ?>/js/plugins/summernote/summernote.min.js"></script>

<script>
    $(document).ready(function(){

       $('.summernote').summernote({
     focus: true,
     height: 400,
  minHeight: 400,              
  maxHeight: 600
});
      /*  $("#edit").click(function(){
            $('.click2edit').summernote({focus: true});
        }) 
         $("#save").click(function(){
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        }); */
    });
 
</script>