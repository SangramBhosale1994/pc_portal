<?php

include 'includes/send_mail_ticketing.php';
//require phpmailer/phpmailer;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

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
        
        $parent = $pages->get("name=seller");

		if($parent->children()->get("email=".$email.",otp_status=live,title=".$otp)){
			$p = $parent->children()->get("title=".$otp);
// 			$p->otp_status = "expired";
// 			$p->addStatus(Page::statusUnpublished);
            $created =$p->published;
            //echo $created;
           //$current = $p->wireDate('Y-m-d H:i:s');
            $current =time();
           //echo $current;
           // $difference = $current-$created;
            //$difference=500;
            //echo $difference;
			$p->of(false);
			$p->save();

			$session->oauth_gmail = $email;
			
		
			
// 			if($difference < 600 )
// 			{
			    header("Location: ".$config->urls->httpRoot."universe/seller-registration/");
// 			}
// 			else{
// 			   // echo "otp is expired";
// 			    $login_expired = true;
// 			}

			
		}
		else{
			$otp_wrong = true;
		}
	}
	else if($input->post->email){
	// 	///echo "1";
		$email = $sanitizer->email($input->post->email);
		
		$already_profile_page=$pages->get("name=universal-profiles")->child("email=".$email);
	//echo $already_profile_page->email;
		
		if($already_profile_page->id!=0){
			$already_profile_page=true;
		}
		elseif($already_profile_page->id==0){
		
    		$otp = mt_rand(100000,999999);
    		
    		$np = new Page();
    		$np->template = $templates->get("otp_verification");
    		$np->parent = $pages->get("name=seller");
    		$np->title = $otp;
    		$np->email = $email;
    		$np->otp_status = "live";
    		$np->of(false);
    		$np->save();
    		
    		$a =$pages->get("name=seller")->httpUrl."?otp=$otp&email=$email";
            
            $subject ="Activate your Pride Circle Universe Seller Account!";
            
            $message ="Greetings from Pride Circle!<br>Thank you for expressing interest to join the Pride Circle Universe.<br><br>Activate your account by clicking the link here<br><br> <a href='".$a."'><button id='btn_register' style='color: #fff;
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
			include 'includes/general_seller_header.php';
		?>

	<form action="<?=$config->urls->httpRoot?>universe/seller/" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ][ needs-validation ]" method="POST" novalidate>
		

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
			<h3>Welcome to Rainbow Bazaar's Seller Registration</h3>
		</div>
        <?php
			//if($login_expired){
		?>
        	<!--<div class="text-center mt-3">-->
        	<!--<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">Your login link has expired.</span>-->
	        <!--</div>-->

		<?php
			//} else
			if($already_profile_page){
		?>
			<div class="text-center mt-3">
        	<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">This email has already been used.</span>
	        </div>

		<?php
			}
		?>

		<div style="position: relative;" class="[ my-5 ][ form-group ]">
		
			<!--<label for="email">Please enter your Email ID<br><sub>(The email will get a verification link which will be valid for 10 minutes)</sub></label>-->
			<label for="email">Please enter your email ID to register</label>
			
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

		<div class="[  mb-1  ][ d-flex flex-row justify-content-center [ btn btn-sm btn-outline-light text-muted ]]">
			Already registered? 
			<a href="<?=$pages->get("name=universe")->httpUrl?>" class="" style="margin-left:3px;"> Login here</a>
		</div>
		<?php
				}
			?> 
	</form>

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
			include 'includes/general_seller_footer.php';
		?>
</body>
</html>