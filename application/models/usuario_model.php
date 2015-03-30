<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Usuario_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }         

        function autenticar($usuario, $clave){
            $this->db->where('nombre', $usuario);
            $this->db->where('clave', md5($clave));
            $this->db->where('estado', 'Activo');
            $query = $this->db->get('seguridad.usuario');
            return $query->row();
        }
        
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('seguridad.usuario',$limit,$offset);            
            return $query->result();
        }
        
        function get($id){
            $query = $this->db->get_where('seguridad.usuario', array('id'=>$id));
            return $query->row();
        }   
        
        function insert($data){
            unset($data['id']);
            $data['clave'] = md5($data['clave']);
            $result = $this->db->insert("seguridad.usuario",$data);
            return $result;
        }
        
        function update($data){
            
            $old = $this->get($data['id']);
            if($old->clave != $data['clave']){
                $data['clave'] = md5($data['clave']);
            }
            
            $this->db->where('id',$data['id']);
            $this->db->update("seguridad.usuario",$data);
            return;
        }
        
        function delete($id){
            $this->db->where('id',$id);
            $this->db->update("seguridad.usuario",array("estado"=>'Eliminado'));
        }

       
    }
?>