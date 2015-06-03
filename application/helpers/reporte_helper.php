<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('report_to_pdf'))
{
    function report_to_pdf($data=array())
    {
        $CI =& get_instance();                 
        
        require_once("dompdf/dompdf_config.inc.php");

        $html = $CI->load->view($data['view'], $data, true);
        
        $dompdf = new DOMPDF();
        $dompdf->set_paper('a4', isset($data['orientation']) ? $data['orientation'] : 'portrait');
        $dompdf->load_html($html);
        $dompdf->render();
        
        $dompdf->stream($data['file_name']);        
    }
}