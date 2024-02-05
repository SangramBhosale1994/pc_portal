<?php

if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
	//Tell the browser to redirect to the HTTPS URL.
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	//Prevent the rest of the script from executing.
	exit;
}
?>
<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="<?=$page->title;?>">
    <meta property="og:image" content='<?=$pages->get('name=rise2022-header')->general_image->httpUrl;?>'>
    <meta property="og:description" content="<?=$pages->get('name=rise2022-header')->og_description?>">
    <meta property="og:url" content="<?= $page->httpUrl ?>">
    <meta property="og:type" content="article" />

    <meta name="twitter:title" content='Rise2022 Microsite'>
    <meta name="twitter:description" content="<?=$pages->get('name=rise2022-header')->og_description?>">
    <meta name="twitter:image" content='<?=$pages->get('name=rise2022-header')->general_image->httpUrl;?>'>
    <meta name="twitter:card" content="<?=$page->title;?>">

    <meta property="og:site_name" content="<?=$page->title;?>">
    <meta name="twitter:image:alt" content="<?=$page->title;?>">
    <!-- ---------- META TAGS END ---------- -->

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_rise.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/demoris2022.css?v=24.12" type="text/css" />
	<link rel="shortcut icon" type="image/png" href="<?=$urls->httpTemplates?>images/frontend/favicon.png"/>
	<link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/navigation.css">

 

	<!-- Document Title
	============================================= -->
	<title>RISE Sponsors</title>
	<style>
		/* css by pooja for social icons */

		.social-icon1 {
			font-size: 1.1rem !important;
			width: 35px !important;
			height: 35px !important;
		}
		.si-colored.si-instagram {
			background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%) !important;
		}
		.si-instagram:hover{
			background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%) !important;
		}
		.si-tripadvisor:hover{
			background-color:#28BF7B !important;
		}

	</style>

    </head>
<body>

    <!-- banner images section by pooja -->
    <section id="content">
        <div class=" img-responsive "> 
            <img style="" class="img-fluid" src="<?=$pages->get("name=rise2022-speakers")->banner_image->httpUrl;?>">
        </div>
        <div class="img-responsive  mobile" >
            <img class="img-fluid"  src="<?=$pages->get("name=rise2022-speakers")->Banner_image_mobile->httpUrl;?>">
        </div>
    </section>
    <!-- bannerimage section end -->

    <!-- speakers section by pooja -->
    
		<div id="section-multipage" class="page-section center bg-transparent mb-0 clearfix">
			<div class="px-5 container-fluid" style="max-width: 1600px">

				<!--sponsors and partner section-->
					<?php
					if($pages->get("name=rise-2022-microsite")->ally_social_media_title!=""){
						$job_fair_sponsors=$pages->get("name=rise-2022-microsite");
					?>	
					<div class="title_new heading-block center border-bottom-0 mb-0 ">
						<h3 style="#000033;" class="mb-4 mt-4"><?=$job_fair_sponsors->ally_social_media_title;?></h3>
					</div>
                
						<?php 
							foreach($job_fair_sponsors->multiple_sponsors_repeater as $multiple_sponsors_repeater)
							{
							?>
						<div class="title_new heading-block center border-bottom-0 mb-0 ">
							<h4 style="#000033;" class=""><?=$multiple_sponsors_repeater->title;?></h4>
							<div class="d-flex justify-content-center">
								<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:3px; text-align:center"></div>
							</div>
						</div>
						<div class="container mt-3 mb-6">
							<ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0 justify-content-center">
								<?php 
									foreach($multiple_sponsors_repeater->speakers_repeater as $speakers_repeater)
									{
									?>
						
								<li class="grid-item hover-effect"><a href="<?=$speakers_repeater->ally_banner_image->description;?>" style="opacity: 1;"><img src="<?=$speakers_repeater->ally_banner_image->httpUrl;?>" alt="Sponsors"></a></li>
								<?
									}
									?>
							</ul>
							
						</div>
						
							<?
							}
							?>
                <!--sponsors section end-->
            <?php
            }else{
            }
            ?>
					</div>
				</div>
            
				<style>
			/* social media icons alignment in a footer */
			.social-media-row-alignment {
				justify-content: flex-end !important;
			}
			@media (max-width: 767px){
				.social-media-row-alignment {
					justify-content: center !important;
					}		
			}
		</style>

<?php include(\ProcessWire\wire('files')->compile('includes/rise2022_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>