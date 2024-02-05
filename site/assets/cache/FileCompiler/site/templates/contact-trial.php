<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
</head>
<body>
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {// get form data
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
    $headers = "From: admin@example.com\r\n";
}
    
?>
    <form id="contact-form" method="post" action="submit.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        
        <input type="submit" value="Submit">
        <div id="form-messages"></div>
      </form>

      <script>
        document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // get form data
    var form = event.target;
    var data = new FormData(form);
    
    // send form data to server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'contact-trial.php');
    xhr.send(data);
    
    // handle server response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = xhr.responseText;
        if (response === 'success') {
          form.reset();
          document.getElementById('form-messages').innerHTML = 'Thank you for your message. We will get back to you shortly.';
        } else {
          document.getElementById('form-messages').innerHTML = 'An error occurred. Please try again later.';
        }
      }
    };
  });
      </script>
</body>
</html>