<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
        $this->load->model("m_data");
        $this->load->library('Ciqrcode');
       
       // $this->role();
    }

    // private function position() {
    //     $data["position"] = "perangkat";
    //     return $data;
    // }
   
   public function staticBasicAuthentication()
    {
      
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
         
            if (!empty($this->input->request_headers()['Authorization'])) {
                $token  = $this->input->request_headers()['Authorization'];
                $arr = explode(" ", $token); 
                $token = $arr[1]; 
                $res = $this->Mod->CekToken($arr[1]);
              
                if (empty($res->num_rows())) {
                   
                        header('WWW-Authenticate: Basic realm="My Realm"');
                        header('HTTP/1.0 401 Unauthorized');
                        echo '<h1>Access Denied! Username& Password or Token</h1>';
                        exit; 
                }else{
                    
                   return $res->row_array();
                }
            } else {
                if ( !isset(json_decode($this->input->raw_input_stream)->username)) {
                        header('WWW-Authenticate: Basic realm="My Realm"');
                        header('HTTP/1.0 401 Unauthorized');
                        echo '<h1>Access Denied!!!!</h1>';
                        exit; 
                }else{
                    echo "ada";
                }
            }
            
        }else{
            $request = new stdClass();
            $request->username = $_SERVER['PHP_AUTH_USER'];
            $request->password = $_SERVER['PHP_AUTH_PW'];
                   
            $model = $this->m_pronia->GetAut($request)->row_array();
            if (empty($model)) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo '<h1>Access Denied! Username& Password or Token</h1>';
                exit; 
            }else{
                echo "ada";
            }
        }
    }

    public function GetToken(){
        $request = json_decode($this->input->raw_input_stream);
        $query = "SELECT id_api,access_token FROM api_integrasi";
        $conds[] = "status = '1'";
        if (isset($request->username)) {
            $conds[] = "username = '" . $request->username . "'";
        } else {
            echo "username REQUIRED.";
            die();
        }

        if (isset($request->password)) {
            $conds[] = "password = '" . $request->password . "'";
        } else {
            echo "password REQUIRED.";
            die();
        }

        if (count($conds)) {
            $query .= ' WHERE ' . implode(' AND ', $conds);
        }

        $model = $this->Mod->GetCustome($query)->row_array();
        
        header('Content-Type: application/json; charset=utf-8');
        if (!empty($model)) {
         
          
            $time=date('d-M-Y');
       		$options = ['cost' => 15,];
			$token= md5(password_hash($time, PASSWORD_BCRYPT, $options));
            $updateToken=[
                'access_token'  => $token
            ];
         
            $res= $this->Mod->update2('api_integrasi',array('id_api' =>$model['id_api']),$updateToken);
            
            echo json_encode(
                array(
                    'success' => true,
                    'message' => 'Data jenis perangkat',
                    'data'    => $token,
                )
            );
        }else{
          
            header('HTTP/1.0 401 Unauthorized');
             echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Get Operasi Pembebanan Mesin Pada Aplikasi ProNIA (durasi setiap 30 menit)',
                    'data'    => $model,
                )
            );
        }
       
    }
    
    public function index() {

    }

    function GetListCM(){
        
    }


    function GetArea($idlokasi){
        $data= $this->Mod->getWhere('terminal',array('parent_id' =>$idlokasi))->result_array();
        echo json_encode($data);
    }

    function ViewDetail($id=null){
            if (!empty($id)) {
                $data           = $this->Mod->GetCustome("SELECT a.*,b.kode_unit as unit,c.nama_terminal as lokasi,d.nama_terminal as sub_lokasi FROM fasilitas a left join unit b on b.id_unit =a.id_unit left join terminal c on c.id=a.id_lokasi left join terminal d on d.id=a.id_sublokasi where a.id_fasilitas = '".$id."'")->row_array();
                $detail         = $this->Mod->GetCustome("SELECT a.*,b.nama_perangkat,c.nama as jenis_perangkat FROM fasilitas_detail a left join perangkat b on b.id_perangkat = a.id_perangkat left join jenis_perangkat c on c.id_jenisperangkat = a.id_jenisperangkat where a.id_fasilitas = '".$id."'")->result_array();
           
                $data['detail'] = $detail ;

                if (empty($data['QRCODE']) ) {
                    $qr  =  $this->QRCodeRender($data['id_fasilitas']);
               
                    $update = ['QRCODE' =>$qr ];
                    $this->Mod->update2('fasilitas',array('id_fasilitas  ' =>$id),$update);
                     $data['QRCODE'] = $qr;
                }
              
                echo json_encode($data);
            }
    }


    function GenQRcode($id=null){
            if (!empty($id)) {
                $fasilitas = $this->m_data->getWhere('fasilitas',array('status !=' =>8, 'id_fasilitas'=> $id))->row_array();
               
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


   

    public function fasilitas ($id=null){
            $data=[];
            if (!empty($id)) {
            //    $id = xcrypt($id,'d');
               $data['id']         = $id;
               $this->load->view('infromasi_fasilitas', $data);
            }else{

            }
        //    echo "<pre>",print_r ( $data),"</pre>";     
            
    }
    
    public function perangkat ($id=null){
            $data=[];
            if (!empty($id)) {
            //    $id = xcrypt($id,'d');
               $data['id']         = $id;
               $this->load->view('infromasi_perangkat', $data);
            }else{

            }
          
            
    }

        
    function LoadDataAnl($id=null){
        $perangkat                              = $this->m_data->getWhere('perangkat',array('id_perangkat' => $id))->row_array();
        if (!empty($perangkat['nama_perangkat'])) {
            $lokasi                             =  $this->m_data->getWhere('terminal',array('id' => $perangkat['id_perangkat']))->row_array();
            $perangkat['nama_perangkat']        =  (!empty($perangkat['nama_perangkat']) ? $perangkat['nama_perangkat']: '');
        }else{
            $perangkat['nama_perangkat']        =  (!empty($lokasi['nama_perangkat']) ? $lokasi['nama_perangkat']: '');
        }
        // $result['data']=  $data;
        $todayDate = date('Y-m-d');
        $logHistory = $this->Mod->GetCustome(" SELECT * FROM logbook WHERE id_fasilitas = '".$id."'
                                        ")->result_array();
 
                                             // WHERE 
                                             // DATE(tj.date_start) = '$todayDate'
    
        // Menyimpan data log history ke dalam variabel $data
        $result['LogHistory'] = $logHistory;
        // Mengemas semua data ke dalam satu array
    
        // $result['data'] = $data;

        $downtime = $this->Mod->GetCustome("SELECT SUM(TIMESTAMPDIFF(MINUTE, date_start, update_date)) AS total_downTime FROM tinjut WHERE update_date >= NOW() - INTERVAL 1 MONTH AND date_start >= NOW() - INTERVAL 1 MONTH")->row_array();
         $uptime = $this->Mod->GetCustome("SELECT (TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH)) * (SELECT COUNT(*) FROM fasilitas)) AS uptime")->row_array();
         
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
        
        foreach ($tabel as $key => $value) {
           $tabel[$key]['id_perangkat']=xcrypt($value['id_perangkat'],'e');
        }
        $result['tabel-data']   = $tabel;

        // $total_log = $this->Mod->GetCustome(" SELECT a.id_jenisperangkat,a.nama,COUNT(b.id_fasilitas) as total FROM jenis_perangkat a left join logbook b on b.id_jenisperangkat = a.id_jenisperangkat  where b.id_fasilitas = ".$id." GROUP by a.id_jenisperangkat,a.nama,b.id_fasilitas")->result_array();
        $total_log =$this->Mod->GetCustome("SELECT b.* FROM fasilitas_detail a left join jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat where a.id_fasilitas ='".$id."'")->result_array();
        $totaldata_log=0;
        foreach ($total_log as $key => $value) {
           
            $perangkat = $this->m_data->getWhere('logbook',array('id_fasilitas'=> $id,'id_jenisperangkat' => $value['id_jenisperangkat']))->num_rows();
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
        $fasilitas = $this->m_data->getWhere('fasilitas',array('id_fasilitas' =>$id ))->row_array();
        $fasilitas['status'] = (lb_st($fasilitas['status']));       
        $result['fasilitas']=  $fasilitas;
        echo json_encode($result);
    }

    function LoadPerangkat($id=null){
        $id = xcrypt($id,'d');
        if (!empty($id)) {
          
            $perangkat                      = $this->Mod->GetCustome("SELECT a.*,c.nama_fasilitas,d.nama as jenis_perangkat,e.nama as merk from perangkat a LEFT join fasilitas_detail b on b.id_perangkat = a.id_perangkat left join fasilitas c on c.id_fasilitas = b.id_fasilitas LEFT JOIN jenis_perangkat d on d.id_jenisperangkat= a.id_jenisperangkat LEFT JOIN merk e on e.id = a.merk_id where a.id_perangkat = '".$id."'")->row_array();
            $perangkat_detail               = $this->Mod->GetCustome("SELECT a.*,b.nama as property_name FROM perangkat_detail a left join master_perangkat_detail b on b.idmaster_detail_perangkat = a.idmaster_detail_perangkat WHERE id_perangkat ='".$perangkat['id_perangkat']."' ")->result_array();
            $perangkat['detail']            =  $perangkat_detail;
           
    
            $todayDate = date('Y-m-d');
            $logHistory = $this->Mod->GetCustome(" SELECT a.*,b.nama_masalah FROM logbook a left join jenis_masalah b 
                on b.id = a.id_jenismasalah
                where  id_perangkat ='".$id."'
                                            ")->result_array();
     
                                                 // WHERE 
                                                 // DATE(tj.date_start) = '$todayDate'
        
            // Menyimpan data log history ke dalam variabel $data
            $result['LogHistory'] = $logHistory;
           
            $downtime = $this->Mod->GetCustome("SELECT SUM(TIMESTAMPDIFF(MINUTE, create_date, end_date)) AS total_downTime FROM logbook WHERE id_perangkat = '".$id."' AND end_date >= NOW() - INTERVAL 1 MONTH AND create_date >= NOW() - INTERVAL 1 MONTH")->row_array();
            $uptime = $this->Mod->GetCustome("SELECT TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH)) AS uptime")->row_array();
             
            if(empty($downtime['total_downTime'])){
                $downtime['total_downTime'] = 0;
            }
    
             $totaldowntime = $downtime['total_downTime'];
             $totaluptime = $uptime['uptime'];
             $performa = ($totaluptime - $totaldowntime) / $totaluptime * 100;
    
             $performa_formatted = number_format(round($performa)); // Format nilai bulat ke 2 angka desimal dan tambahkan '%' di akhir
             $result['perfomChart'] = array('Performa' => round($performa)); // Bulatkan ke 2 angka desimal
             $result['perfomChart'] = array('Performa' => $performa_formatted); // Simpan nilai yang sudah diformat
    
            $result['perfomPie'] =array('Display OFF' => 30,'HDMI' => 10, 'Kamera Rusak' =>0, 'Listrik OFF' =>20, 'Jaringan Bermasalah' =>20);
    
            $jm = $this->Mod->GetCustome("SELECT a.*,c.id as id_jenismasalah,c.nama_masalah FROM perangkat a left join jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat left join jenis_masalah c on c.parent_id = b.id_jenisperangkat where a.id_perangkat = '".$id."'")->result_array();
            foreach ($jm as $key => $value) {
                $total = $this->Mod->GetCustome("SELECT COUNT(*)as total,id_jenismasalah,id_perangkat 
                FROM `logbook` where id_perangkat = '".$id."' and id_jenismasalah = '".$value['id_jenismasalah']."' group by id_jenismasalah,id_perangkat  ")->row_array();
                $result['ProgressData']['lebel'][$key]= $value['nama_masalah'];
                $result['ProgressData']['value'][$key]=(!empty($total['total']) ? $total['total']:'0');
                $result['ProgressData']['color'][$key]=colrand();

            }
            $perangkat['status']=  lb_pkt($perangkat['status']);
            $result['perangkat']=  $perangkat;
           
            // $result['id']       =$id = xcrypt($id,'e');
            echo json_encode($result);
        }else{

        }
       
     
    }


    // function GetlistData(){
    //     $data = $this->Mod->GetCustome("SELECT * FROM jenis_perangkat WHERE id_unit= 4 AND id_lokasi= 3  limit 5")->result_array();
    //      echo json_encode($data); 
    // }

   
    function DeleteDataJP(){
        echo json_encode($result);
    }

    public function GetlistDataJP()
    {
       $res=  $this->staticBasicAuthentication();
        
        $model = $this->Mod->GetCustome("SELECT * FROM jenis_perangkat WHERE id_unit= ".$res['id_unit']."  AND type_perangkat	=3")->result_array();
        
        // $response = [];
        // foreach ($model->result() as $hasil) {
        //     $response[] = $hasil;
        // }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            array(
                'success' => true,
                'message' => 'Get Operasi Pembebanan Mesin Pada Aplikasi ProNIA (durasi setiap 30 menit)',
                'data'    => $model,
                
            )
        );
    }

    function SaveDataJP(){
        $res=  $this->staticBasicAuthentication();
        $request = json_decode($this->input->raw_input_stream);

        $data=[
            'nama'              => $request->nama,
            'status'            => '1',
            'id_unit'           => $res['id_unit'],
            'type_perangkat'    => '3'
        ];

        if ($this->db->insert('jenis_perangkat',$data)) {
            header('Content-Type: application/json; charset=utf-8');
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Data Save jenis perangkat',
                        'data'    =>  $data
                    )
                );
        }else{
            header('HTTP/1.0 406 Not Acceptable');
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'List Jenis Perangkat',
                    'data'    => '',
                )
            );
        }
       
    }

    function EditDataJP(){
        $res        =  $this->staticBasicAuthentication();
        $request    = json_decode($this->input->raw_input_stream);
        $model      = $this->Mod->GetCustome("SELECT * FROM jenis_perangkat WHERE id_unit= ".$res['id_unit']."  AND id_jenisperangkat	='".$request->id."'")->result_array();
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            array(
                'success' => true,
                'message' => 'List Jenis Perangkat',
                'data'    => $model,
                
            )
        );
    }

     function UpdateDataJP($id){
         $res        =  $this->staticBasicAuthentication();
          $request = json_decode($this->input->raw_input_stream);
        $update=[
            'nama'      => $request->nama,
            'status'    => '1',
            'id_unit'   => $res['id_unit'],
            'type_perangkat'      => '3'
        ];
        $this->Mod->update2('jenis_perangkat',array('id_jenisperangkat' =>$id),$update);
        if ($this->Mod->update2('jenis_perangkat',array('id_jenisperangkat' =>$id),$update)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(
                array(
                    'success' => true,
                    'message' => 'List Jenis Perangkat',
                    'data'    => '',
                    
                )
            );
        }else{
            header('HTTP/1.0 406 Not Acceptable');
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'List Jenis Perangkat',
                    'data'    => '',
                    
                )
            );
        }
       
        
    }

}