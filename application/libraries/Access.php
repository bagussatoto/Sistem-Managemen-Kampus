<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access {

    public $user;

    function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->helper('cookie');
     	  $this->CI->load->model('user/model','users_model');

        $this->users_model = & $this->CI->users_model;
    }

     function login($username, $password) {
        $result = $this->users_model->get_login_info($username);
        if ($result) {

        if (password_verify($password, $result->password)){

            	 $this->CI->session->set_userdata('username', $result->username);
            	 $this->CI->session->set_userdata('fullname', $result->fullname);
            	 $this->CI->session->set_userdata('level', $result->level);

            	  return 1;
            } else {
                return 2;
            }
        }
        return 0;
    }



    function is_login() {
        return (($this->CI->session->userdata('username')) ? TRUE : FALSE);
    }

    function cek_akses($kode_menu) {
        $level_cookie = $this->CI->session->userdata('level');
        if ($this->users_model->get_akses($kode_menu, $level_cookie) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cek_akses_level($kode_menu, $level) {
        if ($this->users_model->get_akses($kode_menu, $level) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_username(){
         return $this->CI->session->userdata('username');
    }
    function get_fullname(){
         return $this->CI->session->userdata('fullname');
    }
    function get_password(){
         return $this->CI->session->userdata('password');
    }

    function get_level(){
         return $this->CI->session->userdata('level');
    }



     function logout() {
        $this->CI->session->sess_destroy();

    }




}
