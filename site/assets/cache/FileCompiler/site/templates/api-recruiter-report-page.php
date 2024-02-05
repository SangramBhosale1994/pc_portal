<?php
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
  global $recruiter_data;

	$to_return = new stdClass();

	/* Errors and messages to show to the client. This is handles by Js in frontend */
	$to_return->error = new stdClass();
	$to_return->error->number_of_errors = 0;
	$to_return->error->error_message = "";
	$to_return->unlock_error = new stdClass();
	$to_return->unlock_error->number_of_errors = 0;
	$to_return->unlock_error->error_message = "";
	$to_return->download_error = new stdClass();
	$to_return->download_error->number_of_errors = 0;
	$to_return->download_error->error_message = "";
	$to_return->time_logs_error = new stdClass();
	$to_return->time_logs_error->number_of_errors = 0;
	$to_return->time_logs_error->error_message = "";
	$to_return->viewed_profile_error = new stdClass();
	$to_return->viewed_profile_error->number_of_errors = 0;
	$to_return->viewed_profile_error->error_message = "";
	$to_return->offers_history_error = new stdClass();
	$to_return->offers_history_error->number_of_errors = 0;
	$to_return->offers_history_error->error_message = "";
	/* Errors and messages to show to the client. This is handles by Js in frontend END */

	/* Success Messages to show to the client. This is handles by Js in frontend */
	$to_return->success = new stdClass();
	$to_return->success->success_status = false;
	$to_return->success->success_message = "";
	/* Success Messages to show to the client. This is handles by Js in frontend END */
// 	recruiter page id access using session


global $user_page_id;
global $session_recruiter_profile_type;
$user_page_id=$session->user_page_id;
$session_recruiter_profile_type=$session->recruiter_profile_type;
 
 //echo "333";
        //echo $user_page_id;
        // echo "++++++++++++++++++";
	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return;
//echo "444";
    	/* Managing Errors and error message in case no message has been logged */
			if($to_return->error->number_of_errors > 0 && $to_return->error->error_message == ""){
				$to_return->error->error_message = "Something went wrong, please refresh the page and try again.";
			}
	    if($to_return->unlock_error->number_of_errors > 0 && $to_return->unlock_error->error_message == ""){
			$to_return->unlock_error->error_message = "Something went wrong, please refresh the page and try again.";
			}
			if($to_return->download_error->number_of_errors > 0 && $to_return->download_error->error_message == ""){
				$to_return->download_error->error_message = "Something went wrong, please refresh the page and try again.";
			}
			if($to_return->time_logs_error->number_of_errors > 0 && $to_return->time_logs_error->error_message == ""){
				$to_return->time_logs_error->error_message = "Something went wrong, please refresh the page and try again.";
			}
			if($to_return->viewed_profile_error->number_of_errors > 0 && $to_return->viewed_profile_error->error_message == ""){
				$to_return->viewed_profile_error->error_message = "Something went wrong, please refresh the page and try again.";
			}
			if($to_return->offers_history_error->number_of_errors > 0 && $to_return->offers_history_error->error_message == ""){
				$to_return->offers_history_error->error_message = "Something went wrong, please refresh the page and try again.";
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
	if(!in_array($session->user_designation, ["recruiter", "admin", "editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}
//echo "555";
	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_candidate_report_table"], false);
//echo "666";
	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_candidate_report_table':
			fetch_candidate_report_table();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all jobs to show in the table */
	function fetch_candidate_report_table(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $user_page_id;
		global $session_recruiter_profile_type;
    global $recruiter_data;
		$recruiter_page_array=array();

    if(isset($_GET['user_id'])){
      $recruiter_page_id=$_GET['user_id'];
      $to_return->user_id=$_GET['user_id'];
    }
		if(\ProcessWire\wire("session")->recruiter_page_id!=""){
			$session_page_id=\ProcessWire\wire("session")->recruiter_page_id;
		}
		else{
			$session_page_id=\ProcessWire\wire("session")->user_page_id;
		}
		if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
			$super_recruiter_page = \ProcessWire\wire("pages")->get("id=".$session_page_id)->parent();
			$recruiter_page_array[].=$super_recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
		}
		else{
			$super_recruiter_page = \ProcessWire\wire("pages")->get("id=".$session_page_id);
			$recruiter_page_array[].=$super_recruiter_page->id;
			foreach(\ProcessWire\wire("pages")->get("id=".$session_page_id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
			
		}

    $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
		/* Array to save all the data of all the recruiter & candidate report into */
		$recruiter_data_array = Array();
    $candidate_unlocked_data_array = Array();
    $candidate_download_data_array = Array();
		$recruiter_time_logs_data_array = Array();
		$recruiter_offers_input_data_array = Array();
		$candidate_viewed_data_array= Array();
		$viewed_candidate_array= Array();
    $candidate_array=Array();
		$time_logs_array=Array();
		
      if($super_recruiter_page->unlocked_profiles_array!=""){
       /**recruiter profile array */
      	/* Loop through all the recruiter profile pages */
        $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
        $unlocked_profiles_array=json_decode($super_recruiter_page->unlocked_profiles_array);
        foreach($unlocked_profiles_array as $single_unlocked_profile_array){
          foreach($single_unlocked_profile_array as $single_unlocked_profile){
            if($single_unlocked_profile->recruiter_id==$recruiter_page->id){
              // $candidate_array[]=$single_unlocked_profile->candidate_profile_id;
							$candidate_array[]=$single_unlocked_profile;
            }
            
          }
        }
        $candidate_name="";
        $candidate_email="";
				if(!empty($candidate_array)){
					foreach($candidate_array as $single_candidate){
						$profile_id=$single_candidate->candidate_profile_id;
						$recruiter_data = new stdClass();
						$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$profile_id.",active_status=active");
						
						$recruiter_data->id = $candidate_page->serial_id;
						$recruiter_data->candidate_name=$candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
						$recruiter_data->candidate_email=$candidate_page->email;
						$recruiter_data->phone_number=$candidate_page->phone_country_code.$candidate_page->phone_number;
						$recruiter_data->unlocked_time=date('d/m/Y h:i A', ((int)$single_candidate->timestamp+ 60*60*5.50));
						/* Other column data in the table */
						/* Save the candidate data object into the main array of all the candidate data */
					array_push($candidate_unlocked_data_array, $recruiter_data);
					}
				}
				else{
					$to_return->unlock_error->number_of_errors++;
					$to_return->unlock_error->error_message  = "No data available.";
				}
        
      }
      
      /**Downloaded data section */
      if($recruiter_page->candidate_download_profiles!=""){
        /**recruiter profile array */
				$download_candidate_array=Array();
        /* Loop through all the recuiter profile pages */
        $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
        $download_profiles_array=json_decode($recruiter_page->candidate_download_profiles);
				if(!empty($download_profiles_array)){
					foreach($download_profiles_array as $profile_id=>$timestamp){
						$download_candidate_array[]=$profile_id;
						// }
						// if(!empty($download_candidate_array)){
						// 	foreach($download_candidate_array as $single_candidate){
							$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$profile_id.",active_status=active");
							$recruiter_download_data = new stdClass();
							$recruiter_download_data->id = $candidate_page->serial_id;
							$recruiter_download_data->candidate_name=$candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
							$recruiter_download_data->candidate_email=$candidate_page->email;
							$recruiter_download_data->phone_number=$candidate_page->phone_country_code.$candidate_page->phone_number;
							$recruiter_download_data->download_time=date('d/m/Y h:i A', ((int)$timestamp + 60*60*5.50));
							/* Save the job data object into the main array of all the job data */
							array_push($candidate_download_data_array, $recruiter_download_data);
						// }
					}
				}
				else{
					$to_return->download_error->number_of_errors++;
					$to_return->download_error->error_message  = "No data available.";
				}
        
      }

			/** Time Logs records section*/
      if($recruiter_page->time_logs!=""){
        /**recruiter profile array */
        /* Loop through all the recuiter profile pages */
        $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
        $time_logs_array=json_decode($recruiter_page->time_logs);
				if(!empty($time_logs_array)){
					foreach($time_logs_array as $single_time_log_array){
						foreach($single_time_log_array as $single_time_log){
								// $time_logs_array[]=$single_time_log;
								$recruiter_time_logs_data = new stdClass();
								$recruiter_time_logs_data->session_id=$single_time_log->session_id;
								$recruiter_time_logs_data->login=date('d/m/Y h:i A', ((int)$single_time_log->login +  60*60*5.50));
								if($single_time_log->logout!=""){
									$recruiter_time_logs_data->logout=date('d/m/Y h:i A', ((int)$single_time_log->logout + +  60*60*5.50));
								}
								else{
									$recruiter_time_logs_data->logout="-";
								}
								if($single_time_log->login!=""){
									$login_timestamp=(int)$single_time_log->login;
								}
								else{
									$login_timestamp=0;
								}
								if($single_time_log->logout!=""){
									$logout_timestamp=(int)$single_time_log->logout;
								}
								else{
									$logout_timestamp=0;
								}
								if($logout_timestamp!=0){
									$spent_time_difference=($logout_timestamp-$login_timestamp);
								}
								else{
									$spent_time_difference=0;
								}
								
								$spent_hours= 0;
								$spent_minutes=0;
								$spent_seconds=0;
								if($spent_time_difference!=""){
									$spent_hours= $spent_time_difference / 60;
									$spent_minutes=$spent_hours % 60;
									$spent_seconds=$spent_time_difference % 60;
									$spent_hours=$spent_hours / 60;
									$spent_time= (int)$spent_hours." Hours ".(int)$spent_minutes." Minutes ".(int)$spent_seconds." Seconds";
									// $spent_time= (int)$spent_hours." H ".(int)$spent_minutes." M ".(int)$spent_seconds." S";

									$recruiter_time_logs_data->spent_time=$spent_time;
								}
								else{
									$recruiter_time_logs_data->spent_time="-";
								}

								/* Save the job data object into the main array of all the job data */
								array_push($recruiter_time_logs_data_array, $recruiter_time_logs_data);
						}
					}
				}
				else{
					$to_return->time_logs_error->number_of_errors++;
					$to_return->time_logs_error->error_message  = "No data available.";
				}

        
      }

			/**Viewed profiles data section */
			// echo $recruiter_page->candidate_viewed_profiles;
			// echo "121212";
      if($recruiter_page->candidate_viewed_profiles!=""){
				// echo "111";
        /**recruiter profile array */
				$viewed_candidate_array=Array();
        /* Loop through all the recuiter profile pages */
        $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
        $viewed_profiles_array=json_decode($recruiter_page->candidate_viewed_profiles);
				// print_r($viewed_profiles_array);
				if(!empty($viewed_profiles_array)){
					foreach($viewed_profiles_array as $profile_id=>$timestamp){
						$viewed_candidate_array[]=$profile_id;
							$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$profile_id.",active_status=active");
							$recruiter_viewed_data = new stdClass();
							$recruiter_viewed_data->id = $candidate_page->serial_id;
							$recruiter_viewed_data->candidate_name=$candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
							$recruiter_viewed_data->candidate_email=$candidate_page->email;
							$recruiter_viewed_data->phone_number=$candidate_page->phone_country_code.$candidate_page->phone_number;
							$recruiter_viewed_data->viewed_time=date('d/m/Y h:i A', ((int)$timestamp + 60*60*5.50));
							/* Save the job data object into the main array of all the job data */
							array_push($candidate_viewed_data_array, $recruiter_viewed_data);
						// }
					}
				}
				else{
					$to_return->viewed_profile_error->number_of_errors++;
					$to_return->viewed_profile_error->error_message  = "No data available.";
				}
        
      }

			
			/**Offers history section */
			if($recruiter_page->offers_input_data!=""){
        /**recruiter profile array */
				$serial_number=1;
        /* Loop through all the recuiter profile pages */
        $recruiter_page=\ProcessWire\wire('pages')->get($recruiter_page_id);
        $offers_input_data_array=json_decode($recruiter_page->offers_input_data);
				if(!empty($offers_input_data_array)){
					foreach($offers_input_data_array as $offer_input=>$offer_timestamp){
								// $time_logs_array[]=$single_time_log;
								$recruiter_offers_data = new stdClass();
								$recruiter_offers_data->sr_no=$serial_number;
								$recruiter_offers_data->offers=$offer_input;
								$recruiter_offers_data->offer_enter_time=date('d/m/Y h:i A', ($offer_timestamp +  60*60*5.50));
								$serial_number++;
								/* Save the job data object into the main array of all the job data */
								array_push($recruiter_offers_input_data_array, $recruiter_offers_data);
					}
				}
				else{
					$to_return->offers_history_error->number_of_errors++;
					$to_return->offers_history_error->error_message  = "No data available.";
				}
      }
			else{
				$to_return->offers_history_error->number_of_errors++;
				$to_return->offers_history_error->error_message  = "No data available.";
			}

		/* Save the recruiter & candidate data array into the object that is to be sent back */
		// $to_return->data = $recruiter_data_array;
    $to_return->unlocked_data = $candidate_unlocked_data_array;
		$to_return->download_data = $candidate_download_data_array;
		$to_return->time_logs_data = $recruiter_time_logs_data_array;
		$to_return->viewed_profiles_data = $candidate_viewed_data_array;
		$to_return->offers_data = $recruiter_offers_input_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->unlocked_data_columns = [
      ["title"=>"ID", "data"=>"id"],
			["title"=>"Candidate Name", "data"=>"candidate_name"],
      ["title"=>"Candidate Email", "data"=>"candidate_email"],
      ["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Unlocking Time", "data"=>"unlocked_time"]
		];

    $to_return->download_data_columns = [
			["title"=>"ID", "data"=>"id"],
			["title"=>"Candidate Name", "data"=>"candidate_name"],
      ["title"=>"Candidate Email", "data"=>"candidate_email"],
      ["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Downloading Time", "data"=>"download_time"]
		];
		$to_return->time_logs_data_columns = [
			["title"=>"Session Id", "data"=>"session_id"],
			["title"=>"Login", "data"=>"login"],
      ["title"=>"Logout", "data"=>"logout"],
      ["title"=>"Spent Time", "data"=>"spent_time"]
		];
		$to_return->viewed_profiles_data_columns = [
			["title"=>"ID", "data"=>"id"],
			["title"=>"Candidate Name", "data"=>"candidate_name"],
      ["title"=>"Candidate Email", "data"=>"candidate_email"],
      ["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Viewing Time", "data"=>"viewed_time"]
		];
		$to_return->offers_data_columns = [
			["title"=>"Sr. no", "data"=>"sr_no"],
			["title"=>"Offers", "data"=>"offers"],
      ["title"=>"Offers Entry Time", "data"=>"offer_enter_time"]
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all recruiter & candidate report to show in the table END */








