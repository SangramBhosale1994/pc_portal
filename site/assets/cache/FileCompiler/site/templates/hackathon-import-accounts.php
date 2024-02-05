<?php
	/* Execution time is 10 minutes */
	ini_set('max_execution_time', 600);
	ini_set("display_errors", 1);
	error_reporting(E_ALL);


 require(\ProcessWire\wire('files')->compile('vendor/autoload.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use \PhpOffice\PhpSpreadsheet\Reader\IReader;

	$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
	//$spreadsheet = $reader->load("files/Data dump first batch.xlsx");
	$reader->setReadDataOnly(true);
	$spreadsheet = $reader->load("../..".$page->file->url);

//print_r($spreadsheet);

	function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
		return array($first_name, $last_name);
	}


	$worksheet = $spreadsheet->getActiveSheet();
	$rows = $worksheet->toArray();

	$counter = 0;
	$candidates_array = Array();

	foreach($rows as $key => $value) {
		$counter++;
		$canidate_info_array = Array();

		if($key == 0){
			continue;	
		}

		// if($counter > 30){
		// 	continue;
		// }

		// key is the row count(starts from 0)
		// array of values

		$name_array = Array();
		$name_array = split_name($value[0]);
        
		$canidate_info_array["first_name"] = $name_array[0];
		$canidate_info_array["last_name"] = $name_array[1];
		$canidate_info_array["email"] = $value[1];
		$canidate_info_array["phone"] = $value[2];
		$canidate_info_array["identify_as"] = $value[3];
		$canidate_info_array["pronoun"] = $value[4];
		$canidate_info_array["qualification"] = $value[5];
		$canidate_info_array["experience"] = $value[6];
		$canidate_info_array["current_role"] = $value[7];
		$canidate_info_array["current_employer"] = $value[8];

//print_r($canidate_info_array);

		$first_name = $name_array[0];
		$last_name = $name_array[1];
		$preffered_name=$value[1];
		$email = $value[2];
		if($email==""){
		    echo "No email on line ".$key;
		    continue;
		}
		$phone = $value[3];
		$identify_as = $value[4];
		$whatsapp_number=$value[5];
		$pronoun = $value[6];
		$current_location = $value[7];
		$current_role = $value[8];
		$previous_current_company = $value[9];
		$skills = $value[10];
		$experience = $value[11];
		$qualification = $value[12];
		
// 		$current_role = $value[7];
// 		$current_employer = $value[8];

echo $first_name;
echo "<hr>";
echo $last_name;
echo "<hr>";
echo $preffered_name;
echo "<hr>";
echo $email;
echo "<hr>";
echo $phone;
echo "<hr>";
echo $identify_as;
echo "<hr>";
echo $whatsapp_number;
echo "<hr>";
echo $pronoun;
echo "<hr>";
echo $current_location;
echo "<hr>";
echo $current_role;
echo "<hr>";
echo $previous_current_company;
echo "<hr>";
echo $skills;
echo "<hr>";
echo $experience;
echo "<hr>";
echo $qualification;
echo "<hr>";
		

		// $first_name = $name_array[0];
		// $last_name = $name_array[1];
		// $email = $value[1];
		// $phone = $value[3];
		// $identify_as = $value[5];
		// $pronoun = $value[6];


		//$mobile_array = array("+91");
		//$phone = str_ireplace($mobile_array, '', $phone);
		
		$prefix = "+91";

		if (substr($phone, 0, strlen($prefix)) == $prefix) {
		    $phone = substr($phone, strlen($prefix));
		} 

		$prefix = "91";

		if (substr($phone, 0, strlen($prefix)) == $prefix && strlen($phone)>10) {
		    $phone = substr($phone, strlen($prefix));
		} 
//echo "<br>".$phone;
//echo "<hr>";
		/* Define a $np (New \ProcessWire\Page) variable for creating or getting page */
		$np= "";

		/* check if the page is to be created or edited */
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page")->id != 0){
			/* Get reference to the page to be edited */
			$np = $pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page");
			//$data_to_return->profile_to_edit = true;
//echo "<hr>account with email {$email} already exists<hr>";
			


		}
		/** Else if the page doesn't alreasy exist and this is a new entry */
		else{
			/*** Basic Page Creation Info */
			$np = new \ProcessWire\Page();
			$np->template = $templates->get("candidate_page");
			$np->parent = $pages->get("name=candidates");
			$np->title = time().mt_rand(10,99);
			/*** Basic Page Creation Info End */

			/*** Save the page with unique email-ID */
			$np->oauth_gmail = $email;

			/*** Serial ID created from the ID counter page */
			/**** Get serial ID from the serial ID page */
			$serial_id_counter_page = $pages->get("name=serial_id_counter_page");
			/**** Assign the given ID to the  new page and increment the number for the next page */
			$np->serial_id = $serial_id_counter_page->serial_id++;

			/**** save the incremented ID page */
			$serial_id_counter_page-> of(false);
			$serial_id_counter_page->save();
			/*** Serial ID created from the ID counter page END */

			/*** Save the newly created candidate page with bare minimum requirements so that a candidate profile is created */
			$np->of(false);
			$np->save();

			/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
			if($pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page")->id != 0){
				//$data_to_return->profile_created = true;
echo "<hr>NEW {$email}  created<hr>";
			}
			else{
				// $data_to_return->error = true;
				// $data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
				// echo json_encode($data_to_return);
				//exit();
echo "<hr>profile with {$email} cannot be created<hr>";
			continue;
			}
		}
		/* Check if the page is to be created or edited END */

		/* Save the link to the profile page in the data_to_return object.  */
		//$data_to_return->profile_url = $np->httpUrl;

		/* Text Data From The Form (sanitized) */
		$np->first_name = $sanitizer->text($first_name);
		$np->last_name = $sanitizer->text($last_name);
		//$np->preferred_name = $sanitizer->text($input->post->preferred_name);
		/** Check if 'other' is selected. If yes, go for the custom input. (for pronoun, out_at_work, identify_as, qualification etc multiple choice type inputs) */
		$np->pronoun = $sanitizer->text($pronoun);
		//$np->out_at_work = $sanitizer->text($input->post->out_at_work);
		$np->identify_as = $sanitizer->text($identify_as);
		//$np->date_of_birth = $sanitizer->text($input->post->date_of_birth);
		$np->email = $sanitizer->email($email);
		$np->phone_country_code = $sanitizer->text("+91");
		$np->phone_number = $sanitizer->text($phone);


		$np->qualification = $sanitizer->text($qualification);

		$np->current_employer = $sanitizer->text($current_employer);
		$np->current_role = $sanitizer->text($current_role);
		$np->experience_years = $sanitizer->text($experience);
		/*$np->current_city = $sanitizer->text(($input->post->current_city == 'other')?$input->post->current_city_custom : $input->post->current_city);
		$np->current_state = $sanitizer->text($input->post->current_state);
		$np->linkedin_url = $sanitizer->text($input->post->linkedin_url);

		$np->qualification = $sanitizer->text(($input->post->qualification == 'other')?$input->post->qualification_custom : $input->post->qualification);
		$np->course = $sanitizer->text(($input->post->course == 'other')?$input->post->course_custom : $input->post->course);
		$np->specialisation = $sanitizer->text($input->post->specialisation);
		$np->year_of_passing = $sanitizer->text($input->post->year_of_passing);
		$np->college = $sanitizer->text($input->post->college);
		$np->cartifications = $sanitizer->text($input->post->cartifications);*/

		/*$np->industry = $sanitizer->text(($input->post->industry == 'other')?$input->post->industry_custom : $input->post->industry);
		$np->functional_area = $sanitizer->text(($input->post->functional_area == 'other')?$input->post->functional_area_custom : $input->post->functional_area);
		$np->experience_years = $sanitizer->text($input->post->experience_years);
		$np->experience_months = $sanitizer->text($input->post->experience_months);
		
		
		$np->technical_skills = $sanitizer->text($input->post->technical_skills);
		$np->non_technical_skills = $sanitizer->text($input->post->non_technical_skills);
		$np->soft_skills = $sanitizer->text($input->post->soft_skills);
		$np->current_ctc_time = $sanitizer->text($input->post->current_ctc_time);
		$np->current_ctc = $sanitizer->text($input->post->current_ctc);
		$np->preferred_location1 = $sanitizer->text($input->post->preferred_location1);
		$np->preferred_location2 = $sanitizer->text($input->post->preferred_location2);
		$np->preferred_location3 = $sanitizer->text(($input->post->preferred_location3 == 'other')?$input->post->preferred_location_custom : $input->post->preferred_location3);
		$np->pwd_accomodation = $sanitizer->text($input->post->pwd_accomodation);
		$np->referred_by = $sanitizer->text($input->post->referred_by);
		$np->referrer_email = $sanitizer->text($input->post->referrer_email);
		$np->job_code = $sanitizer->text($input->post->job_code);*/


		/** Assign active_status. (Default 'active to new \ProcessWire\Pages; change according to POST input for page editing. This can only be edited by an admin. So no compulsory action done here on active_status unless needed.) */
		// if($input->post->active_status){
		// 	$np->active_status = $sanitizer->text($input->post->active_status);
		// }elseif(!$data_to_return->profile_to_edit){
		$np->active_status = "Active";
		// }
		/* Text Data From The Form End */


		/* Save the page with the text values from POST form input */
// $np->of(false);
// $np->save();
		/* Save the page with the text values from POST form input END */

		/* If the profile is not created, then it is now edited, Save it in data_to_return */
		// if(!$data_to_return->profile_created){
		// 	$data_to_return->profile_edited = true;
		// }


	};


echo "Done";

