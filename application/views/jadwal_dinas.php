<!DOCTYPE html>
<html>
   <head>
      <title><?=$title?></title>
   </head>
   <body>
      <style type="text/css">
         body{
         font-family: sans-serif;
         }
         table{
         margin: 20px auto;
         border-collapse: collapse;
         }
         table th,
         table td{
         border: 1px solid #3c3c3c;
         padding: 3px 8px;
         }
         a{
         background: blue;
         color: #fff;
         padding: 8px 10px;
         text-decoration: none;
         border-radius: 2px;
         }
         .table-bordered {
            border: 1px solid #EBEBEB;
         }
         .table-bordered td, .table-bordered th {
            padding: 10px;
         }
         .thead-blue td, .thead-blue th {
            color: #fff;
            background-color: rgb(0 153 153);
            border-color: #2c7cccf5;
            vertical-align: middle;
            
         }
         .tengah{
            text-align: center;
         }
         .pd-10{
            margin-top:10%;
         }
      </style>
      <?php
      //  header("Content-type: application/vnd-ms-excel");
      //   header("Content-Disposition: attachment; filename=Jadwal_Dinas_".(!empty($bulan)&&!empty($tahun)?  Fmonth($bulan).$tahun: '').".xls");
      ?>
   

   Jadwal Dinas Unit <?=$unit?> <?=$lokasi?> Tahun <br>
      <?=(!empty($bulan)&&!empty($tahun)?  Fmonth($bulan)." ".$tahun: '')?><br>
      BANDARA SOEKARNO-HATTA
   
      <table class="table table-condensed table-striped table-bordered" border = 1>
      <thead>
         <tr  style=" vertical-align: middle;">
            <th rowspan="3">NIK</th>
            <th rowspan="3">No</th>
            <th colspan="<?=$date?>">Tanggal</th>
            
         </tr>
         <tr style=" vertical-align: middle;">
            <?php for ($i = 1; $i <= $date; $i++): ?>
            <th ><?=$i?></th>
            <?php endfor ?>

         </tr>
         <tr  style=" vertical-align: middle;">
            <?php for ($i = 1; $i <= $date; $i++): ?>
           
            <th bgcolor="<?=hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$i)),'1')?>"><?=hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$i)))?></th>
           
            <?php endfor ?>
      </thead>    
         
            <?php foreach ($personil as $key2 => $val): ?>
               <tr style=" vertical-align: middle;">
                  <td > <?=$val['nik']?></td>
                  <td><?=$val['nama']?></td>
                  <?php for ($i = 1; $i <= $date; $i++): ?>
                     <td  style="text-align: center;"></td>
                  <?php endfor ?>
               </tr>
               <?php endforeach ?>
      </table>
     
   </body>
</html>