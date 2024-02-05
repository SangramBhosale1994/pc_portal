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
	if($session->oauth_gmail == ""){
		// if(isset($_POST['event_code_to_add'])){
		// 	/* set cookie to retuen to this page after login */
		// 	$event_code_for_cookie = $input->post("event_code_to_add", "string", false);
		// 	$cookie_event_page = $pages->get("name=workshops")->child("event_code={$event_code_for_cookie}");
			
		// 	setcookie('pc_event_unfinished', $cookie_event_page->httpUrl, time() +86400, '/'); 
		// 	/* set cookie to retuen to this page after login END */
		// }
		// $href="https://www.thepridecircle.com/resume/";
// echo "Please <a href=https://www.thepridecircle.com/resume/>log in </a>and try again.";
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please <a href='https://www.thepridecircle.com/resume/'>log in </a>and try again.";
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

			if(!$event_code_to_add){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			apply_for_event($event_code_to_add);
			end_and_return();
		break;
	}

	/* Function to fetch the data of all editors to show in the table */
	function apply_for_event($event_code_to_add){
		/* Access global variable that is to be returned */
		global $to_return;
		$user_applied_events_array=array();
		/* Get Current User Page ID */
		$user_page = Wire("pages")->get("name=candidates")->child("email=".Wire("session")->oauth_gmail);
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

		$user_page->save();
		$to_return->data = $user_applied_events_array;
		$to_return->event_code=$user_page->event_code;
		$to_return->success->success_status=true;
		$to_return->success->success_message   = "Successfully registered to join this event!";
		
// 		/* Send confirmation Email */
// 		$applied_event_page = wire("pages")->get("name=workshops")->child("event_code={$event_code_to_add}");
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







