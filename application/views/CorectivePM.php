<!DOCTYPE html>
<html>
   <head>
      <title>Page Title</title>
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
         font-size: 12px;
         }
         td { font-size: 12px }
         td.table-print {
          padding: 15px;
         }
         .pt-10{
             margin-top: 5px;
         }
         .ps-10{
            padding-left: 30px;
            padding-right: 30px;
         }
         .bottom-div {
            position: fixed;
            left: 0;
            bottom: 150px;
            width: 100%;
            height: 50px; 
            text-align: center; 
         }
         .border-name{
            border:1px solid black;
            margin-left: 20%;
            margin-right: 20%;
            margin-top: 25px;
            margin-bottom: 25px;
         }
         .fn10{
            font-size: 10px
         }
         .textmid{
            vertical-align: middle;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 2px;
            padding-right: 2px;
         }
         
      </style>
      <title>Perintah Kerja Corrective Maintenance</title>
   </head>
   <body>
      <div class="body-page ">
         <!-- <div class="header-surat">
            <div class="kop_surat ">
              
            </div>
            </div> -->
         <div class="body-surat">
            <div class="row">
               <div class="body-info">
                  <table class="mb-1"  border="1" style="heightL"  width="100%">
                     <tr>
                        <td  class=" tulisan_tengah" style="width:25%">
                           <img style="display:flex;" width="70%"  src="<?=base_url()?>/assets/ap2.png" />  
                        </td>
                        <th  class=" tulisan_tengah" style="width:50%">
                           <p>PERINTAH KERJA </p>
                           <p>PEMELIHARAAN PERBAIKAN</p>
                           <p>CORRECTIVE MAINTENANCE</p>
                           <p>PERALATAN</p>
                        </th>
                        <td   class=" tulisan_tengah" style="width:25%">
                           <img style="display:flex;" width="70%"  src="<?=base_url()?>/assets/asp.png" />
                        </td>
                     </tr>
                     <tr>
                        <td colspan="3" >
                           <table   class="ps-10 pt-10">
                              <tr>
                                 <td style="width:15%">
                                    <p> Hari / Tanggal</p>
                                 </td>
                                 <td style="width:1%">  : </td>
                                 <td style="width:84%"> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Shift Kerja</p>
                                 </td>
                                 <td>  : </td>
                                 <td> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Team</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Lokasi</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Jam Mulai</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <tr>
                        <td  colspan="3">
                           <table  border="1" class="ps-10 pt-10 fn10">
                              <thead>
                                 <tr>
                                    <th style="width:1%"><span class="text-mid">NO</span></th>
                                    <th style="width:10%"><span >WAKTU</span></th>
                                    <th style="width:20%"><span>LOKASI</span></th>
                                    <th style="width:20%"><span>MASALAH</span></th>
                                    <th style="width:20%"><span>PENYELESAIAN</span></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $no = 1;
                                    // foreach ($data['detail'] as $key => $value) 
                                    for($x=1;$x<=10;$x++) {?>
                                 <tr >
                                    <td>
                                       <div class="textmid">
                                          <span class=" textmid fn10">NO</span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="textmid">
                                          <span class=" textmid fn10">WAKTU</span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="textmid">
                                          <span class=" textmid fn10">LOKASI</span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="textmid">
                                          <span class=" textmid fn10">MASALAH</span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="textmid">
                                          <span class=" textmid fn10">PENYELESAIAN</span>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php $no++; }?>
                              </tbody>
                           </table>
                           <table>
                              <tr>
                                 <td style="width:50%">
                                    <div class=" tulisan_tengah border-name">
                                       <p>PT ANGKASA PURA II</p>
                                       <hr>
                                       <div class="row" style="height: 4em"></div>
                                       <p>()</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <p>PT ANGKASA PURA SOLUSI</p>
                                       <hr>
                                       <div class="row" style="height: 4em"></div>
                                       <p>()</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
               </div>
               <div style="clear:both;"></div>
            </div>
         </div>
      </div>
      <div style="clear:both;"  class ="page-break"></div>
      <div class="body-page ">
         <div class="body-surat">
            <div class="row">
               <div class="body-info">
                 
               </div>
               <div style="clear:both;"></div>
            </div>
         </div>
      </div>

      <table class="mb-1"  border="1" style="heightL"  width="100%">
                     <tr>
                        <td  class=" tulisan_tengah" style="width:25%">
                           <img style="display:flex;" width="70%"  src="<?=base_url()?>/assets/ap2.png" />  
                        </td>
                        <th  class=" tulisan_tengah" style="width:50%">
                           <p>PERINTAH KERJA </p>
                           <p>PEMELIHARAAN PERBAIKAN</p>
                           <p>CORRECTIVE MAINTENANCE</p>
                           <p>PERALATAN</p>
                        </th>
                        <td   class=" tulisan_tengah" style="width:25%">
                           <img style="display:flex;" width="70%"  src="<?=base_url()?>/assets/asp.png" />
                        </td>
                     </tr>
                     <tr>
                        <td colspan="3" >
                           <table   class="ps-10 pt-10">
                              <tr>
                                 <td style="width:15%">
                                    <p> Hari / Tanggal</p>
                                 </td>
                                 <td style="width:1%">  : </td>
                                 <td style="width:84%"> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Lokasi</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Fasilitas</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                           </table>
                           <table   class="ps-10 pt-10">
                              <tr>
                                 <td colspan="3">
                                    <p> Peralatan</p>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="width:15%">
                                    <p> Hari / Tanggal</p>
                                 </td>
                                 <td style="width:1%">  : </td>
                                 <td style="width:84%"> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Lokasi</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p> Fasilitas</p>
                                 </td>
                                 <td>: </td>
                                 <td> </td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 20em"></div>
                                       <hr>
                                       <p>(fasilitas sbelum)</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 4em"></div>
                                       <hr>
                                       <p>(fasilitas sesudah)</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 20em"></div>
                                       <hr>
                                       <p>(fasilitas sbelum)</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 4em"></div>
                                       <hr>
                                       <p>(fasilitas sesudah)</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 20em"></div>
                                       <hr>
                                       <p>(fasilitas sbelum)</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 4em"></div>
                                       <hr>
                                       <p>(fasilitas sesudah)</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 20em"></div>
                                       <hr>
                                       <p>(fasilitas sbelum)</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class=" tulisan_tengah border-name">
                                       <div class="row" style="height: 4em"></div>
                                       <hr>
                                       <p>(fasilitas sesudah)</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
   </body>
</html>