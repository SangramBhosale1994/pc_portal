<?php
 include(\ProcessWire\wire('files')->compile('includes/send_mail.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
// 	//Tell the browser to redirect to the HTTPS URL.
// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 	//Prevent the rest of the script from executing.
// 	exit;
// }
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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_manage_subusers_request_table_data", "unlock_profiles","disable_profiles","add_subuser"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_manage_subusers_request_table_data":
			fetch_manage_subusers_request_table_data();
			end_and_return();
		break;

		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_universal_company_profile_to_unlock = $input->post("requested_universal_company_profile_to_unlock", "text", false);
			//echo $requested_universal_company_profile_to_unlock;

			if(!$requested_universal_company_profile_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_universal_company_profile_to_unlock);
			end_and_return();
		break;
		
		case 'disable_profiles':
			/* Save the data sent from the form */
			$requested_sub_user_profile_to_disable = $input->post("requested_sub_user_profile_to_disable", "text", false);
			//echo $requested_sub_user_profile_to_disable;

			if(!$requested_sub_user_profile_to_disable){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			disable_profiles($requested_sub_user_profile_to_disable);
			end_and_return();
		break;
		
		case 'add_subuser':
			/* Save the data sent from the form */
			$add_subuser_form_details = $input->post("add_subuser_form_details", "string", false);

			if(!$add_subuser_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			add_subuser($add_subuser_form_details);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	function fetch_manage_subusers_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$sub_user_data_array = Array();
		$company_name = \ProcessWire\wire('session')->company_name;
		
		$company_page=\ProcessWire\wire('pages')->get("name=universal-companies")->child("title=".$company_name);
		$sub_users_object=new stdClass();
		
		if($company_page->sub_users != ""){
		    $sub_users_object=json_decode($company_page->sub_users);
		}
	    
		
		$loop_counter=0;

		/* Loop through all the Editor profile pages */
		foreach($sub_users_object as $sub_user_email=>$sub_user) {
		     $loop_counter++;
		    
		  //if($universal_profile_page->user_type == "company_subuser" && $universal_profile_page->company_name == $company_name){
			/* Each candidate's data is to be saved in a seperate object */
			$sub_user_data = new stdClass();

			/* Create array if favourites are empty */
// 			if($sub_user->verified == ""){
// 				$sub_user->verified == "unverified";
// 			}

			$sub_user_data->id = $loop_counter;
			$sub_user_data->email = $sub_user_email;
			$sub_user_data->verification_status = $sub_user->verification_status;
			$sub_user_data->registration_status = $sub_user->registration_status;
			$sub_user_data->enabled_status = $sub_user->enabled_status;
			
			
			// $company_data->company_open_participation = $company_page->company_open_participation;

			// $company_data->submission_confirmation = $company_page->submission_confirmation;

			// if($company_data->submission_confirmation == ""){
			// 	$company_data->submission_confirmation = "-";
			// }else{
			// 	$company_data->submission_confirmation = "<strong class='[ text-danger ]'>". $company_data->submission_confirmation ."</strong>";
			// }

			/* Other column data in the table */
			
			    if($sub_user_data->enabled_status == 'enabled'){
			        $sub_user_data->enable = "<button id='".$loop_counter."_disable_button' class='[ btn btn-danger ]( disable_button )' type='button'><i class='[ mr-2 ][ fas fa-ban ]'></i>Stop access</button>";
			        
			        
			       
			    }
			    else{
			         $sub_user_data->enable = "<button id='".$loop_counter."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Give access</button>";
			    }
				 
	//	$sub_user_data->unlock_button = "<button id='".$loop_counter->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";

// 			/* Show button to mark the survey */
// 			$company_data->marking_button = "<a target='_blank' href='".\ProcessWire\wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

 			/* If nothing to be unlocked, hide button */
// 			if($sub_user_data->user_enable_status== "enable"){
// 				$company_data->unlock_button = "-";
// 			}

			/* Save the editor data object into the main array of all the editor data */
			array_push($sub_user_data_array, $sub_user_data);
		//}
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $sub_user_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
		
			["title"=>"Id", "data"=>"id"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Registration Status", "data"=>"registration_status"],
			["title"=>"Enable", "data"=>"enable"],
			//["title"=>"Disable", "data"=>"disable"],
		
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
		//echo $requested_universal_company_profile_to_unlock;
		$sub_user_data_array = Array();
		$company_name = \ProcessWire\wire('session')->company_name;
		
		$company_page=\ProcessWire\wire('pages')->get("name=universal-companies")->child("title=".$company_name);
		$sub_users_object=new stdClass();
		
		if($company_page->sub_users != ""){
		    $sub_users_object=json_decode($company_page->sub_users);
		    //print_r($sub_users_object);
		}
		
			$enable_counter=0;
			$loop_counter=0;
			$enable_counter++;
			foreach($sub_users_object as $sub_user_email=>$sub_user) {
		   
		        if($sub_users_object->$sub_user_email->enabled_status == 'enabled'){
		            $enable_counter++;
		        }
		     
		    }
           // echo $enable_counter;
            if($enable_counter <= 5)
            {
                
		        foreach($sub_users_object as $sub_user_email=>$sub_user) {
    		        $loop_counter++;
    		        if($requested_universal_company_profile_to_unlock == $loop_counter){
		        
                    $sub_users_object->$sub_user_email->enabled_status="enabled";
        		   
    		        }
                }
            }
            else{
                 $to_return->error->number_of_errors++;
	              $to_return->error->error_message = "Maximum 5 users can be enabled";
	              end_and_return();
            }
		/* Loop through all the Editor profile pages */
		
	     $company_page->sub_users=json_encode($sub_users_object);
		//$company_page = \ProcessWire\wire("pages")->get("name=universal-companies")->child("id=".$requested_universal_company_profile_to_unlock);
		//print_r($company_page);
		$company_page->of(false);

		/* If editor not found, return */
		if($company_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$company_page->verification = "verified";



		/* save the page */
		//	$company_page->$sub_user_data->save();
		$company_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profile has been enabled.";


		/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
		$email_headers  = 'MIME-Version: 1.0' . "\r\n";
		$email_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Create email headers
		$email_headers .= "From: workplaceequalityindex.in <noreply@workplaceequalityindex.in>\r\n".
		'X-Mailer: PHP/' . phpversion();

		$email_subject = "IWEI: Registration Confirmation";


		$email_message = '<html><body>';

		$email_message .= '<p>';
		$email_message .= 'Thank you for registering for <a href="https://workplaceequalityindex.in/">India Workplace Equality Index</a>.';

		$email_message .='<br>';
		$email_message .='Your account is <strong>activated</strong>.';

		$email_message .='<br><br>';
		$email_message .='Please access the <strong>IWEI survey</strong> here: <a href="https://survey.workplaceequalityindex.in/company-login/">https://survey.workplaceequalityindex.in/company-login/</a>';

		$email_message .='<br>';
		$email_message .='Login using the email id &amp; password used for registering.';

		$email_message .='<br><br><br>';
		$email_message .='Please feel free to write to <a href="mailto:nikita@thepridecircle.com">nikita@thepridecircle.com</a> if you need any assistance.';

		$email_message .='<br>';
		$email_message .='The deadline to submit your entry is 15 Oct 2020.';

		$email_message .='<br>';
		$email_message .='Resources: <a href="https://workplaceequalityindex.in/wp-content/uploads/2020/09/IWEI-2020-FAQ.pdf">FAQ</a>';
		
		$email_message .='<br><br><br>';
		$email_message .='Thank You';


		$email_message .= '</body></html>';

		try {
			//mail($company_page->email, $email_subject, $email_message, $email_headers);
		} catch (Exception $e) {
$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
	
	/* Function to Disable editor's favourite based on given editor IDs */
	function disable_profiles($requested_sub_user_profile_to_disable){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		//echo $requested_sub_user_profile_to_disable;
		$sub_user_data_array = Array();
		$company_name = \ProcessWire\wire('session')->company_name;
		
		$company_page=\ProcessWire\wire('pages')->get("name=universal-companies")->child("title=".$company_name);
		$sub_users_object=new stdClass();
		
		if($company_page->sub_users != ""){
		    $sub_users_object=json_decode($company_page->sub_users);
		    //print_r($sub_users_object);
		}
			$loop_counter=0;

		/* Loop through all the Editor profile pages */
		foreach($sub_users_object as $sub_user_email=>$sub_user) {
		    $loop_counter++;
		    if($requested_sub_user_profile_to_disable == $loop_counter){
		        
		      //   if($sub_users_object->$sub_user_email->enabled_status == 'enabled'){
		      //// && count(get_object_vars($sub_users_object)) == 5
		      
        // 	      $to_return->error->number_of_errors++;
	       //       $to_return->error->error_message = "Maximum 5 subusers can be enabled";
	       //       	end_and_return();
        // 	  }
        	 // else{
		        $sub_users_object->$sub_user_email->enabled_status="disabled";
        	  //}
		    }
		     
		}
	     $company_page->sub_users=json_encode($sub_users_object);
		//$company_page = \ProcessWire\wire("pages")->get("name=universal-companies")->child("id=".$requested_universal_company_profile_to_unlock);
		//print_r($company_page);
		$company_page->of(false);

		/* If editor not found, return */
		if($company_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$company_page->verification = "verified";



		/* save the page */
		//	$company_page->$sub_user_data->save();
		$company_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profile has been disabled.";


		/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
		$email_headers  = 'MIME-Version: 1.0' . "\r\n";
		$email_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Create email headers
		$email_headers .= "From: workplaceequalityindex.in <noreply@workplaceequalityindex.in>\r\n".
		'X-Mailer: PHP/' . phpversion();

		$email_subject = "IWEI: Registration Confirmation";


		$email_message = '<html><body>';

		$email_message .= '<p>';
		$email_message .= 'Thank you for registering for <a href="https://workplaceequalityindex.in/">India Workplace Equality Index</a>.';

		$email_message .='<br>';
		$email_message .='Your account is <strong>activated</strong>.';

		$email_message .='<br><br>';
		$email_message .='Please access the <strong>IWEI survey</strong> here: <a href="https://survey.workplaceequalityindex.in/company-login/">https://survey.workplaceequalityindex.in/company-login/</a>';

		$email_message .='<br>';
		$email_message .='Login using the email id &amp; password used for registering.';

		$email_message .='<br><br><br>';
		$email_message .='Please feel free to write to <a href="mailto:nikita@thepridecircle.com">nikita@thepridecircle.com</a> if you need any assistance.';

		$email_message .='<br>';
		$email_message .='The deadline to submit your entry is 15 Oct 2020.';

		$email_message .='<br>';
		$email_message .='Resources: <a href="https://workplaceequalityindex.in/wp-content/uploads/2020/09/IWEI-2020-FAQ.pdf">FAQ</a>';
		
		$email_message .='<br><br><br>';
		$email_message .='Thank You';


		$email_message .= '</body></html>';

		try {
			//mail($company_page->email, $email_subject, $email_message, $email_headers);
		} catch (Exception $e) {
$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
	/* Function to modify the information of an job profile from POST data */
	function add_subuser($add_subuser_form_details){
		/* Access global variable that is to be returned */
		global $to_return;
		 $company_name = \ProcessWire\wire('session')->company_name;
		 //echo $company_name;

		/* Convert json form data into required format */
		$add_subuser_form_details = json_decode($add_subuser_form_details);
    //print_r($add_subuser_form_details);
		/* Array to save data and then to save into the page */
		$edit_job_details_to_save = Array();

		foreach ($add_subuser_form_details as $input_element) {
			$edit_job_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

// 		if($input->post->email){
    		//$name = $sanitizer->text($input->post->name);
    		$email = $edit_job_details_to_save['subuser_email'];
    		
    		 $company_page= \ProcessWire\wire('pages')->get("name=universal-companies")->child('title='.$company_name);
	  
        	  //print_r($company_page);
        	  $sub_users=new stdClass();
        	  //$sub_users->sub_users=array();
        	  if($company_page->sub_users!=""){
        	      $sub_users=json_decode($company_page->sub_users);
        	  }
        	  
        // 	  if(count(get_object_vars($sub_users)) >=5){
        // 	      $to_return->error->number_of_errors++;
	       //       $to_return->error->error_message = "Maximum 5 subusers can be added";
	       //       	end_and_return();
        // 	  }
        // 	   else
        	  if(isset($sub_users->$email)){
        	      //alert(".$sub_users->$email. is already registered.");
        	    }
        	    else{
        	      $sub_users->$email=new stdClass();
        	      $sub_users->$email->registration_status="unregistered";
        	      $sub_users->$email->enabled_status="disabled";
        	      $sub_users->$email->verification_status="verified";
        	    }
                
    		/*** Basic Page Creation Info */
    		$new_profile_page = new \ProcessWire\Page();
    		$new_profile_page->template = \ProcessWire\wire('templates')->get("unregistered_profiles");
    		$new_profile_page->parent = \ProcessWire\wire('pages')->get("name=unregistered-profiles");
    		$new_profile_page->title = $email;
    		/*** Basic Page Creation Info End */
    
        	$new_profile_page->company_name = $company_name;
    		$new_profile_page->email = $email;
    		$new_profile_page->user_status = "unregistered";
    		$new_profile_page->refered_by = \ProcessWire\wire('session')->email;
    		$new_profile_page->user_type = "company_subuser";
    		$new_profile_page->verification = "unverified";
    		//$new_profile_page->user_enable_status = "enable";
    
    		$new_profile_page->of(false);
    		$new_profile_page->save();
    
    
    	//}


	   
	   // foreach(\ProcessWire\wire('session') as $key=>$value){
	   //     //echo $key."-".$value;
	   //     print_r($key);
	   //     print_r($value); 
	   // }
	    //echo  $company_name;
	 
	  
	 // print_r($sub_users);
	  
	 
	  
	  
	  //$sub_users->sub_users[]=$email;
	  $company_page->sub_users=json_encode($sub_users);
	  
	  $company_page->of(false);
      $company_page->save();
    
        //$email = $email;
		
		$otp = mt_rand(100000,999999);
		
		$np = new \ProcessWire\Page();
		$np->template = \ProcessWire\wire('templates')->get("otp_verification");
		$np->parent = \ProcessWire\wire('pages')->get("name=user-registration-with-email");
		$np->title = $otp;
		$np->email = $email;
		$np->otp_status = "live";
		$np->of(false);
		$np->save();
		
		$company_admin=\ProcessWire\wire('pages')->get("name=universal-profiles")->child('company_name='.$company_name);
		$admin_name=$company_admin->title;
		//$a ="http://zerovaega.in/pc_rportal/universe/user-registration-with-email/?otp=$otp&email=$email";
		$a =\ProcessWire\wire('pages')->get("name=user-registration-with-email")->httpUrl."?otp=$otp&email=$email";

        
// 		$subject = "You are invited! Pride Circle Corporate Dashboard";
        $subject ="You are invited to the Pride Circle Universe.";
        
        $message ="Congratulations! You have been invited to access to the Pride Circle Universe by ".$admin_name.".<br><br>This is your ticket to the galaxy of offerings from Pride Circle.<br><br>Get started by logging into the universe by using your registered email ID and create a password.<br>(The link is valid only for 10 minuters) <br><br> <a href='".$a."'><button id='btn_register' style='color: #fff;
         background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";

// 		$message = "Greetings from Pride Circle!\n\nThe OTP for your login is ".$otp;
// // 		$link = "Greetings from Pride Circle!\n\nThe OTP for your login is ".<a href="'.$a.'">".$otp."</a>";
//         $link = "You have been invited by <Admin’s name> to be a part of Pride Circle Corporate Dashboard.<br>Click on the link below to complete your registration.<br><br> <a href='".$a."'><button id='btn_register' style='color: #fff;
//          background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Register Here</button></a><br><br>From,<br>Team Pride Circle";
	
		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		try {
			//mail($email, $subject, $message, $headers);
			send_smtp_mail($email,$message,$subject);
			$is_email_sent=true;
		} catch (Exception $e) {
			$error_message = true;
		}
		

		$to_return->success->success_status = true;
		$to_return->success->success_message = "User added successfully ";
		end_and_return();
	}
	/* Function to modify the information of an job profile from POST data END*/
	
	