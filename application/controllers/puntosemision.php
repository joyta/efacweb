<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Puntosemision extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('puntoemision_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->puntoemision_model->vw_lista_puntosemision();                
        
        $this->data['title'] = "Puntos de esmisión";
        $this->data['page_map'] = array("Configuración", "Puntos de esmisión");
        $this->data['view'] = 'puntosemision/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {
        $this->data['usuarios'] = $this->entity_model->select_list_usuarios('--Seleccione--');
        $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos('--Seleccione--');        
        
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'codigo'=>'','secuencial'=>'1','usuario_id'=>'','establecimiento_id'=>'','autsri_id'=>'','tipo_documento'=>1)));
        
        $this->data['title'] = "Nuevo punto emisión";
        $this->data['page_map'] = array("Configuración", page_map("Puntos de esmisión", "puntosemision/index"), "Nuevo");
        $this->data['view'] = 'puntosemision/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {
        $this->data['usuarios'] = $this->entity_model->select_list_usuarios('--Seleccione--');
        $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos('--Seleccione--');        
        
        $this->data['model'] = $this->puntoemision_model->get($id);
        
        $this->data['title'] = "Editar punto emisión";
        $this->data['page_map'] = array("Configuración", page_map("Puntos de esmisión", "puntosemision/index"), "Editar");
        $this->data['view'] = 'puntosemision/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->puntoemision_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'codigo'=>$this->input->post('codigo'),
            'secuencial'=>$this->input->post('secuencial'),
            'tipo_documento' => $this->input->post('tipo_documento'),
            'usuario_id' => $this->input->post('usuario_id'),
            'establecimiento_id' => $this->input->post('establecimiento_id')            
        );
        
        if($data['id']){
            $this->puntoemision_model->update($data);
        }else{
            $this->puntoemision_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}