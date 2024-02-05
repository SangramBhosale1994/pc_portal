<?php
include 'includes/send_mail_ticketing.php';

// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}
//$homepath = $urls->httpRoot."resume/";
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();

	/* Errors and messages to show to the client. This is handles by Js in frontend */
	$to_return->error = new stdClass();
	$to_return->error->number_of_errors = 0;
	$to_return->error->error_message = "";
	/* Errors and messages to show to the client. This is handles by Js in frontend END */

	/* Success Messages to show to the client. This is handles by Js in frontend */
	$to_return->success = new stdClass();
	$to_return->success->success_status = false;
	$to_return->success->success_message = "";
	/* Success Messages to show to the client. This is handles by Js in frontend END */

	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Managing Errors and error message in case no message has been logged */
		if($to_return->error->number_of_errors > 0 && $to_return->error->error_message == ""){
			$to_return->error->error_message = "Something went wrong, please refresh the page and try again.";
		}
		/* Managing Errors and error message END */

		/* Managing Success message in case no message has been logged */
		if($to_return->success->success_status == true && $to_return->success->success_message == ""){
			$to_return->success->success_message = "Task completed successfully.";
		}
		/* Managing Success message in case no message has been logged END */

		/* Display output as a JSON string */
		echo json_encode($to_return);
		/* Display output as a JSON string END */

		exit();
	}
	/* function to end the API call at any moment and display the outputs */

	// /* If the request is done without proper log in, exit */
	// if(!in_array($session->user_designation, ["admin"])){
	// 	$to_return->error->number_of_errors++;
	// 	$to_return->error->error_message  = "Please log in again and try.";
	// 	end_and_return();
	// }

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_job_fair_request_table_data", "unverify_profiles", "verify_profiles","multiple_profile_unverify","multiple_profile_verify"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_job_fair_request_table_data":
			fetch_job_fair_request_table_data();
			end_and_return();
		break;

		case 'verify_profiles':
			/* Save the data sent from the form */
			$requested_job_fair_to_verify = $input->post("requested_job_fair_to_verify", "text", false);

			if(!$requested_job_fair_to_verify){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			verify_profiles($requested_job_fair_to_verify);
			end_and_return();
		break;
		
		case 'unverify_profiles':
			/* Save the data sent from the form */
			$requested_job_fair_to_unverify_profiles = $input->post("requested_job_fair_to_unverify_profiles", "text", false);

			if(!$requested_job_fair_to_unverify_profiles){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unverify_profiles($requested_job_fair_to_unverify_profiles);
			end_and_return();
		break;

		case 'multiple_profile_verify':
			/* Save the data sent from the form */
			$requested_profiles_to_verify_json = $input->post("requested_profiles_to_verify_json", "text", false);

			if(!$requested_profiles_to_verify_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_verify($requested_profiles_to_verify_json);
			end_and_return();
		break;

		case 'multiple_profile_unverify':
			/* Save the data sent from the form */
			$requested_profiles_to_unverify_json = $input->post("requested_profiles_to_unverify_json", "text", false);

			if(!$requested_profiles_to_unverify_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_unverify($requested_profiles_to_unverify_json);
			end_and_return();
		break;
		
// 		case 'subusers_list':
// 			/* Save the data sent from the form */
// 			$sub_user_modal_form_details = $input->post("sub_user_modal_form_details", "text", false);

// 			if(!$sub_user_modal_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}
// 			subusers_list($sub_user_modal_form_details);
// 			end_and_return();
// 		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	function fetch_job_fair_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$job_fair_data_array = Array();
		//$job_fair_lgbt_verified_data_array = Array();
		$job_fair_lgbt_unverified_data_array = Array();
		$job_fair_applicants_data_array = Array();
		$job_fair_pass_verified_data_array = Array();
		$job_fair_pass_unverified_data_array= Array();
		
// 	 $company_admin_profile = 	wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
//$universal_profiles_page=wire('pages')->get('name=universal-profiles');
	$serial_counter=1;   
		foreach(wire('pages')->get("name=pass-applicants")->children("sort=published") as $job_fair_page) {
			//$company_page_title=$sanitizer->selectorValue($company_page->title);
		    $candidate_job_fair_verified_profile = wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
		    
		     $candidate_job_fair_unverified_profile = wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
		  //   echo "************";
		  //   echo $candidate_lgbt_unverified_profile;
		     
		    $candidate_job_fair_profile = wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
		    //echo $candidate_profile;
		   //$company_admin_profile = wire('pages')->get("name=universal-profiles")->child('company_name='.$company_page_title);
		//foreach(wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title) as $company_admin_profile){
		    //print_r($company_admin_profile);
		   // echo "1";
		    //echo $company_admin_profile;
		   //echo $company_admin_profile->title;
		    //print_r($company_admin_profile->title);
		   // echo "2";
		   // }
		   
		//    if($candidate_lgbt_verified_profile->id!=0 && $job_fair_page->pass_verification=="unverified" ){
		//        /* Each candidate's data is to be saved in a seperate object */
    // 			$job_fair_data = new stdClass();
    
    // 			/* Create array if favourites are empty */
    // // 			if($job_fair_page->verified == ""){
    // // 				$job_fair_page->verified == "unverified";
    // // 			}
    
    // 			$job_fair_data->id = $job_fair_page->id;
    // 			$job_fair_data->name = $job_fair_page->title;
    // 			$job_fair_data->email = $job_fair_page->email;
    // 			$job_fair_data->phone_country_code = $job_fair_page->phone_country_code;
    // 			$job_fair_data->phone_number = $job_fair_page->phone_number;
    // 			$job_fair_data->pronoun = $job_fair_page->pronoun;
    // 			$job_fair_data->registration_time=$job_fair_page->published +  60*60*5.50;
    // 			$job_fair_data->registration_time=date('d/m/Y h:i A', $job_fair_data->registration_time);
    // 			$job_fair_data->serial_number=$serial_counter;
    // 			$serial_counter++;
    // // 			$company_data->employee_count = $company_page->employee_count;
    // // 			$company_data->industry = $company_page->industry;
    // 			// $company_data->company_open_participation = $company_page->company_open_participation;
    
    // 			// $company_data->submission_confirmation = $company_page->submission_confirmation;
    
    // 			// if($company_data->submission_confirmation == ""){
    // 			// 	$company_data->submission_confirmation = "-";
    // 			// }else{
    // 			// 	$company_data->submission_confirmation = "<strong class='[ text-danger ]'>". $company_data->submission_confirmation ."</strong>";
    // 			// }
    
    // 			/* Other column data in the table */
    // 			$job_fair_data->verify_button = "<button id='".$job_fair_page->id."_verify_button' class='[ btn btn-primary ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";
    			
		// 	/* Show button to mark the survey */
		// 	//$company_data->marking_button = "<a target='_blank' href='".wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

		// 	/* If nothing to be unlocked, hide button */
		// 	if($job_fair_page->pass_verification== "verified"){
		// 		$job_fair_data->verify_button = "-";
		// 	}

		// 	/* Save the editor data object into the main array of all the editor data */
		// 	array_push($job_fair_lgbt_verified_data_array, $job_fair_data);
		
		//    }
		   
		   if($candidate_job_fair_profile->id!=0 && $job_fair_page->pass_verification=="" ){
				// $serial_counter=1;
						/* Each candidate's data is to be saved in a seperate object */
						$candidate_page=wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
						$job_fair_data = new stdClass();
			
						$job_fair_data->id = $job_fair_page->id;
						$job_fair_data->name = $job_fair_page->title;
						$job_fair_data->email = $job_fair_page->email;
						$job_fair_data->identify_as = $candidate_page->identify_as;
						if($candidate_page->experience_months=="" && $candidate_page->experience_years!=""){
							$candidate_page->experience_months=0;
							$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
						}
						else if($candidate_page->experience_months!="" && $candidate_page->experience_years==""){
								$candidate_page->experience_years=0;
								$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
						}
						else if($candidate_page->experience_months=="" && $candidate_page->experience_years=="")
						{
								$candidate_page->experience_years=0;
								$candidate_page->experience_months=0;
								$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
						}
						else{
								
							$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
						}
						$job_fair_data->location = $candidate_page->current_city;
						$job_fair_data->lgbtq_verification = $candidate_page->lgbtq_verification;
						$job_fair_data->active_status = $candidate_page->active_status;
						$job_fair_data->phone_country_code = $job_fair_page->phone_country_code;
						$job_fair_data->phone_number = $job_fair_page->phone_number;
						$job_fair_data->pronoun = $job_fair_page->pronoun;
						$job_fair_data->registration_time=$job_fair_page->published +  60*60*5.50;
						$job_fair_data->registration_time=date('d/m/Y h:i A', $job_fair_data->registration_time);
						$job_fair_data->serial_number=$serial_counter;
						$serial_counter++;
						
						/* Other column data in the table */
						$candidate_job_fair_unverified_profile=$candidate_job_fair_unverified_profile->id;
						$candidate_job_fair_verified_profile=$candidate_job_fair_verified_profile->id;
						//echo $candidate_lgbt_unverified_profile  http://zerovaega.in/pc_rportal/resume/edit-application/;
									// $candidate_edit_page=$pages->get() 
						      $candidate_edit_application=wire('pages')->get("name=edit-application")->httpUrl;
						      //echo $candidate_edit_application;
						// if($candidate_lgbt_unverified_profile!=0){
						// 	$job_fair_data->edit = "<a target='_blank' href='$candidate_edit_application?page_id=$candidate_lgbt_unverified_profile'><button  class='[ btn btn-primary ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-eye ]'></i>Edit</button></a>";
						// }
						// else{
						// 	$job_fair_data->edit = "<a target='_blank' href='$candidate_edit_application?page_id=$candidate_lgbt_verified_profile'><button  class='[ btn btn-primary ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-eye ]'></i>Edit</button></a>";
						// }
						$candidate_id=$candidate_page->id;
						$job_fair_data->edit = "<a target='_blank' href='$candidate_edit_application?page_id=$candidate_id'><button  class='[ btn btn-primary ](  )' type='button'><i class='[ mr-2 ][ fas fa-eye ]'></i>Edit</button></a>";

						/* Other column data in the table */
						$job_fair_data->verify_button = "<button id='".$job_fair_page->id."_verify_button' class='[ btn btn-outline-success ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Accept</button>";
						$job_fair_data->unverify_button = "<button id='".$job_fair_page->id."_unverify_button' class='[ btn btn-outline-danger ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-times ]'></i>Reject</button>";
						$job_fair_data->selectbox = "<input id='".$job_fair_page->id."_checkbox' class='applicant_checkbox' type='checkbox'>";

					/* Save the editor data object into the main array of all the editor data */
					array_push($job_fair_applicants_data_array, $job_fair_data);
			
		   }
		   
		    if($job_fair_page->id!=0 && $job_fair_page->pass_verification=="verified"){
					// $serial_counter=1;
		       /* Each candidate's data is to be saved in a seperate object */
    			$job_fair_data = new stdClass();
    
    			/* Create array if favourites are empty */
					// 			if($job_fair_page->verified == ""){
					// 				$job_fair_page->verified == "unverified";
					// 			}
					$candidate_page=wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
					$to_return->candidate_page=$candidate_page->identify_as;
    			$job_fair_data->id = $job_fair_page->id;
    			$job_fair_data->name = $job_fair_page->title;
    			$job_fair_data->email = $job_fair_page->email;
					$job_fair_data->identify_as = $candidate_page->identify_as;
					if($candidate_page->experience_months=="" && $candidate_page->experience_years!=""){
						$candidate_page->experience_months=0;
					 $job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else if($candidate_page->experience_months!="" && $candidate_page->experience_years==""){
							$candidate_page->experience_years=0;
						$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else if($candidate_page->experience_months=="" && $candidate_page->experience_years=="")
					{
							$candidate_page->experience_years=0;
							$candidate_page->experience_months=0;
							$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else{
							
						$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					$job_fair_data->location = $candidate_page->current_city;
					$job_fair_data->lgbtq_verification = $candidate_page->lgbtq_verification;
					$job_fair_data->active_status = $candidate_page->active_status;
    			$job_fair_data->phone_country_code = $job_fair_page->phone_country_code;
    			$job_fair_data->phone_number = $job_fair_page->phone_number;
    			$job_fair_data->pronoun = $job_fair_page->pronoun;
    			$job_fair_data->registration_time=$job_fair_page->published +  60*60*5.50;
    			$job_fair_data->registration_time=date('d/m/Y h:i A', $job_fair_data->registration_time);
    			$job_fair_data->serial_number=$serial_counter;
    			$serial_counter++;
					// 			$company_data->employee_count = $company_page->employee_count;
					// 			$company_data->industry = $company_page->industry;
    			// $company_data->company_open_participation = $company_page->company_open_participation;
    
    			// $company_data->submission_confirmation = $company_page->submission_confirmation;
    
    			// if($company_data->submission_confirmation == ""){
    			// 	$company_data->submission_confirmation = "-";
    			// }else{
    			// 	$company_data->submission_confirmation = "<strong class='[ text-danger ]'>". $company_data->submission_confirmation ."</strong>";
    			// }
    
    			/* Other column data in the table */
    			$job_fair_data->unverify_button = "<button id='".$job_fair_page->id."_unverify_button' class='[ btn btn-outline-danger ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-times ]'></i>Reject</button>";
    			
    		
					/* Show button to mark the survey */
					//$company_data->marking_button = "<a target='_blank' href='".wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

					/* If nothing to be unlocked, hide button */
					if($job_fair_page->pass_verification== "unverified"){
						$job_fair_data->unverify_button = "-";
					}

					/* Save the editor data object into the main array of all the editor data */
					array_push($job_fair_pass_verified_data_array, $job_fair_data);
		
		   }

			 /** */
			 if($job_fair_page->id!=0 && $job_fair_page->pass_verification=="unverified"){
				// $serial_counter=1;
						/* Each candidate's data is to be saved in a seperate object */
							$job_fair_data = new stdClass();
				
							/* Create array if favourites are empty */
				// 			if($job_fair_page->verified == ""){
				// 				$job_fair_page->verified == "unverified";
				// 			}
					$candidate_page=wire('pages')->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id);
					$to_return->candidate_page=$candidate_page->identify_as;
					$job_fair_data->id = $job_fair_page->id;
					$job_fair_data->name = $job_fair_page->title;
					$job_fair_data->email = $job_fair_page->email;
					$job_fair_data->identify_as = $candidate_page->identify_as;
					if($candidate_page->experience_months=="" && $candidate_page->experience_years!=""){
						$candidate_page->experience_months=0;
						$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else if($candidate_page->experience_months!="" && $candidate_page->experience_years==""){
							$candidate_page->experience_years=0;
							$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else if($candidate_page->experience_months=="" && $candidate_page->experience_years=="")
					{
							$candidate_page->experience_years=0;
							$candidate_page->experience_months=0;
							$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					else{
							
						$job_fair_data->experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					}
					$job_fair_data->location = $candidate_page->current_city;
					$job_fair_data->lgbtq_verification = $candidate_page->lgbtq_verification;
					$job_fair_data->active_status = $candidate_page->active_status;
					$job_fair_data->phone_country_code = $job_fair_page->phone_country_code;
					$job_fair_data->phone_number = $job_fair_page->phone_number;
					$job_fair_data->pronoun = $job_fair_page->pronoun;
					$job_fair_data->registration_time=$job_fair_page->published +  60*60*5.50;
					$job_fair_data->registration_time=date('d/m/Y h:i A', $job_fair_data->registration_time);
					$job_fair_data->serial_number=$serial_counter;
					$serial_counter++;
						// 			$company_data->employee_count = $company_page->employee_count;
						// 			$company_data->industry = $company_page->industry;
									// $company_data->company_open_participation = $company_page->company_open_participation;
		
					// $company_data->submission_confirmation = $company_page->submission_confirmation;
		
					// if($company_data->submission_confirmation == ""){
					// 	$company_data->submission_confirmation = "-";
					// }else{
					// 	$company_data->submission_confirmation = "<strong class='[ text-danger ]'>". $company_data->submission_confirmation ."</strong>";
					// }
		
					/* Other column data in the table */
					$job_fair_data->verify_button = "<button id='".$job_fair_page->id."_verify_button' class='[ btn btn-outline-success ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Accept</button>";
					// $job_fair_data->selectbox = "<input id='".$job_fair_page->id."_checkbox' class='applicant_checkbox' type='checkbox'>";
				
					/* Show button to mark the survey */
					//$company_data->marking_button = "<a target='_blank' href='".wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

					/* If nothing to be unlocked, hide button */
					if($job_fair_page->pass_verification== "verified"){
						$job_fair_data->verify_button = "-";
					}

					/* Save the editor data object into the main array of all the editor data */
					array_push($job_fair_pass_unverified_data_array, $job_fair_data);
		
				}
			

		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		//$to_return->job_fair_lgbt_verified_data = $job_fair_lgbt_verified_data_array;
		$to_return->job_fair_applicants_data = $job_fair_applicants_data_array;
		$to_return->job_fair_pass_verified_data = $job_fair_pass_verified_data_array;
		$to_return->job_fair_pass_unverified_data = $job_fair_pass_unverified_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		// $to_return->columns_lgbt_verified = [
 		// 	["title"=>"Sr.no", "data"=>"serial_number"],
		// 	["title"=>"Verification", "data"=>"verify_button"],
		// 	["title"=>"Name", "data"=>"name"],
		// 	["title"=>"Email", "data"=>"email"],
		// 	["title"=>"Phone Number", "data"=>"phone_number"],
		// 	["title"=>"Pronoun", "data"=>"pronoun"],
		// 	["title"=>"Registration Time", "data"=>"registration_time"]
		// ];

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns_job_fair_applicants = [
		 ["title"=>"", "data"=>"selectbox"],
		 ["title"=>"Sr.no", "data"=>"serial_number"],
		 ["title"=>"Accept Profile", "data"=>"verify_button"],
		 ["title"=>"Reject Profile", "data"=>"unverify_button"],
		 ["title"=>"Edit", "data"=>"edit"],
		 ["title"=>"Name", "data"=>"name"],
		 ["title"=>"Email", "data"=>"email"],
		 ["title"=>"Identify as", "data"=>"identify_as"],
		 ["title"=>"Experience", "data"=>"experience"],
		 ["title"=>"Phone Number", "data"=>"phone_number"],
		 ["title"=>"Pronoun", "data"=>"pronoun"],
		 ["title"=>"Location", "data"=>"location"],
		 ["title"=>"Active Status", "data"=>"active_status"],
		 ["title"=>"LGBT+ Verification", "data"=>"lgbtq_verification"],
		 ["title"=>"Registration Time", "data"=>"registration_time"]
	 ];
	 
	 	/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns_all_verified = [
		 ["title"=>"Sr.no", "data"=>"serial_number"],
		 ["title"=>"Verification", "data"=>"unverify_button"],
		 ["title"=>"Name", "data"=>"name"],
		 ["title"=>"Email", "data"=>"email"],
		 ["title"=>"Identify as", "data"=>"identify_as"],
		 ["title"=>"Experience", "data"=>"experience"],
		 ["title"=>"Phone Number", "data"=>"phone_number"],
		 ["title"=>"Pronoun", "data"=>"pronoun"],
		 ["title"=>"Location", "data"=>"location"],
		 ["title"=>"Active Status", "data"=>"active_status"],
		 ["title"=>"LGBT+ Verification", "data"=>"lgbtq_verification"],
		 ["title"=>"Registration Time", "data"=>"registration_time"]
	 ];

	 	/* Names and data of the columns to be displayed will be saved in this array */
		 $to_return->columns_all_unverified = [
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Verification", "data"=>"verify_button"],
			["title"=>"Name", "data"=>"name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Identify as", "data"=>"identify_as"],
			["title"=>"Experience", "data"=>"experience"],
			["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Pronoun", "data"=>"pronoun"],
			["title"=>"Location", "data"=>"location"],
			["title"=>"Active Status", "data"=>"active_status"],
		 	["title"=>"LGBT+ Verification", "data"=>"lgbtq_verification"],
			["title"=>"Registration Time", "data"=>"registration_time"]
		];


		$to_return->success->success_status = true;
		return;
		
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */

	/* Function to unlock editor's favourite based on given editor IDs */
	function verify_profiles($requested_job_fair_to_verify){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$job_fair_page = wire("pages")->get("name=pass-applicants")->child("id=".$requested_job_fair_to_verify);
		$job_fair_page->of(false);

		/* If editor not found, return */
		if($job_fair_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$job_fair_page->pass_verification = "verified";
		
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
		$job_fair_page->save();
		
		$event_name = "RISE 2023";
		$pass_number=$job_fair_page->serial_id;
		$applicants_name=$job_fair_page->title;
		$applicants_email=$job_fair_page->email;
		$applicants_contact=$job_fair_page->phone_country_code."".$job_fair_page->phone_number;
		
		$applicants_subject="RISE JOB FAIR 2023 | EVENT PASSES";

		$applicants_message ="Dear {$applicants_name},";
		
		$applicants_message .="<br><br>";
		$applicants_message .="You have successfully registered for India's Premier LGBT+ Job Fair - RISE 2023 !";
		$applicants_message .="<br><br>";
		$applicants_message .="Explore our all-new virtual platform on 6th May and meet some of the top inclusive organizations from across the country.";
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
		$applicants_message .="            <b>Email</b>: {$applicants_email}";
		$applicants_message .="        </td>";
		$applicants_message .="    </tr>";
		$applicants_message .="</table>";

		$applicants_message .="<br>";
		$applicants_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you.";
		$applicants_message .="<br><br>";
		$applicants_message .="In case of any questions or entry correction requests, please drop us a mail before 20th April 2023, explaining the query along with your details and ticket ID on: contact@thepridecircle.com </b>";
		$applicants_message .="<br>";
		
		try {
			send_smtp_mail($job_fair_page->email,$applicants_message,$applicants_subject);
		} catch (Exception $e) {
                print_r($e);
		}

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been accepted..";

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
	/* Function to unverified profiles */
	function unverify_profiles($requested_job_fair_to_unverify_profiles){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$job_fair_page = wire("pages")->get("id=".$requested_job_fair_to_unverify_profiles);
		$job_fair_page->of(false);
//echo "1";

		/* If editor not found, return */
		if($job_fair_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}
//echo "2";
		$job_fair_page->pass_verification = "unverified";


//echo "3";
		/* save the page */
		$job_fair_page->save();
		$event_name = "RISE 2023";
		$pass_number=$job_fair_page->serial_id;
		$applicants_name=$job_fair_page->title;
		$applicants_email=$job_fair_page->email;
		$applicants_contact=$job_fair_page->phone_country_code."".$job_fair_page->phone_number;
		
		$applicants_subject="RISE JOB FAIR 2023 | EVENT PASSES";

		$applicants_message ="Dear {$applicants_name},";
		
		$applicants_message .="<br><br>";
		$applicants_message .="Unfortunately, you are unverified for India's Premier LGBT+ Job Fair - RISE 2023. We encourage you to try again for the next edition in 2024. ";
		
		$applicants_message .="<br><br>";
		$applicants_message .="Regards,";
		$applicants_message .="<br>";
		$applicants_message .="Pride Circle";
		
		try {
			send_smtp_mail($job_fair_page->email,$applicants_message,$applicants_subject);
		} catch (Exception $e) {
      print_r($e);
		}

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been rejected.";


		return;
	}
	/* Function to unverify profile */

	/* Function to add multiple profiles to unverified based on given IDs */
	function multiple_profile_unverify($requested_profiles_to_unverify_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_unverify = json_decode($requested_profiles_to_unverify_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unverify) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_unverify as $single_applicant_page){
			/**access single candidate page using requested id */
			$applicant_page=wire("pages")->get("id=".$single_applicant_page);
			
			/**assign active_status status is active */
			$applicant_page->pass_verification = "unverified";
			/**save candidate page */
			$applicant_page->of(false);
			$applicant_page->save();
			$event_name = "RISE 2023";
			$pass_number=$applicant_page->serial_id;
			$applicants_name=$applicant_page->title;
			$applicants_email=$applicant_page->email;
			$applicants_contact=$applicant_page->phone_country_code."".$applicant_page->phone_number;
			
			$applicants_subject="RISE JOB FAIR 2023 | EVENT PASSES";

			$applicants_message ="Dear {$applicants_name},";
			
			$applicants_message .="<br><br>";
			$applicants_message .="Unfortunately, you are unverified for India's Premier LGBT+ Job Fair - RISE 2023. We encourage you to try again for the next edition in 2024. ";
			
			$applicants_message .="<br><br>";
			$applicants_message .="Regards,";
			$applicants_message .="<br>";
			$applicants_message .="Pride Circle";
			
			try {
				send_smtp_mail($applicant_page->email,$applicants_message,$applicants_subject);
			} catch (Exception $e) {
				print_r($e);
			}
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been rejected successfully.";

		end_and_return();
	}
	/* Function to add profiles to unverified based on given IDs END */

	
	/* Function to add multiple profiles to verified based on given IDs */
	function multiple_profile_verify($requested_profiles_to_verify_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_verify = json_decode($requested_profiles_to_verify_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_verify) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_verify as $single_applicant_page){
			/**access single candidate page using requested id */
			$applicant_page=wire("pages")->get("id=".$single_applicant_page);
			
			/**assign active_status status is active */
			$applicant_page->pass_verification = "verified";
			/**save candidate page */
			$applicant_page->of(false);
			$applicant_page->save();

			/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
			/**** Get serial ID from the serial ID page */
			$pass_applicants_counter_page = wire('pages')->get("name=pass-applicants-counter-page");
			/**** Assign the given ID to the  new page and increment the number for the next page */

			$applicant_page->serial_id = $pass_applicants_counter_page->serial_id++;
//echo"5";
		/**** save the incremented ID page */
		$pass_applicants_counter_page-> of(false);
		$pass_applicants_counter_page->save();

			$event_name = "RISE 2023";
			$pass_number=$applicant_page->serial_id;
			$applicants_name=$applicant_page->title;
			$applicants_email=$applicant_page->email;
			$applicants_contact=$applicant_page->phone_country_code."".$applicant_page->phone_number;
			
			$applicants_subject="RISE JOB FAIR 2023 | EVENT PASSES";
	
			$applicants_message ="Dear {$applicants_name},";
			
			$applicants_message .="<br><br>";
			$applicants_message .="You have successfully registered for India's Premier LGBT+ Job Fair - RISE 2023 !";
			$applicants_message .="<br><br>";
			$applicants_message .="Explore our all-new virtual platform on 6th May and meet some of the top inclusive organizations from across the country.";
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
			$applicants_message .="            <b>Email</b>: {$applicants_email}";
			$applicants_message .="        </td>";
			$applicants_message .="    </tr>";
			$applicants_message .="</table>";
	
			$applicants_message .="<br>";
			$applicants_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you.";
			$applicants_message .="<br><br>";
			$applicants_message .="In case of any questions or entry correction requests, please drop us a mail before 20th April 2023, explaining the query along with your details and ticket ID on: contact@thepridecircle.com </b>";
			$applicants_message .="<br>";
			
			try {
				send_smtp_mail($applicant_page->email,$applicants_message,$applicants_subject);
			} catch (Exception $e) {
									print_r($e);
			}
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been accepted successfully.";

		end_and_return();
	}
	/* Function to add profiles to verified based on given IDs END */
		
	/* Function to modify the information of an job profile from POST data */
// 	function subusers_list($sub_user_modal_form_details){
// 		/* Access  variable that is to be returned */
// 		global $to_return;
		
// 			foreach(wire('pages')->get("name=universal-companies")->children() as $company_page) {
// 			/* Each candidate's data is to be saved in a seperate object */
// 			$company_data = new stdClass();

		
// 			$company_data->sub_uses =$company_page->sub_uses;
// 			//print_r($company_data->sub_uses);

// 			/* Save the editor data object into the main array of all the editor data */
// 			array_push($company_data_array, $company_data);
// 		}
// 		/* Loop through all the Editor profile pages END */

// 		/* Save the editor data array into the object that is to be sent back */
// 		$to_return->data = $company_data_array;



// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "Points submitted ";
// 		end_and_return();
// 	}
	/* Function to modify the information of an job profile from POST data END*/