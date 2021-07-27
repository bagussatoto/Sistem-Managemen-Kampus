<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_c extends My_Core {

    function __construct() {
        parent:: __construct();
        $this->load->model('Mglobal','mod');
    }


    function get_drop_level(){
    	$data = $this->mod->get_dlevel();
    	echo json_encode($data);
    }
    function get_drop_access(){
    	$data = $this->mod->get_daccess();
    	echo json_encode($data);
    }
    
}