<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    date_default_timezone_set('Asia/Kolkata');
   
class Fasilitas extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
        $this->load->library('Excel');
        $this->load->model("m_data");
       
        $this->load->library('Ciqrcode');
        $this->role();
        
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
        $data["title"] = "Fasilitas";
        $data["title_des"] = " List Data Fasilitas";
        $data["content"] = "v_index";

        $data["data"] = $data;
       
        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( sess()),"</pre>";
    }

    function LoadFasilitas(){
       $data    =  $this->Mod->GetCustome("SELECT * FROM fasilitas WHERE  id_unit='".sess()['unit']."' AND STATUS !='8' ")->result_array();
       echo json_encode($data);
    }

    function LoadFasilitasCatagotry(){
        $data    =  $this->Mod->GetCustome("SELECT * FROM fasilitas_catagory WHERE  id_unit='".sess()['unit']."' AND STATUS ='1' ")->result_array();
        echo json_encode($data);
     }
    
    function LoadData(){
        $filterdata=array();
        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
           
            $limit = 3000; 
        }
        if(isset($_POST['src'])) {
            $src = $_POST['src'];
        } else {
   
            $src = ''; 
        }  
        
        if(!empty($_POST['jenis_perangkat'])) {
            $jenis = $_POST['jenis_perangkat'];
            $filterdata +=array('id_catagory'=> $jenis);
           
        } else {
            $jenis = ''; 
       
        }

        if(!empty($_POST['area'])) {
            $area = $_POST['area'];
            $filterdata+=array('id_area'=> $area);
        } else {
            $area = ''; 
        }
        $from               = $this->uri->segment(3);
        
       
        
        $param=[
            'table'         => 'fasilitas' ,
            'pk'            => 'id_fasilitas' ,
            'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'src'           => $src,
            'filter'        => $filterdata ,
            'param_src'     => [
                                'like' => 'nama_fasilitas',
                                'or_like'=> 'ip_address']
        ];
        if (!empty(sess()['id_lokasi'])) {
          
            $param['parameter']+=array('id_lokasi'=> sess()['id_lokasi']);
            //array_push( ,);
          }
        //    echo "<pre>",print_r ( $filterdata),"</pre>";
        $totalData          = CountDataPag($param);
        $param['total_data'] = $totalData;
        $param['total_page'] = ceil($totalData/$limit);
        $res                = pagin($param);
        foreach ($res['data'] as $key => $value) {
           $area      = $this->m_data->getWhere('area',array('id_area' => $value['id_area']))->row_array();
           $lokasi      = $this->m_data->getWhere('terminal ',array('id' => $value['id_lokasi']))->row_array();
           $sublokasi   = $this->m_data->getWhere('terminal ',array('id' => $value['id_sublokasi']))->row_array();
           $catagory    = $this->m_data->getWhere('fasilitas_catagory ',array('id_catagory' => $value['id_catagory']))->row_array();
            $res['data'][$key]['lokasi']     = (!empty($lokasi['nama_terminal']) ? $lokasi['nama_terminal']: '');
            $res['data'][$key]['sublokasi']  = (!empty($sublokasi['nama_terminal']) ? $sublokasi['nama_terminal']: '');
            $res['data'][$key]['catagory']   = (!empty( $catagory['nama']) ?  $catagory['nama']: '');
            $res['data'][$key]['area']      = (!empty( $area['nama_area']) ?  $area['nama_area']: '');
            $res['data'][$key]['status_label'] =sts('1',$value['status']);
        }
       
        $data['fasilitas']  = $res['data'];
        $data['pag']        = $res['pag'];
        echo json_encode($data);
    }
    
    function summary(){
        if (sess()['unit'] == '4') {
            $data['sum']    = $this->Mod->GetCustome("SELECT a.id_catagory,b.nama as nama,COUNT(a.id_catagory) as total FROM fasilitas a left join fasilitas_catagory b on b.id_catagory = a.id_catagory where a.id_unit = '".sess()['unit']."' AND a.id_lokasi = '".sess()['id_lokasi']."' group by a.id_catagory")->result_array();
       
        }else{
            $data['sum']    = $this->Mod->GetCustome("SELECT a.id,a.nama_terminal as nama, COUNT(b.id_lokasi) as total FROM terminal a left join fasilitas b on b.id_lokasi = a.id where a.parent_id = '-1' and b.id_unit='".sess()['unit']."' group by a.id,a.nama_terminal")->result_array();
        
        }
        $data['all']    = $this->Mod->GetCustome("SELECT COUNT(*) as total FROM  fasilitas where id_unit='".sess()['unit']."' ")->row_array(); 
        echo json_encode($data);
    }
    
    function performa($id=null){
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Fasilitas";
        $data["title_des"]  = " Performa Fasilitas";
        $data["content"]    = "v_performa";
        $data['id']         = $id;
       
        $data["data"] = $data;
       
        $this->load->view('template_v2', $data);
    }


    function LoadDataAnl($id=null){
        $perangkat                              = $this->Mod->getWhere('perangkat',array('id_perangkat' => $id))->row_array();
        if (!empty($perangkat['nama_perangkat'])) {
            $lokasi                             =  $this->Mod->getWhere('terminal',array('id' => $perangkat['id_perangkat']))->row_array();
            $perangkat['nama_perangkat']        =  (!empty($perangkat['nama_perangkat']) ? $perangkat['nama_perangkat']: '');
        }else{
            $perangkat['nama_perangkat']        =  (!empty($lokasi['nama_perangkat']) ? $lokasi['nama_perangkat']: '');
        }
        // $result['data']=  $data;
        $todayDate = date('Y-m-d');

        $logHistory = $this->Mod->GetCustome(" SELECT * FROM logbook WHERE id_fasilitas = '".$id."'
                                        ")->result_array();
 
        foreach ($logHistory as $key => $value) {
            $jp = $this->Mod->getWhere('jenis_perangkat',array('id_jenisperangkat' =>$value['id_jenisperangkat']))->row_array();
            $jm = $this->Mod->getWhere('jenis_masalah',array('id' =>$value['id_jenismasalah']))->row_array();
                                    
            $logHistory[$key]['nama_JP']=  (!empty($jp ? $jp['nama'] : ''));
            $logHistory[$key]['nama_masalah']=  (!empty($jm)? $jm['nama_masalah']: '');
        }
        $result['LogHistory'] = $logHistory;
        // Mengemas semua data ke dalam satu array
    
        // $result['data'] = $data;

        $downtime   = $this->Mod->GetCustome("SELECT SUM(TIMESTAMPDIFF(MINUTE, date_start, update_date)) AS total_downTime FROM tinjut WHERE update_date >= NOW() - INTERVAL 1 MONTH AND date_start >= NOW() - INTERVAL 1 MONTH")->row_array();
        $uptime     = $this->Mod->GetCustome("SELECT (TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH)) * (SELECT COUNT(*) FROM fasilitas)) AS uptime")->row_array();
         
        $totaldowntime = $downtime['total_downTime'];
        $totaluptime = $uptime['uptime'];
        $performa = ($totaluptime - $totaldowntime) / $totaluptime * 100;

         $performa_formatted = number_format(round($performa)); // Format nilai bulat ke 2 angka desimal dan tambahkan '%' di akhir
         $result['perfomChart'] = array('Performa' => round($performa)); // Bulatkan ke 2 angka desimal
         $result['perfomChart'] = array('Performa' => $performa_formatted); // Simpan nilai yang sudah diformat
         
        
        $data['url']            = $this->uri->segment(2);
        $totalData              = $this->Mod->CountData('perangkat','id_perangkat',array('status !=' => 8))->num_rows();
         

        $tabel                  = $this->Mod->GetCustome("
        SELECT 
            p.id_perangkat,
            p.nama_perangkat, 
            p.status as status_perangkat,
            u.kode_unit,
            f.ip_address,
            p.serial_number,
            f.status,
            l.create_date,
            fd.id_jenisperangkat,
            m.nama AS merk_nama,
            jp.nama AS nama_jp
        FROM 
            perangkat p
        LEFT JOIN
            fasilitas_detail fd ON fd.id_perangkat = p.id_perangkat
        LEFT JOIN 
            unit u ON p.id_unit = u.id_unit
        LEFT JOIN
            fasilitas f ON fd.id_fasilitas = f.id_fasilitas
        LEFT JOIN
            (
                SELECT id_perangkat, MAX(create_date) AS max_create_date
                FROM logbook
                GROUP BY id_perangkat
            ) l_max ON l_max.id_perangkat = p.id_perangkat
        LEFT JOIN
            logbook l ON l.id_perangkat = p.id_perangkat AND l.create_date = l_max.max_create_date
        LEFT JOIN
            merk m ON m.id = p.merk_id
        LEFT JOIN
            jenis_perangkat jp ON jp.id_jenisperangkat = p.id_jenisperangkat
        WHERE
            fd.id_fasilitas = $id
        GROUP BY
            fd.id_perangkat
        ORDER BY
            l.create_date DESC
     ")->result_array();

        // Mengemas data ke dalam array result
       

        // $total_log = $this->Mod->GetCustome(" SELECT a.id_jenisperangkat,a.nama,COUNT(b.id_fasilitas) as total FROM jenis_perangkat a left join logbook b on b.id_jenisperangkat = a.id_jenisperangkat  where b.id_fasilitas = ".$id." GROUP by a.id_jenisperangkat,a.nama,b.id_fasilitas")->result_array();
        $total_log =$this->Mod->GetCustome("SELECT b.* FROM fasilitas_detail a left join jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat where a.id_fasilitas ='".$id."'")->result_array();
        $totaldata_log=0;
        foreach ($total_log as $key => $value) {
           
            $perangkat = $this->Mod->getWhere('logbook',array('id_fasilitas'=> $id,'id_jenisperangkat' => $value['id_jenisperangkat']))->num_rows();
            $total_log[$key]['total'] = $perangkat;
            $totaldata_log = $totaldata_log+ $perangkat;
           
        }

        
        // Mengemas semua data ke dalam satu array
        foreach ($total_log as $key => $value) {
            $persen = ($totaldata_log != 0 ? round(($value['total'] / $totaldata_log) * 100) : 0);
            $result['ProgressData'][] =[
                'name'          => $value['nama'],
                'value'         => $persen ,
                'class'         => log_status($persen),
                'totaldata'     => $totaldata_log,
                'totaljenis'    => $value['total'] 
             ];
        }
        $fasilitas              = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$id ))->row_array();
        $fasilitas['status']    = (lb_st($fasilitas['status']));       
        $result['fasilitas']    =  $fasilitas;
        $bulan                  = 5;
        $tahun                  = date('Y');
        $count_cm               =  $this->Mod->GetCustome("SELECT id_fasilitas,id_jenisperangkat,sum(TIMESTAMPDIFF(MINUTE, create_date, end_time))  AS downtime FROM logbook where id_fasilitas= '".$id."' and YEAR(create_date)= '".$tahun."' and MONTH(create_date) = '".$bulan."' GROUP by id_fasilitas,id_jenisperangkat")->result_array();
        $total_perfom = 0;
        foreach ($tabel as $key => $value) {
            $tabel[$key]['perfome'] =100;
            foreach ($count_cm as $key2 => $value2) {
                    if ($value2['id_jenisperangkat'] == $value['id_jenisperangkat']) {
                        // 1440 = 24 jam * 60 menit
                        $menit                  = 1440*30;
                        $dt                     =  $menit - $value2['downtime'];
                        $pf                     = ($dt /$menit) * 100;
                        $tabel[$key]['perfome'] = $pf ;
                        $total_perfom           = $total_perfom + $pf;
                    }else{
                        $total_perfom           = $total_perfom + 100;
                    }
            }
        }

        $result['tabel-data']   = $tabel;
        
        //  ORDER BY `tinjut`.`id_fasilitas` ASC

        $perfom_new         = [];
        $result['P_new']    =  $count_cm;
        $result['bulan']    =  $bulan;
        $result['tahun']    =  $tahun;

        $result['total-data']       = count($tabel);
        $result['total-perfome']    = round($total_perfom/count($tabel),2);
       
         
        echo json_encode($result);
    }

    
    function Loadmasterdetail($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
      
        $data = $this->m_data->getWhere('master_perangkat_detail',array('id_jenisperangkat' =>$id,'status !=' => 8 ))->result_array();
        echo json_encode($data);
    }

     

    function LoadDataJP(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        //  $data= $this->Mod->getWhere('jenis_perangkat',array('id_unit' => sess()['unit']))->result_array();
         if (!empty(sess()['id_lokasi'])) {
           $param_lokasi= " AND  p.id_lokasi ='".sess()['id_lokasi']."'";
         }else{
             $param_lokasi= '';
         }
         $data=  $this->Mod->GetCustome(" SELECT  jp.nama from perangkat p 
                                    left join jenis_perangkat jp 
                                    on jp.id_jenisperangkat = p.id_jenisperangkat 
                                    WHERE p.id_unit in ('0','".sess()['unit']."') $param_lokasi
                                    GROUP  BY jp.nama")->result_array(); 
        //  $this->Mod->getData('jenis_perangkat')->result_array();
       
        echo json_encode($data);
    }

    function LoadJenis(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        //  $data= $this->Mod->getWhere('jenis_perangkat',array('id_unit' => sess()['unit']))->result_array();
        
         $data=  $this->Mod->GetCustome(" SELECT * FROM jenis_perangkat  
                                   
                                    WHERE id_unit in ('0','".sess()['unit']."')
                                   ")->result_array(); 
        //  $this->Mod->getData('jenis_perangkat')->result_array();
       
        echo json_encode($data);
    }

    function LoadDataCatagory(){
        $data=  $this->Mod->GetCustome(" SELECT * FROM fasilitas_catagory WHERE id_unit ='".sess()['unit']."'")->result_array(); 
       echo json_encode($data);
    }

    function LoadDataPerangkat($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         $data= $this->m_data->getWhere('perangkat',array('status !=' =>8,'id_unit' => sess()['unit'],'id_jenisperangkat' => $id))->result_array();
       
        echo json_encode($data);
    }
     function LoadDataPerangkatId($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         $data= $this->m_data->getWhere('perangkat',array('status !=' =>8,'id_unit' => sess()['unit'],'id_jenisperangkat' => $id))->result_array();
       
        echo json_encode($data);
    }
    
    function LoadDataPerangkatJenis($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         $data= $this->Mod->GetCustome(" SELECT * FROM perangkat WHERE status != 8 AND id_jenisperangkat ='".$id."'")->result_array(); 

        echo json_encode($data);
    }
    
    function LoadDataPerangkatByID($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         $data= $this->m_data->getWhere('fasilitas_detail',array('id_fasilitas' =>$id))->result_array();
         foreach ($data as $key => $value) {
            $detail=  $this->m_data->getWhere('perangkat',array('id_perangkat' => $value['id_perangkat']))->row_array();
           
            $data[$key]['detail'] = $detail;
        }
        
        
       
        echo json_encode($data);
    }
    
    function GetLokasi(){
        //$data= $this->Mod->getData('terminal')->result_array();
        $data= $this->Mod->getWhere('terminal',array('parent_id' =>-1))->result_array();
        echo json_encode($data);
    }
  
    function GetArea($idlokasi){
        $data= $this->Mod->getWhere('terminal',array('parent_id' =>$idlokasi))->result_array();
        echo json_encode($data);
    }

     function ListArea(){
        $data= $this->Mod->getWhere('area',array('status !=' =>'8'))->result_array();
        echo json_encode($data);
    }
  

    function SaveData(){

        $data=array_filter($_POST);
        unset($data['Newitems']);
        if (!empty($data)) {
            $data['id_unit']    = sess()['unit']; 
            $data['status']     = 1;
            $this->db->insert('fasilitas',$data);
            $id = $this->db->insert_id();
            if (!empty($_POST['Newitems'])) {
				
				foreach ($_POST['Newitems'] as $key => $value) {
					
					$perangkat=[

						'id_fasilitas' 		=>  $id,
						'id_perangkat' 		=>  $value['id_perangkat'],
						'id_jenisperangkat'	=> $value['id_jenisperangkat'], 
						'status' 			=> 1,
					];
                    $this->db->insert('fasilitas_detail',$perangkat);
                    // echo "<pre>",print_r ( $perangkat),"</pre>";
				}	
                $respon=[
                    'code'    => '200',
                    'msg'       => 'Data Berhasil di disimpan'
                ];
			}
           
        }else{
            $respon=[
                'code'    => '400',
                'msg'       => 'Data Gagal Disimpan, cek data kembali'
            ];
        }
        // echo "<pre>",print_r ( $data),"</pre>";
        echo json_encode($respon);
       
    }

    function EditData($id=null){
        $data           = $this->Mod->GetCustome("SELECT a.*,b.kode_unit as unit,c.nama_terminal as lokasi,d.nama_terminal as sub_lokasi FROM fasilitas a left join unit b on b.id_unit =a.id_unit left join terminal c on c.id=a.id_lokasi left join terminal d on d.id=a.id_sublokasi where a.id_fasilitas = '".$id."'")->row_array();
        $catagory       = $this->Mod->getWhere('fasilitas_catagory',array('id_catagory' =>$data['id_catagory']))->row_array();
        $data['nama_catagory']=(!empty($catagory)? $catagory['nama']:'');           
        
        $area               = $this->Mod->getWhere('area',array('id_area' =>$data['id_area']))->row_array();
        $data['nama_area'] = (!empty($area) ? $area['nama_area']: '');
        $detail         = $this->Mod->GetCustome("SELECT a.*,b.nama_perangkat,b.serial_number,c.nama as jenis_perangkat FROM fasilitas_detail a left join perangkat b on b.id_perangkat = a.id_perangkat left join jenis_perangkat c on c.id_jenisperangkat = a.id_jenisperangkat where a.id_fasilitas = '".$id."'")->result_array();
        foreach ($detail as $key => $value) {
                   
          $detail[$key]['tgl']=date("Y-m-d",strtotime($value['tanggal_penggunaan']));
        }
        $data['detail'] = $detail ;
        echo json_encode($data);
    }

    public function UpdateData($pk=null)
    {
        $data=array_filter($_POST);
        unset($data['Newitems']);
        unset($data['Items']);
        unset($data['removed_items']);
        if (!empty($data)) {
            $update = $this->Mod->update2('fasilitas',array('id_fasilitas' =>$pk),$data);
            // $this->db->insert('user',$data);
            if (!empty($_POST['removed_items'])) {
             
				foreach ($_POST['removed_items'] as $key => $value) {
                    $fasilitas_detail = $this->m_data->getWhere('fasilitas_detail',array('idfasilitas_detail' =>$value))->row_array();
                    $status_perangkat =[
                        'status' => 0 
                    ];


                    if (!empty($fasilitas_detail['id_perangkat'])) {
                        $this->Mod->update2('perangkat',array('id_perangkat' =>$fasilitas_detail['id_perangkat']),$status_perangkat);
                    }
                   
                    $result = $this->Mod->delete('fasilitas_detail', array('idfasilitas_detail' => $value));
                    
                    
                    
				}	
			}

            if (!empty($_POST['Items'])) {
				
				foreach ($_POST['Items'] as $key => $value) {
                    $fasilitas_detail = $this->m_data->getWhere('fasilitas_detail',array('idfasilitas_detail' =>$value['idfasilitas_detail']))->row_array();
                    $status_perangkat =[
                        'status' => 0 
                    ];
                    $this->Mod->update2('perangkat',array('id_perangkat' =>$fasilitas_detail['id_perangkat']),$status_perangkat);
                    //mengubah status perangkat sebelumnya diggunakan di fasilitas menjadi tidak digunakan


					$perangkat=[
						'id_fasilitas' 		    => $pk,
						'id_perangkat' 		    => $value['id_perangkat'],
						'id_jenisperangkat'	    => $value['id_jenisperangkat'], 
                        'tanggal_penggunaan'    => $value['tanggal_pemasangan'],
						'status' 			    => 1,
					];
                    $update_detail = $this->Mod->update2('fasilitas_detail',array('idfasilitas_detail' =>$value['idfasilitas_detail']),$perangkat);
                 
                    $status_perangkat =[
                        'status' => 1 
                    ];
                    $this->Mod->update2('perangkat',array('id_perangkat' =>$value['id_perangkat']),$status_perangkat);
				}	
				
			}
            if (!empty($_POST['Newitems'])) {
				
				foreach ($_POST['Newitems'] as $key => $value) {
					
					$perangkat=[
						'id_fasilitas' 		    => $pk,
						'id_perangkat' 		    => $value['id_perangkat'],
						'id_jenisperangkat'	    => $value['id_jenisperangkat'], 
                        'tanggal_penggunaan'    => '',
						'status' 			    => 1,
					];
                    $this->db->insert('fasilitas_detail',$perangkat);

                    $status_perangkat =[
                        'status' => 1 
                    ];
                    $this->Mod->update2('perangkat',array('id_perangkat' =>$value['id_perangkat']),$status_perangkat);
				}	
				
			}
            if ($update) {
                $respon=[
                    'code'    => '200',
                    'msg'       => 'Data Berhasil di disimpan'
                ];

            }else{
                $respon=[
                    'code'    => '400',
                    'msg'       => 'Data Gagal Disimpan, cek data kembali'
                ];
            }
        }else{
            $respon=[
                'code'    => '400',
                'msg'       => 'Data Gagal Disimpan, Tidak ada perubahan'
            ];
        }
        echo json_encode($respon);        
    }

    function UploadData(){
        $data=array();
        if(isset($_FILES["filelampiran"]["name"])){
			$path = $_FILES["filelampiran"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
       
			
            $data           = array();
            $data_triwulan  = array();
            $data_sms       = array();
            $data_thn       = array();
            $datacctv_bulanan = array();

            $detail_prop= array();
			foreach($object->getWorksheetIterator(1) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
         
                    if ($worksheet == 0) {
                        for($col=3 ; $col<=$highestColumnIndex; $col++){
                            if ($col >= 9 && $col <= 14) {
                                $detail_prop            = $value->getCellByColumnAndRow($col, 3)->getValue();
                                $data['detail_prop_pc'][]= $detail_prop;
                               
                            }
                          
                          
                            
                        }

                          for ($row=4; $row <=$highestRow ; $row++) { 
                            $nama_fasilitas         = $value->getCellByColumnAndRow(1, $row)->getValue();
                            $lokasi                 = $value->getCellByColumnAndRow(2, $row)->getValue();
                            $sublokasi              = $value->getCellByColumnAndRow(3, $row)->getValue();
                            $ipaddress              = $value->getCellByColumnAndRow(4, $row)->getValue();
                            //mini pc
                            $buatan                 = $value->getCellByColumnAndRow(5, $row)->getValue();      
                            $merk                   = $value->getCellByColumnAndRow(6, $row)->getValue();
                            $model                  = $value->getCellByColumnAndRow(7, $row)->getValue();
                            $sn_perangkat           = $value->getCellByColumnAndRow(8, $row)->getValue();
                            $suport_port            = $value->getCellByColumnAndRow(9, $row)->getValue();
                            $disk                   = $value->getCellByColumnAndRow(10, $row)->getValue();
                            $ram                    = $value->getCellByColumnAndRow(11, $row)->getValue();
                            $os                     = $value->getCellByColumnAndRow(12, $row)->getValue();
                            $tahun_perangkat        = $value->getCellByColumnAndRow(13, $row)->getValue();

                            //monitor
                            $buatan2                = $value->getCellByColumnAndRow(15, $row)->getValue();      
                            $merk2                  = $value->getCellByColumnAndRow(16, $row)->getValue();
                            $model2                 = $value->getCellByColumnAndRow(17, $row)->getValue();
                            $sn_perangkat2          = $value->getCellByColumnAndRow(18, $row)->getValue();
                            $suport_port2           = $value->getCellByColumnAndRow(19, $row)->getValue();
                            $ukuran                 = $value->getCellByColumnAndRow(20, $row)->getValue();
                            $tahun_perangkat        = $value->getCellByColumnAndRow(21, $row)->getValue();
                            $kondisi2                = $value->getCellByColumnAndRow(22, $row)->getValue();

                          
                            $getmerek               = $this->Mod->getWhere('merk',array('nama' =>$merk ))->row_array();
                        
                            $miniPC = [
                                'id_jenisperangkat'     => 2,
                                'nama_perangkat'        => 'Mini PC '.$merk.' model '. $model ,
                                'model'                 => $model  ,
                                'merk_id'               => $getmerek['id'] , 
                                'serial_number'         => $sn_perangkat  , 
                                'suport_port'           => $suport_port,
                                'disk_kapasity'         => $disk,
                                'ram'                   => $ram, 
                                'OS'                    => $os,
                                'tahun_pengadaan'       => $tahun_perangkat ,
                            ];

                            $getmerek2               = $this->Mod->getWhere('merk',array('nama' =>$merk2 ))->row_array();
                            $monitor =[
                                'id_jenisperangkat'     => 1,
                               
                                'nama_perangkat'        => 'Monitor '.$merk2.' model '. $model2 ,
                                'buatan'                => $buatan2 ,
                                'merk_id'               => $getmerek2['id'] , 
                                'model'                 => $model2  ,
                                'serial_number'         => $sn_perangkat2  , 
                                'suport_port'           => $suport_port2,
                                'ukuran'                => $ukuran,
                                'tahun_pengadaan'       => $tahun_perangkat ,
                                'kondisi'               => $kondisi2, 
                               
                               
                            ];
                            $sub =  $this->Mod->getWhere('terminal',array('nama_terminal' =>$sublokasi ))->row_array();
                            if (!empty($sub)) {
                                $id_sub = $sub['id'];
                            }else{
                                $id_sub = '';
                            }
                        
                            if ($lokasi = '3U-INT') {
                                $data_lokasi = '3';
                            }
                            $data['data'][] =[
                                'nama_fasilitas'    => $nama_fasilitas, 
                                'id_unit'           => '',
                                'id_lokasi'         => $data_lokasi,
                                'id_sublokasi'      => $id_sub, 
                                'ip_address'        => $ipaddress,
                                'mini_pc'           =>  $miniPC,
                                'monitor'           =>  $monitor
                            ];
                        
                            
                        }
                    }
                   }
             
           
        }

        $perangkat_detail=array();
        foreach ($data as $key => $value) {
           
            if ($key == 'data') {
                $fasilitas =[
                    'nama_fasilitas'        => '' ,
                    'id_unit'               => '' ,
                    'id_lokasi'             =>  '',
                    'id_sublokasi'          => '', 
                    'ip_address'            => ''
                ];
              
                foreach ($value as $key2 => $value2) {
                  
                    if ($key2 =='mini_pc') {
                      
                        $perangkat=[
                            'id_jenisperangkat'     => $value2['mini_pc']['id_jenisperangkat'],
                            'nama_perangkat'        => $value2['mini_pc']['nama_perangkat'],
                            'model'                 => $value2['mini_pc']['model'],
                            'merk_id'               => $value2['mini_pc']['merk_id'],
                            'serial_number'         => $value2['mini_pc']['serial_number'],
                        ];
                        foreach ($value2['mini_pc'] as $key3 => $val3) {
                           
                           
                            if ($key3 == 'suport_port') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 27,
                                    'nama'                      => $val3
                                ];

                            }

                            if ($key3 == 'disk_kapasity') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 28,
                                    'nama'                      => $val3
                                ];
                            }

                            if ($key3 == 'disk_kapasity') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 28,
                                    'nama'                      => $val3
                                ];
                            }

                            if ($key3 == 'ram') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 29,
                                    'nama'                      => $val3
                                ];
                            }

                            if ($key3 == 'OS') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 30,
                                    'nama'                      => $val3
                                ];
                            }
                          
                       
                        }

                        
                    }

                    if ($key2 =='monitor') {
                      
                        $perangkat=[
                            'id_jenisperangkat'     => $value2['monitor']['id_jenisperangkat'],
                            'nama_perangkat'        => $value2['monitor']['nama_perangkat'],
                            'model'                 => $value2['monitor']['model'],
                            'merk_id'               => $value2['monitor']['merk_id'],
                            'serial_number'         => $value2['monitor']['serial_number'],
                        ];
                        foreach ($value2['monitor'] as $key3 => $val3) {
                           
                           
                            if ($key3 == 'suport_port') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 31,
                                    'nama'                      => $val3
                                ];

                            }

                            if ($key3 == 'ukuran') {
                                $perangkat_detail[]=[
                                    'idmaster_detail_perangkat' => 1,
                                    'nama'                      => $val3
                                ];

                            }
                        }
                       
                     
                    }
                    
                }
                
            }
           
         
        }
        echo "<pre>", print_r($perangkat_detail), "</pre>";
    }

    function DeleteData($id=null){
        if (!empty($id)) {
           
           $result = $this->Mod->delete('fasilitas',array('id_fasilitas'=>$id));
            $this->Mod->delete('fasilitas_detail',array('id_fasilitas'=>$id));
           
            if ($result) {
                $response=[
                    'code' => '200',
                    'msg'    =>  'Data Berhasil Di Proses'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    => 'Gagal Proses Data'
                ];
            }
        }else{
            $response=[
                'code'      => '500',
                'msg'    =>  'Gagal Proses Data'
            ];
        }
       
        echo json_encode($response);
    }
//     function   CopyData(){
//         $fasilitas = $this->m_data->getWhere('perangkat_old',array('status !=' =>8))->result_array();
//         foreach ($fasilitas as $key => $value) {
//             $data=[
//                 'nama_fasilitas'    => $value['nama_perangkat'] ,
//                 'ip_address'        => $value['ip'] ,
//                 'keterangan'        => $value['lokasi'] ,
//                 'id_unit'           => sess()['unit'],
//                 'status'            => 0
//             ];
//             $this->db->insert('fasilitas',$data);
//         }
//         echo "<pre>", print_r($fasilitas), "</pre>";
//     }


        function CekIp($id_fasilitas = null){
            if (!empty($id_fasilitas)) {
                $data_res = $this->m_data->getWhere('fasilitas',array('id_fasilitas' =>$id_fasilitas ))->row_array();
                $replay =1; 
                $respon=array();
                if (!empty($data_res['ip_address'])) {
                   $ip=$data_res['ip_address'];
                    exec("ping -n 3  $ip", $output, $status);
                    if ($status == 0) {
                        $respon=[
                            // 'ip'            => $ip,
                            'status'        => 1,
                            'updateDate'    => date("Y-m-d"),
                            'updateTime'    => date("h:i:sa")
                        ];
                        // $this->m_data->updateData('perangkat', array('id' => $data_res['id']), $respon);
                    }else{
        
                        $respon=[
                            // 'ip'            => $ip,
                            'status'        => 0,
                            'updateDate'    => date("Y-m-d"),
                            'updateTime'    => date("h:i:sa")
                        ];
                        // $this->m_data->updateData('perangkat', array('id' => $data_res['id']), $respon);
                        // $responLog=[
                        //     'ip'            => $ip,
                        //     'lokasi'        =>  $data_res['lokasi'],
                        //     'status'        => 'RTO',
                        //     'datecek'       => date("Y-m-d"),
                        //     'updateTime'    => date("h:i:sa")
        
                        // ];
                        //$this->m_data->insertData('perangkat',$data);
                    }
                    echo json_encode($respon);
                }
            }
            
    
           
        }

        function ValidateData(){
            $fasilitas = $this->m_data->getWhere('fasilitas',array('status !=' =>8, 'id_unit'=> sess()['unit']))->result_array();

            foreach ($fasilitas as $key => $value) {
                $detail = $this->m_data->getWhere('fasilitas_detail',array('id_fasilitas' =>$value['id_fasilitas']))->result_array();
                foreach ($detail as $key2 => $val2) {
                    $perangkat = $this->m_data->getWhere('perangkat',array('id_perangkat' =>$val2['id_perangkat']))->row_array();
                    if (!empty($perangkat)) {
                       
                            $perangkat['idfasilitas'] = $value['id_fasilitas'];
                         
                            $fasilitas[$key]['perangkat'][] = [
                                'id_perangkat'          => $perangkat['id_perangkat'],
                                'id_jenisperangkat'     => $perangkat['id_jenisperangkat'],
                                'status'                => $perangkat['status'] 

                            ];
                            
                    }else{
                        $fasilitas[$key]['perangkat'][]='';
                    }
                   
                    
                }
                // $data=[
                //     'nama_fasilitas'    => $value['nama_perangkat'] ,
                //     'ip_address'        => $value['ip'] ,
                //     'keterangan'        => $value['lokasi'] ,
                //     'id_unit'           => sess()['unit'],
                //     'status'            => 0
                //     ];
               
            }
            // echo "<pre>", print_r($fasilitas), "</pre>";

        
        }

        function ViewDetail($id=null){
            if (!empty($id)) {
                $data           = $this->Mod->GetCustome("SELECT a.*,b.kode_unit as unit,c.nama_terminal as lokasi,d.nama_terminal as sub_lokasi FROM fasilitas a left join unit b on b.id_unit =a.id_unit left join terminal c on c.id=a.id_lokasi left join terminal d on d.id=a.id_sublokasi where a.id_fasilitas = '".$id."'")->row_array();
                $detail         = $this->Mod->GetCustome("SELECT a.*,b.nama_perangkat,b.serial_number,c.nama as jenis_perangkat FROM fasilitas_detail a left join perangkat b on b.id_perangkat = a.id_perangkat left join jenis_perangkat c on c.id_jenisperangkat = a.id_jenisperangkat where a.id_fasilitas = '".$id."'")->result_array();
                $catagory = $this->Mod->getWhere('fasilitas_catagory',array('id_catagory' =>$data['id_catagory']))->row_array();
                $data['jenis'] = (!empty($catagory) ? $catagory['nama'] : '');    
                foreach ($detail as $key => $value) {
                    
                    $detail[$key]['serial_number'] =(!empty($value['serial_number']) ? $value['serial_number']: "-");
                }
                $data['detail'] = $detail ;
                $lv1            = "doc";
                if (!file_exists($lv1)){
                   mkdir($lv1);
                }
                $lv2 = $lv1."/QRCode2";
                if (!file_exists($lv2)){
                    mkdir($lv2);
                }

                if (empty($data['QRCODE']) ) {
                    $qr  =  $this->QRCodeRender($data['id_fasilitas']);
                    $update = ['QRCODE' =>$qr ];
                    $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$id),$update);
                    $data['QRCODE'] = $qr;
                }else{
                    $filename='doc/QRCode/'.$data['QRCODE'];
                    if (!file_exists($filename)) {
                        $qr             =  $this->QRCodeRender($data['id_fasilitas']);
                        $update         = ['QRCODE' =>$qr ];
                        $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$id),$update);
                        $data['QRCODE'] = $qr;
                    }
                }
              
                echo json_encode($data);
               
            }
        }

        function SessTerminal(){
            $fasilitas = $this->m_data->getWhere('fasilitas',array('status !=' =>8, 'id_unit'=> sess()['unit'],'id_lokasi ' => 0))->result_array();
         
            foreach ($fasilitas as $key => $value) {
               $terminal =  $this->Mod->GetCustome("SELECT  * FROM terminal WHERE nama_terminal like '%".$value['terminal']."%'")->row_array();
                if (!empty($terminal)) {
                   
                   if ($terminal['parent_id'] == '-1') {
                        $update=['id_lokasi'     => $terminal['id']];
                   }else{
                        $update=[
                            'id_lokasi'         => $terminal['parent_id'],
                            'id_sublokasi'     => $terminal['id'
                            ]];
                   }
                    
                   $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$value['id_fasilitas']),$update);
                   
                }else{
                    //  echo  $value['nama_fasilitas']."|".$value['terminal']."|Jalan Raya Perkantoran <br>";
                      // echo "<pre>", print_r($value), "</pre>"; 
                    if ($value['terminal'] =='JNP') {
                        $update=['id_lokasi'     => 4];
                    }
                    elseif ($value['terminal'] =='Apron Terminal 2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='Parkir Terminal 1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='Parkir Terminal 2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='Damri Terminal 1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='Damri Terminal 2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='Parkir Inap') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='Apron Terminal 1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='Parkir Terminal 1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='Apron Terminal 3') {
                        $update=['id_lokasi'     => 3];
                    }elseif ($value['terminal'] =='Cooling T1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='Cooling T2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='Masjid Internasional T3') {
                        $update=['id_lokasi'     => 3];
                    }elseif ($value['terminal'] =='AOCC') {
                        $update=['id_lokasi'     => 49];
                    }elseif ($value['terminal'] ==' Terminal 3') {
                        $update=['id_lokasi'     => 3];
                    }elseif ($value['terminal'] ==' Terminal 2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] ==' Terminal 1') {
                        $update=['id_lokasi'     => 1];
                    }elseif ($value['terminal'] =='APRON TERMINAL 2') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='APRON TERMINAL 1') {
                        $update=['id_lokasi'     => 2];
                    }elseif ($value['terminal'] =='Parking Inter') {
                        $update=['id_lokasi'     => 3];
                    }elseif ($value['terminal'] =='DKT') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='Cargo') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='Shelter Kalayang') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='MPS') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='Gedung 600') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='TOD') {
                        $update=['id_lokasi'     => 4];
                    }elseif ($value['terminal'] =='MPS 1') {
                        $update=['id_lokasi'     => 4];
                    }
                    else{
                        $update=['id_lokasi'     => 0];
                    }
                    
                   $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$value['id_fasilitas']),$update);
                    
                  
                }
                
                    
                
            }
            // echo "<pre>", print_r($fasilitas), "</pre>";
        }

        function DellFasilitas(){
            $fasilitas = $this->m_data->getWhere('fasilitas',array( 'id_unit'=>'3'))->result_array();

            foreach ($fasilitas as $key => $value) {
                $this->Mod->delete('fasilitas', array('id_fasilitas' => $value['id_fasilitas']));
                $this->Mod->delete('fasilitas_detail', array('id_fasilitas' => $value['id_fasilitas']));
              
            }
        }

        function AddDetailPerangkat(){
            $fasilitas = $this->Mod->GetCustome(" SELECT * FROM fasilitas WHERE id_unit = '3' ")->result_array(); 
            //  $this->m_data->getWhere('fasilitas',array('id_unit' =>3))->result_array();
            $perangkat = $this->Mod->GetCustome("SELECT * FROM perangkat WHERE id_jenisperangkat IN ('3','4' )")->result_array(); 
            
           
            foreach ($fasilitas as $key => $value) {

                foreach ($perangkat as $key2 => $value2) {
                    $insert =[
                        'id_fasilitas'          => $value['id_fasilitas'],
                        'id_perangkat'          => $value2['id_perangkat'],
                        'id_jenisperangkat'     => $value2['id_jenisperangkat'],
                        'status'                => '1'
                    ];
                   
                   $cek =  $this->m_data->getWhere('fasilitas_detail',array('id_fasilitas' =>$value['id_fasilitas'], 'id_jenisperangkat'=>$value2['id_jenisperangkat'],'id_perangkat' =>$value2['id_perangkat'] ))->row_array();
                   if (!empty($cek)) {
                    echo "DATa sudah ada";
                 
                   }else{
                    echo "<pre>", print_r($cek), "</pre>";
                    $this->db->insert('fasilitas_detail',$insert);
                   }
                    // $this->db->insert('fasilitas_detail',$insert);
                }
                # code...
            }
           
            // echo "<pre>", print_r($perangkat), "</pre>";
        }

        function  AddOderFasilias(){
            $fasilitas = $this->m_data->getWhere('fasilitas',array('status !=' =>8, 'id_unit'=> sess()['unit']))->result_array();

            foreach ($fasilitas as $key => $value) {

                $listrik =[

                ];
                # code...
            }

        }

        function GenQRcode($id=null){
            if (!empty($id)) {
                $fasilitas = $this->m_data->getWhere('fasilitas',array('status !=' =>8, 'id_fasilitas'=> $id))->row_array();
                // echo "<pre>", print_r($fasilitas), "</pre>";

                if (empty($fasilitas['QRCODE'])) {
                    $qr = $this->QRCodeRender($fasilitas['id_fasilitas']);
                    $update = ['QRCODE' =>$qr ];
                    $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$id),$update);
                }else{
                    $qr = $fasilitas['QRCODE'];
                }
              

               
            }else{
                echo "Semua";
            }

        }


        public function QRCodeRender($id=null){

            $name=rand();
            $tempdir = "doc/QRCode/"; //Nama folder tempat menyimpan file qrcode
            if (!file_exists($tempdir)) //Buat folder bername temp
                mkdir($tempdir);
            
                //ambil logo
                $logopath="assets_v2/images/ap2.png";
                 
                 //isi qrcode jika di scan
                 $codeContents = base_url('informasi/fasilitas/').$id;
                
                 
                 //simpan file qrcode
                 QRcode::png($codeContents, $tempdir.$name.'.png', QR_ECLEVEL_H, 10,4);
                 
                 
                 // ambil file qrcode
                  $QR = imagecreatefrompng($tempdir.$name.'.png');
                 
                 // memulai menggambar logo dalam file qrcode
                 $logo = imagecreatefromstring(file_get_contents($logopath));
                  
                 imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
                 imagealphablending($logo , false);
                 imagesavealpha($logo , true);
                 
                 $QR_width = imagesx($QR);
                 $QR_height = imagesy($QR);
                 
                 $logo_width = imagesx($logo);
                 $logo_height = imagesy($logo);
                 
                 // Scale logo to fit in the QR Code
                 $logo_qr_width = $QR_width/5;
                 $scale = $logo_width/$logo_qr_width;
                 $logo_qr_height = $logo_height/$scale;
                 
                 imagecopyresampled($QR, $logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
                 
                 // Simpan kode QR lagi, dengan logo di atasnya
                 imagepng($QR,$tempdir.$name.'.png');
                 //echo '<img src="'.base_url().$tempdir. $name.'.png" class="img-fluid rounded"/>';
                 return $name.'.png' ;
                
        }

    public function informasi (){
        $data=[];
        $this->load->view('infromasi_fasilitas', $data);
    }

    function GetFasilitas(){
        $serc= $this->input->post('q');
        if (!empty($serc)) {
			$query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where nama_fasilitas like '".$serc."' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where nama_fasilitas like '".$serc."' ")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'name'	=> $value['nama_fasilitas'],
				'id'	=> $value['id_fasilitas']
			];
		}
		echo json_encode($data);
    }


    function GetFasilitasTemuan(){
   
        $serc= $this->input->post('serc');
        if (!empty(sess()['id_lokasi'])) {
            $lokasi =" AND id_lokasi='".sess()['id_lokasi']."'";
        }else{
             $lokasi ="";
        }
        if (!empty($serc)) {
			$query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where id_unit = '".sess()['unit']."' AND status = '1' $lokasi AND nama_fasilitas like '%$serc%' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where  id_unit = '".sess()['unit']."' $lokasi limit 5")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama_fasilitas'],
				'id'	=> $value['id_fasilitas'],
                'lokasi'=> $value['id_lokasi']
			];
		}
		echo json_encode($data);
    }
    
    

    function Cekdata(){
        $fasilitas =  $this->m_data->getWhere('fasilitas',array('status !=' =>8,'id_unit' => 1))->result_array();
       
        $param = 'INT';
        $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where terminal like '%".$param."%' ")->result_array(); 

        $lok =  $this->Mod->GetCustome("SELECT  *
            FROM terminal  where nama_terminal  like '%".$param."%' ")->row_array(); 
            foreach ($query as $key => $value) {
                $update_lokasi=[
                    'id_area'     => $lok['id']
                
                ];
                echo "<pre>",print_r ( $update_lokasi),"</pre>";
                $update = $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$value['id_fasilitas']),$update_lokasi);
            }

    }

    function area($id_area=null){
        if (!empty($id_area)) {
            $data =  $this->Mod->GetCustome("SELECT  a.*
            FROM fasilitas a  
            LEFT JOIN fasilitas_detail b 
            ON 
            b.id_fasilitas = a.id_fasilitas
            where a.id_area ='$id_area' AND a.id_unit = '".sess()['unit']."' AND a.status = '1' AND b.id_jenisperangkat ='".$_POST['catagory']."'")->result_array(); 
            $response=[
                'code'      => '202',
                'data'      => $data,
                'msg'       =>  ''
            ];
        }else{
            $response=[
                'code'      => '404',
                'data'      => '',
                'msg'       =>  'Parameter dan Area Harus Di isi'
            ];
            
        }
        
       echo json_encode($data);
    }

    function FasilitasJenisperangkat(){

        if (!empty($_POST['jenis'])&&!empty($_POST['catagory'])&&!empty($_POST['area'])) {
            $data =  $this->Mod->GetCustome("SELECT  a.*
            FROM 
                fasilitas a  
            LEFT JOIN 
                fasilitas_detail b 
            ON 
             b.id_fasilitas = a.id_fasilitas
            where
                b.id_jenisperangkat ='".$_POST['jenis']."' AND a.id_unit = '".sess()['unit']."' AND a.id_lokasi = '".sess()['id_lokasi']."'AND a.status = '1' AND a.id_catagory ='".$_POST['catagory']."' AND a.id_area = '".$_POST['area']."'")->result_array(); 
            
           $response=[
                'code'      => '202',
                'data'      => $data,
                'msg'       =>  ''
            ];
        }else{
            $response=[
                'code'      => '404',
                'data'      => '',
                'msg'       =>  'Parameter dan Area Harus Di isi'
            ];
            
        }
        echo json_encode($data);
    }

    function GetCatagory(){
       
        if (!empty(sess()['id_lokasi'])) {
            $param= " AND a.id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT *
            FROM fasilitas_catagory where id_unit = '".sess()['unit']."' $param AND status = '1'  AND nama like '%$serc%' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT  nama,id_catagory
            FROM fasilitas_catagory where id_unit = '".sess()['unit']."' $param AND status = '1'")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama'],
				'id'	=> $value['id_catagory']
			];
		}
		echo json_encode($data);
    
    }

    function CekFasilitasPeranngkat(){
        $query =  $this->Mod->GetCustome("SELECT  b.id_perangkat,a.id_lokasi
                                            FROM  fasilitas a  
                                            left join 
                                            fasilitas_detail b 
                                            ON b.id_fasilitas = a.id_fasilitas
                                            left join perangkat c 
                                            ON
                                            c.id_perangkat = b.id_perangkat 
                                            WHERE 
                                            a. id_unit = '".sess()['unit']."' AND c.status = '1' AND b.id_jenisperangkat not in('3','4')
                                            ")->result_array();   

        foreach ($query as $key => $value) {
             $update_lokasi=[
                    'id_lokasi'     => $value['id_lokasi']
                
                ];
           $update = $this->Mod->update2('perangkat',array('id_perangkat  ' =>$value['id_perangkat']),$update_lokasi);
          
        }
		echo "<pre>",print_r ( $query),"</pre>";

    

    }

    function ExportData(){
        $data=$this->Mod->GetCustome("SELECT a.nama_fasilitas as fasilitas,b.nama as catagory, a.ip_address,
                                            c.nama_terminal as lokasi ,d.nama_area as area,fd.id_perangkat, 
                                            p.nama_perangkat, jp.nama as jenis_perangkat,p.serial_number FROM 
                                            fasilitas a 
                                    LEFT JOIN 
                                        fasilitas_catagory b 
                                    ON 
                                        b.id_catagory = a.id_catagory 
                                    LEFT JOIN 
                                        terminal c ON a.id_lokasi = c.id 
                                    LEFT JOIN area d ON d.id_area = a.id_area 
                                    LEFT JOIN fasilitas_detail fd ON fd.id_fasilitas = a.id_fasilitas
                                    LEFT JOIN perangkat p on p.id_perangkat= fd.id_perangkat
                                    LEFT JOIN jenis_perangkat jp on jp.id_jenisperangkat = fd.id_jenisperangkat
                                    WHERE a.status != 8 
                                    AND fd.id_jenisperangkat not in ('3','4') AND a.id_unit= '".sess()['unit']."'")->result_array();   
        $perangkat =$this->Mod->GetCustome("SELECT b.nama as jenis,c.nama  as merk,a.* FROM perangkat a 
                        left join jenis_perangkat b 
                        on b.id_jenisperangkat = a.id_jenisperangkat
                        left join merk c 
                        on c.id =a.merk_id
                        WHERE a.status != 8 AND b.id_jenisperangkat not in ('3','4') AND a.id_unit='".sess()['unit']."'")->result_array();   
        
        $fileName = 'Fasilitas.xlsx';  
      
        $no=2;
        $objPHPExcel = new PHPExcel();
        $sheet1 = $objPHPExcel->getActiveSheet();
        $sheet1->setTitle("Fasilitas&Perangkat");
        $sheet1->getColumnDimension('A')->setWidth("24");
        $sheet1->getColumnDimension('B')->setWidth("50");
        $sheet1->getColumnDimension('C')->setWidth("14");
        $sheet1->getColumnDimension('D')->setWidth("14");
        $sheet1->getColumnDimension('E')->setWidth("10");
        $sheet1->getColumnDimension('F')->setWidth("20");
        $sheet1->getColumnDimension('G')->setWidth("30");
        $sheet1->getColumnDimension('H')->setWidth("25");

        $sheet1->setCellValue('A1', 'Catagory');
        $sheet1->setCellValue('B1', 'Fasilitas');
        $sheet1->setCellValue('C1', 'IP Address');
        $sheet1->setCellValue('D1', 'Lokasi');
        $sheet1->setCellValue('E1', 'Area');
        $sheet1->setCellValue('F1', 'Jenis Perangkat');
        $sheet1->setCellValue('G1', 'Perangkat');
        $sheet1->setCellValue('H1', 'Serial Number');


        
        
        foreach ($data as $key_r => $value) {
                $sheet1->setCellValue('A'.$no, $value['catagory']);
                $sheet1->setCellValue('B'.$no, $value['fasilitas']);
                $sheet1->setCellValue('C'.$no, $value['ip_address']);
                $sheet1->setCellValue('D'.$no, $value['lokasi']);
                $sheet1->setCellValue('E'.$no, $value['area']);
                $sheet1->setCellValue('F'.$no, $value['jenis_perangkat']);
                $sheet1->setCellValue('G'.$no, $value['nama_perangkat']);
                $sheet1->setCellValue('H'.$no, $value['serial_number']);
                $no++;
        }
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Perangkat');
        $objPHPExcel->addSheet($myWorkSheet, 1); // Tambahkan sebagai sheet ke-2
        $objPHPExcel->setActiveSheetIndex(1);
        $sheet2 = $objPHPExcel->getActiveSheet();
        $sheet2->setCellValue('A1', 'id_perangkat');
        $sheet2->setCellValue('B1', 'Jenis Perangkat');
        $sheet2->setCellValue('C1', 'Merk');
        $sheet2->setCellValue('D1', 'Nama Perangkat');
        $sheet2->setCellValue('E1', 'Serial Number');
        $sheet2->setCellValue('F1', 'Status Perangkat');
        $sheet2->getColumnDimension('B')->setWidth("20");
        $sheet2->getColumnDimension('C')->setWidth("15");
        $sheet2->getColumnDimension('D')->setWidth("32");
        $sheet2->getColumnDimension('E')->setWidth("25");
        $sheet2->getColumnDimension('F')->setWidth("15");
        $no_p= 2;
        foreach ($perangkat as $key_r => $value) {
            $sheet2->setCellValue('A'.$no_p, $value['id_perangkat']);
            $sheet2->setCellValue('B'.$no_p, $value['jenis']);
            $sheet2->setCellValue('C'.$no_p, $value['merk']);
            $sheet2->setCellValue('D'.$no_p, $value['nama_perangkat']);
            $sheet2->setCellValue('E'.$no_p, $value['serial_number']);
            $sheet2->setCellValue('F'.$no_p, $value['status']);
            $no_p++;
        }
        $sheet2->getColumnDimension('A')->setVisible(false);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $namafile = "Fasilitas ".sess()['unit_kode'].".xlsx";
                $path = "./temp/$namafile";
               
                  $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                );
                $objWriter->save($path);
                echo json_encode($respon_data);
        // echo "<pre>",print_r ($perangkat),"</pre>";
    }
    
    function FilterListArea(){
        $data= $this->Mod->GetCustome("SELECT b.* FROM fasilitas a left join area b on b.id_area = a.id_area where b.id_area is not null GROUP BY b.nama_area")->result_array();
        echo json_encode($data);
    }
    
    
    function GetFasilitasTemuan2()
{
    $serc   = trim($this->input->post('serc', true));
    $unit   = sess()['unit'];
    $lokasi = !empty(sess()['id_lokasi']) ? "AND id_lokasi = '".sess()['id_lokasi']."'" : "";

    // WAJIB LIMIT
    $limit = 20;

    if ($serc !== '') {
        $sql = "
            SELECT 
                id_fasilitas AS id,
                nama_fasilitas AS text
            FROM fasilitas
            WHERE id_unit = '$unit'
              AND status = '1'
              $lokasi
              AND nama_fasilitas LIKE ?
            ORDER BY nama_fasilitas ASC
            LIMIT $limit
        ";

        $query = $this->db->query($sql, ["%{$serc}%"])->result_array();
    } else {
        $sql = "
            SELECT 
                id_fasilitas AS id,
                nama_fasilitas AS text
            FROM fasilitas
            WHERE id_unit = '$unit'
              AND status = '1'
              $lokasi
            ORDER BY nama_fasilitas ASC
            LIMIT 5
        ";

        $query = $this->db->query($sql)->result_array();
    }

    echo json_encode([
        'results' => $query
    ]);
}
}