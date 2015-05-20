<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transacciones extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('transaccion_model');
        $this->load->model('banco_model');
        $this->load->model('entidad_model');
        $this->load->model('entity_model');
        $this->load->model('caja_model');
        
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
            
            $row[]= "<a href='$baseUrl/cobro/$p->id' class='btn btn-default btn-xs' title='Ver'><i class='fa fa-eye'></i></a>";
            $row[]= $p->id;
            
            $row[]= $p->fecha;
            $row[]= $p->concepto;            
            $row[]= $p->entidad_documento.' - '.$p->entidad_razon_social;            
            
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
        
        $where = "grupo ='Cxp' and tipo = 'Factura' and estado in('Pendiente','Parcial') and (concepto like '%$sSearch%')";
        
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
            $row[]= $p->entidad_documento.' - '.$p->entidad_razon_social;            
            
            $row[]= label_estado_transaccion($p->estado);                
            $row[]= number_format($p->monto, 2);
            $row[]= number_format($p->saldo, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    
    public function pago($id=0) {     
        
        check_caja();
        
        $this->data['title'] = "Pago";
        $this->data['page_map'] = array("Financiero", page_map("Cuentas por pagar", 'transacciones/cuentas_pagar'), "Pago");
        $this->data['view'] = 'transacciones/pago';
        
        $this->data['transaccion'] = $transaccion = $this->transaccion_model->get($id);
        $this->data['entidad'] = $entidad = $this->entidad_model->get($transaccion->entidad_id);
        $this->data['pagos'] = $this->transaccion_model->get_pagos_transaccion($id);       
        
        $pendientes = $this->transaccion_model->get_transacciones_pendientes($transaccion->entidad_id,'Cxp');
        foreach ($pendientes as $item) {
            $cuotas = $this->transaccion_model->get_cuotas_transaccion($item->id);
            $this->transaccion_model->generar_cuota_cero($item, $cuotas);
            $item->cuotas = $cuotas;
        }
        $this->data['pendientes']=$pendientes;
        
        $this->load->view('template/admin', $this->data);
    }
    
    public function cobro($id=0) {       
        
        check_caja();
        
        $this->data['title'] = "Cobro";
        $this->data['page_map'] = array("Financiero", page_map("Cuentas por cobrar", 'transacciones/cuentas_cobrar'), "Pago");
        $this->data['view'] = 'transacciones/cobro';
        
        $this->data['transaccion'] = $transaccion = $this->transaccion_model->get($id);
        $this->data['entidad'] = $entidad = $this->entidad_model->get($transaccion->entidad_id);
        $this->data['pagos'] = $this->transaccion_model->get_pagos_transaccion($id);       
        
        $pendientes = $this->transaccion_model->get_transacciones_pendientes($transaccion->entidad_id,'Cxc');
        foreach ($pendientes as $item) {
            $cuotas = $this->transaccion_model->get_cuotas_transaccion($item->id);
            $this->transaccion_model->generar_cuota_cero($item, $cuotas);
            $item->cuotas = $cuotas;
        }
        $this->data['pendientes']=$pendientes;
        
        $this->load->view('template/admin', $this->data);
    }
    
    public function forma_pago($id, $forma_pago) {
        $this->data['transaccion'] = $transaccion = $this->transaccion_model->get($id);
        
        if($forma_pago == 'Deposito' || $forma_pago == 'Transferencia'){
            $this->data['cuentas'] = $this->entity_model->select_list_cuentas_bancarias();        
        }
        
        if($forma_pago=='Cheque' && $transaccion->grupo=='Cxp'){             
            $this->data['chequeras'] = $this->banco_model->chequeras_activas();
        }
        
        $this->load->view('transacciones/forma_pago/'.$forma_pago, $this->data);
    }
    
    public function save_pago($id) {
        $pago = $this->input->post('pago');        
        $facturas = $this->input->post('facturas');
        $cuotas = $this->input->post('cuotas');
        
        $this->transaccion_model->save_transaccion_pago($id, $pago, $facturas, $cuotas);
        
        redirect('/transacciones/pago/'.$id);
    }
    
    public function save_cobro($id) {
        $pago = $this->input->post('pago');        
        $facturas = $this->input->post('facturas');
        $cuotas = $this->input->post('cuotas');
        
        $this->transaccion_model->save_transaccion_cobro($id, $pago, $facturas, $cuotas);
        
        redirect('/transacciones/cobro/'.$id);
    }
    
    public function anular_pago($id) {
        $pago = $this->transaccion_model->get_transaccion_pago($id);
        
        $this->transaccion_model->anular_transaccion_pago($id);
        
        redirect('/transacciones/pago/'.$pago->transaccion_id);
    }
    
    public function anular_cobro($id) {
        $pago = $this->transaccion_model->get_transaccion_pago($id);
        
        $this->transaccion_model->anular_transaccion_pago($id);
        
        redirect('/transacciones/cobro/'.$pago->transaccion_id);
    }
    
    
    public function recibo_pago($id) {
        $pago = $this->transaccion_model->get_transaccion_pago($id);
        
        
        
        
        redirect('/transacciones/pago/'.$pago->transaccion_id);
    }
    
    public function recibo_cobro($id) {
        $pago = $this->transaccion_model->get_transaccion_pago($id);
        
        redirect('/transacciones/cobro/'.$pago->transaccion_id);
    }

}