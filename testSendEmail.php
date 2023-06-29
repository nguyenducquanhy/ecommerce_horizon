
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Đọc dữ liệu từ yêu cầu gửi email
$recipient = 'nguyenducquanhy2@gmail.com';
$subject = 'Here is the subject';
$body ='This is the HTML message body ';
echo 1;
// Khởi tạo một đối tượng PHPMailer
$mail = new PHPMailer(true);
echo 2;
try {
    echo 3;
    // Cấu hình máy chủ SMTP của Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'quanhy2@gmail.com';  // Your Gmail address
    $mail->Password = 'xzrqfpdwidjqwqbi';   // Your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    echo 3;
    // Thiết lập thông tin người gửi và người nhận
    $mail->setFrom('quanhy2@gmail.com', 'quan'); // Địa chỉ email và tên của bạn
    $mail->addAddress($recipient); // Địa chỉ email người nhận

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    echo 4;
    // Gửi email
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>
