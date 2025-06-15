<?php
// PHPMailer main class placeholder
namespace PHPMailer\PHPMailer;
class PHPMailer {
  const ENCRYPTION_STARTTLS = 'tls';
  public function __construct() {}
  public function isSMTP() {}
  public function send() { return true; }
  public function setFrom($address, $name = '') {}
  public function addAddress($address) {}
  public function isHTML($bool) {}
  public function Subject($subject) {}
  public function Body($body) {}
}
?>
