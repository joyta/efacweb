<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Comprobante_model extends CI_Model{
        
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
        function insert($data){            
            $result = $this->db->insert("tributario.comprobante",$data);
            return $this->db->insert_id();
        }*/

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.comprobante",$data);
            return;
        }        
        
        function insert(&$comprobante){            
            $this->db->insert("tributario.comprobante",$comprobante);
            $comprobante['id'] = $this->db->insert_id();
            return $comprobante['id'];
        }
        
        function insert_detalles(&$detalles, &$comprobante){
            foreach ($detalles as &$detalle) {
                $detalle['comprobante_id'] = $comprobante['id'];
                $this->db->insert("tributario.comprobante_detalle",$detalle);
                $detalle['id'] = $this->db->insert_id();
            }                        
        }
        
        function insert_serie(&$serie){                        
            $this->db->insert("inventario.serie",$serie);
            $serie['id'] = $this->db->insert_id();            
        }
        
        function contar_series($serie, $producto_id){
            $query = $this->db->get_where('inventario.serie', array('numero'=>$serie,'producto_id'=>$producto_id));
            return $query->num_rows();
        } 

    }
?>