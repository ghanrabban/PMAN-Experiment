<?php

function GetVend($type){
     $ci =& get_instance();
        if ($type!= null) {
            $res = $ci->Mod->getWhere('vendor',array('type' => $type,'status !=' =>8 ))->row_array();
            $data=$res['nama'];
        }else{
              $data=array();
        }
     return $data;
}
function ncrypt($str, $act, $pass){
    $o = null;
    $key = hash('sha256', $pass);
    $iv = substr(hash('sha256', $pass), 0, 16);
    ($act == 'e') ? $o = base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv)) : $o = openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, 0, $iv );
    return trim($o, "=");
      }

    function xcrypt($str, $act){
    $o = null;
    $key = hash('sha256', 'x');
    $iv = substr(hash('sha256', 'x'), 0, 16);
    ($act == 'e') ? $o = base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv)) : $o = openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, 0, $iv );
    return trim($o, "=");
}
function hassp($password){
    $options = ['cost' => 12,];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}
function session($id) {
    $CI = & get_instance();
    return $CI->session->userdata($id);
}

function sess() {
    $CI = & get_instance();
    return $CI->session->userdata();
}

function roles()
{
    return [
        "ADMINISTRATOR" => "ADMINISTRATOR",
        "USER" => "USER",
        "USER_AP" => "USER AP",
        "USER_UNIT" => "USER UNIT",
        "READONLY" => "READONLY",
    ];
}

function rupiah($input =""){
    return "" . number_format($input, 0, ',', '.') ;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function setcookies($name,$value,$time = '360000'){
     $CI = & get_instance();
     $cookie= array(
 
           'name'   => $name,
 
           'value'  => $value,
 
           'expire' => $time,
 
       );
 
       $CI->input->set_cookie($cookie);
}

function cookies($name){
     $CI = & get_instance();
       return $CI->input->cookie($name,true);
}


function flash($id) {
    $CI = & get_instance();
    return $CI->session->flashdata($id);
}

function last_query($komen = false) {
    $CI = & get_instance();
    echo $komen ? "<!--" : "";
    echo "<pre>\n" . $CI->db->last_query() . "\n</pre>";

    echo $komen ? "-->" : "";
}

function nol($id, $num = 3) {
    return str_pad($id, $num, 0, STR_PAD_LEFT);
}

function token() {
    return md5(time());
}


function tglInput($tanggal) {
    $tgl = substr($tanggal, 0, 2);
    $bln = substr($tanggal, 3, 2);
    $thn = substr($tanggal, 6, 4);

    return "$thn-$bln-$tgl";
}


function tglOutput($tanggal) {
    $tgl = substr($tanggal, 0, 4);
    $bln = substr($tanggal, 5, 2);
    $thn = substr($tanggal, 8, 2);

    return "$thn/$bln/$tgl";
}

function validDate($date) {
    $dt = explode("/", $date);
    $date0 = count($dt) == 3 ? $dt[02] . "-" . $dt[01] . "-" . $dt[00] : date("Y-m-d");
    $date = date("d/m/Y", strtotime($date0));
    $m = date("m", strtotime($date0));
    $d = date("d", strtotime($date0));
    $Y = date("Y", strtotime($date0));
    $data["date"] = $date == "01/01/1970" ? date("d/m/Y") : $date;
    $data["datePrev"] = date("d/m/Y", mktime(1, 1, 1, $m, $d - 1, $Y));
    $data["dateNext"] = date("d/m/Y", mktime(1, 1, 1, $m, $d + 1, $Y));
    return $data;
}

function tanggal($tanggal, $mode = "default") {

    $tanggal2 = explode("-", $tanggal);

    $bln = $tanggal2[1];
    $bulane = "-";
    if ($bln == "01") {
        $bulane = "Januari";
    }
    if ($bln == "02") {
        $bulane = "Februari";
    }
    if ($bln == "03") {
        $bulane = "Maret";
    }
    if ($bln == "04") {
        $bulane = "April";
    }
    if ($bln == "05") {
        $bulane = "Mei";
    }
    if ($bln == "06") {
        $bulane = "Juni";
    }
    if ($bln == "07") {
        $bulane = "Juli";
    }
    if ($bln == "08") {
        $bulane = "Agustus";
    }
    if ($bln == "09") {
        $bulane = "September";
    }
    if ($bln == "10") {
        $bulane = "Oktober";
    }
    if ($bln == "11") {
        $bulane = "November";
    }
    if ($bln == "12") {
        $bulane = "Desember";
    }
    if ($mode == "default") {
        $tanggal3 = count($tanggal2) == 3 ? $tanggal2[2] . " " . $bulane . " " . $tanggal2[0] : $bulane . " " . $tanggal2[0];
    } else if ($mode == "reverse") {
        $tanggal3 = count($tanggal2) == 3 ? $tanggal2[2] . " " . $bulane . " " . $tanggal2[0] : $bulane . " " . $tanggal2[0];
    }


    if ($bulane == "-") {
        return "-";
    } else {
        return $tanggal3;
    }
}

function clean($input) {
    return trim(htmlentities($input));
}

function warning($pesan, $type = "danger ", $icon = true) {
    switch ($type) {
        case "success": $result = "<div class=\"alert alert-$type alert-custom alert-dismissible\" role=\"alert\">
				    	<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>" .
                    ($icon ? "<i class=\"fa fa-check-circle  m-right-xs\"></i>" : "" ) .
                    $pesan
                    . "</div>";
            break;

        case "info": $result = "<div class=\"alert alert-$type alert-custom alert-dismissible\" role=\"alert\">
				    	<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>" .
                    ($icon ? "<i class=\"fa fa-exclamation-circle  m-right-xs\"></i>" : "" ) . $pesan
                    . "</div>";
            break;

        case "warning": $result = "<div class=\"alert alert-$type alert-custom alert-dismissible\" role=\"alert\">
				    	<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>" .
                    ($icon ? "<i class=\"fa fa-exclamation-circle  m-right-xs\"></i>" : "" ) . $pesan
                    . "</div>";
            break;

        default : $result = "<div class=\"alert alert-danger alert-custom alert-dismissible\" role=\"alert\">
				    	<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>" .
                    ($icon ? "<i class=\"fa fa-exclamation-circle  m-right-xs\"></i>" : "" ) . $pesan
                    . "</div>";
            break;
    }
    return $result;
}

function array_merge_recursive_distinct(array &$array1, array &$array2) {
    $merged = $array1;

    foreach ($array2 as $key => &$value) {
        if (is_array($value) && isset($merged [$key]) && is_array($merged [$key])) {
            $merged [$key] = array_merge_recursive_distinct($merged [$key], $value);
        } else {
            $merged [$key] = $value;
        }
    }

    return $merged;
}

function waktu($input) {
    $input = substr($input, 0, 10);
    $tanggal2 = explode("-", $input);
    $tgl = $tanggal2[2];
    $bln = $tanggal2[1];
    $thn = $tanggal2[0];

    if ($input == date("Y-m-d")) {
        return "Hari ini";
    } else if ($input == date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")))) {
        return "Kemarin";
    } else {
        return tanggal($input);
    }
}

function toHour($input) {
    $clock = explode(".", $input);
    if (count($clock) == 2) {
        $hour = nol($clock[0], 2);
        $minute = ("0." . $clock[1]);

        $minute = floor($minute * 60);

        $minute = nol($minute, 2);
        $result = "$hour:$minute";
    } else {
        $result = nol($clock[0], 2) . ":00";
    }

    return $result;
    #return count($clock) > 0 ? $clock[0].":".floor( ) : $clock[0];
}

function upload($name, $upload_path = "./upload/temp", $allowed_types = "pdf", $max_size = 5120, $filename = "") {
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = $allowed_types;
    $config['max_size'] = $max_size;
    $config['remove_spaces'] = TRUE;

    if ($filename != "") {
        $config["file_name"] = $filename;
    }

    #dump($config);

    $CI = & get_instance();
    $CI->load->library('upload', $config);

    if (!file_exists($upload_path)) {
        @mkdir($upload_path, 0755, true);
    }


    if (!$CI->upload->do_upload($name)) {
        $data["error"] = $CI->upload->error_msg[count($CI->upload->error_msg) - 1];


        $data["result"] = false;
    } else {

        $data["data_upload"] = $CI->upload->data();
        $data["data_upload"]["file_url"] = "$upload_path/" . $data["data_upload"]["file_name"];
        $data["data_upload"]["upload_path"] = $upload_path;
        $data["result"] = true;
    }

#dump($CI->upload->data());
#$CI->upload = null;
    return $data;
}

function moveTemp($file_url, $newURL, $newFolder) {
    if (!file_exists($newFolder)) {
        @mkdir($newFolder, 0755, true);
    }
    /* $a = explode(".", $file);
      $ext = $a[count($a) - 1];
      //$filename = substr($file, 0, -1 - strlen($ext)); */
    @rename_win($file_url, "$newURL");
}

function rename_win($oldfile, $newfile) {
    if (@!rename($oldfile, $newfile)) {
        if (@copy($oldfile, $newfile)) {
            @unlink($oldfile);
            return TRUE;
        }
        return FALSE;
    }
    return TRUE;
}

function dump($input) {
    echo "<pre>\n";
    print_r($input);
    echo "</pre>\n";
    die;
}


function easy_number_format($nummer, $dec_point, $thousands_sep) {
    $nummer = rtrim(sprintf('%f', $nummer), "0");
    if (fmod($nummer, 1) != 0) {
        $array_int_dec = explode('.', $nummer);
    } else {
        $array_int_dec = array(strlen($nummer), 0);
    }
    (strlen($array_int_dec[1]) < 2) ? ($decimals = 2) : ($decimals = strlen($array_int_dec[1]));
    return number_format($nummer, $decimals, $dec_point, $thousands_sep);
}

function oracle_date($timestamp='')
{
    $CI = & get_instance();
    $CI->load->helper('date');
    if($timestamp=='date'){
        $datestring = '%d-%M-%Y';
    }
    else
    {
        $datestring = '%Y-%m-%d %h.%i.%s';
    }

    $time = time();
    $timestamp = strtoupper(mdate($datestring, $time));
    return $timestamp;
}

 function access($data,$type)
{
    // echo "<pre>",print_r ( $data),"</pre>";
    session_update();
    $menu = session("lit_menu");

  
    $data["access"] = [];
   
    foreach($menu as $item){
        /* echo "<pre>";
        var_dump($item->POSITION); die; */
        if($item->POSITION == $data['position']){
           
           
            $data["access"] = json_decode(json_encode($item), true);
        }
    }
   
    if(empty($data["access"]) || $data["access"][$type] != "Y"){
        echo "<script  type='text/javascript'>alert('Anda tidak diizinkan mengakses menu'); window.location.replace('".base_url()."')</script>";
        redirect(base_url());
       // echo $data["access"][$type];
    }else{
        return  $data;
    }
}

function session_update()
{
    // $CI = & get_instance();
    // $menu = $CI->db->where('ROLE',session('role'))
    //                 ->group_start()
    //                     ->where('CEMS_MENU.APPLICATION','GLOBAL')
    //                     ->or_where('CEMS_MENU.APPLICATION','PBR')
    //                 ->group_end()
    //                 ->join('CEMS_USER_MENU','CEMS_MENU.MENU_ID = CEMS_USER_MENU.MENU_ID')
    //                 ->get('CEMS_MENU')->result();
    // $CI->session->set_userdata('lit_menu', $menu);
}

function Fmonth($bln=null){
  
   
    $bln_panjang	= array("Januari", "Februari", "Maret", "ApriI", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $bln_angka		= intval($bln) - 1;
    
    return  $bln_panjang[$bln_angka];

}

    function lb_pls($id=null){
        if ($id== 1) {
            //panah bawah
            $label= '<label class="col-form-label">Negatif <i class="feather icon-arrow-down"></i></label>';
        }elseif ($id== 2) {
            //panah kanan
            $label= '<label class="col-form-label">Range <i class="feather icon-arrow-right"></i></label>';
        }elseif ($id== 3) {
        //panah atas
        $label= '<label class="col-form-label">Positif <i class="feather icon-arrow-up"></i></label>';
        }else{
            $label= '';
        }

        return $label;
    }


    function lb_penilaian($penilaian=null){

        if (empty($penilaian)) {
            $label= '<label class="label label-xl lg-stat label-primary"></label>';
        }else{
            if ($penilaian >= 100) {
                //panah bawah
                $label= '<label class="label label-xl lg-stat label-success"></label>';
            }elseif ($penilaian >= 95 && $penilaian <=100) {
                //panah kanan
                $label= '<label class="label label-xl lg-stat label-warning"></label>';
            }elseif ($penilaian < 95) {
            //panah atas
            $label= '<label class="label label-xl  lg-stat label-danger"></label>';
            }
        }
        

        return $label;
    }

    function lb_capai($penilaian=null){

        if (empty($penilaian)) {
            $label= '';
        }else{
            if ($penilaian >= 100) {
                $label= '<label class="label label-xl lg-stat label-success"></label>';
            }elseif ($penilaian >= 95 && $penilaian <=100) {
                $label= '<label class="label label-xl lg-stat label-warning"></label>';
            }elseif ($penilaian < 95) {
            $label= '<label class="label label-xl  lg-stat label-danger"></label>';
            }
        }
        

        return $label;
    }

    function BTN_EDIT($id,$tgl,$parent,$UNIT){
        
        $btn = '<button class="btn waves-effect waves-light btn-primary btn-icon" onclick="ViewDetail(\''.$id.'\',\''.$tgl.'\',\''.$parent.'\',\''.$UNIT.'\')"><i class="feather icon-edit"></i></button>';
        return $btn;

    }

    function ses_role(){

        $CI = &get_instance();

        return session('role');
        
    } 
    function ses_unit(){

        $CI = &get_instance();

        return session('unit');
        
    } 
    function tgl($tgl='', $tipe='')
	{
		if (empty($tgl) or empty($tipe)) {
			return "";
		}else{


			if ($tgl != "0000-00-00 00:00:00") {
				$pc_satu	= explode(" ", $tgl);
				if (count($pc_satu) < 2) {	
					$tgl1		= $pc_satu[0];
					$jam1		= "";
				} else {
					$jam1		= $pc_satu[1];
					$tgl1		= $pc_satu[0];
				}

				$pc_dua		= explode("-", $tgl1);
				$tgl		= $pc_dua[2];
				$bln		= $pc_dua[1];
				$thn		= $pc_dua[0];
				if ($bln=='00') {
					$display="-";
				}else{
					$bln_pendek		= array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
					$bln_panjang	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

					$bln_angka		= intval($bln) - 1;

					if ($tipe == "l") {
						$bln_txt = $bln_panjang[$bln_angka];
						$display = $tgl." ".$bln_txt." ".$thn."  ".$jam1;
					} else if ($tipe == "s") {
						$bln_txt = $bln_pendek[$bln_angka];
						$display = $tgl."-".$bln_txt."-".$thn;
					} else if ($tipe == "sm") {
						$bln_txt = $bln_panjang[$bln_angka];
						$display = $tgl." ".$bln_txt." ".$thn;
					} else if ($tipe == "c") {
						$bln_txt = $bln_panjang[$bln_angka];
						$display = $tgl." ".$bln_txt." ".$thn."  ".$jam1;
					} 
				}
				return $display ;
			} else {
				return "-";
			}
		}
    }

function write($phpWord, $filename, $writers)
{
    $result = '';

    // Write documents
    foreach ($writers as $format => $extension) {
        $result .= date('H:i:s') . " Write to {$format} format";
        if (null !== $extension) {
            $targetFile = __DIR__ . "/results/{$filename}.{$extension}";
            $phpWord->save($targetFile, $format);
        } else {
            $result .= ' ... NOT DONE!';
        }
        $result .= EOL;
    }

    $result .= getEndingNotes($writers);

    return $result;
}

function bln_con($bln){ 
   if ($bln =='JANUARI') {
        $bulan = "01";
   }elseif ($bln =='FEBRUARI') {
        $bulan = "02";
   }elseif ($bln =='MARET') {
        $bulan = "03";
   }elseif ($bln =='APRIL') {
        $bulan = "04";
   }elseif ($bln =='MEI') {
        $bulan = "05";
   }elseif ($bln =='JUNI') {
        $bulan = "06";
   }elseif ($bln =='JULI') {
        $bulan = "07";
   }elseif ($bln =='AGUSTUS') {
        $bulan = "08";
   }elseif ($bln =='SEPTEMBER') {
        $bulan = "09";
   }elseif ($bln =='OKTOBER') {
        $bulan = "10";
   }elseif ($bln =='NOVEMBER') {
        $bulan = "11";
   }elseif ($bln =='DESEMBER') {
        $bulan = "12";
   }else{
        $bulan = "0".$bln;
   }
   return $bulan;
}

    function hariIndo ($hariInggris,$type=null) {
        if ($type==null) {
            switch ($hariInggris) {
            case 'Sun':
                return 'Ming';
            case 'Mon':
                return 'Sen';
            case 'Tue':
                return 'Sel';
            case 'Wed':
                return 'Rab';
            case 'Thu':
                return 'Kam';
            case 'Fri':
                return 'Jum';
            case 'Sat':
                return 'Sab';
            default:
                return 'hari tidak valid';
            }
        }elseif ($type="1") {
            //echo $type.$hariInggris;
            if ($hariInggris =="Sun" ||$hariInggris=='Sat') {
                return "red";
            }else{
                return "";
            }
        }
    }

    function color($id){
        if ($id ==0) {
            $color  = 'bg-c-green';
        }elseif ($id ==1) {
            $color  = 'bg-info';
        }elseif ($id ==2) {
            $color  = 'bg-instagram';
        }elseif ($id ==3) {
            $color  = 'bg-c-yellow';
        }else{
            $color  = 'bg-default';
        }
        return $color;


    }
    function colrand() {
         $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
         return '#' . $rand[rand(0,15)] . $rand[rand(0,15)] . $rand[rand(0,15)] . $rand[rand(0,15)] . $rand[rand(0,15)] . $rand[rand(0,15)];
    }

    function GetShift(){
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
        $data=[
            'shift' => $shift,
            'date'  => $dateNow
        ];
        return  $data;
    }
    function l_sh($shift){
      if ( $shift == 'PS') {
        $label=['name' => 'Pagi','jam' => '08:00 - 19:59' ];
      }elseif ($shift == 'M') {
        $label=['name' => 'Malam','jam' => '20:00 -07:59' ];
      }else{
        $label=['name' => $shift,'jam' => '' ];
      }
        return $label;
    }

    function scaleIMG($img,$jenis=null){
        //echo "<pre>",print_r ($img."<br>"),"</pre>";
        if (file_exists($img)) {
            list($width, $height, $type, $attr) = getimagesize($img);
            
            if (!empty($jenis)) {
               
               if ($jenis =="1") {
                    $data=[
                        'w'=> '70%',
                        'h'=> '100%',
                    
                    ];
                    return  $data;
                   
               }elseif ($jenis =="2") {
                 if ($width >$height  ) {
                    $data=[
                        'h'=> '100px',
                        'w'=> '180px',
                       
                    ];
                    return  $data;
                    
                }else{
                    $data=[
                        'w'=> '110px',
                        'h'=>'100px',
                    ];
                    return  $data;
                   
                }
               }else{
                    $data=[
                        'w'=> '100%',
                        'h'=> '100%',
                    
                    ];
                
                    return  $data;
               }
            }else{
                if ($width >=$height  ) {
                    $data=[
                        'w'=> '20%',
                        'h'=> '40%',
                       
                    ];
                    return  $data;
                }else{
                    $data=[
                        'w'=> '20%',
                        'h'=>'70%',
                    ];
        
                    return  $data;
                }
            }
        }
       
       
       
       
    }

    function createFolder(){
        if(!is_dir(APPPATH . "views/".sess()['unit_device']))
		{
			mkdir(APPPATH . "views/".sess()['unit_device'], 0755);
										
		}

        if(!is_dir(APPPATH . "views/".sess()['unit_device']."/cm"))
		{
			mkdir(APPPATH . "views/".sess()['unit_device']."/cm", 0755);
										
		}


        if(!is_dir(APPPATH . "views/".sess()['unit_device']."/pm"))
		{
			mkdir(APPPATH . "views/".sess()['unit_device']."/pm", 0755);
										
		}
    }

    function ImageLogo($tipe=null){
        $img= '';
        if ($tipe == 1) {
            $img = base_url()."/assets/injourney.png";
          
        }elseif ( $tipe == 2 ) {
            $img = base_url()."/assets/ias.png";
          
        }
        return $img ;
    }

    function coord_x($x)
    {
    if($x<26) $x = chr(ord('A')+$x);
    else
    {
        $x -= 26;
        $c1 = $x % 26;
        $c2 = intval(($x - $c1)/26);
        $x = chr(ord('A')+$c2).chr(ord('A')+$c1);
    }
        return $x;
    }

    // convert X,Y 0-based cell address into EXCEL B1-format pair
    function coord($y,$x)
    {
        return coord_x($x).($y+1);
    }
    
    function con_talend($shift){
        if($shift =='PS'){
            return "Shift Pagi 3";
        }elseif($shift=='M'){
            return "Shift Malam 26";
        }elseif($shift=='OH'){
            return "OH";
        }else{
            return "";
        }
        
    }
    
    function con_esikap($shift){
        if($shift =='PS'){
            return "ACPC P";
        }elseif($shift=='M'){
            return "ACPC M";
        }elseif($shift=='OH'){
            return "OH";
        }else{
             return "";
        }
    }
?>
