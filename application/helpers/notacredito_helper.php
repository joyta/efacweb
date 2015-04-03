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


if ( ! function_exists('crear_nota_credito'))
{
    function crear_nota_credito($comprobante=  array(), $detalles=array(), $entidad=array())
    {        
        $CI =& get_instance();
        $CI->load->model('puntoemision_model');
        $CI->load->model('comprobante_model');
        $CI->load->model('entidad_model');
        $CI->load->model('establecimiento_model');
        $CI->load->model('producto_model');
        $CI->load->model('stock_model');
        $CI->load->model('kardex_model');
        
        $CI->load->config('efac');        
        
        try{                                            
            $CI->db->trans_begin();
            $user = get_contexto();
            
            $empresa = $CI->entidad_model->get_empresa();
            $referencia = $CI->comprobante_model->get($comprobante['referencia_id']);            
            
            $comprobante['ambiente'] = config_item('sri_ambiente') == 1 ? "PRUEBAS":"PRODUCCION";
            $comprobante['estado'] = "Registrado";
            $comprobante['origen'] = 'Venta';
            $CI->puntoemision_model->generar_numero($comprobante);
            $comprobante['fecha'] = date("Y-m-d H:i:s");
            $comprobante['entidad_id'] = $entidad['id'];                        
            $comprobante['usuario_id'] = $user['id'];
            
            //Kardex
            foreach ($detalles as $d) {                
                $CI->kardex_model->registrar_ingreso($comprobante, $d);
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
            $data['entidad'] = array_to_object($entidad);
            $data['empresa'] = $empresa;
            $data['comprobante'] = array_to_object($comprobante);
            $data['referencia'] = $referencia;
            $data['detalles'] = $listadetalles;
            $data['establecimiento'] = $CI->establecimiento_model->get($comprobante['establecimiento_id']);
            $comprobante['xml'] = $CI->load->view('ventas/nota_credito_xml',$data,TRUE);
            
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
