<?php
//   print_r($_POST);
//     die;
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");
   
	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();
//print_r($_POST);
    //die;
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
	$requested_action_to_take = $input->post('requested_action_to_take', ["confirm_skills_submit"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		
		case 'confirm_skills_submit':
            /* Save the data sent from the form */
            /**  */
            $skills_array_modal_form_details = json_decode($input->post("skills_array_modal_form_details"));
			$candidate_id = $input->post("candidate_id");
			
			/** if candidate id is not found then display this error */
			if(!$candidate_id){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again1.";
				end_and_return();
			}
			/**call confirm_skills_submit function, in this function pass skills array modal form details and candidate id */
			confirm_skills_submit($skills_array_modal_form_details,$candidate_id);
		break;

	
		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again2.";
			end_and_return();
		break;
	}

	/** create confirm_skills_submit function and pass skills array modal form details and candidate id */
    function confirm_skills_submit($skills_array_modal_form_details,$candidate_id){
		/* Access global variable that is to be returned */
		global $to_return;

		/** get candidate id from pages */
		$page_to_edit = wire('pages')->get("id=$candidate_id"); 
		
		/** array_map('trim') is used for remove prev and next space of word */
		/** and array_filter is used for remove empty word or space in array */
        $existing_technical_skills = array_map('trim', array_filter(explode(",",$page_to_edit->technical_skills)));
        $existing_non_technical_skills = array_map('trim', array_filter(explode(",",$page_to_edit->non_technical_skills)));
        $existing_soft_skills = array_map('trim', array_filter(explode(",",$page_to_edit->soft_skills)));

		/**define new skills array*/
        $new_technical_skills=array();
        $new_non_technical_skills=array();
		$new_soft_skills=array();
		
		/** here foreach loop execute  skills array in modal form */
        foreach($skills_array_modal_form_details as $skills_array)
        {
			/** if skills_array name is available then continue to next */
            if($skills_array->name){

				/** check skills_array name is equal to technial_skills_array */
                if($skills_array->name == "technical_skills_array")
                {
					/** then skills_array value store in new_technical_skills_array */
                    $new_technical_skills[]=$skills_array->value;
				}
				/** check skills_array name is equal to non_technial_skills_array */
				else if($skills_array->name == "non_technical_skills_array")
                {
					/** then skills_array value store in new_non_technical_skills_array */
                    $new_non_technical_skills[]=$skills_array->value;
				}
				/** check skills_array name is equal to soft_skills_array */
                else if($skills_array->name == "soft_skills_array")
                {
					/** then skills_array value store in new_soft_skills_array */
                    $new_soft_skills[]=$skills_array->value;
                }
            }
        }
		
		/** here merge existing skills array and new skills array */
        $technical_skills=array_merge($existing_technical_skills,$new_technical_skills);
        $non_technical_skills=array_merge($existing_non_technical_skills,$new_non_technical_skills);
        $soft_skills=array_merge($existing_soft_skills,$new_soft_skills);

		/** merge array is implode , implode is used for string separated by comma(,) */
        $page_to_edit->technical_skills=implode(", ",$technical_skills);
        $page_to_edit->non_technical_skills=implode(", ",$non_technical_skills);
        $page_to_edit->soft_skills=implode(", ",$soft_skills);

		/** All skills save in each skills section */
        $page_to_edit->of(false);
        $page_to_edit->save();
    
		$to_return->success->success_status = true;
		//$to_return->success->success_message = "Modified event profile with the name ".$candidate_data->id = $candidate_skills_set_save['id'];
		end_and_return();
	}
	/* Function to fetch the data of all events to show in the table */


	






