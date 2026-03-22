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
                           <div class="row" id="export">
                              <div class="col-md-12">
                                 <div class="pull-right putih mb-10">
                                    <a class="btn btn-primary" onclick="AddData()"><i class="fa fa-file-excel-o "></i> Tambah</a>
                                 </div>
                              </div>
                           </div>
                       
                            
                       
                                 <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                    <thead class="thead-blue">
                                    <tr>
                                       <th>Jenis RKAP</th>
                                       <th>Nama Pekerjaan</th>
                                       <th>Total Anggaran</th>
                                    </tr>
                                    
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                 </table>
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
                  <label class="col-sm-4 col-form-label">Unit Kerja</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="id_unit"  id="id_jenispekerjaan">
                        <option >-</option>
                        <?php foreach ($unit as $key => $value): ?>
                           <option value="<?=$value['id_unit']?>"><?=$value['kode_unit']?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Lokasi</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="id_lokasi"  id="id_lokasi">
                        <option >-</option>
                        <?php foreach ($lokasi as $key => $value): ?>
                           <option value="<?=$value['id']?>"><?=$value['nama_terminal']?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jenis RKAP</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="jenis_rkap"  id="jenis_rkap">
                        <option >-</option>
                           <option value="1">CAPEK</option>
                           <option value="2">OPEX</option>
                     </select>
                  </div>
               </div>
               <div id="form_detail">

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
function FilterData(){
	show();
  
	$.ajax({
		  url: "<?=base_url('monitoring/rkap')?>/LoadData",
		  type: 'post',
		  // data: formData,
		  contentType: false,
		  processData: false,

		  success: function(r){
			 var json = JSON.parse(r);
			 var header_table = "";
			 var pag= "";
			 jQuery.each(json['data'], function( i, val ) {
				var row = "";
            var proses =`<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['id_monitoring'] +`,'proses')"><i class="fa fa-gear"></i></button>`; 
            var editButton = '<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(' + val['id_monitoring'] + ')"><i class="feather icon-edit"></i></button>';
            var viewButton = `<a href="<?=base_url()?>Monitoring/Detail/`+val['id_monitoring']+`" class="btn waves-effect waves-light btn-primary btn-icon" type="button"> <i class="feather icon-eye"></i></a>`;
   
            var DelButton = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="Reject" onclick="ConfirmData(`+ val['id_monitoring'] +`,'delete')"><i class="fa fa-trash"></i></button>`;
            var none = '<button class="btn waves-effect waves-light btn-disabled btn-icon"><i class="feather icon-slash"></i></button>';
            var btn ='';
                if (val['status'] === '0') {
                  btn =proses+editButton+viewButton+DelButton;
               }else if (val['status'] === '1') {
                   btn = viewButton;
               }else if (val['status'] === '2') {
                   btn = viewButton;
               }else if (val['status'] === '3') {
                   btn = btn =editButton+viewButton;
               } else if (val['status'] === '6') {
                    btn = viewButton;
               }
				header_table +=`<tr >
								 
								
								   <td>`+(val['nama_pekerjaan']     == null ? '': val['nama_pekerjaan'])+`</td>
								  
								   <td>`+(val['status_pekerjaan']   == null ? '': val['status_pekerjaan'])+`</td>
                          	 <td>`+(val['status_pembayaran'] == null ? '': val['status_pembayaran'])+`</td>
                              
								   <td>`+(val['nilai_kontrak'] == null ? '': val['nilai_kontrak'])+`</td>
								   <td>`+(val['nilai_kontrak'] == null ? '': val['nilai_kontrak'])+`</td>
								   <td>`+(val['pelaksana_pekerjaan'] == null ? '': val['pelaksana_pekerjaan'])+`</td>
								
                            <td>`+(val['start_time'] == null ? '': val['start_time'])+`</td>
								   <td>`+(val['end_time'] == null ? '': val['end_time'])+`</td>
								   <td>
                              ${btn}
                          </td>
							   </tr>`;
			 });
			 // <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="Delete(`+val['idmenu']+`)"><i class="fa fa-trash"></i></button>
			 $('#tabel-data > tbody:last-child').html(header_table);
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
 $('#m-modal').find('.modal-title').html('Tambah Opex Baru');   
 $('#m-modal').find('form').attr('onsubmit','return SaveData(this)');
}


	function EditData(id){
      // show();
      $('#m-modal').modal('show');
      $('#m-modal').find('.modal-title').html('Edit Data');   
      $('#m-modal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $.ajax({
               url: "<?=base_url()?>monitoring/EditData/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  MenuParent();
                  var json = JSON.parse(r);
                  $('#name').val(json['name']);  
                  $('#url').val(json['url']);  
                  $('#position').val(json['position']);  
                  $('#icon').val(json['icon']);  
                  $('#parent').val(json['detail']);  
               
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
         url:  "<?=base_url('monitoring/')?>SaveData/",
       
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
         url:  "<?=base_url('monitoring/')?>UpdateData/"+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
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
         url: "<?= base_url('monitoring/ProsesData/') ?>" + id,
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
         url: "<?= base_url('monitoring/DeleteData/') ?>" + id,
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

   $('body').on('change','#limitData', function() {
      
   });

   $('body').on('change','#jenis_rkap', function() {
      var id=$(this).val();
      if (id==1) {
         form_opex();

      }else{ 
         form_capex();
      }

      console.log(id);
   });

   $('body').on('change','#skema_anggaran', function() {
       var skema=$(this).val();
      if (skema =="2" ||skema =="3") {
         var btn= `
          <div class="form-group row">
                  <label class="col-sm-10 col-form-label"></label>
                  <div class="col-sm-2">
                     <a class="btn waves-effect waves-light btn-info btn-icon2" id="btn-addperangkat" onclick="AddDetail()"><i class="feather icon-plus-circle"></i></a>
                  </div>
         </div>
            <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tahun</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="Newitems[0][tahun]" id="tahun_1" >
                     
                  </div>
            </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nilai Pagu</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="Newitems[0][nilai_pagu]" id="nilai_pagu1" >
                  </div>
               </div>
         `;
          $('#btn-skema').html(btn);
      }
      console.log(skema);
   });
   function form_capex(){
      var detail=`<div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nilai PAGU</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="nilai_pagu" id="nilai_nka" >
                     
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Bulan</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="jenis_rkap"  id="jenis_rkap">
                        <option >-</option>
                           <option value="1">CAPEK</option>
                           <option value="2">OPEX</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tahun</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="tahun" id="tahun" >
                     
                  </div>
               </div>`;

     
       $('#form_detail').html(detail);
     
   }
   function form_opex(){
      var detail=  `<div class="form-group row">
                  <label class="col-sm-4 col-form-label">Klasifikasi Program</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="jenis_rkap"  id="jenis_rkap">
                        <option >-</option>
                           <option value="1">SY</option>
                           <option value="2">MY</option>
                           <option value="3">MYL</option>
                     </select>
                  </div>
         </div>
         <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Skema Anggaran</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="skema_anggaran"  id="skema_anggaran">
                        <option >-</option>
                           <option value="1">SY</option>
                           <option value="2">MY</option>
                           <option value="3">MYL</option>
                     </select>
                  </div>
         </div>
         <div id="btn-skema">
         </div>
         `;

      $('#form_detail').html(detail);
   }
   
   function AddDetail(){
       var rowCount =  $('#btn-skema').length;
      console.log(rowCount);
      var new_input = ` 
         <tr id ="act_`+rowCount+`">
            <td>
               <select class="form-control jenis" id="id_perangkatid`+rowCount+`" name="Newitems[`+rowCount+`][id_perangkat]" data-id="`+rowCount+`">
                  <option value=""></option>
                  
               </select>
            </td>
            <td>
               <input type="hidden" id="id`+rowCount+`"  style="width: 300px" name="Newitems[`+rowCount+`][id_jenismasalah]">
            </td>
            <td>
            <textarea class="form-control" id="descrpition`+rowCount+`" name="Newitems[`+rowCount+`][description]" rows="4" placeholder="Masukkan keterangan tindakan" required></textarea>
            </td>
            <td>
               <a class="btn waves-effect waves-light btn-danger btn-icon2" onclick="RemoveList('act_`+rowCount+`')"  type=""><i class="feather icon-trash"></i></a>
            </td>
         </tr>
      `;
   }
</script>
