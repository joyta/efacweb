<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('menu_model');
        
        check_authenticated();
    }

    public function index() {
        $this->data['lista'] = $this->menu_model->all();  
        
        $this->data['title'] = "Menús";
        $this->data['page_map'] = array("Configuración", "Menús");
        $this->data['view'] = 'menus/index';
        $this->load->view('template/admin', $this->data);
    }                
    
    public function permisos($id=NULL) {        
        $this->data['model'] = $this->menu_model->get($id);                                                      
        $this->load->view('menus/permisos', $this->data);
    }
    
    public function save_permisos() {
        $data = array(
            'id'=>$this->input->post('id'),
            'roles'=>$this->input->post('roles')
        );
        
        
        $this->menu_model->update($data);        
        
        echo json_encode(array('status'=>'ok'));
    } 
   

}