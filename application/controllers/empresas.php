<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('entidad_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->entidad_model->get_empresas();                 
        
        $this->data['title'] = "Empresas";
        $this->data['page_map'] = array("Configuración", "Empresas");
        $this->data['view'] = 'empresas/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {
        $empresa = $this->entidad_model->get_empresa();
        if(!$empresa){
            redirect('/empresas');
        }
            
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'numero'=>'','descripcion'=>'','inicio'=>'','fin'=>'','estado'=>'')));
        
        $this->data['title'] = "Nueva autorización";
        $this->data['page_map'] = array("Configuración", page_map("Autorizaciones", "autsris/index"), "Nueva");
        $this->data['view'] = 'empresas/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->entidad_model->get_empresa();
        
        $this->data['title'] = "Editar empresa";
        $this->data['page_map'] = array("Configuración", page_map("Empresas", "empresas/index"), "Editar");
        $this->data['view'] = 'empresas/edit';
        $this->load->view('template/admin', $this->data);
    }        
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'tipo_documento' => $this->input->post('tipo_documento'),
            'documento' => $this->input->post('documento'),
            'razon_social'=>$this->input->post('razon_social'),
            'nombre_comercial'=>$this->input->post('nombre_comercial'),
            'estado' => $this->input->post('estado'),                        
            'celular' => $this->input->post('celular'),
            'telefono' => $this->input->post('telefono'),
            'email' => $this->input->post('email'),
            'direccion' => $this->input->post('direccion'),
            'is_proveedor' => $this->input->post('is_proveedor'),
            'is_empresa' => 'TRUE'
        );
        
        if($data['id']){
            $this->entidad_model->update($data);
        }else{
            $this->entidad_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}