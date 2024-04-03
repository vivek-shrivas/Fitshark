<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP server settings for Gmail
    $mail->SMTPDebug = 0;   // Set to 2 for debugging (0 for no debugging)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vivekshrivas347@gmail.com'; // Your Gmail email address
    $mail->Password = '@Vivek25032002'; // The App Password you generated
    $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl'
    $mail->Port = 587; // Specify the SMTP port

    // Recipient and sender details
    $mail->setFrom('vivekshrivas347@gmail.com', 'vivek');
    $mail->addAddress('pasgv13@gmail.com', 'pasgv');

    // Email content
    $mail->isHTML(true); // Set to true for HTML emails
    $mail->Subject = 'hey this is fitshark';
    $mail->Body = 'This is a test email sent via SMTP using PHPMailer and Gmail.';

    // Send the email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Email sending failed: ' . $mail->ErrorInfo;
}
