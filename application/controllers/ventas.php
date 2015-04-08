<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ventas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('comprobante_model');
        $this->load->model('entidad_model');
        $this->load->model('unidad_model');
        $this->load->model('entity_model');
        $this->load->model('establecimiento_model');
        $this->load->model('producto_model');        
        $this->load->model('transaccion_model');
        
        check_authenticated();
    }

    public function index() {        
        $this->data['title'] = "Ventas";
        $this->data['page_map'] = array("Ventas", "Comprobantes");
        $this->data['view'] = 'ventas/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function index_handler() {
        //Parámetros        
        $sColumns = $this->input->post('sColumns');                 
        $iSortCol_0 = $this->input->post('iSortCol_0');
        $sSortDir_0 = $this->input->post('sSortDir_0');
        $iDisplayStart = $this->input->post('iDisplayStart');
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sSearch = $this->input->post('sSearch');
        $sEcho = $this->input->post('sEcho');        
        $columns = explode(',', $sColumns);
        
        $where = "origen = 'Venta' and (numero like '%$sSearch%' or entidad_documento like '%$sSearch%' or entidad_razon_social like '%$sSearch%')";
        
        $this->db->where(array('origen'=>'Venta'));
        $iTotalRecords = $this->db->count_all_results('tributario.vw_comprobantes');
        
        $this->db->where($where);
        $iTotalDisplayRecords = $this->db->count_all_results('tributario.vw_comprobantes');
                
        $this->db->order_by($columns[$iSortCol_0 ? $iSortCol_0 : 1].' '.$sSortDir_0);        
        $this->db->where($where);
        $query = $this->db->get('tributario.vw_comprobantes', $iDisplayLength, $iDisplayStart);        
        
        $productos = $query->result();
        
        $output = array(
		"sEcho" => $sEcho,
		"iTotalRecords" => $iTotalRecords,
		"iTotalDisplayRecords" => $iTotalDisplayRecords,
                "aaData" => array()
	);
        $baseUrl = base_url()."ventas";
        foreach ($productos as $p) {
            $row = array();
            $disabled = $p->estado == 'Inactivo' ? 'disabled="disabled"' : '';
            $estado = $p->estado == 'Inactivo' ? 'danger':'info';            
            $row[]= "<a href='$baseUrl/ver/$p->id' class='btn btn-default btn-xs' title='Ver'><i class='fa fa-eye'></i></a>";
            $row[]= $p->id;
            $row[]= $p->numero;
            $row[]= $p->fecha;
            $row[]= $p->entidad_documento.' - '.$p->entidad_razon_social;            
            $row[]= label_tipo_comprobante($p->tipo);
            $row[]= label_estado_comprobante($p->estado);            
            $row[]= number_format($p->importe_total, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    public function no_autorizados() {        
        $this->data['title'] = "Ventas";
        $this->data['page_map'] = array("Ventas", "Comprobantes no autorizados");
        $this->data['view'] = 'ventas/no_autorizados';
        $this->load->view('template/admin', $this->data);
    }
    
    public function no_autorizados_handler() {
        //Parámetros        
        $sColumns = $this->input->post('sColumns');                 
        $iSortCol_0 = $this->input->post('iSortCol_0');
        $sSortDir_0 = $this->input->post('sSortDir_0');
        $iDisplayStart = $this->input->post('iDisplayStart');
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sSearch = $this->input->post('sSearch');
        $sEcho = $this->input->post('sEcho');        
        $columns = explode(',', $sColumns);
        
        $where = "estado in ('Devuelto','NoAutorizado') and origen = 'Venta' and (numero like '%$sSearch%' or entidad_documento like '%$sSearch%' or entidad_razon_social like '%$sSearch%')";
        
        $this->db->where("estado in ('Devuelto','NoAutorizado')");
        $this->db->where(array('origen'=>'Venta'));        
        $iTotalRecords = $this->db->count_all_results('tributario.vw_comprobantes');
        
        $this->db->where($where);
        $iTotalDisplayRecords = $this->db->count_all_results('tributario.vw_comprobantes');
                
        $this->db->order_by($columns[$iSortCol_0 ? $iSortCol_0 : 1].' '.$sSortDir_0);        
        $this->db->where($where);
        $query = $this->db->get('tributario.vw_comprobantes', $iDisplayLength, $iDisplayStart);        
        
        $productos = $query->result();
        
        $output = array(
		"sEcho" => $sEcho,
		"iTotalRecords" => $iTotalRecords,
		"iTotalDisplayRecords" => $iTotalDisplayRecords,
                "aaData" => array()
	);
        $baseUrl = base_url()."ventas";
        foreach ($productos as $p) {
            $row = array();
            $disabled = $p->estado == 'Inactivo' ? 'disabled="disabled"' : '';
            $estado = $p->estado == 'Inactivo' ? 'danger':'info';            
            $row[]= "<a href='$baseUrl/ver_mensajes/$p->id' class='btn btn-default btn-xs' title='Ver'><i class='fa fa-eye'></i></a>";
            $row[]= $p->id;
            $row[]= $p->numero;
            $row[]= $p->fecha;
            $row[]= $p->entidad_documento.' - '.$p->entidad_razon_social;            
            $row[]= label_tipo_comprobante($p->tipo);
            $row[]= label_estado_comprobante($p->estado);            
            $row[]= number_format($p->importe_total, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    public function create() {
        $this->data['model'] = array_to_object(array(
            'id'=>NULL,
            'numero'=>'',
            'tipo'=>'',
            'fecha' =>'',
            'estado'=>''
        ));
        
        $this->data['title'] = "Nueva venta";
        $this->data['page_map'] = array("Ventas", page_map("Comprobantes", "ventas/index"), "Nueva");
        $this->data['view'] = 'ventas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /*public function edit($id=NULL) {
        $this->data['model'] = $this->comprobante_model->get($id);                      
        $this->load->view('ventas/edit', $this->data);  
        
        $this->data['title'] = "Editar venta";
        $this->data['page_map'] = array("Ventas", page_map("Comprobantes", "ventas/index"), "Editar");
        $this->data['view'] = 'ventas/edit';
        $this->load->view('template/admin', $this->data);
    }*/
    
    public function ver($id=NULL) {
        $this->data['comprobante'] = $comprobante = $this->comprobante_model->get($id);
        $this->data['entidad'] = $this->entidad_model->get($comprobante->entidad_id);
        $this->data['detalles'] = $this->comprobante_model->get_detalles($id);
        
        $this->data['title'] = "Ver venta";
        $this->data['page_map'] = array("Ventas", page_map("Comprobantes", "ventas/index"), "Ver");
        $this->data['view'] = 'ventas/ver';
        $this->load->view('template/admin', $this->data);
    }
    
    public function ver_mensajes($id=NULL) {
        $this->data['comprobante'] = $comprobante = $this->comprobante_model->get($id);
        $this->data['entidad'] = $this->entidad_model->get($comprobante->entidad_id);
        $this->data['detalles'] = $this->comprobante_model->get_detalles($id);
        $this->data['mensajes'] = $this->comprobante_model->get_mensajes($id);
                
        $this->data['title'] = "Ver mensajes";
        $this->data['page_map'] = array("Ventas", page_map("Comprobantes", "ventas/index"), "Ver mensajes");
        $this->data['view'] = 'ventas/ver_mensajes';
        $this->load->view('template/admin', $this->data);
    }
    
    public function reenviar($id=NULL, $regenerar_numero=FALSE) {
        $this->load->helper('comprobante');
        
        $this->load->config('efac');
        
        $comprobante = $this->comprobante_model->get($id);                
        $entidad = $this->entidad_model->get($comprobante->entidad_id);
        $empresa = $this->entidad_model->get_empresa();
        $detalles = $this->comprobante_model->get_detalles($id);
        
        foreach ($detalles as $d) {
            $d->producto = $this->producto_model->get($d->producto_id);
        }  
        
        if($regenerar_numero){
            $this->load->model('puntoemision_model');
            $comprobante->numero = generar_numero_documento($comprobante);
        }
        $comprobante->clave_acceso = generar_clave_acceso($comprobante, $empresa);
        
        $this->data['entidad'] = $entidad;
        $this->data['empresa'] = $empresa;
        $this->data['comprobante'] = $comprobante;
        $this->data['detalles'] = $detalles;
        $this->data['establecimiento'] = $establecimiento = $this->establecimiento_model->get($comprobante->establecimiento_id);
        
        $xml = null;
        
        if($comprobante->tipo == '01'){
            $this->load->helper('venta');
            $xml = generar_xml_venta($comprobante, $detalles, $entidad, $establecimiento, $empresa);
        }
        
        if($comprobante->tipo == '04'){
            $this->load->helper('notacredito');
            $referencia=$this->comprobante_model->get($comprobante->referencia_id);
            $xml = generar_xml_notacredito($comprobante, $referencia, $detalles, $entidad, $establecimiento, $empresa);
        }
        
        $up = array('id'=>$comprobante->id, 'estado'=>'Registrado', 'xml'=>$xml, 'numero'=>$comprobante->numero,'clave_acceso'=>$comprobante->clave_acceso, 'last_send'=>  date('Y-m-d H:i:s'));        
        $this->comprobante_model->update($up);
        
        return redirect("/ventas/no_autorizados");
    }
    
    public function nota_credito($id=NULL) {
        $comprobante = $this->comprobante_model->get($id);
        $comprobante->referencia_id = $id;
        $comprobante->id = 0;
        
        $this->data['comprobante'] = $comprobante;
        
        $this->data['entidad'] = $this->entidad_model->get($comprobante->entidad_id);
        $detalles = $this->comprobante_model->get_detalles($id);
        
        foreach ($detalles as $item) {
            $item->producto = $this->producto_model->get($item->producto_id);
            $item->unidad = $this->unidad_model->get($item->unidad_id);
        }
        
        $this->data['detalles'] = $detalles;
        
        $this->data['title'] = "Nota de crédito";
        $this->data['page_map'] = array("Ventas", page_map("Comprobantes", "ventas/index"),page_map("Ver", "ventas/ver/".$id), "Nota crédito");
        $this->data['view'] = 'ventas/nota_credito';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $this->load->helper('comprobante');
        $this->load->helper('venta');
        
        $entidad = $this->input->post('entidad');
        $detalles = $this->input->post('detalles');
        $comprobante = $this->input->post('comprobante');
        $comprobante['tipo'] = '01';
        
        //entidades
        $eEntidad = $this->entidad_model->get_by_documento($entidad['documento']);
        if($eEntidad){
            $entidad_id = $entidad['id'] = $eEntidad->id;            
            $this->entidad_model->update($entidad);
        }else{
            $entidad_id = $entidad['id'] = $this->entidad_model->insert($entidad);            
        }
        
        $status = crear_venta($comprobante, $detalles, $entidad);
        
        
        echo json_encode(array('status'=>$status, 'redirect' => base_url().'ventas/cobro/'.$comprobante['id']));
    }  
    
    /**
     * ajax post: edit
     */
    public function save_nota_credito() {
        $this->load->helper('comprobante');
        $this->load->helper('notacredito');
        
        $entidad = $this->input->post('entidad');
        $detalles = $this->input->post('detalles');
        $comprobante = $this->input->post('comprobante');
        $comprobante['tipo'] = '04';
        
        //entidades
        $eEntidad = $this->entidad_model->get_by_documento($entidad['documento']);
        if($eEntidad){
            $entidad_id = $entidad['id'] = $eEntidad->id;            
            $this->entidad_model->update($entidad);
        }else{
            $entidad_id = $entidad['id'] = $this->entidad_model->insert($entidad);            
        }
        
        $status = crear_nota_credito($comprobante, $detalles, $entidad);
        
        
        echo json_encode(array('status'=>$status));
    }  
    
    public function cobro($id=NULL) {
        $comprobante = $this->comprobante_model->get($id);
        $entidad = $this->entidad_model->get($comprobante->entidad_id);
        
        $this->data['comprobante'] = $comprobante;
        $this->data['entidad'] = $entidad;
        
        $this->data['title'] = "Cobro";
        $this->data['page_map'] = array("Ventas", "Nueva", "Cobro");
        $this->data['view'] = 'ventas/cobro';
        $this->load->view('template/admin', $this->data);
    }
    
    public function save_cobro($id=NULL) {
        $comprobante = $this->comprobante_model->get($id);
        $entidad = $this->entidad_model->get($comprobante->entidad_id);        
        $pagos = $this->input->post('pagos');
        
        $trnId = $this->transaccion_model->generar_cxc($comprobante, $entidad, $pagos);
        
        if(!$trnId){
            $this->data['comprobante'] = $comprobante;
            $this->data['entidad'] = $entidad;

            $this->data['title'] = "Cobro";
            $this->data['page_map'] = array("Ventas", "Nueva", "Cobro");
            $this->data['view'] = 'ventas/cobro';
            $this->load->view('template/admin', $this->data);
        }else {
            redirect('/ventas');
        }
    }
    
    public function forma_pago($id, $forma_pago) {                
        if($forma_pago == 'Deposito' || $forma_pago == 'Transferencia'){
            $this->data['cuentas'] = $this->entity_model->select_list_cuentas_bancarias();        
        }                
        
        $this->load->view('ventas/forma_pago/'.$forma_pago, $this->data);
    }
    

}