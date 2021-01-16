<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$email=$_POST['email'];
$opt=rand(100000,999999);

$_SESSION["emailotp"]=$opt;

$mail=new PHPMailer();

$mail->isSMTP();

$mail->Host ='smtp.gmail.com';

$mail->SMTPAuth = "true";

$mail->Username = 'brooshbanner47@gmail.com';         
$mail->Password = 'tom@jerry';            
$mail->SMTPSecure = "tls";         
$mail->Port = "587";

$mail->Subject="Test mail";
$mail->Body="Dear User Your OTP is $opt";
$mail->setFrom("brooshbanner47@gmail.com");
$mail->addAddress("$email");

if($mail->send()){
   echo "Mail send";
}else{
   echo "Failed to send";
}


$mail->smtpClose();
