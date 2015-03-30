<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unidades extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('unidad_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {        
        $this->data['lista'] = $this->unidad_model->all();        
        
        $this->data['title'] = "Unidades";
        $this->data['page_map'] = array("Inventario", "Unidades");
        $this->data['view'] = 'unidades/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {        
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'nombre'=>'','tipo'=>'','equivalencia'=>'1','base_id'=>'')));        
        
        $this->data['title'] = "Nueva unidad";
        $this->data['page_map'] = array("Inventario", page_map("Unidades", "unidades/index"), "Nueva");
        $this->data['view'] = 'unidades/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->unidad_model->get($id);                      
        
        $this->data['title'] = "Editar unidad";
        $this->data['page_map'] = array("Inventario", page_map("Unidades", "unidades/index"), "Editar");
        $this->data['view'] = 'unidades/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->unidad_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    public function get_bases() {        
        $id= $this->input->post('id') ? $this->input->post('id') : 0;       
        $tipo = $this->input->post('tipo');      
        $base_id = $this->input->post('base_id');        
        $bases = $this->entity_model->select_list_unidades_base($id, $tipo);
        echo form_dropdown('base_id', $bases, $base_id, 'id="base_id" class="form-control"');
    }    
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'nombre'=>$this->input->post('nombre'),
            'tipo'=>$this->input->post('tipo'),
            'equivalencia'=>$this->input->post('equivalencia'),
            'base_id'=>$this->input->post('base_id') ? $this->input->post('base_id') : NULL
        );
        
        if($data['id']){
            $this->unidad_model->update($data);
        }else{
            $this->unidad_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }        

}