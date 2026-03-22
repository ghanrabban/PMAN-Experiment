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
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Report_KPI_".$title."_".Fmonth($bulan).$tahun.".xls");
      ?>
      
   


      <img src="<?=base_url()?>assets/logo_new.PNG" alt=""  width="15%">
      <h3>Realisasi Kontrak Manajemen <span style="color: #00afef">PT PLN Indonesia Power</span> </h3>
      <h4><?=(!empty($bulan)&&!empty($tahun)?  Fmonth($bulan)." ".$tahun: '')?></h4>
      
      <table class="table table-condensed table-striped table-bordered" border = 1>
      <thead>
         <tr bgcolor="#009999" style=" vertical-align: middle;">
            <th >Perspektif</th>
            <th>No</th>
            <th>Indikator Kinerja</th>
            <th>Bobot</th>
            <th>Satuan</th>
            <th>Target</th>
            <th>Target Tahunan</th>
            <th>Realisasi</th>
            <th>Pencapaian</th>
            <th>Nilai</th>
            
         </tr>
      </thead>    
         <?php $nilai=0; 
           $bobot= 0;
         foreach ($data as $key => $value): ?>
            <?php foreach ($value['detail'] as $key2 => $val): ?>
               <tr style=" vertical-align: middle;">
               <?php if ($key2 == 0): ?>
                  <td rowspan="<?=$value['cout']?>"><?=$value['INDIKATOR_KINERJA']?></td>
                  <td><?=$val['NO']?></td>
                  <td><?=$val['INDIKATOR_KINERJA']?></td>
                  <td  style="text-align: center;"><?=$val['BOBOT']?></td>
                  <td><?=$val['SATUAN']?></td>
                  <td><?=$val['TARGET']?></td>
                  <td><?=$val['TARGET_TAHUNAN']?></td>
                  <td><?=$val['REALISASI']?></td>
                  <td><?=$val['PENCAPAIAN']?></td>
                  <td style="text-align: center;"><?=$val['NILAI']?></td>
               <?php else: ?>
                
                  <td><?=$val['NO']?></td>
                  <td><?=$val['INDIKATOR_KINERJA']?></td>
                  <td style="text-align: center;"><?=$val['BOBOT']?></td>
                  <td><?=$val['SATUAN']?></td>
                  <td><?=$val['TARGET']?></td>
                  <td><?=$val['TARGET_TAHUNAN']?></td>
                  <td><?=$val['REALISASI']?></td>
                  <td><?=$val['PENCAPAIAN']?></td>
                  <td style="text-align: center;"><?=$val['NILAI']?></td>
               <?php endif ?>
                  
                 
               </tr>
               <?php $nilai=$nilai+ $val['NILAI'];
            if ($val['PENILAIAN'] == 1) {
               $bobot =  $bobot+$val['BOBOT'];
            }
            endforeach ?>
         <?php endforeach ?>
         <tfoot>
            <tr bgcolor="#ffbf17">
               <td></td>
               <td colspan="2">Total</td>
               <td><?=$bobot?></td>
               <td ></td>
               <td ></td>
               <td ></td>
               <td ></td>
               <td ></td>
               <td><?=substr($nilai, 0,5)?></td>
               
            </tr>
            <tr bgcolor="#009999">
               <td colspan="9">Nilai Kinerja Organisasi</td>
               <td ><?php
               $nilai_akhir =($nilai/$bobot)*100;

               $split = explode(".",$nilai_akhir);
              
               if (count($split) == '2') {
                  
                  $split['1'] = substr( $split['1'], 0,2);
                  $Pnilai =implode(".", $split);
                
               }else{
                
                  $Pnilai =  $nilai_akhir;
               } 
                echo $Pnilai;
               
               ?></td>
               
               
            </tr>
         </tfoot>

      </table>
      <small><em>Printed by : <?=$this->session->userdata('nama')?> on <?=$tgl?>  </em></small>
   </body>
</html>