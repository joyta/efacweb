<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compras extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('compra_model');
        $this->load->model('entidad_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->compra_model->all();                  
        
        $this->data['title'] = "Compras";
        $this->data['page_map'] = array("Compras", "Comprobantes");
        $this->data['view'] = 'compras/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['model'] = array_to_object(array(
            'id'=>NULL,
            'numero'=>'',
            'tipo'=>'',
            'fecha' =>'',
            'estado'=>''
        ));
        
        $this->data['title'] = "Nueva compra";
        $this->data['page_map'] = array("Compras", page_map("Comprobantes", "compras/index"), "Nueva");
        $this->data['view'] = 'compras/edit';
        $this->load->view('template/admin', $this->data);        
    }
    
    public function edit($id=NULL) {
        $this->data['model'] = $this->compra_model->get($id);                      
        
        $this->data['title'] = "Editar compra";
        $this->data['page_map'] = array("Compras", page_map("Comprobantes", "compras/index"), "Editar");
        $this->data['view'] = 'compras/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function ver($id=NULL) {
        $this->data['comprobante'] = $comprobante = $this->compra_model->get($id);
        $this->data['entidad'] = $this->entidad_model->get($comprobante->entidad_id);
        $this->data['detalles'] = $this->compra_model->get_detalles($id);
        
        $this->data['title'] = "Ver compra";
        $this->data['page_map'] = array("Compras", page_map("Comprobantes", "compras/index"), "Ver");
        $this->data['view'] = 'compras/ver';
        $this->load->view('template/admin', $this->data);        
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        
        $this->load->helper('compra');
        
        $entidad = $this->input->post('entidad');
        $detalles = $this->input->post('detalles');
        $comprobante = $this->input->post('comprobante');        
        $transaccion = $this->input->post('transaccion'); 
        
        //Entidad
        $eEntidad = $this->entidad_model->get_by_documento($entidad['documento']);
        if($eEntidad){
            $entidad_id = $entidad['id'] = $eEntidad->id;            
            $this->entidad_model->update($entidad);
        }else{
            $entidad_id = $entidad['id'] = $this->entidad_model->insert($entidad);            
        }
        
        $status = crear_compra($comprobante, $detalles, $entidad, $transaccion);
                
        
        echo json_encode(array('status'=>$status));
    }        

}