<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Establecimiento_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('tributario.establecimiento',$limit,$offset);            
            return $query->result();
        }                
        

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.establecimiento', array('id'=>$id));
            return $query->row();
        }                

        /*
            Agregar un usuario
        */
        function insert($producto){
            unset($producto['id']);
            $result = $this->db->insert("tributario.establecimiento",$producto);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.establecimiento",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("tributario.establecimiento",array("id"=>$id));
        }

        
    }
?>