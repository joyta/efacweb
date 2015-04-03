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
            $transaccion['entidad_id'] = $comprobante['entidad_id'];
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
                $transaccion['numero_cuotas'] = 1;
            }
            
            $result = $this->db->insert("financiero.transaccion",$transaccion);
            $transaccion['id'] = $this->db->insert_id();
            
            if($comprobante['metodo_pago'] == 'Contado'){
                $this->db->insert("financiero.transaccion_cuota",array(
                    'transaccion_id'=>$transaccion['id'],
                    'numero'=>1,
                    'monto' =>$transaccion['monto'],
                    'saldo' =>$transaccion['saldo'],
                    'vence' =>$transaccion['vence']
                ));
            }else{
                $numero_cuotas = $transaccion['numero_cuotas'];
                $monto = $transaccion['monto'];
                $montocuota = round($monto / $numero_cuotas, 2);
                $residuo = $monto - ($montocuota * $numero_cuotas);
                $dias_cuota = $transaccion['dias_plazo'] / $numero_cuotas;
                
                $vence = new DateTime($transaccion['fecha']);
                
                for ($i = 0; $i < $numero_cuotas; $i++) {
                    if($i + 1 == $numero_cuotas){
                        $montocuota = $montocuota + $residuo;
                    }                    
                    
                    $vence = date_add($vence, date_interval_create_from_date_string($dias_cuota.' days'));
                    
                    $this->db->insert("financiero.transaccion_cuota",array(
                    'transaccion_id'=>$transaccion['id'],
                    'numero'=>($i+1),
                    'monto' =>$montocuota,
                    'saldo' =>$montocuota,
                    'vence'=> $vence->format('Y-m-d')
                    ));                    
                }
            }
            
            return $result;
        }

        
    }
?>