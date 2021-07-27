<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_level extends CI_Model {

    function __construct() {
        parent::__construct();
    }


	function get() {
        $this->datatables->select('levels,description');
        $this->datatables->from('sys_level');
        $this->datatables->add_column('view', '<a href="#" data-level="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="level/delete/$1" class="btn bg-red btn-xs waves-effect"><i class = "fa fa-trash-o"></i></a>', 'levels');
        return $this->datatables->generate();
    }

  function save(){

	   $level 			= $this->input->post('level');
	   $description	= $this->input->post('description');

	   $data = array(
		    'levels'		   => $level,
		    'description'	 => $description
	   );

		$save = $this->db->insert('sys_level',$data);
		if($save){
			$this->session->set_flashdata('msg',
	        '<div class="alert alert-success alert-dismissible fade in" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <i class="fa fa-check"></i> Data Saved Succesfully !
	        </div>');
	    	redirect('level');
		}
	}

	function update(){

		$level 			= $this->input->post('level');
		$description 	= $this->input->post('description');

		$data = array(

			'description'	 => $description

		);

		$save = $this->db->update('sys_level',$data,array('levels'=>$level));
		if($save){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-check"></i> Data Has Been Updated !

	          </div>');

	    	redirect('level');
		}
	}

	function delete(){

		$level = $this->uri->segment(3);
		$delete = $this->db->delete('sys_level',array('levels'=>$level));
		if($delete){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-trash-o"></i> Data Has Been Deleted !

	          </div>');

	    	redirect('level');
		}
	}

	function get_level($level){

		return $this->db->get('sys_level',array('levels'=>$level));
	}

	function get_all(){

		return $this->db->get('sys_level');
	}
}
