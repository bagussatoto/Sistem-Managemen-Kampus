<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Core {

    function __construct() {
        parent:: __construct();

         $this->load->library('form_validation');
    }

    function index(){
    	$data['username'] = $this->access->get_username();
        $data['fullname'] = $this->access->get_fullname();
        $data['level']=$this->access->get_level();

        $data['title'] = 'Home';

        $this->template->display('page/home', $data);
    }
}
