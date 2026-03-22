<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ListWO extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->model("m_data");
        $this->load->library('pdfgenerator');
        $this->role();
    }


    private function role() {
        $url = urlencode(current_url());
        if (session("username") == "") {
            redirect(base_url('login/auth'));
        }
    }


    public function detail($id) {
        // Misalnya, ambil data work order dan riwayat tindakan dari model
        $this->load->model('WorkOrderModel');
        $data['work_order'] = $this->WorkOrderModel->getWorkOrderById($id);
        $data['riwayat_tindakan'] = $this->WorkOrderModel->getRiwayatTindakan($id);

        // Load view work_order.php dengan data yang diperlukan
        $this->load->view('work_order', $data);
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
        $data["title"] = "Work Order";
        $data["title_des"] = " List Work Order";
        $data["content"] = "v_index";

        $data["data"] = $data;
        $data['pelaksana']          =  $this->Mod->getWhere('user ',array('status != ' =>8,'type_user'=>'1' , 'unit_kerja'=> sess()['unit']))->result_array();
        $data['pm_type']            =  $this->Mod->getWhere('pm_type ',array('status != ' =>8))->result_array();
        $data['jp']                 =  $this->Mod->getWhere('fasilitas_catagory ',array('status != ' =>8,'id_unit'=> sess()['unit']))->result_array();
       
        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }

    
    function LoadData(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
        //  $data          = $this->m_data->getWhere('wo',array('status !=' =>8 ))->result_array();


       
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
        
        $from               = $this->uri->segment(3);
      
        $param=[
            'table'         => 'wo' ,
            'pk'            => 'id_wo' ,
            'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit'] ) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'src'           => $src,
            'filter'        => (!empty($jenis) ? array('id_jenisperangkat'=> $jenis):'') ,
            'param_src'     => [
                                'like' => 'no_wo',
                                'or_like'=> 'no_wo']
        ];
        $totalData              = CountDataPag($param);
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);
        $res                    = pagin($param);
      
       foreach ($res['data'] as $key => $value) {
        $res['data'][$key]['status_label'] = sts('4',$value['status']);
        $res['data'][$key]['tanggal_label'] = tgl($value['tanggal'],'s');
        $detail =   $this->Mod->GetCustome("SELECT 
                                                a.*,d.nama_fasilitas FROM wo_detail a 
                                            left join 
                                                pm b 
                                            on 
                                                b.id_pmheader = a.id_pmheader
                                            left join 
                                                pm_detail c 
                                            on 
                                                c.id_pmheader = b.id_pmheader
                                            left join 
                                                fasilitas d 
                                            on 
                                                d.id_fasilitas = c.id_fasilitas
                                            where 
                                                a.id_wo =1
                                            group by 
                                                a.id_wodetail,a.id_wo,a.id_pmheader,a.status,d.nama_fasilitas")->result_array();
                            
        $res['data'][$key]['detail'] = $detail;
        $res['data'][$key]['jumlah'] = count($detail);
        //  echo "<pre>",print_r ( $detail),"</pre>";
        }
        echo json_encode($res);
    }

    function AddData(){
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Add Work Order";
        $data["title_des"] = "Pembuatan Work Order";
        $data["content"] = "FormData";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
    }


    function SaveData(){
        if (isset($_POST['id_user'])) {
            $pelaksana = implode(",",$_POST['id_user']);
         }else{
             $pelaksana ='';
         }

        if (isset($_POST['newdata'])) {
            $head = [
                'tanggal'       => $_POST['tanggal'] ,
                'team'          => $_POST['team'],  
                'shift'         => GetShift()['shift'] ,
                'pelaksana'     => $pelaksana,
                'id_catagory'   => $_POST['id_catagory'],
                'idpm_type'     => $_POST['idpm_type'],
                'id_unit'       => sess()['unit'],
                'create_date'   => date('Y-m-d'),
                'create_by'     => sess()['nama'],
                'status'        => 0
            ];
            $savedata = $this->db->insert('wo',$head);
            $id_wo = $this->db->insert_id();
            foreach ($_POST['newdata'] as $key => $value) {
                //echo "<pre>",print_r ( $value),"</pre>";
                $data=[
                    'id_wo'         => $id_wo ,
                    'id_pmheader'   => $value['id_pmheader'],
                    'status'    =>  0
                ];
                $this->db->insert('wo_detail',$data);
                
            }
            if ($savedata) {
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
          
        }else{
            $response=[
                'code'      => '500',
                'msg'       =>  'Tidak Ada Detail untuk Tiket'
            ];
        }
        echo json_encode($response);
    }

   
    function ProsesData($id=null){
        if (!empty($id)) {
            $data['status'] = 1;
            // 
            $cek =  $this->Mod->getWhere('wo_detail',array('id_wo' =>$id,'status' => 0 ))->num_rows();
          
           if ($cek == 0) {
                $res=[
                    'code'      => '500',
                    'msg'       => 'Gagal Proses Data,Tidak Ada Detail Transaksi/Detail Sudah Digunakan'
                ];
           }else{

                $result = $this->Mod->update2('wo',array('id_wo ' =>$id ),$data);
                $this->Mod->update2('wo_detail',array('id_wo ' =>$id ),$data);
                $res =[
                    'code'    =>  200,
                    'msg'       => 'Data Diproses'
                ];

                if ($result) {
                    $result     = $this->Mod->update2('wo', array('id_wo' => $id),$data);
                    $result2    = $this->Mod->update2('wo_detail', array('id_wo' => $id,'status' => 0),$data);
                    $cek_detail = $this->Mod->GetCustome("SELECT b.* FROM wo_detail a left join pm b on b.id_pmheader = a.id_pmheader WHERE a.id_wo= '".$id."'")->result_array();
                    foreach ($cek_detail as $key => $value) {
                        $data_cancel =['status' => 8];
                        $result2    = $this->Mod->update2('wo_detail', array('id_wo !=' => $id, 'id_pmheader' => $value['id_pmheader'],'status' => 0),$data_cancel);
                        $data_pm= [ 
                            'status' => '9'
                        ];
                        $this->Mod->update2('pm', array('id_pmheader' => $value['id_pmheader']),$data_pm);
                    }
                
                    // echo "<pre>",print_r ( $cek_detail),"</pre>";
                    if ($result) {

                        $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
            
                        $save_log_ttd =[
                            'id_user'       => sess()['id'],
                            'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                            'rel_id'        =>  $id,
                            'rel_type'      => 'wo',
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
                    // $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
                    // $save_log_ttd =[
                    //     'id_user'       => sess()['id'],
                    //     'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                    //     'rel_id'        =>  $id,
                    //     'rel_type'      => 'wo',
                    //     'create_date'   => date('Y-m-d H:i:s'),
                    //     'create_by'     => sess()['nama'],

                    // ];
                    // $this->db->insert( 'log_ttd',$save_log_ttd);
                    // $response=[
                    //     'code' => '200',
                    //     'msg'    =>  'Data Berhasil Di Proses'
                    // ];
                }else{
                    $response=[
                        'code'      => '500',
                        'msg'    => 'Gagal Proses Data'
                    ];
                }
           }
            
            // echo json_encode($res);
        }else{
             $res =[
                'code'    =>  200,
                'msg'       => 'Data Yang Diproses Tidak Valid'
            ];
           
        }
        echo json_encode($res);
    }

    function DeleteData($id=null){

        if (!empty($id)) {
          

            $result = $this->Mod->delete('wo', array('id_wo' =>$id ));
                     $this->Mod->delete('wo_detail', array('id_wo' =>$id ));
            if ($result) {
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
   

    function GetDataPM($id=null,$catagory=null){
        
        if (!empty($catagory)) {
           $id_catagory = " AND 
                                    c.id_catagory = '$catagory'";
        }else{
            $id_catagory = '';
        }
        $data = $this->Mod->GetCustome("SELECT 
                                a.id_pmheader,a.status,a.id_jadwalpm,b.id_fasilitas,c.nama_fasilitas as fasilitas,d.nama_terminal,e.name_pm 
                                FROM 
                                    pm a 
                                LEFT JOIN
                                    pm_detail b 
                                ON 
                                    b.id_pmheader = a.id_pmheader
                                LEFT JOIN 
                                    fasilitas c 
                                ON 
                                    c.id_fasilitas = b.id_fasilitas
                                LEFT JOIN 
                                    terminal d 
                                ON 
                                    d.id = c.id_lokasi
                                LEFT JOIN
                                    pm_type e
                                ON 
                                    a.idpm_type =e.idpm_type
                                WHERE 
                                    a.idpm_type = '$id'
                                $id_catagory 
                                AND 
                                    a.status NOT IN ('8','9')
                                AND 
                                    a.id_unit = ".sess()['unit']."
                                AND 
                                    b.id_fasilitas is NOT NULL
                                GROUP by 
                            a.id_pmheader,a.status,a.id_jadwalpm,c.nama_fasilitas,c.id_fasilitas,d.nama_terminal,e.name_pmq")->result_array(); 

        if (!empty($id)) {
          
            foreach ($data as $key => $value) {
                $cek = $this->Mod->getWhere('pm_detail',array('id_pmheader' => $value['id_pmheader']))->num_rows();
               
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
                $cek = $this->Mod->getWhere('pm_detail',array('id_pmheader' => $value['id_pmheader'],'status' => 1))->num_rows();
                // echo "<pre>",print_r ( $value),"</pre>";
                if ($cek != 0) {
                    // unset($data[$key]);
                    $data[$key]['checked'] = 0;
                  
                }else{
                    $fasilitas = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$value['id_fasilitas'] ))->row_array();
                    $data[$key]['fasilitas'] = $fasilitas['nama_fasilitas'];
                    
                }
              
            }
        }
        
         
        echo json_encode($data);
    }
    


    function ViewData($id=null){
        if (!empty($id)) {
            $header =  $this->Mod->getWhere('wo',array('id_wo ' =>$id))->row_array();
            $header['tanggal'] =  tgl($header['tanggal'],'l');
            $header['shift_l'] =l_sh($header['shift']);
            $detail = $this->Mod->GetCustome("SELECT 
                                                a.*,d.nama_fasilitas,b.id_pmheader FROM wo_detail a 
                                            left join 
                                                pm b 
                                            on 
                                                b.id_pmheader = a.id_pmheader
                                            left join 
                                                pm_detail c 
                                            on 
                                                c.id_pmheader = b.id_pmheader
                                            left join 
                                                fasilitas d 
                                            on 
                                                d.id_fasilitas = c.id_fasilitas
                                            
                                            where 
                                                a.id_wo =$id
                                            group by 
                                               a.id_wo,a.id_pmheader,a.status,d.nama_fasilitas")->result_array();
            foreach ($detail as $key => $value) {
                $dock = $this->Mod->GetCustome("SELECT 
                                                a.id_job,a.documentasi,b.nama
                                                FROM 
                                                pm_detail  a 
                                                left join 
                                                job_pm  b 
                                            
                                            ON b.id_jobpm = a.id_job
                                                WHERE a.id_pmheader ='$value[id_pmheader]'
                                                GROUP BY a.id_job,a.documentasi,b.nama")->result_array();
                $detail[$key]['documentasi']= $dock;
                $detail[$key]['jum']= count($dock);
            }
            $header['detail']= $detail ;
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

   
    function PrintData($id=null){
        $data["data"]           = [];
     
        $data =  $this->Mod->getWhere('wo',array('id_wo ' =>$id))->row_array();

        $data['pelaksana'] = explode(",", $data['pelaksana']);
        $data['tanggal'] = tgl($data['tanggal'],'l');
        $data['shift_l'] = l_sh($data['shift']);
        $data['ttd']['leder'] =$this->Mod->GetCustome("SELECT a.*,b.nama,c.name_role 
                            FROM 
                            log_ttd a left join user b 
                            ON b.id = a.id_user
                            LEFT Join role c 
                            ON 
                                c.id = a.type_user
                            WHERE 
                                c.id='2'  
                            AND 
                               a.rel_type ='tiket_cm'")->row_array();

       $data['ttd']['organik'] =$this->Mod->GetCustome("SELECT a.*,b.nama,c.name_role 
                               FROM log_ttd a left join user b 
                               ON 
                                   b.id = a.id_user
                               LEFT Join 
                                   role c 
                               ON 
                                   c.id = a.type_user
                                WHERE 
                                    c.id='2' 
                               AND 
                                   a.rel_id ='$id' 
                               AND 
                                   a.rel_type ='tiket_cm'")->row_array();

        $data['job'] = $this->Mod->GetCustome("SELECT c.nama as nama_job,b.documentasi
            FROM 
            wo_detail a 
        left join 
            pm_detail b 
        on 
            b.id_pmheader =a.id_pmheader
        left join 
            job_pm c 
        on 
            c.id_jobpm = b.id_job
        WHERE a.id_wo = '".$id."'
        group by  c.nama"  )->result_array();
      
       $data['c_detail']    = count($data['job']);
       $data['fasilitas']   = $this->Mod->GetCustome("SELECT 
                                                        g.id_job,b.id_pmheader,b.id_fasilitas,b.jam_mulai,b.jam_selesai,c.nama_fasilitas,f.nama_perangkat as type
                                                    FROM 
                                                        wo_detail a 
                                                    LEFT JOIN 
                                                        pm b 
                                                    ON 
                                                        b.id_pmheader = a.id_pmheader 
                                                    LEFT JOIN 
                                                        fasilitas c on c.id_fasilitas = b.id_fasilitas
                                                    LEFT JOIN
                                                        fasilitas_detail d 
                                                    ON  
                                                        d.id_fasilitas = c.id_fasilitas
                                                    LEFT JOIN
                                                        perangkat e
                                                    ON 
                                                        e.id_perangkat = d.id_perangkat
                                                    LEFT JOIN
                                                        model f
                                                    ON 
                                                        f.id_perangkat = e.id_model
                                                    LEFT JOIN pm_detail g 
                                                    on g.id_pmheader =b.id_pmheader
                                                    WHERE   
                                                        a.id_wo = '$id' 
                                                    GROUP BY 
                                                        b.id_fasilitas,c.nama_fasilitas,f.nama_perangkat")->result_array();

        $data['c_fasilitas']    = count($data['fasilitas']);
        foreach ($data['fasilitas'] as $key => $value) {
           $detail= $this->Mod->GetCustome("SELECT 
                                         a.id_job,a.documentasi,b.nama as nama_job
                                    FROM 
                                        pm_detail  a 
                                    left join 
                                        job_pm  b 
                                    ON 
                                        b.id_jobpm = a.id_job
                                    WHERE 
                                        a.id_pmheader = '".$value['id_pmheader']."' 
                                    GROUP BY a.id_job,a.documentasi,b.nama"  )->result_array();
             $data['fasilitas'][$key]['dok']  = $detail  ;                
        }
       

        $data['pm_type'] =  $this->Mod->getWhere('pm_type',array('idpm_type ' =>$data['idpm_type']))->row_array();
        $catagory_check=  $this->Mod->getWhere('job_pm_catagory',array('id_unit ' =>$data['id_unit'],'idpm_type'=>$data['idpm_type'] ))->result_array();
        foreach ($catagory_check as $key => $value) {
            $catagory_check[$key]['checklist']= $this->Mod->getWhere('job_pm_check',array('catagory' =>$value['id_job_catagory'],'id_unit'=>$value['id_unit'] ))->result_array();
        
        }

        $listpm='';
        $data['check']    = $catagory_check;
        $data['fasilitas_catagory']=sess()['unit_device'];

        if (sess()['unit'] == 3) {
            $this->PM_CCTV($data);
        }elseif (sess()['unit'] == 1) {
            $this->PM_All($data);
        }else{
            $this->PM_All($data);
        }
       
    }

    function PM_CCTV($data){
        //  echo "<pre>",print_r ( $data),"</pre>";

       
        // $this->load->view('CCTV/pm/v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data);
        // $html= $this->load->view('CCTV/pm/v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data, true);

        $html= $this->load->view('CCTV/pm/v_server',$data, true);
        $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
    }

    function PM_PSIT($data){
        // echo "<pre>",print_r ( $data),"</pre>";
        $this->load->view('FIDS/pm/v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data);
        // $html= $this->load->view('v_PM',$data, true);
        
        // $this->load->view('CCTV/pm/index',$data);
         $html= $this->load->view('FIDS/pm/v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data, true);
       $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
    }
    function PM_All($data){
        // echo "<pre>",print_r ( $data),"</pre>";
         
        //  $html= $this->load->view('v_PM',$data, true);
        
        // $this->load->view('All/pm/v_general',$data);
        $html= $this->load->view('All/pm/v_general',$data, true);
        $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
    }

   
    
}