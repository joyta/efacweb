<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('comprobante_model');
        $this->load->model('entidad_model');        
        $this->load->model('entity_model');
        $this->load->model('establecimiento_model');
        $this->load->model('producto_model');
        $this->load->model('transaccion_model');
        $this->load->model('usuario_model');
        $this->load->model('kardex_model');
        $this->load->model('stock_model');
        
        check_authenticated();
    }

    public function total_ventas() {
        $this->data['title'] = "Total ventas";
        $this->data['page_map'] = array("Reportes", "Total ventas");
        $this->data['view'] = 'reportes/total_ventas';
        
        $accion = $this->input->post('accion');
        $desde = $this->input->post('desde') ? $this->input->post('desde') : date('Y-m-d');
        $hasta = $this->input->post('hasta') ? $this->input->post('hasta') : date('Y-m-d');                
        
        /*$this->db->select('e.nombre establecimiento, sum(c."importe_total") importe_total, sum(c."baseIva0") baseIva0, sum(c."baseIva12") baseIva12, sum(c."iva12") iva12, sum(c."total_sin_impuestos") total_sin_impuestos');        
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.fecha >= '$desde' and c.fecha <= '$hasta'");        
        $this->db->group_by("e.id");
        $lista = $this->db->get('tributario.comprobante c')->result();*/
        
        $sql = "
            select e.nombre establecimiento, sum(r.importe_total) importe_total, sum(r.\"baseIva0\") baseIva0, sum(r.\"baseIva12\") baseIva12, sum(r.\"iva12\") iva12, sum(r.\"total_sin_impuestos\") total_sin_impuestos, sum(r.total_descuento) total_descuento, sum(r.costo_total) costo_total, sum(r.utilidad) utilidad
            from
            (select c.id, c.establecimiento_id, c.importe_total, c.\"baseIva0\", c.\"baseIva12\", c.\"iva12\", c.total_sin_impuestos, c.total_descuento, sum(d.cantidad * d.costo_promedio) costo_total, (sum((d.cantidad * d.precio_unitario) - d.descuento) - sum(d.cantidad * d.costo_promedio)) utilidad
                from tributario.comprobante c 
                left join tributario.comprobante_detalle d on d.comprobante_id = c.id
                where c.origen = 'Venta' and c.tipo = '01' and date(c.fecha) >= '$desde' and date(c.fecha) <= '$hasta'
                group by c.id) r 
                left join tributario.establecimiento e on r.establecimiento_id = e.id
            group by e.id";
        
        $lista = $this->db->query($sql)->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['lista'] = $lista;
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
            $this->data['file_name'] = 'total ventas.pdf';
            $this->data['view'] = 'reportes/total_ventas_pdf';            
            report_to_pdf($this->data);
        }else{
            $this->load->view('template/admin', $this->data);
        }
    }
    
    public function ventas() {
        $this->data['title'] = "Ventas";
        $this->data['page_map'] = array("Reportes", "Ventas");
        $this->data['view'] = 'reportes/ventas';
        
        
        $accion = $this->input->post('accion');
        $desde = $this->input->post('desde') ? $this->input->post('desde') : date('Y-m-d');
        $hasta = $this->input->post('hasta') ? $this->input->post('hasta') : date('Y-m-d');                
        $usuario = $this->input->post('usuario') ? $this->input->post('usuario') : 0;
        
        $this->db->select('c.id, e.nombre establecimiento, c.importe_total, c.total_descuento, c.baseIva0, c.baseIva12, c.iva12, c.total_sin_impuestos, c.numero, c.fecha, p.documento, p.razon_social, u.nombre usuario, (sum(d.cantidad*d.precio_unitario-d.descuento) - sum(d.cantidad * d.costo_promedio)) utilidad,  sum(d.cantidad * d.costo_promedio) costo_total');
        $this->db->join('tributario.comprobante_detalle d', 'd.comprobante_id = c.id', 'left');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->join('tributario.entidad p', 'c.entidad_id = p.id', 'left');
        $this->db->join('seguridad.usuario u', 'c.usuario_id = u.id', 'left');
        $this->db->group_by('c.id, e.nombre, c.importe_total, c.total_descuento, c.baseIva0, c.baseIva12, c.iva12, c.total_sin_impuestos, c.numero, c.fecha, p.documento, p.razon_social, u.nombre');
        $this->db->where("c.origen = 'Venta' and c.tipo = '01' and date(c.fecha) >= '$desde' and date(c.fecha) <= '$hasta' and ($usuario=0 or c.usuario_id=$usuario)");                
        $lista = $this->db->get('tributario.comprobante c')->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['usuario'] = $usuario;
        $this->data['lista'] = $lista;
        
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
            $this->data['orientation'] = 'landscape';
            $this->data['file_name'] = 'ventas.pdf';
            $this->data['view'] = 'reportes/ventas_pdf';
            $this->data['usuario'] = $usuario ? $this->usuario_model->get($usuario)->nombre : '--Todos--';
            report_to_pdf($this->data);
        }else{
            $this->data['usuarios'] = $this->entity_model->select_list_usuarios('--Todos--');
            $this->load->view('template/admin', $this->data);
        }
    }
    
    public function total_compras() {
        $this->data['title'] = "Total compras";
        $this->data['page_map'] = array("Reportes", "Total compras");
        $this->data['view'] = 'reportes/total_compras';
        
        $accion = $this->input->post('accion');
        $desde = $this->input->post('desde') ? $this->input->post('desde') : date('Y-m-d');
        $hasta = $this->input->post('hasta') ? $this->input->post('hasta') : date('Y-m-d');                
        
        $this->db->select('e.nombre establecimiento, sum(c."importe_total") importe_total, sum(c."baseIva0") baseIva0, sum(c."baseIva12") baseIva12, sum(c."iva12") iva12, sum(c."total_sin_impuestos") total_sin_impuestos');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->where("c.origen = 'Compra' and c.tipo = '01' and c.fecha >= '$desde' and c.fecha <= '$hasta'");        
        $this->db->group_by("e.id");
        $lista = $this->db->get('tributario.comprobante c')->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['lista'] = $lista;
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
            $this->data['file_name'] = 'total compras.pdf';
            $this->data['view'] = 'reportes/total_compras_pdf';            
            report_to_pdf($this->data);
        }else{
            $this->load->view('template/admin', $this->data);
        }
    }
    
    public function compras() {
        $this->data['title'] = "Compras";
        $this->data['page_map'] = array("Reportes", "Compras");
        $this->data['view'] = 'reportes/compras';
        
        $accion = $this->input->post('accion');
        $desde = $this->input->post('desde') ? $this->input->post('desde') : date('Y-m-d');
        $hasta = $this->input->post('hasta') ? $this->input->post('hasta') : date('Y-m-d');   
        $usuario = $this->input->post('usuario') ? $this->input->post('usuario') : 0;
        
        $this->db->select('e.nombre establecimiento, c.importe_total, c.baseIva0, c.baseIva12, c.iva12, c.total_sin_impuestos, c.numero, c.fecha, p.documento, p.razon_social, u.nombre usuario');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->join('tributario.entidad p', 'c.entidad_id = p.id', 'left');
        $this->db->join('seguridad.usuario u', 'c.usuario_id = u.id', 'left');
        $this->db->where("c.origen = 'Compra' and c.tipo = '01' and c.fecha >= '$desde' and c.fecha <= '$hasta' and ($usuario=0 or c.usuario_id=$usuario)");                
        $lista = $this->db->get('tributario.comprobante c')->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['usuario'] = $usuario;
        $this->data['lista'] = $lista;
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
            $this->data['file_name'] = 'compras.pdf';
            $this->data['view'] = 'reportes/compras_pdf';
            $this->data['usuario'] = $usuario ? $this->usuario_model->get($usuario)->nombre : '--Todos--';
            report_to_pdf($this->data);
        }else{
            $this->data['usuarios'] = $this->entity_model->select_list_usuarios('--Todos--');
            $this->load->view('template/admin', $this->data);
        }
    }
    
    
    public function cierres_caja() {
        $this->data['title'] = "Cierres de caja";
        $this->data['page_map'] = array("Reportes", "Cierres de caja");
        $this->data['view'] = 'reportes/cierres_caja';
        
        
        $accion = $this->input->post('accion');
        $desde = $this->input->post('desde') ? $this->input->post('desde') : date('Y-m-d');
        $hasta = $this->input->post('hasta') ? $this->input->post('hasta') : date('Y-m-d');                
        $usuario = $this->input->post('usuario') ? $this->input->post('usuario') : 0;
        
        $this->db->select('c.*, u.nombre usuario, e.nombre establecimiento');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');        
        $this->db->join('seguridad.usuario u', 'c.usuario_id = u.id', 'left');
        $this->db->where("date(c.fecha_cierre) >= '$desde' and date(c.fecha_cierre) <= '$hasta' and ($usuario=0 or c.usuario_id=$usuario)");                
        $lista = $this->db->get('financiero.caja c')->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['usuario'] = $usuario;
        $this->data['lista'] = $lista;
        
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
            $this->data['file_name'] = "Cierres de caja ($desde - $hasta).pdf";
            $this->data['view'] = 'reportes/cierres_caja_pdf';
            $this->data['usuario'] = $usuario ? $this->usuario_model->get($usuario)->nombre : '--Todos--';
            $this->data['orientation'] = 'landscape';
            report_to_pdf($this->data);
        }else{
            $this->data['usuarios'] = $this->entity_model->select_list_usuarios('--Todos--');
            $this->load->view('template/admin', $this->data);
        }
    }
    
    public function series_disponibles($est_id, $pro_id) {        
        $this->data['lista'] = $this->kardex_model->lista_series_disponibles($est_id, $pro_id);
        $this->data['establecimiento'] = $this->establecimiento_model->get($est_id);
        $this->data['producto'] = $producto = $this->producto_model->get($pro_id);                
        
        $this->load->helper('reporte');
        $this->data['file_name'] = "Series ".$producto->nombre.".pdf";
        $this->data['view'] = 'reportes/series_pdf';
        report_to_pdf($this->data);
    }
    
    public function stock($est_id=NULL) {        
        $this->data['lista'] = $lista = $this->stock_model->lista_stock_report_model($est_id);        
        $this->data['establecimiento'] = $establecimiento = $this->establecimiento_model->get($est_id);        
        $this->load->helper('reporte');
        $this->data['file_name'] = "Stock ".$establecimiento->nombre.".pdf";
        $this->data['view'] = 'reportes/stock_pdf';
        report_to_pdf($this->data);        
    }
    
    public function stock_minimo() {
        $user = get_contexto();
        
        $this->data['title'] = "Stock mínimo";
        $this->data['page_map'] = array("Reportes", "Stock mínimo");
        $this->data['view'] = 'reportes/stock_minimo';
        
        $accion = $this->input->post('accion');
        $est_id = $this->input->post('establecimiento') ? $this->input->post('establecimiento') : $user['establecimiento_id'];        
        
        $this->data['lista'] = $lista = $this->stock_model->lista_stock_minimo_report_model($est_id);        
        $this->data['establecimiento'] = $establecimiento = $this->establecimiento_model->get($est_id);        
        $this->data['user'] = $user;
                
        if($accion == 'pdf'){            
            $this->load->helper('reporte');
            $this->data['file_name'] = "Stock mínimo - ".$establecimiento->nombre." - ".  date('dmYHm').".pdf";
            $this->data['view'] = 'reportes/stock_minimo_pdf';
            report_to_pdf($this->data);        
        }else{
            $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos();
            $this->load->view('template/admin', $this->data);
        }
        
    }
    
    public function stock_maximo() {
        $user = get_contexto();
        
        $this->data['title'] = "Stock máximo";
        $this->data['page_map'] = array("Reportes", "Stock máximo");
        $this->data['view'] = 'reportes/stock_maximo';
        
        $accion = $this->input->post('accion');
        $est_id = $this->input->post('establecimiento') ? $this->input->post('establecimiento') : $user['establecimiento_id'];        
        
        $this->data['lista'] = $lista = $this->stock_model->lista_stock_maximo_report_model($est_id);        
        $this->data['establecimiento'] = $establecimiento = $this->establecimiento_model->get($est_id);        
        $this->data['user'] = $user;
                
        if($accion == 'pdf'){            
            $this->load->helper('reporte');
            $this->data['file_name'] = "Stock máximo - ".$establecimiento->nombre." - ".  date('dmYHm').".pdf";
            $this->data['view'] = 'reportes/stock_maximo_pdf';
            report_to_pdf($this->data);        
        }else{
            $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos();
            $this->load->view('template/admin', $this->data);
        }
        
    }
    

}