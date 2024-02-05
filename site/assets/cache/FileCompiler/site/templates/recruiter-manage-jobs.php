<?php
	if($session->user_designation=="admin"){
 require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
	elseif($session->user_designation=="editor"){
 require_once(\ProcessWire\wire('files')->compile('includes/editor-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
	else{
 require_once(\ProcessWire\wire('files')->compile('includes/recruiter-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
	
	/*Amruta Jagtap 14-03-2021 Save new create job profile and upload image to database*/
	
	$job_added_response="";
	if($session->job_added==true){
	    $job_added_response="Job has been successfuly added!";
	    $session->job_added="";
	}

    if($session->job_edited==true){
	    $job_added_response="Job is modify successfuly!";
	    $session->job_edited="";
	}
	
	
	if(isset($_POST['create_new_modal_submit'])){
	    
	    
//echo "1";    
	    // $recruiter_page = \ProcessWire\wire("pages")->get("name=recruiters")->child("id=".$session->user_page_id);
        if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
            $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
        }
        else{
            $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
        }
//echo $session->user_page_id;	    
	    /* Check if the sent array has zero*/
		if($recruiter_page->job_limit == 0){
			echo "New job can not be added. You have 0 job postings remaining.";
		}
		
		if($recruiter_page->job_limit>0){
			//echo $recruiter_page->job_limit;

           
    		/* New job Page info */
    		$new_job_page = \ProcessWire\wire(new \ProcessWire\Page());
    		$new_job_page->template = \ProcessWire\wire('templates')->get("job-page");
    		$new_job_page->parent = \ProcessWire\wire('pages')->get("name=jobs");
    
    		$new_job_page->title =$sanitizer->text($input->post->job_title);
    		/* Save page */
    		$new_job_page->of(false);
    		$new_job_page->save();
		
    		$new_job_page->company_name = $sanitizer->text($input->post->job_company_name);
		//$new_job_page->experience = $new_job_details_to_save['job_experience_max']."-".$new_job_details_to_save['job_experience_min'];
        $new_job_page->max_experience = $sanitizer->text($input->post->job_experience_max);
        $new_job_page->min_experience = $sanitizer->text($input->post->job_experience_min);
		$new_job_page->location = $sanitizer->text($input->post->job_location);
	//	echo "location :".$sanitizer->text($input->post->job_location);
		$new_job_page->skills = $sanitizer->textarea($input->post->job_skills);
	//	echo "skills :".$sanitizer->text($input->post->job_skills);
		$new_job_page->position = $sanitizer->text($input->post->job_position);
		$new_job_page->ctc = $sanitizer->text($input->post->job_ctc);
		$new_job_page->summary =$sanitizer->purify($input->post->job_summary);
	//	echo "job_summary :".$sanitizer->text($input->post->job_summary);
		//$new_job_page->job_code = $new_job_details_to_save['job_job_code'];
		$new_job_page->job_type = $sanitizer->text($input->post->job_type);
	//	echo "job_type :".$sanitizer->text($input->post->job_type);
		$new_job_page->job_sector = $sanitizer->text($input->post->job_sector);
		$new_job_page->application_deadline = $sanitizer->text($input->post->job_application_deadline);
    		$new_job_page->job_added_by = $session->user_page_id;

        // $new_job_page->job_publish_shedule = strtotime(date("Y-m-d h:i:sa"));
        // $new_job_page->last_modified_date = strtotime(date("Y-m-d h:i:sa"));
        $new_job_page->job_publish_shedule = date("Y-m-d");
        $new_job_page->last_modified_date = strtotime(date("Y-m-d h:i:sa"));
        //echo $new_job_page->job_publish_shedule;
        $new_job_page->is_hot_jobs="no";
    		//echo $new_job_page->job_added_by;
    		
    // 		echo "job_title :".$sanitizer->text($input->post->job_title);
    // 		echo "\n job_company_name :".$sanitizer->text($input->post->job_company_name);
    // 		echo "\n job_experience_max :".$sanitizer->text($input->post->job_experience_max);
    // 		echo "\n job_experience_max :".$sanitizer->text($input->post->job_experience_max);
    // 		echo "location :".$sanitizer->text($input->post->job_location);
    // 		echo "\nskills :".$sanitizer->text($input->post->job_skills);
    // 		echo "\njob_summary :".$sanitizer->purify($input->post->job_summary);
    // 		echo "\njob_type :".$sanitizer->text($input->post->job_type);
    // 		echo "\njob_sector :".$sanitizer->text($input->post->job_sector);
    // 		echo "\napplication_deadline :".$sanitizer->text($input->post->job_application_deadline);
    		
        		/* Save page */
    		$new_job_page->of(false);
    		$new_job_page->save();
    		
    			/* Define the temporary path to upload the file before saving the files to the CMS page */
        		$upload_path = $config->paths->assets;//. "files/temp-files/";
        
        		/* Uploading and saving of profile image */
        		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
        		$job_image = new \ProcessWire\WireUpload('job_profile_image');
        //print_r($job_image);
        
        		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
        		$job_image->setMaxFiles(1);
        		$job_image->setOverwrite(true);
        		$job_image->setDestinationPath($upload_path);
        		$job_image->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        
        		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
        		$files = $job_image->execute();
        		
        		
         			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
        
        			foreach($files as $filename) {
        
        				$pathname = $upload_path . $filename;
        
        				$new_job_page->job_image->add($pathname);
        
        				$new_job_page->message("Added file: $filename");
        
        				unlink($pathname);
        			}
        			
        		/* Save page */
        		$new_job_page->of(false);
        		$new_job_page->save();
        		//}
    		
    				/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
    			/**** Get serial ID from the serial ID page */
    			$job_code_serial_id_counter_page = \ProcessWire\wire('pages')->get("name=job-code-serial-id-counter");
    			/**** Assign the given ID to the  new page and increment the number for the next page */
    			$new_job_page->job_code = $job_code_serial_id_counter_page->serial_id++;
    //echo"5";
    			/**** save the incremented ID page */
    			$job_code_serial_id_counter_page-> of(false);
    			$job_code_serial_id_counter_page->save();
    			/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */
    	       
    
    		/* Save page */
    		$new_job_page->of(false);
    		$new_job_page->save();
    		
    		
    	        $recruiter_page->job_limit = $recruiter_page->job_limit-1;
    	        //echo $recruiter_page->job_limit;
    	        
    	        $recruiter_page->of(false);
    	        $recruiter_page->save();
    	        $session->job_added=true;
    	        //echo $session->job_added;
    	        header("Location: ".$page->httpUrl);
		}
    		
	}
    /*Amruta Jagtap 14-03-2021 End Save new create job profile and upload image to database*/


    /* Amruta Jagtap 2022-01-29 Save Edit job profile and upload job image */
    if(isset($_POST['edit_profile_modal_submit'])){
        /* Get the job page to edit based on the ID */
        //	$job_page_to_change = \ProcessWire\wire('pages')->get($edit_job_details_to_save['id']);
		$edit_job_page_id = $sanitizer->text($input->post->edit_profile_job_id);
		// echo $edit_job_page_id;
        // echo "*************";
		$job_page_to_change = $pages->get("name=jobs")->child("id=".$edit_job_page_id);
		//echo $job_page_to_change;
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
		$job_page_to_change->last_modified_date = strtotime(date("Y-m-d h:i:sa"));
        $job_page_to_change->verification="unverified";
        //echo $job_page_to_change->job_publish_shedule;
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
        $session->job_edited=true;
        //echo $session->job_added;
       // echo "data save!";
        header("Location: ".$page->httpUrl);
    }
    /* Amruta Jagtap 2022-01-29 End Save Edit job profile and upload job image */
    
    
?>
	<!-- include summernote css -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<style>
	    .recruiter_job_page_url:hover{
	        text-decoration:none;
	    }
	</style>
				
				<!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
					     <?php 
						        $job_page=$pages->get("name=jobs");
						        //echo $job_page->httpUrl;
						        $job_page_url=$job_page->httpUrl."?company_id=$session->user_page_id";
						        
						   ?>
						   
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
						   <?php
							 if($session->user_designation=="recruiter"){
							 ?>
                            <div>
                                <?php
                                // $recruiter_page = \ProcessWire\wire("pages")->get("name=recruiters")->child("id=".$session->user_page_id);
                                if(\ProcessWire\wire("session")->recruiter_profile_type == "sub-recruiter"){
                                    $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id)->parent();
                                }
                                else{
                                    $recruiter_page = \ProcessWire\wire("pages")->get("id=".\ProcessWire\wire("session")->user_page_id);
                                }
                                /* Check if the sent array has zero*/
                                // echo $recruiter_page->id;
                                // echo $recruiter_page->job_limit;
                                // echo $session->subscription_expired;

                                if($session->subscription_expired || $recruiter_page->job_limit == 0){
                               
                                    // echo "if";
                                }
                                else{
                                    // echo "else";
                                ?>
                                    <button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#create_new_modal" ><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> New Job</button>
                                <?php
                                }
                                ?>							   
                                 <?php 
							        $bg_color="";
							         $text_color="";
							         $px="";
							         $py="";
							        if($recruiter_page->job_limit ==0 && $recruiter_page->job_limit =="" )
							        {
							            $bg_color="danger";
							            $text_color="light"; 
							            $px="3";
							            $py="1";
							        }
							      ?>
							    	<br><br><span class="[ px-<?=$px?> py-<?=$py?> ] bg-<?=$bg_color?> text-<?=$text_color?> rounded"> <?php if($recruiter_page->job_limit !=""){
							            echo "You have ".$recruiter_page->job_limit." job posting remaining.";
							            }
							            else{
							                echo "You have 0 job posting remaining.";
							            }
							            ?>
							            </span>
							           
							    </div>
							        <div class="text-right">
							            <p style="margin-bottom:5px;">See all your jobs here</p>
							            <a target="_blank" href="<?=$job_page_url;?>"><?=$job_page_url?></a>
							            
							            <div class="mt-2">
														<button class="btn btn-primary recruiter_job_page_url" id="copy_link" ><i class="fas fa-copy "></i> Copy link</button>
													</div>
										
							        </div>
							  
							<?php
							 }
							?>
							<!--<button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Delete Selected</button>-->
						</div>

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>

							<div id="table_container" class="table-responsive">
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<!-- <span>Copyright &copy; Pride Circle 2019</span> -->
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- MODAL :  Confirm Delete selected modal -->
	<div id="delete_selected_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_selected_modal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the jobs with following names?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="delete_selected_list_container" class="[ modal-body text-center ]">
					Please select an entry to delete!
				</div>

				<div class="modal-footer">
					<div id="delete_selected_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>

					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>

					<button id="delete_selected_modal_submit" type="button" class="[ btn btn-danger ]" disabled>Delete Permanently</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Confirm Delete selected modal End -->

	<!-- MODAL :  Create New modal -->
	<div id="create_new_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="create_new_modal" aria-hidden="true">
		<div class="[ modal-dialog modal-lg ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="create_new_modal_title">Create New Job</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="create_new_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="create_new_modal_body" class="[ modal-body ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_title"><span style="color:red;">*</span>Title</label>
							<input id="create_new_job_title" class="form-control" type="text" name="job_title" required>

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_company_name"><span style="color:red;">*</span>Company</label>
							<input id="create_new_job_company_name" class="form-control" type="text" name="job_company_name" required>

							<div class="invalid-tooltip">
								Please provide a valid Company Name.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="create_new_job_experience">Experience</label>
            
            				<div class="row no-gutters">
            					<div class="[ col-6 pr-2 ][ input-group ]">
            						<div class="input-group-prepend">
            							<div class="input-group-text">Min</div>
            						</div>
            
            						<select id="create_new_job_experience_min" class="custom-select" name="job_experience_min" >
            							<?php
            								for ($i=0; $i <= 60; $i++) {
            									echo '<option value="'.$i.'" >'.$i.'</option>';
            								}
            							?>
            						</select>
            
            						<div class="invalid-tooltip">
            							Please select maximum years.
            						</div>
            					</div>
            
            					<div class="[ col-6 pl-2 ][ input-group ]">
            						<div class="input-group-prepend">
            							<div class="input-group-text">Max</div>
            						</div>
            
            						<select id="create_new_job_experience_max" class="custom-select" name="job_experience_max" >
            							<?php
            								for ($i=0; $i <=60; $i++) {
            									echo '<option value="'.$i.'" >'.$i.'</option>';
            								}
            							?>
            						</select>
            
            						<div class="invalid-tooltip">
            							Please select minimum years.
            						</div>
            					</div>
            				</div>
            			</div>
						
						<div class="[ mb-3 ][ form-group ] has-validation ">
						    <label for="create_new_job_location"><span style="color:red;">*</span>Locations <sub>(Please enter a comma-separated list of  cities)</sub></label>
            				<input id="create_new_job_location" class="form-control" type="text" name="job_location" required>
            				<div class="invalid-tooltip">
            					Please enter locations.
            				</div>
            			</div>
            			
						
						
						<div class="[ mb-3 ][ form-group ] has-validation ">
						    <label for="create_new_job_skills"><span style="color:red;">*</span>Skills <sub>(Please enter a comma-separated list of  skills)</sub></label>
            				<textarea id="create_new_job_skills" class="form-control" type="textarea" name="job_skills" required></textarea>
            				<div class="invalid-tooltip">
            					Please enter skills.
            				</div>
            			</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_position"><span style="color:red;">*</span>Position</label>
							<input id="create_new_job_position" class="form-control" type="text" name="job_position" required>

							<div class="invalid-tooltip">
								Please provide a valid position.
							</div>
						</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_ctc"><span style="color:red;">*</span>CTC</label>
							<input id="create_new_job_ctc" class="form-control" type="text" name="job_ctc" required>

							<div class="invalid-tooltip">
								Please provide a valid ctc.
							</div>
						</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_summary"><span style="color:red;">*</span>Summary</label>
							<textarea id="create_new_job_summary" class="form-control" type="textarea" name="job_summary" required></textarea>

							<div class="invalid-tooltip">
								Please provide a valid summary.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
            				<label class="d-block" for="create_new_job_sector"><span style="color:red;">*</span>Job Sector</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_sector_tech" value="tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_sector_tech">Tech</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_sector_non_tech" value="non-tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_sector_non_tech">Non-tech</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>
						
						<div class="[ mb-3 ][ form-group ] has-validation ">
            				<label for="create_new_job_type"><span style="color:red;">*</span>Job Type <sub>(Please enter job types. Example: Full-time, part-time, work from home)</sub></label>
            				<input id="create_new_job_type" class="form-control" type="text" name="job_type" required>
            				<div class="invalid-tooltip">
            					Please enter job type.
            				</div>
            			</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_application_deadline"><span style="color:red;">*</span>Application Deadline</label>
							<input id="create_new_job_application_deadline" class="form-control" type="date" name="job_application_deadline" required>

							<div class="invalid-tooltip">
								Please provide a valid application deadline.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
            				<label><span style="color:red;">*</span>Please Upload Your Company Logo (284*117)</label>
            
            				<div class="custom-file">
            					<input id="job_profile_image" name="job_profile_image" class="custom-file-input" type="file" required >
            					<label id="job_profile_image_label" class="custom-file-label" for="job_profile_image">PNG or JPG images only</label>
            					<span style="margin-top:10px;">Please make sure the image is not too elongated.</span>
            
            					<div class="invalid-tooltip">
            						Please upload a valid image.
            					</div>
            				</div>
            			</div>
					</div>

					<div class="[ modal-footer ] d-flex justify-content-between">
                        <div>
                            <b><span style="color:red;">Note:</span><br>You can preview the job page once saved.<br>You can edit the job only for 24 hours after creating it.</b>
                        </div>
                        <div>

                            <div id="create_new_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>

                            <button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
                            <button id="create_new_modal_submit" name="create_new_modal_submit" type="submit" class="[ btn btn-primary ]">Save</button>
                            <?php 
                            
                                if($job_added_response!=""){?>
                                    <script>
                                    alert('<?=$job_added_response?>');
                                    </script>
                            <?php
                                }
                            
                            ?>
                        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Create New modal End -->

	<!-- MODAL :  Edit Profile modal -->
    <div id="edit_profile_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="edit_profile_modal" aria-hidden="true">
		<div class="[ modal-dialog modal-lg ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="edit_profile_modal_title">Edit Profile</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="edit_profile_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="edit_profile_modal_body" class="[ modal-body ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_title"><span style="color:red;">*</span>Title</label>
							<input id="edit_profile_job_title" class="form-control" type="text" name="job_title" required>

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_company_name"><span style="color:red;">*</span>Company</label>
							<input id="edit_profile_job_company_name" class="form-control" type="text" name="job_company_name" required>

							<div class="invalid-tooltip">
								Please provide a valid Company Name.
							</div>
						</div>

						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="edit_profile_job_experience">Experience</label>-->
						<!--	<input id="edit_profile_job_experience" class="form-control" type="text" name="job_experience" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid experience.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="edit_profile_job_experience">Experience</label>
            
            				<div class="row no-gutters">
            					<div class="[ col-6 pr-2 ][ input-group ]">
            						<div class="input-group-prepend">
            							<div class="input-group-text">Min</div>
            						</div>
            
            						<select id="edit_profile_job_experience_min" class="custom-select" name="job_experience_min" >
            							<?php
            								for ($i=0; $i <= 60; $i++) {
            									echo '<option value="'.$i.'" >'.$i.'</option>';
            								}
            							?>
            						</select>
            
            						<div class="invalid-tooltip">
            							Please select maximum years.
            						</div>
            					</div>
            
            					<div class="[ col-6 pl-2 ][ input-group ]">
            						<div class="input-group-prepend">
            							<div class="input-group-text">Max</div>
            						</div>
            
            						<select id="edit_profile_job_experience_max" class="custom-select" name="job_experience_max" >
            							<?php
            								for ($i=0; $i <=60; $i++) {
            									echo '<option value="'.$i.'" >'.$i.'</option>';
            								}
            							?>
            						</select>
            
            						<div class="invalid-tooltip">
            							Please select minimum years.
            						</div>
            					</div>
            				</div>
            			</div>

						<div class="[ mb-3 ][ form-group ] has-validation ">
						    <label for="edit_profile_job_location"><span style="color:red;">*</span>Locations <sub>(Please enter a comma-separated list of  cities)</sub></label>
            				<input id="edit_profile_job_location" class="form-control" type="text" name="job_location" required>
            				<div class="invalid-tooltip">
            					Please enter locations.
            				</div>
            			</div>

                        <div class="[ mb-3 ][ form-group ] has-validation ">
						    <label for="edit_profile_job_skills"><span style="color:red;">*</span>Skills <sub>(Please enter a comma-separated list of  skills)</sub></label>
            				<textarea id="edit_profile_job_skills" class="form-control" type="textarea" name="job_skills" required></textarea>
            				<div class="invalid-tooltip">
            					Please enter skills.
            				</div>
            			</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_position"><span style="color:red;">*</span>Position</label>
							<input id="edit_profile_job_position" class="form-control" type="text" name="job_position" required>

							<div class="invalid-tooltip">
								Please provide a valid position.
							</div>
						</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_ctc"><span style="color:red;">*</span>CTC</label>
							<input id="edit_profile_job_ctc" class="form-control" type="text" name="job_ctc" required>

							<div class="invalid-tooltip">
								Please provide a valid ctc.
							</div>
						</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_summary"><span style="color:red;">*</span>Summary</label>
							<textarea id="edit_profile_job_summary" class="form-control" type="textarea" name="job_summary" required></textarea>

							<div class="invalid-tooltip">
								Please provide a valid summary.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
            				<label  class="d-block" for="job_sector"><span style="color:red;">*</span>Job Sector</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="job_sector_tech" value="tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="job_sector_tech">Tech</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="job_sector_non_tech" value="non-tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="job_sector_non_tech">Non-tech</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>
						
						<!-- <div class="[ mb-3 ][ form-group ]">
            				<label for="edit_profile_job_type"><span style="color:red;">*</span>Job Type <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="edit_profile_job_type" name="job_type" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Full time',
            				        'Part time',
            				        'WFH'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
            				</div>
            			</div> -->

                        <div class="[ mb-3 ][ form-group ] has-validation ">
            				<label for="edit_profile_job_type"><span style="color:red;">*</span>Job Type <sub>(Please enter job types. Example: Full-time, part-time, work from home)</sub></label>
            				<input id="edit_profile_job_type" class="form-control" type="text" name="job_type" required>
            				<div class="invalid-tooltip">
            					Please enter job type.
            				</div>
            			</div>


						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="edit_profile_job_job_code">Job Code</label>-->
						<!--	<input id="edit_profile_job_job_code" class="form-control" type="text" name="job_job_code" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid job code.-->
						<!--	</div>-->
						<!--</div>-->
						
						<!-- <div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_publish_shedule">Job Publish Schedule</label>
							<input id="edit_profile_job_publish_shedule" class="form-control" type="date" name="job_publish_shedule" >

							<div class="invalid-tooltip">
								Please provide a valid job publish shedule.
							</div>
						</div> -->


						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_application_deadline"><span style="color:red;">*</span>Application Deadline</label>
							<input id="edit_profile_job_application_deadline" class="form-control" type="date" name="job_application_deadline" required>

							<div class="invalid-tooltip">
								Please provide a valid application deadline.
							</div>
						</div>
            			<?php
            				//if ($redacted_resume_url!=""){
            			?>
            				<a id="upload_job_profile_image" class="[ mb-3 ]" target='_blank' title="">See uploaded image</a>
            			<?php
            				//}else{
            			?>
            				<!--<p>No Redacted Resume Available</p>-->
            			<?php
            			//	}
            			?>
            			
            			<div class="[ mb-3 ][ form-group ]">
            				<label>Select image to replace </label>
            
            				<div class="custom-file">
            					<input id="edit_job_profile_image" name="edit_job_profile_image" class="custom-file-input" type="file" >
            					<label id="edit_job_profile_image_label" class="custom-file-label" for="edit_job_profile_image">PNG or JPG images only</label>
                                <span >Please make sure the image is not too elongated.</span>
            
            					<div class="invalid-tooltip">
            						Please upload a valid image.
            					</div>
            				</div>
            			</div>
            			<input id="edit_profile_job_id" class="form-control" type="text" name="edit_profile_job_id" hidden>
					</div>

					<div class="[ modal-footer ] d-flex justify-content-between">
                        <div>
                            <b><span style="color:red;">Note:</span><br>You can preview the job page once saved.<br>You can edit the job only for 24 hours after creating it.</b>
                        </div>
                        <div>
                            <div id="edit_profile_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>
                            
                            <button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
                            <button id="edit_profile_modal_submit" name="edit_profile_modal_submit" type="submit" class="[ btn btn-primary ]">Save</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Edit Profile modal End -->

	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
	

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>
	
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>

    <!-- Copy and Excel button  -->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>

	<!-- include summernote js -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=19.02.22"></script>

<script>
	/* copy link using js */
    $(document).on('click', '#copy_link', function(){
        let copy_text="<?php echo $job_page_url;?>";
        Clipboard_CopyTo(copy_text);
    });
    
    function Clipboard_CopyTo(value) {
      var tempInput = document.createElement("input");
      tempInput.value = value;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
    }
    /*End copy link using js*/
    

</script>

<script type="text/javascript">
				{
					let sideBar = document.querySelector('.side-bar');
					let arrowCollapse = document.querySelector('#logo-name__icon');
					let headerNav = document.querySelector('.header_navbar');
					let recruiter_datatable_section = document.querySelector('.recruiter_datatable_section');
					let sticky_footer = document.querySelector('.sticky-footer');
					// console.log(dashboard);
					console.log("ghghgh");
					sideBar.onmouseover = () => {
						sideBar.classList.add('collapse');
						arrowCollapse.classList.add('collapse');
						arrowCollapse.classList = 'bx bx-chevron-right logo-name__icon collapse';
						recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
            recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};

					sideBar.onmouseout = () => {
						sideBar.classList.remove('collapse');
						arrowCollapse.classList.remove('collapse');
						arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
						recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
            recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};
				}
	</script>
</body>

</html>
