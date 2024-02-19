<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set recipient email address (replace with your actual email)
    $to = "www.deacon.jason@gmail.com";

    // Set email subject
    $subject = "New Contact Form Submission from $name";

    // Build the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message:\n$message";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'www.deacon.jason@gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Deacon Steyn'; // Replace with your SMTP username
        $mail->Password   = 'deacon1990jason'; // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipient
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $email_message;

        // Send the email
        $mail->send();
        echo "Success! Your message has been sent.";
    } catch (Exception $e) {
        echo "Error! Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error! Invalid form submission.";
}
?>
