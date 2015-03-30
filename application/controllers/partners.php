<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partners extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('partner_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->partner_model->all();                
        
        $this->data['title'] = "Partners";
        $this->data['page_map'] = array("Configuración", "Partners");
        $this->data['view'] = 'partners/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {        
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'tipo_documento'=>'Cedula','documento'=>'','razon_social'=>'','nombre_comercial'=>'',
            'celular'=>'','telefono'=>'','email'=>'','direccion'=>'','estado'=>'Activo','is_proveedor'=>'t')));
        
        $this->data['title'] = "Nuevo partners";
        $this->data['page_map'] = array("Configuración", page_map("Partners", "partners/index"), "Nuevo");
        $this->data['view'] = 'partners/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->partner_model->get($id);
        
        $this->data['title'] = "Editar partners";
        $this->data['page_map'] = array("Configuración", page_map("Partners", "partners/index"), "Editar");
        $this->data['view'] = 'partners/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->partner_model->delete($id);
        echo json_encode(array('status'=>'ok'));
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
            'is_proveedor' => $this->input->post('is_proveedor')
        );
        
        if($data['id']){
            $this->partner_model->update($data);
        }else{
            $this->partner_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  
    
    public function get_autocomplete_clientes($term=''){
        $value = $this->db->escape_like_str($term);        
        $this->db->select("id, tipo_documento, documento, razon_social, direccion, email, telefono, (documento || ' - ' || razon_social) as label, documento as value");
        $this->db->or_like(array("documento"=> $value,'lower(razon_social)'=>  strtolower($value)));
        $q = $this->db->get("tributario.partner", 10);        
        echo json_encode($q->result_array());
    }
    
    public function get_autocomplete_proveedores($term=''){
        $value = $this->db->escape_like_str($term);        
        $this->db->select("id, tipo_documento, documento, razon_social, direccion, email, telefono, (documento || ' - ' || razon_social) as label, documento as value");
        $this->db->where('(is_proveedor = TRUE)');
        $this->db->or_like(array("documento"=> $value,'lower(razon_social)'=>  strtolower($value)));
        $q = $this->db->get("tributario.partner", 10);        
    //echo $this->db->last_query();
        echo json_encode($q->result_array());
    }

}