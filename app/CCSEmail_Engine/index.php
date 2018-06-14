<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// Retrieve the email template required
$message = file_get_contents('email_templates/register.html');
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'send.one.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@eyeopenersbranding.nl';                 // SMTP username
    $mail->Password = 'Locoroco20';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
	$mail->isHTML = (true);
	
    //Recipients
    $mail->setFrom('info@eyeopenersbranding.nl', 'Ikwilfactureren.nl');
    $mail->addAddress('carlos@eyeopenersbranding.nl', 'Joe User');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    	//Set the message
$mail->MsgHTML($message);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}