<?php
ob_start();
	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/**api-expired-jobs is used for deadline over jobs. this api run when you run manage job section. 1st check all deadlines if deadline is over of job then verification status save unverified. */
	require_once $config->paths->templates.'includes/api-expired-jobs.php';

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

		global $order_column;
		global $table_search_value;	
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
	global $post_values;
	$post_values=$_POST;
	// $myfile = fopen($config->paths->templates."includes/newfile.txt", "w");
	//   //  $txt = json_encode($to_return);
	//  $txt = json_encode($post_values);
	//  fwrite($myfile, $txt);
	// 	fwrite($myfile, "Hello demo");
	// 	fclose($myfile);
		


	/* If the request is done without proper log in, exit */
	if(!in_array($session->user_designation, ["editor"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}

	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		
		end_and_return();
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post('requested_action_to_take', ["fetch_job_table_data", "delete_jobs", "modify_job", "create_job", "unlock_profiles","unverify_profiles","multiple_job_verify","multiple_job_unverify"], false);
// 	$upload_path = wire('config')->paths->assets;//. 
// 	$job_image = new WireUpload('job_profile_image');
// print_r($job_image);
// echo "xya";
// $image=$_FILES['job_profile_image'];
// print_r($image);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case 'fetch_job_table_data':
			fetch_job_table_data();
		break;

		case 'delete_jobs':
			/* Save the data sent from the form */
			$requested_profiles_to_delete_json = $input->post("requested_profiles_to_delete_json", "string", false);

			if(!$requested_profiles_to_delete_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			delete_jobs($requested_profiles_to_delete_json);
		break;

// 		case 'modify_job':
// 			/* Save the data sent from the form */
// 			$edit_profile_form_details = $input->post("edit_profile_form_details", "string", false);

// 			if(!$edit_profile_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}
// 			modify_job($edit_profile_form_details);
// 		break;

// 		case 'create_job':
// 			/* Save the data sent from the form */
// 			$new_job_form_details = $input->post("new_job_form_details", "string", false);

// 			if(!$new_job_form_details){
// 				$to_return->error->number_of_errors++;
// 				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
// 				end_and_return();
// 			}

// 			create_job($new_job_form_details);
// 		break;
		
		case 'unlock_profiles':
			/* Save the data sent from the form */
			$requested_job_profile_to_unlock = $input->post("requested_job_profile_to_unlock", "text", false);

			if(!$requested_job_profile_to_unlock){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unlock_profiles($requested_job_profile_to_unlock);
			end_and_return();
		break;
		
		case 'unverify_profiles':
			/* Save the data sent from the form */
			$requested_job_profile_to_unverify_profiles = $input->post("requested_job_profile_to_unverify_profiles", "text", false);

			if(!$requested_job_profile_to_unverify_profiles){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			unverify_profiles($requested_job_profile_to_unverify_profiles);
			end_and_return();
		break;
		
		case 'multiple_job_verify':
			/* Save the data sent from the form */
			$requested_profiles_to_verify_json = $input->post("requested_profiles_to_verify_json", "textarea", false);

			if(!$requested_profiles_to_verify_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_job_verify($requested_profiles_to_verify_json);
			end_and_return();
		break;

		case 'multiple_job_unverify':
			/* Save the data sent from the form */
		//	echo "*********";
			$requested_profiles_to_unverify_json = $input->post("requested_profiles_to_unverify_json", "textarea", false);
// echo $requested_profiles_to_unverify_json;
// echo "***********";
			if(!$requested_profiles_to_unverify_json){
				$to_return->error->number_of_errors++;
				$to_return->error->error_message  = "Request failed. Please refresh and try again.";
				end_and_return();
			}
			multiple_job_unverify($requested_profiles_to_unverify_json);
			end_and_return();
		break;

		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}

	/* Function to fetch the data of all jobs to show in the table */
	function fetch_job_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $post_values;

			/**define search filter array field for append all filter into one array */
	$search_filter_array = Array();
	/**add datables filters in array */
		$post_draw=1;
		if(isset($_POST['draw'])){
			$post_draw=$_POST['draw'];
		}
		$post_colums="";
		if(isset($_POST['columns'])){
			$post_colums=$_POST['columns'];
			$to_return->columns=$post_colums;
		}
		$post_search="";
		if(isset($_POST['search'])){
			$post_search=$_POST['search'];
		}
		$post_start=0;
		// $post_length=false;
		if(isset($_POST['start'])){
			$post_start=$_POST['start'];
			$search_filter_array[]="start=".$post_start;
			$search_filter_array[]="limit=100000";
			$to_return->start=$post_start;
			$to_return->limit=$post_start;
		  $to_return->search_filter_array=$search_filter_array;
		}
		$to_return->start=$post_start;
		// $search_filter_array[]="start=0";
		$post_length=0;
		if(isset($_POST['length'])){
			$post_length=$_POST['length'];
		// $search_filter_array[]="limit=".$post_length;
		$to_return->limit=$post_length;
		}
		/**Access post value of order */
	$post_order=array();
	$order_column=0;
	$order_direction="";
	$table_search_value="";
	$columns_array=array();
	$search_filter_on_table=array();
	$search_filter_selector=array();
	$search_filter_on_table_search=array();
	if(isset($_POST['order'])){
		$post_order=$_POST['order'];
		// $order=json_decode($post_order);
		$to_return->order=$post_order;
		 $to_return->post_values=$post_colums[0]['data'];

		foreach($post_values as $key=>$value){
			if($key=="order"){
				$order_value=$value;
				$to_return->order_value=$order_value;//debug
				// $ordeer=json_decode($order_value[0]);
				$order_column=$order_value[0]['column'];
				$order_direction=$order_value[0]['dir'];
				$to_return->order_requested=$order_column;//debug
				if($order_column=="0" && $order_direction=="asc"){
					$order_column=3;
					$order_direction="desc";
				}
				elseif($order_column<="2"){
					// $order_column=$order_column-1;
					$order_column=3;
				}
				else{
					$order_column=$order_column;
				}
				
				$to_return->order=$order_column;//debug
				$to_return->order_dir=$order_direction;//debug
				if($order_column!=0){
					$order_column_to_sort_name=$post_colums[$order_column]['data'];
					if($order_column_to_sort_name=="registration_time"){
						$order_column_to_sort_name="published";
					}
					elseif($order_column_to_sort_name=="job_publish_shedule_for_table"){
						$order_column_to_sort_name="job_publish_shedule";
					}
					elseif($order_column_to_sort_name=="application_deadline_for_table"){
						$order_column_to_sort_name="application_deadline";
					}
					elseif($order_column_to_sort_name=="last_modified_date"){
						$order_column_to_sort_name="last_modified_date";
					}
					elseif($order_column_to_sort_name=="hot_jobs"){
						$order_column_to_sort_name="is_hot_jobs";
					}
					elseif($order_column_to_sort_name=="recruiter_company_name"){
						$order_column_to_sort_name="job_added_by";
					}
					if($order_direction=="desc"){
						$search_filter_array[]="sort=-".$order_column_to_sort_name;
					}
					else{
						$search_filter_array[]="sort=".$order_column_to_sort_name;
					}
				}
				else{
					$search_filter_array[]="sort=-published";
				}

			}

			if($key=="search"){
				$search_value=$value;
				$table_search_value=$search_value['value'];
				$to_return->search=$search_value;
				$to_return->search_sort=$table_search_value;
			}
			
			// for($i=0;$i<60;$i++){
			
				/**search filter */
				
				//$exception_search_fields=["registration_time","date_of_birth","custom_phone_number","custom_whatsapp_number","custom_ctc","referrer_page_id","profile_picture","linkedin"];
				// "current_city","current_state","tell_us_about_yourself","how_did_you_know_about_us","qualification","course","specialisation","year_of_passing","college","cartifications","internship_apply","age16over","internship_month","industry","functional_area","experience_years","experience_months","current_employer","current_role","job_code","skills","technical_skills","non_technical_skills","soft_skills","current_ctc_time","current_ctc","pwd_accomodation","referred_by","referrer_email","event_code",
				// $search_filter_on_table=array_diff($requested_columns_to_show,$exception_search_fields);
				// // if(in_array("custom_full_name",$search_filter_on_table)){
				// if (($key = array_search('custom_full_name', $search_filter_on_table)) !== false) {
				// 	// $key="custom_full_name";
				// 		unset($search_filter_on_table[$key]);
				// 		$search_filter_on_table[]="first_name";
				// 		$search_filter_on_table[]="last_name";
				// 		$to_return->search_filter_on_table=$search_filter_on_table;
				// }

				// if (($key = array_search('custom_experience', $search_filter_on_table)) !== false) {
				// 	// $key="custom_full_name";
				// 		unset($search_filter_on_table[$key]);
				// 		$search_filter_on_table[]="experience_months";
				// 		$search_filter_on_table[]="experience_years";
				// 		$to_return->search_filter_on_table=$search_filter_on_table;
				// }
				// $to_return->search_filter_on_table=$search_filter_on_table;

				//}
				// foreach($search_filter_on_table as $key=>$value){
				// 	$search_filter_on_table[]=$value;
				// }

				
			


			//  $to_return->post_colums=$post_colums[$order_column]['data'];
			
			// 	$to_return->post_colums="sort=".$post_colums[$order_column]['data'];
		}
		foreach($post_colums as $single_column){
			$columns_array[]=$single_column['data'];
			// $i="0";
			//  $to_return->column_array_filter=$single_column['data'];
			//  $to_return->column_array_filteri=$post_colums[$i]['data'];
		}
	}
	/**define all columns in one array for exceptional cases */
	$exception_search_fields=["checkbox","unlock_button","serial_number","registration_time","recruiter_company_name","last_modified_date","job_publish_shedule_for_table","application_deadline_for_table","hot_jobs","applicants_list_button","edit","job_preview"];
	$search_filter_on_table=array_diff($columns_array,$exception_search_fields); 
	// if (($key = array_search('hot_jobs', $search_filter_on_table)) !== false) {
	// 		unset($search_filter_on_table[$key]);
	// 		$search_filter_on_table[]="is_hot_jobs";
	// 		$to_return->search_filter_on_table=$search_filter_on_table;
	// }
	$search_filter_selector=implode("|",$search_filter_on_table);
	// $to_return->filter_selector_for_search=$columns_array;
	//  $search_filter_on_table_search[]=($search_filter_selector."%=".$table_search_value);
	if($table_search_value!=""){
		$search_filter_array[]=($search_filter_selector."%=".$table_search_value);
	}	 
	
	//$filter_selector_for_search=implode(",",$search_filter_on_table);
	$to_return->filter_selector_for_search=$search_filter_array;
	// $to_return->search_filter_selector=$search_filter_on_table_search;
	// $to_return->post_colums=$post_colums[$order_column]['data'];
	// foreach($post_colums as $single_column){
	// 	if($order_direction=="desc"){
	// 		$search_filter_array[]="sort=-".$post_colums[$order_column]['data'];
	// 	}
	// 	else{
	// 		$search_filter_array[]="sort=".$post_colums[$order_column]['data'];
	// 	}
	// }
	
		// $to_return->error->number_of_errors++;
		// $to_return->error->error_message  = "Request failed. Please refresh and try again...";
		// end_and_return();
		/**Get job added by id of recruiter.*/
		/**Apply filter on jobs using recruiter id (including super recruitr & sub-recruiter) */
		$recruiter_page_array=array();
		// echo "****";
		// print_r($_GET['job_added_by']);
		if(isset($_GET['job_added_by'])){
			// echo "***";
			$job_added_by=$_GET['job_added_by'];
			$recruiter_page = wire("pages")->get("id=".$job_added_by);
			$recruiter_page_array[].=$recruiter_page->id;
			foreach(wire("pages")->get("id=".$job_added_by)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
				$recruiter_page_array[].=$sub_recruiter_page->id;
			}
			$recruiter_ids=implode("|",$recruiter_page_array);
			$search_filter_array[]=("job_added_by=".$recruiter_ids);
			// print_r($search_filter_array);
			// $search_filter_array[]="job_added_by*=".$_GET['job_added_by'];
			$to_return->job_added_by=$_GET['job_added_by'];
			

		}
	
		
		/* Array to save all the data of all the jobs into */
		$job_data_array = Array();
		 $to_return->filter_selector_array=$search_filter_array;//debug
		   $filter_selector=implode(",",$search_filter_array);
			  $to_return->filter_selector=$filter_selector;//debug
		/* Loop through all the job profile pages */
		$serial_counter=1;
		$loop_counter=1;

		 $all_jobs_array=wire('pages')->get("name=jobs")->children($filter_selector);
		$recordsTotal=sizeof($all_jobs_array);
		$to_return->recordsTotal=$recordsTotal+$post_start;
		// foreach(wire('pages')->get("name=jobs")->children("sort=published") as $job_page) {
			foreach($all_jobs_array as $job_page) {

				if($loop_counter>$post_length){
					break;
				}

			/* Each candidate's data is to be saved in a seperate object */
			$job_data = new stdClass();

			// $job_page->verification="verified";
			// $job_page->active_status="active";

			// $job_page->of(false);
			// $job_page->save();
			/* Create array if favourites are empty */
			if($job_page->verified == ""){
				$job_page->verified == "unverified";
			}

			$job_data->id = $job_page->id;
			$job_data->title = $job_page->title;
	    $to_return->job_title=$job_data->title;	
			$job_data->experience = $job_page->experience;
			$job_data->min_experience = $job_page->min_experience;
			$job_data->max_experience = $job_page->max_experience;
			$job_data->application_deadline = date("Y-m-d", intval($job_page->application_deadline));
			$job_data->application_deadline_for_table = date("d M Y", intval($job_page->application_deadline));
			$job_data->job_code = $job_page->job_code;
			$job_data->job_type = $job_page->job_type;
			$job_data->job_sector = $job_page->job_sector;
			$job_data->location = $job_page->location;
			$job_data->skills = $job_page->skills;
			$job_data->summary = $job_page->summary;
			$job_data->company_name = $job_page->company_name;
			$job_data->ctc = $job_page->ctc;
			$job_data->position = $job_page->position;
			if($job_page->job_image!=""){
			    $job_data->job_image = $job_page->job_image->httpUrl;
			}
			else{
			    $job_data->job_image = $job_page->job_image;
			}
			if($job_page->is_hot_jobs!=""){
				// if($job_page->is_hot_jobs=="yes"){
				// 	$job_data->hot_jobs = "Yes";
				// }
				// else{
				// 	$job_data->hot_jobs = "No";
				// }
				$job_data->hot_jobs=$job_page->is_hot_jobs;
			}
			else{
				$job_data->hot_jobs = "no";
			}
			$job_data->active_status=$job_page->active_status;
			//$job_data->job_publish_shedule=$job_page->job_publish_shedule;
			if($job_page->job_publish_shedule !=""){
    				$job_data->job_publish_shedule = date("Y-m-d", intval($job_page->job_publish_shedule));
			        $job_data->job_publish_shedule_for_table = date("d M Y", intval($job_page->job_publish_shedule));
			}
			else{
			    $job_data->job_publish_shedule_for_table="-";
			}
			
// 			$job_data->job_publish_shedule = date("Y-m-d", intval($job_page->job_publish_shedule));
// 			$job_data->job_publish_shedule_for_table = date("d M Y", intval($job_page->job_publish_shedule));
//             $job_data->job_publish_shedule = date("Y-m-d", $job_page->job_publish_shedule);
//             echo $job_page->job_publish_shedule;
// 			$job_data->job_publish_shedule_for_table = date("d M Y", $job_page->job_publish_shedule);
			$job_data->registration_time=$job_page->published +  60*60*5.50;
			$job_data->registration_time=date('d/m/Y h:i A', $job_data->registration_time);
			if($job_page->last_modified_date !=""){
				$job_data->last_modified_date=$job_page->last_modified_date +  60*60*5.50;
				$job_data->last_modified_date = date("d M Y h:i A", intval($job_data->last_modified_date));
			}
			else{
				$job_data->last_modified_date="-";
			}

			$job_data->serial_number=$serial_counter+$post_start;
			$serial_counter++;
			$loop_counter++;
			
			$applicants_list_link=wire('pages')->get("name=admin-candidate-table")->httpUrl."?job_code=".$job_data->job_code;
			
			$job_data->applicants_list_button="<a target='_blank' href='".$applicants_list_link."' id='".$job_page->id."_applicants_list_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Applicants</a>";
			
			//$user_page_id='5689';
			if($job_page->job_added_by !=0){
    			
				$admin_page=wire('pages')->get("name=admins")->child("id=".$job_page->job_added_by);
				//echo $admin_page->company_name;
				$editor_page=wire('pages')->get("name=editors")->child("id=".$job_page->job_added_by);
				$recruiter_page=wire('pages')->get("name=recruiters")->child("id=".$job_page->job_added_by);
				$recruiter_page=wire('pages')->get("id=".$job_page->job_added_by);
				//echo $recruiter_page;
				
				if($admin_page->id!=0){
					$job_data->recruiter_company_name=$admin_page->title;
				}
				elseif($recruiter_page->id!=0){
					$job_data->recruiter_company_name=$recruiter_page->email;
				}
				elseif($editor_page->id!=0){
					$job_data->recruiter_company_name=$editor_page->title; 
				}
				else{
					$job_data->recruiter_company_name="-";
				}
			}
			else{
			    $job_data->recruiter_company_name="-";
			}
			/**Current timestamp  */
			// $current_timestamp=strtotime(date("Y-m-d"));
			//  echo $current_timestamp;
			//  echo "**********";
			// /** get daadline of job*/
			// $job_deadline_timestamp = strtotime(date("Y-m-d", intval($job_page->application_deadline)));
			//  echo $job_deadline_timestamp;
			//  echo "----------";

			// if($current_timestamp > $job_deadline_timestamp){
			// 	echo $job_page->id;
			// 	echo "++++++++++++++";
			// 	$job_page->verified == "unverified";
			// 	$job_page->of(false);
			// 	$job_page->save();
			// }


			/* Other column data in the table */
			$job_data->checkbox = "<input id='".$job_page->id."_checkbox' class='job_checkbox' type='checkbox'>";
			$job_data->edit = "<button id='".$job_page->id."_edit_button' class='[ btn btn-primary ]( profile_edit_button )' type='button'><i class='[ mr-2 ][ fas fa-user-edit ]'></i>Edit Job</button>";
			/* Other column data in the table */
			$job_data->unlock_button = "<button id='".$job_page->id."_unlock_button' class='[ btn btn-primary ]( unlock_button ) btn_table_verification' type='button'><i class='[ mr-2 ][ fas fa-unlock ]'></i>Verify</button>";

			$job_preview_link=$job_page->httpUrl;
			// echo "***********";
			// echo $job_preview_link;
			$job_data->job_preview = "<a target='_blank' href='".$job_preview_link."' id='".$job_page->id."_preview_button' class='[ btn btn-outline-primary ]' type='button'><i class='[ mr-1 ][ fas fa-eye ]'></i>Preview</a>";
			
			/* If nothing to be unlocked, hide button */
			if($job_page->verification== "verified"){
				//$job_data->unlock_button = "-";
				$job_data->unlock_button = "<button id='".$job_page->id."_unverify_button' class='[ btn btn-outline-danger ]( unverify_button ) btn_table_verification' type='button'><i class='[ mr-2 ][ fas fa-ban ]'></i>Unverify</button>";
			}

            
        //   $job_data->button = " <div class='btn-group'> 
        //         <a target='_blank' href='".$applicants_list_link."' id='".$job_page->id."_applicants_list_button' class='[ btn btn-outline-primary ]'><i class='fa fa-eye'></i>
        //         </a>
        //         <button type='button' data-toggle='dropdown' class='btn btn-primary dropdown-toggle'><span class='caret'></span>
        //         </button>
        //         <ul class='dropdown-menu dropdown-menu-right'>
        //           <li><a id='".$job_page->id."_edit_button' class='dropdown-item ( profile_edit_button )' style='cursor: pointer;'><i class='fa fa-pencil' type='button' ></i> Edit Job</a></li>
        //           <li><a id='".$job_page->id."_unlock_button' class='dropdown-item ( unlock_button )' style=';cursor: pointer;'><i class='fa fa-check'></i> Verify</a></li>
        //           <li><a id='".$job_page->id."_unverify_button' class='dropdown-item ( unverify_button )' style='cursor: pointer;'><i class='fa fa-cross'></i> Unverify</a></li>
        //         </ul>
        //      </div>";
                    
			/* Save the job data object into the main array of all the job data */
			array_push($job_data_array, $job_data);
		}
		/* Loop through all the job profile pages END */

		/* Save the job data array into the object that is to be sent back */
		$to_return->data = $job_data_array;
		$recordsFiltered=sizeof($all_jobs_array);
		$to_return->recordsFiltered=$recordsFiltered+$post_start;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"", "data"=>"checkbox"],
			["title"=>"Verification", "data"=>"unlock_button"],
			["title"=>"Sr.no", "data"=>"serial_number"],
			["title"=>"Job Code", "data"=>"job_code"],
			["title"=>"Title", "data"=>"title"],
			["title"=>"Company", "data"=>"company_name"],
			["title"=>"Location", "data"=>"location"],
			["title"=>"Created Time", "data"=>"registration_time"],
			["title"=>"Created By", "data"=>"recruiter_company_name"],
			["title"=>"Updated Time", "data"=>"last_modified_date"],
			["title"=>"Job Publishing shedule", "data"=>"job_publish_shedule_for_table"],
			["title"=>"Deadline", "data"=>"application_deadline_for_table"],
			["title"=>"Active status", "data"=>"active_status"],
			["title"=>"Add to Hot Jobs", "data"=>"hot_jobs"],
			["title"=>"Applicants List", "data"=>"applicants_list_button"],
			["title"=>"Edit", "data"=>"edit"],
			["title"=>"Preview", "data"=>"job_preview"]
// 			["title"=>"Button", "data"=>"button"]
			
		];


		$myfile = fopen(wire('config')->paths->templates."includes/newfile.txt", "w");
		$txt = json_encode($to_return);
	  // $txt = json_encode($post_values);
		fwrite($myfile, $txt);
		fwrite($myfile, "Hello demo");
		fclose($myfile);

		$to_return->success->success_status = true;

		 
		

		end_and_return();
	}
	/* Function to fetch the data of all jobs to show in the table END */

	/* Function to delete job accounts based on given IDs */
	function delete_jobs($requested_profiles_to_delete_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_delete = json_decode($requested_profiles_to_delete_json);

		/* Check if the sent array has zero or more than ten elements. Only 10 can be deleted at a time */
		if(count($requested_profiles_to_delete) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were deleted.";
			end_and_return();
		}
		// elseif (count($requested_profiles_to_delete) > 10) {
		// 	$to_return->error->number_of_errors++;
		// 	$to_return->error->error_message  = "Only 10 profiles can be deleted at a time.";
		// 	end_and_return();
		// }

		$successfully_deleted_profiles = Array();

		/* Delete each requested profile */
		foreach ($requested_profiles_to_delete as $profile_to_delete_id) {
			if(wire("pages")->get("name=jobs")->child("id=".$profile_to_delete_id)->trash()){
				$successfully_deleted_profiles[] = $profile_to_delete_id;
			}
		}
		/* Delete each requested profile END */

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

	/* Function to modify the information of an job profile from POST data */
// 	function modify_job($edit_profile_form_details){
// 		/* Access global variable that is to be returned */
// 		global $to_return;

// 		/* Convert json form data into required format */
// 		$edit_profile_form_details = json_decode($edit_profile_form_details);

// 		/* Array to save data and then to save into the page */
// 		$edit_job_details_to_save = Array();

// 		foreach ($edit_profile_form_details as $input_element) {
// 			$edit_job_details_to_save[$input_element->name] = $input_element->value;
// 		}
// 		/* Array to save data and then to save into the page END */

// 		/* Get the job page to edit based on the ID */
// 		$job_page_to_change = wire('pages')->get($edit_job_details_to_save['id']);
// 		$job_page_to_change->of(false);

// 		/* Save the data */
// 		$job_page_to_change->title = $edit_job_details_to_save['job_title'];
// 		$job_page_to_change->company_name = $edit_job_details_to_save['job_company_name'];
// 		//$job_page_to_change->experience = $edit_job_details_to_save['job_experience'];
// 		$job_page_to_change->max_experience = $edit_job_details_to_save['job_experience_max'];
//         $job_page_to_change->min_experience = $edit_job_details_to_save['job_experience_min'];
// 		$job_page_to_change->location = $edit_job_details_to_save['job_location'];
// 		$job_page_to_change->skills = $edit_job_details_to_save['job_skills'];
// 		$job_page_to_change->position = $edit_job_details_to_save['job_position'];
// 		$job_page_to_change->ctc = $edit_job_details_to_save['job_ctc'];
// 		$job_page_to_change->summary = $edit_job_details_to_save['job_summary'];
// 		$job_page_to_change->job_sector = $edit_job_details_to_save['job_sector'];
// 		$job_page_to_change->job_type = $edit_job_details_to_save['job_type'];
// 		$job_page_to_change->application_deadline = $edit_job_details_to_save['job_application_deadline'];
// 		$job_page_to_change->job_publish_shedule = $edit_job_details_to_save['job_publish_shedule'];
// 		$job_page_to_change->active_status = $edit_job_details_to_save['active_status'];
// 		//echo $edit_job_details_to_save['active_status'];
// 		//$sanitizer->text($input->post->active_status);

// 		/* Save page */
// 		$job_page_to_change->save();

// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "Modified job profile with the name ".$job_page_to_change->title = $edit_job_details_to_save['job_title'];
// 		end_and_return();
// 	}
	/* Function to modify the information of an job profile from POST data END*/

	/* Function to create a new job based on given data in POST */
// 	function create_job($new_job_form_details){
// 		/* Access global variable that is to be returned */
// 		global $to_return;
// //echo $upload_image;
// 		/* Convert json form data into required format */
// 		$new_job_form_details = json_decode($new_job_form_details);

// 		/* Array to save data and then to save into the page */
// 		$new_job_details_to_save = Array();

// 		foreach ($new_job_form_details as $input_element) {
// 			$new_job_details_to_save[$input_element->name] = $input_element->value;
// 		}
// 		/* Array to save data and then to save into the page END */

// 		/* New job Page info */
// 		$new_job_page = wire(new Page());
// 		$new_job_page->template = wire('templates')->get("job-page");
// 		$new_job_page->parent = wire('pages')->get("name=jobs");

// 		$new_job_page->title = $new_job_details_to_save['job_title'];
// 		$new_job_page->company_name = $new_job_details_to_save['job_company_name'];
// 		//$new_job_page->experience = $new_job_details_to_save['job_experience_max']."-".$new_job_details_to_save['job_experience_min'];
//         $new_job_page->max_experience = $new_job_details_to_save['job_experience_max'];
//         $new_job_page->min_experience = $new_job_details_to_save['job_experience_min'];
// 		$new_job_page->location = $new_job_details_to_save['job_location'];
// 		$new_job_page->skills = $new_job_details_to_save['job_skills'];
// 		$new_job_page->position = $new_job_details_to_save['job_position'];
// 		$new_job_page->ctc = $new_job_details_to_save['job_ctc'];
// 		$new_job_page->summary = $new_job_details_to_save['job_summary'];
// 		//$new_job_page->job_code = $new_job_details_to_save['job_job_code'];
// 		$new_job_page->job_type = $new_job_details_to_save['job_type'];
// 		$new_job_page->job_sector = $new_job_details_to_save['job_sector'];
// 		$new_job_page->active_status = $new_job_details_to_save['active_status'];
// 		$new_job_page->application_deadline = $new_job_details_to_save['job_application_deadline'];
// 		$new_job_page->job_publish_shedule = $new_job_details_to_save['job_publish_shedule'];
// 		$new_job_page->verification = "verified";
// 		$new_job_page->job_added_by = wire('session')->user_page_id;
		
// 		/* Define the temporary path to upload the file before saving the files to the CMS page */
// 		$upload_path = wire('config')->paths->assets;//. "files/temp-files/";

// 		/* Uploading and saving of profile image */
// 		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
// // 		$job_image = new WireUpload('job_profile_image');
// // print_r($job_image);

// 		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
// // 		$job_image->setMaxFiles(1);
// // 		$job_image->setOverwrite(false);
// // 		$job_image->setDestinationPath($upload_path);
// // 		$job_image->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

// 		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
// 		//$files = $job_image->execute();

// 		/** Checking of errors while uploading the files. Run a count($files) test to make sure there are actually files; if so, proceed; if not, generate getErrors() */
// 		/*** If the application is being edited, there already is an image uploaded, so there is no need to create any errors in case it's an editing request not a create-new-profile one */
// 		//echo "===================";
// 		//echo count($files);
// 		//if(!count($files)){
// //     		if($data_to_return->profile_to_edit){
    
// //     		}
// // 		/*** If $files contains nothing, save the error message. */
// //     		elseif(!count($files)){
// //     			$data_to_return->error = true;
// //     			$data_to_return->error_text[] = "No photo uploaded. Please make sure to upload a picture in .jpg or .png format under 2Mb.";
// //     		}
// // 		/*** Here, $files contains a file. So we proceed to save the image file to the candidate profile page. */
// //     		else{
// //     			/**** Delete the previous image available if the page is being edited. */
// //     			if($data_to_return->profile_to_edit){
// //     				$np->profile_image->deleteAll();
// //     			}

//  			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
// // echo "1";
// // 			foreach($files as $filename) {
// // echo "2";
// // 				$pathname = $upload_path . $filename;
// // echo "3";
// // 				$new_job_page->job_image->add($pathname);
// // echo "4";
// // 				$new_job_page->message("Added file: $filename");
// // echo "5";
// // 				unlink($pathname);
// // 			}
// // echo "6";			
// 		/* Save page */
// 		$new_job_page->of(false);
// 		$new_job_page->save();
// 		//}
// 	//}
// 		/* Uploading and saving of profile image END */
		
// 			/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
//     			/**** Get serial ID from the serial ID page */
//     			$job_code_serial_id_counter_page = wire('pages')->get("name=job-code-serial-id-counter");
//     			/**** Assign the given ID to the  new page and increment the number for the next page */
//     			$new_job_page->job_code = $job_code_serial_id_counter_page->serial_id++;
//     //echo"5";
//     			/**** save the incremented ID page */
//     			$job_code_serial_id_counter_page-> of(false);
//     			$job_code_serial_id_counter_page->save();
//     			/*** Amruta Jagatap Job code Serial ID created from the ID counter page END */


// 		/* Save page */
// 		$new_job_page->of(false);
// 		$new_job_page->save();


// 		/* Return data */
// 		$to_return->success->success_status = true;
// 		$to_return->success->success_message = "New job created with the name ".$new_job_page->title = $new_job_details_to_save['job_title'];
// 		end_and_return();
// 	}
	/* Function to create a new job based on given data in POST END*/
	
		/* Function to unlock editor's favourite based on given editor IDs */
	function unlock_profiles($requested_job_profile_to_unlock){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$job_page = wire("pages")->get("id=".$requested_job_profile_to_unlock);
		$job_page->of(false);

		/* If editor not found, return */
		if($job_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}

		$job_page->verification = "verified";



		/* save the page */
		$job_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been verified.";

		return;
	}
	/* Function to unlock editor's favourite based on given editor IDs END */
	
			/* Function to unlock editor's favourite based on given editor IDs */
	function unverify_profiles($requested_job_profile_to_unverify_profiles){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Get the page of the editor */
		$job_page = wire("pages")->get("id=".$requested_job_profile_to_unverify_profiles);
		$job_page->of(false);
//echo "1";

		/* If editor not found, return */
		if($job_page->id == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message = "Account not found. Please refresh and ty again.";
			return;
		}
//echo "2";
		$job_page->verification = "unverified";


//echo "3";
		/* save the page */
		$job_page->save();

		$to_return->success->success_status = true;
		$to_return->success->success_message = "Requested profiles have been unverified.";


		return;
	}
	/* Function to unverify editor's favourite based on given editor IDs END */

	/* Function to add multiple profiles to verify based on given IDs */
	function multiple_job_verify($requested_profiles_to_verify_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_verify = json_decode($requested_profiles_to_verify_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_verify) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
 //print_r($requested_profiles_to_verify);
// echo "***********";
		/**Apply foreach loop on requested_profiles_to_verify */
		foreach($requested_profiles_to_verify as $single_job_page){
			/**access single job page using requested id */
			$job_page=wire("pages")->get("id=".$single_job_page);
			//echo $job_page->id;
			/**assign verification status is verified */
			$job_page->verification = "verified";
			/**save job page */
			$job_page->of(false);
			$job_page->save();
		}
		

		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been verified successfully.";

		/* Get the current favourite profiles array */
		//$favourite_profiles_array = json_decode($editor_page->favourite_profiles_array);

		/* If no favourites are already available */
		// if($favourite_profiles_array == ""){
		// 	$favourite_profiles_array = Array();
		// }

		/* Profile IDs that already exist in favourites. */
		// $already_favourited_array = array_intersect($requested_profiles_to_favourite, $favourite_profiles_array);

		/* Remove already existing profiles from the array to add, also remove profiles which are already unlocked*/
		// $profiles_to_favourite = array_diff($requested_profiles_to_favourite, $already_favourited_array, fetch_unlocked_array());

		/* If no profiles are to be added */
		// if(!count($profiles_to_favourite)){
		// 	$to_return->success->success_status = true;
		// 	$to_return->success->success_message  = "All the profiles are already favourited or unlocked.";
		// 	end_and_return();
		// }

		/* Merge the new profiles into the existing array on the editor page */
		//$editor_page->favourite_profiles_array = json_encode(array_merge($favourite_profiles_array, $profiles_to_favourite));

		/* Save the editor page */
		//$editor_page->save();

		//$to_return->success->success_status = true;

		/* If all the requested profiles have been favourited successfully */
		// if(count($profiles_to_favourite) == count($requested_profiles_to_favourite)){
		// 	$to_return->success->success_message = "All the requested profiles have been favourited successfully.";
		// }
		// /* If some profiles were not favourited */
		// else{
		// 	$to_return->success->success_message = "Newly favourited ".count($profiles_to_favourite)." profiles.\nRemaining profiles were already favourited or unlocked.";
		// }

		end_and_return();
	}
	/* Function to add profiles to favourite based on given IDs END */

	/* Function to add multiple profiles to verify based on given IDs */
	function multiple_job_unverify($requested_profiles_to_unverify_json){
		/* Access global variable that is to be returned */
		global $to_return;

		/* Save received JSON data into an array */
		$requested_profiles_to_unverify = json_decode($requested_profiles_to_unverify_json);

		/* Check if the sent array has zero*/
		if(count($requested_profiles_to_unverify) == 0){
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "No Profiles were added.";
			end_and_return();
		}
 //print_r($requested_profiles_to_unverify);
// echo "***********";
		/**Apply foreach loop on requested_profiles_to_unverify */
		foreach($requested_profiles_to_unverify as $single_job_page){
			/**access single job page using requested id */
			$job_page=wire("pages")->get("id=".$single_job_page);
			//echo $job_page->id;
			/**assign verification status is unverified */
			$job_page->verification = "unverified";
			/**save job page */
			$job_page->of(false);
			$job_page->save();
		}
		
		$to_return->success->success_status = true;
		$to_return->success->success_message = "All the requested profiles have been unverified successfully.";

		end_and_return();
	}
	/* Function to add profiles to unverified based on given IDs END */










