<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Marca_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.marca',$limit,$offset);            
            return $query->result();
        }
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('inventario.marca', array('id'=>$id));
            return $query->row();
        }        

        function existe_by_nombre($nombre){
            $this->db->where('nombre', $nombre);
            $query = $this->db->get('inventario.marca');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        /*
            Agregar un usuario
        */
        function insert($data){
            unset($data['id']);
            $result = $this->db->insert("inventario.marca",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("inventario.marca",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("inventario.marca",array("id"=>$id));
        }

        
    }
?>