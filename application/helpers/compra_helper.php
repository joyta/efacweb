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
            $comprobante['movimiento_stock'] = 'Incremento';
            $comprobante['establecimiento_id'] = $user['establecimiento_id'];
            $comprobante['entidad_id'] = $entidad['id'];                        
            $comprobante['usuario_id'] = $user['id'];
            
            //Kardex
            foreach ($detalles as $d) {
                $CI->kardex_model->registrar_ingreso_compra($comprobante, $d);                
            }
                        
            //Guarda comprobante
            $CI->comprobante_model->insert($comprobante);
            $CI->comprobante_model->insert_detalles($detalles, $comprobante); 
            
            //Series
            foreach ($detalles as $d) {                               
                $prod = $CI->producto_model->get($d['producto_id']);
                if($prod->tipo_stock=='Serie'){
                    $aSeries = explode(',', $d['series']);
                    $nSeries = count($aSeries);
                    $nCantidad = $d['cantidad']*1;
                    if($nSeries !== $nCantidad){
                        throw new Exception("El cantidad de series ingresadas no corresponde a lo especificado: \n- Producto: $prod->codigo - $prod->nombre\n- Cantidad ingresada: $nCantidad\n- Número series: $nSeries");
                    }else{
                        foreach ($aSeries as $sSerie) {
                            if(strlen($sSerie) == 0) throw new Exception("Una o varías series no son válidas: \n- Producto: $prod->codigo - $prod->nombre");
                            if($CI->comprobante_model->contar_series($sSerie, $prod->id) > 0) throw new Exception("La serie $sSerie ya ha sido registrada para el producto: \n- Producto: $prod->codigo - $prod->nombre");
                            $serie = array('numero'=>$sSerie,'producto_id'=>$prod->id, 'detallecompra_id'=>$d['id'], 'establecimiento_id'=>$user['establecimiento_id']);
                            $CI->comprobante_model->insert_serie($serie);
                        }
                    }
                }
            }
            
            //Cxp            
            $CI->transaccion_model->generar_cxp($comprobante,$transaccion);
            
            
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