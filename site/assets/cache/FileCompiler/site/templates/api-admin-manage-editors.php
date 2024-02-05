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
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_editor_table_data", "delete_editors", "modify_editor", "create_editor"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_editor_table_data':
			fetch_editor_table_data();
		break;

		case 'delete_editors':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "text", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_editors($requested_profiles_to_delete_json);
		break;

		case 'modify_editor':
			/* Save the data sent from the form */
			$edit_profile_form_details = $input->post("edit_profile_form_details", "textarea", false);

			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			modify_editor($edit_profile_form_details);
		break;

		case 'create_editor':
			/* Save the data sent from the form */
			$new_editor_form_details = $input->post("new_editor_form_details", "textarea", false);

			if(!$new_editor_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			create_editor($new_editor_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all editors to show in the table */
	function fetch_editor_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$editor_data_array = Array();
		

		/* Loop through all the Editor profile pages */
		foreach(\ProcessWire\wire('pages')->get("name=editors")->children("sort=-published") as $editor_page) {
			/* Each candidate's data is to be saved in a seperate object */
			$editor_data = new stdClass();

			$editor_data->id = $editor_page->id;
			$editor_data->name = $editor_page->title;
			$editor_data->email = $editor_page->email;
			$editor_data->password = $editor_page->password;
			$editor_data->unlock_quota = $editor_page->unlock_quota;
			// echo "**********";
			// echo json_encode($editor_page->accessible_sections);
			// //if($editor_page->accessible_sections!=""){
			// // echo $editor_page->accessible_sections;
			//  //print_r($editor_page->accessible_sections);
			//  echo "++++++++++++++";
				
			//  print_r($editor_page->accessible_sections['name']);
			//  echo $editor_page->accessible_sections['name'];
			//$editor_data->accessible_sections = implode(", ",$editor_page->accessible_sections['name']);
			// $editor_data->accessible_sections="";
			// }
			$editor_data->accessible_sections_id_array=array();
			$editor_data->accessible_sections_array=array();
			if($editor_page->accessible_sections!=""){
    			foreach($editor_page->accessible_sections as $accessible_sections){
    			    /*add accessible sections id into accessible sections id array
								add accessible sections name into accessible sections array */
    			    $editor_data->accessible_sections_id_array[] = $accessible_sections->id;
    			    $editor_data->accessible_sections_array[] = $accessible_sections->title;
    			    //print_r($offer_category);
    			}
			}
			else{
				$editor_data->accessible_sections_id_array="";
			    $editor_data->accessible_sections_array="";
			}

			/* Other column data in the table */
			$editor_data->checkbox = "<input id='".$editor_page->id."_checkbox' class='editor_checkbox' type='checkbox'>";
			$editor_data->edit = "<button id='".$editor_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit Profile</button>";

			/* Save the editor data object into the main array of all the editor data */
			array_push($editor_data_array, $editor_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $editor_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Name", "data"=>"name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Unlock Quota", "data"=>"unlock_quota"],
			["title"=>"Accessible Sections", "data"=>"accessible_sections_array"],
			["title"=>"Edit", "data"=>"edit"]
		];

		$to_return->success->success_status = true;
		end_and_return();
	}
	/* Function to fetch the data of all editors to show in the table END */

	/* Function to delete editor accounts based on given IDs */
	function delete_editors($requested_profiles_to_delete_json){
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
			if(\ProcessWire\wire("pages")->get("name=editors")->child("id=".$profile_to_delete_id)->trash()){
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
	/* Function to delete editor accounts based on given IDs END */

	/* Function to modify the information of an editor profile from POST data */
	function modify_editor($edit_profile_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
//echo $edit_profile_form_details;
		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);
//print_r($edit_profile_form_details);
		/* Array to save data and then to save into the page */
		$edit_editor_details_to_save = Array();
		$accessible_sections=array();
		//$editor_page_to_change->accessible_sections=array();
		foreach ($edit_profile_form_details as $input_element) {
			$edit_editor_details_to_save[$input_element->name] = $input_element->value;
			if($input_element->name=='accessible_sections[]'){
				$accessible_sections[]=$input_element->value;
				//echo $input_element->value;
			}
		}
		// echo "++++++++";
		// print_r($accessible_sections);
		/* Array to save data and then to save into the page END */

		/* Get the editor page to edit based on the ID */
		$editor_page_to_change = \ProcessWire\wire('pages')->get($edit_editor_details_to_save['id']);
		//echo "editor accessible sections";
		//print_r($editor_page_to_change->accessible_sections['id']);
		$editor_page_to_change->of(false);

		/* Save the data */
		$editor_page_to_change->title = $edit_editor_details_to_save['editor_name'];
		$editor_page_to_change->email = $edit_editor_details_to_save['editor_email'];
		if($edit_editor_details_to_save['editor_password']!=""){
			$editor_page_to_change->password = $edit_editor_details_to_save['editor_password'];
		}
		$editor_page_to_change->unlock_quota = $edit_editor_details_to_save['editor_unlock_quota'];
		
		$editor_page_to_change->accessible_sections =\ProcessWire\pagearray($accessible_sections) ;

		$editor_page_to_change->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Modified editor profile with the name ".$editor_page_to_change->title = $edit_editor_details_to_save['editor_name'];
		end_and_return();
	}
	/* Function to modify the information of an editor profile from POST data END*/

	/* Function to create a new editor based on given data in POST */
	function create_editor($new_editor_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		// echo "*************";
		// echo $new_editor_form_details;
		/* Convert json form data into required format */
		$new_editor_form_details = json_decode($new_editor_form_details);
	

		//print_r($new_editor_form_details);
		
		/* Array to save data and then to save into the page */
		$new_editor_details_to_save = Array();
		$accessible_sections=array();
		foreach ($new_editor_form_details as $input_element) {
			//echo $input_element->name;
			$new_editor_details_to_save[$input_element->name] = $input_element->value;
			//echo "++++++++++++++++";
			if($input_element->name=='editor_accessible_sections[]'){
				$accessible_sections[]=$input_element->value;
				//echo $input_element->value;
			}
			//print_r($accessible_sections);
		}
	
		/* Array to save data and then to save into the page END */

		/* New Editor Page info */
		$new_editor_page = \ProcessWire\wire(new \ProcessWire\Page());
		$new_editor_page->template = \ProcessWire\wire('templates')->get("editor-profile");
		$new_editor_page->parent = \ProcessWire\wire('pages')->get("name=editors");

		$new_editor_page->title = $new_editor_details_to_save['editor_name'];
		$new_editor_page->email = $new_editor_details_to_save['editor_email'];
		$new_editor_page->password = $new_editor_details_to_save['editor_password'];
		$new_editor_page->unlock_quota = $new_editor_details_to_save['editor_unlock_quota'];
		$new_editor_page->accessible_sections = $accessible_sections;
	//echo $new_editor_page->accessible_sections;
		// echo $new_editor_details_to_save['editor_accessible_sections'];
		// print_r($new_editor_details_to_save['editor_accessible_sections'];)
		// print_r($new_editor_details_to_save['editor_accessible_sections']);
		$new_editor_page->candidate_table_column_array = json_encode(Array());
		$new_editor_page->favourite_profiles_array = json_encode(Array());
		$new_editor_page->unlocked_profiles_array = "{}";



		/* Save page */
		$new_editor_page->of(false);
		$new_editor_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "New editor created with the name ".$new_editor_page->title = $new_editor_details_to_save['editor_name'];
		end_and_return();
	}
	/* Function to create a new editor based on given data in POST END*/










