<?php
// application/modules/req_open/controllers/Req_open.php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfomanceFasility extends MX_Controller {

    public function __construct() {
        parent::__construct();
        // Load library atau helper yang diperlukan
        $this->load->library('javascript');
        $this->load->model('Dashboard_m');
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
    function GetOffFasility(){
        $param=$_POST;
        $data=[];
        if (!empty($param)) {
           $res = $this->Mod->GetCustome("SELECT 
                                                a.tanggal,c.nama as catagory, b.nama_fasilitas,a.keterangan as temuan_keterangan 
                                            FROM 
                                                temuan a 
                                            left join 
                                                fasilitas b 
                                            on 
                                                b.id_fasilitas= a.id_fasilitas
                                            left join 
                                                fasilitas_catagory c 
                                            on 
                                                c.id_catagory = b.id_catagory
                                            where b.id_catagory ='".$param['catagory']."' 
                                            AND 
                                            a.id_unit  = '".$param['unit']."' and a.status  = '1' and a.id_lokasi = '".$param['terminal']."'

                                           
                                            ")->result_array();
                   
                   
            foreach ($res as $key => $value) {
                $res[$key]['temuan_tanggal'] = (empty($value['tanggal'])?'':tgl($value['tanggal'],'sm'));
            }
           $data['data']=$res;         
        }
                 
        
        echo json_encode($data);
       
    }
    function GetOffFasilityByname(){
        $data=array();
        if (sess()['id_lokasi']) {
            $param_lokasi = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $param_lokasi = "";
        }

        if ($_POST['catagory']) {
            # code...
            $catagory = $this->Mod->GetCustome("SELECT * FROM fasilitas_catagory WHERE nama ='".$_POST['catagory']."' AND id_unit  = '".sess()['unit']."'")->row_array();
            if (!empty($catagory)) {
                $res = $this->Mod->GetCustome("SELECT 
                                                a.tanggal,c.nama as catagory, b.nama_fasilitas,a.keterangan as temuan_keterangan 
                                            FROM 
                                                temuan a 
                                            left join 
                                                fasilitas b 
                                            on 
                                                b.id_fasilitas= a.id_fasilitas
                                            left join 
                                                fasilitas_catagory c 
                                            on 
                                                c.id_catagory = b.id_catagory
                                            where b.id_catagory ='".$catagory['id_catagory']."' 
                                            AND 
                                            a.id_unit  = '".sess()['unit']."' and a.status  = '1' $param_lokasi

                                           
                                            ")->result_array();
                   
                   
                foreach ($res as $key => $value) {
                    $res[$key]['temuan_tanggal'] = (empty($value['tanggal'])?'':tgl($value['tanggal'],'sm'));
                }
                $data['data']=$res;    
            }     
        }
                 
        
        echo json_encode($data);
       
    }

    function GetFasilityOFF(){
        if (sess()['id_lokasi']) {
            $param_lokasi = "AND a.id_lokasi = '".sess()['id_lokasi']."'";
        }else{
            $param_lokasi = "";
        }

        if ($_POST['catagory']) {
            # code...
           
                $res = $this->Mod->GetCustome("SELECT 
                                                a.tanggal,c.nama as catagory, b.nama_fasilitas,a.keterangan as temuan_keterangan 
                                            FROM 
                                                temuan a 
                                            left join 
                                                fasilitas b 
                                            on 
                                                b.id_fasilitas= a.id_fasilitas
                                            left join 
                                                fasilitas_catagory c 
                                            on 
                                                c.id_catagory = b.id_catagory
                                            where 
                                                b.status = 0
                                            AND 
                                                a.id_unit  = '".sess()['unit']."'  $param_lokasi

                                           
                                            ")->result_array();
                   
                   
                foreach ($res as $key => $value) {
                    $res[$key]['temuan_tanggal'] = (empty($value['tanggal'])?'':tgl($value['tanggal'],'sm'));
                }
                $data['data']=$res;    
             
        }
                 
        
        echo json_encode($data);
       
    }
    
   
    function GetPerfomanceUnit(){
      
                $perfomance   =  $this->Mod->GetCustome("SELECT a.id_unit,d.kode_unit,c.nama_terminal,a.id_lokasi,a.id_catagory,
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
                    LEFT JOIN 
                    	terminal c  
                        on c.id = a.id_lokasi
                     left join 
                     unit d 
                     on d.id_unit = a.id_unit
                    WHERE d.kode_unit is not null
                    AND c.nama_terminal is not null
                    AND c.code != '0'
                     GROUP BY a.id_unit,d.kode_unit,c.nama_terminal,a.id_lokasi")->result_array();
         foreach ($perfomance as $key2 => $value2) {
            $perfomance[$key2]['perfome'] = round(($value2['ON']/$value2['total'])*100);
        }
        $data=array();
        $res=array();
        $fas = array();
        $data3=[];
        $data4=[];
        $data5=[];
        foreach ($perfomance as $key => $value) {
            $res[$value['kode_unit']][$value['nama_terminal']]	    = $value['perfome'];

            $fas[$value['nama_terminal']][$value['kode_unit']]['name']      = $value['kode_unit'];
            $fas[$value['nama_terminal']][$value['kode_unit']]['value']      = $value['perfome'];
            
            $data3[$value['nama_terminal']][$value['kode_unit']]['name']=$value['kode_unit'];
        //    $data4[$value['nama_terminal']]['name']=$value['kode_unit'];
          
           $label =['show'=>true,'color'=>'#fff','fontSize'=>10,'dataCek' => $value['id_unit'] ];
            $data4[$value['kode_unit']]['name']	        = $value['kode_unit'];
            $data4[$value['kode_unit']]['id_unit']	    = $value['id_unit'];
            $data4[$value['kode_unit']]['id_terminal']  = $value['id_lokasi'];
            $data4[$value['kode_unit']]['type']	    ='bar';
            $data4[$value['kode_unit']]['label']	= $label;
            $data4[$value['kode_unit']]['data'][]   = $value['perfome'];
            $data5[$value['nama_terminal']]         = $value['nama_terminal'];
           
            // $fas[$value['nama_terminal']][]      = ['name' => $value['kode_unit'],'value' =>$value['perfome'] ];
        }  
        $data4=array_values($data4);
        $data5=array_values($data5);
        $tes=['name'=> $data5,'data'=> $data4,'vall'=>''  ];
        $data=['data1' =>$res,'data2'=> $fas,'data3'=> $tes];
       
        // foreach ($perfomance as $key => $value) {
        //     $data[$value['id_lokasi']]['id_lokasi']	    = $value['id_lokasi'];
        //     $data[$value['id_lokasi']]['nama_terminal']	= $value['nama_terminal'];
        //     $data[$value['id_lokasi']]['data'][]	    = $value;
          
        // }  

        
       
        echo json_encode($data);
     }
     
     function perfomance_detailOld($param_terminal =null){
       
        $warna=['#91f5e1','#74a5f5','#f8ce76','#f7cecd'];
        if (!empty(sess()['unit'])) {
            $param_unit =" AND id_unit ='".sess()['unit']."'";
        }else{
            $param_unit = " ";
        }

        if (!empty($param_terminal)) {
              $param_terminal= " AND nama_terminal like '%".str_replace("%20"," ",$param_terminal)."%' ";
              $lok=" ";
        }else{ $param_terminal ='';   $lok="";}

        $unit       =  $this->Mod->GetCustome("SELECT * FROM unit where status != 8 $param_unit")->result_array();
      
        foreach ($unit as $key_unit => $val_unit) {
            $terminal       =  $this->Mod->GetCustome("SELECT * FROM terminal where code != '0' $param_terminal")->result_array();
            foreach ($terminal as $key => $value) {
                $umur = $this->Mod->GetCustome(" SELECT count(h.tanggal_penggunaan) as jumlah,e.nama  as catagory_fasilitas,
                                        YEAR(h.tanggal_penggunaan) as tahun 
                                    FROM 
                                        fasilitas_detail h
                                    Left Join  
                                        fasilitas d
                                    ON
                                        d.id_fasilitas = h.id_fasilitas
                                    Left Join 
	                                    fasilitas_catagory e 
                                    ON 
                                        e.id_catagory  = d.id_catagory
                                    WHERE 
                                        h.tanggal_penggunaan is not null 
                                    AND 
                                        YEAR(h.tanggal_penggunaan) !=0 
                                    AND 
                                        h.status != 8
                                   
                                    AND
                                        d.id_lokasi = '".$value['id']."'
                                    AND 
                                        d.id_unit = ".sess()['unit']."
                                    GROUP BY YEAR(h.tanggal_penggunaan)")->result_array();

                
                $jp= $this->Mod->GetCustome("SELECT 
        
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
                                                    AND id_lokasi = '".$value['id']."'
                                                    GROUP BY 
                                                        a.id_jenisperangkat,c.nama")->result_array();
                $perfomance     = $this->Mod->GetCustome(" SELECT a.id_catagory,b.nama as nama,a.id_unit,a.id_lokasi,
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
                                                             a.id_unit= '".$val_unit['id_unit']."' AND a.id_lokasi =  '".$value['id']."'
                                                              
                                                            GROUP BY a.id_catagory,b.nama,a.id_unit,a.id_lokasi")->result_array();
                $total =0;
                $t_fas = 0;
                foreach ($perfomance as $key2 => $value2) {
                    $onPerfomance = ($value2['ON']/$value2['total'])*100;
                    $offPerfomance = 100-  $onPerfomance;
                    $perfomance[$key2]['perfome'] = ($value2['ON']/$value2['total'])*100;
                    $perfomance[$key2]['perfomeOff'] = $offPerfomance;
                    
                    $total =$total+($value2['ON']/$value2['total'])*100;
                    
                    $t_fas++;
                }
                $performa_formatted = $total/$t_fas;
                if ($performa_formatted <= 35) {
                        $warna_pie = '#f20505';
                }elseif ($performa_formatted <= 75) {
                        $warna_pie = '#f27b05';
                }else{
                    $warna_pie = '#3380ff';
                }  
                $terminal[$key]['umur']             = $umur;
                $terminal[$key]['jenisPerangkat']   = $jp;
                $terminal[$key]['perfome']          = $perfomance;
                $terminal[$key]['total_perfome']    = ['Performa'=> $performa_formatted,'color'=>$warna_pie];
                $terminal[$key]['title']            =  $val_unit['kode_unit'].''.$value['nama_terminal'];
            }
           
            $unit[$key_unit]['warna']=$warna[$key_unit];
            $unit[$key_unit ]['data']= $terminal;
            // $unit[$key_unit ]['data']= $terminal['title'];

            // $off = $this->Mod->getWhere('temuan ',array('id_unit' =>$val_unit['id_unit']))->result_array();
          
                // $data['unit']       = $unit['kode_unit'].' '. $terminal['nama_terminal'];
            
                // $data['unit']       = $val_unit['kode_unit'];
                // $data['data']       = $terminal ;
                // $data['off']        =$off;
                //$unit[$key_unit ]['data']= $data;
            
        }

        
            echo json_encode($unit);

          
     
    }

     function perfomance_detail(){
        if (!empty($_POST['lokasi'])) {
            $param_terminal= " AND id ='".$_POST['lokasi']."' ";
        } else {
            $param_terminal="";
        }
         
        $warna=['#91f5e1','#74a5f5','#f8ce76','#f7cecd'];
        if (isset($_POST['unit']) || !empty($_POST['unit']) ) {
            $param_unit =" AND id_unit ='".$_POST['unit']."'";
        }else{
            if (!empty(sess()['unit'])) {
                 $param_unit =" AND id_unit ='".sess()['unit']."'";
            }else{
                $param_unit = " ";
            }
        }

        // if (!empty($param_terminal)) {
        //       $param_terminal= " AND nama_terminal like '%".str_replace("%20"," ",$param_terminal)."%' ";
        //       $lok=" ";
        // }else{ $param_terminal ='';   $lok="";}

        $unit       =  $this->Mod->GetCustome("SELECT * FROM unit where status != 8 $param_unit")->result_array();
      
        foreach ($unit as $key_unit => $val_unit) {
            if (empty($param_terminal)) {
                $terminal       =  array();
                $umur = $this->Mod->GetCustome("SELECT a.id_jenisperangkat,c.nama as jenis,
                                                b.id_unit,
                                                b.id_lokasi,
                                                count(a.tanggal_penggunaan) as jumlah,
                                                YEAR(a.tanggal_penggunaan) as tahun 
                                            FROM fasilitas_detail a 
                                            left join fasilitas b 
                                            on b.id_fasilitas = a.id_fasilitas
                                            LEFT JOIN
                                            jenis_perangkat c 
                                            on c.id_jenisperangkat = a.id_jenisperangkat
                                            where b.id_unit = ".$val_unit['id_unit']."
                                            
                                            AND   a.tanggal_penggunaan is not null 
                                            AND 
                                                YEAR(a.tanggal_penggunaan) !=0 
                                            AND a.id_jenisperangkat not in ('3','4')  
                                            AND a.id_jenisperangkat = 19                                  
                                            GROUP BY YEAR(a.tanggal_penggunaan),a.id_jenisperangkat")->result_array();

                    
                    $jp= $this->Mod->GetCustome("SELECT 
            
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
                                                            b.id_unit = ".$val_unit['id_unit']."
                                                        GROUP BY 
                                                            a.id_jenisperangkat,c.nama")->result_array();

                    $perfomance     = $this->Mod->GetCustome(" SELECT a.id_catagory,b.nama as nama,a.id_unit,
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
                                                                a.id_unit= '".$val_unit['id_unit']."'
                                                                GROUP BY a.id_catagory,b.nama,a.id_unit")->result_array();
                    $total =0;
                    $t_fas = 0;
                    foreach ($perfomance as $key2 => $value2) {
                        $onPerfomance = ($value2['ON']/$value2['total'])*100;
                        $offPerfomance = 100-  $onPerfomance;
                        $perfomance[$key2]['perfome'] = ($value2['ON']/$value2['total'])*100;
                        $perfomance[$key2]['perfomeOff'] = $offPerfomance;
                        
                        $total =$total+($value2['ON']/$value2['total'])*100;
                        
                        $t_fas++;
                    }
                    $performa_formatted = $total/$t_fas;
                    if ($performa_formatted <= 35) {
                            $warna_pie = '#f20505';
                    }elseif ($performa_formatted <= 75) {
                            $warna_pie = '#f27b05';
                    }else{
                        $warna_pie = '#3380ff';
                    }  
                    $terminal[0]['umur']             = $umur;
                    $terminal[0]['jenisPerangkat']   = $jp;
                    $terminal[0]['perfome']          = $perfomance;
                    $terminal[0]['total_perfome']    = ['Performa'=> $performa_formatted,'color'=>$warna_pie];
                    $terminal[0]['title']            =  $val_unit['kode_unit'].' All';
            }else{
                $terminal       =  $this->Mod->GetCustome("SELECT * FROM terminal where code != '0' $param_terminal")->result_array();
                foreach ($terminal as $key => $value) {
                    $umur = $this->Mod->GetCustome("SELECT a.id_jenisperangkat,c.nama as jenis,
                                                b.id_unit,
                                                b.id_lokasi,
                                                count(a.tanggal_penggunaan) as jumlah,
                                                YEAR(a.tanggal_penggunaan) as tahun 
                                            FROM fasilitas_detail a 
                                            left join fasilitas b 
                                            on b.id_fasilitas = a.id_fasilitas
                                            LEFT JOIN
                                            jenis_perangkat c 
                                            on c.id_jenisperangkat = a.id_jenisperangkat
                                            where b.id_unit = ".$val_unit['id_unit']."
                                            and b.id_lokasi = '".$value['id']."'
                                            AND   a.tanggal_penggunaan is not null 
                                            AND 
                                                YEAR(a.tanggal_penggunaan) !=0 
                                            AND a.id_jenisperangkat not in ('3','4')  
                                            AND a.id_jenisperangkat = 19                                  
                                            GROUP BY YEAR(a.tanggal_penggunaan),a.id_jenisperangkat")->result_array();

                    
                    $jp= $this->Mod->GetCustome("SELECT 
            
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
                                                            b.id_unit = ".$val_unit['id_unit']."
                                                        AND id_lokasi = '".$value['id']."'
                                                        GROUP BY 
                                                            a.id_jenisperangkat,c.nama")->result_array();
                    $perfomance     = $this->Mod->GetCustome(" SELECT a.id_catagory,b.nama as nama,a.id_unit,a.id_lokasi,
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
                                                                a.id_unit= '".$val_unit['id_unit']."' AND a.id_lokasi =  '".$value['id']."'
                                                                
                                                                GROUP BY a.id_catagory,b.nama,a.id_unit,a.id_lokasi")->result_array();
                    $total =0;
                    $t_fas = 0;
                    foreach ($perfomance as $key2 => $value2) {
                        $onPerfomance = ($value2['ON']/$value2['total'])*100;
                        $offPerfomance = 100-  $onPerfomance;
                        $perfomance[$key2]['perfome'] = ($value2['ON']/$value2['total'])*100;
                        $perfomance[$key2]['perfomeOff'] = $offPerfomance;
                        
                        $total =$total+($value2['ON']/$value2['total'])*100;
                        
                        $t_fas++;
                    }
                    $performa_formatted = $total/$t_fas;
                    if ($performa_formatted <= 35) {
                            $warna_pie = '#f20505';
                    }elseif ($performa_formatted <= 75) {
                            $warna_pie = '#f27b05';
                    }else{
                        $warna_pie = '#3380ff';
                    }  
                    $terminal[$key]['umur']             = $umur;
                    $terminal[$key]['jenisPerangkat']   = $jp;
                    $terminal[$key]['perfome']          = $perfomance;
                    $terminal[$key]['total_perfome']    = ['Performa'=> $performa_formatted,'color'=>$warna_pie];
                    $terminal[$key]['title']            =  $val_unit['kode_unit'].''.$value['nama_terminal'];
                }
            }
            $unit[$key_unit]['warna']=$warna[$key_unit];
            $unit[$key_unit ]['data']= $terminal;
            // $unit[$key_unit ]['data']= $terminal['title'];

            // $off = $this->Mod->getWhere('temuan ',array('id_unit' =>$val_unit['id_unit']))->result_array();
          
                // $data['unit']       = $unit['kode_unit'].' '. $terminal['nama_terminal'];
            
                // $data['unit']       = $val_unit['kode_unit'];
                // $data['data']       = $terminal ;
                // $data['off']        =$off;
                //$unit[$key_unit ]['data']= $data;
            
        }

        
            echo json_encode($unit);

          
     
    }
    function detail($unit,$terminal){
        $terminal= str_replace("%20"," ",$terminal);
        echo $unit.$terminal;
    }
   
    public function GetDetailUmur()
    {
        $lokasi = $this->input->post('terminal');
        $tahun  = $this->input->post('tahun');
        $unit   = $this->input->post('unit');
    
        // pagination
        $page  = (int) $this->input->post('page') ?: 1;
        $limit = (int) $this->input->post('limit') ?: 10;
        $offset = ($page - 1) * $limit;
    
        /* ================= TOTAL DATA ================= */
        $total = $this->db
            ->select('COUNT(*) AS total')
            ->from('fasilitas_detail a')
            ->join('fasilitas b', 'b.id_fasilitas = a.id_fasilitas', 'left')
            ->join('perangkat c', 'c.id_perangkat = a.id_perangkat', 'left')
            ->where('b.id_lokasi', $lokasi)
            ->where('YEAR(a.tanggal_penggunaan)', $tahun)
            ->where('b.id_unit', $unit)
            ->get()
            ->row()
            ->total;
    
        /* ================= DATA ================= */
        $data = $this->db
            ->select("
                a.id_perangkat,
                b.nama_fasilitas,
                c.nama_perangkat,
                DATE_FORMAT(a.tanggal_penggunaan, '%d %M %Y') AS tanggal_penggunaan,
                c.serial_number
            ")
            ->from('fasilitas_detail a')
            ->join('fasilitas b', 'b.id_fasilitas = a.id_fasilitas', 'left')
            ->join('perangkat c', 'c.id_perangkat = a.id_perangkat', 'left')
            ->where('b.id_lokasi', $lokasi)
            ->where('YEAR(a.tanggal_penggunaan)', $tahun)
            ->where('b.id_unit', $unit)
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    
        echo json_encode([
            'page'  => $page,
            'limit' => $limit,
            'total' => (int)$total,
            'data'  => $data
        ]);
    }
 
}