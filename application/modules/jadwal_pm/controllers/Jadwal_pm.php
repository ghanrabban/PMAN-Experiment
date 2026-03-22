<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Jadwal_pm extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->model("m_data");
    }

    // private function position() {
    //     $data["position"] = "perangkat";
    //     return $data;
    // }

    public function index()
    {
      
        //$data = $this->position();
        // $data = access($data,"VIEW");
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Perangkat FIDS";
        $data["title_des"] = " List Data Perangkat FIDS";
        $data["content"] = "v_index";

        $data["data"] = $data;
        // $data["lokasi"] = $this->m_data->getWhere('terminal',array('parent_id ' =>'-1' ))->result_ARRAY();
        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }
    public function Area()
    {
      
        //$data = $this->position();
        // $data = access($data,"VIEW");
       
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Preventive MaintenanceS";
        $data["title_des"]  = " List Data Preventive Maintenance Area";
        $data["content"]    = "v_indexArea";

        $data["data"] = $data;
        // $data["lokasi"] = $this->m_data->getWhere('terminal',array('parent_id ' =>'-1' ))->result_ARRAY();
        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }
  
      
  
    function LoadData(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data_res=array();
        echo json_encode($data_res);
    }

    function LoadDataArea(){
     $data=array();
       $res  =  $this->Mod->GetCustome("SELECT a.*,b.name_pm,c.nama_terminal 
       FROM jadwal a left join pm_type b on b.idpm_type = a.idpm_type left join terminal c on c.id= a.id_lokasi 
       WHERE a.tgl = '".$dateNow."' AND a.shift = '".$shift."' AND a.bulan in ('','".date("m")."')")->result_array();    
		foreach ($res as $key => $value) {
            $bulan =(empty($value['bulan']) ? date("m") : $value['bulan'] );
             $data[] = array(
                'id' => $value['id_jadwalarea'],
                'title' => 'PM '.$value['nama_catagory'].' Area '.$value['nama_area'],
                'start' => date("Y").'-'.$bulan.'-'.$value['tgl'],
                'end'   => date("Y").'-'.$bulan.'-'.$value['tgl']
            );
        }
      
        echo json_encode($data);
    }

   
    
 
    public function Update($pk=null)
    {
        // echo "aa";
        // echo "<pre>", print_r($this->input->post()), "</pre>";
        // $data = $this->position();
        // $data = access($data,"UPDATE");
       
        // if (!empty($this->input->post('target'))) {
        //     foreach ($_POST['target'] as $key => $value) {
        //             $items=[
        //                 // 'PK_ID'                 => $value['PK'],
        //                 'TARGET_SEMESTER1'      => $value['target1'],
        //                 'TARGET_SEMESTER2'      => $value['target2'],
        //             ];  
                    
        //           //  $this->m_indikator->updateData('KM_MAPPING_INDIKATOR',array('PK_ID'=>$value['PK']),$items);    
        //     }	
          
        // }		
      
       
        
    }

    function UploadData(){
        $type = $this->input->post('id_lokasi');
        $m_catagory     =  $this->Mod->GetCustome("SELECT id_catagory ,LOWER(nama) as nama,id_unit,status FROM fasilitas_catagory  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_jenis        =  $this->Mod->GetCustome("SELECT id_jenisperangkat ,LOWER(nama) as nama,status,id_unit	 FROM jenis_perangkat  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_area         =  $this->Mod->GetCustome("SELECT id_area ,LOWER(nama_area) as nama_area,status FROM area  where status = '1'")->result_array();    
		$lokasi         =  $this->Mod->GetCustome("SELECT * FROM terminal  where id='".$_POST['id_lokasi']."'")->row_array();    
		$m_fasilitas       =  $this->Mod->GetCustome("SELECT  LOWER(nama_fasilitas) as nama_fasilitas,id_unit,status FROM fasilitas  where id_unit = '".sess()['unit']."' ")->result_array();   
        //  echo "<pre>", print_r($m_fasilitas), "</pre>";
        // if(isset($_FILES["perangkat"]["name"])){
		// 	$path           = $_FILES["perangkat"]["tmp_name"];
		// 	$object         = PHPExcel_IOFactory::load($path);
       
		
        //     $data           = array();
          
		// 	foreach($object->getWorksheetIterator(1) as $worksheet => $value){
		// 	    $highestRow = $value->getHighestRow();
              
        //         $lastColumn = $value->getHighestDataColumn(); 
        //         $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
               
               
               
        //             //     //   Jadwal Bulanan
        //             // if ($worksheet == 0) {
        //             //         for($col=2 ; $col<=$highestColumnIndex; $col++){
        //             //             if (!empty($value->getCellByColumnAndRow($col, 10)->getValue())) {
        //             //                 $tgl        = $value->getCellByColumnAndRow($col, 10)->getValue();
                                
        //             //                 if ( $tgl<10) {
        //             //                     $tgl = "0".$tgl;
        //             //                 }
        //             //             }else{
        //             //                 $tgl='';
        //             //             }
        //             //         for ($row=12; $row <=$highestRow ; $row++) { 
        //             //             if (!empty($value->getCellByColumnAndRow(0, $row)->getValue())) {
        //             //                 $IP      = $value->getCellByColumnAndRow(1, $row)->getValue();
        //             //                 // $master    =  $this->m_data->getWhere('fasilitas',array('ip_address' => $IP ))->row_array();
        //             //                 // 
        //             //                 if (!empty($master)) {
        //             //                             $id_perangkat = $master['id_fasilitas'];
        //             //                         }else{
        //             //                             $id_perangkat = '';
                                            
        //             //                 }
        //             //             }else{
        //             //                 $id_perangkat = '';
        //             //             }
                                
        //             //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
        //             //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();

        //             //                     $data[]=[
        //             //                         'id_perangkat'  => $id_perangkat,
        //             //                         'fasilitas'     => $value->getCellByColumnAndRow(0, $row)->getValue(),
        //             //                         'tgl'           => $tgl,
        //             //                         'shift'         => $shift,
        //             //                         'type'          => 3,
        //             //                         'bln_excel'     => '' ,
        //             //                         'status'        => (!empty($id_perangkat) ? 1:0),
        //             //                         'col'           => $col,
        //             //                         'row'           => $row,
        //             //                     ];
        //             //                 }else{
        //             //                     $shift      = '';
        //             //                 }
                                
                                    

        //             //         }
        //             //         }  
        //             // }

        //             // //Jadwal Triwulan
        //             // // if ($worksheet == 1) {
        //             // //     for($col=2 ; $col<=$highestColumnIndex; $col++){
        //             // //         if (!empty($value->getCellByColumnAndRow($col, 11)->getValue())) {
        //             // //             $tgl        = $value->getCellByColumnAndRow($col, 11)->getValue();
                            
        //             // //             if ( $tgl<10) {
        //             // //                 $tgl = "0".$tgl;
        //             // //             }
        //             // //         }else{
        //             // //             $tgl='';
        //             // //         }

                            
        //             // //                 if ($col >= 2 && $col<=12) {
        //             // //                     $col_bln= 2;
        //             // //                 }elseif ($col >= 13  && $col<=22) {
        //             // //                     $col_bln= 13;
        //             // //                 }elseif ($col >= 23 && $col<=32) {
        //             // //                     $col_bln= 23;
        //             // //                 }
        //             // //                 $bln_excel          = $value->getCellByColumnAndRow($col_bln, 10)->getValue();
        //             // //                 $bln_ary            = explode(",",$bln_excel);
        //             // //         for ($row=13; $row <=$highestRow ; $row++) { 
        //             // //             if (!empty($value->getCellByColumnAndRow(0, $row)->getValue())) {
        //             // //                 $IP      = $value->getCellByColumnAndRow(1, $row)->getValue();
        //             // //                 $master    =  $this->m_data->getWhere('fasilitas',array('ip_address' => $IP ))->row_array();
        //             // //                 if (!empty($master)) {
        //             // //                             $id_perangkat = $master['id_fasilitas'];
        //             // //                         }else{
        //             // //                             $id_perangkat = '';
                                            
        //             // //                 }
        //             // //             }else{
        //             // //                 $id_perangkat = '';
        //             // //             }
                                
        //             // //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
        //             // //                     $shift              = $value->getCellByColumnAndRow($col, $row)->getValue();
                                    
        //             // //                     $data[]=[
        //             // //                         'id_perangkat'  => $id_perangkat,
        //             // //                         'lokasi'        => (!empty($lokasi) ? $lokasi:0),
        //             // //                         'fasilitas'     => $value->getCellByColumnAndRow(0, $row)->getValue(),
        //             // //                         'tgl'           => $tgl,
        //             // //                         'shift'         => $shift,
        //             // //                         'type'          => 4,
        //             // //                         'bln_excel'     => $bln_ary ,
        //             // //                         'status'        => (!empty($id_perangkat) ? 1:0),
        //             // //                         'col'           => $col,
        //             // //                         'row'           => $row,
        //             // //                     ];
        //             // //                 }else{
        //             // //                     $shift      = '';
        //             // //                 }
                                
                                    

        //             // //         }
        //             // //     }  
        //             // // }
            
        //             //     //Jadwal Semesteran
        //             // // if ($worksheet == 2) {
        //             // //     for($col=2 ; $col<=$highestColumnIndex; $col++){
        //             // //         if (!empty($value->getCellByColumnAndRow($col, 11)->getValue())) {
        //             // //             $tgl        = $value->getCellByColumnAndRow($col, 11)->getValue();
                            
        //             // //             if ( $tgl<10) {
        //             // //                 $tgl = "0".$tgl;
        //             // //             }
        //             // //         }else{
        //             // //             $tgl='';
        //             // //         }

                            
        //             // //         if ($col >= 2 && $col<=6) {
        //             // //             $col_bln= 2;
        //             // //         }elseif ($col >= 7  && $col<=11) {
        //             // //             $col_bln= 7;
        //             // //         }elseif ($col >= 12 && $col<=16) {
        //             // //             $col_bln= 12;
        //             // //         }elseif ($col >= 17 && $col<=21) {
        //             // //             $col_bln= 17;
        //             // //         }
        //             // //         elseif ($col >= 22 && $col<=26) {
        //             // //             $col_bln= 22;
        //             // //         } elseif ($col >= 27 && $col<=31) {
        //             // //             $col_bln= 27;
        //             // //         }
        //             // //         $bln_excel          = $value->getCellByColumnAndRow($col_bln, 10)->getValue();
        //             // //         $bln_ary            = explode(",",$bln_excel);
                            
        //             // //         for ($row=13; $row <=$highestRow ; $row++) { 
        //             // //             if (!empty($value->getCellByColumnAndRow(0, $row)->getValue())) {
        //             // //                 $IP      = $value->getCellByColumnAndRow(1, $row)->getValue();
        //             // //                 $master    =  $this->m_data->getWhere('fasilitas',array('ip_address' => $IP ))->row_array();
        //             // //                 if (!empty($master)) {
        //             // //                             $id_perangkat = $master['id_fasilitas'];
        //             // //                         }else{
        //             // //                             $id_perangkat = '';
                                            
        //             // //                 }
        //             // //             }else{
        //             // //                 $id_perangkat = '';
        //             // //             }
                                
        //             // //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
        //             // //                     $shift              = $value->getCellByColumnAndRow($col, $row)->getValue();
                                    
        //             // //                     $data[]=[
        //             // //                         'id_perangkat'  => $id_perangkat,
        //             // //                         'fasilitas'     => $value->getCellByColumnAndRow(0, $row)->getValue(),
        //             // //                         'tgl'           => $tgl,
        //             // //                         'shift'         => $shift,
        //             // //                         'type'          => 5,
        //             // //                         'bln_excel'     => $bln_ary ,
        //             // //                         'status'        => (!empty($id_perangkat) ? 1:0),
        //             // //                         'col'           => $col,
        //             // //                         'row'           => $row,
        //             // //                     ];
        //             // //                 }else{
        //             // //                     $shift      = '';
        //             // //                 }
                                
                                    

        //             // //         }
        //             // //      }  
        //             // // }

        //             //     //Jadwal Tahunan
        //             // // if ($worksheet == 3) {
        //             // //     for($col=2 ; $col<=$highestColumnIndex; $col++){
        //             // //         if (!empty($value->getCellByColumnAndRow($col, 11)->getValue())) {
        //             // //             $tgl        = $value->getCellByColumnAndRow($col, 11)->getValue();
                            
        //             // //             if ( $tgl<10) {
        //             // //                 $tgl = "0".$tgl;
        //             // //             }
        //             // //         }else{
        //             // //             $tgl='';
        //             // //         }

                            
        //             // //         if ($col >= 2 && $col<=6) {
        //             // //             $col_bln= 2;
        //             // //         }elseif ($col >= 7  && $col<=11) {
        //             // //             $col_bln= 7;
        //             // //         }elseif ($col >= 12 && $col<=16) {
        //             // //             $col_bln= 12;
        //             // //         }elseif ($col >= 17 && $col<=21) {
        //             // //             $col_bln= 17;
        //             // //         }elseif ($col >= 22 && $col<=26) {
        //             // //             $col_bln= 22;
        //             // //         } elseif ($col >= 27 && $col<=31) {
        //             // //             $col_bln= 27;
        //             // //         }
        //             // //         $bln_excel          = $value->getCellByColumnAndRow($col_bln, 10)->getValue();
        //             // //         $bln_ary            = explode(",",$bln_excel);
                            
        //             // //         for ($row=13; $row <=$highestRow ; $row++) { 
        //             // //             if (!empty($value->getCellByColumnAndRow(0, $row)->getValue())) {
        //             // //                 $IP      = $value->getCellByColumnAndRow(1, $row)->getValue();
        //             // //                 $master    =  $this->m_data->getWhere('fasilitas',array('ip_address' => $IP ))->row_array();
        //             // //                 if (!empty($master)) {
        //             // //                             $id_perangkat = $master['id_fasilitas'];
        //             // //                         }else{
        //             // //                             $id_perangkat = '';
                                            
        //             // //                 }
        //             // //             }else{
        //             // //                 $id_perangkat = '';
        //             // //             }
                                
        //             // //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
        //             // //                     $shift              = $value->getCellByColumnAndRow($col, $row)->getValue();
                                    
        //             // //                     $data[]=[
        //             // //                         'id_perangkat'  => $id_perangkat,
        //             // //                         'fasilitas'     => $value->getCellByColumnAndRow(0, $row)->getValue(),
        //             // //                         'tgl'           => $tgl,
        //             // //                         'shift'         => $shift,
        //             // //                         'type'          => 6,
        //             // //                         'bln_excel'     => $bln_ary ,
        //             // //                         'status'        => (!empty($id_perangkat) ? 1:0),
        //             // //                         'col'           => $col,
        //             // //                         'row'           => $row,
        //             // //                     ];
        //             // //                 }else{
        //             // //                     $shift      = '';
        //             // //                 }
                                
                                    

        //             // //         }
        //             // //     }  
        //             // // }
                
        //     }
        //     echo "<pre>", print_r($data), "</pre>";
        //     $insert    = array();
        //     foreach ($data as $key => $value) {
        //         if ($type ==1) {
        //             $lokasi['id_lokasi']    = '3';
        //         }else{
        //             $lokasi    =  $this->Mod->GetCustome("SELECT b.id_lokasi FROM fasilitas_detail a left join fasilitas b on b.id_fasilitas = a.id_fasilitas where a.id_perangkat = '".$value['id_perangkat']."'")->row_array();
        //            // echo "<pre>", print_r("SELECT b.id_lokasi FROM fasilitas_detail a left join fasilitas b on b.id_fasilitas = a.id_fasilitas where a.id_perangkat = '".$value['id_perangkat']."'"), "</pre>";
        //         }
                
        //         if (!empty($value['bln_excel'])) {
        //             foreach ($value['bln_excel'] as $val2) {
        //                 $insert[]=[
        //                     'id_perangkat'  => $value['id_perangkat'],
        //                     'id_lokasi'     => (!empty($lokasi) ?  $lokasi['id_lokasi']: ''),
        //                     'fasilitas'     => $value['fasilitas'],
        //                     'tgl'           => $value['tgl'],
        //                     'bulan'         => bln_con($val2),
        //                     'tahun'         => date("Y"),
        //                     'shift'         => $value['shift'],
        //                     'idpm_type'     => $value['type'],
        //                     'status'        => 1,
        //                 ];
        //                 // $this->m_data->insertData('jadwal',$insert);
        //             }
        //         }else{
        //             $insert[]=[
        //                 'id_unit'       => sess()['unit'],
        //                 'id_perangkat'  => $value['id_perangkat'],
        //                 'id_lokasi'     => (!empty($lokasi) ?  $lokasi['id_lokasi']: ''),
        //                 'fasilitas'     => $value['fasilitas'],
        //                 'tgl'           => $value['tgl'],
        //                 'bulan'         => '',
        //                 'tahun'         => date("Y"),
        //                 'shift'         => $value['shift'],
        //                 'idpm_type'     => $value['type'],
        //                 'status'        => 1,
        //             ];
                   
        //             // $this->m_data->insertData('jadwal',$insert);
                  
        //         }
                
        //     }
        //       echo "<pre>", print_r($insert), "</pre>";
        //     // $this->db->insert_batch('jadwal', $insert);
           
           
        // }
         
        $demo_error=array();                     
        if(isset($_FILES["perangkat"]["name"])){
			$path           = $_FILES["perangkat"]["tmp_name"];
			$object         = PHPExcel_IOFactory::load($path);
            $data           = array();
          
			foreach($object->getWorksheetIterator(0) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
                        //   Jadwal Harian
                    if ($worksheet == 0) {
                            for($col=2 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                }else{
                                    $tgl='';
                                }
                             
                                for ($row=3; $row <=$highestRow ; $row++) { 
                                    $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                   
                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        
                                       
                                        if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                                            $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$fasilitas." tidak di temukan"
                                            ];
                                            $id_fasilitas ='';
                                        }

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                         
                                        $data[]=[
                                            'id_unit'       => sess()['unit'],
                                            'id_perangkat'  => $id_fasilitas,
                                            'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                                            'fasilitas'     => $fasilitas,
                                            'tgl'           => $tgl ,
                                            'bulan'         => '',
                                            'tahun'         => date("Y"),
                                            'shift'         => $shift ,
                                            'idpm_type'     => 1,
                                            'status'        => 1,
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                }
                            }  
                    }
                    //   Jadwal mingguan
                    // if ($worksheet == 1) {
                    //         for($col=2 ; $col<=$highestColumnIndex; $col++){
                    //             if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                    //                 $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                    //                 if ( $tgl<10) {
                    //                     $tgl = "0".$tgl;
                    //                 }
                    //             }else{
                    //                 $tgl='';
                    //             }
                             
                    //             for ($row=3; $row <=$highestRow ; $row++) { 
                    //                  $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                               
                    //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                       
                                       
                    //                     if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                    //                         $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                    //                     }else{ 
                    //                         $demo_error[] = [
                    //                             'sheet' => 1,
                    //                             'row'   => $row,
                    //                             'col'   => 'B',
                    //                             'msg'   => 'value '.$fasilitas." tidak di temukan"
                    //                         ];
                    //                         $id_fasilitas ='';
                    //                     }

                                    
                    //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                         
                    //                     $data[]=[
                    //                     'id_unit'       => sess()['unit'],
                    //                     'id_perangkat'  => $id_fasilitas,
                    //                     'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                    //                     'fasilitas'     => $fasilitas,
                    //                     'tgl'           => $tgl ,
                    //                     'bulan'         => '',
                    //                     'tahun'         => date("Y"),
                    //                     'shift'         => $shift ,
                    //                     'idpm_type'     => 2,
                    //                     'status'        => 1,
                    //                     ];
                    //                 }else{
                    //                     $shift      = '';
                    //                 }
                    //             }
                    //         }  
                    // }

                    // if ($worksheet == 2) {
                    //         for($col=2 ; $col<=$highestColumnIndex; $col++){
                    //             if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                    //                 $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                    //                 if ( $tgl<10) {
                    //                     $tgl = "0".$tgl;
                    //                 }
                    //                 }else{
                    //                     $tgl='';
                    //                 }

                    //                if ($col >= 2 && $col<=11) {
                    //                     $col_bln= 2;
                    //                 }elseif ($col >= 12  && $col<=20) {
                    //                     $col_bln= 12;
                    //                 }elseif ($col >= 21 && $col<=30) {
                    //                     $col_bln= 21;
                    //                 }
                    //                     $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                    //                     $bln_ary            = explode(",",$bln_excel);
                    //             for ($row=3; $row <=$highestRow ; $row++) { 
                    //                  $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                               
                    //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                       
                    //                     if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                    //                         $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                    //                     }else{ 
                    //                         $demo_error[] = [
                    //                             'sheet' => 2,
                    //                             'row'   => $row,
                    //                             'col'   => 'B',
                    //                             'msg'   => 'value '.$fasilitas." tidak di temukan"
                    //                         ];
                    //                         $id_fasilitas ='';
                    //                     }

                    //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                    //                     $data[]=[
                    //                     'id_unit'       => sess()['unit'],
                    //                     'id_perangkat'  => $id_fasilitas,
                    //                     'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                    //                     'fasilitas'     => $fasilitas,
                    //                     'tgl'           => $tgl ,
                    //                     'bulan'         => $bln_ary ,
                    //                     'tahun'         => date("Y"),
                    //                     'shift'         => $shift ,
                    //                     'idpm_type'     => 3,
                    //                     'status'        => 1,
                    //                     ];
                    //                 }else{
                    //                     $shift      = '';
                    //                 }
                                
                                    

                    //         }
                    //         }  
                    // }
                    //   Jadwal bulanan
                    // if ($worksheet == 3) {
                    //         for($col=2 ; $col<=$highestColumnIndex; $col++){
                    //             if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                    //                 $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                    //                 if ( $tgl<10) {
                    //                     $tgl = "0".$tgl;
                    //                 }
                    //                 }else{
                    //                     $tgl='';
                    //                 }

                    //                if ($col >= 2 && $col<=11) {
                    //                     $col_bln= 2;
                    //                 }elseif ($col >= 12  && $col<=20) {
                    //                     $col_bln= 12;
                    //                 }elseif ($col >= 21 && $col<=30) {
                    //                     $col_bln= 21;
                    //                 }
                    //                     $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                    //                     $bln_ary            = explode(",",$bln_excel);
                    //             for ($row=3; $row <=$highestRow ; $row++) { 
                    //                  $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                               
                    //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                       
                    //                     if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                    //                         $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                    //                     }else{ 
                    //                         $demo_error[] = [
                    //                             'sheet' => 3,
                    //                             'row'   => $row,
                    //                             'col'   => 'B',
                    //                             'msg'   => 'value '.$fasilitas." tidak di temukan"
                    //                         ];
                    //                         $id_fasilitas ='';
                    //                     }

                    //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                    //                     $data[]=[
                    //                     'id_unit'       => sess()['unit'],
                    //                     'id_perangkat'  => $id_fasilitas,
                    //                     'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                    //                     'fasilitas'     => $fasilitas,
                    //                     'tgl'           => $tgl ,
                    //                     'bulan'         => $bln_ary ,
                    //                     'tahun'         => date("Y"),
                    //                     'shift'         => $shift ,
                    //                     'idpm_type'     => 4,
                    //                     'status'        => 1,
                    //                     ];
                    //                 }else{
                    //                     $shift      = '';
                    //                 }
                                
                                    

                    //         }
                    //         }  
                    // }

                    //   Jadwal triwulan
                    // if ($worksheet == 4) {
                    //         for($col=2 ; $col<=$highestColumnIndex; $col++){
                    //             if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                    //                 $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                    //                 if ( $tgl<10) {
                    //                     $tgl = "0".$tgl;
                    //                 }
                    //                 }else{
                    //                     $tgl='';
                    //                 }

                    //                 if ($col >= 2 && $col<=6) {
                    //                     $col_bln= 4;
                    //                 }elseif ($col >= 7  && $col<=11) {
                    //                     $col_bln= 9;
                    //                 }elseif ($col >= 12 && $col<=16) {
                    //                     $col_bln= 14;
                    //                 }elseif ($col >= 17 && $col<=21) {
                    //                     $col_bln= 19;
                    //                 }elseif ($col >= 22 && $col<=26) {
                    //                     $col_bln= 24;
                    //                 }elseif ($col >= 27 && $col<=31) {
                    //                     $col_bln= 29;
                    //                 }
                    //                     $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                    //                     $bln_ary            = explode(",",$bln_excel);
                    //             for ($row=3; $row <=$highestRow ; $row++) { 
                    //                  $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                               
                    //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                       
                    //                     if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                    //                         $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                    //                     }else{ 
                    //                         $demo_error[] = [
                    //                             'sheet' => 4,
                    //                             'row'   => $row,
                    //                             'col'   => 'B',
                    //                             'msg'   => 'value '.$fasilitas." tidak di temukan"
                    //                         ];
                    //                         $id_fasilitas ='';
                    //                     }

                    //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                    //                     $data[]=[
                    //                     'id_unit'       => sess()['unit'],
                    //                     'id_perangkat'  => $id_fasilitas,
                    //                     'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                    //                     'fasilitas'     => $fasilitas,
                    //                     'tgl'           => $tgl ,
                    //                     'bulan'         => $bln_ary ,
                    //                     'tahun'         => date("Y"),
                    //                     'shift'         => $shift ,
                    //                     'idpm_type'     => 5,
                    //                     'status'        => 1,
                    //                     ];
                    //                 }else{
                    //                     $shift      = '';
                    //                 }
                                
                                    

                    //         }
                    //         }  
                    // }

                     //   Jadwal tahunan
                    // if ($worksheet == 5) {
                    //         for($col=2 ; $col<=$highestColumnIndex; $col++){
                    //             if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                    //                 $tgl        = $value->getCellByColumnAndRow($col, 2)->getValue();
                                
                    //                 if ( $tgl<10) {
                    //                     $tgl = "0".$tgl;
                    //                 }
                    //                 }else{
                    //                     $tgl='';
                    //                 }

                    //                 if ($col >= 2 && $col<=6) {
                    //                     $col_bln= 4;
                    //                 }elseif ($col >= 7  && $col<=11) {
                    //                     $col_bln= 9;
                    //                 }elseif ($col >= 12 && $col<=16) {
                    //                     $col_bln= 14;
                    //                 }elseif ($col >= 17 && $col<=21) {
                    //                     $col_bln= 19;
                    //                 }elseif ($col >= 22 && $col<=26) {
                    //                     $col_bln= 24;
                    //                 }elseif ($col >= 27 && $col<=31) {
                    //                     $col_bln= 29;
                    //                 }
                    //                     $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                    //                     $bln_ary            = explode(",",$bln_excel);
                    //             for ($row=3; $row <=$highestRow ; $row++) { 
                    //                  $fasilitas          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                               
                    //                 if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                       
                    //                     if(in_array($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'))){
                    //                         $id_fasilitas  = array_search($fasilitas, array_column($m_fasilitas, 'nama_fasilitas'));
                    //                     }else{ 
                    //                         $demo_error[] = [
                    //                             'sheet' => 5,
                    //                             'row'   => $row,
                    //                             'col'   => 'B',
                    //                             'msg'   => 'value '.$fasilitas." tidak di temukan"
                    //                         ];
                    //                         $id_fasilitas ='';
                    //                     }

                    //                     $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                    //                     $data[]=[
                    //                     'id_unit'       => sess()['unit'],
                    //                     'id_perangkat'  => $id_fasilitas,
                    //                     'id_lokasi'     => (!empty($_POST['id_lokasi']) ?  $_POST['id_lokasi']: ''),
                    //                     'fasilitas'     => $fasilitas,
                    //                     'tgl'           => $tgl ,
                    //                     'bulan'         => $bln_ary ,
                    //                     'tahun'         => date("Y"),
                    //                     'shift'         => $shift ,
                    //                     'idpm_type'     => 6,
                    //                     'status'        => 1,
                    //                     ];
                    //                 }else{
                    //                     $shift      = '';
                    //                 }
                    //             }
                    //         }  
                    // }



            }
       
            // $insert    = array();
            // echo "<pre>", print_r($demo_error), "</pre>";
            //  echo "<pre>", print_r($data), "</pre>";
            
            if ($demo_error) {
                // echo "<pre>", print_r($demo_error), "</pre>";
                foreach ($demo_error as $key_r =>$error) {
                    $sheet      = $error["sheet"];
                    $column     = $error["col"];
                    $row        = $error["row"];
                    $message    = $error["msg"];
                    $object->setActiveSheetIndex($sheet);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->getStartColor()->setARGB("ffffcece");
                    $object->getActiveSheet()->getTabColor()->setARGB('FFFF0000');
                    $object->getActiveSheet()->getComment("$column$row")->setAuthor('James Tri');
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun($message);
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                }

                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
                $namafile = "Error Loader Template ".$lokasi['nama_terminal'] ." - ". date("Y-m-d H.i.s") . ".xlsx";
                $path = "./temp/$namafile";
                 $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                );
                $objWriter->save($path);
                echo json_encode($respon_data);
            }else{
                foreach ($data as $key => $value) {
                    if (!empty($value['bulan'])) {
                        foreach ($value['bulan'] as $val2) {
                            $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $value['id_lokasi'],
                                'id_perangkat'      => $value['id_perangkat'],
                                'fasilitas'         => $value['fasilitas'],
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'bulan'             => bln_con($val2),
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                            // echo "<pre>", print_r($insert), "</pre>";
                           $this->m_data->insertData('jadwal',$insert);
                    
                        }
                    }else{
                        $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $value['id_lokasi'],
                                'id_perangkat'      => $value['id_perangkat'],
                                'fasilitas'         => $value['fasilitas'],
                                'bulan'             => '',
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                            //    echo "<pre>", print_r($insert), "</pre>";
                        $this->m_data->insertData('jadwal',$insert);
                    
                    }
                    
                }
                 $respon_data = array(
                    "STATUS"        => 200,
                    "PATH"          => '',
                    "FILENAME"      => '',
                );
                 echo json_encode($respon_data);
            }
           
           
            // $this->db->insert_batch('jadwal_pm_area', $insert);
           
           
        }
    }

      function UploadDataArea(){
        $terminal = $_POST['id_lokasi'];
        // $m_catagory     =  $this->Mod->GetCustome("SELECT id_catagory ,LOWER(nama) as nama,id_unit,status FROM fasilitas_catagory  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		// $m_jenis        =  $this->Mod->GetCustome("SELECT id_jenisperangkat ,LOWER(nama) as nama,status,id_unit	 FROM jenis_perangkat  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		// $m_area         =  $this->Mod->GetCustome("SELECT id_area ,LOWER(nama_area) as nama_area,status FROM area  where status = '1'")->result_array();    
		// $lokasi         =  $this->Mod->GetCustome("SELECT * FROM terminal  where id='".$_POST['id_lokasi']."'")->row_array();    
		
        //
        $a = upload("perangkat", "./temp", "xls|xlsx", 5120, "loader_template_" . time());

        if ($a["result"]) {

            if (session("loader") != "") {
                @unlink(session("loader"));
            }

            $loader = $a["data_upload"]["file_url"];
            #$loader = "./upload/template.xlsx";
            $this->session->set_userdata("loader", $loader);
            if (sess()['unit']== '4') {
            //    echo "GES";
                 $res  = $this->LoaderPMGES($loader, $terminal);
            }else{
                echo "ALL";
                $res ='KOsong';
            }
          
            @unlink(session("loader"));
            echo json_encode($res);
        
            #$this->session->set_userdata("loader_result", $this->loader($loader));
          //  echo json_encode(array('STATUS' => 200));
        }
    }

    function LoaderPMGES($loader,$terminal){
        $m_catagory     =  $this->Mod->GetCustome("SELECT id_catagory ,LOWER(nama) as nama,id_unit,status FROM fasilitas_catagory  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_jenis        =  $this->Mod->GetCustome("SELECT id_jenisperangkat ,LOWER(nama) as nama,status,id_unit	 FROM jenis_perangkat  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_area         =  $this->Mod->GetCustome("SELECT id_area ,LOWER(nama_area) as nama_area,status FROM area  where status = '1'")->result_array();    
		$lokasi         =  $this->Mod->GetCustome("SELECT * FROM terminal  where id='".$terminal."'")->row_array();    
		
        //
        $demo_error=array();                     
       
			$path           = $loader;
			$object         = PHPExcel_IOFactory::load($path);
       
		
            $data           = array();
          
			foreach($object->getWorksheetIterator(0) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
                        //   Jadwal Harian
                    if ($worksheet == 0) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }
                                    if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                    // if ($col >= 4 && $col<=33) {
                                    //     $col_bln= 4;
                                    // }elseif ($col >= 14  && $col<=22) {
                                    //     $col_bln= 14;
                                    // }elseif ($col >= 23 && $col<=32) {
                                    //     $col_bln= 23;
                                    // }
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' =>0,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                            'id_lokasi'         => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '1',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }

                        // Jadwal Mingguan
                     if ($worksheet == 1) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }
                                    if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                   
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' =>0,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                            'id_lokasi'         => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '2',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }
                     // Jadwal Bulanan
                    if ($worksheet == 2) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                            'id_lokasi'         => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '3',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }
                    // Jadwal Triwulan
                    if ($worksheet == 3) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                     if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);

                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());
                                    
                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '4',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }
                    
                    // Jadwal Semesteran
                    if ($worksheet == 4) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                    
                                    
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                     $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}


                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '5',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }

                        // Jadwal Tahunan
                    if ($worksheet == 5) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if (!empty($value->getCellByColumnAndRow($col, 2)->getValue())) {
                                        $col_bln= $col;
                                    }else{
                                        $col_bln=  $col_bln;
                                    }
                                    
                                    
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                    $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                    $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '6',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }

                    
            }
       
            // $insert    = array();
           
            if ($demo_error) {
                // echo "<pre>", print_r($demo_error), "</pre>";
                foreach ($demo_error as $key_r =>$error) {
                    $sheet      = $error["sheet"];
                    $column     = $error["col"];
                    $row        = $error["row"];
                    $message    = $error["msg"];
                    $object->setActiveSheetIndex($sheet);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->getStartColor()->setARGB("ffffcece");
                    $object->getActiveSheet()->getTabColor()->setARGB('FFFF0000');
                    $object->getActiveSheet()->getComment("$column$row")->setAuthor('James Tri');
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun($message);
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                }

                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
                $namafile = "Error Loader Template ".$lokasi['nama_terminal'] ." - ". date("Y-m-d H.i.s") . ".xlsx";
                $path = "./temp/$namafile";
                 $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                );
                $objWriter->save($path);
                return $respon_data;
                // echo json_encode($respon_data);
            }else{
                foreach ($data as $key => $value) {
                
                    
                    if (!empty($value['bulan'])) {
                        
                        foreach ($value['bulan'] as $val2) {
                        
                            $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $terminal,
                                'id_catagory'       => $value['id_catagory'],
                                'id_jenisperangkat' => $value['id_jenisperangkat'],
                                'id_area'           => $value['id_area'],
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'bulan'             => bln_con($val2),
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                           
                            //  echo "<h1>Harian Bulan</h1>";
                            // echo "<pre>", print_r($insert), "</pre>";
                            $this->m_data->insertData('jadwal_pm_area',$insert);
                    
                        }
                    }else{
                        $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $terminal,
                                'id_catagory'       => $value['id_catagory'],
                                'id_jenisperangkat' => $value['id_jenisperangkat'],
                                'id_area'           => $value['id_area'],
                                'bulan'             => '',
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                            // echo "<pre>", print_r($insert), "</pre>";
                        $this->m_data->insertData('jadwal_pm_area',$insert);
                    
                    }
                    
                }
                 $respon_data = array(
                    "STATUS"        => 200,
                    "PATH"          => '',
                    "UNIT"          => $value['id_unit'],
                    "FILENAME"      => '',
                );

                return $respon_data;
                //  echo json_encode($respon_data);
            }
            // echo "<pre>", print_r($demo_error), "</pre>";
           
            // $this->db->insert_batch('jadwal_pm_area', $insert);
           
           
       
    }

    function LoaderPM_All($loader,$terminal){
        $m_catagory     =  $this->Mod->GetCustome("SELECT id_catagory ,LOWER(nama) as nama,id_unit,status FROM fasilitas_catagory  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_jenis        =  $this->Mod->GetCustome("SELECT id_jenisperangkat ,LOWER(nama) as nama,status,id_unit	 FROM jenis_perangkat  where id_unit = '".sess()['unit']."' AND status = '1'")->result_array();    
		$m_area         =  $this->Mod->GetCustome("SELECT id_area ,LOWER(nama_area) as nama_area,status FROM area  where status = '1'")->result_array();    
		$lokasi         =  $this->Mod->GetCustome("SELECT * FROM terminal  where id='".$terminal."'")->row_array();    
		
        //
        $demo_error=array();                     
       
			$path           = $loader;
			$object         = PHPExcel_IOFactory::load($path);
       
		
            $data           = array();
          
			foreach($object->getWorksheetIterator(0) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
                        //   Jadwal Harian
                    if ($worksheet == 0) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                }else{
                                    $tgl='';
                                }
                             
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                     $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                            $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 0,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'       => sess()['unit'],
                                            'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'     => '1',
                                            'tgl'           => $tgl,
                                            'shift'         => $shift,
                                            'status'        => (!empty($id_catagory) ? 1:0),
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }

                    // Jadwal Mingguan
                    if ($worksheet == 1) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                        if ( $tgl<10) {
                                            $tgl = "0".$tgl;
                                        }
                                }else{
                                        $tgl='';
                                }

                                   
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 1,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 1,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 1,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '2',
                                            'tgl'               => $tgl,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                }
                            }  
                    }
                     // Jadwal Bulanan
                    if ($worksheet == 2) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if ($col >= 4 && $col<=13) {
                                        $col_bln= 4;
                                    }elseif ($col >= 14  && $col<=22) {
                                        $col_bln= 14;
                                    }elseif ($col >= 23 && $col<=32) {
                                        $col_bln= 23;
                                    }
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 2,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                       
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                            'id_lokasi'         => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '3',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }
                    // Jadwal Triwulan
                    if ($worksheet == 3) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if ($col >= 4 && $col<=14) {
                                        $col_bln= 4;
                                    }elseif ($col >= 15  && $col<=24) {
                                        $col_bln= 15;
                                    }elseif ($col >= 25 && $col<=34) {
                                        $col_bln= 25;
                                    }
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);

                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());
                                    
                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 3,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '4',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }
                    
                    // Jadwal Semesteran
                    if ($worksheet == 4) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if ($col >= 4 && $col<=8) {
                                        $col_bln= 4;
                                    }elseif ($col >= 9  && $col<=13) {
                                        $col_bln= 9;
                                    }elseif ($col >= 14 && $col<=18) {
                                        $col_bln= 14;
                                    }elseif ($col >= 19 && $col<=23) {
                                        $col_bln= 19;
                                    }elseif ($col >= 24 && $col<=28) {
                                        $col_bln= 24;
                                    }elseif ($col >= 29 && $col<=33) {
                                        $col_bln= 29;
                                    }
                                    
                                    
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                     $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                     $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                     $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 4,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}


                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '5',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            'col'           => $col,
                                            'row'           => $row,
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                }
                            }  
                    }

                     // Jadwal Tahunan
                    if ($worksheet == 5) {
                            for($col=4 ; $col<=$highestColumnIndex; $col++){
                                if (!empty($value->getCellByColumnAndRow($col, 3)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 3)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                    }else{
                                        $tgl='';
                                    }

                                    if ($col >= 4 && $col<=8) {
                                        $col_bln= 4;
                                    }elseif ($col >= 9  && $col<=13) {
                                        $col_bln= 9;
                                    }elseif ($col >= 14 && $col<=18) {
                                        $col_bln= 14;
                                    }elseif ($col >= 19 && $col<=23) {
                                        $col_bln= 19;
                                    }elseif ($col >= 24 && $col<=28) {
                                        $col_bln= 24;
                                    }elseif ($col >= 29 && $col<=33) {
                                        $col_bln= 29;
                                    }
                                    
                                    
                                        $bln_excel          = $value->getCellByColumnAndRow($col_bln, 2)->getValue();
                                        $bln_ary            = explode(",",$bln_excel);
                                for ($row=4; $row <=$highestRow ; $row++) { 
                                    $catagory          = strtolower($value->getCellByColumnAndRow(1, $row)->getValue());
                                    $jenisperangkat    = strtolower($value->getCellByColumnAndRow(2, $row)->getValue());
                                    $area              = strtolower($value->getCellByColumnAndRow(3, $row)->getValue());

                                    if (!empty($value->getCellByColumnAndRow($col, $row)->getValue())) {
                                        if(in_array($catagory, array_column($m_catagory, 'nama'))){
                                        $id_catagory = array_search($catagory, array_column($m_catagory, 'nama'));
                                    
                                        $m_catagory[$id_catagory];
                                        //  echo "<pre>", print_r($m_catagory[$id_catagory]['id_catagory']), "</pre>";
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'B',
                                                'msg'   => 'value '.$catagory." tidak di temukan"
                                            ];
                                            $id_catagory ='';}

                                        if(in_array($jenisperangkat, array_column($m_jenis, 'nama'))){
                                        $id_jenis = array_search($jenisperangkat, array_column($m_jenis, 'nama'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'C',
                                                'msg'   => 'value '.$jenisperangkat." tidak di temukan"
                                            ];
                                            $id_jenis ='';}

                                        if(in_array($area, array_column($m_area, 'nama_area'))){
                                        $id_area  = array_search($area, array_column($m_area, 'nama_area'));
                                        }else{ 
                                            $demo_error[] = [
                                                'sheet' => 5,
                                                'row'   => $row,
                                                'col'   => 'D',
                                                'msg'   => 'value '.$area." tidak di temukan"
                                            ];
                                            $id_area ='';}

                                    
                                        $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();
                                        
                                        $data[]=[
                                        
                                            'id_unit'           => sess()['unit'],
                                             'id_lokasi'     => $lokasi,
                                            'id_catagory'       => (!empty($m_catagory[$id_catagory]['id_catagory']) ? $m_catagory[$id_catagory]['id_catagory']:$catagory),
                                            'id_jenisperangkat' => (!empty($m_jenis[$id_jenis]['id_jenisperangkat']) ? $m_jenis[$id_jenis]['id_jenisperangkat']:$jenisperangkat) ,
                                            'id_area'           => (!empty($m_area[$id_area]['id_area']) ? $m_area[$id_area]['id_area']:$area) ,
                                            'idpm_type'         => '6',
                                            'tgl'               => $tgl,
                                            'bulan'             => $bln_ary ,
                                            'shift'             => $shift,
                                            'status'            => (!empty($id_catagory) ? 1:0),
                                            
                                        ];
                                      
                                    }else{
                                        $shift      = '';
                                    }
                                
                                    

                            }
                            }  
                    }

                    
            }
       
            // $insert    = array();
            if ($demo_error) {
                // echo "<pre>", print_r($demo_error), "</pre>";
                foreach ($demo_error as $key_r =>$error) {
                    $sheet      = $error["sheet"];
                    $column     = $error["col"];
                    $row        = $error["row"];
                    $message    = $error["msg"];
                    $object->setActiveSheetIndex($sheet);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $object->getActiveSheet()->getStyle("$column$row")->getFill()->getStartColor()->setARGB("ffffcece");
                    $object->getActiveSheet()->getTabColor()->setARGB('FFFF0000');
                    $object->getActiveSheet()->getComment("$column$row")->setAuthor('James Tri');
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun($message);
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                    $object->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                }

                $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
                $namafile = "Error Loader Template ".$lokasi['nama_terminal'] ." - ". date("Y-m-d H.i.s") . ".xlsx";
                $path = "./temp/$namafile";
                 $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                );
                $objWriter->save($path);
                echo json_encode($respon_data);
            }else{
                foreach ($data as $key => $value) {
                
                    
                    if (!empty($value['bulan'])) {
                        
                        foreach ($value['bulan'] as $val2) {
                        
                            $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $terminal,
                                'id_catagory'       => $value['id_catagory'],
                                'id_jenisperangkat' => $value['id_jenisperangkat'],
                                'id_area'           => $value['id_area'],
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'bulan'             => bln_con($val2),
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                            //echo "<pre>", print_r($insert), "</pre>";
                            $this->m_data->insertData('jadwal_pm_area',$insert);
                    
                        }
                    }else{
                        $insert=[
                                'id_unit'           => $value['id_unit'],
                                'id_lokasi'         => $terminal,
                                'id_catagory'       => $value['id_catagory'],
                                'id_jenisperangkat' => $value['id_jenisperangkat'],
                                'id_area'           => $value['id_area'],
                                'bulan'             => '',
                                'idpm_type'         => $value['idpm_type'],
                                'tgl'               => $value['tgl'], 
                                'shift'             => $value['shift'],
                                'status'            => $value['status'],
                            ];
                        $this->m_data->insertData('jadwal_pm_area',$insert);
                    
                    }
                    
                }
                 $respon_data = array(
                    "STATUS"        => 200,
                    "PATH"          => '',
                    "FILENAME"      => '',
                );
                 echo json_encode($respon_data);
            }
           
           
            // $this->db->insert_batch('jadwal_pm_area', $insert);
           
           
       
    }

   
}