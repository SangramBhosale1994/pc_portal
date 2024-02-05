<?php
	require_once 'includes/candidate_table_data.php';

	/* TODO find out the problem here and remove this line. This line should not be required. Added as a last resort. the two of the following-*/
	$all_columns["Uploaded Files"]["redacted_resume"] = "Redacted Resume";
	$all_columns["Additional Details"]["job_code"] = "Job Code";

	$rootpath = $config->urls->templates;

	if (!isset($_POST['now'])) {
		die("Something went wrong. Please refresh and try again");
	}

	$imported_columns_to_show = json_decode($_POST['now']);
	$columns_to_show  = [];
	$session->admin_candidate_table_columns = $imported_columns_to_show;


	foreach ($all_columns as $column_section_key => $column_section_name) {
		foreach ($column_section_name as $column_key => $column_name) {
			if(in_array($column_key, $imported_columns_to_show)){
				$columns_to_show[$column_key] = $column_name;
				$session->admin_candidate_table_columns[] = $column_key;
			}
		}
	}
?>


<table class="table table-bordered hover" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th><input id="top_select_all_checkbox_checkbox" class="select_all_checkbox" type="checkbox"></th>

			<?php
				foreach ($columns_to_show as $column_key => $column_title) {
			?>

			<th class="<?=$column_key?>"><?=$column_title?></th>

			<?php
				}
			?>

		</tr>
	</thead>

	<tfoot>
		<tr>
			<th><input id="bottom_select_all_checkbox_checkbox" class="select_all_checkbox" type="checkbox"></th>

			<?php
				foreach ($columns_to_show as $column_key => $column_title) {
			?>

			<th class="<?=$column_key?>"><?=$column_title?></th>

			<?php
				}
			?>
		</tr>
	</tfoot>

	<tbody>
		<?php
			$candidate_info_array = array();

			foreach ($pages->get("name=candidates")->children("sort=id") as $key => $candidate) {
				$candidate_info_array["id"] = $candidate->id;
				$candidate_info_array["serial_id"] = $candidate->serial_id;
				$candidate_info_array["oauth_gmail"] = $candidate->oauth_gmail;
				$candidate_info_array["registration_time"] = date("F j, Y, g:i a", $candidate->created);
				$candidate_info_array["first_name"] = $candidate->first_name;
				$candidate_info_array["last_name"] = $candidate->last_name;
				$candidate_info_array["preferred_name"] = $candidate->preferred_name;
				$candidate_info_array["custom_full_name"] = $candidate->first_name." ".$candidate->last_name.($candidate->preferred_name == "" ? "" : " (".$candidate->preferred_name.")");
				$candidate_info_array["pronoun"] = $candidate->pronoun;
				$candidate_info_array["out_at_work"] = $candidate->out_at_work;
				$candidate_info_array["identify_as"] = $candidate->identify_as;
				$candidate_info_array["date_of_birth"] = date("d M Y", (int) $candidate->date_of_birth);
				$candidate_info_array["email"] = $candidate->email;
				$candidate_info_array["phone_country_code"] = $candidate->phone_country_code;
				$candidate_info_array["phone_number"] = $candidate->phone_number;
				$candidate_info_array["custom_phone_number"] = $candidate->phone_country_code.$candidate->phone_number;
				$candidate_info_array["current_city"] = $candidate->current_city;
				$candidate_info_array["current_state"] = $candidate->current_state;
				$candidate_info_array["linkedin_url"] = $candidate->linkedin_url;
				$candidate_info_array["qualification"] = $candidate->qualification;
				$candidate_info_array["course"] = $candidate->course;
				$candidate_info_array["specialisation"] = $candidate->specialisation;
				$candidate_info_array["year_of_passing"] = $candidate->year_of_passing;
				$candidate_info_array["college"] = $candidate->college;
				$candidate_info_array["cartifications"] = $candidate->cartifications;
				$candidate_info_array["industry"] = $candidate->industry;
				$candidate_info_array["functional_area"] = $candidate->functional_area;
				$candidate_info_array["experience_years"] = $candidate->experience_years;
				$candidate_info_array["experience_months"] = $candidate->experience_months;
				$candidate_info_array["custom_experience"] = $candidate->experience_years." Years ".$candidate->experience_months." Months";
				$candidate_info_array["current_employer"] = $candidate->current_employer;
				$candidate_info_array["current_role"] = $candidate->current_role;
				$candidate_info_array["skills"] = $candidate->skills;
				$candidate_info_array["technical_skills"] = $candidate->technical_skills;
				$candidate_info_array["non_technical_skills"] = $candidate->non_technical_skills;
				$candidate_info_array["soft_skills"] = $candidate->soft_skills;
				$candidate_info_array["current_ctc_time"] = $candidate->current_ctc_time;
				$candidate_info_array["current_ctc"] = $candidate->current_ctc;
				$candidate_info_array["custom_ctc"] = $candidate->custom_ctc;
				$candidate_info_array["preferred_location1"] = $candidate->preferred_location1;
				$candidate_info_array["preferred_location2"] = $candidate->preferred_location2;
				$candidate_info_array["preferred_location3"] = $candidate->preferred_location3;
				$candidate_info_array["job_code"] = $candidate->job_code;
				$candidate_info_array["pwd_accomodation"] = $candidate->pwd_accomodation;
				$candidate_info_array["referred_by"] = $candidate->referred_by;
				$candidate_info_array["referrer_email"] = $candidate->referrer_email;
				$candidate_info_array["active_status"] = $candidate->active_status;

				$candidate_info_array["resume"] = "-";

				if ($candidate->resume) {
					$candidate_info_array["resume"] = "<a href='".$candidate->resume->httpUrl."' target='_blank'>Download<a>";
				}

				$candidate_info_array["profile_picture"] = "-";

				if ($candidate->profile_image) {
					$candidate_info_array["profile_picture"] = "<a href='".$candidate->profile_image->httpUrl."' target='_blank'>Show<a>";
				}

				$candidate_info_array["redacted_resume"] = "<div>-</div>";

				if ($candidate->redacted_resume) {
					$candidate_info_array["redacted_resume"] = "<a href='".$candidate->redacted_resume->httpUrl."' target='_blank'>Download<a>";
				}
		?>
		<tr>
			<td><input id="<?=$candidate->id?>_checkbox" class="candidate_checkbox" type="checkbox"></td>

			<?php
				foreach ($columns_to_show as $column_key => $column_title) {
			?>

			<td class="<?=$column_key?>"><?=$candidate_info_array[$column_key]?></td>

			<?php
				}
			?>
		</tr>

		<?php
			}
		?>
	</tbody>
</table>