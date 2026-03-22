<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class job_pm extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->model("m_data");
    }

    public function index()
    {
      
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List PM";
        $data["title_des"] = " List Pekerjaan Preventive Maintenance";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }

    
    function LoadData(){
     
         $data= $this->m_data->getWhere('pm_type',array('status' =>1 ))->result_array();
         foreach ($data as $key => $value) {
            $data[$key]['detail']= $this->m_data->getWhere('job_pm',array('id_pmtype ' =>$value['idpm_type'],'status' => 1))->num_rows();
         }
       
        echo json_encode($data);
    }

    function LoadDataDetail($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data= $this->m_data->getWhere('job_pm',array('id_pmtype ' =>$id,'status' => 1))->result_array();
       
       
        echo json_encode($data);
    }

    function LoadDataEdit($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data= $this->m_data->getWhere('job_pm',array('id_jobpm' =>$id,'status' => 1))->row_array();
       
       
        echo json_encode($data);
    }

   
    
    public function SaveDetail($id=null)
    {
        $data=[
            'id_pmtype'     => $id,
            'nama'          => $this->input->post('job_name'),
            'status'        => 1,
        ];
        $this->m_data->insertData('job_pm',$data);
        
    }

    public function DeleteDetail($id=null)
    {
        $data=[
            'STATUS'                    => 8
        ];
        $this->m_data->updateData('job_pm',array('id_jobpm '=>$id ),$data);
        
    }

  

   
}