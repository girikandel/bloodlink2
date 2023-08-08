<?php
session_start();
include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mailFor = $_GET['mailFor'];

try {
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );
    //Server settings
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'bloodlink76@gmail.com'; //SMTP username
    $mail->Password = 'hdgzvpeecaamvkfc'; //SMTP password
    $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bloodlink76@gmail.com', 'BloodLink');

    //This is for Blood Request
    if ($mailFor == "bloodRequest") {
        $donorId = $_GET['id'];
        $sql = "SELECT * FROM `users` WHERE `id`= '$donorId'";
        $res = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($res);
        $name = $result['name'];
        $email = $result['email'];

        $mail->addAddress($email, $name); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Urgent Blood Donation Request';
        $mail->Body = '
    <p>I hope this email finds you well. I am reaching out to you personally with an urgent request for blood donation.</p>
    <p>If you are eligible and able to donate blood of the required type, I kindly request you to consider doing so. Your contribution will have a direct and significant impact on the well-being of our friend. The donation process is safe and closely monitored by medical professionals, ensuring your comfort and well-being throughout.</p>
    ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        header("location:index.php?msg=reqSuccess");
    }

    if ($mailFor == "resetPassword") {
        $email = $_SESSION['resetEmail'];
        $name = $_SESSION['resetName'];
        $token = $_SESSION['resetToken'];

        $mail->addAddress($email); //Add a recipient
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body = '<p>Hello ' . $name . ',</p>
        <p>You have received this mail because we received a password reset request for the BloodLink account associated with ' . $email . '.</p>
                <p>You can reset your password by clicking the link below:</p>
        <a href="http://localhost/bloodlink/reset_password.php?token=' . $token . '&email=' . $email . '">Reset Password</a>
        <p>If you did not request a new password, please let us know immediately by replying to this email.</p>
        <p>Regards,<br>BloodLink Team</p>
        ';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        header("location:login.php?msg=resetSent");

        unset($_SESSION['resetEmail']);
        unset($_SESSION['resetName']);
        unset($_SESSION['resetToken']);
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>