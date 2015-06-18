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
        
        $this->db->select('e.nombre establecimiento, sum(c."importe_total") importe_total, sum(c."baseIva0") baseIva0, sum(c."baseIva12") baseIva12, sum(c."iva12") iva12, sum(c."total_sin_impuestos") total_sin_impuestos');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.fecha >= '$desde' and c.fecha <= '$hasta'");        
        $this->db->group_by("e.id");
        $lista = $this->db->get('tributario.comprobante c')->result();
        
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
        
        $this->db->select('e.nombre establecimiento, c.importe_total, c.baseIva0, c.baseIva12, c.iva12, c.total_sin_impuestos, c.numero, c.fecha, p.documento, p.razon_social, u.nombre usuario');
        $this->db->join('tributario.establecimiento e', 'c.establecimiento_id = e.id', 'left');
        $this->db->join('tributario.entidad p', 'c.entidad_id = p.id', 'left');
        $this->db->join('seguridad.usuario u', 'c.usuario_id = u.id', 'left');
        $this->db->where("c.origen = 'Venta' and c.tipo = '01' and c.fecha >= '$desde' and c.fecha <= '$hasta' and ($usuario=0 or c.usuario_id=$usuario)");                
        $lista = $this->db->get('tributario.comprobante c')->result();
        
        $this->data['desde'] = $desde;
        $this->data['hasta'] = $hasta;
        $this->data['usuario'] = $usuario;
        $this->data['lista'] = $lista;
        
        
        if($accion=="pdf"){
            $this->load->helper('reporte');
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
        $this->data['lista'] = $this->stock_model->lista_stock_report_model($est_id);        
        $this->data['establecimiento'] = $establecimiento = $this->establecimiento_model->get($est_id);
        
        $this->load->helper('reporte');
        $this->data['file_name'] = "Stock ".$establecimiento->nombre.".pdf";
        $this->data['view'] = 'reportes/stock_pdf';
        report_to_pdf($this->data);        
    }
    

}