<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function sts($jenis,$kode){
        $ci =& get_instance();
        $res = $ci->Mod->getWhere('status',array('jenis' => $jenis,'kode_status' =>$kode ))->row_array();
        $status = $res['kode_status'];
        if($status == '0'){
            $label='<label class="label label-warning">'.$res['nama'].'</label>';
        }elseif($status == 1){
            $label='<label class="label label-info">'.$res['nama'].'</label>';
        }elseif($status == 2){
            $label='<label class="label label-info">'.$res['nama'].'</label>';
        }elseif($status == 5){
            $label='<label class="label label-warning">'.$res['nama'].'</label>';
        }elseif($status == 8){
            $label='<label class="label label-danger">'.$res['nama'].'</label>';
        }elseif($status == 9){
            $label='<label class="label label-success">'.$res['nama'].'</label>';
        }else {
            $label='<label class="label label-default">Unknown</label>';   
        }
      
        return $label;

    }
    
    
    function st($status) {
        $label = '';
        if($status == '0'){
            $label='<label class="label label-default">Draft</label>';
        }elseif($status == 6){
            $label='<label class="label label-info">Waiting for Approval Leader</label>';
        }elseif($status == 2){
            $label='<label class="label label-info">Waiting for Approval</label>';
        }elseif($status == 1){
            $label='<label class="label label-warning">Open</label>';
        }elseif($status == 3){
            $label='<label class="label label-success">Approved</label>';
        }elseif($status == 9){
            $label='<label class="label label-success">Close</label>';
        }elseif($status == 5){
            $label='<label class="label label-warning">Rejected</label>';
        }else {
            $label='<label class="label label-default">Unknown</label>';   
        }
      
        return $label;

    } 
    
    function lb_st($status){
        $label = '';
        if($status == '1'){
            $label='<label id="status" class="label label-success">ON</label>';
        }elseif($status == 0){
            $label='<label id="status" class="label label-danger">OFF</label>';
        }else {
            $label='<label class="label label-default">-</label>';   
        }
      
        return $label;
    }

    function lb_model($status){
        $label = '';
        if($status == 1 ||$status ==0 ){
            $label='<label class="label label-success">Active</label>';
        }elseif($label == 8){
            $label='<label class="label label-warning">Inactive</label>';
        }else{
            $label='<label class="label label-warning">Inactive</label>';
        }

        return $label;
        
    }

    function lb_pkt($status){
        $label = '';
        if($status == '1'){
            $label='<label id="status" class="label label-success">ON</label>';
        }elseif($status == 0){
            $label='<label id="status" class="label label-danger">OFF</label>';
        }else {
            $label='<label class="label label-default">-</label>';   
        }
      
        return $label;
    }
    function uh($status) {
        $label = '';
        if($status == '0'){
            $label='<label class="label label-default">Not Active</label>';
        }elseif($status == 1){
            $label='<label class="label label-success">Active</label>';
        }elseif($status == 0){
            $label='<label class="label label-info">On Progress</label>';
        }else {
            $label='<label class="label label-default">unknown</label>';   
        }
      
        return $label;

    } 


    function nh($status) {
        $label = '';
        if($status == '0'){
            $label='<label class="label label-default">Not Active</label>';
        }elseif($status == 1){
            $label='<label class="label label-success">Active</label>';
        }elseif($status == 0){
            $label='<label class="label label-info">On Progress</label>';
        }else {
            $label='<label class="label label-default">unknown</label>';   
        }
      
        return $label;

    } 


    function master_status($status){
        $label = '';
        if($status == 1){
            $label='<label class="label label-success">Active</label>';
        }elseif($label == 2){
            $label='<label class="label label-warning">Inactive</label>';
        }else{
            $label='<label class="label label-warning">Inactive</label>';
        }

        return $label;

    }


    function log_status($status){
        $label = '';
        if($status >= 86){
            $label='bg-c-red';
        }elseif($status >= 60 && $status <= 85 ){
            $label='bg-c-yellow';
        }elseif($status >= 30 && $status <= 59 ){
            $label='bg-c-blue';
        }else{
            $label='bg-c-green';
            
        }


        return $label;
    }
    
    function stat_prangkat($status){
        $label = '';
        if($status == 1){
            $label='<label class="label label-success pointer">Active</label>';
        }elseif($label == 0){
            $label='<label class="label label-warning">Inactive</label>';
        }else{
            $label='<label class="label label-warning">Unknown</label>';
        }
        return $label;
    }

    //label status untuk umum
    function stg($status) {
        $label = '';
        if($status == '0'){
            $label='<label class="label label-default">Draft</label>';
        }elseif($status == 1){
            $label='<label class="label label-info">Proses</label>';
        }elseif($status == 9){
            $label='<label class="label label-success">Finis</label>';
        }elseif($status == 2){
            $label='<label class="label label-success">Approved</label>';;
        }
        elseif($status == 6){
            $label='<label class="label label-warning">Rejected</label>';
        }else {
            $label='<label class="label label-default">Unknown</label>';   
        }
      
        return $label;

    } 
    
}