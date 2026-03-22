<div id="spinner" class="">
   <div class="loader is-loading">
      <div class="lds-dual-ring"></div>
   </div>
</div>
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
                        <div class="card-block">
                          
                           <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-2">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <label>
                                       Show 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm" id="limitData">
                                          <option value="10">10</option>
                                          <option value="25">25</option>
                                          <option value="50">50</option>
                                          <option value="100">100</option>
                                          <option value="1000">1000</option>
                                       </select>
                                       entries
                                    </label>
                                 </div>
                              </div>
                              
                              
                           </div>
                           <div class="row table-responsive">
                              <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                 <thead class="thead-blue">
                                    <tr>
                                       <th class="cemter-t">No </th>
                                       <th class="cemter-t">Terminal</th>
                                       <th class="cemter-t">Total Area </th>
                                       <th class="cemter-t">Total Kamera</th>
                                       <th class="cemter-t">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="Data-AP">
                                 </tbody>
                              </table>
                           </div>
                           <div class="row"  id="data-pag">

                           </div>
                        </div>
                       
                              
                        
                        </div>
                     </div>
                  </div>
               </div>
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="m-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return SaveGroup(this)">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-10">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Area</label>
                        <div class="col-sm-8">
                           <select class="form-control" name="id_area"  id="id_area">
                              <option>-</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                       <button type="submit" class="btn btn-primary" id="btn-action">Save </button>
                  </div>

               </div>
               
              <div class="row">
                  <div class="col-md-12">
                     <table class="table table-condensed  table-bordered" id="tabel-data-detail">
                        <thead class="thead-blue">
                           <th class="cemter-t">No</th>
                           <th class="cemter-t">Nama Pekerjaan</th>
                           <th class="cemter-t">Area</th>
                           <th class="cemter-t">Status</th>
                           <th class="cemter-t">Action</th>
                        </thead>
                        <tbody id="detail_ap">
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
         </form>
      </div>
   </div>
</div>


<script>

   FilterData();
   function FilterData(id){
      show();
      var formData = new FormData();
         formData.append('limit',  $('#limitData').val());
         formData.append('src',  $('#srcData').val());
         var jenis =($('#jenis_perangkat').val() == null ? '': $('#jenis_perangkat').val());
         formData.append('jenis_perangkat',  jenis);
         var id =(id == null ? 0: id);
      $.ajax({
         url: "<?=base_url().$modul?>/LoadData/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,

         success: function(r){
            var json = JSON.parse(r);
            var header_table = "";
            var pag= "";
            var no= 1;
            jQuery.each(json['data'], function( i, val ) {
               var row = "";
               header_table +=`<tr >
                           <td>${no}</td>
                              <td>${val['nama_terminal']}</td>
                              <td>${val['total_pekerjaan'] == null ? '-':val['total_pekerjaan']}</td>
                              <td>${val['total_kamera'] == null ? '-':val['total_kamera']}</td>
                              <td>
                              <button class="btn waves-effect waves-light btn-primary btn-icon" onclick="ViewData(`+val['id']+`)"><i class="feather icon-edit"></i></button>
                              
                              </td>
                           </tr>`;
                           no++;
            });
            // <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="Delete(`+val['idmenu']+`)"><i class="fa fa-trash"></i></button>
            $('#tabel-data > tbody:last-child').html(header_table);
            $('#data-pag').html(json['pag']['label']);
            hide ();
         }, error: function(){
            hide ();
         }
      });   
      return false;
   }


   function ViewData(id){
         // show();
         $('#m-modal').modal('show');
         $('#m-modal').find('.modal-title').html('Edit Data');   
         $('#m-modal').find('form').attr('onsubmit','return SaveDetail(this,\''+id+'\')');
      DetailData(id);
   }

   function DetailData(id){
         show();
         $.ajax({
               url: "<?=base_url().$modul?>/LoadDataDetail/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
   
               success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                 var no = 1;
                  jQuery.each(json['pekerjaan'], function( i, val ) {
                     var editButton = `<a class="btn waves-effect waves-light btn-primary btn-icon" onclick="EditData(${val['id_ceklis']},'${val['nama_pekerjaan']}','${val['id_area']}','${val['id_lokasi']}')"><i class="feather icon-edit"></i></a>`;
                     var deleteButton =`<a class="btn waves-effect waves-light btn-primary btn-icon btn-danger" onclick="DeleteData(${val['id_ceklis']},${val['id_lokasi']})"><i class="feather icon-trash"></i> </a>`;
                     var btn = editButton+deleteButton;

                     row +=`<tr >
                                       <td >`+(no++)+`</td>
                                       <td >`+val['nama_pekerjaan']+`</td>
                                       <td >`+val['nama_area']+`</td>
                                       <td >`+(val['status'] == 0 ? 'Not Active': 'Active')+`</td>
                                       <td > 
                                        ${btn}
                                       
                                       </td>
                                    </tr>`;
                  });
                
                  $('#tabel-data-detail> tbody:last-child').html(row);
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }

   function EditData(idceklis,nama_pekerjaan,id_area,id_lokasi){
      $('#m-modal').find('form').attr('onsubmit','return UpdateDetail(this,\''+idceklis+'\',\''+id_lokasi+'\')');
      $('#m-modal').find('#btn-action').html('Update');   
     
      $('#nama_pekerjaan').val(nama_pekerjaan);
      $('#id_area').val(id_area).change();

   }

   function SaveDetail(f,id){
         show();
         var formData = new FormData($(f)[0]);
      
         $.ajax({
               url: "<?=base_url().$modul?>/SaveDetail/"+id,
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  // $('#ModakEditMonitoring').modal('hide');
                  var json = JSON.parse(r);
                  DetailData(id);
                  NF(json);
                  hide ();
               }, error: function(){
                  hide ();
               }
         });
                  
            return false;
   }

   function UpdateDetail(f,id,id_lokasi){
      show();
      var formData = new FormData($(f)[0]);
      
      $.ajax({
         url:  '<?=base_url().$modul?>/UpdateDetail/'+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
             var json = JSON.parse(r);
             $(f)[0].reset(); 
             $('#m-modal').find('form').attr('onsubmit','return SaveDetail(this,\''+id_lokasi+'\')');
             $('#m-modal').find('#btn-action').html('Save');   
             DetailData(id_lokasi);
             NF(json);
           FilterData();;
            // ViewDetail(id,date);

          hide(); 
         }, error: function(){
            hide(); 
         }
      });
     
      return false;
     
   }
   function ConfirmData(id,tipe){
      var tit = '';
      var des = '';
      if (tipe == 'proses') {
         tit = "Proses Data";
         des = "Apakah Data Sudah Benar Untuk Diproses Lebih Lanjut?";
      }else if (tipe == 'delete'){
         tit = 'Hapus Data'
         des = "Apakah Sudah Yakin untuk Menghapus Data ini?";
      }
      cuteAlert({
         type: "question",
         title: tit,
         message: des,
         confirmText: "Okay",
         cancelText: "Cancel"
      }).then((e)=>{
         if ( e == ("confirm")){
            // ProsesData(id);
            (tipe =='proses' ? ProsesData(id): DeleteData(id))
         } 
               
      })
   }

   function ProsesData(id){
   
      $.ajax({
         url: "<?= base_url($modul.'/ProsesData/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         }, error: function(){
         hide();
         }
      });

   }

   function DeleteData(id,id_lokasi){
   
      $.ajax({
         url: "<?= base_url($modul.'/DeleteData/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
             DetailData(id_lokasi);
         }, error: function(){
         hide();
         }
      });

   }


   $('body').on('change','#limitData', function() {
      FilterData();
   });

   $('body').on('change','#jenis_perangkat', function() {
      FilterData();
   });

   $( "#srcData" ).on( "keyup", function() {
      FilterData();
   
   } );

   $('body').on('change','#id_lokasi', function() {
   
      if($(this).val() != ''){
       
       var id=$(this).val();
         $.ajax({
            url: '<?= base_url('area/GetAreaByID/') ?>' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
              
            }, error: function(){
            hide();
            }
         });
   
      }
   });

</script>
