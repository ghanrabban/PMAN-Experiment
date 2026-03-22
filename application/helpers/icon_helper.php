<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{

    function ic($type_tiket) {
        $icon = '';
        if ($type_tiket == 2) {
            $icon = '<i class="feather icon-sunrise bg-c-blue update-icon"></i>';
        } elseif ($type_tiket == 1) {
            $icon = '<i class="feather icon-sunset bg-c-green update-icon"></i>';
        } else {
            $icon = '<i class="feather icon-help-circle bg-c-red update-icon"></i>'; // Jika type_tiket tidak dikenali, dapatkan ikon default atau sesuaikan dengan kebutuhan Anda.
        }
      
        return $icon;
    }

}