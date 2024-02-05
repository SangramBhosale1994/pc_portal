<?php
$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/demoris2022.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/swiper.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?=$rootpath?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Canvas Slider Fade | Canvas</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
		<div id="header-wrap">
				<div class="container">
				    <div class="d-flex justify-content-between img-responsive">
				        <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$rootpath?>images/images_canvas/logo1.png" alt="Canvas Logo"></a>
				        </div>
				        <div> 
				        </div>
				          <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$rootpath?>images/rise_logo.jpg" alt="Canvas Logo">
				           </a>
				          </div>
				           
				        </div>
				      <div class="d-flex justify-content-between ">
				        <div id="logo" style=" margin-right: 0;" >
    				        <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$rootpath?>images/images_canvas/logo1.png" alt="Canvas Logo"></a>
				           </div>
				            <div id="logo" style=" margin-right: 0;" >
    				            <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="width: auto; padding: 10px" src="<?=$rootpath?>images/rise_logo.jpg" alt="Canvas Logo"></a>
				            </div>
				        </div>   
				        <div>  
				        </div>
				    </div>	
				</div>
			</div>
		</header><!-- #header end -->

		  <!--Slider-->
		<div class="slideshow-container">
		    <?php 
			foreach($page->Banner_repeater as $Banner_repeater)
			{
			?>
			<div class="mySlides fade">
			<!-- <div class="numbertext">1 / 3</div> -->
			<img src="<?=$Banner_repeater->banner_image->httpUrl;?>" style="width:100%">
			<!-- <div class="text">Caption Text</div> -->
			</div>
			<?php
				}
				?>
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>






		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">

				<div class="promo promo-full mt-5 mb-4">
				    <div class="container-fluid" >
						<div class="header_tabs justify-content-center flex-container" style="text-align: center;">
							<a class="flex-spacing" target="_blank" href="https://www.thepridecircle.com/" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new  ">PRIDE CIRCLE</button></a>
							<a class="flex-spacing" href="#about_rise" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-agenda ">RISE</button></a>
							<a class="flex-spacing"  href="#agenda_table" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-ep ">AGENDA</button></a>
							<a class="flex-spacing"  href="#speakers" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-speakers button_alignment">SPEAKERS</button></a>
							<a class="flex-spacing"  href="#sponsors" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-sp button_alignment">SPONSORS</button></a>
							<a class="flex-spacing"  href="#tickets" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-pc  button_alignment">EVENT&nbspPASSES</button></a>
							<a class="flex-spacing"  href="#sponsors_contact" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-gallery button_alignment">CONTACT</button></a>
							<a class="flex-spacing"  href="#rise2021faq" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-sp button_alignment">FAQ</button></a>
						</div>
					</div>
				</div>
			</div>

			<!-- paragraph section  -->
			<div class="content-wrap" id="about_rise">
            	<div class="container">
            		<div class="title_new heading-block center border-bottom-0 mb-0">
						<p>RISE (Reimagining Inclusion for Social Equity), the annual flagship event of Pride Circle, is a first-of-its-kind initiative that works towards equal opportunities and workplace inclusion for the LGBT+ community. The event that was first held in Bangalore in 2019 left strong imprints as the first & biggest LGBT+ Job Fair, Conference and Marketplace of India. Followed by its enormous success, the second edition of RISE was held in New Delhi in February 2020, which lived up to its buzz and expectations with a footfall of 1000+.</p>
            		</div>
            	</div>
            </div>
			<!-- paragraph section end -->

			<!-- 3cards section by pooja  -->
			<div class="container">
				<div class="row">
				    
					<div class="col-md-4 mb-md-2 tickets_column">
						<div class="card card_height_rise" style="">
						<div class="card-body">
						    <h2 class="title_new card-title card_text_alignmnet text-center " style="margin: 0px 0 -8px 0;">Job Fair</h2>
							<p class="card-text"></p>
							    <div class="content_height_cards_new content_height_cards">
								    <p>A thought-fest centred around the ideas and actions for diversity, equity and inclusion, now on an immersive virtual platform. With 100+ speakers from around the world get ready to witness excellence and impact of affirmative inclusion.</p> 
								</div>
								<div>
								<center><a class="flex-spacing" href="#agenda_table" style="margin-right:17px;"><button type="button" style=" margin-top: 10px;" class="btn btn-outline-primary-new  ">Register</button></a></center>
								
								</div>
						</div>
						</div>
					</div>
					<div class="col-md-4 mb-md-2 tickets_column">
						<div class="card tickets_column card_height_rise" style="">
						<div class="card-body">
							<h2 class="title_new card-title card_text_alignmnet text-center" style="margin: 0px 0 -8px 0;">Conference</h2>
							<p class="card-text">
									</p><div class="content_height_cards_new content_height_cards">
										<p>Reach out to the top, inclusive corporates from across the country, where your talents and skills will be valued - right from the comfort of your home.</p>					
									</div>

											<div class="text-center">
												
												<a target="_blank" class="flex-spacing" href="https://www.thepridecircle.com/resume/" style="margin-right:17px;"><button type="button" style=" margin-top: 10px;" class="btn btn-outline-primary-new  text-center button_align">Buy tickets</button></a>
												</div>
											<!--<a target="_blank" href="https://www.thepridecircle.com/resume/"><button  class="buttonnew button3  ">Upload your Resume</button> </a>-->
											<!--<a target="_blank" href="https://www.thepridecircle.com/jobs/"><button class="buttonnew button3  ">Explore jobs</button></a>-->
										<!--   </div>  -->
										<!--   <div class=" button-responsive mobile d-md-none" style="display: inline-flex;">-->
											<!--<a target="_blank" href="https://www.thepridecircle.com/resume/"><button  class="buttonnew button3 img-responisve buttton_height_cards">Upload your Resume</button> </a>-->
											<!--<a target="_blank" href="https://www.thepridecircle.com/jobs/"><button  class="buttonnew button3 img-responisve buttton_height_cards">Explore jobs</button></a>-->
										<!--   </div>  -->
							<p></p>    
						</div>
						</div>
					</div>
					<div class="col-md-4 mb-md-2 tickets_column">
						<div class="card card_height_rise" style="">
						<div class="card-body">
						<h2 class="title_new card-title card_text_alignmnet text-center" style="margin: 0px 0 -8px 0;">Sponsorships</h2>
							<p class="card-text">
							</p><div class="content_height_cards_new content_height_cards">
												<p>Turn your business into an E-Commerce Brand! An exclusive platform for the LGBT+ owned businesses to showcase, sell and earn on their products/services - 365 days a year, 24/7.</p>					</div>
										<div>
								<center><a class="flex-spacing" href="" style="margin-right:17px;"><button style=" margin-top: 10px;" type="button" class="btn btn-outline-primary-new  " id="btn_coming_soon">Contact</button></a></center>
								
							
								</div>
							<p></p>    
						</div>
						</div>
					</div>
			    </div>
            </div>
			<!-- 3cards section end -->

			<!-- risepast  -->
			<div class="container">
                <div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 style="#000033;" class="mb-3 mt-6"><?=$page->ally_challenge_resource_locator;?></h3>
                    <div class="removeb-margin"><?=$page->ticketing_title_toshow;?></div>
                </div>
                <div class="row justify-content-center">
                    <div class="title-hide1 col-md-10">
						<img src="<?=$page->ally_banner_image->httpUrl;?>" alt="Standard Post with Image" >
                    </div>
                </div>
				<div class="row gutter-20 mx-auto mb-5 mt-3" style="max-width: 640px;">
					<div class="col-sm-4">
						<a href="https://www.thepridecircle.com/rise2021/" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">RISE2021</a>
					</div>
					<div class="col-sm-4">
						<a href="https://www.thepridecircle.com/rise-delhi" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">RISE Delhi</a>
					</div>
					<div class="col-sm-4">
						<a href="https://www.thepridecircle.com/rise-bangalore" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">RISE Bangalore</a>
					</div>
				</div>
			<!-- paragraph section end -->
		

		</section><!-- #content end -->


		
		


		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark" style="margin-top: 8px;">
			

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-left">
							Copyrights &copy; 2020 All Rights Reserved by Canvas Inc.<br>
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
						</div>

						<div class="col-md-6 text-center text-md-right">
							<div class="d-flex justify-content-center justify-content-md-end">
								<a href="#" class="social-icon si-small si-borderless si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-gplus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-pinterest">
									<i class="icon-pinterest"></i>
									<i class="icon-pinterest"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-vimeo">
									<i class="icon-vimeo"></i>
									<i class="icon-vimeo"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-github">
									<i class="icon-github"></i>
									<i class="icon-github"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-yahoo">
									<i class="icon-yahoo"></i>
									<i class="icon-yahoo"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>
							</div>

							<div class="clear"></div>

							<i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +1-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
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

	<!-- js by pooja for top foote margin  -->
	

	


	<!-- banner slider js by pooja  -->
	<script>
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	showSlides(slideIndex = n);
	}

	function showSlides(n) {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");
	if (n > slides.length) {slideIndex = 1}    
	if (n < 1) {slideIndex = slides.length}
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	}
	slides[slideIndex-1].style.display = "contents";  
	dots[slideIndex-1].className += " active";
	}
	</script>

	<!-- second banners slider js by pooja  -->


</body>
</html>