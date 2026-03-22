<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Temuan extends CI_Controller {

    function __construct() {
        parent::__construct();
       // $this->load->library('excel');
        $this->load->model("m_data");
        $this->role();
    }

    private function role() {
        $url = urlencode(current_url());
       
        if (session("username") == "") {
             redirect(base_url('login/auth'));
        }
    }

    public function index()
    {
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
       
        //  $data = access($data,"VIEW");
       
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Temuan Lapangan";
        $data["title_des"] = " List Data Temuan yang terjadi di area";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
      
    }

    
    function LoadData(){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
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
        if(isset($_POST['jenis_perangkat'])) {
            $jenis = $_POST['jenis_perangkat'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
        }

        if(isset($_POST['jenis_perangkat'])) {
            $jenis = $_POST['jenis_perangkat'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $jenis = ''; 
        }
        $from               = $this->uri->segment(3);
      
        $param=[
            'table'         => 'temuan' ,
            'pk'            => 'id_temuan' ,
            'parameter'     => array('status !=' => 8, 'id_unit' => sess()['unit']) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'src'           => $src,
            'order'         => 'status ASC',
            'filter'        => (!empty($jenis) ? array('id_jenisperangkat'=> $jenis):'') ,
            'param_src'     => ['like' => 'keterangan']
        ];
        if (sess()['id_lokasi'] !== null ) {
          
            $param['parameter']+=array('id_lokasi'=> sess()['id_lokasi']);
            //array_push( ,);
        }
      
        $data['url']            = $this->uri->segment(2);
        $totalData              = CountDataPag($param);
  
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);
        $res                    = pagin($param);
        foreach ($res['data'] as $key => $value) {
            $res['data'][$key]['tanggal']       = tgl($value['tanggal'],'s');
            $res['data'][$key]['status_label']  = st($value['status']);
            $fasilitas      = $this->m_data->getWhere('fasilitas',array('id_fasilitas' =>$value['id_fasilitas'] ))->row_array();
         
            if (!empty($fasilitas)) {
                $res['data'][$key]['fasilitas'] = $fasilitas['nama_fasilitas'];
            }else{
                $res['data'][$key]['fasilitas'] ='';
            }
            
            
            
        }
        $data['data']       = $res['data'];
        $data['pag']        = $res['pag'];

        
        //  $data_res['perangkat'] = $this->Mod->GetCustome('SELECT a.*,b.nama as jenis_perangkat FROM perangkat a left join jenis_perangkat b on b.id_jenisperangkat = a.id_jenisperangkat where a.status != 8')->result_array();
       
        echo json_encode($data);
       
    }

    
   
    
    function EditData($id=null){
        if (!empty($id)) {
            $data = $this->m_data->getWhere('temuan',array('id_temuan' =>$id ))->row_array();
            $fasilitas = $this->m_data->getWhere('fasilitas',array('id_fasilitas' =>$data['id_fasilitas']))->row_array();
            $data['fasilitas']=[
                'text'	=> $fasilitas['nama_fasilitas'],
                'id'	=> $fasilitas['id_fasilitas']
            ];	
            echo json_encode($data);
        }else{
            echo "kosong";
        }
    }

    public function UpdateData($id=null)
    {
       $update=[
        'tanggal'       => $_POST['tanggal'] ,
        'id_fasilitas'  => $_POST['id_fasilitas'],
        'keterangan'    => $_POST['keterangan'],
        'kondisi'       => $_POST['kondisi'],
        'id_unit'       => sess()['unit'],
        'id_lokasi'     => sess()['id_lokasi'],
        'update_by'     => sess()['id'],
        'update_date'   => date('Y-m-d'),
        'status'        => '0'
       ];
       
       $result = $this->Mod->update2('temuan', array('id_temuan' => $id),$update);

           
       if ($result) {
           $response=[
               'code' => '200',
               'msg'    =>  'Data Berhasil Di Update'
           ];
       }else{
           $response=[
               'code'      => '500',
               'msg'    => 'Gagal Update Data'
           ];
       }

       
       echo json_encode($response);
    }

    public function SaveData()
    {

        $data = [
            'tanggal'       => $_POST['tanggal'] ,
            'id_fasilitas'  => $_POST['id_fasilitas'],
            'keterangan'    => $_POST['keterangan'],
            'id_unit'       => sess()['unit'],
            'id_lokasi'     => sess()['id_lokasi'],
            'kondisi'       => $_POST['kondisi'],
            'create_by'     => sess()['id'],
            'create_date'   => date('Y-m-d'),
            'status'        => '0'
        ];
        $result  = $this->db->insert('temuan',$data);
        if ($result) {
            $response=[
                'code' => '200',
                'msg'    =>  'Data Berhasil Di Simpan'
            ];
        }else{
            $response=[
                'code'      => '500',
                'msg'    => 'Gagal Simpan Data'
            ];
        }
        echo json_encode($response);
    }

    public function Delete($id=null){
        
        $data = $this->Mod->GetCustome('SELECT * FROM temuan')->row_array();
        if ($data['status'] !=  1) {
            $response=[
                'code'      => '500',
                'msg'       => 'Gagal Dihapus, Data Sudah Dihapus'
            ];
        }else{
            $rest = $this->Mod->delete('terminal', array('id' =>$id ));
            if ($rest) {
                $response=[
                    'code' => '200',
                    'msg'    =>  'Data Berhasil Di Hapus'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    => 'Gagal Dihapus'
                ];
            }
        }
        echo json_encode($response);
      
    }

    function ProsesData($id=null){
        if (!empty($id)) {
            $data= [ 
                'status' => '1'
            ];
            $temuan = $this->Mod->getWhere('temuan',array('id_temuan' =>$id))->row_array();
            
            
            if (!empty($temuan) || $temuan['kondisi']=='OFF' ){
                if ( !empty($temuan['id_fasilitas'])){
                    $fasilitas = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$temuan['id_fasilitas']))->row_array();
           
                    if(empty($fasilitas)){
                         $response=[
                            'code'      => '500',
                            'msg'       => 'Gagal Proses Data, Fasilitas Tidak ditemukan atau sudah dihapus'
                        ];
                    }else{
                        
                    
                        $fasilitas = ['status' => '0'];
                        $this->Mod->update2('fasilitas', array('id_fasilitas' => $temuan['id_fasilitas']),$fasilitas);
                    
                        $result = $this->Mod->update2('temuan', array('id_temuan' => $id),$data);
                        if ($result) {
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
                    }

                }else{
                 $response=[
                    'code'      => '500',
                    'msg'    => 'Tidak Fasilitas yang dipilih'
                 ];    
                }
                
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    => 'Gagal Proses Data,Data tidak ada'
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

    function DeleteData($id=null){
        if (!empty($id)) {
            $data= [ 
                'status' => '8'
            ];
            $result = $this->Mod->update2('temuan', array('id_temuan' => $id),$data);

           
            if ($result) {
                $response=[
                    'code' => '200',
                    'msg'    =>  'Data Berhasil Di Hapus'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    => 'Gagal Hapus Data'
                ];
            }
        }else{
            $response=[
                'code'      => '500',
                'msg'    =>  'Gagal Hapus Data'
            ];
        }
       
        echo json_encode($response);
    }

    function Getemuan(){
        if (!empty(sess()['id_lokasi'])) {
            $param= " AND a.id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT  a.id_temuan,b.nama_fasilitas
            FROM temuan a LEFT JOIN fasilitas b on b.id_fasilitas = a.id_fasilitas  where a.id_unit = '".sess()['unit']."' $param AND a.status = '1' AND NOT EXISTS (SELECT * FROM tinjut d WHERE d.id_temuan = a.id_temuan AND status = '1') AND b.nama_fasilitas like '%$serc%' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT  a.id_temuan,b.nama_fasilitas
            FROM temuan a LEFT JOIN fasilitas b on b.id_fasilitas = a.id_fasilitas  where a.id_unit = '".sess()['unit']."' $param AND a.status = '1' AND NOT EXISTS (SELECT * FROM tinjut d WHERE d.id_temuan = a.id_temuan AND status = '1')  limit 10")->result_array();   
        }

        $data=[];
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['nama_fasilitas'],
				'id'	=> $value['id_temuan']
			];
		}
		echo json_encode($data);
    }

function Getemuan2(){
    $serc   = trim($this->input->post('serc', true));
    $unit   = sess()['unit'];
    $lokasi = !empty(sess()['id_lokasi']) ? "AND a.id_lokasi = '".sess()['id_lokasi']."'" : "";

    // WAJIB LIMIT
    $limit = 20;

    if ($serc !== '') {
        $sql = "
            SELECT 
               a.id_temuan as id,b.nama_fasilitas as text
            FROM temuan a LEFT JOIN fasilitas b on b.id_fasilitas = a.id_fasilitas 
            WHERE
             a.id_unit = '".sess()['unit']."' $lokasi AND a.status = '1' AND NOT EXISTS (SELECT * FROM tinjut d WHERE d.id_temuan = a.id_temuan AND status = '1') AND b.nama_fasilitas like ?
            LIMIT $limit
        ";

        $query = $this->db->query($sql, ["%{$serc}%"])->result_array();
    } else {
        $sql = "SELECT  a.id_temuan,b.nama_fasilitas
            FROM temuan a LEFT JOIN fasilitas b on b.id_fasilitas = a.id_fasilitas  where a.id_unit = '".sess()['unit']."' $lokasi 
            AND a.status = '1' AND NOT EXISTS (SELECT * FROM tinjut d WHERE d.id_temuan = a.id_temuan AND status = '1') AND b.nama_fasilitas like ?  limit 10
        ";

        $query = $this->db->query($sql)->result_array();
    }

    echo json_encode([
        'results' => $query
    ]);
       
	
    }
   
   function ViewData($id=null){
    if (!empty($id)) {
        $data       = $this->m_data->getWhere('temuan',array('id_temuan' =>$id ))->row_array();
        $fasilitas  = $this->m_data->getWhere('fasilitas',array('id_fasilitas' =>$data['id_fasilitas'] ))->row_array();
        $data['nama_fasilitas'] = $fasilitas['nama_fasilitas'];
        $data['tanggal_l'] = tgl($data['tanggal'],'sm');
        
        echo json_encode($data);
    }else{
        echo "kosong";
    }
   }

   function SinTemuan(){
    $temuan = $this->Mod->getWhere('temuan',array('status !=' =>8 ))->result_array();
    foreach ($temuan as $key => $value) {
        # code...
        $fasilitas = $this->Mod->getWhere('fasilitas',array('nama_fasilitas' =>$value['nama_fasilitas'],'id_lokasi' => $value['id_lokasi'],'id_unit'=> $value['id_unit']))->row_array();
        if (!empty($fasilitas)) {
            $update['id_fasilitas']= $fasilitas['id_fasilitas'];
            if ($temuan['status']==0 ) {
                 $update['kondisi']= 'OFF';
            }
            $result = $this->Mod->update2('temuan', array('id_temuan' => $value['id_temuan']),$update);

             echo "<pre>",print_r ( $update),"</pre>";
            # code...
        }
        echo "<pre>",print_r ( $value),"</pre>";
    }
   }
   
   function TesTemuan(){
         $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "Temuan Lapangan";
        $data["title_des"] = " Page Tes Temuan";
        $data["content"] = "v_index2";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
   }
   
public function SetFasilitas2($id = null)
{
    $data = [];

    if (!empty($id)) {

        $query = $this->Mod->GetCustome2(
            "
            SELECT 
                a.id_fasilitas AS id,
                c.nama AS text
            FROM temuan a
            LEFT JOIN fasilitas b ON b.id_fasilitas = a.id_fasilitas
            LEFT JOIN fasilitas_catagory c ON c.id_catagory = b.id_catagory
            WHERE a.id_temuan = ?
            ",
            [$id]
        )->result_array();

        if (!empty($query)) {
            foreach ($query as $row) {
                $data[] = [
                    'id'   => $row['id'],
                    'text' => $row['text']
                ];
            }
        }
    }

    // Header JSON (penting untuk AJAX)
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

function SetFasilitas($id=null){
        $data=[];
        if (!empty($id)) {
			$query =  $this->Mod->GetCustome("SELECT  a.id_fasilitas,c.nama
            FROM temuan a 
            LEFT JOIN 
                fasilitas b
            ON 
                b.id_fasilitas = a.id_fasilitas
            LEFT JOIN 
                fasilitas_catagory c
            ON 
                c.id_catagory = b.id_catagory 
            WHERE  
                a.id_temuan = '$id'")->row_array();    
            $data=[
                'text'	=> $query['nama'],
                'id'	=> $query['id_fasilitas']
            ];	
        }

       
		echo json_encode($data);
    }
}