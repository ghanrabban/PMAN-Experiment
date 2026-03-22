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
                                 <button type="button" class="btn btn-primary" onclick="AddData()"> Tambah Baru</button>
                                 </div>
                              </div>
                           </div>
                           <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                              <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-sm-12 col-md-2">
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
                                    <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
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
                                             <th class="cemter-t">Nama Perangkat</th>
                                             <th class="cemter-t">Serial Number</th>
                                             <th class="cemter-t">Indikator Kerusakan</th>
                                             <th class="cemter-t">Keterangan</th>
                                             <th class="cemter-t">Tindak Lanjut</th>
                                             <th class="cemter-t">Status</th>
                                             <th class="cemter-t">Aksi</th>
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
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>


<!-- Modal Request Tiket -->

<div class="modal modal-fullscreen-xl" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestModalLabel">Request Tiket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!-- Form request -->
            <form method="post"  enctype="multipart" onsubmit="return SaveData(this)">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pembuat:</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="pembuat" name="pembuat" value="<?=sess()['nama']?>" disabled>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Perangkat:</label>
                        <div class="col-sm-8">
                           <input type="hidden" id="id_perangkat" style="width: 300px;" name="id_perangkat"  />
                        
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Perbaikan:</label>
                        <div class="col-sm-3">
                           <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Indikator Kerusakan</label>
                        <div class="col-sm-8">
                           <input type="hidden" id="indikator_kerusakan" style="width: 50%; " name="indikator_kerusakan"  />
                         </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                           <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan"></textarea>
                        
                         </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tindakan Perbaikan</label>
                        <div class="col-sm-8">
                           
                            <input type="hidden" id="tindakan" style="width: 50%;" name="tindakan"  />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status Perbaikan</label>
                        <div class="col-sm-8">
                           <select class="form-control" name="status" id="status"> 
                              <?php foreach ($status as $val): ?>
                              <option value="<?= $val['kode_status'] ?>"><?= $val['nama'] ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     
                    
                  </div>
               </div>
              
               <div class="row">
                  <div class="col-md-12">
                  <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  </div>
               </div>
               
            </form>
            
         </div>
      </div>
   </div>
   <!-- [ page content ] end -->
</div>
<!-- End Modal Request tiket -->




<link href="<?=base_url()?>assets_v2/plugins/form-select2/select2.css" rel="stylesheet" >
<script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/form-select2/select2.js"></script>


<script>


    FilterData();

   function FilterData(id) {
      show();
      var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      formData.append('src',  $('#srcData').val());
      var jenis =($('#jenis_perangkat').val() == null ? '': $('#jenis_perangkat').val());
      formData.append('jenis_perangkat',  jenis);
     var id =(id == null ? 0: id);
      $.ajax({
         url: "<?=base_url()?><?=$modul?>/LoadData/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function (r) {
               var json = JSON.parse(r);
               var row = "";
               var no = 1;
               jQuery.each(json['data'], function( i, val ) {

                  var approveButton = '<button class="btn waves-effect waves-light btn-warning btn-icon" title="Approve" onclick="Approve(' + val['id_perbaikan'] + ')"><i class="fa fa-check"></i></button>';
                  var editButton = '<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(' + val['id_perbaikan'] + ')"><i class="feather icon-edit"></i></button>';
                  var viewButton = '<button class="btn waves-effect waves-light btn-primary btn-icon" title="View" onclick="ViewData(' + val['id_perbaikan'] + ')"><i class="feather icon-eye"></i></button>';
                  var deleteButton = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${val['id_perbaikan']}','delete')"><i class="fa fa-trash"></i></button>`;
                  var none = '<button class="btn waves-effect waves-light btn-disabled btn-icon"><i class="feather icon-slash"></i></button>';
                   
                  
                  var btn = '';
                  if (val['status'] !== '9') {
                     btn =editButton+viewButton+deleteButton;
                  }
                
                  row +=`<tr >
                           <td>` +(no++) + `</td>
                           <td>` +val['tanggal'] + `</td>
                           <td>` +val['nama_perangkat'] + `</td>
                           <td>` +val['serial_number'] + `</td>
                           <td>` +val['indikator_kerusakan'] + `</td>
                           <td>` +val['keterangan'] + `</td>
                           <td>` +val['tindakan'] + `</td>
                           <td>` +val['status_label'] + `</td>
                           <td>
                            ${btn}
                           </td>
                        </tr>`;
               });
                 console.log(row);
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

   
   $('body').on('change','#limitData', function() {
      FilterData();
   });

   $( "#srcData" ).on( "keyup", function() {
      FilterData();
   
   } );


   function AddData(){
      // show();
      ResetFormModal();

      $('#requestModal').modal('show');
      $('#requestModal').find('.modal-title').html('Pergantian Perangkat');   
      $('#requestModal').find('form').attr('onsubmit','return SaveData(this)');
      $('#submitBtn').html('Save');
    
   }


   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
 
      $.ajax({
         url:  '<?=base_url('perbaikan/')?>SaveData/',
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            $(f)[0].reset(); 
            $('#requestModal').modal('hide');
          
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
            url: '<?= base_url('tiket/Delete/') ?>' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
            LoadData();
            hide();
            }, error: function(){
            hide();
            }
         });
      } else {
         return false;
      }
   }



   function ResetFormModal() {
      //$('#pembuat').val('').prop('disabled', false);
      $('#unit').val('');  
      $('#id_fasilitas').val('');  
      $('#lokasi').val(''); 
      $('#sublokasi').val(''); 
      $('#date_start').val('').prop('disabled', false);
      $('#keterangan').val('');
      //$('#upload_before').val('');
      
   }

   function EditData(id){
      $('#requestModal').modal('show');
      $('#requestModal').find('.modal-title').html('Edit Data Perbaikan');   
      $('#requestModal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $('#submitBtn').html('Update Data');
      
      $.ajax({
         url: "<?=base_url()?>perbaikan/EditData/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                  $('#pembuat').val(json['create_by']).prop('disabled', true);
                  $('#tanggal').val(json['tanggal']); 
                  $('#status').val(json['status']); 
                  $('#id_perangkat').select2(
                     'data',json['perangkat']
                  );
                  $('#indikator_kerusakan').select2(
                     'data',json['indikator']
                  );

                  $('#keterangan').val(json['keterangan']); 
                  $('#tindakan').select2(
                     'data',json['tindakan']
                  );
         },
         error: function(){
               hide();
         }
      });
      return false;
   }

   function ViewData(id){
      $('#requestModalView').modal('show');
      $('#requestModalView').find('.modal-title').html('Details');   
      //$('#requestModalView').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      
      
      $.ajax({
         url: "<?=base_url()?>tiket/ViewData/"+id,
         type: 'post',
         success: function(r){
                  var json = JSON.parse(r);
                     $('#pembuat1').text(json['create_by']);
                     $('#unit1').text(json['kode_unit']);  
                     $('#fasilitas1').text(json['nama_fasilitas']);  
                     $('#lokasi1').text(json['nama_lokasi']);  
                     $('#sublokasi1').text(json['nama_sublokasi']); 
                     $('#date_start1').text(json['create_date']);
                     $('#keterangan1').text(json['description']); 
                     //$('#upload_before').parent().parent().hide();
                     //$('#submitBtn').hide(); 
                  
         },
         error: function(){
               hide();
         }
      });
      return false;
   }


   function UpdateData(f,id) {
      var formData = $(f).serialize();

      $.ajax({
         url: "<?=base_url()?>perbaikan/UpdateData/"+id,  
         type: 'post',
         data: formData,
         success: function(r) {
            var json = JSON.parse(r);
            NF(json);
            $(f)[0].reset(); 
            $('#requestModal').modal('hide');
            FilterData();
         },
         error: function(xhr, status, error) {
      
               console.error("Error updating data");
               console.log("Status: " + status);
               console.log("Error: " + error);
               console.log("Response Text: " + xhr.responseText);
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
   
   function DeleteData(id){

      $.ajax({
         url: '<?= base_url('perbaikan/DeleteData/') ?>' + id,
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

  $("#id_perangkat").select2({
      multiple: false,
      placeholder: "Pilih Perangkat",
      ajax: {
            url:  "<?= base_url('perangkat/GetPerangkat') ?>",
            dataType: 'json',
            type: "POST",
            quietMillis: 50,
            data: function (serc) {
                return {
                    serc: serc
                };
                 alert("error");
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            }
        },
   });

   var lastResults = [];
   $("#indikator_kerusakan").select2({
      multiple: false,
      placeholder: "Indikator Kerusakan",
      ajax: {
            url:  "<?= base_url('perbaikan/GetIndikator/') ?>",
            dataType: 'json',
            type: "POST",
            quietMillis: 50,
            data: function (serc) {
                return {
                    serc: serc
                };
                 alert("error");
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                           text: item.text,
                           id: item.id
                        }
                    })
                };
            }
        },
      initSelection: function (element, callback) {
        var data = [];
   
        $(element.val().split(",")).each(function () {
          data.push({
            id: this,
            text: this
          });
        });
   
        callback(data);
        ;
      },
      createSearchChoice: function (term) {
        var text = term + (lastResults.some(function (r) {
          return r.text == term
        }) ? "" : " (new)");
        return {
          id: term,
          text: text
        };
      },
   });

 

   $("#tindakan").select2({
      multiple: false,
      placeholder: "Tindakan Perbaikan",
      ajax: {
            url:  "<?= base_url('perbaikan/GetTindakan/') ?>",
            dataType: 'json',
            type: "POST",
            quietMillis: 50,
            data: function (serc) {
                return {
                    serc: serc
                };
                 alert("error");
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                           text: item.text,
                           id: item.id
                        }
                    })
                };
            }
        },
      initSelection: function (element, callback) {
        var data = [];
   
        $(element.val().split(",")).each(function () {
          data.push({
            id: this,
            text: this
          });
        });
   
        callback(data);
        ;
      },
      createSearchChoice: function (term) {
        var text = term + (lastResults.some(function (r) {
          return r.text == term
        }) ? "" : " (new)");
        return {
          id: term,
          text: text
        };
      },
   });


</script>
