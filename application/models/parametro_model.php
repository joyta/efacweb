<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Parametro_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('codigo asc');
            $query = $this->db->get('seguridad.parametro',$limit,$offset);            
            return $query->result();
        }
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('seguridad.parametro', array('id'=>$id));
            return $query->row();
        }        

        /*
            Agregar un usuario
        */
        function insert($data){
            unset($data['id']);
            $result = $this->db->insert("seguridad.parametro",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("seguridad.parametro",$data);
            return;
        }

        function get_valor_parametro($codigo){            
            $this->db->select('valor');
            $query = $this->db->get_where('seguridad.parametro', array('codigo'=>$codigo));
            
            $r = $query->row();
            return $r ? $r->valor : '';
        }
    }
?>