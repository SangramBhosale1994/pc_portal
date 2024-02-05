<?php
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
//     //Tell the browser to redirect to the HTTPS URL.
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
//     //Prevent the rest of the script from executing.
//     exit;
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
//echo $session->oauth_gmail;
	if($session->oauth_gmail == ""){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in and try again.";
		end_and_return();
	}

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["apply_for_job"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'apply_for_job':
			/* Save job_code sent from the page */
			$job_code_to_add = $input->post("job_code_to_add", "string", false);
			$job_popup_form_details = $input->post("about_job_popup_form_details", "string", false);
$to_return->job_code_to_add=$job_code_to_add;
			if(!$job_code_to_add){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			apply_for_job($job_code_to_add,$job_popup_form_details);
			end_and_return();
		break;

	
		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}


	function apply_for_job($job_code_to_add,$job_popup_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		
	    $user_applied_jobs_array=array();
			// $about_job_candidate_data=array();
			$job_candidate_json="";

		/* Get Current User Page ID */
//echo \ProcessWire\wire("session")->oauth_gmail;
		$user_page = \ProcessWire\wire("pages")->get("name=candidates")->child("oauth_gmail=".\ProcessWire\wire("session")->oauth_gmail);
		$about_job=$user_page->how_did_you_know_about_job;
		
		// if($about_job==""){
		// 	$to_return->error->number_of_errors++;
		// 	$to_return->error->error_message  = "about_job";
		// 	return;
		// }
		$job_page = \ProcessWire\wire("pages")->get("name=jobs")->child("job_code=".$job_code_to_add);
		 $about_job="true";

			// echo $about_job;
			if($job_page->is_popup_show_event == "hide"){
				$about_job="false";
			}
			
			$job_popup_form=json_decode($job_popup_form_details, true);
			$about_job_candidate_data=json_decode($job_page->about_job_candidate_data,true);
			
			// print_r($job_popup_form);
			// echo "-----";
			if(!empty($job_popup_form)){
				$about_job="false";
			}
			// print_r($about_job_candidate_data);
			// echo "////";
			$name_of_reference = null;
			if((is_array($about_job_candidate_data) || is_object($about_job_candidate_data)) && !empty($about_job_candidate_data)){
				foreach ($about_job_candidate_data as $single_about_job_name => $single_about_job_candidate_id) {
					if (in_array($user_page->id, $single_about_job_candidate_id)) {
							$name_of_reference = $single_about_job_name;
							$about_job="false";
							// echo "existing if";
							// echo $about_job;
							break;
					}
			  }
			}
			
		
			// echo "******";
		if ((is_array($job_popup_form) || is_object($job_popup_form)) && !empty($job_popup_form)) {
			// echo "222";
			if($job_page->about_job_candidate_data != ""){
				$about_job_data = json_decode($job_page->about_job_candidate_data, true);
			}
			else{
				$about_job_data = [];
			}
			// print_r($job_popup_form);
			foreach ($job_popup_form as $item) {
				// echo "333";
					if (isset($item['name']) && $item['name'] === 'about_job') {
						$about_job = $item['value'];
						if (!isset($about_job_data[$about_job])) {
							$about_job_data[$about_job] = [];
							
						} 
						$about_job_data[$about_job][] = $user_page->id;
					}
			}
			$job_candidate_array = [];
			// Convert the transformed data to the desired output format
			foreach ($about_job_data as $job_name => $user_ids) {
					// $job_candidate_array = [$job_name => $user_ids];
					$job_candidate_array[$job_name] = $user_ids;
			}
		
			
			$job_candidate_json= json_encode($job_candidate_array, JSON_PRETTY_PRINT);
			// $job_page->about_workshop_job_data = json_encode($about_job_data);
			// echo $job_candidate_json;
			

		}
		else{
			if($about_job=="false"){
				$about_job="false";
			}
			else{
				$about_job="true";
			}
			
			// echo "44444";
			// echo $about_job;
		}
		// echo "555";
		// echo $about_job;
		if($about_job=="true"){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "about_job";
			return;
		}

    $to_return->user_page=$user_page->id;
//echo $user_page->id;
		$user_page->of(false);
//echo "111";
		$user_applied_jobs_array = array_map('trim', array_filter(explode(",", $user_page->job_code)));
//print_r($user_applied_jobs_array);
		if(in_array($job_code_to_add, $user_applied_jobs_array)){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "You have already applied for this job!";
			return;
		}

		array_push($user_applied_jobs_array, $job_code_to_add);

		$user_page->job_code = implode(", ", $user_applied_jobs_array);
		$candidates_applied_jobs_json=$user_page->candidate_applied_jobs;
		// echo $candidates_applied_jobs_json;
		if($candidates_applied_jobs_json == ""){
			$candidates_applied_jobs_json='{}';
		}
		$job_code=$job_code_to_add;
		// echo "///";
		// echo $job_code;
		$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		//  /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
		$candidates_applied_jobs_object = json_decode($candidates_applied_jobs_json);
		// print_r($candidates_applied_jobs_object);
			$candidates_applied_jobs_object->$job_code=$current_timestamp;
		$user_page->candidate_applied_jobs = json_encode($candidates_applied_jobs_object);
		// echo "***";
		// echo $user_page->candidate_applied_jobs;
	
		$user_page->of(false);
		$user_page->save();
		if($job_candidate_json!=""){
			$job_page->about_job_candidate_data =$job_candidate_json;
			$job_page->of(false);
			$job_page->save();
		}
		
		$to_return->data = $user_applied_jobs_array;

		$to_return->success->success_status=true;
		$to_return->success->success_message = "Successfully applied for this job!";
		return;
	}













