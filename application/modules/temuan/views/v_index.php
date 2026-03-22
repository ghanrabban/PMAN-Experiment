
 <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/select2/dist/js/select2.full.js"></script>

<style>
    .pointer {
        cursor: pointer;
    }
    .hiddenRow {
    padding: 0 !important;
   }
   .form-group {
      margin-bottom: 0.50em;
   }
   .mb-10 {
    margin-bottom: 10px;
   }
   .lg-stat{
      width: 15px;
      height: 15px;
      border-radius: 50%;
   }
   .align-middle {
      padding-top: 2px;
    
      padding-left: 10px;
   }
   .modal-black{
      background-color: #131a22;
   }
   .modal-wt {
      color: #fff;
   }
   .pd-2{
      padding-left: 5px;
      padding-right: 5px;
   }
   .label-primary {
    background: #4e79a7;
   }
   .label-success {
    background: #59a14f;
   }
   .label-danger {
    background: #e15759;
   }
   td, th {
    white-space: normal;
   }
   .btn.btn-icon2 {
      width: 35px;
      line-height: 20px;
      height: 35px;
      padding: 8px;
      text-align: center;
   }
   .table-bordered {
    border: 1px solid #EBEBEB;
   }
   table {
   
    border-spacing: 2px;
   }
   .table-bordered td, .table-bordered th {
      padding: 10px;
   }
   .table .thead-dark th {
      color: #fff;
      background-color: #878888b8;
      border-color: #878d93f5;
   }
   .putih{
      color: #fff;
   }
   .merah{
      color: #fc0303;
   }

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 40px;
    /* user-select: none; */
    -webkit-user-select: none;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    background-color: #4099ff00;
    color: #383838b0;
    padding: 8px 30px 8px 10px;
}
.select2-container {
        width: 100%;
        border: unset;
    }
</style>
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
                              <div class="row" id="export">
                                 <div class="col-md-12">
                                    <div class="pull-right putih mb-10">
                                       <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Tambah</a>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                       <div class="dataTables_length" id="complex-dt_length">
                                          <label>
                                             Show 
                                             <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm" id="limitData">
                                             <option value="5">5</option>   
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
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div id="complex-dt_filter" class="dataTables_filter">
                                       <label>Search:
                                          <input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                                    </div>
                              </div>
                              <div class="row">
                                 <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">No</th>
                                             <th class="cemter-t">Fasilitas</th>
                                             <th class="cemter-t">Tanggal</th>
                                             <th class="cemter-t">Kondisi</th>
                                             <th class="cemter-t">Keterangan</th>
                                             <th class="cemter-t">Status</th>
                                             <th class="cemter-t">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody >

                                       </tbody>
                                    </table>
                                 </div>
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
<div class="modal fade" id="m-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                 
               <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Fasilitas</label>
                   <div class="col-sm-10">
                       <select class="js-data-example-ajax" style="width: 300px"  name="id_fasilitas" id="id_fasilitas"></select>
                    
                      <!-- <select class="form-control" name=""  id="id_fasilitas">
                         <option value=""></option>
                      </select> -->
                   </div>
               </div>
               
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Fasilitas</label>
                   <div class="col-sm-10">
                        <input type="hidden" id="id_fasilitas2" style="width: 300px" name="id_fasilitas2"  />
                    
                      <!-- <select class="form-control" name=""  id="id_fasilitas">
                         <option value=""></option>
                      </select> -->
                   </div>
               </div>
                
              
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Tanggal</label>
                   <div class="col-sm-10">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" >
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Kondisi Fasilitas</label>
                   <div class="col-sm-10">
                     <select class="form-control" name="kondisi"  id="kondisi">
                        <option value=""></option>
                         <option value="ON">ON</option>
                         <option value="OFF">OFF</option>
                      </select>
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Narasi Hasil Temuan</label>
                   <div class="col-sm-10">
                     <textarea id="keterangan" name="keterangan" rows="4" cols="50" class="form-control"></textarea>
                   </div>
                </div>
                
               
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 <div class="modal fade" id="requestModalView" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestModalLabel">Request Tiket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="post" enctype="multipart/form-data" onsubmit="return SaveData(this)">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <!-- New input fields for pembuat dan nomor tiket -->
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Fasilitas</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8 pr-0  pl-0"><span id="l_fasilitas"></span></div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Tanggal Temuan</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0"><span id="l_tanggal"></span></div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label" for="foto_before">Kondisi Fasilitas</label>
                           <div class="col-sm-8  pr-0  pl-0"><span id="l_kondisi"></span></div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Keterangan</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0"><span id="l_keterangan"></span></div>
                        </div>
                       
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
</div>


<script>
  
   FilterData();
    
   function FilterData(id){
      show();
      var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      formData.append('src',  $('#srcData').val());
      var id =(id == null ? 0: id);
      $.ajax({
         url: "<?=base_url()?>temuan/LoadData/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,

         success: function(r){
            var json = JSON.parse(r);
            var header_table = "";
            var pag= "";
            var no = 1;
            jQuery.each(json['data'], function( i, val ) {
               var row = "";
               var BTN ='';
               var prosesBtn  = `<button class="btn waves-effect waves-light btn-primary btn-icon" onclick="ConfirmData('` + val['id_temuan'] + `','proses')"><i class="fa fa-gear"></i></button>   `;
               var editBtn    = `<button class="btn waves-effect waves-light btn-primary btn-icon" onclick="EditData('` + val['id_temuan'] + `')"><i class="feather icon-edit"></i></button>`;
               var viewBtn    = `<button class="btn waves-effect waves-light btn-primary btn-icon" onclick="ViewData('` + val['id_temuan'] + `')"><i class="feather icon-eye"></i></button>`;
               var delBtn     = `<button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_temuan']+`,'delete')"><i class="fa fa-trash"></i></button>`;
               
               if (val['status'] === '0') {
                
                  BTN = editBtn+prosesBtn+delBtn;
               }else if (val['status'] === '9') {
                  BTN = viewBtn; 
               } else if (val['status'] === '1') {
                  BTN = viewBtn; 
               }
               header_table +=`<tr >    
                  <td>`+(no)+`</td>
                  <td>`+(val['fasilitas']    == null ? '': val['fasilitas'])+`</td>
                  <td>`+(val['tanggal']       == null ? '': val['tanggal'])+`</td>
                  <td>`+(val['kondisi']       == null ? '': val['kondisi'])+`</td>
                  <td>`+(val['keterangan']   == null ? '': val['keterangan'])+`</td>
                  <td>`+(val['status']       == null ? '': val['status_label'])+`</td>
                  <td> ${BTN}</td>
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

//   var lastResults = [];
//   $("#id_fasilitas").select2({
//       multiple: false,
//       placeholder: "Pilih Fasilitas",
//       ajax: {
//             url:  "<?= base_url('fasilitas/GetFasilitasTemuan') ?>",
//             dataType: 'json',
//             type: "POST",
//             quietMillis: 50,
//             data: function (serc) {
//                 return {
//                     serc: serc
//                 };
//                  alert("error");
//             },
//             results: function (data) {
              
//                 return {
                     
//                     results: $.map(data, function (item) {
//                          console.log(item+'tess');
//                         return {
//                             text: item.text,
//                             id: item.id
//                         }
//                     })
//                 };
//             }
//         },
//   });
   
//   $('#id_fasilitas').on('select2:opening', function() {
//         // Find the Select2 search input field
//         var $searchField = $('.select2-container--open .select2-search__field');
//         $searchField.prop('readonly', true);
//     });
    
//       $(document).on('focus', '.select2-container--open .select2-search__field', function() {
//         $(this).prop('readonly', false);
//     });
   // function LoadFasilitas(){
   //    $.ajax({
   //       url: "<?=base_url()?>Fasilitas/LoadFasilitas/",
   //       type: 'post',
   //       // data: formData,
   //       contentType: false,
   //       processData: false,

   //       success: function(r){
   //          var json = JSON.parse(r);
   //          var row = ` <option value=""></option>`;
   //          jQuery.each(json, function( i, val ) {
   //             row +=`  <option value="`+val['id_fasilitas']+`">`+val['nama_fasilitas']+`</option>`;
   //          });
   //          $('#id_fasilitas').html(row);
               
   //       }, error: function(){
   //          hide ();
   //       }
   //    });   
   //    return false;
   // }
    
    
   function AddData(){
      // show();
      $('#m-menu').modal('show');
      $('#m-menu').find('.modal-title').html('Buat Temuan Baru');   
      $('#m-menu').find('form').attr('onsubmit','return SaveData(this)');
      // LoadFasilitas();

   }

   function EditData(id){
       show();
      $('#m-menu').modal('show');
      $('#m-menu').find('.modal-title').html('Edit Temuan');   
      $('#m-menu').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      // LoadFasilitas();
      $.ajax({
               url: "<?=base_url()?>temuan/EditData/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                
                  var json = JSON.parse(r);
                  $('#id_fasilitas').select2(
                     'data',json['fasilitas']
                  );
                 
                  $('#tanggal').val(json['tanggal']);  
                  $('#keterangan').val(json['keterangan']);  
                  $('#kondisi').val(json['kondisi']);  
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }

   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
   
      $.ajax({
         url:  '<?=base_url('temuan/')?>SaveData/',
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
             $(f)[0].reset(); 
          
            $('#m-menu').modal('hide');
          
           FilterData();
            
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function UpdateData (f,id){
      show();
      var formData = new FormData($(f)[0]);
   
      $.ajax({
         url:  '<?=base_url('temuan/')?>UpdateData/'+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
             $(f)[0].reset(); 
          
            $('#m-menu').modal('hide');
          
           FilterData();
            
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
         url: '<?= base_url('temuan/ProsesData/') ?>' + id,
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

   function DeleteData(id){

      $.ajax({
         url: '<?= base_url('temuan/DeleteData/') ?>' + id,
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

   $('body').on('change','#id_fasilitas', function() {
      
      if($(this).val() != ''){
         var id=$(this).val();
      
         $.ajax({
            url: '<?=base_url('fasilitas/')?>EditData/'+id,
            success: function(r){
               var json = JSON.parse(r);
               var row="";
               
               $('#unit').val(json['unit']);
               $('#id_unit').val(json['id_unit']);
               $('#tabel-perangkat > tbody:last-child').html(row);

              
            }, error(){
               
            }
         });
       
      }
   });

   function AddPerangkat(){
      var id_fasilitas=$('#id_fasilitas').val();
   
      var rowCount =  $('#tabel-perangkat > tbody tr').length;
      
         // JenisMasalah('id'+rowCount);
      
         Perangkat(id_fasilitas,'id_perangkat'+rowCount);
         var new_input = ` 
         <tr id ="act_`+rowCount+`">
            <td>
               <select class="form-control jenis" id="id_perangkat`+rowCount+`" name="Newitems[`+rowCount+`][id_perangkat]" data-id="`+rowCount+`">
                  <option value=""></option>
                  
               </select>
            </td>
            <td>
               <select class="form-control" id="id`+rowCount+`" name="Newitems[`+rowCount+`][id_jenismasalah]">
                  <option value=""></option>+
               </select>
            </td>
            <td>
            <textarea class="form-control" id="descrpition`+rowCount+`" name="Newitems[`+rowCount+`][description]" rows="4" placeholder="Masukkan keterangan tindakan" required></textarea>
            </td>
            <td>
               <a class="btn waves-effect waves-light btn-danger btn-icon2" onclick="RemoveList('act_`+rowCount+`')"  type=""><i class="feather icon-trash"></i></a>
            </td>
         </tr>
      `;
         $('#new_perangkat').append(new_input);
   
         // $('#total_chq').val(new_chq_no);
   }
   function Perangkat(id,param){
      $.ajax({
         url: "<?=base_url()?>perangkat/LoadDataPerangkatByID/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                  var row = '<option value=""></option>';
               
                  jQuery.each(json['perangkat'], function( i, val ) {
                  
                     row +=`<option value="`+val['id_perangkat']+`" data-id = '`+val['id_jenisperangkat']+`'>`+val['nama_perangkat']+`</option>`;
                  });
               
                  $('#'+param).html(row);
         },
         error: function(){
               hide();
         }
      });
      return false;
   }

   function ViewData(id){
      $('#requestModalView').modal('show');
      $('#requestModalView').find('.modal-title').html('View Data');   
      
      $.ajax({
         url: "<?=base_url()?>temuan/ViewData/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                     $('#l_fasilitas').text(json['nama_fasilitas']);
                     $('#l_tanggal').text(json['tanggal_l']); 
                     $('#l_kondisi').text(json['kondisi']);
                     $('#l_keterangan').text(json['keterangan']);
           
         },
         error: function(){
               hide();
         }
      });
      return false;
   }
   $( "#srcData" ).on( "keyup", function() {
      FilterData();
   } );

   $('body').on('change','#limitData', function() {
   
   FilterData();
  });
  
  $('#id_fasilitas').select2({
       placeholder: "Pilih Fasilitass",
    ajax: {
    url: "<?= base_url('fasilitas/GetFasilitasTemuan') ?>",
    type: 'post',
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        serc: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      
      params.page = params.page || 1;
       
      return {
        results: data,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: true
  },
  // let our custom formatter work
  minimumInputLength: 1,
 
      
});
</script>