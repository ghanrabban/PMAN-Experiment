


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
   .label-primary {
    background: #5daaff;
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
   .cemter-t{
      text-align: center;
   }
   
   table {
   
    border-spacing: 2px;
   }
  
   .table .thead-dark th {
      color: #fff;
      background-color: #878888b8;
      border-color: #878d93f5;
      vertical-align: middle;
      text-align: center;
   }

  .warnaBarisAwal{
   background-color: #2596be;
   color: white;
  }

  .warnaBG{
   background-color: #80b4fc;
  }

.t-formatP th{
   vertical-align: middle;
}

.center{
   vertical-align: middle;
   text-align: center;
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
   max-width: 70%;
   max-height: 70%;
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
                                 <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
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
                                 <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
                                    <div class="dataTables_length" id="complex-dt_length">
                                       <label>
                                          Status 
                                          <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm" id="limitData">
                                          <option value="5">5</option>   
                                          <option value="10">10</option>
                                             <option value="25">25</option>
                                             <option value="50">50</option>
                                             <option value="100">100</option>
                                             <option value="1000">1000</option>
                                          </select>
                                        
                                       </label>
                                    </div>
                                 </div>
                                 
                                 <div class="col-xs-12 col-sm-12 col-md-2">
                                     <div id="complex-dt_filter" class="dataTables_filter">
                                        <label>Search:
                                           <input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData">
                                        </label>
                                     </div>
                                </div>
                           </div>
                           <div class="row">
                              <div class="table-responsive">
                                 <table class="table  table-condensed table-striped table-bordered" id="tabel-data">
                                    <thead class="thead-blue">
                                       <tr>
                                          <th class="cemter-t">No</th>
                                           <th class="cemter-t">Tanggal</th>
                                          <th class="cemter-t">Lokasi</th>
                                          <th class="cemter-t">Fasilitas</th>
                                          <th class="cemter-t">Dokumentasi Before</th>
                                          <th class="cemter-t">Dokumentasi After</th>
                                          <th class="cemter-t">Statusr</th>
                                          <th class="cemter-t">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="Data-AP">
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
         </div>
         <!-- [ page content ] end -->
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
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Status</label>
                           <div class="col-sm-1 pl-0"><span class="pull-right">:</span></div>
                           <div class="col-sm-8  pr-0  pl-0" id="l_status"></div>
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
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->


<script>
  
 
   FilterData();

   function FilterData(id){
      show();
      
   var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      formData.append('src',  $('#srcData').val());
      var id =(id == null ? 0: id);
        $.ajax({
            url: "<?=base_url()?>list_approval_leader/LoadData/"+id,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,

            success: function(r){
                var json = JSON.parse(r);
                var row = "";
                var no =1;
                jQuery.each(json['data'], function( i, val ) {
                 
                  var BTN ='';
                  var BtnApprove = `<a class="btn btn-primary" onclick="ConfirmData('Approve Data','aprove',`+val['id_tinjut']+`)"><i class="feather icon-check-circle"></i> </a>`;
                  var BtnReject  = `<a class="btn btn-danger" onclick="ConfirmData('Reject Data','reject',`+val['id_tinjut']+`)"><i class="feather icon-slash"></i> </a>`;
                  var BtnView    = ` <a class="btn btn-primary" onclick="ViewData(`+val['id_tinjut']+`)"><i class="feather icon-eye"></i> </a>`;
                  var statusBtn     =`<label class="label label-info">Approve Leader</label>`;
                  if (val['status'] === '1') {
                     BTN=BtnView+BtnApprove+BtnReject;
                  }else if(val['status'] === '2') {
                     BTN=BtnView;
                  }else {
                     BTN=BtnView;
                  }
                      row +=`<tr >
                                       <td class="center">`+(no++)+`</td>
                                       <td class="center">`+val['tanggal']+`</td>
                                       <td class="center">`+val['nama_terminal']+`</td>
                                       <td class="center">`+val['nama_fasilitas']+`</td>
                                       <td class="center"><a class="btn btn-link" onclick="previewImage('<?=base_url()?>upload/` + val['foto_before'] +` ')"><img src="<?=base_url()?>upload/` +val['foto_before']+ `" width="120" height="80" class="img-fluid" id="gambar"</a></td>
                                       <td class="center"><a class="btn btn-link" onclick="previewImage('<?=base_url()?>upload/` + val['foto_after'] +` ')"><img src="<?=base_url()?>upload/` +val['foto_after']+ `" width="120" height="80" class="img-fluid" id="gambar"</a></td>
                                       <td class="center">   ${val['status_label']} </td>
                                       <td class="center">   ${BTN} </td>
                              </tr>`;   
                });

                $('#tabel-data > tbody:last-child').html(row);
               //  $('#tabel-data').html(row);

                $('#data-pag').html(json['pag']['label']);
               
               hide ();
            }, error: function(){
               hide ();
            }
        });
                
            return false;
   }

function Approve(id) {
    // Display a confirmation dialog
   $.ajax({
            url: "<?=base_url()?>list_approval_leader/ProsesApprove/"+id,
            type: 'post',

            success: function(r) {
               var json = JSON.parse(r);
               NF(json);
                FilterData();

            },
            error: function() {
                // Handle error
            }
   });
   return false;
}


function Reject(id) {
   $.ajax({
      url: "<?=base_url()?>list_approval_leader/ProsesReject/"+id,
      type: 'post',
      success: function(r) {
         FilterData();
         ResponseReject();
      },
      error: function() {
                // Handle error
      }
   });
    return false;
}


   function previewImage(imageUrl) {
      // Buat elemen modal
      var modal = document.createElement('div');
      modal.className = 'image-preview-modal';
    
      // Buat elemen gambar dalam modal
      var modalContent = document.createElement('img');
      modalContent.src = imageUrl;
    
      // Tambahkan gambar ke dalam modal
      modal.appendChild(modalContent);
    
      // Tambahkan modal ke dalam body
      document.body.appendChild(modal);
    
      // Tambahkan event listener untuk menutup modal saat gambar di-klik
      modal.addEventListener('click', function() {
      document.body.removeChild(modal);
    });
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
                     $('#l_status').html(json['status_label']);
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


function ConfirmData(judul,type,id){
      cuteAlert({
         type: "question",
         title: judul,
         message: "Apakah anda sudah yakin?",
         confirmText: "Okay",
         cancelText: "Cancel"
      }).then((e)=>{
         if ( e == ("confirm")){
           if (type=="aprove") {
            Approve(id);
           }else if(type=="reject") {
            Reject(id);
           }
         } 
               
      })
}

$( "#srcData" ).on( "keyup", function() {
      FilterData();
   } );

   $('body').on('change','#limitData', function() {
   
   FilterData();
  });
</script>