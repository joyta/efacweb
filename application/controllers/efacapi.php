<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Efacapi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();        
        $this->load->helper(array('form'));
    }

    public function enviar_email($id=NULL) {
        $this->load->helper('email');        
        $this->load->helper('comprobante');        
        
        $this->load->model('comprobante_model');
        $this->load->model('entidad_model');
        $this->load->model('establecimiento_model');
        
        $comprobante = $this->comprobante_model->get($id);
        $detalles = $this->comprobante_model->get_detalles($id);        
        $entidad = $this->entidad_model->get($comprobante->entidad_id);
        $establecimiento = $this->establecimiento_model->get($comprobante->establecimiento_id);
        $empresa = $this->entidad_model->get_empresa();
        $referencia = $comprobante->referencia_id ? $this->comprobante_model->get($comprobante->referencia_id) : null;
        
        generar_ride($comprobante,$detalles,$entidad, $establecimiento, $empresa, $referencia, FALSE);
        
        $data = array(
            'to' => $entidad->email,
            'asunto' => 'Comprobante electrónico',
            'view' => 'comprobantes/email',
            'comprobante' => $comprobante,
            'entidad' => $entidad,
            'empresa' => $empresa
        );

        $status = send_email_notificacion_comprobante($data, $comprobante, $entidad, $empresa);                    
        if($status == 'ok'){ 
            $this->db->update('tributario.comprobante', array('last_email'=>date("Y-m-d H:i:s"),'send_email'=>'Si'), array('id'=>$id));
            echo 'ok';
        }else{
            $fecha = new DateTime(date("Y-m-d H:i:s"));
            $fecha = date_add($fecha, date_interval_create_from_date_string('1 days'));
            
            $this->db->update('tributario.comprobante', array('last_email'=>$fecha->format('Y-m-d H:i:s'),'send_email'=>'No'), array('id'=>$id));
            echo 'no';
        }
    }  
    
    public function pdf($id=NULL) {
        $this->load->helper('comprobante');
        $this->load->model('comprobante_model');
        $this->load->model('entidad_model');
        $this->load->model('establecimiento_model');
        
        $comprobante = $this->comprobante_model->get($id);
        $detalles = $this->comprobante_model->get_detalles($id);        
        $entidad = $this->entidad_model->get($comprobante->entidad_id);
        $establecimiento = $this->establecimiento_model->get($comprobante->establecimiento_id);
        $empresa = $this->entidad_model->get_empresa();
        $referencia = $comprobante->referencia_id ? $this->comprobante_model->get($comprobante->referencia_id) : null;
        
        generar_ride($comprobante, $detalles, $entidad, $establecimiento, $empresa, $referencia, TRUE);
    }
    
    public function xml($id=NULL) {
        $this->load->helper('download');
        $this->load->model('comprobante_model');
                
        $comprobante = $this->comprobante_model->get($id);
        
        $name = $comprobante->tipo.'_'.$comprobante->numero.'.xml';
        $data = file_get_contents("/var/www/efacfiles/comprobantes/autorizado/".$name);
        
        force_download($name, $data); 
    }
    
    public function barcode($code){
        /*        
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text'=>$code,'barHeight'=>32, 'barWidth'=>200), array());    */
        
        $this->load->library('barcode_manager');
        
        $center_x = 150;
        $center_y = 25;
        $height = 50;
        $width = 300;
        $bars_height = 40;
        $bars_width = 1;

        $this->barcode_manager->create_barcode($code, $center_x, $center_y, $width, $height, $bars_width, $bars_height);
    }

}