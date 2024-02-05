<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
  
global $recruiter_company_name;

	if(isset($_GET['name'])){	
		$recruiter_company_name=$_GET['name'];
		// echo $recruiter_company_name;
	}
	
  $company_name=$recruiter_company_name;
	// echo $company_name;
  // $session_company_name=$session->company_name;

  $recruiter_page=$pages->get("recruiters")->child("company_name=".$company_name);
	// echo $recruiter_page->id;
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

		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="shortcut icon" type="image/png" href="<?=$urls->httpTemplates?>images/frontend/favicon.png"/>
	<link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />

	<!-- fonts by pooja  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	
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
    /* Add your CSS styles here */
    .company_logo_name_section {
      /* display: flex; */
      align-items: center;
      /* background-color: #333;
      color: #fff; */
      /* padding: 10px 20px; */
			/* margin-top: 7rem; */
			margin-top:3rem;
    	/* justify-content: space-around; */
			justify-content: center;
			text-align:center;
			font-family: 'Montserrat', sans-serif !important;
			/* box-shadow: 3px 5px 5px cadetblue; */
    	/* border: 2px solid cadetblue; */
    }
		.not_company_name_section{
			align-items: center;
      /* background-color: #333;
      color: #fff; */
      padding: 10px 20px;
			margin-top: 7rem;
    	/* justify-content: space-around; */
			justify-content: center;
			text-align:center;
			font-family: 'Montserrat', sans-serif !important;
		}
    .logo {
      /* margin-right: 20px; */
			/* margin-bottom:1rem; */
    }
		.paragraph_section{
			font-family: 'Montserrat', sans-serif !important;
		}
		
    .logo img {
			/* width: 128px;
      height: 97px; */
      /* width: 50px;
      height: 50px; */
			max-height: 168px;
    	width: auto;
			width: 20%;
			position: absolute;
			/* top: 25%;
			left: 42%; */
			top: 38%;
			left: 50%;
			transform: translate(-50%, -50%);
    }
    .company_name {
      font-size: 2rem;
      margin: 0;
			margin-bottom: 2rem;
			color: #0275d8;
			font-family: 'Montserrat', sans-serif !important;
    }
		.privacy_policy_image{
			width:100%;
			opacity: 1;
			max-height: 26rem;
		}
		.privacy_policy_title{
			/* color:white;
			background-color:#17a2b8; 
			background-color: #1793b8; */
			color: #0275d8;
			font-size:1.75rem;
			text-align:center;
			display: block;
			text-transform: uppercase;
			margin-bottom: 2rem;
			font-family: 'Montserrat', sans-serif !important;
		}
		.posted_job_section .btn_posted_job {
				margin-top: 12px;
				float: right;
				font-family: 'Montserrat', sans-serif !important;
		}
		.btn_posted_job {
				background-color: transparent;
				background-color: #ccc;
				color: #0275d8;
				border: 2px solid #0275d8;
				color: #000;
				border: 2px solid #ccc;
				font-size: 13px !important;
				text-transform: uppercase;
				font-weight: 700;
				padding: 10px 28px;
				border-radius: 30px;
				display: inline-block;
				transition: all 0.3s;
				line-height: 24px;
				font-family: 'Montserrat', sans-serif !important;
		}
		.btn_posted_job:hover {
				background-color: transparent;
				color: #0275d8;
				border: 2px solid #0275d8;
				color: #fff;
				border: 2px solid #fff;
				font-size: 13px !important;
				text-transform: uppercase;
				font-weight: 700;
				padding: 10px 28px;
				border-radius: 30px;
				display: inline-block;
				transition: all 0.3s;
				text-decoration:none;
				line-height: 24px;
				font-family: 'Montserrat', sans-serif !important;
		}
		.posted_job_section_container{
			background-color: #0275d8;
			background-color: lightgrey;
			background-color: #214897;
    	border-radius: 3px;
			text-transform: uppercase;
			text-transform:capitalize;
			color: #fff;
			font-family: 'Montserrat', sans-serif !important;
		}
		.posted_job_div{
			/* border: 3px solid grey;
			border: 3px solid cadetblue; */
			background-color: #214897;
		}
		.company_banner{
			margin-top:4.3rem;
		}

		/**Mobile view */
		@media screen and (max-width: 768px) {
			.logo img {
				top: 35%;
    		left: 50%;
			}
			.company_banner{
				margin-top:5rem;
			}
			.privacy_policy_text{
				margin-top: 1rem;
			}
			
		}
		@media screen and (max-width: 600px) {
			.privacy_policy_title{
				text-align:left;
				font-family: 'Montserrat', sans-serif !important;
			}
			.logo img {
				top: 30%;
    		left: 50%;
			}
		}

		@media screen and (max-width: 420px) {
			.logo img {
				top: 23%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 420px) and (min-width: 396px)  {
			.logo img {
				top: 23%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 397px) and (min-width: 360px)  {
			.logo img {
				top: 24%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 375px)  {
			.logo img {
				top: 30%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 360px)  {
			.logo img {
				top: 26%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 820px) and (min-width: 769px)  {
			.logo img {
				top: 15%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 913px) and (min-width: 821px)  {
			.logo img {
				top: 14%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 540px) and (min-width: 421px)  {
			.logo img {
				top: 35%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 1024px) and (min-width: 913px)  {
			.logo img {
				top: 34%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 1280px) and (min-width: 1025px)  {
			.logo img {
				top: 29%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 1299px) and (min-width: 1281px)  {
			.logo img {
				top: 31%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 1360px) and (min-width: 1300px)  {
			.logo img {
				top: 33%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 1104px) and (min-width: 985px)  {
			.logo img {
				top: 27%;
    		left: 50%;
			}
		}
		@media only screen and (max-width: 984px) and (min-width: 915px)  {
			.logo img {
				top: 26%;
    		left: 50%;
			}
		}
		/* @media only screen and (max-width: 915px) and (min-width: 913px)  {
			.logo img {
				top: 30%;
    		left: 50%;
			}
		} */
		@media only screen and (max-width: 359px) and (min-width: 280px)  {
			.logo img {
				top: 25%;
    		left: 50%;
				max-height: 111px;
			}
		}

		
		

		
		
  </style>

</head>

<body>
  <?php 
 require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
  ?>
	
  <?php

		if($recruiter_page->text_description!="" && $recruiter_page->footer_logo!="" && $recruiter_page->rich_textarea_1!="" && $recruiter_page->profile_image!=""){
			// echo "***";
	?>
  <!-- Company name & logo section -->
  <div class="company_logo_name_section">
			<?php
			$recruiter_main_page=$pages->get("recruiters");
			if($recruiter_main_page->banner_image!=""){
			?>
			<img src="<?=$recruiter_main_page->banner_image->httpUrl?>" class="[ img-fluid ]( mobile-hide ) w-100" alt="Pride Circle Banner Image">
			<?php
			}
			?>
			<?php
			if($recruiter_main_page->Banner_image_mobile!=""){
			?>
			<img src="<?=$recruiter_main_page->Banner_image_mobile->httpUrl?>" class="[ img-fluid ]( mobile-show ) w-100" alt="Pride Circle Banner Image">
			<?php
			}
			?>
		<div class="">
			<!-- <h1 class="company_name"><strong><?=$recruiter_page->company_name;?></strong></h1> -->
			<div class="logo">
			
				<img class="img-fluid " src="<?=$recruiter_page->footer_logo->httpUrl;?>" alt="Company Logo">
			</div>
		</div>
  </div>
  <!-- Company name & logo section end -->
	<!-- company about paragraph section  -->
  <div class="content-wrap [  ] paragraph_section" id="about_company">
		<div class="text-center title-center title-border" style="margin-bottom: 3rem; background-color:#824298;height: 4rem;padding-top: 0.9rem;">
			<h3 class="title_new" style="color:#fff;">About <?=$recruiter_page->company_name;?></h3>
		</div>
    <div class="container">
			<!-- <h3 style="text-transform: uppercase; color:#0275d8;"><strong>About <?=$recruiter_page->company_name;?></strong></h3> -->
			
      <div style="text-transform: none;" class="title_new heading-block  border-bottom-0 mb-5"><?=$recruiter_page->text_description;?></div>
    </div>
  </div>
  <!-- company about paragraph section end -->
	<!-- company privacy policy section -->
	<div class="policy_section paragraph_section">
		<div class="text-center title-center title-border" style="margin-bottom: 3rem; background-color:#b76bb7;height: 4rem;padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;">Policies & Benefits</h3>
			</div>
		<div class="container clearfix ">
			<!-- <h3 class="badge title_break_style privacy_policy_title"><strong>Privacy Policy</strong></h3> -->
			<!-- <h3 class="privacy_policy_title"><strong>Our Policy</strong></h3> -->
			<div class="row align-items-center gutter-40 col-mb-50 mb-3">
				<div class="col-md-5">
					<img data-animate="fadeInLeftBig" class="privacy_policy_image img-fluid" src="<?=$recruiter_page->profile_image->httpUrl;?>" alt="Imac">
				</div>

				<div class="col-md-7">
				<div style="text-transform: none;" class="title_new heading-block  border-bottom-0 mb-5 privacy_policy_text"><?=$recruiter_page->rich_textarea_1;?></div>
					
				</div>
			</div>
			<div class="line"></div>
		</div>
	</div>
	<!-- company privacy policy section end -->
	<!-- Company Posted Job section -->
	<section id="content posted_job_section">
			<div class="content-wrap">
				<div class="container clearfix posted_job_section_container">
					<div class="promo promo-light p-4 p-md-5 mb-5 posted_job_div">
						<div class="row align-items-center">
							<div class="col-12 col-lg">
								<h3 style="color:#fff;">View jobs posted by this company</h3>
							</div>
							<div class="col-12 col-lg-auto mt-4 mt-lg-0">
								<a href="<?=$pages->get("name=jobs")->httpUrl?>?company_id=<?=$recruiter_page->id?>" class="button button-large button-circle button-black m-0 btn_posted_job">Show Jobs</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- Company Posted Job section end -->
<?php
	}
	else{
?>
 <!-- No Company profile available section -->
 <div class="container ">
		<div class="not_company_name_section mb-5">
			<h1 class="company_name"><strong><?=$recruiter_company_name?></strong></h1>
			<div class="alert alert-danger m-auto mb-1" role="alert" style="padding:0.5rem 1.25rem;"><strong>Company Profile Not Available!</strong></div>

		</div>
  </div>
  <!-- No Company profile available section end -->
<?php
	}
?>
  <?php
 include(\ProcessWire\wire('files')->compile('includes/job_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/sticky-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
  ?>

  <?php
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
  ?>
