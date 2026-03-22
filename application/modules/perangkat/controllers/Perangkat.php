<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;

class Perangkat extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->library('Ciqrcode');
        $this->load->library('pdfgenerator');
        $this->role();
    }
    private function role() {
        $url = urlencode(current_url());
        if (session("username") == "") {
            redirect(base_url('login/auth'));
        }
    }

    // private function position() {
    //     $data["position"] = "perangkat";
    //     return $data;
    // }

    public function QRCodeRender($id=null,$url=null){

        $name=rand();
        $tempdir = "doc/QRCode/"; //Nama folder tempat menyimpan file qrcode
        if (!file_exists($tempdir)) //Buat folder bername temp
            mkdir($tempdir);
        
            //ambil logo
            $logopath="assets_v2/images/ap2.png";
             
             //isi qrcode jika di scan
             $codeContents = base_url('informasi/'.$url.'/').$id;
            
             
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
    public function index()
    {
      
        //$data = $this->position();
        // $data = access($data,"VIEW");
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Perangkat ".sess()['unit_kode'];
        $data["title_des"] = " List Data Perangkat ".sess()['unit_name'];
        $data["content"] = "v_index";
       
        $data["data"] = $data;
        $this->load->view('template_v2', $data);

        // echo "<pre>",print_r (sess()),"</pre>";
        //  echo "<pre>",print_r ( $data),"</pre>";
    }

    
    function LoadData($from=null){
        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
    
        if(isset($_POST['src'])) {
            $src = $_POST['src'];
            $param_src = "(nama_perangkat LIKE '%". $src."%' OR serial_number LIKE '%".$src."%') ";
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ''; 
             $param_src ='';
        }
        $param=[
            'parameter'     => array('status !=' => 8, 'id_perangkat >=' => 0,'id_unit' => sess()['unit']) 
        ];
      
        if (sess()['id_lokasi'] !== null ) {
          
            $param['parameter']+=array('id_lokasi'=> sess()['id_lokasi']);
            //array_push( ,);
        }

        if (!empty($_POST['jenis_perangkat'])) {
             $param['parameter']+=array('id_jenisperangkat'=> $_POST['jenis_perangkat']);
            $filter =" AND id_jenisperangkat ='".$_POST['jenis_perangkat']."'";
        }else {
            $filter="";
        }


        if(isset($_POST['jenis_perangkat'])) {
            
           
            $jenis  = $_POST['jenis_perangkat'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
           
        }

        $start              = ($from>1) ? ($from * $limit) - $limit : 0;
        $from               = $this->uri->segment(3);
      
        


        $res   = $this->Mod->GetCustome("SELECT * FROM 
         perangkat a 
        WHERE a.status != 8 
        AND a.id_perangkat >=0 
        AND a.id_unit = ".sess()['unit']." $filter
        AND $param_src  ORDER BY a.status ASC limit $start,$limit");

         $result=$res->result_array();

        
       
        $totalData         =  $this->Mod->getWhere('perangkat',$param['parameter'])->num_rows();

        // $totalData          = $res->num_rows();
        
        $total_page         = ceil($totalData/$limit);
        // $param['total_data'] = $totalData;
        // $param['total_page'] = ceil($totalData/$limit);
        // $res                = pagin($param);
        foreach ($result as $key => $value) {
            $jenis      = $this->Mod->getWhere('jenis_perangkat ',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'status !=' => 8 ))->row_array();
            $fasilitas  = $this->Mod->getWhere('fasilitas_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'id_perangkat' =>$value['id_perangkat']  ))->row_array();
            $merk      = $this->Mod->getWhere('merk ',array('id' =>$value['merk_id'] ))->row_array();
			$model      = $this->Mod->getWhere('model',array('id_perangkat' =>$value['id_model'] ))->row_array();
			(empty($model) ?  $result[$key]['model']='': $model['nama_perangkat']);
            // $result[$key]['model'] = $model['nama_perangkat'];
            (empty($merk) ?  $result[$key]['merk']='': $merk['nama']);
            // $result[$key]['merk'] = $merk['nama'];
            (empty($jenis) ?  $result[$key]['jenis_perangkat']='': $jenis['nama']);
// 			$result[$key]['jenis_perangkat'] = $jenis['nama'];
            $result[$key]['stat'] = sts('2',$value['status']);
            if (!empty($fasilitas)) {
                $result[$key]['id_fasilitas'] = $fasilitas['id_fasilitas'];
            }else{
                $result[$key]['id_fasilitas'] ='';
            }
        }
        $data['url']        = $this->uri->segment(2);
        // $data['perangkat']  = $res['data'];

        $data['perangkat']  = $result;
        $data['pag']    = BTNPag($from,$total_page,$totalData,$limit);
        $data['totaldata']  = $totalData;
        // $data['sess']  = sess();
        // $data['pag']        = $res['pag'];

        
        echo json_encode($data);
    }

    function LoadDataDetail($id=null){
        
        $data_res['detail'] = $this->Mod->GetCustome('SELECT a.*,b.nama as property FROM perangkat_detail a left JOIN master_perangkat_detail b on b.idmaster_detail_perangkat = a.idmaster_detail_perangkat Where  a.id_perangkat = \''.$id.'\'')->result_array();
        echo json_encode($data_res);
    }

    function LoadDataByid($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
        $data_res['perangkat'] = $this->Mod->GetCustome("
        SELECT 
            p.id_perangkat,
            p.nama_perangkat,
            u.kode_unit,
            f.ip_address,
            p.serial_number,
            f.status,
            l.create_date,
            m.nama AS merk_nama
        FROM 
            perangkat p
        LEFT JOIN 
            unit u ON p.id_unit = u.id_unit 
        LEFT JOIN 
            fasilitas f ON f.id_fasilitas = p.nama_perangkat 
        LEFT JOIN 
            logbook l ON l.id_perangkat = p.id_perangkat
        LEFT JOIN
            merk m ON m.id = p.merk_id
        WHERE
            p.id_perangkat = $id ")->result_array();
        // $data_res['detail'] = $this->Mod->getWhere('perangkat_detail',array('id_perangkat' =>$id ))->result_array();
        echo json_encode($data_res);
    }

    function ViewDetail($id = null){
        if (!empty($id)) {
         $perangkat  = $this->Mod->getWhere('perangkat ',array('status !=' => 8,'id_perangkat' => $id ))->row_array();
         $merk      = $this->Mod->getWhere('merk ',array('id' =>$perangkat['merk_id'] ))->row_array();
		 $model      = $this->Mod->getWhere('model ',array('id_perangkat' =>$perangkat['id_model'] ))->row_array();
		 $jenis     = $this->Mod->getWhere('jenis_perangkat ',array('id_jenisperangkat' =>$perangkat['id_jenisperangkat'] ))->row_array();
         $perangkat['jenis'] = $jenis['nama'];
         
         (!empty($model) ? $perangkat['model'] = $model['nama_perangkat'] : '');
         (!empty($merk) ? $perangkat['merk']  = $merk['nama'] : '');

            $detail = $this->Mod->getWhere('perangkat_detail ',array('id_perangkat' =>$perangkat['id_perangkat'] ))->result_array();
        
            if (!empty($detail)) {
                    foreach ($detail as $key => $value2) {
                        $property = $this->Mod->getWhere('master_perangkat_detail ',array('idmaster_detail_perangkat' =>$value2['idmaster_detail_perangkat'] ))->row_array();
                        
                        // $detail[$key][$property['nama']] = $value2['nama'];
                        $perangkat['detail'][$key]['property']   = $property['nama'];
                        $perangkat['detail'][$key]['value']      = $value2['nama'];
                       
                    }
                    // $perangkat['detail'] = $detail;
                 
            }else{
                $perangkat['detail']=array();
            }
            
            $lv1            = "doc";
            if (!file_exists($lv1)){
                mkdir($lv1);
            }
            $lv2 = $lv1."/QRCode2";
            if (!file_exists($lv2)){
                mkdir($lv2);                
            }    


            if (empty($perangkat['QRCODE']) ) {
                //echo "<pre>",print_r ($perangkat),"</pre>";
                $qr  =  $this->QRCodeRender($perangkat['id_perangkat'],'perangkat');
                $update = ['QRCODE' =>$qr ];
                $this->Mod->update2('perangkat',array('id_perangkat' =>$id),$update);
                $perangkat['QRCODE'] = $qr;
            }else{
                $filename='doc/QRCode/'.$perangkat['QRCODE'];
                if (!file_exists($filename)) {
                    $qr             =  $this->QRCodeRender($perangkat['id_perangkat'],'perangkat');
                    $update         = ['QRCODE' =>$qr ];
                    $this->Mod->update2('perangkat',array('id_perangkat' =>$id),$update);
                    $perangkat['QRCODE'] = $qr;
                }
            }
            
        }
        echo json_encode($perangkat);
    }

    function EditData($id = null){
        if (!empty($id)) {
         $perangkat  = $this->Mod->getWhere('perangkat ',array('status !=' => 8,'id_perangkat' => $id ))->row_array();
         $merk      = $this->Mod->getWhere('merk ',array('id' =>$perangkat['merk_id'] ))->row_array();
         (!empty($merk) ? $perangkat['merk'] = $merk['nama'] : '');
            $detail = $this->Mod->getWhere('perangkat_detail ',array('id_perangkat' =>$perangkat['id_perangkat'] ))->result_array();
                
            if (!empty($detail)) {
                    foreach ($detail as $key => $value2) {
                        $property = $this->Mod->getWhere('master_perangkat_detail ',array('idmaster_detail_perangkat' =>$value2['idmaster_detail_perangkat'] ))->row_array();
                        
                        // $detail[$key][$property['nama']] = $value2['nama'];
                        $perangkat['detail'][$key]['id_perangkat_detail'] = $value2['id_perangkat_detail'];
                        $perangkat['detail'][$key]['idmaster_detail_perangkat'] = $value2['idmaster_detail_perangkat'];
                        $perangkat['detail'][$key]['property']   = (empty($property)? '':$property['nama'] );
                        $perangkat['detail'][$key]['value']      = $value2['nama'];
                       
                    }
                    // $perangkat['detail'] = $detail;
                 
            }else{
                $perangkat['detail']=array();
            }
            // echo "<pre>",print_r ($perangkat),"</pre>";
               
            
        }
        echo json_encode($perangkat);
    }
   


    function LoadDataAnl($id=null){
        $perangkat                      =  $this->Mod->GetCustome("SELECT a.*,c.nama_fasilitas,d.nama as jenis_perangkat,e.nama as merk from perangkat a LEFT join fasilitas_detail b on b.id_perangkat = a.id_perangkat left join fasilitas c on c.id_fasilitas = b.id_fasilitas LEFT JOIN jenis_perangkat d on d.id_jenisperangkat= a.id_jenisperangkat LEFT JOIN merk e on e.id = a.merk_id where a.id_perangkat = '".$id."'")->row_array();
        $perangkat_detail               = $this->Mod->GetCustome("SELECT a.*,b.nama as property_name FROM perangkat_detail a left join master_perangkat_detail b on b.idmaster_detail_perangkat = a.idmaster_detail_perangkat WHERE id_perangkat ='".$perangkat['id_perangkat']."' ")->result_array();
        $perangkat['detail']            =  $perangkat_detail;
       

        $todayDate = date('Y-m-d');
        $logHistory = $this->Mod->GetCustome(" SELECT a.*,b.nama_masalah FROM logbook a left join jenis_masalah b 
            on b.id = a.id_jenismasalah
            where  id_perangkat ='".$id."'
                                        ")->result_array();
 
       
        $result['LogHistory'] = $logHistory;
        /*
        Query untuk mengambil selisih waktu antara waktu mulaidan selesai pekerjaan dalam menit
        */  
        $downtime = $this->Mod->GetCustome("SELECT SUM(TIMESTAMPDIFF(MINUTE, start_time, end_time)) AS total_downTime FROM logbook WHERE id_perangkat = '".$id."' AND end_time >= NOW() - INTERVAL 1 MONTH AND create_date >= NOW() - INTERVAL 1 MONTH")->row_array();
        $uptime = $this->Mod->GetCustome("SELECT TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH)) AS uptime")->row_array();
         
        // if(empty($downtime['total_downTime'])){
        //     $downtime['total_downTime'] = 0;
        // }

        //  $totaldowntime = $downtime['total_downTime'];
        //  $totaluptime   = $uptime['uptime'];
        //  $performa      = ($totaluptime - $totaldowntime) / $totaluptime * 100;

         //warna untuk bar perfome
        $performa = $this->Mod->GetCustome("SELECT ((( DATE_FORMAT(LAST_DAY(NOW()), '%d') * 24*60 ) -  SUM(TIMESTAMPDIFF(MINUTE, start_time, end_time)))/( DATE_FORMAT(LAST_DAY(NOW()), '%d') * 24*60 )* 100)as perfome FROM logbook where MONTH(start_time) = MONTH(NOW()) AND id_perangkat = '".$id."'")->row_array()['perfome'];
        if (empty($performa)) {
            $performa =100;
        }
        $performa_formatted = 80;//number_format(round($performa)); // Format nilai bulat ke 2 angka desimal dan tambahkan '%' di akhir
        
       
        if ($performa_formatted <= 35) {
            $warna = '#f20505';
         }elseif ($performa_formatted <= 75) {
            $warna = '#f27b05';
         }else{
            $warna = '#3380ff';
         }

        // echo $performa_formatted; 
       // $result['perfomChart'] = array('Performa' => round($performa)); // Bulatkan ke 2 angka desimal
        $result['perfomChart'] = array('Performa' => $performa_formatted,'color' =>$warna); // Simpan nilai yang sudah diformat

        $result['perfomPie'] =array('Display OFF' => 30,'HDMI' => 10, 'Kamera Rusak' =>0, 'Listrik OFF' =>20, 'Jaringan Bermasalah' =>20);

            $jm = $this->Mod->GetCustome("SELECT a.*,c.id as id_jenismasalah,c.nama_masalah FROM perangkat a left join jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat left join jenis_masalah c on c.parent_id = b.id_jenisperangkat where a.id_perangkat = '".$id."'")->result_array();
            foreach ($jm as $key => $value) {
                $total = $this->Mod->GetCustome("SELECT COUNT(*)as total,id_jenismasalah,id_perangkat 
                FROM `logbook` where id_perangkat = '".$id."' and id_jenismasalah = '".$value['id_jenismasalah']."' group by id_jenismasalah,id_perangkat  ")->row_array();
                // $result['ProgressData']['lebel'][$key]= $value['nama_masalah'];
                // $result['ProgressData']['value'][$key]=(!empty($total['total']) ? $total['total']:'0');
                // $result['ProgressData']['color'][$key]=colrand();
                if ($total != 0) {
                    $result['ProgressData']['lebel'][]= $value['nama_masalah'];
                    $result['ProgressData']['value'][]=(!empty($total['total']) ? $total['total']:'0');
                    $result['ProgressData']['color'][]=colrand();
                }else{
                    $result['ProgressData']['lebel'][] =$value['nama_masalah'];
                    $result['ProgressData']['value'][]=(!empty($total['total']) ? $total['total']:'0');
                    $result['ProgressData']['color'][]=colrand();
                }
            }
       
        $result['perangkat']=  $perangkat;
        echo json_encode($result);
        //echo json_encode($get_jumlah);
    }

    function Loadmasterdetail($id){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
      
        $data = $this->Mod->getWhere('master_perangkat_detail',array('id_jenisperangkat' =>$id,'status !=' => 8 ))->result_array();
        echo json_encode($data);
    }

   
    function SaveData(){
        
        $data=array_filter($_POST);
        // echo "<pre>", print_r($data), "</pre>";
        if (!empty($data)) {
            unset($data['master']);
            $data['status'] = 0;
            $data['id_unit'] =sess()['unit'];
            $this->db->insert('perangkat',$data);
            $idperangkat = $this->db->insert_id();
            if (!empty($_POST['master'])) {
				
				foreach ($_POST['master'] as $key => $value) {
                 
					$detail=[
						'idmaster_detail_perangkat'     => $value['idmaster_detail_perangkat'],
						'id_perangkat' 		            => $idperangkat,
						'nama'	                        => $value['nilai'], 
						'status' 			            => 1,
					];
                    $this->db->insert('perangkat_detail',$detail);
				}	
				
			}
			 $response=[
                'code'      => '200',
                'msg'       => 'Save Data Succes'
            ];
           
        }else{
             $response=[
                'code'      => '500',
                'msg'       => 'Failed Save Data'
            ];
        }
        echo json_encode($response);
    }

    function UpdateData($id=null){
        $data=array_filter($_POST);
        if (!empty($data)) {
            unset($data['master']);
            unset($data['edit']);
           // $data['status'] = 0;
            $data['id_unit'] =sess()['unit'];
            if (!empty($_POST['master'])) {
                $id_delete=array();
				foreach ($_POST['master'] as $key => $value) {
					$detail=[
						'idmaster_detail_perangkat'     => $value['idmaster_detail_perangkat'],
                        'id_perangkat' 		            => $id,
						'nama'	                        => $value['nilai'], 
						'status' 			            => 1,
					];
                    $cek_detail = $this->Mod->getWhere('perangkat_detail',array('idmaster_detail_perangkat' =>$value['idmaster_detail_perangkat'],'id_perangkat' => $id ))->row_array();
                    if (!empty($cek_detail)) {
                     
                        $update = $this->Mod->update2('perangkat_detail',array('id_perangkat_detail' => $cek_detail['id_perangkat_detail']),$detail);
                    }else{
                        $id_delete[]=$value['idmaster_detail_perangkat'];
                        // 
                        $this->db->insert('perangkat_detail',$detail);
                        
                    }
                    
				}	
                if (!empty($id_delete)) {
                    
                    $result = $this->Mod->deletein('perangkat_detail', array('id_perangkat' => $id), 'idmaster_detail_perangkat',$id_delete);
                }
               
               
			}
            if (!empty($_POST['edit'])) {
				foreach ($_POST['edit'] as $key => $value) {
                  
					$detail=[
						'idmaster_detail_perangkat'     => $value['idmaster_detail_perangkat'],
						'nama'	                        => $value['nilai'], 
						'status' 			            => 1,
					];
                    $update = $this->Mod->update2('perangkat_detail',array('id_perangkat_detail' =>$value['id_perangkat_detail']),$detail);
				}	
			}

            

           
            $update = $this->Mod->update2('perangkat',array('id_perangkat' =>$id),$data);
            $response=[
                'code'      => '200',
                'msg'       => 'Update Data Succes'
            ];
        }else{
            $response=[
                'code'      => '400',
                'msg'       => 'Failed Update Data'
            ];
        }
        echo json_encode($response);
    }

  
    function DeleteData($id=null){
        if (!empty($id)) {
           
           $result = $this->Mod->delete('perangkat',array('id_perangkat'=>$id));
           
            if ($result) {
                // $this->Mod->delete('fasilitas_detail',array('id_perangkat'=>$id));
                $response=[
                    'code' => '200',
                    'msg'    =>  'Data Berhasil Di Hapus'
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

    function performPerangkat($id=null){
        if (!empty($id)) {
            $data["plugin"][] = "plugin/datatable";
            $data["plugin"][] = "plugin/select2";
            $data["title"] = "Performansi Perangkat";
            $data["title_des"] = " Spesifikasi & Performansi Perangkat";
            $data["content"] = "v_performa";
            // $limit = 10;
            // $from = $this->uri->segment(3);
           
            // $data['pagin'] = pagin('perangkat','id_perangkat',array('status !=' => 8),$this->uri->segment(1),$limit,$from);
            $data["data"] = $data;
            $data["id"]     = $id;
    
            $this->load->view('template_v2', $data);
        }
    }

    function Validate(){
        $perangkat = $this->Mod->getWhere('perangkat',array('status !=' =>8,'type' =>1  ))->result_array();   
        foreach ($perangkat as $key => $value) {
            $detail = $this->Mod->getWhere('perangkat_detail',array('id_perangkat' =>$value['id_perangkat'] ))->row_array();   
            $detail_perangkat=array();
            if (empty($detail)) {
                $mp= $this->Mod->getWhere('master_perangkat_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'] ))->result_array();   
                foreach ($mp as $key2 => $val2) {
                    $detail_perangkat[]=[
                        'id_perangkat'                  => $value['id_perangkat'] ,
                        'idmaster_detail_perangkat'     => $val2['idmaster_detail_perangkat'],
                        'status'                        => 0,
                    ];
                }
            }
            if (!empty($detail_perangkat)) {
               // $this->db->insert_batch('perangkat_detail', $detail_perangkat);
                echo "<pre>", print_r($value['nama_perangkat']), "</pre>";
                echo "<pre>", print_r($detail_perangkat), "</pre>";
            }
          
           
        }    
        
    }


    function LoadDataPerangkatByID($id=null){
        $data=array();
        if (!empty($id)) {
            $fd = $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas_detail  where status  != '8' AND id_jenisperangkat NOT IN ('3','4') AND id_fasilitas = $id ")->result_array();    
		$this->Mod->getWhere('fasilitas_detail',array('status !=' =>8,'id_fasilitas' =>$id  ))->result_array();   
            // echo "<pre>", print_r($fd), "</pre>";
            foreach ($fd as $key => $value) {
                $data['perangkat'][]=$this->Mod->getWhere('perangkat',array('status !=' =>8,'id_perangkat' =>$value['id_perangkat']  ))->row_array();  
            }
            foreach ($data['perangkat'] as $key => $value) {
                $data['perangkat'][$key]['nama_perangkat'] =$value['nama_perangkat'].(!empty($value['serial_number']) ? "-".$value['serial_number'] : '');
                
            }
        }
        echo json_encode($data);
    }

    function ListPerangkatFasilitas($id=null){
        $data=array();
        if (!empty($id)) {
            $fd = $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas_detail  where status  != '8'  AND id_fasilitas = $id AND id_perangkat !=0 ")->result_array();    
  
            // echo "<pre>", print_r($fd), "</pre>";
            foreach ($fd as $key => $value) {
                $data['perangkat'][]=$this->Mod->getWhere('perangkat',array('status !=' =>8,'id_perangkat' =>$value['id_perangkat']  ))->row_array();  
            }
            // if(!empty($data['perangkat'])){
            //     foreach ($data['perangkat'] as $key => $value) {
            //         $data['perangkat'][$key]['nama_perangkat'] =$value['nama_perangkat'].(!empty($value['serial_number']) ? "-".$value['serial_number'] : '');
                    
            //     }
                    
            // }
        }
        echo json_encode($data);
    }

    function Sysdata(){

      
        $perangkat =  $this->Mod->getWhere('perangkat',array('status !=' =>8,'id_unit' => sess()['unit']))->result_array();  
        foreach ($perangkat as $key => $value) {
            if (!empty($value['id_model'])) {
                $model= $this->Mod->getWhere('model',array('status !=' => 8,'id_perangkat' => $value['id_model']))->row_array();
                $detail_model = $this->Mod->getWhere('master_perangkat_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'] ))->result_array();
                foreach ($detail_model as $key_m => $value_m) {
                    $spek =[
                        'id_perangkat'              =>$value['id_perangkat'],
                        'idmaster_detail_perangkat' => $value2['idmaster_detail_perangkat'],
                        'status'                    => '1',
                       ];
                       $cek_m = $this->Mod->getWhere('perangkat_detail',array('id_perangkat' =>$value['id_perangkat'],'idmaster_detail_perangkat' => $value_m['idmaster_detail_perangkat'] ))->num_rows();
                       if ( $cek_m  == 0 ) {
                            $this->db->insert('model_spec',$spek);
                            // echo "<pre>",print_r ($spek),"</pre>";
                       }
                }
            }else{
                $detail = $this->Mod->getWhere('perangkat_detail',array('id_perangkat' =>$value['id_perangkat'] ))->num_rows();  
                if ($detail == 0) {

                    $property = $this->Mod->getWhere('master_perangkat_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'] ))->result_array();      
                    foreach ($property as $key2 => $value2) {
                        $insert_detail =[
                            'id_perangkat'              => $value['id_perangkat'],
                            'idmaster_detail_perangkat' => $value2['idmaster_detail_perangkat'],
                            'nama'                      => '',
                            'status'                    => '0' ,
                        ];
                    $this->db->insert('perangkat_detail',$insert_detail);
                        // echo "<pre>", print_r($insert_detail), "</pre>";
                    }
                
                    
                }else{
                    echo "da".$value['id_perangkat'];
                }
            }
            // echo "<pre>", print_r($detail), "</pre>";
        }
      
    }
    function LoadPerangkat($from=null){

        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
    
        if(isset($_POST['src'])) {
            $src = $_POST['src'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ''; 
        }
        
        if(isset($_POST['jenis_perangkat'])) {
            $jenis = $_POST['jenis_perangkat'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
        }
        $from               = $this->uri->segment(3);
      
        $param=[
            'table'         => 'perangkat' ,
            'pk'            => 'id_perangkat' ,
            'parameter'     => array('status !=' => 8, 'id_perangkat >=' => 0,'id_unit' => sess()['unit']) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'filter'        => (!empty($jenis) ? array('id_jenisperangkat'=> $jenis):'') ,
            
            'src'           => $src,
            'param_src'     => [
                                'like' => 'nama_perangkat',
                                'or_like'=> 'serial_number']
        ];
      
        
        $data['url']        = $this->uri->segment(2);
        $totalData          = CountDataPag($param);
  
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);
        $param['jenis']         = 'PrintQrCode';
        $res                    = pagin($param);
        foreach ($res['data'] as $key => $value) {
            $jenis      = $this->Mod->getWhere('jenis_perangkat ',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'status !=' => 8 ))->row_array();
            $fasilitas  = $this->Mod->getWhere('fasilitas_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'id_perangkat' =>$value['id_perangkat']  ))->row_array();
            $merk      = $this->Mod->getWhere('merk ',array('id' =>$value['merk_id'] ))->row_array();
			$model      = $this->Mod->getWhere('model ',array('id_perangkat' =>$value['id_model'] ))->row_array();
            $res['data'][$key]['model'] = (!empty($model) ? $model['nama_perangkat']:'');
            $res['data'][$key]['merk'] = (!empty($merk) ? $merk['nama']:'');
			$res['data'][$key]['jenis_perangkat'] =(!empty($jenis) ? $jenis['nama']:'');
            $res['data'][$key]['stat'] = sts('2',$value['status']);
            if (!empty($fasilitas)) {
                $res['data'][$key]['id_fasilitas'] =(!empty($fasilitas) ?  $fasilitas['id_fasilitas']:'');
            }else{
                $res['data'][$key]['id_fasilitas'] ='';
            }
            
            
            
        }
        $data['perangkat']  = $res['data'];
        $data['pag']        = $res['pag'];

        
        echo json_encode($data);
        // $data =$this->Mod->getWhere('perangkat',array('status !=' =>8,'id_unit' =>sess()['unit'] ))->result_array();  
        // echo json_encode($data);
    }
    function PrintListQr(){
        $data=array();
        if (!empty($_POST)) {
            foreach ($_POST['newdata'] as $key => $value) {
               
                $perangkat= $this->Mod->getWhere('perangkat',array('id_perangkat' =>$value['id_perangkat'] ))->row_array();
                if (!empty($perangkat['QRCODE'])) {
                    $data['data'][]=[
                        'id_perangkat'      => $value['id_perangkat'],
                        'Qrcode' 		    => (!empty($perangkat['QRCODE']) ?'doc/QRCode/'.$perangkat['QRCODE']:''),
                        'sn'                => $perangkat['serial_number']
                    ];   
                }else{

                    $qr  =  $this->QRCodeRender($perangkat['id_perangkat'],'perangkat');
                    $update = ['QRCODE' =>$qr ];
                    $this->Mod->update2('perangkat',array('id_perangkat' =>$value['id_perangkat'] ),$update);
                  
                    $data['data'][]=[
                        'id_perangkat'      => $value['id_perangkat'],
                        'Qrcode' 		    =>'doc/QRCode/'.$qr,
                        'sn'                => $perangkat['serial_number']
                    ];  
                }
               
                // echo "<pre>",print_r ($perangkat),"</pre>";
                
            }	
            // 
        }
        if (!empty($data)) {
            $data['totaldata'] = count($data['data']);
       
        // echo "<pre>",print_r ($data),"</pre>";

      
            $html   = $this->load->view('v_QR',$data, true);
            $result  =  $this->pdfgenerator->generate($html, 'PrintQRCode','A4','portrait',FALSE);
           
            $response=[
                'code'      => '200',
                'msg'       => 'Print File Succes',
                'file'      =>  $result 
            ];
          
        }else{
            $response=[
                'code'      => '400',
                'msg'       => 'No Data Selected',
                'file'      => ''
            ];
           
        }
        //  $this->load->view('v_QR',$data);
        echo json_encode($response);
        // echo "<pre>",print_r ($data),"</pre>";
    }


    function UploadData(){
        if(isset($_FILES["filelampiran"]["name"])){
            $this->load->library('EXCEL');
            $data                   = array();
            $error_msg              = array();
            // $path = $_FILES["filelampiran"]["tmp_name"];
			// $objPHPExcel = PHPExcel_IOFactory::load($path);
			// foreach($objPHPExcel->getWorksheetIterator(1) as $worksheet => $value){
			//     $highestRow = $value->getHighestRow();
              
            //     $lastColumn = $value->getHighestDataColumn(); 
            //     $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
         
            //        if ($worksheet == 0) {
            //         for($col=1 ; $col<=$highestColumnIndex; $col++){
            //               for ($row=2; $row <=$highestRow ; $row++) { 
            //                     $nama       = $value->getCellByColumnAndRow(0, $row)->getValue();
            //                     $merek      = $value->getCellByColumnAndRow(1, $row)->getValue();
            //                     $model      = $value->getCellByColumnAndRow(2, $row)->getValue();
            //                     $sn         = $value->getCellByColumnAndRow(3, $row)->getValue();
                               
            //                     $data[]=[
            //                         'nama_perangkat'    => $nama ,
            //                         'merek'             => $merek  ,
            //                         'model'             => $model,
            //                         'sn'                => $sn
            //                     ];
                                
            //                     if (empty($nama)) {
            //                         $error_msg[]=[
            //                           'sheet' => 0,
            //                             'row' => $row,
            //                             'col' => $col,   
            //                             'message' => 'data null'       
            //                         ];
            //                     }elseif (empty($merek)) {
            //                         $error_msg[]=[
            //                             'sheet' => 0,
            //                             'row' => $row,
            //                             'col' => $col,      
            //                             'message' => 'data null'       
            //                           ];
            //                     }elseif (empty($model)) {
            //                         $error_msg[]=[
            //                             'sheet' => 0,
            //                             'row' => $row,
            //                             'col' => $col,   
            //                             'message' => 'data null'        
            //                           ];
            //                     }elseif (empty($sn)) {
            //                         $error_msg[]=[
            //                             'sheet' => 0,
            //                             'row' => $row,
            //                             'col' =>$col,    
            //                               'message' => 'data null'    
            //                           ];
            //                     }else{
            //                         $cek_merek =$this->Mod->getLike('merk',array('nama' =>$merek));  
            //                         if ($cek_merek->num_rows() == 0 ) {
            //                         //   echo "Kosong merek";
            //                         }else{
            //                            $res_merk=  $cek_merek->row_array();
                                       
            //                             $cek_model =$this->Mod->getLike('model',array('nama_perangkat' =>$model,'merk_id'  =>  $res_merk['id']));  
                                   
            //                             if ($cek_model->num_rows() == 0 ) {
            //                                 // echo "Kosong model";
            //                             }else{
            //                             //   echo "<pre>", print_r( $data), "</pre>";
            //                             }
            //                         }
            //                     }
                               
                                
                               
            //                 //    echo "<pre>", print_r( $insert), "</pre>";
                                
            //                 // echo "<pre>", print_r( $data), "</pre>";
                              
            //               }
            //             }
                        
            //        }
             
           
            // }

            // if ($error_msg) {
            //     foreach ($error_msg as $error) {
            //         $sheet = $error["sheet"];
            //         $column = $error["col"];
            //         $row = $error["row"];
            //         $message = $error["message"];
            //         echo "<pre>", print_r( $sheet), "</pre>";
            //         echo "<pre>", print_r( $column), "</pre>";
            //         echo "<pre>", print_r( $row), "</pre>";
            //         echo "<pre>", print_r( $message), "</pre>";
            //         // unset($data[$error["row"]]);
                  
            //         // $objPHPExcel->setActiveSheetIndex($sheet);
            //         // $objPHPExcel->getActiveSheet()->getStyle("$column$row")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            //         // $objPHPExcel->getActiveSheet()->getStyle("$column$row")->getFill()->getStartColor()->setARGB("ffffcece");
            //         // $objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FFFF0000');
            //         // $objPHPExcel->getActiveSheet()->getComment("$column$row")->setAuthor('Timur Sahadewa');
            //         // $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun($message);
            //         // $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
            //         // $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                   
            //        echo "add comment di ".$column.$row; // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            //         // $namafile = "Error Loader Template " . date("Y-m-d H.i.s") . ".xlsx";
            //         // $path = "./temp/$namafile";
            //         // $objWriter->save($path);
            //     }
            // }else{
            //     echo "ok";
            // }
            
            // echo "<pre>", print_r( $data), "</pre>";
            // echo "<pre>", print_r( $error_msg), "</pre>";


            $demo_error = array();
            $data = array();
            $file = $_FILES["filelampiran"]["tmp_name"];
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheet = $objPHPExcel->getSheet(1); 
            $highestRow = $sheet->getHighestRow();
            $highestColumn = 'D';
            $objPHPExcel->setActiveSheetIndex(1);
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                if ($row == 1) {
                    $header[] = $column;
                }
            }

            $fieldRow = $sheet->rangeToArray('A1:' . $highestColumn . '2', NULL, TRUE, TRUE);
            foreach ($fieldRow[0] as $value) {
                if ($value == "" || $value == null) {
                    continue;
                }

                $field[] = $value;
            }

            
            for ($row = 2; $row <= $highestRow; $row++) {
                $dataRow = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE); //select 
                if ($dataRow[0][0] == NULL) {
                    continue;
                };
                $key = array();
                if (!isset($field)) {
                    echo "Error: fields are required.";
                    die();
                }
                foreach ($field as $idx => $clm) {
                    $key['header'][$clm] = $dataRow[0][$idx];
                }
                $data[$row] = $key;
            }
// echo "<pre>", print_r( $data), "</pre>";
            foreach ($data as $key_data => $val_data) {
                // echo "<pre>", print_r( $val_data['header']), "</pre>";

                foreach ($val_data['header'] as $key2 => $val) {
                   
                    if (empty($val)) {
                        $demo_error[] = [
                            'sheet' => 1,
                            'row' => $key_data,
                            
                            'col' => (array_search($key2, $field) != '' ? $header[array_search($key2, $field)] : ''),
                            'message' => $key2. ' kosong',
                           ];

                         
                    }
                }
               
                $cek_merek =$this->Mod->getLike('merk',array('nama' =>$val_data['header']['Merk']));  
                if ($cek_merek->num_rows() == 0 ) {
                    $demo_error[] = [
                        'sheet' => 1,
                        'row' => $key_data,
                        
                        'col' => (array_search('Merk', $field) != '' ? $header[array_search('Merk', $field)] : ''),
                        'message' => 'Merk Tidak Terdaftar',
                       ];
                    // echo "<pre>", print_r($val_data['header']), "</pre>";
                }else{
                    $res_merk=  $cek_merek->row_array();               
                    $cek_model =$this->Mod->getLike('model',array('nama_perangkat' =>$val_data['header']['Model'],'merk_id'  =>  $res_merk['id']));  
                    if ($cek_model->num_rows() == 0 ) {
                        $demo_error[] = [
                            'sheet' => 1,
                            'row' => $key_data,
                            
                            'col' => (array_search('Model', $field) != '' ? $header[array_search('Model', $field)] : ''),
                            'message' => 'Model Tidak Terdaftar',
                           ];                      
                    }else{
                                                //   echo "<pre>", print_r( $data), "</pre>";
                    }
                }
                // $data[]=[
                //         'nama_perangkat'    => $nama ,
                //         'merek'             => $merek  ,
                //         'model'             => $model,
                //         'sn'                => $sn
                // ];
            }
          
            
            // echo "<pre>", print_r($demo_error), "</pre>";
            if ($demo_error) {
                foreach ($demo_error as $error) {
                    $sheet = $error["sheet"];
                    $column = $error["col"];
                    $row = $error["row"];
                    $message = $error["message"];
                    unset($data[$error["row"]]);
                  
                    $objPHPExcel->setActiveSheetIndex($sheet);
                    $objPHPExcel->getActiveSheet()->getStyle("$column$row")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getActiveSheet()->getStyle("$column$row")->getFill()->getStartColor()->setARGB("ffffcece");
                    $objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FFFF0000');
                    $objPHPExcel->getActiveSheet()->getComment("$column$row")->setAuthor('Timur Sahadewa');
                    $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun($message);
                    $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                    $objPHPExcel->getActiveSheet()->getComment("$column$row")->getText()->createTextRun("\r\n");
                }
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $namafile = "Error Loader Perangkat " . date("Y-m-d H.i.s") . ".xlsx";
                $path = "./temp/$namafile";

                $respon_data = array(
                    "STATUS"        => 500,
                    "PATH"          => $path,
                    "FILENAME"      => $namafile,
                    "TYPE"          => "error_loader_template",
                );
                $objWriter->save($path);

                echo json_encode($respon_data);

            }
            // echo "<pre>", print_r( $header), "</pre>";

            // echo "<pre>", print_r($data), "</pre>";

        }

    
 
    }
  
    
    function summary(){
        $filter ='';
        if (!empty($jenis)) {
            $filter .= " AND a.id_jenisperangkat = '$jenis'";
        }else{
            $filter .="";
        }

        if (!empty(sess()['id_lokasi'])) {
            $filter .= " AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $filter .="";
        }
        if (!empty($sub_lokasi)) {
            $filter .= " AND a.id_sublokasi = '$sub_lokasi'";
        }else{
            $filter .="";
        }

        $data['sum']    = $this->Mod->GetCustome("SELECT count(a.id_lokasi),b.nama_terminal
                                                    FROM 
                                                        perangkat a  
                                                    LEFT JOIN  
                                                        terminal b  
                                                    on b.id = a.id_lokasi
                                                    where a.id_unit =  ".sess()['unit']."
                                                    $filter
                                                    GROUP by a.id_lokasi,b.nama_terminal
                                                    ")->result_array();
        
        // $data['sum']    = $this->Mod->GetCustome("SELECT a.id,a.nama_terminal, COUNT(b.id_lokasi) as total FROM terminal a left join fasilitas b on b.id_lokasi = a.id where a.parent_id = '-1' and b.id_unit='".sess()['unit']."' group by a.id,a.nama_terminal")->result_array();
        $data['all']    = $this->Mod->GetCustome("SELECT count(a.id_lokasi),b.nama_terminal
                                                    FROM 
                                                        perangkat a  
                                                    LEFT JOIN  
                                                        terminal b  
                                                    on b.id = a.id_lokasi
                                                    where a.id_unit =  ".sess()['unit']."
                                                    GROUP by a.id_lokasi,b.nama_terminal")->row_array(); 
        echo json_encode($data);
    }


    function DetailSummary($id_lokasi){
        $filter ="";
        if (!empty($lokasi)) {
            $filter .= " AND a.id_lokasi = '$id_lokasi'";
        }else{
            $filter .="";
        }
        $data['sum']    = $this->Mod->GetCustome("SELECT COUNT(c.idfasilitas_detail) as total,a.id_lokasi,
    e.nama_terminal 
from 
	fasilitas_detail c 
left join 
	fasilitas a 
on 
	a.id_fasilitas = c.id_fasilitas
left join 
	perangkat b 
on 
	b.id_perangkat = c.id_perangkat
left join 
terminal e
on e.id = a.id_lokasi
where a.id_unit =  3
and c.id_jenisperangkat = 19
$filter
GROUP by a.id_lokasi,e.nama_terminal
    ")->result_array();       
  echo json_encode($data); 
}

     function CekPerangkat(){
        $data=  $this->Mod->GetCustome("SELECT a.*,c.id_perangkat from 
                fasilitas_detail c 
            left join 
                fasilitas a 
            on 
                a.id_fasilitas = c.id_fasilitas
            left join 
                perangkat b 
            on 
                b.id_perangkat = c.id_perangkat
            where a.id_unit = 4 and a.id_lokasi = 46 and b.id_lokasi is null ")->result_array(); 
        foreach ($data as $key => $value) {
            $update=[
                'id_lokasi' => $value['id_lokasi']
            ];
              $this->Mod->update2('perangkat',array('id_perangkat' =>$value['id_perangkat']),$update);
        }
                 echo "<pre>", print_r($data), "</pre>";

    }

    function LoadJenis(){

    }

    function GetPerangkat(){
        
        if (!empty(sess()['unit'])) {
            $param= " AND id_unit ='".sess()['unit']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT * from perangkat  where  nama_perangkat like '%$serc%' OR serial_number like '%$serc%'  $param limit 20")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT * from perangkat where status !=8 $param limit 10")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama_perangkat']."( ".$value['serial_number']." )",
				'id'	=> $value['id_perangkat']
			];
		}
		echo json_encode($data);
   
    }
    function TesPrint(){
         
        $data=[];
        $this->load->view('v_QR2');
        //   $html   = $this->load->view('v_QR2',$data, true);
        //   $this->pdfgenerator->generate($html, 'PrintQRCode','A4','portrait');
    }
    function teslog(){
        $data =  $this->Mod->GetCustome("SELECT a.*,b.tanggal_penggunaan from perangkat a left join fasilitas_detail b  on b.id_perangkat  = a.id_perangkat  
        
        where NOT EXISTS (
  SELECT 1
  FROM log_perangkat c
  WHERE c.id_perangkat = a.id_perangkat
) and b.tanggal_penggunaan is not null ")->result_array();    
		foreach ($data as $key => $value) {
		    $log=  $this->Mod->GetCustome("SELECT *  from log_perangkat where id_perangkat ='".$value['id_perangkat']."' and akhir is null")->result_array();    
		    $data_log=[
		        'id_perangkat' => $value['id_perangkat'],
		        'mulai'         => $value['tanggal_penggunaan'],
		        'status'        => 1
		        ];
		    if(!empty($log)){
		        echo "ada";
		         echo "<pre>",print_r ( $log),"</pre>"; 
		    }else{
		         $this->db->insert('log_perangkat',$data_log);
		      //   echo "<pre>",print_r ( $data_log),"</pre>";
		    }
		   
		}
// 			echo json_encode($data);
    }
}