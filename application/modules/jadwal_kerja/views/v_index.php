
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

    /* css upload */


.image_picker {
    height: 150px;
    width: 100%;
    border: 1px #ddd solid;
    border-radius: 0px;
    background: #f5f5f5;
    text-align: center;
    display: table;
    color: #999;
    transition: .3s;
}
.image_picker i {
    font-size: 40px;
}
.image_picker div {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.d-none {
    display: none!important;
}

/* end css upload */

.dropdown-item {
    display: block;
    width: 100%;
    padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);
    clear: both;
    font-weight: 400;
    color: var(--bs-dropdown-link-color);
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    border-radius: var(--bs-dropdown-item-border-radius, 0);
    padding: 10px 15px;
}

.dropdown-menu {
    --bs-dropdown-zindex: 1026;
    --bs-dropdown-min-width: 12rem;
    --bs-dropdown-padding-x: .5rem;
    --bs-dropdown-padding-y: .5rem;
    --bs-dropdown-spacer: .125rem;
    --bs-dropdown-font-size: .875rem;
    --bs-dropdown-color: #888;
    --bs-dropdown-bg: #ffffff;
    --bs-dropdown-border-color: rgba(0, 0, 0, .15);
    --bs-dropdown-border-radius: var(--bs-border-width);
    --bs-dropdown-border-width: 0;
    --bs-dropdown-inner-border-radius: calc(var(--bs-border-width) - 0);
    --bs-dropdown-divider-bg: #f3f5f7;
    --bs-dropdown-divider-margin-y: .5rem;
    --bs-dropdown-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .175);
    --bs-dropdown-link-color: #888;
    --bs-dropdown-link-hover-color: var(--bs-dropdown-link-color);
    --bs-dropdown-link-hover-bg: #f3f5f7;
    --bs-dropdown-link-active-color: var(--bs-dropdown-link-color);
    --bs-dropdown-link-active-bg: var(--pc-active-background);
    --bs-dropdown-link-disabled-color: #5b6b79;
    --bs-dropdown-item-padding-x: .95rem;
    --bs-dropdown-item-padding-y: .65rem;
    --bs-dropdown-header-color: #5b6b79;
    --bs-dropdown-header-padding-x: .95rem;
    --bs-dropdown-header-padding-y: .5rem;
    position: absolute;
    z-index: var(--bs-dropdown-zindex);
    display: none;
    min-width: var(--bs-dropdown-min-width);
    padding: var(--bs-dropdown-padding-y) var(--bs-dropdown-padding-x);
    margin: 0;
    font-size: var(--bs-dropdown-font-size);
    color: var(--bs-dropdown-color);
    text-align: left;
    list-style: none;
    background-color: var(--bs-dropdown-bg);
    background-clip: padding-box;
    border: var(--bs-dropdown-border-width) solid var(--bs-dropdown-border-color);
    border-radius: var(--bs-dropdown-border-radius);
}
</style>
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
                                       Bulan 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm filter-data" id="filter_bulan">
                                            <option ></option>
                                            <?php for ($x = 1; $x <= 12; $x++) : ?>
                                              <option value="<?=$x?>"><?=Fmonth($x)?></option>
                                            <?php endfor?>
                                       </select>
                                     
                                    </label>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-5 col-sm-5 col-md-3">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <label>
                                       Tahun 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm filter-data" id="filter_tahun">
                                          <?php
                                             $y= (date("Y")-1);
                                            for ($x = 0; $x <=5; $x++) { ?>
                                         <option value="<?=$x+ $y?>"><?=$x+ $y?></option>
                                         <?php }?>
                                       </select>
                                     
                                    </label>
                                 </div>
                              </div>
                              
                              <div class="col-xs-12 col-sm-12 col-md-4">
                                 <div id="complex-dt_filter" class="dataTables_filter">
                                    <div class="pull-right putih mb-10">
                                        <div class="dropdown">
                                            <button class="btn btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">Dowload Data
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li><a href="#" onclick="FormatEsikap()" class="dropdown-item">Esikap</a></li>
                                              <li><a href="#" onclick="FormatTalend()" class="dropdown-item">Talend</a></li>
                                            </ul>
                                        </div>
                                     
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-2">
                                 <div id="complex-dt_filter" class="dataTables_filter">
                                    <div class="pull-right putih mb-10">
                                        
                                        </div>
                                       <a class="btn btn-primary" onclick="Upload()"><i class="fa fa-file-excel-o "></i> Upload</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                       <thead class="thead-blue" id="table-head-tgl">
                                          <tr>
                                             <th class="cemter-t">NIK</th>
                                             <th class="cemter-t">Nama</th>
                                           
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


<div class="modal fade" id="m-uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Menambahkan File Loader</h5>
         </div>
         <form onsubmit="return UploaderData(this)">
            <div class="modal-body p-0">
              
               
               <input id="inputFile" name="filelampiran" type="file" class="d-none" onchange="setUploader(this)" accept=".xls,.xlsx"/>
               <div class="p-4" id="input_group">
                 
                  <div class="row mt-s">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label" >Bulan</label>
                           <div class="col-sm-10">
                                 <select class="form-control" name="bulan" id="bulan">
                                 <option ></option>
                                    <?php 
                                    for ($x = 1; $x <= 12; $x++) {
                                    
                                    ?>
                                      <option value="<?=$x?>"><?=Fmonth($x)?></option>
                                    <?php 
                                     }
                                    ?>
                                 </select>
                              
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label" >Unit</label>
                           <div class="col-sm-10">
                                 <select class="form-control" name="id_unit" id="id_unit">
                                    
                                 </select>
                              
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="row">
                       
                           <label class="col-sm-2 control-label">File</label>
                           <div class="col-sm-8">
                              <input type="text" readonly class="form-control" placeholder="File" id="name_file"> 
                              <div class="btn-group mt-s ">
                                 <button type="button" onclick="$('#inputFile').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                 <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
                                 <a onclick="DownloadFormat()" > <span class="sm-hide">Download Format </span></a>
                              </div>
                           </div>
                        
                        </div>
                        
                     </div>
                     
                     <br>
                  </div>
                 
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

<script>
   var start = "";
   var end = "";
   
      function show () {
         $("#spinner").addClass("show");
      
      }
      function hide () {
         $("#spinner").removeClass("show");
      }
      FilterData();
     $('body').on('change','.filter-data', function() {
      FilterData();
   });
    function FilterData(){
    show();
    var formData = new FormData();
         formData.append('bulan',  $('#filter_bulan').val());
         formData.append('tahun',  $('#filter_tahun').val());
    $.ajax({
        url: "<?=base_url()?>jadwal_kerja/LoadData",
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,

        success: function(r){
            var json = JSON.parse(r);

            // ====== HEADER ======
            var thead = `
                <tr>
                    <th class="cemter-t">NIK</th>
                    <th class="cemter-t">Nama</th>
            `;

            for (let i = 1; i <= json['max_date']; i++) {
                thead += `<th class="cemter-t">${i}/${json['my']}</th>`;
            }
            thead += `</tr>`;

            // ====== BODY ======
            var tbody = "";

            jQuery.each(json['om'], function(i, val){

                // --- buat map tanggal → shift ---
                let mapShift = {}; 
                jQuery.each(val['absen'], function(ii, vall){
                    mapShift[vall['tgl_a']] = vall['shift'];
                });

                tbody += `<tr>
                    <td>${val['nik']}</td>
                    <td>${val['nama']}</td>
                `;

                // --- looping tanggal ---
                for (let tgl = 1; tgl <= json['max_date']; tgl++) {
                    let isi = mapShift[tgl] ? mapShift[tgl] : "-";
                    tbody += `<td>${isi}</td>`;
                }

                tbody += `</tr>`;
            });

            // OUTPUT
            $('#table-head-tgl').html(thead);
            $('#tabel-data > tbody').html(tbody);

            hide();
        },
        error: function(){
            hide();
        }
    });

    return false;
}

    
   
  
    
    function CekIP(){
      $.ajax({
         url:  '<?=base_url('jadwal_kerja/')?>CekIp/',
         type: 'post',
         // data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            // CekIP();
            // setInterval(CekIP(), 100000);
         
         }, error: function(){
          
         }
      });
      return false;
    }
    
  

    function LoadUnit(){

         $.ajax({
               url: "<?=base_url()?>unit/ListData",
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  var json = JSON.parse(r);
                  var row = "";
                  jQuery.each(json, function( i, val ) {
                     
                     row +=`<option value="`+val['id_unit']+`">`+val['kode_unit']+`</option>`;
                  });
               
                  $('#id_unit').html(row);
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }
    function Upload(){
      // show();
      $('#m-uploader').modal('show');
      $('#m-uploader').find('.modal-title').html('Upload Jadwal Dinas');   
      $('#m-uploader').find('form').attr('onsubmit','return UploadData(this)');
      LoadUnit();

   }

  
   function UploadData(f){
      show();
      var formData = new FormData($(f)[0]);
      $.ajax({
         url:  '<?=base_url('jadwal_kerja/')?>UploadData/',
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function remove_photo(){
      $dropzone.fadeIn(300); $('#input_group').hide(0); $('input:file').val('');
      file_exist = false; $('.part-1').addClass('dizabled');
   }

var $dropzone = $('.image_picker'),
          $dropinput = $('#inputFile'),
          $dropimg = $('.image_preview');

      $dropzone.on('dragover', function() {
        $dropzone.addClass('dropping');
        return false;
      }).on('dragend dragleave', function() {
        $dropzone.removeClass('dropping');
        return false;
      });
   // var confirm = document.getElementById("confirm");
   function Delete(id){
      cuteAlert({
         type: "question",
         title: "Confirm Title",
         message: "Confirm Message",
         confirmText: "Okay",
         cancelText: "Cancel"
      }).then((e)=>{
       
         if ( e == ("confirm")){
           
            DeleteAki(id);
         } 
      });
   }

   function setUploader(input){
        if (!window.FileReader) {
          alert('Browser yang Anda gunakan tidak support fitur ini.');
        }else{
          if(input.files && input.files[0]){
            if(input.files[0].type.match('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')){
                  $dropzone.hide(); $('#input_group').show(300);
                $dropzone.removeClass('dropping');
                $('.dizabled').removeClass('dizabled');

                var reader = new FileReader();
                reader.onload = function(event){
                  file_data = event.target.result;
                  $dropimg.css('background-image', 'url(' + event.target.result + ')');

                  reader.src = event.target.result;
                };
                
                $('#name_file').val(input.files[0].name);
               //  $('#m-uploader').find('input:text').val(input.files[0].name);
                reader.readAsDataURL(input.files[0]);

                file_exist = false;
            }else{
              alert("Format file tidak valid"+input.files[0].type);
            }
           
          }
        }

   }

   function DownloadFormat(){
      var bulan =$('#bulan').val();
    
      if (bulan =='') {
         alert('Silahkan Pilih bulan');
      }else{
          $.ajax({
         url: "<?=base_url()?>jadwal_kerja/DownloadFormat/"+bulan,
         type: 'post',
         success: function(r){
        
            var json = JSON.parse(r);
                if (json['STATUS'] !=200) {
               // console.log("<?=base_url()?>"+json['PATH']);
               window.open("<?=base_url()?>"+json['PATH'], "_blank");
            }
         },
         error: function(){
               hide();
         }
      });
      return false;

         // var json = JSON.parse(r);
         //        if (json['STATUS'] !=200) {
         //       // console.log("<?=base_url()?>"+json['PATH']);
         //       window.open("<?=base_url()?>"+json['PATH'], "_blank");
         // }
         // window.open("<?=base_url('jadwal_kerja/DownloadFormat/')?>"+bulan)
      }
     
   }
   
   
//   function FormatEsikap(){
//       show();
//      var bulan =$('#filter_bulan').val();
//      var tahun =$('#filter_tahun').val();
     
//       var formData = new FormData();
//          formData.append('bulan',  $('#filter_bulan').val());
//          formData.append('tahun',  $('#filter_tahun').val());
//         $.ajax({
//              url: "<?=base_url()?>jadwal_kerja/FormatEsikap",
//              type: 'post',
//              success: function(r){
            
//                 var json = JSON.parse(r);
//                     if (json['STATUS'] !=200) {
//                   // console.log("<?=base_url()?>"+json['PATH']);
//                   window.open("<?=base_url()?>"+json['PATH'], "_blank");
//                 }
//              },
//              error: function(){
//                   hide();
//              }
//         });
//         return false;

//   }
   
   
   
//   function FormatTalend(){
//         show();
//         var bulan =$('#filter_bulan').val();
//         var tahun =$('#filter_tahun').val();
     
//         var formData = new FormData();
//         formData.append('bulan',  $('#filter_bulan').val());
//         formData.append('tahun',  $('#filter_tahun').val());
         
//         $.ajax({
//             url: "<?=base_url()?>jadwal_kerja/FormatTalend",
//             type: 'post',
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(r){
//                 var json = JSON.parse(r);
//                     if (json['STATUS'] !=200) {
//                   // console.log("<?=base_url()?>"+json['PATH']);
//                   window.open("<?=base_url()?>"+json['PATH'], "_blank");
//                 }
//             },
//             error: function(){
//                   hide();
//             }
//         });
//       return false;

     
     
//   }
   
   
   
   function FormatTalend(){
    show();
    var formData = new FormData();
         formData.append('bulan',  $('#filter_bulan').val());
         formData.append('tahun',  $('#filter_tahun').val());
    $.ajax({
        url: "<?=base_url()?>jadwal_kerja/FormatTalend",
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,

        success: function(r){
            var json = JSON.parse(r);
  var json = JSON.parse(r);
                    if (json['STATUS'] !=200) {
                  // console.log("<?=base_url()?>"+json['PATH']);
                  window.open("<?=base_url()?>"+json['PATH'], "_blank");
                }
            hide();
        },
        error: function(){
            hide();
        }
    });

    return false;
}


function FormatEsikap(){
    show();
    var formData = new FormData();
         formData.append('bulan',  $('#filter_bulan').val());
         formData.append('tahun',  $('#filter_tahun').val());
    $.ajax({
        url: "<?=base_url()?>jadwal_kerja/FormatEsikap",
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,

        success: function(r){
             var json = JSON.parse(r);
                    if (json['STATUS'] !=200) {
                  // console.log("<?=base_url()?>"+json['PATH']);
                  window.open("<?=base_url()?>"+json['PATH'], "_blank");
                }
            hide();
        },
        error: function(){
            hide();
        }
    });

    return false;
}
</script>