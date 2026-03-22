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
   .image-preview-modal {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.8);
   display: flex;
   justify-content: center;
   align-items: center;
   z-index: 9999;
   }
   .image-preview-modal img {
   max-width: 90%;
   max-height: 90%;
   }
   .modal-content, #caption {
   animation-name: zoom;
   animation-duration: 0.6s;
   }
   .modal-content {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   }
   .pr-0{
   padding-right: 0px;
   }
   @media (min-width: 768px) {
      .modal-dialog {
         width: 1140px;
         margin: 30px auto;
      }
      .modal-content {
         margin: auto;
         display: block;
         width: 100%;
         max-width: 100%;
      }
   }
   
   
.select2-container--default .select2-selection--single .select2-selection__rendered {
    background-color: #fff;
    color: #fff;
    padding: 0px 0px 0px 0px;
}

.select2-container .select2-selection--single {
    /* box-sizing: border-box; */
    cursor: pointer;
    display: block;
    height: 38px;
    user-select: none;
    -webkit-user-select: none;
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
                        <div class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-xs-12 col-sm-5 col-sm-5 col-md-3">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <label>
                                       Show 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm filter-data" id="limitData">
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
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <label>Tanggal  </label>
                                       </div>
                                       <div class="col-sm-6">
                                          <input type="date" aria-controls="complex-dt" class="form-control input-sm filter-data" id="f_tanggal" name="complex-dt_length" required>
                        
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <label>
                                       Status 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm filter-data" id="f_status">
                                          <option value=""></option>
                                          <option value="0">Draft</option>
                                          <option value="1">Proses</option>
                                          <option value="2">Approve Leader</option>
                                          <!-- <option value="6">100</option> -->
                                          <option value="9">Close</option>
                                       </select>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-3">
                                 <div id="complex-dt_filter" class="dataTables_filter">
                                    <div class="pull-right putih mb-10">
                                       <input type="hidden" id="tes_btn" style="width: 300px" name="tes_btn"  />
                                       <button type="button" class="btn btn-primary" onclick="AddData()"> Buat Baru</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">No</th>
                                             <th class="cemter-t">Tanggal</th>
                                             <th class="cemter-t">Lokasi</th>
                                             <th class="cemter-t">Fasilitas</th>
                                             <th class="cemter-t">Keterangan</th>
                                             <th colspan="2" class="cemter-t">Documentasi</th>
                                             <th class="cemter-t">Status</th>
                                             <th class="cemter-t">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody id="Data-AP">
                                       </tbody>
                                    </table>
                                 </div>
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
<!-- Modal Request Tiket -->
</div>
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
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
                           <label class="col-sm-4 col-form-label">Temuan</label>
                           <div class="col-sm-8">
                                <select id="id_temuan" name="id_temuan" class="form-control"></select>
                              <!--<input type="hidden" id="id_temuan" style="width: 300px" name="id_temuan"  />-->
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label">Fasilitas:</label>
                           <div class="col-sm-8">
                              <select id="id_fasilitas" name="id_fasilitas" class="form-control"></select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label">Jenis Laporan</label>
                           <div class="col-sm-8">
                              <select class="form-control" name="report_from" id="report_from">
                                 <option value=""></option>
                                 <option value="internal">Internal</option>
                                 <option value="exteral">External</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label">Tanggal:</label>
                           <div class="col-sm-8">
                              <div class="input-group">
                                 <input type="date" class="form-control" id="tanggal" name="tanggal">
                                 <div class="input-group-append">
                                    <span> - </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                              <div class ="row">
                                 <label class="col-sm-4 col-form-label">Mulai:</label>
                                 <div class="col-sm-8">
                                    <div class="input-group">
                                       <input type="time" class="form-control" id="start_time" name="start_time" pattern="[0-9]{2}:[0-9]{2}">
                                       <div class="input-group-append">
                                          <span> - </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <div class ="row">
                                 <label class="col-sm-4 col-form-label">Selesai:</label>
                                 <div class="col-sm-8">
                                    <div class="input-group">
                                       <input type="time" class="form-control" id="end_time" name="end_time">
                                       <div class="input-group-append">
                                          <span> - </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label">Keterangan:</label>
                           <div class="col-sm-8">
                              <textarea class="form-control" id="keterangan" name="description" rows="4" placeholder="Masukkan keterangan tiket" required></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label" for="foto_before">Foto Before</label>
                           <div class="col-sm-8">
                              <div class="input-group">
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_before" name="foto_before" aria-describedby="inputGroupFileAddon01" accept=".jpg, .png, .jpeg">
                                    <label class="custom-file-label" id="label-before" for="foto_before">Choose file</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label" for="foto_proses">Foto Proses</label>
                           <div class="col-sm-8">
                              <div class="input-group">
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_proses" name="foto_proses" aria-describedby="inputGroupFileAddon01" accept=".jpg, .png, .jpeg">
                                    <label class="custom-file-label" id="label-proses" for="foto_proses">Choose file</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label" for="foto_after">Foto After</label>
                           <div class="col-sm-8">
                              <div class="input-group">
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_after" name="foto_after" aria-describedby="inputGroupFileAddon01" accept=".jpg, .png, .jpeg">
                                    <label class="custom-file-label" id="label-after" for="foto_after">Choose file</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- End of new input fields -->
                     </div>
                     <div class="col-md-12">
                        <div class="row mb-10">
                           <ul class="nav nav-tabs  tabs personil-dinas mb-20" role="tablist" >
                              <li class="nav-item active"  role="presentation" data-id="DetailMasalah">
                                 <a class="nav-link " data-bs-toggle="tab" href="#"   role="tab">Detail Permasalahan</a>
                                 <!-- <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">List PM</a> -->
                              </li>
                              <li class="nav-item " role="presentation" data-id="Pergantian">
                                 
                                 <a class="nav-link " data-bs-toggle="tab" role="tab" href="#" >Pergantian Perangkat</a>
                                 <!-- <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">History</a> -->
                              </li>
                           </ul>
                           
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="tab-content tabs card-block">
                                 <div class="tab-pane active" id="DetailMasalah" role="tabpanel">
                                    <div class="row ">
                                       <div class="col-md-10 mb-10">
                                          <h6>Detail Permasalahan</h6>
                                       </div>
                                       <div class="col-md-2 mb-10">
                                          <a class="btn waves-effect waves-light btn-info btn-icon2"  id='btn-addperangkat' onclick="AddPerangkat()"><i class="feather icon-plus-circle"></i></a>
                                       </div>
                                       <table class="table table-condensed table-striped" id="tabel-perangkat">
                                          <thead>
                                             <tr>
                                                <th>Perangkat</th>
                                                <th>Jenis Permaslahaan</th>
                                                <th>Tindakan</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody id="new_perangkat"></tbody>
                                       </table>   
                                       <div id="removed-items"></div>
                                    </div>

                                 </div>
                                 <div class="tab-pane" id="Pergantian" role="tabpanel">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <h6>Pergantian Perangkat</h6>
                                       </div>
                                    </div>   
                                 </div>
                              </div>
                           </div>

                        </div>
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
                           <label class="col-sm-3 col-form-label">Jenis Laporan</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0"><span id="l_jenis_laporan"></span></div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Tanggal</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0">
                              <div class="input-group">
                                 <span id="l_tanggal_s"></span>
                                 <div class="input-group-append">
                                    <span> - </span>
                                 </div>
                                 <span id="l_tanggal_e"></span>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Keterangan</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0"><span id="l_keterangan"></span></div>
                        </div>
                        <hr>
                        <!-- End of new input fields -->
                     </div>
                     <div class="col-md-12">
                        <div class="row mb-10">
                           <div class="col-md-10">
                              <h6>Detail Permasalahan</h6>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <table class="table table-condensed table-striped" id="tabel-perangkat">
                           <thead>
                              <tr>
                                 <th>Perangkat</th>
                                 <th>Jenis Permaslahaan</th>
                                 <th>Tindakan</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="new_perangkat"></tbody>
                        </table>
                     </div>
                     <div class="col-md-12">
                        <div class="row mb-10">
                           <div class="col-md-10">
                              <h6>Dokumentasi Perbaikan</h6>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <table class="table table-condensed table-striped" id="tabel-dock">
                           <thead>
                              <tr>
                                 <th>Sebelum Perbaikan</th>
                                 <th>Proses Perbaikan</th>
                                 <th>Setelah Perbaikan</th>
                              </tr>
                           </thead>
                           <tbody id="documentasi"></tbody>
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
</div>
<div id="myModal" class="modal">
   <!-- The Close Button -->
   <span class="close">&times;</span>
   <!-- Modal Content (The Image) -->
   <img class="modal-content" id="img01">
   <!-- Modal Caption (Image Text) -->
   <div id="caption"></div>
</div>
<script>
   // LoadFasilits();
   FilterData();
    $(window).on('load', function() {
      // ViewData();
    });
   function FilterData (id) {
      show();
      var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      formData.append('tanggal',  $('#f_tanggal').val());
      formData.append('status',  $('#f_status').val());
      var id =(id == null ? 0: id);
      $.ajax({
        url: "<?=base_url()?>tindaklanjut/LoadData/"+id,
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (r) {
            var json = JSON.parse(r);
            var row = "";
            var x=1;
            jQuery.each(json['data'], function (i, val) {
               var tinjutButton = '<button class="btn waves-effect waves-light btn-info btn-icon" title="Siap Tinjut!" onclick="Doit(' + val['id_tinjut'] + ')"><i class="fa fa-check-circle"></i></button>';
                //var approveButton = '<button class="btn waves-effect waves-light btn-warning btn-icon" title="Approve" onclick="Approve(' + val['id_tiket'] + ')"><i class="fa fa-check"></i></button>';
               var proses =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['id_tinjut'] +`,'proses')"><i class="fa fa-gear"></i></button>`; 
               var editButton = '<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(' + val['id_tinjut'] + ')"><i class="feather icon-edit"></i></button>';
               var viewButton = '<button class="btn waves-effect waves-light btn-primary btn-icon" title="View" onclick="ViewData(' + val['id_tinjut'] + ')"><i class="feather icon-eye"></i></button>';
               var rejectButton = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Delete" onclick="ConfirmData(`+ val['id_tinjut'] +`,'delete')"><i class="fa fa-trash"></i></button>`;
               var none = '<button class="btn waves-effect waves-light btn-disabled btn-icon"><i class="feather icon-slash"></i></button>';
               var btn ='';
               if (val['status'] === '0') {
                  btn =proses+editButton+viewButton+rejectButton;
               }else if (val['status'] === '1') {
                   btn = viewButton;
               }else if (val['status'] === '2') {
                   btn = viewButton;
               }else if (val['status'] === '3') {
                   btn = btn =editButton+viewButton;
               } else if (val['status'] === '6') {
                    btn = viewButton;
               }else if (val['status'] === '9') {
                   btn = viewButton;
               }
               row += `<tr>
                        <td>${x}</td>
                        <td>${val['tanggal'] || ''}</td>
                        <td>${val['nama_terminal'] || ''}</td>
                        <td>${val['nama_fasilitas'] || ''}</td>
                        <td>${val['description'] || ''}</td>
                        <td>${val['foto_before'] ? `<img src="<?=base_url()?>./upload/${val['foto_after']}" alt="Foto Before" width="100" height="100" onclick="PrevieImage('<?=base_url()?>./upload/${val['foto_after']}')">` : ''}</td>
                        <td>${val['foto_before'] ? `<img src="<?=base_url()?>./upload/${val['foto_before']}" alt="Foto Before" width="100" height="100" onclick="PrevieImage('<?=base_url()?>./upload/${val['foto_before']}')">` : ''}</td>
                        <td>${val['label_status'] || ''}</td>
                        <td>
                              ${btn}
                        </td>
                     </tr>`;
                     x++;
            });
   
            $('#tabel-data > tbody:last-child').html(row);
            $('#data-pag').html(json['pag']['label']);
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
      $('#requestModal').find('.modal-title').html('Tindak Lanjut');   
      $('#requestModal').find('form').attr('onsubmit','return SaveData(this)');
      $("#id_fasilitas").select2("val", "");
      $('#label-before').text('Choose file');
      $('#label-proses').text('Choose file');
      $('#label-after').text('Choose file');
      // LoadFasilits();
      var row='';
      $('#tabel-perangkat > tbody:last-child').html(row);
   }
   
   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
   
      $.ajax({
         url:  '<?=base_url('tindaklanjut/')?>SaveData/',
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            $('#requestModal').modal('hide');
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }
   
   function Deleted(id) {
      var confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
   
      if (confirmDelete) {
         $.ajax({
            url: '<?= base_url('tinjut/Delete/') ?>' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               FilterData();
            hide();
            }, error: function(){
            hide();
            }
         });
      } else {
         return false;
      }
   }
   
   function UpdateData(f,id){
   
      var formData = new FormData($(f)[0]);
     
      $.ajax({
         url:  '<?=base_url('tindaklanjut/UpdateData/')?>'+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            // $(f)[0].reset(); 
            // $('#MasterIndikator').modal('hide');
            $('#requestModal').modal('hide');
            FilterData();
            $('#removed-items').html("");
            // ViewDetail(id,date);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }
   
   $('body').on('change','.jenis', function() {
   
      if($(this).val() != ''){
         var id=$(this).find(':selected').attr('data-id');
    
         JenisMasalah(id,'id'+$(this).attr("data-id"));
   
      }
   });
   
   function RemoveList(r,a) {
         // var last_chq_no = $('#total_chq').val();
   
         // if (last_chq_no > 1) {
         //    $('#'+ r).remove();
         //    $('#total_chq').val(last_chq_no - 1);
         // }
         $('#'+ r).remove();
         a && 0 < $("#removed-items").append(hidden_input("removed_items[]", a))
   }
   
   function ViewData(id){
      $('#requestModalView').modal('show');
      $('#requestModalView').find('.modal-title').html('View Data');   
      
      $.ajax({
         url: "<?=base_url()?>tindaklanjut/EditData/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                     $('#l_fasilitas').text(json['nama_fasilitas']);
                     $('#l_jenis_laporan').text(json['report_from']); 
                     $('#l_tanggal_s').text(json['s_date']);
                     $('#l_tanggal_e').text(json['e_date']);
                     $('#l_keterangan').text(json['description']);
                     // $('#l_before').text(json['update_date']);
                     // $('#l_after').text(json['description']).prop('disabled', true); 
                     // 
               var dock ="<tr>";
               dock +=`<td> ${json['foto_before'] == null ? '':`<img src="<?=base_url()?>upload/${json['foto_before']}" alt="Foto Before" width="100" height="100" onclick="PrevieImage('<?=base_url()?>upload/${json['foto_before']}')">`}</td>`;
               dock +=`<td> ${json['foto_proses'] == null ? '':`<img src="<?=base_url()?>upload/${json['foto_proses']}" alt="Foto Before" width="100" height="100" onclick="PrevieImage('<?=base_url()?>upload/${json['foto_before']}')">`}</td>`;
               dock +=`<td> ${json['foto_after'] == null ? '':`<img src="<?=base_url()?>upload/${json['foto_after']}" alt="Foto Before" width="100" height="100" onclick="PrevieImage('<?=base_url()?>upload/${json['foto_before']}')">`}</td>`;
               
                dock +="</tr>"
               var row='';
               jQuery.each(json['detail'], function( i, val ) {
                  row +=   `<tr>
                              <td>`+val['nama_perangkat']+`</td>
                              <td>`+val['nama_masalah']+`</td>
                              <td>`+val['description']+`</td>
                              <td></td>
                           </tr>`;
                 
               }); 
   
               $('#tabel-perangkat > tbody:last-child').html(row);
               $('#tabel-dock > tbody:last-child').html(dock);
               console.log(dock);
         },
         error: function(){
               hide();
         }
      });
      return false;
   }
   
   function AddPerangkat(){
      
      var id_fasilitas=$('#id_fasilitas').val();
      if (id_fasilitas !=='') {
         
      
         var rowCount =  $('#tabel-perangkat > tbody tr').length;
         
            // JenisMasalah('id'+rowCount);
         
         
         Perangkat(id_fasilitas,'id_perangkatid'+rowCount,'','');
         
         var new_input = ` 
               <tr id ="act_`+rowCount+`">
                  <td>
                     <select class="form-control jenis" id="id_perangkatid`+rowCount+`" name="Newitems[`+rowCount+`][id_perangkat]" data-id="`+rowCount+`">
                        <option value=""></option>
                        
                     </select>
                  </td>
                  <td>
                            <select class="form-control jenis" id="id`+rowCount+`" name="Newitems[`+rowCount+`][id_jenismasalah]">
                                 <option value=""></option>
                                 
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
         Setbtn(rowCount);
          
      }else{
         var json= {'msg':'Silahkan Pilih Fasilitas'};
         NF(json);
      }
     
         // $('#total_chq').val(new_chq_no);
   }
   
   function Perangkat(id,param,idperangkat,namaperangkat){

      // console.log(id+'+'+param);
      show();
      $.ajax({
         url: "<?=base_url()?>perangkat/ListPerangkatFasilitas/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                  var row = '<option value=""></option>';
                 
                
                  jQuery.each(json['perangkat'], function( i, val ) {
                       if (idperangkat ==val['id_perangkat']) {
                         row +=`<option value="`+idperangkat+`" selected>`+val['nama_perangkat']+` </option>` ;
                        console.log('sama');
                      }else{
                         row +=`<option value="`+val['id_perangkat']+`" data-id = '`+val['id_jenisperangkat']+`'>`+val['nama_perangkat']+`</option>`;
                         console.log('tidak');
                      }
                    
                  });
               console.log(param);
                  $('#'+param).html(row);
                  hide();
         },
         error: function(){
               hide();
         }
      });
      return false;
   }
   
   function JenisMasalah(id,param){
      // console.log("id ="+id+"param="+param);      
      $.ajax({
         url: "<?=base_url()?>jenis_masalah/LoadDataByid/"+id,
         type: 'post',
         // data: formData,
         contentType: false,
         processData: false,
   
         success: function(r){
            var row = '<option value=""></option>';
            var json = JSON.parse(r);
            jQuery.each(json, function( i, val ) {
               // if (condition) {
               //    row +=`<option value="`+val['id']+`">`+val['nama_masalah']+`</option>`;
               // }else{
                  row +=`<option value="`+val['id']+`">`+val['nama_masalah']+`</option>`;
               // }
              
            });
               
            $('#'+param).html(row);
         }, error: function(){
            hide ();
         }
      });   
      return false;
   }
   
   
   function EditData(id){
       show();
      $('#requestModal').modal('show');
      $('#requestModal').find('.modal-title').html('Edit Tindak Lanjut');   
      $('#requestModal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
     
      $.ajax({
               url: "<?=base_url()?>tindaklanjut/EditData/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
   
               success: function(r){
                  
                  var json = JSON.parse(r);
                  $('#id_temuan').select2(
                     'data',json['temuan']
                  );
                 
                  $('#tanggal').val(json['tanggal']);  
                  $('#keterangan').val(json['description']);  
                  $('#date_start').val(json['start_time']); 
                  $('#update_date').val(json['end_time']); 
                  $('#report_from').val(json['report_from']); 
                  $('#label-before').text(json['foto_before']);
                  $('#label-proses').text(json['foto_after']);
                  $('#label-after').text(json['foto_after']);
                  var id_fasilitas=json['fasilitas']['id'];
     
                  var rowCount =  $('#tabel-perangkat > tbody tr').length;
                  
                  var row = "";
                  jQuery.each(json['detail'], function( i, val ) {
                     Perangkat(id_fasilitas,'id_perangkatid'+i,val['id_perangkat'],val['nama_perangkat']);
                     $('#id_fasilitas').trigger('change');
                     $('#id_jenisperangkat'+i).trigger('change');
                     const   perangkat = [];
                     
                     row += ` 
                        <tr id="act_`+i+`">
                           <td>
                              <input type="hidden" class="form-control" id="idtinjut`+i+`" name="Items[`+i+`][idtinjut]" value="`+val['id_detail']+`">
                              <select class="form-control jenis" id="id_perangkatid`+i+`" name="Items[`+i+`][id_perangkat]" data-id="`+i+`">
                                 <option value=""></option>
                                 
                              </select>
                           </td>
                           <td>
                              <input type="hidden" id="id`+i+`"  style="width: 300px" name="Items[`+i+`][id_jenismasalah]">
           
                           </td>
                           <td>
                               <textarea class="form-control" id="descrpition`+i+`" name="Items[`+i+`][description]" rows="4" placeholder="Masukkan keterangan tindakan" required>`+val['description']+`</textarea>
                           </td>
                           <td>
                              <a class="btn waves-effect waves-light btn-danger btn-icon2" onclick="RemoveList('act_`+i+`','`+val['id_detail']+`')"  type=""><i class="feather icon-trash"></i></a>
                           </td>
                        </tr>`;
                        
                        $('#id'+i).select2(
                           'data',json['js']
                        );
                  });

                   $('#id_fasilitas').select2(
                     'data',json['fasilitas']
                  );
            
             $('#tabel-perangkat > tbody:last-child').html(row);
               jQuery.each(json['detail'], function( i, val ) {
                  Setbtn(i);
                  $('#id'+i).select2(
                           'data',val['js']
                        );
               });
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }
   
   document.getElementById('foto_after').addEventListener('change', function () {
         var fileName = this.value.split('\\').pop(); 
         $('#label-after').html(fileName);
   });
   
   document.getElementById('foto_proses').addEventListener('change', function () {
         var fileName = this.value.split('\\').pop(); 
         $('#label-proses').html(fileName);
   });
   document.getElementById('foto_before').addEventListener('change', function () {
         var fileName = this.value.split('\\').pop();    
         $('#label-before').text(fileName);
         
   });
   
   function PrevieImage (img){
    
      $('#myModal').modal('show');
   
      $('#img01').attr("src", img);
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
            url: '<?= base_url('tindaklanjut/ProsesData/') ?>' + id,
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
         url: '<?= base_url('tindaklanjut/DeleteData/') ?>' + id,
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
   
   function hidden_input(e, t) {
    return '<input type="hidden" name="' + e + '" value="' + t + '">'
   }
   $('body').on('change','.filter-data', function() {
      FilterData();
   });
   
   var lastResults = [];
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
//                         return {
//                             text: item.text,
//                             id: item.id
//                         }
//                     })
//                 };
//             }
//         },
//   });
   
   

   
//   $("#id_temuan").select2({
//       multiple: false,
//       placeholder: "Pilih Temuan",
//       ajax: {
//             url:  "<?= base_url('temuan/Getemuan') ?>",
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
//                         return {
//                             text: item.text,
//                             id: item.id
//                         }
//                     })
//                 };
//             }
//         },
//   });
   
  $('body').on('change', '#id_temuan', function () {

    var id = $(this).val();
    if (!id) return;

    $.ajax({
        url: '<?= base_url('temuan/SetFasilitas2/') ?>' + id,
        type: 'POST',
        dataType: 'json',

        success: function (json) {

            // kosongkan dulu
            $('#id_fasilitas').empty();

            // isi option baru
            $.each(json, function (i, item) {
               var option = new Option(item.text, item.id, true, true);
                $('#id_fasilitas').append(option);
            });

            // trigger select2 refresh
            $('#id_fasilitas').trigger('change');
        },

        error: function () {
            alert('Gagal memuat fasilitas');
        }
    });
});
   
   // $('#sasaran').select2(
   //              'data',json['sasaran']
   //          );
   
   function Resetbtn(id){
      $('#'+id).select2('destroy');
   }
   
 function Setbtn(id){

    $("#id"+id).select2({
        placeholder: "Pilih Jenis Masalah",
        allowClear: true,
        tags: true,              // ⬅️ PENTING (input bebas)
        minimumInputLength: 1,

        ajax: {
            url: "<?= base_url('jenis_masalah/GetjenisMasalah') ?>",
            type: "POST",
            dataType: "json",
            delay: 300,

            data: function (params) {
                return {
                    serc: params.term,
                    jenis: $('#id_perangkatid'+id)
                            .find(':selected')
                            .attr('data-id')
                };
            },

            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    })
                };
            }
        },

        // ⬇️ Agar teks baru bisa langsung dipilih
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newTag: true   // 🔥 penanda input baru
            };
        }
    });
    
    $('#id'+id).on('select2:select', function (e) {

        var data = e.params.data;

        // Jika input baru
        if (data.newTag === true) {

            $.ajax({
                url: "<?= base_url('jenis_masalah/InsertJenisMasalah') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    nama_masalah: data.text
                },
                success: function (res) {

                    // replace option baru dengan ID dari DB
                    var newOption = new Option(res.text, res.id, true, true);
                    $('#id'+id).append(newOption).trigger('change');

                }
            });

        }
    });
}
   
    $('.nav li[role!=x]').click(function(){
     
     var li = $(this).index();
       $('li').removeClass('active');
       $(this).addClass('active');
      var tes = $(this).attr("data-id");
  
      $('.nav li').removeClass('active');

      $(this).addClass('active');
      console.log(li+tes);
      $('#'+tes).addClass('active');
      if(li == 0){
         $('#DetailMasalah').addClass('active');
         $('#Pergantian').removeClass('active');
       //  window.history.pushState('', 'Title', 'tindaklanjut');
      //  tab_content.eq(0).addClass('show active'); 
         //_education();
      }else if(li == 1){
         $('#Pergantian').addClass('active');
         $('#DetailMasalah').removeClass('active');
         //window.history.pushState('', 'Title', 'pm?tab=DetailMasalah');
      //  tab_content. eq(1).addClass('show active');
         // _photo(); load jabatan
      }
   });
   
   
   function initFasilitasSelect() {

   if ($('#id_fasilitas').hasClass("select2-hidden-accessible")) {
      $('#id_fasilitas').select2('destroy');
   }

   $('#id_fasilitas').select2({
      dropdownParent: $('#requestModal'), // ðŸ”¥ wajib modal
      placeholder: "Pilih Fasilitas",
      allowClear: true,
      minimumInputLength: 3,              // ðŸ”¥ cegah spam request
      width: '100%',
      ajax: {
         url: "<?= base_url('fasilitas/GetFasilitasTemuan2') ?>",
         type: "POST",
         dataType: "json",
         delay: 500,                      // ðŸ”¥ debounce (mobile aman)
         data: function (params) {
            return {
               serc: params.term
            };
         },
         processResults: function (data) {
            return {
               results: data.results
            };
         },
         cache: true
      }
   });
}


function initTemuanSelect() {

   if ($('#id_temuan').hasClass("select2-hidden-accessible")) {
      $('#id_temuan').select2('destroy');
   }

   $('#id_temuan').select2({
      dropdownParent: $('#requestModal'), // ðŸ”¥ wajib modal
      placeholder: "Pilih Fasilitas",
      allowClear: true,
      minimumInputLength: 3,              // ðŸ”¥ cegah spam request
      width: '100%',
      ajax: {
         url: "<?= base_url('temuan/Getemuan2') ?>",
         type: "POST",
         dataType: "json",
         delay: 500,                      // ðŸ”¥ debounce (mobile aman)
         data: function (params) {
            return {
               serc: params.term
            };
         },
         processResults: function (data) {
            return {
               results: data.results
            };
         },
         cache: true
      }
   });
}


$(document).ready(function(){
//   console.log('jQuery OK:', typeof $);
//   console.log('Select2 OK:', typeof $.fn.select2);
     initFasilitasSelect();
     initTemuanSelect();
});

</script>