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
   </head>
   <body>
      <div class="body-info">
         <table class="mb-1"  border="1" style="heightL"  width="100%">
            <tr>
               <td  class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="https://omiassupport.com//assets/injourney.png" />  
               </td>
               <th  class=" " style="width:50%">
                  <p class="p-label">PERINTAH KERJA </p>
                  <p class="p-label">PEMELIHARAAN PERBAIKAN</p>
                  <p class="p-label">CORRECTIVE MAINTENANCE</p>
                  <p class="p-label">PERALATAN</p>
               </th>
               <td   class=" tulisan_tengah" style="width:25%">
                  <img style="display:flex;" width="70%"  src="https://omiassupport.com//assets/ias.png" />
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
                        <td style="width:74%"> 30 Oktober 2025  </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Shift Kerja</p>
                        </td>
                        <td>  : </td>
                        <td> Pagi</td>
                     </tr>
                     <tr>
                        <td>
                           <p> Team</p>
                        </td>
                        <td>: </td>
                        <td>4 </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Lokasi</p>
                        </td>
                        <td>: </td>
                        <td> 30 Oktober 2025  </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Jam Mulai</p>
                        </td>
                        <td>: </td>
                        <td>08:00 - 19:59</td>
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
                     $total = 15;
                     $limit = 14;
                     $perPage = ($total >= $limit) ? $limit: 15;
                      $total_page =  ceil($total/$perPage);
                     //    echo "Per Page".$perPage;
                     //  echo "Total Halaman".$total_page;
                     $no = 1;
                     $pageRow = 0;

                     for ($x = 1; $x <= $total; $x++): 
                     ?>
                        <tr>
                           <td><div class="textmid"><?=$x;?></div></td>
                           <td><div class="textmid">13:44 - 13:45</div></td>
                           <td><div class="textmid"></div></td>
                           <td><div class="textmid">Panel Rusak</div></td>
                           <td><div class="textmid">Ganti</div></td>
                        </tr>

                        <?php 
                        $pageRow++;

                        // Jika sudah 10 baris, dan masih ada data tersisa → page break
                        if ($pageRow == $perPage && $x < $total): 
                           $pageRow = 0;
                        ?>
                           </tbody>
                           </table>
                           <br>
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
                        <?php endif; ?>
                     <?php endfor; ?>

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
                              <div class="row" style="height: 10em"></div>
                              <p>(Aulia Dinul)</p>
                           </div>
                        </td>
                        <td>
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                              <p>PT ANGKASA PURA SOLUSI</p>
                              <hr>
                              <div class="row" style="height: 10em"></div>
                              <p>(CECEP TAUFIQUROHMAN)</p>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </div>
      <div style="clear:both;"></div>
      
      <!-- Modal for PDF preview -->
   </body>
</html>