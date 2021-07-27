<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_menu extends CI_Model {

    function __construct() {
        parent::__construct();
    }


	function get() {
    $this->datatables->select('id,tipe,parent,id_menu,name,url,icon,seq');
    $this->datatables->from('sys_menu');
    $this->datatables->add_column('view', '<a href="#" data-level="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="level/delete/$1" class="btn bg-red btn-xs waves-effect"><i class = "fa fa-trash-o"></i></a>', 'levels');
    return $this->datatables->generate();
  }


	function save(){

		$type 			= $this->input->post('type');
		$parent 		= $this->input->post('parent');
		$menu 			= $this->input->post('menu');
		$label_menu = $this->input->post('label_menu');
		$url 			  = $this->input->post('url');
		$icon 			= $this->input->post('icon');
		$order 			= $this->input->post('order');
		$data = array(
			'tipe'		 => $type,
			'parent'	 => $parent,
			'id_menu'	 => $menu,
			'name'	 	 => $label_menu,
			'url'	 	 => $url,
			'icon'	 	 => $icon,
			'seq'	 	 => $order
		);

		$save = $this->db->insert('sys_menu',$data);
		if($save){
			$this->session->set_flashdata('msg',

	        '<div class="alert alert-success alert-dismissible fade in" role="alert">

	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	                 <i class="fa fa-check"></i> Data Saved Succesfully !

	          </div>');

	    	redirect('menu');
		}
	}

  function get_menu($menu){
    $this->db->order_by('seq','asc');
    return $this->db->get_where('sys_menu',array('parent'=>$menu));
  }
}
