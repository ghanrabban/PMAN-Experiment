
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
   .mb-20 {
    margin-bottom: 20px;
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
   .mt-s{
      margin-top: 15px;
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
                  <div class="card " style="display: none;">
                     <div class="card-block">
                        <form id="form-filter" class="col-md-12 row" onsubmit="return FilterData()">
                           <div class="card">
                              <div class="card-header">
                                 RTO
                              </div>
                              <div class="card-body">
                                 <p id="RTO">A well-known quote, contained in a blockquote element.</p>
                                 </blockquote>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 Replay
                              </div>
                              <div class="card-body">
                                 <p id="replay">A well-known quote, contained in a blockquote element.</p>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block ">
                        <ul class="nav nav-tabs  tabs personil-dinas mb-20" role="tablist" >
                           <li class="nav-item nav-link "  role="presentation" onclick="FilterData(1)">
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">List PM</a>
                           </li>
                           <li class="nav-item nav-link" role="presentation" onclick="HistoryPM()" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">History</a>
                           </li>
                           
                        </ul>
                     <div class="tab-pane dataTables_wrapper dt-bootstrap4" id="profile1" role="tabpanel">
                        <div class="row" id="export">
                           <div class="col-md-12">
                              
                           </div>
                        </div>
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
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                 <div class="dataTables_length" id="complex-dt_length">
                                 <div class="pull-right putih mb-10">
                                 <a class="btn btn-primary" onclick="AddManual()"><i class="feather icon-plus-circle"></i> PM Manual Fasilitas</a>
                              </div>
                                 </div>
                              </div>
                            
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class ="table-responsive">
                                 <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                    <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">No</th>
                                              <th class="cemter-t">Tanggal</th>
                                             <th class="cemter-t">Lokasi</th>
                                             <th class="cemter-t">Fasilitas</th>
                                             <th class="cemter-t">Jenis PM</th>
                                          
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
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="M-Form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return UploaderData(this)">
            <div class="modal-body p-0">
              
               <div class="p-4" id="input_group">
               <div class="form-group row mt-s">
                     <label class="col-sm-2 col-form-label">Tanggal PM</label>
                     <div class="col-md-8">
                        <input type="date" class="form-control" name="tanggal_pm" id="tanggal_pm">
                     </div>
                     
                  </div>
                  <div class="form-group row mt-s">
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
                  <hr>
                  <div class="row mt-s">
                     <div class="col-md-12">
                        <div id="form-upload">

                        </div>
                     </div>
                  </div>
                 
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary" id="btn-action">Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>


<div class="modal fade" id="M-FormManual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return UploaderData(this)">
            <div class="modal-body p-0">
              
               <div class="p-4" id="input_group">
                  <div class="row ">
                        <label class="col-md-2 col-form-label"> Fasilitas</label>
                        <div class="col-md-10">
                           <select class="form-control jenis select2Data" id="id_fasilitas" name="id_fasilitas">
                              <option value=""></option>
                           </select>
                        </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label">Tanggal PM</label>
                     <div class="col-md-8">
                        <input type="date" class="form-control" name="tanggal_pm" id="tanggal_pm">
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
                  
                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label">Jenis PM</label>
                     <div class="col-sm-10">
                           <select class="form-control fill" name="idpm_type" id="idpm_type">
                              <option>Pilih Jenis PM</option>
                              <?php foreach ($pm_type as $key => $value): ?>
                                 <option value="<?=$value['idpm_type']?>"><?=$value['name_pm']?></option>
                              <?php endforeach ?>
                           </select>
                     </div>
                  </div>
                  
                  <div class="row mt-s">
                     <div class="col-md-12">

                        <div id="form-upload-manual">

                        </div>
                     </div>
                  </div>
                  
                 
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary" id="btn-action">Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>


<script src="<?=base_url()?>assets_v2/plugins/select2/js/select2.full.min.js"></script>


<script>
   var start = "";
   var end = "";
   
      function show () {
         $("#spinner").addClass("show");
      
      }
      function hide () {
         $("#spinner").removeClass("show");
      }
      var $example = $(".select2Data").select2({
        theme: 'bootstrap',
        dropdownCssClass: 'select2-dropdown--scroll'
      });
 
   function FilterData(status){
      show();
      var typee = '';
       if (status !== 0) {
         typee = 1;  
       }
       var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      $.ajax({
         url: "<?=base_url()?>pm/LoadData/"+typee,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                  var x= 1;
                  jQuery.each(json['pm'], function( i, val ) {
                     var li="";
                     jQuery.each(val, function( ii, vall ) {
                        jQuery.each(vall, function( iii, valll ) {
                           var addBtn  =`<a class="btn btn-primary" onclick="AddData('${valll['id_jadwal']}','${valll['id_fasilitas']}','${valll['idpm_type']}')"><i class="fa fa-file-excel-o "></i> Add PM</a>`;
                           var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${valll['id_pmheader']}')"><i class="feather icon-edit"></i></button>`;
                           var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Hapus Data" onclick="ConfirmData('${valll['id_pmheader']}','delete')"><i class="fa fa-trash"></i></button>`;
                           var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${valll['id_pmheader']}','proses')"><i class="fa fa-gear"></i></button>`;
                           var prnBtn  = `<a href="<?=base_url()?>pm/PrintData/${valll['id_pmheader']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                           var actBtn  = ``;
                           if (valll['id_pmheader'] == null) {
                              actBtn=addBtn;
                            
                           }else{
                              console.log(valll['status_pm']);
                              if (valll['status_pm'] ==="0") {
                                 actBtn=editBtn+prosBtn+delBtn;
                              }if (valll['status_pm'] === "1") {
                                 actBtn=prnBtn;
                              }
                             
                            
                           }
                           row +=`<tr>
                                    <td class="cemter-t">${x}</td>
                                     <td class="cemter-t">${json['tgl']}</td>
                                    <td class="cemter-t">`+i+`</td>
                                    <td class="cemter-t">`+valll['fasilitas']+`</td>
                                    <td class="cemter-t">`+ii+`</td>
                                    <td class="cemter-t">
                                       ${actBtn}
                                          </td>
                                 </tr>`;
                                 x++;
                        }); 
                     });  
                  });



                
                  // $('#btn-updatedata').html('<button class="btn btn-primary" type="submit">Save</button>');
                  $('#tabel-data > tbody:last-child').html(row);
                  hide ();
               }, error: function(){
                  hide ();
               }
      });   
      return false;
   }

   function HistoryPM(){
    
      var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      show();
      $.ajax({
         url: "<?=base_url()?>pm/LoadHistory/",
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                  var x= 1;
                  jQuery.each(json['data'], function( i, val ) {
                     var addBtn  =`<a class="btn btn-primary" onclick="AddData('${val['id_pmheader']}','${val['id_fasilitas']}','${val['idpm_type']}')"><i class="fa fa-file-excel-o "></i> Add PM</a>`;
                     var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${val['id_pmheader']}')"><i class="feather icon-edit"></i></button>`;
                     var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${val['id_pmheader']}','delete')"><i class="fa fa-trash"></i></button>`;
                     var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${val['id_pmheader']}','proses')"><i class="fa fa-gear"></i></button>`;
                     var prnBtn  = `<a href="<?=base_url()?>pm/PrintData/${val['id_pmheader']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                     var actBtn  = ``;
                    
                     if (val['status'] ==="0") {
                        actBtn=editBtn+prosBtn+delBtn;
                     }if (val['status'] === "1") {
                        actBtn=prnBtn;
                     }   
                    

                     row +=`<tr>
                              <td class="cemter-t">${x}</td>
                              <td class="cemter-t">${val['tanggal_pm']}</td>
                              <td class="cemter-t">${val['nama_terminal']}</td>
                              <td class="cemter-t">${val['fasilitas']}</td>
                              <td class="cemter-t">${val['name_pm']}</td>
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
    
   $('.personil-dinas  li[role!=x]').click(function(){
          var li = $(this).index();
     		$('li').removeClass('active');
     		$(this).addClass('active');
         var page=  $(this).attr("id");
         var client=  $(this).attr("data-clint");
         var so=     $(this).attr("data-so");
     
   });

   function AddData(idjadwal,id,idpm_type){
      $('#M-Form').modal('show');
      $('#M-Form').find('.modal-title').html('Upload File Dokumentasi PM');   
      $('#M-Form').find('form').attr('onsubmit','return UploadData(this,\''+id+'\',\''+idpm_type+'\',\''+idjadwal+'\')');
      $.ajax({
         url: "<?=base_url()?>pm/ListJob/"+idjadwal,
         type: 'post',
         // data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            var row ='';
            jQuery.each(json['data']['list_job'], function( i, val ) {
              
                 row += `<div class="row ">
                           <div class="col-md-12">
                              <div class="row">
                              
                                 <label class="col-sm-5 control-label">`+val['nama']+`</label>
                                 <div class="col-sm-7">
                                    <input type="hidden" id="jobPM`+i+`" name="Newitems[${i}][jobPM]" value="${val['id_jobpm']}"  >

                                  <input type="file" id="filePM`+i+`" name="Newitems[${i}][file]" class="d-none" onchange="setUploader(this,'name_file`+i+`')" accept=".jpg, .png, .jpeg">

                                    <input type="text" readonly class="form-control" placeholder="File" id="name_file`+i+`"> 
                                    <div class="btn-group mt-s ">
                                       <button type="button" onclick="$('#filePM`+i+`').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                       <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
              
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <br>
                         </div>`;
               
              
            });
            $('#form-upload').html(row);
         }, error: function(){
            hide ();
         }
      });   
      return false;
   }

   function AddManual(){
      $('#M-FormManual').modal('show');
      $('#M-FormManual').find('.modal-title').html('Upload File Dokumentasi PM Manual');   
      $('#M-FormManual').find('form').attr('onsubmit','return UploadDataManual(this)');
     
   }
  
   function EditData(id){
      $('#M-Form').modal('show');
      $('#M-Form').find('.modal-title').html('Upload File Dokumentasi PM');   
      $('#M-Form').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $('#M-Form').find('#btn-action').html('Update');   
      $.ajax({
         url: "<?=base_url()?>pm/EditData/"+id,
         type: 'post',
         // data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $('#tanggal_pm').val(json['data']['pm']['tanggal_pm']); 
            $('#jam_mulai').val(json['data']['pm']['jam_mulai']); 
            $('#jam_selesai').val(json['data']['pm']['jam_selesai']); 
            // console.log(json['data']['pm']['tanggal_pm']);
            var row ='';
            jQuery.each(json['data']['pm']['detail'], function( i, val ) {
               var inputForm='';
               if (val['dokumentasi'] !== '') {
                  inputForm=`
                    <div class="row">
                     <p class="text-muted col-md-10">${val['documentasi']}</p>
                     <div class="col-md-2 text-right">
                        <a class="text-danger" onclick="delete_attachment('inputUpload${i}','${i}','${val['id_jobpm']}')">
                        <i class="fa fa fa-times"></i></a>
                     </div>
                    </div>
                  `;
               }else{
                  inputForm=`
                                    <input type="hidden" id="jobPM`+i+`" name="Newitems[${i}][jobPM]" value="${val['id_jobpm']}"  >

                                    <input type="file" id="filePM`+i+`" name="Newitems[${i}][file]" class="d-none" onchange="setUploader(this,'name_file`+i+`')" accept=".jpg, .png, .jpeg">
                                    <input type="text" readonly class="form-control" placeholder="File" id="name_file`+i+`"> 
                                    <div class="btn-group mt-s ">
                                       <button type="button" onclick="$('#filePM`+i+`').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                       <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
              
                                    </div>
                                `;
               
                 ;
               }
               row += `<div class="row ">
                           <div class="col-md-12">
                              <div class="row">
                                 <div id="removed-attact"></div>
                                 <label class="col-sm-5 control-label">`+val['nama']+`</label>
                                 <div class="col-sm-7" id="inputUpload${i}">
                                 ${inputForm}
                                  </div>
                              </div>
                           </div>
                           <br>
                         </div>`
              
            });
            $('#form-upload').html(row);
         }, error: function(){
            hide ();
         }
      });   
      return false;
   }

  function UploadData(f,id,idpm_type,idjadwal){
   // show();
     
      var formData = new FormData($(f)[0]);
       formData.append('idjadwal', idjadwal);
      // formData.append('idfasilitas', idjadwal);
         $.ajax({
         url: "<?=base_url('pm/UploadData')?>/"+id+'/'+idpm_type,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            // LoadFiles();
            FilterData(0);
            $('#M-Form').modal('hide');
            $(f)[0].reset();
            // remove_photo()
         }, error: function(){
            err();
         }
      });
   return false;
  }

  function UploadDataManual(f){
   // show();
     
      var formData = new FormData($(f)[0]);
     
      // formData.append('idfasilitas', idjadwal);
         $.ajax({
         url: "<?=base_url('pm/UploadDataManual')?>",
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            // LoadFiles();
            HistoryPM();
            $('#M-Form').modal('hide');
            $(f)[0].reset();
            // remove_photo()
         }, error: function(){
            err();
         }
      });
   return false;
  }

  function setUploader(input,id){
        if (!window.FileReader) {
          alert('Browser yang Anda gunakan tidak support fitur ini.');
        }else{
          if(input.files && input.files[0]){
            if(input.files[0].type.match('image')){
               //    $dropzone.hide(); $('#input_group').show(300);
               //  $dropzone.removeClass('dropping');
               // $('.dizabled').removeClass('dizabled');

               //  var reader = new FileReader();
               //  reader.onload = function(event){
               //    file_data = event.target.result;
               //   // $dropimg.css('background-image', 'url(' + event.target.result + ')');

               //    reader.src = event.target.result;
               //  };
               console.log(id);
                $('#'+id).val(input.files[0].name);
               //  $('#m-uploader').find('input:text').val(input.files[0].name);
               //reader.readAsDataURL(input.files[0]);

                //file_exist = false;
            }else{
              alert("Format file tidak valid"+input.files[0].type);
            }
           
          }
        }

   }

   
   function delete_attachment(r,i,id_jobpm){
    //  $("#removed-attact").append(hidden_input("removed_items[]", a))
    var inputUpload=`
                                    <input type="hidden" id="jobPM`+i+`" name="Newitems[${i}][jobPM]" value="${id_jobpm}"  >

                                    <input type="file" id="filePM`+i+`" name="Newitems[${i}][file]" class="d-none" onchange="setUploader(this,'name_file`+i+`')" accept=".jpg, .png, .jpeg">
                                    <input type="text" readonly class="form-control" placeholder="File" id="name_file`+i+`"> 
                                    <div class="btn-group mt-s ">
                                       <button type="button" onclick="$('#filePM`+i+`').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                       <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
              
                                    </div>
                                 `;
    $('#'+r).html(inputUpload);
   }
   function hidden_input(e, t) {
    //return '<input type="hidden" name="' + e + '" value="' + t + '">'
   }
   

   function UpdateData(f,id){
      var formData = new FormData($(f)[0]);
       //formData.append('idjadwal', idjadwal);
      // formData.append('idfasilitas', idjadwal);
         $.ajax({
         url: "<?=base_url('pm/UpdateData/')?>"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            HistoryPM(0);
            $('#M-Form').modal('hide');
            $(f)[0].reset();
         }, error: function(){
            err();
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
         url: '<?= base_url('pm/ProsesData/') ?>' + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            Tab();
         }, error: function(){
         hide();
         }
      });
      
   }

   function DeleteData(id){

      $.ajax({
         url: '<?= base_url('pm/DeleteData/') ?>' + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            
            var json = JSON.parse(r);
            NF(json);
            FilterData();
            HistoryPM(0);
         }, error: function(){
         hide();
         }
      });

   }

   $('body').on('change','#limitData', function() {
      Tab();
   });

   function PrintData(){

   }
   LoadFasilits();
   function LoadFasilits(){
   
      show();
      $.ajax({
            url: "<?=base_url()?>fasilitas/LoadFasilitas",
            type: 'post',
            // data: formData,
            contentType: false,
            processData: false,

            success: function(r){
               var json = JSON.parse(r);
               var row = "<option ></option>";
               jQuery.each(json, function( i, val ) {
               
                  row +=` <option value="`+val['id_fasilitas']+`">`+val['nama_fasilitas']+`</option>`;
               });
               
            
               $('#id_fasilitas').html(row);
            
            
            }, error: function(){
               
            }
      });   
      return false;

   }

   $('body').on('change','#idpm_type', function() {
  console.log('pmtype change');
      if($(this).val() != ''){
         var id=$(this).val();
         var formData = new FormData();
         formData.append('fasilitas',  $('#id_fasilitas').val());
         $.ajax({
            url: "<?=base_url()?>pm/ListJobManual/"+id,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               var row ='';
               jQuery.each(json['data']['list_job'], function( i, val ) {
               
                  row += `<div class="row ">
                              <div class="col-md-12">
                                 <div class="row">
                                 
                                    <label class="col-sm-5 control-label">`+val['nama']+`</label>
                                    <div class="col-sm-7">
                                       <input type="hidden" id="jobPM`+i+`" name="Newitems[${i}][jobPM]" value="${val['id_jobpm']}"  >

                                    <input type="file" id="filePM`+i+`" name="Newitems[${i}][file]" class="d-none" onchange="setUploader(this,'name_file`+i+`')" accept=".jpg, .png, .jpeg">

                                       <input type="text" readonly class="form-control" placeholder="File" id="name_file`+i+`"> 
                                       <div class="btn-group mt-s ">
                                          <button type="button" onclick="$('#filePM`+i+`').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                          <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
               
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <br>
                           </div>`;
                  
               
               });
               $('#form-upload-manual').html(row);
            }, error: function(){
               hide ();
            }
         });   
        
         
      }
   });
   Tab();
   function Tab(){
     
      var url = new URL(window.location.href);
      var param = url.searchParams.get("tab");
     
     
      if(param == 'history'){ 
         HistoryPM();
         $('.nav-tabs li:eq(1)').addClass('active')
      }else{
         FilterData(0);
         $('.nav-tabs li:eq(0)').addClass('active')
      }
   }
   
   $('.nav li[role!=x]').click(function(){
     
     var li = $(this).index();
       $('li').removeClass('active');
       $(this).addClass('active');
  
      $('.nav li').removeClass('active');

      $(this).addClass('active');
      console.log(li);
      
      if(li == 0){

         window.history.pushState('', 'Title', 'pm');
      //  tab_content.eq(0).addClass('show active'); 
         //_education();
      }else if(li == 1){
         window.history.pushState('', 'Title', 'pm?tab=history');
      //  tab_content. eq(1).addClass('show active');
         // _photo(); load jabatan
      }
   });
  
      
</script>