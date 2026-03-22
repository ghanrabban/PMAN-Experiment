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
         font-size: 10px;
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
         padding-top: 5px;
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
         .pt-5{
         margin-top: 5px;
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
         .mg{
            margin-top: 5px;
            margin-bottom: 5px;
         }
          .pd-5{
            padding-top: 5px;
            padding-bottom: 5px;
         }
         .text-mid-cen{
            text-align:center;vertical-align:middle
         }
         .bd{
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            border-right: 1px solid #000;
         }
         .bd-ntop{
            border-bottom: 1px solid #000;
          
         }
         .dotted-box {
             border-bottom: 2px dotted black; /* Membuat border titik-titik berwarna hitam */
          
         }
         .text-top{
            vertical-align: top;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <!-- KOP SURAT START -->
         <table width="100%" >
            <thead>
               <tr style="">
                  <td  class=" tulisan_tengah" style="width:25%;border-bottom: 1px solid #000;  ">
                     <img style="display:flex; " width="70%"  src="<?=ImageLogo('1')?>" />  
                  </td>
                  <td  class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:50%;border-left: 1px solid #000;border-right: 1px solid #000;" style="">
                     <p class="p-label">DOKUMENTASI CHECKLIST STORING</p>
                     <p class="p-label">PERALATAN KAMERA {FASILITAS}</p>
                     <p class="p-label">BANDARA SOEKARNO-HATTAPERALATAN</p>
                  </td>
                  <td   class=" tulisan_tengah" style="border-bottom: 1px solid #000;width:25%">
                     <img style="margin-left: 0px;margin-bottom: 10px;margin-top: 5px;" width="70%"  src="<?=ImageLogo('2')?>" />
                  </td>
               </tr>
            </thead>
         </table>
         <!-- KOP SURAT END -->
         <table width="100%" class="">
            <tr>
               <td style="width:50%;">
                  <table   class="ps-10 ">
                     <tr>
                        <td style="width:49%;">
                           <p style="font-size: 8px;"> Nomor Work Order</p>
                        </td>
                        <td style="width:1%">  : </td>
                        <td style="width:50%">
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <p style="font-size: 8px;"> Lokasi</p>
                        </td>
                        <td>  : </td>
                        <td>
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <p style="font-size: 8px;"> Nama Pelaksana</p>
                        </td>
                        <td>: </td>
                        <td>
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                  </table>
               </td>
               <td>
                  <table   class="ps-10" width="100%">
                     <tr>
                        <td style="width:49%;">
                           <p style="font-size: 8px;"> Hari / Tanggal</p>
                        </td>
                        <td style="width:1%">  : </td>
                        <td style="width:50%">
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <p style="font-size: 8px;"> Shift</p>
                        </td>
                        <td>  : </td>
                        <td>
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <p style="font-size: 8px;"> Waktu Mulai Kegiatan</p>
                        </td>
                        <td>: </td>
                        <td> </td>
                     </tr>
                     <tr>
                        <td >
                           <p style="font-size: 8px;"> Waktu Selesai Kegiatan</p>
                        </td>
                        <td>: </td>
                        <td >
                           <p style="font-size: 8px;"></p>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
        
         <table width="100%" >
            <tr>
               <td>
                  <table width="100%"  >
                     <?php   for($x=1;$x<=4;$x++):?>
                     <tr>
                        <td style="width:5%;" rowspan="3" class="text-mid-cen bd" >
                           <p style="font-size: 8px;">No</p>
                        </td>
                        <td style="width:95%"  class="bd pd-5">
                           <p style="font-size: 8px;  padding-left: 2px;">Nama Fasilitas : </p>
                        </td>
                     </tr>

                      <tr>
                        <td style="width:95%"  >
                           <table>
                              <tr >
                                 <td style="width:50%;" >
                                    
                                 </td>
                                 <td style="width:50%;">
                                    <table  style=" margin-right: 5px;">
                                       <tr>
                                          <td style="width:15%;" class="text-top"> 
                                             <p style="font-size: 8px;padding-top: 5px; " >Catatan :</p> 
                                          </td>
                                          <td >
                                             <span class="dotted-box" style="font-size: 8px; text-align: justify; padding-top: 5px;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </span>
                                          </td>
                                       </tr>
                                       
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <tr>
                        <td style="width:95%" class="bd-ntop"  >
                           <table >
                              <tr>
                                 <td style="width:50%; ">
                                    <div class="  border-name ">
                                       <div class="row center" style="height: 6em">
                                          
                                          <img style="display:flex;"
                                             height="<?=scaleIMG('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg','3')['h']?>" 
                                             width="<?=scaleIMG('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg','3')['w']?>"
                                             src="<?=base_url('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg')?>" >
                                       </div>
                                       <hr>
                                       <p class="tulisan_tengah " style="font-size: 8px;">Documentasi Storing </p>
                                    </div>
                                 </td>
                                 <td style="width:50%;">
                                    
                                   
                                       
                                       
                                    <div class="  border-name ">
                                       <div class="row center" style="height: 6em">
                                          <img style="display:flex;"
                                             height="<?=scaleIMG('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg','3')['h']?>" 
                                             width="<?=scaleIMG('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg','3')['w']?>"
                                             src="<?=base_url('upload/WhatsApp_Image_2025-02-11_at_12_08_30.jpeg')?>" >
                                       </div>
                                       <hr>
                                       <p class="tulisan_tengah " style="font-size: 8px;"> Documentasi Storing</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <?php endfor?>
                  </table>
               </td>
            </tr>
         </table>
         <table width="100%" >
            <tr>
               <td>
                  <table>
                     <tr>
                        <td style="width:50%">
                           <div class=" tulisan_tengah border-name pt-10 pb-10">
                              <p>SPV SSIT API</p>
                              <hr>
                              <div class="row" style="height: 8em"></div>
                              <p>()</p>
                           </div>
                        </td>
                        <td>
                           <div class=" tulisan_tengah border-name pt-10 pb-10">
                              <p>SHIFT LEADER OM IASS</p>
                              <hr>
                              <div class="row" style="height: 8em"></div>
                              <p>(  )</p>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
         <!-- INFOS DINAS START  -->
      </div>
   </body>
</html>