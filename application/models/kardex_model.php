<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Kardex_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }                                         
        
        function registrar_ingreso_compra(&$comprobante, &$detalle){
            $est_id = $comprobante['establecimiento_id'];
            $pro_id = $detalle['producto_id'];
            
            //Inicializa stock
            $this->db->query("INSERT INTO inventario.stock (establecimiento_id, producto_id) SELECT $est_id, $pro_id WHERE NOT EXISTS (select s.id from inventario.stock s where s.establecimiento_id=$est_id and s.producto_id=$pro_id);");            
            
            $producto = $this->db->get_where('inventario.producto',array('id'=>$pro_id))->row();            
            $unidad = $this->db->get_where('inventario.unidad',array('id'=>$producto->unidadcompra_id))->row();
            $detalle['costo_promedio'] = $producto->costo_promedio;
                    
            $c_entrada = $detalle['cantidad'] * $unidad->equivalencia;
            $stockAnterior = $this->db->select('sum(s.cantidad) cantidad')->get_where('inventario.stock s',array('producto_id'=>$pro_id))->row()->cantidad;
            $stockActual = $stockAnterior + $c_entrada;
            
            $p1 = $stockAnterior * $producto->costo_promedio;
            $p2 = $c_entrada * $detalle['precio_unitario'];
            
            if($producto->tipo != 'Servicio'){
                $costo_promedio = ($p1+$p2) / $stockActual;            
                $this->db->update('inventario.producto',array('costo_promedio'=>$costo_promedio),array('id'=>$pro_id));
                $this->db->update('inventario.stock',array('cantidad'=>$stockActual),array('establecimiento_id'=>$est_id,'producto_id'=>$pro_id));
            }else{
                $stockActual = 0;
            }
            
            $this->db->insert("inventario.kardex",array(
            'detalle' => ($comprobante['tipo'] == '01' ? "Factura: ": "Nota Crédito: ").$comprobante['numero'].($detalle['series'] ? "; series: ".$detalle['series'] : ''),
            'tipo' => 'Entrada',
            'establecimiento_id'=>$est_id,
            'producto_id'=>$pro_id,
            'c_entrada'=>$c_entrada,
            'vu_entrada'=>$detalle['precio_unitario'],
            'ct_entrada'=>$c_entrada * $detalle['precio_unitario'],
            'c_existente'=>$stockActual,
            'vu_existente'=>$costo_promedio,
            'ct_existente' => $costo_promedio * $stockActual
            ));
        } 
        
        function registrar_ingreso_notacredito($comprobante, $detalle){
            $est_id = $comprobante['establecimiento_id'];
            $pro_id = $detalle['producto_id'];
            
            //Inicializa stock
            $this->db->query("INSERT INTO inventario.stock (establecimiento_id, producto_id) SELECT $est_id, $pro_id WHERE NOT EXISTS (select s.id from inventario.stock s where s.establecimiento_id=$est_id and s.producto_id=$pro_id);");            
            
            $producto = $this->db->get_where('inventario.producto',array('id'=>$pro_id))->row();            
            $unidad = $this->db->get_where('inventario.unidad',array('id'=>$producto->unidadcompra_id))->row();
            
            $c_entrada = $detalle['cantidad'] * $unidad->equivalencia;
            $stockAnterior = $this->db->select('sum(s.cantidad) cantidad')->get_where('inventario.stock s',array('producto_id'=>$pro_id))->row()->cantidad;
            $stockActual = $stockAnterior + $c_entrada;
            
            $p1 = $stockAnterior * $producto->costo_promedio;
            $p2 = $c_entrada * $detalle['costo_promedio'];
            
            if($producto->tipo != 'Servicio'){
                $costo_promedio = ($p1+$p2) / $stockActual;            
                $this->db->update('inventario.producto',array('costo_promedio'=>$costo_promedio),array('id'=>$pro_id));
                $this->db->update('inventario.stock',array('cantidad'=>$stockActual),array('establecimiento_id'=>$est_id,'producto_id'=>$pro_id));
            }else{
                $stockActual = 0;
            }
            
            $this->db->insert("inventario.kardex",array(
            'detalle' => ($comprobante['tipo'] == '01' ? "Factura: ": "Nota Crédito: ").$comprobante['numero'].($detalle['series'] ? "; series: ".$detalle['series'] : ''),
            'tipo' => 'Entrada',
            'establecimiento_id'=>$est_id,
            'producto_id'=>$pro_id,
            'c_entrada'=>$c_entrada,
            'vu_entrada'=>$detalle['costo_promedio'],
            'ct_entrada'=>$c_entrada * $detalle['costo_promedio'],
            'c_existente'=>$stockActual,
            'vu_existente'=>$costo_promedio,
            'ct_existente' => $costo_promedio * $stockActual
            ));
        } 
        
        function registrar_egreso_venta(&$comprobante, &$detalle){
            $est_id = $comprobante['establecimiento_id'];
            $pro_id = $detalle['producto_id'];
            
            $producto = $this->db->get_where('inventario.producto',array('id'=>$pro_id))->row();            
            $unidad = $this->db->get_where('inventario.unidad',array('id'=>$producto->unidadcompra_id))->row();            
            $detalle['costo_promedio'] = $producto->costo_promedio;
            
            $c_salida = $detalle['cantidad'] * $unidad->equivalencia;
            $stockAnterior = $this->db->select('sum(s.cantidad) cantidad')->get_where('inventario.stock s',array('producto_id'=>$pro_id))->row()->cantidad;            
            $stockActual = $stockAnterior - $c_salida;
            
            if($producto->tipo != 'Servicio'){
                $this->db->update('inventario.stock',array('cantidad'=>$stockActual),array('establecimiento_id'=>$est_id,'producto_id'=>$pro_id));
            }else{
                $stockActual = 0;                
            }
            
            $this->db->insert("inventario.kardex",array(
            'detalle' => 'Factura: '.$comprobante['numero'].($detalle['series'] ? "; series: ".$detalle['series'] : ''),
            'tipo' => 'Salida',
            'establecimiento_id'=>$est_id,
            'producto_id'=>$pro_id,
            'c_salida'=>$c_salida,
            'vu_salida'=>$producto->costo_promedio,
            'ct_salida'=>$c_salida * $producto->costo_promedio,
            'c_existente'=>$stockActual,
            'vu_existente'=>$producto->costo_promedio,
            'ct_existente' => $producto->costo_promedio * $stockActual
            ));            
        } 
        
        function lista($est_id, $pro_id){
            $this->db->where(array('establecimiento_id'=>$est_id,'producto_id'=>$pro_id));
            $query = $this->db->get('inventario.kardex');            
            return $query->result();
        }
        
        function lista_series_disponibles($est_id, $pro_id){
            $this->db->select('s.id, s.numero, date(c.fecha) fecha_compra, c.numero numero_compra');
            $this->db->where(array('s.establecimiento_id'=>$est_id,'s.producto_id'=>$pro_id, 'detalleventa_id' => NULL));
            $this->db->join("tributario.comprobante_detalle d", "s.detallecompra_id = d.id", "left");
            $this->db->join("tributario.comprobante c", "d.comprobante_id = c.id", "left");
            $this->db->order_by('c.fecha asc');
            $query = $this->db->get('inventario.serie s');            
            $r = $query->result();            
            return $r;
        }

        
    }
?>