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
        $this->db->where("c.origen = 'Venta' and c.fecha >= '$desde' and c.fecha <= '$hasta'");        
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
    
    

}