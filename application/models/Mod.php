<?php

defined('BASEPATH') OR exit('No direct script access allowed');

  class Mod extends CI_Model {

    function getData($t, $o = false){
      if($o == false){
        return $this->db->query("select * from $t");
      }else {
        return $this->db->query("select * from $t order by $o asc");
      }
    }

    function getcount($t, $w){
      $this->db->select('count(*) as jumlah');
      $this->db->from($t);
      return $this->db->where($w)->get();
    }

    // ex: $this->mod->getData('nama_tabel','id desc')->result_array();

    function getWhere($t, $w, $o = false){
      if($o == false){
        return $this->db->get_where($t, $w);
      }else{
        $exp = explode(' ',$o);
        return $this->db->order_by($exp[0], $exp[1])->get_where($t, $w);
      }
    }
    function getWhereOR($t, $w,$o=false){
      $this->db->select('*');
      $this->db->from($t);
      if($o == false){
        return $this->db->or_where($w)->get();
      }else{
        $exp = explode(' ',$o);
        return $this->db->order_by($exp[0], $exp[1])->or_where($w)->get();
      }
    }
    function getJoinWhereOR($tb1,$tb2, $w,$o=false){
      $this->db->select('*');
      $this->db->from($tb1);
      $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j, 'left');
      if($o == false){
        return $this->db->or_where($w)->get();
      }else{
        $exp = explode(' ',$o);
        return $this->db->order_by($exp[0], $exp[1])->or_where($w)->get();
      }
    }

    // ex: $this->mod->getWhere('nama_tabel','status = 1','id desc')->result_array();

    function getField($f, $w, $t){
     
      return $this->db->select($f)->where($w)->get($t);
    }

    // ex: $this->mod->getField('nama_tabel','status','1','nama_user')->row_array();

    function GetGroupWhere($t,$f, $w,$id ){

       return $this->db->query("select ".$f." from ".$t." where ".$w."= ".$id." group by ".$f);
    }
    function update($t, $w, $v, $d){
      $this->db->where($w, $v);
   	  $this->db->update($t, $d);
  	}
    function update2($t, $w, $d){
      $this->db->where($w);
      return $this->db->update($t, $d);
    }


    // ex: $this->mod->updateData('nama_tabel','status','1',$data);

    function delete($t, $w = false, $v = false){
      if($w == false && $v == false){
        $this->db->empty_table($t);
      }
      /*elseif ($w == true) {
        $this->db->delete($t, $w);
      }*/
      else{
        $this->db->where($w, $v);
        return  $this->db->delete($t);
      }
  	}
    function deletein($t, $w , $wi,$in ){
      $this->db->where_not_in($wi, $in);
      $this->db->where($w);
      
      $this->db->delete($t);
      
    }
   
    // ex: $this->mod->deleteData('nama_tabel','id','1');

    function multipleDelete($table, $arrayCondition){
  		$this->db->where($arrayCondition);
  	  $this ->db->delete($table);
  	}

    // $t = table, $l = banyaknya data, $s = dimulai dari, $c = kondisi, $o = orderby
    function getLimit($t, $l, $s, $c = false, $o = false){
      if($c == false && $o == false){
        return $this->db->get($t, $l, $s);
        
      }
    }

    function getLimitWhere($t, $l, $s, $w, $v, $o){
      $exp = explode(' ',$o);
      return $this->db->order_by($exp[0], $exp[1])->where($w, $v)->get($t, $l, $s);
    }

    
    function getAllLimit($t, $l, $s, $o){
      $exp = explode(' ',$o);
      return $this->db->order_by($exp[0], $exp[1])->get($t, $l, $s);
    }

    // ex: $this->mod->getLimit('nama_tabel','10','0','status = 1','id desc')->result_array();

   
    function getJoin($tb1, $tb2, $j){
      $this->db->select('*');
    
        $this->db->from($tb1);
        return $this->db->join($tb2,$j,'left')->get();
     
    }
    function getJoinWhere($tb1, $tb2, $j, $f = false){
      $this->db->select('*');
      $this->db->from($tb1);
      $this->db->join($tb2, $j, 'left');
      return $this->db->where($f)->get();
    }
    // ex: $this->mod->getJoinWhere('nama_tabel_1','nama_tabel_2','id','1')->row_array();

    function getJoinWhereIn($tb1, $tb2, $j, $fl,$p){
      $this->db->select('*');
      $this->db->from($tb1);
      $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j);
      return $this->db->where_in($tb1.'.'.$fl,$p)->get();
      
    }
    function getWhereIn($table, $field_in,$val_in,$where=false,$o=false){
     
      $this->db->select('*');
      $this->db->from($table);
      if($where == true){
        $this->db->where($where);
      }
      if($o == false){
        return $this->db->where_in($field_in,$val_in)->get();
      }else{
         $exp = explode(' ',$o);
        return $this->db->order_by($exp[0], $exp[1])->where_in($fl,$in)->get();
      }
    }
    
    function getJoinWhere2($tb1,$tb2, $tb3, $j,$j2,$j3, $c = false){
      $this->db->select('*');
      if($c == false){
        echo $c;
        $this->db->from($tb1);
        $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j, 'left');
        $this->db->join($tb3, $tb3.'.'.$j2.' = '.$tb1.'.'.$j2, 'left');
        return $this->db->where($tb1.'.'.$j, $j3)->get();
      }else{
         $this->db->from($tb1);
        return $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j)->get();
        //$tb1='tb_users',$tb2='tb_login',$tb3='provinsi',$j='user_id',$j2='provinsi_id',$j3=session
       
      }
      
    }
    function get_join_Where($tb1, $tb2, $j, $c = false){
      $this->db->select('*');
      if($c == false){
        $this->db->from($tb1);
        return $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j)->get();
      }else{
        $this->db->from($tb1);
        $this->db->join($tb2, $tb1.'.'.$j.' = '.$tb2.'.'.$j);
        return $this->db->where($tb1.'.'.$j, $c)->get();
      }
    }
    

     function ShowColum($p=false){
      if ($p== false) {
       $data= $this->db->query("Show COLUMNS in".$p);
        return $data;
      }
    }
    function get_items($table='') {
     
      $this->db->select('*');
      $this->db->from($table);
       $this->db->where('status', '1');
      $query = $this->db->get();
      return $query->result_array();
    }
   
   
    function getWhereLike($table,$param,$like,$where=false,$fl=false,$in=false,$o=false){
     // $this->db->where($w);
      if($where == true){
        $this->db->where($where);
      }
      if($o == true){
        $this->db->or_where($o);
      }
      
      if($in == true){
        $this->db->where_in($fl,$in);
      }
      $this->db->like($param,$like);
      return $this->db->get($table);
    }
    

     function getNotin($t,$wn,$f){
        $this->db->where_not_in($wn,$f);
        return $this->db->get($t);
    }
    public function getTree($id){

        $this->db->select('*');
        $this->db->from('master_kak');
        $this->db->where('PARENTID', $id);

        $parent = $this->db->get();
        
        $categories = $parent->result_array();
        $i=0;
        foreach($categories as $p_cat){
             if ($this->CekParent($p_cat['idmasterkak'])> 0) {
               $categories[$i]['sub'] = $this->getTree($p_cat['idmasterkak']);
             }
            $i++;
        }
       // echo "<pre>",print_r ($categories),"</pre>";
        return $categories;
    }
     public function CekParent($id){

        return  $this->getWhere('master_kak',array('PARENTID'=>$id))->num_rows();
    } 

    public function CekDuplikat($param,$t){
      $this->db->select($param.',count('.$param.') as total');
      $this->db->from($t);
      $this->db->group_by($param);
      $this->db->having('COUNT('.$param.') > 1');
      return $this->db->get();
    } 
    
    public function SumWhere($param,$t,$w){
      $this->db->select('sum('.$param.') as total');
      $this->db->from($t);
      $this->db->where($w);
      return $this->db->get();
    } 
    function SumNotin($t,$param,$f){
      $this->db->select('count('.$param.') as total');
      $this->db->from($t);
      $this->db->where_not_in($param,$f);
      return $this->db->get();
  }

  function CountData($t,$param,$f){
    $this->db->select('count('.$param.') as total,'.$param);
    $this->db->from($t);
    $this->db->where($f);
    $this->db->group_by($param);
    return $this->db->get();
  }
  function CountDataPag($t,$param,$f,$p_src,$src,$jenis){
   
    $this->db->select('count('.$param.') as total,'.$param);
    $this->db->from($t);
    $this->db->where($f);
    if (!empty($jenis)) {
      $this->db->where($jenis);
    }
    if (!empty($src)) {
      foreach ($p_src as $key => $value) {
        $this->db->$key($value,$src );
      }
    //  like('nama_fasilitas',$src );
      // $this->db->or_like('ip_address', $src);

    }
    $this->db->group_by($param);
    return $this->db->get();
  }

function CountData2($t,$param,$param2,$f){
  $this->db->select('count('.$param.') as total,'.$param.','.$param2);
  $this->db->from($t);
  $this->db->where($f);
  $this->db->group_by($param2);
  return $this->db->get();
}
        
    function getgroup($t,$p,$s){
      $this->db->select($p);
      $this->db->from($t);
      $this->db->group_by($p);
      $this->db->order_by($s, 'ASC');
      $this->db->where('status', '1');
      return $this->db->get();
    }

    function GetCustome($query){
      $query =$query;
      $res_query = $this->db->query($query);

      return $res_query;
    }
   
    function GetCustomeDB2($query){
      $this->db2 = $this->load->database('fids2', TRUE);
      return $this->db2->query($query);
      // $query =$query;
      // $this->db2 = $this->load->database('fids2', TRUE);
      // $res_query = $this->db2->query($query);

      // return $res_query;
    }

    function getWhereLimit($t, $w,$limit,$from,$p_src,$src,$jenis,$o=false){

      $this->db->select('*');
      $this->db->from($t);
      $this->db->where($w);
    
    
      if (!empty($jenis)) {
        $this->db->where($jenis);
      }
      if (!empty($src)) {
        foreach ($p_src as $key => $value) {
          //echo "<pre>",print_r ($key),"</pre>";
         $this->db->$key($value,$src);
         $this->db->$key($value,$src);
        //  echo "<pre>",print_r ( $this->db->$key($value,$src)),"</pre>";
        // 
        // print_r($this->db->$key($value,$src));
        }
      //  like('nama_fasilitas',$src );
        // $this->db->or_like('ip_address', $src);
  
      }
    
         $this->db->limit($limit, $from);

         if($o == false){
          return  $this->db->get();
        }else{
          $exp = explode(' ',$o);
          return $this->db->order_by($exp[0], $exp[1])->get();
        }
      
    }

    function getLike($table,$like){
     
       $this->db->like($like);
       return $this->db->get($table);
     }

     function getWL($t, $w,$limit){

      $this->db->select('*');
      $this->db->from($t);
      $this->db->where($w);
    
      $this->db->limit($limit, 0);
      return $this->db->get();
    }

    // function generateTree($items = array(), $parent = -1){
    //   $level=1;
    //   $tree = '<ul id="'.$parent.'"> ';
    //   for($i=0, $ni=count($items); $i < $ni; $i++){
    //     if($items[$i]['PARENTID'] == $parent){
    //        $level=$items[$i]['tingkat']+1;

    //       $tree .= '<li class="parent_li"  > 
    //                 <span title="Collapse this branch" data-toggle="collapse" data-target="#'.$items[$i]['IDJABATAN'].'">';
    //       $tree .= $items[$i]['NAME'];
    //         $tree .='<hr class="mg-1">
    //                 <small>'.$items[$i]['pejabat'].'</small></span>
    //         ';
    //       $tree .="
    //       <div class='btn-group btn-group-xs'  >
    //       <button type='button' class='btn btn btn-info add-formmenu' onclick=add_data_(".$items[$i]['IDJABATAN'].",".$items[$i]['tingkat'].") >Tambah</button>
    //       <button type='button' class='btn btn btn-info edit-formmenu' onclick=edit_data_(".$items[$i]['IDJABATAN'].",".$items[$i]['tingkat'].") >Edit</button>
    //       <button type='button' class='btn btn-default' onclick=DeleteData(".$items[$i]['IDJABATAN'].",'jabatan','IDJABATAN')>Hapus</button>
    //     </div>";
    //       $tree .= $this->generateTree($items, $items[$i]['IDJABATAN']);
    //       $tree .= '</li>';
    //     }
    //   }
    //   $tree .= '</ul>';
     
    //   return $tree;
    // }
     function CekToken($token){
       
        $query = "SELECT * FROM api_integrasi WHERE access_token ='".$token."'";
        $res_query = $this->db->query($query);
   
        return $res_query;
  
    }
    
    public function GetCustome2($sql, $bind = [])
{
    return $this->db->query($sql, $bind);
}
   
}

