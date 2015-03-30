<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('categoria_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['categorias'] = $this->categoria_model->all();          
        
        $this->data['title'] = "Categorias";
        $this->data['page_map'] = array("Inventario", "Categorías");
        $this->data['view'] = 'categorias/index';
        $this->load->view('template/admin', $this->data);
    }        
    
    public function create() {
        $this->data['categoria'] = json_decode(json_encode(array('id'=>NULL,'nombre'=>'','descripcion'=>'')));
        
        $this->data['title'] = "Nueva categoria";
        $this->data['page_map'] = array("Inventario", page_map("Categorias", "categorias/index"), "Nueva");
        $this->data['view'] = 'categorias/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['categoria'] = $this->categoria_model->get($id);
        
        $this->data['title'] = "Editar categoria";
        $this->data['page_map'] = array("Inventario", page_map("Categorias", "categorias/index"), "Editar");
        $this->data['view'] = 'categorias/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $categoria = $this->categoria_model->delete($id);
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
            $this->categoria_model->update($data);
        }else{
            $this->categoria_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }        

}