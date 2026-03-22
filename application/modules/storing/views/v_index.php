<style>
     /* css  chekbok*/
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 5px;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
   /* end css chekbox */

   
</style>


<link href='<?= base_url() ?>assets_v2/plugins/dropzone/dropzone.css' type='text/css' rel='stylesheet'>
<script src='<?= base_url() ?>assets_v2/plugins/dropzone/dropzone.js' type='text/javascript'></script>
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
                        <ul class="nav nav-tabs  tabs personil-dinas mb-20" role="tablist" >
                           <li class="nav-item nav-link "  role="presentation" onclick="FilterData(1)">
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">List PM</a>
                           </li>
                           <li class="nav-item nav-link" role="presentation" onclick="HistoryStoring()" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">History</a>
                           </li>
                           
                        </ul>
                       
                        
                        
                           
                            <div class="row" id="export">
                            <div class="col-md-12">
                                <div class="pull-right putih mb-10">
                                    <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Tambah</a>
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
                                <div class="col-xs-12 col-sm-12 col-sm-12 col-md-4">
                                    <div class="dataTables_length" id="complex-dt_length">
                                        <label>
                                        Filter By 
                                        <select name="complex-dt_length" aria-controls="complex-dt" class="form-control " id="jenis_perangkat">
                                            <option></option>
                                            <option value="Consumable Part">Consumable Part</option>
                                            <option value="Sparepart">Sparepart</option>
                                        </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                                </div>
                            </div>
                            <div class="tab-content tabs card-block">
                            <div class="tab-pane  dataTables_wrapper dt-bootstrap4" id="jadwal-storing" role="tabpanel">
                                <div class="row">
                                    <h3 class="center">Jadwal Storing</h3>
                                </div>
                                <div class="row table-responsive">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                        <thead class="thead-blue">
                                            <tr>
                                            <th class="cemter-t">No </th>
                                            <th class="cemter-t">Fasilitas</th>
                                            <th class="cemter-t">Area</th>
                                            <th class="cemter-t">Status</th>
                                            <th class="cemter-t">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Data-AP">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane  dataTables_wrapper dt-bootstrap4" id="history-manual" role="tabpanel">
                                <div class="row">
                                    <h3 class="center">History Storing</h3>
                                </div>
                                <div class="row table-responsive">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                        <thead class="thead-blue">
                                            <tr>
                                            <th class="cemter-t">No </th>
                                            <th class="cemter-t">Tanggal</th>
                                            <th class="cemter-t">Lokasi</th>
                                            <th class="cemter-t">Fasilitas</th>
                                            <th class="cemter-t">Catatan</th>
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
               <div class="form-group row">
                  <label class="col-sm-6 col-form-label">Kondisi Kamera CCTV</label>
                  <div class="col-sm-2">
                     <label class="container"> <span>Baik</span>
                     <input type="radio" class="check-form" name="newdata[`+rowCount+`][create]" value="1" `+(val['controle_create']==1 ? 'checked': '')+`>
                     <span class="checkmark"></span>
                     </label>
                  </div>
                  <div class="col-sm-2">
                     <label class="container">
                     <input type="radio" class="check-form" name="newdata[`+rowCount+`][create]" value="1" >
                     <span class="checkmark"></span>
                     </label>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Kegiatan</label>
                  <div class="col-sm-8">
                     <textarea class="form-control" id="keterangan" name="description" rows="4" placeholder="Masukkan keterangan tiket" required></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-md-12">
                     <div class="dropzone" id="attac">
                        <div class="dz-message">
                           <h3> Klik atau Drop gambar disini</h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary" id="btn-action">Save </button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="m-modal-manual" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
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
                  <div class="form-group row">
                     <label class="col-sm-4 col-form-label">Fasilitas</label>
                     <div class="col-sm-8">
                        <input type="hidden" id="id_fasilitas" style="width: 300px" name="id_fasilitas"  />
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 col-form-label">Tanggal</label>
                     <div class="col-sm-8">
                        <input type="date" class="form-control" name="tanggal_manual" id="tanggal_manual" >
                     </div>
                  </div>
                  <div class="form-group row" id="list-manual">
                    
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 col-form-label">Catatan</label>
                     <div class="col-sm-8">
                        <textarea class="form-control" id="catatan_manual" name="catatan_manual" rows="4" placeholder="Masukkan Catatan Temuan saat Storing" required></textarea>
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-md-12">
                        <div class="dropzone" id="attac-manual">
                           <div class="dz-message">
                              <h3> Klik atau Drop gambar disini</h3>
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
 <link href="<?=base_url()?>assets_v2/plugins/form-select2/select2.css" rel="stylesheet" >
 <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/form-select2/select2.js"></script>
<script>

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

    function HistoryStoring(){
        console.log('historu');
      var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      show();
      $.ajax({
         url: "<?=base_url().$modul?>/LoadHistory/",
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                  var x= 1;
                  jQuery.each(json['data'], function( i, val ) {
                     var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${val['id_storing']}')"><i class="feather icon-edit"></i></button>`;
                     var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${val['id_storing']}','delete')"><i class="fa fa-trash"></i></button>`;
                     var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${val['id_storing']}','proses')"><i class="fa fa-gear"></i></button>`;
                     var prnBtn  = `<a href="<?=base_url().$modul?>/PrintData/${val['id_storing']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                     var actBtn  = ``;
                    
                     if (val['status'] ==="0") {
                        actBtn=editBtn+prosBtn+delBtn;
                     }if (val['status'] === "1") {
                        actBtn=prnBtn;
                     }   
                    

                     row +=`<tr>
                              <td class="cemter-t">${x}</td>
                              <td class="cemter-t">${val['tanggal']}</td>
                              <td class="cemter-t">${val['nama_terminal']}</td>
                              <td class="cemter-t">${val['nama_fasilitas']}</td>
                              <td class="cemter-t">${val['catatan']}</td>
                              <td class="cemter-t">
                                 ${actBtn}
                              </td>
                           </tr>`;
                           x++;
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
      $('#m-modal-manual').modal('show');
      $('#m-modal-manual').find('.modal-title').html('Ceklist Fasilitas Manual');   
      $('#m-modal-manual').find('form').attr('onsubmit','return SaveManual(this)');
      // LoadFasilitas();
    
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
         formData.append("id_file",id_file);
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
            FilterData();
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
             HistoryStoring();
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
            HistoryStoring();
            // FilterData();
            //  DetailData(id_lokasi);
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


   var id_file=[];
      Dropzone.autoDiscover=false;
      
      var myDropzone= new Dropzone("#attac",{
         url: "<?=base_url().$modul?>/UploadDock",
         acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,application/pdf",
         addRemoveLinks:true,
         success: function(file, r){
            var json = JSON.parse(r);
            file.serverId = json['id'];
            id_file.push(json['id']);
         }
       
      });

      myDropzone.on("removedfile",function(a){
         var token=a.serverId;
      
         $.ajax({
            type:"post",
            data:{token:token},
            url:"<?=base_url().$modul?>/RemoveFile",
            cache:false,
            dataType: 'json',
            success: function(){
               
            },
            error: function(){
            
      
            }
         });
      });

      

   var lastResults = [];
   $("#id_fasilitas").select2({
      multiple: false,
      placeholder: "Pilih Fasilitas",
      ajax: {
            url:  "<?= base_url('fasilitas/GetFasilitasTemuan') ?>",
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

   $('body').on('change','#id_fasilitas', function() {
      
      if($(this).val() != ''){
         var id=$(this).val();
         getceklisjob(id);
      }
   });

   function getceklisjob(id){
      $.ajax({
            url: '<?=base_url().$modul?>/Getlokasi/' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               var row = "";
                 jQuery.each(json['data'], function( i, val ) {
              
                  row +=`  <input type="hidden" id="id`+i+`"  style="width: 300px" name="newdata[`+i+`][id_ceklist_manual]" value="`+val['id_ceklis']+`">
                  <label class="col-sm-4 col-form-label">${val['nama_pekerjaan']}</label>
                     <div class="col-sm-4">
                        <label class="container"> <span>Baik</span>
                        <input type="radio" class="check-form" name="newdata[`+i+`][kondisi_manual]" value="1" >
                        <span class="checkmark"></span>
                        </label>
                     </div>
                     <div class="col-sm-4">
                        <label class="container">Kurang Baik
                        <input type="radio" class="check-form" name="newdata[`+i+`][kondisi_manual]" value="0" >
                        <span class="checkmark"></span>
                        </label>
                     </div>`;
                   
                  });
                  console.log(row);
                  $('#list-manual').html(row);
            }, error: function(){
            hide();
            }
       });
   }

   Tab();
   function Tab(){
     
      var url = new URL(window.location.href);
      var param = url.searchParams.get("tab");
     
     
      if(param == 'history'){ 
         HistoryStoring();
        $('.nav-tabs li:eq(1)').addClass('active')
        $('#history-manual').addClass('active');
        $('#jadwal-storing').removeClass('active');
      }else{
         FilterData(0);
        $('.nav-tabs li:eq(0)').addClass('active')
         $('#jadwal-storing').addClass('active');
        $('#history-manual').removeClass('active');
      }
   }
   
   $('.nav li[role!=x]').click(function(){
     
     var li = $(this).index();
        $('li a').removeClass('active');
        $(this).addClass('active');
  
        $('.nav li').removeClass('active');
   
        $(this).addClass('active');
     
        if(li == 0){
            
            window.history.pushState('', 'Title', 'storing');
            $('#jadwal-storing').addClass('active');
            $('#history-manual').removeClass('active');
        }else if(li == 1){
            window.history.pushState('', 'Title', 'storing?tab=history');
            $('#history-manual').addClass('active');
            $('#jadwal-storing').removeClass('active');
            
        }
   });

  function DeleteFile(file){
   console.log(file);
     var token=file.serverId;
      if(!token){
           console.log('Tidak Ada yang di hapus'+token);
         return;
         
      }else{
           console.log('token/Id  ada'+token);
         $.ajax({
            type:"post",
            data:{token:token},
            url:"<?=base_url().$modul?>/RemoveFile",
            cache:false,
            dataType: 'json',
            success: function(){
               console.log('delete id'+token);
            },
            error: function(){
            
      
            }
         });
      }
  }

  
      let skipServerDeleteManual = false;
      var id_file_manual=[];
      var myDropzone2= new Dropzone("#attac-manual",{
         url: "<?=base_url().$modul?>/UploadDock",
         acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,application/pdf",
         addRemoveLinks:true,
         init: function () {
             var dz = this;
             dz.on("removedfile", function (file) {
               console.log('delete file');
              if (skipServerDeleteManual){
               console.log('skip delete');
                  return ;
              }else{
               console.log('hapus file');
                  DeleteFile(file);
              }
                 // Kalau perlu hapus dari server sementara, panggil AJAX di sini
            });
         },
         success: function(file, r){
            var json = JSON.parse(r);
            file.serverId = json['id'];

            id_file_manual.push(json['id']);
        
         }
       
      });

      function SaveManual(f){
         show();
         var formData = new FormData($(f)[0]);
         formData.append("id_file",id_file_manual);
         $.ajax({
               url: "<?=base_url().$modul?>/SaveManual",
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  // $('#ModakEditMonitoring').modal('hide');
                  var json = JSON.parse(r);
                  HistoryStoring();
                  NF(json);
                  hide();
                  $(f)[0].reset();
                  skipServerDeleteManual = true;
                  myDropzone2.removeAllFiles(true);
                  skipServerDeleteManual = false;

                  id_file_manual = [];
                  $('#m-modal-manual').modal('hide');
               }, error: function(){
                  hide ();
               }
         });
                  
            return false;
   }

</script>
