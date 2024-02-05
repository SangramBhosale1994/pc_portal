<?php

// print_r($_POST);
// die();
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	{
		//Tell the browser to redirect to the HTTPS URL.
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
		//Prevent the rest of the script from executing.
		exit;
	}

	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/**api-vanish-unlock-profiles is used for remove unlock profile after 4 months of added profile date*/
 require_once(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/api-vanish-unlock-profiles.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	// require_once(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/candidate_table_data.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	global $session_recruiter_profile_type;
	global $session_user_id;
	global $candidate_id;
	global $candidate_status_filter;
	global $candidate_status_filter_show_only;
	$candidate_status_filter="";
	global $unlock_candidate_status_filter;
	global $unlock_candidate_status_filter_show_only;
	global $no_show_only_mine_profiles;
	global $is_show_only_mine_filter;
	$unlock_candidate_status_filter="";
	global $unlocked_recruiter_columns;
	global $isset_candidate_filter;
	// global $isset_candidate_filter_tab;
	$session_user_id=\ProcessWire\wire("session")->user_page_id;
	$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;

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

	/* If the request is done without proper log in, exit */
	if(!in_array($session->user_designation, ["recruiter"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}
// echo "888";
// echo isset($_POST['candidate_filter']);
// echo "***";
$isset_candidate_filter=false;
if(isset($_POST['candidate_filter'])){
	if($_POST['candidate_filter']=="true"){
		$isset_candidate_filter=true;
	}
}

// $isset_candidate_filter_tab=false;
// if(isset($_POST['candidate_status_filter_tab'])){
// 	if($_POST['candidate_status_filter_tab']=="true"){
// 		$isset_candidate_filter_tab=true;
// 	}
// }
// echo $_POST['candidate_filter'];

// echo "****";
$is_show_only_mine_filter=false;
if($isset_candidate_filter == true){
	// echo "999";
	$candidate_filter_form_details=$input->post("requested_candidate_status");
	// $candidate_filter_form_details_array=json_decode($candidate_filter_form_details);
	// echo $candidate_filter_form_details;
	// /* Array to save data and then to save into the page */
	$form_inputs_array = array();
	// $print_to_file=true;
	// if(!empty($candidate_filter_form_details_array)){
	// 	foreach ($candidate_filter_form_details_array as $input_element) {
	// 		// $form_inputs_array[$input_element->name] = $input_element->value;
	// 		$form_inputs_array[$input_element->name] = $input_element->value;
	// 	}
	// }
	// $form_inputs_array["requested_candidate_status"] = $candidate_filter_form_details;

	
	/**Add candidate status filter in Advance search form */
	// if(array_key_exists("recruiter_candidate_status",$form_inputs_array) && $form_inputs_array['recruiter_candidate_status']!=""){
	if($candidate_filter_form_details!=""){
		$candidate_status_filter=$candidate_filter_form_details;
		// echo $candidate_status_filter;
	}

	// fetch_favourite_table_data("default");
}

// if($isset_candidate_filter_tab == true){
// 	// echo "999";
// 	$candidate_filter_form_details=$_POST['candidate_status_tab'];
// 	if($candidate_filter_form_details!=""){
// 		$candidate_status_filter=$candidate_filter_form_details;
// 		// echo $candidate_status_filter;
// 	}

// 	// fetch_favourite_table_data("default");
// }
// else
if(isset($_POST['unlock_candidate_filter']) && $_POST['unlock_candidate_filter']=="true"){
	// echo "999";
	$candidate_filter_form_details=$input->post("requested_candidate_status");
	// $candidate_filter_form_details_array=json_decode($candidate_filter_form_details);
	// // print_r($candidate_filter_form_details_array);
	// /* Array to save data and then to save into the page */
	// $form_inputs_array = array();
	// $print_to_file=true;
	// if(!empty($candidate_filter_form_details_array)){
	// 	foreach ($candidate_filter_form_details_array as $input_element) {
	// 		$form_inputs_array[$input_element->name] = $input_element->value;
	// 	}
	// }
	
	// /**Add candidate status filter in Advance search form */
	// if(array_key_exists("recruiter_candidate_status",$form_inputs_array) && $form_inputs_array['recruiter_candidate_status']!=""){
	// 	$unlock_candidate_status_filter=$form_inputs_array['recruiter_candidate_status'];
	// 	// echo $unlock_candidate_status_filter;
	// 	// echo "****";
	// }

	if($candidate_filter_form_details!=""){
		$unlock_candidate_status_filter=$candidate_filter_form_details;
		// echo $candidate_status_filter;
	}

	// fetch_unlocked_table_data("default");
}
// else
if(isset($_POST['requested_show_only_mine']) && $_POST['requested_show_only_mine']=="true"){
	$candidate_status_filter_show_only="My Favourites";
	// fetch_favourite_table_data("default");
}
// else
// echo $_POST['requested_unlock_show_only_mine'];
if(isset($_POST['requested_unlock_show_only_mine']) && $_POST['requested_unlock_show_only_mine']=="true"){
	// echo "show only.";
	$unlock_candidate_status_filter_show_only="My Unlocks";
	$is_show_only_mine_filter=true;
	// fetch_unlocked_table_data("default");
}
elseif (!isset($_POST['requested_action_to_take'])) {
		/* If no POST request is made, exit with an error message */
		$to_return->error->number_of_errors++;
		end_and_return();
	}
	else{
		
	}
	
	// die();
	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["add_to_favourite", "unlist_from_favourite", "unlock_profiles", "fetch_favourite_table_data", "fetch_unlocked_table_data", "candidate_resume_download","view_candidate_profile"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'add_to_favourite':
			/* Save the data sent from the form */
			$requested_profiles_to_favourite_json = $input->post("requested_profiles_to_favourite_json", "textarea", false);

			if(!$requested_profiles_to_favourite_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			add_to_favourite($requested_profiles_to_favourite_json);
		break;

		case "unlist_from_favourite":
			/* Save the data sent from the form */
			$requested_profiles_to_unlist_json = $input->post("requested_profiles_to_unlist_json", "textarea", false);

			if(!$requested_profiles_to_unlist_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			unlist_from_favourite($requested_profiles_to_unlist_json);
		break;

		case "unlock_profiles":
			/* Save the data sent from the form */
			$requested_profiles_to_unlock_json = $input->post("requested_profiles_to_unlock_json", "textarea", false);

			if(!$requested_profiles_to_unlock_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			unlock_profiles($requested_profiles_to_unlock_json);
			end_and_return();
		break;

		case "fetch_favourite_table_data":
			/* Save the data sent from the form */
			$requested_columns_to_show = $input->post("requested_columns_array_json", "textarea", false);

			if(!$requested_columns_to_show){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			fetch_favourite_table_data($requested_columns_to_show);
		break;

		case "fetch_unlocked_table_data":
			/* Save the data sent from the form */
			$requested_columns_to_show = $input->post("requested_columns_array_json", "textarea", false);

			if(!$requested_columns_to_show){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			fetch_unlocked_table_data($requested_columns_to_show);
			end_and_return();
		break;

		case "candidate_resume_download":
			/* Save the data sent from the form */
			$requested_profiles_to_download_json = $input->post("requested_profiles_to_download_json", "textarea", false);
			// echo $requested_profiles_to_download_json;
			// echo "***";
			if(!$requested_profiles_to_download_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			candidate_resume_download($requested_profiles_to_download_json);
			end_and_return();
		break;
		
		case "view_candidate_profile":
			/* Save the data sent from the form */
			$requested_profiles_to_viewed_profile_json = $input->post("requested_profiles_to_viewed_profile_json", "textarea", false);
			// echo $requested_profiles_to_download_json;
			// echo "***";
			if(!$requested_profiles_to_viewed_profile_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			view_candidate_profile($requested_profiles_to_viewed_profile_json);
			end_and_return();
		break;

		// case "candidate_status_filter":
		// 	/* Save the data sent from the form */
		// 	$requested_candidate_status_json = $input->post("requested_candidate_status", "textarea", false);
		// 	// echo $requested_profiles_to_download_json;
		// 	// echo "***";
		// 	if(!$requested_candidate_status_json){
		// 		$to_return->error->number_of_errors++;
		// 		$to_return->error->error_message  = "Request failed. Please refresh and try again.";
		// 		end_and_return();
		// 	}

		// 	candidate_status_filter($requested_candidate_status_json);
		// 	end_and_return();
		// break;
		

		default:
			// $to_return->error->number_of_errors++;
			// $to_return->error->error_message  = "Request failed. Please refresh and try again.3";
			end_and_return();
		break;
	}


	/* Function to add profiles to favourite based on given IDs */
	function add_to_favourite($requested_profiles_to_favourite_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_recruiter_profile_type;
		global $session_user_id;
		$session_user_id=\ProcessWire\wire("session")->user_page_id;
		$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;

		/* Save received JSON data into an array */
		$requested_profiles_to_favourite = json_decode($requested_profiles_to_favourite_json);
		// echo "11";
		// print_r($requested_profiles_to_favourite);
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_favourite) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}

		/* Get the current recruiter's page */
		if($session_recruiter_profile_type=="sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id)->parent();
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
		}
		$recruiter_page->of(false);
		$already_favourite_profiles_array=array();
		$recruiter_favourite_array=new stdClass();
		$final_favourite_profiles_array=array();
		$recruiter_favourite_array=$recruiter_page->favourite_profiles_array;
		// echo "12";
		// print_r($recruiter_favourite_array);
		/* Get the current favourite profiles array */
		$favourite_profiles_array = json_decode($recruiter_favourite_array);
	
		// echo "13";
		// print_r($favourite_profiles_array);
		/* If no favourites are already available */
		if($recruiter_page->favourite_profiles_array == ""){
			$recruiter_page->favourite_profiles_array = "{'favourite_profiles_array':[]}";
			$recruiter_page->favourite_profiles_array = "{}";
			// $favourite_profiles_array=array();
		}
		if(!empty($favourite_profiles_array)){
			foreach($favourite_profiles_array as $single_favourite_profile_array){
				// $already_favourite_profiles_array_data[]=$single_favourite_profile_array;
				foreach($single_favourite_profile_array as $single_favourite_profile){
					$already_favourite_profiles_array[]=$single_favourite_profile->candidate_profile_id;
				}
			}
		}

		/* Profile IDs that already exist in favourites. */
		$already_favourited_array = array_intersect($requested_profiles_to_favourite, $already_favourite_profiles_array);
		// echo "13";
		// print_r($already_favourited_array);
		/* Remove already existing profiles from the array to add, also remove profiles which are already unlocked*/
		$profiles_to_favourite = array_diff($requested_profiles_to_favourite, $already_favourited_array, fetch_unlocked_array());
		// echo "14";
		// print_r($profiles_to_favourite);
		/* If no profiles are to be added */
		if(!count($profiles_to_favourite)){
			$to_return->success->success_status = true;
			$to_return->success->success_message  = "All the profiles are already favourited or unlocked.";
			end_and_return();
		}
		// echo "14.5";
		// print_r($favourite_profiles_array);
		/* Merge the new profiles into the existing array on the recruiter page */
		
		/**Current timestamp */
		$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		// $favourite_profiles_array_data=array_merge($already_favourite_profiles_array, $profiles_to_favourite);
		$favourite_profiles_array_data=$profiles_to_favourite;
		
		// $favourite_profiles_object->final_favourite_profiles_array=array();
		// echo "15";
		// print_r($favourite_profiles_array_data);
		foreach($favourite_profiles_array_data as $single_favourite_profile){
			$favourite_profiles_object=new stdClass();
			$favourite_profiles_object->candidate_profile_id=$single_favourite_profile;
			$favourite_profiles_object->recruiter_id=$session_user_id;
			$favourite_profiles_object->timestamp=$current_timestamp;
			// $recruiter_favourite_array=$recruiter_page->favourite_profiles_array;
			// $favourite_profiles_array = json_decode($recruiter_favourite_array);
			$favourite_profiles_array->favourite_profiles_array[]=$favourite_profiles_object;
			// print_r($favourite_profiles_array->favourite_profiles_array);

			/**Save Unlocked status in notes section */
			$candidate_page_notes_added = \ProcessWire\wire("pages")->get("id=".$single_favourite_profile);
			// if($input->post->candidate_status!=""){
			$candidate_status_input="Favourited";

				/**Save candidate status in notes section */
				$recruiter_candidates_notes_entry_object=new stdClass();
				$recruiter_candidates_notes_entry_object->notes="Status changed to : ".$candidate_status_input;
				$recruiter_candidates_notes_entry_object->timestamp=strtotime(date("Y-m-d h:i:sa"));
				$recruiter_candidates_notes_entry_object->added_by=$session_user_id;
				if (is_object($candidate_page_notes_added) && $candidate_page_notes_added->notes_data!="") {
					$candidates_notes_json=$candidate_page_notes_added->notes_data;
					if($candidates_notes_json == ""){
						$candidates_notes_json='{"notes_details_array":[]}';
					}
					/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
					$candidates_notes_object = json_decode($candidates_notes_json);
					$candidates_notes_object->notes_details_array[] = $recruiter_candidates_notes_entry_object;
					$candidate_page_notes_added->notes_details_array = json_encode($candidates_notes_object);
					$candidate_page_notes_added->notes_data=$candidate_page_notes_added->notes_details_array;
					$candidate_page_notes_added->of(false);
					$candidate_page_notes_added->save();
				}
			/**Save Unlocked status in notes section End */
			
			
		}
		$recruiter_page->favourite_profiles_array = json_encode($favourite_profiles_array);
		// echo $recruiter_page->favourite_profiles_array;
		// $favourite_profiles_object->final_favourite_profiles_array[]=$favourite_profiles_object;
			// print_r($final_favourite_profiles_array);
			// print_r($favourite_profiles_object);
			// echo "array";
			/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
			
			
		// echo "16";
		// echo $recruiter_page->favourite_profiles_array;
		
		/* Save the recruiter page */
		$recruiter_page->save();

		$to_return->success->success_status = true;

		/* If all the requested profiles have been favourited successfully */
		if(count($profiles_to_favourite) == count($requested_profiles_to_favourite)){
			$to_return->success->success_message = "All the requested profiles have been favourited successfully.";
		}
		/* If some profiles were not favourited */
		else{
			$to_return->success->success_message = "Newly favourited ".count($profiles_to_favourite)." profiles.\nRemaining profiles were already favourited or unlocked.";
		}

		end_and_return();
	}
	/* Function to add profiles to favourite based on given IDs END */

	/* Function to remove profiles from favourite based on given IDs */
	function unlist_from_favourite($requested_profiles_to_unlist_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_recruiter_profile_type;
		global $session_user_id;
		$session_user_id=\ProcessWire\wire("session")->user_page_id;
		$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;

		/* Save received JSON data into an array */
		$requested_profiles_to_unlist = json_decode($requested_profiles_to_unlist_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unlist) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlisted.";
			end_and_return();
		}

		/* Get the current recruiter's page */
		if($session_recruiter_profile_type=="sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id)->parent();
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
		}
		$recruiter_page->of(false);

		/* Get the current favourite profiles array */
		// $favourite_profiles_array = json_decode($recruiter_page->favourite_profiles_array);
		/* Get the current favourite profiles array */
		// $favourite_profiles_object = json_decode($recruiter_page->favourite_profiles_array);
			$favourite_profiles_object=$recruiter_page->favourite_profiles_array;
			$favourite_profiles_array = json_decode($favourite_profiles_object);

		/* If no favourites are already available */
		if($favourite_profiles_array == ""){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlisted.";
			end_and_return();
		}

		/* Remove the requested profiles from the existing array on the recruiter page */
		if($recruiter_page->favourite_profiles_array != ""){
			$new_favourite_profiles_array=Array();
			if($favourite_profiles_array!=""){
				foreach($favourite_profiles_array as $single_favourite_profiles_object_array){
					foreach($single_favourite_profiles_object_array as $single_favourite_profile_array){
						$favourite_profiles_array_values[]=$single_favourite_profile_array->candidate_profile_id;
						$candidate_id=$single_favourite_profile_array->candidate_profile_id;
						if(!in_array($candidate_id,$requested_profiles_to_unlist)){
							$new_favourite_profiles_array[]=$single_favourite_profile_array;
						}
					}
				}
				$new_favourite_profiles_object=new StdClass();
				$new_favourite_profiles_object->favourite_profiles_array=$new_favourite_profiles_array;
				$recruiter_page->favourite_profiles_array = json_encode($new_favourite_profiles_object);
			}
		}
		/* Save the recruiter page */
		$recruiter_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been unlisted successfully.";

		end_and_return();
	}
	/* Function to remove profiles from favourite based on given IDs END */

	/* Function to unlock profiles with given IDs */
	function unlock_profiles($requested_profiles_to_unlock_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_recruiter_profile_type;
		global $session_user_id;
		$session_user_id=\ProcessWire\wire("session")->user_page_id;
		$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;
		// echo $session_user_id;
		// echo $session_recruiter_profile_type;
		// echo $requested_profiles_to_unlock_json;
		if(\ProcessWire\wire("session")->subscription_expired){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Your subscription is over, please resubscribe to unlock more profiles.";
			return;
		}

		/* Save received JSON data into an array */
		$requested_profiles_to_unlock = json_decode($requested_profiles_to_unlock_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unlock) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlocked.";
			return;
		}

		/* Get the current recruiter's page */
		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id)->parent();
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
		}
		
		$recruiter_profile_array=Array();
		$recruiter_profile_array[]=$recruiter_page->id;
		foreach($recruiter_page->children() as $sub_recruiter){
			$recruiter_profile_array[]=$sub_recruiter->id;
		}
		$recruiter_page->of(false);

		/* Get the current unlocked profiles array */
		// $unlocked_profiles_array = json_decode($recruiter_page->unlocked_profiles_array);

		/* If no unlocked are already available */
		// if($unlocked_profiles_array == ""){
		// 	$unlocked_profiles_array = Array();
		// }

		/* Get the current unlocked profiles array */
		$already_unlocked_profiles_array=array();
		$recruiter_unlocked_array=new stdClass();
		
		$recruiter_unlocked_array=$recruiter_page->unlocked_profiles_array;
		$unlocked_profiles_array = json_decode($recruiter_unlocked_array);
			// print_r($unlocked_profiles_array);
		/* If no unlocked are already available */
		if($recruiter_page->unlocked_profiles_array==""){
			$recruiter_page->unlocked_profiles_array="{'unlocked_profiles_array':[]}";
			// $unlocked_profiles_array=Array();
		}
		if(!empty($unlocked_profiles_array)){
			foreach($unlocked_profiles_array as $single_unlocked_profile_array){
				foreach($single_unlocked_profile_array as $single_unlocked_profile){
					$already_unlocked_profiles_array[]=$single_unlocked_profile->candidate_profile_id;
				}
				// $already_unlocked_profiles_array[]=$candidate_id;
			}
		}
		// print_r($unlocked_profiles_array);

		/* Profile IDs that already exist in unlocked. */
		$already_unlocked_array = array_intersect($requested_profiles_to_unlock, $already_unlocked_profiles_array);

		/* Remove already existing profiles from the array to add */
		$profiles_to_unlock = array_diff($requested_profiles_to_unlock, $already_unlocked_array);
		
		$candidates_who_applied_for_jobs = json_decode($recruiter_page->candidates_who_applied_for_job);
		
		if($candidates_who_applied_for_jobs==""){
		    $candidates_who_applied_for_jobs = array();
		}

		$applicants_to_unlock=array();
		$regular_candidates_to_unlock=array();
		//loop to get list of candidtes who applied to job
		foreach($profiles_to_unlock as $candidate){
			//get array of job codes of selected candidated
		    $candidate_job_codes = array_map('trim', array_filter(explode(",", \ProcessWire\wire("pages")->get("id=".$candidate)->job_code)));
		     //$candidate_job_codes =  \ProcessWire\wire("pages")->get("id=".$candidate)->job_code;
		  //  echo "///////////////////////";
		  //  print_r($candidate_job_codes) ;
		    
		    foreach($candidate_job_codes as $jobcode){
		        $job_page = \ProcessWire\wire("pages")->get("name=jobs")->child("job_code=".$jobcode);
		      //   echo $job_page;
		      //  echo "************************";
		        /* TODO check this fields name */
		        //echo \ProcessWire\wire("session")->company_name;
						// echo $job_page->job_added_by;
						// echo "++";
						// echo $recruiter_page->id;
						// print_r($recruiter_profile_array);
						foreach($recruiter_profile_array as $single_recruiter){
							if($job_page->job_added_by == $single_recruiter){
								// echo "-------------------------";
								// print_r($candidate);
								 /* Skip if already exists (use in_array )*/
								 if(in_array($candidate,$candidates_who_applied_for_jobs)){
												 continue;
										 }
								 $candidates_who_applied_for_jobs[] = $candidate;
								 $applicants_to_unlock[]=$candidate;
						 	}
						}
		        
		    }
		    
		}
		// echo "applicants to unlock";
		// print_r($applicants_to_unlock);
		$regular_candidates_to_unlock= array_diff($profiles_to_unlock, $applicants_to_unlock);
		$regular_candidates_to_unlock_count=count($regular_candidates_to_unlock);
		// echo "regular unlock";
		// print_r($regular_candidates_to_unlock);
		/* If no profiles are to be added */
		if($recruiter_page->applicant_unlock_counter == ""){
			$recruiter_page->applicant_unlock_counter=0;
		}
		if($recruiter_page->applicants_unlock_quota == ""){
			$recruiter_page->applicants_unlock_quota=0;
		}
		// echo "***";
		// echo $recruiter_page->unlock_quota;
		// echo "----";
		// echo sizeof($already_unlocked_profiles_array);
		// echo "++++";
		// echo $recruiter_page->applicant_unlock_counter;
		if($recruiter_page->available_total_unlock_quota!=0 ){
			$recruiter_total_unlock_quota=$recruiter_page->available_total_unlock_quota;
			// echo "available";
		}
		else{
			// echo "unlock";
			// echo count($already_unlocked_profiles_array);
			// echo "-----";
			if(count($already_unlocked_profiles_array)==0){
				$recruiter_total_unlock_quota=$recruiter_page->total_unlock_quota;
				// echo "already unlock";
			}
			else{
				$recruiter_total_unlock_quota="0";
				// echo "already not unlock";
			}
			
		}
		
		$regular_unlock_quota=$recruiter_page->unlock_quota-((sizeof($already_unlocked_profiles_array))-($recruiter_page->applicant_unlock_counter));
		$regular_unlock_quota=$recruiter_page->unlock_quota;
		if($recruiter_page->applicants_unlock_quota!=0){
			$applicants_unlock_quota=($recruiter_page->applicants_unlock_quota)-($recruiter_page->applicant_unlock_counter);
		}
		else{
			$applicants_unlock_quota=($recruiter_page->applicants_unlock_quota);
		}
		// echo "total count ".$recruiter_total_unlock_quota;
		// echo "------regular count ".$regular_unlock_quota;
		// echo "******applicant count ".$applicants_unlock_quota;
				if(!count($profiles_to_unlock)){
					// echo "1111";
					$to_return->success->success_status = true;
					$to_return->success->success_message  = "All the profiles are already Unlocked.";
					return;
				}
				else{
					// echo "2222";
					if($recruiter_total_unlock_quota!=0 && $recruiter_page->unlock_quota==0 && $recruiter_page->applicants_unlock_quota==0){
						// echo "3333";
						if(count($profiles_to_unlock)<=$recruiter_total_unlock_quota){
							$recruiter_total_unlock_quota=($recruiter_total_unlock_quota-count($profiles_to_unlock));
							$recruiter_page->available_total_unlock_quota=$recruiter_total_unlock_quota;
						}
						else{
							// echo "--both///--";
							$to_return->error->number_of_errors++;
							$to_return->error->error_message  = "You can unlock ".$recruiter_total_unlock_quota." more profiles.";
							return;
						}
						// echo count($profiles_to_unlock);
						// echo "total of";
						// echo $recruiter_total_unlock_quota;
						// echo "--------------";
						// echo $recruiter_page->available_total_unlock_quota;
						// echo "****************";
					}
					elseif($recruiter_total_unlock_quota!=0 && $recruiter_page->unlock_quota!=0 || $recruiter_page->applicants_unlock_quota!=0){
						// echo "4444";
						// print_r($profiles_to_unlock);
						// print_r($regular_candidates_to_unlock);
						// print_r($applicants_to_unlock);
						
						// foreach($profiles_to_unlock as $single_profile_to_unlcok_id){
						// 	$candidate_profile_page=$pages->get("id=".$single_profile_to_unlcok_id);

						// // }
						// echo count($regular_candidates_to_unlock);
						// echo "****";
						// echo count($applicants_to_unlock);
						// echo "-----";


						if(count($regular_candidates_to_unlock)!=0 && count($applicants_to_unlock)!=0){
							if(count($regular_candidates_to_unlock) <= ( $regular_unlock_quota)){
								// echo "0000";
								// echo count($regular_candidates_to_unlock);
								// echo "--";
								$regular_unlock_quota=($regular_unlock_quota-count($regular_candidates_to_unlock));
								$recruiter_page->unlock_quota=$regular_unlock_quota;
								// echo $regular_unlock_quota;
							}
							else{
								// echo "--both///--";
								$to_return->error->number_of_errors++;
								$to_return->error->error_message  = "You can unlock ".$applicants_unlock_quota." more job applicants and ".$regular_unlock_quota." other profiles.";
								return;
							}

							if((count($applicants_to_unlock) <= $applicants_unlock_quota)){
								$applicants_actual_to_unlock=count($applicants_to_unlock);
								$recruiter_page->applicant_unlock_counter=(($applicants_unlock_quota-$recruiter_page->applicant_unlock_counter)-$applicants_actual_to_unlock);
								// echo "-----both1-----";
								// echo $applicants_actual_to_unlock;
							}
							else{
								// echo "--both2///--";
								$to_return->error->number_of_errors++;
								$to_return->error->error_message  = "You can unlock ".$applicants_unlock_quota." more job applicants and ".$regular_unlock_quota." other profiles.";
								return;
							}

						}
						elseif(count($regular_candidates_to_unlock)!=0){
							// echo "regular condition";
							if(count($regular_candidates_to_unlock) <= ( $regular_unlock_quota)){
								// echo "0000";
								// echo count($regular_candidates_to_unlock);
								// echo "--";
								$regular_unlock_quota=($regular_unlock_quota-count($regular_candidates_to_unlock));
								$recruiter_page->unlock_quota=$regular_unlock_quota;
								// echo $regular_unlock_quota;
							}
							else{
								// echo "9999";
								$to_return->error->number_of_errors++;
									$to_return->error->error_message  = "You can unlock $regular_unlock_quota more profiles.";
								return;
							}
						}
						elseif(count($applicants_to_unlock)!=0){
							if(count($applicants_to_unlock) <= ( $applicants_unlock_quota)){
								// echo "5555";
								if((count($applicants_to_unlock) <= $applicants_unlock_quota)){
										$applicants_actual_to_unlock=count($applicants_to_unlock);
										$recruiter_page->applicant_unlock_counter+=$applicants_actual_to_unlock;
										// echo "6666";
										// echo $applicants_actual_to_unlock;
								}
								// else{
								// 	$regular_candidates_to_unlock_count+= count($applicants_to_unlock)-$applicants_unlock_quota; 
								// 	$applicants_actual_to_unlock=$applicants_unlock_quota;
								// 	$recruiter_page->applicant_unlock_counter+=$applicants_actual_to_unlock;
								// 	echo "7777";
								// 	echo $applicants_actual_to_unlock;
								// }
		
								// if($regular_candidates_to_unlock_count <= $regular_unlock_quota){
								// 	// $recruiter_page->applicant_unlock_counter+=$applicants_actual_to_unlock;
								// 	$recruiter_page->unlock_quota=$regular_candidates_to_unlock_count;
								// 	echo "8888";
								// 	// echo $recruiter_page->applicant_unlock_counter;
								// 	echo $recruiter_page->unlock_quota;
								// }
								else{
									// echo "9999";
									$to_return->error->number_of_errors++;
									// if($regular_unlock_quota > 0){
									// 	$to_return->error->error_message  = "You can unlock ".$applicants_unlock_quota." more job applicants and ".$regular_unlock_quota." other profiles.";
									// }
									// else{
										$to_return->error->error_message  = "You can unlock 0 more applicants profiles.";
									// }
									
									return;
								}
							}
							else{
								// echo "--101010--";
								$to_return->error->number_of_errors++;
								// if( ($regular_unlock_quota + $applicants_unlock_quota) > 0){
								// 	$to_return->error->error_message  = "You can unlock ".$applicants_unlock_quota." more job applicants and ".$regular_unlock_quota." other profiles.";
								// }
								// else{
									$to_return->error->error_message  = "You can unlock $applicants_unlock_quota more profiles..";
								// }
								return;
							}
						}
					}
					else{
						// echo "--111111--";
						$to_return->error->number_of_errors++;
						if($recruiter_total_unlock_quota==0){
							$to_return->error->error_message  = "You can unlock 0 more profiles.";
						}
						else{
							$to_return->error->error_message  = "You can unlock ".$applicants_unlock_quota." more job applicants and ".$regular_unlock_quota." other profiles.";
						}
						
						return;
					}
					
				}

		/**Save unlock profiles in unlock profiles array */
		$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		$unlock_profiles_object=new stdClass();
		// $session_user_id=\ProcessWire\wire("pages")->get($session_user_id)->id;
		// print_r($profiles_to_unlock);
		// echo "***";
		foreach($profiles_to_unlock as $single_unlock_profile){
			$unlock_profiles_object=new stdClass();
			$unlock_profiles_object->candidate_profile_id=$single_unlock_profile;
			$unlock_profiles_object->recruiter_id=$session_user_id;
			$unlock_profiles_object->timestamp=$current_timestamp;
			$unlocked_profiles_array->unlocked_profiles_array[]=$unlock_profiles_object;

			/**Save Unlocked status in notes section */
	
			$candidate_page_notes_added = \ProcessWire\wire("pages")->get("id=".$single_unlock_profile);
			// if($input->post->candidate_status!=""){
			$candidate_status_input="Unlocked";

				/**Save candidate status in notes section */
				$recruiter_candidates_notes_entry_object=new stdClass();
				$recruiter_candidates_notes_entry_object->notes="Status changed to : ".$candidate_status_input;
				$recruiter_candidates_notes_entry_object->timestamp=strtotime(date("Y-m-d h:i:sa"));
				$recruiter_candidates_notes_entry_object->added_by=$session_user_id;
				if (is_object($candidate_page_notes_added) && $candidate_page_notes_added->notes_data!="") {
					$candidates_notes_json=$candidate_page_notes_added->notes_data;
					if($candidates_notes_json == ""){
						$candidates_notes_json='{"notes_details_array":[]}';
					}
					/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
					$candidates_notes_object = json_decode($candidates_notes_json);
					$candidates_notes_object->notes_details_array[] = $recruiter_candidates_notes_entry_object;
					$candidate_page_notes_added->notes_details_array = json_encode($candidates_notes_object);
					$candidate_page_notes_added->notes_data=$candidate_page_notes_added->notes_details_array;
					$candidate_page_notes_added->of(false);
					$candidate_page_notes_added->save();
				}

		
			/**Save Unlocked status in notes section End */
		}
		
		$recruiter_page->unlocked_profiles_array = json_encode($unlocked_profiles_array);
		// /* Merge the new profiles into the existing array on the recruiter page */
		// $recruiter_page->unlocked_profiles_array = json_encode(array_merge($unlocked_profiles_array, $profiles_to_unlock));
		
		$recruiter_page->candidates_who_applied_for_job =  json_encode($candidates_who_applied_for_jobs);
		

		/* Remove profiles from favourite pofiles array if they exist in the unlocked array */
		if($recruiter_page->favourite_profiles_array != ""){
			// echo $recruiter_page->favourite_profiles_array;
			/* Get the current favourite profiles array */
			$favourite_profiles_object=$recruiter_page->favourite_profiles_array;
			$favourite_profiles_array = json_decode($favourite_profiles_object);
			$new_favourite_profiles_array=Array();
			if($favourite_profiles_array!=""){
				foreach($favourite_profiles_array as $single_favourite_profiles_object_array){
					foreach($single_favourite_profiles_object_array as $single_favourite_profile_array){
						$favourite_profiles_array_values[]=$single_favourite_profile_array->candidate_profile_id;
						$candidate_id=$single_favourite_profile_array->candidate_profile_id;
						if(!in_array($candidate_id,$profiles_to_unlock)){
							$new_favourite_profiles_array[]=$single_favourite_profile_array;
						}
					
					}
				}
				$new_favourite_profiles_object=new StdClass();
				$new_favourite_profiles_object->favourite_profiles_array=$new_favourite_profiles_array;
				$recruiter_page->favourite_profiles_array = json_encode($new_favourite_profiles_object);
			}
			// $recruiter_page->favourite_profiles_array = json_encode(array_values(array_diff(json_decode($recruiter_page->favourite_profiles_array), $profiles_to_unlock)));
		}

		
		/* Save the recruiter page */
		$recruiter_page->save();
		$to_return->success->success_status = true;

		/* If all the requested profiles have been unlocked successfully */
		// if(count($regular_candidates_to_unlock) == count($requested_profiles_to_unlock)){
		// 	$to_return->success->success_message = "All the requested profiles have been unlocked successfully.";
		// }
		// else
		if(count($profiles_to_unlock) == count($requested_profiles_to_unlock)){
			$to_return->success->success_message = "All the requested profiles have been unlocked successfully.";
		}
		/* If some profiles were not unlocked */
		else{
			$to_return->success->success_message = count($already_unlocked_array)." Profiles were already unlocked.\nNewly unlocked ".count($profiles_to_unlock)." profiles.";
		}

		return;
		/*Amruta Jagtap 2021-04-06 End code */
	}
	/* Function to unlock profiles with given IDs END */

	/* Function to fetch table data for the favourites table */
	function fetch_favourite_table_data($requested_columns_to_show){
		/* Access global variable that is to be returned */
		global $to_return;
		global $candidate_status_filter;
		global $candidate_status_filter_show_only;
		global $candidate_page;
		$favourite_profiles_array=array();
		$recruiter_page_array=array();

		// echo $candidate_status_filter;
		// echo "****";
		/* For column names and variables */
		require_once \ProcessWire\wire("config")->paths->templates.'includes/candidate_table_data.php';

		/* Get the current recruiter's page */
		// $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}

		/* If default columns are not requested, convert query to an array from json */
		if(!in_array($requested_columns_to_show, ["default", "all"])){
			$requested_columns_to_show = json_decode($requested_columns_to_show);

			/* Check if the sent array has zero*/
			if(count($requested_columns_to_show) == 0){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "No columns were selected.";
				end_and_return();
			}
		}

		/*Decide columns availability */
		/* If default columns are requested, get them from the user's account. */
		if ($requested_columns_to_show == "default"){
			$requested_columns_to_show = json_decode($recruiter_page->candidate_table_column_array);
		}

		$available_columns_to_show = $columns_for_recruiter;
		/*Decide columns availability END */

		/* Cross check all the values requested to the available fields, create a new array which contains verified requested columns and their IDs and Titles too */
		$columns_to_show = Array();
		$candidate_data_array = Array();
		$sub_recruiter_array= Array();

		foreach ($requested_columns_to_show as $requested_column_key) {
			if(array_key_exists($requested_column_key, $available_columns_to_show)){
				$columns_to_show[$requested_column_key] = $available_columns_to_show[$requested_column_key];
			}
		}

		/* Save JSON array of chosen columns to show into the recruiter's page. Only the array of keys */
		$recruiter_page->of(false);
		$recruiter_page->candidate_table_column_array = json_encode(array_keys($columns_to_show));
		$recruiter_page->save();

		/* Get the current favourite profiles array */
		$favourite_profiles_object = json_decode($recruiter_page->favourite_profiles_array);
		// print_r($favourite_profiles_object);
		// $favourite_profiles_object_array=$favourite_profiles_object->favourite_profiles_array;
			if($favourite_profiles_object!=""){
				foreach($favourite_profiles_object as $single_favourite_profiles_object_array){
					// $unlocked_profiles_array_data[]=$single_unlocked_profiles_object_array;
					// echo "11";
					// print_r($single_favourite_profiles_object_array);
					foreach($single_favourite_profiles_object_array as $single_favourite_profile_array){
						// echo "12";
					// print_r($single_favourite_profile_array);
					if($candidate_status_filter_show_only=="My Favourites"){
						$session_recruiter_id_page=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
						if(($single_favourite_profile_array->recruiter_id)==($session_recruiter_id_page->id)){
							$favourite_profiles_array[]=$single_favourite_profile_array->candidate_profile_id;
						}
						
					}
					else{
						$favourite_profiles_array[]=$single_favourite_profile_array->candidate_profile_id;
					}
						
					
					}
				}
				// print_r($favourite_profiles_array);
			}

		/* If no favourites are already available */
		if($favourite_profiles_array == ""){
			$favourite_profiles_array = Array();
		}
		// echo $recruiter_page->id;

		/* Array to save all the data of all the candidates into */
		$candidate_data_array = Array();
		/* Loop through all the favourite profiles an get their data */
		foreach ($favourite_profiles_array as $candidate_page_id) {
			$candidate_page=NULL;
			$recruiter_candidate_page = \ProcessWire\wire("pages")->get("name=candidates")->child("id=".$candidate_page_id);
			// $candidate_page = $recruiter_candidate_page;
			// echo "1st---";
			// echo $candidate_page->id;
			// echo "1st";
			if($candidate_status_filter!=""){
				
				// echo $recruiter_candidate_page->id;
				// print_r(json_decode($recruiter_candidate_page->recruiter_candidate_status));
				// $recruiter_candidate_page->id="10281";
				if($candidate_status_filter=="Not Viewed"){
					// echo "////";
					if($recruiter_candidate_page->recruiter_candidate_status_for_filter==""){
						// echo "if";
						// echo $recruiter_candidate_page->id;
						// echo "if";
						$candidate_page = $recruiter_candidate_page;
					}
					elseif($recruiter_candidate_page->recruiter_candidate_status_for_filter!=""){
						if(strpos($recruiter_candidate_page->recruiter_candidate_status_for_filter, $recruiter_page->id) === FALSE){
							
							// echo "elseif";
							// echo $recruiter_candidate_page->id;
							// echo "elseif";
							$candidate_page = $recruiter_candidate_page;
							continue;
						}
						else{
							$candidate_status_array= json_decode($recruiter_candidate_page->recruiter_candidate_status_for_filter);
							// print_r($candidate_status_array);
							foreach($candidate_status_array as $recruiter_id=>$candidate_status){
								// echo $recruiter_id;
								// echo "=====";
								// echo $recruiter_page->id;
								// echo "----";
								
								// echo $recruiter_candidate_page->id;
								// echo $candidate_status_filter;
								// echo ".........";
								// echo $candidate_status;
								
								if((in_array($recruiter_id,$recruiter_page_array)) && $candidate_status_filter == ""){
									$candidate_page = $recruiter_candidate_page;
									// echo $candidate_page->id;
								}
								else{
									continue;
								}
							}
						}
						
					}
					else{
						// echo "else";
						// echo $recruiter_candidate_page->id;
						// echo "else";
						continue;
					}
					
				}
				else{
					// if(strpos($recruiter_candidate_page->recruiter_candidate_status, $recruiter_page->id) === FALSE){
						
					// 	continue;
					// }
					// echo "else";
					if($recruiter_candidate_page->recruiter_candidate_status_for_filter != ""){
						$candidate_status_array= json_decode($recruiter_candidate_page->recruiter_candidate_status_for_filter);
						// print_r($candidate_status_array);
						foreach($candidate_status_array as $recruiter_id=>$candidate_status){
							// echo $recruiter_id;
							// echo "=====";
							// echo $recruiter_page->id;
							// echo "----";
							
							// echo $recruiter_candidate_page->id;
							// echo $candidate_status_filter;
							// echo ".........";
							// echo $candidate_status;
							
							if((in_array($recruiter_id,$recruiter_page_array)) && $candidate_status_filter == $candidate_status){
								$candidate_page = $recruiter_candidate_page;
								// echo $candidate_page->id;
								// echo "+++";
								// echo "match";
							}
							else{
								// echo "not match";
								continue;
							}
						}
						// print_r($candidate_status_array);
					}
				}
			}
			else{
				$candidate_page = $recruiter_candidate_page;
				// echo $candidate_page->id;
				// echo "before filter";
			}
			
			
			if($candidate_page==NULL){
				continue;
			}
			// echo $candidate_page->id;
			// echo "******";
			/* Each candidate's data is to be saved in a seperate object */
			$candidate_data = new stdClass();

			/* Code for the selectbox to be shown in the table */
			$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
			$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."' class='[ btn btn-outline-primary  ] view_candidate_profile' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";
			/* Loop through all the columns that are to be shown */
			foreach ($columns_to_show as $column_id => $column_title) {
				/* All these are special cases where the output is not readily available in the database. Create the output and save it into the object. */
				switch ($column_id) {
					case "date_of_birth":
						// $candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						if($candidate_page->date_of_birth!=""){
							$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						}
						else{
							$candidate_data->date_of_birth="-";
						}
					break;

					case "custom_experience":
						$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

					case "custom_ctc":
						$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

					case "redacted_resume":
						$candidate_data->redacted_resume = "-";

						if ($candidate_page->redacted_resume) {
							$candidate_data->redacted_resume = "<a href='".$candidate_page->redacted_resume->httpUrl."' target='_blank'>Download<a>";
						}

					break;

					case "registration_time":
						$candidate_data->registration_time = date("F j, Y, g:i a", intval($candidate_page->created));
					break;
					case "internship_month":
						//$internship_apply=$user_page->internship_apply;
						
							$months=array();
							$months=json_decode($candidate_page->internship_month);
						if(!empty($months)){
							// echo "************";
							// echo $candidate_page->internship_month;
							// print_r($months);
							$candidate_data->internship_month=implode(", ",$months);
						}
						else{
							$candidate_data->internship_month="";
						}
				break;

					/* For all the other outputs, they are to be shown as they are from the page data. */
					default:
						$candidate_data->$column_id = $candidate_page->$column_id;
						break;
				}
			}

			/* Save the candidate data object into the main array of all the candidate data */
			array_push($candidate_data_array, $candidate_data);
		}

		/* Save the candidate data array into the object that is to be sent back */
		$to_return->data = $candidate_data_array;
   //print_r($candidate_data_array);
		/* Names of the columns to be displayed will be saved in this array */
		$to_return->columns = array();

		/* Add a column object for the selctbox column */
		$temp_object = new stdClass();
		$temp_object->title = "";
		$temp_object->data = "selectbox";

		$view_profile = new stdClass();
		$view_profile->title = "View Profile";
		$view_profile->data = "view_profile_button";

		$to_return->columns[] = $temp_object;
		$to_return->columns[] = $view_profile;
		/* Add a column object for the selctbox column END*/
   //print_r($columns_to_show);
		/* Creating table column objects from array */
		foreach ($columns_to_show as $key => $value) {
			$temp_object = new stdClass();
			$temp_object->title = $value;
			$temp_object->data = $key;

			$to_return->columns[] = $temp_object;
			
		}
		/* Creating table column objects from array END */
        $to_return->success->success_status = true;
		
		end_and_return();
	}
	/* Function to fetch table data for the favourites table END */

	/* Function to fetch table data for the unlocked table */
	function fetch_unlocked_table_data($requested_columns_to_show){
		/* Access global variable that is to be returned */
		global $to_return;
		global $unlock_candidate_status_filter;
		global $unlock_candidate_status_filter_show_only;
		global $no_show_only_mine_profiles;
		global $is_show_only_mine_filter;
		global $unlocked_recruiter_columns;
		$recruiter_page_array=Array();

		$no_show_only_mine_profiles=false;
		// echo "s1";
		/* For column names and variables */
		require_once \ProcessWire\wire("config")->paths->templates.'includes/candidate_table_data.php';

		/* Get the current recruiter's page */
		// $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		
		$unlocked_profiles_array = fetch_unlocked_array();
		
		/* If no unlcoked profils are available */
		// if((!count($unlocked_profiles_array)) && ($no_show_only_mine_profiles==false)){
		// 	$to_return->error->number_of_errors++;
		// 	$to_return->error->error_message = "No unlocked profiles available.";
		// 	end_and_return();
		// }
		// // echo "s9";
		// if((!count($unlocked_profiles_array)) && ($no_show_only_mine_profiles==true)){
		// 	$to_return->error->number_of_errors++;
		// 	$to_return->error->error_message = "You are not unlocked any profile.";
		// 	end_and_return();
		// }

		/* Array to save all the data of all the candidates into */
		$candidate_data_array = Array();
		$sub_recruiter_array= Array();
		$candidate_page=0;
		
		/*Decide columns availability */
		$columns_to_show = $unlocked_columns_for_recruiter;
		
		$recruiter_job_code_array=array();

		$recruiter_job_code_array = \ProcessWire\wire("pages")->get("name=jobs")->children("job_added_by=".\ProcessWire\wire("session")->user_page_id)->each("job_code");
		
		/* Loop through all the favourite profiles an get their data */
		foreach ($unlocked_profiles_array as $candidate_page_id) {
		
			$candidate_page=NULL;
 			$recruiter_candidate_page = \ProcessWire\wire("pages")->get("name=candidates")->child("id=".$candidate_page_id.",active_status=active");
		
			if($unlock_candidate_status_filter!=""){
				
				if($unlock_candidate_status_filter == "Not Viewed"){
					if($recruiter_candidate_page->recruiter_candidate_status_for_filter==""){
						// echo "if";
						// echo $recruiter_candidate_page->id;
						// echo "if";
						$candidate_page = $recruiter_candidate_page;
					}
					elseif($recruiter_candidate_page->recruiter_candidate_status_for_filter!=""){
						if(strpos($recruiter_candidate_page->recruiter_candidate_status_for_filter, $recruiter_page->id) === FALSE){
							
							// echo "elseif";
							// echo $recruiter_candidate_page->id;
							// echo "elseif";
							$candidate_page = $recruiter_candidate_page;
							continue;
						}
						else{
							$candidate_status_array= json_decode($recruiter_candidate_page->recruiter_candidate_status_for_filter);
							// print_r($candidate_status_array);
							foreach($candidate_status_array as $recruiter_id=>$candidate_status){
							
								if((in_array($recruiter_id,$recruiter_page_array)) && $unlock_candidate_status_filter == ""){
									$candidate_page = $recruiter_candidate_page;
									// echo $candidate_page->id;
								}
								else{
									continue;
								}
							}
						}
						
					}
					else{
						continue;
					}
					//
					// if($recruiter_candidate_page->recruiter_candidate_status==""){
						
					// 	$candidate_page = $recruiter_candidate_page;
					// }
					// elseif(strpos($recruiter_candidate_page->recruiter_candidate_status, $recruiter_page->id) === FALSE){
						
					// 	$candidate_page = $recruiter_candidate_page;
						
					// }
					// else{
						
					// 	continue;
					// }
					
				}
				else{
					
					// if(strpos($recruiter_candidate_page->recruiter_candidate_status, $recruiter_page->id) === FALSE){
					// 	continue;
					// }
					
					if($recruiter_candidate_page->recruiter_candidate_status_for_filter!=""){
						$candidate_status_array= json_decode($recruiter_candidate_page->recruiter_candidate_status_for_filter);
						foreach($candidate_status_array as $recruiter_id=>$candidate_status){
							// if($recruiter_page->id ==$recruiter_id && $unlock_candidate_status_filter == $candidate_status){
							if((in_array($recruiter_id,$recruiter_page_array))&& $unlock_candidate_status_filter == $candidate_status){
								$candidate_page = $recruiter_candidate_page;
							}
							else{
								continue;
							}
						}
					}
				}
			}
			else{
				$candidate_page = $recruiter_candidate_page;
			}
			

			if($candidate_page==NULL){
				continue;
			} 

			if($candidate_page->id==0){
			    continue;
			}
			else{
				// echo $candidate_page->id;
				// echo "***";
			/* Each candidate's data is to be saved in a seperate object */
			$candidate_data = new stdClass();

			/* Code for the selectbox to be shown in the table */
			$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
			$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."' class='[ btn btn-outline-primary  ] view_candidate_profile' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";
			// $candidate_data->download_resume_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."' class='[ btn btn-outline-primary  ] view_candidate_profile mt-2 ' type='button' data-toggle='tooltip' data-placement='top' title='View profile' style='padding: 6px 15px;'><i class='[ ][ fas fa-file ]'></i></a>";
			if ($candidate_page->resume) {
				$candidate_data->download_resume_button = "<a href='".$candidate_page->resume->httpUrl."' target='_blank' id='".$candidate_page->id."' class='[ btn btn-outline-primary  ] candidate_resume_download mt-2' , type='button' data-toggle='tooltip' data-placement='top' title='Download resume' style='padding: 6px 13px;'><i class='fas fa-download icon' style='font-size=18px;'></i><a>";
				$candidate_data->view_actions=$candidate_data->view_profile_button." ".$candidate_data->download_resume_button;
			}
			else{
				$candidate_data->view_actions=$candidate_data->view_profile_button;
			}

			
			$candidate_job_code_array = array_map('trim', array_filter(explode(",",$candidate_page->job_code)));
				$job_code_intersect_array=array_intersect($recruiter_job_code_array,$candidate_job_code_array);
			/* Loop through all the columns that are to be shown */
			foreach ($columns_to_show as $column_id => $column_title) {
				/* All these are special cases where the output is not readily available in the database. Create the output and save it into the object. */
				switch ($column_id) {
				       
					case "custom_full_name":
						$candidate_data->custom_full_name = $candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
					break;

					case "custom_phone_number":
						$candidate_data->custom_phone_number = $candidate_page->phone_country_code.$candidate_page->phone_number;
					break;

					case "date_of_birth":
						// $candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						if($candidate_page->date_of_birth!=""){
							$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						}
						else{
							$candidate_data->date_of_birth="-";
						}
					break;

					case "custom_experience":
						$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

					case "custom_ctc":
						$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

					// case "internship_apply":
					// 	$candidate_data->internship_apply = $candidate_page->internship_apply;
					// break;

					// case "age16over":
					// 	$candidate_data->age16over = $candidate_page->age16over;
					// break;

					case "internship_month":
						//$candidate_data->internship_month = $candidate_page->internship_month;
						$months=array();
								$months=json_decode($candidate_page->internship_month);
							if(!empty($months)){
								$candidate_data->internship_month=implode(", ",$months);
							}
							else{
								$candidate_data->internship_month="";
							}
					break;

					// case "resume":
					// 	$candidate_data->resume = "-";

					// 	if ($candidate_page->resume) {
					// 		$candidate_data->resume = "<a href='".$candidate_page->resume->httpUrl."' target='_blank' id='".$candidate_page->id."' class='candidate_resume_download'>Download<a>";
					// 	}

					// break;

					case "profile_picture":
						$candidate_data->profile_picture = "-";

						if ($candidate_page->profile_picture) {
							$candidate_data->profile_picture = "<a href='".$candidate_page->profile_picture->httpUrl."' target='_blank'>Show<a>";
						}

					break;

					case "redacted_resume":
						$candidate_data->redacted_resume = "-";

						if ($candidate_page->redacted_resume) {
							$candidate_data->redacted_resume = "<a href='".$candidate_page->redacted_resume->httpUrl."' target='_blank'>Download<a>";
						}

					break;

					case "registration_time":
						$candidate_data->registration_time = date("F j, Y, g:i a", intval($candidate_page->created));
					break;
					
					case "job_code":
						$candidate_data->job_code =implode(",",$job_code_intersect_array) ;
					break;

					/* For all the other outputs, they are to be shown as they are from the page data. */
					default:
						$candidate_data->$column_id = $candidate_page->$column_id;
					break;
				}
			}

			/* Save the candidate data object into the main array of all the candidate data */
			array_push($candidate_data_array, $candidate_data);
			}

		
		}

		/* Save the candidate data array into the object that is to be sent back */
		$to_return->data = $candidate_data_array;

		/* Names of the columns to be displayed will be saved in this array */
		$to_return->columns = array();

		/* Add a column object for the selctbox column */
		$temp_object = new stdClass();
		// $temp_object->title = "";
		// $temp_object->data = "selectbox";

		$view_profile = new stdClass();
		$view_profile->title = "View Actions";
		$view_profile->data = "view_actions";

		// $to_return->columns[] = $temp_object;
		$to_return->columns[] = $view_profile;
		/* Add a column object for the selctbox column END*/

		/* Creating table column objects from array */
		foreach ($columns_to_show as $key => $value) {
			$temp_object = new stdClass();
			$temp_object->title = $value;
			$temp_object->data = $key;

			$to_return->columns[] = $temp_object;
			
		}
		/* Creating table column objects from array END */

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch table data for the unlocked table END */

	/* Function to check the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_unlocked_array(){
		global $unlock_candidate_status_filter;
		global $unlock_candidate_status_filter_show_only;
		global $to_return;
		global $no_show_only_mine_profiles;
		// echo "s3";
		/* Get the current recruiter's page */
		if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
		}
		
		$recruiter_page->of(false);

		/* Get the current favourite profiles array */
		$unlocked_profiles_array=Array();
		$unlocked_profiles_array_data=Array();
		if(!empty($recruiter_page->unlocked_profiles_array)){
			$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
			// $unlocked_profiles_object_array=$unlocked_profiles_object->unlocked_profiles_array;
			// $unlocked_profiles_object_array=array_reverse($unlocked_profiles_object_array);
			// $no_show_only_mine_profiles=false;
			// echo "s4";
			if($unlocked_profiles_object!=""){
				foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
					$unlocked_profiles_array_data[]=$single_unlocked_profiles_object_array;
					// echo "s5";
					foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
						if($unlock_candidate_status_filter_show_only=="My Unlocks"){
							// echo "s6";
							// echo $unlock_candidate_status_filter_show_only;
							// echo "show only";
							$session_recruiter_id_page=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
							if(($single_unlocked_profile_array->recruiter_id)==($session_recruiter_id_page->id)){
								$unlocked_profiles_array[]=(int)$single_unlocked_profile_array->candidate_profile_id;
							}
							// echo count($unlocked_profiles_array);
							// if(!count($unlocked_profiles_array)){
							// 	$no_show_only_mine_profiles=true;
							// }
						}
						else{
							// echo "s7";
							$unlocked_profiles_array[]=(int)$single_unlocked_profile_array->candidate_profile_id;
						}
						
						
					}
				}
				// echo "s8";
				// print_r($unlocked_profiles_array);
				// echo "fetch_unlocked_array";
			}
			
			
			/* Now returned the flattened array containing only unlcoked IDs */
			return $unlocked_profiles_array;
		}
		
	}
	/* Function to check the unlocked array, delete expired profiles, return an array withonly IDs END */


	/* Function to save data of candidate resume download with given IDs */
	function candidate_resume_download($requested_profiles_to_download_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_recruiter_profile_type;
		global $session_user_id;
		global $candidate_id;
		$candidate_id_array=array();
		$requested_profiles_to_download=array();
		$session_user_id=\ProcessWire\wire("session")->user_page_id;
		$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;
		// echo $requested_profiles_to_download_json;
		// echo $session_user_id;
		// echo $session_recruiter_profile_type;
		// echo $requested_profiles_to_unlock_json;
		if(\ProcessWire\wire("session")->subscription_expired){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Your subscription is over, please resubscribe to unlock more profiles.";
			return;
		}

		/* Save received JSON data into an array */
		$requested_profiles_to_download = json_decode($requested_profiles_to_download_json);
		// echo "---";
		// print_r($requested_profiles_to_download);

		
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_download) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were download.";
			return;
		}

		/* Get the current recruiter's page */
		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
			$super_recruiter_page = \ProcessWire\wire("pages")->get($session_user_id)->parent();
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
		}
		$recruiter_page->of(false);
		$candidate_download_profile_json=$recruiter_page->candidate_download_profiles;
		if($candidate_download_profile_json==""){
			$candidate_download_profile_json="{}";
			$requested_profiles_to_download->candidate_download_profiles="{}";
		}

		$candidate_download_profiles_array=json_decode($candidate_download_profile_json);
		$candidate_download_profiles_object=new stdClass();
		
		// if(!empty($requested_profiles_to_download)){
			foreach($requested_profiles_to_download as $single_profile_id){
		// 			$candidate_id_array[]=$single_profile_id;
		// 			// $requested_profiles_to_download[$candidate_id]=$single_profile_id;
		// 			// $requested_profiles_to_download->candidate_id=$single_profile_id;
					$candidate_id=$single_profile_id;
					$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		// 			$candidate_download_profiles_object->recruiter_id=$recruiter_page->id;
		// 			$candidate_download_profiles_object->timestamp=$current_timestamp;
					$candidate_download_profiles_array->$candidate_id=$current_timestamp;
					$recruiter_page->candidate_download_profiles = json_encode($candidate_download_profiles_array);
			}
		// }
		// echo $candidate_download_profiles_object;
		// echo "999";
		
		// echo "data";
		// echo $recruiter_page->candidate_download_profiles;
		// echo "***";

		$recruiter_page->save();
		$to_return->success->success_status = true;
		$to_return->success->success_message = "Resume has been downloaded successfully.";

		return;
		/*Amruta Jagtap 2021-04-06 End code */
	}
	/* Function to save data of candidate resume download with given IDs END */

	
	/* Function to save data of candidate viewed profile with given IDs */
	function view_candidate_profile($requested_profiles_to_viewed_profile_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_recruiter_profile_type;
		global $session_user_id;
		global $candidate_id;
		$candidate_id_array=array();
		$requested_profiles_to_viewed=array();
		$session_user_id=\ProcessWire\wire("session")->user_page_id;
		$session_recruiter_profile_type=\ProcessWire\wire("session")->recruiter_profile_type;
		$recruiter_page_array=array();
		// echo $requested_profiles_to_download_json;
		// echo $session_user_id;
		// echo $session_recruiter_profile_type;
		// echo $requested_profiles_to_unlock_json;
		if(\ProcessWire\wire("session")->subscription_expired){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Your subscription is over, please resubscribe to unlock more profiles.";
			return;
		}

		/* Save received JSON data into an array */
		$requested_profiles_to_viewed = json_decode($requested_profiles_to_viewed_profile_json);
		// echo "---";
		// print_r($requested_profiles_to_download);

		
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_viewed) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were view.";
			return;
		}

		/* Get the current recruiter's page */
		if(\ProcessWire\wire("session")->recruiter_profile_type=="sub-recruiter"){
			$super_recruiter_page = \ProcessWire\wire("pages")->get($session_user_id)->parent();
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
			$recruiter_page_array[].=$super_recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$super_recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		else{
			$super_recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
			$recruiter_page = \ProcessWire\wire("pages")->get($session_user_id);
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		$recruiter_page->of(false);
		$candidate_viewed_profile_json=$recruiter_page->candidate_viewed_profiles;
		if($candidate_viewed_profile_json==""){
			$candidate_viewed_profile_json="{}";
			$requested_profiles_to_viewed->candidate_viewed_profiles="{}";
		}

		$candidate_viewed_profiles_array=json_decode($candidate_viewed_profile_json);
		$candidate_viewed_profiles_object=new stdClass();
		// print_r($requested_profiles_to_viewed);
		// echo "requested profile";
		
		foreach($requested_profiles_to_viewed as $single_profile_id){
				$candidate_id=$single_profile_id;
				$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
				$candidate_viewed_profiles_array->$candidate_id=$current_timestamp;
				$recruiter_page->candidate_viewed_profiles = json_encode($candidate_viewed_profiles_array);
				/**Add viewed status in Recruiter candidate status & notes section */
				$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$candidate_id);
				$candidate_status_input='Viewed(Action Pending)';
				$candidates_status_json=$candidate_page->recruiter_candidate_status;
				$candidates_status_json_for_filter=$candidate_page->recruiter_candidate_status_for_filter;
				// echo $candidates_status_json;
				if($candidates_status_json == ""){
					$candidates_status_json='{}';
				}
				if($candidates_status_json_for_filter == ""){
					$candidates_status_json_for_filter='{}';
				}
				$recruiter_page_id=$recruiter_page->id;
				
				//  /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
				// if(strpos($candidates_status_json, $recruiter_page->id) === FALSE){
				// 	echo "if";
				// 	continue;
				// }
				$candidates_status_object = json_decode($candidates_status_json);
				$candidates_status_object_for_filter = json_decode($candidates_status_json_for_filter);
				// print_r($candidates_status_object);
				// echo "before";
				$is_status=false;
				// if(array_key_exists($recruiter_page_id, $candidates_status_object)) {
					// print_r($candidates_status_object);
					// echo "****";
				foreach($candidates_status_object as $candidate_status_recruiter_id=>$candidate_status){
					// if($recruiter_page_id==$candidate_status_recruiter_id && $candidate_status!=""){
					if(in_array($candidate_status_recruiter_id,$recruiter_page_array) && $candidate_status!=""){
						$is_status=true;
						
					}
				} 

				foreach($candidates_status_object_for_filter as $candidate_status_recruiter_id=>$candidate_status){
					// if($recruiter_page_id==$candidate_status_recruiter_id && $candidate_status!=""){
					if(in_array($candidate_status_recruiter_id,$recruiter_page_array) && $candidate_status!=""){
						$is_status=true;
						
					}
				} 
				// echo $is_status;
				// echo "----";
				if($is_status==true){
					continue;
				}
				else{
							
					$candidates_status_object->$recruiter_page_id=$candidate_status_input;
					$candidates_status_object_for_filter->$super_recruiter_page=$candidate_status_input;
					// echo "after";
					// print_r($candidates_status_object);
					$candidate_page->recruiter_candidate_status = json_encode($candidates_status_object);
					$candidate_page->recruiter_candidate_status_for_filter = json_encode($candidates_status_object_for_filter);
				}
				
				// echo "json";
				// echo $candidate_page->recruiter_candidate_status;
	
				/**Save candidate status in notes section */
				$recruiter_candidates_notes_entry_object=new stdClass();
				$recruiter_candidates_notes_entry_object->notes="Status changed to : ".$candidate_status_input;
				$recruiter_candidates_notes_entry_object->timestamp=strtotime(date("Y-m-d h:i:sa"));
				$recruiter_candidates_notes_entry_object->added_by=$recruiter_page->id;
				$candidates_notes_json=$candidate_page->notes_data;
				if($candidates_notes_json == ""){
					$candidates_notes_json='{"notes_details_array":[]}';
				}
				/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
				$candidates_notes_object = json_decode($candidates_notes_json);
				$candidates_notes_object->notes_details_array[] = $recruiter_candidates_notes_entry_object;
				$candidate_page->notes_details_array = json_encode($candidates_notes_object);
				$candidate_page->notes_data=$candidate_page->notes_details_array;

				$candidate_page->of(false);
				$candidate_page->save();
		}
		$recruiter_page->save();
		$to_return->success->success_status = true;
		$to_return->success->success_message = "Candidate profile has been view successfully.";

		return;
		/*Amruta Jagtap 2021-04-06 End code */
	}
	/* Function to save data of candidate viewed profile with given IDs END */

	

