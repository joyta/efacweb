<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Unidad_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){
            $this->db->select('u.id, u.nombre, u.tipo, u.base_id, u.equivalencia, b.nombre base_nombre');
            $this->db->join('inventario.unidad b', 'u.base_id = b.id', 'left');
            $this->db->order_by('u.tipo asc, u.nombre asc');
            $query = $this->db->get('inventario.unidad u',$limit,$offset);            
            return $query->result();
        }
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('inventario.unidad', array('id'=>$id));
            return $query->row();
        }        

        /*
            Agregar un usuario
        */
        function insert($data){
            unset($data['id']);
            $result = $this->db->insert("inventario.unidad",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("inventario.unidad",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("inventario.unidad",array("id"=>$id));
        }

        
    }
?>