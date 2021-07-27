<?php

Class Auth extends CI_Controller{

    function __construct() {
        parent:: __construct();
        $this->load->model("user/model","mod");
         $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Login';
        $akses = $this->access->get_level();
        if (!$this->access->is_login()) {
            $this->load->view('Auth/frm_login', $data);
        } else {
            redirect('dashboard');
        }
    }
    function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->form_validation->set_rules('token', 'token', 'callback_check_login');
            if ($this->form_validation->run() == FALSE) {
                $status['status'] = 0;
                $status['error'] = validation_errors();
            } else {
              $status['status'] = 1;
            }
        } else {
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }

        echo json_encode($status);
    }

    function logout() {
        $this->access->logout();
        redirect('Auth');
    }



    function check_login() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $login = $this->access->login($username, $password);

        if ($login == 1) {
            return TRUE;
        } else if ($login == 2) {
            $this->form_validation->set_message('check_login', 'Wrong Password');
            return FALSE;
        } else {
            $this->form_validation->set_message('check_login', 'unknown User');
            return FALSE;
        }
    }





}
