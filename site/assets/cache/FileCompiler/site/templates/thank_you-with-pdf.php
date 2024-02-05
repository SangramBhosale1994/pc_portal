<?php
	header('Content-Type: application/json');

	/* Create an object where all the data to be returned after finishing the process of this page is saved. This includes error and success messages, statuses etc */
	$data_to_return = new stdClass;
	$data_to_return->profile_created = false;
	$data_to_return->profile_to_edit = false;
	$data_to_return->profile_edited = false;
	$data_to_return->error = false;
	$data_to_return->error_text = array();
	$data_to_return->profile_url = "";
	//$data_to_return->post_data = $_POST;

	/* Check if the POST query is done or not. Exit saving and displaying error if not. */
	if(!isset($_POST)){
		$data_to_return->error = true;
		$data_to_return->error_text[] = "Something went wrong. Please try again";

		echo json_encode($data_to_return);
		exit();
	}

	/* If the ADMIN is logged in and the POST query contains page_edit_id, get that page and save its login email to $profile_oauth */
	if($session->user_designation == "admin" && $input->post->page_to_edit_id != ""){
		$temp_page = $pages->get("name=candidates")->child("id=".$input->post->page_to_edit_id.",template=candidate_page");
		$profile_oauth = $temp_page->oauth_gmail;
	}else{
		/* If admin hasn't logged in, use the session gmail of the user who has logged in and save its login email to $profile_oauth */
		$profile_oauth =  $session->oauth_gmail;
	}

	/* Check if a POST request has been made and the data (email here) is sent along with it, and the $profile_oauth should not be empty. Proceed if true */
	if($input->post->email && $profile_oauth != ""){
		/* Define a $np (New Page) variable for creating or getting page */
		$np= "";

		/* check if the page is to be created or edited */
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth.",template=candidate_page")->id != 0){
			/* Get reference to the page to be edited */
			$np = $pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth.",template=candidate_page");
			$data_to_return->profile_to_edit = true;
		}
		/** Else if the page doesn't alreasy exist and this is a new entry */
		else{
			/*** Basic Page Creation Info */
			$np = new Page();
			$np->template = $templates->get("candidate_page");
			$np->parent = $pages->get("name=candidates");
			$np->title = time().mt_rand(10,99);
			/*** Basic Page Creation Info End */

			/*** Save the page with unique email-ID */
			$np->oauth_gmail = $profile_oauth;

			/*** Serial ID created from the ID counter page */
			/**** Get serial ID from the serial ID page */
			$serial_id_counter_page = $pages->get("name=serial_id_counter_page");
			/**** Assign the given ID to the  new page and increment the number for the next page */
			$np->serial_id = $serial_id_counter_page->serial_id++;

			/**** save the incremented ID page */
			$serial_id_counter_page-> of(false);
			$serial_id_counter_page->save();
			/*** Serial ID created from the ID counter page END */

			/*** Save the newly created candidate page with bare minimum requirements so that a candidate profile is created */
			$np->of(false);
			$np->save();

			/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
			if($pages->get("name=candidates")->child("oauth_gmail=".$profile_oauth.",template=candidate_page")->id != 0){
				$data_to_return->profile_created = true;
			}
			else{
				$data_to_return->error = true;
				$data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
				echo json_encode($data_to_return);
				exit();
			}
		}
		/* Check if the page is to be created or edited END */

		/* Save the link to the profile page in the data_to_return object.  */
		$data_to_return->profile_url = $np->httpUrl;

		/* Text Data From The Form (sanitized) */
		$np->first_name = $sanitizer->text($input->post->first_name);
		$np->last_name = $sanitizer->text($input->post->last_name);
		$np->preferred_name = $sanitizer->text($input->post->preferred_name);
		/** Check if 'other' is selected. If yes, go for the custom input. (for pronoun, out_at_work, identify_as, qualification etc multiple choice type inputs) */
		$np->pronoun = $sanitizer->text(($input->post->pronoun == 'other')?$input->post->pronoun_custom : $input->post->pronoun);
		$np->out_at_work = $sanitizer->text($input->post->out_at_work);
		$np->identify_as = $sanitizer->text(($input->post->identify_as == 'other')?$input->post->identify_as_custom : $input->post->identify_as);
		$np->date_of_birth = $sanitizer->text($input->post->date_of_birth);
		$np->email = $sanitizer->email($input->post->email);
		$np->phone_country_code = $sanitizer->text($input->post->phone_country_code);
		$np->phone_number = $sanitizer->text($input->post->phone_number);
		$np->current_city = $sanitizer->text(($input->post->current_city == 'other')?$input->post->current_city_custom : $input->post->current_city);
		$np->current_state = $sanitizer->text($input->post->current_state);
		$np->linkedin_url = $sanitizer->text($input->post->linkedin_url);

		$np->qualification = $sanitizer->text(($input->post->qualification == 'other')?$input->post->qualification_custom : $input->post->qualification);
		$np->course = $sanitizer->text(($input->post->course == 'other')?$input->post->course_custom : $input->post->course);
		$np->specialisation = $sanitizer->text($input->post->specialisation);
		$np->year_of_passing = $sanitizer->text($input->post->year_of_passing);
		$np->college = $sanitizer->text($input->post->college);
		$np->cartifications = $sanitizer->text($input->post->cartifications);

		$np->industry = $sanitizer->text(($input->post->industry == 'other')?$input->post->industry_custom : $input->post->industry);
		$np->functional_area = $sanitizer->text(($input->post->functional_area == 'other')?$input->post->functional_area_custom : $input->post->functional_area);
		$np->experience_years = $sanitizer->text($input->post->experience_years);
		$np->experience_months = $sanitizer->text($input->post->experience_months);
		$np->current_employer = $sanitizer->text($input->post->current_employer);
		$np->current_role = $sanitizer->text($input->post->current_role);
		$np->technical_skills = $sanitizer->text($input->post->technical_skills);
		$np->non_technical_skills = $sanitizer->text($input->post->non_technical_skills);
		$np->soft_skills = $sanitizer->text($input->post->soft_skills);
		$np->current_ctc_time = $sanitizer->text($input->post->current_ctc_time);
		$np->current_ctc = $sanitizer->text($input->post->current_ctc);
		$np->preferred_location1 = $sanitizer->text($input->post->preferred_location1);
		$np->preferred_location2 = $sanitizer->text($input->post->preferred_location2);
		$np->preferred_location3 = $sanitizer->text(($input->post->preferred_location3 == 'other')?$input->post->preferred_location_custom : $input->post->preferred_location3);
		$np->pwd_accomodation = $sanitizer->text($input->post->pwd_accomodation);
		$np->referred_by = $sanitizer->text($input->post->referred_by);
		$np->referrer_email = $sanitizer->text($input->post->referrer_email);
		$np->job_code = $sanitizer->text($input->post->job_code);

		/** Assign active_status. (Default 'active to new pages; change according to POST input for page editing. This can only be edited by an admin. So no compulsory action done here on active_status unless needed.) */
		if($input->post->active_status){
			$np->active_status = $sanitizer->text($input->post->active_status);
		}elseif(!$data_to_return->profile_to_edit){
			$np->active_status = "Active";
		}
		/* Text Data From The Form End */

		/* Save the page with the text values from POST form input */
		$np->of(false);
		$np->save();
		/* Save the page with the text values from POST form input END */

		/* If the profile is not created, then it is now edited, Save it in data_to_return */
		if(!$data_to_return->profile_created){
			$data_to_return->profile_edited = true;
		}

		/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets ;//. "files/temp-files/";

		/* Uploading and saving of profile image */
		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
		$contact_photo = new WireUpload('profile_image');

		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
		$contact_photo->setMaxFiles(1);
		$contact_photo->setOverwrite(false);
		$contact_photo->setDestinationPath($upload_path);
		$contact_photo->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
		$files = $contact_photo->execute();

		/** Checking of errors while uploading the files. Run a count($files) test to make sure there are actually files; if so, proceed; if not, generate getErrors() */
		/*** If the application is being edited, there already is an image uploaded, so there is no need to create any errors in case it's an editing request not a create-new-profile one */
		if(!count($files) && $data_to_return->profile_to_edit){

		}
		/*** If $files contains nothing, save the error message. */
		elseif(!count($files)){
			$data_to_return->error = true;
			$data_to_return->error_text[] = "No photo uploaded. Please make sure to upload a picture in .jpg or .png format under 2Mb.";
		}
		/*** Here, $files contains a file. So we proceed to save the image file to the candidate profile page. */
		else{
			/**** Delete the previous image available if the page is being edited. */
			if($data_to_return->profile_to_edit){
				$np->profile_image->deleteAll();
			}

			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
			foreach($files as $filename) {
				$pathname = $upload_path . $filename;
				$np->profile_image->add($pathname);
				$np->message("Added file: $filename");
				unlink($pathname);
			}
		}
		/* Uploading and saving of profile image END */

		/* Uploading and saving of Resume. (Same process as image upload) */
		$resume = new WireUpload('resume');

		$resume->setMaxFiles(1);
		$resume->setOverwrite(false);
		$resume->setDestinationPath($upload_path);

		$resume->setValidExtensions(array('pdf', 'docx', 'doc'));

		$files_resume = $resume->execute();

		if(!count($files_resume) && $data_to_return->profile_to_edit){

		}
		elseif(!count($files_resume)){
			$data_to_return->error = true;
			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($data_to_return->profile_to_edit){
				$np->resume->deleteAll();
			}

			foreach($files_resume as $filename) {
				$pathname = $upload_path . $filename;
				$np->resume->add($pathname);
				$np->message("Added file: $filename");
				unlink($pathname);
			}

			/* Save text from PDF Resume to the candidate page */
$data_to_return->ext = $np->resume->first->ext;
			/** Check if the file saved is a PDF; else this step is skipped **/
			if($np->resume->first->ext == "pdf"){
				/* include the library to read the PDF */
				include "vendor/autoload.php";

$directory = getcwd();
$file = 'files/faq_21DaysAllyChallenge.pdf';
//$fullfile = $directory . '/' . $file;

				/* Save path to the file */
				$full_pdf_file_path = $np->resume->first->httpUrl;
				
				/* Variable to save the content of the file  */
				$pdf_content = '';

				/* Create object of the library to read the content */
				$pdf_parser = new \Smalot\PdfParser\Parser();
				$pdf_document = $pdf_parser->parseFile($full_pdf_file_path);

				// /* Get array of the pages in the PDF */
				// $pdf_pages    = $pdf_document->getPages();

				// /* Run loop on all the pages to read each one and save it at a time */
				// foreach ($pdf_pages as $pdf_page) {
				// 	$pdf_content .= $pdf_page->getText();
				// }

				// /* Save the extracted text to the candidate's page. */
				// $np->resume_contents = $pdf_content;
//$data_to_return->resume_contents = $pdf_content;
			}
			/* Save text from PDF Resume to the candidate page END */
		}
		/* Uploading and saving of Resume END */

		

		/* Upload of redacted Resume. (Only by the admin when editing.) */
		/** Check if the page is being edited and by the admin. Procees if true. */
		if($data_to_return->profile_to_edit && $session->user_designation == "admin"){
			/*** Same uploding procedure as image upload. */
			$redacted_resume = new WireUpload('redacted_resume');
			$redacted_resume->setMaxFiles(1);
			$redacted_resume->setOverwrite(false);
			$redacted_resume->setDestinationPath($upload_path);
			$redacted_resume->setValidExtensions(array('pdf', 'docx', 'doc'));

			$files_redacted_resume = $redacted_resume->execute();

			if(count($files_redacted_resume)){
				if($np->redacted_resume){
					$np->redacted_resume->deleteAll();
				}

				foreach($files_redacted_resume as $filename) {
					$pathname = $upload_path . $filename;
					$np->redacted_resume->add($pathname);
					$np->message("Added file: $filename");
					unlink($pathname);
				}
			}
		}
		/* Upload of redacted Resume END */

		/* Save the page with uploaded files. */
		$np->of(false);
		$np->save();


$data_to_return->error = true;
$data_to_return->error_text[] = "Something went wrong. Please log in and try again.";

echo json_encode($data_to_return);
exit();


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
			header("Location:".$np->httpUrl);
		}


		/* Redirect to the display page of the candidate profile. */
		//header("Location:".$np->httpUrl);
		//header("Location:".$config->urls->httpRoot."edit-application/");
	}
	/* If no POST request has been made, and no user is logged in */
	else{
		$data_to_return->error = true;
		$data_to_return->error_text[] = "Something went wrong. Please log in and try again.";

		echo json_encode($data_to_return);
		exit();
		//header("Location: ".$config->urls->httpRoot);
	}
?>