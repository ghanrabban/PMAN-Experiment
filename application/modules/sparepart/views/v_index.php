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
                                    <a class="btn btn-primary" onclick="Upload()"><i class="fa fa-file-excel-o "></i> Upload Data</a>
                             
                                 </div>
                              </div>
                           </div>
                           <div id="complex-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-2">
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
                              <div class="col-xs-12 col-sm-12 col-sm-12 col-md-4">
                                 <div class="dataTables_length" id="complex-dt_length">
                                    <label>
                                       Filter By 
                                       <select name="complex-dt_length" aria-controls="complex-dt" class="form-control " id="jenis_perangkat">
                                          <option></option>   
                                          <option value="Consumable Part">Consumable Part</option>
                                          <option value="Sparepart">Sparepart</option>
                                       </select>
                                      
                                    </label>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-6">
                                 <div id="complex-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="complex-dt" id="srcData"></label></div>
                              </div>
                           </div>
                           <div class="row table-responsive">
                              <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                                 <thead class="thead-blue">
                                    <tr>
                                       <th class="cemter-t">Kode </th>
                                       <th class="cemter-t">Nama Barang</th>
                                       <th class="cemter-t">Katagory </th>
                                       <th class="cemter-t">Satuan</th>
                                       <th class="cemter-t">Harga</th>
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
                  <label class="col-sm-2 col-form-label">Kode Barang</label>
                  <div class="col-sm-6">
                     <input type="text" class="form-control" name="kode_barang" id="kode_barang" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Barang</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="nama_barang" id="nama_barang" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Katagory</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="katagori_barang"  id="katagori_barang">
                        <option value="SPAREPART">SPAREPART</option>
                        <option value="CONSUMABLE PART">CONSUMABLE PART</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Satuan</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="satuan" id="satuan" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="harga" id="harga" >
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
<div class="modal fade" id="m-uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Menambahkan File Loader</h5>
         </div>
         <form onsubmit="return UploaderData(this)">
            <div class="modal-body p-0">
               <!-- CROP PANEL -->
               <div class="crop-panel" style="display:none">
                  <div class="text-center">
                     <div class="p-4 btn-group">
                        <button type="button" onclick="cancel_crop()" class="no-otl btn btn-pill btn-sm btn-secondary"> <i class="fe fe-x"></i> Batal </button>
                     </div>
                  </div>
               </div>
               <!--/ CROP PANEL -->
               <div class="image_picker" onclick="$('#inputFile').click()">
                  <div> <i class="fa fa-fw fa-cloud-upload"></i> <br>
                     Klik untuk memilih file <br> Atau seret dan lepaskan file loader disini 
                  </div>
               </div>
               <input id="inputFile" name="filelampiran" type="file" class="d-none" onchange="setUploader(this)" accept=".xls,.xlsx"/>
               <div class="p-4" id="input_group" style="display:none">
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="row">
                       
                           <label class="col-sm-2 control-label">File</label>
                           <div class="col-sm-8">
                              <input type="text" readonly class="form-control" placeholder="File" id="name_file">
                              <div class="btn-group mt-s ">
                                 <button type="button" onclick="$('#inputFile').click()" class="btn btn-sm btn-info no-otl"><i class="fa fa-folder-o fa-fw"></i><span class="sm-hide">Pilih File</span> </button>
                                 <button type="button" onclick="remove_photo()" class="btn btn-sm btn-warning no-otl"><i class="fa fa-trash fa-fw"></i> <span class="sm-hide">Delete File</span> </button>
                              </div>
                           </div>
                        
                        </div>
                        
                     </div>
                     
                     <br>
                  </div>
                 
                 
                 
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>

function remove_photo(){
   $dropzone.fadeIn(300); $('#input_group').hide(0); $('input:file').val('');
   file_exist = false; $('.part-1').addClass('dizabled');
}

var $dropzone = $('.image_picker'),
          $dropinput = $('#inputFile'),
          $dropimg = $('.image_preview');

      $dropzone.on('dragover', function() {
        $dropzone.addClass('dropping');
        return false;
      }).on('dragend dragleave', function() {
        $dropzone.removeClass('dropping');
        return false;
      });
FilterData();
function FilterData(id){
	show();
   var formData = new FormData();
      formData.append('limit',  $('#limitData').val());
      formData.append('src',  $('#srcData').val());
      var jenis =($('#jenis_perangkat').val() == null ? '': $('#jenis_perangkat').val());
      formData.append('jenis_perangkat',  jenis);
      var id =(id == null ? 0: id);
	$.ajax({
		  url: "<?=base_url('sparepart')?>/LoadData/"+id,
		  type: 'post',
		  data: formData,
		  contentType: false,
		  processData: false,

		  success: function(r){
			 var json = JSON.parse(r);
			 var header_table = "";
			 var pag= "";
			 jQuery.each(json['data'], function( i, val ) {
				var row = "";
				header_table +=`<tr >
								 
								  <td>`+val['kode_barang']+`</td>
								  <td>`+(val['nama_barang'] == null ? '': val['nama_barang'])+`</td>
                          <td>`+(val['katagori_barang'] == null ? '': val['katagori_barang'])+`</td>
								  <td>`+(val['satuan'] == null ? '': val['satuan'])+`</td>
								  <td>`+(val['harga'] == null ? '': val['harga'])+`</td>
								  <td>
									 <button class="btn waves-effect waves-light btn-primary btn-icon" onclick="EditData(`+val['id_barang']+`)"><i class="feather icon-edit"></i></button>
									 
									 <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_barang']+`,'delete')"><i class="fa fa-trash"></i></button>
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
 MenuParent();

}


	function EditData(id){
      // show();
      $('#m-modal').modal('show');
      $('#m-modal').find('.modal-title').html('Edit Data');   
      $('#m-modal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $.ajax({
               url: "<?=base_url()?>sparepart/EditData/"+id,
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
         url:  "<?=base_url('sparepart/')?>SaveData/",
       
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
         url:  "<?=base_url('sparepart/')?>UpdateData/"+id,
       
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
         url: "<?= base_url('sparepart/ProsesData/') ?>" + id,
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
         url: "<?= base_url('sparepart/DeleteData/') ?>" + id,
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

   function Upload(){
      // show();
      $('#m-uploader').modal('show');
      $('#m-uploader').find('.modal-title').html('Upload Data User');   
      $('#m-uploader').find('form').attr('onsubmit','return UploadData(this)');
   
    }

    function UploadData(f){
      show();
      var formData = new FormData($(f)[0]);
      $.ajax({
         url:  '<?=base_url('sparepart/')?>LoaderSparepart/',
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function setUploader(input){
        if (!window.FileReader) {
          alert('Browser yang Anda gunakan tidak support fitur ini.');
        }else{
          if(input.files && input.files[0]){
            if(input.files[0].type.match('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')){
                  $dropzone.hide(); $('#input_group').show(300);
                $dropzone.removeClass('dropping');
                $('.dizabled').removeClass('dizabled');

                var reader = new FileReader();
                reader.onload = function(event){
                  file_data = event.target.result;
                  $dropimg.css('background-image', 'url(' + event.target.result + ')');

                  reader.src = event.target.result;
                };
               
                $('#name_file').val(input.files[0].name);
               //  $('#m-uploader').find('input:text').val(input.files[0].name);
                reader.readAsDataURL(input.files[0]);

                file_exist = false;
            }else{
              alert("Format file tidak valid"+input.files[0].type);
            }
           
          }
        }

   }

   $('body').on('change','#limitData', function() {
      FilterData();
   });

   $('body').on('change','#jenis_perangkat', function() {
      FilterData();
   });

   $( "#srcData" ).on( "keyup", function() {
      FilterData();
   
   } );
</script>
