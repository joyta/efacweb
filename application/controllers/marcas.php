<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marcas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('marca_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['marcas'] = $this->marca_model->all();  
        
        $this->data['title'] = "Marcas";
        $this->data['page_map'] = array("Inventario", "Marcas");
        $this->data['view'] = 'marcas/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['marca'] = json_decode(json_encode(array('id'=>NULL,'nombre'=>'','descripcion'=>'')));        
        
        $this->data['title'] = "Nueva marca";
        $this->data['page_map'] = array("Inventario", page_map("Marcas", "marcas/index"), "Nueva");
        $this->data['view'] = 'marcas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['marca'] = $this->marca_model->get($id);                      
        
        $this->data['title'] = "Editar marca";
        $this->data['page_map'] = array("Inventario", page_map("Marcas", "marcas/index"), "Editar");
        $this->data['view'] = 'marcas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->marca_model->delete($id);
        echo json_encode(array('status'=>'ok'));
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
            $this->marca_model->update($data);
        }else{
            $this->marca_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }        

}