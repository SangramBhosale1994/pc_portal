<?php
error_reporting(E_ERROR);
 require_once(\ProcessWire\wire('files')->compile('includes/editor-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

	/* Candidate City, Industry Pie Chart Data */
	$city_array = array();
	$industry_array = array();
	$functional_area_array = array();
	$identify_as_array = array();
	$experience_array = array();
	$age_array = array();

	$candidate_page_array = $pages->get("name=candidates")->children();

	foreach ($candidate_page_array as $key => $value) {
		if(isset($city_array[addslashes(trim($value->current_city))])){
			$city_array[addslashes(trim($value->current_city))]++;
		}
		else{
			$city_array[addslashes(trim($value->current_city))] = 1;
		}

		if(isset($industry_array[addslashes($value->industry)])){
			$industry_array[addslashes($value->industry)]++;
		}
		else{
			$industry_array[addslashes($value->industry)] = 1;
		}

		if(isset($functional_area_array[addslashes($value->functional_area)])){
			$functional_area_array[addslashes($value->functional_area)]++;
		}
		else{
			$functional_area_array[addslashes($value->functional_area)] = 1;
		}

		if(isset($identify_as_array[addslashes($value->identify_as)])){
			$identify_as_array[addslashes($value->identify_as)]++;
		}
		else{
			$identify_as_array[addslashes($value->identify_as)] = 1;
		}

		if(isset($experience_array[addslashes(intval($value->experience_years))+0])){
			$experience_array[addslashes(intval($value->experience_years))+0]++;
		}
		else{
			$experience_array[addslashes(intval($value->experience_years))+0] = 1;
		}


		$today = date("Y-m-d");
		$the_dob = date('Y-m-d', intval($value->date_of_birth));
		$diff = date_diff(date_create($the_dob), date_create($today));
		$candidate_age = $diff->format('%y');

		if(isset($age_array[$candidate_age])){
			$age_array[$candidate_age]++;
		}
		else{
			$age_array[$candidate_age] = 1;
		}
	}

	arsort($city_array);
	arsort($industry_array);
	arsort($identify_as_array);
	arsort($functional_area_array);
	//$experience_array = array_flip($experience_array);
	ksort($experience_array);
	//$experience_array = array_flip($experience_array);
	ksort($age_array);

	$city_name_string = "";
	$industry_name_string = "";
	$functional_area_name_string = "";
	$identify_as_name_string = "";
	$experience_name_string = "";
	$age_name_string = "";

	foreach ($city_array as $key => $value) {
		$city_name_string.= "'". $key."',";
	}

	$city_count_string = "'". implode("','", $city_array) ."'";

	foreach ($industry_array as $key => $value) {
		$industry_name_string.= "'". $key."',";
	}

	$industry_count_string = "'". implode("','", $industry_array) ."'";

	foreach ($functional_area_array as $key => $value) {
		$functional_area_name_string.= "'". $key."',";
	}

	$functional_area_count_string = "'". implode("','", $functional_area_array) ."'";

	foreach ($identify_as_array as $key => $value) {
		$identify_as_name_string.= "'". $key."',";
	}

	$identify_as_count_string = "'". implode("','", $identify_as_array) ."'";

	foreach ($experience_array as $key => $value) {
		$experience_name_string.= "'". $key."',";
	}

	$experience_count_string = "'". implode("','", $experience_array) ."'";

	foreach ($age_array as $key => $value) {
		$age_name_string.= "'". $key."',";
	}

	$age_count_string = "'". implode("','", $age_array) ."'";
	/* Candidate City, Industry Pie Chart Data End */

	/* Time calculation Function */
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	/* Time calculation Function End */

?>
				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="mb-4">
						<h1 class="h3 mb-0 text-gray-800 text-center">Dashboard</h1>
					</div>

					<!-- Content Row -->
					<!-- <div class="row"> -->

						<!-- Earnings (Monthly) Card Example -->
						<!-- <div class="col-xl-3 col-md-6 mb-4">
							<a href="<?=$pages->get('name=editor-candidate-table')->url?>" class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Applications</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->numChildren()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</a>
						</div> -->

						<!-- Earnings (Monthly) Card Example -->
						<!-- <div class="col-xl-3 col-md-6 mb-4">
							<a href="<?=$pages->get('name=editor-candidate-table')->url?>" class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Applications Today</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													$yesterday_timestamp = date("U", strtotime('-24 hours', time()));
													echo $pages->get("name=candidates")->numChildren("created>".$yesterday_timestamp);
												?>
												</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-calendar fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</a>
						</div> -->

						<!-- Earnings (Monthly) Card Example -->
						<!-- <div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Applicants from</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=sizeof($city_array)?> Cities</div>
												</div>
												<div class="col"> -->
													<!-- <div class="progress progress-sm mr-2">
														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div> -->
												<!-- </div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<!-- Pending Requests Card Example -->
						 <!-- <div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Latest Entry</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=time_elapsed_string("@".$pages->get("name=candidates")->child("sort=-created")->created)?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-clock fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
			<?php
			foreach($editor_page->accessible_sections as $editor_accessible_section)
			{ 
				if($editor_accessible_section->name == "manage-candidates"){
					
					?>

			<div class="card w-100">	
				<div class="card-body">
					<h3 class="card-title ">All Applicants</h3>
					<div class="row ">
					
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Applications</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->numChildren()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
												Applications Today
											</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													/**display total applicatants count is calculate after 24 hours */
													$yesterday_timestamp = date("U", strtotime('-24 hours', time()));
													/**Get today's midnight timestamp and check candidate profile registration timestamp is greater that midnight timestamp  */
													$midnight_timestamp=strtotime('today midnight',time()) - 60*60*5.50;
													echo $pages->get("name=candidates")->numChildren("created>".$midnight_timestamp);
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

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Applicants from</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=sizeof($city_array)?> Cities</div>
												</div>
												<div class="col">
													<!-- <div class="progress progress-sm mr-2">
														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div> -->
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">LGBT+ Unverified</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->numchildren("lgbtq_verification=Unchecked")?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-window-close fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-danger shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">No Resume</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->children("resume=,active_status=Active")->count()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-upload fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-secondary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Active Candidates</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->children("active_status=Active")->count()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-check-circle fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>	
			</div>


			<div class="card w-100">	
				<div class="card-body">
					<h3 class="card-title ">Your Applicants</h3>
					<div class="row ">

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div  class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Your Favourites</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?= count(json_decode($pages->get($session->user_page_id)->favourite_profiles_array));
												?>
												</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-heart fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unlocked</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
													
													<?php
												//	count(json_decode($pages->get($session->user_page_id)->unlocked_profiles_array) );
												$unlocked_candidate_array=array();
												$unlocked_profiles_array=json_decode($pages->get($session->user_page_id)->unlocked_profiles_array) ;
													$counter=0;
													foreach ($unlocked_profiles_array as $candidate_page_id=>$timestamp) {
														// $unlocked_candidate_array[]=$candidate_page_id;
														// foreach($unlocked_candidate_array as $candidate_id){
															$candidate_page = \ProcessWire\wire("pages")->get("name=candidates")->child("id=".$candidate_page_id);
															if($candidate_page->id!=0){
																	$counter++;
															}
														// }
														
													}
													echo $counter;
													
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
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div  class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Remaining Unlocks</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php
										
											/* Comments added by Amrut Todkar 2021-05-01  */
											if($pages->get($session->user_page_id)->unlocked_profiles_array!="" ){
												// echo "111";
												// echo $pages->get($session->user_page_id)->unlock_quota - count(json_decode($pages->get($session->user_page_id)->unlocked_profiles_array))+count(json_decode($pages->get($session->user_page_id)->candidates_who_applied_for_job));
													if($pages->get($session->user_page_id)->unlock_quota - count((array)json_decode($pages->get($session->user_page_id)->unlocked_profiles_array)) > 0){
															//echo "2222222";
														echo $pages->get($session->user_page_id)->unlock_quota - count((array)json_decode($pages->get($session->user_page_id)->unlocked_profiles_array));
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
					

					</div>
				</div>	
			</div>
			<?php
						}
					elseif($editor_accessible_section->name == "editor-manage-jobs"){
					
			?>
			<!-- Content Row -->
					
			<div class="card w-100 ">	
				<div class="card-body">
					<h3 class="card-title">Jobs</h3>
					<div class="row ">
						
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jobs</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=jobs")->numChildren()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-briefcase fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
												Live on Site
											</div> 
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php  
														$i=0;
														//suggestion by Amruta jagatap 2021-03-05 10.35pm for display count of job which is live on site
														//$pages->get("name=jobs")->Children("verification=verified,active_status=active,job_publish_shedule>time()")->count();
														foreach($pages->get("name=jobs")->Children() as $single_job)
															if($single_job->verification=="verified"&&$single_job->active_status=="active")
																$i++;
														echo $i;
												?>
											</div>
										</div>
										<div class="col-auto">
											<i class="far fa-calendar-check fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">scheduled jobs</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
														<?php
															$i=0;
															foreach($pages->get("name=jobs")->Children() as $single_job)
																if($single_job->job_publish_shedule>time())
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
												<i class="far fa-clock fa-2x text-gray-300"></i>
											</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div  class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unverified Jobs</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?=count($pages->get("name=jobs")->children("verification=unverified|"));?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-window-close fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>	
			</div>

			<?php
					}
					elseif($editor_accessible_section->name == "editor-manage-recruiters"){
					
			?>
						<!-- Content Row -->
			<div class="card w-100 m-10">	
				<div class="card-body">
					<h3 class="card-title ">Recruiters</h3>
					<div class="row d-flex">
			
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Recruiters</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$pages->get("name=recruiters")->numChildren()?></div>
												</div>
												<div class="col">
													<!-- <div class="progress progress-sm mr-2">
														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div> -->
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jobs by recruiters</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
														<?php
															$i=0;
															foreach($pages->get("name=jobs")->children("job_added_by!=") as $single_jobpage)
															{
																$added_by_id = $single_jobpage->job_added_by;
																$added_by_parent_page=$pages->get("id=".$added_by_id)->parent();
																$recruiters_page=$pages->get("name=recruiters")->id;
																if($added_by_parent_page->id==$recruiters_page)	
																		$i++;
															}
															echo $i;
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-check-circle fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>	
			</div>	
			<?php
					}
					elseif($editor_accessible_section->name == "editor-referrer-data"){
					
			?>		

			<!-- Content Row -->			
			
			<div class="card w-100">	
				<div class="card-body">
					<h3 class="card-title">TAG</h3>
					<div class="row">
						
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Referrers</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=referral-profiles")->numChildren()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

							<!-- Todays referrer registratin -->
							<div class="col-xl-3 col-md-6 mb-4">
							<a href="<?=$pages->get('name=referrer-data')->url?>" class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Referrers</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
												$midnight_timestamp=strtotime('today midnight',time()) - 60*60*5.50;
												echo $pages->get("name=referral-profiles")->children("created>".$midnight_timestamp)->count();
												?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-calendar-day fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<!-- Todays applicants registration using referrer -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today's Referred candidates	</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													$midnight_timestamp=strtotime('today midnight',time()) - 60*60*5.50;
													echo $pages->get("name=candidates")->children("referrer_page_id!=,created>".$midnight_timestamp)->count();
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

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Referred candidates	</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->children("referrer_page_id!=")->count()?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-users fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- LGBT referrers -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div  class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
												LGBT+ Referrers
											</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
												$i=0;
													foreach($pages->get("name=referral-profiles")->children() as $referrer_page){
														$referrer_profile_detail_id=$referrer_page->referrer_profile_id;
														$profile_page=$pages->get("name=universal-profiles")->child("id=".$referrer_profile_detail_id.",identify_as=LGBT+");
														if($profile_page->id!=0){
															// echo $profile_page->id;
															// echo "***";
															$i++;
														}
														
													};
														echo $i;
												?>
											</div>
										</div>
										<div class="col-auto">
												<i class="fas fa-check-circle fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>


						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<a href="<?=$pages->get('name=admin-manage-jobs')->url?>" class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
												Verified
											</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pages->get("name=candidates")->children("lgbtq_verification=Confirmed,referrer_page_id!=")->count()?></div>
										</div>
										<div class="col-auto">
												<i class="fas fa-user-check fa-2x text-gray-300"></i>
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
					else{}
			}
					
			?>

					<!-- Content Row -->

					<!-- <div class="row"> -->
						<!-- Pie Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4"> -->
								<!-- Card Header - Dropdown -->
								<!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Applicant Cities</h6>
									<a id="download_myPieChart" download="City_Chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div> -->
								<!-- Card Body -->
								<!-- <div class="card-body" >
									<div class=" mt-4 mb-2" style="height: auto">
										<canvas id="myPieChart"></canvas>
									</div> -->
									<!-- <div class="mt-4 text-center small">
										<span class="mr-2">
											<i class="fas fa-circle text-primary"></i> Direct
										</span>
										<span class="mr-2">
											<i class="fas fa-circle text-success"></i> Social
										</span>
										<span class="mr-2">
											<i class="fas fa-circle text-info"></i> Referral
										</span>
									</div> -->
								<!-- </div>
							</div>
						</div> -->

						<!-- Pie Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4"> -->
								<!-- Card Header - Dropdown -->
								<!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Applicant Industries</h6>
									<a id="download_profession_pie_chart" download="profession_pie_chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div> -->
								<!-- Card Body -->
								<!-- <div class="card-body" >
									<div class="mt-4 mb-2" style="height: auto">
										<canvas id="profession-pie-chart"></canvas>
									</div>
								</div>
							</div>
						</div> -->
						<!-- Pie Chart End -->

						<!-- Area Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Functional Area</h6>
									<a id="download_functinoal_area_pie_chart" download="functinoal_area_pie_chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div>
								<div class="card-body">
									<div class="mt-4 mb-2" style="height: auto">
										<canvas id="functinoal-area-pie-chart"></canvas>
									</div>
								</div>
							</div>
						</div> -->
						<!-- Area Chart End -->

						<!-- Pie Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4"> -->
								<!-- Card Header - Dropdown -->
								<!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Identify As</h6>
									<a id="download_identify_as_pie_chart" download="identify_as_pie_chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div> -->
								<!-- Card Body -->
								<!-- <div class="card-body">
									<div class="mt-4 mb-2" style="height: auto">
										<canvas id="identify-as-pie-chart"></canvas>
									</div>
								</div>
							</div>
						</div> -->
						<!-- Pie Chart End -->

						<!-- Area Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Experience</h6>
									<a id="download_myAreaChart" download="Experience_Chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div>
								<div class="card-body">
									<div class="chart-area">
										<canvas id="myAreaChart"></canvas>
									</div>
								</div>
							</div>
						</div> -->
						<!-- Area Chart End -->

						<!-- age-area-chart Area Chart -->
						<!-- <div class="col-12">
							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Age</h6>
									<a id="download_age_area_chart" download="age_area_chart.jpg"><i class="fa fa-download [ text-info ]" aria-hidden="true"></i></a>
								</div>
								<div class="card-body">
									<div class="chart-area">
										<canvas id="age-area-chart"></canvas>
									</div>
								</div>
							</div>
						</div> -->
						<!-- age-area-chart Area Chart End -->
					<!-- </div> -->

					<!-- Content Row -->
					<!-- <div class="row"> -->

						<!-- <div class="col-lg-6 mb-4"> -->

							<!-- <div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Projects</h6>
								</div>
								<div class="card-body">
									<h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
									<div class="progress mb-4">
										<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
									<div class="progress">
										<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div> -->

							<!-- Color System -->
							<!-- <div class="row">
								<div class="col-lg-6 mb-4">
									<div class="card bg-primary text-white shadow">
										<div class="card-body">
											Primary
											<div class="text-white-50 small">#4e73df</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 mb-4">
									<div class="card bg-success text-white shadow">
										<div class="card-body">
											Success
											<div class="text-white-50 small">#1cc88a</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 mb-4">
									<div class="card bg-info text-white shadow">
										<div class="card-body">
											Info
											<div class="text-white-50 small">#36b9cc</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 mb-4">
									<div class="card bg-warning text-white shadow">
										<div class="card-body">
											Warning
											<div class="text-white-50 small">#f6c23e</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 mb-4">
									<div class="card bg-danger text-white shadow">
										<div class="card-body">
											Danger
											<div class="text-white-50 small">#e74a3b</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 mb-4">
									<div class="card bg-secondary text-white shadow">
										<div class="card-body">
											Secondary
											<div class="text-white-50 small">#858796</div>
										</div>
									</div>
								</div>
							</div> -->

						<!-- </div>

						<div class="col-lg-6 mb-4"> -->

							<!-- Illustrations -->
							<!-- <div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
								</div>
								<div class="card-body">
									<div class="text-center">
										<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
									</div>
									<p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
									<a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
								</div>
							</div> -->

							<!-- Approach -->
							<!-- <div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
								</div>
								<div class="card-body">
									<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
									<p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
								</div>
							</div> -->

						<!-- </div>
					</div>

				</div> -->
				<!-- /.container-fluid -->

			<!-- </div> -->
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

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

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
					<a class="btn btn-primary" href="<?=$pages->get("name=editor-login")->httpUrl?>?editor_logout=true">Logout</a>
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

	/* Download the Chart as image */
	// function download_myPieChart(){
	// 	let url_base64jp = document.getElementById("myPieChart").toDataURL("image/jpg");
	// 	$("#download_myPieChart").attr('href', url_base64jp);
	// }

	// function download_profession_pie_chart(){
	// 	let url_base64jp = document.getElementById("profession-pie-chart").toDataURL("image/jpg");
	// 	$("#download_profession_pie_chart").attr('href', url_base64jp);
	// }

	// function download_functinoal_area_pie_chart(){
	// 	let url_base64jp = document.getElementById("functinoal-area-pie-chart").toDataURL("image/jpg");
	// 	$("#download_functinoal_area_pie_chart").attr('href', url_base64jp);
	// }

	// function download_identify_as_pie_chart(){
	// 	let url_base64jp = document.getElementById("identify-as-pie-chart").toDataURL("image/jpg");
	// 	$("#download_identify_as_pie_chart").attr('href', url_base64jp);
	// }

	// function download_myAreaChart(){
	// 	let url_base64jp = document.getElementById("myAreaChart").toDataURL("image/jpg");
	// 	$("#download_myAreaChart").attr('href', url_base64jp);
	// }

	// function download_age_area_chart(){
	// 	let url_base64jp = document.getElementById("age-area-chart").toDataURL("image/jpg");
	// 	$("#download_age_area_chart").attr('href', url_base64jp);
	// }
	/* Download the Chart as image END */

	/* Array of colours to use in charts */
	//let colour_array = ['blue','#4e73df', '#1cc88a', '#36b9cc', '#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D','#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC','#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399','#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933','#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF']

	// Set new default font family and font color to mimic Bootstrap's default styling
// Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart cities
// var ctx = document.getElementById("myPieChart");
// var myPieChart = new Chart(ctx, {
// 	type: 'pie',
// 	data: {
// 		labels: [<?=$city_name_string?>],
// 		datasets: [{
// 			data: [<?=$city_count_string?>],
// 			backgroundColor: colour_array,
// 			hoverBackgroundColor: colour_array,
// 			hoverBorderColor: "rgba(234, 236, 244, 1)",
// 		}],
// 	},
// 	options: {
// 		maintainAspectRatio: true,
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			borderColor: '#dddfeb',
// 			borderWidth: 1,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			caretPadding: 10,
// 		},
// 		legend: {
// 			display: false,
// 			position: 'left'
// 		},
// 		cutoutPercentage: 40,
// 		animation: {
// 			onComplete: download_myPieChart
// 		}
// 	},
// });


// Pie Chart profession-pie-chart
// var ppc = document.getElementById("profession-pie-chart");
// var profession_pie_chart = new Chart(ppc, {
// 	type: 'pie',
// 	data: {
// 		labels: [<?=$industry_name_string?>],
// 		datasets: [{
// 			data: [<?=$industry_count_string?>],
// 			backgroundColor: colour_array,
// 			hoverBackgroundColor: colour_array,
// 			hoverBorderColor: "rgba(234, 236, 244, 1)",
// 		}],
// 	},
// 	options: {
// 		maintainAspectRatio: true,
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			borderColor: '#dddfeb',
// 			borderWidth: 1,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			caretPadding: 10,
// 		},
// 		legend: {
// 			display: false
// 		},
// 		cutoutPercentage: 40,
// 		animation: {
// 			onComplete: download_profession_pie_chart
// 		}
// 	},
// });


/* Pie Chart functinoal-area-pie-chart */
// var ppc = document.getElementById("functinoal-area-pie-chart");
// var functional_area_pie_chart = new Chart(ppc, {
// 	type: 'pie',
// 	data: {
// 		labels: [<?=$functional_area_name_string?>],
// 		datasets: [{
// 			data: [<?=$functional_area_count_string?>],
// 			backgroundColor: colour_array,
// 			hoverBackgroundColor: colour_array,
// 			hoverBorderColor: "rgba(234, 236, 244, 1)",
// 		}],
// 	},
// 	options: {
// 		maintainAspectRatio: true,
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			borderColor: '#dddfeb',
// 			borderWidth: 1,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			caretPadding: 10,
// 		},
// 		legend: {
// 			display: false,
// 			position: 'left'
// 		},
// 		cutoutPercentage: 40,
// 		animation: {
// 			onComplete: download_functinoal_area_pie_chart
// 		}
// 	},
// });
/* Pi Chart functinoal-area-pie-chart End */

/*Pie Chart identify-as-pie-chart*/
// var ppc = document.getElementById("identify-as-pie-chart");
// var identify_as_pie_chart = new Chart(ppc, {
// 	type: 'pie',
// 	data: {
// 		labels: [<?=$identify_as_name_string?>],
// 		datasets: [{
// 			data: [<?=$identify_as_count_string?>],
// 			backgroundColor: colour_array,
// 			hoverBackgroundColor: colour_array,
// 			hoverBorderColor: "rgba(234, 236, 244, 1)",
// 		}],
// 	},
// 	options: {
// 		maintainAspectRatio: true,
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			borderColor: '#dddfeb',
// 			borderWidth: 1,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			caretPadding: 10,
// 		},
// 		legend: {
// 			display: true
// 		},
// 		cutoutPercentage: 40,
// 		animation: {
// 			onComplete: download_identify_as_pie_chart
// 		}
// 	},
// });

/* prerequisite functions for area chart */

// Set new default font family and font color to mimic Bootstrap's default styling
//function number_format(number, decimals, dec_point, thousands_sep) {
	// *     example: number_format(1234.56, 2, ',', ' ');
	// *     return: '1 234,56'
// 	number = (number + '').replace(',', '').replace(' ', '');
// 	var n = !isFinite(+number) ? 0 : +number,
// 		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
// 		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
// 		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
// 		s = '',
// 		toFixedFix = function(n, prec) {
// 			var k = Math.pow(10, prec);
// 			return '' +Math.round(n * k) / k ;
// 		};
// 	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
// 	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
// 	if (s[0].length > 3) {
// 		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
// 	}
// 	if ((s[1] || '').length < prec) {
// 		s[1] = s[1] || '';
// 		s[1] += new Array(prec - s[1].length + 1).join('0');
// 	}
// 	return s.join(dec);
// }
/* prerequisite functions for area chart End */

/* Area Chart of experience */
// var ctx = document.getElementById("myAreaChart");
// var myLineChart = new Chart(ctx, {
// 	type: 'line',
// 	data: {
// 		labels: [<?=$experience_name_string?>],
// 		datasets: [{
// 			label: "Candidates",
// 			lineTension: 0.3,
// 			backgroundColor: "rgba(78, 115, 223, 0.05)",
// 			borderColor: "rgba(78, 115, 223, 1)",
// 			pointRadius: 3,
// 			pointBackgroundColor: "rgba(78, 115, 223, 1)",
// 			pointBorderColor: "rgba(78, 115, 223, 1)",
// 			pointHoverRadius: 3,
// 			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
// 			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
// 			pointHitRadius: 10,
// 			pointBorderWidth: 2,
// 			data: [<?=$experience_count_string?>],
// 		}],
// 	},
// 	options: {
// 		animation: {
// 			onComplete: download_myAreaChart
// 		},
// 		maintainAspectRatio: false,
// 		layout: {
// 			padding: {
// 				left: 10,
// 				right: 25,
// 				top: 25,
// 				bottom: 0
// 			}
// 		},
// 		scales: {
// 			xAxes: [{
// 				time: {
// 					unit: 'date'
// 				},
// 				gridLines: {
// 					display: false,
// 					drawBorder: false
// 				},
// 				ticks: {
// 					maxTicksLimit: 7,
// 					callback: function(value, index, values) {
// 						return  number_format(value)+" Years";
// 					}
// 				}
// 			}],
// 			yAxes: [{
// 				ticks: {
// 					maxTicksLimit: 5,
// 					padding: 10,
// 					// Include a dollar sign in the ticks
// 					callback: function(value, index, values) {
// 						return  number_format(value);
// 					}
// 				},
// 				gridLines: {
// 					color: "rgb(234, 236, 244)",
// 					zeroLineColor: "rgb(234, 236, 244)",
// 					drawBorder: false,
// 					borderDash: [2],
// 					zeroLineBorderDash: [2]
// 				}
// 			}],
// 		},
// 		legend: {
// 			display: false
// 		},
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			titleMarginBottom: 10,
// 			titleFontColor: '#6e707e',
// 			titleFontSize: 14,
// 			borderColor: '#dddfeb',
// 			borderWidth: 2,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			intersect: false,
// 			mode: 'index',
// 			caretPadding: 10,
// 			callbacks: {
// 				label: function(tooltipItem, chart) {
// 					var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
// 					return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
// 				}
// 			}
// 		}
// 	}
// });
/* Area Chart of experience End */

/* Area Chart of experience */
// var ctx2 = document.getElementById("age-area-chart");
// var myLineChart2 = new Chart(ctx2, {
// 	type: 'line',
// 	data: {
// 		labels: [<?=$age_name_string?>],
// 		datasets: [{
// 			label: "Candidates",
// 			lineTension: 0.3,
// 			backgroundColor: "rgba(78, 115, 223, 0.05)",
// 			borderColor: "rgba(78, 115, 223, 1)",
// 			pointRadius: 3,
// 			pointBackgroundColor: "rgba(78, 115, 223, 1)",
// 			pointBorderColor: "rgba(78, 115, 223, 1)",
// 			pointHoverRadius: 3,
// 			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
// 			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
// 			pointHitRadius: 10,
// 			pointBorderWidth: 2,
// 			data: [<?=$age_count_string?>],
// 		}],
// 	},
// 	options: {
// 		animation: {
// 			onComplete: download_age_area_chart
// 		},
// 		maintainAspectRatio: false,
// 		layout: {
// 			padding: {
// 				left: 10,
// 				right: 25,
// 				top: 25,
// 				bottom: 0
// 			}
// 		},
// 		scales: {
// 			xAxes: [{
// 				time: {
// 					unit: 'date'
// 				},
// 				gridLines: {
// 					display: false,
// 					drawBorder: false
// 				},
// 				ticks: {
// 					maxTicksLimit: 7,
// 					callback: function(value, index, values) {
// 						return  number_format(value)+" Years";
// 					}
// 				}
// 			}],
// 			yAxes: [{
// 				ticks: {
// 					maxTicksLimit: 5,
// 					padding: 10,
// 					// Include a dollar sign in the ticks
// 					callback: function(value, index, values) {
// 						return  number_format(value);
// 					}
// 				},
// 				gridLines: {
// 					color: "rgb(234, 236, 244)",
// 					zeroLineColor: "rgb(234, 236, 244)",
// 					drawBorder: false,
// 					borderDash: [2],
// 					zeroLineBorderDash: [2]
// 				}
// 			}],
// 		},
// 		legend: {
// 			display: false
// 		},
// 		tooltips: {
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			titleMarginBottom: 10,
// 			titleFontColor: '#6e707e',
// 			titleFontSize: 14,
// 			borderColor: '#dddfeb',
// 			borderWidth: 2,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			intersect: false,
// 			mode: 'index',
// 			caretPadding: 10,
// 			callbacks: {
// 				label: function(tooltipItem, chart) {
// 					var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
// 					return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
// 				}
// 			}
// 		}
// 	}
// });
/* Area Chart of experience End */


</script>
</body>
</html>