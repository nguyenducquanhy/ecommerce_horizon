<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


try {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    //Server settings
    $mail->SMTPDebug = 1;        
    $mail->Host = 'smtp.gmail.com';  // GMail SMTP server
    $mail->SMTPAuth = true;                             
    $mail->Username = 'quanhy2@gmail.com';  // Your Gmail address
    $mail->Password = 'xzrqfpdwidjqwqbi';   // Your App Password
    $mail->SMTPSecure = 'tls';     
    $mail->Port = 587;                                    
    echo 2;
    //Recipients
    $mail->setFrom('quanhy2@example.com', 'duc quan');
    $mail->addAddress('nguyenducquanhy2@example.com', 'quan giai tich');     
    $mail->addReplyTo('quanhy2@example.com', 'quan');
    echo 3;
    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    echo 4;
    $mail->send();
    echo 5;
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>