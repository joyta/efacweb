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
            $establecimiento = $CI->establecimiento_model->get($comprobante['establecimiento_id']);
            $comprobante['xml'] = generar_xml_notacredito(array_to_object($comprobante), $referencia, $listadetalles, array_to_object($entidad), $establecimiento, $empresa);
            
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


if ( ! function_exists('generar_xml_notacredito'))
{
    function generar_xml_notacredito($comprobante, $referencia, $detalles, $entidad, $establecimiento, $empresa)
    {
        $numero = explode('-', $comprobante->numero);
        $tipoidentificacion = "08";
        switch ($entidad->tipo_documento) {
            case 'Ruc': $tipoiden = '04';break;
            case 'Cedula': $tipoiden = '05';break;
            case 'Pasaporte': $tipoiden = '06';break;    
            case 'ClienteOcacional': $tipoiden = '07';break;    
            default: break;
        }

        $EMPRESA_OBLIGADA_CONTABILIDAD=get_valor_parametro("EMPRESA_OBLIGADA_CONTABILIDAD");
        $EMPRESA_NUMERO_RESOLUCION=get_valor_parametro("EMPRESA_NUMERO_RESOLUCION");
    
        $w = new XMLWriter;
        $w->openMemory();
        $w->setIndent(true);
        $w->setIndentString('   ');        
        $w->startDocument('1.0', 'UTF-8');
        
        $w->startElement('notaCredito');
            $w->writeAttribute('id', 'comprobante');
            $w->writeAttribute('version', '1.1.0');

            $w->startElement('infoTributaria');
                $w->writeElement('ambiente',config_item('sri_ambiente'));
                $w->writeElement('tipoEmision',1);
                $w->writeElement('razonSocial',$empresa->razon_social);
                $w->writeElement('nombreComercial',$empresa->nombre_comercial);
                $w->writeElement('ruc',$empresa->documento);
                $w->writeElement('claveAcceso',$comprobante->clave_acceso);
                $w->writeElement('codDoc',$comprobante->tipo);
                $w->writeElement('estab',$numero[0]);
                $w->writeElement('ptoEmi',$numero[1]);
                $w->writeElement('secuencial',$numero[2]);
                $w->writeElement('dirMatriz',$empresa->direccion);
            $w->endElement();            

            $w->startElement('infoNotaCredito');
                $w->writeElement('fechaEmision',date("d/m/Y", strtotime($comprobante->fecha)));
                $w->writeElement('dirEstablecimiento',$establecimiento->direccion);
                $w->writeElement('tipoIdentificacionComprador',$tipoidentificacion);
                $w->writeElement('razonSocialComprador',$entidad->razon_social);
                $w->writeElement('identificacionComprador',$entidad->documento);
                
                if($EMPRESA_OBLIGADA_CONTABILIDAD==='SI'){
                    $w->writeElement('obligadoContabilidad','SI');
                }
                if($EMPRESA_NUMERO_RESOLUCION){
                    $w->writeElement('contribuyenteEspecial',$EMPRESA_NUMERO_RESOLUCION);
                }
                                
                $w->writeElement('codDocModificado',$referencia->tipo);
                $w->writeElement('numDocModificado',$referencia->numero);
                $w->writeElement('fechaEmisionDocSustento',date("d/m/Y", strtotime($referencia->fecha)));                
                $w->writeElement('totalSinImpuestos',number_format($comprobante->total_sin_impuestos, 2));                
                $w->writeElement('valorModificacion',number_format($comprobante->importe_total, 2));
                $w->writeElement('moneda', 'DOLAR');
                
                $w->startElement('totalConImpuestos');
                    $w->startElement('totalImpuesto');
                        $w->writeElement('codigo',2);
                        $w->writeElement('codigoPorcentaje',0);
                        $w->writeElement('baseImponible', number_format($comprobante->baseIva0, 2));                        
                        $w->writeElement('valor','0.00');                
                    $w->endElement();
                    $w->startElement('totalImpuesto');                                
                        $w->writeElement('codigo',2);
                        $w->writeElement('codigoPorcentaje',2);
                        $w->writeElement('baseImponible', number_format($comprobante->baseIva12, 2));                        
                        $w->writeElement('valor',number_format($comprobante->iva12, 2));
                    $w->endElement();
                $w->endElement();
            
                $w->writeElement('motivo','DEVOLUCIÓN');                
            $w->endElement();

            $w->startElement('detalles');
            foreach($detalles as $detalle){
                $w->startElement('detalle');
                    $w->writeElement('codigoInterno',$detalle->codigo);
                    $w->writeElement('codigoAdicional',$detalle->codigo);
                    $w->writeElement('descripcion',$detalle->descripcion);
                    $w->writeElement('cantidad',  number_format($detalle->cantidad, 6));
                    $w->writeElement('precioUnitario',  number_format($detalle->precio_unitario, 6));
                    $w->writeElement('descuento',  number_format($detalle->descuento, 2));
                    $w->writeElement('precioTotalSinImpuesto',  number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2));            
                    $w->startElement('impuestos');
                        $w->startElement('impuesto');                
                        if($detalle->producto->iva == 't'){
                            $w->writeElement('codigo',2);
                            $w->writeElement('codigoPorcentaje',2);
                            $w->writeElement('tarifa',12);
                            $w->writeElement('baseImponible', number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2));
                            $w->writeElement('valor', number_format(($detalle->precio_total_sin_impuestos -  $detalle->descuento) *  0.12, 2));
                        }else{
                            $w->writeElement('codigo',2);                                               
                            $w->writeElement('codigoPorcentaje', 0);
                            $w->writeElement('tarifa', 0);
                            $w->writeElement('baseImponible', number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2));
                            $w->writeElement('valor', '0.00');
                        }
                        $w->endElement();
                    $w->endElement();
                $w->endElement();
            }
            $w->endElement();

            $w->startElement('infoAdicional'); 
                $w->writeElement('campoAdicional',$entidad->email);
                $w->writeAttribute('nombre', 'email');

                $w->writeElement('campoAdicional',$entidad->direccion);
                $w->writeAttribute('nombre', 'direccion');

                $w->writeElement('campoAdicional',$entidad->telefono);
                $w->writeAttribute('nombre', 'telefono');                
            $w->endElement();
    
        $w->endElement();

        $w->endDocument();
        
        return $w->outputMemory(TRUE);
    }
} 
