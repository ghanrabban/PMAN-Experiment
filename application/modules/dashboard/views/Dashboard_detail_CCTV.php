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
   
.kpi-card{
   padding:15px;
   text-align:center;
   border-radius:8px;
   box-shadow:0 2px 6px rgba(0,0,0,.08);
}
.kpi-title{
   font-size:13px;
   color:#666;
}
.kpi-value{
   font-size:26px;
   font-weight:700;
}

.kpi-on{ background:#e8f7ee; color:#2e7d32; }
.kpi-off{ background:#fdecea; color:#c62828; }
.kpi-critical{ background:#fff3e0; color:#ef6c00; }

/* Performance Color */
.kpi-good{ color:#2e7d32; }
.kpi-warning{ color:#f9a825; }
.kpi-bad{ color:#c62828; }

/* ===============================
   KPI TOOLTIP STYLE
================================ */

.tooltip-inner {
   max-width: 280px;
   text-align: left;
   font-size: 13px;
   line-height: 1.5;
   padding: 12px 14px;
   background-color: #1f2937; /* dark slate */
   color: #fff;
   border-radius: 8px;
   box-shadow: 0 4px 12px rgba(0,0,0,.25);
}

/* Arrow */
.tooltip.bs-tooltip-top .tooltip-arrow::before,
.tooltip.bs-tooltip-bottom .tooltip-arrow::before,
.tooltip.bs-tooltip-start .tooltip-arrow::before,
.tooltip.bs-tooltip-end .tooltip-arrow::before {
   border-top-color: #1f2937;
   border-bottom-color: #1f2937;
}

/* KPI Highlight number */
.kpi-tooltip-value {
   font-size: 18px;
   font-weight: 700;
   margin-top: 6px;
}

/* Status color */
.kpi-green { color: #22c55e; }
.kpi-yellow { color: #facc15; }
.kpi-red { color: #ef4444; }

</style>
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

<div class="row mb-3" id="kpi-summary">
   <div class="col-md-2">
       <div class="kpi-card" id="kpi-total-card">
           <div class="kpi-label">Total</div>
           <div class="kpi-value text-success" id="kpi-total">3461</div>
        </div>
        
     
   </div>
   
   
    <div class="col-md-2">
        <div class="kpi-card" id="kpi-on-card">
           <div class="kpi-label">ON</div>
           <div class="kpi-value text-success" id="kpi-on">3461</div>
        </div>
       
    </div>
    
    <div class="col-md-2">
       <div class="card kpi-card kpi-off"  id="kpi-off-card"   data-bs-toggle="tooltip"  data-bs-html="true">
          <div class="kpi-title">OFF</div>
          <div class="kpi-value" id="kpi-off">0</div>
       </div>
    </div>
    
    <div class="col-md-2">
       <div class="card kpi-card kpi-performance"  id="kpi-performance-card"   data-bs-toggle="tooltip"  data-bs-html="true">
          <div class="kpi-title">Perfomance</div>
          <div class="kpi-value" id="kpi-performance">0</div>
       </div>
    </div>
    
    <div class="col-md-2">
       <div class="card kpi-card kpi-critical"  id="kpi-critical-card"   data-bs-toggle="tooltip"  data-bs-html="true">
          <div class="kpi-title">Critical</div>
          <div class="kpi-value" id="kpi-critical">0</div>
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
                <div class="modal-footer justify-content-between">
   <div id="pagination-umur"></div>
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
               
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
    ($('#id_unit').val() == null ? '':  formData.append('unit', $('#id_unit').val())) ;
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
               var terminal = (vall['nama_terminal'] == undefined ?  'All':vall['nama_terminal']);
            
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
                           <h5>Rekapitulasi Kondisi Fasilitas ${val['kode_unit']}  ${terminal}</h5>
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
                        <h5>Rekapitulasi Perankat ${val['kode_unit']}  ${terminal}</h5>
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
               var terminal = (vall['nama_terminal'] == null?'All': '');
               ChartBar('grafik_bar_'+i+ii,vall['perfome'],terminal,vall['id'],val['id_unit'],val['warna']); 
               BarUmur('barUmur_'+i+ii,vall['umur'],terminal,vall['id'],val['id_unit'],val['warna']); 
              ChartPie('grafik_don_'+i+ii,vall['total_perfome']);
            });
      });
      renderKPI(json); 
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

function ChartBar(id, data, terminal) {

    terminal = terminal || 'All';

    if (!$('#' + id).length) return;

    const labels = data.map(d => d.nama);
    const values = data.map(d => d.perfome);

    const option = {
        title: {
            text: 'Performance Unit ' + terminal,
            subtext: 'Persentase Performance Fasilitas'
        },
        tooltip: {
           trigger: 'axis',
           axisPointer: { type: 'shadow' },
           formatter: function(params){
              const on  = params[0].value;
              const off = params[1].value;
              const total = on + off;
              const persen = total ? Math.round((on/total)*100) : 0;
        
              return `
                 <b>${params[0].name}</b><br>
                 ON : <b>${on}</b><br>
                 OFF : <b>${off}</b><br>
                 Total : <b>${total}</b><br>
                 Performance : <b>${persen}%</b>
              `;
           }
        },

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            max: 100
        },
        yAxis: {
            type: 'category',
            data: labels
        },
        series: [{
            type: 'bar',
            data: values,
            label: {
                show: true,
                position: 'insideRight',
                formatter: '{c}%',
                color: '#fff'
            },
            itemStyle: {
                color: function (params) {
                    let v = params.value;
                    if (v < 70) return '#e74c3c';      // MERAH
                    if (v <= 90) return '#f1c40f';    // KUNING
                    return '#2ecc71';                 // HIJAU
                }
            }
        }]
    };

    const chart = echarts.init(document.getElementById(id));
    chart.setOption(option);
    chart.resize();

    chart.on('click', function (params) {
        let i = params.dataIndex;
        GetOffFasility(
            data[i].id_lokasi,
            data[i].id_catagory,
            data[i].id_unit
        );
    });
}

function BarUmur(id, data, terminal) {

    terminal = terminal || 'All';

    if (!$('#' + id).length || !data || !data.length) return;

    const dataX = data.map(item => item.tahun);
    const dataJumlah = data.map(item => item.jumlah);

    const option = {
        title: {
            text: 'Rekapitulasi Umur Perangkat ' + terminal,
            subtext: 'Jumlah perangkat berdasarkan tahun'
        },
        tooltip:{
           trigger:'axis',
           formatter:function(params){
              let d = params[0];
              return `
                 <b>Umur ${d.axisValue} Tahun</b><br>
                 Jumlah Perangkat : <b>${d.value}</b>
              `;
           }
        },
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
        series: [{
            type: 'bar',
            data: dataJumlah,
            showBackground: true,
            itemStyle: {
                color: '#3498db'
            },
            backgroundStyle: {
                color: 'rgba(180,180,180,0.2)'
            },
            label: {
                show: true,
                position: 'top'
            }
        }]
    };

    const chart = echarts.init(document.getElementById(id));
    chart.setOption(option);
    chart.resize();

    chart.on('click', function (params) {
        const idx = params.dataIndex;
        ListFasilitas(
            data[idx].id_lokasi,
            data[idx].tahun,
            data[idx].id_unit
        );
    });
}

function ChartPie(id,data){

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
               tooltip: {
                   formatter: function (p) {
                      return `
                         <b>Performance Unit</b><br>
                         Nilai : <b>${p.value}%</b><br>
                         Status :
                         ${p.value >= 90 ? '🟢 Sangat Baik' :
                           p.value >= 70 ? '🟡 Perlu Perhatian' :
                           '🔴 Buruk'}
                      `;
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



function ListFasilitas(idterminal, tahun, idUnit, page = 1) {

   show();
   $('#ViiewUmurPerangkat').modal('show');
   $('#ViiewUmurPerangkat')
      .find('.modal-title')
      .html('List Umur Perangkat');

   var formData = new FormData();
   formData.append('terminal', idterminal);
   formData.append('tahun', tahun);
   formData.append('unit', idUnit);
   formData.append('page', page);
   formData.append('limit', 10);

   $.ajax({
      url: "<?=base_url()?>dashboard/PerfomanceFasility/GetDetailUmur",
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function (r) {

         var json = JSON.parse(r);
         var row = "";
         var no = (json.page - 1) * json.limit + 1;

         if (json.data.length === 0) {
            row = `
               <tr>
                  <td colspan="5" class="text-center">Data tidak ditemukan</td>
               </tr>`;
         } else {
            $.each(json.data, function (i, val) {
               row += `
                  <tr>
                     <td>${no++}</td>
                     <td>${val.tanggal_penggunaan || ''}</td>
                     <td>${val.nama_fasilitas || ''}</td>
                     <td>${val.nama_perangkat || ''}</td>
                     <td>${val.serial_number || ''}</td>
                  </tr>`;
            });
         }

         $('#tabel-umurperangkat tbody').html(row);

         // optional pagination
         buildPaginationUmur(json.total, json.page, json.limit, idterminal, tahun, idUnit);

         hide();
      },
      error: function () {
         hide();
      }
   });

   return false;
}


function buildPaginationUmur(total, page, limit, terminal, tahun, unit) {
   let totalPage = Math.ceil(total / limit);
   let html = '';

   if (totalPage <= 1) {
      $('#pagination-umur').html('');
      return;
   }

   if (page > 1) {
      html += `<button class="btn btn-sm btn-primary mr-1"
         onclick="ListFasilitas('${terminal}','${tahun}','${unit}',${page - 1})">
         Prev
      </button>`;
   }

   html += `<span class="mr-2">Page ${page} of ${totalPage}</span>`;

   if (page < totalPage) {
      html += `<button class="btn btn-sm btn-primary"
         onclick="ListFasilitas('${terminal}','${tahun}','${unit}',${page + 1})">
         Next
      </button>`;
   }

   $('#pagination-umur').html(html);
}


function renderKPI(data){
   let total = 0, on = 0, off = 0, critical = 0;

   data.forEach(unit=>{
      unit.data.forEach(item=>{
         item.perfome.forEach(f=>{
            total += +f.total;
            on    += +f.ON;
            off   += +f.OFF;
            if(f.OFF > 5) critical += f.OFF;
         });
      });
   });

console.log((on/total)*100);
   let performance = total ? Math.floor((on/total)*100) : 0;

   $('#kpi-total').text(total);
   $('#kpi-on').text(on);
   $('#kpi-off').text(off);
   $('#kpi-critical').text(critical);
   $('#kpi-performance').text(performance+'%');

   updateKpiTooltip({total,on,off,critical,performance});
}



function updateKpiTooltip({total,on,off,critical,performance}) {
    console.log(total);
   setTooltip('#kpi-total-card',
      kpiTooltipHTML(
         'Total Device',
         'Total seluruh perangkat terdata',
         `${total} Unit`
      )
   );

   setTooltip('#kpi-on-card',
      kpiTooltipHTML(
         'Device ON',
         'Perangkat aktif & normal',
         `${on} Unit`,
         'kpi-green'
      )
   );

   setTooltip('#kpi-off-card',
      kpiTooltipHTML(
         'Device OFF',
         'Perangkat tidak berfungsi',
         `${off} Unit`,
         'kpi-red'
      )
   );

   setTooltip('#kpi-critical-card',
      kpiTooltipHTML(
         'OFF Kritis',
         'OFF melebihi batas toleransi',
         `${critical} Unit`,
         'kpi-red'
      )
   );

   setTooltip('#kpi-performance-card',
      kpiTooltipHTML(
         'Performance',
         'ON / Total × 100',
         `${performance}%`,
         performance >= 90
            ? 'kpi-green'
            : performance >= 70
               ? 'kpi-yellow'
               : 'kpi-red'
      )
   );
}



function kpiTooltipHTML(title, desc, value, colorClass = '') {
   return `
      <div style="font-size:12px;opacity:.85">${title}</div>
      <div style="margin-top:4px;font-size:12px">${desc}</div>
      <div class="kpi-tooltip-value ${colorClass}">
         ${value}
      </div>
   `;
}

function setTooltip(selector, html) {
   const el = $(selector);

   if (!el.length) return;

   el.tooltip('dispose'); // bootstrap 4 way

   el.tooltip({
      html: true,
      title: html,
      placement: 'top',
      container: 'body',
      trigger: 'hover'
   });
}

</script>