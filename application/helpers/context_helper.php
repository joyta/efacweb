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
            $s1 = $CI->uri->segment(1);
            $s2 = $CI->uri->segment(2);
            
            $CI->db->where("ruta ilike '$s1/$s2%'");
            $qmenu = $CI->db->get('seguridad.menu');
            $menu = $qmenu->row();
            
            if($menu){
                $pos = strpos($menu->roles,$sess_user['rol']);
                
                if($pos === FALSE){
                    redirect('/admin/nopermiso');                    
                }
            }
            
        }else{
            redirect('/admin/noauth');
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

if ( ! function_exists('get_empresa_nombre_comercial'))
{
    function get_empresa_nombre_comercial()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user['empresa_nombre_comercial'];    
    }
}

if ( ! function_exists('get_empresa_razon_sociall'))
{
    function get_empresa_razon_sociall()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user['empresa_razon_social'];    
    }
}

if ( ! function_exists('get_establecimiento_nombre'))
{
    function get_establecimiento_nombre()
    {
        $CI =& get_instance();                
        $sess_user = $CI->session->userdata('logged_in');                
        return $sess_user['establecimiento_nombre'];    
    }
}

if ( ! function_exists('is_in_roles'))
{
    function is_in_roles($roles)
    {
        $us = get_contexto();
        if($us && $roles){
            if (is_array($roles)){
                foreach ($roles as $r) {
                    if($us['rol'] == $r){
                        return true;
                    }
                }            
            }else{
                return $us['rol'] == $roles;
            }
        }        
        
        return false;
    }
}

if ( ! function_exists('render_menu'))
{
    function render_menu()
    {
        $us = get_contexto();
        $CI =& get_instance();
        
        if($us){
            $rol = $us['rol'];

            $CI->db->where("roles ilike '%$rol%'");
            $CI->db->order_by('orden asc');
            $query = $CI->db->get("seguridad.menu");
            $lista = $query->result();

            return $lista;
        }else{
            return array();
        }
    }
}

if ( ! function_exists('render_menu_padres'))
{
    function render_menu_padres($lista=array())
    {        
        $padres = array();
        
        foreach ($lista as $item) {
            if(!$item->padre_id) $padres[] = $item;
        }
        
        return $padres;
    }
}

if ( ! function_exists('render_menu_hijos'))
{
    function render_menu_hijos($lista=array(), $padre)
    {        
        $hijos = array();
        
        foreach ($lista as $item) {
            if($item->padre_id == $padre->id) $hijos[] = $item;
        }
        
        return $hijos;
    }
}