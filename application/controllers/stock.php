<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('stock_model');
        $this->load->model('kardex_model');
        $this->load->model('establecimiento_model');
        $this->load->model('producto_model');        
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index($est_id=NULL) {
        $this->data['establecimientos'] = $ests = $this->entity_model->select_list_establecimientos();
        $keys = array_keys($ests);
        $first = $keys[0];
        $this->data['lista'] = $this->stock_model->lista_stock_view_model($est_id ? $est_id : $first);        
        $this->data['est_id'] = $est_id ? $est_id : $first;        
        
        $this->data['title'] = "Stock";
        $this->data['page_map'] = array("Inventario", "Stock");
        $this->data['view'] = 'stock/index';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($est_id, $pro_id) {        
        $this->data['stock'] = $this->stock_model->get_or_create($est_id, $pro_id);
        $this->data['producto'] = $this->producto_model->get($pro_id);
        
        $this->data['title'] = "Editar stock";
        $this->data['page_map'] = array("Inventario", page_map("Stock", "stock/index"), "Editar");
        $this->data['view'] = 'stock/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function kardex($est_id, $pro_id) {        
        $this->data['lista'] = $this->kardex_model->lista($est_id, $pro_id);
        $this->data['establecimiento'] = $this->establecimiento_model->get($est_id);
        $this->data['producto'] = $this->producto_model->get($pro_id);                
        
        $this->data['title'] = "Kardex";
        $this->data['page_map'] = array("Inventario", page_map("Stock", "stock/index"), "Kardex");
        $this->data['view'] = 'stock/kardex';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'producto_id'=>$this->input->post('producto_id'),
            'establecimiento_id'=>$this->input->post('establecimiento_id'),
            'cantidad'=>$this->input->post('cantidad')            
        );
                
        $this->stock_model->update($data);        
        
        echo json_encode(array('status'=>'ok'));
    }  

}