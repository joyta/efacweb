<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Caja extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('caja_model');
        $this->load->model('usuario_model');
        $this->load->model('establecimiento_model');
        
        check_authenticated();
    }    

    public function apertura() {
        $caja = $this->caja_model->get_caja_abierta();
        if($caja){   
            $this->data['model'] = $caja;
            $this->data['view'] = 'caja/msj_abierta';            
        }else{        
            $this->data['model'] = json_decode(json_encode(array('id'=>NULL,'monto_apertura'=>0)));                        
            $this->data['view'] = 'caja/apertura';
        }
        
        $this->data['title'] = "Apertura caja";
        $this->data['page_map'] = array("Caja", "Apertura");
        $this->load->view('template/admin', $this->data);
    }
    
    public function save_apertura() {
        $data = array(            
            'monto_apertura'=>$this->input->post('monto_apertura')            
        );
        
        $caja = $this->caja_model->get_caja_abierta();
        
        if(!$caja){
            $this->caja_model->abri_caja($data);                        
            echo json_encode(array('status'=>'ok', 'redirect' => base_url()));
        }else{
            echo json_encode(array('status'=>'Lo sentimos, la caja ya se encuentra abierta!'));
        }
    }
    
    public function cierre() {
        
        $caja = $this->caja_model->preparar_cierre_caja();
        
        if(!$caja){
            redirect('caja/apertura');
        }
        
        $this->data['model'] = $caja;
        
        $this->data['title'] = "Cierre de caja";
        $this->data['page_map'] = array("Caja", "Cierre");
        $this->data['view'] = 'caja/cierre';
        $this->load->view('template/admin', $this->data);
    }
    
    public function save_cierre() {        
        $caja = $this->caja_model->preparar_cierre_caja();
        $caja->total_existente = $this->input->post('total_existente') * 1;
        $caja->diferencia = $caja->total_existente - $caja->total_efectivo;
        
        if($caja){
            $this->caja_model->cerrar_caja($caja);                        
            echo json_encode(array('status'=>'ok', 'redirect' => base_url().'caja/ver_cierre/'.$caja->id));
        }else{
            echo json_encode(array('status'=>'Lo sentimos, la caja ya se encuentra cerrada!'));
        }
    }
    
    public function ver_cierre($id, $download=NULL) {
        
        $caja = $this->caja_model->get($id);
        
        $f = date('d-m-Y', strtotime($caja->fecha_cierre));
        $u = $this->usuario_model->get($caja->usuario_id);
        $e = $this->establecimiento_model->get($caja->establecimiento_id);
        
        $this->data['model'] = $caja;
        $this->data['usuario'] = $u;
        $this->data['establecimiento'] = $e;
        $this->data['view'] = "caja/ver_cierre";
                
        if($download){
            $this->load->helper('reporte');
            $this->data['file_name'] = "Cierre de caja al $f ($u->nombre).pdf";
            $this->data['view'] = "reportes/cierre_caja_pdf";

            report_to_pdf($this->data);
        }else{
            $this->load->view('template/admin', $this->data);
        }
    }
    
    

}