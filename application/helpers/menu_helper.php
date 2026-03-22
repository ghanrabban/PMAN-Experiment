<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function fetch_menu(){
        $ci =& get_instance();
        if (sess()['type_user'] =='super') {
            $data = $ci->Mod->getWhere('menu',array('parent' => '-1','status !=' =>8 ))->result_array();
        }else{
            $data = $ci->Mod->GetCustome("SELECT b.* FROM role_akses a left join menu b on b.idmenu= a.id_menu where  b.parent= '-1' and status !=8 and a.id_role='".sess()['type_user']."' and (a.create = 1 or a.read = 1 or a.update =1 or a.delete = 1)")->result_array();
        }
      
       
    //    echo "<pre>",print_r ( $data),"</pre>";
        foreach ($data as $key => $value) {
            $data[$key]['sub']=fetch_sub_menu($value['idmenu']);
        }
        return $data;

    }

    function fetch_sub_menu($sub_menu){
        $ci =& get_instance();
        if (sess()['type_user'] =='super') {
            $data_sub = $ci->Mod->getWhere('menu',array('parent' => $sub_menu,'status !=' =>8 ))->result_array();
        }else{
            $data_sub = $ci->Mod->GetCustome("SELECT b.* FROM role_akses a left join menu b on b.idmenu= a.id_menu where  b.parent= '".$sub_menu."' and status !=8 and a.id_role='".sess()['type_user']."' and (a.create = 1 or a.read = 1 or a.update =1 or a.delete = 1) ORDER BY position ASC")->result_array();
            
        }
        // 
        return $data_sub;
    } 

    function CountDataPag($p){
        $ci =& get_instance();

        $data_sub = $ci->Mod->CountDataPag($p['table'],$p['pk'],$p['parameter'],$p['param_src'],$p['src'],$p['filter'])->num_rows();
        return $data_sub;
    }

    function DataPag($t,$w,$limit,$from,$src_param,$src,$jenis,$order=null){
        $ci =& get_instance();
        $start      = ($from>1) ? ($from * $limit) - $limit : 0;
      
        $data      = $ci->Mod->getWhereLimit($t,$w,$limit,$start,$src_param,$src,$jenis,$order)->result_array();
     
        return   $data;
    }

    function BTNPag($from,$total_page,$total_data,$limit,$jenis=null){
       
        ($from ==0 ? $endData= $limit :$endData=$from*$limit );
        if ($from == 0 ) {
            $startData = 1;
        }else{
            $startData =  ($endData-$limit) +1;
        }
        $output = '
        <div class="col-xs-12 col-sm-12 col-md-5"><div class="dataTables_info" id="alt-pg-dt_info" role="status" aria-live="polite">Showing '. $startData .' to '.$endData.' of '.$total_data.' entries</div></div>
        <div class="col-xs-12 col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
           <ul class="pagination">';
        if (empty($from)) {
            $from= 1;
        }

      
        // if (! isset($from))
        //     $from = 1;
        $pages= $total_page;
        if (!empty($jenis)) {
             if ($pages > 1) {
                if ($from == 1)
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">First</a></li>';
                else
                    $output = $output . '<li class="paginate_button page-item first" id="alt-pg-dt_first"><a href="#!"  class="page-link" onclick="'.$jenis.'(\''. (1) . '\')">First</a></li>
                    <li class="paginate_button page-item previous" id="alt-pg-dt_previous" ><a href="#!"  class="page-link" onclick="'.$jenis.'(\'' . ($from - 1) . '\')">Previous</a></li>';
        
                if (($from - 3) > 0) {
                    if ($from == 1)
                        $output = $output . '<li class="paginate_button page-item active"><a href="#!"  class="page-link">1</a></li>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!" class="page-link" onclick="'.$jenis.'(\'1\')" >1</a></li>';
                }
                if (($from - 3) > 1) {
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">...</a></li>';
                }
        
                for ($i = ($from - 2); $i <= ($from + 2); $i ++) {
                    if ($i < 1)
                        continue;
                    if ($i > $pages)
                        break;
                    if ($from == $i)
                        $output = $output . '<li class="paginate_button page-item active"><a href="#!"  id=' . $i . '  class="page-link">'. $i .'</a></li>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!"   class="page-link" onclick="'.$jenis.'(\'' .  $i . '\')">' . $i . '</a></li>';
                }
        
                if (($pages - ($from + 2)) > 1) {
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">...</a></li>';
                }
                if (($pages - ($from + 2)) > 0) {
                    if ($from == $pages)
                        $output = $output . '<span id=' . ($pages) . ' class="current">' . ($pages) . '</span>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!"  class="page-link" onclick="'.$jenis.'(\''. ($pages) . '\')" >' . ($pages) . '</a></li>
                    ';
                }
        
                if ($from < $pages)
                    $output = $output . '
                    <li class="paginate_button page-item next" id="alt-pg-dt_next"><a href="#!"   class="page-link" onclick="'.$jenis.'(\'' . ($from + 1) . '\')">Next</a></li>
                    <li class="paginate_button page-item last" id="alt-pg-dt_last"><a href="#!"   class="page-link" onclick="'.$jenis.'(\'' . ($pages) . '\')">Last</a></li>
                    
                ';
        
                else
                    $output = $output . '<li class="paginate_button page-item last disabled" id="alt-pg-dt_last"><a href="#!"  class="page-link">Last</a></li>';
              
            }
        }else{
            if ($pages > 1) {
                if ($from == 1)
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">First</a></li>';
                else
                    $output = $output . '<li class="paginate_button page-item first" id="alt-pg-dt_first"><a href="#!"  class="page-link" onclick="FilterData(\''. (1) . '\')">First</a></li>
                    <li class="paginate_button page-item previous" id="alt-pg-dt_previous" ><a href="#!"  class="page-link" onclick="FilterData(\'' . ($from - 1) . '\')">Previous</a></li>';
        
                if (($from - 3) > 0) {
                    if ($from == 1)
                        $output = $output . '<li class="paginate_button page-item active"><a href="#!"  class="page-link">1</a></li>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!" class="page-link" onclick="FilterData(\'1\')" >1</a></li>';
                }
                if (($from - 3) > 1) {
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">...</a></li>';
                }
        
                for ($i = ($from - 2); $i <= ($from + 2); $i ++) {
                    if ($i < 1)
                        continue;
                    if ($i > $pages)
                        break;
                    if ($from == $i)
                        $output = $output . '<li class="paginate_button page-item active"><a href="#!"  id=' . $i . '  class="page-link">'. $i .'</a></li>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!"   class="page-link" onclick="FilterData(\'' .  $i . '\')">' . $i . '</a></li>';
                }
        
                if (($pages - ($from + 2)) > 1) {
                    $output = $output . '<li class="paginate_button page-item first disabled" id="alt-pg-dt_first"><a href="#!"  class="page-link">...</a></li>';
                }
                if (($pages - ($from + 2)) > 0) {
                    if ($from == $pages)
                        $output = $output . '<span id=' . ($pages) . ' class="current">' . ($pages) . '</span>';
                    else
                        $output = $output . '<li class="paginate_button page-item "><a href="#!"  class="page-link" onclick="FilterData(\''. ($pages) . '\')" >' . ($pages) . '</a></li>
                    ';
                }
        
                if ($from < $pages)
                    $output = $output . '
                    <li class="paginate_button page-item next" id="alt-pg-dt_next"><a href="#!"   class="page-link" onclick="FilterData(\'' . ($from + 1) . '\')">Next</a></li>
                    <li class="paginate_button page-item last" id="alt-pg-dt_last"><a href="#!"   class="page-link" onclick="FilterData(\'' . ($pages) . '\')">Last</a></li>
                    
                ';
        
                else
                    $output = $output . '<li class="paginate_button page-item last disabled" id="alt-pg-dt_last"><a href="#!"  class="page-link">Last</a></li>';
              
            }
        }
           
            $output = $output .'
                                </ul>
                        </div>
                    </div>';
        $data['start']  = $startData;
     
        $data['from']   = $from;
        $data['total']  = $total_data;
        $data['page']   = $total_page;
        $data['label']  = $output;
            return $data;
        
    }
    function pagin($p){
        $ci =& get_instance();
        
        $data['pag']            = BTNPag($p['from'],$p['total_page'], $p['total_data'],$p['limit'],(isset($p['jenis'])? $p['jenis']: ''));
        
        // $count= 
        // base_url().$url;
		// $config['base_url']     =
		// $config['total_rows']   = $c;
		// $config['per_page']     = $limit;
        //$t,$w,$limit,$from,$src_param,$src;
         $data['data']          = DataPag($p['table'],$p['parameter'],$p['limit'],$p['from'],$p['param_src'],$p['src'],$p['filter'],(isset($p['order'])? $p['order']: ''));
         $data['limit']         = $p['limit'];
         $data['from']          = $p['from'];
         $data['src']           = $p['src'];
         return $data;
    }
    
    // 
}