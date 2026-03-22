<style>
   .pull-left{
      justify-content: flex-end;
   }
</style><div id="spinner" class="">
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
               <!-- product profit start -->
               <div class="col-md-12">
                  <div class="card prod-p-card card-blue">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">Total Biaya Permintaan Sparepart</h6>
                              <h3 class="m-b-0 f-w-700 text-white" id='counting-maount'>15,830</h3>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-money-bill-alt text-c-blue f-18"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block">
                        <div class="row" id="export">
                           <div class="col-md-12">
                              <div class="pull-right putih mb-10">
                                 <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Tambah</a>
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

                        <div class="row table-responsive">
                           <table class="table table-condensed table-striped table-bordered" id="tabel-data">
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
                        <div class="row"  id="data-pag">

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
FilterData();
function FilterData(id){
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
			 var header_table = "";
			 var pag= "";
			 jQuery.each(json['data'], function( i, val ) {
				var row = "";

               var proses        =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['idpermintaan'] +`,'proses')"><i class="fa fa-gear"></i></button>`; 
               var editButton    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(${val['idpermintaan']})"><i class="feather icon-edit"></i></button>`;
               var rejectButton  = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData(${val['idpermintaan']},'delete')"><i class="fa fa-trash"></i></button>`;
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
				header_table +=`<tr >
								 
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
			 $('#tabel-data > tbody:last-child').html(header_table);
          $('#data-pag').html(json['pag']['label']);
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
 $('#m-modal').find('.modal-title').html('Tambah Data Baru');   
 $('#m-modal').find('form').attr('onsubmit','return SaveData(this)');

}


function EditData(id){
      show();
      $('#m-modal').modal('show');
      $('#m-modal').find('.modal-title').html('Edit Data');   
      $('#m-modal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
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

function SaveData(f){
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
           
            $('#m-modal').modal('hide');
          
           FilterData();
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
         url:  "<?=base_url('sparepart/')?>UpdateDataPermintaan/"+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $(f)[0].reset(); 
            $('#m-modal').modal('hide');
           FilterData();
           NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
}

function ConfirmData(id,tipe){
      console.log(id+tipe);
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
         url: "<?= base_url('sparepart/ProsesDataPermintaan/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         }, error: function(){
         hide();
         }
      });

}

function DeleteData(id){
   
      $.ajax({
         url: "<?= base_url('sparepart/DeleteDataPermintaan/') ?>" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         }, error: function(){
         hide();
         }
      });

}

   var lastResults = [];
   $("#id_barang").select2({
      multiple: false,
      placeholder: "Masukan Nama Barang",
      ajax: {
            url:  "<?= base_url('sparepart/GetBarang/') ?>",
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
   function EditData(id){
      var formData = new FormData();
      formData.append('src',  $('#srcData').val());
      
      $.ajax({
               url: "<?=base_url()?>sparepart/Sumpermintaan",
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  var json = JSON.parse(r);
                 
               }, error: function(){
                  hide ();
               }
         });   
      return false;
   }
   SumBulan();

function SumBulan(){
   var formData = new FormData();
   if ($('#filter_bulan').val() != '') {
      formData.append('bulan',  $('#filter_bulan').val());
   
   }
     
   $.ajax({
      url: "<?= base_url('sparepart/GetSumBulan') ?>",
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(r){
         var json = JSON.parse(r);
         $('#counting-maount').html(json['total']);
      }, error: function(){
      hide();
      }
   });

}

$('body').on('change','#filter_bulan', function() {
    
         SumBulan();

         FilterData();
     
     
   });
</script>
