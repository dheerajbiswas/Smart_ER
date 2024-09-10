<?php
include_once("whatsapp.php");
include('connection.php'); //include_once was written
// require_once __DIR__ . "/vendor/autoload.php";

// --------- PHPMailer initialization ------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 3; //uncomment to see the debuging
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "emailid";
$mail->Password = "password";
// ---------- PHPMailer initialization over ---------------

$body = "SMART-ER Alert\n\nA prompt has been generated for teleconsultation of a patient";
$expert_email = "reciver_emailid";
try{
    $mail->setFrom("emailid", "SMART-ER System");
    $mail->addAddress($expert_email, "Hub Doctor");
    $mail->Subject = "SMART-ER Alert";
    $mail->Body = $body;
    $mail->send();

    echo "Mail sent successfully";
} catch (Exception $e) {
    echo "Error sending mail";
}