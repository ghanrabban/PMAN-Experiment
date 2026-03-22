<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;


class Pm extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        $this->load->library('pdfgenerator');
    }

    private function role() {
        $url = urlencode(current_url());
        if (session("username") == "") {
            redirect(base_url('login/auth'));
        }
    }

    private function position() {
        $data["position"] = "home";
        return $data;
    }

    public function index()
    {
      
        // $data = $this->position();
        // $data = access($data,"VIEW");
        $this->role();
        // $data = $this->position();
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Pereventif Maintenance";
        $data["title_des"] = " List Data Perangkat Perawatan ".sess()['unit_device'];
        $data["content"] = "v_index";
        $data['pm_type']= $this->Mod->getWhere('pm_type',array('status !='=>8 ))->result_array();
        
        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $data),"</pre>";
    }

    
    function LoadData(){

        if (strtotime(date('H:i')) >= strtotime('08:00') && strtotime(date('H:i')) <= strtotime('19:59')  ) {
            $shift ='PS';
            $dateNow = date("d");
        
        }else{
            if (strtotime(date('H:i')) >= strtotime('00:01') && strtotime(date('H:i')) <=strtotime('07:59')) {
                $dateNow = date("d")-1;
            }else {
                $dateNow = date("d");
            }
            $shift ='M';
        }

        if (sess()['unit'] == 3) {
            $shift ='ALL';
        }
        if (empty(sess()['id_lokasi'])) {
            $lokasi = "";
        }else{
            $lokasi = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }
        $data_res['tanggal']    = $dateNow ;
        $pm                     =  $this->Mod->GetCustome("SELECT 
                                                            d.id_jadwalpm,a.id_perangkat as id_fasilitas,
                                                            d.id_pmheader,
                                                            d.status as status_pm,
                                                            a.*,
                                                            b.name_pm,
                                                            c.nama_terminal 
                                                            FROM 
                                                                jadwal a 
                                                            LEFT JOIN
                                                                pm_type b 
                                                            ON 
                                                                b.idpm_type = a.idpm_type 
                                                            LEFT JOIN 
                                                                terminal c on c.id= a.id_lokasi 
                                                            LEFT JOIN
                                                                pm d 
                                                            ON 
                                                                d.id_jadwalpm = a.id_jadwal
                                                            WHERE 
                                                                a.tgl = '$dateNow' 
                                                            AND 
                                                                a.shift = '$shift' 
                                                            AND 
                                                                a.bulan in ('','".date("m")."')
                                                            $lokasi
                                                            AND 
                                                            a.id_unit ='".sess()['unit']."'" )->result_array();
        $dum =array();
        foreach ($pm as $key => $value) {
        
            $data_res['pm'][$value['nama_terminal']][$value['name_pm']][] =$value;
            
        }

 

        $data_res['jam']        = date('H:i') ;
        $data_res['shift']      = $shift;
         $data_res['tgl']        = tgl(date('Y-m-d'),'sm');
        // 
        echo json_encode($data_res);
      
    }

    function LoadDataArea(){
        if (sess()['unit'] == 3) {
            $shift ='ALL';
        }
      
        if(!empty($_POST['tanggal']) && !empty($_POST['shift'])){
            $shift =$_POST['shift'];
            $dateNow =date("d",strtotime($_POST['tanggal'])) ;
            $bulan = date("m",strtotime($_POST['tanggal'])) ;
            //  echo "<pre>",print_r (),"</pre>";;
        }elseif(!empty($_POST['tanggal'])){
            $shift ='ALL';
            $dateNow =date("d",strtotime($_POST['tanggal'])) ;
             $bulan = date("m",strtotime($_POST['tanggal'])) ;
        }elseif(!empty($_POST['shift'])){
            $shift =$_POST['shift'];
            $dateNow = date("d") ;
             $bulan = date("m") ;
        }else{
            
           
       
            if (strtotime(date('H:i')) >= strtotime('08:00') && strtotime(date('H:i')) <= strtotime('19:59')  ) {
                $shift ='PS';
                $dateNow = date("d");
                $bulan = date("m") ;
            
            }else{
                if (strtotime(date('H:i')) >= strtotime('00:01') && strtotime(date('H:i')) <=strtotime('07:59')) {
                    // $dateNow = date("d")-1;
                        $dateNow =  date('d', strtotime('-1 days'));
                        $bulan = date("m") ;
                }else {
                    $dateNow = date("d");
                    $bulan = date("m") ;
                }
                $shift ='M';
            }
            
        } 

        
        if (!empty(sess()['id_lokasi'])) {
           $param_lokasi= " AND a.id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param_lokasi="";
        }
        $data_res['tanggal']    = $dateNow ;
        $pm                     =  $this->Mod->GetCustome("SELECT
                                    a.*,e.nama_area as area,f.nama as catagory, 
                                    c.nama_terminal, d.name_pm,g.idpm_area,g.status as status_pm 
                                FROM 
                                    jadwal_pm_area a 
                                LEFT JOIN 
                                    terminal c 
                                ON 
                                    c.id= a.id_lokasi
                                LEFT JOIN 
                                    pm_type d 
                                ON 
                                    d.idpm_type = a.idpm_type
                                LEFT JOIN 
                                    area e
                                ON 
                                    e.id_area= a.id_area
                                LEFT JOIN 
                                    fasilitas_catagory f 
                                ON 
                                    f.id_catagory = a.id_catagory
                                LEFT JOIN 
                                    pm_area g 
                                ON 
                                    g.id_jadwalpm = a.id_jadwalarea
                                WHERE 
                                     a.tgl = '$dateNow' 
                                AND 
                                    a.shift = '$shift' 
                                AND 
                                    a.bulan in ('','".$bulan."')
                                AND 
                                    a.id_unit='".sess()['unit']."' $param_lokasi" )->result_array();
        $dum =array();
        foreach ($pm as $key => $value) {
        
            $data_res['pm'][$value['nama_terminal']][$value['name_pm']][] =$value;
            
        }

 

        $data_res['jam']        = date('H:i') ;
        $data_res['shift']      = $shift;
        // 
        echo json_encode($data_res);
      
    }
    function LoadHistory(){
        if (empty(sess()['id_lokasi'])) {
            $lokasi = "";
        }else{
            $lokasi = "AND c.id_lokasi = '".sess()['id_lokasi']."'";
        }
        $result = $this->Mod->GetCustome("SELECT 
                                            a.id_pmheader,a.tanggal_pm,a.status,a.id_jadwalpm,c.nama_fasilitas as fasilitas,d.nama_terminal,e.name_pm 
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
                                        WHERE a.status != '8'
                                        AND a.id_unit = ".sess()['unit']."
                                        $lokasi
                                         GROUP by 
                                            a.id_pmheader,a.status,a.id_jadwalpm,c.nama_fasilitas,d.nama_terminal,e.name_pm
                                        Order By  a.id_pmheader DESC"); 
        $res= $result->result_array();
        
        foreach ($res as $key => $value) {
            $res[$key]['tanggal_pm'] =tgl( $value['tanggal_pm'],'sm');
        }

        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
    
        $data['data']       =  $res;
        $from               = $this->uri->segment(3);
        $total_data         = $result->num_rows();
        $total_page         =  ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
        echo json_encode($data);
    }


    function LoadHistoryArea($from=null){

         if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;
        if (!empty(sess()['id_lokasi'])) {
            $param = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $param= " ";
        }

        if (isset($_POST['tanggal'])&& !empty($_POST['tanggal'])) {
            $param .= "AND a.tanggal_pm='".$_POST['tanggal']."' ";
        }
        $result = $this->Mod->GetCustome("SELECT 
                                            a.*,b.nama as catagory,c.name_pm as jenis_pm,d.nama as jenis_perangkat
                                         FROM 
                                            pm_area a 
                                        LEFT JOIN 
                                            fasilitas_catagory b 
                                        ON 
                                            b.id_catagory = a.id_catagory
                                        LEFT JOIN
                                            pm_type c 
                                        ON 
                                            c.idpm_type= a.idpm_type
                                        LEFT JOIN
                                            jenis_perangkat d
                                        ON 
                                            d.id_jenisperangkat = a.id_jenisperangkat
                                        WHERE a.id_unit='".sess()['unit']."'  $param ORDER BY a.status ASC limit $start,$limit"); 
        
        $res = $result->result_array();
        foreach ( $res as $key => $value) {
          $res[$key]['tanggal_pm_label'] = tgl($value['tanggal_pm'],'s');
        }
        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
    
        $data['data']       =  $res;
        $from               = $this->uri->segment(3);
        $total_data         = $result = $this->Mod->GetCustome("SELECT 
                                            a.*,b.nama as catagory,c.name_pm as jenis_pm,d.nama as jenis_perangkat
                                         FROM 
                                            pm_area a 
                                        LEFT JOIN 
                                            fasilitas_catagory b 
                                        ON 
                                            b.id_catagory = a.id_catagory
                                        LEFT JOIN
                                            pm_type c 
                                        ON 
                                            c.idpm_type= a.idpm_type
                                        LEFT JOIN
                                            jenis_perangkat d
                                        ON 
                                            d.id_jenisperangkat = a.id_jenisperangkat
                                        WHERE a.id_unit='".sess()['unit']."'  $param ORDER BY a.status ASC ")->num_rows(); 
        $total_page         =  ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit,'HistoryPM');
        echo json_encode($data);
    }
    
    function ListJob($id=null){
        $jadwal     = $this->Mod->getWhere('jadwal',array('id_jadwal' =>$id,'status !=' => 8 ))->row_array();
        $job_pm     = $this->Mod->GetCustome("SELECT b.id_jenisperangkat,d.*,e.id_pmheader  from fasilitas a 
                        LEFT JOIN fasilitas_detail b on b.id_fasilitas = a.id_fasilitas
                        LEFT JOIN jadwal c on c.id_perangkat = a.id_fasilitas
                        LEFT JOIN job_pm d on d.id_jenisperangkat = b.id_jenisperangkat 
                        LEFT JOIN pm e on
                        e.id_jadwalpm = c.id_jadwal 
                        where  b.id_jenisperangkat NOT IN ('3','4') 
                        and a.id_unit =".sess()['unit']."
                        AND d.id_pmtype  = '".$jadwal['idpm_type']."'
                        AND a.id_fasilitas='".$jadwal['id_perangkat']."' 
                        GROUP  by b.id_jenisperangkat,d.nama 
                        ")->result_array();
        foreach ($job_pm as $key => $value) {
            $job_pm[$key]['dokumentasi'] =  '';
        }
        $jadwal['list_job']  = $job_pm ;
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $jadwal
        ];
        echo json_encode($response);
    }

    function ListJobManual($id=null){
        // fasilitas
        if(isset($_POST['fasilitas'])) {
            $idfasiltas = $_POST['fasilitas'];
        }else{
            $idfasiltas = '';
        }

        if(isset($_POST['catagory'])) {
            $catagory = $_POST['catagory'];
        }else{
            $catagory ='';
        }
      
        if (!empty($idfasiltas)) {
            $job_pm = $this->Mod->GetCustome("SELECT b.* FROM fasilitas_detail a left join job_pm b on b.id_jenisperangkat= a.id_jenisperangkat WHERE
            a.id_fasilitas ='$idfasiltas' AND a.status !=8 AND b.id_pmtype ='$id' AND b.status != 8 AND id_unit =".sess()['unit'])->result_array();
      
        }elseif (!empty($catagory)) {
            $job_pm = $this->Mod->GetCustome("SELECT 
                                        a.id_pmtype,a.id_jobpm,a.id_jenisperangkat,a.id_unit,a.nama 
                                    FROM 
                                        job_pm a 
                                    LEFT JOIN
                                        fasilitas_detail b 
                                    ON 
                                        b.id_jenisperangkat = a.id_jenisperangkat
                                    LEFT JOIN 
                                        fasilitas c 
                                    ON 
                                        c.id_fasilitas = b.id_fasilitas

                                    WHERE  
                                        c.id_catagory = '$catagory'
                                    AND 
                                        a.id_pmtype ='$id'
                                    AND  
                                        c.id_lokasi ='".sess()['id_lokasi']."'
                                    AND a.status != 8
                                    GROUP by 
                                        a.id_pmtype,a.id_jobpm,a.id_jenisperangkat,a.id_unit,a.nama")->result_array();
      
        }else{
            $job_pm=[];
        }
       
        foreach ($job_pm as $key => $value) {
            $job_pm[$key]['dokumentasi'] =  '';
        }
        
        $jadwal['list_job']  = $job_pm ;
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $jadwal
        ];
        echo json_encode($response);
    }

    function ListJobArea($id=null){
        if (!empty(sess()['id_lokasi'])) {
         $param_lokasi =" AND id_lokasi = ".sess()['id_lokasi'];
        }else{
            $param_lokasi ='';
        }
        $jadwal     = $this->Mod->getWhere('jadwal_pm_area',array('id_jadwalarea' =>$id,'status !=' => 8 ))->row_array();
        $fasilitas  = $this->Mod->GetCustome("SELECT a.* 
                                                FROM fasilitas a  
                                                LEFT JOIN 
                                                    fasilitas_detail b 
                                                ON  
                                                    b.id_fasilitas = a.id_fasilitas 
                                                WHERE 
                                                    a.id_area=".$jadwal['id_area']." AND a.id_catagory =".$jadwal['id_catagory']." AND b.id_jenisperangkat ='".$jadwal['id_jenisperangkat']."' AND a.id_unit =".sess()['unit'] .$param_lokasi)->result_array();
      
      
        // $fasilitas  = $this->m_data->getWhere('jadwal',array('id_fasilitas' =>$id,'status !=' => 8 ))->row_array();
       
        $job_pm                 = $this->Mod->getWhere('job_pm',array('id_pmtype' =>$jadwal['idpm_type'],'id_unit' => sess()['unit'],'id_jenisperangkat' =>  $jadwal['id_jenisperangkat'],'status !='=> 8))->result_array();
        
        foreach ($job_pm as $key => $value) {
            $job_pm[$key]['dokumentasi'] =  '';
        }
        $jadwal['list_job']  = $job_pm ;
         $jadwal['list_fasilitas']  = $fasilitas ;
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $jadwal
        ];
        echo json_encode($response);
    }
    function EditData($id=null){
        $pm         = $this->Mod->getWhere('pm',array('id_pmheader' =>$id))->row_array();
        $fasilitas  = $this->Mod->getWhere('jadwal',array('id_jadwal' =>$pm['id_jadwalpm'],'status !=' => 8,'id_unit' => sess()['unit'] ))->row_array();
        
      
          $pm['detail'] =  $this->Mod->GetCustome("SELECT * from pm_detail a
            LEFT JOIN 
            job_pm b
            ON a.id_job = b.id_jobpm 
            WHERE 
            a.id_pmheader ='".$pm['id_pmheader']."'")->result_array();
      
      
        // $fasilitas['list_job']  = $job_pm ;
        $fasilitas['pm']        =  $pm ;
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $fasilitas
        ];
        echo json_encode($response);
    }

     function EditDataArea($id=null){
        $pm                 = $this->Mod->getWhere('pm_area',array('idpm_area' =>$id))->row_array();
        if(!empty($pm['id_jadwalpm'])){
             $jadwal             = $this->Mod->getWhere('jadwal_pm_area ',array('id_jadwalarea ' =>$pm['id_jadwalpm']))->row_array();   
             $id_area           = $jadwal['id_area'];
        }else{
            
        }
       
        $pm['pelaksana']= (!empty($pm['pelaksana']) ? explode(",",$pm['pelaksana'] ) : array());
        $catagory           = $this->Mod->getWhere('fasilitas_catagory',array('id_catagory' =>$pm['id_catagory']))->row_array();
            
        $pm['fasilitas']    = $this->Mod->GetCustome("SELECT  a.*
                            FROM 
                                fasilitas a  
                            LEFT JOIN 
                                fasilitas_detail b 
                            ON 
                            b.id_fasilitas = a.id_fasilitas
                            where
                                b.id_jenisperangkat ='".$pm['id_jenisperangkat']."' 
                                AND a.id_unit       = '".$pm['id_unit']."'
                                AND a.id_lokasi     = '".$pm['id_lokasi']."'
                                AND a.status        = '1' 
                                AND a.id_catagory   = '".$pm['id_catagory']."' 
                                AND a.id_area       ='".$pm['id_area']."'")->result_array(); 
       // echo "<pre>",print_r ($pm['fasilitas']),"</pre>";
        foreach ( $pm['fasilitas'] as $key => $value) {
            $detail  =  $this->Mod->getWhere('pm_area_fasilitas',array('idpm_area' =>$id,'id_fasilitas'=>$value['id_fasilitas']  ))->row_array();
            // echo "<pre>",print_r ($detail),"</pre>";
            if (!empty($detail)) {
                        $pm['fasilitas'][$key]['chec']  ='1';
            }else{
                        $pm['fasilitas'][$key]['chec']  ='0';
            }
    
        }

        $job_pm                 = $this->Mod->getWhere('job_pm',array('id_pmtype' =>$pm['idpm_type'],'id_unit' => sess()['unit'],'id_jenisperangkat' =>  $pm['id_jenisperangkat'],'status !='=> 8))->result_array();
         foreach ($job_pm as $key => $value) {
                   $dock=  $this->Mod->GetCustome("SELECT documentasi FROM pm_area_documentasi
                            WHERE
                                id_jenisperangkat ='".$value['id_jenisperangkat']."' AND idpm_area = '".$pm['idpm_area']."' and id_job = '".$value['id_jobpm']."' group by documentasi")->row_array(); 
                         
           $job_pm[$key]['dokumentasi'] =  (empty($dock) ? '':$dock['documentasi']);  
           
            // echo "<pre>",print_r ($job_pm),"</pre>";
        }
        $pm['list_job']  = $job_pm ;
        
        
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $pm
        ];
        echo json_encode($response);
    }
     function EditDataAreaManual($id=null){
        $pm                 = $this->Mod->getWhere('pm_area',array('idpm_area' =>$id))->row_array();
        $catagory     = $this->Mod->getWhere('fasilitas_catagory',array('id_catagory' =>$pm['id_catagory']))->row_array();
        $pm['catagory']=[ 
                'text'	=>  $catagory['nama'],
                'id'	=>  $catagory['id_catagory']];
        
        $area           = $this->Mod->getWhere('area',array('id_area' =>$pm['id_area']))->row_array();
        $pm['area']=[ 
                'text'	=>  $area['nama_area'],
                'id'	=>  $area['id_area']];
        
        $jp             = $this->Mod->getWhere('jenis_perangkat',array('id_jenisperangkat' =>$pm['id_jenisperangkat']))->row_array();
        $pm['jp']=[ 
                'text'	=>  $jp['nama'],
                'id'	=>  $jp['id_jenisperangkat']];        
        $pm['fasilitas']    = $this->Mod->GetCustome("SELECT  a.*
            FROM 
                fasilitas a  
            LEFT JOIN 
                fasilitas_detail b 
            ON 
             b.id_fasilitas = a.id_fasilitas
            where
                b.id_jenisperangkat ='".$pm['id_jenisperangkat']."' 
                AND a.id_unit = '".$pm['id_unit']."'
                AND a.id_lokasi = '".$pm['id_lokasi']."'
                AND a.status = '1' 
                AND a.id_catagory = '".$pm['id_catagory']."' 
                AND a.id_area ='".$pm['id_area']."'")->result_array(); 
                foreach ( $pm['fasilitas'] as $key => $value) {
                   $detail  =  $this->Mod->getWhere('pm_area_fasilitas',array('idpm_area' =>$id ))->row_array();
                    if ($detail['id_fasilitas'] ==$value['id_fasilitas']) {
                        $pm['fasilitas'][$key]['chec']  ='1';
                    }else{
                        $pm['fasilitas'][$key]['chec']  ='0';
                    }
    
                }
        
        
        $response=[
            'code'          => '200',
            'msg'           => 'Load Data Succes',
            'data'          =>  $pm
        ];
        echo json_encode($response);
    }

   

    function UploadData($idfasilitas,$pmtype){
        $fasilitas  = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$idfasilitas,'status !=' => 8 ))->row_array();
        $file=array();
       
        $header=[
            'id_unit'       => sess()['unit'],
            'idpm_type'     => $pmtype,
            'id_jadwalpm'   => $_POST['idjadwal'],
            'id_fasilitas'  => $idfasilitas,
            'tanggal_pm'    => $_POST['tanggal_pm'],
            'jam_mulai'     => $_POST['jam_mulai'],
            'jam_selesai'   => $_POST['jam_selesai'],
            
            'status'        => 0,
            'create_date'   => date('Y-m-d'),
            'create_by'     => sess()['nama']
        ];
        $this->db->insert('pm',$header);
        $id_header = $this->db->insert_id();
        //  echo "<pre>",print_r ($header),"</pre>";
        if (!empty($_FILES['Newitems'])) {
                
            foreach ($_FILES['Newitems'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key !='error' ) {
                          foreach ($value2 as $key3 => $value3) {
                            $file[$key2][$key3][$key] = $value3;
                            $file[$key2][$key3]['error'] = 0;
                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                          
                        }
                    }
                }
                    
            }	
                
        }
        unset($_FILES['Newitems']);
        foreach ($file as $key => $value) {
            $_FILES['file']= $value['file'];
                $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");

                $job                = $this->Mod->getWhere('job_pm',array('id_jobpm' =>$value['jobpm'] ))->row_array();
                $fas_detail   = $this->Mod->getWhere('fasilitas_detail',
                                    array('id_fasilitas' =>$idfasilitas,
                                    'id_jenisperangkat' =>$job['id_jenisperangkat'] ))->result_array();
                foreach ($fas_detail as $key2 => $val) {
                    $detail=[
                        'id_pmheader'           => $id_header,
                        'id_job'                => $value['jobpm'],
                        'id_jenisperangkat'     => $job['id_jenisperangkat'],
                        'id_perangkat'          => $val['id_perangkat'],
                        'id_fasilitas'          => $idfasilitas,
                        'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                        'status'                => 0, 
                        'create_date'           => date('Y-m-d'),
                        'create_by'             => sess()['nama'],
                      
                    ];

                    $this->db->insert('pm_detail',$detail);
                    // echo "<pre>",print_r ($perangkat),"</pre>";
                }
                
                
        }
          
    }


    function UploadDataManual(){
        $idfasilitas    = $_POST['id_fasilitas'];
        $pmtype         = $_POST['idpm_type'];
        $tanggal_pm     = $_POST['tanggal_pm'];
        $jam_mulai      = $_POST['jam_mulai'];
        $jam_selesai    = $_POST['jam_selesai'];
        $fasilitas      = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$idfasilitas,'status !=' => 8 ))->row_array();
       
      
       
        $file=array();
        $header=[
            'id_unit'       => sess()['unit'],
            'idpm_type'     => $pmtype,
            // 'id_jadwalpm'   => ,
            'tanggal_pm'    => $tanggal_pm,
            'jam_mulai'     => $jam_mulai,
            'jam_selesai'   => $jam_selesai,
            'id_fasilitas'  => $idfasilitas,
           
            'status'        => 0,
            'create_date'   => date('Y-m-d'),
            'create_by'     => sess()['nama']
        ];
        if ($this->db->insert('pm',$header)) {
            $id_header = $this->db->insert_id();
            if (!empty($_FILES['Newitems'])) {
                
                foreach ($_FILES['Newitems'] as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        if ($key !='error' ) {
                            foreach ($value2 as $key3 => $value3) {
                                $file[$key2][$key3][$key] = $value3;
                                $file[$key2][$key3]['error'] = 0;
                                $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                            
                            }
                        }
                    }
                        
                }	
                    
            }
            unset($_FILES['Newitems']);
            foreach ($file as $key => $value) {
                $_FILES['file']= $value['file'];
                    $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");

                    $job                = $this->Mod->getWhere('job_pm',array('id_jobpm' =>$value['jobpm'] ))->row_array();
                    $fas_detail   = $this->Mod->getWhere('fasilitas_detail',
                                        array('id_fasilitas' =>$idfasilitas,
                                        'id_jenisperangkat' =>$job['id_jenisperangkat'] ))->result_array();
                    foreach ($fas_detail as $key2 => $val) {
                        $detail=[
                            'id_pmheader'           => $id_header,
                            'id_job'                => $value['jobpm'],
                            'id_jenisperangkat'     => $job['id_jenisperangkat'],
                            'id_perangkat'          => $val['id_perangkat'],
                            'id_fasilitas'          => $idfasilitas,
                            'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                            'status'                => 0, 
                            'create_date'           => date('Y-m-d'),
                            'create_by'             => sess()['nama'],
                        
                        ];

                        $this->db->insert('pm_detail',$detail);
                        // echo "<pre>",print_r ($perangkat),"</pre>";
                    }
                    
                    
            }
            $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
        }else{
              $response=[
                    'code'          => '500',
                    'msg'           =>  'Tidak ada Fasilitas'
                ];
        }
         echo json_encode($response);
        // echo "<pre>",print_r ($header),"</pre>";
        
          
    }

   function SaveDataArea($idjadwal,$pmtype){
        $jadwal = $this->Mod->getWhere('jadwal_pm_area',array('id_jadwalarea' =>$idjadwal,'status !=' => 8 ))->row_array();
     
      
        if (!empty($jadwal)) {
           
            $jam_mulai      = $_POST['jam_mulai'];
            $jam_selesai    = $_POST['jam_selesai'];
            if (empty($jadwal['bulan'])&&empty($jadwal['tgl'])) {
                 $tanggal_pm=date('Y').'-'.$jadwal['bulan'].'-'.$jadwal['tgl'];
            }elseif (empty($jadwal['bulan'])) {
                 $tanggal_pm=date('Y-m').'-'.$jadwal['tgl'];
            }else{
                $tanggal_pm = date('Y-m-d');
            }

            if (!empty($jadwal['shift'])) {
                $shift=$jadwal['shift'];
            }else{
                $shift= GetShift()['shift'];
            }
           
            if (isset($_POST['id_pelaksana'])) {
                $pelaksana = implode(",",$_POST['id_pelaksana']);
            }else{
                $pelaksana ='';
            }
            if (isset($_POST['id_pengawas'])) {
                $pengawas = $_POST['id_pengawas'];
            }else{
                $pengawas ='';
            }
            $area=[
                'id_unit'               => sess()['unit'],
                'idpm_type'             => $jadwal['idpm_type'] ,
                'id_lokasi'             => sess()['id_lokasi'],
                'id_area'               => $jadwal['id_area'] ,
                'id_jenisperangkat'     => $jadwal['id_jenisperangkat']  ,
                'id_catagory'           => $jadwal['id_catagory']  ,
                'tanggal_pm'            => $tanggal_pm, 
                'pelaksana'             => $pelaksana,
                'pengawas'              => $pengawas,
                'jam_mulai'             => $jam_mulai,
                'jam_selesai'           => $jam_selesai ,
                'id_jadwalpm'           => $idjadwal,
                'create_date'           => date('Y-m-d'),
                'create_by'             => sess()['nama'],
                'status'                => 0,
                'shift'                 => $shift 
                
                
            ];
            // echo "<pre>",print_r ($area),"</pre>";
            $this->db->insert('pm_area',$area);
            $id_header = $this->db->insert_id();
            if (!empty($_POST['newdata'])) {
                foreach ($_POST['newdata'] as $key => $value) {
                    $fasilitas=[
                        'idpm_area'             => $id_header,
                        'id_unit'               => sess()['unit'],
                        'id_fasilitas'	        => $value['id_fasilitas'], 
                        'status'                => 0,
                        
                        
                    ];
                    $this->db->insert('pm_area_fasilitas',$fasilitas);
                    // if () {

                        
                    //     $response=[
                    //         'code'      => '200',
                    //         'msg'       =>  'Data Save'
                    //     ];
                    // }else{
                    //     $response=[
                    //         'code'      => '500',
                    //         'msg'       =>  'Coba lagi beberapa waktu'
                    //     ];
                    // }

                    
                }

                if (!empty($_FILES['Newitems'])) {
                
                    foreach ($_FILES['Newitems'] as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            if ($key !='error' ) {
                                foreach ($value2 as $key3 => $value3) {
                                    $file[$key2][$key3][$key] = $value3;
                                            $file[$key2][$key3]['error'] = 0;
                                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                                              
                                }
                            }
                        }
                                        
                    }	
                                    
                }
                

            }else{
                $response=[
                    'code'          => '500',
                    'msg'           =>  'Tidak ada Fasilitas'
                ];
            }
            $file=array();
                if (!empty($_FILES['Newitems'])) {
                        
                    foreach ($_FILES['Newitems'] as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            if ($key !='error' ) {
                                foreach ($value2 as $key3 => $value3) {
                                    $file[$key2][$key3][$key] = $value3;
                                    $file[$key2][$key3]['error'] = 0;
                                    $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                                
                                }
                            }
                        }
                            
                    }	

                    
                        
                }

                // echo "<pre>",print_r ($file),"</pre>";
                if (!empty($file)) {
                    foreach ($file as $key => $value) {
                        $_FILES['file']= $value['file'];
                            $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");
                            $detail = $this->Mod->GetCustome("SELECT a.*,b.* 
                                    FROM 
                                        fasilitas_detail a 
                                    LEFT JOIN 
                                        fasilitas b on b.id_fasilitas= a.id_fasilitas 
                                    WHERE 
                                        a.id_jenisperangkat ='".$jadwal['id_jenisperangkat']."' 
                                    AND  b.id_area ='".$jadwal['id_area']."' 
                                    AND 
                                        b.id_lokasi = '".sess()['id_lokasi']."' 
                                    AND b.id_unit='".sess()['unit']."'")->result_array();
            
                            
                            foreach ($detail as $key2 => $val) {
                                $detail=[
                                    'idpm_area'             => $id_header,
                                    'id_job'                => $value['jobpm'],
                                    'id_jenisperangkat'     => $jadwal['id_jenisperangkat'] ,
                                    'id_perangkat'          => $val['id_perangkat'],
                                    'id_fasilitas'          => $val['id_fasilitas'],
                                    'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                                    'status'                => 0, 
                                    'create_date'           => date('Y-m-d'),
                                    'create_by'             => sess()['nama'],
                                
                                ];
            
                                $this->db->insert('pm_area_documentasi',$detail);
                                //  echo "<pre>",print_r ($perangkat),"</pre>";
                            }
                            
                            
                    }
                }
        }else{
            echo "Jadwal Kosong";
        }
       
       
        
          
    }
    function UpdateData($idjadwalpm){
        // $pm = $this->Mod->getWhere('pm',array('id_jadwalpm' =>$idjadwalpm))->row_array();
        
        $file=array();
      
        if (!empty($_FILES['Newitems'])) {
                
            foreach ($_FILES['Newitems'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key !='error' ) {
                          foreach ($value2 as $key3 => $value3) {
                            $file[$key2][$key3][$key] = $value3;
                            $file[$key2][$key3]['error'] = 0;
                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                          
                        }
                    }
                }
                    
            }	
                
        }
        unset($_FILES['Newitems']);
        foreach ($file as $key => $value) {
            $_FILES['file']= $value['file'];
               
                $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");

                $job                = $this->Mod->getWhere('job_pm',array('id_jobpm' =>$value['jobpm'] ))->row_array();
                //  echo "<pre>",print_r ( $job),"</pre>";
                // $pm_detail          = $this->Mod->getWhere('pm_detail',array('id_pmheader' =>$pm['id_pmheader'],'id_job' => $value['jobpm'],'status !=' => 8 ))->row_array();
       
                $detail=[
                    'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                    'status'                => 0, 
                    'create_date'           => date('Y-m-d'),
                    'create_by'             => sess()['nama'],
                  
                ];
                $result = $this->Mod->update2('pm_detail', array('id_job'=>$job ['id_jobpm'],'id_jenisperangkat' => $job['id_jenisperangkat'],'id_pmheader' =>$idjadwalpm  ),$detail);
              
        }
        $res=['status' => 200,'msg'=>'Data Update'];
        echo json_encode($res);
    }

    function UpdateDataArea($idpm_area){
        $pm             = $this->Mod->getWhere('pm_area',array('idpm_area' =>$idpm_area))->row_array();
        $pm_fasilitas   = $this->Mod->getWhere('pm_area_fasilitas',array('idpm_area' =>$pm['idpm_area']))->result_array();
        $del_fal        = array();

        $jam_mulai      = $_POST['jam_mulai'];
        $jam_selesai    = $_POST['jam_selesai'];

        $jadwal = $this->Mod->getWhere('jadwal_pm_area',array('id_jadwalarea' =>$pm['id_jadwalpm'],'status !=' => 8 ))->row_array();
     
        if (!empty($jadwal['bulan']) && !empty($jadwal['tgl'])) {
            // echo "Tanggal bulan tanggal kosong";
            $tanggal_pm=date('Y').'-'.$jadwal['bulan'].'-'.$jadwal['tgl'];
        }elseif (!empty($jadwal['bulan'])) {
            $tanggal_pm=date('Y-m').'-'.$jadwal['tgl'];
            //   echo "Tanggal bulan kosong";
        }else{
            $tanggal_pm = date('Y-m-d');
            //   echo "ALL kosong";
        }

        if (!empty($jadwal['shift'])) {
            $shift=$jadwal['shift'];
        }else{
            $shift= GetShift()['shift'];
        }
        
        $head =[
            'jam_mulai'     => $jam_mulai,
            'jam_selesai'   => $jam_selesai,
            'shift'         => $shift,
            'tanggal_pm'    => $tanggal_pm
        ];
        $result_h = $this->Mod->update2('pm_area', array('idpm_area' => $pm ['idpm_area']),$head);
              
        if (!empty($_POST['data'])) {
                foreach ($_POST['data'] as $key => $value) {

                    $fasilitas=[
                        'id_unit'               => sess()['unit'],
                        'id_fasilitas'	        => $value['id_fasilitas'], 
                        'status'                => 0
                    ];

                    if (in_array($value['id_fasilitas'], array_column($pm_fasilitas, 'id_fasilitas'))) {
                      
                        $id_fas = array_search($value['id_fasilitas'], array_column($pm_fasilitas, 'id_fasilitas'));
                         $del_fal[]=$pm_fasilitas[$id_fas]['id_fasilitas'] ;
                         
                    }else{
                        $fasilitas['idpm_area'] =$idpm_area;
                        $fasilitas['id_unit'] =sess()['unit'];
                        $this->db->insert( 'pm_area_fasilitas',$fasilitas);
                        $del_fal[]=$value['id_fasilitas'];
                        
                        
                        $job= $this->Mod->GetCustome("SELECT id_job,documentasi,id_jenisperangkat  
                                            FROM 
                                                pm_area_documentasi
                                            WHERE 
                                        idpm_area='".$idpm_area."'
                                         GROUP BY id_job,documentasi,id_jenisperangkat ")->result_array();
                        foreach ($job as $key2 => $val) {
                            
                                $perangkat= $this->Mod->GetCustome("SELECT *
                                            FROM 
                                                fasilitas_detail
                                            WHERE 
                                            id_fasilitas='".$value['id_fasilitas']."'
                                            AND id_jenisperangkat='".$val['id_jenisperangkat']."'")->row_array();

                          $pm_dok=[
                            'idpm_area'         => $idpm_area,
                            'id_job'            => $val['id_job'],
                            'id_jenisperangkat' => $val['id_jenisperangkat'],
                            'id_perangkat'      => $perangkat['id_perangkat'],
                            'id_fasilitas'      => $value['id_fasilitas'],
                            'documentasi'       => $val['documentasi'],
                            'status'            => '0',
                            'create_date'       => date('Y-m-d'),
                            'create_by'         => sess()['nama'],
                          ];
                            $this->db->insert( 'pm_area_documentasi',$pm_dok);
                            // echo "<pre>",print_r ($pm_dok),"</pre>";
                        }
                       
                    }
                    
                }

                

            }else{
                $response=[
                    'code'          => '500',
                    'msg'           =>  'Tidak ada Fasilitas'
                ];
            }
            if ($del_fal) {
              
                $this->Mod->deletein('pm_area_documentasi', array('idpm_area'=> $idpm_area) , 'id_fasilitas',$del_fal );
                $this->Mod->deletein('pm_area_fasilitas', array('idpm_area'=> $idpm_area) , 'id_fasilitas',$del_fal );
                        //    $this->Mod->delete('pm_area_fasilitas',array('idpm_area3'=>$id,'id_fasilitas'=>$pm_fasilitas[$id_fas]['id_fasilitas'] ));
            
            }
                  
        $file=array();
      
        if (!empty($_FILES['Newitems'])) {
                
            foreach ($_FILES['Newitems'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key !='error' ) {
                          foreach ($value2 as $key3 => $value3) {
                            $file[$key2][$key3][$key] = $value3;
                            $file[$key2][$key3]['error'] = 0;
                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                          
                        }
                    }
                }
                    
            }	
                
        }
        unset($_FILES['Newitems']);
        foreach ($file as $key => $value) {
            
            $_FILES['file']= $value['file'];
                $dok            = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");

                $job            = $this->Mod->getWhere('job_pm',array('id_jobpm' =>$value['jobpm'] ))->row_array();
                // echo "<pre>",print_r ( $dok),"</pre>";
                $detail=[
                    'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                    'status'                => 0, 
                    'create_date'           => date('Y-m-d'),
                    'create_by'             => sess()['nama'],
                  
                ];
                // echo "<pre>",print_r ( $detail),"</pre>";
               // echo "".$idpm_area."|".$value['jobpm'];
                $result = $this->Mod->update2('pm_area_documentasi', array('idpm_area' => $idpm_area,'id_job' =>$value['jobpm']),$detail);
               
        }
        $res=['code' => 200,'msg'=>'Data Update'];
        echo json_encode($res);
    }
    
    function ProsesData($id){
        if (!empty($id)) {
            $data= [ 
                'status' => '1'
            ];
            // $pm_header = $this->Mod->getWhere('pm',array('id_jadwalpm' =>$id ))->row_array();
          
            $cek =  $this->Mod->getWhere('pm_detail',array('id_pmheader' =>$id,'documentasi' => '' ))->num_rows();
          
            if ($cek != 0) {
                $response=[
                    'code'      => '500',
                    'msg'       => 'Gagal Proses Data, Detail Belum Lengkap'
                ];
            }else{

                
                $result     = $this->Mod->update2('pm', array('id_pmheader'         => $id),$data);
                $result2    = $this->Mod->update2('pm_detail', array('id_pmheader'  => $id,'status' => 0),$data);
                
                if ($result) {

                    $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
          
                    $save_log_ttd =[
                        'id_user'       => sess()['id'],
                        'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                        'rel_id'        =>  $id,
                        'rel_type'      => 'pm',
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
                        'msg'       => 'Gagal Proses Data'
                    ];
                }
           }
            
        }else{
            $response=[
                'code'              => '500',
                'msg'               =>  'Gagal Proses Data'
            ];
        }
       
        echo json_encode($response);
    }

    function PrintData($id= null){
        
        $data["plugin"][]           = "plugin/datatable";
        $data["plugin"][]           = "plugin/select2";
        $data["title"]              = "PREVENTIVE MAINTENANCE BULANAN";
        $data["title_des"]          = "Lorem ipsum dolor sit amet";
        $data["content"]            = "PM Bulanan";
      
        // $pm                             = $this->Mod->getWhere('pm',array('id_pmheader' =>$id ))->row_array();

        $pm  = $this->Mod->GetCustome("SELECT 
             *,CONCAT(TIME_FORMAT(jam_mulai, '%H:%i'),' - ',TIME_FORMAT(jam_selesai, '%H:%i')) as waktu
         FROM pm WHERE id_pmheader = '".$id."'" )->row_array();
      
        $pm['pm_type']                  = $this->Mod->getWhere('pm_type',array('idpm_type' =>$pm['idpm_type']))->row_array();
        $pm['terbilang']                = tgl_($pm['tanggal_pm']);
      
        $fasilitas                      = $this->Mod->getWhere('fasilitas',array('id_fasilitas' => $pm['id_fasilitas'] ))->row_array();
        $pm['fasilitas']                = $fasilitas['nama_fasilitas'];
       
        
        $pm['job']= $this->Mod->GetCustome("SELECT 
        *,b.nama as nama_job 
        FROM 
        pm_detail a 
        LEFT JOIN 
        job_pm b 
        on 
        b.id_jobpm = a.id_job 
        WHERE 
        a.id_pmheader= '".$pm['id_pmheader']."' ORDER BY order_by ASC " )->result_array();


        $pm['tanggal']      = $pm['tanggal_pm'];
     
        $data               = $pm;
        
      
     // echo "<pre>",print_r ($data),"</pre>";
    
        if (sess()['unit'] == 3 ) {
            $this->PM_CCTV($data);
        }elseif (sess()['unit'] == 1) {
            $this->PM_FIDS($data);
        }else{
            $this->PM_ALL($data);
        }
        
        // echo "<pre>",print_r ($data),"</pre>";
    }

    function PM_CCTV($data){
            $this->load->view('CCTV/pm/'.'v_Dok'.$data['pm_type']['name_pm'].sess()['unit_device'],$data);
            // $html= $this->load->view('CCTV/pm/'.'v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data, true);
            // $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');

            // echo "<pre>",print_r ($data),"</pre>";
    }

    function PM_FIDS($data){
        $this->load->view('FIDS/pm/'.'v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data);
        $html= $this->load->view('FIDS/pm/'.'v_'.$data['pm_type']['name_pm'].sess()['unit_device'],$data, true);
        $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');

        // echo "<pre>",print_r ($data),"</pre>";
    }

    function PM_ALL($data){
        // $this->load->view('All/pm/v_general',$data);
        $this->load->view('v_PM',$data);
        // $html= $this->load->view('v_PM',$data, true);
        // $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
    }

    function PM_area(){
        $this->role();
        // $data = $this->position();
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Pereventif Maintenance";
        $data["title_des"] = " List Data Perangkat Perawatan ".sess()['unit_device'];
        $data["content"] = "v_index_area";
        if (!empty(sess()['id_lokasi'])) {
            $pegawas = $this->Mod->getWhere('user ',  array('status != ' =>8,'type_user'=>'2' , 'unit_kerja'=> sess()['unit'],'id_lokasi' =>sess()['id_lokasi'] ))->result_array();
            
             $this->Mod->getWhere('user ',array('status != ' =>8,'type_user'=>'1' , 'unit_kerja'=> sess()['unit'],'id_lokasi' =>sess()['id_lokasi']))->result_array();
        $pelaksana =  $this->Mod->GetCustome("SELECT a.* FROM user a left join role b 
                                    on b.id = a.type_user where b.type= 2  
                                     and a.status != '8' AND a.id_lokasi = '".sess()['id_lokasi']."' 
                             AND a.unit_kerja='".sess()['unit']."'")->result_array();
        }else{
           $pegawas = $this->Mod->getWhere('user ',  array('status != ' =>8,'type_user'=>'2' , 'unit_kerja'=> sess()['unit']))->result_array();
           $pelaksana =  $this->Mod->getWhere('user ',array('status != ' =>8,'type_user'=>'1' , 'unit_kerja'=> sess()['unit']))->result_array();
         
        }
        $data['pm_type']= $this->Mod->getWhere('pm_type',array('status !='=>8 ))->result_array();
        $data['pengawas']           = $pegawas; 
        $data['pengawas2']          = $pegawas;
        $data['pelaksana']          = $pelaksana;
        $data['pelaksana2']         = $pelaksana;
        $data["data"] = $data;

        $this->load->view('template_v2', $data);
    }

    function UploadDataManualJenis(){
        $idcatagory     = $_POST['id_catagory'];
        $id_area         = $_POST['id_area'];
        $id_jenis       = $_POST['id_jenisperangkat'];
        
        $pmtype         = $_POST['idpm_type'];
        $tanggal_pm     = $_POST['tanggal_pm'];
        $jam_mulai      = $_POST['jam_mulai_manual'];
        $jam_selesai    = $_POST['jam_selesai_manual'];
        if (!empty($idcatagory) && !empty($id_jenis) &&!empty(sess()['id_lokasi'])&&!empty($id_area)) {
            if (isset($_POST['id_pelaksana_manual'])) {
                $pelaksana = implode(",",$_POST['id_pelaksana_manual']);
            }else{
                $pelaksana ='';
            }

            if (isset($_POST['id_pengawas_manual'])) {
                $pengawas = $_POST['id_pengawas_manual'];
            }else{
                $pengawas ='';
            }
            $area=[
                'id_unit'               => sess()['unit'],
                'idpm_type'             => $pmtype,
                'id_lokasi'             => sess()['id_lokasi'],
                'id_area'               => $id_area ,
                'id_jenisperangkat'     => $id_jenis ,
                'id_catagory'           => $idcatagory ,
                'pelaksana'             => $pelaksana,
                'pengawas'              => $pengawas,
                // 'id_fasilitas'	        => $value['id_fasilitas'], 
                'tanggal_pm'            => $tanggal_pm, 
                'jam_mulai'             => $jam_mulai,
                'jam_selesai'           => $jam_selesai ,
                 'shift'                => GetShift()['shift'],
                'create_date'           => date('Y-m-d'),
                'create_by'             => sess()['nama'],
                'status'                => 0,
                
                
            ];
            // echo "<pre>",print_r ($area),"</pre>";
            $this->db->insert('pm_area',$area);
            $id_header = $this->db->insert_id();
            if (!empty($_POST['newdata'])) {
                foreach ($_POST['newdata'] as $key => $value) {
                    $fasilitas=[
                        'idpm_area'             => $id_header,
                        'id_unit'               => sess()['unit'],
                        'id_fasilitas'	        => $value['id_fasilitas'], 
                        'status'                => 0,
                        
                        
                    ];
                    $this->db->insert('pm_area_fasilitas',$fasilitas);
                    // if () {

                        
                    //     $response=[
                    //         'code'      => '200',
                    //         'msg'       =>  'Data Save'
                    //     ];
                    // }else{
                    //     $response=[
                    //         'code'      => '500',
                    //         'msg'       =>  'Coba lagi beberapa waktu'
                    //     ];
                    // }

                    
                }

                if (!empty($_FILES['Newitems'])) {
                
                    foreach ($_FILES['Newitems'] as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            if ($key !='error' ) {
                                foreach ($value2 as $key3 => $value3) {
                                    $file[$key2][$key3][$key] = $value3;
                                            $file[$key2][$key3]['error'] = 0;
                                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                                              
                                }
                            }
                        }
                                        
                    }	
                                    
                }
                
                    $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
            }else{
                $response=[
                    'code'          => '500',
                    'msg'           =>  'Tidak ada Fasilitas'
                ];
            }
           
        }else{
            echo "id_catagory".$idcatagory."|id_jenis".$id_jenis."|id_lokasi".sess()['id_lokasi']."|id_area".$id_area;
        }
       
       
        $file=array();
        if (!empty($_FILES['Newitems'])) {
                
            foreach ($_FILES['Newitems'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key !='error' ) {
                          foreach ($value2 as $key3 => $value3) {
                            $file[$key2][$key3][$key] = $value3;
                            $file[$key2][$key3]['error'] = 0;
                            $file[$key2]['jobpm'] = $_POST['Newitems'][$key2]['jobPM'];
                          
                        }
                    }
                }
                    
            }	

            
                
        }

        // echo "<pre>",print_r ($file),"</pre>";
        if (!empty($file)) {
            foreach ($file as $key => $value) {
                $_FILES['file']= $value['file'];
                    $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");
                    $detail = $this->Mod->GetCustome("SELECT a.*,b.* 
                            FROM 
                                fasilitas_detail a 
                            LEFT JOIN 
                                fasilitas b on b.id_fasilitas= a.id_fasilitas 
                            WHERE 
                                a.id_jenisperangkat ='$id_jenis' 
                            AND 
                                b.id_lokasi = '".sess()['id_lokasi']."' 
                            AND b.id_unit='".sess()['unit']."'")->result_array();
      
                    
                    foreach ($detail as $key2 => $val) {
                        $detail=[
                            'idpm_area'             => $id_header,
                            'id_job'                => $value['jobpm'],
                            'id_jenisperangkat'     => $id_jenis,
                            'id_perangkat'          => $val['id_perangkat'],
                            'id_fasilitas'          => $val['id_fasilitas'],
                            'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
                            'status'                => 0, 
                            'create_date'           => date('Y-m-d'),
                            'create_by'             => sess()['nama'],
                          
                        ];
    
                        $this->db->insert('pm_area_documentasi',$detail);
                        //  echo "<pre>",print_r ($perangkat),"</pre>";
                    }
                    
                    
            }
        }
        unset($_FILES['Newitems']);
        // foreach ($file as $key => $value) {
        //     $_FILES['file']= $value['file'];
        //         $dok    = upload('file', "./upload/pm", "jpg|png|jpeg", 100000, "");

        //         $job                = $this->Mod->getWhere('job_pm',array('id_jobpm' =>$value['jobpm'] ))->row_array();
        //         $fas_detail   = $this->Mod->getWhere('fasilitas_detail',
        //                             array('id_fasilitas' =>$idfasilitas,
        //                             'id_jenisperangkat' =>$job['id_jenisperangkat'] ))->result_array();
        //         foreach ($fas_detail as $key2 => $val) {
        //             $detail=[
        //                 'id_pmheader'           => $id_header,
        //                 'id_job'                => $value['jobpm'],
        //                 'id_jenisperangkat'     => $job['id_jenisperangkat'],
        //                 'id_perangkat'          => $val['id_perangkat'],
        //                 'id_fasilitas'          => $idfasilitas,
        //                 'documentasi'           => (!empty($dok['data_upload']) ? $dok['data_upload']['file_name']:''),
        //                 'status'                => 0, 
        //                 'create_date'           => date('Y-m-d'),
        //                 'create_by'             => sess()['nama'],
                      
        //             ];

        //             $this->db->insert('pm_detail',$detail);
        //             // echo "<pre>",print_r ($perangkat),"</pre>";
        //         }
                
                
        // }
        
        echo json_encode($response);
          
    }

 
    function ListJobJenis($id=null){
        // fasilitas
        // if(isset($_POST['fasilitas'])) {
        //     $idfasiltas = $_POST['fasilitas'];
        // }else{
        //     $idfasiltas = '';
        // }

        // if(isset($_POST['catagory'])) {
        //     $catagory = $_POST['catagory'];
        // }else{
        //     $catagory ='';
        // }
      
        // if (!empty($idfasiltas)) {
        //     $job_pm = $this->Mod->GetCustome("SELECT b.* FROM fasilitas_detail a left join job_pm b on b.id_jenisperangkat= a.id_jenisperangkat WHERE
        //     a.id_fasilitas ='$idfasiltas' AND a.status !=8 AND b.id_pmtype ='$id' AND b.status != 8 AND id_unit =".sess()['unit'])->result_array();
      
        // }elseif (!empty($catagory)) {
        //     $job_pm = $this->Mod->GetCustome("SELECT 
        //                                 a.id_pmtype,a.id_jobpm,a.id_jenisperangkat,a.id_unit,a.nama 
        //                             FROM 
        //                                 job_pm a 
        //                             LEFT JOIN
        //                                 fasilitas_detail b 
        //                             ON 
        //                                 b.id_jenisperangkat = a.id_jenisperangkat
        //                             LEFT JOIN 
        //                                 fasilitas c 
        //                             ON 
        //                                 c.id_fasilitas = b.id_fasilitas

        //                             WHERE  
        //                                 c.id_catagory = '$catagory'
        //                             AND 
        //                                 a.id_pmtype ='$id'
        //                             AND  
        //                                 c.id_lokasi ='".sess()['id_lokasi']."'
        //                             AND a.status != 8
        //                             GROUP by 
        //                                 a.id_pmtype,a.id_jobpm,a.id_jenisperangkat,a.id_unit,a.nama")->result_array();
      
        // }else{
        //     $job_pm=[];
        // }

        if (!empty($_POST['jenis']) && !empty($_POST['pm_type'])) {
           $job_pm=  $this->Mod->getWhere('job_pm',array('status !='=>8,'id_jenisperangkat' => $_POST['jenis'],'id_pmtype' => $_POST['pm_type'] ))->result_array();
        
           foreach ($job_pm as $key => $value) {
            $job_pm[$key]['dokumentasi'] =  '';
        }
        
            $jadwal['list_job']  = $job_pm ;
            $response=[
                'code'          => '200',
                'msg'           => 'Load Data Succes',
                'data'          =>  $jadwal
            ];
        }else{
            $response=[
                'code'          => '400',
                'msg'           => 'Jenis PM Kosong',
                'data'          =>  ''
            ];
        }
       
       
        echo json_encode($response);
    }

    function ProsesDataArea($id){
        if (!empty($id)) {
            $data= [ 
                'status' => '1'
            ];
            // $pm_header = $this->Mod->getWhere('pm',array('id_jadwalpm' =>$id ))->row_array();
            $cek_head   =  $this->Mod->getWhere('pm_area',array('idpm_area' =>$id))->row_array();
          
            $cek        =  $this->Mod->getWhere('pm_area_documentasi',array('idpm_area' =>$id,'documentasi' => '' ))->num_rows();
            $cek_fas        =  $this->Mod->getWhere('pm_area_fasilitas',array('idpm_area' =>$id))->num_rows();
            
            if ( $cek_fas == 0 || $cek != 0 || ($cek_head['tanggal_pm'] =='0000-00-00') || $cek_head['jam_mulai'] =='00:00:00' || $cek_head['jam_selesai'] =='00:00:00' ) {
                $response=[
                    'code'      => '500',
                    'msg'       => 'Gagal Proses Data, Detail Belum Lengkap'
                ];
            }else{

                
                $result     = $this->Mod->update2('pm_area', array('idpm_area'      => $id),$data);
                $result2    = $this->Mod->update2('pm_area_documentasi', array('idpm_area'  => $id,'status' => 0),$data);
                $result3    = $this->Mod->update2('pm_area_fasilitas', array('idpm_area'  => $id,'status' => 0),$data);
                
                if ($result) {
                    $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
          
                    $save_log_ttd =[
                        'id_user'       => sess()['id'],
                        'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                        'rel_id'        =>  $id,
                        'rel_type'      => 'pm_area',
                        'create_date'   => date('Y-m-d H:i:s')

                    ];
                    // echo "<pre>",print_r ( $save_log_ttd),"</pre>";
                    $this->db->insert( 'log_ttd',$save_log_ttd);
                    $response=[
                        'code'      => '200',
                        'msg'       =>  'Data Berhasil Di Proses'
                    ];
                    
                    
                    $data_PM = $this->Mod->GetCustome("SELECT a.*,b.id_fasilitas,b.id_perangkat,c.name_pm FROM pm_area a
                    LEFT JOIN pm_area_documentasi b 
                    on b.idpm_area = a.idpm_area 
                    LEFT JOIN pm_type c on c.idpm_type = a.idpm_type
                    where a.idpm_area = '".$id."'" )->result_array();
                        foreach ($data_PM  as $key => $value) {
                            $log = [
                                'id_fasilitas'          => $value['id_fasilitas'],
                                'id_perangkat'          => $value['id_perangkat'],
                                'id_jenisperangkat'     => $value['id_jenisperangkat'],
                              
                                'id_unit'               => $value['id_unit'],
                                'tittle'                => 'Preventif Maintenance',
                                'note'                  => 'Preventif Maintenance '.$value['name_pm'],
                                'rel_id'                => $value['idpm_area'],
                                'rel_type'              => 'pm_area',
                                'start_time'            => $value['tanggal_pm'].' ' .$value['jam_mulai'],
                                'end_time'              => $value['tanggal_pm'].' '.$value['jam_selesai'],
                                'create_byid'           => $value['create_byid'],
                                'create_by'             => $value['create_by'],
                               
                                'create_date'           => $value['tanggal_pm'],
                                'shift'                 => $value['shift'],
                            ];
                             
                              $this->db->insert('logbook',$log);
                        }
                    //
                    
                    
                }else{
                    $response=[
                        'code'      => '500',
                        'msg'       => 'Gagal Proses Data'
                    ];
                }
            }
            
        }else{
            $response=[
                'code'              => '500',
                'msg'               =>  'Gagal Proses Data'
            ];
        }
       
        echo json_encode($response);
    }
    function PrintDataArea($id= null){
        
        $data["plugin"][]           = "plugin/datatable";
        $data["plugin"][]           = "plugin/select2";
        $data["title"]              = "PREVENTIVE MAINTENANCE BULANAN";
        $data["title_des"]          = "Lorem ipsum dolor sit amet";
        $data["content"]            = "PM Bulanan";
      
        // $pm                             = $this->Mod->getWhere('pm',array('id_pmheader' =>$id ))->row_array();

        $pm  = $this->Mod->GetCustome("SELECT 
             *,CONCAT(TIME_FORMAT(jam_mulai, '%H:%i'),' - ',TIME_FORMAT(jam_selesai, '%H:%i')) as waktu
         FROM pm_area WHERE idpm_area = '".$id."'" )->row_array();
        $pm['shift_l']=l_sh($pm['shift']);

        $pm['pm_type']                  = $this->Mod->getWhere('pm_type',array('idpm_type' =>$pm['idpm_type']))->row_array();
        $pm['terbilang']                = tgl_($pm['tanggal_pm']);
        $lokasi = $this->Mod->getWhere('terminal',array('id' =>$pm['id_lokasi']))->row_array();
        $pm['lokasi']  =  $lokasi['nama_terminal'];

        // Hari(date('l', strtotime($date)))
        $pm['tlg_l'] =tgl($pm['tanggal_pm'],'sm');
        $pm['hari'] =  Hari(date('l', strtotime($pm['tanggal_pm'])));
        //$fasilitas                      = $this->Mod->getWhere('pm_area_fasilitas',array('idpm_area' => $pm['idpm_area'] ))->result_array();
        
         $fasilitas = $this->Mod->GetCustome("SELECT * FROM  pm_area_fasilitas WHERE idpm_area ='".$pm['idpm_area']."' limit 20")->result_array();
        foreach ($fasilitas  as $key => $value) {
                 $fasilitas[$key]['nama_fasilitas'] =$this->Mod->getWhere('fasilitas',array('id_fasilitas' => $value['id_fasilitas'] ))->row_array()['nama_fasilitas'];
       
        }
            $documentasi = $this->Mod->GetCustome("SELECT id_job,documentasi,id_jenisperangkat  
                                            FROM 
                                                pm_area_documentasi where idpm_area = '".$value['idpm_area']."'
                                                GROUP BY id_job,documentasi,id_jenisperangkat  
                                                ")->result_array();
        
        $pm['fasilitas']                = $fasilitas ;
        $pm['count_fasilitas'] = count($fasilitas );

        // $pm['documentasi']              = $documentasi ;
        $pm['tanggal']                  = $pm['tanggal_pm'];

         $pm['job']= $this->Mod->GetCustome("SELECT 
                                                b.nama as nama_job ,a.documentasi
                                            FROM 
                                                pm_area_documentasi a 
                                            LEFT JOIN 
                                                job_pm b 
                                            ON 
                                                b.id_jobpm = a.id_job 
                                            WHERE
                                                a.idpm_area = '".$pm['idpm_area']."' 
                                            GROUP BY 
                                                b.nama,a.documentasi
                                            ORDER BY 
                                                order_by ASC " )->result_array();
       $pm['ttd']['leder'] =$this->Mod->GetCustome("SELECT a.*,b.nama,c.name_role 
                            FROM log_ttd a left join user b 
                            ON b.id = a.id_user
                            LEFT Join role c 
                            ON c.id = a.type_user
                            WHERE 
                                a.type_user!='2' 
                            AND
                                a.rel_id ='$id' 
                            and 
                                a.rel_type ='pm_area'")->row_array();

        $pm['ttd']['organik'] =  $pm['pengawas'];
          $pm['pelaksana'] = explode(",", $pm['pelaksana']);
        $data                   = $pm;
     
        //echo "<pre>",print_r ($data),"</pre>";
       
            $this->PM_ALLArea($data);
       
    }

    function PM_ALLArea($data){
        //  $this->load->view('All/pm/v_general',$data);
        // echo "<pre>",print_r ($data),"</pre>";
        // $this->load->view('v_printPMArea',$data);
        $html= $this->load->view('v_printPMArea',$data, true);
        $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
    }
    function DeleteData($id=null){
        if (!empty($id)) {
            $cek   = $this->Mod->getWhere('pm',array('id_pmheader' =>$id))->row_array();
            if($this->Mod->delete('pm',array('id_pmheader'=>$id))){
                $this->Mod->delete('pm_detail',array('id_pmheader'=>$id));
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
    function DeleteDataArea($id=null){
        if (!empty($id)) {
            $cek   = $this->Mod->getWhere('pm_area',array('idpm_area' =>$id))->row_array();
            if($this->Mod->delete('pm_area',array('idpm_area'=>$id))){
                $this->Mod->delete('pm_area_documentasi',array('idpm_area'=>$id));
                $this->Mod->delete('pm_area_fasilitas',array('idpm_area'=>$id));
                
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
    function sinpmarea(){
        $data = $this->Mod->GetCustome("SELECT * FROM   pm_area where sincek = 0 and idpm_area = '2559' limit 10" )->result_array();
        
         foreach ($data as $key => $value) {
             if(!empty($value['id_jenisperangkat'])){
                   $data[$key]['jenisperangkat']   = $this->Mod->getWhere('jenis_perangkat',array('id_jenisperangkat ' =>$value['id_jenisperangkat']))->row_array();
             }
             
             if(!empty($value['id_area'])){
                   $data[$key]['area']   = $this->Mod->getWhere('area',array('id_area' =>$value['id_area']))->row_array();
                   
             }
                $data[$key]['fasilitas']  =$this->Mod->GetCustome("SELECT b.* FROM   fasilitas a left join fasilitas_detail b on a.id_fasilitas = b.id_fasilitas 
                where  b.id_jenisperangkat='".$value['id_jenisperangkat']."' " )->result_array();
                
                $data[$key]['dok']  =$this->Mod->GetCustome("SELECT* FROM   pm_area_documentasi where idpm_area='".$value['idpm_area']."' " )->result_array();
             
         }
                                                
        echo json_encode($data);
    }
    function SINByid(){
        
        $data = $this->Mod->GetCustome("SELECT * FROM   pm_area where sincek = 0  limit 500" )->result_array();
        foreach ($data as $key => $value) {
            if(!empty($value['create_by'])){
                $data_user = $this->Mod->GetCustome("SELECT * FROM   user where nama ='".$value['create_by']."'" )->row_array();
                if(!empty($data_user)){
                     $data_update=[
                    'create_byid' => $data_user['id'],
                    'sincek'        => 1
                    ];
                 $this->Mod->update2('pm_area', array('idpm_area'=> $value['idpm_area']),$data_update);
                }
                
            }
           
        }
         echo json_encode($data);
        // echo json_encode($data_user);
    
    }
    
    function SINlOg(){
        
          $data_PM = $this->Mod->GetCustome("SELECT a.idpm_area,a.id_unit,a.id_jenisperangkat,a.idpm_type,b.id_fasilitas,b.id_perangkat,c.name_pm,
          a.create_byid,a.tanggal_pm,a.create_by,a.jam_mulai,a.jam_selesai,a.shift
          FROM pm_area a
                    LEFT JOIN pm_area_documentasi b 
                    on b.idpm_area = a.idpm_area 
                    LEFT JOIN pm_type c on c.idpm_type = a.idpm_type
                    where a.sincek = 1  
                    group by  a.idpm_area,a.id_unit,a.id_jenisperangkat,a.idpm_type,b.id_fasilitas,b.id_perangkat,c.name_pm,
                    a.create_byid,a.tanggal_pm,a.create_by,a.jam_mulai,a.jam_selesai,a.shift
                    limit 10;" )->result_array();
                        foreach ($data_PM  as $key => $value) {
                            if(!empty($value['id_fasilitas']) && !empty($value['id_perangkat'])){
                                
                            
                            if(empty($value['shift']) =="" && !empty($value['id_jadwalpm']) ){
                               
                              $jadwal =  $this->Mod->GetCustome("SELECT * from jadwal_pm_area WHERE id_jadwalarea =  '".$value['id_jadwalpm']."'" )->row_array();
                            //   echo "<pre>",print_r ( $jadwal),"</pre>";
                              $value['shift'] = (!empty($jadwal) ? $jadwal['shift'] : '');
                            }
                            
                            $log = [
                                'id_fasilitas'          => $value['id_fasilitas'],
                                'id_perangkat'          => $value['id_perangkat'],
                                'id_jenisperangkat'     => $value['id_jenisperangkat'],
                              
                                'id_unit'               => $value['id_unit'],
                                'tittle'                => 'Preventif Maintenance',
                                'note'                  => 'Preventif Maintenance '.$value['name_pm'],
                                'rel_id'                => $value['idpm_area'],
                                'rel_type'              => 'pm_area',
                                'start_time'            => $value['tanggal_pm'].' ' .$value['jam_mulai'],
                                'end_time'              => $value['tanggal_pm'].' '.$value['jam_selesai'],
                                'create_byid'           => $value['create_byid'],
                                'create_by'             => $value['create_by'],
                               
                                'create_date'           => $value['tanggal_pm'],
                                'shift'                 => $value['shift'],
                            ];
                            
                            $cek_log= $this->Mod->GetCustome("SELECT * from logbook WHERE id_perangkat='".$value['id_perangkat']."' AND id_fasilitas='".$value['id_fasilitas']."' AND rel_id='".$value['idpm_area']."' AND rel_type='pm_area'" )->row_array();
                            if(empty($cek_log)){
                                $this->db->insert('logbook',$log);
                              
                                $data_update=[
                                'sincek'        => 2
                                ];
                                $this->Mod->update2('pm_area', array('idpm_area'=> $value['idpm_area']),$data_update);
                            }
                             echo "<pre>",print_r ( $log),"</pre>";
                             echo json_encode($log);
                              
                            }
                        }
     echo json_encode($data_PM);
    }
}