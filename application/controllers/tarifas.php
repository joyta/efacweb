<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarifas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('tarifa_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->tarifa_model->all();          
        
        $this->data['title'] = "Tarifas";
        $this->data['page_map'] = array("Inventario", "Tarifas");
        $this->data['view'] = 'tarifas/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['tarifa'] = json_decode(json_encode(array('id'=>NULL,'nombre'=>'','descripcion'=>'')));
        
        $this->data['title'] = "Nueva tarifa";
        $this->data['page_map'] = array("Inventario", page_map("Tarifas", "tarifas/index"), "Nueva");
        $this->data['view'] = 'tarifas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['tarifa'] = $this->tarifa_model->get($id);
        
        $this->data['title'] = "Editar tarifa";
        $this->data['page_map'] = array("Inventario", page_map("Tarifas", "tarifas/index"), "Editar");
        $this->data['view'] = 'tarifas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $tarifa = $this->tarifa_model->delete($id);
        echo json_encode(array('status'=>$tarifa?'ok':'No se puede eliminar la tarifa'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'nombre'=>$this->input->post('nombre'),
            'descripcion'=>$this->input->post('descripcion')
        );
        
        if($data['id']){
            $this->tarifa_model->update($data);
        }else{
            $this->tarifa_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }        

}