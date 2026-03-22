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
                           <li class="nav-item nav-link" role="presentation" onclick="HistoryStok()" >
                              <a  data-bs-toggle="tab"  role="tab" aria-selected="false"  style="cursor: pointer;">History</a>
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
                           <div class="tab-pane" id="tab-history" role="tabpanel">
                              <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                 <div class="row" id="export">
                                    <div class="col-md-12">
                                       <div class="pull-right putih mb-10">
                                          <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Buat Penggunaan Manual</a>
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
<div class="modal fade" id="m-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                     <input type="hidden" id="id_barang" style="width: 300px" name="id_barang" required />
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
			 hide ();
		  }, error: function(){
			 hide ();
		  }
	});   
	return false;
}

   function AddData(){
   // show();
   $('#m-modal').modal('show');
   $('#m-modal').find('.modal-title').html('Penggunaan Sparepart');   
   $('#m-modal').find('form').attr('onsubmit','return SaveData(this)');

   }


	function EditData(id){
      show();
      $('#m-modal').modal('show');
      $('#m-modal').find('.modal-title').html('Edit Data');   
      $('#m-modal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
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
           
            $('#m-modal').modal('hide');
          
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
            $('#m-modal').modal('hide');
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
            (tipe =='proses' ? ProsesData(id): DeleteData(id))
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

    function AddPermintaan(){
      
      var id_barang=$('#barang').val();
      var qty=$('#qty').val();
      var rowCount =  $('#tabel-permintaan > tbody tr').length;
      if (qty =='') {
         toastr.error('Quantity Barang tidak boleh Kosong');
      }else if(id_barang ==''){
         toastr.error('Barang Tidak Boleh Kosong');
      }else{
         $.ajax({
         url: "<?= base_url('sparepart/detailbarang/') ?>" + id_barang,
         type: 'GET',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
           
            var jumlah = parseFloat(qty)*parseFloat(json['harga']);
            console.log(jumlah);
            var new_input = ` 
               <tr id ="act_`+rowCount+`">
                  <td>`+(rowCount+1)+`
                     <input type="hidden" id="id_barang`+rowCount+`" style="width: 300px" name="Newitems[`+rowCount+`][id_barang]" data-id="`+rowCount+`" value="`+json['id_barang']+`"/>
                     <input type="hidden" id="qty_`+rowCount+`" style="width: 300px"  name="Newitems[`+rowCount+`][qty]" data-id="`+rowCount+`" value="`+qty+`" />
                      <input type="hidden" id="qty_`+rowCount+`" style="width: 300px"  name="Newitems[`+rowCount+`][nama_barang]" data-id="`+rowCount+`" value="`+json['nama_barang']+`"/>
                 
                       <input type="hidden" id="qty_`+rowCount+`" style="width: 300px"  name="Newitems[`+rowCount+`][harga]" data-id="`+rowCount+`" value="`+json['harga']+`" />
                 
                  </td>
                  <td>
                     `+json['nama_barang']+`
                  </td>
                  <td>
                   `+json['satuan']+`
                  </td>
                  <td>
                     `+qty+`
                  </td>
                  <td>
                     `+jumlah+`
                  </td>
                   <td>
                     `+json['katagori_barang']+`
                  </td>
                  <td>
                     <a class="btn waves-effect waves-light btn-danger btn-icon2" onclick="RemoveList('act_`+rowCount+`')"  type=""><i class="feather icon-trash"></i></a>
                  </td>
               </tr>
            `;

            $('#new_permintaan').append(new_input);
         }, error: function(){
         hide();
         }
      });
      }
    
      
        
    }

    function RemoveList(r,a) {
         // var last_chq_no = $('#total_chq').val();
   
         // if (last_chq_no > 1) {
         //    $('#'+ r).remove();
         //    $('#total_chq').val(last_chq_no - 1);
         // }
         $('#'+ r).remove();
         a && 0 < $("#removed-items").append(hidden_input("removed_items[]", a))
   }

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
      //  tab_content.eq(0).addClass('show active'); 
         //_education();
      }else if(li == 1){
         window.history.pushState('', 'Title', 'stok?tab=history');
      //  tab_content. eq(1).addClass('show active');
         // _photo(); load jabatan
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
                hide ();
             }, error: function(){
                hide ();
             }
    });   
    return false;
 }
</script>
