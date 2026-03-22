<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Informasi Fasilitas</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="" />
      <meta name="keywords" content="">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/plugins/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/pages/waves/css/waves.min.css" media="all">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/icon/feather/css/feather.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/icon/themify-icons/themify-icons.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/icon/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/pages/prism/prism.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/css/widget.css">
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery/js/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/pages/chart/radial/css/radial.css">
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
         .center {
            text-align: center;
         }
         .ct-l {
            line-height: 1;
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
         }
         .form-group {
          margin-bottom: 0.50em;
         }
         .left-margin{
            float: right;
         }
         .spesifikasi{
            margin-bottom: 0;
            color: #333;
            font-size: 15px;
            font-weight: 700;
            display: inline-block;
            margin-right: 10px;
            line-height: 1.1;
            position: relative;
         }

         .spesifikasi:after {
            content: "";
            background-color: #d2d2d2;
            width: 60px;
            height: 1px;
            position: absolute;
            bottom: -5px;
            left: 0;
         }
      </style>
   </head>
   <body class="horizontal-icon">
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
            <div class="pcoded-main-container">
               <div class="pcoded-wrapper">
                  <div class="pcoded-content">
                     <div class="pcoded-inner-content">
                        <div class="main-body">
                           <div class="row">
                              <div class="col-xl-6 col-md-6">
                                 <div class="card">
                                    <div class="card-header">
                                       <h5>Informasi Perangkat  </h5>
                                    </div>
                                    <div class="card-body ">
                                       <div class="row pt-10">
                                          <div class="col-md-12">
                                             <div class="form-group row bt-0">
                                                <label for="SN" class="col-md-5 col-form-label"><span  >Serial Number</span> <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="SN">-</span>
                                             </div>
                                             <div class="form-group row bt-0">
                                                <label for="nama_fasilitas" class="col-md-5 col-form-label">Jenis <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="nama_fasilitas">-</span>
                                             </div>
                                             <div class="form-group row">
                                                <label for="nama_fasilitas" class="col-md-5 col-form-label">Merek <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="nama_fasilitas">-</span>
                                             </div>
                                             <div class="form-group row">
                                                <label for="nama_fasilitas" class="col-md-5 col-form-label">Model / Tipe    <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="nama_fasilitas">-</span>
                                             </div>
                                             <div class="form-group row">
                                                <label for="model" class="col-md-5 col-form-label">Garansi<span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="model">-</span>
                                             </div>
                                             <div class="form-group row">
                                                <label for="fasilitas" class="col-md-5 col-form-label">Fasilitas <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="fasilitas">-</span>
                                             </div>
                                             <div class="form-group row">
                                                <label for="status" class="col-md-5 col-form-label">Status <span class="left-margin" >:</span></label>
                                                <span class="col-md-7 f-w-700 col-form-label" id="status">-</span>
                                                
                                               
                                             </div>
                                          </div>
                                          
                                       </div>
                                       <hr class="hr" />
                                       <div class="row">
                                       <div class="col-md-12" >
                                          
                                          <h5 class="spesifikasi">Spesifikasi</h5>
                                             <div id="detail-perangkat"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-md-6">
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
                                       <canvas id="myPie" class="col-md-12"></canvas>
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
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery-slimscroll/js/jquery.slimscroll.js"></script>
      
      <script type="text/javascript" src="<?=base_url()?>assets_v2/js/jquery.slimscroll.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>

         $('.scroll-data').slimScroll({
            position: 'right',
            height: '500px',
            railVisible: true,
            alwaysVisible: false
         });
         FilterData();
         
         
         function FilterData() {
            
            var formData = new FormData();
            // formData.append('limit',  $('#limitData').val());
            // formData.append('src',  $('#srcData').val());
            
            $.ajax({
               url: "<?=base_url()?>informasi/LoadPerangkat/<?=$id?>",
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
         
               success: function(r) {
                  var json = JSON.parse(r);
                  var row = "";
                  
                  var no =1;
                  
                  //  script untuk menampilkan data pada l  $abel perform fasilitas
                  
                  
         
                     $('#SN').html(json['perangkat']['serial_number']);
                     $('#jenis').html(json['perangkat']['jenis_perangkat']);
                     $('#garansi').html();
                     $('#merek').html(json['perangkat']['merk']);
                     $('#model').html();
                     $('#fasilitas').html(json['perangkat']['nama_fasilitas']);
                     $('#status').html(json['perangkat']['status']);
                  
                     DetailPerangkat(json['perangkat']);
                     DataChart(json['perfomChart']);
                     DataPie(json['ProgressData']);
                    // DataProgress(json['ProgressData']);
                     HistoryLog(json['LogHistory']);
                     console.log(Object.keys(json['ProgressData']));
                  
               },
               error: function() {
                  
               }
            });
            
         return false;
         }
         
         function DetailPerangkat(data){ 
            var row='';
            jQuery.each(data['detail'], function( i, val ) {
               row +=` <div class="form-group row bt-0">
                        <label for="`+val['property_name']+`" class="col-md-5 col-form-label">`+val['property_name']+`<span class="left-margin" >:</span></label>
                        <span class="col-md-7 f-w-700 col-form-label" id="`+val['property_name']+`">`+val['nama']+`</span>
                     </div>`;
            });
            $('#detail-perangkat').html(row);
            
         }
         
         
         
         function DataChart(data){
            if (data['Performa']>= 50) {
               var star = 270;
               var param = ( (data['Performa']- 50) * 3.5)+star;
               $("#data-perform").prop('style', ' background-image: linear-gradient('+param+'deg, #e53935 50%, transparent 50%, transparent), linear-gradient(270deg, #e53935 50%, #d6d6d6 50%, #d6d6d6');
            }else{
               var star = 90;
               var param = ( data['Performa'] * 3.5)+star;
               $("#data-perform").prop('style', 'background-image: linear-gradient(90deg, #d6d6d6 50%, transparent 50%, transparent), linear-gradient('+param+'deg, #FE8A7D 50%, #d6d6d6 50%, #d6d6d6)');
            }
         
            $('#data-perform').attr('data-label', data['Performa']+'%');
         }
         
         
         function DataPie(data){
         
            var data = {
               labels: data['lebel'],
               datasets: [{
                  data: data['value'],
                  backgroundColor: data['color']
               }]
            };
         
                                    // Mengatur opsi chart
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
         
         
      </script>
   </body>
</html>