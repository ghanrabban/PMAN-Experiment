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
         height: 950px;
         border: 1px solid #000;
         margin: 0px;
         /* padding: 20px; */
         page-break-inside: avoid; /* Avoid breaking the container */
         }
         table {
         /* margin-left: 5px; */
         border-spacing: 0px;
         border-collapse: collapse;
         width: 100%;
         }
         .table-pekerjaan {
         margin-left: 50px;
         border-spacing: 5px;
         border-collapse: collapse;
         width: 75%;
         }
         .table-mid{
         width: 100%;
         object-fit: contain;
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
         
         margin-right: 20px;
         }
         .mt-5{
         margin-top: 10px;
         }
         .ml-5{
             margin-left: 20px; 
         }
         td{
         }
         table.fs  td {
         padding-top: 10px;
         padding-bottom: 10px;
         font-size:  10px;
         text-align: center;
         }
         table.fs  th {
         font-size: 10px;
         text-align: center;
         }
         .mg-50{
         margin-left: 50px;
         margin-right: 50px;
         }
         .mg-10{
         margin-left: 10px;
         margin-right: 10px;
         }
         .pdt-5{
         /* margin-top: 10px; */
         margin-left: 10px;
         }
         .pd-status{
         /* margin-left: 10px; */
         margin-top: 10px;
         }
         table.pd-t  td {
         padding-bottom: 10px;
         }
         .text-i{
         font-style: italic;
         }
         .pd-sig{
         margin-top: 250px;
         }
         .pd-ceklist{
         margin-top: 40px;
         }
         .text-right{
         float: right;
         margin-right: 30px;
         }
         .dot{
         border-bottom-style: dotted;
         margin-bottom: 25px;
         }
          ol {
            padding-left: 15px;
            padding-top: 5px;
            font-size: 12px;
         }  
      </style>
      <style>
  .checkmark {
    display: inline-block;
    width: 16px;
    height: 16px;
   
    position: relative;
    margin-right: 5px;
  }

  .checkmark:after {
    content: '';
    position: absolute;
    left: 4px;
    top: 1px;
    width: 5px;
    height: 10px;
    border: solid #0d632d;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
  }
  
  .page-break {
    display: block;
    page-break-after: always;
  }
</style>
   </head>
   <body>
      
      <div style="clear:both;"></div>
      <div class="container">
         
         <table width="100%"    >
            <tr style="">
               <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
                  <img style="display:flex; margin-left: 25px;" width="70%"  src="<?=ImageLogo('1')?>" />  
               </td>
               <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
                  <p class="p-label">DOKUMENTASI LAPORAN </p>
                  <p class="p-label"> PEMELIHARAAN PENCEGAHAN</p>
                  <p class="p-label">(PREVENTIVE MAINTENANCE)</p>
                  <p class="p-label">PERALATAN <?=strtoupper(sess()['unit_name'])?></p>
               </td>
               <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
                  <img style=" margin-left: 13%;" width="70%"  src="<?=ImageLogo('2')?>" />
               </td>
            </tr>
            <tr>
               <td colspan="3" >
                  <table   class="ps-10 pt-25">
                     <tr>
                        <td style="width:25%;margin-left: 10px;">
                           <p> Hari / Tanggal</p>
                        </td>
                        <td style="width:1%">  : </td>
                        <td style="width:74%"> <?=$hari?>, <?=$tlg_l?></td>
                     </tr>
                     <tr>
                        <td>
                           <p> Shift Kerja</p>
                        </td>
                        <td>  : </td>
                        <td> <?=$shift_l['name']?>  </td>
                     </tr>
                   
                     <tr>
                        <td>
                           <p> Lokasi</p>
                        </td>
                        <td>: </td>
                        <td> <?=(empty($lokasi) ? 'Terminal 1,2,3 & Non Terminal (Skytrain, Integrasi Building, TOD)': $lokasi)?> </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Jam Mulai</p>
                        </td>
                        <td>: </td>
                        <td> <?=$waktu?>  </td>
                     </tr>
                     <tr>
                        <td>
                           <p> Pelaksana Pekerjaan</p>
                        </td>
                        <td>: </td>
                        <td> 
                           <ol>
                           <?php 
                           foreach ($pelaksana as $key => $value) :?>
                              <li><?=$value?></li>
                            
                            <?php endforeach;?>
                           </ol>  
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="3" >
                  <table >
                     <tr>
                        <td>
                           <table width="100%" border="1"  class="table-mid mg-5 mt-5 fs ml-5" >
                              <thead>
                              <tr>
                                 <th rowspan="2" >NO</th>
                                 <th  rowspan="2">LOKASI</th>
                                 <th colspan="<?=count($job)?>" >CHECKLIST</th>
                                 <th  rowspan="2"> Note</th>
                              </tr>
                              <tr>
                                  <?php
                                    foreach ($job as $key => $value) : ?>
                                    <th> <?= $value['nama_job']?> </th>
                                    <?php endforeach;?>
                              </tr>
                               </thead>
                               <tbody>
                              <?php 
                                 $x=1;
                                 
                                 $total = $count_fasilitas; // total data
                                $perPage = 10; // setiap 10 baris ganti halaman

                                 foreach ($fasilitas as $key => $value) :
                                 ?>
                              <tr>
                                 <td > <?=$x?></td>
                                 <td > <?=$value['nama_fasilitas']?> </td>
                                 <?php 
                                    foreach ($job as $key => $value) : ?>
                                   
                                 <td style="padding-left: 10px; text-align: left;"> <span class="checkmark"></span> DONE</td>
                                <?php   endforeach; ?>
                                 <td > </td>
                              </tr>
                              <?php if ($x % $perPage == 0 && $x < $total) : ?>
                              </tbody>
                               </table>
                                <div class="page-break"></div>
                                 <table width="100%" border="1"  class="table-mid mg-5 mt-5 fs ml-5">
                                <thead>
                                    <tbody>
                              <tr>
                                 <th rowspan="2" >NO</th>
                                 <th  rowspan="2">LOKASI</th>
                                 <th colspan="<?=count($job)?>" >CHECKLIST</th>
                                 <th  rowspan="2"> Note</th>
                              </tr>
                              <tr>
                                  <?php
                                    foreach ($job as $key => $value) : ?>
                                    <th> <?= $value['nama_job']?> </th>
                                    <?php endforeach;?>
                              </tr>
                               </thead>
                                <?php endif;?>
                              <?php 
                                 $x++;endforeach;?>
                            </tbody>

                           </table>
                        </td>
                     </tr>
                  </table>
                  <div class="pd-ceklist">
                  </div>
                  <p class="text-right">(Checklist item dan foto dokumentasi terlampir)</p>
               </td>
            </tr>
            <tr>
               <td colspan="3">
                  <table>
                     <tr>
                        <td style="width:50%">
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                              <p>ANGKASA PURA INDONESIA</p>
                              <hr>
                              <div class="row" style="height: 10em"></div>
                              <p>(<?=(empty($ttd['organik']) ? '':$ttd['organik'])?>)</p>
                           </div>
                        </td>
                        <td>
                           <div class=" tulisan_tengah border-name pt-30 pb-30">
                              <p>IAS SUPPORT INDONESIA</p>
                              <hr>
                              <div class="row" style="height: 10em"></div>
                              <p>( <?=(empty($ttd['leder']) ? '':$ttd['leder']['nama'])?>)</p>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            
         </table>
      </div>

      <div class="container">
        
         <table width="100%" >
            <thead>
               <tr style="">
                  <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
                     <img style="display:flex; margin-left: 25px;" width="70%"  src="<?=ImageLogo('1')?>" />  
                  </td>
                  <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
                     <p class="p-label">DOKUMENTASI LAPORAN </p>
                     <p class="p-label">PEMELIHARAAN PENCEGAHAN</p>
                     <p class="p-label">(PREVENTIVE MAINTENANCE)</p>
                     <p class="p-label">PERALATAN <?=strtoupper(sess()['unit_name'])?></p>
                  </td>
                  <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
                     <img style=" margin-left: 13%;" width="70%"  src="<?=ImageLogo('2')?>" />
                  </td>
               </tr>
            </thead>
         </table>
      
         <table   class="ps-10 pt-25">
            <tr>
               <td style="width:25%;margin-left: 10px;">
                  <p> Hari / Tanggal</p>
               </td>
               <td style="width:1%">  : </td>
               <td style="width:74%"> <?=$hari?>, <?=$tlg_l?></td>
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
                  <p> Lokasi</p>
               </td>
               <td>: </td>
               <td> <?=(empty($lokasi) ? 'Terminal 1,2,3 & Non Terminal (Skytrain, Integrasi Building, TOD)': $lokasi)?>  </td>
            </tr>
            <tr>
               <td>
                  <p> Jam Mulai</p>
               </td>
               <td>: </td>
               <td><?=$waktu?> </td>
            </tr>
         </table>
         <br>
         <table >
            <tr>
               <td>
                 
                  <table>
    <?php 
    $no = 1; 
    foreach ($job as $key2 => $val): 
        // Buka baris baru setiap 2 item
        if ($no % 2 == 1) echo "<tr>";
    ?>
        <td style="width:30%">
            <div class="border-name pb-30">
                <div class="row center" style="height: 18em">
                    <img style="display:flex;"
                        height="<?= scaleIMG('upload/pm/'.$val['documentasi'], '1')['h'] ?>" 
                        width="<?= scaleIMG('upload/pm/'.$val['documentasi'], '1')['w'] ?>"
                        src="<?= base_url('upload/pm/') . $val['documentasi'] ?>">
                </div>
                <hr>
                <p class="tulisan_tengah pd"><?= $val['nama_job'] ?></p>
            </div>
        </td>

    <?php 
        // Tutup baris setiap kali sudah 2 item
        if ($no % 2 == 0) echo "</tr>";
        $no++;
    endforeach; 

    // Tutup baris terakhir jika jumlah data ganjil
    if (count($job) % 2 != 0) echo "</tr>";
    ?>
</table>

                  
               </td>
            </tr>
         </table>
      </div>



<!-- <div class="container">
   <table width="100%"    >
      <tr style="">
         <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
            <img style="display:flex; margin-left: 25px;" width="70%"  src="<?=ImageLogo('1')?>" />  
         </td>
         <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
            <p class="p-label">DOKUMENTASI LAPORAN </p>
            <p class="p-label"> PEMELIHARAAN PENCEGAHAN</p>
            <p class="p-label">(PREVENTIVE MAINTENANCE)</p>
            <p class="p-label">PERALATAN <?=strtoupper(sess()['unit_name'])?></p>
         </td>
         <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
            <img style=" margin-left: 13%;" width="70%"  src="<?=ImageLogo('2')?>" />
         </td>
      </tr>
      <tr>
         <td colspan="3" >
            <table   class="ps-10 pt-25">
               <tr>
                  <td style="width:25%;margin-left: 10px;">
                     <p> Hari / Tanggal</p>
                  </td>
                  <td style="width:1%">  : </td>
                  <td style="width:74%"> <?=$hari?>, <?=$tlg_l?></td>
               </tr>
               <tr>
                  <td>
                     <p> Shift Kerja</p>
                  </td>
                  <td>  : </td>
                  <td> <?=$shift_l['name']?>  </td>
               </tr>
               <tr>
                  <td>
                     <p> Lokasi</p>
                  </td>
                  <td>: </td>
                  <td> <?=(empty($lokasi) ? 'Terminal 1,2,3 & Non Terminal (Skytrain, Integrasi Building, TOD)': $lokasi)?> </td>
               </tr>
               <tr>
                  <td>
                     <p> Jam Mulai</p>
                  </td>
                  <td>: </td>
                  <td> <?=$waktu?>  </td>
               </tr>
               <tr>
                  <td>
                     <p> Pelaksana Pekerjaan</p>
                  </td>
                  <td>: </td>
                  <td>
                     <ol>
                        <?php 
                           foreach ($pelaksana as $key => $value) :?>
                        <li><?=$value?></li>
                        <?php endforeach;?>
                     </ol>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="3" >
            <table >
               <tr>
                  <td>
                     <table width="100%" border="1"  class="table-mid mg-5 mt-5 fs ml-5" >
                        <tr>
                           <th rowspan="2" >NO</th>
                           <th  rowspan="2">LOKASI</th>
                           <th colspan="<?=count($job)?>" >CHECKLIST</th>
                           <th  rowspan="2"> Note</th>
                        </tr>
                        <tr>
                           <?php
                              foreach ($job as $key => $value) : ?>
                           <th> <?= $value['nama_job']?> </th>
                           <?php endforeach;?>
                        </tr>
                        <?php  $x=1;  foreach ($fasilitas as $key => $value) : ?>
                           <?php if($count_fasilitas % 10 ==0): ?> 
                        <tr>
                           <td > <?=$x?></td>
                           <td > <?=$value['nama_fasilitas']?> </td>
                           <?php 
                              foreach ($job as $key => $value) : ?>
                           <td style="padding-left: 10px; text-align: left;"> <span class="checkmark"></span> DONE</td>
                           <?php   endforeach; ?>
                           <td > </td>
                        </tr>
                        <?php endif?>
                        <?php 
                           $x++;endforeach;?>
                     </table>
                  </td>
               </tr>
            </table>
            <div class="pd-ceklist">
            </div>
            <p class="text-right">(Checklist item dan foto dokumentasi terlampir)</p>
         </td>
      </tr>
      <tr>
         <td colspan="3">
            <table>
               <tr>
                  <td style="width:50%">
                     <div class=" tulisan_tengah border-name pt-30 pb-30">
                        <p>ANGKASA PURA INDONESIA</p>
                        <hr>
                        <div class="row" style="height: 10em"></div>
                        <p>(<?=(empty($ttd['organik']) ? '':$ttd['organik'])?>)</p>
                     </div>
                  </td>
                  <td>
                     <div class=" tulisan_tengah border-name pt-30 pb-30">
                        <p>IAS SUPPORT INDONESIA</p>
                        <hr>
                        <div class="row" style="height: 10em"></div>
                        <p>( <?=(empty($ttd['leder']) ? '':$ttd['leder']['nama'])?>)</p>
                     </div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</div> -->
      
   </body>
</html>
