<?php
	require_once 'includes/editor-header.php';
?>
<?php
    /* Amruta Jagtap 2021-03-12 Save new create job profile and upload job image */
//print_r($_POST);
//echo $_POST['create_new_modal_submit'];
    if(isset($_POST['create_new_modal_submit'])){
//echo "1";     
        $new_job_page = new Page();
		$new_job_page->template = $templates->get("job-page");
		$new_job_page->parent = $pages->get("name=jobs");

		$new_job_page->title =$sanitizer->text($input->post->job_title);
		
		/* Save page */
		$new_job_page->of(false);
		$new_job_page->save();
		
		$new_job_page->company_name = $sanitizer->text($input->post->job_company_name);
		//$new_job_page->experience = $new_job_details_to_save['job_experience_max']."-".$new_job_details_to_save['job_experience_min'];
        $new_job_page->max_experience = $sanitizer->text($input->post->job_experience_max);
        $new_job_page->min_experience = $sanitizer->text($input->post->job_experience_min);
		$new_job_page->location = $sanitizer->text($input->post->job_location);
		$new_job_page->skills = $sanitizer->textarea($input->post->job_skills);
		$new_job_page->position = $sanitizer->text($input->post->job_position);
		$new_job_page->ctc = $sanitizer->text($input->post->job_ctc);
		$new_job_page->summary = $sanitizer->purify($input->post->job_summary);
		//$new_job_page->job_code = $new_job_details_to_save['job_job_code'];
		$new_job_page->job_type = $sanitizer->text($input->post->job_type);
		$new_job_page->job_sector = $sanitizer->text($input->post->job_sector);
		$new_job_page->active_status = $sanitizer->text($input->post->active_status);
		$new_job_page->application_deadline = $sanitizer->text($input->post->job_application_deadline);
		$new_job_page->job_publish_shedule = $sanitizer->text($input->post->job_publish_shedule);
        // echo $input->post->job_publish_shedule;
        // echo "********";
        // echo $new_job_page->job_publish_shedule ;
		$new_job_page->verification = "verified";
		$new_job_page->job_added_by = wire('session')->user_page_id;

        $new_job_page->is_hot_jobs = $sanitizer->text($input->post->hot_jobs);
		
		/* Save page */
		$new_job_page->of(false);
		$new_job_page->save();
		
			/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = $config->paths->assets;//. "files/temp-files/";

		/* Uploading and saving of profile image */
		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
		$job_image = new WireUpload('job_profile_image');
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
	//}
		/* Uploading and saving of profile image END */
		
			/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
    			/**** Get serial ID from the serial ID page */
    			$job_code_serial_id_counter_page = wire('pages')->get("name=job-code-serial-id-counter");
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
		
		header("Location: ".$page->httpUrl);
// 		$session->redirect($pages->get("name=admin-manage-jobs")->httpUrl);
// 		echo "1";
      //exit();  
    }
    /* Amruta Jagtap 2021-03-12 End Save new create job profile and upload job image */
    
     /* Amruta Jagtap 2021-03-12 Save Edit job profile and upload job image */
    if(isset($_POST['edit_profile_modal_submit'])){
    /* Get the job page to edit based on the ID */
	//	$job_page_to_change = wire('pages')->get($edit_job_details_to_save['id']);
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
		$job_page_to_change_image = new WireUpload('edit_job_profile_image');
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
        header("Location: ".$page->httpUrl);
    }
    /* Amruta Jagtap 2021-03-12 End Save Edit job profile and upload job image */
    
?>
	<!-- include summernote css -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
				
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
                            <label class="btn btn-outline-primary"><input id='select_all_checkbox' class='select_all_candidate_checkbox' type='checkbox' style="padding-top:0.5rem;"> Select All</label>

							<button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#create_new_modal"><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> New Job</button>

                            <button id="multi_verify_button" class="[ btn btn-primary ]( selected-action-button ) btn_top_verify" type="button"><i class='[ mr-2 ][ fas fa-unlock ]'></i> Verify</button>

							<button id="multi_unverify_button" class="[ btn btn-primary ]( selected-action-button ) btn_top_unverify" type="button"><i class='[ mr-2 ][ fas fa-lock ]'></i> Draft</button>

							<button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Delete Selected</button>
						</div>

						<div id="table_container_card_body" class="card-body">
							<!-- <h3 id="table_loading" >Loading...</h3> -->

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
<?php 
//print_r($_POST);
?>
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
 <!--action="<?=$config->urls->httpRoot?>resume/api/admin-manage-jobs/"-->
				<form id="create_new_modal_form" class="[ needs-validation ]" method="POST" enctype="multipart/form-data">
					<div id="edit_profile_modal_body" class="[ modal-body ]">

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
    
						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="create_new_job_experience">Experience</label>-->
						<!--	<input id="create_new_job_experience" class="form-control" type="text" name="job_experience" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid experience.-->
						<!--	</div>-->
						<!--</div>-->


						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="create_new_job_location">Location</label>-->
						<!--	<input id="create_new_job_location" class="form-control" type="text" name="job_location" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid location.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="create_new_job_location"><span style="color:red;">*</span>Locations <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="create_new_job_location" name="job_location" type="text" style="padding: 4px;" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
                                        'Abu',
                                        'Adoni',
                                        'Agartala',
                                        'Agra',
                                        'Ahmadabad',
                                        'Ahmadnagar',
                                        'Aizawl',
                                        'Ajmer',
                                        'Akola',
                                        'Alappuzha',
                                        'Aligarh',
                                        'Alipore',
                                        'Alipur Duar',
                                        'Almora',
                                        'Alwar',
                                        'Amaravati',
                                        'Ambala',
                                        'Ambikapur',
                                        'Amer',
                                        'Amravati',
                                        'Amreli',
                                        'Amritsar',
                                        'Amroha',
                                        'Anantapur',
                                        'Anantnag',
                                        'Andhra Pradesh',
                                        'Ara',
                                        'Arcot',
                                        'Arunachal Pradesh',
                                        'Asansol',
                                        'Assam',
                                        'Aurangabad',
                                        'Ayodhya',
                                        'Azamgarh',
                                        'Badagara',
                                        'Badami',
                                        'Baharampur',
                                        'Bahraich',
                                        'Balaghat',
                                        'Balangir',
                                        'Baleshwar',
                                        'Ballari',
                                        'Ballia',
                                        'Bally',
                                        'Balurghat',
                                        'Banda',
                                        'Bangalore',
                                        'Bankura',
                                        'Bara Banki',
                                        'Baramula',
                                        'Baranagar',
                                        'Barasat',
                                        'Bareilly',
                                        'Baripada',
                                        'Barmer',
                                        'Barrackpore',
                                        'Baruni',
                                        'Barwani',
                                        'Basirhat',
                                        'Basti',
                                        'Batala',
                                        'Beawar',
                                        'Begusarai',
                                        'Belgavi',
                                        'Bettiah',
                                        'Betul',
                                        'Bhadravati',
                                        'Bhagalpur',
                                        'Bhandara',
                                        'Bharatpur',
                                        'Bharhut',
                                        'Bharuch',
                                        'Bhatpara',
                                        'Bhavnagar',
                                        'Bhilai',
                                        'Bhilwara',
                                        'Bhind',
                                        'Bhiwani',
                                        'Bhojpur',
                                        'Bhopal',
                                        'Bhubaneshwar',
                                        'Bhuj',
                                        'Bhusawal',
                                        'Bid',
                                        'Bidar',
                                        'Bihar',
                                        'Bihar Sharif',
                                        'Bijnor',
                                        'Bikaner',
                                        'Bilaspur',
                                        'Bilaspur',
                                        'Bishnupur',
                                        'Bithur',
                                        'Bodh Gaya',
                                        'Bokaro',
                                        'Brahmapur',
                                        'Budaun',
                                        'Budge Budge',
                                        'Bulandshahr',
                                        'Buldana',
                                        'Bundi',
                                        'Burdwan',
                                        'Burhanpur',
                                        'Buxar',
                                        'Chaibasa',
                                        'Chamba',
                                        'Chandernagore',
                                        'Chandigarh',
                                        'Chandigarh',
                                        'Chandigarh',
                                        'Chandigarh (Union Territorigarh (Union Territory)',
                                        'Chandragiri',
                                        'Chandrapur',
                                        'Chapra',
                                        'Chengalpattu',
                                        'Chennai',
                                        'Cherrapunji',
                                        'Chhatarpur',
                                        'Chhattisgarh',
                                        'Chhindwara',
                                        'Chidambaram',
                                        'Chikkamagaluru',
                                        'Chitradurga',
                                        'Chittaurgarh',
                                        'Chittoor',
                                        'Churu',
                                        'Coimbatore',
                                        'Cuddalore',
                                        'Cuttack',
                                        'Dadra And Nagar Haveli (Untory)',
                                        'Dalhousie',
                                        'Daman',
                                        'Daman And Diu (Union Terriman And Diu (Union Territory)',
                                        'Damoh',
                                        'Darbhanga',
                                        'Darjiling',
                                        'Datia',
                                        'Daulatabad',
                                        'Davangere',
                                        'Dehra Dun',
                                        'Dehri',
                                        'Delhi',
                                        'Delhi (National Capital Territory)',
                                        'Deoghar',
                                        'Deoria',
                                        'Dewas',
                                        'Dhamtari',
                                        'Dhanbad',
                                        'Dhar',
                                        'Dharmapuri',
                                        'Dharmshala',
                                        'Dhaulpur',
                                        'Dhenkanal',
                                        'Dhuburi',
                                        'Dhule',
                                        'Diamond Harbour',
                                        'Dibrugarh',
                                        'Dinapur Nizamat',
                                        'Dindigul',
                                        'Dispur',
                                        'Diu',
                                        'Doda',
                                        'Dowlaiswaram',
                                        'Dum Dum',
                                        'Dumka',
                                        'Dungarpur',
                                        'Durg',
                                        'Durgapur',
                                        'Dwarka',
                                        'Eluru',
                                        'Erode',
                                        'Etah',
                                        'Etawah',
                                        'Faizabad',
                                        'Faridabad',
                                        'Faridkot',
                                        'Farrukhabad-cum-Fatehgarh',
                                        'Fatehpur',
                                        'Fatehpur Sikri',
                                        'Firozpur',
                                        'Firozpur Jhirka',
                                        'Gandhinagar',
                                        'Ganganagar',
                                        'Gangtok',
                                        'Gaya',
                                        'Ghaziabad',
                                        'Ghazipur',
                                        'Giridih',
                                        'Goa',
                                        'Godhra',
                                        'Gonda',
                                        'Gorakhpur',
                                        'Gujarat',
                                        'Gulmarg',
                                        'Guna',
                                        'Guntur',
                                        'Gurdaspur',
                                        'Gurgaon',
                                        'Guwahati',
                                        'Gwalior',
                                        'Gyalsing',
                                        'Hajipur',
                                        'Halebid',
                                        'Halisahar',
                                        'Hamirpur',
                                        'Hamirpur',
                                        'Hansi',
                                        'Hanumangarh',
                                        'Haora',
                                        'Hardoi',
                                        'Haridwar',
                                        'Haryana',
                                        'Hassan',
                                        'Hathras',
                                        'Hazaribag',
                                        'Himachal Pradesh',
                                        'Hisar',
                                        'Hoshangabad',
                                        'Hoshiarpur',
                                        'Hubballi-Dharwad',
                                        'Hugli',
                                        'Hyderabad',
                                        'Idukki',
                                        'Imphal',
                                        'Indore',
                                        'Ingraj Bazar',
                                        'Itanagar',
                                        'Itarsi',
                                        'Jabalpur',
                                        'Jagdalpur',
                                        'Jaipur',
                                        'Jaisalmer',
                                        'Jalandhar',
                                        'Jalaun',
                                        'Jalgaon',
                                        'Jalor',
                                        'Jalpaiguri',
                                        'Jamalpur',
                                        'Jammu',
                                        'Jammu And Kashmir',
                                        'Jamnagar',
                                        'Jamshedpur',
                                        'Jaunpur',
                                        'Jhabua',
                                        'Jhalawar',
                                        'Jhansi',
                                        'Jharia',
                                        'Jharkhand',
                                        'Jhunjhunu',
                                        'Jind',
                                        'Jodhpur',
                                        'Jorhat',
                                        'Junagadh',
                                        'Kadapa',
                                        'Kaithal',
                                        'Kakinada',
                                        'Kalaburagi',
                                        'Kalimpong',
                                        'Kalyan',
                                        'Kamarhati',
                                        'Kanchipuram',
                                        'Kanchrapara',
                                        'Kandla',
                                        'Kangra',
                                        'Kannauj',
                                        'Kanniyakumari',
                                        'Kannur',
                                        'Kanpur',
                                        'Kapurthala',
                                        'Karaikal',
                                        'Karimnagar',
                                        'Karli',
                                        'Karnal',
                                        'Karnataka',
                                        'Kathua',
                                        'Katihar',
                                        'Keonjhar',
                                        'Kerala',
                                        'Khajuraho',
                                        'Khambhat',
                                        'Khammam',
                                        'Khandwa',
                                        'Kharagpur',
                                        'Khargon',
                                        'Kheda',
                                        'Kishangarh',
                                        'Koch Bihar',
                                        'Kochi',
                                        'Kodaikanal',
                                        'Kohima',
                                        'Kolar',
                                        'Kolhapur',
                                        'Kolkata',
                                        'Kollam',
                                        'Konark',
                                        'Koraput',
                                        'Kota',
                                        'Kottayam',
                                        'Kozhikode',
                                        'Krishnanagar',
                                        'Kullu',
                                        'Kumbakonam',
                                        'Kurnool',
                                        'Kurukshetra',
                                        'Lachung',
                                        'Lakhimpur',
                                        'Lalitpur',
                                        'Leh',
                                        'Location',
                                        'Lucknow',
                                        'Ludhiana',
                                        'Lunglei',
                                        'Machilipatnam',
                                        'Madgaon',
                                        'Madhubani',
                                        'Madhya Pradesh',
                                        'Madikeri',
                                        'Madurai',
                                        'Mahabaleshwar',
                                        'Maharashtra',
                                        'Mahbubnagar',
                                        'Mahe',
                                        'Mahesana',
                                        'Maheshwar',
                                        'Mainpuri',
                                        'Malda',
                                        'Malegaon',
                                        'Mamallapuram',
                                        'Mandi',
                                        'Mandla',
                                        'Mandsaur',
                                        'Mandya',
                                        'Mangaluru',
                                        'Mangan',
                                        'Manipur',
                                        'Matheran',
                                        'Mathura',
                                        'Mattancheri',
                                        'Meerut',
                                        'Meghalaya',
                                        'Merta',
                                        'Mhow',
                                        'Midnapore',
                                        'Mirzapur-Vindhyachal',
                                        'Mizoram',
                                        'Mon',
                                        'Moradabad',
                                        'Morena',
                                        'Morvi',
                                        'Motihari',
                                        'Mumbai',
                                        'Munger',
                                        'Murshidabad',
                                        'Murwara',
                                        'Mussoorie',
                                        'Muzaffarnagar',
                                        'Muzaffarpur',
                                        'Mysuru',
                                        'Nabha',
                                        'Nadiad',
                                        'Nagaland',
                                        'Nagaon',
                                        'Nagappattinam',
                                        'Nagarjunakoṇḍa',
                                        'Nagaur',
                                        'Nagercoil',
                                        'Nagpur',
                                        'Nahan',
                                        'Nainital',
                                        'Nanded',
                                        'Narsimhapur',
                                        'Narsinghgarh',
                                        'Narwar',
                                        'Nashik',
                                        'Nathdwara',
                                        'Navadwip',
                                        'Navsari',
                                        'Neemuch',
                                        'New Delhi',
                                        'Nizamabad',
                                        'Nowgong',
                                        'Odisha',
                                        'Okha',
                                        'Orchha',
                                        'Osmanabad',
                                        'Palakkad',
                                        'Palanpur',
                                        'Palashi',
                                        'Palayankottai',
                                        'Pali',
                                        'Panaji',
                                        'Pandharpur',
                                        'Panihati',
                                        'Panipat',
                                        'Panna',
                                        'Paradip',
                                        'Parbhani',
                                        'Partapgarh',
                                        'Patan',
                                        'Patiala',
                                        'Patna',
                                        'Pehowa',
                                        'Phalodi',
                                        'Phek',
                                        'Phulabani',
                                        'Pilibhit',
                                        'Pithoragarh',
                                        'Porbandar',
                                        'Port Blair',
                                        'Prayagraj',
                                        'Puducherry',
                                        'Puducherry (Union Territorherry (Union Territory)',
                                        'Pudukkottai',
                                        'Punch',
                                        'Pune',
                                        'Punjab',
                                        'Puri',
                                        'Purnia',
                                        'Purulia',
                                        'Pusa',
                                        'Pushkar',
                                        'Rae Bareli',
                                        'Raichur',
                                        'Raiganj',
                                        'Raipur',
                                        'Raisen',
                                        'Rajahmundry',
                                        'Rajapalaiyam',
                                        'Rajasthan',
                                        'Rajauri',
                                        'Rajgarh',
                                        'Rajkot',
                                        'Rajmahal',
                                        'Rajnandgaon',
                                        'Ramanathapuram',
                                        'Rampur',
                                        'Ranchi',
                                        'Ratlam',
                                        'Ratnagiri',
                                        'Rewa',
                                        'Rewari',
                                        'Rohtak',
                                        'Rupnagar',
                                        'Sagar',
                                        'Saharanpur',
                                        'Saharsa',
                                        'Salem',
                                        'Samastipur',
                                        'Sambalpur',
                                        'Sambhal',
                                        'Sangareddi',
                                        'Sangli',
                                        'Sangrur',
                                        'Santipur',
                                        'Saraikela',
                                        'Sarangpur',
                                        'Sasaram',
                                        'Satara',
                                        'Satna',
                                        'Sawai Madhopur',
                                        'Sehore',
                                        'Seoni',
                                        'Sevagram',
                                        'Shahdol',
                                        'Shahjahanpur',
                                        'Shahpura',
                                        'Shajapur',
                                        'Shantiniketan',
                                        'Sheopur',
                                        'Shillong',
                                        'Shimla',
                                        'Shivamogga',
                                        'Shivpuri',
                                        'Shravanabelagola',
                                        'Shrirampur',
                                        'Shrirangapattana',
                                        'Sibsagar',
                                        'Sikar',
                                        'Sikkim',
                                        'Silchar',
                                        'Siliguri',
                                        'Silvassa',
                                        'Sirohi',
                                        'Sirsa',
                                        'Sitamarhi',
                                        'Sitapur',
                                        'Siuri',
                                        'Siwan',
                                        'Solapur',
                                        'Sonipat',
                                        'Srikakulam',
                                        'Srinagar',
                                        'Sultanpur',
                                        'Surat',
                                        'Surendranagar',
                                        'Tamil Nadu',
                                        'Tamluk',
                                        'Tehri',
                                        'Telangana',
                                        'Tezpur',
                                        'Thalassery',
                                        'Thane',
                                        'Thanjavur',
                                        'Thiruvananthapuram',
                                        'Thrissur',
                                        'Tinsukia',
                                        'Tiruchchirappalli',
                                        'Tirunelveli',
                                        'Tirupati',
                                        'Tiruppur',
                                        'Titagarh',
                                        'Tonk',
                                        'Tripura',
                                        'Tumkuru',
                                        'Tuticorin',
                                        'Udaipur',
                                        'Udayagiri',
                                        'Udhagamandalam',
                                        'Udhampur',
                                        'Ujjain',
                                        'Ulhasnagar',
                                        'Una',
                                        'Uttar Pradesh',
                                        'Uttarakhand',
                                        'Valsad',
                                        'Varanasi',
                                        'Vasai-Virar',
                                        'Vellore',
                                        'Veraval',
                                        'Vidisha',
                                        'Vijayawada',
                                        'Visakhapatnam',
                                        'Vizianagaram',
                                        'Warangal',
                                        'Wardha',
                                        'West Bengal',
                                        'Wokha',
                                        'Yanam',
                                        'Yavatmal',
                                        'Yemmiganur',
                                        'Zunheboto'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
            				</div>
            			</div>


						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="create_new_job_skills">Skills</label>-->
						<!--	<textarea id="create_new_job_skills" class="form-control" type="textarea" name="job_skills" required></textarea>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid skills.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="create_new_job_skills"><span style="color:red;">*</span>Skills <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="create_new_job_skills" name="job_skills" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
                                    'Analytical',
                                    'Analyze and Recommend Database Improvements',
                                    'Analyze Impact of Database Changes to the Business',
                                    'Audit Database Access and Requests',
                                    'APIs',
                                    'Application and Server Monitoring Tools',
                                    'Application Development ',
                                    'Architecture',
                                    'Artificial Intelligence',
                                    'Attention to Detail',
                                    'AutoCAD',
                                    'Azure',
                                    'Cloud Computing',
                                    'C++',
                                    'C Language',
                                    'Compensation & Benefits',
                                    'Configure Database Software',
                                    'Configuration Management',
                                    'Critical Thinking',
                                    'Database Administration',
                                    'Deploying Applications in a Cloud Environment',
                                    'Develop and Secure Network Structures',
                                    'Develop and Test Methods',
                                    'Emerging Technologies',
                                    'File Systems',
                                    'HTML',
                                    'Implement Backup and Recovery Plan',
                                    'Implementation',
                                    'Information Systems',
                                    'Interaction Design',
                                    'Interaction Flows',
                                    'Install, Maintain, and Merge Databases',
                                    'Integrated Technologies',
                                    'Integrating Security Protocols with Cloud Design',
                                    'Internet',
                                    'JavaScript',
                                    'Java',
                                    'Optimization',
                                    'IT Soft Skills',
                                    'L&D',
                                    'Logical Thinking',
                                    'Leadership',
                                    'Operating Systems',
                                    'Migrating Existing Workloads into Cloud Systems',
                                    'Mobile Applications',
                                    'Open Source Technology Integration',
                                    'Optimizing Website Performance',
                                    'PHP',
                                    'Python',
                                    'Problem Solving',
                                    'Project Management',
                                    'Recruitment',
                                    'Ruby',
                                    'Software Engineering',
                                    'Software Quality Assurance (QA)',
                                    'TensorFlow',
                                    'User-Centered Design',
                                    'UX Design',
                                    'UI / UX',
                                    'Visual Basic',
                                    'Visual FoxPro',
                                    'Web Development',
                                    'Web Design'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
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
            				<label class="d-block" for="create_new_job_job_sector"><span style="color:red;">*</span>Job Sector</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_job_sector_tech" value="tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_job_sector_tech">Tech</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_job_sector_non_tech" value="non-tech" name="job_sector" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_job_sector_non_tech">Non-tech</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="create_new_job_type"><span style="color:red;">*</span>Job Type <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="create_new_job_type" name="job_type" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Full time',
            				        'Part time',
            				        'WFH'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter Job Type.
            				</div>
            			</div>

						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="create_new_job_job_code">Job Code</label>-->
						<!--	<input id="create_new_job_job_code" class="form-control" type="text" name="job_job_code" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid job code.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_job_publish_shedule"><span style="color:red;">*</span>Job Publish Schedule</label>
							<input id="create_new_job_publish_shedule" class="form-control" type="date" value="<?=date('Y-m-d')?>" name="job_publish_shedule" required>

							<div class="invalid-tooltip">
								Please provide a valid job publish shedule.
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
            				<label class="d-block" for="create_new_job_active_status"><span style="color:red;">*</span>Activation Status</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_active_status_active" value="active" name="active_status" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_active_status_active">Activate</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_job_active_status_inactive" value="inactive" name="active_status" class="custom-control-input" required>
            					<label class="custom-control-label" for="create_new_job_active_status_inactive">Deactivate</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>

                        <div class="[ mb-3 ][ form-group ]">
            				<label  for="create_new_hot_job">Add to Hot Jobs</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_hot_job_yes" value="yes" name="hot_jobs" class="custom-control-input" >
            					<label class="custom-control-label" for="create_new_hot_job_yes">Yes</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="create_new_hot_job_no" value="no" name="hot_jobs" class="custom-control-input" checked>
            					<label class="custom-control-label" for="create_new_hot_job_no">No</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>
            			
            			<div class="[ mb-3 ][ form-group ]">
            				<label>Please Upload Your Profile Image</label>
            
            				<div class="custom-file">
            					<input id="job_profile_image" name="job_profile_image" class="custom-file-input" type="file" >
            					<label id="job_profile_image_label" class="custom-file-label" for="job_profile_image">PNG or JPG images only</label>
                                <span >Please make sure the image is not too elongated.</span>
            
            					<div class="invalid-tooltip">
            						Please upload a valid image.
            					</div>
            				</div>
            			</div>

					</div>

					<div class="[ modal-footer ]">
						<div id="create_new_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>
						

						<button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
						<button id="create_new_modal_submit" name="create_new_modal_submit" type="submit" class="[ btn btn-primary ]">Save</button>
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

				<form id="edit_profile_modal_form" class="[ needs-validation ]" autocomplete="off" action="<?=$pages->get("name=admin-manage-jobs-edit-job")->httpUrl?>" method="POST" enctype="multipart/form-data" target="_blank">
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

						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="edit_profile_job_location">Location</label>-->
						<!--	<input id="edit_profile_job_location" class="form-control" type="text" name="job_location" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid location.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="edit_profile_job_location"><span style="color:red;">*</span>Locations <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="edit_profile_job_location" name="job_location" type="text" style="padding: 4px;" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
                                        'Abu',
                                        'Adoni',
                                        'Agartala',
                                        'Agra',
                                        'Ahmadabad',
                                        'Ahmadnagar',
                                        'Aizawl',
                                        'Ajmer',
                                        'Akola',
                                        'Alappuzha',
                                        'Aligarh',
                                        'Alipore',
                                        'Alipur Duar',
                                        'Almora',
                                        'Alwar',
                                        'Amaravati',
                                        'Ambala',
                                        'Ambikapur',
                                        'Amer',
                                        'Amravati',
                                        'Amreli',
                                        'Amritsar',
                                        'Amroha',
                                        'Anantapur',
                                        'Anantnag',
                                        'Andhra Pradesh',
                                        'Ara',
                                        'Arcot',
                                        'Arunachal Pradesh',
                                        'Asansol',
                                        'Assam',
                                        'Aurangabad',
                                        'Ayodhya',
                                        'Azamgarh',
                                        'Badagara',
                                        'Badami',
                                        'Baharampur',
                                        'Bahraich',
                                        'Balaghat',
                                        'Balangir',
                                        'Baleshwar',
                                        'Ballari',
                                        'Ballia',
                                        'Bally',
                                        'Balurghat',
                                        'Banda',
                                        'Bangalore',
                                        'Bankura',
                                        'Bara Banki',
                                        'Baramula',
                                        'Baranagar',
                                        'Barasat',
                                        'Bareilly',
                                        'Baripada',
                                        'Barmer',
                                        'Barrackpore',
                                        'Baruni',
                                        'Barwani',
                                        'Basirhat',
                                        'Basti',
                                        'Batala',
                                        'Beawar',
                                        'Begusarai',
                                        'Belgavi',
                                        'Bettiah',
                                        'Betul',
                                        'Bhadravati',
                                        'Bhagalpur',
                                        'Bhandara',
                                        'Bharatpur',
                                        'Bharhut',
                                        'Bharuch',
                                        'Bhatpara',
                                        'Bhavnagar',
                                        'Bhilai',
                                        'Bhilwara',
                                        'Bhind',
                                        'Bhiwani',
                                        'Bhojpur',
                                        'Bhopal',
                                        'Bhubaneshwar',
                                        'Bhuj',
                                        'Bhusawal',
                                        'Bid',
                                        'Bidar',
                                        'Bihar',
                                        'Bihar Sharif',
                                        'Bijnor',
                                        'Bikaner',
                                        'Bilaspur',
                                        'Bilaspur',
                                        'Bishnupur',
                                        'Bithur',
                                        'Bodh Gaya',
                                        'Bokaro',
                                        'Brahmapur',
                                        'Budaun',
                                        'Budge Budge',
                                        'Bulandshahr',
                                        'Buldana',
                                        'Bundi',
                                        'Burdwan',
                                        'Burhanpur',
                                        'Buxar',
                                        'Chaibasa',
                                        'Chamba',
                                        'Chandernagore',
                                        'Chandigarh',
                                        'Chandigarh',
                                        'Chandigarh',
                                        'Chandigarh (Union Territorigarh (Union Territory)',
                                        'Chandragiri',
                                        'Chandrapur',
                                        'Chapra',
                                        'Chengalpattu',
                                        'Chennai',
                                        'Cherrapunji',
                                        'Chhatarpur',
                                        'Chhattisgarh',
                                        'Chhindwara',
                                        'Chidambaram',
                                        'Chikkamagaluru',
                                        'Chitradurga',
                                        'Chittaurgarh',
                                        'Chittoor',
                                        'Churu',
                                        'Coimbatore',
                                        'Cuddalore',
                                        'Cuttack',
                                        'Dadra And Nagar Haveli (Untory)',
                                        'Dalhousie',
                                        'Daman',
                                        'Daman And Diu (Union Terriman And Diu (Union Territory)',
                                        'Damoh',
                                        'Darbhanga',
                                        'Darjiling',
                                        'Datia',
                                        'Daulatabad',
                                        'Davangere',
                                        'Dehra Dun',
                                        'Dehri',
                                        'Delhi',
                                        'Delhi (National Capital Territory)',
                                        'Deoghar',
                                        'Deoria',
                                        'Dewas',
                                        'Dhamtari',
                                        'Dhanbad',
                                        'Dhar',
                                        'Dharmapuri',
                                        'Dharmshala',
                                        'Dhaulpur',
                                        'Dhenkanal',
                                        'Dhuburi',
                                        'Dhule',
                                        'Diamond Harbour',
                                        'Dibrugarh',
                                        'Dinapur Nizamat',
                                        'Dindigul',
                                        'Dispur',
                                        'Diu',
                                        'Doda',
                                        'Dowlaiswaram',
                                        'Dum Dum',
                                        'Dumka',
                                        'Dungarpur',
                                        'Durg',
                                        'Durgapur',
                                        'Dwarka',
                                        'Eluru',
                                        'Erode',
                                        'Etah',
                                        'Etawah',
                                        'Faizabad',
                                        'Faridabad',
                                        'Faridkot',
                                        'Farrukhabad-cum-Fatehgarh',
                                        'Fatehpur',
                                        'Fatehpur Sikri',
                                        'Firozpur',
                                        'Firozpur Jhirka',
                                        'Gandhinagar',
                                        'Ganganagar',
                                        'Gangtok',
                                        'Gaya',
                                        'Ghaziabad',
                                        'Ghazipur',
                                        'Giridih',
                                        'Goa',
                                        'Godhra',
                                        'Gonda',
                                        'Gorakhpur',
                                        'Gujarat',
                                        'Gulmarg',
                                        'Guna',
                                        'Guntur',
                                        'Gurdaspur',
                                        'Gurgaon',
                                        'Guwahati',
                                        'Gwalior',
                                        'Gyalsing',
                                        'Hajipur',
                                        'Halebid',
                                        'Halisahar',
                                        'Hamirpur',
                                        'Hamirpur',
                                        'Hansi',
                                        'Hanumangarh',
                                        'Haora',
                                        'Hardoi',
                                        'Haridwar',
                                        'Haryana',
                                        'Hassan',
                                        'Hathras',
                                        'Hazaribag',
                                        'Himachal Pradesh',
                                        'Hisar',
                                        'Hoshangabad',
                                        'Hoshiarpur',
                                        'Hubballi-Dharwad',
                                        'Hugli',
                                        'Hyderabad',
                                        'Idukki',
                                        'Imphal',
                                        'Indore',
                                        'Ingraj Bazar',
                                        'Itanagar',
                                        'Itarsi',
                                        'Jabalpur',
                                        'Jagdalpur',
                                        'Jaipur',
                                        'Jaisalmer',
                                        'Jalandhar',
                                        'Jalaun',
                                        'Jalgaon',
                                        'Jalor',
                                        'Jalpaiguri',
                                        'Jamalpur',
                                        'Jammu',
                                        'Jammu And Kashmir',
                                        'Jamnagar',
                                        'Jamshedpur',
                                        'Jaunpur',
                                        'Jhabua',
                                        'Jhalawar',
                                        'Jhansi',
                                        'Jharia',
                                        'Jharkhand',
                                        'Jhunjhunu',
                                        'Jind',
                                        'Jodhpur',
                                        'Jorhat',
                                        'Junagadh',
                                        'Kadapa',
                                        'Kaithal',
                                        'Kakinada',
                                        'Kalaburagi',
                                        'Kalimpong',
                                        'Kalyan',
                                        'Kamarhati',
                                        'Kanchipuram',
                                        'Kanchrapara',
                                        'Kandla',
                                        'Kangra',
                                        'Kannauj',
                                        'Kanniyakumari',
                                        'Kannur',
                                        'Kanpur',
                                        'Kapurthala',
                                        'Karaikal',
                                        'Karimnagar',
                                        'Karli',
                                        'Karnal',
                                        'Karnataka',
                                        'Kathua',
                                        'Katihar',
                                        'Keonjhar',
                                        'Kerala',
                                        'Khajuraho',
                                        'Khambhat',
                                        'Khammam',
                                        'Khandwa',
                                        'Kharagpur',
                                        'Khargon',
                                        'Kheda',
                                        'Kishangarh',
                                        'Koch Bihar',
                                        'Kochi',
                                        'Kodaikanal',
                                        'Kohima',
                                        'Kolar',
                                        'Kolhapur',
                                        'Kolkata',
                                        'Kollam',
                                        'Konark',
                                        'Koraput',
                                        'Kota',
                                        'Kottayam',
                                        'Kozhikode',
                                        'Krishnanagar',
                                        'Kullu',
                                        'Kumbakonam',
                                        'Kurnool',
                                        'Kurukshetra',
                                        'Lachung',
                                        'Lakhimpur',
                                        'Lalitpur',
                                        'Leh',
                                        'Location',
                                        'Lucknow',
                                        'Ludhiana',
                                        'Lunglei',
                                        'Machilipatnam',
                                        'Madgaon',
                                        'Madhubani',
                                        'Madhya Pradesh',
                                        'Madikeri',
                                        'Madurai',
                                        'Mahabaleshwar',
                                        'Maharashtra',
                                        'Mahbubnagar',
                                        'Mahe',
                                        'Mahesana',
                                        'Maheshwar',
                                        'Mainpuri',
                                        'Malda',
                                        'Malegaon',
                                        'Mamallapuram',
                                        'Mandi',
                                        'Mandla',
                                        'Mandsaur',
                                        'Mandya',
                                        'Mangaluru',
                                        'Mangan',
                                        'Manipur',
                                        'Matheran',
                                        'Mathura',
                                        'Mattancheri',
                                        'Meerut',
                                        'Meghalaya',
                                        'Merta',
                                        'Mhow',
                                        'Midnapore',
                                        'Mirzapur-Vindhyachal',
                                        'Mizoram',
                                        'Mon',
                                        'Moradabad',
                                        'Morena',
                                        'Morvi',
                                        'Motihari',
                                        'Mumbai',
                                        'Munger',
                                        'Murshidabad',
                                        'Murwara',
                                        'Mussoorie',
                                        'Muzaffarnagar',
                                        'Muzaffarpur',
                                        'Mysuru',
                                        'Nabha',
                                        'Nadiad',
                                        'Nagaland',
                                        'Nagaon',
                                        'Nagappattinam',
                                        'Nagarjunakoṇḍa',
                                        'Nagaur',
                                        'Nagercoil',
                                        'Nagpur',
                                        'Nahan',
                                        'Nainital',
                                        'Nanded',
                                        'Narsimhapur',
                                        'Narsinghgarh',
                                        'Narwar',
                                        'Nashik',
                                        'Nathdwara',
                                        'Navadwip',
                                        'Navsari',
                                        'Neemuch',
                                        'New Delhi',
                                        'Nizamabad',
                                        'Nowgong',
                                        'Odisha',
                                        'Okha',
                                        'Orchha',
                                        'Osmanabad',
                                        'Palakkad',
                                        'Palanpur',
                                        'Palashi',
                                        'Palayankottai',
                                        'Pali',
                                        'Panaji',
                                        'Pandharpur',
                                        'Panihati',
                                        'Panipat',
                                        'Panna',
                                        'Paradip',
                                        'Parbhani',
                                        'Partapgarh',
                                        'Patan',
                                        'Patiala',
                                        'Patna',
                                        'Pehowa',
                                        'Phalodi',
                                        'Phek',
                                        'Phulabani',
                                        'Pilibhit',
                                        'Pithoragarh',
                                        'Porbandar',
                                        'Port Blair',
                                        'Prayagraj',
                                        'Puducherry',
                                        'Puducherry (Union Territorherry (Union Territory)',
                                        'Pudukkottai',
                                        'Punch',
                                        'Pune',
                                        'Punjab',
                                        'Puri',
                                        'Purnia',
                                        'Purulia',
                                        'Pusa',
                                        'Pushkar',
                                        'Rae Bareli',
                                        'Raichur',
                                        'Raiganj',
                                        'Raipur',
                                        'Raisen',
                                        'Rajahmundry',
                                        'Rajapalaiyam',
                                        'Rajasthan',
                                        'Rajauri',
                                        'Rajgarh',
                                        'Rajkot',
                                        'Rajmahal',
                                        'Rajnandgaon',
                                        'Ramanathapuram',
                                        'Rampur',
                                        'Ranchi',
                                        'Ratlam',
                                        'Ratnagiri',
                                        'Rewa',
                                        'Rewari',
                                        'Rohtak',
                                        'Rupnagar',
                                        'Sagar',
                                        'Saharanpur',
                                        'Saharsa',
                                        'Salem',
                                        'Samastipur',
                                        'Sambalpur',
                                        'Sambhal',
                                        'Sangareddi',
                                        'Sangli',
                                        'Sangrur',
                                        'Santipur',
                                        'Saraikela',
                                        'Sarangpur',
                                        'Sasaram',
                                        'Satara',
                                        'Satna',
                                        'Sawai Madhopur',
                                        'Sehore',
                                        'Seoni',
                                        'Sevagram',
                                        'Shahdol',
                                        'Shahjahanpur',
                                        'Shahpura',
                                        'Shajapur',
                                        'Shantiniketan',
                                        'Sheopur',
                                        'Shillong',
                                        'Shimla',
                                        'Shivamogga',
                                        'Shivpuri',
                                        'Shravanabelagola',
                                        'Shrirampur',
                                        'Shrirangapattana',
                                        'Sibsagar',
                                        'Sikar',
                                        'Sikkim',
                                        'Silchar',
                                        'Siliguri',
                                        'Silvassa',
                                        'Sirohi',
                                        'Sirsa',
                                        'Sitamarhi',
                                        'Sitapur',
                                        'Siuri',
                                        'Siwan',
                                        'Solapur',
                                        'Sonipat',
                                        'Srikakulam',
                                        'Srinagar',
                                        'Sultanpur',
                                        'Surat',
                                        'Surendranagar',
                                        'Tamil Nadu',
                                        'Tamluk',
                                        'Tehri',
                                        'Telangana',
                                        'Tezpur',
                                        'Thalassery',
                                        'Thane',
                                        'Thanjavur',
                                        'Thiruvananthapuram',
                                        'Thrissur',
                                        'Tinsukia',
                                        'Tiruchchirappalli',
                                        'Tirunelveli',
                                        'Tirupati',
                                        'Tiruppur',
                                        'Titagarh',
                                        'Tonk',
                                        'Tripura',
                                        'Tumkuru',
                                        'Tuticorin',
                                        'Udaipur',
                                        'Udayagiri',
                                        'Udhagamandalam',
                                        'Udhampur',
                                        'Ujjain',
                                        'Ulhasnagar',
                                        'Una',
                                        'Uttar Pradesh',
                                        'Uttarakhand',
                                        'Valsad',
                                        'Varanasi',
                                        'Vasai-Virar',
                                        'Vellore',
                                        'Veraval',
                                        'Vidisha',
                                        'Vijayawada',
                                        'Visakhapatnam',
                                        'Vizianagaram',
                                        'Warangal',
                                        'Wardha',
                                        'West Bengal',
                                        'Wokha',
                                        'Yanam',
                                        'Yavatmal',
                                        'Yemmiganur',
                                        'Zunheboto'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
            				</div>
            			</div>


						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="edit_profile_job_skills">Skills</label>-->
						<!--	<textarea id="edit_profile_job_skills" class="form-control" type="textarea" name="job_skills" required></textarea>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid skills.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="edit_profile_job_skills"><span style="color:red;">*</span>Skills <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="edit_profile_job_skills" name="job_skills" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
                                    'Analytical',
                                    'Analyze and Recommend Database Improvements',
                                    'Analyze Impact of Database Changes to the Business',
                                    'Audit Database Access and Requests',
                                    'APIs',
                                    'Application and Server Monitoring Tools',
                                    'Application Development ',
                                    'Architecture',
                                    'Artificial Intelligence',
                                    'Attention to Detail',
                                    'AutoCAD',
                                    'Azure',
                                    'Cloud Computing',
                                    'C++',
                                    'C Language',
                                    'Compensation & Benefits',
                                    'Configure Database Software',
                                    'Configuration Management',
                                    'Critical Thinking',
                                    'Database Administration',
                                    'Deploying Applications in a Cloud Environment',
                                    'Develop and Secure Network Structures',
                                    'Develop and Test Methods',
                                    'Emerging Technologies',
                                    'File Systems',
                                    'HTML',
                                    'Implement Backup and Recovery Plan',
                                    'Implementation',
                                    'Information Systems',
                                    'Interaction Design',
                                    'Interaction Flows',
                                    'Install, Maintain, and Merge Databases',
                                    'Integrated Technologies',
                                    'Integrating Security Protocols with Cloud Design',
                                    'Internet',
                                    'JavaScript',
                                    'Java',
                                    'Optimization',
                                    'IT Soft Skills',
                                    'L&D',
                                    'Logical Thinking',
                                    'Leadership',
                                    'Operating Systems',
                                    'Migrating Existing Workloads into Cloud Systems',
                                    'Mobile Applications',
                                    'Open Source Technology Integration',
                                    'Optimizing Website Performance',
                                    'PHP',
                                    'Python',
                                    'Problem Solving',
                                    'Project Management',
                                    'Recruitment',
                                    'Ruby',
                                    'Software Engineering',
                                    'Software Quality Assurance (QA)',
                                    'TensorFlow',
                                    'User-Centered Design',
                                    'UX Design',
                                    'UI / UX',
                                    'Visual Basic',
                                    'Visual FoxPro',
                                    'Web Development',
                                    'Web Design'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
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
            				<label class="d-block" for="job_sector"><span style="color:red;">*</span>Job Sector</label>
            
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
						
						<div class="[ mb-3 ][ form-group ]">
            				<label for="edit_profile_job_type"><span style="color:red;">*</span>Job Type <sub>(You can select multiple job types. To add custom job type, type and press enter. Make sure the text gets blue highlight.)</sub></label>
            				<input id="edit_profile_job_type" name="job_type" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Full time',
            				        'Part time',
            				        'WFH'
                                    ]
                                ">
            				<div class="invalid-tooltip">
            					Please enter key skills.
            				</div>
            			</div>


						<!--<div class="[ mb-3 ][ form-group ]">-->
						<!--	<label for="edit_profile_job_job_code">Job Code</label>-->
						<!--	<input id="edit_profile_job_job_code" class="form-control" type="text" name="job_job_code" required>-->

						<!--	<div class="invalid-tooltip">-->
						<!--		Please provide a valid job code.-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_publish_shedule">Job Publish Schedule</label>
							<input id="edit_profile_job_publish_shedule" class="form-control" type="date" name="job_publish_shedule" >

							<div class="invalid-tooltip">
								Please provide a valid job publish shedule.
							</div>
						</div>


						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_job_application_deadline"><span style="color:red;">*</span>Application Deadline</label>
							<input id="edit_profile_job_application_deadline" class="form-control" type="date" name="job_application_deadline" required>

							<div class="invalid-tooltip">
								Please provide a valid application deadline.
							</div>
						</div>

                        
						
						<div class="[ mb-3 ][ form-group ]">
            				<label class="d-block" for="active_status"><span style="color:red;">*</span>Activation Status</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="active_status_active" value="active" name="active_status" class="custom-control-input" required>
            					<label class="custom-control-label" for="active_status_active">Activate</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="active_status_inactive" value="inactive" name="active_status" class="custom-control-input" required>
            					<label class="custom-control-label" for="active_status_inactive">Deactivate</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
            				</div>
            			</div>

                        <div class="[ mb-3 ][ form-group ]">
            				<label  for="edit_profile_hot_job">Add to Hot Jobs</label>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="edit_profile_hot_job_yes" value="yes" name="hot_jobs" class="custom-control-input" >
            					<label class="custom-control-label" for="edit_profile_hot_job_yes">Yes</label>
            				</div>
            
            				<div class="[ custom-control custom-radio ]">
            					<input type="radio" id="edit_profile_hot_job_no" value="no" name="hot_jobs" class="custom-control-input" >
            					<label class="custom-control-label" for="edit_profile_hot_job_no">No</label>
            
            					<div class="invalid-tooltip">
            						Please select an option.
            					</div>
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

					<div class="[ modal-footer ]">
						<div id="edit_profile_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>
						
						<button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
						<button id="edit_profile_modal_submit" name="edit_profile_modal_submit" type="submit" class="[ btn btn-primary ]">Save</button>
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


	<!-- include summernote js -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=13.04.2023"></script>

	<script>
		$(document).ready(function() {
			
		});
		
	</script>
</body>

</html>
