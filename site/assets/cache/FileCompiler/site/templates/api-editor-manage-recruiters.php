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
	if(!in_array($session->user_designation, ["editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_recruiter_table_data", "delete_recruiters", "modify_recruiter", "create_recruiter"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_recruiter_table_data':
			fetch_recruiter_table_data();
		break;

		case 'delete_recruiters':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_recruiters($requested_profiles_to_delete_json);
		break;

		case 'modify_recruiter':
			/* Save the data sent from the form */
			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);

			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			modify_recruiter($edit_profile_form_details);
		break;

		case 'create_recruiter':
			/* Save the data sent from the form */
			$new_recruiter_form_details = $input->post("new_recruiter_form_details", "string", false);

			if(!$new_recruiter_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			create_recruiter($new_recruiter_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all recruiters to show in the table */
	function fetch_recruiter_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the recruiters into */
		$recruiter_data_array = Array();

		$unlocked_profiles_object=Array();
			$single_unlocked_profiles_object_array=Array();
			$recruiter_id_array=Array();
			$recruiter_offers_input_array=Array();

		/* Loop through all the recruiter profile pages */
		 $serial_counter=1;
		 $super_recruiter=\ProcessWire\wire('pages')->get("name=recruiters");

		foreach(\ProcessWire\wire('pages')->get("name=recruiters")->children("sort=published") as $recruiter_page) {
			/* Each candidate's data is to be saved in a seperate object */
			$recruiter_data = new stdClass();

			
			$recruiter_data->name = $recruiter_page->title;
			$recruiter_data->email = $recruiter_page->email;
			if($recruiter_page->company_name!=""){
			    $recruiter_data->company_name = $recruiter_page->company_name;
			}
			else{
			    $recruiter_data->company_name = "-";
			}
// 			if($recruiter_page->job_limit!=""){
// 			    $recruiter_data->job_limit = $recruiter_page->job_limit;
// 			}
// 			else{
// 			    $recruiter_data->job_limit = "-";
// 			}
			$recruiter_data->subscription_from = date("Y-m-d", (int)$recruiter_page->subscription_from);
			$recruiter_data->subscription_to = date("Y-m-d", (int)$recruiter_page->subscription_to);
			$recruiter_data->subscription_to_for_table = date("d M Y", (int)$recruiter_page->subscription_to);
			$recruiter_data->unlock_quota = $recruiter_page->unlock_quota;
			// $unlocked_profiles_count = sizeof((array)json_decode($recruiter_page->unlocked_profiles_array));
			$unlocked_profiles_array=Array();
			if($recruiter_page->unlocked_profiles_array!=""){
				$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
				if(!empty($unlocked_profiles_object)){
					// print_r($unlocked_profiles_object);
					// echo "****";
					foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
						
							foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
								$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
							}
					}
				}
			}
			// echo ";;;;;";
			// print_r($unlocked_profiles_array);
			// echo "+++";
			// echo $recruiter_page->id;
			$unlocked_profiles_count = sizeof($unlocked_profiles_array);
			// echo $unlocked_profiles_count;
			// echo "****";
			if($recruiter_page->applicant_unlock_counter!=0){
				$recruiter_data->unlocked_profiles_count=abs(($unlocked_profiles_count)-($recruiter_page->applicants_unlock_quota));
				// echo "if";
			}
			else{
				$recruiter_data->unlocked_profiles_count=$unlocked_profiles_count;
				// echo "else";
			}
			
			/** DIscount unlocked quota count */
			if($recruiter_page->applicants_unlock_quota != ""){
				$recruiter_data->applicants_unlock_quota = $recruiter_page->applicants_unlock_quota;
			}
			else{
				$recruiter_data->applicants_unlock_quota = "0";
			}
			
			if($recruiter_page->applicant_unlock_counter!=0){
				if(((int)$recruiter_page->applicants_unlock_quota-(int)$recruiter_page->applicant_unlock_counter)>0){
					$recruiter_data->applicants_unlocked_profiles_count =	((int) $recruiter_page->applicants_unlock_quota)-((int)$recruiter_page->applicant_unlock_counter);
				}
				else{
					$recruiter_data->applicants_unlocked_profiles_count = $recruiter_page->applicants_unlock_quota;
				}
			}
			else{
				$recruiter_data->applicants_unlocked_profiles_count = "0";
			}

				/** Calculate count of childrens of recuiter & assign to sub_recruiter_count variable */
				$sub_recruiter_count=$recruiter_page->children("recruiter_profile_type=sub-recruiter")->count();
				/** Display Sub Recuiter Quota Count in table */
				if($recruiter_page->sub_recruiter_quota!=0){
					$recruiter_data->sub_recruiter_quota = $recruiter_page->sub_recruiter_quota;
				}
				else{
					$recruiter_data->sub_recruiter_quota = "0";
				}
				
				if($sub_recruiter_count!=0){
					$recruiter_data->sub_recruiter_remaining_quota = ($recruiter_page->sub_recruiter_quota)-($sub_recruiter_count);
				}
				else{
					$recruiter_data->sub_recruiter_remaining_quota = "0";
				}
				
				/**Latest offer entry */
				if($recruiter_page->offers_input_data!=""){
					// global $current_timestamp;
					$recruiter_offers_input_array=json_decode($recruiter_page->offers_input_data); // decode the JSON string into an associative array
					if(!empty($recruiter_offers_input_array)){
						$last_offer_entry_key = end($recruiter_offers_input_array); // pass the variable by reference to the end() function
						$last_offer_input = key($recruiter_offers_input_array);
						$recruiter_data->offers_input = $last_offer_input;
					}
					else{
						$recruiter_data->offers_input = "0";
					}
				}
				else{
					$recruiter_data->offers_input = "-";
				}
				/**Latest offer entry end */
				

			$recruiter_data->job_limit = $recruiter_page->job_limit;
			$recruiter_data->recruiter_type = $recruiter_page->recruiter_type;
			$recruiter_data->registration_time=$recruiter_page->published +  60*60*5.50;
			$recruiter_data->registration_time=date('d/m/Y h:i A', $recruiter_data->registration_time);
			$recruiter_data->serial_number=$serial_counter;
			$serial_counter++;
			$job_posted_count=0;
			
			
			$job_posted_count=\ProcessWire\wire('pages')->get("name=jobs")->children("job_added_by=".$recruiter_page->id)->count();
			// echo "----";
			// echo $job_posted_count;
			// echo "++++";
			// echo $recruiter_page->id;
			$total_job_posted_count=0;
			foreach($recruiter_page->children() as $single_page){
				$sub_recruiter_job_posted_count=\ProcessWire\wire('pages')->get("name=jobs")->children("job_added_by=".$single_page->id)->count();
				$total_job_posted_count=$total_job_posted_count+$sub_recruiter_job_posted_count;
				// echo "***";
				// echo $total_job_posted_count;
				// echo "////";
			}
			$job_posted_count+=$total_job_posted_count;
      $recruiter_data->job_posted_count=$job_posted_count;

				/*this code is used for who is added recruiter(admin or editor) display in table*/
				if($recruiter_page->job_added_by!=0){
			
					$admin_page=\ProcessWire\wire('pages')->get("name=admins")->child("id=".$recruiter_page->job_added_by);
					//echo $admin_page->company_name;
					$editor_page=\ProcessWire\wire('pages')->get("name=editors")->child("id=".$recruiter_page->job_added_by);
					
					if($admin_page->id!=0){
						$recruiter_data->recruiter_added_by=$admin_page->title;
					}
					elseif($editor_page->id!=0){
						$recruiter_data->recruiter_added_by=$editor_page->title;
					}
					else{}
				}
				else{
						$recruiter_data->recruiter_added_by="-";
				}

				$recruiter_data->accessible_sections_id_array=array();
				$recruiter_data->accessible_sections_array=array();
				if($recruiter_page->recruiter_accessible_sections!=""){
						foreach($recruiter_page->recruiter_accessible_sections as $accessible_sections){
								/*add accessible sections id into accessible sections id array
									add accessible sections name into accessible sections array */
								$recruiter_data->accessible_sections_id_array[] = $accessible_sections->id;
								$recruiter_data->accessible_sections_array[] = $accessible_sections->title;
								//print_r($offer_category);
						}
				}
				else{
					$recruiter_data->accessible_sections_id_array="";
						$recruiter_data->accessible_sections_array="";
				}

				/**add button for see all posted jobs by recruiter & sub-recruiter */
			// $posted_jobs_link=\ProcessWire\wire('pages')->get("name=admin-manage-jobs")->httpUrl."?job_added_by=".$recruiter_page->id;
			$posted_jobs_link=\ProcessWire\wire('config')->urls->httpRoot."resume/pc-editor/editor-manage-jobs/?job_added_by=".$recruiter_page->id;
			$recruiter_data->view_posted_jobs="<a target='_blank' href='".$posted_jobs_link."' id='".$recruiter_page->id."_view_posted_jobs_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>View Jobs</a>";
			$sub_recruiter_data_link=\ProcessWire\wire('pages')->get('name=recruiter-manage-sub-recruiter')->httpUrl."?user_id=".$recruiter_page->id;
			$recruiter_data->sub_recruiters_details="<a target='_blank' href='$sub_recruiter_data_link' id='".$recruiter_page->id."_view_sub_recruiter_details_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Sub Recruiters Details</a>";
			

			/* Other column data in the table */
			$recruiter_data->checkbox = "<input id='".$recruiter_page->id."_checkbox' class='recruiter_checkbox' type='checkbox'>";
			$recruiter_data->edit = "<button id='".$recruiter_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit Profile</button>";
			
			$recruiter_data->id = $recruiter_page->id;

			/* Save the recruiter data object into the main array of all the recruiter data */
			array_push($recruiter_data_array, $recruiter_data);
		}
		/* Loop through all the recruiter profile pages END */

		/* Save the recruiter data array into the object that is to be sent back */
		$to_return->data = $recruiter_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Name", "data"=>"name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Recruiter Type", "data"=>"recruiter_type"],
			["title"=>"Created Time", "data"=>"registration_time"],
			["title"=>"Created By", "data"=>"recruiter_added_by"],
			["title"=>"Until", "data"=>"subscription_to_for_table"],
			["title"=>"General Unlock Quota", "data"=>"unlock_quota"],
			["title"=>"General Unlocked", "data"=>"unlocked_profiles_count"],
			["title"=>"Applicants Unlock Quota", "data"=>"applicants_unlock_quota"],
			["title"=>"Applicants Unlocked", "data"=>"applicants_unlocked_profiles_count"],
			["title"=>"Remaining Jobs", "data"=>"job_limit"],
			["title"=>"Posted Jobs", "data"=>"job_posted_count"],
			["title"=>"Sub Recruiter Quota", "data"=>"sub_recruiter_quota"],
			["title"=>"Sub Recruiter Remaining Quota", "data"=>"sub_recruiter_remaining_quota"],
			["title"=>"Offers", "data"=>"offers_input"],			
			["title"=>"Accessible Sections", "data"=>"accessible_sections_array"],
			["title"=>"Registration Time", "data"=>"registration_time"],
			["title"=>"Edit", "data"=>"edit"],
			["title"=>"View Posted Jobs", "data"=>"view_posted_jobs"],
			["title"=>"Sub Recruiter's Details", "data"=>"sub_recruiters_details"]
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all recruiters to show in the table END */

	/* Function to delete recruiter accounts based on given IDs */
	function delete_recruiters($requested_profiles_to_delete_json){
		/* Access global variable that is to be returned */
		global $to_return;

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
			if(\ProcessWire\wire("pages")->get("name=recruiters")->child("id=".$profile_to_delete_id)->trash()){
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
	function modify_recruiter($edit_profile_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		global $flag;

		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);

		/* Array to save data and then to save into the page */
		$edit_recruiter_details_to_save = Array();
		$accessible_sections=array();
		foreach ($edit_profile_form_details as $input_element) {
		    //print_r($input_element);
			$edit_recruiter_details_to_save[$input_element->name] = $input_element->value;
			if($input_element->name=='accessible_sections[]'){
				$accessible_sections[]=$input_element->value;
				//echo $input_element->value;
			}
		}
		//print_r($edit_profile_form_details);
		//echo $edit_recruiter_details_to_save['recruiter_job_limit'];
		/* Array to save data and then to save into the page END */

		/* Get the recruiter page to edit based on the ID */
		$recruiter_page_to_change = \ProcessWire\wire('pages')->get($edit_recruiter_details_to_save['id']);
		$recruiter_page_to_change->of(false);

		/* Save the data */
		$recruiter_page_to_change->title = $edit_recruiter_details_to_save['recruiter_name'];
		//$recruiter_page_to_change->email = $edit_recruiter_details_to_save['recruiter_email'];
		// $single_recruiter=\ProcessWire\wire('pages')->get("name=recruiters")->child("email=".$edit_recruiter_details_to_save['recruiter_email']);
		// if($single_recruiter->id!=0){
		// 		$to_return->error->number_of_errors++;
		// 		$to_return->error->error_message = $edit_recruiter_details_to_save['recruiter_email']." already exists.";
		// 		$flag=false;
		// 	}
		// 	else{
				$recruiter_page_to_change->email = $edit_recruiter_details_to_save['recruiter_email'];
			//}

		$recruiter_page_to_change->company_name = $edit_recruiter_details_to_save['recruiter_company_name'];
        $password_change_message="";
		if($edit_recruiter_details_to_save['recruiter_password'] != ""){
			$recruiter_page_to_change->password = $edit_recruiter_details_to_save['recruiter_password'];
			$password_change_message="\n\nPassword changed successfully.";
		}
		
		$recruiter_page_to_change->subscription_from = $edit_recruiter_details_to_save['recruiter_subscription_from'];
		$recruiter_page_to_change->subscription_to = $edit_recruiter_details_to_save['recruiter_subscription_to'];
		$recruiter_page_to_change->unlock_quota = $edit_recruiter_details_to_save['recruiter_unlock_quota'];
		$recruiter_page_to_change->applicants_unlock_quota = $edit_recruiter_details_to_save['recruiter_applicants_unlock_quota'];
		$recruiter_page_to_change->job_limit = $edit_recruiter_details_to_save['recruiter_job_limit'];
		/** Edit Sub recruiter quota count in recuiter profile page */
		$recruiter_page_to_change->sub_recruiter_quota = $edit_recruiter_details_to_save['recruiter_sub_recruiter_quota'];
		/** End Edit Sub recruiter quota count in recuiter profile page */
		$recruiter_page_to_change->recruiter_type = $edit_recruiter_details_to_save['recruiter_type'];
		$recruiter_page_to_change->recruiter_accessible_sections =\ProcessWire\pagearray($accessible_sections) ;

		// echo $recruiter_page_to_change->recruiter_accessible_sections;
		// echo "************";
		/* Save page */
		//if($flag==true){
			$recruiter_page_to_change->of(false);
			$recruiter_page_to_change->save();
		//}

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Modified recruiter profile with the name ".$recruiter_page_to_change->title = $edit_recruiter_details_to_save['recruiter_name'];
		$to_return->success->success_message.=$password_change_message;
		end_and_return();
	}
	/* Function to modify the information of an recruiter profile from POST data END*/

	/* Function to create a new recruiter based on given data in POST */
	function create_recruiter($new_recruiter_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		global $flag;

		/* Convert json form data into required format */
		$new_recruiter_form_details = json_decode($new_recruiter_form_details);

		/* Array to save data and then to save into the page */
		$new_recruiter_details_to_save = Array();
		$accessible_sections=array();
		foreach ($new_recruiter_form_details as $input_element) {
			$new_recruiter_details_to_save[$input_element->name] = $input_element->value;
			if($input_element->name=='recruiter_accessible_sections[]'){
				$accessible_sections[]=$input_element->value;
				//echo $input_element->value;
			}
		}
		/* Array to save data and then to save into the page END */

		/* New recruiter Page info */
		$recruiter_page=\ProcessWire\wire('pages')->get("name=recruiters")->children();
		$new_recruiter_page = \ProcessWire\wire(new \ProcessWire\Page());
		$new_recruiter_page->template = \ProcessWire\wire('templates')->get("recruiter-profile");
		$new_recruiter_page->parent = \ProcessWire\wire('pages')->get("name=recruiters");

		$new_recruiter_page->title = $new_recruiter_details_to_save['recruiter_name'];
		
		$single_recruiter=\ProcessWire\wire('pages')->get("name=recruiters")->child("email=".$new_recruiter_details_to_save['recruiter_email']);
			if($single_recruiter->id!=0){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message = $new_recruiter_details_to_save['recruiter_email']." already exists.";
				$flag=false;

			}
			else{
				$new_recruiter_page->email = $new_recruiter_details_to_save['recruiter_email'];
			}
		$new_recruiter_page->company_name = $new_recruiter_details_to_save['recruiter_company_name'];
		$new_recruiter_page->password = $new_recruiter_details_to_save['recruiter_password'];
		$new_recruiter_page->subscription_from = $new_recruiter_details_to_save['recruiter_subscription_from'];
		$new_recruiter_page->subscription_to = $new_recruiter_details_to_save['recruiter_subscription_to'];
		$new_recruiter_page->unlock_quota = $new_recruiter_details_to_save['recruiter_unlock_quota'];
		$new_recruiter_page->applicants_unlock_quota = $new_recruiter_details_to_save['recruiter_applicants_unlock_quota'];
		$new_recruiter_page->job_limit = $new_recruiter_details_to_save['recruiter_job_limit'];
			/** Add Sub recruiter quota count in recuiter profile page */
			$new_recruiter_page->sub_recruiter_quota = $new_recruiter_details_to_save['recruiter_sub_recruiter_quota'];
			/** End Add Sub recruiter quota count in recuiter profile page */
			$new_recruiter_page->recruiter_type = $new_recruiter_details_to_save['recruiter_type'];
			/**Add super recruiter profile type in backend */
			$new_recruiter_page->recruiter_profile_type = "super-recruiter";
		$new_recruiter_page->job_added_by = \ProcessWire\wire('session')->user_page_id;
		$new_recruiter_page->recruiter_accessible_sections = $accessible_sections;

		$new_recruiter_page->candidate_table_column_array = json_encode(Array());
		$new_recruiter_page->favourite_profiles_array = json_encode(Array());
		$new_recruiter_page->unlocked_profiles_array = "{}";
		$new_recruiter_page->time_logs = "{}";
		$new_recruiter_page->favourite_profiles_array = "{}";
		$new_recruiter_page->candidate_download_profiles = "{}";
		$new_recruiter_page->candidate_viewed_profiles = "{}";
		// $new_recruiter_page->offers_input_data = "{}";



		/* Save page */
		if($flag==true){
			$new_recruiter_page->of(false);
			$new_recruiter_page->save();
		}


		/* Return data */
		$to_return->success->success_status = true;
		$to_return->success->success_message = "New recruiter created with the name ".$new_recruiter_page->title = $new_recruiter_details_to_save['recruiter_name'];
		end_and_return();
	}
	/* Function to create a new recruiter based on given data in POST END*/










