<?php
	$rootpath = $config->urls->templates;
	// echo "****";
	// echo $session->user_designation;
	// echo $session->oauth_gmail;
	// echo "candidate profie";
?>
<!DOCTYPE html>
<html>
<head>
<!-- Font Awesome Icon -->
<!-- <link rel="stylesheet" href="<?=$rootpath;?>styles/css/font-awesome.min.css"> -->
<!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css"> -->

<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/resume_header.css" />

<!-- <link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/home.css?v=11.04" />
<link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/sidebar.css" /> -->
	<!-- Stylesheets-->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-C3XCR831MS');
	</script> -->

	

	<!-- Document Title
	============================================= -->
	<!-- <title><?=$resume_header_page->title?></title> -->

	<?php /* resume_header_page specific CSS by Amrut Todkar 2022-01-16 */ ?>

	<style type="text/css">
		.full-header .header-logo {
			padding-right: 0px !important;
		}

		.full-header .header-logo {
			padding-right: 30px;
			border-right: 1px solid #EEE;
		}

		.header-logo {
			position: relative;
			display: -ms-flexbox;
			display: flex;
			align-items: center;
			-ms-flex-align: center;
			margin-right: auto;
			max-height: 100%;
		}
		.header-wrap-clone {
			display: none;
		}
		.navbar a{
			color:black;
		}
	</style>
</head>
<body>
<!-- Header -->
<?php
	$resume_header_page=$pages->get("name=resume-header");
?>
<div class="container-fluid resume_header_container">


<nav id="navbar" class="[ navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<img id="navbar-md-logo" class="[  header_logo_one ][ d-none d-md-inline-block ]" src="<?=$resume_header_page->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt="">

		<div class="[ container ]">
		    <div class="navbar_container">
		          <a class=" [ navbar-brand mobile_1st_logo ][ d-sm-inline-block d-md-none ]" href="#">
    				<img class="navbar_img" src="<?=$resume_header_page->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt="">
    
    			</a>
    		
		    </div>
				
			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[ w-100 ][ d-flex align-items-center justify-content-md-around flex-sm-row justify-content-sm-center ][ navbar-nav ]">
				    <?php
				        foreach($resume_header_page->header_menus as $header_menus){
				                if($header_menus->sub_menu==""){
				            ?>
									
												<li class="nav-item active" style="text-align:center">
														<?php
														//echo strpos($header_menus->resume_header_page_redirection_url,"#");
														if($header_menus->page_redirection_url!=""){
																if(substr($header_menus->page_redirection_url, 0, 1 ) === "#"){
																		$target="";
																}
																else{
																		$target="_blank";
																}
																
														?>

														<a  class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->page_redirection_url;?>"><?=$header_menus->title;?></a>
													
														<?php
														}
														else{
														?>
															<a  class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->file->httpUrl;?>"><?=$header_menus->title;?></a>
														<?php 
														}
														?>
												</li>
											
				            	<?php
				                }
				                if($header_menus->sub_menu!=""){
				            
        				         ?>
        				        <li class="menu-item dropdown" style="text-align:center">
                					<a class="menu-link ( underline-button ) dropdown-toggle"  href="#"  aria-expanded="false" ><?=$header_menus->title;?></a>
                					    <ul class="dropdown-menu dropdown-menu-dark header_dropdown" >
                					        	
                    				       <?php
                    				          // }
                				            foreach($header_menus->sub_menu as $sub_menu){
                				        ?>
                                        <li class="dropdown-content">
                                          <?php
                                            if($sub_menu->page_redirection_url!=""){
                                          ?>
                                          <a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$sub_menu->page_redirection_url;?>"><?=$sub_menu->title;?></a>
                                          <?php
                                            }
                                            else{
                                          ?>
                                            <a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$sub_menu->file->httpUrl;?>"><?=$sub_menu->title;?></a>
                                          <?php  
                                            }
                                          ?>
                                        </li>
                                        <?php
                                    		}
                                    	?>
                                    </ul>
            					</li>
				           
					    
				    <?php
				            }
				        }
				    ?>
						<?php
							if($session->oauth_gmail!=""){
								$header_menus_resume="My Account";
								$candidate_page=$pages->get("name=candidates")->child("oauth_gmail=".$session->oauth_gmail);
								
						?>

						<li class="menu-item dropdown" style="text-align:center">
							<div class="menu-link ( underline-button ) dropdown-toggle"    aria-expanded="false" ><?=$header_menus_resume;?></div>
						
							<ul class="dropdown-menu dropdown-menu-dark header_dropdown" >
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$candidate_page->httpUrl?>">View Account</a>
									
								</li>
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$candidate_page->httpUrl?>#applied_job">Applied Jobs</a>
									
								</li>
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$candidate_page->httpUrl?>#applied_event">Applied Events</a>
									
								</li>
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$config->urls->httpRoot?>resume/?candidate_logout=true">Logout</a>
									
								</li>
							
							
							</ul>
						</li>
						<?php
							}else{
						?>
						<li class="menu-item dropdown" style="text-align:center">
							<div class="menu-link ( underline-button ) dropdown-toggle"    aria-expanded="false" >Upload Resume</div>
						
							<ul class="dropdown-menu dropdown-menu-dark header_dropdown"  >
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$config->urls->httpRoot?>resume">Upload Resume</a>
									
								</li>
								<li class="dropdown-content">
									<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$config->urls->httpRoot?>resume">Login</a>
									
								</li>
							</ul>
						</li>
						<?php
							}
						?>
				
				</ul>
			</div>
		</div>
		<?php
			if($resume_header_page->header_logo2!=""){
		?>
		<img id="navbar-md-logo" class="[  header_logo_two ][ d-none d-md-inline-block ]" src="<?=$resume_header_page->header_logo2->httpUrl;?>" style="width:50px; height:auto"  alt="">
		<?php
			}
		?>
</nav>


