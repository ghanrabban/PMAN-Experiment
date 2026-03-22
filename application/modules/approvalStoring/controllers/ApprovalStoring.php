<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class ApprovalStoring extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
     
    }

    public function index()
    {
      
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List Approval Tiket";
        $data["title_des"] = "";
        $data["content"] = "v_index";
        $data["data"] = $data;
        $data["modul"] = $this->uri->segment(1) ;
        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }


    public function LoadData($input=null){
       
         $data = $this->Mod->GetCustome("SELECT * FROM storing_wo  WHERE status != '0' and id_unit ='".sess()['unit']."' ORDER BY  create_date DESC")->result_array();
       
         foreach ($data as $key => $value) {
            $data[$key]['tanggal'] = tgl($value['tanggal'],'s');
            $data[$key ]['jumlah'] = $this->Mod->getWhere("storing_wodetail",array('id_storingwo'=> $value['id_storingwo']))->num_rows();
       
            $data[$key ]['label_status']=  st($value['status']);     
         } 
        
         echo json_encode($data);
    }
   

    public function ProsesReject($id=null)
    {
        $data=[
            'status'        => 0,
        ];
        $this->Mod->updateData('storing_wo',array('id_storingwo'=>$id ),$data);
    }
    public function ProsesApprove($id=null)
    {
        $data=[
            'status'            => 9,
            'update_by'         => sess()['id'],
            'update_date'       => date('Y-m-d')
        ];
        $result =  $this->Mod->update2('storing_wo',array('id_storingwo '=>$id ),$data);
        if ($result) {
            $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
          
            $save_log_ttd =[
                'id_user'       => sess()['id'],
                'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                'rel_id'        =>  $id,
                'rel_type'      => 'storing_wo',
                'create_date'   => date('Y-m-d H:i:s')

            ];
            // echo "<pre>",print_r ( $save_log_ttd),"</pre>";
             $this->db->insert( 'log_ttd',$save_log_ttd);
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
        $list_tinjut = $this->Mod->GetCustome('SELECT a.* FROM storing_wodetail a left join storing_wo b on b.id_storingwo= a.id_storingwo where a.id_storingwo ="'.$id.'"')->result_array();
        foreach ($list_tinjut as $key => $value) {
            $update_tinjut =[
                'status'            => 9,
               
            ];
            $this->Mod->update2('storing', array('id_storing' => $value['id_storing']),$update_tinjut);

        }
        echo json_encode($response);
    }

  
}