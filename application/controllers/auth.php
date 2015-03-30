<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('usuario_model');
        $this->load->helper(array('form'));
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->usuario_model->autenticar($username, $password);
        
        if($user){
            $sess_array = array('id'=>$user->id,'nombre'=>$user->nombre,'descripcion'=>$user->descripcion,'establecimiento_id'=>$user->establecimiento_id);
            $this->session->set_userdata('logged_in', $sess_array);
            $this->session->set_flashdata("info_msg", "Usuario validado correctamente!");
            redirect('/admin');
        }else{
            $this->session->set_flashdata("error_msg", "Nombre de usuario o clave no válidos");
            redirect('/');            
        }                
    }
    
    function logout() {        
        $this->session->unset_userdata('logged_in',null);
        session_destroy();
        redirect(site_url());
    }

}