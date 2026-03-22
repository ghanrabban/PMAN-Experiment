<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Job_pm extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->model("m_data");
    }

    public function index()
    {
      
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List PM";
        $data["title_des"] = " List Pekerjaan Preventive Maintenance";
        $data["content"] = "v_index";
        if (!empty(sess()['id_lokasi'])) {
            // $param = " AND id_lokasi= ".sess()['id_lokasi'];
            $param =''; 
        }else{
            $param ='';
            
        }
       
        $data['jenis']= $this->Mod->GetCustome("SELECT * FROM jenis_perangkat where id_unit= '".sess()['unit']."' AND status != 8 $param")->result_array();
       
        // $this->m_data->getWhere('jenis_perangkat',array('id_unit' =>,'status !='=>8,$param  ))->result_array();
        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }

    
    function LoadData(){
     
         $data= $this->m_data->getWhere('pm_type',array('status' =>1 ))->result_array();
         foreach ($data as $key => $value) {
            // $this->m_data->getWhere('job_pm',array('id_pmtype ' =>$value['idpm_type'],'status' => 1,'id_unit' => sess()['unit']))->num_rows();
            $data[$key]['detail']=  $this->Mod->GetCustome("   SELECT 
                                                                b.nama,COUNT(a.id_jenisperangkat) as jumlah
                                                                FROM job_pm a 
                        LEFT JOIN jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat
                        WHERE a.id_pmtype ='".$value['idpm_type']."' AND a.status = 1 AND a.id_unit = '".sess()['unit']."'
                        GROUP by b.nama")->result_array();

         }
       
        echo json_encode($data);
    }

    function LoadDataDetail($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data= $this->Mod->getWhere('job_pm',array('id_pmtype ' =>$id,'status' => 1,'id_unit'=> sess()['unit']))->result_array();
       foreach ($data as $key => $value) {
        $jenis=$this->Mod->getWhere('jenis_perangkat',array('id_jenisperangkat ' =>$value['id_jenisperangkat'],'id_unit'=> sess()['unit']))->row_array();
        $data[$key]['jenis'] = (empty($jenis)? "":$jenis['nama']);
       }
       
        echo json_encode($data);
    }

    function LoadDataEdit($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data= $this->m_data->getWhere('job_pm',array('id_jobpm' =>$id,'status' => 1,'id_unit' => sess()['unit']))->row_array();
       
       
        echo json_encode($data);
    }

   
    
    public function SaveDetail($id=null)
    {
        $data=[
            'id_pmtype'         => $id,
            'nama'              => $this->input->post('job_name'),
            'id_jenisperangkat' => $this->input->post('id_jenisperangkat'),
            'id_unit'           => sess()['unit'],
            'status'            => 1,
        ];
     
         if( $this->db->insert('job_pm',$data)){
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
    function UpdateDetail($id=null){
        $data=[
            'nama'              => $this->input->post('job_name'),
            'id_jenisperangkat' => $this->input->post('id_jenisperangkat'),
            'id_unit'           => sess()['unit'],
            'status'            => 1,
        ];
        if($this->Mod->update2('job_pm',array('id_jobpm '=>$id ),$data)){
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

    public function DeleteDetail($id=null)
    {
        $data=[
            'STATUS'                    => 8
        ];
         if($this->Mod->update2('job_pm',array('id_jobpm '=>$id ),$data)){
             $response=[
                    'code'      => '200',
                    'msg'       =>  'Data Berhasi Dihapus'
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