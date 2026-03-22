<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pdf {

    function pdf_create($html, $filename, $stream = TRUE, $paper = "portrait" ) {
        require_once(APPPATH . "third_party/dompdf/dompdf_config.inc.php");
        spl_autoload_register('DOMPDF_autoload');

        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
         $dompdf->set_paper("a4", $paper );
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf",array('Attachment'=>0));
        } else {
            $CI = & get_instance();
            $CI->load->helper('file');
            write_file($filename, $dompdf->output());
        }
    }

}