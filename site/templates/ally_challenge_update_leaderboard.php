<?php
	/* Execution time is 10 minutes */
	ini_set('max_execution_time', 600);
	ini_set("display_errors", 1);
error_reporting(E_ALL);

	/* DB connection */
	/* Local Creds */
	// $dbHost = 'localhost';
	// $dbName = 'pride_circle';
	// $dbUser = 'root';
	// $dbPass = '';

	/* Server Creds */
	/* Development credentials */
	$dbHost = 'localhost';
	$dbName = 'u422182242_pc_rportal';
	$dbUser = 'u422182242_pc';
	$dbPass = 'Pc@rPortal123!';

	/* Live credentials */
	/*$dbHost = 'localhost';
	$dbName = 'u429740792_resume_db';
	$dbUser = 'u429740792_pride_circle';
	$dbPass = 'Pridecircle@123';*/

	$db_connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

	if(!$db_connection){
		echo "Cannot Connect to the Database. Please Try again.";
	}

	/* DB connection END*/

	/* Timestamp management */
	/* To continue from last input */
	$old_timestamp = $page->ally_challenge_leaderboard_timestamp;

	/* To save latest time for next reference, This will update at each iteration */
	$new_timestamp = $old_timestamp;
	/* Timestamp management END */


	/* Check if any new organisation accounts are added */
	/* Array of all the organisations */
	$registered_organisations_array = Array();

	/* Add all the organisations from the admin panel to the array */
	foreach ($page->allychallenge_leaderboard_organisations as $organisation) {
		$organisation_title = $organisation->title;
		$organisation_email = $organisation->email;
		$registered_organisations_array[$organisation->title] = $organisation_email;
//echo "h1";
		/* try to fetch account with given email */
		$check_organisation_query = mysqli_query( $db_connection, "SELECT * FROM ally_challenge_scores WHERE contestant_email = '". $organisation_email."' LIMIT 1");

		/* If returns result, account exists */
		if(mysqli_num_rows($check_organisation_query) === 1){
//echo "h2";
			/* fetch the account data */
			$account_info = mysqli_fetch_assoc($check_organisation_query);

			/* If registered as a group */
			if($account_info["company_name"] == ''){
//echo "h3";
				$is_organisation_registered = false;

				$entry_query = mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `company_name`='$organisation_title',`reference_email`='' WHERE contestant_email='$organisation_email'");
//print_r($entry_query);
//echo "asd";
			}
			/* If registered as a group END*/
		}
		else{
//echo "h4";
			$entry_query = add_company($db_connection, $organisation_email, 0, "", $organisation_title, '',$organisation_title, "incomplete");
//print_r($entry_query);
		}

	}

	/* Check if any new organisation accounts are added END */

	$entries_array = csvstring_to_array( file_get_contents($page->ally_challenge_leaderboard_csv->httpUrl));

	$array_for_calculation = array_reverse($entries_array);
//print_r($array_for_calculation);
	foreach ($array_for_calculation as $entry_info) {
		/* Time of the entry */
		$entry_time = strtotime($entry_info[11]);

		/* If entry is invalid or is older than the timestamp, next one. */
		if($entry_info[4] == "Invalid" || $entry_time <=$old_timestamp){
			continue;
//echo "continued";
		}

		if($entry_time > $new_timestamp){
			$new_timestamp = $entry_time;
		}

		$contestant_name = mysqli_real_escape_string($db_connection, $entry_info[0]);
		$contestant_email = mysqli_real_escape_string($db_connection, $entry_info[3]);
		$entry_action = mysqli_real_escape_string($db_connection, $entry_info[5]);
		$entry_score = mysqli_real_escape_string($db_connection, $entry_info[6]);
		$reference_email = mysqli_real_escape_string($db_connection, $entry_info[7]);
		// $contestant_country = mysqli_real_escape_string($db_connection, $entry_info[20]);
		$contestant_country = mysqli_real_escape_string($db_connection, $entry_info[15]);
		$score_to_referer = mysqli_real_escape_string($db_connection, $entry_info[6]);

		/* Check if email is a Group or Individual */
		$is_group= false;

		/* try to fetch account with given email */
		$check_account_query = mysqli_query( $db_connection, "SELECT * FROM ally_challenge_scores WHERE contestant_email = '$contestant_email' LIMIT 1");

		/* If returns result, account exists */
		if(mysqli_num_rows($check_account_query) === 1){
			/* fetch the account data */
			$account_info = mysqli_fetch_assoc($check_account_query);

			/* If registered as a group */
			if($account_info["company_name"] !== ''){
				$is_group = true;
			}
			/* If registered as a group END*/

			/* If the account is incomplete */
			if($account_info["profile_status"] === "incomplete"){
				/* Add the remaining fields to the account to complete the account */
				mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `contestant_name`='$contestant_name',`contestant_country`='$contestant_country',`profile_status`= 'complete' WHERE contestant_email='$contestant_email'");
			}
			/* If the account is incomplete END */
		}
		/* If account does not exist */
		else{
			/* Create Empty Account */
			add_contestant($db_connection, $contestant_email, 0, "", $contestant_name, $contestant_country, "incomplete");
		}
		/* Check if email is a Group or Individual END*/

		/* Add the entry score to self account */
		mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `contestant_score`=contestant_score+$entry_score WHERE contestant_email = '$contestant_email' LIMIT 1");
		/* Add the entry score to self account END */

		/* If it is a Group */
		if($is_group){
			/* If the task is to refer people */
			if($entry_action === "Refer Folx & Earn Bonus Entries (Points) #WinTogether"){
				/* Check if referee has an account */
				$check_referee_account_query = mysqli_query($db_connection, "SELECT * FROM `ally_challenge_scores` WHERE contestant_email = '$reference_email' LIMIT 1");

				/* If referee account exists */
				if(mysqli_num_rows($check_referee_account_query) === 1){
					/* Fetch referee account data */
					$referee_account_info = mysqli_fetch_assoc($check_referee_account_query);

					$add_referree_score = false;

					/* If group reference is empty */
					if($referee_account_info['reference_email']==""){
						/* Insert current group email as group referrer */
						mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `reference_email`='$contestant_email' WHERE contestant_email='$reference_email'");

						$add_referree_score = true;
					}
					/* If group reference is empty END */

					/* if reference has email ID equal to  current group ID */
					if($referee_account_info['reference_email'] === $contestant_email){
						$add_referree_score = true;
					}
					/* if reference has email ID equal to  current group ID */

					/* If the referee score is to be added to the current group account */
					if($add_referree_score){
						/* get referee score */
						$referee_score = $referee_account_info['contestant_score'];

						/* Add referee score to the group account */
						mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `contestant_score`=contestant_score+$referee_score WHERE contestant_email='$contestant_email'");
					}
					/* If the referee score is to be added to the current group account END */
				}
				/* If referee account exists END */

				/* If referee account does not exist */
				else{
					/* Create account with 0 score, group reference as the current contestant reference and status incomplete */
					add_contestant($db_connection, $reference_email, 0, $contestant_email, "", "", "incomplete");
				}
				/* If referee account does not exist END */
			}
			/* If the task is to refer people END */
		}
		/* If it is a Group END*/

		/* If it is an individual */
		else{
			/* Check if the person was referred to by a group */
			$check_for_group_referrer_query = mysqli_query($db_connection, "SELECT * FROM `ally_challenge_scores` WHERE contestant_email = '$contestant_email' AND reference_email!='' LIMIT 1");

			/* If referred to by a group, add the current score to the group */
			if(mysqli_num_rows($check_for_group_referrer_query) === 1){
				/* Fetch the data from current individual account */
				$check_for_group_referrer_result = mysqli_fetch_assoc($check_for_group_referrer_query);

				/* Get the group email */
				$group_referrer_email = $check_for_group_referrer_result ["reference_email"];

				/* Add the score to the account of the group */
				mysqli_query($db_connection, "UPDATE `ally_challenge_scores` SET `contestant_score`=contestant_score+$entry_score WHERE contestant_email = '$group_referrer_email' LIMIT 1");
			}
			/* If referred to by a group, add the current score to the group END */
		}
		/* If it is an individual END */
	}


	/* Fetch the Group Leaderboard */
	$group_leaderboard_array = Array();

	$group_leaderboard_result = mysqli_query($db_connection, "SELECT * FROM ally_challenge_scores WHERE company_name != '' AND contestant_score>0 ORDER BY contestant_score DESC LIMIT 25");

	if($group_leaderboard_result){
		while($group_leader = mysqli_fetch_assoc($group_leaderboard_result)){
			$group_ally_count_result = mysqli_query($db_connection, "SELECT reference_email, COUNT(*) AS ally_count FROM ally_challenge_scores WHERE reference_email='".$group_leader['contestant_email']."'");

			$group_leader["ally_count"] = mysqli_fetch_assoc($group_ally_count_result)["ally_count"];
			$group_leaderboard_array[] = $group_leader;
		}
	}
	else{
		echo "ERROR!1";
	}
	/* Fetch the Group Leaderboard END */

	/* Fetch the Individual Leaderboard */
	$individual_leaderboard_array = Array();
	$individual_leaderboard_result = mysqli_query($db_connection, "SELECT * FROM ally_challenge_scores WHERE company_name = '' ORDER BY contestant_score DESC LIMIT 25");

	if($individual_leaderboard_result){
		while($individual_leader = mysqli_fetch_assoc($individual_leaderboard_result)){
			$individual_leaderboard_array[] = $individual_leader;
		}
	}
	else{
		echo "ERROR!2";
	}
	/* Fetch the Individual Leaderboard END */

	/* Save data to the page */
	$page->of(false);
	$page->ally_challenge_leaderboard_timestamp = $new_timestamp;
	$page->ally_challenge_leaderboard_group = json_encode($group_leaderboard_array);
	$page->ally_challenge_leaderboard_individual = json_encode($individual_leaderboard_array);
	$page->save();
	/* Save data to the page END */

//$dataArray_json= json_encode(array_values($entries_array));

//echo $dataArray_json;

	function add_contestant($db_connection, $contestant_email, $entry_score, $reference_email, $contestant_name, $contestant_country, $profile_status){
		$add_contestant_result = mysqli_query($db_connection, "INSERT INTO ally_challenge_scores (`contestant_email`, `contestant_score`, `reference_email`, `contestant_name`, `contestant_country`,`company_name`, `profile_status`) VALUES ('$contestant_email',$entry_score,'$reference_email','$contestant_name','$contestant_country','', '$profile_status')");

		if($add_contestant_result){
			return true;
		}
		else{
echo "ERROR!3";
			return false;
		}
	}


	function add_company($db_connection, $contestant_email, $entry_score, $reference_email, $contestant_name, $contestant_country, $contestant_company, $profile_status){
			$add_contestant_result = mysqli_query($db_connection, "INSERT INTO ally_challenge_scores (`contestant_email`, `contestant_score`, `reference_email`, `contestant_name`, `contestant_country`,`company_name`, `profile_status`) VALUES ('$contestant_email',$entry_score,'$reference_email','$contestant_name','$contestant_country','$contestant_company', '$profile_status')");

			if($add_contestant_result){
				return true;
			}
			else{
	echo "ERROR!3";
				return false;
			}
		}



	function csvstring_to_array($string, $separatorChar = ',', $enclosureChar = '"', $newlineChar = "\n") {
	    // @author: Klemen Nagode
	    $array = array();
	    $size = strlen($string);
	    $columnIndex = 0;
	    $rowIndex = 0;
	    $fieldValue="";
	    $isEnclosured = false;

	    /* Only these fields are needed-
			3	"Email"
			4	"Status"
			5	"Action"
			6	"Entries"
			7	"Details"
			11	"When"
			15	"Country (User Details)"
		*/
	    $needed_columns_array = [0, 3, 4, 5, 6, 7, 11, 15];

	    for($i=0; $i<$size;$i++) {

	        $char = $string[$i];
	        $addChar = "";

	        if($isEnclosured) {
	            if($char==$enclosureChar) {

	                if($i+1<$size && $string[$i+1]==$enclosureChar){
	                    // escaped char
	                    $addChar=$char;
	                    $i++; // dont check next char
	                }else{
	                    $isEnclosured = false;
	                }
	            }else {
	                $addChar=$char;
	            }
	        }else {
	            if($char==$enclosureChar) {
	                $isEnclosured = true;
	            }else {

	                if($char==$separatorChar) {
	                	if($rowIndex!==0 && in_array($columnIndex, $needed_columns_array)){
	                		$array[$rowIndex][$columnIndex] = $fieldValue;
//echo "[\"$rowIndex.$columnIndex.$fieldValue\"],";
	                	}

	                    $fieldValue="";
	                    $columnIndex++;
	                }elseif($char==$newlineChar) {
//echo $char;
	                    //$array[$rowIndex][$columnIndex] = $fieldValue;

	                    $fieldValue="";
	                    $columnIndex=0;
	                    $rowIndex++;
	                }else {
	                    $addChar=$char;
	                }
	            }
	        }
	        if($addChar!=""){
	            $fieldValue.=$addChar;
	        }
	    }

	    if($fieldValue) { // save last field
	       $array[$rowIndex][$columnIndex] = $fieldValue;
	    }
	    return $array;
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Ally Challenge Leaderboard Update</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<center><h1>Leaderboards</h1></center>
 	<br>
 	<center><strong>Scores Until : <?=date('d/m/Y H:i:s', $page->ally_challenge_leaderboard_timestamp+(5.5*60*60))?></strong></center>
 	<br>
 	<br>
 	<div>
		<center>
			<table>
				<caption>Individual Leaderboard</caption>
				<thead>
					<tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Score</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;

						foreach ($individual_leaderboard_array as $individual_leader) {
							$counter++;
					?>

					<tr>
						<td><?=$counter?></td>
						<td><?=$individual_leader["contestant_name"] ?></td>
						<td><?=$individual_leader["contestant_score"] ?></td>
						<td><?=$individual_leader["contestant_country"] ?></td>
					</tr>

					<?php
						}
					?>
				</tbody>
			</table>
		</center>
 	</div>

 	<br>
 	<br>

 	<div>
		<center>
			<table>
				<caption>Group Leaderboard</caption>
				<thead>
					<tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Score</th>
						<th>Allies</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;

						foreach ($group_leaderboard_array as $group_leader) {
							$counter++;
					?>

					<tr>
						<td><?=$counter?></td>
						<td><?=$group_leader["company_name"] ?></td>
						<td><?=$group_leader["contestant_score"] ?></td>
						<td><?=$group_leader["ally_count"] ?></td>
					</tr>

					<?php
						}
					?>
				</tbody>
			</table>
		</center>
 	</div>


<style type="text/css">
	
.ranks-table {}

table.ranks-table  {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

.ranks-table td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.ranks-table tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
 	<div>

 		<div>
		<center>

			<?php

 			$all_companies_emails = mysqli_query( $db_connection, "SELECT company_name, contestant_email FROM ally_challenge_scores WHERE company_name !=''");	

 			while($main_row = mysqli_fetch_assoc($all_companies_emails)){
 				echo "<br><br><br><br><br>";
 				echo "<strong>COMPANY NAME:</strong> ". $main_row['company_name']."(". $main_row['contestant_email'].")<br><br><strong> TOP CONTENSTANTS: </strong> <br>";
 			?>

 			<table class="ranks-table" style="border: 1px solid #aaa">
				<thead>
					<tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Score</th>
						<th>Email</th>
					</tr>
				</thead>

				<tbody>

 			<?php
 				$company_referral_emails = mysqli_query( $db_connection, "SELECT * FROM ally_challenge_scores WHERE reference_email ='".$main_row['contestant_email']."' ORDER BY contestant_score DESC LIMIT 25");

 				$counter = 0;

 				while ($employee_email_row = mysqli_fetch_assoc($company_referral_emails)){

 					$counter++;

 			?>

 			<tr>
						<td><?=$counter?></td>
						<td><?=$employee_email_row["contestant_name"] ?></td>
						<td><?=$employee_email_row["contestant_score"] ?></td>
						<td><?=$employee_email_row["contestant_email"] ?></td>
			</tr>

 			<?php
 				}

 			?>
 			
 				</tbody>
			</table>

 			<?php

 			}

 		?>
				
		</center>
 	</div>


 		
 				 

 				
 	</div>
 </body>
 </html>

 <?php
	mysqli_close($db_connection);
 ?>