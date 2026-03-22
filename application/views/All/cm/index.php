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
      </style>
      
      <style>
.single-bottom-fill {
    height: 210px; /* tinggi area kosong, bisa disesuaikan */
    /*border-top: 1px solid #000;*/
    margin-top: 10px;
}

.single-spacer {
    height: 160px; /* ruang kosong antara foto dan garis bawah */
}

.single-spacer-list {
    height: 180px; /* ruang kosong antara foto dan garis bawah */
}
</style>
   </head>
   <body>
      <div class="body-info">
         <table class="mb-1"  border="1" style="heightL"  width="100%">
            <tr>
               <td  class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="<?=ImageLogo('1')?>" />  
               </td>
               <th  class=" " style="width:50%">
                  <p class="p-label">PERINTAH KERJA </p>
                  <p class="p-label">PEMELIHARAAN PERBAIKAN</p>
                  <p class="p-label">CORRECTIVE MAINTENANCE</p>
                  <p class="p-label">PERALATAN</p>
               </th>
               <td   class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="<?=ImageLogo('2')?>" />
               </td>
            </tr>
            <tr>
               <td colspan="3" >
                  <table   class="ps-10 pt-10 pb-10">
                     <tr>
                        <td style="width:25%">
                           <p> Hari / Tanggal</p>
                        </td>
                        <td style="width:1%">  : </td>
                        <td style="width:74%"> <?=$tanggal?></td>
                     </tr>
                     <tr>
                        <td>
                           <p> Shift Kerja</p>
                        </td>
                        <td>  : </td>
                        <td> <?=$shift_l['name']?></td>
                     </tr>
                     <tr>
                        <td>
                           <p> Team</p>
                        </td>
                        <td>: </td>
                        <td><?=$team?> </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Lokasi</p>
                        </td>
                        <td>: </td>
                        <td> <?=$tanggal?></td>
                     </tr>
                     <tr>
                        <td>
                           <p> Jam Mulai</p>
                        </td>
                        <td>: </td>
                        <td><?=$shift_l['jam']?></td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td  colspan="3">
                  <table  border="1" class="ps-10 pt-30  ">
                     <thead>
                        <tr>
                           <th style="width:1%">
                              <div class="textmid">
                                 <span class=" textmid  ">NO</span>
                              </div>
                           </th>
                           <th style="width:10%">
                              <div class="textmid">
                                 <span class=" textmid  ">WAKTU</span>
                              </div>
                           </th>
                           <th style="width:10%">
                              <div class="textmid">
                                 <span class=" textmid  ">LOKASI</span>
                              </div>
                           </th>
                           <th style="width:10%">
                              <div class="textmid">
                                 <span class=" textmid  ">MASALAH</span>
                              </div>
                           </th>
                           <th style="width:20%">
                              <div class="textmid">
                                 <span class=" textmid  ">PENYELESAIAN</span>
                              </div>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $total = $c_detail;
                           $limit = 7;
                           $perPage = ($total >= $limit) ? $limit: 7;
                           $total_page =  ceil($total/$perPage);
                           $no = 1;
                           $pageRow = 0;
                              foreach ($detail as $key => $value) :
                           
                           ?>
                        <tr >
                           <td>
                              <div class="textmid">
                                 <span class=" textmid  "><?=$no?></span>
                              </div>
                           </td>
                           <td>
                              <div class="textmid">
                                 <span class=" textmid  "><?=$value['waktu']?></span>
                              </div>
                           </td>
                           <td>
                              <div class="textmid">
                                 <span class=" textmid  "><?=$value['nama_terminal']?></span>
                              </div>
                           </td>
                           <td>
                              <div class="textmid">
                                 <span class=" textmid  "><?=$value['nama_masalah']?></span>
                              </div>
                           </td>
                           <td>
                              <div class="textmid">
                                 <span class=" textmid  "><?=$value['penyelesaian']?></span>
                              </div>
                           </td>
                        </tr>
                        <?php 
                        $no++;
                         $pageRow++;

                        // Jika sudah 10 baris, dan masih ada data tersisa → page break
                        if ($pageRow == $perPage && $pageRow < $total): 
                           $pageRow = 0;
                           ?>
                       </tbody>
                           </table>
                           <div class="single-spacer-list"></div>
                           <div class="page-break"></div>
                           <table border="1" class="ps-10 pt-30">
                           <thead>
                                 <tr>
                                    <th style="width:1%">NO</th>
                                    <th style="width:10%">WAKTU</th>
                                    <th style="width:10%">LOKASI</th>
                                    <th style="width:10%">MASALAH</th>
                                    <th style="width:20%">PENYELESAIAN</th>
                                 </tr>
                           </thead>
                           <tbody>
                        <?php endif;  
                     endforeach;?>
                      <?php 
                     // Cek apakah baris terakhir kurang dari 10 → tambahkan baris kosong
                     if ($pageRow > 0 && $pageRow < $perPage):
                        for ($r = $pageRow + 1; $r <= $perPage; $r++): ?>
                           <tr>
                                 <td><div class="textmid"><?=$r;?></div></td>
                                 <td><div class="textmid"></div></td>
                                 <td><div class="textmid"></div></td>
                                 <td><div class="textmid"></div></td>
                                 <td><div class="textmid"></div></td>
                           </tr>
                     <?php 
                        endfor;
                     endif;
                     ?>
                     </tbody>
                  </table>


                  <table>
                     <tr>
                        <td style="width:50%">
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                                  <p>PT ANGKASA PURA II</p>
                                  <hr>
                                  <?php if(!empty($ttd['organik'])): ?>
                                   <?php if (!empty($ttd['organik']['file'])): ?>
                                       <img src="<?= base_url($ttd['leder']['file']) ?>" alt="TTD">
                                    <?php endif; ?>
                                  <p>(<?=$ttd['organik']['nama']?>)</p>
                                  <?php else:?>
                                  <div class="row" style="height: 10em"></div>
                                  <p>(.....................................)</p>
                                   <?php endif ?>
                               </div>                              

                        </td>
                        <td>
                            <div class=" tulisan_tengah border-name pt-30 pb-30">
                                  <p>PT ANGKASA PURA II</p>
                                  <hr>
                                  <?php if(!empty($ttd['leder'])): ?>
                                    <?php if (!empty($ttd['leder']['file'])): ?>
                                       <img src="<?= base_url($ttd['leder']['file']) ?>" alt="TTD">
                                    <?php else:?>
                                     <div class="row" style="height: 10em"></div>
                                    <?php endif; ?>
                                   
                                    <p>(<?=$ttd['leder']['nama']?>)</p>
                                
                                  
                                  <?php else:?>
                                  <div class="row" style="height: 10em"></div>
                                  <p>(.....................................)</p>
                                   <?php endif ?>
                            </div>

                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </div>
      <div style="clear:both;"></div>
      
         <?php
// Bagi data menjadi per 2 item per halaman
$groups = array_chunk($detail, 2);
$hal = 1;

foreach ($groups as $pageItems):
?>

<div style="clear:both;"></div>
<div class="container">
<!-- === HEADER / KOP SURAT === -->
<table width="100%">
    <thead>
        <tr>
            <td class="tulisan_tengah" style="width:25%;border-bottom:1px solid #000;">
                <img width="70%" style="margin-left:25px;" src="<?=ImageLogo('1')?>">
            </td>
            <td class="tulisan_tengah" style="width:50%;border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;">
                <p class="p-label">DOKUMENTASI LAPORAN</p>
                <p class="p-label">PEMELIHARAAN PERBAIKAN</p>
                <p class="p-label">(CORRECTIVE MAINTENANCE)</p>
                <p class="p-label">PERALATAN </p>
            </td>
            <td class="tulisan_tengah" style="width:25%;border-bottom:1px solid #000;">
                <img width="70%" style="margin-left:13%;" src="<?=ImageLogo('2')?>">
            </td>
        </tr>
    </thead>
</table>

<!-- === INFO UMUM === -->
<table class="ps-10 pt-25">
    <tr><td style="width:25%">Hari / Tanggal</td><td style="width:1%">:</td><td><?=$tanggal?></td></tr>
    <tr><td>Shift Kerja</td><td>:</td><td><?=$shift_l['name']?></td></tr>
    <tr><td>Team</td><td>:</td><td><?=$team?></td></tr>
    <tr><td>Lokasi</td><td>:</td><td>Terminal 1,2,3 & Non Terminal</td></tr>
    <tr><td>Jam Mulai</td><td>:</td><td><?=$shift_l['jam']?></td></tr>
</table>

<br>

<!-- === 2 ITEM PER HALAMAN === -->

<?php foreach ($pageItems as $value): ?>
<table width="100%">
<tr>
<td>
    <!-- DETAIL PERALATAN -->
    <table class="ps-10 pt-10">
        <tr><td colspan="3"><p>Peralatan</p></td></tr>
        <tr><td style="width:25%">Bagian Peralatan</td><td style="width:1%">:</td><td><?=sess()['unit_device']?></td></tr>
        <tr><td>Alasan Perbaikan</td><td>:</td><td><?=$value['nama_masalah']?></td></tr>
        <tr><td>Jam</td><td>:</td><td><?=$value['waktu']?></td></tr>
    </table>

    <!-- FOTO BEFORE / AFTER DALAM SATU BARIS -->
    <table width="100%">
        <tr>
            <!-- FOTO BEFORE -->
            <td style="width:50%">
                <div class="border-name pb-30">
                    <div class="row center" style="height:16em">
                        <img src="<?=base_url('upload/'.$value['foto_before'])?>"
                             height="<?=scaleIMG('upload/'.$value['foto_before'],'1')['h']?>"
                             width="<?=scaleIMG('upload/'.$value['foto_before'],'1')['w']?>">
                    </div>
                    <hr>
                    <p class="tulisan_tengah pd"><?=$value['nama_terminal']?>, <?=$value['nama_fasilitas']?></p>
                </div>
            </td>

            <!-- FOTO AFTER -->
            <td style="width:50%">
                <div class="border-name pb-30">
                    <div class="row center" style="height:16em">
                        <?php if (!empty($value['foto_after'])): ?>
                            <img src="<?=base_url('upload/'.$value['foto_after'])?>"
                                 height="<?=scaleIMG('upload/'.$value['foto_after'],'1')['h']?>"
                                 width="<?=scaleIMG('upload/'.$value['foto_after'],'1')['w']?>">
                        <?php endif; ?>
                    </div>
                    <hr>
                    <p class="tulisan_tengah pd">Keadaan Setelah Ditinjau</p>
                </div>
            </td>
        </tr>
    </table>
    <?php if (count($pageItems) == 1): ?>
    <div class="single-spacer"></div>
    <div class="single-bottom-fill"></div>
    <?php endif; ?>
</td>
</tr>
</table>

<?php endforeach; ?>

<!-- === BUAT NEW PAGE SETELAH 2 ITEM === -->
<?php if ($hal < count($groups)): ?>
    <div class="page-break"></div>
<?php endif; ?>
  </div>
<?php $hal++; endforeach; ?>

         
    
      
      
      
   </body>
</html>