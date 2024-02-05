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
                        <section id="header_rise">
				            <div class=" img-responsive " > 
							    <img style="" class="img-fluid" src="<?=$page->ally_banner_image->httpUrl;?>">
							</div>
							<div class="img-responsive  mobile">
								 <img class="img-fluid"  src="<?=$page->ally_banner_mobile_image->httpUrl;?>">
							 </div>
                        </section>


        
        <div class="container" style="margin-top:2rem;">
            <h2 style="font-family: 'Montserrat', sans-serif;" class="text-center"><?=$page->title?></h2>
            
            <div>
                <?=$page->ticketing_terms_conditions?>
            </div>
            
        </div>







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