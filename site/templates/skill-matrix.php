<?php
	require_once 'includes/admin-header.php';
?>
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">

							<!-- <h2>Skills</h2> -->
							<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist" style="width:100%;">
								<li class="nav-item">
									<a class="nav-link active" id="pills-skills-tab" data-toggle="pill" href="#pills-skills"  role="tab" aria-controls="pills-skills" aria-selected="false">Skills</a>
									<!-- <button id="more_filters_btn" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#search-modal">Search</button> -->
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-location-tab" data-toggle="pill" href="#pills-location" role="tab" aria-controls="pills-location" aria-selected="false">location</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link" id="pills-experience-tab" data-toggle="pill" href="#pills-experience" role="tab" aria-controls="pills-experience" aria-selected="false">Experience</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link" id="pills-identify-as-tab" data-toggle="pill" href="#pills-identify-as" role="tab" aria-controls="pills-identify-as" aria-selected="false">Identify As</a>
								</li>
							</ul>
						
						</div>
						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-skills" role="tabpanel" aria-labelledby="pills-skills-tab">
									<div id="table_container" class="table-responsive">
										<div class="text-center">
											<button id="more_filters_btn" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#search-modal">Search</button>
										</div>
											<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-location" role="tabpanel" aria-labelledby="pills-location-tab">
									<div id="table_container_location" class="table-responsive">
										<table id="dataTable_location" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">
									<div id="table_container_experience" class="table-responsive">
										<table id="dataTable_experience" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-identify-as" role="tabpanel" aria-labelledby="pills-identify-as-tab">
									<div id="table_container_identify_as" class="table-responsive">
										<table id="dataTable_identify_as" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /.container-fluid -->

			<!-- </div> -->
			<!-- End of Main Content -->
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
										<div class="col-md-4">
												<div class="[  ][ form-group ]">
													<label for="identify_as">Identify as:</label>
													<input id="identify_as" name="identify_as" type="text" class="form-control tagator"  value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Lesbian',
															'Gay','Bisexual','Transwoman','Transman','Queer','Pansexual','Asexual','Intersex','Gender Non-Conforming / Gender Non-Binary','other'
																]
														">
									
													<div class="invalid-tooltip">
														Please select how you identify as.
													</div>
												</div>
										</div>
										<div class="col-md-4">
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
										<div class="col-md-4">
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
										
										<div class="col-md-6">
												<div class="[  ][ form-group ]">
													<label for="key_skills">Skills</label>
													<?php
													
														$skills_array=array();
														$skill_data_page=wire('pages')->get("name=skills-matrix-data");
														$Skills_data_array=explode("|",$skill_data_page->textarea_1);
															foreach($Skills_data_array as $single_skills){
																$skills_array[]=$single_skills;
															}
														$skills_data=implode("','",$skills_array);
													?>
													<input id="key_skills" name="key_skills" type="text" class="form-control tagator"  value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[' <?=$skills_data?> ']">
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
														Please enter key skills.
													</div>
												</div>
										</div>

										
										
								</div>       
							</div>

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
	<!-- <script src="<?= $rootpath;?>scripts/datatables-export.min.js"></script> -->
	

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>
	
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>

	<!-- Copy and excel button -->
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>


	<!-- include summernote js -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> -->

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=21.04"></script>
    
</body>

</html>
