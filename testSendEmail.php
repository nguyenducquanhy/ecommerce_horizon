
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include'library/cors.php';
include'library/connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Đọc dữ liệu từ yêu cầu gửi email
$otp ='14541';
$address = 'nguyenducquanhy2@gmail.com';
$subject = $otp.' là mã xác nhận email của bạn';
$body ='Chào bạn,<br>

Đây là mã code xác nhận email của bạn: '. $otp.'<br>
Thân,<br>
Team Horizon Tech';


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
        "validCode"=>$otp),JSON_UNESCAPED_UNICODE );
    
} catch (Exception $e) {
    echo json_encode( Array("status"=>500,JSON_UNESCAPED_UNICODE ));
}
?>
