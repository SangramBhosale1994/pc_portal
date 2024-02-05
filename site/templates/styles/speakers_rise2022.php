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

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/navigation.css">

 

	<!-- Document Title
	============================================= -->
	<title>RISE Speakers</title>

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
            
			<!-- speakers section end -->
			<footer id="footer" class="dark" style="margin-top: 8px;">
				

				<!-- Copyrights
				============================================= -->
				<div id="copyrights">
					<div class="container">

						<div class="row col-mb-30">

							<div class="col-md-6 text-center text-md-left">
								Copyrights &copy; 2022 All Rights Reserved by Pride Circle.<br>
								<div class="copyright-links"><a href="<?=$pages->get("name=terms-of-use")->httpUrl;?>">Terms of Use</a> / <a href="<?=$pages->get("name=privacy-policy")->httpUrl;?>">Privacy Policy</a></div>
							</div>

							<div class="copyright-links col-md-6 text-center text-md-right">
								<a href="mailto:contact@thepridecircle.com"><i class="icon-envelope2"></i> contact@thepridecircle.com</a>
								<div class="d-flex justify-content-end">
				
									<a target="_blank" href="<?=$page->heading2;?>" class="social-icon si-small si-borderless si-linkedin">
										<i class="white-color icon-linkedin" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-linkedin" style="font-size: 1rem;"></i>
									</a>
									<a target="_blank" href="<?=$page->heading3;?>" class="social-icon si-small si-borderless si-instagram">
										<i class="white-color icon-instagram" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-instagram" style="font-size: 1rem; background: #f09433;background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );"></i>
									</a>
									<a target="_blank" href="<?=$page->heading4;?>" class="social-icon si-small si-borderless si-facebook">
										<i class="white-color icon-facebook" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-facebook" style="font-size: 1rem;"></i>
									</a>
									<a target="_blank" href="<?=$page->heading5;?>" class="social-icon si-small si-borderless si-gplus">
										<i class="white-color icon-line2-social-youtube" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-line2-social-youtube" style="font-size: 1rem;"></i>
									</a>
									<a target="_blank" href="<?=$page->heading6;?>" class="social-icon si-small si-borderless si-twitter">
										<i class="icon-twitter" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-twitter" style="font-size: 1rem;"></i>
									</a>
									<a target="_blank"  href="<?=$page->heading7;?>" class="social-icon si-small si-borderless  si-tripadvisor">
										<i class="white-color icon-line-link" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
										<i class="icon-line-link" style="font-size: 1.5rem; background-color:#28BF7B;"></i>
									</a>
									
									
									<!--<a target="_blank" href="https://linktr.ee/PrideCircle" class="linktree"><i class="fa fa-fw fa-link" aria-hidden="true"></i></a>-->
								</div>
							</div>

						</div>

					</div>
				</div><!-- #copyrights end -->
			</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=$rootpath?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$rootpath?>scripts/js_canvas/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=$rootpath?>scripts/js_canvas/functions.js"></script>


	
</body>
</html>