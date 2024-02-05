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
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

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
		global $to_return, $blak;
		/* Access global variable that is to be returned END */

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
	if(!in_array($session->user_designation, ["admin", "editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_profiles_to_delete_json'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	/* Save the requested data */
	$requested_profiles_to_delete = json_decode($input->post('requested_profiles_to_delete_json'));

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
	foreach ($requested_profiles_to_delete as $key => $page_id_to_delete) {
		if($pages->get($page_id_to_delete)->trash()){
			$successfully_deleted_profiles[] = $page_id_to_delete;
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
		foreach($successfully_deleted_profiles as $single_delete_account){
			$candidate_page=\ProcessWire\wire('pages')->get($single_delete_account);

			$candidate_email=$candidate_page->email;
			$candidate_verification_status=$candidate_page->lgbtq_verification;
			$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
			foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
				// echo $single_email_content;
				if($single_email_content->text_1=="Unverified Delete" && ($candidate_verification_status=="" || $candidate_verification_status=="Unchecked" || $candidate_verification_status=="Rejected")){
					/** Send mail when create candidate account */
					$candidate_email=$candidate_page->email;
					// $candidate_email="amruta.jagatap@zerovaega.com";
					$candidate_subject="Resume Portal - Candidate Activation";

					$candidate_message ="Dear {$candidate_page->preferred_name},";
					$candidate_message .="<br><br>";
					$candidate_message .="{$single_email_content->rich_textarea_1}";
					try {
						send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
					} catch (Exception $e) {
						print_r($e);
					}
				}
				elseif($single_email_content->text_1=="Verified Delete" && ($candidate_verification_status=="Confirmed")){
					/** Send mail when create candidate account */
					$candidate_email=$candidate_page->email;
					// $candidate_email="amruta.jagatap@zerovaega.com";
					$candidate_subject="Resume Portal - Candidate Activation";

					$candidate_message ="Dear {$candidate_page->preferred_name},";
					$candidate_message .="<br><br>";
					$candidate_message .="{$single_email_content->rich_textarea_1}";
					try {
						send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
					} catch (Exception $e) {
						print_r($e);
					}
				}
				else{
					continue;
				}
			}

		}
		

		/* If all the requested profiles have been deleted successfully */
		if(count($successfully_deleted_profiles) == count($requested_profiles_to_delete)){
			$to_return->success->success_message = "All the requested profiles have been deleted successfully, IDs of deleted profiles are: ".implode(", ", $successfully_deleted_profiles);
		}
		/* If some profiles were not deleted */
		else{
			$to_return->success->success_message = "Some profiles could not be deleted. IDs of deleted profiles are: [".explode(", ", $successfully_deleted_profiles)."].  & the following were not deleted: [".explode(array_diff($successfully_deleted_profiles, $requested_profiles_to_delete))."]";
		}
	}

	end_and_return();
?>