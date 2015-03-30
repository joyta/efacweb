<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Comprobante_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Agregar un usuario
        */
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
                

    }
?>