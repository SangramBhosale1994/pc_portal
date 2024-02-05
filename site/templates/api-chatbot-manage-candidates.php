<?php



// webhook.php
//
// Dialogflow calls this service using POST request.
// Place this file in the document root of your server. Your server must be accessible at the below URL:
// http://<hostname>/webhook.php
//
// This service just extracts the intent and parameters (entities) from the user supplied text 
// and returns to Dialogflow.
//
$method = $_SERVER['REQUEST_METHOD'];
//
// Process only when request method is POST
//
// if($method == 'POST'){
	// 	$requestBody = file_get_contents('php://input');
	// 	$json = json_decode($requestBody);

	// 	$text = $json->result->resolvedQuery;

	// 	$location = (!empty($json->result->parameters->location)) ? $json->result->parameters->location : '';
	// 	$cuisine  = (!empty($json->result->parameters->cuisine)) ? $json->result->parameters->cuisine : '';
	// 	$intent   = (!empty($json->result->metadata->intentName)) ? $json->result->metadata->intentName : '';
		
	// 	$responseText = prepareResponse($intent, $text, $location, $cuisine);

	// 	$response = new \stdClass();
	// 	$response->speech = $responseText;
	// 	$response->displayText = $responseText;
	// 	$response->source = "webhook";
	// 	echo json_encode($response);


	// $user_data = $json->queryResult->parameters;


// $first_name= $user_data->first_name;
// $last_name = $user_data->last_name;
// $email_id = $user_data->email_id;
// $identify_as = $user_data->identify_as;
// $current_location = $user_data->current_location;
// $highest_qualification = $user_data->highest_qualification;
// $experience = $user_data->experience;
// $annual_ctc = $user_data->annual_ctc;
// $non_tech_skills = $user_data->non_tech_skills;

// $tempa_arr = array();

// $tempa_arr['first_name']=$first_name;
// $tempa_arr['last_name']=$last_name;
// $tempa_arr['email_id']=$email_id;
// $tempa_arr['identify_as']=$identify_as;
// $tempa_arr['current_location']=$current_location;
// $tempa_arr['highest_qualification']=$highest_qualification;
// $tempa_arr['experience']=$experience;
// $tempa_arr['annual_ctc']=$annual_ctc;
// $tempa_arr['non_tech_skills']=$non_tech_skills;

// $page->summary = json_encode($tempa_arr);
// 	//$page->summary = json_encode($_POST);
// $page->of(false);
// $page->save();
// }
// else
// {
// 		echo "Method not allowed";
// }

function prepareResponse($intent, $text, $location, $cuisine)
	{
	return "You said: " . $text . " | I found Intent: " . $intent . "| with parameters: location=" . $location . " cuisine=" . $cuisine ;    
	}



//die();



























// header('Access-Control-Allow-Origin: *');

// header('Access-Control-Allow-Methods: GET, POST');

// header("Access-Control-Allow-Headers: X-Requested-With");

// //$page->summary .= "___ ___";

// 	foreach ($_POST as $key => $value) {
// 		$page->summary .= $value;
// 		$page->summary .= 1;

// 	}
// 	foreach ($_GET as $key => $value) {
// 		$page->summary .= $value;
// 		$page->summary .= 1;

// 	}

// 	//$page->summary = json_encode($_POST);
// 	$page->of(false);
// 	$page->save();

// echo '{
//   "fulfillmentMessages": [
//     {
//       "text": {
//         "text": [
//           '.$page->summary.'
//         ]
//       }
//     }
//   ]
// }';

// 	exit();

	header('Content-Type: application/json');

	/* Create an object where all the data to be returned after finishing the process of this page is saved. This includes error and success messages, statuses etc */
	$data_to_return = new stdClass;
	$data_to_return->profile_created = false;
	$data_to_return->profile_to_edit = false;
	$data_to_return->profile_edited = false;
	$data_to_return->error = false;
	$data_to_return->error_text = array();
	$data_to_return->profile_url = "";
	//$data_to_return->post_data = $_POST;

	/* Check if the POST query is done or not. Exit saving and displaying error if not. */
	// if(!isset($_POST)){
	// 	$data_to_return->error = true;
	// 	$data_to_return->error_text[] = "Something went wrong. Please try again";

	// 	echo json_encode($data_to_return);
	// 	exit();
	// }

	/* If the ADMIN is logged in and the POST query contains page_edit_id, get that page and save its login email to $profile_oauth */
	// if($session->user_designation == "admin" && $input->post->page_to_edit_id != ""){
	// 	$temp_page = $pages->get("name=candidates")->child("id=".$input->post->page_to_edit_id.",template=candidate_page");
	// 	$profile_oauth = $temp_page->oauth_gmail;
	// }else{
	// 	/* If admin hasn't logged in, use the session gmail of the user who has logged in and save its login email to $profile_oauth */
	// 	$profile_oauth =  $session->oauth_gmail;
	// }

	/* Check if a POST request has been made and the data (email here) is sent along with it, and the $profile_oauth should not be empty. Proceed if true */
	if($method == 'POST'){


		$requestBody = file_get_contents('php://input');
		$json = json_decode($requestBody);

		$text = $json->result->resolvedQuery;

		$location = (!empty($json->result->parameters->location)) ? $json->result->parameters->location : '';
		$cuisine  = (!empty($json->result->parameters->cuisine)) ? $json->result->parameters->cuisine : '';
		$intent   = (!empty($json->result->metadata->intentName)) ? $json->result->metadata->intentName : '';
		
		$responseText = prepareResponse($intent, $text, $location, $cuisine);

		$response = new \stdClass();
		$response->speech = $responseText;
		$response->displayText = $responseText;
		$response->source = "webhook";
		echo json_encode($response);


		$user_data = $json->queryResult->parameters;


		$first_name= $user_data->first_name;
		$last_name = $user_data->last_name;
		$email_id = $user_data->email_id;
		$contact_number = $user_data->contact_number;
		$identify_as = $user_data->identify_as;
		//$current_location = $user_data->current_location;
		$highest_qualification = $user_data->highest_qualification;
		$experience = $user_data->experience;
		$annual_ctc = $user_data->annual_ctc;
		$non_tech_skills = $user_data->non_tech_skills;






		/* Define a $np (New Page) variable for creating or getting page */
		$np= "";

		/* check if the page is to be created or edited */
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$email_id.",template=candidate_page")->id != 0){
			/* Get reference to the page to be edited */
			$np = $pages->get("name=candidates")->child("oauth_gmail=".$email_id.",template=candidate_page");
			$data_to_return->profile_to_edit = true;
		}
		/** Else if the page doesn't already exist and this is a new entry */
		else{
			/*** Basic Page Creation Info */
			$np = new Page();
			$np->template = $templates->get("candidate_page");
			$np->parent = $pages->get("name=candidates");
			$np->title = time().mt_rand(10,99);
			/*** Basic Page Creation Info End */

			/*** Save the page with unique email-ID */
			$np->oauth_gmail = $email_id;

			/*** Serial ID created from the ID counter page */
			/**** Get serial ID from the serial ID page */
			$serial_id_counter_page = $pages->get("name=serial_id_counter_page");
			/**** Assign the given ID to the  new page and increment the number for the next page */
			$np->serial_id = $serial_id_counter_page->serial_id++;

			/**** save the incremented ID page */
			$serial_id_counter_page-> of(false);
			$serial_id_counter_page->save();
			/*** Serial ID created from the ID counter page END */

			/* Origin of the signup */
			$np->signup_origin = "chatbot";

			/*** Save the newly created candidate page with bare minimum requirements so that a candidate profile is created */
			$np->of(false);
			$np->save();

			/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
			if($pages->get("name=candidates")->child("oauth_gmail=".$email_id.",template=candidate_page")->id != 0){
				$data_to_return->profile_created = true;
			}
			else{
				$data_to_return->error = true;
				$data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
				//echo json_encode($data_to_return);
				exit();
			}
		}
		/* Check if the page is to be created or edited END */

		/* Save the link to the profile page in the data_to_return object.  */
		$data_to_return->profile_url = $np->httpUrl;

		/* Text Data From The Form (sanitized) */
		$np->first_name = $sanitizer->text($first_name);
		$np->last_name = $sanitizer->text($last_name);
		
		/** Check if 'other' is selected. If yes, go for the custom input. (for pronoun, out_at_work, identify_as, qualification etc multiple choice type inputs) */
		$np->identify_as = $sanitizer->text($identify_as);
		$np->email = $sanitizer->email($email_id);
		$np->phone_country_code = "+91";
		$np->phone_number = $sanitizer->text($contact_number);
		//$np->current_city = $sanitizer->text($current_location);

		$np->qualification = $sanitizer->text($highest_qualification);
		$np->current_ctc = $sanitizer->text($annual_ctc);
		$np->current_ctc_time = "Annual";

		

		
		$np->experience_years = $sanitizer->text($experience);
		$np->experience_months = "0";
		
		// if($user_data->tech_skills){
		// 	$np->technical_skills = $sanitizer->text($user_data->tech_skills);
		// }
		
		$np->non_technical_skills = $sanitizer->text($non_tech_skills);

		//$np->soft_skills = $sanitizer->text($input->post->soft_skills);
		
		/** Assign active_status.*/
			$np->active_status = "Active";

		/* Text Data From The Form End */

		/* Save the page with the text values from POST form input */
		//$np->of(false);
		//$np->save();
		/* Save the page with the text values from POST form input END */


$page->summary = $json->queryResult->action;
	//$page->summary = json_encode($_POST);
$page->of(false);
$page->save();



		/* If the profile is not created, then it is now edited, Save it in data_to_return */
		if(!$data_to_return->profile_created){
			$data_to_return->profile_edited = true;
		}

		/* Send an email to the candidate about the successful registration. Only send in case of creating new page.*/
		if ($data_to_return->error == false && $data_to_return->profile_created == true && $np->email !=""){
			$subject = "Pride Circle Resume Portal : Profile Created!";
			$message = "Greetings from Pride Circle!\n\nYour profile has been successfully registered. You can visit your profile and edit it on the following link- \n\n ".$np->httpUrl;
			$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

			try {
				mail($np->email, $subject, $message, $headers);
			} catch (Exception $e) {
			}
		}
		/* Send an email to the candidate about the successful registration END */

		/* Just in case javascript is not enabled on the page and AJAX cannot run, the form will be submitted in a default fashion. In such case, the redirection will not happen on the front end and will take place on the back end. Thus, in the AJAX code, a parameter is added named 'ajax=true' with the POST method.  This code will check if the request is coming from AJAX or not and act accordingly.*/
		if(isset($input->post->ajax)){
			echo json_encode($data_to_return);
		}
		else{
			header("Location:".$np->httpUrl);
		}


		/* Redirect to the display page of the candidate profile. */
		//header("Location:".$np->httpUrl);
		//header("Location:".$config->urls->httpRoot."edit-application/");
	}
	/* If no POST request has been made, and no user is logged in */
	else{
		$data_to_return->error = true;
		$data_to_return->error_text[] = "Something went wrong. Please log in and try again.";

		echo json_encode($data_to_return);
		exit();
		//header("Location: ".$config->urls->httpRoot);
	}
?>