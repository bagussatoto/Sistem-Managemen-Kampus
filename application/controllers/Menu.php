<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends My_Core {

    function __construct() {
        parent:: __construct();
        $this->load->model(array('Model_menu','Model_level','Model_access'));
        
    }

    function index(){
    	$data['username'] = $this->access->get_username();
        $data['fullname'] = $this->access->get_fullname();
        $data['level']	  = $this->access->get_level();
        $data['lv']		  = $this->Model_level->get_all()->result();
		$data['acc']	  = $this->Model_access->get_all()->result();
		$this->template->display('menu/menu', $data);
    }
	
	function get_menu() {
    
		header('Content-Type: application/json');
        echo $this->Model_menu->get();
    }
	
	function save(){
        
		$this->Model_menu->save();
		 
    }
	
	
	function delete(){
		
		$this->Model_menu->delete();
	}
	

}