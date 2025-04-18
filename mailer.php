<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');

function sendEmail($to, $subject, $body, $file)
{
    $mail = new PHPMailer(true); // Enable exceptions

    try {


        $headers = 'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        // SMTP Configuration
        $mail->IsSMTP(); // telling the class to use SMTP
        // $mail->SMTPDebug  = 2;                // enables SMTP debug information (for testing)
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "neelsarvaiya11@gmail.com";  // GMAIL username(from)
        $mail->Password   = "bbmu foxp xjpq cdmn";            // GMAIL password(from)
        $mail->SetFrom('neelsarvaiya11@gmail.com', 'Neel Sarvaiya'); //from
        $mail->AddReplyTo("neelsarvaiya11@gmail.com", "$to"); //to
        $mail->Subject    = $subject;
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";


        if ($file) {
            // If it's not a real file path but seems like PDF data
            if (!file_exists($file) && strpos($file, '%PDF') !== false) {
                // Treat it as raw PDF data
                $mail->addStringAttachment($file, 'BookingConfirmation.pdf');
            } else {
                // Treat it as a normal file path
                $mail->AddAttachment($file);
            }
        }

        $mail->MsgHTML($body);

        $mail->AddAddress($to);
        // Send email
        if ($mail->Send()) {
            return true;
        }
        // return "Email sent successfully!";
    } catch (Exception $e) {
        return "Email failed: " . $mail->ErrorInfo;
    }
}
