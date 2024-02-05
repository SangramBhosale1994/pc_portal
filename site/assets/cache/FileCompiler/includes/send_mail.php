
<?php 
$email;
$massage_send_mail;
$subject;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
function send_smtp_mail($email,$massage_send_mail,$subject){
    
// include_once(\ProcessWire\wire('files')->compile(FCPATH.'PHPMailer/src/PHPMailer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
// include_once(\ProcessWire\wire('files')->compile(FCPATH.'PHPMailer/src/SMTP.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
// include_once(\ProcessWire\wire('files')->compile(FCPATH.'PHPMailer/src/Exception.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));


 require(\ProcessWire\wire('files')->compile('PHPMailer/src/Exception.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 require(\ProcessWire\wire('files')->compile('PHPMailer/src/PHPMailer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 require(\ProcessWire\wire('files')->compile('PHPMailer/src/SMTP.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    //Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
// $mail->Username = 'contact@thepridecircle.com';
$mail->Username = 'rise@thepridecircle.com';
//Password to use for SMTP authentication
// $mail->Password = 'wdzk skdb uwqo nwtw';
// $mail->Password = 'sixv qvka cizr pfvc';
$mail->Password = 'sbma iazl dyim gbao';
//Set who the message is to be sent from
$mail->setFrom('rise@thepridecircle.com', 'Pride Circle');

//Set mesaage send to bcc
//$mail->addBCC('amrut@thepridecircle.com');
//Set an alternative reply-to address
$mail->addReplyTo('rise@thepridecircle.com', 'Pride Circle');


//Set who the message is to be sent to
// $mail->addAddress('amrutajagatap10@gmail.com', 'John Doe');
$mail->addAddress($email, '');

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($massage_send_mail);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}


}
