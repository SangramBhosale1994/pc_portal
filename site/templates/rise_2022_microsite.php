<?php  include 'includes/rise2022_header.php'; ?>
<style>
	/* css by pooja for agenda section green color piles */
.green-piles{
	padding: 11px 5px 11px 5px !important;
    border: 1px solid rgb(255 255 255) !important;
    background: #00a04a !important;
    margin: 0px 7px 0px 7px!important;
    text-align: center !important;
    border-radius: 5px !important;
	color: #fff !important;
}
.green-piles h5{
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
    color: #ffffff !important;
}
/* .event-passes-card h1, h2, h3, h4, h5, h6{
	color: #fff;
}  */
</style>

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
									<img src="<?=$Banner_repeater->banner_image->httpUrl;?>" alt="Slide 2">
				
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
									<img src="<?=$mobile_banner_repeater->banner_image->httpUrl;?>" alt="Slide 2">
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
		<!-- mobile view
		 slider end  -->

		<!-- second header
		============================================= -->
		<section id="content">
<?php
if(false)
{
?>
			<div class="content-wrap">

				<div class="promo promo-full mt-5 mb-5">
				    <div class="container-fluid" >
						<div class="header_tabs justify-content-center flex-container" style="text-align: center;">
							<!-- <a class="flex-spacing right-margin-header" target="_blank" href="https://www.thepridecircle.com/"><button type="button" class="btn btn-outline-primary-new  ">PRIDE CIRCLE</button></a> -->
							<a class="flex-spacing right-margin-header" href="https://www.thepridecircle.com/"><button type="button" class="btn btn-outline-primary-agenda ">PRIDE CIRCLE </button></a>
							<a class="flex-spacing right-margin-header"  href="#agenda_table"><button type="button" class="btn btn-outline-primary-ep ">RISE2022</button></a>
							<a class="flex-spacing right-margin-header"  href="#speakers"><button type="button" class="btn btn-outline-primary-speakers button_alignment">AGENDA</button></a>
							<a class="flex-spacing right-margin-header"  href="#sponsors"><button type="button" class="btn btn-outline-primary-sp button_alignment">SPEAKERS</button></a>
							<a class="flex-spacing right-margin-header"  href="#tickets"><button type="button" class="btn btn-outline-primary-pc  button_alignment">SPONSORS</button></a>
							<a class="flex-spacing right-margin-header"  href="#sponsors_contact"><button type="button" class="btn btn-outline-primary-gallery button_alignment">EVENT&nbspPASSES</button></a>
							<a class="flex-spacing right-margin-header"  href="#sponsors_contact"><button type="button" class="btn btn-outline-primary-speakers button_alignment">PAST EDITIONS</button></a>
							<a class="flex-spacing right-margin-header"  href="#rise2021faq"><button type="button" class="btn btn-outline-primary-sp button_alignment">TESTIMONIAL</button></a>
							<a class="flex-spacing right-margin-header" href="#about_rise"><button type="button" class="btn btn-outline-primary-agenda ">FAQ</button></a>
						</div>
					</div>
				</div>
			</div>
<?php
}
?>

			<!-- paragraph section  -->
			<div class="content-wrap [ mt-5 ]" id="about_rise">
            	<div class="container">
            		<div style="text-transform: none;" class="title_new heading-block  border-bottom-0 mb-5"><?=$page->text_description;?></div>
            	</div>
            </div>
			<!-- paragraph section end -->

			
			<!-- riserevolution section -->
			
			<div class="container mb-5">
                <div class="title_new heading-block border-bottom-0 mb-0">
                    <!-- <h3 style="color:#003;" class="title_new mb-3 mt-5"><?=$page->ally_challenge_resource_locator;?></h3> -->
                    <div style="text-transform: none;" class="removeb-margin"><?=$page->ticketing_title_toshow;?></div>
                </div>
                <div class="row justify-content-center">
                    <div class="hide-image-in-mobie title-hide1 col-md-11" >
						<img src="<?=$page->ally_banner_image->httpUrl;?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;">
                    </div>
					<div class="hide-image-in-web title-hide1 col-12">
						<img src="<?=$page->ally_banner_mobile_image->httpUrl;?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;" >
                    </div>
                </div>
				<!-- <div class="row gutter-20 mx-auto mb-5 mt-3" style="max-width: 640px;">
				    <?php 
                   // foreach($page->rise_past_section_buttons as $rise_past_section_buttons)
                    //{
                    ?>
					<div class="col-sm-4">
						<a href="<?=$rise_past_section_buttons->heading3;?>" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px"><?=$rise_past_section_buttons->heading2;?></a>
					</div>
					<?php
					//}
					?>
			    </div> -->
			</div>
			<!-- riserevolution section end -->

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
									<div style="color:#003;" class="cards-text align-privacy-data-for-ul"><?=$cards_section->text_description;?></div>
									<!-- <a class="flex-spacing right-margin-header"  href="<?=$cards_section->heading3;?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$cards_section->heading2;?></button></a> -->
									<div class="story-box-content1">
										<h4 style="color:#003;font-size: 1rem;margin: -0.9rem;" class="center mt-2"><?=$cards_section->heading2;?></h4>
									
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
									<div style="color:#003 !important; height:auto !important;" class="cards-text align-privacy-data-for-ul"><?=$cards_section->text_description;?></div>
			
									<!-- <a class="flex-spacing right-margin-header"  href="<?=$cards_section->heading3;?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$cards_section->heading2;?></button></a> -->
									<div class="">
										<h4 style="color:#003 !important;" class="mt-2 center text-white"><?=$cards_section->heading2;?></h4>
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
			    <div class="content-wrap" style="margin-bottom: -2rem !important;" >
					<div class="text-center title-center title-border" style="margin-bottom: 3rem; background-color:#ef6623;height: 4rem;padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;"><?=$page->heading7;?></h3>
					</div>
					<div class="container clearfix mb-3">
						<div class="bs-example">
							<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
							<?php 
								foreach($page->jobfair_agenda as $jobfair_agenda)
								{			   
								?>
								<li class="nav-item">
								<a style="font-weight: 550;" class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#schedule1" role="tab" aria-controls="pills-home" aria-selected="true"><?=$jobfair_agenda->title;?></a>
								</li>
								
								<?php
								}
								?>

								<?php 
								foreach($page->conference_agenda as $conference_agenda)
								{			   
								?>
								<li class="nav-item">
								<a style="font-weight: 550;" class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#schedule2" role="tab" aria-controls="pills-profile" aria-selected="false"><?=$conference_agenda->title;?></a>
								</li>
								<?php
								}
								?>
							</ul>
			
							<div class="tab-content">
							<?php 
								foreach($page->jobfair_agenda as $jobfair_agenda)
								{			   
								?>
								<div class="tab-pane fade active show" id="schedule1">
									<div class="content-wrap" style="padding: 0px 0 !important;">
											<div class="containernew container clearfix">
												<div class="row agenda_section " style="margin-right: 0px !important; margin-left: 0px !important; ">
													<div class="col-md-12 grid-margin-md stretch-card d-flex_" style="">
														<div class="cardnew active">
															<div class="mb-2">
																<!-- jobfair agenda-->
																<?php 
																	foreach($jobfair_agenda->agenda_details as $agenda_details)
																	{			   
																	?>
																	<div class="agenda-spacing card-title center font-weight-normal  letter note mb-0" style="align-items: center;margin-top: 0.5rem;color:#000033;"><?=$agenda_details->text_description;?></div>
																		<!-- loop for details sessions -->
																		<div>
																			<?php 
																			foreach($agenda_details->session_details as $session_details)
																			{			   
																			?>
																				<div class="green-piles"><h5><?=$session_details->session_text;?></h5></div>
																			
																			<?php
																			}
																			?>
																		</div>
																<?php
																	}
																	?>
																<!-- jobfair agenda -->
															</div>
														</div>
														
													</div>  				   
												</div>
											</div> 
											<?php 
											foreach($page->day_1_agenda_section_button as $day_1_agenda_section_button)
											{			   
											?>
											<div class="container mt-3">
    											<div class="d-flex justify-content-center">
													<a href="<?=$day_1_agenda_section_button->heading3;?>" class="[ text-center ][ btn btn-outline-primary-new ]"><?=$day_1_agenda_section_button->heading2;?></a>
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


								<?php 
								foreach($page->conference_agenda as $conference_agenda)
								{			   
								?>
								<div class="tab-pane fade" id="schedule2">
									<div class="content-wrap" style="padding: 0px 0 !important;">
										<div class="containernew container clearfix">
											<div class="row agenda_section " style="margin-right: 0px !important; margin-left: 0px !important; ">
												<div class="col-md-12 grid-margin-md stretch-card d-flex_" style="">
													<div class="cardnew active">
														<div class="mb-2">
																	<?php 
																	foreach($conference_agenda->agenda_details as $agenda_details)
																	{			   
																	?>
																	<div class="agenda-spacing card-title center font-weight-normal  letter note mb-0" style="align-items: center;margin-top: 0.5rem;color:#000033;"><?=$agenda_details->text_description;?></div>
																		<!-- loop for details sessions -->
																		<div>
																			<?php 
																			foreach($agenda_details->session_details as $session_details)
																			{			   
																			?>
																				<div class="green-piles"><h5><?=$session_details->session_text;?></h5></div>
																			
																			<?php
																			}
																			?>
																		</div>
																<?php
																	}
																	?>
														</div>
													</div>
												</div>
											</div>     
										</div>
										<?php 
											foreach($page->day_2_agenda_section_button as $day_2_agenda_section_button)
											{			   
											?>
											<div class="container mt-3">
    											<div class="d-flex justify-content-center">
													<a href="<?=$day_2_agenda_section_button->heading3;?>" class="[ text-center ][ btn btn-outline-primary-new ]"><?=$day_2_agenda_section_button->heading2;?></a>
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
						</div>
					</div>
					<div id="speakers" class="mb-6"></div>
				</div>
				<!-- <div class="container">
				    <div class="row justify-content-center gutter-20 mx-auto mb-md-6 mb-5 mt-3" style="max-width: 640px;">
							<div class="col-sm-7">
								<a href="<?=$urls->httpTemplates?>files/RISE2021-Agenda.pdf" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">DOWNLOAD THE DETAILED AGENDA</a>
							</div>
		        	</div>
				</div> -->
			<!-- agenda section end  -->


				
			
			

			<!-- speakers section by pooja -->
			<?php
                if($pages->get("name=rise2022-speakers")->covid_19_title!=""){
            ?>
			<div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:#fbdd0d;    height: 4rem;     padding-top: 0.9rem;" >
				<h3 class="title_new" style="color:#000033 !important;"><?=$pages->get("name=rise2022-speakers")->covid_19_title;?></h3>
			</div>
				<div id="section-multipage" class="page-section center bg-transparent mb-0 clearfix">
					<div class="px-5 container-fluid" style="max-width: 1600px">
						

						<?php 
                        foreach($pages->get("name=rise2022-speakers")->children("limit=2") as $speakers_type)
                        {
                        ?>
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h4 class="mb-4"><?=$speakers_type->title;?></h4>
                        </div>
						<div id="intro-multipages-container" class="row col-mb-50 mb-3 justify-content-center">
						    <?php 
                            foreach($speakers_type->children("limit=10") as $speakers_detials)
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
									    
										<!-- <a href="<?=$speakers_detials->active_status;?>" target="_blank">
										<img src="<?=$urls->httpTemplates?>icons8-linkedin-48.png" class="mb-1" alt="Lightbox" style="max-width: 33px;">
									</a> -->
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

						<div class="row justify-content-center gutter-20 mx-auto mb-5 mt-3" style="max-width: 640px;">
						<div id="sponsorship" class="mb-6"></div>
							<div class="col-sm-4">
								<a href="<?=$pages->get("name=rise2022-speakers")->httpUrl;?>" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">View All Speakers</a>
							</div>
						</div>
						
					</div>
				</div>
			<?
            }else{
            ?>
            
            <?
            }
            ?>
			<!-- speakers section end -->

			<!-- sponsorship div by pooja -->
			<?php 
                foreach($page->sponsorships_repeater as $sponsorships_repeater)
                {
                ?>
			<div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:#13a149;    height: 4rem;     padding-top: 0.9rem;" >
				<h3 class="title_new" style="color:#fff;"><?=$sponsorships_repeater->title;?></h3>
			</div>
			<?php
				}
				?>
			<div class="container mt-2 mb-6">
				<div class="row justify-content-center">
				<?php 
                    foreach($page->sponsorships_repeater as $sponsorships_repeater)
                    {
                    ?>
					<div class=" col-lg-12 col-md-12 mb-3">
					    <div class="story-box-info p-3" style="border: 1px solid #000033;border-radius: 0.25rem;">
							<!-- <h3 class="title_new center" style="margin: 7px;"><?=$sponsorships_repeater->title;?></h3> -->
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

			
			<!--sponsors and partner section-->
            <?php
							if($page->conference_sponsors_section_title!=""){
						?>
               	
					<div class="title_new heading-block center border-bottom-0 mb-0 ">
						<h3 style="#000033;" class="mb-4 mt-4"><?=$page->conference_sponsors_section_title;?></h3>
					</div>
                
					<?php 
						foreach($page->conference_multiple_sponsors as $multiple_sponsors_repeater)
						{
						?>
						<div class="title_new heading-block center border-bottom-0 mb-0 ">
							<h4 style="#000033;" class=""><?=$multiple_sponsors_repeater->title;?></h4>
							<div class="d-flex justify-content-center">
								<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:3px; text-align:center"></div>
							</div>
						</div>
						<div class="container mt-3 mb-2">
							<ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0 justify-content-center">
								<?php 
								
									foreach($multiple_sponsors_repeater->speakers_repeater->find('start=0,limit=5') as $speakers_repeater)
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
					}
					?>
				<?php 
						if($page->ally_social_media_title!=""){
					
					?>
					<div class="container">
						<div class="row">
							<div class="col-md-12" style="background: aliceblue;border: 0.2px solid #acacac;margin-left: 15px;margin-right: 15px;margin-bottom: 0.5rem;">

							</div>
						</div>
					</div>
					<div class="title_new heading-block center border-bottom-0 mb-0 ">
						<h3 style="#000033;" class="mb-4 mt-4"><?=$page->ally_social_media_title;?></h3>
					</div>
            <!--sponsors section end-->
            
			<div class="container">
				<div class="row mt-3 justify-content-center gutter-20 mx-auto mb-5" style="max-width: 640px;">
				<div id="event-passes" class="mb-5"></div>			
					<div class="col-sm-4">
								<a href="<?=$pages->get("name=sponsors")->httpUrl;?>" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">View All Sponsors</a>
							</div>
					</div>
				
			</div>
			<?php
				}else{
			
				}
				?>
			
			<!-- event passes section by pooja -->
			<!-- <section id="content m///t-1" style="" > -->
			
			    <div class="content-wrap" style="margin-bottom: -2rem !important;" >
					<div class="text-center title-center title-border topmargin-sm" style="margin-bottom: 5rem; background-color:#214897; height: 4rem;padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;"><?=$page->heading8;?></h3>
					</div>
				</div>
				<div class="container mt-2 mb-5">
					<div class="row justify-content-center">
					<?php 
						foreach($page->event_passes_repeater as $event_passes_repeater)
						{
						?>
						<div class=" col-lg-6 col-md-6 mb-3">
							<div class="story-box-info p-3" style="border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem;background-color:rgb(32, 68, 150);">
								<h3 class="event-passes-card title_new center text-white" style="margin: 7px;"><?=$event_passes_repeater->title;?></h3>
								<div class="mt-3 event-passes-text-color event-passes-ul-style event_passes_text">
									<?=$event_passes_repeater->text_description;?>
								</div>	
									<div class="">
										<!-- <div style="" class="center text-white"><?=$event_passes_repeater->heading2;?></div> -->
										<div class="row justify-content-center  mb-3 mt-3">
											<a class="flex-spacing" target="_blank" href="<?=$event_passes_repeater->heading4;?>"><button style="font-weight: 550 !important;" class="button-grey btn-outline-event-passes font-weight-light button ml-0 button-rounded"><?=$event_passes_repeater->heading3;?></button></a>
										</div>
									</div>
							</div>
						</div>
						<?php
						}
						?>

						<?php 
						foreach($page->event_passes_repeater_one as $event_passes_repeater1)
						{
						?>
						<div class=" col-lg-6 col-md-6 mb-3">
							<div class="story-box-info p-3" style="border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem;background:#8A2527;">
								<h3 class="title_new center text-white" style="margin: 7px;"><?=$event_passes_repeater1->title;?></h3>
								<div class="mt-3 event-passes-ul-style text-white event_passes_text">
									<?=$event_passes_repeater1->text_description;?>
								</div>
									<div class="">
										<!-- <div style="color:#8A2527;" class="center"><?=$event_passes_repeater1->heading2;?></div> -->
										<div class="row justify-content-center  mb-3 mt-3">
											<a class="flex-spacing" target="_blank" href="<?=$event_passes_repeater1->heading4;?>"><button style="font-weight: 550 !important;" class="button-grey btn-outline-event-passes font-weight-light button ml-0 button-rounded"><?=$event_passes_repeater1->heading3;?></button></a>
										</div>
									</div>
							</div>
						</div>
						<?php
						}
						?>
						
					</div>
					
				</div>
				
				
			<!-- </section> -->
			<!-- event passes section end -->
			

			<!-- gallery section by pooja -->
			<div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:#824298;    height: 4rem;     padding-top: 0.9rem;" >
				<h3 class="title_new" style="color:#fff;"><?=$page->heading9;?></h3>
			</div>
			<!-- <section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem;"> -->
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
            				<!-- <div class="col-md-6">
                   				<div style="">
									<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/1.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/2.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/3.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/4.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/5.jpg" class="d-block w-100" alt="...">
											</div>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
                                </div>
								<div class="text-center" >
									<h3>RISE Bangalore 2019
									<br>
									<a target="_blank" href="https://www.flickr.com/photos/182792580@N02/albums/72157709799174011"><small>View Images</small></a></h3>
								</div>
                            </div>
            				<div class="col-md-6">
                    		    <div>
									<div id="carouselExampleCaptionsOne" class="carousel slide" data-ride="carousel" data-interval="false">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleCaptionsOne" data-slide-to="0" class="active"></li>
											<li data-target="#carouselExampleCaptionsOne" data-slide-to="1"></li>
											<li data-target="#carouselExampleCaptionsOne" data-slide-to="2"></li>
											<li data-target="#carouselExampleCaptionsOne" data-slide-to="3"></li>
											<li data-target="#carouselExampleCaptionsOne" data-slide-to="4"></li>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
											<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/14.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/12.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/13.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/11.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/15.jpg" class="d-block w-100" alt="...">
											</div>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleCaptionsOne" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleCaptionsOne" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>
								<div class="text-center" >
									<h3>RISE Delhi 2020
									<br>
									<a target="_blank" href="https://www.flickr.com/photos/182792580@N02/albums/72157713339442893"><small>View Images</small></a></h3>
								</div>	
			                </div>
								 -->

                        </div>
                    </div>
			    </div>
		    <!-- </section> -->

			<!-- gallery section end -->

			<!-- rise reflection section by pooja-->
			<div class="container-fluid title-center title-border topmargin-sm text-center" style="margin-bottom: 1rem; background-color:#ea2127;    height: 4rem;     padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;"><?=$page->candidate_profile_id;?></h3>
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
                                <!-- <div style=" margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new"> -->
								<iframe width="677" height="400" src="https://www.youtube.com/embed/<?=$youtube_video_repeater->heading2;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>	
								<!-- </div>     -->
                            </div>
                            <?php
							}
							?>
                        </div>
                    </div>
				<div id="media" class="mb-6"></div>
				</div>
			<!-- </section> -->
			<!-- rise reflection end -->

			<!-- facebook and twitter embedding  -->
			<?php
				if($page->covid_19_title!=""){
				?>
			<div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="TEQWel07"></script>
			<div class="container-fluid title-center title-border mt-6 text-center" style="margin-bottom: 3rem; background-color:#ef6623;height: 4rem;padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;"><?=$page->covid_19_title;?></h3>
			</div>
			<div class="container">
				<div class="row mb-6 justify-content-center">
					<div class="col-md-5 mb-5">
					    <div class="fb-page" data-href="https://www.facebook.com/<?=$page->heading3;?>" data-tabs="timeline" data-width="800" data-height="520" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/<?=$page->heading3;?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?=$page->heading3;?>"><?=$page->heading5;?></a></blockquote></div>
					</div>
					<div class="col-md-5 mb-5">
					    <a class="twitter-timeline" data-width="500" data-height="520" href="https://twitter.com/<?=$page->heading4;?>"><?=$page->heading6;?></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				</div>
			</div>
			<?php
				}else{
			
				}
				?>
			<!-- facebook and twitter embedding end  -->

			<!-- frequently asked question section by pooja -->
			<div class="mt-5">
			<div id="faq"></div>
					<div class="container">
						<div class="mt-6 promo promo-border p-4 p-md-5 mb-6">
							<div class="row align-items-center faq-text-center">
								<div class="col-12 col-lg">
									<h3><?=$page->heading2;?></h3>
								</div>
								<div class="col-12 col-lg-auto mt-4 mt-lg-0">
									<a href="<?=$page->year_of_passing;?>" target="_blank" class="font-weight-light btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?=$page->youtube_link;?></a>
								</div>
							</div>
						</div>
					</div>
				</div>		
			<!-- frequently asked section end  -->

		</section><!-- #content end -->

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

		<!-- demo footer-->
		

	</div><!-- #wrapper end -->

	<?php  include 'includes/rise2022_footer.php'; ?>