<?php
header("Content-Type: application/json; charset=UTF-8");

// include 'includes/send_mail.php';
include 'includes/send_mail_ticketing.php';

// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}
//if(isset($_POST['submit']))
//print_r($_POST);
	/* Specify the page output is in JSON */
	

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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_referral_profiles_request_table_data", "unlock_profiles","add_points","add_points_multiple_profiles"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_referral_profiles_request_table_data":
			fetch_referral_profiles_request_table_data();
			end_and_return();
		break;

		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_referral_profile_to_unlock = $input->post("requested_referral_profile_to_unlock", "text", false);

			if(!$requested_referral_profile_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_referral_profile_to_unlock);
			end_and_return();
		break;
		
		case 'add_points':
			/* Save the data sent from the form */
// 			$requested_referrer_to_edit=new stdClass();
// 			$requested_referrer_to_edit->id=$input->post("modal_referrer_id","string", false);
// 			$requested_referrer_to_edit->point=$input->post("referrer_points","string", false);
// 			$requested_referrer_to_edit->action=$input->post("referrer_action","string", false);
// 			$requested_referrer_to_edit->reason=$input->post("referrer_reason","string", false);
// echo "00000000000000000000000";
// echo $requested_referrer_to_edit->id;
// print_r($requested_referrer_to_edit);
 //echo "===============================";
			$edit_profile_form_details = $input->post("edit_profile_form_details", "text", false);
//print_r($edit_profile_form_details);

			if(!$edit_profile_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			add_points($edit_profile_form_details);
		break;

		case 'add_points_multiple_profiles':
			/* Save the data sent from the form */
			$requested_referral_profile_to_add_points_id = $input->post("requested_referral_profile_to_add_points_id", "textarea", false);
			$requested_referral_form_details = $input->post("requested_referral_form_details", "textarea", false);

			if(!$requested_referral_profile_to_add_points_id){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}

			if(!$requested_referral_form_details){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			add_points_multiple_profiles($requested_referral_profile_to_add_points_id,$requested_referral_form_details);
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
	function fetch_referral_profiles_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$referral_data_array = Array();
		
// 	 $company_admin_profile = 	wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
		$serial_counter=1;
		foreach(wire('pages')->get("name=referral-profiles")->children("sort=-published") as $referral_page) {

			// echo $referral_page->id;
			// echo "-----";
		    
		   // $company_admin_profile = wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title.",user_type=company_admin");
		  //  foreach(wire('pages')->get("name=universal-profiles")->children("company_page_id=".$referral_page->id) as $referral_admin_profile){
		  
		  $referral_admin_profile = wire('pages')->get("name=universal-profiles")->child("referrer_page_id=".$referral_page->id);
			// echo $referral_admin_profile->id;
 
// 		  if($referral_admin_profile->id==0){
// 		      //print_r($referral_admin_profile);
// 		    $referrer_email= $referral_page->referrer_email;
// 		    //echo $referrer_email;
// 		  //   $referral_data->email = $referral_page->referrer_email;
// 		 // $referral_data->email = json_encode($referral_admin_profile);
// 		      $referral_admin_profile = wire('pages')->get("name=universal-profiles")->child("email=".$referrer_email);
// 		      $referral_admin_profile->referrer_page_id=$referral_page->id;
// 		      //$referral_admin_profile->of(false);
// 		      //$referral_admin_profile->save();
		      
// 		     // print_r($referral_admin_profile);
// 		  }
		  //  print_r($company_admin_profile);
		  //  echo "1";
		  //  echo $company_admin_profile;
		  // echo $company_admin_profile->title;
		  //  print_r($company_admin_profile->title);
		  //  echo "2";
		    //}
			/* Each candidate's data is to be saved in a seperate object */
			$referral_data = new stdClass();

			/* Create array if favourites are empty */
			if($referral_page->verified == ""){
				$referral_page->verified == "unverified";
			}

			$referral_data->id = $referral_page->id;
			$referral_data->company_name = $referral_page->title;
			$referral_data->identify_as= $referral_admin_profile->identify_as;
			$referral_data->applicant_name = $referral_admin_profile->title;
			$referral_data->email = $referral_page->referrer_email;
			$referral_data->phone_number = $referral_admin_profile->phone_number;
			// $company_data->designation = $company_page->designation;
			$referral_data->verification = $referral_page->verification;
			$referral_data->registration_time=$referral_page->published +  60*60*5.50;
		
			$referral_data->registration_time=date('d/m/Y h:i A', $referral_data->registration_time);

			$referral_data->serial_number=$serial_counter;
			$serial_counter++;

			if($referral_page->referrer_points==""){
                $referral_page->referrer_points='{"points_details_array":[]}';
            }
      // echo "******";                  
			$points_details_object= json_decode($referral_page->referrer_points);
			// print_r($points_details_object);
            //print_r($referrer_page->referrer_points);
            $points_details_array = $points_details_object->points_details_array;
            
            $total_points=0;
            foreach($points_details_array as $points_details){
                if($points_details->points_increment_decrement=="increment")
                {
                    $total_points+=$points_details->points;
                }
                elseif($points_details->points_increment_decrement=="decrement"){
                    $total_points-=$points_details->points;
                }
            }
             
            $referral_data->Total_points= $total_points; 


			/* Other column data in the table */
			$referral_data->unlock_button = "<button id='".$referral_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";
			
			$referral_data->add = "<button id='".$referral_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit points </button>";
			$referral_data->checkbox = "<input id='".$referral_page->id."_checkbox' class='referrer_checkbox' type='checkbox'>";
			/* Show button to mark the survey */
			//$company_data->marking_button = "<a target='_blank' href='".wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

			/* If nothing to be unlocked, hide button */
			if($referral_page->verification== "verified"){
				$referral_data->unlock_button = "-";
			}

			           /**?
			 * Sameessh@zerovaega 5-march-2021
			 * to check referral admin profile is lgbtq+(register or Notregister) or not
			 */
			if($referral_admin_profile->identify_as!="Ally"){
				$single_referre_email=$referral_page->referrer_email;
				$candidate_emails=wire('pages')->get("name=candidates")->child("email=".$single_referre_email);
					if($candidate_emails->id!=0){
						$referral_data->register_account="Register";
					}else{
						$referral_data->register_account="Not Register";
					}
			}
			else{
				$referral_data->register_account="-";
			}
			/**
			 * sameesh code end here
			 */

			/* Save the editor data object into the main array of all the editor data */
			array_push($referral_data_array, $referral_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $referral_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
// 			["title"=>"Answers", "data"=>"marking_button"],
// 			["title"=>"Verification", "data"=>"unlock_button"],
// 			["title"=>"Comapny Name", "data"=>"company_name"],
			// ["title"=>"Submission Status", "data"=>"submission_confirmation"],
			// ["title"=>"Applicant", "data"=>"applicant_name"],
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Name", "data"=>"applicant_name"],
			["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"Identify As", "data"=>"identify_as"],
			["title"=>"Registration Time", "data"=>"registration_time"],
			["title"=>"Registered CV", "data"=>"register_account"],
			["title"=>"Total points", "data"=>"Total_points"],
			["title"=>"Add points", "data"=>"add"]
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
	function unlock_profiles($requested_referral_profile_to_unlock){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$referrer_page = wire("pages")->get("name=referral-profiles")->child("id=".$requested_referral_profile_to_unlock);
		$referrer_page->of(false);

		/* If editor not found, return */
		if($referrer_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$referrer_page->verification = "verified";



		/* save the page */
		$referrer_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been verified.";


			/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
// 		$subject = "Activate your account: Pride Circle Corporate Dashboard";

		//$url="http://zerovaega.in/pc_rportal/universe/";
		$url =wire("pages")->get("name=universe")->httpUrl;

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
			send_smtp_mail($referrer_page->referrer_email,$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
			$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
		/* Function to modify the information of an event profile from POST data */
	
	/* Function to modify the information of an event profile from POST data END*/
	
		
	/* Function to modify the information of an job profile from POST data */
	function add_points($edit_profile_form_details){
		/* Access  variable that is to be returned */
		global $to_return;
		 //$company_name = wire('session')->company_name;
		 //echo $company_name;
//echo "111referrer";
		/* Convert json form data into required format */
		$edit_profile_form_details = json_decode($edit_profile_form_details);
    //print_r($edit_profile_form_details);
		/* Array to save data and then to save into the page */
		$edit_job_details_to_save = Array();

		foreach($edit_profile_form_details as $input_element) {
			$edit_job_details_to_save[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */

// 		if($input->post->email){
    		//$name = $sanitizer->text($input->post->name);
    	
    
		 $referrer_title = $edit_job_details_to_save['referrer_title'];
    	 $referrer_points = $edit_job_details_to_save['referrer_points'];
    	 $referrer_action= $edit_job_details_to_save['referrer_action'];
    	 $referrer_reason = $edit_job_details_to_save['referrer_reason'];
    	 $modal_referrer_id = $edit_job_details_to_save['modal_referrer_id'];
    	 //echo " ---------------------***********------------";
    	 //echo $modal_referrer_id;
    		
    		//$referral_code=  $sanitizer->int($input->post->referrer_code);
		    
		    //$referrer_page = wire('pages')->get("name=referral-profiles")->child("id=".$edit_profile_form_details);
    	//	 $referral_page= wire('pages')->get("name=referral-profiles")->child('title='.$company_name);
    		 
    		 //$candidate_page_id= wire('pages')->get("name=candidates")->children();
    		 
    		 $referrer_page = wire('pages')->get("name=referral-profiles")->child("id=".$modal_referrer_id);
    		// echo $referrer_page;
	  
	        	    /* object to add to referrer's point details json */
		    $referrer_points_new_entry = new stdClass;
		    $referrer_points_new_entry->timestamp = time() +  60*60*5.50;
		    $referrer_points_new_entry->points = $referrer_points;
            $referrer_points_new_entry->points_increment_decrement = $referrer_action;
		    $referrer_points_new_entry->candidate_page_id = 0;
		    $referrer_points_new_entry->title = $referrer_title;
		  //  $referrer_points_new_entry->message = $referrer_page->preferred_name. " has signed up using your referral just now.";
		  $referrer_points_new_entry->message = $referrer_reason;
		    /* object to add to referrer's point details json END */
//print_r($referrer_points_new_entry);		    
		    /* Get the JSON of points details from the referrer page */
            $referrer_points_json = $referrer_page->referrer_points;
//print_r($referrer_page->referrer_points);   
//echo "++++++++++++++++++++++++++++++++++++++";
            /* If the JSON is empty, create an empty array */
            if($referrer_points_json == ""){
                $referrer_points_json='{"points_details_array":[]}';
            }
//print_r($referrer_points_json);            
//echo "**************************************";
            /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
            $referrer_points_object = json_decode($referrer_points_json);
            $referrer_points_object->points_details_array[] = $referrer_points_new_entry;
            $referrer_page->points_details_array = json_encode($referrer_points_object);
            
	  //$sub_users->sub_users[]=$email;
	     $referrer_page->referrer_points=$referrer_page->points_details_array;
	  
	  $referrer_page->of(false);
      $referrer_page->save();
      
        	$email=$referrer_page->referrer_email;
			//$email="amrutaj.zerovaega@gmail.com";
			$title =$referrer_points_new_entry->title;
            $subject ="Pride Circle TAG : $title";
            $link =wire('pages')->get("name=universe")->httpUrl;
            
        //     $message =$referrer_page->name." has signed up using your link!.<br><a href='".$link."'><button id='btn_register' style='color: #fff;
        //  background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
				 $message="Hello ".$referrer_page->name.",";
				 $message.="<br>";
				 $message.="You have received/lost ".$referrer_points." points in your Pride Circle TAG Account.";
				 $message.="<br>";
				 $message.=$referrer_reason;
				 $message.="<br><br>";
				 $message.="<a href='".$link."'><button id='btn_register' style='color: #fff;background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
 
    	
    // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
    // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    		try {
    		    send_smtp_mail($email,$message,$subject);
    			//mail($email, $subject, $message, $headers);
    			$is_email_sent=true;
    		} catch (Exception $e) {
    			$error_message = true;
    		}
    
        	/* If editor not found, return */
// 		if($referrer_page->id == 0){
// 			$to_return->error->number_of_errors++;
// 			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
// 			return;
// 		}


		$to_return->success->success_status = true;
		$to_return->success->success_message = "Points submitted ";
		end_and_return();
	}

	/* Function to modify the information of an job profile from POST data END*/

	// function add_points_multiple_profiles($add_points_to_multiple_profiles){
		function add_points_multiple_profiles($requested_referral_profile_to_add_points_id,$requested_referral_form_details){
		/* Access  variable that is to be returned */
		global $to_return;
		$add_points_to_multiple_profiles=array();
		/* Convert json form data into required format */
		$add_points_to_multiple_profiles = json_decode($requested_referral_profile_to_add_points_id);
		// print_r($add_points_to_multiple_profiles);
		$referral_points_form_details=json_decode($requested_referral_form_details);
		// echo "***";
		// print_r($referral_points_form_details);
		/* Array to save data and then to save into the page */
		$referral_form_details_to_save = Array();

		foreach($referral_points_form_details as $input_element) {
			$referral_form_details_to_save[$input_element->name] = $input_element->value;
		}
		// print_r($referral_form_details_to_save);

		foreach($add_points_to_multiple_profiles as $single_referral_id){
			$referrer_page = wire('pages')->get("name=referral-profiles")->child("id=".$single_referral_id);
			/* Array to save data and then to save into the page END */
		 	 $referrer_title = $referral_form_details_to_save['referrer_title'];
    	 $referrer_points = $referral_form_details_to_save['referrer_points'];
    	 $referrer_action= $referral_form_details_to_save['referrer_action'];
    	 $referrer_reason = $referral_form_details_to_save['referrer_reason'];
			//  echo "111";
	      /* object to add to referrer's point details json */
		    $referrer_points_new_entry = new stdClass;
		    $referrer_points_new_entry->timestamp = time() +  60*60*5.50;
		    $referrer_points_new_entry->points = $referrer_points;
        $referrer_points_new_entry->points_increment_decrement = $referrer_action;
		    $referrer_points_new_entry->candidate_page_id = 0;
		    $referrer_points_new_entry->title = $referrer_title;
		  //  $referrer_points_new_entry->message = $referrer_page->preferred_name. " has signed up using your referral just now.";
		  	$referrer_points_new_entry->message = $referrer_reason;
			// echo "222";
		    /* object to add to referrer's point details json END */	    
		    /* Get the JSON of points details from the referrer page */
				$referrer_points_json = $referrer_page->referrer_points;
				/* If the JSON is empty, create an empty array */
				if($referrer_points_json == ""){
						$referrer_points_json='{"points_details_array":[]}';
				}
				/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
				$referrer_points_object = json_decode($referrer_points_json);
				$referrer_points_object->points_details_array[] = $referrer_points_new_entry;
				$referrer_page->points_details_array = json_encode($referrer_points_object);
        //  echo $referrer_page->points_details_array;   
	     $referrer_page->referrer_points=$referrer_page->points_details_array;
	  
	  	$referrer_page->of(false);
      $referrer_page->save();
      // echo "333";
        $email=$referrer_page->referrer_email;
				// echo $email;
				//$email="amrutaj.zerovaega@gmail.com";
				$title =$referrer_points_new_entry->title;
				$subject ="Pride Circle TAG : $title";
				$link =wire('pages')->get("name=universe")->httpUrl;
				
				$message="Hello ".$referrer_page->name.",";
				$message.="<br>";
				$message.="You have received/lost ".$referrer_points." points in your Pride Circle TAG Account.";
				$message.="<br>";
				$message.=$referrer_reason;
				$message.="<br><br>";
				$message.="<a href='".$link."'><button id='btn_register' style='color: #fff;background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
         
    		try {
    		  send_smtp_mail($email,$message,$subject);
						// echo "444";
    			//mail($email, $subject, $message, $headers);
    			$is_email_sent=true;
    		} catch (Exception $e) {
    			$error_message = true;
    		}
				// echo "555";
		}
		// echo "666";
		$to_return->success->success_status = true;
		$to_return->success->success_message = "Points submitted ";
		end_and_return();
	}
