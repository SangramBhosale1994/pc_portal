<?php

	if($input->post->email){
		$name = $sanitizer->text($input->post->name);
		$email = $sanitizer->email($input->post->email);
		$phone_number = $sanitizer->text($input->post->phone_number);
		$company_name = $sanitizer->text($input->post->company_name);
		$password = $sanitizer->text($input->post->password);

		/*** Basic Page Creation Info */
		$new_profile_page = new Page();
		$new_profile_page->template = $templates->get("universal_profile");
		$new_profile_page->parent = $pages->get("name=universal-profiles");
		$new_profile_page->title = $name;
		/*** Basic Page Creation Info End */

		$new_profile_page->company_name = $company_name;
		$new_profile_page->email = $email;
		$new_profile_page->phone_number = $phone_number;
        $new_profile_page->password = $password;
        $new_profile_page->user_type = "company_subuser";
		$new_profile_page->verification = "unverified";

		$new_profile_page->of(false);
		$new_profile_page->save();


		$session->email = $email;
		$session->title = $name;
		// $session->company_name = $company_name;
		$session->verification = "unverified";

		header("Location: ".$config->urls->httpRoot."universal-privacy-statement/");
	}

	// if($input->post->email){
	// 	$email = $sanitizer->email($input->post->email);

	// 	$otp = mt_rand(100000,999999);

	// 	$np = new Page();
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
			include 'includes/general_header.php';
		?>
	<form action="" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ]" method="POST">
		<div class="[ my-4 ][ text-center ]">
			<h3>Registration</h3>
			<p>(All fields are mandatory)</p>
		</div>



		<div class="[ my-5 ][ form-group ]">
			<label for="name">Name</label>
			<input id="name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="name" placeholder="Your Name" required>

			<div class="invalid-tooltip">
				Please provide a valid name.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="email">Email</label>
			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$session->oauth_gmail;?>" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="phone_number">Phone Number</label>

			<input id="phone_number" class="[ form-control ]" pattern="[0-9]{10}" type="text" name="phone_number" placeholder="Example: 9876543210" maxlength="10" required>

			<div class="invalid-tooltip">
				Please provide a valid phone number.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="password">Password</label>
			<input id="password" class="form-control" type="password" name="password" placeholder="" required>

			<div class="invalid-tooltip">
				Please provide a Password.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="confirm_password">Confirm Password</label>
			<input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="" required>

			<div class="invalid-tooltip">
				Please retype the password.
			</div>

			<div  class="[ text-danger ]" style="height: 1.3rem" >
				<div id="no_match" hidden="true">
					Passwords do not match.
				</div>
			</div>
		</div>

		<!-- Buttons Section -->
		<div class="[  mb-4  ][ d-flex flex-row justify-content-center ]">
			<button value="submit" id="submit" class="[ px-5 ][ btn btn-primary ]( btn-submit )" type="submit">
					Register
			</button>
		</div>
 
		<!--<div class="[  mb-1  ][ d-flex flex-row justify-content-center ]">
			<a href="<?=$pages->get("name=universal-login")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]">Login Here</a>
		</div> -->
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
		
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("keyup","#confirm_password",  function(){
				if($(this).val() == $("#password").val()){
					$("#submit").prop("disabled", false);
					$("#no_match").prop("hidden", true);
				}
				else{
					$("#submit").prop("disabled", true);
					$("#no_match").prop("hidden", false);
				}
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
		});

	// 	$(document).ready(function(){
    // 		$(document).on("keyup","#email",  function(){
    // 			return (/^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!outlook\.com)([\w-]+.)+[\w-]{2,4})?$/);
    // 			 message: 'Please enter your work email address';
	// 	})
	// });

	
				
	</script>
	<?php
	require $config->paths->templates.'includes/sticky-footer.php';
	?>
</body>
</html>