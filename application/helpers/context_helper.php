<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * efac
 *
 * Helpers personales para el usuario
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
if ( ! function_exists('get_contexto'))
{
    function get_contexto()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user;    
    }
}

if ( ! function_exists('is_authenticated'))
{
    function is_authenticated()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user != null;    
    }
}

if ( ! function_exists('check_authenticated'))
{
    function check_authenticated()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');
        if($sess_user != null){
            
        }else{
            redirect('/admin/permiso');
        }
    }
}

if ( ! function_exists('check_caja'))
{
    function check_caja()
    {
        $CI =& get_instance();                
        $CI->load->model('caja_model');
                
        
        $caja = $CI->caja_model->get_caja_abierta();
        
        if($caja != null){
            return $caja;
        }else{
            redirect('/caja/apertura');
        }
    }
}

if ( ! function_exists('get_caja_contexto'))
{
    function get_caja_contexto()
    {
        $CI =& get_instance();                
        $CI->load->model('caja_model');
        
        $caja = $CI->caja_model->get_caja_abierta();
        return $caja;
    }
}

if ( ! function_exists('get_display_name'))
{
    function get_display_name()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user['descripcion'];    
    }
}

if ( ! function_exists('is_in_roles'))
{
    function is_in_roles($roles)
    {
        $us = get_user();        
        if($us && $roles){
            if (is_array($roles)){
                foreach ($roles as $r) {
                    if($us['tipo'] == $r){
                        return true;
                    }
                }            
            }else{
                return $us['tipo'] == $roles;
            }
        }        
        
        return false;
    }
}