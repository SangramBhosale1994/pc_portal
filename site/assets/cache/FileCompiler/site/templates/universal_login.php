<?php
//  echo "abc";
//  die;

/* TODO Manage the logout */
		/* Check if GET has logout request */
		if($input->get('universal_logout', ["true"], false)){
			/* Empty the session variables */
			// $session->user_email = "";
			$session->logout(); 
/* TODO remove the whole session */
		}
		
	if($input->post->email){
       //echo"11";
		$user_page = $pages->get("name=universal-profiles")->child("email=".$input->post->email);
		//print_r($user_page);

		if($user_page->id == 0 || $user_page->password!=$input->post->password){
			$login_wrong = true;
		}
		else{
			$session->email = $user_page->email;
			$session->name = $user_page->title;
			$session->company_name = $user_page->company_name;
			$session->verification = $user_page->verification;
			$session->user_type = $user_page->user_type;
			//echo $session->user_type;
			header("Location: ".$config->urls->httpRoot."universe/universal-user-dashboard");
			
			if($session->user_type=='company_referrer')
			{
			    header("Location: ".$config->urls->httpRoot."universe/referral-dashboard");
			}
			if($session->user_type=='company_seller')
			{
			    header("Location: ".$config->urls->httpRoot."universe/seller-dashboard");
			}
		}
		
		
	}

	// if($input->post->email){
	// 	$email = $sanitizer->email($input->post->email);

	// 	$otp = mt_rand(100000,999999);

	// 	$np = new \ProcessWire\Page();
	// 	$np->template = $templates->get("otp_verification");
	// 	$np->parent = $pages->get("name=login-with-email");
	// 	$np->title = $otp;
	// 	$np->email = $email;
	// 	$np->otp_status = "live";
	// 	$np->save();

	// 	$subject = "OTP from Pride Circle";
	// 	$message = "Greetings from Pride Circle!\n\nThe OTP for your login is ".$otp;
	// 	$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

	// 	try {
	// 		mail($email, $subject, $message, $headers);
	// 	} catch (Exception $e) {
	// 		$error_message = true;
	// 	}
	// }

	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<?php
 include(\ProcessWire\wire('files')->compile('includes/general_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	?>

	<form action="" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ]" method="POST">
		<div class="[ my-4 ][ text-center ]">
			<h3>Login</h3>
			<!-- <b>Access to Pride Circle Universe is open to company HR, D&I, Pride ERG Leaders and Executive Sponsor only</b> -->
		</div>


		<div class="[ my-5 ][ form-group ]">
			<label for="email">Email</label>
			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="Your Email" value="<?=$session->oauth_gmail;?>" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="password">Password</label>
			<input id="password" class="form-control" type="password" name="password"  placeholder="Your Password" required>

			<div class="invalid-tooltip">
				Please provide a Password.
			</div>
		</div>

		<?php
			if(isset($login_wrong)){
		?>

		<div class="[ my-3 ][ text-center text-danger ]">
			Login information incorrect. Please try again.
		</div>

		<?php
			}
		?>

		<!-- Buttons Section -->
		<div class="[  mb-1  ][ d-flex flex-row justify-content-center ]">
			<button value="submit" id="submit" class="[ px-5 ][ btn btn-primary ]( btn-submit )" type="submit">
					Login
			</button>
		</div>
		<div class="[  mb-4  ][ d-flex flex-row justify-content-center ]">
			<a class="[ text-info ]" style="font-size: 0.8rem" href="<?=$pages->get("name=forgot-password")->httpUrl?>">Forgot Password?</a>
		</div> 

		<div class="[  mb-1  ][ d-flex flex-row justify-content-between ]">
			<a href="<?=$pages->get("name=company-registration-with-email")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]" style="border:none;">Register as a company</a>
			
			<a href="<?=$pages->get("name=seller")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]" style="border:none;">Register to sell on the Rainbow Bazaar</a>

			<a href="<?=$pages->get("name=referrer-registration-with-email")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]" style="border:none;">Register for TAG</a>
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
	
	<script src="<?= $rootpath;?>scripts/jquery-3.4.1.min.js"></script>
	<!-- <script src="<?= $rootpath;?>scripts/popper.min.js"></script> -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
	<script src="<?= $rootpath;?>scripts/script.js?v=<?=mt_rand(0,999)?>"></script>
		
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("keypress","#confirm_password",  function(){
				// if($(this).val() == $("#password").val()){
				// 	$("#submit").prop("disabled", false);
				// }
				// else{
				// 	$("#submit").prop("disabled", true);
				// }
			})


			/*$(".btn-submit").on('click', function(e){
				e.preventDefault();
				e.stopPropagation();

				if ($(this).closest('form').find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
					$(this).closest('form').addClass('was-validated');
				}
				else{
					$(this).closest('form').submit();
				}
			})*/
		})
	</script>

	
	<?php
 include(\ProcessWire\wire('files')->compile('includes/general_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		?>
</body>
</html>