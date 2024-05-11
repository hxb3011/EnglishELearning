<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use phpseclib3\Math\BigInteger\Engines\PHP;

requirl("composer/vendor/autoload.php");


$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "koongchanphong0712@gmail.com";
$mail->Password = "rvjxclbpjbzpptyc";
$mail->isHTML(true);
return $mail;
