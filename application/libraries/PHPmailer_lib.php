<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 *
 */
class PHPMailer_lib
{

  public function __construct()
  {
    log_message('Debug','PHP Mailer Class is Loaded');
  }

  public function load()
  {
    require_once APPPATH. 'third_party/PHPMailer/Exception.php';
    require_once APPPATH. 'third_party/PHPMailer/PHPMailer.php';
    require_once APPPATH. 'third_party/PHPMailer/SMTP.php';
    $mail = new PHPMailer();
    return $mail;
  }
}
