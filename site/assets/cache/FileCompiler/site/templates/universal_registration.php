<?php

	if($input->post->email){
		$name = $sanitizer->text($input->post->name);
		$email = $sanitizer->email($input->post->email);
		$phone_number = $sanitizer->text($input->post->phone_number);
		$company_name = $sanitizer->text($input->post->company_name);
		$designation = $sanitizer->text($input->post->designation);
		$password = $sanitizer->text($input->post->password);
		$industry = $sanitizer->text($input->post->industry);
		$employee_count = $sanitizer->text($input->post->employee_count);
		$company_open_participation = $sanitizer->text($input->post->company_open_participation);

		/*** Basic Page Creation Info */
		$new_profile_page = new Page();
		$new_profile_page->template = $templates->get("universal_profile");
		$new_profile_page->parent = $pages->get("name=universal-profiles");
		$new_profile_page->title = $name;
		/*** Basic Page Creation Info End */

		$new_profile_page->company_name = $company_name;
		$new_profile_page->email = $email;
		$new_profile_page->phone_number = $phone_number;
		$new_profile_page->designation = $designation;
		$new_profile_page->password = $password;
		$new_profile_page->industry = $industry;
		$new_profile_page->employee_count = $employee_count;
		$new_profile_page->user_type = "company_admin";
		$new_profile_page->verification = "unverified";
		$new_profile_page->company_open_participation = $company_open_participation;

		$new_profile_page->of(false);
		$new_profile_page->save();


		$new_company_page = new Page();
		$new_company_page->template = $templates->get("universal_companies");
		$new_company_page->parent = $pages->get("name=universal-companies");
		$new_company_page->title = $company_name;
		/*** Basic Page Creation Info End */

		$new_company_page->admin_email = $email;
		$new_company_page->industry = $industry;
		$new_company_page->employee_count = $employee_count;
		// $new_company_page->sub_users = $employee_count;


		$new_company_page->of(false);
		$new_company_page->save();

		$session->email = $email;
		$session->applicant_name = $name;
		$session->company_name = $company_name;
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
			<label for="company_name">Company Name</label>
			<input id="company_name" class="form-control" type="text" name="company_name" placeholder="Company Name" required>

			<div class="invalid-tooltip">
				Please provide a valid company name.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="company_name">Industry</label>

			<select class="form-control" name="industry" required>
				<option value="Aerospace">Aerospace</option>
				<option value="Agriculture, forestry and fishing">Agriculture, forestry and fishing</option>
				<option value="Biotechnology and Pharmaceuticals">Biotechnology and Pharmaceuticals</option>
				<option value="Construction, Infrastructure and Real Estate">Construction, Infrastructure and Real Estate</option>
				<option value="Education and Training">Education and Training</option>
				<option value="Electronics">Electronics</option>
				<option value="Financial Services and Insurance">Financial Services and Insurance</option>
				<option value="Health Care">Health Care</option>
				<option value="Hospitality">Hospitality</option>
				<option value="Industrial Services">Industrial Services</option>
				<option value="Information Technology">Information Technology</option>
				<option value="Manufacturing and Production">Manufacturing and Production</option>
				<option value="Media">Media</option>
				<option value="Mining and Quarrying">Mining and Quarrying</option>
				<option value="Non-profit and Charity Organisations">Non-profit and Charity Organisations</option>
				<option value="Professional Services">Professional Services</option>
				<option value="Retail">Retail</option>
				<option value="Social Services and Government Agencies">Social Services and Government Agencies</option>
				<option value="Telecommunications">Telecommunications</option>
				<option value="Trading">Trading</option>
				<option value="Transportation">Transportation</option>
				<option value="Other">Other</option>
			</select>

			<div class="invalid-tooltip">
				Please select an industry.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="company_name">Number of Employees</label>

			<select class="form-control" name="employee_count" required>
				<option value="Less than 50">Less than 50</option>
				<option value="50 - 99">50 - 99</option>
				<option value="100 - 500">100 - 500</option>
				<option value="501 - 4999">501 - 4999</option>
				<option value="5000 - 9999">5000 - 9999</option>
				<option value="10000 - 49,999">10000 - 49,999</option>
				<option value="50,000 &amp; above">50,000 &amp; above</option>
			</select>

			<div class="invalid-tooltip">
				Please select a range.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="designation">Designation</label>
			<input id="designation" class="form-control" type="text" name="designation" placeholder="Designation" required>

			<div class="invalid-tooltip">
				Please provide a valid designation.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label>We would like the company's name published in the IWEI Report and other collaterals as a "participating organization".</label>

			<label><input type="radio" id="company_open_participation_yes" name="company_open_participation" value="Yes" required> Yes (Open Participation)</label>
			<label><input type="radio" id="company_open_participation_no" name="company_open_participation" value="No"> No (Anonymous Participation)</label>
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

		<div class="[  mb-1  ][ d-flex flex-row justify-content-center ]">
			<a href="<?=$pages->get("name=universal-login")->httpUrl?>" class="[ btn btn-sm btn-outline-light text-muted ]">Login Here</a>
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