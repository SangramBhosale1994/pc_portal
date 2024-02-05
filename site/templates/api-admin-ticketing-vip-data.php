<?php

	include 'includes/send_mail_ticketing.php';
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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_ticketing_purchase_request_table_data","verify_profiles"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_ticketing_purchase_request_table_data":
			fetch_ticketing_purchase_request_table_data();
			end_and_return();
		break;
        
    	case 'verify_profiles':
    			/* Save the data sent from the form */
    			$requested_job_fair_to_verify = $input->post("requested_job_fair_to_verify", "text", false);
                //echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
    			if(!$requested_job_fair_to_verify){
    				$to_return->error->number_of_errors++;
    				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
    				end_and_return();
    			}
    			verify_profiles($requested_job_fair_to_verify);
    			end_and_return();
    		break;
    		
    		case 'unverify_profiles':
    			/* Save the data sent from the form */
    			$requested_job_fair_to_unverify_profiles = $input->post("requested_job_fair_to_unverify_profiles", "text", false);
    
    			if(!$requested_job_fair_to_unverify_profiles){
    				$to_return->error->number_of_errors++;
    				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
    				end_and_return();
    			}
    			unverify_profiles($requested_job_fair_to_unverify_profiles);
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
	function fetch_ticketing_purchase_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$ticketing_vip_data_array = Array();
		
// 	 $company_admin_profile = 	wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
//$universal_profiles_page=wire('pages')->get('name=universal-profiles');
        $serial_counter=1;
		foreach(wire('pages')->get("name=vip-attendee")->children("sort=published") as $ticketing_vip_page) {
			//$company_page_title=$sanitizer->selectorValue($company_page->title);
		  
			/* Each candidate's data is to be saved in a seperate object */
			$ticketing_vip_data = new stdClass();
			$ticketing_vip_data->candidate_name = $ticketing_vip_page->title."(".$ticketing_vip_page->pronoun.")";
            $ticketing_vip_data->phone_number = $ticketing_vip_page->phone_country_code.$ticketing_vip_page->phone_number;
            $ticketing_vip_data->email = $ticketing_vip_page->email;
            $ticketing_vip_data->company_name = $ticketing_vip_page->company_name;
            
            $ticketing_vip_data->event_title_array=array();

			
			
			/* Save the editor data object into the main array of all the editor data */
			foreach($ticketing_vip_page->children() as $single_event_page)
			{
			   // echo $single_event_page->title;
			    $ticketing_vip_data->event_title_array[]=wire('pages')->get('name=tickets-vip')->child('ticketing_event_id='.$single_event_page->title)->title;
			}
			    $ticketing_vip_data->event_title=implode("<br><hr>",$ticketing_vip_data->event_title_array);
			  
			 //   $ticketing_vip_data->event_title=wire('pages')->get("name=tickets-vip")->child("ticketing_event_id=".$single_event_page->title)->title;
			    
			 //   //if($single_event_page->verification==""){
			 //       $ticketing_vip_data->verify_button="<button id='_verify_button' class='[ btn btn-primary ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i> Verify </button>";
			   //}
			 //   else if($single_event_page->verification=="verified"){
			 //       $ticketing_vip_data->verify_button="<button id='vip_verify_button' class='[ btn btn-primary ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-lock ]'></i>verified </button>";
			 //   }
			 //   else{
			 //        $ticketing_vip_data->verify_button="<button id='vip_verify_button' class='[ btn btn-primary ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i> $single_event_page->verification </button>";
			//   }
			
			$ticketing_vip_data->verify_button="<button id='".$ticketing_vip_page->id."_verify_button' class='[ btn btn-primary ]( verify_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i> Verify </button>";
			
			    $ticketing_vip_data->serial_number=$serial_counter;
		    	$serial_counter++;
		    	
		    	// 	/* If nothing to be unlocked, hide button */
        			if($ticketing_vip_page->verification== "verified"){
        				$ticketing_vip_data->verify_button = "-";
        			}
		
		    
		        
		//	}
				array_push($ticketing_vip_data_array,$ticketing_vip_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $ticketing_vip_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
 			["title"=>"Sr.no", "data"=>"serial_number"],
 			
			["title"=>"Name", "data"=>"candidate_name"],
			["title"=>"Phone number", "data"=>"phone_number"],
			["title"=>"Email ID", "data"=>"email"],
			["title"=>"Company Name", "data"=>"company_name"],
			
 			["title"=>"event Name", "data"=>"event_title"],
			["title"=>"Verification", "data"=>"verify_button"]
		];

		$to_return->success->success_status = true;
		return;
		
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */


	/* Function to unlock editor's favourite based on given editor IDs */
	function verify_profiles($requested_job_fair_to_verify){
		/* Access global variable that is to be returned */
		global $to_return;
		//echo $requested_job_fair_to_verify;
		
			$ticketing_vip_page = wire("pages")->get("name=vip-attendee")->child("id=".$requested_job_fair_to_verify);
 		//echo $ticketing_vip_page;
	
		if($ticketing_vip_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$ticketing_vip_page->verification = "verified";
		
		/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
		/**** Get serial ID from the serial ID page */
		$pass_applicants_counter_page = wire('pages')->get("name=pass-applicants-counter-page");
		/**** Assign the given ID to the  new page and increment the number for the next page */
		$ticketing_vip_page->serial_id = $pass_applicants_counter_page->serial_id++;
//echo"5";
		/**** save the incremented ID page */

		/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */



		
		$event_name = "RISE 2021";
 		$pass_number=$ticketing_vip_page->serial_id;
		$applicants_name=$ticketing_vip_page->first_name;
 		$applicants_email=$ticketing_vip_page->email;
		$applicants_contact=$ticketing_vip_page->phone_country_code."".$ticketing_vip_page->phone_number;
		foreach($ticketing_vip_page->children() as $single_event_page)
			{
			   // echo $single_event_page->title;
			    $event_title_array[]=wire('pages')->get('name=tickets-vip')->child('ticketing_event_id='.$single_event_page->title)->title;
			}
		
		$applicants_subject="RISE CONFERENCE 2021 | EVENT PASSES";

		$applicants_message ="Dear {$applicants_name},";
		
		$applicants_message .="<br><br>";
		$applicants_message .="You have successfully booked an event pass to ASIA'S BIGGEST LGBT+ CONFERENCE - RISE 2021 !";
		$applicants_message .="<br><br>";
		$applicants_message .="Explore our all new virtual platform on 4th and 5th May and be a part of this global though-fest of LGBT+ inclusion.";
		$applicants_message .="<br><br>";
		$applicants_message .="Your event pass details:";
		$applicants_message .="<br><br>";

		$applicants_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
		$applicants_message .="    <tr>";
		$applicants_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
		$applicants_message .="            <b>{$event_name}</b>";
		$applicants_message .="        </td>";
		$applicants_message .="    </tr>";
		$applicants_message .="</table>";

		$applicants_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
		$applicants_message .="    <tr style='padding:10px;' >";
		$applicants_message .="        <td style='text-align:left; padding:15px;'>";
		
    foreach( $event_title_array as $single_ticket_title){
        
		$applicants_message .="            <b>Pass Name</b>: {$single_ticket_title}</b>";
		$applicants_message .="            <br>";
	}
		$applicants_message .="            <b>Ticket ID</b>: {$pass_number}</b>";
		$applicants_message .="            <br>";
		$applicants_message .="            <b>Name</b>: {$applicants_name}";
		$applicants_message .="            <br>";
		$applicants_message .="            <b>Contact Number</b>: {$applicants_contact}";
		$applicants_message .="            <br>";
		$applicants_message .="            <b>Email</b>: {$applicants_email}";
		$applicants_message .="        </td>";
		$applicants_message .="    </tr>";
		$applicants_message .="</table>";

		$applicants_message .="<br>";
		$applicants_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you.";
		$applicants_message .="<br><br>";
		$applicants_message .="In case of any questions or entry correction requests, please drop us a mail before 20th April 2021, explaining the query along with your details and ticket ID on contact@thepridecircle.com</b>";
		$applicants_message .="<br>";
		

		try {
			send_smtp_mail($ticketing_vip_page->email,$applicants_message,$applicants_subject);
		} catch (Exception $e) {
                print_r($e);
		}

		        $pass_applicants_counter_page-> of(false);
		$pass_applicants_counter_page->save();
// 		/* save the page */
        $ticketing_vip_page->of(false);
		$ticketing_vip_page->save();
		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been verified.";

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
// function unverify_profiles($requested_job_fair_to_unverify_profiles){
// 		/* Access global variable that is to be returned */
// 		global $to_return;

// 		/* Get the page of the editor */
// 		$job_fair_page = wire("pages")->get("id=".$requested_job_fair_to_unverify_profiles);
// 		$job_fair_page->of(false);
// //echo "1";

// 		/* If editor not found, return */
// 		if($job_fair_page->id == 0){
// 			$to_return->error->number_of_errors++;
// 			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
// 			return;
// 		}
// //echo "2";
// 		$job_fair_page->pass_verification = "unverified";


// //echo "3";
// 		/* save the page */
// 		$job_fair_page->save();

// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "Requested profiles have been unverified.";


// 		return;
// 	}