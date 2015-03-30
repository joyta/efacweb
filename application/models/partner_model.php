<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Partner_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('razon_social asc');
            $query = $this->db->get('tributario.partner',$limit,$offset);            
            return $query->result();
        }
        

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.partner', array('id'=>$id));
            return $query->row();
        }
        
        function get_empresa(){
            $this->db->where('is_empresa = TRUE');
            $query = $this->db->get('tributario.partner');
            return $query->row();
        }
        
        function get_by_documento($id){
            $query = $this->db->get_where('tributario.partner', array('documento'=>$id));
            return $query->row();
        }  

        /*
            Agregar un usuario
        */
        function insert($partner){
            unset($producto['id']);
            $result = $this->db->insert("tributario.partner",$partner);
            return $this->db->insert_id();
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.partner",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("tributario.partner",array("id"=>$id));
        }

        
    }
?>