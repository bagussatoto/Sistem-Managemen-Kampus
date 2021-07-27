<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Level extends MY_Core {

    function __construct() {
        parent:: __construct();
        $this->load->model(array('Model_level'));
    }

    function index(){
    	$data['username'] = $this->access->get_username();
        $data['fullname'] = $this->access->get_fullname();
        $data['level']	  = $this->access->get_level();
        $data['title'] 	  = 'Data Level';
        $this->template->display('level/level', $data);
    }

    function get_levels() {

		header('Content-Type: application/json');
        echo $this->Model_level->get();
    }

    function save(){

		$this->Model_level->save();

    }


	function delete(){

		$this->Model_level->delete();
	}

	function update(){
		$this->Model_level->update();
	}

	function edit(){
		$level 			= $this->uri->segment(3);
		$data['level']	= $this->Model_level->get_level($level)->row_array();
		$this->load->view('level/edit',$data);
	}
}
