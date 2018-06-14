<?php
include_once '../dbconnect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../IKWILEmail_Engine/src/Exception.php';
require '../IKWILEmail_Engine/src/PHPMailer.php';
require '../IKWILEmail_Engine/src/SMTP.php';

$email = $_GET["email"];


$new_password = uniqid();

$sql = "UPDATE ikwil_users SET password = md5('$new_password') WHERE email = '$email'";	
$result = mysqli_query($con, $sql);

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// Retrieve the email template required
$message = file_get_contents('../IKWILEmail_Engine/email_templates/forgot-password.html');


$message = str_replace('%new_password%', $new_password, $message); 

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
    $mail->Subject = 'Uw nieuwe wachtwoord';
    //Set the message
	$mail->MsgHTML($message);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->send();
	header("Location: ../index.php"); 
	

	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	?>