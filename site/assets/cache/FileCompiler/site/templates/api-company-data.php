<?php
 include(\ProcessWire\wire('files')->compile('includes/send_mail.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_universal_companies_request_table_data", "unlock_profiles"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_universal_companies_request_table_data":
			fetch_universal_companies_request_table_data();
			end_and_return();
		break;

		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_universal_company_profile_to_unlock = $input->post("requested_universal_company_profile_to_unlock", "text", false);

			if(!$requested_universal_company_profile_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_universal_company_profile_to_unlock);
			end_and_return();
		break;
		
// 		case 'subusers_list':
// 			/* Save the data sent from the form */
// 			$sub_user_modal_form_details = $input->post("sub_user_modal_form_details", "text", false);

// 			if(!$sub_user_modal_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}
// 			subusers_list($sub_user_modal_form_details);
// 			end_and_return();
// 		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	function fetch_universal_companies_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$company_data_array = Array();
		
// 	 $company_admin_profile = 	\ProcessWire\wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
//$universal_profiles_page=\ProcessWire\wire('pages')->get('name=universal-profiles');
        $serial_counter=1;
		foreach(\ProcessWire\wire('pages')->get("name=universal-companies")->children("sort=published") as $company_page) {
			//$company_page_title=$sanitizer->selectorValue($company_page->title);
		    $company_admin_profile = \ProcessWire\wire('pages')->get("name=universal-profiles")->child("company_page_id=".$company_page->id);
		   //$company_admin_profile = \ProcessWire\wire('pages')->get("name=universal-profiles")->child('company_name='.$company_page_title);
		//foreach(\ProcessWire\wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title) as $company_admin_profile){
		    //print_r($company_admin_profile);
		   // echo "1";
		    //echo $company_admin_profile;
		   //echo $company_admin_profile->title;
		    //print_r($company_admin_profile->title);
		   // echo "2";
		   // }
			/* Each candidate's data is to be saved in a seperate object */
			$company_data = new stdClass();

			/* Create array if favourites are empty */
			if($company_page->verified == ""){
				$company_page->verified == "unverified";
			}

			$company_data->id = $company_page->id;
			$company_data->company_name = $company_page->title;
			$company_data->applicant_name = $company_admin_profile->title;
			$company_data->email = $company_page->admin_email;
			$company_data->phone_number = $company_admin_profile->phone_number;
			// $company_data->designation = $company_page->designation;
			$company_data->verification = $company_page->verification;
			$company_data->temp =$company_page->title;
			$company_data->registration_time=$company_page->published +  60*60*5.50;
			$company_data->registration_time=date('d/m/Y h:i A', $company_data->registration_time);
			$company_data->serial_number=$serial_counter;
			$serial_counter++;
// 			$company_data->employee_count = $company_page->employee_count;
// 			$company_data->industry = $company_page->industry;
			// $company_data->company_open_participation = $company_page->company_open_participation;

			// $company_data->submission_confirmation = $company_page->submission_confirmation;

			// if($company_data->submission_confirmation == ""){
			// 	$company_data->submission_confirmation = "-";
			// }else{
			// 	$company_data->submission_confirmation = "<strong class='[ text-danger ]'>". $company_data->submission_confirmation ."</strong>";
			// }

			/* Other column data in the table */
			$company_data->unlock_button = "<button id='".$company_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";
			
			$company_data->sub_user = "<button id='".$company_page->id."_sub_user_button' class='[ btn btn-primary ](  )' type='button' data-toggle='modal' data-target='#subuser_modal_".$company_page->id."' >Users</button>";
		
            
            
            
            $company_data->sub_user.='<div class="modal fade" id="subuser_modal_'.$company_page->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Users List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">';
                  $sub_users_json=$company_page->sub_users;
                    if($sub_users_json=="" || $sub_users_json=="{}"){
                        $company_data->sub_user.="No users added to this company.";
                    }
                    else{
                        //echo $sub_users_json;
                        $sub_users_object=json_decode($sub_users_json);
                        //print_r($sub_users_object);
                              //$to_return->data = $sub_users_array['email'];
                        
                              $loop_counter=1;
                              foreach($sub_users_object as $sub_user_key=>$sub_user_details){
                                  $company_data->sub_user.=$loop_counter.") ".$sub_user_key;
                                  $company_data->sub_user.=" (".$sub_user_details->registration_status.")";
                                  $company_data->sub_user.=" (".$sub_user_details->enabled_status.") <br>";
                                  $loop_counter++;
                              }
                             
                    }
            
                     
           
           $company_data->sub_user.='</div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                  </div>
                </div>
              </div>
            </div>';

			/* Show button to mark the survey */
			//$company_data->marking_button = "<a target='_blank' href='".\ProcessWire\wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

			/* If nothing to be unlocked, hide button */
			if($company_page->verification== "verified"){
				$company_data->unlock_button = "-";
			}

			/* Save the editor data object into the main array of all the editor data */
			array_push($company_data_array, $company_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $company_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
 			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Verification", "data"=>"unlock_button"],
			["title"=>"Comapny Name", "data"=>"company_name"],
			// ["title"=>"Submission Status", "data"=>"submission_confirmation"],
			// ["title"=>"Applicant", "data"=>"applicant_name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Name", "data"=>"applicant_name"],
			["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Registration Time", "data"=>"registration_time"],
			["title"=>"Sub-user", "data"=>"sub_user"]
			// ["title"=>"Designation", "data"=>"designation"],
// 			["title"=>"Industry", "data"=>"industry"],
// 			["title"=>"Employees", "data"=>"employee_count"],
			// ["title"=>"Open Participation", "data"=>"company_open_participation"],
			// ["title"=>"Phone", "data"=>"phone_number"]
		];

		$to_return->success->success_status = true;
		return;
		
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */

	/* Function to unlock editor's favourite based on given editor IDs */
	function unlock_profiles($requested_universal_company_profile_to_unlock){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$company_page = \ProcessWire\wire("pages")->get("name=universal-companies")->child("id=".$requested_universal_company_profile_to_unlock);
		$company_page->of(false);

		/* If editor not found, return */
		if($company_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$company_page->verification = "verified";



		/* save the page */
		$company_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been verified.";


			/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
// 		$subject = "Activate your account: Pride Circle Corporate Dashboard";

		//$url="http://zerovaega.in/pc_rportal/universe/";
		$url =\ProcessWire\wire("pages")->get("name=universe")->httpUrl;

        $subject="Welcome to the Pride Circle Universe- Access granted!";
        
        $message ="Congratulations! Your account has been verified!<br><br>This is your ticket to the galaxy of offerings from Pride Circle. That's not all, you can add up to 5 people from your organisation who would also like to gain access to this unique platform.<br><br>Get started by logging into the universe by using your registered email ID and password.<br><br><a href='".$url."'><button id='btn_login' style='color: #fff;
          background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";

		//$message = "Greetings from Pride Circle!\n\nThank you for signing up for the Corporate Dashboard.\n\nActivate your account by clicking the link here.".$otp;
// 		$link = "Greetings from Pride Circle!\n\nThe OTP for your login is ".<a href="'.$a.'">".$otp."</a>";

        //  $link="http://zerovaega.in/pc_rportal/universal-login/";
        // $subject = "Your Account is Verified! Access Pride Circle Corporate Dashboard";
        // $meassage="Congratulations! Your account has been verified!<br>We are glad to have you on-board!<br><br>You can now log into your account using your registered email ID and password and explore the features of the the Pride Circle Corporate Dashboard.<br><br> <a href='".$link."'><button id='btn_login' style='color: #fff;
        //  background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";
         
        
	
		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		try {
			send_smtp_mail($company_page->admin_email,$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
			$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
		
	/* Function to modify the information of an job profile from POST data */
// 	function subusers_list($sub_user_modal_form_details){
// 		/* Access  variable that is to be returned */
// 		global $to_return;
		
// 			foreach(\ProcessWire\wire('pages')->get("name=universal-companies")->children() as $company_page) {
// 			/* Each candidate's data is to be saved in a seperate object */
// 			$company_data = new stdClass();

		
// 			$company_data->sub_uses =$company_page->sub_uses;
// 			//print_r($company_data->sub_uses);

// 			/* Save the editor data object into the main array of all the editor data */
// 			array_push($company_data_array, $company_data);
// 		}
// 		/* Loop through all the Editor profile pages END */

// 		/* Save the editor data array into the object that is to be sent back */
// 		$to_return->data = $company_data_array;



// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "Points submitted ";
// 		end_and_return();
// 	}
	/* Function to modify the information of an job profile from POST data END*/