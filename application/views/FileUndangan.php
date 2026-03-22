 <!DOCTYPE html>
<html>
<head>
  <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet" > -->
  <link rel="shortcut icon" type="image/x-icon" href="./assets/icons/icon.png" />
  <style>
    
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
      .h4, h4 {
          font-size: 1.5rem;
          margin-top: 0;
      }
      .kop_surat{
       overflow: auto;
       text-align: center;
      }
      .tembusan{
       overflow: auto;
       text-align: left;
       padding-left: 2%;
      }
      .img2 {
        float: left;
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

      .pull-left-yth {
       
        height: auto;
        width: 5%;
        float: left;
      }
      .pull-right-yth {
      height: auto;
        width: 95%;
        float: right;
        /*
        width: 40%;
          float: left !important;
          */
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
      </style>
  <title><?=$Mail['title']?></title>


</head>
<body>
   <div class="body-page">
      <div class="header-surat">
         <div class="kop_surat ">

            <img class="img2" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Logo_of_the_Ministry_of_Home_Affairs_of_the_Republic_of_Indonesia.svg/1200px-Logo_of_the_Ministry_of_Home_Affairs_of_the_Republic_of_Indonesia.svg.png" alt="Pineapple" width="15%" height="15%">   
            <h4 class="mb-0 tulisan_tengah custome">KEMENTERIAN DALAM NEGERI</h4>
            <h4 class="mb-0 tulisan_tengah custome">REPUBLIK INDONESIA</h4>
            <h4 class="mb-0 tulisan_tengah"><?=$komponen['NAME']?></h4>
            <p  class="mb-0 tulisan_tengah alamat"><?=$komponen['ADDRESS']?>, Telepon <?=$komponen['PHONE']?></p>
            <p  class="mb-0 tulisan_tengah alamat">Faksimile.<?=$komponen['FAX']?> <?=$komponen['WEB']?>, E-mail <?=$komponen['MAIL']?></p>
         </div>
         <hr>
      </div>
      <div class="body-surat">
         <div class="row">
            <div class="body-info">
               <div class="kop_surat">
                  <p class="mb-0 tanggal-surat">Jakarta, <?php echo date('d F Y'); ?></p>
                  <p class="mb-1  tab-kepada">Kepada </p>

               </div>
               <div class="pull-left ">
                  <table class="mb-1">
                     <tr>
                        <td valign="top" >Nomor </td>
                        <td valign="top"> : </td>
                        <td>
                     </tr>
                     <tr>
                        <td valign="top">Sifat</td>
                        <td valign="top">:  
                        <td>
                          <?php
                          if ($Mail['PRIORITY']==1) {
                            echo "Sangat Penting";
                          }elseif ($Mail['PRIORITY']==2) {
                              echo "Penting";
                          }elseif ($Mail['PRIORITY']==3) {
                           echo "Biasa";
                          }
                          ?>
                        </td>
                     </tr>
                     <tr>
                        <td valign="top">Lampiran</td>
                        <td valign="top">:</td>
                        <td></td>
                     </tr>
                     <tr>
                        <td valign="top">Prihal</td>
                        <td valign="top">: </td>
                        <td>
                           <p class="justify mb-0"> </p>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="pull-right ">
                  <div class="pull-left-yth">
                     <p class="rata-kanan mb-0">Yth.</p>
                  </div>
                  <div class="pull-right-yth" >
                    <ol id="tujuan-surat">
                      <?php foreach ($Mailto as $key => $value): ?>
                        <li><?=$value['NAME']?></li> 
                      <?php endforeach ?>
                    </ol>          
                     <p class="mb-0 ">di -</p>
                     <p class="mb-0 tab-kiri">Tempat </p>
                     <br>
                  </div>
               </div>
            </div>
            <div style="clear:both;"></div>
         </div>
         <?php 
            foreach ($MailDetail as $key => $value) {
              echo  FormatMail($value['INPUTYPE'],$value['NAME'],$value['DESCRIPTION']);
            }
            ?>
      </div>
      <div class="footer-surat">
         <div class="row tepi-kiri tepi-atas ">
            <div class="col-md-5 offset-md-7">
               <p class="mb-0 "><?=$sig_by['jabatan']?></p>
               <p class="mb-0 under tepi-atas"><?=$sig_by['nama']?></p>
               <p class="mb-0 "><?=$sig_by['golongan']?> (<?=$sig_by['kode_golongan']?>)</p>
               <p class="mb-0 ">NIP. <?=$sig_by['NIP']?></p>
            </div>
         </div>
         <div class="row ">
            <div class="tembusan ">
               <p class="mb-0">Tembusan :</p>
            </div>
            <div>
               <ol id="tujuan-surat">
                <?php foreach ($cc_to as $key => $value): ?>
                    <li>Yth. <?=$value['jabatan']?>;</li>
                <?php endforeach ?>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <footer>
      <div class="header-surat">
         <div class="kop_surat ">
            
            <p  class="justify ">
              <img style="float: left; margin: 0px 15px 15px 0px;" src="<?=$url.$Mail['qrcode'];?>" width="80" />
                Sesuai dengan perundang - undangan yang berlaku, dokumen ini telah ditandatangani secara elektronik yang tersertifikasi oleh Balai Sertifikasi
               Elektronik (BSrE) sehingga tidak diperlukan tanda tangan dan stempel basah
               
            </p>
            <br style="clear: both;" />
         </div>
      </div>
   </footer>
</body>
</html>