<?php
require '';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Create a PHPMailer object
$mail = new PHPMailer();

// Configure Gmail SMTP settings
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'fitshark.store@gmail.com'; // Your Gmail email address
$mail->Password = '@fitstart123'; // Your Gmail password or an app-specific password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Set the sender and recipient email addresses
$mail->setFrom('your_email@gmail.com', 'Your Name'); // Your Gmail email address
$mail->addAddress('recipient@example.com', 'Recipient Name'); // Recipient's email address

// Set email subject and body
$mail->Subject = 'Your Invoice';
$mail->Body = 'Please find your invoice attached.';

// Add the PDF as an attachment
$pdfFilePath = 'path_to_your_generated_pdf.pdf'; // Replace with the actual path
$mail->addAttachment($pdfFilePath);

// Send the email
if ($mail->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Email could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
