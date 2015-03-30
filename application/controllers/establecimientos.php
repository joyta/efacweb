<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Establecimientos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('establecimiento_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['establecimientos'] = $this->establecimiento_model->all();        
        
        $this->data['title'] = "Establecimientos";
        $this->data['page_map'] = array("Configuración", "Establecimientos");
        $this->data['view'] = 'establecimientos/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {        
        $this->data['establecimiento'] = json_decode(json_encode(array('id'=>NULL,'codigo'=>'','nombre'=>'','direccion'=>'','telefono'=>'')));
        
        $this->data['title'] = "Nuevo establecimientos";
        $this->data['page_map'] = array("Configuración", page_map("Establecimientos", "establecimientos/index"), "Nuevo");
        $this->data['view'] = 'establecimientos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['establecimiento'] = $this->establecimiento_model->get($id);
        
        $this->data['title'] = "Editar establecimientos";
        $this->data['page_map'] = array("Configuración", page_map("Establecimientos", "establecimientos/index"), "Editar");
        $this->data['view'] = 'establecimientos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->establecimiento_model->delete($id);
        echo json_encode(array('status'=>'ok'));
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'codigo'=>$this->input->post('codigo'),
            'nombre'=>$this->input->post('nombre'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono')            
        );
        
        if($data['id']){
            $this->establecimiento_model->update($data);
        }else{
            $this->establecimiento_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  

}