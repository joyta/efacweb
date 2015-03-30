<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transacciones extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('transaccion_model');
        $this->load->model('partner_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function cuentas_cobrar() {        
        $this->data['title'] = "Cuentas por cobrar";
        $this->data['page_map'] = array("Financiero", "Cuentas por cobrar");
        $this->data['view'] = 'transacciones/cuentas_cobrar';
        $this->load->view('template/admin', $this->data);
    }
    
    public function cuentas_cobrar_handler() {
        //Parámetros        
        $sColumns = $this->input->post('sColumns');                 
        $iSortCol_0 = $this->input->post('iSortCol_0');
        $sSortDir_0 = $this->input->post('sSortDir_0');
        $iDisplayStart = $this->input->post('iDisplayStart');
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sSearch = $this->input->post('sSearch');
        $sEcho = $this->input->post('sEcho');        
        $columns = explode(',', $sColumns);
        
        $where = "grupo ='Cxc' and tipo = 'Factura' and (concepto like '%$sSearch%')";
        
        $this->db->where(array('grupo'=>'Cxc','tipo'=>'Factura'));
        $iTotalRecords = $this->db->count_all_results('financiero.vw_transacciones');
        
        $this->db->where($where);
        $iTotalDisplayRecords = $this->db->count_all_results('financiero.vw_transacciones');
                
        $this->db->order_by($columns[$iSortCol_0 ? $iSortCol_0 : 1].' '.$sSortDir_0);        
        $this->db->where($where);
        $query = $this->db->get('financiero.vw_transacciones', $iDisplayLength, $iDisplayStart);        
        
        $productos = $query->result();
        
        $output = array(
		"sEcho" => $sEcho,
		"iTotalRecords" => $iTotalRecords,
		"iTotalDisplayRecords" => $iTotalDisplayRecords,
                "aaData" => array()
	);
        $baseUrl = base_url()."transacciones";
        foreach ($productos as $p) {
            $row = array();
            
            $row[]= "<a href='$baseUrl/ver/$p->id' class='btn btn-default btn-xs' title='Ver'><i class='fa fa-eye'></i></a>";
            $row[]= $p->id;
            
            $row[]= $p->fecha;
            $row[]= $p->concepto;            
            $row[]= $p->partner_documento.' - '.$p->partner_razon_social;            
            
            $row[]= label_estado_transaccion($p->estado);                
            $row[]= number_format($p->monto, 2);
            $row[]= number_format($p->saldo, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    public function cuentas_pagar() {        
        $this->data['title'] = "Cuentas por pagar";
        $this->data['page_map'] = array("Financiero", "Cuentas por pagar");
        $this->data['view'] = 'transacciones/cuentas_pagar';
        $this->load->view('template/admin', $this->data);
    }
    
    public function cuentas_pagar_handler() {
        //Parámetros        
        $sColumns = $this->input->post('sColumns');                 
        $iSortCol_0 = $this->input->post('iSortCol_0');
        $sSortDir_0 = $this->input->post('sSortDir_0');
        $iDisplayStart = $this->input->post('iDisplayStart');
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sSearch = $this->input->post('sSearch');
        $sEcho = $this->input->post('sEcho');        
        $columns = explode(',', $sColumns);
        
        $where = "grupo ='Cxp' and tipo = 'Factura' and (concepto like '%$sSearch%')";
        
        $this->db->where(array('grupo'=>'Cxp','tipo'=>'Factura'));
        $iTotalRecords = $this->db->count_all_results('financiero.vw_transacciones');
        
        $this->db->where($where);
        $iTotalDisplayRecords = $this->db->count_all_results('financiero.vw_transacciones');
                
        $this->db->order_by($columns[$iSortCol_0 ? $iSortCol_0 : 1].' '.$sSortDir_0);        
        $this->db->where($where);
        $query = $this->db->get('financiero.vw_transacciones', $iDisplayLength, $iDisplayStart);        
        
        $productos = $query->result();
        
        $output = array(
		"sEcho" => $sEcho,
		"iTotalRecords" => $iTotalRecords,
		"iTotalDisplayRecords" => $iTotalDisplayRecords,
                "aaData" => array()
	);
        $baseUrl = base_url()."transacciones";
        foreach ($productos as $p) {
            $row = array();
            
            $row[]= "<a href='$baseUrl/pago/$p->id' class='btn btn-default btn-xs' title='Ver'><i class='fa fa-eye'></i></a>";
            $row[]= $p->id;
            
            $row[]= $p->fecha;
            $row[]= $p->concepto;            
            $row[]= $p->partner_documento.' - '.$p->partner_razon_social;            
            
            $row[]= label_estado_transaccion($p->estado);                
            $row[]= number_format($p->monto, 2);
            $row[]= number_format($p->saldo, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    
    public function pago($id=0) {        
        $this->data['title'] = "Pago";
        $this->data['page_map'] = array("Financiero", "Cuentas por pagar", "Pago");
        $this->data['view'] = 'transacciones/pago';
        
        $this->data['transaccion']= $transaccion = $this->transaccion_model->get($id);
        $this->data['partner'] = $partner = $this->partner_model->get($transaccion->partner_id);
        
        $this->load->view('template/admin', $this->data);
    }
    
    public function forma_pago($id, $forma_pago) {
        $this->data['transaccion'] = $this->transaccion_model->get($id);
        $this->load->view('transacciones/forma_pago/'.$forma_pago, $this->data);
    }

}