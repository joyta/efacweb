<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Venta_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){
            $this->db->where('origen', 'Venta');
            $query = $this->db->get('tributario.comprobante',$limit,$offset);            
            return $query->result();
        }
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.comprobante', array('id'=>$id));
            return $query->row();
        }  
        
        function get_detalles($id){
            $query = $this->db->get_where('tributario.comprobante_detalle', array('comprobante_id'=>$id));
            return $query->result();
        }
        
        function get_mensajes($id){
            $query = $this->db->get_where('tributario.mensaje', array('comprobante_id'=>$id));
            return $query->result();
        }

        /*
            Agregar un usuario
        */
        function insert($data){            
            $result = $this->db->insert("tributario.comprobante",$data);
            return $this->db->insert_id();
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.comprobante",$data);
            return;
        }        

    }
?>