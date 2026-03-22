<style>
   .pull-left{
      justify-content: flex-end;
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
                  <div class="card ">
                     <div class="card-block">
                        <ul class="nav nav-tabs  tabs tab-data mb-20" role="tablist" >
                           <li class="nav-item nav-link "  role="presentation" onclick="FilterData(1)">
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="true"  style="cursor: pointer;">Stok Sparepart</a>
                           </li>
                           
                           <li class="nav-item nav-link" role="presentation" onclick="PermintaanStok()" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">Permintaan</a>
                           </li>
                           
                           <li class="nav-item nav-link" role="presentation" onclick="HistoryStok()" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">Penggunaan</a>
                           </li>
                        </ul>
                        <div class="tab-content tabs card-block">
                           <div class="tab-pane " id="tab-stok" role="tabpanel">
                              <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-5">
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
                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                       <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">No</th>
                                             <th class="cemter-t">Terakhir Update</th>
                                             <th class="cemter-t">Nama Barang</th>
                                             <th class="cemter-t">Stok</th>
                                             <th class="cemter-t">Satuan</th>
                                          </tr>
                                       </thead>
                                       <tbody id="Data-AP">
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="row"  id="data-pag">
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab-permintaan" role="tabpanel">
                              <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                 <div class="row" id="export">
                                    <div class="col-md-12">
                                       <div class="pull-right putih mb-10">
                                          <a class="btn btn-primary" onclick="AddPermintaan()"><i class="fa fa-file-excel-o "></i> Tambah</a>
                                       </div>
                                       <div class="pull-left  mb-10">
                                          <div class="form-group row">
                                             <label class="col-sm-6 col-form-label">Bulan</label>
                                             <div class="col-sm-6">
                                                <select name="complex-dt_length" aria-controls="complex-dt" class="form-control input-sm" id="filter_bulan">
                                                   <option></option>
                                                   <?php   for ($x = 1; $x <= 12; $x++): ?>
                                                      <option value="<?=$x?>"><?=Fmonth($x)?></option>
                                                   <?php endfor ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data-permintaan">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">No</th>
                                             <th class="cemter-t">Tanggal Permintaan</th>
                                             <th class="cemter-t">Nama Barang</th>
                                             <th class="cemter-t">Jumlah Permintaan</th>
                                             <th class="cemter-t">Harga	</th>
                                             <th class="cemter-t">Total Harga	</th>
                                             <th class="cemter-t">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody id="Data-AP">
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="row"  id="data-pag-permintaan">
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab-history" role="tabpanel">
                              <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                 <div class="row" id="export">
                                    <div class="col-md-12">
                                       <div class="pull-right putih mb-10">
                                          <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Penggunaan Barang</a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcDataHistory"></label></div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <table class="table table-condensed table-striped table-bordered" id="tabel-data-history">
                                       <thead class="thead-blue">
                                          <tr>
                                             <th class="cemter-t">Tanggal Penggunaan</th>
                                             <th class="cemter-t">Nama Barang</th>
                                             <th class="cemter-t">Jumlah</th>
                                             <th class="cemter-t">Keterangan Penggunaan</th>
                                             <th class="cemter-t">Teknisi</th>
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
            </div>
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="m-modal-penggunaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return SaveGroup(this)">
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal PM</label>
                  <div class="col-md-6">
                     <input type="date" class="form-control" name="tanggal" id="tanggal"  required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Barang</label>
                  <div class="col-sm-6">
                     <input type="hidden" id="id_barang_penggunaan" style="width: 300px" name="id_barang_penggunaan" required />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jumlah Penggunaan</label>
                  <div class="col-sm-6">
                     <input type="number" class="form-control" name="qty" id="qty" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Keterangan:</label>
                  <div class="col-sm-8">
                     <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan penggunaan barang" required></textarea>
                  </div>
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

<div class="modal fade" id="m-modal-permintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return SaveGroup(this)">
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Barang</label>
                  <div class="col-sm-6">
                     <input type="hidden" id="id_barang" style="width: 300px" name="id_barang"  />
                    
                  </div>
               </div>
            
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jumlah Permintaan</label>
                  <div class="col-sm-6">
                     <input type="number" class="form-control" name="qty" id="qty" >
                  </div>
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
<script>

function FilterData(id){
	show();
   var formData = new FormData();
   formData.append('limit',  $('#limitData').val());
      formData.append('src',  $('#srcData').val());
      var id =(id == null ? 0: id);
	$.ajax({
		  url: "<?=base_url('sparepart')?>/LoadDataStok/"+id,
		  type: 'post',
		  data: formData,
		  contentType: false,
		  processData: false,

		  success: function(r){
        
			 var json = JSON.parse(r);
			 var header_table = "";
			 var pag= "";
          var no =json['pag']['start'];
			 jQuery.each(json['data'], function( i, val ) {
				var row = "";

               var proses =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['idpermintaan'] +`,'proses')"><i class="fa fa-gear"></i></button>`; 
               var editButton = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(${val['idpermintaan']})"><i class="feather icon-edit"></i></button>`;
               var rejectButton = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData(${val['idpermintaan']},'delete')"><i class="fa fa-trash"></i></button>`;
               var none = '<button class="btn waves-effect waves-light btn-disabled btn-icon"><i class="feather icon-slash"></i></button>';
               var btn ='';
               if (val['status'] === '0') {
                  btn =proses+editButton+rejectButton;
               }else if (val['status'] === '3') {
                   btn = btn =editButton;
               }
				header_table +=`<tr >
								 
                              <td>`+(no++)+`</td>
                              <td>`+(val['tanggal'] == null ? '': val['tanggal'])+`</td>
                              <td>`+(val['barang'] == null ? '': val['barang'])+`</td>
                              <td>`+(val['stok'] == null ? '': val['stok'])+`</td>
                              <td>`+(val['satuan'] == null ? '': val['satuan'])+`</td>
							      </tr>`;
			 });
			 // <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="Delete(`+val['idmenu']+`)"><i class="fa fa-trash"></i></button>
			 $('#tabel-data > tbody:last-child').html(header_table);
          $('#data-pag').html(json['pag']['label']);
          $('#tab-stok').addClass('active');
          $('#tab-history').removeClass('active');
          $('#tab-permintaan').removeClass('active');
			 hide ();
		  }, error: function(){
			 hide ();
		  }
	});   
	return false;
}

   function AddData(){
   // show();
   $('#m-modal-penggunaan').modal('show');
   $('#m-modal-penggunaan').find('.modal-title').html('Penggunaan Sparepart');   
   $('#m-modal-penggunaan').find('form').attr('onsubmit','return SaveData(this)');

   }


	function EditData(id){
      show();
      $('#m-modal-penggunaan').modal('show');
      $('#m-modal-penggunaan').find('.modal-title').html('Edit Data');   
      $('#m-modal-penggunaan').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $.ajax({
               url: "<?=base_url()?>sparepart/EditDataPenggunaan/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                 
                  var json = JSON.parse(r);
                  $('#qty').val(json['qty']);  
                  $('#tanggal').val(json['tanggal']);  
                  $('#keterangan').val(json['keterangan']);  
                  $('#id_barang_penggunaan').select2(
                     'data',json['barang']
                  );
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
    }

   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  "<?=base_url('sparepart/')?>SavePenggunaan/",
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $('#m-modal-penggunaan').modal('hide');
          
           HistoryStok();
            NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function UpdateData(f,id){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  "<?=base_url('sparepart/')?>UpdateDataPenggunaan/"+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $(f)[0].reset(); 
            $('#m-modal-penggunaan').modal('hide');
            HistoryStok();
           NF(json);
          hide(); 
         }, error: function(){
            hide(); 
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
      }else if (tipe == 'prosesPermintaan'){
         tit = 'Hapus Data'
         des = "Apakah Sudah Yakin untuk Memproses Permintaan ini?";
      }else if (tipe == 'deletePermintaan'){
         tit = 'Hapus Data'
         des = "Apakah Sudah Yakin untuk Menghapus Permintaan ini?";
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
               if (tipe == 'proses') {
                  ProsesData(id);
               }else if (tipe == 'delete'){
                  DeleteData(id)
               }else if (tipe == 'prosesPermintaan'){
                 ProsesDataPermintaan(id);
               }else if (tipe == 'deletePermintaan'){
                 DeleteDataPermintaan(id);
               }else{
                  console.log('tidak terdaftar  ');
               }
         } 
               
      })
   }

   function ProsesData(id){
   
      $.ajax({
         url: "<?= base_url('sparepart/ProsesPenggunaan/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            HistoryStok();
         }, error: function(){
         hide();
         }
      });

   }

   function DeleteData(id){
   
      $.ajax({
         url: "<?= base_url('sparepart/DeleteDataPenggunaan/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            HistoryStok();
         }, error: function(){
         hide();
         }
      });

   }

   var lastResults = [];
   $("#id_barang_penggunaan").select2({
      multiple: false,
      placeholder: "Pilih barang",
      ajax: {
            url:  "<?= base_url('sparepart/GetStok/') ?>",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (serc) {
                return {
                    serc: serc
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

   


   $('body').on('change','#limitData', function() {
      FilterData();
   });

 

   $( "#srcData" ).on( "keyup", function() {
      FilterData();
   
   } );

   $('.tab-data  li[role!=x]').click(function(){
         var li = $(this).index();
     		$('li').removeClass('active');
     		$(this).addClass('active');
         var page=  $(this).attr("id");
         var client=  $(this).attr("data-clint");
         var so=     $(this).attr("data-so");
     
   });

   Tab();
   function Tab(){
     
      var url = new URL(window.location.href);
      var param = url.searchParams.get("tab");
     
     
      if(param == 'history'){ 
         HistoryStok();
         console.log('add active li history');
         $('.nav-tabs li:eq(2)').addClass('active')
      }else if(param == 'permintaan'){
          PermintaanStok();
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
      
      if(li == 0){
         window.history.pushState('', 'Title', 'stok');
    
      }else if(li == 1){
         window.history.pushState('', 'Title', 'stok?tab=permintaan');
    
      }else if(li == 2){
         window.history.pushState('', 'Title', 'stok?tab=history');
    
      }
   });


   function HistoryStok(){
    
    var formData = new FormData();
    formData.append('limit',  $('#limitData').val());
    show();
    $.ajax({
       url: "<?=base_url()?>sparepart/LoadHistoryStok/",
       type: 'post',
       data: formData,
       contentType: false,
       processData: false,
       success: function(r){
                var json = JSON.parse(r);
                var row = "";
                var x= 1;
                jQuery.each(json['data'], function( i, val ) {
                  var actBtn  = ``;
                  // var addBtn  =`<a class="btn btn-primary" onclick="AddData('${val['id_pmheader']}','${val['id_fasilitas']}','${val['idpm_type']}')"><i class="fa fa-file-excel-o "></i> Add PM</a>`;
                   var editBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData('${val['id_penggunaan']}')"><i class="feather icon-edit"></i></button>`;
                   var delBtn  =`<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData('${val['id_penggunaan']}','delete')"><i class="fa fa-trash"></i></button>`;
                   var prosBtn =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData('${val['id_penggunaan']}','proses')"><i class="fa fa-gear"></i></button>`;
                  //  var prnBtn  = `<a href="<?=base_url()?>pm/PrintData/${val['id_pmheader']}" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>`;
                  
                   if (val['status'] ==="0") {
                      actBtn=editBtn+prosBtn+delBtn;
                   }if (val['status'] === "1") {
                      actBtn='';
                   }   
                  

                   row +=`<tr>
                              <td class="cemter-t">${val['tanggal']}</td>
                              <td class="cemter-t">${val['barang']}</td>
                              <td class="cemter-t">${val['qty']+val['satuan']}</td>
                              <td class="cemter-t">${val['keterangan']}</td>
                              <td class="cemter-t">${val['create_by']}</td>
                              <td class="cemter-t">
                                 ${actBtn}
                              </td>
                           </tr>`;
                         x++;
                });

                 $('#tabel-data-history > tbody:last-child').html(row);
                 $('#data-pag-history').html(json['pag']['label']);
                 $('#tab-history').addClass('active');
                 $('#tab-stok').removeClass('active');
                 $('#tab-permintaan').removeClass('active');
                hide ();
             }, error: function(){
                hide ();
             }
    });   
    return false;
 }

 function PermintaanStok(id){
    
      show();
      var formData = new FormData();
      if ($('#filter_bulan').val() != '') {
         formData.append('bulan',  $('#filter_bulan').val());
      
      }
      formData.append('limit',  '5');
      var id =(id == null ? 0: id);
      $.ajax({
         url: "<?=base_url('sparepart')?>/LoadDataPermintaan/"+id,
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,

         success: function(r){
            var no =1;
            var json = JSON.parse(r);
            var row = "";
            var pag= "";
            jQuery.each(json['data'], function( i, val ) {
               

                  var proses        =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['idpermintaan'] +`,'prosesPermintaan')"><i class="fa fa-gear"></i></button>`; 
                  var editButton    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditDataPermintaan(${val['idpermintaan']})"><i class="feather icon-edit"></i></button>`;
                  var rejectButton  = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData(${val['idpermintaan']},'deletePermintaan')"><i class="fa fa-trash"></i></button>`;
                  var none          = '<button class="btn waves-effect waves-light btn-disabled btn-icon"><i class="feather icon-slash"></i></button>';
                  var lock          =`<label class="label label-info">Proses</label>`
                  var btn ='';
                  if (val['status'] === '0') {
                     btn =proses+editButton+rejectButton;
                  }else if (val['status'] === '3') {
                     btn = btn =editButton;
                  }else{
                     btn =lock;
                  }
               row +=`<tr >
                           
                           <td>`+(no++)+`</td>
                           <td>`+(val['tanggal'] == null ? '': val['tanggal'])+`</td>
                           <td>`+(val['nama_barang'] == null ? '': val['nama_barang'])+`</td>
                              <td>`+(val['qty'] == null ? '': val['qty'])+`</td>
                           <td>`+(val['harga'] == null ? '': val['harga'])+`</td>
                           <td>`+(val['total'] == null ? '': val['total'])+`</td>
                           
                           
                           <td>
                              ${btn}
                           </td>
                           </tr>`;
            });
            // <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="Delete(`+val['idmenu']+`)"><i class="fa fa-trash"></i></button>
            
            $('#tabel-data-permintaan > tbody:last-child').html(row);
            $('#data-pag-permintaan').html(json['pag']['label']);
            $('#tab-permintaan').addClass('active');
            $('#tab-stok').removeClass('active');
            $('#tab-history').removeClass('active');
            hide ();
         }, error: function(){
            hide ();
         }
      });   
    return false;
   }

   function AddPermintaan(){
      
       $('#m-modal-permintaan').modal('show');
      $('#m-modal-permintaan').find('.modal-title').html('Tambah Data Baru');   
      $('#m-modal-permintaan').find('form').attr('onsubmit','return SaveDataPermintaan(this)');

   }

   function SaveDataPermintaan(f){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  "<?=base_url('sparepart/')?>SavePermintaan/",
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $('#m-modal-permintaan').modal('hide');
          
           PermintaanStok();
            NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function EditDataPermintaan(id){
      show();
      $('#m-modal-permintaan').modal('show');
      $('#m-modal-permintaan').find('.modal-title').html('Edit Data Permintaan');   
      $('#m-modal-permintaan').find('form').attr('onsubmit','return UpdateDataPermintaan(this,\''+id+'\')');
      $.ajax({
               url: "<?=base_url()?>sparepart/EditDataPermintaan/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                 
                  var json = JSON.parse(r);
                  $('#qty').val(json['qty']);  
                  $('#id_barang').select2(
                     'data',json['barang']
                  );
                  hide ();
               }, error: function(){
                  hide ();
               }
         });   
         return false;
   }

   function UpdateDataPermintaan(f,id){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  "<?=base_url('sparepart/')?>UpdateDataPermintaan/"+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $(f)[0].reset(); 
            $('#m-modal').modal('hide');
           PermintaanStok();
           NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

  function ProsesDataPermintaan(id){
      
         $.ajax({
            url: "<?= base_url('sparepart/ProsesDataPermintaan/') ?>" + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               NF(json);
              PermintaanStok();
            }, error: function(){
            hide();
            }
         });

   }

   function DeleteDataPermintaan(id){
      
         $.ajax({
            url: "<?= base_url('sparepart/DeleteDataPermintaan/') ?>" + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(r){
               var json = JSON.parse(r);
               NF(json);
              PermintaanStok();
            }, error: function(){
            hide();
            }
         });

   }
   
   $('body').on('change','#filter_bulan', function() {
         PermintaanStok();
   });


   $("#id_barang").select2({
      multiple: false,
      placeholder: "Pilih barang",
      ajax: {
            url:  "<?= base_url('sparepart/GetStok/') ?>",
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (serc) {
                return {
                    serc: serc
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

</script>
