
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
    <style>
        .img-responsive.mobile
        {
          display: none;
        }
        @media only screen and (max-device-width: 480px)
        {
              .img-responsive {
                display: none;
              }
              .img-responsive.mobile {
                display: block;
              }
        }
        @media (min-width: 992px)
        {
        
         .img-responsive {
            display: block;
          }
          .img-responsive.mobile {
            display: none;
          }
        }
        .portfolio-item .portfolio-image img {
    display: block;
    width: 138px;
    height: 134px;
    border-radius: 50% !important;
    margin: auto;
}  

.linkedin {
  background: #007bb5;
  color: white;
}
    </style>
<body>
    <section id="content">
        <div class=" img-responsive "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
							    <img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/Web_Banner_R2.jpg">
							</div>
							<div class="img-responsive  mobile" >
								    <!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_mobile.jpg');">-->
								 <img class="img-fluid"  src="<?=$urls->httpTemplates?>images/Mobile_Banner_R2.jpg">
		</div>
    
</section>



	<section id="content" style="margin-top:3rem;">
	    <div class="fancy-title title-center title-border topmargin-sm" id="speakers">
						<h3 class="title_new">Speakers</h3>
					</div>
					
		<section id="content">
			<div class="" style="margin-bottom: 5rem; margin-bottom:2rem;">
				<div class="container clearfix">
				    <h3 class="text-center" style="margin-bottom:2rem;">INTERNATIONAL SPEAKERS</h3>

					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
							$limit=3;
						    foreach($pages->get("name=keynote-speakers")->children("")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>

            <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;
    padding-bottom: 0.5rem;">
                  <a style="    padding-right: 0.5rem;
    padding-left: 0.5rem;
    font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
            </div>

							
								</div>
								<!--<div class="portfolio-desc">-->
								<!--<a style="margin-left: 61px;" href="#" class="social-icon si-light si-facebook">-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            </a>-->
								
								<!--</div>-->
								
								<div class="portfolio-desc" style="padding: 1px 5px;" >
									<h4 class="font-weight-normal center letter note mb-0" ><b><?=$rise_speaker->title?></b></h4>
										<h5 class="font-weight-normal center letter note mb-0" ><?=$rise_speaker->pc_ally_book_img_description?></h5>	
						
										<h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.5rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
									
										 
							</div>
							
						</article>
					

						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
					
					
						
						</div>
				<div class="container clearfix" style="margin-top: 2rem;">
                            <h3 class="text-center" style="margin-bottom:2rem;">NATIONAL SPEAKERS</h3>
					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
						
						    foreach($pages->get("name=all-speakers")->children("")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>

                        <!--        <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;-->
                        <!--padding-bottom: 0.5rem;">-->
                        <!--              <a style="    padding-right: 0.5rem;-->
                        <!--padding-left: 0.5rem;-->
                        <!--font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
                        <!--        </div>-->
                                  <div class="d-flex justify-content-center" style="    padding-top: 0.5rem; padding-bottom: 0.5rem;">
                                        <!--              <a style="    padding-right: 0.5rem;-->
                                        <!--padding-left: 0.5rem;-->
                                        <!--font-size: 1.2rem;" target="_blank" href="#" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
                                        <?php
                                        $name="Aruna Desai";
                                        $name_saurabh="Saurabh Kirpal";
                                        $name_Raga="Raga Olga D’Silva";
                                        $name_Shaina="Shaina Shingari ";
                                        $name_Speaker10="Speaker10";
                                        $name_Anubhuti="Anubhuti Banerjee";
                                       
                                       $name_new=$rise_speaker->title;
                                        
                                        if($name== $name_new)
                                        {
                                            ?>
                                                 <a style="    padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        elseif($name_saurabh == $name_new)
                                        {
                                             ?>
                                                 <a style="padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                            
                                        }
                                        elseif( $name_Raga == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                        elseif( $name_Shaina == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                        }
                                        elseif( $name_Speaker10 == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                        elseif( $name_Anubhuti == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                       
                                        else{
                                                
                                            ?>
                                    
                                            <a style="    padding-right: 0.5rem; padding-left: 0.5rem;  font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
                                            <?php
                                                
                                                
                                            
                                            
                                        }
                                         ?>
            
                
                                     </div>
							
							
								</div>
								<!--<div class="portfolio-desc">-->
								<!--<a style="margin-left: 61px;" href="#" class="social-icon si-light si-facebook">-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            </a>-->
								
								<!--</div>-->
								
								<div class="portfolio-desc" style="padding: 1px 5px;" >
									<h4 class="font-weight-normal center letter note mb-0" ><b><?=$rise_speaker->title?></b></h4>
										<h5 class="font-weight-normal center letter note mb-0" ><?=$rise_speaker->pc_ally_book_img_description?></h5>	
						
										<h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.5rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
									
										 
							</div>
							
						</article>
					

						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
					
					
						
						</div>
						
						
						
			</div>
</section>
   

</body>
</html>