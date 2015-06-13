<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Validate email address
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

if ( ! function_exists('send_email_notificacion_comprobante'))
{
    function send_email_notificacion_comprobante(&$data, $comprobante, $entidad, $empresa)
    { 
        $CI =& get_instance();
        $CI->load->model('parametro_model');   
        
        $CI->load->library('email');   
        $CI->load->helper('file');
        
        //$CI->email->set_newline("\r\n");       
        //$CI->email->set_crlf("\r\n");        
        $CI->email->smtp_user = $CI->parametro_model->get_valor_parametro('SMTP_USER');
        $CI->email->smtp_pass = $CI->parametro_model->get_valor_parametro('SMTP_PASSWORD');        
        
        #send email            
        $CI->email->from('noreply@efac.com', 'eFac');
        $CI->email->to($data['to']);
        $CI->email->subject($data['asunto']);                
        
        $CI->load->vars($data);
        $msj = $CI->load->view($data['view'],'',TRUE);
        
        $CI->email->message($msj);
        
        $CI->email->attach(config_item('efac_path_autorizado').$comprobante->tipo.'_'.$comprobante->numero.'.xml');
        $CI->email->attach(config_item('efac_path_ride').$comprobante->tipo.'_'.$comprobante->numero.'.pdf');                                 
        
        if($CI->email->send()){
            return 'ok';
        }else{            
            return $CI->email->print_debugger();
        }       
    }
}
