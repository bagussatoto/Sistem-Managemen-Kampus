<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Core extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->access->is_login()){

			redirect('auth');
		}
	}

	function is_login(){
		return $this->access->is_login();
	}

	function cek_akses($kode_menu){
		if(!$this->access->cek_akses($kode_menu)){
			redirect('auth');
		}
	}
}
