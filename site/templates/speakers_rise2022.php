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
	<title>RISE Speakers</title>
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
				<div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 class="mb-4 mt-6"><?=$pages->get("name=rise2022-speakers")->title;?></h3>
                </div>

						<?php 
                        foreach($pages->get("name=rise2022-speakers")->children() as $speakers_type)
                        {
                        ?>
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h4 class="mb-4"><?=$speakers_type->title;?></h4>
                        </div>
						<div id="intro-multipages-container" class="row col-mb-50 mb-3 justify-content-center">
						    <?php 
                            foreach($speakers_type->children() as $speakers_detials)
                            {
                            ?>
							<div class="grid-intro-item col-lg-1-5 col-md-4 col-sm-6 col-12">
								<div class="portfolio-item">
									<div class="portfolio-image  rounded-lg">
										<img src="<?=$speakers_detials->ally_banner_mobile_image->httpUrl;?>" alt="Speakers">
									</div>
									<div class="row mt-2 justify-content-center">
										<!-- social media icons repeater -->
									<?php 
										foreach($speakers_detials->social_media_repeater as $social_media_repeater)
										{
										?>
									    <a href="<?=$social_media_repeater->covid_19_title;?>" class="social-icon1 social-icon si-colored si-<?=$social_media_repeater->title;?>" title="<?=$social_media_repeater->title;?>">
											<i class="icon-<?=$social_media_repeater->title;?>"></i>
											<i class="icon-<?=$social_media_repeater->title;?>"></i>
										</a>
										<?php
										}
										?>
										<!-- social media icons repeater end  -->
									</div>
									<div class="portfolio-desc center pb-0">
										<h3><?=$speakers_detials->title;?></h3>
										<div><?=$speakers_detials->ally_challenge_leaderboard_timestamp;?></div>
        							    <div><?=$speakers_detials->ally_challenge_resource_locator;?></div>
        							    <div><?=$speakers_detials->ally_social_media_title;?></div>
									</div>
								</div>
							</div>
							<?
                            }
                            ?>
						</div>
						<?
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

		<div class="container mb-5">
			<div class="row justify-content-center">
			<?php 
				foreach($page->speakers_buttons as $speakers_buttons)
				{
				?>
				<div class="col-md-3 col-12 mt-1">
					<a href="<?=$speakers_buttons->heading3;?>" target="_blank" data-scrollto="#section-demos" class="btn btn-red button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px"><?=$speakers_buttons->heading2;?></a>
				</div>
				<?php
				}
				?>
			</div>
		</div>

<?php  include 'includes/rise2022_footer.php'; ?>