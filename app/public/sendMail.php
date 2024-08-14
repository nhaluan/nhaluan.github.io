<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Chỉnh lại đường dẫn tới thư viện PHPMailer nếu cần

function generateRandomString($length = 10)
    {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email  = $_POST['email'];
    $vendor = $_POST['vendor'];

    $username = strtolower($vendor) . "_" . generateRandomString(5);
    $password = generateRandomString(10);

    // Lưu thông tin tài khoản vào database (giả sử đã kết nối đến database)
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // $sql = "INSERT INTO users (email, vendor, username, password) VALUES ('$email', '$vendor', '$username', '$password')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    // $conn->close();

    // Gửi email với thông tin tài khoản
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Địa chỉ SMTP của bạn
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@example.com'; // Địa chỉ email dùng để gửi
        $mail->Password   = 'your_email_password'; // Mật khẩu email của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your new account details';
        $mail->Body    = "Your username is: $username<br>Your password is: $password";

        $mail->send();
        echo 'Message has been sent';
        } catch (\Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>