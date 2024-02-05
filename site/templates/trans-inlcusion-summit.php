<?php  include 'includes/tis_header.php'; ?>
<style>
	/* css by pooja for agenda section green color piles */
body {
    color: #003 !important;
}
.green-piles{
	padding: 11px 5px 11px 5px !important;
    border: 1px solid rgb(255 255 255) !important;
    background: #00a04a !important;
    margin: 0px 7px 0px 7px!important;
    text-align: center !important;
    border-radius: 5px !important;
	color: #fff !important;
}
.trans-piles h5{
	color: #fff !important;
	margin-bottom: 0px !important;
	margin: 0 0 0px 0 !important;
}

.agenda-spacing h1,h2,h3,h4,h5,h6{
	margin: 0 0 0.5rem 0 !important;
}
/* css by pooja for event passes cards  */
@media (max-width: 767px){
	.event-passes-ul-style ul{
		margin-left: 4rem;
	}
}
@media only screen and (max-width: 992px) and (min-width: 768px){
	.event-passes-ul-style ul{
		margin-left: 5rem;
	}
}	
@media (min-width: 992px){
.event-passes-ul-style ul{
	margin-left: 12rem;
}
}

/* css by pooja for ul tag */
::marker {
	color: #2c1895 !important;
}
/* .event-passes-card h1, h2, h3, h4, h5, h6, li{
	color: #fff;
}  */

.trans-piles {
    padding: 11px 5px 11px 5px !important;
    border: 1px solid rgb(255 255 255) !important;
    margin: 0px 7px 0px 7px!important;
    text-align: center !important;
    border-radius: 5px !important;
    color: #fff !important;
}
.banner-width{
	width: 100% !important;
    margin: 0 auto !important;
    position: relative !important;
}
.btn-outline-primary-new {
    color: #ffffff;
    background-color: rgb(68 68 68) !important;
    border-color: rgb(68 68 68) !important;
}
.btn-outline-primary-new:hover {
	color: rgb(68 68 68) !important;
    background-color: #ffffff !important;
    border-color: rgb(68 68 68) !important;
}

.pinkbutton {
    background-color: #f5abb9 !important;
    color: #2c1895 !important;  
}
.pinkbutton:hover {
    background-color: #ffffff !important;
    color: #2c1895 !important;
    box-shadow: 1px 1px 1px rgb(0 0 0 / 20%) !important;
}
.menu-link {
    color: #2c1895 !important;
}
@media (min-width: 992px){
	.sub-menu-container {
		border-top: 2px solid #2c1895 !important;
	}
}

.blue-font{
	color: #2c1895 !important;
}
.fslider {
    min-height: 0px !important;
}
@media (max-width: 767px){
.second-header-logo{
	height: 50px !important;
}
}
@media only screen and (max-width: 992px) and (min-width: 768px){
.second-header-logo{
	height: 78px !important;
}
}
  /* css by pooja for ul , ol tags align properly whileusing ckeditor */
.ul-tag ul li{
	margin-left: 1rem !important;
}
.ul-tag ul li ul li{
	margin-left: 1em !important;
}
@media (max-width: 906px){
	.ul-tag ul li{
	margin-left: 2rem !important;
	}
}
@media (max-width: 906px){
	.ul-tag ul li ul li{
	margin-left: 2rem !important;
	}
}

.ul-tag ol li{
margin-left: 1rem !important;
}

.ul-tag ol li ol li{
	margin-left: 1rem !important;
}
@media (max-width: 906px){
	.ul-tag ol li{
	margin-left: 2rem !important;
	}
}
@media (max-width: 906px){
	.ul-tag ol li ol li{
	margin-left: 2rem !important;
	}
}

.event-passes-spacing h1,h2,h3,h4,h5,h6{
	margin: 0px 0px 0px 0px !important;
}
.social-icon1 {
    font-size: 1.3rem !important;
    width: 39px !important;
    height: 39px !important;
}
</style>

		<?php
		if($page->Banner_repeater->banner_image!=="")
		{
		?>
		<!-- web view slider by pooja -->
		<section id="" class="hide-image-in-mobie slider-element boxed-slider">
			<div class=" clearfix">
				<div class="fslider" data-animation="fade">
					<div class="flexslider">
						<div class="slider-wrap">
							<?php 
							foreach($page->Banner_repeater as $Banner_repeater)
							{
							?>
							<div class="slide" data-thumb="<?=$Banner_repeater->banner_image->httpUrl;?>">
								<a href="<?=$Banner_repeater->banner_image->description;?>" class="d-block position-relative">
									<img class="img-fluid" src="<?=$Banner_repeater->banner_image->httpUrl;?>" alt="Slide 2">
				
								</a>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--web view slider end  -->
		<?php
		}
		?>
		
		<?php
		if($page->mobile_banner_repeater->banner_image!=="")
		{
		?>
		<!-- mobile view slider by pooja -->
		<section id="" class="hide-image-in-web slider-element boxed-slider">
			<div class=" clearfix">
				<div class="fslider" data-animation="fade">
					<div class="flexslider">
						<div class="slider-wrap">
							<?php 
							foreach($page->mobile_banner_repeater as $mobile_banner_repeater)
							{
							?>
							<div class="slide" data-thumb="<?=$mobile_banner_repeater->banner_image->httpUrl;?>">
								<a href="<?=$mobile_banner_repeater->banner_image->description;?>" class="d-block position-relative">
									<img class="img-fluid" src="<?=$mobile_banner_repeater->banner_image->httpUrl;?>" alt="Slide 2">
								</a>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- mobile view slider end  -->
		<?php
		}
		?>

		<!-- if only one image is present -->
			<!-- image for web view -->
			<?php
			if($page->web_banner_image!=="")
			{
			?>
			<section id="" class="hide-image-in-mobie slider-element boxed-slider">
				<img class="banner-width" src="<?=$page->web_banner_image->httpUrl;?>" alt="">
			</section>
			<?php
				}
				?>
			<!-- image for web view end -->

			<!-- image for web view -->
			<?php
			if($page->mob_banner_image!=="")
			{
			?>
			<section id="" class="hide-image-in-web slider-element boxed-slider">
				<img class="banner-width" src="<?=$page->mob_banner_image->httpUrl;?>" alt="">
			</section>
			<?php
				}
				?>
			<!-- image for web view end -->
		<!-- if only one image section end -->

		<!-- page content -->
			<div id="about"></div>
			<div class="mb-6"></div>
		<!-- About us paragraph section  -->
			<div class="content-wrap">
            	<div class="container">
            		<div style="text-transform: none;" class="ul-tag title_new heading-block  border-bottom-0 mb-5"><?=$page->text_description;?></div>
            	</div>
            </div>
		<!-- about us paragraph section end -->

		<!-- Description of rise section  -->
			<div class="content-wrap [ mt-4 ]" id="description_of_tis">
            	<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div style="text-transform: none;" class="ul-tag title_new heading-block  border-bottom-0 mb-5"><?=$page->ticketing_title_toshow;?></div>
						</div>
					</div>
            	</div>
            </div>
		<!-- Description of rise section end -->

		<!-- infographic section -->
		<div class="content-wrap" id="infographic">
			<div class="container">
				<div class="row justify-content-center">
					<div class="hide-image-in-mobie title-hide1 col-md-11" >
						<img src="<?=$page->infographic_web_image->httpUrl;?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;">
					</div>
					<div class="hide-image-in-web title-hide1 col-12">
						<img src="<?=$page->infographic_mobile_image->httpUrl;?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;" >
					</div>
				</div>
			</div>
			
		</div>
		<!-- infographic section end -->

		<!-- 3cards section by pooja  -->
		<div class="container mt-2 mb-6">
				<div class="row justify-content-center">
				<?php 
                    foreach($page->cards_section->find('start=0,limit=2') as $cards_section)
                    {
                    ?>
					<div class=" col-lg-6 col-md-6 mb-3">
					    <div class="story-box-info p-3" style="border: 1px solid #000033;border-radius: 0.25rem;">
							<h3 class="title_new center" style="margin: 7px;font-weight: bold;"><?=$cards_section->bank_name;?></h3>
								<div class="story-box-content">
									<div style="color:#003;" class="ul-tag cards-text align-privacy-data-for-ul"><?=$cards_section->text_description;?></div>
									<!-- <a class="flex-spacing right-margin-header"  href="<?=$cards_section->heading3;?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$cards_section->heading2;?></button></a> -->
									<div class="story-box-content1">
										<h4 style="color:#003;font-size: 1rem;margin: -0.9rem;" class="ul-tag center mt-2"><?=$cards_section->heading2;?></h4>
									
										<div class="row justify-content-center  mb-3 mt-3" style="max-width: 640px;">
		
											<?php 
											foreach($cards_section->rise_past_section_buttons as $rise_past_section_buttons)
											{
											?>
											<!-- <a class="flex-spacing" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"  href="<?=$rise_past_section_buttons->heading3;?>"><?=$rise_past_section_buttons->heading2;?></a> -->
											<a href="<?=$rise_past_section_buttons->heading3;?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$rise_past_section_buttons->heading2;?></a>
											<?php
											}
											?>
										</div>
									</div>
								</div>
						</div>
					</div>
					<?php
					}
					?>
				</div>

				<div class="row justify-content-center">
				<?php 
                    foreach($page->cards_section->find('start=2,limit=1') as $cards_section)
                    {
                    ?>
					<div class=" col-lg-12 col-md-12 mb-3">
					    <div class="story-box-info p-3" style="border: 1px solid #000033;border-radius: 0.25rem;">
							<h3 class="title_new center" style="margin: 7px;font-weight: bold;"><?=$cards_section->bank_name;?></h3>
								<div class="story-box-content">
									<div style="color:#003 !important; height:auto !important;" class="ul-tag cards-text align-privacy-data-for-ul"><?=$cards_section->text_description;?></div>
			
									<!-- <a class="flex-spacing right-margin-header"  href="<?=$cards_section->heading3;?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$cards_section->heading2;?></button></a> -->
									<div class="">
										<h4 style="color:#003 !important;" class="ul-tag mt-2 center text-white"><?=$cards_section->heading2;?></h4>
										<div class="row justify-content-center  mb-3 mt-3" style="">
											<?php 
											foreach($cards_section->rise_past_section_buttons as $rise_past_section_buttons)
											{
											?>
											<!-- <a class="flex-spacing" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"  href="<?=$rise_past_section_buttons->heading3;?>"><?=$rise_past_section_buttons->heading2;?></a> -->
											<a href="<?=$rise_past_section_buttons->heading3;?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$rise_past_section_buttons->heading2;?></a>
											<?php
											}
											?>
										</div>
									</div>
								</div>
						</div>
					</div>
					<?php
					}
					?>
				</div>
				<div id="agenda_table"></div>
		
			</div>
			<!-- 3cards section end -->

		<!-- agenda section by pooja -->
		<?php
			if($page->heading2!=="")
			{
			?>
		<div id="agenda_table" class="mb-6"></div>
		<div class="content-wrap mb-2">
					<div class="text-center title-center title-border" style="margin-bottom: 2rem; background-color:<?=$page->agenda_band_color;?>; height: 4rem;padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;"><?=$page->heading2;?></h3>
					</div>
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-11">
								<div>
											<?php 
												// default color
												$color= NULL;

												// color1
												$color1 = "#f5abb9";

												// color2
												$color2 = "#5bcffa";
												$color == $color1 ? $color=$color2 : $color=$color1;
											?>
								<?php 
									foreach($page->agenda_details as $agenda_details)
									{			   
									?>
										<div class="blue-font center mt-2 mb-2"><?=$agenda_details->text_description;?></div>
										<?php 
											foreach($agenda_details->session_details as $session_details){
											// for($x=1; $x <=$session_details; $x++){
												$color == $color1 ? $color=$color2 : $color=$color1;
											?>			   
												<div style='background-color:<?=$color;?>' class="trans-piles"><h5 style="font-size: 0.975rem;"><?=$session_details->session_text;?></h5></div>								
										<?php
											// }
											}
											?>
								<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>

				<?php
					if($page->input_filed != ""){
					?>
					<div class="container">
						<div class="row justify-content-center gutter-20 mx-auto   mt-3" style="max-width: 640px;">	
							<div class="col-sm-6">
									<a href="<?=$page->input_filed->httpUrl();?>"  target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 6px 22px;">Download the detailed Agenda</a>
								</div>
						</div>
					</div>
					<?php
						}
						?>		
		</div>
		<?php
			}
			?>
			<!-- agenda section end  -->

		<!-- page content end -->

		<!-- speakers section -->
		<?php
			if($page->heading3!=="")
			{
			?>
			<div id="speakers" class="mb-6"></div>						
			<div class="mt-1 text-center title-center title-border topmargin-sm "  style="margin-bottom: 3rem; background-color:<?=$page->speaker_band_color;?>;height: 4rem;     padding-top: 0.9rem;" >
				<h3 class="title_new" style="color:#fff !important;"><?=$page->heading3;?></h3>
			</div>
			
				<div class="page-section center bg-transparent mb-0 clearfix">
					<div class="px-5 container-fluid" style="max-width: 1600px">
						
						<?php 
                        foreach($page->speaker_repeater as $Speakers_info)
                        {
                        ?>
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h4 class="blue-font"><?=$Speakers_info->sub_title;?></h4>
                        </div>
						<div id="intro-multipages-container" class="row col-mb-50 mb-3 justify-content-center">
						    <?php 
                            foreach($Speakers_info->speaker_details as $speakers_detials)
                            {
                            ?>
							<div class="mt-4 grid-intro-item col-lg-1-5 col-md-4 col-sm-6 col-12 pb-0">
								<div class="portfolio-item">
									<div class="portfolio-image  rounded-lg">
										<img src="<?=$speakers_detials->speaker_image->httpUrl;?>" alt="Speakers">
									</div>
									<div class="row mt-2 justify-content-center">
										<!-- social media icons repeater -->
									<?php 
										foreach($speakers_detials->social_media_repeater as $social_media_repeater)
										{
										?>
									    <a href="<?=$social_media_repeater->covid_19_title;?>" target="_blank" class="social-icon1 social-icon si-colored si-<?=$social_media_repeater->title;?>" title="<?=$social_media_repeater->title;?>">
											<i class="icon-<?=$social_media_repeater->title;?>"></i>
											<i class="icon-<?=$social_media_repeater->title;?>"></i>
										</a>
										<?php
										}
										?>
										<!-- social media icons repeater end  -->
									</div>
									    
									<div class="portfolio-desc center pb-0">
										<h3 class="blue-font"><?=$speakers_detials->speaker_name;?></h3>
										<div class="blue-font"><?=$speakers_detials->speaker_title;?></div>
        							    <div class="blue-font"><?=$speakers_detials->speaker_type;?></div>
        							    <div class="blue-font"><?=$speakers_detials->speaker_organization;?></div>
									</div>
								</div>
							</div>
							<?php
                            }
                            ?>
						</div>
						<?php
                        }
                        ?>
					</div>
				</div>
		<?php
			}
			?>
		<!-- speakers section end -->

		<!-- sponsors section -->
		<?php
			if($page->heading4!=="")
			{
			?>
			<div id="sponsorship" class="mb-6"></div>
			<div class="text-center title-center title-border"  style="margin-bottom: 3rem; background-color:<?=$page->sponsors_band_color?>;    height: 4rem;     padding-top: 0.9rem;" >
				<h3 class="title_new" style="color:#fff;"><?=$page->heading4;?></h3>
			</div>
			
					<?php
					if($page->sponsorships_repeater!=="")
					{
					?>
						<!-- sponsorship div by pooja -->
						<div class="container">
							<div class="row justify-content-center">
							<?php 
								foreach($page->sponsorships_repeater as $sponsorships_repeater)
								{
								?>
								<div class=" col-lg-12 col-md-12 mb-3">
									<div class="story-box-info p-3" style="border: 1px solid #000033;border-radius: 0.25rem;">
										<h3 class="title_new center " style="margin: 7px;"><?=$sponsorships_repeater->title;?></h3>
											<div class="story-box-content mt-2">
												<div style="color:#003; height:auto !important" class="cards-text"><?=$sponsorships_repeater->text_description;?></div>
												<!-- <a class="flex-spacing right-margin-header"  href="<?=$cards_section->heading3;?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$cards_section->heading2;?></button></a> -->
												<div class="row justify-content-center  mb-3 mt-3" style="">
													<?php 
													foreach($sponsorships_repeater->rise_past_section_buttons as $rise_past_section_buttons)
													{
													?>
													<!-- <a class="flex-spacing" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"  href="<?=$rise_past_section_buttons->heading3;?>"><?=$rise_past_section_buttons->heading2;?></a> -->
													<a href="<?=$rise_past_section_buttons->heading3;?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$rise_past_section_buttons->heading2;?></a>
													<?php
													}
													?>
												</div>
											</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
							
						</div>
						
						<!-- sponsorship div end by pooja  -->
					<?php
					}
					?>
			<?php 
				foreach($page->sponsors_details as $sponsors_details)
				{
				?>
					<div class="title_new heading-block center border-bottom-0 mb-0 ">
						<h4 style="#000033;" class="blue-font"><?=$sponsors_details->heading2;?></h4>
					</div>
					<div class="container mt-3 mb-2">
						<ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0 justify-content-center">
							<?php 
								foreach($sponsors_details->sponsors as $sponsors)
								{
								?>
								<li class="grid-item hover-effect"><a target="_blank" href="<?=$sponsors->aim_logo->description;?>" style="opacity: 1;"><img src="<?=$sponsors->aim_logo->httpUrl;?>" alt="Sponsors"></a></li>
							<?php
								}
								?>
						</ul>
					</div>	
			<?php
				}
				?>
		<?php
			}
			?>
		<!-- sponsors section end -->

		<!-- event passes section by pooja -->
		<?php
			if($page->heading5!=="")
			{
			?>
				<div id="event-pass" class="mb-6"></div>
				<div class="content-wrap" style="margin-bottom: -2rem !important;" >
					<div class="text-center title-center title-border" style="margin-bottom: 5rem; background-color:<?=$page->event_passes_band_color?>; height: 4rem;padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;"><?=$page->heading5;?></h3>
					</div>
				</div>
				<div class="container mt-2">
					<div class="row justify-content-center">
					<?php 
						foreach($page->event_passes_repeater as $event_passes_repeater)
						{
						?>
						<div class="col-lg-6 col-md-6 mb-3">
							<div class="story-box-info p-3" style="border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem;background-color:#5bcffa;">
								<h3 class="event-passes-card blue-font center" style="margin: 7px;"><?=$event_passes_repeater->title;?></h3>
								<div class="event-passes-spacing mt-3 event-passes-text-color event-passes-ul-style event_passes_text">
									<?=$event_passes_repeater->text_description;?>
								</div>	
									<div class="">
										<!-- <div style="" class="center text-white"><?=$event_passes_repeater->heading2;?></div> -->
										<div class="row justify-content-center  mb-3 mt-3">
											<a class="flex-spacing" target="_blank" href="<?=$event_passes_repeater->heading4;?>"><button style="font-weight: 550 !important;" class="pinkbutton btn-outline-event-passes font-weight-light button ml-0 button-rounded"><?=$event_passes_repeater->heading3;?></button></a>
										</div>
									</div>
							</div>
						</div>
						<?php
						}
						?>						
					</div>
					
				</div>
		<?php
			}
			?>
				
			<!-- event passes section end -->

			<!-- gallery section by pooja -->
			<?php
			if($page->heading9!=="")
			{
			?>
			<div id="gallery" class="mb-6"></div>
			<div class="content-wrap" style="margin-bottom: -2rem !important;" >
				<div class="text-center title-center title-border"  style="margin-bottom: 3rem; background-color:<?=$page->gallery_band_color?>;    height: 4rem;     padding-top: 0.9rem;" >
					<h3 class="title_new" style="color:#fff;"><?=$page->heading9;?></h3>
				</div>
			</div>
			<section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:3rem;">
				<div class="content-wrap py-0">
                    <div class="container">
        				<div class="row justify-content-center">
						<?php 
						foreach($page->gallery_repeater as $gallery_repeater)
						{
						?>
						    <div class="col-md-6">
									<div id="carouselExampleCaptionsOne_<?=$gallery_repeater->id;?>" class="carousel slide" data-ride="carousel" data-interval="false">	    
										<div class="carousel-inner">
											<?php 
											    $counter = 0;
												foreach($gallery_repeater->image_slider as $image_slider)
												{
													$counter++;
													$active_text = "";
													if($counter == 1){
														$active_text = "active";
													}
												?>
										    <div class="carousel-item <?=$active_text?>">
											    
												<img src="<?=$image_slider->image->httpUrl;?>" class="d-block w-100 " alt="...">
												
											</div>
											<?php
													}
													?>
										</div>
									
										<a class="carousel-control-prev" href="#carouselExampleCaptionsOne_<?=$gallery_repeater->id;?>" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleCaptionsOne_<?=$gallery_repeater->id;?>" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									<div class="mt-2 text-center" >
										<h3><?=$gallery_repeater->heading2;?> 
										<br>
										<a target="_blank" href="<?=$gallery_repeater->heading4;?>"><small><?=$gallery_repeater->heading3;?></small></a></h3>
									</div>	
			                </div>
						<?php
						}
						?>
            				
                        </div>
                    </div>
			    </div>
		    </section>
			<?php
			}
			?>
			<!-- gallery section end -->

			<!-- rise reflection section by pooja-->
			<?php
			if($page->heading6!=="")
			{
			?>
			<div id="rise-reflection"></div>
			<div class="content-wrap" style="margin-bottom: -2rem !important;" >
				<div class="text-center title-center title-border mt-6" style="margin-bottom: 4rem; background-color:<?=$page->rise_reflection_band_color;?>; height: 4rem;padding-top: 0.9rem;">
					<h3 class="title_new" style="color:#fff;"><?=$page->heading6;?></h3>
				</div>
			</div>
			<!-- <section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem; margin-bottom: 7rem;"> -->
				<div class="content-wrap py-0">
                    <div class="container">
                        <div class="row justify-content-center">
						<?php
							foreach($page->youtube_video_repeater as $youtube_video_repeater)
							{
							?>
                            <div class="col-md-6 mt-4">
								<iframe width="677" height="400" src="https://www.youtube.com/embed/<?=$youtube_video_repeater->heading2;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>	
                            </div>
                            <?php
							}
							?>
                        </div>
                    </div>
				
				</div>
			<!-- </section> -->
			<?php
			}
			?>
			<!-- rise reflection end -->

			

			<!-- facebook and twitter embedding  -->
			<?php
				if($page->covid_19_title!=""){
				?>
			<div id="social-media"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="TEQWel07"></script>
			<div class="container-fluid title-center title-border mt-6 text-center" style="margin-bottom: 3rem; background-color:<?=$page->social_media_band_color?>;height: 4rem;padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;"><?=$page->covid_19_title;?></h3>
			</div>
			<div class="container">
				<div class="row mb-6 justify-content-center">
					<div class="col-md-5 mb-5">
					    <div class="fb-page" data-href="https://www.facebook.com/<?=$page->heading8;?>" data-tabs="timeline" data-width="800" data-height="520" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/<?=$page->heading3;?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?=$page->heading3;?>"><?=$page->heading5;?></a></blockquote></div>
					</div>
					<div class="col-md-5 mb-5">
					    <a class="twitter-timeline" data-width="500" data-height="520" href="https://twitter.com/<?=$page->conference_sponsors_section_title;?>"><?=$page->heading6;?></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				</div>
			</div>
			<?php
				}else{
			
				}
				?>
			<!-- facebook and twitter embedding end  -->

			<!-- frequently asked question section by pooja -->
			<?php
			if($page->heading7!=="")
			{
			?>
			<div class="mt-5">
			<div id="faq"></div>
					<div class="container">
						<div class="promo promo-border p-4 p-md-5 mb-6">
							<div class="row align-items-center faq-text-center">
								<div class="col-12 col-lg">
									<h3><?=$page->heading7;?></h3>
								</div>
								<div class="col-12 col-lg-auto mt-4 mt-lg-0">
									<a href="<?=$pages->get("name=tis-faq")->httpUrl;?>" target="_blank" class="btn btn-outline-primary-new button-rounded shadow-sm font-weight-medium m-0 btn-block"><?=$page->youtube_link;?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>		
			<!-- frequently asked section end  -->

	<?php  include 'includes/tis_footer.php'; ?>