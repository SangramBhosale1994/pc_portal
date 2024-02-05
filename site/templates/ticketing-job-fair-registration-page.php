<?php
	$rootpath = $config->urls->templates;
	$already_profile_page=false;

	/* Removing this if for ticketing closing */
	if (isset($_POST['add_ticket_submit'])) {
	// if (false) {
    	$candidate_job_fair = new stdClass;
// echo "<br>==1==<br>"; 
    include 'includes/send_mail_ticketing.php';
		$candidate_job_fair->first_name = $input->post->text('first_name');
		$candidate_job_fair->last_name = $input->post->text('last_name');
		// $candidate_job_fair->pronoun = $input->post->text('pronoun');
		$candidate_job_fair->pronoun =$sanitizer->text(($input->post->pronoun == 'other')?$input->post->pronoun_custom : $input->post->pronoun);
		$candidate_job_fair->pronoun=$input->post->text('pronoun');
		$candidate_job_fair->phone_number = $input->post->text('phone_number');
		$candidate_job_fair->phone_country_code = $input->post->text('phone_country_code');
		// $candidate_job_fair->confirm_phone_number = $input->post->text('confirm_phone_number');
		//$candidate_job_fair->company_name = $input->post->text('company_name');
		$candidate_job_fair->email = $input->post->text('email');
		$candidate_job_fair->page_id = $input->post->text('page_id');
		$compare_phone_number_flag=true;
		// if($candidate_job_fair->phone_number==$candidate_job_fair->confirm_phone_number){
		//     $compare_phone_number_flag=true;
		// }
// echo "<br>==2==<br>"; 
		if($compare_phone_number_flag){
// echo "<br>==3==<br>"; 
		    $check_in_back_end=false;
		    if(!$check_in_back_end){
// echo "<br>==4==<br>"; 
		        $single_applicant=new page();
		        $single_applicant->template='pass-applicants';
				$single_applicant->parent = $pages->get("name=pass-applicants");
		        $single_applicant->title = $candidate_job_fair->first_name." ".$candidate_job_fair->last_name;
		        $single_applicant->first_name = $candidate_job_fair->first_name;
		        $single_applicant->last_name = $candidate_job_fair->last_name;
		        $single_applicant->pronoun = $candidate_job_fair->pronoun;
		        $single_applicant->email = $candidate_job_fair->email;
		        $single_applicant->phone_country_code = $candidate_job_fair->phone_country_code;
		        //$single_applicant->company_name = $candidate_job_fair->company_name;
		        $single_applicant->phone_number = $candidate_job_fair->phone_number;
		        $single_applicant->pass_verification = '';
				$single_applicant->candidate_profile_id = $candidate_job_fair->page_id;

				/*Code by Amruta Jagtap phone number and profile id is already exists*/
				
				//echo $session->oauth_gmail;
				$candidate_page = $pages->get('name=candidates')->child("oauth_gmail=".$session->oauth_gmail);
				//echo $candidate_page->id;
				$already_profile_page_phone_number=$pages->get("name=pass-applicants")->child("phone_number=".$single_applicant->phone_number);
				
				$already_profile_page_candidate=$pages->get("name=pass-applicants")->child("candidate_profile_id=".$candidate_page->id);
				
				
				// echo "---------------";
				// echo $already_profile_page_phone_number->id; 
				
				// echo "////////////////";
				// echo $already_profile_page_candidate->id; 
				
				if($already_profile_page_phone_number->id!=0){
				    $already_profile_page=true;
// echo "<br>==5==<br>"; 
				}
				elseif($already_profile_page_candidate->id!=0){
				    $already_profile_page=true;
// echo "<br>==6==<br>"; 
				}
				else{
// echo "<br>==8==<br>";
					$single_applicant->of(false);
			    	$single_applicant->save();
				}
// echo "<br>==7==<br>"; 	
			   /*End Code by Amruta Jagtap*/ 
				// $single_applicant->of(false);
			  //   $single_applicant->save();
			    
			    
			    $mail_subject="RISE JOB FAIR 2023 | EVENT PASSES";
	    		
				$mail_message="Dear ".$single_applicant->first_name.",";
	    		$mail_message.="<br><br>";
	    		$mail_message.="Thank you for uploading your resume on Pride Circle's Resume portal!";
	    		$mail_message.="<br><br>";
	    		$mail_message.="We will require 48 hours to verify your profile and complete your registration for the 5th edition of RISE Job Fair 2023.";
	    		$mail_message.="<br><br>";
	    		$mail_message.="<b>Please Note</b>: All fields must have details entered correctly, or the links to the event passes will not reach you.";
	    		$mail_message.="<br><br>";
	    		$mail_message.="In case of any questions or entry correction requests, please drop us a mail at <b>rise@thepridecircle.com</b> before 20th April 2023, explaining the query along with your details and ticket ID.";
	    		$mail_message.="<br><br>";
	    		
	    		try {
        			send_smtp_mail($candidate_job_fair->email,$mail_message,$mail_subject);
        		} catch (Exception $e) {
                    print_r($e);
        		}


					/** Amruta Jagatap 2021-03-24 when candidate already verify by lgbt+ verification and apply to job fair. so this candidate verified thr pass verification and send mail to candidate*/
        		
					$candidate_page=wire("pages")->get("name=candidates")->child("id=".$candidate_job_fair->page_id);
        		
					if($candidate_page->lgbtq_verification=="Confirmed"){

					 /* pass applicants save pass verification verified and send mail*/
						
						$job_fair_page = wire("pages")->get("name=pass-applicants")->child("candidate_profile_id=".$candidate_page->id);
						// $data_to_return->job_page=true;
						// $data_to_return->job_page[] = $job_fair_page;
						// 			echo "------------------------";
						// 			echo $job_fair_page->id;
			
						/* If editor not found, return */
						if($job_fair_page->id != 0){
								// $job_fair_page->pass_verification = "verified";
								
								/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
								/**** Get serial ID from the serial ID page */
								$pass_applicants_counter_page = wire('pages')->get("name=pass-applicants-counter-page");
								/**** Assign the given ID to the  new page and increment the number for the next page */
								$job_fair_page->serial_id = $pass_applicants_counter_page->serial_id++;
								//echo"5";
								/**** save the incremented ID page */
								$pass_applicants_counter_page-> of(false);
								$pass_applicants_counter_page->save();
								/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */
						
						
						
								/* save the page */
								$job_fair_page->of(false);
								$job_fair_page->save();
								
								$event_name = "RISE JOB FAIR TICKET";
								$pass_number=$job_fair_page->serial_id;
								$applicants_name=$job_fair_page->title;
								$applicants_email=$job_fair_page->email;
								$applicants_contact=$job_fair_page->phone_country_code."".$job_fair_page->phone_number;
								
								$applicants_subject="RISE JOB FAIR 2023 | EVENT PASSES";
						
								$applicants_message ="Dear {$applicants_name},";
								
								$applicants_message .="<br><br>";
								$applicants_message .="You have successfully registered for India's Premier LGBT+ Job Fair - RISE 2023!";
								$applicants_message .="<br>";
								$applicants_message .="Your event pass details:";
								$applicants_message .="<br><br>";
						
								$applicants_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
								$applicants_message .="    <tr>";
								$applicants_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
								$applicants_message .="            <b>{$event_name}</b>";
								$applicants_message .="        </td>";
								$applicants_message .="    </tr>";
								$applicants_message .="</table>";
						
								$applicants_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
								$applicants_message .="    <tr style='padding:10px;' >";
								$applicants_message .="        <td style='text-align:left; padding:15px;'>";
								$applicants_message .="            <b>Ticket ID</b>: {$pass_number}</b>";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Name</b>: {$applicants_name}";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Contact Number</b>: {$applicants_contact}";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Email ID</b>: {$applicants_email}";
								$applicants_message .="        </td>";
								$applicants_message .="    </tr>";
								$applicants_message .="</table>";

								$applicants_message .="<br><br>";
								$applicants_message .="We will email you the event link closer to the event date to be able to access the virtual platform on 30th April, 2023 and meet some of the top inclusive organizations from across the country.";
								$applicants_message .="<br>";
								$applicants_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you.";
								$applicants_message .="<br><br>";
								$applicants_message .="In case of any questions or entry correction requests, please drop us a mail at rise@thepridecircle.com before 10th April 2023, explaining the query along with your details and ticket ID. In case of any payment queries on accounts@thepridecircle.com";
								$applicants_message .="<br>";
								
								try {
									// send_smtp_mail($job_fair_page->email,$applicants_message,$applicants_subject);
								} catch (Exception $e) {
										print_r($e);
								}
					}



}
					
				
                 /* echo $pages->get("name=cart")->httpUrl;*/
									// if($already_profile_page){
									// 	$already_profile_page=1;
									// }else{





					/*if($already_profile_page!=true){
						header("Location:".$pages->get("name=job-fair-thank-you")->httpUrl);
					}*/




			header("Location:".$pages->get("name=job-fair-thank-you")->httpUrl);
				/** Amruta Jagatap 2021-03-24 End Code */
		    }
		}
	}
/*
	File created 2021-03-07
	Primary code by Amrut Todkar

	This page will be the common header for the ticketng platform.

*/
	/* Check if the page is called with HTTPS. if not, redirect it to HTTPS  */
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	{
		//Tell the browser to redirect to the HTTPS URL.
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
		//Prevent the rest of the script from executing.
		exit;
	}

	/* Check if the session already has other tickets added. */
	// if (!$session->tickets_json) {
		/* If the tickets json does not exist, create it. Make it an object with a tickets array in it.  */
	// 	$session->tickets_json = '{}';
	// }
	// $count=0;$total=0;
	// foreach (json_decode($session->tickets_json) as $single_ticket) {
	// 	$total += $single_ticket->price;
	//     $count++;    
	// }
//print_r($session->tickets_json);

/* Code to delete all the ticekts from the session. Keep commented. use only when debugging and you need to emty the tickets in the session. */
//$session->remove('tickets_json');
	/* Check if the session already has other tickets added. END */
?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>-->

<!--	<script>-->
<!--		window.dataLayer = window.dataLayer || [];-->
<!--		function gtag(){dataLayer.push(arguments);}-->
<!--		gtag('js', new Date());-->

<!--		gtag('config', 'UA-155220702-1');-->
<!--	</script>-->

<!--	<script>-->
		<!--//let website_rootpath = '<?=$config->urls->httpRoot?>resume/';-->
<!--	</script>-->

	<!-- Global site tag (gtag.js) - Google Analytics End -->


<!--	<title>Application Form | Pride Circle</title>-->

<!--	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>-->

<!--	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />-->

	<!-- ---------- META TAGS ---------- -->
<!--	<meta charset="utf-8">-->
<!--	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
<!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
<!--	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">-->
	<!-- Universal Style CSS -->
	<!--<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">-->
	<!-- Page-Specific Style CSS -->
<!--	<link href="<?= $rootpath;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">-->
	
<!--	<link rel="stylesheet" href="<?= $rootpath;?>styles/fm.tagator.jquery.css">-->
	
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />-->
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
<!--	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>-->
	<!-- Popper Js -->
<!--	<script src="<?= $rootpath;?>scripts/popper.min.js" type="text/javascript"></script>-->
	<!-- Bootstrap Js -->
<!--	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript"></script>-->
	<!-- Fontawesome JS -->
<!--	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>-->
	
<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>-->
	<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
<!--	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>-->
	<!--<script src="https://cdn.jsdelivr.net/npm/@firstandthird/tokens@latest/dist/tokens.bundle.js"></script>-->
	<!-- ---------- JS LINKS END ---------- -->
<!--</head>-->


<!--===-->


<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-155220702-1');
		</script> -->

		<!-- Global site tag (gtag.js) - Google Analytics End -->

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-208516648-2%22%3E"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
		</script>

		<title>Job Fair Registration | Pride Circle</title>

		<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

		<!-- ---------- META TAGS ---------- -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- ---------- META TAGS END ---------- -->
          
	    <!-- ---------- META TAGS ---------- -->
		<meta property="og:title" content="<?=$page->title;?>">
	    <meta property="og:image" content='<?=$pages->get('name=rise2023-header')->general_image->httpUrl;?>'>
	    <meta property="og:description" content="<?=$pages->get('name=rise2023-header')->og_description?>">
	    <meta property="og:url" content="<?= $page->httpUrl ?>">
	    <meta property="og:type" content="article" />

	    <meta name="twitter:title" content='<?=$page->title;?>'>
	    <meta name="twitter:description" content="<?=$pages->get('name=rise2023-header')->og_description?>">
	    <meta name="twitter:image" content='<?=$pages->get('name=rise2023-header')->general_image->httpUrl;?>'>
	    <meta name="twitter:card" content="<?=$page->title;?>">

	    <meta property="og:site_name" content="<?=$page->title;?>">
	    <meta name="twitter:image:alt" content="<?=$page->title;?>">
		<!-- ---------- META TAGS END ---------- -->



        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        
		<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

		<!-- ---------- CSS LINKS ---------- -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css?v=15.02">
		<!-- Universal Style CSS -->
		<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">
		<!-- Page Specific Style CSS -->
		<!--<link href="<?= $rootpath;?>styles/login-with-email.css" rel="stylesheet" type="text/css">-->

			<!-- Universal Style CSS -->
		<link href="<?= $rootpath;?>styles/style.css?v=03-17" rel="stylesheet" type="text/css">
		<!-- Page Specific Style CSS -->
		<link rel="stylesheet" href="<?= $rootpath;?>styles/<?=$page->template;?>.css"/>
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
		
	.invalid-tooltip 
	{
        
	}
	</style>    
		
	</head>
	<body>
		<div id="top-container">
			<!-- <img src="<?=$rootpath;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

			<img src="<?=$rootpath;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

			<img src="<?=$rootpath;?>images/pc_job_fair_web.png" class="[ img-fluid mb-3 w-100 ]( mobile-hide )" alt="Pride Circle Banner Image">

			<img src="<?=$rootpath;?>images/pc_job_fair_mob.png" class="[ img-fluid w-100 ]( mobile-show )" alt="Pride Circle Banner Image">
		</div>
		<div>


        <div style="margin-bottom:2rem;">
           <h2 class="text-center" style="font-family: 'Montserrat', sans-serif;font-weight:700; font-size:2.5rem; "> 
           <?=$page->title?>
           </h2>
        </div>
        
  <!--      <div class="container alert alert-success text-center" style="margin-top:2rem;" role="alert">-->
	 <!--   <h4><i class="fa fa-check" aria-hidden="true"></i>  -->
		<!--        Successfull.!</h4>-->
  <!--  	</div>-->
  <!--  	<div class="container alert alert-danger text-center" style="margin-top:2rem;"  role="alert">-->
		<!--	<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Retry</h4>-->
			
		<!--</div>-->
    	
    <!--		<div class="container" style="margin-top:2rem;">-->
				<!--	<?=$page->ticketing_job_fair_description?>-->
				<!--</div>-->
    	
        
		<?php
			/* Removed for ticketing closing */
			// echo "11";
			// echo $session->oauth_gmail;
			// $session->oauth_gmail="hemlatak.zerovaega@gmail.com";
			// echo $pages->get("name=pass-applicants")->child("email=".$session->oauth_gmail)->id;
			// echo "----";
			if($session->oauth_gmail == ""){
			// if(true){
				// echo "12";
				// echo $session->oauth_gmail;
		?>
			<div class="[ container ]" style="min-height: 300px">
				<div class="text-center">
					<?=$page->ticketing_job_fair_description?>
				</div>
			
				<!-- Removed for ticketing closing -->
				<div  class="[ text-center ]">
					<a href='<?=$pages->get("name=resume")->httpUrl?>' class="text-center" style="align-items:center;">
					    <button type="button" class="btn btn-primary text-center">Upload Your Resume</button>
				    </a>
				</div>
			</div>
		
		<?php				
			}elseif($pages->get("name=pass-applicants")->child("email=".$session->oauth_gmail)->id!=0){
				// echo $pages->get("name=pass-applicants")->child("email=".$session->oauth_gmail)->id;
				header("Location:".$pages->get("name=job-fair-thank-you")->httpUrl);
				//die();

			}
			else{
			    /* Get candidate info */
				$candidate_page = $pages->get('name=candidates')->child("oauth_gmail=".$session->oauth_gmail);
				// echo $candidate_page->id;
				if($candidate_page->id != 0){
					$candidate_name = $candidate_page->first_name;
					$candididate_name_array=explode(' ', $candidate_name, 2);
					if(count($candididate_name_array)==2){
    					$candidate_first_name=$candididate_name_array[0];
    					$candidate_last_name=$candididate_name_array[1];
					}
					else{//$candidate_last_name = $candidate_page->last_name;
					    $candidate_first_name=$candididate_name_array[0];
					    $candidate_last_name='';
					}$candidate_phone_number = $candidate_page->phone_number;
					$candidate_email = $candidate_page->oauth_gmail;
					$candidate_pronoun = $candidate_page->pronoun;
				 $candidate_page_id = $candidate_page->id;
				
			
				//      $candidate_first_name ="first";
				// 	$candidate_last_name = "LAst";
				// 	//$candidate_email = $candidate_page->pronoun;
				// 	$candidate_phone_number = "1234567890";
				// 	$candidate_email = "sameeshyadav@gmail.com";
				// 	$candidate_pronoun ="other";
    //                 $candidate_page_id=100;

			    
		?>
			
		<div class="container">
		    	<!-- <div class="text-center"> -->
	    		<div>
					<?=$page->ticketing_job_fair_description_two?>
				</div>
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8">
			    
					<form id="main-container" action="<?=$page->httpUrl?>" class="[ my-5 px-sm-5 ][ container rounded tab-content ][ needs-validation ]"  method="POST" enctype="multipart/form-data" novalidate>
		<!-- PERSONAL INFORMATION TAB -->
		
					<?php
						   /* echo $pages->get("name=cart")->httpUrl;*/
					?>
							<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">
								<div class="[ my-2 ][ text-center bg-primarya ]">
									<h3>Candidate Information</h3>
								</div>

								<!--code by amruta Already exists email-->
											<?php
        						   /* echo $pages->get("name=cart")->httpUrl;*/
            						if($already_profile_page==true){
												?>
										
												<div class="text-center mt-3">
												<span class="[ px-3 py-1 ][ text-center bg-danger text-light rounded ]">You have already registered for the job fair!</span>
												</div>
							
											<?php
												}
												?>
								<!--code by amruta Already exists email-->
								<div class="[ ][ form-group ]">
								<div class="row" style="margin-top:2rem;">
									<div class="[ col-md-6 ]">
										<label for="first_name">First name</label>
										<input id="first_name" value="<?=$candidate_first_name?>" class="form-control phone_number_spacing" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="first_name" placeholder="First Name" required>
						
										<div class="invalid-tooltip">
											Please provide a valid First name.
										</div>
									</div>
									<div class="[ col-md-6 ]">
										<label for="last_name">Last name</label>
										<input id="last_name" value="<?=$candidate_last_name?>" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="last_name" placeholder="Last Name" required>
						
										<div class="invalid-tooltip">
											Please provide a valid Last name.
										</div>
									</div>
									

	                <input id="page_id" value="<?=$candidate_page_id?>" class="form-control" name="page_id" hidden required>

									
									
								</div>
								</div>
								
								<div class="[ ][ form-group ]">
								 <div class="row">
									<div class="[ col-md-6 ][ ]">
										<label for="pronoun">Pronoun</label>
										<select id="pronoun" class="custom-select phone_number_spacing" name="pronoun"  required>
										
											<option value="" selected hidden>Pronoun</option>
											<option value="She/Her" <?php if ($candidate_pronoun == "She/Her") echo "selected"; ?>>She/Her</option>
											<option value="He/Him" <?php if ($candidate_pronoun == "He/Him") echo "selected"; ?>>He/Him</option>
											<option value="They/Them" <?php if ($candidate_pronoun == "They/Them") echo "selected"; ?>>They/Them</option>
											<option value="other" <?php if ($candidate_pronoun == "other") echo "selected"; ?>>Other</option>
										</select>
						
										<div class="invalid-tooltip">
											Please select a pronoun.
										</div>
									</div>

									<div id="pronoun_custom_container" class="[ col-md-6 ][ hidden ]" style='display:none;' >
										<label for="pronoun_custom"> Enter Your Pronoun</label>
						
										<input id="pronoun_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="pronoun_custom" placeholder="Your Pronoun" >
						
										<div class="invalid-tooltip">
											Please state a valid pronoun.
										</div>
									</div>
								<!-- </div>
								</div>
					   <div class="[ ][ form-group ]">
						   <div class="row"> -->
							   <div class="col-md-6 phone_number_alignment">
									<label for="phone_number">Phone number</label>
						
									<div class="row no-gutters">
										
										<select id="phone_country_code" class="[ col-12 col-sm-4 pl-2 ][ custom-select  phone_number_spacing ]" name="phone_country_code">
											<option value="+376">(AD) +376</option>
											<option value="+971">(AE) +971</option>
											<option value="+93">(AF) +93</option>
											<option value="+1-268">(AG) +1-268</option>
											<option value="+1-264">(AI) +1-264</option>
											<option value="+355">(AL) +355</option>
											<option value="+374">(AM) +374</option>
											<option value="+599">(AN) +599</option>
											<option value="+244">(AO) +244</option>
											<option value="+672">(AQ) +672</option>
											<option value="+54">(AR) +54</option>
											<option value="+1-684">(AS) +1-684</option>
											<option value="+43">(AT) +43</option>
											<option value="+61">(AU) +61</option>
											<option value="+297">(AW) +297</option>
											<option value="+994">(AZ) +994</option>
											<option value="+387">(BA) +387</option>
											<option value="+1-246">(BB) +1-246</option>
											<option value="+880">(BD) +880</option>
											<option value="+32">(BE) +32</option>
											<option value="+226">(BF) +226</option>
											<option value="+359">(BG) +359</option>
											<option value="+973">(BH) +973</option>
											<option value="+257">(BI) +257</option>
											<option value="+229">(BJ) +229</option>
											<option value="+590">(BL) +590</option>
											<option value="+1-441">(BM) +1-441</option>
											<option value="+673">(BN) +673</option>
											<option value="+591">(BO) +591</option>
											<option value="+55">(BR) +55</option>
											<option value="+1-242">(BS) +1-242</option>
											<option value="+975">(BT) +975</option>
											<option value="+267">(BW) +267</option>
											<option value="+375">(BY) +375</option>
											<option value="+501">(BZ) +501</option>
											<option value="+1">(CA) +1</option>
											<option value="+61">(CC) +61</option>
											<option value="+243">(CD) +243</option>
											<option value="+236">(CF) +236</option>
											<option value="+242">(CG) +242</option>
											<option value="+41">(CH) +41</option>
											<option value="+225">(CI) +225</option>
											<option value="+682">(CK) +682</option>
											<option value="+56">(CL) +56</option>
											<option value="+237">(CM) +237</option>
											<option value="+86">(CN) +86</option>
											<option value="+57">(CO) +57</option>
											<option value="+506">(CR) +506</option>
											<option value="+53">(CU) +53</option>
											<option value="+238">(CV) +238</option>
											<option value="+599">(CW) +599</option>
											<option value="+61">(CX) +61</option>
											<option value="+357">(CY) +357</option>
											<option value="+420">(CZ) +420</option>
											<option value="+49">(DE) +49</option>
											<option value="+253">(DJ) +253</option>
											<option value="+45">(DK) +45</option>
											<option value="+1-767">(DM) +1-767</option>
											<option value="+1-809">(DO) +1-809</option>
											<option value="+213">(DZ) +213</option>
											<option value="+593">(EC) +593</option>
											<option value="+372">(EE) +372</option>
											<option value="+20">(EG) +20</option>
											<option value="+212">(EH) +212</option>
											<option value="+291">(ER) +291</option>
											<option value="+34">(ES) +34</option>
											<option value="+251">(ET) +251</option>
											<option value="+358">(FI) +358</option>
											<option value="+679">(FJ) +679</option>
											<option value="+500">(FK) +500</option>
											<option value="+691">(FM) +691</option>
											<option value="+298">(FO) +298</option>
											<option value="+33">(FR) +33</option>
											<option value="+241">(GA) +241</option>
											<option value="+44">(GB) +44</option>
											<option value="+1-473">(GD) +1-473</option>
											<option value="+995">(GE) +995</option>
											<option value="+44-1481">(GG) +44-1481</option>
											<option value="+233">(GH) +233</option>
											<option value="+350">(GI) +350</option>
											<option value="+299">(GL) +299</option>
											<option value="+220">(GM) +220</option>
											<option value="+224">(GN) +224</option>
											<option value="+240">(GQ) +240</option>
											<option value="+30">(GR) +30</option>
											<option value="+502">(GT) +502</option>
											<option value="+1-671">(GU) +1-671</option>
											<option value="+245">(GW) +245</option>
											<option value="+592">(GY) +592</option>
											<option value="+852">(HK) +852</option>
											<option value="+504">(HN) +504</option>
											<option value="+385">(HR) +385</option>
											<option value="+509">(HT) +509</option>
											<option value="+36">(HU) +36</option>
											<option value="+62">(ID) +62</option>
											<option value="+353">(IE) +353</option>
											<option value="+972">(IL) +972</option>
											<option value="+44-1624">(IM) +44-1624</option>
											<option value="+91" selected>(IN) +91</option>
											<option value="+246">(IO) +246</option>
											<option value="+964">(IQ) +964</option>
											<option value="+98">(IR) +98</option>
											<option value="+354">(IS) +354</option>
											<option value="+39">(IT) +39</option>
											<option value="+44-1534">(JE) +44-1534</option>
											<option value="+1-876">(JM) +1-876</option>
											<option value="+962">(JO) +962</option>
											<option value="+81">(JP) +81</option>
											<option value="+254">(KE) +254</option>
											<option value="+996">(KG) +996</option>
											<option value="+855">(KH) +855</option>
											<option value="+686">(KI) +686</option>
											<option value="+269">(KM) +269</option>
											<option value="+1-869">(KN) +1-869</option>
											<option value="+850">(KP) +850</option>
											<option value="+82">(KR) +82</option>
											<option value="+965">(KW) +965</option>
											<option value="+1-345">(KY) +1-345</option>
											<option value="+7">(KZ) +7</option>
											<option value="+856">(LA) +856</option>
											<option value="+961">(LB) +961</option>
											<option value="+1-758">(LC) +1-758</option>
											<option value="+423">(LI) +423</option>
											<option value="+94">(LK) +94</option>
											<option value="+231">(LR) +231</option>
											<option value="+266">(LS) +266</option>
											<option value="+370">(LT) +370</option>
											<option value="+352">(LU) +352</option>
											<option value="+371">(LV) +371</option>
											<option value="+218">(LY) +218</option>
											<option value="+212">(MA) +212</option>
											<option value="+377">(MC) +377</option>
											<option value="+373">(MD) +373</option>
											<option value="+382">(ME) +382</option>
											<option value="+590">(MF) +590</option>
											<option value="+261">(MG) +261</option>
											<option value="+692">(MH) +692</option>
											<option value="+389">(MK) +389</option>
											<option value="+223">(ML) +223</option>
											<option value="+95">(MM) +95</option>
											<option value="+976">(MN) +976</option>
											<option value="+853">(MO) +853</option>
											<option value="+1-670">(MP) +1-670</option>
											<option value="+222">(MR) +222</option>
											<option value="+1-664">(MS) +1-664</option>
											<option value="+356">(MT) +356</option>
											<option value="+230">(MU) +230</option>
											<option value="+960">(MV) +960</option>
											<option value="+265">(MW) +265</option>
											<option value="+52">(MX) +52</option>
											<option value="+60">(MY) +60</option>
											<option value="+258">(MZ) +258</option>
											<option value="+264">(NA) +264</option>
											<option value="+687">(NC) +687</option>
											<option value="+227">(NE) +227</option>
											<option value="+234">(NG) +234</option>
											<option value="+505">(NI) +505</option>
											<option value="+31">(NL) +31</option>
											<option value="+47">(NO) +47</option>
											<option value="+977">(NP) +977</option>
											<option value="+674">(NR) +674</option>
											<option value="+683">(NU) +683</option>
											<option value="+64">(NZ) +64</option>
											<option value="+968">(OM) +968</option>
											<option value="+507">(PA) +507</option>
											<option value="+51">(PE) +51</option>
											<option value="+689">(PF) +689</option>
											<option value="+675">(PG) +675</option>
											<option value="+63">(PH) +63</option>
											<option value="+92">(PK) +92</option>
											<option value="+48">(PL) +48</option>
											<option value="+508">(PM) +508</option>
											<option value="+64">(PN) +64</option>
											<option value="+1-787">(PR) +1-787</option>
											<option value="+970">(PS) +970</option>
											<option value="+351">(PT) +351</option>
											<option value="+680">(PW) +680</option>
											<option value="+595">(PY) +595</option>
											<option value="+974">(QA) +974</option>
											<option value="+262">(RE) +262</option>
											<option value="+40">(RO) +40</option>
											<option value="+381">(RS) +381</option>
											<option value="+7">(RU) +7</option>
											<option value="+250">(RW) +250</option>
											<option value="+966">(SA) +966</option>
											<option value="+677">(SB) +677</option>
											<option value="+248">(SC) +248</option>
											<option value="+249">(SD) +249</option>
											<option value="+46">(SE) +46</option>
											<option value="+65">(SG) +65</option>
											<option value="+290">(SH) +290</option>
											<option value="+386">(SI) +386</option>
											<option value="+47">(SJ) +47</option>
											<option value="+421">(SK) +421</option>
											<option value="+232">(SL) +232</option>
											<option value="+378">(SM) +378</option>
											<option value="+221">(SN) +221</option>
											<option value="+252">(SO) +252</option>
											<option value="+597">(SR) +597</option>
											<option value="+211">(SS) +211</option>
											<option value="+239">(ST) +239</option>
											<option value="+503">(SV) +503</option>
											<option value="+1-721">(SX) +1-721</option>
											<option value="+963">(SY) +963</option>
											<option value="+268">(SZ) +268</option>
											<option value="+1-649">(TC) +1-649</option>
											<option value="+235">(TD) +235</option>
											<option value="+228">(TG) +228</option>
											<option value="+66">(TH) +66</option>
											<option value="+992">(TJ) +992</option>
											<option value="+690">(TK) +690</option>
											<option value="+670">(TL) +670</option>
											<option value="+993">(TM) +993</option>
											<option value="+216">(TN) +216</option>
											<option value="+676">(TO) +676</option>
											<option value="+90">(TR) +90</option>
											<option value="+1-868">(TT) +1-868</option>
											<option value="+688">(TV) +688</option>
											<option value="+886">(TW) +886</option>
											<option value="+255">(TZ) +255</option>
											<option value="+380">(UA) +380</option>
											<option value="+256">(UG) +256</option>
											<option value="+1">(US) +1</option>
											<option value="+598">(UY) +598</option>
											<option value="+998">(UZ) +998</option>
											<option value="+379">(VA) +379</option>
											<option value="+1-784">(VC) +1-784</option>
											<option value="+58">(VE) +58</option>
											<option value="+1-284">(VG) +1-284</option>
											<option value="+1-340">(VI) +1-340</option>
											<option value="+84">(VN) +84</option>
											<option value="+678">(VU) +678</option>
											<option value="+681">(WF) +681</option>
											<option value="+685">(WS) +685</option>
											<option value="+383">(XK) +383</option>
											<option value="+967">(YE) +967</option>
											<option value="+262">(YT) +262</option>
											<option value="+27">(ZA) +27</option>
											<option value="+260">(ZM) +260</option>
											<option value="+263">(ZW) +263</option>
										</select>
			
								<input id="phone_number" value="<?=$candidate_phone_number?>" class="[ offset-sm-1 col-12 col-sm-7 pl-2 ][ form-control phone_number_spacing ]" pattern="[0-9]{10}" type="text" name="phone_number" placeholder="Example: 9876543210" maxlength="10" required>
			
								<div class="invalid-tooltip">
									Please provide a valid phone number.
								</div>
							</div>
										
								</div>
								<!-- <div class="col-md-6 phone_number_alignment">
									<label for="confirm_country_code">Confirm Phone number</label>

									<div class="row no-gutters">
										<select id="confirm_country_code" class="[ col-12 col-sm-4 pl-2 ][ custom-select  phone_number_spacing ]" name="confirm_country_code">
											
										</select>

										<input id="confirm_phone_number" class="[ offset-sm-1 col-12 col-sm-7 pl-2 ][ form-control  ]" pattern="[0-9]{10}" type="text" name="confirm_phone_number" placeholder="Example: 9876543210" maxlength="10" required>
									</div>
								 </div>
						<div class="invalid-tooltip">
							Please confirm the Phone number.
						</div>
						<div  class="[ text-danger ]" style="height: 1.3rem" >
							<div id="no_match" hidden="true">
								phone numbers do not match.
							</div>
						</div> -->
										   
							 </div>
					   </div>
		
			
			
			
				<div class="[  ][ form-group ]">
					<label for="email">Email</label>
					<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$candidate_email;?>" required>

					<div class="invalid-tooltip">
						Please provide a valid email address.
					</div>
				</div>

				<div class="[  ][ form-group ]">
					<label for="confirm-email">Please confirm your email</label>
					<input id="confirm-email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$candidate_email;?>" required>

					<div class="invalid-tooltip">
						Please provide a valid email address.
					</div>
				</div>
		
			
				<!--<div class="[ form-group ]">-->
				<!--<label for="company_name">Company Name</label>-->
				<!--<input id="company_name" class="form-control" type="text" name="company_name" placeholder="Company Name" >-->

				<!--<div class="invalid-tooltip">-->
				<!--	Please provide a valid Comapny name.-->
				<!--</div>-->
			<!--</div>-->
           <?=$page->ticketing_terms_conditions?>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
			  <label class="form-check-label" for="flexCheckDefault" style="color:red;">
			   I ACCEPT THE TERMS AND CONDITIONS
			  </label>
			  <!-- <input type="checkbox" name="checkbox" value="check"  /> -->
			    <!-- <input type="submit" name="email_submit" value="submit" onclick="if(!this.form.checkbox.checked){alert('You must agree to the terms first.');return false}"  /> -->
			  
	           <!-- <div class="form-check">
	              <input class="form-check-input"   type="checkbox" -+value="" id="invalidCheck2" required />
	  <label class="form-check-label" for="invalidCheck2">
	   Agree to
	  </label>
	</div> -->
			  
			</div>
		</div>
			<!-- Buttons Section -->
			<div class="[ d-flex flex-row justify-content-center mb-4 ]" style="margin-top:2rem;">
				<button value="submit" class="btn btn-primary" type="submit" name="add_ticket_submit" id="add_ticket_submit" >
				SUBMIT
				</button>
			</div>
			<!-- Buttons Section End -->
		</div>
		
		<!--</div>-->
		<!-- ADDITIONAL INFORMATION TAB -->
	</form>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>
	

	<?php				
		}
		else{
		    header("Location:".$pages->get("name=resume")->httpUrl);
		}
	}
	?>

</div>
<div class="container">
        <div class="row tandc_height" style="">
            <div class="col-md-12"  id="faq">
                  <p><?=$page->equally_event_description?></p>
            </div>
        </div>
    </div>
<?php
    require_once 'includes/ticketing-footer.php';
	$rootpath = $config->urls->templates;
?>
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js" type="text/javascript"></script>


	
			<script type="text/javascript">
		$(document).ready(function(){
			// $(document).on("keyup","#confirm_phone_number",  function(){
			// 	if($(this).val() == $("#phone_number").val()){
			// 	    console.log("1");
			// 		$("#add_ticket_submit").prop("disabled", false);
			// 		$("#no_match").prop("hidden", true);
			// 	}
			// 	else{
			// 	    console.log("2");
			// 		$("#add_ticket_submit").prop("disabled", true);
			// 		$("#no_match").prop("hidden", false);
			// 	}
			// });
			
			// 	$(document).on("keyup","#phone_number",  function(){
			// 	if($(this).val() == $("#phone_number").val()){
			// 	    console.log("3");
			// 		$("#add_ticket_submit").prop("disabled", false);
			// 		$("#no_match").prop("hidden", true);
			// 	}
			// 	else{
			// 	    console.log("4");
			// 		$("#add_ticket_submit").prop("disabled", true);
			// 		$("#no_match").prop("hidden", false);
			// 	}
			// });
			
			// 	$(document).on("click","#add_ticket_submit",  function(){
			// 	if($("#confirm_phone_number").val() == $("#phone_number").val()){
			// 	    console.log("5");
			// 		$("#add_ticket_submit").prop("disabled", false);
			// 		$("#no_match").prop("hidden", true);
			// 	}
			// 	else{
			// 	    console.log("6");
			// 		$("#add_ticket_submit").prop("disabled", true);
			// 		$("#no_match").prop("hidden", false);
			// 	}
			// })


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

	</body>
	</html
