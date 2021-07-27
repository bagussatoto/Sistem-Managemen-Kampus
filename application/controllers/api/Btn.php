<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Btn extends REST_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Model_marketing');
  }

  function index_get()
  {
    $presenter =  $this->Model_marketing->listMasterpresenter()->result_array();

    if($presenter)
    {
      $this->response([
          'status' => TRUE,
          'data' => $presenter
      ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
    }
  }
}
