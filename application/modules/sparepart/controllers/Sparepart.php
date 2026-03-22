<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Sparepart extends CI_Controller{

	public function __construct (){
		parent::__construct();
		$this->load->library('Excel');
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
		$data["title"] = "Sparepart";
		$data["title_des"] = " List Data Sparepart";
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

		if(isset($_POST['jenis_perangkat'])) {
			$jenis = $_POST['jenis_perangkat'];
		} else {
			$jenis = ''; 
		}
		$from               	= $this->uri->segment(3);
	
		$param=[
			'table'         	=> 'sparepart' ,
			'pk'            	=> 'id_barang' ,
			'parameter'     	=> array('status !=' => 8) ,
			'url'           	=> $this->uri->segment(2) ,
			'from'          	=> $from ,
			'limit'         	=> $limit ,
			'src'           	=> $src,
			'filter'        	=> (!empty($jenis) ? array('katagori_barang'=> $jenis):'') ,
			'param_src'     	=> [
									'like' => 'nama_barang',
									'or_like'=> 'kode_barang'
									]
		];
		$totalData          	= CountDataPag($param);
		$param['total_data'] 	= $totalData;
		$param['total_page'] 	= ceil($totalData/$limit);
		$res                	= pagin($param);

		foreach ($res['data'] as $key => $value) {
			
			$res['data'][$key]['harga'] =rupiah($value['harga']);
			
		}
		$data['data']  = $res['data'];
		$data['pag']        = $res['pag'];
		echo json_encode($data);		
	}

	public function SaveData() {
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			
			$data['status'] = 0;
			if ( $this->db->insert('sparepart',$data)) {
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
			if ( $this->db->insert('tinjut_detail',$tinjut)) {
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
			$result = $this->Mod->update2('tinjut', array('id_tinjut' => $id),$data);
			
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

	function DeleteData($id=null){
        if (!empty($id)) {
			$update=[
				'status' => 8
			];
			$result = $this->Mod->update2('sparepart', array('id_barang' => $id),$update);
			   
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
	
	function permintaan(){
		$data["plugin"][] = "plugin/datatable";
		$data["plugin"][] = "plugin/select2";
		$data["title"] = "Permintaan Sparepart";
		$data["title_des"] = " List Data Permintaan Sparepart";
		$data["content"] = "v_permintaan";
		$data["data"] = $data;
	
		$this->load->view('template_v2', $data);	
	}

	public function LoadDataPermintaan($from=null){
		
		$conds = [];
		if(isset($_POST['bulan'])) {
			$conds[] = "MONTH(tanggal) = '" .$_POST['bulan'] . "'";
		} else {
			$jenis = ''; 
		}
		
		if(isset(sess()['id_lokasi'])) {
			$conds[] = "id_lokasi = '" .sess()['id_lokasi'] . "'";
		}
		if(isset(sess()['unit'])) {
			$conds[] = " id_unit= '" .sess()['unit'] . "'";
		}
		

		$param = '';
		if (count($conds)) {
            $param .= ' WHERE ' . implode(' AND ', $conds);
        }

		if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;
		$result = $this->Mod->GetCustome("SELECT * FROM sparepart_permintaan $param limit $start,$limit"); 
        $res =  $result->result_array();
    	foreach ($res as $key => $value) {
			$res[$key]['tanggal'] 	= tgl($value['tanggal'],'sm');
			$res[$key]['harga']	 	= rupiah($value['harga']);
			$res[$key]['total'] 	= rupiah($value['harga']*$value['qty']);
			
		}
        $data['data']       = $res;
        $from               = $this->uri->segment(3);
		$result_pag 		= $this->Mod->GetCustome("SELECT * FROM sparepart_permintaan $param "); 
        
        $total_data         = $result_pag->num_rows();
        $total_page         =  ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit,'PermintaanStok');
        echo json_encode($data);
	}

	function GetSumBulan(){
		
		$conds = [];
		if(isset($_POST['bulan'])) {
			$conds[] = "MONTH(tanggal) = '" .$_POST['bulan'] . "'";
		} else {
			$jenis = ''; 
		}
		$conds[]= 'status != 8';
		if(isset(sess()['id_lokasi'])) {
			$conds[] = "id_lokasi = '" .sess()['id_lokasi'] . "'";
		}
		if(isset(sess()['unit'])) {
			$conds[] = " id_unit= '" .sess()['unit'] . "'";
		}
		//  where status = 1 AND MONTH(tanggal)= 4 AND id_unit ='".sess()['unit']."' id_lokasi = '".sess()['id_lokasi'] ."'
		$param = '';
		if (count($conds)) {
            $param .= ' WHERE ' . implode(' AND ', $conds);
        }
		$query =  $this->Mod->GetCustome("SELECT id_unit,id_lokasi,sum(harga*qty) as total  FROM sparepart_permintaan $param")->row_array();  
		$query['total'] = rupiah($query['total']);
		echo json_encode($query );		
	}
	function GetBarang(){
		$data=array();
		$serc= $this->input->get('serc');
		if (!empty($serc)) {
			$result= $this->Mod->GetCustome("SELECT id_barang,CONCAT(kode_barang, '', nama_barang) as nama From sparepart Where kode_barang  like '%$serc%' OR nama_barang like '%$serc%'  Group By id_barang,nama_barang")->result_array();
			foreach ($result as $key => $value) {
				$data[]=array('id'=>$value['id_barang'],'text'=>$value['nama']);
			}
		}
		
		echo json_encode($data);
	}


	function detailbarang($id_barang = null){
		$data=array();
		if (!empty($id_barang)) {
			$data = $this->Mod->getWhere("sparepart", array('id_barang' => $id_barang))->row_array();

		}
		echo json_encode($data);
	}

	function EditDataPermintaan($id_permintaan = null){
		$data=array();
		if (!empty($id_permintaan)) {
			$query =  $this->Mod->GetCustome("SELECT a.idpermintaan,a.qty, b.nama_barang as nama
            FROM sparepart_permintaan a 
            LEFT JOIN 
                sparepart b
            ON 
                b.id_barang = a.id_barang
            WHERE  
                a.idpermintaan = '$id_permintaan'")->row_array();    
           
			$data['barang']=[
                'text'	=> $query['nama'],
                'id'	=> $query['idpermintaan'],
				
            ];	
			$data['qty'] =$query['qty'];
		}
		echo json_encode($data);
	}
	function SavePermintaan(){
		
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			$barang = $this->Mod->getWhere("sparepart", array('id_barang' =>$data['id_barang']))->row_array();
			
			$data['tanggal']		= date('Y-m-d');
			$data['nama_barang']	= $barang['nama_barang'];
			$data['harga']		= $barang['harga'];
			$data['id_unit']		= sess()['unit'];
			$data['id_lokasi']	= sess()['id_lokasi'];
			$data['qty']			= $data['qty'];
			$data['status']		= '0';
			
			if ( $this->db->insert('sparepart_permintaan',$data)) {
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

	function UpdateDataPermintaan($id_permintaan=null){
	
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			$barang = $this->Mod->getWhere("sparepart", array('id_barang' =>$data['id_barang']))->row_array();
			
			$data['tanggal']		= date('Y-m-d');
			$data['nama_barang']	= $barang['nama_barang'];
			$data['harga']			= $barang['harga'];
			$data['id_unit']		= sess()['unit'];
			$data['id_lokasi']		= sess()['id_lokasi'];
			$data['qty']			= $data['qty'];
			$data['status']			= '0';
			
			if ( $this->Mod->update2('sparepart_permintaan',array('idpermintaan' =>$id_permintaan),$data)) {
				
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
	function ProsesDataPermintaan($id_permintaan=null){
	
		
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($id_permintaan)) {
			
			$data['status']			= 1;
			if ( $this->Mod->update2('sparepart_permintaan',array('idpermintaan' =>$id_permintaan,'id_unit' => sess()['unit']),$data)) {
				
				$query =  $this->Mod->GetCustome("SELECT a.id_lokasi,a.idpermintaan,a.qty,a.id_barang, b.nama_barang as nama
				FROM sparepart_permintaan a 
				LEFT JOIN 
					sparepart b
				ON 
					b.id_barang = a.id_barang
				WHERE  
					a.idpermintaan = '$id_permintaan'")->row_array();  
				$cek = $this->Mod->getWhere('sparepart_stok',array('id_barang' =>$query['id_barang'],'id_lokasi'=> sess()['id_lokasi'],'id_unit'=> sess()['unit']))->row_array();
				if (empty($cek)) {
					$stok =[
						'id_barang'		=> $query['id_barang'],
						'id_unit' 		=> sess()['unit'],
						'id_lokasi'  	=> $query['id_lokasi'],
						'update_date'	=> date('Y-m-d'),
						'stok'			=> $query['qty'],
						'status'		=> 1
					];  

					$this->db->insert('sparepart_stok',$stok);
				}else{
					$stok =[
						
						'update_date'	=> date('Y-m-d'),
						'stok'			=> $cek['stok']+$query['qty'],
						'status'		=> 1
					];  
					$this->Mod->update2('sparepart_stok',array('id_stok' =>$cek['id_stok'],'id_lokasi' => $query['id_lokasi']),$stok);
				}
				
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
	
	function DeleteDataPermintaan($id=null){
        if (!empty($id)) {
            $result = $this->Mod->delete('sparepart_permintaan', array('idpermintaan' =>$id ));
                   
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

	function LoaderSparepart(){
		if(isset($_FILES["filelampiran"]["name"])){
			$path = $_FILES["filelampiran"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
       
			
            $data           = array(); 
            $error          = array();
            $insert         = array();
            $datainsert     = array();
             
			foreach($object->getWorksheetIterator(1) as $worksheet => $value){
			    $highestRow = $value->getHighestRow();
              
                $lastColumn = $value->getHighestDataColumn(); 
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($lastColumn);
          
                    if ($worksheet == 0) {
                       
                        for ($row=6; $row <=$highestRow ; $row++) { 
                            $kode             	= $value->getCellByColumnAndRow(1, $row)->getValue();
                            $jenis				= $value->getCellByColumnAndRow(2, $row)->getValue();
                            $katagori           = $value->getCellByColumnAndRow(3, $row)->getValue();
                            $satuan         	= $value->getCellByColumnAndRow(4, $row)->getValue();
							$harga         		= $value->getCellByColumnAndRow(5, $row)->getValue();
                           
									$insert[]=[
										'kode_barang'          	=> $kode ,
										'nama_barang'          	=> $jenis ,
										'katagori_barang'		=> $katagori,
										'satuan'				=> $satuan,
										'harga'             	=> $harga,
										'status'            	=> 1,
								
									];
                                
                        }
                        
                    }
         
             
            }
           
            if (count($error) > 1) {
                echo "<pre>",print_r ( $error),"</pre>";
            }else{
				echo "<pre>",print_r ( $insert),"</pre>";
                foreach ($insert as $key => $value) {
                    $cek        = $this->Mod->getWhere('sparepart',array('status != ' =>8,'nama_barang'=> $value['nama_barang']))->row_array();
					if (!empty( $cek)) {
						$this->Mod->update2('sparepart',array('id_barang' =>$cek['id_barang']),$value);
					}else{
						$this->db->insert('sparepart',$value);
					}
                   
                }
               
                
            }

            
        }
	}

	function stok(){
		$data["plugin"][] = "plugin/datatable";
		$data["plugin"][] = "plugin/select2";
		$data["title"] = "Stok Sparepart";
		$data["title_des"] = " List Data Stok Sparepart";
		$data["content"] = "v_stok";
		$data["data"] = $data;
	
		$this->load->view('template_v2', $data);	
	}



	public function LoadDataStok($from=null){
		// if(isset($_POST['limit'])) {
		// 	$limit = $_POST['limit'];
		// } else {
		// 	$limit = 3000; 
		// }
		// if(isset($_POST['src'])) {
		// 	$src = $_POST['src'];
		// } else {

		// 	$src = ''; 
		// }  
		
		// if(isset($_POST['jenis_perangkat'])) {
		// 	$jenis = $_POST['jenis_perangkat'];
		// } else {
		// 	$jenis = ''; 
		// }
		// $from               = $this->uri->segment(3);
	
		// $param=[
		// 	'table'         => 'sparepart_stok' ,
		// 	'pk'            => 'id_stok' ,
		// 	'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
		// 	'url'           => $this->uri->segment(2) ,
		// 	'from'          => $from ,
		// 	'limit'         => $limit ,
		// 	'src'           => $src,
		// 	'filter'        => (!empty($jenis) ? array('katagori_barang2'=> $jenis):'') ,
		// 	'param_src'     => [
		// 						'like' => 'nama_barang',	]
		// ];
		// if (sess()['id_lokasi'] !== null ) {
          
        //     $param['parameter']+=array('id_lokasi'=> sess()['id_lokasi']);
        //     //array_push( ,);
        // }
		// $totalData          	= CountDataPag($param);
		// $param['total_data'] 	= $totalData;
		// $param['total_page'] 	= ceil($totalData/$limit);
		// $res                	= pagin($param);
		// foreach ($res['data'] as $key => $value) {

		// 	$barang =   $this->Mod->getWhere('sparepart',array('id_barang'=> $value['id_barang']))->row_array();
		// 	$res['data'][$key]['barang'] = $barang['nama_barang'];
		// 	$res['data'][$key]['satuan'] = $barang['satuan'];
		// 	$res['data'][$key]['tanggal'] =tgl($value['update_date'],'sm');
		
		// }
		
		// $data['data']  		= $res['data'];
		// $data['pag']        = $res['pag'];

		if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;

        if (!empty(sess()['id_lokasi'])) {
            $param = "AND a.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }

		if(isset($_POST['src'])) {
            $src = "AND b.nama_barang like '%".$_POST['src']."%' ";
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ' '; 
        }

		$res   = $this->Mod->GetCustome("SELECT 
		a.*,b.nama_barang as barang,b.satuan
		FROM 
			sparepart_stok a  
		left join 
			sparepart b 
		on 
			b.id_barang = a.id_barang
		WHERE 
			a.status != 8 AND a.id_unit='".sess()['unit']."' $param $src ORDER BY a.id_stok DESC limit $start,$limit");
		$result =$res->result_array();
		foreach ($result as $key => $value) {
			$result[$key]['tanggal'] =tgl($value['update_date'],'sm');
		}
		$data['data']       = $result;
			
		$total_data         =  $res->num_rows();

		$total_page         = ceil($total_data/$limit);
		
		$data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
		echo json_encode($data);
		
	}

	function LoadHistoryStok(){
		if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;

        if (!empty(sess()['id_lokasi'])) {
            $param = "AND a.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }

		if(isset($_POST['src'])) {
            $src = "AND b.nama_barang like '%".$_POST['src']."%' ";
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ' '; 
        }

		$res   = $this->Mod->GetCustome("SELECT 
		a.*,b.nama_barang as barang,b.satuan
		FROM 
			sparepart_penggunaan a  
		left join 
			sparepart b 
		on 
			b.id_barang = a.id_barang
		WHERE 
			a.status != 8 AND a.id_unit='".sess()['unit']."' $param $src ORDER BY a.id_penggunaan DESC limit $start,$limit");
		$result =$res->result_array();
		foreach ($result as $key => $value) {
			$result[$key]['tanggal'] =tgl($value['tanggal'],'sm');
		}
		$data['data']       = $result;
			
		$total_data         =  $res->num_rows();

		$total_page         = ceil($total_data/$limit);
		
		$data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
		echo json_encode($data);
	}

	

	function GetStok(){
		if (!empty(sess()['id_lokasi'])) {
            $param = "AND a.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }

		$data=array();
		$serc= $this->input->get('serc');
		if (!empty($serc)) {
			$result= $this->Mod->GetCustome("SELECT 
												a.id_barang,CONCAT(b.kode_barang, '- ', b.nama_barang) as nama 
											From
												sparepart_stok a 
											LEFT JOIN
												sparepart  b
											ON 
												b.id_barang = a.id_barang
											WHERE  
													a.id_unit = '".sess()['unit']."' $param
												 AND (b.kode_barang  like '%$serc%' OR b.nama_barang like '%$serc%')  Group By a.id_barang,b.nama_barang")->result_array();
			foreach ($result as $key => $value) {
				$data[]=array('id'=>$value['id_barang'],'text'=>$value['nama']);
			}
		}
		
		echo json_encode($data);
	}

	public function SavePenggunaan() {
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			
			
			$data['id_unit'] 		= sess()['unit'];
			$data['id_lokasi'] 		= sess()['id_lokasi'];
			$data['create_by'] 		= sess()['nama'];
			$data['create_date'] 	= date('Y-m-d');
			$data['status'] 		= 0;
			
			$data['id_barang'] 		= $data['id_barang_penggunaan'];
			unset($data['id_barang_penggunaan']);
			
			
			if ( $this->db->insert('sparepart_penggunaan',$data)) {
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
			// $response=[
			// 	'code'      => '500',
			// 	'msg'       =>  'Tidak ada data yang diubah'
			// ];
		}
		echo json_encode($response);
	   
	}
	function ProsesPenggunaan($id_penggunaan=null){
		if (!empty($id_penggunaan)) {
			$cek        = $result= $this->Mod->GetCustome("SELECT b.id_barang, b.stok ,a.qty
								FROM 
									sparepart_penggunaan a 
								LEFT JOIN
									sparepart_stok b 
								ON 
									b.id_barang=  a.id_barang 
								WHERE 
									a.id_penggunaan  = '$id_penggunaan'")->row_array();
			if ($cek['qty'] > $cek['stok']) {
				$response=[
					'code'      => '400',
					'msg'       =>  'Data Tidak Bisa di proses, stok lebih sedikit dari penggunaan',
					'data'		=> $cek
				];
			}else{
				$stok =$cek['stok']-$cek['qty'];
				$update= ['stok' => $stok];
				$this->Mod->update2('sparepart_stok', array('id_barang' => $cek['id_barang'],'id_unit'=> sess()['unit']),$update);

				$status=['status' => 1];
				$this->Mod->update2('sparepart_penggunaan', array('id_penggunaan' => $id_penggunaan,'id_unit'=> sess()['unit']),$status);
			
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Diproses',
					'data'		=> $cek
				];
			}
			
		}else{
			$response=[
				'code'      => '500',
				'msg'       =>  'Coba lagi beberapa waktu'
			];
		}

		echo json_encode($response);
	}

	function EditDataPenggunaan($id_penggunaan = null){
		$data=array();
		if (!empty($id_penggunaan)) {
			$query =  $this->Mod->GetCustome("SELECT a.*,b.id_barang,a.qty, b.nama_barang as nama
            FROM sparepart_penggunaan a 
            LEFT JOIN 
                sparepart b
            ON 
                b.id_barang = a.id_barang
            WHERE  
                a.id_penggunaan = '$id_penggunaan'")->row_array();    
           
			$data['barang']=[
                'text'	=> $query['nama'],
                'id'	=> $query['id_barang'],
				
            ];	
			$data['qty'] =$query['qty'];
			$data['tanggal'] =$query['tanggal'];
			$data['keterangan'] =$query['keterangan'];
		}
		echo json_encode($data);
	}

	function UpdateDataPenggunaan($id_penggunaan=null){
	
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data)) {
			// $barang = $this->Mod->getWhere("sparepart", array('id_barang' =>$data['id_barang']))->row_array();
			
			$data['id_unit'] 		= sess()['unit'];
			$data['id_lokasi'] 		= sess()['id_lokasi'];
			$data['create_by'] 		= sess()['nama'];
			$data['create_date'] 	= date('Y-m-d');
			$data['status'] 		= 0;
			
			$data['id_barang'] 		= $data['id_barang_penggunaan'];
			unset($data['id_barang_penggunaan']);
			if ( $this->Mod->update2('sparepart_penggunaan',array('id_penggunaan' =>$id_penggunaan),$data)) {
				
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Update'
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

	function DeleteDataPenggunaan($id=null){
		if (!empty($id)) {
            $result = $this->Mod->delete('sparepart_penggunaan', array('id_penggunaan' =>$id ));
                   
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
}
		