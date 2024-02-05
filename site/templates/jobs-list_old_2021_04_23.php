<?php
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
//     //Tell the browser to redirect to the HTTPS URL.
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
//     //Prevent the rest of the script from executing.
//     exit;
// }
// $temp=$pages->get("name=jobs")->children("location*=Agrtala|Ahmadnagar");
// print_r($temp);


		$job_search_data_set=[];
		$job_search_data_set['experience_years']="";
		$job_search_data_set['key_skills']="";
		$job_search_data_set['preferred_location']="";
		$job_search_data_set['job_type']="";
		$job_search_data_set['company_name']="";

        $filter_selector_array=["sort=-published"];
	    $cards_filter="sort=-published";
	
	if(isset($_GET['company_id'])){
			
	    $filter_selector_array[]="job_added_by*=".$_GET['company_id'];
	}
	
        
    if (isset($_POST['submit'])){
        
        $job_search_data_set['experience_years']=$sanitizer->text($input->post->experience_years);
		$job_search_data_set['key_skills']=$sanitizer->text($input->post->key_skills);
		$job_search_data_set['preferred_location']=$sanitizer->text($input->post->preferred_location);
		$job_search_data_set['job_type']=$sanitizer->text($input->post->job_type);
		$job_search_data_set['company_name']=$sanitizer->text($input->post->company_name);

	   
	    
		$experience_years = $sanitizer->text($input->post->experience_years);
// 		$experience_years_array=[];
// 		$experience_years_array['experience_years']=$experience_years;
//echo $experience_years;
		
		if($experience_years!="" && $experience_years!="unselected"){
		   // $max_filter="max_experience==0";
		  //  if(!$max_filter){
		  //       $filter_selector_array[]="max_experience>=".(int)$experience_years;
		  //  }
		  // $filter_selector_array[]="max_experience>=".(int)$experience_years;
		    $filter_selector_array[]="min_experience<=".(int)$experience_years;
		    
		}
		
		$key_skills = $sanitizer->text($input->post->key_skills);
		$key_skills_array=[];
		$key_skills_array['key_skills']=$key_skills;
		
		if($key_skills!=""){
		    $skills_array=array();
		    $skills_array=array_map('trim', array_filter(explode(",",$key_skills)));
		    $skills_implode_data=implode("|",$skills_array);
		    $filter_selector_array[]="skills%=".$skills_implode_data;
		}
		
		$preferred_location = $sanitizer->text($input->post->preferred_location);
		if($preferred_location!=""){
		    $preferred_location_array=array();
		    $preferred_location_array=array_map('trim', array_filter(explode(",",$preferred_location)));
		    $preferred_location_implode_data=implode("|",$preferred_location_array);
		    $filter_selector_array[]="location%=".$preferred_location_implode_data;
		}
		
		$job_type=$sanitizer->text($input->post->job_type);
		if($job_type!=""){
		    $job_type_array=array();
		    $job_type_array=array_map('trim', array_filter(explode(",",$job_type)));
		    $job_type_implode_data=implode("|",$job_type_array);
		    $filter_selector_array[]="job_type%=".$job_type_implode_data;
		}
		
		$company_name=$sanitizer->text($input->post->company_name);
		if($company_name!=""){
		    $company_name_array=array();
		    $company_name_array=array_map('trim', array_filter(explode(",",$company_name)));
		  //  print_r(explode(",",$company_name));
		  //  echo "---------------------------";
		  //  print_r($company_name_array);
		    $company_name_implode_data=implode("|",$company_name_array);
		  //  echo "******************************";
		  //  print_r($company_name_implode_data);
		    
		    $filter_selector_array[]="company_name=".$company_name_implode_data;
		  //  echo "company_name=".$company_name_implode_data;
		  //  print_r($filter_selector_array);
		}
		
		//print_r(implode(",",$filter_selectors));
		
		//echo $filter_selector;

//         foreach ($pages->get("name=jobs")->children($filter_selector) as $job_page) {
// 		  //  echo $job_page;
		    
// 		  //  echo "<br>";
// 		}
			
	
		
	
	}

    $filter_selector=implode(",",$filter_selector_array);
	$rootpath = $config->urls->templates;

?><!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->

	<title><?=$page->title?> | Pride Circle</title>

	<!--<link rel="shortcut icon" type="image/png" href="<?= $urls->httpTemplates;?>images/frontend/favicon.png"/>-->

	<link rel="icon" href="<?= $urls->httpTemplates;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<!--<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">-->
		<link href="<?= $urls->httpTemplates;?>styles/job-list.css" rel="stylesheet" type="text/css">
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
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	
	
	
	
	
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<script src="<?= $urls->httpTemplates;?>scripts/fm.tagator.jquery.js"?v=19.02></script>
	<script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js"></script>
	

	<!-- ---------- JS LINKS END ---------- -->
</head>

<body>
	<div id="top-container">
		<img src="<?=$urls->httpTemplates;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$urls->httpTemplates;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<div class="[ pl-3 pr-3 ]">
	    <div class="">
	        <!--<a target="_blank" href="http://zerovaega.in/pc_rportal/resume/"><button type="button" class="btn btn-sm btn-outline-info text-center btn_back_home ml-5 p-2"><i class="fa fa-angle-double-left"></i> Go Home</button></a>-->
	        <h2 class="m-auto" style="text-align: center">AVAILABLE JOBS</h2>
	    </div>
	   
	    <!--<div class="d-block d-sm-block d-md-none">-->
	    <!--    <a target="_blank" href="http://zerovaega.in/pc_rportal/resume/"><button type="button" class="btn btn-sm btn-outline-info text-center btn_back_home mb-3"><i class="fa fa-angle-double-left"></i> Go Home</button></a>-->
	    <!--    <h2 class="m-auto" style="text-align: center">AVAILABLE JOBS</h2>-->
	    <!--</div>-->
	    
		<div class="[ my-5 ]">
		    <!-- Amruta jagtap. code of menu popup -->
			<button type="button" id="more_filters_btn_web" class="mt-4 btn btn-sm btn-outline-info" data-toggle="modal" data-target="#footer_video_popup" ><i class="fa fa-bars"></i> Menu
			</button>
			
            <br><br>
            <!-- Modal -->
            <div class="modal fade" id="footer_video_popup" tabindex="-1" aria-labelledby="footer_video_popupLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quick Links</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="" class="[  ][  ]" style="border-top: 0px solid #999">
                        <?php 
                            $footer_links=$pages->get("name=footer");
                        ?>
                        <div class="[ mt-3 ][ text-center small ]">
                    		For a step-by-step video guide to upload your resume, click <a target="_blank" href="<?=$footer_links->resume_upload_youtube_link;?>" title="">here</a>.
                    	</div>
                    
                    	<div class="[ mt-3 ][ text-center small ]">
                    		To create your resume, download the template <a target="_blank" href="<?=$footer_links->resume_template_file;?>" title="" download>here</a>.
                    	</div>
                    
                    	<div class="[ mt-3 ][ text-center small ]">
                    		For techincal queries regarding the form, please email us at <a href="mailto:<?=$footer_links->pc_contact_email;?>?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"><?=$footer_links->pc_contact_email;?></a>
                    	</div>
                         
                        <?php if($session->user_designation==""){?>
                        
                        	<div class="container" style="width=100%">
                        		<div class="[ row ]">
                        		    <!--<div class="col-md-1"></div>-->
                        			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3 " style="height:266px;">
                        				<!--<iframe width="100%" height="100%" src="https://www.youtube.com/embed/SMKPKGW083c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/?listType=playlist&list=PLwBLWdJLnK_GIbL3EZ-ITBpG8nh0V00rQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        				
                            			</div>
                            			<!--<div class="col-md-1"></div>-->
                            			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3 " style="height:266px; "	>
                            				<!--<iframe width="100%" height="100%" src="https://www.youtube.com/embed/SMKPKGW083c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                            				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/?listType=playlist&list=PLwBLWdJLnK_H8hYLQTbsf36FM8GUdeIo6" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            			</div>
                            			<!--<div class="col-md-1"></div>-->
                        		
                        		</div>
                        	</div>		
                        <?php }?>
                        
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                  </div>
                </div>
              </div>
            </div>
            <!-- End code of menu popup -->
			<div class="container mb-5 d-md-block d-none d-sm-none  d-xs-none">
			    <div class="container job_search_web">
			        <h4 class="">Search</h4>
    				<div class="[ form-group mb-4 ]">
    					<input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Quick Search">
    				</div>
			    </div>
			        
				    <div id="Advance_search" class="card border-left-primary shadow  py-2 collapse" style="border-left: 4px solid;   border-radius: 10px;border-left-color: #007bff;">
    					<div class="card-body">
    						<div class="container">
    					    	
                				<div>
                                     <form id="search-container" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST"  novalidate>
                                    		<!-- PERSONAL INFORMATION TAB -->
                                    		<!--<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">-->
                                    			<div class="[  ][  bg-primarya ]">
                                    				<h4 class="text-center">More Filters</h4>
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
                                            								     if($job_search_data_set['experience_years']!=""        && $job_search_data_set['experience_years']!="unselected" && $i==$job_search_data_set['experience_years']){
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
                                            					Please enter key skills.
                                            				</div>
                                            			</div>
                                    			    </div>
                                    			</div>
                                    			
                                    			<div class="row">
                                    			    
                                    			    <?php
                                    			        $job_company_array=array();
                                    			        
                                    			        
                                    			       foreach($pages->get("name=jobs")->children("verification=verified,active_status=active") as $job_page){
                                    			           
                                    			           if($job_page->job_publish_shedule!=""){
                                                                if($job_page->job_publish_shedule>time()){
                                                                    continue;
                                                                }
                                                            }
                                    			         // echo $recruiter_page->company_name;
                                    			         //$recruiter_company_array1[$recruiter_page->company_name]=$recruiter_page->company_name;
                                    			          
                                    			         // if($recruiter_page->company_name == $recruiter_company_array1  ){
                                    			         //     //continue;
                                    			         //     $recruiter_company_array[]=$recruiter_page->company_name;
                                    			         // }
                                    			          if(in_array($job_page->company_name,$job_company_array)){
                                    			              continue;
                                    			          }
                                    			             //$job_company_array[]=str_replace("\'","'",addslashes($job_page->company_name));
                                    			         // $job_company_array[]=str_replace("\'","'",$job_page->company_name);
                                    			         $job_company_array[]=stripslashes($job_page->company_name);
                                    			          //print_r($job_company_array);
                                    			          
                                    			         // if(in_array($recruiter_page->company_name,$recruiter_company_array)){
                                    			         //     continue;
                                    			         // }
                                    			          //$recruiter_company_array[]=in_array($recruiter_page->company_name,$recruiter_company_array);
                                    			          
                                    			          //$recruiter_company_array1[]=$recruiter_company_array;
                                    			          
                                    			       }
                                    			       //print_r($job_company_array);
                                    			       /* here we use sort() then sort display 1st capital leeter in alphabetical order and then small letters in alphabetical order 
                                    			          So here we use natcasesort() is case sensetive so they dispaly capital and small letter alphabetical order at a time.*/
                                    			       natcasesort($job_company_array);
                                    			        print_r($job_company_array);
                                    			       $job_company_data=implode("''",$job_company_array);
                                    			       print_r($job_company_data);
                                    			      // echo $recruiter_company_data;
                                    			       
                                    			    ?>
                                    			    
                                    			    <div class="col-md-6">
                                    			        <div class="[  ][ form-group ]">
                                            				<label for="company_name">Company</label>
                                            				<input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=str_replace('"',"'",$job_search_data_set['company_name']);?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>
                                                                    ']
                                                                ">
                                            				<div class="invalid-tooltip">
                                            					Please enter key skills.
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
                                				<button value="submit" name="submit" class=" [ btn btn-primary ]" type="submit" disable >
                                					Submit
                                				</button>
                                        		
                                			</div>
                                			<!-- Buttons Section End -->
                                         </form>
                                </div>
                                
                			
    						</div>
    					</div>
    				</div>
    				<div class="text-center">
			            <button type="button" id="more_filters_btn_web" class="mt-4 btn btn-sm btn-outline-info text-center more_filters_btn " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction_demo()">More Filters</button>
			        </div>
                    
                  
                </div>
			<div class="container d-block d-sm-block d-md-none">
				    <div class="card border-left-primary shadow  py-2 " style="border-left: 4px solid;   border-radius: 10px;border-left-color: #007bff;">
					<div class="card-body">
						<div class="align-items-center">
					    	<h4 class="">Search</h4>
            				<div class="[ form-group mb-4 ]">
            					<input id="jobs_searchword" class="[ form-control  ]" type="text" name="jobs_searchword" placeholder="Quick Search">
            				</div>
            				
            				<div id="Advance_search" class="collapse">
                                 <form id="search-container" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST"  novalidate>
                                		<!-- PERSONAL INFORMATION TAB -->
                                		<!--<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">-->
                                			<div class="[  ][  bg-primarya ]">
                                				<h4>More Filters</h4>
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
                                								     if($job_search_data_set['experience_years']!=""        && $job_search_data_set['experience_years']!="unselected" && $i==$job_search_data_set['experience_years']){
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
                                					Please enter key skills.
                                				</div>
                                			</div>
                                			
                                			<div class="[  ][ form-group ]">
                                				<label for="company_name">Company</label>
                                				<input id="company_name" name="company_name" type="text" class="form-control tagator" required value="<?=$job_search_data_set['company_name']?>" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$job_company_data?>
                                                        ']
                                                    ">
                                    				<div class="invalid-tooltip">
                                    					Please enter key skills.
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
                            				<button value="submit" name="submit" class=" [ btn btn-primary ]" type="submit" disable >
                            					Submit
                            				</button>
                                    		
                            			</div>
                            			<!-- Buttons Section End -->
                                     </form>
                            </div>
                            <button type="button" id="more_filters_btn" class="btn btn-sm btn-outline-info text-center offset-md-2 more_filters_btn " data-toggle="collapse" data-target="#Advance_search" onclick="myFunction()">More Filters</button>
            			
						</div>
					</div>
				</div>
                    
                  
                </div>
            <div id="job-list-div">
               
    			<div class="[ col-sm-12 job_card_section scrollable-element ]" style="">
    			     <!--
                    div added by sameesh@6-April 2021 for paggination
                -->
                <div  class="mt-3">
                    <ul id="paginTop" class="pagination justify-content-center overflow-auto">
                        
                    </ul>
    			</div>
                <!--
                    sameesh code ends here    
                -->
    			    
    			    <div class="[ row ]">
    
    		<?php
$job_page_counter = 1; 
    			/* Job postings in the descending order od the day they were posted. Latest first. */
    			for($loop=0;$loop<30;$loop++){
    			$i=1;
    			
    			if(isset($filter_selector)){
    			    $cards_filter=$filter_selector;
    			}
    			$filtered_job_pages=$pages->get("name=jobs")->children("verification=verified,active_status=active,".$cards_filter);
    			
                if($filtered_job_pages->count()==0){
    			    echo "<h3 class='text-center m-auto'>No results found</h3>";
    			}

     			foreach ($filtered_job_pages as $job_page) {
     			    
     			    if($job_page->max_experience !=0 && isset($experience_years)){
     			        if($experience_years>$job_page->max_experience){
     			            continue;
     			        }
     			        
     			    }
                      //echo $job_page->job_publish_shedule!="";
     			    //echo "+++++++++++++++++++++++++++";
     			    if($job_page->job_publish_shedule!=""){
                        if($job_page->job_publish_shedule>time()){
                            continue;
                        }
                    }
                    
                    $job_page_counter++;
                    
                    $is_visible = "";
                    if($job_page_counter>25){
                        $is_visible = " display:none ";
                    }
                    
                //foreach ($pages->get("name=jobs")->children("max_experience>=1") as $job_page) {
    		?>
    
    			<div id="job-card-container" class="( job-card-container )[ <?=$job_page_counter?> ][ my-3 ][ col-md-6  col-lg-4 col-xl-3 ]" style="<?=$is_visible?>">
    				<div class="[ card ]">
    				    <?php
    				   
    					 
    						/* Add NEW badge for the first ten job postings */
    						if(time()-$job_page->created <15*24*60*60){ 
    					?>
    					
    					<span class="[ px-3 ][ badge badge-danger ]" style="position: absolute; right:41%; top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">NEW</span>
    					
    					<?php
    						}
    					?>
    
    					<div class="card-body">
    					    
    					     <!--
                                Sameesh yadav for 6-march-2021
                                to add image in card of jobs
                            -->
                            <div class="container p-0 m-0">
                                <div class="row align-items-center" style="   height:98px; ">
                                    <?php
                                    /**
                                     * firt check if image in job page if null then add default vaue
                                     * $image to store image url
                                     */
                                    if ($job_page->job_image != null) {
                                        $image = $job_page->job_image->httpUrl;
                                    } else {
                                        $image =  $rootpath . "images/Rise_logo_new.png";
                                    }
                                    ?>
                                    <img src="<?= $image ?>" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
                                </div>
                            </div>
                            <!-- 
                                code ends here
                            -->
    						<h5 class="[ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=addslashes($job_page->title)?></h5>
    
    						<h6 class="[ mb-3 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> At <?=stripslashes($job_page->company_name)?>
    							<br>
    							Posted on <?=date("d M Y", $job_page->created)?>
    						</h6>
    
                           <!--/* Existing system user experience save to experience field but in new system minimum experience save in min_experience field and maximum experience save in max_experience field . 
                                so existing system experience saving min and max experience field */-->
    						
    						 <?php 
                            // if($job_page->min_experience==""){
                            //     $old_experience=str_replace("Years","",$job_page->experience);
                            //     $old_experience=str_replace("years","",$old_experience);
                            //     $old_experience=str_replace("+","",$old_experience);
                            //     $old_experience=str_replace("year","",$old_experience);
                            //     $old_experience=str_replace("Year","",$old_experience);
    
                            //     $old_experience_array=array_map('trim', explode("-",$old_experience));
                            //     //print_r($old_experience_array);
                            //     if(!isset($old_experience_array['1'])){
                            //         //$job_page->max_experience=$old_experience_array['1'];
                            //         $old_experience_array['1']=0;
                            //     }
    
                            //     echo "-";
                            //     echo (int)$old_experience_array['0'];
                            //     echo "-";
                            //     echo (int)$old_experience_array['1'];
                            //     echo "-";
                                
                            //     $job_page->min_experience=$old_experience_array['0'];
                            //     // if(isset($old_experience_array['1'])){
                            //     $job_page->max_experience=$old_experience_array['1'];
                            //     // }
                            //     // else{
                            //     //     $job_page->max_experience=0;
                            //     // }
                            //     $job_page->of(false);
                            //     $job_page->save();
                            // }
                            
                                ?>
                                
                                
    						<!-- <p class="card-text"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i> <?php if($job_page->min_experience == ""){
    						echo $job_page->experience; }else{ echo $job_page->min_experience; }?><?php if($job_page->max_experience!=0) echo "-".$job_page->max_experience?> <?php if($job_page->min_experience != ""){ echo "Years"; }?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i> <?=$job_page->location?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $job_page->created)+date("H", time())?> Views Today</p>-->
    						
    						<?php $job_location=array_map('trim', array_filter(explode(",",stripslashes($job_page->location))));
    						
    						      $job_location=implode(", ",$job_location);
    						
    						?>
    
    						<p class="card-text"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i> <?=$job_page->min_experience?><?php if($job_page->max_experience!=0) echo "-".$job_page->max_experience?> Year<?php if($job_page->min_experience!=1) echo 's';?> <br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i>  <?=$job_location?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $job_page->created)+date("H", time())?> Views Today</p>
    				
    				
    						<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$job_page->job_code?></span></p>
    
    						<hr>
    
    						<div class="[ d-flex justify-content-between ]">
    							<a href="<?=$job_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="[ card-link ][  btn btn-outline-primary ]">KNOW MORE</a>
                                <?php //echo $job_page->id; 
                               // echo "+++++++++++++++++++++++++++++"; ?>
                                
    							<div id="share-button-<?=$job_page->id?>" style="" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div>
    							<button class="btn btn-outline-light text-primary copy_link" id="copy_link"   title="<?=$job_page->httpUrl?>"><i class="far fa-copy "></i> </button>
    							<!--<span class="tooltiptext">Tooltip text</span>-->
            					<a target="_blank" href="https://api.whatsapp.com/send?text=<?=$job_page->httpUrl?>"><button class="btn btn-outline-light text-success btn_whatsapp" id="whatsapp_link"><i class="fa fa-whatsapp  "></i> </button></a>
            					
            					
    						</div>
    					</div>
    				</div>
    			</div>
    
    		<?php
    				$i++;
    			}
                }
    		?>
            
    		</div>
    		
    			<!--
                        div added by sameesh@6-April 2021 for paggination
                -->
    			<div class="mt3">
                    <ul id="paginBottom" class="pagination justify-content-center ">
                        
                    </ul>
    			</div>
    			<!--
                        sameesh code ends here    
                -->
    		
    			</div>
    		
            </div>
			<!--<div class="[ col-7 ]">-->
			<!--	<h2 style="text-align: center">AVAILABLE JOBS</h2>-->
			<!--</div>-->
		</div>

		<!--<div class="[ my-4 ][ row ]">-->
		<!--	<div class="[ offset-md-4 col-md-4 ]" >-->
		<!--		<div class="[ form-group ]">-->
		<!--			<input id="jobs_searchword" class="[ form-control form-control-lg ]" type="text" name="jobs_searchword" placeholder="Search">-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->

        
		
	</div>

	<script src="<?=$config->urls->templates?>scripts/needsharebutton.min.js"></script>
	<!--
	    Script added by sameesh @6April2021 for paggination 
	-->
	<script>
		<?php
			foreach ($filtered_job_pages as $job_page) {
		?>

		new needShareDropdown(document.getElementById("share-button-<?=$job_page->id?>"), {
		    //console.log($job_page->id);
			url: "<?=$job_page->httpUrl?>",
			title: "Check this job opening on Pride Cricle now!",
			description: "Click on the link and log in to apply."
		});

		<?php
			}
		?>
	</script>
	
		<script>
// 		$(document).ready(function(){
// 		    	$('#copy_link').attr({
// 				'data-toggle': 'tooltip',
// 				'data-placement': 'top',
// 				'title': 'Copy text!'
// 			});
// 		});
	
	    $(document).on('click', '.copy_link', function(){
	        //console.log("$page->httpUrl");
            var job_page_url=$(this).attr("title");
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

	<!--<script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js"></script>-->
<?php
require $config->paths->templates.'includes/sticky-footer.php';
?>

<?php
require $config->paths->templates.'includes/footer.php';
?>