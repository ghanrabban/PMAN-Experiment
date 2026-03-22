<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport " content="width=device-width, initial-scale=1.0">
      <title>Laporan Pemeliharaan Perbaikan</title>
      <style>
         .page-break{
         page-break-after:always;
         } 
         /* Reset CSS */
         * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         }
         .col img {
         width: 200px;
         margin: 20px;
         }
         .colsub {
         border-right: 1px solid #000;
         border-left: 1px solid #000;
         padding: 30px;
         }
         body {
         font-family: Arial, sans-serif;
         margin: 70px;
         }
         .container {
         border: 1px solid #000;
         margin: 0px;
         /* padding: 20px; */
         page-break-inside: avoid; /* Avoid breaking the container */
         }
         .header {
         text-align: center;
         margin-bottom: 20px;
         border-bottom: 1px solid #000;
         flex-wrap: nowrap;
         flex-direction: row;
         /* display: flex; */
         /* justify-content: space-between; */
         align-items: center;
         page-break-inside: avoid; /* Avoid breaking the header */
         }
         .header div {
         /* display: inline-block; */
         }
         .infos {
         width: 100%;
         max-width: 800px;
         margin: 50px;
         border-collapse: collapse;
         page-break-inside: avoid; /* Avoid breaking the infos */
         }
         .infos-row {
         /* display: flex; */
         border-bottom: 1px solid #ddd;
         padding: 5px 0;
         }
         .infos-col {
         padding: 5px;
         }
         .inforow {
         /* display: flex; */
         margin-bottom: 10px;
         }
         .col-label {
         flex: 0 0 25%;
         font-weight: bold;
         }
         .colabel {
         flex: 0 0 15%;
         font-weight: bold;
         }
         .col-separator, .colseparator {
         flex: 0 0 5%;
         text-align: center;
         }
         .col-value, .colvalue {
         flex: 1;
         }
         .sesi1 {
         margin: 50px;
         page-break-inside: avoid; /* Avoid breaking session content */
         }
         .boximg {
         /* display: flex; */
         justify-content: space-between;
         }
         .box {
         width: 45%;
         height: 350px;
         border: 1px solid #000;
         margin-bottom: 10px;
         padding: 20px;
         /* display: inline-block; */
         vertical-align: top;
         text-align: center;
         box-sizing: border-box;
         }
         .box img {
         max-width: 100%;
         max-height: 100%;
         width: auto;
         height: auto;
         object-fit: contain;
         margin: auto;
         /* display: block; */
         }
         table {
         /* margin-left: 5px; */
         border-spacing: 0px;
         border-collapse: collapse;
         width: 100%;
         }
         .t-center{
         margin-left: auto;
         margin-right: auto;
         }
         .border-name{
         border:1px solid black;
         margin-left: 10%;
         margin-right: 10%;
         margin-top: 10px;
         margin-bottom: 10px;
         }
         .border-dok{
         border:1px solid black;
         margin-left: 25%;
         margin-right: 25%;
         margin-top: 10px;
         margin-bottom: 10px;
         }
         .p-label {
         font-size: 14px;
         font-weight: 900;
         }
         .tulisan_tengah{
         text-align: center;
         }
         .body-info{
         -ms-flex: 0 0 100%;
         flex: 0 0 100%;
         max-width: 100%;
         margin: 3   0px;
         /* page-break-inside: avoid;  */
         }
         .mb-1, .my-1 {
         margin-bottom: .25rem!important;
         }
         td {
         font-size: 12px;
         }
         .textmid {
         vertical-align: middle;
         padding-top: 15px;
         padding-bottom: 15px;
         padding-left: 2px;
         padding-right: 2px;
         }
         .body-surat{
         margin: 30px;
         }
         .center {
         text-align: center;
         padding-top: 15px;
         padding-bottom: 15px;
         }
         .center img {
         display: block;
         }
         .ps-10{
         padding-left: 30px;
         padding-right: 30px;
         }
         .pt-10{
         margin-top: 10px;
         /* margin-left: 5px; */
         }
         .pt-30{
         margin-top: 30px;
         /* margin-left: 5px; */
         }
         .pt-25{
         margin-top: 25px;
         /* margin-left: 5px; */
         }
         .pb-10{
         margin-bottom: 10px;
         }
         .pb-30{
         margin-bottom: 30px;
         }
         .pd{
         padding-top: 10px;
         padding-bottom: 10px;
         }
         ol{
         padding-left: 15px;
         }
         .center-table {
         margin-left: auto;
         margin-right: auto;
         }
         hr.temuan {
         border-bottom: 1px solid black;
         margin-top: 15px;
         }
         .temuan-box{
         max-width: 90%;
         margin-left: auto;
         margin-right: auto;
         /* border: 3px solid #73AD21; */
         }
         .tb  {border-collapse:collapse;border-spacing:0;}
         .tb td{
         font-family:Arial, sans-serif;
         font-size:10px;
         overflow:hidden;
         padding:2px 5px;
         word-break:normal;
         }
         .tb th{
         font-family:Arial, sans-serif;
         font-size:10px;
         font-weight:normal;
         overflow:hidden;
         padding:10px 5px;
         word-break:normal;
         }
         .tb .tg-9wq8{
         border-color:inherit;
         }
         .tb .tg-nrix{
         }
         .tg  {border-collapse:collapse;border-spacing:0;}
         .tg td{
         border-color:black;
         border-style:solid;
         border-width:1px;
         font-family:Arial, sans-serif;
         font-size:10px;
         overflow:hidden;
         padding:2px 5px;
         word-break:normal;
         }
         .tg th{
         border-color:black;
         border-style:solid;
         border-width:1px;
         font-family:Arial, sans-serif;
         font-size:10px;
         font-weight:normal;
         overflow:hidden;
         padding:10px 5px;
         word-break:normal;
         }
         .tg .tg-9wq8{
         border-color:inherit;
         text-align:center;
         vertical-align:middle
         }
         .tg .tg-nrix{
         text-align:center;
         vertical-align:middle
         }
         tr.tinggi {  line-height: 70px; }
         td.tg-9wq8 {vertical-align: top;}
         span {
         position: absolute;
         top: 0;
         right: 0;
         }
         ol{ padding-top: 20px; }
      </style>
   </head>
   <body>
      
         <div style="clear:both;"></div>
      <?php 
         $no =1;  
            foreach ($detail as $key => $value) :   
         ?>
      <div class="body-info">
         <table class="mb-1"  border="1" style="heightL"  width="100%">
            <tr>
               <td  class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="<?=ImageLogo('1')?>" />  
               </td>
               <th  class=" " style="width:50%">
                  <p class="p-label">CORRECTIVE MAINTENANCE <?=$no?> </p>
                  <p class="p-label">PERALATAN KAMERA CCTV</p>
                  <p class="p-label">BANDARA SOEKARNO-HATTA</p>
               </th>
               <td   class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="<?=ImageLogo('2')?>" />
               </td>
            </tr>
            <tr>
               <td colspan="3">
                  <table class="tb" style="undefined;table-layout: fixed; width: 100%">
                     <tbody>
                        <tr>
                           <td style="width:25%">Nomor Work Order</td>
                           <td style="width:1%">:</td>
                           <td class="tg-0lax"></td>
                           <td style="width:25%">Hari/Tanggal</td>
                           <td style="width:1%">:</td>
                           <td class="tg-0lax"><?=$tanggal?></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax">Lokasi</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"><?=$value['nama_terminal']?></td>
                           <td class="tg-0lax">Shift</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"><?=$shift_l['name']?></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax">Fasilitas</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"><?=$value['catagory']?></td>
                           <td class="tg-0lax">Waktu Mulai Kegiatan</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"><?=$value['mulai']?></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax">Nama Pelaksana</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax">
                              <?php 
                                 ?>
                           </td>
                           <td class="tg-0lax">Waktu Selesai Kegiatan</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"><?=$value['selesai']?></td>
                        </tr>
                     </tbody>
                  </table>
                  <table class="tg" style="undefined;table-layout: fixed; width: 95%">
                     <colgroup>
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                        <col style="width: 91px">
                     </colgroup>
                     <thead>
                        <tr>
                           <th class="tg-9wq8" colspan="2">Kerusakan</th>
                           <th class="tg-9wq8" colspan="7"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="tg-9wq8">Lokasi</td>
                           <td class="tg-9wq8" colspan="3">Terminal 3</td>
                           <td class="tg-9wq8" colspan="2">Nama Kamera</td>
                           <td class="tg-nrix" colspan="3"></td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8">Type</td>
                           <td class="tg-9wq8" colspan="3">SCN</td>
                           <td class="tg-9wq8" colspan="2">Serial Number</td>
                           <td class="tg-nrix" colspan="3"></td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8">IP Lama</td>
                           <td class="tg-9wq8" colspan="2">172.</td>
                           <td class="tg-9wq8">IP Baru</td>
                           <td class="tg-9wq8" colspan="2"></td>
                           <td class="tg-nrix">Netmask</td>
                           <td class="tg-9wq8" colspan="2">255.255</td>
                        </tr>
                     </tbody>
                  </table>
                  <br>
                  <table class="tg" style="undefined;table-layout: fixed; width: 95%">
                     <colgroup>
                        <col style="width: 117px">
                        <col style="width: 121px">
                        <col style="width: 104px">
                        <col style="width: 104px">
                        <col style="width: 104px">
                        <col style="width: 104px">
                        <col style="width: 104px">
                     </colgroup>
                     <thead>
                        <tr>
                           <th class="tg-c3ow">Kondisi</th>
                           <th class="tg-c3ow" colspan="3">Sebelum</th>
                           <th class="tg-c3ow" colspan="3">Sesudah</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="tg-c3ow">Kamera CCTV</td>
                           <td class="tg-c3ow" colspan="3">Buram / Intermeten/Mati / Bagus</td>
                           <td class="tg-c3ow" colspan="3">Buram / Intermeten/Mati / Bagus</td>
                        </tr>
                        <tr>
                           <td class="tg-c3ow">Jaringan</td>
                           <td class="tg-c3ow" colspan="3">Intermitten/ Drop / Bagus</td>
                           <td class="tg-c3ow" colspan="3">Intermitten/ Drop / Bagus</td>
                        </tr>
                        <tr>
                           <td class="tg-c3ow" rowspan="2">Power Supply</td>
                           <td class="tg-c3ow">PoE/24AC</td>
                           <td class="tg-c3ow">Switch</td>
                           <td class="tg-c3ow">AC220</td>
                           <td class="tg-c3ow">PoE/24AC</td>
                           <td class="tg-c3ow">Switch</td>
                           <td class="tg-c3ow">AC220</td>
                        </tr>
                        <tr>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                        </tr>
                        <tr>
                           <td class="tg-c3ow">Tes Ping</td>
                           <td class="tg-c3ow">Ke Kamera</td>
                           <td class="tg-c3ow" colspan="2">Drop/Bagus</td>
                           <td class="tg-c3ow">Mati/Bagus</td>
                           <td class="tg-c3ow" colspan="2">Drop/Bagus</td>
                        </tr>
                     </tbody>
                  </table>
                  <br>
                  <h3>PERGANTIAN SPAREPART BARU</h3>
                  <table class="tg" style="undefined;table-layout: fixed; width: 95%">
                     <colgroup>
                        <col style="width: 102px">
                        <col style="width: 106px">
                        <col style="width: 89px">
                        <col style="width: 113px">
                        <col style="width: 82px">
                        <col style="width: 90px">
                        <col style="width: 87px">
                        <col style="width: 100px">
                     </colgroup>
                     <tr>
                        <th class="tg-0pky" colspan="2"></th>
                        <th class="tg-baqh" colspan="4">Lama</th>
                        <th class="tg-9wq8" colspan="2">Baru</th>
                     </tr>
                     <tbody>
                        <tr>
                           <td class="tg-9wq8" colspan="2">Nama</td>
                           <td class="tg-nrix" colspan="2">Type/ Brand</td>
                           <td class="tg-9wq8" colspan="2">Serial Number</td>
                           <td class="tg-9wq8">Type/ Brand</td>
                           <td class="tg-9wq8">Serial Number</td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8" colspan="2">Kamera CCTV</td>
                           <td class="tg-0lax" colspan="2"></td>
                           <td class="tg-0pky" colspan="2"></td>
                           <td class="tg-0pky"></td>
                           <td class="tg-0pky"></td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8" colspan="2">PoE Injector</td>
                           <td class="tg-0lax" colspan="2"></td>
                           <td class="tg-0pky" colspan="2"></td>
                           <td class="tg-0pky"></td>
                           <td class="tg-0pky"></td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8" colspan="2">Switch/ Hub</td>
                           <td class="tg-0lax" colspan="2"></td>
                           <td class="tg-0pky" colspan="2"></td>
                           <td class="tg-0pky"></td>
                           <td class="tg-0pky"></td>
                        </tr>
                        <tr>
                           <td class="tg-9wq8" colspan="2">Media Converter</td>
                           <td class="tg-0lax" colspan="2"></td>
                           <td class="tg-0pky" colspan="2"></td>
                           <td class="tg-0pky"></td>
                           <td class="tg-0pky"></td>
                        </tr>
                        <tr class="tinggi">
                           <td class="" colspan="2">
                              <p style="vertical-align: middle;text-align:center;">Catatan Pekerjaan</p>
                           </td>
                           <td class="tg-0lax" colspan="2"></td>
                           <td class="tg-0pky" colspan="2"></td>
                           <td class="tg-0pky"></td>
                           <td class="tg-0pky"></td>
                        </tr>
                        <tr>
                           <td class="tg-nrix" colspan="2">View Camera</td>
                           <td class="tg-nrix" colspan="2">PTZ/Fixed</td>
                           <td class="tg-nrix" colspan="2">Video Loss</td>
                           <td class="tg-0lax"></td>
                           <td class="tg-0lax"></td>
                        </tr>
                        <tr>
                           <td class="tg-nrix">Buram</td>
                           <td class="tg-nrix">Bagus</td>
                           <td class="tg-nrix">Mati</td>
                           <td class="tg-nrix">Bagus</td>
                           <td class="tg-nrix">Ya</td>
                           <td class="tg-nrix">Tidak</td>
                           <td class="tg-nrix"></td>
                           <td class="tg-nrix"></td>
                        </tr>
                        <tr>
                           <td class="tg-nrix" colspan="2">Ket: </td>
                           <td class="tg-nrix" colspan="2">Ket: </td>
                           <td class="tg-nrix" colspan="2">Ket: </td>
                           <td class="tg-nrix" colspan="2">Ket: </td>
                        </tr>
                  </table>
                  <br>
                  <div style="clear:both;"></div>
                  <div class="temuan-box">
                     <p>Temuan Pada Saat CM</p>
                     <hr class="temuan">
                     <hr class="temuan">
                     <hr class="temuan">
                  </div>
                  <table>
                     <tr>
                        <td style="width:50%">
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                              <p>SPV SSIT API</p>
                              <hr>
                              <div class="row" style="height: 5em"></div>
                              <p>(<?=$ttd['organik']['nama']?>)</p>
                           </div>
                        </td>
                        <td>
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                              <p>SHIFT LEADER OM IASS</p>
                              <hr>
                              <div class="row" style="height: 5em"></div>
                              <p>(<?=$ttd['leder']['nama']?>)</p>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </div>
      
      <div class="container">
         <!-- KOP SURAT START -->
         <table width="100%" >
            <thead>
               <tr style="">
                  <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
                     <img style="display:flex; margin-left: 25px;" width="70%"  src="<?=base_url()?>/assets/injourney.png" />  
                  </td>
                  <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
                     <p class="p-label">DOKUMENTASI LAPORAN </p>
                     <p class="p-label">KEGIATAN PEMELIHARAAN PERBAIKAN HARIAN</p>
                     <p class="p-label">PERALATAN <?=sess()['unit_device']?></p>
                  </td>
                  <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
                     <img style=" margin-left: 13%;" width="70%"  src="<?=base_url()?>/assets/ias.png" />
                  </td>
               </tr>
            </thead>
         </table>
         <div style="clear:both;"></div>
         <table >
            <tr>
               <td>
                  <table class="ps-10 pt-10">
                     <tr>
                        <td style="width:25%;margin-left: 10px;">
                           <p>Nomor Work Order</p>
                        </td>
                        <td style="width:1%">  : </td>
                        <td style="width:74%"> </td>
                     </tr>
                     <tr>
                        <td>Tanggal/Bulan/Tahun</td>
                        <td>:</td>
                        <td><?=$tanggal?></td>
                     </tr>
                     <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td><?=$value['nama_terminal']?></td>
                     </tr>
                     <tr>
                        <td>Fasilitas</td>
                        <td>:</td>
                        <td><?=sess()['unit_name']?></td>
                     </tr>
                     <tr>
                        <td>Bagian Peralatan</td>
                        <td>:</td>
                        <td><?=$value['catagory']?></td>
                     </tr>
                     <tr>
                        <td>Jam</td>
                        <td>:</td>
                        <td><?=$value['start_time']?> - <?=$value['end_time']?></td>
                     </tr>
                  </table>
                  <table style="width: 95%" >
                     <tr>
                        <td style="width:10%">
                           <div class="  border-dok pb-30">
                              <div class="row center" style="height: 10em">
                                 <img style="display:flex;"
                                    height="<?=scaleIMG('upload/'.$value['foto_before'],'2')['h']?>" 
                                    width="<?=scaleIMG('upload/'.$value['foto_before'],'2')['w']?>"
                                    src="<?=base_url('upload/')?><?=$value['foto_before']?>" >
                              </div>
                              <hr>
                              <p class="tulisan_tengah pd">Corrective Maintenance CCTV , <?=$value['nama_fasilitas']?> </p>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td style="width:10%">
                           <div class="  border-dok pb-30">
                              <div class="row center" style="height: 10em">
                                 <img style="display:flex;"
                                    height="<?=scaleIMG('upload/'.$value['foto_proses'],'2')['h']?>" 
                                    width="<?=scaleIMG('upload/'.$value['foto_proses'],'2')['w']?>"
                                    src="<?=base_url('upload/')?><?=$value['foto_proses']?>" >
                              </div>
                              <hr>
                              <p class="tulisan_tengah pd">Proses Perbaikan</p>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td style="width:10%">
                           <div class="  border-dok pb-30">
                              <div class="row center" style="height: 10em">
                                 <img style="display:flex;"
                                    height="<?=scaleIMG('upload/'.$value['foto_after'],'2')['h']?>" 
                                    width="<?=scaleIMG('upload/'.$value['foto_after'],'2')['w']?>"
                                    src="<?=base_url('upload/')?><?=$value['foto_after']?>" >
                              </div>
                              <hr>
                              <p class="tulisan_tengah pd">Proses Perbaikan </p>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </div>
      <?php $no++;
         endforeach 
         // }
         ?>
      <!-- INFOS DINAS START  -->
      <!-- Modal for PDF preview -->
   </body>
</html>