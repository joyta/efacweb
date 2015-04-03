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
if ( ! function_exists('crear_compra'))
{
    function crear_compra($comprobante=  array(), $detalles=array(), $entidad=array(),$transaccion= array())
    {
        $CI =& get_instance();        
        $CI->load->model('comprobante_model');
        $CI->load->model('entidad_model');
        $CI->load->model('establecimiento_model');
        $CI->load->model('producto_model');
        $CI->load->model('stock_model');
        $CI->load->model('kardex_model');
        $CI->load->model('transaccion_model');
        
        try{                                            
            $CI->db->trans_begin();
            $user = get_contexto();
            
            $comprobante['estado'] = "Registrado";
            $comprobante['tipo'] = '01';
            $comprobante['origen'] = 'Compra';
            $comprobante['establecimiento_id'] = $user['establecimiento_id'];
            $comprobante['entidad_id'] = $entidad['id'];                        
            $comprobante['usuario_id'] = $user['id'];
            
            //Kardex
            foreach ($detalles as $d) {
                $CI->kardex_model->registrar_ingreso($comprobante, $d);
            }
                        
            //Guarda comprobante
            $CI->comprobante_model->insert($comprobante);
            $CI->comprobante_model->insert_detalles($detalles, $comprobante);     
            
            //Cxp            
            $CI->transaccion_model->generar_cxc($comprobante,$transaccion);
            
            
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