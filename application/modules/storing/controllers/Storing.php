<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Storing extends CI_Controller{

	public function __construct (){
		parent::__construct();
		$this->load->library('Excel');
		date_default_timezone_set('Asia/Jakarta');
		        $this->load->library('pdfgenerator');
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
		$data["title"] = "History Storing";
		$data["title_des"] = " History Storing Fasilitas";
		$data["content"] = "v_index";
		$data["modul"] = $this->uri->segment(1) ;
		
		$data['lokasi']= $this->Mod->getWhere("terminal", array('code !=' => '0'))->result_array();

		$this->load->view('template_v2', $data);	
		// echo "<pre>",print_r ($data),"</pre>";
	}	

	public function LoadData($from=null){
		if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;

        if (!empty(sess()['id_lokasi'])) {
            $param = "AND b.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }
        $res   = $this->Mod->GetCustome("SELECT *
										FROM 
											terminal a 
										
										WHERE 
											a.code != '0'  
										  limit $start,$limit");
        $result=$res->result_array();

        foreach ($result as $key => $value) {
    		$pekerjaan = $this->Mod->GetCustome("SELECT *
										FROM 
											cheklis_storing 
										WHERE 
											status ='1'
										AND 
											id_lokasi =".$value['id']." ")->num_rows();
         	

			$kamera = $this->Mod->GetCustome("SELECT *
										FROM 
											fasilitas 
										WHERE 
											id_lokasi =".$value['id']." 
										AND id_catagory ='1' ")->num_rows();
			$result[$key]['total_pekerjaan'] =$pekerjaan;
			$result[$key]['total_kamera']=$kamera;
        } 

        

        $data['data']       = $result;
       
        $total_data         =  $this->Mod->getWhere('tinjut',array('status !=' => 8,'id_unit' =>sess()['unit'] ))->num_rows();

        $total_page         = ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
        echo json_encode($data);	
	}

	public function SaveDetail($id) {
		$data=array_filter($_POST);
		// echo "<pre>",print_r ($data),"</pre>";
		if (!empty($data) && !empty($id)) {
			$data['id_lokasi'] 	= $id;
			$data['id_unit'] 	= sess()['unit'];
			$data['status'] 	= 1;
			if ( $this->db->insert('cheklis_storing',$data)) {
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
	
	public function SaveManual() {
		if (!empty($_POST['id_fasilitas'])) {
			$fasilitas = $this->Mod->getWhere('fasilitas',array('id_fasilitas' =>$_POST['id_fasilitas']  ))->row_array();

			$data=[
				'id_unit'		=> sess()['unit'],
				'tanggal'		=> $_POST['tanggal_manual'],
				'id_fasilitas'	=> $_POST['id_fasilitas'],
				'id_lokasi'		=> $fasilitas['id_lokasi'],
				'catatan'		=> $_POST['catatan_manual'],
				'create_by'		=> sess()['nama'],
				'create_date'	=> date('Y-m-d'),
				'status'		=> 0
			];
			//  echo "<pre>",print_r ($data),"</pre>";
			if ( $this->db->insert('storing',$data)) {
				$id_storing = $this->db->insert_id();
			
				if (isset($_POST['newdata'])) {
					foreach ($_POST['newdata'] as $key => $value) {
						$insert_ceklist=[
							'id_ceklis'                 => $value['id_ceklist_manual'],
							'id_storing'              	=> $id_storing,
							'kondisi'					=> $value['kondisi_manual'],
							'status' 			        => 1,
						];
						$this->db->insert('storing_detail',$insert_ceklist);
					}
				}

				if (!empty($_POST['id_file'])) {
					$file = explode(",",$_POST['id_file']);
					if (!empty($file)) {
						
						foreach ($file as $key => $value) {
							$lampiran = [
								'id_storing'=>$id_storing,
							];
							$this->Mod->update2('storing_dokumentasi', array('id_dokumentasi' => $value),$lampiran);
						}
						# code...
					}
				}
				$response=[
					'code'      => '200',
					'msg'       =>  'Data Disimpan'
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
					'msg'       =>  'Tidak Ada Fasilitas Yang dipilih'
				];
		}
		echo json_encode($response);
	   
	}
	
	function LoadDataDetail($id=null){
        //$data= $this->position();
       // $acc  = access($data,"VIEW")['access'];
       
        $data['pekerjaan']= $this->Mod->getWhere('cheklis_storing',array('id_lokasi ' =>$id,'status' => 1,'id_unit'=> sess()['unit']))->result_array();
		foreach ( $data['pekerjaan'] as $key => $value) {
			$area =$this->Mod->getWhere('area',array('id_area ' =>$value['id_area'],'status' => 1,'id_unit'=> sess()['unit']))->row_array();
			
			$data['pekerjaan'][$key]['nama_area'] = (empty( $area['nama_area']) ? '':$area['nama_area']) ;
		}
       
        echo json_encode($data);
    }

	function UpdateDetail($id=null){
        $data=[
            'nama_pekerjaan'	=> $this->input->post('nama_pekerjaan'),
            'id_jenisperangkat' => $this->input->post('id_area'),
            'id_unit'           => sess()['unit'],
            'status'            => 1,
        ];
        if($this->Mod->update2('cheklis_storing',array('id_ceklis '=>$id ),$data)){
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
         echo json_encode($response);
    }

	function ProsesData($id=null){
		if (!empty($id)) {
			$data= [ 
				'status' => '1'
			];
			$result = $this->Mod->update2('storing', array('id_storing' => $id),$data);
			
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
			$result = $this->Mod->update2('storing', array('id_storing' => $id),$update);
			   
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
	
	

	


	function UploadDock(){
        if ($_FILES['file']['error'] == 0) {
            $this->load->library('upload');
            $filename = round(microtime(true));

            $config['upload_path']   = 'upload/storing/';
            $config['allowed_types'] = '*';
            $config['max_size']      = 100000;
            $config['file_name'] = $filename;
    
            $this->upload->initialize($config);
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if ($this->upload->do_upload('file')) {
                $oriname= $this->upload->data('file_name');

                $insert =[
                    'name_file'    		=> $oriname,
                    'title_file'        => 'Documentasi Storing'
                ];
                if($this->db->insert('storing_dokumentasi',$insert)){
					 $id_storing = $this->db->insert_id();
                    $response=[
                        'code'      => '200',
                        'msg'       => 'Data Save',
						'id'		=> $id_storing
                    ];
                }else{
                    $response=[
                        'code'      => '500',
						'id'		=> '',
                        'msg'       =>  'Coba lagi beberapa waktu'
                    ];
                }
            } else {
                $response=[
                    'code'      => '500',
                    'msg'      => 'Sorry, File uploaded unsuccessfully',
					'err'		=> $this->upload->error_msg
                 ];
            }
        } else {
            $response=[
                'code'      => '500',
                'msg'    => 'Sorry, File Foto Before uploaded unsuccessfully'
            ];
        }
        echo json_encode($response);
    
	}

	function RemoveFile(){
		$file = $this->Mod->getWhere("storing_dokumentasi", array('id_dokumentasi' => $_POST['token']))->row_array();
		$file_path='upload/storing/'.$file['name_file'];
		if (file_exists($file_path)) {
			if (unlink($file_path)) {
				$this->Mod->delete('storing_dokumentasi', array('id_dokumentasi' =>$file['id_dokumentasi'] ));
            
				$response=[
                	'code'      => '500',
                	'msg'    	=>  'File deleted successfully.'
            	];
				
			} else {
				$response=[
                	'code'      => '500',
                	'msg'    	=>  'Error deleting file.'
            	];
			}
		} else {
			$response=[
                	'code'      => '500',
                	'msg'    	=>  'File not found.'
            	];
		}
		 
		  echo json_encode($response);
	}

	function Getlokasi	($id){
		if (!empty($id)) {
			$lokasi = $this->Mod->getWhere("fasilitas", array('id_fasilitas' =>$id))->row_array();
			if (!empty($lokasi)) {
				 $job  = $this->Mod->getWhere("cheklis_storing", array('id_lokasi' =>$lokasi['id_lokasi'],'id_unit'=> sess()['unit']))->result_array();
				 if (!empty($job)) {
					$response=[
							'code'      => '200',
							'msg'    	=>  '',
							'data'		=> $job 
            		];
				 }else{
					$response=[
							'code'      => '500',
							'msg'    	=>  'Belum Ada Ceklist Dibuat untuk lokasi '.$lokasi['id_lokasi'],
							'data'		=> ''
            		];
				 }
			}else{
				$response=[
                	'code'      => '500',
                	'msg'    	=>  'Lokasi Fasilitas Belum terdaftar',
					'data'		=>''
            	];
			}
		}else{
			$response=[
                	'code'      => '500',
                	'msg'    	=>  'Silahkah Pilih Fasilitas Terlebih Dulu',
					'data'		=>''
            	];
		}
		  echo json_encode($response);
	}

	function LoadHistory(){
       
        $result = $this->Mod->GetCustome("SELECT a.*,b.nama_terminal,c.nama_fasilitas 
										FROM storing a 
										LEFT JOIN terminal b on b.id =a.id_lokasi 
										LEFT JOIN fasilitas c 
										ON c.id_fasilitas = a.id_fasilitas
										WHERE a.id_unit = ".sess()['unit']." AND a.status !=8
                                        ORDER BY a.tanggal DESC"); 
        $res= $result->result_array();
        
        foreach ($res as $key => $value) {
            $res[$key]['tanggal'] =tgl( $value['tanggal'],'sm');
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

	function PrintData($id){
		$data["plugin"][]           = "plugin/datatable";
        $data["plugin"][]           = "plugin/select2";
        $data["title"]              = "PREVENTIVE MAINTENANCE BULANAN";
        $data["title_des"]          = "Lorem ipsum dolor sit amet";
        $data["content"]            = "PM Bulanan";
        $job        = [];
        $fasilitas = [];
        
			// $header['detail']
           
            $data = $this->Mod->GetCustome("SELECT *  FROM storing a 
               
            WHERE a.id_storing = '".$id."'" )->row_array();
            $fasilitas  = $this->Mod->getWhere('fasilitas',array('id_fasilitas' => $data['id_fasilitas']))->row_array();
			$data['fasilitas']= $fasilitas['nama_fasilitas'];
			$detail	= $this->Mod->GetCustome("SELECT a.*, b.nama_pekerjaan
										FROM 
               	 							storing_detail a 
										LEFT JOIN  
											cheklis_storing b
										ON 
											b.id_ceklis = a.id_ceklis
										WHERE a.id_storing = '".$data['id_storing']."'" )->result_array();
					foreach ($detail as $key => $val) {
                        $detail[$key]['name_cek'] = ( $val['kondisi']== '1' ? 'Baik': 'Tidak');
                       
                     $job[$val['nama_pekerjaan']]=[
                            'id_ceklis'         => $val['id_ceklis'],
                            'nama_pekerjaan'    => $val['nama_pekerjaan']
                         ];
                    }
				$dokumentasi= $this->Mod->GetCustome("SELECT *
										FROM 
               	 							storing_dokumentasi 
										WHERE id_storing = '".$data['id_storing']."' limit 2" )->result_array();
                // $this->Mod->getWhere('storing_dokumentasi',array('id_storing' =>$value['id_storing']))->result_array();
				foreach ($dokumentasi as $key2 => $value2) {
                   $dokumentasi[$key2]['url'] = base_url('upload/storing/').$value2['name_file'];
                }
                $data['ceklist'] = $detail;
				$data['dokumentasi'] = $dokumentasi;



            $job=array_values($job);

            $data['job']  = $job;
            $data['ttd']  = ['organik' =>['nama' => 'tes Organik'] ,'om' => ['nama'=> ' tes OM']];
           

        if (sess()['unit'] == '3') {
           $this->DokStoring_CCTV($data);
        }else{
            echo "Belum Ada format Storing"; 
        }
        

        
        
        

	}

	 function DokStoring_CCTV($data){
        $this->load->view('v_printstoring',$data);
		// $html= $this->load->view('v_printstoring',$data, true);
        // $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
         echo "<pre>",print_r ($data),"</pre>";
    }

	function GetDataList(){
		
		$data =$this->Mod->GetCustome("SELECT a.*,b.nama_fasilitas as fasilitas FROM storing a 
		LEFT JOIN fasilitas b 
		ON b.id_fasilitas = a.id_fasilitas
		WHERE a.status not in ('8','9')
       " )->result_array();
     
		   echo json_encode($data);
	}

	function listwo(){
		$data["plugin"][] = "plugin/datatable";
		$data["plugin"][] = "plugin/select2";
		$data["title"] = "Data  Workoder Storing";
		$data["title_des"] = "  Workoder Storing";
		$data["content"] = "v_indexWO";
		$data["modul"] = $this->uri->segment(1) ;
		
		$data['lokasi']= $this->Mod->getWhere("terminal", array('code !=' => '0'))->result_array();
	 	$data['pelaksana']               =  $this->Mod->getWhere('user ',array('status != ' =>8,'type_user'=>'1' , 'unit_kerja'=> sess()['unit']))->result_array();
      
		$this->load->view('template_v2', $data);	
	}

	function GetDataStoring(){
		$data = $this->Mod->getWhere('storing',array('status !=' => 8))->result_array();
		foreach ($data as $key => $value) {
			$detail = $this->Mod->getWhere('fasilitas',array('id_fasilitas' => $value['id_fasilitas']))->row_array();
			$data[$key]['fasilitas'] = $detail['nama_fasilitas'];
		}
		echo json_encode($data);
	}

	function LoadDataStoringWo(){
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
        $from               = $this->uri->segment(3);
      
        $param=[
            'table'         => 'storing_wo' ,
            'pk'            => 'id_storingwo' ,
            'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit'] ) ,
            'url'           => $this->uri->segment(2) ,
            'from'          => $from ,
            'limit'         => $limit ,
            'src'           => $src,
            'filter'        => (!empty($jenis) ? array('id_jenisperangkat'=> $jenis):'') ,
            'param_src'     => [
                                ]
        ];
        $totalData              = CountDataPag($param);
        $param['total_data']    = $totalData;
        $param['total_page']    = ceil($totalData/$limit);
        $res                    = pagin($param);
      
       foreach ($res['data'] as $key => $value) {
        $res['data'][$key]['status_label'] = stg($value['status']);
        $res['data'][$key]['tanggal_label'] = tgl($value['tanggal'],'s');
        $detail =   $this->Mod->GetCustome("SELECT *
											FROM storing_wodetail a 
											WHERE a.id_storingwo  = '".$value['id_storingwo']."'")->result_array();
        
        $res['data'][$key]['detail'] = $detail;
        $res['data'][$key]['jumlah'] = count($detail);
        //  echo "<pre>",print_r ( $detail),"</pre>";
        }
        echo json_encode($res);
	}

	function SaveDataWO(){
     
        
        if (isset($_POST['newdata'])) {
            if (isset($_POST['id_user'])) {
               $pelaksana = implode(",",$_POST['id_user']);
            }else{
                $pelaksana ='';
            }
            
            $head = [
                'tanggal'       => $_POST['tanggal'] ,
                'team'          => $_POST['team'],  
                
                'shift'         => GetShift()['shift'] ,
                'pelaksana'     => $pelaksana,
                'id_unit'       => sess()['unit'],
                'create_date'   => date('Y-m-d'),
                'create_by'     => sess()['id']
            ];
            $savedata = $this->db->insert('storing_wo',$head);
            $id_tiket = $this->db->insert_id();
            foreach ($_POST['newdata'] as $key => $value) {
                //echo "<pre>",print_r ( $value),"</pre>";
                $data=[
                    'id_storingwo'  => $id_tiket ,
                    'id_storing'    => $value['id_storing'],
                   
                    'status'    =>  0
                ];
                $this->db->insert('storing_wodetail',$data);
                
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

	
    function ProsesWo($id=null){
        if (!empty($id)) {
            $data= [ 
                'status' => '1'
            ];

           $cek =  $this->Mod->getWhere('storing_wodetail',array('id_storingwo ' =>$id,'status' => 0 ))->num_rows();
          
           if ($cek == 0) {
                $response=[
                    'code'      => '500',
                    'msg'       => 'Gagal Proses Data,Tidak Ada Detail Transaksi/Detail Sudah Digunakan'
                ];
           }else{

                $result     = $this->Mod->update2('storing_wo', array('id_storingwo' => $id),$data);
                $result2    = $this->Mod->update2('storing_wodetail', array('id_storingwo' => $id,'status' => 0),$data);
                $cek_detail = $this->Mod->GetCustome("SELECT b.* FROM storing_wodetail a left join storing b on b.id_storing = a.id_storing WHERE a.id_storingwo= '".$id."'")->result_array();
                foreach ($cek_detail as $key => $value) {
                    $data_cancel =['status' => 8];
                    $result2    = $this->Mod->update2('storing_wodetail', array('id_storingwo !=' => $id, 'id_storing' => $value['id_storing'],'status' => 0),$data_cancel);
                    $data_tinjut= [ 
                        'status' => '9'
                    ];
                    $this->Mod->update2('storing', array('id_storing' => $value['id_storing']),$data_tinjut);
                }
              
                // echo "<pre>",print_r ( $cek_detail),"</pre>";
                if ($result) {

                    $cek_user = $this->Mod->getWhere('user',array('id ' =>sess()['id'] ))->row_array();
          
                    $save_log_ttd =[
                        'id_user'       => sess()['id'],
                        'type_user'     => (!empty($cek_user) ? $cek_user['type_user']: ''),
                        'rel_id'        =>  $id,
                        'rel_type'      => 'storing',
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
           }
            
        }else{
            $response=[
                'code'      => '500',
                'msg'    =>  'Gagal Proses Data'
            ];
        }
       
        echo json_encode($response);
    }

	function ViewDataWO($id=null){
        if (!empty($id)) {
            $header =  $this->Mod->getWhere('storing_wo',array('id_storingwo' =>$id))->row_array();
				
            $header['pelaksana'] = explode(",", $header['pelaksana']);
            $header['tanggal'] =  tgl($header['tanggal'],'l');
            $header['shift_l'] =l_sh($header['shift']);
			// $header['detail']
            $job = [];
            $detail = $this->Mod->GetCustome("SELECT  a.*,b.catatan,c.nama_fasilitas as fasilitas,d.nama_terminal  as terminal FROM 
                storing_wodetail a 
            LEFT JOIN  storing b
            ON 
            a.id_storing = b.id_storing
			LEFT JOIN 
			fasilitas c 
			ON c.id_fasilitas  = b.id_fasilitas
			LEFT JOIN 
			terminal d 
			ON 
			d.id = c.id_lokasi 
            WHERE a.id_storingwo = '".$id."'" )->result_array();

			foreach ($detail as $key => $value) {
					$ceklist	= $this->Mod->GetCustome("SELECT a.*, b.nama_pekerjaan
										FROM 
               	 							storing_detail a 
										LEFT JOIN  
											cheklis_storing b
										ON 
											b.id_ceklis = a.id_ceklis
										WHERE a.id_storing = '".$value['id_storing']."'" )->result_array();
					foreach ($ceklist as $key22 => $val22) {
                        $ceklist[$key22]['kondisi'] = ( $val22['kondisi']== '1' ? 'Baik': 'Tidak');
                    }
					$dokumentasi= $this->Mod->getWhere('storing_dokumentasi',array('id_storing' =>$value['id_storing']))->result_array();
				$detail[$key]['ceklist'] = $ceklist;
                $detail[$key]['ceklist_c'] = count($ceklist);
				$detail[$key]['dokumentasi'] = $dokumentasi;
			}
           
			$header['detail'] =  $detail;
            $header['job'] =  $job;
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

    function PrintWOStoring($id){
        $data["plugin"][]           = "plugin/datatable";
        $data["plugin"][]           = "plugin/select2";
        $data["title"]              = "DOKUMENTASI CHECKLIST STORING";
        $data["title_des"]          = "PERALATAN KAMERA {FASILITAS}";
        $data["content"]            = "Workorder Storing";
      
        // $pm                             = $this->Mod->getWhere('pm',array('id_pmheader' =>$id ))->row_array();
        $job        = [];
        $fasilitas = [];
        $header =  $this->Mod->getWhere('storing_wo',array('id_storingwo' =>$id))->row_array();
				
            $header['pelaksana'] = explode(",", $header['pelaksana']);
            $header['tanggal'] =  tgl($header['tanggal'],'l');
            $header['shift_l'] = l_sh($header['shift']);
            $header['nama_lokasi'] ='';
			// $header['detail']
           
            $detail = $this->Mod->GetCustome("SELECT  a.*,b.catatan,c.nama_fasilitas as fasilitas,d.nama_terminal  as terminal FROM 
                storing_wodetail a 
            LEFT JOIN  storing b
            ON 
            a.id_storing = b.id_storing
			LEFT JOIN 
			fasilitas c 
			ON c.id_fasilitas  = b.id_fasilitas
			LEFT JOIN 
			terminal d 
			ON 
			d.id = c.id_lokasi 
            WHERE a.id_storingwo = '".$id."'" )->result_array();

			foreach ($detail as $key => $value) {
                    $fasilitas[$value['fasilitas']]= $value['fasilitas'];
					$ceklist	= $this->Mod->GetCustome("SELECT a.*, b.nama_pekerjaan
										FROM 
               	 							storing_detail a 
										LEFT JOIN  
											cheklis_storing b
										ON 
											b.id_ceklis = a.id_ceklis
										WHERE a.id_storing = '".$value['id_storing']."'" )->result_array();
					foreach ($ceklist as $key22 => $val22) {
                        $ceklist[$key22]['name_cek'] = ( $val22['kondisi']== '1' ? 'Baik': 'Tidak');
                       
                     $job[$val22['nama_pekerjaan']]=[
                            'id_ceklis'         => $val22['id_ceklis'],
                            'nama_pekerjaan'    => $val22['nama_pekerjaan']
                         ];
                    }
				$dokumentasi= $this->Mod->GetCustome("SELECT *
										FROM 
               	 							storing_dokumentasi 
										WHERE id_storing = '".$value['id_storing']."' limit 2" )->result_array();
                // $this->Mod->getWhere('storing_dokumentasi',array('id_storing' =>$value['id_storing']))->result_array();
				foreach ($dokumentasi as $key2 => $value2) {
                   $dokumentasi[$key2]['url'] = base_url('upload/storing/').$value2['name_file'];
                }
                $detail[$key]['ceklist'] = $ceklist;
				$detail[$key]['dokumentasi'] = $dokumentasi;
			}
            $job=array_values($job);
            $header['fasilitas']  = $fasilitas;
            $header['job']  = $job;
            $header['ttd']  = ['organik' =>['nama' => 'tes Organik'] ,'om' => ['nama'=> ' tes OM']];
            $header['detail']= $detail;
			$data['header'] =  $header;
           

        $this->WOStoring_CCTV($data);
        
    }
    function WOStoring_CCTV($data){
        // $this->load->view('v_printWO',$data);
		$html= $this->load->view('v_printWO',$data, true);
        $this->pdfgenerator->generate($html, 'file_pdf','A4','portrait');
            // echo "<pre>",print_r ($data),"</pre>";
    }

    function EditDataWO($id){
        $data               = $this->Mod->getWhere('storing_wo',array('id_storingwo ' =>$id ))->row_array();
        $data['tanggal']    = date("Y-m-d h:m",strtotime($data['tanggal']));
        // $detail             = $this->Mod->GetCustome("SELECT a.*,c.nama_fasilitas FROM tiket_cm_detail a LEFT JOIN tinjut b on b.id_tinjut = a.id_tinjut LEFT JOIN fasilitas c on c.id_fasilitas = b.id_fasilitas WHERE a.id_tiket= '".$data['id_tiket']."'")->result_array();
        
        // $data['detail'] = $detail ;
        echo json_encode($data);
    }
}
		