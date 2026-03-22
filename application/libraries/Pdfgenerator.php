<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . "third_party/dompdf-master/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{
    public function generate($html, $filename = '',  $paper = '', $orientation = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
            // return "Tidak disimpan".$stream;
        } else {
            // return " disimpan";
            $pdf_gen = $dompdf->output();
            $pdfroot  = "doc/file/".$filename. ".pdf";
            if(!file_put_contents($pdfroot,$pdf_gen)){
              $repot =$filename.'Not OK!';
            }else{
                $repot =$filename.".pdf";
            }
            return  $repot;
            // return $dompdf->output();
        }
    }
}