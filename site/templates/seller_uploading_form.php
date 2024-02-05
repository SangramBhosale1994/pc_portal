<?php
	header('Content-Type: application/json');
	
//print_r($_POST);
	/* Create an object where all the data to be returned after finishing the process of this page is saved. This includes error and success messages, statuses etc */
	global $data_to_return;
	//global $candidate_id;
	$data_to_return = new stdClass;
	$data_to_return->profile_created = false;
// 	$data_to_return->profile_to_edit = false;
// 	$data_to_return->profile_edited = false;
	$data_to_return->error = false;
	$data_to_return->error_text = array();
	//$data_to_return->profile_url = "";
//	$data_to_return->skills_to_confirm=false;
	//$data_to_return->post_data = $_POST;
//echo"abc";
	/* Check if the POST query is done or not. Exit saving and displaying error if not. */
	if(!isset($_POST)){
		$data_to_return->error = true;
//echo"1";
		$data_to_return->error_text[] = "Something went wrong. Please try again";

		//echo json_encode($data_to_return);
		exit();
	}
// 	if($session->user_designation == "admin" && $input->post->page_to_edit_id != ""){
// // 		$temp_page = $pages->get("name=seller-profiles")->child("id=".$input->post->page_to_edit_id.",template=candidate_page");
// // 		$profile_oauth = $temp_page->oauth_gmail;
// 	}else{
// 		/* If admin hasn't logged in, use the session gmail of the user who has logged in and save its login email to $profile_oauth */
// 		$profile_oauth =  $session->oauth_gmail;
// 	}
	    $email=$session->email;
//echo $email;                   
		/* Save the link to the profile page in the data_to_return object.  */
		//$data_to_return->profile_url = $np->httpUrl;
		
			/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets ;//. "files/temp-files/";
//if($upload_path){	
// 	    if($email){
// 	    $seller_page=$pages->get("name=seller-profiles")->child("seller_email=".$email);
// 				$data_to_return->profile_created = true;
// //echo"7";
// 			}
	$seller_page=$pages->get("name=seller-profiles")->child("seller_email=".$email);
//	print_r($seller_page);
				$data_to_return->profile_created = true;	
			
		$seller_page->gst_number = $sanitizer->text($input->post->gst_number);
		$seller_page->pan_number = $sanitizer->text($input->post->pan_number);
		$seller_page->bank_account_number = $sanitizer->text($input->post->account_number);
		$seller_page->bank_ifsc_code = $sanitizer->text($input->post->ifsc_code);
		$seller_page->address = $sanitizer->textarea($input->post->registered_address);
		$seller_page->bank_account_holder_name = $sanitizer->text($input->post->account_holder_name);
		$seller_page->account_type = $sanitizer->text($input->post->account_type);
		$seller_page->bank_name = $sanitizer->text($input->post->bank_name);
		$seller_page->bank_branch_name = $sanitizer->text($input->post->bank_branch);
		
		$seller_page->of(false);
		$seller_page->save();
		
// 			foreach($files as $filename) {
// 				$pathname = $upload_path . $filename;
// 				$seller_page->document_first->add($pathname);
// 				$seller_page->message("Added file: $filename");
// 				unlink($pathname);
// 			}
			
	
		/* Uploading and saving of Resume. (Same process as image upload) */
// 		$document_first = new WireUpload('document_legal_agreement');
// //echo $resume;
// 		$document_first->setMaxFiles(1);
// 		$document_first->setOverwrite(false);
// 		$document_first->setDestinationPath($upload_path);

// 		$document_first->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

// 		$files_document_first = $document_first->execute();

// 		$is_document_first_uploaded = false;
// //echo count($files_document_first);
// 		if(!count($files_document_first) && $data_to_return->profile_to_edit){

// 		}
// 		elseif(!count($files_document_first)){
// // 			$data_to_return->error = true;
// // 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
// 		}
// 		else{
// 			if($seller_page->document_first){
// 			    $seller_page->of(false);
// 				$seller_page->document_first->deleteAll();
				
// 				$seller_page->save();
// 			}
//         //$seller_file=$seller_page->document_first;
// 			foreach($files_document_first as $filename) {
// 				$pathname = $upload_path . $filename;
// 				//echo $pathname;
// 				//$seller_file->add($filename,$pathname);
// 				//echo $seller_file;
// 					$seller_page->of(false);
// 				$seller_page->document_first->add($pathname);
// 				$seller_page->of(false);
// 				$seller_page->save();
                    
// 				$seller_page->message("Added file:".$filename);
// 				unlink($pathname);
// 			}

// 			$is_document_first_uploaded = true;
// 		}
		/* Uploading and saving of Resume END */
		
/* Uploading and saving of Resume. (Same process as image upload) */
		$document_second = new WireUpload('document_onboarding_form');
//echo $resume;
// echo "1";
// echo time();
// echo "\n";
		$document_second->setMaxFiles(1);
		$document_second->setOverwrite(false);
		$document_second->setDestinationPath($upload_path);
// echo "2";
// echo time();
// echo "\n";
		$document_second->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_second = $document_second->execute();

		$is_document_second_uploaded = false;
//echo count($files_document_second);
// 		if(!count($files_document_second) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_second)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_second){
			    $seller_page->of(false);
				$seller_page->document_second->deleteAll();
// echo "3";
// echo time();
// echo "\n";
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_second as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_second->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
// echo "4";
// echo time();  
// echo "\n";
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_second_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		
/* Uploading and saving of Document third. (Same process as image upload) */
		$document_third = new WireUpload('document_pan');
//echo $resume;
// echo "5";
// echo time();
// echo "\n";
		$document_third->setMaxFiles(1);
		$document_third->setOverwrite(false);
		$document_third->setDestinationPath($upload_path);

		$document_third->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_third = $document_third->execute();

		$is_document_third_uploaded = false;
//echo count($files_document_third);
// 		if(!count($files_document_third) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_third)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your Document.";
		}
		else{
			if($seller_page->document_third){
			    $seller_page->of(false);
				$seller_page->document_third->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_third as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_third->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
//  echo "6";
// echo time(); 
// echo "\n";
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_third_uploaded = true;
		}
/* Uploading and saving of Document third END */

/* Uploading and saving of Document four. (Same process as image upload) */
		$document_fourth = new WireUpload('document_gst');
//echo $resume;
		$document_fourth->setMaxFiles(1);
		$document_fourth->setOverwrite(false);
		$document_fourth->setDestinationPath($upload_path);

		$document_fourth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_fourth = $document_fourth->execute();

		$is_document_fourth_uploaded = false;
//echo count($files_document_fourth);
// 		if(!count($files_document_fourth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_fourth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your Document.";
		}
		else{
			if($seller_page->document_fourth){
			    $seller_page->of(false);
				$seller_page->document_fourth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_fourth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_fourth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_fourth_uploaded = true;
		}
/* Uploading and saving of document_fourth END */

		/* Uploading and saving of Resume. (Same process as image upload) */
		$document_fifth = new WireUpload('document_pan_directors');
//echo $resume;
		$document_fifth->setMaxFiles(1);
		$document_fifth->setOverwrite(false);
		$document_fifth->setDestinationPath($upload_path);

		$document_fifth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_fifth = $document_fifth->execute();

		$is_document_fifth_uploaded = false;
//echo count($files_document_first);
// 		if(!count($files_document_fifth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_fifth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_fifth){
			    $seller_page->of(false);
				$seller_page->document_fifth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_fifth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_fifth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_fifth_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		
			/* Uploading and saving of Resume. (Same process as image upload) */
		$document_sixth = new WireUpload('document_cancelled_cheque');
//echo $resume;
		$document_sixth->setMaxFiles(1);
		$document_sixth->setOverwrite(false);
		$document_sixth->setDestinationPath($upload_path);

		$document_sixth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_sixth = $document_sixth->execute();

		$is_document_sixth_uploaded = false;
//echo count($files_document_first);
// 		if(!count($files_document_sixth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_sixth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_sixth){
			    $seller_page->of(false);
				$seller_page->document_sixth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_sixth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
				$seller_page->of(false);
				$seller_page->document_sixth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_sixth_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		
		
			/* Upload of redacted Resume. (Only by the admin when editing.) */
		/** Check if the page is being edited and by the admin. Procees if true. */
// 		if($data_to_return->profile_to_edit && $session->user_designation == "admin"){
// 			/*** Same uploding procedure as image upload. */
// 			$redacted_resume = new WireUpload('redacted_resume');
// 			$redacted_resume->setMaxFiles(1);
// 			$redacted_resume->setOverwrite(false);
// 			$redacted_resume->setDestinationPath($upload_path);
// 			$redacted_resume->setValidExtensions(array('pdf', 'docx', 'doc'));

// 			$files_redacted_resume = $redacted_resume->execute();

// 			if(count($files_redacted_resume)){
// 				if($np->redacted_resume){
// 					$np->redacted_resume->deleteAll();
// 				}

// 				foreach($files_redacted_resume as $filename) {
// 					$pathname = $upload_path . $filename;
// 					$np->redacted_resume->add($pathname);
// 					$np->message("Added file: $filename");
// 					unlink($pathname);
// 				}
// 			}
// 		}
		/* Upload of redacted Resume END */

		/* Save the page with uploaded files. */
		$seller_page->of(false);
		$seller_page->save();
		
		$session->seller_form_submit=true;
		
		if(isset($input->post->ajax)){
			echo json_encode($data_to_return);
		}
		else{
			header("Location:".$seller_page->httpUrl);
			//header("Location:".$urls->httpRoot."universe/?universal_logout=true");
		}
//	}
		//print_r($data_to_return);
//else{
		//$data_to_return->error = true;
	//	echo"3";
		//$data_to_return->error_text[] = "Something went wrong. Please log in and try again.";

		//echo json_encode($data_to_return);
		exit();
		//header("Location: ".$config->urls->httpRoot);
	//}
	
?>