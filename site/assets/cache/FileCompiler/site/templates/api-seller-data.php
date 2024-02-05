<?php
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

//print_r($_POST);
//die();

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


//$to_return->tempp = $_POST;


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
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_seller_profiles_request_table_data", "unlock_profiles","unverify_profiles","delete_profiles"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_seller_profiles_request_table_data":
			fetch_seller_profiles_request_table_data();
			end_and_return();
		break;

		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_seller_profiles_to_unlock = $input->post("requested_seller_profiles_to_unlock", "text", false);

			if(!$requested_seller_profiles_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_seller_profiles_to_unlock);
			end_and_return();
		break;
		
		case 'unverify_profiles':
			/* Save the data sent from the form */
			//$to_return->tempp2 = true;
			$requested_referral_profile_to_unverify_profiles = $input->post("requested_referral_profile_to_unverify_profiles", "text", false);
			$seller_rejection_reason=$input->post("rejection_reason", "text", false);
			//$seller_rejection_reason=$_POST['rejection_reason'];
			
// 			echo $seller_rejection_reason;
// 			echo "//////////////////////";

			if(!$requested_referral_profile_to_unverify_profiles){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unverify_profiles($requested_referral_profile_to_unverify_profiles,$seller_rejection_reason);
			end_and_return();
		break;
		
		case 'delete_profiles':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_profiles($requested_profiles_to_delete_json);
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	function fetch_seller_profiles_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Array to save all the data of all the editors into */
		$seller_data_array = Array();
		
// 	 $company_admin_profile = 	\ProcessWire\wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title);
// 	 print_r($company_admin_profile);
		/* Loop through all the Editor profile pages */
		$serial_counter=1;
		foreach(\ProcessWire\wire('pages')->get("name=seller-profiles")->children("sort=published") as $seller_page) {
		    
		   // $company_admin_profile = \ProcessWire\wire('pages')->get("name=universal-profiles")->children("company_name=".$company_page->title.",user_type=company_admin");
		  //  foreach(\ProcessWire\wire('pages')->get("name=universal-profiles")->children("id=".$seller_page->seller_profile_id) as $seller_admin_profile){
		    $seller_admin_profile= \ProcessWire\wire('pages')->get("name=universal-profiles")->child("id=".$seller_page->seller_profile_id);   
		  //  print_r($company_admin_profile);
		  //  echo "1";
		  //  echo $company_admin_profile;
		  // echo $company_admin_profile->title;
		  //  print_r($company_admin_profile->title);
		  //  echo "2";
		    //}
			/* Each candidate's data is to be saved in a seperate object */
			$seller_data = new stdClass();

			/* Create array if favourites are empty */
			if($seller_page->verified == ""){
				$seller_page->verified == "unverified";
			}
//echo "11";
			$seller_data->id = $seller_page->id;
			$seller_data->company_name = $seller_page->title;
			$seller_data->applicant_name = $seller_admin_profile->title;
			$seller_data->email = $seller_page->seller_email;
			$seller_data->password = $seller_admin_profile->password;
			$seller_data->phone_number = $seller_admin_profile->phone_number;
			$seller_data->privacy_policy_acceptance = $seller_admin_profile->privacy_policy_acceptance;
			$seller_data->pan_number = $seller_page->pan_number;
//echo $seller_page->pan_number;
			$seller_data->gst_number = $seller_page->gst_number;
			$seller_data->bank_account_number = $seller_page->bank_account_number;
			$seller_data->bank_name = $seller_page->bank_name;
			$seller_data->bank_branch_name = $seller_page->bank_branch_name;
			$seller_data->account_type = $seller_page->account_type;
			$seller_data->bank_account_holder_name = $seller_page->bank_account_holder_name;
			$seller_data->bank_ifsc_code = $seller_page->bank_ifsc_code;
			$seller_data->address = $seller_page->address;
			// $seller_data->designation = $company_page->designation;
			$seller_data->verification = $seller_page->verification;
			$seller_data->registration_time=$seller_page->published +  60*60*5.50;
		
		    $seller_data->registration_time=date('d/m/Y h:i A', $seller_data->registration_time);
		    
		    $seller_data->serial_number=$serial_counter;
			$serial_counter++;
		    
		  //  $seller_data->document_first = $company_page->document_first->httpUrl;
		  //  $seller_data->document_second = $company_page->document_second->httpUrl;
		  //  $seller_data->document_third = $company_page->document_third->httpUrl;
		  //  $seller_data->document_fourth = $company_page->document_fourth->httpUrl;
		  //  if(count($seller_page->document_first)){
		  //      $seller_data->document_first = "<a href='".$seller_page->document_first->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		  //  }
		  //  else{
		  //      $seller_data->document_first="-";
		  //  }
		    
		  
		    
		    if(count($seller_page->document_second)){
		        $seller_data->document_second = "<a href='".$seller_page->document_second->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		    }
		    else{
		        $seller_data->document_second="-";
		    }
		    
		    if(count($seller_page->document_third)){
		        $seller_data->document_third = "<a href='".$seller_page->document_third->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		    }
		    else{
		        $seller_data->document_third="-";
		    }
		
		    if(count($seller_page->document_fourth)){
		        $seller_data->document_fourth = "<a href='".$seller_page->document_fourth->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		    }
		    else{
		        $seller_data->document_fourth="-";
		    }
		    
		    if(count($seller_page->document_fifth)){
		        $seller_data->document_fifth = "<a href='".$seller_page->document_fifth->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		    }
		    else{
		        $seller_data->document_fifth="-";
		    }
		    
		    if(count($seller_page->document_sixth)){
		        $seller_data->document_sixth = "<a href='".$seller_page->document_sixth->first()->httpUrl."' class='[ btn btn-outline-primary ]' type='button'>Download</a>";
		    }
		    else{
		        $seller_data->document_sixth="-";
		    }
// 		date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
//         echo date('d-m-Y H:i:s');
// 			date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
//$seller_data->registration_time=new DateTime($seller_data->registration_time,$gmtTimezone);
//echo date('d-m-Y H:i:s');
			//echo $seller_data->registration_time;
// 			$seller_data->employee_count = $company_page->employee_count;
// 			$seller_data->industry = $company_page->industry;
			// $seller_data->company_open_participation = $company_page->company_open_participation;

			// $seller_data->submission_confirmation = $company_page->submission_confirmation;

			// if($seller_data->submission_confirmation == ""){
			// 	$seller_data->submission_confirmation = "-";
			// }else{
			// 	$seller_data->submission_confirmation = "<strong class='[ text-danger ]'>". $seller_data->submission_confirmation ."</strong>";
			// }

			/* Other column data in the table */
// 			$seller_data->unlock_button = "<button id='".$company_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";
			
			       $seller_data->checkbox = "<input id='".$seller_page->id."_checkbox' class='job_checkbox' type='checkbox'>";
			        $seller_data->unlock_button = "<button id='".$seller_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button )' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";
			        
			     //   $seller_data->unverify_button = "<button id='".$seller_page->id."_unverify_comment_modal' class='[ btn btn-outline-danger ]( unverify_comment_modal )' type='button'  ><i class='[ mr-2 ][ fas fa-ban ]'></i>Unverify</button>";
			        
		        		  $seller_data->unverify_button = "<button id='".$seller_page->id."_unverify_button' class='[ btn btn-outline-danger ](  )' type='button' data-toggle='modal' data-target='#subuser_modal_".$seller_page->id."' ><i class='[ mr-2 ][ fas fa-ban ]'></i>Unverify</button>";
				    
				    // $seller_data->unverify_button = "<button id='".$seller_page->id."_unverify_comment_modal' class='[ btn btn-outline-danger ]( unverify_comment_modal )' type='button'  ><i class='[ mr-2 ][ fas fa-ban ]'></i>Unverify</button>";
				 
    				 $seller_data->unverify_button.='<div class="modal fade" id="subuser_modal_'.$seller_page->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="[ needs-validation ] unverify_modal_form" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                      
                        <div class="[ my-5 ][ form-group ]">
            			    <label for="rejection_reason">Add Comment</label>
            				<textarea class="form-control" rows="5" name="rejection_reason" id="rejection_reason_'.$seller_page->id.'"></textarea>
            
            			</div>';
                         
               
                    $seller_data->unverify_button.='</div>
                      <div class="modal-footer">
                        <button type="button" id="'.$seller_page->id.'_unverify_button" class="[ btn btn-secondary ] ( unverify_button )" value="'.$seller_page->id.'" data-dismiss="modal">Unverify</button>
                      
                      </div>
                    </div>
                    </form>
                    
                  </div>
                </div>';
			  
			  	 

			/* Show button to mark the survey */
			//$seller_data->marking_button = "<a target='_blank' href='".\ProcessWire\wire('pages')->get("name=admin-marking")->httpUrl."?page_to_score=".$company_page->id."' id='".$company_page->id."_marking_button' class='[ btn btn-primary ]( marking_button )' type='button'><i class='[ mr-2 ][ fas fa-check ]'></i>Show</a>";

			/* If nothing to be unlocked, hide button */
			if($seller_page->verification== "verified"){
				$seller_data->unlock_button = "-";
				//echo "unverified";
				//  $seller_data->unlock_button = "<button id='".$seller_page->id."_unverify_button' class='[ btn btn-outline-danger ]( unverify_button )' type='button'><i class='[ mr-2 ][ fas fa-ban ]'></i>Unverify</button>";
			
			}
			
	

		if($seller_page->seller_rejection_reason!=""){
		    		$seller_data->rejection_status = "<button id='".$seller_page->id."_rejection_status_button' class='[ btn btn-outline-success ](  )' type='button' data-toggle='modal' data-target='#rejection_status_modal_".$seller_page->id."' >Status</button>";
			
			$seller_data->rejection_status.='<div class="modal fade" id="rejection_status_modal_'.$seller_page->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">';
                  $seller_rejection_reason_json=$seller_page->seller_rejection_reason;
                    if($seller_rejection_reason_json=="" || $seller_rejection_reason_json=="{}"){
                        $seller_data->rejection_status.="No comment send to this seller.";
                    }
                    else{
                        //echo $seller_rejection_reason_json;
                        $seller_rejection_reason_object=json_decode($seller_rejection_reason_json);
                       // echo "*********************************";
                       // print_r($seller_rejection_reason_object);
                         //echo "////////////////////////////////////";
                              //$to_return->data = $sub_users_array['email'];
                              $loop_counter=1;
                             foreach($seller_rejection_reason_object->seller_rejection_reason_array as $seller_rejection_reason_message){
                                 //print_r($seller_rejection_reason_message);
                                 
                                  $seller_data->rejection_status.=$loop_counter.") ";
                                  $time=date('d/m/Y h:i A',$seller_rejection_reason_message->timestamp);
                                  $seller_data->rejection_status.=" (".$time.")";
                                  
                                  $seller_data->rejection_status.=" (".$seller_rejection_reason_message->reason.") <br>";
                                  $loop_counter++;
                                 
                             } 
                              
                              
                              
                              
                        
                              
                            //   foreach($seller_rejection_reason_object as $seller_rejection_reason_key=>$seller_rejection_reason_details){
                            //       echo $seller_rejection_reason_key;
                            //       echo "------------------------";
                            //       echo $seller_rejection_reason_details;
                            //       $seller_data->rejection_status.=$loop_counter.") ".$seller_rejection_reason_key;
                            //       $seller_data->rejection_status.=" (".$seller_rejection_reason_details->timestamp.")";
                            //       $seller_data->rejection_status.=" (".$seller_rejection_reason_details->reason.") <br>";
                            //       $loop_counter++;
                            //   }
                             
                    }
            
                     
           
           $seller_data->rejection_status.='</div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                  </div>
                </div>
              </div>
            </div>';
		}
		else{
		    $seller_data->rejection_status="-";
		}
            
	

			/* Save the editor data object into the main array of all the editor data */
			array_push($seller_data_array, $seller_data);
		}
		/* Loop through all the Editor profile pages END */

		/* Save the editor data array into the object that is to be sent back */
		$to_return->data = $seller_data_array;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
 			["title"=>"", "data"=>"checkbox"],
			["title"=>"Verification", "data"=>"unlock_button"],
			["title"=>"Verification", "data"=>"unverify_button"],
			["title"=>"Unverify status", "data"=>"rejection_status"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Shop Name", "data"=>"company_name"],
			
		    ["title"=>"Vendor Agreement", "data"=>"privacy_policy_acceptance"],
			// ["title"=>"Applicant", "data"=>"applicant_name"],
			["title"=>"Email", "data"=>"email"],
			["title"=>"Password", "data"=>"password"],
			["title"=>"Name", "data"=>"applicant_name"],
			["title"=>"Phone Number", "data"=>"phone_number"],
			["title"=>"PAN Number Of Shop", "data"=>"pan_number"],
			["title"=>"GST Number Of Shop", "data"=>"gst_number"],
			["title"=>"Registered Address", "data"=>"address"],
			["title"=>"Bank Account Number", "data"=>"bank_account_number"],
			["title"=>"Bank Account Holder Name", "data"=>"bank_account_holder_name"],
			["title"=>"Bank IFSC Code", "data"=>"bank_ifsc_code"],
			["title"=>"Account Type", "data"=>"account_type"],
			["title"=>"Bank Name", "data"=>"bank_name"],
			["title"=>"Bank Branch Name", "data"=>"bank_branch_name"],
			["title"=>"Registration Time", "data"=>"registration_time"],
			//["title"=>"Legal Agreement with Pride Circle", "data"=>"document_first"],
			["title"=>"Onboarding form", "data"=>"document_second"],
			["title"=>"PAN", "data"=>"document_third"],
			["title"=>"GST", "data"=>"document_fourth"],
			["title"=>"PAN of the Director/s", "data"=>"document_fifth"],
			["title"=>"Cancelled cheque", "data"=>"document_sixth"]
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

	/* Function to unverify editor's favourite based on given editor IDs */
	function unlock_profiles($requested_seller_profiles_to_unlock){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$company_page = \ProcessWire\wire("pages")->get("name=seller-profiles")->child("id=".$requested_seller_profiles_to_unlock);
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
		
		$subject="Congratulations, your Pride Circle Seller account is now verified.";
        
        $message ="Welcome Onboard!<br><br>You would receive the credentials and the portal link for listing in a separate email within 24 to 48 hours.Request you to then login and start listing your products.<br><br>From,<br> Pride Circle Team";

        // $subject="Pride Circle Seller Panel- Submission approval!";
        
        // $message ="Congratulations! Your submission has been approved!<br><br>Your account will be created on the Pride Circle Marketplace soon!<br><br>You will receive your login credentials on this email once your account is created.<br><br>From,<br>Team Pride Circle";

		//$message = "Greetings from Pride Circle!\n\nThank you for signing up for the Corporate Dashboard.\n\nActivate your account by clicking the link here.".$otp;
// 		$link = "Greetings from Pride Circle!\n\nThe OTP for your login is ".<a href="'.$a.'">".$otp."</a>";

        //  $link="http://zerovaega.in/pc_rportal/universal-login/";
        // $subject = "Your Account is Verified! Access Pride Circle Corporate Dashboard";
        // $meassage="Congratulations! Your account has been verified!<br>We are glad to have you on-board!<br><br>You can now log into your account using your registered email ID and password and explore the features of the the Pride Circle Corporate Dashboard.<br><br> <a href='".$link."'><button id='btn_login' style='color: #fff;
        //  background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";
         
        
	
		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		try {
			send_smtp_mail($company_page->seller_email,$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
			$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
		/* Function to unlock editor's favourite based on given editor IDs */
	function unverify_profiles($requested_referral_profile_to_unverify_profiles,$seller_rejection_reason){
		/* Access global variable that is to be returned */
		global $to_return;

        //$to_return->tempp3 = $seller_rejection_reason;
		/* Get the page of the editor */
		$seller_page = \ProcessWire\wire("pages")->get("name=seller-profiles")->child("id=".$requested_referral_profile_to_unverify_profiles);
		//$to_return->tempp4 = $seller_page->seller_email;
		$seller_page->of(false);
//echo "1";

		/* If editor not found, return */
		if($seller_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}
//echo "2";
        //$seller_rejection_reason=\ProcessWire\wire('input')->post->text('rejection_reason');
        
        // echo "*******************";
        // echo $seller_rejection_reason;
		$seller_page->verification = "unverified";
		//$seller_page->seller_rejection_reason=$seller_rejection_reason;
		
		 $seller_rejection_reason_data = new stdClass;
// 		 foreach($seller_rejection_reason_data as $rejection_reason_key=>$rejection_reason_value){
// 		     $seller_rejection_reason_data->$rejection_reason_key->timestamp=time() +  60*60*5.50;
// 		     $seller_rejection_reason_data->$rejection_reason_key->reason=$seller_rejection_reason;
// 		 }
		 
// 		 print_r($seller_rejection_reason_data);
// 		 echo "====================================";
		 
		 
		 
		 
		    $seller_rejection_reason_data->timestamp = time() +  60*60*5.50;
		    $seller_rejection_reason_data->reason = $seller_rejection_reason;
		    
		     //$to_return->tempp5 = $seller_rejection_reason_data;
		    /* Get the JSON of points details from the referrer page */
            $seller_rejection_reason_json = $seller_page->seller_rejection_reason;
// print_r($seller_page->seller_rejection_reason);   
// echo "++++++++++++++++++++++++++++++++++++++";
// print_r($seller_rejection_reason_data);
// echo "---------------------------------------";
            /* If the JSON is empty, create an empty array */
            if($seller_rejection_reason_json == ""){
                $seller_rejection_reason_json='{"seller_rejection_reason_array":[]}';
            }
// print_r($seller_rejection_reason_json);            
// echo "**************************************";
            /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
            $seller_rejection_reason_object = json_decode($seller_rejection_reason_json);
            $seller_rejection_reason_object->seller_rejection_reason_array[] = $seller_rejection_reason_data;
            $seller_page->seller_rejection_reason_array = json_encode($seller_rejection_reason_object);
            
	  //$sub_users->sub_users[]=$email;
	     $seller_page->seller_rejection_reason=$seller_page->seller_rejection_reason_array;
	  
// 	  $referrer_page->of(false);
//       $referrer_page->save();


//echo "3";
		/* save the page */
		$seller_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been unverified.";

//echo "4";
			/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
// 		$subject = "Activate your account: Pride Circle Corporate Dashboard";

		//$url="http://zerovaega.in/pc_rportal/universe/";
		$url =\ProcessWire\wire("pages")->get("name=universe")->httpUrl;
		
			$seller_profile_page = \ProcessWire\wire("pages")->get("name=universal-profiles")->child("seller_page_id=".$seller_page->id);
		
		 $subject="Important, your Pride Circle Seller account is pending.";
        
        $message ="Dear ".$seller_profile_page->title.",<br> We were unable to verify your account due to the below-mentioned reasons. <br><br>Reason for unapproval:<br>".$seller_rejection_reason."<br><br>Please login to your seller account and resubmit with the changes.<br><a href='".$url."'><button id='btn_login' style='color: #fff;
          background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Pride Circle Team";
        

        // $subject="Pride Circle Seller Panel- Submission unapproval!";
        
        // $message ="Your submission has been unapproved!<br><br>Reason for unapproval:<br>".$seller_rejection_reason."<br><br>Please log-in to your account here:-<br><br><a href='".$url."'><button id='btn_login' style='color: #fff;
        //   background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";

		//$message = "Greetings from Pride Circle!\n\nThank you for signing up for the Corporate Dashboard.\n\nActivate your account by clicking the link here.".$otp;
// 		$link = "Greetings from Pride Circle!\n\nThe OTP for your login is ".<a href="'.$a.'">".$otp."</a>";

        //  $link="http://zerovaega.in/pc_rportal/universal-login/";
        // $subject = "Your Account is Verified! Access Pride Circle Corporate Dashboard";
        // $meassage="Congratulations! Your account has been verified!<br>We are glad to have you on-board!<br><br>You can now log into your account using your registered email ID and password and explore the features of the the Pride Circle Corporate Dashboard.<br><br> <a href='".$link."'><button id='btn_login' style='color: #fff;
        //  background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";
         
        
	
		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		try {
			send_smtp_mail($seller_page->seller_email,$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
			$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */

		return;
	}
	/* Function to unverify editor's favourite based on given editor IDs END */
	
		/* Function to delete job accounts based on given IDs */
	function delete_profiles($requested_profiles_to_delete_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_delete = json_decode($requested_profiles_to_delete_json);
//print_r($requested_profiles_to_delete);
		
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
// echo "1";		    
// echo $profile_to_delete_id;
// echo "--------------------------";
// print_r( \ProcessWire\wire("pages")->get("name=seller-profiles")->child("id=".$profile_to_delete_id));
			if(\ProcessWire\wire("pages")->get("name=seller-profiles")->child("id=".$profile_to_delete_id)->trash()){

				//$successfully_deleted_profiles[] = $profile_to_delete_id;
				if(\ProcessWire\wire("pages")->get("name=universal-profiles")->child("seller_page_id=".$profile_to_delete_id)->trash()){
				
				    $successfully_deleted_profiles[] = $profile_to_delete_id;
			    }
			}
			/*additional code by Amruta*/
			
			
			/*End additional code by Amruta*/
		}
		/* Delete each requested profile END */
// echo "-------------------------------";
// print_r($successfully_deleted_profiles);
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
	/* Function to delete job accounts based on given IDs END */