<?php
     /* Amruta Jagtap 2021-03-12 Save Edit job profile and upload job image */
    if(isset($_POST['edit_profile_modal_submit'])){
    /* Get the job page to edit based on the ID */
	//	$job_page_to_change = \ProcessWire\wire('pages')->get($edit_job_details_to_save['id']);
		$edit_job_page_id = $sanitizer->text($input->post->edit_profile_job_id);
		
		$job_page_to_change = $pages->get("name=jobs")->child("id=".$edit_job_page_id);
		
		$job_page_to_change->of(false);

		/* Save the data */
		$job_page_to_change->title =$sanitizer->text($input->post->job_title);
		$job_page_to_change->company_name = $sanitizer->text($input->post->job_company_name);
		//$new_job_page->experience = $new_job_details_to_save['job_experience_max']."-".$new_job_details_to_save['job_experience_min'];
        $job_page_to_change->max_experience = $sanitizer->text($input->post->job_experience_max);
        $job_page_to_change->min_experience = $sanitizer->text($input->post->job_experience_min);
		$job_page_to_change->location = $sanitizer->text($input->post->job_location);
		$job_page_to_change->skills = $sanitizer->textarea($input->post->job_skills);
		$job_page_to_change->position = $sanitizer->text($input->post->job_position);
		$job_page_to_change->ctc = $sanitizer->text($input->post->job_ctc);
		$job_page_to_change->summary = $sanitizer->purify($input->post->job_summary);
		//$new_job_page->job_code = $new_job_details_to_save['job_job_code'];
		$job_page_to_change->job_type = $sanitizer->text($input->post->job_type);
		$job_page_to_change->job_sector = $sanitizer->text($input->post->job_sector);
		$job_page_to_change->active_status = $sanitizer->text($input->post->active_status);
		$job_page_to_change->application_deadline = $sanitizer->text($input->post->job_application_deadline);
		$job_page_to_change->job_publish_shedule = $sanitizer->text($input->post->job_publish_shedule);
        $job_page_to_change->is_hot_jobs = $sanitizer->text($input->post->hot_jobs);
		if($input->post->edit_job_show_popup != ""){
			$job_page_to_change->is_popup_show_event = $sanitizer->text($input->post->edit_job_show_popup);
		}
		else{
			$job_page_to_change->is_popup_show_event = "hide";
		}
// 		$job_page_to_change->verification = $sanitizer->text($input->post->active_status);
		//$sanitizer->text($input->post->active_status);
        // echo $input->post->job_publish_shedule;
        // echo "**********";
        // echo $job_page_to_change->job_publish_shedule;

		/* Save page */
		//$job_page_to_change->save();
		
					/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets;//. "files/temp-files/";

		/* Uploading and saving of profile image */
		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
		$job_page_to_change_image = new \ProcessWire\WireUpload('edit_job_profile_image');
//print_r($job_page_to_change_image);

		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
		$job_page_to_change_image->setMaxFiles(1);
		$job_page_to_change_image->setOverwrite(true);
		$job_page_to_change_image->setDestinationPath($upload_path);
		$job_page_to_change_image->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
		$files = $job_page_to_change_image->execute();
		
		
 			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
 			if(count($files)){
				if($job_page_to_change->job_image){
					$job_page_to_change->job_image->deleteAll();
				}
//echo "7";
				foreach($files as $filename) {

    				$pathname = $upload_path . $filename;
    
    				$job_page_to_change->job_image->add($pathname);
    
    				$job_page_to_change->message("Added file: $filename");
    
    				unlink($pathname);
    			}
			}

		/* Save page */
		$job_page_to_change->of(false);
		$job_page_to_change->save();
		//echo "Job Edited Successfully!";
        header("Location: ".$job_page_to_change->httpUrl);
    }
    /* Amruta Jagtap 2021-03-12 End Save Edit job profile and upload job image */
    
?>