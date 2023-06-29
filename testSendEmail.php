<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                               
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  // GMail SMTP server
    $mail->SMTPAuth = true;                             
    $mail->Username = 'quanhy2@gmail.com';  // Your Gmail address
    $mail->Password = 'xzrqfpdwidjqwqbi';   // Your App Password
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 587;                                    

    //Recipients
    $mail->setFrom('quanhy2@example.com', 'duc quan');
    $mail->addAddress('nguyenducquanhy2@example.com', 'quan giai tich');     
    $mail->addReplyTo('quanhy2@example.com', 'quan');

    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
