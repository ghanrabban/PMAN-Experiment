<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Jenis_perangkat extends CI_Controller {

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
        $data["title_des"] = "List Jenis Perangkat ";
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
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
         //$data_res['masalah']    = $this->m_data->get_join_WhereCustom('jenis_masalah','jenis_perangkat','parent_id','id_jenisperangkat')->result_array();
         $data_res  = $this->Mod->GetCustome("SELECT * FROM jenis_perangkat WHERE id_unit in ('0','".sess()['unit']."')")->result_array();
 
        
         foreach ($data_res as $key => $value) {
            $data_res[$key ]['label_status']=  master_status($value['status']);   
         } 

        echo json_encode($data_res);
    }

    function LoadDataParent(){
      
      
         $data_res['perangkat'] =$this->m_data->getWhere('jenis_perangkat',array('status !=' =>8 ))->result_array();
         //$data_res['masalah']    = $this->Mod->getJoin('jenis_masalah','jenis_perangkat','status')->result_array();
         echo json_encode($data_res);
    }
   
    
    function EditData($id=null){
        if (!empty($id)) {
            $data = $this->m_data->getWhere('jenis_perangkat',array('id_jenisperangkat' =>$id ))->row_array();
            echo json_encode($data);
        }else{
            echo "kosong";
        }
    }

    public function Update($id=null)
    {
       
        $data=array_filter($_POST);

        if (!empty($data)) {
            // if (!array_key_exists('parent_id', $data)) {
            //    $data['parent_id'] ='-1';
            // }
            $res_update = $this->m_data->updateData('jenis_perangkat',array('id_jenisperangkat' =>$id ), $data);
           
            $res=[
                'code'      => '200',
                'msg'       => 'Data Berhasil di Update'
            ];
            echo json_encode($res);
        }else{
            $res=[
                'code'      => '400',
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
            
                $data['id_unit'] =sess()['unit'];
             
            $this->db->insert('jenis_perangkat',$data);
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

    function ListJenisPerangkat(){
        if (!empty($_POST['catagory'])) {
            $catagory =" AND c.id_catagory = '".$_POST['catagory']."'";
        }else{
            $catagory =" ";
        }

        if (!empty($_POST['area'])) {
            $area =" AND c.id_area = '".$_POST['area']."'";
        }else{
            $area =" ";
        }
        $data    =  $this->Mod->GetCustome("SELECT 
                                                a.id_jenisperangkat,b.nama 
                                            FROM 
                                                fasilitas_detail a 
                                            LEFT JOIN 
                                                 jenis_perangkat b 
                                            ON 
                                                b.id_jenisperangkat = a.id_jenisperangkat
                                            LEFT JOIN 
                                                fasilitas c 
                                            ON 
                                                c.id_fasilitas = a.id_fasilitas
                                            WHERE
                                                a.id_jenisperangkat is not null 
                                            AND 
                                                a.id_jenisperangkat !=0
                                            AND 
                                                a.id_jenisperangkat not in ('3','4')
                                            AND 
                                                b.id_unit='".sess()['unit']."'
                                            $catagory
                                            $area
                                            GROUP BY 
                                                a.id_jenisperangkat,b.nama")->result_array();
        echo json_encode($data);
    }

    
   
   
}