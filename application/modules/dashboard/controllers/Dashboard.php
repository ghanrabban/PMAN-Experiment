<?php
// application/modules/req_open/controllers/Req_open.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        // Load library atau helper yang diperlukan
        $this->load->library('javascript');
        $this->load->model('Dashboard_m');
        $this->load->helper('text');
    }
    
    private function role() {
        $url = urlencode(current_url());
        if (session("username") == "") {
            redirect(base_url('login/auth'));
        }
    }

    private function position() {
        $data["param"] = http_build_query($_GET);
        $data["position"] = "home";
        return $data;
    }

    public function index() {
        $this->role();
        $data = $this->position();

      
        $nama_sesi = $this->session->userdata('nama');
        $data["title_des"]  = "Selamat datang " . $nama_sesi . "!";
        
        $data["data"]       = $data;

        // if (sess()['unit'] == 1) {
        //     $data["content"]    = "Dashboard_cctv";
        // }elseif (sess()['unit'] == 2) {
        //     $data["content"]    = "Dashboard_v";
        // }elseif (sess()['unit'] == 3) {
        //     $data["content"]    = "Dashboard_cctv";
        // }elseif (sess()['unit'] == 4) {
        //     $data["content"]    = "Dashboard_ges";
        // }else{
        //     $data["content"]    = "Dashboard_cctv";
        // }

        if (empty(sess()['unit']) && empty(sess()['id_lokasi'])) {
           $jenis = 'senior manager';
           $data["content"]    = "Dashboard_sm";
        }elseif(empty(sess()['id_lokasi']) && !empty(sess()['unit'])){
           
            if (sess()['unit']== '3') {
                $jenis = ' CCTV';
                $data["content"]    = "Dashboard_cctv";
            }elseif(sess()['unit']== '5'){
                  $jenis = ' SSES';
                $data["content"]    = "Dashboard_cctv";
            }elseif(sess()['unit']== '4'){
                  $jenis = ' GES';
                $data["content"]    = "Dashboard_ges";
            }
            else{
                $jenis = ' manager';
                // $data["content"]    = "Dashboard_m";
                $data["content"]    = "Dashboard_v";
            }
        }else{
             if (sess()['unit']== '4') {
                $jenis = ' GES';
                $data["content"]    = "Dashboard_ges";
            }else{
                $jenis = 'DEPARTEMENT HEAD ';
            $data["content"]    = "Dashboard_v";
            }
            
        }
        
        $data["title"]      = "Dashboard ".$jenis;
       
        $this->load->view('template_v2', $data);
     
    }
    
    public function get_data()
    {
        $data = $this->Dashboard_m->get_data();
        echo json_encode($data);
    }

    public function get_monitor_count() {

        $this->db->where('id_jenisperangkat', 1); // Filter untuk mendapatkan data monitor (id_jenisperangkat = 1)
        $this->db->where('status', 0);
        $jumlah_monitor = $this->db->count_all_results('perangkat'); // Menghitung jumlah baris yang memenuhi kriteria

        //tambahan untuk count data 
        $count = $this->Mod->GetCustome("SELECT status,COUNT(status) AS total FROM perangkat where id_jenisperangkat = 1 group by status")->result_array();

        $data = array('monitor_count' => $jumlah_monitor,'data' => $count);
        echo json_encode($data);
    }

    public function get_minipc_count() {

        $this->db->where('id_jenisperangkat', 2); 
        $this->db->where('status', 0);
        $jumlah_minipc = $this->db->count_all_results('perangkat'); 

        $count = $this->Mod->GetCustome("SELECT status,COUNT(status) AS total FROM perangkat where id_jenisperangkat = 2 group by status")->result_array();

        $data = array('minipc_count' => $jumlah_minipc,'data' => $count);
        echo json_encode($data);
    }

    public function get_fasilitas_count() {

        $this->db->where('status', 1);
        $this->db->where('id_unit', sess()['unit']);
        $jumlah_fasilitas = $this->db->count_all_results('fasilitas');
        $jum_perangkat = $this->Mod->GetCustome("SELECT COUNT(*)as total FROM perangkat where status != 8 and id_unit ='".sess()['unit']."'")->row_array(); 
            //   echo "<pre>",print_r ($jum_perangkat),"</pre>";
        $data = array('fasilitas_count' => $jumlah_fasilitas,'perangkat' =>$jum_perangkat['total']);
        echo json_encode($data);
    }

    public function getPersentase_Indikator(){

        $data['monitor']    = $this->Mod->GetCustome('SELECT COUNT(id_jenisperangkat) AS jumlahMonitor FROM logbook WHERE id_jenisperangkat = 1 AND create_date >= NOW() - INTERVAL 1 MONTH')->row_array();
        $data['pc']         = $this->Mod->GetCustome('SELECT COUNT(id_jenisperangkat) AS jumlahPC FROM logbook WHERE id_jenisperangkat = 2 AND create_date >= NOW() - INTERVAL 1 MONTH')->row_array();
        $data['jaringan']   = $this->Mod->GetCustome('SELECT COUNT(id_jenisperangkat) AS jumlahJaringan FROM logbook WHERE id_jenisperangkat = 3 AND create_date >= NOW() - INTERVAL 1 MONTH')->row_array();
        $data['listrik']    = $this->Mod->GetCustome('SELECT COUNT(id_jenisperangkat) AS jumlahListrik FROM logbook WHERE id_jenisperangkat = 4 AND create_date >= NOW() - INTERVAL 1 MONTH')->row_array();

        $data['total'] = $this->Mod->GetCustome('SELECT COUNT(*) AS total FROM logbook WHERE create_date >= NOW() - INTERVAL 1 MONTH')->row_array();

        echo json_encode($data);
    }

    function GetPersentase_repair(){
        $data ['all'] = $this->Mod->GetCustome("SELECT 
        COUNT(a.id_jenisperangkat) as jumlah,b.nama
        FROM 
            logbook a 
        LEFT JOIN 
            jenis_perangkat b 
        ON 
            b.id_jenisperangkat = a.id_jenisperangkat
        where 
            a.id_unit = '".sess()['unit']."'
        AND
            a.id_jenisperangkat != 0 
        GROUP BY
         a.id_jenisperangkat")->result_array();
        
        $total =0;
         foreach ($data['all'] as $key => $value) {
            $total = $total+ $value['jumlah'];
            $data['all'][$key]['color'] = color($key);
         }
         $data['total'] = $total;
        echo json_encode($data);
        
    }

    public function get_top5_data() {

        $data   = $this->Mod->GetCustome('SELECT a.*, b.nama_fasilitas, c.kode_unit, d.nama_terminal, COUNT(a.id_fasilitas) AS jumlah
        FROM logbook a 
        LEFT JOIN fasilitas b ON b.id_fasilitas = a.id_fasilitas 
        LEFT JOIN unit c ON c.id_unit = b.id_unit
        LEFT JOIN terminal d ON b.id_lokasi = d.id 
        WHERE a.create_date >= NOW() - INTERVAL 1 MONTH
        GROUP BY a.id_fasilitas ORDER BY jumlah DESC LIMIT 10')->result_array();
        echo json_encode($data);
    }

    public function get_users() {
        $today = date('Y-m-d');
        $current_time = date('H:i:s');
        $shift_PS_start = '08:00:00';
        $shift_PS_end = '19:59:00';
        $shift_M_start = '20:00:00';
        $shift_M_end = '07:59:00';
    
       

        if (strtotime(date('H:i')) >= strtotime('08:00') && strtotime(date('H:i')) <= strtotime('19:59')  ) {
            $shift ='PS';
            // $dateNow = date("Y-m-d");
            $dateNow = date("Y-m-d");
        }else{
            if (strtotime(date('H:i')) >= strtotime('00:01') && strtotime(date('H:i')) <=strtotime('07:59')) {
              //  echo "tanggal kemarin";
                $dateNow = date("Y-m").'-'.(date("d")-1);
                // $dateNow = date("Y-m-d")-1;
            }else {
                $dateNow = date("Y-m-d");
            }
           
            $shift ='M';
        }

        // echo "<pre>",print_r (),"</pre>";
        if (sess()['id_lokasi']) {
            $param_lokasi = " AND b.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $param_lokasi = '';
        }
        $users = $this->Mod->GetCustome(" SELECT b.nama,b.jabatan,b.nik,b.no_hp,a.* FROM jadwal_kerja a left join user b on b.id = a.id_user LEFT JOIN role c on c.id= b.type_user where a.tanggal ='".$dateNow."' and a.shift= '".$shift."' AND c.type = '2' AND b.unit_kerja ='".sess()['unit']."' $param_lokasi")->result_array();
        
        $organik = $this->Mod->GetCustome(" SELECT b.nama,b.jabatan,b.nik,b.no_hp,a.* FROM jadwal_kerja a left join user b on b.id = a.id_user LEFT JOIN role c on c.id= b.type_user where a.tanggal ='".$dateNow."' and a.shift= '".$shift."' AND c.type= '1' AND b.unit_kerja ='".sess()['unit']."' $param_lokasi")->result_array();
        
        $data =[
            'OM'    => $users,
            'FIDS'  =>  $organik
        ];

        echo json_encode($data); 
    }
    
    public function get_next_shift() {
        $today = date('Y-m-d');
        $current_time = date('H:i:s');
        $shift_PS_start = '08:00:00';
        $shift_PS_end = '19:59:00';
        $shift_M_start = '20:00:00';
        $shift_M_end = '07:59:00';
    
        

        if (strtotime(date('H:i')) >= strtotime('08:00') && strtotime(date('H:i')) <= strtotime('19:59')  ) {
            $shift ='M';
            // $dateNow = date("Y-m-d");
            $dateNow = date("Y-m-d");
        }else{
            if (strtotime(date('H:i')) >= strtotime('00:01') && strtotime(date('H:i')) <=strtotime('07:59')) {
              //  echo "tanggal kemarin";
                $dateNow = date("Y-m").'-'.(date("d")-1);
                // $dateNow = date("Y-m-d")-1;
            }else {
                $dateNow = date("Y-m-d");
            }
           
            $shift ='PS';
        }
        if (sess()['id_lokasi']) {
            $param_lokasi = " AND b.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $param_lokasi = '';
        }
        $organik = $this->Mod->GetCustome(" SELECT b.nama,b.jabatan,b.nik,b.no_hp,a.* FROM jadwal_kerja a left join user b on b.id = a.id_user LEFT JOIN role c on c.id= b.type_user where a.tanggal ='".$dateNow."' and a.shift= '".$shift."' AND c.type = '2'  AND b.unit_kerja ='".sess()['unit']."' $param_lokasi")->result_array();
        $om = $this->Mod->GetCustome(" SELECT b.nama,b.jabatan,b.nik,b.no_hp,a.* FROM jadwal_kerja a left join user b on b.id = a.id_user LEFT JOIN role c on c.id= b.type_user where a.tanggal ='".$dateNow."' and a.shift= '".$shift."' AND c.type = '2' AND b.unit_kerja ='".sess()['unit']."' $param_lokasi")->result_array();
        $data =[
            'OM'    => $om,
            'FIDS'  =>  $organik
        ];

        echo json_encode($data); 
    }

    public function get_logbook() {

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


        $todayDate = date('Y-m-d');
        $data['CM']     = $this->Mod->GetCustome("SELECT create_date, COUNT(type_tiket) AS jumlah_CM FROM tiket WHERE type_tiket = 2 AND DATE(create_date) = '$todayDate'")->row_array();
        $data['PM']     = $this->Mod->GetCustome("SELECT create_date, COUNT(type_tiket) AS jumlah_PM FROM tiket WHERE type_tiket != 2 AND DATE(create_date) = '$todayDate'")->row_array();
        $detail         = $this->Mod->GetCustome("SELECT * FROM logbook 
                                                    WHERE id_unit='".sess()['unit']."' 
                                                    AND shift='".GetShift()['shift']."'
                                                    AND create_date='".GetShift()['date']."' ")->result_array();
        foreach ($detail as $key => $value) {
           if ($value['rel_type'] == 'tinjut') {
                // $all= $this->Mod->GetCustome("SELECT FROM tinjut WHERE id_tinjut = '".$value['id_logbook']."'")->row_array();
                $detail[$key]['url'] = base_url('tindaklanjut/'.$value['rel_id']);
              $detail[$key]['note'] =  word_limiter($value['note'], 2);
                 $detail[$key]['ico']= 'icon-repeat';
           }elseif ($value['rel_type'] == 'pm') {
                $detail[$key]['url'] = base_url('pm/'.$value['rel_id']);
                 $detail[$key]['ico']= 'icon-settings';
           }elseif ($value['rel_type'] == 'pm_area') {
                $detail[$key]['url'] = base_url('pm/pm_area/'.$value['rel_id']);
                 $detail[$key]['ico']= 'icon-settings';
           }else{
                $detail[$key]['url'] = base_url('tindaklanjut/'.$value['rel_id']);
                 $detail[$key]['ico']= 'icon-briefcase';
           }
            # code...
        }
         $data['data']  = $detail;
        echo json_encode($data);
    }



    public function GetPersentasePerformance(){

        $GetFas = $this->Mod->GetCustome("SELECT id_fasilitas FROM fasilitas")->result_array();
        $jumlah_fas = count($GetFas);
        $test = $this->Mod->GetCustome("SELECT id_fasilitas, SUM(TIMESTAMPDIFF(MINUTE, date_start, update_date)) AS downTime_fasilitas FROM tinjut GROUP BY id_fasilitas")->result_array();
        $testuptime = $this->Mod->GetCustome("SELECT id_fasilitas, (TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH))) AS uptime_fasilitas FROM tinjut GROUP BY id_fasilitas")->result_array();
        $countTest = count($test);
        $TotalPersentase = 0;
        $total_persentase = 0;

        for ($i=0; $i < $countTest; $i++) { 
            $testingPerform[$i]['persentase'] = (($testuptime[$i]['uptime_fasilitas'] - $test[$i]['downTime_fasilitas']) / $testuptime[$i]['uptime_fasilitas']) * 100;
            $TotalPersentase += $testingPerform[$i]['persentase'];
        }

        for ($i=$countTest; $i < $jumlah_fas; $i++) { 
            $TotalPersentase += 100;
        }

        $total_persentase = $TotalPersentase / $jumlah_fas;

       echo json_encode(array('total_persentase' => number_format($total_persentase, 1, '.', '')));
    }

    function GetPersonil(){
        if (strtotime(date('H:i')) >= strtotime('08:00') && strtotime(date('H:i')) <= strtotime('19:59')  ) {
            $shift ='PS';
            $dateNow = date("d");
       }else{
            if (strtotime(date('H:i')) >= strtotime('00:01') && strtotime(date('H:i')) <=strtotime('07:59')) {
              //  echo "tanggal kemarin";
                $dateNow = date("d")-1;
            }else {
                $dateNow = date("d");
            }
           
            $shift ='M';
       }
        $tgl = date('Y-m-d');
        $personil=  $this->Mod->GetCustome("SELECT * FROM `jadwal_kerja` where tanggal='".$tgl."' and shift= '".$shift."'" )->result_array();
    }

    function get_sum_fasilitas(){
        $data =array();
        $data =  $this->Mod->getWhere('jenis_perangkat ',array('id_unit' => sess()['unit'],'status !=' => 8 ))->result_array();
       
        foreach ($data as $key => $value) {
            // $ste= $this->Mod->getWhere('perangkat ',array('id_jenisperangkat' => ,'status !=' => 8 ))->num_rows();
            
            $data[$key]['rekap']=  $this->Mod->GetCustome("SELECT STATUS, count(id_jenisperangkat) AS total FROM perangkat WHERE id_jenisperangkat ='".$value['id_jenisperangkat']."'  AND STATUS IN ('1','0') GROUP BY status order by status DESC")->result_array();
           
            // 
         # code...
            // $data[$key]['icon']  = "fa fa-hdd-o f-40 text-mute";
        }
        echo json_encode($data);
    }

    function GetDiviceProblem(){
        $data['perangkat'] = $this->Mod->GetCustome("SELECT 
                                            a.id_perangkat,b.nama_perangkat,b.serial_number, COUNT(a.id_perangkat)as jumlah 
                                        FROM 
                                            logbook a 
                                        LEFT JOIN  
                                            perangkat b 
                                        ON  
                                            b.id_perangkat = a.id_perangkat
                                        WHERE   
                                        a.id_unit='".sess()['unit']."' 
                                        AND 
                                            a.id_jenisperangkat  not in ('3','4')
                                        AND b.nama_perangkat IS NOT NULL
                                        GROUP BY
                                            a.id_perangkat,b.nama_perangkat
                                        ORDER BY `jumlah`  DESC limit 10")->result_array();
        $data['fasilitas'] = $this->Mod->GetCustome("SELECT 
                                                        a.id_fasilitas,b.nama_fasilitas, COUNT(a.id_fasilitas)as jumlah 
                                                    FROM 
                                                        logbook a 
                                                    LEFT JOIN 
                                                        fasilitas b 
                                                    on 
                                                        b.id_fasilitas = a.id_fasilitas
                                                    WHERE a.id_unit='".sess()['unit']."' 
                                                    AND b.nama_fasilitas IS NOT NULL
                                                    group by 
                                                        a.id_fasilitas,b.nama_fasilitas 
                                                    ORDER BY `jumlah` 
                                                    DESC limit 10")->result_array();
         echo json_encode($data);
    }

    function ListData($id,$jenis_perangkat){

        // $data= $this->Mod->getWhere('perangkat',array('id_jenisperangkat' => $jenis))->result_array();
        // foreach ($data as $key => $value) {
        //     $jenis      = $this->Mod->getWhere('jenis_perangkat ',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'status !=' => 8 ))->row_array();
        //     $merk       = $this->Mod->getWhere('merk ',array('id' =>$value['merk_id'] ))->row_array();
		// 	$model      = $this->Mod->getWhere('model ',array('id_perangkat' =>$value['id_model'] ))->row_array();
        //     $data[$key]['model']             = $model['nama_perangkat'];
        //     $data[$key]['merk']              = $merk['nama'];
		// 	$data[$key]['jenis_perangkat']   = $jenis['nama'];
        //     $data[$key]['stat']              = stat_prangkat($value['status']);
        // }
        // echo json_encode($data);


        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 10; 
        }
        if(isset($_POST['src'])) {
            $src = $_POST['src'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ''; 
        }  

        
        if(isset($_POST['jenis_perangkat'])) {
            $jenis = $_POST['jenis_perangkat'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
        }
        $from               = $this->uri->segment(3);

        $param=[
            'table'         => 'perangkat' ,
            'pk'            => 'id_perangkat' ,
            'parameter'     => array('status !=' => 8, 'id_unit' => sess()['unit'],'id_jenisperangkat' => $jenis_perangkat) ,
            'url'           => $this->uri->segment(2) ,
            'filter'        => (!empty($jenis) ? array('id_jenisperangkat'=> $jenis):'') ,
            'from'          => $from ,
            'limit'         => $limit ,
            
            'src'           => $src,
            'param_src'     => [
                                'like' => 'nama_perangkat',
                                'or_like'=> 'serial_number']
        ];
      

        $totalData              = CountDataPag($param);
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);

       // echo "<pre>",print_r ($param),"</pre>";
        $res                    = pagin($param);
        foreach ($res['data'] as $key => $value) {
            $jenis          = $this->Mod->getWhere('jenis_perangkat ',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'status !=' => 8 ))->row_array();
            $fasilitas      = $this->Mod->getWhere('fasilitas_detail',array('id_jenisperangkat' =>$value['id_jenisperangkat'],'id_perangkat' =>$value['id_perangkat']  ))->row_array();
            $merk           = $this->Mod->getWhere('merk ',array('id' =>$value['merk_id'] ))->row_array();
			$model          = $this->Mod->getWhere('model ',array('id_perangkat' =>$value['id_model'] ))->row_array();
            $res['data'][$key]['model'] = $model['nama_perangkat'];
            $res['data'][$key]['merk'] = $merk['nama'];
			$res['data'][$key]['jenis_perangkat'] = $jenis['nama'];
            $res['data'][$key]['status_label'] = sts('2',$value['status']);
            if (!empty($fasilitas)) {
                $res['data'][$key]['id_fasilitas'] = $fasilitas['id_fasilitas'];
            }else{
                $res['data'][$key]['id_fasilitas'] ='';
            }
            
            
            
        }
        $data['fasilitas']  = $res['data'];
        $data['pag']        = $res['pag'];
        echo json_encode($data);
    }

    function GetRekapPerfome(){
        $data=array();
        if (empty(sess()['id_lokasi'])) {
            $lokasi = "";
        }else{
         $lokasi = "AND id_lokasi = '".sess()['id_lokasi']."'";
        }
   
        $aktif      = $this->Mod->GetCustome("SELECT id_fasilitas as total  FROM fasilitas WHERE status = 1 AND id_unit =  '".sess()['unit']."'  $lokasi")->num_rows();
        $non_aktif  = $this->Mod->GetCustome("SELECT id_fasilitas as total  FROM fasilitas WHERE status = 0 AND id_unit =  '".sess()['unit']."'  $lokasi")->num_rows();
        
        // $CM      = $this->Mod->GetCustome("SELECT count(id_logbook) as total  FROM logbook WHERE tittle = 'Corrective Maintenance' AND id_unit =  '".sess()['unit']."'  $lokasi")->num_rows();
        // $PM      = $this->Mod->GetCustome("SELECT count(id_logbook) as total  FROM logbook WHERE tittle = 'Corrective Maintenance' AND id_unit =  '".sess()['unit']."'  $lokasi")->num_rows();
        // $data['fasilitas_m'] = ['totalCM'=> $CM,'totalPM'=> $PM];
        $data['fasilitas'] = [

            [
                'status' => 'ON',
                'total'  =>  $aktif,
            ],
            [
                'status' => 'OFF',
                'total'  =>  $non_aktif,
            ]        ];

        $data['perangkat'] = $this->Mod->GetCustome("SELECT 
        
                                                        c.nama, 
                                                        count(a.id_fasilitas) as total 
                                                    FROM 
                                                            fasilitas_detail a
                                                    LEFT JOIN 
                                                        fasilitas b
                                                    ON
                                                        b.id_fasilitas =  a.id_fasilitas
                                                    LEFT JOIN 
                                                        jenis_perangkat c
                                                    ON 
                                                        c.id_jenisperangkat = a.id_jenisperangkat
                                                    WHERE 
                                                        b.status ='1' 
                                                    AND 
                                                        a.id_fasilitas is not null 
                                                    AND 
                                                        a.id_jenisperangkat is not null 
                                                    AND 
                                                        a.id_jenisperangkat not in ('0','3','4')
                                                    AND
                                                         b.id_unit = ".sess()['unit']."
                                                    $lokasi
                                                    GROUP BY 
                                                        a.id_jenisperangkat,c.nama")->result_array();
      
        $data['fasilitas_detail'] =  $this->Mod->GetCustome("SELECT status,COUNT(status) as total FROM `fasilitas_detail` where status in ('0','1') and id_fasilitas is not null AND id_jenisperangkat not in ('3','4') group by status")->result_array();
        echo json_encode($data);
        
    }

    function GetUmurPerangkat(){
        $data['fasilitas'] = $this->Mod->GetCustome("SELECT count(h.tanggal_penggunaan) as jumlah,
                                        YEAR(h.tanggal_penggunaan) as tahun 
                                    FROM 
                                        fasilitas_detail h
                                    Left Join  
                                        fasilitas d
                                    ON
                                        d.id_fasilitas = h.id_fasilitas
                                    WHERE 
                                        h.tanggal_penggunaan is not null 
                                    AND 
                                        YEAR(h.tanggal_penggunaan) !=0 
                                    AND 
                                        h.status != 8
                                    AND 
                                        d.id_unit = ".sess()['unit']."
                                    GROUP BY YEAR(h.tanggal_penggunaan)")->result_array();

        echo json_encode($data);
    }


    function SaveImage(){
        $this->load->helper('path');
        $data=array_filter($_POST);
        $content = base64_decode( $data['gambar']);

        $upload_path = ".";

        
       
      


            $dataURL=$this->input->post('gambar');
            // $dataURL = $_POST["imageData"]; this should send to the hell cause spend long time
            $dataURL = str_replace('data:image/png;base64,', '', $dataURL);
            $dataURL = str_replace(' ', '+', $dataURL);
            $image = base64_decode($dataURL);
            $filename = date("d-m-Y-h-i-s") . '.' . 'png'; //renama file name based on time
            $path = set_realpath('upload/tes/');


          
        if (!file_exists($path)) {
            @mkdir($path, 0755, true);
        }else{
            echo $path;
        }
     
       

        // file_put_contents( $upload_path, $content);
        echo "<pre>", print_r(  file_put_contents($path. $filename, $image)), "</pre>";
    }

    function Detail(){
        $data["title"]      = "Dashboard Detail";
        $data["title_des"]      = "Dashboard Detail";
        
        echo "<pre>",print_r ($data),"</pre>";
        $data["content"]    = "v_detail";
        $this->load->view('template_v2', $data);
    }
    function GetPerfomanceUnit(){
       
            if (empty(sess()['id_lokasi'])) {
                $lokasi = "";
            }else{
             $lokasi = "AND id = '".sess()['id_lokasi']."'";
            }
       
       $terminal =  $this->Mod->GetCustome("SELECT * FROM `terminal` where parent_id = '-1' AND  status != 8 AND code !='0' $lokasi")->result_array();
        foreach ($terminal as $key => $value) {
            $terminal[$key]['nama']=$value['nama_terminal'];
            $perfomance     = $this->Mod->GetCustome("SELECT a.id_lokasi,COUNT(a.id_lokasi) as total  FROM fasilitas a where a.id_unit= '".sess()['unit']."' AND a.id_lokasi = '".$value['id']."'  AND a.status in('1') group by a.id_lokasi")->row_array();
            $perangkat      = $this->Mod->GetCustome("SELECT a.id_lokasi,COUNT(a.id_lokasi) as total FROM fasilitas a where a.id_unit= '".sess()['unit']."' AND a.id_lokasi =  '".$value['id']."'   AND a.status in('0','1') group by a.id_lokasi")->row_array();
            // echo "<pre>",print_r ($perfomance),"</pre>";
            $total =  (!empty($perfomance) ? $perfomance['total']: 0);
            $totalP = (!empty($perangkat['total']) ? $perangkat['total']:0 );
            $terminal[$key]['on']       = $total ;
            $terminal[$key]['total']    = $totalP;
           
            if (!empty($perfomance) && !empty($perangkat)) {
                $terminal[$key]['perfome']  = ($total /$totalP)*100;
            }else{
                $terminal[$key]['perfome']  = 0;
            }
        }
        $data['terminal']   = $terminal;
        $data['unit']       = $this->Mod->getWhere('unit ',array('id_unit' =>sess()['unit'],'status !=' => 8 ))->row_array();
        $terminal;
        echo json_encode($data);
    }

    function perfomance($param_unit = null,$param_terminal =null){
       
        $this->role();
        
        
   
            if (empty(sess()['unit']) && empty(sess()['id_lokasi'])) {
          
                $data["content"]    = "Dashboard_detail_sm";
            
                $data["title"]      = "Dashboard Perfomance Unit SM";
            }elseif(empty(sess()['id_lokasi']) && !empty(sess()['unit'])){
                if (sess()['unit']=='3') {
                    $data["content"]    = "Dashboard_detail_CCTV";
                     $data["title"]      = "Dashboard Perfomance Unit CCTV";
                }else{
                      $data["content"]    = "Dashboard_detail_CCTV";
                       $data["title"]      = "Dashboard Perfomance Unit manager";
                }
               
            }else{
                $data["content"]    = "Dashboard_detail";
                $data["title"]      = "Dashboard Perfomance Unit UMUM";
            }
            
            $data["title_des"]  = "Detail Perfomance" ;
           
             $unit       =  $this->Mod->GetCustome("SELECT * FROM unit where status != 8 ")->result_array();
      
             $data["unit"]      = $unit;
            // $data["data"]       = $terminal;
            
            $data['param']       = $param_unit."/".$param_terminal;
          
            // $data["content"]    = "Dashboard_detail";
            $this->load->view('template_v2', $data);
    //    echo "<pre>",print_r ($data),"</pre>";
    }

    function perfomance_detail(){
        if (empty(sess()['id_lokasi'])) {
            $lokasi = "";
        }else{
            $lokasi = "AND id = '".sess()['id_lokasi']."'";
        }
        $terminal       =  $this->Mod->GetCustome("SELECT * FROM terminal where code != '0' $lokasi ")->result_array();
        foreach ($terminal as $key => $value) {
            $perfomance     = $this->Mod->GetCustome(" SELECT a.id_catagory,b.nama as nama,
                                                        SUM(case when a.status='1' then 1 else 0 end) 'ON',
                                                        SUM(case when a.status='0' then 1 else 0 end) 'OFF',
                                                        SUM(case when a.status='1' then 1 else 0 end) +
                                                        SUM(case when a.status='0' then 1 else 0 end) total
                                                        FROM 
                                                            fasilitas a 
                                                        LEFT JOIN 
                                                            fasilitas_catagory b 
                                                        ON
                                                            b.id_catagory = a.id_catagory
                                                        WHERE 
                                                            a.id_unit= '".sess()['unit']."' AND a.id_lokasi =  '".$value['id']."'
                                                        GROUP BY a.id_catagory,b.nama")->result_array();
          
            foreach ($perfomance as $key2 => $value2) {
                $perfomance[$key2]['perfome'] = ($value2['ON']/$value2['total'])*100;
            }

           
            $terminal[$key]['perfome']  =$perfomance;
           
        }
           
        $off = $this->Mod->getWhere('temuan ',array('id_unit' =>sess()['unit']))->result_array();
      
            // $data['unit']       = $unit['kode_unit'].' '. $terminal['nama_terminal'];
            $unit= $this->Mod->getWhere('unit ',array('id_unit' =>sess()['unit'] ))->row_array();
            $data['id_unit']    = $unit['id_unit'];
            $data['unit']       = $unit['kode_unit'];
            $data['data']       = $terminal ;
            $data['off']        =$off;
           
            echo json_encode($data);

          
     
    }

    function fasilitasdetail(){
       
        if (empty(sess()['id_lokasi'])) {
            $lokasi = "";
        }else{
            $lokasi = "AND id = '".sess()['id_lokasi']."'";
        }
        $terminal       =  $this->Mod->GetCustome("SELECT * FROM terminal where code != '0' $lokasi ")->result_array();
        foreach ($terminal as $key => $value) {
            $perfomance     = $this->Mod->GetCustome(" SELECT 
                                                        SUM(case when a.status='1' then 1 else 0 end) 'ON',
                                                        SUM(case when a.status='0' then 1 else 0 end) 'OFF',
                                                        SUM(case when a.status='1' then 1 else 0 end) +
                                                        SUM(case when a.status='0' then 1 else 0 end) total
                                                        FROM 
                                                            fasilitas a 
                                                        LEFT JOIN 
                                                            fasilitas_catagory b 
                                                        ON
                                                            b.id_catagory = a.id_catagory
                                                        WHERE 
                                                            a.id_unit= '".sess()['unit']."' AND a.id_lokasi =  '".$value['id']."'
                                                        ")->result_array();
          
            foreach ($perfomance as $key2 => $value2) {
                $perfomance[$key2]['perfome'] = ($value2['ON']/$value2['total'])*100;
                $perfomance[$key2]['lokasi']  =  $value['nama_terminal'];
               
            }

           
           
            $terminal[$key]['perfome']  = $perfomance;
       

            $pie     = $this->Mod->GetCustome(" SELECT a.id_unit,
                                                        SUM(case when a.status='1' then 1 else 0 end) 'ON',
                                                        SUM(case when a.status='0' then 1 else 0 end) 'OFF',
                                                        SUM(case when a.status='1' then 1 else 0 end) +
                                                        SUM(case when a.status='0' then 1 else 0 end) total
                                                        FROM 
                                                            fasilitas a 
                                                        LEFT JOIN 
                                                            fasilitas_catagory b 
                                                        ON
                                                            b.id_catagory = a.id_catagory
                                                        WHERE 
                                                            a.id_unit= '".sess()['unit']."' AND a.id_lokasi =  '".$value['id']."'
                                                        GROUP BY a.id_unit")->result_array();
            $terminal[$key]['pie']  =$pie;
           
        }

        
        $grafik=array();
        $label_x=array();
        $label_y=array();
        $label_data=array();
        $pie_label=array();
        foreach ($terminal as $key => $value) {
            foreach ($value['perfome'] as $key2 => $val) {
                $grafik['name'][]= $val['lokasi'];
                $grafik['data'][]= round($val['perfome'],2);
                $grafik['unit']= sess()['unit_kode'];
            
              
               
            }
            
            
            # code...
        }

        if (empty(sess()['id_lokasi'])) {
            $lokasi_fas = "";
        }else{
            $lokasi_fas = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }
        $fasilitas=  $this->Mod->GetCustome(" SELECT a.id_unit,
                                                        SUM(case when a.status='1' then 1 else 0 end) 'ON',
                                                        SUM(case when a.status='0' then 1 else 0 end) 'OFF',
                                                        SUM(case when a.status='1' then 1 else 0 end) +
                                                        SUM(case when a.status='0' then 1 else 0 end) total
                                                        FROM 
                                                            fasilitas a 
                                                        LEFT JOIN 
                                                            fasilitas_catagory b 
                                                        ON
                                                            b.id_catagory = a.id_catagory
                                                        WHERE 
                                                            a.id_unit= '".sess()['unit']."'  $lokasi_fas
                                                        GROUP BY a.id_unit")->result_array();

        // echo "<pre>",print_r ( $fasilitas),"</pre>";
        foreach ($fasilitas as $key => $value) {
            $pie_label[$value['ON']]['value']=$value['ON'];
            $pie_label[$value['ON']]['name']= 'ON';
            $pie_label[$value['OFF']]['value']=$value['OFF'];
            $pie_label[$value['OFF']]['name']= 'OFF';
        }

        $pie_label= array_values($pie_label);
      
        $off = $this->Mod->getWhere('temuan ',array('id_unit' =>sess()['unit']))->result_array();
         if (empty(sess()['id_lokasi'])) {
            $lok = "";
        }else{
            $lok = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }
        $catagory= $this->Mod->GetCustome("SELECT b.nama as name ,COUNT(a.id_catagory) as value from fasilitas a
                                                LEFT JOIN 
                                                    fasilitas_catagory b 
                                                ON 
                                                    b.id_catagory = a.id_catagory
                                                WHERE 
                                                    a.id_unit= ".sess()['unit']." $lok
                                                GROUP by a.id_catagory")->result_array();
        $perangkat= $this->Mod->GetCustome("SELECT COUNT(b.id_jenisperangkat) as value,c.nama as name
                                            FROM 
                                                fasilitas a 
                                            LEFT JOIN 
                                                fasilitas_detail b 
                                            ON 
                                                b.id_fasilitas  = a.id_fasilitas 
                                            LEFT JOIN 
                                                jenis_perangkat c 
                                            ON 
                                                c.id_jenisperangkat  = b.id_jenisperangkat 
                                            WHERE 
                                                 a.id_unit= ".sess()['unit']." $lok AND c.id_jenisperangkat not in ('3','4')
                                            GROUP BY c.nama")->result_array();
      
        // $data['unit']       = $unit['kode_unit'].' '. $terminal['nama_terminal'];
            $unit= $this->Mod->getWhere('unit ',array('id_unit' =>sess()['unit'] ))->row_array();
            $data['id_unit']    = $unit['id_unit'];
            $data['grafik']     = $grafik;
            $data['unit']       = $unit['kode_unit'];
            $data['pie']        = $pie_label;
            $data['data']       = $terminal ;
            $data['off']        = $off;
            $data['perangkat']  = $perangkat;
            $data['perfomance'] = array('fasilitas' =>$pie_label,'catagory' =>  $perangkat);
            echo json_encode($data);

          
     
    }
}