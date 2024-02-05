	<!-- /**Code By Amruta jagatap : 22-08-2022 */ -->
<?php
$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="<?=$page->title;?>">
    <meta property="og:image" content='<?=$pages->get('name=training-header')->general_image->httpUrl;?>'>
    <meta property="og:description" content="<?=$pages->get('name=training-header')->og_description?>">
    <meta property="og:url" content="<?= $page->httpUrl ?>">
    <meta property="og:type" content="article" />

    <meta name="twitter:title" content='training Microsite'>
    <meta name="twitter:description" content="<?=$pages->get('name=training-header')->og_description?>">
    <meta name="twitter:image" content='<?=$pages->get('name=training-header')->general_image->httpUrl;?>'>
    <meta name="twitter:card" content="<?=$page->title;?>">

    <meta property="og:site_name" content="<?=$page->title;?>">
    <meta name="twitter:image:alt" content="<?=$page->title;?>">
    <!-- ---------- META TAGS END ---------- -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-C3XCR831MS');
	</script> -->

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/training.css?v=27.01.23" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/swiper.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="shortcut icon" type="image/png" href="<?=$urls->httpTemplates?>images/frontend/favicon.png"/>
	<link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />

	<!-- fonts by pooja  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	
	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css"> -->
	<!-- Fonts Style CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?=$rootpath;?>styles/owl.css">
	
<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
	<script src="https://unpkg.com/tooltip.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript" async></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	
	<script src="<?= $rootpath;?>scripts/owl.js" type="text/javascript" async></script>
	
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>
	
	<script>
		// $(document).ready(function(){
		// 	$("#navbar-toggler").on("click", "#navbarNav .nav-link", function(){
		// 		console.log("5");
		// 		if(!$("#navbar-toggler").hasClass("collapsed")){
		// 			console.log("6");
		// 			$("#navbar-toggler").addClass("collapsed");
		// 			$("#navbar-toggler").attr("aria-expanded", "false");
		// 			$("#navbarNav").removeClass("show");

		// 		}
		// 	})
		// });
		</script>

	<!-- Document Title
	============================================= -->
	<title><?=$page->title?></title>

	<?php /* Page specific CSS by Amrut Todkar 2022-01-16 */ ?>

	<style type="text/css">
		/* .full-header .header-logo {
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
		} */

		/* Style for the navbar */
#navbar-md-logo{
	position: relative;
	left: 0;
	top: 0;
}

#navbar, .shodow{
	-webkit-box-shadow: 0 3px 6px -6px black;
	-moz-box-shadow: 0 3px 6px -6px black;
	box-shadow: 0 3px 6px -6px black;
}

#navbar .nav-link{
	color: #000;
}
.navbarNav{
	display: block !important;
}
.navbar_menu{
	width: 73% !important;
  float: right;
}
.underline-button {
	font: bold 14px/1.4 'Montserrat', sans-serif;
	color: #000;
	text-transform: uppercase;
	text-decoration: none;
	letter-spacing: 0.10em;

	display: inline-block;
	position: relative;
	
	padding: 0.5rem 1rem;
}

	/* .hide-header-mob-view{
		display:block;
	} */
	.hide-header-web-view{
		display:none;
	}

@media only screen and (max-width: 576px) {
	.underline-button {
		padding-top: 1.2rem;
	}
}

.underline-button.active,.underline-button[aria-expanded=true],.underline-button:hover{
	text-decoration: none;
	color: rgb(66,139,202) !important;
}
.underline-button:after {
	background: none repeat scroll 0 0 transparent;
	bottom: 0;
	content: "";
	display: block;
	height: 2px;
	left: 40%;
	position: absolute;
	background: #000;
	transition: width 0.3s ease 0s, left 0.3s ease 0s;
	width: 20%;
}
.underline-button.active:after,.underline-button[aria-expanded=true]:after,.underline-button:hover:after {
	width: 100%;
	left: 0;
	background: rgba(66,139,202, 1);
}

.dropdown-toggle::after {
	border-top:none;
}
.header_logo_one{
	margin-left:5rem;
}
/* .header_logo_two{
	margin-right:5rem;
} */
.dropdown-menu{
	min-width: 0rem;
	top: 105%;
	padding:0 0 0.5rem 0;
	margin:0px;
}

.menu-item .dropdown-menu{ display: none; }
.menu-item:hover .dropdown-menu{ display: block; }
.dropdown-item {
	display: block;
	width: 100%;
	padding: 0.5rem 1.5rem;
	clear: both;
	font-weight: 400;
	color: #212529;
	text-align: inherit;
	white-space: nowrap;
	/* background-color: transparent; */
	border-radius: 10px;
}
.dropdown-item.active, .dropdown-item:active{
	color: rgb(66,139,202) !important;
}

@media screen and (max-width: 895px) and (min-width: 780px) {
	.header_logo_one{
	margin-left:2rem;
}
.header_logo_two{
	margin-right:3rem;
}

}

@media only screen and (max-width: 991px) and (min-width: 768px) {
	/*@media screen and (max-width: 900px) and (min-width: 769px){*/
	/*@media only screen and (max-width: 900px){*/
		 
			 .navbar .header_logo_one{
					display:none!important;
			}
			.navbar .header_logo_two{
					display:none!important;
			}
			
			/* .navbar .container{*/
			/*     display:flex!important;*/
					
			/*}*/
			 .navbar-brand {
					display:inline-block!important;
			}
			
	}
	/* ============ small devices ============ */
@media (max-width: 991px) {
  .dropdown-menu .dropdown-menu{
      margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
  }
}	
/* ============ small devices .end// ============ */
@media screen and (max-width: 568px) and (min-width: 320px) {
.e-widget-wrapper{
	overflow-x: scroll;
}
}
@media (min-width: 992px){
	.navbar-expand-lg .navbar-collapse {
			display: -ms-flexbox !important;
			display: block !important;
			-ms-flex-preferred-size: auto;
			flex-basis: auto;
	}
}
@media only screen and (min-width: 594px) and (max-width: 746px){
	
	.navbar_menu {
    width: 100% !important;
    float: right;
	}
}
.underline-button.active, .underline-button[aria-expanded=true], .underline-button:hover{
	color: #41007a !important;
}
.underline-button.active:after, .underline-button[aria-expanded=true]:after, .underline-button:hover:after{
	background: #ffbd1a !important;
}
@media (min-width: 768px){
	
	.navbar_menu {
    width: 92% !important;
    float: right;
	}
	
}
@media (max-width: 768px){
	.hide-header-mob-view{
		display:none;
	}
	.hide-header-web-view{
		display:block;
	}
	.mob_logo{
		padding:0.5rem;
	}
	.svg-trigger {
    width: 50px !important;
    height: 45px !important;
	}
	.menu-item:not(:first-child) {
    border-top: none !important;
	}
	.mob_header_menu_container{
		text-align:center;
		margin: 0rem 0 !important;
	}
}

	</style>
	

	<?php /* Page specific CSS by Amrut Todkar 2022-01-16 END */ ?>




</head>

<body class="stretched training_page_body">
    <!-- header by amrut sir  -->
    <?php /* Header with dropdown menu by Amrut Todkar 2022-01-16 (Original code from Amruta Jagatap) */ ?>

	
	<nav id="navbar" class="hide-header-mob-view [ navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<a target="_blank" href="<?=$pages->get("name=training-header")->header_logo1->description;?>"><img id="navbar-md-logo" class="[  header_logo_one ][ d-none d-md-inline-block ]" src="<?=$pages->get("name=training-header")->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt=""></a>

		<div class="[ container ]">
		    <div class="navbar_container">
		      <a target="_blank" class=" [ navbar-brand mobile_1st_logo ][ d-sm-inline-block d-md-none ]" href="<?=$pages->get("name=training-header")->header_logo1->description;?>">
    				<img class="navbar_img" src="<?=$pages->get("name=training-header")->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt="">
    
    			</a>
		    </div>
				
			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[  ][ d-flex align-items-center justify-content-md-around flex-sm-row justify-content-sm-center ][ navbar-nav ] navbar_menu">
				    <?php
				        foreach($pages->get("name=training-header")->header_menus as $header_menus){
				                if($header_menus->sub_menu==""){
				            ?>
				            <li class="nav-item active" style="text-align:center">
				                <?php
				                //echo strpos($header_menus->page_redirection_url,"#");
                        if($header_menus->page_redirection_url!=""){
				                    if(substr($header_menus->page_redirection_url, 0, 1 ) === "#"){
				                        $target="";
				                    }
				                    else{
				                        $target="_blank";
				                    }
				                ?>

        					    <a  class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->page_redirection_url;?>"><?=$header_menus->title;?><?php if($header_menus->title=="Register"){?><sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup><?php } ?></a>
                      <?php
                        }
                        else{
                        ?>
                          <a  class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->file->httpUrl;?>"><?=$header_menus->title;?><?php if($header_menus->title=="Register"){?><sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup><?php } ?></a>
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
                					    <ul class="dropdown-menu dropdown-menu-dark" >
                					        	
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
				</ul>
			</div>
		</div>

	</nav>

	<!-- header by pooja for mobile view -->
		<header id="header" class="hide-header-web-view full-header" data-mobile-sticky="true">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo" class="mob_logo">
							<a target="_blank" href="<?=$pages->get("name=training-header")->header_logo1->description;?>" class="standard-logo" data-dark-logo="<?=$page->child("name=training-header")->header_logo1->httpUrl;?>"><img src="<?=$pages->get("name=training-header")->header_logo1->httpUrl;?>" alt=""></a>
							<a target="_blank" href="<?=$pages->get("name=training-header")->header_logo1->description;?>" class="retina-logo" data-dark-logo="<?=$page->child("name=training-header")->header_logo1->httpUrl;?>"><img src="<?=$pages->get("name=training-header")->header_logo1->httpUrl;?>" alt=""></a>
						</div><!-- #logo end -->

						<div class="header-misc">
							<a target="_blank" href="<?=$pages->get("name=training-header")->header_logo2->description;?>" class="standard-logo" data-dark-logo="<?=$page->child("name=training-header")->header_logo2->httpUrl;?>"><img style="height: 60px;margin-top:0.4rem;margin-bottom: 0.4rem;" src="<?=$pages->get("name=training-header")->header_logo2->httpUrl;?>" alt=""></a>
						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container mob_header_menu_container">
							<?php
								$value = "yes";
    							foreach($pages->get("name=training-header")->header_menus as $header_menu){
									if(strval($header_menu->heading2) == strval($value)){
										$new_tab="_blank";
									}else{
										$new_tab="_self";
									}
    							?>
								<li class="menu-item">
									<a class="menu-link ( underline-button )" target="<?=$new_tab;?>" href="<?=$header_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_menu->title?></div></a>
									<?php
    										/* Check if this menu has a submenu */
    									if ($header_menu->sub_menu != "") {
    									?>
									<ul class="sub-menu-container">
									<?php
		    									/* Loop through the sub-menu items */ 
												$value = "yes"; 
		    									foreach($header_menu->sub_menu as $header_sub_menu){
													if(strval($header_sub_menu->heading2) == strval($value)){
														$new_tab="_blank";
													}else{
														$new_tab="_self";
													}
		    								?>
										<li class="menu-item">
											<a class="menu-link ( underline-button )" target="<?=$new_tab;?>" href="<?=$header_sub_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_sub_menu->title?></div></a>
										</li>
										<?php
		    									}
		    									/* Loop through the sub-menu items END */
		    								?>
									</ul>
									<?php
	    									}
	    									/* Check if this menu has a submenu END */
	    								?>
								</li>
							<?php
								}
								?>
							</ul>

						</nav><!-- #primary-menu end -->


					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header>

		<!-- header for mobile view end  -->

	

	

	

		<!-- header for mobile view end  -->
