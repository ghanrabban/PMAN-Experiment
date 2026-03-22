<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport " content="width=device-width, initial-scale=1.0">
      <title>QRCode Perangkat</title>
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
         /*border: 1px solid #000;*/
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
         /*border:1px solid black;*/
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
         /*padding-top: 15px;*/
         /*padding-bottom: 15px;*/
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
         margin-left: 40px;
         margin-right: 40px;
         }
         .mt-5{
         margin-top: 10px;
         }
         td{
         }
         table.fs  td {
         padding-top: 10px;
         padding-bottom: 10px;
         font-size: 6px;
         text-align: center;
         }
         table.fs  th {
         font-size: 8px;
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
      </style>
   </head>
   <body>
      
       <?php 
      $x= 0;
      $limit= $totaldata;
      $percolom= 4;
      $totalbaris =  ceil($limit/$percolom);

    ?>
      <div class="container">
         <table  >
             <?php  for ($y = 0; $y <  $totalbaris; $y++):?>
                     <tr>
                         
         <?php  for ($i = 0; $i <  $percolom; $i++):?>
         
                       <td style="width:25%">
                           <?php  if ($x < $limit):?>
                           <div class="  border-name pb-30">
                              <div class="row center" style="height: 12em">
                                  <img style="display:flex;"
                                       height="<?=scaleIMG($data[$x]['Qrcode'],'1')['h']?>" 
                                       width="<?=scaleIMG($data[$x]['Qrcode'],'1')['w']?>"
                                       src="<?=base_url($data[$x]['Qrcode'])?>" > 
                                 
                              </div>
                             
                               <p class="tulisan_tengah"><?=(empty($data[$x]['sn'])? '':'SN : '.$data[$x]['sn'])?></p>
                           </div><?php endif;?>
                        </td>
                     <?php $x++;endfor;?>    
                     </tr>
                     <?php endfor;?> 
                  </table>
      </div>
   </body>
</html>




