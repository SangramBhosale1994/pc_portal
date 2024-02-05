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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_editor_unlock_request_table_data", "unlock_profiles"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_editor_unlock_request_table_data":
			fetch_editor_unlock_request_table_data();
			end_and_return();
		break;

		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_editor_profile_to_unlock = $input->post("requested_editor_profile_to_unlock", "text", false);

			if(!$requested_editor_profile_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_editor_profile_to_unlock);
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
	function fetch_editor_unlock_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$editor_data_array = Array();

		/* Loop through all the Editor profile pages */
		foreach(\ProcessWire\wire('pages')->get("name=editors")->children() as $editor_page) {
			/* Each candidate's data is to be saved in a seperate object */
			$editor_data = new stdClass();

			/* Create array if favourites are empty */
			if($editor_page->favourite_profiles_array == ""){
				$editor_page->favourite_profiles_array = "[]";
			}

			$editor_data->id = $editor_page->id;
			$editor_data->name = $editor_page->title;
			$editor_data->favourite_profiles_count = count(json_decode($editor_page->favourite_profiles_array));
			//$editor_data->unlocked_profiles_count = count(new RecursiveIteratorIterator(new RecursiveArrayIterator(array_map(function($unlcok_list){
			// 	return $unlcok_list->unlocked_profiles;
			// } ,json_decode($editor_page->unlocked_profiles_array)))));

			/* Other column data in the table */
			$editor_data->unlock_button = "<button id='".$editor_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Unlock</button>";

			/* If nothing to be unlocked, hide button */
			if($editor_data->favourite_profiles_count == 0){
				$editor_data->unlock_button = "-";
			}

			/* Save the editor data object into the main array of all the editor data */
			array_push($editor_data_array, $editor_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $editor_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"Name", "data"=>"name"],
			["title"=>"Favourites", "data"=>"favourite_profiles_count"],
			//["title"=>"Unlocked", "data"=>"favourite_profiles_count"],
			["title"=>"Unlock Favourites", "data"=>"unlock_button" ]
		];

		$to_return->success->success_status = true;
		return;
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */

	/* Function to unlock editor's favourite based on given editor IDs */
	function unlock_profiles($requested_editor_profile_to_unlock){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$editor_page = \ProcessWire\wire("pages")->get("name=editors")->child("id=".$requested_editor_profile_to_unlock);
		$editor_page->of(false);

		/* If editor not found, return */
		if($editor_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Editor not found. Please refresh and ty again.";
			return;
		}

		/* If favourites are 0, return */
		if($editor_page->favourite_profiles_array == "[]"){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "This editor has no favourites.";
			return;
		}

		/* Object for containing timestamp and newly unlocked profiles */
		$newly_unlocked = new stdClass;
		$newly_unlocked->timestamp = time();
		$newly_unlocked->unlocked_profiles_array = json_decode($editor_page->favourite_profiles_array);

		/* Add the new object to the unlocked array of admin page. */
		$unlocked_profiles_array = json_decode($editor_page->unlocked_profiles_array);

		array_push($unlocked_profiles_array, $newly_unlocked);

		$editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array);
		/* Add the new object to the unlocked array of admin page. END */


		/* empty the favourites */
		$editor_page->favourite_profiles_array = "[]";

		/* save the page */
		$editor_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been unlocked.";

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */