<?php
include("../partials/globle_restriction.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/src/Exception.php';
require '../vendor/src/PHPMailer.php';
require '../vendor/src/SMTP.php';

require '../vendor/autoload.php';

function sendOtpToUser($email,$otp){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vivek.tnitservicesllp@gmail.com';
    $mail->Password = 'imot ywlt smur idku';

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('vivek.tnitservicesllp@gmail.com','Tech Lab');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "One Time Password";
    $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>OTP Email</title>
        </head>
        <body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
            <div style="background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                <h1 style="margin-bottom: 20px;">Your OTP Code</h1>
                <p>Dear User,</p>
                <p>Your One-Time Password (OTP) code is:</p>
                <h2 style="color: #007bff; margin-top: 10px;">'.$otp.'</h2>
                <p>This OTP is valid for a short period of time and should not be shared with anyone. If you did not request this OTP, please ignore this email.</p>
                <p>&copy; Tech Lab. All rights reserved.</p>
            </div>
        </body>
        </html>

    ';
    if (!$mail->send()) {
        $response = array('code' => '0', 'msg' => 'OTP could not be sent');
    } else {
        $response = array('code' => '1', 'msg' => 'Otp sent successfully');
    }
    return $response;
}

if (isset($_POST["otpEmail"])) {
    $otpEmail = $_POST['otpEmail'];
    $checkUser_query = $sql->prepare("SELECT * from `users` WHERE email=?");
    $checkUser_query->bind_param('s', $otpEmail);
    $checkUser_query->execute();
    $checkUser_result = $checkUser_query->get_result();

    if($checkUser_result->num_rows > 0){
        $response = array('code' => '0', 'msg' => 'User already exists');
    }else{
        $otp = sprintf('%06d', mt_rand(100000, 999999));
        $save_otp_query = $sql->prepare("INSERT INTO `otp` (`email`, `otp`) VALUES (?, ?)");
        $save_otp_query->bind_param('ss', $otpEmail, $otp);
        $save_otp_query->execute();
        $response = sendOtpToUser($otpEmail,$otp);
    }

    // Return the counts as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>