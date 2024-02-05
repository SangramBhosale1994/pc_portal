<?php
if(isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])){
    //Post data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    //mail settings
    $to = "poojamulik34@gmail.com";
    $subject = 'Soni Repairs - Support Request';
    $body = <<<EMAIL

Hi There!

My name is $name.

Message: $message.

My email is: $email
Phone Number: $phone

Kind Regards
EMAIL;

    if(mail($to, $subject, $body, $header)){
        $feedback = '*Message sent! You will receive a reply shortly!';
    }else{
        $feedback = '*Message failed to send';
    }
}else{
    $feedback = 'Missing Params';
}

echo $feedback;
?>