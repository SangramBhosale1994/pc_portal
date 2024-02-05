<?php
echo $session->hackps;
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }
	//if($input->get->referrer_code){
	//if(isset($_GET['referrer_code'])){

		

/* TODO Manage the logout */
		/* Check if GET has logout request */
		if($input->get('candidate_logout', ["true"], false)){
			/* Empty the session variables */
			// $session->user_email = "";
			$session->logout(); 
/* TODO remove the whole session */
		}
	
	/* Check if the referrer code is present in the URL. (in a GET parameter) */
	if($input->get->referrer_code){
//echo "-----------------------";
        /* Setting cookie : Save the referrer code into a cookie. (Later, this cookie will be used when the candidate's profile is being saved. The referrer code will be saved with the profile.)  */
	    $referrer_code_url=$input->get->referrer_code;
	    $cookie_name = "referrer_code";
        $cookie_value = "$referrer_code_url";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        /* Setting cookie END */
        
/* testing code for checking if the cookie is set */  
// if(!isset($_COOKIE[$cookie_name])) {
//      echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
//      echo "Cookie '" . $cookie_name . "' is set!<br>";
//      echo "Value is: " . $_COOKIE[$cookie_name];
// }
/* testing code for checking if the cookie is set END*/ 
	}
	/* Check if the OTP form is filled and submitted */
	elseif($input->post->otp){
		$email = $sanitizer->email($input->post->email);
		$otp = $sanitizer->text($input->post->otp);

//         $email ="test@gmail.com";
// 		$otp = "0000";
//header("Location: ".$config->urls->httpRoot."resume/form/");
		if($page->children()->get("email=".$email.",otp_status=live,title=".$otp)){
			$p = $page->children()->get("title=".$otp);
			$p->otp_status = "expired";
			$p->addStatus(\ProcessWire\Page::statusUnpublished);
			$p->of(false);
			$p->save();

			$session->oauth_gmail = $email;

			header("Location: ".$config->urls->httpRoot."resume/form/");
		}
		else{
			$otp_wrong = true;
		}
	}
	/* Check if the email form is filled and submitted */
	else if($input->post->email){
		if($input->post->id_check!=""){
			header("location:".$pages->get("name=login-with-email")->httpUrl);
			exit();
		}
		else{
			$email = $sanitizer->email($input->post->email);

			$otp = mt_rand(100000,999999);

			$np = new \ProcessWire\Page();
			$np->template = $templates->get("otp_verification");
			$np->parent = $pages->get("name=login-with-email");
			$np->title = $otp;
			$np->email = $email;
			$np->otp_status = "live";
			$np->save();

			$subject = "OTP from Pride Circle";
			$message = "Greetings from Pride Circle!\n\nThe OTP for your login is ".$otp;
			$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

			try {
				send_smtp_mail($email, $message , $subject);
			} catch (Exception $e) {
				$error_message = true;
			}
		}
	}


	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<!-- <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script> -->
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->

	<title>Login | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page Specific Style CSS -->
	<link href="<?= $rootpath;?>styles/login-with-email.css" rel="stylesheet" type="text/css">
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Popper Js -->
	<script src="<?= $rootpath;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<!-- ---------- JS LINKS END ---------- -->
	<style>
	<?php
		if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
		?>
			.header_menu_banner{
				/* margin-top:3.9rem; */
				margin-top:4.3rem;
			}
			@media (max-width:768px){
				.header_menu_banner{
					margin-top:4.9rem;
				}
			}
		<?php
			}
		?>
	</style>
	</head>
<body>
	<?php
 require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	?>
	<div id="top-container" class="header_menu_banner">
		<!-- <img src="<?=$rootpath;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$rootpath;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

		<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[ w-100 img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[ w-100 img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<form action="<?=$config->urls->httpRoot?>resume/login-with-email/" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ][ needs-validation ]" method="POST" novalidate>
		<div class="[ my-2 ][ text-center ]">
			<h3>Login With Email</h3>
		</div>

		<?php
			if(isset($otp_wrong)){
		?>

		<div class="[ my-3 ][ text-center text-danger ]">
			Incorrect OTP. Please try again.
		</div>

		<?php
			}
		?>

		<div style="position: relative;" class="[ my-5 ][ form-group ]">
			<?php
				if(isset($email)){
			?>

			<input type="hidden" name="email" style="display: none;" value="<?=$email?>" hidden>

			<label for="first_name">Please Enter The OTP <sub class="text-muted"> (Sent to <?=$email?>)</sub> </label>

			<input id="otp" class="form-control" type="text" pattern="[0-9]{6}" maxlength="6" name="otp" required>

			<div class="invalid-tooltip">
				Please provide a valid OTP.
			</div>

			<?php
				}
				else{
			?>

			<label for="email">Please Enter Your Email</label>

			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>

			<div class="id_check_section d-none">
    			<label for="id_check">ID</label>
    
    			<input id="id_check" class="form-control" type="text" name="id_check" >
			</div>

			<?php
				}
			?>
		</div>

		<!-- Buttons Section -->
		<div class="[ d-flex flex-row justify-content-end mb-4 ]">
			<button value="submit" id="education-next" class="[ btn btn-primary ]( btn-submit )" type="submit">
					Submit
			</button>
		</div>
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
		$(document).ready(function(){
			$(".btn-submit").on('click', function(e){
				e.preventDefault();
				e.stopPropagation();

				if ($(this).closest('form').find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
					$(this).closest('form').addClass('was-validated');
				}
				else{
					$(this).closest('form').submit();
				}
			})
		})
	</script>
<script src="<?= $rootpath;?>scripts/tweetjs.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$(document).on("click", "#navbarNav .nav-link", function(){
			if(!$("#navbar-toggler").hasClass("collapsed")){
				$("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
			}
		})

	})
</script>
</body>
</html>