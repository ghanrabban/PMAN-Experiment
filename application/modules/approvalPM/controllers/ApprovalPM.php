<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class ApprovalPM extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
        $this->load->model("m_data");
    }

    public function index()
    {
      
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List Approval Tiket";
        $data["title_des"] = "";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }


    public function LoadTiket($input=null){
       
         $data = $this->Mod->GetCustome("SELECT * FROM tiket_cm  WHERE status != '0' and id_unit ='".sess()['unit']."' ORDER BY  create_date DESC")->result_array();
       
         foreach ($data as $key => $value) {
            $data[$key ]['label_status']=  st($value['status']);     
         } 
        
         echo json_encode($data);
    }
   

    public function ProsesReject($id=null)
    {
        $data=[
            'status'        => 0,
        ];
        $this->m_data->updateData('tiket',array('id_tiket'=>$id ),$data);
    }
    public function ProsesApprove($id=null)
    {
        $cek_user = $this->Mod->GetCustome('SELECT a.* FROM user a left join role b on b.id= a.type_user where a.id ="'.sess()['id'].'"')->row_array();
       
        
        if ($cek_user['type'] == '1') {
            $data=[
                'status'            => 9,
                'update_by'         => sess()['id'],
                'update_date'       => date('Y-m-d')
            ];
            $result =  $this->Mod->update2('tiket_cm',array('id_tiket '=>$id ),$data);
            if ($result) {
                $save_log_ttd =[
                'id_user'       => sess()['id'],
                'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                'rel_id'        =>  $id,
                'rel_type'      => 'tiket_cm',
                'create_date'   => date('Y-m-d H:i:s')

                ];
            // echo "<pre>",print_r ( $save_log_ttd),"</pre>";
                $this->db->insert( 'log_ttd',$save_log_ttd);
                 $response=[
                    'code'      => '200',
                    'msg'       =>  'Data Berhasil Di Proses'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    => 'Gagal Proses Data Silahkan coba beberapa saat lagi'
                ];
            }
            // $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
           
        }else{
            $response=[
                'code'      => '500',
                'msg'    => 'Gagal Proses Data/Anda Tidak Memiliki Akses'
            ];
        }
        $list_tinjut = $this->Mod->GetCustome('SELECT a.* FROM tiket_cm_detail a left join tiket_cm b on b.id_tiket= a.id_tiket where a.id_tiket ="'.$id.'"')->result_array();
        foreach ($list_tinjut as $key => $value) {
            $update_tinjut =[
                'status'            => 9,
               
            ];
            $this->Mod->update2('tinjut', array('id_tinjut' => $value['id_tinjut']),$update_tinjut);

        }
        echo json_encode($response);
    }

    public function EditData($id) {
        $data = $this->Mod->GetCustome('SELECT a.*, b.nama_fasilitas, c.kode_unit, d_lokasi.nama_terminal AS nama_lokasi, e_sublokasi.nama_terminal AS nama_sublokasi 
            FROM tiket a
            LEFT JOIN fasilitas b ON a.id_fasilitas = b.id_fasilitas
            LEFT JOIN unit c ON a.id_unit = c.id_unit 
            LEFT JOIN terminal d_lokasi ON a.id_lokasi = d_lokasi.id
            LEFT JOIN terminal e_sublokasi ON a.id_sublokasi = e_sublokasi.id
            WHERE (a.id_tiket = "'.$id.'")')->row_array();
            
        echo json_encode($data);
    }


   
}