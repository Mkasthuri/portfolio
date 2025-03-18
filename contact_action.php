<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
// Include autoload.php file
require 'vendor/autoload.php';
// Create object of PHPMailer class
$mail = new PHPMailer(true);
session_start();

$fname = $_POST['fname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$info = $_POST['info'];
$error = array();


if(empty($fname))
{
     $error[] = 'Please Enter a Name';
}
else if (strlen($fname) < 3) 
{
    $error[] = 'Please Enter a Name Atleast Three Characters';
}
else if (strlen($fname) > 3) 
{
    if (!preg_match("/^[a-zA-Z\s]+$/", $fname)) 
    {
    $error[] = 'Digits or Special Characters Not Allowed) ';
    }
}
else if (strlen($fname) > 15) 
{
    $error[] = 'Full Name: Max Length 15 Characters Not Allowed';
}

if (empty($mobile)) {
   $error[] = "Please Enter a Mobile Number"; 
}
elseif(!preg_match("/^[0-9]{10}+$/", $mobile))
{
    $error[] = "Please Enter a Valid Mobile Number"; 
}

if(empty($info))
{
     $error[] = 'Please Enter a Message';
}
else if(strlen($info)){
    
    if (!preg_match("/^[a-zA-Z\s]+$/", $info)) 
    {
    $error[] = 'Digits or Special Characters Not Allowed';
    }
}
$erro = array();
$i = '<i class="fa fa-warning"></i>';
foreach ($error as $err) {
    $erro[] = $i . ' ' . $err;
}
$error_str = implode('<br>', $erro);
if ($error != NULL) {
    $last_status = 'failed';
}


if ($error == NULL) {

    $mail->isSMTP();
    //$mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    // Gmail ID which you want to use as SMTP server
    $mail->Username = 'kasthuriinn@gmail.com';
    // Gmail Password
    $mail->Password = 'mkni xyct xpsu hpbd';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->From = 'kasthuriinn@gmail.com';
    $mail->FromName = $fname;
    // Email ID from which you want to send the email
    $mail->setFrom('kasthuriinn@gmail.com');
    // Recipient Email ID where you want to receive emails
    $mail->addAddress('kasthuriinn@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Portfolio Form Submission';

   $mail->Body = "<h4>Name : $fname <br><br>Mobile Number : $mobile<br><br>Email : $email  <br><br> Message : $info </h4>";

    //Success
    if ($mail->Send()) {
        $last_status = 'success';
    }
    else{
        $last_status = "failed";
        $error_str = "Server failed to send email , Please try again ...";
    }
}
$response = array(
    'errors' =>  $error_str,
    'status' => $last_status
);
echo json_encode($response);
