<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
       // $this->load->model("m_user");
        //$this->load->model("m_unit");
       
    }

    private function role() {
        if (session("role") != "ADMINISTRATOR" && session("role") != "READONLY") {
            redirect("login");
        }
    }


    private function checkData($id = "") {
        if ($id != "") {
            $q = $this->m_user->get(($id));
            if (is_object($q)) {
                redirect("user?token=" . token());
            }
            return $q;
        }
    }

    private function position() {
        $data["position"] = "user";
        return $data;
    }

    public function master() {

        //$this->role();
        $data = $this->position();
        $data["position"] .= "/master";
        // $data = access($data,"VIEW");
        // $data['units'] = $this->m_user->get_unit_options();

        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Users";
        $data["title_des"] = " List Data Users";
        $data["content"] = "v_user_list";
        $data['units']      = $this->Mod->getWhere('unit',array('status !=' =>8 ))->result_array();
        $data['lokasi']     = $this->Mod->getWhere('terminal',array('status !=' =>8,'parent_id' => '-1'))->result_array();
        $data["data"] = $data;
        $this->load->view('template_v2', $data);
    }

    public function user_list()
    {
        
       // $data = $this->position();
        // $data["position"] .= "/master";
        // //$data = access($data,"VIEW");
        // $data = $this->m_data->getWhere('user',array('status!=' =>8))->result_array();

        // if($data){
        //     echo json_encode(['status'=>200,"msg"=>"sukses","data"=>$data]);
        // }else{
        //     echo json_encode(['status'=>500,"msg"=>"gagal","data"=>[]]);
        // }
    }

    public function user_log()
    {
        
        $data = $this->position();
        $data["position"] .= "/log";
        $data = access($data,"VIEW");
        $data = $this->m_user->get_user_log();
        if($data){
            echo json_encode(['status'=>200,"msg"=>"sukses","data"=>$data]);
        }else{
            echo json_encode(['status'=>500,"msg"=>"gagal","data"=>[]]);
        }
    }


    public function log()
    {
        $data = $this->position();
        $data["position"] .= "/log";
        $data = access($data,"VIEW");

        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Daftar Pengguna";
        $data["content"] = "v_user_log";

        $data["data"] = $data;
        $this->load->view('template', $data);
    }

    function LoadData(){
       
        //$data=$this->Mod->getWhere('user',array('status !=' =>8,'unit_kerja' => sess()['unit']))->result_array();
        
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
        if(isset($_POST['filter_unit_user'])) {
            $jenis = $_POST['filter_unit_user'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
        }
        $from               = $this->uri->segment(3);
      
        $param=[
            'table'         => 'user' ,
            'pk'            => 'id' ,
            // 'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'src'           => $src,
            'param_src'     => [
                                'like' => 'nik',
                                'or_like'=> 'nama'],
            'filter'        => (!empty($jenis) ? array('unit_kerja'=> $jenis):'') ,
        ];
        if(sess()['type_user'] == 'super'){
            $param['parameter'] = array('status !=' => 8);
        }else{
            $param['parameter'] = array('status !=' => 8, 'unit_kerja'=> sess()['unit']);
        }
      //  echo "<pre>",print_r ( sess()),"</pre>";
        $totalData              = CountDataPag($param);
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);
        $res                    = pagin($param);
        foreach ($res['data'] as $key => $value) {
            $lokasi                            = $this->Mod->getWhere('terminal ',array('id' => $value['id_lokasi']))->row_array();
            $res['data'][$key]['lokasi']       = (!empty($lokasi['nama_terminal']) ? $lokasi['nama_terminal']: '');
           $unit                            = $this->Mod->getWhere('unit ',array('id_unit' => $value['unit_kerja']))->row_array();
           $res['data'][$key]['unit']       = (!empty($unit['kode_unit']) ? $unit['kode_unit']: '');
           $role                            = $this->Mod->getWhere('role',array('id' => $value['type_user']))->row_array();
           $res['data'][$key]['name_role']       = (!empty($role['name_role']) ? $role['name_role']: '');
        }
        $data['data']       = $res['data'];
        $data['pag']        = $res['pag'];
      
        echo json_encode($data);
    }

    function EditData($id=null){
       
        $data=$this->Mod->getWhere('user',array('id' =>$id ))->row_array();
        echo json_encode($data);
    }


    public function SaveData()
    {

        $data=array_filter($_POST);

        if (!empty($data)) {
            $cek= $this->Mod->getWhere('user',array('username ' =>$data['username'] ))->num_rows();
                if (!empty($data['password'])) {
                $data['password'] = hassp($data['password']);
               }
            if ( $cek < 1) {
                $this->db->insert('user',$data);
                $res=[
                    'status' => '200',
                    'msg'       => 'Data Berhasil di disimpan'
                ];
    
            }else{
                $res=[
                    'status'    => '400',
                    'msg'       => 'Data Gagal Disimpan, username sudah ada'
                ];
                
            }
           
           
           
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
  

    function UpdateData($id){
        $data=$_POST;

        if (!empty($data)) {
            
            // $cek= $this->Mod->getWhere('user',array('username ' =>$data['username'] ))->num_rows();
                if (!empty($data['password'])) {
                    $data['password'] = hassp($data['password']);
                }
                
                 if (empty($data['id_lokasi'])) {
                    $data['id_lokasi'] = null;
                }
              //echo "<pre>",print_r ( $data),"</pre>";
                    $update = $this->Mod->update2('user',array('id ' =>$id),$data);
                    // $this->db->insert('user',$data);
                if ($update) {
                    $res=[
                        'status' => '200',
                        'msg'       => 'Data Berhasil di disimpan'
                    ];
        
                }else{
                    $res=[
                        'status'    => '400',
                        'msg'       => 'Data Gagal Disimpan, username sudah ada'
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
        // echo "<pre>",print_r ( $data),"</pre>";
    }



    function UploadData(){
        if(isset($_FILES["filelampiran"]["name"])){
			$path = $_FILES["filelampiran"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
       
			
            $data           = array(); 
            $error          = array();
            $insert         = array();
            $datainsert     = array();
            $user_type  = $this->Mod->getWhere('role',array('status != ' =>8))->result_array();
            
			foreach($object->getWorksheetIterator(1) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
          
                    if ($worksheet == 0) {
                        $f_nama = $value->getCellByColumnAndRow(1, 1)->getValue();
                        if ($f_nama !=="Nama Karyawan") {
                            $error []="Kolom NAMA Tidak Sesuai Format".$f_nama ;
                        }
                        $f_nik = $value->getCellByColumnAndRow(2, 1)->getValue();
                        if ($f_nik !=="NIK") {
                            $error []="Kolom NIK Tidak Sesuai Format".$f_nik ;
                        }
                        $f_hp = $value->getCellByColumnAndRow(3, 1)->getValue();
                        if ($f_hp !=="Nomer Handphone") {
                            $error []="Kolom No HpTidak Sesuai Format".$f_hp ;
                        }
                        $f_email = $value->getCellByColumnAndRow(4, 1)->getValue();
                        if ($f_email !=="E-maill") {
                            $error []="Kolom Email Tidak Sesuai Format".$f_email;
                        }
                        $f_jenis = $value->getCellByColumnAndRow(5, 1)->getValue();
                        if ($f_jenis !=="User") {
                            $error []="Kolom Jenis User Tidak Sesuai Format".$f_jenis;
                        }
                        $unit = $value->getCellByColumnAndRow(6, 1)->getValue();
                        if ($unit !=="Unit Kerja") {
                            $error []="Kolom Lokasi Kerja Tidak Sesuai Format".$unit;
                        }
                        $f_lokasi = $value->getCellByColumnAndRow(7, 1)->getValue();
                        if ($f_lokasi !=="Lokasi Kerja") {
                            $error []="Kolom Lokasi Kerja Tidak Sesuai Format".$f_lokasi ;
                        }

                        for ($row=2; $row <=$highestRow ; $row++) { 
                           
                            $username       = $value->getCellByColumnAndRow(1, $row)->getValue();
                            $nama_lengkap   = $value->getCellByColumnAndRow(1, $row)->getValue();
                            $nik            = $value->getCellByColumnAndRow(2, $row)->getValue();
                            if ($value->getCellByColumnAndRow(4, $row)->getValue() instanceof PHPExcel_RichText){
                                $email          = $value->getCellByColumnAndRow(4, $row)->getValue()->getPlainText();
                              
                            }else{
                                $email          = $value->getCellByColumnAndRow(4, $row)->getValue();
                              
                            }
                           
                            $hp             = $value->getCellByColumnAndRow(3, $row)->getValue();
                            $jenis          = $value->getCellByColumnAndRow(5, $row)->getValue();
                            $unit           = $value->getCellByColumnAndRow(6, $row)->getValue();
                            $lokasi         = $value->getCellByColumnAndRow(7, $row)->getValue();
                           
                                    // $password       = $value->getCellByColumnAndRow(1, $row)->getValue();
                                
                                    $pas = explode(" ",$nama_lengkap);
                                
                                    if (count($pas) > 0) {
                                        $pasword    = $pas[0];
                                        $nama       = $pas[0];
                                    }else{
                                        $pasword    = $nama_lengkap;
                                        $nama       = $nama_lengkap;
                                    }
                                    $m_unit = $this->Mod->getWhere('unit',array('kode_unit ' =>$unit))->row_array();
                                   
                                    if (!empty($m_unit)) {
                                        $id_unit =  $m_unit['id_unit'] ;
                                    }else{
                                        $id_unit ='';
                                    }
                                    $m_lokasi = $this->Mod->getWhere('terminal',array('nama_terminal ' =>$lokasi))->row_array();
                                   
                                    if (!empty($m_lokasi)) {
                                        $id_lokasi =  $m_lokasi['id'] ;
                                    }else{
                                        $id_lokasi ='';
                                    }
                                    
                                    if (in_array($jenis,array_column($user_type, 'name_code'))) {
                                       
                                        $tes = array_search($jenis,array_column($user_type, 'name_role'));
                                       
                                        $insert[]=[
                                            'username'          => $nik ,
                                            'password'          => hassp($nik) ,
                                           
                                            'nik'               => $nik,
                                            'nama'              => $nama_lengkap,
                                            'no_hp'             => $hp,
                                            'email'             => $email,
                                            'unit_kerja'        => $id_unit,
                                            'type_user'         => $user_type[$tes]['id'],
                                            'id_lokasi'         => $id_lokasi,
                                            
                                            'created'           => '',
                                            'status'            => 1
                                            
                                    
                                        ];
                                        // $this->db->insert('user',$inst);
                                    }else{
                                        $error []=[
                                            'user'  =>$username,
                                            'msg'=>  "Jenis User Tidak terdaftar",

                                        ];
                                       ;
                                    }
                                    

                                    // $cek= $this->Mod->getWhere('user',array('username ' =>strtolower($username)));
                                    // if ( $cek->num_rows() < 1) {
                                    //     echo "Sudah Ada";
                                    //     echo "<pre>",print_r ($insert),"</pre>";
                                    //     //  $this->db->insert('user',$insert);
                                    // }else{
                                    // $datauser=  $cek->row_array();
                                    //     echo "<pre>",print_r ($datauser),"</pre>";
                                    //     $updateData=[
                                    //         'nik'               => $nik,
                                    //     ];
                                    //     $datauser['id'];
                                    //     // $update = $this->Mod->update2('user',array('id' =>$datauser['id']),$updateData);
                                    
                                    // }
                                    
                                //
                                
                        }
                        
                    }
         
             
            }
           
            if (count($error) > 1) {
                // /echo "<pre>",print_r ( $error),"</pre>";
            }else{
                // echo "<pre>",print_r ($insert),"</pre>";
                foreach ($insert as $key => $value) {
                    $cek        = $this->Mod->getWhere('user',array('status != ' =>8))->result_array();
                    if (array_search($value['nik'],array_column($cek, 'nik'))) {
                        $tes = array_search($value['nik'],array_column($cek, 'nik'));
                        $this->Mod->update2('user',array('id' =>$cek[$tes]['id']),$value);
                        echo "<pre>",print_r ("Update"),"</pre>";
                        echo "<pre>",print_r ($value),"</pre>";
                    }else{
                        $this->db->insert('user',$value);
                        // $inst=$value;
                        // echo "<pre>",print_r ($value),"</pre>";
                    }
                }
               
                
            }

            
        }
    }

   
}

