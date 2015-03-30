<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Transaccion_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

       
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('financiero.transaccion', array('id'=>$id));
            return $query->row();
        }        

        /*
            Agregar un usuario
        */
        function insert($data){
            unset($data['id']);
            $result = $this->db->insert("financiero.transaccion",$data);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("financiero.transaccion",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->delete("financiero.transaccion",array("id"=>$id));
        }
        
        function generar_cxc($comprobante, $transaccion){
            $transaccion['referencia'] = $comprobante['id'];
            $transaccion['concepto'] = $comprobante['numero'];
            $transaccion['monto'] = $comprobante['importe_total'];
            $transaccion['saldo'] = $comprobante['importe_total'];
            
            $transaccion['grupo'] = 'Cxp';
            $transaccion['tipo'] = 'Factura';
            $transaccion['estado'] = 'Pendiente';
            $transaccion['fecha'] = $comprobante['fecha'];
            
            if($comprobante['metodo_pago'] == 'Contado'){
                $transaccion['dias_plazo'] = 0;
                $transaccion['vence'] = $comprobante['fecha'];
            }
            
            $result = $this->db->insert("financiero.transaccion",$transaccion);
            return $result;
        }

        
    }
?>