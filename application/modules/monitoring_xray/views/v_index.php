<style>
   #chart-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}
@media (min-width: 1200px) {
    .modal-xl {
        width: 1140px;
    }
}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-cly1{text-align:left;vertical-align:middle}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
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
           
            <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block">
                        <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row" id="export">
                              <div class="col-md-12">
                                 <div class="pull-right putih mb-10">
                                    <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Tambah</a>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-7">
                                 <div class="row">
                                    <div class="col-md-5">
                                       <div class="dataTables_length" id="complex-dt_length">
                                          <label>
                                             Show 
                                             <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm" id="limitData">
                                                <option value="5">5</option>
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
                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                       <div id="complex-dt_filter" class="dataTables_filter">
                                          <label>Search:
                                          <input type="date" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="tglData"></label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-5">
                                 <div id="complex-dt_filter" class="dataTables_filter">
                                    <label>Search:
                                    <input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table class="tg table table-condensed table-striped table-bordered"  id="tabel-data">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="tg-0pky">Nama</th>
                                             <th class="tg-0pky">Tanggal Pengecekan</th>
                                             <th class="tg-0pky">Posisi Generator</th>
                                             <th class="tg-0lax">Serial Number</th>
                                             <th class="tg-0lax">Ontime Generator</th>
                                             <th class="tg-0lax">Nilai Kv/mA</th>
                                            
                                             <th class="tg-0lax">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          
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
<div class="modal fade" id="m-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return SaveData(this)">
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal Pemeriksaan</label>
                  <div class="col-sm-10">
                     <input type="date" class="form-control" name="tanggal" id="tanggal" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Fasilitas</label>
                  <div class="col-sm-10">
                     <input type="hidden" id="id_fasilitas" style="width: 300px" name="id_fasilitas"  />
                  </div>
               </div>
               <hr>
               <div id="row-input" class="row">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
<link href="<?=base_url()?>assets_v2/plugins/form-select2/select2.css" rel="stylesheet" >
 <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/form-select2/select2.js"></script>

<script>FilterData();
$("#srcData").on("keyup", function () {
   FilterData();
});

$('body').on('change', '#limitData', function () {
   FilterData();
});

$('body').on('change', '#tglData', function () {
   FilterData();
});

function FilterData(id) {
   show();
   var formData = new FormData();
   formData.append('limit', $('#limitData').val());
   formData.append('src', $('#srcData').val());
   formData.append('tgl', $('#tglData').val());
   var id = (id == null ? 0 : id);
   $.ajax({
      url: "<?=base_url('monitoring_xray')?>/LoadData/" + id,
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,

      success: function (r) {
         var json = JSON.parse(r);
         var header_table = "";
         var pag = "";
         jQuery.each(json['data'], function (i, val) {
            var row = "";
            var BtnAction = '';
            var prosesBtn = `<button class="btn waves-effect waves-light btn-primary btn-icon" onclick="ConfirmData('` + val['id_monitoring'] + `','proses')"><i class="fa fa-gear"></i></button>   `;
            var editBtn = ` <button class="btn waves-effect waves-light btn-primary btn-icon" onclick="EditData(` + val['id_monitoring'] + `)"><i class="feather icon-edit"></i></button>`
            var deleteBtn = `<button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(` + val['id_monitoring'] + `,'delete')"><i class="fa fa-trash"></i></button>`;
            if (val['status'] === '0') {

               BtnAction = editBtn + prosesBtn + deleteBtn;
            } else {
               BtnAction = val['status_l'];
            }
            row="";
            if (val['detail'].length !=2) {
              
            }else{
               console.log('ada 2');
             
               jQuery.each(val['detail'], function (ii, vall) {

                  if (ii % 2 === 0) {
                    
                     row+=`   <td class="tg-0lax">${vall['posisi']}</td>
                              <td class="tg-0lax">${vall['serial_number']}</td>
                              <td class="tg-0lax">${vall['waktu']}</td>  
                              <td class="tg-0lax">${vall['nilai_cek']}</td>
                              <td class="tg-0lax" rowspan="2">${BtnAction}</td></tr>`;
                            
                  } else {
                     row+=`<tr>
                              <td class="tg-0lax">${vall['posisi']}</td>
                              <td class="tg-0lax">${vall['serial_number']}</td>
                              <td class="tg-0lax">${vall['waktu']}</td>
                              <td class="tg-0lax">${vall['nilai_cek']} </td>
                           </tr>`;
                  }
               });
             
           
               header_table += ` <tr>
                                 <td class="tg-cly1" rowspan="2">` + (val['nama_fasilitas'] == null ? '' : val['nama_fasilitas']) + `</td>
                                 <td class="tg-0lax" rowspan="2">` + (val['tanggal_l'] == null ? '' : val['tanggal_l'])+`</td>    
                        `+row;
            }        
                });  
                  
         // <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="Delete(`+val['idmenu']+`)"><i class="fa fa-trash"></i></button>
         $('#tabel-data > tbody:last-child').html(header_table);
         $('#data-pag').html(json['pag']['label']);
         
         hide();
         Grafik(json['grafik']);
      },
      error: function () {
         hide();
      }
   });
   return false;
}

function AddData() {
   // show();
   $('#m-modal').modal('show');
   $('#m-modal').find('.modal-title').html('Tambah Data Baru');
   $('#m-modal').find('form').attr('onsubmit', 'return SaveData(this)');
}

function EditData(id) {
   // show();
   $('#m-modal').modal('show');
   $('#m-modal').find('.modal-title').html('Edit Data');
   $('#m-modal').find('form').attr('onsubmit', 'return UpdateData(this,\'' + id + '\')');
   $.ajax({
      url: "<?=base_url()?>monitoring_xray/EditData/" + id,
      type: 'post',
      // data: formData,
      contentType: false,
      processData: false,

      success: function (r) {

         var json = JSON.parse(r);
         $('#tanggal').val(json['tanggal']);
         $('#waktu').val(json['waktu']);
         $('#nilai_kv').val(json['nilai_kv']);
         $('#nilaim_ma').val(json['nilaim_ma']);

         $('#id_fasilitas').select2(
            'data', json['fasilitas']
         );
         var row='';
            jQuery.each(json['detail'], function (i, val) {
                    row += `<div class="col-md-6">
                        <h5> Pengecekan ${val['nama_perangkat']} ${val['posisi']}</h5>
                        <div class="form-group row">
                           <label class="col-sm-6 col-form-label">Ontime Generator</label>
                           <div class="col-sm-6">
                              <input type="hidden" name="Updateitems[`+i+`][id_detail]" id="updateid_detail${i}" value="${val['id_detail']}" />
                             <input type="text" class="form-control" name="Updateitems[`+i+`][waktu]" id="waktu${i}"  value="${val['waktu']}" >
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-sm-6 col-form-label">Nilai Kv</label>
                                 <div class="col-sm-6">
                                    <div class="input-group">
                                       <input type="number"  min="0" max="1000" step="0.01" class="form-control" id="updatenilai_kv${i}" name="Updateitems[`+i+`][nilai_kv]" value="${val['nilai_kv']}" >
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-sm-6 col-form-label">Nilai mA</label>
                                 <div class="col-sm-6">
                                    <div class="input-group">
                                       <input type="number"  min="0" max="1000" step="0.01"  class="form-control" id="updatenilaim_ma${i}" name="Updateitems[`+i+`][nilaim_ma]" value="${val['nilaim_ma']}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>`;
                  });
            $('#row-input').html(row);
      },
      error: function () {
         hide();
      }
   });
   return false;
}

function SaveData(f) {
   show();
   var formData = new FormData($(f)[0]);
   // formData.append('id', id);
   $.ajax({
      url: "<?=base_url('monitoring_xray/')?>SaveData/",

      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function (r) {
         var json = JSON.parse(r);
         $('#m-modal').modal('hide');

         FilterData();
         NF(json);
         hide();
      },
      error: function () {
         hide();
      }
   });
   return false;
}

function UpdateData(f, id) {
   show();
   var formData = new FormData($(f)[0]);
   // formData.append('id', id);
   $.ajax({
      url: "<?=base_url('monitoring_xray/')?>UpdateData/" + id,

      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function (r) {
         var json = JSON.parse(r);
         $(f)[0].reset();
         $('#m-modal').modal('hide');
         FilterData();
         NF(json);
         hide();
      },
      error: function () {
         hide();
      }
   });
   return false;
}

function ConfirmData(id, tipe) {
   var tit = '';
   var des = '';
   if (tipe == 'proses') {
      tit = "Proses Data";
      des = "Apakah Data Sudah Benar Untuk Diproses Lebih Lanjut?";
   } else if (tipe == 'delete') {
      tit = 'Hapus Data'
      des = "Apakah Sudah Yakin untuk Menghapus Data ini?";
   }
   cuteAlert({
      type: "question",
      title: tit,
      message: des,
      confirmText: "Okay",
      cancelText: "Cancel"
   }).then((e) => {
      if (e == ("confirm")) {
         // ProsesData(id);
         (tipe == 'proses' ? ProsesData(id) : DeleteData(id))
      }

   })
}

function ProsesData(id) {

   $.ajax({
      url: "<?= base_url('monitoring_xray/ProsesData/') ?>" + id,
      type: 'post',
      contentType: false,
      processData: false,
      success: function (r) {
         var json = JSON.parse(r);
         NF(json);
         FilterData();
      },
      error: function () {
         hide();
      }
   });

}

function DeleteData(id) {

   $.ajax({
      url: "<?= base_url('monitoring_xray/DeleteData/') ?>" + id,
      type: 'post',
      contentType: false,
      processData: false,
      success: function (r) {
         var json = JSON.parse(r);
         NF(json);
         FilterData();
      },
      error: function () {
         hide();
      }
   });

}

var lastResults = [];
$("#id_fasilitas").select2({
   multiple: false,
   placeholder: "Pilih Fasilitas",
   ajax: {
      url: "<?= base_url('monitoring_xray/GetFasilitasBy') ?>",
      dataType: 'json',
      type: "POST",
      quietMillis: 50,
      data: function (serc) {
         return {
            serc: serc,

         };
         alert("error");
      },
      results: function (data) {
         return {
            results: $.map(data, function (item) {
               return {
                  text: item.text,
                  id: item.id
               }
            })
         };
      }
   },
});

function Grafik(data){
  
   "use strict"; 
  
      // if ($('#e_chart_1').length > 0) {
        
      //    const data =data;
      //    const dateList = data.map(function (item) {
      //       return item[0];
      //    });
      //    const valueVertikal = data.map(function (item) {
      //       return item[1];
      //    });
      //    const valueHorizontal = data.map(function (item) {
      //       return item[1];
      //    });
      //    const colors = ['#5470C6', '#EE6666'];
      //    option = {
      //       color: colors,
      //       tooltip: {
      //          trigger: 'axis'
      //       },
      //       legend: {},
      //       grid: {
      //          top: 70,
      //          bottom: 50
      //       },
      //       xAxis: [
      //          {
      //             type: 'category',
      //             axisTick: {
      //             alignWithLabel: true
      //             },
               
      //             // prettier-ignore
      //             data: dateList
      //          },
      //          {
      //             type: 'category',
      //             axisTick: {
      //             alignWithLabel: true
      //             },
      //             axisLine: {
      //             onZero: false,
      //             lineStyle: {
      //                color: colors[0]
      //             }
      //             },
      //             axisPointer: {
      //             type: 'category',
      //             axisTick: {
      //                alignWithLabel: true
      //             },
                  
      //             // prettier-ignore
      //             data: dateList2
      //             },
      //             // prettier-ignore
      //             }
      //       ],
      //       yAxis: [
      //          {
      //             type: 'value'
      //          }
      //       ],
      //       series: [
      //          {
               
      //             type: 'line',
               
      //             smooth: true,
               
      //             data: valueVertikal
      //          },
      //          {
               
      //             type: 'line',
      //             smooth: true,
                  
      //             data: valueHorizontal
      //          }
      //       ]
      //       };
      //    var dom =document.getElementById('e_chart_1')
      //    var eChart_1 = echarts.init(dom, 'dark', {
      //       renderer: 'canvas',
      //       useDirtyRect: false
      //       }
      //    );
       
      //    eChart_1.setOption(option);
      //    eChart_1.resize();

      //    const img = new Image();

      //    // get the chart instance data as url
      //    img.src = eChart_1.getDataURL({
      //       type: 'png', // can be jpeg or png
      //       pixelRatio: 5, // image's ratio. default is 1
      //       backgroundColor: '#fff', // hex color defining the background of the chart
      //    });
      //    //console.log(img.src);
      //    //  const imgTab = window.open('');
      //    // rendering the base64 image retrieved
      //    //imgTab.document.write(`<img src='${img.src}'/>`);

      //    // SaveImageToServer(img.src);
      // }

     

      //SaveImageToServer(eChart_1.getImageURI());
   
}
var echartResize;
$(window).on("resize", function () {
   /*E-Chart Resize*/
   clearTimeout(echartResize);
   echartResize = setTimeout(Grafik, 200);
  
}).resize(); 


$('body').on('change','#id_fasilitas', function() {
      if($(this).val() != ''){
         var id=$(this).val();
         $.ajax({
            url: '<?= base_url('monitoring_xray/SetPerangkat/') ?>' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               var row='';
                  jQuery.each(json, function (i, val) {
                    row += `<div class="col-md-6">
                        <h5> Pengecekan ${val['nama_perangkat']} ${val['nama']}</h5>
                        <div class="form-group row">
                           <label class="col-sm-6 col-form-label">Ontime Generator</label>
                           <div class="col-sm-6">
                              <input type="hidden" name="items[`+i+`][posisi]" id="id_posisi${i}" value="${val['nama']}" />
                              <input type="hidden" name="items[`+i+`][id_perangkat]" id="id_perangkat${i}" value="${val['id_perangkat']}" />
                              <input type="text" class="form-control" name="items[`+i+`][waktu]" id="waktu${i}" >
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-sm-6 col-form-label">Nilai Kv</label>
                                 <div class="col-sm-6">
                                    <div class="input-group">
                                       <input type="number"  min="0" max="1000" step="0.01" class="form-control" id="nilai_kv${i}" name="items[`+i+`][nilai_kv]">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <label class="col-sm-6 col-form-label">Nilai mA</label>
                                 <div class="col-sm-6">
                                    <div class="input-group">
                                       <input type="number"  min="0" max="1000" step="0.01"  class="form-control" id="nilaim_ma${i}" name="items[`+i+`][nilaim_ma]">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>`;
                  });
                   $('#row-input').html(row);
            }, error: function(){
            hide();
            }
         });
      }
     
   });

</script>
