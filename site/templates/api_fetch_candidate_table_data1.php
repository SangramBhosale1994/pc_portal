<?php
// $myfile = fopen($config->paths->templates."includes/newfile.txt", "w");
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

	/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	/* For column names and variables */
	require_once $config->paths->templates.'includes/candidate_table_data.php';

//print_r($_POST);


	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();

global $order_column;
global $table_search_value;
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
	if(isset($_GET['job_code'])){
			
	    $search_filter_array[]="job_code*=".$_GET['job_code'];
	}
// 	elseif (!isset($_POST['requested_columns_array_json'])) {
// 		$to_return->error->number_of_errors++;
// 		end_and_return();
// 	}
// 	else{}
	elseif(isset($_POST['filter_form']) && $_POST['filter_form']=="true"){
	    
		$search_form_details=$input->post("search_form_details");
		$search_form_details_array=json_decode($search_form_details);
		
		//print_r($search_form_details);
        /* Array to save data and then to save into the page */
		$form_inputs_array = array();

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
		    $search_filter_array[]="published<".$form_inputs_array['registered_before'];
		}
		//echo $page->published;
	
	    if(array_key_exists("registered_after",$form_inputs_array) && $form_inputs_array['registered_after']!=""){
		//if($form_inputs_array['registered_after']!=""){
		  //  $preferred_location_array=array();
		  //  $preferred_location_array=array_map('trim', array_filter(explode(",",$form_inputs_array['registered_before'])));
		  //  $preferred_location_implode_data=implode("|",$preferred_location_array);
		  //$register_before=$form_inputs_array['registered_after'];
		    $search_filter_array[]="published>".$form_inputs_array['registered_after'];
		}
		
        if($form_inputs_array['experience_min']!=""){
		  //  $experience_min_array=array();
		  //  $experience_min_array=array_map('trim', array_filter(explode(",",$form_inputs_array['experience_min'])));
		  //  $experience_min_implode_data=implode("|",$experience_min_array);
		    //$search_filter_array[]="experience_years>".$form_inputs_array['experience_min'];
		}
		
		if($form_inputs_array['experience_max']!=""){
		  //  $experience_max_array=array();
		  //  $experience_max_array=array_map('trim', array_filter(explode(",",$form_inputs_array['experience_max'])));
		  //  $experience_max_implode_data=implode("|",$experience_max_array);
		    //$search_filter_array[]="experience_years<".$form_inputs_array['experience_max'];
		    
		  //  $max_experience=(int)$page->experience_years;
		  //  $search_filter_array[]=".$max_experience.<".$form_inputs_array['experience_max'];
		    
		  //  if($form_inputs_array['experience_max'] !=0 ){
 			//         if($experience_years>$job_page->max_experience){
 			//             continue;
 			//         }
 			        
 			//     }
		}
		
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
		    $search_filter_array[]="active_status=".$form_inputs_array['active_status'];
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
	

// 		if($form_inputs_array['current_ctc_min']!=""){
// 		  //  $lgbt_verification_array=array();
// 		  //  $lgbt_verification_array=array_map('trim', array_filter(explode(",",$form_inputs_array['current_ctc_min'])));
// 		  //  $lgbt_verification_implode_data=implode("|",$lgbt_verification_array);
// 		    $search_filter_array[]="current_ctc>".$form_inputs_array['current_ctc_min'];
// 		}
		
// 		if($form_inputs_array['current_ctc_max']!=""){
// 		  //  $lgbt_verification_array=array();
// 		  //  $lgbt_verification_array=array_map('trim', array_filter(explode(",",$form_inputs_array['current_ctc_min'])));
// 		  //  $lgbt_verification_implode_data=implode("|",$lgbt_verification_array);
// 		    $search_filter_array[]="current_ctc<".$form_inputs_array['current_ctc_max'];
// 		}

		
		//print_r(implode(",",$filter_selectors));
		
		//echo $filter_selector;
	
	


	   // $to_return->error->error_message  = "Form not submit";
	   // $to_return->error->number_of_errors++;
	   // end_and_return();
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
				$requested_columns_to_show = json_decode($pages->get($session->user_page_id)->candidate_table_column_array);
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
	$exception_search_fields=["registration_time","custom_full_name","date_of_birth","custom_phone_number","custom_whatsapp_number","custom_experience","custom_ctc","referrer_page_id","profile_picture","linkedin"];
	// "current_city","current_state","tell_us_about_yourself","how_did_you_know_about_us","qualification","course","specialisation","year_of_passing","college","cartifications","internship_apply","age16over","internship_month","industry","functional_area","experience_years","experience_months","current_employer","current_role","job_code","skills","technical_skills","non_technical_skills","soft_skills","current_ctc_time","current_ctc","pwd_accomodation","referred_by","referrer_email","event_code",
	$search_filter_on_table=array_diff($requested_columns_to_show,$exception_search_fields);
	// foreach($search_filter_on_table as $key=>$value){
	// 	$search_filter_on_table[]=$value;
	// }

	
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
		$only_active_candidates_filter = "active_status=active";

		$search_filter_array[]=$only_active_candidates_filter;
		 $recruiter_email=$session->user_email;
     		//echo $recruiter_email;
    		$recruiter_page=$pages->get("name=recruiters")->child("email=".$recruiter_email);
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
					$only_internship_candidates="internship_apply=Yes";
					$search_filter_array[]=$only_internship_candidates;
				}

				/**Check unlock and favourite profile in recruiter profile page. unlocked profiles and favourite profiles save to array */
				/**In recruiter dashboard unlocked and add to favourite profiles not display in manage candidate table */
				$unlocked_candidate_array = array();
				$unlocked_candidate_array = json_decode($recruiter_page->unlocked_profiles_array);
		
			 
				$favorite_candidate_array = array();
				$favorite_candidate_array = json_decode($recruiter_page->favourite_profiles_array);
    		//$only_recruiter_not_same_company_data="recruiter_type==";
    		//print_r($only_recruiter_not_same_company_data);
    		

		
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
					$unlocked_candidate_array = json_decode($editor_page->unlocked_profiles_array);
		
			 
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
	//  $filter_selector_search=implode(",",$search_filter_on_table_search);
	 //$filter_selector_search=$search_filter_selector;
	//  $to_return->filter_selector_search=$filter_selector_search;
	//  $filter_selector_search="serial_id|oauth_gmail|current_employer|current_ctc%=17";
	// $date="2019-12-02";
	//  $filter_selector_search="registration_time<".strtotime($date1);
	// $to_return->filter_selector_search=$filter_selector_search;
	
	$to_return->filter_selector=$filter_selector;
	//echo $filter_selector;
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
 //$to_return->candidate_data=array();
 $search_candidate_id=array();
    $search_counter=1;
 		// foreach($pages->get("name=candidates")->children($filter_selector_search) as $search_candidate){
		// 	$to_return->search_candidate_id="*****************";
		// 	$search_candidate_id[]=$search_candidate->id;
		// 	$search_counter++;
			
		//  }
		 $to_return->search_counter=$search_counter;
		 $to_return->search_candidate_id=$search_candidate_id;
		 $all_candidates_array=$pages->get("name=candidates")->children($filter_selector);
		//$all_candidates_array=$pages->get("name=candidates")->children($filter_selector.",sort=-oauth_gmail");
		$to_return->recordsTotal=sizeof($all_candidates_array);
   foreach ($all_candidates_array as $candidate_page) {
       	//$to_return->candidate_data[] = $candidate_page;
       //echo (int)$candidate_page->experience_years;

			 if($loop_counter>$post_length){
				 break;
			 }



			 if(!empty( $unlocked_candidate_array))
			 {
						if (in_array($candidate_page, $unlocked_candidate_array)){
						
						continue;
					}
		 
			 }
			 
			if(!empty($favorite_candidate_array))
			{
			 if (in_array($candidate_page, $favorite_candidate_array )){
						
						continue;
					}
				}

       if(isset($form_inputs_array) && $form_inputs_array['experience_max']!=""){
          
           if((int)$candidate_page->experience_years>$form_inputs_array['experience_max']){
               continue;
           }
           $candidate_experience_years=$candidate_page->experience_years;
          // echo $candidate_experience_years;
       }
       if(isset($form_inputs_array) && $form_inputs_array['experience_min']!=""){
           if((int)$candidate_page->experience_years<$form_inputs_array['experience_min']){
               continue;
           }
           
       }
       
       if($candidate_page->current_employer!=""){
           
            $recruiter_email=$session->user_email;
     		//echo $recruiter_email;
    		$recruiter_page=$pages->get("name=recruiters")->child("email=".$recruiter_email);
    		//echo $recruiter_page->company_name;
    		//$only_recruiter_not_same_company_data="current_employer!=".$recruiter_page->company_name;
    		if($candidate_page->current_employer==$recruiter_page->company_name){
    		    continue;
    		}
       }
       
        //echo $form_inputs_array['experience_max']*2;
		/* Each candidate's data is to be saved in a seperate object */
		$candidate_data = new stdClass();

		/* Code for the selectbox to be shown in the table */
		$candidate_data->selectbox = "<input id='".$candidate_page->id."_checkbox' class='candidate_checkbox' type='checkbox'>";
		$candidate_data->serial_number=$serial_counter+$post_start;
			$serial_counter++;
			$loop_counter++;
		$candidate_data->view_profile_button ="<a target='_blank' href='".$candidate_page->httpUrl."' id='".$candidate_page->id."_view_button' class='[ btn btn-outline-primary  ]' type='button' data-toggle='tooltip' data-placement='top' title='View profile'><i class='[ ][ fas fa-eye ]'></i></a>";

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
					$candidate_data->date_of_birth = date("d M Y", intval($candidate_page->date_of_birth));
					break;

				case "custom_experience":
					$candidate_data->custom_experience = $candidate_page->experience_years." Years ".$candidate_page->experience_months." Months";
					break;

				case "custom_ctc":
					$candidate_data->custom_ctc = $candidate_page->current_ctc_time. " ".$candidate_page->current_ctc;
					break;

				case "resume":
					$candidate_data->resume = "-";

					if ($candidate_page->resume) {
						$candidate_data->resume = "<a href='".$candidate_page->resume->httpUrl."' target='_blank'>Download<a>";
					}

					break;

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
	// $to_return->recordsTotal=sizeof($candidate_data_array);
	$to_return->recordsFiltered=sizeof($all_candidates_array);
	
	



	/* Names of the columns to be displayed will be saved in this array */
	$to_return->columns = array();

	/* Add a column object for the selctbox column */
	$temp_object = new stdClass();
	$temp_object->title = "";
	$temp_object->data = "selectbox";

	$view_profile = new stdClass();
	$view_profile->title = "View Profile";
	$view_profile->data = "view_profile_button";
	
	$serial_number_object = new stdClass();
	$serial_number_object->title = "Sr.No.";
	$serial_number_object->data = "serial_number";
	
	$to_return->columns[] = $temp_object;
	$to_return->columns[] = $view_profile;
	$to_return->columns[] = $serial_number_object;
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
	fwrite($myfile, "Hello demo");
	fclose($myfile);


	end_and_return();
?>