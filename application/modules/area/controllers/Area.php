<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Area extends CI_Controller{

	public function __construct (){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->role();
	}
			
	public function role() {
		$url = urlencode(current_url());
		if (session("username") == "") {
			redirect(base_url('login/auth'));
		}
	}

	public function index(){
		$data["plugin"][] = "plugin/datatable";
		$data["plugin"][] = "plugin/select2";
		$data["title"] = "area";
		$data["title_des"] = " List Data area";
		$data["content"] = "v_index";
		$data["data"] = $data;
		$data["lokasi"] = $this->Mod->getWhere("terminal",array('status !=' => '8'))->result_array();
        // echo "<pre>",print_r ($data),"</pre>";
		$this->load->view('template_v2', $data);	
	}	

	
	public function LoadArea(){
		$data=$this->Mod->getWhere("area",array('status !=' => '8'))->result_array();
        echo json_encode($data);	
	}

	public function GetListArea(){
		if (!empty($_POST['catagory'])) {
            $id_catagory =" AND b.id_catagory = '".$_POST['catagory']."'";
        }else{
            $id_catagory =" ";
        }

		if (!empty(sess()['id_lokasi'])) {
			$id_lokasi =" AND b.id_lokasi = '".sess()['id_lokasi']."'";
        
		}else{
            $id_lokasi =" ";
        }
        $data    =  $this->Mod->GetCustome("SELECT a.id_area,a.nama_area 
											FROM 
												area a 
											LEFT JOIN
												fasilitas b 
											ON 
												b.id_area = a.id_area
											WHERE 
											b.status != 8
												$id_catagory
												$id_lokasi
											GROUP by 
												a.nama_area
											ORDER BY 
											a.nama_area ASC")->result_array();
      
        echo json_encode($data);	
	}
	
	public function LoadData($from=null){
		if(isset($_POST['limit'])) {
			$limit = $_POST['limit'];
		} else {
			$limit = 3000; 
		}
		if(isset($_POST['src'])) {
			$src = $_POST['src'];
		} else {

			$src = ''; 
		}  
		
		if(isset($_POST['jenis_perangkat'])) {
			$jenis = $_POST['jenis_perangkat'];
		} else {
			$jenis = ''; 
		}
		$from               = $this->uri->segment(3);
	
		$param=[
			'table'         => 'area' ,
			'pk'            => 'id_area' ,
			'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
			'url'           => $this->uri->segment(2) ,
			'from'          => $from ,
			'limit'         => $limit ,
			'src'           => $src,
			'filter'        => (!empty($jenis) ? array('id_lokasi'=> $jenis):'') ,
			'param_src'     => [
								'like' => 'nama_area']
		];
		$totalData          = CountDataPag($param);
		$param['total_data'] = $totalData;
		$param['total_page'] = ceil($totalData/$limit);
		$res                = pagin($param);
		$data['data']  = $res['data'];
		$data['pag']        = $res['pag'];
		echo json_encode($data);		
	}

	public function SaveData() {
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			
			$data['status'] = 0;
			$data['id_unit'] =sess()['unit'];
			if ( $this->db->insert('area',$data)) {
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Save'
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
				'msg'       =>  'Tidak ada data yang diubah'
			];
		}
		echo json_encode($response);
	   
	}

	function UpdateData($id=null){
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			
			$data['status'] = 0;
			$data['id_unit'] =sess()['unit'];
			if ( $this->db->insert('area',$data)) {
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Save'
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
				'msg'       =>  'Tidak ada data yang diubah'
			];
		}
		echo json_encode($response);
	}
	
	function ProsesData($id=null){
		if (!empty($id)) {
			$data= [ 
				'status' => '1'
			];
			$result = $this->Mod->update2('area', array('id_tinjut' => $id),$data);
			
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
		}else{
			$response=[
				'code'      => '500',
				'msg'    =>  'Gagal Proses Data'
			];
		}
	   
		echo json_encode($response);
	}
			
    
			
}
		