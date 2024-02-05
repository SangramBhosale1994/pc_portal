<?php
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
  {
      //Tell the browser to redirect to the HTTPS URL.
      header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
      //Prevent the rest of the script from executing.
      exit;
  }
		$job_search_data_set=[];
		$job_search_data_set['experience_years']="";
		$job_search_data_set['key_skills']="";
		$job_search_data_set['preferred_location']="";
		$job_search_data_set['job_type']="";
		$job_search_data_set['company_name']="";

		global $job_added_by;
		$job_added_by="";
		if(isset($_GET['company_id'])){
			$job_added_by=$_GET['company_id'];
		}
		$rootpath = $config->urls->templates;
		
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<!-- <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script> -->

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->

	<title><?=$page->title?> | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $urls->httpTemplates;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $urls->httpTemplates;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->
	<!-- ---------- META TAGS ---------- -->
    <meta property="og:title" content="Find a Job | Pride Circle ">
    <meta property="og:image" content='<?php echo $pages->get("name=home")->httpUrl."site/templates/images/pride_circle_logo.jpg"; ?>'>
    <meta property="og:description" content="Reimagining Inclusion for Social Equity">
    <meta property="og:url" content="<?= $page->httpUrl ?>">
    <meta property="og:type" content="article" />

    <meta name="twitter:title" content="Find a Job | Pride Circle ">
    <meta name="twitter:description" content="Reimagining Inclusion for Social Equity">
    <meta name="twitter:image" content='<?php echo $pages->get("name=home")->httpUrl."site/templates/images/pride_circle_logo.jpg"; ?>'>
    <meta name="twitter:card" content="Find a Job | Pride Circle ">

    <meta property="og:site_name" content="Find a Job | Pride Circle ">
    <meta name="twitter:image:alt" content="Find a Job | Pride Circle ">
    <!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<!--<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">-->
		<link href="<?= $urls->httpTemplates;?>styles/job-list.css?v=19.01.22" rel="stylesheet" type="text/css">
	<!-- Share button CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">
	
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/fm.tagator.jquery.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
	
	<!-- Need Share button CSS  -->
		<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">

        
	
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $urls->httpTemplates;?>scripts/jquery.min.js" type="text/javascript"></script>

	<script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js?v=14.06.2022"></script>
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<script src="<?= $urls->httpTemplates;?>scripts/fm.tagator.jquery.js?v=19.02"></script>
	  
    <!-- Suraj Gharpankar Starts-->

	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
	<!-- Suraj Gharpankar Ends -->
	<script>
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
	/></noscript>
	<!-- End Meta Pixel Code -->
	
<style>
	#pagin_top_prev{
		border-radius:0rem !important;
	}
	#pagin_top_next{
		border-radius:0rem !important;
	}
	#pagin_bottom_prev{
		border-radius:0rem !important;
	}
	#pagin_bottom_next{
		border-radius:0rem !important;
	}
	#job_container_row{
		justify-content:center;
	}
	<?php
	if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
	?>
		.header_menu_banner{
			margin-top:4.3rem;
		}
		@media (max-width:768px){
			.header_menu_banner{
				margin-top:4.9rem;
			}
		}
	<?php
		}
	?>
</style>

</head>

<body>
	<?php
	if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
			require_once 'includes/resume_header.php';
		}
	?>
	<div id="top-container" class="header_menu_banner">
		<!--<img src="<?=$urls->httpTemplates;?>images/job_desktop.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">-->

		<!--<img src="<?=$urls->httpTemplates;?>images/job_mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">-->
		
		<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[ img-fluid ]( mobile-hide ) w-100" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[ img-fluid ]( mobile-show ) w-100" alt="Pride Circle Banner Image">
		
	</div>
	<div class="[ pl-3 pr-3 ]">
		<div class="" style="margin-top: 1rem;">
				<!--<a target="_blank" href="http://zerovaega.in/pc_rportal/resume/"><button type="button" class="btn btn-sm btn-outline-info text-center btn_back_home ml-5 p-2"><i class="fa fa-angle-double-left"></i> Go Home</button></a>-->
				<h2 class="m-auto" style="text-align: center">AVAILABLE JOBS</h2>
		</div>
		<div class="[ my-5 ]">
			<div class="container mb-5 d-md-block d-none d-sm-none  d-xs-none">
				<div class="container job_search_web mb-3">
						<!-- Suraj Gharpankar Starts-->
						<div class="row">
							<div class="col-12">
								<h4 class="">Search Jobs</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-flex">
							<input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Search jobs by title, skills, companies, location" >
							<!-- <button value="submit" id="btn_quick_search" name="btn_quick_search" class=" [ btn btn-primary ]" type="button" style="margin-left:1rem;" >
							Search
							</button> -->
							<a  href="#job_card_section"  id="btn_quick_search" name="btn_quick_search" class=" [ btn btn-primary ]" style="margin-left:1rem;" >Search</a>

							</div>
						</div>
						
					<!-- <div class="[ form-group mb-4 ]">
						<input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Search jobs by job title, skills, companies, location" >
						<button value="submit" id="btn_quick_search" name="btn_quick_search" class=" [ btn btn-primary ]" type="button"  >
							Search
						</button>

					</div> -->
					<!-- <div class="col-md-4"></div>
					<div class="col-md-4">
					
					<div class="col-md-4">
				
					</div>
					<div class="col-md-4"></div> -->
					<!-- <div class="[ text-center mb-2 mt-3 ]">
						<input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Search jobs by job title, skills, companies, location" >
						<button value="submit" id="btn_quick_search" name="btn_quick_search" class=" [ btn btn-primary ]" type="button"  >
							Search
						</button>
					</div> -->
									<!-- Suraj Gharpankar Ends-->
				</div>
				<div id="Advance_search" class="card border-left-primary shadow  py-2 collapse" style="border-left: 4px solid;   border-radius: 10px;border-left-color: #007bff;">
					<div class="card-body">
						<div class="container">
							<div>
									<form id="search-container" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST"  novalidate>
											<!-- PERSONAL INFORMATION TAB -->
											<!--<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">-->
												<div class="[  ][  bg-primarya ]">
													<!-- Suraj Gharpankar Starts-->
													<h4 class="text-center">Advance Search</h4>
																	<!-- Suraj Gharpankar Ends-->
												</div>
												<div class="row">
														<div class="col-md-6">
																<div class="[  ][ form-group ]">
																	<label for="key_skills">Select your skills</label>
																	<input id="key_skills" name="key_skills" type="text" class="form-control tagator" required value="<?=$job_search_data_set['key_skills']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
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
																	<label for="preferred_location">Preferred location </label>
																	<input id="preferred_location" name="preferred_location" type="text" class="form-control tagator" required value="<?=$job_search_data_set['preferred_location']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
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
												<div class="row">
														<div class="col-md-6">
																<div class="[  ][ form-group ]">
																	<label for="experience_years">Your experience</label>
													
																	<div class="row no-gutters">
																		<div class="[ col-12 pr-2 ][ input-group ]">
																			<!--<div class="input-group-prepend">-->
																			<!--	<div class="input-group-text">Years</div>-->
																			<!--</div>-->
													
																			<select id="experience_years" class="custom-select" name="experience_years" value="<?=$job_search_data_set['experience_years'];?>">
																						<option value="unselected" selected>Please select</option>
																				<?php
																					for ($i=0; $i <= 60; $i++) {
																							$is_selected="";
																								if($job_search_data_set['experience_years']!="" && $job_search_data_set['experience_years']!="unselected" && $i==$job_search_data_set['experience_years']){
																									$is_selected=" selected ";
																							}
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
																	<label for="job_type">Job Type</label>
																	<input id="job_type" name="job_type" type="text" class="form-control tagator" required value="<?=$job_search_data_set['job_type']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Tech','Non-Tech','Internship','Full time',
																					'Part time',
																					'WFH'
																									]
																							">
																	<div class="invalid-tooltip">
																		Please enter job type.
																	</div>
																</div>
														</div>
												</div>
												<div class="row">
														
														<?php
																$job_company_array=array();
																
																
																  foreach($pages->get("name=jobs")->children("verification=verified,active_status=active") as $job_page){
																//  foreach($pages->get("name=jobs")->children() as $job_page){

																		if($job_page->job_publish_shedule!=""){
																							if($job_page->job_publish_shedule>time()){
																									continue;
																							}
																					}
																		// if($job_page->job_code=="1113"){
																		// 	continue;
																		// }
																		// if($job_page->job_code=="1107"){
																		// 	continue;
																		// }
																	// echo $recruiter_page->company_name;
																	//$recruiter_company_array1[$recruiter_page->company_name]=$recruiter_page->company_name;
																	
																	// if($recruiter_page->company_name == $recruiter_company_array1  ){
																	//     //continue;
																	//     $recruiter_company_array[]=$recruiter_page->company_name;
																	// }
																	if(in_array($job_page->company_name,$job_company_array)){
																			continue;
																	}
																	// echo $job_page->company_name;
																	$job_company_array[]=addslashes($job_page->company_name);
																	
																	// if(in_array($recruiter_page->company_name,$recruiter_company_array)){
																	//     continue;
																	// }
																	//$recruiter_company_array[]=in_array($recruiter_page->company_name,$recruiter_company_array);
																	
																	//$recruiter_company_array1[]=$recruiter_company_array;
																	
																}
																			/* here we use sort() then sort display 1st capital leeter in alphabetical order and then small letters in alphabetical order 
																	So here we use natcasesort() is case sensetive so they dispaly capital and small letter alphabetical order at a time.*/
																natcasesort($job_company_array);
																$job_company_data=implode("','",$job_company_array);
															// echo $recruiter_company_data;
															// echo $job_company_data;
															// echo "****";
																
														?>
														
														<div class="col-md-6">
																<div class="[  ][ form-group ]">
																	<label for="company_name">Company</label>
																	<!-- <input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=str_replace('"',"'",$job_search_data_set['company_name']);?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>
																									']
																							"> -->
																	<input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=str_replace('"',"'",$job_search_data_set['company_name']);?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>']
																	">
																							
																	<div class="invalid-tooltip">
																		Please enter company name.
																	</div>
																</div>
														</div>
												</div>
											
												<!--</div>-->
													<!--</div>-->
													
													<!-- Buttons Section -->
										<div class="[ text-center mb-2 mt-3 ]">
											<?php $job_page=$pages->get("name=jobs"); ?>
											<a  href="<?=$job_page->httpUrl?>"><button value="submit" name="button" class=" [ btn btn-outline-primary mr-3 ]" type="button" disable >
												Clear Filters
											</button>
											</a>
											<a  href="#job_card_section"  id="btn_search_submit" name="btn_search_submit" class=" [ btn btn-primary ]"  disable>Submit</a>
											<!-- <button value="submit" id="btn_search_submit" name="btn_search_submit" class=" [ btn btn-primary ]" type="button" disable >
												Submit
											</button> -->
													
										</div>
										<!-- Buttons Section End -->
									</form>
							</div>	
						</div>
					</div>
				</div>
				<div class="text-center">
								<!-- Code Start : Suraj Gharpankar -> Job Page Card code  17-01-22-->
											<button type="button" id="more_filters_btn_web" class="mt-4 btn btn-sm btn-outline-info text-center more_filters_btn " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction_demo()">Advance Search</button>
							<!-- Code End : Suraj Gharpankar -> Job Page Card code  17-01-22-->
					</div>
								
							
				</div>
				<!-- Mobile view -->
				<div class="container d-block d-sm-block d-md-none">
					<div class="card border-left-primary shadow  py-2 " style="border-left: 4px solid;   border-radius: 10px;border-left-color: #007bff;">
						<div class="card-body">
							<div class="align-items-center">
									<h4 class="">Search Jobs</h4>
									<div class="[ form-group mb-4 ]">
										<!-- <input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Search jobs by skills, experience, companies, location"> -->
										<input id="jobs_searchword_mobile" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Search jobs by title, skills, companies, location" >
											<!-- <button value="submit" id="btn_quick_search" name="btn_quick_search" class=" [ btn btn-primary ]" type="button" style="margin-left:1rem;" >
											Search
										</button> -->
										<a  href="#job_card_section"  id="btn_quick_search_mobile" name="btn_quick_search" class=" [ btn btn-primary ]" style="margin-top:1rem;" >Search</a>

									</div>
									
									<div id="Advance_search" class="collapse">
										<form id="search-container-mobile" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST"  novalidate>
												<!-- PERSONAL INFORMATION TAB -->
												<!--<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">-->
													<div class="[  ][  bg-primarya ]">
														<h4>Advance Search</h4>
													</div>
												
													<div class="[  ][ form-group ]">
														<label for="experience_years">Your experience</label>
										
														<div class="row no-gutters">
															<div class="[ col-12 pr-2 ][ input-group ]">
																<!--<div class="input-group-prepend">-->
																<!--	<div class="input-group-text">Years</div>-->
																<!--</div>-->
										
																<select id="experience_years" class="custom-select" name="experience_years" value="<?=$job_search_data_set['experience_years'];?>">
																			<option value="unselected" selected>Please select</option>
																	<?php
																		for ($i=0; $i <= 60; $i++) {
																				$is_selected="";
																					if($job_search_data_set['experience_years']!=""&& $job_search_data_set['experience_years']!="unselected" && $i==$job_search_data_set['experience_years']){
																						$is_selected=" selected ";
																				}
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
													
													<div class="[  ][ form-group ]">
														<label for="key_skills">Select your skills</label>
														<input id="key_skills" name="key_skills" type="text" class="form-control tagator" required value="<?=$job_search_data_set['key_skills']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
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
											
													<div class="[  ][ form-group ]">
														<label for="preferred_location">Preferred location </label>
														<input id="preferred_location" name="preferred_location" type="text" class="form-control tagator" required value="<?=$job_search_data_set['preferred_location']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
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
											
													<div class="[  ][ form-group ]">
														<label for="job_type">Job Type</label>
														<input id="job_type" name="job_type" type="text" class="form-control tagator" required value="<?=$job_search_data_set['job_type']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Tech','Non-Tech','Internship','Full time',
																		'Part time',
																		'WFH'
																						]
																				">
														<div class="invalid-tooltip">
															Please enter job type.
														</div>
													</div>

													
													<div class="[  ][ form-group ]">
														<label for="company_name">Company</label>
														<!-- <input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=str_replace('"',"'",$job_search_data_set['company_name']);?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>
																						']
																				"> -->
														<input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=str_replace('"',"'",$job_search_data_set['company_name']);?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>']
														">
																				
														<div class="invalid-tooltip">
															Please enter company name.
														</div>
													</div>
											
													<!--</div>-->
														<!--</div>-->
														
														<!-- Buttons Section -->
											<div class="[ d-flex flex-row justify-content-around mb-4 ]">
												<?php $job_page=$pages->get("name=jobs"); ?>
												<a  href="<?=$job_page->httpUrl?>"><button value="submit" name="button" class=" [ btn btn-outline-primary ]" type="button" disable >
													Clear Filters
												</button>
												</a>
											<a  href="#job_card_section"  id="btn_search_submit_mobile" name="btn_search_submit" class=" [ btn btn-primary ]"  disable>Submit</a>

											<!-- <button value="submit" id="btn_search_submit" name="btn_search_submit" class=" [ btn btn-primary ]" type="button" disable >
												Submit
												</button> -->
														
											</div>
											<!-- Buttons Section End -->
										</form>
									</div>
									<button type="button" id="more_filters_btn" class="btn btn-sm btn-outline-info text-center offset-md-2 more_filters_btn " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction()">Advance Search</button>
							</div>
						</div>
					</div>
											
				</div>
				<!-- End Mobile view -->
				 <!-- Hot Jobs -->
				 <?php

				/* Job postings in the descending order od the day they were posted. Latest first. */
				$i=1;
				// echo "hot jobs";
				// $filtered_job_pages=$pages->get("name=jobs")->children("is_hot_jobs=yes,limit=8");
			  $filtered_job_pages=$pages->get("name=jobs")->children("is_hot_jobs=yes,limit=8,verification=verified,active_status=active");
				

				if($filtered_job_pages->count()!=0){

				?>

				<div class="[ col-sm-12 job_card_section scrollable-element hot_job_section ]" style="">
					<!-- <div  class="mt-3">
						<h2 class="m-auto" style="text-align: center" >HOT JOBS</h2>
					</div> -->
					<?php
						if($job_added_by==""){
					?>
					
					<h2 class="title_font m-auto text-center pb-4 hot_job_title">
						<span class="badge title_break_style " style="text-align: center;color:white;background-color:#367475">HOT JOBS</span>
					</h2>
					<?php
						}
					?>
					<div class="[ row ]">

					<?php
					
							// if($filtered_job_pages->count()==0){
							//     echo "<h3 class='text-center m-auto'>No results found</h3>";
							// }

							
							$job_page_counter = 0;
							// print_r($filtered_job_pages);
							// echo "////";

							foreach ($filtered_job_pages as $job_page) {
								// echo $job_page;
									if($job_page->max_experience !=0 && isset($experience_years)){
											if($experience_years>$job_page->max_experience){
												// echo "11***";
												// echo $job_page;
													continue;
											}
											
									}
									//echo $job_page->job_publish_shedule!="";
									//echo "+++++++++++++++++++++++++++";
									if($job_page->job_publish_shedule!=""){
											if($job_page->job_publish_shedule>time()){
												// echo "12---";
												// echo $job_page;
													continue;
											}
									}

									if($job_added_by!=""){
										if($job_page->job_added_by!=$job_added_by){
											continue;
										}
									}

									// echo "13+++";
									// echo $job_page;
									$job_page_counter++;

									$is_visible = "";
									// if($job_page_counter>24){
									//     $is_visible = " display:none ";
									// }
							//foreach ($pages->get("name=jobs")->children("max_experience>=1") as $job_page) {
					
					?>
					<div class="( hot_job-card-container )[ my-3 ][ <?=$job_page_counter?> ][ col-md-6  col-lg-4 col-xl-3 ]" style="<?=$is_visible?>">
							<!-- Suraj Gharpankar Starts :  To add link to all section in Card-->
									<a href="<?=$job_page->httpUrl?>" target="_blank" style="text-decoration:none">

							<!-- Suraj Gharpankar Ends :  To add link to all section in Card-->
							<div class="[ card ]">
									
									
									<span class="[ px-3 ][ badge badge-danger ] hot_job_badge" style="position: absolute;  top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">Hot Job</span>
									
										<div class="card-body textcolor job_card_body">
												<!--
														Sameesh yadav for 6-march-2021
														to add image in card of jobs     
												-->
												</a>
												<div class="container pt-1 m-0" style="padding-right: 5px;">
															
														<div class="row ">
																<div class="col-4 col-md-4 my320px" style="padding-left: 0px;">     
																		<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$job_page->job_code?></span></p> 
																</div>      

																<!-- Code Starts:  Suraj Gharpankar : Tooltip and Message changes : 21-01-22 -->   
																<div class="col-8 col-md-8 text-center">
																	<div class="share-button iphonese allphones text-right">
																			<span><i class="fas fa-share-alt mr-3"></i></span>
																			<a target="_blank" href="mailto:?subject=Pride Circle Job Portal&message=message?&body=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal - <?=$job_page->httpUrl?>"  title="Share on Mail" data-toggle="tooltip" data-placement="top"><i class="fas fa-envelope-open-text"></i></a>
																			<a target="_blank" href="https://api.whatsapp.com/send?text=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal- <?=$job_page->httpUrl?>" title="Share on WhatsApp" data-toggle="tooltip" data-placement="top"><i class="fab fa-whatsapp" style="color: #075E54;"></i></i></a>
																			<a target="_blank" href="https://twitter.com/intent/tweet?url=<?=$job_page->httpUrl?>&text=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal- " title="Share on Twitter" data-toggle="tooltip" data-placement="top"><i class="fab fa-twitter" style="color: #1DA1F2;"></i></a>
																			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$job_page->httpUrl?>" value="" title="Share on Facebook" data-toggle="tooltip" data-placement="top"><i class="fab fa-facebook-f" style="color: #4267B2;"></i></a>
																			<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$job_page->httpUrl?>&title=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal-" value="" title="Share on Linkedin" data-toggle="tooltip" data-placement="top"><i class="fab fa-linkedin-in" style="color: #0e76a8;"></i></a>
																			<!-- Code Starts:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
																			<a id="share_button_<?=$job_page->id?>" value="" title="Copy Link" data-toggle="tooltip" data-placement="top" ><i class="far fa-copy copy_link" title="<?=$job_page->httpUrl?>" style="color: black;"></i> </a>
																			<!-- Code Ends :  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->  
																	</div>
															</div>
															<!-- Code Ends:  Suraj Gharpankar : Tooltip and Message changes : 21-01-22 -->   

														</div>
														<a href="<?=$job_page->httpUrl?>" target="_blank" style="text-decoration:none">              

														<div class="row align-items-center" style="   height:98px;overflow: hidden ">

																<?php
																		/**
																			* firt check if image in job page if null then add default vaue
																			* $image to store image url
																			*/
																		if ($job_page->job_image != null) {
																				$image = $job_page->job_image->httpUrl;
																										} else {
																				$image = $rootpath . "images/job_card_Logo_new.png";
																		}
																?>
																<?php
																$company_profile_present="false";
																$recruiter_page=$pages->get("name=recruiters")->child("company_name="."'".$job_page->company_name."'");
																	if($recruiter_page->recruiter_accessible_sections!=""){
																		foreach($recruiter_page->recruiter_accessible_sections as $accessible_sections){
																			/*check accessible sections id into accessible sections id array
																				check accessible sections name into accessible sections array */
																			if($accessible_sections->name=="recruiter-company-profile"){
																				// echo "1";
																				$company_profile_present="true";
																			}
																		}
																	}
																	if($company_profile_present=="true"){
																	?>
																	<a href="<?=$pages->get('name=company-profile')->httpUrl?>?name=<?=$job_page->company_name?>">
																		<img src="<?=$image?>" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
																	<a>
																	<?php
																	}
																	else{
																	?>
																		<img src="<?=$image?>" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
																	<?php
																	}
																?>
																
														</div>
												</div>
												<!--
														code ends here
												-->
												<h5 class="[ card-title] text_color" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=htmlspecialchars_decode(htmlspecialchars_decode($job_page->title))?></h5>

												<!-- Code Start : Suraj Gharpankar : Changed "mb-3" to "mb-2" : Remove spaceing between Posted at and years of experience : 24-01-22 -->
												<h6 class="[ mb-2 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> At <?=$job_page->company_name?>
											<!-- Code Start : Suraj Gharpankar : Changed "mb-3" to "mb-2" : Remove spaceing between Posted at and years of experience : 24-01-22 -->
											<br>
												Posted on <?=date("d M Y", $job_page->created)?> </h6>

														

												<!--/* Existing system user experience save to experience field but in new system minimum experience save in min_experience field and maximum experience save in max_experience field .
												so existing system experience saving min and max experience field */-->


												<!-- <p class="card-text"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i> 
												<?php if ($job_page->min_experience == "") {
														echo $job_page->experience;} else {echo $job_page->min_experience;}?><?php if ($job_page->max_experience != 0) {
														echo "-" . $job_page->max_experience;
												}
												?> 
												<?php if ($job_page->min_experience != "") {echo "Years";}?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i> <?=$job_page->location?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $job_page->created) + date("H", time()) ?> Views Today</p>-->
														<?php $job_location = array_map('trim', array_filter(explode(",", $job_page->location)));

												$job_location = implode(", ", $job_location);

												?>

												<p class="card-text text_color" style="margin-bottom: 8px;"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i><?=$job_page->min_experience?><?php if ($job_page->max_experience != 0) {
														echo "-" . $job_page->max_experience;
												}
												?> Year<?php if ($job_page->min_experience != 1) {
														echo 's';
												}
												?> <br>

												</p>
														<p class="text_color"style="margin-bottom: 8px"><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt "></i><?=$job_location?><br>
												</p>


												<!-- Start - Suraj Gharpankar : 22-01-22 : Know More button alignment -->
												<div class="row" style="display: flex;justify-content: space-between;">
															
														<div class="col-7 col-md-7 text_color" style="max-width:100%">    
																		<i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i>
																	<?php 
																			$job_created_time=$job_page->created;
																			// echo "created job date";
																			// echo $job_created_time;
																			$display_views_after_24_hours=$job_created_time+24*60*60;
																			// echo "**********";
																			// echo $display_views_after_24_hours;
																			$current_timestamp=strtotime(date("d-m-Y"));
																			//echo "+++++".$current_timestamp;
																			if($job_created_time<$current_timestamp){

																					echo date("H", $job_page->created) + date("H", time());
																			}
																			else{
																					echo "0";
																			}
																	?> Views Today</p> 
														</div>

														<div class="col-5 col-md-5 justify-content-center" style="padding-left: 0px;">
																<div class="[ d-flex]" style="text-align:right" >
																				<a href="<?=$job_page->httpUrl?>" target="_blank" style="width:6rem;margin-left: 10px;" class="[ card-link ][  btn btn-outline-primary ] job_know_more_btn">Know More</a>
																</div>
														</div>
												</div>
												<!-- Ends - Suraj Gharpankar : 22-01-22 : Know More button alignment -->

										</div>
									<!-- end card body-->
									</a>
							</div>
						</div>
					<?php
									$i++;
							}
					?>

					</div>
				</div>
				<?php
				}
				?>

				<!-- End Hot Jobs -->
				<div id="job_card_section" class="[ col-sm-12 job_card_section scrollable-element ]" style="">
					<div  class="mt-5">
						<ul id="paginTop" class="pagination justify-content-center overflow-auto">

						</ul>
					</div>
					<div id="job_container_row" class="[ row ]">
					</div>     
					<div class="mt3">
							<ul id="paginBottom" class="pagination justify-content-center ">
									
							</ul>
					</div>
				</div>
			</div>
		</div>
  </div>

<!-- Code by : Suraj Gharpankar -> Job page Modal code -->

<!-- Modal -->
<div class="modal fade" id="login_popup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content mymodal">
      <div class="" style="background-color: #4e73df;border-top-left-radius: 4px; border-top-right-radius: 4px;">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white; margin-right: 10px; margin-top: 2px; font-size: 2rem;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php 
        $modal_details=$pages->get("name=jobs");
      
        $oauth_gmail=$session->oauth_gmail;
        //echo $oauth_gmail;
        if($oauth_gmail==""){
        ?>
      <div class="modal-body bg-light" style="padding: 0px; padding-bottom: 15px; align:center;border-bottom-left-radius:4px; border-bottom-right-radius:4px;">
        <div class="job_modal_logged" style="padding-bottom: 34px; padding-top: 1px; background-color: #4e73df;">
          <div class="text-center" style="">
            <!-- <h5 style="padding-left:17.5rem; color:white" class="mt-1 modal-title" id="exampleModalLabel">Not Logged Yet?</h5> -->
            <h2 class="mt-1 modal-title mymodaltext" id="exampleModalLabel"><?=$modal_details->modal_title?> </h2>
        
                <a target="_blank" href="<?=$pages->get("name=resume")->httpUrl?>">
                    <button type="button" class="btn  myloginbtn " >Log in</button>
                </a> 
        </div>
          <!-- <div>
            <a style="padding-left:1.4em;" class="<?=$pages->get("name=resume")->httpUrl?>">
                <button type="button" class="btn btn-primary">Log in</button>
            </a>
          </div> -->
        </div>
        
        <div class="mt-1" style="padding-bottom: 10px; padding-top: 8px; padding-bottom: 14px;border-bottom-left-radius: 4px;">
            <!-- <h5 style="padding-left:1rem;" class="job_modal_user_filter">I am a -</h5> -->
            <h3 style="padding-top:0.5rem ;text-align:center ;" class="job_modal_user_filter "><?=$modal_details->modal_sub_title?></i></i></h3>
            <div class="d-flex" style="justify-content: space-evenly;">
                <!-- <a href="<?=$page->httpUrl?>?excep=0-1">
                    <button class="btn btn-outline-primary btn_filter_fresher custombtn" styles="padding-bottom:1px"><i class="fas fa-user-graduate"></i> Fresher</button>
                </a> -->
								<a  href="#job_card_section"  id="btn_login_fresher" name="btn_login_fresher" class="btn btn-outline-primary btn_filter_fresher custombtn" styles="padding-bottom:1px"><i class="fas fa-user-graduate"></i>Fresher</a>
                <a href="<?=$page->httpUrl?>">
                    <button class="btn btn-outline-primary custombtn"><i class="fas fa-user-tie"></i> Professional</button>
                </a>
            </div>
        </div>

      </div>
      <?php
            }else{
        ?>
        <div class="modal-body bg-light" style="padding: 0px; padding-bottom: 15px; align:center">
            <div class="mt-1" style="padding-bottom: 10px; padding-top: 8px; padding-bottom: 14px">
                <!-- <h5 style="padding-left:1rem;" class="job_modal_user_filter">I am a -</h5> -->
                <h3 style="padding-top:0.5rem ;text-align:center ;" class="job_modal_user_filter "><b><?=$modal_details->modal_sub_title?></b></i></i></h3>
                <div class="d-flex" style="justify-content: space-evenly;">
                    <!-- <a href="<?=$page->httpUrl?>?excep=0-1">
                        <button class="btn btn-outline-primary btn_filter_fresher custombtn" styles="padding-bottom:1px"><i class="fas fa-user-graduate"></i> Fresher</button>
                    </a> -->
										<a  href="#job_card_section"  id="btn_login_fresher" name="btn_login_fresher" class="btn btn-outline-primary btn_filter_fresher custombtn" styles="padding-bottom:1px"><i class="fas fa-user-graduate"></i>Fresher</a>

                    <a href="<?=$page->httpUrl?>">
                        <button class="btn btn-outline-primary custombtn"><i class="fas fa-user-tie"></i> Professional</button>
                    </a>
                </div>
            </div>

        </div>
      <?php
      }
      ?>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Code ended by : Suraj Gharpankar -> Job page modal code -->

	<!-- <script src="<?=$config->urls->templates?>scripts/needsharebutton.min.js"></script> -->
	<script>
		
		<?php
			//foreach ($filtered_job_pages as $job_page) {
		?>

		// new needShareDropdown(document.getElementById("share-button-<?=$job_page->id?>"), {
		//     //console.log($job_page->id);
		// 	url: "<?=$job_page->httpUrl?>",
		// 	title: "Check this job opening on Pride Cricle now!",
		// 	description: "Click on the link and log in to apply."
		// });

		<?php
		//	}
		?>

	</script>

        <!-- <script src="<?=$urls->httpTemplates;?>scripts/jquery.min.js"></script>
        <script src="<?=$urls->httpTemplates;?>scripts/popper.min.js"></script>
        <script src="<?=$urls->httpTemplates;?>scripts/bootstrap.min.js"></script> -->

         <!-- Code Starts:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
  <script>
	    $(document).on('click', '.copy_link', function(){
	        //console.log("$page->httpUrl");
            var job_page_url=$(this).prop("title");
           // console.log(job_page_url);
            let copy_text=job_page_url;
            //console.log(copy_text);
            Clipboard_CopyTo(copy_text);
        });
        function Clipboard_CopyTo(value) {
          var tempInput = document.createElement("input");
          tempInput.value = value;
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand("copy");
          document.body.removeChild(tempInput);
        }
        /*End copy link using js*/
	</script>
     <!-- Code Ends:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
<?php
$show_popup=1;
if(isset($_GET['company_id'])){
	$show_popup=0;
}
?>

    <script>
        // $(window).on("load", function () {
        //     $("#exampleModal").show();
        // });
        // $('#myModal').on('shown.bs.modal', function () {
        //     $('#myInput').trigger('focus');
        // });
        $(document).ready(function(){ 
				let show_popup=<?=$show_popup?>;
				     
		// checkCookie();
		let user = getCookie("username");
		if (user != "" || show_popup==0 ) {
			
			$('#login_popup_modal').modal('hide');
		} else {
			user = 'login_popup_land';					
			$('#login_popup_modal').modal('show');
            setCookie("username", user, 5);

		}
		
	});

	let cname = "login_popup";
	let cvalue = 'login_popup_land';
	let exdays = 5;
	
	function setCookie(cname,cvalue,exdays) {
		const d = new Date();
        //cookie set for one minute
		d.setTime(d.getTime() + (60 * 30000));
        //cookie set for one week
        
        // Suraj Gharpankar : Comment this line to avoid modal reappering after clickin on Fresher or Professional button : 27-01-22
        //d.setTime(d.getTime() + (expDays * 24 * 60 * 60 * 1000));
		let expires = "expires=" + d.toGMTString();


		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";	
    }

	function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
			c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
			}
		}
	return "";
	}

    </script>

    <!-- Copy Link Script -->
    <script>
        $(document).on('click', '#copy_link', function(){
            //console.log("$page->httpUrl");
            let copy_text="<?php echo $job_page->httpUrl;?>";
            Clipboard_CopyTo(copy_text);
        });
        function Clipboard_CopyTo(value) {
        var tempInput = document.createElement("input");
        tempInput.value = value;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        }


        // Code Starts:  Suraj Gharpankar : Tooltip : 24-01-22 -->   
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // Code Ends:  Suraj Gharpankar : Tooltip : 24-01-22 -->    
    </script>
    <!-- End Copy Link Script --> 
    
	<!-- <script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js?22-04"></script> -->
	<!-- Script for header -->
	<script src="<?= $rootpath;?>scripts/tweetjs.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$(document).on("click", "#navbarNav .nav-link", function(){
			if(!$("#navbar-toggler").hasClass("collapsed")){
				$("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
			}
		})

	})
</script>
<!-- Script for header -->
<?php
include 'includes/job_footer.php';
require  $config->paths->templates.'includes/sticky-footer.php';
?>

<?php
require $config->paths->templates.'includes/footer.php';
?>
