<?php

	// if($input->post->email){

	// 	$user_page = $pages->get("name=company-profiles")->child("email=".$input->post->email.",password=".$input->post->password);

	// 	if($user_page->id == 0){
	// 		$login_wrong = true;
	// 	}
	// 	else{
	// 		$session->email = $user_page->email;
	// 		$session->applicant_name = $user_page->applicant_name;
	// 		$session->company_name = $user_page->title;
	// 		$session->verification = $user_page->verification;
	// 	}
		
	// 	header("Location: ".$config->urls->httpRoot);
	// }



	if($input->post->otp){
		$email = $sanitizer->email($input->post->email);
		$otp = $sanitizer->text($input->post->otp);
		$password = $sanitizer->text($input->post->password);
		$otp_page=$page->child("email=".$email.",otp_status=live,title=".$otp);

		if($otp_page->id!=0){
			$p = $otp_page;
			$p->otp_status = "expired";
			$p->addStatus(\ProcessWire\Page::statusUnpublished);
			$p->of(false);
			$p->save();

			$company_page = $pages->get("name=universal-profiles")->child("email={$email}");
			
			if($company_page->id == 0){
				header("Location: ".$config->urls->httpRoot);
			}

			$company_page->of(false);
			$company_page->password = $password;
			$company_page->save();

			$session->email = $company_page->email;
			$session->applicant_name = $company_page->applicant_name;
			$session->company_name = $company_page->title;
			$session->verification = $company_page->verification;

			header("Location: ".$config->urls->httpRoot."universe/");
		}
		else{
			$otp_wrong = true;
		}
	}
	else if($input->post->email){
		$email = $sanitizer->email($input->post->email);
	
		$account_page = $pages->get("name=universal-profiles")->child("email={$email}");
	
		if($account_page->id!=0){
		    
		    	$otp = mt_rand(100000,999999);
        		//$otp = "111000";
        
        		$np = new \ProcessWire\Page();
        		$np->template = $templates->get("universal-forgot-password");
        		$np->parent = $pages->get("name=forgot-password");
        		$np->title = $otp;
        		$np->email = $email;
        		$np->otp_status = "live";
        		$np->save();
        		
        		$subject ="OTP from Pride Circle Universe account!";
                
                $message ="Greetings from Pride Circle!<br>The OTP for resetting your password is ".$otp."<br><br>From,<br>Team Pride Circle";
        
        	//	$subject = "OTP from Workplace Equality Index";
        		//$message = "Greetings!\n\nThe OTP for resetting your password is ".$otp;
        		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
        		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        		try {
        			mail($email, $subject, $message, $headers);
        		} catch (Exception $e) {
        			$error_message = true;
        		}
		
		}
		else{
		    	$account_not_exists=true;
		}

	
		//header("Location: ".$config->urls->httpRoot."universe/");
	}

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
			<h3>Reset Password</h3>
		</div>
	

		<?php
		    if(isset($account_not_exists)){
		?>
        	<div class="text-center mt-3">
        	<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">This email is not registered on Universe.</span>
	        </div>

		<?php
			}
		?>
		
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
				if(isset($email) && !isset($account_not_exists)){
			?>

			<input type="hidden" name="email" style="display: none;" value="<?=$email?>" hidden>
			<div class="[ my-5 ][ form-group ]">
				<label for="first_name">Please Enter the OTP <sub class="text-muted"> (Sent to <?=$email?>)</sub> </label>

				<input id="otp" class="form-control" type="password" pattern="[0-9]{6}" maxlength="6" name="otp" required>

				<div class="invalid-tooltip">
					Please provide a valid OTP.
				</div>
			</div>


			<div class="[ my-5 ][ form-group ]">
				<label for="password">Enter a New Password</label>
				<input id="password" class="form-control" pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$'  type="password" name="password" placeholder="" required>
				<sub class="text-muted"> (Password must have a capital letter, a small letter, a special character, a number and be minimum 8 characters long!)</sub>

				<div class="invalid-tooltip">
					Please provide a Password.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="confirm_password">Re-enter the Password</label>
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

			<?php
				}
				else{
			?>

			<label for="email">Please Enter Your Email</label>

			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>

			<?php
				}
			?>
		</div>

		<!-- Buttons Section -->
		<div class="[ d-flex flex-row justify-content-center mb-4 ]">
			<button id="submit" value="submit" class="[ px-4 ][ btn btn-primary ]( btn-submit )" type="submit">
					Submit
			</button>
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
			
				$(document).on("keyup","#password",  function(){
				if($(this).val() == $("#password").val()){
					$("#submit").prop("disabled", false);
					$("#no_match").prop("hidden", true);
				}
				else{
					$("#submit").prop("disabled", true);
					$("#no_match").prop("hidden", false);
				}
			});
			
				$(document).on("click","#submit",  function(){
				if($("#confirm_password").val() == $("#password").val()){
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
		})
	</script>
</body>
</html>