<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    date_default_timezone_set('Asia/Kolkata');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;

class Jadwal_kerja extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->model("m_data");
    }

    // private function position() {
    //     $data["position"] = "perangkat";
    //     return $data;
    // }

    private function role() {
        $url = urlencode(current_url());
        if (session("username") == "") {
            redirect(base_url('login/auth'));
        }
    }
    public function index()
    {
      
        //$data = $this->position();
        // $data = access($data,"VIEW");
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List Jadwal Kerja ";
        $data["title_des"] = " List Data Jadwal Kerja ";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }

    
    function LoadData(){
        $a_date = date('Y-M')."-"."-27";
        $tahun  =     date('Y');
         
        $data['max_date']= date("t", strtotime($a_date));
        $data['my']=date('m/Y');
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
       if(isset($_POST['bulan'])&& !empty($_POST['bulan'])){
           $bulan= " AND MONTH(a.tanggal) ='".$_POST['bulan']."'";
       }else{
           $bulan= " AND MONTH(a.tanggal) ='".date('m')."'";
       }
       
       if(isset($_POST['tahun'])){
           $tahun= " AND YEAR(a.tanggal) ='".$_POST['tahun']."'";
       }else{
           $tahun='';
       }
     

        $om= $this->Mod->GetCustome("SELECT a.*,DAY(a.tanggal) as hari ,b.nik,b.nama FROM jadwal_kerja a left join user b on b.id = a.id_user  
        where a.id_unit ='".sess()['unit']."' $bulan $tahun order by a.tanggal ASC" )->result_array(); 
        $dataom=array();
        foreach ($om as $key => $value) {
            $dataom[$value['nama']]['nama']=$value['nama'];
             $dataom[$value['nama']]['nik']=$value['nik'];
            $personil =[
                    
                    'tgl'           => $value['tanggal'],
                    'tgl_a'           => $value['hari'],
                    'id_jadwal'     =>  $value['id_jadwal_kerja'],
                    'shift'         => $value['shift']
                ];
                 $dataom[$value['nama']]['absen'][]=$personil;
        }
        $dataom=array_values($dataom);
        $data['om']=$dataom;
       
        // foreach ($data_res['petugas'] as $key => $value) {
        //     $user = $this->Mod->getWhere('user',array('id' => $value['id_user']))->row_array();
        //     $data_res['petugas'][$key ]['nama_user']=  $user['nama'];
        // }
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
        if(isset($_FILES["filelampiran"]["name"])){
			$path = $_FILES["filelampiran"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
       
			
            $data           = array();
            $data_triwulan  = array();
            $data_sms       = array();
            $data_thn       = array();
            $datacctv_bulanan = array();
			foreach($object->getWorksheetIterator(1) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
         
                   if ($worksheet == 0) {
                        for($col=2 ; $col<=$highestColumnIndex; $col++){
                        
                          for ($row=7; $row <=$highestRow ; $row++) { 
                                $shift      = $value->getCellByColumnAndRow($col, $row)->getValue();

                                if (!empty($value->getCellByColumnAndRow($col, 5)->getValue())) {
                                    $tgl        = $value->getCellByColumnAndRow($col, 5)->getValue();
                                
                                    if ( $tgl<10) {
                                        $tgl = "0".$tgl;
                                    }
                                }else{
                                    $tgl='';
                                }
                             
                               if (!empty($shift) ) {
                                $nik        = $value->getCellByColumnAndRow(0, $row)->getValue();
                                $nama       = $value->getCellByColumnAndRow(1, $row)->getValue();
                              
                                    $master     =  $this->Mod->getWhere('user',array('nik' =>$nik))->row_array();
                               
                            
                                if (!empty($master)) {
                                    $id_user = $master['id'];
                                 }else{
                                    $id_user = '';
                                
                                 }
                                $tgl_dinas = date("Y-").$_POST['bulan'].'-'.$tgl;
                                $insert=[
                                    'tanggal'       => $tgl_dinas,
                                    'id_user'       => $id_user,
                                    'shift'         => $shift,
                                    // 'nama'          => $nama,
                                    'id_unit'       => $_POST['id_unit'],
                                    // 'nik'           => $nik ,
                                   
                                   
                                ];
                                
                                $cek =  $this->Mod->getWhere('jadwal_kerja',array('id_user' =>$id_user,'tanggal' =>$tgl_dinas,'shift'=> $shift ))->row_array();
                                if (empty($cek)) {
                                    $this->m_data->insertData('jadwal_kerja',$insert);
                                }else{
                                    $this->m_data->updateData('jadwal_kerja',array('id_jadwal_kerja' =>$cek['id_jadwal_kerja']), $insert);
                                }
                               
                               //echo "<pre>", print_r( $insert), "</pre>";
                                
                                
                               }
                          }
                        }
                   }
             
           
            }
        }

    
 
    }

    function DownloadFormat($bulan=null){
        if (!empty(sess()['id_lokasi'])) {
            $param =" AND id_lokasi ='".sess()['id_lokasi']."'";

            $teminal = $this->Mod->GetCustome("SELECT * FROM terminal where id= ".sess()['id_lokasi']." " )->row_array();
         $data['lokasi']= $teminal ['nama_terminal'];
        }else{
            $param ='';
             $data['lokasi']='';
        }
        $personil = $this->Mod->GetCustome("SELECT 
                                               *
                                            FROM 
                                                user 
                                            
                                            WHERE
                                               unit_kerja ='".sess()['unit'] ."'  $param  " )->result_array(); 
                                               
                                               
        
        
        $a_date = date('Y')."-".$bulan."-27";
        $tahun  =     date('Y');
         
        $max_date= date("t", strtotime($a_date));
      
        $data['personil']    = $personil;
        $data['date']        = $max_date;
        $data['bulan']       = $bulan;
        $data['bulan_l']     = Fmonth($bulan);
        $data['tahun']       = $tahun;
        $data['unit']        = sess()['unit_kode'];
        $year                =     date('y');
            
        //  $this->load->view('jadwal_dinas', $data);
        //  echo "<pre>", print_r(count($data['personil'])), "</pre>";
        // echo "<pre>", print_r($data), "</pre>";
       
          $tableHead = [
            'font'=>[
                'color'=>[
                    'rgb'=>'FFFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];


        $evenRow = [
           
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000 '],
                    ],
                ],
        ];
        //odd row
        $oddRow = [
           'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];
        
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("24");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("50");
       

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Jadwal Dinas Unit'.sess()['unit_kode']);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:'.coord_x($max_date+1).'1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.coord_x($max_date+1).'1')->getFont()->setSize(16); 
       
        $objPHPExcel->getActiveSheet()->setCellValue('A2', Fmonth($bulan).' '.$tahun);
        $objPHPExcel->getActiveSheet()->mergeCells('A2:'.coord_x($max_date+1).'2'); 
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.coord_x($max_date+1).'2')->getFont()->setSize(16); 
       
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'BANDARA SOEKARNO-HATTA');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:'.coord_x($max_date+1).'3'); 
        $objPHPExcel->getActiveSheet()->getStyle('A3:'.coord_x($max_date+1).'3')->getFont()->setSize(16); 
        
        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'NIK');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:A6'); 
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'Nama');
        $objPHPExcel->getActiveSheet()->mergeCells('B4:B6'); 
        $objPHPExcel->getActiveSheet()->setCellValue('C4', 'Tanggal');
       

        $objPHPExcel->getActiveSheet()->mergeCells('C4:'.coord_x($max_date+1).'4'); 
        // $objPHPExcel->getActiveSheet()->getStyle('A4')->getFill()->getStartColor()->setRGB('00BDFF');
       $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
        for($x=1;$x<=$max_date;$x++){
        //    echo coord_x($x+1)."|";
        //    echo hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x)))."<br>";
            if (hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) == "Ming" || hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) == "Sab") {
                $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'6')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'e90b0b')
                        )
                    )
                );
         
            }
            $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'5',$x );
            $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'6',hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) );
            $objPHPExcel->getActiveSheet()->getColumnDimension(coord_x($x+1))->setWidth(4);
        }
        $no=7;
        foreach ($data['personil'] as $key => $value) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $value['nik']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $value['nama']);
               
                $no++;
        }
        $maxRow= count($personil)+6;
        $objPHPExcel->getActiveSheet()->getStyle('A4:'.coord_x($max_date+1).$maxRow)->getBorders()
                ->getAllBorders()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)
                ->getColor()
                ->setRGB('000000');
        
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '00BDFF')
                )
            )
        );

        // echo "<pre>", print_r($data), "</pre>";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $namafile = 'Jadwal Dinas '. Fmonth($bulan).$year.'.xlsx';
                $path = "./temp/$namafile";
               
                  $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                );
                $objWriter->save($path);
                echo json_encode($respon_data);


    }

    function FormatPMAN(){
        
         if(isset($_POST['bulan'])&& !empty($_POST['bulan'])){
           $bulan_n= " AND MONTH(a.tanggal) ='".$_POST['bulan']."'";
           $bulan= $_POST['bulan'];
       }else{
           $bulan_n= " AND MONTH(a.tanggal) ='".date('m')."'";
           $bulan= date('m');
       }
       
       if(isset($_POST['tahun'])){
           $tahun_n= " AND YEAR(a.tanggal) ='".$_POST['tahun']."'";
           $tahun= $_POST['tahun'];
       }else{
           $tahun_n='';
           $tahun=date('Y');
       }
        if (!empty(sess()['id_lokasi'])) {
            $param =" AND id_lokasi ='".sess()['id_lokasi']."'";

            $teminal = $this->Mod->GetCustome("SELECT * FROM terminal where id= ".sess()['id_lokasi']." " )->row_array();
         $data['lokasi']= $teminal ['nama_terminal'];
        }else{
            $param ='';
             $data['lokasi']='';
        }
        $personil = $this->Mod->GetCustome("SELECT 
                                               *
                                            FROM 
                                                user 
                                            
                                            WHERE
                                               unit_kerja ='".sess()['unit'] ."'  $param  " )->result_array(); 
        $om= $this->Mod->GetCustome("SELECT a.*,DAY(a.tanggal) as hari ,b.nik,b.nama FROM jadwal_kerja a left join user b on b.id = a.id_user  
        where a.id_unit ='".sess()['unit']."' $bulan_n $tahun_n order by a.tanggal ASC" )->result_array(); 
        $dataom=array();
        foreach ($om as $key => $value) {
            $dataom[$value['nama']]['nama']=$value['nama'];
             $dataom[$value['nama']]['nik']=$value['nik'];
            $personil =[
                    
                    'tgl'           => $value['tanggal'],
                    'tgl_a'           => $value['hari'],
                    'id_jadwal'     =>  $value['id_jadwal_kerja'],
                    'shift'         => $value['shift']
                ];
                 $dataom[$value['nama']]['absen'][]=$personil;
        }
        $dataom=array_values($dataom);
        $data['om']=$dataom;
        $a_date = date('Y')."-".$bulan."-27";
        $tahun  =     date('Y');
         
        $max_date= date("t", strtotime($a_date));
      
        $data['personil']    = $personil;
        $data['date']        = $max_date;
        $data['bulan']       = $bulan;
        $data['bulan_l']     = Fmonth($bulan);
        $data['tahun']       = $tahun;
        $data['unit']        = sess()['unit_kode'];
        $year                = date('y');
            
        //  $this->load->view('jadwal_dinas', $data);
        //  echo "<pre>", print_r(count($data['personil'])), "</pre>";
       // echo "<pre>", print_r($data), "</pre>";
       
        $tableHead = [
            'font'=>[
                'color'=>[
                    'rgb'=>'FFFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];


        $evenRow = [
           
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000 '],
                    ],
                ],
        ];
        //odd row
        $oddRow = [
           'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];
        
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("24");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("50");
       

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'JADWAL OM '.sess()['unit_kode']." ". Fmonth($bulan)." ".$tahun);
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.coord_x($max_date+1).'3')->getFont()->setSize(40); 
        
        $objPHPExcel->getActiveSheet()->mergeCells('A1:'.coord_x($max_date+1).'3'); 
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.coord_x($max_date+1).'3')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.coord_x($max_date+1).'3')->getAlignment()->setVertical('center');
        
        
        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'NIK');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'Nama');
        

        // $objPHPExcel->getActiveSheet()->mergeCells('C4:'.coord_x($max_date+1).'4'); 
        // $objPHPExcel->getActiveSheet()->getStyle('A4')->getFill()->getStartColor()->setRGB('00BDFF');
       $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
        for($x=1;$x<=$max_date;$x++){
        //    echo coord_x($x+1)."|";
        //    echo hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x)))."<br>";
            if (hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) == "Ming" || hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) == "Sab") {
                $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'4')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'e90b0b')
                        )
                    )
                );
         
            }
            $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'4',$x );
          //  $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'6',hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) );
            $objPHPExcel->getActiveSheet()->getColumnDimension(coord_x($x+1))->setWidth(4);
            
            $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'4')->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'4')->getAlignment()->setVertical('center');
        
        
        }
        $no=5;
        foreach ($data['om'] as $key => $value) {

            // Kolom A = NIK
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $value['nik']);
        
            // Kolom B = Nama
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $value['nama']);
        
            // Buat map shift berdasarkan tanggal
            $mapShift = [];
            foreach ($value['absen'] as $vall) {
                $mapShift[$vall['tgl_a']] = $vall['shift'];
            }
        
            // Isi tanggal dimulai dari kolom C
            $colIndex = 3; // C = kolom ke-3
        
            for($tgl = 1; $tgl <= $max_date; $tgl++){
        
                $isi = isset($mapShift[$tgl]) ? $mapShift[$tgl] : "-";
        
                // Convert angka kolom → huruf (C, D, E, ...)
                $columnLetter = PHPExcel_Cell::stringFromColumnIndex($colIndex - 1);
        
                $objPHPExcel->getActiveSheet()->setCellValue($columnLetter.$no, $isi);
        
                $colIndex++;
            }
        
            $no++;
        }

        $maxRow= count($dataom)+4;
        $range = 'A4:' . coord_x($max_date + 1) . $maxRow;

        $objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
      
        // echo "<pre>", print_r($data), "</pre>";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $namafile = 'Jadwal Dinas Esikap '.sess()['unit_kode']." ". Fmonth($bulan)." ".$tahun.'.xlsx';
                $path = "./temp/$namafile";
               
                  $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                    "lomit"         => coord_x($max_date+1).'3'
                );
                $objWriter->save($path);
                echo json_encode($respon_data);


    }

     function FormatEsikap(){
        
         if(isset($_POST['bulan'])&& !empty($_POST['bulan'])){
           $bulan_n= " AND MONTH(a.tanggal) ='".$_POST['bulan']."'";
           $bulan= $_POST['bulan'];
       }else{
           $bulan_n= " AND MONTH(a.tanggal) ='".date('m')."'";
           $bulan= date('m');
       }
       
       if(isset($_POST['tahun'])){
           $tahun_n= " AND YEAR(a.tanggal) ='".$_POST['tahun']."'";
           $tahun= $_POST['tahun'];
       }else{
           $tahun_n='';
           $tahun=date('Y');
       }
        if (!empty(sess()['id_lokasi'])) {
            $param =" AND id_lokasi ='".sess()['id_lokasi']."'";

            $teminal = $this->Mod->GetCustome("SELECT * FROM terminal where id= ".sess()['id_lokasi']." " )->row_array();
         $data['lokasi']= $teminal ['nama_terminal'];
        }else{
            $param ='';
             $data['lokasi']='';
        }
        $personil = $this->Mod->GetCustome("SELECT 
                                               *
                                            FROM 
                                                user 
                                            
                                            WHERE
                                               unit_kerja ='".sess()['unit'] ."'  $param  " )->result_array(); 
        $om= $this->Mod->GetCustome("SELECT a.*,DAY(a.tanggal) as hari ,b.nik,b.nama FROM jadwal_kerja a left join user b on b.id = a.id_user  
        where a.id_unit ='".sess()['unit']."' $bulan_n $tahun_n order by a.tanggal ASC" )->result_array(); 
        $dataom=array();
        foreach ($om as $key => $value) {
            $dataom[$value['nama']]['nama']=$value['nama'];
             $dataom[$value['nama']]['nik']=$value['nik'];
            $personil =[
                    
                    'tgl'           => $value['tanggal'],
                    'tgl_a'         => $value['hari'],
                    'id_jadwal'     =>  $value['id_jadwal_kerja'],
                    'shift'         => con_esikap($value['shift'])
                ];
                 $dataom[$value['nama']]['absen'][]=$personil;
        }
        $dataom=array_values($dataom);
        $data['om']=$dataom;
        $a_date = date('Y')."-".$bulan."-27";
        $tahun  =     date('Y');
         
        $max_date= date("t", strtotime($a_date));
      
        $data['personil']    = $personil;
        $data['date']        = $max_date;
        $data['bulan']       = $bulan;
        $data['bulan_l']     = Fmonth($bulan);
        $data['tahun']       = $tahun;
        $data['unit']        = sess()['unit_kode'];
        $year                = date('y');
            
        //  $this->load->view('jadwal_dinas', $data);
        //  echo "<pre>", print_r(count($data['personil'])), "</pre>";
        //echo "<pre>", print_r($data), "</pre>";
       
        $tableHead = [
            'font'=>[
                'color'=>[
                    'rgb'=>'FFFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];


        $evenRow = [
           
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000 '],
                    ],
                ],
        ];
        //odd row
        $oddRow = [
           'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];
        
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("5");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("30");
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("31");
       
       
       
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'no');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'employee_number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'employee_name');
        for ($x = 1; $x <= $max_date; $x++) {

            // Tentukan koordinat kolom (B, C, D, ...)
            $col = coord_x($x + 2);
            $cell = $col . '1';
        
            // Tentukan hari
            $hari = hariIndo(date('D', strtotime(date('Y') . "-" . $bulan . "-" . $x)));
        
            // Jika Sabtu / Minggu → background merah
            if ($hari == "Ming" || $hari == "Sab") {
                $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray([
                    'fill' => [
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => ['rgb' => 'E90B0B']
                    ]
                ]);
            }
             
            // Isi nomor tanggal
            $objPHPExcel->getActiveSheet()->setCellValue($cell, date('Y-m-').($x < 10 ? "0".$x:$x));
        
            // Lebar kolom
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setWidth(14);
        
            // Align center
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

        $no=2;
        foreach ($data['om'] as $key => $value) {

            // Kolom B = NIK
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $value['nik']);
        
            // Kolom C = Nama
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $value['nama']);
        
            // Buat map shift berdasarkan tanggal
            $mapShift = [];
            foreach ($value['absen'] as $vall) {
                $mapShift[$vall['tgl_a']] = $vall['shift'];
            }
        
            // Isi tanggal dimulai dari kolom C
            $colIndex = 4; // D = kolom ke-4
        
            for($tgl = 1; $tgl <= $max_date; $tgl++){
        
                $isi = isset($mapShift[$tgl]) ? $mapShift[$tgl] : "OFF";
        
                // Convert angka kolom → huruf (D, E, F ...)
                $columnLetter = PHPExcel_Cell::stringFromColumnIndex($colIndex - 1);
        
                $objPHPExcel->getActiveSheet()->setCellValue($columnLetter.$no, $isi);
        
                $colIndex++;
            }
        
            $no++;
        }

        $maxRow= count($dataom)+1;
        $range = 'A1:' . coord_x($max_date + 2) . $maxRow;

        $objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
      
        // echo "<pre>", print_r($data), "</pre>";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $namafile = 'Jadwal Dinas Esikap '.sess()['unit_kode']." ". Fmonth($bulan)." ".$tahun.'.xlsx';
                $path = "./temp/$namafile";
               
                  $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                    "lomit"         => coord_x($max_date+1).'3'
                );
                $objWriter->save($path);
                echo json_encode($respon_data);


    }


    function FormatTalend(){
        if(isset($_POST['bulan'])&& !empty($_POST['bulan'])){
           $bulan_n= " AND MONTH(a.tanggal) ='".$_POST['bulan']."'";
           $bulan= $_POST['bulan'];
       }else{
           $bulan_n= " AND MONTH(a.tanggal) ='".date('m')."'";
           $bulan= date('m');
       }
       
       if(isset($_POST['tahun'])){
           $tahun_n= " AND YEAR(a.tanggal) ='".$_POST['tahun']."'";
           $tahun= $_POST['tahun'];
       }else{
           $tahun_n='';
           $tahun=date('Y');
       }
        if (!empty(sess()['id_lokasi'])) {
            $param =" AND id_lokasi ='".sess()['id_lokasi']."'";

            $teminal = $this->Mod->GetCustome("SELECT * FROM terminal where id= ".sess()['id_lokasi']." " )->row_array();
         $data['lokasi']= $teminal ['nama_terminal'];
        }else{
            $param ='';
             $data['lokasi']='';
        }
        $personil = $this->Mod->GetCustome("SELECT 
                                               *
                                            FROM 
                                                user 
                                            
                                            WHERE
                                               unit_kerja ='".sess()['unit'] ."'  $param  " )->result_array(); 
        $om= $this->Mod->GetCustome("SELECT a.*,DAY(a.tanggal) as hari ,b.nik,b.nama FROM jadwal_kerja a left join user b on b.id = a.id_user  
        where a.id_unit ='".sess()['unit']."' $bulan_n $tahun_n order by a.tanggal ASC" )->result_array(); 
        $dataom=array();
        foreach ($om as $key => $value) {
            $dataom[$value['nama']]['nama']=$value['nama'];
             $dataom[$value['nama']]['nik']=$value['nik'];
            $personil =[
                    
                    'tgl'           => $value['tanggal'],
                    'tgl_a'           => $value['hari'],
                    'id_jadwal'     =>  $value['id_jadwal_kerja'],
                    'shift'         => con_talend($value['shift'])
                ];
                 $dataom[$value['nama']]['absen'][]=$personil;
        }
        $dataom=array_values($dataom);
        $data['om']=$dataom;
        $a_date = date('Y')."-".$bulan."-27";
        $tahun  =     date('Y');
         
        $max_date= date("t", strtotime($a_date));
      
        $data['personil']    = $personil;
        $data['date']        = $max_date;
        $data['bulan']       = $bulan;
        $data['bulan_l']     = Fmonth($bulan);
        $data['tahun']       = $tahun;
        $data['unit']        = sess()['unit_kode'];
        $year                = date('y');
            
        //  $this->load->view('jadwal_dinas', $data);
        //  echo "<pre>", print_r(count($data['personil'])), "</pre>";
       // echo "<pre>", print_r($data), "</pre>";
       
        $tableHead = [
            'font'=>[
                'color'=>[
                    'rgb'=>'FFFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];


        $evenRow = [
           
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000 '],
                    ],
                ],
        ];
        //odd row
        $oddRow = [
           'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000 '],
                ],
            ],
        ];
        
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("24");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("50");
       

        
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIK');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        for($x=1;$x<=$max_date;$x++){
       
            $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'1',date('m')."/".$x."/".date('Y') );
          //  $objPHPExcel->getActiveSheet()->setCellValue(coord_x($x+1).'6',hariIndo(date('D', strtotime(date('Y')."-".$bulan."-".$x))) );
            $objPHPExcel->getActiveSheet()->getColumnDimension(coord_x($x+1))->setWidth(20);
            
            $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'1')->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle(coord_x($x+1).'1')->getAlignment()->setVertical('center');
        
        
        }
        $no=2;
        foreach ($data['om'] as $key => $value) {

            // Kolom A = NIK
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $value['nik']);
        
            // Kolom B = Nama
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $value['nama']);
        
            // Buat map shift berdasarkan tanggal
            $mapShift = [];
            foreach ($value['absen'] as $vall) {
                $mapShift[$vall['tgl_a']] = $vall['shift'];
            }
        
            // Isi tanggal dimulai dari kolom C
            $colIndex = 3; // C = kolom ke-3
        
            for($tgl = 1; $tgl <= $max_date; $tgl++){
        
                $isi = isset($mapShift[$tgl]) ? $mapShift[$tgl] : "dayoff";
        
                // Convert angka kolom → huruf (C, D, E, ...)
                $columnLetter = PHPExcel_Cell::stringFromColumnIndex($colIndex - 1);
        
                $objPHPExcel->getActiveSheet()->setCellValue($columnLetter.$no, $isi);
        
                $colIndex++;
            }
        
            $no++;
        }

        $maxRow= count($dataom)+1;
        $range = 'A1:' . coord_x($max_date + 1) . $maxRow;

        $objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
      
        // echo "<pre>", print_r($data), "</pre>";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $namafile = 'Jadwal Dinas Talend '.sess()['unit_kode']." ". Fmonth($bulan)." ".$tahun.'.xlsx';
                $path = "./temp/$namafile";
               
                  $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                    "lomit"         => coord_x($max_date+1).'3'
                );
                $objWriter->save($path);
                echo json_encode($respon_data);


    }

    function clearData(){
         if (!empty(sess()['id_lokasi'])) {
            $param =" AND id_lokasi ='3'";

          
        }else{
            $param ='';
             $data['lokasi']='';
        }
        $personil = $this->Mod->GetCustome("SELECT b.nama,b.jabatan,b.nik,b.no_hp,a.* FROM jadwal_kerja a left join user b on b.id = a.id_user where b.unit_kerja ='".sess()['unit']."' $param" )->result_array(); 
        foreach ($personil as $key => $value) {
            $this->Mod->delete('jadwal_kerja',array('id_jadwal_kerja'=>$value['id_jadwal_kerja']));
        }
        echo "<pre>", print_r($personil), "</pre>";
    }




}
