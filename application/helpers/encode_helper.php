<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * efac
 *
 * Helpers personales para arrays
 *
 * @package		efac
 * @author		efac
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * get_contexto 
 *
 * @access	public
 * @param	mixed
 * @return	array
 */
if ( ! function_exists('array_to_object'))
{
    function array_to_object($array=array())
    {
        return json_decode(json_encode($array));
    }
}

if ( ! function_exists('page_map'))
{
    function page_map($title, $url)
    {
        if($url){
            $path = base_url();
            return "<a href='$path$url'><i class='fa fa-reply'></i> <strong>$title</strong></a>";
        }  else {
            return $title;
        }
    }
}

if ( ! function_exists('label_tipo_comprobante'))
{
    function label_tipo_comprobante($tipo="01")
    {
        $tipos = array("01"=>'Factura','04'=>'Nota de crédito');
        return $tipos[$tipo];
    }
}

if ( ! function_exists('label_estado_comprobante'))
{
    function label_estado_comprobante($estado)
    {
        $css = "";
        switch ($estado) {
            case 'Registrado': $css = 'info'; break;
            case 'Anulado': $css = 'danger'; break;
            
            case 'Devuelto': $css = 'warning'; break;
            case 'NoAutorizado': $css = 'warning'; break;
            
            case 'Recibido': $css = 'primary'; break;
            case 'Autorizado': $css = 'success'; break;
            
            default: $css="info"; break;
        }
        
        return "<span class='label label-$css'>$estado</span>";
    }
}

if ( ! function_exists('label_estado_transaccion'))
{
    function label_estado_transaccion($estado)
    {
        $css = "";
        switch ($estado) {
            case 'Pendiente': $css = 'info'; break;
            case 'Parcial': $css = 'warning'; break;
            case 'Pagado': $css = 'success'; break;
            case 'Anulado': $css = 'warning'; break;
            case 'Cerrado': $css = 'success'; break;
            default: $css="info"; break;
        }
        return "<span class='label label-$css'>$estado</span>";
    }
}

if ( ! function_exists('get_valor_parametro'))
{
    function get_valor_parametro($codigo)
    {
        $CI =& get_instance();        
        $CI->load->model('parametro_model');        
        return $CI->parametro_model->get_valor_parametro($codigo);
    }
}