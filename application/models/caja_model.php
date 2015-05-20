<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Caja_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('financiero.caja',$limit,$offset);            
            return $query->result();
        }                
        
        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('financiero.caja', array('id'=>$id));
            return $query->row();
        } 
        
        function get_caja_abierta(){
            $user = get_contexto();
            $query = $this->db->get_where('financiero.caja', array('usuario_id'=>$user['id'],'establecimiento_id'=>$user['establecimiento_id'],'estado'=>'Abierta'));
            return $query->row();
        }
        
        function preparar_cierre_caja(){
            $user = get_contexto();
            $query = $this->db->get_where('financiero.caja', array('usuario_id'=>$user['id'],'establecimiento_id'=>$user['establecimiento_id'],'estado'=>'Abierta'));
            $caja = $query->row();
            
            if($caja){
                //Total ventas
                $this->db->select('sum(c.importe_total) total');
                $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.caja_id = $caja->id");
                $caja->total_ventas = $this->db->get('tributario.comprobante c')->row()->total;                
                $caja->total_ventas = $caja->total_ventas ? $caja->total_ventas : 0.00;
                
                //Ventas al contado
                $this->db->select('sum(c.importe_total) total');
                $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.metodo_pago = 'Contado' and c.caja_id = $caja->id");
                $caja->ventas_contado = $this->db->get('tributario.comprobante c')->row()->total;                
                $caja->ventas_contado = $caja->ventas_contado ? $caja->ventas_contado : 0.00;
                
                //Ventas a crédito
                $this->db->select('sum(c.importe_total) total');
                $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.metodo_pago = 'Crédito' and c.caja_id = $caja->id");
                $caja->ventas_credito = $this->db->get('tributario.comprobante c')->row()->total;                
                $caja->ventas_credito = $caja->ventas_credito ? $caja->ventas_credito : 0.00;                
                
                //Ventas efectivo
                $this->db->select('sum(t.monto) total');                
                $this->db->join('financiero.transaccion_pago tp', 'tp.pago_id = t.id', 'left');
                $this->db->join('financiero.transaccion f', 'tp.transaccion_id = f.id', 'left');
                $this->db->where("t.grupo = 'Cxc' and t.tipo='Cobro' and t.forma_pago='Efectivo' and f.caja_id = t.caja_id and t.caja_id = $caja->id");
                $caja->ventas_efectivo = $this->db->get('financiero.transaccion t')->row()->total;                
                $caja->ventas_efectivo = $caja->ventas_efectivo ? $caja->ventas_efectivo : 0.00;
                
                //Recaudaciones efectivo
                $this->db->select('sum(t.monto) total');
                $this->db->where("t.grupo = 'Cxc' and t.tipo='Cobro' and t.forma_pago='Efectivo' and f.caja_id <> t.caja_id and t.caja_id = $caja->id");
                $this->db->join('financiero.transaccion_pago tp', 'tp.pago_id = t.id', 'left');
                $this->db->join('financiero.transaccion f', 'tp.transaccion_id = f.id', 'left');
                $caja->recaudaciones_efectivo = $this->db->get('financiero.transaccion t')->row()->total;                
                $caja->recaudaciones_efectivo = $caja->recaudaciones_efectivo ? $caja->recaudaciones_efectivo : 0.00;
                
                //Pagos efectivo
                $this->db->select('sum(t.monto) total');
                $this->db->where("t.grupo = 'Cxp' and t.tipo = 'Pago' and t.forma_pago = 'Efectivo' and t.caja_id = $caja->id");                
                $caja->pagos_efectivo = $this->db->get('financiero.transaccion t')->row()->total;                
                $caja->pagos_efectivo = $caja->pagos_efectivo ? $caja->pagos_efectivo : 0.00;
                
                
                $caja->total_efectivo = $caja->monto_apertura
                        + $caja->ventas_efectivo 
                        + $caja->recaudaciones_efectivo
                        - $caja->pagos_efectivo;
            }
            
            return $caja;
        }

        /*
            Abrir caja
        */
        function abri_caja(&$data){
            $user = get_contexto();
            $data['usuario_id'] = $user['id'];
            $data['establecimiento_id'] = $user['establecimiento_id'];
            $data['fecha_apertura'] = date('Y-m-d H:i:s');
            $data['estado'] = 'Abierta';
            
            $result = $this->db->insert("financiero.caja",$data);            
            return $result;
        }
        
        function cerrar_caja($caja){            
            $this->db->where('id',$caja->id);
            $this->db->update("financiero.caja",array(
                'estado'=>'Cerrada',
                'fecha_cierre'=>date('Y-m-d H:i:s'),
                'total_efectivo' => $caja->total_efectivo,
                'total_ventas' => $caja->total_ventas,
                'ventas_contado' => $caja->ventas_contado,
                'ventas_credito' => $caja->ventas_credito,
                'ventas_efectivo' => $caja->ventas_efectivo,
                'recaudaciones_efectivo' => $caja->recaudaciones_efectivo,
                'pagos_efectivo' => $caja->pagos_efectivo,
                'total_existente' => $caja->total_existente,
                'diferencia' => $caja->diferencia,
            ));
            return true;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("financiero.caja",$data);
            return;
        }
        
    }
?>