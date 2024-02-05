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
 require_once(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/candidate_table_data.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	global $candidate_status_array;
	global $unlocked_profiles_candidate_id_array;
	$unlocked_profiles_candidate_id_array=Array();
	// echo $session->oauth_gmail;
	// echo "candidate profie";
	// echo \ProcessWire\wire("session")->user_page_id;
	// echo "session";
	/* Function to check for the editor:  the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_editor_unlocked_array(){
		/* Get the current editor's page */
		$editor_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		// $editor_page->of(false);

		/* Get the current favourite profiles array */
		$unlocked_profiles_array_to_save=array();
		// $editor_page->unlocked_profiles_array=".$editor_page->unlocked_profiles_array.";
		$unlocked_profiles_array_to_save = json_decode($editor_page->unlocked_profiles_array, true);
		// print_r($unlocked_profiles_array_to_save);

		// print_r($unlocked_profiles_array);
		// echo "--------------------------";

		/* Array to save just the unlocked page IDs without the timestamp */
		$unlocked_profiles_array = Array();
			// echo "--------------------";
		/* Go through the object array to see if time limit on unlocked profiles exceeds. Remove the element if it does. */
		foreach($unlocked_profiles_array_to_save as $key=>$value){
			// echo $key;
			// echo "///";
			// echo $value;
			$unlocked_profiles_array[]=$key;

		// // // 	/* if timestamp is more than 24Hrs old */
			// if(time() > $value+(24*60*60)){
			// 	unset($unlocked_profiles_array_to_save->$key);
			// 	// json_encode(array_values(array_diff(json_decode($editor_page->favourite_profiles_array), $profiles_to_unlock)));
			// }else{
			// 	// $unlocked_profiles_array = array_merge($unlocked_profiles_array, $value->unlocked_profiles_array);
			// 	$unlocked_profiles_array[]=$key;
			// }
		}

		/* Serialize the array */
		// $unlocked_profiles_array_to_save = array_values((array)$unlocked_profiles_array_to_save);

		// /* Save it to the page */
		// $editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array_to_save);
		// $editor_page->save();
		// 		echo "updated";
		// print_r($unlocked_profiles_array);
		/* Now returned the flattened array containing only unlcoked IDs */
		return $unlocked_profiles_array;
	}
	/* Function to check for the editor:  the unlocked array, delete expired profiles, return an array withonly IDs END */

	/* Function to check for the recruiter: the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_recruiter_unlocked_array(){
		/* Get the current recruiter's page */
		/**Check recruiter profile type is sub-recruiter or super-recruiter */
		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		}
	

		/* Get the current unlocked profiles array */
		$unlocked_profiles_object=Array();
		$unlocked_profiles_array = array();
		$unlocked_candidate_array_data=array();
		$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
		if(!empty($unlocked_profiles_object)){
			foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
				$unlocked_candidate_array_data[]=$single_unlocked_profiles_object_array;
				foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
					$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
			
				}
			}

			
		}
		
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
					// echo "present";
					$available_columns_to_show = $columns_for_admin;
					$available_columns_to_show['resume'] = 'Resume';
				// 	print_r($available_columns_to_show);
				// echo "editor";

				}
				// print_r($available_columns_to_show);
				// echo "****";
			break;

			case "admin":
				/* If default columns are requested, get them from the user's account. */
				$available_columns_to_show = $columns_for_admin;
				$available_columns_to_show['resume'] = 'Resume';
				// print_r($available_columns_to_show);
				// echo "Admin";
			break;

			case "recruiter":
				/* If default columns are requested, get them from the user's account. */
				$available_columns_to_show = $columns_for_recruiter;

				/* If this profile is unlocked, all information is available. Check if recruiter has page ID in unlocked profiles array in their account */
				if(in_array($page->id, fetch_recruiter_unlocked_array())){
					$available_columns_to_show = $unlocked_columns_for_recruiter;
					$available_columns_to_show['resume'] = 'Resume';

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
		$session->user_id=$page->id;
		
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
		$page_title = "Candidate Name Hidden";
		$profile_name = "Candidate Name Hidden";
	}
	/**if recruiter login present that time hide notes section */
	/**Only admin and editor add and review notes */
	$session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
	// $recruiter_page=$pages->get("name=recruiters")->child("id=".$session_user_id);
	/* Get the current recruiter's page */
	/**Check recruiter profile type is sub-recruiter or super-recruiter */
	if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
		$recruiter_user_id = $pages->get("id=".$session_user_id)->parent();
		$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
	}
	else{
		$recruiter_user_id = $pages->get("id=".$session_user_id);
		$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
	}
	
	$admin_page=$pages->get("name=admins")->child("id=".$session_user_id);
	$editor_page=$pages->get("name=editors")->child("id=".$session_user_id);
	if($admin_page->id!=0 || $editor_page->id!=0){
		$show_notes="d-none d-md-block d-lg-block";
		$show_mobile_notes="d-block d-sm-block d-md-none mt-1 mb-4";
		$hide_notes="col-md-6";
		$show_col="col-md d-none";
		$show_status="d-none d-md-none d-lg-none";
		$show_status_mobile="d-none d-sm-none d-md-none ";
	}
	elseif($recruiter_page->id!=0){
		$show_notes="d-none d-md-block d-lg-block";
		$show_mobile_notes="d-block d-sm-block d-md-none mt-1 mb-4";
		$hide_notes="col-md-6";
		$show_col="col-md d-none";
		$show_status="d-none d-md-block d-lg-block";
		$show_status_mobile="d-block d-sm-block d-md-none";
		// $show_notes="d-none d-md-none d-lg-none";
		// $show_mobile_notes="d-none d-sm-none d-md-none";
		// $hide_notes="col-md-8";
		// $show_col="col-md";
	}
	else{
		$show_notes="d-none d-md-none d-lg-none";
		$show_mobile_notes="d-none d-sm-none d-md-none mt-1 mb-4";
		$hide_notes="col-md-8";
		$show_col="col-md";
		$show_status="d-none d-md-none d-lg-none";
		$show_status_mobile="d-none d-sm-none d-md-none ";
	}

	/** In Candidates section - Add notes using Admin and Editor */
	if(isset($_POST["btn_add_notes"])){
		$candidate_notes_array=array();
		$notes=$sanitizer->textarea($input->post->notes_text);
		$candidate_notes_array[]=$notes;
		$notes_add_timestamp=strtotime(date("Y-m-d h:i:sa"));
		$candidate_notes_array[]=$notes_add_timestamp;
		$session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		$admin_page=$pages->get("name=admins")->child("id=".$session_user_id);
		$editor_page=$pages->get("name=editors")->child("id=".$session_user_id);
		// $recruiter_page=$pages->get("name=recruiters")->child("id=".$session_user_id);
		/* Get the current recruiter's page */
		/**Check recruiter profile type is sub-recruiter or super-recruiter */
		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
			$recruiter_user_id = $pages->get("id=".$session_user_id)->parent();
			$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
		}
		else{
			$recruiter_user_id = $pages->get("id=".$session_user_id);
			$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
		}
		$recruiter_page = $pages->get("id=".$session_user_id);
		if($admin_page->id!=0){
			$notes_added_by=$admin_page->id;
		}
		elseif($editor_page->id!=0){
			$notes_added_by=$editor_page->id;
		}
		elseif($recruiter_page->id!=0){
			$notes_added_by=$recruiter_page->id;
		}
		else{
			$notes_added_by="";
		}
		
		// echo $session_user_id;
		if($notes!=""){
			$candidate_notes_array[]=$notes_added_by;
			$candidates_notes_entry_object=new stdClass();
			$candidates_notes_entry_object->notes=$notes;
			$candidates_notes_entry_object->timestamp=$notes_add_timestamp;
			$candidates_notes_entry_object->added_by=$notes_added_by;
			// echo $notes_added_by;
			// echo "**********";
			// print_r($candidates_notes_entry_object);
			$candidates_notes_json=$page->notes_data;
			if($candidates_notes_json == ""){
				$candidates_notes_json='{"notes_details_array":[]}';
			}
			/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
			$candidates_notes_object = json_decode($candidates_notes_json);
			$candidates_notes_object->notes_details_array[] = $candidates_notes_entry_object;
			$page->notes_details_array = json_encode($candidates_notes_object);
			//  print_r($candidates_notes_object);
			//  echo "**********";
			//  echo $page->notes_details_array;
			$page->notes_data=$page->notes_details_array;
			$page->of(false);
			$page->save();
			header('Location: '.$page->httpUrl.'#notes_web_section');
		}
		// print_r($candidate_notes_array);
	}
	/** End In Candidates section - Add notes using Admin and Editor */

		/*** Add Candidate status using rescruiter panel */
		if(isset($_POST["btn_add_candidate_status"]) && $session->user_designation=="recruiter"){
			// echo "********";
			$session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
			// $recruiter_page=$pages->get("name=recruiters")->child("id=".$session_user_id);
			/* Get the current recruiter's page */
			/**Check recruiter profile type is sub-recruiter or super-recruiter */
			if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
				$recruiter_user_id = $pages->get("id=".$session_user_id)->parent();
				$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
			}
			else{
				$recruiter_user_id = $pages->get("id=".$session_user_id);
				$recruiter_page=$pages->get("name=recruiters")->child("id=".$recruiter_user_id->id);
			}
			$recruiter_page_notes_added = $pages->get("id=".\ProcessWire\wire("session")->user_page_id);
			if($input->post->candidate_status!=""){
				$candidate_status_input=$sanitizer->text($input->post->candidate_status);
				$candidates_status_json=$page->recruiter_candidate_status;
				if($candidates_status_json == ""){
					$candidates_status_json='{}';
				}
				/**Save candidate status for candidate status filter in table */
				$candidates_status_for_filter_json=$page->recruiter_candidate_status_for_filter;
				if($candidates_status_for_filter_json == ""){
					$candidates_status_for_filter_json='{}';
				}
				$recruiter_page_id=$recruiter_page_notes_added->id;
				$recruiter_page_id_for_filter=$recruiter_page->id;
				//  /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
				$candidates_status_object = json_decode($candidates_status_json);
				$candidates_status_object->$recruiter_page_id=$candidate_status_input;
				$page->recruiter_candidate_status = json_encode($candidates_status_object);

				$candidates_status_object_for_filter = json_decode($candidates_status_for_filter_json);
				$candidates_status_object_for_filter->$recruiter_page_id_for_filter=$candidate_status_input;
				$page->recruiter_candidate_status_for_filter = json_encode($candidates_status_object_for_filter);
	
					/**Save candidate status in notes section */
					$recruiter_candidates_notes_entry_object=new stdClass();
					$recruiter_candidates_notes_entry_object->notes="Status changed to : ".$candidate_status_input;
					$recruiter_candidates_notes_entry_object->timestamp=strtotime(date("Y-m-d h:i:sa"));
					$recruiter_candidates_notes_entry_object->added_by=$recruiter_page_notes_added->id;
					$candidates_notes_json=$page->notes_data;
					if($candidates_notes_json == ""){
						$candidates_notes_json='{"notes_details_array":[]}';
					}
					/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
					$candidates_notes_object = json_decode($candidates_notes_json);
					$candidates_notes_object->notes_details_array[] = $recruiter_candidates_notes_entry_object;
					$page->notes_details_array = json_encode($candidates_notes_object);
					$page->notes_data=$page->notes_details_array;
				$page->of(false);
				$page->save();
				header('Location: '.$page->httpUrl.'#candidate_status');


			}
	
		}
		/*** End Add Candidate status using rescruiter panel */


	/**Fetch candidates notes in notes section */
	 
	if($page->notes_data==""){
		$page->notes_data	='{"notes_details_array":[]}';
	}
/* Amruta Jagtap 2022-04-12 The following shows the timeline of all the points added to the referrer in a timeline. The dashboard is split into two sections. */

/* Get the array of all the points details that the referrer has earned */
		$sub_recruiter_array=array();
		$recruiter_page_notes_added = $pages->get("id=".\ProcessWire\wire("session")->user_page_id);
		$candidates_notes_object= json_decode($page->notes_data);
		//print_r($referrer_page->referrer_points);
		$notes_details_array = $candidates_notes_object->notes_details_array;
		
		$total_points=0;
		$filtered_notes_array=array();
		$notes_details_array=array_reverse($notes_details_array);
		
		// print_r($notes_details_array);
		// echo "***";
		// echo $recruiter_page->id;
		if($recruiter_page->id!=0){
				$sub_recruiter_array[].=$recruiter_page->id;
				foreach($pages->get($recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter){
					$sub_recruiter_array[].=$sub_recruiter->id;
				}
			// echo "---";
			// print_r($sub_recruiter_array);
			if(!empty($sub_recruiter_array)){
				// echo "if";
				foreach($notes_details_array as $notes_details_object){
					foreach($sub_recruiter_array as $single_sub_recuiter_id){
						if($single_sub_recuiter_id==$notes_details_object->added_by){
						
							// if($pages->get("id=".\ProcessWire\wire("session")->user_page_id)==$notes_details_object->added_by){
								$filtered_notes_array[]=$notes_details_object;
								
							} 
							else{
								continue;
							}
					}
				}
			}
			
		}
		else{
			$filtered_notes_array=$notes_details_array;
		}
		// echo "--------";
		// print_r($filtered_notes_array);
	/**ENd Fetch candidates notes in notes section */


	/*** Fetch candidate status in recruiter panel */
		if($session->user_designation=="recruiter"){
			$recruiter_candidate_status=$page->recruiter_candidate_status;
			$candidate_status_array=json_decode($recruiter_candidate_status);
			// print_r($candidate_status_array);
		}
	/*** End Fetch candidate status in recruiter panel */




?>

<!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<script>
		// window.dataLayer = window.dataLayer || [];
		// function gtag(){dataLayer.push(arguments);}
		// gtag('js', new Date());

		// gtag('config', 'UA-155220702-1');
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
	<?php
	if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
	?>
	<style>
		.candidate_profile_header_banner{
			margin-top:4.3rem;
		}
		@media (max-width:768px){
			.candidate_profile_header_banner{
				margin-top:4.9rem;
			}
		}
	</style>
	<?php
		}
	?>
</head>

<body>
	<?php
	if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
 require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
	?>
	<div id="top-container" class="candidate_profile_header_banner">
		<!-- <img src="<?=$urls->httpTemplates;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$urls->httpTemplates;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

		<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[ w-100 img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[ w-100 img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<div class="container">
		<!-- <div class="row"> -->
			
			<!-- <div class="col-md-7"> -->

				<?php
				// echo $page->active_status;
				// echo "****";
					if($page->active_status=="active" || $page->active_status=="Active"){
						// $active="d-none";
					}
					else{
						?>
						<div class="row verification_steps_section">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="accordion" id="accordionExample">
									<div class="card verification_steps_card">
											<button class="btn btn-outline-danger btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												<i class="fa fa-bell"></i> Your account verification is pending. Click here to know more.
											</button>
										<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
											<div class="card-body candidate-verification-steps" >
												<?=$pages->get("name=candidates")->rich_textarea_1;?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>
				<?php
					}
				?>
				
				
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
					<div class="col-sm-12 col-md-4 mt-1 text-center d-md-flex flex-md-column">
						<div>
							<?php
							// echo $recruiter_page->id;
							// echo "---";
							// echo $page->id;
							// echo $page->recruiter_candidate_status;
							global $candidate_status;
							$candidate_status_array=Array();
								if($recruiter_page->id!=0){
									$super_recruiter_page=\ProcessWire\wire("pages")->get($recruiter_page->id);
									$favourite_profile_array= json_decode($super_recruiter_page->favourite_profiles_array);
									foreach($favourite_profile_array as $single_favourite_profiles_array){
										foreach($single_favourite_profiles_array as $single_favourite_profiles_data){
											$favourite_profile_id_array[]=$single_favourite_profiles_data->candidate_profile_id;
										}
									}
									if(!empty($favourite_profile_id_array)){
										if(in_array($page->id,$favourite_profile_id_array)){
											$candidate_status_array[]="Favourite";
										}
									}
									
									// print_r($unlocked_profiles_candidate_id_array);
									// echo "***";

									// $unlocked_profiles_candidate_object=Array();
									$unlocked_profiles_candidate_array = json_decode($super_recruiter_page->unlocked_profiles_array);
									// print_r($unlocked_profiles_candidate_array);
									// echo "---";
									if(!empty($unlocked_profiles_candidate_array)){
										foreach($unlocked_profiles_candidate_array as $single_unlocked_profiles_object_array){
											// print_r($single_unlocked_profiles_object_array);
											foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
												// print_r($single_unlocked_profile_array);
												$unlocked_profiles_candidate_id_array[]=$single_unlocked_profile_array->candidate_profile_id;
												// print_r($unlocked_profiles_candidate_id_array);
												
												
											}
										}
										if(in_array($page->id,$unlocked_profiles_candidate_id_array)){
											// echo "true";
											$candidate_status_array[]="Unlocked";
										}
									}
									

									if($page->recruiter_candidate_status!=""){
										$latestNote = null;
										$latestTimestamp = 0;
										foreach($filtered_notes_array as $single_notes_array){
											// if(in_array($single_notes_array->added_by,$sub_recruiter_array)){

											// }
											$word = "Status changed to :";
											$favourite_word="Status changed to : Favourited";
											$unlocked_word="Status changed to : Unlocked";
											if(($single_notes_array->timestamp > $latestTimestamp) && (strpos($single_notes_array->notes, $word) !== false)) {
												if((strpos($single_notes_array->notes, $favourite_word) !== false) || (strpos($single_notes_array->notes, $unlocked_word) !== false)){
													continue;
												}
												else{
													$latestNote = $single_notes_array;
													$latestTimestamp = $single_notes_array->timestamp;
												}
											}
										}
										if ($latestNote !== null) {
											$candidate_status=substr($latestNote->notes, strpos($latestNote->notes, ":") + 2);
											$candidate_status_array[]=$candidate_status;
										} else {
											// echo "No value found.";
										}
										
										
																		
									}
									// print_r($candidate_status_array);
									foreach($candidate_status_array as $candidate_filter_status){
									?>
									<span id="candidate-status-badge" class="badge badge-pill badge-danger text-white bg-ngo px-2 py-1 mb-4 mr-2 border-ngo"><?=$candidate_filter_status?></span>
									<?php
									}
								}
							?>
							<!-- <span id="candidate-status-badge" class="badge badge-pill badge-primary text-white bg-ngo px-2 py-1 mb-4 mr-2 border-ngo"><?=$reccruiter_candidate_status?></span> -->
						</div>
						<h1 id="profile-name" class="">
							<strong><?=$profile_name?></strong>
						</h1>
						<div class="[ text-muted mb-3 ]">ID: <?=$page->serial_id?></div>

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

								if($page->resume==""){
									$resume="#";
								}
								else{
									$resume=$page->resume->url;
								}
						?>

						

						<div>
							<a href="<?=$resume?>"><button type="button" class="[ px-3 ][ btn btn-primary ]">Download Resume</button></a>
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

							<!-- Removed for ticketing closing -->
					<!-- <hr>
						
						<div>
								<div class="card card_job_fair" style="background: #191B21;">
																<div class="card-body">
																		<div class="card-title">
																				<h3 class="text-center text-white" style="font-family: 'Poppins', sans-serif;font-weight: 600">RISE 2023 Job Fair</h3>
																				<h5 class="text-center text-white" style="font-family: 'Poppins', sans-serif;font-weight: 600">06<sup>th</sup> May 2023<h5>
																				
																			<div class="text-center">
																			
																					<a target="_blank" href="<?=$pages->get("name=job-fair")->httpUrl;?>">
																							<button class=" text-center btn_ticket_job_fair" >Get your FREE pass</button>
																					</a>
																			</div>
																		
																	</div>
															</div>
												</div>
										
						</div> -->
			    <!-- Removed for ticketing closing -->
					</div>
					

					<div class="col-md">
							
							

					</div>


					<!--introduction part end-->
				</div>
				<!--menu-bar-->
				<div class="row" id="notes_web_section">
					<div class="<?=$show_col?>">
					</div>
						<div class="col-md-6 col-md <?=$show_notes?> web_view">
									<!-- notes section -->
									<div class="">
										<div class="card border-left-warning   my-5 []">
											<div class="card-body">
												<div id="referrer_points_details_container" >
													<h4 class="text-center">Notes</h4>
													<div class="notes_overflow_section" style="overflow-y: auto; ">
														<?php
															if($page->notes_data == ""){
																echo "<h3 class='text-center' style='color:#f00c0c;'>No notes available.</h3>";
															}

																/* If no notes, show  */
																if(count($filtered_notes_array) == 0){
																	echo "<h3 class='text-center' style='color:#f00c0c;'>No notes available..</h3>";
																}else{
																	/* Show each point notification in a foreach loop */
																	// print_r($filtered_notes_array);
																	foreach($filtered_notes_array as $single_notes_detail){

																		$admin_page=$pages->get("name=admins")->child("id=".$single_notes_detail->added_by);
																		$editor_page=$pages->get("name=editors")->child("id=".$single_notes_detail->added_by);
																		// echo "admin";
																		// echo $admin_page->id;
																		// echo "editor";
																		// echo $editor_page->id;

																		// $recruiter_page=$pages->get("name=recruiters")->child("id=".$single_notes_detail->added_by);
																		/* Get the current recruiter's page */
																		/**Check recruiter profile type is sub-recruiter or super-recruiter */
																	
																		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
																			$recruiter_parent_page = $pages->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();

																			$recruiter_page=$pages->get("id=".\ProcessWire\wire("session")->user_page_id)->parent()->child("id=".$single_notes_detail->added_by);
																			$recruiter_page=$pages->get("id=".$single_notes_detail->added_by);
																			// echo "sub recruiter";
																			// echo $recruiter_page->id;
																		}
																		else{
																			$recruiter_parent_page = $pages->get("id=".\ProcessWire\wire("session")->user_page_id);
																			$recruiter_page=$pages->get("id=".\ProcessWire\wire("session")->user_page_id)->child("id=".$single_notes_detail->added_by);
																			$recruiter_page=$pages->get("id=".$single_notes_detail->added_by);
																			// echo "super recruiter";
																			// echo $recruiter_page->id;
																		}
																		
																		if($admin_page->id!=0){
																			$notes_added_by=$admin_page->title;
																			$border_color="#ff8300";
																			$text_color="#ff8300";
																		}
																		elseif($editor_page->id!=0){
																			$notes_added_by=$editor_page->title;
																			$border_color="#ff8300";
																			$text_color="#ff8300";
																		}
																		elseif($recruiter_page->id!=0){
																			$border_color="#0010ff";
																			$text_color="#0010ff";
																			$notes_added_by=$recruiter_page->company_name." : ".$recruiter_page->title;
																			
																			// if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
																			// 	$notes_added_by=$recruiter_page->company_name;
																			// 	$border_color="#0010ff";
																			// 	$text_color="#0010ff";
																			// }
																			// else{
																			// 	$notes_added_by=$recruiter_page->company_name;
																			// 	$border_color="#ff8300";
																			// 	$text_color="#ff8300";
																			// }
																		}
																		else{
																			$notes_added_by="";
																			$border_color="#ff8300";
																			$text_color="#ff8300";
																		}
																		// echo "added by";
																		// echo $notes_added_by;
															
																	
														?>
													
												<div class=" shadow [ card ][ my-3 mr-2 p-3 ]" style="border-left:4px solid <?=$border_color?>;">
														<div class="[ ]">
																<div class="notes_content" style="width:100%;">
																		<p class="mb-0" style="color:<?=$text_color?>;"><?=$notes_added_by;?></p>
																		<p class="mb-0"><?=$single_notes_detail->notes;?>  </p>
																		
																</div>
																<div class="notes_date" style="float:right;font-size:12px;"><?=date("d M Y h:i A",($single_notes_detail->timestamp+ 60*60*5.50));?></div>
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
													<!-- <h4 class="text-center">Add Notes</h4> -->
													<form id="notes_section_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
														<div class="row">
															<div class="col-md-10">
																	<div class="[  ][ form-group ]">
																		<label for="notes_text">Add your note</label>
																		<textarea id="notes_text" name="notes_text" class="md-textarea form-control" rows="1" ></textarea>
																								
																		<div class="invalid-tooltip">
																			Please enter company name.
																		</div>
																	</div>
															</div>
															<div class="col-md-2 web_btn_add">
																<a href="<?=$page->httpUrl?>#notes_web_section">
																<button value="submit" id="btn_add_notes" name="btn_add_notes" class=" [ btn btn-primary ] " type="submit"  >
																	Add
																</button>
																</a>
															</div>
														</div>
														<div class="<?=$show_status?>">
															<div class="row ">
																<?php
																	/* If no candidate status, show  */
																if(empty($candidate_status_array)){
																	// echo "<h3 class='text-center' style='color:#f00c0c;'>No status available.</h3>";
																?>
																	<div class="col-md-10">
																	<p>Candidate Status: <span style="color:#f00c0c;">No status available.</span></p>																
																	</div>
																<?php
																}else{
																	$candidate_status="";
																	$sub_recruiter_array=array();
																	$session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	// $recruiter_page=$pages->get("name=recruiters")->child("id=".$session_user_id);
																	/* Get the current recruiter's page */
																	/**Check recruiter profile type is sub-recruiter or super-recruiter */
																	if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
																		$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
																	}
																	else{
																		$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	}
																	$recruiter_page_notes_added = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	$sub_recruiter_array[].=$recruiter_page->id;
																	foreach($pages->get($recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter){
																		$sub_recruiter_array[].=$sub_recruiter->id;
																	}
																	// foreach($candidate_status_array as $single_recruiter_id=>$single_candidate_status){
																	// 	if(!empty($sub_recruiter_array)){
																	// 		foreach($sub_recruiter_array as $single_sub_recruiter){
																	// 			if($single_sub_recruiter==$single_recruiter_id){
																	// 				$candidate_status=$single_candidate_status;
																	// 			}
																	// 			elseif(($recruiter_page->id)==$single_recruiter_id){
																	// 				$candidate_status=$single_candidate_status;
																	// 			}
																	// 			else{
																	// 				$candidate_status=$single_candidate_status;
																	// 			}
																	// 		}
																	// 	}
																	// }
																	// print_r($sub_recruiter_array);
																	// echo "recruiter";
																	// print_r($filtered_notes_array);
																	// echo "----";
																	$latestNote = null;
																	$latestTimestamp = 0;
																	foreach($filtered_notes_array as $single_notes_array){
																		// if(in_array($single_notes_array->added_by,$sub_recruiter_array)){

																		// }
																		$word = "Status changed to :";
																		$favourite_word="Status changed to : Favourited";
																		$unlocked_word="Status changed to : Unlocked";
																		if(($single_notes_array->timestamp > $latestTimestamp) && (strpos($single_notes_array->notes, $word) !== false)) {
																			if((strpos($single_notes_array->notes, $favourite_word) !== false) || (strpos($single_notes_array->notes, $unlocked_word) !== false)){
																				continue;
																			}
																			else{
																				$latestNote = $single_notes_array;
																				$latestTimestamp = $single_notes_array->timestamp;
																			}
																			
																		}
																	}
																	if ($latestNote !== null) {
																			$candidate_status=substr($latestNote->notes, strpos($latestNote->notes, ":") + 2);
																				// echo $candidate_status;
																				// echo "****";
																			} else {
																				// echo "No value found.";
																			}


																	
																?>
																<div class="col-md-10">
																	<p style="font-weight:bold;">Candidate Status: <?=$candidate_status?></p>																
																</div>
																<?php
																	}
																?>
															</div>
															<div class="row ">
																<div id="candidate_status"></div>
																<div class="col-md-4" style="max-width:25%;padding-right:0px;margin-right:0px;">
																	Change Status :
																</div>
																<div class="col-md-7">
																	<select class="form-select form-control" name="candidate_status" aria-label="Default select example">	
																		<option value="">
																		Change Candidate Status
																		</option>

																		<?php
																		foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
																			if ($candidate_status == $candidate_status->title){ ?>
																				<option  class="" value="<?=$candidate_status->title?>"  selected>
																					<?=$candidate_status->title?>
																				</option>
																			<?php }
																				else{ ?>
																					<option  class="" value="<?=$candidate_status->title?>">
																						<?=$candidate_status->title?>
																					</option>
																			<?php } ?>
																		<?php } ?>
																	</select>
																</div>
																<div class="col-md-2 ">
																	<a href="<?=$page->httpUrl?>#candidate_status">
																	<button value="submit" id="btn_add_candidate_status" name="btn_add_candidate_status" class=" [ btn btn-primary ] " type="submit"  >
																		Add
																	</button>
																	</a>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- End notes section -->
						</div>
					

					<div id="profile-details-container"  class="[ mt-5 ][ <?=$hide_notes?> ]" data-target="body" data-offset="0">
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
						<div id="applied_job"></div>
					</div>

					<div class="col-md" id="notes_mobile_section">
						<!-- Mobile view -->
						<div class="container <?=$show_mobile_notes?> mobile_view ">
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
															echo "<h3 class='text-center' style='color:#f00c0c;'>No notes available.</h3>";
														}

														/* If no notes, show  */
														if(count($filtered_notes_array) == 0){
															echo "<h3 class='text-center' style='color:#f00c0c;'>No notes available..</h3>";
													}else{
															/* Show each point notification in a foreach loop */
															foreach($filtered_notes_array as $single_notes_detail){

																$admin_page=$pages->get("name=admins")->child("id=".$single_notes_detail->added_by);
																$editor_page=$pages->get("name=editors")->child("id=".$single_notes_detail->added_by);
																// $recruiter_page=$pages->get("name=recruiters")->child("id=".$single_notes_detail->added_by);
																/* Get the current recruiter's page */
																/**Check recruiter profile type is sub-recruiter or super-recruiter */
																if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
																	$recruiter_parent_page = $pages->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
																	$recruiter_page=$pages->get("id=".\ProcessWire\wire("session")->user_page_id)->parent()->child("id=".$single_notes_detail->added_by);
																}
																else{
																	$recruiter_parent_page = $pages->get("id=".\ProcessWire\wire("session")->user_page_id);
																	$recruiter_page=$pages->get("id=".\ProcessWire\wire("session")->user_page_id)->child("id=".$single_notes_detail->added_by);
																}
																	
																	if($admin_page->id!=0){
																		$notes_added_by=$admin_page->title;
																		$border_color="#ff8300";
																		$text_color="#ff8300";
																	}
																	elseif($editor_page->id!=0){
																		$notes_added_by=$editor_page->title;
																		$border_color="#ff8300";
																		$text_color="#ff8300";
																	}
																	elseif($recruiter_page->id!=0){
																		$notes_added_by=$recruiter_page->company_name;
																		$notes_added_by=$recruiter_page->company_name." : ".$recruiter_page->title;
																		$border_color="#0010ff";
																		$text_color="#0010ff";
																	}
																	else{
																		$notes_added_by="";
																		$border_color="#ff8300";
																		$text_color="#ff8300";
																	}
																
													?>
												
											<div class=" shadow [ card ][ my-3 mr-2 p-3 ]" style="border-left:4px solid <?=$border_color?>;">
													<div class="[ d-contents justify-content-between ]">
															<div style="float:left">
																	<p class="mb-0" style="color:<?=$text_color?>;"><?=$notes_added_by;?></p>
																	<p><?=$single_notes_detail->notes;?>  </p>
																	<sub class="notes_date" style="float:right;"><?=date("d M Y h:i A",($single_notes_detail->timestamp+ 60*60*5.50));?></sub>
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
												<!-- <h4 class="text-center">Add Notes</h4> -->
												<form id="notes_section_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-12">
																<div class="[  ][ form-group ]">
																	<label for="notes_text">Add your note</label>
																	<textarea id="notes_text" name="notes_text" class="md-textarea form-control" rows="1" ></textarea>
																							
																	<div class="invalid-tooltip">
																		Please add your note.
																	</div>
																</div>
														</div>
														<div class="text-center col-md-12 " >
															<a href="<?=$page->httpUrl?>#notes_mobile_section">
																<button value="submit" id="btn_add_notes" name="btn_add_notes" class=" [ btn btn-primary ] " type="submit"  >
																	Add
																</button>
															</a>
														</div>
													</div>
														<div class="<?=$show_status_mobile?>">
															<div class="row candidate_status_mobile" id="candidate_status_mobile_section">
															<?php
																	/* If no candidate status, show  */
																if(empty($candidate_status_array)){
																	// echo "<h3 class='text-center' style='color:#f00c0c;'>No status available.</h3>";
																?>
																	<div class="col-md-10">
																	<p>Candidate Status: <span style="color:#f00c0c;">No status available.</span></p>																
																	</div>
																<?php
																}else{
																	$sub_recruiter_array=array();
																	$session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	// $recruiter_page=$pages->get("name=recruiters")->child("id=".$session_user_id);
																	/* Get the current recruiter's page */
																	/**Check recruiter profile type is sub-recruiter or super-recruiter */
																	if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
																		$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
																	}
																	else{
																		$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	}
																	$recruiter_page_notes_added = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
																	$sub_recruiter_array[].=$recruiter_page->id;
																	foreach($pages->get($recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter){
																		$sub_recruiter_array[].=$sub_recruiter->id;
																	}
																	// foreach($candidate_status_array as $single_recruiter_id=>$single_candidate_status){
																	// 	if(!empty($sub_recruiter_array)){
																	// 		foreach($sub_recruiter_array as $single_sub_recruiter){
																	// 			if($single_sub_recruiter==$single_recruiter_id){
																	// 				$candidate_status=$single_candidate_status;
																	// 			}
																	// 		}
																		
																	// 	}
																		
																	// }

																	$latestNote = null;
																	$latestTimestamp = 0;
																	foreach($filtered_notes_array as $single_notes_array){
																		// if(in_array($single_notes_array->added_by,$sub_recruiter_array)){

																		// }
																		$word = "Status changed to :";
																		$favourite_word="Status changed to : Favourited";
																		$unlocked_word="Status changed to : Unlocked";
																		if(($single_notes_array->timestamp > $latestTimestamp) && (strpos($single_notes_array->notes, $word) !== false)) {
																			if((strpos($single_notes_array->notes, $favourite_word) !== false) || (strpos($single_notes_array->notes, $unlocked_word) !== false)){
																				continue;
																			}
																			else{
																				$latestNote = $single_notes_array;
																				$latestTimestamp = $single_notes_array->timestamp;
																			}
																			
																		}
																	}
																	if ($latestNote !== null) {
																		$candidate_status=substr($latestNote->notes, strpos($latestNote->notes, ":") + 2);
																		// echo $candidate_status;
																		// echo "****";
																	} else {
																		// echo "No value found.";
																	}
																
																		
																?>
																<div class="col-md-12">
																	<div class="form-group">
																		<p style="font-weight:bold;">Candidate Status: <?=$candidate_status?></p>
																	</div>
																</div>
																<?php
																	}
																?>
																
															</div>
															<div class="row ">
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="notes_text">Change Status </label>
																		<select class="form-select form-control" name="candidate_status" aria-label="Default select example">	
																			<option value="">
																			Change Candidate Status
																			</option>

																			<?php
																			foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
																				if ($candidate_status == $candidate_status->title){ ?>
																					<option  class="" value="<?=$candidate_status->title?>"  selected>
																						<?=$candidate_status->title?>
																					</option>
																				<?php }
																					else{ ?>
																						<option  class="" value="<?=$candidate_status->title?>">
																							<?=$candidate_status->title?>
																						</option>
																				<?php } ?>
																			<?php } ?>
																		</select>
																	</div>
																</div>
																<div class="text-center col-md-12 " >
																	<a href="<?=$page->httpUrl?>#candidate_status_mobile_section">
																		<button value="submit" id="btn_add_candidate_status" name="btn_add_candidate_status" class=" [ btn btn-primary ] " type="submit"  >
																			Add
																		</button>
																	</a>
																</div>
															</div>
														</div>

												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- End notes section -->
								
							</div>
							<button type="button" id="more_filters_btn" class="btn btn-sm btn-outline-info text-center offset-md-2 more_filters_btn d-block m-auto bg-primary  " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction()" style="color:white;width:100%;font-weight:bold;">Add Notes</button>					
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
		 <div class="row m-0" >
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
		<div id="applied_event"></div>
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

	});

	function myFunction() {
    var x = document.getElementById("btn_candidate_verification_process");
    if (x.innerHTML === "Verification Steps") {
      x.innerHTML = "Hide Verification Steps";
    } else {
      x.innerHTML = "Verification Steps";
    }
  }
</script>
<?php
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/sticky-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>

<?php
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>