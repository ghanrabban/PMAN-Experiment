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

   td, th {
    white-space: normal;
   }
</style>
<script type="text/javascript" src="<?=base_url()?>assets_v2/js/charts/loader.js"></script>  
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
         </div>
         <div class="row">
            <div class="col-xl-12 ">
               <div class="row">
                  <div class="col-md-12">
                     <!-- <div id="chart_div"></div> -->
                     <div class="card">
                        <div class="card-body">
                           <div id="bar_chart0" style=" height: 450px;"></div>
                        </div>
                     </div>
                  </div>
                  
                 
                 
                  <!-- Indikator Kerusakan Fasilitas End -->
               </div>
            </div>
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
<script>
   google.charts.load('current', {packages: ['corechart', 'bar']});
   // google.charts.setOnLoadCallback(drawChart);
   google.charts.setOnLoadCallback();
 

level2();
function level2(){
    
  $.ajax({
     url: "<?=base_url()?>dashboard/perfomance_detail/",
     type: 'post',
     // data: formData,
     contentType: false,
     processData: false,
  
     success: function(r){
      var json = JSON.parse(r);
      //  drawStuffLv2(json)

      jQuery.each(json['data'], function( i, val ) {
               // console.log('bar_chart'+i,json['unit'],val['nama_terminal']);
               drawBasic_detail('bar_chart'+i,val['perfome'],json['unit'],val['nama_terminal'],val['id'],json['id_unit']); 
      });
      // drawBasic(json,json['unit']);
     }, error: function(){
        hide ();
     }
  });   
 return false;
}





function drawBasic_detail(id,data_fasilitas,unit,nama_terminal,id_terminal,id_unit) {
 
   var jsonData = data_fasilitas;


   var data = new google.visualization.DataTable();
   data.addColumn('string', 'Terminal'); // Implicit domain label col.
   data.addColumn('number', 'Perfomance'); // Implicit series 1 data col.
   data.addColumn({type:'number', role:'annotationText'}); // annotation role col.
   data.addColumn({type:'string', role:'annotationText'});  // interval role col.
   data.addColumn({type:'string', role:'annotationText'});  // interval role col.
   data.addColumn({type:'string', role:'annotationText'});  // interval role col.
  
 
   $.each(jsonData, function(i, jsonData){
      var status        = jsonData.nama;
      var total         = parseFloat(jsonData.perfome);
      var id            = jsonData.perfome;
      var catagory      = jsonData.id_catagory;

      data.addRows([[status, total,id ,id_terminal,catagory,id_unit]]);
   });

   var options_c = {
      title: unit+' '+nama_terminal,
      legend: { position: "none" },
      series: {
         0: {
         targetAxisIndex: 0
         },
         1: {
         targetAxisIndex: 1
         }
      },
      vAxes: {
         0: {
         title:data.getColumnLabel(1)
         },
         
      },
    vAxis: {
      format: 'decimal',
      minValue: 0
    },
    hAxis: {
      minValue: {minValue: 0},
      slantedText: true,
    },
   
    colors: ['#CBD570', '#FCC100'],
    theme: 'material'
  };
   // var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
   // var chart = new google.charts.Bar(document.getElementById(id));
   // chart.draw(data, google.charts.Bar.convertOptions(options_c));
   
   function selectHandler() {
               var selectedItem = chart_c.getSelection()[0];
               if (selectedItem) {
               
                  var id_catagory  = data.getValue(selectedItem.row,4);
                  var id_terminal  = data.getValue(selectedItem.row,3);
                  var id_unit      = data.getValue(selectedItem.row,5);
                  GetOffFasility(id_terminal,id_catagory,id_unit)
                  // window.open("<?=base_url('dashboard/perfomance/')?>"+value);
               }
   }
  var chart_c = new google.visualization.ColumnChart(document.getElementById(id));
  google.visualization.events.addListener(chart_c, 'select', selectHandler); 
  chart_c.draw(data, options_c);
}

function GetOffFasility(idterminal,idCatagory,idUnit){
   $('#requestModalView').modal('show');
      $('#requestModalView').find('.modal-title').html('Tindak Lanjut');   
    
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
     }, error: function(){
        hide ();
     }
   });   
   return false;
   
}

</script>