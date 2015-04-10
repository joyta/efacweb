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
        
        generar_ride($comprobante,$detalles,$entidad, $establecimiento, $empresa, FALSE);
        
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
        
        
        generar_ride($comprobante, $detalles, $entidad, $establecimiento, $empresa, TRUE);
    }

}