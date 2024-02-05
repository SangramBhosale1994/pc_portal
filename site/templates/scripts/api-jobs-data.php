<?php
// ob_start();
	/* Specify the page output is in JSON */
	// header("Content-Type: application/json; charset=UTF-8");

	/**api-expired-jobs is used for deadline over jobs. this api run when you run manage job section. 1st check all deadlines if deadline is over of job then verification status save unverified. */
	// require_once $config->paths->templates.'includes/api-expired-jobs.php';

	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();
	$rootpath = $config->urls->templates;
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
	$myfile = fopen($config->paths->templates."includes/newfile.txt", "w");
	//   //  $txt = json_encode($to_return);
	//  $txt = json_encode($post_values);
	//  fwrite($myfile, $txt);
	// 	fwrite($myfile, "Hello demo");
	// 	fclose($myfile);

  // print_r($post_values);
		




	/* If no POST request is made, exit with an error message */
	// if (!isset($_POST['requested_action_to_take'])) {
	// 	$to_return->error->number_of_errors++;
		
	// 	end_and_return();
	// }


	/* Function to fetch the data of all jobs to show in the table */
	// function fetch_job_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $post_values;

			/**define search filter array field for append all filter into one array */
	
	$search_filter_array = Array();
	$start_limit_filter_array=Array();
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
			$start_limit_filter_array[]="start=".$post_start;
			$start_limit_filter_array[]="limit=100000";
			$to_return->start=$post_start;
			$to_return->limit=$post_start;
		  // $to_return->search_filter_array=$search_filter_array;
		}
		$to_return->start=$post_start;
		// $search_filter_array[]="start=0";
		$post_length=0;
		if(isset($_POST['length'])){
			$post_length=$_POST['length'];
			// $post_length=20;
		 $start_limit_filter_array[]="limit=".$post_length;
		$to_return->limit=$post_length;
		}
	
		/**search filter using advance search */
		/**check search data is present or not */
		$search_form_data=array();
		 if(isset($_POST['search_data'])){
			$to_return->search_data=$_POST['search_data'];
			$search_form_data=$_POST['search_data'];
			 $to_return->search_data_decode=$search_form_data;
		 	// $search_data_decode=json_decode($_POST['search_data']);
				foreach($search_form_data as $key=>$value){
					$to_return->key=$key;
					$to_return->value=$value;
					if($value['name']=="key_skills"){
						if($value['value']!=""){
							$search_skills = $value['value'];
							$key_skills_array=[];
							$key_skills_array['key_skills']=$search_skills;
							$to_return->key_skills_array=$search_skills;
							$to_return->search_skills=$search_skills;
							$skills_array=array();
							$skills_array=array_map('trim', array_filter(explode(",",$search_skills)));
							$to_return->skills_array=$skills_array;
							$skills_implode_data=implode("|",$skills_array);
							$search_filter_array[]="skills%=".$skills_implode_data;
							$to_return->search_filter_array=$search_filter_array;
						}
					}
					if($value['name']=="preferred_location"){
						if($value['value']!=""){
							$search_preferred_location = $value['value'];
							$preferred_location_array=[];
							$preferred_location_array['preferred_location']=$search_preferred_location;
							$to_return->preferred_location_array=$search_preferred_location;
							$to_return->search_preferred_location=$search_preferred_location;
							$preferred_location_array=array();
							$preferred_location_array=array_map('trim', array_filter(explode(",",$search_preferred_location)));
							$to_return->preferred_location_array=$preferred_location_array;
							$preferred_location_implode_data=implode("|",$preferred_location_array);
							$search_filter_array[]="location%=".$preferred_location_implode_data;
							$to_return->search_filter_array=$search_filter_array;
						}
					}
					if($value['name']=="experience_years"){
						if($value['value']!="unselected"){
							$search_experience_years = $value['value'];
							$experience_years_array=[];
							$experience_years_array['experience_years']=$search_experience_years;
							$to_return->experience_years_array=$search_experience_years;
							$to_return->search_experience_years=$search_experience_years;
							$experience_array=array();
							$experience_array=array_map('trim', array_filter(explode(",",$search_experience_years)));
							$to_return->experience_array=$experience_array;
							$experience_implode_data=implode("|",$experience_array);
							$search_filter_array[]="min_experience<=".$experience_implode_data.",max_experience>=".$experience_implode_data;
							$to_return->search_filter_array=$search_filter_array;
						}
					}
					if($value['name']=="job_type"){
						if($value['value']!=""){
							$search_job_type = $value['value'];
							$job_type_array=[];
							$job_type_array['job_type']=$search_job_type;
							$to_return->job_type_array=$search_job_type;
							$to_return->search_job_type=$search_job_type;
							$job_type_array=array();
							$job_type_array=array_map('trim', array_filter(explode(",",$search_job_type)));
							$to_return->job_type_array=$job_type_array;
							$job_type_implode_data=implode("|",$job_type_array);
							$search_filter_array[]="job_type%=".$job_type_implode_data;
							$to_return->search_filter_array=$search_filter_array;
						}
					}
					if($value['name']=="company_name"){
						if($value['value']!=""){
							$search_company = $value['value'];
							$company_name_array=[];
							$company_name_array['company_name']=$search_company;
							$to_return->company_name_array=$search_company;
							$to_return->search_company=$search_company;
							$company_array=array();
							$company_array=array_map('trim', array_filter(explode(",",$search_company)));
							$to_return->company_array=$company_array;
							$company_implode_data=implode("|",$company_array);
							$search_filter_array[]="company_name%=".$company_implode_data;
							$to_return->search_filter_array=$search_filter_array;
						}
					}
				}
			
		}

		/**Quick search data filter on job pages */
		/**Check quick search data is present or not */
		$quick_search_data=array();
		if(isset($_POST['quick_search_data'])){
			$to_return->quick_search_data=$_POST['quick_search_data'];
			$quick_search_data=$_POST['quick_search_data'];
			$to_return->quick_search_data_decode=$quick_search_data;

			// $quick_search_array=array();
			// $quick_search_array=array_map('trim', array_filter(explode(",",$quick_search_data)));
			// $to_return->quick_search_array=$quick_search_array;
			// // $quick_search_implode_data=implode("|",$quick_search_array);
			// $allow = ["&"];
			// $selector = $sanitizer->selectorValue("&100", ['whitelist' => $allow]);

			// addslashes($job_page->company_name);

			// $match_special_characters = preg_match('[@_!#$%^&*()<>?/|}{~:]', $quick_search_data);
			// 	$to_return->match_special_characters=$match_special_characters;
				if(preg_match('[@_!#$%^&*()<>?/|}{~:]', $quick_search_data)){
					// $special_quick_search_data=htmlspecialchars($quick_search_data);
					$special_quick_search_data=htmlspecialchars($quick_search_data, ENT_COMPAT,'ISO-8859-1', true);
					
					$to_return->special_quick_search_data=$special_quick_search_data;
					echo $special_quick_search_data;
					echo "********";
				}
				
			
			$search_filter_array[]="title|skills|location|job_type|company_name|summary|job_code%=".$quick_search_data;
			// $search_filter_array[]="title|skills|location|job_type|company_name|summary|job_code%=".$quick_search_data;
			$to_return->search_filter_array=$search_filter_array;
		 	
		}
		/**In login popup, when you click on fresher button that time applay experience filter */
	// 	if(isset($_POST['login_fresher_filter_data'])){
	// 		$to_return->login_fresher_filter_data=$_POST['login_fresher_filter_data'];
	// 		// $excep=$_GET['excep'];
	// 		//echo $excep;
	// 		// $filter_selector="min_experience<2,max_experience<2";
	// 		$search_filter_array[]="min_experience<2,max_experience<2";
	// }
		// $to_return->search_data=$search_data;

	/** Get company id and apply filter on job page using company id */
	$to_return->company_id=	$_POST['get_company_id'];
	if(isset($_POST['get_company_id']) && $_POST['get_company_id']!='false'){
		$to_return->check_company="yes present";
		$search_filter_array[]="job_added_by*=".$_POST['get_company_id'];

	}
/* Array to save all the data of all the jobs into */
$job_data_array = Array();
$all_jobs_array_without_filter = Array();
$to_return->filter_selector_array=$search_filter_array;//debug
  $filter_selector=implode(",",$search_filter_array);
   $to_return->filter_selector=$filter_selector;//debug
	 $merge_limit_and_filter_array=Array();
	 $merge_limit_and_filter_array=array_merge($search_filter_array,$start_limit_filter_array);
	 $start_limit_selector=implode(",",$merge_limit_and_filter_array);
	 $to_return->start_limit_selector=$start_limit_selector;
/* Loop through all the job profile pages */
$serial_counter=1;
$loop_counter=1;
 /* Job postings in the descending order od the day they were posted. Latest first. */
 $i=1;
 //echo time();
 //for($loop=0; $loop<3; $loop++){

 if(isset($start_limit_selector)){
		 $cards_filter=$start_limit_selector;
 }




 $all_jobs_array_without_filter=wire('pages')->get("name=jobs")->children("sort=-published,is_hot_jobs=no|'',verification=verified,active_status=active,".$filter_selector);
//  $all_jobs_array=wire('pages')->get("name=jobs")->children("sort=-published,".$filter_selector);
 $all_jobs_array=wire('pages')->get("name=jobs")->children("sort=-published,is_hot_jobs=no|'',verification=verified,active_status=active,".$start_limit_selector);
 $to_return->all_jobs_array_without_filter=$all_jobs_array_without_filter->count();
$recordsTotal=sizeof($all_jobs_array_without_filter);
$to_return->recordsTotal=$recordsTotal;
// foreach(wire('pages')->get("name=jobs")->children("sort=published") as $job_page) {
	if ($all_jobs_array->count() == 0) {
		$to_return->error->number_of_errors++;
		$to_return->error->error_message="No results found";
		// echo "<h3 class='text-center m-auto'>No results found</h3>";
	}
	$to_return->all_jobs_array=$all_jobs_array->count();
$job_page_counter = 0;
// for($i=1;$i<=100;$i++){

  foreach($all_jobs_array as $job_page) {
		if($loop_counter>$post_length){
			break;
		}
		$to_return->job_id=$job_page->id;
			if ($job_page->max_experience != 0 && isset($experience_years)) {
					if ($experience_years > $job_page->max_experience) {
							continue;
					}

			}
			//echo $job_page->job_publish_shedule!="";
			//echo "+++++++++++++++++++++++++++";
			if ($job_page->job_publish_shedule != "") {
					if ($job_page->job_publish_shedule > time()) {
							continue;
					}
			}

		$job_page_counter++;

		$is_visible = "";

      //  if($loop_counter>$post_length){
      //    break;
      //  }

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
		$job_data->counter = $job_page_counter;
    $job_data->id = $job_page->id;
    $job_data->title = htmlspecialchars_decode(htmlspecialchars_decode($job_page->title));
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
		$job_data->url = $job_page->httpUrl;
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
		/**new job badge */
		if (time() - $job_page->created < 15 * 24 * 60 * 60) {
			$job_data->new="NEW";
		}
		else{
			$job_data->new="";
		}
		/**Image of job */
		if ($job_page->job_image != null) {
			$job_data->image = $job_page->job_image->httpUrl;
		} 
		else {
			$job_data->image = $rootpath."images/job_card_Logo_new.png";
		}
		/**Posted date */
		$job_data->posted_date=date("d M Y", $job_page->created);
		/**Today's Views */
			$job_created_time=$job_page->created;
			$display_views_after_24_hours=$job_created_time+24*60*60;
			$current_timestamp=strtotime(date("d-m-Y"));
			if($job_created_time<$current_timestamp){
				$job_data->views=date("H", $job_page->created) + date("H", time());
			}
			else{
				$job_data->views= "0";
			}

			/**Location */
			$job_location = array_map('trim', array_filter(explode(",", $job_page->location)));

			$job_data->job_location = implode(", ", $job_location);

			$experience_text=$job_page->min_experience;
      if ($job_page->max_experience != 0) {
				$experience_text.= "-" . $job_page->max_experience;
			}
			$experience_text.=" Year";
			if ($job_page->min_experience != 1) {
				$experience_text.= 's';
			}
			$job_data->experience=$experience_text;
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

		$loop_counter++;
    
    /* Save the job data object into the main array of all the job data */
    array_push($job_data_array, $job_data);
  }
// }
/* Loop through all the job profile pages END */

/* Save the job data array into the object that is to be sent back */
$to_return->data = $job_data_array;
$recordsFiltered=sizeof($all_jobs_array_without_filter);
$to_return->recordsFiltered=$recordsFiltered;

/* Names and data of the columns to be displayed will be saved in this array */
// $to_return->columns = [
//  ["title"=>"", "data"=>"checkbox"],
//  ["title"=>"Verification", "data"=>"unlock_button"],
//  ["title"=>"Sr.no", "data"=>"serial_number"],
//  ["title"=>"Job Code", "data"=>"job_code"],
//  ["title"=>"Title", "data"=>"title"],
//  ["title"=>"Company", "data"=>"company_name"],
//  ["title"=>"Location", "data"=>"location"],
//  ["title"=>"Created Time", "data"=>"registration_time"],
//  ["title"=>"Created By", "data"=>"recruiter_company_name"],
//  ["title"=>"Updated Time", "data"=>"last_modified_date"],
//  ["title"=>"Job Publishing shedule", "data"=>"job_publish_shedule_for_table"],
//  ["title"=>"Deadline", "data"=>"application_deadline_for_table"],
//  ["title"=>"Active status", "data"=>"active_status"],
//  ["title"=>"Add to Hot Jobs", "data"=>"hot_jobs"],
//  ["title"=>"Applicants List", "data"=>"applicants_list_button"],
//  ["title"=>"Edit", "data"=>"edit"],
//  ["title"=>"Preview", "data"=>"job_preview"]
// // 			["title"=>"Button", "data"=>"button"]
 
// ];


// $myfile = fopen(wire('config')->paths->templates."includes/newfile.txt", "w");
$txt = json_encode($to_return);
// $txt = json_encode($post_values);
fwrite($myfile, $txt);
fwrite($myfile, "Hello demo");
fclose($myfile);

$to_return->success->success_status = true;




end_and_return();

/* Function to fetch the data of all jobs to show in the table END */






