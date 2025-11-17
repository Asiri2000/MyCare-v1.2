<?php
 
namespace models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMail
{
    public function sendMailMessage($receiverMail, $receiverName, $subject, $message)
    {
       
        require '../PHPMailer/Exception.php';
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';
        
        $mail = new PHPMailer(true); // Passing true enables exceptions
        
        try {
           
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'awindustries99@gmail.com';
            $mail->Password = 'lcwyumbvfuhqvzzr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('awindustries99@gmail.com', 'MY CARE');
            $mail->addAddress($receiverMail, $receiverName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send email
            $mail->send();
           
            return true; // Email sent successfully
        } catch (Exception $e) {
            // Handle exception
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            error_log($errorMessage); // Log the error (optional)
            return false; // Return false to indicate failure
        }
    }
}

// Example usage:
$mailer = new SendMail();
$success = $mailer->sendMailMessage("va.weerasinghe@gmail.com", "asiri", "Test Subject", "Test message content");

if ($success) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email. Please try again later.";
}
