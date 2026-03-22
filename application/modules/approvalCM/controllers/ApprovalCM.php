<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class ApprovalCM extends CI_Controller {

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

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }


    public function LoadTiket($input=null){
       
         $data = $this->Mod->GetCustome("SELECT * FROM tiket_cm  WHERE status != '0' and id_unit ='".sess()['unit']."' ORDER BY  create_date DESC")->result_array();
       
         foreach ($data as $key => $value) {
           
            $data[$key ]['jumlah'] = $this->Mod->getWhere("tiket_cm_detail",array('id_tiket'=> $value['id_tiket']))->num_rows();
       
            $data[$key ]['label_status']=  st($value['status']);     
            
            $data[$key]['tanggal_label'] = tgl($value['tanggal'],'s');
            $data[$key]['shift_label'] =  l_sh($value['shift'])['name'];
         } 
        
         echo json_encode($data);
    }
   

    public function ProsesReject($id=null)
    {
        $data=[
            'status'        => 0,
        ];
        $this->Mod->updateData('tiket',array('id_tiket'=>$id ),$data);
    }
    
    
    public function ProsesApprove($id=null)
    {
         $cek_user =  $this->Mod->GetCustome("SELECT a.* FROM user a LEFT JOIN role b on b.id= a.type_user where a.id = '".sess()['id']."' and b.type = '1'")->row_array();
         if(empty($cek_user)){
              $response=[
                'code'      => '500',
                'msg'    => 'Anda Tidak Memiliki Akses'
            ];
         }else{
             $imagedata = base64_decode($_POST['img_data']);
            $filename = md5(date("dmYhisA"));
            //Location to where you want to created sign image
            $file_name = 'doc/Sig/'.$filename.'.jpg';
            file_put_contents($file_name,$imagedata);
            
            $dataUpdate=[
                'status'            => 9,
                'update_by'         => sess()['id'],
                'update_date'       => date('Y-m-d')
            ];
            $result =  $this->Mod->update2('tiket_cm',array('id_tiket '=>$id ),$dataUpdate);
           
          
        
        if ($result) {
           
            $save_log_ttd =[
                'id_user'       => sess()['id'],
                'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                'file_name'     =>  $file_name,
                'rel_id'        =>  $id,
                'rel_type'      => 'approvalCM',
                'create_date'   => date('Y-m-d H:i:s')

            ];
            // echo "<pre>",print_r ( $save_log_ttd),"</pre>";
             $this->db->insert( 'log_ttd',$save_log_ttd);
            $response=[
                'code'   => '200',
                'msg'    =>  'Data Berhasil Di Proses'
            ];
        }else{
            $response=[
                'code'      => '500',
                'msg'    => 'Gagal Proses Data'
            ];
        }
        $list_tinjut = $this->Mod->GetCustome('SELECT a.* FROM tiket_cm_detail a left join tiket_cm b on b.id_tiket= a.id_tiket where a.id_tiket ="'.$id.'"')->result_array();
        foreach ($list_tinjut as $key => $value) {
            $update_tinjut =[
                'status'            => 9,
               
            ];
            $this->Mod->update2('tinjut', array('id_tinjut' => $value['id_tinjut']),$update_tinjut);

        }
         }
        //   echo "<pre>",print_r ( $cek_user),"</pre>";
        // 
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


 function ViewData($id=null){
        if (!empty($id)) {
            $header =  $this->Mod->getWhere('tiket_cm',array('id_tiket ' =>$id))->row_array();
            $header['pelaksana'] = explode(",", $header['pelaksana']);
            $header['tanggal'] =  tgl($header['tanggal'],'l');
            $header['shift_l'] =l_sh($header['shift']);
            $header['sig_organik'] =  $this->Mod->GetCustome("SELECT *
              FROM log_ttd where rel_id ='".$id."' AND rel_type='approvalCM' and file_name0 is not null")->row_array();
           $header['sig_om'] =  $this->Mod->GetCustome("SELECT *
              FROM log_ttd where rel_id ='".$id."' AND rel_type='tiket_cm' and file_name is not null")->row_array();  
            $header['detail'] = $this->Mod->GetCustome("SELECT 
                a.*,b.nama_fasilitas,c.nama_terminal,f.nama_masalah,e.description as penyelesaian,CONCAT(TIME_FORMAT(a.start_time, '%H:%i'),' - ',TIME_FORMAT(a.end_time, '%H:%i')) as waktu
            FROM 
                tinjut a  
             LEFT JOIN 
                fasilitas b 
            ON 
                b.id_fasilitas = a.id_fasilitas
             LEFT JOIN 
                terminal c 
            ON 
                c.id = b.id_lokasi
            LEFT JOIN 
                tiket_cm_detail d
            ON 
                d.id_tinjut = a.id_tinjut
            LEFT JOIN
                tinjut_detail e
            ON 
                e.id_tinjut = d.id_tinjut
            LEFT JOIN 
                jenis_masalah f
            ON
                f.id = e.id_jenismasalah
            WHERE d.id_tiket = '".$id."'" )->result_array();
            
            foreach ($header['detail'] as $key => $value) {
                if(empty($value['nama_terminal'])){
                   $header['detail'][$key]['nama_terminal']= '';
                }
            }
            $data=[
                'code'      => '200',
                'msg'       => 'Load Data Succes',
                'data'      => $header
            ];
        }else{
            $data=[
                'code'      => '404',
                'msg'       =>  'No Data Parameter',
                'data'      =>[]
            ];
        }
        echo json_encode($data);
    }

   
}