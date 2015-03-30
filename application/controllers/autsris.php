<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autsris extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('autsri_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->autsri_model->all();                 
        
        $this->data['title'] = "Autorizaciones";
        $this->data['page_map'] = array("Configuración", "Autorizaciones");
        $this->data['view'] = 'autsris/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {        
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'numero'=>'','descripcion'=>'','inicio'=>'','fin'=>'','estado'=>'')));
        
        $this->data['title'] = "Nueva autorización";
        $this->data['page_map'] = array("Configuración", page_map("Autorizaciones", "autsris/index"), "Nueva");
        $this->data['view'] = 'autsris/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->autsri_model->get($id);
        
        $this->data['title'] = "Editar autorización";
        $this->data['page_map'] = array("Configuración", page_map("Autorizaciones", "autsris/index"), "Editar");
        $this->data['view'] = 'autsris/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->autsri_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'numero'=>$this->input->post('numero'),
            'descripcion'=>$this->input->post('descripcion'),
            'inicio' => $this->input->post('inicio'),
            'fin' => $this->input->post('fin'),            
            'estado' => ($this->input->post('estado') ? 'TRUE' : 'FALSE'),
        );
        
        if($data['id']){
            $this->autsri_model->update($data);
        }else{
            $this->autsri_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}