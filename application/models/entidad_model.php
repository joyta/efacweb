<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Entidad_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('razon_social asc');
            $query = $this->db->get('tributario.entidad',$limit,$offset);            
            return $query->result();
        }
        

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.entidad', array('id'=>$id));
            return $query->row();
        }
        
        function get_empresas(){
            $this->db->where('is_empresa = TRUE');
            $query = $this->db->get('tributario.entidad');
            return $query->result();
        }
        
        function get_empresa(){
            $this->db->where('is_empresa = TRUE');
            $query = $this->db->get('tributario.entidad');
            return $query->row();
        }
        
        function get_by_documento($id){
            $query = $this->db->get_where('tributario.entidad', array('documento'=>$id));
            return $query->row();
        }  

        /*
            Agregar un usuario
        */
        function insert($entidad){
            unset($producto['id']);
            $result = $this->db->insert("tributario.entidad",$entidad);
            return $this->db->insert_id();
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.entidad",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("tributario.entidad",array("id"=>$id));
        }

        
    }
?>