<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
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
	// echo $session->oauth_gmail;
	// echo "****";
	if($session->oauth_gmail == ""){
		// if(isset($_POST['event_code_to_add'])){
		// 	/* set cookie to retuen to this page after login */
		// 	$event_code_for_cookie = $input->post("event_code_to_add", "string", false);
		// 	$cookie_event_page = $pages->get("name=workshops")->child("event_code={$event_code_for_cookie}");
			
		// 	setcookie('pc_event_unfinished', $cookie_event_page->httpUrl, time() +86400, '/'); 
		// 	/* set cookie to retuen to this page after login END */
		// }
		//  $href1="https://www.thepridecircle.com/resume/";
// echo "Please <a href=https://www.thepridecircle.com/resume/>log in </a>and try again.";
// $href="<a href='".$href1."'>Log in</a>";
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["apply_for_event"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'apply_for_event':
			/* Save event_code sent from the page */
			$event_code_to_add = $input->post("event_code_to_add", "string", false);
			$workshop_popup_form_details = $input->post("about_workshop_popup_form_details", "string", false);

			if(!$event_code_to_add && !$workshop_popup_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			apply_for_event($event_code_to_add,$workshop_popup_form_details);
			end_and_return();
		break;
	}

	/* Function to fetch the data of all editors to show in the table */
	function apply_for_event($event_code_to_add,$workshop_popup_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		$user_applied_events_array=array();
		$workshop_candidate_json="";
		/* Get Current User Page ID */
		$user_page = \ProcessWire\wire("pages")->get("name=candidates")->child("email=".\ProcessWire\wire("session")->oauth_gmail);
		$event_page = \ProcessWire\wire("pages")->get("name=workshops")->child("event_code=".$event_code_to_add);
		// print_r($workshop_popup_form_details);
		// if($workshop_popup_form_details['about_workshop']!=""){
			// echo "111";
			$about_workshop="true";

			if($event_page->is_popup_show_event == "hide"){
				$about_workshop="false";
			}

			// echo $about_workshop;
			
			$workshop_popup_form=json_decode($workshop_popup_form_details, true);
			$about_workshop_candidate_data=json_decode($event_page->about_workshop_candidate_data,true);
							
			// print_r($about_workshop_candidate_data);
			// echo "////";
			$name_of_reference = null;

			// Initialize the variable as an empty array if it's not already set
			if (!is_array($about_workshop_candidate_data)) {
				$about_workshop_candidate_data = array();
			}

			if (is_array($about_workshop_candidate_data) && !empty($about_workshop_candidate_data)) {
				foreach ($about_workshop_candidate_data as $single_about_workshop_name => $single_about_workshop_candidate_id) {
						if (in_array($user_page->id, $single_about_workshop_candidate_id)) {
								$name_of_reference = $single_about_workshop_name;
								$about_workshop="false";
								// echo "existing if";
								// echo $about_workshop;
								break;
						}
				}
			}
			// echo "******";
		if (is_array($workshop_popup_form) && !empty($workshop_popup_form)) {
			// echo "222";
			if($event_page->about_workshop_candidate_data != ""){
				$about_workshop_data = json_decode($event_page->about_workshop_candidate_data, true);
			}
			else{
				$about_workshop_data = [];
			}
			
			foreach ($workshop_popup_form as $item) {
				// echo "333";
					if (isset($item['name']) && $item['name'] === 'about_workshop') {
						$about_workshop = $item['value'];
						if (!isset($about_workshop_data[$about_workshop])) {
							$about_workshop_data[$about_workshop] = [];
							
						} 
						$about_workshop_data[$about_workshop][] = $user_page->id;
					}
			}
			$workshop_candidate_array = [];
			// Convert the transformed data to the desired output format
			foreach ($about_workshop_data as $workshop_name => $user_ids) {
					// $workshop_candidate_array = [$workshop_name => $user_ids];
					$workshop_candidate_array[$workshop_name] = $user_ids;
			}
		
			
			$workshop_candidate_json= json_encode($workshop_candidate_array, JSON_PRETTY_PRINT);
			// $event_page->about_workshop_candidate_data = json_encode($about_workshop_data);
			

		}
		else{
			if($about_workshop=="false"){
				$about_workshop="false";
			}
			else{
				$about_workshop="true";
			}
			
			// echo "44444";
			// echo $about_workshop;
		}
		// echo "555";
		// echo $about_workshop;
		if($about_workshop=="true"){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "about_workshop";
			return;
		}
		
		$to_return->user_page=$user_page->id;
		$user_page->of(false);

		$user_applied_events_array = array_map('trim', array_filter(explode(",", $user_page->event_code)));

		if(in_array($event_code_to_add, $user_applied_events_array)){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "You have already registered to join this event!";
			return;
		}

		array_push($user_applied_events_array, $event_code_to_add);

		$user_page->event_code = implode(", ", $user_applied_events_array);
		$users_applied_events_json=$user_page->users_applied_events;
		// echo $candidates_applied_jobs_json;
		if($users_applied_events_json == ""){
			$users_applied_events_json='{}';
		}
		$event_code=$event_code_to_add;
		// echo "///";
		// echo $job_code;
		$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		//  /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
		$users_applied_events_object = json_decode($users_applied_events_json);
		// print_r($users_applied_events_object);
			$users_applied_events_object->$event_code=$current_timestamp;
		$user_page->users_applied_events = json_encode($users_applied_events_object);
		

		$user_page->save();
		if($workshop_candidate_json!=""){
			$event_page->about_workshop_candidate_data =$workshop_candidate_json;
			$event_page->of(false);
			$event_page->save();
		}
		
		$to_return->data = $user_applied_events_array;
		$to_return->event_code=$user_page->event_code;
		$to_return->success->success_status=true;
		$to_return->success->success_message   = "Successfully registered to join this event!";
		
// 		/* Send confirmation Email */
// 		$applied_event_page = \ProcessWire\wire("pages")->get("name=workshops")->child("event_code={$event_code_to_add}");
// 		$applied_event_title = $applied_event_page->title;
// $to_return->event_page = $applied_event_page->id;
// 		$email_subject = "Pride Circle: Workshop Registration Confirmation";
// 		$email_message = "Greetings from Pride Circle!\n\nYour registration for the workshop '{$applied_event_title}' was successful!\n";
// 		$email_headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

// 		try {
// 			mail($user_page->email, $email_subject, $email_message, $email_headers);
// 			$to_return->mail="send";
// 		} catch (Exception $e) {
// 			$error_message = true;
// 			$to_return->mail="not send";
// 		}
// 		/* Send confirmation Email END */
		return;

	}
	/* Function to fetch the data of all editors to show in the table END */







