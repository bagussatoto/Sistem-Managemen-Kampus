<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    protected $_ci;

    function __construct() {
        $this->_ci = &get_instance();
    }



    function display($template, $data = null) {
      $CI = & get_instance();
      $mod = $CI->load->model('user/model','users_model');
      $data['content'] = $this->_ci->load->view($template, $data, true);
      $data['menu'] = $CI->users_model->get_menu($this->_ci->access->get_level());
      $data['conf'] = $CI->users_model->get_conf();
      $this->_ci->load->view('template', $data);
    }

    function displaypresenter($template, $data = null) {
      $CI = & get_instance();
      $mod = $CI->load->model('user/model','users_model');
      $data['content'] = $this->_ci->load->view($template, $data, true);
      $data['menu'] = $CI->users_model->get_menu($this->_ci->access->get_level());
      $data['conf'] = $CI->users_model->get_conf();
      $this->_ci->load->view('template2', $data);
    }


}

?>
