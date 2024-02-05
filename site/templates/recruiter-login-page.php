<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?=$page->title?></title>

	<!-- Custom fonts for this template -->
	<!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= $urls->httpTemplates;?>styles/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="<?= $urls->httpTemplates;?>styles/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
	<?php
		/* Error to show to the user in case of failed login */
		$error_to_show = "";

/* TODO Manage the logout */
		/* Check if GET has logout request */
		if($input->get('recruiter_logout', ["true"], false)){
			if($session->user_email == "" && $session->user_designation == ""){
				$session->redirect($pages->get("name=pc-recruiter")->httpUrl);
			}
			/**Save logout time in sub-recruiter page  */
			/**Save current timestamp in sub-recruiter page */
			$time_log_array=array();
			$session_id_array=array();
			$recruiter_page = $pages->get("id=".$session->user_page_id);
			// echo "***";
			// print_r($recruiter_page);
			// echo $recruiter_page->id;
			if($recruiter_page->time_logs!=""){
				// echo "11";
				$time_log_array=json_decode($recruiter_page->time_logs);
			}
			// print_r($time_log_array);
			// echo "12";
			if($recruiter_page->time_logs==""){
				// echo "13";
				$recruiter_page->time_logs="{}";
				$recruiter_page->session_id="{'time_logs_array':[]}";
				// echo "13.5";
			}
			$session_times_object=new stdClass();
			/**Current timestamp */
			$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
			if(!empty($time_log_array)){
				foreach($time_log_array as $single_time_log_array){
					foreach($single_time_log_array as $single_time_log){
						// Add the session ID to the session ID array
						$session_id_array[] = $single_time_log->session_id;
						// Check if the session ID matches the current session
						if($single_time_log->session_id == $session->session_id) {
							// Update the logout field if it's empty
							if (empty($single_time_log->logout)) {
									$single_time_log->logout = $current_timestamp;
							}
						}	 
						
					}

					
				}
			}
			
			// $time_log_array->time_logs[]=$single_time_log;
			// $recruiter_page->time_logs = json_encode($time_log_array);
			// Encode the time log array as JSON
			$recruiter_page->time_logs = json_encode($time_log_array);
			// echo "18";
			// echo $recruiter_page->time_logs;
			$recruiter_page->of(false);
			$recruiter_page->save();
		/* Empty the session variables */
			$session->user_email = "";
			$session->user_designation = "";
/* TODO remove the whole session */
		}

		/* Check if already logged in */
		if($session->user_designation == "recruiter"){
			/* Redirect to the recruiter dashboard */
			$session->redirect($pages->get("name=pc-recruiter")->httpUrl);
		}

		/* Check if login Email ID is submitted */
		if(isset($_POST['recruiter_email'])){
			/* Save posted values in variables. Sanitize email before saving. */
			$recruiter_email_to_verify = $input->post('recruiter_email', "email", false);
			$recruiter_password_to_verify = $input->post('recruiter_password');

			/* Check if both posted values are proper */
			if($recruiter_email_to_verify && $recruiter_password_to_verify){
				/* Find the recruiter profile with the same email and password */
				// $matching_recruiter_profile = $pages->get("name=recruiters")->child("email=".$sanitizer->selectorValue($recruiter_email_to_verify).",password=".$recruiter_password_to_verify);
				
				$matching_recruiter_profile_template = $pages->find("template=recruiter-profile,email=".$sanitizer->selectorValue($recruiter_email_to_verify).",password=".$recruiter_password_to_verify."");
				// print_r($matching_recruiter_profile_template) ;
				// echo "---";
				// echo $matching_recruiter_profile_template->id;
				$matching_recruiter_profile = $pages->get("id=".$matching_recruiter_profile_template);
				// echo $matching_recruiter_profile;
				// echo "****";
				
				// print_r($matching_recruiter_profile) ;
				if($matching_recruiter_profile->id != 0){
					/* Save Page ID of the logged in account to the session */
					$session->user_page_id = $matching_recruiter_profile->id;

					/* Save the email ID into the session */
				 	$session->user_email = $recruiter_email_to_verify;

				 	/* Specify that this ession belongs to an recruiter */
				 	$session->user_designation = "recruiter";
				 	
				    /* Save the company name into the session */
					if($matching_recruiter_profile->company_name!=""){
						$session->company_name = $matching_recruiter_profile->company_name;
					}

					$session->recruiter_profile_type=$matching_recruiter_profile->recruiter_profile_type;
					// echo $session->recruiter_profile_type;

					/**Generate session id & Save Session id in sub-recruiter page  */
					/**Save current timestamp in sub-recruiter page */
					$time_log_array=array();
					$session_id_array=array();
					$recruiter_page = $pages->get("id=".$matching_recruiter_profile->id);
					// echo "***";
					// print_r($recruiter_page);
					// echo $recruiter_page->id;
					if($recruiter_page->time_logs!=""){
						// echo "11";
						$time_log_array=json_decode($recruiter_page->time_logs);
					}
					
					// print_r($time_log_array);
					// echo "12";
					if($recruiter_page->time_logs==""){
						// echo "13";
						$recruiter_page->time_logs="{'time_logs_array':[]}";
						$recruiter_page->session_id="{'time_logs_array':[]}";
						$recruiter_page->time_logs="{}";
						// echo "13.5";
					}
					$session_id=$session->session_id;
					if(!empty($time_log_array)){
						foreach($time_log_array as $single_time_log_array){
							foreach($single_time_log_array as $single_time_log){
								$session_id_array[]=$single_time_log->session_id;
							}
						}
					}
					// echo "14";
					// echo "---";
					if(empty($session_id_array)){
						$session->session_id="1";
					}
					else{
						foreach($session_id_array as $single_session_id){
							// echo $single_session_id;
							$final_session_id=$single_session_id;
						}
						// echo $final_session_id;
						$session->session_id=$final_session_id+1;
						// echo "***";
						// echo $session->session_id;
					}
					// echo "///";
					$session_id=$session->session_id;
					// echo $session_id;
					// echo "+++";
					// echo "15";
					$session_times_object=new stdClass();
					// echo "16";
					/**Current timestamp */
					$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
					$session_times_object->session_id=$session_id;
					$session_times_object->login=$current_timestamp;
					$session_times_object->logout="";
					// $time_log_array->session_id=$session_id;
					// echo "17";
					// print_r($session_times_object);
					if($recruiter_page->time_logs==""){
						// echo "13";
						$recruiter_page->time_logs="{}";
						// echo "13.5";
					}
					$time_log_array->time_logs[]=$session_times_object;
					// $session_data[$session_id]=$session_times_object;
					$recruiter_page->time_logs = json_encode($time_log_array);
					// echo "18";
					// echo $recruiter_page->time_logs;
					$recruiter_page->of(false);
					$recruiter_page->save();
				  // echo "19";

				 	/* Redirect to the recruiter dashboard */
				 	$session->redirect($pages->get("name=pc-recruiter")->httpUrl);
				}
				else{
					/* Profile Has not been found. Error to show is changed */
					$error_to_show = "Login failed. Please try again.";
				}
			}
		}
	?>

	<style>
		.vertical-center{
			display: flex;
			/* align-items: center;
			justify-content: center; */
			/* height: 100vh; */
			margin-top:8rem ;
			margin:auto;
			
		}
		.form_container{
			margin: auto;
			width:22rem;
		}
		#recruiter_submit{
			width:20.8rem;
			background-color: #000033;
			border-color: #000033;
			height: calc(1.5em + .75rem + 2px);
		}
		.h1_text{
			font-weight:bold;
			color:#000;
		}
		.form_text_color{
			color:#000;
		}
		.login_img{
			height:100vh;
			object-fit: cover;
		}
		.login_container{
			overflow-x:hidden;
		}
		.login_form_input_text{
			width:20.7rem;
			border: 1px solid #000;
		}

		@media only screen and (max-width: 767px) {
			/* Styles for mobile devices */
			.vertical-center{
				display: flex;
			  align-items: center;
				justify-content: center; 
				/* height: 100vh; */
				margin-top:2rem ;
			}
			
			.h1_text{
				text-align:center;
			}
			.form_text_color{
				margin-left: 2.2rem;
			}
			.login_img {
				height: auto;
			}
			.login_form_input_text{
				width:19.7rem;
				border: 1px solid #000;
			}
			#recruiter_submit{
				width:19.8rem;
			}
			.form_submit_button_section{
				text-align:center;
			}
			.form_container{
				margin: auto;
				width: auto;
			}

		}

		@media only screen and (max-width: 415px) and (min-width: 380px) {
			/* Styles for mobile devices */
			.form_text_color{
				margin-left: 3.1rem;
			}
		}
		@media only screen and (max-width: 378px) and (min-width: 325px) {
			/* Styles for mobile devices */
			.form_text_color{
				margin-left: 1.8rem;
			}
		}
	
		@media only screen and (max-width: 324px) and (min-width: 318px) {
			/* Styles for mobile devices */
			.form_text_color{
				margin-left: 1.6rem;
			}
			.login_form_input_text{
				width:16.7rem;
				border: 1px solid #000;
			}
			#recruiter_submit{
				width:16.8rem;
			}
		}
		@media only screen and (max-width: 1024px) and (min-width: 768px) {
			/* Styles for mobile devices */
			.col-md-8{
				flex: 0 0 100% !important;
    		max-width: 100% !important;

			}
		}
		@media only screen and (max-width: 1125px) and (min-width: 1024px) {
			/* Styles for mobile devices */
			.col-md-8{
				flex: 0 0 100% !important;
    		max-width: 100% !important;

			}
		}
	</style>
	<div class="[ container-fluid pl-0 pr-0 ] login_container">
		
		<div class="[ row ]">
			<div class="[ col-12 col-sm-6 col-md-8 ][  ]">
			<div>
				<img src="<?=$page->banner_image->httpUrl?>" class="img-fluid w-100 login_img" alt="Login page">
			</div>
			</div>
			<div class="[ col-12 col-sm-6 col-md-4 ][ vertical-center ]">
				<div class="form_container">
					<h1 class="h1_text">Welcome to Recruiter Login!</h1>

					<?php
						if ($error_to_show){
					?>
						<span class="[ px-3 py-1 ][ bg-danger text-light rounded ]"><?=$error_to_show?></span>
					<?php
						}
					?>		

					<form class="[  ][  ][ rounded border-dark ]" action="<?=$page->url?>" method="POST" accept-charset="utf-8">
						<div class="[ form-group ] form_text_color">
							<label for="recruiter_email">Login ID</label>

							<input id="recruiter_email" class="form-control login_form_input_text" type="text" name="recruiter_email" placeholder="Login ID">
						</div>

						<div class="[ form-group ] form_text_color">
							<label for="recruiter_password">Password</label>

							<input id="recruiter_password" class="form-control login_form_input_text" type="password" name="recruiter_password" placeholder="Password">
						</div>

						<div class="[ form-group ][ form_submit_button_section ]">
							<input id="recruiter_submit" class="[ btn btn-lg btn-primary ][ px-5 mt-3 ]" type="submit" name="login" value="Login">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>