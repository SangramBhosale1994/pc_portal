<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
	//Tell the browser to redirect to the HTTPS URL.
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	//Prevent the rest of the script from executing.
	exit;
}
if($session->user_email == "" || $session->user_designation != "recruiter"){
	$session->redirect($pages->get("name=recruiter-login")->httpUrl);
}

 require_once(\ProcessWire\wire('files')->compile('includes/candidate_table_data.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

/* TODO : Deprecate this system. Use direct values. */
	$rootpath = $config->urls->templates;
	$homepath = $urls->httpRoot."resume/";

	global $recruiter_page;
	global $show_popup;
	global $last_login_time;
	global $current_timestamp;
	$show_popup = "false";
	global $admin_show_popup;
	$admin_show_popup="false";
// 	echo "global";
// 	echo $admin_show_popup;
	$session->subscription_expired = false;
	if($session->recruiter_profile_type=="sub-recruiter"){
		$deadline = new DateTime(date("Y-m-d", $pages->get($session->user_page_id)->parent()->subscription_to));
		$super_recruiter_page_for_popup=$pages->get($session->user_page_id)->parent();
	}
	else{
		$deadline = new DateTime(date("Y-m-d", $pages->get($session->user_page_id)->subscription_to));
		$super_recruiter_page_for_popup=$pages->get($session->user_page_id);
	}
	
	$deadline->modify('+1 day');

	if(new dateTime() > $deadline){
		$session->subscription_expired = true;

		$user_page = $pages->get($session->user_page_id);
		$user_page->of(false);

		$user_page->unlock_quota = 0;
		$user_page->save();
	}


	$recruiter_page=$pages->get($session->user_page_id);

	

	$recruiter_offers_input_data=Array();
	$current_timestamp = strtotime(date("Y-m-d h:i:sa"));

		// Check if the "Option A" checkbox is selected
		// $recruiter_accessible_section_checkbox=$super_recruiter_page_for_popup->recruiter_accessible_sections;
		
		foreach($super_recruiter_page_for_popup->recruiter_accessible_sections as $recruiter_accessible_section_checkbox) {
			// Do something if "Option A" is selected
			if($recruiter_accessible_section_checkbox->name=="offers-popup"){
				$admin_show_popup="true";
				// echo "true";
			}
			else{
				$admin_show_popup="false";
				// echo "false";
				
			}
		}
		// $recruiter_accessible_section_array=json_decode($super_recruiter_page_for_popup->recruiter_accessible_sections);
		// print_r($recruiter_accessible_section_array);
	// if(in_array("offers-popup",$recruiter_page->recruiter_accessible_sections))
	// {  
	// 	echo $recruiter_accessible_section->name;
	// 	echo "*****";
	// 	if($recruiter_accessible_section->name == "offers-popup"){
	// 		$admin_show_popup="true";
	// 		echo "true";
	// 	}
	// 	else{
	// 		$admin_show_popup="false";
	// 		echo "false";
	// 	}
	// }
	if($admin_show_popup=="true"){
// 		echo "if popup show";
		if($recruiter_page->offers_input_data!= ""){
			global $current_timestamp;
// 			echo "offers input data";
			$recruiter_offers_input_data=json_decode($recruiter_page->offers_input_data,true); // decode the JSON string into an associative array
			if(!empty($recruiter_offers_input_data)){
				$offer_entry_keys = array_keys($recruiter_offers_input_data); // store the keys in a variable
				$last_offer_entry_key = end($offer_entry_keys); // pass the variable by reference to the end() function
				$last_offer_timestamp = $recruiter_offers_input_data[$last_offer_entry_key];
				// $current_timestamp = 1680769860;
				// $last_offer_timestamp=1680692556;
				// echo $last_offer_timestamp;
				// echo "****";
				$days_to_add = 7;
				$timestamp_after_7_days = $last_offer_timestamp + ($days_to_add * 24 * 60 * 60);

				/**15min login */
				// $current_timestamp = time();  // get current Unix timestamp
				// $rounded_timestamp = floor($last_offer_timestamp / 1800) * 1800;  // round down to nearest multiple of 900 seconds
				// $timestamp_after_7_days = $rounded_timestamp + 1800;  // add 900 seconds to get next 15-minute timestamp

				// echo $timestamp_after_7_days; // Output: 1686505860
				// echo "////";
				// echo $current_timestamp;
				if($current_timestamp > $timestamp_after_7_days){
					// echo "true";
					$show_popup = "true";
				}
				else{
					// echo "false";
					$show_popup = "false";
				}
			}
		}
		else{
// 			echo "last login ";
			global $last_login_time;
// 			echo $last_login_time;
			$time_log_array=json_decode($recruiter_page->time_logs); // decode the JSON string into an associative array
			if(!empty($time_log_array)){
				foreach($time_log_array as $single_time_log_array){
					foreach($single_time_log_array as $single_time_log){
						// Add the session ID to the session ID array
						$session_id_array[] = $single_time_log->session_id;
						// Check if the session ID matches the current session
						if($single_time_log->session_id == $session->session_id) {
							// Update the logout field if it's empty
							$last_login_time=$single_time_log->login;
						}	 
						
					}

					
				}
				// echo $last_login_time;
				// echo "****";
				$days_to_add = 7;
				$login_timestamp_after_7_days = $last_login_time + ($days_to_add * 24 * 60 * 60);

				/**15min logic */
				// $rounded_timestamp = floor($last_login_time / 1800) * 1800;  // round down to nearest multiple of 900 seconds
				// $login_timestamp_after_7_days = $rounded_timestamp + 1800;  // add 900 seconds to get next 15-minute timestamp

				// echo $login_timestamp_after_7_days; // Output: 1686505860
				
			}
			if($current_timestamp > $login_timestamp_after_7_days){
				$show_popup = "true";
				// echo "login true";
			}
			else{
				$show_popup = "false";
				// echo "login false";
			}
		}
	}
	if(isset($_POST['btn_offer_submit'])){
		global $recruiter_page;
		global $show_popup;
		$offer_input_count = $sanitizer->text($input->post->offer_count);
		$recruiters_offers_input_data_array=Array();
		$recruiters_offers_input_data_json=$recruiter_page->offers_input_data;
		// echo $recruiters_offers_input_data_json;
		// echo "----";
		// if($recruiter_page->offers_input_data != NULL){
// echo "999";
			
			if($recruiters_offers_input_data_json==""){
				$recruiters_offers_input_data_json="{}";
				$recruiter_page->offers_input_data="{}";
			}
			// print_r($recruiters_offers_input_data_array);
			$recruiter_page->offers_input_data="{}";
			// $recruiter_page->of(false);
			// $recruiter_page->save();
			$recruiters_offers_input_data_array=json_decode($recruiters_offers_input_data_json);
			
			if($offer_input_count!=""){
				// echo "**";
					$offer_count=$offer_input_count;
					
					// echo $offer_count;
					// $recruiters_offers_input_data_object=new stdClass();
					$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
					$recruiters_offers_input_data_array->$offer_count=$current_timestamp;
					$recruiter_page->offers_input_data = json_encode($recruiters_offers_input_data_array);
					// echo $recruiter_page->offers_input_data;
			}
	    $show_popup="false";
			$recruiter_page->of(false);
			$recruiter_page->save();
			// $show_popup="false";
			// echo "submit";
			// echo $show_popup;
		// }
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?=$page->title?></title>

	<link rel="stylesheet" href="<?= $rootpath;?>styles/collapsed_reset.css" />
    <link href="https://www.cssscript.com/demo/sticky.css" rel="stylesheet" type="text/css">
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?= $rootpath;?>styles/sidebar_collapsed.css?v=20.04.2023" />

	<!-- Custom fonts for this template -->
	<!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= $rootpath;?>styles/sb-admin-2.min.css" rel="stylesheet" async>

	<!-- Custom styles for this page -->
	<link href="<?= $rootpath;?>styles/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="<?= $rootpath;?>styles/fm.tagator.jquery.css">

	

	<script type="text/javascript">
		let rootpath = '<?=$rootpath?>';
		let homepath = '<?=$homepath?>';
	</script>

	<!-- Meta Pixel Code -->
	<!-- <script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js%27');
	fbq('init', '297156267641785');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=297156267641785&ev=PageView&noscript=1"
	/></noscript> -->
	<!-- End Meta Pixel Code -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-C3XCR831MS');
	</script> -->

	<!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.1.0/dist/css/bootstrap.min.css"> -->

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>

<!-- Bootstrap JavaScript -->
<!-- <script src="https://unpkg.com/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> -->
<?php
	// echo "script";
	// echo $show_popup;
?>
<script>
	// Wait for the document to load

	$(document).ready(function() {
		
		// Get the modal
		// const modal = $("#offer_popup_modal");
		
		// console.log("modal");
		// console.log(modal);

		
		<?php
		global $show_popup,$admin_show_popup;
		// modal.modal("hide");
		// echo "script";
		// echo $show_popup;
		// echo "*****";
		// echo $admin_show_popup;
		if($show_popup == "true" && $admin_show_popup =="true") {
		?>
			// Show the modal
			console.log("show");
			// modal.modal("show");
			$("#offer_popup_modal").modal("show");
			$('#offer_popup_modal').modal({
				backdrop: 'static',
				keyboard: false
			});
		<?php
		}
		else{
			echo "else";
		?>
		
		// modal.modal("hide");
		modal.css("background-color", "red");
		modal.css("color", "blue");
		modal.modal("hide");
		$("#offer_popup_modal").modal('hide');
		console.log("hide");
		// setTimeout(function() {
		// 	modal.modal("hide");
		// }, 100);
		<?php
		}
		?>
	});
</script>

<style>
	.collapse:not(.show){
		display:block;
	}
	.header_navbar{
		width: calc(100% - 250px);
		margin:5px 70px; 
		transition:0.5s;
		width: calc(100% - 70px);
		margin: 0px 0px 5px 0px;
		width:100%; 
		z-index:99; 
		box-shadow: 0 0 0 0 rgba(58,59,69,.15) !important; 
		position : fixed;
	}
	
	.dashboard_cards_section{
		/* margin-left:15rem;
 		width: calc(100% - 250px); */
		 transition:0.5s;
		 width: calc(100% - 80px);
		margin: 83px 70px 5px 90px;
	}

	.recruiter_datatable_section{
		transition:0.5s;
		width: calc(100% - 80px);
		margin: 83px 70px 5px 90px;
		/* width:100%; */
	}

	footer.sticky-footer {
		/* margin-left: 14.3rem; */
		transition:0.5s;
		width: calc(100% - 70px);
		margin: 0px 0px 5px 0px;
		width: 100%;
	}
	.side-bar.collapse + .header_navbar {
		margin: 50px 300px;
		margin: 0px 0px 5px 0px;
		width:100%;
	}

	.side-bar.collapse + .header_navbar + .dashboard_cards_section {
		/* margin-left: 6.5rem;
		width: 92%; */
		width: calc(100% - 80px);
		margin: 83px 70px 5px 90px;

	}

	.side-bar.collapse + .header_navbar + .recruiter_datatable_section {
		width: calc(100% - 80px);
		/* margin: 0px 70px 5px 89px;
		margin: 50px 300px; */
		margin: 83px 70px 5px 90px;
	}

	.side-bar.collapse + .header_navbar + .dashboard_cards_section + .sticky-footer {
		margin: 0px 0px 5px 0px;
		width: 100%;
	}

	.side-bar.collapse + .header_navbar + .recruiter_datatable_section + .sticky-footer {
		margin: 0px 0px 5px 0px;
		width: 100%;
	}
	
</style>

</head>
 
<body id="page-top">
<div id="wrapper" >
	<div class="side-bar" id="collapsed_side_bar">
		<!-- <div class="logo-name-wrapper"> -->
			<!-- <div class="logo-name">
				<?php
				$sidebar_logo=$pages->get('name=recruiters')->logo_images->first->httpUrl;
				// echo $sidebar_logo;
				// echo "***";
				$sidebar_logo_link=$pages->get('name=recruiters')->logo_images->first->description;
				?>
				<a href="<?=$sidebar_logo_link?>">
				<img
					src="<?=$sidebar_logo?>"
					class="logo sidebar_logo"
					alt="Pride Circle"
					srcset=""
				/>
				</a>
			
			</div>  -->
			<!-- <button class="logo-name__button">
				<i
					class="bx bx-chevron-left logo-name__icon"
					id="logo-name__icon"
				></i> -->
				<!-- <i class='bx bx-chevron-right'></i> -->
			<!-- </button> -->
		<!-- </div> -->
		<!-- <div class="message">
			<i class="message-icon bx bx-message-square-edit"></i>
			<span class="message-text">New Mesage</span>
			<span class="tooltip">New Mesage</span>
		</div> -->
		<ul class="features-list">
			<?php
			global $admin_show_popup;
				$recruiter_email = $session->user_email;
				//echo $editor_email;
				$recruiter_profile_type=$pages->get($session->user_page_id)->recruiter_profile_type;
				if($recruiter_profile_type=="sub-recruiter"){
					$recruiter_page = $pages->get($session->user_page_id)->parent();
				}
				else{
					$recruiter_page=$pages->get($session->user_page_id);
				}

				$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$last_segment = basename($current_url);

					$pride_color_array = ['#e8272c', '#ef6623', '#fbdd0d', '#13a149', '#214897', '#824298'];
					$color_count = count($pride_color_array);
					$index=0;
				foreach($recruiter_page->recruiter_accessible_sections as $recruiter_accessible_section)
				{  
					$color_index = $index % $color_count;
					$color = $pride_color_array[$color_index];
					// Do something with the $color variable, such as print it or assign it to the section
					$index++;
					?>
				<!-- Nav Item - Tables -->
					<?php
						if($recruiter_accessible_section->name == "dashboard"){
							// echo $current_url;
							// echo "***";
							// echo $config->urls->httpRoot."resume/pc-recruiter/";
							if($current_url == $config->urls->httpRoot."resume/pc-recruiter/"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
						?>
						<!-- <style>
							li:hover {
						/* </style> */
								<?php
								// $text_color="#000";
								// $bg_color="background-color:$color";
								?>
						/* <style> */
							}
						</style> -->
					<?php
					?>

					<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/" style="<?=$text_color?>;">
						<!-- <i class='bx bx-tachometer'></i> -->
						<!-- <i class='bx bxs-dashboard'></i> -->
						<i class="fas fa-chart-line"></i>
						<!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
						<span class="features-item-text ">Dashboard</span>
						<!-- <span>Dashboard</span> -->
						</a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php

						}
						elseif($recruiter_accessible_section->name == "recruiter-candidate-table"){
							if($last_segment == "recruiter-candidate-table"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}

							?>
						<!-- <style>
							li:hover{
						</style>
								<?php
								// $text_color="#000";
								// $bg_color="background-color:$color";
								?>
						<style>
							}
						</style> -->
					<?php
					?>
					<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-candidate-table" style="<?=$text_color?>;">
						<!-- <i class="fas fa-fw fa-table"></i> -->
						<i class="fas fa-users"></i>
						<!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
						<span class="features-item-text ">Manage Candidates</span>
						<!-- <span>Dashboard</span> -->
						</a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php
						}
						elseif($recruiter_accessible_section->name == "recruiter-favourite-table"){
							if($last_segment == "recruiter-favourite-table"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
					?>
						<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-favourite-table" style="<?=$text_color?>;">
						<!-- <i class="[ fas fa-fw fa-check-circle ]"></i> -->
						<!-- <i class="fas fa-user-shield"></i> -->
						
						<i class="fas fa-user-check"></i>
						<!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
						<span class="features-item-text ">Favourite Profiles</span>
						<!-- <span>Dashboard</span> -->
						</a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php
						}
						elseif($recruiter_accessible_section->name == "recruiter-unlocked-table"){
							if($last_segment == "recruiter-unlocked-table"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
					?>
					<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-unlocked-table" style="<?=$text_color?>;">
						<i class="fas fa-unlock"></i>
						<!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
						<span class="features-item-text ">Unlocked Profiles</span>
						<!-- <span>Dashboard</span> -->
						</a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php
						}
						elseif($recruiter_accessible_section->name == "recruiter-export-table"){
							if($last_segment == "recruiter-export-table"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
					?>
					
					<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-export-table/" style="<?=$text_color?>;">
							<!-- <i class="[ fas fa-fw fa-arrow-circle-down ]"></i> -->
							<i class="fas fa-fw fa-table"></i>
							<span class="features-item-text ">Export Table</span></a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php
						} 
						elseif($recruiter_accessible_section->name == "recruiter-manage-jobs"){
							if($last_segment == "recruiter-manage-jobs"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
										//echo $sidebar_option->title;
										?>
					<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-manage-jobs/" style="<?=$text_color?>;">
							<!-- <i class="fas fa-fw fa-briefcase"></i> -->
							<i class="far fa-fw fa-newspaper"></i>
							<span class="features-item-text ">Manage Jobs</span></a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
					</style>
					<?php
						}
						elseif($recruiter_accessible_section->name == "recruiter-manage-sub-recruiter"){
							if($last_segment == "recruiter-manage-sub-recruiter"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							if($recruiter_profile_type=="super-recruiter"){
						?>
							<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
							<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-manage-sub-recruiter/" style="<?=$text_color?>;">
								<!-- <i class="fas fa-fw fa-users"></i> -->
								<!-- <i class="fas fa-users-viewfinder"></i> -->
								<i class="fas fa-fw fa-user-tag"></i>
								<span class="features-item-text ">Manage Sub Recruiter</span></a>
							</li>
						<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
						</style>
						<?php
							}
						}
						elseif($recruiter_accessible_section->name == "recruiter-company-profile"){
							if($last_segment == "recruiter-company-profile"){
								$active ="active";
								$bg_color="background-color:$color";
								$text_color="color:#000";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							else{
								$active ="";
								$bg_color="";
								$text_color="color:$color";
								$hover_color="background-color:$color";
								$hover_text_color="color:#000 !important";
							}
							if($recruiter_profile_type=="super-recruiter"){
						?>
							<li class="features-item <?=$recruiter_accessible_section->name?> <?=$active?>" style="<?=$bg_color?>">
							<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-recruiter/recruiter-company-profile/" style="<?=$text_color?>;">
							<i class="fas fa-fw fa-building"></i>
								<span class="features-item-text ">Company Profile</span></a>
							</li>
							<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.<?=$recruiter_accessible_section->name?>:hover {
								<?=$hover_color?>;
							}
							.features-item.<?=$recruiter_accessible_section->name?>:hover a{
								<?=$hover_text_color?>;
							}
							</style>
						<?php
							}
						}
						else{

						}
					}
						/**Add Recruiter panel demo video link */
					$recruiter_youtube_link_title=$pages->get('name=recruiters')->facebook_link;
					$recruiter_youtube_link=$pages->get('name=recruiters')->youtube_link;
					if($recruiter_youtube_link!=""){
						$text_color="color:#ef6623";
						$hover_color="background-color:#ef6623";
						$hover_text_color="color:#000 !important";
					?>
					<li class="features-item youtube_link">
						<a target="_blank" class="nav-link" href="<?=$recruiter_youtube_link?>" style="<?=$text_color?>">
						<i class="fab fa-fw fa-youtube"></i>
						<span class="features-item-text "><?=$recruiter_youtube_link_title?></span></a>
					</li>
					<style>
							/* Add hover style for the Dashboard menu option */
							.features-item.youtube_link:hover {
								<?=$hover_color?>;
							}
							.features-item.youtube_link:hover a{
								<?=$hover_text_color?>;
							}
							</style>
					<?php
					}	
				?>



			
		</ul>
	
	</div>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow header_navbar " style="">
					<!-- <a class="navbar-brand" href="#">
						<img src="path/to/your/logo.png" alt="Your logo">
					</a> -->
					<div class="logo-name">
						<?php
							$sidebar_logo=$pages->get('name=recruiters')->logo_images->first->httpUrl;
							// echo $sidebar_logo;
							// echo "***";
							$sidebar_logo_link=$pages->get('name=recruiters')->logo_images->first->description;
						?>
						<a target="_blank" href="<?=$sidebar_logo_link?>">
						<img
							src="<?=$sidebar_logo?>"
							class="logo sidebar_logo"
							alt="Pride Circle"
							srcset=""
						/>
						</a>
						<!-- <span class="logo-name__name">Lincoln Botosh</span> -->
					</div>
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Search -->
					<!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form> -->

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - Search Dropdown (Visible Only XS) -->
						<li class="nav-item dropdown no-arrow d-sm-none">
							<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-search fa-fw"></i>
							</a>
							<!-- Dropdown - Messages -->
							<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
								<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>

						<!-- Nav Item - Alerts -->
						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session->user_email."<br>".$session->user_designation?></span>
								<!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<!-- <a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
									Activity Log
								</a>
								<div class="dropdown-divider"></div> -->
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Logout Confirmation Modal-->
				<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								
								<a class="btn btn-primary" href="<?=$urls->httpRoot?>resume/pc-recruiter/recruiter-login/?recruiter_logout=true">Logout</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Logout Confirmation Modal END -->
	<!-- Offer popup code  -->
				<!-- Button trigger modal -->
				
				<div class="modal fade" id="offer_popup_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Offers Made</h5>
								<!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button> -->
							</div>
							<form id="candidate_offer_popup_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
								<div class="modal-body">
									<div class="row" style="">
											<div class="col-md-12">
													<div class="">
															<div class="[  ][ form-group ]">
															<?php
															if($session->recruiter_profile_type=="sub-recruiter"){
															?>
																<label for="offer_count">How many Offers have been made this week? (Please note that this cannot be double counted with the Super Recruiter's number) </label>
																<input id="offer_count" type="number" min="0" name="offer_count" type="text" class="form-control" required>
															<?php
															}
															else{
															?>
																<label for="offer_count">Offers This Week </label>
																<input id="offer_count" type="number" min="0" name="offer_count" type="text" class="form-control" required>
															<?php
															}
															?>
															</div>
													</div>
											</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> -->
									<button type="submit" id="btn_offer_submit" name="btn_offer_submit" class="btn btn-primary">Submit</button>
								</div>
							</form>  
						</div>
					</div>
				</div>
			
				<!-- Offer popup code End -->
			
			<script type="text/javascript">
				{
					let sideBar = document.querySelector('.side-bar');
					let arrowCollapse = document.querySelector('#logo-name__icon');
					let headerNav = document.querySelector('.header_navbar');
					// let dashboard = document.querySelector('.dashboard_cards_section');
					// let recruiter_datatable_section = document.querySelector('.recruiter_datatable_section');
					console.log(headerNav);
					console.log("7777");
					// sideBar.onclick = () => {
					// 	sideBar.classList.toggle('collapse');
					// 	arrowCollapse.classList.toggle('collapse');
					// 	if (arrowCollapse.classList.contains('collapse')) {
					// 		arrowCollapse.classList =
					// 			'bx bx-chevron-right logo-name__icon collapse';
					// 			// headerNav.style.marginLeft = '6.5rem';
					// 			// dashboard.style.marginLeft = '6.5rem';
					// 			// recruiter_datatable_section.style.marginLeft = '6.5rem';
					// 			// recruiter_datatable_section.style.width = '92%';
					// 	} else {
					// 		arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
					// 		// headerNav.style.marginLeft = '14.3rem';
					// 		// dashboard.style.marginLeft = '16rem';
					// 		// recruiter_datatable_section.style.marginLeft = '16rem';
					// 		// recruiter_datatable_section.style.width = 'calc(100% - 250px)';
					// 	}
					// };

					sideBar.onmouseover = () => {
							sideBar.classList.add('collapse');
							arrowCollapse.classList.add('collapse');
							arrowCollapse.classList = 'bx bx-chevron-right logo-name__icon collapse';
							// headerNav.style.marginLeft = '6.5rem';
							// dashboard.style.marginLeft = '6.5rem';
							// recruiter_datatable_section.style.marginLeft = '6.5rem';
							// recruiter_datatable_section.style.width = '92%';
					};

					sideBar.onmouseout = () => {
							sideBar.classList.remove('collapse');
							arrowCollapse.classList.remove('collapse');
							arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
							// headerNav.style.marginLeft = '14.3rem';
							// dashboard.style.marginLeft = '16rem';
							// recruiter_datatable_section.style.marginLeft = '16rem';
							// recruiter_datatable_section.style.width = 'calc(100% - 250px)';
					};
				}
			</script>
