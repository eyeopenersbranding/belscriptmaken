<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../CCSEmail_Engine/src/Exception.php';
require '../CCSEmail_Engine/src/PHPMailer.php';
require '../CCSEmail_Engine/src/SMTP.php';
$email = $_GET["email"];
$token = $_GET["token"];
$name = $_GET["name"];
$surname = $_GET["surname"];
$user_id = $_GET["user_id"];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// Retrieve the email template required
$message = file_get_contents('../CCSEmail_Engine/email_templates/register.html');
$message = str_replace('%name%', $name, $message); 
$message = str_replace('%surname%', $surname, $message); 

$message = str_replace('%username%', $email, $message); 
$message = str_replace('%token%', $token, $message); 
$message = str_replace('%id%', $user_id, $message);
try {
    //Server settings
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
    $mail->addAddress("$email", "$name $surname");     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account activeren';
    //Set the message
	$mail->MsgHTML($message);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->send();
	header("Location: ../../registration-successful/index.php?email=$email"); 
	

	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	?>