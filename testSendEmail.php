
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Đọc dữ liệu từ yêu cầu gửi email
$address = 'nguyenducquanhy2@gmail.com';
$subject = 'send otp';
$body ='14541';


// Khởi tạo một đối tượng PHPMailer
$mail = new PHPMailer(true);

try {

    // Cấu hình máy chủ SMTP của Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'quanhy2@gmail.com';  // Your Gmail address
    $mail->Password = 'xzrqfpdwidjqwqbi';   // Your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Thiết lập thông tin người gửi và người nhận
    $mail->setFrom('quanhy2@gmail.com', 'Horizon Tech'); // Địa chỉ email và tên của bạn
    $mail->addAddress($address); // Địa chỉ email người nhận

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Gửi email
    $mail->send();
    echo json_encode(
        Array("status"=>200,
        "validCode"=>$body),JSON_UNESCAPED_UNICODE );
    
} catch (Exception $e) {
    echo json_encode( Array("status"=>500,JSON_UNESCAPED_UNICODE ));
}
?>
