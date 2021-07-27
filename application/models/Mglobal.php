<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mglobal extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     public function get_dlevel() {

        $sql='SELECT levels from sys_level';
        $query=$this->db->query($sql);
        $result=$query->result_array();
        return $result;
    }
      public function get_daccess() {

         $sql='SELECT distinct id_menu from sys_access';
        $query=$this->db->query($sql);
        $result=$query->result_array();
        return $result;
    }
}
