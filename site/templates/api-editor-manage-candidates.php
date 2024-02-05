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

	/**api-vanish-unlock-profiles is used for remove unlock profile after 4 months of added profile date*/
	require_once $config->paths->templates.'includes/api-vanish-unlock-profiles.php';

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
	if(!in_array($session->user_designation, ["editor"])){
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["add_to_favourite", "unlist_from_favourite", "unlock_profiles", "fetch_favourite_table_data", "fetch_unlocked_table_data"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'add_to_favourite':
			/* Save the data sent from the form */
			$requested_profiles_to_favourite_json = $input->post("requested_profiles_to_favourite_json", "textarea", false);

			if(!$requested_profiles_to_favourite_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			add_to_favourite($requested_profiles_to_favourite_json);
		break;

		case "unlist_from_favourite":
			/* Save the data sent from the form */
			$requested_profiles_to_unlist_json = $input->post("requested_profiles_to_unlist_json", "textarea", false);

			if(!$requested_profiles_to_unlist_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			unlist_from_favourite($requested_profiles_to_unlist_json);
		break;

		case "unlock_profiles":
			/* Save the data sent from the form */
			$requested_profiles_to_unlock_json = $input->post("requested_profiles_to_unlock_json", "textarea", false);

			if(!$requested_profiles_to_unlock_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			unlock_profiles($requested_profiles_to_unlock_json);
			end_and_return();
		break;

		case "fetch_favourite_table_data":
			/* Save the data sent from the form */
			$requested_columns_to_show = $input->post("requested_columns_array_json", "textarea", false);

			if(!$requested_columns_to_show){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			fetch_favourite_table_data($requested_columns_to_show);
		break;

		case "fetch_unlocked_table_data":
			/* Save the data sent from the form */
			$requested_columns_to_show = $input->post("requested_columns_array_json", "textarea", false);

			if(!$requested_columns_to_show){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			fetch_unlocked_table_data($requested_columns_to_show);
			end_and_return();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to add profiles to favourite based on given IDs */
	function add_to_favourite($requested_profiles_to_favourite_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_favourite = json_decode($requested_profiles_to_favourite_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_favourite) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}

		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		$editor_page->of(false);

		/* Get the current favourite profiles array */
		$favourite_profiles_array = json_decode($editor_page->favourite_profiles_array);

		/* If no favourites are already available */
		if($favourite_profiles_array == ""){
			$favourite_profiles_array = Array();
		}

		/* Profile IDs that already exist in favourites. */
		$already_favourited_array = array_intersect($requested_profiles_to_favourite, $favourite_profiles_array);

		/* Remove already existing profiles from the array to add, also remove profiles which are already unlocked*/
		$profiles_to_favourite = array_diff($requested_profiles_to_favourite, $already_favourited_array, fetch_unlocked_array());

		/* If no profiles are to be added */
		if(!count($profiles_to_favourite)){
			$to_return->success->success_status = true;
			$to_return->success->success_message  = "All the profiles are already favourited or unlocked.";
			end_and_return();
		}

		/* Merge the new profiles into the existing array on the editor page */
		$editor_page->favourite_profiles_array = json_encode(array_merge($favourite_profiles_array, $profiles_to_favourite));

		/* Save the editor page */
		$editor_page->save();

		$to_return->success->success_status = true;

		/* If all the requested profiles have been favourited successfully */
		if(count($profiles_to_favourite) == count($requested_profiles_to_favourite)){
			$to_return->success->success_message = "All the requested profiles have been favourited successfully.";
		}
		/* If some profiles were not favourited */
		else{
			$to_return->success->success_message = "Newly favourited ".count($profiles_to_favourite)." profiles.\nRemaining profiles were already favourited or unlocked.";
		}

		end_and_return();
	}
	/* Function to add profiles to favourite based on given IDs END */

	/* Function to remove profiles from favourite based on given IDs */
	function unlist_from_favourite($requested_profiles_to_unlist_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_unlist = json_decode($requested_profiles_to_unlist_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unlist) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlisted.";
			end_and_return();
		}

		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		$editor_page->of(false);

		/* Get the current favourite profiles array */
		$favourite_profiles_array = json_decode($editor_page->favourite_profiles_array);

		/* If no favourites are already available */
		if($favourite_profiles_array == ""){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlisted.";
			end_and_return();
		}

		/* Remove the requested profiles from the existing array on the editor page */
		$editor_page->favourite_profiles_array = json_encode(array_values(array_diff($favourite_profiles_array, $requested_profiles_to_unlist)));

		/* Save the editor page */
		$editor_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been unlisted successfully.";

		end_and_return();
	}
	/* Function to remove profiles from favourite based on given IDs END */

	/* Function to unlock profiles with given IDs */
	function unlock_profiles($requested_profiles_to_unlock_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_unlock = json_decode($requested_profiles_to_unlock_json);
// print_r($requested_profiles_to_unlock);
		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unlock) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were unlocked.";
			return;
		}

		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		$editor_page->of(false);
		/**Save unlocked profile id and timestamp in json when you unlock any profile */
		
		/* Get the current unlocked profiles array */
		$already_unlocked_profiles_array=array();
		$editor_unlocked_array=new stdClass();
		
		$editor_unlocked_array=$editor_page->unlocked_profiles_array;
		$unlocked_profiles_array = json_decode($editor_unlocked_array);
		// print_r($unlocked_profiles_array);
		// echo count((array)$unlocked_profiles_array);
		/* If no unlocked are already available */
		if($editor_page->unlocked_profiles_array==""){
			$editor_page->unlocked_profiles_array="{}";
		}
		foreach($unlocked_profiles_array as $candidate_id=>$timestamp){
			$already_unlocked_profiles_array[]=$candidate_id;
		}
		/* Profile IDs that already exist in unlocked. */
		$already_unlocked_array = array_intersect($requested_profiles_to_unlock, $already_unlocked_profiles_array);

		/* Remove already existing profiles from the array to add */
		$profiles_to_unlock = array_diff($requested_profiles_to_unlock, $already_unlocked_array);

		/* If no profiles are to be added */
		if(!count($profiles_to_unlock)){
			$to_return->success->success_status = true;
			$to_return->success->success_message  = "All the profiles are already Unlocked.";
			return;
		}
		/* If the number of profiles to unlock exceeds the available quota for the recruiter */
		
		elseif(count($profiles_to_unlock) > ($editor_page->unlock_quota - count((array)$unlocked_profiles_array))){
			$to_return->error->number_of_errors++;
			if(($editor_page->unlock_quota - count((array)$unlocked_profiles_array)) > 0){
				$to_return->error->error_message  = "You can unlock ".($editor_page->unlock_quota - count($unlocked_profiles_array))." more profiles.";
			}
			else{
				$to_return->error->error_message  = "You can unlock 0 more profiles.";
			}
			
			return; 
		}
		else{
			
		}

		$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
		$unlock_profiles_object=new stdClass();
		foreach($profiles_to_unlock as $single_unlock_profile){
			$unlocked_profiles_array->$single_unlock_profile=$current_timestamp;
		}
		
		$editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array);
		
		/* Remove profiles from favourite pofiles array if they exis in the unlocked array */
		if($editor_page->favourite_profiles_array != ""){
			$editor_page->favourite_profiles_array = json_encode(array_values(array_diff(json_decode($editor_page->favourite_profiles_array), $profiles_to_unlock)));
		}
		/* Save the editor page */
		$editor_page->of(false);
		$editor_page->save();

		$to_return->success->success_status = true;

		/* If all the requested profiles have been unlocked successfully */
		if(count($profiles_to_unlock) == count($requested_profiles_to_unlock)){
			$to_return->success->success_message = "All the requested profiles have been unlocked successfully.";
		}
		/* If some profiles were not unlocked */
		else{
			$to_return->success->success_message = count($already_unlocked_array)." Profiles were already unlocked.\nNewly unlocked ".count($profiles_to_unlock)." profiles.";
		}

		return;
	}
	/* Function to unlock profiles with given IDs END */

	/* Function to fetch table data for the favourites table */
	function fetch_favourite_table_data($requested_columns_to_show){
		/* Access global variable that is to be returned */
		global $to_return;

		/* For column names and variables */
		require_once wire("config")->paths->templates.'includes/candidate_table_data.php';

		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		// echo "****";
		/* If default columns are not requested, convert query to an array from json */
		// $requested_columns_to_show=array();
		// $requested_columns_to_show = json_decode($requested_columns_to_show);
		// print_r($requested_columns_to_show);
		// echo $requested_columns_to_show;
		if(!in_array($requested_columns_to_show, ["default", "all"])){
			$requested_columns_to_show = json_decode($requested_columns_to_show);
			// print_r($requested_columns_to_show);
			/* Check if the sent array has zero*/
			if(count($requested_columns_to_show) == 0){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "No columns were selected.";
				end_and_return();
			}
		}

		/*Decide columns availability */
		/* If default columns are requested, get them from the user's account. */
		if ($requested_columns_to_show == "default"){
			$requested_columns_to_show = json_decode($editor_page->candidate_table_column_array);
		}

		$available_columns_to_show = $columns_for_editor;
		/*Decide columns availability END */

		/* Cross check all the values requested to the available fields, create a new array which contains verified requested columns and their IDs and Titles too */
		$columns_to_show = Array();

		foreach ($requested_columns_to_show as $requested_column_key) {
			if(array_key_exists($requested_column_key, $available_columns_to_show)){
				$columns_to_show[$requested_column_key] = $available_columns_to_show[$requested_column_key];
			}
		}

		/* Save JSON array of chosen columns to show into the editor's page. Only the array of keys */
		$editor_page->of(false);
		$editor_page->candidate_table_column_array = json_encode(array_keys($columns_to_show));
		$editor_page->save();

		/* Get the current favourite profiles array */
		$favourite_profiles_array = json_decode($editor_page->favourite_profiles_array);

		/* If no favourites are already available */
		if($favourite_profiles_array == ""){
			$favourite_profiles_array = Array();
		}

		/* Array to save all the data of all the candidates into */
		$candidate_data_array = Array();

		/* Loop through all the favourite profiles an get their data */
		foreach ($favourite_profiles_array as $candidate_page_id) {
			$candidate_page = wire("pages")->get("name=candidates")->child("id=".$candidate_page_id);

			/* Each candidate's data is to be saved in a seperate object */
			$candidate_data = new stdClass();

			/* Code for the selectbox to be shown in the table */
			$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
			$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."_view_button' class='[ btn btn-outline-primary  ]' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";
			/* Loop through all the columns that are to be shown */
			foreach ($columns_to_show as $column_id => $column_title) {
				/* All these are special cases where the output is not readily available in the database. Create the output and save it into the object. */
				switch ($column_id) {
					case "date_of_birth": 
						// $candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						if($candidate_page->date_of_birth!=""){
							$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						}
						else{
							$candidate_data->date_of_birth="-";
						}
					break;

					case "custom_experience":
						$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

					case "custom_ctc":
						$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

					case "redacted_resume":
						$candidate_data->redacted_resume = "-";

						if ($candidate_page->redacted_resume) {
							$candidate_data->redacted_resume = "<a href='".$candidate_page->redacted_resume->httpUrl."' target='_blank'>Download<a>";
						}

					break; 

					case "internship_month":
						//$internship_apply=$user_page->internship_apply;
						
							$months=array();
							$months=json_decode($candidate_page->internship_month);
						if(!empty($months)){
							// echo "************";
							// echo $candidate_page->internship_month;
							// print_r($months);
							$candidate_data->internship_month=implode(", ",$months);
						}
						else{
							$candidate_data->internship_month="";
						}
					break;

					case "registration_time":
						$candidate_data->registration_time = date("F j, Y, g:i a", intval($candidate_page->created));
					break;

					/* For all the other outputs, they are to be shown as they are from the page data. */
					default:
						$candidate_data->$column_id = $candidate_page->$column_id;
						break;
				}
			}

			/* Save the candidate data object into the main array of all the candidate data */
			array_push($candidate_data_array, $candidate_data);
		}

		/* Save the candidate data array into the object that is to be sent back */
		$to_return->data = $candidate_data_array;

		/* Names of the columns to be displayed will be saved in this array */
		$to_return->columns = array();

		/* Add a column object for the selctbox column */
		$temp_object = new stdClass();
		$temp_object->title = "";
		$temp_object->data = "selectbox";

		$view_profile = new stdClass();
		$view_profile->title = "View Profile";
		$view_profile->data = "view_profile_button";

		$to_return->columns[] = $temp_object;
		$to_return->columns[] = $view_profile;
		/* Add a column object for the selctbox column END*/

		/* Creating table column objects from array */
		foreach ($columns_to_show as $key => $value) {
			$temp_object = new stdClass();
			$temp_object->title = $value;
			$temp_object->data = $key;

			$to_return->columns[] = $temp_object;
		}
		/* Creating table column objects from array END */

		end_and_return();
	}
	/* Function to fetch table data for the favourites table END */

	/* Function to fetch table data for the unlocked table */
	function fetch_unlocked_table_data($requested_columns_to_show){
		/* Access global variable that is to be returned */
		global $to_return;

		/* For column names and variables */
		require_once wire("config")->paths->templates.'includes/candidate_table_data.php';

		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);

		$unlocked_profiles_array = fetch_unlocked_array();

		/* If no unlcoked profils are available */
		if(!count($unlocked_profiles_array)){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "No unlocked profiles available.";
			return;
		}

		/* Array to save all the data of all the candidates into */
		$candidate_data_array = Array();

		/*Decide columns availability */
		$columns_to_show = $columns_for_admin;

		/* Loop through all the favourite profiles an get their data */
		foreach ($unlocked_profiles_array as $candidate_page_id) {
			$candidate_page = wire("pages")->get("name=candidates")->child("id=".$candidate_page_id);

			/* Each candidate's data is to be saved in a seperate object */
			$candidate_data = new stdClass();

			/* Code for the selectbox to be shown in the table */
			$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
			$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."_view_button' class='[ btn btn-outline-primary  ]' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";
			/* Loop through all the columns that are to be shown */
			foreach ($columns_to_show as $column_id => $column_title) {
				/* All these are special cases where the output is not readily available in the database. Create the output and save it into the object. */
				switch ($column_id) {
					case "custom_full_name":
						$candidate_data->custom_full_name = $candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
					break;

					case "custom_phone_number":
						$candidate_data->custom_phone_number = $candidate_page->phone_country_code.$candidate_page->phone_number;
					break;

					case "date_of_birth":
						// $candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						if($candidate_page->date_of_birth!=""){
							$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
						}
						else{
							$candidate_data->date_of_birth="-";
						}
					break;

					case "custom_experience":
						$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

					case "custom_ctc":
						$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

					case "resume":
						$candidate_data->resume = "-";

						if ($candidate_page->resume) {
							$candidate_data->resume = "<a href='".$candidate_page->resume->httpUrl."' target='_blank'>Download<a>";
						}

					break;

					case "profile_picture":
						$candidate_data->profile_picture = "-";

						if ($candidate_page->profile_picture) {
							$candidate_data->profile_picture = "<a href='".$candidate_page->profile_picture->httpUrl."' target='_blank'>Show<a>";
						}

					break;

					case "redacted_resume":
						$candidate_data->redacted_resume = "-";

						if ($candidate_page->redacted_resume) {
							$candidate_data->redacted_resume = "<a href='".$candidate_page->redacted_resume->httpUrl."' target='_blank'>Download<a>";
						}

					break;

					case "internship_month":
						//$internship_apply=$user_page->internship_apply;
						
							$months=array();
							$months=json_decode($candidate_page->internship_month);
						if(!empty($months)){
							// echo "************";
							// echo $candidate_page->internship_month;
							// print_r($months);
							$candidate_data->internship_month=implode(", ",$months);
						}
						else{
							$candidate_data->internship_month="";
						}
					break;

					case "registration_time":
						$candidate_data->registration_time = date("F j, Y, g:i a", intval($candidate_page->created));
					break;

					/* For all the other outputs, they are to be shown as they are from the page data. */
					default:
						$candidate_data->$column_id = $candidate_page->$column_id;
					break;
				}
			}

			/* Save the candidate data object into the main array of all the candidate data */
			array_push($candidate_data_array, $candidate_data);
		}

		/* Save the candidate data array into the object that is to be sent back */
		$to_return->data = $candidate_data_array;

		/* Names of the columns to be displayed will be saved in this array */
		$to_return->columns = array();

		/* Add a column object for the selctbox column */
		$temp_object = new stdClass();
		$temp_object->title = "";
		$temp_object->data = "selectbox";

		$view_profile = new stdClass();
		$view_profile->title = "View Profile";
		$view_profile->data = "view_profile_button";

		$to_return->columns[] = $temp_object;
		$to_return->columns[] = $view_profile;
		/* Add a column object for the selctbox column END*/

		/* Creating table column objects from array */
		foreach ($columns_to_show as $key => $value) {
			$temp_object = new stdClass();
			$temp_object->title = $value;
			$temp_object->data = $key;

			$to_return->columns[] = $temp_object;
		}
		/* Creating table column objects from array END */

		$to_return->success->success_status = true;
		return;
	}
	/* Function to fetch table data for the unlocked table END */

	/* Function to check the unlocked array, delete expired profiles, return an array withonly IDs */
	function fetch_unlocked_array(){
		/* Get the current editor's page */
		$editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		$editor_page->of(false);

		/* Get the current favourite profiles array */
		// $unlocked_profiles_array_to_save = json_decode($editor_page->unlocked_profiles_array);
		$unlocked_profiles_array=array();
		$unlocked_profiles_object = json_decode($editor_page->unlocked_profiles_array);
		foreach($unlocked_profiles_object as $candidate_id=>$timestamp){
			$unlocked_profiles_array[]=$candidate_id;
		}


		/* Array to save just the unlocked page IDs without the timestamp */
		//$unlocked_profiles_array = Array();

		/* Go through the object array to see if time limit on unlocked profiles exceeds. Remove the element if it does. */
		// foreach($unlocked_profiles_array_to_save as $key=>$value){
		// 	/* if timestamp is more than 24Hrs old */ 
		// 	if(time() > $value->timestamp+(24*60*60)){
		// 		unset($unlocked_profiles_array_to_save[$key]);
		// 	}else{
		// 		$unlocked_profiles_array = array_merge($unlocked_profiles_array, $value->unlocked_profiles_array);
		// 	}
		// }

		// /* Serialize the array */
		// $unlocked_profiles_array_to_save = array_values($unlocked_profiles_array_to_save);

		/* Save it to the page */
		// $editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array_to_save);
		// $editor_page->save();

		/* Now returned the flattened array containing only unlcoked IDs */
		return $unlocked_profiles_array;
	}
	/* Function to check the unlocked array, delete expired profiles, return an array withonly IDs END */