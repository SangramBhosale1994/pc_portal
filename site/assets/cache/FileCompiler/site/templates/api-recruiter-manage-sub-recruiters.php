<?php
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
// 	//Tell the browser to redirect to the HTTPS URL.
// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 	//Prevent the rest of the script from executing.
// 	exit;
// }

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

	/*Define flag for saving data*/
	global $flag; 
	$flag=true;

	global $session_user_id;
	global $search_filter_array;
	global $search_from_date;
	global $search_to_date;

	//global $filter_selector;
	$post_values=$_POST;
	$search_filter_array= Array();

	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Managing Errors and error message in case no message has been logged */
		if($to_return->error->number_of_errors > 0 && $to_return->error->error_message == ""){
			$to_return->error->error_message = "Something went wrong, please refresh the page and try again...";
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
	if(!in_array($session->user_designation, ["recruiter", "admin", "editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}
	// $search_filter_array=Array();
	if(isset($_POST['filter_form']) && $_POST['filter_form']=="true"){
	// if($input->post("search_form_details")!=""){
		// echo "---";
		// echo $_POST['filter_form'];
		// echo "***";
		$search_form_details=$input->post("search_form_details");
		$search_form_details_array=json_decode($search_form_details);
		// echo $search_form_details;
		// print_r($search_form_details_array);
		/* Array to save data and then to save into the page */
		$form_inputs_array = array();
		$print_to_file=true;
		foreach ($search_form_details_array as $input_element) {
			$form_inputs_array[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

		if(array_key_exists("from_date",$form_inputs_array) && $form_inputs_array['from_date']!=""){
			// $search_filter_array[]=(strtotime($form_inputs_array['from_date']));
			$search_from_date=(strtotime($form_inputs_array['from_date'])- 5.50*60*60);
			$search_filter_array[]="published>=".(strtotime($form_inputs_array['from_date'])- 5.50*60*60);
		}
		if(array_key_exists("to_date",$form_inputs_array) && $form_inputs_array['to_date']!=""){
			// $search_filter_array[]=(strtotime($form_inputs_array['to_date']));
			$search_to_date=(strtotime($form_inputs_array['to_date'])- 5.50*60*60);
			$search_filter_array[]="published<=".(strtotime($form_inputs_array['to_date'])- 5.50*60*60);
		}
		// echo "++";
		// print_r($search_filter_array);
		fetch_sub_recruiter_table_data();
	}
	elseif(!isset($_POST['requested_action_to_take'])) {
		/* If no POST request is made, exit with an error message */
		$to_return->error->number_of_errors++;
		end_and_return();
	}
	else{

	}

	/* If no POST request is made, exit with an error message */
	// if (!isset($_POST['requested_action_to_take'])) {
	// 	$to_return->error->number_of_errors++;
	// 	end_and_return();
	// }

	

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_sub_recruiter_table_data", "delete_sub_recruiters", "modify_sub_recruiter", "create_sub_recruiter"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_sub_recruiter_table_data':
			fetch_sub_recruiter_table_data();
		break;

		case 'delete_sub_recruiters':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_sub_recruiters($requested_profiles_to_delete_json);
		break;

		case 'modify_sub_recruiter':
			/* Save the data sent from the form */
			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);
			$to_return->edit_profile_form_details="++++";
			// $to_return->edit_profile_form_details=$edit_profile_form_details;
			// echo "***";
			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			modify_sub_recruiter($edit_profile_form_details);
		break;

		case 'create_sub_recruiter':
			/* Save the data sent from the form */
			$new_sub_recruiter_form_details = $input->post("new_sub_recruiter_form_details", "string", false);

			if(!$new_sub_recruiter_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			create_sub_recruiter($new_sub_recruiter_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	

	/* Function to fetch the data of all recruiters to show in the table */
	function fetch_sub_recruiter_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_user_id;
		global $search_filter_array;
		global $search_from_date;
		global $search_to_date;

		// if(!empty($search_filter_array)){
		// 	$filter_selector=implode(",",$search_filter_array);
		// 	$to_return->filter_selector=$filter_selector;
		// }
		// else{
		// 	$filter_selector="";
		// }
		// echo $filter_selector;
		
		if(isset($_GET['user_id'])){
      $recruiter_page_id=$_GET['user_id'];
      $to_return->user_id=$_GET['user_id'];
			$session_user_id=$recruiter_page_id;
			\ProcessWire\wire("session")->recruiter_page_id=$recruiter_page_id;
    }
		else{
			$session_user_id= \ProcessWire\wire("session")->user_page_id;
		}

		
		

		/* Array to save all the data of all the recruiters into */
		$sub_recruiter_data_array = Array();
		$recruiters_data_array=Array();
		$recruiter_page=\ProcessWire\wire('pages')->get($session_user_id);
		// if($filter_selector!=""){
		// 	$super_recruiter_page=\ProcessWire\wire('pages')->get($session_user_id,$filter_selector);
		// 	$to_return->recruiter_page=\ProcessWire\wire('pages')->get($session_user_id,$filter_selector);
		// 	$to_return->recruiter_page_id=$super_recruiter_page->id;
		// 	if($super_recruiter_page->id!=0){
		// 		$recruiters_data_array[]=$super_recruiter_page->id;
		// 	}
		// 	foreach(\ProcessWire\wire('pages')->get($session_user_id)->children($filter_selector) as $sub_recruiter_page) {
		// 		$recruiters_data_array[]=$sub_recruiter_page->id;
		// 	}
		// }
		// else{
			$recruiters_data_array[]=$recruiter_page->id;
			foreach(\ProcessWire\wire('pages')->get($session_user_id)->children("sort=published") as $sub_recruiter_page) {
				$recruiters_data_array[]=$sub_recruiter_page->id;
			}
		// }
		
		// print_r($recruiters_data_array);


		/* Loop through all the recruiter profile pages */

		 $serial_counter=1;
		foreach($recruiters_data_array as $sub_recruiter_page_id) {
			$sub_recruiter_page=\ProcessWire\wire('pages')->get($sub_recruiter_page_id);
			/* Each candidate's data is to be saved in a seperate object */
			$sub_recruiter_data = new stdClass();
			if($sub_recruiter_page->recruiter_profile_type == "super-recruiter"){
				$sub_recruiter_data->name = $sub_recruiter_page->title." (Super) ";
			}
			else{
				$sub_recruiter_data->name = $sub_recruiter_page->title;
			}
			
			$sub_recruiter_data->email = $sub_recruiter_page->email;
			$sub_recruiter_data->registration_time=$sub_recruiter_page->published +  60*60*5.50;
			$sub_recruiter_data->registration_time=date('d/m/Y h:i A', $sub_recruiter_data->registration_time);
			$sub_recruiter_data->sub_recruiter_quota=$recruiter_page->sub_recruiter_quota;
			$sub_recruiter_data->serial_number=$serial_counter;
			$serial_counter++;
			/**Calculate Unlocked profiles by sub recruiter */
			$unlocked_profiles_array=array();
			$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
			// $unlocked_profiles_object_array=$unlocked_profiles_object->unlocked_profiles_array;
				if($unlocked_profiles_object!=""){
					foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
						foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
							// echo $single_unlocked_profile_array->recruiter_id;
							// echo "***";
							if($search_from_date!="" && $search_to_date!=""){
								if($search_from_date < $single_unlocked_profile_array->timestamp && $search_to_date > $single_unlocked_profile_array->timestamp){
									if($single_unlocked_profile_array->recruiter_id==$sub_recruiter_page->id){
										$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
									}
								}
							}
							else{
								if($single_unlocked_profile_array->recruiter_id==$sub_recruiter_page->id){
									$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
								}
							}

							
							
							
						}
					}
				}
			if(!empty($unlocked_profiles_array)){
				$sub_recruiter_data->unlocked_profiles_count = sizeof($unlocked_profiles_array);
			}
			else{
				$sub_recruiter_data->unlocked_profiles_count="0";
			}
			
			/**Calculate Favourite profiles by sub recruiter */
			$favourite_profiles_array=array();
			$favourite_profiles_object = json_decode($recruiter_page->favourite_profiles_array);
				if($favourite_profiles_object!=""){
					foreach($favourite_profiles_object as $single_favourite_profiles_object_array){
						foreach($single_favourite_profiles_object_array as $single_favourite_profile_array){
							if($search_from_date!="" && $search_to_date!=""){
								if($search_from_date < $single_favourite_profile_array->timestamp && $search_to_date > $single_favourite_profile_array->timestamp){
									if($single_favourite_profile_array->recruiter_id==$sub_recruiter_page->id){
										$favourite_profiles_array[]=$single_favourite_profile_array->candidate_profile_id;
									}
								}
							}
							else{
								if($single_favourite_profile_array->recruiter_id==$sub_recruiter_page->id){
									$favourite_profiles_array[]=$single_favourite_profile_array->candidate_profile_id;
								}
							}
							
						}
					}
				}
			if(!empty($favourite_profiles_array)){
				$sub_recruiter_data->favourite_profiles_count = sizeof($favourite_profiles_array);
			}
			else{
				$sub_recruiter_data->favourite_profiles_count="0";
			}
			/**Calculate spending time on tool based on login & logout timestamp */

			/**Latest offer entry */
			if($sub_recruiter_page->offers_input_data!=""){
				// global $current_timestamp;
				$recruiter_offers_input_array=json_decode($sub_recruiter_page->offers_input_data); // decode the JSON string into an associative array
				if(!empty($recruiter_offers_input_array)){
					$last_offer_entry_key = end($recruiter_offers_input_array); // pass the variable by reference to the end() function
					$last_offer_input = key($recruiter_offers_input_array);
					$sub_recruiter_data->offers_input = $last_offer_input;
				}
				else{
					$sub_recruiter_data->offers_input = "0";
				}
			}
			else{
				$sub_recruiter_data->offers_input = "-";
			}
			/**Latest offer entry end */


			// echo $sub_recruiter_page->time_logs;
			// echo "****";
			// echo $sub_recruiter_page->id;
			if(!empty($sub_recruiter_page->time_logs)){
				// echo "/////";
				$time_logs_array=json_decode($sub_recruiter_page->time_logs);
				if(!empty($time_logs_array)){
					// echo "+++";
					$final_spent_time_difference=0;
					$login_timestamp=0;
					$logout_timestamp=0;
					$last_login_time="";
					foreach($time_logs_array as $single_time_log_array){
						foreach($single_time_log_array as $single_time_log){
							if($single_time_log->login!=""){
								$last_login_time=date( "d/m/Y h:i A" , (($single_time_log->login)+60*60*5.50 ));
								
							}

							if($search_from_date!="" && $search_to_date!=""){
								if(($search_from_date < $single_time_log->login) && ($search_to_date > $single_time_log->logout)){
									$login_timestamp=$single_time_log->login;
									$logout_timestamp=$single_time_log->logout;
									
								}
							}
							else{
								$login_timestamp=$single_time_log->login;
								$logout_timestamp=$single_time_log->logout;
							}
							
							if($login_timestamp==""){
								continue;
							}
							if($logout_timestamp==""){
								continue;
							}
							elseif($logout_timestamp!="" && $login_timestamp!="" ){
								$spent_time_difference=$logout_timestamp-$login_timestamp;
			
								$final_spent_time_difference+=$spent_time_difference;
							}
							else{
								
							}
						}
					}
				}
				if($last_login_time!=""){
					$sub_recruiter_data->last_login_time=$last_login_time;
				}
				else{
					$sub_recruiter_data->last_login_time="-";
				}
				
				$spent_hours= 0;
				$spent_minutes=0;
				$spent_seconds=0;
				if($final_spent_time_difference!=""){

						$spent_hours= $final_spent_time_difference / 60;
						$spent_minutes=$spent_hours % 60;
						$spent_seconds=$final_spent_time_difference % 60;
						$spent_hours=$spent_hours / 60;
						$spent_time= (int)$spent_hours." Hours ".(int)$spent_minutes." Minutes ".(int)$spent_seconds." Seconds";
						// $spent_time= (int)$spent_hours." H ".(int)$spent_minutes." M ".(int)$spent_seconds." S";

					$sub_recruiter_data->spent_time=$spent_time;
				}
				else{
					$sub_recruiter_data->spent_time="-";
				}
				
				
			}
			else{
				$sub_recruiter_data->last_login_time="-";
				$sub_recruiter_data->spent_time="-";
			}
			// echo $spent_time;
			// echo date( "H:i:s" , $spent_time );/60)/60
			/**Search count of posted jobs between two dates */
			if($search_from_date!="" && $search_to_date!=""){
				// echo $search_from_date;
				// echo "***";
				// echo $search_to_date;
				// echo "---";
				/**Calculate count of jobs posted by each sub-recruiter */
				$counter=0;
				foreach(\ProcessWire\wire('pages')->get("name=jobs")->children("job_added_by=".$sub_recruiter_page->id) as $single_job_page){
					if($single_job_page->published>=$search_from_date && $single_job_page->published<=$search_to_date){
						$counter++;
					}
				}
				$sub_recruiter_data->job_posted_by_sub_recruiter=$counter;
				// echo $counter;
			}
			else{
				/**Calculate count of jobs posted by each sub-recruiter */
				$sub_recruiter_data->job_posted_by_sub_recruiter=\ProcessWire\wire('pages')->get("name=jobs")->children("job_added_by=".$sub_recruiter_page->id)->count();
			}
			// echo "++++";
			// echo $sub_recruiter_data->job_posted_by_sub_recruiter;
			/**Check how many candidate status changes by sub-recruiter */
			$candidate_status_count=0;
			foreach(\ProcessWire\wire('pages')->get("name=candidates")->children("recruiter_candidate_status!=") as $candiate_page){
				// echo $candiate_page->id;
				// echo "candidate ststau apage";
				if($candiate_page->recruiter_candidate_status!=""){
					// echo "////";
					$recruiter_candidate_status=$candiate_page->recruiter_candidate_status;
					$candidate_status_array=json_decode($recruiter_candidate_status);
					// print_r($candidate_status_array);
					// echo "recruiter candidate status array";
					foreach($candidate_status_array as $single_recruiter_id=>$single_candidate_status){
						// echo $sub_recruiter_page->id;
						// echo "//88//";
						// echo $single_recruiter_id;
						// echo "//99//";
						if($sub_recruiter_page->id==$single_recruiter_id){
							// echo $search_from_date;
							// echo "++++++";
							// echo $search_to_date;
							// echo "////";
							if($search_from_date!="" && $search_to_date!=""){
								$notes_details_array=json_decode($candiate_page->notes_data);
								// print_r($notes_details_array);
								// echo "Notes Data Array";
								$recruiter_added_by=Array();
								if(!empty($notes_details_array)){
									foreach($notes_details_array as $single_notes_details_array){
										foreach($single_notes_details_array as $single_notes_array){
											// print_r($single_notes_array);
											// echo "----";
											$added_by=$single_notes_array->added_by;
											// $recruiter_added_by[]=$single_notes_array->added_by;
											// echo $added_by;
											// echo "added by id";
											// echo $sub_recruiter_page->id;
											// echo "rectruiter id";
											// echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++";
											if(($sub_recruiter_page->id==$added_by)){
												if (strpos($single_notes_array->notes, $single_candidate_status) !== false) {
												// && ($single_candidate_status==$single_notes_array->notes)
												// echo $single_candidate_status;
												// echo "notes";
												// echo $single_notes_array->notes;
												// echo "notes data";
												$timestamp=$single_notes_array->timestamp;
												// echo $timestamp;
												// echo "candidate timestamp";
												// echo $search_from_date;
												// echo "from";
												// echo $search_to_date;
												// echo "to";
												// echo "count";
												// echo $candidate_status_count;
												// echo "count---";
												if(($search_from_date < $timestamp) && ($search_to_date > $timestamp)){
													// echo "condition match";

													$candidate_status_count++;
												}
												}
											}
										}
									}
								}
							}
							else{
								// echo "else";
								$candidate_status_count++;
							}
						}
					}
					$sub_recruiter_data->candidate_status_changed_by_rcuiter_count=$candidate_status_count;
					
				}
				else{
					// echo "+++";
					$sub_recruiter_data->candidate_status_changed_by_rcuiter_count=$candidate_status_count;
				}
			}
			// echo "final count";
			// 		echo $candidate_status_count;
			// 		echo "***final count End";
			/**End Check how many candidate status changes by sub-recruiter */

				
			/**add button for see all posted jobs by sub-recruiter */
			$posted_jobs_link=\ProcessWire\wire('pages')->get("name=recruiter-manage-jobs")->httpUrl."?job_added_by=".$sub_recruiter_page->id;
			$sub_recruiter_data->view_posted_jobs="<a target='_blank' href='".$posted_jobs_link."' id='".$sub_recruiter_page->id."_view_posted_jobs_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>View Jobs</a>";

			/**Add button of report page - report of unlocked & downloaded data */
			$report_page_link=\ProcessWire\wire('pages')->get("name=recruiter-report-page")->httpUrl."?user_id=".$sub_recruiter_page->id;
			$sub_recruiter_data->report_page="<a target='_blank' href='".$report_page_link."' id='".$sub_recruiter_page->id."_report_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Reports</a>";

			/* Other column data in the table */
			$sub_recruiter_data->checkbox = "<input id='".$sub_recruiter_page->id."_checkbox' class='recruiter_checkbox' type='checkbox'>";
			$sub_recruiter_data->edit = "<button id='".$sub_recruiter_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit Profile</button>";
			
			$sub_recruiter_data->id = $sub_recruiter_page->id;

			/* Save the recruiter data object into the main array of all the recruiter data */
			array_push($sub_recruiter_data_array, $sub_recruiter_data);
		}
		/* Loop through all the recruiter profile pages END */

		/* Save the recruiter data array into the object that is to be sent back */
		$to_return->data = $sub_recruiter_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Name", "data"=>"name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Posted Jobs", "data"=>"job_posted_by_sub_recruiter"],
			["title"=>"Unlocked Profiles", "data"=>"unlocked_profiles_count"],
			["title"=>"Favourite Profiles", "data"=>"favourite_profiles_count"],
			["title"=>"Last Login Time", "data"=>"last_login_time"],
			["title"=>"Time Spent", "data"=>"spent_time"],
			["title"=>"Candidate status changed", "data"=>"candidate_status_changed_by_rcuiter_count"],
			["title"=>"Offers", "data"=>"offers_input"],
			["title"=>"Created Time", "data"=>"registration_time"],
			["title"=>"Registration Time", "data"=>"registration_time"],
			["title"=>"Edit", "data"=>"edit"],
			["title"=>"View Posted Jobs", "data"=>"view_posted_jobs"],
			["title"=>"Reports", "data"=>"report_page"]
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all recruiters to show in the table END */

	/* Function to delete recruiter accounts based on given IDs */
	function delete_sub_recruiters($requested_profiles_to_delete_json){
		/* Access global variable that is to be returned */
		global $to_return;
		global $session_user_id;

		$session_user_id= \ProcessWire\wire("session")->user_page_id;

		/* Save received JSON data into an array */
		$requested_profiles_to_delete = json_decode($requested_profiles_to_delete_json);

		/* Check if the sent array has zero or more than ten elements. Only 10 can be deleted at a time */
		if(count($requested_profiles_to_delete) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were deleted.";
			end_and_return();
		}
		// elseif (count($requested_profiles_to_delete) > 10) {
		// 	$to_return->error->number_of_errors++;
		// 	$to_return->error->error_message  = "Only 10 profiles can be deleted at a time.";
		// 	end_and_return();
		// }

		$successfully_deleted_profiles = Array();

		/* Delete each requested profile */
		foreach ($requested_profiles_to_delete as $profile_to_delete_id) {
			if(\ProcessWire\wire("pages")->get($session_user_id)->child("id=".$profile_to_delete_id)->trash()){
				$successfully_deleted_profiles[] = $profile_to_delete_id;
			}
		}
		/* Delete each requested profile END */

		/* If no profiles are deleted */
		if(!count($successfully_deleted_profiles)){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Profiles could not be deleted. Please try again.";
			end_and_return();
		}
		else{
			$to_return->success->success_status = true;

			/* If all the requested profiles have been deleted successfully */
			if(count($successfully_deleted_profiles) == count($requested_profiles_to_delete)){
				$to_return->success->success_message = "All the requested profiles have been deleted successfully.";
			}
			/* If some profiles were not deleted */
			else{
				$to_return->success->success_message = "Some profiles could not be deleted. Please try again.";
			}
		}

		end_and_return();
	}
	/* Function to delete recruiter accounts based on given IDs END */

	/* Function to modify the information of an recruiter profile from POST data */
	function modify_sub_recruiter($edit_profile_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		global $flag;
		// echo "----";
		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);
		// print_r($edit_profile_form_details);
		/* Array to save data and then to save into the page */
		$edit_sub_recruiter_details_to_save = Array();
		foreach ($edit_profile_form_details as $input_element) {
		    //print_r($input_element);
			$edit_sub_recruiter_details_to_save[$input_element->name] = $input_element->value;
		}
		// echo "****";
		// echo $edit_sub_recruiter_details_to_save['id'];
		/* Array to save data and then to save into the page END */

		/* Get the recruiter page to edit based on the ID */
		$sub_recruiter_page_to_change = \ProcessWire\wire('pages')->get($edit_sub_recruiter_details_to_save['id']);
		// echo $sub_recruiter_page_to_change;
		$sub_recruiter_page_to_change->of(false);

		/* Save the data */
		$sub_recruiter_page_to_change->title = $edit_sub_recruiter_details_to_save['sub_recruiter_name'];
		$sub_recruiter_page_to_change->email = $edit_sub_recruiter_details_to_save['sub_recruiter_email'];
		
		
		// $recruiter_page_to_change->company_name = $edit_sub_recruiter_details_to_save['recruiter_company_name'];
      $password_change_message="";
		if($edit_sub_recruiter_details_to_save['sub_recruiter_password'] != ""){
			$sub_recruiter_page_to_change->password = $edit_sub_recruiter_details_to_save['sub_recruiter_password'];
			$password_change_message="\n\nPassword changed successfully.";
		}
		
		// $recruiter_page_to_change->subscription_from = $edit_recruiter_details_to_save['recruiter_subscription_from'];
		// $recruiter_page_to_change->subscription_to = $edit_recruiter_details_to_save['recruiter_subscription_to'];
		// $recruiter_page_to_change->unlock_quota = $edit_recruiter_details_to_save['recruiter_unlock_quota'];
		// $recruiter_page_to_change->applicants_unlock_quota = $edit_recruiter_details_to_save['recruiter_applicants_unlock_quota'];
		// $recruiter_page_to_change->job_limit = $edit_recruiter_details_to_save['recruiter_job_limit'];
		// /** Edit Sub recruiter quota count in recuiter profile page */
		// $recruiter_page_to_change->sub_recruiter_quota = $edit_recruiter_details_to_save['recruiter_sub_recruiter_quota'];
		// /** End Edit Sub recruiter quota count in recuiter profile page */
		// $recruiter_page_to_change->recruiter_type = $edit_recruiter_details_to_save['recruiter_type'];
		// $recruiter_page_to_change->recruiter_accessible_sections =\ProcessWire\pagearray($accessible_sections) ;


		/* Save page */
		//if($flag==true){
			$sub_recruiter_page_to_change->save();
		//}

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Modified recruiter profile with the name ".$sub_recruiter_page_to_change->title = $edit_sub_recruiter_details_to_save['sub_recruiter_name'];
		$to_return->success->success_message.=$password_change_message;
		end_and_return();
	}
	/* Function to modify the information of an recruiter profile from POST data END*/

	/* Function to create a new recruiter based on given data in POST */
	function create_sub_recruiter($new_sub_recruiter_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		global $flag;
		global $session_user_id;

		$session_user_id= \ProcessWire\wire("session")->user_page_id;

		/* Convert json form data into required format */
		$new_sub_recruiter_form_details = json_decode($new_sub_recruiter_form_details);

		/* Array to save data and then to save into the page */
		$new_sub_recruiter_details_to_save = Array();
		foreach ($new_sub_recruiter_form_details as $input_element) {
			$new_sub_recruiter_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

		/* New recruiter Page info */
		$new_sub_recruiter_page = \ProcessWire\wire(new \ProcessWire\Page());
		$new_sub_recruiter_page->template = \ProcessWire\wire('templates')->get("recruiter-profile");
		$new_sub_recruiter_page->parent = \ProcessWire\wire('pages')->get($session_user_id);

		$new_sub_recruiter_page->title = $new_sub_recruiter_details_to_save['sub_recruiter_name'];
		//$new_recruiter_page->email = $new_recruiter_details_to_save['recruiter_email'];
		$single_recruiter=\ProcessWire\wire('pages')->get($session_user_id)->child("email=".$new_sub_recruiter_details_to_save['sub_recruiter_email']);
		
		if($single_recruiter->id!=0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = $new_sub_recruiter_details_to_save['sub_recruiter_email']." already exists.";
			$flag=false;
		}
		else{
			$new_sub_recruiter_page->email = $new_sub_recruiter_details_to_save['sub_recruiter_email'];
		}

		$new_sub_recruiter_page->password = $new_sub_recruiter_details_to_save['sub_recruiter_password'];
		// $new_recruiter_page->subscription_from = $new_recruiter_details_to_save['recruiter_subscription_from'];
		// $new_recruiter_page->subscription_to = $new_recruiter_details_to_save['recruiter_subscription_to'];
		$new_sub_recruiter_page->recruiter_profile_type = "sub-recruiter";
		// $new_sub_recruiter_page->job_added_by = \ProcessWire\wire('session')->user_page_id;
		$new_sub_recruiter_page->company_name = \ProcessWire\wire('session')->company_name;
		$new_sub_recruiter_page->time_logs = "{}";
		// $recruiter_page=\ProcessWire\wire('pages')->get($session_user_id);
		// $recruiter_page->sub_recruiter_quota = $recruiter_page->sub_recruiter_quota-1;
		$new_sub_recruiter_page->candidate_table_column_array = json_encode(Array());
		// $new_recruiter_page->favourite_profiles_array = json_encode(Array());
		$new_sub_recruiter_page->unlocked_profiles_array = "{}";
		$new_sub_recruiter_page->time_logs = "{}";
		$new_sub_recruiter_page->favourite_profiles_array = "{}";
		$new_sub_recruiter_page->candidate_download_profiles = "{}";
		$new_sub_recruiter_page->candidate_viewed_profiles = "{}";
		// $new_sub_recruiter_page->offers_input_data = "{}";
		// $recruiter_page->of(false);
		// $recruiter_page->save();
		// $new_recruiter_page->recruiter_accessible_sections = $accessible_sections;


		// $new_sub_recruiter_page->candidate_table_column_array = json_encode(Array());
		// $new_sub_recruiter_page->favourite_profiles_array = json_encode(Array());
		// $new_sub_recruiter_page->unlocked_profiles_array = "{}";



		/* Save page */
		if($flag==true){
			$new_sub_recruiter_page->of(false);
			$new_sub_recruiter_page->save();
		}


		/* Return data */
		$to_return->success->success_status = true;
		$to_return->success->success_message = "New sub recruiter created with the name ".$new_sub_recruiter_page->title = $new_sub_recruiter_details_to_save['sub_recruiter_name'];
		end_and_return();
	}
	/* Function to create a new recruiter based on given data in POST END*/










