
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
               <h3><?=$title?></h3>
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
            <form onsubmit="return FilterData()" method="post">
               <div class="form-group row">
                  <div class="col-md-9">
                     <input class="form-control" type="text" id="contohSearch" name="keyword" placeholder="cari id tiket atau nama fasilitas">
                  </div>
                  <div class="col-md-2">
                     <button class="btn btn-primary" type="submit">Cari</button>
                  </div>
               </div>
            </form>
            <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <div class="card-block">
                        <table class="table table-responsive table-condensed table-striped table-bordered" id="tabel-data1">
                           <thead class="thead-blue">
                              <tr>
                                    <th class="cemter-t">No</th>
                                    <th class="cemter-t">Tanggal</th>
                                    <th class="cemter-t">shift</th>
                                    <th class="cemter-t">Pelaksana</th>
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


<div class="modal fade" id="ModalApprove" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header warnaBarisAwal">
        <h4 class="modal-title text-center cemter ">Notifikasi</h4>
      </div>
      <div class="modal-body modal-title text-center fw-semibold fs-3">
        Berhasil diapprove
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Approve()">YA</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="ModalReject" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header warnaBarisAwal">
        <h4 class="modal-title text-center">Notifikasi</h4>
      </div>
      <div class="modal-body modal-title text-center fw-semibold fs-3">
        Berhasil direject
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header warnaBarisAwal">
            <h5 class="modal-title" id="confirmModalLabel">Notifikasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-primary" id="btnConfirm">Ya</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="m-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group row">
               <label class="col-sm-4 col-form-label">Hari/Tanggal</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_tanggal">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Shift Kerja</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_shift">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Team</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_team">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Lokasi</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_lokasi">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Jam Mulai</label>
               <span class="col-md-8 f-w-700 ct-l" id="v_jam">aaasd asd sad</span>
            </div>
            <div class="form-group row">
               <label class="col-md-4 col-form-label">Pelaksana Pekerjaan </label>
               <ol id="v_pelaksana">
               </ol>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-condensed table-striped" id="tabel-ViewDetail">
                     <thead>
                        <tr>
                           <th>NO</th>
                           <th>Lokasi</th>
                           <th>Fasilitas</th>
                           <th>Pengecekan</th>
                           <th>Kondisi</th>
                           <th>Catatan</th>
                           <th>Dokumentasi</th>
                        </tr>
                     </thead>
                     <tbody >
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>



<script>
  
      
   function show () {
      $("#spinner").addClass("show");
   }
   function hide () {
      $("#spinner").removeClass("show");
   }

   
   FilterData();

    function FilterData(){
      show();
      //var x = document.getElementById("contohSearch");
      
        $.ajax({
            url: "<?=base_url().$modul?>/LoadData/",
            type: 'post',
          
            contentType: false,
            processData: false,

            success: function(r){
                var json = JSON.parse(r);
                var row = "";
                var no =1;
                jQuery.each(json, function( i, val ) {
                     var rejectBtn     =`<a class="btn btn-danger" onclick="Reject(`+val['id_storingwo']+`)"><i class="feather icon-slash"></i> </a>`;
                     var viewBtn       =`<a class="btn btn-success" onclick="ViewData(`+val['id_storingwo']+`)"><i class="feather icon-eye"></i> </a>`;
                     var ApproveBtn    =` <a class="btn btn-primary" onclick="Approve(`+val['id_storingwo']+`)"><i class="feather icon-check-circle"></i> </a>`;
                     
                     if (val['status'] ==="1") {
                        actBtn=ApproveBtn+viewBtn+rejectBtn;
                     }else{
                        actBtn=viewBtn;
                     }
                             
                            
                     
                      row +=`<tr >
                                       <td class="center">`+(no++)+`</td>
                                       <td class="center">`+val['tanggal']+`</td>
                                       <td class="center">`+val['shift']+`</td>
                                       <td class="center">`+val['pelaksana']+`</td>
                                       <td class="center">`+val['label_status']+`</td>
                                       <td class="center">
                                          ${actBtn}  
                                            
                                       </td>
                              </tr>`;   
                });
                $('#Data-AP').html(row);
               hide ();
            }, error: function(){
               hide ();
            }
        });
                
            return false;
    }

   function ResponseApprove(){
      show();
      $('#ModalApprove').modal('show');
      //$('#ModalApprove').find('.modal-title').html('Berhasil diapprove');

   }


   function ResponseReject(){
      show();
      $('#ModalReject').modal('show');
      //$('#ModalApprove').find('.modal-title').html('Berhasil direject');
   }

   function Approve(id) {
      $('#confirmModal').modal('show');
      $('#confirmModal').find('.modal-body').html('Apakah anda yakin akan menyetujui work order nomor ' +id+ ' tersebut ?');

      // Fungsi untuk mengeksekusi delete jika tombol "Ya" ditekan
      $('#btnConfirm').click(function() {
         $.ajax({
            url: "<?=base_url().$modul?>/ProsesApprove/"+id,
            type: 'post',

            success: function(r) {
               var json = JSON.parse(r);
               NF(json);
               $('#confirmModal').modal('hide');
                FilterData();
              
            },
            error: function() {
                // Handle error
            }
        });
      });

    return false;
}

   function Reject(id) {
      $('#confirmModal').modal('show');
      $('#confirmModal').find('.modal-body').html('Apakah anda yakin akan menyetujui work order nomor ' +id+ ' tersebut ?');

      // Fungsi untuk mengeksekusi delete jika tombol "Ya" ditekan
      $('#btnConfirm').click(function() {
         $.ajax({
            url:"<?=base_url().$modul?>/ProsesReject/"+id,
            type: 'post',

            success: function(r) {
               $('#confirmModal').modal('hide');
                FilterData();
                ResponseReject();
            },
            error: function() {
                // Handle error
            }
        });
      });
    

    return false;
}


   function previewImage(imageUrl) {
      // Buat elemen modal
      var modal = document.createElement('div');
      modal.className = 'image-preview-modal';
    
      // Buat elemen gambar dalam modal
      var modalContent = document.createElement('img');
      modalContent.src = imageUrl;
    
      // Tambahkan gambar ke dalam modal
      modal.appendChild(modalContent);
    
      // Tambahkan modal ke dalam body
      document.body.appendChild(modal);
    
      // Tambahkan event listener untuk menutup modal saat gambar di-klik
      modal.addEventListener('click', function() {
      document.body.removeChild(modal);
    });
}


  function ViewData(id){
   
      $('#m-detail').modal('show');
      $('#m-detail').find('.modal-title').html('View Detail Storing');   
   
      $.ajax({
         url: "<?=base_url('storing/')?>/ViewDataWO/"+id,
         type: 'post',
         success: function(r){
      
               var json = JSON.parse(r);
               $('#v_tanggal').html(json['data']['tanggal']);
               $('#v_shift').html(json['data']['shift_l']['name']);
               $('#v_team').html(json['data']['team']);
               $('#v_lokasi').html('');
               $('#v_jam').html(json['data']['shift_l']['jam']);
              
               var ol = '';
               jQuery.each(json['data']['pelaksana'], function( i, val ) {
                  ol +=   `<li>`+val+`</li>`;
               });
               $('#v_pelaksana').html( ol);// 
   
               var row='';
               var no=1;
               jQuery.each(json['data']['detail'], function( i, val ) {
                  var img ='';
                  jQuery.each(val['dokumentasi'], function( ii, vall ) {
                     img +=`<img src="<?=base_url()?>/upload/storing/${vall['name_file']}" width="100" height="100" onclick="PrevieImage('http://localhost/pm_fids/./upload/WhatsApp_Image_2025-02-11_at_12_08_301.jpeg')">`;
                  });
                  jQuery.each(val['ceklist'], function( ii, vall ) {
                     if (ii == 0) {
                         row +=   `<tr>
                              <td rowspan="2">${no}</td>
                              <td rowspan="2">`+val['fasilitas']+`</td>
                              <td rowspan="2">`+val['terminal']+`</td>
                              <td >`+vall['nama_pekerjaan']+`</td>
                              <td >`+vall['kondisi']+`</td>
                              <td rowspan="2">${val['catatan']}</td>
                              <td rowspan="2">${img}</td>
                           </tr>
                           `;
             
                     }else{
                           row +=   `<tr>
                             <td >`+vall['nama_pekerjaan']+`</td>
                              <td >`+vall['kondisi']+`</td>
                           </tr>`;
                     }
                  });
                  no++;
                 
               });
               
               $('#tabel-ViewDetail > tbody:last-child').html(row);
               //console.log(row);
                // LoadFasilits(json['id_fasilitas']);
         },
         error: function(){
               hide();
         }
      });
   
   
      return false;
   }



</script>