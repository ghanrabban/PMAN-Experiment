<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Monitoring extends CI_Controller{

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
		$data["title"] = "Monitoring";
		$data["title_des"] = " List Data Monitoring";
		$data["content"] = "v_index";
		$data["data"] = $data;
		$data["unit"] 	=  $this->Mod->GetCustome("SELECT * From unit Where status != 8")->result_array();
		$data["lokasi"] =  $this->Mod->GetCustome("SELECT * From terminal Where status != 8 and parent_id= '-1' AND code !='0'")->result_array();
		
		$this->load->view('template_v2', $data);	
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
			'table'         => 'monitoring_pekerjaan' ,
			'pk'            => 'id_monitoring' ,
			'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
			'url'           => $this->uri->segment(2) ,
			'from'          => $from ,
			'limit'         => $limit ,
			'src'           => $src,
			'filter'        => (!empty($jenis) ? array('id_catagory'=> $jenis):'') ,
			'param_src'     => [
								'like' => 'nama_fasilitas',
								'or_like'=> 'ip_address']
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
		//  echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			
			$data['status'] = 0;
			$data['id_unit'] =sess()['unit'];
			if ( $this->db->insert('monitoring_pekerjaan',$data)) {
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
			// if ( $this->db->insert('monitoring_pekerjaan',$data)) {
			// 	$response=[
			// 		'code'      => '200',
			// 		'msg'       =>  'Data Save'
			// 	];
			// }else{
			// 	$response=[
			// 		'code'      => '500',
			// 		'msg'       =>  'Coba lagi beberapa waktu'
			// 	];
			// }
			
		}else{
			$response=[
				'code'      => '500',
				'msg'       =>  'Tidak ada data yang diubah'
			];
		}
		echo json_encode($response);
	}
	public function DeleteData($id=null){
        
        $data = $this->Mod->GetCustome("SELECT * FROM monitoring_pekerjaan Where id_monitoring='".$id."' ")->row_array();
        if ($data['status'] ==  1) {
            $response=[
                'code'      => '500',
                'msg'       => 'Gagal Dihapus, Data Sudah Diproses'
            ];
        }else{
            $rest = $this->Mod->delete('monitoring_pekerjaan', array('id_monitoring' =>$id ));
            if ($rest) {
                $response=[
                    'code' 		=> '200',
                    'msg'    	=>  'Data Berhasil Di Hapus'
                ];
            }else{
                $response=[
                    'code'      => '500',
                    'msg'    	=> 'Gagal Dihapus'
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
			$result = $this->Mod->update2('monitoring_pekerjaan', array('id_monitoring' => $id),$data);
			
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

	function GetPelaksana(){

		$data=array();
		$serc= $this->input->get('serc');
		
		$result= $this->Mod->GetCustome("SELECT pelaksana_pekerjaan From monitoring_pekerjaan Where pelaksana_pekerjaan  like '%".$serc."%'Group By pelaksana_pekerjaan")->result_array();
		foreach ($result as $key => $value) {
			$data[]=array('id'=>$value['pelaksana_pekerjaan'],'text'=>$value['pelaksana_pekerjaan']);
		}
		echo json_encode($data);
	}
	
	function GetstatusPembayaran(){

		$data=array();
		$serc= $this->input->get('serc');
		
		$result= $this->Mod->GetCustome("SELECT status_pembayaran From monitoring_pekerjaan Where status_pembayaran  like '%".$serc."%'Group By pelaksana_pekerjaan")->result_array();
		foreach ($result as $key => $value) {
			$data[]=array('id'=>$value['status_pembayaran'],'text'=>$value['status_pembayaran']);
		}
		echo json_encode($data);
	}

	function GetstatusPekerjaan(){

		$data=array();
		$serc= $this->input->get('serc');
		
		$result= $this->Mod->GetCustome("SELECT status_pekerjaan From monitoring_pekerjaan Where status_pekerjaan  like '%".$serc."%'Group By pelaksana_pekerjaan")->result_array();
		foreach ($result as $key => $value) {
			$data[]=array('id'=>$value['status_pekerjaan'],'text'=>$value['status_pekerjaan']);
		}
		echo json_encode($data);
	}

	function Detail($id){
		$data["plugin"][] = "plugin/datatable";
		$data["plugin"][] = "plugin/select2";
		$data["title"] = "Monitoring";
		$data["title_des"] = " List Data Monitoring";
		$data["content"] = "v_detail";
		$data["data"] = $data;
		$data["unit"] 	=  $this->Mod->GetCustome("SELECT * From unit Where status != 8")->result_array();
		$data["lokasi"] =  $this->Mod->GetCustome("SELECT * From terminal Where status != 8 and parent_id= '-1' AND code !='0'")->result_array();
		$data["id"] = $id;
		$this->load->view('template_v2', $data);	
	}
			
	function load($page = null, $id = null) {
        $data["title"] = "Monitoring $page";
		$data["title_des"] = " List Data Monitoring";
        $data["content"] = $page;
        $data['id'] = $id;
        $data["unit"] = '';

        $this->load->view($page, $data);
    }
}
		