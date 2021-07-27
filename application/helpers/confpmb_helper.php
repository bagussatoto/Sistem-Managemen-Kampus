<?php

function confPMB(){

    $CI    = & get_instance();
    $CI->load->model('user/model','users_model');
    $CI->users_model->get_conf();

}
