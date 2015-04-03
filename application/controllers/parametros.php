<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parametros extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('parametro_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->parametro_model->all();  
        
        $this->data['title'] = "Parámetros";
        $this->data['page_map'] = array("Configuración", "Parámetros");
        $this->data['view'] = 'parametros/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'codigo'=>'','descripcion'=>'','valor'=>'')));        
        
        $this->data['title'] = "Nuevo parámetro";
        $this->data['page_map'] = array("Configuración", page_map("Parámetros", "parametros/index"), "Nuevo");
        $this->data['view'] = 'parametros/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->parametro_model->get($id);                      
        
        $this->data['title'] = "Editar parámetro";
        $this->data['page_map'] = array("Configuración", page_map("Parámetros", "parametros/index"), "Editar");
        $this->data['view'] = 'parametros/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    
    /*public function delete($id=NULL) {        
        $marca = $this->parametro_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }*/
    
    public function value_editor($tipo='Cadena', $valor=NULL) {
        $this->data['tipo'] = $tipo;
        $this->data['valor'] = $valor;
        $this->load->view("parametros/value_editor", $this->data);
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'codigo'=>$this->input->post('codigo'),
            'descripcion'=>$this->input->post('descripcion'),
            'tipo'=>$this->input->post('tipo'),
            'valor'=>$this->input->post('valor'),
        );
        
        if($data['id']){
            $this->parametro_model->update($data);
        }else{
            $this->parametro_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }        

}