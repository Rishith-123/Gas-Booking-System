<?php
include('PHPMailer-master/src/PHPMailer.php');
include('PHPMailer-master/src/SMTP.php');
include('PHPMailer-master/src/Exception.php');
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'gasagency84@gmail.com';
$mail->Password = 'gas_agency_123';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('gasagency84@gmail.com', 'Online Gas Book');
$mail->addReplyTo('gasagency84@gmail.com', 'Online Gas Book');

?>