<?php
// echo $session->email;
// echo $session->user_type;
// echo $session->email;
// var_dump($session);
	if($session->email == "" || $session->user_type == ""){
		$session->redirect($pages->get("name=universe")->httpUrl);
		

	}
	elseif($session->verification == "unverified"){
		
	  $company_page= $pages->get("name=universal-companies")->child("title=".$session->company_name);
	  if($company_page->verification=="verified"){
		  $session->verification == "verified";
	  }
	  else{
		  header("Location: ".$config->urls->httpRoot."universe/universal-home/");
	  }
		
		
	}
		//$session->verification = "unverified";

	require_once 'includes/candidate_table_data.php';

/* TODO : Deprecate this system. Use direct values. */
	$rootpath = $config->urls->templates;
	$homepath = $urls->httpRoot."resume/";
	//echo $homepath;
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

	<!-- Custom fonts for this template -->
	<!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= $rootpath;?>styles/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="<?= $rootpath;?>styles/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="<?= $rootpath;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">
	<link href="<?= $rootpath;?>styles/user-header.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
		let rootpath = '<?=$rootpath?>';
		let homepath = '<?=$homepath?>';
	</script>

	<!-- Meta Pixel Code -->
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

<!-- Global site tag (gtag.js) - Google Analytics -->
	
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-C3XCR831MS');
	</script> -->
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="height: 100%">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon rotate-n-15">

				</div>
				<div class="sidebar-brand-text mx-3 sidebar_to_text" style=""><b><?=$session->name."</b><br>".$session->email."</b><br>".$session->company_name?></span></div>
				
			</a>
			<!--<div class="social_media_links">-->
			<!--	     <ul class="social-links">-->
			<!--	        <li><a href="https://www.youtube.com/c/PrideCircle" target="_blank"><i class="fab fa-youtube"></i></a></li>-->
   <!--                     <li><a href="https://m.facebook.com/PrideCircles/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>-->
   <!--                     <li><a href="https://twitter.com/pride_circle" target="_blank"><i class="fab fa-twitter"></i></a></li>-->
   <!--                     <li><a href="https://www.instagram.com/pride_circle/" target="_blank"><i class="fab fa-instagram"></i></a></li>-->
   <!--                     <li><a href="https://www.linkedin.com/company/pride-circle" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>-->
   <!--                 </ul>-->
			<!--	</div>-->

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<!-- <li class="nav-item">
				<a class="nav-link" href="index.html">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li> -->

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<!-- <div class="sidebar-heading">
				Manage
			</div> -->

			<!-- Nav Item - Tables -->
			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-admin/">-->
			<!--		<i class="fas fa-fw fa-tachometer-alt"></i>-->
			<!--		<span>Dashboard</span></a>-->
			<!--</li>-->
				<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages_notify" aria-expanded="true" aria-controls="collapsePages" style="margin-left: 1rem;padding: 0px 0rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-bell"></i>
					<span>Inbox</span>
				</a>
				<div id="collapsePages_notify" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
					<div class="bg-white py-2 collapse-inner rounded">
						
						<h6 class="collapse-header" style="margin-left: 0.5rem;padding: 0px 0.5rem 0rem 0rem;">No new notifications</h6>
						<!--<a class="collapse-item" style="margin: 0px;padding: 0.5rem 0rem 0.5rem 0.5rem; margin-bottom: 4px; font-size: 13px;" href=""></a>-->
						<div class="collapse-divider"></div>
						
					</div>
				</div>
			</li>
			<?php if($session->user_type == "company_admin"){
			?>
			<li class="nav-item active">
				<h6 class="collapse-header" style="margin-left: 1.3rem;padding:0rem 0.5rem 0.6rem 0rem;">Admin Panel</h6>
				<a class="nav-link" style="margin: 0px;margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/manage-subusers/">
					<i class="fas fa-fw fa-users"></i>
					<span>Manage Users</span></a>
			</li>
			
				<hr class="sidebar-divider">
			<?php 
			}?>
		
			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/" style="margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-briefcase"></i>
					<span>Welcome</span></a>
			</li>
			
			<!-- <li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/pride-ally-book-mar/" style="margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-briefcase"></i>
					<span>Pride Ally Book (Mar)</span></a>
			</li> -->
			<?php
			 
			   $company_page= $pages->get("name=universal-companies")->child("title=".$session->company_name);
			 //   echo $session->company_name;
			 //   echo $company_page;
			 $sub_user_email=$session->email;
			   // echo $company_page->sub_users;
			   $sub_users_object=json_decode($company_page->sub_users);
			   if($session->user_type == "company_subuser" && $sub_users_object->$sub_user_email->enabled_status=="enabled"){
				   //echo "enabled";
			  // }
			 //   if($session->user_type == "company_subuser" && $company_page->sub_users->enabled_status=="enabled"){
			  //if($session->user_type == "company_subuser"){
			?>
			<!-- <li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/rise-sponsorship/">
					<i class="fas fa-fw fa-briefcase"></i>
					<span>RISE 2021 (May)</span></a>
			</li> -->
			
			<?php 
				}
			 ?>
		
			 <?php if($session->user_type == "company_admin"){
			?>
			
			
			<!-- <li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/rise-sponsorship/" style="margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-briefcase"></i>
					<span>RISE 2021 (May)</span></a>
			</li> -->
			
			

			<?php } 
				
				//elseif($session->user_type == 'company_subuser'){
			?>







			<?php
				/* If the user is an admin or a verified subuser */
				if($session->user_type == "company_admin" ||($session->user_type == "company_subuser" && $sub_users_object->$sub_user_email->enabled_status=="enabled")){

					/* Go through all the events in the universal user dashboard page */
					foreach ($pages->get("/universe/universal-user-dashboard/events")->children as $event_page) {
						/* If the section does not have any children, simply show the title of the page as event title. */
						if($event_page->hasChildren() == 0){
			?>

			<li class="nav-item active">
				<a class="nav-link" href="<?=$event_page->httpUrl?>" style="margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-briefcase"></i>
					<span><?=$event_page->title?></span></a>
			</li>

			<?php

						}
						/* Else, if the page has children, show them under a collapsible dropdown. */
						else{
			?>

			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" style="margin-left: 1rem;padding: 0px 0rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-folder"></i>
					<span><?=$event_page->title?></span>
				</a>
				
				<?php
					$expanded="";
					$other_program_page = $event_page->child("id=".$page->id);
					if($other_program_page->id){
					   // echo $page->id;
						 $expanded=" show";
					}
				?>

				<div id="collapsePages" class="collapse <?=$expanded?>" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
					<div class="bg-white py-2 collapse-inner rounded ">
						<?php 
							foreach($event_page->children() as $other_program_pages){
						?>

						<h6 class="collapse-header" style="margin-left: 0.5rem;padding: 0px 0.5rem 0rem 0rem;"><?=$other_program_pages->month;?></h6>

						<a class="collapse-item " style="margin: 0px;padding: 0.5rem 0rem 0.5rem 0.5rem; margin-bottom: 4px; font-size: 13px;" href="<?=$other_program_pages->httpUrl;?>"><?=$other_program_pages->title;?></a>
						
						<?php
							} 
						?>
						<div class="collapse-divider"></div>
						
			<!--            <li class="nav-item">-->
			<!--    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">-->
			<!--        <i class="fas fa-fw fa-folder"></i>-->
			<!--        <span>Pages</span>-->
			<!--    </a>-->
			<!--    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">-->
			<!--        <div class="bg-white py-2 collapse-inner rounded">-->
			<!--            <h6 class="collapse-header">Login Screens:</h6>-->
			<!--            <a class="collapse-item" href="login.html">Login</a>-->
			<!--            <a class="collapse-item" href="register.html">Register</a>-->
			<!--            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>-->
			<!--            <div class="collapse-divider"></div>-->
			<!--            <h6 class="collapse-header">Other Pages:</h6>-->
			<!--            <a class="collapse-item" href="404.html">404 Page</a>-->
			<!--            <a class="collapse-item" href="blank.html">Blank Page</a>-->
			<!--        </div>-->
			<!--    </div>-->
			<!--</li>-->
					   
					</div>
				</div>
			</li>

			<?php
						}
					}
				} 
			?>



















			

			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" href="<?=$config->urls->httpRoot ?>universal-user-dashboard/rise-sponsorship/">-->
			<!--		<i class="fas fa-fw fa-briefcase"></i>-->
			<!--		<span>Sponsorship for RISE</span></a>-->
			<!--</li>-->

			<?php //} ?>
			
			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" href="<?=$config->urls->httpRoot ?>universal-user-dashboard/other-programs-jan-to-dec/industry-roundtable-i-feb/">-->
			<!--		<i class="fas fa-fw fa-users"></i>-->
			<!--		<span>Other Programs (Jan to Dec)</span></a>-->
			<!--</li>-->
			<!-- <li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" style="margin-left: 1rem;padding: 0px 0rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-folder"></i>
					<span>Other Programs (2021)</span>
				</a>
										<?php
						$expanded="";
						$other_program_page =$pages->get("name=other-programs-jan-to-dec")->child("id=".$page->id);
						if($other_program_page->id){
						   // echo $page->id;
							 $expanded=" show";
						}
						?>
				<div id="collapsePages" class="collapse <?=$expanded?>" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
					<div class="bg-white py-2 collapse-inner rounded ">
						<?php 
						foreach($pages->get("name=other-programs-jan-to-dec")->children() as $other_program_pages){
						?>
						<h6 class="collapse-header" style="margin-left: 0.5rem;padding: 0px 0.5rem 0rem 0rem;"><?=$other_program_pages->month;?></h6>

						<a class="collapse-item " style="margin: 0px;padding: 0.5rem 0rem 0.5rem 0.5rem; margin-bottom: 4px; font-size: 13px;" href="<?=$other_program_pages->httpUrl;?>"><?=$other_program_pages->title;?></a>
						<?php } ?>
						<div class="collapse-divider"></div> -->
						
			<!--            <li class="nav-item">-->
			<!--    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">-->
			<!--        <i class="fas fa-fw fa-folder"></i>-->
			<!--        <span>Pages</span>-->
			<!--    </a>-->
			<!--    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">-->
			<!--        <div class="bg-white py-2 collapse-inner rounded">-->
			<!--            <h6 class="collapse-header">Login Screens:</h6>-->
			<!--            <a class="collapse-item" href="login.html">Login</a>-->
			<!--            <a class="collapse-item" href="register.html">Register</a>-->
			<!--            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>-->
			<!--            <div class="collapse-divider"></div>-->
			<!--            <h6 class="collapse-header">Other Pages:</h6>-->
			<!--            <a class="collapse-item" href="404.html">404 Page</a>-->
			<!--            <a class="collapse-item" href="blank.html">Blank Page</a>-->
			<!--        </div>-->
			<!--    </div>-->
			<!--</li>-->
					   
					<!-- </div>
				</div>
			</li> -->
			
			
			<!-- <li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>universe/universal-user-dashboard/contact-us/" style="margin-left: 1rem;padding: 0px 0.5rem 0.5rem 0rem;">
					<i class="fas fa-fw fa-users"></i>
					<span>Contact Us</span></a>
			</li> -->
			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" target="_blank" href="<?=$config->urls->httpRoot ?>universal-user-dashboard/rise-sponsorship/">-->
			<!--		<i class="fas fa-fw fa-external-link-alt"></i>-->
			<!--		<span>RISE Bangalore 2019</span></a>-->
			<!--</li>-->
			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" target="_blank" href="<?=$config->urls->httpRoot ?>universal-user-dashboard/rise-sponsorship/">-->
			<!--		<i class="fas fa-fw fa-external-link-alt"></i>-->
			<!--		<span>RISE Bangalore 2020</span></a>-->
			<!--</li>-->
			<!--<li class="nav-item active">-->
			<!--	<a class="nav-link" href="<?=$config->urls->httpRoot ?>company-data/">-->
			<!--		<i class="fas fa-fw fa-briefcase"></i>-->
			<!--		<span>Company Data</span></a>-->
			<!--</li>-->

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block" style="margin-bottom: 60px;">

			<!-- Sidebar Toggler (Sidebar) -->
			<!-- <div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div> -->
			<!--<div class="logout_bottom">-->
			<a class="logout_bottom" href="#" data-toggle="modal" data-target="#logoutModal">
				<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				Logout
			</a>
		<!--</div>-->

		</ul>

		
		
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column content_dashboard" style="">

			<!-- Main Content -->
			<div id="content">
					<div id="top-container">
			<img src="<?=$pages->get("name=universe-header")->banner_image->httpUrl?>" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">
			 <img src="<?=$pages->get("name=universe-header")->Banner_image_mobile->httpUrl?>" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
			</div>
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top ">
	

					 <!--Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="margin-left:auto;">
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
					<!--<ul class="navbar-nav ml-auto">-->
						<!--<img class="img-fluid" src="http://zerovaega.in/pc_rportal/site/templates/images/desktop-short.jpg" />-->

						<!-- Nav Item - Search Dropdown (Visible Only XS) -->
						<!--<li class="nav-item dropdown no-arrow d-sm-none">-->
							<!--<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
							<!--	<i class="fas fa-search fa-fw"></i>-->
							<!--</a>-->
							<!-- Dropdown - Messages -->
							<!--<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">-->
							<!--	<form class="form-inline mr-auto w-100 navbar-search">-->
							<!--		<div class="input-group">-->
							<!--			<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
							<!--			<div class="input-group-append">-->
							<!--				<button class="btn btn-primary" type="button">-->
							<!--					<i class="fas fa-search fa-sm"></i>-->
							<!--				</button>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</form>-->
							<!--</div>-->
						<!--</li>-->

						<!-- Nav Item - Alerts -->
						<!--<div class="topbar-divider d-none d-sm-block"></div>-->
							<?php 
								if($session->user_type == 'company_admin'){
									$company_user_type = "Company Admin";
								}
								else{
									$company_user_type = "Company User";
								}
							?>
						<!-- Nav Item - User Information -->
						<!--<li class="nav-item dropdown no-arrow">-->
						<!--	<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
						<!--	    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session->company_name."<br>".$company_user_type?></span>-->
								<!--<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session->name."<br>".$session->company_name."<br>".$session->email."<br>".$company_user_type?></span>-->
								<!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
							<!--</a>-->
							<!-- Dropdown - User Information -->
							<!--<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">-->
								<!-- <a class="dropdown-item" href="#">
							<!--		<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>-->
							<!--		Profile-->
							<!--	</a>-->
							<!--	<a class="dropdown-item" href="#">-->
							<!--		<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>-->
							<!--		Settings-->
							<!--	</a>-->
							<!--	<a class="dropdown-item" href="#">-->
							<!--		<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>-->
							<!--		Activity Log-->
							<!--	</a>-->
							<!--	<div class="dropdown-divider"></div> -->
							<!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModa">-->
							<!--		<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>-->
							<!--		Logout-->
							<!--	</a>-->
							<!--</div>-->
						<!--</li>-->

					<!--</ul>-->

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
								<a class="btn btn-primary" href="<?=$urls->httpRoot?>universe/?universal_logout=true">Logout</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Logout Confirmation Modal END -->
				
