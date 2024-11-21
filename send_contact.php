<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maheeshaudalagama@gmail.com'; // Your Gmail address
        $mail->Password = 'edtv pdfc dxqg xiwe'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('maheeshaudalagama@gmail.com', 'Contact Form');
        $mail->addAddress('maheeshaudalagama@gmail.com'); // Your email address

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = ' New Contact Form Submission';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9;'>
                <h2 style='text-align: center; color: #007BFF;'>New Message from Contact Form</h2>
                <p><strong>Name:</strong> <span style='color: #555;'>$name</span></p>
                <p><strong>Email:</strong> <span style='color: #555;'>$email</span></p>
                <p><strong>Message:</strong> <span style='color: #555;'>$messageContent</span></p>
                <p style='text-align: center;'>
                    <a href='https://maheeshaudalagama.com/' style='background: #007BFF; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Visit Our Website</a>
                </p>
            </div>
        ";

        $mail->send();

        // Success Notification
        echo "
        <html>
        <head>
            <style>
                .notification {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    margin: 50px auto;
                    padding: 20px;
                    border-radius: 10px;
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                    width: 400px;
                }
                .notification button {
                    background-color: #007BFF;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin-top: 10px;
                }
                .notification button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='notification'>
                <h3>Message sent successfully!</h3>
                <p>Thank you for contacting us. We will get back to you soon.</p>
                <button onclick=\"window.location.href='index.php';\">Return Home</button>
            </div>
        </body>
        </html>";
    } catch (Exception $e) {
        // Error Notification
        echo "
        <html>
        <head>
            <style>
                .notification {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    margin: 50px auto;
                    padding: 20px;
                    border-radius: 10px;
                    background-color: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                    width: 400px;
                }
                .notification a {
                    background-color: #007BFF;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    display: inline-block;
                    margin-top: 10px;
                }
                .notification a:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='notification'>
                <h3>Message could not be sent.</h3>
                <p>Mailer Error: {$mail->ErrorInfo}</p>
                <a href='https://wa.me/94767900101'>Contact Admin via WhatsApp</a>
            </div>
        </body>
        </html>";
    }
} else {
    echo "Invalid request.";
}
