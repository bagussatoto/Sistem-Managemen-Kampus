<?php

class Akses extends MY_Core {
	function __construct() {
        parent:: __construct();
        $this->load->model(array('Model_access','Model_level'));
    }
	function index(){
		$data['username'] = $this->access->get_username();
        $data['fullname'] = $this->access->get_fullname();
        $data['level']	  = $this->access->get_level();
		$data['lv']		  = $this->Model_level->get_all()->result();
		$this->template->display('access/access', $data);
	}

	function get_access() {

		header('Content-Type: application/json');
		echo $this->Model_access->get();
	}

	function save(){

		$this->Model_access->save();

    }

	function edit(){
		$id 			= $this->uri->segment(3);
		$data['lv']		= $this->Model_level->get_all()->result();
		$data['access']	= $this->Model_access->get_access($id)->row_array();
		$this->load->view('access/edit',$data);
	}

	function update(){
		$this->Model_access->update();
	}

	function delete(){

		$this->Model_access->delete();
	}

	function get_all(){

		$this->Model_access->get_all()->result();

	}
}
