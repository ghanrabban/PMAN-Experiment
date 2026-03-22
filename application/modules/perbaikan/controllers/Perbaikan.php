<?php
// application/modules/req_open/controllers/Req_open.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perbaikan extends MX_Controller {
    public function __construct() {
        parent::__construct();
        // Load library atau helper yang diperlukan
        $this->load->library('pdfgenerator');
    }
    
    public function index() {

        Permission::grant(uri_string());
        $data["plugin"][]   = "plugin/datatable";
        $data["plugin"][]   = "plugin/select2";
        $data["title"]      = "Perbaikan Perangkat";
        $data["title_des"]  = "List Data Perbaikan perangkat";
        $data["content"]    = "v_index";
        $data["data"]       = $data;
        $data["modul"]      = "perbaikan";
        $data["status"]     = $this->Mod->GetCustome("SELECT * FROM status where jenis= 5")->result_array();
       
        $this->load->view('template_v2', $data);
    }

    function LoadData(){

        //untuk sementara, karena untuk input data dari awal maret -- strat
       if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $limit = 3000; 
        }
        if (!empty(sess()['id_lokasi'])) {
            $param = "AND a.id_lokasi='".sess()['id_lokasi']."' ";
        }else{
            $param= " ";
        }

        $from               = $this->uri->segment(3);
        $start              = ($from>1) ? ($from * $limit) - $limit : 0;

        $result   = $this->Mod->GetCustome("SELECT a.*,b.serial_number,b.nama_perangkat from perbaikan a 
                                        LEFT JOIN 
                                            perangkat b 
                                        ON b.id_perangkat = a.id_perangkat
                                        WHERE 
                                        a.status != 8
                                        $param
                                            ORDER BY a.tanggal ASC limit $start,$limit")->result_array();
        foreach ($result as $key => $value) {
           $result[$key]['tanggal']= tgl($value['tanggal'],'sm');
           $result[$key]['serial_number']= $value['serial_number'] == null  ?  '-':$value['serial_number'];
           $result[$key]['status_label']= $value['status'] == null  ?  '-': sts('5',$value['status']);
           
        }
        $data['data']       = $result;
       
        $total_data         =  $this->Mod->GetCustome("SELECT * from perbaikan a 
                                        WHERE 
                                        a.status != 8
                                        $param
                                            ORDER BY a.tanggal ASC")->num_rows();
        $total_page         = ceil($total_data/$limit);
        
        $data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
        echo json_encode($data);

    }


   
    
    public function SaveData() {
        $data=array_filter($_POST);
        unset($data['Newitems']);
        if (!empty($data)) {
            $data['id_unit']        = sess()['unit']; 
           
            $data['create_date']    = date('Y-m-d H:i:s');
            $data['create_by']      = sess()['nama'];
            if (!empty($data['id_perangkat'])) {
                 $cek =  $this->Mod->GetCustome("SELECT * from perangkat where id_perangkat ='".$data['id_perangkat']."'")->row_array();
                 if (!empty($cek)) {
                    $data['id_lokasi']              = $cek['id_lokasi'];
                    $data['id_jenisperangkat']      = $cek['id_jenisperangkat'];
                    
                 }   
      
            }

            $this->db->insert('perbaikan',$data);
           $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Save'
                        ];
              echo json_encode($response);
           
        }
    }

    function DeleteData($id=null){
        if (!empty($id)) {
           
           $result = $this->Mod->delete('perbaikan',array('id_perbaikan'=>$id));
           
            if ($result) {
                // $this->Mod->delete('fasilitas_detail',array('id_perangkat'=>$id));
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


    public function EditData($id) {
        $data =  $this->Mod->GetCustome("SELECT * from perbaikan where id_perbaikan ='$id'")->row_array();
        $perangkat =  $this->Mod->GetCustome("SELECT * from perangkat where id_perangkat ='".$data['id_perangkat']."'")->row_array();
        $data['perangkat']=['id'=>$perangkat['id_perangkat'],'text'=>$perangkat['nama_perangkat']];    
        $data['indikator']=['id'=>$data['indikator_kerusakan'],'text'=>$data['indikator_kerusakan']];    
        $data['tindakan']=['id'=>$data['tindakan'],'text'=>$data['tindakan']];    
       
        echo json_encode($data);
    }


    public function UpdateData($id=null)
    {
        $data=array_filter($_POST);
        if (!empty( $data)) {
             $res_update = $this->Mod->update2('perbaikan',array('id_perbaikan'=>$id),$data);  
            if ($res_update) {
                $response=[
                            'code'      => '200',
                            'msg'       =>  'Data Berhasil di Update'
                        ];
             
              
            }else{
                $response=[
                    'status'    => '400',
                    'msg'       => 'Data Gagal Disimpan, pastikan semua terisi'
                ];
            }
            echo json_encode($response);
        }else{
            $res=[
                'status'    => '400',
                'msg'       => 'Data Gagal Disimpan, pastikan semua terisi'
            ];
            echo json_encode($res);
        }


    } 


    public function ViewData($id) {

            $data = $this->Mod->GetCustome('SELECT a.*, b.nama_fasilitas, c.kode_unit, d_lokasi.nama_terminal AS nama_lokasi, e_sublokasi.nama_terminal AS nama_sublokasi 
            FROM tiket a
            LEFT JOIN fasilitas b ON a.id_fasilitas = b.id_fasilitas
            LEFT JOIN unit c ON a.id_unit = c.id_unit 
            LEFT JOIN terminal d_lokasi ON a.id_lokasi = d_lokasi.id
            LEFT JOIN terminal e_sublokasi ON a.id_sublokasi = e_sublokasi.id
            WHERE (a.id_tiket = "'.$id.'")')->row_array();
            
            echo json_encode($data);
    }


    function GetData($id=null){
            $data=$this->Mod->GetCustome("SELECT a.*,b.kode_unit as unit, c_lokasi.nama_terminal AS nama_lokasi, d_sublokasi.nama_terminal AS nama_sublokasi
            FROM fasilitas a 
            left join unit b on b.id_unit = a.id_unit
            left join terminal c_lokasi on a.id_lokasi = c_lokasi.id
            left join terminal d_sublokasi on a.id_sublokasi = d_sublokasi.id
            where a.id_fasilitas = '".$id."'")->row_array();
           
            echo json_encode($data);
    }

    function GetIndikator(){
        if (!empty(sess()['unit'])) {
            $param= " AND id_unit ='".sess()['unit']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
       
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT * from perbaikan  where  indikator_kerusakan like '%$serc%' $param GROUP BY indikator_kerusakan")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT * from perbaikan where status !=8 $param GROUP BY indikator_kerusakan limit 10")->result_array();   
        }

        $data=[];
        
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['indikator_kerusakan'],
				'id'	=> $value['indikator_kerusakan']
			];
		}
		echo json_encode($data);
    }
    
    function GetTindakan(){
        if (!empty(sess()['unit'])) {
            $param= " AND id_unit ='".sess()['unit']."'";
        }else{
            $param="";
        }
        $serc= $this->input->post('serc');
       
        if (!empty($serc)) {
            
			$query =  $this->Mod->GetCustome("SELECT * from perbaikan  where  tindakan like '%$serc%' $param GROUP BY tindakan")->result_array();    
		}else{
            $query =  $this->Mod->GetCustome("SELECT * from perbaikan where status !=8 $param GROUP BY tindakan limit 10")->result_array();   
        }

        $data=[];
        
		foreach ($query as $key => $value) {
			// echo "<pre>",print_r ( $value),"</pre>";
			$data[]=[
				'text'	=> $value['tindakan'],
				'id'	=> $value['tindakan']
			];
		}
		echo json_encode($data);
    }
        
   

       
}

