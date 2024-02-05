<?php
/*************************************
This paage has 4 users
1. Candidate
2. Admin
3. Editor 
4. Recruiter

Candidate and Admin will see all the information, Editor and Recruiter will see redacted information.
Candidate is reconised by "oauth_gmail" in the session while others are recognised by "user_designation" in the sessoin
*************************************/

	/* For column names and variables */
	require_once $config->paths->templates.'includes/candidate_table_data.php';
	echo $session->oauth_gmail;
	echo "candidate profie";
	/* Function to check for the editor:  the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_editor_unlocked_array(){
		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		$editor_page->of(false);

		/* Get the current favourite profiles array */
		$unlocked_profiles_array_to_save = json_decode($editor_page->unlocked_profiles_array);

		/* Array to save just the unlocked page IDs without the timestamp */
		$unlocked_profiles_array = Array();

		/* Go through the object array to see if time limit on unlocked profiles exceeds. Remove the element if it does. */
		foreach($unlocked_profiles_array_to_save as $key=>$value){
			/* if timestamp is more than 24Hrs old */
			if(time() > $value->timestamp+(24*60*60)){
				unset($unlocked_profiles_array_to_save[$key]);
			}else{
				$unlocked_profiles_array = array_merge($unlocked_profiles_array, $value->unlocked_profiles_array);
			}
		}

		/* Serialize the array */
		$unlocked_profiles_array_to_save = array_values($unlocked_profiles_array_to_save);

		/* Save it to the page */
		$editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array_to_save);
		$editor_page->save();

		/* Now returned the flattened array containing only unlcoked IDs */
		return $unlocked_profiles_array;
	}
	/* Function to check for the editor:  the unlocked array, delete expired profiles, return an array withonly IDs END */

	/* Function to check for the recruiter: the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_recruiter_unlocked_array(){
		/* Get the current recruiter's page */
		$recruiter_page = wire("pages")->get("id=".wire("session")->user_page_id);

		/* Get the current unlocked profiles array */
		$unlocked_profiles_array = json_decode($recruiter_page->unlocked_profiles_array);

		/* Now returned the flattened array containing only unlcoked IDs */
		return $unlocked_profiles_array;
	}
	/* Function to check for the recruiter the unlocked array, delete expired profiles, return an array withonly IDs END */

	/* Check if the user is logged in */
	if($session->user_email != ""){
		/* Based on what type of user has logged in, decide columns availability */
		switch ($session->user_designation) {
			case "editor":
				/* If default columns are requested, get them from the user's account. */
				$available_columns_to_show = $columns_for_editor;

				/* If this profile is unlocked, all information is available. Check if editor has page ID in unlocked profiles array in their account */
				if(in_array($page->id, fetch_editor_unlocked_array())){
					$available_columns_to_show = $columns_for_admin;
				}
			break;

			case "admin":
				/* If default columns are requested, get them from the user's account. */
				$available_columns_to_show = $columns_for_admin;
			break;

			case "recruiter":
				/* If default columns are requested, get them from the user's account. */
				$available_columns_to_show = $columns_for_recruiter;

				/* If this profile is unlocked, all information is available. Check if recruiter has page ID in unlocked profiles array in their account */
				if(in_array($page->id, fetch_recruiter_unlocked_array())){
					$available_columns_to_show = $unlocked_columns_for_recruiter;
				}
			break;

			default:
				break;
		}
	}
	/* Check if a similar email ID exists. (including upper/lower case characters) This is to check if user has used wrong upper/lower case characthers in their email ID by mistake. then convert both email lowercase and match.*/
	else if($session->oauth_gmail == "" || strtolower($session->oauth_gmail) != strtolower($page->oauth_gmail)){
		header("Location: ".$config->urls->httpRoot."resume/");
	}
	else{
		/* The candidate has logged in */

		/* profile oauth email id is assign to session oauth email id for upper/lower case characters*/
		$session->oauth_gmail=$page->oauth_gmail;
		
		$available_columns_to_show = $columns_for_candidate;
//print_r($_COOKIE);
		/* Check if any cookies are on the browser for unfinished event registration */
		$event_page_to_open = false;
		if(isset($_COOKIE['pc_event_unfinished'])){

			$event_page_to_open = $input->cookie->pc_event_unfinished;
			//setcookie("pc_event_unfinished", "", time() - 3600); 
			unset($_COOKIE['pc_event_unfinished']); 
    		setcookie('pc_event_unfinished', null, -1, '/'); 

		}
		/* Check if any cookies are on the browser for unfinished event registration end */
	}

	if(array_key_exists("custom_full_name", $available_columns_to_show)){
		$page_title = $page->first_name;
		$profile_name = $page->first_name." ".$page->last_name.($page->preferred_name == "" ? "" : " (".$page->preferred_name.")");
	}
	elseif (array_key_exists("serial_id", $available_columns_to_show)){
		$page_title = "Candidate #".$page->serial_id;
		$profile_name = "Candidate #".$page->serial_id;
	}
	else{
		$page_title = "Candidate Name HIdden";
		$profile_name = "Candidate Name HIdden";
	}


	/** In Candidates section - Add notes using Admin and Editor */
	if(isset($_POST["btn_add_notes"])){
		$candidate_notes_array=array();
		$notes=$sanitizer->textarea($input->post->notes_text);
		$candidate_notes_array[]=$notes;
		$notes_add_timestamp=strtotime(date("Y-m-d h:i:sa"));
		$candidate_notes_array[]=$notes_add_timestamp;
		$session_user_id=wire("pages")->get("id=".wire("session")->user_page_id);
		$admin_page=$pages->get("name=admins")->child("id=".$session_user_id);
		$notes_added_by=$admin_page->title;
		$candidate_notes_array[]=$notes_added_by;
		$candidates_notes_entry_object=new stdClass();
		$candidates_notes_entry_object->notes=$notes;
		$candidates_notes_entry_object->timestamp=$notes_add_timestamp;
		$candidates_notes_entry_object->added_by=$notes_added_by;
		$candidates_notes_json=$page->notes_data;
		if($candidates_notes_json == ""){
			$candidates_notes_json='{"notes_details_array":[]}';
		}
		 /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
		 $candidates_notes_object = json_decode($candidates_notes_json);
		 $candidates_notes_object->notes_details_array[] = $candidates_notes_entry_object;
		 $page->notes_details_array = json_encode($candidates_notes_object);
		 
		 $page->notes_data=$page->notes_details_array;
		$page->of(false);
		$page->save();
		print_r($candidate_notes_array);
	}
	/** End In Candidates section - Add notes using Admin and Editor */

	/**Fetch candidates notes in notes section */
	 
	if($page->notes_data==""){
		$page->notes_data	='{"notes_details_array":[]}';
	}
/* Amruta Jagtap 2022-04-12 The following shows the timeline of all the points added to the referrer in a timeline. The dashboard is split into two sections. */

/* Get the array of all the points details that the referrer has earned */
		$candidates_notes_object= json_decode($page->notes_data);
		//print_r($referrer_page->referrer_points);
		$notes_details_array = $candidates_notes_object->notes_details_array;
		
		$total_points=0;
		foreach($notes_details_array as $notes_details){
				
		}


	/**ENd Fetch candidates notes in notes section */
?>

<!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->

	<title><?=$page->page_title?> | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $urls->httpTemplates;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $urls->httpTemplates;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css?v=22.03" rel="stylesheet" type="text/css">
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $urls->httpTemplates;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>

	<?php
	//	if($event_page_to_open){
	?>

	<script>
		//window.open('', '_blank');
		<?php
		//$event_page_to_open;
		?>
	</script>

	<?php
//	}
	?>

	<!-- ---------- JS LINKS END ---------- -->
</head>

<body>
	<?php
		require_once 'includes/resume_header.php';
	?>
	<div id="top-container">
		<!-- <img src="<?=$urls->httpTemplates;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$urls->httpTemplates;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

		<img src="<?=$urls->httpTemplates;?>images/ticketing-platform-web.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$urls->httpTemplates;?>images/ticketing-platform-mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<div class="container">
		<!-- <div class="row"> -->
			
			<!-- <div class="col-md-7"> -->
				<div class="row mt-md-5">
					<div class="col-md">

					</div>

					<!--<div id="profile-picture-container" class="col-sm-12 col-md-3">-->
						<?php
						// 	if(array_key_exists("profile_picture", $available_columns_to_show) && $page->profile_image){
						// 		$profile_picture_url = $page->profile_image->url;
						// 	}
						// 	else{
						// 		$profile_picture_url = $urls->httpTemplates."images/empty-profile-image.png";
						// 	}
						?>

					<!--	<img  id="profile-picture" src="<?=$profile_picture_url ?>" class="[  mx-auto my-2 ][ img-fluid rounded-circle border-primary ]" alt="Profile Picture">-->
					<!--</div>-->

			

					<!--introduction part start-->
					<div class="col-sm-12 col-md-4 mt-2 text-center d-md-flex flex-md-column">
						<h1 id="profile-name" class="mb-3">
							<strong><?=$profile_name?></strong>
						</h1>

						<div>
							<?php
								if(array_key_exists("pronoun", $available_columns_to_show)){
							?>

							<span id="profile-category" class="badge badge-pill badge-primary text-white bg-ngo px-2 py-1 mb-4 mr-2 border-ngo"><?=$page->pronoun?></span>

							<?php
								}

								if(array_key_exists("identify_as", $available_columns_to_show)){
							?>

							<span id="profile-category" class="badge badge-pill badge-primary text-white bg-ngo px-2 py-1 mb-4 mr-2 border-ngo"><?=$page->identify_as?></span>

							<?php
								}

								if(array_key_exists("current_city", $available_columns_to_show)){
							?>

							<span id="profile-category" class="badge badge-pill badge-primary text-white bg-ngo px-2 py-1 mb-4 mr-2 border-ngo"><?=$page->current_city?></span>

							<?php
								}
							?>
						</div>

						<div>
							<p>
								<?php
									if(array_key_exists("custom_phone_number", $available_columns_to_show)){
										echo $page->phone_country_code." ".$page->phone_number;
									}
								?>

								<br>

								<?php
									if(array_key_exists("email", $available_columns_to_show)){
										echo $page->email;
									}
								?>
							</p>
						</div>
											<?php
								//	}

									if(array_key_exists("tell_us_about_yourself", $available_columns_to_show)){
								?>
												<hr>
								<div>
									<!--<p>About yourself</p>-->
									<p style="text-align:left;"><?=$page->tell_us_about_yourself?></p>
								</div>

								<?php
									}
								?>
						<?php
							if(array_key_exists("resume", $available_columns_to_show)){
						?>

						

						<div>
							<a href="<?=$page->resume->url?>"><button type="button" class="[ px-3 ][ btn btn-primary ]">Download Resume</button></a>
						</div>

						<?php
							}

							if(array_key_exists("redacted_resume", $available_columns_to_show) && $session->user_designation != "" && $page->redacted_resume){
						?>

						<hr>

						<div>
							<a href="<?=$page->redacted_resume->url?>"><button type="button" class="[ px-3 ][ btn btn-primary ]">Download Redacted Resume</button></a>
						</div>

						<?php
							}
						?>

						<hr>
						
						<div>
								<div class="card card_job_fair" style="background: #191B21;">
																<div class="card-body">
																		<div class="card-title">
																				<h3 class="text-center text-white" style="font-family: 'Poppins', sans-serif;font-weight: 600">RISE 2021 Job Fair</h3>
																				<h5 class="text-center text-white" style="font-family: 'Poppins', sans-serif;font-weight: 600">8<sup>th</sup> May 2021<h5>
																				
																			<div class="text-center">
																					<a target="_blank" href="<?=$pages->get("name=job-fair")->httpUrl;?>">
																							<button class=" text-center btn_ticket_job_fair" >Get your FREE pass</button>
																					</a>
																			</div>
																		
																	</div>
															</div>
												</div>
											<!--  <div class="text-center">
														<p>Rise 2021 Job Fair</p>
														<a target="_blank" href="<?=$pages->get("name=job-fair")->httpUrl;?>">
																<button class="[ btn btn-primary ] text-center btn_ticket_job_fair" style="border-radius: 31px;border-color:#8A2527;padding: 13px;font-size: 14px;font-weight: 600;" >Get your FREE pass</button>
														</a>
												</div> -->
							</div>
					</div>
					

					<div class="col-md">
							
							

					</div>


					<!--introduction part end-->
				</div>
				<!--menu-bar-->
				<div class="row">
					<div class="col-md-6 col-md d-none d-md-block d-lg-block web_view">
								<!-- notes section -->
								<div class="">
									<div class="card border-left-warning   my-5 []">
										<div class="card-body">
											<div id="referrer_points_details_container" >
												<h4 class="text-center">Notes</h4>
												<div style="overflow-y: auto; height: 260px;">
													<?php
														if($page->notes_data == ""){
															echo "No notes to show.";
														}

														/* If no notes, show  */
														if(count($notes_details_array) == 0){
															echo "No notes to show.";
													}else{
															/* Show each point notification in a foreach loop */
															$notes_details_array=array_reverse($notes_details_array);
															foreach($notes_details_array as $notes_details_object){
																	$border_color="primary";
																
													?>
												
											<div class=" shadow [ card ][ my-3 mr-2 p-3 ]" style="border-left:4px solid #ff8300;">
													<div class="[ d-flex justify-content-between ]">
															<div style="float:left">
																	<p class="mb-0" style="color:#0010ff;"><?=$notes_details_object->added_by;?></p>
																	<p><?=$notes_details_object->notes;?>  </p>
																	<sub class="notes_date" style="float:right;"><?=date("d M Y h:i",$notes_details_object->timestamp);?></sub>
															</div>
															
															<div style="float:right">
											
															</div>
													</div>
											</div>
											<?php
															}
													}
													
											?>
											</div>
											</div>
											<div class="add_notes_section pt-4">
												<h4 class="text-center">Add Notes</h4>
												<form id="notes_section_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-10">
																<div class="[  ][ form-group ]">
																	<label for="notes_text">Notes</label>
																	<textarea id="notes_text" name="notes_text" class="md-textarea form-control" rows="1" required></textarea>
																							
																	<div class="invalid-tooltip">
																		Please enter company name.
																	</div>
																</div>
														</div>
														<div class="col-md-2 web_btn_add">
															<button value="submit" id="btn_add_notes" name="btn_add_notes" class=" [ btn btn-primary ] " type="submit"  >
																Add
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- End notes section -->
					</div>

					<div id="profile-details-container"  class="[ mt-5 ][ col-md-6 ]" data-target="body" data-offset="0">
						<!--<div class="[ my-3 ]">-->
						<!--	<h4 class="text-center">Personal Information</h4>-->
						<!--</div>-->
						<table class="[ table ]">
							<tbody>

								<?php
									if(array_key_exists("date_of_birth", $available_columns_to_show)){
										if($page->date_of_birth!=""){
								?>

								<tr>
									<td>Date of birth</td>
									<td><?=date("d M Y", $page->date_of_birth)?></td>
								</tr>

								<?php
										}
									}

									if(array_key_exists("internship_apply", $available_columns_to_show)){
								?>

								<tr>
									<td>Apply for internship</td>
									<td><?=$page->internship_apply?></td>
								</tr>

								<?php
									}
									if($page->internship_apply=="Yes"){
										if(array_key_exists("age16over", $available_columns_to_show)){
											if($page->internship_month!=""){
								?>

								<tr>
									<td>Over 16 years of age</td>
									<td><?=$page->age16over?></td>
								</tr>

								<?php
										}
									}

									if(array_key_exists("internship_month", $available_columns_to_show)){
										if(!empty($page->internship_month)){
								?>

								<tr>
									<td>Internship month(s)</td>
									<?php
									
									$months=array();
									$months=json_decode($page->internship_month);
									$internship_months=implode(", ",$months);
									?>
									<td><?=$internship_months?></td>
									
								</tr>

								<?php
										}
									}
									if(array_key_exists("aggregate_percentage", $available_columns_to_show)){
										if($page->aggregate_percentage!=""){
									?>

									<tr>
										<td>Aggregate percentage</td>
										<td><?=$page->aggregate_percentage?></td>
									</tr>

									<?php
											}
										}
								}

									if(array_key_exists("out_at_work", $available_columns_to_show)){
								?>
								<tr>
									<td>Have you shared with your circle that you identify as LGBT+?</td>
									<td><?=$page->out_at_work?></td>
								</tr>
														
															<?php
									}

									if(array_key_exists("whatsapp_number", $available_columns_to_show)){
								?>

								<tr>
									<td>Whatsapp number</td>
									<td><?=$page->whatsapp_country_code." ".$page->whatsapp_number;?></td>
								</tr>

								<?php
								}

								//	if(array_key_exists("linkedin_url", $available_columns_to_show)){
								?>

							

								<!--<tr>-->
								<!--	<td>How did you know about us</td>-->
								<!--	<td><?=$page->how_did_you_know_about_us?></td>-->
								<!--</tr>-->

								<?php
								//	}
								?>
								
									<?php
									if(array_key_exists("qualification", $available_columns_to_show)){
								?>

								<tr>
									<td>Highest education qualification</td>
									<td><?=$page->qualification?></td>
								</tr>

								<?php
									}

									//if(array_key_exists("course", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Course</td>-->
								<!--	<td><?=$page->course?></td>-->
								<!--</tr>-->

								<?php
								//	}

								//	if(array_key_exists("specialisation", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Specialisation</td>-->
								<!--	<td><?=$page->specialisation?></td>-->
								<!--</tr>-->

								<?php
								//	}

									if(array_key_exists("year_of_passing", $available_columns_to_show)){
								?>

								<tr>
									<td>Year of passing highest education</td>
									<?php
										if($page->month_of_passing!=""){
									?>
									<td><?=date("F", mktime(0, 0, 0, $page->month_of_passing, 10))." ".$page->year_of_passing?></td>
									<?php
										}else{
									?>
											<td><?=$page->year_of_passing?></td>
									<?php
										}
									?>
								</tr>

								<?php
									}

									if(array_key_exists("college", $available_columns_to_show)){
										if($page->college!=""){
								?>
								<tr>
									<td>Educational institute</td>
									<td><?=$page->college?></td>
								</tr>

								<?php
										}
									}

								//	if(array_key_exists("cartifications", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Certifications</td>-->
								<!--	<td><?=$page->cartifications?></td>-->
								<!--</tr>-->

								<?php
								//	}
								?>
								
									<?php
								//	if(array_key_exists("industry", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Current Industry</td>-->
								<!--	<td><?=$page->industry?></td>-->
								<!--</tr>-->

								<?php
								//	}

								//	if(array_key_exists("functional_area", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Current Functional Area</td>-->
								<!--	<td><?=$page->functional_area?></td>-->
								<!--</tr>-->

								<?php
								//	}

									if(array_key_exists("custom_experience", $available_columns_to_show)){
								?>

								<tr>
									<td>Total experience</td>
									<td><?=$page->experience_years." Years ".$page->experience_months." Months"?></td>
								</tr>

								<?php
									}

									if(array_key_exists("current_employer", $available_columns_to_show)){
								?>

								<tr>
									<td>Current/previous company</td>
									<td><?=$page->current_employer?></td>
								</tr>

								<?php
									}

									if(array_key_exists("current_role", $available_columns_to_show)){
								?>

								<tr>
									<td>Current role</td>
									<td><?=$page->current_role?></td>
								</tr>

								<?php
									}

									
								?>

							

								<!--<tr>-->
								<!--	<td>Non-Technical Skills</td>-->
								<!--	<td><?=$page->non_technical_skills?></td>-->
								<!--</tr>-->

								<?php
								//	}

								//	if(array_key_exists("soft_skills", $available_columns_to_show)){
								?>

								<!--<tr>-->
								<!--	<td>Soft Skills</td>-->
								<!--	<td><?=$page->soft_skills?></td>-->
								<!--</tr>-->

								<?php
									//}

									if(array_key_exists("custom_ctc", $available_columns_to_show)){
								?>

								<tr>
									<td>Current/last drawn salary</td>
									<td><?=$page->current_ctc." ".$page->current_ctc_currency." ".$page->current_ctc_time?></td>
								</tr>

								<?php
									}

											if(array_key_exists("how_did_you_know_about_us", $available_columns_to_show)){
								?>

								<tr>
									<td>How did you know about us</td>
									<td><?=$page->how_did_you_know_about_us?></td>
								</tr>

								<?php
									}
									if(array_key_exists("skills", $available_columns_to_show)){
								?>
								
								<tr>
									<td>Skills</td>
										<!--<td><?=$page->skills?></td>-->
										<?php
											if($session->user_designation=="admin" || $session->user_designation=="recruiter"){
													$skills_array=[];
																$skills_array[]=$page->skills;
																$skills_array[]=$page->soft_skills;
																$skills_array[]=$page->non_technical_skills;
																$skills_array[]=$page->technical_skills;
																$skills=implode(", ",array_map('trim', array_filter($skills_array)));
															$skills_display = $skills;
															
														?>
															<td><?=$skills_display?></td>
														<?php
											}
											else{ ?>
												<td><?=$page->skills?></td> 
											<?php
											}
									?>
								</tr>

								<?php
									}

									//if(array_key_exists("non_technical_skills", $available_columns_to_show)){
								?>

							</tbody>
						</table>

						<!--<div class="table-title">-->
						<!--	<h4 class="text-center">Education Information</h4>-->
						<!--</div>-->
						<!--<table class="[ table ]">-->
						<!--	<tbody>-->

							
						<!--	</tbody>-->
						<!--</table>-->

						<!--<div class="table-title">-->
						<!--	<h4 class="text-center">Employment Information</h4>-->
						<!--</div>-->
						<!--<table class="[ table ]">-->
						<!--	<tbody>-->

							
						<!--	</tbody>-->
						<!--</table>-->

						<!--<div class="table-title">-->
						<!--	<h4 class="text-center">Additional Details</h4>-->
						<!--</div>-->

						<!--<table class="[ table ]">-->
						<!--	<tbody>-->

							<?php
							//	if(array_key_exists("pwd_accomodation", $available_columns_to_show)){
								?>

						<!--		<tr>-->
						<!--			<td>Reasonable Accommodation </td>-->
						<!--			<td><?php echo ($page->pwd_accomodation=="" ? "-":$page->pwd_accomodation); ?></td>-->
						<!--		</tr>-->

								<?php
						//			}

						//			if(array_key_exists("referred_by", $available_columns_to_show)){-->
								?>

						<!--		<tr>-->
						<!--			<td>Referred By</td>-->
						<!--			<td><?php echo ($page->referred_by=="" ? "-":$page->referred_by); ?></td>-->
						<!--		</tr>-->

							<?php 
							//}

								//			if(array_key_exists("referrer_email", $available_columns_to_show)){-->
							?>
								<!--		<tr>-->
								<!--			<td>Referrer's Email</td>-->
								<!--			<td><?php echo ($page->referrer_email=="" ? "-":$page->referrer_email); ?></td>-->
								<!--		</tr>-->

						<?php
						//}
						?>

						<!--	</tbody>-->
						<!--</table>-->

						<!--<hr class="[ mt-5 ]">-->
							<hr class="">

						<?php
							if($session->oauth_gmail){
						?>

						<div class="[ mt-5 mb-5 ][ text-center ]">
							<a href="<?=$config->urls->httpRoot?>resume/edit-application/">
								<button class="[ px-5 ][ btn btn-primary ]" type="button"> Edit </button>
							</a>
						</div>

						<div class="[ mt-5 mb-5 ][ text-center ]">
							<a class="[ mt-3 ]" style="text-decoration: underline;" href="<?=$config->urls->httpRoot?>resume/login-with-email/?candidate_logout=true">
								Logout
							</a>
						</div>

						<?php
							}
						?>
					</div>

					<div class="col-md">
						<!-- Mobile view -->
						<div class="container d-block d-sm-block d-md-none mobile_view">
							<div id="Advance_search" class="collapse">
								<!-- notes section -->
								<div class="">
									<div class="card border-left-warning   my-5 []">
										<div class="card-body">
											<div id="referrer_points_details_container" >
												<h4 class="text-center">Notes</h4>
												<div style="overflow-y: auto; height: 220px;">
													<?php
														if($page->notes_data == ""){
															echo "No notes to show.";
														}

														/* If no notes, show  */
														if(count($notes_details_array) == 0){
															echo "No notes to show.";
													}else{
															/* Show each point notification in a foreach loop */
															$notes_details_array=array_reverse($notes_details_array);
															foreach($notes_details_array as $notes_details_object){
																	$border_color="primary";
																
													?>
												
											<div class=" shadow [ card ][ my-3 mr-2 p-3 ]" style="border-left:4px solid #ff8300;">
													<div class="[ d-contents justify-content-between ]">
															<div style="float:left">
																	<p class="mb-0" style="color:#0010ff;"><?=$notes_details_object->added_by;?></p>
																	<p><?=$notes_details_object->notes;?>  </p>
																	<sub class="notes_date" style="float:right;"><?=date("d M Y h:i",$notes_details_object->timestamp);?></sub>
															</div>
															
															<div style="float:right">
											
															</div>
													</div>
											</div>
											<?php
															}
													}
													
											?>
											</div>
											</div>
											<div class="add_notes_section pt-4">
												<h4 class="text-center">Add Notes</h4>
												<form id="notes_section_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-12">
																<div class="[  ][ form-group ]">
																	<label for="notes_text">Notes</label>
																	<textarea id="notes_text" name="notes_text" class="md-textarea form-control" rows="1" required></textarea>
																							
																	<div class="invalid-tooltip">
																		Please enter company name.
																	</div>
																</div>
														</div>
														<div class="text-center col-md-12 " >
															<button value="submit" id="btn_add_notes" name="btn_add_notes" class=" [ btn btn-primary ] " type="submit"  >
																Add
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- End notes section -->
								
							</div>
							<button type="button" id="more_filters_btn" class="btn btn-sm btn-outline-info text-center offset-md-2 more_filters_btn d-block m-auto " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction()">Add Notes</button>					
						</div>
						<!-- End Mobile view -->
					</div>
				</div>
				<!--menu-bar-->
			<!-- </div> -->

		<!-- </div> -->
	</div>

	<!-- <div style="margin-bottom: 255px;">

	</div> -->
	<!-- 
			sameesh@zerovega 27-feb-2021
						to add job list in candidate page
		 -->
		 
		 <?php  
		 $candidate_applied_jobs=false;
		    $candidate_all_jobs=$page->job_code;
		 	$candidate_jobs=explode(",",$page->job_code);
					$i=0;
                if($session->user_designation!="recruiter"){ ?>
		 <div class="row m-0">
		<div class="col-md-12 mb-5">
			<h2 class="text-center mt-1 "><span class="p-3">Applied Jobs</span></h2>
			<?php
			if($candidate_all_jobs!=""){
				?>
				<div class="text-center text-secondary">
    				To apply for more jobs, <a target="_blank" href=<?= $pages->get("name=jobs")->httpUrl()?>>click here</a>!
    				<br>
    			</div>
				<?php
			}
			?>
		</div>
	</div>
	<div>
		<?php
		//  echo count($candidate_jobs);
		//  print_r($candidate_jobs);
		//  echo "*******";
		if(count($candidate_jobs)!=0){
			foreach($candidate_jobs as $single_candidate_jobs){
				$job_page=$pages->get("name=jobs")->child("job_code=".$single_candidate_jobs.",verification=verified,active_status=active");
				// echo $job_page->id;
				// echo "++++++++++++";
				if($job_page->id==0){
					$card_height_styles="";
				}
				else{
					$card_height_styles="job_card_section";
					// echo "------";
				}
			}
		}
		else{
			$card_height_styles="";
		}
		// foreach($candidate_jobs as $single_candidate_jobs){
		// 	$job_page=$pages->get("name=jobs")->child("job_code=".$single_candidate_jobs.",verification=verified,active_status=active");
		// 	if($job_page->id==0)
		// 	{
		// 		$card_height_styles="";
		// 	}
		// 	else{
		// 		$card_height_styles="job_card_section";
		// 		// echo "------";
		// 	}
		// if(count($candidate_jobs)==0){
		// 		$card_height_styles="";
		// 		// echo "****";
		// 	}
		// }
		
		?>
		<div class="[ container col-xl-8 col-lg-10 col-md-12 col-sm-12 <?=$card_height_styles?> scrollable-element ]" style="margin-bottom: 5rem;">
			<div class="[ row ]">
				<?php
				// 	$candidate_jobs=explode(",",$page->job_code);
				// 	$i=0;
					$cards_filter="sort=-published";
					foreach($candidate_jobs as $single_candidate_jobs){
						$job_page=$pages->get("name=jobs")->child("job_code=".$single_candidate_jobs);
						if($job_page->verification=="verified" && $job_page->active_status=="active")
						{
							if($job_page->max_experience !=0 && isset($experience_years)){
								if($experience_years>$job_page->max_experience){
									continue;
								}
								
							}
				?>
				<div class="( job-card-container )[ my-3 ][ col-md-4 ]">
					<div class="[ card ]">
						<?php
					
						
							/* Add NEW badge for the first ten job postings */
							if(time()-$job_page->created <15*24*60*60){ 
						?>
					
						<span class="[ px-3 ][ badge badge-danger ]" style="position: absolute; right:41%; top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">NEW</span>
					
						<?php
							}
						?>

						<div class="card-body">
						    <!--
									Sameesh yadav for 6-march-2021
									to add image in card of jobs
								-->
							<div class="container p-0 m-0">
								<div class="row align-items-center" style="   height: 98px; ">
									<?php
									/**
									 * firt check if image in job page if null then add default vaue
									 * $image to store image url
									 */
									if ($job_page->job_image != null) {
										$image = $job_page->job_image->httpUrl;
									} else {
										$image =  $config->urls->templates ."images/Rise_logo_new.png";
									}
									?>
									<img src="<?= $image ?>" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
								</div>
							</div>
							<!-- 
									code ends here
								-->
							<h5 class="[ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=$job_page->title?></h5>

							<h6 class="[ mb-3 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> At <?=$job_page->company_name?>
								<br>
								Posted on <?=date("d M Y", $job_page->created)?>
							</h6>

							<p class="card-text"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i> <?=$job_page->min_experience?><?php if($job_page->max_experience!=0) echo "-".$job_page->max_experience?> Years<br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i> <?=$job_page->location?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $job_page->created)+date("H", time())?> Views Today</p>
					
							<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$job_page->job_code?></span></p>

							<hr>

							<div class="[ d-flex justify-content-center ]">
								<a href="<?=$job_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="[ card-link ][  btn btn-outline-primary ]">KNOW MORE</a>

								<!-- <div id="share-button-<?=$job_page->id?>" style="" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div>
								<button class="btn btn-outline-light text-primary " id="copy_link" data-toggle="tooltip"  title="abc"><i class="far fa-copy "></i> </button>
							<span class="tooltiptext">Tooltip text</span>
								<button class="btn btn-outline-light text-success " id="whatsapp_link"><i class="fa fa-whatsapp  "></i> </button> -->
							
							</div>
						</div>
					</div>
				</div>
		
		<?php
				$i++;
			}
						}
						if($i==0||count($candidate_jobs)==0){
							?>
							<div class="col-md-12 text-center text-secondary">
								You have not applied to any jobs yet.
								<br>
								Visit our <a target="_blank" href=<?= $pages->get("name=jobs")->httpUrl()?>>Jobs Page</a> and apply!
							</div>
							<?php
						}
						else{
							$candidate_applied_jobs=true;
						}
					}
		?></div>
		</div>
	</div>
	
	<!-- Registered events  -->
	<?php  
		 $candidate_applied_events=false;
		    $candidate_all_events=$page->event_code;
				// echo $candidate_all_events;
		 	$candidate_events=explode(",",$page->event_code);
			//  print_r($candidate_events);
			//  echo "+++++++++++++";
					$i=0;
                if($session->user_designation!="recruiter"){ ?>
		 <div class="row m-0">
		<div class="col-md-12 mb-5">
			<h2 class="text-center mt-1 "><span class="p-3">Registered Events</span></h2>
			<?php
			if($candidate_all_events!=""){
				?>
				<div class="text-center text-secondary">
    				To register for more events, <a target="_blank" href=<?= $pages->get("name=workshops")->httpUrl()?>>click here</a>!
    				<br>
    			</div>
				<?php
			}
			?>
		</div>
	</div>
	<div>
		<?php
			if(count($candidate_events)==0){
				$card_height_styles="";
				//echo "****";
			}
			else{
				$card_height_styles="job_card_section";
				//echo "++++++";
			}
		?>
		<div class="[ container col-xl-8 col-lg-10 col-md-12 col-sm-12 <?=$card_height_styles?> scrollable-element ]" style="margin-bottom: 5rem;">
			<div class="[ row ]">
				<?php
				// 	$candidate_jobs=explode(",",$page->job_code);
				// 	$i=0;
					$cards_filter="sort=-published";
					// print_r($candidate_events);
					// echo "**********";
					foreach($candidate_events as $single_candidate_events){
						$event_page=$pages->get("name=workshops")->child("event_code=".$single_candidate_events);
						// echo 	$event_page->id;
						if($event_page->id==0){
							continue;
						}
				?>
					<div class="( event-card-container )[ my-3 ][ col-md-4 ]">
						<div class="[ card ]">
							<div class="card-body">
								<h5 class="[ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=$event_page->title?></h5>
								<h6 class="[ mb-3 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> Facilitated By <?=$event_page->event_facilitated_by?></h6>

								<p class="card-text">
									<i class="[ mr-1 ][ text-info ][ fas fa-fw fa-calendar-day ]"></i>
									<?php
										echo date("d M Y", $event_page->event_start_date);
										
										if((int)$event_page->event_end_date > 0){
											echo " - ".date("d M Y", $event_page->event_end_date);
										} 
									?>

									<br>

									<i class="[ mr-1 ][ text-info ][ text-center ] fas fa-fw fa-clock"></i>
									<?=$event_page->event_start_time." - ".$event_page->event_end_time?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i>
									<?=$event_page->location?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-user"></i>
									For <?=$event_page->event_who_can_attend?>
								</p>

								<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$event_page->event_code?></span></p>
								<hr>
								<div class="[ d-flex justify-content-center ]">
									<a href="<?=$event_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="[ card-link ][ text-primary btn btn-outline-light ]">KNOW MORE</a>

									<!-- <div id="share-button-<?=$event_page->id?>" class=" need-share-button" data-share-share-button-class="custom-button" data-share-networks="mailto,twitter,facebook,linkedin" data-share-position="middleLeft">
										<span class="custom-button [ card-link ][ text-info btn btn-outline-light ]"><i class="fas fa-share-alt"></i></span>
									</div> -->

									<!-- <div id="share-button-<?=$event_page->id?>" style="margin-right: -10px" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="centerLeft" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div> -->
								</div>
							</div>
						</div>
					</div>
		
		<?php
				$i++;
			}
						if($i==0||count($candidate_events)==0){
							?>
							<div class="col-md-12 text-center text-secondary">
								You have not registered for any events yet.
								<br>
								Visit our <a target="_blank" href=<?= $pages->get("name=workshops")->httpUrl()?>>Events Page</a> and register!
							</div>
							<?php
						}
						else{
							$candidate_applied_events=true;
						}
					}
		?></div>
		</div>
	</div>	
	<!-- End Registered events -->

	</div>
	</div>
			<!-- sameesh@zerovega code ends here -->
	<!--<script src="<?=$config->urls->templates; ?>scripts/<?=$page->template;?>.js"></script>-->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script>

	<script>
		function myFunction() {
			var x = document.getElementById("more_filters_btn");
			if (x.innerHTML === "Add Notes") {
				x.innerHTML = "Hide Notes";
			} else {
				x.innerHTML = "Add Notes";
			}
		}
  
  // function myFunction_demo() {
  //   var x = document.getElementById("more_filters_btn_web");
  //   if (x.innerHTML === "Notes") {
  //     x.innerHTML = "Hide Notes";
  //   } else {
  //     x.innerHTML = "Notes";
  //   }
  // }
	</script>
<?php
require $config->paths->templates.'includes/sticky-footer.php';
?>

<?php
require $config->paths->templates.'includes/footer.php';
?>