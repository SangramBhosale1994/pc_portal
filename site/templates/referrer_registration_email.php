<?php

include 'includes/send_mail.php';
//require phpmailer/phpmailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//  include_once(FCPATH.'PHPMailer/src/PHPMailer.php');
//   include_once(FCPATH.'PHPMailer/src/SMTP.php');
//   include_once(FCPATH.'PHPMailer/src/Exception.php');


// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require_once "vendor/autoload.php";
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }
	$login_expired = false;
    $is_email_sent=false;
	$already_profile_page=false;
    //if($input->post->otp){
    if($input->get->otp && $input->get->email){
		$email = $sanitizer->email($input->get->email);
        $otp = $sanitizer->text($input->get->otp);
        
        $parent = $pages->get("name=referrer-registration-with-email");
        
/* TODO (comment from Amrut Todkar 2021-02-06) Email needs to be checked here. check if another account with the same email address exists. If it does, show a message that this email already exists and give them the link to the login page or forgot password link. */

		if($parent->children()->get("email=".$email.",otp_status=live,title=".$otp)){
			$p = $parent->children()->get("title=".$otp);
// 			$p->otp_status = "expired";
// 			$p->addStatus(Page::statusUnpublished);
            $created =$p->published;
            //echo $created;
           //$current = $p->wireDate('Y-m-d H:i:s');
            $current =time();
           //echo $current;
            $difference = $current-$created;
            //$difference=500;
            //echo $difference;
			$p->of(false);
			$p->save();

			$session->oauth_gmail = $email;
			
		
			
			if($difference < 600 )
			{
			    header("Location: ".$config->urls->httpRoot."universe/referrer-registration/");
			}
			else{
			   // echo "otp is expired";
			    $login_expired = true;
			}

			
		}
		else{
			$otp_wrong = true;
		}
	}
	else if($input->post->email){
		// 	///echo "1";
			$email = $sanitizer->email($input->post->email);
	// 		echo $email;
	// 		echo "/*/*/*/*/*/*/*";
		
			$already_profile_page=$pages->get("name=universal-profiles")->child("email=".$email);
		//echo $already_profile_page->email;
			
			if($already_profile_page->id!=0){
				$already_profile_page=true;
			}
			elseif($already_profile_page->id==0){
				
				$otp = mt_rand(100000,999999);
			
				$np = new Page();
				$np->template = $templates->get("otp_verification");
				$np->parent = $pages->get("name=referrer-registration-with-email");
				$np->title = $otp;
				$np->email = $email;
				$np->otp_status = "live";
				$np->of(false);
				$np->save();
				
				$a =$pages->get("name=referrer-registration-with-email")->httpUrl."?otp=$otp&email=$email";
				
				$subject ="Activate your Pride Circle TAG account!";
				
				$message ="Greetings from Pride Circle!<br>Thank you for expressing interest to join the Pride Circle TAG.<br><br>Activate your account by clicking the link here <br>(The link is valid only for 10 minuters)<br><br> <a href='".$a."'><button id='btn_register' style='color: #fff;
				 background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Register Here</button></a><br><br>From,<br>Team Pride Circle";
		   
		
		
				try {
					 send_smtp_mail($email,$message,$subject);
		// 			mail($email, $subject, $message, $headers);
		
					$is_email_sent=true;
				} catch (Exception $e) {
					$error_message = true;
				}
			}
			
	
			//header("Location: ".$config->urls->httpRoot."universal-registration-with-otp/");
		}
	else{

    }
    
    /* 
    masking of emails 
    
    Amrut Todkar
    2021-01-09
    
    */

    /*

    Here's the logic:

    We want to show X numbers.
    If length of STR is less than X, hide all.
    Else replace the rest with *.

    */

    function mask($str, $first, $last) {
        $len = strlen($str);
        $toShow = $first + $last;
        return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
    }
    
    function mask_email($email) {
        $mail_parts = explode("@", $email);
        $domain_parts = explode('.', $mail_parts[1]);
    
        $mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
        $domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
        $mail_parts[1] = implode('.', $domain_parts);
    
        return implode("@", $mail_parts);
    }
    
    /* 
    
    masking of emails END

    */
    
    // $parent_email = $pages->get("name=universal-registration-with-email");
    // $email = $parent_email->email;
	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<?php
			include 'includes/general_referrer_header.php';
		?>

	<form action="<?=$config->urls->httpRoot?>universe/referrer-registration-with-email/" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ][ needs-validation ]" method="POST" novalidate>
		

		 <?php
			if($is_email_sent){
		?>
		<div class="[ my-2 ][ text-center ]">
			<h3>Let’s verify your Email</h3>
		</div>
		
        <div style="position: relative;" class="[ my-5 ][ form-group ]">
            <p>Please click on the link sent to <b><?= mask_email($email)?></b> to verify your email ID and begin the registration process.</p>
        </div>

		<?php
			}
			else{
		?> 
		<div class="[ my-2 ][ text-center ]">
			<h3>Welcome to the Pride Circle TAG!</h3>
			<b>Pride Circle’s unique TAG program is open for all (LGBT+ and Allies). Please refer to your LGBT+ connections to win exciting rewards.</b>
		</div>
        <?php
			if($login_expired){
		?>
        	<div class="text-center mt-3">
        	<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">Your login link has expired.</span>
	        </div>

		<?php
			} elseif($already_profile_page){
		?>
        	<div class="text-center mt-3">
        	<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">This email has already been used.</span>
	        </div>

		<?php
			}
		?>

		<div style="position: relative;" class="[ my-5 ][ form-group ]">
		
			<label for="email">To register, please enter your Email ID<br><sub>(The email will get a verification link which will be valid for 10 minutes)</sub></label>

			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" required>
			<!--<sub class="text-muted">*Registration through official Email ID only </sub>-->
			<!--<sub class="text-muted">*Please register using your Official Email ID only </sub>-->

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>
    	
		</div>

		<!-- Buttons Section -->
		<div class="[ d-flex flex-row justify-content-center mb-4 ]">
			<button value="submit" id="submit" class="[ px-4 ][ btn btn-primary ]( btn-submit )" type="submit">
					Submit
			</button>
		</div>

		
		<?php
				}
			?> 
		<div class="[  mb-1  ][ d-flex flex-row justify-content-center ]">
			<a href="<?=$pages->get("name=universe")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]">Login Here</a>
		</div>	
	</form>
	<hr>
	<div class="container">
	    <h3 class="text-center mb-3">FAQ</h3>
	    <b>1. Who is eligible to participate?</b>
	    <p>This program is applicable for all. Kindly do not submit profiles of non- LGBT+.</p>
	    
	     <b>2. How to Register for a Referral Program?</b>
	    <p>Please click on the following link to register for TAG:</p>
	    <p><a href="https://www.thepridecircle.com/universe/referrer-registration-with-email/
">https://www.thepridecircle.com/universe/referrer-registration-with-email/
</a></p>
<p>a. Enter your email address and Submit.<br>
	b. Check your email for a verification link and click on “Register Here”.<br>c. Enter the required information in the Page and submit.<br> d. 
You will be directed to your dashboard where you will see your unique referral code and link. You will be ready to refer.
</p>

		<b>3.How to login if you already have registered for a Referral Program?</b>
	    <p>Please click on the following link to register for TAG:</p>
	    <p><a href="https://www.thepridecircle.com/universe/referrer-registration-with-email/
">https://www.thepridecircle.com/universe/referrer-registration-with-email/
</a></p>
<p>a. Click on Login Here below Register button.<br>
	b. Enter your registered email address and password.
</p>
	    
	     <b>4.How to Refer?</b>
	    <p>Once registration is done. you will get a link which you need to share with your connections.<br>Emailed Referral’s (Resume sent via email) will not be eligible for Referral Program.</p>
	    
	    <b>5.How do I confirm my submission is valid?</b>
	    <p>For a valid submission please provide information across every single field when submitting a resume. You will receive a notification on the TAG dashboard and an email on every successful referral.</p>
	    
	    <b>6. How do I earn points and what is the value of each point?</b>
	    <p>As per our referral program policy referrer can earn points as per following:<br>
            a. Signing up for TAG  (10 TAG Points)<br>
            b. Resume submission (50 TAG Points)<br>
            c. Successfully joining the offered job. (1000 TAG Points)</p>
	    
	     <b>7. Points earned will be transferred to your TAG Account.</b> <p></p>
	     <b>8.  1 TAG point = INR 1 and 100 TAG points = INR 100 </b>
	    <p>You can redeem your points once you have a minimum 500 TAG points (has to  be 500, 1000, 1500 TAG points and so on for redeem). <br>Please send us an email to <a href="mailto:contact@thepridecircle.com">contact@thepridecircle.com</a> to redeem it. </p>
	    
	    <b>9. Pride Circle reserves exclusive rights to modify the program policies as and when required.</b> <p></p>
	    <b>10.How do I access TAG Platform?</b>
	    <p>You will be provided with a login ID and password to access TAG Platform.<br>
		<a href="https://www.thepridecircle.com/universe/referrer-registration-with-email/">https://www.thepridecircle.com/universe/referrer-registration-with-email/</a></p>

        <b>11.Where can I view my points summary?</b>
        <p>Points summary will be accessible via your TAG account/dashboard.</p>

        <b>12.How do I redeem points?</b>
        <p>Points can be redeemed against Amazon or  e-Marketplace on TAG platform.<br>You can redeem the vouchers in multiples of 500, example: 500, 1000, 1500 TAG points and so on for redeem).<br>Please send us an email to <a href="mailto:contact@thepridecircle.com">contact@thepridecircle.com</a> to redeem it. </p>

        <p></p>

        <p><b>Points to Note:</b></p>
        <p>1. More than 5 non LGBT+ referral then penalty.<br>2. Vouchers for Amazon or  e-Marketplace by Pride Circle.</p>

	</div>

	<?php
		if(isset($error_message)){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				alert("Something went wrong. Please try again.");
			})
		</script>
	<?php
		}
	?>

	<script type="text/javascript">

		$(document).ready(function(e){

// 			$('#submit').click(function(){

// 				var email = $('#email').val();
				
// 				var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;

// 					if (reg.test(email))
// 					{
// 						return 0;
// 						//$(this).closest('form').submit();
// 					}
// 					else
// 					{
// 					 	alert('Please Enter Business Email Address');
// 						console.log("Please Enter Business Email Address");
// 						return false;

// 					}

// 			});

		});

		// $(document).ready(function(){
		// 	$(".btn-submit").on('click', function(e){
		// 		e.preventDefault();
		// 		e.stopPropagation();

		// 		if ($(this).closest('form').find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
		// 			$(this).closest('form').addClass('was-validated');
		// 		}
		// 		else{
		// 			$(this).closest('form').submit();
		// 		}
		// 	})
		// });

		
	</script>
        <?php
			include 'includes/general_footer.php';
		?>
</body>
</html>