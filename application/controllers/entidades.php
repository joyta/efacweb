<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entidades extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('entidad_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->entidad_model->all();                
        
        $this->data['title'] = "Entidades";
        $this->data['page_map'] = array("Configuración", "Entidades");
        $this->data['view'] = 'entidades/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function create() {        
        $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'tipo_documento'=>'Cedula','documento'=>'','razon_social'=>'','nombre_comercial'=>'',
            'celular'=>'','telefono'=>'','email'=>'','direccion'=>'','estado'=>'Activo','is_proveedor'=>'t')));
        
        $this->data['title'] = "Nueva entidad";
        $this->data['page_map'] = array("Configuración", page_map("Entidades", "entidades/index"), "Nueva");
        $this->data['view'] = 'entidades/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {        
        $this->data['model'] = $this->entidad_model->get($id);
        
        $this->data['title'] = "Editar entidad";
        $this->data['page_map'] = array("Configuración", page_map("Entidades", "entidades/index"), "Editar");
        $this->data['view'] = 'entidades/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $marca = $this->entidad_model->delete($id);
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
            $this->entidad_model->update($data);
        }else{
            $this->entidad_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  
    
    public function get_autocomplete_clientes($term=''){
        $value = $this->db->escape_like_str(urldecode($term));        
        $this->db->select("id, tipo_documento, documento, razon_social, direccion, email, telefono, (documento || ' - ' || razon_social) as label, documento as value");
        $this->db->or_like(array("documento"=> $value,'lower(razon_social)'=>  strtolower($value)));
        $q = $this->db->get("tributario.entidad", 10);        
        echo json_encode($q->result_array());
    }
    
    public function get_autocomplete_proveedores($term=''){
        $value = $this->db->escape_like_str(urldecode($term));  
        $lvalue = strtolower($value);
        $this->db->select("id, tipo_documento, documento, razon_social, direccion, email, telefono, (documento || ' - ' || razon_social) as label, documento as value");
        $this->db->where("(is_proveedor = TRUE and tipo_documento='Ruc') and (documento like '%$value%' or razon_social ilike '%$lvalue%')");        
        $q = $this->db->get("tributario.entidad", 10);        
        //secho $this->db->last_query();
        echo json_encode($q->result_array());
    }

}