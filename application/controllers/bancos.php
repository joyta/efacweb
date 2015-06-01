<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bancos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('banco_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->banco_model->all();  
        
        $this->data['title'] = "Bancos";
        $this->data['page_map'] = array("Financiero", "Bancos");
        $this->data['view'] = 'bancos/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'codigo'=>'','nombre'=>'')));        
        
        $this->data['title'] = "Nuevo Banco";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), "Nuevo");
        $this->data['view'] = 'bancos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->banco_model->get($id);                      
        
        $this->data['title'] = "Editar Banco";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), "Editar");
        $this->data['view'] = 'bancos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->banco_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'codigo'=>$this->input->post('codigo'),
            'nombre'=>$this->input->post('nombre')            
        );
        
        if($data['id']){
            $this->banco_model->update($data);
        }else{
            $this->banco_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }      
    
    public function cuentas($id) {
        
        $this->data['model'] = $this->banco_model->get($id);
        $this->data['lista'] = $this->banco_model->cuentas_bancarias($id);  
        
        $this->data['title'] = "Cuentas bancarias";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), "Cuentas bancarias");
        $this->data['view'] = 'bancos/cuentas_index';
        $this->load->view('template/admin', $this->data);
    } 
    
    public function create_cuenta($id) {
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'banco_id'=>$id,'numero'=>'','descripcion'=>'')));        
        
        $this->data['title'] = "Nueva Cuenta";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), page_map("Cuentas bancarias", "bancos/cuentas/".$id), "Nueva");
        $this->data['view'] = 'bancos/edit_cuenta';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit_cuenta($id=NULL) {        
        $this->data['model'] = $model = $this->banco_model->get_cuenta($id);                      
        
        $this->data['title'] = "Editar Cuenta";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), page_map("Cuentas bancarias", "bancos/cuentas/".$model->banco_id), "Editar");
        $this->data['view'] = 'bancos/edit_cuenta';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete_cuenta($id=NULL) {        
        $marca = $this->banco_model->delete_cuenta($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    public function save_cuenta() {
        $data = array(
            'id'=>$this->input->post('id'),
            'banco_id'=>$this->input->post('banco_id'),
            'numero'=>$this->input->post('numero'),
            'descripcion'=>$this->input->post('descripcion')            
        );
        
        if($data['id']){
            $this->banco_model->update_cuenta($data);
        }else{
            $this->banco_model->insert_cuenta($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  
    
    
    
    public function chequeras($id) {
        
        $this->data['model'] = $model = $this->banco_model->get_cuenta($id);
        $this->data['lista'] = $this->banco_model->chequeras($id);  
        
        $this->data['title'] = "Chequeras";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), page_map("Cuentas", "bancos/cuentas/".$model->banco_id), "Chequeras");
        $this->data['view'] = 'bancos/chequeras_index';
        $this->load->view('template/admin', $this->data);
    } 
    
    public function create_chequera($id) {
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'cuenta_id'=>$id,'numero'=>1,'descripcion'=>'')));
        
        $this->data['title'] = "Nueva Chequera";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), page_map("Cuentas bancarias", "bancos/cuentas/".$id), "Nueva");
        $this->data['view'] = 'bancos/edit_chequera';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit_chequera($id=NULL) {
        
        $this->data['model'] = $model = $this->banco_model->get_chequera($id);
        $this->data['cuenta'] = $cuenta = $model = $this->banco_model->get_cuenta($model->cuenta_id);
        
        $this->data['title'] = "Editar Chequera";
        $this->data['page_map'] = array("Financiero", page_map("Bancos", "bancos/index"), page_map("Cuentas bancarias", "bancos/cuentas/$cuenta->banco_id"),  page_map('Chequeras', "bancos/chequeras/$cuenta->id"), "Editar");
        $this->data['view'] = 'bancos/edit_chequera';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete_chequera($id=NULL) {        
        $marca = $this->banco_model->delete_chequera($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    public function save_chequera() {
        $data = array(
            'id'=>$this->input->post('id'),
            'cuenta_id'=>$this->input->post('cuenta_id'),
            'numero'=>$this->input->post('numero'),
            'descripcion'=>$this->input->post('descripcion')            
        );
        
        if($data['id']){
            $this->banco_model->update_chequera($data);
        }else{
            $this->banco_model->insert_chequera($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}