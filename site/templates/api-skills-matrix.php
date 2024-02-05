<?php
/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	include 'includes/send_mail.php';

	
// print_r($_POST);
	/* Variable to be displayed at the end in json format as a collected output */
	global $to_return;
	$to_return = new stdClass();

	global $search_filter_array;
	$search_filter_array= Array();

	global $search_skills_array;
	$search_skills_array= Array();

	// global $current_city_array;
	// $current_city_array= Array();

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


	/* If no POST request is made, exit with an error message */
	if (!isset($_POST['requested_action_to_take'])) {
		$to_return->error->number_of_errors++;
		end_and_return();
	}

	// echo $_POST['filter_form'];
	// echo "----";
	// echo "****";
	// $search_form_details=$input->post("search_form_details");
	// echo $search_form_details;
	// print_r($search_form_details);
	if(isset($_POST['filter_form']) && $_POST['filter_form']=="true"){
		// echo "****";
		$search_form_details=$input->post("search_form_details");
		$search_form_details_array=json_decode($search_form_details);
		
		// print_r($search_form_details);
				/* Array to save data and then to save into the page */
		$form_inputs_array = array();
		$print_to_file=true;
		foreach ($search_form_details_array as $input_element) {
			$form_inputs_array[$input_element->name] = $input_element->value;
		}
		/* Array to save data and then to save into the page END */
		$key_skills=$form_inputs_array['key_skills'];
		if($key_skills!=""){
				$skills_array=array();
				$skills_array=array_map('trim', array_filter(explode(",",$form_inputs_array['key_skills'])));
				$skills_implode_data=implode("|",$skills_array);
				// $search_filter_array[]="skills%=".$skills_implode_data;
				$skill_array=array_map('trim', array_filter(explode(",",strtolower($form_inputs_array['key_skills']))));
				$search_skills_array=$skill_array;
		}
		// if(array_key_exists("preferred_location",$form_inputs_array) && $form_inputs_array['preferred_location']!=""){
		// 		$preferred_location_array=array();
		// 		$preferred_location_array=array_map('trim', array_filter(explode(",",$form_inputs_array['preferred_location'])));
		// 		$preferred_location_implode_data=implode("|",$preferred_location_array);
		// 		$search_filter_array[]="preferred_location1|preferred_location2|preferred_location3*=".$preferred_location_implode_data;
		// }
		if(array_key_exists("current_city",$form_inputs_array) && $form_inputs_array['current_city']!=""){
				$current_city_array=array();
				$current_city_array=array_map('trim', array_filter(explode(",",$form_inputs_array['current_city'])));
				$current_city_implode_data=implode("|",$current_city_array);
				$search_filter_array[]="current_city=".$current_city_implode_data;
				$current_city_array=array_map('trim', array_filter(explode(",",$form_inputs_array['current_city'])));
		}
		if($form_inputs_array['identify_as']!=""){
			 $identify_as_array=array();
			 $identify_as_array=array_map('trim', array_filter(explode(",",$form_inputs_array['identify_as'])));
			 $identify_as_implode_data=implode("|",$identify_as_array);
				$search_filter_array[]="identify_as=".$identify_as_implode_data;
				//echo "identify_as*=Gay";
		}
		$experience_array=array();
		if($form_inputs_array['experience_min']!="" || $form_inputs_array['experience_max']!=""){
			if($form_inputs_array['experience_min']==""){
				$experience_min=0;
			}
			else{
				$experience_min=$form_inputs_array['experience_min'];
			}
			if($form_inputs_array['experience_max']==""){
				$experience_max=60;
			}
			else{
				$experience_max=$form_inputs_array['experience_max'];
			}
		
			for($i=$experience_min;$i<=$experience_max;$i++){
			// for($i=0;$i<=0;$i++){
				$experience_array[]=$i;
			}
			$experience_implode_data=implode("|",$experience_array);
			$to_return->max_experience_impload_data=$experience_implode_data;
			if($experience_min==0 || $experience_max==0){
				$search_filter_array[]="experience_years=".$experience_implode_data;
			}
			else{
				$search_filter_array[]="experience_years=".$experience_implode_data;
			}
			
			$to_return->max_experience_filter_query="experience_years=".$experience_implode_data;
		}
	}

	/* Save the requested data */
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_skills_request_table_data","fetch_skills_location_request_table_data","fetch_skills_identify_as_request_table_data","fetch_skills_experience_request_table_data"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_skills_request_table_data":
			fetch_skills_request_table_data();
			end_and_return();
		break;  

		case "fetch_skills_location_request_table_data":
			fetch_skills_location_request_table_data();
			end_and_return();
		break; 

		case "fetch_skills_identify_as_request_table_data":
			fetch_skills_identify_as_request_table_data();
			end_and_return();
		break; 

		case "fetch_skills_experience_request_table_data":
			fetch_skills_experience_request_table_data();
			end_and_return();
		break; 
		
		default:
			$to_return->error->number_of_errors++;
			$to_return->error->error_message  = "Request failed. Please refresh and try again.";
			end_and_return();
		break;
	}
	/* Based on the POST input, decide what action to take END */

	/* Function to fetch the data of all editors to show in the table */
	// echo $_POST['filter_form'];
	// echo "****";
	function fetch_skills_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		global $search_filter_array;
		global $search_skills_array;
		// global $current_city_array;
		// $search_filter_array= Array();
		// $search_filter_array[]="active_status=active|Active";
		// $search_filter_array[]="skills!=";
		// $search_filter_array[]="current_city!=";
		// $search_filter_array[]="identify_as!=";
		// echo $_POST['filter_form'];
	

		$filter_selector=implode(",",$search_filter_array);
		// echo $filter_selector;
		// echo "filter";
			// echo $filter_selector;
		/* Code Amruta Jagtap*/	
    		
    		/* Array to save all the skill of all the candidate into */
    		$skill_array = array();
				$candidate_skills_array = array();
				$search_skills_array_data="";


    		// foreach(wire('pages')->get("name=candidates")->children("limit=20,".$filter_selector) as $candidate_page) {
						/**Skills data using candidate profile */
						// echo $candidate_page->id;   
						// echo "****";   
						$skill_array_candidate=array();
						
						// $skills_array_data=array_map('trim', array_filter(explode(",",strtolower($candidate_page->skills))));
						$skill_data_page=wire('pages')->get("name=skills-matrix-data");
						$Skills_data_array=explode("|",$skill_data_page->textarea_1);
						foreach($Skills_data_array as $single_skills){
							$candidate_skills_array[]=$single_skills;
						}

						$i=0;
						// echo "----";
						// print_r($candidate_skills_array);
						
						// echo "----";
						// print_r($search_skills_array);
						$array_to_send=array();
						
						if(!empty($search_skills_array)){
							foreach($search_skills_array as $skills){
								$skill_object=new stdClass();
								$skill_object->skills=$skills;
								// $skills_slug=wire('sanitizer')->pageName($skills, true);
								$skill_object->count=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$skills.",".$filter_selector)->count();
										// echo wire('pages')->get("name=candidates")->children("skills%=".$skills.",".$filter_selector)->count();
								array_push($array_to_send,$skill_object);
						
								// print_r($array_to_send);
							}


						}
						else{
							foreach($candidate_skills_array as $skill){
								$skill_object=new stdClass();
								$skill_object->skills=$skill;
								// $skills_slug=wire('sanitizer')->pageName($skill, true);
								$skill_object->count=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$skill)->count();
								array_push($array_to_send,$skill_object);
								// print_r($array_to_send);
							}
						}
						
						// print_r($array_to_send);
           
				// }
        /**End Skills data using candidate profile */   
				$to_return->data = $array_to_send;

    		/* Names and data of the columns to be displayed will be saved in this array */
    		$to_return->columns = [
    			["title"=>"Skills", "data"=>"skills"],
    			["title"=>"Number of candidate", "data"=>"count"]
    		];

				// $to_return->columns=array();
				// // foreach($skills_array as $single_skill){
				// 	$to_return->columns[] = [
				// 		"title"=>"Skills", "data"=>"skills"];
				// if($candidate_skills_array!="" ){
				// 	// foreach($skills_array as $single_skills){
				// 		foreach($candidate_skills_array as $single_skills){
				// 			$skills_slug=wire('sanitizer')->pageName($single_skills, true);
				// 				$to_return->columns[]=
				// 					// ["title"=>"Skills", "data"=>$single_skills],
				// 					["title"=>"Number of candidate", "data"=>$skills_slug];
				// 		}
				// 	// }
				// }
    		// $to_return->success->success_status = true;
    		end_and_return();
    		
  }
	
	/* Code ends Amruta Jagtap here*/	

	function fetch_skills_location_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
		/* Code Sameesh Yadav*/	
    		
    		/* Array to save all the skill of all the candidate into */
    		$skills_array = array();
				$location_array=array();
				$candidate_location_array=array();
				$candidate_skills_array=array();
				$candidate_count=array();
				$candidate_array=array();
				$location_array_count=array();
        
					$skill_array_candidate=array();
					$location_array_candidate=array();

					/**Location array count */
				// foreach(wire('pages')->get("name=candidates")->children("active_status=active|Active,current_city!=,skills!=") as $candidate_page) {
				// 	if(in_array($candidate_page->current_city,$candidate_location_array)){
				// 		continue;
				// 	}
				// 	else{
				// 		$candidate_location_array[]=$candidate_page->current_city;
				// 	}
					
				// }
				$skill_data_page=wire('pages')->get("name=skills-matrix-data");
				$Skills_data_array=explode("|",$skill_data_page->textarea_1);
					$skills_array[]="total";
					foreach($Skills_data_array as $single_skills){
						$skills_array[]=$single_skills;
					}
					
				// $location_data_array=explode("|",$skill_data_page->textarea_2);
				// 	foreach($location_data_array as $single_location){
				// 		$candidate_location_array[]=$single_location;
				// 	}

			$all_locations_array = wire('pages')->get("name=candidates")->children()->each('current_city'); // get the titles of subjects (pages)foreach ($subjects as $subject)
			// print_r(array_count_values($all_locations_array));
			// echo "**";
			$location_array_count=array_count_values($all_locations_array);
			$location_array_count=array_map('trim', array_filter(str_replace('.',' ',(array_keys($location_array_count)))));
	// print_r($location_array_count);
			// $location_array_count=end($location_array_count);
			// $location_array_count=arsort($location_array_count);
			// var_dump($location_array_count);
			// die();
			// print_r($skills_array);
				$array_to_send=array();
				foreach($skills_array as $single_skill){
					$skill_object=new stdClass();
					// echo $single_skill;
					// echo "1111****";
					
					$skill_object->skills=$single_skill;
					foreach($location_array_count as $single_location){
						
						$location_slug=wire('sanitizer')->pageName($single_location, true);
						if($location_slug==""){
							continue;
						}
						$skill_object->$location_slug=0;
					}
					// print_r($location_array_count);
					if($single_skill=="total"){
						$single_skill_current_city_array=wire('pages')->get("name=candidates")->children()->each("current_city");
						// 	print_r($single_skill_current_city_array);
						// echo "****"; 
					}
					else{
						$single_skill_current_city_array=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$single_skill)->each("current_city");
					}
					
				// print_r($single_skill_current_city_array);
				// echo "****"; 
					$single_skill_location_array_count=array_count_values($single_skill_current_city_array);
					// print_r($single_skill_location_array_count);
					foreach($single_skill_location_array_count as $single_location_name=>$single_location_count){
						$location_slug=wire('sanitizer')->pageName($single_location_name, true);
						if($location_slug==""){
							continue;
						}
						if($location_slug=="abu.india"){
							continue;
						}
						
						$skill_object->$location_slug+=$single_location_count;
						// echo "****";
						// print_r($skill_object->$location_slug);
					}

					// $skill_object->count=$single_skill_location_array_count;
					// echo "***";
					
					// print_r($single_skill_location_array_count);
					// foreach($location_array_count as $single_location_key=>$single_location_count){
					// 	$location_slug=wire('sanitizer')->pageName($single_location_key, true);
					// 	// echo "-----";
					// 	// echo $single_location_key;
					// 	// $candidate_count[]=wire('pages')->get("name=candidates")->children("skills%=".$single_skill.",current_city=".$single_location)->count();
					// 	$skill_object->$location_slug=wire('pages')->get("name=candidates")->children("skills%=".$single_skill.",current_city=".$single_location_key)->count();
				
					// }
					// print_r($skill_object);
					array_push($array_to_send,$skill_object);
					
				}
				// echo "++++++++";
				// print_r($array_to_send);
				/* Array to send data back to dataTable */
				
				/**End Skills data using candidate profile */   
				$to_return->data = $array_to_send;
				// echo $to_return->data;
				/* Names and data of the columns to be displayed will be saved in this array */
    		$to_return->columns=array();
				// foreach($skills_array as $single_skill){
					$to_return->columns[] = [
						"title"=>"Skills", "data"=>"skills"];
				if($location_array_count!="" ){
					// foreach($skills_array as $single_skills){
						foreach($location_array_count as $single_location){
							$location_slug=wire('sanitizer')->pageName($single_location, true);
								$to_return->columns[]=
									// ["title"=>"Skills", "data"=>$single_skills],
									["title"=>$single_location, "data"=>$location_slug];
						}
					// }
				}
    		$to_return->success->success_status = true;
				// print_r($to_return);
    		end_and_return();
    		
  }

	/* Code Amruta Jagtap*/	
	/**Fetch candidate count using identify as */
	function fetch_skills_identify_as_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
    		/* Array to save all the skill of all the candidate into */
    		$skills_array = array();
				$identify_as_array=array();
				$candidate_identify_as_array=array();
				$candidate_skills_array=array();
				$candidate_count=array();
				$candidate_array=array();
       
				
          //  echo "*****"; 
    		// foreach(wire('pages')->get("name=candidates")->children("active_status=active|Active,skills!=,identify_as!=") as $candidate_page) {
				
				// 	$skill_array_candidate=array();
				// 	$identify_as_array_candidate=array();

				// 	/**Location array count */
				// 	if(in_array($candidate_page->identify_as,$candidate_identify_as_array)){
				// 		continue;
				// 	}
				// 	else{
						
				// 		$candidate_identify_as_array[]=str_replace(",","",htmlentities(addslashes($candidate_page->identify_as)));
				// 	}
					
				// 	// $candidate_skills_array=array_map('trim', array_filter(explode(",",strtolower($candidate_page->skills))));
				// 	// foreach($candidate_skills_array as $single_skills_array){
				// 	// 		$skills_array[]=$single_skills_array;
				// 	// }
					
				// }
				$skill_data_page=wire('pages')->get("name=skills-matrix-data");
				$Skills_data_array=explode("|",$skill_data_page->textarea_1);
				$skills_array[]="total";	
				foreach($Skills_data_array as $single_skills){
						$skills_array[]=$single_skills;
					}
					// print_r($skills_array);

					foreach($skill_data_page->identify_as_repeater as $single_identify_as){
						$candidate_identify_as_array[]=$single_identify_as->text_1;
					}
					// print_r($candidate_identify_as_array);
				$array_to_send=array();
				foreach($skills_array as $single_skill){
					$skill_object=new stdClass();
					// echo "111****";
					// echo $single_skill;
					$skill_object->skills=$single_skill;
					// if(!empty($candidate_identify_as_array)){
					
						foreach($candidate_identify_as_array as $single_identify_as){
							$identify_as_slug=wire('sanitizer')->pageName($single_identify_as, true);
						// 	echo "222****";
						// echo $single_identify_as;
						// echo "3333----";
						// echo wire('pages')->get("name=candidates")->children("skills%=".$single_skill.",identify_as%=".$single_identify_as)->count();
							// $candidate_count[]=wire('pages')->get("name=candidates")->children("skills%=".$single_skill.",identify_as%=".$single_identify_as)->count();
							
							// $skill_object->$identify_as_slug=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$single_skill.",identify_as%=".$single_identify_as)->count();
							if($single_skill=="total"){
								$skill_object->$identify_as_slug=wire('pages')->get("name=candidates")->children("identify_as=".$single_identify_as)->count();
							}
							else{
								$skill_object->$identify_as_slug=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$single_skill.",identify_as=".$single_identify_as)->count();
							}
						// echo "4444";
						// echo 
						}
					// }
					// print_r($skill_object);
					array_push($array_to_send,$skill_object);
					// print_r($array_to_send);
				}
				/* Array to send data back to dataTable */
				// 
				/**End Skills data using candidate profile */   
				$to_return->data = $array_to_send;
				/* Names and data of the columns to be displayed will be saved in this array */
    		$to_return->columns=array();
				$to_return->columns[] = ["title"=>"Skills", "data"=>"skills"];
				if(!empty($candidate_identify_as_array)){
						foreach($candidate_identify_as_array as $single_identify_as){
							$identify_as_slug=wire('sanitizer')->pageName($single_identify_as, true);
								$to_return->columns[]=
									// ["title"=>"Skills", "data"=>$single_skills],
								["title"=>$single_identify_as, "data"=>$identify_as_slug];
						}
				}
    		$to_return->success->success_status = true;
    		end_and_return();
    		
  }
	/**Fetch candidate count using identify as */
	/* Code ends Amruta Jagtap here*/	

	/* Code Amruta Jagtap*/	
	/**Fetch candidate count using experience */
	function fetch_skills_experience_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
    		/* Array to save all the skill of all the candidate into */
    		$skills_array = array();
				$candidate_skills_array=array();
				$candidate_experience_array=array();
				$candidate_count=array();
				$candidate_array=array();

				$skill_array_candidate=array();
						
					// $skills_array_data=array_map('trim', array_filter(explode(",",strtolower($candidate_page->skills))));
				$skill_data_page=wire('pages')->get("name=skills-matrix-data");
				$Skills_data_array=explode("|",$skill_data_page->textarea_1);
				$candidate_skills_array[]="total";
				foreach($Skills_data_array as $single_skills){
					$candidate_skills_array[]=$single_skills;
				}
				foreach($skill_data_page->experience_repeater as $single_experience){
					$candidate_experience_array[]=$single_experience->text_1;
				}
				// $candidate_experience_array=array('0-3','4-6');
				$array_to_send=array();
				foreach($candidate_skills_array as $single_skill){
					$skill_object=new stdClass();
					// echo "111****";
					// echo $single_skill;
					
					$skill_object->skills=$single_skill;
					// $skill_object->total="total";
					// print_r($candidate_experience_array);
					
					foreach($candidate_experience_array as $single_experience_object){
						// if(in_array("0",$single_experience_object)){
						// 	echo "0";
						// }
						// if (property_exists($single_experience_object, '0')) {
						// 	echo "0";
						// 	echo "111";
						// }
						// print_r($single_experience_object);
						// echo "///";
						$experience_array=explode("-",$single_experience_object);
						// print_r($experience_array);
						// echo "888";
						// echo $experience_array[0];
						$experience_array_for_implode=array();
							for($i=$experience_array[0];$i<=$experience_array[1];$i++){
								$experience_array_for_implode[]=$i;	
							}
						$experience_implode_data=implode("|",$experience_array_for_implode);
							// echo "***";
							// 	print_r($experience_implode_data);
							// 	echo "----";
			 			// $experience_implode_data=implode("|",$experience_array);
						$experience_slug=wire('sanitizer')->pageName($single_experience_object, true);
						
						// echo "experience_years<=".$experience_implode_data.",experience_years>=".$experience_implode_data;
						if($single_skill=="total"){
							$skill_object->$experience_slug=wire('pages')->get("name=candidates")->children("experience_years=".$experience_implode_data)->count();
						}
						else{
							$skill_object->$experience_slug=wire('pages')->get("name=candidates")->children("skills|soft_skills|technical_skills|non_technical_skills%=".$single_skill.",experience_years~=".$experience_implode_data)->count();
						}
						
					}
					
					array_push($array_to_send,$skill_object);
				}
				/* Array to send data back to dataTable */
				
				/**End Skills data using candidate profile */   
				$to_return->data = $array_to_send;
				/* Names and data of the columns to be displayed will be saved in this array */
    		$to_return->columns=array();
				// $to_return->columns[] = ["title"=>"Total", "data"=>"total"];
				$to_return->columns[] = ["title"=>"Skills", "data"=>"skills"];
				if($candidate_experience_array!="" ){
						foreach($candidate_experience_array as $single_experience_object){
							$experience_slug=wire('sanitizer')->pageName($single_experience_object, true);
								$to_return->columns[]=
									// ["title"=>"Skills", "data"=>$single_skills],
								["title"=>$single_experience_object, "data"=>$experience_slug];
						}
				}
    		$to_return->success->success_status = true;
    		end_and_return();
    		
  }
	/**Fetch candidate count using identify as */
	/* Code ends Amruta Jagtap here*/	
	/* Function to fetch the data of all editors favourite table to show in the table END */
?>