<style>
    .mt-s{
      margin-top: 15px;
   }
   .mb-10 {
    margin-bottom: 10px;
   }
   .mb-20 {
    margin-bottom: 20px;
   }
   
</style>
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-home bg-c-blue"></i>
            <div class="d-inline">
               <h5><?=$title?></h5>
               <span><?=$title_des?></span>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <!-- [ page content ] start -->
               <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block ">
                        <ul class="nav nav-tabs  tabs tab-nav-monitoring mb-20" role="tablist" >
                           <li class="nav-item nav-link "  role="presentation" id="usulan" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">Usulan</a>
                           </li>
                            <li class="nav-item nav-link "  role="presentation" id="pekerjaan">
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">Pekerjaan</a>
                           </li>
                           <li class="nav-item nav-link" role="presentation" id="realisasi" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">Realisasi</a>
                           </li>
                           <li class="nav-item nav-link" role="presentation" id="attachment" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">Attachment</a>
                           </li>
                        </ul>
                     <div class="tab-pane dataTables_wrapper dt-bootstrap4" id="profile1" role="tabpanel">
                        <div id="view-load"></div>
                        
                     </div>
                  </div>
               </div>
            </div>
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>

<link href="<?=base_url()?>assets_v2/plugins/form-select2/select2.css" rel="stylesheet" >
<script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/form-select2/select2.js"></script>
<script>
   var id='<?=$id?>';
   var url = new URL(window.location.href);
   var param = url.searchParams.get("tab");

   if(param != null){
      load(param,id,'');
      $('#'+param).addClass('active');
   }else{ 
      load('usulan',id,''); 
      window.history.pushState('', 'Title', '?tab=usulan');
      $('#usulan').addClass('active');

   }
   
   $('.tab-nav-monitoring  li[role!=x]').click(function(){
         var li = $(this).index();
     		$('li').removeClass('active');
     		$(this).addClass('active');
       
         var page=  $(this).attr("id");
         window.history.pushState('', 'Title', '?tab='+page);
      //   window.history.go(-1); return false;
         load(page,id,'');

   });


   function load(page,id){
      $.ajax({
         url: '<?=base_url()?>Monitoring/load/'+page+'/'+id,
         success: function(r){
            $('#view-load').html(r);
         }, error: function(){
            // err();
         }
      });
   }
  
</script>
