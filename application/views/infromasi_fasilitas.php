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
                              <div class="col-md-6">
                                 <div class="card">
                                    <div class="card-body ">
                                       <div class="card-title text-center">
                                          <h5>Performansi Fasilitas</h5>
                                       </div>
                                       <div class="form-group row ">
                                          <div class="col-md-8 offset-md-2 text-center">
                                             <img id="foto" src="<?=base_url()?>./upload/icon-image-not-found-free-vector.jpg" width="150" height="150" alt="foto" onclick="previewImage()">
                                          </div>
                                       </div>
                                       <!-- Modal -->
                                       <div id="previewModal" class="modal">
                                          <div class="modal-content">
                                             <span class="close" onclick="closeModal()">&times;</span> <!-- Tombol close -->
                                             <img id="previewImg">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="nama_fasilitas" class="col-md-4 col-form-label">Nama Fasilitas <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="nama_fasilitas">-</span>
                                           
                                          
                                       </div>
                                       <div class="form-group row">
                                          <label for="kategori" class="col-md-4 col-form-label">Kategori <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="kategori">-</span>
                                       </div>
                                       <div class="form-group row">
                                          <label for="lokasi" class="col-md-4 col-form-label">Lokasi <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="lokasi"> -</span>
                                          
                                       </div>
                                       <div class="form-group row">
                                          <label for="sub_lokasi" class="col-md-4 col-form-label">Sub Lokasi  <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="sub_lokasi">-</span>
                                       </div>
                                       <div class="form-group row">
                                          <label for="ip" class="col-md-4 col-form-label">IP Address <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="ip"> -</span>
                                       </div>
                                       <div class="form-group row">
                                          <label for="status" class="col-md-4 col-form-label">Status <span class="left-margin" >:</span></label>
                                          <span class="col-md-8 f-w-700 col-form-label" id="status"> -</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                       <div class="card-title text-center ">
                                          <h5>Performansi Fasilitas</h5>
                                       </div>
                                       <div class="row">
                                          <div class="col-md12">
                                             <div id="data-perform" data-label="60%" class="radial-bar  radial-bar-ex-lg radial-bar-default"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="card">
                                    <div class="card-block">
                                       <div class="row" id="export">
                                          <div class="col-md-12">
                                          </div>
                                       </div>
                                       <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="dataTables_length" id="complex-dt_length">
                                                   <label>List Perangkat Terpasang</label>
                                                </div>
                                             </div>   
                                          </div>
                                          <div class="row">
                                             <div style="overflow-x:auto;" class="col-md-12">
                                                <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                                   <thead class="thead-blue">
                                                      <tr>
                                                         <th class="cemter-t">No</th>
                                                         <th class="cemter-t">Foto</th>
                                                         <!-- <th class="cemter-t">Nama Perangkat</th>
                                                            <th class="cemter-t">Kategori</th> -->
                                                         <th class="cemter-t">Jenis Perangkat</th>
                                                         <!-- <th class="cemter-t">IP Address</th> -->
                                                         <th class="cemter-t">Serial Number</th>
                                                         <th class="cemter-t">Merk</th>
                                                         <th class="cemter-t">Model</th>
                                                         <th class="cemter-t">Masa Garansi</th>
                                                         <!-- <th class="cemter-t">Kondisi Aset</th> -->
                                                         <th class="cemter-t">Last Maintenance</th>
                                                         <th class="cemter-t">Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody id="Data-AP">
                                                   </tbody>
                                                </table>
                                             </div>
                                             
                                          </div>
                                          <div class="row" id="data-pag">
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
                                       <h5>History Log Maintenance</h5>
                                    </div>
                                    <div class="card-block">
                                       <div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
                                          <div class="latest-update-box" id="dataLogHistory">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-7 col-md-6">
                                 <!-- Kartu kedua -->
                                 <div class="card">
                                    <!-- Konten kartu kedua -->
                                    <div class="card-header">
                                       <h5>Presentase Indikasi Kerusakan</h5>
                                    
                                    </div>
                                    <div class="card-block">
                                       <!-- Isi kartu kedua -->
                                       <!-- Tempat untuk grafik -->
                                       <div class="row" id="dataBar">
                                          
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
      </div>
      <script>
         FilterData();
         
         
         function FilterData() {
            // show();
            var formData = new FormData();
            // formData.append('limit',  $('#limitData').val());
            // formData.append('src',  $('#srcData').val());
            
           
            $.ajax({
               url: "<?=base_url()?>informasi/LoadDataAnl/"+<?=$id?>,
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
         
               success: function(r) {
                  var json = JSON.parse(r);
                  var row = "";
                  
                  var no =1;
                  //  script untuk menampilkan data pada label perform fasilitas
                  $('#nama_fasilitas').html((json['fasilitas']['nama_fasilitas'] ? json['fasilitas']['nama_fasilitas']: '') );
                  $('#kategori').html((json['fasilitas']['nama_unit'] ? json['fasilitas']['nama_unit']: '')  );
                  $('#lokasi').html((json['fasilitas']['terminal'] ? json['fasilitas']['terminal']: ''));
                  $('#sub_lokasi').html((json['fasilitas']['nama_sublokasi'] ? json['fasilitas']['nama_sublokasi']: '')); 
                  $('#ip').html((json['fasilitas']['ip_address'] ? json['fasilitas']['ip_address']: ''));
                  $('#status').html((json['fasilitas']['status'] ? json['fasilitas']['status']: ''));
                  jQuery.each(json['tabel-data'], function (i, val) {
                     var opt = "";
                     //  if (val['status_perangkat'] == 0) {
                     //      opt = `<a href="<?=base_url()?>/perangkat/performPerangkat/${val['id_perangkat']}"><button class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon" onclick="ViewDetail(${val['id_perangkat']})"><i class="feather icon-eye"></i></button></a>`;
                     //  } else {
                     //      opt = ``;
                     //  }
                     //  if(val['id_perangkat'] == '-2' || val['id_perangkat'] == '-1'){
                        
                     //    //console.log("asdasd");
                     //  }
                     opt = `<a href="<?=base_url()?>informasi/perangkat/${val['id_perangkat']}"><button class="btn waves-effect waves-light btn-primary btn-outline-primary btn-icon" ><i class="feather icon-eye"></i></button></a>`;
                     row += `<tr>
                                 <td>${no++}</td>
                                 <td>${val['foto'] || ''}</td>
                                 <td>${val['nama_jp'] || ''}</td>
                                 <td>${val['serial_number'] || ''}</td>
                                 <td>${val['merk_nama'] || ''}</td>   
                                 <td>${val['model'] || ''}</td>         
                                 <td>${val['masa_garansi'] || ''}</td>            
                                 <td>${val['update_date'] || ''}</td>   
                                 <td>
                                       <div class="btn-group" role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">
                                          ${opt}
                                       </div>
                                 </td>
                              </tr>`;
                  });
                  DataChart(json['perfomChart']);
                  DataProgress(json['ProgressData']);
                  HistoryLog(json['LogHistory']);
                  $('#tabel-data > tbody:last-child').html(row);
         
                 // hide();
               },
               error: function () {
                //  hide();
               }
            });
         return false;
         }
         function DataProgress(data) {
            var row = '';
            jQuery.each(data, function(i, val) {
               row += `<div class="col-xl-12 col-md-6 mb-10 mt-10">
                           <h5 class="m-b-10 f-w-500"><span class="text-c-black m-l-8" style="font-size: 15px;">` + val['name'] + `</span></h5>
                        
                           <div class="progress">
                                 <div class="progress-bar ` + val['class'] + `" style="width:` + val['value'] + `%"></div><span class="text-c-black m-l-10">` + val['value'] + `%</span>
                           </div>
                        </div>`;
            });
         
            $('#dataBar').html(row);
         }
         function HistoryLog(data) {
            var row='';
            if (data.length === 0) {
               
            // strValue was empty string, false, 0, null, undefined, ...
            row +=                 `<div class="row p-t-20 p-b-10">
                                       <div class="col-12 text-center"> <!-- Menggunakan class text-center -->
                                          <p class="text-muted m-b-0">Belum Ada History</p>
                                       </div>
                                    </div>`;
            
                        }else{   
                        
                                    jQuery.each(data, function( i, val ) {
                           
                           row +=`<div class="row p-t-20 p-b-10">
                                                   <div class="col-auto text-right update-meta p-r-0">
                                                   <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                   </div>
                                                   <div class="col p-l-5">
                                                      <a onclick="DetailLog()">
                                                         <h6>`+val['tittle']+` : `+val['nama_JP']+`</h6>
                                                      </a>
                                                      <p class="text-muted m-b-0">`+val['nama_masalah']+` fix setelah `+val['note']+`</p>
                                                      <small class="text-muted m-b-0">`+val['create_date']+` sampai `+val['end_date']+`</small>
                                                   </div>
                                                </div>`;
                                       });
                        
                        }         
                        $('#dataLogHistory').html(row);
            
            
         }
         
           // DataChart(100);
            
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
      </script>
   </body>
</html>