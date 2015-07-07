<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Compra_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){
            $this->db->select('c.*, e.nombre establecimiento_nombre, p.razon_social nombre_proveedor, p.documento ruc');
            $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id','left');
            $this->db->join('tributario.entidad p', 'c.entidad_id = p.id','left');
            $this->db->where('origen', 'Compra');
            $query = $this->db->get('tributario.comprobante c',$limit,$offset);            
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