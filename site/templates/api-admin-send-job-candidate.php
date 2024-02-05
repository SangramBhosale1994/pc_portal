<?php
//  print_r($_POST);
ob_start();
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

		global $order_column;
		global $table_search_value;	
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
	global $post_values;
	$post_values=$_POST;


	/* If the request is done without proper log in, exit */
	if(!in_array($session->user_designation, ["admin"])){
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["save_to_session"], false);
	$candidate_checkbox_array=array();
	$candidate_checkbox_array=json_decode($input->post("candidate_checkbox_json"));
	if(count($candidate_checkbox_array)>300){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message="Please Select only 300 candidates.";
	}
	else{
		$session->candidate_checkbox_data=$input->post("candidate_checkbox_json");
		$to_return->data=$session->candidate_checkbox_data;
	}
  end_and_return();
  // echo "****";
  // print_r($session->candidate_checkbox_data);