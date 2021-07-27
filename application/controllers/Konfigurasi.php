<?php

class Konfigurasi extends MY_Core{
	public function __construct() {
    parent:: __construct();
    $this->load->model('Model_menu');
		$this->load->model('Model_konfigurasi');
		$this->load->model('user/Model','users_model');

  }

	function pmb()
	{
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$menu 						= "settings";
		$data['menu']			= $this->Model_menu->get_menu($menu)->result();
		$data['conf']			= $this->Model_konfigurasi->getConfpmb()->row_array();
		$this->template->display('administrator/konfigurasi/pmb', $data);
	}

	function update_confpmb()
	{
		$this->Model_konfigurasi->update_confpmb();
	}

	function masterjurusan()
	{
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['jurusan']	= $this->Model_konfigurasi->listMasterjurusan()->result();
		$menu 						= "settings";
		$data['menu']			= $this->Model_menu->get_menu($menu)->result();
		$this->template->display('administrator/konfigurasi/masterjurusan', $data);
	}

	function inputmasterjurusan()
	{
		$this->Model_konfigurasi->inputmasterjurusan();
	}

	function hapusmasterjurusan(){
		$kode_jurusan = $this->uri->segment(3);
		$this->Model_konfigurasi->hapusmasterjurusan($kode_jurusan);
	}

	function editmasterjurusan()
	{
		$kode_jurusan 		=	 $this->input->post('kode_jurusan');
		$data['jurusan']	=  $this->Model_konfigurasi->getmasterJurusan($kode_jurusan)->row_array();
		$this->load->view('administrator/konfigurasi/editmasterjurusan',$data);
	}

	function updatemasterjurusan()
	{
		$this->Model_konfigurasi->updatemasterjurusan();
	}

	function jurusan()
	{

		$conf 						= $this->users_model->get_conf()->row_array();
		$data['ta'] 			= $conf['ta_mkt'];
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['jurusan']	= $this->Model_konfigurasi->listMasterjurusan()->result();
		$data['juraktif']	= $this->Model_konfigurasi->listJurusan($conf['ta_mkt'])->result();
		$menu 						= "settings";
		$data['menu']			= $this->Model_menu->get_menu($menu)->result();
		$this->template->display('administrator/konfigurasi/jurusan', $data);
	}

	function inputjurusan()
	{
		$this->Model_konfigurasi->inputjurusan();
	}

	function hapusjurusan(){
		$id = $this->uri->segment(3);
		$this->Model_konfigurasi->hapusjurusan($id);
	}

	function editjurusan()
	{
		$id 							=	 $this->input->post('id');
		$data['jurusan']	=  $this->Model_konfigurasi->getJurusan($id)->row_array();
		$this->load->view('administrator/konfigurasi/editjurusan',$data);
	}

	function updatejurusan()
	{
		$this->Model_konfigurasi->updatejurusan();
	}

	function user()
	{
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['password'] = $this->access->get_password();
		$data['level']	  = $this->access->get_level();
	
		if(	$data['level'] !='admin'){
			
			$data['userdata']	= $this->Model_konfigurasi->listUserByLogin($data['username'])->result();
		}else{
			$data['userdata']	= $this->Model_konfigurasi->listUser()->result();
		}

		$menu 						= "settings";
		$data['menu']			= $this->Model_menu->get_menu($menu)->result();
		$this->template->display('administrator/konfigurasi/user', $data);
	}

	function inputuser()
	{
		$this->Model_konfigurasi->inputuser();
	}
	
	function hapususer(){
		$kode_jurusan = $this->uri->segment(3);
		$this->Model_konfigurasi->hapususer($kode_jurusan);
	}

	function edituser()
	{
		$username 		=	 $this->input->post('username');
		$data['datauser']	=  $this->Model_konfigurasi->getuserbyname($username)->row_array();
		$data['listlevel']	=  $this->Model_konfigurasi->listLevel()->result();
		$this->load->view('administrator/konfigurasi/edituser',$data);
	}
	function updateuser()
	{
		$this->Model_konfigurasi->updateuser();
	}

}
