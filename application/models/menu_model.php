<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Menu_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('etiqueta asc');
            $query = $this->db->get('seguridad.menu',$limit,$offset);            
            return $query->result();
        }                
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('seguridad.menu', array('id'=>$id));
            return $query->row();
        }                       

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("seguridad.menu",$data);
            return;
        }        
        
    }
?>