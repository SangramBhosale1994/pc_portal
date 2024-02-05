<?php
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
// 	//Tell the browser to redirect to the HTTPS URL.
// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 	//Prevent the rest of the script from executing.
// 	exit;
// }

	if($session->user_email == "" || $session->user_designation != "editor"){
		$session->redirect($pages->get("name=editor-login")->httpUrl);
	}
	

 require_once(\ProcessWire\wire('files')->compile('includes/candidate_table_data.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

/* TODO : Deprecate this system. Use direct values. */
	$rootpath = $config->urls->templates;
	$homepath = $urls->httpRoot."resume/";
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
	<link href="<?= $rootpath;?>styles/sb-admin-2.min.css" rel="stylesheet" async>

	<!-- Custom styles for this page -->
	<link href="<?= $rootpath;?>styles/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">

	<link rel="stylesheet" href="<?= $rootpath;?>styles/fm.tagator.jquery.css">  

	<link rel="stylesheet" href="<?= $rootpath;?>styles/style.css">

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
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon rotate-n-15">

				</div>
				<div class="sidebar-brand-text mx-3">Pride Circle Editor</div>
			</a>

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
            
            <?php 
                $editor_email = $session->user_email;
                //echo $editor_email;
	            $editor_page = $pages->get("name=editors")->child("email=".$editor_email);
	            //echo $editor_page;
	            //$sidebar_option = $pages->get("name=editor-dashboard-sections")->children();
	            //echo $sidebar_option;
	            foreach($editor_page->accessible_sections as $editor_accessible_section)
                {  ?>
                    
                 
             
			<!-- Nav Item - Tables -->
			<?php
			   if($editor_accessible_section->name == "dashboard"){
                //  <!--echo $sidebar_option->title;-->
                 ?>
	                
			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<!--<span>Dashboard</span></a>-->
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
			<?php } 
			   elseif($editor_accessible_section->name == "manage-candidates"){
                 //echo $sidebar_option->title;
                 ?>

			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-candidate-table/">
					<i class="fas fa-fw fa-table"></i>
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
			<?php } 
			   elseif($editor_accessible_section->name == "favourite-profiles"){
                //  <!--echo $sidebar_option->title;-->
                 ?>

			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-favourite-table/">
					<i class="[ fas fa-fw fa-check-circle ]"></i>
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
			<?php } 
			   elseif($editor_accessible_section->name == "unlocked-profiles"){
                //  <!--echo $sidebar_option->title;-->
                 ?>

			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-unlocked-table/">
					<i class="[ fas fa-fw fa-arrow-circle-down ]"></i>
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
			<?php } 
			   elseif($editor_accessible_section->name == "export-table"){
                //  <!--echo $sidebar_option->title;-->
                 ?>

			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-export-table/">
					<i class="fas fa-fw fa-file-export"></i>
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
			<?php   
			   } 
			  
			   elseif($editor_accessible_section->name == "editor_company_data"){
                
            ?>
			<li class="nav-item active">
				<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/editor_company_data/">
					<i class="fas fa-fw fa-file-export"></i>
					<span><?=$editor_accessible_section->title;?></span></a>
			</li>
        <?php
			    }
					elseif($editor_accessible_section->name == "editor-seller-data"){
                
            ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/editor-seller-data/">
						<i class="fas fa-fw fa-file-export"></i>
						<span><?=$editor_accessible_section->title;?></span></a>
				</li>
				<?php
			    }
					elseif($editor_accessible_section->name == "editor-referrer-data"){
                
            ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/editor-referrer-data/">
						<i class="fas fa-fw fa-file-export"></i>
						<span><?=$editor_accessible_section->title;?></span></a>
				</li>
        <?php
			    }elseif($editor_accessible_section->name == "editor-manage-jobs"){
                
            ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-manage-jobs/">
						<i class="fas fa-fw fa-file-export"></i>
						<span><?=$editor_accessible_section->title;?></span></a>
				</li>
        <?php
					}elseif($editor_accessible_section->name == "editor-manage-recruiters"){
                
            ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-manage-recruiters/">
						<i class="fas fa-fw fa-file-export"></i>
						<span><?=$editor_accessible_section->title;?></span></a>
				</li>
				<?php
					}elseif($editor_accessible_section->name == "manage-events"){
                
            ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/pc-editor/editor-manage-events/">
						<i class="fas fa-fw fa-calendar-day"></i>
						<span><?=$editor_accessible_section->title;?></span></a>
				</li>
        <?php
						}elseif($editor_accessible_section->name == "job-fair-verification"){
                
							?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/job-fair-verification/">
							<i class="fas fa-fw fa-calendar-day"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
						}elseif($editor_accessible_section->name == "attendee-data"){
                
							?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/attendee-data/">
							<i class="fas fa-fw fa-calendar-day"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
			    }
					elseif($editor_accessible_section->name == "vip-approval-data"){
                
            ?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/vip-approval-data/">
							<i class="fas fa-fw fa-file-export"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
						}elseif($editor_accessible_section->name == "billing-data"){
                
							?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/billing-data/">
							<i class="fas fa-fw fa-calendar-day"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
						}elseif($editor_accessible_section->name == "all-ticketing-data"){
                
							?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/all-ticketing-data/">
							<i class="fas fa-fw fa-calendar-day"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
						}elseif($editor_accessible_section->name == "candidate-bulk-resume-upload"){
                
							?>
					<li class="nav-item active">
						<a class="nav-link" href="<?=$config->urls->httpRoot ?>resume/editor-dashboard-sections/candidate-bulk-resume-upload/">
							<i class="fas fa-fw fa-users"></i>
							<span><?=$editor_accessible_section->title;?></span></a>
					</li>
					<?php
						}
					else{}
                }
           
            ?>
					

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<!-- <div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div> -->

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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
								<a class="btn btn-primary" href="<?=$urls->httpRoot?>resume/pc-editor/editor-login/?editor_logout=true">Logout</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Logout Confirmation Modal END -->
