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
	<title><?=$page->title;?></title>

    </head>
<body>
                        <section id="header_rise">
				            <div class=" img-responsive " > 
							    <img style="" class="img-fluid" src="<?=$page->ally_banner_image->httpUrl;?>">
							</div>
							<div class="img-responsive  mobile">
								 <img class="img-fluid"  src="<?=$page->ally_banner_mobile_image->httpUrl;?>">
							 </div>
                        </section>


        
        <div class="container mt-3 mb-6">
            <h2 style="font-family: 'Montserrat', sans-serif;" class="text-center"><?=$page->title?></h2>
            
            <div>
                <?=$page->ticketing_terms_conditions?>
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
		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark" style="background:#020202;">
			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30 justify-content-center">

						

						<div class="order-lg-1 col-lg-4 ">
						    <div class="d-flex justify-content-center justify-content-lg-start">
							            <a target="_blank" href="<?=$pages->get("name=rise-2022-footer")->heading2;?>" class="social-icon si-small si-borderless si-linkedin">
											<i class="white-color icon-linkedin" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-linkedin" style="font-size: 1rem;"></i>
										</a>
										<a target="_blank" href="<?=$pages->get("name=rise-2022-footer")->heading3;?>" class="social-icon si-small si-borderless si-instagram">
											<i class="white-color icon-instagram" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-instagram" style="font-size: 1rem;"></i>
										</a>
		                                <a target="_blank" href="<?=$pages->get("name=rise-2022-footer")->heading4;?>" class="social-icon si-small si-borderless si-facebook">
											<i class="white-color icon-facebook" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-facebook" style="font-size: 1rem;"></i>
										</a>
		                                <a target="_blank" href="<?=$pages->get("name=rise-2022-footer")->heading5;?>" class="social-icon si-small si-borderless si-gplus">
											<i class="white-color icon-line2-social-youtube" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-line2-social-youtube" style="font-size: 1rem;"></i>
										</a>
										<a target="_blank" href="<?=$pages->get("name=rise-2022-footer")->heading6;?>" class="social-icon si-small si-borderless si-twitter">
											<i class="icon-twitter" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-twitter" style="font-size: 1rem;"></i>
										</a>
										<a target="_blank"  href="<?=$pages->get("name=rise-2022-footer")->heading7;?>" class="social-icon si-small si-borderless  si-tripadvisor">
											<i class="white-color icon-tree" style="color: rgba(255,255,255,0.4);font-size: 1rem;"></i>
											<i class="icon-tree" style="font-size: 1rem;"></i>
										</a>
							</div>
						</div>

						<div class="order-lg-2 copyright-links col-lg-3 text-center text-lg-right">
							<a href="tel:<?=$pages->get("name=rise-2022-footer")->ally_social_title_color;?>"><i style="margin-right: 0.3rem" class="icon-line-phone-call"></i><?=$pages->get("name=rise-2022-footer")->ally_social_title_color;?></a>
								<br>
							<a href="mailto:<?=$pages->get("name=rise-2022-footer")->heading8;?>"><i style="margin-right: 0.3rem" class="icon-envelope2"></i><?=$pages->get("name=rise-2022-footer")->heading8;?></a>
						</div>

						<div class="order-lg-0 col-lg-5 text-center text-lg-left">
						Copyrights &copy; <?php $year = date("Y"); echo $year;?> All Rights Reserved by Pride Circle.<br>
						<div class="copyright-links"><a href="<?=$pages->get("name=terms-of-use")->httpUrl;?>" target="_blank">Terms of Use</a> / <a href="<?=$pages->get("name=privacy-policy")->httpUrl;?>"  target="_blank">Privacy Policy</a> / <a href="<?=$pages->get("name=disclaimer")->httpUrl;?>" target="_blank">Disclaimer</a></div>
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