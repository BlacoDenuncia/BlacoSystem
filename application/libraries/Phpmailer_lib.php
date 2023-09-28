<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Phpmailer_lib{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        
        require_once APPPATH.'third_party/mailer/src/Exception.php';
        require_once APPPATH.'third_party/mailer/src/PHPMailer.php';
        require_once APPPATH.'third_party/mailer/src/SMTP.php';

        $mail = new PHPMailer;
        return $mail;
    }
}