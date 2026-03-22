<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Monitoring_xray extends CI_Controller{

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
		$data["title"] = "monitoring_xray";
		$data["title_des"] = " List Data monitoring_xray";
		$data["content"] = "v_index";
		$data["data"] = $data;
	
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
		
		if(isset($_POST['tgl'])) {
			$jenis = $_POST['tgl'];
		} else {
			$jenis = ''; 
		}

		
      
		$from               = $this->uri->segment(3);
	
		$param=[
			'table'         => 'monitoring' ,
			'pk'            => 'id_monitoring' ,
			'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
			'url'           => $this->uri->segment(2) ,
			'from'          => $from ,
			'limit'         => $limit ,
			'src'           => $src,
			'filter'        => (!empty($jenis) ? array('tanggal'=> $jenis):'') ,
			'order'				=>'tanggal DESC',
			'param_src'     => [
								'like' => 'nama_fasilitas',
								]
		];
		$param_grafik['status'] =1;
		 if (sess()['id_lokasi'] !== null ) {
          
            $param['parameter']+=array('id_lokasi'=> sess()['id_lokasi']);
			$param_grafik['id_lokasi'] =sess()['id_lokasi'];
            //array_push( ,);
        }
		$totalData          = CountDataPag($param);
		$param['total_data'] = $totalData;
		$param['total_page'] = ceil($totalData/$limit);
		$res                = pagin($param);
		 
		foreach ($res['data'] as $key => $value) {
			$detail = $this->Mod->GetCustome("SELECT a.*,b.id_perangkat,b.serial_number FROM monitoring_detail a left join perangkat b on b.id_perangkat = a.id_perangkat WHERE a.id_monitoring= '".$value['id_monitoring']."'")->result_array();
            foreach ($detail as $key2 => $value2) {
				$posisi 	= $this->Mod->getWhere('perangkat_detail',array('id_perangkat' =>$value2['id_perangkat']))->row_array();
				$detail[$key2]['posisi'] = (empty($posisi['nama']) ? '': $posisi['nama']);
				$detail[$key2]['nilai_cek'] = $value2['nilai_kv'].'/'.$value2['nilaim_ma'];
			}

			$fasilitas 	= $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$value['id_fasilitas']))->row_array();
			
			//$catagory 	= $this->Mod->getWhere('fasilitas_catagory',array('id_catagory' =>$fasilitas['id_catagory']))->row_array();
	
		//	$res['data'][$key]['nama_catagory'] 	= '';//$catagory['nama'];
			$res['data'][$key]['tanggal_l'] 		= tgl($value['tanggal'],'sm').' ('.(empty($value['shift'])? '-':l_sh($value['shift'])['name'] ).')';
			

			$res['data'][$key]['nilia_cek'] 		= (empty($value['nilai_kv'])? '-':$value['nilai_kv']).'/'.(empty($value['nilaim_ma'])? '-':$value['nilaim_ma']);
			$res['data'][$key]['status_l'] 			= (empty($value['status'])? '-':stg($value['status']));
			$res['data'][$key]['detail'] 			=	$detail;	
		}

		
		
		$data['data']  	= $res['data'];
		$data['pag']	= $res['pag'];
		echo json_encode($data);		
	}

	public function SaveData() {
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			$fasilitas 	= $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$_POST['id_fasilitas']))->row_array();
			unset($data['items']);
			$data['status'] 		= 0;
			$data['id_unit'] 		= sess()['unit'];
			$data['create_by'] 		= sess()['nama'];
			$data['create_date'] 	= date('Y-m-d');
			$data['shift'] 			= GetShift()['shift'];
			$data['id_lokasi']		= (empty(sess()['id_lokasi']) ? $fasilitas['id_lokasi']: sess()['id_lokasi']);
			$data['nama_fasilitas']	= (empty($fasilitas ) ? '': $fasilitas['nama_fasilitas']);
			
			if ($this->db->insert('monitoring',$data)) {
				$id_monitoring = $this->db->insert_id();
				foreach ($_POST['items'] as $key => $value) {
					$insert_detail=[
							'id_monitoring'		=> $id_monitoring,
							'id_perangkat'		=> $value['id_perangkat'],
							'posisi' 			=> $value['posisi'],
							'waktu' 			=> $value['waktu'],
							'nilai_kv' 			=> $value['nilai_kv'],
							'nilaim_ma' 		=> $value['nilaim_ma'],
						];	
				$this->db->insert('monitoring_detail',$insert_detail);
				$response=[
						'code'      => '200',
						'msg'       =>  'Data Save'
					];
				}
				
			}
			else{
					$response=[
						'code'      => '500',
						'msg'       =>  'Coba lagi beberapa waktu'
					];
			}
				
		}else{
			$response=[
				'code'      => '500',
				'msg'       =>  'Tidak Dapat Disimpan Karna Tidak Lengkap'
			];
		}
		echo json_encode($response);
	   
	}

	function UpdateData($id=null){

		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			$fasilitas 	= $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$_POST['id_fasilitas']))->row_array();
			unset($data['Updateitems']);
			unset($data['items']);
			$data['status'] 		= 0;
			$data['id_unit'] 		= sess()['unit'];
			$data['create_by'] 		= sess()['nama'];
			$data['create_date'] 	= date('Y-m-d');
		
			
			if ($this->Mod->update2('monitoring', array('id_monitoring' => $id),$data)) {
				
				$del= array();
				if (isset($_POST['Updateitems'])) {
					foreach ($_POST['Updateitems'] as $key => $value) {
						$update_detail=[
								'waktu' 			=> $value['waktu'],
								'nilai_kv' 			=> $value['nilai_kv'],
								'nilaim_ma' 		=> $value['nilaim_ma'],
								

							];	
						$this->Mod->update2('monitoring_detail', array('id_monitoring' => $id,'id_detail'=> $value['id_detail']),$update_detail);
						$del[]=$value['id_detail'];
					}
				}
				
				if (isset($_POST['items'])) {
					foreach ($_POST['items'] as $key => $value) {
						$insert_detail=[
								'id_monitoring'		=> $id,
								'id_perangkat'		=> $value['id_perangkat'],
								'posisi' 			=> $value['posisi'],
								'waktu' 			=> $value['waktu'],
								'nilai_kv' 			=> $value['nilai_kv'],
								'nilaim_ma' 		=> $value['nilaim_ma'],
								

							];	
						$this->db->insert('monitoring_detail',$insert_detail);
						$id_detail= $this->db->insert_id();
						$del[]=$id_detail;
				}

				if (isset($del)) {
					foreach ($del as $key => $value) {
						$this->Mod->delete('monitoring_detail',array('id_detail'=>$value));
					}
				}
				// echo "<pre>",print_r ($del),"</pre>";
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Update'
				];
				}
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
		$error=[];
		if (!empty($id)) {
			$fild 	= $this->Mod->getData("monitoring")->list_fields();
			
			$cek 	= $this->Mod->getWhere('monitoring',array('id_monitoring' =>$id))->row_array();
			foreach ($fild as $key => $value) {
				
				if ($cek[$value] =="") {
					$error[]='Data Tidak Lengkap'.$value;
				}
			}

			if (!$error) {
				$data= [ 
					'status' => '1'
				];
				$result = $this->Mod->update2('monitoring', array('id_monitoring' => $id),$data);
				
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
						'msg'    	=> 'Data Tidak Lengkap',
						'err'		=> $error
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

	public function DeleteData($id=null){
        $data=['status'=> 8];
        $res_update = $this->Mod->update2('monitoring',array('id_monitoring' =>$id ), $data);
           
        $res=[
            'status' => '200',
            'msg'       => 'Data Berhasil di Hapus'
        ];


        echo json_encode($res);
    }

	function EditData($id=null){
		if (!empty($id)) {
			$data           = $this->Mod->GetCustome("SELECT * FROM monitoring a where id_monitoring = '".$id."'")->row_array();
			$detail         = $this->Mod->GetCustome("SELECT * FROM fasilitas where id_fasilitas = '".$data['id_fasilitas']."'")->row_array();
			$m_detail       = $this->Mod->GetCustome("SELECT a.*,b.nama_perangkat FROM monitoring_detail a LEFT JOIN perangkat b ON b.id_perangkat = a.id_perangkat where a.id_monitoring = '".$data['id_monitoring']."'")->result_array();
			
			$data['fasilitas'] =['id'=> $detail['id_fasilitas'],'text'=> $detail['nama_fasilitas']];
			$data['detail'] = $m_detail;
		}else{
			$data=array();
		}
       
        echo json_encode($data);
    }

	function GetFasilitasBy(){
       
        if (!empty(sess()['id_lokasi'])) {
            $param= " AND id_lokasi ='".sess()['id_lokasi']."'";
        }else{
            $param="";
        }

        $serc       = $this->input->post('serc');
      
        if (!empty($serc) ) {
            
			$query =  $this->Mod->GetCustome("SELECT *
            FROM fasilitas where id_unit = '".sess()['unit']."' $param AND status = '1'  AND id_catagory= '70' AND nama_fasilitas like '%$serc%' ")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT *
            FROM fasilitas where id_unit = '".sess()['unit']."' $param AND status = '1'  AND id_catagory= '70' ")->result_array(); 
		}
        $data=[];
		foreach ($query as $key => $value) {
			// 
			$data[]=[
				'text'	=> $value['nama_fasilitas'],
				'id'	=> $value['id_fasilitas']
			];
		}
		echo json_encode($data);
    
    }

	function SetPerangkat($id){
 		$data=[];
        if (!empty($id)) {
			$query =  $this->Mod->GetCustome("SELECT c.*,e.*
            FROM fasilitas a 
			LEFT JOIN 
			fasilitas_detail b 
			ON b.id_fasilitas  = a.id_fasilitas 
			LEFT JOIN 
			perangkat c 
			ON c.id_perangkat = b.id_perangkat 
			LEFT JOIN perangkat_detail e
			on e.id_perangkat = c.id_perangkat
			LEFT JOIN master_perangkat_detail d 
			ON d.idmaster_detail_perangkat = e.idmaster_detail_perangkat
			WHERE a.id_fasilitas = '$id' AND c.id_jenisperangkat = '405'")->result_array();    
            $data=$query ;	
        }

		echo json_encode($data);
	}
			
			
}
		