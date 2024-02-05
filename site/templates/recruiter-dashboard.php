<?php
	require_once 'includes/recruiter-header.php';
?>
<style>
	.card_3d_effect {
  border: none;
  position: relative;
  overflow: hidden;
}

.card_3d_effect::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.2);
  transform-origin: left;
  transform: skewX(-30deg) translateX(-100%);
  transition: transform 0.5s;
}

.card_3d_effect:hover::before {
  transform: skewX(-30deg) translateX(0);
}

.i {
  transition: transform 0.5s;
}

.card_3d_effect:hover .i {
  transform: scale(1.1);
}

/**Soft pink */
.card_3d_effect_soft_pink:hover {
	background: rgb(19, 161, 73);
	background-color:#F5B7B1;
  /* transform: scale(1.05); */
}

.border_left_soft_pink{
	border-left: .25rem solid #F5B7B1 !important;
}
.text_soft_pink{
	color: #E87B70 !important;
} 
.card_3d_effect_soft_pink:hover .text_soft_pink {
	color:white;
	color: #5a5c69 !important;
}

/**Green Color */
.card_3d_effect_lightgreen:hover {
	background: rgb(19, 161, 73);
	background-color:#8AD99C;
  /* transform: scale(1.05); */
}

.border_left_lightgreen{
	border-left: .25rem solid #8AD99C !important;
}
.text_lightgreen{
	color: #59CA73 !important;
}  
.card_3d_effect_lightgreen:hover .text_lightgreen {
	color:white;
	color: #5a5c69 !important;
}

/**Baby blue AED6F1*/

.card_3d_effect_blue:hover {
	background: rgb(19, 161, 73);
	background-color:#8AC8F2;
  /* transform: scale(1.05); */
}
.border_left_blue{
	border-left: .25rem solid #8AC8F2 !important;
}
.text_blue{
	color: #8AC8F2 !important;
} 
.card_3d_effect_blue:hover .text_blue {
	color:white;
	color: #5a5c69 !important;
}

/**Lavender (#E6E6FA) */
.card_3d_effect_lavender:hover {
	background: rgb(19, 161, 73);
	background-color:#BCBCD5;
  /* transform: scale(1.05); */
}
.border_left_lavender{
	border-left: .25rem solid #BCBCD5 !important;
}
.text_lavender{
	color: #8D8DAC !important;
}  
.card_3d_effect_lavender:hover .text_lavender {
	color:white;
	color: #5a5c69 !important;
}

/** Peach (#FFE5B4) */
.card_3d_effect_peach:hover {
	background: rgb(19, 161, 73);
	background-color:#F2C46C;
  /* transform: scale(1.05); */
}
.border_left_peach{
	border-left: .25rem solid #F2C46C !important;
}
.text_peach{
	color: #D99107 !important;
} 
.card_3d_effect_peach:hover .text_peach{
	color:white;
	color: #5a5c69 !important;
}

/** Pale yellow (#FFFACD)*/
.card_3d_effect_pale_yellow:hover {
	background: rgb(19, 161, 73);
	background-color:#FBEE7A;
  /* transform: scale(1.05); */
}
.border_left_pale_yellow{
	border-left: .25rem solid #FBEE7A !important;
}
.text_pale_yellow{
	color: #F0D805  !important;
} 
.card_3d_effect_pale_yellow:hover .text_pale_yellow {
	color:white;
	color: #5a5c69 !important;
}

/** Light gray (#D3D3D3) */
.card_3d_effect_light_gray:hover {
	background: rgb(19, 161, 73);
	background-color:#C4B8B8;
  /* transform: scale(1.05); */
}
.border_left_light_gray{
	border-left: .25rem solid #C4B8B8 !important;
}
.text_light_gray{
	color: #918585 !important;
}
.card_3d_effect_light_gray:hover .text_light_gray {
	color:white;
	color: #5a5c69 !important;
}

/** Mint green (#98FF98) */
.card_3d_effect_mint_green:hover {
	background: rgb(19, 161, 73);
	background-color:#98FF98;
  /* transform: scale(1.05); */
}
.border_left_mint_green{
	border-left: .25rem solid #98FF98 !important;
}
.text_mint_green{
	color: #98FF98 !important;
}
.card_3d_effect_mint_green:hover .text_mint_green {
	color:white;
	color: #5a5c69 !important;
}

/** Pastel purple (#B19CD9) */
.card_3d_effect_pastel_purple:hover {
	background: rgb(19, 161, 73);
	background-color:#B19CD9;
  /* transform: scale(1.05); */
}
.border_left_pastel_purple{
	border-left: .25rem solid #B19CD9 !important;
}
.text_pastel_purple{
	color: #B19CD9 !important;
} 
.card_3d_effect_pastel_purple:hover .text_pastel_purple {
	color:white;
	color: #5a5c69 !important;
}
/** Coral (#FF7F50) */
.card_3d_effect_coral:hover {
	background: rgb(19, 161, 73);
	background-color:#FF7F50;
  /* transform: scale(1.05); */
	color: #5a5c69 !important;
}
.border_left_coral{
	border-left: .25rem solid #FF7F50 !important;
}
.text_coral{
	color: #FF7F50 !important;
} 

.card_3d_effect_coral:hover .text_coral {
	color:white;
	color: #5a5c69 !important;
}

/**Info Blue Color */

.card_3d_effect_info_color:hover {
	background: rgb(19, 161, 73);
	background-color:#36b9cc;
  /* transform: scale(1.05); */
}

.text_info_color{
	color: #36b9cc !important;
} 
.card_3d_effect_info_color:hover .text_info_color {
	color:white;
	color: #5a5c69 !important;
}

/**Primary Color */
.card_3d_effect_primary_color:hover {
	background: rgb(19, 161, 73);
	background-color:#4e73df;
	background-color:#4b70db;
  /* transform: scale(1.05);/ */
}

.text_primary{
	color: #4e73df !important;
	color: #4b70db !important;
} 
.card_3d_effect_primary_color:hover .text_primary{
	color:white;
	color: #5a5c69 !important;
}

/**Warning color */
.card_3d_effect_warning_color:hover {
	background: rgb(19, 161, 73);
	background-color:#f6c23e;
	background-color:#f7cc5f;
  /* transform: scale(1.05); */
}

.text_warning{
	color: #f6c23e !important;
	color: #f7cc5f !important;
} 
.card_3d_effect_warning_color:hover .text_warning{
	color:white;
	color: #5a5c69 !important;
}

.text-gray-300{
	color: #858796 !important;
}

</style>
				<!-- Begin Page Content -->
				<div class="container-fluid dashboard_cards_section">

					<!-- Page Heading -->
					<div class="mb-4">
						<h1 class="h3 mb-0 text-gray-800 text-center">Dashboard</h1>
					</div>

					<!-- Content Row -->
					<!-- Applicants cards -->
					<div class="card w-100 ">	
						<div class="card-body">
							<h3 class="card-title ">Your Applicants</h3>
							<div class="row">

								

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-favourite-table')->url?>" class="card border_left_soft_pink shadow h-100 py-2 card_3d_effect_soft_pink card_3d_effect">
									<!-- <div  class="card border_left_soft_pink shadow h-100 py-2 card_3d_effect_soft_pink card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2 ">
													<div class="text-xs font-weight-bold  text-uppercase mb-1 text_soft_pink">Your Favourites</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<?php 
														if(wire("session")->recruiter_profile_type=="sub-recruiter"){
															$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
														}
														else{
															$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
														}
														$favourite_profiles_array=Array();
														if($recruiter_page->favourite_profiles_array!=""){
															$favourite_profiles_object = json_decode($recruiter_page->favourite_profiles_array);
															if(!empty($favourite_profiles_object)){
																foreach($favourite_profiles_object as $single_favourite_profiles_object_array){
																	
																		foreach($single_favourite_profiles_object_array as $single_favourite_profile_array){
																			$favourite_profiles_array[]=$single_favourite_profile_array->candidate_profile_id;
																		}
																}
															}
															$favourite_profiles_count = sizeof($favourite_profiles_array);
															if($favourite_profiles_count!=0){
																echo $favourite_profiles_count;
															}
															else{
																echo '0';
															}
														}
														else{
															echo '0';
														}



															// if($recruiter_page->favourite_profiles_array!=""){
															// 	echo count(json_decode($recruiter_page->favourite_profiles_array));
															// }
															// else{
															// 	echo count(json_decode($recruiter_page->parent()->favourite_profiles_array));
															// }
															
														?>
														</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-heart fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<?php 
								if(wire("session")->recruiter_profile_type=="sub-recruiter"){
									$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
								}
								else{
									$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
								}
								if(($recruiter_page->total_unlock_quota != 0) && ($recruiter_page->main_unlock_quota != 0) || ($recruiter_page->applicants_unlock_quota != 0)){
								?>
								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_coral shadow h-100 py-2 card_3d_effect_coral card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_coral">Total Unlock Quota</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															
															$common_unlock_quota=$recruiter_page->total_unlock_quota;
															if($common_unlock_quota!=0){
																echo $common_unlock_quota;
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_blue shadow h-100 py-2 card_3d_effect_blue card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_blue">Total Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															// echo $recruiter_page->id;
															// echo "***";

															$unlocked_profiles_array=Array();
															if($recruiter_page->unlocked_profiles_array!=""){
																$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
																if(!empty($unlocked_profiles_object)){
																	// print_r($unlocked_profiles_object);
																	// echo "****";
																	foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
																		
																			foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
																				$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
																			}
																	}
																}
															
																$unlocked_profiles_count = sizeof($unlocked_profiles_array);
																// echo $unlocked_profiles_count;
																$common_unlock_quota=$recruiter_page->total_unlock_quota;

																if($unlocked_profiles_count!=""){
																	echo $unlocked_profiles_count;
																	// echo "if";

																}
																else{
																	echo $common_unlock_quota;
																	// echo "else";
																}
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_lightgreen">General Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															// echo $recruiter_page->id;
															// echo "***";

															$unlocked_profiles_array=Array();
															if($recruiter_page->unlocked_profiles_array!=""){
																$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
																if(!empty($unlocked_profiles_object)){
																	// print_r($unlocked_profiles_object);
																	// echo "****";
																	foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
																		
																			foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
																				$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
																			}
																	}
																}
															
																$unlocked_profiles_count = sizeof($unlocked_profiles_array);
																// echo $unlocked_profiles_count;
																$applicants_unlock_counter=$recruiter_page->applicant_unlock_counter;
																// echo "applicants";
																// echo $applicants_unlock_counter;
																if($applicants_unlock_counter!=""){
																	echo $unlocked_profiles_count-$applicants_unlock_counter;
																// 	// echo "if";

																}
																else{
																	echo $unlocked_profiles_count;
																	// echo "else";
																}
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<div  class="card border_left_blue shadow h-100 py-2 card_3d_effect_blue card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold  text-uppercase mb-1 text_blue">Remaining General Unlocks</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?php
												
													/* Comments added by Amrut Todkar 2021-05-01  */
													if(wire("session")->recruiter_profile_type=="sub-recruiter"){
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
													}
													else{
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
													}
													if($recruiter_page->unlocked_profiles_array!=""){
														// echo "111";
														if($recruiter_page->unlocked_profiles_array!="" && $recruiter_page->candidates_who_applied_for_job!=""){
															// echo "121";
																if($recruiter_page->applicant_unlock_counter=="" || $recruiter_page->applicant_unlock_counter==0){
																	$recruiter_page->applicant_unlock_counter=0;
																	// echo "131";
																}
																$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
																$unlocked_profiles_array=Array();
																if(!empty($unlocked_profiles_object)){
																	foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
																		foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
																			$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
																		}
																	}
																}
																// echo $recruiter_page->unlock_quota;
																// echo "**";
																// echo sizeof($unlocked_profiles_array);
																// echo "--";
																// echo ($recruiter_page->applicant_unlock_counter);
																// echo "++";
																// if($recruiter_page->unlock_quota - ((sizeof($unlocked_profiles_array))-($recruiter_page->applicant_unlock_counter)) > 0){
																if($recruiter_page->unlock_quota > 0){
																	// echo "+2222222+";
																	// echo $recruiter_page->unlock_quota - ((sizeof($unlocked_profiles_array))-($recruiter_page->applicant_unlock_counter));
																	echo $recruiter_page->unlock_quota;
																	// echo "141";
																}
																else{
																	// echo "*5555*";
																	echo "0";
																	// echo "151";
																}
																// echo "161";
														}
														else{
															if($recruiter_page->unlock_quota!=""){
																// echo "---7777---";
																echo $recruiter_page->unlock_quota;
															}
															else{
																// echo "/4444-";
																echo "0";
															}
															// echo "/4444-";
															
														}
													}
													else{
														if($recruiter_page->unlock_quota!=""){
															// echo "---7777---";
															echo $recruiter_page->unlock_quota;
														}
														else{
															// echo "/4444-";
															echo "0";
														}
													}
													
													?>
														
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-lock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_lavender shadow h-100 py-2 card_3d_effect_lavender card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_lavender">Applicants Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															if($recruiter_page->applicant_unlock_counter!=""){
																// echo "***";
																// if(($recruiter_page->applicants_unlock_quota-$recruiter_page->applicant_unlock_counter) > 0){
																	// echo "----";
																	echo abs($recruiter_page->applicant_unlock_counter);
																// }
																// else{
																// 	// echo "+++";
																// 	echo $recruiter_page->applicants_unlock_quota;
																// }
																
															}
															else{
																echo "0";
															}
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<div  class="card border_left_peach shadow h-100 py-2 card_3d_effect_peach card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text_peach">Remaining Applicants Unlocks</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?php
												
													if(wire("session")->recruiter_profile_type=="sub-recruiter"){
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
													}
													else{
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
													}
													if($recruiter_page->applicants_unlock_quota!=""){

														if($recruiter_page->applicant_unlock_counter==""){
															$recruiter_page->applicant_unlock_counter=0;
														}
														// echo "111";
														// echo $recruiter_page->unlock_quota - count(json_decode($recruiter_page->unlocked_profiles_array))+count(json_decode($recruiter_page->candidates_who_applied_for_job));
															if($recruiter_page->applicants_unlock_quota - ($recruiter_page->applicant_unlock_counter) > 0){
																	//echo "2222222";
																echo $recruiter_page->applicants_unlock_quota - ($recruiter_page->applicant_unlock_counter);
															}
															else{
																echo "0";
															}
													}
													else{
														echo "0";
													}
													?>
														
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-lock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php
									}
									else{
								?>
								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_lightgreen">Total Unlock Quota</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															
															$common_unlock_quota=$recruiter_page->total_unlock_quota;
															if($common_unlock_quota!=0){
																echo $common_unlock_quota;
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_blue shadow h-100 py-2 card_3d_effect_blue card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_blue">Total Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															// echo $recruiter_page->id;
															// echo "***";

															$unlocked_profiles_array=Array();
															if($recruiter_page->unlocked_profiles_array!=""){
																$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
																if(!empty($unlocked_profiles_object)){
																	// print_r($unlocked_profiles_object);
																	// echo "****";
																	foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
																		
																			foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
																				$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
																			}
																	}
																}
															
																$unlocked_profiles_count = sizeof($unlocked_profiles_array);
																// echo $unlocked_profiles_count;
																$common_unlock_quota=$recruiter_page->total_unlock_quota;

																if($unlocked_profiles_count!=""){
																	echo $unlocked_profiles_count;
																	// echo "if";

																}
																else{
																	echo $common_unlock_quota;
																	// echo "else";
																}
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_lavender shadow h-100 py-2 card_3d_effect_lavender card_3d_effect">
									<!-- <div class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect"> -->
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-info text-uppercase mb-1 text_lavender">General Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
														//	count(json_decode($recruiter_page->unlocked_profiles_array) );
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															// echo $recruiter_page->id;
															// echo "***";

															$unlocked_profiles_array=Array();
															if($recruiter_page->unlocked_profiles_array!=""){
																$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
																if(!empty($unlocked_profiles_object)){
																	// print_r($unlocked_profiles_object);
																	// echo "****";
																	foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
																		
																			foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
																				$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
																			}
																	}
																}
															
																$unlocked_profiles_count = sizeof($unlocked_profiles_array);
																// echo $unlocked_profiles_count;
																$applicants_unlock_counter=$recruiter_page->applicant_unlock_counter;
																// echo "applicants";
																// echo $applicants_unlock_counter;
																if($applicants_unlock_counter!=""){
																	echo $unlocked_profiles_count-$applicants_unlock_counter;
																// 	// echo "if";

																}
																else{
																	echo $unlocked_profiles_count;
																	// echo "else";
																}
															}
															else{
																echo "0";
															}
														
															
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									<!-- </div> -->
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-unlocked-table')->url?>" class="card border_left_peach shadow h-100 py-2 card_3d_effect_peach card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
												  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text_peach">Applicants Unlocked</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
															
															<?php
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															if($recruiter_page->applicant_unlock_counter!=""){
																// echo "***";
																// if(($recruiter_page->applicants_unlock_quota-$recruiter_page->applicant_unlock_counter) > 0){
																	// echo "----";
																	echo abs($recruiter_page->applicant_unlock_counter);
																// }
																// else{
																// 	// echo "+++";
																// 	echo $recruiter_page->applicants_unlock_quota;
																// }
																
															}
															else{
																echo "0";
															}
															
														?></div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-unlock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<div  class="card border_left_pastel_purple shadow h-100 py-2 card_3d_effect_pastel_purple card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold  text-uppercase mb-1 text_pastel_purple">Remaining Common Unlocks</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?php
												
													/* Comments added by Amrut Todkar 2021-05-01  */
													if(wire("session")->recruiter_profile_type=="sub-recruiter"){
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
													}
													else{
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
													}

													if($recruiter_page->available_total_unlock_quota!=""){
														// echo "---7777---";
														echo $recruiter_page->available_total_unlock_quota;
													}
													else{
														// echo "/4444-";
														echo "0";
													}

													// if($recruiter_page->unlocked_profiles_array!=""){
													// 	// echo "111";
													// 	if($recruiter_page->unlocked_profiles_array!="" && $recruiter_page->candidates_who_applied_for_job!=""){
															
													// 			$unlocked_profiles_object = json_decode($recruiter_page->unlocked_profiles_array);
													// 			$unlocked_profiles_array=Array();
													// 			if(!empty($unlocked_profiles_object)){
													// 				foreach($unlocked_profiles_object as $single_unlocked_profiles_object_array){
													// 					foreach($single_unlocked_profiles_object_array as $single_unlocked_profile_array){
													// 						$unlocked_profiles_array[]=$single_unlocked_profile_array->candidate_profile_id;
													// 					}
													// 				}
													// 			}
													// 			// echo $recruiter_page->unlock_quota;
													// 			// echo "**";
													// 			// echo sizeof($unlocked_profiles_array);
													// 			// echo "--";
													// 			// echo ($recruiter_page->applicant_unlock_counter);
													// 			// echo "++";
													// 			if($recruiter_page->available_total_unlock_quota > 0){
													// 				// echo "+2222222+";
													// 				echo $recruiter_page->available_total_unlock_quota;
													// 				// echo "141";
													// 			}
													// 			else{
													// 				// echo "*5555*";
													// 				echo "0";
													// 				// echo "151";
													// 			}
													// 			// echo "161";
													// 	}
													// 	else{
													// 		if($recruiter_page->available_total_unlock_quota!=""){
													// 			// echo "---7777---";
													// 			echo $recruiter_page->available_total_unlock_quota;
													// 		}
													// 		else{
													// 			// echo "/4444-";
													// 			echo "0";
													// 		}
													// 		// echo "/4444-";
															
													// 	}
													// }
													// else{
													// 	if($recruiter_page->unlock_quota!=""){
													// 		// echo "---7777---";
													// 		echo $recruiter_page->unlock_quota;
													// 	}
													// 	else{
													// 		// echo "/4444-";
													// 		echo "0";
													// 	}
													// }
													
													?>
														
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-lock fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php
									}
								?>
								
								<!-- Pending Requests Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<div class="card border_left_pale_yellow shadow h-100 py-2 card_3d_effect_pale_yellow card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_pale_yellow">Subscription Until</div>
														<div class="h5 mb-0 font-weight-bold text-gray-800">
															<?php
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
																if($recruiter_page->subscription_to!=""){
																	echo date("d M Y", $recruiter_page->subscription_to);
																}
																else{
																	echo date("d M Y", $recruiter_page->parent()->subscription_to);
																}
															
															?>
														</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Subscription until days -->
								<div class="col-xl-3 col-md-6 mb-4">
									<div class="card border_left_light_gray shadow h-100 py-2 card_3d_effect_light_gray card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_light_gray">Remaining Subscription Days</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<?php
															// echo date("d M Y");
															// echo "***********";
															// echo date("d M Y", $recruiter_page->subscription_to);
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
															}
															if($recruiter_page->subscription_to!=""){
																$current_date=strtotime(date("Y-m-d"));
																$subscription_deadline=strtotime(date("Y-m-d", $recruiter_page->subscription_to+60*60*5.50));
																$difference=($subscription_deadline-$current_date);
																$remaining_days=round((($difference/24)/60)/60)+1;
																if($remaining_days>0){
																	echo $remaining_days." days";
																}
																else{
																	echo "0 days";
																}
															}
															else{
																	echo "0 days";
															}
															
														?>
														
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-calendar-day fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

					<!-- Job cards -->
					<div class="card w-100 ">	
						<div class="card-body">
							<h3 class="card-title">Your Jobs</h3>
							<div class="row ">
								
								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-jobs')->url?>" class="card border_left_pastel_purple shadow h-100 py-2 card_3d_effect_pastel_purple card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold  text-uppercase mb-1 text_pastel_purple">Total Jobs</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<?php
														if(wire("session")->recruiter_profile_type=="sub-recruiter"){
															$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
														}
														else{
															$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
														}
														// echo $pages->get("name=jobs")->numChildren("job_added_by=".$recruiter_page->id);
														$job_posted_count=0;
														$total_job_posted_count=0;
														$job_posted_count=$pages->get("name=jobs")->children("job_added_by=".$recruiter_page->id)->count();
														foreach($recruiter_page->children() as $single_page){
															$sub_recruiter_job_posted_count=$pages->get("name=jobs")->children("job_added_by=".$single_page->id)->count();
															$total_job_posted_count=$total_job_posted_count+$sub_recruiter_job_posted_count;
														}
														$job_posted_count+=$total_job_posted_count;
														echo $job_posted_count;
														?>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-jobs')->url?>" class="card border_left_coral shadow h-100 py-2 card_3d_effect_coral card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_coral">
														Live Jobs
													</div> 
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<?php  
																$i=0;
																//suggestion by Amruta jagatap 2021-03-05 10.35pm for display count of job which is live on site
																//$pages->get("name=jobs")->Children("verification=verified,active_status=active,job_publish_shedule>time()")->count();
																$recruiter_page_array=array();
																if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
																	$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
																}
																else{
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
																	$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
																}
																
																foreach($recruiter_page_array as $recruiter_page_id)
																foreach($pages->get("name=jobs")->Children("job_added_by=".$recruiter_page_id) as $single_job)
																	if($single_job->application_deadline>time()&&$single_job->active_status=="active")
																		$i++;
																	
																echo $i;
														?>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-jobs')->url?>"  class="card border_left_soft_pink shadow h-100 py-2 card_3d_effect_soft_pink card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_soft_pink">Remaining Jobs</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?php
													if(wire("session")->recruiter_profile_type=="sub-recruiter"){
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
													}
													else{
														$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
													}
														if($recruiter_page->job_limit!=""){
															echo ($recruiter_page->job_limit);
														}
														else{
															echo "0";
														}
															
													
													?>
														
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-clipboard fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-jobs')->url?>" class="card border_left_lightgreen shadow h-100 py-2 card_3d_effect_lightgreen card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_lightgreen">Draft jobs</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
																<?php
																$recruiter_page_array=array();
																if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
																	$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
																}
																else{
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
																	$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
																}
																	$i=0;
																	foreach($recruiter_page_array as $recruiter_page_id)
																	foreach($pages->get("name=jobs")->children("job_added_by=".$recruiter_page_id) as $single_job)
																		if($single_job->application_deadline<time()||$single_job->active_status=="inactive")
																			$i++;
																	echo $i;
																?>
															</div>
														</div>
														<div class="col">
															<!-- <div class="progress progress-sm mr-2">
																<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
														</div>
													</div>
													</div>
													<div class="col-auto">
														<i class="far fa-calendar-times fa-2x text-gray-300"></i>
													</div>
											</div>
										</div>
									</a>
								</div>

								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-jobs')->url?>"  class="card border_left_blue shadow h-100 py-2 card_3d_effect_blue card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_blue">Applicants</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<?php
															$job_code_array=array();
															$recruiter_page_array=array();
															//echo "////////////";
															//echo $session->user_page_id;
															if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
																$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
															}
															else{
																$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
																$recruiter_page_array[].=$recruiter_page->id;
																	foreach(wire("pages")->get("id=".$recruiter_page->id)->children("recruiter_profile_type=sub-recruiter") as $sub_recruiter_page){
																		$recruiter_page_array[].=$sub_recruiter_page->id;
																	}
															}
															$job_added_by_data=implode("|",array_unique($recruiter_page_array));
															echo "<!-- ".json_encode($recruiter_page_array)." -->";
															echo "<!--dd-- ".$job_added_by_data." -->";
															foreach($recruiter_page_array as $recruiter_page_id){
																foreach($pages->get("name=jobs")->children("job_added_by*=".$job_added_by_data) as $single_job){
																	// echo $single_job;
																	// echo "*********";
																	$job_code_array[]=$single_job->job_code;
																}
															}
															echo "<!-- ".json_encode($job_code_array)." -->";
															$job_code_data_1="\"".implode("\"|\"",array_unique($job_code_array))."\"";
															$job_code_data=implode("|",array_unique($job_code_array));
															// echo "+++++++++++++";
															// echo $job_code_data;
															$final_count=0;

															foreach(array_unique($job_code_array) as $single_job){
																$count=count($pages->get("name=candidates")->children("job_code*=".$single_job));
																$final_count=$final_count+$count;
															}
															echo $final_count;
															echo "foreach";
															if($job_code_data!=""){
															
																echo count($pages->get("name=candidates")->children("job_code*=".$job_code_data));
																// echo "<!-- *** -->";
																// echo count($pages->get("name=candidates")->children("candidate_applied_jobs*=".$job_code_data_1));
																// echo "<!-- ".count($pages->get("name=candidates")->children("candidate_applied_jobs*=".$job_code_data_1))."-->";
															}
															else{
																echo "0";
															}
														?>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-user-friends fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>


							</div>
						</div>	
					</div>

					
						<!-- Content Row -->
					<?php
					if(wire("session")->recruiter_profile_type!="sub-recruiter"){
					?>
					<div class="card w-100 m-10">	
						<div class="card-body">
							<h3 class="card-title ">Sub Recruiters</h3>
							<div class="row d-flex">
					
								<!-- Earnings (Monthly) Card Example -->
								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-sub-recruiter')->url?>"  class="card border_left_lavender shadow h-100 py-2 card_3d_effect_lavender card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-uppercase mb-1 text_lavender">Total Sub Recruiters</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
																<?php
																if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
																}
																else{
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
																}
																echo $recruiter_page->children("recruiter_profile_type=sub-recruiter")->count();
																?>
															</div>
														</div>
														<div class="col">
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-user-friends fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>

								<div class="col-xl-3 col-md-6 mb-4">
									<a href="<?=$pages->get('name=recruiter-manage-sub-recruiter')->url?>" class="card border_left_peach shadow h-100 py-2 card_3d_effect_peach card_3d_effect">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-success text-uppercase mb-1 text_peach">Remaining Sub Recruiters Quota</div>
													<div class="row no-gutters align-items-center">
														<div class="col-auto">
															<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
																<?php 
																if(wire("session")->recruiter_profile_type=="sub-recruiter"){
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id)->parent();
																}
																else{
																	$recruiter_page = $pages->get("id=".wire("session")->user_page_id);
																}
																$sub_recruiter_count=$recruiter_page->children("recruiter_profile_type=sub-recruiter")->count();
																if($recruiter_page->sub_recruiter_quota!=0){
																	echo ($recruiter_page->sub_recruiter_quota)-($sub_recruiter_count);
																}
																else{
																	echo "0";
																}
																?>
															</div>
														</div>
														<div class="col">
														</div>
													</div>
												</div>
												<div class="col-auto">
													<i class="fas fa-user-friends fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</a>
								</div>
								

							</div>
						</div>	
					</div>		
					<?php
					}
					?>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Pride Circle <?php $year = date("Y"); echo $year;?></span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Logout Modal-->
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
					<a class="btn btn-primary" href="<?=$pages->get("name=recruiter-login")->httpUrl?>?recruiter_logout=true">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?=$rootpath?>scripts/chart.min.js"></script>

	<script type="text/javascript">
				{
					let sideBar = document.querySelector('.side-bar');
					let arrowCollapse = document.querySelector('#logo-name__icon');
					let headerNav = document.querySelector('.header_navbar');
					let dashboard = document.querySelector('.dashboard_cards_section');
					let sticky_footer = document.querySelector('.sticky-footer');
					console.log(dashboard);
					console.log("ghghgh");
					// sideBar.onclick = () => {
					// 	sideBar.classList.toggle('collapse');
					// 	arrowCollapse.classList.toggle('collapse');
					// 	if (arrowCollapse.classList.contains('collapse')) {
					// 		arrowCollapse.classList =
					// 			'bx bx-chevron-right logo-name__icon collapse';
					// 			// headerNav.style.marginLeft = '6.5rem';
					// 			dashboard.style.margin = '0px 70px 50px 10px';
					// 			dashboard.style.width = 'calc(100% - 8px)';
					// 			// sticky_footer.style.marginLeft = '6.3rem';
					// 	} else {
					// 		arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
					// 		// headerNav.style.marginLeft = '14.3rem';
					// 		dashboard.style.margin = '0px 70px 50px 10px';
					// 		dashboard.style.width = 'calc(100% - 8px)';
					// 		// sticky_footer.style.marginLeft = '14.3rem';
					// 	}
					// };
					sideBar.onmouseover = () => {
							sideBar.classList.add('collapse');
							arrowCollapse.classList.add('collapse');
							arrowCollapse.classList = 'bx bx-chevron-right logo-name__icon collapse';
							dashboard.style.margin = '83px 70px 50px 90px';
							dashboard.style.width = 'calc(100% - 80px)';
					};

					sideBar.onmouseout = () => {
							sideBar.classList.remove('collapse');
							arrowCollapse.classList.remove('collapse');
							arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
							dashboard.style.margin = '83px 70px 50px 90px';
							dashboard.style.width = 'calc(100% - 80px)';
					};
				}
	</script>

</body>
</html>