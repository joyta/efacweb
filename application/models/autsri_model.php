<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Autsri_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('numero asc');
            $query = $this->db->get('tributario.autorizacionsri',$limit,$offset);            
            return $query->result();
        }                

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.autorizacionsri', array('id'=>$id));
            return $query->row();
        }       

        /*
            Agregar un usuario
        */
        function insert($producto){
            unset($producto['id']);
            $result = $this->db->insert("tributario.autorizacionsri",$producto);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.autorizacionsri",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->where('id',$id);
            $this->db->update("tributario.autorizacionsri",array('estado'=>'FALSE'));
        }

        
    }
?>