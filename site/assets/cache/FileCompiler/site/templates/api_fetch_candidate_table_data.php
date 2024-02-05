<?php
$myfile = fopen($config->paths->templates."includes/newfile.txt", "w");

// $txt = json_encode($_POST);
// fwrite($myfile, $txt);
// fwrite($myfile, "Hello demo");
// fclose($myfile);
// die();
 //die();
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
// 	//Tell the browser to redirect to the HTTPS URL.
// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 	//Prevent the rest of the script from executing.
// 	exit;
// }
$print_to_file=false;

	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/* For column names and variables */
 require_once(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/candidate_table_data.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

// print_r($_POST);
// die();


	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();

	global $order_column;
	global $table_search_value;
	global $recruiter_application_from;
	global $recruiter_application_to;
	global $recruiter_candidate_status_filter;
	global $isset_job_code;
	global $event_code;
	global $job_code;
	/* Errors and messages to show to the client. This is handles by Js in frontend */
	$to_return->error = new stdClass();
	$to_return->error->number_of_errors = 0;
	$to_return->error->error_message = "";
	/* Errors and messages to show to the client. This is handles by Js in frontend END */

	/* function to end the API call at any moment and display the outputs */
	function end_and_return(){
		/* Access global variable that is to be returned */
		global $to_return, $blak;
		/* Access global variable that is to be returned END */

		/* Managing Errors and error message in case no message has been logged */
		if($to_return->error->number_of_errors > 0 && $to_return->error->error_message == ""){
			$to_return->error->error_message = "Something went wrong, please refresh the page and try again.";
		}
		/* Managing Errors and error message END */

		/* Display output as a JSON string */
		echo json_encode($to_return);
		/* Display output as a JSON string END */

		exit();
	}
	/* function to end the API call at any moment and display the outputs */

	// /* TODO find out the problem here and remove this line. This line should not be required. Added as a last resort. the two of the following-*/
	// $all_columns["Uploaded Files"]["redacted_resume"] = "Redacted Resume";
	// $all_columns["Additional Details"]["job_code"] = "Job Code";

	/* If the request is done without proper log in, exit */
	if(!in_array($session->user_designation, ["admin", "editor", "recruiter"])){
		$to_return->error->number_of_errors++;
		$to_return->error->error_message  = "Please log in again and try.";
		end_and_return();
	}
//global $filter_selector;
$post_values=$_POST;
$search_filter_array= Array();

/**add datables filters in array */
$post_draw=0;
if(isset($_POST['draw'])){
$post_draw=$_POST['draw'];
}
$post_colums="";
if(isset($_POST['columns'])){
$post_colums=$_POST['columns'];
}
$post_search="";
if(isset($_POST['search'])){
$post_search=$_POST['search'];

// $search_filter_array[]="search*=".$table_search_value;
// $to_return->search=$table_search_value;
}
$post_start=0;
// $post_length=false;
if(isset($_POST['start'])){
$post_start=$_POST['start'];
$search_filter_array[]="start=".$post_start;
$search_filter_array[]="limit=100000";
$to_return->start=$post_start;
}
$to_return->start=$post_start;
// $search_filter_array[]="start=0";
$post_length=0;
if(isset($_POST['length'])){
$post_length=$_POST['length'];
//$search_filter_array[]="limit=".$post_length;
}


// $search_filter_array[]="limit=2";

/**End array */
//print_r($_GET['job_code']);
	/* If no POST request is made, exit with an error message */
	// $to_return->error->error_message_temp  = "abc";
	$is_skip_unlock=true;
	$isset_job_code=false;
	if(isset($_GET['job_code'])){
			
	    $search_filter_array[]="job_code*=".$_GET['job_code'];
			$to_return->job_code=$_GET['job_code'];
			$job_code=$_GET['job_code'];
			$is_skip_unlock=false;
			$isset_job_code=true;
			// echo $_GET['job_code'];
			// echo "job_code";
	}
	$isset_filter_form=false;
	if(isset($_POST['filter_form'])){
		if($_POST['filter_form']=="true"){
			$isset_filter_form=true;
		}
	}

	$isset_candidate_filter=false;
	if(isset($_POST['candidate_filter'])){
		if($_POST['candidate_filter']=="true"){
			$isset_candidate_filter=true;
		}
	}


	/**Access event code from url */
	if(isset($_GET['event_code'])){ 
		// echo "77777";
		/**Apply event code filter on candidates page */
		$event_code=$_GET['event_code'];
		$search_filter_array[]="event_code%=".$_GET['event_code'];
		//$to_return->event_code_filter=$search_filter_array;

	}
	elseif($isset_filter_form == true ){
		// echo "8888";
		// die();
		// global $recruiter_application_from;
		// global $recruiter_application_to;
		$search_form_details=$input->post("search_form_details");
		$search_form_details_array=json_decode($search_form_details);
		
		// print_r($search_form_details_array);

        /* Array to save data and then to save into the page */
		$form_inputs_array = array();
		$print_to_file=true;
		foreach ($search_form_details_array as $input_element) {
			$form_inputs_array[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */
     
		//print_r($form_inputs_array)   ;    
		// 		if($form_inputs_array['registered_before']!=""){
						
		// 		    $search_filter_array[]=$search_filter_details_array['registered_before'];
		// 		}
				
		// 		$key_skills = $sanitizer->text($input->post->key_skills);
		// 		$key_skills_array=[];
		// 		$key_skills_array['key_skills']=$key_skills;
		$key_skills=$form_inputs_array['key_skills'];
		if($key_skills!=""){
		    $skills_array=array();
		    $skills_array=array_map('trim', array_filter(explode(",",$form_inputs_array['key_skills'])));
		    $skills_implode_data=implode("|",$skills_array);
		    $search_filter_array[]="skills%=".$skills_implode_data;
		}
		if(array_key_exists("preferred_location",$form_inputs_array) && $form_inputs_array['preferred_location']!=""){
		// 		if($form_inputs_array['preferred_location']!=""){
		    $preferred_location_array=array();
		    $preferred_location_array=array_map('trim', array_filter(explode(",",$form_inputs_array['preferred_location'])));
		    $preferred_location_implode_data=implode("|",$preferred_location_array);
		    $search_filter_array[]="preferred_location1|preferred_location2|preferred_location3*=".$preferred_location_implode_data;
		  //  $search_filter_array[]="preferred_location1*=".$preferred_location_implode_data;
		  //  $search_filter_array[]="preferred_location2*=".$preferred_location_implode_data;
		  //  $search_filter_array[]="preferred_location3*=".$preferred_location_implode_data;
		}
		if(array_key_exists("current_city",$form_inputs_array) && $form_inputs_array['current_city']!=""){
		//if($form_inputs_array['current_city']!=""){
		    $current_city_array=array();
		    $current_city_array=array_map('trim', array_filter(explode(",",$form_inputs_array['current_city'])));
		    $current_city_implode_data=implode("|",$current_city_array);
		    $search_filter_array[]="current_city*=".$current_city_implode_data;
		}
		
		if(array_key_exists("registered_before",$form_inputs_array) && $form_inputs_array['registered_before']!=""){
		//if($form_inputs_array['registered_before']!=""){
		  //  $preferred_location_array=array();
		  //  $preferred_location_array=array_map('trim', array_filter(explode(",",$form_inputs_array['registered_before'])));
		  //  $preferred_location_implode_data=implode("|",$preferred_location_array);
		  //$register_before=$form_inputs_array['registered_before'];
		    // $search_filter_array[]="published<".$form_inputs_array['registered_before'];
				$search_filter_array[]="published<".(strtotime($form_inputs_array['registered_before'])- 5.50*60*60);
		}
		//echo $page->published;
	
	    if(array_key_exists("registered_after",$form_inputs_array) && $form_inputs_array['registered_after']!=""){
		//if($form_inputs_array['registered_after']!=""){
		  //  $preferred_location_array=array();
		  //  $preferred_location_array=array_map('trim', array_filter(explode(",",$form_inputs_array['registered_before'])));
		  //  $preferred_location_implode_data=implode("|",$preferred_location_array);
		  //$register_before=$form_inputs_array['registered_after'];
		    // $search_filter_array[]="published>".$form_inputs_array['registered_after'];
				$search_filter_array[]="published>".(strtotime($form_inputs_array['registered_after'])- 5.50*60*60);
		}

		if($form_inputs_array['experience_min']!=""){
			$experience_min=$form_inputs_array['experience_min'];
			
		}
		// else{
		// 	$experience_min=0;
		// }

		if($form_inputs_array['experience_max']!=""){
			$experience_max=$form_inputs_array['experience_max'];
			
		}
		// else{
		// 	$experience_max=60;
		// }
		$experience_array=array();
		if($form_inputs_array['experience_min']!="" || $form_inputs_array['experience_max']!=""){
			if($form_inputs_array['experience_min']==""){
				$experience_min=0;
			}
			if($form_inputs_array['experience_max']==""){
				$experience_max=60;
			}
			for($i=$experience_min;$i<=$experience_max;$i++){
				$experience_array[]=$i;
			}
			$experience_implode_data=implode("|",$experience_array);
			$to_return->max_experience_impload_data=$experience_implode_data;
			// $search_filter_array[]="experience_years=".$experience_implode_data;
			if($experience_min==0 || $experience_max==0){
				$search_filter_array[]="experience_years=".$experience_implode_data;
			}
			else{
				$search_filter_array[]="experience_years=".$experience_implode_data;
			}
			$to_return->max_experience_filter_query="experience_years=".$experience_implode_data;
		}
    // if($form_inputs_array['experience_min']!=""){
		//    $experience_min_array=array();
		//    $experience_min_array=array_map('trim', array_filter(explode(",",$form_inputs_array['experience_min'])));
		//    $experience_min_implode_data=implode("|",$experience_min_array);
		//     $search_filter_array[]="experience_years>".$form_inputs_array['experience_min'];
		// }
		
		// if($form_inputs_array['experience_max']!=""){
		//    $experience_max_array=array();
		//    $experience_max_array=array_map('trim', array_filter(explode(",",$form_inputs_array['experience_max'])));
		//    $experience_max_implode_data=implode("|",$experience_max_array);
		//     //  $search_filter_array[]="experience_years<".$form_inputs_array['experience_max'];
		    
		// 	foreach($pages->get("name=candidates")->children() as $candidate_experience_page){
		// 		$max_experience=(int)$candidate_experience_page->experience_years;
		// 		$to_return->max_experience=$max_experience;
		// 		$to_return->max_experience_input=$form_inputs_array['experience_max'];
		// 	   $search_filter_array[]=$max_experience."<".$form_inputs_array['experience_max'];
		// 		$to_return->max_experience_filter_query=$max_experience."<".$form_inputs_array['experience_max'];
		// 	}
		// 	$to_return->max_experience_filter=$search_filter_array;
		  //  if($form_inputs_array['experience_max'] !=0 ){
 			//         if($experience_years>$job_page->max_experience){
 			//             continue;
 			//         }
 			        
 			//     }
		// }
		
		//else
		//echo $form_inputs_array['identify_as'];
		if($form_inputs_array['identify_as']!=""){
		  //  $identify_as_array=array();
		  //  $identify_as_array=array_map('trim', array_filter(explode(",",$form_inputs_array['identify_as'])));
		  //  $identify_as_implode_data=implode("|",$identify_as_array);
		    $search_filter_array[]="identify_as%=".$form_inputs_array['identify_as'];
		    
		    //echo "identify_as*=Gay";
		}
		
		if($form_inputs_array['out_at_work']!=""){
		  //  $out_at_work_array=array();
		  //  $out_at_work_array=array_map('trim', array_filter(explode(",",$form_inputs_array['out_at_work'])));
		  //  $out_at_work_implode_data=implode("|",$out_at_work_array);
		    $search_filter_array[]="out_at_work%=".$form_inputs_array['out_at_work'];
		}
		
		if($form_inputs_array['qualification']!=""){
		  //  $qualification_array=array();
		  //  $qualification_array=array_map('trim', array_filter(explode(",",$form_inputs_array['qualification'])));
		  //  $qualification_implode_data=implode("|",$qualification_array);
		    $search_filter_array[]="qualification%=".$form_inputs_array['qualification'];
		}
		if(array_key_exists("year_of_passing_from",$form_inputs_array) && $form_inputs_array['year_of_passing_from']!=""){
		//if($form_inputs_array['year_of_passing_from']!=""){
		  //  $year_of_passing_from_array=array();
		  //  $year_of_passing_from_array=array_map('trim', array_filter(explode(",",$form_inputs_array['year_of_passing_from'])));
		  //  $year_of_passing_from_implode_data=implode("|",$year_of_passing_from_array);
		    $search_filter_array[]="year_of_passing>".$form_inputs_array['year_of_passing_from'];
		}
		if(array_key_exists("year_of_passing_to",$form_inputs_array) && $form_inputs_array['year_of_passing_to']!=""){
		//if($form_inputs_array['year_of_passing_to']!=""){
		  //  $year_of_passing_to_array=array();
		  //  $year_of_passing_to_array=array_map('trim', array_filter(explode(",",$form_inputs_array['year_of_passing_to'])));
		  //  $year_of_passing_to_implode_data=implode("|",$year_of_passing_to_array);
		    $search_filter_array[]="year_of_passing<".$form_inputs_array['year_of_passing_to'];
		}
		
		if(array_key_exists("referred_by",$form_inputs_array) && $form_inputs_array['referred_by']!=""){
		  //  $referred_by_array=array();
		  //  $referred_by_array=array_map('trim', array_filter(explode(",",$form_inputs_array['referred_by'])));
		  //  $referred_by_implode_data=implode("|",$referred_by_array);
		    $search_filter_array[]="how_did_you_know_about_us*=".$form_inputs_array['referred_by'];
		}
		
		if(array_key_exists("active_status",$form_inputs_array) && $form_inputs_array['active_status']!=""){
		  //  $active_status_array=array();
		  //  $active_status_array=array_map('trim', array_filter(explode(",",$form_inputs_array['active_status'])));
		  //  $active_status_implode_data=implode("|",$active_status_array);
			if($form_inputs_array['active_status']=="Active"){
				$search_filter_array[]="active_status=active|".$form_inputs_array['active_status'];
			}
			else{
				$search_filter_array[]="active_status=".$form_inputs_array['active_status'];
			}
		  
				// $search_filter_array[]="active_status=active";
		}
		
		if(array_key_exists("lgbt_verification",$form_inputs_array) && $form_inputs_array['lgbt_verification']!=""){
		    $lgbt_verification_array=array();
		    $lgbt_verification_array=array_map('trim', array_filter(explode(",",$form_inputs_array['lgbt_verification'])));
		    $lgbt_verification_implode_data=implode("|",$lgbt_verification_array);
		    $search_filter_array[]="lgbtq_verification=".$lgbt_verification_implode_data;
		}

		if(array_key_exists("internship_apply",$form_inputs_array) && $form_inputs_array['internship_apply']!=""){
		  //  $active_status_array=array();
		  //  $active_status_array=array_map('trim', array_filter(explode(",",$form_inputs_array['active_status'])));
		  //  $active_status_implode_data=implode("|",$active_status_array);
		    $search_filter_array[]="internship_apply=".$form_inputs_array['internship_apply'];
		}

		$internship_month=$form_inputs_array['internship_month'];
		if($internship_month!=""){
		    $internship_month_array=array();
		    $internship_month_array=array_map('trim', array_filter(explode(",",$form_inputs_array['internship_month'])));
		    $internship_month_implode_data=implode("|",$internship_month_array);
		    $search_filter_array[]="internship_month%=".$internship_month_implode_data;
		}
		$aggregate_percentage=$form_inputs_array['aggregate_percentage'];
		if($aggregate_percentage!=""){
		    $aggregate_percentage_array=array();
		    $aggregate_percentage_array=array_map('trim', array_filter(explode(",",$form_inputs_array['aggregate_percentage'])));
		    $aggregate_percentage_implode_data=implode("|",$aggregate_percentage_array);
		    $search_filter_array[]="aggregate_percentage%=".$aggregate_percentage_implode_data;
		}
		/**Add candidate status filter in Advance search form */
		if(array_key_exists("candidate_status",$form_inputs_array) && $form_inputs_array['candidate_status']!=""){
			$candidate_status_array=array();
			$candidate_status_array=array_map('trim', array_filter(explode(",",$form_inputs_array['candidate_status'])));
			$candidate_status_implode_data=implode("|",$candidate_status_array);
			$search_filter_array[]="candidate_status=".$candidate_status_implode_data;
		}

		/**Add candidate status filter in Advance search form for recruitr panel*/
		// if(array_key_exists("recruiter_candidate_status",$form_inputs_array) && $form_inputs_array['recruiter_candidate_status']!=""){
		// 	$print_to_file=true;
		// 	$recruiter_candidate_status_array=array();
		// 	$recruiter_id=$session->user_page_id;
		// 	$recruiter_candidate_status_array=array_map('trim', array_filter(explode(",",$form_inputs_array['recruiter_candidate_status'])));
		// 	// $candidate_status_for_recruiter=$recruiter_candidate_status_array;
		// 	// $to_return->recruiter_candidate_status=$candidate_status_array;
		// 	$candidate_status_implode_data=implode("\"|\"$recruiter_id\":\"",$candidate_status_array);
			// $candidate_status_implode_data="\"$recruiter_id\":\"".$candidate_status_implode_data."\"";
		// 	$candidate_status_implode_data=implode('"\'|\'"'.$recruiter_id.'":"',$candidate_status_array);
		// 	$candidate_status_implode_data='\'"'.$recruiter_id.'":"'.$candidate_status_implode_data.'"\'';
		// 	$to_return->recruiter_candidate_status=$candidate_status_implode_data;
		// 	// $candidate_status_implode_data="\"$recruiter_id\":".$candidate_status_implode_data;
		// 	$candidate_status_implode_string="'".$candidate_status_implode_data."'";
		// 	$to_return->recruiter_candidate_status_data="recruiter_candidate_status*=".$candidate_status_implode_string;
		// 	$recruiter_candidate_status_data="recruiter_candidate_status=".$candidate_status_implode_data;
		// 	// $to_return->recruiter_candidate_status_data=mysql_real_escape_string($candidate_status_array);
		// 	// array_push($search_filter_array,$recruiter_candidate_status_data);
			
			
			
		//  $search_filter_array[]="recruiter_candidate_status%=".$candidate_status_implode_data;

		// }
		if($form_inputs_array['recruiter_candidate_status']!=""){
			// $candidate_status_implode_data=implode("\"|\"$recruiter_id\":\"",$candidate_status_array);
			// $candidate_status_implode_data="\"$recruiter_id\":\"".$candidate_status_implode_data."\"";
			// 	$candidate_status_implode_data=implode('"\'|\'"'.$recruiter_id.'":"',$candidate_status_array);
			$recruiter_id=$session->user_page_id;
			$candidate_status_input_data=$form_inputs_array['recruiter_candidate_status'];
			$candidate_status_data='"'.$recruiter_id.'":"'.$candidate_status_input_data.'"';
			$to_return->recruiter_candidate_status=$candidate_status_data;
			// 	// $candidate_status_implode_data="\"$recruiter_id\":".$candidate_status_implode_data;
			$candidate_status_string="'".$candidate_status_data."'";
			$to_return->candidate_status_string=$candidate_status_string;
				$search_filter_array[]="recruiter_candidate_status_for_filter%=".$candidate_status_string;
				
				//echo "identify_as*=Gay";
		}	
		if(array_key_exists("recruiter_application_from",$form_inputs_array) && $form_inputs_array['recruiter_application_from']!=""){
			$recruiter_application_from=(strtotime($form_inputs_array['recruiter_application_from'])- 5.50*60*60);
			$to_return->recruiter_application_from=$recruiter_application_from;
		}
		if(array_key_exists("recruiter_application_to",$form_inputs_array) && $form_inputs_array['recruiter_application_to']!=""){
			$recruiter_application_to=(strtotime($form_inputs_array['recruiter_application_to'])- 5.50*60*60);
			$to_return->recruiter_application_to=$recruiter_application_to;
		}

	}
	elseif($isset_candidate_filter == true){
		$to_return->candidate_filter="test";
		$candidate_filter_form_details=$input->post("candidate_filter_form_details");
		$candidate_filter_form_details_array=json_decode($candidate_filter_form_details);
		$to_return->candidate_filter_status=$candidate_filter_form_details;
		// echo "candidate filter";
		// print_r($candidate_filter_form_details);
		// $to_return->candidate_filter_form_details_array=$candidate_filter_form_details_array;
    /* Array to save data and then to save into the page */
		$form_inputs_array = array();
		$print_to_file=true;
		if(!empty($candidate_filter_form_details_array)){
			foreach ($candidate_filter_form_details_array as $input_element) {
				$form_inputs_array[$input_element->name] = $input_element->value;
			}
		}
		
		/**Add candidate status filter in Advance search form */
		if(array_key_exists("candidate_status",$form_inputs_array) && $form_inputs_array['candidate_status']!=""){
			$candidate_status_array=array();
			$candidate_status_array=array_map('trim', array_filter(explode(",",$form_inputs_array['candidate_status'])));
			$candidate_status_implode_data=implode("|",$candidate_status_array);
			$search_filter_array[]="candidate_status=".$candidate_status_implode_data;
		}
	
		if(array_key_exists("applicants_candidate_status_filter",$form_inputs_array) && $form_inputs_array['applicants_candidate_status_filter']!=""){
			// echo "recruiter_candidate_status";
			$recruiter_id=$session->user_page_id;
			if($session->recruiter_profile_type=="sub-recruiter"){
				$recruiter_page_id=$pages->get($session->user_page_id)->parent();
				$recruiter_id=$recruiter_page_id->id;

			}
			else{
				$recruiter_page_id=$pages->get($session->user_page_id);
				$recruiter_id=$recruiter_page_id->id;
			}
			$candidate_status_input_data=$form_inputs_array['applicants_candidate_status_filter'];
			$to_return->candidate_status_input_data=$candidate_status_input_data;
			if($candidate_status_input_data=="Not Viewed" || $candidate_status_input_data=="New Applicants"){
				$recruiter_candidate_status_filter=$candidate_status_input_data;
				$to_return->job_applied_candidates_status=$candidate_status_input_data;
			}
			else{
				$candidate_status_data='"'.$recruiter_id.'":"'.$candidate_status_input_data.'"';
				$to_return->recruiter_candidate_status=$candidate_status_data;
				// 	// $candidate_status_implode_data="\"$recruiter_id\":".$candidate_status_implode_data;
				$candidate_status_string="'".$candidate_status_data."'";
				$to_return->candidate_status_string=$candidate_status_string;
				$search_filter_array[]="recruiter_candidate_status_for_filter%=".$candidate_status_string;
			}
			
				//echo "identify_as*=Gay";
		}	
		// $to_return->candidate_search_filter_array=$search_filter_array;
	}
	elseif (!isset($_POST['requested_columns_array_json'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}
	else{}
	

	

	/* Save the requested data */
	$requested_columns_to_show = $input->post('requested_columns_array_json');


	/* If default columns are not requested, convert query to an array from json */
	if(!in_array($requested_columns_to_show, ["default", "all"])){
		$requested_columns_to_show = json_decode($requested_columns_to_show);
	}

	/* Based on what type of user has logged in, decide columns availability */
	switch ($session->user_designation) {
		case "editor":
			/* If default columns are requested, get them from the user's account. */
			if ($requested_columns_to_show == "default"){
				$requested_columns_to_show = json_decode($pages->get($session->user_page_id)->candidate_table_column_array);
			}
			elseif ($requested_columns_to_show == "all"){
				$requested_columns_to_show = array_keys($columns_for_editor);
			}

			$available_columns_to_show = $columns_for_editor;
			break;

		case "admin":
			/* If default columns are requested, get them from the user's account. */
			if ($requested_columns_to_show == "default"){
				$requested_columns_to_show = json_decode($pages->get($session->user_page_id)->candidate_table_column_array);
			}
			elseif ($requested_columns_to_show == "all"){
				$requested_columns_to_show = array_keys($columns_for_admin);
			}

			$available_columns_to_show = $columns_for_admin;
			break;

		case "recruiter":
			/* If default columns are requested, get them from the user's account. */
			if ($requested_columns_to_show == "default"){
				if($session->recruiter_profile_type=="sub-recruiter"){
					$requested_columns_to_show = json_decode($pages->get($session->user_page_id)->candidate_table_column_array);
				}
				else{
					$requested_columns_to_show = json_decode($pages->get($session->user_page_id)->candidate_table_column_array);
				}
				
			}
			elseif ($requested_columns_to_show == "all"){
				$requested_columns_to_show = array_keys($columns_for_recruiter);
			}

			$available_columns_to_show = $columns_for_recruiter;
			break;

		default:
			break;
	}

	/**Access post value of order */
	$post_order=array();
	// global $recruiter_candidate_status_filter;
	$order_column=0;
	$order_direction="";
	$table_search_value="";
	if(isset($_POST['order'])){
		$post_order=$_POST['order'];
		//$order=json_decode($post_order);
		foreach($post_values as $key=>$value){
			if($key=="order"){
				$order_value=$value;
				//$ordeer=json_decode($order_value[0]);
				$order_column=$order_value[0]['column'];
				$order_direction=$order_value[0]['dir'];
				$to_return->order_requested=$order_column;
				if($order_column=="0" && $order_direction=="asc"){
					$order_column=0;
					$order_direction="desc";
				}
				elseif($order_column<="2"){
					// $order_column=$order_column-1;
					$order_column=0;
				}
				else{
					$order_column=$order_column-3;
				}
				
				$to_return->order=$order_column;
				$to_return->order_dir=$order_direction;
			}
			//$order_value=$key;

			if($key=="search"){
				$search_value=$value;
				$table_search_value=$search_value['value'];
				$to_return->search=$search_value;
				$to_return->search_sort=$table_search_value;
			}
			
		}
		//$to_return->order=$post_order;
		//print_r($post_order);
	}

	/* Cross check all the values requested to the available fields, create a new array which contains verified requested columns and their IDs and Titles too */
	$columns_to_show = Array();
	// $order_direction="desc";
	if($order_column!=0){
		$requested_columns_to_show_sort_order=$requested_columns_to_show[$order_column*1];
		// $requested_columns_to_show_sort_order=$requested_columns_to_show[(int)$order_column];
	}
	else{
		$requested_columns_to_show_sort_order="published";
	}
	
	 $to_return->requested_columns_to_show=$requested_columns_to_show;
	// $to_return->requested_columns_to_show_sort=$requested_columns_to_show[$order_column*1];
	foreach ($requested_columns_to_show as $requested_column_key) {
		if(array_key_exists($requested_column_key, $available_columns_to_show)){
			$columns_to_show[$requested_column_key] = $available_columns_to_show[$requested_column_key];
			//$to_return->requested_column_key=$requested_column_key;
			if($requested_column_key==$requested_columns_to_show_sort_order){
				$requested_columns_to_show_sort_order=$requested_columns_to_show_sort_order;
				$to_return->search_filter_array="sort=-".$requested_columns_to_show_sort_order;
			}
		}
	}

	if($order_direction=="desc"){
		$search_filter_array[]="sort=-".$requested_columns_to_show_sort_order;
	}
	else{
		$search_filter_array[]="sort=".$requested_columns_to_show_sort_order;
	}

	
	/**search filter */
	$search_filter_on_table=array();
	$search_filter_selector=array();
	$search_filter_on_table_search=array();
	// $table_search_value="17";
	// $exception_search_fields=["registration_time","date_of_birth","custom_whatsapp_number"];
	$exception_search_fields=["registration_time","event_application_time","job_application_time","date_of_birth","custom_phone_number","custom_whatsapp_number","custom_ctc","referrer_page_id","profile_picture","linkedin","registrants_status","how_did_you_know_about_workshop","how_did_you_know_about_job"];
	// "current_city","current_state","tell_us_about_yourself","how_did_you_know_about_us","qualification","course","specialisation","year_of_passing","college","cartifications","internship_apply","age16over","internship_month","industry","functional_area","experience_years","experience_months","current_employer","current_role","job_code","skills","technical_skills","non_technical_skills","soft_skills","current_ctc_time","current_ctc","pwd_accomodation","referred_by","referrer_email","event_code",
	$search_filter_on_table=array_diff($requested_columns_to_show,$exception_search_fields);
	// if(in_array("custom_full_name",$search_filter_on_table)){
	if (($key = array_search('custom_full_name', $search_filter_on_table)) !== false) {
		// $key="custom_full_name";
			unset($search_filter_on_table[$key]);
			$search_filter_on_table[]="first_name";
			$search_filter_on_table[]="last_name";
			$to_return->search_filter_on_table=$search_filter_on_table;
	}

	if (($key = array_search('custom_experience', $search_filter_on_table)) !== false) {
		// $key="custom_full_name";
			unset($search_filter_on_table[$key]);
			$search_filter_on_table[]="experience_months";
			$search_filter_on_table[]="experience_years";
			$to_return->search_filter_on_table=$search_filter_on_table;
	}
	// $to_return->search_filter_on_table=$search_filter_on_table;

	//}
	// foreach($search_filter_on_table as $key=>$value){
	// 	$search_filter_on_table[]=$value;
	// }
	if($session->user_designation=="admin" || $session->user_designation=="editor"){
		
		$search_filter_on_table[]="resume_contents";
	}	
	
	$search_filter_selector=implode("|",$search_filter_on_table);
  //$search_filter_on_table_search[]=($search_filter_selector."%=".$table_search_value);
	  $search_filter_array[]=($search_filter_selector."%=".$table_search_value);
	//$filter_selector_for_search=implode(",",$search_filter_on_table);
	//$to_return->filter_selector_for_search=$filter_selector_for_search;
	 $to_return->search_filter_selector=$search_filter_array;
	$column_array=array();

	//$to_return->search_filter_array="sort=".$requested_columns_to_show_sort_order;
	// $column_array=json_decode($columns_to_show);
	 $to_return->columns_to_show_sort=$columns_to_show;
	
	//echo "===========";
	//print_r($post_order);
	/* If the request made is for exporting table, do not change the table column name in the database */
	if($input->post('requested_columns_array_json') != "all"){
		/* Save JSON array of chosen columns to show into the user's page. Only the array of keys */
		$user_account_page = $pages->get($session->user_page_id);
		$user_account_page->of(false);
		$user_account_page->candidate_table_column_array = json_encode(array_keys($columns_to_show));
		$user_account_page->save();
	}

	/* Array to save all the data of all the candidates into */
	$candidate_data_array = Array();

	/* Show recruiters only active accounts */
	/* Empty filter to be added to the query */
	$only_active_candidates_filter = "";

	/* Create filter to add if the user account is of a recruiter */
	if($session->user_designation == "recruiter"){
		// echo "recruiter";
		$only_active_candidates_filter = "active_status=active";

		$search_filter_array[]=$only_active_candidates_filter;
		$only_active_candidates_filter_capital = "active_status=Active";
		$search_filter_array[]=$only_active_candidates_filter_capital;
		 $recruiter_email=$session->user_email;
     		//echo $recruiter_email;
    		// $recruiter_page=$pages->get("name=recruiters")->child("email=".$recruiter_email);
				/**Check recruiter profile type. if it is sub recruiter then get parent page id of sub-recruiter otherwise get recruiter page id*/
				if($session->recruiter_profile_type=="sub-recruiter"){
					$recruiter_page=$pages->get($session->user_page_id)->parent();
				}
				else{
					$recruiter_page=$pages->get($session->user_page_id);
				}
				
				
				//echo $recruiter_page;
    		//echo $recruiter_page->company_name;
				$only_internship_candidates="";
				$recruiter_type_array=json_decode($recruiter_page->recruiter_type);
				// echo $recruiter_type_array;
				// echo "*****************";
				$recruiter_type_array=array();
		    $recruiter_type_array=array_map('trim', array_filter(explode(",",$recruiter_page->recruiter_type)));
				//print_r($recruiter_type_array);
				if(in_array("Internship Recruiter",$recruiter_type_array)){
					//echo "**********";
					if(isset($_GET['job_code'])){
						$only_internship_candidates="internship_apply=No|Yes|";
					}
					else{
						$only_internship_candidates="internship_apply=Yes";
					}
					$search_filter_array[]=$only_internship_candidates;
				}

				/**Check unlock and favourite profile in recruiter profile page. unlocked profiles and favourite profiles save to array */
				/**In recruiter dashboard unlocked and add to favourite profiles not display in manage candidate table */
				// echo $recruiter_page->id;
				// print_r($recruiter_page->unlocked_profiles_array);
				$unlocked_candidate_object=Array();
				if($recruiter_page->unlocked_profiles_array != ""){
					$unlocked_candidate_array = array();
					$unlocked_candidate_array_data=array();
					$unlocked_candidate_object = json_decode($recruiter_page->unlocked_profiles_array);
					// $unlocked_profiles_object_array=$unlocked_candidate_object->unlocked_profiles_array;
					if(!empty($unlocked_candidate_object)){
						foreach($unlocked_candidate_object as $single_unlocked_profiles_object_array){
							$unlocked_candidate_array_data[]=$single_unlocked_profiles_object_array;
							foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
								$unlocked_candidate_array[]=$single_unlocked_profile_array->candidate_profile_id;
								
							}
						}
						
					}
					
				}
				
		
				if($recruiter_page->favourite_profiles_array != ""){
					$favorite_candidate_array = array();
					$favorite_candidate_array_data=array();
					$favorite_candidate_object = json_decode($recruiter_page->favourite_profiles_array);
					// $favorite_profiles_object_array=$favorite_candidate_object->favourite_profiles_array;
					if($favorite_candidate_object!=""){
						foreach($favorite_candidate_object as $single_favorite_profiles_object_array){
							$favorite_candidate_array_data[]=$single_favorite_profiles_object_array;
							foreach($single_favorite_profiles_object_array as $single_favorite_profile_array){
								$favorite_candidate_array[]=$single_favorite_profile_array->candidate_profile_id;
								
							}
						}
						
					}
    		//$only_recruiter_not_same_company_data="recruiter_type==";
    		//print_r($only_recruiter_not_same_company_data);
				
				}
    		

		
		//if("current_employer!="""){
		  //  $recruiter_email=$session->user_email;
    //  		//echo $recruiter_email;
    // 		$recruiter_page=$pages->get("name=recruiters")->child("email=".$recruiter_email);
    // 		//echo $recruiter_page->company_name;
    // 		$only_recruiter_not_same_company_data="current_employer!=".$recruiter_page->company_name;
    // 		//print_r($only_recruiter_not_same_company_data);
    // 		$search_filter_array[]=$only_recruiter_not_same_company_data;
		//}
 		
		
	}
	/* Show recruiters only active accounts END*/

		/* Create filter to add if the user account is of a editor */
		if($session->user_designation == "editor"){
	
			 $editor_email=$session->user_email;
					 //echo $recruiter_email;
					$editor_page=$pages->get("name=editors")->child("email=".$editor_email);
					$unlocked_candidate_array = array();
					$unlocked_candidate_object = json_decode($editor_page->unlocked_profiles_array);
					foreach($unlocked_candidate_object as $candidate_id=>$timestamp){
						$unlocked_candidate_array[]=$candidate_id;
					}
		
			 
					$favorite_candidate_array = array();
					$favorite_candidate_array = json_decode($editor_page->favourite_profiles_array);
			
			 
			
		}
		/* Show editor only active accounts END*/

	/* Loop through all the candidate profile pages */
// 	if($form_inputs_array['experience_max'] !=0 && isset($experience_years)){
//          if($page->experience_years>$form_inputs_array['experience_max']){
//              continue;
//          }
         
//      }
// echo "**********************";
// echo $session->company_name;
	$filter_selector=implode(",",$search_filter_array);
	// echo $filter_selector;
	// echo "********";
	//  $filter_selector_search=implode(",",$search_filter_on_table_search);
	 //$filter_selector_search=$search_filter_selector;
	//  $to_return->filter_selector_search=$filter_selector_search;
	//  $filter_selector_search="serial_id|oauth_gmail|current_employer|current_ctc%=17";
	// $date="2019-12-02";
	//  $filter_selector_search="registration_time<".strtotime($date1);
	// $to_return->filter_selector_search=$filter_selector_search;
	
	$to_return->filter_selector=$filter_selector;
	
	//$filter_selector="published<2019-12-02,published>2019-11-18,identify_as%=Gay";
	//$filter_selector="experience_years>2,experience_years<50";
//  	print_r($search_filter_array);
//  	echo "++++++++++++++++++++++++++++++";
//     print_r($filter_selector);
	//  $to_return->error->error_message2  = $_GET['job_code']);	
	// $to_return->error->error_message  = $filter_selector;	
 //	foreach ($pages->get("name=candidates")->children($only_active_candidates_filter) as $candidate_page) {
 $serial_counter=1;
 $loop_counter=1;
//  $candidate_count=0;
 //$to_return->candidate_data=array();
 $search_candidate_id=array();
  $all_candidates_array=new \ProcessWire\PageArray();    
	// $search_counter=1;
 		// foreach($pages->get("name=candidates")->children($filter_selector_search) as $search_candidate){
		// 	$to_return->search_candidate_id="*****************";
		// 	$search_candidate_id[]=$search_candidate->id;
		// 	$search_counter++;
			
		//  }
		//  $to_return->search_counter=$search_counter;
		//  $to_return->search_candidate_id=$search_candidate_id;
		// echo "7777";
		// echo $filter_selector;
		// echo "---";
		 $all_candidates_array=$pages->get("name=candidates")->children($filter_selector);
		//  $all_candidates_array=$pages->get("name=candidates")->children("experience_years=0|1");
		//$all_candidates_array=$pages->get("name=candidates")->children($filter_selector.",sort=-oauth_gmail");
		// print_r($all_candidates_array);
		// foreach ($all_candidates_array as $candidate_page) {
		// 	echo $candidate_page->id."<br>";
		// }
		$recordsTotal=sizeof($all_candidates_array);
		$to_return->recordsTotal=$recordsTotal+$post_start;
   foreach ($all_candidates_array as $candidate_page) {
       	//$to_return->candidate_data[] = $candidate_page;
       //echo (int)$candidate_page->experience_years;
			//  echo $candidate_page->id;
			//  echo $candidate_page->email;
			// $post_length=2;
			if($loop_counter>$post_length){
				 break;
			 }

			 /**Candidate application filter */
			 
			 $current_timestamp=strtotime(date("Y-m-d h:i:sa"));
			 // Calculate the timestamp for 24 hours ago
			 $last_24h_timestamp = $current_timestamp - (24 * 60 * 60);
			 if($isset_job_code!=false){
				if($candidate_page->candidate_applied_jobs!=""){
					$candidate_application_timestamp_array=json_decode($candidate_page->candidate_applied_jobs);
					$to_return->candidate_application_timestamp_array=$candidate_application_timestamp_array;
					// print_r($candidate_application_timestamp_array);
					// echo "........";
					$has_candidate_applied_job=true;
					foreach($candidate_application_timestamp_array as $candidate_job_code=>$application_timestamp){
						$to_return->candidate_job_code=$candidate_job_code;
						$to_return->application_timestamp=$application_timestamp;
						

					
						if($recruiter_application_from!=""){
							if($recruiter_application_from<$application_timestamp ){
								$to_return->if_from="if";
								$has_candidate_applied_job=true;
								
							}
							else{
								$has_candidate_applied_job=false;
							}
						}
						if($recruiter_application_to!="" && $has_candidate_applied_job!=false){
							if($recruiter_application_to>$application_timestamp){
								$to_return->if_to="toifto";
								$has_candidate_applied_job=true;
								
							}
							else{
								$has_candidate_applied_job=false;
							}
						}

						
					}
					if($has_candidate_applied_job!=true){
						continue;
					}
					$to_return->has_candidate_applied_job=$has_candidate_applied_job;
					$to_return->candidate_page=$candidate_page->id;

					$to_return->current_timestamp=$current_timestamp;
					$to_return->last_24h_timestamp=$last_24h_timestamp;

					$to_return->recruiter_candidate_status_filter=$recruiter_candidate_status_filter;
					$is_last_24h_applicants=false;
					if($recruiter_candidate_status_filter!=""){
						if($recruiter_candidate_status_filter=="New Applicants"){
							$to_return->job_applied_candidates_status=$recruiter_candidate_status_filter;
							if($last_24h_timestamp>=$application_timestamp){
								$candidate_page=$candidate_page;
								$to_return->job_applied_candidates_filter=$candidate_page->id;
								$is_last_24h_applicants=true;
							}
						}
					}
					if($is_last_24h_applicants==true){
						continue;
					}
			 	}
			}
			if($recruiter_candidate_status_filter!=""){
				$is_not_viewed_candidate=false;
				$candidate_status_recruiter_id_array=Array();
				if($recruiter_candidate_status_filter=="Not Viewed"){
					if($candidate_page->recruiter_candidate_status_for_filter!=""){
						$candidate_status_array= json_decode($candidate_page->recruiter_candidate_status_for_filter);
						$recruiter_page_id=$recruiter_page->id;
						foreach($candidate_status_array as $recruiter_id=>$candidate_status){
							$candidate_status_recruiter_id_array[]=$recruiter_id;
							if($recruiter_page_id==$recruiter_id && $candidate_status !=""){
								$is_not_viewed_candidate=true;
							}
						}
					}
				}
				if($is_not_viewed_candidate==true){
					continue;
				}
				
			}

			 
			 

			 if(!empty($unlocked_candidate_array))
			 {
						if (in_array($candidate_page->id, $unlocked_candidate_array) && $is_skip_unlock==true){
						
						continue;
					}
		 
			 }
			 
			if(!empty($favorite_candidate_array))
			{
			 if (in_array($candidate_page->id, $favorite_candidate_array ) && $is_skip_unlock==true){
						
						continue;
					}
				}

      //  if(isset($form_inputs_array) && $form_inputs_array['experience_max']!=""){
			// 	// $to_return->max_experience=$form_inputs_array['experience_max'];
      //      if((int)$candidate_page->experience_years>$form_inputs_array['experience_max']){
			// 			$search_candidate_id[]=$candidate_page->oauth_gmail;
			// 			$search_candidate_id[]=$candidate_page->id;
						
      //          continue;
      //      }
      //      $candidate_experience_years=$candidate_page->experience_years;
					
      //     // echo $candidate_experience_years;
      //  }
      //  if(isset($form_inputs_array) && $form_inputs_array['experience_min']!=""){
      //      if((int)$candidate_page->experience_years<$form_inputs_array['experience_min']){
			// 			$search_candidate_id[]=$candidate_page->oauth_gmail;
			// 			$search_candidate_id[]=$candidate_page->id;
      //          continue;
      //      }
           
      //  }
			//  $to_return->max_experience=$search_candidate_id;
       if($candidate_page->current_employer!=""){
           
            $recruiter_email=$session->user_email;
     		//echo $recruiter_email;
    		// $recruiter_page=$pages->get("name=recruiters")->child("email=".$recruiter_email);
				$recruiter_page=$pages->get($session->user_page_id);
				if($session->recruiter_profile_type=="sub-recruiter"){
					$recruiter_page->company_name=$pages->get($session->user_page_id)->parent()->company_name;
				}
				else{
					$recruiter_page->company_name=$pages->get($session->user_page_id)->company_name;
				}
    		//echo $recruiter_page->company_name;
    		//$only_recruiter_not_same_company_data="current_employer!=".$recruiter_page->company_name;
				if($recruiter_page->company_name!=""){
					if($candidate_page->current_employer==$recruiter_page->company_name){
    		    continue;
    			}
				}
    		
       }
      //  $candidate_count++;
        //echo $form_inputs_array['experience_max']*2;
		/* Each candidate's data is to be saved in a seperate object */
		$candidate_data = new stdClass();

		/* Code for the selectbox to be shown in the table */
		$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
		$candidate_data->serial_number=$serial_counter+$post_start;
			$serial_counter++;
			$loop_counter++;
		$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."_view_button' class='[ btn btn-outline-primary  ]' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";
		if($session->user_designation == "admin" || $session->user_designation == "editor") 
		{
			if ($candidate_page->resume) {
				$candidate_data->download_resume_button = "<a href='".$candidate_page->resume->httpUrl."' target='_blank' id='".$candidate_page->id."' class='[ btn btn-outline-primary  ] candidate_resume_download mt-2' , type='button' data-toggle='tooltip' data-placement='top' title='Download resume' style='padding: 6px 15px;'><i class='fas fa-file-download icon' style='font-size=18px;'></i><a>";
				$candidate_data->view_actions=$candidate_data->view_profile_button." ".$candidate_data->download_resume_button;
			}
			else{
				$candidate_data->view_actions=$candidate_data->view_profile_button;
			}
		}
		else{
			$candidate_data->view_actions=$candidate_data->view_profile_button;
		}
		
		/* Loop through all the columns that are to be shown */
		foreach ($columns_to_show as $column_id => $column_title) {
			/* All these are special cases where the output is not readily available in the database. Create the output and save it into the object. */
			switch ($column_id) {
				case "custom_full_name":
					$candidate_data->custom_full_name = $candidate_page->first_name." ".$candidate_page->last_name.($candidate_page->preferred_name == "" ? "" : " (".$candidate_page->preferred_name.")");
					break;
					
				case "skills":
				    $skills_array=[];
				    $skills_array[]=$candidate_page->skills;
				    $skills_array[]=$candidate_page->soft_skills;
				    $skills_array[]=$candidate_page->non_technical_skills;
				    $skills_array[]=$candidate_page->technical_skills;
				    $skills=implode(", ",array_map('trim', array_filter($skills_array)));
					$candidate_data->skills = $skills;
					break;
                
          case "tell_us_about_yourself":
				    $tell_us_about_yourself_array=[];
				    $tell_us_about_yourself_array[]=$candidate_page->tell_us_about_yourself;
				    if($candidate_page->college!=""){
				      $tell_us_about_yourself_array[].="<br> College : ".$candidate_page->college;  
				    }
				    if($candidate_page->course!=""){
				        $tell_us_about_yourself_array[].="<br> Course : ".$candidate_page->course;
				    }
				    if($candidate_page->cartifications!=""){
				        $tell_us_about_yourself_array[].="<br> Certifications : ".$candidate_page->cartifications;
				    }
				    if($candidate_page->specialisation!=""){
				        $tell_us_about_yourself_array[].="<br> Specialisation : ".$candidate_page->specialisation;
				    }
				    $tell_us_about_yourself=implode(" ",$tell_us_about_yourself_array);
					$candidate_data->tell_us_about_yourself = $tell_us_about_yourself;
					break;
					
				case "custom_phone_number":
					$candidate_data->custom_phone_number = $candidate_page->phone_country_code.$candidate_page->phone_number;
					break;
					
				case "custom_whatsapp_number":
					$candidate_data->custom_whatsapp_number = $candidate_page->whatsapp_country_code.$candidate_page->whatsapp_number;
					break;

				case "date_of_birth":
					if($candidate_page->date_of_birth!=""){
						$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
					}
					else{
						$candidate_data->date_of_birth="-";
					}
					break;

				case "custom_experience":
					$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

				case "custom_ctc":
					$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

				// case "resume":
				// 	$candidate_data->resume = "-";

				// 	if ($candidate_page->resume) {
				// 		$candidate_data->resume = "<a href='".$candidate_page->resume->httpUrl."' target='_blank'>Download<a>";
				// 	}

				// 	break;

				case "profile_picture":
					$candidate_data->profile_picture = "-";

					if ($candidate_page->profile_picture) {
						$candidate_data->profile_picture = "<a href='".$candidate_page->profile_picture->httpUrl."' target='_blank'>Show<a>";
					}

					break;

				case "redacted_resume":
					$candidate_data->redacted_resume = "-";

					if ($candidate_page->redacted_resume) {
						$candidate_data->redacted_resume = "<a href='".$candidate_page->redacted_resume->httpUrl."' target='_blank'>Download<a>";
					}

					break;

				case "registration_time":
    				// $candidate_data->registration_time = date("F j, Y, g:i a", intval($candidate_page->created +  60*60*5.50));
    					$candidate_data->registration_time = date("d/m/Y h:i A", intval($candidate_page->created +  60*60*5.50));
    				
//     					$company_data->registration_time=$company_page->published +  60*60*5.50;
// 			$company_data->registration_time=date('d/m/Y h:i A', $company_data->registration_time);
    				break;
				
			
					case "event_application_time":
						// if($_GET['event_code']!=""){
							// echo "1111";
							// $to_return->event_code = $event_code;
							if($event_code!=""){
								if($candidate_page->users_applied_events!=""){
									$applied_candidates_events=json_decode($candidate_page->users_applied_events);
									$to_return->applied_candidates_events = $applied_candidates_events;
									if(!empty($applied_candidates_events)){
										foreach($applied_candidates_events as $single_applied_event_code=>$applied_time){
											$to_return->single_applied_event_code = $single_applied_event_code;
											if($event_code==$single_applied_event_code){
												// $to_return->single_applied_event= "if";
												$candidate_data->event_application_time = date("d/m/Y h:i A", intval($applied_time +  60*60*5.50));
												break;
											}
											else{
												$candidate_data->event_application_time="-";
											}
										}
									}
									else{
										$candidate_data->event_application_time="-";
									}
									
								}
								else{
									$candidate_data->event_application_time="-";
								}
							}
							else{
								$candidate_data->event_application_time="-";
							}
							// $candidate_data->application_time = date("d/m/Y h:i A", intval($candidate_page->created +  60*60*5.50));
						
						// }
				  break;

					case "job_application_time":
							if($job_code!=""){
								if($candidate_page->candidate_applied_jobs!=""){
									$applied_candidates_jobs=json_decode($candidate_page->candidate_applied_jobs);
									$to_return->applied_candidates_jobs = $applied_candidates_jobs;
									if(!empty($applied_candidates_jobs)){
										foreach($applied_candidates_jobs as $single_applied_job_code=>$applied_time){
											$to_return->single_applied_job_code = $single_applied_job_code;
											// $candidate_data->job_application_time = $job_code." ".$single_applied_job_code;
											if($job_code==$single_applied_job_code){
											// 	// $to_return->single_applied_event= "if";
												$candidate_data->job_application_time = date("d/m/Y h:i A", intval($applied_time +  60*60*5.50));
											// 	$candidate_data->job_application_time = $applied_time;
											  break;

											}
											else{
												$candidate_data->job_application_time="-";
											}
										}
									}
									else{
										$candidate_data->job_application_time="-";
									}
									
								}
								else{
									$candidate_data->job_application_time="-";
								}
							}
							else{
								$candidate_data->job_application_time="-";
							}
							// $candidate_data->application_time = date("d/m/Y h:i A", intval($candidate_page->created +  60*60*5.50));
						
						// }
				  break;

					case "registrants_status":
    					$candidate_data_registration_time = date("d/m/Y h:i A", intval($candidate_page->created +  60*60*5.50));
							// Assume you have the registration timestamp stored as a Unix timestamp
							$registrationTimestamp = $candidate_page->created; // Replace this with the actual registration timestamp
							// echo $registrationTimestamp;
							// $to_return->created_time=$registrationTimestamp;
							
							// Get the current timestamp
							// $currentTimestamp = time();
							// echo "current time";
							// echo $currentTimestamp;
							// $to_return->current_time=$currentTimestamp;
							
							// // Define the duration of a week in seconds
							// $oneWeekInSeconds = 7 * 24 * 60 * 60;
							// $t = strtotime ( "-7 days" ); 
							// $tt= date ( "d.m.Y" , $t );
							// echo "one week";
							// echo $oneWeekInSeconds;
							// $to_return->oneWeekInSeconds=$oneWeekInSeconds;
							
							
							// Compare the difference in seconds
							// $timeDifference = $currentTimestamp - $registrationTimestamp;
							// echo "difference";
							// echo $timeDifference;
							// $candidate_data->registrants_status=$registrationTimestamp."** ".$currentTimestamp."-- ".$t."// ".$timeDifference;
							// $to_return->timeDifference=$timeDifference;
							
							// if ($timeDifference >= $oneWeekInSeconds) {
							// if($t >= $registrationTimestamp){
									// $userStatus = 'Prior';
									// $candidate_data->registrants_status = "Prior";
							// } else {
									// $userStatus = 'New';
									// $candidate_data->registrants_status = "New";
							// }

							// Timestamp of registration time
								// $registrationTimestamp = 1688909340; // Replace with your actual registration timestamp

								// Calculate the timestamp for 7 days ago
								$sevenDaysAgoTimestamp = strtotime('today') - (6 * 24 * 60 * 60);

								// $candidate_data->registrants_status = $registrationTimestamp."  ".$sevenDaysAgoTimestamp;

								// Compare the timestamps
								if ($registrationTimestamp > $sevenDaysAgoTimestamp) {
										// echo "new";
										$candidate_data->registrants_status = "New";
								} else {
										// echo "old";
										$candidate_data->registrants_status = "Prior";
								}
							
    				break;
						

					case "how_did_you_know_about_workshop":
						$about_workshop_candidate_data=array();
						if($event_code!=""){
							$event_page_for_applicant = \ProcessWire\wire("pages")->get("name=workshops")->child("event_code=".$event_code);
							$about_workshop_candidate_data=json_decode($event_page_for_applicant->about_workshop_candidate_data,true);
							
							// print_r($about_workshop_candidate_data);
							// echo "////";
							$name_of_reference = null;
							if((is_array($about_workshop_candidate_data) || is_object($about_workshop_candidate_data)) && !empty($about_workshop_candidate_data)){
								foreach ($about_workshop_candidate_data as $single_about_workshop_name => $single_about_workshop_candidate_id) {
										if (in_array($candidate_page->id, $single_about_workshop_candidate_id)) {
												$name_of_reference = $single_about_workshop_name;
												$candidate_data->how_did_you_know_about_workshop= $single_about_workshop_name;
												break;
										}
								}
							}
							else{
								$candidate_data->how_did_you_know_about_workshop = "-";
							}

							// echo $name_of_reference;
							// print_r($about_workshop_candidate_data);
						}
						else{
							$candidate_data->how_did_you_know_about_workshop = "-";
						}
					break;

					case "how_did_you_know_about_job":
						$about_job_candidate_data=array();
						if($job_code!=""){
							$job_page_for_applicant = \ProcessWire\wire("pages")->get("name=jobs")->child("job_code=".$job_code);
							$about_job_candidate_data=json_decode($job_page_for_applicant->about_job_candidate_data,true);
							
							$name_of_reference = null;
							if((is_array($about_job_candidate_data) || is_object($about_job_candidate_data)) && !empty($about_job_candidate_data)){
								foreach ($about_job_candidate_data as $single_about_job_name => $single_about_job_candidate_id) {
										if (in_array($candidate_page->id, $single_about_job_candidate_id)) {
												$name_of_reference = $single_about_job_name;
												$candidate_data->how_did_you_know_about_job = $single_about_job_name;
												break;
										}
								}
							}
							else{
								$candidate_data->how_did_you_know_about_job = "-";
							}

							// echo $name_of_reference;
							// print_r($about_workshop_candidate_data);
						}
						else{
							$candidate_data->how_did_you_know_about_job = "-";
						}
					break;
				
				
				
				case "referrer_page_id":
				    /* set default to -. In case there is no referrer */
				    $candidate_data->referrer_page_id = "-";
				    
				    /* Check if there is a referrer_page_id on the candidate page */
				    if($candidate_page->referrer_page_id != ""){
				        /* find the page of the referrer from the referrer page ID */
				        $referrer_page = $pages->get("id=".$candidate_page->referrer_page_id);
				        
				        /* If that page exists, send the name of the referrer to the front end */
				        if($referrer_page->id != 0){
				            $candidate_data->referrer_page_id = $referrer_page->title;
				        }
				    }
				    
				    break;
				case "internship_month":
							//$internship_apply=$user_page->internship_apply;
							
								$months=array();
								$months=json_decode($candidate_page->internship_month);
							if(!empty($months)){
								// echo "************";
								// echo $candidate_page->internship_month;
								// print_r($months);
								$candidate_data->internship_month=implode(", ",$months);
							}
							else{
								$candidate_data->internship_month="";
							}
					break;

				/* For all the other outputs, they are to be shown as they are from the page data. */
				default:
					$candidate_data->$column_id = $candidate_page->$column_id;
					break;
			}
		}
		
		/* Save the candidate data object into the main array of all the candidate data */
		array_push($candidate_data_array, $candidate_data);
	}

	/* Save the candidate data array into the object that is to be sent back */
	$to_return->data = $candidate_data_array;
	$to_return->draw=$post_draw;
	// $to_return->recordsTotal=$candidate_count;
	$recordsFiltered=sizeof($all_candidates_array);
		$to_return->recordsFiltered=$recordsFiltered+$post_start;
		
	
	



	/* Names of the columns to be displayed will be saved in this array */
	$to_return->columns = array();

	/* Add a column object for the selctbox column */
	$temp_object = new stdClass();
	$temp_object->title = "";
	$temp_object->data = "selectbox";

	$view_profile = new stdClass();
	$view_profile->title = "View Actions";
	$view_profile->data = "view_actions";
	
	$serial_number_object = new stdClass();
	$serial_number_object->title = "Sr.No.";
	$serial_number_object->data = "serial_number";
	
	$to_return->columns[] = $temp_object;
	$to_return->columns[] = $view_profile;
	// $to_return->columns[] = $serial_number_object;
	/* Add a column object for the selctbox column END*/

	/* Creating table column objects from array */
	foreach ($columns_to_show as $key => $value) {
		$temp_object = new stdClass();
		$temp_object->title = $value;
		$temp_object->data = $key;

		$to_return->columns[] = $temp_object;
	}
	/* Creating table column objects from array END */

	 $myfile = fopen($config->paths->templates."includes/newfile.txt", "w");
	   $txt = json_encode($to_return);
	//  $txt = json_encode($post_values);
	//$txt = json_encode($input->post('order')[0]);
	// $txt="";
	// foreach($post_values as $key=>$value){
	// 	if($key=="order"){
	// 		$order_value=$value;
	// 		//$ordeer=json_decode($order_value[0]);
	// 		$txt.=json_encode($order_value[0]['column']);
	// 	}
	// 	//$order_value=$key;
		
	// }
	// $post_values_encode=json_encode($post_values);
	// $post_values_decode=json_decode($post_values_encode);
	// $order_decode=json_decode($input->post('order'));
	// // $txt = json_encode($input->post('draw'));
	// // $txt .= json_encode($input->post('columns'));
	//  //$txt = json_encode($post_values->order[0]['column']);
	// // $txt = json_encode($post_values_decode);
	// //$txt=json_encode($order_value);
	// // $txt .= json_encode($post_values_decode->start);
	// ///$txt=json_encode($order_decode);

	// // $txt .= json_encode($input->post('length'));
	// // $txt .= json_encode($input->post('search'));
	// // $txt .= json_encode($input->post('requested_columns_array_json'));
	fwrite($myfile, $txt);
	// fwrite($myfile, "Hello demo");
	fclose($myfile);


	end_and_return();
?>