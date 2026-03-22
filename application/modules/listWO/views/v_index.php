<style>
   .pointer {
   cursor: pointer;
   }
   .hiddenRow {
   padding: 0 !important;
   }
   .form-group {
   margin-bottom: 5px;
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
   .tombol{
   width: 100px;
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
   /* Css Modal Fullscrean */
   @media (max-width: 575.98px) {
   .modal-fullscreen {
   padding: 0 !important;
   }
   .modal-fullscreen .modal-dialog {
   width: 100%;
   max-width: none;
   height: 100%;
   margin: 0;
   }
   .modal-fullscreen .modal-content {
   height: 100%;
   border: 0;
   border-radius: 0;
   }
   .modal-fullscreen .modal-body {
   overflow-y: auto;
   }
   }
   .modal-fullscreen-xl {
   padding: 0 !important;
   }
   .modal-fullscreen-xl .modal-dialog {
   width: 100%;
   max-width: none;
   height: 100%;
   margin: 0;
   }
   .modal-fullscreen-xl .modal-content {
   height: 100%;
   border: 0;
   border-radius: 0;
   }
   .modal-fullscreen-xl .modal-body {
   overflow-y: auto;
   }
   .btn-open-modal {
   margin-bottom: 0.5em;
   }
   /* End Css modal  */
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
            <i class="feather icon-flag bg-c-blue"></i>
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
                        <div class="row" id="export">
                           <div class="col-md-12">
                              <div class="pull-right putih mb-10">
                                 <button type="button" class="btn btn-primary" onclick="AddData()"> Create WO</button>
                              </div>
                           </div>
                        </div>
                        <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
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
                              <div class="col-xs-12 col-sm-12 col-md-6">
                                 <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                              </div>
                           </div>
                           <div class="row">
                              <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                 <thead class="thead-blue">
                                    <tr>
                                       <th class="cemter-t">No </th>
                                       <th class="cemter-t">Tiket </th>
                                       <th class="cemter-t">Tanggal</th>
                                       <th class="cemter-t">Keterangan</th>
                                       <th class="cemter-t">Status</th>
                                       <th class="cemter-t">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="Data">
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
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="m-wo" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestModalLabel">Request Tiket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!-- Form request -->
            <form method="post"   onsubmit="return SaveData(this)">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Team</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="team" name="team" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal:</label>
                        <div class="col-sm-8">
                           <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pelaksana Pekerjaan</label>
                        <div class="col-sm-8">
                           <select class="js-example-basic-multiple js-states form-control" id="id_user" name="id_user[]" multiple="multiple" required style="width: 80%;">
                              <option value=""></option>
                              <?php foreach ($pelaksana as $pelaksana): ?>
                              <option value="<?=$pelaksana['nama']?>"><?=$pelaksana['nama']?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Jenis Fasilitas</label>
                        <div class="col-sm-8">
                           <select class=" form-control" id="id_catagory" name="id_catagory"  style="width: 80%;">
                              <option value=""></option>
                              <?php foreach ($jp as $pelaksana): ?>
                                 <option value="<?=$pelaksana['id_catagory']?>" data-id="<?=$pelaksana['nama']?>"><?=$pelaksana['nama']?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Jenis PM</label>
                        <div class="col-sm-8">
                           <select class=" form-control" id="idpm_type" name="idpm_type" required style="width: 80%;">
                              <option value=""></option>
                              <?php foreach ($pm_type as $pelaksana): ?>
                                 <option value="<?=$pelaksana['idpm_type']?>" data-id="<?=$pelaksana['idpm_type']?>"><?=$pelaksana['name_pm']?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="row">
                  <div class="col-md-12">
                     <table class="table table-condensed table-striped table-bordered" id="tabel-CM">
                        <thead class="thead-blue">
                           <tr>
                              <th class="cemter-t"></th>
                              <th class="cemter-t">Fasilitas</th>
                           </tr>
                        </thead>
                        <tbody >
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row" >
                  <div class="col-md-12">
                     <button type="submit" id="submitBtn" class="btn btn-primary">Request Tiket</button>
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="m-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group row">
               <label class="col-sm-4 col-form-label">Hari/Tanggal</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_tanggal">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Shift Kerja</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_shift">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Team</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_team">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Jam Mulai</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_jam">aaasd asd sad</span>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-condensed table-striped" id="tabel-ViewDetail">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Fasilitas</th>
                           <th >Pekerjaan</th>
                           <th >Dokumentasi</th>
                        </tr>
                     </thead>
                     <tbody >
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script>
   var start = "";
   var end = "";
   FilterData();
   function show () {
         $("#spinner").addClass("show");
   }
   
   function hide () {
         $("#spinner").removeClass("show");
   }
     
   $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
         theme: 'bootstrap',
         dropdownCssClass: 'select2-dropdown--scroll'
      });
   });
   function FilterData(){
         show();
       
         $.ajax({
               url: "<?=base_url()?>ListWO/LoadData",
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
   
               success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                  var no =json['pag']['start'];
                  jQuery.each(json['data'], function( i, val ) {
                     var opt           = ``;
                     var prosesButton  = `<button class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon" onclick="ConfirmData(${val['id_wo']},'proses')"><i class="fa fa-gear"></i></button>`;
                     // var editButton    = `<button class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon" onclick="EditData(` + val['id_wo'] + `)"><i class="feather icon-edit"></i></button>`;
                     var editButton =``;
                     var viewButton    = `<button class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon" onclick="ViewDetail(` + val['id_wo'] + `)"><i class="feather icon-eye"></i></button>`;
                     var deleteButton  = `<button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_wo']+`,'delete')"><i class="fa fa-trash"></i></button>  `;
                     var printButton   = `<a href="<?=base_url('listWO/PrintData/')?>` + val['id_wo'] + `" target="_blank" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon"><i class="fa fa-print"></i></a>`;
                     if (val['status'] == 0) {
                        opt =viewButton+prosesButton+editButton+deleteButton;
                     }else{
                        opt=viewButton+printButton;
                     }
                     row +=`<tr >
                                       <td >`+(no++)+`</td>
                                      
                                       <td >`+(val['tanggal'] == null ? '': val['tanggal'])+`</td>
                                       <td >`+(val['tanggal'] == null ? '': val['tanggal'])+`</td>
                                       <td >`+(val['keterangan'] == null ? '': val['keterangan'])+`</td>
                                      
                                       <td id='status'>`+(val['status_label'] == null ? '': val['status_label'])+`</td>
                                       <td >
                                       <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">`
                                       +opt+
                                       `</div></td>
                                       </tr>`;
                  });
                
                  $('#tabel-data > tbody:last-child').html(row);
                  $('#data-pag').html(json['pag']['label']);
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }
   
   function AddData(){
      // show();
      $('#m-wo').modal('show');
      $('#m-wo').find('.modal-title').html('Tindak Lanjut');   
      $('#m-wo').find('form').attr('onsubmit','return SaveData(this)');
      
      // LoadPM('');
    
   }
   $('body').on('change','#idpm_type', function() {

      
      if($(this).val() != ''){
         var id=$(this).find(':selected').attr('data-id');
         var id_catagory = $('#id_catagory').val();
         
            LoadPM(id,id_catagory);
        
        
        
       
      }

   });
   
   function LoadPM(id,catagory){
      $.ajax({
         url: "<?=base_url()?>listWO/GetDataPM/"+id+"/"+catagory,
         type: 'post',
         success: function(r){
            var json = JSON.parse(r);
            var row ='';
            jQuery.each(json, function (i, val) {
               row +=`  <tr>
                           <td>
                              <label class="container">
                                    <input type="checkbox" class="check-form" name="newdata[`+i+`][id_pmheader]" value="`+val['id_pmheader']+`" `+(val['checked']==1 ? 'checked': '')+`>
                                    <span class="checkmark"></span>
                              </label>
                           </td>
                           <td>
                              <label>`+val['fasilitas']+`</label>
                           </td>
                        </tr>`
   
            });
   
            $('#tabel-CM > tbody:last-child').html(row);
         
         },
         error: function(){
            hide();
         }
      });
      return false;
   }
   
   function SaveData(f){
         show();
         var formData = new FormData($(f)[0]);
         // formData.append('id', id);
         $.ajax({
            url:  '<?=base_url('listWO/')?>SaveData',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               NF(json);
               hide(); 
               $('#m-wo').modal('hide');
             
               $('#tabel-CM > tbody:last-child').html("");
               FilterData();
            }, error: function(){
               hide(); 
            }
         });
         return false;
   }
   
   function ViewDetail(id){
      $('#m-detail').modal('show');
      $('#m-detail').find('.modal-title').html('View Detail Tiket');   
   
      $.ajax({
         url: "<?=base_url()?>listWO/ViewData/"+id,
         type: 'post',
         success: function(r){
               var json = JSON.parse(r);
               $('#v_tanggal').html(json['data']['tanggal']);
               $('#v_shift').html(json['data']['shift_l']['name']);
               $('#v_team').html(json['data']['team']);
               $('#v_lokasi').html('');
               $('#v_jam').html(json['data']['shift_l']['jam']);
            
               var rowCount =  $('#tabel-perangkat > tbody tr').length;
               var row='';
               var no=1;
               jQuery.each(json['data']['detail'], function( i, val ) {
                  var dok ="";
                  jQuery.each(val['documentasi'], function( ii, vall ) {
                     dok +=`<tr>
                              <td>${vall['nama']}</td>
                          
                              <td>${vall['documentasi'] ? `<img src="<?=base_url()?>./upload/pm/${vall['documentasi']}" alt="Foto Before" width="100" height="100" onclick="previewImage('<?=base_url()?>./upload/pm/${vall['documentasi']}')">` : ''}</td>
                           </tr>`;
                  })
                  row +=   `<tr>
                              <td rowspan="${val['jum']+1}">${no}</td>
                              <td rowspan="${val['jum']+1}">`+val['nama_fasilitas']+`</td>
                             ${dok}
                           </tr>`;
               no++;
               });
               
               $('#tabel-ViewDetail > tbody:last-child').html(row);
             
         },
         error: function(){
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
         url: '<?= base_url('listWO/ProsesData/') ?>' + id,
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
         url: '<?= base_url('listWO/DeleteData/') ?>' + id,
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

</script>