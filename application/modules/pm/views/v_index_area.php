
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
                                 <li class="nav-item nav-link" role="presentation" onclick="HistoryPM('')" >
                                    <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">History</a>
                                 </li>
                                 
                              </ul>
                              

                              <div class="tab-content tabs card-block">
                                 <div class="tab-pane " id="tab-pm" role="tabpanel">
                                    <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
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
                                          <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
                                             <div class="dataTables_length" id="complex-dt_length">
                                                <div class="row">
                                                   <div class="col-sm-4">
                                                      <label>Tanggal  </label>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <input type="date" aria-controls="complex-dt" class="form-control input-sm filter-pm" id="tanggal" name="complex-dt_length" required>
                                    
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                           <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
                                             <div class="dataTables_length" id="complex-dt_length">
                                                <label>
                                                   Dinas 
                                                   <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm filter-pm" id="shift">
                                                      <option value="">-</option>
                                                      <option value="PS">Pagi</option>
                                                      <option value="M">Malam</option>
                                                   </select>
                                                   entries
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-3">
                                             <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                             <thead class="thead-blue">
                                                <tr>
                                                   <th class="cemter-t">No</th>
                                                   <th class="cemter-t">Fasilitas</th>
                                                   <th class="cemter-t">Area</th>
                                                   <th class="cemter-t">Jenis PM</th>
                                                   <th class="cemter-t">Action</th>
                                                </tr>
                                             </thead>
                                             <tbody id="Data-AP">
                                             </tbody>
                                          </table>
                                       </div>
                                       <div class="row"  id="data-pag-pm">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab-history" role="tabpanel">
                                    <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                       <div class="row" id="export">
                                          <div class="col-md-12">
                                             <div class="pull-right putih mb-10">
                                                <a class="btn btn-primary" onclick="AddManual()"><i class="feather icon-plus-circle"></i> PM Manual Fasilitas</a>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-sm-12 col-md-3">
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
                                          <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                             <div class="dataTables_length" id="complex-dt_length">
                                             <div class="pull-right putih mb-10">
                                                <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcDataHistory"></label></div>
                                             </div>
                                             </div>
                                          </div>
                                       
                                    </div>
                                       <div class="row">
                                          <table class="table table-condensed table-striped table-bordered" id="tabel-data-history">
                                             <thead class="thead-blue">
                                                <tr>
                                                   <th class="cemter-t">No</th>
                                                   <th class="cemter-t">Tanggal PM</th>
                                                   <th class="cemter-t">Fasilitas</th>
                                                   <th class="cemter-t">Area</th>
                                                   <th class="cemter-t">Jenis PM</th>
                                                   <th class="cemter-t">Action</th>
                                                </tr>
                                             </thead>
                                             <tbody id="Data-AP">
                                             </tbody>
                                          </table>
                                       </div>
                                       <div class="row"  id="data-pag-history">
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
                        <div class="row form-group" > 
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-2 col-form-label">All Check</label>
                                 <div class="col-sm-6">
                                    <label class="container">
                                       <input type="checkbox" class="check-form" onclick="checkUncheck(this)"><span class="checkmark"></span>
                                    </label>
                                 </div>
                              </div>
                     
                           </div>
                           <div class="col-md-12">
                              <div class="card-block scroll-data2">
                                 <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header" id="list_fasilitas_pm">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th>Menu Name</th>
                                             <th>Create </th>
                                             <th>Read </th>
                                             <th>Update </th>
                                             <th>Delete</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       </tbody>
                                    </table>
                                    
                                 </div>
                              </div>
                              
                           </div>
                           
                        </div>
                        <div class="row ">
                           <label class="col-sm-4 col-form-label">Pengawas Pekerjaan</label>
                              <div class="col-sm-8">
                                 <select class="js-example-basic-multiple js-states form-control" id="id_pengawas" name="id_pengawas" required style="width: 80%;">
                                    <option value=""></option>
                                    <?php foreach ($pengawas2 as $key => $value):?>
                                    <option value="<?=$value['nama']?>"><?=$value['nama']?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                        </div>
                     <div class="row ">
                           <label class="col-sm-4 col-form-label">Pelaksana Pekerjaan</label>
                              <div class="col-sm-8">
                                 <select class="js-example-basic-multiple js-states form-control" id="id_pelaksana" name="id_pelaksana[]" multiple="multiple" required style="width: 80%;">
                                    <option value=""></option>
                                    <?php foreach ($pelaksana as $pelaksana): ?>
                                    <option value="<?=$pelaksana['nama']?>"><?=$pelaksana['nama']?></option>
                                    <?php endforeach; ?>
                                 </select>
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
                           <label class="col-sm-4 col-form-label">Pengawas Pekerjaan</label>
                              <div class="col-sm-8">
                                 <select class="js-example-basic-multiple js-states form-control" id="id_pengawas_manual" name="id_pengawas_manual"  required style="width: 80%;">
                                    <option value=""></option>
                                    <?php foreach ($pengawas2 as $key => $value):?>
                                    <option value="<?=$value['nama']?>"><?=$value['nama']?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                        </div>
                        <div class="row ">
                           <label class="col-sm-4 col-form-label">Pelaksana Pekerjaan</label>
                              <div class="col-sm-8">
                                 <select class="js-example-basic-multiple js-states form-control" id="id_pelaksana_manual" name="id_pelaksana_manual[]" multiple="multiple" required style="width: 80%;">
                                    <option value=""></option>
                                    <?php foreach ($pelaksana2 as $key => $value):?>
                                    <option value="<?=$value['nama']?>"><?=$value['nama']?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                        </div>
                     
                        <div class="row ">
                              <label class="col-md-4 col-form-label"> Fasilitas</label>
                              <div class="col-md-8">
                                 <select class="form-control jenis select2Data" id="id_catagory" name="id_catagory">
                                    <option value=""></option>
                                 </select>
                              </div>
                        </div>
                        <div class="row ">
                              <label class="col-md-4 col-form-label"> Area</label>
                              <div class="col-md-8">
                                 <select class="form-control jenis select2Data" id="id_area" name="id_area">
                                    <option value=""></option>
                                 </select>
                              </div>
                        </div>
                        <div class="row ">
                              <label class="col-md-4 col-form-label"> Jenis Perangkat</label>
                              <div class="col-md-8">
                                 <select class="form-control jenis select2Data" id="id_jenisperangkat" name="id_jenisperangkat">
                                    <option value=""></option>
                                 </select>
                              </div>
                        </div>

                     
                           <div class="row form-group" id="list_fasilitas"> 
                           
                           </div>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label">Tanggal PM</label>
                           <div class="col-md-8">
                              <input type="date" class="form-control" name="tanggal_pm" id="tanggal_pm">
                           </div>
                           
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-md-4 col-form-label">Jam Mulai</label>
                                 <div class="col-md-8">
                                    <input type="time" class="form-control" name="jam_mulai_manual" id="jam_mulai_manual">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-md-4 col-form-label"> Sampai </label>
                                 <div class="col-md-8">
                                    <input type="time" class="form-control" name="jam_selesai_manual" id="jam_selesai_manual">
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

         $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
               theme: 'bootstrap',
               dropdownCssClass: 'select2-dropdown--scroll'
            });
         });

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
      

         
         GetArea();
         function FilterData(status){
            show();
            var typee = '';
            if (status !== 0) {
               typee = 1;  
            }
            var formData = new FormData();
            formData.append('limit',  $('#limitData').val());
            formData.append('tanggal',  $('#tanggal').val());
            formData.append('shift',  $('#shift').val());
            $.ajax({
               url: "<?=base_url()?>pm/LoadDataArea/"+typee,
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
                                 var addBtn  =`<a class="btn btn-primary" onclick="AddData('${valll['id_jadwalarea']}','${valll['idpm_type']}')"><i class="fa fa-file-excel-o "></i> Add PM</a>`;
                                 var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${valll['idpm_area']}')"><i class="feather icon-edit"></i></button>`;
                                 var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${valll['idpm_area']}','delete')"><i class="fa fa-trash"></i></button>`;
                                 var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${valll['idpm_area']}','proses')"><i class="fa fa-gear"></i></button>`;
                                 var prnBtn  = `<a href="<?=base_url()?>pm/PrintDataArea/${valll['idpm_area']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                                 var actBtn  = ``;
                                 if (valll['idpm_area'] == null) {
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
                                          <td class="cemter-t">`+valll['catagory']+`</td>
                                          <td class="cemter-t">`+valll['area']+`</td>
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
                        $('#tab-pm').addClass('active');
                        $('#tab-history').removeClass('active');
                        hide ();
                     }, error: function(){
                        hide ();
                     }
            });   
            return false;
         }

         function HistoryPM(id){
         
            var formData = new FormData();
            formData.append('limit',  $('#limitData').val());
            formData.append('tanggal',  $('#f_tanggal').val());
             var id =(id == null ? 0: id);
            show();
            $.ajax({
               url: "<?=base_url()?>pm/LoadHistoryArea/"+id,
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                        var json = JSON.parse(r);
                        var row = "";
                        var x= 1;
                        jQuery.each(json['data'], function( i, val ) {
                           var addBtn  =`<a class="btn btn-primary" onclick="AddData('${val['idpm_area']}','${val['id_fasilitas']}','${val['idpm_type']}')"><i class="fa fa-file-excel-o "></i> Add PM</a>`;
                           var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${val['idpm_area']}')"><i class="feather icon-edit"></i></button>`;
                           var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${val['idpm_area']}','delete')"><i class="fa fa-trash"></i></button>`;
                           var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${val['idpm_area']}','proses')"><i class="fa fa-gear"></i></button>`;
                           var prnBtn  = `<a href="<?=base_url()?>pm/PrintDataArea/${val['idpm_area']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                           var actBtn  = ``;
                        
                           if (val['status'] ==="0") {
                              actBtn=editBtn+prosBtn+delBtn;
                           }if (val['status'] === "1") {
                              actBtn=prnBtn;
                           }   
                        

                           row +=`<tr>
                                    <td class="cemter-t">${x}</td>
                                    <td class="cemter-t">${val['tanggal_pm_label']}</td>
                                    <td class="cemter-t">${val['catagory']}</td>
                                    <td class="cemter-t">${val['jenis_perangkat']}</td>
                                    <td class="cemter-t">${val['jenis_pm']}</td>
                                    <td class="cemter-t">
                                       ${actBtn}
                                    </td>
                                 </tr>`;
                                 x++;
                        });

                        $('#tabel-data-history > tbody:last-child').html(row);
                        $('#data-pag-history').html(json['pag']['label']);
                        $('#tab-history').addClass('active');
                        $('#tab-pm').removeClass('active');
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

         function AddData(idjadwal,idpm_type){
            $('#M-Form').modal('show');
            $('#M-Form').find('.modal-title').html('Upload File Dokumentasi PM');   
            $('#M-Form').find('form').attr('onsubmit','return SaveData(this,\''+idjadwal+'\',\''+idpm_type+'\')');
            $.ajax({
               url: "<?=base_url()?>pm/ListJobArea/"+idjadwal,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                  var json = JSON.parse(r);
                  var row ='';
                  var rowF ='';
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

                  jQuery.each(json['data']['list_fasilitas'], function( i, val ) {
                     var rowCount = i;
                              rowF +=` <tr>
                                          <td>
                                             <label>`+val['nama_fasilitas']+`</label>
                                          </td>
                                          <td>
                                             <label class="container">
                                                <input type="checkbox" class="check-form" name="newdata[`+rowCount+`][id_fasilitas]" value="${val['id_fasilitas']}" `+(val['val']==1 ? 'checked': '')+`>
                                                <span class="checkmark"></span>
                                             </label>
                                          </td>
                                       </tr>`;
                  });
               $('#list_fasilitas_pm').html(rowF);
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
               url: "<?=base_url()?>pm/EditDataArea/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                  var json = JSON.parse(r);
                  
                  $('#jam_mulai').val(json['data']['jam_mulai']);  
                  $('#jam_selesai').val(json['data']['jam_selesai']);  
                  
                  $('#id_pengawas').val(json['data']['pengawas']); // Select options with values '1' and '2'
                  $('#id_pengawas').trigger('change');
                  $('#id_pelaksana').val(json['data']['pelaksana']); // Select options with values '1' and '2'
                  $('#id_pelaksana').trigger('change');
                  
                  var row ='';
                  var rowF ='';
                  jQuery.each(json['data']['list_job'], function( i, val ) {
                     var inputForm='';
                  
                     if (val['dokumentasi'] !== '') {
                        inputForm=`
                        <div class="row">
                           <p class="text-muted col-md-10">${val['dokumentasi']}</p>
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

                  jQuery.each(json['data']['fasilitas'], function( i, val ) {
                     var rowCount = i;
                              rowF +=` <tr>
                                          <td>
                                             <label>`+val['nama_fasilitas']+`</label>
                                          </td>
                                          <td>
                                             <label class="container">
                                                <input type="checkbox" class="check-form" name="data[`+rowCount+`][id_fasilitas]" value="${val['id_fasilitas']}" `+(val['chec']==1 ? 'checked': '')+`>
                                                <span class="checkmark"></span>
                                             </label>
                                          </td>
                                       </tr>`;
                  });
                  
                  $('#list_fasilitas_pm').html(rowF);
               }, error: function(){
                  hide ();
               }
            });   
            return false;
         }
         function EditDataManual(id){
            
            $('#M-FormManual').modal('show');
            $('#M-FormManual').find('.modal-title').html('Upload File Dokumentasi PM');   
            $('#M-FormManual').find('form').attr('onsubmit','return UpdateDataManual(this,\''+id+'\')');
            $('#M-FormManual').find('#btn-action').html('Update');   
            $.ajax({
               url: "<?=base_url()?>pm/EditDataManualArea/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                  var json = JSON.parse(r);
               
                  var row ='';
                  jQuery.each(json['data']['list_job'], function( i, val ) {
                     var inputForm='';
                     if (val['dokumentasi'] !== '') {
                        inputForm=`
                        <div class="row">
                           <p class="text-muted col-md-10">${val['dokumentasi']}</p>
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

      function SaveData(f,idjadwal,idpm_type){
         // show();
         
            var formData = new FormData($(f)[0]);
         
               $.ajax({
               url: "<?=base_url('pm/SaveDataArea')?>/"+idjadwal+'/'+idpm_type,
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
               url: "<?=base_url('pm/UploadDataManualJenis')?>",
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                  // LoadFiles();
                   var json = JSON.parse(r);
                   NF(json);
                  HistoryPM('');
                  $('#M-FormManual').modal('hide');
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
                  
                     console.log(id);
                     $('#'+id).val(input.files[0].name);
                  
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
               url: "<?=base_url('pm/UpdateDataArea/')?>"+id,
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
               success: function(r){
                  var json = JSON.parse(r);
                  NF(json);
                  HistoryPM('');
                  $(f)[0].reset();
                  $('#M-Form').modal('hide');
               }, error: function(){
                  $('#M-Form').modal('hide');
                  $(f)[0].reset();
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
               url: '<?= base_url('pm/ProsesDataArea/') ?>' + id,
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
               url: '<?= base_url('pm/DeleteDataArea/') ?>' + id,
               type: 'post',
               contentType: false,
               processData: false,
               success: function(r){
                  var json = JSON.parse(r);
                  NF(json);
                  HistoryPM('');
               }, error: function(){
               hide();
               }
            });

         }

         $('body').on('change','.filter-data', function() {
            Tab();
         });
         
         

         function PrintData(){

         }
         
         
         LoadFasilits();
         function LoadFasilits(){
         
            show();
            $.ajax({
                  url: "<?=base_url()?>jenis_perangkat/ListJenisPerangkat",
                  type: 'post',
                  // data: formData,
                  contentType: false,
                  processData: false,

                  success: function(r){
                     var json = JSON.parse(r);
                     var row = "<option ></option>";
                     jQuery.each(json, function( i, val ) {
                     
                        row +=` <option value="`+val['id_jenisperangkat']+`">`+val['nama']+`</option>`;
                     });
                     
                  
                     $('#id_jenisperangkat').html(row);
                  
                  
                  }, error: function(){
                     
                  }
            });   
            return false;

         }

         $('body').on('change','#idpm_type', function() {
      
            if($(this).val() != ''){
               var id=$(this).val();
               var formData = new FormData();
               formData.append('jenis',  $('#id_jenisperangkat').val());
               formData.append('pm_type',  $('#idpm_type').val());
               $.ajax({
                  url: "<?=base_url()?>pm/ListJobJenis/"+id,
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
               HistoryPM('');
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

               window.history.pushState('', 'Title', 'PM_area');
            //  tab_content.eq(0).addClass('show active'); 
               //_education();
            }else if(li == 1){
               window.history.pushState('', 'Title', '?tab=history');
            //  tab_content. eq(1).addClass('show active');
               // _photo(); load jabatan
            }
         });
      
         function GetArea(){
               $.ajax({
                     url: "<?=base_url()?>fasilitas_catagory/LoadCatagory",
                     type: 'post',
                     // data: formData,
                     contentType: false,
                     processData: false,

                     success: function(r){
                        var json = JSON.parse(r);
                     
                        var row = ` <option value=""></option>`;
                        jQuery.each(json, function( i, val ) {

                           row +=`  <option value="`+val['id_catagory']+`">`+val['nama']+`</option>`;
                        });
                        $('#id_catagory').html(row);
                        console.log(row);
                        hide ();
                     }, error: function(){
                        hide ();
                     }
               });   
               return false;
            }

      $('body').on('change','#id_jenisperangkat', function() {
      
      if($(this).val() != ''){
         var id=$(this).val();
         var formData = new FormData();
         formData.append('jenis',  $('#id_jenisperangkat').val());
         formData.append('catagory',  $('#id_catagory').val());
         formData.append('area',  $('#id_area').val());
         $.ajax({
            url: "<?=base_url()?>fasilitas/FasilitasJenisperangkat/",
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               var row ='';
               jQuery.each(json, function( i, val ) {
                  var rowCount = i;
                  row +=` 
                              <div class ="col-md-4">
                                 <input type="checkbox" class="check-form" name="newdata[`+rowCount+`][id_fasilitas]" value="${val['id_fasilitas']}" `+(val['id_fasilitas']==1 ? 'checked': '')+`> ${val['nama_fasilitas']}
                              </div> 
                           `;
               });
               $('#list_fasilitas').html(row);
            }, error: function(){
               hide ();
            }
         });   
         
         
      }
      });


      $('body').on('change','#id_catagory', function() {
      
      if($(this).val() != ''){
      
         var formData = new FormData();
         formData.append('catagory',  $('#id_catagory').val());
         
         $.ajax({
                  url: "<?=base_url()?>area/GetListArea",
                  type: 'post',
                  data: formData,
                  contentType: false,
                  processData: false,

                  success: function(r){
                     var json = JSON.parse(r);
                     var row = "<option ></option>";
                     jQuery.each(json, function( i, val ) {
                     
                        row +=` <option value="`+val['id_area']+`">`+val['nama_area']+`</option>`;
                     });
                     
                  
                     $('#id_area').html(row);
                  
                  
                  }, error: function(){
                     
                  }
            });   
            return false;

      }
      });

      $('body').on('change','#id_area', function() {
      
      if($(this).val() != ''){
      
         var formData = new FormData();
         formData.append('catagory',  $('#id_catagory').val());
         formData.append('area',  $('#id_area').val());
         $.ajax({
                  url: "<?=base_url()?>jenis_perangkat/ListJenisPerangkat",
                  type: 'post',
                  data: formData,
                  contentType: false,
                  processData: false,

                  success: function(r){
                     var json = JSON.parse(r);
                     var row = "<option ></option>";
                     jQuery.each(json, function( i, val ) {
                     
                        row +=` <option value="`+val['id_jenisperangkat']+`">`+val['nama']+`</option>`;
                     });
                     
                  
                     $('#id_jenisperangkat').html(row);
                  
                  
                  }, error: function(){
                     
                  }
            });   
            return false;

      }
      });
         function checkUncheck(checkBox) {
            get = document.getElementsByClassName('check-form');
            for(var i=0; i<get.length; i++) {
               get[i].checked = checkBox.checked;
            }

         }
         
         
         $('body').on('change','.filter-pm', function() {
            FilterData(0);
         });
      </script>