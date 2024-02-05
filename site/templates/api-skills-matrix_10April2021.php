<?php
/* Specify the page output is in JSON */
	header("Content-Type: application/json; charset=UTF-8");

	include 'includes/send_mail.php';

	

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

	/* Save the requested data */
	$requested_action_to_take = $input->post("requested_action_to_take",["fetch_skills_request_table_data"], false);

	/* Based on the POST input, decide what action to take */
	switch ($requested_action_to_take) {
		case "fetch_skills_request_table_data":
			fetch_skills_request_table_data();
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
	function fetch_skills_request_table_data(){
		/* Access global variable that is to be returned */
		global $to_return;
	/* Code Amruta Jagtap*/	
		/* Array to save all the skill of all the candidate into */
		$skill_array = array();
		$skill_array_object=array();
        $loop_counter=1;
		foreach(wire('pages')->get("name=candidates")->children("sort=published,skills!=") as $candidate_page) {
		    $loop_counter++;
//print_r($skill_page->skills);
// 			foreach(array_map('trim', array_filter(preg_split("/[,;\"]/",$skill_page->skills))) as $skill)
            //echo $candidate_page;
            $skills_array_data=array_map('trim', array_filter(explode(",",strtolower($candidate_page->skills))));
            //$skills_array_data=array_map('trim', array_filter(preg_split("/[,;\"({]./",strtolower($candidate_page->skills))));
            // print_r($skills_array_data);
            // die();
            $counter=0;
            //foreach( $skills_array_data as $key => $value){
                foreach( $skills_array_data as $skills){
                
                	$technical_skills_data = new stdClass();
		print_r($skills);
		
		          //  if(in_array($value,$skills_array_data)){
		          //      continue;
		          //  }
		          //  else{
		          //      $technical_skills_data->number_of_candidate=$key++;
        			 //   $technical_skills_data->skills=$value;
		          //  }
		            $technical_skills_data->number_of_candidate=$counter;
        			$technical_skills_data->skills=$skills;
        			
        			//$technical_skills_data->number_of_candidates=$value->number_of_candidates;
                	$counter++;
    			//$value->number_of_candidates=0;
    		}
    		
            // print_r($skills_array_data);
            // echo "----------------------";
//             $counter=1;
//             foreach( $skills_array_data as $skills){
// 				$key=trim($skills);
// 			// foreach( array_key_exists("c", $str_arr) as $key){
// 			// print_r($str_arr);
// 				// $skill_titles_array=find_skill_synonyms($skills_data_object,$key);
// 				$non_technical_skills_data = new stdClass();
// 		//print_r($skills_data);
			
// 			if(in_array($non_technical_skills_data->skills,$skills)){
// 			    continue;
// 			}
// 			else{
// 			 //   $non_technical_skills_data->counter=$counter;
// 			 //   $non_technical_skills_data->key=$key;
// 			 	$counter++;
// 			}
		
// 			//$non_technical_skills_data->number_of_candidates=$value->number_of_candidates;
// 			//$non_technical_skills_data=json_decode($non_technical_skills_data);

// // 				if($skills){
// // 					foreach($skills as $skill_title)
// // 					{
// // 	//echo "6";
// // 						//echo $skill_title;
// // 						$skills_data_object->$skill_title->number_of_candidates++;
// // 					}
					
// // 				}
// // 				else{
// // 	//echo "7";					//$data[$key]=1;
// // 					$skills_data_object->$key=new stdClass;
// // 					$skills_data_object->$key->number_of_candidates=1;
// // 				// 	$skills_data_object->$key->synonyms=array();
// // 				// 	$skills_data_object->$key->synonyms[]=$key;
// // 				}
				
// 			}
			array_push($skill_array_object,$technical_skills_data);
		
		}
	//	echo "----------------".$loop_counter;
		/*here candidate page id count 725*/
		/* Code End Amruta Jagtap*/
            
            
            
            
            
            
            
            
//             foreach($skills_array_data as $skill)
// 			{
 //print_r($skill);
 //$demo_skills="Application and Server Monitoring Tools,Application and Server Monitoring Tools";
 //print_r(explode(",",$demo_skills));
// 				//$skill=strtolower($skills_array_data);
// print_r($skill);
// echo "***************";
// print_r($skill_array);
//$skill_array=array("Application and Server Monitoring Tools","Application and Server Monitoring Tools");
//echo in_array($skill,$skill_array);
//echo "***********************";
// 				$should_not_skill=["","na","etc",".","n/a"];
// 				if(in_array($skill,$should_not_skill)){
// //echo "1";
// 					continue;
// 				}
// 				elseif(in_array($skill,$skill_array)){
// //echo "2";
// //echo $skill_array[$skill];
// 					$skill_array[$skill]++;
// //echo "3";
// 				}
// 				else{
// //echo "4";
// 					$skill_array[$skill]=1;
// 				}
// 			//}
//	}
// 		//Object array for return data
// 		$skill_array_object=array();

// 		//loop for array to object for datatables
// 		foreach(array_keys($skill_array) as $key){
// 			$skill_data = new stdClass();
// 			$skill_data->skill = $key;
// 			$skill_data->count=$skill_array[$key];
// 			array_push($skill_array_object,$skill_data);
// 		}
        // $newArray = array();
        // foreach ($skill_array_object as $key => $value){
        //     if(array_key_exists($key,$newArray)){
        //         $newArray[$key] = $newArray[$key] + $value; 
        //     } else {
        //         $newArray[$key] = $value;
        //     }
        // }
        //print_r($newArray);
		//data to return;
		$to_return->data = $skill_array_object;

		/* Names and data of the columns to be displayed will be saved in this array */
		$to_return->columns = [
			["title"=>"Skills", "data"=>"skills"],
			["title"=>"Number of candidate", "data"=>"number_of_candidate"]
		];
		$to_return->success->success_status = true;
		end_and_return();
		
	}
	/* Function to fetch the data of all editors favourite table to show in the table END */
?>