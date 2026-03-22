
<script type="text/javascript" src="<?=base_url()?>assets_v2/js/charts/loader.js"></script>  

 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-layers bg-c-blue"></i>
            <div class="d-inline">
               <h5><?=$title?></h5>
               <span><?=$title_des?></span>
            </div>
         </div>
      </div>
      <!-- <div class="col-lg-4">
         <div class="page-header-breadcrumb">
             <ul class=" breadcrumb breadcrumb-title breadcrumb-padding">
                 <li class="breadcrumb-item">
                     <a href="index.html"><i class="feather icon-home"></i></a>
                 </li>
                 <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                 <li class="breadcrumb-item"><a href="#!">Chart</a> </li>
             </ul>
         </div>
         </div> -->
   </div>
</div>
<!-- Header Card End -->
<!-- Inner Content Start -->
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <!-- <div class="col-xl-12">
                  <div class="card product-progress-card">
                     <div class="card-block">
                        <div class="row pp-main">
                           <div class="col-xl-4 col-md-6">
                              <div class="pp-cont">
                                 <div class="row align-items-center m-b-20">
                                    <div class="col-auto">
                                       <i class="fas fa-cube f-24 text-mute"></i>
                                    </div>
                                    <div class="col text-end">
                                       <h2 class="m-b-0 text-c-blue">2476</h2>
                                    </div>
                                 </div>
                                 <div class="row align-items-center m-b-15">
                                    <div class="col-auto">
                                       <p class="m-b-0">Total PM</p>
                                    </div>
                                    <div class="col text-end">
                                       <p class="m-b-0 text-c-blue"><i class="fas fa-long-arrow-alt-up m-r-10"></i>64%</p>
                                    </div>
                                 </div>
                                 <div class="progress">
                                    <div class="progress-bar bg-c-blue" style="width:45%"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 col-md-6">
                              <div class="pp-cont">
                                 <div class="row align-items-center m-b-20">
                                    <div class="col-auto">
                                       <i class="fas fa-tag f-24 text-mute"></i>
                                    </div>
                                    <div class="col text-end">
                                       <h2 class="m-b-0 text-c-red">843</h2>
                                    </div>
                                 </div>
                                 <div class="row align-items-center m-b-15">
                                    <div class="col-auto">
                                       <p class="m-b-0">Total CM</p>
                                    </div>
                                    <div class="col text-end">
                                       <p class="m-b-0 text-c-red"><i class="fas fa-long-arrow-alt-down m-r-10"></i>34%</p>
                                    </div>
                                 </div>
                                 <div class="progress">
                                    <div class="progress-bar bg-c-red" style="width:75%"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 col-md-6">
                              <div class="pp-cont">
                                 <div class="row align-items-center m-b-20">
                                    <div class="col-auto">
                                       <i class="fas fa-random f-24 text-mute"></i>
                                    </div>
                                    <div class="col text-end">
                                       <h2 class="m-b-0 text-c-yellow">63%</h2>
                                    </div>
                                 </div>
                                 <div class="row align-items-center m-b-15">
                                    <div class="col-auto">
                                       <p class="m-b-0">Fasilitas OFF</p>
                                    </div>
                                    <div class="col text-end">
                                       <p class="m-b-0 text-c-yellow"><i class="fas fa-long-arrow-alt-up m-r-10"></i>64%</p>
                                    </div>
                                 </div>
                                 <div class="progress">
                                    <div class="progress-bar bg-c-yellow" style="width:65%"></div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div> -->
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div id="bar_chart1" style="width:auto; height: 850px;"></div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card">
                           <div id="chart_fasilitas" style=" height: 300px;"></div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <!-- <div id="chart_div"></div> -->
                        <div class="card">
                           <div id="chart_perangkat" style=" height: 300px;"></div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <!-- <div id="chart_div"></div> -->
                        <div class="card">
                           <div class="card-body">
                              <div id="bar_chart" style=" height: 850px;"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <!-- <div id="chart_div"></div> -->
                     </div>
                     <div class="col-xl-12 col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h5 >Persentase Indikator Kerusakan</h5>
                           </div>
                           <div class="card-body">
                              <div class="chart-widget mb-2" id="indikator-jenis-perangkat">
                                 <div><label>Mini PC</label></div>
                                 <div class="progress mb-3" id="mini-pc-progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"></div>
                                 </div>
                                 <div><label>Listrik</label></div>
                                 <div class="progress mb-3" id="listrik-progress">
                                    <div class="progress-bar bg-c-red" role="progressbar" style="width: 0%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"></div>
                                 </div>
                                 <div><label>Jaringan</label></div>
                                 <div class="progress mb-3" id="jaringan-progress">
                                    <div class="progress-bar bg-c-yellow" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Indikator Kerusakan Fasilitas End -->
                  </div>
                  <div class ="row">
                     <div class="col-md-12">
                        <div class="row" id="sum_fasilitas">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-md-12">
                  <!-- Log Book Start -->
                  <!-- Log Book End -->
               </div>
            </div>
            <div class="row">
               <!-- Top 10 Fasilitas Start -->
               <div class="col-xl-6 col-md-6">
                  <div class="card table-card" >
                     <div class="card-header">
                        <h5>Top 10 Perbaikan Fasilitas </h5>
                     </div>
                     <div class="card-block scroll-data">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0 without-header">
                              <tbody id="top5Table">
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Top 10 Fasilitas End -->
               <!-- Top 10 Perangkat Start -->
               <div class="col-xl-6 col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Top 10 Perbaikan Perangkat </h5>
                     </div>
                     <div class="card-block scroll-data">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0 without-header">
                              <tbody id ="top5Divice">
                                 <tr>
                                    <td>
                                       <div class="d-inline-block align-middle">
                                          <img src="<?=base_url()?>assetx/assets/images/tv.jpg" alt="user image" class="img-tabs img-50 align-top m-r-15">
                                          <div class="d-inline-block">
                                             <h6>Monitor - SN000</h6>
                                             <p class="text-muted m-b-0"><?=sess()['unit_kode']?> Checkin 23</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td class="text-end">
                                       <h6 class="f-w-700">0</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-inline-block align-middle">
                                          <img src="<?=base_url()?>assetx/assets/images/fujitech.jpg" alt="user image" class="img-tabs img-50 align-top m-r-15">
                                          <div class="d-inline-block">
                                             <h6>Mini PC - SN000</h6>
                                             <p class="text-muted m-b-0"><?=sess()['unit_kode']?> General Checkin 1A</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td class="text-end">
                                       <h6 class="f-w-700">0</h6>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Top 10 Perangkat End -->
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="m-Vdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-6">
                        <div id="complex-dt_filter" class="dataTables_filter">
                           <label>Search:
                           <input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData">
                           <input type="hidden" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="vjenis">
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-condensed table-striped table-bordered" id="tabel-ViewDetail">
                           <thead class="thead-blue">
                              <tr>
                                 <th class="cemter-t">Nama Perangkat </th>
                                 <th class="cemter-t">SN</th>
                                 <th class="cemter-t">Merk</th>
                                 <th class="cemter-t">Tipe / Model</th>
                                 <th class="cemter-t">Status</th>
                                 <th class="cemter-t">Jenis Perangkat</th>
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
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script src="<?=base_url()?>assets_v2/pages/chart/knob/jquery.knob.js"></script>      
<script src="<?=base_url()?>assets_v2/pages/chart/knob/knob-custom-chart.js"></script>
<script src="<?=base_url()?>assets_v2/plugins/popper.js/js/popper.min.js"></script>
<script>


GetRekapPerfomanceUnit();
function GetRekapPerfomanceUnit(){
  
  $.ajax({
     url: "<?=base_url()?>dashboard/PerfomanceFasility/GetPerfomanceUnit",
     type: 'post',
     // data: formData,
     contentType: false,
     processData: false,
  
     success: function(r){
      var json = JSON.parse(r);
      GrafikPerfomanceUnit(json['data3']);
     }, error: function(){
        hide ();
     }
  });   
 return false;
}





function GrafikPerfomanceUnit(data){
   keys =Object.keys(data) ;
      if ($('#bar_chart1').length > 0) {

         option = {
        
            title: {
               text: 'Performance Unit ',
               subtext: 'Persentase Perfomance fasilitas'
            },
            legend: {},
            toolbox: {
               show: true,
               orient: 'vertical',
               left: 'right',
               top: 'center',
               feature: {
                  mark: { show: true },
                  dataView: { show: true, readOnly: false },
                  magicType: { show: true, type: ['line', 'bar', 'stack'] },
                  restore: { show: true },
                  saveAsImage: { show: true }
               }
            },
            tooltip: {
               trigger: 'axis'
            },
          
            grid: { containLabel: true },
            xAxis: {  type: 'value' },
            yAxis: { data: data.name},
             series:data.data
         };
         var dom =document.getElementById('bar_chart1')
         var eChart_1 = echarts.init(dom, 'light', {
            renderer: 'canvas',
            useDirtyRect: false
            }
         );
       
         eChart_1.setOption(option);
         eChart_1.resize();

         const img = new Image();

         // get the chart instance data as url
         img.src = eChart_1.getDataURL({
            type: 'png', // can be jpeg or png
            pixelRatio: 5, // image's ratio. default is 1
            backgroundColor: '#fff', // hex color defining the background of the chart
         });

         eChart_1.on('click', params => {
               
            // console.log(params.id_unit);
            window.open("<?=base_url('dashboard/perfomance/')?>"+params.seriesName+'/'+params.name);
         })
        
      }

   
}

function GetFasilityOFF(Catagory){
   $('#requestModalView').modal('show');
      $('#requestModalView').find('.modal-title').html('Temuan Fasilitas Bermasalah');   
    
   var formData = new FormData();
   formData.append('catagory', Catagory);
   $.ajax({
     url: "<?=base_url()?>dashboard/PerfomanceFasility/GetFasilityOFF",
     type: 'post',
     data: formData,
     contentType: false,
     processData: false,
     success: function(r){
      var json = JSON.parse(r);
      var row = "";
      jQuery.each(json['data'], function (i, val) {
         row += `<tr>
                        <td>${val['temuan_tanggal']}</td>
                        <td>${val['catagory'] || ''}</td>
                        <td>${val['nama_fasilitas'] || ''}</td>
                        <td style="word-wrap: break-word;">${val['temuan_keterangan'] || ''}</td>
                     </tr>`;
      });
   
      $('#tabel-perangkat > tbody:last-child').html(row);
     }, error: function(){
        hide ();
     }
   });   
   return false;
   
}
</script>