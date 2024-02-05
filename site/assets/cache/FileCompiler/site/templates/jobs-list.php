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
 require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
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
				<h2 class="m-auto" style="text-align: center">Find your dream job now</h2>
				<h3 class="m-auto" style="text-align: center">Over 500 jobs to explore</h3>
		</div>
		<div class="[ my-5 ]">
			<div class="container mb-5 d-md-block">
				<div class="container job_search_web mb-3">
						<!-- Suraj Gharpankar Starts-->
						<!--<div class="row">-->
						<!--	<div class="col-12">-->
						<!--		<h4 class="">Search Jobs</h4>-->
						<!--	</div>-->
						<!--</div>-->
						<div class="row">
							<form action="<?php echo $pages->get("name=jobs-search")->httpUrl; ?>" method="get" class="col-12 d-md-flex">
    							<input id="jobs_searchword" class="[ form-control mb-2 ]" type="text" name="jobs_searchword" placeholder="Enter skills / designations / companies" >
    							<select id="experience_years" class="custom-select  mb-2" name="experience_years" value="<?=$job_search_data_set['experience_years'];?>">
    										<option value="" class="text-muted" selected>Select Experience</option>
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
    						    <input id="preferred_location" name="preferred_location" type="text" placeholder="Location" class="form-control tagator  mb-2" value="<?=$job_search_data_set['preferred_location']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="[
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
						
						

    							<button type="submit" class=" [ btn btn-primary badge-pill px-4 ]" style="margin-left:1rem;">Search</button>

							</form>
						</div>
						
									<!-- Suraj Gharpankar Ends-->
				</div>
				
				<div class="text-center">
				    <a href="<?php echo $pages->get("name=resume")->httpUrl;?>" style="color:black; text-decoration:underline;"><i class="[  mr-1 ] fas fa-fw fa-cloud-upload-alt"></i>Upload your Resume</a> - Get Hired by Inclusive Employers 
				</div>
				<!-- Mobile view -->
				<!-- End Mobile view -->
				
				<div class="d-flex row justify-content-center mt-4">
				    <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?fresher=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#ffffff; background-color:#ff0000">Fresher <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div>
				    <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?internship=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#000; background-color:#ffc000">Internship <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div>
				    <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?remote=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#ffffff; background-color:#00b050">Remote Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div>
				    <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?hot_jobs=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#ffffff; background-color:#00b0f0">Hot Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div>
				    <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?other=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#ffffff; background-color:#8548a6">Other Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div>
				    <!-- <div class="col-md-2 px-1">
				        <a href="<?php echo $pages->get("name=jobs-search")->httpUrl."?rise_jobs=true";?>" class="text-center text-center d-flex align-items-center justify-content-center" style="height: 2rem; color:#ffffff; background-color:#f5a9b8">RISE Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></a>
			        </div> -->
				</div>
				
                <?php
			        $company_pages =$pages->get("recruiters")->children("sort=sort,text_1=yes");
			        if(count($company_pages)){
			            
			    ?>
				<div class="mt-5">
				    <h3 class="text-center">Featured companies actively hiring</h3>
				    <div class="d-flex row justify-content-center ">
    				    <?php
    				        foreach($company_pages as $company_page){
    				            $company_logo = "#";
    				            if($company_page->footer_logo){
    				                $company_logo = $company_page->footer_logo->httpUrl;
    				            }
    				            
    				            $company_url = $company_page->httpUrl;
    				            
    				    ?>
    				    <div class="col-md-2 px-1">
    				        <div class="" style="border:1px solid #e2e2e2; border-radius: 10px">
    				            <div><img class="img-fluid" style="width:100%; height:auto;" src="<?=$company_logo?>"></div>
    				            <!--<div class="text-center" style="margin-top:1rem;"><strong><?=$company_page->title?></strong></div>-->
    				            <div class="text-center" style="margin-top: 10px;"><a href="<?=$company_url?>" class="btn badge-pill px-3 mb-2" style="background-color:#edf4ff; color:#8d9bf8; font-size: 13px;">View Jobs</a></div>
    				        </div>
    			        </div>
    			        <?php
    				        }
    				    ?>
    				    <!--<div class="col-md-2 px-1">-->
    				    <!--    <div class="" style="border:1px solid #e2e2e2; border-radius: 20px">Internship <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></div>-->
    			     <!--   </div>-->
    				    <!--<div class="col-md-2 px-1">-->
    				    <!--    <div class="" style="border:1px solid #e2e2e2; border-radius: 20px">Remote Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></div>-->
    			     <!--   </div>-->
    				    <!--<div class="col-md-2 px-1">-->
    				    <!--    <div class="" style="border:1px solid #e2e2e2; border-radius: 20px">Hot Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></div>-->
    			     <!--   </div>-->
    				    <!--<div class="col-md-2 px-1">-->
    				    <!--    <div class="" style="border:1px solid #e2e2e2; border-radius: 20px">Other Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></div>-->
    			     <!--   </div>-->
    				    <!--<div class="col-md-2 px-1">-->
    				    <!--    <div class="" style="border:1px solid #e2e2e2; border-radius: 20px">RISE Jobs <i class="fas fa-angle-right ml-2" style="height: 18px;font-size: 20px;"></i></div>-->
    			     <!--   </div>-->
				    </div>
				</div>
				 <?php
			        }
			            
			    ?>
				<div class="mt-5">
				    <h4 class="text-center mb-4">Top Career Advice</h4>
				    <div class="[ mt-2 mb-3 row d-flex justify-content-center ]">
                        <?php
                            for($i=0; $i<3; $i++){
                        
                        ?>
                        <div class="[ col-4 my-1 ]">
                            <div class="article-container">
                                <a href="#">
                                    <img src="https://www.thepridecircle.com/site/assets/files/35301/attract_mobile.png" class="article-img img-fluid">
                                    <div class="overlay">
                                        <div class="article-title"> <strong>Article Title here. </strong></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
				    <!--<div class="row">-->
				    <!--    <div class="col-md-4">-->
				    <!--        <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
				    <!--            <div>-->
				    <!--                <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35301/attract_mobile.png">-->
				    <!--            </div>-->
				    <!--            <div class="p-2" style="font-size: 15px;line-height: normal;">-->
				    <!--                <div style="margin-bottom:10px">Gender Inclusiveness: Attract and Retain with Affirmative and Responsive Policies</div>-->
				    <!--                <a class="mt-1" href="https://www.thepridecircle.com/articles/gender-inclusiveness-attract-and-retain-with-affirmative-and-responsive-policies/">Read more</a>-->
				    <!--            </div>-->
				               
				    <!--        </div>-->
				    <!--    </div>-->
				    <!--    <div class="col-md-4">-->
				    <!--        <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
				    <!--            <div>-->
				    <!--                <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35300/job_fair_mobile.png">-->
				    <!--            </div>-->
				    <!--            <div class="p-2" style="font-size: 15px;line-height: normal;">-->
				    <!--                <div style="margin-bottom:10px">A Job Fair Exclusively for LGBT+ People (reposted from Gaylaxy Mag)</div>-->
				    <!--                <a class="mt-1" href="https://www.thepridecircle.com/articles/a-job-fair-exclusively-for-lgbt-people-reposted-from-gaylaxy-mag/">Read more</a>-->
				    <!--            </div>-->
				               
				    <!--        </div>-->
				    <!--    </div>-->
				    <!--    <div class="col-md-4">-->
				    <!--        <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
				    <!--            <div>-->
				    <!--                <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35163/why_we_rise_mobile.png">-->
				    <!--            </div>-->
				    <!--            <div class="p-2" style="font-size: 15px;line-height: normal;">-->
				    <!--                <div style="margin-bottom:10px">Why We RISE</div>-->
				    <!--                <a class="mt-1" href="https://www.thepridecircle.com/articles/why-we-rise/">Read more</a>-->
				    <!--            </div>-->
				               
				    <!--        </div>-->
				    <!--    </div>-->
				    <!--</div> -->
				    
				</div>
				
				
				<div class="mt-5">
				    <h4 class="text-center mb-4">Featured Articles</h4>
				    <div class="[ mt-2 mb-3 row d-flex justify-content-center ]">
                        <?php
                            for($i=0; $i<2; $i++){
                        
                        ?>
                        <div class="[ col-4 my-1 ]">
                            <div class="article-container">
                                <a href="#">
                                    <img src="https://www.thepridecircle.com/site/assets/files/35301/attract_mobile.png" class="article-img img-fluid">
                                    <div class="overlay">
                                        <div class="article-title"> <strong>Article Title here. </strong></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
					<!--    <div class="row d-flex justify-content-center">-->
					<!--        <div class="col-md-4">-->
					<!--            <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
					<!--                <div>-->
					<!--                    <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35301/attract_mobile.png">-->
					<!--                </div>-->
					<!--                <div class="p-2" style="font-size: 15px;line-height: normal;">-->
					<!--                    <div style="margin-bottom:10px">Gender Inclusiveness: Attract and Retain with Affirmative and Responsive Policies</div>-->
					<!--                    <a class="mt-1" href="https://www.thepridecircle.com/articles/gender-inclusiveness-attract-and-retain-with-affirmative-and-responsive-policies/">Read more</a>-->
					<!--                </div>-->
					               
					<!--            </div>-->
					<!--        </div>-->
					<!--        <div class="col-md-4">-->
					<!--            <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
					<!--                <div>-->
					<!--                    <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35300/job_fair_mobile.png">-->
					<!--                </div>-->
					<!--                <div class="p-2" style="font-size: 15px;line-height: normal;">-->
					<!--                    <div style="margin-bottom:10px">A Job Fair Exclusively for LGBT+ People (reposted from Gaylaxy Mag)</div>-->
					<!--                    <a class="mt-1" href="https://www.thepridecircle.com/articles/a-job-fair-exclusively-for-lgbt-people-reposted-from-gaylaxy-mag/">Read more</a>-->
					<!--                </div>-->
					               
					<!--            </div>-->
					<!--        </div>-->
					        <!--<div class="col-md-4">-->
					        <!--    <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">-->
					        <!--        <div>-->
					        <!--            <img class="img-fluid" src="https://www.thepridecircle.com/site/assets/files/35163/why_we_rise_mobile.png">-->
					        <!--        </div>-->
					        <!--        <div class="p-2" style="font-size: 15px;line-height: normal;">-->
					        <!--            <div style="margin-bottom:10px">Why We RISE</div>-->
					        <!--            <a class="mt-1" href="https://www.thepridecircle.com/articles/why-we-rise/">Read more</a>-->
					        <!--        </div>-->
					               
					        <!--    </div>-->
					        <!--</div>-->
					<!--    </div> -->
				    
				</div>
				
				<div class="mt-5">
				    <h4 class="text-center">OUR GOAL FOR YOU: MORE INTERVIEWS</h4>
                    <div class="text-center mb-4">Consult Pride Circle's Hiring experts to modify your resume</div>
				    <div class="row">
				        <div class="col-md-4">
				            <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">
				                <div class="text-center py-3 px-3">
				                   <strong>BASIC</strong>
				                   <div class="mt-1">INR 500</div>
				                   <div style="margin-top: 20px;">
				                       <i class="fas fa-pen"></i><br>
				                       <span style="font-size:10px">Resume Only</span>
				                   </div>
				                </div>
				            </div>
				            <div class="p-2" style="font-size: 15px;line-height: normal;">
				                    Resume professionally written by an Expert Resume Writer
				                    <ul style="padding-left: 15px;">
				                        <li>Custom resume unique to your skills and career goals</li>
				                        <li>Keyword-rich to match job postings Optimized to pass recruiters' screening software</li>
				                        <li>Provided in Word format</li>
				                        <li> Delivered in 5 business days</li>
				                    </ul>
				                    60-day 100% satisfaction guarantee. If you're not happy, we'll rewrite it for free.
				                </div>
				        </div>
				        
				        <div class="col-md-4">
				            <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">
				                <div class="text-center py-3 px-3">
				                   <strong>INTERMEDIATE</strong>
				                   <div class="mt-1">INR 1,000</div>
				                   <div style="margin-top: 20px;" class="d-flex justify-content-center">
				                       <div class="mx-1">
				                           <i class="fas fa-pen"></i><br>
                                            <span style="font-size:10px">Resume</span>
				                       </div>
				                       <div class="mx-1">
				                           <i class="far fa-file-alt"></i><br>
				                           <span style="font-size:10px">Cover Letter</span>
				                       </div>
				                   </div>
				                </div>
				            </div>
				            <div class="p-2" style="font-size: 15px;line-height: normal;">
				                    Resume professionally written by an Expert Resume Writer
				                    <ul style="padding-left: 15px;">
				                        <li>Custom resume unique to your skills and career goals</li>
				                        <li>Keyword-rich to match job postings Optimized to pass recruiters' screening software</li>
				                        <li>Provided in Word format</li>
				                        <li> Delivered in 5 business days</li>
				                    </ul>
				                    
				                    Cover letter for one target job title
                                    <ul style="padding-left: 15px;">
				                        <li>Expertly written to capture an employer's attention</li>
				                        <li>Showcases your unique value proposition</li>
				                        <li>Provides a compelling call to action</li>
				                    </ul>
				                     60-day 100% satisfaction guarantee. If you're not happy, we'll rewrite it for free.
				                    
				                    
				                </div>
				        </div>
				        
				        <div class="col-md-4">
				            <div class="mx-2" style="border:1px solid #e2e2e2; border-radius:10px">
				                <div class="text-center py-3 px-3">
				                   <strong>PRO</strong>
				                   <div class="mt-1">INR 2,000</div>
				                   <div style="margin-top: 20px;" class="d-flex justify-content-center">
				                       <div class="mx-1">
				                           <i class="fas fa-pen"></i><br>
                                            <span style="font-size:10px">Resume</span>
				                       </div>
				                       <div class="mx-1">
				                           <i class="far fa-file-alt"></i><br>
				                           <span style="font-size:10px">Cover Letter</span>
				                       </div>
				                       
				                       <div class="mx-1">
				                           <i class="fab fa-linkedin"></i><br>
				                           <span style="font-size:10px">Linkedin Makeover</span>
				                       </div>
				                       
				                   </div>
				                </div>
				            </div>
				            <div class="p-2" style="font-size: 15px;line-height: normal;">
				                    Resume professionally written by an Expert Resume Writer<br><br>
				                    Cover letter for one target job title<br><br>
				                    LinkedIn makeover
                                    <ul style="padding-left: 15px;">
				                        <li>Includes a professional summary to reflect your strengths</li>
				                        <li>Search optimized with keywords that highlight your top skills</li>
				                        <li>Helps you create a consistent professional image and brand</li>
				                    </ul>

				                     60-day 100% satisfaction guarantee. If you're not happy, we'll rewrite it for free.
				                </div>
				        </div>

				    </div> 
				    
				</div>
  		
			</div>
		</div>
  </div>

<!-- Code by : Suraj Gharpankar -> Job page Modal code -->

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
 include(\ProcessWire\wire('files')->compile('includes/job_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/sticky-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>

<?php
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
