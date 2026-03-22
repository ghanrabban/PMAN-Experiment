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
         margin: 40px;
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
         .table-mid{
         width: 90%;object-fit: contain;
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
         .mg-5{
         margin-left: 5%;
         }
         .mt-5{
         margin-top: 10px;
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
            padding:5px 5px;
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
         ol{ padding-top: 0px; padding-left: px}
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
         .box-kanan{
         float: right;
         }
         .box-kiri{
         float: left;
         }
         .tg td .tb td{
            border-width: 0px;
            padding: 0px 5px;
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
      </style>
   </head>
   <body>
      <div class="body-info">
         <table class="mb-1"  border="1" style="heightL"  width="100%">
            <tr>
               <td  class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="50%"  src="<?=ImageLogo('1')?>" />  
               </td>
               <th  class=" " style="width:50%">
                  <p class="p-label">PREVENTIVE MAINTENANCE </p>
                  <p class="p-label">PERALATAN </p>
                  <p class="p-label">BANDARA SOEKARNO-HATTA</p>
                 
               </th>
               <td   class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="50%"  src="<?=ImageLogo('2')?>" />
               </td>
            </tr>
            <tr>
               <td colspan="3" >
                  <table class="tb" style="undefined;table-layout: fixed; width: 100%">
                     <tbody>
                        <tr>
                           <td class="tg-0lax">Nomor Work Order</td>
                           <td class="tg-0lax" style="width:1%">:</td>
                           <td class="tg-0lax"></td>
                           <td class="tg-0lax">Hari/Tanggal</td>
                           <td class="tg-0lax" style="width:1%">:</td>
                           <td class="tg-0lax"></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax">Fasilitas</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"></td>
                           <td class="tg-0lax">Shift</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax" rowspan="2">Nama Pelaksana</td>
                           <td class="tg-0lax" rowspan="2">:</td>
                           <td class="tg-0lax" rowspan="2">
                              <ol>
                                 <li>Coffee</li>
                                 <li>Tea</li>
                                 <li>Milk</li>
                              </ol>
                           </td>
                           <td class="tg-0lax">Waktu Mulai Kegiatan</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"></td>
                        </tr>
                        <tr>
                           <td class="tg-0lax">Waktu Selesai Kegiatan</td>
                           <td class="tg-0lax">:</td>
                           <td class="tg-0lax"></td>
                        </tr>
                     </tbody>
                  </table>
                  <table class="tg" style="undefined;table-layout: fixed; width: 90%">
                     <thead>
                        <tr>
                           <th class="tg-0lax" style="width:5%">No</th>
                           <th class="tg-0lax" style="width:5%">ID</th>
                           <th class="tg-0lax" style="width:25%">Type</th>
                           <th class="tg-0lax">Nama Fasilitas</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                        foreach ($fasilitas as $key => $value) :  ?>  
                        <tr>
                           <td class="tg-0lax"><?=$no?></td>
                           <td class="tg-0lax">-</td>
                           <td class="tg-0lax"><?=$value['type']?></td>
                           <td class="tg-0lax"><?=$value['nama_fasilitas']?></td>
                        </tr>
                        <?php $no++; endforeach;?>
                     </tbody>
                  </table>
                  <br>
                  <?php foreach ($check as $key => $value) :  ?>  
                     <table class="tg" style="undefined;table-layout: fixed; width: 90%">
                     <thead>
                        <tr>
                           <th class="tg-0lax" colspan="2"><?=$value['nama']?> </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="tg-0lax" style="width:5%">1</td>
                           <td class="tg-0lax" >
                              <table class="tb">
                                 <?php foreach ($value['checklist'] as $key2 => $val) :  ?>  
                                    <tr>
                                       <td style="width:70%"><?=$val['name']?></td>
                                       <td>Normal</td>
                                       <td ><input type="checkbox" checked="checked" class="pdt-5"></td>
                                       <td>Tidak</td>
                                       <td ><input type="checkbox" class="pdt-5"></td>
                                    </tr>
                                 <?php  endforeach ?>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <br>
                  <?php  endforeach ?>
                  <br>
                  <div style="clear:both;"></div>
                  <div class="temuan-box">
                     <p>Temuan Pada Saat PREVENTIVE MAINTENANCE</p>
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
      <div style="clear:both;"></div>
      <div class="container">
      <!-- KOP SURAT START -->
      <table width="100%" >
         <thead>
            <tr style="">
               <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
                  <img style="display:flex; margin-left: 25px;" width="70%"  src="<?=ImageLogo('1')?>" />  
               </td>
               <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
                  <p class="p-label">DOKUMENTASI LAPORAN </p>
                  <p class="p-label">KEGIATAN PEMELIHARAAN PERBAIKAN HARIAN</p>
                  <p class="p-label">PERALATAN <?=sess()['unit_device']?></p>
               </td>
               <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
                  <img style=" margin-left: 13%;" width="70%"  src="<?=ImageLogo('2')?>" />
               </td>
            </tr>
         </thead>
      </table>
      <!-- KOP SURAT END -->
      <table   class="ps-10 pt-25">
         <tr>
            <td style="width:25%;margin-left: 10px;">
               <p> Nomor Work Order</p>
            </td>
            <td style="width:1%">  : </td>
            <td style="width:74%"> </td>
         </tr>
         <tr>
            <td style="width:25%;margin-left: 10px;">
               <p>Tanggal/ Bulan/ Tahun</p>
            </td>
            <td style="width:1%">  : </td>
            <td style="width:74%"> <?=$tanggal?></td>
         </tr>
         <tr>
            <td>
               <p> Lokasi </p>
            </td>
            <td>  : </td>
            <td> Terminal 1,2,3 & Non Terminal (Skytrain, Integrasi Building, TOD) </td>
         </tr>
         <tr>
            <td>
               <p> Fasilitas </p>
            </td>
            <td>: </td>
            <td> <?=$fasilitas[0]['nama_fasilitas']?> </td>
         </tr>
         <tr>
            <td>
               <p> Bagian Peralatan</p>
            </td>
            <td>: </td>
            <td><?=sess()['unit_device']?></td>
         </tr>
         <tr>
            <td>
               <p> Jam</p>
            </td>
            <td>: </td>
            <td> <?=$shift_l['jam']?></td>
         </tr>
      </table>
      <table  >
         <?php foreach ($job as $key => $value) :  ?>      
         <tr>
            <td style="width:30%">
               <div class="  border-name pb-30">
                  <div class="row center" style="height: 12em">
                     <img style="display:flex;"
                        height="150px" 
                        width="120px"
                        src="<?=base_url('upload/pm/')?><?=$value['documentasi']?>" >
                  </div>
                  <hr>
                  <p class="tulisan_tengah pd"><?=$value['nama_job']?></p>
               </div>
            </td>
         </tr>
         <?php  endforeach ?>
      </table>
   </body>
</html>