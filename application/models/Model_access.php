<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_access extends CI_Model {

    function get() {
        $this->datatables->select('id,level,id_menu');
        $this->datatables->from('sys_access');
        $this->datatables->add_column('view', '<a href="#" data-id="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="akses/delete/$1" class="btn bg-red btn-xs waves-effect"><i class = "fa fa-trash-o"></i></a>', 'id');
		return $this->datatables->generate();
	}
	
	function save(){
		
		$level 			= $this->input->post('level');
		$id_menu 		= $this->input->post('id_menu');
		
		$data = array(
			'level'		 => $level,
			'id_menu'	 => $id_menu 
		
		);
		
		$save = $this->db->insert('sys_access',$data);
		if($save){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-check"></i> Data Saved Succesfully !

	          </div>');

	    	redirect('akses');
		}
	}
	
	function update(){
		$id 			= $this->input->post('id');
		$level 			= $this->input->post('level');
		$id_menu 		= $this->input->post('id_menu');
		
		$data = array(
			'level'		=> $level,
			'id_menu'	=> $id_menu 
		
		);
		
		$save = $this->db->update('sys_access',$data,array('id'=>$id));
		if($save){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-check"></i> Data Has Been Updated !

	          </div>');

	    	redirect('akses');
		}
	}
	function get_access($id){
		
		return $this->db->get_where('sys_access',array('id'=>$id));
	}
	
	function delete(){
		
		$id 	= $this->uri->segment(3);
		$delete = $this->db->delete('sys_access',array('id'=>$id));
		if($delete){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-trash-o"></i> Data Has Been Deleted !

	          </div>');

	    	redirect('akses');
		}
	}
	
	function get_all(){
		
		$query = "SELECT distinct id_menu from sys_access";
		return $this->db->query($query);
	}
}