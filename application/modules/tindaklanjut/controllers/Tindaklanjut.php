<?php
// application/modules/req_open/controllers/Req_open.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindaklanjut extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->role();
    }

    private function role() {
        $url = urlencode(current_url());
       
        if (session("username") == "") {
             redirect(base_url('login/auth'));
        }
    }

    public function index() {
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Tindak Lanjut";
        $data["title_des"]  = "Corrective Maintenance untuk memastikan perfoma perangat tetap optimal";
        $data["content"]    = "v_index";
        $data["data"]       = $data;

        
        // $this->load->model('M_tinjut');

        // $data['lokasi_options'] = $this->M_tinjut->get_lokasi_options();
        // $data['fasilitas_options'] = $this->M_tinjut->get_fasilitas_options();
    
        $this->load->view('template_v2', $data);
    }

    function LoadData($from=null){
        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;

        if (!empty(sess()['id_lokasi'])) {
            $param = "AND b.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }

        if (isset($_POST['status']) &&  !empty($_POST['status'])) {
            $param .= "AND a.status='".$_POST['status']."' ";
        }else{
            if ($_POST['status'] == '0') {
                $param .= "AND a.status = '0' ";
            }else{
                $param .= "AND a.status NOT IN ('8') ";
            }
           
        }

         if (isset($_POST['tanggal'])&& !empty($_POST['tanggal'])) {
            $param .= "AND a.tanggal='".$_POST['tanggal']."' ";
        }
        $res   = $this->Mod->GetCustome("SELECT 
                    a.*,b.nama_fasilitas,c.nama_terminal
                    FROM 
                        tinjut a  
                    left join 
                        fasilitas b 
                    on 
                        b.id_fasilitas = a.id_fasilitas
                    left join 
                        terminal c 
                    on 
                        c.id = b.id_lokasi
                    WHERE 
                        a.id_unit='".sess()['unit']."' $param  ORDER BY a.status,a.tanggal ASC limit $start,$limit");
        $result=$res->result_array();
        foreach ($result as $key => $value) {
           //$data[$key ]['no_tiket']     =  TKTNum( $value['id_tiket']);
           $result[$key ]['label_status']   =  sts('3',$value['status']);
           $result[$key ]['start_time']     =  $value['start_time'];
           $result[$key ]['tanggal']        =  tgl($value['tanggal'],"s");
        } 

        

        $data['data']       = $result;
       
         $total_data         =   $this->Mod->GetCustome("SELECT 
                    a.*,b.nama_fasilitas,c.nama_terminal
                    FROM 
                        tinjut a  
                    left join 
                        fasilitas b 
                    on 
                        b.id_fasilitas = a.id_fasilitas
                    left join 
                        terminal c 
                    on 
                        c.id = b.id_lokasi
                    WHERE 
                        a.id_unit='".sess()['unit']."' $param  ORDER BY a.status,a.tanggal ASC")->num_rows();
        $total_page         = ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
        echo json_encode($data);
    }
    
    public function SaveData() {
        $error=[];
        $foto_before    = '';
        $foto_after     ='';
        $data=array_filter($_POST);
        unset($data['foto_after']);
        unset($data['Newitems']);
        unset($data['date_start']);
        unset($data['update_date']);
         if ($_FILES['foto_before']['error'] == 0) {
            $this->load->library('upload');
    
            $config['upload_path']   = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 100000;
    
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('foto_before')) {
                $data['foto_before'] = $this->upload->data('file_name');
            } else {
                $error=[
                     'msg'    => 'Sorry, File uploaded unsuccessfully'
                 ];
            }
        } else {
            $error=[
                'msg'    => 'Sorry, File Foto Before uploaded unsuccessfully'
            ];
        }

        if ($_FILES['foto_after']['error'] == 0) {
            $this->load->library('upload');
    
            $config['upload_path']   = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 100000;
    
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('foto_after')) {
                $data['foto_after'] = $this->upload->data('file_name');
               
            } else {
                $error=[
                     'msg'    => 'Sorry, File Foto After uploaded unsuccessfully'
                 ];
            }
        } else {
            $error=[
                'msg'    => 'Sorry, File uploaded unsuccessfully'
            ];
        }

        if ($_FILES['foto_proses']['error'] == 0) {
            $this->load->library('upload');
    
            $config['upload_path']   = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 100000;
    
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('foto_proses')) {
                $data['foto_proses'] = $this->upload->data('file_name');
               
            } else {
                $error=[
                     'msg'    => 'Sorry, File Foto After uploaded unsuccessfully'
                 ];
            }
        } else {
            $error=[
                'msg'    => 'Sorry, File uploaded unsuccessfully'
            ];
        }

        if (!empty($error)) {
            $response=[
                'code'      => '500',
                'msg'       =>  $error['msg']
            ];
        }else{
            if (!empty($_POST['Newitems'])) {
                // $this->db->insert('tiket',$data);
                // $idtiket = $this->db->insert_id();

                
                
                $data['tanggal']        = $_POST['tanggal'];
                $data['start_time']     = $_POST['start_time'];
                $data['end_time']       = $_POST['end_time'];
                $data['create_date']    = date('Y-m-d');
                $data['create_by']      = sess()['nama'];
                $data['create_byid']    = sess()['id'];
                $data['status']         = 0;
                $data['id_unit']        = sess()['unit'];
                $data['id_temuan']      = $_POST['id_temuan'];;
              

                $this->db->insert('tinjut',$data);
                $idtinjut = $this->db->insert_id();
				foreach ($_POST['Newitems'] as $key => $value) {
                    $jp= $this->Mod->getWhere('perangkat',array('id_perangkat' => $value['id_perangkat']))->row_array();
					$tinjut=[
                        'id_tinjut'                 => $idtinjut ,
                       
					    'id_perangkat'              => $value['id_perangkat'],
                        'id_jenismasalah'           => $value['id_jenismasalah'],
						'id_jenisperangkat'	        => $jp['id_jenisperangkat'], 
                        'description'	            => $value['description'], 
						'status' 			        => 1,
					];

                    if ( $this->db->insert('tinjut_detail',$tinjut)) {
                        $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
                    }else{
                        $response=[
                            'code'      => '500',
                            'msg'       =>  'Coba lagi beberapa waktu'
                        ];
                    }
				}	
				
			}else{
                $response=[
                    'code'          => '500',
                    'msg'           =>  'Tidak ada perangkat detail'
                ];
            }

           
        }
        echo json_encode($response);
       
    }

    function EditData($id=null){
        // tinjut_detail
        $data                       = $this->Mod->getWhere('tinjut',array('id_tinjut ' =>$id ))->row_array();
        $unit                       = $this->Mod->getWhere('unit',array('id_unit ' =>$data['id_unit'] ))->row_array();
        
         //echo "<pre>",print_r ($data),"</pre>";
        if(!empty($data['id_fasilitas'])){
            
            $data['status_label']= sts('3',$data['status']);
            $fasilitas                  = $this->Mod->getWhere('fasilitas',array('id_fasilitas ' =>$data['id_fasilitas']))->row_array();
            if(!empty($fasilitas)){
                 $catagory                   = $this->Mod->getWhere('fasilitas_catagory',array('id_catagory ' =>$fasilitas['id_catagory']))->row_array();
                $data['nama_fasilitas']     = (!empty($fasilitas) ? $fasilitas['nama_fasilitas']:'') ;
            }else{
                $data['nama_fasilitas'] ='';
            }
           

            
        }else{
            $fasilitas                  = array();
            $catagory                  =array();
            $data['nama_fasilitas']     = '';
        }
       
       
       
        $data['s_date']             = date("h:i",strtotime($data['start_time'])) ;
        $data['e_date']             = $data['end_time'] ;
       
        $data['nama_unit']          = $unit['kode_unit'] ;
        $detail                     = $this->Mod->GetCustome("SELECT a.*,b.nama_perangkat,b.serial_number,c.nama as jenis_perangkat,d.nama_masalah FROM tinjut_detail a LEFT JOIN perangkat b ON b.id_perangkat = a.id_perangkat LEFT JOIN jenis_perangkat c ON c.id_jenisperangkat = a.id_jenisperangkat LEFT JOIN jenis_masalah d ON d.id = a.id_jenismasalah where a.id_tinjut = '".$id."'")->result_array();
         if (!empty($detail)) {
            foreach ($detail as $key => $value) {
                $js = $this->Mod->getWhere('jenis_masalah',array('status !=' =>8, 'id' => $value['id_jenismasalah']))->row_array();
                if(!empty($js)){
                     $detail[$key]['js']=[
                    'id'    => $js['id'],
                    'text'  => $js['nama_masalah']];
                }
                
            }
        }
       
        if (!empty($data['id_temuan'])) {
            $temuan = $this->Mod->getWhere('temuan',array('id_temuan' =>$data['id_temuan'] ))->row_array();
       
            $data['temuan']=[ 
                'text'	=> (empty($fasilitas['nama_fasilitas']) ? '':$fasilitas['nama_fasilitas']),
                'id'	=> $temuan['id_temuan']];
            $data['fasilitas']=[ 
                'text'	=> (empty($catagory['nama']) ? '':$catagory['nama']),
                'id'	=> (empty($data['id_fasilitas']) ? '':$data['id_fasilitas']),];
        }else{
              $data['fasilitas']=[ 
                'text'	=> (empty($catagory['nama']) ? '':$catagory['nama']),
                'id'	=> (empty($data['id_fasilitas']) ? '':$data['id_fasilitas']),];
        }
        $data['detail'] = $detail ;
        echo json_encode($data);
    }

    function UpdateData($id=null){
        $data=array_filter($_POST);
        // echo "<pre>",print_r ($data),"</pre>";
        if (!empty($data)) {
            unset($data['Items']);
            unset($data['Newitems']);
            unset($data['removed_items']);
          
            $data['status'] = 0;
            $data['id_unit'] =sess()['unit'];
            if (!empty($_POST['Newitems'])) {
                foreach ($_POST['Newitems'] as $key => $value) {
                    $jp= $this->Mod->getWhere('perangkat',array('id_perangkat' => $value['id_perangkat']))->row_array();
                    
                    $tinjut=[
                        'id_tinjut'                 => $id ,
                        'id_perangkat'              => $value['id_perangkat'],
                        'id_jenismasalah'           => $value['id_jenismasalah'],
                        'id_jenisperangkat'	        => $jp['id_jenisperangkat'], 
                        'description'	            => $value['description'], 
                        'status' 			        => 1,
                    ];

                    if ( $this->db->insert('tinjut_detail',$tinjut)) {
                        $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
                    }else{
                        $response=[
                            'code'      => '500',
                            'msg'       =>  'Coba lagi beberapa waktu'
                        ];
                    }
                }	
            }
            if (!empty($_POST['Items'])) {
                foreach ($_POST['Items'] as $key => $value) {
                    $jp= $this->Mod->getWhere('perangkat',array('id_perangkat' => $value['id_perangkat']))->row_array();
                    $tinjut_update=[
                       
                        'id_perangkat'              => $value['id_perangkat'],
                        'id_jenismasalah'           => (!empty($value['id_jenismasalah']) ? $value['id_jenismasalah']:''),
                        'id_jenisperangkat'	        => $jp['id_jenisperangkat'], 
                        'description'	            => $value['description'], 
                        'status' 			        => 1,
                    ];
                    // 
                    // echo "<pre>",print_r ( $tinjut_update),"</pre>";
                    if ($this->Mod->update2('tinjut_detail',array('id_detail ' =>$value['idtinjut']),$tinjut_update)) {
                        $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
                    }else{
                        $response=[
                            'code'      => '500',
                            'msg'       =>  'Coba lagi beberapa waktu'
                        ];
                    }
                }	
            }

            if (!empty($_POST['removed_items'])) {
                foreach ($_POST['removed_items'] as $key => $value) {
                    $this->Mod->delete('tinjut_detail',array('id_detail'=>$value));
                }
            }	

            if ($_FILES['foto_before']['error'] == 0) {
                $this->load->library('upload');
        
                $config['upload_path']   = './upload/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 100000;
        
                $this->upload->initialize($config);
        
                if ($this->upload->do_upload('foto_before')) {
                    $data['foto_before'] = $this->upload->data('file_name');
                } else {
                    $error=[
                        'msg'    => 'Sorry, File uploaded unsuccessfully'
                    ];
                }
            } else {
                $error=[
                    'msg'    => 'Sorry, File Foto Before uploaded unsuccessfully'
                ];
            }
            if ($_FILES['foto_after']['error'] == 0) {
                $this->load->library('upload');
        
                $config['upload_path']   = './upload/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 100000;
        
                $this->upload->initialize($config);
        
                if ($this->upload->do_upload('foto_after')) {
                    $data['foto_after'] = $this->upload->data('file_name');
                
                } else {
                    $error[]=[
                        'msg'    => 'Sorry, File Foto After uploaded unsuccessfully  Proses Sebelum'
                    ];
                }
            } else {
                $error[]=[
                    'msg'    => 'Sorry, File uploaded unsuccessfully after'
                ];
            }

            if ($_FILES['foto_proses']['error'] == 0) {
                $this->load->library('upload');
        
                $config['upload_path']   = './upload/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 100000;
        
                $this->upload->initialize($config);
        
                if ($this->upload->do_upload('foto_proses')) {
                    $data['foto_proses'] = $this->upload->data('file_name');
                
                } else {
                    $error=[
                        'msg'    => 'Sorry, File Foto After uploaded unsuccessfully Proses Tinjut'
                    ];
                }
            } else {
                $error[]=[
                    'msg'    => 'Sorry, File uploaded unsuccessfully Proses'
                ];
            }
            //echo "<pre>",print_r ( $error),"</pre>";
            
            
            $update = $this->Mod->update2('tinjut',array('id_tinjut ' =>$id),$data);
            if ($update) {
                $response=[
                    'code'      => '200',
                    'msg'       =>  'Data Berhasi Disimpan'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'       =>  'Coba lagi beberapa waktu'
                ];
            }
            echo json_encode($response);
        }
    }

    function ProsesData($id=null){
        if (!empty($id)) {
            $cek   = $this->Mod->getWhere('tinjut',array('id_tinjut' =>$id))->row_array();
            if ($cek['foto_after']=='' ||$cek['start_time']==''||$cek['end_time']=='' ||empty($cek['id_fasilitas'])) {
                $response=[
                    'code'      => '500',
                    'msg'       => 'Data Tidak Lengkap seperti Fasilitaa tidak ada/Tidak ada Temuan/Foto After/ Waktu Mulai/Waktu Selesai'
                ];
            }else{
                $cek_detail   = $this->Mod->getWhere('tinjut_detail',array('id_tinjut' =>$id))->result_array();
                if (!empty($cek_detail )) {
                    $error_msg=array();
                    foreach ($cek_detail as $key => $value) {
                        if (empty($value['id_perangkat'])) {
                            $error_msg[]=[
                                'code'      => '500',
                                'msg'       => 'Data Tindak Lanjut tidak Lengkap'
                            ];
                        }
                    }
                    if (!empty($error_msg)) {
                        $response=[
                            'code'      => '500',
                            'msg'       => 'Gagal Proses Data,Detail Tindakan Tidak Lengkap'
                        ];
                    }else{
                        $data= [ 
                            'status' => '1'
                        ];
                        $result = $this->Mod->update2('tinjut', array('id_tinjut' => $id),$data);
                        
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
                    }
                }else{
                      $response=[
                        'code'      => '500',
                        'msg'       => 'Gagal Proses Data,Detail Tindakan Tidak ada'
                    ];
                }
                
               
            }
           
        }else{
            $response=[
                'code'      => '500',
                'msg'    =>  'Gagal Proses Data'
            ];
        }
       
        echo json_encode($response);
    }

    function DeleteData($id=null){
        if (!empty($id)) {
            $cek   = $this->Mod->getWhere('tinjut',array('id_tinjut' =>$id))->row_array();
            if($this->Mod->delete('tinjut',array('id_tinjut'=>$id))){
                $this->Mod->delete('tinjut_detail',array('id_tinjut'=>$id));
                $response=[
                    'code' => '200',
                    'msg'    =>  'Data Berhasil Di Dihapus'
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

    function GetDataTinjut($id=null){
        
        if (!empty(sess()['id_lokasi'])) {
            $param = "AND b.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }
        
        if(!empty($_POST['tanggal'])) {
            $p_tanggal = " AND a.tanggal ='".$_POST['tanggal']."' ";
            
        } else {
            $p_tanggal = ''; 
       
        }

        $data= $this->Mod->GetCustome("SELECT 
                    a.*,b.nama_fasilitas,c.nama_terminal
                    FROM 
                        tinjut a  
                    left join 
                        fasilitas b 
                    on 
                        b.id_fasilitas = a.id_fasilitas
                    left join 
                        terminal c 
                    on 
                        c.id = b.id_lokasi
                    WHERE 
                        a.id_unit='".sess()['unit']."' $param  $p_tanggal ")->result_array();
        if (!empty($id)) {
          
            foreach ($data as $key => $value) {
                $cek = $this->Mod->getWhere('tiket_cm_detail',array('id_tinjut' => $value['id_tinjut'], 'id_tiket' => $id))->num_rows();
               
                if ($cek != 0) {
                    // unset($data[$key]);
                    $data[$key]['checked'] = 1;
                }
                $fasilitas = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$value['id_fasilitas'] ))->row_array();
                    $data[$key]['fasilitas'] = $fasilitas['nama_fasilitas'];
                    // $data[$key]['id ada'] = '';
            }
        }else{
          
          
            foreach ($data as $key => $value) {
                $cek = $this->Mod->getWhere('tiket_cm_detail',array('id_tinjut' => $value['id_tinjut'],'status' => 1))->num_rows();
               
                if ($cek != 0) {
                    // unset($data[$key]);
                    $data[$key]['checked'] = 0;

                }else{
                    $fasilitas = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$value['id_fasilitas'] ))->row_array();
                    
                    $data[$key]['fasilitas'] = (!empty($fasilitas) ? $fasilitas['nama_fasilitas']: '');
                    
                }
              
            }
        }
        
         
        echo json_encode($data);
    }

    function SinTinjut(){
        $data = $this->Mod->getWhere('tinjut',array('status !=' => 8))->result_array();
        
        foreach ($data as $key => $value) {
            
            $td= $this->Mod->getWhere('tinjut_detail',
                                    array('status !=' => 8,
                                            'id_tinjut'=> $value['id_tinjut']))->result_array();
            foreach ($td as $key2 => $val) {
                $p = $this->Mod->getWhere('perangkat',array('nama_perangkat'=> $val['nama_perangkat']))->row_array();
                if (!empty($p)) {
              
                $update_d['id_perangkat']= $p['id_perangkat'];
                
                $result = $this->Mod->update2('tinjut_detail', array('id_detail' => $val['id_detail']),$update_d);

              
                # code...
                }
                
            }


            $fasilitas = $this->Mod->getWhere('fasilitas',array('nama_fasilitas' =>$value['nama_fasilitas'],'id_unit'=> $value['id_unit']))->row_array();
            if (!empty($fasilitas)) {
              
                $update['id_fasilitas']= $fasilitas['id_fasilitas'];
                echo "<pre>",print_r ( $update),"</pre>";
                $result = $this->Mod->update2('tinjut', array('id_tinjut' => $value['id_tinjut']),$update);

                
                # code...
            }
            
        }
      
    }
    
    public function New() {
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Tindak Lanjut";
        $data["title_des"]  = "Corrective Maintenance untuk memastikan perfoma perangat tetap optimal";
        $data["content"]    = "v_index2";
        $data["data"]       = $data;

        
        // $this->load->model('M_tinjut');

        // $data['lokasi_options'] = $this->M_tinjut->get_lokasi_options();
        // $data['fasilitas_options'] = $this->M_tinjut->get_fasilitas_options();
    
        $this->load->view('template_v2', $data);
    }
    
    public function tinjutv2() {
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Tindak Lanjut";
        $data["title_des"]  = "Corrective Maintenance untuk memastikan perfoma perangat tetap optimal";
        $data["content"]    = "v_index2";
        $data["data"]       = $data;

        
        // $this->load->model('M_tinjut');

        // $data['lokasi_options'] = $this->M_tinjut->get_lokasi_options();
        // $data['fasilitas_options'] = $this->M_tinjut->get_fasilitas_options();
    
        $this->load->view('template_v2', $data);
    }
}

