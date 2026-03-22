<!DOCTYPE html>
<html>
<head>
<title><?=$title?></title>
  <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet" > -->
  <link rel="shortcut icon" type="image/x-icon" href="./assets/icons/icon.png" />
  <style>
   .page-break{
      page-break-after:always;
   } 
    body { 
      font-size: 1.07rem;
      font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
      padding: 0% 3% 0% 3%;
       max-width: 100%;
    }
    
    .body-info{
      -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;

    }
    .body-isi{
       -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-md-5 {
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }
    .offset-md-7 {
        margin-left: 58.333333%;
    }
    .col-md-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-md-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%
    }
    .col-md-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%
    }
    .col-md-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%
    }
       .mb-1, .my-1 {
        margin-bottom: .25rem!important;
      }
      .mb-0, .my-0 {
      margin-bottom: 0!important;
      margin-top: 0!important;
      }
    
      .kop_surat{
       overflow: auto;
       text-align: center;
      }
      
      .img2 {
         max-width: 35%;
        float: right;
        margin-left: 1%;
        padding-right: 10px;
      }
      .img-dok {
        max-width: 100%;
        float: center;
        margin-left: 1%;
       
      }
      .img-left {
         max-width: 45%;
        float: left;
        margin-left: 1%;
        padding-right: 10px;
      }
      .img-right {
         max-width: 45%;
        float: right;
        margin-left: 1%;
        padding-right: 10px;
      }
      .pull-left {
       
           overflow: auto;
        width: 49%;
        float: left;
        /*
        width: 40%;
          float: left !important;
          */
      }
      .pull-right {
           overflow: auto;
        width: 45%;
        float: right;
      }

   
      .tepi-kiri{
        padding-left: 95px;
      }
      .tepi-kiri-waktu{
        padding-left: 5px;
      }
      .tepi-atas{
         padding-top:15px;
      }
      .under { 
        text-decoration: underline; 
         padding-top:75px;
      }
      .justify{
        text-align: justify;
      }
      .tulisan_tengah{
        text-align: center;
      }
      .tab-kiri {
        text-indent: 40px;
        
      }
      .jarak-bawah{
        margin-bottom: 1rem!important;
      }
      .tab-kepada{
         padding-left: 30%;
      }
      .tanggal-surat{
        text-align: right;
        padding-right: 11%;
      }
      hr.onepixel {
          border-top: 4px solid #000;
         
          height: 0px;
          margin-bottom: 20px;
      }
      .rata-kanan{
        text-align: right;
      }
      .upper { text-transform: uppercase; }
      .bold { font-weight: bold; }
     /*Baru*/
    * {
      box-sizing: border-box;
    }
    .column {
     
      float: left;
      padding: 0px 0px 0px 0px;
      
    }
    .left {
      width: 32%;
    }

    .middle {
        width: 2%;
    }
    .content-mail {
        width: 98%;
    }
    .right {
        width: 64%;
    }
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    p {
      display: block;
      margin-top: 0.25em;
      margin-bottom: 0.25em;
      margin-left: 0;
      margin-right: 0;
    }
  footer {
    
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 50px; 
    text-align: center; 
   
  }
           
  p.justify {
    margin-top: 0.25em;
    padding-top: 5px;
    padding-top: 5px;
    font-size: 12px;
  }
  p.alamat {
    margin-top: 0.25em;
    padding-top: 5px;
    padding-top: 5px;
    font-size: 14px;
  }
  h4.custome{
     font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 1.4rem;
    margin-top: 0;
  }
   table {
      border-collapse: collapse;
      width: 100%;
   }
   .colom4a {
      float: left;
      margin: 0;
      width: 50%;
   }
   .colom4b {
      float: right;
      margin: 0;
      width: 20%;
      padding-left: 10em;
   }
   .center {
      display: block;
         margin-left: auto;
         margin-right: auto;
         width: 50%;
   }
   p {
      font-size: 14px;
   }

   td { font-size: 14px }
   td.table-print {
    padding: 15px;
   }
   .bottom-div {
      position: fixed;
      left: 0;
      bottom: 150px;
      width: 100%;
      height: 50px; 
      text-align: center; 
   }
   </style>
  <title>1111</title>


</head>
<body>

   <div class="body-page ">
      <!-- <div class="header-surat">
         <div class="kop_surat ">
           
         </div>
      </div> -->
      <div class="row">
         <div class="pull-left ">
               <img class="img-left" src="<?=base_url()?>/assets/ap2.png" >         
         </div>
         <div class="pull-right ">
                <img class="img-right" src="<?=base_url()?>assets/asp.png" > 
         </div>
      </div>
      <p class="tulisan_tengah bold">  BERITA ACARA PERGANTIAN BARANG</p>
      <div class="body-surat">
         <div class="row">
            <p class="">
               Pada hari ini, <?=$data['terbilang'] ?>
               telah dilakukan <strong>Pergantian <?=$data['jenis']['jumlah'] ?> Unit <?=$data['jenis']['nama'] ?></strong>, dengan data sebagai berikut:
            </p> 
         </div>
         <div class="row">
            <div class="body-info">
               <p class="">  Data Monitor yang Terpasang : </p>
              
               <table class="mb-1 "  border="1 ">
                  <thead>
                     <tr class="tulisan_tengah">
                        <td class="table-print">No</td>
                        <td  class="table-print">Nama Barang</td>
                        <td  class="table-print">Jumlah</td>
                        <td  class="table-print">Serial Number</td>
                        <td  class="table-print">Lokasi</td>
                        <td  class="table-print">Keterangan</td>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data['detail'] as $key => $value) :?>
                        <tr>
                           <td  class="table-print"><?=$no?></td>
                           <td  class="table-print"><?=$value['perangkat_after']?></td>
                           <td  class="table-print">1</td>
                           <td  class="table-print"><?=$value['sn_after']?></td>
                           <td  class="table-print"></td>
                           <td  class="table-print"><?=$value['keterangan_after']?></td>
                        </tr>
                     <?php $no++; endforeach?>
                  </tbody>
               </table>
            </div>
            <div style="clear:both;"></div>
         </div>
         <div class="row">
            <div class="body-info">
               <p class="">Data Monitor yang Rusak :</p>
            
               <table class="mb-1"  border="1 ">
                  <thead>
                     <tr>
                        <td  class="table-print">No</td>
                        <td  class="table-print">Nama Barang</td>
                        <td  class="table-print">Jumlah</td>
                        <td  class="table-print">Serial Number</td>
                        <td  class="table-print">Lokasi</td>
                        <td  class="table-print">Keterangan</td>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data['detail'] as $key => $value) :?>
                        <tr>
                           <td><?=$no?></td>
                           <td><?=$value['perangkat_before']?></td>
                           <td>1</td>
                           <td><?=$value['sn_before']?></td>
                           <td></td>
                           <td><?=$value['keterangan_before']?></td>
                        </tr>
                     <?php $no++; endforeach?>
                  </tbody>
               </table>
            </div>
            <div style="clear:both;"></div>
         </div>
         <div class="row">
            <p  class="">
               Demikian berita acara pergantian barang ini dibuat, agar dapat dipergunakan sebagaimana mestinya.
            </p>
         </div>
         
      </div>
      
      <div class="footer-surat bottom-div">
         <div class="row">
            <div class="colom4a tulisan_tengah tepi-atas">
               <p class="underline "> Mengetahui, </p>
               <p class="kapital"> PT ANGKASA PURA II</p>
               <div class="row" style="height: 4em">
               <img class="img-right" src="<?=base_url()?><?=$data['sig_orgnik']?>">
               <p class="kapital">(<?=$data['ap2']?>)</p>
            </div>
            <div class="colom4a tulisan_tengah">
               <p class="underline "> Penyedia </p>
               <p class="kapital"> PT ANGKASA PURA SOLUSI</p>
               <div class="row" style="height: 4em">
                  <img class="img-right" src="<?=base_url()?><?=$data['sig_leader']?>">
               </div>
               <p class="kapital">(<?=$data['leader']?>)</p>
            </div>
         </div>
        
      </div>

   </div>
 


   <div style="clear:both;"  class ="page-break"></div>

   <div class="body-page">
      <div class="row">
         <div class="pull-left ">
               <img class="img-left" src="<?=base_url()?>/assets/ap2.png" >         
         </div>
         <div class="pull-right ">
                <img class="img-right" src="<?=base_url()?>assets/asp.png" > 
         </div>
      </div>
      <p class="tulisan_tengah bold">DOKUMENTASI PERGANTIAN BARANG</p>
    
      <div class="body-surat">
         
         <div class="row">
            <div class="body-info">
               <p  class="">
               Data Monitor yang Terpasang : 
               </p>
               
               <div class="pull-left ">
                  <table class="mb-1">
                     <tbody>
                        <tr>
                           <td valign="top">Hari – Tanggal </td>
                           <td valign="top"> : </td>
                           <td><?=Hari(date('l', strtotime($data['tanggal_pergantian'])))?>, <?=tgl($data['tanggal_pergantian'],'l')?></td>
                        </tr>
                     <tr>
                        <td valign="top">Detail Barang</td>
                        <td valign="top">:  </td>
                        <td><?=$data['jenis']['nama']?></td>
                     </tr>
                     <tr>
                        <td valign="top">Total Barang</td>
                        <td valign="top">:</td>
                        <td><?=$data['jenis']['jumlah']?></td>
                     </tr>
                     <tr>
                        <td valign="top">Lampiran</td>
                        <td valign="top">: </td>
                        <td>
                           <p class="">Hasil Dokumentasi Pergantian Barang</p>
                        </td>
                     </tr>
                  </tbody></table>
               </div>
              
            </div>
            <div style="clear:both;"></div>
         </div>
         <div class="row">
            <div class="body-info">
               <p  class="">
                  Dokumentasi Pergantian Barang : 
               </p>
               <h6></h6>
               <table class="mb-1"  border="1 ">
                  <thead>
                     <?php $no = 1;
                      foreach ($data['detail'] as $key => $value) :?>
                        <tr>
                           <td style="height:250px"  class="table-print">  
                              <img style="display:flex;" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_before'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_before'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['documentasi_before']?>" /> 
                              <p> Sebelum Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:flex;"  
                              height="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['proses_pergantian']?>" />
                              <p> Proses Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:flex;" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['sn_baru'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['sn_baru'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['sn_baru']?>" />
                              <p> SN Baru Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:flex;" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_after'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_after'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['documentasi_after']?>" />
                              <p> After Pergantian Perangkat </p>                            
                           </td>
                        </tr>
                     <?php $no++; endforeach?>
                  </thead>
                 
               </table>
            </div>
            <div style="clear:both;"></div>
         </div>
        
         
      </div>
   </div>


   <div style="clear:both;" class ="page-break"></div>
   <div class="body-page">
   
      <p class="tulisan_tengah bold">NOTA LAPORAN</p>
      
      <div class="body-surat">
         
         <div class="row">
            <div class="body-info">
              
               
               <table class="mb-1"  border="1 ">
                  <tr>
                        <td>KEPADA </td>
                        <td colspan="2">PETUGAS PUBLIC SERVICE & IT SYSTEM SUPERVISOR</td>
                  </tr>
                  <tr>
                        <td>DARI</td>
                        <td colspan="2">OM PSIT</td>
                  </tr>
                  <tr>
                        <td >PETUGAS TEKNISI</td>
                        <td><?=$data['leader']?></td>
                        <td></td>
                  </tr>
                  <tr>
                        <td>HARI / TANGGAL</td>
                        <td  colspan="2"><?=Hari(date('l', strtotime($data['tanggal_pergantian'])))?>, <?=tgl($data['tanggal_pergantian'],'l')?></td>
                  </tr>
                  <tr>
                        <td >PUKUL</td>
                        <td  colspan="2"></td>
                  </tr>
                  <tr>
                        <td style="width:50%" >PERALATAN</td>
                        <td style="width:50%"  colspan="2">FIDS</td>
                  </tr>
                  <tr>
                        <td colspan="3">URAIAN</td>
                      
                  </tr>
                  <tr style="width:50%">
                        <td colspan="3">
                           <p>
                           Pada hari ini, <?=Hari(date('l', strtotime($data['tanggal_pergantian'])))?>  <?=tgl($data['tanggal_pergantian'],'l')?>, pada pukul {}, Teknisi Public Service & IT System akan melakukan pergantian monitor pada 
                         <strong><?=$data['nama_fasilitas']?> </strong>dengan kondisi monitor sebelumnya dalam status <?=$data['detail'][0]['keterangan_before']?> 
                           </p>
                          
                        </td>
                        
                  </tr>
                  <tr>
                        <td colspan="3">TINDAKAN</td>
                       
                  </tr>
                  <tr>
                     <td colspan="3">
                           <ol>
                              <li>Pada Pukul 09:10 Teknisi Public Service & IT System melakukan pengecekan langsung ke lapangan untuk melihat detail kondisi perangkat pada Monitor TOD Lt 2</li>
                              <li>Pada Pukul 09:20 Tim dilapangan mempersiapkan monitor dan tools untuk melakukan pergantian perangkat</li>
                              <li>Pada Pukul 09:30 Tim melakukan pergantian 1 unit monitor LG 42 Inch Tarikan T3 pada TOD Lt2 di karenakan monitor sebelumnya dalam kondisi redup dan berkedip</li>
                              <li>Setelah dilakukukan pergantian, saat ini perangkat dalam keadaan normal beroperasi;</li>
                           </ol>

                     </td>
                  </tr>
                  <tr>
                        <td colspan="3">USULAN</td>
                       
                  </tr>
                  <tr>
                        <td colspan="3">1.	Dibutuhkan spare monitor jika terjadi kerusakan pada monitor yang rusak.</td>
                        
                  </tr>
                
                 
               </table>
              
            </div>
            <div style="clear:both;"></div>
         </div>
         <div class="row">
            <div class="body-info">
               <p  class="">
                  Dokumentasi Pergantian Barang : 
               </p>
               <h6></h6>
               <table class="mb-1"  border="1 ">
                  <thead>
                     <?php $no = 1;
                      foreach ($data['detail'] as $key => $value) :?>
                        <tr>
                           <td style="height:250px"  class="table-print">
                              <img style="display:block;" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_before'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['documentasi_before'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['documentasi_before']?>" />
                              
                              <p> Sebelum Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:block;" width="20%" height="80%" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['proses_pergantian']?>" />
                              <p> Proses Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:block;"
                              height="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['sn_baru']?>" />
                              <p> SN Baru Pergantian Perangkat </p>
                           </td>
                           <td style="height:250px"  class="table-print">
                              <img style="display:block;" 
                              height="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['h']?>" 
                              width="<?=scaleIMG(base_url('upload/temp/').$value['proses_pergantian'])['w']?>"
                              src="<?=base_url()?>upload/temp/<?=$value['documentasi_after']?>" />
                              <p> After Pergantian Perangkat </p>
                           </td>
                        </tr>
                     <?php $no++; endforeach?>
                   
                  </thead>
                 
               </table>
            </div>
            
           
          
         </div>
        
         
      </div>
      <div class="footer-surat bottom-div">
         <div class="row">
            <div class ="tulisan_tengah">
               <p>Mengetahui,</p>
               <p>MAINTENANCE PLANNER</p>
               <div class="row" style="height: 4em">
                  <img class="img-right" src="<?=base_url()?><?=$data['sig_planer']?>">
               </div>
               <p><?=$data['planer']?></p>
            </div>
         </div>
        
      </div>
   </div>
   <div class="footer-surat">
         <div class="row ">
            
         </div>
        
      </div>

      <div style="clear:both;"></div>
  
</body>
</html>
