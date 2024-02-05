	
<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
?>
<?php
$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"> 
<head>

	<!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="<?=$page->title;?>">
    <meta property="og:image" content='<?=$pages->get('name=header2023')->general_image->httpUrl;?>'>
    <meta property="og:description" content="<?=$pages->get('name=header2023')->og_description?>">
    <meta property="og:url" content="<?= $page->httpUrl ?>">
    <meta property="og:type" content="article" />

    <meta name="twitter:title" content='<?=$page->title;?>'>
    <meta name="twitter:description" content="<?=$pages->get('name=header2023')->og_description?>">
    <meta name="twitter:image" content='<?=$pages->get('name=header2023')->general_image->httpUrl;?>'>
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
	<link rel="stylesheet" href="<?=$rootpath?>styles/demoris2022.css?v=01.07.22" type="text/css" />
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
	
	

	

	<!-- Document Title
	============================================= -->
	<title><?=$page->title?></title>

	<?php /* Page specific CSS by Amrut Todkar 2022-01-16 */ ?>

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
	</style>
	

	<?php /* Page specific CSS by Amrut Todkar 2022-01-16 END */ ?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60252624918aa261273df0f4/1eu8hq06f';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

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


</head>

<body class="stretched">
    <!-- header by amrut sir  -->
    <?php /* Header with dropdown menu by Amrut Todkar 2022-01-16 (Original code from Amruta Jagatap) */ ?>
<?php
if(false){
?>
	<nav id="navbar" class="[ hide-header-mobile-view navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<a  href="<?=$pages->get("name=header2023")->header_logo1->description;?>"><img id="navbar-md-logo" class="[  header_logo_one ][ d-none d-md-inline-block ]" src="<?=$pages->get("name=header2023")->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt=""></a>

		<div class="[ container ]">
		    <div class="navbar_container">
		        <a  class=" [ navbar-brand mobile_1st_logo ][ d-sm-inline-block d-md-none ]" href="<?=$pages->get("name=header2023")->header_logo1->description;?>" >
    				<img class="navbar_img" src="<?=$pages->get("name=header2023")->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt="">		
    			</a>
    			<?php
    			  if($pages->get("name=header2023")->header_logo2!=""){
    			?>
    			<a target="_blank" class=" [ navbar-brand mobile_2nd_logo ][ d-sm-inline-block d-md-none ]" href="<?=$pages->get("name=header2023")->header_logo2->description?>">
    				<img class="navbar_img" src="<?=$pages->get("name=header2023")->header_logo2->httpUrl;?>" style="width:69px; height:auto"  alt="">	
    			</a>
          		<?php
    			  }
    			?>
		    </div>
			
			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[ w-100 ][ d-flex align-items-center justify-content-md-around flex-sm-row justify-content-sm-center ][ navbar-nav ]">
				    <?php
				        foreach($pages->get("name=header2023")->header_menus as $header_menus){
				                if($header_menus->sub_menu==""){
				            ?>
				            <li class="nav-item active" style="text-align:center;font-family: 'Montserrat', sans-serif !important;">
				                <?php
				                //echo strpos($header_menus->page_redirection_url,"#");
				                    if(substr($header_menus->page_redirection_url, 0, 1 ) === "#"){
				                        $target="";
				                    }
				                    else{
				                        $target="_blank";
				                    }
				                ?>
        					<a style="font-family: 'Montserrat', sans-serif !important;" class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->page_redirection_url;?>"><?=$header_menus->title;?></a>
        					<?php 
        					//if($header_menus->title=="Register"){
        					?>
        					<!--<sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup>-->
        					<?php //} ?>
        					</li>
        					
        					
        					
				            <?php
				                }
				                if($header_menus->sub_menu!=""){
        				        ?>
        				        <li class="menu-item dropdown" style="text-align:center">
                					<a class="menu-link ( underline-button ) dropdown-toggle"  href="#"  aria-expanded="false" ><?=$header_menus->title;?></a>
                					    <ul class="dropdown-menu dropdown-menu-dark" >	
											<?php
											foreach($header_menus->sub_menu as $sub_menu){
											?>
											<li style="font-family: 'Montserrat', sans-serif !important;" class="dropdown-content"><a style="font-family: 'Montserrat', sans-serif !important;" class="dropdown-item menu-link ( underline-button )" href="<?=$sub_menu->page_redirection_url;?>"><?=$sub_menu->title;?></a></li>
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
		<?php
			if($pages->get("name=header2023")->header_logo2!=""){
		?>
		<a target="_blank" href="<?=$pages->get("name=header2023")->header_logo2->description;?>"> <img id="navbar-md-logo" class="[  header_logo_two ][ d-none d-md-inline-block ]" src="<?=$pages->get("name=header2023")->header_logo2->httpUrl;?>" style="width:69px; height:auto"  alt=""></a>
		<?php
			}
		?>
	</nav>
<?php
}
?>
		<header id="header" class="hide-header-mobile-view full-header sticky-header sticky-header-shrink" data-sticky-shrink="true">
			<div id="header-wrap">
				<div class="container">
				    <div class="d-flex justify-content-between img-responsive">
				        <div  style=" margin-right: 0;" >
				           <a href="<?=$pages->get("name=header2023")->header_logo1->description;?>"  class="standard-logo img-responsive"  >
						   		<img style="height: 80px; width: auto; padding: 5px" src="<?=$pages->get("name=header2023")->header_logo1->httpUrl;?>" alt="Pride Circle Logo"/>
				           </a> 
				        </div>
				        <div>
				            <!--web view navigation bar-->
				           <nav class="primary-menu" style="height: 80px; ">
    							<ul class="menu-container" style="justify-content: center; margin-right: 0px;">
    								
    								<?php
										$value = "yes";
    									/* Loop through the main menu items */ 
    									foreach($pages->get("name=header2023")->header_menus as $header_menu){
											if(strval($header_menu->heading2) == strval($value)){
												$new_tab="_blank";
											}else{
												$new_tab="_self";
											}
    								?>
    								
    								<li class="menu-item"><a target="<?=$new_tab;?>" class="menu-link" style="font-size: 1rem" href="<?=$header_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_menu->title?></div></a>

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
												<a class="menu-link" target="<?=$new_tab;?>" href="<?=$header_sub_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_sub_menu->title?></div></a>
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
    									/* Loop through the main menu items END */
    								?>

    								<!-- <li class="menu-item"><a class="menu-link" href="<?=$page->httpUrl;?>#about-us"><div>ABOUT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#agenda"><div>AGENDA</div></a></li>
                                    <li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#speakers"><div>SPEAKERS</div></a></li>
                                    <li class="menu-item"><a class="menu-link"  href="<?=$page->httpUrl;?>#sponsors_and_partners"><div>SPONSORS & PARTNERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#contact_us"><div>CONTACT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#FAQs"><div>FAQS</div></a></li> -->
    							</ul>
						    </nav><!-- web view navigation bar end -->
				        </div>


				        <!-- Logo second -->
				        <div id="logo-right" class="header-logo" style=" margin-right: 0;" >
				           <a href="<?=$pages->get("name=header2023")->header_logo2->description;?>" target="_blank" class="standard-logo img-responsive" >
						   	<img  style="height: 80px; width: auto; padding: 5px" src="<?=$pages->get("name=header2023")->header_logo2->httpUrl;?>" alt="Pride Circle Logo"/>
				           </a>
				           
				        </div>
				        <!-- Second Logo End -->

				    </div>
				      <div class="d-flex justify-content-between ">
				          
				        <div>
				            
				        </div>
				    </div>
				</div>
			</div>
			<div class="header-wrap-clone" style="height: 118px;"></div>
		</header><!-- #header end -->

		<!-- header by pooja for mobile view -->
		<header id="header" class="hide-header-web-view full-header" data-mobile-sticky="true">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="<?=$pages->get("name=header2023")->header_logo1->description;?>" class="standard-logo" data-dark-logo="<?=$page->child("name=header2023")->header_logo1->httpUrl;?>"><img src="<?=$pages->get("name=header2023")->header_logo1->httpUrl;?>" alt=""></a>
							<a href="<?=$pages->get("name=header2023")->header_logo1->description;?>" class="retina-logo" data-dark-logo="<?=$page->child("name=header2023")->header_logo1->httpUrl;?>"><img src="<?=$pages->get("name=header2023")->header_logo1->httpUrl;?>" alt=""></a>
						</div><!-- #logo end -->

						<div class="header-misc">
							<a target="_blank" href="<?=$pages->get("name=header2023")->header_logo2->description;?>" class="standard-logo" data-dark-logo="<?=$page->child("name=header2023")->header_logo2->httpUrl;?>"><img style="height: 60px;margin-top:0.4rem;margin-bottom: 0.4rem;" src="<?=$pages->get("name=header2023")->header_logo2->httpUrl;?>" alt=""></a>
						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
							<?php
								$value = "yes";
    							foreach($pages->get("name=header2023")->header_menus as $header_menu){
									if(strval($header_menu->heading2) == strval($value)){
										$new_tab="_blank";
									}else{
										$new_tab="_self";
									}
    							?>
								<li class="menu-item">
									<a class="menu-link" target="<?=$new_tab;?>" href="<?=$header_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_menu->title?></div></a>
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
											<a class="menu-link" target="<?=$new_tab;?>" href="<?=$header_sub_menu->page_redirection_url?>"><div style="font-family: 'Montserrat', sans-serif !important;"><?=$header_sub_menu->title?></div></a>
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
