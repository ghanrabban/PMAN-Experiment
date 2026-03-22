<style>
.sigWrapper {
    width: 100%;
}

#sign-pad {
    width: 100%;
    height: 250px; /* tinggi default, bisa diubah */
    border: 1px dashed #ccc;
    background: #fff;
    touch-action: none; /* penting untuk HP */
}
/* ===== AREA TANDA TANGAN ===== */
.ttd-box {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;      /* CENTER horizontal */
    text-align: center;
    font-size: 14px;
}

.ttd-title {
    font-weight: bold;
    margin-bottom: 25px;
}

/* Wrapper gambar agar selalu di tengah */
.ttd-img-wrap {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Gambar TTD */
.ttd-img {
    max-height: 70px;
    max-width: 180px;
    object-fit: contain;
}

/* Garis & nama */
.ttd-nama {
    width: 200px;
    border-top: 1px solid #000;
    margin-top: 5px;
    padding-top: 5px;
    font-weight: 600;
    text-align: center;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .ttd-img {
        max-width: 150px;
    }
}

/* ===== PRINT / PDF SAFE ===== */
@media print {
    .ttd-box {
        page-break-inside: avoid;
    }
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
                        <table class="table table-condensed table-striped table-bordered" id="tabel-data">
                              <thead class="thead-blue">
                                 <tr>
                                    <th class="cemter-t">No</th>
                                    <th class="cemter-t">Tanggal</th>
                                    <th class="cemter-t">Shift</th>
                                    <th class="cemter-t">Jumlah Tinjutan</th>
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
                           <th>No</th>
                           <th>Waktu</th>
                           <th>Lokasi</th>
                           <th>Masalah</th>
                           <th>Penyelesaian</th>
                        </tr>
                     </thead>
                     <tbody >
                     </tbody>
                  </table>
               </div>
            </div>
            
             <div class="row">
               <div class="col-md-6">
                  <div class="ttd-box">
                     <div class="ttd-title">Mengetahui</div>
            
                     <!-- Gambar TTD -->
                     <div class="ttd-img-wrap"  >
                        <img src="" class="ttd-img" id="sig_og">
                     </div>
            
                     <div class="ttd-nama" ><span id="name_og"></span></div>
                  </div>
               </div>
            
               <div class="col-md-6">
                  <div class="ttd-box">
                     <div class="ttd-title">Pelaksana</div>
            
                     <!-- Gambar TTD -->
                     <div class="ttd-img-wrap" id="sig_om">
                        <img src="" class="ttd-img" >
                     </div>
            
                     <div class="ttd-nama" ><span id="name_om"></span></div>
                    
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="m-sig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form onsubmit="return SaveGroup(this)">
            <div class="modal-body">
               <div id="signArea" >
                  <h2 class="tag-ingo">Put signature below,</h2>
                  <div class="row">
                      <div class="col-md-7 offset-md-3">
                           <div class="sig sigWrapper" style="height:auto;">
                             <div class="typed"></div>
                             <!-- <canvas class="sign-pad" id="sign-pad" ></canvas> -->
                            <canvas class="sign-pad" id="sign-pad"></canvas>
                          </div>   
                      </div>
                  </div>
                  
                  <div class="modal-footer ">
                     <a href="#clear" class="btn btn-secondary clearButton" >Reset</a>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>


<link href="<?=base_url()?>assets/sig/css/jquery.signaturepad.css" rel="stylesheet">
<script src="<?=base_url()?>assets/sig/js/numeric-1.2.6.min.js"></script> 
<script src="<?=base_url()?>assets/sig/js/bezier.js"></script>
<script src="<?=base_url()?>assets/sig/js/jquery.signaturepad.js"></script> 

<script type='text/javascript' src="<?=base_url()?>assets/sig/js/html2canvas.js"></script>
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
            url: "<?=base_url()?>approvalCM/LoadTiket/",
            type: 'post',
          
            contentType: false,
            processData: false,

            success: function(r){
                var json = JSON.parse(r);
                var row = "";
                var no =1;
              jQuery.each(json, function (i, val) {
                  var BTN ='';
                  var waitingButton = `<button class="btn waves-effect waves-light btn-info btn-icon" title="Send Request" onclick="Waiting(` + val['id_tiket'] + `)"><i class="fa fa-check-circle"></i></button>`;
                  //var approveButton = '<button class="btn waves-effect waves-light btn-warning btn-icon" title="Approve" onclick="Approve(' + val['id_tiket'] + ')"><i class="fa fa-check"></i></button>';
                  var editButton    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Edit" onclick="EditData(`+ val['id_tiket'] +`)"><i class="feather icon-edit"></i></button>`;
                  var rejectButton  = `<button class="btn waves-effect waves-light btn-danger btn-icon" title="View" onclick="Reject(`+ val['id_tiket'] + `)"><i class="feather icon-slash"></i></button>`;
                  var appove        = `<button class="btn waves-effect waves-light btn-success btn-icon" title="View" onclick="Approve(`+ val['id_tiket'] + `)"><i class="feather icon-check-circle"></i></button> `;
                  var viewData      = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="View" onclick="ViewData(`+ val['id_tiket'] + `)"><i class="feather icon-eye"></i></button>`;
                  var prosesData    = `<button class="btn waves-effect waves-light btn-primary btn-icon" title="Proses Data" onclick="ConfirmData(`+ val['id_tiket'] +`,'proses')"><i class="fa fa-gear"></i></button>`;
                  var delBtn        = `<button class="btn waves-effect waves-light btn-danger btn-icon" onclick="ConfirmData(`+val['id_tiket']+`,'delete')"><i class="fa fa-trash"></i></button>`;
                  var print         = '<a href="<?=base_url()?>tiket/PrintTiket/' + val['id_tiket'] + '" target="_blank" class="btn waves-effect waves-light btn-primary btn-icon"><i class="fa fa-print"></i></a>';
                  // Tambahkan kondisi untuk menyembunyikan tombol Waiting jika status sudah diapprove
                  if (val['status'] === '1') {
                     BTN = viewData+appove+rejectButton;
                  }else {
                       BTN = viewData;
                  }
                  row += `<tr>
                     <td>${no}</td>
                     <td>${val['tanggal_label'] || ''}</td>
                      <td>${val['shift_label'] || ''}</td>
                      <td>${val['jumlah'] || ''}</td>
                     <td>${val['label_status'] || ''}</td>
                     <td>
                           ${BTN}
                           
                     </td>
                  </tr>`;
                  no++;
               });
           
               $('#tabel-data > tbody:last-child').html(row);
               hide();
              //console.log(row);
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

   

   function Reject(id) {
      $('#confirmModal').modal('show');
      $('#confirmModal').find('.modal-body').html('Apakah anda yakin akan menyetujui work order nomor ' +id+ ' tersebut ?');

      // Fungsi untuk mengeksekusi delete jika tombol "Ya" ditekan
      $('#btnConfirm').click(function() {
         $.ajax({
            url: "<?=base_url()?>approvalCM/ProsesReject/"+id,
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
    $('#m-detail').find('.modal-title').html('View Detail Tiket');

    // 🔄 RESET TTD (penting)
    $('#name_om').html('( Teknisi )');
    $('#sig_om').html('');
    $('#name_og').html('( Supervisor )');
    $('#sig_og').html('');

    $.ajax({
        url: "<?=base_url()?>tiket/ViewData/" + id,
        type: 'post',
        dataType: 'json',
        success: function(json){

            // ==== DATA HEADER ====
            $('#v_tanggal').html(json.data.tanggal);
            $('#v_shift').html(json.data.shift_l.name);
            $('#v_team').html(json.data.team);
            $('#v_jam').html(json.data.shift_l.jam);

            // ==== PELAKSANA ====
            let ol = '';
            $.each(json.data.pelaksana, function(i, val){
                ol += `<li>${val}</li>`;
            });
            $('#v_pelaksana').html(ol);

            // ==== DETAIL TABEL ====
            let row = '';
            let no = 1;
            $.each(json.data.detail, function(i, val){
                row += `
                    <tr>
                        <td>${no++}</td>
                        <td>${val.waktu}</td>
                        <td>${val.nama_terminal}</td>
                        <td>${val.nama_masalah}</td>
                        <td>${val.penyelesaian}</td>
                    </tr>`;
            });
            $('#tabel-ViewDetail tbody').html(row);

            // ==== TTD OM ====
            if (json.data.sig_om && json.data.sig_om.file_name) {
                $('#name_om').html(json.data.sig_om.nama);
                $('#sig_om').html(
                    `<img src="<?=base_url()?>${json.data.sig_om.file_name}" class="ttd-img">`
                );
            }else {
                // ❗ jika kosong
                $('#sig_om').hide();
            }

            // ==== TTD ORGANIK / TEKNISI ====
            if (json.data.sig_organik && json.data.sig_organik.file_name) {
                $('#name_og').html(json.data.sig_organik.nama);
                $('#sig_og').attr(
                    'src',
                    '<?=base_url()?>' + json.data.sig_organik.file_name
                ).show();
            } else {
                // ❗ jika kosong
                $('#sig_og').hide();
            }
        },
        error: function(){
            alert('Gagal mengambil data');
        }
    });

    return false;
}
   

    $(document).ready(function() {
    $('.js-example-basic-single').select2({
        theme: 'bootstrap',
        dropdownCssClass: 'select2-dropdown--scroll'
    });
   });

    var sig = 	$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:500});
    
    function Approve(id) {
           
          
           
        $('#m-sig').modal('show');
        $('#m-sig').find('.modal-title').html('TTD Modal');   
        $('#m-sig').find('form').attr('onsubmit','return SaveTTD(this,\''+id+'\')');
      
    }
    
   
   
    var sigPad;
    var canvas;

function resizeCanvas() {
    canvas = document.getElementById('sign-pad');
    var wrapper = canvas.parentElement;

    // Ambil ukuran wrapper
    var width = wrapper.offsetWidth;
    var height = 250;

    // Set ukuran REAL canvas (bukan CSS saja)
    canvas.width  = width;
    canvas.height = height;

    // Re-init signature pad
    if (sigPad) {
        sigPad.clearCanvas();
    }

    sigPad = $('#signArea').signaturePad({
        drawOnly: true,
        drawBezierCurves: true,
        lineTop: height + 10
    });
}

$(document).ready(function () {
    // Saat modal dibuka
    $('#m-sig').on('shown.bs.modal', function () {
        setTimeout(resizeCanvas, 200);
    });

    // Saat layar di-resize
    $(window).on('resize', function () {
        if ($('#m-sig').hasClass('show')) {
            resizeCanvas();
        }
    });

    // tombol reset
    $('.clearButton').on('click', function (e) {
        e.preventDefault();
        if (sigPad) sigPad.clearCanvas();
    });
});

function SaveTTD(f, id) {

         
    var btn = $(f).find('button[type="submit"]');
    btn.prop('disabled', true).text('Saving...');

    html2canvas(document.getElementById('sign-pad'), {
        onrendered: function (canvas) {

            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/png;base64,/, "");

            $.ajax({
                url: '<?=base_url('approvalCM/')?>ProsesApprove/'+id,
                type: 'POST',
                dataType: 'json',
                data: {
                    img_data: img_data,
                    id: id
                },
                success: function (res) {

                    // ✅ Tutup modal
                    $('#m-sig').modal('hide');

                    // ✅ Clear canvas
                    if (typeof sigPad !== 'undefined') {
                        sigPad.clearCanvas();
                    }

                    // ✅ Reset tombol
                    btn.prop('disabled', false).text('Save changes');

                    // ✅ Optional reload data tanpa refresh halaman
                   
                    
                    console.log(res);
                    FilterData();
                    NF(res);
                },
                error: function () {
                    alert('Gagal menyimpan tanda tangan');
                    btn.prop('disabled', false).text('Save changes');
                }
            });
        }
    });

    return false; // ⛔ cegah submit default
}

</script>