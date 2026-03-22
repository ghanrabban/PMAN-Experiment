
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
                                       <th class="cemter-t">Nama Catagory Fasilitas </th>
                                       <th class="cemter-t">Unit </th>
                                       <th class="cemter-t">Status</th>
                                       <th class="cemter-t">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="Data-AP">
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
<div class="modal fade" id="m-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                   <label class="col-sm-2 col-form-label">Nama Catagory Fasilitas</label>
                   <div class="col-sm-6">
                      <input type="text" class="form-control" name="nama" id="nama" >
                   </div>
                </div>
                
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Unit</label>
                   <div class="col-sm-10">
                      <select class="form-control" name="id_unit"  id="id_unit">
                         <option value=""></option>
                      </select>
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


<script>
   var start = "";
   var end = "";
   
      function show () {
         $("#spinner").addClass("show");
      
      }
      function hide () {
         $("#spinner").removeClass("show");
      }
      FilterData();
    
      function FilterData(){
         show();
       
         $.ajax({
               url: "<?=base_url()?>fasilitas_catagory/LoadData",
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  var json = JSON.parse(r);
                  var header_table = "";
                  var pag= "";
                  jQuery.each(json['ms'], function( i, val ) {
                     var row = "";
                     header_table +=`<tr >
                                      
                                       <td>`+val['nama']+`</td>
                                        <td>`+(val['nama_unit'] == null ? '': val['nama_unit'])+`</td>
                                       <td>`+(val['status'] == null ? '': val['status'])+`</td>
                                       
                                       <td>
                                          <button class="btn waves-effect waves-light btn-primary btn-icon" onclick="EditData(`+val['id_catagory']+`)"><i class="feather icon-edit"></i></button>
                                          
                                          <button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_catagory']+`, 'delete')"><i class="fa fa-trash"></i></button>
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
      $('#m-menu').modal('show');
      $('#m-menu').find('.modal-title').html('Tambah Catagory Fasilitas');   
      $('#m-menu').find('form').attr('onsubmit','return SaveData(this)');
      LoadUnit();

    }

    function EditData(id){
      // show();
      $('#m-menu').modal('show');
      $('#m-menu').find('.modal-title').html('Edit Menu');   
      $('#m-menu').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      LoadUnit();
      $.ajax({
               url: "<?=base_url()?>fasilitas_catagory/EditData/"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                
                  var json = JSON.parse(r);
                  $('#nama').val(json['nama']);  
                  $('#id_unit').val(json['id_unit']);  
               
               }, error: function(){
                  hide ();
               }
         });   
         return false;
    }


    function UpdateData(f,id){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  '<?=base_url('fasilitas_catagory/')?>Update/'+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            $(f)[0].reset(); 
            $('#m-menu').modal('hide');
           FilterData();
           NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  '<?=base_url('fasilitas_catagory/')?>SaveData/',
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            // $(f)[0].reset(); 
            // $('#MasterIndikator').modal('hide');
            $('#m-menu').modal('hide');
          
           FilterData();
            // ViewDetail(id,date);
            NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }


   function LoadUnit(){

      $.ajax({
            url: "<?=base_url()?>unit/ListData",
            type: 'post',
            // data: formData,
            contentType: false,
            processData: false,

            success: function(r){
               var json = JSON.parse(r);
               var row = "";
               jQuery.each(json, function( i, val ) {
                  
                  row +=`<option value="`+val['id_unit']+`">`+val['kode_unit']+`</option>`;
               });
            
               $('#id_unit').html(row);
               hide ();
            }, error: function(){
               hide ();
            }
      });   
      return false;
      }

      function DeleteData(id) {
    
         $.ajax({
            url: '<?=base_url('fasilitas_catagory/')?>Delete/' + id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function (r) {
               var json = JSON.parse(r);
               NF(json);
               FilterData();  
            },
            error: function (xhr, status, error) {
               
                  window.location.href = "<?=site_url('Unit/index')?>";
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
</script>