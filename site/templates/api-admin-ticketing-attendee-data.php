<?php
include 'includes/send_mail.php';

// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}

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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_ticketing_attendee_request_table_data"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_ticketing_attendee_request_table_data":
			fetch_ticketing_attendee_request_table_data();
			end_and_return();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	function fetch_ticketing_attendee_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$ticketing_attendee_data_array = Array();
		
// 	 $company_admin_profile = 	wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
//$universal_profiles_page=wire('pages')->get('name=universal-profiles');
        $serial_counter=1;
		foreach(wire('pages')->get("name=attendee")->children("sort=published") as $ticketing_attendee_page) {
			//$company_page_title=$sanitizer->selectorValue($company_page->title);
		  
			/* Each candidate's data is to be saved in a seperate object */
			$ticketing_attendee_data = new stdClass();

			
			$ticketing_attendee_data->id = $ticketing_attendee_page->id;
			$ticketing_attendee_data->name = $ticketing_attendee_page->title;
// 			$ticketing_attendee_data->name = $ticketing_attendee_page->first_name."".$ticketing_attendee_page->last_name;
			$ticketing_attendee_data->pronoun = $ticketing_attendee_page->pronoun;
			$ticketing_attendee_data->phone_number = $ticketing_attendee_page->phone_country_code."".$ticketing_attendee_page->phone_number;
			$ticketing_attendee_data->email = $ticketing_attendee_page->email;
			$ticketing_attendee_data->company_name = $ticketing_attendee_page->company_name;
			$ticketing_attendee_data->registration_time=$ticketing_attendee_page->published +  60*60*5.50;
			$ticketing_attendee_data->registration_time=date('d/m/Y h:i A', $ticketing_attendee_data->registration_time);
			$ticketing_attendee_data->serial_number=$serial_counter;
			$serial_counter++;
		
			/* Save the editor data object into the main array of all the editor data */
			array_push($ticketing_attendee_data_array, $ticketing_attendee_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $ticketing_attendee_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
 			["title"=>"Sr.no", "data"=>"serial_number"],
 			["title"=>"Name", "data"=>"name"],
			["title"=>"Comapny Name", "data"=>"company_name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Pronoun", "data"=>"pronoun"],
			["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Registration Time", "data"=>"registration_time"]
		];

		$to_return->success->success_status = true;
		return;
		
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */
