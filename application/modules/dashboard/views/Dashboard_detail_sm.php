<!-- Header Card Start -->
<style>
   .garis {
   text-decoration: underline;
   text-underline-offset: 10px;
   }
   .c-pm{
   display: block;
   padding-left: 20px;
   list-style-type: disclosure-closed;
   margin-bottom: 0;
   }
   ul {
   padding-top: 10px;
   }
   td {
   padding: 15px;
   border: 1px solid #ddd;
   text-align: left;
   word-wrap: break-word;
   }
   td, th {white-space: normal;}
</style>
<script type="text/javascript" src="<?=base_url()?>assets_v2/js/charts/loader.js"></script>  
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title" id="tespage">
            <i class="feather icon-layers bg-c-blue"></i>
            <div class="d-inline">
               <h5><?=$title?></h5>
               <span><?=$title_des?></span>
            </div>
         </div>
      </div>
    
   </div>
</div>
<!-- Header Card End -->
<!-- Inner Content Start -->
<div class="pcoded-inner-content">
<div class="main-body">
   <div class="page-wrapper">
      <div class="page-body">
         <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block">
                       
                           <div class="form-group col-md-3">
                              <label class="form-label">Tahun</label><br>
                              <select name="id_lokasi" class="select2 form-control"style="width: 100%" id="id_lokasi">
                                 <option value="" >All</option>
                                 <option value="1">Terminal 1</option>
                                 <option value="2">Terminal 2</option>
                                 <option value="3">Terminal 3</option>
                                 <option value="46">Non Terminal</option>
                                
                               
                              </select>
                           </div>
                           <?php if (empty(sess()['unit']) && empty(sess()['id_lokasi'])) :?>
                           <div class="form-group col-md-3">
                              <label class="form-label">Tahun</label><br>
                              <select name="id_unit" class="select2 form-control"style="width: 100%" id="id_unit">
                                 <option value="" >All</option>
                                 <?php foreach ($unit as $key => $value): ?>
                                    <option value="<?=$value['id_unit']?>"><?=$value['kode_unit']?></option>
                                 <?php endforeach;?>
                              </select>
                           </div>
                           <?php endif;?>
                        
                     </div>
                  </div>
               </div>
            </div>
         <div id="grafik">
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
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-condensed table-striped table-bordered" id="tabel-perangkat">
                     <thead>
                        <tr>
                           <th>Tanggal</th>
                           <th>Nama Fasilitas</th>
                           <th>Peralatan</th>
                           <th>Note</th>
                        </tr>
                     </thead>
                     <tbody id="new_perangkat"></tbody>
                  </table>
               </div>
               <!-- New input fields for pembuat dan nomor tiket -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="ViiewUmurPerangkat" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
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
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-condensed table-striped table-bordered" id="tabel-umurperangkat">
                     <thead>
                        <tr>
                            <th>No</th>
                             <th>Tanggal Penggunaan</th>
                           <th>Nama Fasilitas</th>
                           <th>Nama Perangkat</th>
                         
                           <th>SN</th>
                        </tr>
                     </thead>
                     <tbody id="new_perangkat"></tbody>
                  </table>
               </div>
               <!-- New input fields for pembuat dan nomor tiket -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
  $('body').on('change','#id_lokasi', function() {
      level2( );
   });
    $('body').on('change','#id_unit', function() {
      level2( );
   });
level2();
function level2(){
   var formData = new FormData();
    formData.append('lokasi', $('#id_lokasi').val());
    formData.append('unit', $('#id_unit').val());
    show();
  $.ajax({
     url: "<?=base_url()?>dashboard/PerfomanceFasility/perfomance_detail",
     type: 'post',
     data: formData,
     contentType: false,
     processData: false,
  
     success: function(r){
      
      var json = JSON.parse(r);
      //  drawStuffLv2(json)
      var grafik ='';
      jQuery.each(json, function( i, val ) {
         var bar= '';
         
        var headtable= "";
            jQuery.each(val['data'], function( ii, vall ) {
            var row='';
            var rowPerangkat='';
                
                  // drawBasic('grafik_bar_'+i+ii,vall['perfome'],val['name_unit'],vall['nama_terminal'],vall['id'],val['id_unit']); 
          
            
               jQuery.each( vall['perfome'] , function( iii, vall) {
                  row += `<tr >    
                        <td>`+(vall['nama']     == null ? '': vall['nama'])+`</td>
                        <td>`+(vall['ON']       == null ? '': vall['ON'])+`</td>
                        <td>`+(vall['OFF']      == null ? '': vall['OFF'])+`</td>
                        <td>`+(vall['total']    == null ? '': vall['total'])+`</td>
                     </tr>`;
               });
                 jQuery.each( vall['jenisPerangkat'] , function( iii, vall) {
                  rowPerangkat += `<tr >    
                        <td>`+(vall['nama']     == null ? '': vall['nama'])+`</td>
                        <td>`+(vall['total']       == null ? '': vall['total'])+`</td>
                       
                     </tr>`;
               });
               headtable +=`
              
               <div class="row">
                  <div class="col-xl-12 ">
                     <div class="card ">
                        <div class="card-block">
                           <h5>Rekapitulasi Kondisi Fasilitas ${val['kode_unit']}  ${vall['nama_terminal']}</h5>
                           <div class="table-responsive">
                              <table class="table table-condensed table-striped table-bordered" id="tabel-data${ii}">
                                 <thead class="thead-blue">
                                    <tr>
                                       <th class="cemter-t">Nama Fasilitas</th>
                                       <th class="cemter-t">Device ON</th>
                                       <th class="cemter-t">Device OFF</th>
                                       <th class="cemter-t">Total Device</th>
                                    </tr>
                                 </thead>
                                 <tbody >
                                    ${row}
                                 </tbody>
                              </table>
                           </div>
                        <h5>Rekapitulasi Perankat ${val['kode_unit']}  ${vall['nama_terminal']}</h5>
                           <div class="table-responsive">
                              <table style="width:50%" class="table table-condensed table-striped table-bordered" id="tabel-dataPerangkat${ii}">
                                 <thead class="thead-blue">
                                    <tr>
                                       <th class="cemter-t">Jenis Perangkat</th>
                                       <th class="cemter-t">Total</th>
                                     
                                    </tr>
                                 </thead>
                                 <tbody >
                                    ${rowPerangkat}
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 ">
                     <div class="card ">
                        <div class="card-block">
                           
                           <div id="barUmur_${i}${ii}" style=" height: 450px;"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-7">
                     <div class="card">
                        <div class="card-body">
                           <div id="grafik_bar_${i}${ii}" style=" height: 500px;"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="card">
                        <div class="card-body">
                           <div id="grafik_don_${i}${ii}" style=" height: 500px;"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>
               `;
              
            });
       
         grafik +=`  ${headtable}  
              `;
            
      });
      
      $('#grafik').html(grafik);
      jQuery.each(json, function( i, val ) {
         jQuery.each(val['data'], function( ii, vall ) {
               
               ChartBar('grafik_bar_'+i+ii,vall['perfome'],vall['nama_terminal'],vall['id'],val['id_unit'],val['warna']); 
               BarUmur('barUmur_'+i+ii,vall['umur'],vall['nama_terminal'],vall['id'],val['id_unit'],val['warna']); 
              ChartPie('grafik_don_'+i+ii,vall['total_perfome']);
            });
      });
      hide ();
     }, error: function(){
        hide ();
     }
  });   
 return false;
}


function GetOffFasility(idterminal,idCatagory,idUnit){
   show();
   $('#requestModalView').modal('show');
   $('#requestModalView').find('.modal-title').html('List Perangkat OFF');   
    
   var formData = new FormData();
   formData.append('terminal', idterminal);
   formData.append('catagory', idCatagory);
   formData.append('unit', idUnit);
   $.ajax({
     url: "<?=base_url()?>dashboard/PerfomanceFasility/GetOffFasility",
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
      hide ();
     }, error: function(){
        hide ();
     }
   });   
   return false;
   
}

function ChartBar(id,data,terminal){
 
   if ($('#'+id).length > 0) {
      const dataY = data.map(function (item) {
         return item['nama'];
      });
      const dataOn = data.map(function (item) {
         return item['perfome'];
      });
      const dataOff = data.map(function (item) {
         return item['perfomeOff'];
      });
      const NilaiOn = data.map(function (item) {
         return item['ON'];
      });
      const NilaiOff = data.map(function (item) {
         return item['OFF'];
      });
    
         option = {
             title: {
               text: 'Performance Unit '+terminal,
               subtext: 'Persentase Perfomance fasilitas '+terminal
            },
         tooltip: {
            trigger: 'axis',
            axisPointer: {
               type: 'shadow' // 'shadow' as default; can also be 'line' or 'shadow'
            }
         },
         legend: {},
         grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            top: '3%',
            containLabel: true
         },
         xAxis: {
            type: 'value'
         },
         yAxis: {
            type: 'category',
            data: dataY
         },
         series: [
            {
               name: 'ON',
               type: 'bar',
               stack: 'total',
               label: {
                  show: true,
                  formatter:NilaiOn
               },
              
               encode: {
                  x: dataOn,
                  y: 'product'
               },
               emphasis: {
                  focus: 'series'
               },
               data: dataOn,
               id :data
            },
            {
               name: 'OFF',
               type: 'bar',
               stack: 'total',
               label: {
                  show: true
               },
               emphasis: {
                  focus: 'series'
               },
               data: dataOff
            }
         ]
         };
         var dom =document.getElementById(id)
         var eChart_1 = echarts.init(dom, 'light', {
            renderer: 'canvas',
            useDirtyRect: false
            }
         );
       
         eChart_1.setOption(option);
         eChart_1.resize();

         const img = new Image();
            eChart_1.on('click', params => {
         
            var id = params.dataIndex;
           
               GetOffFasility(data[id]['id_lokasi'],data[id]['id_catagory'],data[id]['id_unit']);
            })
        
         img.src = eChart_1.getDataURL({
            type: 'png', // can be jpeg or png
            pixelRatio: 5, // image's ratio. default is 1
            backgroundColor: '#fff', // hex color defining the background of the chart
         });

   }
}

function BarUmur(id,data,terminal){
 
   if ($('#'+id).length > 0) {
      const dataX = data.map(function (item) {
         return item['tahun'];
      });
      const dataJumlah = data.map(function (item) {
         return item['jumlah'];
      });
     
  
         option = {
             title: {
               text: 'Rekapitulasi Umur Perangkat '+terminal,
               subtext: 'Persentase Perfomance fasilitas'
            },
         tooltip: {
            trigger: 'axis',
            axisPointer: {
               type: 'shadow' // 'shadow' as default; can also be 'line' or 'shadow'
            }
         },
         legend: {},
         grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
         },
         xAxis: {
            type: 'category',
            data: dataX
         },
         yAxis: {
            type: 'value'
         },
          
         series: [
            {
               data: dataJumlah,
               type: 'bar',
               showBackground: true,
               backgroundStyle: {
               color: 'rgba(180, 180, 180, 0.2)',
                 id :data
               }
            }
         ]
         };
         var dom =document.getElementById(id);
         var eChart_1 = echarts.init(dom, 'light', {
            renderer: 'canvas',
            useDirtyRect: false
            }
         );
       
         eChart_1.setOption(option);
         eChart_1.resize();

         const img = new Image();
            eChart_1.on('click', params => {
         
            var id = params.dataIndex;
          
               ListFasilitas(data[id]['id_lokasi'],data[id]['tahun'],data[id]['id_unit']);
               //GetOffFasility(data[id]['id_lokasi'],data[id]['id_catagory'],data[id]['id_unit']);
            })
        
         img.src = eChart_1.getDataURL({
            type: 'png', // can be jpeg or png
            pixelRatio: 5, // image's ratio. default is 1
            backgroundColor: '#fff', // hex color defining the background of the chart
         });

   }
}

function ChartPie(id,data){
   console.log(data);
   if ($('#'+id).length > 0) {
     
      option = {
         series: [
            {
               type: 'gauge',
               progress: {
               show: true,
               width: 18
               },
               axisLine: {
               lineStyle: {
                  width: 18,
                  color: [
                     [0.25, '#FF6E76'],
                     [0.5, '#FDDD60'],
                     [0.75, '#58D9F9'],
                     [1, '#7CFFB2']
                  ]
               }
               },
               axisTick: {
               show: false
               },
               splitLine: {
               length: 15,
               lineStyle: {
                  width: 2,
                  color: '#999'
               }
               },
               axisLabel: {
               color: '#464646',
               fontSize: 14,
               distance: 25
               },
               anchor: {
               show: true,
               showAbove: true,
               size: 15,
               itemStyle: {
                  borderWidth: 1
               }
               },
               title: {
               show: false
               },

               detail: {
               fontSize: 40,
               offsetCenter: [0, '70%'],
               valueAnimation: true,
               formatter: function (value) {
                  return Math.round(value) + '%';
               },
               color: '#000'
               },
               data: [
               {
                  value: data['Performa']
               }
               ]
            }
         ]
      };

         var dom =document.getElementById(id);
       
         var eChart_dom = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
            }
         );
         eChart_dom.setOption(option);
         eChart_dom.resize();


   }
  
  
}



function ListFasilitas(idterminal,tahun,idUnit){
   show();
   $('#ViiewUmurPerangkat').modal('show');
   $('#ViiewUmurPerangkat').find('.modal-title').html('List Umur Perangkat');   
    
   var formData = new FormData();
   formData.append('terminal', idterminal);
   formData.append('tahun', tahun);
   formData.append('unit', idUnit);
   $.ajax({
     url: "<?=base_url()?>dashboard/PerfomanceFasility/GetDetailUmur",
     type: 'post',
     data: formData,
     contentType: false,
     processData: false,
     success: function(r){
      var json = JSON.parse(r);
      var row = "";
      var no= 1;
      jQuery.each(json, function (i, val) {
         row += `<tr>
                        <td>${no++}</td>
                        <td>${val['tanggal_penggunaan'] || ''}</td>
                        <td>${val['nama_fasilitas']}</td>
                        <td>${val['nama_perangkat'] || ''}</td>
                        <td>${val['serial_number'] || ''}</td>
                      
                     </tr>`;
      });
   
      $('#tabel-umurperangkat > tbody:last-child').html(row);
      hide ();
     }, error: function(){
        hide ();
     }
   });   
   return false;
   
}
</script>