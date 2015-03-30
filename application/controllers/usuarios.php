<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('usuario_model');
        $this->load->model('entity_model');
    }

    public function index() {
        check_authenticated();
        
        $this->data['usuarios'] = $this->usuario_model->all();        
        
        $this->data['title'] = "Usuarios";
        $this->data['page_map'] = array("Configuración", "Usuarios");
        $this->data['view'] = 'usuarios/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {
        check_authenticated();
        
        $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos('--Seleccione--');
        $this->data['usuario'] = json_decode(json_encode(array('id'=>NULL,'nombre'=>'','descripcion'=>'','estado'=>'','clave'=>'','establecimiento_id'=>'')));
        
        $this->data['title'] = "Nuevo usuario";
        $this->data['page_map'] = array("Configuración", page_map("Usuarios", "usuarios/index"), "Nuevo");
        $this->data['view'] = 'usuarios/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {   
        check_authenticated();
        
        $this->data['establecimientos'] = $this->entity_model->select_list_establecimientos('--Seleccione--');
        $this->data['usuario'] = $this->usuario_model->get($id);        
        
        $this->data['title'] = "Editar usuario";
        $this->data['page_map'] = array("Configuración", page_map("Usuarios", "usuarios/index"), "Editar");
        $this->data['view'] = 'usuarios/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {
        $this->usuario_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'nombre'=>$this->input->post('nombre'),
            'descripcion'=>$this->input->post('descripcion'),
            'clave' => $this->input->post('clave'),
            'estado' => $this->input->post('estado'),
            'rol' => $this->input->post('rol'),
            'establecimiento_id' => $this->input->post('establecimiento_id')
        );
        
        if($data['id']){
            $this->usuario_model->update($data);
        }else{            
            $this->usuario_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}