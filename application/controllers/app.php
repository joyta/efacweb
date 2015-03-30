<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();        
        $this->load->helper(array('form'));
    }

    public function validUnique() {        
        $attr = $this->input->post('attr');
        $table = explode(".", $attr);
        $id = $this->input->post('id');
        $id = $id ? $id : 0;
        $value = $this->input->post('value');
        
        $this->db->where($table[2],$value);
        $this->db->where("id != $id");
        $query = $this->db->get($table[0].'.'.$table[1]);
        
        if ($query->num_rows() > 0){
            echo "false";
        }
        else{
            echo "true";
        }
        //echo $this->db->last_query();
    }        

}