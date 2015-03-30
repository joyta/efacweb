<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Entity_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }    
        
        function select_list_usuarios($first=NULL){ 
            $data = array();
            if($first){
                $data[''] = $first;
            }
            $this->db->select('id,nombre');
            $this->db->order_by('nombre asc');
            $query = $this->db->get('seguridad.usuario');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
        function select_list_establecimientos($first=NULL){ 
            $data = array();
            if($first){
                $data[''] = $first;
            }
            $this->db->select('id,nombre');
            $this->db->order_by('nombre asc');
            $query = $this->db->get('tributario.establecimiento');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
        function select_list_autorizaciones($first=NULL){ 
            $data = array();
            if($first){
                $data[''] = $first;
            }
            $this->db->select('id,descripcion');
            $this->db->order_by('descripcion asc');
            $query = $this->db->get('tributario.autorizacionsri');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->descripcion;
            }
            
            return $data;
        }
        
        function select_list_marcas($first=NULL){ 
            $data = array();
            if($first){
                $data[''] = $first;
            }
            $this->db->select('id,nombre');
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.marca');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
        function select_list_categorias($first=NULL){ 
            $data = array();
            if($first){
                $data[''] = $first;
            }
            $this->db->select('id,nombre');
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.categoria');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
        function select_list_unidades_base($id, $tipo){ 
            $data = array(''=>'--Seleccione--');
            $this->db->select('id,nombre');
            $this->db->where("id != $id");
            $this->db->where("tipo", $tipo);
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.unidad');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
        function select_list_unidades($tipo){ 
            $data = array(''=>'--Seleccione--');
            $this->db->select('id,nombre');            
            $this->db->where("tipo", $tipo);
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.unidad');                        
            
            foreach($query->result() as $row ){
                $data[$row->id] = $row->nombre;
            }
            
            return $data;
        }
        
    }
?>