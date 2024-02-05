<?php
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/**api-expired-jobs is used for deadline over jobs. this api run when you run manage job section. 1st check all deadlines if deadline is over of job then verification status save unverified. */
 require_once(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/api-expired-jobs.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
//echo "222";

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
// 	recruiter page id access using session


global $user_page_id;
global $session_recruiter_profile_type;
$user_page_id=$session->user_page_id;
$session_recruiter_profile_type=$session->recruiter_profile_type;
 
 //echo "333";
        //echo $user_page_id;
        // echo "++++++++++++++++++";
	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return;
//echo "444";
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
	if(!in_array($session->user_designation, ["recruiter", "admin", "editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}
//echo "555";
	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_job_table_data", "delete_jobs", "active_profiles","inactive_profiles"], false);
//echo "666";
	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_job_table_data':
			fetch_job_table_data();
		break;

		case 'delete_jobs':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_jobs($requested_profiles_to_delete_json);
		break;

// 		case 'modify_job':
// 			/* Save the data sent from the form */
// 			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);

// 			if(!$edit_profile_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}
// 			modify_job($edit_profile_form_details);
// 		break;

// 		case 'create_job':
// 			/* Save the data sent from the form */
// 			$new_job_form_details = $input->post("new_job_form_details", "string", false);

// 			if(!$new_job_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}
// //echo "777";
// 			create_job($new_job_form_details);
// 		break;
		
		case 'active_profiles':
			/* Save the data sent from the form */
			$requested_job_profile_to_active = $input->post("requested_job_profile_to_active", "text", false);

			if(!$requested_job_profile_to_active){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			active_profiles($requested_job_profile_to_active);
			end_and_return();
		break;
		
		case 'inactive_profiles':
			/* Save the data sent from the form */
			$requested_job_profile_to_inactive_profiles = $input->post("requested_job_profile_to_inactive_profiles", "text", false);

			if(!$requested_job_profile_to_inactive_profiles){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			inactive_profiles($requested_job_profile_to_inactive_profiles);
			end_and_return();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all jobs to show in the table */
	function fetch_job_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $user_page_id;
		global $session_recruiter_profile_type;
		$recruiter_page_array=array();

		if(\ProcessWire\wire("session")->recruiter_page_id!=""){
			$session_page_id=\ProcessWire\wire("session")->recruiter_page_id;
		}
		else{
			$session_page_id=\ProcessWire\wire("session")->user_page_id;
		}
		if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".$session_page_id)->parent();
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		else{
			$recruiter_page = \ProcessWire\wire("pages")->get("id=".$session_page_id);
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$session_page_id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
			
		}
		// echo "****";
		// print_r($recruiter_page_array);

		/* Array to save all the data of all the jobs into */
		$job_data_array = Array();
		// print_r($recruiter_page_array);
		/**Apply foreach loop for recruiter profile array */
		foreach($recruiter_page_array as $recruiter_page_id){
			if(isset($_GET['job_added_by'])){
				// echo "111";
				if($recruiter_page_id==$_GET['job_added_by']){
					$recruiter_page_id=$_GET['job_added_by'];
					// echo $recruiter_page_id;
				}
				else{
					continue;
				}
				// $search_filter_array[]="job_added_by*=".$_GET['job_added_by'];
				$to_return->job_added_by=$_GET['job_added_by'];
				

			}
			/* Loop through all the job profile pages */
			foreach(\ProcessWire\wire('pages')->get("name=jobs")->children("job_added_by=".$recruiter_page_id) as $job_page) {
				/* Each candidate's data is to be saved in a seperate object */
				$job_data = new stdClass();
				
				/* Create array if favourites are empty */
				if($job_page->active == ""){
					$job_page->active == "inactive";
				}

				$job_data->id = $job_page->id;
				$job_data->title = $job_page->title;
				$job_data->experience = $job_page->experience;
				$job_data->min_experience = $job_page->min_experience;
				$job_data->max_experience = $job_page->max_experience;
				$job_data->application_deadline = date("Y-m-d", intval($job_page->application_deadline));
				$job_data->application_deadline_for_table = date("d M Y", intval($job_page->application_deadline));
				$job_data->job_code = $job_page->job_code;
				$job_data->location = $job_page->location;
				$job_data->skills = $job_page->skills;
				$job_data->summary = $job_page->summary;
				$job_data->company_name = $job_page->company_name;
				$job_data->job_type = $job_page->job_type;
				$job_data->job_sector = $job_page->job_sector;
				$job_data->ctc = $job_page->ctc;
				$job_data->position = $job_page->position;
				if($job_page->job_image!=""){
					$job_data->job_image = $job_page->job_image->httpUrl;
				}
				else{
					$job_data->job_image = $job_page->job_image;
				}
	// 			$job_data->job_publish_shedule = date("Y-m-d", intval($job_page->job_publish_shedule));
	// 			$job_data->job_publish_shedule = date("d M Y", intval($job_page->job_publish_shedule));
				//$job_data->job_publish_shedule=$job_page->job_publish_shedule +  60*60*5.50;
			//	$job_data->job_publish_shedule= date("d M Y", $job_page->job_publish_shedule);
				$job_data->registration_time=$job_page->published +  60*60*5.50;
				// echo $job_page->published;
				// echo "============";
				// echo $job_data->registration_time;
				// echo "------";
				$job_data->registration_time=date('d/m/Y h:i A', $job_data->registration_time);
				// echo strtotime(date('d/m/Y h:i A', $job_data->registration_time));
				
				$applicants_list_link=\ProcessWire\wire('pages')->get("name=recruiter-candidate-table")->httpUrl."?job_code=".$job_data->job_code;
				
				$job_data->applicants_list_button="<a target='_blank' href='".$applicants_list_link."' id='".$job_page->id."_applicants_list_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Applicants</a>";



				/* Other column data in the table */
				$job_data->checkbox = "<input id='".$job_page->id."_checkbox' class='job_checkbox' type='checkbox'>";

				$registration_time=$job_page->published +  60*60*5.50;
				$registration_time_expire_edit=$job_page->published + 24*60*60;

				// $registration_time_expire_edit="1651034880";
				// echo "only job";
				// echo $registration_time;
				// echo "**********";
				// echo "after 24 hours added";
				// echo $registration_time_expire_edit;
				// echo "------------";
				// echo $job_page->published;
				// echo "////////////";
				// echo $registration_time;
				// $registration_time="1651065338";
				$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
				// $current_timestamp="1651124108";
				
				// echo "*********";
				// echo $current_timestamp;
				// echo "++++++++++++";
				// echo $registration_time_expire_edit;
				// echo "-----------";
				if($current_timestamp > $registration_time_expire_edit){
					$job_data->edit = "-";
				}
				else{
					$job_data->edit = "<button id='".$job_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit Job</button>";
				}

				$job_data->active_button = "<button id='".$job_page->id."_active_button' class='[ btn btn-primary ]( active_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Activate</button>";
				
				$job_data->show_button = "<button id='".$job_page->id."_active_button' class='[ btn btn-primary ]( active_button )' type='button'><i class='[ mr-2 ][ fas fa-eye ]'></i>Show</button>";

				$job_preview_link=$job_page->httpUrl;
				// echo "***********";
				// echo $job_preview_link;
				$job_data->job_preview = "<a target='_blank' href='".$job_preview_link."' id='".$job_page->id."_preview_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Preview</a>";
				
				/* If nothing to be unlocked, hide button */
				if($job_page->active_status== "active"){
					// $job_data->active_button = "-";
					$job_data->active_button = "<button id='".$job_page->id."_inactive_button' class='[ btn btn-outline-danger ]( inactive_button )' type='button'><i class='[ mr-2 ][ fas fa-lock ]'></i>Deactivate</button>";
				}

				/* Save the job data object into the main array of all the job data */
				array_push($job_data_array, $job_data);
			}
		}
		/* Loop through all the job profile pages END */

		/* Save the job data array into the object that is to be sent back */
		$to_return->data = $job_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
// 			["title"=>"", "data"=>"checkbox"],
			["title"=>"Job Code", "data"=>"job_code"],
			["title"=>"Title", "data"=>"title"],
			["title"=>"Company", "data"=>"company_name"],
			["title"=>"Location", "data"=>"location"],
			["title"=>"Created Time", "data"=>"registration_time"],
// 			["title"=>"Created By", "data"=>"company_name"],
// 			["title"=>"Job Publishing shedule", "data"=>"job_publish_shedule"],
			["title"=>"Deadline", "data"=>"application_deadline_for_table"],
 			["title"=>"Edit", "data"=>"edit"],
			["title"=>"Applicants List", "data"=>"applicants_list_button"],
			["title"=>"Activation", "data"=>"active_button"],
			["title"=>"Preview", "data"=>"job_preview"]
            // ["title"=>"Show Applicants", "data"=>"show_button"],
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all jobs to show in the table END */

	/* Function to delete job accounts based on given IDs */
	function delete_jobs($requested_profiles_to_delete_json){
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
			if(\ProcessWire\wire("pages")->get("name=jobs")->child("id=".$profile_to_delete_id)->trash()){
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
	/* Function to delete job accounts based on given IDs END */

	/* Function to modify the information of an job profile from POST data */
// 	function modify_job($edit_profile_form_details){
// 		/* Access global variable that is to be returned */
// 		global $to_return;

// 		/* Convert json form data into required format */
// 		$edit_profile_form_details = json_decode($edit_profile_form_details);

// 		/* Array to save data and then to save into the page */
// 		$edit_job_details_to_save = Array();

// 		foreach ($edit_profile_form_details as $input_element) {
// 			$edit_job_details_to_save[$input_element->name] = $input_element->value;
// 		}
// 		/* Array to save data and then to save into the page END */

// 		/* Get the job page to edit based on the ID */
// 		$job_page_to_change = \ProcessWire\wire('pages')->get($edit_job_details_to_save['id']);
// 		$job_page_to_change->of(false);

// 		/* Save the data */
// 		$job_page_to_change->title = $edit_job_details_to_save['job_title'];
// 		$job_page_to_change->company_name = $edit_job_details_to_save['job_company_name'];
// 		//$job_page_to_change->experience = $edit_job_details_to_save['job_experience'];
// 		$job_page_to_change->max_experience = $edit_job_details_to_save['job_experience_max'];
//         $job_page_to_change->min_experience = $edit_job_details_to_save['job_experience_min'];
// 		$job_page_to_change->location = $edit_job_details_to_save['job_location'];
// 		$job_page_to_change->skills = $edit_job_details_to_save['job_skills'];
// 		$job_page_to_change->position = $edit_job_details_to_save['job_position'];
// 		$job_page_to_change->ctc = $edit_job_details_to_save['job_ctc'];
// 		$job_page_to_change->summary = $edit_job_details_to_save['job_summary'];
// 		$job_page_to_change->job_code = $edit_job_details_to_save['job_job_code'];
// 		$job_page_to_change->job_type = $edit_job_details_to_save['job_type'];
// 		$job_page_to_change->application_deadline = $edit_job_details_to_save['job_application_deadline'];
// 		$job_page_to_change->job_publish_shedule = $edit_job_details_to_save['job_publish_shedule'];

// 		/* Save page */
// 		$job_page_to_change->save();

// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "Modified job profile with the name ".$job_page_to_change->title = $edit_job_details_to_save['job_title'];
// 		end_and_return();
// 	}
	/* Function to modify the information of an job profile from POST data END*/
//echo "2";
	/* Function to create a new job based on given data in POST */
// 	function create_job($new_job_form_details){
// 		/* Access global variable that is to be returned */
// 		global $to_return;
// 		global $user_page_id;

// 		/* Convert json form data into required format */
// 		$new_job_form_details = json_decode($new_job_form_details);
// ///echo "1";		
// 		/* Get the current recruiter's page */
// 		$recruiter_page = \ProcessWire\wire("pages")->get("name=recruiters")->child("id=".$user_page_id);
// 		//echo $recruiter_page;
// 		//$recruiter_page->of(false);
//         //echo "++++++++++++++++++++++++++";
//       // echo $recruiter_page->job_limit;
//  //echo "++++++++++++++++++++++++++";
//         /* Check if the sent array has zero*/
// 		if($recruiter_page->job_limit == 0){
// 			$to_return->error->number_of_errors++;
// 			$to_return->error->error_message  = "New job can not be added. You have 0 job postings remaining.";
// 			end_and_return();
// 		}
		
// 		if($recruiter_page->job_limit>0){
// 			//echo $recruiter_page->job_limit;

//     		/* Array to save data and then to save into the page */
//     		$new_job_details_to_save = Array();
    
//     		foreach ($new_job_form_details as $input_element) {
//     			$new_job_details_to_save[$input_element->name] = $input_element->value;
//     		}
//     		/* Array to save data and then to save into the page END */
           
//     		/* New job Page info */
//     		$new_job_page = \ProcessWire\wire(new \ProcessWire\Page());
//     		$new_job_page->template = \ProcessWire\wire('templates')->get("job-page");
//     		$new_job_page->parent = \ProcessWire\wire('pages')->get("name=jobs");
    
//     		$new_job_page->title = $new_job_details_to_save['job_title'];
//     		$new_job_page->company_name = $new_job_details_to_save['job_company_name'];
//     		//$new_job_page->experience = $new_job_details_to_save['job_experience_max']."-".$new_job_details_to_save['job_experience_min'];
//             $new_job_page->max_experience = $new_job_details_to_save['job_experience_max'];
//             $new_job_page->min_experience = $new_job_details_to_save['job_experience_min'];
//     		$new_job_page->location = $new_job_details_to_save['job_location'];
//     		$new_job_page->skills = $new_job_details_to_save['job_skills'];
//     		$new_job_page->position = $new_job_details_to_save['job_position'];
//     		$new_job_page->ctc = $new_job_details_to_save['job_ctc'];
//     		$new_job_page->summary = $new_job_details_to_save['job_summary'];
//     		$new_job_page->job_sector = $new_job_details_to_save['create_new_job_sector'];
//     		$new_job_page->job_type = $new_job_details_to_save['job_type'];
//     		$new_job_page->application_deadline = $new_job_details_to_save['job_application_deadline'];
//     // 		$new_job_page->job_publish_shedule = $new_job_details_to_save['job_publish_shedule'];
//     		$new_job_page->job_added_by = $user_page_id;
//     		//echo $new_job_page->job_added_by;
    		
//     				/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
//     			/**** Get serial ID from the serial ID page */
//     			$job_code_serial_id_counter_page = \ProcessWire\wire('pages')->get("name=job-code-serial-id-counter");
//     			/**** Assign the given ID to the  new page and increment the number for the next page */
//     			$new_job_page->job_code = $job_code_serial_id_counter_page->serial_id++;
//     //echo"5";
//     			/**** save the incremented ID page */
//     			$job_code_serial_id_counter_page-> of(false);
//     			$job_code_serial_id_counter_page->save();
//     			/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */
    	       
    
//     		/* Save page */
//     		$new_job_page->of(false);
//     		$new_job_page->save();
    		
    		
//     	        $recruiter_page->job_limit = $recruiter_page->job_limit-1;
//     	        //echo $recruiter_page->job_limit;
    	        
//     	        $recruiter_page->of(false);
//     	        $recruiter_page->save();
    		
// 	    }
	    
			
// 		/* Save page */
// // 		$new_job_page->of(false);
// // 		$new_job_page->save();

		
// 		/* Return data */
// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "New job created with the name ".$new_job_page->title = $new_job_details_to_save['job_title'];
// 		end_and_return();
// 	}
	/* Function to create a new job based on given data in POST END*/
	
		/* Function to unlock editor's favourite based on given editor IDs */
	function active_profiles($requested_job_profile_to_active){
		/* Access global variable that is to be returned */
		global $to_return;
    //echo $requested_job_profile_to_active;
    //echo "++++++++++++";
		/* Get the page of the editor */
		$job_page = \ProcessWire\wire("pages")->get("id=".$requested_job_profile_to_active);
// 		echo $job_page->id;
	

		/* If editor not found, return */
		if($job_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			end_and_return();
		}

		$job_page->active_status = "active";



		/* save the page */
		$job_page->of(false);
		$job_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested jobs have been activated.";

		end_and_return();
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
	
				/* Function to unlock editor's favourite based on given editor IDs */
	function inactive_profiles($requested_job_profile_to_inactive_profiles){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$job_page = \ProcessWire\wire("pages")->get("id=".$requested_job_profile_to_inactive_profiles);
		$job_page->of(false);
//echo "1";

		/* If editor not found, return */
		if($job_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}
//echo "2";
		$job_page->active_status = "inactive";


//echo "3";
		/* save the page */
		$job_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested jobs have been inactivated.";


		return;
	}
	/* Function to unverify editor's favourite based on given editor IDs END */










