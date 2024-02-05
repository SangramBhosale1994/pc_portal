<?php

// echo "Abc";
// die();
	function find_skill_synonyms($skills_data_object,$keyword)
	{
		//echo "match";
		$skill_titles_to_return=array();
		foreach($skills_data_object as $skill_title => $skill_data){
			if(in_array($keyword,$skill_data->synonyms))
			{
				$skill_titles_to_return[]= $skill_title;
				
			}
		}
		if(empty($skill_titles_to_return)){
			return false;
		}
		else{
			return $skill_titles_to_return;
		}
		
		//echo in_array("lead",$soft_skills_data_json->$key->synonyms);
		
	}


		
							//$synonyms = array("java","c");
												
					
					 //arsort($skills_data);
					// arsort($soft_skills_data_json);
					// arsort($technical_skills_data_json);
					// arsort($non_technical_skills_data_json);

					//print_r($data);

						
						
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_skills_matrix_table_data","delete_skills", "modify_skills","refresh_skills"], false);
//echo "1";
	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_skills_matrix_table_data':
			//echo "2";
			fetch_skills_matrix_table_data();
		break;

		case 'delete_skills':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_skills($requested_profiles_to_delete_json);
		break;

		case 'modify_skills':
			/* Save the data sent from the form */
			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);

			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			modify_skills($edit_profile_form_details);
		break;

		case 'refresh_skills':
			/* Save the data sent from the form */
			refresh_skills();
			// $new_event_form_details = $input->post("new_event_form_details", "string", false);

			// if(!$new_event_form_details){
			// 	$to_return->error->number_of_errors++;
			// 	$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			// 	end_and_return();
			// }

			// create_event($new_event_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}


	/* Function to fetch the data of all events to show in the table */
	function fetch_skills_matrix_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the events into */
		$skills_data_array = Array();
		$soft_skills_data_array = Array();
		$technical_skills_data_array = Array();
		$non_technical_skills_data_array = Array();
//echo "1";
$to_return->enda =Array();

	$skill_matrix_page=(wire('pages')->get("name=skill-matrix"));
		
	 /**skill data matrix */
		$skills_data_matrix=$skill_matrix_page->old_skills_matrix;
		//echo $skills_data_matrix;
		$skills_data_object=json_decode($skills_data_matrix);
		$counter=0;
		foreach ($skills_data_object as $key => $value) {
			$skills_data = new stdClass();
		//print_r($skills_data);
			$skills_data->counter=$counter;
			$skills_data->key=$key;
			$skills_data->number_of_candidates=$value->number_of_candidates;
			$skills_data->synonyms=implode(", ",$value->synonyms);

			$skills_data->checkbox = "<input id='".$skills_data->counter."_checkbox' class='event_checkbox' type='checkbox'>";
			$skills_data->edit = "<button id='".$counter."_skills_edit_button' class='[ btn btn-primary ]( skills_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit event</button>";
		//echo "1";
			array_push($skills_data_array, $skills_data);
			$counter++;
		}

		
		/**soft skill data matrix */
		//soft skills decode data
		$soft_skills_data_matrix=$skill_matrix_page->soft_skills_matrix;
		$soft_skills_data_object=json_decode($soft_skills_data_matrix);

		$counter=0;
		foreach ($soft_skills_data_object as $key => $value) {
			$soft_skills_data = new stdClass();
		//print_r($skills_data);
			$soft_skills_data->counter=$counter;
			$soft_skills_data->key=$key;
			$soft_skills_data->number_of_candidates=$value->number_of_candidates;
			$soft_skills_data->synonyms=implode(", ",$value->synonyms);

			$soft_skills_data->checkbox = "<input id='".$soft_skills_data->counter."_checkbox' class='event_checkbox' type='checkbox'>";
			$soft_skills_data->edit = "<button id='".$counter."_soft_skills_edit_button' class='[ btn btn-primary ]( soft_skills_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit event</button>";
		//echo "1";
			array_push($soft_skills_data_array, $soft_skills_data);
			$counter++;
		}


		/** technical skill data matrix */
		//technical skills decode data
		$technical_skills_data_matrix=$skill_matrix_page->technical_skills_matrix;
		$technical_skills_data_object=json_decode($technical_skills_data_matrix);

		$counter=0;
		foreach ($technical_skills_data_object as $key => $value) {
			$technical_skills_data = new stdClass();
		//print_r($skills_data);
			$technical_skills_data->counter=$counter;
			$technical_skills_data->key=$key;
			$technical_skills_data->number_of_candidates=$value->number_of_candidates;
			$technical_skills_data->synonyms=implode(", ",$value->synonyms);

			$technical_skills_data->checkbox = "<input id='".$technical_skills_data->counter."_checkbox' class='event_checkbox' type='checkbox'>";
			$technical_skills_data->edit = "<button id='".$counter."_technical_skills_edit_button' class='[ btn btn-primary ]( technical_skills_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit event</button>";
		//echo "1";
			array_push($technical_skills_data_array, $technical_skills_data);
			$counter++;
		}
		

		/** non technical skill data matrix */
		//non technical skills decode data
		$non_technical_skills_data_matrix=$skill_matrix_page->non_technical_skills_matrix;
		$non_technical_skills_data_object=json_decode($non_technical_skills_data_matrix);

		$counter=0;
		foreach ($non_technical_skills_data_object as $key => $value) {
			$non_technical_skills_data = new stdClass();
		//print_r($skills_data);
			$non_technical_skills_data->counter=$counter;
			$non_technical_skills_data->key=$key;
			$non_technical_skills_data->number_of_candidates=$value->number_of_candidates;
			$non_technical_skills_data->synonyms=implode(", ",$value->synonyms);

			$non_technical_skills_data->checkbox = "<input id='".$non_technical_skills_data->counter."_checkbox' class='event_checkbox' type='checkbox'>";
			$non_technical_skills_data->edit = "<button id='".$counter."_non_technical_skills_edit_button' class='[ btn btn-primary ]( non_technical_skills_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit event</button>";
		//echo "1";
			array_push($non_technical_skills_data_array, $non_technical_skills_data);
			$counter++;
		}
	

		/* Save the event data array into the object that is to be sent back */
		$to_return->skills_data = $skills_data_array;
		$to_return->soft_skills_data = $soft_skills_data_array;
		$to_return->technical_skills_data = $technical_skills_data_array;
		$to_return->non_technical_skills_data = $non_technical_skills_data_array;
		/* Names and data of the columns to be displayed will be saved in this array */
		

				$to_return->columns = [
				["title"=>"", "data"=>"checkbox"],
				["title"=>"Skills", "data"=>"key"],
				["title"=>"Candidates", "data"=>"number_of_candidates"],
				["title"=>"Synonyms", "data"=>"synonyms"],
				["title"=>"Edit", "data"=>"edit"]
			];
		
		$to_return->success->success_status = true;
		end_and_return();
		}
	//}
	/* Function to fetch the data of all events to show in the table END */

		/* Function to fetch the data of all events to show in the table */
function refresh_skills(){
		/* Access global variable that is to be returned */
		global $to_return;

		// /* Array to save all the data of all the events into */
		// $skills_data_array = Array();
		// $soft_skills_data_array = Array();
		// $technical_skills_data_array = Array();
		// $non_technical_skills_data_array = Array();
	//echo "1";
	$to_return->enda =Array();

	$skill_matrix_page=(wire('pages')->get("name=skill-matrix"));
		
	 /**skill data matrix */
		$skills_data_matrix=$skill_matrix_page->old_skills_matrix;
		//echo $skills_data_matrix;
		$skills_data_object=json_decode($skills_data_matrix);
		foreach( $skills_data_object as $key => $value){
			$value->number_of_candidates=0;
		}

		//soft skills decode data
		$soft_skills_data_matrix=$skill_matrix_page->soft_skills_matrix;
		$soft_skills_data_object=json_decode($soft_skills_data_matrix);
		foreach( $soft_skills_data_object as $key => $value){
			$value->number_of_candidates=0;
		}
		
		//technical skills decode data
		$technical_skills_data_matrix=$skill_matrix_page->technical_skills_matrix;
		$technical_skills_data_object=json_decode($technical_skills_data_matrix);
		foreach( $technical_skills_data_object as $key => $value){
			$value->number_of_candidates=0;
		}

		//non technical skills decode data
		$non_technical_skills_data_matrix=$skill_matrix_page->non_technical_skills_matrix;
		$non_technical_skills_data_object=json_decode($non_technical_skills_data_matrix);
		foreach( $non_technical_skills_data_object as $key => $value){
			$value->number_of_candidates=0;
		}

		foreach (wire('pages')->get("name=candidates")->children() as $candidate_page) {
			// //for skills 
			$skills_arr=strtolower($candidate_page->skills);
			$skills_arr = explode (",", $skills_arr); 
			$skills_arr_data=array_filter($skills_arr);

			foreach( $skills_arr_data as $skills){
				$key=trim($skills);
			// foreach( array_key_exists("c", $str_arr) as $key){
			// print_r($str_arr);
				$skill_titles_array=find_skill_synonyms($skills_data_object,$key);

				if($skill_titles_array){
					foreach($skill_titles_array as $skill_title)
					{
	//echo "6";
						//echo $skill_title;
						$skills_data_object->$skill_title->number_of_candidates++;
					}
					
				}
				else{
	//echo "7";					//$data[$key]=1;
					$skills_data_object->$key=new stdClass;
					$skills_data_object->$key->number_of_candidates=1;
					$skills_data_object->$key->synonyms=array();
					$skills_data_object->$key->synonyms[]=$key;
				}
				
			}

			//for soft skills
			$soft_skills_arr=strtolower($candidate_page->soft_skills);
			$str_arr = explode (",", $soft_skills_arr); 
			$str=array_filter($str_arr);
			//$syno=implode(",",$synonyms);
			//echo $syno;
		
			//echo $soft_skills_data_json->$key;
	//echo "8";
			foreach( $str as $key){
				$key=trim($key);

			// foreach( array_key_exists("c", $str_arr) as $key){
			// print_r($str_arr);
			
				
				$skill_titles_array=find_skill_synonyms($soft_skills_data_object,$key);

				if($skill_titles_array){
					foreach($skill_titles_array as $skill_title)
					{
	//echo "9";						//echo $skill_title;
						$soft_skills_data_object->$skill_title->number_of_candidates++;
					}
					
				}
				else{
					//$data[$key]=1;
					$soft_skills_data_object->$key=new stdClass;
					$soft_skills_data_object->$key->number_of_candidates=1;
					$soft_skills_data_object->$key->synonyms=array();
					$soft_skills_data_object->$key->synonyms[]=$key;
				}

				// $arr=in_array("lead",$soft_skills_data_json->$key->synonyms);
				// echo $arr;
				
			}
			
			// for technical skills
			$technical_skills_arr=strtolower($candidate_page->technical_skills);
			$technical_skills_arr = explode (",", $technical_skills_arr); 
			$technical_skills_data=array_filter($technical_skills_arr);
	//echo "10";
			foreach( $technical_skills_data as $technical_skills){
				$key=trim($technical_skills);

			// foreach( array_key_exists("c", $str_arr) as $key){
			// print_r($str_arr);

				$skill_titles_array=find_skill_synonyms($technical_skills_data_object,$key);

				if(!empty($skill_titles_array)){
					foreach($skill_titles_array as $skill_title)
					{
	//echo "11";						//echo $skill_title;
						$technical_skills_data_object->$skill_title->number_of_candidates++;
					}
					
				}
				else{
					//$data[$key]=1;
					$technical_skills_data_object->$key=new stdClass;
					$technical_skills_data_object->$key->number_of_candidates=1;
					$technical_skills_data_object->$key->synonyms=array();
					$technical_skills_data_object->$key->synonyms[]=$key;
				}
				
			}
			//$technical_skills_data=$technical_skills_data;

			// for non-technical skills
			$non_technical_skills_arr=strtolower($candidate_page->non_technical_skills);
			$non_technical_skills_arr = explode (",", $non_technical_skills_arr); 
			$non_technical_skills_data=array_filter($non_technical_skills_arr);

	//echo "12";			//$syno=implode()
			foreach( $non_technical_skills_data as $non_technical_skills){
				$key=trim($non_technical_skills);

				$skill_titles_array=find_skill_synonyms($non_technical_skills_data_object,$key);

				if($skill_titles_array){
					foreach($skill_titles_array as $skill_title)
					{
	//echo "13";				
						$non_technical_skills_data_object->$skill_title->number_of_candidates++;
					}
					
				}else{
					//$data[$key]=1;
					$non_technical_skills_data_object->$key=new stdClass;
					$non_technical_skills_data_object->$key->number_of_candidates=1;
					$non_technical_skills_data_object->$key->synonyms=array();
					$non_technical_skills_data_object->$key->synonyms[]=$key;
				}
				
			}
			//$non_technical_skills_data=$non_technical_skills_data;

		}

		$data_json_skills=json_encode($skills_data_object);
			//echo $data_json_soft_skills;
		$skill_matrix_page->old_skills_matrix=$data_json_skills;

		//soft skills data
		$data_json_soft_skills=json_encode($soft_skills_data_object);
		//echo $data_json_soft_skills;
		$skill_matrix_page->soft_skills_matrix=$data_json_soft_skills;

		//technical skills data
		$data_json_technical_skills=json_encode($technical_skills_data_object);
		//echo $data_json_technical_skills;
		$skill_matrix_page->technical_skills_matrix=$data_json_technical_skills;

		//non-technical skills data
		$data_json_non_technical_skills=json_encode($non_technical_skills_data_object);
		//echo $data_json_non_technical_skills;
		$skill_matrix_page->non_technical_skills_matrix=$data_json_non_technical_skills;


		$skill_matrix_page->of(false);
		$skill_matrix_page->save();

		$to_return->success->success_status = true;
		end_and_return();
}
	//}
	/* Function to refresh the data of all events to show in the table END */

	/* Function to delete event accounts based on given IDs */
	function delete_skills($requested_profiles_to_delete_json){
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
		elseif (count($requested_profiles_to_delete) > 10) {
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Only 10 profiles can be deleted at a time.";
			end_and_return();
		}

		$successfully_deleted_profiles = Array();

		/* Delete each requested profile */
		foreach ($requested_profiles_to_delete as $profile_to_delete_id) {
			if(wire("pages")->get("name=workshops")->child("id=".$profile_to_delete_id)->trash()){
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
	function modify_skills($edit_profile_form_details){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);

		/* Array to save data and then to save into the page */
		$edit_skills_details_to_save = Array();

		foreach ($edit_profile_form_details as $input_element) {
			$edit_skills_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */
		//print_r($edit_skills_details_to_save);
		
		$skill_matrix_to_edit=new stdClass();
		
		$skill_matrix_page=wire('pages')->get("name=skill-matrix");
		
	
	    if($edit_skills_details_to_save['skill_type'] == 'old_skills_matrix'){
	        $skill_matrix_to_edit= json_decode($skill_matrix_page->old_skills_matrix);
	      
	        //print_r($skill_matrix_to_edit);
	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'soft_skills_matrix'){
	        $skill_matrix_to_edit= json_decode($skill_matrix_page->soft_skills_matrix);
	      
	        //print_r($skill_matrix_to_edit);
	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'technical_skills_matrix'){
	        $skill_matrix_to_edit= json_decode($skill_matrix_page->technical_skills_matrix);
	      
	        //print_r($skill_matrix_to_edit);
	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'non_technical_skills_matrix'){
	        $skill_matrix_to_edit= json_decode($skill_matrix_page->non_technical_skills_matrix);
	      
	        //print_r($skill_matrix_to_edit);
	    }
	    
	    $loop_counter=0;
	    $new_skill_title=$edit_skills_details_to_save['skill_title'];
	    $new_skill_synonyms=array_map('trim', array_filter(explode(",",$edit_skills_details_to_save['skill_synonym'])));
	    foreach($skill_matrix_to_edit as $skill_title=>$skill_details){
	       
	        
	        if($loop_counter == $edit_skills_details_to_save['id'] ){
	            if($skill_title!=$new_skill_title){
	                $skill_matrix_to_edit->$new_skill_title= $skill_matrix_to_edit->$skill_title;
    	            //print_r($skill_matrix_to_edit->$new_skill_title);
    	            unset($skill_matrix_to_edit->$skill_title);
	            }
	            
	             $skill_matrix_to_edit->$new_skill_title->synonyms=array();
	            $skill_matrix_to_edit->$new_skill_title->synonyms=$new_skill_synonyms;
	            //print_r($skill_matrix_to_edit->$new_skill_title);
	           break;
	        }
	         $loop_counter++;
	    }
	    
	    if($edit_skills_details_to_save['skill_type'] == 'old_skills_matrix'){
	        $skill_matrix_page->old_skills_matrix=json_encode($skill_matrix_to_edit);

	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'soft_skills_matrix'){
	        $skill_matrix_page->soft_skills_matrix=json_encode($skill_matrix_to_edit);

	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'technical_skills_matrix'){
	        $skill_matrix_page->technical_skills_matrix=json_encode($skill_matrix_to_edit);

	    }
	    elseif($edit_skills_details_to_save['skill_type'] == 'non_technical_skills_matrix'){
	        $skill_matrix_page->non_technical_skills_matrix=json_encode($skill_matrix_to_edit);

	    }
          
          $skill_matrix_page->of(false);
	       $skill_matrix_page->save();   
            
		/* Get the event page to edit based on the ID */
// 		$skills_page_to_change = wire('pages')->get($edit_skills_details_to_save['id']);
// 		$skills_page_to_change->of(false);

// 		 $skill_matrix_page= wire('pages')->get("name=skill-matrix");
	  
//         	  //print_r($company_page);
//         	  $skill_matrix=new stdClass();
//         	  //$sub_users->sub_users=array();
//         	  if($skill_matrix_page->old_skills_matrix!=""){
//         	      $skills_matrix=json_decode($skill_matrix_page->old_skills_matrix);
//         	  }
        	  
        	//   if(isset($sub_users->$email)){
        	//       //alert(".$sub_users->$email. is already registered.");
        	//     }
        	//     else{
        	//       $sub_users->$email=new stdClass();
        	//       $sub_users->$email->registration_status="unregistered";
        	//       $sub_users->$email->enabled_status="enabled";
        	//       $sub_users->$email->verification_status="verified";
        	//     }

		/* Save the data */
// 		$skills_page_to_change->key = $edit_skills_details_to_save['skill_title'];
// 		$skills_page_to_change->number_of_candidates = $edit_skills_details_to_save['skill_candidates'];
// 		$skills_page_to_change->synonyms = $edit_skills_details_to_save['skill_synonym'];
		
		/* Save page */
		//$skill_matrix_to_edit->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Modified Skill Successfully. ";
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
		$new_event_page = wire(new Page());
		$new_event_page->template = wire('templates')->get("event-page");
		$new_event_page->parent = wire('pages')->get("name=workshops");

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

		/* Set automatic Event Code */
		/* Get last added event */
		$latest_page = wire('pages')->get("name=workshops")->child("sort=-created");

		/* Get the event code from the latest event, extract the number from it, add one to it. Combine this number with EV- prefix and save */
		$latest_event_code = (int)substr($latest_page->event_code,3);
		$new_event_page->event_code = "EV-".($latest_event_code + 1);
		/* Set automatic Event Code End */

		


		/* Save page */
		$new_event_page->of(false);
		$new_event_page->save();


		/* Return data */
		$to_return->success->success_status = true;
		$to_return->success->success_message = "New event created with the name ".$new_event_page->title = $new_event_details_to_save['event_title'];
		end_and_return();
	}
	/* Function to create a new event based on given data in POST END*/










