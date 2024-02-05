<?php
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }


	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<?php
			include 'includes/general_header.php';
		?>

	<form id="main-container" action="<?=$config->urls->httpRoot?>sub-users-registration-with-otp/"  class="[ my-5 px-sm-5 ][ container rounded ][ needs-validation ]" method="POST" novalidate>
		<div class="[ my-2 ][ text-center ]">
			<h3>Registration With Email</h3>
		</div>

		<!-- <?php
			if(isset($otp_wrong)){
		?>

		<div class="[ my-3 ][ text-center text-danger ]">
			Incorrect OTP. Please try again.
		</div>

		<?php
			}
		?> -->

		<div style="position: relative;" class="[ my-5 ][ form-group ]">
			<!-- <?php
				if(isset($email)){
			?>

			<input type="hidden" name="email" style="display: none;" value="<?=$email?>" hidden>

			<label for="first_name">Please Enter The OTP <sub class="text-muted"> (Sent to <?=$email?>)</sub> </label>

			<input id="otp" class="form-control" type="password" pattern="[0-9]{6}" maxlength="6" name="otp" required>

			<div class="invalid-tooltip">
				Please provide a valid OTP.
			</div>

			<?php
				}
				else{
			?> -->

			<label for="email">Please Enter Your Email</label>

			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>
<!-- 
			<?php
				}
			?> -->
		</div>

		<!-- Buttons Section -->
		<div class="[ d-flex flex-row justify-content-end mb-4 ]">
			<button value="submit" id="submit" class="[ btn btn-primary ]( btn-submit )" type="submit">
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

		// $(document).ready(function(e){

		// 	$('#submit').click(function(){

		// 		var email = $('#email').val();
				
		// 		var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;

		// 			if (reg.test(email))
		// 			{
		// 				return 0;
		// 				//$(this).closest('form').submit();
		// 			}
		// 			else
		// 			{
		// 			 	alert('Please Enter Business Email Address');
		// 				console.log("Please Enter Business Email Address");
		// 				return false;

		// 			}

		// 	});

		// });

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

</body>
</html>