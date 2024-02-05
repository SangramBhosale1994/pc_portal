<?php
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/* For column names and variables */
	require_once $config->paths->templates.'includes/candidate_table_data.php';

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();

	/* Errors and messages to show to the client. This is handles by Js in frontend */
	$to_return->error = new stdClass();
	$to_return->error->number_of_errors = 0;
	$to_return->error->error_message = "";
	/* Errors and messages to show to the client. This is handles by Js in frontend END */

	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return;
		/* Access global variable that is to be returned END */

		/* Managing Errors and error message in case no message has been logged */
		if($to_return->error->number_of_errors > 0 && $to_return->error->error_message == ""){
			$to_return->error->error_message = "Something went wrong, please refresh the page and try again.";
		}
		/* Managing Errors and error message END */

		/* Display output as a JSON string */
		echo json_encode($to_return);
		/* Display output as a JSON string END */

		exit();
	}
	/* function to end the API call at any moment and display the outputs */

	/* If the request is done without proper log in, exit */
	if(!in_array($session->user_designation, ["admin", "editor", "recruiter"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_page_info_json'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	/* Save the requested data */
	$requested_page_info_to_show = json_decode($input->post('requested_page_info_json'));
	//$requested_page_fields=$input->post('page_fields');
//print_r($requested_page_info_to_show);
//echo $requested_page_info_to_show->page_fields;
	/* Array that contains the system properties of the requested page that the user can access, other than user-defined fields */
	$available_fields_to_show = ["url" =>"URL", "httpUrl" => "Complete URL", "name" => "Name", "title" => "Title"];
	//$candidate_url=array();
	/* Check if requested fields array contains values other than the available array */
	if(!count(array_diff($requested_page_info_to_show->page_fields, array_intersect($requested_page_info_to_show->page_fields, $available_fields_to_show)))) {
		//if(in_array($requested_page_fields,$available_fields_to_show)){
		/* Check user's designation and based on that, see which fields are accessible. Add these to the available fields array */
		switch ($session->user_designation) {
			case "editor":
				array_merge($available_fields_to_show ,$columns_for_editor);
				break;

			case "admin":
				array_merge($available_fields_to_show ,$columns_for_admin);
				break;

			case "editor":
				array_merge($available_fields_to_show ,$columns_for_recruiter);
				break;

			default:
				break;
		}
	}

	$requested_page = $pages->get($requested_page_info_to_show->page_id);

	//  function recruiter(){
	// 		foreach($requested_page_info_to_show as $single_page_id){
	// 			// echo "********";
	// 			// echo $single_page_id;
				
	// 			if (!$single_page_id){
	// 				$to_return->error->number_of_errors++;
	// 				$to_return->error->error_message  = "Requested page is not available.";
	// 				end_and_return();
	// 			}

	// 			$to_return->data = new stdClass();

	// 			//foreach ($requested_page_fields as $requested_field) {
	// 				if($requested_page_fields!=""){
	// 					//echo $requested_page_fields;
	// 					//$to_return->data-> $single_page_id->$requested_page_fields = $single_page_id->get($requested_page_fields);
	// 					$to_return->data->$requested_page_fields = $single_page_id;
	// 				}
	// 				else{

	// 					$to_return->data->stuff = $available_fields_to_show;
	// 				}
	// 			//}

	// 		}
	// 	}

	//foreach($requested_page_id_array as $single_page_id){
		if (!$requested_page){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Requested page is not available.";
			end_and_return();
		}

		$to_return->data = new stdClass();

		foreach ($requested_page_info_to_show->page_fields as $requested_field) {
			if(array_key_exists($requested_field, $available_fields_to_show)){
				$to_return->data->$requested_page_fields = $single_page_id->get($requested_field);
			}
			else{

			$to_return->data->stuff = $available_fields_to_show;
			}
		}
	//}

	end_and_return();
?>