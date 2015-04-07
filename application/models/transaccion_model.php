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
        
        function get_transacciones_pendientes($entidad_id, $grupo){
            $this->db->where_in('estado', array('Pendiente','Parcial'));
            $query = $this->db->get_where('financiero.transaccion', 
                    array(
                        'entidad_id'=>$entidad_id,
                        'grupo' => $grupo,
                        'tipo' => 'Factura',                        
                    )
            );
            return $query->result();
        } 
        
        function get_cuotas_transaccion($transaccion_id){
            $this->db->order_by('numero asc');
            $query = $this->db->get_where('financiero.transaccion_cuota', array('transaccion_id'=>$transaccion_id));
            return $query->result();
        }
        
        function get_pagos_transaccion($transaccion_id){
            $this->db->order_by('id asc');
            $this->db->select('p.*, t.concepto, date(t.fecha) fecha, t.referencia, date(t.fecha_referencia) fecha_referencia, t.forma_pago');
            $this->db->join('financiero.transaccion t', 'p.pago_id = t.id', 'left');
            $query = $this->db->get_where('financiero.transaccion_pago p', array('p.transaccion_id'=>$transaccion_id));
            return $query->result();
        }  
        
        function generar_cxp($comprobante, $transaccion){
            $transaccion['entidad_id'] = $comprobante['entidad_id'];
            $transaccion['referencia_id'] = $comprobante['id'];
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
            $transaccion['id'] = $transaccion_id = $this->db->insert_id();
            
            //Actualiza comprobante
            $this->db->update('tributario.comprobante', array('transaccion_id'=>$transaccion_id), array('id'=>$comprobante->id));
            
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
        
        function generar_cxc($comprobante, $entidad, $pagos){
            $monto = $comprobante->importe_total;
            $saldo = $comprobante->importe_total;
            
            $pagoCredito = NULL;
            foreach ($pagos as $pago) {
                if($pago['forma_pago'] == 'Credito'){
                    $pagoCredito = $pago;
                }
            }
            
            $transaccion = array(
                'referencia_id' => $comprobante->id,
                'entidad_id' => $entidad->id,
                'concepto' => $comprobante->numero,
                'fecha' => $comprobante->fecha,
                'tipo'=>'Factura', 
                'grupo'=>'Cxc', 
                'estado'=>'Pendiente',
                'monto'=>$monto,
                'saldo'=>$saldo,
                'dias_plazo' => $pagoCredito ? $pagoCredito['dias_plazo'] : 0,
                'vence' => $pagoCredito ? $pagoCredito['vence'] : $comprobante->fecha,
                'numero_cuotas' => $pagoCredito ? $pagoCredito['numero_cuotas'] : 0,
            );            
            
            try {
                $this->db->trans_begin();
                
                $this->db->insert("financiero.transaccion",$transaccion);
                $transaccion['id'] = $transaccion_id = $this->db->insert_id();
                
                foreach ($pagos as $pago) {
                    if($pago['forma_pago'] != 'Credito'){
                        $saldo = $saldo - $pago['monto'];
                        
                        $pago['grupo']='Cxc';
                        $pago['tipo']='Cobro';
                        $pago['estado']='Cerrado';
                        $pago['saldo']= 0;
                        $pago['fecha']= $comprobante->fecha;
                        $pago['concepto']= 'Cobro '.$comprobante->numero;
                        $pago['entidad_id']= $entidad->id;
                        
                        $this->db->insert("financiero.transaccion", $pago);
                        $pago['id'] = $pago_id = $this->db->insert_id();
                        
                        $this->db->insert("financiero.transaccion_pago", array('transaccion_id'=>$transaccion_id, 'pago_id'=>$pago_id,'monto'=>$pago['monto'],'saldo'=>0));
                        $tpago_id = $this->db->insert_id();
                    }
                }
                
                $estado = 'Pendiente';
                if($saldo == 0){
                    $estado = 'Pagado';
                }else{
                    if($saldo < $monto){
                        $estado = 'Parcial';
                    }
                }
                                
                $this->db->update('financiero.transaccion', array('saldo'=>$saldo, 'estado'=> $estado), array('id'=>$transaccion_id));
                $this->db->update('tributario.comprobante', array('transaccion_id'=>$transaccion_id), array('id'=>$comprobante->id));
                
                if($saldo != 0 && $pagoCredito == NULL){
                    throw new Exception('Saldo pendiente por cubrir');
                }
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    
                    return NULL;
                }else{
                    $this->db->trans_commit();
                    
                    return $transaccion_id;
                }
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                echo $exc->getTraceAsString();
            }
            
            return NULL;
        }
        
        function save_transaccion_pago($id, $pago, $facturas, $cuotas){
            $transaccion = $this->get($id);
            $monto = $pago['monto'];
            
            $this->db->trans_begin();
            
            try {
                $pago['grupo'] = 'Cxp';
                $pago['estado'] = 'Cerrado';
                $pago['tipo'] = 'Pago';
                $pago['fecha'] = date("Y-m-d H:i:s");
                $pago['saldo'] = 0;
                $pago['entidad_id'] = $transaccion->entidad_id;
                
                if($pago['forma_pago']=='Cheque'){
                    $chequera = $this->banco_model->get_chequera($pago['chequera_id']);
                    $this->db->update('financiero.chequera', array('numero'=>$chequera->numero + 1), array('id'=>$pago['chequera_id']));
                }
                                
                $this->db->insert('financiero.transaccion', $pago);
                $pago_id = $this->db->insert_id();
                
                foreach ($facturas as $fac) {
                    $factura = $this->db->get_where('financiero.transaccion', array('id'=>$fac))->row();

                    $this->db->where_in('id', $cuotas);
                    $this->db->where('transaccion_id', $fac);
                    $cuotas_factura = $this->db->get('financiero.transaccion_cuota')->result();

                    foreach ($cuotas_factura as $cuota) {
                        $trn_pago = array('transaccion_id'=>$fac, 'pago_id'=>$pago_id,'cuota_id'=>$cuota->id);
                                
                        if($monto >= $cuota->saldo){
                            //monto=40 >= saldo=30
                            $trn_pago['monto'] = $cuota->saldo;
                            $monto = $monto - $cuota->saldo;
                            $factura->saldo = $factura->saldo - $cuota->saldo;
                            $cuota->saldo = 0;                            
                        }else{
                            //monto=10 < saldo=30
                            $trn_pago['monto'] = $monto;                            
                            $factura->saldo = $factura->saldo - $monto;
                            $cuota->saldo = $cuota->saldo - $monto;                    
                            $monto = 0;
                        }
                        
                        $trn_pago['saldo'] = $factura->saldo;
                        
                        $this->db->update('financiero.transaccion_cuota', array('saldo'=>$cuota->saldo), array('id'=>$cuota->id));
                        $this->db->insert('financiero.transaccion_pago', $trn_pago);
                        
                        if($monto === 0){break;}
                    }

                    if($factura->saldo == 0){
                        $factura->estado = 'Pagada';
                    }else{
                        $factura->estado = 'Parcial';
                    }
                    
                    $this->db->update('financiero.transaccion', array('estado'=>$factura->estado, 'saldo'=>$factura->saldo), array('id'=>$factura->id));
                    
                    if($monto === 0){break;}
                }
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                }else{
                    $this->db->trans_commit();
                }
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                echo $exc->getTraceAsString();
            }
            
        }
        
        function save_transaccion_cobro($id, $pago, $facturas, $cuotas){
            $transaccion = $this->get($id);
            $monto = $pago['monto'];
            
            $this->db->trans_begin();
            
            try {
                $pago['grupo'] = 'Cxc';
                $pago['estado'] = 'Cerrado';
                $pago['tipo'] = 'Cobro';
                $pago['fecha'] = date("Y-m-d H:i:s");
                $pago['saldo'] = 0;
                $pago['entidad_id'] = $transaccion->entidad_id;
                                
                $this->db->insert('financiero.transaccion', $pago);
                $pago_id = $this->db->insert_id();
                
                foreach ($facturas as $fac) {
                    $factura = $this->db->get_where('financiero.transaccion', array('id'=>$fac))->row();

                    $this->db->where_in('id', $cuotas);
                    $this->db->where('transaccion_id', $fac);
                    $cuotas_factura = $this->db->get('financiero.transaccion_cuota')->result();

                    foreach ($cuotas_factura as $cuota) {
                        $trn_pago = array('transaccion_id'=>$fac, 'pago_id'=>$pago_id,'cuota_id'=>$cuota->id);
                                
                        if($monto >= $cuota->saldo){
                            //monto=40 >= saldo=30
                            $trn_pago['monto'] = $cuota->saldo;
                            $monto = $monto - $cuota->saldo;
                            $factura->saldo = $factura->saldo - $cuota->saldo;
                            $cuota->saldo = 0;                            
                        }else{
                            //monto=10 < saldo=30
                            $trn_pago['monto'] = $monto;                            
                            $factura->saldo = $factura->saldo - $monto;
                            $cuota->saldo = $cuota->saldo - $monto;                    
                            $monto = 0;
                        }
                        
                        $trn_pago['saldo'] = $factura->saldo;
                        
                        $this->db->update('financiero.transaccion_cuota', array('saldo'=>$cuota->saldo), array('id'=>$cuota->id));
                        $this->db->insert('financiero.transaccion_pago', $trn_pago);
                        
                        if($monto === 0){break;}
                    }

                    if($factura->saldo == 0){
                        $factura->estado = 'Pagada';
                    }else{
                        $factura->estado = 'Parcial';
                    }
                    
                    $this->db->update('financiero.transaccion', array('estado'=>$factura->estado, 'saldo'=>$factura->saldo), array('id'=>$factura->id));
                    
                    if($monto === 0){break;}
                }
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                }else{
                    $this->db->trans_commit();
                }
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                echo $exc->getTraceAsString();
            }
            
        }

        
    }
?>