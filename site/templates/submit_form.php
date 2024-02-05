<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // send email to admin
    $to = 'admin@example.com';
    $subject = 'New Contact Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body = "<p>Name: $name</p>\n";
    $body .= "<p>Email: $email</p>\n";
    $body .= "<p>Message:</p>\n";
    $body .= "<p>$message</p>\n";
    $send = mail($to, $subject, $body, $headers);
    
    // send email to user
    $to = $email;
    $subject = 'Thank you for your message';
    $headers = "From: admin@example.com\r\n
