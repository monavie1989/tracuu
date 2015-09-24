<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
class Mailer extends PHPMailer {
    public function __construct() {
        $this->setLanguage('vi');
    }
}
?>