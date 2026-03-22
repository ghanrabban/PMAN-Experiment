
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
               <h3><?=$title?></h3>
               <span><?=$title_des?></span>
               <?php 
                  // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
                  ?>
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
                           <button type="button" class="btn btn-primary" onclick="AddData()"> Request Tiket</button>
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
                        <div class="table-responsive">
                           <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                              <thead class="thead-blue">
                                 <tr>
                                    <th class="cemter-t">No</th>
                                    <th class="cemter-t">Tanggal</th>
                                    <th class="cemter-t">Jumlah Tinjutan</th>
                                    <th class="cemter-t">Status</th>
                                    <th class="cemter-t">Action</th>
                                 </tr>
                              </thead>
                              <tbody id="Data-AP">
                              </tbody>
                           </table>
                           <div>
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
<!-- Modal Request Tiket -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
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
                        <label class="col-sm-4 col-form-label">Tanggal:</label>
                        <div class="col-sm-8">
                           <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                     <div class="col-md-6">
                        <div class="row">
                           <label class="col-md-4 col-form-label">Jam Mulai</label>
                           <div class="col-md-8">
                              <input type="time" class="form-control" name="jam_mulai" id="jam_mulai">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <label class="col-md-4 col-form-label"> Sampai </label>
                           <div class="col-md-8">
                              <input type="time" class="form-control" name="jam_selesai" id="jam_selesai">
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
               <div class="row">
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
<!-- End Modal Request tiket -->
<!-- modal untuk view  -->
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
               <label class="col-md-4 col-form-label">Lokasi</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_lokasi">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Jam Mulai</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_jam">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Pelaksana Pekerjaan </label>
               <ol id="v_pelaksana">
               </ol>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-condensed table-striped" id="tabel-ViewDetail">
                     <thead>
                        <tr>
                           <th>NO</th>
                           <th>Lokasi</th>
                           <th>Fasilitas</th>
                           <th>Pengecekan</th>
                           <th>Kondisi</th>
                           <th>Catatan</th>
                           <th>Dokumentasi</th>
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
<!-- end modal view  -->

<div id="myModal" class="modal">
   <!-- The Close Button -->
   <span class="close">&times;</span>
   <!-- Modal Content (The Image) -->
   <img class="modal-content" id="img01">
   <!-- Modal Caption (Image Text) -->
   <div id="caption"></div>
</div>
<script>
   $(document).ready(function() {
      $('.js-example-basic-single').select2({
         theme: 'bootstrap',
         dropdownCssClass: 'select2-dropdown--scroll'
      });
   });
   $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
         theme: 'bootstrap',
         dropdownCssClass: 'select2-dropdown--scroll'
      });
   });
   FilterData();
   function FilterData(id) {
         show();
         var formData = new FormData();
         formData.append('limit',  $('#limitData').val());
         formData.append('src',  $('#srcData').val());
         var id =(id == null ? 0: id);
         $.ajax({
         url: "<?=base_url().$modul?>/LoadDataStoringWo/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function (r) {
               var json = JSON.parse(r);
               var row = "";
               var no =1;
               jQuery.each(json['data'], function (i, val) {
                  var BTN ='';
                  var waitingButton = `<button class="btn waves-effect waves-light btn-info btn-icon" title="Send Request" onclick="Waiting(` + val['id_storingwo'] + `)"><i class="fa fa-check-circle"></i></button>`;
                  //var approveButton = '<button class="btn waves-effect waves-light btn-warning btn-icon" title="Approve" onclick="Approve(' + val['id_storingwo'] + ')"><i class="fa fa-check"></i></button>';
                  var editButton    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(`+ val['id_storingwo'] +`)"><i class="feather icon-edit"></i></button>`;
                  var rejectButton  = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="Deleted(`+ val['id_storingwo'] + `)"><i class="fa fa-trash"></i></button>`;
                  var viewData      = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="View" onclick="ViewData(`+ val['id_storingwo'] + `)"><i class="feather icon-eye"></i></button>`;
                  var viewData2     = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="View" onclick="ViewData2(`+ val['id_storingwo'] + `)"><i class="feather icon-eye"></i></button>`;
                  var prosesData    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['id_storingwo'] +`,'proses')"><i class="fa fa-gear"></i></button>`;
                  var delBtn        = `<button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_storingwo']+`,'delete')"><i class="fa fa-trash"></i></button>`;
                  var print         = '<a href="<?=base_url().$modul?>/PrintWOStoring/' + val['id_storingwo'] + '" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>';
                  // Tambahkan kondisi untuk menyembunyikan tombol Waiting jika status sudah diapprove
                  if (val['status'] === '0') {
                     BTN = editButton+prosesData+delBtn;
                  }else if (val['status'] === '9') {
                     BTN = viewData+print; 
                  } else if (val['status'] === '1') {
                     BTN = viewData; 
                  } else if (val['status'] === '2') {
                  
                  }else if (val['status'] === '0'){
                     BTN = editButton+prosesData;
                  }
                  row += `<tr>
                     <td>${no}</td>
                     <td>${val['tanggal_label'] || ''}</td>
                      <td>${val['jumlah'] || ''}</td>
                     <td>${val['status_label'] || ''}</td>
                     <td>
                           ${BTN}
                           
                     </td>
                  </tr>`;
                  no++;
               });
               $('#data-pag').html(json['pag']['label']);
               $('#tabel-data > tbody:last-child').html(row);
               hide();
         },
         error: function () {
               hide();
         }
         });
      return false;
   }
   
 
   
   function AddData(){
         // show();
       
         $('#requestModal').modal('show');
         $('#requestModal').find('.modal-title').html('Buat Tiket Baru');   
         $('#requestModal').find('form').attr('onsubmit','return SaveData(this)');
         $('#submitBtn').html('Request Tiket');
      
         LoadStoring();
   }
   
 
   
   function SaveData(f){
         show();
         var formData = new FormData($(f)[0]);
         // formData.append('id', id);
         $.ajax({
            url:  '<?=base_url().$modul?>/SaveDataWO',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               NF(json);
               hide(); 
               $('#requestModal').modal('hide');
             //  ResetFormModal();
               //$('#tabel-CM > tbody:last-child').html("");
               FilterData();
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
      
   function EditData(id){
       show();
      $('#requestModal').modal('show');
      $('#requestModal').find('.modal-title').html('Edit Tiket');   
      $('#requestModal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
     
      $.ajax({
               url: "<?=base_url().$modul?>/EditDataWO/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
   
               success: function(r){
                
                  var json = JSON.parse(r);
                  var row  ='';
                  $('#tanggal').val(json['tanggal']);  
                  
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         
         return false;
   }
   function UpdateData(f,id){
      show();
         var formData = new FormData($(f)[0]);
         // formData.append('id', id);
         $.ajax({
            url:  '<?=base_url().$modul?>UpdateDataWO/'+id,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               NF(json);
              
               $('#requestModal').modal('hide');
               ResetFormModal();
               $('#tabel-CM > tbody:last-child').html("");
               FilterData();
               hide(); 
            }, error: function(){
               hide(); 
            }
         });
         return false;
   }
   
   function ProsesData(id){
   
      $.ajax({
         url: '<?= base_url().$modul?>/ProsesWo/' + id,
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
         url: '<?= base_url().$modul?>/DeleteDataWO/' + id,
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
   
   function ViewData(id){
   
      $('#m-detail').modal('show');
      $('#m-detail').find('.modal-title').html('View Detail Tiket');   
   
      $.ajax({
         url: "<?=base_url().$modul?>/ViewDataWO/"+id,
         type: 'post',
         success: function(r){
      
               var json = JSON.parse(r);
               $('#v_tanggal').html(json['data']['tanggal']);
               $('#v_shift').html(json['data']['shift_l']['name']);
               $('#v_team').html(json['data']['team']);
               $('#v_lokasi').html('');
               $('#v_jam').html(json['data']['shift_l']['jam']);
              
               var ol = '';
               jQuery.each(json['data']['pelaksana'], function( i, val ) {
                  ol +=   `<li>`+val+`</li>`;
               });
               $('#v_pelaksana').html( ol);// 
   
               var row='';
               var no=1;
               jQuery.each(json['data']['detail'], function( i, val ) {
                  var img ='';
                  jQuery.each(val['dokumentasi'], function( ii, vall ) {
                     img +=`<img src="<?=base_url()?>/upload/storing/${vall['name_file']}" width="100" height="100" onclick="PrevieImage('http://localhost/pm_fids/./upload/WhatsApp_Image_2025-02-11_at_12_08_301.jpeg')">`;
                  });
                  jQuery.each(val['ceklist'], function( ii, vall ) {
                     if (ii == 0) {
                         row +=   `<tr>
                              <td rowspan="${val['ceklist_c']}">${no}</td>
                              <td rowspan="${val['ceklist_c']}">`+val['fasilitas']+`</td>
                              <td rowspan="${val['ceklist_c']}">`+val['terminal']+`</td>
                              <td >`+vall['nama_pekerjaan']+`</td>
                              <td >`+vall['kondisi']+`</td>
                              <td rowspan="${val['ceklist_c']}">${val['catatan']}</td>
                              <td rowspan="${val['ceklist_c']}">${img}</td>
                           </tr>
                           `;
             
                     }else{
                           row +=   `<tr>
                             <td >`+vall['nama_pekerjaan']+`</td>
                              <td >`+vall['kondisi']+`</td>
                           </tr>`;
                     }
                  });
                  no++;
                 
               });
               
               $('#tabel-ViewDetail > tbody:last-child').html(row);
               //console.log(row);
                // LoadFasilits(json['id_fasilitas']);
         },
         error: function(){
               hide();
         }
      });
   
   
      return false;
   }

   function LoadStoring(id){
      $.ajax({
         url: "<?=base_url().$modul?>/GetDataStoring/",
         type: 'post',
         success: function(r){
            var json = JSON.parse(r);
            var row ='';
            jQuery.each(json, function (i, val) {
               row +=`  <tr>
                           <td>
                              <label class="container">
                                    <input type="checkbox" class="check-form" name="newdata[`+i+`][id_storing]" value="`+val['id_storing']+`" `+(val['checked']==1 ? 'checked': '')+`>
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
  function PrevieImage (img){
    
      $('#myModal').modal('show');
   
      $('#img01').attr("src", img);
   }   
</script>