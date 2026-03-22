<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Jenis_masalah extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
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
        $data["title"] = "Jenis Masalah";
        $data["title_des"] = "List Jenis-Jenis Masalah";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        $menu = fetch_menu();
        // foreach ($menu as $key => $value) {
        //     if (count($value['sub']) > 0 ) {
        //        echo "ada turunan";
        //     }else{
        //         echo "tidak";
        //     }

        // }
        // echo "<pre>",print_r ($menu ),"</pre>";
    }

    
    function LoadData(){
       


        $data_res  = $this->Mod->GetCustome("SELECT a.*, b.nama,  b.id_unit as unit FROM jenis_masalah a LEFT JOIN jenis_perangkat b ON a.parent_id = b.id_jenisperangkat WHERE a.status != 8 and b.id_unit in ('0','".sess()['unit']."') order by b.id_jenisperangkat ASC")->result_array();
         foreach ($data_res as $key => $value) {
            $update_unit =[
                'id_unit'   => $value['unit']
            ];

            $this->m_data->updateData('jenis_masalah',array('id' =>$value['id'] ), $update_unit);
            $data_res[$key ]['label_status']=  master_status($value['status']); 
         } 
         $data['data'] = $data_res;
        echo json_encode($data);
    }

    function LoadDataParent(){
      
      
         $data_res['perangkat'] = $data_res  = $this->Mod->GetCustome("SELECT * FROM jenis_perangkat  WHERE status != 8 and id_unit in ('0','".sess()['unit']."')")->result_array();
         
         //$data_res['masalah']    = $this->Mod->getJoin('jenis_masalah','jenis_perangkat','status')->result_array();
         echo json_encode($data_res);
    }
   
    
    function EditData($id=null){
        if (!empty($id)) {
            $data = $this->m_data->getWhere('jenis_masalah',array('id' =>$id ))->row_array();
            echo json_encode($data);
        }else{
            echo "kosong";
        }
    }

    public function Update($id=null)
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
            
        $data=array_filter($_POST);

        if (!empty($data)) {
            // if (!array_key_exists('parent_id', $data)) {
            //    $data['parent_id'] ='-1';
            // }
            $res_update = $this->m_data->updateData('jenis_masalah',array('id' =>$id ), $data);
            if ($res_update) {
                $res=[
                    'status' => '200',
                    'msg'       => 'Data Berhasil di Update'
                ];
            }else{
                $res=[
                    'status'    => '400',
                    'msg'       => 'Data Gagal Disimpan, pastikan semua terisi'
                ];
            }
            echo json_encode($res);
        }else{
            $res=[
                'status'    => '400',
                'msg'       => 'Data Gagal Disimpan, pastikan semua terisi'
            ];
            echo json_encode($res);
        }
        
    }

    public function SaveData()
    {

        $data=array_filter($_POST);
        //$data['parent_id'] = $data['id_jenisperangkat'];
        if (!empty($data)) {
            if (!array_key_exists('parent_id', $data)) {
                $data['parent_id'] ='-1';
             }
            $this->db->insert('jenis_masalah',$data);
            $res=[
                'status' => '200',
                'msg'       => 'Data Berhasil di Update'
            ];

            // echo "<pre>",print_r ( $data),"</pre>";
            echo json_encode($res);
        }else{
            $res=[
                'status'    => '400',
                'msg'       => 'Data Gagal Disimpan, pastikan semua terisi'
            ];
            echo json_encode($res);
        }
        
       
        
    }

    public function Delete($id=null){
        //$this->m_data->delete('jenis_masalah', array('id' =>$id ));
        $data = [
            'status'        => 8,
        ];
        $res_update = $this->m_data->updateData('jenis_masalah',array('id' =>$id ), $data);
    }

    function LoadDataJM(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         $data= $this->Mod->getData('jenis_masalah')->result_array();
       
        echo json_encode($data);
    }

    function LoadDataByid($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       if (!empty($id)) {
            $data = $this->Mod->getWhere('jenis_masalah',array('status !=' =>8, 'parent_id' => $id))->result_array();
       }else{
        $data=array();
       }
      
        echo json_encode($data);
    }

   
    function Getjenis(){
        if (!empty(sess()['id_lokasi'])) {
            $param= " AND a.id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT  a.id_temuan,b.nama_fasilitas
            FROM temuan a LEFT JOIN fasilitas b on b.id_fasilitas = a.id_fasilitas  where a.id_unit = '".sess()['unit']."' $param AND a.status = '1' AND NOT EXISTS (SELECT * FROM tinjut d WHERE d.id_temuan = a.id_temuan AND status = '1') AND b.nama_fasilitas like '%$serc%' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT  *
            FROM fasilitas  where nama_fasilitas like '$serc' ")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama_fasilitas'],
				'id'	=> $value['id_temuan']
			];
		}
		echo json_encode($data);
    }
    function GetjenisMasalah(){
        if (!empty(sess()['id_lokasi'])) {
            $param= " AND a.id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param="";
        }
        $serc   = $this->input->post('serc');
        $id_jp = $this->input->post('jenis');
        if (!empty($serc)) {
			$query = $this->Mod->GetCustome("SELECT * FROM jenis_masalah  WHERE  id_unit ='".sess()['unit']."' AND parent_id= '$id_jp' AND nama_masalah like '%$serc%' ")->result_array();   
        }else{
            $query = $this->Mod->GetCustome("SELECT * FROM jenis_masalah  WHERE  id_unit ='".sess()['unit']."' AND parent_id= '$id_jp' limit 5 ")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama_masalah'],
				'id'	=> $value['id']
			];
		}
		echo json_encode($data);
    }
   
    public function SaveDataJenis()
    {

        $data=array_filter($_POST);
        //$data['parent_id'] = $data['id_jenisperangkat'];
        if (!empty($data)) {
            if (!array_key_exists('parent_id', $data)) {
                $data['parent_id'] ='-1';
            }
           
            $insert=[
                'parent_id'     =>  $data['parent_id'],
                'nama_masalah'  =>  $data['nama_masalah'],
                'id_unit'       => sess()['unit'],
                'status'        => 1
            ];

            // echo "<pre>",print_r (sess()['unit']),"</pre>";
            if($this->db->insert('jenis_masalah',$insert)){
                $id = $this->db->insert_id();
                $res=[
                    'status'    => '200',
                    'msg'       => 'Data Berhasil di Tambah',
                    'id'        =>  $id 
                ];
            }
            
           

            // echo "<pre>",print_r ( $data),"</pre>";
            echo json_encode($res);
        }else{
            $res=[
                'status'    => '400',
                'msg'       => 'Data Gagal Disimpan, pastikan semua terisi',
                'id'        =>''
            ];
            echo json_encode($res);
        }
        
       
        
    }
    public function InsertJenisMasalah()
    {
        $nama = $this->input->post('nama_masalah', true);
    
        // Cegah duplikasi
        $cek = $this->db->get_where('jenis_masalah', ['nama_masalah' => $nama])->row();
    
        if ($cek) {
            echo json_encode([
                'id' => $cek->id,
                'text' => $cek->nama_masalah
            ]);
            return;
        }
    
        $this->db->insert('jenis_masalah', [
            'nama_masalah' => $nama
        ]);
    
        echo json_encode([
            'id' => $this->db->insert_id(),
            'text' => $nama
        ]);
    }
}