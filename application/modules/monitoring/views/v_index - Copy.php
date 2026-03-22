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
                                       <th rowspan="2">Nama Pekerjaan</th>
                                       <th  rowspan="2">Status Pekerjaan</th>
                                       <th  rowspan="2">Status Pembayaran</th>
                                       <th  rowspan="2">Nilai Kontrak</th>
                                       <th  rowspan="2">Pelaksana Pekerjaan</th>
                                       <th  colspan="2">Periode</th>
                                       <th  rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                       <th class="tg-0lax">Waktu Mulai</th>
                                       <th class="tg-0lax">Waktu Selesa</th>
                                    </tr>
                                    </thead>
                                 <tbody>
                                 <tr>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                 </tr>
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
               <!-- <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jenis Pekerjaan</label>
                  <div class="col-sm-8">
                     <select class="form-control" name="id_jenispekerjaan"  id="id_jenispekerjaan">
                        <option value="Investasi">Investasi</option>
                        <option value="Explotasi">Explotasi</option>
                     </select>
                  </div>
               </div> -->
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
                  <label class="col-sm-4 col-form-label">Nama Pekerjaan</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tahun Pekerjaan</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="tahun_pekerjaan" id="tahun_pekerjaan" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Status Pekerjaan/Document</label>
                  <div class="col-sm-8">
                     
                     <input type="hidden" id="status_pekerjaan" style="width: 300px" name="status_pekerjaan"  />
                    
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Status Pembayaran</label>
                  <div class="col-sm-8">
                     <input type="hidden" id="status_pembayaran" style="width: 300px" name="status_pembayaran"  />
                    
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nilai Kontrak</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" name="nilai_kontrak" id="nilai_kontrak" >
                    
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pelaksana Pekerjaan</label>
                  <div class="col-sm-8">
                        <input type="hidden" id="pelaksana_pekerjaan" style="width: 300px" name="pelaksana_pekerjaan"  />
                    
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nilai NKA</label>
                  <div class="col-sm-8">
                   
                     <input type="text" class="form-control" name="nilai_nka" id="nilai_nka" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Tanggal Pelaksanaan Pekerjaan </label>
               </div>
               <div class="form-group row">
                  <div class="col-md-8">
                     <div class="row">
                        <label class="col-sm-6 col-form-label">Mulai:</label>
                           <div class="col-sm-6">
                              <div class="input-group">
                                 <input type="date" class="form-control" id="start_time" name="start_time">
                                 <div class="input-group-append">
                                    <span> - </span>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
                  <div>
                     <div class="row">
                        <label class="col-sm-4 col-form-label">Selesai:</label>
                           <div class="col-sm-8">
                              <div class="input-group">
                                 <input type="date" class="form-control" id="end_time" name="end_time">
                                 <div class="input-group-append">
                                    <span> - </span>
                                 </div>
                              </div>
                           </div>
                        </div>
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
function FilterData(){
	show();
  
	$.ajax({
		  url: "<?=base_url('monitoring')?>/LoadData",
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
 $('#m-modal').find('.modal-title').html('Tambah Data Baru');   
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

   var lastResults = [];
   $("#pelaksana_pekerjaan").select2({
      multiple: false,
      placeholder: "Pelaksana Pekerjaan",
      ajax: {
            url:  "<?= base_url('monitoring/GetPelaksana/') ?>",
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
      initSelection: function (element, callback) {
        var data = [];
   
        $(element.val().split(",")).each(function () {
          data.push({
            id: this,
            text: this
          });
        });
   
        callback(data);
        ;
      },
      createSearchChoice: function (term) {
        var text = term + (lastResults.some(function (r) {
          return r.text == term
        }) ? "" : " (new)");
        return {
          id: term,
          text: text
        };
      },
    });
   
    $("#status_pekerjaan").select2({
      multiple: false,
      placeholder: "Status Pekerjaan",
      ajax: {
            url:  "<?= base_url('monitoring/GetstatusPekerjaan/') ?>",
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
      initSelection: function (element, callback) {
        var data = [];
   
        $(element.val().split(",")).each(function () {
          data.push({
            id: this,
            text: this
          });
        });
   
        callback(data);
        ;
      },
      createSearchChoice: function (term) {
        var text = term + (lastResults.some(function (r) {
          return r.text == term
        }) ? "" : " (new)");
        return {
          id: term,
          text: text
        };
      },
    });
    
    $("#status_pembayaran").select2({
      multiple: false,
      placeholder: "Status Pembayaran",
      ajax: {
            url:  "<?= base_url('monitoring/GetstatusPembayaran/') ?>",
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
      initSelection: function (element, callback) {
        var data = [];
   
        $(element.val().split(",")).each(function () {
          data.push({
            id: this,
            text: this
          });
        });
   
        callback(data);
        ;
      },
      createSearchChoice: function (term) {
        var text = term + (lastResults.some(function (r) {
          return r.text == term
        }) ? "" : " (new)");
        return {
          id: term,
          text: text
        };
      },
    });
   
</script>
