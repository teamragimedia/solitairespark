<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data safely
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $date    = htmlspecialchars($_POST['date']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'teamragimedia@gmail.com';
        $mail->Password   = 'covvioknbdsobpfu '; // ⚠️ NOT your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Sender & Receiver
        $mail->setFrom('teamragimedia@gmail.com', 'Website Booking');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('mani072409@gmail.com', 'Mani');

        // Email Content
        $mail->isHTML(true);
       $mail->Subject = "New Booking from $name ($email)";

        $mail->Body = "
            <h3>New Booking Details</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Phone:</b> $phone</p>
            <p><b>Date:</b> $date</p>
            <p><b>Message:</b> $message</p>
        ";

        $mail->send();
        echo "success";

    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
}