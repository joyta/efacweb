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
        $factor = 2;
        $suma = 0;
        for ($i = strlen($_rol) - 1; $i >= 0; $i--) {
            $suma += $factor * $_rol[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        
        $dv = 11 - ($suma % 11);
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? 1 : $dv);
        
        return $dv;
    }
}

if ( ! function_exists('generar_numero_documento'))
{
    function generar_numero_documento(&$comprobante)
    {
        $CI =& get_instance();
        $CI->load->model('puntoemision_model');
        
        $numero = $CI->puntoemision_model->generar_numero($comprobante);
        
        return $numero;
    }
}