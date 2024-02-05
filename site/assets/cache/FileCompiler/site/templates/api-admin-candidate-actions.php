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
  // echo "hello";
  // die();
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
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		
		end_and_return();
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["multiple_profile_active","multiple_profile_inactive","multiple_profile_lgbt_confirm","multiple_profile_lgbt_reject","hackathon_candidate_verify","hackathon_candidate_unverify"], false);
// 	$upload_path = \ProcessWire\wire('config')->paths->assets;//. 
// 	$job_image = new \ProcessWire\WireUpload('job_profile_image');
// print_r($job_image);
// echo "xya";
// $image=$_FILES['job_profile_image'];
// print_r($image);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'multiple_profile_active':
			/* Save the data sent from the form */
			$requested_profiles_to_active_json = $input->post("requested_profiles_to_active_json", "textarea", false);
      // echo $requested_profiles_to_active_json;
			if(!$requested_profiles_to_active_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_active($requested_profiles_to_active_json);
			end_and_return();
		break;

		case 'multiple_profile_inactive':
			/* Save the data sent from the form */
		//	echo "*********";
			$requested_profiles_to_inactive_json = $input->post("requested_profiles_to_inactive_json", "textarea", false);
			if(!$requested_profiles_to_inactive_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_inactive($requested_profiles_to_inactive_json);
			end_and_return();
		break;

    case 'multiple_profile_lgbt_confirm':
			/* Save the data sent from the form */
		//	echo "*********";
			$requested_profiles_to_lgbt_verification_json = $input->post("requested_profiles_to_lgbt_verification_json", "textarea", false);
			if(!$requested_profiles_to_lgbt_verification_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_lgbt_confirm($requested_profiles_to_lgbt_verification_json);
			end_and_return();
		break;

    case 'multiple_profile_lgbt_reject':
			/* Save the data sent from the form */
		//	echo "*********";
			$requested_profiles_to_lgbt_verification_json = $input->post("requested_profiles_to_lgbt_verification_json", "textarea", false);
			if(!$requested_profiles_to_lgbt_verification_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_profile_lgbt_reject($requested_profiles_to_lgbt_verification_json);
			end_and_return();
		break;

		case 'hackathon_candidate_verify':
			/* Save the data sent from the form */
			$requested_candidate_profile_to_verify = $input->post("requested_candidate_profile_to_verify", "text", false);
      // echo $requested_profiles_to_active_json;
			if(!$requested_candidate_profile_to_verify){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			hackathon_candidate_verify($requested_candidate_profile_to_verify);
			end_and_return();
		break;

		case 'hackathon_candidate_unverify':
			/* Save the data sent from the form */
			$requested_candidate_profile_to_unverify = $input->post("requested_candidate_profile_to_unverify", "text", false);
      // echo $requested_profiles_to_active_json;
			if(!$requested_candidate_profile_to_unverify){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			hackathon_candidate_unverify($requested_candidate_profile_to_unverify);
			end_and_return();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

  /* Function to add multiple profiles to activate based on given IDs */
	function multiple_profile_active($requested_profiles_to_active_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_active = json_decode($requested_profiles_to_active_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_active) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_active as $single_candidate_page){
			/**access single candidate page using requested id */
			$candidate_page=\ProcessWire\wire("pages")->get("id=".$single_candidate_page);
			
			/**assign active_status status is active */
			$candidate_page->active_status = "Active";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been activated successfully.";

		end_and_return();
	}
	/* Function to add profiles to activated based on given IDs END */

  /* Function to add multiple profiles to inactivate based on given IDs */
	function multiple_profile_inactive($requested_profiles_to_inactive_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_inactive = json_decode($requested_profiles_to_inactive_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_inactive) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_inactive as $single_candidate_page){
			/**access single candidate page using requested id */
			$candidate_page=\ProcessWire\wire("pages")->get("id=".$single_candidate_page);
			
			/**assign active_status status is active */
			$candidate_page->active_status = "Inactive";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been inactivated successfully.";

		end_and_return();
	}
	/* Function to add profiles to inactivated based on given IDs END */

  /* Function to add multiple profiles to LGBT verification based on given IDs */
	function multiple_profile_lgbt_confirm($requested_profiles_to_lgbt_verification_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_lgbt_verification = json_decode($requested_profiles_to_lgbt_verification_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_lgbt_verification) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_lgbt_verification as $single_candidate_page){
			/**access single candidate page using requested id */
			$candidate_page=\ProcessWire\wire("pages")->get("id=".$single_candidate_page);
			
			/**assign active_status status is active */
			$candidate_page->lgbtq_verification = "Confirmed";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been LGBT+ verification confirmed successfully.";

		end_and_return();
	}
	/* Function to add profiles to LGBT verification based on given IDs END */

  /* Function to add multiple profiles to LGBT verification based on given IDs */
	function multiple_profile_lgbt_reject($requested_profiles_to_lgbt_verification_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_lgbt_verification = json_decode($requested_profiles_to_lgbt_verification_json);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_lgbt_verification) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
    //print_r($requested_profiles_to_active);
    // echo "***********";
		/**Apply foreach loop on requested_profiles_to_active */
		foreach($requested_profiles_to_lgbt_verification as $single_candidate_page){
			/**access single candidate page using requested id */
			$candidate_page=\ProcessWire\wire("pages")->get("id=".$single_candidate_page);
			
			/**assign active_status status is active */
			$candidate_page->lgbtq_verification = "Rejected";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been LGBT+ verification rejected successfully.";

		end_and_return();
	}
	/* Function to add profiles to LGBT verification based on given IDs END */

	/* Function to add multiple profiles to activate based on given IDs */
	function hackathon_candidate_verify($requested_candidate_profile_to_verify){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		// $requested_profiles_to_active = json_decode($requested_profiles_to_hackathon_verify_json);
		$candidate_page = \ProcessWire\wire("pages")->get("id=".$requested_candidate_profile_to_verify);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if($candidate_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			end_and_return();
		}

			/**assign active_status status is active */
			$candidate_page->hackathon_verification = "verified";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();

			$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
			foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
				// echo $single_email_content;
				if($single_email_content->text_1=="Hackathon Verification"){
					/** Send mail when create candidate account */
					$candidate_email=$candidate_page->email;
					// $candidate_email="amruta.jagatap@zerovaega.com";
					$candidate_subject="Resume Portal - Hackathon Account";

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
		
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been verified successfully.";

		end_and_return();
	}
	/* Function to add profiles to activated based on given IDs END */

	/* Function to add multiple profiles to activate based on given IDs */
	function hackathon_candidate_unverify($requested_candidate_profile_to_unverify){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		// $requested_profiles_to_active = json_decode($requested_profiles_to_hackathon_verify_json);
		$candidate_page = \ProcessWire\wire("pages")->get("id=".$requested_candidate_profile_to_unverify);
    // echo $requested_profiles_to_active;
		/* Check if the sent array has zero*/
		if($candidate_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			end_and_return();
		}

			/**assign active_status status is active */
			$candidate_page->hackathon_verification = "unverified";
			/**save candidate page */
			$candidate_page->of(false);
			$candidate_page->save();

			$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
			foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
				// echo $single_email_content;
				if($single_email_content->text_1=="Hackathon Unverification"){
					/** Send mail when create candidate account */
					$candidate_email=$candidate_page->email;
					// $candidate_email="amruta.jagatap@zerovaega.com";
					$candidate_subject="Resume Portal - Hackathon Account";

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
		
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been Unverified successfully.";

		end_and_return();
	}
	/* Function to add profiles to activated based on given IDs END */

?>