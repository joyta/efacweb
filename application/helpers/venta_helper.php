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
if ( ! function_exists('crear_venta'))
{
    function crear_venta($comprobante=  array(), $detalles=array(), $partner=array())
    {
        $CI =& get_instance();
        $CI->load->model('puntoemision_model');
        $CI->load->model('comprobante_model');
        $CI->load->model('partner_model');
        $CI->load->model('establecimiento_model');
        $CI->load->model('producto_model');
        $CI->load->model('stock_model');
        $CI->load->model('kardex_model');
        
        $CI->load->config('efac');
        
        try{                                            
            $CI->db->trans_begin();
            $user = get_contexto();
            
            $empresa = $CI->partner_model->get_empresa();
            
            $comprobante['ambiente'] = config_item('sri_ambiente') == 1 ? "PRUEBAS":"PRODUCCION";
            $comprobante['estado'] = "Registrado";
            $comprobante['origen'] = 'Venta';
            $CI->puntoemision_model->generar_numero($comprobante);
            $comprobante['fecha'] = date("Y-m-d H:i:s");
            $comprobante['partner_id'] = $partner['id'];                        
            $comprobante['usuario_id'] = $user['id'];
            
            //Kardex
            foreach ($detalles as $d) {                
                $CI->kardex_model->registrar_egreso($comprobante, $d);
            }                       
            
            //Guarda comprobante
            $CI->comprobante_model->insert($comprobante);
            $CI->comprobante_model->insert_detalles($detalles, $comprobante);                        
            
            //Generar clave acceso
            $comprobante['clave_acceso'] = generar_clave_acceso(array_to_object($comprobante), $empresa);
            
            //Generar xml
            $data = array();
            $listadetalles = array_to_object($detalles);
            foreach ($listadetalles as $d) {
                $d->producto = $CI->producto_model->get($d->producto_id);
            }            
            $data['partner'] = array_to_object($partner);
            $data['empresa'] = $empresa;
            $data['comprobante'] = array_to_object($comprobante);
            $data['detalles'] = $listadetalles;
            $data['establecimiento'] = $CI->establecimiento_model->get($comprobante['establecimiento_id']);
            $comprobante['xml'] = $CI->load->view('ventas/venta_xml',$data,TRUE);
            
            //Actualiza
            $CI->db->where('id',$comprobante['id']);
            $CI->db->update("tributario.comprobante",array('xml'=>$comprobante['xml'],'clave_acceso'=>$comprobante['clave_acceso']));
            
            if ($CI->db->trans_status() === FALSE){
                $CI->db->trans_rollback();
            }else{
                $CI->db->trans_commit();
            }
            return 'ok';
        }  catch (Exception $exc){
            $CI->db->trans_rollback();
            return 'Error: '.$exc->getMessage();
        }
        
    }
}

if ( ! function_exists('generar_clave_acceso'))
{
    function generar_clave_acceso($comprobante=NULL, $empresa=NULL)
    {
        $fecha = date("dmY", strtotime($comprobante->fecha)); //[8]
        $tipo = $comprobante->tipo; //[2]
        $ruc = $empresa->documento; //[13]
        $ambiente = '1';//[1] - Pruebas 1, Producción 2
        $numero = str_replace('-', '', $comprobante->numero); //[6]+[9] = 15
        $codigo = str_pad($comprobante->id, 8, '0', STR_PAD_LEFT); //[8]
        $tipoEmision = '1'; //[1]
        
        $clave = $fecha.$tipo.$ruc.$ambiente.$numero.$codigo.$tipoEmision;               
        $digito = generar_digito_verificador($clave); //[1]
                        
        return $clave.$digito;
    }
}

if (!function_exists('generar_digito_verificador')) {

    function generar_digito_verificador($_rol) {
        /* Bonus: remuevo los ceros del comienzo. */
        /*while ($_rol[0] == "0") {
            $_rol = substr($_rol, 1);
        }*/
        
        $factor = 2;
        $suma = 0;
        for ($i = strlen($_rol) - 1; $i >= 0; $i--) {
            $suma += $factor * $_rol[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - ($suma % 11);
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        
        return $dv;
    }

}