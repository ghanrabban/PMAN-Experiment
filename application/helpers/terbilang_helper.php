<?php

    function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
        }   
        return $temp;
   }
  
   function terbilang($nilai) {
    if($nilai<0) {
     $hasil = "minus ". trim(penyebut($nilai));
    } else {
     $hasil = trim(penyebut($nilai));
    }       
    return $hasil;
   }
  
    //Fungsi ambil tanggal aja
   function tgl_aja($tgl_a){
     $tanggal = penyebut(substr($tgl_a,8,2));
     return $tanggal;  
   }
  
   //Fungsi Ambil bulan aja
   function bln_aja($bulan_a){
     $bulan = getBulan(substr($bulan_a,5,2));
     return $bulan;  
   } 
  
   //Fungsi Ambil tahun aja
   function thn($thn){
     $tahun = substr($thn,0,4);
     return $tahun;  
   }
   function thn_aja($thn){
    $tahun = penyebut(substr($thn,0,4));
    return $tahun;  
  }
  
   //Fungsi konversi tanggal bulan dan tahun ke dalam bahasa indonesia
   function tgl_indo($tgl){
     $tanggal = substr($tgl,8,2);
     $bulan = getBulan(substr($tgl,5,2));
     $tahun = substr($tgl,0,4);
     return $tanggal.' '.$bulan.' '.$tahun;  
   } 
   //Fungsi konversi nama bulan ke dalam bahasa indonesia
    function getBulan($bln){
      switch ($bln){
       case 1:
        return "Januari";
        break;
       case 2:
        return "Februari";
        break;
       case 3:
        return "Maret";
        break;
       case 4:
        return "April";
        break;
       case 5:
        return "Mei";
        break;
       case 6:
        return "Juni";
        break;
       case 7:
        return "Juli";
        break;
       case 8:
        return "Agustus";
        break;
       case 9:
        return "September";
        break;
       case 10:
        return "Oktober";
        break;
       case 11:
        return "November";
        break;
       case 12:
        return "Desember";
        break;
      }
    }
    function tgl_($date){
      $hari = Hari(date('l', strtotime($date)));
      $tgl = tgl_aja($date);
      $bln = bln_aja($date);
      $thn = thn_aja($date);

      return "<strong>".$hari."</strong> Tanggal <strong>".$tgl."</strong> Bulan <strong>".$bln."</strong> Tahun <strong>".$thn."</strong>";
  }

    function Hari($hari){
        $daftar_hari = 
            array( 
                'Sunday' => 'Minggu', 
                'Monday' => 'Senin', 
                'Tuesday' => 'Selasa', 
                'Wednesday' => 'Rabu', 
                'Thursday' => 'Kamis', 
                'Friday' => 'Jumat', 
                'Saturday' => 'Sabtu'
            );

        return $daftar_hari[$hari];
    }

    function Hari_($date){
      $hari = date('l', strtotime($date));
      $daftar_hari = 
          array( 
              'Sunday' => 'Minggu', 
              'Monday' => 'Senin', 
              'Tuesday' => 'Selasa', 
              'Wednesday' => 'Rabu', 
              'Thursday' => 'Kamis', 
              'Friday' => 'Jumat', 
              'Saturday' => 'Sabtu'
          );

      return $daftar_hari[$hari];
  }
    function TKTNum($id,$type =null){
      $idNextiket= GetMaxNo();
      $max=6;
      if ($type== 1 ) {
        $lt= 'PM';
      }else{
        $lt= 'CM';
      }
      if (!empty($id)) {
        $num='TK-'.$lt.'-'.$idNextiket.'-'.date('dm').substr(date('Y'),2).'-'.sprintf("%0".$max."s", $id);
      }else{
        $num='-';
      }
    
       return  $num;
    }

    function GetMaxNo(){

      $CI = &get_instance();
      $idunit= 1;
      date('Y-m-d');
      $max   = $CI->Mod->getWhere('tiket',array('create_date'=> date('Y-m-d')))->num_rows();
      return $max   ;
    }
    
  
?>
