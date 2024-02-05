<?php
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();
	// global $session;
	// $sessin = new stdClass();
	
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
	if(!in_array($session->user_designation, ["admin","editor"])){
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_event_table_data", "delete_events", "modify_event", "create_event"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_event_table_data':
			fetch_event_table_data();
		break;

		case 'delete_events':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_events($requested_profiles_to_delete_json);
		break;

		case 'modify_event':
			/* Save the data sent from the form */
			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);

			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			modify_event($edit_profile_form_details);
		break;

		case 'create_event':
			/* Save the data sent from the form */
			$new_event_form_details = $input->post("new_event_form_details", "string", false);

			if(!$new_event_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			create_event($new_event_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all events to show in the table */
	function fetch_event_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		//global $session;
		/* Array to save all the data of all the events into */
		$event_data_array = Array();

$to_return->enda =Array();
		$serial_counter=1;
		/* Loop through all the event profile pages */
		foreach(\ProcessWire\wire('pages')->get("name=workshops")->children() as $event_page) {
			/* Each candidate's data is to be saved in a seperate object */
			$event_data = new stdClass();

			$event_data->id = $event_page->id;
			$event_data->title = $event_page->title;
			$event_data->application_deadline = date("Y-m-d", (int)$event_page->application_deadline);
			$event_data->application_deadline_for_table = date("d M Y", (int)$event_page->application_deadline);
//echo (int)$event_page->application_deadline."///////";
			$event_data->event_code = $event_page->event_code;
			$event_data->event_facilitated_by = $event_page->event_facilitated_by;
			$event_data->location = $event_page->location;
			$event_data->event_start_date = date("Y-m-d", (int)$event_page->event_start_date);
			if((int)$event_page->event_end_date > 0){
				$event_data->event_end_date = date("Y-m-d", (int)$event_page->event_end_date);
			}else{
				$event_data->event_end_date = "";
			}
//$to_return->enda[] = (int)$event_page->event_end_date;
			$event_data->event_start_time = $event_page->event_start_time;
			$event_data->event_end_time = $event_page->event_end_time;
			$event_data->summary = $event_page->summary;
			$event_data->event_speaker_details = $event_page->event_speaker_details;
			$event_data->event_who_can_attend = $event_page->event_who_can_attend;
			$event_data->ticket_price = $event_page->ticket_price;
			$event_data->event_link = $event_page->event_link;
			if($event_page->is_popup_show_event!=""){
				$is_show_popup = $event_page->is_popup_show_event;
				if($is_show_popup=="show"){
					$event_data->is_show_popup = "Show";
				}
				elseif($is_show_popup=="hide"){
					$event_data->is_show_popup = "Hide";
				}
				else{
					$event_data->is_show_popup = "Hide";
				}
				
			}
			else{
				$event_data->is_show_popup = "Hide";
			}
			

			$event_data->serial_number=$serial_counter;
			$serial_counter++;
			/**accesss workshop event added data and time */
			$event_data->registration_time=$event_page->published +  60*60*5.50;
			$event_data->registration_time=date('d/m/Y h:i A', $event_data->registration_time);

			if($event_page->job_added_by !=0){
    			
				$admin_page=\ProcessWire\wire('pages')->get("name=admins")->child("id=".$event_page->job_added_by);
				//echo $admin_page->company_name;
				$editor_page=\ProcessWire\wire('pages')->get("name=editors")->child("id=".$event_page->job_added_by);
				//echo $recruiter_page;
				
				if($admin_page->id!=0){
					$event_data->event_added_by=$admin_page->title;
				}
				elseif($editor_page->id!=0){
					$event_data->event_added_by=$editor_page->title; 
				}
				else{
					$event_data->event_added_by="-";
				}
			}
			else{
			    $event_data->event_added_by="-";
			}

			/* Other column data in the table */
			$event_data->checkbox = "<input id='".$event_page->id."_checkbox' class='event_checkbox' type='checkbox'>";
			$event_data->edit = "<button id='".$event_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit event</button>";
			//echo \ProcessWire\wire('session')->user_designation;
			if(\ProcessWire\wire('session')->user_designation=="admin"){
				$applicants_list_link=\ProcessWire\wire('pages')->get("name=admin-candidate-table")->httpUrl."?event_code=".$event_data->event_code;
			}
			elseif(\ProcessWire\wire('session')->user_designation=="editor"){
				$applicants_list_link=\ProcessWire\wire('pages')->get("name=editor-candidate-table")->httpUrl."?event_code=".$event_data->event_code;
			}
			else{
				$applicants_list_link="";
			}
			
			
			$event_data->applicants_list_button="<a target='_blank' href='".$applicants_list_link."' id='".$event_page->id."_applicants_list_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Applicants</a>";

			$event_preview_link=$event_page->httpUrl;
			// echo "***********";
			// echo $event_preview_link;
			$event_data->event_preview = "<a target='_blank' href='".$event_preview_link."' id='".$event_page->id."_preview_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Preview</a>";

			/* Save the event data object into the main array of all the event data */
			array_push($event_data_array, $event_data);
		}
		/* Loop through all the event profile pages END */

		/* Save the event data array into the object that is to be sent back */
		$to_return->data = $event_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"event Code", "data"=>"event_code"],
			["title"=>"Title", "data"=>"title"],
			["title"=>"Location", "data"=>"location"],
			["title"=>"Deadline", "data"=>"application_deadline_for_table"],
			["title"=>"Start Date", "data"=>"event_start_date"],
			["title"=>"Created Time", "data"=>"registration_time"],
			["title"=>"Created By", "data"=>"event_added_by"],
			["title"=>"Source Status", "data"=>"is_show_popup"],
			["title"=>"Edit", "data"=>"edit"],
			["title"=>"Applicants List", "data"=>"applicants_list_button"],
			["title"=>"Preview", "data"=>"event_preview"]
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all events to show in the table END */

	/* Function to delete event accounts based on given IDs */
	function delete_events($requested_profiles_to_delete_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_delete = json_decode($requested_profiles_to_delete_json);

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
		foreach ($requested_profiles_to_delete as $profile_to_delete_id) {
			if(\ProcessWire\wire("pages")->get("name=workshops")->child("id=".$profile_to_delete_id)->trash()){
				$successfully_deleted_profiles[] = $profile_to_delete_id;
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

			/* If all the requested profiles have been deleted successfully */
			if(count($successfully_deleted_profiles) == count($requested_profiles_to_delete)){
				$to_return->success->success_message = "All the requested profiles have been deleted successfully.";
			}
			/* If some profiles were not deleted */
			else{
				$to_return->success->success_message = "Some profiles could not be deleted. Please try again.";
			}
		}

		end_and_return();
	}
	/* Function to delete event accounts based on given IDs END */

	/* Function to modify the information of an event profile from POST data */
	function modify_event($edit_profile_form_details){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);

		/* Array to save data and then to save into the page */
		$edit_event_details_to_save = Array();

		foreach ($edit_profile_form_details as $input_element) {
			$edit_event_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

		/* Get the event page to edit based on the ID */
		$event_page_to_change = \ProcessWire\wire('pages')->get($edit_event_details_to_save['id']);
		$event_page_to_change->of(false);

		/* Save the data */
		$event_page_to_change->title = $edit_event_details_to_save['event_title'];
		$event_page_to_change->event_start_date = $edit_event_details_to_save['event_event_start_date'];
		$event_page_to_change->event_end_date = $edit_event_details_to_save['event_event_end_date'];
		$event_page_to_change->event_start_time = $edit_event_details_to_save['event_event_start_time'];
		$event_page_to_change->event_end_time = $edit_event_details_to_save['event_event_end_time'];
		$event_page_to_change->event_link = $edit_event_details_to_save['event_event_link'];
		$event_page_to_change->event_facilitated_by = $edit_event_details_to_save['event_event_facilitated_by'];
		$event_page_to_change->location = $edit_event_details_to_save['event_location'];
		$event_page_to_change->summary = $edit_event_details_to_save['event_summary'];
		$event_page_to_change->event_speaker_details = $edit_event_details_to_save['event_speaker_details'];
		$event_page_to_change->event_who_can_attend = $edit_event_details_to_save['event_who_can_attend'];
		$event_page_to_change->ticket_price = $edit_event_details_to_save['event_ticket_price'];
		$event_page_to_change->application_deadline = $edit_event_details_to_save['event_application_deadline'];
		
		if(isset($edit_event_details_to_save['edit_event_show_workshop_popup']) && $edit_event_details_to_save['edit_event_show_workshop_popup'] != ""){
			// 	echo $edit_event_details_to_save['event_show_workshop_popup'];
			// echo "****";
			$event_page_to_change->is_popup_show_event = $edit_event_details_to_save['edit_event_show_workshop_popup'];
  	}
		else{
			$event_page_to_change->is_popup_show_event = "hide";
		}
		
		
		/* Save page */
		$event_page_to_change->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Modified event profile with the name ".$event_page_to_change->title = $edit_event_details_to_save['event_title'];
		end_and_return();
	}
	/* Function to modify the information of an event profile from POST data END*/

	/* Function to create a new event based on given data in POST */
	function create_event($new_event_form_details){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Convert json form data into required format */
		$new_event_form_details = json_decode($new_event_form_details);

		/* Array to save data and then to save into the page */
		$new_event_details_to_save = Array();

		foreach ($new_event_form_details as $input_element) {
			$new_event_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

		/* New event Page info */
		$new_event_page = \ProcessWire\wire(new \ProcessWire\Page());
		$new_event_page->template = \ProcessWire\wire('templates')->get("event-page");
		$new_event_page->parent = \ProcessWire\wire('pages')->get("name=workshops");

		$new_event_page->title = $new_event_details_to_save['event_title'];
		$new_event_page->event_start_date = $new_event_details_to_save['event_event_start_date'];
		$new_event_page->event_end_date = $new_event_details_to_save['event_event_end_date'];
		$new_event_page->event_start_time = $new_event_details_to_save['event_event_start_time'];
		$new_event_page->event_end_time = $new_event_details_to_save['event_event_end_time'];
		$new_event_page->event_link = $new_event_details_to_save['event_event_link'];
		$new_event_page->event_facilitated_by = $new_event_details_to_save['event_event_facilitated_by'];
		$new_event_page->location = $new_event_details_to_save['event_location'];
		$new_event_page->summary = $new_event_details_to_save['event_summary'];
		$new_event_page->event_speaker_details = $new_event_details_to_save['event_speaker_details'];
		$new_event_page->event_who_can_attend = $new_event_details_to_save['event_who_can_attend'];
		$new_event_page->ticket_price = $new_event_details_to_save['event_ticket_price'];	
		$new_event_page->application_deadline = $new_event_details_to_save['event_application_deadline'];
		// echo $new_event_details_to_save['event_show_workshop_popup'];
		// echo "****";
		if(isset($new_event_details_to_save['event_show_workshop_popup']) && $new_event_details_to_save['event_show_workshop_popup'] != ""){
			// 	echo $edit_event_details_to_save['event_show_workshop_popup'];
			// echo "****";
			$new_event_page->is_popup_show_event = $new_event_details_to_save['event_show_workshop_popup'];
  	}
		else{
			$new_event_page->is_popup_show_event = "hide";
		}
		
		
		$new_event_page->job_added_by = \ProcessWire\wire('session')->user_page_id;

		/* Set automatic Event Code */
		/* Get last added event */
		// $latest_page = \ProcessWire\wire('pages')->get("name=workshops")->child("sort=-created");

		// /* Get the event code from the latest event, extract the number from it, add one to it. Combine this number with EV- prefix and save */
		// $latest_event_code = (int)substr($latest_page->event_code,3);
		// $new_event_page->event_code = "EV-".($latest_event_code + 1);
		/* Set automatic Event Code End */

		/*** Amruta Jagatap Event code Serial ID created from the ID counter page */
		/**** Get serial ID from the serial ID page */
		$event_code_serial_id_counter_page = \ProcessWire\wire('pages')->get("name=event-code-serial-id-counter");
		/**** Assign the given ID to the  new page and increment the number for the next page */
		$new_event_page->event_code = "EV-".$event_code_serial_id_counter_page->serial_id++;
//echo"5";
		/**** save the incremented ID page */
		$event_code_serial_id_counter_page-> of(false); 
		$event_code_serial_id_counter_page->save();
		/*** Amruta Jagatap Event code Serial ID created from the ID counter page END */

		/* Save page */
		$new_event_page->of(false);
		$new_event_page->save();


		/* Return data */
		$to_return->success->success_status = true;
		$to_return->success->success_message = "New event created with the name ".$new_event_page->title = $new_event_details_to_save['event_title'];
		end_and_return();
	}
	/* Function to create a new event based on given data in POST END*/










