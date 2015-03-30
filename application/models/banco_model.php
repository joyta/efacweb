<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Banco_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('financiero.banco',$limit,$offset);            
            return $query->result();
        }                
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('financiero.banco', array('id'=>$id));
            return $query->row();
        }               

        /*
            Agregar un usuario
        */
        function insert($data){
            unset($data['id']);
            $result = $this->db->insert("financiero.banco",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("financiero.banco",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("financiero.banco",array("id"=>$id));
        }
        
        
        function cuentas_bancarias($id,  $limit=NULL, $offset=NULL){
            $this->db->where('banco_id',$id);
            $this->db->order_by('descripcion asc');
            $query = $this->db->get('financiero.cuenta_bancaria',$limit,$offset);            
            return $query->result();
        }
        
        function get_cuenta($id){
            $query = $this->db->get_where('financiero.cuenta_bancaria', array('id'=>$id));
            return $query->row();
        }  
        
        function insert_cuenta($data){
            unset($data['id']);
            $result = $this->db->insert("financiero.cuenta_bancaria",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update_cuenta($data){
            $this->db->where('id',$data['id']);
            $this->db->update("financiero.cuenta_bancaria",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete_cuenta($id){
            $this->db->delete("financiero.cuenta_bancaria",array("id"=>$id));
        }
        
        
        
        
        
        function chequeras($id,  $limit=NULL, $offset=NULL){
            $this->db->where('cuenta_id',$id);
            $this->db->order_by('descripcion asc');
            $query = $this->db->get('financiero.chequera',$limit,$offset);            
            return $query->result();
        }
        
        function get_chequera($id){
            $query = $this->db->get_where('financiero.chequera', array('id'=>$id));
            return $query->row();
        }  
        
        function insert_chequera($data){
            unset($data['id']);
            $result = $this->db->insert("financiero.chequera",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update_chequera($data){
            $this->db->where('id',$data['id']);
            $this->db->update("financiero.chequera",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete_chequera($id){
            $this->db->delete("financiero.chequera",array("id"=>$id));
        }

        
    }
?>