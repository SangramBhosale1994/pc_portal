<?php
if($session->user_designation=="admin"){
    require_once 'includes/admin-header.php';
}
else{
    require_once 'includes/recruiter-header.php';
}
?>


				<!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
                            <label class="btn btn-outline-primary"><input id='select_all_checkbox' class='select_all_candidate_checkbox' type='checkbox' style="padding-top:0.5rem;"> Select All</label>

							<button id="" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#column-select-modal">Select Columns</button>

							<!-- <button id="show_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Show Profile</button> -->
                            
                            <!-- <button id="select_all_checkbox" class="[ btn btn-primary ](  ) select_all_candidate_checkbox" type="button">Select All</button> -->
							
							<button id="more_filters_btn" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#search-modal">Search</button>

							<button id="add_to_favourite_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Add to Favourite</button>

							<button id="unlcok_profiles_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Unlock Selected</button>
							
							

							<!-- <button id="edit_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Edit Profile</button> -->
						</div>

						<div id="table_container_card_body" class="card-body">
							<!-- <h3 id="table_loading" >Loading...</h3> -->
                            <?php
                            if(isset($_GET['job_code'])){
                            ?>
                            <div id="filter_controls">
                                <form id="candidate_filter_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
                                    <div class="row" style="justify-content: flex-start;margin-bottom: 1rem;">
                                        <div class="d-flex">
                                            <div class="col-md-12">
                                                <button id="candidate_status_btn_filters_all"  class="[ badge bg-light ]( selected-action-button )" value="All"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">All Candidates</button>
                                                <button id="candidate_status_btn_filters_shortlisted" class="[ badge bg-light ]( selected-action-button )"  value="CV Shortlisted"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">CV Shorlisted</button>
                                                <button id="candidate_status_btn_filters_notviewed"  class="[ badge bg-light ]( selected-action-button )" value="Not Viewed"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">Not Viewed</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="justify-content: flex-start;" id="applicants_candidate_status_filter_div">
                                            <div class="d-flex">
                                                    <div class="col-md-8">
                                                            
                                                        <div class="[  ][ form-group ]">
                                                            <label for="applicants_candidate_status_filter">Candidate Status </label>
                                                            <select id="applicants_candidate_status_filter" class="custom-select" name="applicants_candidate_status_filter" >
                                                                <option value="" selected >All Candidates</option>
                                                                <?php
                                                                $candidate_status_array=Array();
                                                                foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
                                                                    $candidate_status_array[]=$candidate_status->title;
                                                                }
                                                                $candidate_status_array[]="Not Viewed";
                                                                $candidate_status_array[]="New Applicants";
                                                                foreach($candidate_status_array as $single_candidate_status){
                                                                        // $candidate_status_array[]=addslashes($candidate_status->title);
                                                                
                                                                ?>
                                                                <option value="<?=$single_candidate_status?>"><?=$single_candidate_status?></option>
                                                                <!-- <option value="New Applicants">New Applicants</option> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="invalid-tooltip">
                                                                    Please select an option.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="margin-top:2rem;">
                                                            <button id="btn_applicant_candidate_filter" type="button" class="[ btn btn-primary ]( selected-action-button )" style="">Apply Filters</button>
                                                    </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            }
                            ?>

							<div id="table_container" class="table-responsive">
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<!-- <span>Copyright &copy; Pride Circle 2019</span> -->
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

	<!-- MODAL :  Column select modal -->
	<div class="modal fade" id="column-select-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Select columns to be shown.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="column_select_checkbox_container" class="modal-body">
					<?php
						/* Based on what type of user has logged in, decide columns availability */
						$available_columns_to_show = $columns_for_recruiter;

						/* Loop through all the possible column names */
						foreach ($all_columns as $section_title => $checkbox_array) {
						    
						    if($section_title=="Additional Details" || $section_title=="Tags" ||  $section_title=="Uploaded Files" ){
						        continue;
						    }
					?>

					<div class="[ mt-3 ]">
						<h3><?=$section_title?></h3>
					</div>

					<div class="[ row ]">

						<?php
							foreach ($checkbox_array as $column_checkbox_id => $column_checkbox_title) {
								/* Check if that column is allowed to be shown, if not continue. */
								if(!array_key_exists($column_checkbox_id, $available_columns_to_show)){
									continue;
								}

								$is_selected = (in_array($column_checkbox_id, json_decode($pages->get($session->user_page_id)->candidate_table_column_array))) ? "checked": "";
						?>

						<div class="[ col-md-4 form-group ]">
							<input id="<?=$column_checkbox_id?>" class="( column_select_checkbox )" type="checkbox" <?=$is_selected?>>
							<label for="<?=$column_checkbox_id?>"><?=$column_checkbox_title?></label>
						</div>

						<?php
							}
						?>

					</div>

					<?php
						}
					?>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="column_select_modal_submit" type="button" class="[ btn btn-primary ]" data-dismiss="modal">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Column select modal End -->
	
		<!-- MODAL : Candidate search modal -->
	<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Search</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				 <form id="search_container_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
				    <div id="" class="modal-body">
				    	<div class="container">
                                
                			<div class="row">
                			    
                			</div>
                			<div class="row">
                			    <div class="col-md-6">
                			        <div class="[  ][ form-group ]">
                        				<label for="experience_years">Experience min</label>
                        
                        				<div class="row no-gutters">
                        					<div class="[ col-12 pr-2 ][ input-group ]">
                        						<!--<div class="input-group-prepend">-->
                        						<!--	<div class="input-group-text">Years</div>-->
                        						<!--</div>-->
                        
                        						<select id="experience_years" class="custom-select" name="experience_min" value="">
                        						     <option value="" selected>Please select</option>
                        							<?php
                        								for ($i=0; $i <= 60; $i++) {
                        								    $is_selected="";
                        								    //  if($job_search_data_set['experience_years']!=""        && $i==$job_search_data_set['experience_years']){
                        								    //     $is_selected=" selected ";
                        								    // }
                        									echo '<option value="'.$i.'" '.$is_selected.' >'.$i.'</option>';
                        								}
                        							?>
                        						</select>
                        						<div class="input-group-prepend">
                        							<div class="input-group-text">Years</div>
                        						</div>
                        
                        						<div class="invalid-tooltip">
                        							Please select years.
                        						</div>
                        					</div>
                        
                        				</div>
                        			</div>
                			    </div>
                			    <div class="col-md-6">
                			        <div class="[  ][ form-group ]">
                        				<label for="experience_years">Experience max</label>
                        
                        				<div class="row no-gutters">
                        					<div class="[ col-12 pr-2 ][ input-group ]">
                        						<!--<div class="input-group-prepend">-->
                        						<!--	<div class="input-group-text">Years</div>-->
                        						<!--</div>-->
                        
                        						<select id="experience_years" class="custom-select" name="experience_max" value="">
                        						     <option value="" selected>Please select</option>
                        							<?php
                        								for ($i=0; $i <= 60; $i++) {
                        								    $is_selected="";
                        								    //  if($job_search_data_set['experience_years']!=""        && $i==$job_search_data_set['experience_years']){
                        								    //     $is_selected=" selected ";
                        								    // }
                        									echo '<option value="'.$i.'" '.$is_selected.' >'.$i.'</option>';
                        								}
                        							?>
                        						</select>
                        						<div class="input-group-prepend">
                        							<div class="input-group-text">Years</div>
                        						</div>
                        
                        						<div class="invalid-tooltip">
                        							Please select years.
                        						</div>
                        					</div>
                        
                        				</div>
                        			</div>
                			    </div>
                			</div>
                			
                			<div class="row">
                			    <div class="col-md-4">
                			        <div class="[  ][ form-group ]">
                        				<label for="identify_as">Identify as:</label>
                        				<select id="identify_as" class="custom-select" name="identify_as" >
                        					<option value="" selected >Choose Identify as</option>
                        					<option value="Lesbian">Lesbian</option>
                        					<option value="Gay">Gay</option>
                        					<option value="Bisexual">Bisexual</option>
                        					<option value="Transwoman">Transwoman</option>
                        					<option value="Transman">Transman</option>
                        					<option value="Queer">Queer</option>
                        					<option value="Pansexual">Pansexual</option>
                        					<option value="Asexual">Asexual</option>
                        					<option value="Intersex">Intersex</option>
                        					<option value="Gender Non-Conforming / Gender Non-Binary">Gender Non-Conforming / Gender Non-Binary</option>
                        					<option value="other">Other</option>
                        				</select>
                        
                        				<div class="invalid-tooltip">
                        					Please select how you identify as.
                        				</div>
                        			</div>
                			    </div>
                			    <div class="col-md-4">
                			        <div class="[  ][ form-group ]">
                        				<label class="d-block" for="out_at_work">OUT at work?</label>
                        				<select id="out_at_work_yes" name="out_at_work" class="custom-select" >
                        					<option value="" selected >Choose OUT at work?</option>
                        					<option value="Yes">Yes</option>
                        					<option value="No">No</option>
                        				</select>
                        				
                        					<div class="invalid-tooltip">
                        						Please select an option.
                        					</div>
                        
                        			</div>
                			    </div>
                			    <div class="col-md-4">
                			        <div class="[  ][ form-group ]">
                        				<label for="qualification">Qualification</label>
                        				
                        				<input id="qualification" class="form-control" type="text" name="qualification" placeholder="Qualification" >
                        				<div class="invalid-tooltip">
                        					Please select your qualification.
                        				</div>
                        			</div>
                			    </div>
                			</div>
                			<div class="row">
                			    <div class="col-md-6">
                			        <div class="[  ][ form-group ]">
                        				<label for="key_skills">Skills</label>
                        				<input id="key_skills" name="key_skills" type="text" class="form-control tagator"  value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
                                                'Analytical',
                                                'Analyze and Recommend Database Improvements',
                                                'Analyze Impact of Database Changes to the Business',
                                                'Audit Database Access and Requests',
                                                'APIs',
                                                'Application and Server Monitoring Tools',
                                                'Application Development ',
                                                'Architecture',
                                                'Artificial Intelligence',
                                                'Attention to Detail',
                                                'AutoCAD',
                                                'Azure',
                                                'Cloud Computing',
                                                'C++',
                                                'C Language',
                                                'Compensation & Benefits',
                                                'Configure Database Software',
                                                'Configuration Management',
                                                'Critical Thinking',
                                                'Database Administration',
                                                'Deploying Applications in a Cloud Environment',
                                                'Develop and Secure Network Structures',
                                                'Develop and Test Methods',
                                                'Emerging Technologies',
                                                'File Systems',
                                                'HTML',
                                                'Implement Backup and Recovery Plan',
                                                'Implementation',
                                                'Information Systems',
                                                'Interaction Design',
                                                'Interaction Flows',
                                                'Install, Maintain, and Merge Databases',
                                                'Integrated Technologies',
                                                'Integrating Security Protocols with Cloud Design',
                                                'Internet',
                                                'JavaScript',
                                                'Java',
                                                'Optimization',
                                                'IT Soft Skills',
                                                'L&D',
                                                'Logical Thinking',
                                                'Leadership',
                                                'Operating Systems',
                                                'Migrating Existing Workloads into Cloud Systems',
                                                'Mobile Applications',
                                                'Open Source Technology Integration',
                                                'Optimizing Website Performance',
                                                'PHP',
                                                'Python',
                                                'Problem Solving',
                                                'Project Management',
                                                'Recruitment',
                                                'Ruby',
                                                'Software Engineering',
                                                'Software Quality Assurance (QA)',
                                                'TensorFlow',
                                                'User-Centered Design',
                                                'UX Design',
                                                'UI / UX',
                                                'Visual Basic',
                                                'Visual FoxPro',
                                                'Web Development',
                                                'Web Design'
                                                ]
                                            ">
                        				<div class="invalid-tooltip">
                        					Please enter key skills.
                        				</div>
                        			</div>
                			    </div>
                			    <div class="col-md-6">
                			        <div class="[  ][ form-group ]">
                        				<label for="current_city">Current City </label>
                        				<input id="current_city" name="current_city" type="text" class="form-control tagator"  value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
                                                    'Abu',
                                                    'Adoni',
                                                    'Agartala',
                                                    'Agra',
                                                    'Ahmadabad',
                                                    'Ahmadnagar',
                                                    'Aizawl',
                                                    'Ajmer',
                                                    'Akola',
                                                    'Alappuzha',
                                                    'Aligarh',
                                                    'Alipore',
                                                    'Alipur Duar',
                                                    'Almora',
                                                    'Alwar',
                                                    'Amaravati',
                                                    'Ambala',
                                                    'Ambikapur',
                                                    'Amer',
                                                    'Amravati',
                                                    'Amreli',
                                                    'Amritsar',
                                                    'Amroha',
                                                    'Anantapur',
                                                    'Anantnag',
                                                    'Andhra Pradesh',
                                                    'Ara',
                                                    'Arcot',
                                                    'Arunachal Pradesh',
                                                    'Asansol',
                                                    'Assam',
                                                    'Aurangabad',
                                                    'Ayodhya',
                                                    'Azamgarh',
                                                    'Badagara',
                                                    'Badami',
                                                    'Baharampur',
                                                    'Bahraich',
                                                    'Balaghat',
                                                    'Balangir',
                                                    'Baleshwar',
                                                    'Ballari',
                                                    'Ballia',
                                                    'Bally',
                                                    'Balurghat',
                                                    'Banda',
                                                    'Bangalore',
                                                    'Bankura',
                                                    'Bara Banki',
                                                    'Baramula',
                                                    'Baranagar',
                                                    'Barasat',
                                                    'Bareilly',
                                                    'Baripada',
                                                    'Barmer',
                                                    'Barrackpore',
                                                    'Baruni',
                                                    'Barwani',
                                                    'Basirhat',
                                                    'Basti',
                                                    'Batala',
                                                    'Beawar',
                                                    'Begusarai',
                                                    'Belgavi',
                                                    'Bettiah',
                                                    'Betul',
                                                    'Bhadravati',
                                                    'Bhagalpur',
                                                    'Bhandara',
                                                    'Bharatpur',
                                                    'Bharhut',
                                                    'Bharuch',
                                                    'Bhatpara',
                                                    'Bhavnagar',
                                                    'Bhilai',
                                                    'Bhilwara',
                                                    'Bhind',
                                                    'Bhiwani',
                                                    'Bhojpur',
                                                    'Bhopal',
                                                    'Bhubaneshwar',
                                                    'Bhuj',
                                                    'Bhusawal',
                                                    'Bid',
                                                    'Bidar',
                                                    'Bihar',
                                                    'Bihar Sharif',
                                                    'Bijnor',
                                                    'Bikaner',
                                                    'Bilaspur',
                                                    'Bilaspur',
                                                    'Bishnupur',
                                                    'Bithur',
                                                    'Bodh Gaya',
                                                    'Bokaro',
                                                    'Brahmapur',
                                                    'Budaun',
                                                    'Budge Budge',
                                                    'Bulandshahr',
                                                    'Buldana',
                                                    'Bundi',
                                                    'Burdwan',
                                                    'Burhanpur',
                                                    'Buxar',
                                                    'Chaibasa',
                                                    'Chamba',
                                                    'Chandernagore',
                                                    'Chandigarh',
                                                    'Chandigarh',
                                                    'Chandigarh',
                                                    'Chandigarh (Union Territorigarh (Union Territory)',
                                                    'Chandragiri',
                                                    'Chandrapur',
                                                    'Chapra',
                                                    'Chengalpattu',
                                                    'Chennai',
                                                    'Cherrapunji',
                                                    'Chhatarpur',
                                                    'Chhattisgarh',
                                                    'Chhindwara',
                                                    'Chidambaram',
                                                    'Chikkamagaluru',
                                                    'Chitradurga',
                                                    'Chittaurgarh',
                                                    'Chittoor',
                                                    'Churu',
                                                    'Coimbatore',
                                                    'Cuddalore',
                                                    'Cuttack',
                                                    'Dadra And Nagar Haveli (Untory)',
                                                    'Dalhousie',
                                                    'Daman',
                                                    'Daman And Diu (Union Terriman And Diu (Union Territory)',
                                                    'Damoh',
                                                    'Darbhanga',
                                                    'Darjiling',
                                                    'Datia',
                                                    'Daulatabad',
                                                    'Davangere',
                                                    'Dehra Dun',
                                                    'Dehri',
                                                    'Delhi',
                                                    'Delhi (National Capital Territory)',
                                                    'Deoghar',
                                                    'Deoria',
                                                    'Dewas',
                                                    'Dhamtari',
                                                    'Dhanbad',
                                                    'Dhar',
                                                    'Dharmapuri',
                                                    'Dharmshala',
                                                    'Dhaulpur',
                                                    'Dhenkanal',
                                                    'Dhuburi',
                                                    'Dhule',
                                                    'Diamond Harbour',
                                                    'Dibrugarh',
                                                    'Dinapur Nizamat',
                                                    'Dindigul',
                                                    'Dispur',
                                                    'Diu',
                                                    'Doda',
                                                    'Dowlaiswaram',
                                                    'Dum Dum',
                                                    'Dumka',
                                                    'Dungarpur',
                                                    'Durg',
                                                    'Durgapur',
                                                    'Dwarka',
                                                    'Eluru',
                                                    'Erode',
                                                    'Etah',
                                                    'Etawah',
                                                    'Faizabad',
                                                    'Faridabad',
                                                    'Faridkot',
                                                    'Farrukhabad-cum-Fatehgarh',
                                                    'Fatehpur',
                                                    'Fatehpur Sikri',
                                                    'Firozpur',
                                                    'Firozpur Jhirka',
                                                    'Gandhinagar',
                                                    'Ganganagar',
                                                    'Gangtok',
                                                    'Gaya',
                                                    'Ghaziabad',
                                                    'Ghazipur',
                                                    'Giridih',
                                                    'Goa',
                                                    'Godhra',
                                                    'Gonda',
                                                    'Gorakhpur',
                                                    'Gujarat',
                                                    'Gulmarg',
                                                    'Guna',
                                                    'Guntur',
                                                    'Gurdaspur',
                                                    'Gurgaon',
                                                    'Guwahati',
                                                    'Gwalior',
                                                    'Gyalsing',
                                                    'Hajipur',
                                                    'Halebid',
                                                    'Halisahar',
                                                    'Hamirpur',
                                                    'Hamirpur',
                                                    'Hansi',
                                                    'Hanumangarh',
                                                    'Haora',
                                                    'Hardoi',
                                                    'Haridwar',
                                                    'Haryana',
                                                    'Hassan',
                                                    'Hathras',
                                                    'Hazaribag',
                                                    'Himachal Pradesh',
                                                    'Hisar',
                                                    'Hoshangabad',
                                                    'Hoshiarpur',
                                                    'Hubballi-Dharwad',
                                                    'Hugli',
                                                    'Hyderabad',
                                                    'Idukki',
                                                    'Imphal',
                                                    'Indore',
                                                    'Ingraj Bazar',
                                                    'Itanagar',
                                                    'Itarsi',
                                                    'Jabalpur',
                                                    'Jagdalpur',
                                                    'Jaipur',
                                                    'Jaisalmer',
                                                    'Jalandhar',
                                                    'Jalaun',
                                                    'Jalgaon',
                                                    'Jalor',
                                                    'Jalpaiguri',
                                                    'Jamalpur',
                                                    'Jammu',
                                                    'Jammu And Kashmir',
                                                    'Jamnagar',
                                                    'Jamshedpur',
                                                    'Jaunpur',
                                                    'Jhabua',
                                                    'Jhalawar',
                                                    'Jhansi',
                                                    'Jharia',
                                                    'Jharkhand',
                                                    'Jhunjhunu',
                                                    'Jind',
                                                    'Jodhpur',
                                                    'Jorhat',
                                                    'Junagadh',
                                                    'Kadapa',
                                                    'Kaithal',
                                                    'Kakinada',
                                                    'Kalaburagi',
                                                    'Kalimpong',
                                                    'Kalyan',
                                                    'Kamarhati',
                                                    'Kanchipuram',
                                                    'Kanchrapara',
                                                    'Kandla',
                                                    'Kangra',
                                                    'Kannauj',
                                                    'Kanniyakumari',
                                                    'Kannur',
                                                    'Kanpur',
                                                    'Kapurthala',
                                                    'Karaikal',
                                                    'Karimnagar',
                                                    'Karli',
                                                    'Karnal',
                                                    'Karnataka',
                                                    'Kathua',
                                                    'Katihar',
                                                    'Keonjhar',
                                                    'Kerala',
                                                    'Khajuraho',
                                                    'Khambhat',
                                                    'Khammam',
                                                    'Khandwa',
                                                    'Kharagpur',
                                                    'Khargon',
                                                    'Kheda',
                                                    'Kishangarh',
                                                    'Koch Bihar',
                                                    'Kochi',
                                                    'Kodaikanal',
                                                    'Kohima',
                                                    'Kolar',
                                                    'Kolhapur',
                                                    'Kolkata',
                                                    'Kollam',
                                                    'Konark',
                                                    'Koraput',
                                                    'Kota',
                                                    'Kottayam',
                                                    'Kozhikode',
                                                    'Krishnanagar',
                                                    'Kullu',
                                                    'Kumbakonam',
                                                    'Kurnool',
                                                    'Kurukshetra',
                                                    'Lachung',
                                                    'Lakhimpur',
                                                    'Lalitpur',
                                                    'Leh',
                                                    'Location',
                                                    'Lucknow',
                                                    'Ludhiana',
                                                    'Lunglei',
                                                    'Machilipatnam',
                                                    'Madgaon',
                                                    'Madhubani',
                                                    'Madhya Pradesh',
                                                    'Madikeri',
                                                    'Madurai',
                                                    'Mahabaleshwar',
                                                    'Maharashtra',
                                                    'Mahbubnagar',
                                                    'Mahe',
                                                    'Mahesana',
                                                    'Maheshwar',
                                                    'Mainpuri',
                                                    'Malda',
                                                    'Malegaon',
                                                    'Mamallapuram',
                                                    'Mandi',
                                                    'Mandla',
                                                    'Mandsaur',
                                                    'Mandya',
                                                    'Mangaluru',
                                                    'Mangan',
                                                    'Manipur',
                                                    'Matheran',
                                                    'Mathura',
                                                    'Mattancheri',
                                                    'Meerut',
                                                    'Meghalaya',
                                                    'Merta',
                                                    'Mhow',
                                                    'Midnapore',
                                                    'Mirzapur-Vindhyachal',
                                                    'Mizoram',
                                                    'Mon',
                                                    'Moradabad',
                                                    'Morena',
                                                    'Morvi',
                                                    'Motihari',
                                                    'Mumbai',
                                                    'Munger',
                                                    'Murshidabad',
                                                    'Murwara',
                                                    'Mussoorie',
                                                    'Muzaffarnagar',
                                                    'Muzaffarpur',
                                                    'Mysuru',
                                                    'Nabha',
                                                    'Nadiad',
                                                    'Nagaland',
                                                    'Nagaon',
                                                    'Nagappattinam',
                                                    'Nagarjunakoṇḍa',
                                                    'Nagaur',
                                                    'Nagercoil',
                                                    'Nagpur',
                                                    'Nahan',
                                                    'Nainital',
                                                    'Nanded',
                                                    'Narsimhapur',
                                                    'Narsinghgarh',
                                                    'Narwar',
                                                    'Nashik',
                                                    'Nathdwara',
                                                    'Navadwip',
                                                    'Navsari',
                                                    'Neemuch',
                                                    'New Delhi',
                                                    'Nizamabad',
                                                    'Nowgong',
                                                    'Odisha',
                                                    'Okha',
                                                    'Orchha',
                                                    'Osmanabad',
                                                    'Palakkad',
                                                    'Palanpur',
                                                    'Palashi',
                                                    'Palayankottai',
                                                    'Pali',
                                                    'Panaji',
                                                    'Pandharpur',
                                                    'Panihati',
                                                    'Panipat',
                                                    'Panna',
                                                    'Paradip',
                                                    'Parbhani',
                                                    'Partapgarh',
                                                    'Patan',
                                                    'Patiala',
                                                    'Patna',
                                                    'Pehowa',
                                                    'Phalodi',
                                                    'Phek',
                                                    'Phulabani',
                                                    'Pilibhit',
                                                    'Pithoragarh',
                                                    'Porbandar',
                                                    'Port Blair',
                                                    'Prayagraj',
                                                    'Puducherry',
                                                    'Puducherry (Union Territorherry (Union Territory)',
                                                    'Pudukkottai',
                                                    'Punch',
                                                    'Pune',
                                                    'Punjab',
                                                    'Puri',
                                                    'Purnia',
                                                    'Purulia',
                                                    'Pusa',
                                                    'Pushkar',
                                                    'Rae Bareli',
                                                    'Raichur',
                                                    'Raiganj',
                                                    'Raipur',
                                                    'Raisen',
                                                    'Rajahmundry',
                                                    'Rajapalaiyam',
                                                    'Rajasthan',
                                                    'Rajauri',
                                                    'Rajgarh',
                                                    'Rajkot',
                                                    'Rajmahal',
                                                    'Rajnandgaon',
                                                    'Ramanathapuram',
                                                    'Rampur',
                                                    'Ranchi',
                                                    'Ratlam',
                                                    'Ratnagiri',
                                                    'Rewa',
                                                    'Rewari',
                                                    'Rohtak',
                                                    'Rupnagar',
                                                    'Sagar',
                                                    'Saharanpur',
                                                    'Saharsa',
                                                    'Salem',
                                                    'Samastipur',
                                                    'Sambalpur',
                                                    'Sambhal',
                                                    'Sangareddi',
                                                    'Sangli',
                                                    'Sangrur',
                                                    'Santipur',
                                                    'Saraikela',
                                                    'Sarangpur',
                                                    'Sasaram',
                                                    'Satara',
                                                    'Satna',
                                                    'Sawai Madhopur',
                                                    'Sehore',
                                                    'Seoni',
                                                    'Sevagram',
                                                    'Shahdol',
                                                    'Shahjahanpur',
                                                    'Shahpura',
                                                    'Shajapur',
                                                    'Shantiniketan',
                                                    'Sheopur',
                                                    'Shillong',
                                                    'Shimla',
                                                    'Shivamogga',
                                                    'Shivpuri',
                                                    'Shravanabelagola',
                                                    'Shrirampur',
                                                    'Shrirangapattana',
                                                    'Sibsagar',
                                                    'Sikar',
                                                    'Sikkim',
                                                    'Silchar',
                                                    'Siliguri',
                                                    'Silvassa',
                                                    'Sirohi',
                                                    'Sirsa',
                                                    'Sitamarhi',
                                                    'Sitapur',
                                                    'Siuri',
                                                    'Siwan',
                                                    'Solapur',
                                                    'Sonipat',
                                                    'Srikakulam',
                                                    'Srinagar',
                                                    'Sultanpur',
                                                    'Surat',
                                                    'Surendranagar',
                                                    'Tamil Nadu',
                                                    'Tamluk',
                                                    'Tehri',
                                                    'Telangana',
                                                    'Tezpur',
                                                    'Thalassery',
                                                    'Thane',
                                                    'Thanjavur',
                                                    'Thiruvananthapuram',
                                                    'Thrissur',
                                                    'Tinsukia',
                                                    'Tiruchchirappalli',
                                                    'Tirunelveli',
                                                    'Tirupati',
                                                    'Tiruppur',
                                                    'Titagarh',
                                                    'Tonk',
                                                    'Tripura',
                                                    'Tumkuru',
                                                    'Tuticorin',
                                                    'Udaipur',
                                                    'Udayagiri',
                                                    'Udhagamandalam',
                                                    'Udhampur',
                                                    'Ujjain',
                                                    'Ulhasnagar',
                                                    'Una',
                                                    'Uttar Pradesh',
                                                    'Uttarakhand',
                                                    'Valsad',
                                                    'Varanasi',
                                                    'Vasai-Virar',
                                                    'Vellore',
                                                    'Veraval',
                                                    'Vidisha',
                                                    'Vijayawada',
                                                    'Visakhapatnam',
                                                    'Vizianagaram',
                                                    'Warangal',
                                                    'Wardha',
                                                    'West Bengal',
                                                    'Wokha',
                                                    'Yanam',
                                                    'Yavatmal',
                                                    'Yemmiganur',
                                                    'Zunheboto'
                                                ]
                                            ">
                        				<div class="invalid-tooltip">
                        					Please enter current city.
                        				</div>
                        			</div>
                			    </div>
                                
                			</div>
                            <div class="row">
                                <div class="col-md-6">
                			         <div class="[  ][ form-group ]">
                        				<label for="internship_month">Internship Month(s) </label>
                        				<input id="internship_month" name="internship_month" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['January','February','March','April','May','June','July','August','September','October','November','December']">
                        				
                                        <div class="invalid-tooltip">
                                            Please select an option.
                                        </div>
                        
                        			</div>
                			    </div>
                                <div class="col-md-6">
                			         <div class="[  ][ form-group ]">
                        				<label for="aggregate_percentage">Aggregate Percentage </label>
                        				<input id="aggregate_percentage" name="aggregate_percentage" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Upto 50.00%','50.01 to 60.00%','60.01% to 70.00%','70.01% to 80.00%','80.01% to 90.00%','90.01% to 100%']">
                        				
                                        <div class="invalid-tooltip">
                                            Please select an option.
                                        </div>
                        
                        			</div>
                			    </div>
                            </div>
                            <div class="row">
                			    <div class="col-md-4">
                			        <div class="[  ][ form-group ]">
                                       
                                        <label for="recruiter_candidate_status">Candidate Status </label>
                        				<!-- <input id="recruiter_candidate_status" name="recruiter_candidate_status" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$candidate_status_data?>']"> -->
                        				
                        				<select id="recruiter_candidate_status" class="custom-select" name="recruiter_candidate_status" >
                        					<option value="" selected >Choose Candidate Status</option>
                                            <?php
                                            $candidate_status_array=array();
                                            foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
                                                // $candidate_status_array[]=addslashes($candidate_status->title);
                                            
                                            ?>
                        					<option value="<?=$candidate_status->title?>"><?=$candidate_status->title?></option>
                                            <?php
                                             }
                                            ?>
                        				</select>
                                        <div class="invalid-tooltip">
                                            Please select an option.
                                        </div>
                        			</div>
                			    </div>
                			</div>
                            <?php
                            if(isset($_GET['job_code'])){
                            ?>
                            <div class="row">
                			    <div class="col-md-6">
                			        <div class="[  ][ form-group ]">
                        				<label for="recruiter_application_from">Application from </label>
                        				<input id="recruiter_application_from" name="recruiter_application_from" type="date" class="form-control"  >
                        				<div class="invalid-tooltip">
                        					Please enter application from.
                        				</div>
                        			</div>
                			    </div>
                			    <div class="col-md-6">
                			        
                        			<div class="[  ][ form-group ]">
                        				<label for="recruiter_application_to">Application to </label>
                        				<input id="recruiter_application_to" name="recruiter_application_to" type="date" class="form-control"  >
                        				<div class="invalid-tooltip">
                        					Please enter application to.
                        				</div>
                        			</div>
                			    </div>
                			    
                			</div>
                            <?php
                            }
                            ?>
				    </div>

    				
    				<div class="modal-footer justify-content-between">
    					<a href="<?=$page->httpUrl;?>">
    					    <button  class="btn btn-secondary" id="reset" >Clear Search</button>
    					</a>
    					<button id="search_modal_submit" type="button" class="[ btn btn-primary ]" >Search</button>
    				</div>
				  </form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Candidate search modal End -->

	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js?v=<?=mt_rand(0,999)?>"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>


	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
	
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>
    <script src="<?= $rootpath;?>scripts/offer_popup_show.js?v=<?=mt_rand(0,999)?>"></script>
    <?php
    require_once 'includes/offer_popup_show.php';
    ?>

    <script type="text/javascript">
				{
					let sideBar = document.querySelector('.side-bar');
					let arrowCollapse = document.querySelector('#logo-name__icon');
					let headerNav = document.querySelector('.header_navbar');
					let recruiter_datatable_section = document.querySelector('.recruiter_datatable_section');
					let sticky_footer = document.querySelector('.sticky-footer');
					// console.log(dashboard);
					console.log("ghghgh");
					

                    sideBar.onmouseover = () => {
                        sideBar.classList.add('collapse');
                        arrowCollapse.classList.add('collapse');
                        arrowCollapse.classList = 'bx bx-chevron-right logo-name__icon collapse';
                        recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
                        recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};

					sideBar.onmouseout = () => {
                        sideBar.classList.remove('collapse');
                        arrowCollapse.classList.remove('collapse');
                        arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
                        recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
                        recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};
				}
	</script>
</body>

</html>
