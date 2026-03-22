<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<style>
   .radial-bar-ex-lg {
    width: 300px;
    height: 300px;
    font-size: 55px;
   }
   .radial-bar-ex-lg:after, .radial-bar-ex-lg > img {
    width: 200px;
    height: 200px;
    margin-left: 50px;
    margin-top: 50px;
    line-height: 200px;
}
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
   .pt-10{
      margin-top: 20px;
      
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

         .b-yellow{
            border: 1px solid #ffb64d;
         }
         
   /* End Css modal  */
            .b-yellow{
            border: 1px solid #ffb64d;
         }

         .progress-wrapper {
               display: flex;
               align-items: center;
         }

         .progress-bar-wrapper {
            flex-grow: 1;
            margin-left: 10px; /* Menambahkan jarak antara label dan progress bar */
         }

         .progress-label {
            margin-right: 10px; /* Menambahkan jarak antara progress bar dan label */
         }
         .mb-10{
            margin-botton: 40px;
         }
         .mt-10{
            margin-top: 10px;
         }

         .mb-10{
            margin-botton: 40px;
         }

         .modal-content img {
            max-width: 20%; /* Mengatur lebar maksimum gambar menjadi 100% dari lebar modal */
            max-height: 30; /* Mengatur tinggi maksimum gambar agar sesuai dengan tinggi viewport */
            display: block; /* Memastikan gambar ditampilkan sebagai blok */
            margin: auto; /* Menengahkan gambar */
         }

         .close {
            position: absolute;
            top: 15px;
            right: 15px; /* Mengatur posisi tombol close ke pojok kanan atas */
            color: #ffffff; /* Warna teks tombol close */
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            z-index: 9999; /* Memastikan tombol close tampil di atas gambar */
         }
         .bt-0{
            margin-bottom: 0.0em;
         }
         .ct-l{
            line-height: 1;
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
         }
         .col-form-label{
            line-height: 1;
         }
         .pt-10{
            padding-top: 10px;
         }
         .pb-10{
            padding-bottom: 10px;
         }
</style>




<div id="cus-css">

</div>

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
            <!-- Tombol Kembali -->
            <a  onclick="window.history.go(-1); return false;" class="btn btn-primary float-right mb-3">
               <!-- Tambahkan mb-3 -->
               <i class="fas fa-arrow-left"></i> Kembali
            </a>
         </div>
      </div>
   </div>
</div>




<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-xl-5 col-md-6">
                  <div class="card">
					 <div class="card-header">
                        <h5>Detail Perangkat</h5>
                     </div>
                     <div class="card-body ">
                        <div class="row pt-10">
                           <div class="col-md-12">
                              <div class="form-group row bt-0">
                                 <label class="col-md-4 col-form-label">Serial Number</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="SN"></span>
                              </div>
                              <div class="form-group row bt-0">
                                 <label  class="col-md-4 col-form-label">Jenis</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="jenis"></span>
                              </div>
                              <div class="form-group row">
                                 <label  class="col-md-4 col-form-label">Merek</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="merek"></span>
                              </div>                              
							  <div class="form-group row">
                                 <label class="col-md-4 col-form-label">Model / Tipe</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="model"></span>
                              </div>
                              <div class="form-group row">
                                 <label  class="col-md-4 col-form-label">Garansi</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="garansi"></span>
                              </div>
                              <div class="form-group row">
                                 <label  class="col-md-4 col-form-label">Fasilitas</label>
                                 <span  class="col-md-8 f-w-700 ct-l" id="fasilitas"></span>
                              </div>
							  <div class="form-group row">
                                 <label  class="col-md-4 col-form-label">Status</label>
                                 <div class="col-md-8">
                                    <label id="status" class="label label-success">Digunakan</label>
                                 </div>
                              </div>
                           </div>
                        </div>
						<hr class="hr" />
                        <div class="row">
                           <div class="col-md-12" >
                              <div id="detail-perangkat"></div>

                           </div>
                        </div>                    
                     </div>
                  </div>
               </div>
               <!-- <div class="col-xl-7 col-md-6">
                  <div class="card" style="height: 435px;">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-title text-center ">
                           <h5>Performansi Perangkat</h5>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                           
                           
                           <div id="data-perform"  class="radial-bar  radial-bar-ex-lg radial-bar-default"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> -->
               <div class="col-xl-6 col-md-6">
                       

                        <div class="card" style="height: 435px;">
                           <div class="card-body d-flex flex-column align-items-center justify-content-center">
                              <div class="card-title text-center ">
                                 <h5>Performansi Perangkat</h5>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <input  data-width="210" data-height="210" data-min="0" data-max="100" class="knob" value="0" rel="80.1">
                               
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
            <div class="row">
               <div class="col-xl-5 col-md-6">
                  <div class="card latest-update-card">
                     <div class="card-header">
                        <h5>Maintenance Log Activity</h5>
                     </div>
                     <div class="card-block scroll-data">
                        <div class="scroll-widget">
                           <div class="latest-update-box" id="dataLogHistory">
                              <div class="row p-t-20 p-b-30">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-primary update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Devlopment & Update</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                 </div>
                              </div>
                              <div class="row p-b-30">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-primary update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Showcases</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                 </div>
                              </div>
                              <div class="row p-b-30">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-success update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Miscellaneous</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                 </div>
                              </div>
                              <div class="row p-b-30">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-danger update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Your Manager Posted.</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
                                 </div>
                              </div>
                              <div class="row p-b-30">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-primary update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Showcases</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-success update-icon ring"></i>
                                 </div>
                                 <div class="col p-l-5">
                                    <a href="#!">
                                       <h6>Miscellaneous</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-md-6">
                  <div class="card ">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-title text-center">
                           <h5>Persentase Jenis Kerusakan</h5>
                        </div>
                        <canvas id="myPie" width="295" height="295" ></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>








<!-- [ page content ] start -->

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url("assets") ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
<script src="<?=base_url()?>assets_v2/pages/chart/knob/jquery.knob.js"></script>      
<script src="<?=base_url()?>assets_v2/pages/chart/knob/knob-custom-chart.js"></script>
<script>
   var start = "";
   var end = "";
   
      function show () {
         $("#spinner").addClass("show");
      
      }
      function hide () {
         $("#spinner").removeClass("show");
      }
      FilterData(<?=$id?>);
    

   function FilterData(id) {
     show();
     var formData = new FormData();
      formData.append('filter_bulan',  $('#filter_bulan').val());
      formData.append('filter_tahun',  $('#filter_tahun').val());
  
      var id =(id == null ? 0: id);
      $.ajax({
         url: "<?=base_url()?>perangkat/LoadDataAnl/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,

         success: function(r) {
             var json = JSON.parse(r);
             var row = "";
            
             var no =1;
            
               $('#SN').html(" : "+json['perangkat']['serial_number']);
               $('#jenis').html(" : "+json['perangkat']['jenis_perangkat']);
               $('#garansi').html(" : "+"");
               $('#merek').html(" : "+json['perangkat']['merk']);
			      $('#model').html(" : "+"");
               $('#fasilitas').html(" : "+json['perangkat']['nama_fasilitas']);
               DetailPerangkat(json['perangkat']);
               DataChart(json['perfomChart']);
               DataPie(json['ProgressData']);
            
               HistoryLog(json['LogHistory']);
               // Tes();
             hide();
         },
         error: function() {
             hide();
         }
      });
     return false;
   }

   function DetailPerangkat(data){ 
      var row='';
      jQuery.each(data['detail'], function( i, val ) {
         row +=` <div class="form-group row bt-0">
                                 <label for="nama_fasilitas" class="col-md-4 col-form-label"> `+val['property_name']+`</label>
                                 <span  class="col-md-8 f-w-700 ct-l" > : `+val['nama']+`</span>
                  </div>`;
      });
      $('#detail-perangkat').html(row);
     
   }



   function DataChart2(data){
      data['Performa'] = 100;
      if (data['Performa'] == 100) {
         $("#data-perform").prop('style', ' background-image: linear-gradient(450deg, #e53935 50%, transparent 50%, transparent), linear-gradient(270deg, #e53935 50%, #d6d6d6 50%, #d6d6d6');
      }else if (data['Performa']>= 50) {
         var star = 255;
         var param = ( (data['Performa']- 45) * 3.5)+star;
        
         $("#data-perform").prop('style', ' background-image: linear-gradient('+param+'deg, #e53935 50%, transparent 50%, transparent), linear-gradient(270deg, #e53935 50%, #d6d6d6 50%, #d6d6d6');
      }else{
         var star = 90;
         var param = ( data['Performa'] * 3.5)+star;
         $("#data-perform").prop('style', 'background-image: linear-gradient(90deg, #d6d6d6 50%, transparent 50%, transparent), linear-gradient('+param+'deg, #FE8A7D 50%, #d6d6d6 50%, #d6d6d6)');
      }
      
      $('#data-perform').attr('data-label', data['Performa']+'%');
   }



   function DataPie(data){
      // console.log(data);
         var data = {
            labels: data['lebel'],
            datasets: [{
               data: data['value'],
               backgroundColor: data['color']
            }]
         };
         
         var options = {
               responsive: false,
               plugins: {
                  labels: {
                     render: 'percentage',
                     fontColor:'black',
                     precision: 2
                  }
               }
         };
      
         // Mendapatkan elemen canvas
                              
         var ctx = document.getElementById('myPie').getContext('2d');
                                 
         // Membuat chart lingkaran
         var myDoughnutChart = new Chart(ctx, {
               type: 'pie',
               data: data,
               options: options
         });
      }

   function HistoryLog(data) {
      var row='';
      jQuery.each(data, function( i, val ) {
         row +=`<div class="row p-t-20 p-b-30">
                  <div class="col-auto text-right update-meta p-r-0">
                     <i class="feather icon-briefcase bg-c-red update-icon"></i>
                  </div>
                  <div class="col p-l-5">
                     <a href="#!">
                        <h6>`+val['nama_masalah']+`</h6>
                     </a>
                     <p class="text-muted m-b-0">`+val['note']+`</p>
                     <small class="text-muted m-b-0">`+val['create_date']+`</small>
                  </div>
               </div>`;
         });
                  
      $('#dataLogHistory').html(row);
      
      
   }

  

$('body').on('change','#filter_bulan', function() {
   
   // FilterData(0);
   console.log($('#filter_bulan').val());
});

$('body').on('change','#filter_tahun', function() {
   
   // FilterData(0);
   console.log($('#filter_tahun').val());
});


function previewImage() {
    var modal = document.getElementById("previewModal");
    var img = document.getElementById("foto");
    var modalImg = document.getElementById("previewImg");

    modal.style.display = "block";
    modalImg.src = img.src;
}

function closeModal() {
    var modal = document.getElementById("previewModal");
    modal.style.display = "none";
}

// function DataChart(data){
//       data['Performa'] = 100;
//       if (data['Performa'] == 100) {
//          $("#data-perform").prop('style', ' background-image: linear-gradient(450deg, #e53935 50%, transparent 50%, transparent), linear-gradient(270deg, #e53935 50%, #d6d6d6 50%, #d6d6d6');
//       }else if (data['Performa']>= 50) {
//          var star = 255;
//          var param = ( (data['Performa']- 45) * 3.5)+star;
        
//          $("#data-perform").prop('style', ' background-image: linear-gradient('+param+'deg, #e53935 50%, transparent 50%, transparent), linear-gradient(270deg, #e53935 50%, #d6d6d6 50%, #d6d6d6');
//       }else{
//          var star = 90;
//          var param = ( data['Performa'] * 3.5)+star;
//          $("#data-perform").prop('style', 'background-image: linear-gradient(90deg, #d6d6d6 50%, transparent 50%, transparent), linear-gradient('+param+'deg, #FE8A7D 50%, #d6d6d6 50%, #d6d6d6)');
//       }
      
//       $('#data-perform').attr('data-label', data['Performa']+'%');
//    }
function DataChart(data){
 console.log(data);
   $(".knob").knob({
           'min':0,
           'max':100,
           'readOnly': true,
           'fgColorStart'  : data['color'],
           'fgColor1'      : data['color'],
           'fgColorEnd'    : data['color'],
           'format'        : function (value) {
               return value+"%";
           },
           'draw': function () {
               var v=parseInt($(this.i).val(),10);
               var cs=colorParse(this.o.fgColorStart); //Start color
               var c1=colorParse(this.o.fgColor1); //Stop1 color
               // var c2=colorParse(this.o.fgColor2); //Stop2 color
               var ce=colorParse(this.o.fgColorEnd); //End color
               var ends = new Array(new Color(cs[0],cs[1],cs[2]),
                                   new Color(c1[0],c1[1],c1[2]),
                                   // new Color(c2[0],c2[1],c2[2]),
                                   new Color(ce[0],ce[1],ce[2]));
               var steps = (this.o.max - this.o.min) / this.o.step;
             //   console.log(steps)
               var step = new Array(3);
               var color = mixPalette();
   
               this.o.fgColor=color;
               this.$.css({'color':color});
               function Color(r,g,b) {
                   this.r = r;
                   this.g = g;
                   this.b = b;
                   this.coll = new Array(r,g,b);
                   this.text = cText(this.coll);
               }
   
               function colorParse(c) {
                   c = c.toUpperCase();
                   col = c.replace(/[\#\(\)]*/i,'');
                   var num = new Array(col.substr(0,2),col.substr(2,2),col.substr(4,2));
                   var ret = new Array(parseInt(num[0],16),parseInt(num[1],16),parseInt(num[2],16));
                   return(ret);
               }
   
               function stepCalc(v) {
                   //console.log(v)
                   if(v < 50){
                   step[0] = (ends[1].r - ends[0].r) / steps /2;
                   step[1] = (ends[1].g - ends[0].g) / steps/2;
                   step[2] = (ends[1].b - ends[0].b) / steps/2;
                   }else if ( 50 <= v < 100) {
                   step[0] = (ends[2].r - ends[1].r) / steps / 2;
                   step[1] = (ends[2].g - ends[1].g) / steps / 2;
                   step[2] = (ends[2].b - ends[1].b) / steps /2;
                   }
               }
   
               function mixPalette() {
                   stepCalc(v);
                   var r = (ends[0].r + (step[0] * v));
                   var g = (ends[0].g + (step[1] * v));
                   var b = (ends[0].b + (step[2] * v));
                   var color = new Color(r,g,b);
                   return color.text;
                   //console.log(palette[i]);
               }
   
               function cText(c) {
                   var result = '';
                   for (k = 0; k < 3; k++) {
                   val = Math.round(c[k]/1);
                   piece = val.toString(16);
                   if (piece.length < 2) {piece = '0' + piece;}
                   result = result + piece;
                   }
                   result = '#' + result.toUpperCase();
                   return result;
               }
           }
       });
   
      $(".knob").each(function () {
        
           var $this = $(this);
         //   var myVal = $this.attr("rel");
         var myVal =data['Performa'];
         //   console.log(myVal);
          // console.log(myVal);
   
           $({
               value: 0
           }).animate({
   
               value: myVal
           }, {
               duration: 2000,
               easing: 'linear',
               step: function () {
                   $this.val(Math.ceil(this.value)).trigger('change');
   
               }
           })
   
      });
}
 

</script>

