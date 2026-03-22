<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class List_approval_leader extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('excel');
        $this->load->model("m_data");
    }

    public function index()
    {
      
        $data["plugin"][] = "plugin/datatable";
        $data["plugin"][] = "plugin/select2";
        $data["title"] = "List Approval Leader";
        $data["title_des"] = "List Approval Leader Tindak Lanjut OM";
        $data["content"] = "v_index";

        $data["data"] = $data;

        $this->load->view('template_v2', $data);
        // echo "<pre>",print_r ( $this->session->userdata()),"</pre>";
    }

    
    public function LoadData(){
        


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

		if(isset($_POST['src'])) {
            if ($_POST['src'] !=='') {
                $src = "AND (a.description like '%".$_POST['src']."%' OR b.nama_fasilitas like '%".$_POST['src']."%')";
        
            }else{
                $src ='';
            }
        } else {
            // Atur nilai default jika $_POST['limit'] tidak diatur
            $src = ''; 
        }

		$res   = $this->Mod->GetCustome("SELECT 
         a.*,b.nama_fasilitas,c.nama_terminal
         FROM 
             tinjut a  
         left join 
             fasilitas b 
         on 
             b.id_fasilitas = a.id_fasilitas
         left join 
             terminal c 
         on 
             c.id = b.id_lokasi
         WHERE 
             a.status NOT IN ('8','0') AND a.id_unit='".sess()['unit']."' $param $src ORDER BY a.status,a.create_date DESC limit $start,$limit");
		$result =$res->result_array();
		
        
        foreach ($result as $key => $value) {
			$result[$key]['tanggal'] =tgl($value['create_date'],'sm');
			$result[$key]['status_label'] =sts('3',$value['status'],'sm');
		}
		$total_res   = $this->Mod->GetCustome("SELECT 
         a.*,b.nama_fasilitas,c.nama_terminal
         FROM 
             tinjut a  
         left join 
             fasilitas b 
         on 
             b.id_fasilitas = a.id_fasilitas
         left join 
             terminal c 
         on 
             c.id = b.id_lokasi
         WHERE 
             a.status NOT IN ('8','0') AND a.id_unit='".sess()['unit']."' $param $src ORDER BY  a.status ,a.create_date ASC");
        
        
        $data['data']       = $result;
			
		$total_data         =  $total_res->num_rows();

		$total_page         = ceil($total_data/$limit);
		
		$data['pag']    = BTNPag($from,$total_page,$total_data,$limit);
		echo json_encode($data);
    }
   

    public function ProsesReject($id=null)
    {
        $updateData=[
            'status'        => 5,
        ];
        $data = $this->Mod->GetCustome("SELECT * FROM tinjut WHERE id_tinjut= '$id';")->row_array();
        if(!empty($data)){
           $result =  $this->Mod->update2('tinjut',array('id_tinjut'=>$id ),$updateData);
        }else{
            $result=FALSE;
        }
       
     

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
        echo json_encode($response);
      
    }

    public function ProsesApprove($id=null)
    {

        try {
            $data=[
                'status'        => 2,
            ];
            $result =  $this->Mod->update2('tinjut',array('id_tinjut '=>$id ),$data);

            if ($result) {
              
                $tinjut=$this->Mod->getWhere('tinjut ',array('id_tinjut' =>$id))->row_array();

                $change_kondisi=[
                    'status'=> 1
                ];

                $on_fasilitas   =  $this->Mod->update2('fasilitas',array('id_fasilitas '=>$tinjut['id_fasilitas']),$change_kondisi);
               
                if (!empty($tinjut['id_temuan'])) {
                    $temuan_close  = ['status' => 9];  
                    $this->Mod->update2('temuan',array('id_temuan'=>$tinjut['id_temuan']),$temuan_close);
              
                }
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
           
            
            $tinjut         = $this->Mod->getWhere('tinjut', array('id_tinjut' =>$id))->row_array();
            $tinjut_detail  = $this->Mod->getWhere('tinjut_detail', array('id_tinjut' =>$id))->result_array();
            // echo "<pre>",print_r ( $tinjut),"</pre>";
            foreach ($tinjut_detail as $key => $value) {
                $log = [
                    'id_fasilitas'          => $tinjut['id_fasilitas'],
                    'id_perangkat'          => $value['id_perangkat'],
                    'id_jenisperangkat'     => $value['id_jenisperangkat'],
                    'id_jenismasalah'       => $value['id_jenismasalah'],
                    'id_unit'               => $tinjut['id_unit'],
                    'tittle'                => 'Corrective Maintenance',
                    'note'                  => $tinjut['description'].' fix setelah '.$value['description'],
                    'rel_id'                => $tinjut['id_tinjut'],
                    'rel_type'              => 'tinjut',
                    'start_time'            => date('Y-m-d').' ' .$tinjut['start_time'],
                    'end_time'              => date('Y-m-d').' '.$tinjut['end_time'],
                    'create_byid'           => $tinjut['create_byid'],
                    'create_by'             => $tinjut['create_by'],
                   
                    'create_date'           => date('Y-m-d'),
                    'shift'                 => GetShift()['shift']
                ];
                $this->db->insert('logbook',$log);
              //echo "<pre>",print_r ($log),"</pre>";
            }
            $response=[
                'code'      => '200',
                'msg'       =>  'Data Save'
            ];
        } catch (Exception $e) {
            $response=[
                'code'          => '500',
                'msg'           =>  'Tidak ada perangkat detail'
            ];
        }
        
        echo json_encode($response);
       
        
    }

    public function EditData($id) {
        
        $res = $this->Mod->GetCustome('SELECT b.*, c.nama_masalah, d.nama AS nama_JP
            FROM tinjut a
            LEFT JOIN tinjut_detail b ON a.id_tinjut = b.id_tinjut
            LEFT JOIN jenis_masalah c ON b.id_jenismasalah = c.id
            LEFT JOIN jenis_perangkat d ON d.id_jenisperangkat = b.id_jenisperangkat
            WHERE (a.id_tiket = "'.$id.'")')->result_array();
        $count_res = count($res);
        //echo "<pre>",print_r ( $res),"</pre>";

        $data = $this->Mod->GetCustome('SELECT a.*, b.nama_fasilitas, c.kode_unit, d.date_start, d.update_date, e.description AS keterangan_akhir, f.nama_masalah, g.nama AS nama_JP, h_lokasi.nama_terminal AS nama_lokasi, i_sublokasi.nama_terminal AS nama_sublokasi 
            FROM tiket a
            LEFT JOIN fasilitas b ON a.id_fasilitas = b.id_fasilitas
            LEFT JOIN unit c ON a.id_unit = c.id_unit 
            LEFT JOIN tinjut d ON a.id_tiket = d.id_tiket
            LEFT JOIN tinjut_detail e ON d.id_tinjut = e.id_tinjut
            LEFT JOIN jenis_masalah f ON e.id_jenismasalah = f.id
            LEFT JOIN jenis_perangkat g ON e.id_jenisperangkat = g.id_jenisperangkat
            LEFT JOIN terminal h_lokasi ON a.id_lokasi = h_lokasi.id
            LEFT JOIN terminal i_sublokasi ON a.id_sublokasi = i_sublokasi.id
            WHERE (a.id_tiket = "'.$id.'")')->row_array();

        $data['count'] = $count_res;

        for ($i=0; $i < $count_res; $i++) { 
            $data[$i]['nama_masalah'] = $res[$i]['nama_masalah'];
            $data[$i]['nama_JP'] = $res[$i]['nama_JP'];
            $data[$i]['ket'] = $res[$i]['description'];
        }
 
        echo json_encode($data);
    }


   
}