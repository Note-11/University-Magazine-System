<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendMail($to, $subject, $body){

    $mail = new PHPMailer(true);

    try {

        // SMTP config (Gmail example)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tharzaw110@gmail.com'; // change
        $mail->Password   = 'orbmjnmviuzsjyjv';    // change
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('tharzaw110@gmail.com', 'UniMag System');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
    }
}