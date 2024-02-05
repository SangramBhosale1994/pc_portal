<?php
	header('Content-Type: application/json');
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
//require phpmailer/phpmailer;
//die();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;
//print_r($_POST);
//echo "abc";
	/* Create an object where all the data to be returned after finishing the process of this page is saved. This includes error and success messages, statuses etc */
	global $data_to_return;
	global $candidate_id;
	$data_to_return = new stdClass;
	$data_to_return->profile_created = false;
	$data_to_return->profile_to_edit = false;
	$data_to_return->profile_edited = false;
	$data_to_return->error = false;
	$data_to_return->error_text = array();
	$data_to_return->profile_url = "";
	$data_to_return->skills_to_confirm=false;
	$is_email_sent=false;
	$is_files_resume_created = false;
	//$data_to_return->post_data = $_POST;
//echo"abc";
$data_to_return->msg = array();
$data_to_return->msg = true;
//echo"1";
$data_to_return->msg = "abc";
	/* Check if the POST query is done or not. Exit saving and displaying error if not. */
	if(!isset($_POST)){
		$data_to_return->error = true;
//echo"1";
		$data_to_return->error_text[] = "Something went wrong. Please try again";

		echo json_encode($data_to_return);
		exit();
	}

	/* If the ADMIN is logged in and the POST query contains page_edit_id, get that page and save its login email to $profile_oauth */
//echo"abc1";
	if($session->user_designation == "admin" || $session->user_designation == "editor" && $input->post->page_to_edit_id != ""){
		$temp_page = $pages->get("name=candidates")->child("id=".$input->post->page_to_edit_id);
		$profile_oauth = $temp_page->oauth_gmail;
	}else{
		/* If admin hasn't logged in, use the session gmail of the user who has logged in and save its login email to $profile_oauth */
		$profile_oauth =  $session->oauth_gmail;
	}
//echo"abc2";
	/** skills array function code by Amruta Jagatap  */
	/**pdf skill checking function , in function pass skills array of candidate page , resume content and skills matrix */
// 		function find_skill_synonyms($skills_array,$resume_content,$skill_matrix)
// 		{
// 			//echo $resume_content;
// 			/* Access global variable that is to be returned */
// 			global $data_to_return;
// 			/** declare new skills array */
// 			$new_skills_array=array();

// 			 /** here explode skills array with , and assign to skills_array */
// 			$skills_array=explode(",",$skills_array);
// //echo"abc3";			
// 			/** array_map('trim') is used for remove prev and next space of word */
// 			/** and array_filter is used for remove empty word or space in array */
// 			$skills_array=array_map('trim', array_filter($skills_array));

// 			/** json_decode is used for convert object or json to array  */
// 			$skill_matrix=json_decode($skill_matrix);

// 			/** strtolower is used for All letters of words converted to lower case  */
// 			$resume_content=strtolower($resume_content);
// //echo"abc4";
// 			/** 1st foreach loop is execute single skill data in skill matrix */
// 			foreach($skill_matrix as $single_skill_data){
// 				//echo $single_skill_data;
// 				/** 2nd foreach loop is execute synonyms of single skill data */
// 				foreach($single_skill_data->synonyms as $skill_synonym)
// 				{

// 					/** here if skill synonym is empty then continue all process */
// 					if($skill_synonym ==""){
// 						//echo $skill_synonym;
// 						continue;
// 					}
// //echo"abc5";
// 					/** here check skill_synonym is in skills_array or in new skills_array if yes then continue */
// 					if(in_array($skill_synonym,$skills_array) || in_array($skill_synonym,$new_skills_array))
// 					{
// 						continue;
// //echo"abc6";						
// 					}
// 					/** if strpos is used for search skill_synonym in resume content  */
// 					elseif(strpos($resume_content,$skill_synonym) !== false)
// 					{
// 						/** if yes then skill_synonym store in data_to_return */
// 						$data_to_return->$skill_synonym=true;

// 						/** then skill_synonym is store in new_skills_array */
// 						$new_skills_array[]=$skill_synonym;
// //echo"abc7";						
// 					}
// 				}
				
// 			}
// 			/** retuen new skill array */
// 			return $new_skills_array;
// 		}
	/**End pdf skill checking function */
	/** End skills array function code by Amruta Jagatap  */
//echo"abc8";
	/* Check if a POST request has been made and the data (email here) is sent along with it, and the $profile_oauth should not be empty. Proceed if true */
	if($input->post->email && $profile_oauth != ""){
		/* Define a $np (New \ProcessWire\Page) variable for creating or getting page */
		$np= "";
$data_to_return->msg="abc1";

		if($session->user_designation != "admin" && $session->user_designation != "editor"){
		
	        /*Amruta Jagtap check all feilds are fillup if any one empty then display msg */
	        if($sanitizer->text($input->post->first_name)==""){
	            $data_to_return->error = true;
							$data_to_return->error_text[] = "Please enter first name";
	        }
	        
	      //   if($sanitizer->text($input->post->preferred_name)==""){
	      //        $data_to_return->error = true;
				// $data_to_return->error_text[] = "\nPlease enter preferred name";
	      //   }
	       
	         if($sanitizer->text(($input->post->pronoun == 'other')?$input->post->pronoun_custom : $input->post->pronoun)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter pronoun";
	        }
	         if($sanitizer->text($input->post->out_at_work)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter out at work";
	        }
	         if($sanitizer->text(($input->post->identify_as == 'other')?$input->post->identify_as_custom : $input->post->identify_as)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter identify as";
	        }
	         if($sanitizer->email($input->post->email)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter email";
	        }
	         if($sanitizer->text($input->post->phone_number)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter phone number";
	        }
	         if($sanitizer->text($input->post->WhatsApp_number)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter whatsapp number.";
	        }
	        if($sanitizer->textarea($input->post->key_skills)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter skills";
	        }
	        if($sanitizer->text(($input->post->current_city == 'other')?$input->post->current_city_custom : $input->post->current_city)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter current city";
	        }
	        if($sanitizer->text(($input->post->qualification == 'other')?$input->post->qualification_custom : $input->post->qualification)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter qualification";
	        }
	        if($sanitizer->text($input->post->year_of_passing)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter year of passing";
	        }
	//         if($np->industry==""){
	//              $data_to_return->error = true;
	// 			$data_to_return->error_text[] = "Please enter industry.";
	//         }
	        if($sanitizer->text($input->post->experience_years)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter experience years";
	        }
	        if($sanitizer->text($input->post->experience_months)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter experience months";
	        }
	        if($sanitizer->text($input->post->current_employer)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter current employer";
	        }
	        if($sanitizer->text($input->post->current_role)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter current role";
	        }
	        if($sanitizer->text($input->post->current_ctc)==""){
	             $data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter current ctc";
	        }

				// 	if($sanitizer->text($input->post->age)==""){
				// 		$data_to_return->error = true;
				// $data_to_return->error_text[] = "\nPlease enter age";
				// 	}
				// 	if($sanitizer->text($input->post->dob)==""){
				// 		$data_to_return->error = true;
				// $data_to_return->error_text[] = "\nPlease enter date of birth";
				// 	}
					if($sanitizer->text($input->post->internship_apply)==""){
						$data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease select internship interest";
					}
					if($input->post->internship_apply=="Yes"){
						if($sanitizer->text($input->post->age_allow)==""){
							$data_to_return->error = true;
					$data_to_return->error_text[] = "\nPlease select age confirmation option";
						}
						if($sanitizer->array($input->post->internship_month)==""){
							$data_to_return->error = true;
					$data_to_return->error_text[] = "\nPlease select internship month";
						}
						if($sanitizer->text($input->post->aggregate_percentage)==""){
							$data_to_return->error = true;
					$data_to_return->error_text[] = "\nPlease select aggregate percentage";
						}

					}
				
				// 	if($sanitizer->text($input->post->educational_institute)==""){
				// 		$data_to_return->error = true;
				// $data_to_return->error_text[] = "\nPlease enter educational institute";
				// 	}
					if($sanitizer->text($input->post->month_of_passing)==""){
						$data_to_return->error = true;
				$data_to_return->error_text[] = "\nPlease enter month of passing";
					}
	    }

        	/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets ;//. "files/temp-files/";

            	/* Uploading and saving of profile image END */
$data_to_return->msg= "13";
			/* check if the page is to be created or edited */
			
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth)->id == 0){
		
    		/* Uploading and saving of Resume. (Same process as image upload) */
    		$resume = new \ProcessWire\WireUpload('resume');
    
    		$resume->setMaxFiles(1);
    		$resume->setOverwrite(false);
    		$resume->setDestinationPath($upload_path);
$data_to_return->msg= "14";
    		$resume->setValidExtensions(array('pdf', 'docx', 'doc'));
    
    		$files_resume = $resume->execute();
    		$is_files_resume_created = true;
    		
    // 		if($resume==""){
    //             $data_to_return->error = true;
    //     		//echo"2";
    //     		$data_to_return->error_text[] = "Upload your resume";
    //         } 
    
    		$is_resume_uploaded = false;
    
    		if(!count($files_resume) && $data_to_return->profile_to_edit){
$data_to_return->msg= "15";
    		}
    		elseif(!count($files_resume) && $session->user_designation != "admin" &&  $session->user_designation != "editor" ){
    			$data_to_return->error = true;
    			$data_to_return->error_text[] = "\nNo resume uploaded. Please upload your resume.";
    // 			echo json_encode($data_to_return);
    // 			die();
    		}
    		else{
    			
    		}
		}
		
		/* If Error Saved, Exit with the error message */
		if($data_to_return->error == true){
    // 		 $data_to_return->error = true;
    // 		//echo"2";
    // 		$data_to_return->error_text[] = "\nPlease Check all feilds.";
    		echo json_encode($data_to_return);
    		exit();
		}




$data_to_return->msg = Array();


		/* check if the page is to be created or edited */
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth)->id != 0){
			/* Get reference to the page to be edited */
			$np = $pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth);
			$candidate_active_status=$np->active_status;
			$candidate_active_status_block=false;
			if($input->post->active_status!=$candidate_active_status){
				$candidate_active_status_block=true;
			}
			$np_candidate_status=$np->candidate_status;
			$candidate_candidate_status_block=false;
			if($input->post->candidate_status!=$np_candidate_status){
				$candidate_candidate_status_block=true;
			}
			// echo $candidate_active_status;
			// echo "--1---";
			// echo	$candidate_active_status_block;
			// echo "--2--";
			// echo $np_candidate_status;
			// echo "--3--";
			// echo $candidate_candidate_status_block;
			// echo "--4--";
			


// echo $np;
// echo $np->oauth_gmail;
			
			$data_to_return->profile_to_edit = true;
		}
		/** Else if the page doesn't alreasy exist and this is a new entry */
		else{
			/*** Basic Page Creation Info */
			$np = new \ProcessWire\Page();
			$np->template = $templates->get("candidate_page");
			$np->parent = $pages->get("name=candidates");
			$np->title = time().mt_rand(10,99);
			/*** Basic Page Creation Info End */
$data_to_return->msg[]="2";
			/*** Save the page with unique email-ID */
			$np->oauth_gmail = strtolower($profile_oauth);

		}

		/* Check if the page is to be created or edited END */

		/* Save the link to the profile page in the data_to_return object.  */
		//$data_to_return->profile_url = $np->httpUrl;
$data_to_return->msg[]="6";
		/* Text Data From The Form (sanitized) */
		$np->first_name = $sanitizer->text($input->post->first_name);
		$np->preferred_name = $sanitizer->text($input->post->preferred_name);
		/** Check if 'other' is selected. If yes, go for the custom input. (for pronoun, out_at_work, identify_as, qualification etc multiple choice type inputs) */
		$np->pronoun = $sanitizer->text(($input->post->pronoun == 'other')?$input->post->pronoun_custom : $input->post->pronoun);
		$np->out_at_work = $sanitizer->text($input->post->out_at_work);
		$np->identify_as = $sanitizer->text(($input->post->identify_as == 'other')?$input->post->identify_as_custom : $input->post->identify_as);
		$np->email = $sanitizer->email($input->post->email);
		$np->phone_country_code = $sanitizer->text($input->post->phone_country_code);
		$np->phone_number = $sanitizer->text($input->post->phone_number);
		$np->whatsapp_country_code = $sanitizer->text($input->post->WhatsApp_country_code);
		$np->whatsapp_number = $sanitizer->text($input->post->WhatsApp_number);
		$np->skills = $sanitizer->textarea($input->post->key_skills);
		$np->tell_us_about_yourself = $sanitizer->textarea($input->post->tell_us_about_yourself);
		$np->how_did_you_know_about_us = $sanitizer->text($input->post->how_did_you_know_about);
		
		$np->current_city = $sanitizer->text(($input->post->current_city == 'other')?$input->post->current_city_custom : $input->post->current_city);

		$np->qualification = $sanitizer->text(($input->post->qualification == 'other')?$input->post->qualification_custom : $input->post->qualification);
		$np->year_of_passing = $sanitizer->text($input->post->year_of_passing);
		$np->month_of_passing = $sanitizer->text($input->post->month_of_passing);

		$np->industry = $sanitizer->text(($input->post->industry == 'other')?$input->post->industry_custom : $input->post->industry);
		$np->experience_years = $sanitizer->text($input->post->experience_years);
		$np->experience_months = $sanitizer->text($input->post->experience_months);
		$np->current_employer = $sanitizer->text($input->post->current_employer);
		$np->current_role = $sanitizer->text($input->post->current_role);
	    $np->current_ctc_time = $sanitizer->text($input->post->current_ctc_time);
		//$np->current_ctc_time =$sanitizer->text($input->post->current_ctc_time.$input->post->current_ctc_currency);
		$np->current_ctc = $sanitizer->text($input->post->current_ctc);
		$np->current_ctc_currency = $sanitizer->text($input->post->current_ctc_currency);

		// $np->age = $sanitizer->text($input->post->age);
		// $np->date_of_birth = $sanitizer->text($input->post->dob);
		$np->internship_apply = $sanitizer->text($input->post->internship_apply);
		$np->age16over = $sanitizer->text($input->post->age_allow);
		$np->aggregate_percentage = $sanitizer->text($input->post->aggregate_percentage);
		/** Save hackathon_interested data in candidate profile */
		if($session->hackps=="true"){
			$np->hackathon_interested="Yes";
		}
		else{
			$np->hackathon_interested="No";
		}
		
		$internship_month=array();
		//$internship_month=$sanitizer->array($input->post->internship_month);
		//print_r($internship_month);
		//print_r($internship_month);
		$internship_month = $sanitizer->array($input->post->internship_month);
		//print_r($internship_month);
		$np->internship_month = json_encode($internship_month);
		// echo "****************";
		// echo $np->internship_month;

$data_to_return->msg[]=$np->internship_month;
		$np->college = $sanitizer->text($input->post->educational_institute);
$data_to_return->msg[]="7";
		/** Assign active_status. (Default 'active to new pages; change according to POST input for page editing. This can only be edited by an admin. So no compulsory action done here on active_status unless needed.) */
// 		if($input->post->active_status){
// 		    if($np->identify_as=="other"){
// 		        $np->active_status = "Inactive";
// 		    }
// 			$np->active_status = $sanitizer->text($input->post->active_status);
// 		}
        $identify_as=strtolower($np->identify_as);
        
		if($input->post->active_status !=""){
				$np->active_status = $sanitizer->text($input->post->active_status);

		}
		elseif($data_to_return->profile_to_edit !== true){
			if($identify_as=="male" || $identify_as =="female" || $identify_as =="straight" || $identify_as =="men" || $identify_as =="man" || $identify_as =="women" || $identify_as =="heterosexual"){
			    
			    $np->active_status = "Inactive";
    		}
    		else{
    				$np->active_status = "Inactive";
    		}
		}
		else{
		    
		}
		/* Text Data From The Form End */
	
		/* Text Data From The Form End */
		
		/** Assign LGBTQ verification.  */
// 		if($input->post->lgbtq_verification){
// 			$np->lgbtq_verification = $sanitizer->text($input->post->lgbtq_verification);
// 		}else
		if($data_to_return->profile_to_edit !== true){
			$np->lgbtq_verification = "Unchecked";
		}
		/* Text Data From The Form End */
		
$data_to_return->msg[]= "8";
       
$data_to_return->msg[]= "9";       
//         if($data_to_return->error!=true){
// $data_to_return->msg= "10";
// $data_to_return->msg="np1";
// 		/* Save the page with the text values from POST form input */
// 		$np->of(false);
// 		$np->save();
//         }
		/* Save the page with the text values from POST form input END */
		
		/*** Serial ID created from the ID counter page */
		/**** Get serial ID from the serial ID page */
		if($data_to_return->profile_to_edit != true ){
			$serial_id_counter_page = $pages->get("name=serial_id_counter_page");
			/**** Assign the given ID to the  new page and increment the number for the next page */
			$np->serial_id = $serial_id_counter_page->serial_id++;
	$data_to_return->msg[]="3";
			/**** save the incremented ID page */
			$serial_id_counter_page-> of(false);
			$serial_id_counter_page->save();
		}
		/*** Serial ID created from the ID counter page END */

		/*** Save the newly created candidate page with bare minimum requirements so that a candidate profile is created */
$data_to_return->msg[]="np4";
// 			$np->of(false);
// 			$np->save();

$data_to_return->msg[]= "10";
$data_to_return->msg[]="np1";
		/* Save the page with the text values from POST form input */
		$np->of(false);
		$np->save();
		

		/* If uploaded files have already not been saved to the temp path. Save it. */
		if($is_files_resume_created != true){
    		/* Uploading and saving of Resume. (Same process as image upload) */
    		$resume = new \ProcessWire\WireUpload('resume');
    
    		$resume->setMaxFiles(1);
    		$resume->setOverwrite(false);
    		$resume->setDestinationPath($upload_path);
$data_to_return->msg[]= "14";
    		$resume->setValidExtensions(array('pdf', 'docx', 'doc'));
    		$files_resume = $resume->execute();
    	}
	    	/* If uploaded files have already not been saved to the temp path. Save it. END */

		$is_resume_uploaded = false;

		if(!count($files_resume) && $data_to_return->profile_to_edit){
$data_to_return->msg[]= "15";
		}
		elseif(!count($files_resume)){
			$data_to_return->error = true;
			$data_to_return->error_text[] = "\nCould not upload your resume. Please try again.";
// 			echo json_encode($data_to_return);
// 			die();
		}
		else{
$data_to_return->msg[]= "21";	    
			if($data_to_return->profile_to_edit){
			    $np->resume->deleteAll();
$data_to_return->msg[]= "22";
			}
$data_to_return->msg[]= "16";
			foreach($files_resume as $filename) {
				$pathname = $upload_path . $filename;
				$np->resume->add($pathname);
				$np->message("Added file: $filename");
				unlink($pathname);
			}

			$is_resume_uploaded = true;	
			$np->of(false);
		  $np->save();
		}
    
	
    	
$data_to_return->np_id= $np->id;
    			
$data_to_return->msg[]="4";
		/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
		if($data_to_return->profile_to_edit != true && $pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth)->id != 0){
			    $data_to_return->profile_created = true;
					$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
					foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
						// echo $single_email_content;
						if($single_email_content->text_1=="New Account"){
							/** Send mail when create candidate account */
							$candidate_email=$np->email;
							// $candidate_email="amruta.jagatap@zerovaega.com";
							$candidate_subject="Resume Portal - Candidate Account";

							$candidate_message ="Dear {$np->preferred_name},";
							$candidate_message .="<br><br>";
							$candidate_message .="{$single_email_content->rich_textarea_1}";
							try {
								send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
							} catch (Exception $e) {
								print_r($e);
							}
						}
						else{
							continue;
						}
					}
$data_to_return->msg[]="5";
            
		}
		elseif($data_to_return->profile_to_edit == true && $pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth)->id != 0){
			$data_to_return->profile_edited = true;
		}
		else{
			$data_to_return->error = true;
			//echo"2";
			$data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
			echo json_encode($data_to_return);
			exit();
		}

		// $data_to_return->profile_url = $np->httpUrl;
		if($session->hackps=="true"){
			$session->hackps_candidate_registration="true";
			$session->user_id=$np->id;
			$session->user_email=$np->email;
			$data_to_return->profile_url = $pages->get("name=hackathon")->httpUrl;
		}
		else{
			$data_to_return->profile_url = $np->httpUrl;
		}

		/* If the profile is not created, then it is now edited, Save it in data_to_return */
		
			
		
		
		
			
			
			
			

//echo $np->how_did_you_know_about_us;
//echo $input->post->referrer_code;
//echo "==================================";
$data_to_return->msg[]= "11";		
		/* Amrut Todkar 2021-02-06 Check if the user has selected "reffered"  then save the ID of the referrer to the candidate's profile and the candidate's ID to the referrer's profile. */
		$referred_candidate = false;
		//echo "++++++++++++++++++++++++";
		//var_dump($referred_candidate);
		//echo $np->how_did_you_know_about_us;
	//	echo "----------------------";
		//echo $input->post->referrer_code;
		if($np->how_did_you_know_about_us == "Referred" && $input->post->referrer_code != ""){
		    $referral_code=  $sanitizer->int($input->post->referrer_code);
		    
		    $referrer_page = $pages->get("name=referral-profiles")->child("referrer_member_code=".$referral_code);
		   
		    
//print_r($referrer_page);
//echo "++++++++++++++++++++++++";

		    if($referrer_page->id != 0){
		        $np->referrer_page_id = $referrer_page->id;

		        $referred_candidate = true;

		        /* Save the candidate page  */
        		$np->of(false);
        		$np->save();
		    
			    /* object to add to referrer's point details json */
			    $referrer_points_new_entry = new stdClass;
			    $referrer_points_new_entry->timestamp = time() +  60*60*5.50;
			  //  $referrer_points_new_entry->timestamp=$referrer_points_new_entry->published +  60*60*5.50;
			    $referrer_points_new_entry->points = 0;
	            $referrer_points_new_entry->points_increment_decrement = "increment";
			    $referrer_points_new_entry->candidate_page_id = $np->id;
			    $referrer_points_new_entry->title = " New Registration!";
			    $referrer_points_new_entry->message = "Congratulations! ".$np->preferred_name." has signed up using your link.";
			    /* object to add to referrer's point details json END */
	//print_r($referrer_points_new_entry);		    
			    /* Get the JSON of points details from the referrer page */
	            $referrer_points_json = $referrer_page->referrer_points;
	            
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
	//print_r($referrer_points_json);        
	//echo "------------------------------------";
	//print_r($referrer_points_object);
	//echo "///////////////////////////////////////////";
	//print_r($referrer_page->points_details_array);
	            
	            /* Save the referrer page */
	//echo $referrer_page;         
	            $referrer_page->referrer_points=$referrer_page->points_details_array;
	//print_r($referrer_page->referrer_points);
	             $referrer_page->of(false);
				$referrer_page->save();
				
				$email=$referrer_page->referrer_email;
				//$email="amrutaj.zerovaega@gmail.com";
				$title =$referrer_points_new_entry->title;
	            $subject ="Pride Circle TAG : ".$np->preferred_name." has signed up using your link";
	            $link =$pages->get("name=universe")->httpUrl;
	            
	            $message ="Dear ".$referrer_page->title."<br><br>Thanks for sharing the referral link. ".$np->preferred_name." has signed up using your link. You will get your points once Pride Circle team verifies your submission. The verification will be completed within 10 working days. Keep Referring. :)<br><br><a href='".$link."'><button id='btn_register' style='color: #fff;
	         background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
	            
	 
	    	
	    // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
	    // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    
	    		try {
	    		    send_smtp_mail($email,$message,$subject);
	    			//mail($email, $subject, $message, $headers);
	    			$is_email_sent=true;
	    		} catch (Exception $e) {
	    			$error_message = true;
	    		}
	    	}
		}
		elseif($np->how_did_you_know_about_us == "Referred" && $np->referrer_page_id != ""){
		     $referrer_page = $pages->get("name=referral-profiles")->child("id=".$np->referrer_page_id);

		    if($referrer_page->id != 0){
		        $referred_candidate = true;
		    }
		}
		/* Referral code END */
		
			
		
		
//echo "1";
		
//echo "1";
		/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets ;//. "files/temp-files/";
$data_to_return->msg[]= "12";
		/* Uploading and saving of profile image */
		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
		//$contact_photo = new \ProcessWire\WireUpload('profile_image');

		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
// 		$contact_photo->setMaxFiles(1);
// 		$contact_photo->setOverwrite(false);
// 		$contact_photo->setDestinationPath($upload_path);
// 		$contact_photo->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
		//$files = $contact_photo->execute();

		/** Checking of errors while uploading the files. Run a count($files) test to make sure there are actually files; if so, proceed; if not, generate getErrors() */
		/*** If the application is being edited, there already is an image uploaded, so there is no need to create any errors in case it's an editing request not a create-new-profile one */
// 		if(!count($files) && $data_to_return->profile_to_edit){
// 		if($data_to_return->profile_to_edit){

// 		}
		/*** If $files contains nothing, save the error message. */
// 		elseif(!count($files)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No photo uploaded. Please make sure to upload a picture in .jpg or .png format under 2Mb.";
// 		}
		/*** Here, $files contains a file. So we proceed to save the image file to the candidate profile page. */
// 		else{
// 			/**** Delete the previous image available if the page is being edited. */
// 			if($data_to_return->profile_to_edit){
// 				$np->profile_image->deleteAll();
// 			}

// 			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
// 			foreach($files as $filename) {
// 				$pathname = $upload_path . $filename;
// 				$np->profile_image->add($pathname);
// 				$np->message("Added file: $filename");
// 				unlink($pathname);
// 			}
// 		}
    	//if($data_to_return->profile_created==true){
    // 	    if($data_to_return->profile_to_edit){
    // 				//$np->resume->deleteAll();
    // 			}
    // $data_to_return->msg= "16";
    // 			foreach($files_resume as $filename) {
    // 				$pathname = $upload_path . $filename;
    // 				$np->resume->add($pathname);
    // 				$np->message("Added file: $filename");
    // 				unlink($pathname);
    // 			}
    // $data_to_return->np_id= $np->id;
    // 			$is_resume_uploaded = true;
//	}
		
	 


// 		if($data_to_return->profile_to_edit==true ){
// 			/*** Same uploding procedure as image upload. */
// 			$redacted_resume = new \ProcessWire\WireUpload('redacted_resume');
// 			$redacted_resume->setMaxFiles(1);
// 			$redacted_resume->setOverwrite(false);
// 			$redacted_resume->setDestinationPath($upload_path);
// 			$redacted_resume->setValidExtensions(array('pdf', 'docx', 'doc'));
// //echo "6";
// 			$files_redacted_resume = $redacted_resume->execute();

// 			if(count($files_redacted_resume)){
// 				if($np->resume){
// 					$np->resume->deleteAll();
// 				}
// //echo "7";
// 				foreach($files_redacted_resume as $filename) {
// 					$pathname = $upload_path . $filename;
// 					$np->resume->add($pathname);
// 					$np->message("Added file: $filename");
// 					unlink($pathname);
// 				}
// 			}
// $data_to_return->msg[]="np3";       
//             	$np->of(false);
// 		        $np->save();
// 		}
		/* Uploading and saving of Resume END */

		/* Upload of redacted Resume. (Only by the admin when editing.) */
		/** Check if the page is being edited and by the admin. Procees if true. */
		if($data_to_return->profile_to_edit && ($session->user_designation == "admin" || $session->user_designation == "editor")){
			/*** Same uploding procedure as image upload. */
			$redacted_resume = new \ProcessWire\WireUpload('redacted_resume');
			$redacted_resume->setMaxFiles(1);
			$redacted_resume->setOverwrite(false);
			$redacted_resume->setDestinationPath($upload_path);
			$redacted_resume->setValidExtensions(array('pdf', 'docx', 'doc'));
//echo "6";
			$files_redacted_resume = $redacted_resume->execute();

			if(count($files_redacted_resume)){
				if($np->redacted_resume){
					$np->redacted_resume->deleteAll();
				}
//echo "7";
				foreach($files_redacted_resume as $filename) {
					$pathname = $upload_path . $filename;
					$np->redacted_resume->add($pathname);
					$np->message("Added file: $filename");
					unlink($pathname);
				}
			}

			/**Save Candidate status uusing Admin and editor panel */
			if($candidate_candidate_status_block==true){
			$np->candidate_status = $sanitizer->text($input->post->candidate_status);

				/**Save candidate status in notes json data for display in notes section */
				// $session_user_id=\ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session"));
				// print_r($session_user_id);
				// echo $session->user_page_id;
				// echo "*****";
				if($np->candidate_status!=""){
					$candidates_notes_entry_object=new stdClass();
					$candidates_notes_entry_object->notes="Status changed to : ".$np->candidate_status;
					$candidates_notes_entry_object->timestamp=strtotime(date("Y-m-d h:i:sa"));
					$candidates_notes_entry_object->added_by=$session->user_page_id;
					$candidates_notes_json=$np->notes_data;
					if($candidates_notes_json == ""){
						$candidates_notes_json='{"notes_details_array":[]}';
					}
					/* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the notes_data field. */
					$candidates_notes_object = json_decode($candidates_notes_json);
					$candidates_notes_object->notes_details_array[] = $candidates_notes_entry_object;
					$np->notes_details_array = json_encode($candidates_notes_object);
					$np->notes_data=$np->notes_details_array;
				}
			}
				/**End Save candidate status in notes json data for display in notes section */
			
				/**Send mail candidate after changing the candidate status */
				if($input->post->candidate_status!="" || $input->post->active_status!=""){
					$np_candidate_status = $sanitizer->text($input->post->candidate_status);
					// echo $np_candidate_status;
					// echo "*****";
					$np->active_status = $sanitizer->text($input->post->active_status);
					// echo $np_candidate_status;
					// echo "------";
					$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$np->id);
					$candidate_status=$candidate_page->candidate_status;
					// echo $candidate_status;
					// echo "++++++";
					if($candidate_candidate_status_block==true){
					// echo "111";
						$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
						foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
							// echo $single_email_content->text_1;
							// echo "///";
							// echo $input->post->candidate_status;
								if($single_email_content->text_1==($input->post->candidate_status)){
									// echo "222";
									$candidate_email=$np->email;
									// $candidate_email="amruta.jagatap@zerovaega.com";
									// echo "----";
									// echo $candidate_email;
									$candidate_subject="Resume Portal - Candidate Status";

									$candidate_message ="Dear {$np->preferred_name},";
									$candidate_message .="<br><br>";
									$candidate_message .="{$single_email_content->rich_textarea_1}";
									try {
										send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
									} catch (Exception $e) {
										print_r($e);
									}

								}
								else{
									continue;
								}
								// echo "999";
						}
					}
					else{}
					
					if($candidate_active_status_block==true){
						$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
						foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
								if($single_email_content->text_1==$input->post->active_status){
									$candidate_email=$np->email;
									$candidate_subject="Resume Portal - Candidate Status";

									$candidate_message ="Dear {$np->preferred_name},";
									$candidate_message .="<br><br>";
									$candidate_message .="{$single_email_content->rich_textarea_1}";
									try {
										send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
									} catch (Exception $e) {
										print_r($e);
									}
								}
								else{
									continue;
								}
						}

					}
					else{}

					if($input->post->lgbtq_verification!=""){
						// echo "111";
						if($np->lgbtq_verification=="Unchecked" || $np->lgbtq_verification=="" || $np->lgbtq_verification=="Confirmed" || $np->lgbtq_verification=="Rejected"){
							// echo "222";
							$email_content_for_candidate_status=\ProcessWire\wire("pages")->get("name=mail-content-for-candidate-status");
							foreach($email_content_for_candidate_status->email_content_repeater as $single_email_content){
								// echo "333";	
								if($single_email_content->text_1==$input->post->lgbtq_verification){
									// echo "444";
										$candidate_email=$np->email;
										$candidate_subject="Resume Portal - Verification";

										$candidate_message ="Dear {$np->preferred_name},";
										$candidate_message .="<br><br>";
										$candidate_message .="{$single_email_content->rich_textarea_1}";
										try {
											send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
										} catch (Exception $e) {
											print_r($e);
										}
									}
									else{
										continue;
									}
							}
						
						}
					}
					else{}
				}

				// if($input->post->active_status!=""){
				// 	$np->active_status = $sanitizer->text($input->post->active_status);
				// 	/**Send mail candidate after changing the candidate status */
				// 	$candidate_page=\ProcessWire\wire("pages")->get("name=candidates")->child("id=".$np->id);
				// 	if($candidate_active_status_block==true){
				// 		$candidate_email=$np->email;
				// 		// echo "---------";
				// 		// echo $candidate_email;
				// 		// $candidate_email="amruta.jagatap@zerovaega.com";
				// 		$candidate_subject="Resume Portal - Candidate Status";

				// 		$candidate_message ="Dear {$np->first_name},";
				// 		$candidate_message .="<br><br>";
				// 		$candidate_message .="Your Candidate Status is Changed. You added in {$np->active_status} status.";
				// 		try {
				// 			send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
				// 		} catch (Exception $e) {
				// 			print_r($e);
				// 		}
				// 	}

				// }
			
			
			if($referred_candidate){
				$referrer_page = $pages->get("name=referral-profiles")->child("id=".$np->referrer_page_id);
    	   	 	$referrer_points =$referrer_page->referrer_points;
			}
			
//print_r($referrer_points);
//echo $input->post->lgbtq_verification;
//echo $np->lgbtq_verification;
//print_r($referrer_points->points);
    	    //if($np->lgbtq_verification=="Unchecked"){
//echo "111111111";
// $referral_code=  $sanitizer->int($input->post->referrer_code);
// echo $referral_code;
// echo "////";
                		    
//                 		    $referrer_page = $pages->get("name=referral-profiles")->child("referrer_member_code=".$referral_code);
// echo $referrer_page;
// echo "****";
//var_dump($referred_candidate);
//echo "*******************";
//echo $input->post->lgbtq_verification;
//echo "///////////////////////////////";
//echo $np->lgbtq_verification;

						/**Mail send to candidate after adding to lgbtq_verfication is verified */
						// if(($np->lgbtq_verification=="Unchecked" || $np->lgbtq_verification=="" ) && $input->post->lgbtq_verification=="Confirmed"){
						// 	$candidate_email=$np->email;
						// 	// $candidate_email="amruta.jagatap@zerovaega.com";
						// 	$candidate_subject="Resume Portal - Candidate Verification";

						// 	$candidate_message ="Dear {$np->first_name},";
						// 	$candidate_message .="<br><br>";
						// 	$candidate_message .="Your Candidate LGBTQ Verification is Confirmed.";
						// 	try {
						// 		send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
						// 	} catch (Exception $e) {
						// 		print_r($e);
						// 	}
						// }
						// if(($np->lgbtq_verification=="Unchecked" || $np->lgbtq_verification=="" ) && $input->post->lgbtq_verification=="Rejected"){
						// 	$candidate_email=$np->email;
						// 	// $candidate_email="amruta.jagatap@zerovaega.com";
						// 	$candidate_subject="Resume Portal - Candidate Verification";

						// 	$candidate_message ="Dear {$np->first_name},";
						// 	$candidate_message .="<br><br>";
						// 	$candidate_message .="Your Candidate LGBTQ Verification is Rejected.";
						// 	try {
						// 		send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
						// 	} catch (Exception $e) {
						// 		print_r($e);
						// 	}
						// }
						// if($np->lgbtq_verification=="Confirmed" && $input->post->lgbtq_verification=="Rejected"){
						// 	$candidate_email=$np->email;
						// 	// $candidate_email="amruta.jagatap@zerovaega.com";
						// 	$candidate_subject="Resume Portal - Candidate Verification";

						// 	$candidate_message ="Dear {$np->first_name},";
						// 	$candidate_message .="<br><br>";
						// 	$candidate_message .="Your Candidate LGBTQ Verification is Rejected.";
						// 	try {
						// 		send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
						// 	} catch (Exception $e) {
						// 		print_r($e);
						// 	}
						// }
						// if($np->lgbtq_verification=="Rejected" && $input->post->lgbtq_verification=="Confirmed"){
						// 	$candidate_email=$np->email;
						// 	// $candidate_email="amruta.jagatap@zerovaega.com";
						// 	$candidate_subject="Resume Portal - Candidate Verification";

						// 	$candidate_message ="Dear {$np->first_name},";
						// 	$candidate_message .="<br><br>";
						// 	$candidate_message .="Your Candidate LGBTQ Verification is Confirmed.";
						// 	try {
						// 		send_smtp_mail($candidate_email,$candidate_message,$candidate_subject);
						// 	} catch (Exception $e) {
						// 		print_r($e);
						// 	}
						// }

            if(($np->lgbtq_verification=="Unchecked" || $np->lgbtq_verification=="" ) && $input->post->lgbtq_verification=="Confirmed"){
        	
        			/* pass applicants save pass verification verified and send mail*/
        				
        				$job_fair_page = \ProcessWire\wire("pages")->get("name=pass-applicants")->child("candidate_profile_id=".$np->id);
        				// $data_to_return->job_page=true;
        				// $data_to_return->job_page[] = $job_fair_page;
        	
        				/* If editor not found, return */
        				if($job_fair_page->id != 0){
        					
        				
        						
        						// $job_fair_page->pass_verification = "verified";
        						
        						/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
        						/**** Get serial ID from the serial ID page */
        						$pass_applicants_counter_page = \ProcessWire\wire('pages')->get("name=pass-applicants-counter-page");
        						/**** Assign the given ID to the  new page and increment the number for the next page */
        						$job_fair_page->serial_id = $pass_applicants_counter_page->serial_id++;
        				//echo"5";
        						/**** save the incremented ID page */
        						// $pass_applicants_counter_page-> of(false);
        						// $pass_applicants_counter_page->save();
        						/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */
        				
        				
        				
        						/* save the page */
        						// $job_fair_page->of(false);
        						// $job_fair_page->save();
        						
        						$event_name = "RISE JOB FAIR TICKET";
        						$pass_number=$job_fair_page->serial_id;
        						$applicants_name=$job_fair_page->title;
        						$applicants_email=$job_fair_page->email;
        						$applicants_contact=$job_fair_page->phone_country_code."".$job_fair_page->phone_number;
        						
        						$applicants_subject="RISE JOB FAIR 2022 | EVENT PASSES";
        				
        						$applicants_message ="Dear {$applicants_name},";
        						
        						$applicants_message .="<br><br>";
								$applicants_message .="You have successfully registered for India's Premier LGBT+ Job Fair - RISE 2022!";
								$applicants_message .="<br>";
								$applicants_message .="Your event pass details:";
								$applicants_message .="<br><br>";
						
								$applicants_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
								$applicants_message .="    <tr>";
								$applicants_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
								$applicants_message .="            <b>{$event_name}</b>";
								$applicants_message .="        </td>";
								$applicants_message .="    </tr>";
								$applicants_message .="</table>";
						
								$applicants_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
								$applicants_message .="    <tr style='padding:10px;' >";
								$applicants_message .="        <td style='text-align:left; padding:15px;'>";
								$applicants_message .="            <b>Ticket ID</b>: {$pass_number}</b>";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Name</b>: {$applicants_name}";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Contact Number</b>: {$applicants_contact}";
								$applicants_message .="            <br>";
								$applicants_message .="            <b>Email ID</b>: {$applicants_email}";
								$applicants_message .="        </td>";
								$applicants_message .="    </tr>";
								$applicants_message .="</table>";

								$applicants_message .="<br><br>";
								$applicants_message .="We will email you the event link closer to the event date to be able to access the virtual platform on 30th April, 2022 and meet some of the top inclusive organizations from across the country.";
								$applicants_message .="<br>";
								$applicants_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you.";
								$applicants_message .="<br><br>";
								$applicants_message .="In case of any questions or entry correction requests, please drop us a mail at rise@thepridecircle.com before 10th April 2022, explaining the query along with your details and ticket ID. In case of any payment queries on accounts@thepridecircle.com";
								$applicants_message .="<br>";
        						
        						try {
        							// send_smtp_mail($job_fair_page->email,$applicants_message,$applicants_subject);
        						} catch (Exception $e) {
        												print_r($e);
        						}
        			}
        
            }



            if($referred_candidate && $input->post->lgbtq_verification !== $np->lgbtq_verification){
        //echo "222";
        
                if($np->lgbtq_verification=="Unchecked" && $input->post->lgbtq_verification=="Confirmed"){
                //$referrer_points_new_entry->points = 1;
           
        		        
        		              /* object to add to referrer's point details json */
                		    $referrer_points_new_entry = new stdClass;
                		    $referrer_points_new_entry->timestamp = time() + 60*60*5.50;
                		    $referrer_points_new_entry->points = 50;
                            $referrer_points_new_entry->points_increment_decrement = "increment";
                		    $referrer_points_new_entry->candidate_page_id = $np->id;
                		    $referrer_points_new_entry->title = " Referral Verified!";
                		    $referrer_points_new_entry->message = "Congratulations!! Your referral ".$np->preferred_name. " has been successfully verified.";
                		    /* object to add to referrer's point details json END */
                //print_r($referrer_points_new_entry);		    
                		    /* Get the JSON of points details from the referrer page */
                            $referrer_points_json = $referrer_page->referrer_points;
                            
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
                //print_r($referrer_points_json);        
                //echo "------------------------------------";
                //($referrer_points_object);
                //echo "///////////////////////////////////////////";
                //print_r($referrer_page->points_details_array);
                            
                            /* Save the referrer page */
                // $referrer_page;         
                            $referrer_page->referrer_points=$referrer_page->points_details_array;
                //echo "================================";
                //print_r($referrer_page->referrer_points);
                             $referrer_page->of(false);
                			$referrer_page->save();
                	//}
                		/* Referral code END */
                	    	$email=$referrer_page->referrer_email;
                	        //$email="amrutaj.zerovaega@gmail.com";
                            $title =$referrer_points_new_entry->title;
                            $subject ="Pride Circle TAG : Yay! ".$np->preferred_name." has been verified and you got 50 points.";
                             $link =$pages->get("name=universe")->httpUrl;
                            
                            $message ="Dear ".$referrer_page->title."<br><br>Congratulations! your referral has been successfully verified and you earned “50 Points”.<br>Check your account here<br><br><a href='".$link."'><button id='btn_register' style='color: #fff;
                                 background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
                            
                    	
                    // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
                    // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
                    		try {
                    		    send_smtp_mail($email,$message,$subject);
                    			//mail($email, $subject, $message, $headers);
                    			$is_email_sent=true;
                    		} catch (Exception $e) {
                    			$error_message = true;
                    		}
        
            }
                elseif($np->lgbtq_verification=="Unchecked" && $input->post->lgbtq_verification=="Rejected"){
                    //$referrer_points_new_entry->points = 1;
                    
                     /* object to add to referrer's point details json */
            		    $referrer_points_new_entry = new stdClass;
            		    $referrer_points_new_entry->timestamp = time() + 60*60*5.50;
            		    $referrer_points_new_entry->points = 0;
                        $referrer_points_new_entry->points_increment_decrement = "decrement";
            		    $referrer_points_new_entry->candidate_page_id = $np->id;
            		    $referrer_points_new_entry->title = "Referral Rejected";
            		    $referrer_points_new_entry->message = "Your referral ".$np->preferred_name. " doesn’t belong to the LGBT+ community.";
            		    /* object to add to referrer's point details json END */
            //print_r($referrer_points_new_entry);		    
            		    /* Get the JSON of points details from the referrer page */
                        $referrer_points_json = $referrer_page->referrer_points;
                        
                        /* If the JSON is empty, create an empty array */
                        if($referrer_points_json == ""){
                            $referrer_points_json='{"points_details_array":[]}';
                        }
            // print_r($referrer_points_json);            
            // echo "**************************************";
                        /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
                        $referrer_points_object = json_decode($referrer_points_json);
                        $referrer_points_object->points_details_array[] = $referrer_points_new_entry;
                        $referrer_page->points_details_array = json_encode($referrer_points_object);
            //print_r($referrer_points_json);        
            //echo "------------------------------------";
            // print_r($referrer_points_object);
            // echo "///////////////////////////////////////////";
            // print_r($referrer_page->points_details_array);
                        
                        /* Save the referrer page */
            //echo $referrer_page;         
                        $referrer_page->referrer_points=$referrer_page->points_details_array;
            //print_r($referrer_page->referrer_points);
                         $referrer_page->of(false);
            			$referrer_page->save();
            	//}
            		/* Referral code END */
            		
            		$email=$referrer_page->referrer_email;
            		 //$email="amrutaj.zerovaega@gmail.com";
                        $title =$referrer_points_new_entry->title;
                        $subject ="Pride Circle TAG : Sorry! ".$np->preferred_name." has been Rejected.";
                        
                          $link =$pages->get("name=universe")->httpUrl;
                        
                        $message ="Dear ".$referrer_page->title."<br><br>Thank you for your referral. Regret to inform you that ".$np->preferred_name." doesn’t belong to the LGBT+ community. Request you to submit LGBT+ candidates only.<br><br>Note: There will be a penalty for referring more than five non LGBT+ candidates. <br><br><a href='".$link."'><button id='btn_register' style='color: #fff;
                             background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
                	
                // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
                // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                		try {
                		    send_smtp_mail($email,$message,$subject);
                			//mail($email, $subject, $message, $headers);
                			$is_email_sent=true;
                		} catch (Exception $e) {
                			$error_message = true;
                		}
                    
                }
                elseif($np->lgbtq_verification=="Confirmed" && $input->post->lgbtq_verification=="Rejected"){
                    //$referrer_points_new_entry->points = 1;
                    
                     /* object to add to referrer's point details json */
            		    $referrer_points_new_entry = new stdClass;
            		    $referrer_points_new_entry->timestamp = time() + 60*60*5.50;
            		    $referrer_points_new_entry->points =50;
                        $referrer_points_new_entry->points_increment_decrement = "decrement";
            		    $referrer_points_new_entry->candidate_page_id = $np->id;
            		    $referrer_points_new_entry->title = "Referral Rejected";
            		    $referrer_points_new_entry->message = "Regret to inform you that ".$np->preferred_name. " does not belong to the LGBT+ community.";
            		    /* object to add to referrer's point details json END */
            //print_r($referrer_points_new_entry);		    
            		    /* Get the JSON of points details from the referrer page */
                        $referrer_points_json = $referrer_page->referrer_points;
                        
                        /* If the JSON is empty, create an empty array */
                        if($referrer_points_json == ""){
                            $referrer_points_json='{"points_details_array":[]}';
                        }
            // print_r($referrer_points_json);            
            // echo "**************************************";
                        /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
                        $referrer_points_object = json_decode($referrer_points_json);
                        $referrer_points_object->points_details_array[] = $referrer_points_new_entry;
                        $referrer_page->points_details_array = json_encode($referrer_points_object);
            //print_r($referrer_points_json);        
            //echo "------------------------------------";
            // print_r($referrer_points_object);
            // echo "///////////////////////////////////////////";
            // print_r($referrer_page->points_details_array);
                        
                        /* Save the referrer page */
            // echo $referrer_page;         
                        $referrer_page->referrer_points=$referrer_page->points_details_array;
           ///print_r($referrer_page->referrer_points);
                         $referrer_page->of(false);
            			$referrer_page->save();
            	//}
            		/* Referral code END */
            		
            			$email=$referrer_page->referrer_email;
            			// $email="amrutaj.zerovaega@gmail.com";
                        $title =$referrer_points_new_entry->title;
                        $subject ="Pride Circle TAG : Update on your referral ".$np->preferred_name;
                        
                         $link =$pages->get("name=universe")->httpUrl;
                        
                        $message ="Dear ".$referrer_page->title."<br><br>Thank you for your referral. Regret to inform you that ".$np->preferred_name." has been confirmed to the Pride Circle team that they do not belong to the LGBT+ community. As a result of this we will deduct 50 points.<br> 
        				Keep referring. <br><br> 
        				
        				Note: There will be a penalty for referring more than five non LGBT+ candidates.
        				<br><br><a href='".$link."'><button id='btn_register' style='color: #fff;background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
             
             
                	
                // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
                // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                		try {
                		    send_smtp_mail($email,$message,$subject);
                			//mail($email, $subject, $message, $headers);
                			$is_email_sent=true;
                		} catch (Exception $e) {
                			$error_message = true;
                		}
                    
                }
                elseif($np->lgbtq_verification=="Rejected" && $input->post->lgbtq_verification=="Confirmed"){
                    //$referrer_points_new_entry->points = 1;
                    
                     /* object to add to referrer's point details json */
            		    $referrer_points_new_entry = new stdClass;
            		    $referrer_points_new_entry->timestamp = time() + 60*60*5.50;
            		    $referrer_points_new_entry->points = 50;
                        $referrer_points_new_entry->points_increment_decrement = "increment";
            		    $referrer_points_new_entry->candidate_page_id = $np->id;
            		    $referrer_points_new_entry->title = "Referral Verified!";
            		    $referrer_points_new_entry->message = "Congratulations!! Your referral ".$np->preferred_name. " has been successfully verified.";
            		    /* object to add to referrer's point details json END */
            //print_r($referrer_points_new_entry);		    
            		    /* Get the JSON of points details from the referrer page */
                        $referrer_points_json = $referrer_page->referrer_points;
                        
                        /* If the JSON is empty, create an empty array */
                        if($referrer_points_json == ""){
                            $referrer_points_json='{"points_details_array":[]}';
                        }
            // print_r($referrer_points_json);            
            // echo "**************************************";
                        /* Decode the JSON and add the points details object to the array. Then encode it aagain to save into the referrer_points field. */
                        $referrer_points_object = json_decode($referrer_points_json);
                        $referrer_points_object->points_details_array[] = $referrer_points_new_entry;
                        $referrer_page->points_details_array = json_encode($referrer_points_object);
            //print_r($referrer_points_json);        
            //echo "------------------------------------";
            // print_r($referrer_points_object);
            // echo "///////////////////////////////////////////";
            // print_r($referrer_page->points_details_array);
                        
                        /* Save the referrer page */
           // echo $referrer_page;         
                        $referrer_page->referrer_points=$referrer_page->points_details_array;
            //print_r($referrer_page->referrer_points);
                         $referrer_page->of(false);
            			$referrer_page->save();
            	//}
            		/* Referral code END */
            		
            			$email=$referrer_page->referrer_email;
            			// $email="amrutaj.zerovaega@gmail.com";
                        $title =$referrer_points_new_entry->title;
                        $subject ="Pride Circle TAG : Update on your referral ".$np->preferred_name;
                        
                         $link =$pages->get("name=universe")->httpUrl;
        				 
                        $message ="Dear ".$referrer_page->title."<br><br> Thank you for your referral. We would like to inform you that ".$np->preferred_name." has been confirmed to the Pride Circle team that they belong to the LGBT+ community. As a result of this we will add 50 points.<br> 
        				Keep referring. <br><br><a href='".$link."'><button id='btn_register' style='color: #fff;
                             background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Log in to dashboard</button></a><br><br>From,<br>Team Pride Circle";
             
                	
                // 		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
                // 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                		try {
                		    send_smtp_mail($email,$message,$subject);
                			//mail($email, $subject, $message, $headers);
                			$is_email_sent=true;
                		} catch (Exception $e) {
                			$error_message = true;
                		}
                    
                }
            
                	
            }
        
             /* Save LGBT+ verification */
            $np->lgbtq_verification = $sanitizer->text($input->post->lgbtq_verification);
            $np->of(false);
        	$np->save();
            //echo "******************//////////////////**************";
            //   echo $np->lgbtq_verification;
                                    		        

    }
		/* Upload of redacted Resume END */
//echo "8";
		/* Save the page with uploaded files. */
$data_to_return->msg[]="np2";
// 		$np->of(false);
// 		$np->save();

    
if($data_to_return->error!=true){
$data_to_return->msg[]= "10";
$data_to_return->msg[]="np1";
		/* Save the page with the text values from POST form input */
    		// $np->of(false);
    		// $np->save();
$data_to_return->msg[]="4";
			/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
//     			if($pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth.",template=candidate_page")->id != 0){
//     				$data_to_return->profile_created = true;
    			
// $data_to_return->msg[]="5";
//     			}
//     			else{
//     				$data_to_return->error = true;
//     				//echo"2";
//     				$data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
//     				echo json_encode($data_to_return);
//     				exit();
//         			}
    		
            }
            else{
    //             $data_to_return->error = true;
				// //echo"2";
				// $data_to_return->error_text[] = "Plese Check all feilds.";
				// echo json_encode($data_to_return);
				// exit();
            }
			
		

//echo "9";
		/* code by Amruta Jagatap 26-11-2020 */
		/** check uploaded file is pdf or not using processwire ext property*/
// 		if($is_resume_uploaded)
// 		{
// 			$candidate_id = $np->id;
// 			if($np->resume->first()->ext =='pdf' ){
// 			/** install pdfparser-master and composer then inlude for pdf reading */
// 			// Include Composer autoloader if not already done.
// include(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/autoload.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
			
// 			// Parse pdf file and build necessary objects.
// 			$parser = new \Smalot\PdfParser\Parser();
// 			// $pdf    = $parser->parseFile('Complaint_And_Monitoring_Docfinal.pdf');
// 			/** get uploaded file in processwire or db is assing to $pdf */
// 			$pdf    = $parser->parseFile("../../..".$np->resume->first()->url);
// 			/** for reading text of pdf use getText() is assign to $text */
// 			$text = $pdf->getText();
// 			/** All extracting text is set to new page means candidate page resume_content field */
// 			$np->resume_contents=$text;

// 			/** get All skills matrix from skill matrix page */
// 			$skill_matrix_page=$pages->get("name=skill-matrix");
// 			$tech_skill_matrix=$skill_matrix_page->technical_skills_matrix;
// 			$non_tech_skill_matrix=$skill_matrix_page->non_technical_skills_matrix;
// 			$soft_skill_matrix=$skill_matrix_page->soft_skills_matrix;
// 			//$old_skill_matrix=$skill_matrix_page->old_skills_matrix;
// 			//$data_to_return->data_return_temp=$tech_skill_matrix;

// 			/**call synonyms add to perticular skill secction function. function name is find_skill_synonyms   */
// 			/** in find_skill_synonyms function pass candidate skills , pdf resume content and skill matrix data of skill matrix page */
// 			/** this function assign to data_to_return technical_skils_to_confirm, non_technical_skills_to_confirm, soft_skills_to_confirm*/
// 				// $data_to_return->technical_skills_to_confirm=find_skill_synonyms($np->technical_skills,$np->resume_contents,$tech_skill_matrix);

// 				// $data_to_return->non_technical_skills_to_confirm=find_skill_synonyms($np->non_technical_skills,$np->resume_contents,$non_tech_skill_matrix);

// 				// $data_to_return->soft_skills_to_confirm=find_skill_synonyms($np->soft_skills,$np->resume_contents,$soft_skill_matrix);
// //print_r($data_to_return);

// 				/** this 3 comfirm skills array store in skills_to_confirm in data_to_return and skills_to_confirm array pass to ajax function */
// 				//$data_to_return->skills_to_confirm=true;

// 				// if(sizeof($data_to_return->technical_skills_to_confirm) ==0 && sizeof($data_to_return->non_technical_skills_to_confirm)==0 && sizeof($data_to_return->soft_skills_to_confirm)==0){}
// 				// else{
// 				// 	$data_to_return->skills_to_confirm=true;
// 				// }
// 				/** new page id means candidate id assign to candidate_id variable in data_to_return */
// 				$data_to_return->candidate_id=$np->id;
// 				$np->of(false);
// 				/** save resume_content text in candidate page */
// 				$np->save();
// 			}
// 			else{
// 				/** if uploaded file is not pdf then resume_content feild is clear or empty */
// 				$np->resume_contents='';
// 				$np->of(false);
// 				/** save page */
// 				$np->save();
// 			}
// 			/**End pdf reading section */
// 		}	
		/* End code by Amruta Jagatap 26-11-2020*/

		/* Candidate profile has been created/edited at this point. */

		/* Send an email to the candidate about the successful registration. Only send in case of creating new page.
		if ($data_to_return->error == false && $data_to_return->profile_created == true && $np->email !=""){
			$subject = "Pride Circle Resume Portal : Profile Created!";
			$message = "Greetings from Pride Circle!\n\nYour profile has been successfully registered. You can visit your profile and edit it on the following link- \n\n ".$np->httpUrl;
			$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

			try {
				mail($np->email, $subject, $message, $headers);
			} catch (Exception $e) {
			}
		}
		/* Send an email to the candidate about the successful registration END */

		/* Just in case javascript is not enabled on the page and AJAX cannot run, the form will be submitted in a default fashion. In such case, the redirection will not happen on the front end and will take place on the back end. Thus, in the AJAX code, a parameter is added named 'ajax=true' with the POST method.  This code will check if the request is coming from AJAX or not and act accordingly.*/
		if(isset($input->post->ajax)){
			echo json_encode($data_to_return);
		}
		else{
$data_to_return->msg[]= "18";
			
			header("Location:".$np->httpUrl);
			
			
		}


		/* Redirect to the display page of the candidate profile. */
		//header("Location:".$np->httpUrl);
		//header("Location:".$config->urls->httpRoot."edit-application/");
	}
	/* If no POST request has been made, and no user is logged in */
	else{

		$data_to_return->error = true;
	//	echo"3";
		$data_to_return->error_text[] = "Something went wrong. Please log in and try again.";

		echo json_encode($data_to_return);
		exit();
		//header("Location: ".$config->urls->httpRoot);
	}
?>